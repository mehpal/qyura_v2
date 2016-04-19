<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bloodbank extends MY_Controller {

    public $error_message = '';

    public function __construct() {
        parent:: __construct();
        // $this->load->library('form_validation');
        $this->load->model('Bloodbank_model');
    }

    function index() {
        $data = array();
        $data['allStates'] = $this->Bloodbank_model->fetchStates();
        $data['bloodBankData'] = $this->Bloodbank_model->fetchbloodBankData();
        $this->load->super_admin_template('bloodBankList', $data, 'bloodBankScript');
    }

    /**
     * @project Qyura
     * @method getBloodBankDl
     * @description get records in listing using datatables
     * @access public
     * @return array
     */
    function getBloodBankDl() {
        echo $this->Bloodbank_model->fetchbloodBankDataTables();
    }

    /**
     * @project Qyura
     * @method array
     * @description add blood bank view form
     * @access public
     */
    function Addbloodbank() {
        $data = array();
        $data['allStates'] = $this->Bloodbank_model->fetchStates();
        $this->load->super_admin_template('Addbloodbank', $data, 'bloodBankScript');
    }

    /**
     * @project Qyura
     * @method detailBloodBank
     * @description detail blood bank
     * @access public
     * @param bloodBankId
     * @return array
     */
    function detailBloodBank($bloodBankId = '') {
        $data = array();
        $data['bloodBankData'] = $this->Bloodbank_model->fetchbloodBankData($bloodBankId);
        $data['bloodBankId'] = $bloodBankId;
        $data['showStatus'] = 'none';
        $data['detailShow'] = 'block';
        $this->load->super_admin_template('bloodBankDetail', $data, 'bloodBankScript');
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
        $cityData = $this->Bloodbank_model->fetchCity($stateId);
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
     * @method SaveBloodbank
     * @description add blood bank records
     * @access public
     * @return boolean
     */
    function SaveBloodbank() {

        $this->bf_form_validation->set_rules('bloodBank_name', 'BloodBank Name', 'required|trim');

        $this->bf_form_validation->set_rules('countryId', 'Bloodbank Country', 'required|trim');
        $this->bf_form_validation->set_rules('stateId', 'BloodBank StateId', 'required|trim');
        $this->bf_form_validation->set_rules('cityId', 'BloodBank City', 'required|trim');

        $this->bf_form_validation->set_rules('bloodBank_mblNo', 'BloodBank Mobile No', 'required|trim');
        $this->bf_form_validation->set_rules('bloodBank_zip', 'BloodBank Zip', 'required|trim');
        $this->bf_form_validation->set_rules('bloodBank_add', 'BloodBank Address', 'required|trim');
        $this->bf_form_validation->set_rules('bloodBank_cntPrsn', 'Contact Person', 'required|trim');
        $this->bf_form_validation->set_rules('bloodBank_mbrTyp', 'Membership Type', 'required|trim');
        $this->bf_form_validation->set_rules('users_email', 'Users Email', 'required|valid_email|trim');
        $this->bf_form_validation->set_rules('users_password', 'Password', 'trim|required|matches[cnfPassword]');
        $this->bf_form_validation->set_rules('cnfPassword', 'Password Confirmation', 'trim|required');
        if (empty($_FILES['avatar_file']['name'])) {
            $this->bf_form_validation->set_rules('avatar_file', 'File', 'required');
        }
        if ($this->bf_form_validation->run($this) === FALSE) {
            $data = array();
            $data['allStates'] = $this->Bloodbank_model->fetchStates();
            $this->load->super_admin_template('Addbloodbank', $data, 'bloodBankScript');
            return false;
        } else {
            $imagesname = "";
            if ($_FILES['avatar_file']['name']) {
                $path = realpath(FCPATH . 'assets/BloodBank/');
                $upload_data = $this->input->post('avatar_data');
                $upload_data = json_decode($upload_data);
                $original_imagesname = $this->uploadImageWithThumb($upload_data, 'avatar_file', $path, 'assets/BloodBank/', './assets/BloodBank/thumb/','blood');

                if (empty($original_imagesname)) {
                    $data['allStates'] = $this->Bloodbank_model->fetchStates();
                    $this->session->set_flashdata('valid_upload', $this->error_message);
                    $this->load->super_admin_template('Addbloodbank', $data, 'bloodBankScript');
                    return false;
                } else {
                    $imagesname = $original_imagesname;
                }
            }


            $bloodBank_phn = $this->input->post('bloodBank_phn');
            $pre_number = $this->input->post('pre_number');
            //$countPnone = $this->input->post('bloodBank_phn');

            $finalNumber = '';
            for ($i = 0; $i < count($pre_number); $i++) {
                if ($bloodBank_phn[$i] != '' && $pre_number[$i] != '') {
                    $finalNumber .= $pre_number[$i] . ' ' . $bloodBank_phn[$i] . '|';
                }
            }

            // echo $finalNumber.'===';
            //exit();
            $bloodBank_name = $this->input->post('bloodBank_name');
            $countryId = $this->input->post('countryId');
            $stateId = $this->input->post('stateId');
            $cityId = $this->input->post('cityId');
            $bloodBank_add = $this->input->post('bloodBank_add');

            $bloodBank_cntPrsn = $this->input->post('bloodBank_cntPrsn');
            $bloodBank_mbrTyp = $this->input->post('bloodBank_mbrTyp');
            $isEmergency = $this->input->post('isEmergency');
            $bloodBank_zip = $this->input->post('bloodBank_zip');


            $users_email = $this->input->post('users_email');
            $users_password = md5($this->input->post('users_password'));
            $bloodBankInsert = array(
                'users_email' => $users_email,
                'users_password' => $users_password,
                'users_ip_address' => $this->input->ip_address(),
                'users_mobile' => $this->input->post('bloodBank_mblNo')
            );
            $bloodbank_usersId = $this->Bloodbank_model->insertBloodBankUser($bloodBankInsert);
            if ($bloodbank_usersId) {

                $insertusersRoles = array(
                    'usersRoles_userId' => $bloodbank_usersId,
                    'usersRoles_roleId' => 2,
                    'usersRoles_parentId' => 0,
                    'creationTime' => strtotime(date("Y-m-d H:i:s"))
                );
                $this->Bloodbank_model->insertUsersRoles($insertusersRoles);


                $insertData = array(
                    'bloodBank_name' => $bloodBank_name,
                    'countryId' => $countryId,
                    'stateId' => $stateId,
                    'cityId' => $cityId,
                    'bloodBank_add' => $bloodBank_add,
                    'bloodBank_cntPrsn' => $bloodBank_cntPrsn,
                    'bloodBank_mbrTyp' => $bloodBank_mbrTyp,
                    'isEmergency' => $isEmergency,
                    'bloodBank_zip' => $bloodBank_zip,
                    'bloodBank_photo' => $imagesname,
                    'creationTime' => strtotime(date("Y-m-d H:i:s")),
                    'bloodBank_phn' => $finalNumber,
                    'bloodBank_lat' => $this->input->post('lat'),
                    'bloodBank_long' => $this->input->post('lng'),
                    'users_id' => $bloodbank_usersId
                );

                $bloodBankId = $this->Bloodbank_model->insertBloodBank($insertData);
            }
            $this->session->set_flashdata('message', 'Data inserted successfully !');
            redirect('bloodbank/Addbloodbank');
        }
    }

    /**
     * @project Qyura
     * @method check_email
     * @description check email if exists or not
     * @access public
     * @param users_email
     * @return boolean
     */
    function check_email() {
        $user_table_id = '';
        $users_email = $this->input->post('users_email');

        if (isset($_POST['user_table_id'])) {
            $user_table_id = $this->input->post('user_table_id');
        }
        $email = $this->Bloodbank_model->fetchEmail($users_email, $user_table_id);
        echo $email;
        exit;
    }

    /**
     * @project Qyura
     * @method saveDetailBloodBank
     * @description update bloodbank detail
     * @access public
     * @param bloodBankId
     * @return boolean
     */
    function saveDetailBloodBank($bloodBankId) {

        $this->bf_form_validation->set_rules('bloodBank_name', 'BloodBank Name', 'required|trim');

        $this->bf_form_validation->set_rules('bloodBank_add', 'Bloodbank Address', 'required|trim');
        $this->bf_form_validation->set_rules('users_email', 'Users Email', 'required|valid_email|trim');
        $this->bf_form_validation->set_rules('bloodBank_cntPrsn', 'BloodBank Contact Person', 'required|trim');
        if ($this->bf_form_validation->run() === FALSE) {

            $data = array();
            $data['bloodBankData'] = $this->Bloodbank_model->fetchbloodBankData($bloodBankId);
            $data['bloodBankId'] = $bloodBankId;
            $data['showStatus'] = 'block';
            $data['detailShow'] = 'none';
            // $this->load->view('bloodBankDetail', $data);
            $this->load->super_admin_template('bloodBankDetail', $data, 'bloodBankScript');
        } else {
            $bloodBank_phn = $this->input->post('bloodBank_phn');
            $pre_number = $this->input->post('pre_number');
            //$countPnone = $this->input->post('countPnone');

            $finalNumber = '';
            for ($i = 0; $i < count($bloodBank_phn); $i++) {
                if ($bloodBank_phn[$i] != '' && $pre_number[$i] != '') {
                    $finalNumber .= $pre_number[$i] . ' ' . $bloodBank_phn[$i] . '|';
                }
            }

            $updateBloodBank = array(
                'bloodBank_name' => $this->input->post('bloodBank_name'),
                'bloodBank_add' => $this->input->post('bloodBank_add'),
                'bloodBank_phn' => $finalNumber,
                'bloodBank_cntPrsn' => $this->input->post('bloodBank_cntPrsn'),
                'bloodBank_lat' => $this->input->post('lat'),
                'bloodBank_long' => $this->input->post('lng'),
                'modifyTime' => strtotime(date("Y-m-d H:i:s"))
            );

            $where = array(
                'bloodBank_id' => $bloodBankId
            );
            $response = '';
            $response = $this->Bloodbank_model->UpdateTableData($updateBloodBank, $where, 'qyura_bloodBank');
            if ($response) {
                $updateUserdata = array(
                    'users_email' => $this->input->post('users_email'),
                    'modifyTime' => strtotime(date("Y-m-d H:i:s"))
                );
                $whereUser = array(
                    'users_id' => $this->input->post('user_tables_id')
                );
                $response = $this->Bloodbank_model->UpdateTableData($updateUserdata, $whereUser, 'qyura_users');
                if ($response) {
                    $this->session->set_flashdata('message', 'Data updated successfully !');
                    redirect("bloodbank/detailBloodBank/$bloodBankId");
                }
            }
        }
    }

    /**
     * @project Qyura
     * @method updatePassword
     * @description update password bloodbank
     * @access public
     * @return boolean
     */
    function updatePassword() {
        //echo "here";exit;
        $currentPassword = $this->input->post('currentPassword');
        //$existingPassword = $this->input->post('existingPassword');
        $user_tables_id = $this->input->post('user_tables_id');

        $encrypted = md5($currentPassword);
        $return = 0;
        /* if($encrypted != $existingPassword){
          echo $return;
          }
          else {
          $updateBloodBank = array(
          'bloodBank_name'=>  $encrypted,
          'modifyTime'=> strtotime(date("Y-m-d H:i:s"))
          );

          $where = array(
          'users_id' => $user_tables_id
          );
          $this->Bloodbank_model->UpdateTableData($updateBloodBank,$where,'qyura_users');

          echo $return = '1'.'~'.$encrypted;
          } */

        $updateBloodBank = array(
            'users_password' => $encrypted,
            'modifyTime' => strtotime(date("Y-m-d H:i:s"))
        );

        $where = array(
            'users_id' => $user_tables_id
        );
        $return = $this->Bloodbank_model->UpdateTableData($updateBloodBank, $where, 'qyura_users');

        echo $return;
        //echo $encrypted;
        exit;
    }

    /**
     * @project Qyura
     * @method editUploadImage
     * @description update details page image profile
     * @access public
     * @return boolean
     */
    function editUploadImage() {

        if ($_POST['avatar_file']['name']) {
            $path = realpath(FCPATH . 'assets/BloodBank/');
            $upload_data = $this->input->post('avatar_data');
            $upload_data = json_decode($upload_data);

            $original_imagesname = $this->uploadImageWithThumb($upload_data, 'avatar_file', $path, 'assets/BloodBank/', './assets/BloodBank/thumb/','blood');

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
                $response = $this->Bloodbank_model->UpdateTableData($option, $where, 'qyura_bloodBank');
                if ($response) {
                    $response = array('state' => 200, 'message' => 'Successfully update avtar');
                } else {
                    $response = array('state' => 400, 'message' => 'Failed to update avtar');
                }
            }
            echo json_encode($response);
        } else {
            $response = array('state' => 400, 'message' => 'Please select avtar');
            echo json_encode($response);
        }
    }
    function getUpdateAvtar($bloodBankId){
        if(!empty($bloodBankId)){
          $data = $this->Bloodbank_model->fetchbloodBankData($bloodBankId);
          echo "<img src='".base_url()."assets/BloodBank/thumb/original/".$data[0]->bloodBank_photo."'alt='' class='logo-img' />";
          exit();
        }
    }

    function uploadImages($imageName, $folderName, $newName) {
        $path = realpath(FCPATH . 'assets/' . $folderName . '/');
        $config['upload_path'] = $path;
        //echo $config['upload_path']; 
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '5000';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';
        $config['file_name'] = $newName;
        //$field_name = $_FILES['hospital_photo']['name'];

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $this->upload->do_upload($imageName);
        return TRUE;
    }

    function getImageBase64Code($img) {
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $img = str_replace('[removed]', '', $img);
        $data = base64_decode($img);
        return $data;
    }

}
