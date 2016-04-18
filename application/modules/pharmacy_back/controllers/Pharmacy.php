<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pharmacy extends CI_Controller {

     public function __construct() {
       parent:: __construct();
       $this->load->library('form_validation');
       $this->load->model('Pharmacy_model');
   }
   function index(){
        $data = array();
       $data['allStates'] = $this->Pharmacy_model->fetchStates();
       $data['pharmacyData'] = $this->Pharmacy_model->fetchpharmacyData();
       //print_r($data['pharmacyData']);
       //exit;
       
        $this->load->view('pharmacyListing',$data);
   }
   function addPharmacy(){
   		$data = array();
        $data['allStates'] = $this->Pharmacy_model->fetchStates();
        $this->load->view('addPharmacy',$data);
   }
   function detailPharmacy($pharmacyId=''){
       $data = array();
        $data['pharmacyData'] = $this->Pharmacy_model->fetchpharmacyData($pharmacyId);
        $data['pharmacyId'] = $pharmacyId;
        $data['showStatus'] = 'none';
        $data['detailShow'] = 'block';
        $this->load->view('pharmacyDetail',$data);
   }
   function fetchCity(){
       //echo "fdadas";exit;
        $stateId = $this->input->post('stateId');
        $cityData = $this->Pharmacy_model->fetchCity($stateId);
        $cityOption = '';
        $cityOption .='<option value=>Select Your City</option>';
        foreach($cityData as $key=>$val ) {
            $cityOption .= '<option value='.$val->city_id.'>'. strtoupper($val->city_name).'</option>';
        }
       echo $cityOption;
        exit;
    }
    
  function SavePharmacy(){
     // print_r($_POST);exit;
      	$this->load->library('form_validation');
        $this->form_validation->set_rules('pharmacy_name', 'Pharmacy Name', 'required|trim');
      
        $this->form_validation->set_rules('pharmacy_countryId', 'Pharmacy Country', 'required|trim');
        $this->form_validation->set_rules('pharmacy_stateId', 'Pharmacy StateId', 'required|trim');
        $this->form_validation->set_rules('pharmacy_cityId', 'Pharmacy City', 'required|trim');
        
        //$this->form_validation->set_rules('pharmacy_phn[]', 'Pharmacy Mobile No', 'required|trim');
       $this->form_validation->set_rules('pharmacy_zip','Pharmacy Zip', 'required|trim');
       $this->form_validation->set_rules('pharmacy_address','Pharmacy Address','required|trim');
       $this->form_validation->set_rules('pharmacy_address','Pharmacy Address','required|trim');
   
        $this->form_validation->set_rules('pharmacy_mmbrTyp', 'Membership Type', 'required|trim');
      $this->form_validation->set_rules('users_email','Users Email','required|valid_email|trim');
        if (empty($_FILES['pharmacy_img']['name']))
         {
             $this->form_validation->set_rules('pharmacy_img', 'File', 'required');
        }
        if ($this->form_validation->run() === FALSE) {
          //echo validation_errors();
          //exit;
             $data = array();
             $data['allStates'] = $this->Pharmacy_model->fetchStates();
            $this->load->view('addPharmacy',$data);
         }
         else {
             
             $imagesname='';
              if ($_FILES['pharmacy_img']['name'] ) {
             $path = realpath(FCPATH.'assets/pharmacyImages/');
             $temp = explode(".", $_FILES["pharmacy_img"]["name"]);
                $newfilename = 'Pharmacy_'.round(microtime(true)) . '.' . end($temp);
                $config['upload_path'] = $path;
                $config['allowed_types'] = 'jpg|jpeg|gif|png';
                $config['max_size'] = '5000';
                $config['max_width']  = '1024';
                $config['max_height']  = '768';
                $config['file_name'] = $newfilename;
              
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
               if ( ! $this->upload->do_upload('pharmacy_img'))
                {
                    $data = array();
                    $data['allStates'] = $this->Pharmacy_model->fetchStates();
                    $this->session->set_flashdata('valid_upload', $this->upload->display_errors());
                    $this->load->view('addPharmacy',$data);
                    return false;
                 }
                else
                {
                    $imagesname = $newfilename;

                }
                
              } 
              
               //echo $imagesname;exit;
                $pharmacy_phn = $this->input->post('pharmacy_phn');
                $pre_number = $this->input->post('pre_number');
                 //$countPnone = $this->input->post('countPnone');
                 
                  $finalNumber = '';
                for($i= 0;$i < count($pharmacy_phn) ;$i++) {
                    if($pharmacy_phn[$i] != '' && $pre_number[$i] !='') {
                       $finalNumber .= $pre_number[$i].' '.$pharmacy_phn[$i].'|'; 
                    }
                    
                }
                

                $pharmacy_name = $this->input->post('pharmacy_name');
                $countryId = $this->input->post('pharmacy_countryId');
                $stateId = $this->input->post('pharmacy_stateId');
                $cityId = $this->input->post('pharmacy_cityId');
                $pharmacy_address = $this->input->post('pharmacy_address'); 
                $pharmacy_cntPrsn = $this->input->post('pharmacy_cntPrsn');
                $pharmacy_mmbrTyp = $this->input->post('pharmacy_mmbrTyp');
                $isEmergency = $this->input->post('isEmergency');
                $pharmacy_zip = $this->input->post('pharmacy_zip');
                
                    $insertData = array(
                     'pharmacy_name'=> $pharmacy_name,
                     'pharmacy_countryId' => $countryId,
                     'pharmacy_stateId' => $stateId,
                     'pharmacy_cityId'=> $cityId,
                     'pharmacy_address'=>$pharmacy_address,
                     'pharmacy_cntPrsn'=> $pharmacy_cntPrsn,
                     'pharmacy_mmbrTyp' => $pharmacy_mmbrTyp,
                     'pharmacy_zip' => $pharmacy_zip,
                     'pharmacy_27Src' => $isEmergency,
                     'pharmacy_img' => $imagesname,
                    'creationTime' => strtotime(date("Y-m-d H:i:s")),
                   'pharmacy_phn' => $finalNumber,
                    'pharmacy_lat' => $this->input->post('lat'),
                    'pharmacy_long' => $this->input->post('lng'),
                    'pharmacy_type'  => $this->input->post('pharmacyType') 
                        
                    );
                    $users_email = $this->input->post('users_email');
                    $pharmacyInsert = array(
                   'users_email' => $users_email,
                   'users_ip_address' => $this->input->ip_address(),
                );
                    $pharmacy_usersId = $this->Pharmacy_model->insertPharmacyUser($pharmacyInsert);
                    if($pharmacy_usersId) {

                      $insertusersRoles = array(
                      'usersRoles_userId' => $pharmacy_usersId,
                      'usersRoles_roleId' => 5,
                      'usersRoles_parentId' => 0,
                      'creationTime' => strtotime(date("Y-m-d H:i:s"))
                  );

                  $this->Pharmacy_model->insertUsersRoles($insertusersRoles);
                   
                   $insertData['pharmacy_usersId'] = $pharmacy_usersId;
                  $pharmacyId = $this->Pharmacy_model->insertPharmacy($insertData);
                  $this->session->set_flashdata('message','Data inserted successfully !');
                }
                   redirect('pharmacy/addPharmacy');
         }
  }  
  function uploadImages ($imageName,$folderName,$newName){
             $path = realpath(FCPATH.'assets/'.$folderName.'/');
                 $config['upload_path'] = $path;
            //echo $config['upload_path']; 
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '5000';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
                $config['file_name'] = $newName;
                
               
		$this->load->library('upload', $config);
               $this->upload->initialize($config);
               $this->upload->do_upload($imageName);
               return TRUE;

    }
    
  function getImageBase64Code($img)
    {
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $img = str_replace('[removed]', '', $img);
        $data = base64_decode($img);
        return $data;
    }
    function check_email(){
        $user_table_id = '';
        $users_email = $this->input->post('users_email');
        if(isset($_POST['user_table_id'])){
          $user_table_id = $this->input->post('user_table_id');
        }
        $email = $this->Pharmacy_model->fetchEmail($users_email,$user_table_id);
        echo $email;
        exit;
    }
    function saveDetailPharmacy($pharmacyId){
        
        $this->form_validation->set_rules('pharmacy_name', 'Pharmacy Name', 'required|trim');
      
        $this->form_validation->set_rules('pharmacy_address', 'Pharmacy Address', 'required|trim');
        $this->form_validation->set_rules('users_email','Users Email','required|valid_email|trim');
        $this->form_validation->set_rules('pharmacy_cntPrsn', 'Pharmacy Contact Person', 'required|trim');
        if ($this->form_validation->run() === FALSE) {
             $data = array();
             $data['pharmacyData'] = $this->Pharmacy_model->fetchpharmacyData($pharmacyId);
               $data['pharmacyId'] = $pharmacyId;
               $data['showStatus'] = 'block';
               $data['detailShow'] = 'none';
             $this->load->view('pharmacyDetail',$data);
             
         }
         else{
              $pharmacy_phn = $this->input->post('pharmacy_phn');
                $pre_number = $this->input->post('pre_number');
                 //$countPnone = $this->input->post('countPnone');
                 
                  $finalNumber = '';
                for($i= 0;$i < count($pharmacy_phn) ;$i++) {
                    if($pharmacy_phn[$i] != '' && $pre_number[$i] !='') {
                       $finalNumber .= $pre_number[$i].' '.$pharmacy_phn[$i].'|'; 
                    }
                } 
                
                $updatePharmacy = array(
                  'pharmacy_name'=>  $this->input->post('pharmacy_name'),
                  'pharmacy_type'=> $this->input->post('pharmacy_type'),
                     'pharmacy_address' =>  $this->input->post('pharmacy_address'),
                     'pharmacy_phn' => $finalNumber,
                      'pharmacy_cntPrsn'=> $this->input->post('pharmacy_cntPrsn'),
                      'pharmacy_mmbrTyp'=> $this->input->post('pharmacy_mmbrTyp'),
                      'pharmacy_27Src'=> $this->input->post('isEmergency'),
                     'pharmacy_lat'=> $this->input->post('lat'), 
                    'pharmacy_long'=> $this->input->post('lng'),  
                    'modifyTime'=> strtotime(date("Y-m-d H:i:s"))  
                );
                
                $where = array(
                    'pharmacy_id' => $pharmacyId
                );
                $response = '';
               $response = $this->Pharmacy_model->UpdateTableData($updatePharmacy,$where,'qyura_pharmacy');
               if($response){
                   $updateUserdata = array(
                       'users_email' => $this->input->post('users_email'),
                      'modifyTime'=> strtotime(date("Y-m-d H:i:s"))  
                  );
                  $whereUser = array(
                    'users_id' => $this->input->post('user_tables_id')  
                  ); 
                 $response = $this->Pharmacy_model->UpdateTableData($updateUserdata,$whereUser,'qyura_users'); 
                 if($response) {
                 $this->session->set_flashdata('message','Data updated successfully !');
                  redirect("pharmacy/detailPharmacy/$pharmacyId");
                 }
               }
         }
    }
    
}  