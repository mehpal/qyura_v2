<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bloodbank extends CI_Controller {

     public function __construct() {
       parent:: __construct();
       $this->load->library('form_validation');
       $this->load->model('Bloodbank_model');
   }
   
   function index(){
        $data = array();
       $data['allStates'] = $this->Bloodbank_model->fetchStates();
       $data['bloodBankData'] = $this->Bloodbank_model->fetchbloodBankData();
       // print_r($data['hospitalData'] );exit;
        $this->load->view('bloodBankList',$data);
   }
   function Addbloodbank(){
        $data = array();
        $data['allStates'] = $this->Bloodbank_model->fetchStates();
       $this->load->view('Addbloodbank',$data);
       // $this->load->view('Addbloodbank');
   }
   
   function detailBloodBank($bloodBankId=''){
       $data = array();
        $data['bloodBankData'] = $this->Bloodbank_model->fetchbloodBankData($bloodBankId);
        $data['bloodBankId'] = $bloodBankId;
        $data['showStatus'] = 'none';
        $data['detailShow'] = 'block';
        $this->load->view('bloodBankDetail',$data);
   }
   function fetchCity (){
       //echo "fdadas";exit;
        $stateId = $this->input->post('stateId');
        $cityData = $this->Bloodbank_model->fetchCity($stateId);
        $cityOption = '';
        $cityOption .='<option value=>Select Your City</option>';
        foreach($cityData as $key=>$val ) {
            $cityOption .= '<option value='.$val->city_id.'>'. strtoupper($val->city_name).'</option>';
        }
       echo $cityOption;
        exit;
    }
    
  function SaveBloodbank(){

         $this->form_validation->set_rules('bloodBank_name', 'BloodBank Name', 'required|trim');
      
        $this->form_validation->set_rules('countryId', 'Bloodbank Country', 'required|trim');
        $this->form_validation->set_rules('stateId', 'BloodBank StateId', 'required|trim');
        $this->form_validation->set_rules('cityId', 'BloodBank City', 'required|trim');
        
        $this->form_validation->set_rules('bloodBank_mblNo', 'BloodBank Mobile No', 'required|trim');
       $this->form_validation->set_rules('bloodBank_zip','BloodBank Zip', 'required|trim');
       $this->form_validation->set_rules('bloodBank_add','BloodBank Address','required|trim');
        $this->form_validation->set_rules('bloodBank_cntPrsn', 'Contact Person', 'required|trim');
        $this->form_validation->set_rules('bloodBank_mbrTyp', 'Membership Type', 'required|trim');
       $this->form_validation->set_rules('users_email','Users Email','required|valid_email|trim');
       $this->form_validation->set_rules('users_password', 'Password', 'trim|required|matches[cnfPassword]');
        $this->form_validation->set_rules('cnfPassword', 'Password Confirmation', 'trim|required');
        if (empty($_FILES['bloodBank_photo']['name']))
         {
             $this->form_validation->set_rules('bloodBank_photo', 'File', 'required');
        }
        if ($this->form_validation->run() === FALSE) {
             $data = array();
             $data['allStates'] = $this->Bloodbank_model->fetchStates();
            $this->load->view('Addbloodbank',$data);
         }
         else {
             
             $imagesname='';
              if ($_FILES['bloodBank_photo']['name'] ) {
             $path = realpath(FCPATH.'assets/BloodBank/');
             $temp = explode(".", $_FILES["bloodBank_photo"]["name"]);
                $newfilename = 'Blood_'.round(microtime(true)) . '.' . end($temp);
                $config['upload_path'] = $path;
                $config['allowed_types'] = 'jpg|jpeg|gif|png';
                $config['max_size'] = '2000';
                $config['max_width']  = '1024';
                $config['max_height']  = '768';
                $config['file_name'] = $newfilename;
              
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
               if ( ! $this->upload->do_upload('bloodBank_photo'))
                {
                    $data = array();
                    $data['allStates'] = $this->Bloodbank_model->fetchStates();
                    $this->session->set_flashdata('valid_upload', $this->upload->display_errors());
                    $this->load->view('Addbloodbank',$data);
                    return false;
                 }
                else
                {
                    $imagesname = $newfilename;

                }
                
              } 
                $bloodBank_phn = $this->input->post('bloodBank_phn');
                $pre_number = $this->input->post('pre_number');
                 //$countPnone = $this->input->post('countPnone');
                 
                  $finalNumber = '';
                for($i= 0;$i < count($countPnone) ;$i++) {
                    if($bloodBank_phn[$i] != '' && $pre_number[$i] !='') {
                       $finalNumber .= $pre_number[$i].' '.$bloodBank_phn[$i].'|'; 
                    }
                    
                }
                
                $bloodBank_name = $this->input->post('bloodBank_name');
                $countryId = $this->input->post('countryId');
                $stateId = $this->input->post('stateId');
                $cityId = $this->input->post('cityId');
                $bloodBank_add = $this->input->post('bloodBank_add');
                 
                $bloodBank_cntPrsn = $this->input->post('bloodBank_cntPrsn');
                $bloodBank_mbrTyp = $this->input->post('bloodBank_mbrTyp');
                $isEmergency = $this->input->post('isEmergency');
                $bloodBank_zip = $this->input->post('bloodBank_zip');
                
                
                $users_email = $this->input->post('users_email');
                $users_password = md5($this->input->post('users_password'));
                $bloodBankInsert = array(
                   'users_email' => $users_email,
                    'users_password'=> $users_password,
                   'users_ip_address' => $this->input->ip_address(),
                    'users_mobile' => $this->input->post('bloodBank_mblNo')
                );
               $bloodbank_usersId = $this->Bloodbank_model->insertBloodBankUser($bloodBankInsert); 
               if($bloodbank_usersId){
                   
                   $insertusersRoles = array(
                      'usersRoles_userId' => $bloodbank_usersId,
                      'usersRoles_roleId' => 2,
                      'usersRoles_parentId' => 0,
                      'creationTime' => strtotime(date("Y-m-d H:i:s"))
                  );
                  $this->Bloodbank_model->insertUsersRoles($insertusersRoles);
                  
                   
                    $insertData = array(
                     'bloodBank_name'=> $bloodBank_name,
                     'countryId' => $countryId,
                     'stateId' => $stateId,
                      'cityId'=> $cityId,
                     'bloodBank_add'=>$bloodBank_add,
                     'bloodBank_cntPrsn'=> $bloodBank_cntPrsn,
                     'bloodBank_mbrTyp' => $bloodBank_mbrTyp,
                     'isEmergency' => $isEmergency,
                     'bloodBank_zip' => $bloodBank_zip ,
                     'bloodBank_photo' => $imagesname,
                   'creationTime' => strtotime(date("Y-m-d H:i:s")),
                   'bloodBank_phn' => $finalNumber,
                    'bloodBank_lat' => $this->input->post('lat'),
                    'bloodBank_long' => $this->input->post('lng'),
                    'users_id' => $bloodbank_usersId    
                        
                    );
                    
                     $bloodBankId = $this->Bloodbank_model->insertBloodBank($insertData);
               }
               $this->session->set_flashdata('message','Data inserted successfully !');
                  redirect('diagnostic/Addbloodbank');
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
                //$field_name = $_FILES['hospital_photo']['name'];
               
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
        $email = $this->Bloodbank_model->fetchEmail($users_email,$user_table_id);
        echo $email;
        exit;
    }
    
    function saveDetailBloodBank($bloodBankId){
        
        $this->form_validation->set_rules('bloodBank_name', 'BloodBank Name', 'required|trim');
      
        $this->form_validation->set_rules('bloodBank_add', 'Bloodbank Address', 'required|trim');
        $this->form_validation->set_rules('users_email','Users Email','required|valid_email|trim');
        $this->form_validation->set_rules('bloodBank_cntPrsn', 'BloodBank Contact Person', 'required|trim');
        if ($this->form_validation->run() === FALSE) {
             $data = array();
             $data['bloodBankData'] = $this->Bloodbank_model->fetchbloodBankData($bloodBankId);
               $data['bloodBankId'] = $bloodBankId;
               $data['showStatus'] = 'block';
               $data['detailShow'] = 'none';
             $this->load->view('bloodBankDetail',$data);
             
         }
         else{
              $bloodBank_phn = $this->input->post('bloodBank_phn');
                $pre_number = $this->input->post('pre_number');
                 //$countPnone = $this->input->post('countPnone');
                 
                  $finalNumber = '';
                for($i= 0;$i < count($bloodBank_phn) ;$i++) {
                    if($bloodBank_phn[$i] != '' && $pre_number[$i] !='') {
                       $finalNumber .= $pre_number[$i].' '.$bloodBank_phn[$i].'|'; 
                    }
                } 
                
                $updateBloodBank = array(
                  'bloodBank_name'=>  $this->input->post('bloodBank_name'),
                     'bloodBank_add' =>  $this->input->post('bloodBank_add'),
                     'bloodBank_phn' => $finalNumber,
                      'bloodBank_cntPrsn'=> $this->input->post('bloodBank_cntPrsn'),
                     'bloodBank_lat'=> $this->input->post('lat'), 
                    'bloodBank_long'=> $this->input->post('lng'),  
                    'modifyTime'=> strtotime(date("Y-m-d H:i:s"))  
                );
                
                $where = array(
                    'bloodBank_id' => $bloodBankId
                );
                $response = '';
               $response = $this->Bloodbank_model->UpdateTableData($updateBloodBank,$where,'qyura_bloodBank');
               if($response){
                   $updateUserdata = array(
                       'users_email' => $this->input->post('users_email'),
                      'modifyTime'=> strtotime(date("Y-m-d H:i:s"))  
                  );
                  $whereUser = array(
                    'users_id' => $this->input->post('user_tables_id')  
                  ); 
                 $response = $this->Bloodbank_model->UpdateTableData($updateUserdata,$whereUser,'qyura_users'); 
                 if($response) {
                 $this->session->set_flashdata('message','Data updated successfully !');
                  redirect("bloodbank/detailBloodBank/$bloodBankId");
                 }
               }
         }
    }
    
    function updatePassword(){
        //echo "here";exit;
        $currentPassword = $this->input->post('currentPassword');
        //$existingPassword = $this->input->post('existingPassword');
        $user_tables_id = $this->input->post('user_tables_id');
        
        $encrypted = md5($currentPassword);
        $return = 0;
       /* if($encrypted != $existingPassword){
            echo $return;
        }
         else {
                    $updateBloodBank = array(
                  'bloodBank_name'=>  $encrypted,
                    'modifyTime'=> strtotime(date("Y-m-d H:i:s"))  
                );
                
                $where = array(
                    'users_id' => $user_tables_id
                );
             $this->Bloodbank_model->UpdateTableData($updateBloodBank,$where,'qyura_users');
                     
             echo $return = '1'.'~'.$encrypted;
         }*/
        
         $updateBloodBank = array(
                  'users_password'=>  $encrypted,
                    'modifyTime'=> strtotime(date("Y-m-d H:i:s"))  
                );
                
                $where = array(
                    'users_id' => $user_tables_id
                );
            $return = $this->Bloodbank_model->UpdateTableData($updateBloodBank,$where,'qyura_users');
                     
             echo $return ;
        //echo $encrypted;
        exit;
        
    }
}

