<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Medicart extends MY_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->model('medicart_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    function index() {
        $option = array(
            'select' => 'city_id,city_name',
            'table' => 'qyura_city',
            'order_by' => array("city_name", "asc")
        );
        $data['allCity'] = $this->medicart_model->customGet($option);
        $data['title'] = 'Medicart';
        $this->load->super_admin_template('medicartOfferListing', $data, 'medicartScript');
    }

    function getMedicartDl() {

        echo $this->medicart_model->fetchMedicartDataTables();
    }

    function getMedicartEnquiriesDl() {

        echo $this->medicart_model->fetchMedicartEnquiriesDataTables();
    }

    function getMedicartBookingDl() {

        echo $this->medicart_model->fetchMedicartBookingDataTables();
    }

    function bookingRequest() {
        $option = array(
            'select' => 'city_id,city_name',
            'table' => 'qyura_city',
            'order_by' => array("city_name", "asc")
        );
        $data['allCity'] = $this->medicart_model->customGet($option);
        $data['title'] = 'Medicart booking';
        $this->load->super_admin_template('bookingRequestListing', $data, 'medicartScript');
    }

    function enquiries() {
        $option = array(
            'select' => 'city_id,city_name',
            'table' => 'qyura_city',
            'order_by' => array("city_name", "asc")
        );
        $data['allCity'] = $this->medicart_model->customGet($option);
        $data['title'] = 'Medicart enquiries';
        $this->load->super_admin_template('enquiryListing', $data, 'medicartScript');
    }

    function addOffer() {
        $option = array(
            'select' => 'city_id,city_name',
            'table' => 'qyura_city',
            'order_by' => array("city_name", "asc")
        );
        $data['allCity'] = $this->medicart_model->customGet($option);
        $option = array(
            'select' => 'specialities_id,specialities_name',
            'table' => 'qyura_specialities',
            'where' => array('specialities_deleted' => 0, 'type' => 0, 'status' => 3),
            'order_by' => array("specialities_name", "asc")
        );
        $data['allOffetCategory'] = $this->medicart_model->customGet($option);
        $data['title'] = 'add Offer';

        $uniqueId = isUnique();

        $option = array(
            'select' => 'medicartOffer_OfferId',
            'table' => 'qyura_medicartOffer',
            'where' => array('medicartOffer_deleted' => 0, 'medicartOffer_OfferId' => $uniqueId)
        );
        $unique = $this->medicart_model->customGet($option);
        if (empty($unique)) {
            $data['uniqueId'] = $uniqueId;
        } else {
            $data['uniqueId'] = isUnique();
        }

        $this->load->super_admin_template('addOffer', $data, 'medicartScript');
    }

    function getHospital() {
        //echo "fdadas";exit;
        $cityId = $this->input->post('cityId');
        $hosData = $this->medicart_model->fetchHospital($cityId);

        $hosOption = '';
        $hosOption .='<option value=>Select Hospital</option>';
        if (!empty($hosData)) {
            foreach ($hosData as $key => $val) {
                $hosOption .= '<option value=' . $val->hospital_userId . '>' . strtoupper($val->hospital_name) . '</option>';
            }
        }
        echo $hosOption;
        exit;
    }

    function getDiagno() {
        //echo "fdadas";exit;
        $cityId = $this->input->post('cityId');
        $diagnoData = $this->medicart_model->fetchDiagnostic($cityId);
        $diOption = '';
        $diOption .='<option value=>Select Diagnostic</option>';
        if (!empty($diagnoData)) {
            foreach ($diagnoData as $key => $val) {
                $diOption .= '<option value=' . $val->diagnostic_usersId . '>' . strtoupper($val->diagnostic_name) . '</option>';
            }
        }
        echo $diOption;
        exit;
    }

    function enableDisable() {

        $id = $this->input->post('id');
        $status = $this->input->post('status');

        if ($status == 1) {
            $setStatus = 0;
        } else {
            $setStatus = 1;
        }
        $option = array(
            'table' => 'qyura_medicartOffer',
            'data' => array('status' => $setStatus),
            'where' => array('medicartOffer_id' => $id)
        );
        $response = $this->medicart_model->customUpdate($option);

        if ($response) {
            echo 1;
        } else {
            echo 0;
        }
    }

    function saveOffer() {
        $this->bf_form_validation->set_rules('medicartOffer_cityId', 'City Name', 'required|trim|numeric');
        $this->bf_form_validation->set_rules('medicartOffer_MIId', 'MI Name', 'required|trim|numeric');
        $this->bf_form_validation->set_rules('medicartOffer_OfferId', 'Offer Id', 'required|trim|is_unique[qyura_medicartOffer.medicartOffer_OfferId]');
        $this->bf_form_validation->set_rules('medicartOffer_offerCategory[]', 'Offer Caregory', 'required|trim');
        $this->bf_form_validation->set_rules('medicartOffer_title', 'Title', 'required|trim');
        $this->bf_form_validation->set_rules('medicartOffer_description', 'Description', 'required|trim');
        $this->bf_form_validation->set_rules('medicartOffer_allowBooking', 'allow Booking', 'required|trim');

        $this->bf_form_validation->set_rules('medicartOffer_startDate', 'Start Date', 'required|trim');
        $this->bf_form_validation->set_rules('medicartOffer_endDate', 'End Date', 'required|trim');
        // $this->bf_form_validation->set_rules('medicartOffer_range', 'Range', 'required|trim');

        $this->bf_form_validation->set_rules('miType', 'MI Type', 'required|trim');


        $medicartOffer_allowBooking = $this->input->post('medicartOffer_allowBooking');
        $medicartOffer_discount = $this->input->post('medicartOffer_discount');

        if ($medicartOffer_allowBooking == 1) {

            $this->bf_form_validation->set_rules('medicartOffer_maximumBooking', 'Maximum Booking', 'required|trim|numeric');
//$this->bf_form_validation->set_rules('medicartOffer_actualPrice', 'Actual Price', 'required|trim|numeric');
        }

        if ($medicartOffer_discount == 1) {

            $this->bf_form_validation->set_rules('medicartOffer_discount', 'Discount', 'required|trim');
            $this->bf_form_validation->set_rules('medicartOffer_ageDiscount', 'Age Discount', 'required|trim');
            $this->bf_form_validation->set_rules('medicartOffer_discountPrice', 'Discount Price', 'required|trim|numeric');
        }
        if (empty($_FILES['avatar_file']['name'])) {
            $this->bf_form_validation->set_rules('avatar_file', 'File', 'required');
        }
        if ($this->bf_form_validation->run() === False) {
            $option = array(
                'select' => 'city_id,city_name',
                'table' => 'qyura_city',
                'order_by' => array("city_name", "asc")
            );
            $data['allCity'] = $this->medicart_model->customGet($option);
            $option = array(
                'select' => 'specialities_id,specialities_name',
                'table' => 'qyura_specialities',
                'where' => array('specialities_deleted' => 0, 'type' => 0, 'status' => 3),
                'order_by' => array("specialities_name", "asc")
            );
            $data['allOffetCategory'] = $this->medicart_model->customGet($option);
            $data['title'] = 'add Offer';
            $uniqueId = isUnique();

            $option = array(
                'select' => 'medicartOffer_OfferId',
                'table' => 'qyura_medicartOffer',
                'where' => array('medicartOffer_deleted' => 0, 'medicartOffer_OfferId' => $uniqueId)
            );
            $unique = $this->medicart_model->customGet($option);
            if (empty($unique)) {
                $data['uniqueId'] = $uniqueId;
            } else {
                $data['uniqueId'] = isUnique();
            }
            $this->load->super_admin_template('addOffer', $data, 'medicartScript');
        } else {

            $imagesname = '';
            if ($_FILES['avatar_file']['name']) {
                $path = realpath(FCPATH . 'assets/Medicart/');
                $upload_data = $this->input->post('avatar_data');
                $upload_data = json_decode($upload_data);
                $original_imagesname = $this->uploadImageWithThumb($upload_data, 'avatar_file', $path, 'assets/Medicart/', './assets/Medicart/thumb/', 'medicart');

                if (empty($original_imagesname)) {
                    $option = array(
                        'select' => 'city_id,city_name',
                        'table' => 'qyura_city',
                        'order_by' => array("city_name", "asc")
                    );
                    $data['allCity'] = $this->medicart_model->customGet($option);
                    $option = array(
                        'select' => 'specialities_id,specialities_name',
                        'table' => 'qyura_specialities',
                        'where' => array('specialities_deleted' => 0, 'type' => 0, 'status' => 3),
                        'order_by' => array("specialities_name", "asc")
                    );
                    $data['allOffetCategory'] = $this->medicart_model->customGet($option);
                    $data['title'] = 'add Offer';
                    $this->session->set_flashdata('valid_upload', $this->error_message);

                    $uniqueId = isUnique();

                    $option = array(
                        'select' => 'medicartOffer_OfferId',
                        'table' => 'qyura_medicartOffer',
                        'where' => array('medicartOffer_deleted' => 0, 'medicartOffer_OfferId' => $uniqueId)
                    );
                    $unique = $this->medicart_model->customGet($option);
                    if (empty($unique)) {
                        $data['uniqueId'] = $uniqueId;
                    } else {
                        $data['uniqueId'] = isUnique();
                    }
                    $this->load->super_admin_template('addOffer', $data, 'medicartScript');
                    return false;
                } else {
                    $imagesname = $original_imagesname;
                }
            }
            $mxBooking = 0;
            if ($medicartOffer_allowBooking == 1) {
                $mxBooking = $this->input->post('medicartOffer_maximumBooking');
            }
            $Discount = 0;
            $ageDiscount = 0;
            $totalPrice = 0;
            $actualPrice = $this->input->post('medicartOffer_actualPrice');
            if ($medicartOffer_discount == 1) {
                $Discount = $this->input->post('medicartOffer_discountPrice');
                $ageDiscount = $this->input->post('medicartOffer_ageDiscount');
                $discountAfterCal = getDiscount($actualPrice, $Discount);
                $totalPrice = $discountAfterCal;
            } else {
                $totalPrice = $actualPrice;
            }

            $offerData = array(
                'medicartOffer_MIId' => $this->input->post('medicartOffer_MIId'),
                //'medicartOffer_offerCategory' => $this->input->post('medicartOffer_offerCategory'),
                'medicartOffer_title' => $this->input->post('medicartOffer_title'),
                'medicartOffer_image' => $imagesname,
                'medicartOffer_description' => $this->input->post('medicartOffer_description'),
                'medicartOffer_allowBooking' => $this->input->post('medicartOffer_allowBooking'),
                'medicartOffer_maximumBooking' => $mxBooking,
                'medicartOffer_startDate' => strtotime($this->input->post('medicartOffer_startDate')),
                'medicartOffer_endDate' => strtotime($this->input->post('medicartOffer_endDate')),
                'medicartOffer_discount' => $medicartOffer_discount,
                'medicartOffer_totalPrice' => $totalPrice,
                'medicartOffer_ageDiscount' => $ageDiscount,
                'medicartOffer_actualPrice' => $this->input->post('medicartOffer_actualPrice'),
                'medicartOffer_OfferId' => $this->input->post('medicartOffer_OfferId'),
                'medicartOffer_cityId' => $this->input->post('medicartOffer_cityId'),
                'medicartOffer_discountPrice' => $this->input->post('medicartOffer_discountPrice'),
                'medicartOffer_range' => $this->input->post('medicartOffer_range'),
                'medicartOffer_deleted' => 0,
                'creationTime' => strtotime(date("Y-m-d H:i:s")),
                'status' => 0
            );

            $option = array(
                'table' => 'qyura_medicartOffer',
                'data' => $offerData
            );
            $medicartId = $this->medicart_model->customInsert($option);
            $medicartOffer_offerCategory = $this->input->post('medicartOffer_offerCategory');

            for ($i = 0; $i < count($medicartOffer_offerCategory); $i++) {
                $offerDataSpe = array(
                    'medicartSpecialities_medicartId' => $medicartId,
                    'medicartSpecialities_specialitiesId' => $medicartOffer_offerCategory[$i],
                    'creationTime' => strtotime(date("Y-m-d H:i:s")),
                    'status' => 1
                );
                $optionSpe = array(
                    'table' => 'qyura_medicartSpecialities',
                    'data' => $offerDataSpe
                );
                $responseSpe = $this->common_model->customInsert($optionSpe);
            }

            if ($medicartId) {
                $this->session->set_flashdata('message', 'Record has been saved successfully!');
                redirect('medicart/addOffer');
            } else {
                $this->session->set_flashdata('error', 'Failed to saved records!');
                redirect('medicart/addOffer');
            }
        }
    }

    function getImageBase64Code($img) {
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $img = str_replace('[removed]', '', $img);
        $data = base64_decode($img);
        return $data;
    }

    function check_email() {

        $users_email = $this->input->post('users_email');
        //echo $users_email;exit;
        $email = $this->Ambulance_model->fetchEmail($users_email);
        echo $email;
        exit;
    }

    function editOffer($offerId = '') {
        $option = array(
            'select' => 'city_id,city_name',
            'table' => 'qyura_city',
            'order_by' => array("city_name", "asc")
        );
        $data['allCity'] = $this->medicart_model->customGet($option);
        $option = array(
            'select' => 'specialities_id,specialities_name',
            'table' => 'qyura_specialities',
            'where' => array('specialities_deleted' => 0, 'type' => 0, 'status' => 3),
            'order_by' => array("specialities_name", "asc")
        );
        $data['allOffetCategory'] = $this->medicart_model->customGet($option);

        $data['offerData'] = $detailData = $this->medicart_model->getMedDetail($offerId);

        $template_option = '';
        if (!empty($detailData)) {
            if ($detailData->miType == 1) {  // 1 for diagnostic
                $cityId = $detailData->medicartOffer_cityId;
                $diagnoData = $this->medicart_model->fetchDiagnostic($cityId);

                $template_option .='<option value=>Select Diagnostic</option>';
                if (!empty($diagnoData)) {
                    $selected = "";
                    foreach ($diagnoData as $key => $val) {
                        ($detailData->medicartOffer_MIId == $val->diagnostic_usersId) ? $selected = "selected" : $selected = "";
                        $template_option .= '<option ' . $selected . ' value=' . $val->diagnostic_usersId . '>' . strtoupper($val->diagnostic_name) . '</option>';
                    }
                }
            } elseif ($detailData->miType == 2) {

                $cityId = $detailData->medicartOffer_cityId;
                $hosData = $this->medicart_model->fetchHospital($cityId);

                $template_option .='<option value=>Select Hospital</option>';
                if (!empty($hosData)) {
                    $selected = "";
                    foreach ($hosData as $key => $val) {
                        ($detailData->medicartOffer_MIId == $val->hospital_usersId) ? $selected = "selected" : $selected = "";
                        $template_option .= '<option ' . $selected . ' value=' . $val->hospital_usersId . '>' . strtoupper($val->hospital_name) . '</option>';
                    }
                }
            }
        }

        $data['options'] = $template_option;

        $option = array(
            'table' => 'qyura_medicartSpecialities',
            'select' => 'medicartSpecialities_specialitiesId',
            'where' => array('medicartSpecialities_deleted' => 0, 'medicartSpecialities_medicartId' => $offerId),
            'single' => FALSE
        );
        $medicartSpecialities = $this->common_model->customGet($option);

        $qyura_medicartSpecialities = array();
        foreach ($medicartSpecialities as $Specialities) {
            array_push($qyura_medicartSpecialities, $Specialities->medicartSpecialities_specialitiesId);
        }
        $data['qyura_medicartSpecialities'] = $qyura_medicartSpecialities;

        $miId = "";
        if(!empty($detailData)){
           $miId = $detailData->medicartOffer_MIId;
        }
        $option = array(
            'table' => 'qyura_miMembership',
            'select' => 'miMembership_id,miMembership_quantity,miMembership_duration',
            'where' => array('miMembership_miId' => $miId , 'miMembership_facilitiesId' => 3 , 'status' => 3 , 'miMembership_deleted' => 0),
        );
        $data['membershipData'] = $this->common_model->customGet($option);

        $data['title'] = 'Edit Offer';
        $this->load->super_admin_template('medicartEditOffer', $data, 'medicartScript');
    }

    function saveEditOffer() {

        $id = $this->input->post('offerId');

        $this->bf_form_validation->set_rules('medicartOffer_cityId', 'City Name', 'required|trim|numeric');
        $this->bf_form_validation->set_rules('medicartOffer_MIId', 'MI Name', 'required|trim|numeric');

        $this->bf_form_validation->set_rules('medicartOffer_offerCategory[]', 'Offer Caregory', 'required|trim');
        $this->bf_form_validation->set_rules('medicartOffer_title', 'Title', 'required|trim');
        $this->bf_form_validation->set_rules('medicartOffer_description', 'Description', 'required|trim');
        $this->bf_form_validation->set_rules('medicartOffer_allowBooking', 'allow Booking', 'required|trim');

        $this->bf_form_validation->set_rules('medicartOffer_startDate', 'Start Date', 'required|trim');
        $this->bf_form_validation->set_rules('medicartOffer_endDate', 'End Date', 'required|trim');
        //$this->bf_form_validation->set_rules('medicartOffer_range', 'Range', 'required|trim');

        $this->bf_form_validation->set_rules('miType', 'MI Type', 'required|trim');
        //  $this->bf_form_validation->set_rules('medicartOffer_actualPrice', 'Actual Price', 'required|trim|numeric');

        $medicartOffer_allowBooking = $this->input->post('medicartOffer_allowBooking');
        $medicartOffer_discount = $this->input->post('medicartOffer_discount');

        if ($medicartOffer_allowBooking == 1) {

            $this->bf_form_validation->set_rules('medicartOffer_maximumBooking', 'Maximum Booking', 'required|trim|numeric');
        }

        if ($medicartOffer_discount == 1) {

            $this->bf_form_validation->set_rules('medicartOffer_discount', 'Discount', 'required|trim');
            $this->bf_form_validation->set_rules('medicartOffer_ageDiscount', 'Age Discount', 'required|trim');
            $this->bf_form_validation->set_rules('medicartOffer_discountPrice', 'Discount Price', 'required|trim|numeric');
        }

        if ($this->bf_form_validation->run() === False) {

            $option = array(
                'select' => 'city_id,city_name',
                'table' => 'qyura_city',
                'order_by' => array("city_name", "asc")
            );
            $data['allCity'] = $this->medicart_model->customGet($option);
            $option = array(
                'select' => 'specialities_id,specialities_name',
                'table' => 'qyura_specialities',
                'where' => array('specialities_deleted' => 0, 'type' => 0, 'status' => 3),
                'order_by' => array("specialities_name", "asc")
            );
            $data['allOffetCategory'] = $this->medicart_model->customGet($option);
            $data['offerData'] = $this->medicart_model->getMedDetail($id);
            $data['title'] = 'Edit Offer';
            $this->load->super_admin_template('medicartEditOffer', $data, 'medicartScript');
        } else {

            $imagesname = '';
            if ($_FILES['avatar_file']['name'] && !empty($_FILES['avatar_file']['name'])) {
                $path = realpath(FCPATH . 'assets/Medicart/');
                $upload_data = $this->input->post('avatar_data');
                $upload_data = json_decode($upload_data);
                $original_imagesname = $this->uploadImageWithThumb($upload_data, 'avatar_file', $path, 'assets/Medicart/', './assets/Medicart/thumb/', 'medicart');

                if (empty($original_imagesname)) {
                    $option = array(
                        'select' => 'city_id,city_name',
                        'table' => 'qyura_city',
                        'order_by' => array("city_name", "asc")
                    );
                    $data['allCity'] = $this->medicart_model->customGet($option);
                    $option = array(
                        'select' => 'specialities_id,specialities_name',
                        'table' => 'qyura_specialities',
                        'where' => array('specialities_deleted' => 0, 'type' => 0, 'status' => 3),
                        'order_by' => array("specialities_name", "asc")
                    );
                    $data['allOffetCategory'] = $this->medicart_model->customGet($option);
                    $data['title'] = 'Edit Offer';
                    $data['offerData'] = $this->medicart_model->getMedDetail($id);
                    $this->session->set_flashdata('valid_upload', $this->error_message);
                    $this->load->super_admin_template('medicartEditOffer', $data, 'medicartScript');
                    return false;
                } else {
                    $imagesname = $original_imagesname;
                }
            }

            $mxBooking = 0;
            if ($medicartOffer_allowBooking == 1) {
                $mxBooking = $this->input->post('medicartOffer_maximumBooking');
            }
            $Discount = 0;
            $ageDiscount = 0;
            $totalPrice = 0;
            $actualPrice = $this->input->post('medicartOffer_actualPrice');
            if ($medicartOffer_discount == 1) {
                $Discount = $this->input->post('medicartOffer_discountPrice');
                $ageDiscount = $this->input->post('medicartOffer_ageDiscount');
                $discountAfterCal = getDiscount($actualPrice, $Discount);
                $totalPrice = $discountAfterCal;
            } else {
                $totalPrice = $actualPrice;
            }


            $offerData = array(
                'medicartOffer_MIId' => $this->input->post('medicartOffer_MIId'),
                //'medicartOffer_offerCategory' => $this->input->post('medicartOffer_offerCategory'),
                'medicartOffer_title' => $this->input->post('medicartOffer_title'),
                'medicartOffer_description' => $this->input->post('medicartOffer_description'),
                'medicartOffer_allowBooking' => $this->input->post('medicartOffer_allowBooking'),
                'medicartOffer_maximumBooking' => $mxBooking,
                'medicartOffer_startDate' => strtotime($this->input->post('medicartOffer_startDate')),
                'medicartOffer_endDate' => strtotime($this->input->post('medicartOffer_endDate')),
                'medicartOffer_discount' => $medicartOffer_discount,
                'medicartOffer_totalPrice' => $totalPrice,
                'medicartOffer_ageDiscount' => $ageDiscount,
                'medicartOffer_actualPrice' => $this->input->post('medicartOffer_actualPrice'),
                'medicartOffer_cityId' => $this->input->post('medicartOffer_cityId'),
                'medicartOffer_discountPrice' => $this->input->post('medicartOffer_discountPrice'),
                'medicartOffer_range' => $this->input->post('medicartOffer_range'),
                'modifyTime' => strtotime(date("Y-m-d H:i:s")),
            );
            if (!empty($imagesname)) {
                $offerData['medicartOffer_image'] = $imagesname;
            }

            $where = array(
                'medicartOffer_id' => $id
            );
            $option = array(
                'table' => 'qyura_medicartOffer',
                'where' => $where,
                'data' => $offerData
            );
            $response = $this->medicart_model->customUpdate($option);

            $option = array(
                'table' => 'qyura_medicartSpecialities',
                'select' => 'medicartSpecialities_specialitiesId',
                'where' => array('medicartSpecialities_deleted' => 0, 'medicartSpecialities_medicartId' => $id),
                'single' => FALSE
            );
            $medicartSpecialities = $this->common_model->customGet($option);
            $oldSpecialities = array();
            foreach ($medicartSpecialities as $Specialities) {
                array_push($oldSpecialities, $Specialities->medicartSpecialities_specialitiesId);
            }
            $newSpecility = $this->input->post('medicartOffer_offerCategory');

            foreach ($newSpecility as $specility) {
                if (!in_array($specility, $oldSpecialities)) {
                    $option = array(
                        'table' => 'qyura_medicartSpecialities',
                        'select' => '*',
                        'where' => array('medicartSpecialities_specialitiesId' => $specility, 'medicartSpecialities_medicartId' => $id),
                        'single' => TRUE
                    );
                    $oldData = $this->common_model->customGet($option);
                    if (isset($oldData) && $oldData != NULL) {
                        $whereUpdate = array('medicartSpecialities_specialitiesId' => $specility, 'medicartSpecialities_medicartId' => $id);
                        $arrayResumeData = array('medicartSpecialities_deleted' => 0);
                        $updateOptions = array(
                            'where' => $whereUpdate,
                            'data' => $arrayResumeData,
                            'table' => 'qyura_medicartSpecialities'
                        );
                        $specilityOldDataResume = $this->common_model->customUpdate($updateOptions);
                    } else {
                        $new_specility_array = array('creationTime' => strtotime(date('Y-m-d h:i:s')), 'status' => 1, 'medicartSpecialities_medicartId' => $id, 'medicartSpecialities_specialitiesId' => $specility);
                        $options = array
                            (
                            'data' => $new_specility_array,
                            'table' => 'qyura_medicartSpecialities'
                        );
                        $this->common_model->customInsert($options);
                    }
                }
            }

            foreach ($oldSpecialities as $specility) {
                if (!in_array($specility, $newSpecility)) {
                    $whereUpdate = array('medicartSpecialities_specialitiesId' => $specility, 'medicartSpecialities_medicartId' => $id);
                    $deleteOldSpecility = array('medicartSpecialities_deleted' => 1);
                    $updateOptions = array(
                        'where' => $whereUpdate,
                        'data' => $deleteOldSpecility,
                        'table' => 'qyura_medicartSpecialities'
                    );
                    $medicartSpecilityDelete = $this->common_model->customUpdate($updateOptions);
                }
            }

            if ($response || $medicartSpecilityDelete || $specilityOldDataResume) {
                $this->session->set_flashdata('message', 'Record has been updated successfully!');
                redirect('medicart/editOffer/' . $id);
            } else {
                $this->session->set_flashdata('error', 'Failed to updated records!');
                redirect('medicart/editOffer/' . $id);
            }
        }
    }
    
    function getMemberShipDuTime(){
        $id = $this->input->post('id');
        $response = array();
        $options = array(
            'table' => 'qyura_medicartOffer',
            'select' => 'medicartOffer_MIId',
            'where' => array('medicartOffer_MIId' => $id , 'status' => 1 , 'medicartOffer_deleted' => 0)
        );
        
        $offerData = $this->common_model->customCount($options);
     
        $option = array(
            'table' => 'qyura_miMembership',
            'select' => 'miMembership_id,miMembership_quantity,miMembership_duration',
            'where' => array('miMembership_miId' => $id , 'miMembership_facilitiesId' => 2 , 'status' => 3 , 'miMembership_deleted' => 0, 'miMembership_quantity >' => $offerData),
        );
        $result = $this->common_model->customGet($option);
           //echo $this->db->last_query(); die();
        if($result && !empty($result)){
            $response = array('status' => 200, 'quantity' => $result[0]->miMembership_duration, 'message' => '');
        }else{
            $response = array('status' => 400, 'quantity' => 0 , 'message' => 'Your limit for medicart has finished as per your plan. Please renew your membership plan.');
        }
        echo json_encode($response);
    }
    

}
