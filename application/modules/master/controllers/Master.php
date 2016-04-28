<?php

class Master extends MY_Controller {

    public $_error = array();
    public $_startTime = '';
    public $_endTime = '';

    public function __construct() {
        parent:: __construct();

        $this->load->model(array('Master_model', 'common_model'));
        $this->load->library('datatables');
        $this->load->helper('common');
    }
        
    //Degree 
    function degree() {
        $option = array(
            'table' => 'qyura_degree',
            'select' => '*',
            'where' => array('qyura_degree.degree_deleted' => 0),
            'order' => array('degree_SName' => 'asc'),
            'single' => FALSE
        );
        $data['degrees_list'] = $this->common_model->customGet($option);
        $data['title'] = 'List Degrees';
        $this->load->super_admin_template('degrees', $data, 'masterScript');
    }
    
    function saveDegrees() {
        $this->bf_form_validation->set_rules("degree_SName", "Small Name", 'required|xss_clean');
        $this->bf_form_validation->set_rules("degree_FName", "Full Name", 'required|xss_clean');

        if ($this->bf_form_validation->run() == FALSE) {
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => ajax_validation_errors());
            echo json_encode($responce);
        } else {
            $degree_SName = $this->input->post('degree_SName');
            $degree_FName = $this->input->post('degree_FName');
            $records_array = array(
                'degree_SName' => $degree_SName,
                'degree_FName' => $degree_FName,
		'status'       => 2,
                'creationTime' => strtotime(date("d-m-Y H:i:s"))
            );
            $options = array
                (
                'data' => $records_array,
                'table' => 'qyura_degree'
            );
            $degree_insert = $this->common_model->customInsert($options);
            if ($degree_insert) {
                $responce = array('status' => 1, 'msg' => "Degree added successfully", 'url' => "master/degree/");
            } else {
                $error = array("TopError" => "<strong>Something went wrong while updating your data... sorry.</strong>");
                $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $error);
            }
            echo json_encode($responce);
        }
    }
    
    function editDegrees(){
        $total_count = $this->input->post("total_count");
        for($i = 1;$i < $total_count; $i++){
            $this->bf_form_validation->set_rules("degree_id_$i", "Degree Id", 'xss_clean');
            $this->bf_form_validation->set_rules("degree_SName_$i", "Abbrivation", 'xss_clean');
            $this->bf_form_validation->set_rules("degree_FName_$i", "Name", 'required|xss_clean');
        }
        $this->bf_form_validation->set_rules("total_count", "Count", 'xss_clean');
        if ($this->bf_form_validation->run() == FALSE) {
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => ajax_validation_errors());
            echo json_encode($responce);
        } else {
            
            for($j = 1; $j < $total_count; $j++){
                $degree_id = $this->input->post("degree_id_$j");
                $degree_SName = $this->input->post("degree_SName_$j");
                $degree_FName = $this->input->post("degree_FName_$j");
                $records_array = array(
                    'degree_SName' => $degree_SName,
                    'degree_FName' => $degree_FName,
                    'modifyTime' => strtotime(date("d-m-Y H:i:s"))
                );

                $options = array
                (
                    'where' => array('degree_id' => $degree_id),
                    'data'  => $records_array,
                    'table' => 'qyura_degree'
                );
                $response = $this->common_model->customUpdate($options);
            }
            if ($response) {
                $responce = array('status' => 1, 'msg' => "Record Update successfully", 'url' => "master/degree/");
            } else {
                $error = array("TopError" => "<strong>Something went wrong while updating your data... sorry.</strong>");
                $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $error);
            }
            echo json_encode($responce);
        }
    }

    function degreePublish() {
        $ena_id = $this->input->post('id');
        $status = $this->input->post('status');
        if ($ena_id != '' && $status != '') {
            //Group
            if ($status == 2) {
                $update_data['status'] = 3;
            } else {
                $update_data['status'] = 2;
            }
            $where = array('degree_id' => $ena_id);
            $updateOptions = array
                (
                'where' => $where,
                'data'  => $update_data,
                'table' => 'qyura_degree'
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
    //Degree End
    
    //Insurance
    function insurance() {
        $option = array(
            'table' => 'qyura_insurance',
            'select' => '*',
            'where' => array('qyura_insurance.insurance_deleted' => 0),
            'order' => array('insurance_Name' => 'asc'),
            'single' => FALSE
        );
        $data['qyura_insurance'] = $this->common_model->customGet($option);
        $data['title'] = 'Insurance List';
        $this->load->super_admin_template('insurance', $data, 'masterScript');
    }
    
    function saveInsurance() {
        
        $this->bf_form_validation->set_rules("insurance_Name", "Insurance Name", 'required|xss_clean');
        $this->bf_form_validation->set_rules("insurance_detail", "Insurance Detail", 'required|xss_clean');
        if (empty($_FILES['avatar_file']['name'])) {
            $this->bf_form_validation->set_rules('avatar_file', 'File', 'required');
        }

        if ($this->bf_form_validation->run() == FALSE) {
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => ajax_validation_errors());
            echo json_encode($responce);
        } else {
            $imagesname = '';
            if ($_FILES['avatar_file']['name']) {
                $path = realpath(FCPATH . 'assets/insuranceImages/3x/');
                $upload_data = $this->input->post('avatar_data');
                $upload_data = json_decode($upload_data);

                $original_imagesname = $this->uploadImageWithThumb($upload_data, 'avatar_file', $path, 'assets/insuranceImages/', './assets/insuranceImages/3x/', 'insurance');

                if (empty($original_imagesname)) {
                    $this->session->set_flashdata('valid_upload', $this->error_message);
                } else {
                    $imagesname = $original_imagesname;
                }
            }

            $insurance_Name = $this->input->post('insurance_Name');
            $insurance_detail = $this->input->post('insurance_detail');
            $records_array = array(
                'insurance_Name' => $insurance_Name,
                'insurance_detail' => $insurance_detail,
                'insurance_img' => $imagesname,
		'status'       => 2,
                'creationTime' => strtotime(date("d-m-Y H:i:s"))
            );
            $options = array
                (
                'data' => $records_array,
                'table' => 'qyura_insurance'
            );
            $insurance_insert = $this->common_model->customInsert($options);
            if ($insurance_insert) {
                $responce = array('status' => 1, 'msg' => "Insurance added successfully", 'url' => "master/insurance/");
            } else {
                $error = array("TopError" => "<strong>Something went wrong while updating your data... sorry.</strong>");
                $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $error);
            }
            echo json_encode($responce);
        }
    }
    
    function editInsuranceView($insuranceId) {
        $option = array(
            'table' => 'qyura_insurance',
            'select' => '*',
            'where' => array('qyura_insurance.insurance_deleted' => 0, 'qyura_insurance.insurance_id' => $insuranceId),
            'single' => TRUE
        );
        $data['insuranceEdit'] = $this->common_model->customGet($option);
        $data['title'] = 'Edit Insurance';
        $this->load->super_admin_template('insuranceEdit', $data, 'masterScript');
    }
    
    function editInsurance(){
        
        $id = $this->input->post('insurance_id');

        $this->bf_form_validation->set_rules("insurance_Name", "Insurance Name", 'required|xss_clean');
        $this->bf_form_validation->set_rules("insurance_detail", "Insurance Detail", 'required|xss_clean');
      
        if ($this->bf_form_validation->run() === False) {

            $option = array(
                 'table' => 'qyura_insurance',
                 'select' => '*',
                 'where' => array('qyura_insurance.insurance_deleted' => 0, 'qyura_insurance.insurance_id' => $id),
                 'single' => TRUE
             );
             $data['insuranceEdit'] = $this->common_model->customGet($option);
             $data['title'] = 'Edit Insurance';
             $this->load->super_admin_template('insuranceEdit', $data, 'masterScript');
        } else {
            
            $imagesname = '';
            if (isset($_FILES['avatar_file']['name']) && $_FILES['avatar_file']['name'] != NULL) {
                $path = realpath(FCPATH . 'assets/insuranceImages/3x/');
                $upload_data = $this->input->post('avatar_data');
                $upload_data = json_decode($upload_data);

                $original_imagesname = $this->uploadImageWithThumb($upload_data, 'avatar_file', $path, 'assets/insuranceImages/', './assets/insuranceImages/3x/', 'Insurance');

                if (empty($original_imagesname)) {
                    $this->session->set_flashdata('valid_upload', $this->error_message);
                } else {
                    $imagesname = $original_imagesname;
                }
            }
            
            $insurance_Name = $this->input->post('insurance_Name');
            $insurance_detail = $this->input->post('insurance_detail');
            $records_array = array(
                'insurance_Name' => $insurance_Name,
                'insurance_detail' => $insurance_detail,
                'modifyTime' => strtotime(date("d-m-Y H:i:s"))
            );
            if(isset($imagesname) && $imagesname != ''){
                $records_array['insurance_img'] = $imagesname;
            }
            $where = array(
                'insurance_id' => $id
            );
            $option = array(
                'table' => 'qyura_insurance',
                'where' => $where,
                'data' => $records_array
            );
            $response = $this->common_model->customUpdate($option);
            if ($response) {
                $this->session->set_flashdata('message', 'Record has been updated successfully!');
                redirect('master/insurance');
            } else {
                $this->session->set_flashdata('error', 'Failed to updated records!');
                redirect('master/insurance');
            }
        }
    }

    function insurancePublish() {
        $ena_id = $this->input->post('id');
        $status = $this->input->post('status');
        if ($ena_id != '' && $status != '') {
            //Group
            if ($status == 2) {
                $update_data['status'] = 3;
            } else {
                $update_data['status'] = 2;
            }
            $where = array('insurance_id' => $ena_id);
            $updateOptions = array
                (
                'where' => $where,
                'data'  => $update_data,
                'table' => 'qyura_insurance'
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
    //Insurance End
    
    //Specialities
    function specialities() {
        $option = array(
            'table' => 'qyura_specialities',
            'select' => '*',
            'where' => array('qyura_specialities.specialities_deleted' => 0,'qyura_specialities.type' => 0),
            'order' => array('specialities_name' => 'asc'),
            'single' => FALSE
        );
        $data['specialityList'] = $this->common_model->customGet($option);
        $data['title'] = 'Speciality List';
        $this->load->super_admin_template('specialities', $data, 'masterScript');
    }

    function saveSpecialities() {

       
        $this->bf_form_validation->set_rules("specialityName", "Speciality", 'required|xss_clean');
        $this->bf_form_validation->set_rules("specialityNamedoctor", "Doctor name", 'required|xss_clean');
        $this->bf_form_validation->set_rules("keywords", "Keywords/Tags", 'xss_clean');
        if (empty($_FILES['avatar_file']['name'])) {
            $this->bf_form_validation->set_rules('avatar_file', 'File', 'required');
        }

        if ($this->bf_form_validation->run() == FALSE) {
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => ajax_validation_errors());
            echo json_encode($responce);
        } else {

            $imagesname = '';
            if ($_FILES['avatar_file']['name']) {
                $path = realpath(FCPATH . 'assets/specialityImages/3x/');
                $upload_data = $this->input->post('avatar_data');
                $upload_data = json_decode($upload_data);

                $original_imagesname = $this->uploadImageWithThumb($upload_data, 'avatar_file', $path, 'assets/specialityImages/', './assets/specialityImages/thumb/', 'special');

                if (empty($original_imagesname)) {
                    $this->session->set_flashdata('valid_upload', $this->error_message);
                } else {
                    $imagesname = $original_imagesname;
                }
            }
            $specialityName = $this->input->post('specialityName');
            $specialityNamedoctor = $this->input->post('specialityNamedoctor');
            $keywords = $this->input->post('keywords');
	    $type = $this->input->post('specialityType');

            $records_array = array(
                'specialities_name' => $specialityName,
                'speciality_tag' => $keywords,
                'specialities_drName' => $specialityNamedoctor,
                'specialities_img' => $imagesname,
		'type' => $type,
		'status' => 2,
                'creationTime' => strtotime(date("d-m-Y H:i:s"))
            );
            $options = array
                (
                'data' => $records_array,
                'table' => 'qyura_specialities'
            );
            $degree_insert = $this->common_model->customInsert($options);
            if ($degree_insert) {
                $responce = array('status' => 1, 'msg' => "Speciality added successfully", 'url' => "master/specialities/");
            } else {
                $error = array("TopError" => "<strong>Something went wrong while updating your data... sorry.</strong>");
                $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $error);
            }
            echo json_encode($responce);
        }
    }

    function editSpecialitiesView($specialityId) {
        $option = array(
            'table' => 'qyura_specialities',
            'select' => '*',
            'where' => array('qyura_specialities.specialities_deleted' => 0, 'qyura_specialities.specialities_id' => $specialityId, 'qyura_specialities.type' => 0),
            'order' => array('specialities_name' => 'asc'),
            'single' => FALSE
        );
        $data['specialityList'] = $this->common_model->customGet($option);
        $data['title'] = 'Edit Speciality';
        $this->load->super_admin_template('specialityEdit', $data, 'masterScript');
    }

    function editspeciality() {

        $id = $this->input->post('specialityId');

        $this->bf_form_validation->set_rules("specialityName", "Speciality", 'required|xss_clean');
        $this->bf_form_validation->set_rules("specialityNamedoctor", "Doctor name", 'required|xss_clean');
        $this->bf_form_validation->set_rules("keywords", "Keywords/Tags", 'xss_clean');
        
        if ($this->bf_form_validation->run() === False) {

            $option = array(
                'table' => 'qyura_specialities',
                'select' => '*',
                'where' => array('qyura_specialities.specialities_deleted' => 0, 'qyura_specialities.specialities_id' => $id),
                'order' => array('specialities_name' => 'asc'),
                'single' => FALSE
            );
            $data['specialityList'] = $this->common_model->customGet($option);
            $data['title'] = 'Edit Speciality';

            $this->load->super_admin_template('specialityEdit', $data, 'masterScript');
        } else {
            
            $imagesname = '';
            if (isset($_FILES['avatar_file']['name']) && $_FILES['avatar_file']['name'] != NULL) {
                $path = realpath(FCPATH . 'assets/specialityImages/3x/');
                $upload_data = $this->input->post('avatar_data');
                $upload_data = json_decode($upload_data);

                $original_imagesname = $this->uploadImageWithThumb($upload_data, 'avatar_file', $path, 'assets/specialityImages/', './assets/specialityImages/3x/', 'special');

                if (empty($original_imagesname)) {
                    $this->session->set_flashdata('valid_upload', $this->error_message);
                } else {
                    $imagesname = $original_imagesname;
                }
            }
            
            $specialityName = $this->input->post('specialityName');
            $specialityNamedoctor = $this->input->post('specialityNamedoctor');
            $keywords = $this->input->post('keywords');
            $records_array = array(
                'specialities_name' => $specialityName,
                'speciality_tag' => $keywords,
                'specialities_drName' => $specialityNamedoctor,
                'specialities_img' => $imagesname,
                'modifyTime' => strtotime(date("d-m-Y H:i:s"))
            );
            if(empty($imagesname) || $imagesname != '' || $imagesname === NULL){
                unset($records_array['specialities_img']);
            }
            $where = array(
                'specialities_id' => $id
            );
            $option = array(
                'table' => 'qyura_specialities',
                'where' => $where,
                'data' => $records_array
            );
            $response = $this->common_model->customUpdate($option);
            if ($response) {
                $this->session->set_flashdata('message', 'Record has been updated successfully!');
                redirect('master/specialities');
            } else {
                $this->session->set_flashdata('error', 'Failed to updated records!');
                redirect('master/specialities');
            }
        }
    }

    function specialitydelete() {
        $del_id = $this->input->post('id');

        if ($del_id) {
            //Group
            $where = array('specialities_id' => $del_id);
            $update_data['specialities_deleted'] = 1;
            $updateOptions = array
                (
                'where' => $where,
                'data' => $update_data,
                'table' => 'qyura_specialities'
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
    //Specialities End
    
    //Mi Type
    function miType() {
        $option = array(
            'table' => 'qyura_hospitalType',
            'select' => '*',
            'where' => array('qyura_hospitalType.hospitalType_deleted' => 0),
            'order' => array('hospitalType_name' => 'asc'),
            'single' => FALSE
        );
        $data['miList'] = $this->common_model->customGet($option);
        $data['title'] = "Mi Types";
        $this->load->super_admin_template('mitype', $data, 'masterScript');
    }
    
    function miTypeSave() {
        
        $this->bf_form_validation->set_rules("hospitalType_name", "Name", 'required|xss_clean');
        if ($this->bf_form_validation->run() == FALSE) {
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => ajax_validation_errors());
            echo json_encode($responce);
        } else {
            $hospitalType_id = $this->input->post('hospitalType_id');
            $hospitalType_name = $this->input->post('hospitalType_name');
            $hospitalType_miRole = $this->input->post('hospitalType_miRole');
            $records_array = array(
                'hospitalType_name' => $hospitalType_name,
                'hospitalType_miRole' => $hospitalType_miRole,
		'status' => 2,
                'creationTime' => strtotime(date("d-m-Y H:i:s"))
            );
            $options = array
            (
                'data' => $records_array,
                'table' => 'qyura_hospitalType'
            );
            $response = $this->common_model->customInsert($options);
            if ($response) {
                $this->session->set_flashdata('active_tag', $hospitalType_miRole);
                $responce = array('status' => 1, 'msg' => "Record Added successfully", 'url' => "master/miType/");
            } else {
                $error = array("TopError" => "<strong>Something went wrong while updating your data... sorry.</strong>");
                $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $error);
            }
            echo json_encode($responce);
        }
    }
    
    function miTypeEdit() {
        
        $total_count = $this->input->post("total_count");
        for($i = 1;$i < $total_count; $i++){
            $this->bf_form_validation->set_rules("hospitalType_id_$i", "Id", 'xss_clean');
            $this->bf_form_validation->set_rules("hospitalType_name_$i", "Name", 'required|xss_clean');
        }
        $this->bf_form_validation->set_rules("total_count", "Count", 'xss_clean');
        if ($this->bf_form_validation->run() == FALSE) {
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => ajax_validation_errors());
            echo json_encode($responce);
        } else {
            
            for($j = 1; $j < $total_count; $j++){
                $hospitalType_id = $this->input->post("hospitalType_id_$j");
                $hospitalType_name = $this->input->post("hospitalType_name_$j");
                $hospitalType_miRole = $this->input->post('hospitalType_miRole');
                $records_array = array(
                    'hospitalType_name' => $hospitalType_name,
                    'modifyTime' => strtotime(date("d-m-Y H:i:s"))
                );

                $options = array
                (
                    'where' => array('hospitalType_id' => $hospitalType_id),
                    'data'  => $records_array,
                    'table' => 'qyura_hospitalType'
                );
                $response = $this->common_model->customUpdate($options);
            }
            if ($response) {
                $this->session->set_flashdata('active_tag', $hospitalType_miRole);
                $responce = array('status' => 1, 'msg' => "Record Update successfully", 'url' => "master/miType/");
            } else {
                $error = array("TopError" => "<strong>Something went wrong while updating your data... sorry.</strong>");
                $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $error);
            }
            echo json_encode($responce);
        }
    }
    
    function miTypePublish() {
        $ena_id = $this->input->post('id');
        $status = $this->input->post('status');
        $activeTag = $this->input->post('activeTag');
        if ($ena_id != '' && $status != '') {
            //Group
            if ($status == 3) {
                $update_data['status'] = 2;
            } else {
                $update_data['status'] = 3;
            }
            $where = array('hospitalType_id' => $ena_id);
            $updateOptions = array
                (
                'where' => $where,
                'data'  => $update_data,
                'table' => 'qyura_hospitalType'
            );

            $update = $this->common_model->customUpdate($updateOptions);

            if ($update){
                $this->session->set_flashdata('active_tag', $activeTag);
                echo $update;
            }else{
                echo '0';
            }
        }
        else {
            echo 0;
        }
    }
    //Mi Type
    
    //Specialities
    function diagnostic() {
        $option = array(
            'table' => 'qyura_diagnosticsCat',
            'select' => '*',
            'where' => array('qyura_diagnosticsCat.diagnosticsCat_deleted' => 0),
            'order' => array('diagnosticsCat_catName' => 'asc'),
            'single' => FALSE
        );
        $data['diagnosticList'] = $this->common_model->customGet($option);
        $data['title'] = 'Diagnostic List';
        $this->load->super_admin_template('diagnostic', $data, 'masterScript');
    }

    function saveDiagnostic() {
        $this->bf_form_validation->set_rules("diagnosticName", "Diagnostic", 'required|xss_clean');
        if (empty($_FILES['avatar_file']['name'])) {
            $this->bf_form_validation->set_rules('avatar_file', 'File', 'required');
        }
        if ($this->bf_form_validation->run() == FALSE) {
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => ajax_validation_errors());
            echo json_encode($responce);
        } else {
            $imagesname = '';
            if ($_FILES['avatar_file']['name']) {
                $path = realpath(FCPATH . 'assets/diagnosticsCatImages/');
                $upload_data = $this->input->post('avatar_data');
                $upload_data = json_decode($upload_data);
                $original_imagesname = $this->uploadImageWithThumb($upload_data, 'avatar_file', $path, 'assets/diagnosticsCatImages/', './assets/diagnosticsCatImages/', 'Diagnostics');
                if (empty($original_imagesname)) {
                    $this->session->set_flashdata('valid_upload', $this->error_message);
                } else {
                    $imagesname = $original_imagesname;
                }
            }
            
            $diagnosticName = $this->input->post('diagnosticName');
            
            $records_array = array(
                'diagnosticsCat_catName' => $diagnosticName,
                'diagnosticsCat_catImage' => $imagesname,
		'status' => 2,
                'creationTime' => strtotime(date("d-m-Y H:i:s"))
            );
            $options = array
            (
                'data' => $records_array,
                'table' => 'qyura_diagnosticsCat'
            );
            $degree_insert = $this->common_model->customInsert($options);
            if ($degree_insert) {
                $responce = array('status' => 1, 'msg' => "Diagnostic added successfully", 'url' => "master/diagnostic/");
            } else {
                $error = array("TopError" => "<strong>Something went wrong while updating your data... sorry.</strong>");
                $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $error);
            }
            echo json_encode($responce);
        }
    }

    function editDiagnosticsView($diagnosticId) {
        $option = array(
            'table' => 'qyura_diagnosticsCat',
            'select' => '*',
            'where' => array('qyura_diagnosticsCat.diagnosticsCat_deleted' => 0, 'qyura_diagnosticsCat.diagnosticsCat_catId' => $diagnosticId),
            'order' => array('diagnosticsCat_catName' => 'asc'),
            'single' => TRUE
        );
        $data['diagnosticEdit'] = $this->common_model->customGet($option);
        $data['title'] = 'Edit Diagnostic';
        $this->load->super_admin_template('diagnosticEdit', $data, 'masterScript');
    }

    function editDiagnostic() {
        
        $id = $this->input->post('diagnosticsCat_catId');

        $this->bf_form_validation->set_rules("diagnosticsCat_catName", "Diagnostic Name", 'required|xss_clean');
        
        if ($this->bf_form_validation->run() === False) {
            $option = array(
                'table' => 'qyura_diagnosticsCat',
                'select' => '*',
                'where' => array('qyura_diagnosticsCat.diagnosticsCat_deleted' => 0, 'qyura_diagnosticsCat.diagnosticsCat_catId' => $id),
                'order' => array('diagnosticsCat_catName' => 'asc'),
                'single' => TRUE
            );
            $data['diagnosticEdit'] = $this->common_model->customGet($option);
            $data['title'] = 'Edit Diagnostic';
            $this->load->super_admin_template('diagnosticEdit', $data, 'masterScript');
        } else {
            
            $imagesname = '';
            if (isset($_FILES['avatar_file']['name']) && $_FILES['avatar_file']['name'] != NULL) {
                $path = realpath(FCPATH . 'assets/diagnosticsCatImages/');
                $upload_data = $this->input->post('avatar_data');
                $upload_data = json_decode($upload_data);

                $original_imagesname = $this->uploadImageWithThumb($upload_data, 'avatar_file', $path, 'assets/diagnosticsCatImages/', './assets/diagnosticsCatImages/', 'Diagnostics');

                if (empty($original_imagesname)) {
                    $this->session->set_flashdata('valid_upload', $this->error_message);
                } else {
                    $imagesname = $original_imagesname;
                }
            }
            
            $diagnosticsCat_catName = $this->input->post('diagnosticsCat_catName');
            
            $records_array = array(
                'diagnosticsCat_catName' => $diagnosticsCat_catName,
                'modifyTime' => strtotime(date("d-m-Y H:i:s"))
            );
            if(isset($imagesname) && $imagesname != ''){
                $records_array['diagnosticsCat_catImage'] = $imagesname;
            }
            $where = array(
                'diagnosticsCat_catId' => $id
            );
            $option = array(
                'table' => 'qyura_diagnosticsCat',
                'where' => $where,
                'data' => $records_array
            );
            $response = $this->common_model->customUpdate($option);
            if ($response) {
                $this->session->set_flashdata('message', 'Record has been updated successfully!');
                redirect('master/diagnostic');
            } else {
                $this->session->set_flashdata('error', 'Failed to updated records!');
                redirect('master/diagnostic');
            }
        }
    }

    function diagSpecPublish() {
        $ena_id = $this->input->post('id');
        $status = $this->input->post('status');
        if ($ena_id != '' && $status != '') {
            //Group
            if ($status == 2) {
                $update_data['status'] = 3;
            } else {
                $update_data['status'] = 2;
            }
            $where = array('diagnosticsCat_catId' => $ena_id);
            $updateOptions = array
                (
                'where' => $where,
                'data'  => $update_data,
                'table' => 'qyura_diagnosticsCat'
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
    //Specialities End

    //doctor speciality
    function docspecialities() {
        $option = array(
            'table' => 'qyura_specialities',
            'select' => '*',
            'where' => array('qyura_specialities.specialities_deleted' => 0, 'qyura_specialities.type' => 1,),
            'order' => array('specialities_name' => 'asc'),
            'single' => FALSE
        );
        $data['specialityList'] = $this->common_model->customGet($option);
        $data['title'] = 'Doctor Speciality List';
        $this->load->super_admin_template('doctorSpecialities', $data, 'masterScript');
    }

    function docsaveSpecialities() {
        $this->bf_form_validation->set_rules("specialityName", "Scientific Name", 'required|xss_clean');
        $this->bf_form_validation->set_rules("specialityNamedoctor", "General Name", 'required|xss_clean');
        $this->bf_form_validation->set_rules("keywords", "Keywords/Tags", 'xss_clean');
        if (empty($_FILES['avatar_file']['name'])) {
            $this->bf_form_validation->set_rules('avatar_file', 'File', 'required');
        }

        if ($this->bf_form_validation->run() == FALSE) {
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => ajax_validation_errors());
            echo json_encode($responce);
        } else {
            $imagesname = '';
            if ($_FILES['avatar_file']['name']) {
                $path = realpath(FCPATH . 'assets/specialityImages/3x/');
                $upload_data = $this->input->post('avatar_data');
                $upload_data = json_decode($upload_data);

                $original_imagesname = $this->uploadImageWithThumb($upload_data, 'avatar_file', $path, 'assets/specialityImages/', './assets/specialityImages/3x/', 'special');

                if (empty($original_imagesname)) {
                    $this->session->set_flashdata('valid_upload', $this->error_message);
                } else {
                    $imagesname = $original_imagesname;
                }
            }

            $specialityName = $this->input->post('specialityName');
            $specialityNamedoctor = $this->input->post('specialityNamedoctor');
            $keywords = $this->input->post('keywords');
            $type = $this->input->post('specialityType'); 
            $records_array = array(
                'specialities_name' => $specialityName,
                'speciality_tag' => $keywords,
                'specialities_drName' => $specialityNamedoctor,
                'specialities_img' => $imagesname,
                'type' => $type,
		'status' => 2,
                'creationTime' => strtotime(date("d-m-Y H:i:s"))
            );
            $options = array
                (
                'data' => $records_array,
                'table' => 'qyura_specialities'
            );
            $degree_insert = $this->common_model->customInsert($options);
            if ($degree_insert) {
                $responce = array('status' => 1, 'msg' => "Doctor Speciality added successfully", 'url' => "master/docspecialities/");
            } else {
                $error = array("TopError" => "<strong>Something went wrong while updating your data... sorry.</strong>");
                $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $error);
            }
            echo json_encode($responce);
        }
    }

    function doceditSpecialitiesView($specialityId) {
        $option = array(
            'table' => 'qyura_specialities',
            'select' => '*',
            'where' => array('qyura_specialities.specialities_deleted' => 0, 'qyura_specialities.specialities_id' => $specialityId, 'qyura_specialities.type' => 1, ),
            'order' => array('specialities_name' => 'asc'),
            'single' => FALSE
        );
        $data['specialityList'] = $this->common_model->customGet($option);
        $data['title'] = 'Edit Doctor Speciality';
        $this->load->super_admin_template('doctorspecialityEdit', $data, 'masterScript');
    }

    function doceditspeciality() {

        $id = $this->input->post('specialityId');

        $this->bf_form_validation->set_rules("specialityName", "Scientific Name", 'required|xss_clean');
        $this->bf_form_validation->set_rules("specialityNamedoctor", "General Name", 'required|xss_clean');
        $this->bf_form_validation->set_rules("keywords", "Keywords/Tags", 'xss_clean');
        
        if ($this->bf_form_validation->run() === False) {

            $option = array(
                'table' => 'qyura_specialities',
                'select' => '*',
                'where' => array('qyura_specialities.specialities_deleted' => 0, 'qyura_specialities.specialities_id' => $id, 'qyura_specialities.type' => 1,),
                'order' => array('specialities_name' => 'asc'),
                'single' => FALSE
            );
            $data['specialityList'] = $this->common_model->customGet($option);
            $data['title'] = 'Edit Doctor Speciality';

            $this->load->super_admin_template('specialityEdit', $data, 'masterScript');
        } else {
            
            $imagesname = '';
            if (isset($_FILES['avatar_file']['name']) && $_FILES['avatar_file']['name'] != NULL) {
                $path = realpath(FCPATH . 'assets/specialityImages/3x/');
                $upload_data = $this->input->post('avatar_data');
                $upload_data = json_decode($upload_data);

                $original_imagesname = $this->uploadImageWithThumb($upload_data, 'avatar_file', $path, 'assets/specialityImages/', './assets/specialityImages/3x/', 'special');

                if (empty($original_imagesname)) {
                    $this->session->set_flashdata('valid_upload', $this->error_message);
                } else {
                    $imagesname = $original_imagesname;
                }
            }
            
            $specialityName = $this->input->post('specialityName');
            $specialityNamedoctor = $this->input->post('specialityNamedoctor');
            $keywords = $this->input->post('keywords');
            $type = $this->input->post('specialityType'); 
            $records_array = array(
                'specialities_name' => $specialityName,
                'speciality_tag' => $keywords,
                'specialities_drName' => $specialityNamedoctor,
                'type' => $type,
                'modifyTime' => strtotime(date("d-m-Y H:i:s"))
            );
            if(isset($imagesname) && $imagesname != ''){
                $records_array['specialities_img'] = $imagesname;
            }
            $where = array(
                'specialities_id' => $id
            );
            $option = array(
                'table' => 'qyura_specialities',
                'where' => $where,
                'data' => $records_array
            );
            $response = $this->common_model->customUpdate($option);
            if ($response) {
                $this->session->set_flashdata('message', 'Record has been updated successfully!');
                redirect('master/docspecialities');
            } else {
                $this->session->set_flashdata('error', 'Failed to updated records!');
                redirect('master/docspecialities');
            }
        }
    }

    function docspecialitydelete() {
        $del_id = $this->input->post('id');

        if ($del_id) {
            //Group
            $where = array('specialities_id' => $del_id);
            $update_data['specialities_deleted'] = 1;
            $updateOptions = array
                (
                'where' => $where,
                'data' => $update_data,
                'table' => 'qyura_specialities'
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
    // doctor speciality end

    function specialityPublish() {
        $ena_id = $this->input->post('id');
        $status = $this->input->post('status');
        if ($ena_id != '' && $status != '') {
            //Group
            if ($status == 2) {
                $update_data['status'] = 3;
            } else {
                $update_data['status'] = 2;
            }
            $where = array('specialities_id' => $ena_id);
            $updateOptions = array
                (
                'where' => $where,
                'data'  => $update_data,
                'table' => 'qyura_specialities'
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

    //award agency
    function awardAgency() {
        $option = array(
            'table' => 'qyura_awardAgency',
            'select' => '*',
            'where' => array('qyura_awardAgency.agency_deleted' => 0),
            'order' => array('agency_name' => 'asc'),
            'single' => FALSE
        );
        $data['awardAgency_list'] = $this->common_model->customGet($option);
        $data['title'] = 'Award Agency List';
        $this->load->super_admin_template('awardAgency', $data, 'masterScript');
    }
    
    function saveawardAgency() {
        $this->bf_form_validation->set_rules("agency_name", "Award Agency Name", 'required|xss_clean');
      

        if ($this->bf_form_validation->run() == FALSE) {
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => ajax_validation_errors());
            echo json_encode($responce);
        } else {
            $agency_name = $this->input->post('agency_name');
         
            $records_array = array(
                'agency_name' => $agency_name,
		'status' => 2, 
                'creationTime' => strtotime(date("d-m-Y H:i:s"))
            );
            $options = array
                (
                'data' => $records_array,
                'table' => 'qyura_awardAgency'
            );
            $degree_insert = $this->common_model->customInsert($options);
            if ($degree_insert) {
                $responce = array('status' => 1, 'msg' => "Award Agency added successfully", 'url' => "master/awardAgency/");
            } else {
                $error = array("TopError" => "<strong>Something went wrong while updating your data... sorry.</strong>");
                $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $error);
            }
            echo json_encode($responce);
        }
    }
    
    function editawardAgency(){
        $total_count = $this->input->post("total_count");
        for($i = 1;$i < $total_count; $i++){
            $this->bf_form_validation->set_rules("awardAgency_id_$i", "Degree Id", 'xss_clean');
            $this->bf_form_validation->set_rules("agency_name_$i", "Award Agency Name", 'xss_clean');
            
        }
        $this->bf_form_validation->set_rules("total_count", "Count", 'xss_clean');
        if ($this->bf_form_validation->run() == FALSE) {
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => ajax_validation_errors());
            echo json_encode($responce);
        } else {
            
            for($j = 1; $j < $total_count; $j++){
                $awardAgency_id = $this->input->post("awardAgency_id_$j");
                $agencyName = $this->input->post("agency_name_$j");
                $records_array = array(
                    'agency_name' => $agencyName,
                    'modifyTime' => strtotime(date("d-m-Y H:i:s"))
                );

                $options = array
                (
                    'where' => array('awardAgency_id' => $awardAgency_id),
                    'data'  => $records_array,
                    'table' => 'qyura_awardAgency'
                );
                $response = $this->common_model->customUpdate($options);
            }
            if ($response) {
                $responce = array('status' => 1, 'msg' => "Record Updated successfully", 'url' => "master/awardAgency/");
            } else {
                $error = array("TopError" => "<strong>Something went wrong while updating your data... sorry.</strong>");
                $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $error);
            }
            echo json_encode($responce);
        }
    }

    function awardAgencyPublish() {
        $ena_id = $this->input->post('id');
        $status = $this->input->post('status');
        if ($ena_id != '' && $status != '') {
            //Group
            if ($status == 2) {
                $update_data['status'] = 3;
            } else {
                $update_data['status'] = 2;
            }
            $where = array('awardAgency_id' => $ena_id);
            $updateOptions = array
                (
                'where' => $where,
                'data'  => $update_data,
                'table' => 'qyura_awardAgency'
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
    //award agency end
    
    //Department starts
    function department() {
        $option = array(
            'table' => 'qyura_department',
            'select' => '*',
            'where' => array('qyura_department.department_deleted' => 0),
            'order' => array('department_name' => 'asc'),
            'single' => FALSE
        );
        $data['departmentList'] = $this->common_model->customGet($option);
        $data['title'] = "Departments";
        $this->load->super_admin_template('department', $data, 'masterScript');
    }

    function departmentSave() {
        $this->bf_form_validation->set_rules("department_name", "Name", 'required|xss_clean');
        if ($this->bf_form_validation->run() == FALSE) {
            $response = array('status' => 0, 'isAlive' => TRUE, 'errors' => ajax_validation_errors());
            echo json_encode($response);
        } else {
            $department_id = $this->input->post('department_id');
            $department_name = $this->input->post('department_name');
            $records_array = array(
                'department_name' => $department_name,
                'creationTime' => strtotime(date("d-m-Y H:i:s"))
            );
            $options = array
                (
                'data' => $records_array,
                'table' => 'qyura_department'
            );
            $response = $this->common_model->customInsert($options);
            if ($response) {
                $response = array('status' => 2, 'msg' => "Record Added successfully", 'url' => "master/department");
            } else {
                $error = array("TopError" => "<strong>Something went wrong while updating your data... sorry.</strong>");
                $response = array('status' => 0, 'isAlive' => TRUE, 'errors' => $error);
            }
            echo json_encode($response);
        }
    }

    function departmentEdit() {
        $total_count = $this->input->post("total_count");
        for ($i = 1; $i < $total_count; $i++) {
            $this->bf_form_validation->set_rules("department_id_$i", "Id", 'xss_clean');
            $this->bf_form_validation->set_rules("department_name_$i", "Name", 'required|xss_clean');
        }
        $this->bf_form_validation->set_rules("total_count", "Count", 'xss_clean');
        if ($this->bf_form_validation->run() == FALSE) {
            $response = array('status' => 0, 'isAlive' => TRUE, 'errors' => ajax_validation_errors());
            echo json_encode($response);
        } else {
            for ($j = 1; $j < $total_count; $j++) {
                $department_id = $this->input->post("department_id_$j");
                $department_name = $this->input->post("department_name_$j");
                $records_array = array(
                    'department_name' => $department_name,
                    'modifyTime' => strtotime(date("d-m-Y H:i:s"))
                );
                $options = array
                    (
                    'where' => array('department_id' => $department_id),
                    'data' => $records_array,
                    'table' => 'qyura_department'
                );
                $response = $this->common_model->customUpdate($options);
            }
            if ($response) {
                $response = array('status' => 2, 'msg' => "Record Update successfully", 'url' => "master/department");
            } else {
                $error = array("TopError" => "<strong>Something went wrong while updating your data... sorry.</strong>");
                $response = array('status' => 0, 'isAlive' => TRUE, 'errors' => $error);
            }
            echo json_encode($response);
        }
    }
    
    function departmentPublish() {
        $ena_id = $this->input->post('id');
        $status = $this->input->post('status');
        if ($ena_id != '' && $status != '') {
            //Group
            if ($status == 2) {
                $update_data['status'] = 3;
            } else {
                $update_data['status'] = 2;
            }
            $where = array('department_id' => $ena_id);
            $updateOptions = array
                (
                'where' => $where,
                'data'  => $update_data,
                'table' => 'qyura_department'
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
    //Department ends

    //Designation starts
    function designation() {
        $option = array(
            'table' => 'qyura_designation',
            'select' => '*',
            'where' => array('qyura_designation.designation_deleted' => 0),
            'order' => array('designation_name' => 'asc'),
            'single' => FALSE
        );
        $data['designationList'] = $this->common_model->customGet($option);
        $data['title'] = "Designations";
        $data['allDepartments'] = $this->Master_model->fetchAllDepartments();

        $department_id = $this->input->post('designation_departmentId');
        $data['Departments'] = $this->Master_model->fetchDepartments($department_id);
        $this->load->super_admin_template('designation', $data, 'masterScript');
    }

    function designationSave() {
        $this->bf_form_validation->set_rules("designation_departmentId", "Designation Department Id", 'required|xss_clean');
        $this->bf_form_validation->set_rules("designation_name", "Designation Name", 'required|xss_clean');

        if ($this->bf_form_validation->run() == FALSE) {
            $response = array('status' => 0, 'isAlive' => TRUE, 'errors' => ajax_validation_errors());
            echo json_encode($response);
        } else {
            $designation_id = $this->input->post('designation_id');
            $department_id = $this->input->post('designation_departmentId');
            $designation_name = $this->input->post('designation_name');
            $records_array = array(
                'designation_departmentId' => $department_id,
                'designation_name' => $designation_name,
                'creationTime' => strtotime(date("d-m-Y H:i:s"))
            );
            $options = array
                (
                'data' => $records_array,
                'table' => 'qyura_designation'
            );
            $response = $this->common_model->customInsert($options);
            if ($response) {
                $response = array('status' => 2, 'msg' => "Record Added successfully", 'url' => "master/designation");
            } else {
                $error = array("TopError" => "<strong>Something went wrong while updating your data... sorry.</strong>");
                $response = array('status' => 0, 'isAlive' => TRUE, 'errors' => $error);
            }
            echo json_encode($response);
        }
    }

    function designationEdit() {

        $total_count = $this->input->post("total_count");
        for ($i = 1; $i < $total_count; $i++) {
            $this->bf_form_validation->set_rules("designation_id_$i", "Designation Id", 'xss_clean');
            $this->bf_form_validation->set_rules("designation_departmentId_$i", "Designation Department Id", 'xss_clean');
            $this->bf_form_validation->set_rules("designation_name_$i", "Designation Name", 'required|xss_clean');
        }
        $this->bf_form_validation->set_rules("total_count", "Count", 'xss_clean');
        if ($this->bf_form_validation->run() == FALSE) {
            $response = array('status' => 0, 'isAlive' => TRUE, 'errors' => ajax_validation_errors());
            echo json_encode($response);
        } else {
            for ($j = 1; $j < $total_count; $j++) {
                $designation_id = $this->input->post("designation_id_$j");
                $department_id = $this->input->post("designation_departmentId_$j");
                $designation_name = $this->input->post("designation_name_$j");
                $records_array = array(
                    'designation_departmentId' => $department_id,
                    'designation_name' => $designation_name,
                    'modifyTime' => strtotime(date("d-m-Y H:i:s"))
                );
                $options = array
                    (
                    'where' => array('designation_id' => $designation_id),
                    'data' => $records_array,
                    'table' => 'qyura_designation'
                );
                $response = $this->common_model->customUpdate($options);
            }
            if ($response) {
                $response = array('status' => 2, 'msg' => "Record Update successfully", 'url' => "master/designation");
            } else {
                $error = array("TopError" => "<strong>Something went wrong while updating your data... sorry.</strong>");
                $response = array('status' => 0, 'isAlive' => TRUE, 'errors' => $error);
            }
            echo json_encode($response);
        }
    }
    
    function designationPublish() {
        $ena_id = $this->input->post('id');
        $status = $this->input->post('status');
        if ($ena_id != '' && $status != '') {
            //Group
            if ($status == 2) {
                $update_data['status'] = 3;
            } else {
                $update_data['status'] = 2;
            }
            $where = array('designation_id' => $ena_id);
            $updateOptions = array
                (
                'where' => $where,
                'data'  => $update_data,
                'table' => 'qyura_designation'
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
    //designation ends
}
