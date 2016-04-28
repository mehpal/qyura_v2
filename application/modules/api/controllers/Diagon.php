<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'modules/api/controllers/MyRest.php';

class Diagon extends MyRest {

    function __construct() {
        // Construct our parent class
        parent::__construct();
        $this->load->helper('common_helper');
    }

    function diagonsticlist_post() {


        $this->form_validation->set_rules('lat', 'Lat', 'required|decimal');
        $this->form_validation->set_rules('long', 'Long', 'required|decimal');

        if ($this->form_validation->run() == FALSE) {
            // setup the input
            $message = $this->validation_post_warning();
            $response = array('status' => FALSE, 'msg' => $message);
            $this->response($response, 400);
        } else {


            $lat = isset($_POST['lat']) ? $_POST['lat'] : '';
            $long = isset($_POST['long']) ? $_POST['long'] : '';       
            
            $notIn = isset($_POST['notIn']) ? $_POST['notIn'] : '';
            $notIn = explode(',', $notIn);



                $this->db->select('qyura_users.users_id as id, diagnostic_deleted as fav, diagnostic_deleted as rat, diagnostic_address adr,diagnostic_name name,diagnostic_phn phn, diagnostic_lat lat, diagnostic_long long, qyura_diagnostic.modifyTime upTm, diagnostic_img imUrl, (
                6371 * acos( cos( radians( ' . $lat . ' ) ) * cos( radians( diagnostic_lat ) ) * cos( radians( diagnostic_long ) - radians( ' . $long . ' ) ) + sin( radians( ' . $lat . ' ) ) * sin( radians( diagnostic_lat ) ) )
                ) AS distance, Group_concat(qyura_diagnosticsCat.diagnosticsCat_catName order by diagnosticsCat_catName) as diaCat')

                    ->from('qyura_users')
                    
                    ->join('qyura_diagnostic', 'qyura_users.users_id=qyura_diagnostic.diagnostic_usersId', 'inner')

                    ->join('qyura_diagnosticsHasCat', 'qyura_diagnosticsHasCat.diagnosticsHasCat_diagnosticUserId=qyura_users.users_id','left')
                    
                    ->join('qyura_diagnosticsCat', 'qyura_diagnosticsCat.diagnosticsCat_catId=qyura_diagnosticsHasCat.diagnosticsHasCat_diagnosticsCatId','left')

                    ->where(array('users_deleted' => 0))
                    
                    ->having(array('distance <' => USER_DISTANCE))
                    
                    ->where_not_in('qyura_users.users_id', $notIn)
                    
                    ->order_by('distance' , 'ASC')
                    
                    ->group_by('users_id')
                    
                    ->limit(DATA_LIMIT);

            $response = $this->db->get()->result();
           // echo $this->db->last_query(); die();
            $aoClumns = array("id","fav","rat","adr", "name","phn","lat","lng","upTm","imUrl","diaCat");
            //  print_r($response); die();
            $finalResult = array();
            if (!empty($response)) {                
                foreach ($response as $row) {
                    $finalTemp = array();
                    $finalTemp[] = isset($row->id) ? $row->id : "";
                    $finalTemp[] = isset($row->fav) ? $row->fav : "";
                    $finalTemp[] = isset($row->rat) ? $row->rat : "";
                    $finalTemp[] = isset($row->adr) ? $row->adr : "";
                    $finalTemp[] = isset($row->name) ? $row->name : "";
                    $finalTemp[] = isset($row->phn) ? $row->phn : "";
                    $finalTemp[] = isset($row->lat) ? $row->lat : "";
                    $finalTemp[] = isset($row->long) ? $row->long : "";
                    $finalTemp[] = isset($row->upTm) ? $row->upTm : "";
                    $finalTemp[] = isset($row->imUrl) ? base_url().'assets/diagnosticsImage/'.$row->imUrl : "";
                    $finalTemp[] = isset($row->diaCat) ? $row->diaCat : "";
                    $finalResult[] = $finalTemp;
                    
                }
            }

            if (!empty($finalResult)) {
                $finalStatus['msg'] = 'Recored found!';
                $finalStatus['status'] = TRUE;
                $finalStatus['colName'] = $aoClumns;
                $finalStatus['data'] = $finalResult;
                $this->response($finalStatus, 200); // 200 being the HTTP response code
            } else {
                $finalStatus['msg'] = 'No diagnostic centres is available at this range!';
                $finalStatus['status'] = FALSE;
                $this->response($finalStatus, 404);
            }
        }
    }

}
