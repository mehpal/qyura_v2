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

        $this->form_validation->set_rules('cityId', 'City id', 'xss_clean|trim|required');

        if ($this->form_validation->run() == FALSE) {
            // setup the input
            $message = $this->validation_post_warning();
            $response = array('status' => FALSE, 'msg' => $message);
            $this->response($response, 400);
        } else {

            $cityId = isset($_POST['cityId']) ? $this->input->post('cityId') : '';
            $date = date("Y-m-d");
            $sponserTip = $this->HealthTip_model->getSponsorTip($cityId,$date);
            
            if(isset($sponserTip) && $sponserTip != NULL){
                $response['status'] = TRUE;
                $response["result"] = $sponserTip;
                $response['msg'] = 'success';
                $this->response($response, 200);
            }else{
                
                 $response['data'] = $sponserTip = $this->HealthTip_model->getRandomTip($date);
                
                if(isset($sponserTip) && $sponserTip != NULL){
                    $response['status'] = TRUE;
                    $response['msg'] = 'success';
                    $this->response($response, 200);
                }else{
                    $response['status'] = False;
                    $response['msg'] = 'There is no healthtip for today!';
                    $this->response($response, 400);
                }
            }
        }
    }  
}
