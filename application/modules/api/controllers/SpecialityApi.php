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

            $miId = (isset($_POST['miID']) && $_POST['miID'] != "") ? $_POST['miID'] : NULL; // USER ID OF HOSPI / Diagno
            $type = (isset($_POST['type']) && $_POST['type'] != "") ? $_POST['type'] : NULL;
            $commonPlace = (isset($_POST['commonPlace']) && $_POST['commonPlace'] != "") ? $_POST['commonPlace'] : NULL;

            $specialityList = NULL;

            if ($commonPlace != NULL) {
                $specialityList = $this->specialityApi_model->getMISpeciality();
            }else{
                if ($miId != NULL)
                    $specialityList = $this->specialityApi_model->getDocSpecialityList($miId);
                else
                    $specialityList = $this->specialityApi_model->getSpecialityList($type);
        }
            
            
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
