<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class CronMessage_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

   function getData($tbl=null, $select=null, $con=null,$orderBy=null,$limit=null,$join=null,$between=null,$multiple=TRUE,$groupBy = null)
    {
        
        if($select != null){
            $this->db->select($select);
        }else{
            $this->db->select('*');
        }
        
        $this->db->from($tbl);
        
        if($join != null){
            foreach($join as $j){
                $type = 'inner';
                if(isset($j['type']))
                 $type = $j['type'];
                    
                $this->db->join($j['table'], $j['relation'],$type);
            }
        }
        
        if($con != null)
            $this->db->where($con);
        
        if($between != null)
            $this->db->where($between);
        
        if($groupBy != null) //$this->db->order_by('title desc, name asc'); 
            $this->db->group_by($groupBy); 
        
        if($orderBy != null) //$this->db->order_by('title desc, name asc'); 
            $this->db->order_by($orderBy);
        
        if($limit != null) //$this->db->order_by('title desc, name asc'); 
            $this->db->limit($limit);
        
        $query=$this->db->get();
//        echo $this->db->last_query();
        if($query->num_rows() >0){
            if($multiple){
                return $query->result();
            }
            else {
                return $query->row();
            }
        }
        else
            return FALSE;
    }
    

}

?>
