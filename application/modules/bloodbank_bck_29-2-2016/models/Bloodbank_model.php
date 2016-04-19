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
    
    function fetchEmail($email,$usersId = NULL){
        $this->db->select('users_email');
        $this->db->from('qyura_users');
        if($usersId) {
            $this->db->where('users_id !=',$usersId);
        }
         $this->db->where('users_email',$email); 
       $result = $this->db->get();
       // return $this->db->last_query();
       
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
        $this->db->insert('qyura_bloodBank', $insertData); 
      
        $insert_id = $this->db->insert_id();
        //echo $this->db->last_query();exit;
        return  $insert_id;
    }
    
    function fetchbloodBankData( $condition = NULL){
         $this->db->select('blood.bloodBank_id,blood.users_id,blood.bloodBank_name,blood.bloodBank_phn,blood.bloodBank_add,City.city_name,'
                 . 'blood.bloodBank_photo,usr.users_email,usr.users_password ,blood.bloodBank_cntPrsn,blood.bloodBank_lat,blood.bloodBank_long');
     $this->db->from('qyura_bloodBank AS blood');
     $this->db->join('qyura_city AS City','City.city_id = blood.cityId','left');
     $this->db->join('qyura_users AS usr','usr.users_id = blood.users_id','left');
     $this->db->join('qyura_usersRoles AS Roles','Roles.usersRoles_userId = blood.users_id','left'); // changed
     if($condition)
     if($condition)
       $this->db->where(array('blood.bloodBank_id'=> $condition));   
        $this->db->where(array('blood.bloodBank_deleted'=> 0));
        $this->db->where(array('Roles.usersRoles_parentId'=> 0)); // changed
       $this->db->order_by("blood.creationTime", "desc"); 
      $data= $this->db->get(); 
     //echo $this->db->last_query();exit;
     return $data->result();
    }
    
    function insertUsersRoles($insertData){
        $this->db->insert('qyura_usersRoles', $insertData); 
        $insert_id = $this->db->insert_id();
        return true;
    }
    
    function UpdateTableData($data=array(),$where=array(),$tableName = NULL){
        foreach($where as $key=>$val){
            $this->db->where($key, $val); 
        }
       
        $this->db->update($tableName, $data); 
       
        //echo $this->db->last_query();exit;
         return TRUE;
    }
     
}   

