<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class HealthCategory extends MY_Controller {

    public function __construct() {
        parent:: __construct();
        
        $this->load->model(array('Category_model',"Common_model"));
        
        $this->load->library(array('form_validation',"datatables"));
        $this->Common_model->mypermission("7");
        
    }

    function index() {
        
       
        $data = array();  
        $data['CategoryData'] = $this->Category_model->fetchCategoryData();
        
        $data['title'] = 'Health Category';
        $this->load->super_admin_template('CategoryListing', $data, 'CategoryScript');
    }
//Prachi
    function getHealthtipDl() {

        echo $this->Category_model->fetchHealthCategoryDataTables();
        
    }
//Prachi Display Edit Page
    function detailCategory($categoryId) {
        $data = array();  
        
        $data['CategoryData'] = $this->Category_model->fetchCategory($categoryId);
        $data['categoryId'] = $categoryId;
        $data['editdetail'] = 'none';
        $data['detail'] = 'block';
        $data['title'] = "Category Data";        
        $this->load->super_admin_template('CategoryDetail', $data, 'CategoryScript');
    }

    //Prachi Display Add Page

    function addHealthCategory() {
        $data = array();
        
        $data['title'] = "Add Category";
        
        $this->load->super_admin_template('AddCategory', $data, 'CategoryScript');
    }

   
    //Prachi Save ADD
    function SaveCategory() {
        
        $this->load->library('form_validation');
        $this->bf_form_validation->set_rules('health_category', 'Category', 'required|trim');
        
        if ($this->bf_form_validation->run() === FALSE) {

            $data = array();
            $data['title'] = "Add Health Category";
            $this->load->super_admin_template('AddCategory', $data, 'CategoryScript');
        } else {
                $insertdata = array(
                    'category_name' => $this->input->post('health_category'),
                    'status' => 0,
                    'creationTime' => strtotime(date("Y-m-d H:i:s"))
                );

                
               $CategoryId = $this->Category_model->insertTableData("qyura_healthCategory",$insertdata);
               $this->session->set_flashdata('message', 'Data inserted successfully !');
               redirect('healthcategory');
            
               
                
        }
    }

    //Prachi Save Edit   
    function saveDetailCategory($category_Id) {

        $this->load->library('form_validation');
        $this->bf_form_validation->set_rules('health_category', 'Category', 'required|trim');
        
        
        $updatedata = array(
            'category_name' => $this->input->post('health_category'),
            'creationTime' => strtotime(date("Y-m-d H:i:s"))
        );
                
               $where = array(
                'category_id' => $category_Id
            );
            $response = '';
            $response = $this->Category_model->UpdateTableData($updatedata, $where, 'qyura_healthCategory');
            
            
            if ($response) {
                $updateUserdata = array(
                   
                    'modifyTime' => strtotime(date("Y-m-d H:i:s"))
                );
                $whereUser = array(
                    'category_id' => $category_Id
                );
                $response = $this->Category_model->UpdateTableData($updateUserdata, $whereUser, 'qyura_healthCategory');
                if ($response) {
                    $this->session->set_flashdata('message', 'Data updated successfully !');
                    redirect("healthcategory");
                }
            }

    }
    
   function deleteCategory($category_Id) {

        
        $updatedata = array(
            'category_deleted' => 1
        );
                
               $where = array(
                'category_id' => $category_Id
            );
            $response = '';
            
            $where2 = array("healthTips_categoryId"=>$category_Id); 
            $response = $this->Category_model->fetchTableData(array("*"),"qyura_healthTips",$where2);
            
            if(empty($response)){
            $response = $this->Category_model->UpdateTableData($updatedata, $where, 'qyura_healthCategory');
           
            
            if ($response) {
                
                $updateUserdata = array(
                   
                    'modifyTime' => strtotime(date("Y-m-d H:i:s"))
                );
                $whereUser = array(
                    'category_id' => $category_Id
                );
                $response = $this->Category_model->UpdateTableData($updateUserdata, $whereUser, 'qyura_healthCategory');
                if ($response) {
                    $this->session->set_flashdata('message', 'Data deleted successfully !');
                    redirect("healthcategory");
                }
                }
                
            }
            else{
                     $this->session->set_flashdata('message', 'Health Tip added on this Category !');
                    redirect("healthcategory");
                }

    }
      function createCSV(){
       
        $where=array('category_deleted'=> 0);
        $array[]= array('Category Name');      
        $data = $this->Category_model->createCSVdata($where);
        $arrayFinal = array_merge($array,$data);
        array_to_csv($arrayFinal,'HealthCategory.csv');
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
            'table' => 'qyura_ambulance',
            'select' => 'ambulance_background_img',
            'where' => array('ambulance_id' => $id)
        );
        $response = $this->Ambulance_model->customGet($option);
        if ($response) {
          echo  $image = base_url().'assets/ambulanceImages/'.$response[0]->ambulance_background_img;
        

        }
    }

}
