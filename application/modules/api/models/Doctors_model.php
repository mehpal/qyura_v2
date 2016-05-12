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

    public function getDoctorTimeSlot($doctorId, $lat=NULL, $long=NULL) {
        
        $available = array();
        $finalResult = array();
        
        $select = 'docTimeTable_id, docTimeTable_MItype as type, docTimeTable_MIprofileId as userId, docTimeDay_day, docTimeDay_id, docTimeTable_doctorId doctorId, docTimeTable_price as fee, CASE WHEN (docTimeTable_stayAt = 0) THEN psChamber_name ELSE  CASE WHEN (docTimeTable_MItype = 1) THEN hospital_name WHEN (docTimeTable_MItype = 2) THEN diagnostic_name ELSE "" END END AS name,'
                . '  CASE WHEN (docTimeTable_stayAt = 0) THEN psChamber_lat ELSE (CASE WHEN (docTimeTable_MItype = 1) THEN hospital_lat WHEN (docTimeTable_MItype = 2) THEN diagnostic_lat ELSE "" END) END AS lat,'
                . ' CASE WHEN (docTimeTable_stayAt = 0) THEN psChamber_long ELSE (CASE WHEN (docTimeTable_MItype = 1) THEN hospital_long WHEN (docTimeTable_MItype = 2) THEN diagnostic_long ELSE "" END) END  AS lng  ';
        
        if($lat != NULL){
            
            $select .= ', (6371 * acos( cos( radians( ' . $lat . ' ) ) * cos( radians( CASE WHEN (docTimeTable_stayAt = 0) THEN psChamber_lat ELSE (CASE WHEN (docTimeTable_MItype = 1) THEN hospital_lat WHEN (docTimeTable_MItype = 2) THEN diagnostic_lat ELSE "" END) END ) ) * cos( radians( CASE WHEN (docTimeTable_stayAt = 0) THEN psChamber_long ELSE (CASE WHEN (docTimeTable_MItype = 1) THEN hospital_long WHEN (docTimeTable_MItype = 2) THEN diagnostic_long ELSE "" END) END ) - radians( ' . $long . ' ) ) + sin( radians( ' . $lat . ' ) ) * sin( radians( CASE WHEN (docTimeTable_stayAt = 0) THEN psChamber_lat ELSE (CASE WHEN (docTimeTable_MItype = 1) THEN hospital_lat WHEN (docTimeTable_MItype = 2) THEN diagnostic_lat ELSE "" END) END ) ) )
                ) AS distance';
        }
        
        for($i=0; $i < 7; $i++) {
            
            $this->db->select($select)
            ->from('qyura_docTimeDay') 
            ->join("qyura_docTimeTable", "qyura_docTimeTable.docTimeTable_id=qyura_docTimeDay.docTimeDay_docTimeTableId","inner")
            ->join("qyura_hospital", "qyura_hospital.hospital_id = qyura_docTimeTable.docTimeTable_MIprofileId AND docTimeTable_MItype = 1 AND hospital_deleted = 0 ", "left")
            ->join("qyura_diagnostic", "qyura_diagnostic.diagnostic_id = qyura_docTimeTable.docTimeTable_MIprofileId AND docTimeTable_MItype = 2 AND diagnostic_deleted = 0 ", "left")
            ->join("qyura_psChamber", "qyura_psChamber.psChamber_id = qyura_docTimeTable.docTimeTable_MIprofileId AND docTimeTable_stayAt = 0 AND diagnostic_deleted = 0 ", "left")
            ->where(array("docTimeDay_day"=>$i,"docTimeTable_doctorId"=>$doctorId))
            ->group_by("docTimeDay_id");
            $response = $this->db->get()->result(); 
//            echo $this->db->last_query();die();
            if (!empty($response)) {
                $pre = '';
                $finalResult = array();
                foreach ($response as $row) {
                    $tag = $row->type."#".$row->userId;

                    if($pre != $tag){
                        $finalTemp = array();
                        
                        $finalTemp['name'] = (isset($row->name) && $row->name != NULL) ? $row->name : ""; 
                        $finalTemp['fee'] = (isset($row->fee) && $row->fee != NULL) ? $row->fee : "0"; 
                        
                        if($lat != NULL){
                            $finalTemp['docTimeTable_id'] = $row->docTimeTable_id;
                            $finalTemp['lat'] = (isset($row->lat) && $row->lat != NULL) ? $row->lat : "";
                            $finalTemp['lng'] = (isset($row->lng) && $row->lng != NULL) ? $row->lng : "";
                            $finalTemp['fee'] = (isset($row->fee) && $row->fee != NULL)? $row->fee :"0";
                            $finalTemp['distance'] = (isset($row->distance) && $row->distance != NULL) ? $row->distance: "0";
                        }
                        $finalTemp['slot'] = $this->getDoctorSession($row->docTimeTable_id,$i);
                        $finalResult[] = $finalTemp;
                    }
                    $pre = $tag;
                }
                $available[convertNumberToDay($i)] = $finalResult;
            }
        }
        return $available;
    }

    public function getDoctorSession($id,$day) {

        $this->db->select('docTimeDay_id, DATE_FORMAT(docTimeDay_open, "%h:%i %p") as open,  DATE_FORMAT(docTimeDay_close, "%h:%i %p") as close, docTimeTable_price as fee')
            ->from('qyura_docTimeDay')
            ->join('qyura_docTimeTable', 'qyura_docTimeTable.docTimeTable_id=qyura_docTimeDay.docTimeDay_docTimeTableId', 'left')
            ->where(array('docTimeDay_docTimeTableId' => $id, "docTimeDay_deleted" => 0,"docTimeDay_day"=>$day))
            ->order_by("docTimeDay_open","DESC");

        $response = $this->db->get()->result(); 
        return $response;
    }

    public function getDoctorNumReviews($docUserId) {
        $sql = "SELECT COUNT('reviews_id') as reviews
                FROM `qyura_reviews`
                WHERE `reviews_deleted` = '0' and `reviews_relateId` = $docUserId ";
        $query = $this->db->query($sql)->row();
        return $query->reviews;
    }

    public function getDoctorReviews($docUserId) {
        
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

    public function getFavList($docUserId) {
        $this->db->select('doctorImages_id, CONCAT("assets/doctorsImages","/",doctorImages_ImagesName) as docImage');
        $this->db->from('qyura_doctorImages');
        $this->db->where(array('doctorImages_doctorId' => $id, 'doctorImages_deleted' => 0));
        return $this->db->get()->result();
    }

}

?>
