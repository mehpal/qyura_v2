<?php
if(!defined('BASEPATH'))
{
    exit('No direct script access allowed');
}

class Reviews_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();
	
    }
    
   public function review_isChecked($where = '') {

        if (empty($where)) {
            return FALSE;
        }

        

        return $this->db->where($where)
                        ->order_by("reviews_id", "ASC")
                        ->limit(1)
                        ->count_all_results('qyura_reviews') > 0;
       // echo $this->db->last_query(); exit;
    }
    
   public function setReviewAndRating($table,$data){

           $data = $this->_filter_data($table, $data);

           $this->db->insert($table, $data);

           $id = $this->db->insert_id();

           return $id;

       }
       
   public function getMyReviews($where){
       $this->db->select('reviews_id, (CASE WHEN (hospital_name is not null) THEN hospital_name WHEN (diagnostic_name is not null) THEN diagnostic_name WHEN (doctors_fName is not null) THEN CONCAT(doctors_fName, " ",doctors_lName) END) AS `name`, reviews_details as review, reviews_rating as rating');
        $this->db->from('qyura_reviews');
        $this->db->join('qyura_usersRoles', 'qyura_usersRoles.usersRoles_userId = qyura_reviews.reviews_relateId', 'left');
        $this->db->join('qyura_doctors', 'qyura_doctors.doctors_userId = qyura_reviews.reviews_relateId', 'left');
        $this->db->join('qyura_hospital', 'qyura_hospital.hospital_usersId = qyura_reviews.reviews_relateId', 'left');
        $this->db->join('qyura_diagnostic', 'qyura_diagnostic.diagnostic_usersId = qyura_reviews.reviews_relateId', 'left');
        $this->db->where($where);
        $this->db->group_by('reviews_id');
        $this->db->order_by('qyura_reviews.creationTime', 'desc');
        return $this->db->get()->result();
     }

   }
   
   
?>
