<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'modules/api/controllers/MyRest.php';

class HospitalAndDiagonstic extends MyRest {

    function __construct() {

        parent::__construct();
        $this->load->model(array('hospitalAndDiagonstic_model'));
    }

    function hosDiagonList_post() {
        $this->bf_form_validation->set_rules('lat', 'Lat', 'xss_clean|trim|required|decimal');
        $this->bf_form_validation->set_rules('long', 'Long', 'xss_clean|trim|required|decimal');
        $this->bf_form_validation->set_rules('specialityid', 'Speciality Id', 'xss_clean|trim|numeric|required');
        $this->bf_form_validation->set_rules('userId', 'User Id', 'xss_clean|trim');
        $this->bf_form_validation->set_rules('search ', 'Search Keyword', 'xss_clean|trim');
        $this->bf_form_validation->set_rules('cityId', 'cityId', 'xss_clean|trim|numeric|is_natural_no_zero');
        
        // filter parameter
        $this->bf_form_validation->set_rules('isemergency', 'Is Emergency', 'xss_clean|trim|numeric');
        $this->bf_form_validation->set_rules('isAmbulance', 'Is Ambulance', 'xss_clean|trim|numeric');
        $this->bf_form_validation->set_rules('rating', 'Rating', 'xss_clean|trim|numeric');
        $this->bf_form_validation->set_rules('isInsurance', 'Is Insurance', 'xss_clean|trim');
        $this->bf_form_validation->set_rules('openNow', 'Open Now', 'xss_clean|trim');
        $this->bf_form_validation->set_rules('radius', 'Radius', 'xss_clean|trim|numeric');
        $this->bf_form_validation->set_rules('notin', 'Not In', 'xss_clean|trim');
        
        if ($this->bf_form_validation->run($this) == FALSE) {
            // setup the input
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);
        } else {

            $lat = isset($_POST['lat']) ? $this->input->post('lat') : '';
            $long = isset($_POST['long']) ? $this->input->post('long') : '';

            $notIn = isset($_POST['notin']) ? $this->input->post('notin') : '';
            $notIn = explode(',', $notIn);

            $specialityid = isset($_POST['specialityid']) ? $this->input->post('specialityid') : NULL;
            
             // search
            $search = isset($_POST['search']) && $_POST['search'] != ''  ? $this->input->post('search') : NULL; 
            
            //city
            $cityId = isset($_POST['cityId']) ? $this->input->post('cityId') : NULL;
            
            $userId = isset($_POST['userId']) && $_POST['userId'] != null && $_POST['userId'] !=0 ? $this->input->post('userId') : 0;
            
            // filter value
             // filtration parameter
            $radius = isset($_POST['radius']) ? $this->input->post('radius') : 70;
            $rating = isset($_POST['rating']) ? $this->input->post('rating') : NULL; // 0 for All 4 for 4+
            $isAmbulance = isset($_POST['isAmbulance']) ? $this->input->post('isAmbulance') : NULL;
            $isInsurance = (isset($_POST['isInsurance']) && $_POST['isInsurance'] != 0) ? $this->input->post('isInsurance') : "";
            $openNow = isset($_POST['openNow']) ? $this->input->post('openNow') : NULL;
            $isemergency = isset($_POST['isemergency']) ? $this->input->post('isemergency') : NULL;
            
            
            $hosDiagonList = $this->hospitalAndDiagonstic_model->getHosDiagonList($lat, $long, $notIn, $specialityid, $userId, $search, $cityId, $radius, $isemergency,  $isAmbulance, $isInsurance,   $rating, $openNow);
            
            $aoClumns = array("isAmbulance","totalHealtPkg","totalInsurance","isEmergency","id", "userId", "type", "fav","rat","adr", "name","phn","lat","lng", "imUrl", "facility");
            // print_r($diagonList); exit;
            if ($hosDiagonList) {
                $response['hosDiagonList'] = $hosDiagonList;
                $response['column'] = $aoClumns;
                $response['status'] = TRUE;
                $response['msg'] = 'success';
                $this->response($response, 200); // 200 being the HTTP response code
            } else {
                $response['status'] = false;
                $response['msg'] = 'There is no hospital or diagonstic center at this speciality!';
                $this->response($response, 400); // 200 being the HTTP response code
            }
        }
    }

}
