<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Docappointment extends MY_Controller {

    public $error_message = '';

    public function __construct() {
    parent:: __construct();
    $this->load->library('bf_form_validation');
    $this->load->library('datatables');
    $this->load->model('docappointment_model', 'docappointment');
    $this->load->helper('common_helper');
    
//        $this->load->library(array('api/ion_auth_api', 'bf_form_validation'));
//        $this->load->helper(array('url', 'language','common','string'));
//        $this->bf_bf_form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'api/auth_conf_api'), $this->config->item('error_end_delimiter', 'api/auth_conf_api'));
//        $this->lang->load('api/auth_api');
    }

    /**
     * @project Qyura
     * @method index
     * @description listing templeat
     * @access public
     * @return html
     */
    public function index() {
        $data = array();
        $data['title'] = 'Doctor Appointments';
        $this->load->super_admin_template('doctor_appointment_list', $data, 'miAppScript');
    }

    /**
     * @project Qyura
     * @method getDignostiData
     * @description miAppList listing
     * @access public
     * @return json data for datatable
     */
    public function getDignostiData() {
        echo $this->docappointment->getDiagnostic();
    }

    /**
     * @project Qyura
     * @method getConsultingList
     * @description miAppList listing
     * @access public
     * @return json data for datatable
     */
    public function getConsultingList() {
        echo $this->docappointment->getConsultingList();
    }

    /**
     * @project Qyura
     * @method getBloodBankDl
     * @description get records in listing using datatables
     * @access public
     * @return array
     */
    function getBloodBankDl() {
        echo $this->docappointment->fetchbloodBankDataTables();
    }
    
    function getDoctorAppointmnetDl(){
        echo $this->docappointment->fetchDoctorAppointmentDataTables();
    }
    /**
     * @project Qyura
     * @method detail
     * @description detail mi appointment
     * @access public
     * @param qtnId
     * @return html
     */
    public function detail($qtnId = '') {
        $data = array();
        $data['qtnDetail'] = $this->docappointment->getDetail($qtnId);
        $data['quotationTests'] = $this->docappointment->getQuotationTests($qtnId);
        $data['userDetail'] = $this->docappointment->getQuotationUserDetail($qtnId);
        $data['qtnAmount'] = $this->docappointment->qtTestTotalAmount($qtnId);
        $data['qtnId'] = $qtnId;
        $this->load->super_admin_template('miAppDetail', $data, 'miAppScript');
    }

    /**
     * @project Qyura
     * @method detail
     * @description detail consulting appointment
     * @access public
     * @param appointmentId
     * @return html
     */
    public function consultingDetail($appointmentId = '') {
        $data = array();
        $data['conDetail'] = $this->docappointment->getConsultingData($appointmentId);
        $data['reports'] = $this->docappointment->getConsultingReport($appointmentId);
        $this->load->super_admin_template('miConAppDetail', $data, 'miAppScript');
    }

    /**
     * @project Qyura
     * @method add
     * @description detail consulting appointment
     * @access public
     * @param appointmentId
     * @return html
     */
    function add_appointment() {
        
        $data = array();
        $options = array('table' => 'qyura_city', 'order' => array('city_name' => 'asc'));
        $data['qyura_city'] = $this->common_model->customGet($options);
        
        $spOptions = array('table' => 'qyura_specialities', 'order' => array('specialities_name' => 'asc'),'select'=>'specialities_name as speName,specialities_id as speId','where'=>array('specialities_deleted'=>0,'type' => 1,'status' => 1));
        $data['spOptions'] = $this->common_model->customGet($spOptions);
        $data['title'] = 'Add Appointments';
        $data['allStates'] = $this->docappointment->fetchStates();
        $this->load->super_admin_template('adddocappointment', $data, 'addAppScript');
    }

    function getpatient() {
        
        $patient_email = $this->input->post("patient_email");
        $patient_mobile = $this->input->post("patient_mobile");
        
                
        $option = array(
            'table' => 'qyura_users',
            'select' => '*',
            'where' => array('qyura_users.users_deleted' => 0,'qyura_users.users_email' => $patient_email),
            'or_where' => array('qyura_users.users_mobile' => $patient_mobile),
            'single' => TRUE
        );
        $email = $this->common_model->customGet($option);
        
        if(!empty($email)){
            $options = array(
                'select'=>'qyura_users.users_id as user_id,qyura_users.users_mobile as mobile,qyura_patientDetails.patientDetails_cityId as cityId,qyura_patientDetails.patientDetails_stateId as stateId,qyura_patientDetails.patientDetails_countryId as countryId,qyura_patientDetails.patientDetails_patientName as patientName,qyura_patientDetails.patientDetails_address as address,qyura_patientDetails.patientDetails_unqId as unqId,qyura_patientDetails.patientDetails_pin as pin,qyura_patientDetails.patientDetails_dob as dob,qyura_patientDetails.patientDetails_gender as gender,qyura_users.users_email as users_email',
                'table' => 'qyura_users',
                'where' => array('qyura_users.users_deleted' => 0, 'qyura_users.users_email' => $patient_email,'qyura_usersRoles.usersRoles_roleId' => 6),
                'or_where'=>array('qyura_users.users_mobile' => $patient_mobile),
                'join' => array(
                    array('qyura_usersRoles', 'qyura_usersRoles.usersRoles_userId = qyura_users.users_id', 'left'),
                    array('qyura_patientDetails', 'qyura_patientDetails.patientDetails_usersId = qyura_users.users_id', 'left'),
                    array('qyura_country', 'qyura_country.country_id = qyura_patientDetails.patientDetails_countryId', 'left')
                ),
                'single'=>true
            );
            $data = $this->common_model->customGet($options);

            if(isset($data) && $data != null){
                echo json_encode($data);
            }else{
                $data['id'] = $email->users_id;
                $data['email_status'] = 1;
                echo json_encode($data);
            }
        }else{
            echo 0;
        }
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
                    $option .= '<option value="' . $hospi->hospital_id .','. $hospi->hospital_usersId. '">' . $hospi->hospital_name . '</option>';
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
                    $option .= '<option value="' . $diagno->diagnostic_id .','. $diagno->diagnostic_usersId. '">' . $diagno->diagnostic_name . '</option>';
                }
            } else {
                $option .= '<option value=""> Diagnostic not available. </option>';
            }
        }
        echo $option;
    }

    public function get_timeSlot() {
        $mId = $this->input->post('miId');
        $quotation_id = $this->input->post('quotation_id');
        
        $timeSlotId = $this->input->post('timeSlotId');
        $data['timeSlots'] = $this->docappointment->getTimeSlot($mId,$quotation_id);
        dump($this->db->last_query());
        $data['timeSlotId']=$timeSlotId;
        
        if($data['timeSlots'])
        $dateTime = $data['timeSlots'][0]->quotation_dateTime;
        
        $data['mId']=  $mId;
        $data['quotation_id']= $quotation_id;
        $data['date'] = date('Y-m-d', $dateTime);
        $data['time'] = date('h:i A', $dateTime);
        $this->load->view('changetimeSlot', $data);
    }

    public function Save_timeSlot() {

        $mId = $this->input->post('miId');
        $mId = $this->input->post('quotation_id');
        $appointmentDate = $this->input->post('appointmentDate');
        $session = $this->input->post('session');
        $finalTime = $this->input->post('finalTime');
        echo strtotime("$appointmentDate $finalTime");
        
        $timeSlotArray = array(
            'quotation_timeSlotId' => $session,
            'quotation_dateTime' => strtotime("$appointmentDate $finalTime")
        );
        $this->db->where(array('quotation_MiId'=>$mId,'quotation_id'=>$quotation_id));
        $this->db->update('qyura_quotations', $timeSlotArray);
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
        
        $cityData = $this->docappointment->fetchCity($stateId);
        
        $cityOption = '';
        $cityOption .='<option value=>Select Your City</option>';
        foreach ($cityData as $key => $val) {
            $cityOption .= '<option value=' . $val->city_id . '>' . strtoupper($val->city_name) . '</option>';
        }
        echo $cityOption;
        exit;
    }
    
    /**
     * @project Qyura
     * @method addAppointmentSave
     * @description save appointment details
     * @access public
     * @param 
     * @return insert id
     */
    function addAppointmentSave(){
 
        //generol details
        $this->bf_form_validation->set_rules("input1","City", 'required|xss_clean');
        $this->bf_form_validation->set_rules("input2","Specialities", 'required|xss_clean');
        $this->bf_form_validation->set_rules("input3","Doctor", 'required|xss_clean');
        $this->bf_form_validation->set_rules("input4","Date", 'required|xss_clean');
        $this->bf_form_validation->set_rules("input5","Time Slot", 'required|xss_clean');
        
        $this->bf_form_validation->set_rules("input8","Remark", 'required|xss_clean');
        $this->bf_form_validation->set_rules("input24","Final Time", 'required|xss_clean');
        
        //user
        $this->bf_form_validation->set_rules("input9","Patient Email", 'required|xss_clean');
        $this->bf_form_validation->set_rules("input10","Mobile Number ", 'required|xss_clean');
        $this->bf_form_validation->set_rules("input12","Name", 'required|xss_clean');
        $this->bf_form_validation->set_rules("input13","Country ", 'required|xss_clean');
        $this->bf_form_validation->set_rules("input14","State ", 'required|xss_clean');
        $this->bf_form_validation->set_rules("input15","City", 'required|xss_clean');
        $this->bf_form_validation->set_rules("input16","Zip", 'required|xss_clean');
        $this->bf_form_validation->set_rules("input17","Address", 'required|xss_clean');
        //payment 
        $this->bf_form_validation->set_rules("input18","Consulation Fee", 'required|xss_clean');
        $this->bf_form_validation->set_rules("input19","Other Fee", 'required|xss_clean');
        $this->bf_form_validation->set_rules("input20","Tax", 'required|xss_clean');
        $this->bf_form_validation->set_rules("input21","Total Amount ", 'required|xss_clean');
        $this->bf_form_validation->set_rules("input22","Payment Status", 'required|xss_clean');
        $this->bf_form_validation->set_rules("input23","Payment Mode", 'required|xss_clean');
        $this->bf_form_validation->set_rules("input26","DOB", 'required|xss_clean');
        $this->bf_form_validation->set_rules("input27","Gender", 'required|xss_clean');
        if ($this->bf_form_validation->run() == FALSE) {
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => ajax_validation_errors());
            echo json_encode($responce);
        } else {
            
            //User Deitails
            $user_id = $this->input->post('user_id');
            $email_status = $this->input->post('email_status');
            
            //insert new user
            $email = $this->email = strtolower($this->input->post('input9'));
            $username = explode('@', $email);
            $username = $this->username = $username[0];
            $length = 10;
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $password = '';
            for ($i = 0; $i < $length; $i++) {
                $password .= $characters[rand(0, strlen($characters) - 1)];
            }
            $user_mobile = $this->input->post('input10');

            $user_name = $this->input->post('input12');
            $user_country = $this->input->post('input13');
            $user_state = $this->input->post('input14');
            $user_city = $this->input->post('input15');
            $user_zip = $this->input->post('input16');
            $user_address = $this->input->post('input17');
            $user_dob = strtotime($this->input->post('input26'));
            $user_gender = $this->input->post('input27');
            if (empty($user_id)) {
                if(empty($email_status)){    
                    $optionAuotation = array(
                        'table' => 'qyura_users',
                        'data' => array(
                            'users_username' => $username,
                            'users_password' => $password,
                            'users_email' => $email,
                            'users_mobile' => $user_mobile,
                            'users_active' => 1,
                            'users_deleted' => 0,
                            'creationTime' => strtotime(date('Y-m-d H:i:s'))
                        )
                     );
                    $user_id = $this->common_model->customInsert($optionAuotation);
		    $email_status = 1;
                }
            
            }
            if (!empty($user_id)) {
                if(!empty($email_status)){
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
                            'patientDetails_dob' => $user_dob,
                            'patientDetails_gender' => $user_gender,
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
                    $user_id = $user_id;
                }
            }
            
            //Appointment Deitails
            $city = $this->input->post('input1');
            $speciallity = $this->input->post('input2');
            $id = $this->input->post('input3');
            $id = explode(',', $id);
            $doc_id = $id[0];
            if ($id[1]){ $doc_userid = $id[1]; }
            $apoint_date = strtotime($this->input->post('input4'));
            $time_id = $this->input->post('input5');
            $time_id = explode(',', $time_id);
            $timeslot_id = $time_id[0];
            if ($time_id[1]){ $time_session = $time_id[1]; }
            $apoint_status = 12;
            $final_time = strtotime($this->input->post('input24'));
            $hms_id = $this->input->post('input7');
            $patient_remarks = $this->input->post('input8');
            
            //Amount Information
            $cons_fee = $this->input->post('input18');
            $othr_fee = $this->input->post('input19');
            $tax = $this->input->post('input20');
            $total_fee = $this->input->post('input21');
            $pay_status = $this->input->post('input22');
            $pay_mode = $this->input->post('input23');

            //insert doctor appointment
            $family_member = $this->input->post('family_member');
            if($family_member == 1){
                $family_member_id = $this->input->post('input25');
            }else{
                $family_member_id = '';
            }
            $records_array1 = array('creationTime' => strtotime(date('Y-m-d H:i:s')),'doctorAppointment_payMode'=>$pay_mode,'doctorAppointment_payStatus'=>$pay_status,'doctorAppointment_totPayAmount'=>$total_fee,'doctorAppointment_tax'=>$tax,'doctorAppointment_otherFee'=>$othr_fee,'doctorAppointment_consulationFee'=>$cons_fee,'doctorAppointment_HMSId'=>$hms_id,'doctorAppointment_status'=>$apoint_status,'doctorAppointment_ptRmk'=>$patient_remarks,'doctorAppointment_doctorParentId'=>0,'doctorAppointment_pntUserId'=>$user_id,'doctorAppointment_memberId'=>$family_member_id,'doctorAppointment_docType'=>3,'doctorAppointment_doctorUserId'=>$doc_userid,'doctorAppointment_finalTiming'=>$final_time,'doctorAppointment_slotId'=>$timeslot_id,'doctorAppointment_session'=>$time_session,'doctorAppointment_date'=>$apoint_date,'doctorAppointment_specialitiesId'=>$speciallity);                
            $options = array(
                'data' => $records_array1,
                'table' => 'qyura_doctorAppointment'
            );
            $qyura_doctorAppointment = $this->common_model->customInsert($options);
            
            //create/insert unique id
            $where = array('doctorAppointment_id' => $qyura_doctorAppointment);
            $update_data['doctorAppointment_unqId'] =$docUnId= 'DOC'. $user_id . time();
            $options = array(
                'table' => 'qyura_doctorAppointment',
                'where' => $where,
                'data' => $update_data
            );
            $update = $this->common_model->customUpdate($options);
            
            //insert data in transaction table
            $transaction_array1 = array('creationTime' => strtotime(date('Y-m-d H:i:s')),'user_id'=>$user_id,'order_no'=>$docUnId);
            $options = array(
                'data' => $transaction_array1,
                'table' => 'transactionInfo'
            );
            $doc_trasaction = $this->common_model->customInsert($options);
            $crnMsg     =  $this->lang->line("miappointmentReceived");
            $currentDate = date("d-m-Y");
            $cronItemId = $qyura_doctorAppointment;
            $cronArray = array("qyura_fkModuleId" => 3, "qyura_fkUserId" => $user_id, "qyura_cronMsg" => $crnMsg, "qyura_cronTitle" => $this->lang->line("miappointmentTag"), "qyura_fkItemId" => $cronItemId,"qyura_cronDate"=>$currentDate,"qyura_cronMsgsCreation"=>$currentDate);

            $options = array(
                'data' => $cronArray,
                'table' => 'qyura_cronMsgs'
            );

            $cronId = $this->common_model->customInsert($options);
            if ($qyura_doctorAppointment) {
                
                $responce =  array('status'=>1,'msg'=>"Appointment created successfully",'url' =>"docappointment");
            }else
            {
                $error = array("TopError"=>"<strong>Something went wrong while updating your data... sorry.</strong>");
                $responce =  array('status'=>0,'isAlive'=>TRUE,'errors'=>$error);
            }
            echo json_encode($responce);
        }
    }
    
    /**
     * @project Qyura
     * @method appoint_timeSlot
     * @description get time slot related to hospitol or diagnostic
     * @access public
     * @param h_d_id,type
     * @return option
     */
    function appoint_timeSlot(){
        $id = $this->input->post('doc_id');
        $id = explode(',', $id);
        $doc_id = $id[0];
        $doc_userid = $id[1];
        $date = $this->input->post('date');
        $day = date('l', strtotime($date));
        $day_no = getDay($day);
        $option = '';
        $options = array(
            'table' => 'qyura_docTimeTable',
            'where' => array('docTimeTable_doctorId' => $doc_id,'qyura_docTimeTable.docTimeTable_deleted' => 0,'qyura_docTimeDay.docTimeDay_deleted' => 0,'qyura_docTimeDay.docTimeDay_day' => $day_no),
            'join' => array(
                array('qyura_docTimeDay', 'qyura_docTimeDay.docTimeDay_docTimeTableId = qyura_docTimeTable.docTimeTable_id', 'left'),
            ),
        );
        $timeSlot = $this->common_model->customGet($options);
        
        if (isset($timeSlot) && $timeSlot != NULL) {
            $option .= '<option value="">Select Time Slot</option>';
            foreach ($timeSlot as $time) {
                $stay = $time->docTimeTable_stayAt;
                if($stay == 1){
                    $mitype = $time->docTimeTable_MItype;
                    if($mitype == 1){
                        $options = array(
                            'table' => 'qyura_hospital',
                            'select' => 'hospital_name,hospital_id',
                            'where' => array('hospital_id' => $time->docTimeTable_MIprofileId,'hospital_deleted' => 0),
                            'single' => TRUE,
                        );
                        $mi = $this->common_model->customGet($options);
                        $miName = $mi->hospital_name;
                    }else{
                        $options = array(
                            'table' => 'qyura_diagnostic',
                            'select' => 'diagnostic_name,diagnostic_id',
                            'where' => array('diagnostic_id' => $time->docTimeTable_MIprofileId,'diagnostic_deleted' => 0),
                            'single' => TRUE,
                        );
                        $mi = $this->common_model->customGet($options);
                        $miName = $mi->diagnostic_name;
                    }
                }else{
                    $miName = 'Personal Chamber';
                }
                $option .= '<option value="' . $time->docTimeDay_id .','. $time->docTimeTable_id. '">' .date("H:i", strtotime($time->docTimeDay_open))  ." to ". date("H:i", strtotime($time->docTimeDay_close)) ." | ". $miName. '</option>';
            }
        } else {
            $option .= '<option value="">Time slot not available. </option>';
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
    function find_doctor(){
        $city_id = $this->input->post('city_id');
        $special_id = $this->input->post('special_id');
        
        $option = '';
        if (isset($city_id) && isset($special_id)) {
            $doctors = $this->docappointment->getDoctorsList($special_id,$city_id);
            
            if (isset($doctors) && $doctors != NULL) {
                $option .= '<option value="">Select Doctor</option>';
                foreach ($doctors as $doctor) {
                    $option .= '<option value="' . $doctor->id .",".$doctor->userId. '">' . $doctor->name. '</option>';
                }
            } else {
                $option .= '<option value=""> Currently no doctor available in this speciality. </option>';
            }
        }
        echo $option;
    }
    
    function getMember(){
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
                    $option .= '<option value="' . $family->usersfamily_id . '">' . $family->usersfamily_name. '</option>';
                }
            } else {
                $option .= '<option value=""> Currently no member registered with us. </option>';
            }
        }
        echo $option;
    }
    
    function appointment_view($appoint_id){
        $options = array(
            'table' => 'qyura_doctorAppointment',
            'where' => array('qyura_doctorAppointment.doctorAppointment_deleted' => 0,'qyura_doctorAppointment.doctorAppointment_id' => $appoint_id),
            'join' => array(
                array('qyura_doctors', 'qyura_doctors.doctors_userId = qyura_doctorAppointment.doctorAppointment_doctorUserId', 'left'),
                array('qyura_patientDetails', 'qyura_patientDetails.patientDetails_usersId = qyura_doctorAppointment.doctorAppointment_pntUserId', 'left'),
                array('qyura_specialities', 'qyura_specialities.specialities_id = qyura_doctorAppointment.doctorAppointment_specialitiesId', 'left'),
                array('qyura_country', 'qyura_country.country_id = qyura_patientDetails.patientDetails_countryId', 'left'),
                array('qyura_state', 'qyura_state.state_id = qyura_patientDetails.patientDetails_stateId', 'left'),
                array('qyura_city', 'qyura_city.city_id = qyura_patientDetails.patientDetails_cityId', 'left'),
                array('qyura_docTimeDay', 'qyura_docTimeDay.docTimeDay_id = qyura_doctorAppointment.doctorAppointment_slotId', 'left'),
            ),
        );
        $data['title'] = 'View Appointments';
        $data['doctorAppointmentDetails'] = $this->common_model->customGet($options);
       // print_r($data['doctorAppointmentDetails']);exit;
        $this->load->super_admin_template('doctor_appointment_detail', $data, 'miAppScript');
    }
 
    function check_timeslot(){
        $final_timing = strtotime($this->input->post('final_timing'));
        $time_id = $this->input->post('timeslot_id');
        
        $option = array(
            'table' => 'qyura_docTimeDay',
            'select' => 'docTimeDay_open,docTimeDay_close',
            'where' => array('qyura_docTimeDay.docTimeDay_deleted' => 0,'qyura_docTimeDay.docTimeDay_id' => $time_id),
            'single' => TRUE
        );
        $time_slot = $this->common_model->customGet($option);
        $open_time = strtotime($time_slot->docTimeDay_open);
        $close_time = strtotime($time_slot->docTimeDay_close);
        
        if($final_timing >= $open_time && $final_timing <= $close_time){
            echo json_encode(TRUE);
        } else {
            echo json_encode(FALSE);
        }
    }
    
    public function changestatus() {
        $myid = $this->input->post('myid');
        $appfor = $this->input->post('ele');
        $status = $this->input->post('status');

        if ($appfor == "1") {
            $update = array("doctorAppointment_status" => $status);
            $this->db->where(array('doctorAppointment_id' => $myid));
            $this->db->update('qyura_doctorAppointment', $update);
        } else {
            $update = array("quotation_qtStatus" => $status);
            $this->db->where(array('quotation_id' => $myid));
            $this->db->update('qyura_quotations', $update);
        }
        echo $this->db->last_query();
    }
}
