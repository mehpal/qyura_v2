<?php
class Bloodbank_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
     function fetchCountry() {
        $this->db->select('country_id,country');
        $this->db->from('qyura_country');
        $this->db->order_by("country", "asc");
        return $this->db->get()->result();
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
    
    // check existence
    function checkExisting($email){
        
           $query = 'SELECT count(users_id) as isExit FROM qyura_users INNER JOIN qyura_usersRoles ON qyura_users.users_id = qyura_usersRoles.usersRoles_userId WHERE users_email = "'.$email.'" AND usersRoles_roleId = '.ROLE_HOSPITAL.' AND (SELECT count(users_id) FROM qyura_users INNER JOIN qyura_usersRoles ON qyura_users.users_id = qyura_usersRoles.usersRoles_userId WHERE users_email = "'.$email.'" AND usersRoles_roleId = '.ROLE_BLOODBANK.' ) > 0 ' ;
         
      $data =  $this->db->query($query)->result();
    
      if($data[0]->isExit == 1){
          
          echo json_encode(array('status' => 0 ,'message'=> 'already exist'));
          
      }elseif($data[0]->isExit == 0){
          
          $query2 = 'SELECT count(users_id) userId, hospital_address, hospital_lat, hospital_long, hospital_usersId FROM qyura_users INNER JOIN qyura_usersRoles ON qyura_users.users_id = qyura_usersRoles.usersRoles_userId INNER JOIN qyura_hospital ON qyura_hospital.hospital_usersId = qyura_users.users_id WHERE users_email = "'.$email.'" AND usersRoles_roleId = '.ROLE_HOSPITAL.' ';
          $getData = $this->db->query($query2)->result();
          
          if($getData[0]->userId == 1){
              
              echo json_encode(array('status' => 1 , 'message'=> 'hospital exist', 'address' => $getData[0]->hospital_address, 'lat' =>  $getData[0]->hospital_lat, 'lng' => $getData[0]->hospital_long, 'userId' => $getData[0]->hospital_usersId));
              
          }else{
              
               echo json_encode(array('status' => 2 ,'message'=> 'new user'));
               
          }
      
          
      }
           
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
         $this->db->select('blood.bloodBank_id,blood.users_id,blood.bloodBank_name,blood.bloodBank_phn,blood.bloodBank_add,City.city_name,blood.bloodBank_docatId,'
                 . 'blood.bloodBank_photo,usr.users_email,usr.users_password, usr.users_mobile, blood.bloodBank_cntPrsn,blood.bloodBank_lat,blood.bloodBank_long,blood.bloodBank_background_img, blood.bloodBank_mbl, blood.bloodBank_isManual,blood.bloodBank_zip, blood.countryId, blood.stateId, blood.cityId');
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
         $table ="qyura_bloodBank";
         
     $this->datatables->select('blood.bloodBank_id as id,blood.users_id,blood.bloodBank_name,blood.bloodBank_phn,blood.bloodBank_add,City.city_name,'
                 . 'blood.bloodBank_photo,usr.users_email,usr.users_password ,blood.bloodBank_cntPrsn,blood.bloodBank_lat,blood.bloodBank_long,blood.bloodBank_photo,blood.status as sts ');
         
     $this->datatables->from('qyura_bloodBank AS blood');
     $this->datatables->join('qyura_city AS City','City.city_id = blood.cityId','left');
     $this->datatables->join('qyura_users AS usr','usr.users_id = blood.users_id','left');
 
         $search = $this->input->post('bloodBank_name');
   
        if($search != ''){
            $this->db->group_start();
            $this->db->or_like('blood.bloodBank_add',$search);
            $this->db->or_like('blood.bloodBank_name',$search);
            $this->db->or_like('blood.bloodBank_phn',$search);
            $this->db->group_end();
            
        }
     
        $city = $this->input->post('cityId');
        isset($city) && $city != '' ? $this->datatables->where('cityId', $city) : '';
        
        $states = $this->input->post('status');
        $states != '' ? $this->datatables->where('blood.status', $states) : '';
        
     
     $this->datatables->order_by('bloodBank_id');
        
     if($condition)
     {
        $this->datatables->where(array('blood.bloodBank_id'=> $condition));  
     }
        $this->datatables->where(array('blood.bloodBank_deleted'=> 0));
        
       $this->datatables->add_column('bloodBank_photo', '<img class="img-responsive"  src='.$imgUrl.'>', 'bloodBank_photo');
       
              /*$this->datatables->add_column('open','08 AM-12 AM');
              $this->datatables->add_column('call','03 PM-08 PM');*/
       
       
       
       
       $this->datatables->add_column('view', '<a class="btn btn-warning waves-effect waves-light m-b-5 applist-btn" href="bloodbank/detailBloodBank/$1">View Detail</a>', 'id');
       
        $this->datatables->add_column('status', '$1', 'statusCheck(bloodbank,qyura_bloodBank,bloodBank_id,id,sts)');
       
       $this->datatables->add_column('bloodBank_add', '$1 </br><a  href="bloodbank/map/$2" class="btn btn-info btn-xs waves-effect waves-light" target="_blank">View Map</a>', 'bloodBank_add,bloodBank_id');
       
       $this->datatables->order_by("blood.creationTime");
       return $this->datatables->generate(); 
      //return $this->datatables->last_query();

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
    function insertTableData($tableName , $insertData = array()){
        $this->db->insert($tableName, $insertData); 
      
        $insert_id = $this->db->insert_id();
        //echo $this->db->last_query(); exit;
        return  $insert_id;
    }
    
    function fetchbloodBankCategoryData( $condition = NULL){
         $this->db->select('Blood.bloodCat_name,Bllcat.bloodCatBank_id,Bllcat.bloodCatBank_Unit,Bllcat.bloodBank_id');
     $this->db->from('qyura_bloodCat AS Blood');
     $this->db->join('qyura_bloodCatBank AS Bllcat','Bllcat.bloodCats_id = Blood.bloodCat_id','right');
     foreach($condition as $key=>$val){
            $this->db->where($key, $val); 
        }
      // $this->db->order_by("blood.creationTime", "desc"); 
      $data= $this->db->get(); 
    // echo $this->db->last_query();exit;
     return $data->result();
    }
    function createCSVdata($where, $orWhere = NULL){
        $imgUrl = base_url() . 'assets/BloodBank/thumb/original/';
        $this->db->select('bloodBank_name, city_name, bloodBank_phn, bloodBank_add');
        $this->db->from('qyura_bloodBank');
        $this->db->order_by('bloodBank_id', 'desc');
        $this->db->join('qyura_city','city_id = cityId','left');
        
        if($orWhere != NULL){
            $this->db->group_start();
            $this->db->or_like($orWhere);
            $this->db->group_end();
        }
        foreach($where as $key=>$val){
           
            if($where[$key] === 0){
            $this->db->where($key, $val); 
            }
            if($where[$key] != ''){
            $this->db->where($key, $val); 
            }
        }
    
        $data= $this->db->get(); 
         
        $result= array();
        $i=1;
        foreach($data->result() as $key=>$val){
           // $result[$i]['bloodBank_photo'] = $imgUrl.$val->bloodBank_photo;
            $result[$i]['bloodBank_name'] = $val->bloodBank_name;
            $result[$i]['city_name'] = $val->city_name;
            $result[$i]['bloodBank_phn'] = $val->bloodBank_phn;
            $result[$i]['bloodBank_add'] = $val->bloodBank_add;
           $i++;
        }
         return $result;
        
      }
}   

