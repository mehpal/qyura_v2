<?php

class City_master extends MY_Controller {

    public $_error = array();
    public $_startTime = '';
    public $_endTime = '';

    public function __construct() {
        parent:: __construct();

        $this->load->model(array('Master_model', 'common_model'));
        $this->load->library('datatables');
        $this->load->helper('common');
    }
    
    //City 
    function index() {
        $option = array(
            'table' => 'qyura_city',
            'select' => 'city_id,city_name,status',
            'where' => array('qyura_city.city_deleted' => 0),
            'order' => array('city_name' => 'asc'),
            'single' => FALSE
        );
        $data['city_list'] = $this->common_model->customGet($option);
        
        $option = array(
            'table' => 'qyura_country',
            'select' => '*',
            'where' => array('qyura_country.country' => 0),
            'order' => array('country' => 'asc'),
            'single' => FALSE
        );
        $data['country_list'] = $this->common_model->customGet($option);
        
        //print_r($data['city_list']);exit;
        $data['title'] = 'List City';
        $this->load->super_admin_template('city_view', $data, 'masterScript');
    }
    
    function saveCity() {
       
        $this->bf_form_validation->set_rules("city_countryid", "Country", 'required|xss_clean');
        $this->bf_form_validation->set_rules("city_stateid", "State", 'required|xss_clean');
        $this->bf_form_validation->set_rules("city_name", "City Name", 'required|xss_clean|is_unique[qyura_city.city_name,city_deleted=0]');
        $this->bf_form_validation->set_rules("city_center", "Center", 'required|xss_clean');
        $this->bf_form_validation->set_rules("lat", "Latitude", 'required|xss_clean');
        $this->bf_form_validation->set_rules("lng", "Longitude", 'required|xss_clean');
        
        if ($this->bf_form_validation->run() == FALSE) {
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => ajax_validation_errors());
            echo json_encode($responce);
        } else {
            $city_countryid = $this->input->post('city_countryid');
            $city_stateid = $this->input->post('city_stateid');
            $city_name = $this->input->post('city_name');
            $city_center = $this->input->post('city_center');
            $city_lat = $this->input->post('lat');
            $city_lng = $this->input->post('lng');
            
            $records_array = array(
                'city_countryid' => $city_countryid,
                'city_stateid'   => $city_stateid,
                'city_name'      => $city_name,
                'city_center'    => $city_center,
                'city_lat'       => $city_lat,
                'city_long'      => $city_lng,
                'status'         => 2,
                'creationTime'   => strtotime(date("d-m-Y H:i:s"))
            );
            $options = array
            (
                'data'  => $records_array,
                'table' => 'qyura_city'
            );
            $hospital_insert = $this->common_model->customInsert($options);
            if ($hospital_insert) {
                $responce = array('status' => 1, 'msg' => "City added successfully", 'url' => "master/city_master/");
            } else {
                $error = array("TopError" => "<strong>Something went wrong while updating your data... sorry.</strong>");
                $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $error);
            }
            echo json_encode($responce);
        }
    }
    
    function editCityView($cityId) {
        
        $option = array(
            'table' => 'qyura_city',
            'select' => '*',
            'where' => array('qyura_city.city_deleted' => 0,'qyura_city.city_id' => $cityId),
            'order' => array('city_name' => 'asc'),
            'join' => array( 
                array('qyura_country', 'qyura_country.country_id = qyura_city.city_countryid', 'left'), 
                array('qyura_state', 'qyura_state.state_id = qyura_city.city_stateid', 'left'), 
            ),
            'single' => TRUE
        );
        $data['city_value'] = $city_value = $this->common_model->customGet($option);
        
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
            'where' => array('qyura_state.state_countryid' => $city_value->city_countryid),
            'order' => array('state_statename' => 'asc'),
            'single' => FALSE
        );
        $data['state_list'] = $this->common_model->customGet($option);
        
        $data['title'] = 'Edit Hospital';
        $this->load->super_admin_template('cityEdit', $data, 'masterScript');
    }
    
    function editCity(){
        
        $this->bf_form_validation->set_rules("city_countryid", "Country", 'required|xss_clean');
        $this->bf_form_validation->set_rules("city_stateid", "State", 'required|xss_clean');
        $this->bf_form_validation->set_rules("city_name", "City Name", 'required|xss_clean');
        $this->bf_form_validation->set_rules("city_center", "Center", 'required|xss_clean');
        $this->bf_form_validation->set_rules("lat", "Latitude", 'required|xss_clean');
        $this->bf_form_validation->set_rules("lng", "Longitude", 'required|xss_clean');
        
        if ($this->bf_form_validation->run() == FALSE) {
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => ajax_validation_errors());
            echo json_encode($responce);
        } else {
            $city_id = $this->input->post('city_id');
            $city_countryid = $this->input->post('city_countryid');
            $city_stateid = $this->input->post('city_stateid');
            $city_name = $this->input->post('city_name');
            $city_center = $this->input->post('city_center');
            $city_lat = $this->input->post('lat');
            $city_lng = $this->input->post('lng');
            
            $records_array = array(
                'city_countryid' => $city_countryid,
                'city_stateid'   => $city_stateid,
                'city_name'      => $city_name,
                'city_center'    => $city_center,
                'city_lat'       => $city_lat,
                'city_long'      => $city_lng,
                'creationTime'   => strtotime(date("d-m-Y H:i:s"))
            );
            $options = array
            (
                'where' => array('city_id' => $city_id),
                'data'  => $records_array,
                'table' => 'qyura_city'
            );
            $city_update = $this->common_model->customUpdate($options);
            
            if ($city_update) {
                $this->session->set_flashdata('message', 'City Information has been updated successfully!');
                redirect('master/city_master/');
            } else {
                $error = array("TopError" => "<strong>Something went wrong while updating your data... sorry.</strong>");
                $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $error);
            }
            echo json_encode($responce);
        }
    }

    function cityPublish() {
        $ena_id = $this->input->post('id');
        $status = $this->input->post('status');
        if ($ena_id != '' && $status != '') {
            //Group
            if ($status == 2) {
                $update_data['status'] = 3;
            } else {
                $update_data['status'] = 2;
            }
            $where = array('city_id' => $ena_id);
            $updateOptions = array
                (
                'where' => $where,
                'data'  => $update_data,
                'table' => 'qyura_city'
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
    //City End
    
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
