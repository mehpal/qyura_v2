<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Pharmacy_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getPhamacyList($lat, $long, $notIn, $isemergency, $search, $cityId = NULL) {

        $lat = isset($lat) ? $lat : '';
        $long = isset($long) ? $long : '';
        $notIn = isset($notIn) ? $notIn : '';

        $where = array('qyura_pharmacy.pharmacy_deleted' => 0);
        if ($isemergency != '' && $isemergency != NULL) {

            $where['qyura_pharmacy.pharmacy_27Src'] = $isemergency;
        }

        if ($search != null) {
            $this->db->group_start();
            $array = array('pharmacy_name' => $search, 'pharmacy_address' => $search);
            $this->db->or_like($array);
            $this->db->group_end();
        }

        $this->db->select('qyura_pharmacy.pharmacy_id as id, pharmacy_name name, pharmacy_address adr, pharmacy_img imUrl, IFNULL(hospital_lat, pharmacy_lat) as lat, IFNULL(hospital_long, pharmacy_long) as lng, IFNULL(hospital_address,pharmacy_address) as adr,  (6371 * acos( cos( radians( ' . $lat . ' ) ) * cos( radians( IFNULL(hospital_lat, pharmacy_lat) ) ) * cos( radians( IFNULL(hospital_long, pharmacy_long) ) - radians( ' . $long . ' ) ) + sin( radians( ' . $lat . ' ) ) * sin( radians( IFNULL(hospital_lat, pharmacy_lat) ) ) )
                ) AS distance, pharmacy_phn phn, qyura_pharmacy.pharmacy_27Src isEmergency')
                ->from('qyura_pharmacy')
                ->join('qyura_usersRoles', 'qyura_usersRoles.usersRoles_userId=qyura_pharmacy.pharmacy_usersId', 'left')
                ->join('qyura_hospital', 'qyura_usersRoles.usersRoles_parentId=qyura_hospital.hospital_usersId', 'left')
                ->where($where)
                ->where_not_in('qyura_pharmacy.pharmacy_id', $notIn)
                ->order_by('distance', 'ASC')
                ->group_by('pharmacy_id')
                ->limit(DATA_LIMIT);
        
        if ($cityId != NULL) {
            $cityCon = array('pharmacy_cityId' => $cityId);
            $this->db->where($cityCon);
        } else {
            $this->db->having(array('distance <' => USER_DISTANCE));
        }
        $response = $this->db->get()->result();

        $finalResult = array();
        if (!empty($response)) {
            foreach ($response as $row) {

                $finalTemp = array();
                $finalTemp[] = isset($row->id) ? $row->id : "";
                $finalTemp[] = isset($row->name) ? $row->name : "";
                $finalTemp[] = isset($row->adr) ? $row->adr : "";
                $finalTemp[] = isset($row->imUrl) ? 'assets/pharmacyImages/' . $row->imUrl : "";
                $finalTemp[] = isset($row->phn) ? $row->phn : "";
                $finalTemp[] = isset($row->lat) ? $row->lat : "";
                $finalTemp[] = isset($row->lng) ? $row->lng : "";
                $finalTemp[] = isset($row->isEmergency) ? $row->isEmergency : "";
                $finalResult[] = $finalTemp;
            }
            return $finalResult;
        } else {
            return $finalResult[] = '';
        }
    }

}

?>
