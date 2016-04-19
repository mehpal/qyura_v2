<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Rate_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

   public function addRate($table,$data)
   {
        $data = $this->_filter_data($table, $data);

        $this->db->insert($table, $data);

        $id = $this->db->insert_id();
        
        return $id;
   }
   
   
   public function getHosAvgRating($hospitalUserId)
   {
           $this->db->select('(
                    CASE 
                     WHEN (reviews_rating is not null AND qyura_ratings.rating is not null) 
                     THEN
                          ROUND( (AVG(reviews_rating+qyura_ratings.rating))/2, 1)
                     WHEN (reviews_rating is not null) 
                     THEN 
                          ROUND( (AVG(reviews_rating)), 1)
                     WHEN (qyura_ratings.rating is not null) 
                     THEN
                          ROUND( (AVG(qyura_ratings.rating)), 1)
                     END)
                     AS `rat` ')
                   ->from('qyura_hospital')
                   ->join('qyura_reviews', 'qyura_reviews.reviews_relateId=qyura_hospital.hospital_usersId', 'left')
                    
                   ->join('qyura_ratings', 'qyura_ratings.rating_relateId=qyura_hospital.hospital_usersId', 'left')
                   ->where(array('qyura_hospital.hospital_usersId' => $hospitalUserId));
                   $result = $this->db->get()->row();
                   return isset($result->rat) && $result->rat != '' ? $result->rat : '';
    }
    
   public function getDiagnosticsAvgRating($diagonsticUserId) {
        $this->db->select('(
                    CASE 
                     WHEN (reviews_rating is not null AND qyura_ratings.rating is not null) 
                     THEN
                          ROUND( (AVG(reviews_rating+qyura_ratings.rating))/2, 1)
                     WHEN (reviews_rating is not null) 
                     THEN 
                          ROUND( (AVG(reviews_rating)), 1)
                     WHEN (qyura_ratings.rating is not null) 
                     THEN
                          ROUND( (AVG(qyura_ratings.rating)), 1)
                     END)
                     AS `rat` ')
                ->from('qyura_diagnostic')
                ->join('qyura_reviews', 'qyura_reviews.reviews_relateId=qyura_diagnostic.diagnostic_usersId', 'left')
                ->join('qyura_ratings', 'qyura_ratings.rating_relateId=qyura_diagnostic.diagnostic_usersId', 'left')
                ->where(array('qyura_diagnostic.diagnostic_usersId' => $diagonsticUserId));
        $result = $this->db->get()->row();
        return isset($result->rat) && $result->rat != '' ? $result->rat : '';
        //echo $this->db->last_query(); exit;
    }
    
   public function getRateByMiId($roleId,$MiId)
   {
       switch ($roleId){
           case ROLE_DOCTORE: 
               $this->
               break;
           case ROLE_HOSPITAL:
               break;
           case ROLE_DIAGNOSTICS:
               break;
           
       }
       
       
        
       
       
   }
   
   function getRating($MiId)
    {
        
        $MiId = $this->input->post('rateTo');
        
        $this->db->select('(
                    CASE 
                     WHEN (reviews_rating is not null AND qyura_ratings.rating is not null) 
                     THEN
                          ROUND( (AVG(reviews_rating+qyura_ratings.rating))/2, 1)
                     WHEN (reviews_rating is not null) 
                     THEN 
                          ROUND( (AVG(reviews_rating)), 1)
                     WHEN (qyura_ratings.rating is not null) 
                     THEN
                          ROUND( (AVG(qyura_ratings.rating)), 1)
                     END)
                     AS `rat` ')
                    ->from('qyura_users')
                    ->join('qyura_reviews', 'qyura_reviews.reviews_relateId=qyura_users.users_id', 'left')
                    ->join('qyura_ratings', 'qyura_ratings.rating_relateId=qyura_users.users_id', 'left')
                    ->where(array('qyura_users.users_id' => $MiId));
                   $result = $this->db->get()->row();
                   
                   return $rat = isset($result->rat) && $result->rat != '' ? $result->rat : '';
                   
    }


   /**
     * rating_check
     *
     * @return bool
     
     * */
    public function rating_check($where = '') {
        

        if (empty($where)) {
            return FALSE;
        }

        

        return $this->db->where($where)
                        ->order_by("rating_id", "ASC")
                        ->limit(1)
                        ->count_all_results('qyura_ratings') > 0;
    }
}
?>
