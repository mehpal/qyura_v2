<?php
class Bloodbank_model extends CI_Model {
    
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
    
    function insertBloodBankUser($insertData){
      $this->db->insert('qyura_users', $insertData); 
       $insert_id = $this->db->insert_id();

        return  $insert_id;
    }
    
    function insertBloodBank($insertData){
        $this->db->insert('qyura_diagnostic', $insertData); 
      
        $insert_id = $this->db->insert_id();
        //echo $this->db->last_query();exit;
        return  $insert_id;
    }
    
    function fetchbloodBankData(){
         $this->db->select('blood.bloodBank_id,blood.users_id,blood.bloodBank_name,blood.bloodBank_phn,blood.bloodBank_add,City.city_name,blood.bloodBank_photo');
     $this->db->from('qyura_bloodBank AS blood');
     $this->db->join('qyura_city AS City','City.city_id = blood.cityId','left');
    $this->db->where(array('blood.bloodBank_deleted'=> 0));
       $this->db->order_by("blood.creationTime", "desc"); 
      $data= $this->db->get(); 
     // echo $this->db->last_query();exit;
     return $data->result();
    }
}   

