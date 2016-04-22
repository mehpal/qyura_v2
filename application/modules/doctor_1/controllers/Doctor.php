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
    
    function changeImageDoctor(){
        $this->bf_form_validation->set_rules("doctorAjaxId","Doctor Id", 'required|xss_clean');
        
        if ($this->bf_form_validation->run() == FALSE) {
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => ajax_validation_errors());
            echo json_encode($responce);
        } else{
            
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
                    'doctors_img'   => $imagesname,
                    'modifyTime'    => strtotime(date("d-m-Y H:i:s"))
                );
                $updateOptions = array
                (
                    'where' => array('doctors_id' => $doctor_id),
                    'data'  => $doctor_array,
                    'table' => 'qyura_doctors'
                );
                $user_updated = $this->common_model->customUpdate($updateOptions);
            }

            if ($original_imagesname && $user_updated) {
                $responce =  array('status'=>1,'msg'=>"Doctor Image change successfully",'url' =>"doctor/doctorDetails/$doctor_id");
            }else
            {
                $error = array("TopError"=>$this->error_message);
                $responce =  array('status'=>0,'isAlive'=>TRUE,'errors'=>$error);
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
        $this->bf_form_validation->set_rules('doctors_consultaionFee', 'Consultaion Fees', 'required|trim|numeric');
        $this->bf_form_validation->set_rules('users_mobile', 'User Mobile', 'required|trim|numeric');
        $this->bf_form_validation->set_rules('users_email', 'Users Email', "required|valid_email|trim");//||MUnique[{$Moption}]
        $this->bf_form_validation->set_rules('users_password', 'Password', 'trim|required|matches[cnfPassword]');
        $this->bf_form_validation->set_rules('cnfPassword', 'Password Confirmation', 'trim|required');
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
            $pre_number = $this->input->post('preNumber');
            $midNumber = $this->input->post('midNumber');

            $finalNumber = '';
            for ($i = 0; $i < count($pre_number); $i++) {
                if ($doctors_phn[$i] != '' && $pre_number[$i] != '' && $midNumber[$i] != '') {

                    if ($i == count($pre_number) - 1)
                        $finalNumber .= $pre_number[$i] . ' ' . $midNumber[$i] . ' ' . $doctors_phn[$i];
                    else
                        $finalNumber .= $pre_number[$i] . ' ' . $midNumber[$i] . ' ' . $doctors_phn[$i] . '|';
                }
            }
            $doctors_mobile_number = $this->input->post('doctors_mobile');
            $pre_mobile_number = $this->input->post('preMobileNumber');
            $finalMobileNumber = '';
            $checkbox = 1;
            for ($i = 0; $i < count($pre_mobile_number); $i++) {
                if ($doctors_mobile_number[$i] != '' && $pre_mobile_number[$i] != '') {
                    if ($i == count($pre_mobile_number) - 1) {
                        if (isset($_POST['checkbox' . $checkbox]) == 1)
                            $finalMobileNumber .= $pre_mobile_number[$i] . ' ' . $doctors_mobile_number[$i] . '*' . $checkbox;
                        else
                            $finalMobileNumber .= $pre_mobile_number[$i] . ' ' . $doctors_mobile_number[$i] . '*' . '0';
                    }else {
                        if (isset($_POST['checkbox' . $checkbox]) == 1)
                            $finalMobileNumber .= $pre_mobile_number[$i] . ' ' . $doctors_mobile_number[$i] . '*' . $checkbox . '|';
                        else
                            $finalMobileNumber .= $pre_mobile_number[$i] . ' ' . $doctors_mobile_number[$i] . '*' . '0' . '|';
                    }
                }
                $checkbox ++;
            }
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
		if($referralId != ''){
                    $insertusersRoles['usersRoles_parentId'] = $referralId;
                    $insertusersRoles['usersRoles_parentRole'] = $this->input->post('pRoleId');
                }else{
                    $insertusersRoles['usersRoles_parentId'] = 0;
                }
                $this->Doctor_model->insertUsersRoles($insertusersRoles);
                //dump($this->db->last_query());
            }
            $doctors_fName = $this->input->post('doctors_fName');
            $doctors_lName = $this->input->post('doctors_lName');
            $doctors_dob = $this->input->post('doctors_dob');
            $doctors_phn = $finalNumber;
            $doctors_mobile = $finalMobileNumber;

            $doctors_countryId = $this->input->post('doctors_countryId');
            $doctors_stateId = $this->input->post('doctors_stateId');
            $isEmergency = $this->input->post('isEmergency');
            $doctors_cityId = $this->input->post('doctors_cityId');

            $doctors_pin = $this->input->post('doctors_pinn');
            $doctors_lat = $this->input->post('lat');
            $doctors_long = $this->input->post('lng');
            $doctors_consultaionFee = $this->input->post('doctors_consultaionFee');
            $doctors_27Src = $this->input->post('doctors_27Src');
            $doctor_addr = $this->input->post('doctor_addr');
            $isManual = $this->input->post('isManual');
            
            $doctorsinserData = array(
                'doctors_fName' => $doctors_fName,
                'doctors_lName' => $doctors_lName,
                'doctors_dob' => strtotime($doctors_dob),
                'doctors_phn' => $doctors_phn,
                'doctors_mobile' => $doctors_mobile,
                'doctors_countryId' => $doctors_countryId,
                'doctors_stateId' => $doctors_stateId,
                'doctors_27Src' => $isEmergency,
                'doctors_cityId' => $doctors_cityId,
                'doctors_pin' => $doctors_pin,
                'doctors_registeredMblNo' => $this->input->post('users_mobile'),
                'doctors_lat' => $doctors_lat,
                'doctors_long' => $doctors_long,
                'doctors_consultaionFee' => $doctors_consultaionFee,
                'doctors_27Src' => $doctors_27Src,
                'doctors_img' => $imagesname,
                'creationTime' => strtotime(date('Y-m-d')),
                'doctors_unqId' => $this->input->post('doctors_unqId'),
                'doctors_userId' => $doctors_usersId,
                'doctors_unqId' => 'DOC' . round(microtime(true)),
                'doctor_addr' => $doctor_addr,
                'isManual' => $isManual
            );
            $doctorsProfileId = $this->Doctor_model->insertDoctorData($doctorsinserData, 'qyura_doctors');
            //dump($this->db->last_query());
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
                        'doctorSpecialities_specialitiesCatId' => $doctorSpecialities_specialitiesCatId[$i],
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
            $countsProfessionalExpCount = $this->input->post('ProfessionalExpCount');

            for ($i = 1; $i <= $countsProfessionalExpCount; $i++) {
                /* here one more table insertion needed for academic image load on qyura_doctorAcademicImage table,
                 *  but write now it is not here
                 */
                if (isset($_POST['professionalExp_start' . $i]))
                    $professionalExp_start = strtotime($_POST['professionalExp_start' . $i]);

                if (isset($_POST['professionalExp_end' . $i]))
                    $professionalExp_end = strtotime($_POST['professionalExp_end' . $i]);

                if (isset($_POST['professionalExp_hospitalId' . $i]))
                    $professionalExp_hospitalId = $_POST['professionalExp_hospitalId' . $i];
                
                if (isset($_POST['designation' . $i]))
                    $designation = $_POST['designation' . $i];

                $doctorSpecialities_specialitiesId = '';
                if (isset($_POST['doctorSpecialities_specialitiesId' . $i]))
                    $doctorSpecialities_specialitiesId = $_POST['doctorSpecialities_specialitiesId' . $i];

                //foreach ($doctorSpecialities_specialitiesId as $key => $val) {
                    $dataProfessional = array(
                        'professionalExp_usersId' => $doctorsProfileId,
                        'professionalExp_hospitalId' => $professionalExp_hospitalId,
                        'professionalExp_designation' => $designation,
                        'professionalExp_start' => $professionalExp_start,
                        'professionalExp_end' => $professionalExp_end,
                        'creationTime' => strtotime(date('Y-m-d'))
                    );

                    $profExId = $this->Doctor_model->insertDoctorData($dataProfessional, 'qyura_professionalExp');
                    
                    for($j=0;$j<count($doctorSpecialities_specialitiesId);$j++){
                        if($doctorSpecialities_specialitiesId[$j] != ''){
                            $records_array = array(
                                'proExpCategory_professionalExp_id' => $profExId,
                                'proExpCategory_hospitalId' => $professionalExp_hospitalId,
                                'proExpCategory_specilitycat_id'=> $doctorSpecialities_specialitiesId[$j],
                                'creationTime'    => strtotime(date("d-m-Y H:i:s"))
                            );
                            $options = array
                            (
                                'data'  => $records_array,
                                'table' => 'qyura_proExpCategory'
                            );
                            $exp_insert_new = $this->common_model->customInsert($options);
                        }
                    }
                    //dump($this->db->last_query());
                //}
            }
            
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
            'where' => array('qyura_users.users_deleted' => 0,'qyura_users.users_email' => $users_email),
            'single' => TRUE
        );
        $email = $this->common_model->customGet($option);
        
        if ($email != NULL){
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
        
       $data['allHostpital'] = "";
       
       $data['MI_reffralId'] = $MI_reffralId= (isset($_GET['reffralId']) && $_GET['reffralId'] != "") ? $_GET['reffralId'] : "";
        
$MainSlot= array();
        
        if($MI_reffralId != ""){
           $data['MainSlot'] =  $this->Doctor_model->getMISlots($MI_reffralId);
        }else{
            $data['MainSlot'] = defalutTimeSlots();
        }

        $data['doctorDetail'] = $this->Doctor_model->fetchDoctorData($doctorId);
        $avWhere = array('doctorAvailability_docUsersId' => $data['doctorDetail'][0]->doctors_userId);
        $data['doctorAvailability'] = $doctorAvailability = $this->Doctor_model->getDoctorAvailability($avWhere);

        $explodeStartTime = explode(',', $data['doctorDetail'][0]->startTime);
        $years = 0;
        for ($i = 0; $i < count($explodeStartTime); $i++) {
            $explodeEndTime = explode(',', $data['doctorDetail'][0]->endTime);
            if(isset($data['doctorDetail'][0]->endTime) && $data['doctorDetail'][0]->endTime !=NULL){
            $midTime = $explodeEndTime[$i] - $explodeStartTime[$i];
            $years += floor($midTime / (60 * 60 * 24 * 30 * 12));}
        }
        $data['years'] = $years;

        $data['showStatus'] = 'none';
        $data['detailShow'] = 'block';
        $option = array(
            'table' => 'qyura_hospital',
            'select' => '*',
            'where' => array('qyura_hospital.hospital_deleted' => 0),
            'order'=>array('qyura_hospital.hospital_name'=>'asc'),
            'single' => FALSE
        );
        $data['qyura_hospital'] = $this->common_model->customGet($option);
        $option = array(
            'table' => 'qyura_degree',
            'select' => '*',
            'where' => array('qyura_degree.degree_deleted' => 0),
            'order'=>array('qyura_degree.degree_SName'=>'asc'),
            'single' => FALSE
        );
        $data['qyura_degree'] = $this->common_model->customGet($option);
        $option = array(
            'table' => 'qyura_specialitiesCat',
            'select' => '*',
            'where' => array('qyura_specialitiesCat.specialitiesCat_deleted' => 1),
            'order'=>array('qyura_specialitiesCat.specialitiesCat_name'=>'asc'),
            'single' => FALSE
        );
        $data['qyura_specialitiesCat'] = $this->common_model->customGet($option);
        
        $option = array(
            'table' => 'qyura_professionalExp',
            'select' => 'professionalExp_id ,professionalExp_designation ,professionalExp_usersId,professionalExp_hospitalId,professionalExp_start,professionalExp_end,hospital_name,hospital_id,hospital_address',
            'where' => array('qyura_professionalExp.professionalExp_deleted' => 0,'qyura_professionalExp.professionalExp_usersId' => $doctorId),
            'join' => array(
                array('qyura_hospital', 'qyura_hospital.hospital_id = qyura_professionalExp.professionalExp_hospitalId', 'left')
            ),
            'single' => FALSE
        );
        $professional_exp = $this->common_model->customGet($option);
        
        $doctor_array = '';
        $doctor_final_array = array();
        if(isset($professional_exp) && $professional_exp != NULL){
            foreach ($professional_exp as $professional){
                $doctor_array = array(
                    'professionalExp_id' => $professional->professionalExp_id,
                    'professionalExp_designation' => $professional->professionalExp_designation,
                    'professionalExp_usersId' => $professional->professionalExp_usersId,
                    'professionalExp_hospitalId' => $professional->professionalExp_hospitalId,
                    'professionalExp_start' => $professional->professionalExp_start,
                    'professionalExp_end' => $professional->professionalExp_end,
                    'hospital_name' => $professional->hospital_name,
                    'hospital_address' => $professional->hospital_address,
                );
                
                $option_cat = array(
                    'table' => 'qyura_proExpCategory',
                    'select' => 'proExpCategory_id,proExpCategory_specilitycat_id,specialitiesCat_name,proExpCategory_hospitalId',
                    'where' => array('qyura_proExpCategory.proExpCategory_deleted' => 0,'qyura_proExpCategory.proExpCategory_professionalExp_id' => $professional->professionalExp_id,'qyura_proExpCategory.proExpCategory_hospitalId' => $professional->professionalExp_hospitalId),
                    'join' => array(
                        array('qyura_specialitiesCat', 'qyura_specialitiesCat.specialitiesCat_id = qyura_proExpCategory.proExpCategory_specilitycat_id', 'left')
                    ),
                    'single' => FALSE
                );
                $professional_cat_exp = $this->common_model->customGet($option_cat);
               
                $doctor_final_cat_array = array();
                foreach($professional_cat_exp as $cat_exp){ 
                    $doctor_cat_array = array();
                    $doctor_cat_array = array(
                        'proExpCategory_id' => $cat_exp->proExpCategory_id,
                        'proExpCategory_hospitalId->' => $cat_exp->proExpCategory_hospitalId,
                        'proExpCategory_specilitycat_id' => $cat_exp->proExpCategory_specilitycat_id,
                        'specialitiesCat_name' => $cat_exp->specialitiesCat_name,
                    );
                    $doctor_final_cat_array[] = $doctor_cat_array;
                }
                $doctor_array['category'] = $doctor_final_cat_array;
                $doctor_final_array[] = $doctor_array;
            }
        }
        
        $data['doctor_final_array'] = $doctor_final_array;
        $where = array("doctorAvailability_docUsersId" => 46);

        $data['exprerience'] = $this->Doctor_model->fetchExprience($doctorId);
        $data['doctorAcademic'] = $this->Doctor_model->fetchAcademic($doctorId);
        $data['timeSlots'] = $this->Doctor_model->getDoctorAvailability($where);
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
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $this->_error,'custom'=>1);
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
                        $insert_rec = array('doctorAvailability_refferalId' => $refferalId,'doctorAvailabilitySession_type' => $i, 'doctorAvailability_doctorAvailabilityId' => $availabilityid->id, 'doctorAvailabilitySession_start' => date("H:i:s", strtotime(date("Y-m-d") . " " . $start)), 'doctorAvailabilitySession_end' => date("H:i:s", strtotime(date("Y-m-d") . " " . $end)));
 
                        $this->db->insert('qyura_doctorAvailabilitySession', $insert_rec);
                        
                    }
                }
            }
            
            $responce = array('status' => 1, 'isAlive' => TRUE, 'success' => "Time slotes managed successfully!!" );
            echo json_encode($responce);
        }
        $this->db->trans_complete();
    }

   

    function checkMorningTime($satrt, $end, $session, $day, $sessionInx, $dayIndex) {

        if (!preg_match('/^([1-9]|1[0-2]):([0-5][0-9]) (AM)$/', $satrt)) {
            $this->_error[getDay($day).'_session_'.convertNumberToSession($session).'_st'] = "Wrong start time $session $day $satrt";
            
        }

        if (!preg_match('/^([1-9]|1[0-2]):([0-5][0-9]) (AM)$/', $end)) {

            $this->_error[getDay($day).'_session_'.convertNumberToSession($session).'_ed'] = "Wrong End time $session $day $end";
        }

        $satrt = getStr($satrt);
        $end = getStr($end);

        $limitStart = getStr("06:00 AM");
        $limitEnd = getStr("11:59 AM");

        $this->timeSessionCheck($satrt, $end, $session, $day, $limitStart, $limitEnd);
    }

    function checkAfternoonTime($satrt, $end, $session, $day, $sessionInx, $dayIndex) {

        if (!preg_match('/^([1-9]|1[0-2]):([0-5][0-9]) (PM)$/', $satrt)) {
            $this->_error[getDay($day).'_session_'.convertNumberToSession($session).'_st'] = "Wrong Formate start time $session $day $satrt";
        }

        if (!preg_match('/^([1-9]|1[0-2]):([0-5][0-9]) (PM)$/', $end)) {
            $this->_error[getDay($day).'_session_'.convertNumberToSession($session).'_ed'] = "Wrong Formate End time $session $day $end";
        }

        $satrt = getStr($satrt);
        $end = getStr($end);

        $limitStart = getStr("12:00 PM");
        $limitEnd = getStr("05:59 PM");

        $this->timeSessionCheck($satrt, $end, $session, $day, $limitStart, $limitEnd);
    }

    function checkEveningTime($satrt, $end, $session, $day, $sessionInx, $dayIndex) {

        if (!preg_match('/^([1-9]|1[0-2]):([0-5][0-9]) (PM)$/', $satrt)) {
            $this->_error[getDay($day).'_session_'.convertNumberToSession($session).'_st'] = "Wrong Formate start time $session $day $satrt";
        }

        if (!preg_match('/^([1-9]|1[0-2]):([0-5][0-9]) (PM)$/', $end)) {
            $this->_error[getDay($day).'_session_'.convertNumberToSession($session).'_ed'] = "Wrong Formate End time $session $day $end";
        }
        $satrt = getStr($satrt);
        $end = getStr($end);

        $limitStart = getStr("06:00 PM");
        $limitEnd = getStr("10:59 PM");

        $this->timeSessionCheck($satrt, $end, $session, $day, $limitStart, $limitEnd);
    }

    function checkNightTime($satrt, $end, $session, $day, $sessionInx, $dayIndex) {

        if (!preg_match('/^([1-9]|1[0-2]):([0-5][0-9]) (PM|AM)$/', $satrt)) {
            $this->_error[getDay($day).'_session_'.convertNumberToSession($session).'_st'] = "Wrong Formate start time $session $day $satrt";
        }

        if (!preg_match('/^([1-9]|1[0-2]):([0-5][0-9]) (PM|AM)$/', $end)) {
            $this->_error[getDay($day).'_session_'.convertNumberToSession($session).'_ed'] = "Wrong Formate End time $session $day $end";
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

        $dayEnd = strtotime(date("Y-m-d",strtotime("+1 day".date("Y-m-d"))) . " 05:59 AM");
        $dayStart = strtotime(date("Y-m-d") . " 10:59 PM");
 
        if($session == "Night"){
            if(($startTime > $dayStart && $startTime < $dayEnd) && ($endTime > $dayStart && $endTime < $dayEnd)){
                $this->_error[getDay($day).'_session_'.convertNumberToSession($session).'_st'] = "Check and enter correct time between the Night range";
            }
        }else{
            if ($startTime < $limitStart && $startTime > $endTime) {
                $this->_error[getDay($day).'_session_'.convertNumberToSession($session).'_st'] = "Start time must be after " . date('h:i A', $limitStart) . " for $session $day";
            }

            if ($endTime > $limitEnd) {
                $this->_error[getDay($day).'_session_'.convertNumberToSession($session).'_ed'] = "End time must be before " . date('h:i A', $limitEnd) . " for $session $day";
            }

            if ($startTime > $endTime) {
                $this->_error[getDay($day).'_session_'.convertNumberToSession($session).'_st'] = "Start time should be less than end time for $session $day";
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
    function changePassword(){
        //print_r($_POST);exit;
        $this->bf_form_validation->set_rules("registered_email","Registered Email", 'required|xss_clean');
        $this->bf_form_validation->set_rules("register_mobile","Register Mobile", 'required|xss_clean');
        $this->bf_form_validation->set_rules("password","Password", 'xss_clean|matches[confirm]');
        $this->bf_form_validation->set_rules("confirm","Confirm Password", 'xss_clean');
        
        if ($this->bf_form_validation->run() == FALSE) {
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => ajax_validation_errors());
            echo json_encode($responce);
        } else {
            $userId = $this->input->post('user_id');
            $user_array = array(
                'users_email' => $this->input->post('registered_email'),
                'modifyTime'    => strtotime(date("d-m-Y H:i:s"))
            );
            $password = $this->common_model->encryptPassword($this->input->post('password'));
            if($password != ''){
                $user_array['users_password'] = $password;
            }
            $updateOptions = array
            (
                'where' => array('users_id' => $userId),
                'data'  => $user_array,
                'table' => 'qyura_users'
            );
            $user_updated = $this->common_model->customUpdate($updateOptions);
            
            $records_array = array(
                'doctors_registeredMblNo' => $this->input->post('register_mobile'),
                'modifyTime'    => strtotime(date("d-m-Y H:i:s"))
            );
            $updateOption = array
            (
                'where' => array('doctors_userId' => $userId),
                'data'  => $records_array,
                'table' => 'qyura_doctors'
            );
            $user_updated = $this->common_model->customUpdate($updateOption);
            $doctorAjaxId = $this->input->post('doctorAjaxId');
            if ($user_updated) {
                $responce =  array('status'=>1,'msg'=>"Information update successfully",'url' =>"doctor/doctorDetails/$doctorAjaxId");
            }else
            {
                $error = array("TopError"=>"<strong>Something went wrong while updating your data... sorry.</strong>");
                $responce =  array('status'=>0,'isAlive'=>TRUE,'errors'=>$error);
            }
            echo json_encode($responce);
        }

    }
    
    function addAcademic(){
        $totalAcademic = $this->input->post('total_add_academic');
        for($j = 1; $j <= $totalAcademic; $j++){
            $this->bf_form_validation->set_rules("degree_addid_$j","Degree $j", 'required|xss_clean');
            $this->bf_form_validation->set_rules("acdemic_addaddress_$j","Acdemic Address $j", 'required|xss_clean');
            $this->bf_form_validation->set_rules("acdemic_addyear_$j","Acdemic Year $j", 'required|xss_clean');
        }
        if ($this->bf_form_validation->run() == FALSE) {
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => ajax_validation_errors());
            echo json_encode($responce);
        } else {
            
            $user_insert = '';
            $totalAcademic = $this->input->post('total_add_academic');
            $doctorAjaxId = $this->input->post('doctorAjaxId');
            
            for($i = 1; $i <= $totalAcademic; $i++){
                $degree_id = $this->input->post("degree_addid_$i");
                $acdemic_address = $this->input->post("acdemic_addaddress_$i");
                $acdemic_year = $this->input->post("acdemic_addyear_$i");
                $records_array = array(
                    'doctorAcademic_doctorsId' => $doctorAjaxId,
                    'doctorAcademic_degreeId' => $degree_id,
                    'doctorAcademic_degreeInsAddress' => $acdemic_address,
                    'doctorAcademic_degreeYear' => $acdemic_year,
                    'creationTime'    => strtotime(date("d-m-Y H:i:s"))
                );
                $options = array
                (
                    'data'  => $records_array,
                    'table' => 'qyura_doctorAcademic'
                );

                $user_insert = $this->common_model->customInsert($options);
            }
            
            if ($user_insert) {
                
                $responce =  array('status'=>1,'msg'=>"Academic added successfully",'url' =>"doctor/doctorDetails/$doctorAjaxId");
            }else
            {
                $error = array("TopError"=>"<strong>Something went wrong while updating your data... sorry.</strong>");
                $responce =  array('status'=>0,'isAlive'=>TRUE,'errors'=>$error);
            }
            echo json_encode($responce);
        }
    }
    
    function changeAcademic(){
        $totalAcademic = $this->input->post('totalAcademic');
        for($j = 1; $j <= $totalAcademic; $j++){
            $this->bf_form_validation->set_rules("academic_id_$j","academic id $j", 'required|xss_clean');
            $this->bf_form_validation->set_rules("degree_id_$j","Degree $j", 'required|xss_clean');
            $this->bf_form_validation->set_rules("acdemic_address_$j","Acdemic Address $j", 'required|xss_clean');
            $this->bf_form_validation->set_rules("acdemic_year_$j","Acdemic Year $j", 'required|xss_clean');
        }
        if ($this->bf_form_validation->run() == FALSE) {
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => ajax_validation_errors());
            echo json_encode($responce);
        } else {
            
            $totalAcademic = $this->input->post('totalAcademic');
            for($i = 1; $i <= $totalAcademic; $i++){
                $academic_id = $this->input->post("academic_id_$i");
                $degree_id = $this->input->post("degree_id_$i");
                $acdemic_address = $this->input->post("acdemic_address_$i");
                $acdemic_year = $this->input->post("acdemic_year_$i");
                $records_array = array(
                    'doctorAcademic_degreeId' => $degree_id,
                    'doctorAcademic_degreeInsAddress' => $acdemic_address,
                    'doctorAcademic_degreeYear' => $acdemic_year,
                    'modifyTime'    => strtotime(date("d-m-Y H:i:s"))
                );
                $updateOption = array
                (
                    'where' => array('doctorAcademic_id' => $academic_id),
                    'data'  => $records_array,
                    'table' => 'qyura_doctorAcademic'
                );

                $user_updated = $this->common_model->customUpdate($updateOption);
            }
            $doctorAjaxId = $this->input->post('doctorAjaxId');
           
            $responce =  array('status'=>1,'msg'=>"Academic update successfully",'url' =>"doctor/doctorDetails/$doctorAjaxId");
            
            echo json_encode($responce);
        }
    }
    
    function addExperience(){
        //print_r($_POST);exit;
        $total_add_exp = $this->input->post('total_add_exp');
        for($j = 1; $j <= $total_add_exp; $j++){
            $this->bf_form_validation->set_rules("hospital_addid_$j","Hoapital $j", 'required|xss_clean');
            $this->bf_form_validation->set_rules("designation_$j","Designation $j", 'required|xss_clean');
            //$this->bf_form_validation->set_rules("speciality$j[$j]","speciality $j", 'required|xss_clean');
            $this->bf_form_validation->set_rules("exp_start_$j","Exp Start $j", 'required|xss_clean');
            $this->bf_form_validation->set_rules("exp_end_$j","Exp End $j", 'required|xss_clean');
        }
        if ($this->bf_form_validation->run() == FALSE) {
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => ajax_validation_errors());
            echo json_encode($responce);
        } else {
            
            $exp_insert = '';
            $exp_insert_new = '';
            $total_add_exp = $this->input->post('total_add_exp');
            $doctorAjaxId = $this->input->post('doctorAjaxId');
            
            for($i = 1; $i <= $total_add_exp; $i++){
                $hospital_addid = $this->input->post("hospital_addid_$i");
                $designation = $this->input->post("designation_$i");
                $exp_start = strtotime($this->input->post("exp_start_$i"));
                $exp_end = strtotime($this->input->post("exp_end_$i"));
                $records_array = array(
                    'professionalExp_usersId' => $doctorAjaxId,
                    'professionalExp_designation'=> $designation,
                    'professionalExp_hospitalId' => $hospital_addid,
                    'professionalExp_start' => $exp_start,
                    'professionalExp_end' => $exp_end,
                    'creationTime'    => strtotime(date("d-m-Y H:i:s"))
                );
                $options = array
                (
                    'data'  => $records_array,
                    'table' => 'qyura_professionalExp'
                );
                $exp_insert = $this->common_model->customInsert($options);
                $speciality = $this->input->post("speciality".$i);
                for($j=0;$j<count($speciality);$j++){
                    if($speciality[$j] != ''){
                        $records_array = array(
                            'proExpCategory_professionalExp_id' => $exp_insert,
                            'proExpCategory_hospitalId' => $hospital_addid,
                            'proExpCategory_specilitycat_id'=> $speciality[$j],
                            'creationTime'    => strtotime(date("d-m-Y H:i:s"))
                        );
                        $options = array
                        (
                            'data'  => $records_array,
                            'table' => 'qyura_proExpCategory'
                        );
                        $exp_insert_new = $this->common_model->customInsert($options);
                    }
                }
            }
            if ($exp_insert || $exp_insert_new) {
                
                $responce =  array('status'=>1,'msg'=>"Experience added successfully",'url' =>"doctor/doctorDetails/$doctorAjaxId");
            }else
            {
                $error = array("TopError"=>"<strong>Something went wrong while updating your data... sorry.</strong>");
                $responce =  array('status'=>0,'isAlive'=>TRUE,'errors'=>$error);
            }
            echo json_encode($responce);
        }
    }
    
    function editExperience(){
        
        $total_edit_exp = $this->input->post('total_edit_exp');
        for($j = 1; $j <= $total_edit_exp; $j++){
            $d = $j-1;
            $this->bf_form_validation->set_rules("hospital_id_$j","Hospital $j", 'required|xss_clean');
            $this->bf_form_validation->set_rules("designation_edit_$j","Designation $j", 'required|xss_clean');
            //$this->bf_form_validation->set_rules("speciality_edit$j[$d]","Specility $j", 'required|xss_clean');
            $this->bf_form_validation->set_rules("exp_edit_start_$j","Exp Start $j", 'required|xss_clean');
            $this->bf_form_validation->set_rules("exp_edit_end_$j","Exp End $j", 'required|xss_clean');
        }
        if ($this->bf_form_validation->run() == FALSE) {
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => ajax_validation_errors());
            echo json_encode($responce);
        } else {
            
            $exp_insert = '';
            $exp_insert_new = '';
            $total_edit_exp = $this->input->post('total_edit_exp');
            $doctorAjaxId = $this->input->post('doctorAjaxId');
            
            for($i = 1; $i <= $total_edit_exp; $i++){
                $exp_id = $this->input->post("professionalExp_id_$i");
                $hospital_addid = $this->input->post("hospital_id_$i");
                $designation = $this->input->post("designation_edit_$i");
                $exp_start = strtotime($this->input->post("exp_edit_start_$i"));
                $exp_end = strtotime($this->input->post("exp_edit_end_$i"));
                $records_array = array(
                    'professionalExp_usersId' => $doctorAjaxId,
                    'professionalExp_designation'=> $designation,
                    'professionalExp_hospitalId' => $hospital_addid,
                    'professionalExp_start' => $exp_start,
                    'professionalExp_end' => $exp_end,
                    'modifyTime'    => strtotime(date("d-m-Y H:i:s"))
                );
                $options = array
                (
                    'where' => array('professionalExp_id' => $exp_id),
                    'data'  => $records_array,
                    'table' => 'qyura_professionalExp'
                );
                $exp_update = $this->common_model->customUpdate($options);
                $speciality = $this->input->post("speciality_edit".$i);
                
                $query = "DELETE FROM `qyura_proExpCategory` WHERE `proExpCategory_professionalExp_id` = '$exp_id'";
                $delete_exp = $this->common_model->customQuery($query,FALSE,TRUE);    
                
                for($j=0;$j<count($speciality);$j++){
                    if($speciality[$j] != ''){
                        $records_array = array(
                            'proExpCategory_professionalExp_id' => $exp_id,
                            'proExpCategory_hospitalId' => $hospital_addid,
                            'proExpCategory_specilitycat_id'=> $speciality[$j],
                            'creationTime'    => strtotime(date("d-m-Y H:i:s"))
                        );
                        $options = array
                        (
                            'data'  => $records_array,
                            'table' => 'qyura_proExpCategory'
                        );
                        $exp_insert_new = $this->common_model->customInsert($options);
                    }
                }
            }
            if ($exp_update || $exp_insert_new) {
                
                $responce =  array('status'=>1,'msg'=>"Experience update successfully",'url' =>"doctor/doctorDetails/$doctorAjaxId");
            }else
            {
                $error = array("TopError"=>"<strong>Something went wrong while updating your data... sorry.</strong>");
                $responce =  array('status'=>0,'isAlive'=>TRUE,'errors'=>$error);
            }
            echo json_encode($responce);
        }
    }
    
    function changeDetailDoctor(){
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
        $this->bf_form_validation->set_rules("doctors_consultaionFee", "Consultation Fee",'required|xss_clean');

        $total_phone = $this->input->post('total_phone');
        for($j=1;$j<=$total_phone;$j++){
            $m = $j-1;
            $this->bf_form_validation->set_rules("preNumber[$m]","pre Number $j ", 'required|xss_clean');
            $this->bf_form_validation->set_rules("midNumber[$m]","Mid Number $j ", 'required|xss_clean');
            $this->bf_form_validation->set_rules("doctors_phn[$m]","Phone $j", 'required|xss_clean');
        }
        $total_mobile = $this->input->post('total_mobile');
        for($i=1;$i<=$total_mobile;$i++){
            $n = $i-1;
            $this->bf_form_validation->set_rules("preMobileNumber[$n]","pre Number $j ", 'required|xss_clean');
            $this->bf_form_validation->set_rules("doctors_mobile[$n]","Mid Number $j ", 'required|xss_clean');
        }
        if ($this->bf_form_validation->run($this) == FALSE) {
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => ajax_validation_errors());
            echo json_encode($responce);
        } else {
            $doctor_id = $this->input->post('doctorAjaxId');
            $userId = $this->input->post('userId');
            $doctors_fName = $this->input->post('doctors_fName');
            $doctors_lName = $this->input->post('doctors_lName');
            $doctors_dob = strtotime($this->input->post('doctors_dob'));
            $creationTime = strtotime($this->input->post('creationTime'));
            $users_email = $this->input->post('users_email');
            $doctors_address = $this->input->post('doctor_addr');
            $doctors_lat = $this->input->post('lat');
            $doctors_lng = $this->input->post('lng');
            $isManual = $this->input->post('isManual');
            $pre_number = $this->input->post('preNumber');
            $midNumber = $this->input->post('midNumber');
            $doctors_phn = $this->input->post('doctors_phn');
	    $consultationfee =$this->input->post('doctors_consultaionFee');
	    $doctors_27Src = $this->input->post('doctors_27Src');
            $finalNumber = '';
            for($i= 0;$i < count($pre_number) ;$i++) {
                if($doctors_phn[$i] != '' && $pre_number[$i] !='' && $midNumber[$i] != '') {            
                    if($i == count($pre_number)-1)
                       $finalNumber .= $pre_number[$i].' '.$midNumber[$i].' '.$doctors_phn[$i];
                    else        
                       $finalNumber .= $pre_number[$i].' '.$midNumber[$i].' '.$doctors_phn[$i].'|'; 
                }
            }
            $pre_mobile_number = $this->input->post('preMobileNumber');
            $doctors_mobile_number = $this->input->post('doctors_mobile');
            $finalMobileNumber = '';
            $checkbox = 1;
            for($i= 0;$i < count($pre_mobile_number) ;$i++) {
                if($doctors_mobile_number[$i] != '' && $pre_mobile_number[$i] !='') {
                    if($i == count($pre_mobile_number)-1){
                          if(isset($_POST['checkbox'.$checkbox]) == 1)
                          $finalMobileNumber .= $pre_mobile_number[$i].' '.$doctors_mobile_number[$i].'*'.$checkbox;  
                          else
                          $finalMobileNumber .= $pre_mobile_number[$i].' '.$doctors_mobile_number[$i].'*'.'0'; 
                    }else{
                        if(isset($_POST['checkbox'.$checkbox]) == 1)
                            $finalMobileNumber .= $pre_mobile_number[$i].' '.$doctors_mobile_number[$i].'*'.$checkbox.'|';  
                        else
                            $finalMobileNumber .= $pre_mobile_number[$i].' '.$doctors_mobile_number[$i].'*'.'0'.'|'; 
                    }
                }
                $checkbox ++;   
            }
            $records_array = array(
                'doctors_fName' => $doctors_fName,
                'doctors_lName' => $doctors_lName,
                'doctors_dob'   => $doctors_dob,
                'creationTime'  => $creationTime,
                'doctors_phn'   => $finalNumber,
                'doctors_mobile'=> $finalMobileNumber,
                'doctor_addr'   => $doctors_address,
                'doctors_lat'   => $doctors_lat,
                'doctors_long'  => $doctors_lng,
                'isManual'      => $isManual,
		'doctors_consultaionFee' => $consultationfee,
		'doctors_27Src' => $doctors_27Src,
                'modifyTime'    => strtotime(date("d-m-Y H:i:s"))
            );
            $updateOption = array
            (
                'where' => array('doctors_userId' => $userId),
                'data'  => $records_array,
                'table' => 'qyura_doctors'
            );
            $doctor_update = $this->common_model->customUpdate($updateOption);
            $user_array = array(
                'users_email' => $users_email,
                'modifyTime'    => strtotime(date("d-m-Y H:i:s"))
            );
            $updateOptions = array
            (
                'where' => array('users_id' => $userId),
                'data'  => $user_array,
                'table' => 'qyura_users'
            );
            $user_updated = $this->common_model->customUpdate($updateOptions);
            $doctorAjaxId = $this->input->post('doctorAjaxId');
            if ($doctor_update || $user_updated) {
                $responce =  array('status'=>1,'msg'=>"Profile update successfully",'url' =>"doctor/doctorDetails/$doctorAjaxId");
            }else
            {
                $error = array("TopError"=>"<strong>Something went wrong while updating your data... sorry.</strong>");
                $responce =  array('status'=>0,'isAlive'=>TRUE,'errors'=>$error);
            }
            echo json_encode($responce);
        }
    }
    
    function find_specialities(){
        $h_id = $this->input->post('h_id');
        $option = '';
        if ($h_id) {
            $options = array(
                'table' => 'qyura_hospitalSpecialities',
                'where' => array('qyura_hospitalSpecialities.hospitalSpecialities_deleted' => 0,'qyura_hospitalSpecialities.hospitalSpecialities_hospitalId' => $h_id),
                'join' => array(
                    array('qyura_specialities', 'qyura_specialities.specialities_id = qyura_hospitalSpecialities.hospitalSpecialities_specialitiesId', 'left'),
                    array('qyura_specialitiesCat', 'qyura_specialitiesCat.specialitiesCat_id = qyura_specialities.specialities_specialitiesCatId', 'left'),
                ),
                'group_by'=> 'qyura_specialitiesCat.specialitiesCat_id',
            );
            $hospitalSpecialities = $this->common_model->customGet($options);
            if (isset($hospitalSpecialities) && $hospitalSpecialities != NULL) {
                foreach ($hospitalSpecialities as $specialities) {
                    $option .= '<option value="' . $specialities->specialitiesCat_id . '">' . $specialities->specialitiesCat_name .'</option>';
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
            if ($update)
                echo $update;
            else
                echo '0';
        }
        else {
            echo 0;
        }
    }
    
    function experienceDelete() {
        $del_id = $this->input->post('id');

        if ($del_id) {
            //Group
            $where = array('professionalExp_id' => $del_id);
            $update_data['professionalExp_deleted'] = 1;
            $updateOptions = array
                (
                'where' => $where,
                'data' => $update_data,
                'table' => 'qyura_professionalExp'
            );

            $update = $this->common_model->customUpdate($updateOptions);
            
            $whereCat = array('proExpCategory_professionalExp_id' => $del_id);
            $update_data_cat['proExpCategory_deleted'] = 1;
            $updateOptionsCat = array
            (
                'where' => $whereCat,
                'data' => $update_data_cat,
                'table' => 'qyura_proExpCategory'
            );
            $update = $this->common_model->customUpdate($updateOptionsCat);
            if ($update)
                echo $update;
            else
                echo '0';
        }
        else {
            echo 0;
        }
    }


}