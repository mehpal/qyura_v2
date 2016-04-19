<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Diagnostic extends CI_Controller {
    
   public function __construct() {
       parent:: __construct();
       $this->load->model('diagnostic_model');
   }
   
   function index(){
       $data = array();
       $data['allStates'] = $this->diagnostic_model->fetchStates();
       $data['diagnosticData'] = $this->diagnostic_model->fetchdiagnosticData();
       $this->load->view('diagnosticlisting',$data);
       
   }
   
   function addDiagnostic(){
    $data = array();
        $data['allStates'] = $this->diagnostic_model->fetchStates();
        $this->load->view('addDiagcenter',$data);
   }
   function fetchCity (){
        $stateId = $this->input->post('stateId');
        $cityData = $this->diagnostic_model->fetchCity($stateId);
        $cityOption = '';
        $cityOption .='<option value=>Select Your City</option>';
        foreach($cityData as $key=>$val ) {
            $cityOption .= '<option value='. $val->city_id.'>'. strtoupper($val->city_name).'</option>';
        }
       echo $cityOption;
        exit;
    }
     function check_email(){
        $users_email = $this->input->post('users_email');
        $email = $this->diagnostic_model->fetchEmail($users_email);
        echo $email;
        exit;
    }
    function SaveDiagnostic(){
         $this->load->library('form_validation');
         $this->form_validation->set_rules('diagnostic_name', 'Diagnostic Name', 'required|trim');
       
        $this->form_validation->set_rules('diagnostic_address', 'Diagnostic Address', 'required|trim');
       //$this->form_validation->set_rules('diagnostic_phn', 'Diagnostic Phone', 'required|trim');
       
        $this->form_validation->set_rules('diagnostic_cntPrsn', 'Contact Person', 'required|trim');
        $this->form_validation->set_rules('diagnostic_mbrTyp', 'Membership Type', 'required|trim');
        
        $this->form_validation->set_rules('diagnostic_countryId', 'Diagnostic Country', 'required|trim');
        $this->form_validation->set_rules('diagnostic_stateId', 'Diagnostic StateId', 'required|trim');
        $this->form_validation->set_rules('diagnostic_cityId', 'Diagnostic City', 'required|trim');
        
        $this->form_validation->set_rules('diagnostic_mblNo', 'Diagnostic Mobile No', 'required|trim');
      
       $this->form_validation->set_rules('diagnostic_zip','Diagnostic Zip', 'required|trim');
       $this->form_validation->set_rules('users_email','Users Email','required|valid_email|trim');
       $this->form_validation->set_rules('users_password', 'Password', 'trim|required|matches[cnfPassword]');
        $this->form_validation->set_rules('cnfPassword', 'Password Confirmation', 'trim|required');
        
        if (empty($_FILES['diagnostic_img']['name']))
         {
             $this->form_validation->set_rules('diagnostic_img', 'File', 'required');
        }
       if ($this->form_validation->run() === FALSE) {
           $data = array();
                $data['allStates'] = $this->diagnostic_model->fetchStates();
             $this->load->view('addDiagcenter',$data);
         }
         else {
        
             $imagesname='';
              if ($_FILES['diagnostic_img']['name'] ) {
             $path = realpath(FCPATH.'assets/diagnosticsImage/');
             $temp = explode(".", $_FILES["diagnostic_img"]["name"]);
                $newfilename = 'Diag_'.round(microtime(true)) . '.' . end($temp);
                $config['upload_path'] = $path;
                $config['allowed_types'] = 'jpg|jpeg|gif|png';
                $config['max_size'] = '5000';
                $config['max_width']  = '1024';
                $config['max_height']  = '768';
                $config['file_name'] = $newfilename;
              
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
               if ( ! $this->upload->do_upload('diagnostic_img'))
                {
                    $data = array();
                    $data['allStates'] = $this->diagnostic_model->fetchStates();
                    $this->session->set_flashdata('valid_upload', $this->upload->display_errors());
                    $this->load->view('addDiagcenter',$data);
                    return false;
                 }
                else
                {
                    $imagesname = $newfilename;

                }
                
              } 
              //echo "i am here";
               
                $diagnostic_phn = $this->input->post('diagnostic_phn');
                $pre_number = $this->input->post('pre_number');
                 $countPnone = $this->input->post('countPnone');
                 
                  $finalNumber = '';
                for($i= 0;$i < count($countPnone) ;$i++) {
                    if($diagnostic_phn[$i] != '' && $pre_number[$i] !='') {
                       $finalNumber .= $pre_number[$i].' '.$diagnostic_phn[$i].'|'; 
                    }
                    
                }
                
                $diagnostic_name = $this->input->post('diagnostic_name');
               
                $diagnostic_address = $this->input->post('diagnostic_address');
                 $diagnostic_phn = $this->input->post('diagnostic_phn');
                $diagnostic_cntPrsn = $this->input->post('diagnostic_cntPrsn');
               // $diagnostic_dsgn = $this->input->post('diagnostic_dsgn');
                $diagnostic_mmbrTyp = $this->input->post('diagnostic_mbrTyp');
                 $diagnostic_countryId = $this->input->post('diagnostic_countryId');
                $diagnostic_stateId = $this->input->post('diagnostic_stateId');
                $diagnostic_cityId = $this->input->post('diagnostic_cityId');
                $diagnostic_mblNo = $this->input->post('diagnostic_mblNo');
                $diagnostic_zip = $this->input->post('diagnostic_zip');
                
                
                $users_email = $this->input->post('users_email');
                $users_password = md5($this->input->post('users_password'));
                $diagnosticInsert = array(
                   'users_email' => $users_email,
                    'users_password'=> $users_password,
                   'users_ip_address' => $this->input->ip_address(),
                );
                 
               $diagnostic_usersId = $this->diagnostic_model->insertDiagnosticUser($diagnosticInsert);
               //echo $diagnostic_usersId;exit;
               if($diagnostic_usersId) {
                   
                   $insertData['diagnostic_usersId'] = $diagnostic_usersId;
                   $insertData = array(
                  'diagnostic_name'=> $diagnostic_name,
                   'diagnostic_address' => $diagnostic_address, 
                   'diagnostic_cntPrsn' => $diagnostic_cntPrsn, 
                   'diagnostic_phn' => $finalNumber,
                   //'diagnostic_dsgn'=> $diagnostic_dsgn,
                  'diagnostic_mbrTyp' => $diagnostic_mmbrTyp,
                   'diagnostic_countryId' => $diagnostic_countryId,
                   'diagnostic_stateId' => $diagnostic_stateId,
                   'diagnostic_cityId' => $diagnostic_cityId,
                    'diagnostic_mblNo' => $diagnostic_mblNo,
                    'diagnostic_zip' => $diagnostic_zip,   
                   'diagnostic_img' => $imagesname,
                   'creationTime' => strtotime(date("Y-m-d H:i:s")),
                   'diagnostic_mblNo' => $diagnostic_mblNo,
                    'diagnostic_lat' => $this->input->post('lat'),
                    'diagnostic_long' => $this->input->post('lng')
                );
                  // print_r($insertData);exit;
                  $diagnosticId = $this->diagnostic_model->insertDiagnostic($insertData);
                  
                   }
                  $this->session->set_flashdata('message','Data inserted successfully !');
                  redirect('diagnostic/addDiagnostic');
               }
               
            }
         
      
       // print_r($imageUrl);exit;
    }
    
      
   

