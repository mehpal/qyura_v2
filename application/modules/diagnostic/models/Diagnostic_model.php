<?php

class Diagnostic_model extends CI_Model {

    function __construct() {
        parent::__construct();
        
    }
    
    
       // fetch all cities associated to hospital
   function allCities() {
        $this->db->select('city_id,city_name');
        $this->db->from('qyura_city');
        $this->db->join('qyura_diagnostic', 'qyura_diagnostic.diagnostic_cityId=qyura_city.city_id', 'right');
        $this->db->order_by("city_name", "asc");
        $this->db->group_by("city_id");
        return $this->db->get()->result();
    }
    
    // start change by hemany
   // fetch all publish hospital 
   function fetchPublishDiagnostic() {
        $this->db->select('diagnostic_id as diagno_id,diagnostic_name');
        $this->db->from('qyura_diagnostic');
        $this->db->where('status', 3);
        $this->db->order_by("diagnostic_name", "asc");
        $this->db->group_by("diagnostic_id");
        return $this->db->get()->result();
    }
   
    
    function getDiagnosticdetail($diagnoId){
        $this->db->select('diagnostic_address, isManual, diagnostic_zip, diagnostic_countryId, diagnostic_stateId, diagnostic_cityId, diagnostic_lat, diagnostic_long, diagnostic_name');
        $this->db->from('qyura_diagnostic');
        $this->db->where("diagnostic_id", "$diagnoId");
        $rows =  $this->db->get()->row();
      
         
        if (!empty($rows)) {
             
        // selected country
        $this->db->select('country_id,country');
        $this->db->from('qyura_country');
        $this->db->order_by("country", "asc");
        $allCountry = $this->db->get()->result();
        
        $countrySelected = '<option>Select Country</option>';
        foreach ($allCountry as $key=>$val){
            $selected = '';
            if($val->country_id == $rows->diagnostic_countryId) $selected = 'selected="selected"';
            $countrySelected .= '<option '.$selected.' value="'.$val->country_id.'">'.$val->country.'</option>';
            
        }
        
        // selected state
        $this->db->select('state_id,state_statename');
        $this->db->from('qyura_state');
        $this->db->where('state_countryid', $rows->diagnostic_countryId);
        $this->db->order_by("state_statename", "asc");
        $allState = $this->db->get()->result();
        
        $stateSelected = '';
       
        foreach ($allState as $key=>$val){
             $selected = '';
            if($val->state_id == $rows->diagnostic_stateId)$selected = 'selected="selected"';
            $stateSelected .= '<option '.$selected.' value="'.$val->state_id.'">'.$val->state_statename.'</option>';
        }
        
        // selected city
        $this->db->select('city_id,city_name');
        $this->db->from('qyura_city');
        $this->db->where('city_stateid', $rows->diagnostic_stateId);
        $this->db->order_by("city_name", "asc");
        $allCity =  $this->db->get()->result();
        
        $citySelected = '';
       
        foreach ($allCity as $key=>$val){
            $selected = '';
            if($val->city_id == $rows->diagnostic_cityId)$selected = 'selected="selected"';
            $citySelected .= '<option '.$selected.' value="'.$val->city_id.'">'.$val->city_name.'</option>';
        }
        
            echo json_encode(array('status' => 1, 'diagnostic_address' => $rows->diagnostic_address, 'country' => $countrySelected, 'state' => $stateSelected, 'city' => $citySelected, 'zipCode' => $rows->diagnostic_zip, 'lat' => $rows->diagnostic_lat, 'lng' => $rows->diagnostic_long, 'diagnostic_name' => $rows->diagnostic_name));
        } else {
            echo json_encode(array('status' => 0));
        }
        
   }
    // end changes by hemant
    
    function fetchCountry() {
        $this->db->select('country_id,country');
        $this->db->from('qyura_country');
        $this->db->order_by("country", "asc");
        return $this->db->get()->result();
    }

    function fetchStates($countryId = NULL) {
        $this->db->select('state_id,state_statename');
        $this->db->from('qyura_state');
        if (!empty($countryId))
            $this->db->where('state_countryid', $countryId);

        $this->db->order_by("state_statename", "asc");
        return $this->db->get()->result();
    }

    function fetchCity($stateId = NULL) {
        $this->db->select('city_id,city_name');
        $this->db->from('qyura_city');
        $this->db->where('city_stateid', $stateId);
        $this->db->order_by("city_name", "asc");
        return $this->db->get()->result();
    }

    function fetchEmail($email, $usersId = NULL) {
        $this->db->select('users_email');
        $this->db->from('qyura_users');
        $this->db->join('qyura_usersRoles', 'qyura_usersRoles.usersRoles_userId = qyura_users.users_id', 'inner');
        if ($usersId) {
            $this->db->where('qyura_users.users_id !=', $usersId);
        }
       // $this->db->where('qyura_usersRoles.usersRoles_roleId', 3);
        $this->db->where('qyura_users.users_email', $email);
        $result = $this->db->get();
        //return $this->db->last_query();

        if ($result->num_rows() > 0)
            return 1;
        else
            return 0;
    }

    function insertDiagnosticUser($insertData) {
        $this->db->insert('qyura_users', $insertData);
        $insert_id = $this->db->insert_id();

        return $insert_id;
    }

    function insertDiagnostic($insertData) {
        $this->db->insert('qyura_diagnostic', $insertData);

        $insert_id = $this->db->insert_id();
        //echo $this->db->last_query();exit;
        return $insert_id;
    }

    function fetchdiagnosticData($condition = NULL) {
        
        $this->db->select('qyura_country.country,qyura_state.state_statename,diag.diagnostic_mblNo as mobile,diag.diagnostic_aboutUs,diag.diagnostic_mbrTyp,diag.diagnostic_email,diag.diagnostic_dsgn,diag.diagnostic_id,diag.diagnostic_zip,diag.diagnostic_usersId,diag.diagnostic_name,diag.diagnostic_phn,diag.diagnostic_address,City.city_name,diag.diagnostic_img,diag.diagnostic_cntPrsn,usr.users_email,diag.diagnostic_lat,diag.diagnostic_long,usr.users_id,diag.diagnostic_countryId,diag.diagnostic_stateId,diag.diagnostic_cityId,usr.users_mobile,diag.diagnostic_background_img, diag.isManual, Blood.bloodBank_name,Blood.bloodBank_phn, Blood.bloodBank_photo, Ambu.ambulance_name,Ambu.ambulance_phn, Ambu.docOnBoard, Ambu.ambulance_img, diag.diagnostic_availibility_24_7, diag.diagnostic_hasPharmacy, diag.diagnostic_docatId, diag.diagnostic_specialityNameFormate, diag.diagnostic_hasBloodbank, diag.diagnostic_isBloodBankOutsource, diag.diagnostic_isEmergency, Ambu.ambulance_id, Blood.bloodBank_id');
        
        $this->db->from('qyura_diagnostic AS diag');
        $this->db->join('qyura_city AS City', 'City.city_id = diag.diagnostic_cityId', 'left');
        $this->db->join('qyura_users AS usr', 'usr.users_id = diag.diagnostic_usersId', 'left');
        
        $this->db->join('qyura_bloodBank AS Blood', 'Blood.users_id = diag.diagnostic_usersId', 'left');
        //$this->db->join('qyura_pharmacy AS Pharmacy', 'Pharmacy.pharmacy_usersId = Hos.hospital_usersId', 'left');
        $this->db->join('qyura_ambulance AS Ambu', 'Ambu.ambulance_usersId = diag.diagnostic_usersId', 'left');
        
        $this->db->join('qyura_country AS qyura_country','qyura_country.country_id = diag.diagnostic_countryId','left');
        $this->db->join('qyura_state AS qyura_state','qyura_state.state_id = diag.diagnostic_stateId','left');
        //$this->db->join('qyura_usersRoles AS Roles','Roles.usersRoles_userId = diag.diagnostic_usersid','left'); // changed
        if ($condition)
            $this->db->where(array('diag.diagnostic_id' => $condition));
        $this->db->where(array('diag.diagnostic_deleted' => 0));
        //$this->db->where(array('Roles.usersRoles_parentId'=> 0)); // changed
        $this->db->order_by("diag.creationTime", "desc");
        $data = $this->db->get();
        //echo $this->db->last_query();exit;
        return $data->result();
        //echo $this->db->last_query(); exit;
        //echo "<pre>";print_r($data);echo "</pre>";
        //exit;
    }
    
     function fetchdiagnosticDataDetails($condition = NULL) {
        $this->db->select('diag.diagnostic_aboutUs,diag.diagnostic_mbrTyp,diag.diagnostic_email,diag.diagnostic_dsgn,diag.diagnostic_id,diag.diagnostic_zip,diag.diagnostic_usersId,diag.diagnostic_name,diag.diagnostic_phn,diag.diagnostic_address,City.city_name,diag.diagnostic_img,diag.diagnostic_cntPrsn,usr.users_email,diag.diagnostic_lat,diag.diagnostic_long,usr.users_id,diag.diagnostic_countryId,diag.diagnostic_stateId,diag.diagnostic_cityId,usr.users_mobile,diag.diagnostic_background_img, diag.isManual');
        $this->db->from('qyura_diagnostic AS diag');
        $this->db->join('qyura_city AS City', 'City.city_id = diag.diagnostic_cityId', 'left');
        $this->db->join('qyura_users AS usr', 'usr.users_id = diag.diagnostic_usersId', 'left');
        //$this->db->join('qyura_usersRoles AS Roles','Roles.usersRoles_userId = diag.diagnostic_usersid','left'); // changed
        
        $this->db->where(array('diag.diagnostic_id' => $condition));
        $this->db->where(array('diag.diagnostic_deleted' => 0));
        //$this->db->where(array('Roles.usersRoles_parentId'=> 0)); // changed
        $this->db->order_by("diag.creationTime", "desc");
        $data = $this->db->get();
        //echo $this->db->last_query();exit;
        return $data->result();
        //echo $this->db->last_query(); exit;
        //echo "<pre>";print_r($data);echo "</pre>";
        //exit;
    }

    function insertUsersRoles($insertData) {
        $this->db->insert('qyura_usersRoles', $insertData);
        $insert_id = $this->db->insert_id();
        return true;
    }

    function UpdateTableData($data = array(), $where = array(), $tableName = NULL) {
        foreach ($where as $key => $val) {
            $this->db->where($key, $val);
        }

        $this->db->update($tableName, $data);

        //echo $this->db->last_query();exit;
        return TRUE;
    }
    
    function fetchDiagnosticDoctorDataTables($diagonsticUserId){
        
                $imgUrl = base_url() . 'assets/doctorsImages/thumb/thumb_100/$1';
        $doctorUrl = site_url() . '/diagnostic/detailDiagnostic/$2/doctor/$1/editDoctor';
        
        $this->datatables->select('doctors_userId userId,qyura_doctors.doctors_id as id, CONCAT(qyura_doctors.doctors_fName, " ",  qyura_doctors.doctors_lName) AS name, qyura_doctors.doctors_img imUrl, qyura_doctors.doctors_consultaionFee as consFee, GROUP_CONCAT(qyura_specialities.specialities_name) as specialityName,qyura_doctors.doctors_phon,qyura_doctors.doctors_img,qyura_doctors.doctors_mobile,qyura_doctors.doctors_unqId, qyura_diagnostic.diagnostic_id, qyura_doctors.doctors_showExp,qyura_doctors.status,qyura_doctors.doctors_expYear as exp'); 

        $this->datatables->from('qyura_doctors');
        
        $this->datatables->join('qyura_diagnostic', 'qyura_diagnostic.diagnostic_usersId=qyura_doctors.doctors_parentId', 'left');
       
     //   $this->datatables->join('qyura_professionalExp', 'qyura_professionalExp.professionalExp_usersId=qyura_doctors.doctors_id', 'left');


        $this->datatables->join('qyura_doctorSpecialities', 'qyura_doctorSpecialities.doctorSpecialities_doctorsId = qyura_doctors.doctors_id', 'left');
        $this->datatables->join('qyura_specialities', 'qyura_specialities.specialities_id = qyura_doctorSpecialities.doctorSpecialities_specialitiesId', 'left');

        $this->db->group_by('doctors_id');
        
        $this->db->order_by('doctors_id', 'desc');


        $search = $this->input->post('doctor_search');
        if ($search) {
            $this->db->group_start();
            $this->db->or_like('qyura_doctors.doctors_fName', $search);
            $this->db->or_like('qyura_doctors.doctors_phn', $search);
            $this->db->or_like('qyura_doctors.doctors_consultaionFee', $search);
            $this->db->or_like('qyura_specialities.specialities_name', $search);
            $this->db->or_like('qyura_doctors.doctors_expYear', $search);
            $this->db->group_end();
        }

        $this->datatables->where(array('doctors_deleted' => 0, 'doctors_roll' => 9, 'doctors_parentId' => $diagonsticUserId));

        $this->datatables->add_column('exp', '$1 Years', 'getDocExp(exp)');
        $this->datatables->add_column('name', '$1</br>$2', 'name,doctors_unqId');
        $this->datatables->add_column('consFee', "<i class='fa fa-inr'></i> $1", 'consFee');

        $this->datatables->add_column('doctors_img', '<img class="img-responsive" height="80px;" width="80px;" src=' . $imgUrl . '>', 'doctors_img');

        $this->datatables->add_column('view', '<a class="btn btn-info waves-effect waves-light m-b-5 applist-btn" href=' .$doctorUrl. '>Edit Detail</a>', 'doctors_id,diagnostic_id');
        $this->datatables->add_column('status', '$1', 'statusCheck(doctor, qyura_doctors, doctors_id, id, status)');

        return $this->datatables->generate();
    }

    
    function fetchDiagnosticDataTables($condition = NULL) {

        $imgUrl = base_url() . 'assets/diagnosticsImage/thumb/thumb_100/$1';

        $this->datatables->select('diag.diagnostic_id as id,diag.diagnostic_zip,diag.diagnostic_usersId,diag.diagnostic_name,diag.diagnostic_phn,diag.diagnostic_address,City.city_name,coalesce(diag.diagnostic_img, "noImage.png") as diagnostic_img,diag.diagnostic_cntPrsn,usr.users_email,diag.diagnostic_lat,diag.diagnostic_long,usr.users_id,diag.diagnostic_countryId,diag.diagnostic_stateId,diag.diagnostic_cityId, diag.status');
        
        $this->datatables->from('qyura_diagnostic AS diag');
        $this->datatables->join('qyura_city AS City', 'City.city_id = diag.diagnostic_cityId', 'left');
        $this->datatables->join('qyura_users AS usr', 'usr.users_id = diag.diagnostic_usersId', 'left');


        $search = $this->input->post('bloodBank_name');
        if ($search) {
            $this->db->group_start();
            $this->db->or_like('diag.diagnostic_name', $search);
            $this->db->or_like('diag.diagnostic_phn', $search);
            $this->db->or_like('diag.diagnostic_address', $search);
            $this->db->group_end();
        }

        $city = $this->input->post('cityId');
        isset($city) && $city != '' ? $this->datatables->where('diagnostic_cityId', $city) : '';

        $status = $this->input->post('status');
        isset($status) && $status != '' ? $this->datatables->where('diag.status', $status) : '';

        $this->datatables->order_by('diagnostic_id');

        if ($condition)
            $this->datatables->where(array('diag.diagnostic_id' => $condition));
        $this->datatables->where(array('diag.diagnostic_deleted' => 0));
        

        $this->datatables->add_column('diagnostic_img', '<img class="img-responsive" height="80px;" width="80px;" src=' . $imgUrl . '>', 'diagnostic_img');

        $this->datatables->add_column('diagnostic_address', '$1 </br><a  href="diagnostic/map/$2" class="btn btn-info btn-xs waves-effect waves-light" target="_blank">View Map</a>', 'diagnostic_address,id');
        
        $this->datatables->add_column('view', '<a class="btn btn-warning waves-effect waves-light m-b-5 applist-btn" href="diagnostic/detailDiagnostic/$1">View Detail</a>', 'id');
        
        $this->datatables->add_column('status', '$1', 'statusCheck(diagnostic, qyura_diagnostic, diagnostic_id, id, status)');
           
        $this->datatables->order_by("diag.creationTime");
        return $this->datatables->generate();
    }
    
        //Function for insert
    public function customInsert($options) {
        $table = false;
        $data = false;

        extract($options);

        $this->db->insert($table, $data);

        return $this->db->insert_id();
    }
    
     //Function for delete
    public function customDelete($options) {
        $table = false;
        $where = false;

        extract($options);

        if (!empty($where))
            $this->db->where($where);

        $this->db->delete($table);

        return $this->db->affected_rows();
    }
     //Function for get
    public function customGet($options) {

        $select = false;
        $table = false;
        $join = false;
        $order = false;
        $limit = false;
        $offset = false;
        $where = false;
        $or_where = false;
        $single = false;
        $where_not_in = false;
        $group_by = false;

        extract($options);

        if ($select != false)
            $this->db->select($select);

        if ($table != false)
            $this->db->from($table);

        if ($where != false)
            $this->db->where($where);

        if ($where_not_in != false) {
            foreach ($where_not_in as $key => $value) {
                if (count($value) > 0)
                    $this->db->where_not_in($key, $value);
            }
        }

        if ($or_where != false)
            $this->db->or_where($or_where);

        if ($limit != false) {

            if (!is_array($limit)) {
                $this->db->limit($limit);
            } else {
                foreach ($limit as $limitval => $offset) {
                    $this->db->limit($limitval, $offset);
                }
            }
        }


        if ($order != false) {

            foreach ($order as $key => $value) {

                if (is_array($value)) {
                    foreach ($order as $orderby => $orderval) {
                        $this->db->order_by($orderby, $orderval);
                    }
                } else {
                    $this->db->order_by($key, $value);
                }
            }
        }


        if ($join != false) {

            foreach ($join as $key => $value) {

                if (is_array($value)) {

                    if (count($value) == 3) {
                        $this->db->join($value[0], $value[1], $value[2]);
                    } else {
                        foreach ($value as $key1 => $value1) {
                            $this->db->join($key1, $value1);
                        }
                    }
                } else {
                    $this->db->join($key, $value);
                }
            }
        }
        if($group_by != false){
            $this->db->group_by($group_by);
        }


        $query = $this->db->get();

        if ($single) {
            return $query->row();
        }


        return $query->result();
    }
    
    //Function for update
    public function customUpdate($options) {
        $table = false;
        $where = false;
        $orwhere = false;
        $data = false;

        extract($options);

        if (!empty($where)) {
            $this->db->where($where);
        }

        // using or condition in where  
        if (!empty($orwhere)) {
            $this->db->or_where($orwhere);
        }
        $this->db->update($table, $data);

        return $this->db->affected_rows();
    }
    
    function fetchdiagnosticsDiagnosticCatData($diagnosticId){
           
         $this->db->select('Spl.diagnosticsCat_catName,Dspl.diagnosticsHasCat_id,Dspl.diagnosticsHasCat_diagnosticId,Dspl.diagnosticsHasCat_diagnosticsCatId');
         
        $this->db->from('qyura_diagnosticsHasCat AS Dspl');
        $this->db->join('qyura_diagnosticsCat AS Spl','Spl.diagnosticsCat_catId = Dspl.diagnosticsHasCat_diagnosticsCatId','left');
        
        $this->db->where(array('Dspl.diagnosticsHasCat_diagnosticId' => $diagnosticId,'Spl.diagnosticsCat_deleted' => 0));
        $this->db->order_by("Dspl.creationTime", "desc"); 
        $data= $this->db->get();
        return $data->result();
      }
      
      function fetchdiagnosticsSpecialityData($diagnosticId){
           
         $this->db->select('Spl.specialities_name,Dspl.diagnosticSpecialities_id,Dspl.diagnosticSpecialities_specialitiesId,Dspl.diagnosticSpecialities_diagnosticId');
         
        $this->db->from('qyura_diagnosticSpecialities AS Dspl');
        $this->db->join('qyura_specialities AS Spl','Spl.specialities_id = Dspl.diagnosticSpecialities_specialitiesId','left');
        
        $this->db->where(array('Dspl.diagnosticSpecialities_diagnosticId' => $diagnosticId,'Dspl.diagnosticSpecialities_deleted' => 0));
        $this->db->order_by("Dspl.creationTime", "desc"); 
        $data= $this->db->get();
        return $data->result();
      }
      
    function fetchTableData($select = array(),$tableName,$condition = array(),$notIn = array(),$fieldName =''){

        $this->db->select(implode(",",$select));
        $this->db->from($tableName);
        foreach($condition as $key=>$val){
            $this->db->where($key, $val); 
        }
        if(!empty($notIn))
            $this->db->where_not_in($fieldName,$notIn);
        $data= $this->db->get(); 
      
     return $data->result();
    }
    
    function createCSVdata($where,$search = ''){
        $imgUrl = base_url() . 'assets/diagnosticsImage/thumb/original/';
        $this->db->select('diagnostic_name,city_name,diagnostic_phn,diagnostic_address');
        $this->db->from('qyura_diagnostic');
        $this->db->join('qyura_city','city_id = diagnostic_cityId','left');
        foreach($where as $key=>$val){
           
            if($where[$key] === 0){
            $this->db->where($key, $val); 
            }
            if($where[$key] != ''){
            $this->db->where($key, $val); 
            }
        }
        
        if(!empty($search)){
            $this->db->group_start();
            $this->db->or_like('diagnostic_name', $search);
            $this->db->or_like('diagnostic_phn', $search);
            $this->db->or_like('diagnostic_address', $search);
            $this->db->group_end();
        }
    
        $data= $this->db->get(); 
        $result= array();
        $i=1;
        foreach($data->result() as $key=>$val){
           // $result[$i]['diagnostic_img'] = $imgUrl.$val->diagnostic_img;
            $result[$i]['diagnostic_name'] = $val->diagnostic_name;
            $result[$i]['city_name'] = $val->city_name;
            $result[$i]['diagnostic_phn'] = $val->diagnostic_phn;
            $result[$i]['diagnostic_address'] = $val->diagnostic_address;
           $i++;
        }
         return $result;
        
      }
      
      // fetch insurance
    function fetchInsurance($diagnosticId) {
        
        $this->db->select('dInsurance.diagnoInsurance_id, dInsurance.diagnoInsurance_insuranceId, Insu.insurance_Name, Insu.insurance_img');
        $this->db->from('qyura_diagnoInsurance AS dInsurance');
        $this->db->join('qyura_insurance AS Insu', 'Insu.insurance_id = dInsurance.diagnoInsurance_insuranceId', 'left');
        $this->db->where(array('dInsurance.diagnoInsurance_diagnoId' => $diagnosticId, 'Insu.insurance_deleted' => 0, 'dInsurance.diagnoInsurance_deleted' => 0));

        $data = $this->db->get();
        return $data->result();
    }
    
     // remove insurance company from hospital
    function deletInsurance($id = null) {
        $response = '';
        if ($id != null)
            $response = $this->db->delete('qyura_diagnoInsurance', array('diagnoInsurance_id' => $id));

        if ($response) {
            echo json_encode(array('status' => 1, 'message' => 'insurance successfully reomved!'));
        } else {
            echo json_encode(array('status' => 0, 'message' => 'some error occurred while removing insurance company!'));
        }
    }
    function getDoctorDetail($condition){
       
       
        $imgUrl = base_url() . 'assets/doctorsImages/thumb/thumb_100/$1';
        $this->db->select('doc.doctors_id, doc.doctors_27Src, doc.isManual,doc.doctors_consultaionFee,doc.doctors_pin,doc.doctors_userId,doc.doctors_fName,doc.doctors_lName,CONCAT(doc.doctors_fName," ",doc.doctors_lName)AS doctoesName,doc.doctors_phn,doc.doctor_addr,doc.doctors_img,doc.doctors_email,doc.doctors_phon,doc.doctors_lat,doc.doctors_long,usr.users_id,doc.doctors_registeredMblNo,
        doc.doctors_countryId,doc.doctors_stateId,doc.doctors_dob,doc.doctors_cityId,doc.creationTime,doc.doctors_mobile,doc.doctors_unqId,usr.users_email, doc.doctors_email, doc.doctors_phon, doc.doctors_showExp,doc.doctors_expYear,spec.specialities_id,spec.specialities_name as specName,deg.degree_id,deg.degree_SName,deg.degree_FName,docAca.doctorAcademic_id,docAca.doctorAcademic_degreeId,docAca.doctorAcademic_degreeInsAddress,docAca.doctorAcademic_degreeYear,docAca.doctorAcademic_specialitiesId');
       
        $this->db->from('qyura_doctors AS doc');
        $this->db->join('qyura_users AS usr', 'usr.users_id = doc.doctors_userId', 'left');
        $this->db->join('qyura_doctorSpecialities as docSpec', 'docSpec.doctorSpecialities_doctorsId=doc.doctors_id', 'left');
        $this->db->join('qyura_specialities as spec', 'spec.specialities_id=docSpec.doctorSpecialities_specialitiesId', 'left');
        $this->db->join('qyura_doctorAcademic as docAca', 'docAca.doctorAcademic_doctorsId=doc.doctors_id', 'left');
        $this->db->join('qyura_degree as deg', 'deg.degree_id=docAca.doctorAcademic_degreeId', 'left');
        if ($condition)
        $this->db->where(array('doc.doctors_id' => $condition));
        $this->db->where(array('doc.doctors_deleted' => 0));
        return  $this->db->get()->result();
   }
   
   function getDocAcaSpec($condition){
       
        $this->db->select('spec.specialities_id, docAca.doctorAcademic_id, degree.degree_FName, degree.degree_SName, degree.degree_id, docAca.doctorAcademic_degreeInsAddress, docAca.doctorAcademic_degreeYear');
       
        $this->db->from('qyura_doctorAcademic AS docAca');
       // $this->db->join('qyura_doctors as doc', 'doc.doctors_id=docAca.doctorAcademic_doctorsId', 'left');
        $this->db->join('qyura_specialities as spec', 'spec.specialities_id=docAca.doctorAcademic_specialitiesId', 'left');
        $this->db->join('qyura_degree as degree', 'degree.degree_id = docAca.doctorAcademic_degreeId', 'left');
        
        if ($condition)
            
        $this->db->where(array('docAca.doctorAcademic_doctorsId' => $condition));
        
       // $this->db->where(array('doc.doctors_deleted' => 0));
        $this->db->where(array('spec.specialities_deleted' => 0,'spec.type' => 1));
        $this->db->where(array('docAca.doctorAcademic_deleted' => 0));

      return  $this->db->get()->result();
       // echo $this->db->last_query();

 
   }
}
