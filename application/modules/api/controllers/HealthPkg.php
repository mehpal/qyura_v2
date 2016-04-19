<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'modules/api/controllers/MyRest.php';

class HealthPkg extends MyRest {

    function __construct() {

        parent::__construct();
        $this->load->model(array('healthpkg_model'));
    }

    function healpkgDetail_post() {
        $this->form_validation->set_rules('hospitalId','Hospital Id','xss_clean|numeric|required|trim');
        $this->form_validation->set_rules('healthPkgId', 'Health Package Id', 'xss_clean|numeric|required|trim');
        if ($this->form_validation->run($this) == FALSE) {
            // setup the input
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);
        } else {
            $hospitalId = $this->input->post('hospitalId');
            $healthPkgId = $this->input->post('healthPkgId');
            $healpkgDetail = $this->healthpkg_model->getHealpkgDetail($hospitalId,$healthPkgId);
           // print_r($healpkgDetail); exit;
            if ($healpkgDetail) {
                $response['healthPkgDetail'] = $this->healthpkg_model->getHosHelthPkg($hospitalId,$healthPkgId);
                $response['healthPkgTest'] = $healpkgDetail;
                $response['status'] = TRUE;
                $response['msg'] = 'success';
                $this->response($response, 200); // 200 being the HTTP response code
            } else {
                $response['status'] = false;
                $response['msg'] = 'There is no Test available at this Health Package!';
                $this->response($response, 400); // 200 being the HTTP response code
            }
        }
    }

}
