<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'modules/api/controllers/MyRest.php';

class Auth extends MyRest {

    function __construct() {
        parent::__construct();
        $this->load->library(array('ion_auth_api', 'form_validation','email'));
        $this->load->helper(array('url', 'language', 'common', 'string'));
        $this->bf_form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'auth_conf_api'), $this->config->item('error_end_delimiter', 'auth_conf_api'));
        $this->lang->load('auth_api');
    }

    //signup
    function signUp_post() {
      
        $this->bf_form_validation->set_rules('device', 'device', 'required|min_length[1]|max_length[1]|numeric|xss_clean');
        $this->bf_form_validation->set_rules('email', 'email', 'required|valid_email|xss_clean');
        $this->bf_form_validation->set_rules('gender', 'Gender', 'trim|min_length[1]|max_length[1]|numeric|xss_clean');
        $this->bf_form_validation->set_rules('logintype', 'logintype', 'required|min_length[1]|max_length[1]|numeric|xss_clean');
        $this->bf_form_validation->set_rules('mobileNo', 'Mobile No', 'required|min_length[10]|max_length[10]|numeric|xss_clean');
        $this->bf_form_validation->set_rules('name', 'name', 'required|max_length[80]|xss_clean');
        
        $this->bf_form_validation->set_rules('pushToken', 'push token', 'min_length[8]|max_length[255]|xss_clean');
        $this->bf_form_validation->set_rules('udid', 'udid', 'min_length[8]|max_length[255]|xss_clean');
        
        $logintype = $this->input->post('logintype');
        if($logintype == 0){
            $this->bf_form_validation->set_rules('password', 'password', 'required|min_length[' . $this->config->item('min_password_length', 'auth_conf_api') . ']|max_length[' . $this->config->item('max_password_length', 'auth_conf_api') . ']|xss_clean');
            $this->bf_form_validation->set_rules('dob', 'Date of Birth', 'trim|xss_clean|valid_date[y-m-d,-]'); 
        }elseif($logintype == 2){
            $this->bf_form_validation->set_rules('socialId', 'Social Id', 'trim|required|xss_clean');
        }
        
        if ($this->bf_form_validation->run() == FALSE) {
            $message = $this->validation_post_warning();
            $response = array('status' => FALSE, 'message' => $message);
            $this->response($response, 400);
        } else {
            
            $data['device'] = $this->input->post('device');
            $data['email'] = $users_email = $this->input->post('email');
            $data['gender']  = $this->input->post('gender');
            $data['logintype'] = $this->input->post('logintype');
            $data['mobileNo'] = $this->input->post('mobileNo');
            $data['name'] = $this->input->post('name');
            $data['pushToken'] = $this->input->post('pushToken');
            $data['udid'] = $this->input->post('udid');
            $data['pushToken'] = $this->input->post('pushToken');
            $data['pushToken'] = $this->input->post('pushToken');
            $data['user_id'] = '';
            if($logintype == 0){
                $data['password'] = $this->common_model->encryptPassword($this->input->post('password'));
                $data['dob'] = strtotime($this->input->post('dob'));
                $data['socialId'] = '';
            }elseif($logintype == 2){
                $length = 10;
                $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $password = '';
                for ($i = 0; $i < $length; $i++) {
                    $password .= $characters[rand(0, strlen($characters) - 1)];
                }
                $data['password'] = $this->common_model->encryptPassword($password);
                $data['dob'] = '';
                $data['socialId'] = $this->input->post('socialId');
            }
            
            $option = array(
                'table' => 'qyura_users',
                'select' => '*',
                'where' => array('qyura_users.users_deleted' => 0,'qyura_users.users_email' => $users_email),
                'single' => TRUE
            );
            $email = $this->common_model->customGet($option);
            
            if(!empty($email)){
                $options = array(
                    'select'=>'*',
                    'table' => 'qyura_users',
                    'where' => array('qyura_users.users_deleted' => 0, 'qyura_users.users_email' => $users_email,'qyura_usersRoles.usersRoles_roleId' => 6),
                    'join' => array(
                        array('qyura_usersRoles', 'qyura_usersRoles.usersRoles_userId = qyura_users.users_id', 'left'),
                    ),
                    'single'=>true
                );
                $data = $this->common_model->customGet($options);

                if(isset($data) && $data != null){
                    $message = "This email already registered with us";
                    $response = array('status' => FALSE, 'message' => $message);
                    $this->response($response, 400);
                }else{
                    $data['user_id'] = $email->users_id;
                    $user_mobile = $this->input->post('mobileNo');
                    $option = array(
                        'table' => 'qyura_users',
                        'select' => '*',
                        'where' => array('qyura_users.users_deleted' => 0,'qyura_users.users_mobile' => $user_mobile,'qyura_usersRoles.usersRoles_roleId' => 6),
                        'join' => array(
                            array('qyura_usersRoles', 'qyura_usersRoles.usersRoles_userId = qyura_users.users_id', 'left'),
                        ),
                        'single'=>true
                    );
                    $mobile = $this->common_model->customGet($option);
                    if(isset($mobile) && $mobile != null){
                        $message = "This mobile number already registered with us";
                        $response = array('status' => FALSE, 'message' => $message);
                        $this->response($response, 400);
                    }else{
                        $this->sendOtp($data);
                    }
                }
            }else{
                $user_mobile = $this->input->post('mobileNo');
                $option = array(
                    'table' => 'qyura_users',
                    'select' => '*',
                    'where' => array('qyura_users.users_deleted' => 0,'qyura_users.users_mobile' => $user_mobile,'qyura_usersRoles.usersRoles_roleId' => 6),
                    'join' => array(
                        array('qyura_usersRoles', 'qyura_usersRoles.usersRoles_userId = qyura_users.users_id', 'left'),
                    ),
                    'single'=>true
                );
                $mobile = $this->common_model->customGet($option);
                if(isset($mobile) && $mobile != null){
                    $message = "This mobile number already registered with us";
                    $response = array('status' => FALSE, 'message' => $message);
                    $this->response($response, 400);
                }else{
                    $this->sendOtp($data);
                }
            }
        }
    }

    // saveUserData
    function sendOtp($data){
        $length = 5;
        $characters = '0123456789';
        $otp = '';
        for ($i = 0; $i < $length; $i++) {
            $otp .= $characters[rand(0, strlen($characters) - 1)];
        }
        $otp_no= $otp.": This is your Qyura One Time Password";
        $data['users_otpCode'] = $otp;
        $send = $this->common_model->sendSms($data['mobileNo'],$otp_no);
        
	$from = "qyura@gmail.com";
        $title = "QYURA TEAM";
        $to = $data['email'];
        $subject = "OTP";
        $msg = $otp_no;
        $this->send_mail_user($from,$to,$subject,$title,$msg);
        
        if($data['logintype'] == 2){
            $subject2 = "Login Password";
            $message2 = "Auto Generated Password :" . $data['password'];
            $this->send_mail_user($from,$to,$subject2,$title,$message2);
        }

        $option = array(
            'table' => 'qyura_otp',
            'select' => '*',
            'where' => array('qyura_otp.otp_deleted' => 0,'qyura_otp.status' => 1,'qyura_otp.otp_mobile' => $data['mobileNo']),
            'single' => TRUE
        );
        $mobile = $this->common_model->customGet($option);
        if(isset($mobile) && $mobile != NULL){
            $update_user['otp_number'] = $otp;
            $update_user['otp_confirm'] = '0';
            $updateOptions = array
            (
                'where' => array('otp_mobile' => $data['mobileNo']),
                'data'  => $update_user,
                'table' => 'qyura_otp'
            );
            $otpInsert = $this->common_model->customUpdate($updateOptions);
        }else{
            $records_array = array('creationTime' => date('Y-m-d'), 'otp_mobile' => $data['mobileNo'], 'otp_number' => $otp);
            $options = array
                (
                'data' => $records_array,
                'table' => 'qyura_otp'
            );
            $otpInsert = $this->common_model->customInsert($options);
        }
        $msg = "Thank You! Please check your email or SMS to activate your account";
        $response = array('status' => 1, 'message' => $msg, 'userDetail' => $data);
        $this->response($response, 200); // 200 being the HTTP response code
    }
    
    //Active Otp
    function activeOTP_post() {

        $this->bf_form_validation->set_rules('code', 'OTP Code', 'required|numeric|min_length[5]|max_length[5]|xss_clean');
        $this->bf_form_validation->set_rules('device', 'device', 'required|min_length[1]|max_length[1]|numeric|xss_clean');
        $this->bf_form_validation->set_rules('email', 'email', 'required|valid_email|xss_clean');
        $this->bf_form_validation->set_rules('gender', 'Gender', 'trim|xss_clean');
        $this->bf_form_validation->set_rules('logintype', 'logintype', 'required|min_length[1]|max_length[1]|numeric|xss_clean');
        $this->bf_form_validation->set_rules('mobileNo', 'Mobile No', 'required|min_length[10]|max_length[10]|numeric|xss_clean');
        $this->bf_form_validation->set_rules('name', 'name', 'required|max_length[80]|xss_clean');
        
        $this->bf_form_validation->set_rules('pushToken', 'push token', 'min_length[8]|max_length[255]|xss_clean');
        $this->bf_form_validation->set_rules('udid', 'udid', 'max_length[255]|xss_clean');
        
        $logintype = $this->input->post('logintype');
        if($logintype == 0){
            $this->bf_form_validation->set_rules('password', 'password', 'required|xss_clean');
            $this->bf_form_validation->set_rules('dob', 'Date of Birth', 'trim|xss_clean'); 
        }elseif($logintype == 2){
            $this->bf_form_validation->set_rules('socialId', 'Social Id', 'trim|required|xss_clean');
        }

        if ($this->bf_form_validation->run($this) === FALSE) {
            $message = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);
        } else {
            $data['user_id'] = $user_id = $this->input->post('user_id');
            $data['device'] = $device = $this->input->post('device');
            $data['email'] = $users_email = $this->input->post('email');
            $data['gender']  = $gender = $this->input->post('gender');
            $data['logintype'] = $logintype = $this->input->post('logintype');
            $data['mobileNo'] = $mobileNo =$this->input->post('mobileNo');
            $data['name'] = $name = $this->input->post('name');
            $data['pushToken'] = $pushToken = $this->input->post('pushToken');
            $data['udid'] = $udid =$this->input->post('udid');
            $data['user_id'] = '';
            $username = explode('@', $users_email);
            $username = $this->username = $username[0];
            if($logintype == 0){
                $data['password'] = $password = $this->input->post('password');
                $data['dob'] = $dob = $this->input->post('dob');
                $data['socialId'] = $socialId = '';
            }elseif($logintype == 2){
                $length = 10;
                $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $password = '';
                for ($i = 0; $i < $length; $i++) {
                    $password .= $characters[rand(0, strlen($characters) - 1)];
                }
                $data['password'] = $password = $password;
                $data['dob'] = $dob = '';
                $data['socialId'] = $socialId = $this->input->post('socialId');
            }
            
            $code = $this->input->post('code');
            $option = array(
                'table' => 'qyura_otp',
                'select' => '*',
                'where' => array('qyura_otp.otp_deleted' => 0,'qyura_otp.status' => 1,'qyura_otp.otp_confirm' => 0,'qyura_otp.otp_mobile' => $mobileNo,'qyura_otp.otp_number' => $code),
                'single' => TRUE
            );
            $mobile = $this->common_model->customGet($option);
            
            if(isset($mobile) && $mobile != NULL){
                $update_user['otp_confirm'] = '1';
                $updateOptions = array
                (
                    'where' => array('otp_mobile' => $mobileNo,'otp_number' => $code),
                    'data'  => $update_user,
                    'table' => 'qyura_otp'
                );
                $otpInsert = $this->common_model->customUpdate($updateOptions);
                if (empty($user_id)) {
                    $optionUser = array(
                        'table' => 'qyura_users',
                        'data' => array(
                            'users_username' => $username,
                            'users_password' => $password,
                            'users_email' => $users_email,
                            'users_mobile' => $mobileNo,
                            'users_active' => 1,
                            'users_otpActive' => 1,
                            'users_otpCode' => $code,
                            'users_deleted' => 0,
                            'users_gpId' => $socialId,
                            'users_logintype' => $logintype,
                            'users_ip_address' => $_SERVER['REMOTE_ADDR'],
                            'creationTime' => strtotime(date('Y-m-d H:i:s'))
                        )
                    );
                    $user_id = $this->common_model->customInsert($optionUser);
                }else{
                    $update_user['userSocial_gpId'] = $socialId;
                    $updateOptions = array
                    (
                        'where' => array('users_id' => $user_id),
                        'data'  => $update_user,
                        'table' => 'qyura_users'
                    );
                    $this->common_model->customUpdate($updateOptions);
                }
                if (!empty($user_id)) {
                    $optionAuotation = array(
                        'table' => 'qyura_patientDetails',
                        'data' => array(
                            'patientDetails_usersId' => $user_id,
                            'patientDetails_mobileNo' => $mobileNo,
                            'patientDetails_unqId' => 'PNT' . random_string('alnumnew', 6),
                            'patientDetails_patientName' => $name,
                            'patientDetails_dob' => $dob,
                            'patientDetails_gender' => $gender,
                            'patientDetails_deleted'=> 0,
                            'creationTime' => strtotime(date('Y-m-d H:i:s'))
                        )
                     );
                    $patitentId = $this->common_model->customInsert($optionAuotation);
                    $optionRole = array(
                        'table' => 'qyura_usersRoles',
                        'data' => array(
                            'usersRoles_userId' => $user_id,
                            'usersRoles_roleId' => 6,
                            'creationTime' => strtotime(date('Y-m-d H:i:s'))
                        )
                     );
                    $rolesId = $this->common_model->customInsert($optionRole);
                    $optionSocial = array(
                        'table' => 'qyura_userSocial',
                        'data' => array(
                            'userSocial_usersId' => $user_id,
                            'userSocial_notification' => 1,
                            'userSocial_pushToken' => $pushToken,
                            'userSocial_udid' => $udid,
                            'userSocial_device' => $device,
                            'userSocial_gpId'=> $socialId,
                            'creationTime' => strtotime(date('Y-m-d H:i:s'))
                        )
                    );
                    $this->common_model->customInsert($optionSocial);
                }
                
                $from = 'support@qyura.com';
                $to = $users_email;
                $data_tpl['name'] = $name;
                $data_tpl['email'] = $users_email;
                $data_tpl['password'] = $password;
                $message = $this->load->view('email/signing_up_user_tpl',$data_tpl,true);
                $subject = "Qyura";
                $title = "Qyura Team";
                $this->send_mail_user($from,$to,$subject,$title,$message);
                
                $option = array(
                    'table' => 'qyura_users',
                    'select' => '*',
                    'where' => array('qyura_users.users_deleted' => 0,'qyura_users.users_email' => $users_email,'qyura_usersRoles.usersRoles_roleId' => 6),
                    'join' => array(
                        array('qyura_usersRoles', 'qyura_usersRoles.usersRoles_userId = qyura_users.users_id', 'left'),
                        array('qyura_patientDetails', 'qyura_patientDetails.patientDetails_usersId = qyura_users.users_id', 'left'),
                        array('qyura_userSocial', 'qyura_userSocial.userSocial_usersId = qyura_users.users_id', 'left'),
                    ),
                    'single'=>true
                );
                $userDetail = $this->common_model->customGet($option);
                $userDetail->address = $userDetail->patientDetails_address;
                $userDetail->dob = $userDetail->patientDetails_dob;
                $userDetail->fbId = $userDetail->userSocial_fbId;
                $userDetail->gender = $userDetail->patientDetails_gender;
                $userDetail->gpId = $userDetail->users_gpId;
                $userDetail->logintype = $userDetail->users_logintype;
                $userDetail->notification = $userDetail->userSocial_notification;
                $userDetail->pLastName = $userDetail->patientDetails_pLastName;
                $userDetail->patientImg = $userDetail->patientDetails_patientImg;
                $userDetail->patientName = $userDetail->patientDetails_patientName;
                $userDetail->device = $device;
                $userDetail->pUnqId = $userDetail->patientDetails_unqId;
                $userDetail->pushToken = $userDetail->userSocial_pushToken;
                $userDetail->scUsersId = $userDetail->userSocial_id;
                
                
                $msg = "Your Account is Activated Successfully";
                $response = array('status' => 1, 'message' => $msg, 'userDetail' => $userDetail);
                $this->response($response, 200); // 200 being the HTTP response code
            }else{
                $message = "Please Check Your OTP";
                $response = array('status' => FALSE, 'message' => $message);
                $this->response($response, 400);
            }
        }
    }
    
    //Check Social
    function checkSocial_post() {
        
        $logintype = (int) $this->input->post('logintype');
        $this->bf_form_validation->set_rules('logintype', 'logintype', 'required|min_length[1]|max_length[1]|numeric|xss_clean');
        $this->bf_form_validation->set_rules('socialId', 'Social Id', 'trim|required|xss_clean');
        $this->bf_form_validation->set_rules('email', 'Email Id', 'trim|required|xss_clean');
        if ($this->bf_form_validation->run() == FALSE) {
            $message = $this->validation_post_warning();
            $response = array('status' => FALSE, 'message' => $message);
            $this->response($response, 400);
        }else{
            $email = $this->input->post('email');
            $social = $this->input->post('socialId');
            
            $option = array(
                'table' => 'qyura_users',
                'select' => '*',
                'where' => array('qyura_users.users_deleted' => 0,'qyura_users.users_email' => $email,'qyura_usersRoles.usersRoles_roleId' => 6),
                'join' => array(
                    array('qyura_usersRoles', 'qyura_usersRoles.usersRoles_userId = qyura_users.users_id', 'left'),
                    array('qyura_patientDetails', 'qyura_patientDetails.patientDetails_usersId = qyura_users.users_id', 'left'),
                    array('qyura_userSocial', 'qyura_userSocial.userSocial_usersId = qyura_users.users_id', 'left'),
                ),
                'single'=>true
            );
            $userDetail = $this->common_model->customGet($option);
            if (isset($userDetail) && $userDetail != NULL) {
		    $userDetail->address = $userDetail->patientDetails_address;
		    $userDetail->dob = $userDetail->patientDetails_dob;
		    $userDetail->fbId = $userDetail->userSocial_fbId;
		    $userDetail->gender = $userDetail->patientDetails_gender;
		    $userDetail->gpId = $userDetail->users_gpId;
		    $userDetail->logintype = $userDetail->users_logintype;
		    $userDetail->notification = $userDetail->userSocial_notification;
		    $userDetail->pLastName = $userDetail->patientDetails_pLastName;
		    $userDetail->patientImg = $userDetail->patientDetails_patientImg;
		    $userDetail->patientName = $userDetail->patientDetails_patientName;
		    $userDetail->device = $userDetail->userSocial_device;
		    $userDetail->pUnqId = $userDetail->patientDetails_unqId;
		    $userDetail->pushToken = $userDetail->userSocial_pushToken;
		    $userDetail->scUsersId = $userDetail->userSocial_id;
    
                if ($userDetail->gpId == null)
                    $userDetail->gpId = '';

                if ($userDetail->fbId == null)
                    $userDetail->fbId = '';

                if ($userDetail->patientImg == 'assets/proImg/')
                    $userDetail->patientImg = '';

                $response = array('status' => TRUE, 'userDetail' => $userDetail, 'message' => 'Login successfull');
                $this->response($response, 200);
            }else {
                $response = array('status' => FALSE, 'message' => 'Please go to next step');
                $this->response($response, 400);
            }
        }
    }
    
    //log the user in
    function login_post() {

        //validate form input
        $this->bf_form_validation->set_rules('identity', 'Identity', 'required|xss_clean');
        $this->bf_form_validation->set_rules('password', 'Password', 'required|xss_clean');

        $this->bf_form_validation->set_rules('pushToken', 'push token', 'min_length[8]|max_length[255]|xss_clean');
        $this->bf_form_validation->set_rules('udid', 'udid', 'max_length[255]|xss_clean');
        $this->bf_form_validation->set_rules('device', 'device', 'required|min_length[1]|max_length[1]|numeric|xss_clean');

        if ($this->bf_form_validation->run() == FALSE) {
            $message = $this->validation_post_warning();
            $response = array('status' => FALSE, 'message' => $message);
            $this->response($response, 400);
        }else{
            
            $identity = $this->input->post('identity');
            $password = $this->common_model->decryptPassword($this->input->post('password'));
            
            $option = array(
                'table' => 'qyura_users',
                'select' => '*',
                'where' => array('qyura_users.users_deleted' => 0,'qyura_users.users_email' => $identity,'qyura_usersRoles.usersRoles_roleId' => 6),
                'or_where'=>array('qyura_users.users_mobile' => $identity),
                'join' => array(
                    array('qyura_usersRoles', 'qyura_usersRoles.usersRoles_userId = qyura_users.users_id', 'left'),
                    array('qyura_patientDetails', 'qyura_patientDetails.patientDetails_usersId = qyura_users.users_id', 'left'),
                    array('qyura_userSocial', 'qyura_userSocial.userSocial_usersId = qyura_users.users_id', 'left'),
                ),
                'single'=>true
            );
            $userDetail = $this->common_model->customGet($option);
            
            
            
            if(isset($userDetail) && $userDetail != NULL){
                $passwordDB = $this->common_model->decryptPassword($userDetail->users_id,$this->input->post('password'));
                if(isset($passwordDB) && $passwordDB != NULL){
                    $userDetail->address = $userDetail->patientDetails_address;
                    $userDetail->dob = $userDetail->patientDetails_dob;
                    $userDetail->fbId = $userDetail->userSocial_fbId;
                    $userDetail->gender = $userDetail->patientDetails_gender;
                    $userDetail->gpId = $userDetail->users_gpId;
                    $userDetail->logintype = $userDetail->users_logintype;
                    $userDetail->notification = $userDetail->userSocial_notification;
                    $userDetail->pLastName = $userDetail->patientDetails_pLastName;
                    $userDetail->patientImg = $userDetail->patientDetails_patientImg;
                    $userDetail->patientName = $userDetail->patientDetails_patientName;
                    $userDetail->device = $userDetail->userSocial_device;
                    $userDetail->pUnqId = $userDetail->patientDetails_unqId;
                    $userDetail->pushToken = $userDetail->userSocial_pushToken;
                    $userDetail->scUsersId = $userDetail->userSocial_id;
                
                    $response = array('status' => TRUE, 'userDetail' => $userDetail, 'message' => 'Login successfull');
                    $this->response($response, 200);
                }else{
                    $response = array('status' => FALSE, 'message' => 'Password is Wrong');
                    $this->response($response, 400);
                }
            }else {
                $response = array('status' => FALSE, 'message' => 'User not Found');
                $this->response($response, 400);
            }
        }
    }

    function imageUpload_post() {
        $this->profImgPath = realpath(FCPATH . 'assets/proImg') . '/';
        $this->bf_form_validation->set_rules('userId', 'user id', 'required|numeric');
        $this->bf_form_validation->set_rules('image', 'Image', 'required');
        if ($this->bf_form_validation->run($this) === TRUE) {

            $img = isset($_POST['image']) ? createImage($this->input->post('image'), $this->profImgPath) : false;
            $image_name = $img ? $img : '';
            $userId = isset($_POST['userId']) ? $this->input->post('userId') : '';
            $userPatient['patientDetails_patientImg'] = $image_name;
            $this->db->update('qyura_patientDetails', $userPatient, array('patientDetails_usersId' => $userId));
            $imagePath = '';
            if (file_exists($this->profImgPath . $image_name)) {
                $imagePath = 'assets/proImg/' . $image_name;
            }

            $response = array('status' => TRUE, 'imgPath' => $imagePath, 'message' => 'Image Update successfully');
            $this->response($response, 200);
        } else {
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);
        }
    }

    function unsetUserConfidentialData($userDetail)
    {
        unset($userDetail->users_password);
        unset($userDetail->users_salt);
        unset($userDetail->users_activationCode);
        unset($userDetail->users_forgottenPasswordCode);
        unset($userDetail->users_forgottenPasswordTime);
        unset($userDetail->users_rememberCode);
        unset($userDetail->users_lastLogin);
        unset($userDetail->creationTime);
        unset($userDetail->modifyTime);
        unset($userDetail->status);
        unset($userDetail->id);

        if ($userDetail->pushToken == null)
            $userDetail->pushToken = '';

        if ($userDetail->device == null)
            $userDetail->device = '';

        if ($userDetail->gpId == null)
            $userDetail->gpId = '';

        if ($userDetail->fbId == null)
            $userDetail->fbId = '';
        
        return $userDetail;
    }
    
    function getUserDetailByIdentity($email = '', $mobile = '', $userId = null) {

        if ($userId != null) {
            $userDetail = $this->ion_auth_api->where('qyura_users.users_id', $userId)->where('qyura_users.users_deleted', 0)
                ->users()
                ->row();
        }
        else{
            $userDetail = $this->ion_auth_api->where('qyura_users.users_email', $email)->where('qyura_users.users_deleted', 0)
                ->or_where('qyura_users.users_mobile', $mobile)
                ->users()
                ->row();
        }



        unset($userDetail->users_password);
        unset($userDetail->users_salt);
        unset($userDetail->users_activationCode);
        unset($userDetail->users_forgottenPasswordCode);
        unset($userDetail->users_forgottenPasswordTime);
        unset($userDetail->users_rememberCode);
        unset($userDetail->users_lastLogin);
        unset($userDetail->creationTime);
        unset($userDetail->modifyTime);
        unset($userDetail->status);
        unset($userDetail->id);

        if ($userDetail->pushToken == null)
            $userDetail->pushToken = '';

        if ($userDetail->device == null)
            $userDetail->device = '';

        if ($userDetail->gpId == null)
            $userDetail->gpId = '';

        if ($userDetail->fbId == null)
            $userDetail->fbId = '';

        return $userDetail;
    }

    function resendOtp_post() {
        $this->bf_form_validation->set_rules('userId', 'user id', 'required|numeric');

        $this->bf_form_validation->set_rules('pushToken', 'push token', 'min_length[8]|max_length[255]|xss_clean');
        $this->bf_form_validation->set_rules('udid', 'udid', 'min_length[8]|max_length[255]|xss_clean');
        $this->bf_form_validation->set_rules('device', 'device', 'min_length[1]|max_length[1]|numeric|xss_clean');

        if ($this->bf_form_validation->run($this) === FALSE) {
            $message = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);
        } else {

            $userId = isset($_POST['userId']) ? $this->input->post('userId') : '';


            $userSocial['userSocial_pushToken'] = isset($_POST['pushToken']) ? $this->input->post('pushToken') : '';
            $userSocial['userSocial_udid'] = isset($_POST['udid']) ? $this->input->post('udid') : '';
            $userSocial['userSocial_device'] = isset($_POST['device']) ? $this->input->post('device') : '';

            $result = $this->ion_auth_api->otpCreate($userId);

            if ($result) {
                //$this->db->update('qyura_userSocial', $userSocial, array('userSocial_usersId' => $identity->users_id));
                $response = array('status' => TRUE, 'message' => $this->ion_auth_api->messages());
                $this->response($response, 200);
            } else {

                $response = array('status' => FALSE, 'message' => $this->ion_auth_api->errors());
                $this->response($response, 401);
            }
        }
    }

    public function insertUserProfile($users_id, $data = null) {


        $profData = array(
            'patientDetails_patientName' => $this->input->post('name'),
            'patientDetails_usersId' => $users_id,
            'patientDetails_dob' => isset($_POST['dob']) ? strtotime($this->input->post('dob')) : '',
            'patientDetails_gender' => isset($_POST['gender']) ? $this->input->post('gender') : '',
            'patientDetails_unqId' => 'PNT' . random_string('alnumnew', 6),
            'creationTime' => time()
        );

        $img = isset($_POST['image']) ? createImage($this->input->post('image'), $this->profImgPath) : false;
        $image_name = $img ? $img : '';
        $profData['patientDetails_patientImg'] = $image_name;

        if ($data != null && is_array($data))
            $profData = array_merge($profData, $data);


        return $this->ion_auth_api->setPatientProf($profData);
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

        return $this->ion_auth_api->setSocialProf($socialData);
    }

    function _alpha_dash_space($str_in = '') {

        if (!preg_match("/^([-a-zA-Z_ ])+$/i", $str_in)) {
            $this->bf_form_validation->set_message('_alpha_dash_space', 'The %s field may only contain alpha characters, spaces, underscores, and dashes.');

            return FALSE;
        } else {
            return TRUE;
        }
    }

    function userLoginDetail() {
        $userDetail = $this->ion_auth_api->login_user_data($this->input->post('identity'), $this->input->post('password'));

        if ($userDetail) {
            if ($userDetail->pushToken == null)
                $userDetail->pushToken = '';

            if ($userDetail->device == null)
                $userDetail->device = '';

            if ($userDetail->gpId == null)
                $userDetail->gpId = '';

            if ($userDetail->fbId == null)
                $userDetail->fbId = '';
            return $userDetail;
        }

        return new stdClass();
    }

    //activate the user

    function activate_get($id = null, $code = false) {
        if ($id == null)
            $id = $this->uri->segment(4);
        if ($code == false)
            $code = $this->uri->segment(5);

        $this->activate($id, $code);
    }

    //activate the user
    function activate($id, $code = false) {
        if ($code !== false) {
            $activation = $this->ion_auth_api->activate($id, $code);
        } else if ($this->ion_auth_api->is_admin()) {
            $activation = $this->ion_auth_api->activate($id);
        }

        if ($activation) {
            //redirect them to the auth page
            $this->session->set_flashdata('message', $this->ion_auth_api->messages());
            //echo $this->ion_auth_api->messages();
            $this->load->view('successActive');
            //redirect("auth", 'refresh');
        } else {
            //redirect them to the forgot password page
            $this->session->set_flashdata('message', $this->ion_auth_api->errors());
            $this->load->view('already_activated');
        }
    }

    //deactivate the user
    function deactivate($id = NULL) {
        if (!$this->ion_auth_api->logged_in() || !$this->ion_auth_api->is_admin()) {
            //redirect them to the home page because they must be an administrator to view this
            return show_error('You must be an administrator to view this page.');
        }

        $id = (int) $id;

        $this->load->library('form_validation');
        $this->bf_form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
        $this->bf_form_validation->set_rules('id', $this->lang->line('deactivate_validation_users_id_label'), 'required|alpha_numeric');

        if ($this->bf_form_validation->run($this) == FALSE) {
            // insert csrf check
            $this->data['csrf'] = $this->_get_csrf_nonce();
            $this->data['user'] = $this->ion_auth_api->user($id)->row();

            $this->_render_page('auth/deactivate_user', $this->data);
        } else {
            // do we really want to deactivate?
            if ($this->input->post('confirm') == 'yes') {
                // do we have a valid request?
                if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id')) {
                    show_error($this->lang->line('error_csrf'));
                }

                // do we have the right userlevel?
                if ($this->ion_auth_api->logged_in() && $this->ion_auth_api->is_admin()) {
                    $this->ion_auth_api->deactivate($id);
                }
            }

            //redirect them back to the auth page
            redirect('auth', 'refresh');
        }
    }

    //change password
    function change_password_post() {

        $this->bf_form_validation->set_rules('userId', 'user id', 'required|numeric|xss_clean');
        //|matches[new_confirm]
        $this->bf_form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'auth_conf_api') . ']|max_length[' . $this->config->item('max_password_length', 'auth_conf_api') . ']|xss_clean');
        //$this->bf_form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');
        //$this->bf_form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');

        if (isset($_POST['userId']))
            $user = $this->ion_auth_api->user($this->input->post('userId'))->row();

        if ($this->bf_form_validation->run($this) == false) {
            //display the form
            //set the flash data error message if there is one
            $message = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);
        } else {
            $identityCol = $this->config->item('identity', 'auth_conf_api');
            $identity = $user->$identityCol;

            //$change = $this->ion_auth_api->change_password($identity, $this->input->post('old'), $this->input->post('new'));
            $change = $this->ion_auth_api->change_password($identity, '', $this->input->post('new'));

            if ($change) {
                $response = array('status' => TRUE, 'message' => $this->ion_auth_api->messages());
                $this->response($response, 200);
            } else {
                //$this->session->set_flashdata('message', $this->ion_auth_api->errors());
                $response = array('status' => FALSE, 'message' => $this->ion_auth_api->errors());
                $this->response($response, 400);
            }
        }
    }

    //edit a user
    function edit_user_post() {

        $this->bf_form_validation->set_rules('name', 'name', 'required|callback__alpha_dash_space|max_length[80]|xss_clean');
        $this->bf_form_validation->set_rules('lname', 'last name', 'required|callback__alpha_dash_space|max_length[60]|xss_clean');
        $this->bf_form_validation->set_rules('logintype', 'logintype', 'required|min_length[1]|max_length[1]|numeric|xss_clean');
        $this->bf_form_validation->set_rules('mobileNo', 'mobileNo', 'required|min_length[10]|max_length[10]|numeric|xss_clean');
        $this->bf_form_validation->set_rules('userId', 'user id', 'required|numeric');

        $this->bf_form_validation->set_rules('dob', 'Date of Birth', 'trim|xss_clean|valid_date[y-m-d,-]');
        $this->bf_form_validation->set_rules('gender', 'Gender', 'trim|min_length[1]|max_length[1]|numeric|xss_clean');


        //$logintype = (int) $this->input->post('logintype');

        $this->bf_form_validation->set_rules('pwIsUpdate', 'pwIsUpdate', 'required|min_length[1]|max_length[1]|numeric|xss_clean');
        $this->bf_form_validation->set_rules('pushToken', 'push token', 'min_length[8]|max_length[255]|xss_clean');
        $this->bf_form_validation->set_rules('udid', 'udid', 'required|min_length[8]|max_length[255]|xss_clean');
        $this->bf_form_validation->set_rules('device', 'device', 'required|min_length[1]|max_length[1]|numeric|xss_clean');
        $this->bf_form_validation->set_rules('notification', 'notification', 'required|min_length[1]|max_length[1]|numeric|xss_clean');


        if (isset($_POST['userId'])) {
            $user = $this->ion_auth_api->user($_POST['userId'])->row();
            $currentGroups = $this->ion_auth_api->get_users_groups($_POST['userId'])->result();
        }

        //update the password if it was posted
        if (isset($_POST['pwIsUpdate']) && $_POST['pwIsUpdate']) {
            $this->bf_form_validation->set_rules('password', 'password', 'required|min_length[' . $this->config->item('min_password_length', 'auth_conf_api') . ']|max_length[' . $this->config->item('max_password_length', 'auth_conf_api') . ']|xss_clean');
        }

        if ($this->bf_form_validation->run($this) === TRUE) {
            $data = array(
                'modifyTime' => time()
            );

            if (isset($_POST['mobileNo']))
                $data['users_mobile'] = $this->input->post('mobileNo');



            //update the password if it was posted
            if (isset($_POST['pwIsUpdate']) && $_POST['pwIsUpdate'] == 1 && $this->input->post('password')) {
                $passwordData = $this->ion_auth_api->createPassword($this->input->post('password'));

                $data = array_merge($data, $passwordData);
            }

            //check to see if we are updating the user
            if ($this->ion_auth_api->update($user->users_id, $data)) {

                if (isset($_POST['lname']))
                    $patientData['patientDetails_pLastName'] = $this->input->post('lname');

                if (isset($_POST['name']))
                    $patientData['patientDetails_patientName'] = $this->input->post('name');

                if (isset($_POST['dob']))
                    $patientData['patientDetails_dob'] = strtotime ($this->input->post('dob'));

                if (isset($_POST['gender']))
                    $patientData['patientDetails_gender'] = $this->input->post('gender');

                $patientData['modifyTime'] = time();

                //check to see if we are updating the patient

                if ($this->ion_auth_api->patientUpdate($user->users_id, $patientData)) {

                    $userSocial['userSocial_notification'] = isset($_POST['notification']) ? $this->input->post('notification') : '';
                    $userSocial['userSocial_pushToken'] = isset($_POST['pushToken']) ? $this->input->post('pushToken') : '';
                    $userSocial['userSocial_udid'] = isset($_POST['udid']) ? $this->input->post('udid') : '';
                    $userSocial['userSocial_device'] = isset($_POST['device']) ? $this->input->post('device') : '';
                    $userSocial['modifyTime'] = time();

                    $this->db->update('qyura_userSocial', $userSocial, array('userSocial_usersId' => $user->users_id));

                    $update = $this->db->affected_rows() == 1;
                    
                    $user = $this->getUserDetailByIdentity('','',$user->users_id);
                    
                    $response = array('status' => TRUE, 'message' => $this->ion_auth_api->messages(), 'userDetail'=>$user);
                    
                    $this->response($response, 200);
                } else {

                    $response = array('status' => FALSE, 'message' => $this->ion_auth_api->errors());
                    $this->response($response, 400);
                }

                //redirect them back to the admin page if admin, or to the base url if non admin
            } else {
                //redirect them back to the admin page if admin, or to the base url if non admin
                $response = array('status' => FALSE, 'message' => $this->ion_auth_api->errors());
                $this->response($response, 400);
            }
        } else {
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);
        }
    }

    //forgot password
    function forgot_password_post() {
        //setting validation rules by checking wheather identity is username or email
        if ($this->config->item('identity', 'auth_conf_api') == 'users_username') {
            $this->bf_form_validation->set_rules('identity', $this->lang->line('forgot_password_username_identity_label'), 'required|xss_clean');
        } else {

            if (isset($_POST['identity']) && is_numeric($_POST['identity']))
                $this->bf_form_validation->set_rules('identity', 'Mobile No', 'required|min_length[10]|max_length[10]|numeric|xss_clean');
            else
                $this->bf_form_validation->set_rules('identity', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email|xss_clean');
        }


        if ($this->bf_form_validation->run($this) == false) {
            //setup the input
            //set any errors and display the form
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);
        } else {
            // get identity from username or email


            if ($this->config->item('identity', 'auth_conf_api') == 'users_username') {
                $identity = $this->ion_auth_api->where('users_username', strtolower($this->input->post('email')))->where('users_deleted', 0)->users()->row();
            } else {
                $identity = $this->ion_auth_api->where('users_email', strtolower($this->input->post('identity')))->where('users_deleted', 0)->or_where('qyura_users.users_mobile', $this->input->post('identity'))->users()->row();
            }
            if (empty($identity)) {

                if ($this->config->item('identity', 'auth_conf_api') == 'users_username') {
                    $this->ion_auth_api->set_message('forgot_password_username_not_found');
                } else {
                    $this->ion_auth_api->set_message('forgot_password_email_not_found');
                }

                $this->session->set_flashdata('message', $this->ion_auth_api->messages());
                $response = array('status' => TRUE, 'message' => $this->ion_auth_api->messages());
                $this->response($response, 200);
            }

            //run the forgotten password method to email an activation code to the user
            $forgotten = $this->ion_auth_api->forgotten_password($identity->{$this->config->item('identity', 'auth_conf_api')});

            if ($forgotten) {
                //if there were no errors
                $this->session->set_flashdata('message', $this->ion_auth_api->messages());
                //redirect("auth/login", 'refresh'); //we should display a confirmation page here instead of the login page
                $response = array('status' => TRUE, 'message' => $this->ion_auth_api->messages());
                $this->response($response, 200);
            } else {
                $this->session->set_flashdata('message', $this->ion_auth_api->errors());
                //redirect("auth/forgot_password", 'refresh');
                $response = array('status' => FALSE, 'message' => $this->ion_auth_api->errors());
                $this->response($response, 400);
            }
        }
    }

    //reset password - final step for forgotten password
    public function reset_password($code = NULL) {
        if (!$code) {
            show_404();
        }

        $user = $this->ion_auth_api->forgotten_password_check($code);

        if ($user) {
            //if the code is valid then display the password reset form

            $this->bf_form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
            $this->bf_form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

            if ($this->bf_form_validation->run($this) == false) {
                //display the form
                //set the flash data error message if there is one
                $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

                $this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
                $this->data['new_password'] = array(
                    'name' => 'new',
                    'id' => 'new',
                    'type' => 'password',
                    'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
                );
                $this->data['new_password_confirm'] = array(
                    'name' => 'new_confirm',
                    'id' => 'new_confirm',
                    'type' => 'password',
                    'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
                );
                $this->data['user_id'] = array(
                    'name' => 'user_id',
                    'id' => 'user_id',
                    'type' => 'hidden',
                    'value' => $user->id,
                );
                $this->data['csrf'] = $this->_get_csrf_nonce();
                $this->data['code'] = $code;

                //render
                $this->_render_page('auth/reset_password', $this->data);
            } else {
                // do we have a valid request?
                if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id')) {

                    //something fishy might be up
                    $this->ion_auth_api->clear_forgotten_password_code($code);

                    show_error($this->lang->line('error_csrf'));
                } else {
                    // finally change the password
                    $identity = $user->{$this->config->item('identity', 'auth_conf_api')};

                    $change = $this->ion_auth_api->reset_password($identity, $this->input->post('new'));

                    if ($change) {
                        //if the password was successfully changed
                        $this->session->set_flashdata('message', $this->ion_auth_api->messages());
                        redirect("auth/login", 'refresh');
                    } else {
                        $this->session->set_flashdata('message', $this->ion_auth_api->errors());
                        redirect('auth/reset_password/' . $code, 'refresh');
                    }
                }
            }
        } else {
            //if the code is invalid then send them back to the forgot password page
            $this->session->set_flashdata('message', $this->ion_auth_api->errors());
            redirect("auth/forgot_password", 'refresh');
        }
    }

    function _get_csrf_nonce() {
        $this->load->helper('string');
        $key = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);

        return array($key => $value);
    }

    function _valid_csrf_nonce() {
        if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
                $this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue')) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function _render_page($view, $data = null, $render = false) {

        $this->viewdata = (empty($data)) ? $this->data : $data;

        $view_html = $this->load->view($view, $this->viewdata, $render);

        if (!$render)
            return $view_html;
    }

function send_mail_user($from,$to,$subject,$title,$msg) {

        $config = array(
            'charset' => 'utf-8',
            'wordwrap' => TRUE,
            'mailtype' => 'html',
            'protocol' => 'sendmail',
            'mailpath' => '/usr/sbin/sendmail',
        );

        $this->email->initialize($config);

        $this->email->to($to);
        $this->email->from($from,$title);
        $this->email->subject($subject);
        $this->email->message($msg);
        $mail = $this->email->send();
        if ($mail)
            return true;
        else {
            return FALSE;
            show_error($this->email->print_debugger());
        }
    }

}
