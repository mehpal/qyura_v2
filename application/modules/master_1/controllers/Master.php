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

    function degree() {
        $option = array(
            'table' => 'qyura_degree',
            'select' => '*',
            'where' => array('qyura_degree.degree_deleted' => 0),
            'order'=>array('degree_SName'=>'asc'),
            'single' => FALSE
        );
        $data['degrees_list'] = $this->common_model->customGet($option);
        $data['title'] = 'List Degrees';
        $this->load->super_admin_template('degrees', $data, 'masterScript');
    }    
    
    function saveDegrees(){
        $this->bf_form_validation->set_rules("degree_SName","Small Name", 'required|xss_clean');
        $this->bf_form_validation->set_rules("degree_FName","Full Name", 'required|xss_clean');
        
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
                'data'  => $records_array,
                'table' => 'qyura_degree'
            );
            $degree_insert = $this->common_model->customInsert($options);
            if ($degree_insert) {
                $responce =  array('status'=>1,'msg'=>"Degree added successfully",'url' =>"master/degree/");
            }else
            {
                $error = array("TopError"=>"<strong>Something went wrong while updating your data... sorry.</strong>");
                $responce =  array('status'=>0,'isAlive'=>TRUE,'errors'=>$error);
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

}
