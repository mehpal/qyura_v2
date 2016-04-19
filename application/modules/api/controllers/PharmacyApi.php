<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'modules/api/controllers/MyRest.php';

class PharmacyApi extends MyRest {

    function __construct() {
        // Construct our parent class
        parent::__construct();
        $this->load->model(array('pharmacy_model'));
    }

    function pharmacylist_post() {


        $this->form_validation->set_rules('lat', 'Lat', 'xss_clean|trim|required|decimal');
        $this->form_validation->set_rules('long', 'Long', 'xss_clean|trim|required|decimal');
        $this->form_validation->set_rules('isemergency', 'Is Emergency', 'xss_clean|trim|numeric');
        $this->bf_form_validation->set_rules('search', 'Search Keyword', 'xss_clean|trim');
        $this->bf_form_validation->set_rules('cityId', 'cityId', 'xss_clean|trim|numeric|is_natural_no_zero');


        if ($this->form_validation->run() == FALSE) {
            // setup the input
            $message = $this->validation_post_warning();
            $response = array('status' => FALSE, 'msg' => $message);
            $this->response($response, 400);
        } else {


            $lat = isset($_POST['lat']) ? $this->input->post('lat') : '';
            $long = isset($_POST['long']) ? $this->input->post('long') : '';
            $notIn = isset($_POST['notin']) ? $this->input->post('notin') : '';
            $notIn = explode(',', $notIn);
            $isemergency = isset($_POST['isemergency']) ? $this->input->post('isemergency') : NULL;

            // search
            $search = isset($_POST['search']) && $_POST['search'] != '' ? $this->input->post('search') : NULL;

            //city
            $cityId = isset($_POST['cityId']) ? $this->input->post('cityId') : NULL;


            $response['data'] = $this->pharmacy_model->getPhamacyList($lat, $long, $notIn, $isemergency, $search, $cityId);

            $option = array('table' => 'pharmacy', 'select' => 'pharmacy_deleted');
            $deleted = $this->singleDelList($option);
            $response['pharmacy_deleted'] = $deleted;

            $response['colName'] = array("id", "name", "adr", "imUrl", "phn", "lat", "long", "isEmergency");

            if ($response['data']) {
                $response['status'] = TRUE;
                $response['msg'] = 'success';
                $this->response($response, 200);
            } else {
                $response['status'] = False;
                $response['msg'] = 'There is no Pharmacy at this range!';
                $this->response($response, 400);
            }
        }
    }

}
