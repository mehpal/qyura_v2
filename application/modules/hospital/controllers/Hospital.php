<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Hospital extends MY_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->model(array('Hospital_model', 'bloodbank/Bloodbank_model', 'doctor/Doctor_model'));
        $this->load->library('datatables');
    }

    function index() {
        $data = array();
       // $data['allStates'] = $this->Hospital_model->fetchStates();
        $data['allCities'] = $this->Hospital_model->allCities();
        $data['hospitalData'] = $this->Hospital_model->fetchHospitalData();
        $data['title'] = 'All Hospital';
        $data['hospitalId'] = 0;
        $this->load->super_admin_template('HospitalListing', $data, 'hospitalScript');
    }

    function getHospitalDl() {


        echo $this->Hospital_model->fetchHospitalDataTables();
    }

    /**
     * @project Qyura
     * @method getHospitalDoctorsDl
     * @description diagnostic doctor datatable listing
     * @access public
     * @return array
     */
    function getHospitalDoctorsDl($hospitalUserId) {

        $miUserId = 0;
        if (!empty($hospitalUserId)) {

            $option = array(
                'table' => 'qyura_hospital',
                'select' => 'hospital_usersId',
                'where' => array('hospital_id' => $hospitalUserId)
            );
            $miData = $this->common_model->customGet($option);
            $miUserId = $miData[0]->hospital_usersId;
        }

        echo $this->Hospital_model->fetchHospitalDoctorDataTables($miUserId);
    }

    function addHospital() {
       $data = array();
        
       $option = array(
            'table' => 'qyura_membership',
            'select' => 'membership_id,membership_name',
            'where' => array('membership_deleted' => 0, 'qyura_membership.status' => 1, 'membership_type' => 1)
        );
        $data['membership_plan'] = $this->common_model->customGet($option);
        
        $option = array(
            'table' => 'qyura_facilities',
            'select' => '*',
            'where' => array('qyura_facilities.facilities_deleted' => 0),
            'order' => array('facilities_name' => 'asc'),
            'single' => FALSE
        );
        $data['facilities_list'] = $this->common_model->customGet($option);
        
        $data['allCountry'] = $this->Hospital_model->fetchCountry();
        $data['allStates'] = $this->Hospital_model->fetchStates();
        $data['publishHospital'] = $this->Hospital_model->fetchPublishHospital();
        $data['hospitalType'] = $this->Hospital_model->getHospitalType();
        $data['title'] = 'Add Hospital';
        $this->load->super_admin_template('AddHospital', $data, 'hospitalScript');
    }

    function checkUserExistence() {
        $email = $this->input->post('emailId');
        $this->Hospital_model->checkUserExistence($email);
    }

    // method for delete insurance
    function deletInsurance() {
        $insuranceId = $this->input->post('insuranceId');
        $this->Hospital_model->deletInsurance($insuranceId);
    }

    // get hospital detail
    function detailHospital($hospitalId = '', $active = 'general', $showdiv = null) {

       
        $data = array();
        
        $option = array(
            'table' => 'qyura_membership',
            'select' => 'membership_id,membership_name',
            'where' => array('membership_deleted' => 0,'qyura_membership.status' => 1,'membership_type' => 1)
        );
        $data['membership_plan'] = $this->common_model->customGet($option);
        
        $option = array(
            'table' => 'qyura_facilities',
            'select' => '*',
            'where' => array('qyura_facilities.facilities_deleted' => 0),
            'order' => array('facilities_name' => 'asc'),
            'single' => FALSE
        );
        $data['facilities_list'] = $this->common_model->customGet($option);
        
         if($this->uri->segment(5) != '' && $this->uri->segment(5) != 0){
            $doctorId =   $this->uri->segment(5);
            $showdiv = $this->uri->segment(6);
            $data['doctorId'] = $doctorId;
            if($showdiv === 'timeSlot'){
                $timeSloats = array();
                foreach (getDay() as $weekDay => $weekIndex) {
                    $where = array('docTimeDay_day' => $weekIndex, 'docTimeTable_doctorId' => $doctorId);
                    $result = $this->Doctor_model->getDocTimeOnDay($where);
                    //dump($this->db->last_query());
                    if ($result)
                        $timeSloats[$weekDay] = $result;
                }
                $data['timeSloats'] = $timeSloats;
            }
            $data['doctorDetail'] = $this->Hospital_model->getDoctorDeatil($doctorId); 
            $data['docAcaSpecialities'] = $this->Hospital_model->getDocAcaSpec($doctorId);
            $option = array(
            'table' => 'qyura_doctorSpecialities',
            'select' => 'doctorSpecialities_specialitiesId',
            'where' => array('qyura_doctorSpecialities.doctorSpecialities_deleted' => 0,'qyura_doctorSpecialities.doctorSpecialities_doctorsId' => $doctorId),
            'single' => FALSE
        );
        $doctorSpecialities = $this->common_model->customGet($option);
        
        $qyura_doctorSpecialities = array();
        foreach($doctorSpecialities as $Specialities){
            array_push($qyura_doctorSpecialities, $Specialities->doctorSpecialities_specialitiesId);
        }
        $data['qyura_doctorSpecialities'] = $qyura_doctorSpecialities;
            
            
        }
        
        
        $data['hospitalData'] = $hospitalData = $this->Hospital_model->fetchHospitalData($hospitalId);
        
       // dump($data['hospitalData']); exit;
        if (count($data['hospitalData']) == 0) {
            redirect('hospital');
        }
        
        $data['hospitalType'] = $this->Hospital_model->getHospitalType();
        $data['allCountry'] = $this->Hospital_model->fetchCountry();
        $data['allCities'] = $this->Hospital_model->fetchCity($data['hospitalData'][0]->hospital_stateId);
        $data['allStates'] = $this->Hospital_model->fetchStates($data['hospitalData'][0]->hospital_countryId);

        $data['hospitalId'] = $hospitalId;
        $data['showStatus'] = 'none';
        $data['detailShow'] = 'block';
        $data['showDiv'] = $showdiv;
        $insurance_condition = '';
        $data['active'] = $active;
        $data['insurance'] = $this->Hospital_model->fetchInsurance($hospitalId);
        


        $data['gallerys'] = $this->Hospital_model->customGet(array('table' => 'qyura_hospitalImages', 'where' => array('hospitalImages_hospitalId' => $hospitalId, 'hospitalImages_deleted' => 0)));
        if (!empty($data['insurance'])) {
            foreach ($data['insurance'] as $key => $val) {
                $insurance_condition[] = $val->hospitalInsurance_insuranceId;
            }
        }
        
        
        $option = array(
            'table' => 'qyura_miMembership',
            'where' => array('qyura_miMembership.miMembership_miId' => $hospitalData[0]->hospital_usersId,'qyura_miMembership.miMembership_deleted' => 0),
            'join' => array(
                array('qyura_facilities', 'qyura_facilities.facilities_id = qyura_miMembership.miMembership_facilitiesId', 'left')
            ),
            'order' => array('qyura_facilities.facilities_name' => 'asc'),
        );
        $data['membership_datail'] = $this->common_model->customGet($option);
        
        
        $mi_userId="";
        if(!empty($hospitalData)):
         $mi_userId = $hospitalData[0]->hospital_usersId;
        endif;
        $option = array(
            'select' => '*',
            'table'=> 'qyura_miTimeSlot',
            'where'=> array('mi_user_id' => $mi_userId),
        );
        $data['timeSlot'] = $this->common_model->customGet($option);

        $data['allInsurance'] = $this->Hospital_model->fetchAllInsurance($insurance_condition);
        
        
        // for doctor
        
     //  $data['allStates'] = $this->Doctor_model->fetchStates();
        $data['speciality'] = $this->Doctor_model->fetchSpeciality();

        $data['degree'] = $this->Doctor_model->fetchDegree();
        //$data['academic'] = $this->Doctor_model->fetchAcademic();
        $data['hospital'] = $this->Doctor_model->fetchHospital();
        
        $data['awardAgency'] = $this->Hospital_model->fetchAwardAgency();

        // $this->load->super_admin_template('hospitalDetail', $data, 'bloodBankScript');
        //$this->load->view('hospitalDetail',$data);
        $data['title'] = 'Hospital Detail';
        $this->load->super_admin_template('hospitalDetail', $data, 'hospitalScript');
    }

    function hospitalAwards($hospitalId) {
        $dataAwards = $this->Hospital_model->fetchAwards($hospitalId);
        $showAwards = '';
        if ($dataAwards) {
            foreach ($dataAwards as $key => $val) {
                $showAwards .='<li>' . $val->hospitalAwards_awardsName . ', ' . $val->hospitalAwards_awardYear .', ' . $val->hospitalAwards_awardsAgency . '</li>';
            }
        } else {
            $showAwards = 'Add Awards';
        }
        echo $showAwards;
        exit;
    }

    function hospitalServices($hospitalId) {
        $dataAwardsServices = $this->Hospital_model->fetchServices($hospitalId);
        $showServices = '';
        if ($dataAwardsServices) {
            foreach ($dataAwardsServices as $key => $val) {
                $showServices .='<li>' . $val->hospitalServices_serviceName . '</li>';
            }
        } else {
            $showServices = 'Add Service';
        }
        echo $showServices;
        exit;
    }

    function detailAwards($hospitalId) {
        $dataAwards = $this->Hospital_model->fetchAwards($hospitalId);
        $awardAgency = $this->Hospital_model->fetchAwardAgency();
        if ($dataAwards) {
            $showTotalAwards = '';
            foreach ($dataAwards as $key => $val) {
                
             $agencyOption  = '';
             foreach ($awardAgency as $key => $value) {
               //  echo $value->awardAgency_id.'-'.$val->awardAgency_id.'</br>';
                 if($value->awardAgency_id ==  $val->awardAgency_id){
                    $agencyOption .= '<option selected="selected" value= '.$value->awardAgency_id.' >  '.$value->agency_name.' </option>';
                 }else{
                     $agencyOption .= '<option value= '.$value->awardAgency_id.' >  '.$value->agency_name.' </option>';
                 }
            }
               // echo $agencyOption;
                $showTotalAwards .= '<div class="clearfix m-t-20">
        <div class="clearfix">
           <input type="text" class="form-control" name="hospitalAwards_awardsName" id=' . $val->hospitalAwards_id . ' value="' . $val->hospitalAwards_awardsName . '" placeholder="" />
               <label style="display: none;"class="error" id="error-awards' . $val->hospitalAwards_id . '"> Please enter award name </label>  
                   

              <div class="clearfix m-t-10">
                <select class="selectpicker" data-width="100%" id=agency' . $val->hospitalAwards_id . ' name="hospitalAwards_agencyName">
                      '.$agencyOption.'
                    </select>
                 <label style="display: none;"class="error" id="error-agency' . $val->hospitalAwards_id . '"> Please enter agency name </label>

              </div>
            <aside class="clearfix m-t-10">
            <input type="text" class="form-control" name="hospital_awardsyear" id=year' . $val->hospitalAwards_id . ' value="' . $val->hospitalAwards_awardYear . '" placeholder="" />
                 <label style="display: none;"class="error" id="error-years' . $val->hospitalAwards_id . '"> Please enter year only number formate minium and maximum length 4 </label>
                     </aside>
           
         </div>
          

          <div class="col-md-1 col-sm-2 col-xs-2 pull-right">
          <a class="pointer" onclick="deleteAwards(' . $val->hospitalAwards_id . ')"><i class="fa fa-times fa-2x m-t-5 label-plus" title="Delete Awards"></i></a>
          </div>
           <div class="col-md-1 col-sm-2 col-xs-2 pull-right">
            <a class="pointer" onclick="editAwards(' . $val->hospitalAwards_id . ')"><i class="fa fa-pencil-square-o fa-2x m-t-5 label-plus" title="Edit Awards"></i></a>
           </div>
         </div>';
            }
        } else {
            $showTotalAwards = 'Add Awards';
        }

        echo $showTotalAwards;
        exit;
    }

    function detailServices($hospitalId) {
        $dataServices = $this->Hospital_model->fetchServices($hospitalId);
        if ($dataServices) {
            $showTotalService = '';
            foreach ($dataServices as $key => $val) {
                $showTotalService .= '<div class="row m-t-10">
        <div class="col-md-8 col-sm-8 col-xs-8">
           <input type="text" class="form-control" name="hospitalServices_serviceName" id=' . $val->hospitalServices_id . ' value="' . $val->hospitalServices_serviceName . '" placeholder="Service Name" />
         </div>
           <div class="col-md-2 col-sm-2 col-xs-2">
            <a class="pointer" onclick="editServices(' . $val->hospitalServices_id . ')"><i class="fa fa-pencil-square-o fa-2x m-t-5 label-plus" title="Edit Services"></i></a>
           </div>

          <div class="col-md-2 col-sm-2 col-xs-2">
          <a class="pointer" onclick="deleteServices(' . $val->hospitalServices_id . ')"><i class="fa fa-times fa-2x m-t-5 label-plus" title="Delete Services"></i></a>
          </div>
         </div>';
            }
        } else {
            $showTotalService = 'Add Services';
        }

        echo $showTotalService;
        exit;
    }

    function addHospitalAwards() {
        $hospitalId = $this->input->post('hospitalId');
        $hospitalAwards_awardsName = $this->input->post('hospitalAwards_awardsName');
        $hospitalAwards_agencyName = $this->input->post('hospitalAwards_agencyName');
        $hospitalAwards_awardYear = $this->input->post('hospitalAwards_awardYear');
        $awardData = array('hospitalAwards_awardsName' => $hospitalAwards_awardsName, 'hospitalAwards_awardYear' => $hospitalAwards_awardYear, 'hospitalAwards_hospitalId' => $hospitalId, 'hospitalAwards_awardsAgency' => $hospitalAwards_agencyName);
        $return = $this->Hospital_model->insertTableData('qyura_hospitalAwards', $awardData);
        echo $return;
        exit;
    }

    function addHospitalService() {
        $hospitalId = $this->input->post('hospitalId');
        $hospitalServices_serviceName = $this->input->post('hospitalServices_serviceName');
        $serviceData = array('hospitalServices_serviceName' => $hospitalServices_serviceName, 'hospitalServices_hospitalId' => $hospitalId);
        $return = $this->Hospital_model->insertTableData('qyura_hospitalServices', $serviceData);
        echo $return;
        exit;
    }

    function editHospitalAwards() {
        $hospitalAwards_id = $this->input->post('awardsId');

        $hospitalAwards_awardsName = $this->input->post('hospitalAwards_awardsName');
        $hospitalAwards_agencyName = $this->input->post('hospitalAwards_agencyName');
        $hospitalAwards_awardYear = $this->input->post('hospitalAwards_awardYear');

        $updatedData = array('hospitalAwards_awardsName' => $hospitalAwards_awardsName, 'hospitalAwards_awardYear' => $hospitalAwards_awardYear, 'hospitalAwards_awardsAgency' => $hospitalAwards_agencyName);
        $updatedDataWhere = array('hospitalAwards_id' => $hospitalAwards_id);
        $return = $this->Hospital_model->UpdateTableData($updatedData, $updatedDataWhere, 'qyura_hospitalAwards');
        echo $return;
        exit;
    }

    function editHospitalService() {
        $hospitalServices_id = $this->input->post('serviceId');
        $hospitalServices_serviceName = $this->input->post('hospitalServices_serviceName');
        $updatedData = array('hospitalServices_serviceName' => $hospitalServices_serviceName);
        $updatedDataWhere = array('hospitalServices_id' => $hospitalServices_id);
        $return = $this->Hospital_model->UpdateTableData($updatedData, $updatedDataWhere, 'qyura_hospitalServices');
        echo $return;
        exit;
    }

    function deleteHospitalService() {
        $hospitalServices_id = $this->input->post('serviceId');
        $hospitalServices_serviceName = $this->input->post('hospitalServices_serviceName');
        $updatedData = array('	hospitalServices_deleted' => 1);
        $updatedDataWhere = array('hospitalServices_id' => $hospitalServices_id);
        $return = $this->Hospital_model->UpdateTableData($updatedData, $updatedDataWhere, 'qyura_hospitalServices');
        echo $return;
        exit;
    }

    function deleteHospitalAwards() {
        $hospitalAwards_id = $this->input->post('awardsId');
        $updatedData = array('hospitalAwards_deleted' => 1);
        $updatedDataWhere = array('hospitalAwards_id' => $hospitalAwards_id);
        $return = $this->Hospital_model->UpdateTableData($updatedData, $updatedDataWhere, 'qyura_hospitalAwards');
        echo $return;
        exit;
    }

    function addInsurance() {
        $hospitalId = $this->input->post('hospitalInsuranceId');

        $insurances = $this->input->post('insurances');
        if (!empty($insurances)) {
            foreach ($insurances as $key => $val) {
                $insurancesData = array(
                    'hospitalInsurance_hospitalId' => $hospitalId,
                    'hospitalInsurance_insuranceId' => $val
                );
                // print_r($insurancesData);
                // exit;
                $this->Hospital_model->insertTableData('qyura_hospitalInsurance', $insurancesData);
                //$insurancesData = '';
            }
            $this->session->set_flashdata('message', 'Insurance added successfully !');
            redirect("hospital/detailHospital/$hospitalId/general");
        } else {
            redirect("hospital/detailHospital/$hospitalId/general");
        }
    }

    function fetchStates() {
        // fetch state
        $stateId = $this->input->post('stateId');
        $countryId = $this->input->post('countryId');
        $statesdata = $this->Hospital_model->fetchStates($countryId);
        $statesOption = '';
        $statesOption .='<option value=>Select Your States</option>';
        foreach ($statesdata as $key => $val) {
            if ($val->state_id == $stateId)
                $statesOption .= '<option value=' . $val->state_id . ' selected >' . strtoupper($val->state_statename) . '</option>';
            else
                $statesOption .= '<option value=' . $val->state_id . '>' . strtoupper($val->state_statename) . '</option>';
        }
        echo $statesOption;
        exit;
    }

    function fetchCityOnload() {
        $stateId = $this->input->post('stateId');
        $cityId = $this->input->post('cityId');
        $cityData = $this->Hospital_model->fetchCity($stateId);
        $cityOption = '';
        $cityOption .='<option value=>Select Your City</option>';
        foreach ($cityData as $key => $val) {
            if ($val->city_id == $cityId)
                $cityOption .= '<option value=' . $val->city_id . ' selected>' . strtoupper($val->city_name) . '</option>';
            else
                $cityOption .= '<option value=' . $val->city_id . '>' . strtoupper($val->city_name) . '</option>';
        }
        echo $cityOption;
        exit;
    }

    function fetchCity() {
        $stateId = $this->input->post('stateId');
        $cityData = $this->Hospital_model->fetchCity($stateId);
        $cityOption = '';
        $cityOption .='<option value=>Select Your City</option>';
        foreach ($cityData as $key => $val) {
            $cityOption .= '<option value=' . $val->city_id . '>' . strtoupper($val->city_name) . '</option>';
        }
        echo $cityOption;
        exit;
    }

    function fetchState() {
        $countryId = $this->input->post('countryId');
        $stateData = $this->Hospital_model->fetchStates($countryId);
        $stateOption = '';
        // $cityOption .='<option value=>Select Your City</option>';
        foreach ($stateData as $key => $val) {
            $stateOption .= '<option value=' . $val->state_id . '>' . strtoupper($val->state_statename) . '</option>';
        }
        echo $stateOption;
        exit;
    }

    function SaveHospital() {
       // dump($_POST); exit;
        $this->bf_form_validation->set_rules('hospital_name', 'Hospital Name', 'required|trim');
        $this->bf_form_validation->set_rules('hospital_type', 'Hospital Type', 'required|trim');
        $this->bf_form_validation->set_rules('hospital_address', 'Hospital Address', 'required|trim');
        $this->bf_form_validation->set_rules('hospital_cntPrsn', 'Contact Person', 'required|trim');
        $this->bf_form_validation->set_rules('hospital_mmbrTyp', 'Membership Type', 'required|trim');

        $this->bf_form_validation->set_rules('hospital_countryId', 'Hospital Country', 'required|trim');
        $this->bf_form_validation->set_rules('hospital_stateId', 'Hospital StateId', 'required|trim');
        $this->bf_form_validation->set_rules('hospital_cityId', 'hospital City', 'required|trim');
        $this->bf_form_validation->set_rules('hospitalServices_serviceName[]', 'hospital Service Name', 'required|trim');
        $this->bf_form_validation->set_rules('hospital_mblNo', 'Hospital Mobile No', 'required|trim');

       // $this->bf_form_validation->set_rules('hospital_mbl', 'Mobile No', 'trim');

        $this->bf_form_validation->set_rules('hospital_zip', 'Hospital Zip', 'required|trim');
        $this->bf_form_validation->set_rules('hospital_dsgn', 'Hospital Designation', 'required|trim');
        $this->bf_form_validation->set_rules('users_email', 'Users Email', 'required|valid_email|trim');
        $this->bf_form_validation->set_rules('users_password', 'Password', 'trim|required|matches[cnfPassword]');
        $this->bf_form_validation->set_rules('cnfPassword', 'Password Confirmation', 'trim|required');

        $this->bf_form_validation->set_rules('isManual', 'Manual', 'trim|required');

        $this->bf_form_validation->set_rules('lat', 'Latitude', 'required|trim');
        $this->bf_form_validation->set_rules('lng', 'Longitude', 'required|trim');

        //$this->bf_form_validation->set_rules('midNumber[]', 'Please enter std code', 'trim|required');
        // checkboxes
        $this->bf_form_validation->set_rules('bloodbank_chk', 'blood bank checkbox', 'trim');
        $this->bf_form_validation->set_rules('bloodBank_name', 'blood bank name', 'trim');
        $this->bf_form_validation->set_rules('bloodBank_phn', 'blood bank phon no.', 'trim');

        $this->bf_form_validation->set_rules('pharmacy_chk', 'pharmacy checkbox', 'trim');

        $this->bf_form_validation->set_rules('ambulance_chk', 'ambulance checkbox', 'trim');
        $this->bf_form_validation->set_rules('ambulance_name', 'ambulance name', 'trim');
        $this->bf_form_validation->set_rules('docOnBoard', 'doctor on board', 'trim');
        $this->bf_form_validation->set_rules('ambulance_phn', 'ambulance phon no.', 'trim');

        $this->bf_form_validation->set_rules('isEmergency', 'isEmergency', 'trim');
        $this->bf_form_validation->set_rules('availibility_24_7', '24*7 Availibility', 'trim');
        
        $this->bf_form_validation->set_rules('hospital_phn', 'Hospital Phon No.', 'required|trim');
        
        $this->bf_form_validation->set_rules('docatId', 'Docat id', 'trim');
        
        
        $this->bf_form_validation->set_rules('membership_quantity_1', 'Membership Quantity', 'required|trim');
        $this->bf_form_validation->set_rules('membership_duration_1', 'Membership Duration', 'required|trim');
        
        $this->bf_form_validation->set_rules('membership_quantity_2', 'Membership Quantity', 'required|trim');
        $this->bf_form_validation->set_rules('membership_duration_2', 'Membership Duration', 'required|trim');
        
        $this->bf_form_validation->set_rules('membership_quantity_3', 'Membership Quantity', 'required|trim');
        $this->bf_form_validation->set_rules('membership_quantity_4', 'Membership Quantity', 'required|trim');
        
        if (empty($_FILES['avatar_file']['name'])) {

            $this->bf_form_validation->set_rules('avatar_file', 'File', 'required');
        }
        if ($this->bf_form_validation->run() === FALSE) {
          //  echo validation_errors(); exit;
            $data = array();
            
            $option = array(
                  'table' => 'qyura_membership',
                  'select' => 'membership_id,membership_name',
                  'where' => array('membership_deleted' => 0, 'status' => 3, 'membership_type' => 1)
              );
              $data['membership_plan'] = $this->common_model->customGet($option);

              $option = array(
                  'table' => 'qyura_facilities',
                  'select' => '*',
                  'where' => array('qyura_facilities.facilities_deleted' => 0),
                  'order' => array('facilities_name' => 'asc'),
                  'single' => FALSE
              );
              $data['facilities_list'] = $this->common_model->customGet($option);
        
            $data['allCountry'] = $this->Hospital_model->fetchCountry();
            
            $hospital_countryId = $this->input->post('hospital_countryId');
            if ($hospital_countryId != '') {
                $data['allStates'] = $this->Hospital_model->fetchStates($hospital_countryId);
            }

            $hospital_stateId = $this->input->post('hospital_stateId');
            if ($hospital_stateId != '') {
                $data['allCities'] = $this->Hospital_model->fetchCity($hospital_stateId);
            }
            //  $data['allCities'] = $this->Hospital_model->fetchCity($data['hospitalData'][0]->hospital_stateId);
            //$data['allStates'] = $this->Hospital_model->fetchStates($data['hospitalData'][0]->hospital_countryId);
            $data['hospitalType'] = $this->Hospital_model->getHospitalType();
            $data['publishHospital'] = $this->Hospital_model->fetchPublishHospital();
            
            $data['bloodBankstatus'] = $this->input->post('bloodbank_chk');
            $data['amobulancestatus'] = $this->input->post('ambulance_chk');
            
            $data['hospital_id'] = $this->input->post('hospital_id');
            $data['allStates'] = $this->Hospital_model->fetchStates();
            $data['title'] = 'Add Hospital';
            $this->load->super_admin_template('AddHospital', $data, 'hospitalScript');
        } else {

            $imagesname = "";
            if ($_FILES['avatar_file']['name']) {
                $path = realpath(FCPATH . 'assets/hospitalsImages/');
                $upload_data = $this->input->post('avatar_data');
                $upload_data = json_decode($upload_data);
                $original_imagesname = $this->uploadImageWithThumb($upload_data, 'avatar_file', $path, 'assets/hospitalsImages/', './assets/hospitalsImages/thumb/', 'hospital');

                if (empty($original_imagesname)) {
                    $data['hospitalType'] = $this->Hospital_model->getHospitalType();
                    
                    $option = array(
                        'table' => 'qyura_membership',
                        'select' => 'membership_id,membership_name',
                        'where' => array('membership_deleted' => 0, 'status' => 3, 'membership_type' => 1)
                    );
                    $data['membership_plan'] = $this->common_model->customGet($option);

                    $option = array(
                        'table' => 'qyura_facilities',
                        'select' => '*',
                        'where' => array('qyura_facilities.facilities_deleted' => 0),
                        'order' => array('facilities_name' => 'asc'),
                        'single' => FALSE
                    );
                    $data['facilities_list'] = $this->common_model->customGet($option);
        
                    $data['allCountry'] = $this->Hospital_model->fetchCountry();
                    $data['allStates'] = $this->Bloodbank_model->fetchStates();
                    $this->session->set_flashdata('valid_upload', $this->error_message);
                    $data['title'] = 'Add Hospital';
                    $this->load->super_admin_template('AddHospital', $data, 'hospitalScript');
                    return false;
                } else {
                    $imagesname = $original_imagesname;
                }
            }

            $hospital_id = $this->input->post('hospital_id');
            $hospital_name = $this->input->post('hospital_name');
            $hospital_type = $this->input->post('hospital_type');
            $hospital_address = $this->input->post('hospital_address');
            $isManual = $this->input->post('isManual');
            $hospital_phn = ltrim($this->input->post('hospital_phn'), 0);
            $hospital_cntPrsn = $this->input->post('hospital_cntPrsn');
            $hospital_dsgn = $this->input->post('hospital_dsgn');
            $hospital_mmbrTyp = $this->input->post('hospital_mmbrTyp');
            $hospital_countryId = $this->input->post('hospital_countryId');
            $hospital_stateId = $this->input->post('hospital_stateId');
            $hospital_cityId = $this->input->post('hospital_cityId');
            $hospital_mblNo = $this->input->post('hospital_mblNo');
            $hospital_aboutUs = $this->input->post('hospital_aboutUs');
            $hospital_zip = $this->input->post('hospital_zip');
            $isBloodBankOutsource = $this->input->post('isBloodBankOutsource');
            $docatId = $this->input->post('docatId');
            
            $inserData = array(
                'hospital_name' => $hospital_name,
                'hospital_type' => $hospital_type,
                'hospital_address' => $hospital_address,
                'isManual' => $isManual,
                'hospital_phn' => $hospital_phn,
               // 'hospital_mbl' => $hospital_mbl,
                'hospital_cntPrsn' => $hospital_cntPrsn,
                'hospital_dsgn' => $hospital_dsgn,
                'hospital_mmbrTyp' => $hospital_mmbrTyp,
                'hospital_mmbrStart' => strtotime(date("Y-m-d H:i:s")),
                'hospital_countryId' => $hospital_countryId,
                'hospital_stateId' => $hospital_stateId,
                'hospital_cityId' => $hospital_cityId,
                'hospital_aboutUs' => $hospital_aboutUs,
                'hospital_img' => $imagesname,
                'creationTime' => strtotime(date("Y-m-d H:i:s")),
                'hospital_mblNo' => $hospital_mblNo,
                'hospital_lat' => $this->input->post('lat'),
                'hospital_long' => $this->input->post('lng'),
                'isEmergency' => isset($_POST['isEmergency'])? $this->input->post('isEmergency') : 0,
                'availibility_24_7' => isset($_POST['availibility_24_7'])? $this->input->post('availibility_24_7') : 0,
                'hospital_zip' => $hospital_zip,
                'isBloodBankOutsource' => $isBloodBankOutsource,
                'hasBloodbank' =>isset($_POST['bloodbank_chk'])? $this->input->post('bloodbank_chk') : 0,
                'hasPharmacy' => isset($_POST['pharmacy_chk'])? $this->input->post('pharmacy_chk') : 0,
                'docatId' => $docatId,
            );
            $users_email_status = $this->input->post('users_email_status');
            if ($users_email_status == '') {
                $users_email = $this->input->post('users_email');
                $users_password = $this->input->post('users_password');
                $hospitalInsert = array(
                    'users_email' => $users_email,
                    'users_password' => $this->common_model->encryptPassword($users_password),
                    'users_ip_address' => $this->input->ip_address(),
                    'users_mobile' => $this->input->post('hospital_mblNo'),
                    'creationTime' => strtotime(date("Y-m-d H:i:s"))
                );
                
                $hospital_usersId = $this->Hospital_model->inserHospitalUser($hospitalInsert);
                $usersRoles_parentId = 0;
            } else {
                $hospital_usersId = $users_email_status;
                $usersRoles_parentId = $users_email_status;
            }
            
            if ($hospital_usersId) {

                $inserData['hospital_usersId'] = $hospital_usersId;
                
                $from = "suport@qyura.com";
                $title = "QYURA TEAM";
                $to = $this->input->post('users_email');
                $subject = "Conguratilation! Welcome to Qyura";
                $msg = "Hello " . $hospital_name."/n"
                        . "Email : ".$this->input->post('users_email')."/n"
                        . "Password : " .$this->input->post('users_password');
                if(isset($_POST['users_email']) && $_POST['users_email'] != '')
                    $this->send_mail($from,$to,$subject,$title,$msg);
                 
                 
                if($hospital_id == 0){
                     $inserData['status'] = 0;
                     $hospitalId = $this->Hospital_model->insertHospital($inserData);
                }elseif($hospital_id != 0 && $hospital_id != '' && $hospital_id != NULL){
                     $hospitalId = $hospital_id;
                     unset($inserData['creationTime']);
                     $inserData['modifyTime'] = strtotime(date("Y-m-d H:i:s"));
                     $inserData['status'] = 0;
                     $where = array(
                        'hospital_id' => $hospital_id
                    );
                    $response = $this->Hospital_model->UpdateTableData($inserData, $where, 'qyura_hospital');
                }
                
                
                
                 //membership
                        $feci_count = $this->input->post("faci_count");
                        for($i=1;$i<=$feci_count;$i++){
                            $insert_rec = array(
                                'miMembership_type' => 9,
                                'miMembership_miId' => $hospital_usersId,
                                'miMembership_facilitiesId' => $this->input->post("checkbox_$i"),
                                'miMembership_quantity' => $this->input->post("membership_quantity_$i"),
                                'creationTime' => strtotime(date("d-m-Y H:i:s")),
                            );
                            if($i == 1 || $i == 2){
                                $insert_rec['miMembership_duration'] = $this->input->post("membership_duration_$i");
                            }
                            $dayOptions = array
                            (
                                'data' => $insert_rec,
                                'table' => 'qyura_miMembership'
                            );
                            $this->common_model->customInsert($dayOptions);
                        }
                //membership
                
                $insertusersRoles = array(
                    'usersRoles_userId' => $hospital_usersId,
                    'usersRoles_roleId' => 1,
                    'usersRoles_parentId' => $usersRoles_parentId,
                    'creationTime' => strtotime(date("Y-m-d H:i:s"))
                );
                $this->Hospital_model->insertUsersRoles($insertusersRoles);
                unset($insertusersRoles);
                if (isset($_POST['hospitalServices_serviceName'])) {
                    $finalNumber = '';
                    $countserviceName = $_POST['serviceName'];
                    $hospitalServices_serviceName = $_POST['hospitalServices_serviceName'];
                    for ($i = 0; $i < $countserviceName; $i++) {
                        if ($hospitalServices_serviceName[$i] != '') {
                            $finalhospitalServices_serviceName = $hospitalServices_serviceName[$i];
                            $hospitalServicesData = array(
                                'hospitalServices_hospitalId' => $hospitalId,
                                'hospitalServices_serviceName' => $finalhospitalServices_serviceName,
                                'hospitalServices_deleted' => 0,
                                'creationTime' => strtotime(date("Y-m-d H:i:s"))
                            );
                            $this->Hospital_model->insertHospitalServiceName($hospitalServicesData);
                        }
                        $hospitalServicesData = '';
                    }
                }
                if ($_POST['bloodbank_chk'] == 1) {

                   $bloodBank_phn = $this->input->post('bloodBank_phn');
                   
                   $bloodBankImagesname = "";
                        if ($_FILES['bloodBank_photo']['name']) {
                            $path = realpath(FCPATH . 'assets/BloodBank/');
                            $upload_data = $this->input->post('avatar_data_bloodbank');
                            $upload_data = json_decode($upload_data);

                            $original_imagesname_bloodbank = $this->uploadImageWithThumb($upload_data, 'bloodBank_photo', $path, 'assets/BloodBank/', './assets/BloodBank/thumb/', 'blood');
                           
                            if (empty($original_imagesname_bloodbank)) {
                                $data['hospitalType'] = $this->Hospital_model->getHospitalType();
                                $data['allCountry'] = $this->Hospital_model->fetchCountry();
                                $data['allStates'] = $this->Bloodbank_model->fetchStates();
                                $this->session->set_flashdata('valid_upload', $this->error_message);
                                $data['title'] = 'Add Hospital';
                                $this->load->super_admin_template('AddHospital', $data, 'hospitalScript');
                                return false;
                            } else {
                                $bloodBankImagesname = $original_imagesname_bloodbank;
                            }
                        }
                        
                    $bloodBank_name = $this->input->post('bloodBank_name');
                    $bloodBank_photo = $this->input->post('bloodBank_photo');
                    $bloodBank_lat = $this->input->post('lat');
                    $bloodBank_long = $this->input->post('lng');

                    $bloodBankDetail = array(
                        'bloodBank_name' => $bloodBank_name,
                        'bloodBank_photo' => $bloodBankImagesname,
                        'bloodBank_lat' => $bloodBank_lat,
                        'bloodBank_long' => $bloodBank_long,
                        'users_id' => $hospital_usersId,
                        'creationTime' => strtotime(date("Y-m-d H:i:s")),
                        'bloodBank_phn' => ltrim($bloodBank_phn, 0),
                        'countryId' => $hospital_countryId,
                        'bloodBank_cntPrsn' => $hospital_cntPrsn,
                        'stateId' => $hospital_stateId,
                        'cityId' => $hospital_cityId,
                        'bloodBank_add' => $hospital_address,
                        'inherit_status' => 1,
                        'status' => 0,
                        'bloodBank_zip' => $hospital_zip,
                        'bloodBank_docatId' => $docatId
                    );
                    $bloodBankId = $this->Hospital_model->insertBloodbank($bloodBankDetail);
                    if ($bloodBankId) {
                        $insertusersRoles = array(
                            // 'usersRoles_userId' => $bloodBankId, // As per Mahipal's suggetion
                            'usersRoles_userId' => $hospital_usersId,
                            'usersRoles_roleId' => 2,
                            'usersRoles_parentId' => $hospital_usersId,
                            'creationTime' => strtotime(date("Y-m-d H:i:s"))
                        );

                        $this->Hospital_model->insertUsersRoles($insertusersRoles);

                        unset($insertusersRoles);

                        $conditions = array();
                        $conditions['bloodCat_deleted'] = 0;
                        $select = array('bloodCat_name', 'bloodCat_id');
                        $bloodBankCatData = $this->Bloodbank_model->fetchTableData($select, 'qyura_bloodCat', $conditions);

                        foreach ($bloodBankCatData as $key => $val) {
                            $bloodCatData = array(
                                'bloodBank_id' => $hospital_usersId,
                                'bloodCats_id' => $val->bloodCat_id,
                                'bloodCatBank_Unit' => 0,
                                'creationTime' => strtotime(date("Y-m-d H:i:s"))
                            );
                            $this->Hospital_model->insertTableData('qyura_bloodCatBank', $bloodCatData);
                            $bloodCatData = '';
                        }
                    }
                }

             


                if ($_POST['ambulance_chk'] == 1) {

                    $ambulance_phn = $this->input->post('ambulance_phn');
                    
                    $ambulanceImagesname = "";
                        if ($_FILES['ambulance_photo']['name']) {
                            $path = realpath(FCPATH . 'assets/ambulanceImages/');
                            $upload_data = $this->input->post('avatar_data_ambulance');
                            $upload_data = json_decode($upload_data);
                            $original_imagesname_ambulance = $this->uploadImageWithThumb($upload_data, 'ambulance_photo', $path, 'assets/ambulanceImages/', './assets/ambulanceImages/thumb/', 'ambulance');

                            if (empty($original_imagesname_ambulance)) {
                                   $data['hospitalType'] = $this->Hospital_model->getHospitalType();
                                    $data['allCountry'] = $this->Hospital_model->fetchCountry();
                                    $data['allStates'] = $this->Bloodbank_model->fetchStates();
                                    $this->session->set_flashdata('valid_upload', $this->error_message);
                                    $data['title'] = 'Add Hospital';
                                    $this->load->super_admin_template('AddHospital', $data, 'hospitalScript');
                                    return false;
                            } else {
                                $ambulanceImagesname = $original_imagesname_ambulance;
                            }
                        }
            
                    $ambulance_name = $this->input->post('ambulance_name');
                    $ambulance_img = $this->input->post('ambulance_img');
                    $ambulance_lat = $this->input->post('lat');
                    $ambulance_long = $this->input->post('lng');
                    $docOnBoard = $this->input->post('docOnBoard');

                    $ambulanceDetail = array(
                        'ambulance_name' => $ambulance_name,
                        'ambulance_img' => $ambulanceImagesname,
                        'ambulance_lat' => $ambulance_lat,
                        'ambulance_long' => $ambulance_long,
                        'ambulance_usersId' => $hospital_usersId,
                        'creationTime' => strtotime(date("Y-m-d H:i:s")),
                        'ambulance_phn' => ltrim($ambulance_phn, 0),
                        'ambulance_countryId' => $hospital_countryId,
                        'ambulance_stateId' => $hospital_stateId,
                        'ambulance_cityId' => $hospital_cityId,
                        'ambulance_address' => $hospital_address,
                        'ambulance_cntPrsn' => $hospital_cntPrsn,
                        'inherit_status' => 1,
                        'status' => 0,
                        'ambulance_zip' => $hospital_zip,
                        'docOnBoard' => $docOnBoard,
                        'ambulance_docatId' => $docatId
                    );
                    $ambulanceId = $this->Hospital_model->insertAmbulance($ambulanceDetail);
                    if ($ambulanceId) {
                        $insertusersRoles3 = array(
                            //'usersRoles_userId' => $ambulanceId,// As per Mahipal's suggetion
                            'usersRoles_userId' => $hospital_usersId,
                            'usersRoles_roleId' => 8,
                            'usersRoles_parentId' => $hospital_usersId,
                            'creationTime' => strtotime(date("Y-m-d H:i:s"))
                        );

                        $this->Hospital_model->insertUsersRoles($insertusersRoles3);

                        unset($insertusersRoles3);
                    }
                }
                $this->session->set_flashdata('message', 'Data inserted successfully !');
                redirect('hospital');
            }
        }


        // print_r($imageUrl);exit;
    }

    function getImageBase64Code($img) {
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $img = str_replace('[removed]', '', $img);
        $data = base64_decode($img);
        return $data;
    }

    function check_email() {
        $user_table_id = '';
        $users_email = $this->input->post('users_email');
        if (isset($_POST['user_table_id'])) {
            $user_table_id = $this->input->post('user_table_id');
        }
        $email = $this->Hospital_model->fetchEmail($users_email, $user_table_id);

        if ($email == 1)
            echo $email;
        else {
            $select = array('users_id');
            $where = array('users_email' => $users_email,
                'users_deleted' => 0);
            $return = $this->Hospital_model->fetchTableData($select, 'qyura_users', $where);
            $data = 0;
            if (!empty($return)) {
                $data = $return[0]->users_id;
                echo $data;
            } else {
                echo $data;
            }
        }
        exit;
    }

    function saveDetailHospital($hospitalId) {
        
      //  dump($_POST); exit;

        $this->bf_form_validation->set_rules('hospital_name', 'Hospital Name', 'required|trim');

        $this->bf_form_validation->set_rules('hospital_address', 'Hospital Address', 'required|trim');
        //$this->bf_form_validation->set_rules('users_email','Users Email','required|valid_email|trim');
        $this->bf_form_validation->set_rules('hospital_cntPrsn', 'Hospital Contact Person', 'required|trim');
        $this->bf_form_validation->set_rules('hospital_dsgn', 'Hospital Contact Person', 'required|trim');

        $this->bf_form_validation->set_rules('hospital_countryId', 'Hospital country', 'required|trim');
        $this->bf_form_validation->set_rules('hospital_stateId', 'Hospital state', 'required|trim');
        $this->bf_form_validation->set_rules('hospital_cityId', 'Hospital city', 'required|trim');
        $this->bf_form_validation->set_rules('hospital_zip', 'Hospital Zip', 'required|trim|max_length[6]|min_length[6]');

        $this->bf_form_validation->set_rules('isManual', 'Manual', 'trim|required');

        $this->bf_form_validation->set_rules('lat', 'Latitude', 'required|trim');
        $this->bf_form_validation->set_rules('lng', 'Longitude', 'required|trim');

       // $this->bf_form_validation->set_rules('hospital_mbl', 'Mobile No', 'required|trim');

        $this->bf_form_validation->set_rules('hospital_aboutUs', 'about us', 'required|trim');
        
        $this->bf_form_validation->set_rules('hospital_phn', 'Hospital Phon No.', 'required|trim|max_length[10]|min_length[10]');
        $this->bf_form_validation->set_rules('docatId', 'Docat id', 'trim');


        if ($this->bf_form_validation->run($this) === FALSE) {

            $data = array();
            $data['hospitalData'] = $this->Hospital_model->fetchHospitalData($hospitalId);

            $data['allCountry'] = $this->Hospital_model->fetchCountry();
            $data['allCities'] = $this->Hospital_model->fetchCity($data['hospitalData'][0]->hospital_stateId);
            $data['allStates'] = $this->Hospital_model->fetchStates($data['hospitalData'][0]->hospital_countryId);

            $data['hospitalId'] = $hospitalId;
            $data['showStatus'] = 'none';
            $data['detailShow'] = 'block';
            $data['active'] = 'general';
            $insurance_condition = '';
            $data['insurance'] = $this->Hospital_model->fetchInsurance($hospitalId);
            
//            $option = array(
//                'table' => 'qyura_hospitalTimeSlot',
//                'where' => array(
//                    'hospitalTimeSlot_hospitalId' => $hospitalId,
//                    'hospitalTimeSlot_deleted' => 0
//                )
//            );
//            $data['AlltimeSlot'] = $this->Hospital_model->customGet($option);

            $data['gallerys'] = $this->Hospital_model->customGet(array('table' => 'qyura_hospitalImages', 'where' => array('hospitalImages_hospitalId' => $hospitalId, 'hospitalImages_deleted' => 0)));
            if (!empty($data['insurance'])) {
                foreach ($data['insurance'] as $key => $val) {
                    $insurance_condition[] = $val->hospitalInsurance_insuranceId;
                }
            }

            $data['allInsurance'] = $this->Hospital_model->fetchAllInsurance($insurance_condition);

            $this->session->set_flashdata('message', 'some error occurred !');

            $data['title'] = 'Hospital Detail';
            $this->load->super_admin_template('hospitalDetail', $data, 'hospitalScript');


            return false;
        } else {
          
            $hospital_address = $this->input->post('hospital_address');
            $isManual = $this->input->post('isManual');
            $hospital_lat = $this->input->post('lat');
            $hospital_long = $this->input->post('lng');
            $isBloodBankOutsource = $this->input->post('isBloodBankOutsource');
            

            
            $updateHospital = array(
                'hospital_name' => $this->input->post('hospital_name'),
                'hospital_aboutUs' => $this->input->post('hospital_aboutUs'),
                'hospital_type' => $this->input->post('hospital_type'),
                'hospital_countryId' => $this->input->post('hospital_countryId'),
                'hospital_stateId' => $this->input->post('hospital_stateId'),
                'hospital_cityId' => $this->input->post('hospital_cityId'),
                'hospital_zip' => $this->input->post('hospital_zip'),
              //  'hospital_mbl' => $this->input->post('hospital_mbl'),
                'hospital_address' => $hospital_address,
                'isManual' => $isManual,
                'hospital_phn' => ltrim($this->input->post('hospital_phn'),0),
                'hospital_cntPrsn' => $this->input->post('hospital_cntPrsn'),
                'hospital_dsgn' => $this->input->post('hospital_dsgn'),
                'isEmergency' => isset($_POST['isEmergency'])? $this->input->post('isEmergency') : 0,
                'hospital_lat' => $hospital_lat,
                'hospital_long' => $hospital_long,
                'modifyTime' => strtotime(date("Y-m-d H:i:s")),
                'hospital_dsgn' => $this->input->post('hospital_dsgn'),
                'isBloodBankOutsource' => $isBloodBankOutsource,
                'availibility_24_7' => isset($_POST['availibility_24_7'])? $this->input->post('availibility_24_7') : 0,
                'hasBloodbank' => isset($_POST['bloodbank_chk'])? $this->input->post('bloodbank_chk') : 0,
                'hasPharmacy' => isset($_POST['pharmacy_chk'])? $this->input->post('pharmacy_chk') : 0,
                'docatId' => $this->input->post('docatId'),
            );
            //  print_r($updateHospital); exit;
            $where = array(
                'hospital_id' => $hospitalId
            );
            $response = '';

            //  print_r($updateHospital); exit; 
            $response = $this->Hospital_model->UpdateTableData($updateHospital, $where, 'qyura_hospital');
          //  echo $this->db->last_query(); exit;
            /* $updateUserdata = array(
              'users_email' => $this->input->post('users_email'),
              'modifyTime'=> strtotime(date("Y-m-d H:i:s"))
              );
              $whereUser = array(
              'users_id' => $this->input->post('user_tables_id')
              );
              $response = $this->Hospital_model->UpdateTableData($updateUserdata,$whereUser,'qyura_users');

             */
            if ($response) {
                if (isset($_POST['bloodbank_chk']) == 1) {

                    $bloodBank_phn = $this->input->post('bloodBank_phn');
                    $conditions = array();
                    $conditions['users_id'] = $this->input->post('user_tables_id');
                    $conditions['bloodBank_deleted'] = 0;
                    $select = array('bloodBank_id');
                    $getData = '';
                    $getData = $this->Hospital_model->fetchTableData($select, 'qyura_bloodBank', $conditions);

                    $bloodBankDetail = array(
                        'countryId' => $this->input->post('hospital_countryId'),
                        'stateId' => $this->input->post('hospital_stateId'),
                        'cityId' => $this->input->post('hospital_cityId'),
                        'bloodBank_name' => $this->input->post('bloodBank_name'),
                        'bloodBank_lat' => $hospital_lat,
                        'bloodBank_long' => $hospital_long,
                        'bloodBank_add' => $hospital_address,
                        'bloodBank_phn' => ltrim($bloodBank_phn, 0),
                        'bloodBank_docatId' => $this->input->post('docatId'),
                        'bloodBank_cntPrsn' => $this->input->post('hospital_cntPrsn'),
                        'modifyTime' => strtotime(date("Y-m-d H:i:s"))
                    );
                    if ($getData) {
                        $bloodWhereUser = array(
                            'users_id' => $this->input->post('user_tables_id')
                        );
                        //$bloodBankId = $this->Hospital_model->insertBloodbank($bloodBankDetail);
                        $this->Hospital_model->UpdateTableData($bloodBankDetail, $bloodWhereUser, 'qyura_bloodBank');
                        // echo $this->db->last_query(); exit;
                    } else {

                        //unset($select,$conditions);
                        $conditionsSecond = array();
                        $conditionsSecond['hospital_usersId'] = $this->input->post('user_tables_id');
                        $conditionsSecond['hospital_deleted'] = 0;
                        $selectSecond = array('hospital_countryId,hospital_stateId,hospital_cityId,hospital_zip');
                        $bloodBankResult = $this->Hospital_model->fetchTableData($selectSecond, 'qyura_hospital', $conditionsSecond);
                       // echo $this->db->last_query(); exit;
                        $bloodBankDetail['countryId'] = $bloodBankResult[0]->hospital_countryId;
                        $bloodBankDetail['stateId'] = $bloodBankResult[0]->hospital_stateId;
                        $bloodBankDetail['cityId'] = $bloodBankResult[0]->hospital_cityId;
                        $bloodBankDetail['users_id'] = $this->input->post('user_tables_id');
                        $bloodBankDetail['creationTime'] = strtotime(date("Y-m-d H:i:s"));
                        $bloodBankDetail['inherit_status'] = 1;
                        $bloodBankDetail['bloodBank_zip'] = $bloodBankResult[0]->hospital_zip;
                        
                       $bloodBankImagesname = "";
                        if ($_FILES['bloodBank_photo']['name']) {
                            $path = realpath(FCPATH . 'assets/BloodBank/');
                            $upload_data = $this->input->post('avatar_data_bloodbank');
                            $upload_data = json_decode($upload_data);

                            $original_imagesname_bloodbank = $this->uploadImageWithThumb($upload_data, 'bloodBank_photo', $path, 'assets/BloodBank/', './assets/BloodBank/thumb/', 'blood');
                           
                            if (empty($original_imagesname_bloodbank)) {
                                        $data = array();
                                        $data['hospitalData'] = $this->Hospital_model->fetchHospitalData($hospitalId);

                                        $data['allCountry'] = $this->Hospital_model->fetchCountry();
                                        $data['allCities'] = $this->Hospital_model->fetchCity($data['hospitalData'][0]->hospital_stateId);
                                        $data['allStates'] = $this->Hospital_model->fetchStates($data['hospitalData'][0]->hospital_countryId);

                                        $data['hospitalId'] = $hospitalId;
                                        $data['showStatus'] = 'none';
                                        $data['detailShow'] = 'block';
                                        $data['active'] = 'general';
                                        $insurance_condition = '';
                                        $data['insurance'] = $this->Hospital_model->fetchInsurance($hospitalId);
                                        $data['gallerys'] = $this->Hospital_model->customGet(array('table' => 'qyura_hospitalImages', 'where' => array('hospitalImages_hospitalId' => $hospitalId, 'hospitalImages_deleted' => 0)));
                                        if (!empty($data['insurance'])) {
                                            foreach ($data['insurance'] as $key => $val) {
                                                $insurance_condition[] = $val->hospitalInsurance_insuranceId;
                                            }
                                        }

                                        $data['allInsurance'] = $this->Hospital_model->fetchAllInsurance($insurance_condition);

                                        $this->session->set_flashdata('message', 'some error occurred !');

                                        $data['title'] = 'Hospital Detail';
                                        $this->load->super_admin_template('hospitalDetail', $data, 'hospitalScript');
                                        return false;
                            } else {
                                $bloodBankImagesname = $original_imagesname_bloodbank;
                            }
                        }
                        $bloodBankDetail['bloodBank_photo'] = $bloodBankImagesname;
                        $bloodBankDetail['status'] = 0;
                        $bloodBankId = $this->Hospital_model->insertBloodbank($bloodBankDetail);

                        $conditions = array();
                        $conditions['bloodCat_deleted'] = 0;
                        $select = array('bloodCat_name', 'bloodCat_id');
                        $bloodBankCatData = $this->Bloodbank_model->fetchTableData($select, 'qyura_bloodCat', $conditions);

                        foreach ($bloodBankCatData as $key => $val) {
                            $bloodCatData = array(
                                'bloodBank_id' => $this->input->post('user_tables_id'),
                                'bloodCats_id' => $val->bloodCat_id,
                                'bloodCatBank_Unit' => 0,
                                'creationTime' => strtotime(date("Y-m-d H:i:s"))
                            );
                            $this->Hospital_model->insertTableData('qyura_bloodCatBank', $bloodCatData);
                            $bloodCatData = '';
                        }
                    }
                } else {
                    $bloodWhereUser = array(
                        'users_id' => $this->input->post('user_tables_id')
                    );
                    $this->Hospital_model->deleteTable('qyura_bloodBank', $bloodWhereUser);

                    $bloodCatDataDelete = array(
                        'bloodBank_id' => $this->input->post('user_tables_id'),
                    );
                    $this->Hospital_model->deleteTable('qyura_bloodCatBank', $bloodCatDataDelete);
                }

                
                if (isset($_POST['ambulance_chk']) == 1) {

                    $ambulance_phn = $this->input->post('ambulance_phn');
                
                    $ambulance_name = $this->input->post('ambulance_name');
                    $docOnBoard = $this->input->post('docOnBoard');
                    
                    //echo $finalAmbulanceNumber;exit;
                    $ambulance_lat = $hospital_lat;
                    $ambulance_long = $hospital_long;

                    $ambulanceDetail = array(
                        'ambulance_countryId' => $this->input->post('hospital_countryId'),
                        'ambulance_stateId' => $this->input->post('hospital_stateId'),
                        'ambulance_cityId' => $this->input->post('hospital_cityId'),
                        'ambulance_name' => $ambulance_name,
                        'ambulance_lat' => $ambulance_lat,
                        'ambulance_long' => $ambulance_long,
                        'ambulance_usersId' => $this->input->post('user_tables_id'),
                        'creationTime' => strtotime(date("Y-m-d H:i:s")),
                        'ambulance_phn' => ltrim($ambulance_phn, 0),
                        'ambulance_address' => $hospital_address,
                        'docOnBoard' => $docOnBoard,
                        'ambulance_docatId' => $this->input->post('docatId'),
                        'ambulance_cntPrsn' => $this->input->post('hospital_cntPrsn'),
                    );
                    
                    $ambulanceConditions = array();
                    $ambulanceConditions['ambulance_usersId'] = $this->input->post('user_tables_id');
                    $ambulanceConditions['ambulance_deleted'] = 0;
                    $ambulanceSelect = array('ambulance_id');
                    $getDataAmbulance = '';
                    $getDataAmbulance = $this->Hospital_model->fetchTableData($ambulanceSelect, 'qyura_ambulance', $ambulanceConditions);

                    if ($getDataAmbulance) {
                        $ambulanceWhereUser = array(
                            'ambulance_usersId' => $this->input->post('user_tables_id')
                        );
                        // print_r($ambulanceDetail);exit;
                        $this->Hospital_model->UpdateTableData($ambulanceDetail, $ambulanceWhereUser, 'qyura_ambulance');
                    } else {
                        unset($ambulanceSelect, $ambulanceConditions);
                        $ambulanceConditions = array();
                        $ambulanceConditions['hospital_usersId'] = $this->input->post('user_tables_id');
                        $ambulanceConditions['hospital_deleted'] = 0;
                        $ambulanceSelect = array('hospital_countryId,hospital_stateId,hospital_cityId,hospital_zip');
                        $ambulanceResult = $this->Hospital_model->fetchTableData($ambulanceSelect, 'qyura_hospital', $ambulanceConditions);
                        $ambulanceDetail['ambulance_countryId'] = $ambulanceResult[0]->hospital_countryId;
                        $ambulanceDetail['ambulance_stateId'] = $ambulanceResult[0]->hospital_stateId;
                        $ambulanceDetail['ambulance_cityId'] = $ambulanceResult[0]->hospital_cityId;
                        $ambulanceDetail['inherit_status'] = 1;
                        $ambulanceDetail['creationTime'] = strtotime(date("Y-m-d H:i:s"));
                        $ambulanceDetail['ambulance_usersId'] = $this->input->post('user_tables_id');
                        $ambulanceDetail['ambulance_zip'] = $ambulanceResult[0]->hospital_zip;
                        
                        $ambulanceImagesname = "";
                        if ($_FILES['ambulance_photo']['name']) {
                            $path = realpath(FCPATH . 'assets/ambulanceImages/');
                            $upload_data = $this->input->post('avatar_data_ambulance');
                            $upload_data = json_decode($upload_data);
                            $original_imagesname_ambulance = $this->uploadImageWithThumb($upload_data, 'ambulance_photo', $path, 'assets/ambulanceImages/', './assets/ambulanceImages/thumb/', 'ambulance');

                            if (empty($original_imagesname_ambulance)) {
                                        $data = array();
                                        $data['hospitalData'] = $this->Hospital_model->fetchHospitalData($hospitalId);

                                        $data['allCountry'] = $this->Hospital_model->fetchCountry();
                                        $data['allCities'] = $this->Hospital_model->fetchCity($data['hospitalData'][0]->hospital_stateId);
                                        $data['allStates'] = $this->Hospital_model->fetchStates($data['hospitalData'][0]->hospital_countryId);

                                        $data['hospitalId'] = $hospitalId;
                                        $data['showStatus'] = 'none';
                                        $data['detailShow'] = 'block';
                                        $data['active'] = 'general';
                                        $insurance_condition = '';
                                        $data['insurance'] = $this->Hospital_model->fetchInsurance($hospitalId);
                                        $data['gallerys'] = $this->Hospital_model->customGet(array('table' => 'qyura_hospitalImages', 'where' => array('hospitalImages_hospitalId' => $hospitalId, 'hospitalImages_deleted' => 0)));
                                        if (!empty($data['insurance'])) {
                                            foreach ($data['insurance'] as $key => $val) {
                                                $insurance_condition[] = $val->hospitalInsurance_insuranceId;
                                            }
                                        }

                                        $data['allInsurance'] = $this->Hospital_model->fetchAllInsurance($insurance_condition);

                                        $this->session->set_flashdata('message', 'some error occurred !');

                                        $data['title'] = 'Hospital Detail';
                                        $this->load->super_admin_template('hospitalDetail', $data, 'hospitalScript');
                                        return false;
                            } else {
                                $ambulanceImagesname = $original_imagesname_ambulance;
                            }
                        }
                        $ambulanceDetail['ambulance_img'] = $ambulanceImagesname;
                        $ambulanceDetail['status'] = 0;
                        $ambulanceId = $this->Hospital_model->insertAmbulance($ambulanceDetail);
                    }
                } else {
                    $ambulanceWhereUser = array(
                        'ambulance_usersId' => $this->input->post('user_tables_id')
                    );
                    $this->Hospital_model->deleteTable('qyura_ambulance', $ambulanceWhereUser);
                }
                $this->session->set_flashdata('message', 'Data updated successfully !');
                redirect("hospital/detailHospital/$hospitalId/general");
            }
        }
    }

    function updatePassword() {
  
        $user_tables_id = $this->input->post('hospitalUserId');
        $users_password = $this->input->post('users_password');

        $users_mobile = ltrim($this->input->post('users_mobile'),0);
      //  $hospital_mmbrTyp = $this->input->post('hospital_mmbrTyp');
      
        $where = array(
            'users_id' => $user_tables_id
        );
        $userTableData = array(
            'users_mobile' => $users_mobile,
            // 'users_email' => $users_email,
            'modifyTime' => strtotime(date("Y-m-d H:i:s"))
        );
        $return = $this->Hospital_model->UpdateTableData($userTableData, $where, 'qyura_users');
        if (!empty($users_password)) {
            $encrypted = $this->common_model->encryptPassword($users_password);
            $updateHospital = array(
                'users_password' => $encrypted,
                'modifyTime' => strtotime(date("Y-m-d H:i:s"))
            );


           echo  $return = $this->Hospital_model->UpdateTableData($updateHospital, $where, 'qyura_users');
            $from = "suport@qyura.com";
            $title = "QYURA TEAM";
            $to = $this->input->post('users_email');
            $subject = "Conguratilation! Welcome to Qyura";
            $msg = "Hello /n"
                    . "Email : ".$this->input->post('users_email')."/n"
                    . "Your New Password : " .$this->input->post('users_password');
            if(isset($users_password) && $users_password != '')
                $this->send_mail($from,$to,$subject,$title,$msg);
        }

      
    }

    function hospitalSpecialities($hospitalId) {
        $hospitalSeleted = array(
            'hospitalSpecialities_id', 'hospitalSpecialities_specialitiesId'
        );
        $hospitalWhere = array(
            'hospitalSpecialities_deleted' => 0,
            'hospitalSpecialities_hospitalId' => $hospitalId
        );
        $notIn = '';
        $hospitalData = $this->Hospital_model->fetchTableData($hospitalSeleted, 'qyura_hospitalSpecialities', $hospitalWhere);
        foreach ($hospitalData as $key => $val) {
            $notIn [] = $val->hospitalSpecialities_specialitiesId;
        }

        $selectTableData = array(
            'specialities_id', 'specialities_name'
        );
        $where = array(
            'specialities_deleted' => 0,
        );
        $data = $this->Hospital_model->fetchTableData($selectTableData, 'qyura_specialities', $where, $notIn, 'specialities_id');
        $specialist = '';
        foreach ($data as $key => $val) {
            $specialist .='<li >' . $val->specialities_name . '<input type=checkbox class="specialityCheck myCheckbox" name=speciality value=' . $val->specialities_id . ' /></li>';
        }

        echo $specialist;
        exit;
    }

    function hospitalDiagnostics($hospitalId) {

        $hospitalDiagnostics = array(
            'hospitalDiagnosticsCat_hospitalId', 'hospitalDiagnosticsCat_diagnosticsCatId'
        );
        $DiagnosticsWhere = array(
            'hospitalDiagnosticsCat_deleted' => 0,
            'hospitalDiagnosticsCat_hospitalId' => $hospitalId
        );
        $notIn = '';
        $DiagnosticsData = $this->Hospital_model->fetchTableData($hospitalDiagnostics, 'qyura_hospitalDiagnosticsCat', $DiagnosticsWhere);
        foreach ($DiagnosticsData as $key => $val) {
            $notIn [] = $val->hospitalDiagnosticsCat_diagnosticsCatId;
        }

        $selectTableData = array(
            'diagnosticsCat_catId', 'diagnosticsCat_catName'
        );
        $where = array(
            'diagnosticsCat_deleted' => 0,
        );
        $data = $this->Hospital_model->fetchTableData($selectTableData, 'qyura_diagnosticsCat', $where, $notIn, 'diagnosticsCat_catId');
        $diagnostic = '';
        foreach ($data as $key => $val) {
            $diagnostic .='<li >' . $val->diagnosticsCat_catName . '<input type=checkbox class=diagonasticCheck name=speciality value=' . $val->diagnosticsCat_catId . ' /></li>';
        }

        echo $diagnostic;
        exit;
    }

    function addDiagnostic() {
        $hospitalId = $this->input->post('hospitalId');
        $hospitalDiagnosticsCat_diagnosticsCatId = $this->input->post('hospitalDiagnosticsCat_diagnosticsCatId');
        $insertData = array(
            'hospitalDiagnosticsCat_diagnosticsCatId' => $hospitalDiagnosticsCat_diagnosticsCatId,
            'hospitalDiagnosticsCat_hospitalId' => $hospitalId,
            'hospitalDiagnosticsCat_deleted' => 0,
            'creationTime' => strtotime(date("Y-m-d H:i:s"))
        );
        $return = $this->Hospital_model->insertTableData('qyura_hospitalDiagnosticsCat', $insertData);
        echo $return;
        exit;
    }
    
    
     function checkSpeciality() {
        $hospitalId = $this->input->post('hospitalId');
        $hospitalUserId = $this->input->post('hospitalUserId');
       // $allValuers = explode(',',$this->input->post('allValuers'));
        
        $sql = 'select hospitalSpecialities_id from qyura_hospitalSpecialities where hospitalSpecialities_hospitalId = '.$hospitalId.' AND hospitalSpecialities_deleted = 0 ';
        
        $numRows = $this->common_model->customQueryCount($sql);
        
        $benifitSpeciality = "select miMembership_quantity from qyura_miMembership where miMembership_miId = $hospitalUserId AND miMembership_deleted = 0 AND miMembership_facilitiesId = 1 AND miMembership_type = 9";
        $benifitSpecialityResult = $this->common_model->customQuery($benifitSpeciality, true);
        
        if($numRows >= $benifitSpecialityResult->miMembership_quantity){
             echo 0; exit;
        }else{
            echo 1; exit;
        }
    }

    function addSpeciality() {
        $hospitalId = $this->input->post('hospitalId');
        $hospitalUserId = $this->input->post('hospitalUserId');
        
        $hospitalSpecialities_specialitiesId = $this->input->post('hospitalSpecialities_specialitiesId');
        
        $sql = 'select hospitalSpecialities_id from qyura_hospitalSpecialities where hospitalSpecialities_hospitalId = '.$hospitalId.' AND hospitalSpecialities_deleted = 0 ';
        
        $numRows = $this->common_model->customQueryCount($sql);
        
        $benifitSpeciality = "select miMembership_quantity from qyura_miMembership where miMembership_miId = $hospitalUserId AND miMembership_deleted = 0 AND miMembership_facilitiesId = 1 AND miMembership_type = 9";
        
        $benifitSpecialityResult = $this->common_model->customQuery($benifitSpeciality, true);
        
       // echo $this->db->last_query(); exit;
        if($numRows >= $benifitSpecialityResult->miMembership_quantity){
             echo 0; exit;
        }else{
            $insertData = array(
                'hospitalSpecialities_specialitiesId' => $hospitalSpecialities_specialitiesId,
                'hospitalSpecialities_hospitalId' => $hospitalId,
                'hospitalSpecialities_deleted' => 0,
                'creationTime' => strtotime(date("Y-m-d H:i:s"))
            );
            $return = $this->Hospital_model->insertTableData('qyura_hospitalSpecialities', $insertData);
            echo $return;
            exit;
        }
    }

    function hospitalAllocatedSpecialities($hospitalId) {

        $data = $this->Hospital_model->fetchhospitalSpecialityData($hospitalId);
        $allocatedSpecialist = '';
        foreach ($data as $key => $val) {
            $allocatedSpecialist .='<li id="'.$val->hospitalSpecialities_id.'">' . $val->specialities_name . '<input type=checkbox class=specialityAllocCheck name=allocSpeciality value=' . $val->hospitalSpecialities_id . ' /></li>';
        }
        echo $allocatedSpecialist;
        exit;
    }

    function hospitalSpecialitiesOrder()
    {
        
        if(!empty($_POST))
            {
                $count=0;
                foreach($_POST as $hospitalSpecialities_id => $order)
                {
                    
                    $hospitalSpecialitiesData = array('hospitalSpecialities_orderForHos'=>$order);
                    $con = array('hospitalSpecialities_id'=>$hospitalSpecialities_id);
                    $return = $this->Hospital_model->UpdateTableData($hospitalSpecialitiesData, $con, 'qyura_hospitalSpecialities');
                    
                    if($return)
                        $count++;
                }
                if($count==  count($_POST))
                    echo 1;
                
            }
            else
            {
                echo 0;
            }
    }

    function hospitalFetchDiagnostics($hospitalId) {
        $data = $this->Hospital_model->fetchhospitalDiagonasticData($hospitalId);
        $allocatedSpecialist = '';
        foreach ($data as $key => $val) {
            $allocatedSpecialist .='<li onclick=showDiagonasticDetail(' . $hospitalId . ',' . $val->hospitalDiagnosticsCat_diagnosticsCatId . ')>' . $val->diagnosticsCat_catName . '<input type=checkbox class=diagonasticAllocCheck name=allocdiagonastic value=' . $val->hospitalDiagnosticsCat_id . ' /></li>';
        }
        echo $allocatedSpecialist;
        exit;
    }

    function revertDiagnostic() {
        $hospitalId = $this->input->post('hospitalId');
        $hospitalDiagnosticsCat_id = $this->input->post('hospitalDiagnosticsCat_id');
        $diagonasticData = array(
            'hospitalDiagnosticsCat_deleted' => 1,
            'modifyTime' => strtotime(date("Y-m-d H:i:s"))
        );
        $diagonasticWhere = array('hospitalDiagnosticsCat_id' => $hospitalDiagnosticsCat_id, 'hospitalDiagnosticsCat_hospitalId' => $hospitalId);
        $return = $this->Hospital_model->UpdateTableData($diagonasticData, $diagonasticWhere, 'qyura_hospitalDiagnosticsCat');
        echo $return;
    }

    function revertSpeciality() {
        $hospitalId = $this->input->post('hospitalId');
        $hospitalSpecialities_id = $this->input->post('hospitalSpecialities_id');
        $hospitalData = array(
            'hospitalSpecialities_deleted' => 1,
            'modifyTime' => strtotime(date("Y-m-d H:i:s"))
        );
        $hospitalWhere = array('hospitalSpecialities_id' => $hospitalSpecialities_id, 'hospitalSpecialities_hospitalId' => $hospitalId);
        $return = $this->Hospital_model->UpdateTableData($hospitalData, $hospitalWhere, 'qyura_hospitalSpecialities');
        echo $return;
    }

    function detailDiagnostic() {
        $hospitalId = $this->input->post('hospitalId');
        $categoryId = $this->input->post('categoryId');
        $selectTableData = array(
            'quotationDetailTests_testName', 'quotationDetailTests_price', 'quotationDetailTests_id'
        );
        $where = array(
            'quotationDetailTests_diagnosticCatId' => $categoryId,
            'quotationDetailTests_MIprofileId' => $hospitalId,
            'quotationDetailTests_deleted' => 0
        );
        $data = $this->Hospital_model->fetchTableData($selectTableData, 'qyura_quotationDetailTests', $where);
        //echo $data;exit;
        $diagonasticTest = '';
        foreach ($data as $key => $val) {
            $diagonasticTest .='<tr > <td onclick = fetchInstruction(' . $val->quotationDetailTests_id . ') id=preName_' . $val->quotationDetailTests_id . '>' . $val->quotationDetailTests_testName . '</td><td style="display: none;" id=actulName_' . $val->quotationDetailTests_id . '> <input id=Names_' . $val->quotationDetailTests_id . ' type=text value="' . $val->quotationDetailTests_testName . '"> </td><td id=prePrice_' . $val->quotationDetailTests_id . '><i class="fa fa-inr"></i> <a data-title="Enter username" data-pk="1" data-type="text" class="editable editable-click editable-open"  title="" aria-describedby="popover939766">' . $val->quotationDetailTests_price . '</a></td><td style="display: none;" onkeypress="return isNumberKey(event)" id=actulPrice_' . $val->quotationDetailTests_id . '> <input type=text id=price_' . $val->quotationDetailTests_id . ' value=' . $val->quotationDetailTests_price . '></td>';
            $diagonasticTest .= '</td><td ><a "display:block;" id=editdata class="btn btn-success waves-effect waves-light m-b-5 " onclick="showDetail(' . $val->quotationDetailTests_id . ')" >Edit</a> <a id=updateData style="display:none;" class="btn btn-success waves-effect waves-light m-b-5" onclick="sendDetail(' . $val->quotationDetailTests_id . ',' . $hospitalId . ',' . $categoryId . ')" >Update</a></td></tr>';
        }
        echo $diagonasticTest;
        exit;
    }

    function detailDiagnosticInstruction() {
        $quotationDetailTests_id = $this->input->post('quotationDetailTests_id');
        $selectTableData = array(
            'quotationDetailTests_instruction'
        );
        $where = array(
            'quotationDetailTests_id' => $quotationDetailTests_id,
            'quotationDetailTests_deleted' => 0
        );
        $data = $this->Hospital_model->fetchTableData($selectTableData, 'qyura_quotationDetailTests', $where);
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

        if ($_POST['avatar_file_gallery']['name']) {
            $path = realpath(FCPATH . 'assets/hospitalsImages/');
            $upload_data = $this->input->post('avatar_data_gallery');
            $upload_data = json_decode($upload_data);
            $original_imagesname = $this->uploadImageWithThumb($upload_data, 'avatar_file_gallery', $path, 'assets/hospitalsImages/', './assets/hospitalsImages/thumb/', 'hospital');

            if (empty($original_imagesname)) {
                $response = array('state' => 400, 'message' => $this->error_message);
            } else {

                $option = array(
                    'hospitalImages_ImagesName' => $original_imagesname,
                    'hospitalImages_hospitalId' => $this->input->post('avatar_id'),
                    'creationTime' => strtotime(date("Y-m-d H:i:s"))
                );
                $options = array(
                    'table' => 'qyura_hospitalImages',
                    'data' => $option
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
                'hospitalImages_hospitalId' => $id,
                'hospitalImages_deleted' => 0
            );
            $options = array(
                'table' => 'qyura_hospitalImages',
                'where' => $where
            );
            $gallerys = $this->Hospital_model->customGet($options);
            if ($gallerys) {
                foreach ($gallerys as $gallery) {
                    $gallery_template.='<aside class="col-md-3 col-sm-4 col-xs-6 show-image">
                                                <img width="210" class="thumbnail img-responsive" src="' . base_url() . '/assets/hospitalsImages/thumb/original/' . $gallery->hospitalImages_ImagesName . '">
                                                <a class="delete" onClick="deleteGalleryImage(' . $gallery->hospitalImages_id . ')"> <i class="fa fa-times fa-2x"></i></a>
                                            </aside>';
                }
            } else {
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
            'table' => 'qyura_hospitalImages',
            'where' => $updatedDataWhere,
            'data' => $updatedData
        );
        $return = $this->Hospital_model->customUpdate($option);
        echo $return;
        exit;
    }

//    function hospitalAddTimeSlot($hospitalId) {
//
//        $this->bf_form_validation->set_rules('morningStartTime', 'Morning Start Time', 'required|trim');
//        $this->bf_form_validation->set_rules('morningEndTime', 'Morning End Time', 'required|trim');
//
//        $this->bf_form_validation->set_rules('afternoonStartTime', 'Afternoon End Time', 'required|trim');
//        $this->bf_form_validation->set_rules('afternoonEndTime', 'Afternoon End Time', 'required|trim');
//
//        $this->bf_form_validation->set_rules('eveningStartTime', 'Evening End Time', 'required|trim');
//        $this->bf_form_validation->set_rules('eveningEndTime', 'Evening End Time', 'required|trim');
//
//        // $this->bf_form_validation->set_rules('nightStartTime', 'Night End Time', 'required|trim');
//        //  $this->bf_form_validation->set_rules('nightEndTime', 'Night End Time', 'required|trim');
//
//        if ($this->bf_form_validation->run() === FALSE) {
//            $data = array();
//            $data['hospitalData'] = $this->Hospital_model->fetchHospitalData($hospitalId);
//            $data['hospitalType'] = $this->Hospital_model->getHospitalType();
//            $data['allCountry'] = $this->Hospital_model->fetchCountry();
//            $data['allCities'] = $this->Hospital_model->fetchCity($data['hospitalData'][0]->hospital_stateId);
//            $data['allStates'] = $this->Hospital_model->fetchStates($data['hospitalData'][0]->hospital_countryId);
//
//            $data['hospitalId'] = $hospitalId;
//            $data['showStatus'] = 'none';
//            $data['detailShow'] = 'block';
//            $insurance_condition = '';
//            $data['insurance'] = $this->Hospital_model->fetchInsurance($hospitalId);
//            $option = array(
//                'table' => 'qyura_hospitalTimeSlot',
//                'where' => array(
//                    'hospitalTimeSlot_hospitalId' => $hospitalId,
//                    'hospitalTimeSlot_deleted' => 0
//                )
//            );
//            $data['AlltimeSlot'] = $this->Hospital_model->customGet($option);
//
//            $data['gallerys'] = $this->Hospital_model->customGet(array('table' => 'qyura_hospitalImages', 'where' => array('hospitalImages_hospitalId' => $hospitalId, 'hospitalImages_deleted' => 0)));
//            if (!empty($data['insurance'])) {
//                foreach ($data['insurance'] as $key => $val) {
//                    $insurance_condition[] = $val->hospitalInsurance_insuranceId;
//                }
//            }
//
//            $data['allInsurance'] = $this->Hospital_model->fetchAllInsurance($insurance_condition);
//
//            // $this->load->super_admin_template('hospitalDetail', $data, 'bloodBankScript');
//            //$this->load->view('hospitalDetail',$data);
//            $data['title'] = 'Hospital Detail';
//            $this->load->super_admin_template('hospitalDetail', $data, 'hospitalScript');
//        } else {
//
//            $morningSession = $this->input->post('morningSession');
//            $afternoonSession = $this->input->post('afternoonSession');
//            $eveningSession = $this->input->post('eveningSession');
//            $nightSession = $this->input->post('nightSession');
//
//            if ($_POST['morningStartTime'] && $_POST['morningEndTime'] && $_POST['hospitalId']) {
//                $insertData = array(
//                    'hospitalTimeSlot_hospitalId' => $this->input->post('hospitalId'),
//                    'hospitalTimeSlot_startTime' => date('H:i:s', strtotime($this->input->post('morningStartTime'))),
//                    'hospitalTimeSlot_endTime' => date('H:i:s', strtotime($this->input->post('morningEndTime'))),
//                    'hospitalTimeSlot_sessionType' => $morningSession,
//                    'hospitalTimeSlot_deleted' => 0,
//                    'creationTime' => strtotime(date("Y-m-d H:i:s")),
//                    'status' => 1
//                );
//                $option = array(
//                    'table' => 'qyura_hospitalTimeSlot',
//                    'data' => $insertData
//                );
//                $this->Hospital_model->customInsert($option);
//            }
//
//            if ($_POST['afternoonStartTime'] && $_POST['afternoonEndTime'] && $_POST['hospitalId']) {
//                $insertData = array(
//                    'hospitalTimeSlot_hospitalId' => $this->input->post('hospitalId'),
//                    'hospitalTimeSlot_startTime' => date('H:i:s', strtotime($this->input->post('afternoonStartTime'))),
//                    'hospitalTimeSlot_endTime' => date('H:i:s', strtotime($this->input->post('afternoonEndTime'))),
//                    'hospitalTimeSlot_sessionType' => $afternoonSession,
//                    'hospitalTimeSlot_deleted' => 0,
//                    'creationTime' => strtotime(date("Y-m-d H:i:s")),
//                    'status' => 1
//                );
//                $option = array(
//                    'table' => 'qyura_hospitalTimeSlot',
//                    'data' => $insertData
//                );
//                $this->Hospital_model->customInsert($option);
//            }
//
//            if ($_POST['eveningStartTime'] && $_POST['eveningEndTime'] && $_POST['hospitalId']) {
//                $insertData = array(
//                    'hospitalTimeSlot_hospitalId' => $this->input->post('hospitalId'),
//                    'hospitalTimeSlot_startTime' => date('H:i:s', strtotime($this->input->post('eveningStartTime'))),
//                    'hospitalTimeSlot_endTime' => date('H:i:s', strtotime($this->input->post('eveningEndTime'))),
//                    'hospitalTimeSlot_sessionType' => $eveningSession,
//                    'hospitalTimeSlot_deleted' => 0,
//                    'creationTime' => strtotime(date("Y-m-d H:i:s")),
//                    'status' => 1
//                );
//                $option = array(
//                    'table' => 'qyura_hospitalTimeSlot',
//                    'data' => $insertData
//                );
//                $this->Hospital_model->customInsert($option);
//            }
//
//            /*  if ($_POST['nightStartTime'] && $_POST['nightEndTime'] && $_POST['hospitalId']) {
//              $insertData = array(
//              'hospitalTimeSlot_hospitalId' => $this->input->post('hospitalId'),
//              'hospitalTimeSlot_startTime' => date('H:i:s', strtotime($this->input->post('nightStartTime'))),
//              'hospitalTimeSlot_endTime' => date('H:i:s', strtotime($this->input->post('nightEndTime'))),
//              'hospitalTimeSlot_sessionType' => $nightSession,
//              'hospitalTimeSlot_deleted' => 0,
//              'creationTime' => strtotime(date("Y-m-d H:i:s")),
//              'status' => 1
//              );
//              $option = array(
//              'table' => 'qyura_hospitalTimeSlot',
//              'data' => $insertData
//              );
//              $this->Hospital_model->customInsert($option);
//              }
//             * */
//
//            $this->session->set_flashdata('message', 'Your Time Slot has been successfully Added!');
//            redirect("hospital/detailHospital/$hospitalId");
//        }
//    }

//    function UpdateHospitalTimeSlot($hospitalId) {
//
//        $this->bf_form_validation->set_rules('morningStartTime', 'Morning Start Time', 'required|trim');
//        $this->bf_form_validation->set_rules('morningEndTime', 'Morning End Time', 'required|trim');
//
//        $this->bf_form_validation->set_rules('afternoonStartTime', 'Afternoon End Time', 'required|trim');
//        $this->bf_form_validation->set_rules('afternoonEndTime', 'Afternoon End Time', 'required|trim');
//
//        $this->bf_form_validation->set_rules('eveningStartTime', 'Evening End Time', 'required|trim');
//        $this->bf_form_validation->set_rules('eveningEndTime', 'Evening End Time', 'required|trim');
//
//        // $this->bf_form_validation->set_rules('nightStartTime', 'Night End Time', 'required|trim');
//        //   $this->bf_form_validation->set_rules('nightEndTime', 'Night End Time', 'required|trim');
//
//        if ($this->bf_form_validation->run() === FALSE) {
//            $data = array();
//            $data['hospitalData'] = $this->Hospital_model->fetchHospitalData($hospitalId);
//            $data['hospitalType'] = $this->Hospital_model->getHospitalType();
//            $data['allCountry'] = $this->Hospital_model->fetchCountry();
//            $data['allCities'] = $this->Hospital_model->fetchCity($data['hospitalData'][0]->hospital_stateId);
//            $data['allStates'] = $this->Hospital_model->fetchStates($data['hospitalData'][0]->hospital_countryId);
//
//            $data['hospitalId'] = $hospitalId;
//            $data['showStatus'] = 'none';
//            $data['detailShow'] = 'block';
//            $data['showTimeSlot'] = 'active';
//            $data['showTimeSlotBox'] = 'active';
//            $insurance_condition = '';
//            $data['insurance'] = $this->Hospital_model->fetchInsurance($hospitalId);
//            $option = array(
//                'table' => 'qyura_hospitalTimeSlot',
//                'where' => array(
//                    'hospitalTimeSlot_hospitalId' => $hospitalId,
//                    'hospitalTimeSlot_deleted' => 0
//                )
//            );
//            $data['AlltimeSlot'] = $this->Hospital_model->customGet($option);
//
//            $data['gallerys'] = $this->Hospital_model->customGet(array('table' => 'qyura_hospitalImages', 'where' => array('hospitalImages_hospitalId' => $hospitalId, 'hospitalImages_deleted' => 0)));
//            if (!empty($data['insurance'])) {
//                foreach ($data['insurance'] as $key => $val) {
//                    $insurance_condition[] = $val->hospitalInsurance_insuranceId;
//                }
//            }
//
//            $data['allInsurance'] = $this->Hospital_model->fetchAllInsurance($insurance_condition);
//
//            // $this->load->super_admin_template('hospitalDetail', $data, 'bloodBankScript');
//            //$this->load->view('hospitalDetail',$data);
//            $data['title'] = 'Hospital Detail';
//            $this->load->super_admin_template('hospitalDetail', $data, 'hospitalScript');
//        } else {
//
//
//            $morningSession = $this->input->post('morningSession');
//            $afternoonSession = $this->input->post('afternoonSession');
//            $eveningSession = $this->input->post('eveningSession');
//            //   $nightSession = $this->input->post('nightSession');
//
//            if ($_POST['morningStartTime'] && $_POST['morningEndTime'] && $_POST['hospitalId']) {
//                $insertData = array(
//                    'hospitalTimeSlot_startTime' => date('H:i:s', strtotime($this->input->post('morningStartTime'))),
//                    'hospitalTimeSlot_endTime' => date('H:i:s', strtotime($this->input->post('morningEndTime')))
//                );
//                $option = array(
//                    'table' => 'qyura_hospitalTimeSlot',
//                    'data' => $insertData,
//                    'where' => array(
//                        'hospitalTimeSlot_sessionType' => $morningSession,
//                        'hospitalTimeSlot_hospitalId' => $this->input->post('hospitalId')
//                    )
//                );
//                $this->Hospital_model->customUpdate($option);
//            }
//
//            if ($_POST['afternoonStartTime'] && $_POST['afternoonEndTime'] && $_POST['hospitalId']) {
//                $insertData = array(
//                    'hospitalTimeSlot_startTime' => date('H:i:s', strtotime($this->input->post('afternoonStartTime'))),
//                    'hospitalTimeSlot_endTime' => date('H:i:s', strtotime($this->input->post('afternoonEndTime'))),
//                );
//                $option = array(
//                    'table' => 'qyura_hospitalTimeSlot',
//                    'data' => $insertData,
//                    'where' => array(
//                        'hospitalTimeSlot_sessionType' => $afternoonSession,
//                        'hospitalTimeSlot_hospitalId' => $this->input->post('hospitalId')
//                    )
//                );
//                $this->Hospital_model->customUpdate($option);
//            }
//
//            if ($_POST['eveningStartTime'] && $_POST['eveningEndTime'] && $_POST['hospitalId']) {
//                $insertData = array(
//                    'hospitalTimeSlot_startTime' => date('H:i:s', strtotime($this->input->post('eveningStartTime'))),
//                    'hospitalTimeSlot_endTime' => date('H:i:s', strtotime($this->input->post('eveningEndTime')))
//                );
//                $option = array(
//                    'table' => 'qyura_hospitalTimeSlot',
//                    'data' => $insertData,
//                    'where' => array(
//                        'hospitalTimeSlot_sessionType' => $eveningSession,
//                        'hospitalTimeSlot_hospitalId' => $this->input->post('hospitalId')
//                    )
//                );
//                $this->Hospital_model->customUpdate($option);
//            }
//
//            /* if ($_POST['nightStartTime'] && $_POST['nightEndTime'] && $_POST['hospitalId']) {
//              $insertData = array(
//              'hospitalTimeSlot_startTime' => date('H:i:s', strtotime($this->input->post('nightStartTime'))),
//              'hospitalTimeSlot_endTime' => date('H:i:s', strtotime($this->input->post('nightEndTime')))
//              );
//              $option = array(
//              'table' => 'qyura_hospitalTimeSlot',
//              'data' => $insertData,
//              'where' => array(
//              'hospitalTimeSlot_sessionType' => $nightSession,
//              'hospitalTimeSlot_hospitalId' => $this->input->post('hospitalId')
//              )
//              );
//              $this->Hospital_model->customUpdate($option);
//              } */
//
//            $this->session->set_flashdata('message', 'Your Time Slot has been successfully update!');
//            redirect("hospital/detailHospital/$hospitalId/timeslot");
//        }
//    }

    function updateDiagonasticTest() {
        $quotationDetailTests_testName = $this->input->post('quotationDetailTests_testName');
        //echo $quotationDetailTests_testName;exit;
        $quotationDetailTests_price = $this->input->post('quotationDetailTests_price');
        $quotationDetailTests_id = $this->input->post('quotationDetailTests_id');
        $quotationData = array(
            'quotationDetailTests_testName' => $quotationDetailTests_testName,
            'quotationDetailTests_price' => $quotationDetailTests_price,
            'modifyTime' => strtotime(date("Y-m-d H:i:s"))
        );
        $quotationWhere = array('quotationDetailTests_id' => $quotationDetailTests_id);
        $return = $this->Hospital_model->UpdateTableData($quotationData, $quotationWhere, 'qyura_quotationDetailTests');
        echo $return;
        exit;
    }

    function updateDiagonasticInstruction() {
        $quotationDetailTests_id = $this->input->post('quotationDetailTests_id');
        $quotationDetailTests_instruction = $this->input->post('detailsAll');
        $quotationData = array(
            'quotationDetailTests_instruction' => $quotationDetailTests_instruction,
            'modifyTime' => strtotime(date("Y-m-d H:i:s"))
        );
        $quotationWhere = array('quotationDetailTests_id' => $quotationDetailTests_id);
        $return = $this->Hospital_model->UpdateTableData($quotationData, $quotationWhere, 'qyura_quotationDetailTests');
        echo $return;
        exit;
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
            $path = realpath(FCPATH . 'assets/hospitalsImages/');
            $upload_data = $this->input->post('avatar-data');
            $upload_data = json_decode($upload_data);
            
           // echo $upload_data->width; exit;
            if ($upload_data->width > 425) {
                $original_imagesname = $this->uploadImageWithThumb($upload_data, 'avatar_file', $path, 'assets/hospitalsImages/', './assets/hospitalsImages/thumb/', 'hospital');

                if (empty($original_imagesname)) {
                    $response = array('state' => 400, 'message' => $this->error_message);
                } else {

                    $option = array(
                        'hospital_img' => $original_imagesname,
                        'modifyTime' => strtotime(date("Y-m-d H:i:s"))
                    );
                    $where = array(
                        'hospital_id' => $this->input->post('avatar_id')
                    );
                    $response = $this->Hospital_model->UpdateTableData($option, $where, 'qyura_hospital');
                    if ($response) {
                         $response = array('state' => 200, 'message' => 'Successfully update avtar','image'=>base_url("assets/hospitalsImages/thumb/thumb_100/{$original_imagesname}"),'reset'=>"hospital_edit", 'returnClass'  => 'logo-img');
                    } else {
                        $response = array('state' => 400, 'message' => 'Failed to update avtar');
                    }
                }
            } else {
                $response = array('state' => 400, 'message' => 'Height and Width must exceed 150px.');
            }
            echo json_encode($response);
        } else {
            $response = array('state' => 400, 'message' => 'Please select avtar');
            echo json_encode($response);
        }
    }
    
  


    function getUpdateAvtar($id) {
        if (!empty($id)) {
            $data['hospitalData'] = $this->Hospital_model->fetchHospitalData($id);
            //  print_r($data); exit;
            echo "<img src='" . base_url() . "assets/hospitalsImages/thumb/original/" . $data['hospitalData'][0]->hospital_img . "'alt='' class='logo-img' />";
            exit();
        }
    }
    
    
    function editUploadImageAmbulance() {
        
        if ($_POST['avatar_file']['name']) {
            $path = realpath(FCPATH . 'assets/ambulanceImages/');
            $upload_data = $this->input->post('avatar-data');
            
            $upload_data = json_decode($upload_data);
           
            if ($upload_data->width > 425) {
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
                    $response = $this->Hospital_model->UpdateTableData($option, $where, 'qyura_ambulance');
                    
                    if ($response) {
                        $response = array('state' => 200, 'message' => 'Successfully update avtar','image'=>base_url("assets/ambulanceImages/thumb/thumb_100/{$original_imagesname}"),'reset'=>"ambulance_edit", 'returnClass'  => 'logo-img-ambulance');
                    } else {
                        $response = array('state' => 400, 'message' => 'Failed to update avtar');
                    }
                }
            } else {
                $response = array('state' => 400, 'message' => 'Height and Width must exceed 150px.');
            }
            echo json_encode($response);
        } else {
            $response = array('state' => 400, 'message' => 'Please select avtar');
            echo json_encode($response);
        }
    }
    
      function getUpdateAvtarAmbulance($id) {
        if (!empty($id)) {
            $data['hospitalData'] = $this->Hospital_model->fetchHospitalData($id);
            //  print_r($data); exit;
            echo "<img src='" . base_url() . "assets/ambulanceImages/thumb/original/" . $data['hospitalData'][0]->ambulance_img . "'alt='' class='logo-img-ambulance' />";
            exit();
        }
    }
    
    
      function editUploadImageBloodbank() {
        
        if ($_POST['avatar_file']['name']) {
            $path = realpath(FCPATH . 'assets/BloodBank/');
            $upload_data = $this->input->post('avatar-data');
            
            $upload_data = json_decode($upload_data);
           // dump($upload_data); exit;
            if ($upload_data->width > 425) {
                $original_imagesname = $this->uploadImageWithThumb($upload_data, 'avatar_file', $path, 'assets/BloodBank/', './assets/BloodBank/thumb/', 'blood');

                if (empty($original_imagesname)) {
                    $response = array('state' => 400, 'message' => $this->error_message);
                } else {

                    $option = array(
                        'bloodBank_photo' => $original_imagesname,
                        'modifyTime' => strtotime(date("Y-m-d H:i:s"))
                    );
                    $where = array(
                        'bloodBank_id' => $this->input->post('avatar_id')
                    );
                    $response = $this->Hospital_model->UpdateTableData($option, $where, 'qyura_bloodBank');
                    
                    if ($response) {
                        $response = array('state' => 200, 'message' => 'Successfully update avtar','image'=>base_url("assets/BloodBank/thumb/thumb_100/{$original_imagesname}"),'reset'=>"bloodbank_edit", 'returnClass'  => 'logo-img-bloodbank');
                    } else {
                        $response = array('state' => 400, 'message' => 'Failed to update avtar');
                    }
                }
            } else {
                $response = array('state' => 400, 'message' => 'Height and Width must exceed 150px.');
            }
            echo json_encode($response);
        } else {
            $response = array('state' => 400, 'message' => 'Please select avtar');
            echo json_encode($response);
        }
    }
    
     function getUpdateAvtarBloodbank($id) {
        if (!empty($id)) {
            $data['hospitalData'] = $this->Hospital_model->fetchHospitalData($id);
            //  print_r($data); exit;
            echo "<img src='" . base_url() . "assets/BloodBank/thumb/original/" . $data['hospitalData'][0]->bloodBank_photo . "'alt='' class='logo-img-bloodbank' />";
            exit();
        }
    }
    
    
     function editUploadImageDoctor() {
        
        if ($_POST['avatar_file']['name']) {
            $path = realpath(FCPATH . 'assets/doctorsImages/');
            $upload_data = $this->input->post('avatar-data');
            
            $upload_data = json_decode($upload_data);
           // dump($upload_data); exit;
            if ($upload_data->width > 425) {
                $original_imagesname = $this->uploadImageWithThumb($upload_data, 'avatar_file', $path, 'assets/doctorsImages/', './assets/doctorsImages/thumb/', 'doctor');

                if (empty($original_imagesname)) {
                    $response = array('state' => 400, 'message' => $this->error_message);
                } else {

                    $option = array(
                        'doctors_img' => $original_imagesname,
                        'modifyTime' => strtotime(date("Y-m-d H:i:s"))
                    );
                    $where = array(
                        'doctors_id' => $this->input->post('avatar_id')
                    );
                    $response = $this->Hospital_model->UpdateTableData($option, $where, 'qyura_doctors');
                    
                    if ($response) {
                        $response = array('state' => 200, 'message' => 'Successfully update avtar','image'=>base_url("assets/doctorsImages/thumb/thumb_100/{$original_imagesname}"),'reset'=>"doctor_edit", 'returnClass'  => 'logo-img-doctor');
                    } else {
                        $response = array('state' => 400, 'message' => 'Failed to update avtar');
                    }
                }
            } else {
                $response = array('state' => 400, 'message' => 'Height and Width must exceed 150px.');
            }
            echo json_encode($response);
        } else {
            $response = array('state' => 400, 'message' => 'Please select avtar');
            echo json_encode($response);
        }
    }
    
     function getUpdateAvtarDoctor($id) {
        if (!empty($id)) {
            $data['doctorData'] = $this->Hospital_model->getDoctorDeatil($id);
            //  print_r($data); exit;
            echo "<img src='" . base_url() . "assets/doctorsImages/thumb/original/" . $data['doctorData'][0]->doctors_img . "'alt='' class='logo-img-doctor' />";
            exit();
        }
    }

    function createCSV() {

        $hospital_stateId = '';
        $hospital_cityId = '';
        $search = '';

        if (isset($_POST['hospital_stateId']))
            $hospital_stateId = $this->input->post('hospital_stateId');

        if (isset($_POST['hospital_cityId']))
            $hospital_cityId = $this->input->post('hospital_cityId');

        if (isset($_POST['search']))
            $search = $this->input->post('search');
        $orWhere = array('hospital_name' => $search, 'hospital_phn' => $search, 'hospital_address' => $search);

        $where = array('hospital_deleted' => 0, 'hospital_cityId' => $hospital_cityId, 'hospital_stateId' => $hospital_stateId);
        $array[] = array('Hospital Name', 'City', 'Phone Number', 'Address');
        $data = $this->Hospital_model->createCSVdata($where, $orWhere);

        $arrayFinal = array_merge($array, $data);

        array_to_csv($arrayFinal, 'HospitalDetail.csv');
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

    function hospitalBackgroundUpload($hospitalId) {
        if (isset($_FILES["file"]["name"])) {

            $temp = explode(".", $_FILES['file']["name"]);
            $microtime = round(microtime(true));
            $imageName = "hospital";
            $newfilename = "" . $imageName . "_" . $microtime . '.' . end($temp);
            $uploadData = $this->uploadImages('file', 'hospitalsImages', $newfilename);
            if ($uploadData['status']) {
                $imageName = $uploadData['imageData']['file_name'];

                $data = array('hospital_background_img' => $imageName);
                $where = array('hospital_id' => $hospitalId);

                $response = $this->Hospital_model->UpdateTableData($data, $where, 'qyura_hospital');
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

    function getBackgroundImage($hospitalId) {
        $select = array('hospital_background_img');
        $where = array('hospital_id' => $hospitalId);

        $response = $this->Hospital_model->fetchTableData($select, 'qyura_hospital', $where);
        if ($response) {
            echo $image = base_url() . 'assets/hospitalsImages/' . $response[0]->hospital_background_img;
        }
        exit;
    }

    function map($id) {

        $table = 'qyura_hospital';
        $select = array('hospital_lat,hospital_long,hospital_address,hospital_name,hospital_img');
        $where = array('hospital_id' => $id);

        $data['mapData'] = $this->Hospital_model->fetchTableData($select, 'qyura_hospital', $where);
        $data['title'] = 'Hospital Map';
        $this->load->super_admin_template('map', $data, 'hospitalScript');
    }

    function check_email_exits() {
        $user_table_id = '';
        $users_email = $this->input->post('users_email');
        $hospiId = $this->input->post("hospiId");

        $option = array(
            'table' => 'qyura_users',
            'select' => '*',
            'join' => array(
                array('qyura_usersRoles', 'qyura_usersRoles.usersRoles_userId = qyura_users.users_id', 'left'),
            ),
            'where' => array('qyura_users.users_deleted' => 0, 'qyura_usersRoles.usersRoles_deleted' => 0, 'qyura_users.users_email' => $users_email, 'qyura_usersRoles.usersRoles_roleId' => 4),
            'single' => FALSE
        );
        $email = $this->common_model->customGet($option);
        //echo $this->db->last_query();exit;
        $data = 0;
        if (!empty($email)) {
            $option = array(
                'table' => 'qyura_usersRoles',
                'select' => '*',
                'where' => array('qyura_usersRoles.usersRoles_deleted' => 0, 'qyura_usersRoles.usersRoles_userId' => $email[0]->users_id, 'qyura_usersRoles.usersRoles_roleId' => 4, 'qyura_usersRoles.usersRoles_parentId' => $hospiId, 'qyura_usersRoles.usersRoles_parentRole' => 1),
                'single' => FALSE
            );
            $userRoles = $this->common_model->customGet($option);
            if ($userRoles == NULL) {
                echo $data = $email[0]->users_id;
            } else {
                echo $data = "already";
            }
        } else {
            echo $data;
        }
        exit;
    }

    function addHospiDoc() {
        //print_r($_POST);exit;
        $this->bf_form_validation->set_rules("docId", "Doctor Id", 'required|xss_clean');
        $this->bf_form_validation->set_rules("hospiId", "Hospital Id", 'required|xss_clean');

        if ($this->bf_form_validation->run($this) == FALSE) {
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => ajax_validation_errors());
            echo json_encode($responce);
        } else {
            $hospiAjaxId = $this->input->post('ajaxHospiId');
            $hospiId = $this->input->post('hospiId');
            $records_array = array(
                'usersRoles_userId' => $this->input->post('docId'),
                'usersRoles_roleId' => 4,
                'usersRoles_parentId' => $this->input->post('hospiId'),
                'usersRoles_parentRole' => 1,
                'creationTime' => strtotime(date("d-m-Y H:i:s"))
            );
            $options = array
                (
                'data' => $records_array,
                'table' => 'qyura_usersRoles'
            );
            $add_insert_new = $this->common_model->customInsert($options);
            if ($add_insert_new) {

                $responce = array('status' => 1, 'msg' => "Doctor Added successfully", 'url' => "hospital/detailHospital/$hospiAjaxId");
            } else {
                $error = array("TopError" => "<strong>Something went wrong while updating your data... sorry.</strong>");
                $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $error);
            }
            echo json_encode($responce);
        }
    }

    function isValidLatitude($latitude) {
        if (preg_match("/^-?([1-8]?[1-9]|[1-9]0)\.{1}\d{2,20}$/", $latitude)) {

            return true;
        } else {
            $this->bf_form_validation->set_message('isValidLatitude', 'Please enter the correct format for latitude');
            return false;
        }
    }

    function isValidLongitude($longitude) {
        if (preg_match("/^-?([1]?[1-7][1-9]|[1]?[1-8][0]|[1-9]?[0-9])\.{1}\d{2,20}$/", $longitude)) {
            return true;
        } else {
            $this->bf_form_validation->set_message('isValidLongitude', 'Please enter the correct format for longitude');
            return false;
        }
    }

    function activeDeactive() {

        $id = $this->input->post('id');
        $status = $this->input->post('status');

        if ($status == 1) {
            $setStatus = 0;
        } else {
            $setStatus = 1;
        }
        $option = array(
            'table' => 'qyura_hospital',
            'data' => array('status' => $setStatus),
            'where' => array('hospital_id' => $id)
        );
        $response = $this->common_model->customUpdate($option);
       // echo $this->db->last_query(); exit;

        if ($response) {
            echo 1;
        } else {
            echo 0;
        }
    }
    
    
    function getHospitaldetail(){
        $hospitalId = $this->input->post('hospitalId');
        if($hospitalId != ''){
            $response = $this->Hospital_model->getHospitaldetail($hospitalId);
        }
    }
    
    function setSpecialityNameFormate(){
        $hospitalId = $this->input->post('hospitalId');
        $specialityFormate = $this->input->post('specialityFormate');
        
        if($hospitalId != ''){
            $option = array(
                'table' => 'qyura_hospital',
                'where' => array('hospital_id' => $hospitalId),
                'data' => array('specialityNameFormate' => $specialityFormate)
            );
           echo $response = $this->Hospital_model->customUpdate($option);
        }
    }
    
    
    // doctor methods
    
    function saveDoctor() {
       // print_r($_POST);exit;
       
        $this->bf_form_validation->set_rules('doctors_fName', 'Doctors First Name', 'required|trim');
        $this->bf_form_validation->set_rules('doctors_lName', 'Doctors Last Name', 'required|trim');
       
        
        $this->bf_form_validation->set_rules('doctors_phn', 'Doctor Mobile', 'trim|numeric');
        $this->bf_form_validation->set_rules('users_email', 'Users Email', "valid_email|trim");//||MUnique[{$Moption}]
       
      //  if (empty($_FILES['avatar_file']['name'])) {
      //      $this->bf_form_validation->set_rules('avatar_file', 'File', 'required');
      // }
        if ($this->bf_form_validation->run($this) === false) {
            
            $data = array();
            $data['allStates'] = $this->Doctor_model->fetchStates();
            $data['speciality'] = $this->Doctor_model->fetchSpeciality();
            $data['degree'] = $this->Doctor_model->fetchDegree();
            $data['hospital'] = $this->Doctor_model->fetchHospital();
            $this->session->set_flashdata('valid_upload', $this->error_message);
            $data['doctorId'] = 0;
            $data['title'] = 'Hospital Detail';
            $data['active'] = 'doctor';
            
            $pRoleId = $this->input->post('pRoleId');
           // dump(validation_errors());
            $this->detailHospital($pRoleId, 'doctor', 'adddoctor');
            //redirect('hospital/'.$pRoleId.'/doctor');
          //  $this->load->super_admin_template('hospitalDetail', $data, 'hospitalScript');
            return false;
        } else {
           
            $imagesname = '';
            if ($_FILES['doctor_photo']['name']) {
                $path = realpath(FCPATH . 'assets/doctorsImages/');
                $upload_data = $this->input->post('avatar_data_doctor');
                $upload_data = json_decode($upload_data);
                
                $original_imagesname = $this->uploadImageWithThumb($upload_data, 'doctor_photo', $path, 'assets/doctorsImages/', './assets/doctorsImages/thumb/', 'doctor');

                if (empty($original_imagesname)) {
                    $data['allStates'] = $this->Doctor_model->fetchStates();
                    $data['speciality'] = $this->Doctor_model->fetchSpeciality();
                    $data['degree'] = $this->Doctor_model->fetchDegree();
                    $data['hospital'] = $this->Doctor_model->fetchHospital();
                    $data['doctorId'] = 0;
                    $data['title'] = 'Hospital Detail';
                    $data['active'] = 'doctor';
                    $this->session->set_flashdata('valid_upload', $this->error_message);
                    $this->load->super_admin_template('hospitalDetail', $data, 'hospitalScript');
                    return false;
                } else {
                    $imagesname = $original_imagesname;
                }
            }
            
           
            
            $doctors_fName = $this->input->post('doctors_fName');
            $doctors_lName = $this->input->post('doctors_lName');
            $doctors_phn = $this->input->post('doctors_phn');
            $users_email = $this->input->post('users_email');
            $miUserId = $this->input->post('hospitalUserIdDoctor');
            $pRoleId = $this->input->post('pRoleId');
            $fee = $this->input->post('fee');

          
          
            $show_exp = $this->input->post('show_exp');
            $exp_year = $this->input->post('exp_year');
            
            $date = date('Y-m-d');
            $newdate = strtotime ( "-$exp_year year" , strtotime ( $date ) ) ;
            $exp_year = $newdate;
            
          
            
            $doctorsinserData = array(
                'doctors_fName' => $doctors_fName,
                'doctors_lName' => $doctors_lName,
                'doctors_phon' => $doctors_phn,
                'doctors_email' => $users_email,
                'doctors_unqId' => 'DOC' . round(microtime(true)),
                'doctors_img' => $imagesname,
                'creationTime' => strtotime(date('Y-m-d')),
                
                
                'doctors_showExp' => $show_exp,
                'doctors_expYear' => $exp_year,
           
                'doctors_joiningDate' => strtotime(date('Y-m-d')),
                
                'doctors_roll' => 9,
                'doctors_parentId' => $miUserId,
                
                'doctors_consultaionFee' => $fee,
                
                'status' => 0,
                
            );
            
            if(!$users_email){
                $this->sendEmailRegister($this->input->post($users_email));
            }
            
            $doctorsProfileId = $this->Doctor_model->insertDoctorData($doctorsinserData, 'qyura_doctors');
            
            //dump($this->db->last_query());
            $specialitiesIds = $this->input->post('doctorSpecialities_specialitiesId');

            foreach ($specialitiesIds as $key => $val) {
                $doctorSpecialities = array(
                    'doctorSpecialities_doctorsId' => $doctorsProfileId,
                    'doctorSpecialities_specialitiesId' => $val,
                    'creationTime' => strtotime(date('Y-m-d'))
                );
                $this->Doctor_model->insertDoctorData($doctorSpecialities, 'qyura_doctorSpecialities');
                //dump($this->db->last_query());
                unset($doctorSpecialities);
            }

            $doctorAcademic_degreeId = $this->input->post('doctorAcademic_degreeId');
            $doctorSpecialities_specialitiesCatId = $this->input->post('doctorSpecialities_specialitiesCatId');
            $acdemic_addaddress = $this->input->post('acdemic_addaddress');
            $acdemic_addyear = $this->input->post('acdemic_addyear');
            for ($i = 0; $i < count($doctorAcademic_degreeId); $i++) {
                /* here one more table insertion needed for academic image load on qyura_doctorAcademicImage table,
                 *  but write now it is not here
                 */
                if ($doctorAcademic_degreeId[$i] != '' && $doctorSpecialities_specialitiesCatId[$i] != '' && $acdemic_addaddress[$i] != '' && $acdemic_addyear[$i] != '') {
                    $doctorAcademicData = array(
                        'doctorAcademic_degreeId' => $doctorAcademic_degreeId[$i],
                        'doctorAcademic_specialitiesId' => $doctorSpecialities_specialitiesCatId[$i],
                        'doctorAcademic_degreeInsAddress' => $acdemic_addaddress[$i],
                        'doctorAcademic_degreeYear' => $acdemic_addyear[$i],
                        'doctorAcademic_doctorsId' => $doctorsProfileId,
                        'creationTime' => strtotime(date('Y-m-d'))
                    );

                    $this->Doctor_model->insertDoctorData($doctorAcademicData, 'qyura_doctorAcademic');
                    //dump($this->db->last_query());
                    unset($doctorAcademicData);
                }
            }
         
            $this->session->set_flashdata('message', 'Data inserted successfully !');
            
            redirect('hospital/detailHospital/'.$pRoleId.'/doctor');
        }
    }
    function editDoctor() {
       
        $doctorAcademic_hidden_id = $this->input->post('doctorAcademic_hidden_id');
        $doctor_hidden_id = $this->input->post('doctor_hidden_id');
        $this->bf_form_validation->set_rules('doctors_fName', 'Doctors First Name', 'required|trim');
        $this->bf_form_validation->set_rules('doctors_lName', 'Doctors Last Name', 'required|trim');
        $this->bf_form_validation->set_rules('doctors_phn', 'Doctor Mobile', 'trim|numeric');
        $this->bf_form_validation->set_rules('users_email', 'Users Email', "valid_email|trim");//||MUnique[{$Moption}]
       
       // if (empty($_FILES['avatar_file']['name'])) {
      //      $this->bf_form_validation->set_rules('avatar_file', 'File', 'required');
     //   }
        if ($this->bf_form_validation->run($this) === false) {
            
            $data = array();
            $data['doctorData'] = $this->Doctor_model->fetchDoctorData($doctor_hidden_id);
            $data['speciality'] = $this->Doctor_model->fetchSpeciality();
            $data['degree'] = $this->Doctor_model->fetchDegree();
            $data['hospital'] = $this->Doctor_model->fetchHospital();
            $this->session->set_flashdata('valid_upload', $this->error_message);
            $data['doctorId'] = $doctor_hidden_id;
            $data['title'] = 'Hospital Detail';
            $data['active'] = 'doctor';
            $pRoleId = $this->input->post('pRoleId');
           // dump(validation_errors());
            $this->detailHospital($pRoleId,'doctor', 'adddoctor');
            //redirect('hospital/'.$pRoleId.'/doctor');
          //  $this->load->super_admin_template('hospitalDetail', $data, 'hospitalScript');
            return false;
        } else {
           
            
            $doctors_fName = $this->input->post('doctors_fName');
            $doctors_lName = $this->input->post('doctors_lName');
            $doctors_phn = $this->input->post('doctors_phn');
            $users_email = $this->input->post('users_email');
            $miUserId = $this->input->post('hospitalUserIdDoctor');
            $pRoleId = $this->input->post('pRoleId');
            $fee = $this->input->post('fee');            
            $show_exp = $this->input->post('show_exp');
            $exp_year = $this->input->post('exp_year');
            
            $date = date('Y-m-d');
            $newdate = strtotime ( "-$exp_year year" , strtotime ( $date ) ) ;
            $exp_year = $newdate;
            $doctorsUpdateData = array(
                'doctors_fName' => $doctors_fName,
                'doctors_lName' => $doctors_lName,
                'doctors_phon' => $doctors_phn,
                'doctors_email' => $users_email,
                'doctors_unqId' => 'DOC' . round(microtime(true)),
                'creationTime' => strtotime(date('Y-m-d')),               
                'doctors_showExp' => $show_exp,
                'doctors_expYear' => $exp_year,
                'doctors_joiningDate' => strtotime(date('Y-m-d')),
                'doctors_roll' => 9,
                'doctors_parentId' => $miUserId,
                'doctors_consultaionFee' => $fee,
                
            );
            if(empty($imagesname) || $imagesname === '' || $imagesname === NULL){
                unset($doctorsUpdateData['doctors_img']);
            }

            $where = array(
                'doctors_id' => $doctor_hidden_id
            );
         
            $doctorsProfileId = $this->Doctor_model->updateDoctorData($doctorsUpdateData,$where, 'qyura_doctors');
            
            //dump($this->db->last_query());
            $specialitiesIds = $this->input->post('doctorSpecialities_specialitiesId');

            $option = array(
                    'table' => 'qyura_doctorSpecialities',
                    'select' => 'doctorSpecialities_specialitiesId',
                    'where' => array('doctorSpecialities_doctorsId' => $doctor_hidden_id)
                );

            $res = $this->common_model->customGet($option);

            $result = $this->updateMultipleIds($specialitiesIds,$res,$doctor_hidden_id,'qyura_doctorSpecialities');

            $doctorAcademic_degreeId = $this->input->post('doctorAcademic_degreeId');
            $doctorSpecialities_specialitiesCatId = $this->input->post('doctorSpecialities_specialitiesCatId');
            $acdemic_addaddress = $this->input->post('acdemic_addaddress');
            $acdemic_addyear = $this->input->post('acdemic_addyear');
            
             if(!empty($doctorAcademic_degreeId) && $doctor_hidden_id != ''){
                $this->db->delete('qyura_doctorAcademic', array('doctorAcademic_doctorsId' => $doctor_hidden_id)); 
            }
            
            for ($i = 0; $i < count($doctorAcademic_degreeId); $i++) {
                /* here one more table insertion needed for academic image load on qyura_doctorAcademicImage table,
                 *  but write now it is not here
                 */
                if ($doctorAcademic_degreeId[$i] != '' && $doctorSpecialities_specialitiesCatId[$i] != '' && $acdemic_addaddress[$i] != '' && $acdemic_addyear[$i] != '') {
                    $doctorAcademicData = array(
                        'doctorAcademic_degreeId' => $doctorAcademic_degreeId[$i],
                        'doctorAcademic_specialitiesId' => $doctorSpecialities_specialitiesCatId[$i],
                        'doctorAcademic_degreeInsAddress' => $acdemic_addaddress[$i],
                        'doctorAcademic_degreeYear' => $acdemic_addyear[$i],
                        'doctorAcademic_doctorsId' => $doctor_hidden_id,
                        'creationTime' => strtotime(date('Y-m-d'))
                    );

                    $this->Doctor_model->insertDoctorData($doctorAcademicData, 'qyura_doctorAcademic');
                    //dump($this->db->last_query());
                    unset($doctorAcademicData);
                }
            }
         
            $this->session->set_flashdata('message', 'Data updated successfully !');
            
            redirect('hospital/detailHospital/'.$pRoleId.'/doctor');
        }
    }
    
    
    function check_email_doctor() {
        
        $data = 0;
        $user_table_id = '';
        $users_email = $this->input->post('users_email');
        $hospitalUserId = $this->input->post('hospitalUserIdDoctor');
        
        $option = array(
              'table' => 'qyura_doctors',
              'select' => 'doctors_id',
              'where' => 'doctors_email = "'.$users_email.'" AND  doctors_parentId = '.$hospitalUserId.' AND  doctors_roll = 9 AND doctors_deleted = 0',  
            );
        
        
        $email = $this->common_model->customGet($option);
       // echo $this->db->last_query();   
       // echo 1; exit;
      // print_r($email); exit;
        if (empty($email)){
           
           echo 1;
           
        } else {
            echo $data;
        }
        exit;
    }
    
    
      function find_membership() {
        $membershipId = $this->input->post('member_id');	
        $option = array(
            'table' => 'qyura_membershipFacilities',
            'select' => '*',
            'where' => array('membershipFacilities_deleted' => 0, 'qyura_membershipFacilities.status' => 1, 'membershipFacilities_membershipId' =>$membershipId )
        );
        $membership_plan = $this->common_model->customGet($option);
        echo json_encode($membership_plan);
    }
    
    
     function membershipEdit() {
        //print_r($_POST);exit;
        $this->bf_form_validation->set_rules("diagnostic_mbrTyp", "Membership Type", 'required|xss_clean');
        $faci_count = $this->input->post('faci_count');
        
        for($i = 1; $i <= $faci_count; $i++){
            $checkbox = $this->input->post("miFacilitiesId_$i");
            $this->bf_form_validation->set_rules("membership_quantity_$i", "Quantity", 'required|xss_clean');
            if($checkbox == 2 || $checkbox == 4){
                $this->bf_form_validation->set_rules("membership_duration_$i", "Duration", 'required|xss_clean');
            }
        }
        if ($this->bf_form_validation->run() == FALSE) {
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => ajax_validation_errors());
            echo json_encode($responce);
        } else {
            $digo_id = $this->input->post("digo_id");
            $hospitalId = $this->input->post("hospitalId");
            $faci_count = $this->input->post('faci_count');
            
            $mem_id = $this->input->post('faci_count');
            $digo_array['hospital_mmbrTyp'] = $this->input->post('diagnostic_mbrTyp');
            $options = array
            (
                'where' => array('hospital_usersId' => $digo_id),
                'data'  => $digo_array,
                'table' => 'qyura_hospital'
            );
            
           // print_r($options); exit;
            $this->common_model->customUpdate($options);
            
            for($i = 1; $i <= $faci_count; $i++){
                
                $miMembership_id = $this->input->post("miMembershipId_$i");
                $miFacilitiesId = $this->input->post("miFacilitiesId_$i");
                $quantity = $this->input->post("membership_quantity_$i");
                $duration = $this->input->post("membership_duration_$i");
                if(isset($miMembership_id) && $miMembership_id != NULL){
                    if($quantity != ''){
                        $records_array['miMembership_quantity'] = $quantity;
                    }
                    if($miFacilitiesId == 2 || $miFacilitiesId == 4){
                        $records_array['miMembership_duration'] = $duration;
                    }else{
                        unset($records_array['miMembership_duration']);
                    }
                    $options = array
                    (
                        'where' => array('miMembership_id' => $miMembership_id),
                        'data'  => $records_array,
                        'table' => 'qyura_miMembership'
                    );
                    $this->common_model->customUpdate($options);
                }else{
                    
                    $records_array['miMembership_type'] = 9;
                    $records_array['miMembership_miId'] = $digo_id;
                    $records_array['miMembership_facilitiesId'] = $miFacilitiesId;
                    
                    if($quantity != ''){
                        $records_array['miMembership_quantity'] = $quantity;
                    }
                    if($miFacilitiesId == 2 || $miFacilitiesId == 4){
                        $records_array['miMembership_duration'] = $duration;
                    }else{
                        unset($records_array['miMembership_duration']);
                    }
                    
                    $options = array
                    (
                        'data'  => $records_array,
                        'table' => 'qyura_miMembership'
                    );
                    $this->common_model->customInsert($options);
                }
                
            }
                
            $responce = array('status' => 1, 'msg' => "Record Update successfully", 'url' => "hospital/detailHospital/$hospitalId/membership");
            echo json_encode($responce);
        }
    }
    
    function editDocTimeView() {
        $docTimeTableId = $this->input->post('docTimeTableId');
        $doctorId = $this->input->post('doctorId');
        $docTimeDayId = $this->input->post('docTimeDayId');
        $day = $this->input->post('day');
        $con = array('docTimeTable_id' => $docTimeTableId);
        
        $data['timeData'] = $this->Doctor_model->geTimeTable($con);

        $form = $this->load->view('editTimeSloat', $data, true);
        $responce = array('status' => 1, 'isAlive' => TRUE, 'data' => $form);
        echo json_encode($responce);
    }
    
    function editDocTime() {
        
        $this->bf_form_validation->set_rules('docTimeDay_day[]', 'day', 'required|trim');
        $this->bf_form_validation->set_rules('openingHour', 'open', 'required|trim|callback_checkOpenTime');
        $this->bf_form_validation->set_rules('closeingHour', 'close', 'required|trim|callback_checkCloseTime');
        $this->bf_form_validation->set_rules('fees', 'fees', 'required|trim');
        
        //hidden
        $this->bf_form_validation->set_rules('docTimeTableId', 'docTimeTableId', 'required|trim');
        $this->bf_form_validation->set_rules('MIprofileId', 'MIprofileId', 'required|trim');
        
        if ($this->bf_form_validation->run($this) === FALSE) {
            $errorAr = ajax_validation_errors();
            if (array_key_exists('docTimeDay_day[]', $errorAr)) {
                $er_msg = $errorAr['docTimeDay_day[]'];
                unset($errorAr['docTimeDay_day[]']);
                $errorAr['docTimeDay_day'] = $er_msg;
            }
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $errorAr);
            echo json_encode($responce);
        } elseif ($this->checkEditSloat()) {

            $docTimeTable_stayAt = isset($_POST['docTimeTable_stayAt']) ? $this->input->post('docTimeTable_stayAt') : '1';
            $docTimeTable_MItype = isset($_POST['docTimeTable_MItype']) ? $this->input->post('docTimeTable_MItype') : '1';
            $docTimeTable_MIprofileId = isset($_POST['docTimeTable_MIprofileId']) ? $this->input->post('docTimeTable_MIprofileId') : '';
            $docTimeTable_price = isset($_POST['fees']) ? $this->input->post('fees') : '';
            $docTimeDay_days = isset($_POST['docTimeDay_day']) ? $this->input->post('docTimeDay_day') : '';
            $docTimeDay_open = isset($_POST['openingHour']) ? $this->input->post('openingHour') : '';
            $docTimeDay_close = isset($_POST['closeingHour']) ? $this->input->post('closeingHour') : '';
            $docTimeTableId = isset($_POST['docTimeTableId']) ? $this->input->post('docTimeTableId') : '';
            $MIprofileId = isset($_POST['MIprofileId']) ? $this->input->post('MIprofileId') : '';

            //$this->db->taransaction
            
            $docTimeDay_open = date('H:i:s', strtotime($docTimeDay_open));
            $docTimeDay_close = date('H:i:s', strtotime($docTimeDay_close));
            $selectedDays = $docTimeDay_days;

            $con = array('docTimeDay_docTimeTableId' => $docTimeTableId);
            $days = $this->Doctor_model->getDoctorAvailableOnDaysNew($con);
            $preDays = array();
            if (isset($days) && $days != null) {
                foreach ($days as $day) {
                    array_push($preDays, $day->day);
                }
            }

            $newAvabilityIds = array();

            foreach ($selectedDays as $selectedDay) {
                if (!in_array($selectedDay, $preDays)) {
                    $param = array(
                        'table' => 'qyura_docTimeDay',
                        'data' => array(
                            'docTimeDay_day' => $selectedDay,
                            'docTimeDay_open' => $docTimeDay_open,
                            'docTimeDay_close' => $docTimeDay_close,
                            'docTimeDay_docTimeTableId' => $docTimeTableId
                        )
                    );

                    $id = $this->common_model->customInsert($param);
                    array_push($newAvabilityIds, $id);
                } else {
                    $where = array('docTimeDay_day' => $selectedDay, 'docTimeDay_docTimeTableId' => $docTimeTableId);
                    $records_upg['modifyTime'] = time();
                    $records_upg['docTimeDay_open'] = $docTimeDay_open;
                    $records_upg['docTimeDay_close'] = $docTimeDay_close;

                    $updateOptions = array
                        (
                        'where' => $where,
                        'data' => $records_upg,
                        'table' => 'qyura_docTimeDay'
                    );

                    $id = $this->common_model->customUpdate($updateOptions);
                    $id = true;
                }
            }

            foreach ($days as $day) {
                if (!in_array($day->day, $selectedDays)) {
                    $where1 = array('docTimeDay_day' => $day->day, 'docTimeDay_docTimeTableId' => $docTimeTableId);
                    $records_upg1['docTimeDay_deleted'] = 1;
                    $records_upg1['modifyTime'] = time();

                    $updateOptions1 = array
                        (
                        'where' => $where1,
                        'data' => $records_upg1,
                        'table' => 'qyura_docTimeDay'
                    );

                    $id = $this->common_model->customUpdate($updateOptions1);
                    $id = true;
                }
            }

            $sql = '';
            foreach ($this->db->queries as $key => $query) {
                $sql = $query . " \n Execution Time:" . $times[$key]; // Generating SQL file alongwith execution time
                //fwrite($handle, $sql . "\n\n");              // Writing it in the log file

                if (count($this->db->queries) == $count)
                    $sql = $sql . " \n \n \n END mahi889@gmail.com >>>>>";

                $count++;
            }
            
            
            $param = array(
                'table' => 'qyura_docTimeTable',
            );
            
            $updateOptions = array
                (
                'where' => array('docTimeTable_id'=>$docTimeTableId),
                'data' => array(
                    'docTimeTable_stayAt' => $docTimeTable_stayAt,
                    'docTimeTable_doctorId' => $this->input->post('doctorId'),
                    'docTimeTable_MItype' => $docTimeTable_MItype,
                    'docTimeTable_price' => $docTimeTable_price,
                    'creationTime' => time()
                ),
                'table' => 'qyura_docTimeTable'
            );

            $id = $this->common_model->customUpdate($updateOptions);

            if ($id) {
                $this->session->set_flashdata('active', 'doctor');
                $responce = array('status' => 1, 'msg' => "Time sloat updated successfully", 'url' => "hospital/detailHospital/{$_POST['MIprofileId']}/doctor/{$_POST['doctorId']}/timeSlot");
            } else {
                $error = array("TopError" => "<strong>Something went wrong while updating your data... sorry.</strong>");
                $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $error);
            }
            echo json_encode($responce);
        }
    }
    
    function addDocTime() {

        $this->bf_form_validation->set_rules('doctorId', 'doctor sab', 'required|trim');
        $this->bf_form_validation->set_rules('docTimeTable_stayAt', 'stayAt', 'required|trim');
        $this->bf_form_validation->set_rules('docTimeTable_MItype', 'MItype', 'required|trim');
        $this->bf_form_validation->set_rules('docTimeTable_MIprofileId', 'Hospital Name', 'required|trim');
        $this->bf_form_validation->set_rules('docTimeDay_day[]', 'day', 'required|trim');
        $this->bf_form_validation->set_rules('openingHour', 'open', 'required|trim|callback_checkOpenTime');
        $this->bf_form_validation->set_rules('closeingHour', 'close', 'required|trim|callback_checkCloseTime');
        $this->bf_form_validation->set_rules('fees', 'fees', 'required|trim');


        if ($this->bf_form_validation->run($this) === FALSE) {
            $errorAr = ajax_validation_errors();
            if (array_key_exists('docTimeDay_day[]', $errorAr)) {
                $er_msg = $errorAr['docTimeDay_day[]'];
                unset($errorAr['docTimeDay_day[]']);
                $errorAr['docTimeDay_day'] = $er_msg;
            }
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $errorAr);
            echo json_encode($responce);
        } elseif ($this->checkSloat()) {

            $docTimeTable_stayAt = isset($_POST['docTimeTable_stayAt']) ? $this->input->post('docTimeTable_stayAt') : '';
            $docTimeTable_MItype = isset($_POST['docTimeTable_MItype']) ? $this->input->post('docTimeTable_MItype') : '';
            $MIprofileId = isset($_POST['docTimeTable_MIprofileId']) && $_POST['docTimeTable_MIprofileId'] != '' ? $this->input->post('docTimeTable_MIprofileId') : '';
            $docTimeTable_price = isset($_POST['fees']) ? $this->input->post('fees') : '';
            $docTimeDay_days = isset($_POST['docTimeDay_day']) ? $this->input->post('docTimeDay_day') : '';
            $docTimeDay_open = isset($_POST['openingHour']) ? $this->input->post('openingHour') : '';
            $docTimeDay_close = isset($_POST['closeingHour']) ? $this->input->post('closeingHour') : '';
            $doctorId = isset($_POST['doctorId']) ? $this->input->post('doctorId') : '';
            $docTimeDay_open = date('H:i:s', strtotime($docTimeDay_open));
            $docTimeDay_close = date('H:i:s', strtotime($docTimeDay_close));

            $param = array(
                'table' => 'qyura_docTimeTable',
                'data' => array(
                    'docTimeTable_stayAt' => $docTimeTable_stayAt,
                    'docTimeTable_doctorId' => $this->input->post('doctorId'),
                    'docTimeTable_MItype' => $docTimeTable_MItype,
                    'docTimeTable_MIprofileId' => $MIprofileId,
                    'docTimeTable_price' => $docTimeTable_price,
                    'creationTime' => time()
                )
            );

            $docTimeTableId = $this->common_model->customInsert($param);
            $docTimeDayId = FALSE;

            foreach ($docTimeDay_days as $key => $docTimeDay_day) {

                $param = array(
                    'table' => 'qyura_docTimeDay',
                    'data' => array(
                        'docTimeDay_day' => $docTimeDay_day,
                        'docTimeDay_open' => $docTimeDay_open,
                        'docTimeDay_close' => $docTimeDay_close,
                        'docTimeDay_docTimeTableId' => $docTimeTableId,
                        'creationTime' => time()
                    )
                );

                $docTimeDayId = $this->common_model->customInsert($param);
            }

            if ($docTimeDayId) {
                $this->session->set_flashdata('active', 'doctor');
                $responce = array('status' => 1, 'msg' => "Time sloat added successfully", 'url' => "hospital/detailHospital/$MIprofileId/doctor/$doctorId/timeSlot");
            } else {
                $error = array("TopError" => "<strong>Something went wrong while updating your data... sorry.</strong>");
                $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $error);
            }
            echo json_encode($responce);
        } else {
            $er = implode('<br/>', $this->error);
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => array('docTimeDay_day' => $er));
            echo json_encode($responce);
        }
    }
    
    function checkSloat() {
        $docTimeDay_days = isset($_POST['docTimeDay_day']) ? $this->input->post('docTimeDay_day') : '';
        $docTimeDay_open = isset($_POST['openingHour']) ? $this->input->post('openingHour') : '';
        $docTimeDay_close = isset($_POST['closeingHour']) ? $this->input->post('closeingHour') : '';

        $docTimeDay_open = date('H:i:s', strtotime($docTimeDay_open));
        $docTimeDay_close = date('H:i:s', strtotime($docTimeDay_close));
        $this->error = array();
        foreach ($docTimeDay_days as $key => $docTimeDay_day) {
            $data = array(
                'day' => $docTimeDay_day,
                'openTime' => $docTimeDay_open,
                'closeTime' => $docTimeDay_close,
                'doctorId' => $this->input->post('doctorId')
            );

            $row = $this->Doctor_model->checkSloat($data);
            if ($row)
                $this->error[] =  'This time '. date('h:i A', strtotime($docTimeDay_open)) .' to '. date('h:i A', strtotime($docTimeDay_close)).' match with '.convertNumberToDay($docTimeDay_day.' please select diffrent sloat');
        }

        if (count($this->error))
            return false;
        else {
            return true;
        }
    }

    function checkEditSloat() {
        $docTimeDay_days = isset($_POST['docTimeDay_day']) ? $this->input->post('docTimeDay_day') : '';
        $docTimeDay_open = isset($_POST['openingHour']) ? $this->input->post('openingHour') : '';
        $docTimeDay_close = isset($_POST['closeingHour']) ? $this->input->post('closeingHour') : '';
        $docTimeDayId = isset($_POST['docTimeDayId']) ? $this->input->post('docTimeDayId') : '';


        $docTimeDay_open = date('H:i:s', strtotime($docTimeDay_open));
        $docTimeDay_close = date('H:i:s', strtotime($docTimeDay_close));
        $this->error = array();
        foreach ($docTimeDay_days as $key => $docTimeDay_day) {
            $data = array(
                'day' => $docTimeDay_day,
                'openTime' => $docTimeDay_open,
                'closeTime' => $docTimeDay_close,
                'doctorId' => $this->input->post('doctorId'),
                'docTimeDayId' => $docTimeDayId
            );

            $row = $this->Doctor_model->checkSloat($data);
            if ($row)
                $this->error[] =  'This time '. date('h:i A', strtotime($docTimeDay_open)) .' to '. date('h:i A', strtotime($docTimeDay_close)).' match with '.convertNumberToDay($docTimeDay_day.' please select diffrent sloat');
        }

        if (count($this->error))
            return false;
        else {
            return true;
        }
    }

    function checkOpenTime() {
        $openingHour = $this->input->post('openingHour');
        $closeingHour = $this->input->post('closeingHour');
        $openingHour = strtotime($openingHour);
        $closeingHour = strtotime($closeingHour);

        if ($closeingHour < $openingHour) {
            $this->bf_form_validation->set_message('checkOpenTime', 'Opening time should be less than closing time');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function checkCloseTime() {
        $openingHour = $this->input->post('openingHour');
        $closeingHour = $this->input->post('closeingHour');
        $openingHour = strtotime($openingHour);
        $closeingHour = strtotime($closeingHour);

        if ($closeingHour < $openingHour) {
            $this->bf_form_validation->set_message('checkCloseTime', 'Closing time should be greater than opening time');
            return FALSE;
        } else {
            $timeDiff = $closeingHour - $openingHour;
            $diff = 29 * 60;
            if ($timeDiff < $diff) {
                $this->bf_form_validation->set_message('checkCloseTime', 'Time diffrence sould be 30 min');
                return FALSE;
            }

            return TRUE;
        }
    }
    
}
