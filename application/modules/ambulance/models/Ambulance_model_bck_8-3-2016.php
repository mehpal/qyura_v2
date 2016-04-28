<?php
class Ambulance_model extends CI_Model {
    
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
       // return $this->db->last_query();
        if($result->num_rows() > 0)
            return 1;
        else             
        return 0; 
    } 
        
    function insertAmbulanceUser($insertData){
      $this->db->insert('qyura_users', $insertData); 
       $insert_id = $this->db->insert_id();
       // echo $this->db->last_query();exit;
        return  $insert_id;
    }
    
    function insertAmbulance($insertData){
        //echo "hgfgh";exit;
        $this->db->insert('qyura_ambulance', $insertData); 
      
        $insert_id = $this->db->insert_id();
       //echo $this->db->last_query();exit;
        return  $insert_id;
    }
    
    function fetchambulanceData($condition = NULL){
         $this->db->select('ambulance.ambulance_id,ambulance.ambulance_usersId,City.city_name,ambulance.ambulance_name,ambulance.ambulance_address,ambulance.ambulance_phn,ambulance.ambulance_img,'
                 . 'usr.users_email,usr.users_password ,ambulance.ambulance_cntPrsn,ambulance.ambulance_lat,ambulance.ambulance_long,usr.users_mobile'
                 . ',ambulance.ambulance_27Src,ambulance.ambulanceType,ambulance.ambulance_mmbrTyp');
        $this->db->from('qyura_ambulance AS ambulance');
        $this->db->join('qyura_city AS City','City.city_id = ambulance.ambulance_cityId','left');
        $this->db->join('qyura_users AS usr','usr.users_id = ambulance.ambulance_usersId','left');
       // $this->db->join('qyura_usersRoles AS Roles','Roles.usersRoles_userId = ambulance.ambulance_usersId','left'); // closed because no data will go in user roll table changed
        if($condition)
        $this->db->where(array('ambulance.ambulance_id'=> $condition));

        $this->db->where(array('ambulance.ambulance_deleted'=> 0));
        // $this->db->where(array('Roles.usersRoles_parentId'=> 0)); // changed
       $this->db->order_by("ambulance.creationTime", "desc"); 
      $data= $this->db->get(); 
     // echo $this->db->last_query();exit;
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
    
    function fetchAmbulanceDataTables( $condition = NULL){
            
         $imgUrl = base_url().'assets/ambulanceImages/thumb/thumb_100/$1';    
         
         $this->datatables->select('ambulance.ambulance_id,ambulance.ambulance_usersId,City.city_name,ambulance.ambulance_name,ambulance.ambulance_address,ambulance.ambulance_phn,ambulance.ambulance_img,'
                 . 'usr.users_email,usr.users_password ,ambulance.ambulance_cntPrsn,ambulance.ambulance_lat,ambulance.ambulance_long,usr.users_mobile'
                 . ',ambulance.ambulance_27Src,ambulance.ambulanceType,ambulance.ambulance_mmbrTyp');
        $this->datatables->from('qyura_ambulance AS ambulance');
        $this->datatables->join('qyura_city AS City','City.city_id = ambulance.ambulance_cityId','left');
        $this->datatables->join('qyura_users AS usr','usr.users_id = ambulance.ambulance_usersId','left');

 
        $search = $this->input->post('bloodBank_name');
        if($search){
            $this->db->or_like('ambulance.ambulance_name',$search);
            $this->db->or_like('ambulance.ambulance_address',$search);
           $this->db->or_like('ambulance.ambulance_phn',$search);
            
        }
     
        $city = $this->input->post('cityId');
        isset($city) && $city != '' ? $this->datatables->where('ambulance_cityId', $city) : '';
        
        $states = $this->input->post('hosStateId');
        isset($states) && $states != '' ? $this->datatables->where('ambulance_stateId', $states) : '';
        
      
        $this->datatables->order_by('ambulance_id');
        
 if($condition)
        $this->datatables->where(array('ambulance.ambulance_id'=> $condition));

        $this->datatables->where(array('ambulance.ambulance_deleted'=> 0));
        
       $this->datatables->add_column('ambulance_img', '<img class="img-responsive" height="80px;" width="80px;" src='.$imgUrl.'>', 'ambulance_img');
       
              $this->datatables->add_column('ambulance_address', '$1 </br><a  href="ambulance/map/$2" class="btn btn-info btn-xs waves-effect waves-light" target="_blank">View Map</a>', 'ambulance_address,ambulance_id');
       
         $this->datatables->add_column('view', '<a class="btn btn-warning waves-effect waves-light m-b-5 applist-btn" href="ambulance/detailAmbulance/$1">View Detail</a>', 'ambulance_id');

        return $this->datatables->generate(); 
        // echo $this->datatables->last_query();

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
    
    function createCSVdata($where){
        $imgUrl = base_url() . 'assets/ambulanceImages/thumb/original/';
        $this->db->select('ambulance_img,ambulance_name,city_name, SUBSTRING(ambulance_phn, 1, CHAR_LENGTH(ambulance_phn)-1)AS phone,ambulance_address');
        $this->db->from('qyura_ambulance');
        $this->db->join('qyura_city','city_id = ambulance_cityId','left');
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
            $result[$i]['ambulance_img'] = $imgUrl.$val->ambulance_img;
            $result[$i]['ambulance_name'] = $val->ambulance_name;
            $result[$i]['city_name'] = $val->city_name;
            $result[$i]['ambulance_phn'] = $val->phone;
            $result[$i]['ambulance_address'] = $val->ambulance_address;
           $i++;
        }
         return $result;
        
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
}   

