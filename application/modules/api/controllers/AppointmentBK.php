<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'modules/api/controllers/MyRest.php';

class Appointment extends MyRest {

    function __construct() {

        parent::__construct();
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
            $sql1 = "SELECT  `qyura_quotationBooking`.`quotationBooking_reportTitle` as title, `qyura_quotations`.`quotation_dateTime` as `dateTime`, CASE WHEN (`qyura_hospital`.`hospital_usersId` <> 0 ) THEN qyura_hospital.hospital_address ELSE qyura_diagnostic.diagnostic_address END AS `address`, `qyura_quotationBooking`.`quotationBooking_orderId` AS `orderId`, CASE qyura_quotationBooking.quotationBooking_bookStatus WHEN '0' THEN 'pending' WHEN '1' THEN 'confirmed' ELSE NULL END AS `bookingStatus`, CASE transactionInfo.payment_status WHEN '1' THEN 'Success' WHEN 4 THEN 'Aborted' WHEN 5 THEN 'Failure' ELSE NULL END AS `paymentStatus`, CASE WHEN (qyura_quotations.quotation_familyId <> 0 ) THEN qyura_usersFamily.usersfamily_name ELSE qyura_patientDetails.patientDetails_patientName END AS `userName`, CASE WHEN (`qyura_quotations`.`quotation_familyId` <> 0 ) THEN qyura_usersFamily.usersfamily_gender ELSE qyura_patientDetails.patientDetails_gender END AS `userGender`, `qyura_users`.`users_mobile` AS `usersMobile`, CASE WHEN (`qyura_quotations`.`quotation_familyId` <> 0 ) THEN qyura_usersFamily.usersfamily_age ELSE (FROM_UNIXTIME('{$now}', '%Y') - FROM_UNIXTIME(qyura_patientDetails.patientDetails_dob, '%Y')) END AS `userAge`, `transactionInfo`.`payment_method` AS `paymentMethod`, '' AS `remark`, `qyura_diagnosticsCat`.`diagnosticsCat_catName` AS `diagCatName`, '' AS `speciality`, 'Diagnostic' as `type`, (CASE WHEN(quotation_dateTime > CURRENT_TIMESTAMP ) THEN 'Upcoming' ELSE 'Completed' END) as `upcomingStatus`
FROM `qyura_quotationBooking`
LEFT JOIN `transactionInfo` ON `transactionInfo`.`order_no` = `qyura_quotationBooking`.`quotationBooking_orderId`
LEFT JOIN `qyura_quotations` ON `qyura_quotations`.`quotation_id`=`qyura_quotationBooking`.`quotationBooking_quotationId`
LEFT JOIN `qyura_users` ON `qyura_users`.`users_id`=`qyura_quotations`.`quotation_userId`
LEFT JOIN `qyura_patientDetails` ON `qyura_patientDetails`.`patientDetails_usersId`=`qyura_quotationBooking`.`quotationBooking_userId`
LEFT JOIN `qyura_usersFamily` ON `qyura_usersFamily`.`usersfamily_id`=`qyura_quotations`.`quotation_familyId`
LEFT JOIN `qyura_hospital` ON `qyura_hospital`.`hospital_usersId`=`qyura_quotations`.`quotation_MiId`
LEFT JOIN `qyura_diagnostic` ON `qyura_diagnostic`.`diagnostic_usersId`=`qyura_quotations`.`quotation_MiId`
LEFT JOIN `qyura_diagnosticsCat` ON `qyura_diagnosticsCat`.`diagnosticsCat_catId`=`qyura_quotations`.`quotation_diagnosticsCatId`
WHERE `qyura_quotationBooking`.`quotationBooking_userId` = '{$userId}'
AND `qyura_quotationBooking`.`quotationBooking_deleted` = 0
AND `qyura_quotations`.`quotation_dateTime` <> 0

union 

";

            $sql2 = 'SELECT `healthPackage_packageTitle` as `title`, `healthPkgBooking_finalBookingDate` as `dateTime`, (CASE WHEN(diagnostic_usersId is not null) THEN diagnostic_name WHEN(hospital_usersId is not null) THEN hospital_name END) as `address`, `healthPkgBooking_orderNo` as `orderId`, ( CASE healthPkgBooking_bkStatus WHEN 0 THEN "Pending" WHEN 1 THEN "Completed" WHEN 2 THEN "Cancelled" END) as `bookingStatus`, CASE WHEN (healthPkgBooking_memberId <> 0 ) THEN qyura_usersFamily.usersfamily_name ELSE qyura_patientDetails.patientDetails_patientName END AS `userName`, CASE WHEN (healthPkgBooking_memberId <> 0 ) THEN CASE usersfamily_gender WHEN 0 THEN "Male" WHEN 1 THEN "Female" WHEN 3 THEN "Other" END  ELSE CASE patientDetails_gender WHEN "M" THEN "Male" WHEN "F" THEN "Female" WHEN "O" THEN "Other" END END AS `userGender`, `users_mobile` AS `usersMobile`, CASE WHEN (healthPkgBooking_memberId <> 0 ) THEN qyura_usersFamily.usersfamily_age ELSE (CASE patientDetails_dob WHEN 0 THEN "" ELSE FROM_UNIXTIME(UNIX_TIMESTAMP(), "%Y") - FROM_UNIXTIME(patientDetails_dob, "%Y") END ) END AS `userAge`, ( CASE payment_status WHEN 1 THEN "Success" WHEN 4 THEN "Aborted" WHEN 5 THEN "Failure" END) as paymentStatus, `payment_method` as `paymentMethod`, "" as `remark`, "" as `diagCatName`, "" as `speciality`, "Health Package" as `type`, (CASE WHEN(healthPkgBooking_finalBookingDate > UNIX_TIMESTAMP()) THEN "Upcoming" ELSE "Completed" END) as upcomingStatus
FROM `qyura_healthPkgBooking`
LEFT JOIN `qyura_healthPackage` ON `qyura_healthPackage`.`healthPackage_id` = `qyura_healthPkgBooking`.`healthPkgBooking_healthPackageId`
LEFT JOIN `transactionInfo` ON `transactionInfo`.`order_no` = `qyura_healthPkgBooking`.`healthPkgBooking_orderNo`
LEFT JOIN `qyura_hospital` ON `qyura_hospital`.`hospital_usersId` = `qyura_healthPkgBooking`.`healthPkgBooking_miId`
LEFT JOIN `qyura_diagnostic` ON `qyura_diagnostic`.`diagnostic_usersId` = `qyura_healthPkgBooking`.`healthPkgBooking_miId`
LEFT JOIN `qyura_users` ON `qyura_users`.`users_id` = `qyura_healthPkgBooking`.`healthPkgBooking_userId`
LEFT JOIN `qyura_patientDetails` ON `qyura_patientDetails`.`patientDetails_usersId` = `qyura_users`.`users_id`
LEFT JOIN `qyura_usersFamily` ON `qyura_usersFamily`.`usersfamily_id` = `qyura_healthPkgBooking`.`healthPkgBooking_memberId`
WHERE `healthPkgBooking_userId` = "'.$userId.'"
AND `healthPkgBooking_deleted` =0
';

            $sql = $sql1 . " " . $sql2;

            $queryResult = $this->db->query($sql)->result();
            
            //dump($this->db->last_query());

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
//                'select' => 'qyura_quotationBooking.quotationBooking_reportTitle,qyura_quotations.quotation_dateTime as `dateTime`,
//                    CASE 
// WHEN (qyura_hospital.hospital_usersId IS NOT NULL) 
// THEN
//      qyura_hospital.hospital_address
// ELSE qyura_diagnostic.diagnostic_address END AS `address`,qyura_quotationBooking.quotationBooking_orderId as `orderId` ,
// CASE qyura_quotationBooking.quotationBooking_bookStatus WHEN "0" THEN "pending" WHEN "1" THEN "confirmed" ELSE NULL END as `bookingStatus` ,
//CASE transactionInfo.payment_status WHEN "1" THEN "Success" WHEN "4" THEN "Aborted" WHEN 5 THEN "Failure" ELSE null END as `paymentStatus` ,
//CASE WHEN (qyura_quotations.quotation_familyId <> 0 ) THEN qyura_usersFamily.usersfamily_name ELSE qyura_patientDetails.patientDetails_patientName END AS `userName` ,
//CASE WHEN (`qyura_quotations`.`quotation_familyId` <> 0 ) THEN qyura_usersFamily.usersfamily_gender ELSE qyura_patientDetails.patientDetails_gender END AS `userGender` ,
// qyura_users.users_mobile as `usersMobile` ,
//CASE WHEN (`qyura_quotations`.`quotation_familyId` <> 0 ) THEN qyura_usersFamily.usersfamily_age ELSE (FROM_UNIXTIME("'.time().'","%Y") - FROM_UNIXTIME(qyura_patientDetails.patientDetails_dob,"%Y")) END AS `userAge`, transactionInfo.payment_method as `paymentMethod`, "" as `remark` , qyura_diagnosticsCat.diagnosticsCat_catName as `diagCatName`, "" as `speciality`',

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
