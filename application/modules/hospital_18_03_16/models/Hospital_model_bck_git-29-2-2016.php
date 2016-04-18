<?php

class Hospital_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    function fetchCountry(){
         $this->db->select('country_id,country');
        $this->db->from('qyura_country');
        $this->db->order_by("country","asc");
        return $this->db->get()->result();
    }
    function fetchStates($countryId = NULL) {
        $this->db->select('state_id,state_statename');
        $this->db->from('qyura_state');
        if(!empty($countryId))
         $this->db->where('state_countryid',$countryId);
            
        $this->db->order_by("state_statename","asc");
        return $this->db->get()->result();
    }
    
    function fetchCity ($stateId=NULL){
        $this->db->select('city_id,city_name');
        $this->db->from('qyura_city');
        $this->db->where('city_stateid',$stateId);
        $this->db->order_by("city_name","asc");
        return $this->db->get()->result();
    }
    
    function fetchEmail($email,$usersId = NULL){
        $this->db->select('users_email');
        $this->db->from('qyura_users');
        $this->db->join('qyura_usersRoles','qyura_usersRoles.usersRoles_userId = qyura_users.users_id','left');
        if($usersId) {
            $this->db->where('qyura_users.users_id !=',$usersId);
        }
        $this->db->where('qyura_usersRoles.usersRoles_roleId',1);
         $this->db->where('qyura_users.users_email',$email); 
       $result = $this->db->get();
       //return $this->db->last_query();
       
        if($result->num_rows() > 0)
            return 1;
        else             
            return 0; 
    } 
    
    function inserHospitalUser($insertData){
        
        $this->db->insert('qyura_users', $insertData); 
      
        $insert_id = $this->db->insert_id();

        return  $insert_id;
    }
    function insertHospital($insertData){
        
        $this->db->insert('qyura_hospital', $insertData); 
      
        $insert_id = $this->db->insert_id();

        return  $insert_id;
    }
    
    function insertBloodbank($insertData){
        
        $this->db->insert('qyura_bloodBank', $insertData); 
      
        $insert_id = $this->db->insert_id();

        return  $insert_id;
    }
    
    function insertPharmacy($insertData){
        $this->db->insert('qyura_pharmacy', $insertData); 
      
        $insert_id = $this->db->insert_id();

        return  $insert_id;
    }
    function insertTableData($tableName , $insertData = array()){
        $this->db->insert($tableName, $insertData); 
      
        $insert_id = $this->db->insert_id();
        //echo $this->db->last_query(); exit;
        return  $insert_id;
    }
    
    function insertAmbulance($insertData){
        $this->db->insert('qyura_ambulance', $insertData); 
      
        $insert_id = $this->db->insert_id();

        return  $insert_id;
        
    }
    
    function insertHospitalServiceName($insertData){
        $this->db->insert('qyura_hospitalServices', $insertData); 
      
        $insert_id = $this->db->insert_id();

        return  $insert_id;
        
    }
    
    function fetchHospitalData($conditionId = NULL){
       $this->db->select('Hos.hospital_id,Hos.hospital_zip,Hos.hospital_usersId,Hos.hospital_name,Hos.hospital_phn,Hos.hospital_address,City.city_name,Hos.hospital_img,Hos.hospital_cntPrsn,usr.users_email,Hos.hospital_lat,Hos.hospital_long,usr.users_id,
        Hos.hospital_countryId,Hos.hospital_stateId,Hos.hospital_cityId,Hos.isEmergency,Blood.bloodBank_name,Blood.bloodBank_phn
        , Pharmacy.pharmacy_name,Pharmacy.pharmacy_phn,Hos.hospital_type,Hos.hospital_dsgn,usr.users_mobile,Hos.hospital_mmbrTyp');
     $this->db->from('qyura_hospital AS Hos');
     $this->db->join('qyura_city AS City','City.city_id = Hos.hospital_cityId','left');
      $this->db->join('qyura_users AS usr','usr.users_id = Hos.hospital_usersId','left');
      $this->db->join('qyura_bloodBank AS Blood','Blood.users_id = Hos.hospital_usersId','left');
      $this->db->join('qyura_pharmacy AS Pharmacy','Pharmacy.pharmacy_usersId = Hos.hospital_usersId','left');
        //$this->db->join('qyura_usersRoles AS Roles','Roles.usersRoles_userId = Hos.hospital_usersid','left'); // changed
         if($conditionId){
            $this->db->where(array('Hos.hospital_id'=> $conditionId));
         }
    $this->db->where(array('Hos.hospital_deleted'=> 0));
    //$this->db->where(array('Roles.usersRoles_parentId'=> 0)); // changed
       $this->db->order_by("Hos.creationTime", "desc"); 
      $data= $this->db->get(); 
     return $data->result();
      //echo $this->db->last_query(); exit;
      //echo "<pre>";print_r($data);echo "</pre>";
      //exit;
    }
    
    function insertUsersRoles($insertData){
        $this->db->insert('qyura_usersRoles', $insertData); 
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    function UpdateTableData($data=array(),$where=array(),$tableName = NULL){
        foreach($where as $key=>$val){
            $this->db->where($key, $val); 
        }
       
        $this->db->update($tableName, $data); 
       
        //echo $this->db->last_query();exit;
         return TRUE;
    }
        function fetchHospitalDataTables( $condition = NULL){
            
         $imgUrl = base_url().'assets/hospitalsImages/$1';    
         
       $this->datatables->select('Hos.hospital_id,Hos.hospital_zip,Hos.hospital_usersId,Hos.hospital_name,Hos.hospital_phn,Hos.hospital_address,City.city_name,Hos.hospital_img,Hos.hospital_cntPrsn,usr.users_email,Hos.hospital_lat,Hos.hospital_long,usr.users_id,
        Hos.hospital_countryId,Hos.hospital_stateId,Hos.hospital_cityId');
     $this->datatables->from('qyura_hospital AS Hos');
     $this->datatables->join('qyura_city AS City','City.city_id = Hos.hospital_cityId','left');
      $this->datatables->join('qyura_users AS usr','usr.users_id = Hos.hospital_usersId','left');

 
        $search = $this->input->post('name');
        if($search){
            $this->db->or_like('Hos.hospital_name',$search);
            $this->db->or_like('Hos.hospital_phn',$search);
           $this->db->or_like('Hos.hospital_address',$search);
            
        }
     
        $city = $this->input->post('cityId');
        isset($city) && $city != '' ? $this->datatables->where('hospital_cityId', $city) : '';
        
        $states = $this->input->post('hosStateId');
        isset($states) && $states != '' ? $this->datatables->where('hospital_stateId', $states) : '';
        
      
        
         if($condition)
          $this->datatables->where(array('Hos.hospital_id'=> $condition));
          $this->datatables->where(array('Hos.hospital_deleted'=> 0));
        
       $this->datatables->add_column('hospital_img', '<img class="img-responsive" height="80px;" width="80px;" src='.$imgUrl.'>', 'hospital_img');
       
       $this->datatables->add_column('hospital_address', '$1 </br><a  href="view-map.html" class="btn btn-info btn-xs waves-effect waves-light" target="_blank">View Map</a>', 'hospital_address');
       
      $this->datatables->add_column('view', '<a class="btn btn-warning waves-effect waves-light m-b-5 applist-btn" href="hospital/detailHospital/$1">View Detail</a>', 'hospital_id');

        return $this->datatables->generate(); 
        // echo $this->datatables->last_query();

    }
    
    function fetchTableData($select = array(),$tableName,$condition = array(),$notIn = array(),$fieldName =''){
        //echo 
        $this->db->select(implode(",",$select));
        $this->db->from($tableName);
        foreach($condition as $key=>$val){
            $this->db->where($key, $val); 
        }
        if(!empty($notIn))
            $this->db->where_not_in($fieldName,$notIn);
        $data= $this->db->get(); 
      
     return $data->result();
      //echo $this->db->last_query(); exit;
    }
    
    
    function fetchInsurance($hospitalId){
        $this->db->select('Hos.hospitalInsurance_id,Hos.hospitalInsurance_insuranceId,Insu.insurance_Name,Insu.insurance_img');
        $this->db->from('qyura_hospitalInsurance AS Hos');
        $this->db->join('qyura_insurance AS Insu','Insu.insurance_id = Hos.hospitalInsurance_insuranceId','left');
        $this->db->where(array('Hos.hospitalInsurance_hospitalId' => $hospitalId,'Insu.insurance_deleted' => 0,'Hos.hospitalInsurance_deleted' => 0 ));
    
        $data= $this->db->get(); 
        return $data->result();
    }

      function fetchAllInsurance($insurance_condition = array()){
        $this->db->select('insurance_id,insurance_Name,insurance_img,insurance_detail');
        $this->db->from('qyura_insurance');
        $this->db->where(array('insurance_deleted'=> 0));
         if(!empty($insurance_condition))
             $this->db->where_not_in('insurance_id',$insurance_condition);
        $data= $this->db->get(); 
        //echo $this->db->last_query(); exit;
        return $data->result();
    }
    
    function fetchAwards($hospitalId){
        $this->db->select('hospitalAwards_awardsName,hospitalAwards_id');
        $this->db->from('qyura_hospitalAwards');
         $this->db->where(array('hospitalAwards_deleted'=> 0 , 'hospitalAwards_hospitalId' => $hospitalId));
        $data= $this->db->get(); 
        //echo $this->db->last_query(); exit;
        return $data->result();
    }
    
    function fetchServices($hospitalId){
         $this->db->select('hospitalServices_id,hospitalServices_serviceName');
        $this->db->from('qyura_hospitalServices');
         $this->db->where(array('hospitalServices_deleted'=> 0 , 'hospitalServices_hospitalId' => $hospitalId));
        $data= $this->db->get(); 
        //echo $this->db->last_query(); exit;
        return $data->result();
    }
    
      function fetchhospitalSpecialityData($hospitalId){
         $this->db->select('Spl.specialities_name,Hspl.hospitalSpecialities_id,Hspl.hospitalSpecialities_specialitiesId');
        $this->db->from('qyura_hospitalSpecialities AS Hspl');
        $this->db->join('qyura_specialities AS Spl','Spl.specialities_id = Hspl.hospitalSpecialities_specialitiesId','left');
        $this->db->where(array('Hspl.hospitalSpecialities_hospitalId' => $hospitalId,'Hspl.hospitalSpecialities_deleted' => 0,'Spl.specialities_deleted' => 0));
        $this->db->order_by("Hspl.creationTime", "desc"); 
        $data= $this->db->get(); 
        //echo $this->db->last_query(); exit;
        return $data->result();
      }
      function fetchhospitalDiagonasticData($hospitalId){
         $this->db->select('Dia.diagnosticsCat_catName,Hdia.hospitalDiagnosticsCat_hospitalId,Hdia.hospitalDiagnosticsCat_id');
        $this->db->from('qyura_diagnosticsCat AS Dia');
        $this->db->join('qyura_hospitalDiagnosticsCat AS Hdia','Hdia.hospitalDiagnosticsCat_diagnosticsCatId = Dia.diagnosticsCat_catId','left');
        $this->db->where(array('Hdia.hospitalDiagnosticsCat_hospitalId' => $hospitalId,'Hdia.hospitalDiagnosticsCat_deleted' => 0,'Dia.diagnosticsCat_deleted' => 0));
        $this->db->order_by("Hdia.creationTime", "desc"); 
        $data= $this->db->get(); 
        //echo $this->db->last_query(); exit;
        return $data->result();
      }
    

}
