<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'modules/api/controllers/MyRest.php';

class Notification extends MyRest {

    function __construct() {
// Ye nayan bhare bhare..
        parent::__construct();
    }
    
    function myNotification_post() {

        $this->bf_form_validation->set_rules('userId', 'userId', 'xss_clean|trim|required|numeric|max_length[20]|is_natural_no_zero|_user_check');

        if ($this->bf_form_validation->run($this) == FALSE) {
            
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);
            
        } else {
            $userId = isset($_POST['userId']) ? $this->input->post('userId') : '';
            $now = time();
            
            $SQL = "SELECT qyura_cronMsgId,qyura_cronMsg,qyura_cronDate,qyura_fkItemId,qyura_fkModuleId,qyura_cronTitle FROM qyura_cronMsgs WHERE qyura_fkUserId = ".$userId." ORDER BY qyura_cronDate ASC";
            //AND qyura_cronDate <= CURRENT_TIMESTAMP 
            $queryResult = $this->db->query($SQL)->result();
            $colName = array("msgId", "msgDetail","dateTime","itemId","type","title");
        
            $finalResult = array();
            if (!empty($queryResult)) {
                foreach ($queryResult as $row) {
                    
                    $finalTemp = array();
                    $finalTemp[] = isset($row->qyura_cronMsgId) && $row->qyura_cronMsgId != '' ? $row->qyura_cronMsgId : "";
                    $finalTemp[] = isset($row->qyura_cronMsg) && $row->qyura_cronMsg != '' ? $row->qyura_cronMsg : "";
                    $finalTemp[] = isset($row->qyura_cronDate) && $row->qyura_cronDate != '' ? $row->qyura_cronDate : "";
                    $finalTemp[] = isset($row->qyura_fkItemId) && $row->qyura_fkItemId != '' ? $row->qyura_fkItemId : "";
                    $finalTemp[] = isset($row->qyura_fkModuleId) && $row->qyura_fkModuleId != '' ? $row->qyura_fkModuleId : "";
                    $finalTemp[] = isset($row->qyura_cronTitle) && $row->qyura_cronTitle != '' ? $row->qyura_cronTitle : "";
                    
                    $finalResult[] = $finalTemp;
                }

                $response = array('status' => 1, 'message' => 'success', 'reports' => $finalResult, 'colName' => $colName);
                $this->response($response, 200);
            } else {
                $response = array('status' => 0, 'message' => 'No Notification found!!!');
                $this->response($response, 400);
            }
        }
    }

    function notificationDetail_post() {

        $this->bf_form_validation->set_rules('msgId', 'Notification id', 'xss_clean|trim|required|numeric');

        if ($this->bf_form_validation->run($this) == FALSE) {
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);
        } else {

            $msgId     =   isset($_POST['msgId']) ? $this->input->post('msgId') : '';
            $sql = "";
            

            $queryResult = $this->db->query($sql)->result();

            $colName = array("title", "dateTime", "address", "orderId", "bookingStatus", "paymentStatus", "userName", "userGender", "usersMobile", "userAge", "paymentMethod", "remark", "diagCatName", "speciality", "type", "upcomingStatus");

            $finalResult = array();
            if (!empty($queryResult)) {
                foreach ($queryResult as $row) {
                    $finalTemp = array();
                    $finalTemp[] = isset($row->title) && $row->title != '' ? $row->title : "";
                    $finalTemp[] = isset($row->dateTime) && $row->dateTime != '' ? $row->dateTime : "";
                    $finalTemp[] = isset($row->address) && $row->address != '' ? $row->address : "";
                    $finalTemp[] = isset($row->orderId) && $row->orderId != '' ? $row->orderId : "";
                    $finalTemp[] = isset($row->bookingStatus) && $row->bookingStatus != '' ? $row->bookingStatus : "";
                    $finalTemp[] = isset($row->paymentStatus) && $row->paymentStatus != '' ? $row->paymentStatus : "";
                    $finalTemp[] = isset($row->userName) && $row->userName != '' ? $row->userName : "";
                    $finalTemp[] = isset($row->userGender) && $row->userGender != '' ? $row->userGender : "";
                    $finalTemp[] = isset($row->usersMobile) && $row->usersMobile != '' ? $row->usersMobile : "";
                    $finalTemp[] = isset($row->userAge) && $row->userAge != '' ? $row->userAge : "";
                    $finalTemp[] = isset($row->paymentMethod) && $row->paymentMethod != '' ? $row->paymentMethod : "";
                    $finalTemp[] = isset($row->remark) && $row->remark != '' ? $row->remark : "";
                    $finalTemp[] = isset($row->diagCatName) && $row->diagCatName != '' ? $row->diagCatName : "";
                    $finalTemp[] = isset($row->speciality) && $row->speciality != '' ? $row->speciality : "";
                    $finalTemp[] = isset($row->type) && $row->type != '' ? $row->type : "";
                    $finalTemp[] = isset($row->upcomingStatus) && $row->upcomingStatus != '' ? $row->upcomingStatus : "";
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
