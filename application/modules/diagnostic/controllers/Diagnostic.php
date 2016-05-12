<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Diagnostic extends MY_Controller {

    public function __construct() {
        parent:: __construct();
        // $this->load->library('form_validation');
        $this->load->model(array('diagnostic_model','hospital/Hospital_model', 'bloodbank/Bloodbank_model', 'doctor/Doctor_model'));
    }

    function index() {
        
        $data = array();
        $data['allCities'] = $this->diagnostic_model->allCities();
      //  $data['allStates'] = $this->diagnostic_model->fetchStates();
        $data['diagnosticData'] = $this->diagnostic_model->fetchdiagnosticData();
        //print_r($data['diagnosticData'] );exit;
        // $this->load->view('diagnosticlisting',$data);
        $data['title'] = 'Diagnostic';
        $this->load->super_admin_template('diagnosticlisting', $data, 'diagnosticScript');
    }
    
    
 
    

    /**
     * @project Qyura
     * @method getDiagnosticDl
     * @description diagnostic datatable listing
     * @access public
     * @return array
     */
    function getDiagnosticDl() {


        echo $this->diagnostic_model->fetchDiagnosticDataTables();

        
    }

    /**
     * @project Qyura
     * @method getDiagnosticDoctorsDl
     * @description diagnostic doctor datatable listing
     * @access public
     * @return array
     */
    function getDiagnosticDoctorsDl($MiProfileId) {
        $miUserId = 0;
        if(!empty($MiProfileId)){
            
            $option = array(
            'table' => 'qyura_diagnostic',
            'select' => 'diagnostic_usersId',
            'where' => array('diagnostic_id' => $MiProfileId)
              );
            $miData = $this->common_model->customGet($option);
          $miUserId = $miData[0]->diagnostic_usersId;
        }
        echo $this->diagnostic_model->fetchDiagnosticDoctorDataTables($miUserId);
        
    }

    function addDiagnostic() {
        $data = array();
        
        $option = array(
            'table' => 'qyura_membership',
            'select' => 'membership_id,membership_name',
            'where' => array('membership_deleted' => 0,'qyura_membership.status' => 1,'membership_type' => 3)
        );
        $data['membership_plan'] = $this->common_model->customGet($option);
        
        $option = array(
            'table' => 'qyura_facilities',
            'select' => '*',
            'where' => array('qyura_facilities.facilities_deleted' => 0),
            'order' => array('facilities_name' => 'asc'),
            'single' => FALSE
        );
        $data['facilities_list'] = $this->common_model->customGet($option);
        
        $data['publishDiagno'] = $this->diagnostic_model->fetchPublishDiagnostic();
        $data['allStates'] = $this->diagnostic_model->fetchStates();
        $data['diagnosticType'] = $this->diagnostic_model->getDiagnosticType();
        $data['title'] = 'Add Diagnostic';
        $this->load->super_admin_template('addDiagcenter', $data, 'diagnosticScript');
    }

    function detailDiagnostic($diagnosticId = '', $active= 'general', $showdiv = null) {

        $data = array();
        
        
        $option = array(
            'table' => 'qyura_membership',
            'select' => 'membership_id,membership_name',
            'where' => array('membership_deleted' => 0,'qyura_membership.status' => 1,'membership_type' => 3)
        );
        $data['membership_plan'] = $this->common_model->customGet($option);
        
        $option = array(
            'table' => 'qyura_facilities',
            'select' => '*',
            'where' => array('qyura_facilities.facilities_deleted' => 0),
            'order' => array('facilities_name' => 'asc'),
            'single' => FALSE
        );
        $data['facilities_list'] = $this->common_model->customGet($option);
       
        if($this->uri->segment(5) != '' && $this->uri->segment(5) != 0){
            $doctorId =   $this->uri->segment(5);
            $showdiv = $this->uri->segment(6);
            $data['doctorId'] = $doctorId;
            if($showdiv === 'timeSlot'){
                $timeSloats = array();
                foreach (getDay() as $weekDay => $weekIndex) {
                    $where = array('docTimeDay_day' => $weekIndex, 'docTimeTable_doctorId' => $doctorId);
                    $result = $this->diagnostic_model->getDocTimeOnDay($where);
                    //dump($this->db->last_query());
                    
                    if ($result)
                        $timeSloats[$weekDay] = $result;
                }
                $data['timeSloats'] = $timeSloats;
            }
            
            $data['doctorDetail'] = $this->diagnostic_model->getDoctorDetail($doctorId); 
            $data['docAcaSpecialities'] = $this->diagnostic_model->getDocAcaSpec($doctorId);
            
         //  dump($data['docAcaSpecialities']); exit;

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
            
        }

        
        $data['speciality'] = $this->Doctor_model->fetchSpeciality();
        $data['degree'] = $this->Doctor_model->fetchDegree();
      //  $data['hospital'] = $this->Doctor_model->fetchHospital();

        $data['diagnosticData'] = $diagnosticData = $this->diagnostic_model->fetchdiagnosticData($diagnosticId);
        $data['gallerys'] = $this->diagnostic_model->customGet(array('table' => 'qyura_diagonsticsImages', 'where' => array('diagonsticImages_diagonsticId' => $diagnosticId, 'diagonsticImages_deleted' => 0)));

        $data['allCountry'] = $this->diagnostic_model->fetchCountry();
        $data['allCities'] = $this->Hospital_model->fetchCity($data['diagnosticData'][0]->diagnostic_stateId);
        $data['allStates'] = $this->diagnostic_model->fetchStates($data['diagnosticData'][0]->diagnostic_countryId);
        $data['diagnosticId'] = $diagnosticId;
        $option = array(
            'table' => 'qyura_diagnosticCenterTimeSlot',
            'where' => array(
                'diagnosticCenterTimeSlot_diagnosticId' => $diagnosticId,
                'diagnosticCenterTimeSlot_deleted' => 0
            )
        );
      //  $data['AlltimeSlot'] = $this->diagnostic_model->customGet($option);
        
        
        
         $option = array(
            'table' => 'qyura_miMembership',
            'where' => array('qyura_miMembership.miMembership_miId' => $diagnosticData[0]->diagnostic_usersId,'qyura_miMembership.miMembership_deleted' => 0),
            'join' => array(
                array('qyura_facilities', 'qyura_facilities.facilities_id = qyura_miMembership.miMembership_facilitiesId', 'left')
            ),
            'order' => array('qyura_facilities.facilities_name' => 'asc'),
        );
        $data['membership_datail'] = $this->diagnostic_model->customGet($option);
        
        $mi_userId="";
        if(!empty($diagnosticData)):
         $mi_userId = $diagnosticData[0]->diagnostic_usersId;
        endif;
        $option = array(
            'select' => '*',
            'table'=> 'qyura_miTimeSlot',
            'where'=> array('mi_user_id' => $mi_userId),
        );
        $data['timeSlot'] = $this->common_model->customGet($option);
        
        $data['insurance'] = $this->diagnostic_model->fetchInsurance($diagnosticId);
        
        if (!empty($data['insurance'])) {
            foreach ($data['insurance'] as $key => $val) {
                $insurance_condition[] = $val->diagnoInsurance_insuranceId;
            }
        }
        
        $data['allInsurance'] = $this->Hospital_model->fetchAllInsurance($insurance_condition);
        
        $data['awardAgency'] = $this->Hospital_model->fetchAwardAgency();
        $data['diagnosticType'] = $this->diagnostic_model->getDiagnosticType();
        $data['diagnosticId'] = $diagnosticId;
        $data['showStatus'] = 'none';
        $data['detailShow'] = 'block';
        $data['showDiv'] = $showdiv;
        $data['active'] = $active;
        $data['title'] = (!empty($data['diagnosticData'])) ? $data['diagnosticData'][0]->diagnostic_name : "Diagnostic Details";
        $this->load->super_admin_template('diagnosticDetail', $data, 'diagnosticScript');
    }

    function fetchStates() {
        $stateId = $this->input->post('stateId');
        // echo $stateId;exit;
        $countryId = $this->input->post('countryId');
        $statesdata = $this->diagnostic_model->fetchStates($countryId);
        $statesOption = '';
        $statesOption .='<option value=>Select Your States</option>';
        foreach ($statesdata as $key => $val) {
            if ($val->state_id == $stateId)
                $statesOption .= '<option value=' . $val->state_id . ' selected >' . strtoupper($val->state_statename) . '</option>';
            else
                $statesOption .= '<option value=' . $val->state_id . '>' . strtoupper($val->state_statename) . '</option>';
        }
        echo $statesOption;
        exit;
    }

    function fetchCityOnload() {
        $stateId = $this->input->post('stateId');
        $cityId = $this->input->post('cityId');
        $cityData = $this->diagnostic_model->fetchCity($stateId);
        $cityOption = '';
        $cityOption .='<option value=>Select Your City</option>';
        foreach ($cityData as $key => $val) {
            if ($val->city_id == $cityId)
                $cityOption .= '<option value=' . $val->city_id . ' selected>' . strtoupper($val->city_name) . '</option>';
            else
                $cityOption .= '<option value=' . $val->city_id . '>' . strtoupper($val->city_name) . '</option>';
        }
        echo $cityOption;
        exit;
    }

    function fetchCity() {
        $stateId = $this->input->post('stateId');
        $cityData = $this->diagnostic_model->fetchCity($stateId);
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
     * @method SaveDiagnostic
     * @description add diagnostic
     * @access public
     * @return boolean
     */
    function SaveDiagnostic() {
        
       // dump($_POST); exit;  

      //  $this->load->library('form_validation');
        $this->bf_form_validation->set_rules('diagnostic_name', 'Diagnostic Name', 'required|trim');
        $this->bf_form_validation->set_rules('diagno_type', 'Diagnostic Type', 'required|trim');
        $this->bf_form_validation->set_rules('diagnostic_countryId', 'Diagnostic Country', 'required|trim');
        $this->bf_form_validation->set_rules('diagnostic_stateId', 'Diagnostic StateId', 'required|trim');
        $this->bf_form_validation->set_rules('diagnostic_cityId', 'Diagnostic City', 'required|trim');

        $this->bf_form_validation->set_rules('diagnostic_address', 'Diagnostic Address', 'required|trim');
        $this->bf_form_validation->set_rules('diagnostic_phn', 'Diagnostic Phone', 'required|trim');

        $this->bf_form_validation->set_rules('diagnostic_cntPrsn', 'Contact Person', 'required|trim');
        $this->bf_form_validation->set_rules('diagnostic_mbrTyp', 'Membership Type', 'required|trim');
        $this->bf_form_validation->set_rules('diagnostic_dsgn', 'Designation', 'required|trim');

        $this->bf_form_validation->set_rules('diagnostic_mblNo', 'Diagnostic Mobile No', 'required|trim');

        $this->bf_form_validation->set_rules('diagnostic_zip', 'Diagnostic Zip', 'required|trim');
        $this->bf_form_validation->set_rules('users_email', 'Users Email', 'required|valid_email|trim');
        $this->bf_form_validation->set_rules('users_password', 'Password', 'trim|required|matches[cnfPassword]');
        $this->bf_form_validation->set_rules('cnfPassword', 'Password Confirmation', 'trim|required');
        $this->bf_form_validation->set_rules('aboutUs', 'About Us', 'trim|required');
        
        $this->bf_form_validation->set_rules('lat', 'Latitude', 'required|trim');
        $this->bf_form_validation->set_rules('lng', 'Longitude', 'required|trim');
        
        
        $this->bf_form_validation->set_rules('bloodbank_chk', 'blood bank checkbox', 'trim');
        $this->bf_form_validation->set_rules('bloodBank_name', 'blood bank name', 'trim');
        $this->bf_form_validation->set_rules('bloodBank_phn', 'blood bank phon no.', 'trim');

        $this->bf_form_validation->set_rules('pharmacy_chk', 'pharmacy checkbox', 'trim');

        $this->bf_form_validation->set_rules('ambulance_chk', 'ambulance checkbox', 'trim');
        $this->bf_form_validation->set_rules('ambulance_name', 'ambulance name', 'trim');
        $this->bf_form_validation->set_rules('docOnBoard', 'doctor on board', 'trim');
        $this->bf_form_validation->set_rules('ambulance_phn', 'ambulance phon no.', 'trim');

        $this->bf_form_validation->set_rules('availibility_24_7', '27*7 availability', 'trim');
        $this->bf_form_validation->set_rules('isEmergency', 'Is Emergency', 'trim');
        $this->bf_form_validation->set_rules('docatId', 'Docat id', 'trim');
        
        $this->bf_form_validation->set_rules('diagno_id', 'Diagnostic id', 'required|trim');
        
        $this->bf_form_validation->set_rules('membership_quantity_1', 'Membership Quantity', 'required|trim');
        $this->bf_form_validation->set_rules('membership_duration_1', 'Membership Duration', 'required|trim');
        
        $this->bf_form_validation->set_rules('membership_quantity_2', 'Membership Quantity', 'required|trim');
        $this->bf_form_validation->set_rules('membership_duration_2', 'Membership Duration', 'required|trim');
        
        $this->bf_form_validation->set_rules('membership_quantity_3', 'Membership Quantity', 'required|trim');
        $this->bf_form_validation->set_rules('membership_quantity_4', 'Membership Quantity', 'required|trim');
        
        
        

        if (empty($_FILES['avatar_file']['name'])) {
            $this->bf_form_validation->set_rules('avatar_file', 'File', 'required');
        }
        
        if ($this->bf_form_validation->run() === FALSE) {
            $data = array();
            //exit;
            
            $option = array(
                'table' => 'qyura_membership',
                'select' => 'membership_id,membership_name',
                'where' => array('membership_deleted' => 0,'status' => 3,'membership_type' => 3)
            );
            $data['membership_plan'] = $this->common_model->customGet($option);

            $option = array(
                'table' => 'qyura_facilities',
                'select' => '*',
                'where' => array('qyura_facilities.facilities_deleted' => 0),
                'order' => array('facilities_name' => 'asc'),
                'single' => FALSE
            );
            $data['facilities_list'] = $this->common_model->customGet($option);

            $countryId = $this->input->post('diagnostic_countryId');
            $data['allStates'] = $this->diagnostic_model->fetchStates($countryId);
            $stateId = $this->input->post('diagnostic_stateId');
            $data['citys'] = $this->diagnostic_model->fetchCity($stateId);
            $data['title'] = "Add Diagnostic";
            $data['bloodBankstatus'] = $this->input->post('bloodbank_chk');
            $data['amobulancestatus'] = $this->input->post('ambulance_chk');
            $data['diagno_id'] = $this->input->post('diagno_id');
            $data['publishDiagno'] = $this->diagnostic_model->fetchPublishDiagnostic();
           // print_r($data); exit;
            $this->load->super_admin_template('addDiagcenter', $data, 'diagnosticScript');
        } else {
           // echo 'hemant'; exit;
            $imagesname = '';
            if ($_FILES['avatar_file']['name']) {
                $path = realpath(FCPATH . 'assets/diagnosticsImage/');
                $upload_data = $this->input->post('avatar_data');
                $upload_data = json_decode($upload_data);
                
                $original_imagesname = $this->uploadImageWithThumb($upload_data, 'avatar_file', $path, 'assets/diagnosticsImage/', './assets/diagnosticsImage/thumb/', 'diagnostics');

                if (empty($original_imagesname)) {
                    $data['allStates'] = $this->diagnostic_model->fetchStates();
                    $this->session->set_flashdata('valid_upload', $this->error_message);
                    $this->load->super_admin_template('addDiagcenter', $data, 'diagnosticScript');
                    return false;
                } else {
                    $imagesname = $original_imagesname;
                }
            }
            //echo "i am here";
            
            $diagno_id = $this->input->post('diagno_id');
            $diagnostic_phn = $this->input->post('diagnostic_phn');
         
            

            $diagnostic_name = $this->input->post('diagnostic_name');
            $diagnostic_type = $this->input->post('diagno_type');
            $diagnostic_address = $this->input->post('diagnostic_address');
            $diagnostic_phn = ltrim($this->input->post('diagnostic_phn'));
            $diagnostic_cntPrsn = $this->input->post('diagnostic_cntPrsn');
            // $diagnostic_dsgn = $this->input->post('diagnostic_dsgn');
            $diagnostic_mmbrTyp = $this->input->post('diagnostic_mbrTyp');
            $diagnostic_countryId = $this->input->post('diagnostic_countryId');
            $diagnostic_stateId = $this->input->post('diagnostic_stateId');
            $diagnostic_cityId = $this->input->post('diagnostic_cityId');
            $diagnostic_mblNo = $this->input->post('diagnostic_mblNo');
            $diagnostic_zip = $this->input->post('diagnostic_zip');
            $diagnostic_dsgn = $this->input->post('diagnostic_dsgn');
            
            $isManual = $this->input->post('isManual');

            $users_email_status = $this->input->post('users_email_status');
            if($users_email_status == ''){
            $users_email = $this->input->post('users_email');
            $users_password = md5($this->input->post('users_password'));
            $diagnosticInsert = array(
                'users_email' => $users_email,
                'users_password' => $this->common_model->encryptPassword($users_password),
                'users_ip_address' => $this->input->ip_address(),
                'users_mobile' => $this->input->post('diagnostic_mblNo'),
                'creationTime' => strtotime(date("Y-m-d H:i:s"))
            );

            $diagnostic_usersId = $this->diagnostic_model->insertDiagnosticUser($diagnosticInsert);
            $usersRoles_parentId = 0;
            }
            else {
                $diagnostic_usersId = $users_email_status;
                $usersRoles_parentId = $users_email_status;
            }
            if ($diagnostic_usersId) {

                $insertusersRoles = array(
                    'usersRoles_userId' => $diagnostic_usersId,
                    'usersRoles_roleId' => 3,
                    'usersRoles_parentId' => $usersRoles_parentId,
                    'creationTime' => strtotime(date("Y-m-d H:i:s"))
                );
                $this->diagnostic_model->insertUsersRoles($insertusersRoles);

                // $insertData['diagnostic_usersId'] = $diagnostic_usersId;
                $insertData = array(
                    'diagnostic_name' => $diagnostic_name,
                    'diagnostic_type' => $diagnostic_type,
                    'diagnostic_dsgn' => $diagnostic_dsgn,
                    'diagnostic_address' => $diagnostic_address,
                    'isManual' => $isManual,
                    'diagnostic_cntPrsn' => $diagnostic_cntPrsn,
                    'diagnostic_phn' =>  $diagnostic_phn,
                    'diagnostic_usersId' => $diagnostic_usersId,
                    'diagnostic_mbrTyp' => $diagnostic_mmbrTyp,
                    'diagnostic_mbrStart' => strtotime(date("Y-m-d H:i:s")),
                    'diagnostic_countryId' => $diagnostic_countryId,
                    'diagnostic_stateId' => $diagnostic_stateId,
                    'diagnostic_cityId' => $diagnostic_cityId,
                   // 'diagnostic_mblNo' => $this->input->post('diagnostic_mobileNo'),
                    'diagnostic_zip' => $diagnostic_zip,
                    'diagnostic_img' => $imagesname,
                    'creationTime' => strtotime(date("Y-m-d H:i:s")),
                    'diagnostic_lat' => $this->input->post('lat'),
                    'diagnostic_long' => $this->input->post('lng'),
                    'diagnostic_aboutUs' => $this->input->post('aboutUs'),
                    'inherit_status' => 1,
                    
                    'diagnostic_availibility_24_7' => isset($_POST['availibility_24_7'])? $this->input->post('availibility_24_7') : 0,
                    'diagnostic_isEmergency' => isset($_POST['isEmergency'])? $this->input->post('isEmergency') : 0,
                    'diagnostic_hasBloodbank' => isset($_POST['bloodbank_chk'])? $this->input->post('bloodbank_chk') : 0,
                    'diagnostic_isBloodBankOutsource' => $this->input->post('isBloodBankOutsource'),
                    'diagnostic_hasPharmacy' => isset($_POST['pharmacy_chk'])? $this->input->post('pharmacy_chk') : 0,
                    'diagnostic_docatId' => $this->input->post('docatId'),
                );
                // dump($insertData);exit;
                
                if(!$users_email)
                 $this->sendEmailRegister($this->input->post($users_email));
                 
                 if($diagno_id == 0){
                      $insertData['status'] = 0;
                      $diagnosticId = $this->diagnostic_model->insertDiagnostic($insertData);
                }elseif($diagno_id != 0 && $diagno_id != '' && $diagno_id != NULL){
                     $diagnosticId = $diagno_id;
                     unset($insertData['creationTime']);
                     $insertData['modifyTime'] = strtotime(date("Y-m-d H:i:s"));
                     $insertData['status'] = 0;
                     $where = array(
                        'diagnostic_id' => $diagno_id
                    );
                    $response = $this->diagnostic_model->UpdateTableData($insertData, $where, 'qyura_diagnostic');
                   // echo $this->db->last_query(); exit;
                }
                
                
                //membership
                        $feci_count = $this->input->post("faci_count");
                        for($i=1;$i<=$feci_count;$i++){
                            $insert_rec = array(
                                'miMembership_type' => 10,
                                'miMembership_miId' => $diagnostic_usersId,
                                'miMembership_facilitiesId' => $this->input->post("checkbox_$i"),
                                'miMembership_quantity' => $this->input->post("membership_quantity_$i"),
                                'creationTime' => strtotime(date("d-m-Y H:i:s")),
                            );
                            if($i == 1 || $i == 2){
                                $insert_rec['miMembership_duration'] = $this->input->post("membership_duration_$i");
                            }
                            $dayOptions = array
                            (
                                'data' => $insert_rec,
                                'table' => 'qyura_miMembership'
                            );
                            $this->common_model->customInsert($dayOptions);
                        }
                //membership
                
            }
            
            
               if ($_POST['bloodbank_chk'] == 1) {

                    $bloodBank_phn = $this->input->post('bloodBank_phn');
                    
                    $bloodBankImagesname = "";
                        if ($_FILES['bloodBank_photo']['name']) {
                            $path = realpath(FCPATH . 'assets/BloodBank/');
                            $upload_data = $this->input->post('avatar_data_bloodbank');
                            $upload_data = json_decode($upload_data);

                            $original_imagesname_bloodbank = $this->uploadImageWithThumb($upload_data, 'bloodBank_photo', $path, 'assets/BloodBank/', './assets/BloodBank/thumb/', 'blood');
                           
                            if (empty($original_imagesname_bloodbank)) {
                                $data['allStates'] = $this->diagnostic_model->fetchStates();
                                $this->session->set_flashdata('valid_upload', $this->error_message);
                                $this->load->super_admin_template('addDiagcenter', $data, 'diagnosticScript');
                                return false;
                            } else {
                                $bloodBankImagesname = $original_imagesname_bloodbank;
                            }
                        }
                    
                    
                    
                    $bloodBank_name = $this->input->post('bloodBank_name');
                    $bloodBank_photo = $this->input->post('bloodBank_photo');
                    $bloodBank_lat = $this->input->post('lat');
                    $bloodBank_long = $this->input->post('lng');

                    $bloodBankDetail = array(
                        'bloodBank_name' => $bloodBank_name,
                        'bloodBank_photo' => $bloodBankImagesname,
                        'bloodBank_lat' => $bloodBank_lat,
                        'bloodBank_long' => $bloodBank_long,
                        'users_id' => $diagnostic_usersId,
                        'creationTime' => strtotime(date("Y-m-d H:i:s")),
                        'bloodBank_phn' => ltrim($bloodBank_phn, 0),
                        'countryId' => $diagnostic_countryId,
                        'bloodBank_cntPrsn' => $diagnostic_cntPrsn,
                        'stateId' => $diagnostic_stateId,
                        'cityId' => $diagnostic_cityId,
                        'bloodBank_add' => $diagnostic_address,
                        'inherit_status' => 1,
                        'bloodBank_zip' => $diagnostic_zip,
                        'bloodBank_docatId' => $this->input->post('docatId'),
                    );
                    $bloodBankId = $this->Hospital_model->insertBloodbank($bloodBankDetail);
                    if ($bloodBankId) {
                        $insertusersRoles = array(
                            // 'usersRoles_userId' => $bloodBankId, // As per Mahipal's suggetion
                            'usersRoles_userId' => $diagnostic_usersId,
                            'usersRoles_roleId' => 2,
                            'usersRoles_parentId' => $diagnostic_usersId,
                            'creationTime' => strtotime(date("Y-m-d H:i:s"))
                        );

                        $this->Hospital_model->insertUsersRoles($insertusersRoles);

                        unset($insertusersRoles);

                        $conditions = array();
                        $conditions['bloodCat_deleted'] = 0;
                        $select = array('bloodCat_name', 'bloodCat_id');
                        $bloodBankCatData = $this->Bloodbank_model->fetchTableData($select, 'qyura_bloodCat', $conditions);

                        foreach ($bloodBankCatData as $key => $val) {
                            $bloodCatData = array(
                                'bloodBank_id' => $diagnostic_usersId,
                                'bloodCats_id' => $val->bloodCat_id,
                                'bloodCatBank_Unit' => 0,
                                'creationTime' => strtotime(date("Y-m-d H:i:s"))
                            );
                            $this->Hospital_model->insertTableData('qyura_bloodCatBank', $bloodCatData);
                            $bloodCatData = '';
                        }
                    }
                }

             


                if ($_POST['ambulance_chk'] == 1) {

                    $ambulance_phn = $this->input->post('ambulance_phn');
                  
                     $ambulanceImagesname = "";
                        if ($_FILES['ambulance_photo']['name']) {
                            $path = realpath(FCPATH . 'assets/ambulanceImages/');
                            $upload_data = $this->input->post('avatar_data_ambulance');
                            $upload_data = json_decode($upload_data);
                            $original_imagesname_ambulance = $this->uploadImageWithThumb($upload_data, 'ambulance_photo', $path, 'assets/ambulanceImages/', './assets/ambulanceImages/thumb/', 'ambulance');

                            if (empty($original_imagesname_ambulance)) {
                                    $data['allStates'] = $this->diagnostic_model->fetchStates();
                                    $this->session->set_flashdata('valid_upload', $this->error_message);
                                    $this->load->super_admin_template('addDiagcenter', $data, 'diagnosticScript');
                                    return false;
                            } else {
                                $ambulanceImagesname = $original_imagesname_ambulance;
                            }
                        }
                    
                    $ambulance_name = $this->input->post('ambulance_name');
                    $ambulance_img = $this->input->post('ambulance_img');
                    $ambulance_lat = $this->input->post('lat');
                    $ambulance_long = $this->input->post('lng');
                    $docOnBoard = $this->input->post('docOnBoard');

                    $ambulanceDetail = array(
                        'ambulance_name' => $ambulance_name,
                        'ambulance_img' => $ambulanceImagesname,
                        'ambulance_lat' => $ambulance_lat,
                        'ambulance_long' => $ambulance_long,
                        'ambulance_usersId' => $diagnostic_usersId,
                        'creationTime' => strtotime(date("Y-m-d H:i:s")),
                        'ambulance_phn' => ltrim($ambulance_phn, 0),
                        'ambulance_countryId' => $diagnostic_countryId,
                        'ambulance_stateId' => $diagnostic_stateId,
                        'ambulance_cityId' => $diagnostic_cityId,
                        'ambulance_address' => $diagnostic_address,
                        'ambulance_cntPrsn' => $diagnostic_cntPrsn,
                        'inherit_status' => 1,
                        'ambulance_zip' => $diagnostic_zip,
                        'docOnBoard' => $docOnBoard,
                        'ambulance_docatId' => $this->input->post('docatId'),
                    );
                    $ambulanceId = $this->Hospital_model->insertAmbulance($ambulanceDetail);
                    if ($ambulanceId) {
                        $insertusersRoles3 = array(
                            //'usersRoles_userId' => $ambulanceId,// As per Mahipal's suggetion
                            'usersRoles_userId' => $diagnostic_usersId,
                            'usersRoles_roleId' => 8,
                            'usersRoles_parentId' => $diagnostic_usersId,
                            'creationTime' => strtotime(date("Y-m-d H:i:s"))
                        );

                        $this->Hospital_model->insertUsersRoles($insertusersRoles3);

                        unset($insertusersRoles3);
                    }
                }
            
            $this->session->set_flashdata('message', 'Record has been saved successfully!');
            redirect('diagnostic');
        }
    }

    function getImageBase64Code($img) {
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $img = str_replace('[removed]', '', $img);
        $data = base64_decode($img);
        return $data;
    }

    function check_email() {
        $user_table_id = '';
        $users_email = $this->input->post('users_email');
        if (isset($_POST['user_table_id'])) {
            $user_table_id = $this->input->post('user_table_id');
        }
        $email = $this->diagnostic_model->fetchEmail($users_email, $user_table_id);
        
        if($email == 1)
        echo $email;
        else{
            $select = array('users_id');
            $where = array('users_email'=> $users_email,
                'users_deleted'=>0);
            $return = $this->diagnostic_model->fetchTableData($select,'qyura_users',$where);
            $data = 0;
            if(!empty($return)){
                $data = $return[0]->users_id;
                echo $data;
            }else{
                echo $data;
            }
        }
        
        exit;
    }

    /**
     * @project Qyura
     * @method saveDetailDiagnostic
     * @description edit diagnostic
     * @access public
     * @return boolean
     */
    function saveDetailDiagnostic($diagnosticId) {
        //echo $diagnosticId;

        $this->bf_form_validation->set_rules('diagnostic_name', 'Diagnostic Name', 'required|trim');
        $this->bf_form_validation->set_rules('diagno_type', 'Diagnostic Type', 'required|trim');
        $this->bf_form_validation->set_rules('diagnostic_countryId', 'Diagnostic Country', 'required|trim');
        $this->bf_form_validation->set_rules('diagnostic_stateId', 'Diagnostic StateId', 'required|trim');
        $this->bf_form_validation->set_rules('diagnostic_cityId', 'Diagnostic City', 'required|trim');
        $this->bf_form_validation->set_rules('diagnostic_address', 'Diagnostic Address', 'required|trim');
        $this->bf_form_validation->set_rules('diagnostic_cntPrsn', 'Contact Person', 'required|trim');
        $this->bf_form_validation->set_rules('diagnostic_zip', 'Diagnostic Zip', 'required|trim');
        $this->bf_form_validation->set_rules('diagnostic_dsgn', 'Diagnostic Designation', 'required|trim');
        $this->bf_form_validation->set_rules('isManual', 'Manual', 'trim|required');
        $this->bf_form_validation->set_rules('diagnostic_aboutUs', 'About Us', 'trim|required');
        $this->bf_form_validation->set_rules('lat', 'Latitude', 'required|trim');
        $this->bf_form_validation->set_rules('lng', 'Longitude', 'required|trim');
        $this->bf_form_validation->set_rules('diagnostic_phn', 'diagnostic phon no.', 'required|numeric');
        
        // other
        $this->bf_form_validation->set_rules('bloodbank_chk', 'blood bank checkbox', 'trim');
        $this->bf_form_validation->set_rules('bloodBank_name', 'blood bank name', 'trim');
        $this->bf_form_validation->set_rules('bloodBank_phn', 'blood bank phon no.', 'trim');

        $this->bf_form_validation->set_rules('pharmacy_chk', 'pharmacy checkbox', 'trim');

        $this->bf_form_validation->set_rules('ambulance_chk', 'ambulance checkbox', 'trim');
        $this->bf_form_validation->set_rules('ambulance_name', 'ambulance name', 'trim');
        $this->bf_form_validation->set_rules('docOnBoard', 'doctor on board', 'trim');
        $this->bf_form_validation->set_rules('ambulance_phn', 'ambulance phon no.', 'trim');

        $this->bf_form_validation->set_rules('availibility_24_7', '27*7 availability', 'trim');
        $this->bf_form_validation->set_rules('isEmergency', 'Is Emergency', 'trim');
        $this->bf_form_validation->set_rules('docatId', 'Docat id', 'trim');
        
      //  $this->bf_form_validation->set_rules('diagno_id', 'Diagnostic id', 'required|trim');


        if ($this->bf_form_validation->run() === FALSE) {
           // echo validation_errors(); exit;
            $data = array();
            $data['allCountry'] = $this->diagnostic_model->fetchCountry();
            $data['diagnosticData'] = $this->diagnostic_model->fetchdiagnosticData($diagnosticId);
            $data['allCountry'] = $this->diagnostic_model->fetchCountry();
            $data['allCities'] = $this->Hospital_model->fetchCity($data['diagnosticData'][0]->diagnostic_stateId);
            $data['allStates'] = $this->diagnostic_model->fetchStates($data['diagnosticData'][0]->diagnostic_countryId);
            $data['diagnosticId'] = $diagnosticId;
            $data['showStatus'] = 'block';
            $data['active'] = 'general';
            // $this->load->view('diagnosticDetail', $data);
            $data['title'] = (!empty($data['diagnosticData'])) ? $data['diagnosticData'][0]->diagnostic_name : "Diagnostic Details";
            $this->load->super_admin_template('diagnosticDetail', $data, 'diagnosticScript');
            return false;
        } else {
            $diagnostic_phn = $this->input->post('diagnostic_phn');
            
            $updateDiagnostic = array(
                'diagnostic_name' => $this->input->post('diagnostic_name'),
                'diagnostic_type' => $this->input->post('diagno_type'),
                'diagnostic_countryId' => $this->input->post('diagnostic_countryId'),
                'diagnostic_stateId' => $this->input->post('diagnostic_stateId'),
                'diagnostic_cityId' => $this->input->post('diagnostic_cityId'),
                'diagnostic_address' => $this->input->post('diagnostic_address'),
                'isManual' => $this->input->post('isManual'),
                'diagnostic_zip' => $this->input->post('diagnostic_zip'),
                'diagnostic_dsgn' => $this->input->post('diagnostic_dsgn'),
                'diagnostic_phn' => ltrim($diagnostic_phn,'0'),
                'diagnostic_cntPrsn' => $this->input->post('diagnostic_cntPrsn'),
                'diagnostic_lat' => $this->input->post('lat'),
                'diagnostic_long' => $this->input->post('lng'),
                'diagnostic_aboutUs' => $this->input->post('diagnostic_aboutUs'),
                'diagnostic_mblNo' => $this->input->post('diagnostic_mobileNo'),
                
                'diagnostic_availibility_24_7' => isset($_POST['availibility_24_7'])? $this->input->post('availibility_24_7') : 0,
                'diagnostic_isEmergency' => isset($_POST['isEmergency'])? $this->input->post('isEmergency') : 0,
                'diagnostic_hasBloodbank' => isset($_POST['bloodbank_chk'])? $this->input->post('bloodbank_chk') : 0,
                'diagnostic_isBloodBankOutsource' => $this->input->post('isBloodBankOutsource'),
                'diagnostic_hasPharmacy' => isset($_POST['pharmacy_chk'])? $this->input->post('pharmacy_chk') : 0,
                'diagnostic_docatId' => $this->input->post('docatId'),
                
                'modifyTime' => strtotime(date("Y-m-d H:i:s"))
            );

            $where = array(
                'diagnostic_id' => $diagnosticId
            );
            
           $response = '';
           $response = $this->diagnostic_model->UpdateTableData($updateDiagnostic, $where, 'qyura_diagnostic');
            
            if ($response) {
                if (isset($_POST['bloodbank_chk']) == 1) {

                    $bloodBank_phn = $this->input->post('bloodBank_phn');
                    $conditions = array();
                    $conditions['users_id'] = $this->input->post('user_tables_id');
                    $conditions['bloodBank_deleted'] = 0;
                    $select = array('bloodBank_id');
                    $getData = '';
                    $getData = $this->Hospital_model->fetchTableData($select, 'qyura_bloodBank', $conditions);
                    $bloodBankDetail = array(
                        'bloodBank_name' => $this->input->post('bloodBank_name'),
                        
                        'countryId' => $this->input->post('diagnostic_countryId'),
                        'stateId' => $this->input->post('diagnostic_stateId'),
                        'cityId' => $this->input->post('diagnostic_cityId'),
                        
                        'bloodBank_lat' => $this->input->post('lat'),
                        'bloodBank_long' => $this->input->post('lng'),
                        'bloodBank_add' => $this->input->post('diagnostic_address'),
                        'bloodBank_phn' => ltrim($bloodBank_phn, 0),
                        'bloodBank_docatId' => $this->input->post('docatId'),
                        'modifyTime' => strtotime(date("Y-m-d H:i:s"))
                    );
                    if ($getData) {
                        
                        $bloodWhereUser = array(
                            'users_id' => $this->input->post('user_tables_id')
                        );
                        //$bloodBankId = $this->Hospital_model->insertBloodbank($bloodBankDetail);
                        $this->Hospital_model->UpdateTableData($bloodBankDetail, $bloodWhereUser, 'qyura_bloodBank');
                    } else {
                        
                        $bloodBankImagesname = "";
                        if ($_FILES['bloodBank_photo']['name']) {
                            $path = realpath(FCPATH . 'assets/BloodBank/');
                            $upload_data = $this->input->post('avatar_data_bloodbank');
                            $upload_data = json_decode($upload_data);

                            $original_imagesname_bloodbank = $this->uploadImageWithThumb($upload_data, 'bloodBank_photo', $path, 'assets/BloodBank/', './assets/BloodBank/thumb/', 'blood');
                           
                            if (empty($original_imagesname_bloodbank)) {
                                $data = array();
                                $data['allCountry'] = $this->diagnostic_model->fetchCountry();
                                $data['diagnosticData'] = $this->diagnostic_model->fetchdiagnosticData($diagnosticId);
                                $data['allCountry'] = $this->diagnostic_model->fetchCountry();
                                $data['allCities'] = $this->Hospital_model->fetchCity($data['diagnosticData'][0]->diagnostic_stateId);
                                $data['allStates'] = $this->diagnostic_model->fetchStates($data['diagnosticData'][0]->diagnostic_countryId);
                                $data['diagnosticId'] = $diagnosticId;
                                $data['showStatus'] = 'block';
                                $data['active'] = 'general';
                                // $this->load->view('diagnosticDetail', $data);
                                $data['title'] = (!empty($data['diagnosticData'])) ? $data['diagnosticData'][0]->diagnostic_name : "Diagnostic Details";
                                $this->load->super_admin_template('diagnosticDetail', $data, 'diagnosticScript');
                                return false;
                            } else {
                                $bloodBankImagesname = $original_imagesname_bloodbank;
                            }
                        }
                         
                        unset($bloodBankDetail['modifyTime']);
                        $bloodBankDetail['users_id'] = $this->input->post('user_tables_id');
                        $bloodBankDetail['creationTime'] =  strtotime(date("Y-m-d H:i:s"));
                        $bloodBankDetail['bloodBank_photo'] = $bloodBankImagesname;
                        
                        $optionInsert = array(
                            
                            'table' => 'qyura_bloodBank',
                            'data' => $bloodBankDetail,
                        );
                        
                        $bloodBankId = $this->common_model->customInsert($optionInsert);

                        $conditions = array();
                        $conditions['bloodCat_deleted'] = 0;
                        $select = array('bloodCat_name', 'bloodCat_id');
                        $bloodBankCatData = $this->Bloodbank_model->fetchTableData($select, 'qyura_bloodCat', $conditions);

                        foreach ($bloodBankCatData as $key => $val) {
                            $bloodCatData = array(
                                'bloodBank_id' => $this->input->post('user_tables_id'),
                                'bloodCats_id' => $val->bloodCat_id,
                                'bloodCatBank_Unit' => 0,
                                'creationTime' => strtotime(date("Y-m-d H:i:s"))
                            );
                            $this->Hospital_model->insertTableData('qyura_bloodCatBank', $bloodCatData);
                            $bloodCatData = '';
                        }
                    }
                } else {
                    $bloodWhereUser = array(
                        'users_id' => $this->input->post('user_tables_id')
                    );
                    $this->Hospital_model->deleteTable('qyura_bloodBank', $bloodWhereUser);

                    $bloodCatDataDelete = array(
                        'bloodBank_id' => $this->input->post('user_tables_id'),
                    );
                    $this->Hospital_model->deleteTable('qyura_bloodCatBank', $bloodCatDataDelete);
                }

                if (isset($_POST['ambulance_chk']) == 1) {

                    $ambulance_phn = $this->input->post('ambulance_phn');
                 
                    $ambulance_name = $this->input->post('ambulance_name');
                    $docOnBoard = $this->input->post('docOnBoard');
                    
                    //echo $finalAmbulanceNumber;exit;
                    $ambulance_lat = $this->input->post('lat');
                    $ambulance_long = $this->input->post('lng');

                    $ambulanceDetail = array(
                        'ambulance_name' => $ambulance_name,
                        
                        'ambulance_countryId' => $this->input->post('diagnostic_countryId'),
                        'ambulance_stateId' => $this->input->post('diagnostic_stateId'),
                        'ambulance_cityId' => $this->input->post('diagnostic_cityId'),
                        
                        'ambulance_lat' => $ambulance_lat,
                        'ambulance_long' => $ambulance_long,
                        'ambulance_usersId' => $this->input->post('user_tables_id'),
                        'creationTime' => strtotime(date("Y-m-d H:i:s")),
                        'ambulance_phn' => ltrim($ambulance_phn, 0),
                        'ambulance_address' => $this->input->post('diagnostic_address'),
                        'docOnBoard' => $docOnBoard,
                        'ambulance_docatId' => $this->input->post('docatId'),
                    );
                    $ambulanceConditions = array();
                    $ambulanceConditions['ambulance_usersId'] = $this->input->post('user_tables_id');
                    $ambulanceConditions['ambulance_deleted'] = 0;
                    $ambulanceSelect = array('ambulance_id');
                    $getDataAmbulance = '';
                    $getDataAmbulance = $this->Hospital_model->fetchTableData($ambulanceSelect, 'qyura_ambulance', $ambulanceConditions);

                    if ($getDataAmbulance) {
                        unset($ambulanceDetail['creationTime']);
                        unset($ambulanceDetail['ambulance_usersId']);
                        
                        $ambulanceDetail['modifyTime'] = strtotime(date("Y-m-d H:i:s"));
                        
                        $ambulanceWhereUser = array(
                            'ambulance_usersId' => $this->input->post('user_tables_id')
                        );
                        // print_r($ambulanceDetail);exit;
                        $this->Hospital_model->UpdateTableData($ambulanceDetail, $ambulanceWhereUser, 'qyura_ambulance');
                        
                    } else {
                        
                        $ambulanceImagesname = "";
                        if ($_FILES['ambulance_photo']['name']) {
                            $path = realpath(FCPATH . 'assets/ambulanceImages/');
                            $upload_data = $this->input->post('avatar_data_ambulance');
                            $upload_data = json_decode($upload_data);
                            $original_imagesname_ambulance = $this->uploadImageWithThumb($upload_data, 'ambulance_photo', $path, 'assets/ambulanceImages/', './assets/ambulanceImages/thumb/', 'ambulance');

                            if (empty($original_imagesname_ambulance)) {
                                    $data = array();
                                    $data['allCountry'] = $this->diagnostic_model->fetchCountry();
                                    $data['diagnosticData'] = $this->diagnostic_model->fetchdiagnosticData($diagnosticId);
                                    $data['allCountry'] = $this->diagnostic_model->fetchCountry();
                                    $data['allCities'] = $this->Hospital_model->fetchCity($data['diagnosticData'][0]->diagnostic_stateId);
                                    $data['allStates'] = $this->diagnostic_model->fetchStates($data['diagnosticData'][0]->diagnostic_countryId);
                                    $data['diagnosticId'] = $diagnosticId;
                                    $data['showStatus'] = 'block';
                                    $data['active'] = 'general';
                                    // $this->load->view('diagnosticDetail', $data);
                                    $data['title'] = (!empty($data['diagnosticData'])) ? $data['diagnosticData'][0]->diagnostic_name : "Diagnostic Details";
                                    $this->load->super_admin_template('diagnosticDetail', $data, 'diagnosticScript');
                                    return false;
                            } else {
                                $ambulanceImagesname = $original_imagesname_ambulance;
                            }
                        }
                        $ambulanceDetail['ambulance_img'] = $ambulanceImagesname;
                        $ambulanceData = array('table' => 'qyura_ambulance', 'data' => $ambulanceDetail);
                        $ambulanceId = $this->common_model->customInsert($ambulanceData);
                    }
                } else {
                    $ambulanceWhereUser = array(
                        'ambulance_usersId' => $this->input->post('user_tables_id')
                    );
                    $this->Hospital_model->deleteTable('qyura_ambulance', $ambulanceWhereUser);
                }
                $this->session->set_flashdata('message', 'Record has been updated successfully!');
                redirect("diagnostic/detailDiagnostic/$diagnosticId/general");
            }
        }
    }

    function updateAccount($diagnosticId) {

        $this->bf_form_validation->set_rules('diagnostic_mbrTyp', 'Membership Type', 'required|trim');
        $this->bf_form_validation->set_rules('users_email', 'Users Email', 'required|valid_email|trim');
        $this->bf_form_validation->set_rules('users_password', 'Password', 'trim|required');

        if ($this->bf_form_validation->run() === FALSE) {
            $data = array();
            $data['diagnosticData'] = $this->diagnostic_model->fetchdiagnosticData($diagnosticId);
            $data['diagnosticId'] = $diagnosticId;
            $data['showStatus'] = 'block';
            $data['detailShow'] = 'none';
            $data['title'] = (!empty($data['diagnosticData'])) ? $data['diagnosticData'][0]->diagnostic_name : "Diagnostic Details";
            $this->load->super_admin_template('diagnosticDetail', $data, 'diagnosticScript');
        } else {

            $users_email = $this->input->post('users_email');
            $diagnostic_mbrTyp = $this->input->post('diagnostic_mbrTyp');
            $passwords = $this->input->post('users_password');
            $users_password = $this->common_model->encryptPassword($passwords);
            $user_id = $this->input->post('did_userId');
            $diagnosticInsert = array(
                'users_email' => $users_email,
                'users_password' => $users_password
            );
            $options = array(
                'data' => $diagnosticInsert,
                'table' => 'qyura_users',
                'where' => array('users_id' => $user_id)
            );
            $response = $this->diagnostic_model->customUpdate($options);

            $options_dia = array(
                'data' => array('diagnostic_mbrTyp' => $diagnostic_mbrTyp),
                'table' => 'qyura_diagnostic',
                'where' => array('diagnostic_id' => $diagnosticId)
            );
            $response = $this->diagnostic_model->customUpdate($options_dia);
            if ($response) {
                $this->session->set_flashdata('message', 'Record has been updated successfully!');
                redirect("diagnostic/detailDiagnostic/$diagnosticId");
            } else {
                $this->session->set_flashdata('message', 'Record has been updated failed!');
                redirect("diagnostic/detailDiagnostic/$diagnosticId/account");
            }
        }
    }

    /**
     * @project Qyura
     * @method editUploadImage
     * @description update details page image profile
     * @access public
     * @return boolean
     */
    function editUploadImage() {
       // dump($_POST); exit;
        if ($_POST['avatar_file']['name']) {
            $path = realpath(FCPATH . 'assets/diagnosticsImage/');
            $upload_data = $this->input->post('avatar-data');
            $upload_data = json_decode($upload_data);
           // echo $upload_data->width; exit;
            if($upload_data->width > 425){
            
            $original_imagesname = $this->uploadImageWithThumb($upload_data, 'avatar_file', $path, 'assets/diagnosticsImage/', './assets/diagnosticsImage/thumb/', 'diagnostic');

            if (empty($original_imagesname)) {
                $response = array('state' => 400, 'message' => $this->error_message);
            } else {

                $option = array(
                    'diagnostic_img' => $original_imagesname,
                    'modifyTime' => strtotime(date("Y-m-d H:i:s"))
                );
                $where = array(
                    'diagnostic_id' => $this->input->post('avatar_id')
                );
                $response = $this->diagnostic_model->UpdateTableData($option, $where, 'qyura_diagnostic');
                if ($response) {
                    //$response = array('state' => 200, 'message' => 'Successfully update avtar');
                     $response = array('state' => 200, 'message' => 'Successfully update avtar','image'=>base_url("assets/diagnosticsImage/thumb/thumb_100/{$original_imagesname}"),'reset'=>"diagno_edit", 'returnClass'  => 'logo-img');
                } else {
                    $response = array('state' => 400, 'message' => 'Failed to update avtar');
                }
            }
            
            }else{
               $response = array('state' => 400, 'message' => 'Height and Width must exceed 150px.');  
            }
            echo json_encode($response);
        } else {
            $response = array('state' => 400, 'message' => 'Please select avtar');
            echo json_encode($response);
        }
    }

    function getUpdateAvtar($id) {
        if (!empty($id)) {
            $data = $this->diagnostic_model->fetchdiagnosticData($id);
            echo "<img src='" . base_url() . "assets/diagnosticsImage/thumb/original/" . $data[0]->diagnostic_img . "'alt='' class='logo-img' />";
            exit();
        }
    }

    /**
     * @project Qyura
     * @method galleryUploadImage
     * @description add gallery image
     * @access public
     * @return boolean
     */
    function galleryUploadImage() {

        if ($_POST['avatar_file_gallery']['name']) {
            $path = realpath(FCPATH . 'assets/diagnosticsImage/');
            $upload_data = $this->input->post('avatar_data_gallery');
            $upload_data = json_decode($upload_data);
            $original_imagesname = $this->uploadImageWithThumb($upload_data, 'avatar_file_gallery', $path, 'assets/diagnosticsImage/', './assets/diagnosticsImage/thumb/', 'diagnostic');

            if (empty($original_imagesname)) {
                $response = array('state' => 400, 'message' => $this->error_message);
            } else {

                $option = array(
                    'diagonsticImages_ImagesName' => $original_imagesname,
                    'diagonsticImages_diagonsticId' => $this->input->post('avatar_id'),
                    'creationTime' => strtotime(date("Y-m-d H:i:s"))
                );
                $options = array(
                    'table' => 'qyura_diagonsticsImages              ',
                    'data' => $option
                );

                $response = $this->diagnostic_model->customInsert($options);
                if ($response) {
                    $response = array('state' => 200, 'message' => 'Record has been saved successfully');
                } else {
                    $response = array('state' => 400, 'message' => 'Failed to added gallery image');
                }
            }
            echo json_encode($response);
        } else {
            $response = array('state' => 400, 'message' => 'Please select image');
            echo json_encode($response);
        }
    }

    function getGalleryImage($id) {
        if (!empty($id)) {
            $gallery_template = '';
            $where = array(
                'diagonsticImages_diagonsticId' => $id,
                'diagonsticImages_deleted' => 0
            );
            $options = array(
                'table' => 'qyura_diagonsticsImages',
                'where' => $where
            );
            $gallerys = $this->diagnostic_model->customGet($options);
            if ($gallerys) {
                foreach ($gallerys as $gallery) {
                    $gallery_template.='<aside class="col-md-3 col-sm-4 col-xs-6 show-image">
                                                <img width="210" class="thumbnail img-responsive" src="' . base_url() . '/assets/diagnosticsImage/thumb/original/' . $gallery->diagonsticImages_ImagesName . '">
                                                <a class="delete" onClick="deleteGalleryImage(' . $gallery->diagonsticImages_id . ')"> <i class="fa fa-times fa-2x"></i></a>
                                            </aside>';
                }
            } else {
                $gallery_template = 'Add Image';
            }
            echo $gallery_template;
            exit();
        }
    }

    function deleteGalleryImage() {
        $id = $this->input->post('id');
        $updatedData = array('diagonsticImages_deleted' => 1);
        $updatedDataWhere = array('diagonsticImages_id' => $id);

        $option = array(
            'table' => 'qyura_diagonsticsImages',
            'where' => $updatedDataWhere,
            'data' => $updatedData
        );
        $return = $this->diagnostic_model->customUpdate($option);
        echo $return;
        exit;
    }

    /**
     * @project Qyura
     * @method addDiagnosticAwards
     * @description add awards
     * @access public
     * @return array
     */
    function addDiagnosticAwards() {
        //echo 'hemant'; exit;
        $Id = $this->input->post('diagnosticId');
        $Awards_awardsName = $this->input->post('diaAwards_awardsName');
        $diagnosticAwards_awardYear = $this->input->post('dialAwards_awardsYear');
        $diagnosticAwards_agencyName = $this->input->post('diagnosticAwards_agencyName');
        
        $awardData = array('diagnosticAwards_awardsName' => $Awards_awardsName, 'diagnosticAwards_diagnosticId' => $Id, 'creationTime' => strtotime(date("Y-m-d H:i:s")), 'diagnosticAwards_awardYear' => $diagnosticAwards_awardYear, 'diagnosticAwards_awardsAgency' =>  $diagnosticAwards_agencyName);
        
      //  print_r($awardData); exit;
        
        $option = array(
            'table' => 'qyura_diagnosticAwards',
            'data' => $awardData
        );
        $insert = $this->diagnostic_model->customInsert($option);
        echo $insert;
        exit;
    }

    function editDiagnosticAwards() {
        $id = $this->input->post('awardsId');
        
        $awardsName = $this->input->post('diaAwards_awardsName');
        $edit_awardsAgency = $this->input->post('edit_awardsAgency');
        $edit_awardsYear = $this->input->post('edit_awardsYear');
        
        $updatedData = array('diagnosticAwards_awardsName' => $awardsName, 'diagnosticAwards_awardYear' => $edit_awardsYear, 'diagnosticAwards_awardsAgency' =>  $edit_awardsAgency);
        $updatedDataWhere = array('diagnosticAwards_id' => $id);
        $option = array(
            'table' => 'qyura_diagnosticAwards',
            'where' => $updatedDataWhere,
            'data' => $updatedData
        );
        $return = $this->diagnostic_model->customUpdate($option);
        echo $return;
        exit;
    }

    function deleteDiagnosticAwards() {
        $id = $this->input->post('awardsId');
        $updatedData = array('diagnosticAwards_deleted' => 1);
        $updatedDataWhere = array('diagnosticAwards_id' => $id);

        $option = array(
            'table' => 'qyura_diagnosticAwards',
            'where' => $updatedDataWhere,
            'data' => $updatedData
        );
        $return = $this->diagnostic_model->customUpdate($option);
        echo $return;
        exit;
    }

    function diagnosticAwards($hospitalId) {
        $option = array(
            'table' => 'qyura_diagnosticAwards',
            'where' => array('diagnosticAwards_diagnosticId' => $hospitalId, 'diagnosticAwards_deleted' => 0),
            'join' => array(array('qyura_awardAgency', 'qyura_awardAgency.awardAgency_id = qyura_diagnosticAwards.diagnosticAwards_awardsAgency', 'left') ),
        );
        $dataAwards = $this->diagnostic_model->customGet($option);
      //  echo $this->db->last_query(); exit;
        $showAwards = '';
        if ($dataAwards) {
            foreach ($dataAwards as $key => $val) {
                $showAwards .='<li>' . $val->diagnosticAwards_awardsName . ', ' . $val->diagnosticAwards_awardYear.', ' . $val->agency_name . '</li>';
            }
        } else {
            $showAwards = 'Add Awards';
        }
        echo $showAwards;
        exit;
    }

    function detailAwards($hospitalId) {
        $option = array(
            'select' => '*, qyura_diagnosticAwards.diagnosticAwards_awardsAgency as awardAgency_id',
            'table' => 'qyura_diagnosticAwards',
            'where' => array('diagnosticAwards_diagnosticId' => $hospitalId, 'diagnosticAwards_deleted' => 0),
        );
         $dataAwards = $this->diagnostic_model->customGet($option);
        // dump($dataAwards);
         $awardAgency = $this->Hospital_model->fetchAwardAgency();
        if ($dataAwards) {
            $showTotalAwards = '';
            foreach ($dataAwards as $key => $val) {
                
                
                 $agencyOption  = '';
                    foreach ($awardAgency as $key => $value) {
                       // echo $value->awardAgency_id.'-'.$val->awardAgency_id.'</br>';
                        if($value->awardAgency_id ==  $val->awardAgency_id){
                           $agencyOption .= '<option selected="selected" value= '.$value->awardAgency_id.' >  '.$value->agency_name.' </option>';
                        }else{
                            $agencyOption .= '<option value= '.$value->awardAgency_id.' >  '.$value->agency_name.' </option>';
                        }
                   }
            
                $showTotalAwards .= '     <aside class="row">
                                <div class="col-md-12 ">
                                
                                     <input type="text" class="form-control" name="hospitalAwards_awardsName" id=' . $val->diagnosticAwards_id . ' value="' . $val->diagnosticAwards_awardsName . '" placeholder="Awards name" />
                                          <label style="display: none;"class="error" id="error-awards' . $val->diagnosticAwards_id . '"> Please enter award name </label> 
                                              
                                          <div class="clearfix m-t-10">
                                            <select class="selectpicker" data-width="100%" id=agency' . $val->diagnosticAwards_id . ' name="diagnosticAwards_agencyName">
                                                  '.$agencyOption.'
                                                </select>
                                             <label style="display: none;"class="error" id="error-agency' . $val->diagnosticAwards_id . '"> Please enter agency name </label>

                                          </div>
                                              
                                    <aside class="clearfix m-t-10">
                   
                                    <input type="text" class="form-control " placeholder="Year" id=year' . $val->diagnosticAwards_id . ' name="diagnostic_awardsyear" value="' . $val->diagnosticAwards_awardYear . '" onkeypress="return isNumberKey(event)"/>
                                           <label style="display: none;"class="error" id="error-years' . $val->diagnosticAwards_id . '"> Please enter year only number formate minium and maximum length 4 </label> 
                                               
                                          <label id="error-years-valid' . $val->diagnosticAwards_id . '" class="error" style="display: none;">Invalid Year! Please enter year between 1920 to 2016  </label>
                                    
                        </aside>
                                </div>
                                
                                <div class="clearfix">
                                    
                                    <div class="col-md-12  col-xs-2 text-right">
            <a class="pointer" onclick="editAwards(' . $val->diagnosticAwards_id . ')"><i class="fa fa-pencil-square-o fa-2x m-t-5 label-plus" title="Edit Awards"></i></a>
                  <a class="pointer" onclick="deleteAwards(' . $val->diagnosticAwards_id . ')"><i class="fa fa-times fa-2x m-t-5 label-plus" title="Delete Awards"></i></a>
           </div>

          
                                </div>
                             
                            </aside>';
                
            }
        } else {
            $showTotalAwards = 'Add Awards';
        }

        echo $showTotalAwards;
        exit;
        
        
    
        
        
    }

    /**
     * @project Qyura
     * @method addDiagnosticServices
     * @description add services
     * @access public
     * @return array
     */
    function addDiagnosticServices() {
        $Id = $this->input->post('diagnosticId');
        $service_name = $this->input->post('service_name');
        $data = array('diagnosticServices_serviceName' => $service_name, 'diagnosticServices_diagnosticId' => $Id, 'diagnosticServices_deleted' => 0, 'creationTime' => strtotime(date("Y-m-d H:i:s")));
        $option = array(
            'table' => 'qyura_diagnosticServices',
            'data' => $data
        );
        $insert = $this->diagnostic_model->customInsert($option);
        echo $insert;
        exit;
    }

    function editDiagnosticServices() {
        $id = $this->input->post('awardsId');
        $awardsName = $this->input->post('service_name');
        $updatedData = array('diagnosticServices_serviceName' => $awardsName, 'modifyTime' => strtotime(date("Y-m-d H:i:s")));
        $updatedDataWhere = array('diagnosticServices_id' => $id);
        $option = array(
            'table' => 'qyura_diagnosticServices',
            'where' => $updatedDataWhere,
            'data' => $updatedData
        );
        $return = $this->diagnostic_model->customUpdate($option);
        echo $return;
        exit;
    }

    function deleteDiagnosticServices() {
        $id = $this->input->post('awardsId');
        $updatedData = array('diagnosticServices_deleted' => 1);
        $updatedDataWhere = array('diagnosticServices_id' => $id);

        $option = array(
            'table' => 'qyura_diagnosticServices',
            'where' => $updatedDataWhere,
            'data' => $updatedData
        );
        $return = $this->diagnostic_model->customUpdate($option);
        echo $return;
        exit;
    }

    function diagnosticServices($id) {
        $option = array(
            'table' => 'qyura_diagnosticServices',
            'where' => array('diagnosticServices_diagnosticId' => $id, 'diagnosticServices_deleted' => 0),
        );
        $services = $this->diagnostic_model->customGet($option);
        $showServices = '';
        if ($services) {
            foreach ($services as $key => $val) {
                $showServices .='<li>' . $val->diagnosticServices_serviceName . '</li>';
            }
        } else {
            $showServices = 'Add Services';
        }
        echo $showServices;
        exit;
    }

    function detailServices($id) {
        $option = array(
            'table' => 'qyura_diagnosticServices',
            'where' => array('diagnosticServices_diagnosticId' => $id, 'diagnosticServices_deleted' => 0),
        );
        $services = $this->diagnostic_model->customGet($option);
        if ($services) {
            $template = '';
            foreach ($services as $key => $val) {
                $template .= '<div class="row m-t-10">
        <div class="col-md-8 col-sm-8 col-xs-8">
           <input type="text" class="form-control" name="digAwards_ServiceName" id=' . $val->diagnosticServices_id . ' value="' . $val->diagnosticServices_serviceName . '" placeholder="FICCI Healthcare " />
               <label style="display: none;"class="error" id="error-serviceName' . $val->diagnosticServices_id . '"> Please enter service name </label> 
         </div>
           <div class="col-md-2 col-sm-2 col-xs-2">
            <a class="pointer" onclick="editServices(' . $val->diagnosticServices_id . ')"><i class="fa fa-pencil-square-o fa-2x m-t-5 label-plus" title="Edit Awards"></i></a>
           </div>

          <div class="col-md-2 col-sm-2 col-xs-2">
          <a class="pointer" onclick="deleteServices(' . $val->diagnosticServices_id . ')"><i class="fa fa-times fa-2x m-t-5 label-plus" title="Delete Awards"></i></a>
          </div>
         </div>';
            }
        } else {
            $template = 'Add Services';
        }

        echo $template;
        exit;
    }

    /**
     * @project Qyura
     * @method diagnosticCategorys
     * @description add category
     * @access public
     * @return array
     */
    function diagnosticCategorys($diagnosticId) {

        $Seleted = array(
            'diagnosticsHasCat_id', 'diagnosticsHasCat_diagnosticId', 'diagnosticsHasCat_diagnosticsCatId'
        );
        $Where = array(
            'diagnosticsHasCat_diagnosticId' => $diagnosticId
        );
        $notIn = '';
        $hospitalData = $this->diagnostic_model->fetchTableData($Seleted, 'qyura_diagnosticsHasCat', $Where);
        foreach ($hospitalData as $key => $val) {
            $notIn [] = $val->diagnosticsHasCat_diagnosticsCatId;
        }

        $selectTableData = array(
            'diagnosticsCat_catId', 'diagnosticsCat_catName'
        );
        $wheres = array(
            'diagnosticsCat_deleted' => 0
        );
        $data = $this->diagnostic_model->fetchTableData($selectTableData, 'qyura_diagnosticsCat', $wheres, $notIn, 'diagnosticsCat_catId');
        $specialist = '';
        foreach ($data as $key => $val) {
            $specialist .='<li ><input type=checkbox class=diagonasticCheck name=speciality value=' . $val->diagnosticsCat_catId . ' /> ' . $val->diagnosticsCat_catName . '</li>';
        }

        echo $specialist;
        exit;
    }

    function diagnosticAllocatedCategorys($diagnosticId) {

        $data = $this->diagnostic_model->fetchdiagnosticsDiagnosticCatData($diagnosticId);
        $allocatedSpecialist = '';
        foreach ($data as $key => $val) {
            $allocatedSpecialist .='<li onClick=getDignosticPrize(' . $diagnosticId . ',' . $val->diagnosticsHasCat_diagnosticsCatId . ')>' . $val->diagnosticsCat_catName . '<input type=checkbox class=diagonasticAllocCheck name=allocSpeciality value=' . $val->diagnosticsHasCat_id . ' /></li>';
        }
        echo $allocatedSpecialist;
        exit;
    }

    function addDiagnosticHasCategory() {

        $id = $this->input->post('diagnosticId');
        $diagnosticsCat_diagnosticsCatId = $this->input->post('diagnosticsHasCat_diagnosticsCatId');
        $insertData = array(
            'diagnosticsHasCat_diagnosticsCatId' => $diagnosticsCat_diagnosticsCatId,
            'diagnosticsHasCat_diagnosticId' => $id,
            'creationTime' => strtotime(date("Y-m-d H:i:s"))
        );
        $option = array(
            'table' => 'qyura_diagnosticsHasCat',
            'data' => $insertData
        );
        $return = $this->diagnostic_model->customInsert($option);
        echo $return;
        exit;
    }

    function revertDiagnosticHasCategory() {
        $id = $this->input->post('diagnosticId');
        $diagnosticsCat_id = $this->input->post('diagnosticsHasCat_id');
        $diagonasticData = array(
            'hospitalDiagnosticsCat_deleted' => 1,
            'modifyTime' => strtotime(date("Y-m-d H:i:s"))
        );
        $diagonasticWhere = array('diagnosticsHasCat_id' => $diagnosticsCat_id,
            'diagnosticsHasCat_diagnosticId' => $id);

        $option = array(
            'table' => 'qyura_diagnosticsHasCat',
            'where' => $diagonasticWhere
        );
        $return = $this->diagnostic_model->customDelete($option);
        echo $return;
    }

    /**
     * @project Qyura
     * @method diagnosticSpecialities
     * @description add specialities
     * @access public
     * @return array
     */
    function diagnosticSpecialities($diagnosticId) {

        $Seleted = array(
            'diagnosticSpecialities_id', 'diagnosticSpecialities_diagnosticId', 'diagnosticSpecialities_specialitiesId'
        );
        $Where = array(
            'diagnosticSpecialities_diagnosticId' => $diagnosticId,
            'diagnosticSpecialities_deleted' => 0
        );
        $notIn = '';
        $hospitalData = $this->diagnostic_model->fetchTableData($Seleted, 'qyura_diagnosticSpecialities', $Where);
        foreach ($hospitalData as $key => $val) {
            $notIn [] = $val->diagnosticSpecialities_specialitiesId;
        }

        $selectTableData = array(
            'specialities_id', 'specialities_name'
        );
        $wheres = array(
            'specialities_deleted' => 0,
        );
        $data = $this->diagnostic_model->fetchTableData($selectTableData, 'qyura_specialities', $wheres, $notIn, 'specialities_id');
        $specialist = '';
        foreach ($data as $key => $val) {
            $specialist .='<li ><input type=checkbox class="diagonasticSpecialCheck myCheckbox" name=speciality value=' . $val->specialities_id . ' /> ' . $val->specialities_name . '</li>';
        }

        echo $specialist;
        exit;
    }

    function diagnosticAllocatedSpecialities($diagnosticId) {

        $data = $this->diagnostic_model->fetchdiagnosticsSpecialityData($diagnosticId);
        $allocatedSpecialist = '';
        foreach ($data as $key => $val) {
            $allocatedSpecialist .='<li id="'.$val->diagnosticSpecialities_id.'">' . $val->specialities_name . '<input type=checkbox class=diagonasticAllocSpecialCheck name=allocSpeciality value=' . $val->diagnosticSpecialities_id . ' /></li>';
        }
        echo $allocatedSpecialist;
        exit;
    }
    
    
    function diagnoSpecialitiesOrder()
    {
    //  print_r($_POST);   
        if(!empty($_POST))
            {
                $count=0;
                foreach($_POST as $diagnoSpecialities_id => $order)
                {
                    
                    $diagnoSpecialitiesData = array('diagnosticSpecialities_orderForHos'=>$order);
                    $con = array('diagnosticSpecialities_id'=>$diagnoSpecialities_id);
                    $return = $this->Hospital_model->UpdateTableData($diagnoSpecialitiesData, $con, 'qyura_diagnosticSpecialities');
                    //echo $this->db->last_query();
                    
                    if($return)
                        $count++;
                }
                if($count==  count($_POST))
                    echo 1;
                
            }
            else
            {
                echo 0;
            }
    }

    function addSpeciality() {

        $id = $this->input->post('diagnosticId');
        $diagnoUserId = $this->input->post('diagnoUserId');
        
        $diagnosticSpecialities_specialitiesId = $this->input->post('diagnosticSpecialities_specialitiesId');
        
          $sql = 'select diagnosticSpecialities_id from qyura_diagnosticSpecialities where diagnosticSpecialities_diagnosticId = '.$id.' AND diagnosticSpecialities_deleted = 0 ';
        
        $numRows = $this->common_model->customQueryCount($sql);
        
        $benifitSpeciality = "select miMembership_quantity from qyura_miMembership where miMembership_miId = $diagnoUserId AND miMembership_deleted = 0 AND miMembership_facilitiesId = 1 AND miMembership_type = 10";
        
        $benifitSpecialityResult = $this->common_model->customQuery($benifitSpeciality, true);
        
       // echo $this->db->last_query(); exit;
        if($numRows >= $benifitSpecialityResult->miMembership_quantity){
             echo 0; exit;
        }else{
        $insertData = array(
            'diagnosticSpecialities_specialitiesId' => $diagnosticSpecialities_specialitiesId,
            'diagnosticSpecialities_diagnosticId' => $id,
            'diagnosticSpecialities_deleted' => 0,
            'creationTime' => strtotime(date("Y-m-d H:i:s"))
        );
        $option = array(
            'table' => 'qyura_diagnosticSpecialities',
            'data' => $insertData
        );
        $return = $this->diagnostic_model->customInsert($option);
        echo $return;
        exit;
        }
    }

    function revertSpeciality() {
        $id = $this->input->post('diagnosticId');
        $diagnosticSpecialities_id = $this->input->post('diagnosticSpecialities_id');
        $diagonasticData = array(
            'diagnosticSpecialities_deleted' => 1,
            'modifyTime' => strtotime(date("Y-m-d H:i:s"))
        );
        $diagonasticWhere = array('diagnosticSpecialities_id' => $diagnosticSpecialities_id,
            'diagnosticSpecialities_diagnosticId' => $id);

        $option = array(
            'table' => 'qyura_diagnosticSpecialities',
            'where' => $diagonasticWhere,
            'data' => $diagonasticData
        );
        $return = $this->diagnostic_model->customUpdate($option);
        echo $return;
    }

    /**
     * @project Qyura
     * @method getDiagnosticPrizeList
     * @description get prize quotation prize list
     * @access public
     * @return array
     */
    function getDiagnosticPrizeList() {
        $diagnosticId = $this->input->post('diagnosticId');
        $categoryId = $this->input->post('categoryId');
        $selectTableData = array(
            'quotationDetailTests_testName', 'quotationDetailTests_price', 'quotationDetailTests_id'
        );
        $where = array(
            'quotationDetailTests_diagnosticCatId' => $categoryId,
            'quotationDetailTests_MIprofileId' => $diagnosticId,
            'quotationDetailTests_deleted' => 0
        );
        $data = $this->diagnostic_model->fetchTableData($selectTableData, 'qyura_quotationDetailTests', $where);

        $diagonasticTest = '';

        foreach ($data as $key => $val) {
            $diagonasticTest .='<tr id=trload_' . $val->quotationDetailTests_id . ' onclick = fetchInstruction(' . $val->quotationDetailTests_id . ')> <td><div id=testName_' . $val->quotationDetailTests_id . '>' . $val->quotationDetailTests_testName . '</div><input class=form-control type=text style="display:none" value="' . $val->quotationDetailTests_testName . '" name=quotationDetailTests_testName_' . $val->quotationDetailTests_id . ' id=quotationDetailTests_testName_' . $val->quotationDetailTests_id . ' /></td><td><div id=testPrize_' . $val->quotationDetailTests_id . '> <i class="fa fa-inr"></i> <a data-title="Enter username" data-pk="1" data-type="text" id="username" href="#" class="editable editable-click editable-open" data-original-title="Edit Price" title="" aria-describedby="popover939766">' . round($val->quotationDetailTests_price) . '</a></div>';
            $diagonasticTest .= '<input class=form-control style="display:none" type=text value="' . round($val->quotationDetailTests_price) . '" name=quotationDetailTests_price_' . $val->quotationDetailTests_id . ' id=quotationDetailTests_price_' . $val->quotationDetailTests_id . ' /></td><td><a id=testEdit_' . $val->quotationDetailTests_id . ' class="btn btn-success waves-effect waves-light m-b-5 " onClick="editFormTestPrize(' . $val->quotationDetailTests_id . ')">Edit</a><a style="display:none" id=testUpdate_' . $val->quotationDetailTests_id . ' class="btn btn-info waves-effect waves-light m-b-5 " onClick="FormTestPrizeSubmit(' . $val->quotationDetailTests_id . ')">Update</a></td></tr>';
        }
        echo $diagonasticTest;
        exit;
    }

    /**
     * @project Qyura
     * @method detailDiagnosticInstruction
     * @description view quotation prize data
     * @access public
     * @return array
     */
    function detailDiagnosticInstruction() {
        $quotationDetailTests_id = $this->input->post('quotationDetailTests_id');
        $selectTableData = array(
            'quotationDetailTests_instruction'
        );
        $where = array(
            'quotationDetailTests_id' => $quotationDetailTests_id,
            'quotationDetailTests_deleted' => 0
        );
        $data = $this->diagnostic_model->fetchTableData($selectTableData, 'qyura_quotationDetailTests', $where);
        $diagonasticTest = $data[0]->quotationDetailTests_instruction;
        echo $diagonasticTest;
        exit;
    }

    /**
     * @project Qyura
     * @method diagnosticAddTimeSlot
     * @description add timeslot
     * @access public
     * @return array
     */
    function diagnosticAddTimeSlot($diagnosticId) {

        $this->bf_form_validation->set_rules('morningStartTime', 'Morning Start Time', 'required|trim');
        $this->bf_form_validation->set_rules('morningEndTime', 'Morning End Time', 'required|trim');

        $this->bf_form_validation->set_rules('afternoonStartTime', 'Afternoon End Time', 'required|trim');
        $this->bf_form_validation->set_rules('afternoonEndTime', 'Afternoon End Time', 'required|trim');

        $this->bf_form_validation->set_rules('eveningStartTime', 'Evening End Time', 'required|trim');
        $this->bf_form_validation->set_rules('eveningEndTime', 'Evening End Time', 'required|trim');

//        $this->bf_form_validation->set_rules('nightStartTime', 'Night End Time', 'required|trim');
//        $this->bf_form_validation->set_rules('nightEndTime', 'Night End Time', 'required|trim');

        if ($this->bf_form_validation->run() === FALSE) {
            $data = array();
            $data['diagnosticData'] = $this->diagnostic_model->fetchdiagnosticData($diagnosticId);
            $data['diagnosticId'] = $diagnosticId;
            $data['showTimeSlot'] = 'active';
            $data['showTimeSlotBox'] = 'active';
            $this->load->super_admin_template('diagnosticDetail', $data, 'diagnosticScript');
        } else {

            $morningSession = $this->input->post('morningSession');
            $afternoonSession = $this->input->post('afternoonSession');
            $eveningSession = $this->input->post('eveningSession');
            $nightSession = $this->input->post('nightSession');

            if ($_POST['morningStartTime'] && $_POST['morningEndTime'] && $_POST['diagnosticId']) {
                $insertData = array(
                    'diagnosticCenterTimeSlot_diagnosticId' => $this->input->post('diagnosticId'),
                    'diagnosticCenterTimeSlot_startTime' => date('H:i:s', strtotime($this->input->post('morningStartTime'))),
                    'diagnosticCenterTimeSlot_endTime' => date('H:i:s', strtotime($this->input->post('morningEndTime'))),
                    'diagnosticCenterTimeSlot_sessionType' => $morningSession,
                    'diagnosticCenterTimeSlot_deleted' => 0,
                    'creationTime' => strtotime(date("Y-m-d H:i:s")),
                    'status' => 1
                );
                $option = array(
                    'table' => 'qyura_diagnosticCenterTimeSlot',
                    'data' => $insertData
                );
                $this->diagnostic_model->customInsert($option);
            }

            if ($_POST['afternoonStartTime'] && $_POST['afternoonEndTime'] && $_POST['diagnosticId']) {
                $insertData = array(
                    'diagnosticCenterTimeSlot_diagnosticId' => $this->input->post('diagnosticId'),
                    'diagnosticCenterTimeSlot_startTime' => date('H:i:s', strtotime($this->input->post('afternoonStartTime'))),
                    'diagnosticCenterTimeSlot_endTime' => date('H:i:s', strtotime($this->input->post('afternoonEndTime'))),
                    'diagnosticCenterTimeSlot_sessionType' => $afternoonSession,
                    'diagnosticCenterTimeSlot_deleted' => 0,
                    'creationTime' => strtotime(date("Y-m-d H:i:s")),
                    'status' => 1
                );
                $option = array(
                    'table' => 'qyura_diagnosticCenterTimeSlot',
                    'data' => $insertData
                );
                $this->diagnostic_model->customInsert($option);
            }

            if ($_POST['eveningStartTime'] && $_POST['eveningEndTime'] && $_POST['diagnosticId']) {
                $insertData = array(
                    'diagnosticCenterTimeSlot_diagnosticId' => $this->input->post('diagnosticId'),
                    'diagnosticCenterTimeSlot_startTime' => date('H:i:s', strtotime($this->input->post('eveningStartTime'))),
                    'diagnosticCenterTimeSlot_endTime' => date('H:i:s', strtotime($this->input->post('eveningEndTime'))),
                    'diagnosticCenterTimeSlot_sessionType' => $eveningSession,
                    'diagnosticCenterTimeSlot_deleted' => 0,
                    'creationTime' => strtotime(date("Y-m-d H:i:s")),
                    'status' => 1
                );
                $option = array(
                    'table' => 'qyura_diagnosticCenterTimeSlot',
                    'data' => $insertData
                );
                $this->diagnostic_model->customInsert($option);
            }

          /*  if ($_POST['nightStartTime'] && $_POST['nightEndTime'] && $_POST['diagnosticId']) {
                $insertData = array(
                    'diagnosticCenterTimeSlot_diagnosticId' => $this->input->post('diagnosticId'),
                    'diagnosticCenterTimeSlot_startTime' => date('H:i:s', strtotime($this->input->post('nightStartTime'))),
                    'diagnosticCenterTimeSlot_endTime' => date('H:i:s', strtotime($this->input->post('nightEndTime'))),
                    'diagnosticCenterTimeSlot_sessionType' => $nightSession,
                    'diagnosticCenterTimeSlot_deleted' => 0,
                    'creationTime' => strtotime(date("Y-m-d H:i:s")),
                    'status' => 1
                );
                $option = array(
                    'table' => 'qyura_diagnosticCenterTimeSlot',
                    'data' => $insertData
                );
                $this->diagnostic_model->customInsert($option);
            }*/
            $this->session->set_flashdata('message', 'Your Time Slot has been successfully update!');
            redirect("diagnostic/detailDiagnostic/$diagnosticId/timeslot");
        }
    }

    function UpdateDiagnosticTimeSlot($diagnosticId) {

        $this->bf_form_validation->set_rules('morningStartTime', 'Morning Start Time', 'required|trim');
        $this->bf_form_validation->set_rules('morningEndTime', 'Morning End Time', 'required|trim');

        $this->bf_form_validation->set_rules('afternoonStartTime', 'Afternoon End Time', 'required|trim');
        $this->bf_form_validation->set_rules('afternoonEndTime', 'Afternoon End Time', 'required|trim');

        $this->bf_form_validation->set_rules('eveningStartTime', 'Evening End Time', 'required|trim');
        $this->bf_form_validation->set_rules('eveningEndTime', 'Evening End Time', 'required|trim');

//        $this->bf_form_validation->set_rules('nightStartTime', 'Night End Time', 'required|trim');
//        $this->bf_form_validation->set_rules('nightEndTime', 'Night End Time', 'required|trim');

        if ($this->bf_form_validation->run() === FALSE) {
            $data = array();
            $data['diagnosticData'] = $this->diagnostic_model->fetchdiagnosticData($diagnosticId);
            $data['diagnosticId'] = $diagnosticId;
            $data['showTimeSlot'] = 'active';
            $data['showTimeSlotBox'] = 'active';
            $this->load->super_admin_template('diagnosticDetail', $data, 'diagnosticScript');
        } else {


            $morningSession = $this->input->post('morningSession');
            $afternoonSession = $this->input->post('afternoonSession');
            $eveningSession = $this->input->post('eveningSession');
            $nightSession = $this->input->post('nightSession');

            if ($_POST['morningStartTime'] && $_POST['morningEndTime'] && $_POST['diagnosticId']) {
                $insertData = array(
                    'diagnosticCenterTimeSlot_startTime' => date('H:i:s', strtotime($this->input->post('morningStartTime'))),
                    'diagnosticCenterTimeSlot_endTime' => date('H:i:s', strtotime($this->input->post('morningEndTime')))
                );
                $option = array(
                    'table' => 'qyura_diagnosticCenterTimeSlot',
                    'data' => $insertData,
                    'where' => array(
                        'diagnosticCenterTimeSlot_sessionType' => $morningSession,
                        'diagnosticCenterTimeSlot_diagnosticId' => $this->input->post('diagnosticId')
                    )
                );
                $this->diagnostic_model->customUpdate($option);
            }

            if ($_POST['afternoonStartTime'] && $_POST['afternoonEndTime'] && $_POST['diagnosticId']) {
                $insertData = array(
                    'diagnosticCenterTimeSlot_startTime' => date('H:i:s', strtotime($this->input->post('afternoonStartTime'))),
                    'diagnosticCenterTimeSlot_endTime' => date('H:i:s', strtotime($this->input->post('afternoonEndTime'))),
                );
                $option = array(
                    'table' => 'qyura_diagnosticCenterTimeSlot',
                    'data' => $insertData,
                    'where' => array(
                        'diagnosticCenterTimeSlot_sessionType' => $afternoonSession,
                        'diagnosticCenterTimeSlot_diagnosticId' => $this->input->post('diagnosticId')
                    )
                );
                $this->diagnostic_model->customUpdate($option);
            }

            if ($_POST['eveningStartTime'] && $_POST['eveningEndTime'] && $_POST['diagnosticId']) {
                $insertData = array(
                    'diagnosticCenterTimeSlot_startTime' => date('H:i:s', strtotime($this->input->post('eveningStartTime'))),
                    'diagnosticCenterTimeSlot_endTime' => date('H:i:s', strtotime($this->input->post('eveningEndTime')))
                );
                $option = array(
                    'table' => 'qyura_diagnosticCenterTimeSlot',
                    'data' => $insertData,
                    'where' => array(
                        'diagnosticCenterTimeSlot_sessionType' => $eveningSession,
                        'diagnosticCenterTimeSlot_diagnosticId' => $this->input->post('diagnosticId')
                    )
                );
                $this->diagnostic_model->customUpdate($option);
            }

           /* if ($_POST['nightStartTime'] && $_POST['nightEndTime'] && $_POST['diagnosticId']) {
                $insertData = array(
                    'diagnosticCenterTimeSlot_startTime' => date('H:i:s', strtotime($this->input->post('nightStartTime'))),
                    'diagnosticCenterTimeSlot_endTime' => date('H:i:s', strtotime($this->input->post('nightEndTime')))
                );
                $option = array(
                    'table' => 'qyura_diagnosticCenterTimeSlot',
                    'data' => $insertData,
                    'where' => array(
                        'diagnosticCenterTimeSlot_sessionType' => $nightSession,
                        'diagnosticCenterTimeSlot_diagnosticId' => $this->input->post('diagnosticId')
                    )
                );
                $this->diagnostic_model->customUpdate($option);
            }*/
            $this->session->set_flashdata('message', 'Your Time Slot has been successfully update!');
            redirect("diagnostic/detailDiagnostic/$diagnosticId/timeslot");
        }
    }

    /**
     * @project Qyura
     * @method editDiagnosticQuotationDetailTests
     * @description edit Diagnostic Quotation Detail Tests 
     * @access public
     * @return array
     */
    function editDiagnosticQuotationDetailTests() {
        $diagnosticId = $this->input->post('diagnosticId');
        $this->bf_form_validation->set_rules('quotationDetailTests_id', 'Test id', 'required|numeric|trim');
        $this->bf_form_validation->set_rules('quotationDetailTests_testName', 'quotation test name', 'required|trim');
        $this->bf_form_validation->set_rules('quotationDetailTests_price', 'quotation test prize', 'required|trim');
        $message = "";
        $status = 0;
        if ($this->bf_form_validation->run() === FALSE) {

            $status = 0;
        } else {
            $insertData = array(
                'quotationDetailTests_testName' => $this->input->post('quotationDetailTests_testName'),
                'quotationDetailTests_price' => $this->input->post('quotationDetailTests_price'),
                'modifyTime' => strtotime(date("Y-m-d H:i:s")),
            );
            $where = array(
                'quotationDetailTests_MIprofileId' => $diagnosticId,
                'quotationDetailTests_id' => $this->input->post('quotationDetailTests_id')
            );
            $option = array(
                'table' => 'qyura_quotationDetailTests',
                'data' => $insertData,
                'where' => $where
            );
            $response = $this->diagnostic_model->customUpdate($option);
            if ($response) {
                $status = 1;
            } else {
                $status = 0;
            }
        }
        echo $status;
    }

    /**
     * @project Qyura
     * @method getTestPrizeReload
     * @description get Diagnostic Quotation Detail Tests
     * @access public
     * @return array
     */
    function getTestPrizeReload($quotationDetailTests_id) {
        $selectTableData = array(
            'quotationDetailTests_testName', 'quotationDetailTests_price', 'quotationDetailTests_id'
        );
        $where = array(
            'quotationDetailTests_id' => $quotationDetailTests_id,
            'quotationDetailTests_deleted' => 0
        );
        $data = $this->diagnostic_model->fetchTableData($selectTableData, 'qyura_quotationDetailTests', $where);


        $diagonasticTest = '';

        foreach ($data as $key => $val) {
            $diagonasticTest .=' <td><div id=testName_' . $val->quotationDetailTests_id . '>' . $val->quotationDetailTests_testName . '</div><input class=form-control type=text style="display:none" value="' . $val->quotationDetailTests_testName . '" name=quotationDetailTests_testName_' . $val->quotationDetailTests_id . ' id=quotationDetailTests_testName_' . $val->quotationDetailTests_id . ' /></td><td><div id=testPrize_' . $val->quotationDetailTests_id . '> <i class="fa fa-inr"></i> <a data-title="Enter username" data-pk="1" data-type="text" id="username" href="#" class="editable editable-click editable-open" data-original-title="Edit Price" title="" aria-describedby="popover939766">' . round($val->quotationDetailTests_price) . '</a></div>';
            $diagonasticTest .= '<input class=form-control style="display:none" type=text value="' . round($val->quotationDetailTests_price) . '" name=quotationDetailTests_price_' . $val->quotationDetailTests_id . ' id=quotationDetailTests_price_' . $val->quotationDetailTests_id . ' /></td><td><a id=testEdit_' . $val->quotationDetailTests_id . ' class="btn btn-success waves-effect waves-light m-b-5 " onClick="editFormTestPrize(' . $val->quotationDetailTests_id . ')">Edit</a><a style="display:none" id=testUpdate_' . $val->quotationDetailTests_id . ' class="btn btn-info waves-effect waves-light m-b-5 " onClick="FormTestPrizeSubmit(' . $val->quotationDetailTests_id . ')">Update</a></td>';
        }
        echo $diagonasticTest;
        exit;
    }

    /**
     * @project Qyura
     * @method editDiagnosticQuatitationInstruction
     * @description edit Diagnostic Quotation Detail instruction
     * @access public
     * @return array
     */
    function editDiagnosticQuatitationInstruction() {
        $insertData = array(
            'quotationDetailTests_instruction' => $this->input->post('quotationDetailTests_Ins'),
            'modifyTime' => strtotime(date("Y-m-d H:i:s"))
        );
        $where = array(
            'quotationDetailTests_id' => $this->input->post('quotationDetailTests_id')
        );
        $option = array(
            'table' => 'qyura_quotationDetailTests',
            'data' => $insertData,
            'where' => $where
        );
        $response = $this->diagnostic_model->customUpdate($option);
        if ($response) {
            echo "successfully update";
        } else {
            echo"failed to update";
        }
    }

    /**
     * @project Qyura
     * @method getTestInstructionReload
     * @description get Diagnostic Quotation Detail instruction
     * @access public
     * @return array
     */
    function getTestInstructionReload($quotationDetailTests_id) {
        $selectTableData = array(
            'quotationDetailTests_testName', 'quotationDetailTests_instruction', 'quotationDetailTests_id'
        );
        $where = array(
            'quotationDetailTests_id' => $quotationDetailTests_id,
            'quotationDetailTests_deleted' => 0
        );
        $data = $this->diagnostic_model->fetchTableData($selectTableData, 'qyura_quotationDetailTests', $where);
        echo $data[0]->quotationDetailTests_instruction;
    }

    function updatePassword() {


       // $users_email = $this->input->post('users_email');
        $user_tables_id = $this->input->post('user_table_id');
        $users_password = $this->input->post('users_password');

        $users_mobile = $this->input->post('users_mobile');
      //  $diagnostic_mbrTyp = $this->input->post('diagnostic_mbrTyp');


        $where = array(
            'users_id' => $user_tables_id
        );
        $userTableData = array(
            'users_mobile' => $users_mobile,
            'modifyTime' => strtotime(date("Y-m-d H:i:s"))
        );
        $returnNumber = $this->diagnostic_model->UpdateTableData($userTableData, $where, 'qyura_users');
        if (!empty($users_password)) {
            $encrypted = md5($users_password);
            $update = array(
                'users_password' => $encrypted,
                'modifyTime' => strtotime(date("Y-m-d H:i:s"))
            );


            $returnPassword = $this->diagnostic_model->UpdateTableData($update, $where, 'qyura_users'); 
        }
        if($returnNumber OR $returnPassword)
             echo true; 

    }

    function uploadImages($imageName, $folderName, $newName) {
        $path = realpath(FCPATH . 'assets/' . $folderName . '/');
        $config['upload_path'] = $path;
        //echo $config['upload_path']; 
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '1024';
        $config['max_width'] = '1024';
        $config['max_height'] = '540';
        $config['file_name'] = $newName;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($imageName)) {

            $data ['error'] = $this->upload->display_errors();
            $data ['status'] = 0;
            return $data;
        } else {
            $data['imageData'] = $this->upload->data();
            $data ['status'] = 1;
            return $data;
        }
    }

    function diagnosticBackgroundUpload($diagnosticId) {

        if (isset($_FILES["file"]["name"])) {

            $temp = explode(".", $_FILES['file']["name"]);
            $microtime = round(microtime(true));
            $imageName = "diagnostic";
            $newfilename = "" . $imageName . "_" . $microtime . '.' . end($temp);
            $uploadData = $this->uploadImages('file', 'diagnosticsImage', $newfilename);
            if ($uploadData['status']) {
                $imageName = $uploadData['imageData']['file_name'];

                $option = array(
                    'table' => 'qyura_diagnostic',
                    'data' => array('diagnostic_background_img' => $imageName),
                    'where' => array('diagnostic_id' => $diagnosticId)
                );
                $response = $this->diagnostic_model->customUpdate($option);
                if ($response) {
                    $result = array('status' => 200, 'messsage' => "successfully update image");
                    echo json_encode($result);
                }
            } else {
                $result = array('status' => 400, 'messsage' => $uploadData['error']);
                echo json_encode($result);
            }
        }
    }

    function getBackgroundImage($diagnosticId) {
        $option = array(
            'table' => 'qyura_diagnostic',
            'select' => 'diagnostic_background_img',
            'where' => array('diagnostic_id' => $diagnosticId)
        );
        $response = $this->diagnostic_model->customGet($option);
        if ($response) {
          echo  $image = base_url().'assets/diagnosticsImage/'.$response[0]->diagnostic_background_img;
        

        }
    }
    
      function createCSV(){
        $stateId ='';
        $cityId ='';
        $search='';
       if(isset($_POST['diagnostic_stateId']))
        $stateId = $this->input->post('diagnostic_stateId');
       if(isset($_POST['diagnostic_cityId']))
        $cityId = $this->input->post('diagnostic_cityId');
       
        if(isset($_POST['search']))
        $search = $this->input->post('search');
       
        $where=array('diagnostic_deleted'=> 0,'diagnostic_cityId'=> $cityId,'diagnostic_stateId'=>$stateId);
        $array[]= array('Diagnostic Name','City','Phone Number','Address');
        $data = $this->diagnostic_model->createCSVdata($where,$search);
        $arrayFinal = array_merge($array,$data);
        array_to_csv($arrayFinal,'DiagnosticDetail.csv');
        return True;
        exit;
    }
    
    function map($id){
        $option = array(
            'table' => 'qyura_diagnostic',
            'select' => 'diagnostic_lat,diagnostic_long,diagnostic_address,diagnostic_name,diagnostic_img',
            'where' => array('diagnostic_id' => $id)
        );
        $data['mapData'] = $this->common_model->customGet($option);
        $data['title'] = 'Diagnostic Map';
        $this->load->super_admin_template('map', $data, 'diagnosticScript');
    }
    
        function check_email_exits() {
        $user_table_id = '';
        $users_email = $this->input->post('users_email');
        $digoId = $this->input->post("digoId");
        
        $option = array(
            'table' => 'qyura_users',
            'select' => '*',
            'join' => array(
                array('qyura_usersRoles', 'qyura_usersRoles.usersRoles_userId = qyura_users.users_id', 'left'),
            ),
            'where' => array('qyura_users.users_deleted' => 0,'qyura_usersRoles.usersRoles_deleted' => 0, 'qyura_users.users_email' => $users_email, 'qyura_usersRoles.usersRoles_roleId' => 4),
            'single' => FALSE
        );
        $email = $this->common_model->customGet($option);
        if ($email != NULL){
            $option = array(
                'table' => 'qyura_usersRoles',
                'select' => '*',
                'where' => array('qyura_usersRoles.usersRoles_deleted' => 0, 'qyura_usersRoles.usersRoles_userId' => $email[0]->users_id, 'qyura_usersRoles.usersRoles_roleId' => 4, 'qyura_usersRoles.usersRoles_parentId' => $digoId, 'qyura_usersRoles.usersRoles_parentRole' => 3),
                'single' => FALSE
            );
            $userRoles = $this->common_model->customGet($option);
            //echo $this->db->last_query();exit;
            if ($userRoles == NULL) {
                echo $data = $email[0]->users_id;
            }else{
                echo $data = "already";
            }

        } else {
            echo $data;
        }
        exit;
    }
    
    function addDigoDoc() {
        
        $this->bf_form_validation->set_rules("docId", "Doctor Id", 'required|xss_clean');
        $this->bf_form_validation->set_rules("digoId", "Diagnostic Id", 'required|xss_clean');

        if ($this->bf_form_validation->run($this) == FALSE) {
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => ajax_validation_errors());
            echo json_encode($responce);
        } else {
            $digoAjaxId = $this->input->post('ajaxDigoId');
            $digoId = $this->input->post('digoId');
            $records_array = array(
                'usersRoles_userId' => $this->input->post('docId'),
                'usersRoles_roleId' => 4,
                'usersRoles_parentId' => $this->input->post('digoId'),
                'usersRoles_parentRole' => 3,
                'creationTime' => strtotime(date("d-m-Y H:i:s"))
            );
            $options = array
                (
                'data' => $records_array,
                'table' => 'qyura_usersRoles'
            );
            $add_insert_new = $this->common_model->customInsert($options);
            if ($add_insert_new) {

                $responce = array('status' => 1, 'msg' => "Doctor Added successfully", 'url' => "diagnostic/detailDiagnostic/$digoAjaxId");
            } else {
                $error = array("TopError" => "<strong>Something went wrong while updating your data... sorry.</strong>");
                $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $error);
            }
            echo json_encode($responce);
        }
    }
    
    
    // by hemant
    
    
    function getDiagnosticdetail(){
        $diagnoId = $this->input->post('diagnoId');
        if($diagnoId != ''){
            $response = $this->diagnostic_model->getDiagnosticdetail($diagnoId);
        }
    }
    
    
    function setSpecialityNameFormate(){
        $diagnoId = $this->input->post('diagnoId');
        $specialityFormate = $this->input->post('specialityFormate');
        
        if($diagnoId != ''){
            $option = array(
                'table' => 'qyura_diagnostic',
                'where' => array('diagnostic_id' => $diagnoId),
                'data' => array('diagnostic_specialityNameFormate' => $specialityFormate)
            );
           echo $response = $this->diagnostic_model->customUpdate($option);
        }
    }
    
    
     function checkSpeciality() {
        $diagnosticId = $this->input->post('diagnosticId');
        $diagnoUserId = $this->input->post('diagnoUserId');
       // $allValuers = explode(',',$this->input->post('allValuers'));
        
        $sql = 'select diagnosticSpecialities_id from qyura_diagnosticSpecialities where diagnosticSpecialities_diagnosticId = '.$diagnosticId.' AND diagnosticSpecialities_deleted = 0 ';
        
        $numRows = $this->common_model->customQueryCount($sql);
        
       $benifitSpeciality = "select miMembership_quantity from qyura_miMembership where miMembership_miId = $diagnoUserId AND miMembership_deleted = 0 AND miMembership_facilitiesId = 1 AND miMembership_type = 10";
        $benifitSpecialityResult = $this->common_model->customQuery($benifitSpeciality, true);
        
       // echo $this->db->last_query(); exit;
        if($numRows >= $benifitSpecialityResult->miMembership_quantity){
             echo 0; exit;
        }else{
            echo 1; exit;
        }
    }
    
    
    
    function saveDoctor() {
       // print_r($_POST);exit;
       
        $this->bf_form_validation->set_rules('doctors_fName', 'Doctors First Name', 'required|trim');
        $this->bf_form_validation->set_rules('doctors_lName', 'Doctors Last Name', 'required|trim');
       
        
        $this->bf_form_validation->set_rules('doctors_phn', 'Doctor Mobile', 'trim|numeric');
        $this->bf_form_validation->set_rules('users_email', 'Users Email', "valid_email|trim");//||MUnique[{$Moption}]
        
        $this->bf_form_validation->set_rules('show_exp', 'Show experience ', 'trim|numeric');
        
        $this->bf_form_validation->set_rules('fee', 'Fee', 'trim|numeric|required');
        
        $this->bf_form_validation->set_rules('doctorSpecialities_specialitiesId[]', 'Speciality', 'trim|numeric|required');
       
         $this->bf_form_validation->set_rules('doctorAcademic_degreeId[]', 'Degree', 'trim|numeric|required');
         
         $this->bf_form_validation->set_rules('doctorSpecialities_specialitiesCatId[]', 'Speciality', 'trim|numeric|required');
         
         $this->bf_form_validation->set_rules('acdemic_addaddress[]', 'Address', 'trim|required');
         
         $this->bf_form_validation->set_rules('acdemic_addyear[]', 'Year', 'trim|numeric|required');
         
         
       // if (empty($_FILES['avatar_file']['name'])) {
       //     $this->bf_form_validation->set_rules('avatar_file', 'File', 'required');
        // }
        if ($this->bf_form_validation->run($this) === false) {
            
            $data = array();
            $data['allStates'] = $this->Doctor_model->fetchStates();
            $data['speciality'] = $this->Doctor_model->fetchSpeciality();
            $data['degree'] = $this->Doctor_model->fetchDegree();
            
            $this->session->set_flashdata('valid_upload', $this->error_message);
            $data['doctorId'] = 0;
            $data['title'] = 'Diagnostic Detail';
            $data['active'] = 'doctor';
            
            $pRoleId = $this->input->post('pRoleId');
           // dump(validation_errors());
            $this->detailDiagnostic($pRoleId, 'doctor', 'adddoctor');
            //redirect('hospital/'.$pRoleId.'/doctor');
          //  $this->load->super_admin_template('hospitalDetail', $data, 'hospitalScript');
            return false;
        } else {
           
            $imagesname = '';
            if ($_FILES['doctor_photo']['name']) {
                $path = realpath(FCPATH . 'assets/doctorsImages/');
                $upload_data = $this->input->post('avatar_data_doctor');
                $upload_data = json_decode($upload_data);
                
                $original_imagesname = $this->uploadImageWithThumb($upload_data, 'doctor_photo', $path, 'assets/doctorsImages/', './assets/doctorsImages/thumb/', 'doctor');
                
             //   dump($original_imagesname); exit;

                if (empty($original_imagesname)) {
                        $data = array();
                        $data['allStates'] = $this->Doctor_model->fetchStates();
                        $data['speciality'] = $this->Doctor_model->fetchSpeciality();
                        $data['degree'] = $this->Doctor_model->fetchDegree();
                        
                        $this->session->set_flashdata('valid_upload', $this->error_message);
                        $data['doctorId'] = 0;
                        $data['title'] = 'Diagnostic Detail';
                        $data['active'] = 'doctor';

                        $pRoleId = $this->input->post('pRoleId');
                       // dump(validation_errors());
                        $this->detailDiagnostic($pRoleId, 'doctor', 'adddoctor');
                        //redirect('hospital/'.$pRoleId.'/doctor');
                      //  $this->load->super_admin_template('hospitalDetail', $data, 'hospitalScript');
                        return false;
                } else {
                    $imagesname = $original_imagesname;
                }
            }
            
           
            
            $doctors_fName = $this->input->post('doctors_fName');
            $doctors_lName = $this->input->post('doctors_lName');
            $doctors_phn = $this->input->post('doctors_phn');
            $users_email = $this->input->post('users_email');
            $miUserId = $this->input->post('diagnoUserIdDoctor');
            $pRoleId = $this->input->post('pRoleId');
            $fee = $this->input->post('fee');

          
          
            $show_exp = $this->input->post('show_exp');
            $exp_year = $this->input->post('exp_year');
            
            $date = date('Y-m-d');
            $newdate = strtotime ( "-$exp_year year" , strtotime ( $date ) ) ;
            $exp_year = $newdate;
            
          
            
            $doctorsinserData = array(
                'doctors_fName' => $doctors_fName,
                'doctors_lName' => $doctors_lName,
                'doctors_phon' => $doctors_phn,
                'doctors_email' => $users_email,
                'doctors_unqId' => 'DOC' . round(microtime(true)),
                'doctors_img' => $imagesname,
                'creationTime' => strtotime(date('Y-m-d')),
                
                
                'doctors_showExp' => $show_exp,
                'doctors_expYear' => $exp_year,
           
                'doctors_joiningDate' => strtotime(date('Y-m-d')),
                
                'doctors_roll' => 9,
                'doctors_parentId' => $miUserId,
                
                'doctors_consultaionFee' => $fee,
                
                'status' => 0,
                
            );
            
             if(!$users_email){
                $this->sendEmailRegister($this->input->post($users_email));
            }
            
            $doctorsProfileId = $this->Doctor_model->insertDoctorData($doctorsinserData, 'qyura_doctors');
            
          //  dump($this->db->last_query()); exit;
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
         
            $this->session->set_flashdata('message', 'Data inserted successfully !');
            
            redirect('diagnostic/detailDiagnostic/'.$pRoleId.'/doctor');
        }
    }
    
    
    function check_email_doctor() { 
        
        $data = 0;
        $user_table_id = '';
        $users_email = $this->input->post('users_email');
        $diagnosticUserId = $this->input->post('diagnoUserIdDoctor');
        
        $option = array(
              'table' => 'qyura_doctors',
              'select' => 'doctors_id',
              'where' => 'doctors_email = "'.$users_email.'" AND  doctors_parentId = '.$diagnosticUserId.' AND  doctors_roll = 9 AND doctors_deleted = 0',  
            );
        
        
        $email = $this->common_model->customGet($option);
       // echo $this->db->last_query();   
       // echo 1; exit;
      // print_r($email); exit;
        if (empty($email)){
           
           echo 1;
           
        } else {
            echo $data;
        }
        exit;
    }
    
    
        /**
     * @project Qyura
     * @method addDiagnosticCenters
     * @description add centers
     * @access public
     * @return array
     */
    function addDiagnosticCenterDetail() {
        $Id = $this->input->post('diagnosticId');
        
        $centerName = $this->input->post('centerName');
        $centerAddress = $this->input->post('centerAddress');
        $centerLat = $this->input->post('centerLat');
        $centerLong = $this->input->post('centerLong');
        
        
        $centerdData = array('collectionCenter_name' => $centerName, 'collectionCenter_address' => $centerAddress, 'collectionCenter_lat' => $centerLat, 'collectionCenter_long' => $centerLong, 'creationTime' => strtotime(date("Y-m-d H:i:s")), 'collectionCenter_diagnoId' => $Id);
        $option = array(
            'table' => 'qyura_diagnoCollectionCenter',
            'data' => $centerdData
        );
        $insert = $this->diagnostic_model->customInsert($option);
        echo $insert;
        exit;
    }
    
    
     function diagnosticCollectonCentrs($diagnosticId) {
        $option = array(
            'table' => 'qyura_diagnoCollectionCenter',
            'where' => array('collectionCenter_diagnoId' => $diagnosticId, 'collectionCenter_deleted' => 0),
        );
        $dataCenters = $this->diagnostic_model->customGet($option);
        $showCenters = '';
        if ($dataCenters) {
            foreach ($dataCenters as $key => $val) {
                $showCenters .='<li>' . $val->collectionCenter_name . ', ' . $val->collectionCenter_address . ', ' . $val->collectionCenter_lat . ', ' . $val->collectionCenter_long . '</li>';
            }
        } else {
            $showCenters = 'Add Collection Center';
        }
        echo $showCenters;
        exit;
    }
    
    
     function detailCollectoCenter($diagnosticId) {
        $option = array(
            'table' => 'qyura_diagnoCollectionCenter',
            'where' => array('collectionCenter_diagnoId' => $diagnosticId, 'collectionCenter_deleted' => 0),
        );
        $dataCenters = $this->diagnostic_model->customGet($option);
        if ($dataCenters) {
            $showTotalCenters = '';
            foreach ($dataCenters as $key => $val) {
                $showTotalCenters .= '     <aside class="row">
                                <div class="col-md-12 ">
                                
                                     <input type="text" class="form-control" name="centerName" id=' . $val->collectionCenter_id . ' value="' . $val->collectionCenter_name . '" placeholder="Cneter Name" />
                                          <label style="display: none;"class="error" id="error-centerName' . $val->collectionCenter_id . '"> Please enter collection center name </label>  
                                              
                                    <aside class="clearfix m-t-20">
                                     <input type="text" class="form-control" placeholder="Address" id=centerAddress'.$val->collectionCenter_id.'  name="centerAddress" value="' . $val->collectionCenter_address . '"/>
                                     <label style="display: none;"class="error" id="error-centerAddress' . $val->collectionCenter_id . '"> Please enter center address</label> 
                                        </aside>  

                                      <aside class="row m-t-10">
                                        <div class="col-sm-6">
                                            <input name="centerLat" class="form-control" required="" type="text"   id=centerLat'.$val->collectionCenter_id.'  value="' . $val->collectionCenter_lat . '" onchange="latChack(this.value)" placeholder="latitude"/>
                                            <label class="error" style="display:none;" id="error-centerLat' . $val->collectionCenter_id . '">Please enter the correct format for latitude</label>

                                        </div>

                                        <div class="col-sm-6 m-t-xs-10">
                                            <input name="centerLong" class="form-control" required="" type="text"  id=centerLong'.$val->collectionCenter_id.' value="' . $val->collectionCenter_long . '" onchange="lngChack(this.value)" placeholder="longitude"/>
                                            <label class="error" style="display:none;" id="error-centerLong' . $val->collectionCenter_id . '"> Please enter the correct format for longitude</label>

                                        </div>
                                    </aside>
                                                                                    
                                </div>
                                
                                <div class="clearfix">
                                    
                                    <div class="col-md-12  col-xs-2 text-right">
            <a class="pointer" onclick="editCenters(' . $val->collectionCenter_id . ')"><i class="fa fa-pencil-square-o fa-2x m-t-5 label-plus" title="Edit Center"></i></a>
                  <a class="pointer" onclick="deleteCenters(' . $val->collectionCenter_id . ')"><i class="fa fa-times fa-2x m-t-5 label-plus" title="Delete Centers"></i></a>
           </div>

          
                                </div>
                             
                            </aside>';
                
            }
        } else {
            $showTotalCenters = 'Add Collection Centers';
        }

        echo $showTotalCenters;
        exit;
        
        
    }
    
    
   function editDiagnosticCenters() {
        $id = $this->input->post('centerId');
        
        $centerName = $this->input->post('centerName');
        $centerAddress = $this->input->post('centerAddress');
        $centerLat = $this->input->post('centerLat');
        $centerLong = $this->input->post('centerLong');
        
        $updatedData = array('collectionCenter_name' => $centerName, 'collectionCenter_address' => $centerAddress, 'collectionCenter_lat' => $centerLat, 'collectionCenter_long' =>  $centerLong, 'modifyTime' => strtotime(date("Y-m-d H:i:s")));
        
        $updatedDataWhere = array('collectionCenter_id' => $id);
        
        $option = array(
            'table' => 'qyura_diagnoCollectionCenter',
            'where' => $updatedDataWhere,
            'data' => $updatedData
        );
        $return = $this->diagnostic_model->customUpdate($option);
        echo $return;
        exit;
    }
    
    
    function deleteCollectionCenters() {
        
        $id = $this->input->post('centerId');
        
        $updatedData = array('collectionCenter_deleted' => 1);
        $updatedDataWhere = array('collectionCenter_id' => $id);

        $option = array(
            'table' => 'qyura_diagnoCollectionCenter',
            'where' => $updatedDataWhere,
            'data' => $updatedData
        );
        $return = $this->diagnostic_model->customUpdate($option);
        echo $return;
        exit;
    }
    
    
    // add insurance
     function addInsurance($diagnosticId) {
         
       if($diagnosticId != '' && $diagnosticId != 0){
           
        $insurances = $this->input->post('insurances');
        
        if (!empty($insurances)) {
            foreach ($insurances as $key => $val) {
                $insurancesData = array(
                    'diagnoInsurance_diagnoId' => $diagnosticId,
                    'diagnoInsurance_insuranceId' => $val,
                    'creationTime' => strtotime(date("Y-m-d H:i:s")),
                );
                // print_r($insurancesData);
                // exit;
                $this->Hospital_model->insertTableData('qyura_diagnoInsurance', $insurancesData);
                //$insurancesData = '';
            }
            $this->session->set_flashdata('message', 'Insurance added successfully !');
            redirect("diagnostic/detailDiagnostic/$diagnosticId/general");
        } else {
            redirect("diagnostic/detailDiagnostic/$diagnosticId/general");
        }
        
      }
    }
    
    
     // method for delete insurance
    function deletInsurance() {
        $insuranceId = $this->input->post('insuranceId');
        $this->diagnostic_model->deletInsurance($insuranceId);
    }

    function editDoctor() {
       
        $doctorAcademic_hidden_id = $this->input->post('doctorAcademic_hidden_id');
        $doctor_hidden_id = $this->input->post('doctor_hidden_id');
        $this->bf_form_validation->set_rules('doctors_fName', 'Doctors First Name', 'required|trim');
        $this->bf_form_validation->set_rules('doctors_lName', 'Doctors Last Name', 'required|trim');
        $this->bf_form_validation->set_rules('doctors_phn', 'Doctor Mobile', 'trim|numeric');
        $this->bf_form_validation->set_rules('users_email', 'Users Email', "valid_email|trim");//||MUnique[{$Moption}]
       
       // if (empty($_FILES['avatar_file']['name'])) {
      //      $this->bf_form_validation->set_rules('avatar_file', 'File', 'required');
     //   }
        if ($this->bf_form_validation->run($this) === false) {
            
            $data = array();
            $data['doctorData'] = $this->Doctor_model->fetchDoctorData($doctor_hidden_id);
            $data['speciality'] = $this->Doctor_model->fetchSpeciality();
            $data['degree'] = $this->Doctor_model->fetchDegree();
            
            $this->session->set_flashdata('valid_upload', $this->error_message);
            $data['doctorId'] = $doctor_hidden_id;
            $data['title'] = 'Diagnostic Detail';
            $data['active'] = 'doctor';
            $pRoleId = $this->input->post('pRoleId');
           // dump(validation_errors());
            $this->detailDiagnostic($pRoleId,'doctor', 'adddoctor');
            //redirect('hospital/'.$pRoleId.'/doctor');
          //  $this->load->super_admin_template('hospitalDetail', $data, 'hospitalScript');
            return false;
        } else {
           
           
            
           
            
            $doctors_fName = $this->input->post('doctors_fName');
            $doctors_lName = $this->input->post('doctors_lName');
            $doctors_phn = $this->input->post('doctors_phn');
            $users_email = $this->input->post('users_email');
            $miUserId = $this->input->post('diagnoUserIdDoctor');
            $pRoleId = $this->input->post('pRoleId');
            $fee = $this->input->post('fee');            
            $show_exp = $this->input->post('show_exp');
            $exp_year = $this->input->post('exp_year');
            
            $date = date('Y-m-d');
            $newdate = strtotime ( "-$exp_year year" , strtotime ( $date ) ) ;
            $exp_year = $newdate;
            $doctorsUpdateData = array(
                'doctors_fName' => $doctors_fName,
                'doctors_lName' => $doctors_lName,
                'doctors_phon' => $doctors_phn,
                'doctors_email' => $users_email,
                'doctors_unqId' => 'DOC' . round(microtime(true)),
                'creationTime' => strtotime(date('Y-m-d')),               
                'doctors_showExp' => $show_exp,
                'doctors_expYear' => $exp_year,
                'doctors_joiningDate' => strtotime(date('Y-m-d')),
                'doctors_roll' => 9,
                'doctors_parentId' => $miUserId,
                'doctors_consultaionFee' => $fee,
                
            );
            if(empty($imagesname) || $imagesname === '' || $imagesname === NULL){
                unset($doctorsUpdateData['doctors_img']);
            }

            $where = array(
                'doctors_id' => $doctor_hidden_id
            );
         
            $doctorsProfileId = $this->Doctor_model->updateDoctorData($doctorsUpdateData,$where, 'qyura_doctors');
            
            //dump($this->db->last_query());
            $specialitiesIds = $this->input->post('doctorSpecialities_specialitiesId');

            $option = array(
                    'table' => 'qyura_doctorSpecialities',
                    'select' => 'doctorSpecialities_specialitiesId',
                    'where' => array('doctorSpecialities_doctorsId' => $doctor_hidden_id)
                );

            $res = $this->common_model->customGet($option);

            $result = $this->updateMultipleIds($specialitiesIds,$res,$doctor_hidden_id,'qyura_doctorSpecialities');

            $doctorAcademic_degreeId = $this->input->post('doctorAcademic_degreeId');
            $doctorSpecialities_specialitiesCatId = $this->input->post('doctorSpecialities_specialitiesCatId');
            $acdemic_addaddress = $this->input->post('acdemic_addaddress');
            $acdemic_addyear = $this->input->post('acdemic_addyear');
            
             if(!empty($doctorAcademic_degreeId) && $doctor_hidden_id != ''){
                $this->db->delete('qyura_doctorAcademic', array('doctorAcademic_doctorsId' => $doctor_hidden_id)); 
            }
            
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
                        'doctorAcademic_doctorsId' => $doctor_hidden_id,
                        'creationTime' => strtotime(date('Y-m-d'))
                    );

                    $this->Doctor_model->insertDoctorData($doctorAcademicData, 'qyura_doctorAcademic');
                    //dump($this->db->last_query());
                    unset($doctorAcademicData);
                }
            }
         
            $this->session->set_flashdata('message', 'Data updated successfully !');
            
            redirect('diagnostic/detailDiagnostic/'.$pRoleId.'/doctor');
        }
    }
    
    
    function find_membership() {
        $membershipId = $this->input->post('member_id');	
        $option = array(
            'table' => 'qyura_membershipFacilities',
            'select' => '*',
            'where' => array('membershipFacilities_deleted' => 0,'qyura_membershipFacilities.status' => 1,'membershipFacilities_membershipId' =>$membershipId )
        );
        $membership_plan = $this->common_model->customGet($option);
        echo json_encode($membership_plan);
    }
    
    
    function membershipEdit() {
        //print_r($_POST);exit;
        $this->bf_form_validation->set_rules("diagnostic_mbrTyp", "Membership Type", 'required|xss_clean');
        $faci_count = $this->input->post('faci_count');
        for($i = 1; $i <= $faci_count; $i++){
            $checkbox = $this->input->post("miFacilitiesId_$i");
            $this->bf_form_validation->set_rules("membership_quantity_$i", "Quantity", 'required|xss_clean');
            if($checkbox == 2 || $checkbox == 4){
                $this->bf_form_validation->set_rules("membership_duration_$i", "Duration", 'required|xss_clean');
            }
        }
        if ($this->bf_form_validation->run() == FALSE) {
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => ajax_validation_errors());
            echo json_encode($responce);
        } else {
            $digo_id = $this->input->post("digo_id");
            $diagnoId = $this->input->post("diagnoId");
            
            $faci_count = $this->input->post('faci_count');
            
            $mem_id = $this->input->post('faci_count');
            $digo_array['diagnostic_mbrTyp'] = $this->input->post('diagnostic_mbrTyp');
            $options = array
            (
                'where' => array('diagnostic_usersId' => $digo_id),
                'data'  => $digo_array,
                'table' => 'qyura_diagnostic'
            );
            $this->common_model->customUpdate($options);
            
            for($i = 1; $i <= $faci_count; $i++){
                
                $miMembership_id = $this->input->post("miMembershipId_$i");
                $miFacilitiesId = $this->input->post("miFacilitiesId_$i");
                $quantity = $this->input->post("membership_quantity_$i");
                $duration = $this->input->post("membership_duration_$i");
                if(isset($miMembership_id) && $miMembership_id != NULL){
                    if($quantity != ''){
                        $records_array['miMembership_quantity'] = $quantity;
                    }
                    if($miFacilitiesId == 2 || $miFacilitiesId == 4){
                        $records_array['miMembership_duration'] = $duration;
                    }else{
                        unset($records_array['miMembership_duration']);
                    }
                    $options = array
                    (
                        'where' => array('miMembership_id' => $miMembership_id),
                        'data'  => $records_array,
                        'table' => 'qyura_miMembership'
                    );
                    $this->common_model->customUpdate($options);
                }else{
                    
                    $records_array['miMembership_type'] = 10;
                    $records_array['miMembership_miId'] = $digo_id;
                    $records_array['miMembership_facilitiesId'] = $miFacilitiesId;
                    
                    if($quantity != ''){
                        $records_array['miMembership_quantity'] = $quantity;
                    }
                    if($miFacilitiesId == 2 || $miFacilitiesId == 4){
                        $records_array['miMembership_duration'] = $duration;
                    }else{
                        unset($records_array['miMembership_duration']);
                    }
                    
                    $options = array
                    (
                        'data'  => $records_array,
                        'table' => 'qyura_miMembership'
                    );
                    $this->common_model->customInsert($options);
                }
                
            }
                
            $responce = array('status' => 1, 'msg' => "Record Update successfully", 'url' => "diagnostic/detailDiagnostic/$diagnoId/membership");
            echo json_encode($responce);
        }
    }
    
    function editUploadImageAmbulance() {
        
        if ($_POST['avatar_file']['name']) {
            $path = realpath(FCPATH . 'assets/ambulanceImages/');
            $upload_data = $this->input->post('avatar-data');
            
            $upload_data = json_decode($upload_data);
           
            if ($upload_data->width > 425) {
                $original_imagesname = $this->uploadImageWithThumb($upload_data, 'avatar_file', $path, 'assets/ambulanceImages/', './assets/ambulanceImages/thumb/', 'ambulance');

                if (empty($original_imagesname)) {
                    $response = array('state' => 400, 'message' => $this->error_message);
                } else {

                    $option = array(
                        'ambulance_img' => $original_imagesname,
                        'modifyTime' => strtotime(date("Y-m-d H:i:s"))
                    );
                    $where = array(
                        'ambulance_id' => $this->input->post('avatar_id')
                    );
                    $response = $this->Hospital_model->UpdateTableData($option, $where, 'qyura_ambulance');
                    
                    if ($response) {
                        $response = array('state' => 200, 'message' => 'Successfully update avtar','image'=>base_url("assets/ambulanceImages/thumb/thumb_100/{$original_imagesname}"),'reset'=>"ambulance_edit", 'returnClass'  => 'logo-img-ambulance');
                    } else {
                        $response = array('state' => 400, 'message' => 'Failed to update avtar');
                    }
                }
            } else {
                $response = array('state' => 400, 'message' => 'Height and Width must exceed 150px.');
            }
            echo json_encode($response);
        } else {
            $response = array('state' => 400, 'message' => 'Please select avtar');
            echo json_encode($response);
        }
    }
    
      function getUpdateAvtarAmbulance($id) {
        if (!empty($id)) {
            $data['hospitalData'] = $this->Hospital_model->fetchHospitalData($id);
            //  print_r($data); exit;
            echo "<img src='" . base_url() . "assets/ambulanceImages/thumb/original/" . $data['hospitalData'][0]->ambulance_img . "'alt='' class='logo-img-ambulance' />";
            exit();
        }
    }
    
    
      function editUploadImageBloodbank() {
        
        if ($_POST['avatar_file']['name']) {
            $path = realpath(FCPATH . 'assets/BloodBank/');
            $upload_data = $this->input->post('avatar-data');
            
            $upload_data = json_decode($upload_data);
           // dump($upload_data); exit;
            if ($upload_data->width > 425) {
                $original_imagesname = $this->uploadImageWithThumb($upload_data, 'avatar_file', $path, 'assets/BloodBank/', './assets/BloodBank/thumb/', 'blood');

                if (empty($original_imagesname)) {
                    $response = array('state' => 400, 'message' => $this->error_message);
                } else {

                    $option = array(
                        'bloodBank_photo' => $original_imagesname,
                        'modifyTime' => strtotime(date("Y-m-d H:i:s"))
                    );
                    $where = array(
                        'bloodBank_id' => $this->input->post('avatar_id')
                    );
                    $response = $this->Hospital_model->UpdateTableData($option, $where, 'qyura_bloodBank');
                    
                    if ($response) {
                        $response = array('state' => 200, 'message' => 'Successfully update avtar','image'=>base_url("assets/BloodBank/thumb/thumb_100/{$original_imagesname}"),'reset'=>"bloodbank_edit", 'returnClass'  => 'logo-img-bloodbank');
                    } else {
                        $response = array('state' => 400, 'message' => 'Failed to update avtar');
                    }
                }
            } else {
                $response = array('state' => 400, 'message' => 'Height and Width must exceed 150px.');
            }
            echo json_encode($response);
        } else {
            $response = array('state' => 400, 'message' => 'Please select avtar');
            echo json_encode($response);
        }
    }
    
     function getUpdateAvtarBloodbank($id) {
        if (!empty($id)) {
            $data['hospitalData'] = $this->Hospital_model->fetchHospitalData($id);
            //  print_r($data); exit;
            echo "<img src='" . base_url() . "assets/BloodBank/thumb/original/" . $data['hospitalData'][0]->bloodBank_photo . "'alt='' class='logo-img-bloodbank' />";
            exit();
        }
    }
    
    
     function editUploadImageDoctor() {
        
        if ($_POST['avatar_file']['name']) {
            $path = realpath(FCPATH . 'assets/doctorsImages/');
            $upload_data = $this->input->post('avatar-data');
            
            $upload_data = json_decode($upload_data);
           // dump($upload_data); exit;
            if ($upload_data->width > 425) {
                $original_imagesname = $this->uploadImageWithThumb($upload_data, 'avatar_file', $path, 'assets/doctorsImages/', './assets/doctorsImages/thumb/', 'doctor');

                if (empty($original_imagesname)) {
                    $response = array('state' => 400, 'message' => $this->error_message);
                } else {

                    $option = array(
                        'doctors_img' => $original_imagesname,
                        'modifyTime' => strtotime(date("Y-m-d H:i:s"))
                    );
                    $where = array(
                        'doctors_id' => $this->input->post('avatar_id')
                    );
                    $response = $this->Hospital_model->UpdateTableData($option, $where, 'qyura_doctors');
                    
                    if ($response) {
                        $response = array('state' => 200, 'message' => 'Successfully update avtar','image'=>base_url("assets/doctorsImages/thumb/thumb_100/{$original_imagesname}"),'reset'=>"doctor_edit", 'returnClass'  => 'logo-img-doctor');
                    } else {
                        $response = array('state' => 400, 'message' => 'Failed to update avtar');
                    }
                }
            } else {
                $response = array('state' => 400, 'message' => 'Height and Width must exceed 150px.');
            }
            echo json_encode($response);
        } else {
            $response = array('state' => 400, 'message' => 'Please select avtar');
            echo json_encode($response);
        }
    }
    
     function getUpdateAvtarDoctor($id) {
        if (!empty($id)) {
            $data['doctorData'] = $this->Hospital_model->getDoctorDeatil($id);
            //  print_r($data); exit;
            echo "<img src='" . base_url() . "assets/doctorsImages/thumb/original/" . $data['doctorData'][0]->doctors_img . "'alt='' class='logo-img-doctor' />";
            exit();
        }
    }
    
    function editDocTimeView() {
        $docTimeTableId = $this->input->post('docTimeTableId');
        $doctorId = $this->input->post('doctorId');
        $docTimeDayId = $this->input->post('docTimeDayId');
        $day = $this->input->post('day');
        $con = array('docTimeTable_id' => $docTimeTableId);
        
        $data['timeData'] = $this->Doctor_model->geTimeTable($con);

        $form = $this->load->view('editTimeSloat', $data, true);
        $responce = array('status' => 1, 'isAlive' => TRUE, 'data' => $form);
        echo json_encode($responce);
    }
    
    function editDocTime() {
        
        $this->bf_form_validation->set_rules('docTimeDay_day[]', 'day', 'required|trim');
        $this->bf_form_validation->set_rules('openingHour', 'open', 'required|trim|callback_checkOpenTime');
        $this->bf_form_validation->set_rules('closeingHour', 'close', 'required|trim|callback_checkCloseTime');
        $this->bf_form_validation->set_rules('fees', 'fees', 'required|trim');
        
        //hidden
        $this->bf_form_validation->set_rules('docTimeTableId', 'docTimeTableId', 'required|trim');
        $this->bf_form_validation->set_rules('MIprofileId', 'MIprofileId', 'required|trim');
        
        if ($this->bf_form_validation->run($this) === FALSE) {
            $errorAr = ajax_validation_errors();
            if (array_key_exists('docTimeDay_day[]', $errorAr)) {
                $er_msg = $errorAr['docTimeDay_day[]'];
                unset($errorAr['docTimeDay_day[]']);
                $errorAr['docTimeDay_day'] = $er_msg;
            }
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $errorAr);
            echo json_encode($responce);
        } elseif ($this->checkEditSloat()) {

            $docTimeTable_stayAt = isset($_POST['docTimeTable_stayAt']) ? $this->input->post('docTimeTable_stayAt') : '1';
            $docTimeTable_MItype = isset($_POST['docTimeTable_MItype']) ? $this->input->post('docTimeTable_MItype') : '2';
            $docTimeTable_MIprofileId = isset($_POST['docTimeTable_MIprofileId']) ? $this->input->post('docTimeTable_MIprofileId') : '';
            $docTimeTable_price = isset($_POST['fees']) ? $this->input->post('fees') : '';
            $docTimeDay_days = isset($_POST['docTimeDay_day']) ? $this->input->post('docTimeDay_day') : '';
            $docTimeDay_open = isset($_POST['openingHour']) ? $this->input->post('openingHour') : '';
            $docTimeDay_close = isset($_POST['closeingHour']) ? $this->input->post('closeingHour') : '';
            $docTimeTableId = isset($_POST['docTimeTableId']) ? $this->input->post('docTimeTableId') : '';
            $MIprofileId = isset($_POST['MIprofileId']) ? $this->input->post('MIprofileId') : '';

            //$this->db->taransaction
            
            $docTimeDay_open = date('H:i:s', strtotime($docTimeDay_open));
            $docTimeDay_close = date('H:i:s', strtotime($docTimeDay_close));
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
                            'docTimeDay_day' => $selectedDay,
                            'docTimeDay_open' => $docTimeDay_open,
                            'docTimeDay_close' => $docTimeDay_close,
                            'docTimeDay_docTimeTableId' => $docTimeTableId
                        )
                    );

                    $id = $this->common_model->customInsert($param);
                    array_push($newAvabilityIds, $id);
                } else {
                    $where = array('docTimeDay_day' => $selectedDay, 'docTimeDay_docTimeTableId' => $docTimeTableId);
                    $records_upg['modifyTime'] = time();
                    $records_upg['docTimeDay_open'] = $docTimeDay_open;
                    $records_upg['docTimeDay_close'] = $docTimeDay_close;

                    $updateOptions = array
                        (
                        'where' => $where,
                        'data' => $records_upg,
                        'table' => 'qyura_docTimeDay'
                    );

                    $id = $this->common_model->customUpdate($updateOptions);
                    $id = true;
                }
            }

            foreach ($days as $day) {
                if (!in_array($day->day, $selectedDays)) {
                    $where = array('docTimeDay_day' => $day->day, 'docTimeDay_docTimeTableId' => $docTimeTableId);
                    $records_upg['docTimeDay_deleted'] = 1;
                    $records_upg['modifyTime'] = time();

                    $updateOptions = array
                        (
                        'where' => $where,
                        'data' => $records_upg,
                        'table' => 'qyura_docTimeDay'
                    );

                    $id = $this->common_model->customUpdate($updateOptions);
                    $id = true;
                } else {
                    $where = array('docTimeDay_day' => $day->day, 'docTimeDay_docTimeTableId' => $docTimeTableId);
                    $records_upg['modifyTime'] = time();
                    $records_upg['docTimeDay_open'] = $docTimeDay_open;
                    $records_upg['docTimeDay_close'] = $docTimeDay_close;

                    $updateOptions = array
                        (
                        'where' => $where,
                        'data' => $records_upg,
                        'table' => 'qyura_docTimeDay'
                    );

                    $id = $this->common_model->customUpdate($updateOptions);
                    $id = true;
                }
            }

            $sql = '';
            foreach ($this->db->queries as $key => $query) {
                $sql = $query . " \n Execution Time:" . $times[$key]; // Generating SQL file alongwith execution time
                //fwrite($handle, $sql . "\n\n");              // Writing it in the log file

                if (count($this->db->queries) == $count)
                    $sql = $sql . " \n \n \n END mahi889@gmail.com >>>>>";

                $count++;
            }
            
            
            $param = array(
                'table' => 'qyura_docTimeTable',
            );
            
            $updateOptions = array
                (
                'where' => array('docTimeTable_id'=>$docTimeTableId),
                'data' => array(
                    'docTimeTable_stayAt' => $docTimeTable_stayAt,
                    'docTimeTable_doctorId' => $this->input->post('doctorId'),
                    'docTimeTable_MItype' => $docTimeTable_MItype,
                    'docTimeTable_price' => $docTimeTable_price,
                    'creationTime' => time()
                ),
                'table' => 'qyura_docTimeTable'
            );

            $id = $this->common_model->customUpdate($updateOptions);

            if ($id) {
                $this->session->set_flashdata('active', 'doctor');
                $responce = array('status' => 1, 'msg' => "Time sloat updated successfully", 'url' => "diagnostic/detailDiagnostic/{$_POST['MIprofileId']}/doctor/{$_POST['doctorId']}/timeSlot");
            } else {
                $error = array("TopError" => "<strong>Something went wrong while updating your data... sorry.</strong>");
                $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $error);
            }
            echo json_encode($responce);
        }
    }
    
        function addDocTime() {

        $this->bf_form_validation->set_rules('doctorId', 'doctor sab', 'required|trim');
        $this->bf_form_validation->set_rules('docTimeTable_stayAt', 'stayAt', 'required|trim');
        $this->bf_form_validation->set_rules('docTimeTable_MItype', 'MItype', 'required|trim');
        $this->bf_form_validation->set_rules('docTimeTable_MIprofileId', 'Hospital Name', 'required|trim');
        $this->bf_form_validation->set_rules('docTimeDay_day[]', 'day', 'required|trim');
        $this->bf_form_validation->set_rules('openingHour', 'open', 'required|trim|callback_checkOpenTime');
        $this->bf_form_validation->set_rules('closeingHour', 'close', 'required|trim|callback_checkCloseTime');
        $this->bf_form_validation->set_rules('fees', 'fees', 'required|trim');


        if ($this->bf_form_validation->run($this) === FALSE) {
            $errorAr = ajax_validation_errors();
            if (array_key_exists('docTimeDay_day[]', $errorAr)) {
                $er_msg = $errorAr['docTimeDay_day[]'];
                unset($errorAr['docTimeDay_day[]']);
                $errorAr['docTimeDay_day'] = $er_msg;
            }
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $errorAr);
            echo json_encode($responce);
        } elseif ($this->checkSloat()) {

            $docTimeTable_stayAt = isset($_POST['docTimeTable_stayAt']) ? $this->input->post('docTimeTable_stayAt') : '';
            $docTimeTable_MItype = isset($_POST['docTimeTable_MItype']) ? $this->input->post('docTimeTable_MItype') : '';
            $MIprofileId = isset($_POST['docTimeTable_MIprofileId']) && $_POST['docTimeTable_MIprofileId'] != '' ? $this->input->post('docTimeTable_MIprofileId') : '';
            $docTimeTable_price = isset($_POST['fees']) ? $this->input->post('fees') : '';
            $docTimeDay_days = isset($_POST['docTimeDay_day']) ? $this->input->post('docTimeDay_day') : '';
            $docTimeDay_open = isset($_POST['openingHour']) ? $this->input->post('openingHour') : '';
            $docTimeDay_close = isset($_POST['closeingHour']) ? $this->input->post('closeingHour') : '';
            $doctorId = isset($_POST['doctorId']) ? $this->input->post('doctorId') : '';
            $docTimeDay_open = date('H:i:s', strtotime($docTimeDay_open));
            $docTimeDay_close = date('H:i:s', strtotime($docTimeDay_close));

            $param = array(
                'table' => 'qyura_docTimeTable',
                'data' => array(
                    'docTimeTable_stayAt' => $docTimeTable_stayAt,
                    'docTimeTable_doctorId' => $this->input->post('doctorId'),
                    'docTimeTable_MItype' => $docTimeTable_MItype,
                    'docTimeTable_MIprofileId' => $MIprofileId,
                    'docTimeTable_price' => $docTimeTable_price,
                    'creationTime' => time()
                )
            );

            $docTimeTableId = $this->common_model->customInsert($param);
            $docTimeDayId = FALSE;

            foreach ($docTimeDay_days as $key => $docTimeDay_day) {

                $param = array(
                    'table' => 'qyura_docTimeDay',
                    'data' => array(
                        'docTimeDay_day' => $docTimeDay_day,
                        'docTimeDay_open' => $docTimeDay_open,
                        'docTimeDay_close' => $docTimeDay_close,
                        'docTimeDay_docTimeTableId' => $docTimeTableId,
                        'creationTime' => time()
                    )
                );

                $docTimeDayId = $this->common_model->customInsert($param);
            }

            if ($docTimeDayId) {
                $this->session->set_flashdata('active', 'doctor');
                $responce = array('status' => 1, 'msg' => "Time sloat added successfully", 'url' => "diagnostic/detailDiagnostic/$MIprofileId/doctor/$doctorId/timeSlot");
            } else {
                $error = array("TopError" => "<strong>Something went wrong while updating your data... sorry.</strong>");
                $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $error);
            }
            echo json_encode($responce);
        } else {
            $er = implode('<br/>', $this->error);
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => array('docTimeDay_day' => $er));
            echo json_encode($responce);
        }
    }
    
    function checkSloat() {
        $docTimeDay_days = isset($_POST['docTimeDay_day']) ? $this->input->post('docTimeDay_day') : '';
        $docTimeDay_open = isset($_POST['openingHour']) ? $this->input->post('openingHour') : '';
        $docTimeDay_close = isset($_POST['closeingHour']) ? $this->input->post('closeingHour') : '';

        $docTimeDay_open = date('H:i:s', strtotime($docTimeDay_open));
        $docTimeDay_close = date('H:i:s', strtotime($docTimeDay_close));
        $this->error = array();
        foreach ($docTimeDay_days as $key => $docTimeDay_day) {
            $data = array(
                'day' => $docTimeDay_day,
                'openTime' => $docTimeDay_open,
                'closeTime' => $docTimeDay_close,
                'doctorId' => $this->input->post('doctorId')
            );

            $row = $this->Doctor_model->checkSloat($data);
            if ($row)
                $this->error[] =  'This time '. date('h:i A', strtotime($docTimeDay_open)) .' to '. date('h:i A', strtotime($docTimeDay_close)).' match with '.convertNumberToDay($docTimeDay_day.' please select diffrent sloat');
        }

        if (count($this->error))
            return false;
        else {
            return true;
        }
    }

    function checkEditSloat() {
        $docTimeDay_days = isset($_POST['docTimeDay_day']) ? $this->input->post('docTimeDay_day') : '';
        $docTimeDay_open = isset($_POST['openingHour']) ? $this->input->post('openingHour') : '';
        $docTimeDay_close = isset($_POST['closeingHour']) ? $this->input->post('closeingHour') : '';
        $docTimeDayId = isset($_POST['docTimeDayId']) ? $this->input->post('docTimeDayId') : '';


        $docTimeDay_open = date('H:i:s', strtotime($docTimeDay_open));
        $docTimeDay_close = date('H:i:s', strtotime($docTimeDay_close));
        $this->error = array();
        foreach ($docTimeDay_days as $key => $docTimeDay_day) {
            $data = array(
                'day' => $docTimeDay_day,
                'openTime' => $docTimeDay_open,
                'closeTime' => $docTimeDay_close,
                'doctorId' => $this->input->post('doctorId'),
                'docTimeDayId' => $docTimeDayId
            );

            $row = $this->Doctor_model->checkSloat($data);
            if ($row)
                $this->error[] =  'This time '. date('h:i A', strtotime($docTimeDay_open)) .' to '. date('h:i A', strtotime($docTimeDay_close)).' match with '.convertNumberToDay($docTimeDay_day.' please select diffrent sloat');
        }

        if (count($this->error))
            return false;
        else {
            return true;
        }
    }

    function checkOpenTime() {
        $openingHour = $this->input->post('openingHour');
        $closeingHour = $this->input->post('closeingHour');
        $openingHour = strtotime($openingHour);
        $closeingHour = strtotime($closeingHour);

        if ($closeingHour < $openingHour) {
            $this->bf_form_validation->set_message('checkOpenTime', 'Opening time should be less than closing time');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function checkCloseTime() {
        $openingHour = $this->input->post('openingHour');
        $closeingHour = $this->input->post('closeingHour');
        $openingHour = strtotime($openingHour);
        $closeingHour = strtotime($closeingHour);

        if ($closeingHour < $openingHour) {
            $this->bf_form_validation->set_message('checkCloseTime', 'Closing time should be greater than opening time');
            return FALSE;
        } else {
            $timeDiff = $closeingHour - $openingHour;
            $diff = 29 * 60;
            if ($timeDiff < $diff) {
                $this->bf_form_validation->set_message('checkCloseTime', 'Time diffrence sould be 30 min');
                return FALSE;
            }

            return TRUE;
        }
    }

}
