<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Doctors_model extends My_model {

    public function __construct() {
        parent::__construct();
    }

    public function getDoctorsList($lat, $long, $notIn, $isemergency, $specialityid, $radius, $rating, $exp, $search, $cityId = NULL) {

        $lat = isset($lat) ? $lat : '';
        $long = isset($long) ? $long : '';
        $notIn = isset($notIn) ? $notIn : '';

        if ($search != null) {
            $this->db->join('qyura_doctorServices', 'qyura_doctorServices.doctorServices_doctorId = qyura_doctors.doctors_id', 'left');
            $array = array('CONCAT(qyura_doctors.doctors_fName, " ", qyura_doctors.doctors_lName)' => $search, 'degree_FName' => $search, 'doctor_addr' => $search, 'doctorServices_serviceName' => $search, 'specialities_name' => $search, 'degree_SName' => $search);
            $this->db->group_start();
            $this->db->or_like($array);
            $this->db->group_end();
        }

        // where array
        $where = array('doctors_deleted' => 0, 'usersRoles_roleId' => ROLE_DOCTORE, 'usersRoles_parentId' => 0);
        if ($isemergency != '' && $isemergency != NULL && $isemergency != 0) {
            unset($where['usersRoles_parentId']);
            if ($specialityid != '' && $specialityid != NULL) {
                unset($where['qyura_specialities.specialities_id']);
            }
            $where['qyura_doctors.doctors_27Src'] = $isemergency;
        } elseif ($specialityid != '' && $specialityid != NULL) {
            $where['qyura_specialities.specialities_id'] = $specialityid;
        }

        // having array


        if ($exp != '' && $exp != NULL && $exp != 0) {
            if ($exp == 1) {
                $having['exp <= '] = 5;
            } elseif ($exp == 2) {
                $having['exp >= '] = 5;
                $having['exp <= '] = 10;
            } elseif ($exp == 3) {
                $having['exp >= '] = 10;
            }
            $this->db->having($having);
        }

        if ($rating != '' && $rating != NULL && $rating != 0) {
            $having['rating'] = number_format($rating, 1);
        }
        $date = date("Y-m-d");
        $this->db->select('CONCAT("0", "",  `qyura_doctors`.`doctors_phn`) phn ,qyura_doctors.doctors_showExp as showExp,qyura_doctors.doctors_id as id,qyura_doctors.doctors_userId as userId, CONCAT(qyura_doctors.doctors_fName, " ",  qyura_doctors.doctors_lName) AS name, qyura_doctors.doctors_img imUrl, (
                6371 * acos( cos( radians( ' . $lat . ' ) ) * cos( radians( doctors_lat ) ) * cos( radians( doctors_long ) - radians( ' . $long . ' ) ) + sin( radians( ' . $lat . ' ) ) * sin( radians( doctors_lat ) ) )
                ) AS distance , (select MIN(docTimeTable_price) FROM qyura_docTimeTable WHERE qyura_docTimeTable.docTimeTable_doctorId = qyura_doctors.doctors_id ) as consFee, Group_concat(DISTINCT qyura_specialities.specialities_name) as specialityName, Group_concat(DISTINCT qyura_degree.degree_SName SEPARATOR ", ") as degree, qyura_doctors.doctors_lat as lat, qyura_doctors.doctors_long as long,qyura_doctors.doctors_27Src as isEmergency, (YEAR("' . $date . '") - FROM_UNIXTIME(qyura_doctors.doctors_expYear,"%Y")) AS exp ,(
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
                ->join('qyura_usersRoles', 'qyura_usersRoles.usersRoles_userId=qyura_doctors.doctors_userId', 'left')
                ->join('qyura_doctorAcademic', 'qyura_doctorAcademic.doctorAcademic_doctorsId=qyura_doctors.doctors_id', 'left')
                ->join('qyura_degree', 'qyura_doctorAcademic.doctorAcademic_degreeId=qyura_degree.degree_id', 'left')
                ->join('qyura_doctorSpecialities', 'qyura_doctorSpecialities.doctorSpecialities_doctorsId = qyura_doctors.doctors_id', 'left')
                ->join('qyura_specialities', 'qyura_specialities.specialities_id = qyura_doctorSpecialities.doctorSpecialities_specialitiesId', 'left')
                ->join('qyura_reviews', 'qyura_reviews.reviews_relateId=qyura_doctors.doctors_userId', 'left')
                ->join('qyura_ratings', 'qyura_ratings.rating_relateId=qyura_doctors.doctors_userId', 'left')
                ->where($where)
                ->where_not_in('doctors_id', $notIn)
                ->order_by('distance', 'ASC')
                ->group_by('doctors_id')
                ->limit(DATA_LIMIT);

        if ($cityId != NULL) {
            $cityCon = array('doctors_cityId' => $cityId);
            $this->db->where($cityCon);
        } else {

            $havingRadius = array('distance <=' => $radius);
            $this->db->having($havingRadius);
        }

        $response = $this->db->get()->result();
//        echo $this->db->last_query(); exit;
        $finalResult = array();
        if (!empty($response)) {
            foreach ($response as $row) {
                $newdate = strtotime("-$exp_year year", strtotime($date));
                $exp_year = $newdate;
                $finalTemp = array();
                $finalTemp[] = isset($row->id) ? $row->id : "";
                $finalTemp[] = isset($row->name) ? $row->name : "";
                $finalTemp[] = isset($row->showExp) ? $row->showExp : "0";
                $finalTemp[] = isset($row->exp) ? $row->exp : "";
                $finalTemp[] = isset($row->imUrl) ? 'assets/doctorsImages/' . $row->imUrl : "";
                $finalTemp[] = isset($row->rating) ? $row->rating : "0";
                $finalTemp[] = isset($row->consFee) ? $row->consFee : "0";
                $finalTemp[] = isset($row->specialityName) ? $row->specialityName : "";
                $finalTemp[] = isset($row->degree) ? $row->degree : "";
                $finalTemp[] = isset($row->lat) ? $row->lat : "";
                $finalTemp[] = isset($row->long) ? $row->long : "";
                $finalTemp[] = isset($row->isEmergency) ? $row->isEmergency : "";
                $finalTemp[] = isset($row->phn) ? $row->phn : "";
                $finalTemp[] = isset($row->userId) ? $row->userId : "";
                $finalResult[] = $finalTemp;
            }
            return $finalResult;
        } else {
            return $finalResult;
        }
    }

    public function getDoctorsDetails($doctorId, $userId) {

        $date = date("Y-m-d");

        $this->db->select('doctors_id as id, qyura_doctors.doctors_showExp as showExp, doctors_userId userId,  CONCAT(qyura_doctors.doctors_fName, "",  qyura_doctors.doctors_lName) AS name, qyura_doctors.doctors_img imUrl, (CASE WHEN(fav_userId is not null ) THEN fav_isFav ELSE 0 END) fav, qyura_specialities.specialities_name as specialityName, Group_concat(distinct qyura_degree.degree_SName) as degree, qyura_doctors.doctors_lat as lat, qyura_doctors.doctors_long as long,CONCAT("0","",doctors_phn) as doctors_phn, (YEAR("' . $date . '") - FROM_UNIXTIME(qyura_doctors.doctors_expYear,"%Y"))  AS exp,(select MIN(docTimeTable_price) FROM qyura_docTimeTable WHERE qyura_docTimeTable.docTimeTable_doctorId = qyura_doctors.doctors_id ) as consFee, (
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
                ->join('qyura_specialities', 'qyura_specialities.specialities_id = qyura_doctorSpecialities.doctorSpecialities_specialitiesId', 'left')
                ->join('qyura_reviews', 'qyura_reviews.reviews_relateId=qyura_doctors.doctors_userId', 'left')
                ->join('qyura_ratings', 'qyura_ratings.rating_relateId=qyura_doctors.doctors_userId', 'left')
                ->join('qyura_fav', 'qyura_fav.fav_relateId = qyura_doctors.doctors_userId AND fav_userId = ' . $userId . '  ', 'left')
                ->where(array('doctors_id' => $doctorId, 'doctors_deleted' => 0));

        $row = $this->db->get()->row();
        $finalResult = array();
        $finalTemp = array();

        $finalTemp['id'] = isset($row->id) ? $row->id : "";
        $finalTemp['userId'] = isset($row->userId) ? $row->userId : "";
        $finalTemp['name'] = isset($row->name) ? $row->name : "";
        $finalTemp['phn'] = isset($row->doctors_phn) ? $row->doctors_phn : "";
        $finalTemp['showExp'] = isset($row->showExp) ? $row->showExp : "0";
        $finalTemp['exp'] = isset($row->exp) ? $row->exp : "0";
        $finalTemp['imUrl'] = isset($row->imUrl) ? 'assets/doctorsImages/' . $row->imUrl : "";
        $finalTemp['rating'] = isset($row->rating) ? $row->rating : "0";
        $finalTemp['fav'] = isset($row->fav) ? $row->fav : "";
        $finalTemp['consFee'] = isset($row->consFee) ? $row->consFee : "0";
        $finalTemp['specialityCat'] = isset($row->specialityName) ? $row->specialityName : "";
        $finalTemp['degree'] = isset($row->degree) ? $row->degree : "";
        $finalTemp['lat'] = isset($row->lat) ? $row->lat : "";
        $finalTemp['long'] = isset($row->long) ? $row->long : "";
        return $finalResult[] = $finalTemp;
    }

    public function getDoctorServices($doctorId) {
        $this->db->select('doctorServices_serviceName as services,doctorServices_id id');
        $this->db->from('qyura_doctorServices');
        $this->db->where(array('qyura_doctorServices.doctorServices_doctorId' => $doctorId, 'doctorServicess_deleted' => 0));

        $response = $this->db->get()->result();
        $finalResult = array();
        if (!empty($response)) {
            foreach ($response as $row) {
                $finalTemp = array();
                $finalTemp['id'] = isset($row->id) ? $row->id : "";
                $finalTemp['services'] = isset($row->services) ? $row->services : "";
                $finalResult[] = $finalTemp;
            }
            return $finalResult;
        } else {
            return $finalResult;
        }
    }

      public function getDoctorTimeSlot($doctorId, $lat, $long) {
        
        $todayWeek = getDay(date("l"));
        
        $this->db->select('docTimeTable_doctorId doctorId, docTimeTable_price as fee, '
                . 'CASE WHEN (docTimeTable_stayAt = 0) THEN psChamber_name ELSE  CASE WHEN (docTimeTable_MItype = 1) THEN hospital_name WHEN (docTimeTable_MItype = 2) THEN diagnostic_name ELSE "" END END AS name, '
                . 'CASE WHEN (docTimeTable_stayAt = 0) THEN psChamber_lat ELSE (CASE WHEN (docTimeTable_MItype = 1) THEN hospital_lat WHEN (docTimeTable_MItype = 2) THEN diagnostic_lat ELSE "" END) END AS lat,'
                . ' CASE WHEN (docTimeTable_stayAt = 0) THEN psChamber_lat ELSE (CASE WHEN (docTimeTable_MItype = 1) THEN hospital_lat WHEN (docTimeTable_MItype = 2) THEN diagnostic_lat ELSE "" END) END  AS lng, '
                . 'CASE WHEN (docTimeTable_stayAt = 0) THEN psChamber_name ELSE ( CASE WHEN (docTimeTable_MItype = 1) THEN hospital_name WHEN (docTimeTable_MItype = 2) THEN diagnostic_name ELSE "" END) END AS name, '
                . '( 6371 * acos( cos( radians( ' . $lat . ' ) ) * cos( radians( CASE WHEN (docTimeTable_stayAt = 0) THEN psChamber_lat ELSE  CASE WHEN (docTimeTable_MItype = 1) THEN hospital_lat WHEN (docTimeTable_MItype = 2) THEN diagnostic_lat ELSE "" END END  ) ) * cos( radians( CASE WHEN (docTimeTable_stayAt = 0) THEN psChamber_long ELSE  CASE WHEN (docTimeTable_MItype = 1) THEN hospital_long WHEN (docTimeTable_MItype = 2) THEN diagnostic_long ELSE "" END END  )  ) - radians( ' . $long . ' ) ) + sin( radians( ' . $lat . ' ) ) * sin( radians( CASE WHEN (docTimeTable_stayAt = 0) THEN psChamber_lat ELSE  CASE WHEN (docTimeTable_MItype = 1) THEN hospital_lat WHEN (docTimeTable_MItype = 2) THEN diagnostic_lat ELSE "" END END  ))) AS distance, ')
                
                ->from('qyura_docTimeTable') 
                ->join("qyura_hospital", "qyura_hospital.hospital_id = qyura_docTimeTable.docTimeTable_MIprofileId AND docTimeTable_MItype = 1 AND hospital_deleted = 0 ","left") 
                 
                ->join("qyura_diagnostic", "qyura_diagnostic.diagnostic_id = qyura_docTimeTable.docTimeTable_MIprofileId AND docTimeTable_MItype = 2 AND diagnostic_deleted = 0 ","left") 
                
                ->join("qyura_psChamber", "qyura_psChamber.psChamber_id = qyura_docTimeTable.docTimeTable_MIprofileId AND docTimeTable_stayAt = 0 AND diagnostic_deleted = 0 ","left") 
                
                ->where(array('qyura_docTimeTable.docTimeTable_doctorId' => $doctorId, 'qyura_docTimeTable.status' => 0));

        $response = $this->db->get()->result();
        $finalResult = array();
        if (!empty($response)) {                             
            foreach ($response as $row) {
                dump($row);
                $finalTemp = array();
                $day = convertNumberToDay(date($row->day));
                $finalResult[$day] = $this->getDoctorSession($row->id);
            }
            return $finalResult;
        } else {
            return (object) $finalResult;
        }
    }

    
    
    public function getHosDiagonDetail($doctorUserId) {
        
        $todayWeek = getDay(date("l"));
        
        $this->db->select('doctorAvailability_id id, doctorAvailability_day day')
                ->from('qyura_doctorAvailability') 
                ->where(array('qyura_doctorAvailability.doctorAvailability_docUsersId' => $doctorUserId, 'doctorAvailability_deleted' => 0))
                ->order_by('day', 'ASC');

        $response = $this->db->get()->result();
        $finalResult = array();
        if (!empty($response)) {
            foreach ($response as $row) {
                $finalTemp = array();
                $day = convertNumberToDay(date($row->day));
                $finalResult[$day] = $this->getDoctorSession($row->id);
            }
            return $finalResult;
        } else {
            return (object) $finalResult;
        }
    }

    
    
    public function getDoctorNumReviews($docUserId) {
        $sql = "SELECT COUNT('reviews_id') as reviews
                FROM `qyura_reviews`
                WHERE `reviews_deleted` = '0' and `reviews_relateId` = $docUserId ";
        $query = $this->db->query($sql)->row();
        return $query->reviews;
    }

    public function getDoctorReviews($docUserId) {
        //echo $docUserId; exit;
        $this->db->select('reviews_id as id, reviews_rating rating,reviews_details as reviews, patientDetails_patientName as name, patientDetails_patientImg as img');
        $this->db->from('qyura_reviews');
        $this->db->join('qyura_patientDetails', 'qyura_reviews.reviews_userId = qyura_patientDetails.patientDetails_usersId', 'left');
        $this->db->where(array('reviews_deleted' => 0, 'qyura_reviews.reviews_relateId ' => $docUserId));
        $response = $this->db->get()->result();

        //echo $this->db->last_query(); exit;
        $finalResult = array();
        if (!empty($response)) {
            foreach ($response as $row) {
                $finalTemp = array();
                $finalTemp['id'] = isset($row->id) ? $row->id : '';
                $finalTemp['rating'] = isset($row->rating) ? $row->rating : '';
                $finalTemp['name'] = isset($row->name) && $row->name != '' ? $row->name : '';
                $finalTemp['img'] = isset($row->img) ? 'assets/patientImages/' . $row->img : '';
                $finalTemp['detail'] = isset($row->reviews) && $row->reviews != '' ? substr($row->reviews, 0, 200) : '';
                $finalResult[] = $finalTemp;
            }
            return $finalResult;
        } else {
            return $finalResult;
        }
    }

    public function getDoctorSession($id) {

        $this->db->select('doctorAvailabilitySession_id, IFNULL(hospital_name, diagnostic_name) as name, IFNULL(hospital_id, diagnostic_id) id,  doctorAvailabilitySession_start as start, doctorAvailabilitySession_end as end, doctorAvailabilitySession_type as session, IFNULL(hospital_lat, diagnostic_lat) lat, IFNULL(hospital_long, diagnostic_long) lng, (CASE hospital_id WHEN hospital_id <> 0 then "Hospital" ELSE "Diagno" end) as type ')
                ->from('qyura_doctorAvailabilitySession')
                ->join('qyura_hospital', 'qyura_hospital.hospital_usersId=qyura_doctorAvailabilitySession.doctorAvailability_refferalId', 'left')
                ->join('qyura_diagnostic', 'qyura_diagnostic.diagnostic_usersId=qyura_doctorAvailabilitySession.doctorAvailability_refferalId', 'left')
                // ->where(array('qyura_doctorAvailability.doctorAvailability_docUsersId' => $doctorUserId, 'qyura_doctorAvailability.doctorAvailability_day' => $todayWeek));
                ->where(array('doctorAvailability_doctorAvailabilityId' => $id));

        // $row = $this->db->get()->row();
        $response = $this->db->get()->result();
        // echo $this->db->last_query(); die();
        $finalResult = array();
        if (!empty($response)) {
            foreach ($response as $row) {
                $finalTemp = array();
                $finalTemp['sessionid'] = isset($row->doctorAvailabilitySession_id) ? $row->doctorAvailabilitySession_id : "";
                $finalTemp['id'] = isset($row->id) && $row->id != '' ? $row->id : '';
                $finalTemp['type'] = isset($row->type) && $row->type ? $row->type : '';
                $finalTemp['name'] = isset($row->name) && $row->name != '' ? $row->name : '';
                $finalTemp['start'] = isset($row->start) ? $row->start : "";
                $finalTemp['end'] = isset($row->end) ? $row->end : "";
                $finalTemp['lat'] = isset($row->lat) && $row->lat != '' ? $row->lat : '';
                $finalTemp['long'] = isset($row->lng) && $row->lng != '' ? $row->lng : '';
                $finalTemp['session'] = isset($row->session) ? getDoctorAvailibilitySession($row->session) : "";
                $finalResult[] = $finalTemp;
            }
            return $finalResult;
        } else {
            return $finalResult;
        }
    }

    public function getDocGallery($id) {
        $this->db->select('doctorImages_id, CONCAT("assets/doctorsImages","/",doctorImages_ImagesName) as docImage');
        $this->db->from('qyura_doctorImages');
        $this->db->where(array('doctorImages_doctorId' => $id, 'doctorImages_deleted' => 0));
        return $this->db->get()->result();
    }

    public function getFavList($docUserId) {
        $this->db->select('doctorImages_id, CONCAT("assets/doctorsImages","/",doctorImages_ImagesName) as docImage');
        $this->db->from('qyura_doctorImages');
        $this->db->where(array('doctorImages_doctorId' => $id, 'doctorImages_deleted' => 0));
        return $this->db->get()->result();
    }

    public function getHosTimeSlot($hospitalId, $doctorUserId) {
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

    public function getDiagnoTimeSlot($diagonsticId, $doctorUserId) {

        $this->db->select('diagnosticCenterTimeSlot_id id, diagnosticCenterTimeSlot_startTime start, diagnosticCenterTimeSlot_endTime end, diagnosticCenterTimeSlot_sessionType session')
                ->from('qyura_diagnosticCenterTimeSlot')
                ->where(array('diagnosticCenterTimeSlot_deleted' => 0, 'diagnosticCenterTimeSlot_diagnosticId' => $diagonsticId));

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

    public function getDocTimeSlotForDiagon($diagonsticId, $doctorUserId, $avia = NULL) {
        // echo $this->getDoctorSession(1); exit;
        $where = $this->db->where(array('qyura_doctorAvailability.doctorAvailability_docUsersId' => $doctorUserId, 'doctorAvailability_deleted' => 0));

        if ($avia != NULL) {
            $where = $this->db->where_in('doctorAvailability_id', explode(',', $avia));
        }

        $todayWeek = getDay(date("l"));
        $this->db->select('doctorAvailability_id id, doctorAvailability_day day')
                ->from('qyura_doctorAvailability')
                ->join('qyura_doctorAvailabilitySession', 'qyura_doctorAvailability.doctorAvailability_id=qyura_doctorAvailabilitySession.doctorAvailability_doctorAvailabilityId AND doctorAvailability_refferalId = ' . $diagonsticId . ' ', 'left')
                ->join('qyura_diagnostic', 'qyura_diagnostic.diagnostic_usersId=qyura_doctorAvailabilitySession.doctorAvailability_refferalId', 'left')
                //->where_in('doctorAvailability_id',explode(',',$avia) )
                ->order_by('day', 'ASC');

        // $row = $this->db->get()->row();
        $response = $this->db->get()->result();

        // echo $this->db->last_query(); die();
        $finalResult = array();
        if (!empty($response)) {
            foreach ($response as $row) {
                $finalTemp = array();
                $day = convertNumberToDay(date($row->day));
                $finalResult[$day] = $this->getDoctorSessionForDiagon($row->id, $diagonsticId, '');
            }
            return $finalResult;
        } else {
            return (object) $finalResult;
        }
    }

    public function getDoctorSessionForDiagon($id, $diagonsticId, $slotId = NULL) {

        $where = array('diagnostic_usersId' => $diagonsticId, 'doctorAvailability_doctorAvailabilityId' => $id);

        if ($slotId != NULL)
            $where["doctorAvailabilitySession_id"] = $slotId;

        $this->db->select('doctorAvailabilitySession_id, diagnostic_name as dName, diagnostic_id dId, doctorAvailabilitySession_start as start, doctorAvailabilitySession_end as end, doctorAvailabilitySession_type as session')
                ->from('qyura_doctorAvailabilitySession')
                ->join('qyura_diagnostic', 'qyura_diagnostic.diagnostic_usersId=qyura_doctorAvailabilitySession.doctorAvailability_refferalId', 'left')
                ->where($where);
        // ->where_in('doctorAvailability_doctorAvailabilityId',explode(',',$avia) );

        $response = $this->db->get()->result();
        // echo $this->db->last_query(); die();
        if ($slotId != NULL)
            return count($response);

        $finalResult = array();
        if (!empty($response)) {
            foreach ($response as $row) {
                $finalTemp = array();
                $finalTemp['sessionid'] = isset($row->doctorAvailabilitySession_id) ? $row->doctorAvailabilitySession_id : "";
                $finalTemp['id'] = isset($row->dId) && $row->dId ? $row->dId : '';
                $finalTemp['name'] = isset($row->dName) && $row->dName != '' ? $row->dName : '';
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

    public function getDocTimeSlotForhospital($hospitalId, $doctorUserId, $avia = NULL) {
        $where = $this->db->where(array('qyura_doctorAvailability.doctorAvailability_docUsersId' => $doctorUserId, 'doctorAvailability_deleted' => 0, 'doctorAvailabilitySession_deleted' => 0));
        if ($avia != NULL) {
            $where = $this->db->where_in('doctorAvailability_id', explode(',', $avia));
        }

        $this->db->select('doctorAvailability_id id, doctorAvailability_day day, doctorAvailabilitySession_id')
                ->from('qyura_doctorAvailability')
                ->join('qyura_doctorAvailabilitySession', 'qyura_doctorAvailability.doctorAvailability_id = qyura_doctorAvailabilitySession.doctorAvailability_doctorAvailabilityId AND doctorAvailability_refferalId = ' . $hospitalId . ' ', 'left')
                ->order_by('day', 'ASC');

        //  $row = $this->db->get()->row();
        $response = $this->db->get()->result();
        //  echo $this->db->last_query(); die();
        $finalResult = array();
        if (!empty($response)) {
            foreach ($response as $row) {
                $finalTemp = array();
                $day = convertNumberToDay(date($row->day));
                $finalResult[$day] = $this->getDoctorSessionForHospital($row->id, $hospitalId, '');
            }
            return $finalResult;
        } else {
            return (object) $finalResult;
        }
    }

    public function getDoctorSessionForHospital($id, $hospitalId, $slotId = NULL) {
        // echo $avia; exit;
        $where = array('hospital_usersId' => $hospitalId, 'doctorAvailability_doctorAvailabilityId' => $id, 'doctorAvailabilitySession_deleted' => 0);
        if ($slotId != NULL) {
            $where["doctorAvailabilitySession_id"] = $slotId;
        }

        $this->db->select('doctorAvailabilitySession_id,hospital_name as hName, hospital_id hId, doctorAvailabilitySession_start as start, doctorAvailabilitySession_end as end, doctorAvailabilitySession_type as session')
                ->from('qyura_doctorAvailabilitySession')
                ->join('qyura_hospital', 'qyura_hospital.hospital_usersId = qyura_doctorAvailabilitySession.doctorAvailability_refferalId', 'left')
                ->where($where);
        // ->where_in('doctorAvailability_doctorAvailabilityId',explode(',',$avia) );
        // $row = $this->db->get()->row();
        $response = $this->db->get()->result();
        if ($slotId != NULL) {
            return count($response);
        }
        //  echo $this->db->last_query(); die();
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

    /*   public function getHosTimeSlot($hospitalId) {
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
      } */

    public function getDocAllTimeSlot($doctorUserId, $miId = null) {

        $where = array('doctorAvailability_docUsersId' => $doctorUserId, "doctorAvailabilitySession_deleted" => 0);
        if ($miId != null) {
            $where['doctorAvailability_refferalId'] = $miId;
        }

        $this->db->select('doctorAvailability_refferalId as MiId,  (CASE WHEN(hospital_usersId is not null) THEN "Hospital" WHEN(diagnostic_usersId is not null) THEN "Diagno" WHEN(doctors_userId is not null) THEN "Doctor" END) as type, (CASE WHEN(hospital_name is not null) THEN hospital_name WHEN(diagnostic_name is not null) THEN diagnostic_name WHEN(doctor_addr is not null) THEN doctor_addr END) as name, (CASE WHEN(hospital_id is not null) THEN hospital_id WHEN(doctors_id is not null) THEN doctors_id WHEN(diagnostic_id is not null) THEN diagnostic_id END) as id, (CASE WHEN(hospital_usersId is not null) THEN hospital_usersId WHEN(doctors_userId is not null) THEN doctors_userId WHEN(diagnostic_usersId is not null) THEN diagnostic_usersId END) as userId, group_concat(DISTINCT doctorAvailability_id) as availabilityId')
                ->from('qyura_doctorAvailability')
                ->join('qyura_doctorAvailabilitySession', 'qyura_doctorAvailabilitySession.doctorAvailability_doctorAvailabilityId = qyura_doctorAvailability.doctorAvailability_id', 'left')
                ->join('qyura_hospital', 'qyura_hospital.hospital_usersId = qyura_doctorAvailabilitySession.doctorAvailability_refferalId', 'left')
                ->join('qyura_diagnostic', 'qyura_diagnostic.diagnostic_usersId = qyura_doctorAvailabilitySession.doctorAvailability_refferalId', 'left')
                ->join('qyura_doctors', 'qyura_doctors.doctors_userId = qyura_doctorAvailabilitySession.doctorAvailability_refferalId', 'left')
                ->where($where)
                ->group_by('doctorAvailability_refferalId');
        $response = $this->db->get()->result();
//         echo $this->db->last_query(); die();
        $finalResult = array();
        if (!empty($response)) {
            foreach ($response as $row) {
                if (isset($row->type) && $row->type != '') {
                    $finalTemp = array();
                    $finalTemp['id'] = isset($row->id) ? $row->id : "";
                    $finalTemp['name'] = isset($row->name) ? $row->name : "";
                    $finalTemp['type'] = isset($row->type) ? $row->type : "";
                    // $finalTemp['timeslot'] = isset($row->id) && isset($row->type) && $row->type == 'Hospital' ? $this->getHosTimeSlotForDoc($row->id) : $this->getDiagnoTimeSlotForDoc($row->id);

                    if ($row->type == 'Hospital') {
                        $finalTemp['timeslot'] = $this->getHosTimeSlotForDoc($row->id);
                        $finalTemp['docTimeSlot'] = isset($row->MiId) ? $this->getDocTimeSlotForhospital($row->MiId, $doctorUserId, $row->availabilityId) : "";
//                  print_r($finalTemp['docTimeSlot']);
//                    echo $this->db->last_query(); die();
                    } elseif ($row->type == 'Diagno') {
                        $finalTemp['timeslot'] = $this->getDiagnoTimeSlotForDoc($row->id);
                        $finalTemp['docTimeSlot'] = isset($row->MiId) ? $this->getDocTimeSlotForDiagon($row->MiId, $doctorUserId, $row->availabilityId) : "";
                    } elseif ($row->type == 'Doctor') {
                        $finalTemp['timeslot'] = defalutTimeSlots();
                        $finalTemp['docTimeSlot'] = isset($row->MiId) ? $this->getDocTimeSlotForDoc($row->MiId, $doctorUserId, $row->availabilityId) : "";
                    }


                    // $finalTemp['docTimeSlot'] = isset($row->MiId) ? $this->getDocTimeSlot($row->MiId, $doctorUserId) : "";
                    $finalTemp['userId'] = isset($row->userId) ? $row->userId : "";
                    $finalResult[] = $finalTemp;
                }
            }
            return $finalResult;
        } else {
            return $finalResult;
        }
    }

    public function getHosTimeSlotForDoc($hospitalId) {

        $where = array('hospitalTimeSlot_deleted' => 0, 'hospitalTimeSlot_hospitalId' => $hospitalId);

        $this->db->select('hospitalTimeSlot_id id,hospitalTimeSlot_startTime start,hospitalTimeSlot_endTime end, hospitalTimeSlot_sessionType session')
                ->from('qyura_hospitalTimeSlot')
                ->where($where);

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

    public function getDiagnoTimeSlotForDoc($diagonsticId) {
        $where = array('diagnosticCenterTimeSlot_deleted' => 0, 'diagnosticCenterTimeSlot_diagnosticId' => $diagonsticId);

        $this->db->select('diagnosticCenterTimeSlot_id id, diagnosticCenterTimeSlot_startTime start, diagnosticCenterTimeSlot_endTime end, diagnosticCenterTimeSlot_sessionType session')
                ->from('qyura_diagnosticCenterTimeSlot')
                ->where($where);

        $response = $this->db->get()->result();

        //echo $this->db->last_query(); die();
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

    public function getDocTimeSlot($miId, $doctorUserId, $slotId = NULL) {

        $where = array('doctorAvailability_deleted' => 0, 'doctorAvailability_docUsersId' => $doctorUserId, 'doctorAvailability_refferalId' => $miId, "doctorAvailabilitySession_deleted" => 0);

        if ($slotId != NULL) {
            $where["doctorAvailabilitySession_id"] = $slotId;
        }

        $this->db->select('doctorAvailabilitySession_id as id, doctorAvailabilitySession_start as start, doctorAvailabilitySession_end as end, doctorAvailabilitySession_type as session ')
                ->from('qyura_doctorAvailability')
                ->join('qyura_doctorAvailabilitySession', 'qyura_doctorAvailabilitySession.doctorAvailability_doctorAvailabilityId = qyura_doctorAvailability.doctorAvailability_id')
                ->where($where);

        $response = $this->db->get()->result();
        // echo $this->db->last_query(); die();
        if ($slotId != NULL) {
            return count($response);
        }
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

    public function getDocTimeSlotForDoc($miId, $doctorUserId) {
        // echo $this->getDoctorSession(1); exit;
        $where = array('qyura_doctorAvailability.doctorAvailability_docUsersId' => $doctorUserId, 'doctorAvailability_deleted' => 0, 'doctorAvailability_refferalId' => $miId, "`qyura_doctorAvailabilitySession`.`doctorAvailabilitySession_deleted`" => 0);

        $todayWeek = getDay(date("l"));
        $this->db->select('doctorAvailability_id id, doctorAvailability_day day')
                ->from('qyura_doctorAvailability')
                ->join('qyura_doctorAvailabilitySession', 'qyura_doctorAvailability.doctorAvailability_id=qyura_doctorAvailabilitySession.doctorAvailability_doctorAvailabilityId', 'left')
                ->join('qyura_doctors', 'qyura_doctors.doctors_userId=qyura_doctorAvailabilitySession.doctorAvailability_refferalId', 'left')
                ->where($where)
                ->order_by('day', 'ASC');

        // $row = $this->db->get()->row();
        $response = $this->db->get()->result();

        // echo $this->db->last_query(); die();
        $finalResult = array();
        if (!empty($response)) {
            foreach ($response as $row) {
                $finalTemp = array();
                $day = convertNumberToDay(date($row->day));
                $finalResult[$day] = $this->getDoctorSessionForDoctor($row->id, $miId);
            }
            return $finalResult;
        } else {
            return (object) $finalResult;
        }
    }

    public function getDoctorSessionForDoctor($id, $miId, $slotId = NULL) {

        $where = array('doctorAvailability_doctorAvailabilityId' => $id, 'doctors_userId' => $miId, 'doctorAvailabilitySession_deleted' => 0);

        if ($slotId != NULL)
            $where["doctorAvailabilitySession_id"] = $slotId;

        $this->db->select('doctorAvailabilitySession_id, doctors_fName as dName, doctors_id dId, doctorAvailabilitySession_start as start, doctorAvailabilitySession_end as end, doctorAvailabilitySession_type as session')
                ->from('qyura_doctorAvailabilitySession')
                ->join('qyura_doctors', 'qyura_doctors.doctors_userId=qyura_doctorAvailabilitySession.doctorAvailability_refferalId', 'left')
                ->where($where);

        $response = $this->db->get()->result();
        // echo $this->db->last_query(); die();
        if ($slotId != NULL)
            return count($response);

        $finalResult = array();
        if (!empty($response)) {
            foreach ($response as $row) {
                $finalTemp = array();
                $finalTemp['sessionid'] = isset($row->doctorAvailabilitySession_id) ? $row->doctorAvailabilitySession_id : "";
                $finalTemp['id'] = isset($row->dId) && $row->dId ? $row->dId : '';
                $finalTemp['name'] = isset($row->dName) && $row->dName != '' ? $row->dName : '';
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
