<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'modules/api/controllers/MyRest.php';

class MedicartApi extends MyRest {

    function __construct() {
        // Construct our parent class
        parent::__construct();
        $this->load->model(array('medicart_model'));
    }

    function medicartSpeciality_post() {

        $this->bf_form_validation->set_rules('lat', 'Lat', 'decimal');
        $this->bf_form_validation->set_rules('long', 'Long', 'decimal');

        if ($this->bf_form_validation->run() == FALSE) {
            $message = $this->validation_post_warning();
            $response = array('status' => FALSE, 'msg' => $message);
            $this->response($response, 400);
        } else {

            $option['lat'] = $lat = isset($_POST['lat']) ? $this->input->post('lat') : '';
            $option['long'] = $lang = isset($_POST['long']) ? $this->input->post('long') : '';
            $option['city'] = $city = isset($_POST['cityId']) ? $this->input->post('cityId') : '';

            if ($city != "") {
                $specialities = $this->medicart_model->specialityList($lat, $lang, $city);
            } else {
                $specialities = $this->medicart_model->specialityList($lat, $lang);
            }

            $finalArray = NULL;
            if (isset($specialities) && $specialities != NULL) {
                $count = 0;

                $all["specialities_id"] = "0";
                $all["name"] = "All";
                $all["specialitiesImg"] = "assets/specialityImages/3x/allSpeciality.png";
                $all["specialityCount"] = $count;
                $finalArray[] = $all;
                $dateArray = array();
                foreach ($specialities as $sp) {

                    $medicartCount = (isset($sp->specialityCount) && $sp->specialityCount != NULL) ? $sp->specialityCount : "0";
                    
//                    if ($medicartCount != 0) {

                        $array["specialities_id"] = (isset($sp->specialities_id) && $sp->specialities_id != NULL) ? $sp->specialities_id : "";
                        $dateArray[] =$sp->medicartOffer_id;
                        
                        $array["name"] = (isset($sp->name) && $sp->name != NULL) ? $sp->name : "";
                        $array["specialitiesImg"] = (isset($sp->img) && $sp->img != NULL) ? $sp->img : "";

                        $array["specialityCount"] = (isset($sp->specialityCount) && $sp->specialityCount != NULL) ? $sp->specialityCount : "";
                        $count = $count + $array['specialityCount'];
                        $finalArray[] = $array;
//                    }
                }
                
//                $vals = array_count_values($dateArray); 
                $finalArray[0]["specialityCount"] = "" . count(array_unique($dateArray)) . "";
            }

            if ($finalArray != NULL) {
                $response = array('status' => TRUE, 'message' => 'Here is the list of all specialities.', "result" => $finalArray);
                $this->response($response, 200);
            } else {
                $response = array('status' => FALSE, 'message' => 'Oops!! there is no medicart in any of speciality.');
                $this->response($response, 400);
            }
        }
    }

    function list_post() {

        $this->bf_form_validation->set_rules('lat', 'Lat', 'decimal');
        $this->bf_form_validation->set_rules('long', 'Long', 'decimal');
        $this->bf_form_validation->set_rules('q', 'q', 'trim|xss_clean');
        $this->bf_form_validation->set_rules('notin', 'notin', 'trim|xss_clean');
        $this->bf_form_validation->set_rules('speciality', 'speciality', 'trim|xss_clean|required');

        if ($this->bf_form_validation->run() == FALSE) {
            // setup the input
            $message = $this->validation_post_warning();
            $response = array('status' => FALSE, 'msg' => $message);
            $this->response($response, 400);
        } else {

            $option['lat'] = isset($_POST['lat']) ? $this->input->post('lat') : '';
            $option['long'] = isset($_POST['long']) ? $this->input->post('long') : '';
            $option['city'] = isset($_POST['cityId']) ? $this->input->post('cityId') : '';
            $option['speciality'] = isset($_POST['speciality']) ? $this->input->post('speciality') : '';

            $option['search'] = isset($_POST['q']) ? $this->input->post('q') : '';

            $notIn = isset($_POST['notin']) ? $this->input->post('notin') : '';

            $option['notIn'] = explode(',', $notIn);

            $aoClumns = array("medicartOffer_id", "MIId", "offerCategory", "title", "image", "description", "endDate", "actualPrice", "discountPrice", "by", "allowBooking", "maximumBooking", "phnNo", "remainBookings");

            $medList = $this->medicart_model->getMedlists($option);
            $finalResult = array();
            if (isset($medList) && $medList != NULL) {

                if (!empty($medList)) {
                    foreach ($medList as $row) {

                        $finalTemp = array();

                        $finalTemp[] = $medicartOffer_id = isset($row->medicartOffer_id) ? $row->medicartOffer_id : "";
                        $finalTemp[] = isset($row->medicartOffer_MIId) ? $row->medicartOffer_MIId : "";
                        $finalTemp[] = isset($row->medicartOffer_offerCategory) ? $row->medicartOffer_offerCategory : "";
                        $finalTemp[] = isset($row->medicartOffer_title) ? $row->medicartOffer_title : "";
                        $finalTemp[] = isset($row->medicartOffer_image) ? $row->medicartOffer_image : "";
                        $finalTemp[] = isset($row->medicartOffer_description) ? $row->medicartOffer_description : "";
                        $finalTemp[] = isset($row->medicartOffer_endDate) ? $row->medicartOffer_endDate : "";
                        $finalTemp[] = (isset($row->medicartOffer_actualPrice) && $row->medicartOffer_actualPrice != "") ? $row->medicartOffer_actualPrice : "0";
                        $finalTemp[] = (isset($row->medicartOffer_discount) && $row->medicartOffer_discount == 0) ? "0" : isset($row->medicartOffer_discountPrice) ? $row->medicartOffer_discountPrice : "0";

                        $diagnostic_name = (isset($row->diagnostic_name) && $row->diagnostic_name != null && $row->diagnostic_name != '') ? $row->diagnostic_name : "";
                        $hospital_name = (isset($row->hospital_name) && $row->hospital_name != null && $row->hospital_name != '') ? $row->hospital_name : "";

                        $diagnostic_phn = (isset($row->diagnostic_phn) && $row->diagnostic_phn != null && $row->diagnostic_phn != '') ? $row->diagnostic_phn : "";

                        $hospital_phn = (isset($row->hospital_phn) && $row->hospital_phn != null && $row->hospital_phn != '') ? $row->hospital_phn : "";
                        $by = "";

                        if ($hospital_name != "")
                            $by = $hospital_name;
                        elseif ($diagnostic_name != "") {
                            $by = $diagnostic_name;
                        }
                        if ($hospital_phn != "")
                            $phnNo = $hospital_phn;
                        elseif ($diagnostic_phn != "") {
                            $phnNo = $diagnostic_phn;
                        }

                        $phnNo = str_replace('0', '', $phnNo);
                        $phnNo = str_replace(' ', '', $phnNo);
                        $phnNo = trim($phnNo);

                        $finalTemp[] = $by;

                        $finalTemp[] = isset($row->medicartOffer_allowBooking) ? $row->medicartOffer_allowBooking : "";
                        $finalTemp[] = isset($row->medicartOffer_maximumBooking) ? $row->medicartOffer_maximumBooking : "";
                        $finalTemp[] = $phnNo;

                        $count = $this->getBoookingCount($medicartOffer_id);
                        $finalTemp[] = $count;

                        $finalResult[] = $finalTemp;
                    }
                }
            }

            // $finalResult = $this->jsonify($finalResult);


            if (!empty($finalResult)) {
                $response1['msg'] = 'medicart offer found';
                $response1['status'] = TRUE;
                $response1['data'] = $finalResult;
                $response1['colName'] = $aoClumns;
                $this->response($response1, 200); // 200 being the HTTP response code
            } else {
                $response1['msg'] = 'No medicart offer is available at this range!';
                $response1['status'] = FALSE;
                $this->response($response1, 404);
            }
        }
    }

    function getBoookingCount($medicartId) {
        $totalbookings = $this->medicart_model->totalbookings($medicartId);

        $remainingBookings = ($totalbookings->allowedBooking - $totalbookings->totalBooking);
        return $remainingBookings;
    }

    function MedicartDitail_post() {

        $this->bf_form_validation->set_rules('medicartOffer_id', 'MedicartOffer id', 'required|is_natural_no_zero');

        if ($this->bf_form_validation->run() == FALSE) {
            // setup the input
            $message = $this->validation_post_warning();
            $response = array('status' => FALSE, 'msg' => $message);
            $this->response($response, 400);
        } else {

            $medicartOffer_id = isset($_POST['medicartOffer_Id']) ? $this->input->post('medicartOffer_id') : '';

            $aoClumns = array("medicartOffer_id", "MIId", "offerCategory", "title", "image", "startDate", "endDate", "description", "actualPrice", "discountPrice", "medicartOffer_deleted", "modifyTime", "by", "allowBooking", "maximumBooking");

            $row = $this->medicart_model->getMedDetail($medicartOffer_id);

            if ($row) {

                $finalResult = array();
                if (!empty($row)) {

                    $finalTemp = array();
                    $finalTemp[] = isset($row->medicartOffer_id) ? $row->medicartOffer_id : "";
                    $finalTemp[] = isset($row->medicartOffer_MIId) ? $row->medicartOffer_MIId : "";
                    $finalTemp[] = isset($row->medicartOffer_offerCategory) ? $row->medicartOffer_offerCategory : "";
                    $finalTemp[] = isset($row->medicartOffer_title) ? $row->medicartOffer_title : "";
                    $finalTemp[] = isset($row->medicartOffer_image) ? $row->medicartOffer_image : "";
                    $finalTemp[] = isset($row->medicartOffer_startDate) ? $row->medicartOffer_startDate : "";
                    $finalTemp[] = isset($row->medicartOffer_endDate) ? $row->medicartOffer_endDate : "";
                    $finalTemp[] = isset($row->medicartOffer_description) ? $row->medicartOffer_description : "";
                    $finalTemp[] = isset($row->medicartOffer_actualPrice) ? $row->medicartOffer_actualPrice : "";
                    $finalTemp[] = isset($row->medicartOffer_discountPrice) ? $row->medicartOffer_discountPrice : "";
                    $finalTemp[] = isset($row->medicartOffer_deleted) ? $row->medicartOffer_deleted : "";
                    $finalTemp[] = isset($row->modifyTime) ? $row->modifyTime : "";

                    $by = "";
                    $lat = "";
                    $long = "";
                    $phnNo = "";

                    $diagnostic_name = (isset($row->diagnostic_name) && $row->diagnostic_name != null && $row->diagnostic_name != '') ? $row->diagnostic_name : "";
                    $hospital_name = (isset($row->hospital_name) && $row->hospital_name != null && $row->hospital_name != '') ? $row->hospital_name : "";
                    $diagnostic_phn = (isset($row->diagnostic_phn) && $row->diagnostic_phn != null && $row->diagnostic_phn != '') ? $row->diagnostic_phn : "";
                    $hospital_phn = (isset($row->hospital_phn) && $row->hospital_phn != null && $row->hospita_phn != '') ? $row->hospital_phn : "";
                    if ($hospital_name != "")
                        $by = $hospital_name;
                    elseif ($diagnostic_name != "") {
                        $by = $diagnostic_name;
                    }

                    if ($hospital_phn != "")
                        $phnNo = $hospital_phn;
                    elseif ($diagnostic_phn != "") {
                        $phnNo = $diagnostic_phn;
                    }

                    $phnNo = str_replace('91', '', $phnNo);
                    $phnNo = str_replace(' ', '', $phnNo);
                    $phnNo = trim($phnNo);

                    $finalTemp[] = $by;
                    $finalTemp[] = isset($row->medicartOffer_allowBooking) ? $row->medicartOffer_allowBooking : "";
                    $finalTemp[] = isset($row->medicartOffer_maximumBooking) ? $row->medicartOffer_maximumBooking : "";
                    $finalTemp[] = $phnNo;
                    $finalResult[] = $finalTemp;
                }
            }

            if (!empty($finalResult)) {
                $response1['msg'] = 'medicart offer found';
                $response1['status'] = TRUE;
                $response1['data'] = $finalResult;
                $response1['colName'] = $aoClumns;
                $this->response($response1, 200); // 200 being the HTTP response code
            } else {
                $response1['msg'] = 'No medicart offer is available at this range!';
                $response1['status'] = FALSE;
                $this->response($response1, 404);
            }
        }
    }

    function addContect_post() {

        $this->bf_form_validation->set_rules('medicartOfferId', 'Medicart Offer Id', 'xss_clean|trim|required|numeric|is_natural_no_zero');
        $this->bf_form_validation->set_rules('name', 'name', 'xss_clean|trim|required|max_length[80]|callback__alpha_dash_space');
        $this->bf_form_validation->set_rules('mobileNo', 'Mobile No', 'xss_clean|trim|numeric|min_length[10]|max_length[10]');
        $this->bf_form_validation->set_rules('email', 'email', 'xss_clean|trim|valid_email|max_length[255]');


        if ($this->bf_form_validation->run($this) == FALSE) {
            // setup the input
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);
        } else {

            $medicartOfferId = isset($_POST['medicartOfferId']) ? $this->input->post('medicartOfferId') : '';
            $name = isset($_POST['name']) ? $this->input->post('name') : '';
            $mobileNo = isset($_POST['mobileNo']) ? $this->input->post('mobileNo') : '';
            $email = isset($_POST['email']) ? $this->input->post('email') : '';

            $data = array(
                'medicartContect_name' => $name,
                'medicartContect_medicartOfferId' => $medicartOfferId,
                'medicartContect_mobileNo' => $mobileNo,
                'medicartContect_email' => $email,
                'medicartContect_enquiryId' => 'ENQ' . time(),
                'creationTime' => time()
            );

            $isInsert = $this->medicart_model->add('qyura_medicartContect', $data);

            if ($isInsert) {
                $response = array('status' => TRUE, 'message' => 'Thanks for reaching out. We will get in touch with you.');
                $this->response($response, 200);
            } else {
                $response = array('status' => FALSE, 'message' => 'Network Error .Please retry');
                $this->response($response, 400);
            }
        }
    }

    function cartBook_post() {

        $this->bf_form_validation->set_rules('medicartOfferId', 'Medicart Offer Id', 'xss_clean|trim|required|numeric|is_natural_no_zero|callback__check_allowBooking');
        $this->bf_form_validation->set_rules('userId', 'User Id', 'xss_clean|trim|required|numeric|is_natural_no_zero|_user_check');
        $this->bf_form_validation->set_rules('preferredDate', 'Preferred Date', 'xss_clean|trim|required|max_length[11]|valid_date[y-m-d,-]|callback__check_date');
        $this->bf_form_validation->set_rules('message', 'Message', 'xss_clean|trim|required|max_length[255]');


        if ($this->bf_form_validation->run($this) == FALSE) {
            // setup the input
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);
        } else {
            $medicartOfferId = isset($_POST['medicartOfferId']) ? $this->input->post('medicartOfferId') : '';
            
            if ($this->getBoookingCount($medicartOfferId) <= 0) {
                $response = array('status' => FALSE, 'message' => "Sorry!! Bookings are full for this medicart.");
                $this->response($response, 400);
            } else {

                $usersId = isset($_POST['userId']) ? $this->input->post('userId') : '';
                $preferredDate = isset($_POST['preferredDate']) ? $this->input->post('preferredDate') : '';
                $message = isset($_POST['message']) ? $this->input->post('message') : '';

//                $where = array(
//                    'medicartBooking_usersId' => $usersId,
//                    'medicartBooking_medicartOfferId' => $medicartOfferId,
//                    'medicartBooking_deleted' => 0);
//
//                $booking_check = $this->medicart_model->booking_check($where);
                
                $booking_check = 0; // No Limit of booking for a user
                
                if (!$booking_check) {

                    $data = array(
                        'medicartBooking_medicartOfferId' => $medicartOfferId,
                        'medicartBooking_usersId' => $usersId,
                        'medicartBooking_preferredDate' => strtotime($preferredDate),
                        'medicartBooking_message' => $message,
                        'creationTime' => time()
                    );

                    $isInsert = $this->medicart_model->add('qyura_medicartBooking', $data);

                    if ($isInsert) {
                        $where = array('medicartBooking_id' => $isInsert);
                        $update_data['medicartBooking_bookId'] = 'BMI_' . $isInsert . '_' . time();
                        $options = array(
                            'table' => 'qyura_medicartBooking',
                            'where' => $where,
                            'data' => $update_data
                        );
                        $update = $this->common_model->customUpdate($options);
                        $response = array('status' => TRUE, 'message' => 'Your booking request has been submitted successfully. We will get back to you shortly.');
                        $this->response($response, 200);
                    } else {
                        $response = array('status' => FALSE, 'message' => 'Network Error .Please retry');
                        $this->response($response, 400);
                    }
                } else {
                    $response = array('status' => FALSE, 'message' => 'You have already booked this cart.');
                    $this->response($response, 200);
                }
            }
        }
    }

    function _alpha_dash_space($str_in = '') {

        if (!preg_match("/^([-a-zA-Z_ ])+$/i", $str_in)) {
            $this->bf_form_validation->set_message('_alpha_dash_space', 'The %s field may only contain alpha characters, spaces, underscores, and dashes.');

            return FALSE;
        } else {
            return TRUE;
        }
    }

    function _check_date($str_in = '') {

        $medicartOfferId = isset($_POST['medicartOfferId']) ? $this->input->post('medicartOfferId') : '';
        $medicartOfferData = $this->medicart_model->getSingleData(array('medicartOffer_id' => $medicartOfferId, 'medicartOffer_deleted' => 0), 'medicartOffer_id,medicartOffer_startDate as startDate,medicartOffer_endDate as endDate');


        if ($medicartOfferData == NULL) {
            $this->bf_form_validation->set_message('_check_date', 'Medicart offer is no more available for booking');
            return FALSE;
        }

        $prfDate = strtotime($str_in);

        if ($medicartOfferData->startDate > $prfDate) {
            $this->bf_form_validation->set_message('_check_date', 'The {field} is valid since ' . date('Y-m-d', $medicartOfferData->startDate) . 'to ' . date('Y-m-d', $medicartOfferData->endDate));

            return FALSE;
        }

        if ($medicartOfferData->endDate < $prfDate) {
            $this->bf_form_validation->set_message('_check_date', 'The {field} is valid since ' . date('Y-m-d', $medicartOfferData->startDate) . 'to ' . date('Y-m-d', $medicartOfferData->endDate));

            return FALSE;
        }

        return TRUE;
    }

    function _check_allowBooking($str_in = '') {

        $medicartOfferId = isset($_POST['medicartOfferId']) ? $this->input->post('medicartOfferId') : '';
        $medicartOfferData = $this->medicart_model->getSingleData(array('medicartOffer_id' => $medicartOfferId, 'medicartOffer_deleted' => 0, ' qyura_medicartOffer.status' => 1), 'medicartOffer_id,medicartOffer_startDate as startDate,medicartOffer_endDate as endDate,qyura_medicartOffer.medicartOffer_allowBooking as allowBooking');

        if ($medicartOfferData == NULL) {
            $this->bf_form_validation->set_message('_check_allowBooking', 'This offer is no more available for booking.');
            return FALSE;
        }

        if (!$medicartOfferData->allowBooking) {
            $this->bf_form_validation->set_message('_check_allowBooking', 'This  is not allowed for booking');
            return FALSE;
        }
    }

}
