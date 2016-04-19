<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Emergency_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getHospitalList($lat, $long, $notIn, $search,$cityId=null) {
        $lat = isset($lat) ? $lat : '';
        $long = isset($long) ? $long : '';
        $search = isset($search) ? $search : '';

        $notIn = isset($notIn) ? $notIn : '';
        $notIn = explode(',', $notIn);

        $this->db->select('hospital_id as id, hospital_deleted as fav, hospital_deleted as rat, hospital_address as adr ,hospital_name name, concat("+","",hospital_phn) phn, hospital_lat lat, hospital_long long, qyura_hospital.modifyTime upTm, hospital_img imUrl, (
                6371 * acos( cos( radians( ' . $lat . ' ) ) * cos( radians( hospital_lat ) ) * cos( radians( hospital_long ) - radians( ' . $long . ' ) ) + sin( radians( ' . $lat . ' ) ) * sin( radians( hospital_lat ) ) )
                ) AS distance, Group_concat(DISTINCT qyura_specialities.specialities_name order by specialities_name) as specialities')
                ->from('qyura_hospital')
                ->join('qyura_hospitalSpecialities', 'qyura_hospitalSpecialities.hospitalSpecialities_hospitalId=qyura_hospital.hospital_id', 'left')
                ->join('qyura_specialities', 'qyura_specialities.specialities_id=qyura_hospitalSpecialities.hospitalSpecialities_specialitiesId', 'left')
                ->where(array('hospital_deleted' => 0, 'isEmergency' => 1))
                
                ->where_not_in('qyura_hospital.hospital_id', $notIn)
                ->order_by('distance', 'ASC')
                ->group_by('hospital_id')
                ->limit(DATA_LIMIT);
        
        if ($cityId != NULL) {
            $cityCon = array('hospital_cityId' => $cityId);
            $this->db->where($cityCon);
        } else {
            $this->db->having(array('distance <' => USER_DISTANCE));
        }

        $response = $this->db->get()->result();
        // echo $this->db->last_query(); die();
        //$aoClumns = array("id","fav","rat","adr", "name","phn","lat","lng","upTm","imUrl","specialities");

        $finalResult = array();
        if (!empty($response)) {
            foreach ($response as $row) {

                $finalTemp = array();
                $finalTemp[] = isset($row->id) ? $row->id : "";
                $finalTemp[] = isset($row->fav) ? $row->fav : "";
                $finalTemp[] = isset($row->rat) ? $row->rat : "";
                $finalTemp[] = isset($row->adr) ? $row->adr : "";
                $finalTemp[] = isset($row->name) ? $row->name : "";
                $finalTemp[] = isset($row->phn) ? $row->phn : "";
                $finalTemp[] = isset($row->lat) ? $row->lat : "";
                $finalTemp[] = isset($row->long) ? $row->long : "";
                $finalTemp[] = isset($row->upTm) ? $row->upTm : "";
                $finalTemp[] = isset($row->imUrl) ? base_url() . 'assets/hospitalsImages/' . $row->imUrl : "";
                $finalTemp[] = isset($row->specialities) ? $row->specialities : "";
                $finalResult[] = $finalTemp;
            }

            return $finalResult;
        } else {
            return $finalResult[] = '';
        }
    }

    public function getDoctorsList($lat, $long, $notIn, $search,$cityId=null) {

        $lat = isset($lat) ? $lat : '';
        $long = isset($long) ? $long : '';
        $search = isset($search) ? $search : '';

        $notIn = isset($notIn) ? $notIn : '';
        $notIn = explode(',', $notIn);

        $this->db->select('qyura_doctors.doctors_id as id, CONCAT(qyura_doctors.doctors_fName, "",  qyura_doctors.doctors_lName) AS name, qyura_professionalExp.professionalExp_start startDate, qyura_professionalExp.professionalExp_end endDate, qyura_doctors.doctors_img imUrl, (
                6371 * acos( cos( radians( ' . $lat . ' ) ) * cos( radians( doctors_lat ) ) * cos( radians( doctors_long ) - radians( ' . $long . ' ) ) + sin( radians( ' . $lat . ' ) ) * sin( radians( doctors_lat ) ) )
                ) AS distance, qyura_doctors.doctors_deleted as rating , qyura_doctors.doctors_consultaionFee as consFee, qyura_specialitiesCat.specialitiesCat_name as specialityCat, Group_concat( DISTINCT qyura_degree.degree_SName) as degree, qyura_doctors.doctors_lat as lat, qyura_doctors.doctors_long as long')
                ->from('qyura_doctors')
                ->join('qyura_usersRoles', 'qyura_usersRoles.usersRoles_userId=qyura_doctors.doctors_userId', 'left')
                ->join('qyura_doctorAcademic', 'qyura_doctorAcademic.doctorAcademic_doctorsId=qyura_doctors.doctors_id', 'left')
                ->join('qyura_professionalExp', 'qyura_professionalExp.professionalExp_usersId=qyura_doctors.doctors_id', 'left')
                ->join('qyura_degree', 'qyura_doctorAcademic.doctorAcademic_degreeId=qyura_degree.degree_id', 'left')
                ->join('qyura_specialitiesCat', 'qyura_specialitiesCat.specialitiesCat_id=qyura_doctorAcademic.doctorSpecialities_specialitiesCatId', 'left')
                ->where(array('doctors_deleted' => 0, 'usersRoles_roleId' => ROLE_DOCTORE, 'usersRoles_parentId' => 0))
                ->having(array('distance <' => USER_DISTANCE))
                ->where_not_in('doctors_id', $notIn)
                ->order_by('distance', 'ASC')
                ->group_by('doctors_id')
                ->limit(DATA_LIMIT);

        if ($cityId != NULL) {
            $cityCon = array('doctors_cityId' => $cityId);
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
                $finalTemp[] = isset($row->startDate) && isset($row->endDate) ? getYearBtTwoDate($row->startDate, $row->endDate) : "";
                $finalTemp[] = isset($row->imUrl) ? base_url() . 'assets/doctorsImages/' . $row->imUrl : "";
                $finalTemp[] = isset($row->rating) ? $row->rating : "";
                $finalTemp[] = isset($row->consFee) ? $row->consFee : "";
                $finalTemp[] = isset($row->specialityCat) ? $row->specialityCat : "";
                $finalTemp[] = isset($row->degree) ? $row->degree : "";
                $finalTemp[] = isset($row->lat) ? $row->lat : "";
                $finalTemp[] = isset($row->long) ? $row->long : "";
                $finalResult[] = $finalTemp;
            }
            return $finalResult;
        } else {
            return $finalResult[] = '';
        }
    }

    public function getPhamacyList($lat, $long, $notIn, $search, $cityId = null) {
        $lat = isset($lat) ? $lat : '';
        $long = isset($long) ? $long : '';
        $search = isset($search) ? $search : '';

        $notIn = isset($notIn) ? $notIn : '';
        $notIn = explode(',', $notIn);


        $this->db->select('qyura_pharmacy.pharmacy_id as id, pharmacy_name name, pharmacy_address adr, pharmacy_img imUrl, (
                6371 * acos( cos( radians( ' . $lat . ' ) ) * cos( radians( pharmacy_lat ) ) * cos( radians( pharmacy_long ) - radians( ' . $long . ' ) ) + sin( radians( ' . $lat . ' ) ) * sin( radians( pharmacy_lat ) ) )
                ) AS distance, CONCAT("+","",pharmacy_phn) phn, pharmacy_lat lat, pharmacy_long long')
                ->from('qyura_pharmacy')
                ->where(array('qyura_pharmacy.pharmacy_deleted' => 0, 'pharmacy_27Src' => 1))
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
                $finalTemp[] = isset($row->imUrl) ? base_url() . 'assets/pharmacyImages/' . $row->imUrl : "";
                $finalTemp[] = isset($row->phn) ? $row->phn : "";
                $finalTemp[] = isset($row->lat) ? $row->lat : "";
                $finalTemp[] = isset($row->long) ? $row->long : "";
                $finalResult[] = $finalTemp;
            }
            return $finalResult;
        } else {
            return $finalResult[] = '';
        }
    }

    public function getAmbulanceList($lat, $long, $notIn, $cityId = null) {

        $lat = isset($lat) ? $lat : '';
        $long = isset($long) ? $long : '';
        $notIn = isset($notIn) ? $notIn : '';
        $notIn = explode(',', $notIn);


        $this->db->select('ambulance_id id, ambulance_name name, CONCAT("+","",ambulance_phn) phn, (
                6371 * acos( cos( radians( ' . $lat . ' ) ) * cos( radians( ambulance_lat ) ) * cos( radians( ambulance_long ) - radians( ' . $long . ' ) ) + sin( radians( ' . $lat . ' ) ) * sin( radians( ambulance_lat ) ) )
                ) AS distance')
                ->from('qyura_ambulance')
                ->where(array('ambulance_deleted' => 0))
                ->where_not_in('ambulance_id', $notIn)
                ->order_by('distance', 'ASC')
                ->group_by('ambulance_id')
                ->limit(DATA_LIMIT);

        if ($cityId != NULL) {
            $cityCon = array('ambulance_cityId' => $cityId);
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
                $finalTemp[] = isset($row->phn) ? $row->phn : "";
                $finalResult[] = $finalTemp;
            }
            return $finalResult;
        } else {
            return $finalResult[] = '';
        }
    }

}

?>
