<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'modules/api/controllers/MyRest.php';

class Quotation extends MyRest {

    function __construct() {

        parent::__construct();
    }

    function add_post() {

        $this->bf_form_validation->set_rules('miUserId', 'Mi User Id', 'xss_clean|numeric|required|trim|is_natural_no_zero|_user_check');

        $this->bf_form_validation->set_rules('userId', 'userId', 'xss_clean|trim|required|numeric|max_length[20]|is_natural_no_zero|_user_check');

        $this->bf_form_validation->set_rules('diagCatId', 'Diagnostics Category Id', 'xss_clean|trim|numeric|max_length[11]|is_natural_no_zero');

        $this->bf_form_validation->set_rules('familyId', 'Family Id', 'xss_clean|trim|numeric|max_length[11]|is_natural_no_zero');
        $this->bf_form_validation->set_rules('timeSlotId', 'TimeSlotId', 'xss_clean|trim|numeric|max_length[11]|is_natural_no_zero');
        
        $this->bf_form_validation->set_rules('preferedDate', 'Prefered Date', 'xss_clean|required|trim|max_length[11]|valid_date[y-m-d,-]|callback__check_current_date');
        
        $this->form_validation->set_rules('prescription[]', 'prescription', 'required|xss_clean|trim|valid_base64_image');

        $this->prescriptionPath = realpath(FCPATH . 'assets/prsImg') . '/';

        if ($this->bf_form_validation->run($this) == FALSE) {
            // setup the input
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);
        } else {

            $miUserId = isset($_POST['miUserId']) ? $this->input->post('miUserId') : '';
            $userId = isset($_POST['userId']) ? $this->input->post('userId') : '';
            $diagCatId = isset($_POST['diagCatId']) ? $this->input->post('diagCatId') : '';
            $timeSlotId = isset($_POST['timeSlotId']) ? $this->input->post('timeSlotId') : '';
            $familyId = isset($_POST['familyId']) ? $this->input->post('familyId') : '';
            $preferedDate = isset($_POST['preferedDate']) ? $this->input->post('preferedDate') : '';
            

            $prescription = isset($_POST['prescription']) ? $this->input->post('prescription') : '';

            $option = array(
                'data' => array(
                    'quotation_MiId' => $miUserId,
                    'quotation_userId' => $userId,
                    'quotation_familyId' => $familyId,
                    'quotation_diagnosticsCatId' => $diagCatId,
                    'quotation_timeSlotId' => $timeSlotId,
                    'quotation_dateTime'=> $preferedDate != '' ? strtotime($preferedDate): '',
                    'creationTime' => time()
                ),
                'table' => 'qyura_quotations'
            );

            $id = $this->common_model->customInsert($option);

            if ($id) {

                $updateOption = array(
                    'data' => array(
                        'quotation_unqId' => 'qu_' . $id . '_' . time()
                    ),
                    'table' => 'qyura_quotations',
                    'where' => array('quotation_id' => $id)
                );
                $isUpdate = $this->common_model->customUpdate($updateOption);

                $prescription = $this->input->post('prescription');

                for ($i = 0; $i < count($prescription); $i++) {
                    $imgName = 'qu_' . $id . '_' . $i . '_' . time() . '.png';
                    $img = isset($prescription[$i]) ? createImage($prescription[$i], $this->prescriptionPath, $imgName) : false;
                    $image_name = $img ? $img : '';

                    $optionPrs = array(
                        'data' => array(
                            'quotationDetail_prescription' => $image_name,
                            'quotationDetail_quotationId' => $id,
                            'creationTime' => time()
                        ),
                        'table' => 'qyura_quotationDetail'
                    );

                    $this->common_model->customInsert($optionPrs);
                }


                $response = array('status' => TRUE, 'message' => 'Your Quotation request has been send successfully. You will receive the quotation from the MI shortly !!');
                $this->response($response, 200);
            } else {
                $response = array('status' => FALSE, 'message' => 'Error in add record');
                $this->response($response, 400);
            }
        }
    }

    function myQuotations_post() {

        $this->load->model(array('quotation_model'));

        $this->bf_form_validation->set_rules('quotationId', 'Quotation Id', 'xss_clean|trim|required|numeric|max_length[20]|is_natural_no_zero');


        if ($this->bf_form_validation->run($this) == FALSE) {
            // setup the input
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);
        } else {

            $userId = isset($_POST['userId']) ? $this->input->post('userId') : '';

            $quotationId = isset($_POST['quotationId']) ? $this->input->post('quotationId') : '';

            $myQuotationSelfDetail = $this->quotation_model->myQuotationSelfDetail($quotationId);

            if (isset($myQuotationSelfDetail) && $myQuotationSelfDetail != NULL) {

                $quotationTests = $this->quotation_model->myQuotationTests($quotationId);

                $finalResult['selfDetail'] = $myQuotationSelfDetail;
                $finalResult['testDetail'] = $quotationTests;
                $aoClumns = array('quotation_id', 'testId', 'qtDetailId', 'diagCatId', 'diagCatName', 'testName', 'price','dateTime', 'instruction');

                $response = array('status' => TRUE, 'message' => 'Success', 'clumns' => $aoClumns, 'result' => $finalResult);
                $this->response($response, 200);
            } else {

                $response = array('status' => FALSE, 'message' => 'Record does not exist');
                $this->response($response, 400);
            }
        }
    }

    function removeMyQT_post() {

        $this->bf_form_validation->set_rules('testId', 'Test Id', 'xss_clean|trim|required|numeric|is_natural_no_zero');

        if ($this->bf_form_validation->run($this) == FALSE) {
            // setup the input
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);
        } else {

            $id = isset($_POST['testId']) ? $this->input->post('testId') : '';

            $delOption = array(
                'table' => 'qyura_quotationDetailTests',
                'data' => array(
                    'quotationDetailTests_deleted' => 1
                ),
                'where' => array('quotationDetailTests_id' => $id)
            );

            $isRemove = $this->common_model->customUpdate($delOption);
            // print_r($favList); exit;
            if ($isRemove || true) {
                $response = array('status' => TRUE, 'message' => 'Remove successfully');
                $this->response($response, 200);
            } else {

                $response = array('status' => FALSE, 'message' => 'Some thing wrong!');
                $this->response($response, 400);
            }
        }
    }

    function qTestBook_post() {

        $this->bf_form_validation->set_rules('quotationId', 'Quotation Id', 'xss_clean|trim|required|numeric|max_length[20]|is_natural_no_zero|callback__checkQt');

        $this->bf_form_validation->set_rules('userId', 'userId', 'xss_clean|trim|required|numeric|max_length[20]|is_natural_no_zero|_user_check');

        $this->bf_form_validation->set_rules('diagCatId', 'Diagnostics Category Id', 'xss_clean|trim|numeric|max_length[11]|is_natural_no_zero');

        $this->bf_form_validation->set_rules('familyId', 'Family Id', 'xss_clean|trim|numeric|max_length[11]|is_natural_no_zero');
        //$this->bf_form_validation->set_rules('testId[]', 'Test Id', 'xss_clean|trim|required|numeric|is_natural_no_zero');

        $this->bf_form_validation->set_rules('totalAmount', 'Total Amount', 'xss_clean|trim|required|numeric|is_natural_no_zero|callback__checkTotalAmount');

        //$this->bf_form_validation->set_rules('testAmount[]', 'test Amount', 'xss_clean|trim|required|numeric|is_natural_no_zero');

        if ($this->bf_form_validation->run($this) == FALSE) {
            // setup the input
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);
        } else {

            $quotationId = isset($_POST['quotationId']) ? $this->input->post('quotationId') : '';
            $userId = isset($_POST['userId']) ? $this->input->post('userId') : '';
            $diagCatId = isset($_POST['diagCatId']) ? $this->input->post('diagCatId') : '';
            $familyId = isset($_POST['familyId']) ? $this->input->post('familyId') : '';
            $totalAmount = isset($_POST['totalAmount']) ? $this->input->post('totalAmount') : '';

            //$unique_id = 'diad'.  . time();
            $option = array(
                'data' => array(
                    'quotationBooking_quotationId' => $quotationId,
                    'quotation_familyId' => $familyId,
                    'quotationBooking_userId' => $userId,
                    'quotationBooking_diagnosticsCatId' => $diagCatId,
                    'quotationBooking_amount' => $totalAmount,
                    'creationTime' => time()
                ),
                'table' => 'qyura_quotationBooking'
            );

            $id = $this->common_model->customInsert($option);

            if ($id) {

                $updateOption = array(
                    'data' => array(
                        'quotationBooking_orderId' => 'diad_' . $id . '_' . time()
                    ),
                    'table' => 'qyura_quotationBooking',
                    'where' => array('quotationBooking_id' => $id)
                );
                $isUpdate = $this->common_model->customUpdate($updateOption);

                $response = array('status' => TRUE, 'message' => 'Diagnostic quotation successfully booked');
                $this->response($response, 200);
            } else {

                $response = array('status' => FALSE, 'message' => 'Some thing wrong!');
                $this->response($response, 400);
            }
        }
    }

    function _check_date($str_in = '') {
        $expDate = strtotime($str_in);

        if ($this->time > $expDate) {
            $this->bf_form_validation->set_message('_check_date', 'Expiry Date is greater than current date');

            return FALSE;
        }

        return TRUE;
    }
    
    function _check_current_date($str_in = '')
    {
        $currentDate = strtotime(date("y-m-d"));
        $prfDate = strtotime($str_in);
        if ($prfDate >= $currentDate) {
            return true;
        } else {
            dump($prfDate >= $currentDate);
            $this->bf_form_validation->set_message('_check_current_date', 'date should be equal or greater then today');
            return false;
        }
    }

    function _checkTotalAmount($str_in = '') {
        $this->load->model(array('quotation_model'));
        $quotationId = $_POST['quotationId'];
        
        $quotationTestsAmount = $this->quotation_model->qtTestTotalAmount($quotationId);
       echo $quotationTestsAmount->price;
      echo  $str_in = number_format($str_in, 2, '.', ''); exit;
        
        if (isset($quotationId) && $quotationId != NULL) {

            if ($quotationTestsAmount->price != $str_in || $quotationTestsAmount == null) {
                if ($quotationTestsAmount->price > $str_in)
                    $this->bf_form_validation->set_message('_checkTotalAmount', 'Please provide correct amount  !!');
                if ($quotationTestsAmount->price < $str_in)
                    $this->bf_form_validation->set_message('_checkTotalAmount', 'Please provide correct amount ^ !!');
                if ($quotationTestsAmount == null)
                    $this->bf_form_validation->set_message('_checkTotalAmount', 'Please provide correct amount ^ !!');

                return FALSE;
            } else
                return TRUE;
        }
        else {
            $this->bf_form_validation->set_message('_checkTotalAmount', 'Please provide correct amount ^ !!');
            return FALSE;
        }
    }

    function _checkQt($str_in = '') {

        $quotationId = $_POST['quotationId'];

        if (isset($quotationId) && $quotationId != NULL) {

            $option = array(
                'table' => 'qyura_quotationBooking',
                'select' => 'quotationBooking_id',
                'where' => array('quotationBooking_deleted' => 0, 'quotationBooking_quotationId' => $quotationId),
                'single' => TRUE,
                'limit' => 1
            );

            $qtBook = $this->common_model->customGet($option);

            if (isset($qtBook) && $qtBook != NULL) {
                $this->bf_form_validation->set_message('_checkQt','Already Booked by User');
                return FALSE;
            } else
                return TRUE;
        }
        else {
            $this->bf_form_validation->set_message('_checkQt', 'Please provide quotationId');
            return FALSE;
        }

        return TRUE;
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
                
                "select"=>"`qyura_hospital`.`hospital_usersId`,`qyura_quotationBooking`.`quotationBooking_reportTitle`, `qyura_quotations`.`quotation_dateTime`, 
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
                'where'=>array('qyura_quotationBooking.quotationBooking_userId'=>$userId,'qyura_quotationBooking.quotationBooking_deleted'=>0,'qyura_quotations.quotation_dateTime <>'=>0)
                
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
