<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'modules/api/controllers/MyRest.php';

class DoctorApi extends MyRest {

    function __construct() {
        // Construct our parent class
        parent::__construct();
        $this->load->helper('common_helper');
        $this->load->model(array('doctors_model'));
    }

    function doctorlist_post() {

        $this->bf_form_validation->set_rules('lat', 'Lat', 'xss_clean|trim|required|decimal');
        $this->bf_form_validation->set_rules('long', 'Long', 'xss_clean|trim|required|decimal');
        $this->bf_form_validation->set_rules('specialityid', 'Speciality Id', 'xss_clean|trim|numeric|required');
        $this->bf_form_validation->set_rules('isemergency', 'Is Emergency', 'xss_clean|trim|numeric');
        $this->bf_form_validation->set_rules('rating', 'Rating', 'xss_clean|trim|numeric');
        $this->bf_form_validation->set_rules('exp', 'Experience', 'xss_clean|trim');
        $this->bf_form_validation->set_rules('notin', 'Not in', 'xss_clean|trim|required');
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

            $specialityid = isset($_POST['specialityid']) && $_POST['specialityid'] != 0 ? $this->input->post('specialityid') : NULL;
            $isemergency = isset($_POST['isemergency']) ? $this->input->post('isemergency') : NULL;

            // search
            $search = isset($_POST['search']) && $_POST['search'] != '' ? $this->input->post('search') : NULL;

            //city
            $cityId = isset($_POST['cityId']) ? $this->input->post('cityId') : NULL;

            // filtration parameter
            $radius = isset($_POST['radius']) ? $this->input->post('radius') : 70;
            $rating = isset($_POST['rating']) ? $this->input->post('rating') : NULL;
            $exp = isset($_POST['exp']) ? $this->input->post('exp') : NULL;

            $notIn = isset($_POST['notin']) && $_POST['notin'] != 0 ? $this->input->post('notin') : '';
            $notIn = explode(',', $notIn);

            $response['data'] = $this->doctors_model->getDoctorsList($lat, $long, $notIn, $isemergency, $specialityid, $radius, $rating, $exp, $search, $cityId);

            $option = array('table' => 'doctors', 'select' => 'doctors_id');
            $deleted = $this->singleDelList($option);
            $response['doc_deleted'] = $deleted;

            $response['colName'] = array("id", "name", "showExp", "exp", "imUrl", "rating", "consFee", "speciality", "degree", "lat", "long", "isEmergency", "mobile", "userId");
            if ($response['data']) {
                $response['status'] = TRUE;
                $response['msg'] = 'success';
                $this->response($response, 200);
            } else {
                $response['status'] = FALSE;
                $response['msg'] = 'There is no Doctor at this range!';
                $this->response($response, 400);
            }
        }
    }

    function doctordetail_post() {

        $this->bf_form_validation->set_rules('doctorId', 'DoctorId Id', 'xss_clean|numeric|required|trim');
        $this->bf_form_validation->set_rules('lat', 'latitude', 'xss_clean|numeric|required|trim');
        $this->bf_form_validation->set_rules('long', 'laongitude', 'xss_clean|numeric|required|trim');
        $this->bf_form_validation->set_rules('userId', 'User Id', 'xss_clean|trim');

        if ($this->bf_form_validation->run($this) == FALSE) {
            // setup the input
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);
        } else {

            $doctorId = $this->input->post('doctorId');
            $lat = $this->input->post('lat');
            $long = $this->input->post('long');

            $userId = isset($_POST['userId']) && $_POST['userId'] != null && $_POST['userId'] != 0 ? $this->input->post('userId') : 0;
            $doctorsDetails = $this->doctors_model->getDoctorsDetails($doctorId, $userId);
//            echo $this->db->last_query();
//         dump($doctorsDetails);die();
            if (!empty($doctorsDetails['id']) && $doctorsDetails['id'] != '') {

                $response['docDetails'] = $doctorsDetails;

                $response['services'] = $services = $this->doctors_model->getDoctorServices($doctorId);

                $response['reviewCount'] = $reviewCount = $this->doctors_model->getDoctorNumReviews($doctorsDetails['userId']);

                $response['review'] = $this->doctors_model->getDoctorReviews($doctorsDetails['userId']);

                $response['availability'] = $this->doctors_model->getDoctorTimeSlot($doctorsDetails['id'], $lat, $long);

                $response['status'] = TRUE;
                $response['msg'] = 'success';
                $this->response($response, 200); // 200 being the HTTP response code
            } else {
                $response['status'] = false;
                $response['msg'] = 'No Doctor is available at this Id';
                $this->response($response, 400); // 200 being the HTTP response code
            }
        }
    }

    public function timeslot_post() {
        $this->bf_form_validation->set_rules('doctorId', 'Doctor UserId', 'xss_clean|numeric|required|trim');
        if ($this->bf_form_validation->run() == FALSE) {
            // setup the input
            $message = $this->validation_post_warning();
            $response = array('status' => FALSE, 'msg' => $message);
            $this->response($response, 400);
        } else {
            $id = $this->input->post('doctorId');
            $timeSlot = $this->doctors_model->getDoctorTimeSlot($id);
            if (!empty($timeSlot) && $timeSlot != NULL) {
                $response['doctorTimeSlot'] = $timeSlot;
                $response['status'] = TRUE;
                $response['msg'] = 'success';
                $this->response($response, 200);
            } else {
                $response['status'] = FALSE;
                $response['msg'] = $msg;
                $this->response($response, 400);
            }
        }
    }

}
