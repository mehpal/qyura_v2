<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ambulance extends MY_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->model('Ambulance_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    function index() {
        $data = array();
        $data['allStates'] = $this->Ambulance_model->fetchStates();
        $data['ambulanceData'] = $this->Ambulance_model->fetchambulanceData();
        $data['city'] = $this->getCityByMI(2);
        $data['title'] = 'Ambulance';
        $this->load->super_admin_template('ambulanceListing', $data, 'ambulanceScript');
    }

    function getAmbulanceDl() {

        echo $this->Ambulance_model->fetchAmbulanceDataTables();
    }

    function detailAmbulance($ambulanceId,$active = 'general') {
        $data = array();
        $data['ambulanceData'] = $ambulanceData = $this->Ambulance_model->fetchambulanceData($ambulanceId);
      
        $data['ambulanceId'] = $ambulanceId;
        $data['editdetail'] = 'none';
        $data['detail'] = 'block';
        $data['title'] = (!empty($data['ambulanceData'][0]->ambulance_name)) ? $data['ambulanceData'][0]->ambulance_name : "Ambulance Details";

        $option = array(
            'table' => 'qyura_ambulance',
            'select' => 'ambulance_background_img',
            'where' => array('ambulance_id' => $ambulanceId)
        );
        $data['backgroundImage'] = $this->Ambulance_model->customGet($option);
        
        
        $data['allStates'] = $this->Ambulance_model->fetchStates();
        
        $stateId = (!empty($data['ambulanceData'][0]->ambulance_stateId)) ? $data['ambulanceData'][0]->ambulance_stateId : 0;
        $data['citys'] = $this->Ambulance_model->fetchCity($stateId);
            
        $mi_userId="";
        if(!empty($ambulanceData)):
         $mi_userId = $ambulanceData[0]->ambulance_usersId;
        endif;
        $option = array(
            'select' => '*',
            'table'=> 'qyura_miTimeSlot',
            'where'=> array('mi_user_id' => $mi_userId),
        );
        $data['timeSlot'] = $this->common_model->customGet($option);
        $data['active'] = $active;
        $this->load->super_admin_template('ambulanceDetail', $data, 'ambulanceScript');
    }

    function saveDetailAmbulance($ambulanceId) {

        $this->bf_form_validation->set_rules('ambulance_name', 'Ambulance Name', 'required|trim');

        $this->bf_form_validation->set_rules('ambulance_countryId', 'Ambulance Country', 'required|trim|numeric');
        $this->bf_form_validation->set_rules('ambulance_stateId', 'Ambulance StateId', 'required|trim|numeric');
        $this->bf_form_validation->set_rules('ambulance_cityId', 'Ambulance City', 'required|trim|numeric');
            
        $this->bf_form_validation->set_rules('ambulance_phn', 'Ambulance Phone', 'required|numeric');
        $this->bf_form_validation->set_rules('ambulance_zip', 'Ambulance Zip', 'required|trim|numeric');
        $this->bf_form_validation->set_rules('ambulance_address', 'Ambulance Address', 'required|trim');
        $this->bf_form_validation->set_rules('ambulance_cntPrsn', 'Contact Person', 'required|trim');
       // $this->bf_form_validation->set_rules('ambulance_mmbrTyp', 'Membership Type', 'required|trim');
       // $this->bf_form_validation->set_rules('users_mobile', 'User Mobile', 'required|trim|numeric');
       // $this->bf_form_validation->set_rules('midNumber[]', 'Std Code', 'required|trim|numeric');
        $this->bf_form_validation->set_rules('lat', 'Latitude', 'required|callback_isValidLatitude[lat]');
        $this->bf_form_validation->set_rules('lng', 'Longitude', 'required|callback_isValidLongitude[lng]');
        $this->bf_form_validation->set_rules('ambulance_docatId', 'Docat Id', 'required|trim');
        if ($this->bf_form_validation->run() === False) {
            $data = array();
            $data['ambulanceData'] = $this->Ambulance_model->fetchambulanceData($ambulanceId);
            $data['ambulanceId'] = $ambulanceId;
            $data['editdetail'] = 'block';
            $data['detail'] = 'none';
            
            
           $data['allStates'] = $this->Ambulance_model->fetchStates();
        
           $stateId = (!empty($data['ambulanceData'][0]->ambulance_stateId)) ? $data['ambulanceData'][0]->ambulance_stateId : 0;
           $data['citys'] = $this->Ambulance_model->fetchCity($stateId);
            
            
            $this->load->super_admin_template('ambulanceDetail', $data, 'ambulanceScript');
        } else {
            $ambulance_phn = $this->input->post('ambulance_phn');
            //$pre_number = $this->input->post('pre_number');
           // $stdNumber = $this->input->post('midNumber');
            $countryId = $this->input->post('ambulance_countryId');
            $stateId = $this->input->post('ambulance_stateId');
            $cityId = $this->input->post('ambulance_cityId');
            $ambulance_zip = $this->input->post('ambulance_zip');
            $ambulance_docatId = $this->input->post('ambulance_docatId');
            $docOnBoard = $this->input->post('docOnBoard');
            $isBoard = 0;
            if(!empty($docOnBoard)){
              $isBoard = 1;  
            }

//            $finalNumber = '';
//            for ($i = 0; $i < count($ambulance_phn); $i++) {
//                if ($ambulance_phn[$i] != '' && $pre_number[$i] != '') {
//
//                    if ($i == count($ambulance_phn) - 1)
//                        $finalNumber .= $pre_number[$i] . ' ' . $stdNumber[$i] .  ' ' . $ambulance_phn[$i];
//                    else
//                        $finalNumber .= $pre_number[$i] . ' ' . $stdNumber[$i] .  ' ' . $ambulance_phn[$i] . '|';
//                }
//            }

            
            $updateAmbulance = array(
                'ambulance_name' => $this->input->post('ambulance_name'),
                'ambulanceType' => $this->input->post('ambulanceType'),
                'ambulance_phn' => $ambulance_phn,
                'ambulance_address' => $this->input->post('ambulance_address'),
                 'ambulance_mmbrTyp' => $this->input->post('ambulance_mmbrTyp'),
                'ambulance_cntPrsn' => $this->input->post('ambulance_cntPrsn'),
                'ambulance_27Src' => $this->input->post('ambulance_27Src'),
                'ambulance_lat' => $this->input->post('lat'),
                'ambulance_long' => $this->input->post('lng'),
                'ambulance_isManual' => $this->input->post('isManual'),
                'modifyTime' => strtotime(date("Y-m-d H:i:s")),
                'ambulance_countryId' => $countryId,
                'ambulance_stateId' => $stateId,
                'ambulance_cityId' => $cityId,
                 'ambulance_docatId' => $ambulance_docatId,
                'ambulance_zip' => $ambulance_zip,
                'docOnBoard' => $isBoard,
            );

            $where = array(
                'ambulance_id' => $ambulanceId
            );

            $response = '';
            $response = $this->Ambulance_model->UpdateTableData($updateAmbulance, $where, 'qyura_ambulance');
            if ($response) {
                $updateUserdata = array(
                    //'users_email' => $this->input->post('users_email'),
                   // 'users_mobile' => $this->input->post('users_mobile'),
                    'modifyTime' => strtotime(date("Y-m-d H:i:s"))
                );
                $whereUser = array(
                    'users_id' => $this->input->post('user_tables_id')
                );
                $response = $this->Ambulance_model->UpdateTableData($updateUserdata, $whereUser, 'qyura_users');
                if ($response) {
                    $this->session->set_flashdata('message', 'Data updated successfully !');
                    redirect("ambulance/detailAmbulance/$ambulanceId");
                }
            }
        }
    }

    function addAmbulance() {
        $data = array();
        $data['allStates'] = $this->Ambulance_model->fetchStates();
        $data['title'] = "Add Ambulance";
        $this->load->super_admin_template('addAmbulance', $data, 'ambulanceScript');
    }

    function fetchCity() {
        //echo "fdadas";exit;
        $stateId = $this->input->post('stateId');
        $cityData = $this->Ambulance_model->fetchCity($stateId);
        $cityOption = '';
        $cityOption .='<option value=>Select Your City</option>';
        foreach ($cityData as $key => $val) {
            $cityOption .= '<option value=' . $val->city_id . '>' . strtoupper($val->city_name) . '</option>';
        }
        echo $cityOption;
        exit;
    }

    function SaveAmbulance() {
        $this->load->library('form_validation');
        $this->bf_form_validation->set_rules('ambulance_name', 'Ambulance Name', 'required|trim');

        $this->bf_form_validation->set_rules('ambulance_countryId', 'Ambulance Country', 'required|trim|numeric');
        $this->bf_form_validation->set_rules('ambulance_stateId', 'Ambulance StateId', 'required|trim|numeric');
        $this->bf_form_validation->set_rules('ambulance_cityId', 'Ambulance City', 'required|trim|numeric');

        $this->bf_form_validation->set_rules('ambulance_phn', 'Ambulance Phone', 'required|numeric');
        $this->bf_form_validation->set_rules('ambulance_zip', 'Ambulance Zip', 'required|trim|numeric');
        $this->bf_form_validation->set_rules('ambulance_address', 'Ambulance Address', 'required|trim');
        $this->bf_form_validation->set_rules('ambulance_cntPrsn', 'Contact Person', 'required|trim');
        $this->bf_form_validation->set_rules('ambulance_mmbrTyp', 'Membership Type', 'required|trim');
        $this->bf_form_validation->set_rules('users_email', 'Users Email', 'required|valid_email|trim');
      //  $this->bf_form_validation->set_rules('users_mobile', 'User Mobile', 'required|trim|numeric');
       // $this->bf_form_validation->set_rules('midNumber[]', 'Std Code', 'required|trim|numeric');
        $this->bf_form_validation->set_rules('lat', 'Latitude', 'required|callback_isValidLatitude[lat]');
        $this->bf_form_validation->set_rules('lng', 'Longitude', 'required|callback_isValidLongitude[lng]');
        $this->bf_form_validation->set_rules('ambulance_docatId', 'Docat Id', 'required|trim');

        if (empty($_FILES['avatar_file']['name'])) {
            $this->bf_form_validation->set_rules('avatar_file', 'File', 'required');
        }
        if ($this->bf_form_validation->run() === FALSE) {
            
            $data = array();
            $data['allStates'] = $this->Ambulance_model->fetchStates();
            
            $stateId = $this->input->post('ambulance_stateId');
            $data['citys'] = $this->Ambulance_model->fetchCity($stateId);
            
            
            $data['title'] = 'Add Ambulance';
            $this->load->super_admin_template('addAmbulance', $data, 'ambulanceScript');
        } else {
               
            $imagesname = "";
            if ($_FILES['avatar_file']['name']) {
                $path = realpath(FCPATH . 'assets/ambulanceImages/');
                $upload_data = $this->input->post('avatar_data');
                $upload_data = json_decode($upload_data);
                $original_imagesname = $this->uploadImageWithThumb($upload_data, 'avatar_file', $path, 'assets/ambulanceImages/', './assets/ambulanceImages/thumb/', 'ambulance');

                if (empty($original_imagesname)) {
                    $data['allStates'] = $this->Ambulance_model->fetchStates();
                    $this->session->set_flashdata('valid_upload', $this->error_message);
                    $this->load->super_admin_template('addAmbulance', $data, 'ambulanceScript');
                    return false;
                } else {
                    $imagesname = $original_imagesname;
                }
            }

            //echo $imagesname;exit;
           
//            $pre_number = $this->input->post('pre_number');
//            $stdNumber = $this->input->post('midNumber');
//
//            $finalNumber = '';
//            for ($i = 0; $i < count($ambulance_phn); $i++) {
//                if ($ambulance_phn[$i] != '' && $pre_number[$i] != '') {
//                    if ($i == count($ambulance_phn) - 1)
//                        $finalNumber .= $pre_number[$i] . ' ' . $stdNumber[$i] . ' ' . $ambulance_phn[$i];
//                    else
//                        $finalNumber .= $pre_number[$i] . ' ' . $stdNumber[$i] . ' ' . $ambulance_phn[$i] . '|';
//                }
//            }
             $ambulance_phn = $this->input->post('ambulance_phn');
            $ambulance_name = $this->input->post('ambulance_name');
            $countryId = $this->input->post('ambulance_countryId');
            $stateId = $this->input->post('ambulance_stateId');
            $cityId = $this->input->post('ambulance_cityId');
            $ambulance_address = $this->input->post('ambulance_address');
            $ambulance_cntPrsn = $this->input->post('ambulance_cntPrsn');
            $ambulance_mmbrTyp = $this->input->post('ambulance_mmbrTyp');
            $isEmergency = $this->input->post('isEmergency');
            
            $ambulance_docatId = $this->input->post('ambulance_docatId');
            $ambulance_zip = $this->input->post('ambulance_zip');
            $docOnBoard = $this->input->post('docOnBoard');
            $isBoard = 0;
            if(!empty($docOnBoard)){
              $isBoard = 1;  
            }

            $insertData = array(
                'ambulance_name' => $ambulance_name,
                'ambulance_isManual' => $this->input->post('isManual'),
                'ambulance_countryId' => $countryId,
                'ambulance_stateId' => $stateId,
                'ambulance_cityId' => $cityId,
                'ambulance_address' => $ambulance_address,
                'ambulance_cntPrsn' => $ambulance_cntPrsn,
                'ambulance_mmbrTyp' => $ambulance_mmbrTyp,
                'ambulance_zip' => $ambulance_zip,
                'ambulance_27Src' => $isEmergency,
                'ambulance_img' => $imagesname,
                'creationTime' => strtotime(date("Y-m-d H:i:s")),
                'ambulance_phn' => $ambulance_phn,
                'ambulance_lat' => $this->input->post('lat'),
                'ambulance_long' => $this->input->post('lng'),
                'ambulance_docatId' => $ambulance_docatId,
                'ambulanceType' => $this->input->post('ambulanceType'),
                'docOnBoard' => $isBoard,
                'status' => 0
            );

            $users_email_status = $this->input->post('users_email_status');
            if ($users_email_status == '') {
                $users_email = $this->input->post('users_email');
                $ambulanceInsert = array(
                    'users_email' => $users_email,
                    'users_ip_address' => $this->input->ip_address(),
                    //'users_mobile' => $this->input->post('users_mobile'),
                    'creationTime' => strtotime(date("Y-m-d H:i:s"))
                );
                $ambulance_usersId = $this->Ambulance_model->insertAmbulanceUser($ambulanceInsert);
                $usersRoles_parentId = 0;
            } else {
                $ambulance_usersId = $users_email_status;
                $usersRoles_parentId = $users_email_status;
            }
            if ($ambulance_usersId) {

                $insertusersRoles = array(
                    'usersRoles_userId' => $ambulance_usersId,
                    'usersRoles_roleId' => 8,
                    'usersRoles_parentId' => $usersRoles_parentId,
                    'creationTime' => strtotime(date("Y-m-d H:i:s"))
                );

                $this->Ambulance_model->insertUsersRoles($insertusersRoles);


                $insertData['ambulance_usersId'] = $ambulance_usersId;
                $this->sendEmailRegister($this->input->post('users_email'));
                $ambulanceId = $this->Ambulance_model->insertAmbulance($insertData);
                $this->session->set_flashdata('message', 'Data inserted successfully !');
            }
            redirect('ambulance');
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
        $users_email = $this->input->post('users_email');
        $email = $this->Ambulance_model->fetchEmail($users_email);
        if (isset($_POST['user_table_id'])) {
            $user_table_id = $this->input->post('user_table_id');
        }
        if ($email == 1)
            echo $email;
        else {
            $select = array('users_id');
            $where = array('users_email' => $users_email,
                'users_deleted' => 0);
            $return = $this->Ambulance_model->fetchTableData($select, 'qyura_users', $where);
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
     * @method editUploadImage
     * @description update details page image profile
     * @access public
     * @return boolean
     */
    function editUploadImage() {
        if ($_POST['avatar_file']['name']) {
            $path = realpath(FCPATH . 'assets/ambulanceImages/');
            $upload_data = $this->input->post('avatar-data');
            $upload_data = json_decode($upload_data);

            //if ($upload_data->width > 425) {
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
                    $response = $this->Ambulance_model->UpdateTableData($option, $where, 'qyura_ambulance');
                    if ($response) {
//                        $response = array('state' => 200, 'message' => 'Successfully update avtar');
                        $response = array('state' => 200, 'message' => 'Successfully update avtar','image'=>base_url("assets/ambulanceImages/thumb/thumb_100/{$original_imagesname}"),'reset'=>"ambulance-edit", 'returnClass'  => 'logo-img');
                    } else {
                        $response = array('state' => 400, 'message' => 'Failed to update avtar');
                    }
                }
            } else {
                $response = array('state' => 400, 'message' => 'Height and Width must exceed 425px.');
            }
            echo json_encode($response);
//        } else {
//            $response = array('state' => 400, 'message' => 'Please select avtar');
//            echo json_encode($response);
//        }
    }

    function getUpdateAvtar($id) {
        if (!empty($id)) {
            $option = array(
                'table' => 'qyura_ambulance',
                'where' => array('ambulance_id' => $id)
            );
            $data = $this->Ambulance_model->customGet($option);
            echo "<img src='" . base_url() . "assets/ambulanceImages/thumb/original/" . $data[0]->ambulance_img . "'alt='' class='logo-img' />";
            exit();
        }
    }

    function createCSV() {

        $stateId = '';
        $cityId = '';
        $search='';
        if (isset($_POST['ambulance_stateId']))
            $stateId = $this->input->post('ambulance_stateId');
        if (isset($_POST['ambulance_cityId']))
            $cityId = $this->input->post('ambulance_cityId');
        
        if(isset($_POST['search']))
        $search = $this->input->post('search');

        $where = array('ambulance_deleted' => 0, 'ambulance_cityId' => $cityId, 'ambulance_stateId' => $stateId);
        $array[] = array('Ambulance Name', 'City', 'Phone Number', 'Address');
        $data = $this->Ambulance_model->createCSVdata($where,$search);
        $arrayFinal = array_merge($array, $data);

        array_to_csv($arrayFinal, 'AmbulanceDetail.csv');
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

    function setBackgroundUpload($id) {

        if (isset($_FILES["file"]["name"])) {

            $temp = explode(".", $_FILES['file']["name"]);
            $microtime = round(microtime(true));
            $imageName = "ambulance";
            $newfilename = "" . $imageName . "_" . $microtime . '.' . end($temp);
            $uploadData = $this->uploadImages('file', 'ambulanceImages', $newfilename);
            if ($uploadData['status']) {
                $imageName = $uploadData['imageData']['file_name'];

                $option = array(
                    'table' => 'qyura_ambulance',
                    'data' => array('ambulance_background_img' => $imageName),
                    'where' => array('ambulance_id' => $id)
                );
                $response = $this->Ambulance_model->customUpdate($option);
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

    function getBackgroundImage($id) {
        $option = array(
            'table' => 'qyura_ambulance',
            'select' => 'ambulance_background_img',
            'where' => array('ambulance_id' => $id)
        );
        $response = $this->Ambulance_model->customGet($option);
        if ($response) {
            echo $image = base_url() . 'assets/ambulanceImages/' . $response[0]->ambulance_background_img;
        }
    }

    function map($id) {
        $option = array(
            'table' => 'qyura_ambulance',
            'select' => 'ambulance_lat,ambulance_long,ambulance_address,ambulance_name,ambulance_img',
            'where' => array('ambulance_id' => $id)
        );
        $data['mapData'] = $this->Ambulance_model->customGet($option);
        $data['title'] = 'Ambulance Map';
        $this->load->super_admin_template('map', $data, 'ambulanceScript');
    }

}
