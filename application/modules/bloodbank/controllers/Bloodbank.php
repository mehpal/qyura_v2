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
        $data['city'] = $this->getCityByMI(1);
        $data['title'] = 'BloodBank';
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
     * @method checkExisting
     * @description get records in listing using datatables
     * @access public
     * @return array
     */
    function checkExisting() {
        $emailId = $this->input->post('emailId');
        $this->Bloodbank_model->checkExisting($emailId);
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
        $data['title'] = 'Add BloodBank';
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
        $data['bloodBankData'] = $bloodBankData = $this->Bloodbank_model->fetchbloodBankData($bloodBankId);
        $data['bloodBankId'] = $bloodBankId;
        $bllodBankSelect = array('users_id');
        $bllodBankCondition = array('bloodBank_id' => $bloodBankId);
        $Blooddata = $this->Bloodbank_model->fetchTableData($bllodBankSelect, 'qyura_bloodBank', $bllodBankCondition);
        $conditions = array();
        // print_r($data['bloodBankData']); exit;
        $data['allCountry'] = $this->Bloodbank_model->fetchCountry();
        $data['allStates'] = $this->Bloodbank_model->fetchStates($data['bloodBankData'][0]->countryId);
        $data['allCities'] = $this->Bloodbank_model->fetchCity($data['bloodBankData'][0]->stateId);

        $conditions['Bllcat.bloodBank_id'] = $Blooddata[0]->users_id;
        $conditions['Blood.bloodCat_deleted'] = 0;
        $select = array('Bllcat.bloodCatBank_id', 'Bllcat.bloodCatBank_Unit', 'Blood.bloodCat_name');
        $data['bloodBankCatData'] = $this->Bloodbank_model->fetchbloodBankCategoryData($conditions);  
        $mi_userId="";
        if(!empty($bloodBankData)):
         $mi_userId = $bloodBankData[0]->users_id;
        endif;
        $option = array(
            'select' => '*',
            'table'=> 'qyura_miTimeSlot',
            'where'=> array('mi_user_id' => $mi_userId),
        );
        $data['timeSlot'] = $this->common_model->customGet($option);
        $data['showStatus'] = 'none';
        $data['detailShow'] = 'block';
        $data['title'] = 'BloodBank';
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
        //$cityOption .='<option value=>Select Your City</option>';
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

        $this->bf_form_validation->set_rules('bloodbank_docatId', 'Docat Id', 'required|trim');

        $this->bf_form_validation->set_rules('bloodBank_zip', 'BloodBank Zip', 'required|trim');
        $this->bf_form_validation->set_rules('bloodBank_add', 'BloodBank Address', 'required|trim');
        $this->bf_form_validation->set_rules('bloodBank_cntPrsn', 'Contact Person', 'required|trim');
        $this->bf_form_validation->set_rules('bloodBank_mbrTyp', 'Membership Type', 'required|trim');
        $this->bf_form_validation->set_rules('users_email', 'Users Email', 'required|valid_email|trim|callback__checkUserExist');
        $this->bf_form_validation->set_rules('users_password', 'Password', 'trim|required|matches[cnfPassword]');
        $this->bf_form_validation->set_rules('cnfPassword', 'Password Confirmation', 'trim|required');

        $this->bf_form_validation->set_rules('lat', 'Latitude', 'required|trim');
        $this->bf_form_validation->set_rules('lng', 'Longitude', 'required|trim');

        $this->bf_form_validation->set_rules('isManual', 'Is manual', 'required|trim');
        // $this->bf_form_validation->set_rules('midNumber[]', 'STD code', 'required|trim');
        $this->bf_form_validation->set_rules('bloodBank_phn', 'Phon Number', 'required|trim');

        if (empty($_FILES['avatar_file']['name'])) {
            $this->bf_form_validation->set_rules('avatar_file', 'File', 'required');
        }

        if ($this->bf_form_validation->run($this) === FALSE) {
            $data = array();

            // echo validation_errors(); exit;
            $data['allStates'] = $this->Bloodbank_model->fetchStates();

            $stateId = $this->input->post('stateId');
            if ($stateId != '') {
                $data['allCities'] = $this->Bloodbank_model->fetchCity($stateId);
            }
            $data['title'] = 'Add BloodBank';
            $this->load->super_admin_template('Addbloodbank', $data, 'bloodBankScript');
            return false;
        } else {
            $imagesname = "";
            if ($_FILES['avatar_file']['name']) {
                $path = realpath(FCPATH . 'assets/BloodBank/');
                $upload_data = $this->input->post('avatar_data');
                $upload_data = json_decode($upload_data);

                $original_imagesname = $this->uploadImageWithThumb($upload_data, 'avatar_file', $path, 'assets/BloodBank/', './assets/BloodBank/thumb/', 'blood');

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
            $docatId = $this->input->post('bloodbank_docatId');
            $bloodBank_name = $this->input->post('bloodBank_name');
            $countryId = $this->input->post('countryId');
            $stateId = $this->input->post('stateId');
            $cityId = $this->input->post('cityId');
            $bloodBank_add = $this->input->post('bloodBank_add');

            $bloodBank_cntPrsn = $this->input->post('bloodBank_cntPrsn');
            $bloodBank_mbrTyp = $this->input->post('bloodBank_mbrTyp');
            $isEmergency = $this->input->post('isEmergency');
            $bloodBank_zip = $this->input->post('bloodBank_zip');

            //$bloodBank_mbl = $this->input->post('bloodBank_mbl');

            $userId = $this->input->post('userId');
            if ($userId == '') {
                $users_email = $this->input->post('users_email');
                $users_password = md5($this->input->post('users_password'));
                $bloodBankInsert = array(
                    'users_email' => $users_email,
                    'users_password' => $this->common_model->encryptPassword($users_password),
                    'users_ip_address' => $this->input->ip_address(),
                    'users_mobile' => $this->input->post('bloodBank_mblNo'),
                    'creationTime' => strtotime(date("Y-m-d H:i:s"))
                );
                $bloodbank_usersId = $this->Bloodbank_model->insertBloodBankUser($bloodBankInsert);
                $usersRoles_parentId = 0;
                $usersRoles_parentRole = 0;
            } else {
                $bloodbank_usersId = $userId;
                $usersRoles_parentId = $userId;
                $usersRoles_parentRole = ROLE_HOSPITAL;
            }
            if ($bloodbank_usersId) {

                $insertusersRoles = array(
                    'usersRoles_userId' => $bloodbank_usersId,
                    'usersRoles_roleId' => ROLE_BLOODBANK,
                    'usersRoles_parentId' => $usersRoles_parentId,
                    'usersRoles_parentRole' => $usersRoles_parentRole,
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
                    'bloodBank_docatId' => $docatId,
                    'bloodBank_photo' => $imagesname,
                    'bloodBank_isManual' => $this->input->post('isManual'),
                    'creationTime' => strtotime(date("Y-m-d H:i:s")),
                    'bloodBank_phn' => $bloodBank_phn,
                    'bloodBank_lat' => $this->input->post('lat'),
                    'bloodBank_long' => $this->input->post('lng'),
                    'users_id' => $bloodbank_usersId,
                    'status' => 0
                );
                $bloodBankId = $this->Bloodbank_model->insertBloodBank($insertData);
                $conditions = array();
                $conditions['bloodCat_deleted'] = 0;
                $select = array('bloodCat_name', 'bloodCat_id');
                $bloodBankCatData = $this->Bloodbank_model->fetchTableData($select, 'qyura_bloodCat', $conditions);

                foreach ($bloodBankCatData as $key => $val) {
                    $bloodCatData = array(
                        'bloodBank_id' => $bloodbank_usersId,
                        'bloodCats_id' => $val->bloodCat_id,
                        'bloodCatBank_Unit' => 0,
                        'creationTime' => strtotime(date("Y-m-d H:i:s"))
                    );
                    $this->Bloodbank_model->insertTableData('qyura_bloodCatBank', $bloodCatData);
                    $bloodCatData = '';
                }
            }
            $this->session->set_flashdata('message', 'Data inserted successfully !');
            redirect('bloodbank');
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
        if ($email == 1)
            echo $email;
        else {
            $select = array('users_id');
            $where = array('users_email' => $users_email,
                'users_deleted' => 0);
            $return = $this->Bloodbank_model->fetchTableData($select, 'qyura_users', $where);
            $data = 0;
            if (!empty($return)) {
                $data = $return[0]->users_id;
                echo $data;
            } else {
                echo $data;
            }
        }
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
        $this->bf_form_validation->set_rules('bloodbank_docatId', 'Docat Id', 'required|trim');
        $this->bf_form_validation->set_rules('bloodBank_add', 'Bloodbank Address', 'required|trim');
        $this->bf_form_validation->set_rules('users_email', 'Users Email', 'required|valid_email|trim');
        $this->bf_form_validation->set_rules('bloodBank_cntPrsn', 'BloodBank Contact Person', 'required|trim');

        $this->bf_form_validation->set_rules('bloodBank_mbl', 'mobile no', 'trim|max_length[10]|min_length[10]');

        $this->bf_form_validation->set_rules('lat', 'Latitude', 'required|trim');
        $this->bf_form_validation->set_rules('lng', 'Longitude', 'required|trim');

        $this->bf_form_validation->set_rules('isManual', 'Is manual', 'required|trim');


        $this->bf_form_validation->set_rules('countryId', 'Bloodbank Country', 'required|trim');
        $this->bf_form_validation->set_rules('stateId', 'BloodBank StateId', 'required|trim');
        $this->bf_form_validation->set_rules('cityId', 'BloodBank City', 'required|trim');

        if ($this->bf_form_validation->run() === FALSE) {

            $data = array();
            /* $data['bloodBankData'] = $this->Bloodbank_model->fetchbloodBankData($bloodBankId);
              $data['bloodBankId'] = $bloodBankId; */
            $data['showStatus'] = 'block';
            $data['detailShow'] = 'none';

            $data['bloodBankData'] = $this->Bloodbank_model->fetchbloodBankData($bloodBankId);
            $data['bloodBankId'] = $bloodBankId;
            $bllodBankSelect = array('users_id');
            $bllodBankCondition = array('bloodBank_id' => $bloodBankId);
            $Blooddata = $this->Bloodbank_model->fetchTableData($bllodBankSelect, 'qyura_bloodBank', $bllodBankCondition);
            $conditions = array();

            $conditions['Bllcat.bloodBank_id'] = $Blooddata[0]->users_id;
            $conditions['Blood.bloodCat_deleted'] = 0;
            $select = array('Bllcat.bloodCatBank_id', 'Bllcat.bloodCatBank_Unit', 'Blood.bloodCat_name');
            $data['bloodBankCatData'] = $this->Bloodbank_model->fetchbloodBankCategoryData($conditions);


            $data['title'] = 'BloodBank';
            // $this->load->view('bloodBankDetail', $data);
            $this->load->super_admin_template('bloodBankDetail', $data, 'bloodBankScript');
        } else {
            $bloodBank_phn = $this->input->post('bloodBank_phn');



            $docatId = $this->input->post('bloodbank_docatId');

            $updateBloodBank = array(
                'bloodBank_name' => $this->input->post('bloodBank_name'),
                'bloodBank_add' => $this->input->post('bloodBank_add'),
                'bloodBank_phn' => $bloodBank_phn,
                'bloodBank_cntPrsn' => $this->input->post('bloodBank_cntPrsn'),
                'bloodBank_mbl' => $this->input->post('bloodBank_mbl'),
                'bloodBank_lat' => $this->input->post('lat'),
                'bloodBank_long' => $this->input->post('lng'),
                'bloodBank_docatId' => $docatId,
                'countryId' => $this->input->post('countryId'),
                'stateId' => $this->input->post('stateId'),
                'cityId' => $this->input->post('cityId'),
                'bloodBank_isManual' => $this->input->post('isManual'),
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

        $encrypted = $this->common_model->encryptPassword($currentPassword);
        $return = 0;

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
            if ($upload_data->width > 120) {
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
                    $response = $this->Bloodbank_model->UpdateTableData($option, $where, 'qyura_bloodBank');
                    if ($response) {
                        $response = array('state' => 200, 'message' => 'Successfully update avtar');
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

    function getUpdateAvtar($bloodBankId) {
        if (!empty($bloodBankId)) {
            $data = $this->Bloodbank_model->fetchbloodBankData($bloodBankId);
            echo "<img src='" . base_url() . "assets/BloodBank/thumb/original/" . $data[0]->bloodBank_photo . "'alt='' class='logo-img' />";
            exit();
        }
    }

    function getImageBase64Code($img) {
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $img = str_replace('[removed]', '', $img);
        $data = base64_decode($img);
        return $data;
    }

    function bloodUnitUpdate() {
        $bloodCatBank_id = $this->input->post('bloodCatBank_id');
        $bloodCatBank_Unit = $this->input->post('bloodCatBank_Unit');
        $updateBloodBank = array(
            'bloodCatBank_Unit' => $bloodCatBank_Unit,
            'modifyTime' => strtotime(date("Y-m-d H:i:s"))
        );

        $where = array(
            'bloodCatBank_id' => $bloodCatBank_id
        );
        $return = $this->Bloodbank_model->UpdateTableData($updateBloodBank, $where, 'qyura_bloodCatBank');
        echo $return;
        exit;
    }

    function createCSV() {

        $stateId = '';
        $cityId = '';
        $search = '';

        $search = $this->input->post('search');

        if (isset($_POST['stateId']))
            $stateId = $this->input->post('stateId');
        if (isset($_POST['cityId']))
            $cityId = $this->input->post('cityId');

        if ($search != '' && $search != null)
            $search = $this->input->post('search');

        $orWhere = array('bloodBank_name' => $search, 'bloodBank_add' => $search, 'bloodBank_phn' => $search);

        $where = array('bloodBank_deleted' => 0, 'cityId' => $cityId, 'stateId' => $stateId);
        $array[] = array('BloodBank Name', 'City', 'Phone Number', 'Address');
        $data = $this->Bloodbank_model->createCSVdata($where, $orWhere);

        $arrayFinal = array_merge($array, $data);

        array_to_csv($arrayFinal, 'BloodbankDetail.csv');
        return True;
        exit;
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

    function bloodbankBackgroundUpload($bloodBankId) {
        if (isset($_FILES["file"]["name"])) {

            $temp = explode(".", $_FILES['file']["name"]);
            $microtime = round(microtime(true));
            $imageName = "bloodbank";
            $newfilename = "" . $imageName . "_" . $microtime . '.' . end($temp);
            $uploadData = $this->uploadImages('file', 'BloodBank', $newfilename);
            if ($uploadData['status']) {
                $imageName = $uploadData['imageData']['file_name'];

                $data = array('bloodBank_background_img' => $imageName);
                $where = array('bloodBank_id' => $bloodBankId);

                $response = $this->Bloodbank_model->UpdateTableData($data, $where, 'qyura_bloodBank');
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

    function getBackgroundImage($bloodBankId) {
        $select = array('bloodBank_background_img');
        $where = array('bloodBank_id' => $bloodBankId);

        $response = $this->Bloodbank_model->fetchTableData($select, 'qyura_bloodBank', $where);
        if ($response) {
            echo $image = base_url() . 'assets/BloodBank/' . $response[0]->bloodBank_background_img;
        }
        exit;
    }

    function map($id) {
        $option = array(
            'table' => 'qyura_bloodBank',
            'select' => 'bloodBank_lat,bloodBank_long,bloodBank_add,bloodBank_name,bloodBank_photo',
            'where' => array('bloodBank_id' => $id)
        );
        $data['mapData'] = $this->common_model->customGet($option);
        $data['title'] = 'Bloodbank Map';
        $this->load->super_admin_template('map', $data, 'bloodBankScript');
    }

    function _checkUserExist($email = '') {
        $query = 'SELECT count(users_id) as isExit FROM qyura_users INNER JOIN qyura_usersRoles ON qyura_users.users_id = qyura_usersRoles.usersRoles_userId WHERE users_email = "' . $email . '" AND usersRoles_roleId = ' . ROLE_HOSPITAL . ' AND (SELECT count(users_id) FROM qyura_users INNER JOIN qyura_usersRoles ON qyura_users.users_id = qyura_usersRoles.usersRoles_userId WHERE users_email = "' . $email . '" AND usersRoles_roleId = ' . ROLE_BLOODBANK . ' ) > 0 ';

        $data = $this->db->query($query)->result();

        if ($data[0]->isExit == 1) {

            $this->bf_form_validation->set_message('_checkUserExist', 'blood bank already exist');
            return false;
        } elseif ($data[0]->isExit == 0) {

            $query2 = 'SELECT count(users_id) userId, hospital_address, hospital_lat, hospital_long FROM qyura_users INNER JOIN qyura_usersRoles ON qyura_users.users_id = qyura_usersRoles.usersRoles_userId INNER JOIN qyura_hospital ON qyura_hospital.hospital_usersId = qyura_users.users_id WHERE users_email = "' . $email . '" AND usersRoles_roleId = ' . ROLE_HOSPITAL . ' ';
            $getData = $this->db->query($query2)->result();

            if ($getData[0]->userId == 1) {

                return true;
            } else {

                return true;
                ;
            }
        }
    }
    
    function updateTimeSlot(){
        
        $mi_user_id = $this->input->post('mi_user_id');
        $bloodBankId = $this->input->post('mi_id');
        $timeSlotsIds = array();
        for ($j = 1; $j < 8; $j++) {

            $totalSlot = $this->input->post("totalSlot_$j");
            for ($k = 1; $k <= $totalSlot; $k++) {
                if ($this->input->post("check_" . $j . "_" . $k) == 1) {
                    
                    $charge_ids = $this->input->post("charge_ids_" . $j . "_" . $k);
                    $hour_label = $this->input->post("hour_label_" . $j . "_" . $k);
                    $openTime = $this->input->post("openTime_" . $j . "_" . $k);
                    $closeTime = $this->input->post("closeTime_" . $j . "_" . $k);
                    $dayNUmber  = $this->input->post('dayNumber_'.$j);
                    
                    $option = array(
                    'table' => 'qyura_miTimeSlot',
                    'select' => 'slot_id',
                    'where' => array('mi_user_id' => $mi_user_id, 'dayNumber' => $dayNUmber)
                     );
                    $isSlotData  = $this->common_model->customGet($option);
                    
                    if(!empty($isSlotData)){
                        
                        $options = array(
                        'table' => 'qyura_miTimeSlot',
                        'data' => array(
                              'hourLabel' => $hour_label,
                              'openingHours' => $openTime,
                              'closingHours' => $closeTime,
                              'modifyTime' => strtotime(date('Y-m-d H:i:s'))
                         ),
                        'where' => array(
                            'mi_user_id' => $mi_user_id, 
                            'dayNumber' => $dayNUmber, 
                            'slot_id' => $isSlotData[0]->slot_id)
                         );
                       
                        $update  = $this->common_model->customUpdate($options);
                        
                    }else{
                       
                        $options = array(
                        'table' => 'qyura_miTimeSlot',
                        'data' => array(
                                    'mi_user_id' => $mi_user_id,
                                    'dayNumber' => $dayNUmber,
                                    'hourLabel' => $hour_label,
                                    'openingHours' => $openTime,
                                    'closingHours' => $closeTime,
                                    'creationTime' => strtotime(date('Y-m-d H:i:s'))
                            ),
                         );
                        $insert  = $this->common_model->customInsert($options);
                        
                    }
  
                }else{
                    
                    $dayNumber  = $this->input->post('dayNumber_'.$j);
                    
                    $option = array(
                    'table' => 'qyura_miTimeSlot',
                    'where' => array('mi_user_id' => $mi_user_id, 'dayNumber' => $dayNumber)
                     );
                    $isSlotData  = $this->common_model->customDelete($option);
                 }
            }
         
        }
        
        if(true){
                $this->session->set_flashdata('message', 'Time Slot insert successfully!');
                redirect("bloodbank/detailBloodBank/$bloodBankId");
           }else{
                $this->session->set_flashdata('error', 'Time Slot insert failed !');
                redirect("bloodbank/detailBloodBank/$bloodBankId");
           }
    }

    function setTimeSlotMi() {

        $bloodBankId = $this->input->post('mi_id');
        $timeSlotsIds = array();
        for ($j = 1; $j < 8; $j++) {

            $totalSlot = $this->input->post("totalSlot_$j");
            for ($k = 1; $k <= $totalSlot; $k++) {
                if ($this->input->post("check_" . $j . "_" . $k) == 1) {
                    $charge_ids = $this->input->post("charge_ids_" . $j . "_" . $k);
                    $hour_label = $this->input->post("hour_label_" . $j . "_" . $k);
                    $openTime = $this->input->post("openTime_" . $j . "_" . $k);
                    $closeTime = $this->input->post("closeTime_" . $j . "_" . $k);

                    $slot = array(
                        'mi_user_id' => $this->input->post('mi_user_id'),
                        'dayNumber' => $this->input->post('dayNumber_'.$j),
                        'hourLabel' => $hour_label,
                        'openingHours' => $openTime,
                        'closingHours' => $closeTime,
                        'creationTime' => strtotime(date('Y-m-d H:i:s'))
                    );
                    
                    $options = array
                            (
                            'data' => $slot,
                            'table' => 'qyura_miTimeSlot'
                        );
                    $insertId = $this->common_model->customInsert($options);
                    
                  } 
                }
            }
            
            if($insertId){
                 $this->session->set_flashdata('message', 'Time Slot insert successfully!');
                 redirect("bloodbank/detailBloodBank/$bloodBankId");
            }else{
                 $this->session->set_flashdata('error', 'Time Slot insert failed !');
                 redirect("bloodbank/detailBloodBank/$bloodBankId");
            }
            
                    
                    //exit();
//                    //find a ids behalf of string
//                    $option = array(
//                        'table' => 'qyura_miTimeSlot',
//                        'select' => 'id',
//                        'where' => array('fkcityServiceId' => $fkcityServiceId, 'id' => $charge_ids, 'hourLabel' => $hour_label, 'enabled' => 1),
//                        'single' => TRUE
//                    );

//                    $venderTimesSlots = $this->common_model->customGet($option);
//                    if (isset($venderTimesSlots) && $venderTimesSlots != NULL) {
//                        array_push($timeSlotsIds, $venderTimesSlots->id);
//                    }
//                    $timeArray = array(
//                        'fkCityServiceId' => $fkcityServiceId,
//                        'dayNumber' => $j,
//                        'hourLabel' => $hour_label,
//                        'openingHours' => $openTime,
//                        'closingHours' => $closeTime,
//                    );
//                    $updateTimeId = $this->common_model->checkTimeTag($hour_label, $fkcityServiceId, $timeArray, $charge_ids);
//                    if (!$updateTimeId) {
//                        $timeArray['createdAt'] = date('Y-m-d');
//                        $options = array
//                            (
//                            'data' => $timeArray,
//                            'table' => 'qyura_miTimeSlot'
//                        );
//                        $insertAerobicId = $insertTimeId = $this->common_model->customInsert($options);
//                        array_push($timeSlotsIds, $insertTimeId);
//                    }
//                }
//           // }
//        }

        //find all ids behalf of this fkcityserviceid
//        $option = array(
//            'table' => 'qyura_miTimeSlot',
//            'select' => 'id',
//            'where' => array('fkcityServiceId' => $fkcityServiceId, 'enabled' => 1, 'deleted' => 0),
//            'single' => FALSE
//        );
//        $venderTimeSlot = $this->common_model->customGet($option);
//        //delete unlisted ids
//        foreach ($venderTimeSlot as $ids) {
//            if (!in_array($ids->id, $timeSlotsIds)) {
//                $deleteArray['deleted'] = 1;
//                $updateOptions = array(
//                    'where' => array("fkcityServiceId" => $fkcityServiceId, 'id' => $ids->id),
//                    'data' => $deleteArray,
//                    'table' => 'qyura_miTimeSlot'
//                );
//                $insertAerobicId = $this->common_model->customUpdate($updateOptions);
//            }
//        }
//    }

 }
}
