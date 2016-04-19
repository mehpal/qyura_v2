<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'modules/api/controllers/MyRest.php';

class Appointment extends MyRest {

    function __construct() {
        parent::__construct();
        $this->load->model("Appointment_model");
    }

    
    
    function myAppointment_post() {

        $this->bf_form_validation->set_rules('userId', 'userId', 'xss_clean|trim|required|numeric|max_length[20]|is_natural_no_zero|_user_check');

        if ($this->bf_form_validation->run($this) == FALSE) {
            // setup the input
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);
        } else {
            $userId = isset($_POST['userId']) ? $this->input->post('userId') : '';
            $now = time();
            
            $sql1 = $this->Appointment_model->QuotationList($now,$userId);
            $sql2 = $this->Appointment_model->PackageAppointmentList($now,$userId);
            $sql3 = $this->Appointment_model->DoctorAppointmentList($now,$userId);
            
            $colName = array("title", "orderId", "date", "startTime", "endTime", "address","upcomingStatus", "bookingStatus", "type", "typeId");
            $sql = $sql1 . " UNION " . $sql2 . " UNION " . $sql3;
 
        $queryResult = $this->db->query($sql)->result();

            $finalResult = array();
            if (!empty($queryResult)) {
                foreach ($queryResult as $row) {
                    $finalTemp = array();
                    $finalTemp[] = isset($row->title) && $row->title != '' ? $row->title : "";
                    $finalTemp[] = isset($row->orderId) && $row->orderId != '' ? $row->orderId : "";
                    $finalTemp[] = isset($row->date) && $row->date != '' ? $row->date : "";
                    $finalTemp[] = isset($row->startTime) && $row->startTime != '' ? $row->startTime : "";
                    $finalTemp[] = isset($row->endTime) && $row->endTime != '' ? $row->endTime : "";
                    $finalTemp[] = isset($row->address) && $row->address != '' ? $row->address : "";
                    $finalTemp[] = isset($row->upcomingStatus) && $row->upcomingStatus != '' ? $row->upcomingStatus : "";
                    $finalTemp[] = isset($row->bookingStatus) && $row->bookingStatus != '' ? $row->bookingStatus : "";
                    $finalTemp[] = isset($row->type) && $row->type != '' ? $row->type : "";
                    $finalTemp[] = isset($row->typeId) && $row->typeId != '' ? $row->typeId : "";
                    
                    $finalResult[] = $finalTemp;
                }

                $response = array('status' => 1, 'message' => 'success', 'reports' => $finalResult, 'colName' => $colName);
                $this->response($response, 200);
            } else {
                $response = array('status' => 0, 'message' => 'No Appointment found!!!');
                $this->response($response, 400);
            }
        }
    }

    function myAppointmentDetail_post() {

        $this->bf_form_validation->set_rules('userId', 'userId', 'xss_clean|trim|required|numeric|max_length[20]|is_natural_no_zero|_user_check');
        $this->bf_form_validation->set_rules('orderId', 'appointment Id'   , 'xss_clean|trim|required');
        $this->bf_form_validation->set_rules('type'   , 'appointment type' , 'xss_clean|trim|required');

        if ($this->bf_form_validation->run($this) == FALSE) {
            // setup the input
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);
        } else {

            $userId     =   isset($_POST['userId']) ? $this->input->post('userId') : '';
            $type       =   isset($_POST['type']) ? $this->input->post('type') : ''; 
            $orderId    =   isset($_POST['orderId']) ? $this->input->post('orderId') : ''; 
            $now        = time();
            $sql = "";
            
            if($type == 1){
                $sql = $this->Appointment_model->QuotationDetail($now,$userId,$orderId);
            } elseif($type == 2){
                $sql = $this->Appointment_model->PackageAppointmentDetail($now,$userId,$orderId);
            }  elseif($type == 3){
                $sql = $this->Appointment_model->DoctorAppointmentDetail($now,$userId,$orderId);
            }

            $queryResult = $this->db->query($sql)->result();
//            echo $this->db->last_query();
            $colName = array("orderId", "speciality", "doctor", "date", "startTime", "endTime", "userName", "userGender", "usersMobile", "userAge", "bookingStatus", "remark", "reviews", "rating", "miName", "address", "paymentMood", "paymentStatus");

            $finalResult = array();
            if (!empty($queryResult)) {
                foreach ($queryResult as $row) {
                    $finalTemp = array();
                    $finalTemp[] = isset($row->orderId) && $row->orderId != '' ? $row->orderId : "";
                    $finalTemp[] = isset($row->speciality) && $row->speciality != '' ? $row->speciality : "";
                    $finalTemp[] = isset($row->doctors_fName) && $row->doctors_fName != '' ? $row->doctors_fName : "";
                    $finalTemp[] = isset($row->date) && $row->date != '' ? $row->date : "";
                    $finalTemp[] = isset($row->startTime) && $row->startTime != '' ? $row->startTime : "";
                    $finalTemp[] = isset($row->endTime) && $row->endTime != '' ? $row->endTime : "";
                    $finalTemp[] = isset($row->userName) && $row->userName != '' ? $row->userName : "";
                    $finalTemp[] = isset($row->userGender) && $row->userGender != '' ? $row->userGender : "";
                    $finalTemp[] = isset($row->usersMobile) && $row->usersMobile != '' ? $row->usersMobile : "";
                    $finalTemp[] = isset($row->userAge) && $row->userAge != '' ? $row->userAge : "";
                    $finalTemp[] = isset($row->bookingStatus) && $row->bookingStatus != '' ? $row->bookingStatus : "";
                    $finalTemp[] = isset($row->remark) && $row->remark != '' ? $row->remark : "";
                    $finalTemp[] = isset($row->reviews) && $row->reviews != '' ? $row->reviews : "";
                    $finalTemp[] = isset($row->rating) && $row->rating != '' ? $row->rating : "";
                    $finalTemp[] = isset($row->miName) && $row->miName != '' ? $row->miName : "";
                    $finalTemp[] = isset($row->address) && $row->address != '' ? $row->address : "";
                    $finalTemp[] = isset($row->paymentMood) && $row->paymentMood != '' ? $row->paymentMood : "";
                    $finalTemp[] = isset($row->paymentStatus) && $row->paymentStatus != '' ? $row->paymentStatus : "";
                    $finalResult[] = $finalTemp;
                }

                $response = array('status' => TRUE, 'message' => 'success', 'reports' => $finalResult, 'colName' => $colName);
                $this->response($response, 200);
            } else {
                $response = array('status' => FALSE, 'message' => 'No report found');
                $this->response($response, 400);
            }
        }
    }

    
    function myUpcomingApp_post() {

        $this->bf_form_validation->set_rules('userId', 'userId', 'xss_clean|trim|required|numeric|max_length[20]|is_natural_no_zero|_user_check');

        if ($this->bf_form_validation->run($this) == FALSE) {
            // setup the input
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);
        } else {

            $userId = isset($_POST['userId']) ? $this->input->post('userId') : '';
            $now = time();
            $option = array(

                "select" => "`qyura_hospital`.`hospital_usersId`,`qyura_quotationBooking`.`quotationBooking_reportTitle`, `qyura_quotations`.`quotation_dateTime`, 
CASE WHEN (`qyura_hospital`.`hospital_usersId` <> 0 ) THEN qyura_hospital.hospital_address ELSE qyura_diagnostic.diagnostic_address END AS `address`, 
`qyura_quotationBooking`.`quotationBooking_orderId` AS `orderId`,
 CASE qyura_quotationBooking.quotationBooking_bookStatus WHEN '0' THEN 'pending' WHEN '1' THEN 'confirmed' ELSE NULL END AS `bookingStatus`,
 CASE transactionInfo.payment_status WHEN '1' THEN 'Success' WHEN 4 THEN 'Aborted' WHEN 5 THEN 'Failure' ELSE NULL END AS `paymentStatus`, 
 CASE WHEN (qyura_quotations.quotation_familyId <> 0 ) THEN qyura_usersFamily.usersfamily_name ELSE qyura_patientDetails.patientDetails_patientName END AS `userName`, 
 CASE WHEN (`qyura_quotations`.`quotation_familyId` <> 0 ) THEN qyura_usersFamily.usersfamily_gender ELSE qyura_patientDetails.patientDetails_gender END AS `userGender`, 
 `qyura_users`.`users_mobile` AS `usersMobile`, 
 CASE WHEN (`qyura_quotations`.`quotation_familyId` <> 0 ) THEN qyura_usersFamily.usersfamily_age ELSE (FROM_UNIXTIME('{$now}', '%Y') - FROM_UNIXTIME(qyura_patientDetails.patientDetails_dob, '%Y')) END AS `userAge`, `transactionInfo`.`payment_method` 
 AS `paymentMethod`, '' AS `remark`, `qyura_diagnosticsCat`.`diagnosticsCat_catName` AS `diagCatName`, '' AS `speciality`,
  'Diagnostic' as `type`, (CASE WHEN(quotation_dateTime > CURRENT_TIMESTAMP ) THEN 'Upcoming' ELSE 'Completed' END) as `upcomingStatus` ",
                'table' => 'qyura_quotationBooking',
                'join' => array(
                    array('transactionInfo', 'transactionInfo.order_no = qyura_quotationBooking.quotationBooking_orderId', 'left'),
                    array('qyura_quotations', 'qyura_quotations.quotation_id=qyura_quotationBooking.quotationBooking_quotationId', 'LEFT'),
                    array('qyura_users', 'qyura_users.users_id=qyura_quotations.quotation_userId', 'left'),
                    array('qyura_patientDetails', 'qyura_patientDetails.patientDetails_usersId=qyura_quotationBooking.quotationBooking_userId', 'left'),
                    array('qyura_usersFamily', 'qyura_usersFamily.usersfamily_id=qyura_quotations.quotation_familyId', 'left'),
                    array('qyura_hospital', 'qyura_hospital.hospital_usersId=qyura_quotations.quotation_MiId', 'LEFT'),
                    array('qyura_diagnostic', 'qyura_diagnostic.diagnostic_usersId=qyura_quotations.quotation_MiId', 'LEFT'),
                    array('qyura_diagnosticsCat', 'qyura_diagnosticsCat.diagnosticsCat_catId=qyura_quotations.quotation_diagnosticsCatId', 'LEFT')
                ),
                'where' => array('qyura_quotationBooking.quotationBooking_userId' => $userId, 'qyura_quotationBooking.quotationBooking_deleted' => 0, 'qyura_quotations.quotation_dateTime <>' => 0)
            );

            $reports = $this->common_model->customGet($option);

            dump($reports);
            dump($this->db->last_query());

            if ($reports) {
                $finalResult = array();
                $colName = array("title", "OrderId", "type");
                foreach ($reports as $report) {
                    $finalTemp = array();
                    //$finalTemp[] = isset($report->report) ? $report->report : "";
                    $finalTemp[] = isset($report->title) ? $report->title : "";
                    $finalTemp[] = isset($report->OrderId) ? $report->OrderId : "";
                    $finalTemp[] = isset($report->type) ? $report->type : "";
                    $finalResult[] = $finalTemp;
                }
                $response = array('status' => TRUE, 'message' => 'success', 'reports' => $finalResult, 'colName' => $colName);
                $this->response($response, 200);
            } else {
                $response = array('status' => FALSE, 'message' => 'No report found');
                $this->response($response, 400);
            }
        }
    }

}
