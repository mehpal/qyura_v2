<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'modules/api/controllers/MyRest.php';

class HospitalApi extends MyRest {

    function __construct() {
        // Construct our parent class
        parent::__construct();
        $this->load->model(array('hospital_model'));
    }

    function hospitalTimeSlot_post() {
        $this->bf_form_validation->set_rules('hospitalId', 'hospitalId', 'xss_clean|numeric|required|trim');
        if ($this->bf_form_validation->run($this) == FALSE) {
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);
        } else {
            $hospitalId = $this->input->post('hospitalId');
            $options = array(
                'table' => 'qyura_hospitalTimeSlot',
                'where' => array('qyura_hospitalTimeSlot.hospitalTimeSlot_deleted' => 0, 'qyura_hospitalTimeSlot.hospitalTimeSlot_hospitalId' => $hospitalId),
            );
            $hospitalTimeSlot = $this->common_model->customGet($options);
            $response = array();
            if (isset($hospitalTimeSlot) && $hospitalTimeSlot != NULL) {
                foreach ($hospitalTimeSlot as $hospitalTime) {
                    $timeSlot = array();
                    $timeSlot[] = $hospitalTime->hospitalTimeSlot_id;
                    $timeSlot[] = $hospitalTime->hospitalTimeSlot_startTime;
                    $timeSlot[] = $hospitalTime->hospitalTimeSlot_endTime;
                    $timeSlot[] = getSession($hospitalTime->hospitalTimeSlot_sessionType);
                    $response[] = $timeSlot;
                }
            }

            $columns = array('h_timeSlotid', 'h_startTime', 'h_endTime', 'h_sessionType');
            if (!empty($response) && $response != NULL) {
                $response = array('status' => TRUE, 'message' => ' Time Slot!', 'data' => $response, 'columns' => $columns);
                $this->response($response, 200);
            } else {
                $response = array('status' => FALSE, 'message' => 'There is no time slot yet!');
                $this->response($response, 400);
            }
        }
    }

    function hospitallist_post() {

        $this->bf_form_validation->set_rules('lat', 'Lat', 'xss_clean|trim|required|decimal');
        $this->bf_form_validation->set_rules('long', 'Long', 'xss_clean|trim|required|decimal');
        $this->bf_form_validation->set_rules('isemergency', 'Is Emergency', 'xss_clean|trim|numeric');
        $this->bf_form_validation->set_rules('radius', 'Radius', 'xss_clean|trim|numeric');
        $this->bf_form_validation->set_rules('isAmbulance', 'Is Ambulance', 'xss_clean|trim|numeric');
        $this->bf_form_validation->set_rules('isInsurance', 'Is Insurance', 'xss_clean|trim'); 
        $this->bf_form_validation->set_rules('rating', 'Rating', 'xss_clean|trim|numeric');
        $this->bf_form_validation->set_rules('notin', 'Not In', 'xss_clean|trim|required');
        $this->bf_form_validation->set_rules('userId', 'User Id', 'xss_clean|trim');
        $this->bf_form_validation->set_rules('search ', 'Search Keyword', 'xss_clean|trim');
        $this->bf_form_validation->set_rules('cityId', 'cityId', 'xss_clean|trim|numeric|is_natural_no_zero');

        if ($this->bf_form_validation->run($this) == FALSE) {
            // setup the input
            $message = $this->validation_post_warning();
            $response = array('status' => FALSE, 'msg' => $message);
            $this->response($response, 400);
        } else {


            $lat = isset($_POST['lat']) ? $this->input->post('lat') : '';
            $long = isset($_POST['long']) ? $this->input->post('long') : '';
            $userId = isset($_POST['userId']) && $_POST['userId'] != null && $_POST['userId'] != 0 ? $this->input->post('userId') : 0;

            $notIn = isset($_POST['notin']) && $_POST['notin'] != 0 ? $this->input->post('notin') : '';
            $notIn = explode(',', $notIn);

            // search
            $search = isset($_POST['search']) && $_POST['search'] != '' ? $this->input->post('search') : NULL;
            //city
            $cityId = isset($_POST['cityId']) ? $this->input->post('cityId') : NULL;

            $isemergency = isset($_POST['isemergency']) ? $this->input->post('isemergency') : NULL;
            
            $openNow = isset($_POST['openNow']) ? $this->input->post('openNow') : NULL;

            // filtration parameter
            $radius = isset($_POST['radius']) ? $this->input->post('radius') : 70;
            $rating = isset($_POST['rating']) ? $this->input->post('rating') : NULL; // 0 for All 4 for 4+
            $isAmbulance = isset($_POST['isAmbulance']) ? $this->input->post('isAmbulance') : NULL;
            $isInsurance = (isset($_POST['isInsurance']) && $_POST['isInsurance'] != 0) ? $this->input->post('isInsurance') : "";
       

            $response['data'] = $this->hospital_model->getHospitalList($lat, $long, $notIn, $isemergency, $radius, $isAmbulance, $isInsurance,   $rating, $userId, $search, $cityId, $openNow);

            $option = array('table' => 'hospital', 'select' => 'hospital_id');
            $deleted = $this->singleDelList($option);
            $response['hos_deleted'] = $deleted;

            $response['colName'] = array("id", "fav", "rat", "adr", "name", "phn", "lat", "lng", "upTm", "imUrl", "specialities", "isEmergency", "isAmbulance", "healpkgCount", "insuranceCount", "userId", "insurance");

            if ($response['data']) {
                $response['status'] = TRUE;
                $response['msg'] = 'success';
                $this->response($response, 200);
            } else {
                $response['status'] = False;
                $response['msg'] = 'There is no hospital at this range!';
                $this->response($response, 400);
            }
        }
    }

    function hospitaldetail_post() {
        $this->bf_form_validation->set_rules('hospitalId', 'Hospital Id', 'xss_clean|numeric|required|trim');

        if ($this->bf_form_validation->run($this) == FALSE) {
            // setup the input
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);
        } else {
            $hospitalId = $this->input->post('hospitalId');
            $hospitalDetails = $this->hospital_model->getHosDetails($hospitalId);

            if ($hospitalDetails) {
                $response['hosDetails'] = $hospitalDetails;
 
                $response['isAmbulance'] = $isAmbulance = $this->hospital_model->isAmbulance($hospitalDetails->hospital_usersId);
 
                $response['services'] = $services = $this->hospital_model->getHosServices($hospitalId);

                $response['specialities'] = $specialities = $this->hospital_model->getHosSpecialities($hospitalId);

                $response['hosHelthPkg'] = $hosHelthPkg = $this->hospital_model->getHosHelthPkg($hospitalId);

                $response['reviewCount'] = $reviewCount = $this->hospital_model->getHosReviewCount($hospitalDetails->hospital_usersId);
                $response['rating'] = $this->hospital_model->getHosAvgRating($hospitalDetails->hospital_usersId);

                $response['hosDoctors'] = $hosDoctors = $this->hospital_model->getHosDoctors($hospitalId, $hospitalDetails->hospital_usersId);

                $response['hosDiagnosticsCat'] = $hosDiagnostics = $this->hospital_model->getDiagnosticsCat($hospitalId);

                $response['awards'] = $hosAwards = $this->hospital_model->getHosAwards($hospitalId);

                $response['hosInsurance'] = $osInsurance = $this->hospital_model->getHosInsurance($hospitalId);
                
                $miTimeSlot = $this->hospital_model->miTimeSlot($hospitalDetails->hospital_usersId);
                
                $response['openingHours'] = (isset($miTimeSlot->openingHours) && $miTimeSlot->openingHours != NULL) ? $miTimeSlot->openingHours : "";
                $response['closingHours'] = (isset($miTimeSlot->closingHours) && $miTimeSlot->closingHours != NULL) ? $miTimeSlot->closingHours : "";

                $response['status'] = TRUE;
                $response['msg'] = 'success';
                $this->response($response, 200); // 200 being the HTTP response code
            } else {
                $response['status'] = false;
                $response['msg'] = 'No Hospital is available at this Id';
                $this->response($response, 400); // 200 being the HTTP response code
            }
        }
    }

}
