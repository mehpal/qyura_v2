<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'modules/api/controllers/MyRest.php';

class Report extends MyRest {

    function __construct() {

        parent::__construct();
        $this->load->model(array('my_model'));
    }

    function getReport_post() {

        $this->bf_form_validation->set_rules('bookingOrderId', 'Booking OrderId', 'xss_clean|trim|max_length[50]');

        if ($this->bf_form_validation->run($this) == FALSE) {
            // setup the input
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);
        } else {

            $bookingOrderId = isset($_POST['bookingOrderId']) ? $this->input->post('bookingOrderId') : '';
            $option = array(
                'select' => 'qyura_reports.report_report as report,qyura_reports.report_bookingOrderId as OrderId,CASE 
 WHEN (`report_type` = 1) 
 THEN
      qyura_quotationBooking.quotationBooking_reportTitle
 ELSE qyura_healthPackage.healthPackage_packageTitle
 END AS `title`',
                'table' => 'qyura_reports',
                'join' => array(
                    array('qyura_quotationBooking', 'qyura_quotationBooking.quotationBooking_orderId=qyura_reports.report_bookingOrderId', 'LEFT'),
                    array('qyura_healthPkgBooking', 'qyura_healthPkgBooking.healthPkgBooking_orderNo=qyura_reports.report_bookingOrderId', 'LEFT'),
                    array('qyura_healthPackage', 'qyura_healthPackage.healthPackage_id=qyura_healthPkgBooking.healthPkgBooking_healthPackageId', 'LEFT')
                ),
                'where' => array('qyura_reports.report_bookingOrderId' => $bookingOrderId, 'qyura_reports.report_deleted' => 0, '(qyura_quotationBooking.quotationBooking_deleted = 0 OR qyura_healthPkgBooking.healthPkgBooking_deleted = 0)' => null)
                
                
            );

            $reports = $this->common_model->customGet($option);
            
            if (isset($reports) && $reports != NULL) {
                $finalResult = array();
                $colName = array("report");
                $reportInfo = array();
                $count = 0;
                foreach ($reports as $report) {
                    $finalTemp = array();
                    $finalTemp[] = isset($report->report) ? $report->report : "";
                    if($count == 0){
                    $reportInfo['title'] = isset($report->title) ? $report->title : "";
                    $reportInfo['OrderId'] = isset($report->OrderId) ? $report->OrderId : "";
                    $count++;
                    }

                    $finalResult[] = $finalTemp;
                }
                $response = array('status' => TRUE, 'message' => 'success', 'reports' => $finalResult,'reportInfo'=>$reportInfo, 'colName' => $colName);
                $this->response($response, 200);
            } else {
                $response = array('status' => FALSE, 'message' => 'No report found');
                $this->response($response, 400);
            }
        }
    }
    
    function myReports_post() {

        $this->bf_form_validation->set_rules('userId', 'userId', 'xss_clean|trim|required|numeric|max_length[20]|is_natural_no_zero|_user_check');

        if ($this->bf_form_validation->run($this) == FALSE) {
            // setup the input
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);
        } else {

            $userId = isset($_POST['userId']) ? $this->input->post('userId') : '';
            
            $option = array(
                'select' => 'qyura_reports.report_report as report,qyura_reports.report_bookingOrderId as OrderId,CASE 
 WHEN (`report_type` = 1) 
 THEN
      qyura_quotationBooking.quotationBooking_reportTitle
 ELSE qyura_healthPackage.healthPackage_packageTitle
 END AS `title`,CASE 
 WHEN (`report_type` = 1) 
 THEN
      "Diagnostic"
 ELSE "Health Package"
 END AS `type`,CASE 
 WHEN (`qyura_hospital`.`hospital_usersId` <> 0) 
 THEN qyura_hospital.hospital_name
 WHEN (`hospital`.`hospital_usersId` <> 0) 
  THEN hospital.hospital_name
 WHEN (`diagnostic`.`diagnostic_usersId` <> 0)
  THEN diagnostic.diagnostic_name
 ELSE qyura_diagnostic.diagnostic_name
 END AS `name`',
                'table' => 'qyura_reports',
                'join' => array(
                    array('qyura_quotationBooking', 'qyura_quotationBooking.quotationBooking_orderId=qyura_reports.report_bookingOrderId', 'LEFT'),
                    array('qyura_quotations', 'qyura_quotations.quotation_id=qyura_quotationBooking.quotationBooking_quotationId', 'LEFT'),
                    array('qyura_hospital', 'qyura_hospital.hospital_usersId=qyura_quotations.quotation_MiId', 'LEFT'),
                    array('qyura_diagnostic', 'qyura_diagnostic.diagnostic_usersId=qyura_quotations.quotation_MiId', 'LEFT'),
                    
                    array('qyura_healthPkgBooking', 'qyura_healthPkgBooking.healthPkgBooking_orderNo=qyura_reports.report_bookingOrderId', 'LEFT'),
                    array('qyura_hospital as hospital', 'hospital.hospital_usersId=qyura_healthPkgBooking.healthPkgBooking_miId', 'LEFT'),
                    array('qyura_diagnostic as diagnostic', 'diagnostic.diagnostic_usersId=qyura_healthPkgBooking.healthPkgBooking_miId', 'LEFT'),
                    array('qyura_healthPackage', 'qyura_healthPackage.healthPackage_id=qyura_healthPkgBooking.healthPkgBooking_healthPackageId', 'LEFT')
                ),
                'where' => array("(qyura_quotationBooking.quotationBooking_userId = {$userId} AND qyura_quotationBooking.quotationBooking_deleted=0 )" => null, 'qyura_reports.report_deleted' => 0),
                'or_where'=>array("(qyura_healthPkgBooking.healthPkgBooking_userId = {$userId} AND qyura_healthPkgBooking.healthPkgBooking_deleted = 0)"=>null),
                'group_by'=> 'OrderId'
            );

            $reports = $this->common_model->customGet($option);
            
            

            if ($reports) {
                $finalResult = array();
                $colName = array( "title", "OrderId","type","name");
                foreach ($reports as $report) {
                    $finalTemp = array();
                    //$finalTemp[] = isset($report->report) ? $report->report : "";
                    $finalTemp[] = isset($report->title) ? $report->title : "";
                    $finalTemp[] = isset($report->OrderId) ? $report->OrderId : "";
                    $finalTemp[] = isset($report->type) ? $report->type : "";
                    $finalTemp[] = isset($report->name) ? $report->name : "";
                    
                    

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

    function myInsurance_post() {


        $this->bf_form_validation->set_rules('userId', 'userId', 'xss_clean|trim|required|numeric|max_length[20]|is_natural_no_zero|_user_check');


        if ($this->bf_form_validation->run($this) == FALSE) {
            // setup the input
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);
        } else {

            $userId = isset($_POST['userId']) ? $this->input->post('userId') : '';

            $option = array(
                'select' => 'qyura_patientDetails.patientDetails_patientName,userInsurance_id as insurance_id ,userInsurance_usersId as usersId,userInsurance_insuranceId as insuranceId, userInsurance_familyId as familyId, userInsurance_insuranceNo as insuranceNo, userInsurance_expDate as expDate,qyura_familyRelation.relation_type, CASE 
 WHEN (`userInsurance_familyId` = 0 ) 
 THEN
      "self"
 ELSE qyura_familyRelation.relation_type
 END AS `relation`,CASE 
 WHEN (`userInsurance_familyId` = 0 ) 
 THEN
      qyura_patientDetails.patientDetails_patientName
 ELSE qyura_usersFamily.usersfamily_name
 END AS `name` ',
                'table' => 'qyura_userInsurance',
                'join' => array(
                    array('qyura_usersFamily', 'qyura_usersFamily.usersfamily_id=qyura_userInsurance.userInsurance_familyId', 'left'),
                    array('qyura_familyRelation', 'qyura_usersFamily.usersfamily_relationId=qyura_familyRelation.relation_id', 'left'),
                    array('qyura_users', 'qyura_users.users_id=qyura_userInsurance.userInsurance_usersId', 'left'),
                    array('qyura_patientDetails', 'qyura_patientDetails.patientDetails_usersId=qyura_users.users_id', 'left'),
                ),
                'where' => array('qyura_userInsurance.userInsurance_usersId' => $userId, 'qyura_userInsurance.userInsurance_deleted' => 0),
            );

            $myInsurances = $this->common_model->customGet($option);


            if ($myInsurances) {
                $finalResult = array();
                $aoClumns = array("insurance_id", "usersId", "familyId", "insuranceNo", "expDate", "relation", "name");
                foreach ($myInsurances as $myInsurance) {
                    $finalTemp = array();
                    $finalTemp[] = isset($myInsurance->insurance_id) ? $myInsurance->insurance_id : "";
                    $finalTemp[] = isset($myInsurance->usersId) ? $myInsurance->usersId : "";
                    $finalTemp[] = isset($myInsurance->familyId) ? $myInsurance->familyId : "";
                    $finalTemp[] = isset($myInsurance->insuranceNo) ? $myInsurance->insuranceNo : "";
                    $finalTemp[] = isset($myInsurance->expDate) ? $myInsurance->expDate : "";
                    $finalTemp[] = isset($myInsurance->relation) ? $myInsurance->relation : "";
                    $finalTemp[] = isset($myInsurance->name) ? $myInsurance->name : "";
                    $finalResult[] = $finalTemp;
                }

                $response = array('status' => TRUE, 'message' => 'Success', 'clumns' => $aoClumns, 'result' => $finalResult);
                $this->response($response, 200);
            } else {

                $response = array('status' => FALSE, 'message' => 'Record does not exist');
                $this->response($response, 400);
            }
        }
    }

   

}
