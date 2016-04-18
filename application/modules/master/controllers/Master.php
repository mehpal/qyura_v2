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

    function degreeDelete() {
        $del_id = $this->input->post('id');

        if ($del_id) {
            //Group
            $where = array('degree_id' => $del_id);
            $update_data['degree_deleted'] = 1;
            $updateOptions = array
                (
                'where' => $where,
                'data' => $update_data,
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
    
    function insuranceDelete() {

        $del_id = $this->input->post('id');

        if ($del_id) {
            //Group
            $where = array('insurance_id' => $del_id);
            $update_data['insurance_deleted'] = 1;
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
    //Insurance End
    
    //Specialities
    function specialities() {
        $option = array(
            'table' => 'qyura_specialities',
            'select' => '*',
            'where' => array('qyura_specialities.specialities_deleted' => 0),
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
        $this->bf_form_validation->set_rules("keywords", "Keywords/Tags", 'required|xss_clean');
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
            $records_array = array(
                'specialities_name' => $specialityName,
                'speciality_tag' => $keywords,
                'specialities_drName' => $specialityNamedoctor,
                'specialities_img' => $imagesname,
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
            'where' => array('qyura_specialities.specialities_deleted' => 0, 'qyura_specialities.specialities_id' => $specialityId),
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
        $data['title'] = "Mi Type's";
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
                'creationTime' => strtotime(date("d-m-Y H:i:s"))
            );
            $options = array
            (
                'data' => $records_array,
                'table' => 'qyura_hospitalType'
            );
            $response = $this->common_model->customInsert($options);
            if ($response) {
                $responce = array('status' => 1, 'msg' => "Record Added successfully", 'url' => "master/miType/$hospitalType_miRole");
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
                $responce = array('status' => 1, 'msg' => "Record Update successfully", 'url' => "master/miType/$hospitalType_miRole");
            } else {
                $error = array("TopError" => "<strong>Something went wrong while updating your data... sorry.</strong>");
                $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $error);
            }
            echo json_encode($responce);
        }
    }
    
    function mitypeDelete() {
        $del_id = $this->input->post('id');

        if ($del_id) {
            //Group
            $where = array('hospitalType_id' => $del_id);
            $update_data['hospitalType_deleted'] = 1;
            $updateOptions = array
                (
                'where' => $where,
                'data'  => $update_data,
                'table' => 'qyura_hospitalType'
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

    function diagnosticsDelete() {
        $del_id = $this->input->post('id');

        if ($del_id) {
            //Group
            $where = array('diagnosticsCat_catId' => $del_id);
            $update_data['diagnosticsCat_deleted'] = 1;
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
}
