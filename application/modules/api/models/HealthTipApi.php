<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'modules/api/controllers/MyRest.php';

class HealthTipApi extends MyRest {

    function __construct() {
        // Construct our parent class
        parent::__construct();
//        echo "HI    ";
//        exit();
        $this->load->model(array('HealthTip_model'));
    }

    function todaytip_post() {

        $cityId = isset($_POST['cityId']) ? $this->input->post('cityId') : NULL;

       echo $date = strtotime(date("Y-m-d"));       die();
        $sponserTip = NULL;
        if ($cityId != NULL) {
            $sponserTip = $this->HealthTip_model->getSponsorTip($cityId, $date);
        }

        if (isset($sponserTip) && $sponserTip != NULL) {
            $response['status'] = TRUE;
            $response["data"] = $sponserTip;
            $response['msg'] = 'success';
            $this->response($response, 200);
        } else {

            $response['data'] = $sponserTip = $this->HealthTip_model->getRandomTip($date);

            if (isset($sponserTip) && $sponserTip != NULL) {
                $response['status'] = TRUE;
                $response['msg'] = 'success';
                $this->response($response, 200);
            } else {
                $response['status'] = False;
                $response['msg'] = 'There is no healthtip for today!';
                $this->response($response, 400);
            }
        }
    }

}
