<?php

require APPPATH . 'modules/api/controllers/MyRest.php';

class BloodCatApi extends MyRest {

    function __construct() {
        // Construct our parent class

        parent::__construct();
        $this->methods['bloodCat_post']['limit'] = 1; //500 requests per hour per user/key
        $this->methods['bloodDetails_post']['limit'] = 1; //500 requests per hour per user/key
    }

    function bloodCat_post() {
        $this->datatables
                ->select('qyura_bloodCat.bloodCat_name')
                ->from('qyura_bloodCat')
                ->where('qyura_bloodCat.bloodCat_deleted = 0');

        $response = $this->datatables->generate();

        //echo $this->datatables->last_query(); die();
        $response = (array) json_decode($response);
        // print_r($response);exit;
        $this->response($response, 200);
    }
    
     function bloodBankList_post() {
 
        $this->form_validation->set_rules('lat', 'Lat', 'xss_clean|trim|decimal');
        $this->form_validation->set_rules('long', 'Long', 'xss_clean|trim|decimal');
        $this->bf_form_validation->set_rules('search', 'Search Keyword', 'xss_clean|trim');
        $this->form_validation->set_rules('isemergency', 'Is Emergency', 'xss_clean|trim|numeric');
        $this->bf_form_validation->set_rules('cityId', 'cityId', 'xss_clean|trim|numeric|is_natural_no_zero');

        if ($this->form_validation->run() == FALSE) {
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);
        } else {

            $aoClumns = array("bloodBank_id", "bloodBank_name", "bloodBank_add", "lat", "long", "bloodBank_photo", "bloodBank_mblNo", "openingHours", "closingHours", "allTime");
            // search
            $search = isset($_POST['search']) && $_POST['search'] != '' ? $this->input->post('search') : NULL;
            //city
            $cityId = isset($_POST['cityId']) ? $this->input->post('cityId') : NULL;
            
            $isemergency = isset($_POST['isemergency']) ? $this->input->post('isemergency') : NULL;
            
            if ($cityId != NULL) {
                $array = array('qyura_bloodBank.cityId' => $cityId);
                $this->db->where($array);
            } else {
                $this->db->having(array('distance <' => USER_DISTANCE));
            }
            
            $lat = isset($_POST['lat']) ? $this->input->post('lat') : '';
            $long = isset($_POST['long']) ? $this->input->post('long') : '';
            
            $lastUpdatedDate = isset($_POST['lastUpdatedDate']) ? $_POST['lastUpdatedDate'] : '1452951625';

            $notIn = isset($_POST['notin']) ? $_POST['notin'] : '';
            $notIn = explode(',', $notIn);
            $curDay = getDay(date("l",strtotime(date("Y-m-d"))));
                        
            $where = array('qyura_bloodBank.bloodBank_deleted' => 0);
            
            if ($isemergency != '' && $isemergency != NULL) {
                $where['qyura_bloodBank.isEmergency'] = $isemergency;
            }
            
            $this->db
                    ->select('`qyura_bloodBank`.`bloodBank_id`,`qyura_bloodBank`.`bloodBank_id`, `qyura_bloodBank`.`bloodBank_name`, `qyura_bloodBank`.`bloodBank_add`,`qyura_bloodBank`.`bloodBank_lat`,`qyura_bloodBank`.`bloodBank_long`,`qyura_bloodBank`.`bloodBank_photo`, CONCAT("0","",`bloodBank_phn`) as  bloodBank_phn, `qyura_bloodBank`.`isEmergency`,
(CASE WHEN(hospital_usersId is not null) THEN hospital_usersId WHEN(diagnostic_usersId is not null) THEN diagnostic_usersId ELSE  qyura_bloodBank.users_id END) as userId,
(CASE WHEN(hospital_usersId is not null) THEN hospital_lat WHEN(diagnostic_usersId is not null) THEN diagnostic_lat ELSE  bloodBank_lat END) as lat, 
(CASE WHEN(hospital_usersId is not null) THEN hospital_long WHEN(diagnostic_usersId is not null) THEN diagnostic_long ELSE  bloodBank_long END) as lng,  
(CASE WHEN(hospital_usersId is not null) THEN hospital_address WHEN(diagnostic_usersId is not null) THEN diagnostic_address ELSE  bloodBank_add END) as adr, (
                    6371 * acos( cos( radians( ' . $lat . ' ) ) * cos( radians( (CASE WHEN(hospital_usersId is not null) THEN hospital_lat WHEN(diagnostic_usersId is not null) THEN diagnostic_lat ELSE  bloodBank_lat END) ) ) * cos( radians( (CASE WHEN(hospital_usersId is not null) THEN hospital_long WHEN(diagnostic_usersId is not null) THEN diagnostic_long ELSE  bloodBank_long END) ) - radians( ' . $long . ' ) ) + sin( radians( ' . $lat . ' ) ) * sin( radians( (CASE WHEN(hospital_usersId is not null) THEN hospital_lat WHEN(diagnostic_usersId is not null) THEN diagnostic_lat ELSE  bloodBank_lat END) ) ) )
                    ) AS distance')
                    ->from('qyura_bloodBank')
                    ->join('qyura_usersRoles', 'qyura_usersRoles.usersRoles_userId=qyura_bloodBank.users_id', 'left')
                    ->join('qyura_hospital', 'qyura_usersRoles.usersRoles_parentId=qyura_hospital.hospital_usersId AND `qyura_hospital`.`status` = 1 AND `qyura_hospital`.`hospital_deleted` = "0"', 'left')
                    ->join('qyura_diagnostic', 'qyura_usersRoles.usersRoles_parentId=qyura_diagnostic.diagnostic_usersId AND `qyura_diagnostic`.`status`=1 AND `qyura_diagnostic`.`diagnostic_deleted` = 0', 'left')
                    ->where($where)
                    ->where_not_in('qyura_bloodBank.bloodBank_id', $notIn)
                    ->group_by('bloodBank_id');
                    
            if ($search != null) {

               $searchParams = array('bloodBank_name', 'bloodBank_add');

                $lkCount = 0;
                foreach ($searchParams as $params) {
                    if ($params == 'bloodBank_name') {
                        $this->db->group_start();
                        $this->db->like($params, $search);
                    } else {
                        if (count($searchParams) - 1 == $lkCount){
                            $this->db->or_like($params, $search);
                            $this->db->group_end();
                        }
                        else
                            $this->db->or_like($params, $search);
                    }
                    $lkCount++;
                }
            } 
            
            $data = $this->db->get()->result();
            $array_data = array();

            $option = array('table' => 'bloodCatBank', 'select' => 'bloodBank_id');
            $deleted = $this->singleDelList($option);

            $response = '';
            foreach ($data as $row) {
                
                $userId = (isset($row->userId) ? $row->userId : "");
                $slots  = NULL;
                
                if($userId != "" || $userId != NULL){
                    $slots = $this->common_model->getMITimeSlot($userId,$curDay);
                }
                
                $array_data[] = isset($row->bloodBank_id) ? $row->bloodBank_id : "";
                $array_data[] = isset($row->bloodBank_name) ? $row->bloodBank_name : "";
                $array_data[] = isset($row->adr) ? $row->adr : "";
                $array_data[] = isset($row->lat) ? $row->lat : "";
                $array_data[] = isset($row->lng) ? $row->lng : "";
                $array_data[] = isset($row->bloodBank_photo) ? 'assets/BloodBank/' . $row->bloodBank_photo : "";
                
                $array_data[] = isset($row->bloodBank_phn) ? $row->bloodBank_phn : "";
                if($slots != NULL){
                    $array_data[] = isset($slots->openingHours) ? $slots->openingHours : "";
                    $array_data[] = isset($slots->closingHours) ? $slots->closingHours : "";
                }else{
                    $array_data[] = "";
                    $array_data[] = "";
                }
                
                $array_data[] = isset($row->isEmergency) ? $row->isEmergency : "";
                $finalResult[] = $array_data;
                $array_data = '';
            }
 
            $option = array('table' => 'bloodBank', 'select' => 'bloodBank_id');
            $deleted = $this->singleDelList($option);
            $response['bloodBank_deleted'] = $deleted;

            if (!empty($finalResult)) {
                $response1['msg'] = 'success';
                $response1['status'] = TRUE;
                $response1['data'] = $finalResult;
                $response1['colName'] = $aoClumns;
                $response1['bloodBank_deleted'] = $deleted;
                $this->response($response1, 200); // 200 being the HTTP response code
            } else {
                $response['msg'] = 'No Blood bank is available at this range. ';
                $response['status'] = FALSE;
                $this->response($response, 401);
            }
        }
    }

    function bloodBankListBK_post() {
 
        $this->form_validation->set_rules('lat', 'Lat', 'xss_clean|trim|decimal');
        $this->form_validation->set_rules('long', 'Long', 'xss_clean|trim|decimal');
        $this->bf_form_validation->set_rules('search', 'Search Keyword', 'xss_clean|trim');               
        $this->bf_form_validation->set_rules('cityId', 'cityId', 'xss_clean|trim|numeric|is_natural_no_zero');

        if ($this->form_validation->run() == FALSE) {
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);
        } else {

            $aoClumns = array("bloodBank_id", "bloodBank_name", "bloodBank_add", "lat", "long", "bloodBank_photo", "bloodBank_mblNo");
            // search
            $search = isset($_POST['search']) && $_POST['search'] != '' ? $this->input->post('search') : NULL;
            //city
            $cityId = isset($_POST['cityId']) ? $this->input->post('cityId') : NULL;

            if ($cityId != NULL) {
                $array = array('qyura_bloodBank.cityId' => $cityId);
                $this->db->where($array);
            } else {
                $this->db->having(array('distance <' => USER_DISTANCE));
            }
            
            $lat = isset($_POST['lat']) ? $this->input->post('lat') : '';
            $long = isset($_POST['long']) ? $this->input->post('long') : '';
            
            $lastUpdatedDate = isset($_POST['lastUpdatedDate']) ? $_POST['lastUpdatedDate'] : '1452951625';

            $notIn = isset($_POST['notin']) ? $_POST['notin'] : '';
            $notIn = explode(',', $notIn);
            $curDay = date("D",strtotime(date("Y-m-d")));
                        
            $where = array('qyura_bloodCatBank.bloodCats_id=' => $catId, 'qyura_bloodBank.bloodBank_deleted' => 0,'dayNumber'=>$curDay);
            $this->db
                    ->select('`qyura_bloodBank`.`bloodBank_id`, `qyura_bloodBank`.`bloodBank_name`, `qyura_bloodBank`.`bloodBank_add`,`qyura_bloodBank`.`bloodBank_lat`,`qyura_bloodBank`.`bloodBank_long`,
                    `qyura_bloodBank`.`bloodBank_photo`,
                        `qyura_bloodBank`.`bloodBank_phn`, IFNULL(hospital_lat, bloodBank_lat) as lat, IFNULL(hospital_long, bloodBank_long) as lng, IFNULL(hospital_address,bloodBank_add) as adr, (
                    6371 * acos( cos( radians( ' . $lat . ' ) ) * cos( radians( IFNULL(hospital_lat, bloodBank_lat) ) ) * cos( radians( IFNULL(hospital_long, bloodBank_long) ) - radians( ' . $long . ' ) ) + sin( radians( ' . $lat . ' ) ) * sin( radians( IFNULL(hospital_lat, bloodBank_lat) ) ) )
                    ) AS distance')
                    ->from('qyura_bloodBank')
                    ->join('qyura_usersRoles', 'qyura_usersRoles.usersRoles_userId=qyura_bloodBank.users_id', 'left')
                    ->join('qyura_hospital', 'qyura_usersRoles.usersRoles_parentId=qyura_hospital.hospital_usersId', 'left')
                    ->join('qyura_bloodCatBank', 'qyura_bloodCatBank.bloodBank_id=qyura_bloodBank.users_id', 'left')
                    ->join('qyura_bloodCat', 'qyura_bloodCat.bloodCat_id=qyura_bloodCatBank.bloodCats_id', 'left') 
                    ->where($where)
                    ->where_not_in('qyura_bloodBank.bloodBank_id', $notIn)
                    ->group_by('bloodBank_id')
                    ->limit(DATA_LIMIT);
                    
            if ($search != null) {

               $searchParams = array('bloodBank_name', 'bloodBank_add');

                $lkCount = 0;
                foreach ($searchParams as $params) {
                    if ($params == 'bloodBank_name') {
                         $this->db->group_start();
                        $this->db->like($params, $search);
                    } else {
                        if (count($searchParams) - 1 == $lkCount){
                            $this->db->or_like($params, $search);
                            $this->db->group_end();
                        }
                        else
                            $this->db->or_like($params, $search);
                    }
                    $lkCount++;
                }
            } 
            $data = $this->db->get()->result();
            
            $array_data = array();

            $option = array('table' => 'bloodCatBank', 'select' => 'bloodBank_id');
            $deleted = $this->singleDelList($option);


            $response = '';
            foreach ($data as $row) {

                $array_data[] = isset($row->bloodBank_id) ? $row->bloodBank_id : "";
                $array_data[] = isset($row->bloodBank_name) ? $row->bloodBank_name : "";
                $array_data[] = isset($row->adr) ? $row->adr : "";
                $array_data[] = isset($row->lat) ? $row->lat : "";
                $array_data[] = isset($row->lng) ? $row->lng : "";
                $array_data[] = isset($row->bloodBank_photo) ? 'assets/BloodBank/' . $row->bloodBank_photo : "";

                $array_data[] = isset($row->bloodBank_phn) ? $row->bloodBank_phn : "";
                $finalResult[] = $array_data;
                $array_data = '';
            }

            $option = array('table' => 'bloodBank', 'select' => 'bloodBank_id');
            $deleted = $this->singleDelList($option);
            $response['bloodBank_deleted'] = $deleted;

            if (!empty($finalResult)) {
                $response1['msg'] = 'success';
                $response1['status'] = TRUE;
                $response1['data'] = $finalResult;
                $response1['colName'] = $aoClumns;
                $response1['bloodBank_deleted'] = $deleted;
                $this->response($response1, 200); // 200 being the HTTP response code
            } else {
                $response['msg'] = 'No Blood bank is available at this range. ';
                $response['status'] = FALSE;
                $this->response($response, 401);
            }
        }
    }
}
