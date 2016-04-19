<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'modules/api/controllers/MyRest.php';

class DiagonsticType extends MyRest {

    function __construct() {
        // Construct our parent class
        parent::__construct();
        $this->load->model('diagonsticType_model');
    }

    function diagonsticTypeList_post() {

        $this->form_validation->set_rules('diagonsticId','Diagonstic Id','xss_clean|numeric|required|trim');

        if ($this->form_validation->run() == FALSE) {
            // setup the input
            $message = $this->validation_post_warning();
            $response = array('status' => FALSE, 'msg' => $message);
            $this->response($response, 400);
        } else {

            $diagonsticId = $this->input->post('diagonsticId');
            $diagonsticType = $this->diagonsticType_model->diagonsticTypeList($diagonsticId);
            // print_r($healpkgDetail); exit;
            if ($diagonsticType) {
                $response['diagonsticType'] = $diagonsticType;
                $response['status'] = TRUE;
                $response['msg'] = 'success';
                $this->response($response, 200); // 200 being the HTTP response code
            } else {
                $response['status'] = false;
                $response['msg'] = 'There is no Diagonstic Type at this Diagonstic center';
                $this->response($response, 400); // 200 being the HTTP response code
            }
        }
    }

}
