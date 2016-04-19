<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Diagnostic extends MY_Controller {

    public function __construct() {
        parent:: __construct();
        // $this->load->library('form_validation');
        $this->load->model('diagnostic_model');
    }

    function index() {
        $data = array();
        $data['allStates'] = $this->diagnostic_model->fetchStates();
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
    function getDiagnosticDoctorsDl($diagonsticUserId) {
        echo $this->diagnostic_model->fetchDiagnosticDoctorDataTables($diagonsticUserId);
    }

    function addDiagnostic() {
        $data = array();
        $data['allStates'] = $this->diagnostic_model->fetchStates();
        $data['title'] = 'Add Diagnostic';
        $this->load->super_admin_template('addDiagcenter', $data, 'diagnosticScript');
    }

    function detailDiagnostic($diagnosticId = '',$active='general') {

        $data = array();

        $data['diagnosticData'] = $this->diagnostic_model->fetchdiagnosticData($diagnosticId);
        $data['gallerys'] = $this->diagnostic_model->customGet(array('table' => 'qyura_diagonsticsImages', 'where' => array('diagonsticImages_diagonsticId' => $diagnosticId, 'diagonsticImages_deleted' => 0)));

        $data['allCountry'] = $this->diagnostic_model->fetchCountry();
        $data['allStates'] = $this->diagnostic_model->fetchStates();
        $data['diagnosticId'] = $diagnosticId;
        $option = array(
            'table' => 'qyura_diagnosticCenterTimeSlot',
            'where' => array(
                'diagnosticCenterTimeSlot_diagnosticId' => $diagnosticId,
                'diagnosticCenterTimeSlot_deleted' => 0
            )
        );
        $data['AlltimeSlot'] = $this->diagnostic_model->customGet($option);
        
        
        $data['diagnosticId'] = $diagnosticId;
        $data['showStatus'] = 'none';
        $data['detailShow'] = 'block';
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

        $this->load->library('form_validation');
        $this->bf_form_validation->set_rules('diagnostic_name', 'Diagnostic Name', 'required|trim');
        $this->bf_form_validation->set_rules('diagnostic_countryId', 'Diagnostic Country', 'required|trim');
        $this->bf_form_validation->set_rules('diagnostic_stateId', 'Diagnostic StateId', 'required|trim');
        $this->bf_form_validation->set_rules('diagnostic_cityId', 'Diagnostic City', 'required|trim');

        $this->bf_form_validation->set_rules('diagnostic_address', 'Diagnostic Address', 'required|trim');
        //$this->bf_form_validation->set_rules('diagnostic_phn', 'Diagnostic Phone', 'required|trim');

        $this->bf_form_validation->set_rules('diagnostic_cntPrsn', 'Contact Person', 'required|trim');
        $this->bf_form_validation->set_rules('diagnostic_mbrTyp', 'Membership Type', 'required|trim');
        $this->bf_form_validation->set_rules('diagnostic_dsgn', 'Designation', 'required|trim');

        $this->bf_form_validation->set_rules('diagnostic_mblNo', 'Diagnostic Mobile No', 'required|trim');

        $this->bf_form_validation->set_rules('diagnostic_zip', 'Diagnostic Zip', 'required|trim');
        $this->bf_form_validation->set_rules('users_email', 'Users Email', 'required|valid_email|trim');
        $this->bf_form_validation->set_rules('users_password', 'Password', 'trim|required|matches[cnfPassword]');
        $this->bf_form_validation->set_rules('cnfPassword', 'Password Confirmation', 'trim|required');

        if (empty($_FILES['avatar_file']['name'])) {
            $this->bf_form_validation->set_rules('avatar_file', 'File', 'required');
        }
        if ($this->bf_form_validation->run() === FALSE) {
            $data = array();
            $data['allStates'] = $this->diagnostic_model->fetchStates();
            $data['title'] = "Add Diagnostic";
            $this->load->super_admin_template('addDiagcenter', $data, 'diagnosticScript');
        } else {

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

            $diagnostic_phn = $this->input->post('diagnostic_phn');
            $pre_number = $this->input->post('pre_number');
            $countPnone = $this->input->post('countPnone');

            $finalNumber = '';
            for ($i = 0; $i < count($countPnone); $i++) {
                if ($diagnostic_phn[$i] != '' && $pre_number[$i] != '') {
                    $finalNumber .= $pre_number[$i] . ' ' . $diagnostic_phn[$i] . '|';
                }
            }

            $diagnostic_name = $this->input->post('diagnostic_name');

            $diagnostic_address = $this->input->post('diagnostic_address');
            $diagnostic_phn = $this->input->post('diagnostic_phn');
            $diagnostic_cntPrsn = $this->input->post('diagnostic_cntPrsn');
            // $diagnostic_dsgn = $this->input->post('diagnostic_dsgn');
            $diagnostic_mmbrTyp = $this->input->post('diagnostic_mbrTyp');
            $diagnostic_countryId = $this->input->post('diagnostic_countryId');
            $diagnostic_stateId = $this->input->post('diagnostic_stateId');
            $diagnostic_cityId = $this->input->post('diagnostic_cityId');
            $diagnostic_mblNo = $this->input->post('diagnostic_mblNo');
            $diagnostic_zip = $this->input->post('diagnostic_zip');
            $diagnostic_dsgn = $this->input->post('diagnostic_dsgn');


            $users_email = $this->input->post('users_email');
            $users_password = md5($this->input->post('users_password'));
            $diagnosticInsert = array(
                'users_email' => $users_email,
                'users_password' => $users_password,
                'users_ip_address' => $this->input->ip_address(),
                'users_mobile' => $this->input->post('diagnostic_mblNo'),
            );

            $diagnostic_usersId = $this->diagnostic_model->insertDiagnosticUser($diagnosticInsert);
            //echo $diagnostic_usersId;exit;
            if ($diagnostic_usersId) {

                $insertusersRoles = array(
                    'usersRoles_userId' => $diagnostic_usersId,
                    'usersRoles_roleId' => 3,
                    'usersRoles_parentId' => 0,
                    'creationTime' => strtotime(date("Y-m-d H:i:s"))
                );
                $this->diagnostic_model->insertUsersRoles($insertusersRoles);

                // $insertData['diagnostic_usersId'] = $diagnostic_usersId;
                $insertData = array(
                    'diagnostic_name' => $diagnostic_name,
                    'diagnostic_dsgn' => $diagnostic_dsgn,
                    'diagnostic_address' => $diagnostic_address,
                    'diagnostic_cntPrsn' => $diagnostic_cntPrsn,
                    'diagnostic_phn' => $finalNumber,
                    'diagnostic_usersId' => $diagnostic_usersId,
                    'diagnostic_mbrTyp' => $diagnostic_mmbrTyp,
                    'diagnostic_countryId' => $diagnostic_countryId,
                    'diagnostic_stateId' => $diagnostic_stateId,
                    'diagnostic_cityId' => $diagnostic_cityId,
                    'diagnostic_mblNo' => $diagnostic_mblNo,
                    'diagnostic_zip' => $diagnostic_zip,
                    'diagnostic_img' => $imagesname,
                    'creationTime' => strtotime(date("Y-m-d H:i:s")),
                    'diagnostic_mblNo' => $diagnostic_mblNo,
                    'diagnostic_lat' => $this->input->post('lat'),
                    'diagnostic_long' => $this->input->post('lng'),
                    'inherit_status' => 1
                );
                // dump($insertData);exit;
                $diagnosticId = $this->diagnostic_model->insertDiagnostic($insertData);
            }
            $this->session->set_flashdata('message', 'Record has been saved successfully!');
            redirect('diagnostic/addDiagnostic');
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
        echo $email;
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
        $this->bf_form_validation->set_rules('diagnostic_countryId', 'Diagnostic Country', 'required|trim');
        $this->bf_form_validation->set_rules('diagnostic_stateId', 'Diagnostic StateId', 'required|trim');
        $this->bf_form_validation->set_rules('diagnostic_cityId', 'Diagnostic City', 'required|trim');
        $this->bf_form_validation->set_rules('diagnostic_address', 'Diagnostic Address', 'required|trim');
        $this->bf_form_validation->set_rules('diagnostic_cntPrsn', 'Contact Person', 'required|trim');
        $this->bf_form_validation->set_rules('diagnostic_zip', 'Diagnostic Zip', 'required|trim');
        $this->bf_form_validation->set_rules('diagnostic_dsgn', 'Diagnostic Designation', 'required|trim');

        if ($this->bf_form_validation->run() === FALSE) {
            $data = array();
            $data['diagnosticData'] = $this->diagnostic_model->fetchdiagnosticData($diagnosticId);
            $data['diagnosticId'] = $diagnosticId;
            $data['showStatus'] = 'block';
            $data['active'] = 'general';
            // $this->load->view('diagnosticDetail', $data);
            $data['title'] = (!empty($data['diagnosticData'])) ? $data['diagnosticData'][0]->diagnostic_name : "Diagnostic Details";
            $this->load->super_admin_template('diagnosticDetail', $data, 'diagnosticScript');
        } else {
            $diagnostic_phn = $this->input->post('diagnostic_phn');
            $pre_number = $this->input->post('pre_number');
            //$countPnone = $this->input->post('countPnone');


            $finalNumber = '';
            for ($i = 0; $i < count($diagnostic_phn); $i++) {
                if ($diagnostic_phn[$i] != '' && $pre_number[$i] != '') {
                    $finalNumber .= $pre_number[$i] . ' ' . $diagnostic_phn[$i] . '|';
                }
            }
            $updateDiagnostic = array(
                'diagnostic_name' => $this->input->post('diagnostic_name'),
                'diagnostic_countryId' => $this->input->post('diagnostic_countryId'),
                'diagnostic_stateId' => $this->input->post('diagnostic_stateId'),
                'diagnostic_cityId' => $this->input->post('diagnostic_cityId'),
                'diagnostic_address' => $this->input->post('diagnostic_address'),
                'diagnostic_zip' => $this->input->post('diagnostic_zip'),
                'diagnostic_dsgn' => $this->input->post('diagnostic_dsgn'),
                'diagnostic_phn' => $finalNumber,
                'diagnostic_cntPrsn' => $this->input->post('diagnostic_cntPrsn'),
                'diagnostic_lat' => $this->input->post('lat'),
                'diagnostic_long' => $this->input->post('lng'),
                'modifyTime' => strtotime(date("Y-m-d H:i:s"))
            );

            $where = array(
                'diagnostic_id' => $diagnosticId
            );
            $response = '';
            $response = $this->diagnostic_model->UpdateTableData($updateDiagnostic, $where, 'qyura_diagnostic');
            if ($response) {
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
            $users_password = md5($this->input->post('users_password'));
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

        if ($_POST['avatar_file']['name']) {
            $path = realpath(FCPATH . 'assets/diagnosticsImage/');
            $upload_data = $this->input->post('avatar_data');
            $upload_data = json_decode($upload_data);

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
        $Id = $this->input->post('diagnosticId');
        $Awards_awardsName = $this->input->post('diaAwards_awardsName');
        $awardData = array('diagnosticAwards_awardsName' => $Awards_awardsName, 'diagnosticAwards_diagnosticId' => $Id, 'creationTime' => strtotime(date("Y-m-d H:i:s")));
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
        $updatedData = array('diagnosticAwards_awardsName' => $awardsName);
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
        );
        $dataAwards = $this->diagnostic_model->customGet($option);
        $showAwards = '';
        if ($dataAwards) {
            foreach ($dataAwards as $key => $val) {
                $showAwards .='<li>' . $val->diagnosticAwards_awardsName . '</li>';
            }
        } else {
            $showAwards = 'Add Awards';
        }
        echo $showAwards;
        exit;
    }

    function detailAwards($hospitalId) {
        $option = array(
            'table' => 'qyura_diagnosticAwards',
            'where' => array('diagnosticAwards_diagnosticId' => $hospitalId, 'diagnosticAwards_deleted' => 0),
        );
        $dataAwards = $this->diagnostic_model->customGet($option);
        if ($dataAwards) {
            $showTotalAwards = '';
            foreach ($dataAwards as $key => $val) {
                $showTotalAwards .= '<div class="row m-t-10">
        <div class="col-md-8 col-sm-8 col-xs-8">
           <input type="text" class="form-control" name="hospitalAwards_awardsName" id=' . $val->diagnosticAwards_id . ' value="' . $val->diagnosticAwards_awardsName . '" placeholder="FICCI Healthcare " />
         </div>
           <div class="col-md-2 col-sm-2 col-xs-2">
            <a onclick="editAwards(' . $val->diagnosticAwards_id . ')"><i class="fa fa-pencil-square-o fa-2x m-t-5 label-plus" title="Edit Awards"></i></a>
           </div>

          <div class="col-md-2 col-sm-2 col-xs-2">
          <a onclick="deleteAwards(' . $val->diagnosticAwards_id . ')"><i class="fa fa-times fa-2x m-t-5 label-plus" title="Delete Awards"></i></a>
          </div>
         </div>';
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
         </div>
           <div class="col-md-2 col-sm-2 col-xs-2">
            <a onclick="editServices(' . $val->diagnosticServices_id . ')"><i class="fa fa-pencil-square-o fa-2x m-t-5 label-plus" title="Edit Awards"></i></a>
           </div>

          <div class="col-md-2 col-sm-2 col-xs-2">
          <a onclick="deleteServices(' . $val->diagnosticServices_id . ')"><i class="fa fa-times fa-2x m-t-5 label-plus" title="Delete Awards"></i></a>
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
            $specialist .='<li ><input type=checkbox class=diagonasticSpecialCheck name=speciality value=' . $val->specialities_id . ' /> ' . $val->specialities_name . '</li>';
        }

        echo $specialist;
        exit;
    }

    function diagnosticAllocatedSpecialities($diagnosticId) {

        $data = $this->diagnostic_model->fetchdiagnosticsSpecialityData($diagnosticId);
        $allocatedSpecialist = '';
        foreach ($data as $key => $val) {
            $allocatedSpecialist .='<li >' . $val->specialities_name . '<input type=checkbox class=diagonasticAllocSpecialCheck name=allocSpeciality value=' . $val->diagnosticSpecialities_id . ' /></li>';
        }
        echo $allocatedSpecialist;
        exit;
    }

    function addSpeciality() {

        $id = $this->input->post('diagnosticId');
        $diagnosticSpecialities_specialitiesId = $this->input->post('diagnosticSpecialities_specialitiesId');
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

        $this->bf_form_validation->set_rules('nightStartTime', 'Night End Time', 'required|trim');
        $this->bf_form_validation->set_rules('nightEndTime', 'Night End Time', 'required|trim');

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

            if ($_POST['nightStartTime'] && $_POST['nightEndTime'] && $_POST['diagnosticId']) {
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
            }
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

        $this->bf_form_validation->set_rules('nightStartTime', 'Night End Time', 'required|trim');
        $this->bf_form_validation->set_rules('nightEndTime', 'Night End Time', 'required|trim');

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

            if ($_POST['nightStartTime'] && $_POST['nightEndTime'] && $_POST['diagnosticId']) {
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
            }
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


        $users_email = $this->input->post('users_email');
        $user_tables_id = $this->input->post('user_table_id');
        $users_password = $this->input->post('users_password');

        $users_mobile = $this->input->post('users_mobile');
        $diagnostic_mbrTyp = $this->input->post('diagnostic_mbrTyp');


        $where = array(
            'users_id' => $user_tables_id
        );
        $userTableData = array(
            'users_mobile' => $users_mobile,
            'users_email' => $users_email,
            'modifyTime' => strtotime(date("Y-m-d H:i:s"))
        );
        $return = $this->diagnostic_model->UpdateTableData($userTableData, $where, 'qyura_users');
        if (!empty($users_password)) {
            $encrypted = md5($users_password);
            $update = array(
                'users_password' => $encrypted,
                'modifyTime' => strtotime(date("Y-m-d H:i:s"))
            );


            $return = $this->diagnostic_model->UpdateTableData($update, $where, 'qyura_users');
        }

        $Data = array(
            'diagnostic_mbrTyp' => $diagnostic_mbrTyp,
            'modifyTime' => strtotime(date("Y-m-d H:i:s"))
        );
        $Wheres = array('diagnostic_usersId' => $user_tables_id);
        $return = $this->diagnostic_model->UpdateTableData($Data, $Wheres, 'qyura_diagnostic');
        echo $return;
        //echo $encrypted;
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
       if(isset($_POST['diagnostic_stateId']))
        $stateId = $this->input->post('diagnostic_stateId');
       if(isset($_POST['diagnostic_cityId']))
        $cityId = $this->input->post('diagnostic_cityId');
       
        $where=array('diagnostic_deleted'=> 0,'diagnostic_cityId'=> $cityId,'diagnostic_stateId'=>$stateId);
        $array[]= array('Image Name','Diagnostic Name','City','Phone Number','Address');
        $data = $this->diagnostic_model->createCSVdata($where);

        $arrayFinal = array_merge($array,$data);
       
        array_to_csv($arrayFinal,'DiagnosticDetail.csv');
        return True;
        exit;
    }

}
