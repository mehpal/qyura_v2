<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class HospitalDocCounsultaion_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getConsultantList($notIn, $hospitalUserId, $specialityId, $search) {

        if($search != null){
            $array = array('CONCAT(qyura_doctors.doctors_fName, " ", qyura_doctors.doctors_lName)' => $search, 'degree_SName' => $search,'qyura_specialities.specialities_name'=>$search,'qyura_specialities.specialities_drName'=>$search);
            $this->db->or_like($array); 
        };
                        
        $notIn = isset($notIn) ? $notIn : '';
  $date = date("Y-m-d");
        $this->db->select('qyura_doctors.doctors_id as id,qyura_doctors.doctors_showExp, CONCAT(qyura_doctors.doctors_fName, " ",  qyura_doctors.doctors_lName) AS name, qyura_doctors.doctors_img imUrl, (select MIN(docTimeTable_price) FROM qyura_docTimeTable WHERE qyura_docTimeTable.docTimeTable_doctorId = qyura_doctors.doctors_id ) as consFee,Group_concat(DISTINCT qyura_specialities.specialities_name SEPARATOR ", ") as specialityName, Group_concat(DISTINCT qyura_degree.degree_SName SEPARATOR ", ") as degree, qyura_doctors.doctors_27Src as isEmergency, (YEAR("' . $date . '") - FROM_UNIXTIME(qyura_doctors.doctors_expYear,"%Y")) AS exp ,(
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
 AS `rating` ')
                ->from('qyura_doctors')
                ->join('qyura_doctorAcademic', 'qyura_doctorAcademic.doctorAcademic_doctorsId=qyura_doctors.doctors_id', 'left')
                ->join('qyura_degree', 'qyura_doctorAcademic.doctorAcademic_degreeId=qyura_degree.degree_id', 'left')
                ->join('qyura_doctorSpecialities', 'qyura_doctorSpecialities.doctorSpecialities_doctorsId = qyura_doctors.doctors_id', 'left')
                ->join('qyura_docTimeTable', 'qyura_docTimeTable.docTimeTable_doctorId = qyura_doctors.doctors_id', 'left')
                ->join('qyura_docTimeDay', 'qyura_docTimeDay.docTimeDay_docTimeTableId = qyura_docTimeTable.docTimeTable_id', 'left')
                ->join("qyura_hospital", "qyura_hospital.hospital_usersId = qyura_doctors.doctors_parentId ", "INNER")
                ->join('qyura_specialities', 'qyura_specialities.specialities_id = qyura_doctorSpecialities.doctorSpecialities_specialitiesId', 'left')
                ->join('qyura_reviews', 'qyura_reviews.reviews_relateId=qyura_doctors.doctors_userId', 'left')
                ->join('qyura_ratings', 'qyura_ratings.rating_relateId=qyura_doctors.doctors_userId', 'left')
                ->where(array('doctors_deleted' => 0,'qyura_doctors.status' => 1, 'doctors_parentId' => $hospitalUserId, 'qyura_specialities.specialities_id' => $specialityId,'qyura_specialities.status' => 1))
                ->where_not_in('doctors_id', $notIn)
                ->order_by('name', 'ASC')
                ->group_by('doctors_id')
                ->limit(DATA_LIMIT);

        $response = $this->db->get()->result();
//        echo $this->db->last_query(); exit;
        $finalResult = array();
        if (!empty($response)) {
            foreach ($response as $row) {
                $finalTemp = array();
                $finalTemp[] = isset($row->id) ? $row->id : "";
                $finalTemp[] = isset($row->doctors_showExp) ? $row->doctors_showExp : "0";
                $finalTemp[] = isset($row->name) ? $row->name : "";
                $finalTemp[] = isset($row->exp) ? $row->exp : "0";
                $finalTemp[] = isset($row->imUrl) ? 'assets/doctorsImages/' . $row->imUrl : "";
                $finalTemp[] = isset($row->rating) ? $row->rating : "0";
                $finalTemp[] = isset($row->consFee) ? $row->consFee : "0";
                $finalTemp[] = isset($row->specialityName) ? $row->specialityName : "";
                $finalTemp[] = isset($row->degree) ? $row->degree : "";
                $finalTemp[] = isset($row->isEmergency) ? $row->isEmergency : "0"; 
                $finalResult[] = $finalTemp;
            }
            return $finalResult;
        } else {
            return $finalResult;
        }
    }

    public function getDocTimeSlot($hospitalId, $doctorUserId) {
        // echo $this->getDoctorSession(1); exit;
        $todayWeek = getDay(date("l"));
        $this->db->select('doctorAvailability_id id, doctorAvailability_day day')
                ->from('qyura_doctorAvailability')
                ->join('qyura_doctorAvailabilitySession', 'qyura_doctorAvailability.doctorAvailability_id=qyura_doctorAvailabilitySession.doctorAvailability_refferalId', 'left')
                ->where(array('qyura_doctorAvailability.doctorAvailability_docUsersId' => $doctorUserId, 'doctorAvailability_deleted' => 0, 'doctorAvailability_refferalId' => $hospitalId))
                ->order_by('day', 'ASC');

        // $row = $this->db->get()->row();
        $response = $this->db->get()->result();
        // echo $this->db->last_query(); die();
        $finalResult = array();
        if (!empty($response)) {
            foreach ($response as $row) {
                $finalTemp = array();
                $day = convertNumberToDay(date($row->id));
                $finalResult[$day] = $this->getDoctorSession($row->id, $hospitalId);
            }
            return $finalResult;
        } else {
            return (object) $finalResult;
        }
    }

    public function getDoctorSession($id, $hospitalId) {

        $this->db->select('doctorAvailabilitySession_id,hospital_name as hName, hospital_id hId, doctorAvailabilitySession_start as start, doctorAvailabilitySession_end as end, doctorAvailabilitySession_type as session')
                ->from('qyura_doctorAvailabilitySession')
                ->join('qyura_hospital', 'qyura_hospital.hospital_usersId=qyura_doctorAvailabilitySession.doctorAvailability_refferalId', 'left')
                ->where(array('doctorAvailability_doctorAvailabilityId' => $id, 'hospital_id' => $hospitalId));

        // $row = $this->db->get()->row();
        $response = $this->db->get()->result();
        // echo $this->db->last_query(); die();
        $finalResult = array();
        if (!empty($response)) {
            foreach ($response as $row) {
                $finalTemp = array();
                $finalTemp['sessionid'] = isset($row->doctorAvailabilitySession_id) ? $row->doctorAvailabilitySession_id : "";
                $finalTemp['id'] = isset($row->hId) && $row->hId ? $row->hId : '';
                $finalTemp['name'] = isset($row->hName) && $row->hName != '' ? $row->hName : '';
                $finalTemp['start'] = isset($row->start) ? $row->start : "";
                $finalTemp['end'] = isset($row->end) ? $row->end : "";
                $finalTemp['session'] = isset($row->session) ? getDoctorAvailibilitySession($row->session) : "";
                $finalResult[] = $finalTemp;
            }
            return $finalResult;
        } else {
            return $finalResult;
        }
    }

    public function getHosTimeSlot($hospitalId) {
        $this->db->select('hospitalTimeSlot_id id,hospitalTimeSlot_startTime start,hospitalTimeSlot_endTime end, hospitalTimeSlot_sessionType session')
                 ->from('qyura_hospitalTimeSlot')
                 ->where(array('hospitalTimeSlot_deleted' => 0, 'hospitalTimeSlot_hospitalId' => $hospitalId));
        
                    $response = $this->db->get()->result();
                    // echo $this->db->last_query(); die();
                    $finalResult = array();
                    if (!empty($response)) {
                        foreach ($response as $row) {
                            $finalTemp = array();
                            $finalTemp['id'] = isset($row->id) && $row->id ? $row->id : '';
                            $finalTemp['start'] = isset($row->start) ? $row->start : "";
                            $finalTemp['end'] = isset($row->end) ? $row->end : "";
                            $finalTemp['session'] = isset($row->session) ? getDoctorAvailibilitySession($row->session) : "";
                            $finalResult[] = $finalTemp;
                        }
                        return $finalResult;
                    } else {
                        return $finalResult;
                    }
        }

}

?>
