<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class HealthTip extends MY_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->model('Healthtip_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
        $this->common_model->mypermission("1");
    }

    function index() {
        $data = array();
        
        $data['HealthtipData'] = $this->Healthtip_model->fetchHealthtipData();
        /*echo "<pre>";
        print_r($data['HealthtipData']);
        exit;*/
        $data['title'] = 'Healthtip';
        $this->load->super_admin_template('HealthtipListing', $data, 'HealthtipScript');
    }
//Prachi
    function getHealthtipDl() {

        echo $this->Healthtip_model->fetchHealthtipDataTables();
        
    }
//Prachi Display Edit Page
    function detailHealthtip($healthtipId) {
        $data = array();  
        $data['AllCategory'] = $this->Healthtip_model->fetchCategory();
        $data['healthtipData'] = $this->Healthtip_model->fetchhealthtipData($healthtipId);
        $data['healthtipId'] = $healthtipId;
        $data['editdetail'] = 'none';
        $data['detail'] = 'block';
        $data['title'] = "healthtipData";        
        $this->load->super_admin_template('HealthtipDetail', $data, 'HealthtipScript');
    }

    //Prachi Display Add Page

    function addHealthtip() {
        $data = array();
        $data['AllCategory'] = $this->Healthtip_model->fetchCategory();
        $data['title'] = "Add Healthtip";
        
        $this->load->super_admin_template('AddHealthtip', $data, 'HealthtipScript');
    }

   
    //Prachi Save ADD
    function SaveHealthtip() {
        
        $this->load->library('form_validation');
        $this->bf_form_validation->set_rules('healthtip_category', 'Category', 'required|trim');
        $this->bf_form_validation->set_rules('healthtip_detail', 'Detail', 'required|trim');
        $this->bf_form_validation->set_rules('healthtip_amount', 'Amount', 'required|trim|numeric');
       
        if (empty($_FILES['avatar_file']['name'])) {
            $this->bf_form_validation->set_rules('avatar_file', 'Health Tip Image', 'required');
           
        }
        if ($this->bf_form_validation->run() === FALSE) {

            $data = array();
            
            $data['AllCategory'] = $this->Healthtip_model->fetchCategory();
            $data['title'] = "Add Healthtip";

            $this->load->super_admin_template('AddHealthtip', $data, 'HealthtipScript');
        } else {

            $imagesname = "";
            if ($_FILES['avatar_file']['name']) {
                $path = realpath(FCPATH . 'assets/Health_tipimages/');
                $upload_data = $this->input->post('avatar_data');
                $upload_data = json_decode($upload_data);
                $original_imagesname = $this->uploadImageWithThumb($upload_data, 'avatar_file', $path, 'assets/Health_tipimages/', './assets/Health_tipimages/thumb/', 'health');

                if (empty($original_imagesname)) {
                    $data['AllCategory'] = $this->Healthtip_model->fetchCategory();
                    $this->session->set_flashdata('valid_upload', $this->error_message);
                    
                    $this->load->super_admin_template('AddHealthtip', $data, 'HealthtipScript');
                    return false;
                } else {
                    $imagesname = $original_imagesname;
                }
            }
           
                $insertdata = array(
                    'healthTips_categoryId' => trim($this->input->post('healthtip_category')),
                    'healthTips_detail' => trim($this->input->post('healthtip_detail')),
                    'healthTips_amount' => trim($this->input->post('healthtip_amount')),
                    'healthTips_image' =>$imagesname,
                    'creationTime' => strtotime(date("Y-m-d H:i:s"))
                );

                
               $healthtipId = $this->Healthtip_model->insertHealthtip($insertdata);
               $this->session->set_flashdata('message', 'Data inserted successfully !');
               redirect('healthtip');
            
               
                
        }
    }

    //Prachi Save Edit   
    function saveDetailHealthtip($healthtip_Id) {

        $this->load->library('form_validation');
        $this->bf_form_validation->set_rules('healthtip_category', 'Category', 'required|trim');
        $this->bf_form_validation->set_rules('healthtip_detail', 'Detail', 'required|trim');
        $this->bf_form_validation->set_rules('healthtip_amount', 'Amount', 'required|trim|numeric');
        
        $updatedata = array(
            'healthTips_categoryId' => trim($this->input->post('healthtip_category')),
            'healthTips_detail' => trim($this->input->post('healthtip_detail')),
            'healthTips_amount' => trim($this->input->post('healthtip_amount')),
            'creationTime' => strtotime(date("Y-m-d H:i:s"))
        );
                
               $where = array(
                'healthTips_id' => $healthtip_Id
            );
            $response = '';
            $response = $this->Healthtip_model->UpdateTableData($updatedata, $where, 'qyura_healthTips');
            
            
            if ($response) {
                $updateUserdata = array(
                   
                    'modifyTime' => strtotime(date("Y-m-d H:i:s"))
                );
                $whereUser = array(
                    'healthTips_id' => $healthtip_Id
                );
                $response = $this->Healthtip_model->UpdateTableData($updateUserdata, $whereUser, 'qyura_healthTips');
                if ($response) {
                    $this->session->set_flashdata('message', 'Data updated successfully !');
                    redirect("healthtip");
                }
            }

    }
    
    //Prachi Delete
    function deleteHealthtip($healthtip_Id) {

        
        
        $updatedata = array(
            'healthTips_deleted' => 1,
        );
                
               $where = array(
                'healthTips_id' => $healthtip_Id
            );
            $response = '';
            
            $where2 = array("sponsor_tipId"=>$healthtip_Id);
            $response = $this->Healthtip_model->fetchTableData(array("*"),"qyura_healthTipSponsor",$where2);
            if(empty($response)){
                $response = $this->Healthtip_model->UpdateTableData($updatedata, $where, 'qyura_healthTips');    
                if ($response) {
                    $updateUserdata = array(

                        'modifyTime' => strtotime(date("Y-m-d H:i:s"))
                    );
                    $whereUser = array(
                        'healthTips_id' => $healthtip_Id
                    );
                    $response = $this->Healthtip_model->UpdateTableData($updateUserdata, $whereUser, 'qyura_healthTips');
                    if ($response) {
                        $this->session->set_flashdata('message', 'Data updated successfully !');
                        redirect("healthtip");
                    }
                }
            }else{
                $this->session->set_flashdata('message', 'Healthtip is Currently Sponsered !');
                redirect("healthtip");
            
            }

    }
    

    function getImageBase64Code($img) {
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $img = str_replace('[removed]', '', $img);
        $data = base64_decode($img);
        return $data;
    }

    

    function editUploadImage() {
        if ($_POST['avatar_file']['name']) {
            $path = realpath(FCPATH . 'assets/ambulanceImages/');
            $upload_data = $this->input->post('avatar_data');
            $upload_data = json_decode($upload_data);

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
            $option = array(
                'table'=>'qyura_ambulance',
                'where'=> array('ambulance_id' => $id)
            );
            $data = $this->Ambulance_model->customGet($option);
            echo "<img src='" . base_url() . "assets/ambulanceImages/thumb/original/" . $data[0]->ambulance_img . "'alt='' class='logo-img' />";
            exit();
        }
    }
    //Update Health Image
    function setBackgroundUpload($htipid) {

        if (isset($_FILES["file"]["name"])) {

            $temp = explode(".", $_FILES['file']["name"]);
            $microtime = round(microtime(true));
            $imageName = "health";
            $newfilename = "" . $imageName . "_" . $microtime . '.' . end($temp);
            $uploadData = $this->uploadImages('file', 'Health_tipimages', $newfilename);
            if ($uploadData['status']) {
                $imageName = $uploadData['imageData']['file_name'];

                $option = array(
                    'table' => 'qyura_healthTips',
                    'data' => array('healthTips_image' => $imageName),
                    'where' => array('healthTips_id' => $htipid)
                );
                $response = $this->Healthtip_model->customUpdate($option);
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
      function createCSV(){
       
        $where=array('healthTips_deleted'=> 0);
        $array[]= array('Category Name','Description','Amount');      
        $data = $this->Healthtip_model->createCSVdata($where);
        $arrayFinal = array_merge($array,$data);
        array_to_csv($arrayFinal,'HealthTip.csv');
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
    

    function getBackgroundImage($id) {
        $option = array(
            'table' => 'qyura_healthTips',
            'select' => 'healthTips_image',
            'where' => array('healthTips_id' => $id)
        );
        $response = $this->Healthtip_model->customGet($option);
        if ($response) {
          echo  $image = base_url().'assets/Health_tipimages/'.$response[0]->healthTips_image;
        

        }
    }

}
