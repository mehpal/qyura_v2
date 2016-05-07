<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class SpecialityApi_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getSpecialityList($type) {
        
        $this->db->select('specialities_id id, (CASE WHEN (speciality_display_format = "1") THEN specialities_drName ELSE specialities_name END) as name, CONCAT("assets/specialityImages/3x","/",specialities_img) img, creationTime as created');
        $this->db->from('qyura_specialities');
        $this->db->where(array('specialities_deleted' => 0,'type' => $type,'status'=>1));
        $this->db->order_by('specialities_id', 'ASC');
        return $this->db->get()->result();
    }
    
    // Doctor's Speciality 
    public function getHosSpecialityList($miId = NULL) {
        
        $where = array('specialities_deleted' => 0,'type' => 1,'status'=>1);
        $where["hospitalSpecialities_hospitalId"] = $miId; 
          
        $this->db->select('(specialities_id) as id, (CASE WHEN (speciality_display_format = "1") THEN specialities_drName ELSE specialities_name END) as name, CONCAT("assets/specialityImages/3x","/",specialities_img) img, '
                . '(SELECT count(doctorSpecialities_doctorsId) from qyura_doctorSpecialities '
                . 'JOIN `qyura_doctors` ON `qyura_doctors`.`doctors_id`=`qyura_doctorSpecialities`.`doctorSpecialities_doctorsId` '
                . 'where `qyura_doctors`.`doctors_parentId` = "'.$miId.'" AND qyura_doctorSpecialities.status = 1 AND `qyura_doctors`.`status` = 1 AND `doctorSpecialities_specialitiesId` = `specialities_id`) as specialityCount');
        
        $this->db->from('qyura_doctorSpecialities');
        $this->db->join("qyura_specialities","qyura_specialities.specialities_id = hospitalSpecialities_specialitiesId","inner");
        $this->db->where($where);
        $this->db->order_by('specialities_id', 'ASC');
        
        return $this->db->get()->result();
        
    }
    
    public function getDiaSpecialityList($miId = NULL) {
        
        $where = array('specialities_deleted' => 0,'type' => 1,'status'=>1);
        $where["diagnosticSpecialities_diagnosticId"] = $miId;
          
        $this->db->select('specialities_id id, (CASE WHEN (diagnostic_specialityNameFormate = "1") THEN specialities_drName ELSE specialities_name END) as name, CONCAT("assets/specialityImages/3x","/",specialities_img) img '
                . '(SELECT count(doctorSpecialities_doctorsId) from qyura_doctorSpecialities '
                . 'JOIN `qyura_doctors` ON `qyura_doctors`.`doctors_id`=`qyura_doctorSpecialities`.`doctorSpecialities_doctorsId` '
                . 'where `qyura_doctors`.`doctors_parentId` = "'.$miId.'" AND qyura_doctorSpecialities.status = 1 AND `qyura_doctors`.`status` = 1 AND `doctorSpecialities_specialitiesId` = `specialities_id`) as specialityCount');
        
        $this->db->from('qyura_diagnosticSpecialities');
        $this->db->join("qyura_specialities","qyura_specialities.specialities_id = diagnosticSpecialities_specialitiesId","inner");
        $this->db->where($where);
        $this->db->order_by('specialities_id', 'ASC');
        return $this->db->get()->result();
    }
}

?>
