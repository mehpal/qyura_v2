<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class DiagonsticType_model extends My_model {

    public function __construct() {
        parent::__construct();
    }

    public function diagonsticTypeList($diagonsticId, $limit = 10) {
          $this->db->select('qyura_diagnosticsCat.diagnosticsCat_catName AS name,diagnosticsCat_catId as id, CONCAT("assets/diagnosticsCatImages","/",qyura_diagnosticsCat.diagnosticsCat_catImage) as image')
        
         ->from('qyura_diagnosticsHasCat')

         ->join('qyura_diagnosticsCat', 'qyura_diagnosticsCat.diagnosticsCat_catId=qyura_diagnosticsHasCat.diagnosticsHasCat_diagnosticsCatId','left')
         ->where(array('diagnosticsHasCat_diagnosticId'=>$diagonsticId,'diagnosticsCat_deleted'=>0));
         if($limit)
            $this->db->limit($limit);
        
       return  $this->db->get()->result();
    }

}

?>
