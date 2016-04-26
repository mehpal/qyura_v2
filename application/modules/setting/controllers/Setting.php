<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends MY_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->model(array('Setting_model',"common_model"));
    }

    function index() {
       
        $userid = $this->session->userdata("ses_sa_userid");
        if(!$userid)
            $userid = 63;
        $data['allStates'] = $this->Setting_model->fetchStates();
        $data['users'] = $users = $this->Setting_model->getAdmin($userid);
       // print_r( $data['users']);  exit;
        $statId = 0;
        if (!empty($users[0]->patientDetails_stateId) && isset($users[0]->patientDetails_stateId)) {
            $statId = $users[0]->patientDetails_stateId;
        }

        $option = array(
            'table' => 'qyura_city',
            'where' => array('city_stateid' => $statId)
        );

        $data['cityData'] = $this->common_model->customGet($option);

        $data['title'] = 'Setting';
        $this->load->super_admin_template('settingsView', $data, 'settingScript');
    }

    function fetchCity() {
        //echo "fdadas";exit;
        $stateId = $this->input->post('stateId');
        $cityData = $this->Setting_model->fetchCity($stateId);
        $cityOption = '';
        $cityOption .='<option value=>Select Your City</option>';
        foreach ($cityData as $key => $val) {
            $cityOption .= '<option value=' . $val->city_id . '>' . strtoupper($val->city_name) . '</option>';
        }
        echo $cityOption;
        exit;
    }

    function config($userId=NULL) {
       
        $imagesname = '';
     
        $userImage = $this->input->post('userProfile');
      
        
        if ($_FILES['avatar_file']['name']) {
            $path = realpath(FCPATH . 'assets/patientImages/');
            $upload_data = $this->input->post('avatar_data');
            $upload_data = json_decode($upload_data);

            $original_imagesname = $this->uploadImageWithThumb($upload_data, 'avatar_file', $path,'assets/patientImages/', './assets/patientImages/thumb/', 'patient');
            
           // $details["patientDetails_patientImg"] = $original_imagesname;
            $this->session->set_userdata("ses_sa_image",$original_imagesname);
            if (empty($original_imagesname)) {
                $data = array();
                
                $this->session->set_flashdata('valid_upload', $this->error_message);
               redirect("setting");
                return false;
            } else {
                $imagesname = $original_imagesname;
            }
        }else{
            $imagesname = $userImage;
        }
        
        $details = array(
            'patientDetails_patientName' => $this->input->post('user_name'),
            'patientDetails_countryId' => $this->input->post('setting_countryId'),
            'patientDetails_stateId' => $this->input->post('setting_stateId'),
            'patientDetails_cityId' => $this->input->post('setting_cityId'),
            'patientDetails_pin' => $this->input->post('zip'),
            'patientDetails_address' => $this->input->post('address'),
            'patientDetails_dob' => strtotime($this->input->post('dob')),
            'patientDetails_patientImg' => $imagesname
        );

        $password = $this->input->post('users_password');
        $cPassword = $this->input->post('cnfPassword');
        if (!empty($password) && !empty($cPassword) && $password == $cPassword) {
            $user = array(
                'users_mobile' => $this->input->post('users_mobile'),
                'users_password' => $this->common_model->encryptPassword($password)
            );
        } else {

            $user = array(
                'users_mobile' => $this->input->post('users_mobile')
            );
        }

        $option = array(
            'table' => 'qyura_users',
            'data' => $user,
            'where' => array('users_id' => $userId)
        );
        $this->common_model->customUpdate($option);

        

        $option = array(
            'table' => 'qyura_patientDetails',
            'data' => $details,
            'where' => array('patientDetails_usersId' => $userId)
        );

        $response = $this->common_model->customUpdate($option);
        
        if ($response) {
            $this->session->set_flashdata('message', 'Your profile successfully update.');
            redirect('setting');
        } else {
            $this->session->set_flashdata('error', 'Your profile failed to update.');
            redirect('setting');
        }
    }    
}
