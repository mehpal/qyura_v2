<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Miappointment extends MY_Controller {

    public $error_message = '';
    public $perPage = 5;

    public function __construct() {
        parent:: __construct();
        $this->load->model('miappointment_model', 'miappointment', 'common_model');
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
        $this->load->super_admin_template('miAppList', $data, 'miAppScript');
    }

    /**
     * @project Qyura
     * @method getDignostiData
     * @description miAppList listing
     * @access public
     * @return json data for datatable
     */
    public function getDignostiData() {
        echo $this->miappointment->getDiagnostic();
    }

    /**
     * @project Qyura
     * @method getConsultingList
     * @description miAppList listing
     * @access public
     * @return json data for datatable
     */
    public function getConsultingList() {
        echo $this->miappointment->getConsultingList();
    }

    /**
     * @project Qyura
     * @method getHealthpkgList
     * @description miAppList listing
     * @access public
     * @return json data for datatable
     */
    public function getHealthpkgList() {
        echo $this->miappointment->getHealthpkgList();
    }

    /**
     * @project Qyura
     * @method getBloodBankDl
     * @description get records in listing using datatables
     * @access public
     * @return array
     */
    function getBloodBankDl() {
        echo $this->miappointment->fetchbloodBankDataTables();
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
        $data['qtnDetail'] = $this->miappointment->getDetail($qtnId);
        $data['quotationTests'] = $this->miappointment->getQuotationTests($qtnId);
        $data['userDetail'] = $this->miappointment->getQuotationUserDetail($qtnId);
        $data['qtnAmount'] = $this->miappointment->qtTestTotalAmount($qtnId);
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
        $data['appid'] = $appointmentId;
        $data['conDetail'] = $this->miappointment->getConsultingData($appointmentId);
        $data['reports'] = $this->miappointment->getConsultingReport($appointmentId);
        $this->load->super_admin_template('miConAppDetail', $data, 'miAppScript');
    }

    /**
     * @project Qyura
     * @method detail
     * @description detail health PKG appointment
     * @access public
     * @param appointmentId
     * @return html
     */
    public function healthPkgDetail($appointmentId = '') {
        $data = array();
        $data['conDetail'] = $this->miappointment->getHealthPkgDetail($appointmentId);
        $data['reports'] = $this->miappointment->getHealthPkgReport($appointmentId);
        $this->load->super_admin_template('miHealthAppDetail', $data, 'miAppScript');
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
        $catOptions = array('table' => 'qyura_diagnosticsCat', 'order' => array('diagnosticsCat_catName' => 'asc'), 'select' => 'diagnosticsCat_catName as catName,diagnosticsCat_catId as catId', 'where' => array('diagnosticsCat_deleted' => 0, "status" => 1));
        $data['catOptions'] = $this->common_model->customGet($catOptions);

        $spOptions = array('table' => 'qyura_specialities', 'order' => array('specialities_name' => 'asc'), 'select' => 'specialities_name as speName,specialities_specialitiesCatId as speCatId', 'where' => array('specialities_deleted' => 0, 'status' => 1));

        $data['spOptions'] = $this->common_model->customGet($spOptions);
        $data['title'] = "Add Miappointment";
        $data['allStates'] = $this->miappointment->fetchStates();
        $this->load->super_admin_template('addappointment', $data, 'addAppScript');
    }

    function getpatient() {

        $patient_email = $this->input->post("patient_email");
        // $patient_mobile = $this->input->post("patient_mobile");


        $option = array(
            'table' => 'qyura_users',
            'select' => '*',
            'where' => array('qyura_users.users_deleted' => 0, 'qyura_users.users_email' => $patient_email),
            'single' => TRUE
        );
        $email = $this->common_model->customGet($option);

        if (!empty($email)) {
            $options = array(
                'select' => 'qyura_users.users_id as user_id,qyura_users.users_mobile as mobile,qyura_patientDetails.patientDetails_cityId as cityId,qyura_patientDetails.patientDetails_stateId as stateId,qyura_patientDetails.patientDetails_countryId as countryId,qyura_patientDetails.patientDetails_patientName as patientName,qyura_patientDetails.patientDetails_address as address,qyura_patientDetails.patientDetails_unqId as unqId,qyura_patientDetails.patientDetails_pin as pin,FROM_UNIXTIME(qyura_patientDetails.patientDetails_dob,"%d/%m/%Y") as dob,qyura_patientDetails.patientDetails_gender as gender',
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

            if (isset($data) && $data != null) {
                echo json_encode($data);
            } else {
                $data['id'] = $email->users_id;
                $data['email_status'] = 1;
                echo json_encode($data);
            }
        } else {
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
                'where' => array('qyura_hospital.hospital_deleted' => 0, 'qyura_hospital.hospital_cityId' => $city_id, "qyura_hospital.status" => 1),
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
                'where' => array('qyura_diagnostic.diagnostic_deleted' => 0, 'qyura_diagnostic.diagnostic_cityId' => $city_id, "qyura_diagnostic.status" => 1),
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

    public function get_timeSlot() {
        $mId = $this->input->post('miId');
        $quotation_id = $this->input->post('quotation_id');

        $timeSlotId = $this->input->post('timeSlotId');
        $data['timeSlots'] = $this->miappointment->getTimeSlot($mId, $quotation_id);

        $data['timeSlotId'] = $timeSlotId;

        if ($data['timeSlots'])
            $dateTime = $data['timeSlots'][0]->quotation_dateTime;

        $data['mId'] = $mId;
        $data['quotation_id'] = $quotation_id;
        $data['date'] = date('Y-m-d', $dateTime);
        $data['time'] = date('h:i A', $dateTime);
        $this->load->view('changetimeSlot', $data);
    }

    public function savetimeSlot() {

        $final_timing = strtotime($this->input->post('finaltime'));
        $timeslot = $this->input->post('timeSlot');
        $appdate = strtotime($this->input->post('appdate'));
        $myid = $this->input->post('appid');

        $timeslot = explode(',', $timeslot);
        $timeslot_id = $timeslot[0];
        if ($timeslot[1]) {
            $time_session = $timeslot[1];
        }
        if ($timeslot[1] == 0) {
            $time_session = '0';
        }
        $dt = date('Y-m-d', $appdate);
        $tm = date('H:i:s', $final_timing);
        $appdatetime = strtotime($dt . " " . $tm);
        if ($appdatetime >= (strtotime(date("Y-m-d H:i:s")))) {
            
        $updateOption = array(
            'data' => array(
                'doctorAppointment_date' => $appdate,
                'doctorAppointment_slotId' => $timeslot_id,
                'doctorAppointment_finalTiming' => $final_timing,
                'modifyTime' => strtotime(date("Y-m-d")),
            ),
            'table' => 'qyura_doctorAppointment',
            'where' => array('doctorAppointment_id' => $myid)
        );
        $isUpdate = $this->common_model->customUpdate($updateOption);
         $this->session->set_flashdata('message', 'Data updated successfully !');
        redirect('miappointment/consultingDetail/');
        }
        else{
         $this->session->set_flashdata('message', 'Data not updated successfully !');
        redirect('miappointment/consultingDetail/');
        }
       
    }

    public function savediagtimeSlot() {

        $final_timing = strtotime($this->input->post('finaltime'));

        $appdate = strtotime($this->input->post('appdate'));
        $myid = $this->input->post('appid');
        $dt = date('Y-m-d', $appdate);
        $tm = date('H:i:s', $final_timing);
        $appdatetime = strtotime($dt . " " . $tm);

        if ($appdatetime >= (strtotime(date("Y-m-d H:i:s")))) {

            $updateOption = array(
                'data' => array(
                    'quotation_dateTime' => $appdate,
                    'quotations_finalTime' => $final_timing,
                    'modifyTime' => strtotime(date("Y-m-d")),
                ),
                'table' => 'qyura_quotations',
                'where' => array('quotation_id' => $myid)
            );
            $isUpdate = $this->common_model->customUpdate($updateOption);
            
            echo 1;
        } else
            echo 0;
          //echo $this->db->last_query();
    }

    public function getDrTimeSlot() {
        $mId = $this->input->post('doctorParentId');
        $doctorUserId = $this->input->post('doctorUserId');
        $appointmentId = $this->input->post('id');
        $slotId = $this->input->post('slotId');
        $data['timeSlots'] = $this->miappointment->getDrTimeSlot($mId, $doctorUserId);

        $data['appData'] = $this->miappointment->drAppointmentDetail($appointmentId);

        $data['populate'] = $slotId . ',' . $data['appData']->session;

        $data['mId'] = $mId;
        $data['slotId'] = $slotId;
        $data['appointmentId'] = $appointmentId;
        $data['date'] = date('m-d-Y', $data['appData']->date);
        $data['time'] = date('h:i A', $data['appData']->finalTiming);

        $this->load->view('changetimeDrSlot', $data);
    }

    public function Save_timeSlot() {

        $mId = $this->input->post('miId');
        $mId = $this->input->post('quotation_id');
        $appointmentDate = $this->input->post('appointmentDate');
        $session = $this->input->post('session');
        $finalTime = $this->input->post('finalTime');


        $timeSlotArray = array(
            'quotation_timeSlotId' => $session,
            'quotation_dateTime' => strtotime("$appointmentDate $finalTime")
        );
        $this->db->where(array('quotation_MiId' => $mId, 'quotation_id' => $quotation_id));
        $this->db->update('qyura_quotations', $timeSlotArray);
    }

    public function Save_DrtimeSlot() {

        $appointmentDate = $this->input->post('appointmentDate');
        $session = $this->input->post('session');
        $finalTime = $this->input->post('finalTime');
        $miId = $this->input->post('miId');
        $appointmentId = $this->input->post('appointmentId');

        $appointmentDate = strtotime($appointmentDate);
        $finalTime = strtotime($finalTime);
        $session = explode(',', $session);


        $timeSlotArray = array(
            'doctorAppointment_session' => $session[1],
            'doctorAppointment_slotId' => $session[0],
            'doctorAppointment_date' => $appointmentDate,
            'doctorAppointment_finalTiming' => $finalTime
        );
        $this->db->where(array('doctorAppointment_id' => $appointmentId));
        $is_update = $this->db->update('qyura_doctorAppointment', $timeSlotArray);
        if ($is_update)
            echo 1;
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

        $cityData = $this->miappointment->fetchCity($stateId);

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
    function addAppointmentSave() {

        //generol details
        $this->bf_form_validation->set_rules("input1", "City", 'required|xss_clean');
        $this->bf_form_validation->set_rules("input2", "Centre Type", 'required|xss_clean');
        $this->bf_form_validation->set_rules("input3", "Hospital/Diagnostic", 'required|xss_clean');

        $this->bf_form_validation->set_rules("input5", "Appointment Type", 'required|xss_clean');


        // $this->bf_form_validation->set_rules("input8", "Appointment Status", 'required|xss_clean');
        //test or specialities
        $apoint_type = $this->input->post('input5');
        if ($apoint_type == 0) {
            $this->bf_form_validation->set_rules("input6", "Date", 'required|xss_clean');
            $this->bf_form_validation->set_rules("input4", "Time Slot", 'required|xss_clean');
            $this->bf_form_validation->set_rules("input34", "Time", 'required|xss_clean');
            $this->bf_form_validation->set_rules("input10", "Specialities", 'required|xss_clean');
            $this->bf_form_validation->set_rules("input12", "Doctor", 'required|xss_clean');
            $this->bf_form_validation->set_rules("input13", "Remarks", 'required|xss_clean');
        } else {
            $this->bf_form_validation->set_rules("input37", "Time", 'required|xss_clean');
            $this->bf_form_validation->set_rules("input7", "Date", 'required|xss_clean');
            $total_test = $this->input->post('total_test');
            for ($j = 1; $j <= $total_test; $j++) {
                $this->bf_form_validation->set_rules("input28_$j", "Diagnostic Type $j ", 'required|xss_clean');
                $this->bf_form_validation->set_rules("input29_$j", "Test Name $j ", 'required|xss_clean');
                $this->bf_form_validation->set_rules("input30_$j", "Price $j", 'required|xss_clean');
                $this->bf_form_validation->set_rules("input31_$j", "Instruction $j", 'required|xss_clean');
            }
        }
        //user
        $this->bf_form_validation->set_rules("input14", "Patient Email", 'required|xss_clean');
        $this->bf_form_validation->set_rules("input15", "Mobile Number ", 'required|xss_clean');
        $this->bf_form_validation->set_rules("input17", "Name", 'required|xss_clean');
        $this->bf_form_validation->set_rules("input18", "Country ", 'required|xss_clean');
        $this->bf_form_validation->set_rules("input19", "State ", 'required|xss_clean');
        $this->bf_form_validation->set_rules("input32", "City", 'required|xss_clean');
        $this->bf_form_validation->set_rules("input20", "Zip", 'required|xss_clean');
        $this->bf_form_validation->set_rules("input21", "Address", 'required|xss_clean');
        $this->bf_form_validation->set_rules("input35", "DOB", 'required|xss_clean');
        $this->bf_form_validation->set_rules("input36", "Gender", 'required|xss_clean');
        //payment 
        $this->bf_form_validation->set_rules("input22", "Consulation Fee", 'required|xss_clean');
        $this->bf_form_validation->set_rules("input23", "Other Fee", 'required|xss_clean');
        $this->bf_form_validation->set_rules("input24", "Tax", 'required|xss_clean');
        $this->bf_form_validation->set_rules("input25", "Total Amount ", 'required|xss_clean');
        $this->bf_form_validation->set_rules("input26", "Payment Status", 'required|xss_clean');
        $this->bf_form_validation->set_rules("input27", "Payment Mode", 'required|xss_clean');
       
        if ($this->bf_form_validation->run() == FALSE) {
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => ajax_validation_errors());
//            print_r($responce);
//            exit;
            echo json_encode($responce);
        } else {

            $qyura_doctorAppointment = $quotations = '';
            //User Deitails
            $user_id = $this->input->post('user_id');
            $email_status = $this->input->post('email_status');
            //insert new user
            $email = $this->email = strtolower($this->input->post('input14'));
            $username = explode('@', $email);
            $username = $this->username = $username[0];
            $length = 10;
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $password = '';
            for ($i = 0; $i < $length; $i++) {
                $password .= $characters[rand(0, strlen($characters) - 1)];
            }
            $password = $this->common_model->encryptPassword($password);
            $user_mobile = $this->input->post('input15');
            $patient_id = $this->input->post('input16');
            $user_name = $this->input->post('input17');
            $user_country = $this->input->post('input18');
            $user_state = $this->input->post('input19');
            $user_city = $this->input->post('input32');
            $user_zip = $this->input->post('input20');
            $user_address = $this->input->post('input21');
            $user_dob = strtotime($this->input->post('input35'));
            $user_gender = $this->input->post('input36');

            if (empty($user_id)) {
                if (empty($email_status)) {
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

                if (!empty($email_status)) {
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
                            'patientDetails_deleted' => 0,
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
            $familyID = $this->input->post('familyId');
            if (empty($familyID)) {
                $familyID = 0;
            }
            //Appointment Deitails
            $city = $this->input->post('input1');
            $centre_type = $this->input->post('input2');
            $id = $this->input->post('input3');
            $id = explode(',', $id);
            $h_d_id = $id[0];
            if ($id[1]) {
                $h_d_userid = $id[1];
            }

            $time_id = $this->input->post('input4');

            $time_id = explode(',', $time_id);
            $timeslot_id = $time_id[0];
            if ($time_id[1]) {
                $time_session = $time_id[1];
            }
            if ($time_id[1] == 0) {
                $time_session = '0';
            }

            $apoint_type = $this->input->post('input5');
            //$apoint_unid = $this->input->post('input7');
            //$apoint_status = $this->input->post('input8');
            $hms_id = $this->input->post('input9');
            $final_time = strtotime($this->input->post('input34'));
            //Amount Information
            $cons_fee = $this->input->post('input22');
            $othr_fee = $this->input->post('input23');
            $tax = $this->input->post('input24');
            $total_fee = $this->input->post('input25');
            $pay_status = $this->input->post('input26');
            $pay_mode = $this->input->post('input27');

            $family_member = $this->input->post('family_member');
            if ($family_member == 1) {
                $family_member_id = $this->input->post('input33');
            } else {
                $family_member_id = '';
            }
            //insert doctor appointment
            if ($apoint_type == 0) {
                $apoint_date = strtotime($this->input->post('input6'));
                $speciallity = $this->input->post('input10');
                $doc = $this->input->post('input12');
                $doc = explode(",", $doc);
                $doc_id = $doc[0];
                $doc_userid = $doc[1];

                $patient_remarks = $this->input->post('input13');
                if ($centre_type == 0) {
                    $newType = 1;
                } else {
                    $newType = 2;
                }

                $records_array1 = array('creationTime' => strtotime(date('Y-m-d H:i:s')),
                    'doctorAppointment_payMode' => $pay_mode,
                    'doctorAppointment_payStatus' => $pay_status,
                    'doctorAppointment_totPayAmount' => $total_fee,
                    'doctorAppointment_tax' => $tax,
                    'doctorAppointment_otherFee' => $othr_fee,
                    'doctorAppointment_consulationFee' => $cons_fee,
                    //'doctorAppointment_HMSId' => $hms_id,
                    'doctorAppointment_status' => 12,
                    'doctorAppointment_ptRmk' => $patient_remarks,
                    'doctorAppointment_doctorParentId' => $h_d_userid,
                    'doctorAppointment_memberId' => $family_member_id,
                    'doctorAppointment_docType' => $newType,
                    'doctorAppointment_doctorUserId' => $doc_userid,
                    'doctorAppointment_pntUserId' => $user_id,
                    'doctorAppointment_finalTiming' => $final_time,
                    'doctorAppointment_slotId' => $timeslot_id,
                    'doctorAppointment_session' => $time_session,
                    'doctorAppointment_date' => $apoint_date,
                    'doctorAppointment_specialitiesId' => $speciallity
                );

                $options = array(
                    'data' => $records_array1,
                    'table' => 'qyura_doctorAppointment'
                );
                $qyura_doctorAppointment = $this->common_model->customInsert($options);
                $cronItemId = $qyura_doctorAppointment;
                //create/insert unique id
                $where = array('doctorAppointment_id' => $qyura_doctorAppointment);
                $orderno = $update_data['doctorAppointment_unqId'] = $docUnId = 'APDOC' . $user_id . rand(0, 999);
                $options = array(
                    'table' => 'qyura_doctorAppointment',
                    'where' => $where,
                    'data' => $update_data
                );
                $update = $this->common_model->customUpdate($options);

                //insert data in transaction table
                $transaction_array1 = array(
                    'creationTime' => strtotime(date('Y-m-d H:i:s')),
                    'user_id' => $user_id,
                    'order_no' => $docUnId
                );
                $options = array(
                    'data' => $transaction_array1,
                    'table' => 'transactionInfo'
                );
                $doc_trasaction = $this->common_model->customInsert($options);
            } else {

                //insert diagnostics appointment
                $apoint_date = strtotime($this->input->post('input7'));
                $quotationTime = strtotime($this->input->post('input37'));
                $records_array2 = array('creationTime' => strtotime(date('Y-m-d H:i:s')),
                    'quotation_MiId' => $h_d_userid,
                    'quotation_userId' => $user_id,
                    'quotation_familyId' => $family_member_id,
                    'quotation_timeSlotId' => $timeslot_id,
                    'quotation_qtStatus' => 12,
                    'quotation_dateTime' => $apoint_date,
                    'quotation_tex' => $tax,
                    'quotation_otherFee' => $othr_fee,
                    'quotations_finalTime' => $quotationTime,
                    'quotation_cityId' => $city,
                    'quotation_docRefeId' => 0,
                    'quotation_deleted' => 0,
                    'creationTime' => strtotime(date('Y-m-d H:i:s')),
                    'quotation_payMode' => $pay_mode,
                    'quotation_payStatus' => $pay_status,
                );

                $options = array(
                    'data' => $records_array2,
                    'table' => 'qyura_quotations'
                );


                $cronItemId = $quotation_id = $this->common_model->customInsert($options);

                $orderno = $quoUnqId = 'QU' . "_" . $quotation_id . "_" . time();

                $options = array(
                    'table' => 'qyura_quotations',
                    'where' => array('quotation_id' => $quotation_id),
                    'data' => array('quotation_unqId' => $quoUnqId)
                );
                $update = $this->common_model->customUpdate($options);


                $total_test = $this->input->post('total_test');
                for ($i = 1; $i <= $total_test; $i++) {

                    //insert multiple test 
                    $test_type = $this->input->post("input28_" . $i);
                    $test_name = $this->input->post("input29_" . $i);
                    $test_price = $this->input->post("input30_" . $i);
                    $test_instruction = $this->input->post("input31_" . $i);

                    $records_array3 = array('creationTime' => strtotime(date('Y-m-d H:i:s')),
                        'quotationDetailTests_quotationId' => $quotation_id,
                        'quotationDetailTests_diagnosticCatId' => $test_type,
                        'quotationDetailTests_MIprofileId' => $h_d_id,
                        'quotationDetailTests_testName' => $test_name,
                        'quotationDetailTests_date' => $apoint_date,
                        'quotationDetailTests_price' => $test_price,
                        'quotationDetailTests_instruction' => $test_instruction
                    );
                    $options = array(
                        'data' => $records_array3,
                        'table' => 'qyura_quotationDetailTests'
                    );
                    $quotationDetail = $this->common_model->customInsert($options);
                }
                //insert quotations booking 
                $records_array4 = array(
                    'creationTime' => strtotime(date('Y-m-d H:i:s')),
                    'quotationBooking_quotationId' => $quotation_id,
                    'quotationBooking_userId' => $user_id,
                    'quotationBooking_orderId' => $quUnId,
                    'quotationBooking_amount' => $total_fee,
                    'quotationBooking_bookStatus' => 12,
                    'quotation_familyId' => $familyID
                );

                $options = array(
                    'data' => $records_array4,
                    'table' => 'qyura_quotationBooking'
                );
                $quotationBooking = $this->common_model->customInsert($options);
                $bookId = 'DIAD_' . $quotationBooking . '_' . time();
                $updateOption = array(
                    'data' => array(
                        'quotationBooking_orderId' => $bookId,
                    ),
                    'table' => 'qyura_quotationBooking',
                    'where' => array('quotationBooking_id' => $quotationBooking)
                );
                $isUpdate = $this->common_model->customUpdate($updateOption);
            }
            if ($pay_status == 16) {//If Paid then Insert

                //insert data in transaction table
                $transaction_array2 = array(
                    'creationTime' => strtotime(date('Y-m-d H:i:s')),
                    'user_id' => $user_id,
                    'order_no' => $orderno
                );
                $options = array(
                    'data' => $transaction_array2,
                    'table' => 'transactionInfo'
                );
                $digo_trasaction = $this->common_model->customInsert($options);
            }

            $crnMsg = $this->lang->line("miappointmentReceived");
            $currentDate = date("d-m-Y");
            $cronArray = array("qyura_fkModuleId" => 1, "qyura_fkUserId" => $user_id, "qyura_cronMsg" => $crnMsg, "qyura_cronTitle" => $this->lang->line("miappointmentTag"), "qyura_fkItemId" => $cronItemId, "qyura_cronDate" => $currentDate, "qyura_cronMsgsCreation" => $currentDate);

            $options = array(
                'data' => $cronArray,
                'table' => 'qyura_cronMsgs'
            );

            $cronId = $this->common_model->customInsert($options);
            if ($cronItemId) {

                $responce = array('status' => 1, 'msg' => "Appointment created successfully", 'url' => "miappointment");
            } else {
                $error = array("TopError" => "<strong>Something went wrong while updating your data... sorry.</strong>");
                $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $error);
            }
            $this->session->set_flashdata('message', 'Data inserted successfully !');
                redirect('miappointment');
            
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
    function appoint_timeSlot() {
        $id = $this->input->post('docid');
        $id = explode(',', $id);
        $doc_id = $id[0];
        $doc_userid = $id[1];

        $date = $this->input->post('appdate');

        $day = date('l', strtotime($date));
        $day_no = getDay($day);
        $option = '';
        $options = array(
            'table' => 'qyura_docTimeTable',
            'where' => array('docTimeTable_doctorId' => $doc_id, 'qyura_docTimeTable.docTimeTable_deleted' => 0, 'qyura_docTimeDay.docTimeDay_deleted' => 0, 'qyura_docTimeDay.docTimeDay_day' => $day_no),
            'join' => array(
                array('qyura_docTimeDay', 'qyura_docTimeDay.docTimeDay_docTimeTableId = qyura_docTimeTable.docTimeTable_id', 'left'),
            ),
        );
        $timeSlot = $this->common_model->customGet($options);

        if (isset($timeSlot) && $timeSlot != NULL) {
            $option .= '<option value="">Select Time Slot</option>';
            foreach ($timeSlot as $time) {
                $stay = $time->docTimeTable_stayAt;
                if ($stay == 1) {
                    $mitype = $time->docTimeTable_MItype;
                    if ($mitype == 1) {
                        $options = array(
                            'table' => 'qyura_hospital',
                            'select' => 'hospital_name,hospital_id',
                            'where' => array('hospital_id' => $time->docTimeTable_MIprofileId, 'hospital_deleted' => 0),
                            'single' => TRUE,
                        );
                        $mi = $this->common_model->customGet($options);
                        $miName = $mi->hospital_name;
                    } else {
                        $options = array(
                            'table' => 'qyura_diagnostic',
                            'select' => 'diagnostic_name,diagnostic_id',
                            'where' => array('diagnostic_id' => $time->docTimeTable_MIprofileId, 'diagnostic_deleted' => 0),
                            'single' => TRUE,
                        );
                        $mi = $this->common_model->customGet($options);
                        $miName = $mi->diagnostic_name;
                    }
                } else {
                    $miName = 'Personal Chamber';
                }
                $option .= '<option value="' . $time->docTimeDay_id . ',' . $time->docTimeTable_id . '">' . date("H:i", strtotime($time->docTimeDay_open)) . " to " . date("H:i", strtotime($time->docTimeDay_close)) . " | " . $miName . '</option>';
            }
        } else {
            $option .= '<option value="">Time slot not available. </option>';
        }
        echo $option;
    }

    /**
     * @project Qyura
     * @method check_timeslot
     * @description check final time within selected time slot
     * @access public
     * @param timeslot_id,timepicker4
     * @return boolen
     */
    function check_timeslot() {

        $final_timing = strtotime($this->input->post('final_timing'));

        $timeslot_id = $this->input->post('timeslot_id');
        $id = explode(',', $timeslot_id);
        $time_id = $id[0];
        $option = array(
            'table' => 'qyura_docTimeDay',
            'select' => 'docTimeDay_open,docTimeDay_close',
            'where' => array('qyura_docTimeDay.docTimeDay_deleted' => 0, 'qyura_docTimeDay.docTimeDay_id' => $time_id),
            'single' => TRUE
        );
        $time_slot = $this->common_model->customGet($option);

        $open_time = strtotime($time_slot->docTimeDay_open);
        $close_time = strtotime($time_slot->docTimeDay_close);

        if ($final_timing >= $open_time && $final_timing <= $close_time) {
           echo json_encode(TRUE);
        } else {
            echo json_encode(FALSE);
        }
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
        $options = array(
            'table' => 'qyura_specialities',
            'where' => array('qyura_specialities.specialities_deleted' => 0, "status" => 1)
        );
        $Specialitieslist = $this->common_model->customGet($options);
        // echo $this->db->last_query();exit;
        if (isset($Specialitieslist) && $Specialitieslist != NULL) {
            $option .= '<option value="">Select Specialities</option>';
            foreach ($Specialitieslist as $specialities) {

                $option .= '<option value="' . $specialities->specialities_id . '">' . $specialities->specialities_name . '</option>';
            }
        } else {
            $option .= '<option value=""> Currently there is no data found. </option>';
        }
        /* if ($type == 0) {
          $options = array(
          'table' => 'qyura_hospitalSpecialities',
          'where' => array('qyura_hospitalSpecialities.hospitalSpecialities_deleted' => 0,'qyura_hospitalSpecialities.hospitalSpecialities_hospitalId' => $h_d_id),
          'join' => array(
          array('qyura_specialities', 'qyura_specialities.specialities_id = qyura_hospitalSpecialities.hospitalSpecialities_specialitiesId', 'left'),
          ),
          'group_by'=> 'qyura_specialities.specialities_id',
          );
          $hospitalSpecialities = $this->common_model->customGet($options);

          if (isset($hospitalSpecialities) && $hospitalSpecialities != NULL) {
          $option .= '<option value="">Select Specialities</option>';
          foreach ($hospitalSpecialities as $specialities) {

          $option .= '<option value="' . $specialities->specialities_id . '">' . $specialities->specialities_name .'</option>';
          }
          } else {
          $option .= '<option value=""> Currently there is no data found. </option>';
          }
          } else {
          $options = array(
          'table' => 'qyura_diagnosticSpecialities',
          'where' => array('qyura_diagnosticSpecialities.diagnosticSpecialities_deleted' => 0,'qyura_diagnosticSpecialities.diagnosticSpecialities_diagnosticId' => $h_d_id),
          'join' => array(
          array('qyura_specialities', 'qyura_specialities.specialities_id = qyura_diagnosticSpecialities.diagnosticSpecialities_specialitiesId', 'left'),
          ),
          'group_by'=> 'qyura_specialities.specialities_id',
          );
          $diagnosticSpecialities = $this->common_model->customGet($options);
          // echo $this->db->last_query();exit;
          if (isset($diagnosticSpecialities) && $diagnosticSpecialities != NULL) {
          $option .= '<option value="">Select Specialities</option>';
          foreach ($diagnosticSpecialities as $specialities) {

          $option .= '<option value="' . $specialities->specialities_id . '">' . $specialities->specialities_name. '</option>';
          }
          } else {
          $option .= '<option value=""> Currently there is no data found. </option>';
          }
          } */
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
    function find_diago_test() {
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
            $doctors = $this->miappointment->getConsultantList($h_d_id, $special_id);
            //echo $this->db->last_query();exit;
            if (isset($doctors) && $doctors != NULL) {
                $option .= '<option value="">Select Doctor</option>';
                foreach ($doctors as $doctor) {
                    $option .= '<option value="' . $doctor['id'] . ',' . $doctor['userId'] . '">' . $doctor['name'] . '</option>';
                }
            } else {
                $option .= '<option value=""> Currently no doctor available in this speciality. </option>';
            }
        }
        echo $option;
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

    /**
     * @project Qyura
     * @method uploadReportsList
     * @description listing completed appointment for upload report
     * @access public
     * @return html
     */
    public function uploadReportsList() {
        $this->load->helper('mi');
        $data = array();
        $reports = $this->miappointment->getUploadReportsList();
        $page = $this->input->post('page');
        if (!$page) {
            $offset = 0;
        } else {
            $offset = $page;
        }

        $this->load->library('Ajax_pagination');
        $config['first_link'] = 'First';
        $config['show_count'] = false;

        $config['div'] = 'reportList'; //parent div tag id
        $config['base_url'] = site_url('miappointment/ajaxUploadReportsList');
        $config['total_rows'] = count($reports);
        $config['per_page'] = 5;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>>';
        $config['first_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['prev_link'] = 'prev';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';

        $this->ajax_pagination->initialize($config);

        $data['reports'] = $reports = $this->miappointment->getUploadReportsList(array('limit' => $this->perPage));
        $this->load->super_admin_template('completedAppList', $data, 'completedAppScript');
    }

    /**
     * @project Qyura
     * @method ajaxUploadReportsList
     * @description listing completed appointment for upload report
     * @access public
     * @return html
     */
    public function ajaxUploadReportsList() {
        $data = array();
        $this->load->helper('mi');
        $this->load->library('Ajax_pagination');
        $search = $this->input->post('search');
        $reports = $this->miappointment->getUploadReportsList(array(), $search);

        $page = $this->input->post('page');

        if (!isset($search))
            $search = '';
        else
            $config['additional_data'] = array('search' => $search);

        if (!$page) {
            $offset = 0;
        } else {
            $offset = $page;
        }



        $config['base_url'] = site_url('miappointment/ajaxUploadReportsList');
        ;
        $config['total_rows'] = count($reports);
        $config['per_page'] = 5;
        $config['per_page'] = $this->perPage;
        $config['div'] = 'reportList';
        $config['show_count'] = false;

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>>';
        $config['first_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['prev_link'] = 'prev';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';

        $this->ajax_pagination->initialize($config);

        $data["reports"] = $this->miappointment->getUploadReportsList(array('start' => $offset, 'limit' => $this->perPage), $search);

        $this->load->view('ajaxCompletedAppList', $data);
    }

    public function export() {
        $search = $this->input->post('search');
        $resultAr = $this->miappointment->getUploadReportsList(array(), $search);


        $result = array();
        $i = 1;
        foreach ($resultAr as $key => $val) {
            $result[$i]['id'] = $val['id'];
            $result[$i]['orderId'] = $val['orderId'];
            $result[$i]['miName'] = $val['miName'];
            $result[$i]['city_name'] = $val['city_name'];
            $result[$i]['userName'] = $val['userName'];
            $result[$i]['userGender'] = $val['userGender'];
            $result[$i]['userAge'] = $val['userAge'];
            $result[$i]['usersMobile'] = $val['usersMobile'];
            $result[$i]['email'] = $val['email'];
            $result[$i]['type'] = $val['type'];
            $i++;
        }
        $colAr[] = array('id', 'orderId', 'miName', 'city_name', 'userName', 'userGender', 'userAge', 'usersMobile', 'email', 'type');
        $arrayFinal = array_merge($colAr, $result);
        array_to_csv($arrayFinal, 'Mireport.csv');
        exit();
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