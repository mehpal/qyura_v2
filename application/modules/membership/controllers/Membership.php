<?php

class Membership extends MY_Controller {

    public $_error = array();
    public $_startTime = '';
    public $_endTime = '';

    public function __construct() {
        parent:: __construct();
        $this->load->helper('common');
    }
    
    function index() {
        $selectFor = $this->uri->segment(3);
        $option = array(
            'table' => 'qyura_membership',
            'select' => '*',
            'where' => array('qyura_membership.membership_deleted' => 0),
            'order' => array('membership_name' => 'asc'),
            'single' => FALSE
        );
        $data['membership_list'] =$this->common_model->customGet($option);
        $data['title'] = "Membership";
        $data['selectFor'] = $selectFor;
        $this->load->super_admin_template('membership', $data, 'membershipScript');
    }
    
    function membershipAdd($selectFor){
        $option = array(
            'table' => 'qyura_facilities',
            'select' => '*',
            'where' => array('qyura_facilities.facilities_deleted' => 0),
            'order' => array('facilities_name' => 'asc'),
            'single' => FALSE
        );
        $data['facilities_list'] = $this->common_model->customGet($option);
        $data['title'] = "Membership Add";
        $data['selectFor'] = $selectFor;
        $this->load->super_admin_template('membershipAdd', $data, 'membershipScript');           
    }
    
    function membershipEditView($membershipId){
        $option = array(
            'table' => 'qyura_facilities',
            'select' => '*',
            'where' => array('qyura_facilities.facilities_deleted' => 0),
            'order' => array('facilities_name' => 'asc'),
            'single' => FALSE
        );
        $data['facilities_list'] = $this->common_model->customGet($option);
        
        $option = array(
            'table' => 'qyura_membership',
            'select' => '*',
            'where' => array('qyura_membership.membership_deleted' => 0,'qyura_membership.membership_id' => $membershipId),
            'single' => TRUE
        );
        $data['membership'] = $this->common_model->customGet($option);
        
        $option = array(
            'table' => 'qyura_membershipFacilities',
            'select' => 'membershipFacilities_facilitiesId,membershipFacilities_quantity,membershipFacilities_duration',
            'where' => array('qyura_membershipFacilities.membershipFacilities_deleted' => 0,'qyura_membershipFacilities.membershipFacilities_membershipId' => $membershipId),
            'single' => FALSE
        );
        $data['membershipFacilities'] = $membershipFacilities = $this->common_model->customGet($option);
        
        $membershipFacilitiesArray = array();
        if(isset($membershipFacilities) && $membershipFacilities != NULL){
            foreach($membershipFacilities as $memFacilities){
                array_push($membershipFacilitiesArray, $memFacilities->membershipFacilities_facilitiesId);
            }
        }
        $data['membershipFacilitiesArray'] = $membershipFacilitiesArray;
        $data['title'] = "Membership Edit";
        $this->load->super_admin_template('membershipEdit', $data, 'membershipScript');       
    }
    
    function membershipSave() {
        
        //$this->bf_form_validation->set_rules("membership_type", "Membership Type", 'required|xss_clean');
        $this->bf_form_validation->set_rules("membership_name", "Tital", 'required|xss_clean');
        //$this->bf_form_validation->set_rules("membership_plan", "Plan", 'required|xss_clean');
        $this->bf_form_validation->set_rules("membership_price", "Price", 'required|xss_clean');
        $this->bf_form_validation->set_rules("membership_tax", "Tax", 'required|xss_clean');
        $this->bf_form_validation->set_rules("membership_totalPrice", "Total Price", 'required|xss_clean');
        $faci_count = $this->input->post('faci_count');
        for($i = 1; $i <= $faci_count; $i++){
            $checkbox = $this->input->post("checkbox_$i");
            $this->bf_form_validation->set_rules("membership_quantity_$i", "Price", 'required|xss_clean');
            if($checkbox == 2 || $checkbox == 4){
                $this->bf_form_validation->set_rules("membership_duration_$i", "Price", 'required|xss_clean');
            }
        }
        if ($this->bf_form_validation->run() == FALSE) {
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => ajax_validation_errors());
            echo json_encode($responce);
        } else {
           
            $membership_type       = $this->input->post('membership_type');
            $membership_name       = $this->input->post('membership_name');
            $membership_plan       = 18; //$this->input->post('membership_plan');
            $membership_price      = $this->input->post('membership_price');
            $membership_tax        = $this->input->post('membership_tax');
            $membership_totalPrice = $this->input->post('membership_totalPrice');
            $count = count($membership_type);
            
            for($j = 0;$j< $count;$j++){
                $records_array = array(
                    'membership_type'  => $membership_type[$j],
                    'membership_name'  => $membership_name,
                    'membership_plan'  => $membership_plan,
                    'membership_price' => $membership_price,
                    'membership_tax'   => $membership_tax,
                    'membership_totalPrice' => $membership_totalPrice,
                    'status'       => 2,
                    'creationTime' => strtotime(date("d-m-Y H:i:s"))
                );

                $options = array
                (
                    'data' => $records_array,
                    'table' => 'qyura_membership'
                );
                $insertId = $this->common_model->customInsert($options);
                $faci_count = $this->input->post('faci_count');
                for($i = 1; $i <= $faci_count; $i++){
                    $checkbox = $this->input->post("checkbox_$i");
                    $quantity = $this->input->post("membership_quantity_$i");
                    $duration = $this->input->post("membership_duration_$i");
                    $records_array = array(
                        'membershipFacilities_membershipId'  => $insertId,
                        'membershipFacilities_facilitiesId'  => $checkbox,
                        'creationTime' => strtotime(date("d-m-Y H:i:s"))
                    );
                    if($quantity != ''){
                        $records_array['membershipFacilities_quantity'] = $quantity;
                    }
                    if($duration != ''){
                        $records_array['membershipFacilities_duration'] = $duration;
                    }
                    $options = array
                    (
                        'data' => $records_array,
                        'table' => 'qyura_membershipFacilities'
                    );
                    $fId = $this->common_model->customInsert($options);
                }
            }
            if ($insertId) {
                $active_tag = $this->input->post('active_tag');
                $this->session->set_flashdata('active_tag', $active_tag);
                $responce = array('status' => 1, 'msg' => "Record Added successfully", 'url' => "membership/");
            } else {
                $error = array("TopError" => "<strong>Something went wrong while updating your data... sorry.</strong>");
                $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $error);
            }
            echo json_encode($responce);
        }
    }
    
    function membershipEdit() {
        
        $this->bf_form_validation->set_rules("membership_type", "Membership Type", 'required|xss_clean');
        $this->bf_form_validation->set_rules("membership_name", "Tital", 'required|xss_clean');
        //$this->bf_form_validation->set_rules("membership_plan", "Plan", 'required|xss_clean');
        $this->bf_form_validation->set_rules("membership_price", "Price", 'required|xss_clean');
        $this->bf_form_validation->set_rules("membership_tax", "Tax", 'required|xss_clean');
        $this->bf_form_validation->set_rules("membership_totalPrice", "Total Price", 'required|xss_clean');
        $faci_count = $this->input->post('faci_count');
        for($i = 1; $i <= $faci_count; $i++){
            $this->bf_form_validation->set_rules("membership_quantity_$i", "Price", 'required|xss_clean');
            if($checkbox == 2 || $checkbox == 4){
                $this->bf_form_validation->set_rules("membership_duration_$i", "Price", 'required|xss_clean');
            }
        }
        if ($this->bf_form_validation->run() == FALSE) {
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => ajax_validation_errors());
            echo json_encode($responce);
        } else {
            
            $membership_id         = $this->input->post('membership_id');
            $membership_type       = $this->input->post('membership_type');
            $membership_name       = $this->input->post('membership_name');
            $membership_plan       = 18; //$this->input->post('membership_plan');
            $membership_price      = $this->input->post('membership_price');
            $membership_tax        = $this->input->post('membership_tax');
            $membership_totalPrice = $this->input->post('membership_totalPrice');
            
            $records_array = array(
                'membership_type'  => $membership_type,
                'membership_name'  => $membership_name,
                'membership_plan'  => $membership_plan,
                'membership_price' => $membership_price,
                'membership_tax'   => $membership_tax,
                'membership_totalPrice' => $membership_totalPrice,
                'creationTime' => strtotime(date("d-m-Y H:i:s"))
            );
            
            $options = array
            (
                'data' => $records_array,
                'where' => array('qyura_membership.membership_id' => $membership_id),
                'table' => 'qyura_membership'
            );
            
            $insertId = $this->common_model->customUpdate($options);
            
            $query = "DELETE FROM `qyura_membershipFacilities` WHERE `membershipFacilities_membershipId` = '$membership_id'";
            $delete_facilities = $this->common_model->customQuery($query,FALSE,TRUE);
            
            $faci_count = $this->input->post('faci_count');
            
            for($i = 1; $i <= $faci_count; $i++){
                $checkbox = $this->input->post("checkbox_$i");
                $quantity = $this->input->post("membership_quantity_$i");
                $duration = $this->input->post("membership_duration_$i");
                $records_array = array(
                    'membershipFacilities_membershipId'  => $membership_id,
                    'membershipFacilities_facilitiesId'  => $checkbox,
                    'creationTime' => strtotime(date("d-m-Y H:i:s"))
                );
                if($quantity != ''){
                    $records_array['membershipFacilities_quantity'] = $quantity;
                }
                if($duration != ''){
                    $records_array['membershipFacilities_duration'] = $duration;
                }
                $options = array
                (
                    'data' => $records_array,
                    'table' => 'qyura_membershipFacilities'
                );
                $fId = $this->common_model->customInsert($options);
            }
            $active_tag = $this->input->post('active_tag');
            $this->session->set_flashdata('active_tag', $active_tag);
            $responce = array('status' => 1, 'msg' => "Record Update successfully", 'url' => "membership/");
            echo json_encode($responce);
        }
    }
    
    function membershipPublish() {
        $ena_id = $this->input->post('id');
        $status = $this->input->post('status');
        if ($ena_id != '' && $status != '') {
            //Group
            if ($status == 3) {
                $update_data['status'] = 2;
            } else {
                $update_data['status'] = 3;
            }
            $where = array('membership_id' => $ena_id);
            $updateOptions = array
                (
                'where' => $where,
                'data'  => $update_data,
                'table' => 'qyura_membership'
            );

            $update = $this->common_model->customUpdate($updateOptions);

	    $where = array('membershipFacilities_membershipId' => $ena_id);
            $updateOptions = array
            (
                'where' => $where,
                'data'  => $update_data,
                'table' => 'qyura_membershipFacilities'
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
}
