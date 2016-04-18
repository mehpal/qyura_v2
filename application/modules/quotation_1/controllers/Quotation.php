<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Quotation extends MY_Controller {

     public function __construct() {
       parent:: __construct();
       $this->load->library('form_validation');
       $this->load->model('Quotation_model');
       $this->load->library('datatables');
       $this->load->helper('common_helper');
   }
   function index(){
      $data = array();
      $data['allCities'] = $this->Quotation_model->fetchCity();
      //print_r($data);exit;
      $data['title'] = 'Quotations';
      $this->load->super_admin_template('quotationList', $data, 'scriptQuotation');
   }
    function getQuotationDl(){
        //echo 'test'; exit;
    echo $this->Quotation_model->fetchQuotationDataTables();
   }
   
  function getQuotationHistoryDl(){
    echo $this->Quotation_model->fetchQuotationHistoryDataTables();
   }
   

   function quotationHistory(){
    $data = array();
    $data['allCities'] = $this->Quotation_model->fetchCity();
    $data['title'] = 'Quotation History';
    $this->load->super_admin_template('quotationHistory', $data,'scriptQuotation');
   }
   
   function sendQuotationToUser($qId){
      // echo $qId; exit;
       $isSent = $this->Quotation_model->sendQuotationToUser($qId);
       if($isSent){
           $this->session->set_flashdata('message', 'Mail successfully sent to user');
       }else{
           $this->session->set_flashdata('message', 'Some error occurde when sending mail!');
       }
       
      redirect("quotation/editQuotation/$qId");
   }
   
   function createQuoteCSV(){
        
        $fromDate = '';;
        if( isset($_POST['fromDate']) && $_POST['fromDate'] != '' ){
            $fromDate = $this->input->post('fromDate');
        }
        
        $toDate = '';
        if( isset($_POST['toDate']) && $_POST['toDate'] != '' ){
            $toDate = $this->input->post('toDate');
        }
        
        $search = '';
        if( isset($_POST['search']) && $_POST['search'] != '' ){
            $search = $this->input->post('search');
        }
        
        
        
        
        $array[]= array('Mi Name','Quote id','Patient Name','Preffered Date&Time','Contact','Status');
        $data = $this->Quotation_model->createQuoteCSVdata($fromDate, $toDate, $search);
        $arrayFinal = array_merge($array,$data);
       
        array_to_csv($arrayFinal,'quotationList.csv');
        return True;
        exit;
    }
    
    function createCSV(){
        
        $fromDate = '';;
        if( isset($_POST['fromDate']) && $_POST['fromDate'] != '' ){
            $fromDate = $this->input->post('fromDate');
        }
        
        $toDate = '';
        if( isset($_POST['toDate']) && $_POST['toDate'] != '' ){
            $toDate = $this->input->post('toDate');
        }
        
        $search = '';
        if( isset($_POST['search']) && $_POST['search'] != '' ){
            $search = $this->input->post('search');
        }
        
        $array[]= array('Mi Name','Quote id','Patient Name','Amount','Quote Date','Status','Booking Status');
        $data = $this->Quotation_model->createCSVdata($fromDate, $toDate, $search);
        $arrayFinal = array_merge($array,$data);
       
        array_to_csv($arrayFinal,'quotationHistory.csv');
        return True;
        exit;
    }
   
  function viewPrescription($conditionId){
      $data = array();
      $data['title'] = 'Quotation request';
      $data['quotationDetail'] = $this->Quotation_model->fetchQuotationData($conditionId);
      $data['quotationPrescription'] = $this->Quotation_model->fetchQuotationPrescription($conditionId);
      $data['quotationTest'] = $this->Quotation_model->getQuotationTests($conditionId);
      $data['dignoCat'] = $this->Quotation_model->getDiagnoCat();
      $this->load->super_admin_template('quotationDetail', $data, 'scriptQuotation');
   }
   
   
  function editQuotation($conditionId){
      //echo $conditionId; exit;
      $data = array();
      $data['title'] = 'Quotation modify';
      $data['quotationDetail'] = $this->Quotation_model->fetchQuotationData($conditionId);
      $data['quotationPrescription'] = $this->Quotation_model->fetchQuotationPrescription($conditionId);
      $data['quotationTest'] = $this->Quotation_model->getQuotationTests($conditionId);
      $data['dignoCat'] = $this->Quotation_model->getDiagnoCat();
      $this->load->super_admin_template('quotationEdit', $data, 'scriptQuotation');
   }

     /**
     * @method delete
     * @description 	delete select data
     * @access public
     * @param int
     * @return boolean
     */
    function delete() {
        $delete_id = $this->input->post('delete_id'); // delete id
        $table_name = $this->input->post('table'); //table name
        $id_name = $this->input->post('id_name'); // table field name
        if (!empty($table_name) && !empty($table_name) && !empty($id_name)) {
            //where
            $where = array($id_name => $delete_id);
            $update_data['quotationDetailTests_deleted'] = 1;
            $options = array(
                'table' => $table_name,
                'where' => $where,
                'data' => $update_data
            );
            $update = $this->Quotation_model->customUpdate($options);
            if ($update) {
                echo $update;
            } else
                echo 0;
        }else {
            echo 0;
        }
    }
    
    
         /**
     * @method rejectQuotation
     * @description 	reject quotation request
     * @access public
     * @param int
     * @return boolean
     */
    function rejectQuotation() {
        $bookId = $this->input->post('bookId'); // delete id
        $table_name = $this->input->post('table'); //table name
        $id_name = $this->input->post('id_name'); // table field name
        if (!empty($table_name) && !empty($table_name) && !empty($id_name)) {
            //where
            $where = array($id_name => $bookId);
            $update_data['quotationBooking_bookStatus'] = 3;
            $options = array(
                'table' => $table_name,
                'where' => $where,
                'data' => $update_data
            );
            $update = $this->Quotation_model->customUpdate($options);
            if ($update) {
                echo $update;
            } else
                echo 0;
        }else {
            echo 0;
        }
    }
    
    
    function updateTest(){
        
        $diagnosticType= $this->input->post('diagnosticType'); // delete id
        $testName = $this->input->post('testName'); //table name
        $date = $this->input->post('date'); // table field name
        
        $time = $this->input->post('time'); // delete id
        $instruction = $this->input->post('instruction'); //table name
        $price = $this->input->post('price'); // table field name
        
        $id = $this->input->post('id'); // table field name
        
        
         $updateData = array(
              'quotationDetailTests_diagnosticCatId' => $diagnosticType,
              'quotationDetailTests_testName' => $testName,
              'quotationDetailTests_date'=> strtotime($date.' '.$time),
              'quotationDetailTests_price'=> $price,
              'quotationDetailTests_instruction' => $instruction,
             
              'modifyTime' => strtotime(date("Y-m-d H:i:s"))
              );
                      //print_r($insertData);
                      //exit;
              $where = array(
              'quotationDetailTests_id' => $id
              );
              $response = '';
             // var_dump($updateData); exit;
              $response = $this->Quotation_model->UpdateTableData($updateData, $where, 'qyura_quotationDetailTests');
             // echo $this->db->last_query(); exit;
              
              if ($response) {
                   echo true;
                }else{
                    echo false;
                }
        
    }
    
    function saveEditQuotationDetail($qId){
             //echo($healthPackage_id);exit;
      $this->load->library('form_validation');
      $this->bf_form_validation->set_rules('apptType', 'apptType', 'xss_clean|required|trim');
      $this->bf_form_validation->set_rules('preferedDate', 'Prefered date', 'xss_clean|required|trim');
      
       
    
       //$this->bf_form_validation->set_rules('testIncluded','Test Includes','required|xss_clean|trim');
      if ($this->bf_form_validation->run() === FALSE) {
           // echo validation_errors(); exit;
            $data = array();
            $data['title'] = 'Quotation modify';
            $data['quotationDetail'] = $this->Quotation_model->fetchQuotationData($qId);
            $data['quotationPrescription'] = $this->Quotation_model->fetchQuotationPrescription($qId);
            $data['quotationTest'] = $this->Quotation_model->getQuotationTests($qId);
            $data['dignoCat'] = $this->Quotation_model->getDiagnoCat();
            $this->load->super_admin_template('quotationEdit', $data, 'scriptQuotation');
     }
     else {
             
             $imagesname = "";
             if ($_FILES['avatar_file']['name']) {
                $path = realpath(FCPATH . 'assets/proImg/');
                $upload_data = $this->input->post('avatar_data');
                $upload_data = json_decode($upload_data);
                $original_imagesname = $this->uploadImageWithThumb($upload_data, 'avatar_file', $path, 'assets/proImg/', './assets/proImg/thumb/','pre');

                if ($original_imagesname != '') {
                   $imagesname = $original_imagesname;
                }
              }
             
              if($imagesname != ''){
                  $insertData = array('quotationDetail_prescription' => $imagesname, 'quotationDetail_quotationId' => $qId, 'creationTime' => strtotime(date("Y-m-d H:i:s")));
                  $this->Quotation_model->insertPrescription($insertData);
              }
                 
              $quotation_dateTime = $this->input->post('preferedDate');
              
              $updateData = array(
              'quotation_dateTime' => strtotime($quotation_dateTime),
              'status'=> 1,
              'modifyTime' => strtotime(date("Y-m-d H:i:s"))
              );
         // print_r($insertData);
        //  print_r($updateData);
        //  exit;
              $where = array(
              'quotation_id' => $qId
              );
              $response = '';
             // var_dump($updateData); exit;
              $response = $this->Quotation_model->UpdateTableData($updateData,$where, 'qyura_quotations');
                if ($response) {
                  $this->session->set_flashdata('message', 'Data updated successfully !');
                  redirect("quotation/editQuotation/$qId");
                }
            }
    }
    
   
// send quotation start by pawan
    
     /**
     * @project Qyura
     * @method sendQuotation
     * @description Send Quotation
     * @access public
     * @return array
     */
    function sendQuotation() {

        $data = array();
        $options = array('table' => 'qyura_city', 'order' => array('city_name' => 'asc'));
        $data['qyura_city'] = $this->common_model->customGet($options);
        $catOptions = array('table' => 'qyura_diagnosticsCat', 'order' => array('diagnosticsCat_catName' => 'asc'), 'select' => 'diagnosticsCat_catName as catName,diagnosticsCat_catId as catId', 'where' => array('diagnosticsCat_deleted' => 0));
        $data['catOptions'] = $this->common_model->customGet($catOptions);

        $spOptions = array('table' => 'qyura_specialities', 'order' => array('specialities_name' => 'asc'), 'select' => 'specialities_name as speName,specialities_specialitiesCatId as speCatId', 'where' => array('specialities_deleted' => 0));
        $data['spOptions'] = $this->common_model->customGet($spOptions);

        $data['allStates'] = $this->Quotation_model->fetchStates();

        $data['title'] = 'Send Quotations';
        $this->load->super_admin_template('sendQuotation', $data, 'scriptQuotation');
    }

    function getMI() {
        $city_id = $this->input->post('city_id');
        $appointment_type = $this->input->post('appointment_type');
        $option = '';
        if ($appointment_type == 0) {
            $options = array(
                'table' => 'qyura_hospital',
                'where' => array('qyura_hospital.hospital_deleted' => 0, 'qyura_hospital.hospital_cityId' => $city_id),
            );
            $hospital = $this->common_model->customGet($options);

            if (isset($hospital) && $hospital != NULL) {
                $option .= '<option value="">Select Hospital</option>';
                foreach ($hospital as $hospi) {
                    $option .= '<option value="' . $hospi->hospital_id . ',' . $hospi->hospital_usersId . '">' . $hospi->hospital_name . '</option>';
                }
            } else {
                $option .= '<option value=""> Hospital not available. </option>';
            }
        } else {
            $options = array(
                'table' => 'qyura_diagnostic',
                'where' => array('qyura_diagnostic.diagnostic_deleted' => 0, 'qyura_diagnostic.diagnostic_cityId' => $city_id),
            );
            $diagnostic = $this->common_model->customGet($options);
            if (isset($diagnostic) && $diagnostic != NULL) {
                $option .= '<option value="">Select Diagnostic</option>';
                foreach ($diagnostic as $diagno) {
                    $option .= '<option value="' . $diagno->diagnostic_id . ',' . $diagno->diagnostic_usersId . '">' . $diagno->diagnostic_name . '</option>';
                }
            } else {
                $option .= '<option value=""> Diagnostic not available. </option>';
            }
        }
        echo $option;
    }

    /**
     * @project Qyura
     * @method appoint_timeSlot
     * @description get time slot related to hospitol or diagnostic
     * @access public
     * @param h_d_id,type
     * @return option
     */
    function appoint_timeSlot() {
        $h_d_id = $this->input->post('h_d_id');
        $type = $this->input->post('type');
        $option = '';
        if ($type == 0) {
            $options = array(
                'table' => 'qyura_hospitalTimeSlot',
                'where' => array('qyura_hospitalTimeSlot.hospitalTimeSlot_deleted' => 0, 'qyura_hospitalTimeSlot.hospitalTimeSlot_hospitalId' => $h_d_id),
            );
            $hospitalTimeSlot = $this->common_model->customGet($options);

            if (isset($hospitalTimeSlot) && $hospitalTimeSlot != NULL) {
                $option .= '<option value="">Select Time Slot</option>';
                foreach ($hospitalTimeSlot as $hospi) {
                    $session = getSession($hospi->hospitalTimeSlot_sessionType);
                    $option .= '<option value="' . $hospi->hospitalTimeSlot_id . ',' . $hospi->hospitalTimeSlot_sessionType . '">' . $hospi->hospitalTimeSlot_startTime . " to " . $hospi->hospitalTimeSlot_endTime . " | " . $session . '</option>';
                }
            } else {
                $option .= '<option value=""> Hospital time slot not available. </option>';
            }
        } else {

            $options = array(
                'table' => 'qyura_diagnosticCenterTimeSlot',
                'where' => array('qyura_diagnosticCenterTimeSlot.diagnosticCenterTimeSlot_deleted' => 0, 'qyura_diagnosticCenterTimeSlot.diagnosticCenterTimeSlot_diagnosticId' => $h_d_id),
            );
            $diagnostic = $this->common_model->customGet($options);

            if (isset($diagnostic) && $diagnostic != NULL) {
                $option .= '<option value="">Select Time Slot</option>';
                foreach ($diagnostic as $diagno) {
                    $session = getSession($diagno->diagnosticCenterTimeSlot_sessionType);
                    $option .= '<option value="' . $diagno->diagnosticCenterTimeSlot_id . ',' . $diagno->diagnosticCenterTimeSlot_sessionType . '">' . $diagno->diagnosticCenterTimeSlot_startTime . " to " . $diagno->diagnosticCenterTimeSlot_endTime . " | " . $session . '</option>';
                }
            } else {
                $option .= '<option value=""> Diagnostic time slot not available. </option>';
            }
        }
        echo $option;
    }
    
    function gerMIdoctorList(){
        
        $MiId = $this->input->post('MiId');
        $Mitype = $this->input->post('type');
     
        $MiDrList = $this->Quotation_model->getDrMIList($MiId,$Mitype); 
     
          $option ="";  
          if (isset($MiDrList) && $MiDrList != NULL) {
                $option .= '<option value="">Select Dr</option>';
                foreach ($MiDrList as $dr) {
                    $option .= '<option value="' . $dr->doctors_userId .'">' . ucwords($dr->drName) . '</option>';
                }
            } else {
                $option .= '<option value=""> Dr. Not available. </option>';
            }
        echo $option; exit;
    }

    /**
     * @project Qyura
     * @method find_specialities
     * @description get specialities related to hospitol or diagnostic
     * @access public
     * @param h_d_id,type
     * @return option
     */
    function find_specialities() {
        $h_d_id = $this->input->post('h_d_id');
        $type = $this->input->post('type');
        $option = '';
        if ($type == 0) {
            $options = array(
                'table' => 'qyura_hospitalSpecialities',
                'where' => array('qyura_hospitalSpecialities.hospitalSpecialities_deleted' => 0, 'qyura_hospitalSpecialities.hospitalSpecialities_hospitalId' => $h_d_id),
                'join' => array(
                    array('qyura_specialities', 'qyura_specialities.specialities_id = qyura_hospitalSpecialities.hospitalSpecialities_specialitiesId', 'left'),
                ),
                'group_by' => 'qyura_specialities.specialities_id',
            );
            $hospitalSpecialities = $this->common_model->customGet($options);

            if (isset($hospitalSpecialities) && $hospitalSpecialities != NULL) {
                $option .= '<option value="">Select Specialities</option>';
                foreach ($hospitalSpecialities as $specialities) {

                    $option .= '<option value="' . $specialities->specialities_id . '">' . $specialities->specialities_name . '</option>';
                }
            } else {
                $option .= '<option value=""> Currently there is no data found. </option>';
            }
        } else {
            $options = array(
                'table' => 'qyura_diagnosticSpecialities',
                'where' => array('qyura_diagnosticSpecialities.diagnosticSpecialities_deleted' => 0, 'qyura_diagnosticSpecialities.diagnosticSpecialities_diagnosticId' => $h_d_id),
                'join' => array(
                    array('qyura_specialities', 'qyura_specialities.specialities_id = qyura_diagnosticSpecialities.diagnosticSpecialities_specialitiesId', 'left'),
                ),
                'group_by' => 'qyura_specialities.specialities_id',
            );
            $diagnosticSpecialities = $this->common_model->customGet($options);
            // echo $this->db->last_query();exit;
            if (isset($diagnosticSpecialities) && $diagnosticSpecialities != NULL) {
                $option .= '<option value="">Select Specialities</option>';
                foreach ($diagnosticSpecialities as $specialities) {

                    $option .= '<option value="' . $specialities->specialities_id . '">' . $specialities->specialities_name . '</option>';
                }
            } else {
                $option .= '<option value=""> Currently there is no data found. </option>';
            }
        }
        echo $option;
    }

    /**
     * @project Qyura
     * @method find_diago_test
     * @description get test related to hospitol or diagnostic
     * @access public
     * @param h_d_id,type
     * @return option
     */
    function find_category() {
        $h_d_id = $this->input->post('h_d_id');
        $type = $this->input->post('type');
        $option = '';
        if ($type == 0) {
            $options = array(
                'table' => 'qyura_hospitalDiagnosticsCat',
                'where' => array('qyura_hospitalDiagnosticsCat.hospitalDiagnosticsCat_deleted' => 0, 'qyura_hospitalDiagnosticsCat.hospitalDiagnosticsCat_hospitalId' => $h_d_id),
                'join' => array(
                    array('qyura_diagnosticsCat', 'qyura_diagnosticsCat.diagnosticsCat_catId = qyura_hospitalDiagnosticsCat.hospitalDiagnosticsCat_diagnosticsCatId', 'left'),
                ),
                'group_by' => 'qyura_diagnosticsCat.diagnosticsCat_catId',
            );
            $hospitalTest = $this->common_model->customGet($options);

            if (isset($hospitalTest) && $hospitalTest != NULL) {
                $option .= '<option value="">Select Category</option>';
                foreach ($hospitalTest as $hospital) {
                    $option .= '<option value="' . $hospital->hospitalDiagnosticsCat_diagnosticsCatId . '">' . $hospital->diagnosticsCat_catName . '</option>';
                }
            } else {
                $option .= '<option value=""> Currently there is no data found. </option>';
            }
        } else {
            $options = array(
                'table' => 'qyura_diagnosticsHasCat',
                'where' => array('qyura_diagnosticsHasCat.diagnosticsHasCat_deleted' => 0, 'qyura_diagnosticsHasCat.diagnosticsHasCat_diagnosticId' => $h_d_id),
                'join' => array(
                    array('qyura_diagnosticsCat', 'qyura_diagnosticsCat.diagnosticsCat_catId = qyura_diagnosticsHasCat.diagnosticsHasCat_diagnosticsCatId', 'left'),
                ),
                'group_by' => 'qyura_diagnosticsCat.diagnosticsCat_catId',
            );
            $diagnosticTest = $this->common_model->customGet($options);

            if (isset($diagnosticTest) && $diagnosticTest != NULL) {
                $option .= '<option value="">Select Category</option>';
                foreach ($diagnosticTest as $diagnostic) {

                    $option .= '<option value="' . $diagnostic->diagnosticsHasCat_diagnosticsCatId . '">' . $diagnostic->diagnosticsCat_catName . '</option>';
                }
            } else {
                $option .= '<option value=""> Currently there is no data found. </option>';
            }
        }
        echo $option;
    }

    /**
     * @project Qyura
     * @method find_doctor
     * @description get doctor records related to hospitol or diagnostic
     * @access public
     * @param h_d_id,type,special_id
     * @return option
     */
    function find_doctor() {
        $h_d_id = $this->input->post('h_d_id');
        $type = $this->input->post('type');
        $special_id = $this->input->post('special_id');
        $option = '';
//      type = 0 = Hospitals
        if (isset($h_d_id) && isset($special_id)) {
            $doctors = $this->Quotation_model->getConsultantList($h_d_id, $special_id);
            //echo $this->db->last_query();exit;
            if (isset($doctors) && $doctors != NULL) {
                $option .= '<option value="">Select Doctor</option>';
                foreach ($doctors as $doctor) {
                    $option .= '<option value="' . $doctor['userId'] . '">' . $doctor['name'] . '</option>';
                }
            } else {
                $option .= '<option value=""> Currently no doctor available in this speciality. </option>';
            }
        }
        echo $option;
    }

    function numeric_wcomma ($str)
    {
    return preg_match('/^[0-9,]+$/', $str);
    }

    /**
     * @project Qyura
     * @method addAppointmentSave
     * @description save appointment details
     * @access public
     * @param 
     * @return insert id
     */
    function sendQuotationSave() {
       
         

        $this->bf_form_validation->set_rules("city_id", "City", 'required');
        $this->bf_form_validation->set_rules("miId", "MI Name", 'required');
        $this->bf_form_validation->set_rules("miType", "Hospital/Diagnostic", 'required');
        $this->bf_form_validation->set_rules("existsDr", "Ref. Doctor", 'required');
        $this->bf_form_validation->set_rules("bookStatus", "Book Status", 'required');
        $this->bf_form_validation->set_rules("quotationDate", "Date", 'required');
        $this->bf_form_validation->set_rules("quotationTime", "Time", 'required');
        
        $this->bf_form_validation->set_rules("patient_email", "Patient Email", 'required|valid_email');
        $this->bf_form_validation->set_rules("users_mobile", "Mobile Number ", 'required');
        $this->bf_form_validation->set_rules("users_username", "Name", 'required');
        $this->bf_form_validation->set_rules("countryId", "Country ", 'required');
        $this->bf_form_validation->set_rules("userStateId", "State ", 'required');
        $this->bf_form_validation->set_rules("userCityId", "User City", 'required');
        $this->bf_form_validation->set_rules("zip", "Zip", 'required|callback_numeric_wcomma');
        $this->bf_form_validation->set_rules("address", "Address", 'required');
   
        $this->bf_form_validation->set_rules("consulationFee", "Consulation Fee", 'required');
       
        $this->bf_form_validation->set_rules("tax", "Tax", 'required');
       // $this->form_validation->set_rules("paidamt", "Total Amount ", 'required|xss_clean');
        $this->bf_form_validation->set_rules("family_member", "Family Member ", 'required');
        
            $apoint_type = $this->input->post('input5');

            $total_test = $this->input->post('total_test');
            for ($j = 1; $j <= $total_test; $j++) {
                $this->bf_form_validation->set_rules("input28_$j", "Diagnostic Type $j ", 'required');
                $this->bf_form_validation->set_rules("input29_$j", "Test Name $j ", 'required');
                $this->bf_form_validation->set_rules("input30_$j", "Price $j", 'required');
                $this->bf_form_validation->set_rules("input31_$j", "Instruction $j", 'required');
            }
 
        
        if ($this->bf_form_validation->run() == FALSE) {
            $errors = validation_errors();
            $this->sendQuotation();
      } else {
  
        $user_id = $this->input->post('user_id');
        $quoDatetime = $this->input->post('quotationDate') . " " . $this->input->post('hour') . ":" . $this->input->post('minute');

//        $slotId = $this->input->post('timeslot');
//        $slotId = explode(',', $slotId);
        
      

        $MIprofileId = $this->input->post('miId');
        $MIprofileId = explode(',', $MIprofileId);
        
        
        $consultFee = $this->input->post('consulationFee');
        $tax = $this->input->post('tax');
     
        $totalFee = $this->input->post('paidamt');
          
        $quotationType = $this->input->post('quotationType');  //0 for cunslting 1 for diagnostic

        if (empty($user_id)) {
            
            $email = $this->email = strtolower($this->input->post('patient_email'));
            $username = explode('@', $email);
            $username = $this->username = $username[0];
            $length = 10;
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $password = '';
            for ($i = 0; $i < $length; $i++) {
                $password .= $characters[rand(0, strlen($characters) - 1)];
            }
            $user_mobile = $this->input->post('users_mobile');
            $patient_id = $this->input->post('input16');
            $user_name = $this->input->post('users_username');
            $user_country = $this->input->post('countryId');
            $user_state = $this->input->post('userStateId');
            $user_city = $this->input->post('userCityId');
            $user_zip = $this->input->post('zip');
            $user_address = $this->input->post('address');
            
           // $additional_data = array('users_logintype' => '1', 'users_mobile' => $user_mobile);
            
            //$users = $this->ion_auth_api->register($username, $password, $email, $additional_data);
            
             $optionAuotation = array(
                 'table' => 'qyura_users',
                 'data' => array(
                     'users_username' => $username,
                     'users_password' => $password,
                     'users_email' => $email,
                     'users_mobile' => $user_mobile,
                     'users_active' => 0,
                     'users_deleted' => 0,
                     'creationTime' => strtotime(date('Y-m-d H:i:s'))
                 )
              );

            $user_id = $this->common_model->customInsert($optionAuotation);
            
             $optionAuotation = array(
                 'table' => 'qyura_patientDetails',
                 'data' => array(
                     'patientDetails_usersId' => $user_id,
                     'patientDetails_countryId' => $user_country,
                     'patientDetails_stateId' => $user_state,
                     'patientDetails_cityId' => $user_city,
                     'patientDetails_mobileNo' => $user_mobile,
                     'patientDetails_unqId' => 'PNT' . random_string('alnumnew', 6),
                     'patientDetails_patientName' => $user_name,
                     'patientDetails_address' => $user_address,
                     'patientDetails_pin' => $user_zip,
                     'patientDetails_deleted'=> 0,
                     'creationTime' => strtotime(date('Y-m-d H:i:s'))
                 )
              );
             
            $patitentId = $this->common_model->customInsert($optionAuotation);
             
            $optionAuotation = array(
                 'table' => 'qyura_usersRoles',
                 'data' => array(
                     'usersRoles_userId' => $user_id,
                     'usersRoles_roleId' => 6,
                     'creationTime' => strtotime(date('Y-m-d H:i:s'))
                 )
              );
             
            $rolesId = $this->common_model->customInsert($optionAuotation);
             
            if($user_id){
            
               $this->Quotation_model->sendEmailToResgisterUser($_POST);
            }
            
            $user_id = $user_id;
        }
        
        /* quotation insert */
        $familyID = $this->input->post('familyId');
        if(empty($familyID)){
            $familyID = 0;
        }
        
        $existsDr= $this->input->post('existsDr');
        $dr_user_id = 0;
        $dr_Name="";
        if($existsDr == 1){
          $dr_user_id = $this->input->post('refDoctor');  
        }elseif($existsDr == 2){
          $dr_Name = $this->input->post('drName');  
        }

        $quotation = array(
            'quotation_MiId' => $MIprofileId[1],
            'quotation_userId' => $user_id,
            'quotation_familyId' => $familyID,
            'quotation_otherFee' => $this->input->post('otherFee'),
            'quotation_docRefeId' => $dr_user_id,
            'quotation_docName' => $dr_Name,
            'quotation_qtStatus' => 1,
            'quotation_dateTime' => strtotime($quoDatetime),
            'quotation_tex' => $this->input->post('tax'),
            'quotation_cityId' => $this->input->post('city_id'),
            'quotation_assignDoctorId' => 0,
            'quotation_deleted' => 0,
            'creationTime' => strtotime(date('Y-m-d H:i:s')),
        );
        $optionAuotation = array(
            'table' => 'qyura_quotations',
            'data' => $quotation
        );

        $quotation_id = $this->common_model->customInsert($optionAuotation);

        $quoUnqId = 'QU' . "_" . $quotation_id . "_" . time();
        
        $options = array(
            'table' => 'qyura_quotations',
            'where' => array('quotation_id' => $quotation_id),
            'data' => array('quotation_unqId' => $quoUnqId)
        );
        $update = $this->common_model->customUpdate($options);

        /* quotation test insert */

        $total_test = $this->input->post('total_test');
        for ($i = 1; $i <= $total_test; $i++) {

            //insert multiple test 
            $test_type = $this->input->post("input28_" . $i);
            $test_name = $this->input->post("input29_" . $i);
            $test_price = $this->input->post("input30_" . $i);
            $test_instruction = $this->input->post("input31_" . $i);

            $records_array3 = array(
                        'creationTime' => strtotime(date('Y-m-d H:i:s')),
                        'quotationDetailTests_quotationId' => $quotation_id,
                        'quotationDetailTests_diagnosticCatId' => $test_type,
                        'quotationDetailTests_MIprofileId' => $MIprofileId[0], 
                        'quotationDetailTests_testName' => $test_name,
                        'quotationDetailTests_date' => strtotime($quoDatetime),
                        'quotationDetailTests_price' => $test_price, 
                        'quotationDetailTests_instruction' => $test_instruction
                   );
            $options = array(
                'data' => $records_array3,
                'table' => 'qyura_quotationDetailTests'
            );
            $quotationDetail = $this->common_model->customInsert($options);
        }

           /* insert data in transaction table */
        
            $transaction_array2 = array(
                    'creationTime' => strtotime(date('Y-m-d H:i:s')),
                    'user_id' => $user_id,
                    'order_no' => $quoUnqId
                    );
            $options = array(
                'data' => $transaction_array2,
                'table' => 'transactionInfo'
            );
            $digo_trasaction = $this->common_model->customInsert($options);
            
            
              /* insert quotations booking */
            
            $records_array4 = array(
                        'creationTime' => strtotime(date('Y-m-d H:i:s')),
                        'quotationBooking_quotationId' => $quotation_id,
                        'quotationBooking_userId' => $user_id,
                        'quotationBooking_orderId' => $quoUnqId, 
                        'quotationBooking_amount' => $totalFee, 
                        'quotationBooking_bookStatus' => $this->input->post('bookStatus'),
                        'quotation_familyId' => $familyID
                 );

            $options = array(
                'data' => $records_array4,
                'table' => 'qyura_quotationBooking'
            );
            $quotationBooking = $this->common_model->customInsert($options);
            
            
            $bookId = 'DIAG' .'_'. $quotationBooking . '_' . time();
            $updateOption = array(
                'data' => array(
                    'quotationBooking_orderId' => $bookId,
                ),
                'table' => 'qyura_quotationBooking',
                'where' => array('quotationBooking_id' => $quotationBooking)
            );
            $isUpdate = $this->common_model->customUpdate($updateOption);
            
            if($isUpdate){
//                $responce = array('status' => 1, 'isAlive' => TRUE, 'message' => 'Successfully send quotation.');
//            echo json_encode($responce);
                $isSent = $this->Quotation_model->sendQuotationToUser($quotation_id);
                $this->session->set_flashdata('message','Successfully send quotation.');
                redirect('quotation/sendQuotation');
            }else{
//                $responce = array('status' => 0, 'isAlive' => TRUE, 'message' => 'Failed to send quotation.');
//               echo json_encode($responce);
               $this->session->set_flashdata('error','Failed to send quotation.');
               redirect('quotation/sendQuotation');  
            }
        }
    }

    function getpatient() {
        $patient_email = $this->input->post("patient_email");
        $patient_mobile = $this->input->post("patient_mobile");

        $options = array(
            'select' => 'qyura_users.users_id as user_id,qyura_users.users_mobile as mobile,qyura_patientDetails.patientDetails_cityId as cityId,qyura_patientDetails.patientDetails_stateId as stateId,qyura_patientDetails.patientDetails_countryId as countryId,qyura_patientDetails.patientDetails_patientName as patientName,qyura_patientDetails.patientDetails_address as address,qyura_patientDetails.patientDetails_unqId as unqId,qyura_patientDetails.patientDetails_pin as pin',
            'table' => 'qyura_users',
            'where' => array('qyura_users.users_deleted' => 0, 'qyura_users.users_email' => $patient_email, 'qyura_usersRoles.usersRoles_roleId' => 6),
            'or_where' => array('qyura_users.users_mobile' => $patient_mobile),
            'join' => array(
                array('qyura_usersRoles', 'qyura_usersRoles.usersRoles_userId = qyura_users.users_id', 'left'),
                array('qyura_patientDetails', 'qyura_patientDetails.patientDetails_usersId = qyura_users.users_id', 'left'),
                array('qyura_country', 'qyura_country.country_id = qyura_patientDetails.patientDetails_countryId', 'left')
            ),
            'single' => true
        );
        $data = $this->common_model->customGet($options);

        if (isset($data) && $data != null)
            echo json_encode($data);
        else
            echo 0;
    }

    /**
     * @project Qyura
     * @method fetchCity
     * @description get city records by state
     * @access public
     * @param stateId
     * @return array
     */
    function fetchCity() {
        //echo "fdadas";exit;
        $stateId = $this->input->post('stateId');

        $cityData = $this->Quotation_model->fetchCity($stateId);

        $cityOption = '';
        $cityOption .='<option value=>Select Your City</option>';
        foreach ($cityData as $key => $val) {
            $cityOption .= '<option value=' . $val->city_id . '>' . strtoupper($val->city_name) . '</option>';
        }
        echo $cityOption;
        exit;
    }


    public function insertSocialProfile($users_id, $data = null) {
        $socialData = array(
            'userSocial_pushToken' => isset($_POST['pushToken']) ? $this->input->post('pushToken') : '',
            'userSocial_udid' => isset($_POST['udid']) ? $this->input->post('udid') : '',
            'userSocial_device' => isset($_POST['device']) ? $this->input->post('device') : '',
            'userSocial_usersId' => $users_id,
            'creationTime' => time()
        );

        if ($data != null && is_array($data))
            $socialData = array_merge($socialData, $data);

        return $this->Quotation_model->setSocialProf($socialData);
    }

    function getMember() {
        $user_id = $this->input->post('user_id');
        $option = '';
        if (isset($user_id)) {
            $options = array(
                'table' => 'qyura_usersFamily',
                'where' => array('qyura_usersFamily.usersfamily_deleted' => 0, 'qyura_usersFamily.usersfamily_usersId' => $user_id),
            );
            $familyList = $this->common_model->customGet($options);

            if (isset($familyList) && $familyList != NULL) {
                $option .= '<option value="">Select Member</option>';
                foreach ($familyList as $family) {
                    $option .= '<option value="' . $family->usersfamily_id . '">' . $family->usersfamily_name . '</option>';
                }
            } else {
                $option .= '<option value=""> Currently no member registered with us. </option>';
            }
        }
        echo $option;
    }

}  