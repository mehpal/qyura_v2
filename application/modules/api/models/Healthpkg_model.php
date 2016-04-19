<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Healthpkg_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getHealpkgDetail($hospitalId,$healthPkgId) {
        $healthPkgId = isset($healthPkgId) ? $healthPkgId : '';
        
        $this->db->select('healthPackage_includesTest');
        $this->db->from('qyura_healthPackage');
      //  $this->db->join('qyura_healthPackage', 'qyura_healthPackage.healthPackage_id = qyura_hospitalPackage.hospitalPackage_healthPackageId', 'left');
        
        $this->db->join('qyura_hospital', 'qyura_hospital.hospital_usersId = qyura_healthPackage.healthPackage_MIuserId', 'left');
      
        $this->db->where(array('hospital_id' => $hospitalId, 'healthPackage_deleted' => 0, 'healthPackage_id' => $healthPkgId));
       // return $this->db->get()->result();
       // echo $this->db->get()->row()->healthPackage_includesTest;
        
        $finalResult = array();
             
             
        $data = $this->db->get()->result(); 
      //  print_r($data); exit;
      //  $test = $data[0]->healthPackage_includesTest;
      // ->healthPackage_includesTest
        if(!empty($data)){
        $test = $data[0]->healthPackage_includesTest;
        $response = explode('|',$test);
   
      //  print_r($response); exit;
        if (!empty($response) && $response != '') {
                foreach ($response as $row) {
                $finalTemp = array();
                $finalTemp['testName'] = isset($row) && $row != '' ? $row : "";
                $finalResult[] = $finalTemp;
            }
            return $finalResult;
        } else {
            return $finalResult;
        }
       }else{
           return $finalResult;
       }
    }
    
    
    public function getHosHelthPkg($hospitalId,$healthPkgId)
    {
        $this->db->select('healthPackage_id,healthPackage_packageTitle,healthPackage_packageId,healthPackage_packageTitle,healthPackage_expiryDateStatus,healthPackage_date,FORMAT(healthPackage_bestPrice,0) as healthPackageFORMA_bestPrice, FORMAT(healthPackage_discountedPrice,0) as healthPackage_discountedPrice ,healthPackage_description,healthPackage_deleted,qyura_healthPackage.modifyTime');
        
        $this->db->from('qyura_healthPackage');
       // $this->db->join('qyura_hospitalPackage','qyura_hospitalPackage.hospitalPackage_healthPackageId = qyura_healthPackage.healthPackage_id', 'left');
        $this->db->join('qyura_hospital', 'qyura_hospital.hospital_usersId = qyura_healthPackage.healthPackage_MIuserId', 'left');
        $this->db->where(array('hospital_id'=>$hospitalId, 'healthPackage_id' =>$healthPkgId, 'healthPackage_deleted'=>0));
        $this->db->group_by('healthPackage_id');
        return $this->db->get()->result();
    }

}

?>
