<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Hospital extends MY_Controller {
    
   public function __construct() {
       parent:: __construct();
       $this->load->model('Hospital_model');
        $this->load->library('datatables');
   }
   
  function index(){
        $data = array();
        $data['allStates'] = $this->Hospital_model->fetchStates();
        $data['hospitalData'] = $this->Hospital_model->fetchHospitalData();
      
        $data['hospitalId'] = 0;
        $this->load->super_admin_template('HospitalListing', $data, 'hospitalScript');
   }
      function getHospitalDl(){

       
        echo $this->Hospital_model->fetchHospitalDataTables();
 
   }
   function addHospital(){
       $data = array();
       $data['allStates'] = $this->Hospital_model->fetchStates();
       $this->load->super_admin_template('AddHospital', $data, 'hospitalScript');
   }
   function detailHospital($hospitalId=''){
       $data = array();
      // echo $hospitalId;exit;
        $data['hospitalData'] = $this->Hospital_model->fetchHospitalData($hospitalId);
       // print_r($data);exit;
        $data['allCountry'] = $this->Hospital_model->fetchCountry();
        $data['hospitalId'] = $hospitalId;
        $data['showStatus'] = 'none';
        $data['detailShow'] = 'block';
        $insurance_condition = '';
        $data['insurance']  = $this->Hospital_model->fetchInsurance($hospitalId);
        $data['gallerys'] = $this->Hospital_model->customGet(array('table'=>'qyura_hospitalImages','where'=>array('hospitalImages_hospitalId'=>$hospitalId,'hospitalImages_deleted'=>0)));
        if(!empty($data['insurance'])){
            foreach ($data['insurance'] as $key => $val){
               $insurance_condition[]= $val->hospitalInsurance_insuranceId;
            }
        }
    
        $data['allInsurance']  = $this->Hospital_model->fetchAllInsurance($insurance_condition);
        //print_r($data['allInsurance']);
       // exit;
        
       // $this->load->super_admin_template('hospitalDetail', $data, 'bloodBankScript');
        //$this->load->view('hospitalDetail',$data);
        $this->load->super_admin_template('hospitalDetail', $data, 'hospitalScript');
   }
   function hospitalAwards($hospitalId){
      $dataAwards = $this->Hospital_model->fetchAwards($hospitalId);
      $showAwards = '';
      if($dataAwards){
        foreach($dataAwards as $key=>$val){
            $showAwards .='<li>'.$val->hospitalAwards_awardsName.'</li>';

        }
      }
    else {
            $showAwards = 'Add Awards';
         }
       echo $showAwards;
       exit;
   }
   function hospitalServices($hospitalId){
       $dataAwardsServices = $this->Hospital_model->fetchServices($hospitalId);
      $showServices = '';
      if($dataAwardsServices){
        foreach($dataAwardsServices as $key=>$val){
            $showServices .='<li>'.$val->hospitalServices_serviceName.'</li>';

        }
      }
    else {
            $showServices = 'Add Service';
         }
       echo $showServices;
       exit;
   }
   function detailAwards($hospitalId){
       $dataAwards = $this->Hospital_model->fetchAwards($hospitalId);
       if($dataAwards){
           $showTotalAwards = '';
        foreach($dataAwards as $key=>$val){
       $showTotalAwards .= '<div class="row m-t-10">
        <div class="col-md-8 col-sm-8 col-xs-8">
           <input type="text" class="form-control" name="hospitalAwards_awardsName" id='.$val->hospitalAwards_id.' value='.$val->hospitalAwards_awardsName.' placeholder="FICCI Healthcare " />
         </div>
           <div class="col-md-2 col-sm-2 col-xs-2">
            <a onclick="editAwards('.$val->hospitalAwards_id.')"><i class="fa fa-pencil-square-o fa-2x m-t-5 label-plus" title="Edit Awards"></i></a>
           </div>

          <div class="col-md-2 col-sm-2 col-xs-2">
          <a onclick="deleteAwards('.$val->hospitalAwards_id.')"><i class="fa fa-times fa-2x m-t-5 label-plus" title="Delete Awards"></i></a>
          </div>
         </div>';
         }
         
      }
    else {
            $showTotalAwards = 'Add Awards';
         }
         
         echo $showTotalAwards;
         exit;
   }
   function detailServices($hospitalId){
        $dataServices = $this->Hospital_model->fetchServices($hospitalId);
       if($dataServices){
           $showTotalService = '';
        foreach($dataServices as $key=>$val){
       $showTotalService .= '<div class="row m-t-10">
        <div class="col-md-8 col-sm-8 col-xs-8">
           <input type="text" class="form-control" name="hospitalServices_serviceName" id='.$val->hospitalServices_id.' value='.$val->hospitalServices_serviceName.' placeholder="Service Name" />
         </div>
           <div class="col-md-2 col-sm-2 col-xs-2">
            <a onclick="editServices('.$val->hospitalServices_id.')"><i class="fa fa-pencil-square-o fa-2x m-t-5 label-plus" title="Edit Services"></i></a>
           </div>

          <div class="col-md-2 col-sm-2 col-xs-2">
          <a onclick="deleteServices('.$val->hospitalServices_id.')"><i class="fa fa-times fa-2x m-t-5 label-plus" title="Delete Services"></i></a>
          </div>
         </div>';
         }
         
      }
    else {
            $showTotalService = 'Add Services';
         }
         
         echo $showTotalService;
         exit;
   }
   function addHospitalAwards(){
       $hospitalId = $this->input->post('hospitalId');
       $hospitalAwards_awardsName = $this->input->post('hospitalAwards_awardsName');
       $awardData = array('hospitalAwards_awardsName'=>$hospitalAwards_awardsName,'hospitalAwards_hospitalId' => $hospitalId);
       $return = $this->Hospital_model->insertTableData('qyura_hospitalAwards',$awardData);
       echo $return;
       exit;
   }
   
   function addHospitalService(){
       $hospitalId = $this->input->post('hospitalId');
       $hospitalServices_serviceName = $this->input->post('hospitalServices_serviceName');
       $serviceData = array('hospitalServices_serviceName'=>$hospitalServices_serviceName,'hospitalServices_hospitalId' => $hospitalId);
       $return = $this->Hospital_model->insertTableData('qyura_hospitalServices',$serviceData);
       echo $return;
       exit;
   }
   function editHospitalAwards(){
       $hospitalAwards_id = $this->input->post('awardsId');
       $hospitalAwards_awardsName = $this->input->post('hospitalAwards_awardsName');
       $updatedData = array('hospitalAwards_awardsName'=>$hospitalAwards_awardsName);
       $updatedDataWhere = array('hospitalAwards_id'=>$hospitalAwards_id);
       $return = $this->Hospital_model->UpdateTableData($updatedData,$updatedDataWhere,'qyura_hospitalAwards');
       echo $return ;
       exit;
   }
  
   function editHospitalService(){
       $hospitalServices_id = $this->input->post('serviceId');
       $hospitalServices_serviceName = $this->input->post('hospitalServices_serviceName');
       $updatedData = array('hospitalServices_serviceName'=>$hospitalServices_serviceName);
       $updatedDataWhere = array('hospitalServices_id'=>$hospitalServices_id);
       $return = $this->Hospital_model->UpdateTableData($updatedData,$updatedDataWhere,'qyura_hospitalServices');
       echo $return ;
       exit;
   }
   
   function deleteHospitalService(){
       $hospitalServices_id = $this->input->post('serviceId');
       $hospitalServices_serviceName = $this->input->post('hospitalServices_serviceName');
       $updatedData = array('	hospitalServices_deleted'=>1);
       $updatedDataWhere = array('hospitalServices_id'=>$hospitalServices_id);
       $return = $this->Hospital_model->UpdateTableData($updatedData,$updatedDataWhere,'qyura_hospitalServices');
       echo $return ;
       exit;
   }
   function deleteHospitalAwards(){
       $hospitalAwards_id = $this->input->post('awardsId');
       $updatedData = array('hospitalAwards_deleted' => 1);
       $updatedDataWhere = array('hospitalAwards_id' => $hospitalAwards_id);
       $return = $this->Hospital_model->UpdateTableData($updatedData,$updatedDataWhere,'qyura_hospitalAwards');
       echo $return ;
       exit;
   }
   function addInsurance(){
      $hospitalId = $this->input->post('hospitalInsuranceId');
      // echo $hospitalId;
       $insurances = $this->input->post('insurances');
     // print_r($insurances);
       if(!empty($insurances)){
           foreach($insurances as $key => $val){
               $insurancesData = array(
                  'hospitalInsurance_hospitalId' => $hospitalId ,
                  'hospitalInsurance_insuranceId' => $val
               );
              // print_r($insurancesData);
              // exit;
               $this->Hospital_model->insertTableData('qyura_hospitalInsurance',$insurancesData);
               //$insurancesData = '';
           }
             $this->session->set_flashdata('message','Insurance added successfully !');
             redirect("hospital/detailHospital/$hospitalId");
       }  else {
           redirect("hospital/detailHospital/$hospitalId");
       }
   }
   function fetchStates(){
      $stateId = $this->input->post('stateId');
      $countryId = $this->input->post('countryId');
     $statesdata = $this->Hospital_model->fetchStates($countryId);
     $statesOption = '';
      $statesOption .='<option value=>Select Your States</option>';
      foreach($statesdata as $key=>$val ) {
        if($val->state_id == $stateId)
           $statesOption .= '<option value='.$val->state_id.' selected >'. strtoupper($val->state_statename).'</option>';
         else
       $statesOption .= '<option value='.$val->state_id.'>'. strtoupper($val->state_statename).'</option>';
    }
    echo $statesOption;
    exit;
   }
   function fetchCityOnload()
   {
      $stateId = $this->input->post('stateId');
      $cityId = $this->input->post('cityId');
       $cityData = $this->Hospital_model->fetchCity($stateId);
       $cityOption = '';
        $cityOption .='<option value=>Select Your City</option>';
        foreach($cityData as $key=>$val ) {
          if($val->city_id == $cityId)
           $cityOption .= '<option value='.$val->city_id.' selected>'. strtoupper($val->city_name).'</option>';
           else
            $cityOption .= '<option value='.$val->city_id.'>'. strtoupper($val->city_name).'</option>';
        }
       echo $cityOption;
        exit;
   }
    function fetchCity (){
        $stateId = $this->input->post('stateId');
        $cityData = $this->Hospital_model->fetchCity($stateId);
        $cityOption = '';
        $cityOption .='<option value=>Select Your City</option>';
        foreach($cityData as $key=>$val ) {
            $cityOption .= '<option value='.$val->city_id.'>'. strtoupper($val->city_name).'</option>';
        }
       echo $cityOption;
        exit;
    }
    
    function SaveHospital(){
       
       $this->bf_form_validation->set_rules('hospital_name', 'Hospital Name', 'required|trim');
       $this->bf_form_validation->set_rules('hospital_type', 'Hospital Type', 'required|trim');
        $this->bf_form_validation->set_rules('hospital_address', 'Hospital Address', 'required|trim');
       $this->bf_form_validation->set_rules('hospital_cntPrsn', 'Contact Person', 'required|trim');
        $this->bf_form_validation->set_rules('hospital_mmbrTyp', 'Membership Type', 'required|trim');
        
        $this->bf_form_validation->set_rules('hospital_countryId', 'Hospital Country', 'required|trim');
        $this->bf_form_validation->set_rules('hospital_stateId', 'Hospital StateId', 'required|trim');
        $this->bf_form_validation->set_rules('hospital_cityId', 'hospital City', 'required|trim');
        
        $this->bf_form_validation->set_rules('hospital_mblNo', 'Hospital Mobile No', 'required|trim');
       $this->bf_form_validation->set_rules('hospital_zip','Hospital Zip', 'required|trim');
       $this->bf_form_validation->set_rules('hospital_dsgn','Hospital Designation','required|trim');
       $this->bf_form_validation->set_rules('users_email','Users Email','required|valid_email|trim');
       $this->bf_form_validation->set_rules('users_password', 'Password', 'trim|required|matches[cnfPassword]');
        $this->bf_form_validation->set_rules('cnfPassword', 'Password Confirmation', 'trim|required');
       
       // $this->bf_form_validation->set_rules('hospital_mmbrTyp', 'Membership Type', 'required|xss_clean|trim');
       // if (empty($_FILES['hospital_img']['name']))
        // {
           //  $this->bf_form_validation->set_rules('hospital_img', 'File', 'required');
      //  }
         if ($this->bf_form_validation->run() === FALSE) {
             $data = array();
             $data['allStates'] = $this->Hospital_model->fetchStates();
             $this->load->super_admin_template('AddHospital', $data, 'hospitalScript');
         }
         else {
        
             $imagesname = "";
            if ($_FILES['avatar_file']['name']) {
                $path = realpath(FCPATH . 'assets/hospitalsImages/');
                $upload_data = $this->input->post('avatar_data');
                $upload_data = json_decode($upload_data);
                $original_imagesname = $this->uploadImageWithThumb($upload_data, 'avatar_file', $path, 'assets/hospitalsImages/', './assets/hospitalsImages/thumb/','hospital');

                if (empty($original_imagesname)) {
                    $data['allStates'] = $this->Bloodbank_model->fetchStates();
                    $this->session->set_flashdata('valid_upload', $this->error_message);
                    $this->load->super_admin_template('AddHospital', $data, 'hospitalScript');
                    return false;
                } else {
                    $imagesname = $original_imagesname;
                }
                 }
              
             
          
                $hospital_phn = $this->input->post('hospital_phn');
                $pre_number = $this->input->post('pre_number');
                 $countPnone = $this->input->post('countPnone');
                 
                  $finalNumber = '';
                for($i= 0;$i < $countPnone ;$i++) {
                    if($hospital_phn[$i] != '' && $pre_number[$i] !='') {
                       $finalNumber .= $pre_number[$i].' '.$hospital_phn[$i].'|'; 
                    }
                    
                }
                
                $hospital_name = $this->input->post('hospital_name');
                $hospital_type = $this->input->post('hospital_type');
                $hospital_address = $this->input->post('hospital_address');
                 $hospital_phn = $this->input->post('hospital_phn');
                $hospital_cntPrsn = $this->input->post('hospital_cntPrsn');
                $hospital_dsgn = $this->input->post('hospital_dsgn');
                $hospital_mmbrTyp = $this->input->post('hospital_mmbrTyp');
                 $hospital_countryId = $this->input->post('hospital_countryId');
                $hospital_stateId = $this->input->post('hospital_stateId');
                $hospital_cityId = $this->input->post('hospital_cityId');
                $hospital_mblNo = $this->input->post('hospital_mblNo');
                $hospital_aboutUs = $this->input->post('hospital_aboutUs');
                $isEmergency =0;
                if(isset($_POST['isEmergency']))
                   $isEmergency  = $_POST['isEmergency'];
                $inserData = array(
                  'hospital_name'=> $hospital_name,
                   'hospital_type' => $hospital_type, 
                   'hospital_address' => $hospital_address, 
                   'hospital_phn' => $finalNumber,
                   'hospital_cntPrsn'=> $hospital_cntPrsn,
                   'hospital_dsgn' => $hospital_dsgn,
                   'hospital_mmbrTyp' => $hospital_mmbrTyp,
                   'hospital_countryId' => $hospital_countryId,
                   'hospital_stateId' => $hospital_stateId,
                   'hospital_cityId' => $hospital_cityId,
                    'hospital_aboutUs' => $hospital_aboutUs,
                   'hospital_img' => $imagesname,
                   'creationTime' => strtotime(date("Y-m-d H:i:s")),
                   'hospital_mblNo' => $hospital_mblNo,
                    'hospital_lat' => $this->input->post('lat'),
                    'hospital_long' => $this->input->post('lng'),
                    'isEmergency' => $isEmergency
                );
                
                $users_email = $this->input->post('users_email');
                $users_password = md5($this->input->post('users_password'));
                $hospitalInsert = array(
                   'users_email' => $users_email,
                    'users_password'=> $users_password,
                   'users_ip_address' => $this->input->ip_address(),
                   'users_mobile'=> $this->input->post('hospital_mblNo'),
                );
              
                 
               $hospital_usersId = $this->Hospital_model->inserHospitalUser($hospitalInsert);
               if($hospital_usersId) {
                   
                   $inserData['hospital_usersId'] = $hospital_usersId;
                  $hospitalId = $this->Hospital_model->insertHospital($inserData);
                  $insertusersRoles = array(
                      'usersRoles_userId' => $hospital_usersId,
                      'usersRoles_roleId' => 1,
                      'usersRoles_parentId' => 0,
                      'creationTime' => strtotime(date("Y-m-d H:i:s"))
                  );
                  $this->Hospital_model->insertUsersRoles($insertusersRoles);
                  unset($insertusersRoles);
                   if(isset($_POST['hospitalServices_serviceName']))
                   {
                        $finalNumber = '';
                       $countserviceName = $_POST['serviceName'];
                       $hospitalServices_serviceName = $_POST['hospitalServices_serviceName'];
                        for($i= 0;$i < $countserviceName ;$i++) {
                            if($hospitalServices_serviceName[$i] != '') {
                               $finalhospitalServices_serviceName = $hospitalServices_serviceName[$i]; 
                               $hospitalServicesData = array(
                                 'hospitalServices_hospitalId'=> $hospitalId,
                                 'hospitalServices_serviceName'=> $finalhospitalServices_serviceName,
                                  'hospitalServices_deleted' => 0, 
                                 'creationTime' => strtotime(date("Y-m-d H:i:s"))  
                               );
                               $this->Hospital_model->insertHospitalServiceName($hospitalServicesData);
                            }
                            $hospitalServicesData = '';
                        }  
                   }
                  if($_POST['bloodbank_chk']==1){
                      
                       $bloodBank_phn = $this->input->post('bloodBank_phn');
                        $preblbankNo = $this->input->post('preblbankNo');
                         $countbloodBank_phn = $this->input->post('countbloodBank_phn');

                          $finalBloodbnkNumber = '';
                        for($i= 0;$i < $countbloodBank_phn ;$i++) {
                            if($bloodBank_phn[$i] != '' && $pre_number[$i] !='') {
                               $finalBloodbnkNumber .= $preblbankNo[$i].' '.$bloodBank_phn[$i].'|'; 
                            }

                        }
                        $imageBloodbnkName = '';
                         if ($_FILES['bloodBank_photo']['name'] ) {
                              $tempblood = explode(".", $_FILES["bloodBank_photo"]["name"]);
                               $newfilenameblood = 'Blood_'.round(microtime(true)) . '.' . end($tempblood);
                             $status = $this->uploadImages('bloodBank_photo','BloodBank',$newfilenameblood);
                             if($status == TRUE)
                                 $imageBloodbnkName = $newfilenameblood;
                         }
                       $bloodBank_name = $this->input->post('bloodBank_name');
                       $bloodBank_photo = $this->input->post('bloodBank_photo');
                       $bloodBank_lat = $this->input->post('lat');
                       $bloodBank_long =$this->input->post('lng');
                       
                       $bloodBankDetail = array(
                           'bloodBank_name' => $bloodBank_name,
                           'bloodBank_photo' => $imageBloodbnkName,
                           'bloodBank_lat' => $bloodBank_lat,
                           'bloodBank_long' => $bloodBank_long,
                           'users_id' => $hospital_usersId,
                           'creationTime' => strtotime(date("Y-m-d H:i:s")),
                           'bloodBank_phn' => $finalBloodbnkNumber,
                           'countryId' => $hospital_countryId,
                            'stateId' => $hospital_stateId,
                            'cityId' => $hospital_cityId,
                           'bloodBank_add' => $hospital_address,
                           'inherit_status' => 1
                       );
                      $bloodBankId = $this->Hospital_model->insertBloodbank($bloodBankDetail);
                      if($bloodBankId) {
                                $insertusersRoles = array(
                               'usersRoles_userId' => $bloodBankId,
                               'usersRoles_roleId' => 2,
                               'usersRoles_parentId' => $hospital_usersId,
                               'creationTime' => strtotime(date("Y-m-d H:i:s"))
                           );
                              
                           $this->Hospital_model->insertUsersRoles($insertusersRoles);
                         
                           unset($insertusersRoles);
                      }
                  }
                  
                   if($_POST['pharmacy_chk']==1){
                      
                       $pharmacy_phn = $this->input->post('pharmacy_phn');
                        $prePharmacy = $this->input->post('prePharmacy');
                         $countPharmacy_phn = $this->input->post('countPharmacy_phn');

                          $finalPharmacyNumber = '';
                        for($i= 0;$i < $countPharmacy_phn ;$i++) {
                            if($pharmacy_phn[$i] != '' && $prePharmacy[$i] !='') {
                               $finalPharmacyNumber .= $prePharmacy[$i].' '.$pharmacy_phn[$i].'|'; 
                            }

                        }
                        $imagePharmacyName = '';
                         if ($_FILES['pharmacy_img']['name'] ) {
                             $tempPharmacy = explode(".", $_FILES["pharmacy_img"]["name"]);
                               $newfilenamepharmacy_img = 'Pharmacy_'.round(microtime(true)) . '.' . end($tempPharmacy);
                             $status = $this->uploadImages('pharmacy_img','pharmacyImages',$newfilenamepharmacy_img);
                             
                             if($status == TRUE)
                                 $imagePharmacyName = $newfilenamepharmacy_img;
                         }
                       $pharmacy_name = $this->input->post('pharmacy_name');
                       $pharmacy_img = $this->input->post('pharmacy_img');
                       $pharmacy_lat = $this->input->post('lat');
                       $pharmacy_long =$this->input->post('lng');
                       
                       $pharmacyDetail = array(
                           'pharmacy_name' => $pharmacy_name,
                           'pharmacy_img' => $imagePharmacyName,
                           'pharmacy_lat' => $pharmacy_lat,
                           'pharmacy_long' => $pharmacy_long,
                           'pharmacy_usersId' => $hospital_usersId,
                           'creationTime' => strtotime(date("Y-m-d H:i:s")),
                           'pharmacy_phn' => $finalPharmacyNumber,
                            'pharmacy_countryId' => $hospital_countryId,
                            'pharmacy_stateId' => $hospital_stateId,
                            'pharmacy_cityId' => $hospital_cityId,
                            'pharmacy_address' => $hospital_address,
                            'inherit_status' => 1
                       );
                      $pharmacyId = $this->Hospital_model->insertPharmacy($pharmacyDetail);
                      
                       if($pharmacyId) {
                                $insertusersRoles2 = array(
                               'usersRoles_userId' => $pharmacyId,
                               'usersRoles_roleId' => 5,
                               'usersRoles_parentId' => $hospital_usersId,
                               'creationTime' => strtotime(date("Y-m-d H:i:s"))
                           );
                              
                           $this->Hospital_model->insertUsersRoles($insertusersRoles2);
                          
                           unset($insertusersRoles2);
                      }
                  }
                  
                  
                    if($_POST['ambulance_chk']==1){
                      
                       $ambulance_phn = $this->input->post('ambulance_phn');
                        $preAmbulance = $this->input->post('preAmbulance');
                         $countAmbulance_phn = $this->input->post('countAmbulance_phn');

                          $finalAmbulanceNumber = '';
                        for($i= 0;$i < $countAmbulance_phn ;$i++) {
                            if($ambulance_phn[$i] != '' && $preAmbulance[$i] !='') {
                               $finalAmbulanceNumber .= $preAmbulance[$i].' '.$ambulance_phn[$i].'|'; 
                            }

                        }
                        $imageAmbulanceName = '';
                         if ($_FILES['ambulance_img']['name'] ) {
                             $tempAmbulance = explode(".", $_FILES["ambulance_img"]["name"]);
                               $newfilenametempAmbulance = 'Ambulance_'.round(microtime(true)) . '.' . end($tempAmbulance);
                             $status = $this->uploadImages('ambulance_img','ambulanceImages',$newfilenametempAmbulance);
                             if($status == TRUE)
                                 $imageAmbulanceName = $newfilenametempAmbulance;
                         }
                       $ambulance_name = $this->input->post('ambulance_name');
                       $ambulance_img = $this->input->post('ambulance_img');
                       $ambulance_lat = $this->input->post('lat');
                       $ambulance_long =$this->input->post('lng');
                       
                       $ambulanceDetail = array(
                           'ambulance_name' => $ambulance_name,
                           'ambulance_img' => $imageAmbulanceName,
                           'ambulance_lat' => $ambulance_lat,
                           'ambulance_long' => $ambulance_long,
                           'ambulance_usersId' => $hospital_usersId,
                           'creationTime' => strtotime(date("Y-m-d H:i:s")),
                           'ambulance_phn' => $finalAmbulanceNumber,
                            'ambulance_countryId' => $hospital_countryId,
                            'ambulance_stateId' => $hospital_stateId,
                            'ambulance_cityId' => $hospital_cityId,
                           'ambulance_address' => $hospital_address,
                           'inherit_status' => 1
                       );
                      $ambulanceId = $this->Hospital_model->insertAmbulance($ambulanceDetail);
                      if($ambulanceId) {
                                $insertusersRoles3 = array(
                               'usersRoles_userId' => $ambulanceId,
                               'usersRoles_roleId' => 8,
                               'usersRoles_parentId' => $hospital_usersId,
                               'creationTime' => strtotime(date("Y-m-d H:i:s"))
                           );
                              
                           $this->Hospital_model->insertUsersRoles($insertusersRoles3);
                          
                           unset($insertusersRoles3);
                      }
                  }
                  $this->session->set_flashdata('message','Data inserted successfully !');
                  redirect('hospital/addHospital');
               }
               
            }
         
      
       // print_r($imageUrl);exit;
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
        $email = $this->Hospital_model->fetchEmail($users_email,$user_table_id);
        echo $email;
        exit;
    }
     function saveDetailHospital($hospitalId){
        
        $this->bf_form_validation->set_rules('hospital_name', 'Hospital Name', 'required|trim');
      
        $this->bf_form_validation->set_rules('hospital_address', 'Hospital Address', 'required|trim');
        //$this->bf_form_validation->set_rules('users_email','Users Email','required|valid_email|trim');
        $this->bf_form_validation->set_rules('hospital_cntPrsn', 'Hospital Contact Person', 'required|trim');
        $this->bf_form_validation->set_rules('hospital_dsgn', 'Hospital Contact Person', 'required|trim');
        if ($this->bf_form_validation->run($this) === FALSE) {
             $data = array();
             $data['hospitalData'] = $this->Hospital_model->fetchHospitalData($hospitalId);
               $data['hospitalId'] = $hospitalId;
               $data['showStatus'] = 'block';
               $data['detailShow'] = 'none';
                $data['insurance']  = $this->Hospital_model->fetchInsurance($hospitalId);
                if(!empty($data['insurance'])){
                    foreach ($data['insurance'] as $key => $val){
                       $insurance_condition[]= $val->hospitalInsurance_insuranceId;
                    }
                }
    
        $data['allInsurance']  = $this->Hospital_model->fetchAllInsurance($insurance_condition);
             $this->load->view('hospitalDetail',$data);
             return false;
             
         }
         else{
              $hospital_phn = $this->input->post('hospital_phn');
                $pre_number = $this->input->post('pre_number');
                 //$countPnone = $this->input->post('countPnone');
                 
                  $finalNumber = '';
                for($i= 0;$i < count($hospital_phn) ;$i++) {
                    if($hospital_phn[$i] != '' && $pre_number[$i] !='') {
                       $finalNumber .= $pre_number[$i].' '.$hospital_phn[$i].'|'; 
                    }
                } 
                $hospital_address =  $this->input->post('hospital_address');
                $hospital_lat = $this->input->post('lat'); 
                $hospital_long = $this->input->post('lng');
                $updateHospital = array(
                  'hospital_name'=>  $this->input->post('hospital_name'),
                  'hospital_type'=> $this->input->post('hospital_type'),
                  //'hospital_countryId'=> $this->input->post('hospital_countryId'),

                  //'hospital_stateId'=> $this->input->post('hospital_stateId'),
                  //'hospital_cityId'=> $this->input->post('hospital_cityId'),
                     'hospital_address' =>  $hospital_address,
                     'hospital_phn' => $finalNumber,
                      'hospital_cntPrsn'=> $this->input->post('hospital_cntPrsn'),
                     'hospital_dsgn'=> $this->input->post('hospital_dsgn'),
                     'isEmergency'=> $this->input->post('isEmergency'),
                     'hospital_lat'=> $hospital_lat, 
                    'hospital_long'=> $hospital_long,  
                    'modifyTime'=> strtotime(date("Y-m-d H:i:s")), 
                    'hospital_dsgn'=> $this->input->post('hospital_dsgn')
                );
                
                $where = array(
                    'hospital_id' => $hospitalId
                );
                $response = '';
               $response = $this->Hospital_model->UpdateTableData($updateHospital,$where,'qyura_hospital');
                  /* $updateUserdata = array(
                       'users_email' => $this->input->post('users_email'),
                      'modifyTime'=> strtotime(date("Y-m-d H:i:s"))  
                  );
                  $whereUser = array(
                    'users_id' => $this->input->post('user_tables_id')  
                  ); 
                 $response = $this->Hospital_model->UpdateTableData($updateUserdata,$whereUser,'qyura_users'); 
                   
                   */
                 if($response) {
                     if($_POST['bloodbank_chk']==1){
                      
                       $bloodBank_phn = $this->input->post('bloodBank_phn');
                        $preblbankNo = $this->input->post('preblbankNo');
                          $finalBloodbnkNumber = '';
                        for($i= 0;$i < count($preblbankNo) ;$i++) {
                            if(isset($bloodBank_phn[$i]) != '' && isset($preblbankNo[$i]) !='') {
                               $finalBloodbnkNumber .= $preblbankNo[$i].' '.$bloodBank_phn[$i].'|'; 
                            }

                        }
                      
                      $conditions = array();
                      $conditions['users_id'] = $this->input->post('user_tables_id');
                      $conditions['bloodBank_deleted'] = 0;
                      $select = array('bloodBank_id');
                      $getData = '';
                       $getData = $this->Hospital_model->fetchTableData($select,'qyura_bloodBank',$conditions);
                       
                       $bloodBankDetail = array(
                           'bloodBank_name' => $this->input->post('bloodBank_name'),
                           'bloodBank_lat' => $hospital_lat,
                           'bloodBank_long' => $hospital_long,
                           'bloodBank_add' => $hospital_address,
                           'bloodBank_phn' => $finalBloodbnkNumber,
                           'modifyTime' => strtotime(date("Y-m-d H:i:s"))
                           
                       );
                       if($getData){
                       $bloodWhereUser = array(
                        'users_id' => $this->input->post('user_tables_id')  
                        );
                      //$bloodBankId = $this->Hospital_model->insertBloodbank($bloodBankDetail);
                        $this->Hospital_model->UpdateTableData($bloodBankDetail,$bloodWhereUser,'qyura_bloodBank');
                       }  else {
                           
                           unset($select,$conditions);
                           $conditions = array();
                            $conditions['hospital_usersId'] = $this->input->post('user_tables_id');
                            $conditions['hospital_deleted'] = 0;
                            $select = array('hospital_countryId,hospital_stateId,hospital_cityId');
                           $bloodBankResult  = $this->Hospital_model->fetchTableData($select,'qyura_hospital',$conditions);
                           $bloodBankDetail['countryId'] = $bloodBankResult[0]->hospital_countryId;
                           $bloodBankDetail['stateId'] = $bloodBankResult[0]->hospital_stateId;
                           $bloodBankDetail['cityId'] = $bloodBankResult[0]->hospital_cityId;
                           $bloodBankDetail['users_id']= $this->input->post('user_tables_id');
                           $bloodBankDetail['creationTime']= strtotime(date("Y-m-d H:i:s"));
                            $bloodBankDetail['inherit_status']= 1;
                            $bloodBankId = $this->Hospital_model->insertBloodbank($bloodBankDetail);
                         
                       } 
                      
                  }
                  
                     if($_POST['pharmacy_chk']==1){
                      
                       $pharmacy_phn = $this->input->post('pharmacy_phn');
                        $prePharmacy = $this->input->post('prePharmacy');
                        
                        //print_r($pharmacy_phn);exit;;
                          $finalPharmacyNumber = '';
                        for($i= 0;$i < count($prePharmacy) ;$i++) {
                            if($pharmacy_phn[$i] != '' && $prePharmacy[$i] !='') {
                               $finalPharmacyNumber .= $prePharmacy[$i].' '.$pharmacy_phn[$i].'|'; 
                            }

                        }
                      // echo $finalPharmacyNumber;exit;
                       $pharmacy_name = $this->input->post('pharmacy_name');
                       
                       $pharmacy_lat = $hospital_lat;
                       $pharmacy_long = $hospital_long;
                     
                       $pharmacyDetail = array(
                           'pharmacy_name' => $pharmacy_name,
                           //'pharmacy_img' => $imagePharmacyName,
                           'pharmacy_lat' => $pharmacy_lat,
                           'pharmacy_long' => $pharmacy_long,
                           'pharmacy_usersId' => $this->input->post('user_tables_id'),
                           'creationTime' => strtotime(date("Y-m-d H:i:s")),
                           'pharmacy_phn' => $finalPharmacyNumber,
                            'pharmacy_address' => $hospital_address
                           
                       );
                       $pharmacyConditions = array();
                      $pharmacyConditions['pharmacy_usersId'] = $this->input->post('user_tables_id');
                      $pharmacyConditions['pharmacy_deleted'] = 0;
                      $pharmacySelect = array('pharmacy_id');
                      $getDataPharmacy = '';
                       $getDataPharmacy = $this->Hospital_model->fetchTableData($pharmacySelect,'qyura_pharmacy',$pharmacyConditions);
                      //$pharmacyId = $this->Hospital_model->insertPharmacy($pharmacyDetail);
                       if($getDataPharmacy){
                           $pharmacyWhereUser = array(
                            'pharmacy_usersId' => $this->input->post('user_tables_id')  
                        );
                      //print_r($pharmacyDetail);exit;
                        $this->Hospital_model->UpdateTableData($pharmacyDetail,$pharmacyWhereUser,'qyura_pharmacy');
                       }else
                       {
                           unset($pharmacySelect,$pharmacyConditions);
                           $pharmacyConditions = array();
                            $pharmacyConditions['hospital_usersId'] = $this->input->post('user_tables_id');
                            $pharmacyConditions['hospital_deleted'] = 0;
                            $pharmacySelect = array('hospital_countryId,hospital_stateId,hospital_cityId');
                           $pharmacyResult  = $this->Hospital_model->fetchTableData($pharmacySelect,'qyura_hospital',$pharmacyConditions);
                           $pharmacyDetail['pharmacy_countryId'] = $pharmacyResult[0]->hospital_countryId;
                           $pharmacyDetail['pharmacy_stateId'] = $pharmacyResult[0]->hospital_stateId;
                           $pharmacyDetail['pharmacy_cityId'] = $pharmacyResult[0]->hospital_cityId;
                           $pharmacyDetail['inherit_status'] = 1;
                           $pharmacyDetail['creationTime']= strtotime(date("Y-m-d H:i:s"));
                           $pharmacyDetail['pharmacy_usersId'] = $this->input->post('user_tables_id');
                           $pharmacyId = $this->Hospital_model->insertPharmacy($pharmacyDetail);
                       }    
                      
                     
                  }
                 $this->session->set_flashdata('message','Data updated successfully !');
                  redirect("hospital/detailHospital/$hospitalId");
                 }
              
         }
    }

    
    function uploadImages ($imageName,$folderName,$newName){
                $path = realpath(FCPATH.'assets/'.$folderName.'/');
                 $config['upload_path'] = $path;
            //echo $config['upload_path']; 
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '10'; // in kb
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
                $config['file_name'] = $newName;
                //$field_name = $_FILES['hospital_photo']['name'];
               
		$this->load->library('upload', $config);
               $this->upload->initialize($config);
              // $this->upload->do_upload($imageName);
               
               if ($this->upload->do_upload($imageName)) {
                //If image upload in folder, set also this value in "$image_data".
                   $image_data = $this->upload->data();
                    return TRUE;
                }else{
                    $upload_error['upload_error'] = array('error' => $this->upload->display_errors()); 
                    $msg = '';
                    if(!empty($upload_error) && count($upload_error) > 0){
                        foreach ($upload_error as $key => $value) {
                             $msg .= $value['error'].'in'.$folderName;
                        }
                        
                    }
                    $this->session->set_flashdata('message',$msg);
                    redirect('hospital/addHospital');
                    return FALSE;
                }
              // print_r($image_data);
            /*   $img = $this->uploadResizeImage($image_data);
               print_r($img);
               exit();
               
                $config['image_library'] = 'gd2';
                $config['create_thumb'] = TRUE;
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 75;
                $config['height'] = 50;

               
	       $this->load->library('image_lib', $config); 
               $this->image_lib->initialize($config);
              if ( !$this->image_lib->resize($image_data)){
		echo $this->image_lib->display_errors();
	    }
               return TRUE; */

    }
    
   
    function updatePassword(){
         //echo "here";exit;
        $users_email = $this->input->post('users_email');
       // echo $users_email;
       // exit;
        //$existingPassword = $this->input->post('existingPassword');
        $user_tables_id = $this->input->post('hospitalUserId');
        $users_password = $this->input->post('users_password');
        
        $users_mobile = $this->input->post('users_mobile');
        $hospital_mmbrTyp = $this->input->post('hospital_mmbrTyp');
       
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
         $where = array(
                        'users_id' => $user_tables_id
                    );
        $userTableData = array(
            'users_mobile' => $users_mobile,
            'users_email' => $users_email,
            'modifyTime'=> strtotime(date("Y-m-d H:i:s"))
        );
        $return = $this->Hospital_model->UpdateTableData($userTableData,$where,'qyura_users');
        if(!empty($users_password))
        {
            $encrypted = md5($currentPassword);
             $updateHospital= array(
                      'users_password'=>  $encrypted,
                        'modifyTime'=> strtotime(date("Y-m-d H:i:s"))  
                    );

                   
                $return = $this->Hospital_model->UpdateTableData($updateHospital,$where,'qyura_users');
        }    
        
        $hospitalData = array(
            'hospital_mmbrTyp' => $hospital_mmbrTyp,
            'modifyTime'=> strtotime(date("Y-m-d H:i:s"))
        );
        $hospitalWhere = array('hospital_usersId' => $user_tables_id);
        $return = $this->Hospital_model->UpdateTableData($hospitalData,$hospitalWhere,'qyura_hospital');
       echo $return ;
        //echo $encrypted;
        exit;
    }
    function hospitalSpecialities($hospitalId){
        $hospitalSeleted =array (
           'hospitalSpecialities_id','hospitalSpecialities_specialitiesId'
        );
        $hospitalWhere = array(
            'hospitalSpecialities_deleted' => 0,
            'hospitalSpecialities_hospitalId'=>$hospitalId
        );
        $notIn = '';
        $hospitalData = $this->Hospital_model->fetchTableData($hospitalSeleted,'qyura_hospitalSpecialities',$hospitalWhere);
        foreach($hospitalData as $key=>$val){
           $notIn []= $val->hospitalSpecialities_specialitiesId;
            
        }
        
        $selectTableData = array (
           'specialities_id','specialities_name'
        );
        $where = array(
            'specialities_deleted' => 0,
            
        );
        $data = $this->Hospital_model->fetchTableData($selectTableData,'qyura_specialities',$where,$notIn,'specialities_id');
        $specialist = '';
        foreach($data as $key=>$val){
        $specialist .='<li >'. $val->specialities_name .'<input type=checkbox class=specialityCheck name=speciality value='.$val->specialities_id.' /></li>';
           
        }
       
        echo $specialist;
        exit;
    }
     function hospitalDiagnostics($hospitalId){
        
        $hospitalDiagnostics =array (
           'hospitalDiagnosticsCat_hospitalId','hospitalDiagnosticsCat_diagnosticsCatId'
        );
        $DiagnosticsWhere = array(
            'hospitalDiagnosticsCat_deleted' => 0,
            'hospitalDiagnosticsCat_hospitalId'=>$hospitalId
        );
        $notIn = '';
        $DiagnosticsData = $this->Hospital_model->fetchTableData($hospitalDiagnostics,'qyura_hospitalDiagnosticsCat',$DiagnosticsWhere);
        foreach($DiagnosticsData as $key=>$val){
           $notIn []= $val->hospitalDiagnosticsCat_diagnosticsCatId;
            
        }
        
        $selectTableData = array (
           'diagnosticsCat_catId','diagnosticsCat_catName'
        );
        $where = array(
            'diagnosticsCat_deleted' => 0,
            
        );
        $data = $this->Hospital_model->fetchTableData($selectTableData,'qyura_diagnosticsCat',$where,$notIn,'diagnosticsCat_catId');
        $diagnostic = '';
        foreach($data as $key=>$val){
        $diagnostic .='<li >'. $val->diagnosticsCat_catName .'<input type=checkbox class=diagonasticCheck name=speciality value='.$val->diagnosticsCat_catId.' /></li>';
           
        }
       
        echo $diagnostic;
        exit;
        
    }
    function addDiagnostic(){
        $hospitalId = $this->input->post('hospitalId');
        $hospitalDiagnosticsCat_diagnosticsCatId = $this->input->post('hospitalDiagnosticsCat_diagnosticsCatId');
        $insertData = array(
            'hospitalDiagnosticsCat_diagnosticsCatId' => $hospitalDiagnosticsCat_diagnosticsCatId,
            'hospitalDiagnosticsCat_hospitalId' => $hospitalId,
            'hospitalDiagnosticsCat_deleted' => 0,
            'creationTime' => strtotime(date("Y-m-d H:i:s"))
        );
        $return = $this->Hospital_model->insertTableData('qyura_hospitalDiagnosticsCat',$insertData);
        echo $return;
        exit;
    }
    function addSpeciality(){
        $hospitalId = $this->input->post('hospitalId');
        $hospitalSpecialities_specialitiesId = $this->input->post('hospitalSpecialities_specialitiesId');
        $insertData = array(
            'hospitalSpecialities_specialitiesId' => $hospitalSpecialities_specialitiesId,
            'hospitalSpecialities_hospitalId' => $hospitalId,
            'hospitalSpecialities_deleted' => 0,
            'creationTime' => strtotime(date("Y-m-d H:i:s"))
        );
        $return = $this->Hospital_model->insertTableData('qyura_hospitalSpecialities',$insertData);
        echo $return;
        exit;
    }
    
    function hospitalAllocatedSpecialities($hospitalId){
        
        $data = $this->Hospital_model->fetchhospitalSpecialityData($hospitalId);
        $allocatedSpecialist = '';
        foreach($data as $key=>$val){
        $allocatedSpecialist .='<li >'. $val->specialities_name .'<input type=checkbox class=specialityAllocCheck name=allocSpeciality value='.$val->hospitalSpecialities_id.' /></li>';
           
        }
        echo $allocatedSpecialist;
        exit;
    }
    function hospitalFetchDiagnostics($hospitalId){
        $data = $this->Hospital_model->fetchhospitalDiagonasticData($hospitalId);
        $allocatedSpecialist = '';
        foreach($data as $key=>$val){
        $allocatedSpecialist .='<li onclick=showDiagonasticDetail('.$hospitalId.','.$val->hospitalDiagnosticsCat_diagnosticsCatId.')>'. $val->diagnosticsCat_catName .'<input type=checkbox class=diagonasticAllocCheck name=allocdiagonastic value='.$val->hospitalDiagnosticsCat_id.' /></li>';
           
        }
        echo $allocatedSpecialist;
        exit;
    }
    function revertDiagnostic(){
        $hospitalId = $this->input->post('hospitalId');
        $hospitalDiagnosticsCat_id = $this->input->post('hospitalDiagnosticsCat_id');
        $diagonasticData = array(
            'hospitalDiagnosticsCat_deleted' => 1,
            'modifyTime'=> strtotime(date("Y-m-d H:i:s"))
        );
        $diagonasticWhere = array('hospitalDiagnosticsCat_id' => $hospitalDiagnosticsCat_id,'hospitalDiagnosticsCat_hospitalId'=> $hospitalId);
        $return = $this->Hospital_model->UpdateTableData($diagonasticData,$diagonasticWhere,'qyura_hospitalDiagnosticsCat');
       echo $return ;
    }
   function revertSpeciality(){
       $hospitalId = $this->input->post('hospitalId');
        $hospitalSpecialities_id = $this->input->post('hospitalSpecialities_id');
        $hospitalData = array(
            'hospitalSpecialities_deleted' => 1,
            'modifyTime'=> strtotime(date("Y-m-d H:i:s"))
        );
        $hospitalWhere = array('hospitalSpecialities_id' => $hospitalSpecialities_id,'hospitalSpecialities_hospitalId'=> $hospitalId);
        $return = $this->Hospital_model->UpdateTableData($hospitalData,$hospitalWhere,'qyura_hospitalSpecialities');
       echo $return ;
   }
   
   function detailDiagnostic(){
       $hospitalId = $this->input->post('hospitalId');
       $categoryId = $this->input->post('categoryId');
        $selectTableData = array (
           'quotationDetailTests_testName','quotationDetailTests_price','quotationDetailTests_id'
        );
        $where = array(
            'quotationDetailTests_diagnosticCatId' => $categoryId,
            'quotationDetailTests_MIprofileId' => $hospitalId,
            'quotationDetailTests_deleted' => 0
            
        );
        $data = $this->Hospital_model->fetchTableData($selectTableData,'qyura_quotationDetailTests',$where);
        //echo $data;exit;
       $diagonasticTest = '';
        foreach($data as $key => $val){
            $diagonasticTest .='<tr onclick = fetchInstruction('.$val->quotationDetailTests_id.')> <td>'.$val->quotationDetailTests_testName.'</td><td><i class="fa fa-inr"></i> <a data-title="Enter username" data-pk="1" data-type="text" id="username" href="#" class="editable editable-click editable-open" data-original-title="Edit Price" title="" aria-describedby="popover939766">'.$val->quotationDetailTests_price.'</a>';
         $diagonasticTest .= '</td><td><a class="btn btn-success waves-effect waves-light m-b-5 " href="#">Edit</a></td></tr>';
        }
        echo $diagonasticTest;
        exit;
   }
   
   function detailDiagnosticInstruction(){
       $quotationDetailTests_id = $this->input->post('quotationDetailTests_id');
        $selectTableData = array (
           'quotationDetailTests_instruction'
        );
        $where = array(
            'quotationDetailTests_id' => $quotationDetailTests_id,
           'quotationDetailTests_deleted' => 0
            
        );
        $data = $this->Hospital_model->fetchTableData($selectTableData,'qyura_quotationDetailTests',$where);
       $diagonasticTest = $data[0]->quotationDetailTests_instruction;
       echo $diagonasticTest;
       exit;
   }
   
    /**
     * @project Qyura
     * @method galleryUploadImage
     * @description add gallery image
     * @access public
     * @return boolean
     */
    function galleryUploadImage() {
    
    	if ($_POST['avatar_file']['name']) {
    		$path = realpath(FCPATH . 'assets/hospitalsImages/');
    		$upload_data = $this->input->post('avatar_data');
    		$upload_data = json_decode($upload_data);
    		$original_imagesname = $this->uploadImageWithThumb($upload_data, 'avatar_file', $path, 'assets/hospitalsImages/', './assets/hospitalsImages/thumb/','hospital');
    
    		if (empty($original_imagesname)) {
    			$response = array('state' => 400, 'message' => $this->error_message);
    		} else {
    
    			$option = array(
    					'hospitalImages_ImagesName' => $original_imagesname,
    					'hospitalImages_hospitalId'=> $this->input->post('avatar_id'),
    					'creationTime' => strtotime(date("Y-m-d H:i:s"))
    			);
			$options = array(
					'table'=> 'qyura_hospitalImages',
					'data'=>$option
			);
			
    			$response = $this->Hospital_model->customInsert($options);
    			if ($response) {
    				$response = array('state' => 200, 'message' => 'Successfully added gallery image');
    			} else {
    				$response = array('state' => 400, 'message' => 'Failed to added gallery image');
    			}
    		}
    		echo json_encode($response);
    	} else {
    		$response = array('state' => 400, 'message' => 'Please select image');
    		echo json_encode($response);
    	}
    }

   
    function getGalleryImage($id) {
    	if (!empty($id)) {
    		$gallery_template = '';
    		$where = array(

    				'hospitalImages_hospitalId'=> $id,
    				'hospitalImages_deleted'=> 0
    		);
    		$options = array(
    				'table'=> 'qyura_hospitalImages',
    				'where'=>$where
    		);
    		$gallerys = $this->Hospital_model->customGet($options);
    		if($gallerys){
	    		foreach($gallerys as $gallery){
	    			$gallery_template.='<aside class="col-md-3 col-sm-4 col-xs-6 show-image">
                                                <img width="210" class="thumbnail img-responsive" src="'.base_url().'/assets/hospitalsImages/thumb/original/'.$gallery->hospitalImages_ImagesName.'">
                                                <a class="delete" onClick="deleteGalleryImage('.$gallery->hospitalImages_id.')"> <i class="fa fa-times fa-2x"></i></a>
                                            </aside>';
	    		}
    		}else{
    			$gallery_template = 'Add Image';
    		}
    		echo $gallery_template;
    		exit();
    	}
    }
    
    function deleteGalleryImage() {
    	$id = $this->input->post('id');
    	$updatedData = array('hospitalImages_deleted' => 1);
    	$updatedDataWhere = array('hospitalImages_id' => $id);
    
    	$option = array(
    			'table'=> 'qyura_hospitalImages',
    			'where'=>$updatedDataWhere,
    			'data'=>$updatedData
    	);
    	$return = $this->Hospital_model->customUpdate($option);
    	echo $return;
    	exit;
    }
}
