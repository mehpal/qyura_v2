<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'modules/api/controllers/MyRest.php';

class Insurance extends MyRest {

    function __construct() {

        parent::__construct();
        $this->load->model(array('my_model'));
    }

    function list_get() {
        $option = array(
            'table' => 'qyura_insurance',
            'select' => 'insurance_id,insurance_Name,insurance_type,CONCAT("assets/insurance","/",insurance_img) as img,insurance_detail',
            'where' => array('insurance_deleted' => 0),
            'order' => array('insurance_Name' => 'DESC')
        );

        $insurances = $this->common_model->customGet($option);

        if ($insurances) {
            $finalResult = array();
            $colName = array("insurance_id","insurance_Name", "insurance_type", "img", "insurance_detail");
            foreach ($insurances as $insurance) {
                $finalTemp = array();
                $finalTemp[] = isset($insurance->insurance_id) ? $insurance->insurance_id : "";
                $finalTemp[] = isset($insurance->insurance_Name) ? $insurance->insurance_Name : "";
                $finalTemp[] = isset($insurance->insurance_type) ? $insurance->insurance_type : "";
                $finalTemp[] = isset($insurance->img) ? $insurance->img : "";
                $finalTemp[] = isset($insurance->insurance_detail) ? $insurance->insurance_detail : "";
                $finalResult[] = $finalTemp;
            }
            $response = array('status' => TRUE, 'message' => 'success', 'insurances' => $insurances, 'colName' => $colName);
            $this->response($response, 200);
        } else {
            $response = array('status' => FALSE, 'message' => 'No insurance company tie-up with us');
            $this->response($response, 400);
        }
    }

    function add_post() {

        $this->bf_form_validation->set_rules('insId', 'Insurance Id', 'xss_clean|trim|required|numeric|is_natural_no_zero');
        $this->bf_form_validation->set_rules('userId', 'userId', 'xss_clean|trim|required|numeric|max_length[20]|is_natural_no_zero|_user_check');
        $this->bf_form_validation->set_rules('familyId', 'Mobile No', 'xss_clean|trim|numeric|max_length[11]|is_natural_no_zero');
        $this->bf_form_validation->set_rules('insNo', 'Insurance Number', 'xss_clean|trim|max_length[20]|is_unique[qyura_userInsurance.userInsurance_insuranceNo,qyura_userInsurance.userInsurance_deleted=0]');
        $this->bf_form_validation->set_rules('expDate', 'Expiry Date', 'xss_clean|trim|max_length[10]|valid_date[y-m-d,-]|callback__check_date');

        if ($this->bf_form_validation->run($this) == FALSE) {
            // setup the input
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);
        } else {

            $insId = isset($_POST['insId']) ? $this->input->post('insId') : '';
            $userId = isset($_POST['userId']) ? $this->input->post('userId') : '';
            $familyId = isset($_POST['familyId']) ? $this->input->post('familyId') : '';
            $insNo = isset($_POST['insNo']) ? $this->input->post('insNo') : '';
            $expDate = isset($_POST['expDate']) ? $this->input->post('expDate') : '';

            $option = array(
                'data' => array(
                    'userInsurance_usersId' => $userId,
                    'userInsurance_insuranceId' => $insId,
                    'userInsurance_familyId' => $familyId,
                    'userInsurance_insuranceNo' => $insNo,
                    'userInsurance_expDate' => strtotime($expDate),
                    'creationTime' => time()
                ),
                'table' => 'qyura_userInsurance'
            );

            $isInsert = $this->common_model->customInsert($option);

            if ($isInsert) {
                $response = array('status' => TRUE, 'message' => 'Successfully added Insurance Card');
                $this->response($response, 200);
            } else {
                $response = array('status' => FALSE, 'message' => 'Error in add record');
                $this->response($response, 400);
            }
        }
    }

    function edit_post() {

        $message = 'The value in &quot;%s&quot; is already being used....';
        $erOption = array(
            'select' => 'userInsurance_insuranceNo as insuranceNo',
            'table' => 'qyura_userInsurance',
            'where' => array('userInsurance_insuranceNo' => isset($_POST['insNo']) ? $_POST['insNo'] : '', 'userInsurance_deleted' => 0, 'userInsurance_id <>' => isset($_POST['id']) ? $_POST['id'] : ''),
            'limit' => 1,
            'single' => true,
            'message' => $message
        );

        $Moption = json_encode($erOption);

        $this->bf_form_validation->set_rules('id', 'My Insurance Id', 'xss_clean|trim|required|numeric|is_natural_no_zero');
        $this->bf_form_validation->set_rules('insId', 'Insurance Id', 'xss_clean|trim|required|numeric|is_natural_no_zero');
        $this->bf_form_validation->set_rules('userId', 'userId', 'xss_clean|trim|required|numeric|max_length[20]|is_natural_no_zero|_user_check');
        $this->bf_form_validation->set_rules('familyId', 'Mobile No', 'xss_clean|trim|numeric|max_length[11]|is_natural_no_zero');
        $this->bf_form_validation->set_rules('insNo', 'Insurance Number', "xss_clean|trim|max_length[20]|required|MUnique[{$Moption}]");
        $this->bf_form_validation->set_rules('expDate', 'Expiry Date', 'xss_clean|trim|max_length[10]|valid_date[y-m-d,-]|callback__check_date');

	
        if ($this->bf_form_validation->run($this) == FALSE) {
            // setup the input
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);
        } else {

            $id = isset($_POST['id']) ? $this->input->post('id') : '';
            $insId = isset($_POST['insId']) ? $this->input->post('insId') : '';
            $userId = isset($_POST['userId']) ? $this->input->post('userId') : '';
            $familyId = isset($_POST['familyId']) ? $this->input->post('familyId') : '';
            $insNo = isset($_POST['insNo']) ? $this->input->post('insNo') : '';
            $expDate = isset($_POST['expDate']) ? $this->input->post('expDate') : '';

            $updateOption = array(
                'data' => array(
                    'userInsurance_usersId' => $userId,
                    'userInsurance_insuranceId' => $insId,
                    'userInsurance_familyId' => $familyId,
                    'userInsurance_insuranceNo' => $insNo,
                    'userInsurance_expDate' => strtotime($expDate),
                    'modifyTime' => time()
                ),
                'table' => 'qyura_userInsurance',
                'where' => array('userInsurance_id' => $id)
            );

            
            $isUpdate = $this->common_model->customUpdate($updateOption);
            
            


            if ($isUpdate || TRUE) {
                $response = array('status' => TRUE, 'message' => 'Successfully update Insurance Card');
                $this->response($response, 200);
            } else {
                $response = array('status' => TRUE, 'message' => 'No changes in card information');
                $this->response($response, 400);
            }
        }
    }

    function myInsurance_post() {


        $this->bf_form_validation->set_rules('userId', 'userId', 'xss_clean|trim|required|numeric|max_length[20]|is_natural_no_zero|_user_check');


        if ($this->bf_form_validation->run($this) == FALSE) {
            // setup the input
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);
        } else {

            $userId = isset($_POST['userId']) ? $this->input->post('userId') : '';

            $option = array(
                'select' => 'qyura_patientDetails.patientDetails_patientName,qyura_insurance.insurance_id,userInsurance_id,userInsurance_usersId as usersId,userInsurance_insuranceId as insuranceId, userInsurance_familyId as familyId, userInsurance_insuranceNo as insuranceNo, userInsurance_expDate as expDate,qyura_familyRelation.relation_type, CASE 
 WHEN (`userInsurance_familyId` = 0 ) 
 THEN
      "self"
 ELSE qyura_familyRelation.relation_type
 END AS `relation`,CASE 
 WHEN (`userInsurance_familyId` = 0 ) 
 THEN
      qyura_patientDetails.patientDetails_patientName
 ELSE qyura_usersFamily.usersfamily_name
 END AS `name`,qyura_insurance.insurance_Name',
                'table' => 'qyura_userInsurance',
                'join' => array(
                    array('qyura_insurance', 'qyura_insurance.insurance_id=qyura_userInsurance.userInsurance_usersId', 'left'),
                    array('qyura_usersFamily', 'qyura_usersFamily.usersfamily_id=qyura_userInsurance.userInsurance_familyId', 'left'),
                    
                    array('qyura_familyRelation', 'qyura_usersFamily.usersfamily_relationId=qyura_familyRelation.relation_id', 'left'),
                    array('qyura_users', 'qyura_users.users_id=qyura_userInsurance.userInsurance_usersId', 'left'),
                    array('qyura_patientDetails', 'qyura_patientDetails.patientDetails_usersId=qyura_users.users_id', 'left'),
                ),
                'where' => array('qyura_userInsurance.userInsurance_usersId' => $userId,'qyura_userInsurance.userInsurance_deleted'=>0),
            );

            $myInsurances = $this->common_model->customGet($option);
            
            
            if ($myInsurances) {
                $finalResult = array();
                $aoClumns = array("userInsuranceId","insurance_id", "usersId", "familyId", "insuranceNo", "expDate", "relation", "name","insurance_Name");
                foreach ($myInsurances as $myInsurance) {
                    $finalTemp = array();
                    
                    $finalTemp[] = isset($myInsurance->userInsurance_id) ? $myInsurance->userInsurance_id : "";
                    $finalTemp[] = isset($myInsurance->insurance_id) ? $myInsurance->insurance_id : "";
                    $finalTemp[] = isset($myInsurance->usersId) ? $myInsurance->usersId : "";
                    $finalTemp[] = isset($myInsurance->familyId) ? $myInsurance->familyId : "";
                    $finalTemp[] = isset($myInsurance->insuranceNo) ? $myInsurance->insuranceNo : "";
                    $finalTemp[] = isset($myInsurance->expDate) ? $myInsurance->expDate : "";
                    $finalTemp[] = isset($myInsurance->relation) ? $myInsurance->relation : "";
                    $finalTemp[] = isset($myInsurance->name) ? $myInsurance->name : "";
                    $finalTemp[] = isset($myInsurance->insurance_Name) ? $myInsurance->insurance_Name : "";
                    
                    $finalResult[] = $finalTemp;
                }

                $response = array('status' => TRUE, 'message' => 'Success', 'clumns' => $aoClumns, 'result' => $finalResult);
                $this->response($response, 200);
            } else {

                $response = array('status' => FALSE, 'message' => 'Record does not exist');
                $this->response($response, 400);
            }
        }
    }
    
    function removeMyIns_post() {

        $this->bf_form_validation->set_rules('id', 'My Insurance Id', 'xss_clean|trim|required|numeric|is_natural_no_zero');

        if ($this->bf_form_validation->run($this) == FALSE) {
            // setup the input
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);

        } else {

            $id = isset($_POST['id']) ? $this->input->post('id') : '';
            
            $delOption = array(
                'table' => 'qyura_userInsurance',
                'data'=>array(
                    'userInsurance_deleted'=>1
                ),
                'where' => array('userInsurance_id' => $id)
            );
            
            $isRemove = $this->common_model->customUpdate($delOption);
           // print_r($favList); exit;
            if ($isRemove || true) {
                $response = array('status' => TRUE, 'message' => 'Remove successfully');
                $this->response($response, 200);

            } else {

                $response = array('status' => FALSE, 'message' => 'Some thing wrong!' );
                $this->response($response, 400);

            }
        }
    }

    function _check_date($str_in = '') {
        $expDate = strtotime($str_in);

        if ($this->time > $expDate) {
            $this->bf_form_validation->set_message('_check_date', 'Expiry Date is greater than current date');

            return FALSE;
        }

        return TRUE;
    }

}
