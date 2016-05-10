<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Healthcare extends MY_Controller {

     public function __construct() {
       parent:: __construct();
       $this->load->library('form_validation');
       $this->load->model('Healthcare_model');
       $this->load->library('datatables');
       $this->load->helper('common_helper');
   }
   function index(){

       $data = array();
      // $data['healthcareData'] = $this->Healthcare_model->fetchHealthcareData();
      // echo 'test'; exit;
       //print_r($data['pharmacyData']);
       //exit;
        $data['allCities'] = $this->Healthcare_model->fetchCity();
       // print_r($data);exit;
       // $this->load->view('pharmacyListing',$data);
        $data['title'] = 'Healthcare Packages';

        $this->load->super_admin_template('listHealthpkg', $data, 'scriptHealthpkg');
   }
   
   function getBookingHealthPkgDl(){
       
        echo $this->Healthcare_model->fetchBookingHealthpkgDataTables();
   }
   
    function getHealthPkgDl(){

       
        echo $this->Healthcare_model->fetchHealthpkgDataTables();
 
   }
   function addHealthpkg(){
      
    $data = array();
        $data['allCities'] = $this->Healthcare_model->fetchCity();
        $data['title'] = 'Add Healthpkg';
        $this->load->super_admin_template('addHealthpkg', $data,'scriptHealthpkg');
       //$this->load->view('addPharmacy',$data);
   }
   function detailHealthpkg($healthPackage_id=''){
       $data = array();
       // echo $healthPackage_id; exit;
        $data['healthcareData'] = $this->Healthcare_model->fetchHealthcareData($healthPackage_id);
        $data['healthPackage_id'] = $healthPackage_id;
        $data['title'] = 'Health Package Detail';
        $this->load->super_admin_template('detailHealthpkg', $data,'scriptHealthpkg');
   }
   function editHealthpkg($healthPackage_id=''){
   
    $data = array();
    $data['editHealthcareData'] = $this->Healthcare_model->fetchHealthcareData($healthPackage_id);
  //print_r($data['editHealthcareData']); exit;
    $data['healthPackage_id'] = $healthPackage_id;
    if($data['editHealthcareData'][0]->miType == "Hospital"){
      $data['miData'] = $this->Healthcare_model->fetchHospital($data['editHealthcareData'][0]->cityId);
    }else{
       $data['miData'] = $this->Healthcare_model->fetchDiagnostic($data['editHealthcareData'][0]->cityId);
    }
    $data['allCities'] = $this->Healthcare_model->fetchCity();
    $data['title'] = 'Edit Healthpkg';
    $this->load->super_admin_template('editHealthpkg', $data,'scriptHealthpkg');
   }
   
   function fetchCity(){
       //echo "fdadas";exit;
        $stateId = $this->input->post('stateId');
        $cityData = $this->Healthcare_model->fetchCity($stateId);
        $cityOption = '';
        $cityOption .='<option value=>Select Your City</option>';
        foreach($cityData as $key=>$val ) {
            $cityOption .= '<option value='.$val->city_id.'>'. strtoupper($val->city_name).'</option>';
        }
       echo $cityOption;
        exit;
    }
    
    function fetchHospital(){
        $cityId = $this->input->post('cityId');
        $hosData = $this->Healthcare_model->fetchHospital($cityId);
        $hosOption = '';
        $hosOption .='<option value=>Select Hospital</option>';
        if(!empty($hosData)){
            foreach($hosData as $key=>$val ) {
                $hosOption .= '<option value='.$val->miId.'>'. strtoupper($val->miName).'</option>';
            }
        }
       echo $hosOption;
        exit;
    }
    
     function fetchDiagno(){
        //echo "fdadas";exit;
        $cityId = $this->input->post('cityId');
        $diagnoData = $this->Healthcare_model->fetchDiagnostic($cityId);
        $diOption = '';
        $diOption .='<option value=>Select Diagnostic</option>';
        if(!empty($diagnoData)){
            foreach($diagnoData as $key=>$val ) {
                $diOption .= '<option value='.$val->miId.'>'. strtoupper($val->miName).'</option>';
            }
        }
       echo $diOption;
        exit;
    }
    
  function SaveHealthcare(){
     // print_r($_POST);exit;
      $this->load->library('form_validation');
      $this->bf_form_validation->set_rules('miType', 'Mi Type', 'xss_clean|required|trim');
      $this->bf_form_validation->set_rules('city', 'Health Package City', 'xss_clean|required|trim');
      $this->bf_form_validation->set_rules('miName','Mi Name', 'xss_clean|required|trim');
       
      $this->bf_form_validation->set_rules('packagetitle','Package Title','xss_clean|required|trim');
   
      $this->bf_form_validation->set_rules('bestPrice', 'Best Price', 'xss_clean|required|trim');
      //$this->bf_form_validation->set_rules('discountPrice','Discount Price','required|xss_clean|trim');
      $this->bf_form_validation->set_rules('discountPercent','Discount Percent','required|xss_clean|trim|max_length[3]|min_length[1]');
      
      $this->bf_form_validation->set_rules('testIncluded[]','Healthpackage Test','xss_clean|required|trim');
       
      
    //  $this->bf_form_validation->set_rules('testIncluded','Test Includes','required|xss_clean|trim');
       
      if ($this->bf_form_validation->run() === FALSE) {
          // echo validation_errors(); exit;
            $data = array();
            $data['allCities'] = $this->Healthcare_model->fetchCity();
            $cityId = $this->input->post('city');
            $mitype = $this->input->post('miType');
            if($mitype == "Hospital"){
                $data['miData'] = $this->Healthcare_model->fetchHospital($cityId);
              }elseif($mitype == "Diagnostic"){
                 $data['miData'] = $this->Healthcare_model->fetchDiagnostic($cityId);
              }
            $data['title'] = 'Add Healthpkg';
            $this->load->super_admin_template('addHealthpkg', $data, 'scriptHealthpkg');
      }
      else {
              //$packageId = $this->input->post('packageId');
              $miType = $this->input->post('miType');
              $packagetitle = $this->input->post('packagetitle');
              $bestPrice = $this->input->post('bestPrice');
              $discountPrice = $this->input->post('discountPrice');
              $discountPercent = $this->input->post('discountPercent');
              $city = $this->input->post('city');
              $miName=$this->input->post('miName');
              $testIncluded=implode('|',$this->input->post('testIncluded'));
              $insertData = array(
                     //'healthPackage_packageId'=> $packageId,
                     'healthPackage_packageTitle' => $packagetitle,
                     'healthPackage_bestPrice' => $bestPrice,
                     'healthPackage_discountedPrice'=> $discountPrice,
                     'healthPackage_discountedPercent'=> $discountPercent,
                     'healthPackage_cityId'=>$city,
                     'healthPackage_MIuserId'=>$miName,
                     'healthPackage_includesTest'=>$testIncluded,
                     'status'=>0,
                     'creationTime' => strtotime(date("Y-m-d H:i:s"))
                    );
                   
               
                     $insertId = $this->Healthcare_model->insertHealthpkg($insertData,$miType);
                     if($insertId){
                       $this->session->set_flashdata('message','Data inserted successfully !');
                     }else{
                      $this->session->set_flashdata('message','Data insertion unsuccessful !');
                     }
                   redirect('healthcare');
         }
  }  
  function saveEditHealthcare($healthPackage_id){
     //echo($healthPackage_id);exit;
      $this->load->library('form_validation');
      $this->bf_form_validation->set_rules('miType', 'Mi Type', 'xss_clean|required|trim');
      $this->bf_form_validation->set_rules('city', 'Health Package City', 'xss_clean|required|trim');
      $this->bf_form_validation->set_rules('miName','Mi Name', 'xss_clean|required|trim');
       
     // $this->bf_form_validation->set_rules('packageId','Package Id','xss_clean|required|trim');
      $this->bf_form_validation->set_rules('packagetitle','Package Title','xss_clean|required|trim');
   
      $this->bf_form_validation->set_rules('bestPrice', 'Best Price', 'xss_clean|required|trim');
      $this->bf_form_validation->set_rules('discountPrice','Discount Price','required|xss_clean|trim');
      $this->bf_form_validation->set_rules('discountPercent','Discount Percent','required|xss_clean|trim|max_length[100]|min_length[1]');
      
       //$this->bf_form_validation->set_rules('testIncluded','Test Includes','required|xss_clean|trim');
      if ($this->bf_form_validation->run() === FALSE) {
      $data = array();
     // echo validation_errors(); exit;
      $data['editHealthcareData'] = $this->Healthcare_model->fetchHealthcareData($healthPackage_id);
     $data['healthPackage_id'] = $healthPackage_id;
     $data['allCities'] = $this->Healthcare_model->fetchCity();
     $data['title'] = 'Edit Healthpkg';
     $this->load->super_admin_template('editHealthpkg', $data,'scriptHealthpkg');
     }
     else {
              $packagetitle = $this->input->post('packagetitle');
              $bestPrice = $this->input->post('bestPrice');
              $discountPrice = $this->input->post('discountPrice');
              $discountPercent = $this->input->post('discountPercent');
              $city = $this->input->post('city');
              $miName=$this->input->post('miName');
              $testIncluded=implode('|',$this->input->post('testIncluded'));
              $updateData = array(
              'healthPackage_packageTitle' => $packagetitle,
              'healthPackage_bestPrice' => $bestPrice,
              'healthPackage_discountedPrice'=> $discountPrice,
              'healthPackage_discountedPercent'=> $discountPercent,
              'healthPackage_cityId'=>$city,
              'healthPackage_MIuserId'=>$miName,
              'healthPackage_includesTest'=>rtrim($testIncluded,"|"),
             // 'status'=>1,
              'creationTime' => strtotime(date("Y-m-d H:i:s"))
              );
                      //print_r($insertData);
                      //exit;
              $where = array(
              'healthPackage_id' => $healthPackage_id
              );
              $response = '';
            
              $response = $this->Healthcare_model->UpdateTableData($updateData,$where, 'qyura_healthPackage');
                if ($response) {
                $this->session->set_flashdata('message', 'Data updated successfully !');
//                redirect("healthcare/editHealthpkg/$healthPackage_id");
                 redirect("healthcare");
                }
            }
  }  
    function check_pkgId(){
        $user_table_id = '';
        $packageId = $this->input->post('packageId');
        if($packageId != ''){
          $pkg = $this->Healthcare_model->fetchPackgid($packageId);
        }
        echo $pkg;
        exit;
    }
    
    
   function bookingHealthpkgList(){
    $data = array();
    $data['allCities'] = $this->Healthcare_model->fetchCity();
    $data['title'] = 'Booking Healthpkg List';
    $this->load->super_admin_template('bookingHealthpkgList', $data,'scriptHealthpkg');
   }
   
   function bookingDetailHealthpkg($healthPkgBooking_id=''){
       $data = array();
     //  echo $healthPkgBooking_id;exit;
        $data['bookinghealthcareData'] = $this->Healthcare_model->fetchHealthcarebookingData($healthPkgBooking_id);
        if(empty($data['bookinghealthcareData'])){
                $this->session->set_flashdata('message','No record found for this id!');
                redirect('healthcare/bookingHealthpkgList');
        }
        $data['healthPkgBooking_id'] = $healthPkgBooking_id;
        $data['showStatus'] = 'none';
        $data['detailShow'] = 'block';
        $data['title'] = 'Health Package Booking Detail';
        $this->load->super_admin_template('bookingDetailHealthpkg', $data,'scriptHealthpkg');
   }
   
   function createCSV(){
       
        $mi ='';
        $helathpkg_cityId ='';
       if(isset($_POST['mi']))
        $mi = $this->input->post('mi');
      // if(isset($_POST['diagnostic_cityId']))
       $helathpkg_cityId = $this->input->post('helathpkg_cityId');
       
        $where=array('healthPackage_deleted'=> 0,'IFNULL(hospital_cityId,diagnostic_cityId)'=> $helathpkg_cityId);
       // $or_where = array(['hospital_name'=>$mi, 'diagnostic_name' => $mi]);
        $or_where = array('hospital_name' =>  $mi,  'diagnostic_name' => $mi);
        $array[]= array('Mi Name','Package id','title','Pricing','Status');
        $data = $this->Healthcare_model->createCSVdata($where,$or_where);
        $arrayFinal = array_merge($array,$data);
       
        array_to_csv($arrayFinal,'HealtpkgDetail.csv');
        return True;
        exit;
    }
    
    
    function createCSVForBookPkg(){
       
        
       if(isset($_POST['mi']))
        $mi = $this->input->post('mi');
       
       if(isset($_POST['helathpkg_cityId']))
       $helathpkg_cityId = $this->input->post('helathpkg_cityId');
       
       $or_like = array();
       if($mi != ''){
         $or_like = array('hospital_name' => $mi, 'diagnostic_name' => $mi);
       }
       
       $or_where = array();
       if($helathpkg_cityId){
           $or_where = array('IFNULL(hospital_cityId,diagnostic_cityId)' => $helathpkg_cityId);
       }
        $array[]= array('Mi Name','Booking id','title','Booked by','Price');
        $data = $this->Healthcare_model->createCSVForBookPkg($or_like,$or_where);
        $arrayFinal = array_merge($array,$data);
       
        array_to_csv($arrayFinal,'HealtpkgDetail.csv');
        return True;
        exit;
    }
    
    


}  