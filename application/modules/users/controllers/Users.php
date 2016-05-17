<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {

    public function __construct() {
        parent:: __construct();

        $this->load->model(array('Users_model', 'common_model'));
        $this->load->library('datatables');
        $this->load->helper('common');
    }

    function index() {

        $data = array();
        $data['allStates'] = $this->Users_model->fetchStates();
        $data['city'] = $this->Users_model->fetchusercity();

        $data['title'] = 'Users';
        $this->load->super_admin_template('userList', $data, 'usersScript');
    }

    public function addUsers() {

        $option = array('table' => 'qyura_users', 'select' => 'users_id', 'single' => true, 'order' => array('users_id' => 'desc'));
        $users = $this->common_model->customGet($option);
        $users_id = $users->users_id;
        $users_id = $users_id + 1;
        $data['usersCode'] = "PNT" . $users_id;
        $data['title'] = 'Add Users';
        $data['allStates'] = $this->Users_model->fetchStates();
        $data['insurance_cmpny'] = $this->Users_model->fetchinsurance();
        $data['familyMember'] = $this->Users_model->fetchfamilyMember();
        $this->load->super_admin_template('add_user', $data, 'usersScript');
    }
    
    function _isEmailRegisterCallBack($email = '') {

        if (!empty($email)) {
            $resonse = $this->common_model->fetchEmail($email, 6, '');
            if ($resonse) {
               $this->bf_form_validation->set_message('_isEmailRegisterCallBack', ''.$email.' already exist');
               return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }
    
      function _ismobileRegisterCallBack($mobile = '') {

        if (!empty($mobile)) {
            $resonse = $this->common_model->fetchMobileNo($mobile, 6, '');
            if ($resonse) {
               $this->bf_form_validation->set_message('_ismobileRegisterCallBack', ''.$mobile.' already exist');
               return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    public function saveUsers() {

        // $this->bf_form_validation->set_rules('patientDetails_unqId', 'User Id', 'required|trim');
        $this->bf_form_validation->set_rules('patientDetails_patientName', 'Name', 'required|trim');
        //$this->bf_form_validation->set_rules('avatar_file', 'image', 'required');
        $this->bf_form_validation->set_rules('patientDetails_gender', 'Gender', 'required|trim');
        $this->bf_form_validation->set_rules('patientDetails_dob', 'Date of Birth', 'required|trim');
        $this->bf_form_validation->set_rules('users_email', 'Users Email', "required|valid_email|trim|callback__isEmailRegisterCallBack");
        $this->bf_form_validation->set_rules('patientDetails_mobileNo', 'User Phone', 'required|trim|numeric|callback__ismobileRegisterCallBack');
        $this->bf_form_validation->set_rules('patientDetails_stateId', 'State', 'required|trim');
        $this->bf_form_validation->set_rules('patientDetails_cityId', 'City', 'required|trim');
        $this->bf_form_validation->set_rules('patientDetails_pin', 'Pin', 'required|trim|numeric');
        $this->bf_form_validation->set_rules('patientDetails_address', 'Address', 'required|trim');
        $this->bf_form_validation->set_rules('users_password', 'Password', 'trim|required|matches[cnfPassword]');
        $this->bf_form_validation->set_rules('cnfPassword', 'Confirm Password', 'trim|required');

//        familymember validation
        $addFamilyMember = $this->input->post('addFamilyMember');
        if ($addFamilyMember == 1) {
            $total_test = $this->input->post('total_test');
            for ($j = 1; $j <= $total_test; $j++) {
                $this->bf_form_validation->set_rules('usersfamily_name_' . $j, "Name $j", 'required|trim');
                $this->bf_form_validation->set_rules('usersfamily_gender_' . $j, "Gender $j", 'required|trim');
                $this->bf_form_validation->set_rules('usersfamily_age_' . $j, "Age $j", 'required|trim');
                $this->bf_form_validation->set_rules('usersfamily_relationId_' . $j, "Relation $j", 'required|trim');
                $healthInsurance = $this->input->post('healthInsurance_' . $j);
                if ($healthInsurance == 1) {
                    $this->bf_form_validation->set_rules('userInsurance_insuranceId_' . $j, 'Health Insura. Company', 'required|trim');
                    $this->bf_form_validation->set_rules('userInsurance_insuranceNo_' . $j, 'Health Insura. Card no.', 'required|trim');
                    $this->bf_form_validation->set_rules('userInsurance_expDate_' . $j, 'Health Insura. Exp date.', 'required|trim');
                }
            }
        }
//      user insurance
        $healthInsurance = $this->input->post('healthInsurance1');
        if ($healthInsurance == 1) {
            $this->bf_form_validation->set_rules('userInsurance_insuranceId', 'Health Insura. Company', 'required|trim');
            $this->bf_form_validation->set_rules('userInsurance_insuranceNo', 'Health Insura. Card no.', 'required|trim');
            $this->bf_form_validation->set_rules('userInsurance_expDate', 'Policy Expiry Date', 'required|trim');
        }

        if (empty($_FILES['avatar_file']['name'])) {
            $this->bf_form_validation->set_rules('avatar_file', 'Image', 'required');
        }
        if ($this->bf_form_validation->run() == FALSE) {
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => ajax_validation_errors());
            echo json_encode($responce);
        } else {

            $imagesname = "";
            if ($_FILES['avatar_file']['name']) {
                $path = realpath(FCPATH . 'assets/usersImage/');
                $upload_data = $this->input->post('avatar_data');
                $upload_data = json_decode($upload_data);
                $original_imagesname = $this->uploadImageWithThumb($upload_data, 'avatar_file', $path, 'assets/usersImage/', './assets/usersImage/thumb/', 'users');
                if (empty($original_imagesname)) {
                    $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $this->error_message());
                    echo json_encode($responce);
                } else {
                    $imagesname = $original_imagesname;
                }
            }

            $imagesname = "";
            if ($_FILES['avatar_file']['name']) {
                $path = realpath(FCPATH . 'assets/usersImage/');
                $upload_data = $this->input->post('avatar_data');
                $upload_data = json_decode($upload_data);

                $original_imagesname = $this->uploadImageWithThumb($upload_data, 'avatar_file', $path, 'assets/usersImage/', './assets/usersImage/thumb/', 'users');

                if (empty($original_imagesname)) {

                    $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $this->error_message());
                    echo json_encode($responce);
                } else {
                    $imagesname = $original_imagesname;
                }
            }

            $email = strtolower($this->input->post('users_email'));
            $password = $this->input->post('users_password');
            $phone = $this->input->post('patientDetails_mobileNo');
            $encPassword = $this->common_model->encryptPassword($password);
            $emailId = explode("@", $email);
            $emailname = $emailId[0];

            $users_email_status = $this->input->post('users_email_status');
            if ($users_email_status == 0) {
                $usersInsertData = array(
                    'users_ip_address' => $_SERVER['REMOTE_ADDR'],
                    'users_email' => $email,
                    'users_password' => $encPassword,
                    'users_username' => $emailname,
                    'users_mobile' => $phone,
                    'creationTime' => strtotime(date('Y-m-d H:i:s'))
                );
                $option = array
                    (
                    'data' => $usersInsertData,
                    'table' => ' qyura_users'
                );
                // dump($usersInsertData);exit();
                $users_insertId = $this->common_model->customInsert($option);
            } else {
                $users_insertId = $users_email_status;
            }
            if ($users_email_status != 1) {
                $usersRoleData = array(
                    'usersRoles_userId' => $users_insertId,
                    'usersRoles_roleId' => 6,
                    'creationTime' => strtotime(date('Y-m-d H:i:s'))
                );
                $option = array
                    (
                    'data' => $usersRoleData,
                    'table' => ' qyura_usersRoles'
                );
                $users_insert = $this->common_model->customInsert($option);
            }
            $userId = $this->input->post('patientDetails_unqId');
            $name = $this->input->post('patientDetails_patientName');
            $gender = $this->input->post('patientDetails_gender');
            $dob = strtotime($this->input->post('patientDetails_dob'));

            $countryId = $this->input->post('patientDetails_countryId');
            $stateId = $this->input->post('patientDetails_stateId');
            $cityId = $this->input->post('patientDetails_cityId');
            $pincode = $this->input->post('patientDetails_pin');
            $address = $this->input->post('patientDetails_address');

            $pos = strpos($phone, "0");
            $users_phnNo = '';
            if ($pos == "0") {
                $users_phnNo = explode("0", $phone);
            }
            if (isset($users_phnNo[1])) {
                $phone = $doctors_phnNo[1];
            }

            $usersPatientInsertData = array(
                'patientDetails_unqId' => $userId,
                'patientDetails_patientImg' => $imagesname,
                'patientDetails_patientName' => $name,
                'patientDetails_gender' => $gender,
                'patientDetails_dob' => $dob,
                'patientDetails_mobileNo' => $phone,
                'patientDetails_countryId' => $countryId,
                'patientDetails_stateId' => $stateId,
                'patientDetails_cityId' => $cityId,
                'patientDetails_pin' => $pincode,
                'patientDetails_address' => $address,
                'patientDetails_usersId' => $users_insertId,
                'creationTime' => strtotime(date('Y-m-d H:i:s'))
            );
            $options = array
                (
                'data' => $usersPatientInsertData,
                'table' => ' qyura_patientDetails'
            );
            $users_insert_patient = $this->common_model->customInsert($options);

            $healthInsurance = $this->input->post('healthInsurance1');
            if ($healthInsurance == 1) {
                $user_insuranceId = $this->input->post('userInsurance_insuranceId');
                $user_insuranceNo = $this->input->post('userInsurance_insuranceNo');
                $user_insuranceDate = strtotime($this->input->post('userInsurance_expDate'));

                $user_insuranceData = array(
                    'userInsurance_insuranceId' => $user_insuranceId,
                    'userInsurance_insuranceNo' => $user_insuranceNo,
                    'userInsurance_expDate' => $user_insuranceDate,
                    'userInsurance_usersId' => $users_insertId,
                    'status' => 1,
                    'creationTime' => strtotime(date('Y-m-d H:i:s'))
                );
                $option = array
                    (
                    'data' => $user_insuranceData,
                    'table' => ' qyura_userInsurance'
                );
                $users_insert = $this->common_model->customInsert($option);
            }
            $addFamilyMember = $this->input->post('addFamilyMember');
            if ($addFamilyMember == 1) {
                $total_test = $this->input->post('total_test');
                for ($i = 1; $i <= $total_test; $i++) {
                    $familyMemberName = $this->input->post('usersfamily_name_' . $i);
                    $gender = $this->input->post('usersfamily_gender_' . $i);
                    $age = $this->input->post('usersfamily_age_' . $i);
                    $relation = $this->input->post('usersfamily_relationId_' . $i);
                    $user_familymemberData = array(
                        'usersfamily_name' => $familyMemberName,
                        'usersfamily_gender' => $gender,
                        'usersfamily_age' => $age,
                        'usersfamily_relationId' => $relation,
                        'usersfamily_usersId' => $users_insertId,
                        'creationTime' => strtotime(date('Y-m-d H:i:s'))
                    );
                    $option = array
                        (
                        'data' => $user_familymemberData,
                        'table' => ' qyura_usersFamily'
                    );
                    $users_familyinsertId = $this->common_model->customInsert($option);

                    $healthInsurance = $this->input->post('healthInsurance_' . $i);
                    if ($healthInsurance == 1) {
                        $family_insuranceId = $this->input->post('userInsurance_insuranceId_' . $i);
                        $family_insuranceNo = $this->input->post('userInsurance_insuranceNo_' . $i);
                        $family_insuranceDate = $this->input->post('userInsurance_expDate_' . $i);
                        $family_insuranceData = array(
                            'userInsurance_insuranceId' => $family_insuranceId,
                            'userInsurance_insuranceNo' => $family_insuranceNo,
                            'userInsurance_usersId' => $users_insertId,
                            'userInsurance_familyId' => $users_familyinsertId,
                            'userInsurance_expDate' => $family_insuranceDate,
                            'status' => 1,
                            'creationTime' => strtotime(date('Y-m-d H:i:s'))
                        );
                        $option = array
                            (
                            'data' => $family_insuranceData,
                            'table' => ' qyura_userInsurance'
                        );
                        $users_insert = $this->common_model->customInsert($option);
                    }
                }
            }
            if ($users_insert_patient) {

               $from = 'support@qyura.com';
                $to = $email;
                $subject = "User";
                $title = "Qyura Team";
                $data_tpl['name'] = $name;
                $data_tpl['email'] = $email;
                $data_tpl['password'] = $password;
                $msg = $this->load->view('email/signing_up_user_tpl', $data_tpl, true);
                 $this->send_mail($from,$to,$subject,$title,$msg);
                 
                $responce = array('status' => 1, 'msg' => "Data inserted successfully", 'url' => "users");
            } else {
                $error = array("TopError" => "<strong>Something went wrong while updating your data... sorry.</strong>");
                $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $error);
            }
            echo json_encode($responce);
        }
    }

    function fetchCity() {


        $stateId = $this->input->post('stateId');
        $cityData = $this->Users_model->fetchCity($stateId);
        $cityOption = '';
        $cityOption .='<option value=>Select Your City</option>';
        foreach ($cityData as $key => $val) {
            $cityOption .= '<option value=' . $val->city_id . '>' . strtoupper($val->city_name) . '</option>';
        }
        echo $cityOption;
        exit;
    }

    function checkUserExistence() {
        $email = $this->input->post('email');
        $id = $this->input->post('id');
        $this->Users_model->checkUserExistence($email, $id);
    }

    function userView() {

        $data['title'] = 'User View';


        $option = array(
            'select' => "*",
            'table' => "qyura_users",
            'join' => array(
                array('qyura_patientDetails', 'qyura_patientDetails.patientDetails_usersId = qyura_users.users_id', 'left')
            ),
            'where' => array('qyura_users.users_id' => 1, 'qyura_users.users_deleted' => 0),
            'single' => TRUE
        );

        $data['users_detail'] = $users_detail = $this->common_model->customGet($option);


        $option = array(
            'table' => 'qyura_city',
            'select' => '*',
            'where' => array('qyura_city.city_stateid' => $users_detail->patientDetails_stateId),
            'order' => array('qyura_city.city_name' => 'asc'),
            'single' => FALSE
        );
        $data['qyura_city'] = $this->common_model->customGet($option);


        $option = array(
            'select' => "*",
            'table' => "qyura_userInsurance",
            'where' => array('qyura_userInsurance.userInsurance_usersId' => $userId, 'qyura_userInsurance.userInsurance_familyId' => 0, 'qyura_userInsurance.userInsurance_deleted' => 0),
            'single' => TRUE
        );
        $data['users_insurance'] = $users_detail = $this->common_model->customGet($option);
        $option = array(
            "select" => "*",
            "table" => "qyura_usersFamily",
            'join' => array(
                array('qyura_userInsurance', 'qyura_userInsurance.userInsurance_familyId = qyura_usersFamily.usersfamily_id', 'left')
            ),
            'where' => array('qyura_usersFamily.usersfamily_usersId' => $userId, 'qyura_usersFamily.usersfamily_deleted' => 0,)
        );
        $data['usersfamily_detail'] = $this->common_model->customGet($option);
//print_r($data['usersfamily_detail']); exit;
        $this->load->super_admin_template('user_view', $data, 'usersScript');
    }

    function editUserView($userId = '') {


        $data['title'] = 'Edit User';
        $data['allStates'] = $this->Users_model->fetchStates();
        $data['insurance_cmpny'] = $this->Users_model->fetchinsurance();
        $data['familyMember'] = $this->Users_model->fetchfamilyMember();

        $option = array(
            'select' => "*",
            'table' => "qyura_users",
            'join' => array(
                array('qyura_patientDetails', 'qyura_patientDetails.patientDetails_usersId = qyura_users.users_id', 'left')
            ),
            'where' => array('qyura_users.users_id' => $userId, 'qyura_users.users_deleted' => 0),
            'single' => TRUE
        );

        $data['users_detail'] = $users_detail = $this->common_model->customGet($option);

        $option = array(
            'table' => 'qyura_city',
            'select' => '*',
            'where' => array('qyura_city.city_stateid' => $users_detail->patientDetails_stateId),
            'order' => array('qyura_city.city_name' => 'asc'),
            'single' => FALSE
        );
        $data['qyura_city'] = $this->common_model->customGet($option);

        $option = array(
            'select' => "*",
            'table' => "qyura_userInsurance",
            'where' => array('qyura_userInsurance.userInsurance_usersId' => $userId, 'qyura_userInsurance.userInsurance_familyId' => 0, 'qyura_userInsurance.userInsurance_deleted' => 0),
            'single' => TRUE
        );
        $data['users_insurance'] = $users_detail = $this->common_model->customGet($option);
        $option = array(
            "select" => "*",
            "table" => "qyura_usersFamily",
            'join' => array(
                array('qyura_userInsurance', 'qyura_userInsurance.userInsurance_familyId = qyura_usersFamily.usersfamily_id', 'left')
            ),
            'order' => array('qyura_usersFamily.usersfamily_name' => 'asc'),
            'where' => array('qyura_usersFamily.usersfamily_usersId' => $userId, 'qyura_usersFamily.usersfamily_deleted' => 0,)
        );
        $data['usersfamily_detail'] = $this->common_model->customGet($option);

        $this->load->super_admin_template('edit_user', $data, 'usersScript');
    }

    function editUserSave() {

        $userid = $this->input->post('users_id');
        $patientid = $this->input->post('patientDetails_id');
        // $userfamilyid = $this->input->post('usersfamily_id');

        $this->bf_form_validation->set_rules('patientDetails_patientName', 'Name', 'required|trim');
        // $this->bf_form_validation->set_rules('avatar_file', 'image', 'required');
        $this->bf_form_validation->set_rules('patientDetails_gender', 'Gender', 'required|trim');
        $this->bf_form_validation->set_rules('patientDetails_dob', 'Date of Birth', 'required|trim');
        // $this->bf_form_validation->set_rules('users_email', 'Users Email', "required|valid_email|trim");
        //$this->bf_form_validation->set_rules('patientDetails_mobileNo', 'User Phone', 'required|trim|numeric');
        $this->bf_form_validation->set_rules('patientDetails_stateId', 'State', 'required|trim');
        $this->bf_form_validation->set_rules('patientDetails_cityId', 'City', 'required|trim');
        $this->bf_form_validation->set_rules('patientDetails_pin', 'Pin', 'required|trim|numeric');
        $this->bf_form_validation->set_rules('patientDetails_address', 'Address', 'required|trim');

//        $total_test_edit = $this->input->post('total_test_edit');
//        if ($total_test_edit > 0){
//            if($total_test_edit == 1){
//                $total_test_edit = $total_test_edit+1;
//            }
//            for ($j = 1; $j < $total_test_edit; $j++) {
//                $healthInsurance = $this->input->post('healthInsurance_' . $i);
//                if ($healthInsurance == 1) {
//                    $this->bf_form_validation->set_rules('userInsurance_insuranceId_' . $i, 'Health Insura. Company', 'required|trim');
//                    $this->bf_form_validation->set_rules('userInsurance_insuranceNo_' . $i, 'Health Insura. Card no.', 'required|trim');
//                    $this->bf_form_validation->set_rules('userInsurance_expDate_'.$i, 'Policy Expiry Date', 'required|trim');
//                }
//                $this->bf_form_validation->set_rules('usersfamily_name_' . $j, "Name $j", 'required|trim');
//                $this->bf_form_validation->set_rules('usersfamily_gender_' . $j, "Gender $j", 'required|trim');
//                $this->bf_form_validation->set_rules('usersfamily_age_' . $j, "Age $j", 'required|trim');
//                $this->bf_form_validation->set_rules('usersfamily_relationId_' . $j, "Relation $j", 'required|trim');
//            }
//        }
//            user insurance
        $healthInsurance = $this->input->post('healthInsurance1');
        if ($healthInsurance == 1) {
            $this->bf_form_validation->set_rules('userInsurance_insuranceId', 'Health Insura. Company', 'required|trim');
            $this->bf_form_validation->set_rules('userInsurance_insuranceNo', 'Health Insura. Card no.', 'required|trim');
            $this->bf_form_validation->set_rules('userInsurance_expDate', 'Policy Expiry Date', 'required|trim');
        }

        if ($this->bf_form_validation->run() === FALSE) {
            // $data = $userid;
            $data['title'] = 'Edit User';
            $data['allStates'] = $this->Users_model->fetchStates();
            $data['insurance_cmpny'] = $this->Users_model->fetchinsurance();
            $data['familyMember'] = $this->Users_model->fetchfamilyMember();

            $option = array(
                'select' => "*",
                'table' => "qyura_users",
                'join' => array(
                    array('qyura_patientDetails', 'qyura_patientDetails.patientDetails_usersId = qyura_users.users_id', 'left')
                ),
                'where' => array('qyura_users.users_id' => $userid, 'qyura_users.users_deleted' => 0),
                'single' => TRUE
            );

            $data['users_detail'] = $users_detail = $this->common_model->customGet($option);

            $option = array(
                'table' => 'qyura_city',
                'select' => '*',
                'where' => array('qyura_city.city_stateid' => $users_detail->patientDetails_stateId),
                'order' => array('qyura_city.city_name' => 'asc'),
                'single' => FALSE
            );
            $data['qyura_city'] = $this->common_model->customGet($option);

            $option = array(
                'select' => "*",
                'table' => "qyura_userInsurance",
                'where' => array('qyura_userInsurance.userInsurance_usersId' => $userid, 'qyura_userInsurance.userInsurance_familyId' => 0, 'qyura_userInsurance.userInsurance_deleted' => 0),
                'single' => TRUE
            );
            $data['users_insurance'] = $users_detail = $this->common_model->customGet($option);
            $option = array(
                "select" => "*",
                "table" => "qyura_usersFamily",
                'join' => array(
                    array('qyura_userInsurance', 'qyura_userInsurance.userInsurance_familyId = qyura_usersFamily.usersfamily_id', 'left')
                ),
                'order' => array('qyura_usersFamily.usersfamily_name' => 'asc'),
                'where' => array('qyura_usersFamily.usersfamily_usersId' => $userid, 'qyura_usersFamily.usersfamily_deleted' => 0,)
            );
            $data['usersfamily_detail'] = $this->common_model->customGet($option);

            $this->load->super_admin_template('edit_user', $data, 'usersScript');
        } else {
            $imagesname = "";
            if ($_FILES['avatar_file']['name']) {
                $path = realpath(FCPATH . 'assets/usersImage/');
                $upload_data = $this->input->post('avatar_data');
                $upload_data = json_decode($upload_data);

                $original_imagesname = $this->uploadImageWithThumb($upload_data, 'avatar_file', $path, 'assets/usersImage/', './assets/usersImage/thumb/', 'users');

                if (empty($original_imagesname)) {

                    $this->session->set_flashdata('valid_upload', $this->error_message);
                    $data['title'] = 'Edit Users';
                    $data['allStates'] = $this->Users_model->fetchStates();
                    $this->load->super_admin_template('add_user', $data, 'usersScript');
                    return false;
                } else {
                    $imagesname = $original_imagesname;
                }
            } else {
                $imagesname = $this->input->post('patientDetails_patientImg');
            }
            $email = $this->input->post('users_email');

            $password = $this->input->post('users_password');

            $encPassword = $this->common_model->encryptPassword($password);
            $emailId = explode("@", $email);
            $emailname = $emailId[0];

            $phone = $this->input->post('patientDetails_mobileNo');

            $pos = strpos($phone, "0");

            $users_phnNo = '';
            if ($pos == "0") {
                $users_phnNo = explode("0", $phone);
            }

            if (isset($users_phnNo[1])) {
                $phone = $users_phnNo[1];
            }

            $usersInsertData = array(
                'users_ip_address' => $_SERVER['REMOTE_ADDR'],
                'users_email' => $email,
                'users_username' => $emailname,
                'users_mobile' => $phone,
                'modifyTime' => strtotime(date('Y-m-d H:i:s'))
            );
            if (isset($password) && !empty($password)) {
                $usersInsertData['users_password'] = $encPassword;
            }

            $option = array
                (
                'where' => array('users_id' => $userid),
                'data' => $usersInsertData,
                'table' => ' qyura_users',
            );

            $users_insertId = $this->common_model->customUpdate($option);

            $name = $this->input->post('patientDetails_patientName');
            $gender = $this->input->post('patientDetails_gender');
            $dob = strtotime($this->input->post('patientDetails_dob'));

            $countryId = $this->input->post('patientDetails_countryId');
            $stateId = $this->input->post('patientDetails_stateId');
            $cityId = $this->input->post('patientDetails_cityId');
            $pincode = $this->input->post('patientDetails_pin');
            $address = $this->input->post('patientDetails_address');

            $usersPatientInsertData = array(
                'patientDetails_patientImg' => $imagesname,
                'patientDetails_patientName' => $name,
                'patientDetails_gender' => $gender,
                'patientDetails_dob' => $dob,
                'patientDetails_mobileNo' => $phone,
                'patientDetails_countryId' => $countryId,
                'patientDetails_stateId' => $stateId,
                'patientDetails_cityId' => $cityId,
                'patientDetails_pin' => $pincode,
                'patientDetails_address' => $address,
                'modifyTime' => strtotime(date('Y-m-d H:i:s'))
            );
            $options = array
                ('where' => array('patientDetails_id' => $patientid),
                'data' => $usersPatientInsertData,
                'table' => ' qyura_patientDetails'
            );
            $users_insert = $this->common_model->customUpdate($options);

            $insuranceid = $this->input->post('userInsurance_id');
            $user_insuranceId = $this->input->post('userInsurance_insuranceId');
            $user_insuranceNo = $this->input->post('userInsurance_insuranceNo');
            $user_insuranceDate = strtotime($this->input->post('userInsurance_expDate'));
            $user_insuranceData = array(
                'userInsurance_usersId' => $userid,
                'userInsurance_insuranceId' => $user_insuranceId,
                'userInsurance_insuranceNo' => $user_insuranceNo,
                'userInsurance_expDate' => $user_insuranceDate,
            );
            $healthInsurance = $this->input->post('healthInsurance1');
            if ($healthInsurance == 1) {
                if (isset($insuranceid) && $insuranceid != NULL) {
                    $user_insuranceData['modifyTime'] = strtotime(date('Y-m-d H:i:s'));
                    $option = array
                        (
                        'where' => array('userInsurance_id' => $insuranceid),
                        'data' => $user_insuranceData,
                        'table' => ' qyura_userInsurance'
                    );
                    $users_insertdata = $this->common_model->customUpdate($option);
                } else {
                    $user_insuranceData['creationTime'] = strtotime(date('Y-m-d H:i:s'));
                    $user_insuranceData['status'] = 1;
                    $option = array
                        (
                        'data' => $user_insuranceData,
                        'table' => ' qyura_userInsurance'
                    );
                    $users_insertdata = $this->common_model->customInsert($option);
                }
            } else {
                $query = "DELETE FROM `qyura_userInsurance` WHERE `userInsurance_id` = '$insuranceid'";
                $users_insertdata = $this->common_model->customQuery($query, FALSE, TRUE);
            }


            //            hemu start




            $total_test_edit = $this->input->post('total_test_edit');

            for ($i = 1; $i < $total_test_edit; $i++) {

                $userFamilyId = $this->input->post('usersfamily_id_' . $i);

                $familyMemberName = $this->input->post('usersfamily_name_' . $i);
                $gender = $this->input->post('usersfamily_gender_' . $i);
                $age = $this->input->post('usersfamily_age_' . $i);
                $relation = $this->input->post('usersfamily_relationId_' . $i);
                $user_familymemberData = array(
                    'usersfamily_name' => $familyMemberName,
                    'usersfamily_gender' => $gender,
                    'usersfamily_age' => $age,
                    'usersfamily_relationId' => $relation,
                    'usersfamily_usersId' => $userid,
                    'creationTime' => strtotime(date('Y-m-d H:i:s'))
                );

                if (isset($userFamilyId) && $userFamilyId != NULL) {
                    $option = array
                        ('where' => array('usersfamily_id' => $userFamilyId),
                        'data' => $user_familymemberData,
                        'table' => ' qyura_usersFamily'
                    );
                    $users_familyinsertId = $this->common_model->customUpdate($option);
                } else {
                    $user_familymemberData['creationTime'] = strtotime(date('Y-m-d H:i:s'));
                    $user_familymemberData['status'] = 1;
                    $option = array
                        (
                        'data' => $user_familymemberData,
                        'table' => ' qyura_usersFamily'
                    );
                    $userFamilyId = $this->common_model->customInsert($option);
                }

                $familyhealthInsurance = $this->input->post('healthInsurance_' . $i);
                $userFamInsurance = $this->input->post('userFInsurance_id_' . $i);


                $family_insurance = $this->input->post('userInsurance_insuranceId_' . $i);
                $family_insuranceNo = $this->input->post('userInsurance_insuranceNo_' . $i);
                $family_insuranceExpDate = strtotime($this->input->post('userInsurance_expDate_' . $i));
                //  $family_insuranceExpDate = $this->input->post('userInsurance_expDate_' . $i);
                $family_insuranceData = array(
                    'userInsurance_insuranceId' => $family_insurance,
                    'userInsurance_insuranceNo' => $family_insuranceNo,
                    'userInsurance_usersId' => $userid,
                    'userInsurance_familyId' => $userFamilyId,
                    'userInsurance_expDate' => $family_insuranceExpDate,
                    'creationTime' => strtotime(date('Y-m-d H:i:s'))
                );

                if ($familyhealthInsurance == 1) {
                    if (isset($userFamInsurance) && $userFamInsurance != NULL) {
                        $family_insuranceData['modifyTime'] = strtotime(date('Y-m-d H:i:s'));
                        $option = array
                            (
                            'where' => array('userInsurance_id' => $userFamInsurance),
                            'data' => $family_insuranceData,
                            'table' => ' qyura_userInsurance'
                        );

                        $users_insert = $this->common_model->customUpdate($option);
                    } else {
                        $family_insuranceData['creationTime'] = strtotime(date('Y-m-d H:i:s'));
                        $family_insuranceData['status'] = 1;
                        $option = array
                            (
                            'data' => $family_insuranceData,
                            'table' => ' qyura_userInsurance'
                        );
                        $users_insert = $this->common_model->customInsert($option);
                    }
                } else {
                    $query = "DELETE FROM `qyura_userInsurance` WHERE `userInsurance_id` = '$userFamInsurance'";
                    $users_insert = $this->common_model->customQuery($query, FALSE, TRUE);
                }
            }
            $this->session->set_flashdata('message', 'Data updated successfully !');
            redirect('users');
        }
    }

    function getUsersDl() {
        echo $this->Users_model->fetchUsersDataTables();
    }

    function getconsultantDl() {
        echo $this->Users_model->fetchUsersConsultantDataTables();
    }

    function getuserDiagnosticDl() {
        echo $this->Users_model->fetchUsersDiagnosticDataTables();
    }

    function check_email() {

        $data = 0;
        $user_table_id = '';
        $users_email = strtolower($this->input->post('users_email'));

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
                'where' => array('qyura_usersRoles.usersRoles_deleted' => 0, 'qyura_usersRoles.usersRoles_userId' => $email->users_id, 'qyura_usersRoles.usersRoles_roleId' => 6),
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

    function check_MobileNo() {

        $data = 0;
        $user_table_id = '';
        $users_mobile = $this->input->post('mobile_no');

        $option = array(
            'table' => 'qyura_users',
            'select' => '*',
            'where' => array('qyura_users.users_deleted' => 0, 'qyura_users.users_mobile' => $users_mobile),
            'single' => TRUE
        );
        $phone = $this->common_model->customGet($option);

        if ($phone != NULL) {
            $option = array(
                'table' => 'qyura_usersRoles',
                'select' => '*',
                'where' => array('qyura_usersRoles.usersRoles_deleted' => 0, 'qyura_usersRoles.usersRoles_userId' => $phone->users_id, 'qyura_usersRoles.usersRoles_roleId' => 6),
                'single' => TRUE
            );
            $userRoles = $this->common_model->customGet($option);

            $data = 1;
            if (!empty($userRoles)) {
                echo $data;
            } else {
                $data = $phone->users_id;
                echo $data;
            }
        } else {
            echo $data;
        }
        exit;
    }

}
