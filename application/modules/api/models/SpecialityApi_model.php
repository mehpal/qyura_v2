<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class SpecialityApi_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getSpecialityList() {
        
        $this->db->select('specialities_id id, specialities_name name,specialities_drName drName, CONCAT("assets/specialityImages/3x","/",specialities_img) img, creationTime as created');
        $this->db->from('qyura_specialities');
        $this->db->where(array('specialities_deleted' => 0));
        $this->db->order_by('specialities_id', 'ASC');
        return $this->db->get()->result();
    }
    
    public function getHosSpecialityList($miId = NULL) {
        
        $where = array('specialities_deleted' => 0);
        $where["hospitalSpecialities_hospitalId"] = $miId; 
          
        $this->db->select('specialities_id id, specialities_name name,specialities_drName drName, CONCAT("assets/specialityImages/3x","/",specialities_img) img, qyura_specialities.creationTime as created, CASE WHEN (`specialities_drName` is not NULL) THEN specialities_drName ELSE  specialities_name END as drName ');
        
        $this->db->from('qyura_hospitalSpecialities');
        $this->db->join("qyura_specialities","qyura_specialities.specialities_id = hospitalSpecialities_specialitiesId","inner");
        $this->db->where($where);
        $this->db->order_by('specialities_id', 'ASC');
        
        return $this->db->get()->result();
        
    }
    
    public function getDiaSpecialityList($miId = NULL) {
        
        $where = array('specialities_deleted' => 0);
        $where["diagnosticSpecialities_diagnosticId"] = $miId;
          
        $this->db->select('specialities_id id, specialities_name name,specialities_drName drName, CONCAT("assets/specialityImages/3x","/",specialities_img) img, qyura_specialities.creationTime as created, CASE WHEN (`specialities_drName` is not NULL) THEN specialities_drName ELSE  specialities_name END as drName ');
        
        $this->db->from('qyura_diagnosticSpecialities');
        $this->db->join("qyura_specialities","qyura_specialities.specialities_id = diagnosticSpecialities_specialitiesId","inner");
        $this->db->where($where);
        $this->db->order_by('specialities_id', 'ASC');
        return $this->db->get()->result();
    }
}

?>
