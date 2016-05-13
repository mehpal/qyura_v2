<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'modules/api/controllers/MyRest.php';

class HospitalDocCounsultaion extends MyRest {

    function __construct() {

        parent::__construct();
        $this->load->model(array('hospitalDocCounsultaion_model'));
        $this->load->helper('common_helper');
    }

    function hosConsultantList_post() {
         
        $this->bf_form_validation->set_rules('hospitalUserId','Hospital User Id','xss_clean|numeric|required|trim');
        $this->bf_form_validation->set_rules('specialityid', 'Speciality Id', 'xss_clean|trim|numeric|required');
        $this->bf_form_validation->set_rules('notin', 'Not In', 'xss_clean|trim|required');
        $this->bf_form_validation->set_rules('search ', 'Search Keyword', 'xss_clean|trim');
        
        if ($this->bf_form_validation->run($this) == FALSE) {
            // setup the input
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);
        } else { 
            
            $hospitalUserId = $this->input->post('hospitalUserId');
            $specialityId = $this->input->post('specialityid');
            $notIn = isset($_POST['notin']) && $_POST['notin'] != 0 ? $this->input->post('notin') : '';
            $notIn = explode(',', $notIn);
            
            // search
            $search = isset($_POST['search']) && $_POST['search'] != ''  ? $this->input->post('search') : NULL;
            
            $response['colName'] = array("id","showExp", "name", "exp", "imUrl","rating","consFee", "speciality", "degree","isEmergency");
            $consultantList = $this->hospitalDocCounsultaion_model->getConsultantList($notIn,$hospitalUserId,$specialityId, $search);
            
            if ($consultantList) {
                $response['consultantList'] = $consultantList;
                $response['status'] = TRUE;
                $response['msg'] = 'success';
                $this->response($response, 200); // 200 being the HTTP response code
            } else {
                $response['status'] = false;
                $response['msg'] = 'No Doctor Consultant is available at this Hospital';
                $this->response($response, 400); // 200 being the HTTP response code
            }
        }
    }
    
}
