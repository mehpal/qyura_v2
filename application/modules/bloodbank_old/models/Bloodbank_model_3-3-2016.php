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
        $this->db->join('qyura_usersRoles','qyura_usersRoles.usersRoles_userId = qyura_users.users_id','left');
        if($usersId) {
            $this->db->where('qyura_users.users_id !=',$usersId);
        }
        $this->db->where('qyura_usersRoles.usersRoles_roleId',2);
         $this->db->where('qyura_users.users_email',$email); 
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
     //$this->db->join('qyura_usersRoles AS Roles','Roles.usersRoles_userId = blood.users_id','left'); // changed
     if($condition)
       $this->db->where(array('blood.bloodBank_id'=> $condition));   
        $this->db->where(array('blood.bloodBank_deleted'=> 0));
        //$this->db->where(array('Roles.usersRoles_parentId'=> 0)); // changed
       $this->db->order_by("blood.creationTime", "desc"); 
      $data= $this->db->get(); 
     //echo $this->db->last_query();exit;
     return $data->result();
    }
    
    function fetchbloodBankDataTables( $condition = NULL){
            
         $imgUrl = base_url().'assets/BloodBank/thumb/thumb_100/$1';    
         
     $this->datatables->select('blood.bloodBank_id,blood.users_id,blood.bloodBank_name,blood.bloodBank_phn,blood.bloodBank_add,City.city_name,'
                 . 'blood.bloodBank_photo,usr.users_email,usr.users_password ,blood.bloodBank_cntPrsn,blood.bloodBank_lat,blood.bloodBank_long,blood.bloodBank_photo ');
         
     $this->datatables->from('qyura_bloodBank AS blood');
     $this->datatables->join('qyura_city AS City','City.city_id = blood.cityId','left');
     $this->datatables->join('qyura_users AS usr','usr.users_id = blood.users_id','left');
 
         $search = $this->input->post('bloodBank_name');
   
        if($search){
            $this->db->or_like('blood.bloodBank_add',$search);
            $this->db->or_like('blood.bloodBank_name',$search);
            $this->db->or_like('blood.bloodBank_phn',$search);
            
        }
     
        $city = $this->input->post('cityId');
        isset($city) && $city != '' ? $this->datatables->where('cityId', $city) : '';
        
        $states = $this->input->post('hosStateId');
        isset($states) && $states != '' ? $this->datatables->where('stateId', $states) : '';
        
      $this->datatables->order_by('bloodBank_id');
        
     if($condition)
     {
        $this->datatables->where(array('blood.bloodBank_id'=> $condition));  
     }
        $this->datatables->where(array('blood.bloodBank_deleted'=> 0));
        
       $this->datatables->add_column('bloodBank_photo', '<img class="img-responsive"  src='.$imgUrl.'>', 'bloodBank_photo');
       
              /*$this->datatables->add_column('open','08 AM-12 AM');
              $this->datatables->add_column('call','03 PM-08 PM');*/
       
       $this->datatables->add_column('view', '<a class="btn btn-warning waves-effect waves-light m-b-5 applist-btn" href="bloodbank/detailBloodBank/$1">View Detail</a>', 'bloodBank_id');
       
       $this->datatables->add_column('bloodBank_add', '$1 </br><a  href="view-map.html" class="btn btn-info btn-xs waves-effect waves-light" target="_blank">View Map</a>', 'bloodBank_add');
       
        return $this->datatables->generate(); 
      //echo $this->datatables->last_query();

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

