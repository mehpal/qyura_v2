<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'modules/api/controllers/MyRest.php';

class HospitalDiagonsticType extends MyRest {

    function __construct() {
        // Construct our parent class
        parent::__construct();
        $this->load->model('hospitalDiagonsticType_model');
    }

    function diagonsticType_post() {

        $this->form_validation->set_rules('hospitalId','Hospital Id','xss_clean|numeric|required|trim');

        if ($this->form_validation->run() == FALSE) {
            // setup the input
            $message = $this->validation_post_warning();
            $response = array('status' => FALSE, 'msg' => $message);
            $this->response($response, 400);
        } else {

            $hospitalId = $this->input->post('hospitalId');
            $diagonsticType = $this->hospitalDiagonsticType_model->diagonsticTypeList($hospitalId);
//            echo $this->db->last_query();
//             print_r($diagonsticType); exit;
            if ($diagonsticType) {
                $response['diagonsticType'] = $diagonsticType;
                $response['status'] = TRUE;
                $response['msg'] = 'success';
                $this->response($response, 200); // 200 being the HTTP response code
            } else {
                $response['status'] = false;
                $response['msg'] = 'There is no Diagonstic Type at this Hospital!';
                $this->response($response, 400); // 200 being the HTTP response code
            }
        }
    }

}
