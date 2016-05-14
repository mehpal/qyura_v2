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
                ->where(array('qyura_hospital.hospital_deleted' => 0,'qyura_hospital.status' => 0, 'qyura_hospital.isEmergency' => 1))
                
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
                ) AS distance, CONCAT("0","",SUBSTR(pharmacy_phn, -10)) as  phn,pharmacy_27Src as isEmergency, pharmacy_lat lat, pharmacy_long long')
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

    public function getAmbulanceList($lat, $long, $notIn, $cityId = null,$openNow) {

        $lat = isset($lat) ? $lat : '';
        $long = isset($long) ? $long : '';
        $notIn = isset($notIn) ? $notIn : '';
        $notIn = explode(',', $notIn);
        $curDay = getDay(date("l",strtotime(date("Y-m-d"))));

        $this->db->select('ambulance_id id, ambulance_name name, CONCAT("0","",SUBSTR(ambulance_phn, -10)) phn,
(CASE WHEN(hospital_usersId is not null) THEN hospital_usersId WHEN(diagnostic_usersId is not null) THEN diagnostic_usersId ELSE  qyura_ambulance.ambulance_usersId END) as userId,
(CASE WHEN(hospital_usersId is not null) THEN hospital_lat WHEN(diagnostic_usersId is not null) THEN diagnostic_lat ELSE  ambulance_lat END) as lat, 
(CASE WHEN(hospital_usersId is not null) THEN hospital_long WHEN(diagnostic_usersId is not null) THEN diagnostic_long ELSE  ambulance_long END) as lng,  
(CASE WHEN(hospital_usersId is not null) THEN hospital_address WHEN(diagnostic_usersId is not null) THEN diagnostic_address ELSE   ambulance_address END) as adr,            
( 6371 * acos( cos( radians( ' . $lat . ' ) ) * cos( radians( (CASE WHEN(hospital_usersId is not null) THEN hospital_lat WHEN(diagnostic_usersId is not null) THEN diagnostic_lat ELSE  ambulance_lat END) ) ) * cos( radians(  (CASE WHEN(hospital_usersId is not null) THEN hospital_long WHEN(diagnostic_usersId is not null) THEN diagnostic_long ELSE  ambulance_long END) ) - radians( ' . $long . ' ) ) + sin( radians( ' . $lat . ' ) ) * sin( radians( (CASE WHEN(hospital_usersId is not null) THEN hospital_lat WHEN(diagnostic_usersId is not null) THEN diagnostic_lat ELSE  ambulance_lat END) ) ) )
                ) AS distance, docOnBoard, ambulance_usersId as usersId, ambulance_27Src as isEmergency')
                ->from('qyura_ambulance')
                ->join('qyura_usersRoles', 'qyura_usersRoles.usersRoles_userId=qyura_ambulance.ambulance_usersId', 'left') 
                ->join('qyura_hospital', 'qyura_usersRoles.usersRoles_parentId=qyura_hospital.hospital_usersId AND `qyura_hospital`.`status` = 1 AND `qyura_hospital`.`hospital_deleted` = "0"', 'left')
                ->join('qyura_diagnostic', 'qyura_usersRoles.usersRoles_parentId=qyura_diagnostic.diagnostic_usersId AND `qyura_diagnostic`.`status`=1 AND `qyura_diagnostic`.`diagnostic_deleted` = 0', 'left')
                ->where(array('ambulance_deleted' => 0,'qyura_ambulance.status'=>1))
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
//                dump($row);die();
                $userId = (isset($row->userId) ? $row->userId : "");
                $slots  = NULL;
                
                if($userId != "" || $userId != NULL){
                    $slots = $this->common_model->getMITimeSlot($userId,$curDay);
                    //echo $this->db->last_query();
                }
                
                $finalTemp = array();
                $finalTemp[] = isset($row->id) ? $row->id : "";
                $finalTemp[] = isset($row->name) ? $row->name : "";
                $finalTemp[] = isset($row->phn) ? $row->phn : "";
                $finalTemp[] = isset($row->docOnBoard) ? $row->docOnBoard : "";
                
                if($slots != NULL){
                    $finalTemp[] = isset($slots->openingHours) ? $slots->openingHours : "";
                    $finalTemp[] = isset($slots->closingHours) ? $slots->closingHours : "";
                }else{
                    $finalTemp[] = "";
                    $finalTemp[] = "";
                }
                $finalTemp[] = isset($row->isEmergency) ? $row->isEmergency : "0";
                $finalTemp[] = isset($row->adr) ? $row->adr : "";
                $finalTemp[] = isset($row->distance) ? $row->distance : "0";
                
                if ($openNow != NULL || $openNow != 0) {

                    if ($row->isEmergency == 1) {
                        $finalResult[] = $finalTemp;
                    } else {
                        if (($slots->openingHours <= $currentTime && $slots->closingHours >= $currentTime)) {
                            $finalResult[] = $finalTemp;
                        }
                    }
                } else {
                    $finalResult[] = $finalTemp;
                }
                
                
            }
            return $finalResult;
        } else {
            return $finalResult[] = '';
        }
    }

}

?>
