<?php
if(!defined('BASEPATH'))
{
    exit('No direct script access allowed');
}

class Favorite_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();
	
    }
    
   public function fav_check($where = '') {
        

        if (empty($where)) {
            return FALSE;
        }

        

        return $this->db->where($where)
                        ->order_by("fav_id", "ASC")
                        ->limit(1)
                        ->count_all_results('qyura_fav') > 0;
    }
    
    
       public function fav_isChecked($where = '') {
        

        if (empty($where)) {
            return FALSE;
        }

        

        return $this->db->where($where)
                        ->order_by("fav_id", "ASC")
                        ->limit(1)
                        ->count_all_results('qyura_fav') > 0;
       // echo $this->db->last_query(); exit;
    }
    
    public function setFav($table,$data){

        $data = $this->_filter_data($table, $data);

        $this->db->insert($table, $data);

        $id = $this->db->insert_id();
        
        return $id;

    }
    
     public function updateFav($table,$data,$where){

        $data = $this->_filter_data($table, $data);

        $this->db->update($table, $data, $where);

        $id = $this->db->affected_rows();
        
        return $id;

    }


   public function getFavList($userId) {

        $this->db->select('fav_id,(CASE WHEN (hospital_name is not null) THEN hospital_name WHEN (diagnostic_name is not null) THEN diagnostic_name WHEN (doctors_fName is not null) THEN CONCAT(doctors_fName, " ",doctors_lName) END) AS `name`, '
                . '(CASE WHEN (hospital_id is not null) THEN hospital_id WHEN (diagnostic_id is not null) THEN diagnostic_id WHEN (doctors_id is not null) THEN doctors_id END) AS `id`, '
                .'(CASE WHEN (hospital_img is not null) THEN CONCAT("assets/hospitalsImages","/",hospital_img) WHEN (diagnostic_img is not null) THEN CONCAT("assets/diagnosticsImage","/",diagnostic_img) WHEN (doctors_img is not null) THEN CONCAT("assets/doctorsImages","/",doctors_img) END) AS `img`'
                    . ', (CASE WHEN (usersRoles_roleId = 1) THEN "Hospital" WHEN (usersRoles_roleId = 4) THEN "Doctor" WHEN (usersRoles_roleId = 3) THEN "Diagnostic Center" END) AS `type`');
        $this->db->from('qyura_fav');
        $this->db->join('qyura_usersRoles', 'qyura_usersRoles.usersRoles_userId = qyura_fav.fav_relateId', 'left');
        $this->db->join('qyura_doctors', 'qyura_doctors.doctors_userId = qyura_fav.fav_relateId', 'left');
        $this->db->join('qyura_hospital', 'qyura_hospital.hospital_usersId = qyura_fav.fav_relateId', 'left');
        $this->db->join('qyura_diagnostic', 'qyura_diagnostic.diagnostic_usersId = qyura_fav.fav_relateId', 'left');
        $this->db->where(array('fav_userId' => $userId,'fav_deleted' => 0));
        $this->db->group_by('fav_id');
        $this->db->order_by('qyura_fav.creationTime', 'desc');
        return $this->db->get()->result();
    }
    
    
    public function removefav($table,$favId){

        $data = $this->_filter_data($table, $favId);
        foreach ($favId as $key=>$id){
          $this->db->delete($table, array('fav_id' => $id)); 
        }
       return $this->db->affected_rows();

    }
 
    
    
}
?>
