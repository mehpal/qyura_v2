<?php

class Healthtip_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    
    function fetchCategory (){
        $this->db->select('category_id,category_name');
        $this->db->from('qyura_healthCategory');
        $this->db->where('category_deleted',0);
        $this->db->order_by("category_name","asc");
        return $this->db->get()->result();
    }
   
    
    
    function insertTableData($tableName , $insertData = array()){
        $this->db->insert($tableName, $insertData); 
      
        $insert_id = $this->db->insert_id();
        //echo $this->db->last_query(); exit;
        return  $insert_id;
    }
    
    function insertHealthtip($insertData){
        
        $this->db->insert('qyura_healthTips', $insertData); 
      
        $insert_id = $this->db->insert_id();

        return  $insert_id;
        
    }
    
   
    
    //Prachi
    function fetchHealthtipData($conditionId = NULL){
       $this->db->select('HTip.healthTips_image,HTip.healthTips_categoryId,HTip.healthTips_detail,HTip.healthTips_amount,Cat.category_name');
     $this->db->from('qyura_healthTips AS HTip');
     $this->db->join('qyura_healthCategory Cat','HTip.healthTips_categoryId = Cat.category_id');
         if($conditionId){
            $this->db->where(array('HTip.healthTips_id'=> $conditionId));
         }
         $this->db->where(array('HTip.healthTips_deleted'=> 0));
         $this->db->order_by("HTip.creationTime", "desc"); 
      $data= $this->db->get(); 
      
     return $data->result();
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
    function fetchHealthtipDataTables( $condition = NULL){
            
    $imgUrl = base_url().'assets/Health_tipimages/$1'; 
         
    $this->datatables->select('HTip.healthTips_id,HTip.healthTips_image,HTip.healthTips_categoryId,HTip.healthTips_detail,HTip.healthTips_amount,Cat.category_name');
    $this->datatables->from('qyura_healthTips AS HTip');
    $this->datatables->join('qyura_healthCategory Cat','HTip.healthTips_categoryId = Cat.category_id');

 
    $search = trim($this->input->post('category_name'));
    
        if($search){
            $this->datatables->like('Cat.category_name',$search);     
        }
        if($condition)
             $this->datatables->where(array('Hos.hospital_id'=> $condition));
      $this->datatables->where(array('HTip.healthTips_deleted'=> 0));
      
        $this->datatables->add_column('healthtip_img', '<img class="img-responsive" height="80px;" width="80px;" src='.$imgUrl.'>', 'healthTips_image'); 
        $this->datatables->add_column('view', '<div><a class="btn btn-warning waves-effect waves-light m-b-5 applist-btn" href="healthtip/detailHealthtip/$1" style="color : black !important">View Detail</a></div><div><a class="btn btn-appointment waves-effect waves-light m-l-10 pull-left" href="healthtip/deleteHealthtip/$1" >Delete</a></div>', 'healthTips_id');
       
       
      
        $this->datatables->order_by("HTip.creationTime"); 
       return $this->datatables->generate(); 
        //echo $this->db->last_query();exit;
        

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
      //echo $this->db->last_query(); exit;
     return $data->result();
      //echo $this->db->last_query(); exit;
    }
    
    
    
      
      
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
    
    
           //Function for insert
    public function customInsert($options) {
        $table = false;
        $data = false;

        extract($options);

        $this->db->insert($table, $data);

        return $this->db->insert_id();
    }
    
    function deleteTable($tableName,$where = array()){
        $this->db->delete($tableName, $where); 
        return TRUE;

    }
    
   
    
    function createCSVdata($where){
       $imgUrl = base_url().'assets/Health_tipimages/'; 
        
        
    $this->db->select('HTip.healthTips_image,HTip.healthTips_categoryId,HTip.healthTips_detail,HTip.healthTips_amount,Cat.category_name');
    $this->db->from('qyura_healthTips AS HTip');
    $this->db->join('qyura_healthCategory Cat','HTip.healthTips_categoryId = Cat.category_id');
    foreach($where as $key=>$val){       
        if($where[$key] === 0)
        {
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
           // $result[$i]['hospital_img'] = $imgUrl.$val->healthTips_image;
            $result[$i]['hospital_name'] = $val->category_name;
            $result[$i]['city_name'] = $val->healthTips_detail;
            $result[$i]['hospital_phn'] = $val->healthTips_amount;
           $i++;
        }
         return $result;
        
      }

}
