<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pharmacy extends MY_Controller {

     public function __construct() {
       parent:: __construct();
       $this->load->library('form_validation');
       $this->load->model('Pharmacy_model');
       $this->load->library('datatables');
   }
   function index(){
        $data = array();
       $data['allStates'] = $this->Pharmacy_model->fetchStates();
       $data['pharmacyData'] = $this->Pharmacy_model->fetchpharmacyData();
       //print_r($data['pharmacyData']);
       //exit;
       
       // $this->load->view('pharmacyListing',$data);
        $data['title'] = 'All Pharmacy';
        $this->load->super_admin_template('pharmacyListing', $data,'pharmacy_script');
   }
    function getPharmacyDl(){

       
        echo $this->Pharmacy_model->fetchPharmacyDataTables();
 
   }
   function addPharmacy(){
   	$data = array();
        $data['allStates'] = $this->Pharmacy_model->fetchStates();
        $data['title'] = 'Add Pharmacy';
        $this->load->super_admin_template('addPharmacy', $data,'pharmacy_script');
       //$this->load->view('addPharmacy',$data);
   }
   function detailPharmacy($pharmacyId=''){
       $data = array();
        $data['pharmacyData'] = $this->Pharmacy_model->fetchpharmacyData($pharmacyId);
        $data['pharmacyId'] = $pharmacyId;
        $data['showStatus'] = 'none';
        $data['detailShow'] = 'block';
        $data['title'] = 'Pharmacy Detail';
      //  $this->load->view('pharmacyDetail',$data);
        $this->load->super_admin_template('pharmacyDetail', $data,'pharmacy_script');
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
        $this->bf_form_validation->set_rules('pharmacy_name', 'Pharmacy Name', 'required|trim');
      
        $this->bf_form_validation->set_rules('pharmacy_countryId', 'Pharmacy Country', 'required|trim');
        $this->bf_form_validation->set_rules('pharmacy_stateId', 'Pharmacy StateId', 'required|trim');
        $this->bf_form_validation->set_rules('pharmacy_cityId', 'Pharmacy City', 'required|trim');
        
        //$this->bf_form_validation->set_rules('pharmacy_phn[]', 'Pharmacy Mobile No', 'required|trim');
       $this->bf_form_validation->set_rules('pharmacy_zip','Pharmacy Zip', 'required|trim');
       $this->bf_form_validation->set_rules('pharmacy_address','Pharmacy Address','required|trim');
       $this->bf_form_validation->set_rules('pharmacy_address','Pharmacy Address','required|trim');
   
        $this->bf_form_validation->set_rules('pharmacy_mmbrTyp', 'Membership Type', 'required|trim');
      $this->bf_form_validation->set_rules('users_email','Users Email','required|valid_email|trim');
       
        if ($this->bf_form_validation->run() === FALSE) {
          //echo validation_errors();
          //exit;
             $data = array();
             $data['allStates'] = $this->Pharmacy_model->fetchStates();
             $this->load->super_admin_template('addPharmacy', $data,'pharmacy_script');
         }
         else {
             
           $imagesname = "";
            if ($_FILES['avatar_file']['name']) {
                $path = realpath(FCPATH . 'assets/pharmacyImages/');
                $upload_data = $this->input->post('avatar_data');
                $upload_data = json_decode($upload_data);
                $original_imagesname = $this->uploadImageWithThumb($upload_data, 'avatar_file', $path, 'assets/pharmacyImages/', './assets/pharmacyImages/thumb/','pharmacy');

                if (empty($original_imagesname)) {
                    $data['allStates'] = $this->Pharmacy_model->fetchStates();
                    $this->session->set_flashdata('valid_upload', $this->error_message);
                    $this->load->super_admin_template('addPharmacy', $data, 'pharmacy_script');
                    return false;
                } else {
                    $imagesname = $original_imagesname;
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
        
        $this->bf_form_validation->set_rules('pharmacy_name', 'Pharmacy Name', 'required|trim');
      
        $this->bf_form_validation->set_rules('pharmacy_address', 'Pharmacy Address', 'required|trim');
        $this->bf_form_validation->set_rules('users_email','Users Email','required|valid_email|trim');
        $this->bf_form_validation->set_rules('pharmacy_cntPrsn', 'Pharmacy Contact Person', 'required|trim');
        if ($this->bf_form_validation->run() === FALSE) {
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
    
    
               /**
     * @project Qyura
     * @method editUploadImage
     * @description update details page image profile
     * @access public
     * @return boolean
     */
    function editUploadImage() {

        if ($_POST['avatar_file']['name']) {
            $path = realpath(FCPATH . 'assets/pharmacyImages/');
            $upload_data = $this->input->post('avatar_data');
            $upload_data = json_decode($upload_data);

            $original_imagesname = $this->uploadImageWithThumb($upload_data, 'avatar_file', $path, 'assets/pharmacyImages/', './assets/pharmacyImages/thumb/','pharmacy');

            if (empty($original_imagesname)) {
                $response = array('state' => 400, 'message' => $this->error_message);
            } else {

                $option = array(
                    'pharmacy_img' => $original_imagesname,
                    'modifyTime' => strtotime(date("Y-m-d H:i:s"))
                );
                $where = array(
                    'pharmacy_id' => $this->input->post('avatar_id')
                );
                $response = $this->Pharmacy_model->UpdateTableData($option, $where, 'qyura_pharmacy');
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
             $data['pharmacyData'] = $this->Pharmacy_model->fetchpharmacyData($id);
           //  print_r($data); exit;
            echo "<img src='" . base_url() . "assets/pharmacyImages/" . $data['pharmacyData'][0]->pharmacy_img . "'alt='' class='logo-img' />";
            exit();
        }
    }
    
     function createCSV(){
       $pharmacy_stateId = $this->input->post('pharmacy_stateId');
       $pharmacy_cityId = $this->input->post('pharmacy_cityId');
      
       if($pharmacy_stateId != '' && $pharmacy_stateId != null)
        $pharmacy_stateId = $this->input->post('pharmacy_stateId');
       if($pharmacy_cityId != '' && $pharmacy_cityId != null)
        $pharmacy_cityId = $this->input->post('pharmacy_cityId');
       
        $where=array('pharmacy_deleted'=> 0,'pharmacy_cityId'=> $pharmacy_cityId,'pharmacy_stateId'=>$pharmacy_stateId);
       // print_r($where); exit;
        $array[]= array('Image Name','Pharmacy Name','City','Phone Number','Address');
        $data = $this->Pharmacy_model->createCSVdata($where);
       
        $arrayFinal = array_merge($array,$data);
       
        array_to_csv($arrayFinal,'PharmacyDetail.csv');
        return True;
        exit;
    }
    
}  