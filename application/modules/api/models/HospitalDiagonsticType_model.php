<?php
if(!defined('BASEPATH'))
{
    exit('No direct script access allowed');
}

class HospitalDiagonsticType_model extends My_model
{
    
    public function __construct()
    {
        parent::__construct();
	
    }
    
  public function diagonsticTypeList($hospitalId,$limit=4) {
        $this->db->select('qyura_diagnosticsCat.diagnosticsCat_catName AS name,qyura_hospitalDiagCatTest.hospitalDiagCatTest_diagTestId id, CONCAT("assets/diagnosticsCatImages","/",qyura_diagnosticsCat.diagnosticsCat_catImage) as image');
        $this->db->from('qyura_hospitalDiagCatTest');
        $this->db->join('qyura_diagnosticsCat','qyura_diagnosticsCat.diagnosticsCat_catId = qyura_hospitalDiagCatTest.hospitalDiagCatTest_diagCatId','left');
        $this->db->where(array('qyura_hospitalDiagCatTest.hospitalDiagCatTest_hospitalId'=>$hospitalId,'qyura_hospitalDiagCatTest.hospitalDiagCatTest_deleted'=>0));
         $this->db->group_by('qyura_hospitalDiagCatTest.hospitalDiagCatTest_diagCatId');
        if($limit)
            $this->db->limit($limit);
        return $this->db->get()->result();
//         dump($this->db->last_query());die();   
         
  }
}
?>
