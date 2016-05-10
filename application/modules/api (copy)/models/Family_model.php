<?php
if(!defined('BASEPATH'))
{
    exit('No direct script access allowed');
}

class Family_model extends CI_Model
{
    
    public function __construct() {  
        parent::__construct(); 
    }
    
    public function getRelations() {
        $this->db->select('relation_id,relation_type')
            ->from('qyura_familyRelation')
            ->where(array("relation_delete"=>0));
        return $this->db->get()->result();
    }
    
    public function addMember($table,$data) {
        
        $data = $this->_filter_data($table, $data);

        $this->db->insert($table, $data);

        $id = $this->db->insert_id();
        
        return $id;
    }
    
    public function editMember($table,$data,$where) {
        
        $data = $this->_filter_data($table, $data);

        $id = $this->db->update($table, $data,$where);
        
        return $id;
    }
    
    public function memberList($userId) {
        
        $this->db->select('usersfamily_id as id,usersfamily_name as name, usersfamily_gender as gender, usersfamily_age as age, usersfamily_relationId as relationId , relation_type as relation') 
                ->from('qyura_usersFamily')
                ->join("qyura_familyRelation","relation_id = usersfamily_relationId","inner") 
                ->where(array('usersfamily_usersId' => $userId,'usersfamily_deleted' => 0));
        
        return $this->db->get()->result();
        
    }
    
    
} ?>
