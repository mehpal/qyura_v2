<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bloodbank extends CI_Controller {

     public function __construct() {
       parent:: __construct();
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
      
      $this->load->library('form_validation');
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
                $config['max_size'] = '5000';
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
              //echo "i am here";
               
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
                $diagnosticInsert = array(
                   'users_email' => $users_email,
                    'users_password'=> $users_password,
                   'users_ip_address' => $this->input->ip_address(),
                );
               $bloodbank_usersId = $this->Bloodbank_model->insertBloodBankUser($diagnosticInsert); 
               if($bloodbank_usersId){
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
                    'bloodBank_long' => $this->input->post('lng')   
                        
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
        $users_email = $this->input->post('users_email');
        $email = $this->Bloodbank_model->fetchEmail($users_email);
        echo $email;
        exit;
    }
}

