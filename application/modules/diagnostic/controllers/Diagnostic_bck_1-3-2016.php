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
    function getDiagnosticDoctorsDl($diagonsticUserId){
        echo $this->diagnostic_model->fetchDiagnosticDoctorDataTables($diagonsticUserId);
    }

    function addDiagnostic() {
        $data = array();
        $data['allStates'] = $this->diagnostic_model->fetchStates();
        $this->load->super_admin_template('addDiagcenter', $data, 'diagnosticScript');
    }

    function detailDiagnostic($diagnosticId = '') {
        $data = array();
        // echo $diagnosticId;exit;
        $data['diagnosticData'] = $this->diagnostic_model->fetchdiagnosticData($diagnosticId);
        $data['gallerys'] = $this->diagnostic_model->customGet(array('table'=>'qyura_diagonsticsImages','where'=>array('diagonsticImages_diagonsticId'=>$diagnosticId,'diagonsticImages_deleted'=>0)));
        //print_r($data);exit;
        $data['allCountry'] = $this->diagnostic_model->fetchCountry();
        $data['allStates'] = $this->diagnostic_model->fetchStates();
        $data['diagnosticId'] = $diagnosticId;
        $data['showStatus'] = 'none';
        $data['detailShow'] = 'block';
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

                $insertData['diagnostic_usersId'] = $diagnostic_usersId;
                $insertData = array(
                    'diagnostic_name' => $diagnostic_name,
                    'diagnostic_address' => $diagnostic_address,
                    'diagnostic_cntPrsn' => $diagnostic_cntPrsn,
                    'diagnostic_phn' => $finalNumber,
                    //'diagnostic_dsgn'=> $diagnostic_dsgn,
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
                // print_r($insertData);exit;
                $diagnosticId = $this->diagnostic_model->insertDiagnostic($insertData);
            }
            $this->session->set_flashdata('message', 'Data inserted successfully !');
            redirect('diagnostic/addDiagnostic');
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
            $data['detailShow'] = 'none';
            // $this->load->view('diagnosticDetail', $data);
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
                $this->session->set_flashdata('message', 'Data updated successfully !');
                redirect("diagnostic/detailDiagnostic/$diagnosticId");
            }
        }
    }
    
    function updateAccount($diagnosticId){
    	
        $this->bf_form_validation->set_rules('diagnostic_mbrTyp', 'Membership Type', 'required|trim');
        $this->bf_form_validation->set_rules('users_email', 'Users Email', 'required|valid_email|trim');
        $this->bf_form_validation->set_rules('users_password', 'Password', 'trim|required');

        if ($this->bf_form_validation->run() === FALSE) {
            $data = array();
            $data['diagnosticData'] = $this->diagnostic_model->fetchdiagnosticData($diagnosticId);
            $data['diagnosticId'] = $diagnosticId;
            $data['showStatus'] = 'block';
            $data['detailShow'] = 'none';
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
        			'data'=> $diagnosticInsert,
        			'table'=>'qyura_users',
        			'where'=> array('users_id'=>$user_id)
        	);
        	$response = $this->diagnostic_model->customUpdate($options);
        	
        	$options_dia = array(
        			'data'=> array('diagnostic_mbrTyp'=>$diagnostic_mbrTyp),
        			'table'=>'qyura_diagnostic',
        			'where'=> array('diagnostic_id'=>$diagnosticId)
        	);
        	$response = $this->diagnostic_model->customUpdate($options_dia);
        	if($response){
        		$this->session->set_flashdata('message', 'Data updated successfully !');
        		redirect("diagnostic/detailDiagnostic/$diagnosticId");
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

            $original_imagesname = $this->uploadImageWithThumb($upload_data, 'avatar_file', $path, 'assets/diagnosticsImage/', './assets/diagnosticsImage/thumb/','diagnostic');

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
    
    	if ($_POST['avatar_file']['name']) {
    		$path = realpath(FCPATH . 'assets/diagnosticsImage/');
    		$upload_data = $this->input->post('avatar_data');
    		$upload_data = json_decode($upload_data);
    		$original_imagesname = $this->uploadImageWithThumb($upload_data, 'avatar_file', $path, 'assets/diagnosticsImage/', './assets/diagnosticsImage/thumb/','diagnostic');
    
    		if (empty($original_imagesname)) {
    			$response = array('state' => 400, 'message' => $this->error_message);
    		} else {
    
    			$option = array(
    					'diagonsticImages_ImagesName' => $original_imagesname,
    					'diagonsticImages_diagonsticId'=> $this->input->post('avatar_id'),
    					'creationTime' => strtotime(date("Y-m-d H:i:s"))
    			);
			$options = array(
					'table'=> 'qyura_diagonsticsImages              ',
					'data'=>$option
			);
			
    			$response = $this->diagnostic_model->customInsert($options);
    			if ($response) {
    				$response = array('state' => 200, 'message' => 'Successfully added gallery image');
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

    				'diagonsticImages_diagonsticId'=> $id,
    				'diagonsticImages_deleted'=> 0
    		);
    		$options = array(
    				'table'=> 'qyura_diagonsticsImages',
    				'where'=>$where
    		);
    		$gallerys = $this->diagnostic_model->customGet($options);
    		if($gallerys){
	    		foreach($gallerys as $gallery){
	    			$gallery_template.='<aside class="col-md-3 col-sm-4 col-xs-6 show-image">
                                                <img width="210" class="thumbnail img-responsive" src="'.base_url().'/assets/diagnosticsImage/thumb/original/'.$gallery->diagonsticImages_ImagesName.'">
                                                <a class="delete" onClick="deleteGalleryImage('.$gallery->diagonsticImages_id.')"> <i class="fa fa-times fa-2x"></i></a>
                                            </aside>';
	    		}
    		}else{
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
    			'table'=> 'qyura_diagonsticsImages',
    			'where'=>$updatedDataWhere,
    			'data'=>$updatedData
    	);
    	$return = $this->diagnostic_model->customUpdate($option);
    	echo $return;
    	exit;
    }
    
    function addDiagnosticAwards() {
        $Id = $this->input->post('diagnosticId');
        $Awards_awardsName = $this->input->post('diaAwards_awardsName');
        $awardData = array('diagnosticAwards_awardsName' => $Awards_awardsName, 'diagnosticAwards_diagnosticId' => $Id);
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
            'table'=> 'qyura_diagnosticAwards',
            'where'=> $updatedDataWhere,
            'data'=> $updatedData
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
            'table'=> 'qyura_diagnosticAwards',
            'where'=>$updatedDataWhere,
            'data'=>$updatedData
        );
        $return = $this->diagnostic_model->customUpdate($option);
        echo $return;
        exit;
    }

    function diagnosticAwards($hospitalId) {
        $option = array(
            'table'=>'qyura_diagnosticAwards',
            'where'=> array('diagnosticAwards_diagnosticId'=>$hospitalId,'diagnosticAwards_deleted' => 0),
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
            'table'=>'qyura_diagnosticAwards',
            'where'=> array('diagnosticAwards_diagnosticId'=>$hospitalId,'diagnosticAwards_deleted' => 0),
        );
        $dataAwards = $this->diagnostic_model->customGet($option);
        if ($dataAwards) {
            $showTotalAwards = '';
            foreach ($dataAwards as $key => $val) {
                $showTotalAwards .= '<div class="row m-t-10">
        <div class="col-md-8 col-sm-8 col-xs-8">
           <input type="text" class="form-control" name="hospitalAwards_awardsName" id=' . $val->diagnosticAwards_id . ' value=' . $val->diagnosticAwards_awardsName . ' placeholder="FICCI Healthcare " />
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
    
    
    
    function addDiagnosticServices() {
        $Id = $this->input->post('diagnosticId');
        $service_name = $this->input->post('service_name');
        $data = array('diagnosticServices_serviceName' => $service_name, 'diagnosticServices_diagnosticId' => $Id);
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
        $updatedData = array('diagnosticServices_serviceName' => $awardsName);
        $updatedDataWhere = array('diagnosticServices_id' => $id);
        $option = array(
            'table'=> 'qyura_diagnosticServices',
            'where'=> $updatedDataWhere,
            'data'=> $updatedData
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
            'table'=> 'qyura_diagnosticServices',
            'where'=>$updatedDataWhere,
            'data'=>$updatedData
        );
        $return = $this->diagnostic_model->customUpdate($option);
        echo $return;
        exit;
    }

    function diagnosticServices($id) {
        $option = array(
            'table'=>'qyura_diagnosticServices',
            'where'=> array('diagnosticServices_diagnosticId'=>$id,'diagnosticServices_deleted' => 0),
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
            'table'=>'qyura_diagnosticServices',
            'where'=> array('diagnosticServices_diagnosticId'=>$id,'diagnosticServices_deleted' => 0),
        );
        $services = $this->diagnostic_model->customGet($option);
        if ($services) {
            $template = '';
            foreach ($services as $key => $val) {
                $template .= '<div class="row m-t-10">
        <div class="col-md-8 col-sm-8 col-xs-8">
           <input type="text" class="form-control" name="digAwards_ServiceName" id=' . $val->diagnosticServices_id . ' value=' . $val->diagnosticServices_serviceName . ' placeholder="FICCI Healthcare " />
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
    
    
    
    function diagnosticCategorys($diagnosticId){
        
        $Seleted =array (
           'diagnosticsHasCat_id','diagnosticsHasCat_diagnosticId','diagnosticsHasCat_diagnosticsCatId'
        );
        $Where = array(
            'diagnosticsHasCat_diagnosticId'=>$diagnosticId
        );
        $notIn = '';
        $hospitalData = $this->diagnostic_model->fetchTableData($Seleted,'qyura_diagnosticsHasCat',$Where);
        foreach($hospitalData as $key=>$val){
           $notIn []= $val->diagnosticsHasCat_diagnosticsCatId;
            
        }
        
        $selectTableData = array (
           'diagnosticsCat_catId','diagnosticsCat_catName'
        );
        $wheres = array(
           'diagnosticsCat_deleted' => 0
            
        );
        $data = $this->diagnostic_model->fetchTableData($selectTableData,'qyura_diagnosticsCat',$wheres,$notIn,'diagnosticsCat_catId');
        $specialist = '';
        foreach($data as $key=>$val){
        $specialist .='<li ><input type=checkbox class=diagonasticCheck name=speciality value='.$val->diagnosticsCat_catId.' /> '. $val->diagnosticsCat_catName .'</li>';
           
        }
       
        echo $specialist;
        exit; 
    }
    
    function diagnosticAllocatedCategorys($diagnosticId){
        
         $data = $this->diagnostic_model->fetchdiagnosticsDiagnosticCatData($diagnosticId);
        $allocatedSpecialist = '';
        foreach($data as $key=>$val){
        $allocatedSpecialist .='<li onClick=getDignosticPrize('.$diagnosticId.','. $val->diagnosticsHasCat_diagnosticsCatId .')>'. $val->diagnosticsCat_catName .'<input type=checkbox class=diagonasticAllocCheck name=allocSpeciality value='.$val->diagnosticsHasCat_id.' /></li>';
           
        }
        echo $allocatedSpecialist;
        exit;
    }
    
    function addDiagnosticHasCategory(){
          
        $id = $this->input->post('diagnosticId');
        $diagnosticsCat_diagnosticsCatId = $this->input->post('diagnosticsHasCat_diagnosticsCatId');
        $insertData = array(
            'diagnosticsHasCat_diagnosticsCatId' => $diagnosticsCat_diagnosticsCatId,
            'diagnosticsHasCat_diagnosticId' => $id,
            'creationTime' => strtotime(date("Y-m-d H:i:s"))
        );
        $option = array(
            'table'=>'qyura_diagnosticsHasCat',
            'data'=> $insertData
        );
        $return = $this->diagnostic_model->customInsert($option);
        echo $return;
        exit;
    }
    
    function revertDiagnosticHasCategory(){
        $id = $this->input->post('diagnosticId');
        $diagnosticsCat_id = $this->input->post('diagnosticsHasCat_id');
        $diagonasticData = array(
            'hospitalDiagnosticsCat_deleted' => 1,
            'modifyTime'=> strtotime(date("Y-m-d H:i:s"))
        );
        $diagonasticWhere = array('diagnosticsHasCat_id' => $diagnosticsCat_id,
            'diagnosticsHasCat_diagnosticId'=> $id);
        
        $option = array(
            'table' => 'qyura_diagnosticsHasCat',
            'where' => $diagonasticWhere
        );
        $return = $this->diagnostic_model->customDelete($option);
       echo $return ;
    }
    
    function diagnosticSpecialities($diagnosticId){
        
        $Seleted =array (
           'diagnosticSpecialities_id','diagnosticSpecialities_diagnosticId','diagnosticSpecialities_specialitiesId'
        );
        $Where = array(
            'diagnosticSpecialities_diagnosticId'=>$diagnosticId,
            'diagnosticSpecialities_deleted' => 0
        );
        $notIn = '';
        $hospitalData = $this->diagnostic_model->fetchTableData($Seleted,'qyura_diagnosticSpecialities',$Where);
        foreach($hospitalData as $key=>$val){
           $notIn []= $val->diagnosticSpecialities_specialitiesId;
            
        }
        
        $selectTableData = array (
           'specialities_id','specialities_name'
        );
        $wheres = array(
            'specialities_deleted' => 0,
            
        );
        $data = $this->diagnostic_model->fetchTableData($selectTableData,'qyura_specialities',$wheres,$notIn,'specialities_id');
        $specialist = '';
        foreach($data as $key=>$val){
        $specialist .='<li ><input type=checkbox class=diagonasticSpecialCheck name=speciality value='.$val->specialities_id.' /> '. $val->specialities_name .'</li>';
           
        }
       
        echo $specialist;
        exit; 
    }
    
    function diagnosticAllocatedSpecialities($diagnosticId){
        
         $data = $this->diagnostic_model->fetchdiagnosticsSpecialityData($diagnosticId);
        $allocatedSpecialist = '';
        foreach($data as $key=>$val){
        $allocatedSpecialist .='<li >'. $val->specialities_name .'<input type=checkbox class=diagonasticAllocSpecialCheck name=allocSpeciality value='.$val->diagnosticSpecialities_id.' /></li>';
           
        }
        echo $allocatedSpecialist;
        exit;
    }
    
    function addSpeciality(){
          
        $id = $this->input->post('diagnosticId');
        $diagnosticSpecialities_specialitiesId = $this->input->post('diagnosticSpecialities_specialitiesId');
        $insertData = array(
            'diagnosticSpecialities_specialitiesId' => $diagnosticSpecialities_specialitiesId,
            'diagnosticSpecialities_diagnosticId' => $id,
            'diagnosticSpecialities_deleted' => 0,
            'creationTime' => strtotime(date("Y-m-d H:i:s"))
        );
        $option = array(
            'table'=>'qyura_diagnosticSpecialities',
            'data'=> $insertData
        );
        $return = $this->diagnostic_model->customInsert($option);
        echo $return;
        exit;
    }
    
    function revertSpeciality(){
        $id = $this->input->post('diagnosticId');
        $diagnosticSpecialities_id = $this->input->post('diagnosticSpecialities_id');
        $diagonasticData = array(
            'diagnosticSpecialities_deleted' => 1,
            'modifyTime'=> strtotime(date("Y-m-d H:i:s"))
        );
        $diagonasticWhere = array('diagnosticSpecialities_id' => $diagnosticSpecialities_id,
            'diagnosticSpecialities_diagnosticId'=> $id);
        
        $option = array(
            'table' => 'qyura_diagnosticSpecialities',
            'where' => $diagonasticWhere,
            'data'=> $diagonasticData
        );
        $return = $this->diagnostic_model->customUpdate($option);
       echo $return ;
    }
    
    
    function getDiagnosticPrizeList(){
       $diagnosticId = $this->input->post('diagnosticId');
       $categoryId = $this->input->post('categoryId');
        $selectTableData = array (
           'quotationDetailTests_testName','quotationDetailTests_price','quotationDetailTests_id'
        );
        $where = array(
            'quotationDetailTests_diagnosticCatId' => $categoryId,
            'quotationDetailTests_MIprofileId' => $diagnosticId,
            'quotationDetailTests_deleted' => 0
            
        );
       $data = $this->diagnostic_model->fetchTableData($selectTableData,'qyura_quotationDetailTests',$where);

       $diagonasticTest = '';
        foreach($data as $key => $val){
            $diagonasticTest .='<tr onclick = fetchInstruction('.$val->quotationDetailTests_id.')> <td>'.$val->quotationDetailTests_testName.'</td><td><i class="fa fa-inr"></i> <a data-title="Enter username" data-pk="1" data-type="text" id="username" href="#" class="editable editable-click editable-open" data-original-title="Edit Price" title="" aria-describedby="popover939766">'.$val->quotationDetailTests_price.'</a>';
         $diagonasticTest .= '</td><td><a class="btn btn-success waves-effect waves-light m-b-5 " href="#">Edit</a></td></tr>';
        }
        echo $diagonasticTest;
        exit;
   }
   
    function detailDiagnosticInstruction(){
       $quotationDetailTests_id = $this->input->post('quotationDetailTests_id');
        $selectTableData = array (
           'quotationDetailTests_instruction'
        );
        $where = array(
            'quotationDetailTests_id' => $quotationDetailTests_id,
           'quotationDetailTests_deleted' => 0
            
        );
        $data = $this->diagnostic_model->fetchTableData($selectTableData,'qyura_quotationDetailTests',$where);
       $diagonasticTest = $data[0]->quotationDetailTests_instruction;
       echo $diagonasticTest;
       exit;
   }
   
}
