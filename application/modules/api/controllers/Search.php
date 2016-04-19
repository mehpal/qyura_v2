<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'modules/api/controllers/MyRest.php';

class Search extends MyRest {

    function __construct() {
        // Construct our parent class
        parent::__construct();
        $this->load->helper('common_helper');
        //$this->load->model(array('doctors_model'));
    }
    
  function searchHospital_post(){
      $search = $_POST['search'];
      $lat = $_POST['lat'];
      $long = $_POST['long'];
      $this->db->select('hospital_name,hospital_id, (
                6371 * acos( cos( radians( ' . $lat . ' ) ) * cos( radians( hospital_lat ) ) * cos( radians( hospital_long ) - radians( ' . $long . ' ) ) + sin( radians( ' . $lat . ' ) ) * sin( radians( hospital_lat ) ) )
                ) AS distance')
              
               ->from('qyura_hospital')
              
               ->join('qyura_hospitalSpecialities','qyura_hospitalSpecialities.hospitalSpecialities_hospitalId=qyura_hospital.hospital_id', 'LEFT')
               ->join('qyura_specialities', 'qyura_specialities.specialities_id=qyura_hospitalSpecialities.hospitalSpecialities_specialitiesId', 'LEFT')
              ->join('qyura_hospitalDiagnosticsCat', 'qyura_hospitalDiagnosticsCat.hospitalDiagnosticsCat_hospitalId=qyura_hospital.hospital_id', 'LEFT')
              ->join('qyura_diagnosticsCat', 'qyura_diagnosticsCat.diagnosticsCat_catId=qyura_hospitalDiagnosticsCat.hospitalDiagnosticsCat_diagnosticsCatId', 'LEFT')
              
              ->join('qyura_hospitalDiagCatTest', 'qyura_hospitalDiagCatTest.hospitalDiagCatTest_hospitalId=qyura_hospital.hospital_id', 'LEFT')
              ->join('qyura_diagnosticsTest', 'qyura_diagnosticsTest.diagnostics_id=qyura_hospitalDiagCatTest.hospitalDiagCatTest_diagTestId', 'LEFT')
              
              ->where(array('hospital_deleted'=> 0))
              
              ->like(array('hospital_name' => $search))
      
               ->or_like(array('specialities_name' => $search, 'diagnosticsCat_catName' => $search, 'diagnostics_name'=>$search, 'hospital_address' => $search))
              
              ->having(array('distance <' => USER_DISTANCE))
              
               ->order_by('distance' , 'ASC')
      
               ->group_by('hospital_id');
      
              $response = $this->db->get()->result();
            //  echo '</pre>';
            //  print_r($response);
              
        echo $this->db->last_query();
  }
  
  function searchDiagon_post(){
      $search = $_POST['search'];
      $lat = $_POST['lat'];
      $long = $_POST['long'];
      
      $this->db->select('diagnostic_name,diagnostic_id, (
                6371 * acos( cos( radians( ' . $lat . ' ) ) * cos( radians( diagnostic_lat ) ) * cos( radians( diagnostic_long ) - radians( ' . $long . ' ) ) + sin( radians( ' . $lat . ' ) ) * sin( radians( diagnostic_lat ) ) )
                ) AS distance')
               ->from('qyura_diagnostic')
               
               ->join('qyura_diagnosticsHasCat', 'qyura_diagnosticsHasCat.diagnosticsHasCat_diagnosticId = qyura_diagnostic.diagnostic_id', 'LEFT')
               ->join('qyura_diagnosticsCat','qyura_diagnosticsCat.diagnosticsCat_catId = qyura_diagnosticsHasCat.diagnosticsHasCat_diagnosticsCatId', 'LEFT')
               
               ->join('qyura_DiagnosticDiagCatTest', 'qyura_DiagnosticDiagCatTest.DiagCatTest_diagTestId = qyura_DiagnosticDiagCatTest.DiagCatTest_DiagnosticId', 'LEFT')
               
               ->join('qyura_diagnosticsTest', 'qyura_diagnosticsTest.diagnostics_id = qyura_DiagnosticDiagCatTest.DiagCatTest_diagTestId', 'LEFT')
       
               ->where(array('diagnostic_deleted'=> 0))
              
               ->like(array('diagnosticsCat_catName' => $search))
      
               ->or_like(array('diagnostics_name' => $search, 'diagnostic_address' => $search))
              
              ->having(array('distance <' => USER_DISTANCE))
              
               ->order_by('distance' , 'ASC')
      
               ->group_by('diagnostic_id');
               
              $response = $this->db->get()->result();
              // echo $this->db->last_query();
             echo '</pre>';
             print_r($response);
      
  }
    
}