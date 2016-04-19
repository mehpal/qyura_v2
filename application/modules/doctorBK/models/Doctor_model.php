<?php

class Doctor_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    function fetchStates() {
        $this->db->select('state_id,state_statename');
        $this->db->from('qyura_state');
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
    
    function fetchSpeciality(){
        /*$this->db->select('specialitiesCat_id,specialitiesCat_name');
        $this->db->from('qyura_specialitiesCat');
         * this table is disable for the time being
         */
          $this->db->select('specialities_id,specialities_name');
        $this->db->from('qyura_specialities');
        $this->db->where(array('specialities_deleted'=>0));
        $this->db->order_by("specialities_name","asc");
        return $this->db->get()->result(); 
    }
    function fetchDegree(){
        $this->db->select('degree_id,degree_SName');
        $this->db->from('qyura_degree');
        $this->db->where(array('degree_deleted'=> 0));
        $this->db->order_by("degree_SName","asc");
        return $this->db->get()->result(); 
    }
   function fetchHospital(){
        $this->db->select('hospital_id,hospital_name');
        $this->db->from('qyura_hospital');
        $this->db->where(array('hospital_deleted'=> 0));
        $this->db->order_by("hospital_name","asc");
        return $this->db->get()->result(); 
    }
   
    
    function fetchEmail($email,$usersId = NULL){
        $this->db->select('users_email');
        $this->db->from('qyura_users');
        $this->db->join('qyura_usersRoles','qyura_usersRoles.usersRoles_userId = qyura_users.users_id','left');
        if($usersId) {
            $this->db->where('qyura_users.users_id !=',$usersId);
        }
        $this->db->where('qyura_usersRoles.usersRoles_roleId',4);
         $this->db->where('qyura_users.users_email',$email); 
       $result = $this->db->get();
       //return $this->db->last_query();
       
        if($result->num_rows() > 0)
            return 1;
        else             
            return 0; 
    }
    
    function fetchHospitalSpeciality($hospitalId){ //
        $this->db->select('hospitalSpecialities_hospitalId,specialities_id,specialities_name');
         $this->db->from('qyura_hospitalSpecialities');
         $this->db->join('qyura_specialities','qyura_specialities.specialities_id = qyura_hospitalSpecialities.hospitalSpecialities_specialitiesId','left');
         $this->db->where(array('qyura_hospitalSpecialities.hospitalSpecialities_hospitalId'=> $hospitalId,'qyura_specialities.specialities_deleted' => 0));
          $result = $this->db->get();
          return $result->result();
        //return $this->db->last_query();
    }
    
    function insertDoctorUser($insertData){
      $this->db->insert('qyura_users', $insertData); 
       $insert_id = $this->db->insert_id();

        return  $insert_id;
    }
    function insertUsersRoles($insertData){
        $this->db->insert('qyura_usersRoles', $insertData); 
        $insert_id = $this->db->insert_id();
        return true;
    }
    function insertDoctorData($insertData,$tableName = NULL){
        $this->db->insert($tableName, $insertData); 
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    function fetchDoctorData($condition = NULL){
       $this->db->select('doc.doctors_id,doc.doctors_pin,doc.doctors_userId,doc.doctors_fname,doc.doctors_lname,doc.doctors_phn,doc.doctor_addr,City.city_name,doc.doctors_img,usr.users_email,doc.doctors_lat,doc.doctors_long,usr.users_id,
        doc.doctors_countryId,doc.doctors_stateId,doc.doctors_cityId,doc.creationTime,doc.doctors_mobile,doc.doctors_unqId, SUM( FROM_UNIXTIME(qyura_professionalExp.professionalExp_end,"%Y") - FROM_UNIXTIME(qyura_professionalExp.professionalExp_start,"%Y"))  AS exp,GROUP_CONCAT(qyura_specialities.specialities_name) AS speciality');
     $this->db->from('qyura_doctors AS doc');
     $this->db->join('qyura_city AS City','City.city_id = doc.doctors_cityId','left');
      $this->db->join('qyura_users AS usr','usr.users_id = doc.doctors_userId','left');
       $this->db->join('qyura_professionalExp', 'qyura_professionalExp.professionalExp_usersId=doc.doctors_id', 'left');
       
       $this->db->join('qyura_specialities','qyura_specialities.specialities_id=qyura_professionalExp.professionalExp_specialitiesCatId','left');
        //$this->db->join('qyura_usersRoles AS Roles','Roles.usersRoles_userId = Hos.hospital_usersid','left'); // changed
         if($condition)
            $this->db->where(array('doc.doctors_id'=> $condition));
    $this->db->where(array('doc.doctors_deleted'=> 0));
    //$this->db->where(array('Roles.usersRoles_parentId'=> 0)); // changed
       $this->db->order_by("doc.creationTime", "desc"); 
       $this->db->group_by("doc.doctors_id");
      $data= $this->db->get(); 
      // echo $this->db->last_query(); exit;
     return $data->result();
     
      //echo "<pre>";print_r($data);echo "</pre>";
      //exit;
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
      //echo $this->db->last_query(); exit;
    }
    
    function createCSVdata($where){
        $imgUrl = base_url() . 'assets/doctorsImages/thumb/original/';
        $this->db->select('doc.doctors_id,doc.doctors_pin,doc.doctors_userId,doc.doctors_fname,doc.doctors_lname,doc.doctors_phn,doc.doctor_addr,City.city_name,doc.doctors_img,usr.users_email,doc.doctors_lat,doc.doctors_long,usr.users_id,
        doc.doctors_countryId,doc.doctors_stateId,doc.doctors_cityId,doc.creationTime,doc.doctors_mobile,doc.doctors_unqId, SUM( FROM_UNIXTIME(qyura_professionalExp.professionalExp_end,"%Y") - FROM_UNIXTIME(qyura_professionalExp.professionalExp_start,"%Y"))  AS exp,GROUP_CONCAT(qyura_specialities.specialities_name) AS speciality');
     $this->db->from('qyura_doctors AS doc');
     $this->db->join('qyura_city AS City','City.city_id = doc.doctors_cityId','left');
      $this->db->join('qyura_users AS usr','usr.users_id = doc.doctors_userId','left');
       $this->db->join('qyura_professionalExp', 'qyura_professionalExp.professionalExp_usersId=doc.doctors_id', 'left');
       
       $this->db->join('qyura_specialities','qyura_specialities.specialities_id=qyura_professionalExp.professionalExp_specialitiesCatId','left');
        
    $this->db->where(array('doc.doctors_deleted'=> 0));
    //$this->db->where(array('Roles.usersRoles_parentId'=> 0)); // changed
       $this->db->order_by("doc.creationTime", "desc"); 
       $this->db->group_by("doc.doctors_id");
   
        $data= $this->db->get(); 
        //echo $this->db->last_query(); exit;
        $result= array();
        $i=1;
        foreach($data->result() as $key=>$val){
            $result[$i]['doctors_img'] = $imgUrl.$val->doctors_img;
            $result[$i]['doctors_name'] = $val->doctors_fname .' '.$val->doctors_lname;
            $result[$i]['doctors_unqId'] = $val->doctors_unqId;
            $result[$i]['doctor_addr'] = $val->doctor_addr;
            $result[$i]['speciality'] = $val->speciality;
            $result[$i]['exp'] = $val->exp;
            $result[$i]['date_of_joining'] = date("Y-m-d",$val->creationTime);
            $result[$i]['doctors_phn'] = $val->doctors_phn;
            $result[$i]['doctors_mobile'] = $val->doctors_mobile;
           $i++;
           
        }
         return $result;
        
      }
}    