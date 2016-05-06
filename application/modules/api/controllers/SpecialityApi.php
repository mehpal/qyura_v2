<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'modules/api/controllers/MyRest.php';

class SpecialityApi extends MyRest {

    function __construct() {
        parent::__construct();
        $this->load->model(array('specialityApi_model'));
    }

    function specialities_post() {

        $this->bf_form_validation->set_rules('type', 'type', 'xss_clean|trim|numeric|required');

        if ($this->bf_form_validation->run($this) == FALSE) {
            $message = $this->validation_post_warning();
            $response = array('status' => FALSE, 'msg' => $message);
            $this->response($response, 400);
        } else {

            $miId = (isset($_POST['miID']) && $_POST['miID'] != "") ? $_POST['miID'] : NULL;
            $miType = (isset($_POST['miType']) && $_POST['miType'] != "") ? $_POST['miType'] : NULL;
            $type = (isset($_POST['type']) && $_POST['type'] != "") ? $_POST['type'] : NULL;

            $specialityList = NULL;
            if(($miType != NULL && $miId == NULL) ){
                $message = "Please provide MI Id.";
                $response = array('status' => FALSE, 'msg' => $message);
                $this->response($response, 400);
            }elseif($miType == NULL && $miId != NULL ) {
                $message = "Please provide MI Type.";
                $response = array('status' => FALSE, 'msg' => $message);
                $this->response($response, 400);
            }
            
            if ($miType == 1)
                $specialityList = $this->specialityApi_model->getHosSpecialityList($miId);
            elseif ($miType == 2)
                $specialityList = $this->specialityApi_model->getDiaSpecialityList($miId);
            elseif ($type != NULL)
                $specialityList = $this->specialityApi_model->getSpecialityList($type);

            if (!empty($specialityList) && $specialityList != NULL) {
                $response['specialityList'] = $specialityList;
                $response['status'] = TRUE;
                $response['msg'] = 'success';
                $this->response($response, 200); // 200 being the HTTP response code
            } else {
                $response['status'] = false;
                $response['msg'] = 'There is no speciality yet';
                $this->response($response, 400); // 200 being the HTTP response code
            }
        }
    }

    function specialityList_get() {

        $specialityList = $this->specialityApi_model->getSpecialityList();
// print_r($healpkgDetail); exit;
        if (!empty($specialityList) && $specialityList != NULL) {
            $response['specialityList'] = $specialityList;
            $response['status'] = TRUE;
            $response['msg'] = 'success';
            $this->response($response, 200); // 200 being the HTTP response code
        } else {
            $response['status'] = false;
            $response['msg'] = 'There is no speciality yet';
            $this->response($response, 400); // 200 being the HTTP response code
        }
    }

}
