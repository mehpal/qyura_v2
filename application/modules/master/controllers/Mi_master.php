<?php

class Mi_master extends MY_Controller {

    public $_error = array();
    public $_startTime = '';
    public $_endTime = '';

    public function __construct() {
        parent:: __construct();

        $this->load->model(array('Master_model', 'common_model'));
        $this->load->library('datatables');
        $this->load->helper('common');
    }
    
    //Hospital 
    function hospital() {
        $option = array(
            'table' => 'qyura_hospital',
            'select' => 'hospital_id,hospital_name,status',
            'where' => array('qyura_hospital.hospital_deleted' => 0),
            'order' => array('hospital_name' => 'asc'),
            'single' => FALSE
        );
        $data['hospital_list'] = $this->common_model->customGet($option);
        
        $option = array(
            'table' => 'qyura_country',
            'select' => '*',
            'where' => array('qyura_country.country' => 0),
            'order' => array('country' => 'asc'),
            'single' => FALSE
        );
        $data['country_list'] = $this->common_model->customGet($option);
        
        $data['title'] = 'List Hospital';
        $this->load->super_admin_template('hospital_view', $data, 'masterScript');
    }
    
    function getHospitalDl() {

        echo $this->Master_model->fetchHospitalDataTables();
    }
    
    function addHospital() {
        $option = array(
            'table' => 'qyura_country',
            'select' => '*',
            'where' => array('qyura_country.country' => 0),
            'order' => array('country' => 'asc'),
            'single' => FALSE
        );
        $data['country_list'] = $this->common_model->customGet($option);
        
        $data['title'] = 'List Hospital';
        $this->load->super_admin_template('mi_add', $data, 'masterScript');
    }
    
    function saveHospital() {
        
        $this->bf_form_validation->set_rules("mi_name", "Name", 'required|xss_clean');
        $this->bf_form_validation->set_rules("mi_countryId", "Country", 'required|xss_clean');
        $this->bf_form_validation->set_rules("mi_stateId", "State", 'required|xss_clean');
        $this->bf_form_validation->set_rules("mi_cityId", "City", 'required|xss_clean');
        $this->bf_form_validation->set_rules("mi_zip", "Zip", 'required|xss_clean');
        $this->bf_form_validation->set_rules("mi_address", "Address", 'required|xss_clean');
        $this->bf_form_validation->set_rules("lat", "Latitude", 'required|xss_clean');
        $this->bf_form_validation->set_rules("lng", "Longitude", 'required|xss_clean');

        if ($this->bf_form_validation->run() == FALSE) {
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => ajax_validation_errors());
            echo json_encode($responce);
        } else {
            $hospital_name = $this->input->post('mi_name');
            $hospital_countryId = $this->input->post('mi_countryId');
            $hospital_stateId = $this->input->post('mi_stateId');
            $hospital_cityId = $this->input->post('mi_cityId');
            $hospital_zip = $this->input->post('mi_zip');
            $hospital_address = $this->input->post('mi_address');
            $hospital_lat = $this->input->post('lat');
            $hospital_long = $this->input->post('lng');
            $records_array = array(
                'hospital_name'      => $hospital_name,
                'hospital_countryId' => $hospital_countryId,
                'hospital_stateId'   => $hospital_stateId,
                'hospital_cityId'    => $hospital_cityId,
                'hospital_zip'       => $hospital_zip,
                'hospital_address'   => $hospital_address,
                'hospital_lat'       => $hospital_lat,
                'hospital_long'      => $hospital_long,
                'status'             => 2,
                'creationTime'       => strtotime(date("d-m-Y H:i:s"))
            );
            $options = array
            (
                'data'  => $records_array,
                'table' => 'qyura_hospital'
            );
            $hospital_insert = $this->common_model->customInsert($options);
            if ($hospital_insert) {
                $responce = array('status' => 1, 'msg' => "Hospital added successfully", 'url' => "master/mi_master/hospital/");
            } else {
                $error = array("TopError" => "<strong>Something went wrong while updating your data... sorry.</strong>");
                $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $error);
            }
            echo json_encode($responce);
        }
    }
    
    function editHospitalView($hospitalId) {
        
        $option = array(
            'table' => 'qyura_hospital',
            'select' => '*',
            'where' => array('qyura_hospital.hospital_deleted' => 0,'qyura_hospital.hospital_id' => $hospitalId),
            'join' => array( 
                array('qyura_country', 'qyura_country.country_id = qyura_hospital.hospital_countryId', 'left'), 
                array('qyura_state', 'qyura_state.state_id = qyura_hospital.hospital_stateId', 'left'), 
                array('qyura_city', 'qyura_city.city_id = qyura_hospital.hospital_cityId', 'left'), 
            ),
            'single' => TRUE
        );
        $data['hospital_value'] = $hospital_value = $this->common_model->customGet($option);
       
        $option = array(
            'table' => 'qyura_country',
            'select' => '*',
            'where' => array('qyura_country.country' => 0),
            'order' => array('country' => 'asc'),
            'single' => FALSE
        );
        $data['country_list'] = $this->common_model->customGet($option);
        
        $option = array(
            'table' => 'qyura_state',
            'select' => '*',
            'where' => array('qyura_state.state_countryid' => $hospital_value->hospital_countryId),
            'order' => array('state_statename' => 'asc'),
            'single' => FALSE
        );
        $data['state_list'] = $this->common_model->customGet($option);
        
        $option = array(
            'table' => 'qyura_city',
            'select' => '*',
            'where' => array('qyura_city.city_stateid' => $hospital_value->hospital_stateId,'qyura_city.city_countryid' => $hospital_value->hospital_countryId),
            'order' => array('city_name' => 'asc'),
            'single' => FALSE
        );
        $data['city_list'] = $this->common_model->customGet($option);
        
        $data['title'] = 'Edit Hospital';
        $this->load->super_admin_template('hospitalEdit', $data, 'masterScript');
    }
    
    function editHospital(){
        
        $this->bf_form_validation->set_rules("hospital_name", "Name", 'required|xss_clean');
        $this->bf_form_validation->set_rules("hospital_countryId", "Country", 'required|xss_clean');
        $this->bf_form_validation->set_rules("hospital_stateId", "State", 'required|xss_clean');
        $this->bf_form_validation->set_rules("hospital_cityId", "City", 'required|xss_clean');
        $this->bf_form_validation->set_rules("hospital_zip", "Zip", 'required|xss_clean');
        $this->bf_form_validation->set_rules("hospital_address", "Address", 'required|xss_clean');
        $this->bf_form_validation->set_rules("lat", "Latitude", 'required|xss_clean');
        $this->bf_form_validation->set_rules("lng", "Longitude", 'required|xss_clean');
        
        if ($this->bf_form_validation->run() == FALSE) {
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => ajax_validation_errors());
            echo json_encode($responce);
        } else {
            $hospital_id = $this->input->post('hospital_id');
            $hospital_name = $this->input->post('hospital_name');
            $hospital_countryId = $this->input->post('hospital_countryId');
            $hospital_stateId = $this->input->post('hospital_stateId');
            $hospital_cityId = $this->input->post('hospital_cityId');
            $hospital_zip = $this->input->post('hospital_zip');
            $hospital_address = $this->input->post('hospital_address');
            $hospital_lat = $this->input->post('lat');
            $hospital_long = $this->input->post('lng');
            $records_array = array(
                'hospital_name'      => $hospital_name,
                'hospital_countryId' => $hospital_countryId,
                'hospital_stateId'   => $hospital_stateId,
                'hospital_cityId'    => $hospital_cityId,
                'hospital_zip'       => $hospital_zip,
                'hospital_address'   => $hospital_address,
                'hospital_lat'       => $hospital_lat,
                'hospital_long'      => $hospital_long,
                'status'             => 2,
                'modifyTime'       => strtotime(date("d-m-Y H:i:s"))
            );
            $options = array
            (
                'where' => array('hospital_id' => $hospital_id),
                'data'  => $records_array,
                'table' => 'qyura_hospital'
            );
            $hospital_update = $this->common_model->customUpdate($options);
            
            if ($hospital_update) {
                $this->session->set_flashdata('message', 'Hospital has been updated successfully!');
                redirect('master/mi_master/hospital/');
            } else {
                $error = array("TopError" => "<strong>Something went wrong while updating your data... sorry.</strong>");
                $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $error);
            }
            echo json_encode($responce);
        }
    }
    //Hospital End
    
    //Diagnostic 
    function diagnosticList() {
        $option = array(
            'table' => 'qyura_diagnostic',
            'select' => 'diagnostic_id,diagnostic_name,status',
            'where' => array('qyura_diagnostic.diagnostic_deleted' => 0),
            'order' => array('diagnostic_name' => 'asc'),
            'single' => FALSE
        );
        $data['diagnostic_list'] = $this->common_model->customGet($option);
        
        $option = array(
            'table' => 'qyura_country',
            'select' => '*',
            'where' => array('qyura_country.country' => 0),
            'order' => array('country' => 'asc'),
            'single' => FALSE
        );
        $data['country_list'] = $this->common_model->customGet($option);
        
        $data['title'] = 'List Diagnostic';
        $this->load->super_admin_template('diagnostic_view', $data, 'masterScript');
    }
    
    function getDiagnosticDl() {

        echo $this->Master_model->fetchDiagnosticDataTables();
    }
    
    function addDiagnostic() {
        
        $option = array(
            'table' => 'qyura_country',
            'select' => '*',
            'where' => array('qyura_country.country' => 0),
            'order' => array('country' => 'asc'),
            'single' => FALSE
        );
        $data['country_list'] = $this->common_model->customGet($option);
        
        $data['title'] = 'List Diagnostic';
        $this->load->super_admin_template('mi_add', $data, 'masterScript');
    }
    
    function saveDiagnostic() {
        $this->bf_form_validation->set_rules("mi_name", "Name", 'required|xss_clean');
        $this->bf_form_validation->set_rules("mi_countryId", "Country", 'required|xss_clean');
        $this->bf_form_validation->set_rules("mi_stateId", "State", 'required|xss_clean');
        $this->bf_form_validation->set_rules("mi_cityId", "City", 'required|xss_clean');
        $this->bf_form_validation->set_rules("mi_zip", "Zip", 'required|xss_clean');
        $this->bf_form_validation->set_rules("mi_address", "Address", 'required|xss_clean');
        $this->bf_form_validation->set_rules("lat", "Latitude", 'required|xss_clean');
        $this->bf_form_validation->set_rules("lng", "Longitude", 'required|xss_clean');

        if ($this->bf_form_validation->run() == FALSE) {
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => ajax_validation_errors());
            echo json_encode($responce);
        } else {
            $diagnostic_name = $this->input->post('mi_name');
            $diagnostic_countryId = $this->input->post('mi_countryId');
            $diagnostic_stateId = $this->input->post('mi_stateId');
            $diagnostic_cityId = $this->input->post('mi_cityId');
            $diagnostic_zip = $this->input->post('mi_zip');
            $diagnostic_address = $this->input->post('mi_address');
            $diagnostic_lat = $this->input->post('lat');
            $diagnostic_long = $this->input->post('lng');
            $records_array = array(
                'diagnostic_name'      => $diagnostic_name,
                'diagnostic_countryId' => $diagnostic_countryId,
                'diagnostic_stateId'   => $diagnostic_stateId,
                'diagnostic_cityId'    => $diagnostic_cityId,
                'diagnostic_zip'       => $diagnostic_zip,
                'diagnostic_address'   => $diagnostic_address,
                'diagnostic_lat'       => $diagnostic_lat,
                'diagnostic_long'      => $diagnostic_long,
                'status'             => 2,
                'creationTime'       => strtotime(date("d-m-Y H:i:s"))
            );
            $options = array
            (
                'data'  => $records_array,
                'table' => 'qyura_diagnostic'
            );
            $diagnostic_insert = $this->common_model->customInsert($options);
            if ($diagnostic_insert) {
                $responce = array('status' => 1, 'msg' => "Diagnostic added successfully", 'url' => "master/mi_master/diagnosticList/");
            } else {
                $error = array("TopError" => "<strong>Something went wrong while updating your data... sorry.</strong>");
                $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $error);
            }
            echo json_encode($responce);
        }
    }
    
    function editDiagnosticView($diagnosticId) {
        
        $option = array(
            'table' => 'qyura_diagnostic',
            'select' => '*',
            'where' => array('qyura_diagnostic.diagnostic_deleted' => 0,'qyura_diagnostic.diagnostic_id' => $diagnosticId),
            'join' => array( 
                array('qyura_country', 'qyura_country.country_id = qyura_diagnostic.diagnostic_countryId', 'left'), 
                array('qyura_state', 'qyura_state.state_id = qyura_diagnostic.diagnostic_stateId', 'left'), 
                array('qyura_city', 'qyura_city.city_id = qyura_diagnostic.diagnostic_cityId', 'left'), 
            ),
            'single' => TRUE
        );
        $data['diagnostic_value'] = $diagnostic_value = $this->common_model->customGet($option);
       
        $option = array(
            'table' => 'qyura_country',
            'select' => '*',
            'where' => array('qyura_country.country' => 0),
            'order' => array('country' => 'asc'),
            'single' => FALSE
        );
        $data['country_list'] = $this->common_model->customGet($option);
        
        $option = array(
            'table' => 'qyura_state',
            'select' => '*',
            'where' => array('qyura_state.state_countryid' => $diagnostic_value->diagnostic_countryId),
            'order' => array('state_statename' => 'asc'),
            'single' => FALSE
        );
        $data['state_list'] = $this->common_model->customGet($option);
        
        $option = array(
            'table' => 'qyura_city',
            'select' => '*',
            'where' => array('qyura_city.city_stateid' => $diagnostic_value->diagnostic_stateId,'qyura_city.city_countryid' => $diagnostic_value->diagnostic_countryId),
            'order' => array('city_name' => 'asc'),
            'single' => FALSE
        );
        $data['city_list'] = $this->common_model->customGet($option);
        
        $data['title'] = 'Edit Diagnostic';
        $this->load->super_admin_template('diagnosticDataEdit', $data, 'masterScript');
    }
    
    function editDiagnostic(){
        
        $this->bf_form_validation->set_rules("diagnostic_name", "Name", 'required|xss_clean');
        $this->bf_form_validation->set_rules("diagnostic_countryId", "Country", 'required|xss_clean');
        $this->bf_form_validation->set_rules("diagnostic_stateId", "State", 'required|xss_clean');
        $this->bf_form_validation->set_rules("diagnostic_cityId", "City", 'required|xss_clean');
        $this->bf_form_validation->set_rules("diagnostic_zip", "Zip", 'required|xss_clean');
        $this->bf_form_validation->set_rules("diagnostic_address", "Address", 'required|xss_clean');
        $this->bf_form_validation->set_rules("lat", "Latitude", 'required|xss_clean');
        $this->bf_form_validation->set_rules("lng", "Longitude", 'required|xss_clean');
        
        if ($this->bf_form_validation->run() == FALSE) {
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => ajax_validation_errors());
            echo json_encode($responce);
        } else {
            $diagnostic_id = $this->input->post('diagnostic_id');
            $diagnostic_name = $this->input->post('diagnostic_name');
            $diagnostic_countryId = $this->input->post('diagnostic_countryId');
            $diagnostic_stateId = $this->input->post('diagnostic_stateId');
            $diagnostic_cityId = $this->input->post('diagnostic_cityId');
            $diagnostic_zip = $this->input->post('diagnostic_zip');
            $diagnostic_address = $this->input->post('diagnostic_address');
            $diagnostic_lat = $this->input->post('lat');
            $diagnostic_long = $this->input->post('lng');
            $records_array = array(
                'diagnostic_name'      => $diagnostic_name,
                'diagnostic_countryId' => $diagnostic_countryId,
                'diagnostic_stateId'   => $diagnostic_stateId,
                'diagnostic_cityId'    => $diagnostic_cityId,
                'diagnostic_zip'       => $diagnostic_zip,
                'diagnostic_address'   => $diagnostic_address,
                'diagnostic_lat'       => $diagnostic_lat,
                'diagnostic_long'      => $diagnostic_long,
                'status'               => 2,
                'modifyTime'           => strtotime(date("d-m-Y H:i:s"))
            );
            $options = array
            (
                'where' => array('diagnostic_id' => $diagnostic_id),
                'data'  => $records_array,
                'table' => 'qyura_diagnostic'
            );
            $diagnostic_update = $this->common_model->customUpdate($options);
            
            if ($diagnostic_update) {
                $this->session->set_flashdata('message', 'Diagnostic has been updated successfully!');
                redirect('master/mi_master/diagnosticList/');
            } else {
                $error = array("TopError" => "<strong>Something went wrong while updating your data... sorry.</strong>");
                $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $error);
            }
            echo json_encode($responce);
        }
    }

    function diagnosticPublish() {
        $ena_id = $this->input->post('id');
        $status = $this->input->post('status');
        if ($ena_id != '' && $status != '') {
            //Group
            if ($status == 2) {
                $update_data['status'] = 3;
            } else {
                $update_data['status'] = 2;
            }
            $where = array('diagnostic_id' => $ena_id);
            $updateOptions = array
                (
                'where' => $where,
                'data'  => $update_data,
                'table' => 'qyura_diagnostic'
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
    //Diagnostic End
    
    function fetchStates() {
        $stateId = $this->input->post('stateId');
        $countryId = $this->input->post('countryId');
        $statesdata = $this->Master_model->getStates($countryId);
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
    
    function fetchCity() {
        $stateId = $this->input->post('stateId');
        $cityData = $this->Master_model->getCity($stateId);
        $cityOption = '';
         $cityOption .='<option value=>Select Your City</option>';
        foreach ($cityData as $key => $val) {
            $cityOption .= '<option value=' . $val->city_id . '>' . strtoupper($val->city_name) . '</option>';
        }
        echo $cityOption;
        exit;
    }
}
