<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'modules/api/controllers/MyRest.php';

class DiagonsticHealthPkg extends MyRest {

    function __construct() {

        parent::__construct();
        $this->load->model(array('diagonsticHealthPkg_model'));
    }

    function healpkgDetail_post() {
        $this->form_validation->set_rules('diagonsticId','Diagonstic Id','xss_clean|numeric|required|trim');
        $this->form_validation->set_rules('healthPkgId', 'Health Package Id', 'xss_clean|numeric|required|trim');
        if ($this->form_validation->run($this) == FALSE) {
            // setup the input
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);
        } else {
            $diagonsticId = $this->input->post('diagonsticId');
            $healthPkgId = $this->input->post('healthPkgId');
            $healpkgDetail = $this->diagonsticHealthPkg_model->getHealpkgDetail($diagonsticId,$healthPkgId);
           // print_r($healpkgDetail); exit;
            if ($healpkgDetail) {
                $response['healthPkgDetail'] = $this->diagonsticHealthPkg_model->getDiagonHelthPkg($diagonsticId,$healthPkgId);
                $response['healthPkgTest'] = $healpkgDetail;
                $response['status'] = TRUE;
                $response['msg'] = 'success';
                $this->response($response, 200); // 200 being the HTTP response code
            } else {
                $response['status'] = false;
                $response['msg'] = 'There is no Test available at this Health Package List!';
                $this->response($response, 400); // 200 being the HTTP response code
            }
        }
    }

}
