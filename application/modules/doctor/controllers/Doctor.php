<?php

class Doctor extends MY_Controller {

    public $_error = array();
    public $_startTime = '';
    public $_endTime = '';

    public function __construct() {
        parent:: __construct();

        $this->load->model(array('Doctor_model', 'common_model'));
        $this->load->library('datatables');
        $this->load->helper('common');
    }

    function index() {
        $data = array();
        $data['allStates'] = $this->Doctor_model->fetchStates();
        $data['doctorData'] = $this->Doctor_model->fetchDoctorData();
        $data['speciality'] = $this->Doctor_model->fetchSpeciality();
        $data['doctorId'] = 0;
        $data['title'] = 'List Doctor';
        $this->load->super_admin_template('doctorListing', $data, 'doctorScript');
    }

    function getDoctorDl() {
        echo $this->Doctor_model->fetchDoctorDataTables();
    }

    function addDoctor() {
        $data = array();
        $data['allStates'] = $this->Doctor_model->fetchStates();
        $data['speciality'] = $this->Doctor_model->fetchSpeciality();
        $data['degree'] = $this->Doctor_model->fetchDegree();
        $data['hospital'] = $this->Doctor_model->fetchHospital();
        $data['doctorId'] = 0;
        $data['title'] = 'Add Doctor';
        $this->load->super_admin_template('addDoctor', $data, 'doctorScript');
        //$this->load->view('addDoctor',$data);
    }

    function changeImageDoctor() {
        $this->bf_form_validation->set_rules("doctorAjaxId", "Doctor Id", 'required|xss_clean');

        if ($this->bf_form_validation->run() == FALSE) {
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => ajax_validation_errors());
            echo json_encode($responce);
        } else {

            $user_updated = '';
            $imagesname = '';
            $doctor_id = $this->input->post('doctorAjaxId');
            if (isset($_FILES['avatar_file']['name']) && $_FILES['avatar_file']['name'] != NULL) {

                $path = realpath(FCPATH . 'assets/doctorsImages/');
                $upload_data = $this->input->post('avatar_data');
                $upload_data = json_decode($upload_data);

                $original_imagesname = $this->uploadImageWithThumb($upload_data, 'avatar_file', $path, 'assets/doctorsImages/', './assets/doctorsImages/thumb/', 'doctor');

                if (empty($original_imagesname)) {
                    $this->session->set_flashdata('valid_upload', $this->error_message);
                } else {
                    $imagesname = $original_imagesname;
                }

                $doctor_array = array(
                    'doctors_img' => $imagesname,
                    'modifyTime' => strtotime(date("d-m-Y H:i:s"))
                );
                $updateOptions = array
                    (
                    'where' => array('doctors_id' => $doctor_id),
                    'data' => $doctor_array,
                    'table' => 'qyura_doctors'
                );
                $user_updated = $this->common_model->customUpdate($updateOptions);
            }

            if ($original_imagesname && $user_updated) {
                $responce = array('status' => 1, 'msg' => "Doctor Image change successfully", 'url' => "doctor/doctorDetails/$doctor_id");
            } else {
                $error = array("TopError" => $this->error_message);
                $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $error);
            }
            echo json_encode($responce);
        }
    }

    function saveDoctor() {

        $message = 'The value in &quot;%s&quot; is already being used....';
        $erOption = array(
            'select' => 'userInsurance_insuranceNo as insuranceNo',
            'table' => 'qyura_userInsurance',
            'where' => array('userInsurance_insuranceNo' => isset($_POST['insNo']) ? $_POST['insNo'] : '', 'userInsurance_deleted' => 0, 'userInsurance_id <>' => isset($_POST['id']) ? $_POST['id'] : ''),
            'limit' => 1,
            'single' => true,
            'message' => $message
        );

        $this->bf_form_validation->set_rules('doctors_fName', 'Doctors First Name', 'required|trim');
        $this->bf_form_validation->set_rules('doctors_lName', 'Doctors Last Name', 'required|trim');
        $this->bf_form_validation->set_rules('doctors_dob', 'Date of Birth', 'required|trim');
        $this->bf_form_validation->set_rules('doctors_stateId', 'State', 'required|trim');
        $this->bf_form_validation->set_rules('doctors_cityId', 'City', 'required|trim');
        $this->bf_form_validation->set_rules('doctors_pinn', 'Pin', 'required|trim|numeric');
        $this->bf_form_validation->set_rules('doctor_addr', 'Address', 'required|trim');
        $this->bf_form_validation->set_rules('doctors_phn', 'User Phone', 'required|trim|numeric');
        $this->bf_form_validation->set_rules('users_email', 'Users Email', "required|valid_email|trim");//||MUnique[{$Moption}]
        $this->bf_form_validation->set_rules('cnfPassword', 'Password Confirmation', 'trim|required');
        $this->bf_form_validation->set_rules('exp_year', 'Experience year', 'required|trim');
        if (empty($_FILES['avatar_file']['name'])) {
            $this->bf_form_validation->set_rules('avatar_file', 'File', 'required');
        }
        if ($this->bf_form_validation->run($this) === FALSE) {

            $data = array();
            $data['allStates'] = $this->Doctor_model->fetchStates();
            $data['speciality'] = $this->Doctor_model->fetchSpeciality();
            $data['degree'] = $this->Doctor_model->fetchDegree();
            $data['hospital'] = $this->Doctor_model->fetchHospital();
            $this->session->set_flashdata('valid_upload', $this->error_message);
            $data['doctorId'] = 0;
            $data['title'] = 'Add Doctor';
            $this->load->super_admin_template('addDoctor', $data, 'doctorScript');
            return false;
        } else {
   
            $imagesname = '';
            if ($_FILES['avatar_file']['name']) {
                $path = realpath(FCPATH . 'assets/doctorsImages/');
                $upload_data = $this->input->post('avatar_data');
                $upload_data = json_decode($upload_data);

                $original_imagesname = $this->uploadImageWithThumb($upload_data, 'avatar_file', $path, 'assets/doctorsImages/', './assets/doctorsImages/thumb/', 'doctor');

                if (empty($original_imagesname)) {
                    $data['allStates'] = $this->Doctor_model->fetchStates();
                    $data['speciality'] = $this->Doctor_model->fetchSpeciality();
                    $data['degree'] = $this->Doctor_model->fetchDegree();
                    $data['hospital'] = $this->Doctor_model->fetchHospital();
                    $data['doctorId'] = 0;
                    $data['title'] = 'Add Doctor';
                    $this->session->set_flashdata('valid_upload', $this->error_message);
                    $this->load->super_admin_template('addDoctor', $data, 'doctorScript');
                    return false;
                } else {
                    $imagesname = $original_imagesname;
                }
            }

            $doctors_phn = $this->input->post('doctors_phn');
            $pos = strpos($doctors_phn, "0");
            $doctors_phnNo = '';
            if($pos == "0"){ $doctors_phnNo = explode("0", $doctors_phn);  }
            if(isset($doctors_phnNo[1])){ $doctors_phn = $doctors_phnNo[1]; }
            $users_email_status = $this->input->post('users_email_status');
            if ($users_email_status == 0) {
                $users_email = $this->input->post('users_email');
                $users_password = $this->common_model->encryptPassword($this->input->post('users_password'));
                $doctorsInsert = array(
                    'users_email' => $users_email,
                    'users_password' => $users_password,
                    'users_ip_address' => $this->input->ip_address(),
                    'users_mobile' => $this->input->post('users_mobile'),
                    'creationTime' => strtotime(date("Y-m-d H:i:s"))
                );
                $doctors_usersId = $this->Doctor_model->insertDoctorUser($doctorsInsert);
                //dump($this->db->last_query());
            } else {
                $doctors_usersId = $users_email_status;
            }
            if ($users_email_status != 1) {
                $insertusersRoles = array(
                    'usersRoles_userId' => $doctors_usersId,
                    'usersRoles_roleId' => 4,
                    'creationTime' => strtotime(date("Y-m-d H:i:s"))
                );
                if ($referralId != '') {
                    $insertusersRoles['usersRoles_parentId'] = $referralId;
                    $insertusersRoles['usersRoles_parentRole'] = $this->input->post('pRoleId');
                } else {
                    $insertusersRoles['usersRoles_parentId'] = 0;
                }
                $this->Doctor_model->insertUsersRoles($insertusersRoles);
                //dump($this->db->last_query());
            }
            $doctors_fName = $this->input->post('doctors_fName');
            $doctors_lName = $this->input->post('doctors_lName');
            $doctors_dob = $this->input->post('doctors_dob');

            $doctors_countryId = $this->input->post('doctors_countryId');
            $doctors_stateId = $this->input->post('doctors_stateId');
            $isEmergency = $this->input->post('isEmergency');
            $doctors_cityId = $this->input->post('doctors_cityId');

            $doctors_pin = $this->input->post('doctors_pinn');
            $doctors_lat = $this->input->post('lat');
            $doctors_long = $this->input->post('lng');
            
            $doctors_27Src = $this->input->post('doctors_27Src');
            
            $doctor_addr = $this->input->post('doctor_addr');


            
            $home_visit = $this->input->post('home_visit');
            $show_exp = $this->input->post('show_exp');
            $exp_year = $this->input->post('exp_year');
            
            $date = date('Y-m-d');
            $newdate = strtotime ( "-$exp_year year" , strtotime ( $date ) ) ;
            $exp_year = $newdate;
            
            $docatId = $this->input->post('docatId');
            $qapId = $this->input->post('qapIdTb');
            

            $doctorsinserData = array(
                'doctors_fName' => $doctors_fName,
                'doctors_lName' => $doctors_lName,
                'doctors_dob' => strtotime($doctors_dob),
                'doctors_phn' => $doctors_phn,
                'doctors_countryId' => $doctors_countryId,
                'doctors_stateId' => $doctors_stateId,
                'doctors_27Src' => $isEmergency,
                'doctors_cityId' => $doctors_cityId,
                'doctors_pin' => $doctors_pin,
                'doctors_registeredMblNo' => $this->input->post('users_mobile'),
                'doctors_lat' => $doctors_lat,
                'doctors_long' => $doctors_long,
                'doctors_27Src' => $doctors_27Src,
                'doctors_img' => $imagesname,
                'creationTime' => strtotime(date('Y-m-d')),
                'doctors_unqId' => $this->input->post('doctors_unqId'),
                'doctors_userId' => $doctors_usersId,
                'doctors_unqId' => 'DOC' . round(microtime(true)),
                'doctor_addr' => $doctor_addr,
                'doctors_homeVisit' => $home_visit,
                'doctors_showExp' => $show_exp,
                'doctors_expYear' => $exp_year,
                'doctors_docatId' => $docatId,
                'doctors_qapId' => $qapId,
                'doctors_joiningDate' => strtotime(date('Y-m-d')),
                
            );
            $doctorsProfileId = $this->Doctor_model->insertDoctorData($doctorsinserData, 'qyura_doctors');

            $specialitiesIds = $this->input->post('doctorSpecialities_specialitiesId');

            foreach ($specialitiesIds as $key => $val) {
                $doctorSpecialities = array(
                    'doctorSpecialities_doctorsId' => $doctorsProfileId,
                    'doctorSpecialities_specialitiesId' => $val,
                    'creationTime' => strtotime(date('Y-m-d'))
                );
                $this->Doctor_model->insertDoctorData($doctorSpecialities, 'qyura_doctorSpecialities');
                //dump($this->db->last_query());
                unset($doctorSpecialities);
            }

            $doctorAcademic_degreeId = $this->input->post('doctorAcademic_degreeId');
            $doctorSpecialities_specialitiesCatId = $this->input->post('doctorSpecialities_specialitiesCatId');
            $acdemic_addaddress = $this->input->post('acdemic_addaddress');
            $acdemic_addyear = $this->input->post('acdemic_addyear');
            for ($i = 0; $i < count($doctorAcademic_degreeId); $i++) {
                /* here one more table insertion needed for academic image load on qyura_doctorAcademicImage table,
                 *  but write now it is not here
                 */
                if ($doctorAcademic_degreeId[$i] != '' && $doctorSpecialities_specialitiesCatId[$i] != '' && $acdemic_addaddress[$i] != '' && $acdemic_addyear[$i] != '') {
                    $doctorAcademicData = array(
                        'doctorAcademic_degreeId' => $doctorAcademic_degreeId[$i],
                        'doctorAcademic_specialitiesId' => $doctorSpecialities_specialitiesCatId[$i],
                        'doctorAcademic_degreeInsAddress' => $acdemic_addaddress[$i],
                        'doctorAcademic_degreeYear' => $acdemic_addyear[$i],
                        'doctorAcademic_doctorsId' => $doctorsProfileId,
                        'creationTime' => strtotime(date('Y-m-d'))
                    );

                    $this->Doctor_model->insertDoctorData($doctorAcademicData, 'qyura_doctorAcademic');
                    //dump($this->db->last_query());
                    unset($doctorAcademicData);
                }
            }

            

            $totalService = $this->input->post('totalService');
            for ($m = 1; $m <= count($totalService); $m++) {
                $doctors_service = $this->input->post("doctors_service_$m");
                if ($doctors_service != '') {
                    $insert_rec = array(
                        'doctorServices_doctorId' => $doctorsProfileId,
                        'doctorServices_serviceName' => $doctors_service,
                        'creationTime' => strtotime(date("d-m-Y H:i:s")),
                    );
                    $dayOptions = array
                        (
                        'data' => $insert_rec,
                        'table' => 'qyura_doctorServices'
                    );
                    $id = $this->common_model->customInsert($dayOptions);
                    //dump($this->db->last_query());
                }
            }
            $this->session->set_flashdata('message', 'Data inserted successfully !');

            redirect('doctor/addDoctor');
        }
    }

    function fetchCity() {
        //echo "fdadas";exit;
        $stateId = $this->input->post('stateId');
        $cityData = $this->Doctor_model->fetchCity($stateId);
        $cityOption = '';
        $cityOption .='<option value=>Select Your City</option>';
        foreach ($cityData as $key => $val) {
            $cityOption .= '<option value=' . $val->city_id . '>' . strtoupper($val->city_name) . '</option>';
        }
        echo $cityOption;
        exit;
    }

    function fetchHospitalSpeciality() {
        $data = array();
        $hospitalId = $this->input->post('hospitalId');
        $data = $this->Doctor_model->fetchHospitalSpeciality($hospitalId);
        $Speciality = '';
        //$Speciality .='<option value=>Select Your Speciality</option>';
        foreach ($data as $key => $val) {
            $Speciality .= '<option value=' . $val->specialities_id . '>' . $val->specialities_name . '</option>';
        }
        echo $Speciality;
        exit;
    }

    function check_email() {

        $data = 0;
        $user_table_id = '';
        $users_email = $this->input->post('users_email');

        $option = array(
            'table' => 'qyura_users',
            'select' => '*',
            'where' => array('qyura_users.users_deleted' => 0, 'qyura_users.users_email' => $users_email),
            'single' => TRUE
        );
        $email = $this->common_model->customGet($option);

        if ($email != NULL) {
            $option = array(
                'table' => 'qyura_usersRoles',
                'select' => '*',
                'where' => array('qyura_usersRoles.usersRoles_deleted' => 0, 'qyura_usersRoles.usersRoles_userId' => $email->users_id, 'qyura_usersRoles.usersRoles_roleId' => 4),
                'single' => TRUE
            );
            $userRoles = $this->common_model->customGet($option);
            $data = 1;
            if (!empty($userRoles)) {
                echo $data;
            } else {
                $data = $email->users_id;
                echo $data;
            }
        } else {
            echo $data;
        }
        exit;
    }

    function createCSV() {

        $doctorSpecialities_specialitiesId = '';

        if (isset($_POST['doctorSpecialities_specialitiesId']))
            $doctorSpecialities_specialitiesId = $this->input->post('doctorSpecialities_specialitiesId');


        // $where=array('doctors_deleted'=> 0,'doctorSpecialities_specialitiesId'=> $doctorSpecialities_specialitiesId);
        $where = '';
        $array[] = array('Image Name', 'Doctor Name', 'Doctor ID', 'Address', 'Speciality', 'Exprience', 'Date Of Joining', 'Phone Number', 'Mobile Number');
        $data = $this->Doctor_model->createCSVdata($where);

        $arrayFinal = array_merge($array, $data);

        array_to_csv($arrayFinal, 'DoctorDetail.csv');
        return True;
        exit;
    }

    function doctorDetails($doctorId) {
        $data = array();


        $data['MI_reffralId'] =$MI_reffralId= (isset($_GET['reffralId']) && $_GET['reffralId'] != "") ? $_GET['reffralId'] : "";
        
$MainSlot= array();
        
        if($MI_reffralId != ""){
           $data['MainSlot'] =  $this->Doctor_model->getMISlots($MI_reffralId);
        }else{

            $data['MainSlot'] = defalutTimeSlots();
        }
        $data['speciality'] = $this->Doctor_model->fetchSpeciality();
        $data['doctorDetail'] = $doctorDetail = $this->Doctor_model->fetchDoctorData($doctorId);
        
        $option = array(
            'table' => 'qyura_doctorSpecialities',
            'select' => 'doctorSpecialities_specialitiesId',
            'where' => array('qyura_doctorSpecialities.doctorSpecialities_deleted' => 0,'qyura_doctorSpecialities.doctorSpecialities_doctorsId' => $doctorId),
            'single' => FALSE
        );
        $doctorSpecialities = $this->common_model->customGet($option);
        
        $qyura_doctorSpecialities = array();
        foreach($doctorSpecialities as $Specialities){
            array_push($qyura_doctorSpecialities, $Specialities->doctorSpecialities_specialitiesId);
        }
        $data['qyura_doctorSpecialities'] = $qyura_doctorSpecialities;
        
        $option = array(
            'table' => 'qyura_country',
            'select' => '*',
            'order'=>array('qyura_country.country'=>'asc'),
            'single' => FALSE
        );
        $data['qyura_country'] = $this->common_model->customGet($option);
        
        $option = array(
            'table' => 'qyura_state',
            'select' => '*',
            'where' => array('qyura_state.state_countryid' => $doctorDetail[0]->doctors_countryId),
            'order'=>array('qyura_state.state_statename'=>'asc'),
            'single' => FALSE
        );
        $data['qyura_state'] = $this->common_model->customGet($option);
        
        $option = array(
            'table' => 'qyura_city',
            'select' => '*',
            'where' => array('qyura_city.city_stateid' => $doctorDetail[0]->doctors_stateId),
            'order'=>array('qyura_city.city_name'=>'asc'),
            'single' => FALSE
        );
        $data['qyura_city'] = $this->common_model->customGet($option);
        
        $avWhere = array('doctorAvailability_docUsersId' => $data['doctorDetail'][0]->doctors_userId);
        $data['doctorAvailability'] = $doctorAvailability = $this->Doctor_model->getDoctorAvailability($avWhere);



        $data['showStatus'] = 'none';
        $data['detailShow'] = 'block';
        $option = array(
            'table' => 'qyura_hospital',
            'select' => '*',
            'where' => array('qyura_hospital.hospital_deleted' => 0),
            'order' => array('qyura_hospital.hospital_name' => 'asc'),
            'single' => FALSE
        );
        $data['qyura_hospital'] = $this->common_model->customGet($option);
        $option = array(
            'table' => 'qyura_degree',
            'select' => '*',
            'where' => array('qyura_degree.degree_deleted' => 0),
            'order' => array('qyura_degree.degree_SName' => 'asc'),
            'single' => FALSE
        );
        $data['qyura_degree'] = $this->common_model->customGet($option);
        $option = array(
            'table' => 'qyura_specialitiesCat',
            'select' => '*',
            'where' => array('qyura_specialitiesCat.specialitiesCat_deleted' => 1),
            'order' => array('qyura_specialitiesCat.specialitiesCat_name' => 'asc'),
            'single' => FALSE
        );
        $data['qyura_specialitiesCat'] = $this->common_model->customGet($option);

        $option = array(
            'table' => 'qyura_professionalExp',
            'select' => 'professionalExp_id ,professionalExp_designation ,professionalExp_usersId,professionalExp_hospitalId,professionalExp_start,professionalExp_end,hospital_name,hospital_id,hospital_address',
            'where' => array('qyura_professionalExp.professionalExp_deleted' => 0, 'qyura_professionalExp.professionalExp_usersId' => $doctorId),
            'join' => array(
                array('qyura_hospital', 'qyura_hospital.hospital_id = qyura_professionalExp.professionalExp_hospitalId', 'left')
            ),
            'single' => FALSE
        );
        $professional_exp = $this->common_model->customGet($option);

        
        $option = array(
            'table' => 'qyura_doctorServices',
            'select' => '*',
            'where' => array('qyura_doctorServices.doctorServicess_deleted' => 0,'qyura_doctorServices.doctorServices_doctorId' => $doctorId),
            'order'=>array('qyura_doctorServices.doctorServices_serviceName'=>'asc'),
            'single' => FALSE
        );
        $data['qyura_services'] = $this->common_model->customGet($option);
        

        $where = array("doctorAvailability_docUsersId" => 46);

        $data['exprerience'] = $this->Doctor_model->fetchExprience($doctorId);
        $data['doctorAcademic'] = $this->Doctor_model->fetchAcademic($doctorId);
        $data['timeSlots'] = $this->Doctor_model->getDoctorAvailability($where);
        $data['publishHospital'] = $this->Doctor_model->fetchPublishHospital();
        $data['title'] = 'Doctor Details';
        $this->load->super_admin_template('doctorDetails', $data, 'doctorScript');
    }

    function availability() {

        $selectedDays = array();

        if (isset($_POST['day']) && $_POST['day'] != NULL) {
            foreach ($_POST['day'] as $key => $day) {
                array_push($selectedDays, $day);
                for ($i = 0; $i < 3; $i++) {
////                    "0_session_0_st";
//                    $this->bf_form_validation->set_rules($day.'_session_'.$i."_st", 'Start Time', 'xss_clean|trim|required');
//                    $this->bf_form_validation->set_rules($day.'_session_'.$i."_ed", 'End Time', 'xss_clean|trim|required');
//
//                    if ($this->bf_form_validation->run($this) == FALSE) {
//                        // setup the input
//                        $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
//                        $this->response($response, 400);
//                    } else {
//                        
//                    }
//                    $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $this->_error,'custom'=>1);
//                    echo json_encode($responce);
                    $start = $_POST["{$day}_session_{$i}_st"];
                    $end = $_POST["{$day}_session_{$i}_ed"];

                    $session = getDoctorAvailibilitySession($i);
                    $dayName = convertNumberToDay($day);
                    $this->_startTime = $start = trim($start);
                    $this->_endTime = $end = trim($end);

                    if ($i == 0 && ($start != '' || $end != ''))
                        $this->checkMorningTime($start, $end, $session, $dayName, $i, $day);

                    if ($i == 1 && ($start != '' || $end != ''))
                        $this->checkAfternoonTime($start, $end, $session, $dayName, $i, $day);

                    if ($i == 2 && ($start != '' || $end != ''))
                        $this->checkEveningTime($start, $end, $session, $dayName, $i, $day);

                    if ($i == 3 && ($start != '' || $end != ''))
                        $this->checkNightTime($start, $end, $session, $dayName, $i, $day);
                }
            }
        }else {
            $this->_error['er_TopError'] = "Please seclect the respective day for slot!!";
        }

        if (count($this->_error)) {
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $this->_error, 'custom' => 1);
            echo json_encode($responce);
        } else {

            $this->db->trans_start();
            $docUserId = $this->input->post('doctors_userId');
            $refferalId = $this->input->post('doctors_refferalId');

            $con = array('doctorAvailability_docUsersId' => $docUserId);
            $days = $this->Doctor_model->getDoctorAvailableOnDays($con);
            $preDays = array();
            if (isset($days) && $days != null) {
                foreach ($days as $day) {
                    array_push($preDays, $day->day);
                }
            }

            $newAvabilityIds = array();

            foreach ($selectedDays as $selectedDay) {
                if (!in_array($selectedDay, $preDays)) {
                    $records_day = array('doctorAvailability_docUsersId' => $docUserId, 'doctorAvailability_day' => $selectedDay);
                    $dayOptions = array
                        (
                        'data' => $records_day,
                        'table' => 'qyura_doctorAvailability'
                    );
//                    dump($dayOptions);
//                    $id = $this->common_model->customInsert($dayOptions);
                    $this->db->insert('qyura_doctorAvailability', $records_day);
                    $id = $this->db->insert_id();
                    array_push($newAvabilityIds, $id);
                }
            }

            $records_day = array('doctorAvailability_docUsersId' => $docUserId, 'doctorAvailability_deleted' => 0);
            $dayOptions = array(
                'where' => $records_day,
                'table' => 'qyura_doctorAvailability',
                'single' => FALSE,
                'select' => 'doctorAvailability_id AS id',
            );
            $availabilityids = $this->common_model->customGet($dayOptions);
//                } 
//            }

            foreach ($availabilityids as $id) {
                $delCon = array('doctorAvailability_refferalId' => $refferalId, 'doctorAvailability_doctorAvailabilityId' => $id->id);
                $this->db->update("qyura_doctorAvailabilitySession", array("doctorAvailabilitySession_deleted" => 1), $delCon);
            }

            foreach ($_POST['day'] as $key => $day) {
                $records_day = array('doctorAvailability_docUsersId' => $docUserId, 'doctorAvailability_day' => $day, 'doctorAvailability_deleted' => 0);

                $dayOptions = array
                    (
                    'where' => $records_day,
                    'table' => 'qyura_doctorAvailability',
                    'single' => true,
                    'select' => 'doctorAvailability_id AS id',
                );

                $availabilityid = $this->common_model->customGet($dayOptions);

                for ($i = 0; $i < 3; $i++) {
                    $start = $_POST["{$day}_session_{$i}_st"];
                    $end = $_POST["{$day}_session_{$i}_ed"];
                    $start = $start = trim($start);
                    $end = $end = trim($end);
                    if ($start != '' && $end != '') {
                        $insert_rec = array('doctorAvailability_refferalId' => $refferalId, 'doctorAvailabilitySession_type' => $i, 'doctorAvailability_doctorAvailabilityId' => $availabilityid->id, 'doctorAvailabilitySession_start' => date("H:i:s", strtotime(date("Y-m-d") . " " . $start)), 'doctorAvailabilitySession_end' => date("H:i:s", strtotime(date("Y-m-d") . " " . $end)));

                        $this->db->insert('qyura_doctorAvailabilitySession', $insert_rec);
                    }
                }
            }

            $responce = array('status' => 1, 'isAlive' => TRUE, 'success' => "Time slotes managed successfully!!");
            echo json_encode($responce);
        }
        $this->db->trans_complete();
    }

    function checkMorningTime($satrt, $end, $session, $day, $sessionInx, $dayIndex) {

        if (!preg_match('/^([1-9]|1[0-2]):([0-5][0-9]) (AM)$/', $satrt)) {
            $this->_error[getDay($day) . '_session_' . convertNumberToSession($session) . '_st'] = "Wrong start time $session $day $satrt";
        }

        if (!preg_match('/^([1-9]|1[0-2]):([0-5][0-9]) (AM)$/', $end)) {

            $this->_error[getDay($day) . '_session_' . convertNumberToSession($session) . '_ed'] = "Wrong End time $session $day $end";
        }

        $satrt = getStr($satrt);
        $end = getStr($end);

        $limitStart = getStr("06:00 AM");
        $limitEnd = getStr("11:59 AM");

        $this->timeSessionCheck($satrt, $end, $session, $day, $limitStart, $limitEnd);
    }

    function checkAfternoonTime($satrt, $end, $session, $day, $sessionInx, $dayIndex) {

        if (!preg_match('/^([1-9]|1[0-2]):([0-5][0-9]) (PM)$/', $satrt)) {
            $this->_error[getDay($day) . '_session_' . convertNumberToSession($session) . '_st'] = "Wrong Formate start time $session $day $satrt";
        }

        if (!preg_match('/^([1-9]|1[0-2]):([0-5][0-9]) (PM)$/', $end)) {
            $this->_error[getDay($day) . '_session_' . convertNumberToSession($session) . '_ed'] = "Wrong Formate End time $session $day $end";
        }

        $satrt = getStr($satrt);
        $end = getStr($end);

        $limitStart = getStr("12:00 PM");
        $limitEnd = getStr("05:59 PM");

        $this->timeSessionCheck($satrt, $end, $session, $day, $limitStart, $limitEnd);
    }

    function checkEveningTime($satrt, $end, $session, $day, $sessionInx, $dayIndex) {

        if (!preg_match('/^([1-9]|1[0-2]):([0-5][0-9]) (PM)$/', $satrt)) {
            $this->_error[getDay($day) . '_session_' . convertNumberToSession($session) . '_st'] = "Wrong Formate start time $session $day $satrt";
        }

        if (!preg_match('/^([1-9]|1[0-2]):([0-5][0-9]) (PM)$/', $end)) {
            $this->_error[getDay($day) . '_session_' . convertNumberToSession($session) . '_ed'] = "Wrong Formate End time $session $day $end";
        }
        $satrt = getStr($satrt);
        $end = getStr($end);

        $limitStart = getStr("06:00 PM");
        $limitEnd = getStr("10:59 PM");

        $this->timeSessionCheck($satrt, $end, $session, $day, $limitStart, $limitEnd);
    }

    function checkNightTime($satrt, $end, $session, $day, $sessionInx, $dayIndex) {

        if (!preg_match('/^([1-9]|1[0-2]):([0-5][0-9]) (PM|AM)$/', $satrt)) {
            $this->_error[getDay($day) . '_session_' . convertNumberToSession($session) . '_st'] = "Wrong Formate start time $session $day $satrt";
        }

        if (!preg_match('/^([1-9]|1[0-2]):([0-5][0-9]) (PM|AM)$/', $end)) {
            $this->_error[getDay($day) . '_session_' . convertNumberToSession($session) . '_ed'] = "Wrong Formate End time $session $day $end";
        }
        $nextStart = $satrt = getStr($satrt);
        $nextEnd = $end = getStr($end);

        $limitStart = getStr("11:00 PM");
        $limitEnd = getStr("05:59 AM");

        $nextLimitStart = getNextDayStr($limitStart);
        $nextLimitEnd = getNextDayStr($limitEnd);

        $this->timeSessionCheck($satrt, $end, $session, $day, $limitStart, $limitEnd);
    }

    function timeSessionCheck($startTime, $endTime, $session, $day, $limitStart, $limitEnd, $nextStart = NULL, $nextEnd = NULL) {

        $dayEnd = strtotime(date("Y-m-d", strtotime("+1 day" . date("Y-m-d"))) . " 05:59 AM");
        $dayStart = strtotime(date("Y-m-d") . " 10:59 PM");

        if ($session == "Night") {
            if (($startTime > $dayStart && $startTime < $dayEnd) && ($endTime > $dayStart && $endTime < $dayEnd)) {
                $this->_error[getDay($day) . '_session_' . convertNumberToSession($session) . '_st'] = "Check and enter correct time between the Night range";
            }
        } else {
            if ($startTime < $limitStart && $startTime > $endTime) {
                $this->_error[getDay($day) . '_session_' . convertNumberToSession($session) . '_st'] = "Start time must be after " . date('h:i A', $limitStart) . " for $session $day";
            }

            if ($endTime > $limitEnd) {
                $this->_error[getDay($day) . '_session_' . convertNumberToSession($session) . '_ed'] = "End time must be before " . date('h:i A', $limitEnd) . " for $session $day";
            }

            if ($startTime > $endTime) {
                $this->_error[getDay($day) . '_session_' . convertNumberToSession($session) . '_st'] = "Start time should be less than end time for $session $day";
            }
        }


//        if ($startTime > $dayEnd) {
//
//            $tempNextStart = getNextDayStr($nextStart);
//            $tempNextEnd = getNextDayStr($nextEnd);
//            $limitStart = getNextDayStr("00:00 AM");
//            $limitEnd = getNextDayStr("05:59 AM");
//            echo $session;
//            dump($tempNextEnd);
//            dump($limitEnd);
//
//            if ($tempNextStart < $limitStart && $tempNextStart > $tempNextEnd) {
//                $this->_error[convertNumberToDay($day).'_session_'.convertNumberToSession($session).'_st'] = "Start time must be after " . date('h:i A', $limitStart) . " for $session $day";
//            }
//
//            if ($tempNextEnd > $limitEnd) {
//                $this->_error[convertNumberToDay($day).'_session_'.convertNumberToSession($session).'_ed'] = "End time must be before " . date('h:i A', $limitEnd) . " for $session $day";
//            }
//
//            if ($tempNextStart > $tempNextEnd) {
//                $this->_error[convertNumberToDay($day).'_session_'.convertNumberToSession($session).'_st'] = "Start time should be less than end time for $session $day";
//            }
//        }
    }

    function nextday() {
        date('Y-m-d', strtotime(' +1 day'));
    }

    //Shoaib
    function changePassword() {
        //print_r($_POST);exit;
        $this->bf_form_validation->set_rules("registered_email", "Registered Email", 'required|xss_clean');
        $this->bf_form_validation->set_rules("register_mobile", "Register Mobile", 'required|xss_clean');
        $this->bf_form_validation->set_rules("password", "Password", 'xss_clean|matches[confirm]');
        $this->bf_form_validation->set_rules("confirm", "Confirm Password", 'xss_clean');

        if ($this->bf_form_validation->run() == FALSE) {
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => ajax_validation_errors());
            echo json_encode($responce);
        } else {
            $userId = $this->input->post('user_id');
            $user_array = array(
                'users_email' => $this->input->post('registered_email'),
                'modifyTime' => strtotime(date("d-m-Y H:i:s"))
            );
            $password = $this->common_model->encryptPassword($this->input->post('password'));
            if ($password != '') {
                $user_array['users_password'] = $password;
            }
            $updateOptions = array
                (
                'where' => array('users_id' => $userId),
                'data' => $user_array,
                'table' => 'qyura_users'
            );
            $user_updated = $this->common_model->customUpdate($updateOptions);

            $records_array = array(
                'doctors_registeredMblNo' => $this->input->post('register_mobile'),
                'modifyTime' => strtotime(date("d-m-Y H:i:s"))
            );
            $updateOption = array
                (
                'where' => array('doctors_userId' => $userId),
                'data' => $records_array,
                'table' => 'qyura_doctors'
            );
            $user_updated = $this->common_model->customUpdate($updateOption);
            $doctorAjaxId = $this->input->post('doctorAjaxId');
            if ($user_updated) {

                $this->session->set_flashdata('active_tag', 5);
                $responce =  array('status'=>1,'msg'=>"Information update successfully",'url' =>"doctor/doctorDetails/$doctorAjaxId");
            }else
            {
                $error = array("TopError"=>"<strong>Something went wrong while updating your data... sorry.</strong>");
                $responce =  array('status'=>0,'isAlive'=>TRUE,'errors'=>$error);

            }
            echo json_encode($responce);
        }
    }

    function addAcademic() {
        $totalAcademic = $this->input->post('total_add_academic');
        for ($j = 1; $j <= $totalAcademic; $j++) {
            $this->bf_form_validation->set_rules("degree_addid_$j", "Degree $j", 'required|xss_clean');
            $this->bf_form_validation->set_rules("acdemic_addaddress_$j", "Acdemic Address $j", 'required|xss_clean');
            $this->bf_form_validation->set_rules("acdemic_addyear_$j", "Acdemic Year $j", 'required|xss_clean');
        }
        if ($this->bf_form_validation->run() == FALSE) {
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => ajax_validation_errors());
            echo json_encode($responce);
        } else {

            $user_insert = '';
            $totalAcademic = $this->input->post('total_add_academic');
            $doctorAjaxId = $this->input->post('doctorAjaxId');

            for ($i = 1; $i <= $totalAcademic; $i++) {
                $degree_id = $this->input->post("degree_addid_$i");
                $acdemic_address = $this->input->post("acdemic_addaddress_$i");
                $acdemic_year = $this->input->post("acdemic_addyear_$i");
                $records_array = array(
                    'doctorAcademic_doctorsId' => $doctorAjaxId,
                    'doctorAcademic_degreeId' => $degree_id,
                    'doctorAcademic_degreeInsAddress' => $acdemic_address,
                    'doctorAcademic_degreeYear' => $acdemic_year,
                    'creationTime' => strtotime(date("d-m-Y H:i:s"))
                );
                $options = array
                    (
                    'data' => $records_array,
                    'table' => 'qyura_doctorAcademic'
                );

                $user_insert = $this->common_model->customInsert($options);
            }

            if ($user_insert) {

                $this->session->set_flashdata('active_tag', 2);
                $responce =  array('status'=>1,'msg'=>"Academic added successfully",'url' =>"doctor/doctorDetails/$doctorAjaxId");
            }else
            {
                $error = array("TopError"=>"<strong>Something went wrong while updating your data... sorry.</strong>");
                $responce =  array('status'=>0,'isAlive'=>TRUE,'errors'=>$error);

            }
            echo json_encode($responce);
        }
    }

    function changeAcademic() {
        $totalAcademic = $this->input->post('totalAcademic');
        for ($j = 1; $j <= $totalAcademic; $j++) {
            $this->bf_form_validation->set_rules("academic_id_$j", "academic id $j", 'required|xss_clean');
            $this->bf_form_validation->set_rules("degree_id_$j", "Degree $j", 'required|xss_clean');
            $this->bf_form_validation->set_rules("acdemic_address_$j", "Acdemic Address $j", 'required|xss_clean');
            $this->bf_form_validation->set_rules("acdemic_year_$j", "Acdemic Year $j", 'required|xss_clean');
        }
        if ($this->bf_form_validation->run() == FALSE) {
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => ajax_validation_errors());
            echo json_encode($responce);
        } else {

            $totalAcademic = $this->input->post('totalAcademic');
            for ($i = 1; $i <= $totalAcademic; $i++) {
                $academic_id = $this->input->post("academic_id_$i");
                $degree_id = $this->input->post("degree_id_$i");
                $acdemic_address = $this->input->post("acdemic_address_$i");
                $acdemic_year = $this->input->post("acdemic_year_$i");
                $records_array = array(
                    'doctorAcademic_degreeId' => $degree_id,
                    'doctorAcademic_degreeInsAddress' => $acdemic_address,
                    'doctorAcademic_degreeYear' => $acdemic_year,
                    'modifyTime' => strtotime(date("d-m-Y H:i:s"))
                );
                $updateOption = array
                    (
                    'where' => array('doctorAcademic_id' => $academic_id),
                    'data' => $records_array,
                    'table' => 'qyura_doctorAcademic'
                );

                $user_updated = $this->common_model->customUpdate($updateOption);
            }
            $doctorAjaxId = $this->input->post('doctorAjaxId');

            $this->session->set_flashdata('active_tag', 2);
            $responce =  array('status'=>1,'msg'=>"Academic update successfully",'url' =>"doctor/doctorDetails/$doctorAjaxId");
            
            echo json_encode($responce);
        }
    }
    
    function addServices(){
        
        $totalService = $this->input->post('totalService');
        for($j = 1; $j <= $totalService; $j++){
            $this->bf_form_validation->set_rules("doctors_service_$j","Services $j", 'required|xss_clean');

        }
        if ($this->bf_form_validation->run() == FALSE) {
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => ajax_validation_errors());
            echo json_encode($responce);
        } else {

            $doctorsProfileId = $this->input->post('doctorAjaxId'); 
            $totalService = $this->input->post('totalService');
            for($m=1; $m <= count($totalService); $m++){
                $doctors_service = $this->input->post("doctors_service_$m");
                if($doctors_service != ''){
                    $insert_rec = array(
                        'doctorServices_doctorId' => $doctorsProfileId, 
                        'doctorServices_serviceName' => $doctors_service, 
                        'creationTime' => strtotime(date("d-m-Y H:i:s")),
                    );
                    $dayOptions = array
                    (
                        'data' => $insert_rec,
                        'table' => 'qyura_doctorServices'
                    );
                    $id = $this->common_model->customInsert($dayOptions);
                }
            }
            if ($id) {
                $this->session->set_flashdata('active_tag', 3);
                $responce =  array('status'=>1,'msg'=>"Services added successfully",'url' =>"doctor/doctorDetails/$doctorsProfileId");
            }else
            {
                $error = array("TopError"=>"<strong>Something went wrong while updating your data... sorry.</strong>");
                $responce =  array('status'=>0,'isAlive'=>TRUE,'errors'=>$error);

            }
            echo json_encode($responce);
        }
    }

    
    function editServices(){
        //print_r($_POST);exit;
        $total_edit_services = $this->input->post('total_edit_services');
        for($j = 1; $j <= $total_edit_services; $j++){
            $this->bf_form_validation->set_rules("services_name_edit_$j","Service $j", 'required|xss_clean');

        }
        if ($this->bf_form_validation->run() == FALSE) {
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => ajax_validation_errors());
            echo json_encode($responce);
        } else {

            
            $total_edit_ser = $this->input->post('total_edit_services');
            $doctorAjaxId = $this->input->post('doctorAjaxId');
            
            for($i = 1; $i <= $total_edit_ser; $i++){
                $services_id = $this->input->post("doctorServices_id_$i");
                $services = $this->input->post("services_name_edit_$i");
                $records_array = array(
                    'doctorServices_doctorId' => $doctorAjaxId,
                    'doctorServices_serviceName'=> $services,
                    'modifyTime' => strtotime(date("d-m-Y H:i:s"))
                );
                $options = array
                (
                    'where' => array('doctorServices_id' => $services_id),
                    'data'  => $records_array,
                    'table' => 'qyura_doctorServices'
                );
                $services_update = $this->common_model->customUpdate($options);
            }
            if ($services_update) {
                $this->session->set_flashdata('active_tag', 3);
                $responce =  array('status'=>1,'msg'=>"Services update successfully",'url' =>"doctor/doctorDetails/$doctorAjaxId");
            }else
            {
                $error = array("TopError"=>"<strong>Something went wrong while updating your data... sorry.</strong>");
                $responce =  array('status'=>0,'isAlive'=>TRUE,'errors'=>$error);

            }
            echo json_encode($responce);
        }
    }

    function changeDetailDoctor() {
        //print_r($_POST);exit;

        $this->bf_form_validation->set_rules("userId","User Id", 'required|xss_clean');
        $this->bf_form_validation->set_rules("doctors_fName","First Name", 'required|xss_clean');
        $this->bf_form_validation->set_rules("doctors_lName","Last Name", 'required|xss_clean');
        $this->bf_form_validation->set_rules("doctors_dob","DOB", 'required|xss_clean');
        $this->bf_form_validation->set_rules("creationTime","DOJ", 'required|xss_clean');
        $this->bf_form_validation->set_rules("users_email","Email", 'required|xss_clean');
        $this->bf_form_validation->set_rules("doctor_addr","Address", 'required|xss_clean');
        $this->bf_form_validation->set_rules("lat","Lat", 'required|xss_clean');
        $this->bf_form_validation->set_rules("lng","Long", 'required|xss_clean');
        
        $this->bf_form_validation->set_rules("doctorSpecialities_specialitiesId[]","Specility", 'required|xss_clean');
        $this->bf_form_validation->set_rules("doctors_phn","Phone", 'required|xss_clean');
        
        

        if ($this->bf_form_validation->run($this) == FALSE) {
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => ajax_validation_errors());
            echo json_encode($responce);
        } else {
            
            $doctorAjaxId = $this->input->post('doctorAjaxId');
            $doctor_id = $this->input->post('doctorAjaxId');
            $option = array(
                'table' => 'qyura_doctorSpecialities',
                'select' => 'doctorSpecialities_specialitiesId',
                'where' => array('qyura_doctorSpecialities.doctorSpecialities_deleted' => 0,'qyura_doctorSpecialities.doctorSpecialities_doctorsId' => $doctor_id),
                'single' => FALSE
            );
            $doctorSpecialities = $this->common_model->customGet($option);
            $oldSpecialities = array();
            foreach($doctorSpecialities as $Specialities){
                array_push($oldSpecialities, $Specialities->doctorSpecialities_specialitiesId);
            }
            $newSpecility = $this->input->post('doctorSpecialities_specialitiesId');
            
            foreach ($newSpecility as $specility) {
                if (!in_array($specility, $oldSpecialities)) {
                    $option = array(
                        'table' => 'qyura_doctorSpecialities',
                        'select' => '*',
                        'where' => array('doctorSpecialities_specialitiesId' => $specility,'doctorSpecialities_doctorsId' => $doctor_id),
                        'single' => TRUE
                    );
                    $oldData = $this->common_model->customGet($option);
                    if (isset($oldData) && $oldData != NULL) {

                        $whereUpdate = array('doctorSpecialities_specialitiesId' => $specility,'doctorSpecialities_doctorsId' => $doctor_id);
                        $arrayResumeData = array('doctorSpecialities_deleted' => 0);
                        $updateOptions = array(
                            'where' => $whereUpdate,
                            'data'  => $arrayResumeData,
                            'table' => 'qyura_doctorSpecialities'
                        );

                        $specilityOldDataResume = $this->common_model->customUpdate($updateOptions);

                    } else {
                       
                        $new_specility_array = array('creationTime' => strtotime(date('Y-m-d h:i:s')),'status' => 3, 'doctorSpecialities_doctorsId' => $doctorAjaxId, 'doctorSpecialities_specialitiesId' => $specility);
                        $options = array
                            (
                            'data'  => $new_specility_array,
                            'table' => 'qyura_doctorSpecialities'
                        );
                        $this->common_model->customInsert($options);
                    }
                }
            }
            
            foreach ($oldSpecialities as $specility) {
                if (!in_array($specility, $newSpecility)) {
                    $whereUpdate = array('doctorSpecialities_specialitiesId' => $specility,'doctorSpecialities_doctorsId' => $doctor_id);
                    $deleteOldSpecility = array('doctorSpecialities_deleted' => 1);
                    $updateOptions = array(
                        'where' => $whereUpdate,
                        'data'  => $deleteOldSpecility,
                        'table' => 'qyura_doctorSpecialities'
                    );
                    $doctorSpecilityDelete = $this->common_model->customUpdate($updateOptions);
                }
            }
            
            $userId = $this->input->post('userId');
            $doctors_fName = $this->input->post('doctors_fName');
            $doctors_lName = $this->input->post('doctors_lName');
            $doctors_dob = strtotime($this->input->post('doctors_dob'));
            $creationTime = strtotime($this->input->post('creationTime'));
            $users_email = $this->input->post('users_email');
            $doctors_address = $this->input->post('doctor_addr');
            $doctors_lat = $this->input->post('lat');
            $doctors_lng = $this->input->post('lng');
            $doctors_phn = $this->input->post('doctors_phn');
            $pos = strpos($doctors_phn, "0");
            $doctors_phnNo = '';
            if($pos == "0"){ $doctors_phnNo = explode("0", $doctors_phn);  }
            if(isset($doctors_phnNo[1])){ $doctors_phn = $doctors_phnNo[1]; }
	    $doctors_27Src = $this->input->post('doctors_27Src');
            
            $home_visit = $this->input->post('home_visit');
            $show_exp = $this->input->post('show_exp');
            $exp_year = $this->input->post('exp_year');
            
            $date = date('Y-m-d');
            $newdate = strtotime ( "-$exp_year year" , strtotime ( $date ) ) ;
            $exp_year = $newdate;
            $docatId = $this->input->post('docatId');
            $qapId = $this->input->post('qapIdTb');
            
            $doctors_countryId = $this->input->post('doctors_countryId');
            $doctors_stateId = $this->input->post('doctors_stateId');
            $doctors_cityId = $this->input->post('doctors_cityId');
            $doctors_pin = $this->input->post('doctors_pinn');
            
            $records_array = array(

                'doctors_fName'       => $doctors_fName,
                'doctors_lName'       => $doctors_lName,
                'doctors_dob'         => $doctors_dob,
                'doctors_joiningDate' => $creationTime,
                'doctors_phn'         => $doctors_phn,
                'doctor_addr'         => $doctors_address,
                'doctors_lat'         => $doctors_lat,
                'doctors_long'        => $doctors_lng,
		'doctors_27Src'       => $doctors_27Src,
                
                'doctors_countryId'   => $doctors_countryId,
                'doctors_stateId'     => $doctors_stateId,
                'doctors_cityId'      => $doctors_cityId,
                'doctors_pin'         => $doctors_pin,
                
                'doctors_homeVisit'   => $home_visit,
                'doctors_showExp'     => $show_exp,
                'doctors_expYear'     => $exp_year,
                'doctors_docatId'     => $docatId,
                'doctors_qapId'       => $qapId,
                
                'modifyTime'          => strtotime(date("d-m-Y H:i:s"))

            );
            $updateOption = array
                (
                'where' => array('doctors_userId' => $userId),
                'data' => $records_array,
                'table' => 'qyura_doctors'
            );
            $doctor_update = $this->common_model->customUpdate($updateOption);
            $user_array = array(
                'users_email' => $users_email,
                'modifyTime' => strtotime(date("d-m-Y H:i:s"))
            );
            $updateOptions = array
                (
                'where' => array('users_id' => $userId),
                'data' => $user_array,
                'table' => 'qyura_users'
            );
            $user_updated = $this->common_model->customUpdate($updateOptions);
            
            if ($doctor_update || $user_updated) {

                $this->session->set_flashdata('active_tag', 1);
                $responce =  array('status'=>1,'msg'=>"Profile update successfully",'url' =>"doctor/doctorDetails/$doctorAjaxId");
            }else
            {
                $error = array("TopError"=>"<strong>Something went wrong while updating your data... sorry.</strong>");
                $responce =  array('status'=>0,'isAlive'=>TRUE,'errors'=>$error);

            }
            echo json_encode($responce);
        }
    }

    function find_specialities() {
        $h_id = $this->input->post('h_id');
        $option = '';
        if ($h_id) {
            $options = array(
                'table' => 'qyura_hospitalSpecialities',
                'where' => array('qyura_hospitalSpecialities.hospitalSpecialities_deleted' => 0, 'qyura_hospitalSpecialities.hospitalSpecialities_hospitalId' => $h_id),
                'join' => array(
                    array('qyura_specialities', 'qyura_specialities.specialities_id = qyura_hospitalSpecialities.hospitalSpecialities_specialitiesId', 'left'),
                    array('qyura_specialitiesCat', 'qyura_specialitiesCat.specialitiesCat_id = qyura_specialities.specialities_specialitiesCatId', 'left'),
                ),
                'group_by' => 'qyura_specialitiesCat.specialitiesCat_id',
            );
            $hospitalSpecialities = $this->common_model->customGet($options);
            if (isset($hospitalSpecialities) && $hospitalSpecialities != NULL) {
                foreach ($hospitalSpecialities as $specialities) {
                    $option .= '<option value="' . $specialities->specialitiesCat_id . '">' . $specialities->specialitiesCat_name . '</option>';
                }
            } else {
                $option .= '<option value=""> Currently there is no data found. </option>';
            }
        }
        echo $option;
    }

    function academicDelete() {
        $del_id = $this->input->post('id');

        if ($del_id) {
            //Group
            $where = array('doctorAcademic_id' => $del_id);
            $update_data['doctorAcademic_deleted'] = 1;
            $updateOptions = array
                (
                'where' => $where,
                'data' => $update_data,
                'table' => 'qyura_doctorAcademic'
            );

            $update = $this->common_model->customUpdate($updateOptions);
            if ($update){
                $this->session->set_flashdata('active_tag', 2);
                echo $update;
            }else{
                echo '0';
            }
        }
        else {
            echo 0;
        }
    }

    
    function serviceDelete() {

        $del_id = $this->input->post('id');

        if ($del_id) {
            //Group
            $where = array('doctorServices_id' => $del_id);
            $update_data['doctorServicess_deleted'] = 1;
            $updateOptions = array
                (
                'where' => $where,
                'data' => $update_data,
                'table' => 'qyura_doctorServices'
            );

            $update = $this->common_model->customUpdate($updateOptions);

            
            if ($update){
                $this->session->set_flashdata('active_tag', 3);

                echo $update;
            }else{
                echo '0';
            }
        }
        else {
            echo 0;
        }
    }

    
    function check_qap(){
        $qapId = $this->input->post('qapId');
        $data = 0;
        $option = array(
            'table' => 'qyura_qap',
            'select' => '*',
            'where' => array('qyura_qap.qap_deleted' => 0,'qyura_qap.qap_code' => $qapId),
            'single' => TRUE
        );
        $qap_data = $this->common_model->customGet($option);
        if(!empty($qap_data)){
            $data = $qap_data->qap_id;
            echo $data;
        }else{
            echo $data;
        }
    }
    
    function addDocTime() {
        $this->bf_form_validation->set_rules('docTimeTable_stayAt', 'stayAt', 'required|trim');
        $this->bf_form_validation->set_rules('docTimeTable_MItype', 'MItype', 'required|trim');
        $this->bf_form_validation->set_rules('docTimeTable_MIprofileId', 'MIprofileId', 'required|trim');
        $this->bf_form_validation->set_rules('docTimeTable_price', 'price', 'required|trim');


        $this->bf_form_validation->set_rules('docTimeDay_day[]', 'day', 'required|trim');
        $this->bf_form_validation->set_rules('docTimeDay_open', 'open', 'required|trim');
        $this->bf_form_validation->set_rules('docTimeDay_close', 'close', 'required|trim');


        dump($_POST['docTimeDay_day']);
        dump($this->bf_form_validation->run($this));

        if ($this->bf_form_validation->run($this) === FALSE) {
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => ajax_validation_errors());
            echo json_encode($responce);
        } else {

            $docTimeTable_stayAt = isset($_POST['docTimeTable_stayAt']) ? $this->input->post() : '';
            $docTimeTable_MItype = isset($_POST['docTimeTable_MItype']) ? $this->input->post('docTimeTable_MItype') : '';
            $docTimeTable_MIprofileId = isset($_POST['docTimeTable_MIprofileId']) ? $this->input->post('docTimeTable_MIprofileId') : '';
            $docTimeTable_price = isset($_POST['docTimeTable_price']) ? $this->input->post('docTimeTable_price') : '';

            $docTimeDay_days = isset($_POST['docTimeDay_day']) ? $this->input->post('docTimeDay_day') : '';
            $docTimeDay_open = isset($_POST['docTimeDay_open']) ? $this->input->post('docTimeDay_open') : '';
            $docTimeDay_close = isset($_POST['docTimeDay_close']) ? $this->input->post('docTimeDay_close') : '';

            $docTimeDay_open = strtotime($docTimeDay_open);
            $docTimeDay_close = strtotime($docTimeDay_close);


            $param = array(
                'table' => 'qyura_docTimeTable',
                'data' => array(
                    'docTimeTable_stayAt' => $docTimeTable_stayAt,
                    'docTimeTable_MItype' => $docTimeTable_MItype,
                    'docTimeTable_MIprofileId' => $docTimeTable_MIprofileId,
                    'docTimeTable_price' => $docTimeTable_price
                )
            );

            $docTimeTableId = $this->common_model->customInsert($param);
            $docTimeDayId = FALSE;
            foreach ($docTimeDay_days as $docTimeDay_day) {
                $param = array(
                    'table' => 'qyura_docTimeDay',
                    'data' => array(
                        'qyura_docTimeDay' => $docTimeDay_day,
                        'docTimeDay_open' => $docTimeDay_open,
                        'docTimeDay_close' => $docTimeDay_close,
                        'docTimeDay_docTimeTableId' => $docTimeTableId
                    )
                );

                $docTimeDayId = $this->common_model->customInsert($param);
            }

            if ($docTimeDayId) {
                $this->session->set_flashdata('active_tag', 4);
                $responce = array('status' => 1, 'msg' => "Time sloat added successfully", 'url' => "master/degree/");
            } else {
                $error = array("TopError" => "<strong>Something went wrong while updating your data... sorry.</strong>");
                $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $error);
            }
            echo json_encode($responce);
        }
    }

    function editDocTime() {

        $this->bf_form_validation->set_rules('docTimeTable_stayAt', 'stayAt', 'required|trim');
        $this->bf_form_validation->set_rules('docTimeTable_MItype', 'MItype', 'required|trim');
        $this->bf_form_validation->set_rules('docTimeTable_MIprofileId', 'MIprofileId', 'required|trim');
        $this->bf_form_validation->set_rules('docTimeTable_price', 'price', 'required|trim');

        $this->bf_form_validation->set_rules('docTimeDay_day[]', 'day', 'required|trim');
        $this->bf_form_validation->set_rules('docTimeDay_open', 'open', 'required|trim');
        $this->bf_form_validation->set_rules('docTimeDay_close', 'close', 'required|trim');


        dump($_POST['docTimeDay_day']);
        dump($this->bf_form_validation->run($this));

        if ($this->bf_form_validation->run($this) === FALSE) {
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => ajax_validation_errors());
            echo json_encode($responce);
        } else {

            $docTimeTable_stayAt = isset($_POST['docTimeTable_stayAt']) ? $this->input->post() : '';
            $docTimeTable_MItype = isset($_POST['docTimeTable_MItype']) ? $this->input->post('docTimeTable_MItype') : '';
            $docTimeTable_MIprofileId = isset($_POST['docTimeTable_MIprofileId']) ? $this->input->post('docTimeTable_MIprofileId') : '';
            $docTimeTable_price = isset($_POST['docTimeTable_price']) ? $this->input->post('docTimeTable_price') : '';

            $docTimeDay_days = isset($_POST['docTimeDay_day']) ? $this->input->post('docTimeDay_day') : '';
            $docTimeDay_open = isset($_POST['docTimeDay_open']) ? $this->input->post('docTimeDay_open') : '';
            $docTimeDay_close = isset($_POST['docTimeDay_close']) ? $this->input->post('docTimeDay_close') : '';
            $docTimeTableId = isset($_POST['docTimeTableId']) ? $this->input->post('docTimeTableId') : '';

            $docTimeDay_open = strtotime($docTimeDay_open);
            $docTimeDay_close = strtotime($docTimeDay_close);
            $selectedDays = $docTimeDay_days;



            $con = array('docTimeDay_docTimeTableId' => $docTimeTableId);
            $days = $this->Doctor_model->getDoctorAvailableOnDaysNew($con);
            $preDays = array();
            if (isset($days) && $days != null) {
                foreach ($days as $day) {
                    array_push($preDays, $day->day);
                }
            }

            $newAvabilityIds = array();

            foreach ($selectedDays as $selectedDay) {
                if (!in_array($selectedDay, $preDays)) {
                    $param = array(
                        'table' => 'qyura_docTimeDay',
                        'data' => array(
                            'qyura_docTimeDay' => $selectedDay,
                            'docTimeDay_open' => $docTimeDay_open,
                            'docTimeDay_close' => $docTimeDay_close,
                            'docTimeDay_docTimeTableId' => $docTimeTableId
                        )
                    );

                    $id = $this->common_model->customInsert($param);
                    array_push($newAvabilityIds, $id);
                }
            }

            foreach ($days as $day) {
                if (!in_array($day->day, $selectedDays)) {
                    $where = array('docTimeDay_day' => $day->day, 'docTimeDay_docTimeTableId' => $docTimeTableId);
                    $records_upg['docTimeTable_deleted'] = 1;
                    $records_upg['modifyTime'] = time();

                    $updateOptions = array
                        (
                        'where' => $where,
                        'data' => $records_upg,
                        'table' => 'qyura_docTimeDay'
                    );

                    $id = $this->common_model->customUpdate($updateOptions);
                }
            }

            if ($id) {
                $this->session->set_flashdata('active_tag', 4);
                $responce = array('status' => 1, 'msg' => "Time sloat updated successfully", 'url' => "master/degree/");
            } else {
                $error = array("TopError" => "<strong>Something went wrong while updating your data... sorry.</strong>");
                $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $error);
            }
            echo json_encode($responce);
        }
    }

    function checkSloat() {
        
    }
}

