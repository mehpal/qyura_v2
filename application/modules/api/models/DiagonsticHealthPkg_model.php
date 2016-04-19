<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class DiagonsticHealthPkg_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getHealpkgDetail($diagonsticId, $healthPkgId) {
        $healthPkgId = isset($healthPkgId) ? $healthPkgId : '';

        $this->db->select('healthPackage_includesTest');
        $this->db->from('qyura_healthPackage');
        //$this->db->join('qyura_healthPackage', 'qyura_healthPackage.healthPackage_id = qyura_diagonsticPackage.diagonsticPackage_healthPackageId', 'left');
        $this->db->join('qyura_diagnostic', 'qyura_diagnostic.diagnostic_usersId = qyura_healthPackage.healthPackage_MIuserId', 'left');

        $this->db->where(array('diagnostic_id' => $diagonsticId, 'healthPackage_deleted' => 0, 'healthPackage_id' => $healthPkgId, 'qyura_healthPackage.status' => 1));

        $finalResult = array();


        $data = $this->db->get()->result();

        if (!empty($data)) {
            $test = $data[0]->healthPackage_includesTest;
            $response = explode('|', $test);
            $finalResult = array();
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
        } else {
            return $finalResult;
        }
    }

    public function getDiagonHelthPkg($diagonsticId, $healthPkgId) {
        $this->db->select('healthPackage_id,healthPackage_packageTitle,healthPackage_packageId,healthPackage_packageTitle,healthPackage_expiryDateStatus,healthPackage_date,FORMAT(healthPackage_bestPrice,0) as healthPackageFORMA_bestPrice, FORMAT(healthPackage_discountedPrice,0) as healthPackage_discountedPrice ,healthPackage_description,healthPackage_deleted,qyura_healthPackage.modifyTime');
        $this->db->from('qyura_healthPackage');
        // $this->db->join('qyura_diagonsticPackage','qyura_diagonsticPackage.diagonsticPackage_healthPackageId = qyura_healthPackage.healthPackage_id');

        $this->db->join('qyura_diagnostic', 'qyura_diagnostic.diagnostic_usersId = qyura_healthPackage.healthPackage_MIuserId', 'left');

        $this->db->where(array('diagnostic_id' => $diagonsticId, 'healthPackage_id' => $healthPkgId, 'healthPackage_deleted' => 0, 'qyura_healthPackage.status' => 1));
        $this->db->group_by('healthPackage_id');
        return $this->db->get()->result();
    }

}

?>
