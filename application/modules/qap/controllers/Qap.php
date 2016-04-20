<?php

class Qap extends MY_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->model('qap_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }
    function index(){
        $this->load->super_admin_template('qapList');
    }
    function addQap(){
        $data = array();
        $data['title'] = "Add QAP";
          $option = array(
            'select' => 'city_name',
            'table' => 'qyura_city',
            'order_by' => array("city_name", "asc")
        );
        $data['allCity'] = $this->qap_model->customGet($option);
        $this->load->super_admin_template('addQap', $data, 'qapScript');
    }
    
        function SaveQap() {
       
        $this->bf_form_validation->set_rules('qap_name', 'Name', 'required|trim');

        $this->bf_form_validation->set_rules('qap_email', 'Email Id', 'required|trim|valid_email');
       // $this->bf_form_validation->set_rules('qap_image', 'Upload Logo', 'required|trim');
        $this->bf_form_validation->set_rules('qap_city', 'City', 'required|trim');

        $this->bf_form_validation->set_rules('qap_phone', 'Mobile No.', 'required|numeric');
        $this->bf_form_validation->set_rules('qap_address', 'Address', 'required|trim');
       // $this->bf_form_validation->set_rules('qap_code', 'Ambulance Address', 'required|trim|');
        $this->bf_form_validation->set_rules('qap_bank_name', 'Bank Name', 'required|trim');
        $this->bf_form_validation->set_rules('qap_accountNo', 'Account No.', 'required|trim|numeric');
        $this->bf_form_validation->set_rules('qap_branch', 'Branch', 'required|trim');
        $this->bf_form_validation->set_rules('qap_ifscCode', 'IFSC Code', 'required|trim');
        $this->bf_form_validation->set_rules('qap_bankCity', 'Bank City', 'required');


        if ($this->bf_form_validation->run() === FALSE) {

           redirect("Qap");
        } else {
       
            $qap_name = $this->input->post('qap_name');
            $qap_email = $this->input->post('qap_email');
            $qap_city = $this->input->post('qap_city');
            $qap_phone = $this->input->post('qap_phone');
            $qap_address = $this->input->post('qap_address');
            $qap_bank_name = $this->input->post('qap_bank_name');
            $qap_accountNo = $this->input->post('qap_accountNo');
            $qap_branch = $this->input->post('qap_branch');
            $qap_ifscCode = $this->input->post('qap_ifscCode');
            $qap_bankCity = $this->input->post('qap_bankCity');

            $insertData = array(
                'qap_name' => $qap_name,
                'qap_email' => $qap_email,
                // 'qap_image' => $imagesname,
                'qap_city' => $qap_city,
                'qap_phone' => $qap_phone,
                'qap_address' => $qap_address,
                // 'qap_code' => $qap_code,
                'qap_bank_name' => $qap_bank_name,
                'qap_accountNo' => $qap_accountNo,
                'qap_branch' => $qap_branch,
                'qap_ifscCode' => $qap_ifscCode,
                'qap_bankCity' => $qap_bankCity,
                "qap_dateOfGeneration" =>strtotime(date("Y-m-d H:i:s")),
                'creationTime' => strtotime(date("Y-m-d H:i:s")),
               
            );

             $options = array
                (
                'data' => $insertData,
                'table' => 'qyura_qap'
            );
         $qap_insert = $this->qap_model->customInsert($options);
         
            if ($qap_insert) {
                
                $this->session->set_flashdata('message', 'Data inserted successfully !');
            }
         
           // redirect('qap/addQap');
        }
    }
    
    function editView(){
       
         $data['title'] = "Edit QAP";
         $options = array(
            'select' => 'city_name',
            'table' => 'qyura_city',
            'order_by' => array("city_name", "asc")
        );
       $data['allCity'] = $this->qap_model->customGet($options);
        
         $option = array(
            'select' => "*",
            'table' => 'qyura_qap',
            'where' => array("qap_id" =>1),
            
        );
        $data['qapData'] = $this->qap_model->customGet($option);
     $this->load->super_admin_template('qapEdit', $data, 'qapScript');
    }
    
    function saveEditqap(){
        $id = $this->input->post('qap_id');
        $this->bf_form_validation->set_rules('qap_name', 'Name', 'required|trim');

        $this->bf_form_validation->set_rules('qap_email', 'Email Id', 'required|trim|valid_email');
       // $this->bf_form_validation->set_rules('qap_image', 'Upload Logo', 'required|trim');
        $this->bf_form_validation->set_rules('qap_city', 'City', 'required|trim');

        $this->bf_form_validation->set_rules('qap_phone', 'Mobile No.', 'required|numeric');
        $this->bf_form_validation->set_rules('qap_address', 'Address', 'required|trim');
       // $this->bf_form_validation->set_rules('qap_code', 'Ambulance Address', 'required|trim|');
        $this->bf_form_validation->set_rules('qap_bank_name', 'Bank Name', 'required|trim');
        $this->bf_form_validation->set_rules('qap_accountNo', 'Account No.', 'required|trim|numeric');
        $this->bf_form_validation->set_rules('qap_branch', 'Branch', 'required|trim');
        $this->bf_form_validation->set_rules('qap_ifscCode', 'IFSC Code', 'required|trim');
        $this->bf_form_validation->set_rules('qap_bankCity', 'Bank City', 'required');
        
         if ($this->bf_form_validation->run() === FALSE) {

          $options = array(
            'select' => 'city_name',
            'table' => 'qyura_city',
            'order_by' => array("city_name", "asc")
        );
       $data['allCity'] = $this->qap_model->customGet($options);
        
         $option = array(
            'select' => "*",
            'table' => 'qyura_qap',
            'where' => array("qap_id" =>$id),
            
        );
        $data['qapData'] = $this->qap_model->customGet($option);
      
         $this->load->super_admin_template('qapEdit', $data, 'qapScript');
        }
        else{
            
            $qap_name = $this->input->post('qap_name');
            $qap_email = $this->input->post('qap_email');
            $qap_city = $this->input->post('qap_city');
            $qap_phone = $this->input->post('qap_phone');
            $qap_address = $this->input->post('qap_address');
            $qap_bank_name = $this->input->post('qap_bank_name');
            $qap_accountNo = $this->input->post('qap_accountNo');
            $qap_branch = $this->input->post('qap_branch');
            $qap_ifscCode = $this->input->post('qap_ifscCode');
            $qap_bankCity = $this->input->post('qap_bankCity');

            $updateData = array(
                'qap_name' => $qap_name,
                'qap_email' => $qap_email,
                // 'qap_image' => $imagesname,
                'qap_city' => $qap_city,
                'qap_phone' => $qap_phone,
                'qap_address' => $qap_address,
                // 'qap_code' => $qap_code,
                'qap_bank_name' => $qap_bank_name,
                'qap_accountNo' => $qap_accountNo,
                'qap_branch' => $qap_branch,
                'qap_ifscCode' => $qap_ifscCode,
                'qap_bankCity' => $qap_bankCity,
                'creationTime' => strtotime(date("Y-m-d H:i:s")),
               
            );
              $where = array(
            'qap_id' => $id
                 );
             $options = array
                (
               
                'table' => 'qyura_qap',
                'where' => $where,
                'data' => $updateData
            );
         $qap_update = $this->qap_model->customUpdate($options);
         if($qap_update){
             echo "update";
         
      
         }else{
             echo "not update";
         }
         
        }    
    }
    
    function getQapDetail() {

        echo $this->qap_model->fetchQapDataTables();
    }
}
