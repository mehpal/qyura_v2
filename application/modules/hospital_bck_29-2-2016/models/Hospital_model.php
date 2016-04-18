<?php

class Hospital_model extends CI_Model {
    
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
    
    function fetchEmail($email){
        $this->db->select('users_email');
        $this->db->from('qyura_users');
        $this->db->where('users_email',$email);
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
    
    function fetchHotelData(){
       $this->db->select('Hos.hospital_id,Hos.hospital_usersId,Hos.hospital_name,Hos.hospital_phn,Hos.hospital_address,City.city_name,Hos.hospital_img');
     $this->db->from('qyura_hospital AS Hos');
     $this->db->join('qyura_city AS City','City.city_id = Hos.hospital_cityId','left');
    $this->db->where(array('Hos.hospital_deleted'=> 0));
       $this->db->order_by("Hos.creationTime", "desc"); 
      $data= $this->db->get(); 
     return $data->result();
      //echo $this->db->last_query(); exit;
      //echo "<pre>";print_r($data);echo "</pre>";
      //exit;
    }
}
