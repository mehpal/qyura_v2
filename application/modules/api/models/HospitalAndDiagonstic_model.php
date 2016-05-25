<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class HospitalAndDiagonstic_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

   public function getHosDiagonList($lat, $long, $notIn, $specialityid, $userId, $search, $cityId=null, $radius=USER_DISTANCE,  $isemergency, $isAmbulance, $isInsurance, $rating, $openNow) {
       
         $notIn = isset($notIn) && !empty($notIn) ? $notIn : ''; 
         $hospitalJoin = '';
         $hospitalLike = ''; 
         
         $dignoJoin = '';
         $diagnoLike = '';
         
        $day = getDay(date("l"));
        $currentTime = strtotime(date("h:i A"));
         
         
         $cityHos=' ';
         $cityDig=' ';
         if ($cityId != NULL) {
             
            $cityHos = ' AND hospital_cityId = '.$cityId.' '; 
            
            $cityDr  = ' AND doctors_cityId= '.$cityId.' '; 

	    $cityDig = ' AND diagnostic_cityId= '.$cityId.' '; 
            
        } 
        
        
        // is amergency filter parameter
        $hosIsEmergency = '';
        $diagnoIsEmergency = '';
        if ($isemergency != '' && $isemergency != NULL && $isemergency == 1) {
            $hosIsEmergency = "AND qyura_hospital.isEmergency = $isemergency";
            $diagnoIsEmergency = "AND diagnostic_isEmergency = $isemergency";
        }
        
        // is amergency filter parameter
        $isAmbulanceFilterHosspital = '';
        $isAmbulanceFilterDiagno = '';
        if ($isAmbulance != '' && $isAmbulance != NULL && $isAmbulance == 1) {
            $isAmbulanceFilterHosspital = " AND isAmbulance >= $isAmbulance";
            $isAmbulanceFilterDiagno = " AND isAmbulance >= $isAmbulance";
        }
        
        // is amergency filter parameter
        
         if ($isInsurance != '' && $isInsurance != NULL && $isInsurance != 0) {
            $isInsurance = isset($isInsurance) ? $isInsurance : '';
        }
        
        $isInsuranceFilterHosspital = '';
        $isInsuranceFilterdiagno = '';
        if ($isInsurance != "" || $isInsurance != NULL) {
            $isInsuranceFilterHosspital = " AND hospitalInsurance_id IN ( $isInsurance )";
            $isInsuranceFilterdiagno = " AND diagnoInsurance_id IN ( $isInsurance )";
        }
        
        
        // rate filter
        $rateHavingHospital = '';
        $rateHavingDiagno = '';
        if ($rating != '' && $rating != NULL ) {
            $rateHavingHospital = " AND `rat` >= '".number_format($rating, 1)."'";
            $rateHavingDiagno = " AND `rat` >=  '".number_format($rating, 1)."'";
        }
        

	$HAVING =  " HAVING `distance` <= ".$radius;
         
         if($search != null){


             $hospitalJoin .= 'LEFT JOIN `qyura_hospitalServices` ON `qyura_hospitalServices`.`hospitalServices_hospitalId` = `qyura_hospital`.`hospital_id`';
             
             $hospitalJoin .= 'LEFT JOIN `qyura_hospitalDiagnosticsCat` ON `qyura_hospitalDiagnosticsCat`.`hospitalDiagnosticsCat_hospitalId` = `qyura_hospital`.`hospital_id`';
             
             $hospitalJoin .= 'LEFT JOIN `qyura_diagnosticsCat` ON `qyura_diagnosticsCat`.`diagnosticsCat_catId` = `qyura_hospitalDiagnosticsCat`.`hospitalDiagnosticsCat_diagnosticsCatId`';
             
               //$hospitalLike .= " AND `qyura_specialities`.`speciality_tag` LIKE '%$search%' ";
             

             $hospitalLike = " AND (`hospital_name` LIKE '%$search%' OR `hospital_address` LIKE '%$search%' OR `hospitalServices_serviceName` LIKE  '%$search%' OR `diagnosticsCat_catName` LIKE '%$search%')  ";
             
             $dignoJoin .= 'LEFT JOIN `qyura_diagnosticServices` ON `qyura_diagnosticServices`.`diagnosticServices_diagnosticId` = `qyura_diagnostic`.`diagnostic_id`';
             
              //$diagnoLike .= " AND `qyura_specialities`.`speciality_tag` LIKE '%$search%' ";
             
             $diagnoLike = " AND (`diagnostic_name` LIKE '%$search%' OR `diagnostic_address` LIKE '%$search%' OR `diagnosticServices_serviceName` LIKE  '%$search%' OR `diagnosticsCat_catName` LIKE '%$search%') ";
             
         }
         
          // is ambulance for hospital
        $isAmbulanceHospital = '';
        $isAmbulanceHospital = ', (SELECT count(ambulance_id) from qyura_ambulance where ambulance_usersId = hospital_usersId AND ambulance_deleted = 0 AND status = 1) as isAmbulance';
        
          // is ambulance for diagnostic
        $isAmbulanceDiagnostic = '';
        $isAmbulanceDiagnostic = ', (SELECT count(ambulance_id) from qyura_ambulance where ambulance_usersId = diagnostic_usersId AND ambulance_deleted = 0 AND status = 1) as isAmbulance';
         
         $sql = "SELECT 'Hospital' AS `type`, `isEmergency` AS `isEmergency`, `hospital_id` as `id`, `hospital_usersId` `userId`, (CASE WHEN(fav_userId is not null ) THEN fav_isFav ELSE 0 END) `fav`, `hospital_address` as `adr`, `hospital_name` `name`, `hospital_phn` `phn`, `hospital_lat` `lat`, `hospital_long` `long`, CONCAT('assets/hospitalsImages/thumb/original','/',hospital_img) as imUrl, (
                6371 * acos( cos( radians( $lat ) ) * cos( radians( hospital_lat ) ) * cos( radians( hospital_long ) - radians( $long ) ) + sin( radians( $lat ) ) * sin( radians( hospital_lat ) ) )
                ) AS distance, Group_concat(DISTINCT (CASE specialityNameFormate WHEN 1 THEN qyura_specialities.specialities_drName WHEN 0 THEN qyura_specialities.specialities_name END) order by qyura_specialities.specialities_name SEPARATOR ', ') as facility, (
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
 AS `rat` $isAmbulanceHospital ,  (SELECT count(healthPackage_id) from qyura_healthPackage where healthPackage_MIuserId = userId AND healthPackage_deleted = 0 AND status = 1) as totalHealtPkg ,  (SELECT count(hospitalInsurance_id) from qyura_hospitalInsurance where hospitalInsurance_hospitalId = hospital_id AND hospitalInsurance_deleted = 0) as totalInsurance, availibility_24_7 as fullTime
FROM `qyura_specialities`
LEFT JOIN `qyura_hospitalSpecialities` ON `qyura_hospitalSpecialities`.`hospitalSpecialities_specialitiesId` = `qyura_specialities`.`specialities_id`
LEFT JOIN `qyura_hospital` ON `qyura_hospital`.`hospital_id` = `qyura_hospitalSpecialities`.`hospitalSpecialities_hospitalId`
LEFT JOIN `qyura_usersRoles` ON `qyura_usersRoles`.`usersRoles_userId` = `qyura_hospital`.`hospital_usersId` AND usersRoles_roleId = 5 AND usersRoles_parentId = qyura_hospital.hospital_usersId
LEFT JOIN `qyura_reviews` ON `qyura_reviews`.`reviews_relateId`=`qyura_hospital`.`hospital_usersId`
LEFT JOIN `qyura_ratings` ON `qyura_ratings`.`rating_relateId`=`qyura_hospital`.`hospital_usersId`

LEFT JOIN `qyura_hospitalInsurance` ON `qyura_hospitalInsurance`.`hospitalInsurance_hospitalId`=`qyura_hospital`.`hospital_id`
LEFT JOIN `qyura_insurance` ON `qyura_insurance`.`insurance_id`=`qyura_hospitalInsurance`.`hospitalInsurance_insuranceId`

LEFT JOIN `qyura_fav` ON `qyura_fav`.`fav_relateId`=`qyura_hospital`.`hospital_usersId` AND `fav_userId` = $userId
$hospitalJoin
WHERE `hospital_deleted` = 0 AND qyura_hospital.status = 1 ".$cityHos.$hosIsEmergency.$isInsuranceFilterHosspital."
AND `specialities_id` = $specialityid
$hospitalLike
AND `hospital_usersId` NOT IN( '" . implode($notIn, "', '") . "' )
GROUP BY `hospital_id`  ".$HAVING.$rateHavingHospital.$isAmbulanceFilterHosspital." 


union all

SELECT 'Diagon' AS `type`, `diagnostic_isEmergency` AS `isEmergency`, `qyura_diagnostic`.`diagnostic_id` as `id`, `diagnostic_usersId` `userId`, (CASE WHEN(fav_userId is not null ) THEN fav_isFav ELSE 0 END) `fav`, `diagnostic_address` `adr`, `diagnostic_name` `name`, `diagnostic_phn` `phn`, `diagnostic_lat` `lat`, `diagnostic_long` `long`, CONCAT('assets/diagnosticsImage/thumb/original','/',diagnostic_img) as imUrl, (
     6371 * acos( cos( radians( $lat ) ) * cos( radians( diagnostic_lat ) ) * cos( radians( diagnostic_long ) - radians( $long ) ) + sin( radians( $lat ) ) * sin( radians( diagnostic_lat ) ) )
     ) AS distance, Group_concat(distinct qyura_diagnosticsCat.diagnosticsCat_catName order by diagnosticsCat_catName) as facility, (
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
 AS `rat` $isAmbulanceDiagnostic , (SELECT count(healthPackage_id) from qyura_healthPackage where healthPackage_MIuserId = diagnostic_usersId AND healthPackage_deleted = 0 AND status = 1) as totalHealtPkg , (SELECT count(diagnoInsurance_id) from qyura_diagnoInsurance where diagnoInsurance_diagnoId = diagnostic_id AND diagnoInsurance_deleted = 0) as totalInsurance, diagnostic_availibility_24_7 as fullTime
FROM `qyura_specialities`
LEFT JOIN `qyura_diagnosticSpecialities` ON `qyura_diagnosticSpecialities`.`diagnosticSpecialities_specialitiesId`=`qyura_specialities`.`specialities_id`
LEFT JOIN `qyura_diagnostic` ON `qyura_diagnostic`.`diagnostic_id`=`qyura_diagnosticSpecialities`.`diagnosticSpecialities_diagnosticId`
LEFT JOIN `qyura_diagnosticsHasCat` ON `qyura_diagnosticsHasCat`.`diagnosticsHasCat_diagnosticId`=`qyura_diagnostic`.`diagnostic_id`
LEFT JOIN `qyura_diagnosticsCat` ON `qyura_diagnosticsCat`.`diagnosticsCat_catId`=`qyura_diagnosticsHasCat`.`diagnosticsHasCat_diagnosticsCatId`
LEFT JOIN `qyura_reviews` ON `qyura_reviews`.`reviews_relateId`=`qyura_diagnostic`.`diagnostic_usersId`
LEFT JOIN `qyura_ratings` ON `qyura_ratings`.`rating_relateId`=`qyura_diagnostic`.`diagnostic_usersId`

LEFT JOIN `qyura_diagnoInsurance` ON `qyura_diagnoInsurance`.`diagnoInsurance_diagnoId`=`qyura_diagnostic`.`diagnostic_id`
LEFT JOIN `qyura_insurance` ON `qyura_insurance`.`insurance_id`=`qyura_diagnoInsurance`.`diagnoInsurance_insuranceId`

LEFT JOIN `qyura_usersRoles` ON `qyura_usersRoles`.`usersRoles_userId`=`qyura_diagnostic`.`diagnostic_usersId`
LEFT JOIN `qyura_fav` ON `qyura_fav`.`fav_relateId`=`qyura_diagnostic`.`diagnostic_usersId` AND `fav_userId` = $userId
$dignoJoin 
    
WHERE `diagnostic_deleted` = 0 AND `qyura_diagnostic`.`status` = 1". $cityDig.$diagnoIsEmergency.$isInsuranceFilterdiagno."
AND `specialities_id` = $specialityid
$diagnoLike
AND `usersRoles_roleId` = ".ROLE_DIAGNOSTICS." 
AND `diagnostic_usersId` NOT IN( '" . implode($notIn, "', '") . "' )
GROUP BY `diagnostic_id` ".$HAVING.$rateHavingDiagno.$isAmbulanceFilterDiagno." 

ORDER BY `distance` ASC

 LIMIT ".DATA_LIMIT."  ";  
       
            $queryResult = $this->db->query($sql);
         
            
            $response = $queryResult->result();
          // echo $this->db->last_query(); die();
           // $aoClumns = array("id","fav","rat","adr", "name","phn","lat","lng","upTm","imUrl","facility");
            //  print_r($response); die();
            $finalResult = array();
            if (!empty($response)) {                
                foreach ($response as $row) {
                    $finalTemp = array();
                    $finalTemp[] = isset($row->isAmbulance) ? $row->isAmbulance : "";
                    $finalTemp[] = isset($row->totalHealtPkg) ? $row->totalHealtPkg : "";
                    $finalTemp[] = isset($row->totalInsurance) ? $row->totalInsurance : "";
                    $finalTemp[] = isset($row->isEmergency) ? $row->isEmergency : "";
                    
                    $finalTemp[] = isset($row->id) ? $row->id : "";
                    $finalTemp[] = isset($row->userId) ? $row->userId : "";
                    $finalTemp[] = isset($row->type) ? $row->type : "";
                    $finalTemp[] = isset($row->fav) ? $row->fav : "";
                    $finalTemp[] = isset($row->rat) ? $row->rat : "";
                    $finalTemp[] = isset($row->adr) ? $row->adr : "";
                    $finalTemp[] = isset($row->name) ? $row->name : "";
                    $finalTemp[] = isset($row->phn) ? $row->phn : "";
                    $finalTemp[] = isset($row->lat) ? $row->lat : "";
                    $finalTemp[] = isset($row->long) ? $row->long : "";
                    $finalTemp[] = isset($row->imUrl) ? $row->imUrl : "";
                    $finalTemp[] = isset($row->facility) ? $row->facility : "";
                   // $finalResult[] = $finalTemp;
                    if ($openNow != NULL && $openNow != 0) {
                        if ($row->fullTime == 1) {
                                $finalResult[] = $finalTemp;
                            } else {
                            $time = $this->miTimeSlot($row->userId);
                            if (!empty($time)) {
                                if (($time->openingHours <= $currentTime && $time->closingHours >= $currentTime)) {
                                $finalResult[] = $finalTemp;
                                }
                            }
                            }
                        }else {
                    $finalResult[] = $finalTemp;
                }
                    
                }
              return $finalResult;
        } else {
            return $finalResult;
        }
        
        
     }
     
     
         // mi time slot
    public function miTimeSlot($miUserId) {
        $this->db->select('(CASE WHEN (openingHours is NULL) THEN 0 ELSE openingHours END) AS openingHours , (CASE WHEN (closingHours is NULL) THEN 0 ELSE closingHours END) AS closingHours');
        $this->db->from('qyura_miTimeSlot');
        $this->db->where(array('deleted' => 0, 'status' => 1, 'mi_user_id' => $miUserId, 'hourLabel' => date("l")));
        return $this->db->get()->row();
    }
}
?>
