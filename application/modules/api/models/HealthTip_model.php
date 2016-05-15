<?php
if(!defined('BASEPATH'))
{
    exit('No direct script access allowed');
}

class HealthTip_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();
	
    }
    
    public function getSponsorTip($city, $date) {
//        echo $city;die();
        $this->db->select('healthTips_id as tipId,category_name as tipCategory,healthTips_detail as tipDetail, CONCAT("assets/Health_tipimages","/",healthTips_image) as tipImage,(CASE WHEN (hospital_name is not null) THEN hospital_name WHEN (diagnostic_name is not null) THEN diagnostic_name WHEN (doctors_fName is not null) THEN CONCAT(doctors_fName, " ",doctors_lName) END) AS `sponsorBy`');
        $this->db->from('qyura_healthTipSponsor as hSponsor');
        
        $this->db->join('qyura_healthTips as htip', 'htip.healthTips_id = hSponsor.sponsor_tipId', 'inner');
        $this->db->join('qyura_healthCategory as hCat', 'hCat.category_id = htip.healthTips_categoryId', 'inner');
        // For Respective User 
        $this->db->join('qyura_usersRoles', 'qyura_usersRoles.usersRoles_userId = hSponsor.sponsor_userId', 'left');
        $this->db->join('qyura_doctors', 'qyura_doctors.doctors_userId = hSponsor.sponsor_userId', 'left');
        $this->db->join('qyura_hospital', 'qyura_hospital.hospital_usersId = hSponsor.sponsor_userId', 'left');
        $this->db->join('qyura_diagnostic', 'qyura_diagnostic.diagnostic_usersId = hSponsor.sponsor_userId', 'left');
        
        $this->db->where(array('hSponsor.sponsor_cityId' => $city, "hSponsor.sponsor_date"=>$date,"hSponsor.sponsor_deleted"=>0,"htip.healthTips_deleted"=>0,"hCat.category_deleted"=>0));
        $this->db->group_by('tipId');
        $this->db->limit(20);
        
        return $this->db->get()->result();
        echo $this->db->last_query();die();
    }
    
    
    public function getRandomTip($date) {
        
        $date = date("Y-m-d");
        $date = strtotime($date);
        
        $select = 'healthTips_id as tipId, category_name as tipCategory,healthTips_detail as tipDetail, CONCAT("assets/Health_tipimages","/",healthTips_image) as tipImage,0 as sponsorBy';
        $tbl = "qyura_healthTips as htip";
        $this->db->select($select)->from($tbl)
                ->join('qyura_healthCategory as hCat', 'hCat.category_id = htip.healthTips_categoryId', 'inner')
                ->where(array( "htip.healthTip_todayDate"=>$date,"htip.healthTip_todayTip"=>1,"htip.healthTips_deleted"=>0,"hCat.category_deleted"=>0))
                ->limit(1);
        $tip = $this->db->get()->row();
        
        if(isset($tip) && $tip != NULL){
            return $tip;
        }else{
            $this->db->select($select)
                    ->from($tbl)
                    ->join('qyura_healthCategory as hCat', 'hCat.category_id = htip.healthTips_categoryId', 'inner')
                    ->where(array("htip.healthTips_deleted"=>0,"hCat.category_deleted"=>0))
                    ->limit(1);
            $tip = $this->db->get()->row();
//            print_r($tip);
            if(isset($tip) && $tip != NULL){
//                echo $tip->tipId;
                $option = array(
                    "table"=>$tbl,
                    "data"=>array("healthTip_todayDate"=>$date,"healthTip_todayTip"=>1),
                    "where"=>array("healthTips_id"=>$tip->tipId)
                );
                $this->db->update($tbl, $option['data'], $option['where']);
//                $this->db->update($option); 
                return $tip;
            }else{
                return FALSE;
            }
        }
    }
} ?>
