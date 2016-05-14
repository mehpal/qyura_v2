<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class Appointment_model extends Common_model {

    public function __construct() {
        parent::__construct();
    }

    public function QuotationList($now, $userId) {
        
        $sql1 = "SELECT quotation_id as id, CASE WHEN ( `qyura_hospital`.`hospital_usersId` <> NULL ) THEN `qyura_hospital`.`hospital_name` WHEN (`qyura_diagnostic`.`diagnostic_usersId` <> NULL ) THEN `qyura_diagnostic`.`diagnostic_name` ELSE  '' END AS title,"
                    . "`qyura_quotationBooking`.`quotationBooking_orderId` AS `orderId`,"
                    . "DATE_FORMAT(FROM_UNIXTIME(`qyura_quotations`.`quotation_dateTime`),'%d %b, %Y') as date,"
                    . "0 AS `startTime`,"
                    . "0 AS `endTime`,"
                    . "CASE WHEN (`qyura_hospital`.`hospital_usersId` <> 0 ) THEN qyura_hospital.hospital_address ELSE qyura_diagnostic.diagnostic_address END AS `address`,"
                
                    . "(CASE WHEN(quotation_dateTime > CURRENT_TIMESTAMP AND (quotationBooking_bookStatus = 11 || quotationBooking_bookStatus = 14  ))  THEN 'Upcoming' ELSE 'Completed' END  ) as `upcomingStatus`,"
                
                    . "CASE qyura_quotationBooking.quotationBooking_bookStatus WHEN '12' THEN 'Confirmed' WHEN '13' THEN 'Cancelled' WHEN '11' THEN 'Pending' WHEN '14' THEN 'Completed' WHEN '19' THEN 'Expired' ELSE '' END AS `bookingStatus`,"
                
                    . "'Diagnostic' as `type`, '2' as `typeId`"
                
                    . "FROM `qyura_quotationBooking` LEFT JOIN `transactionInfo` ON `transactionInfo`.`order_no` = `qyura_quotationBooking`.`quotationBooking_orderId`
                        
LEFT JOIN `qyura_quotations` ON `qyura_quotations`.`quotation_id`=`qyura_quotationBooking`.`quotationBooking_quotationId`
LEFT JOIN `qyura_users` ON `qyura_users`.`users_id`=`qyura_quotations`.`quotation_userId`
LEFT JOIN `qyura_patientDetails` ON `qyura_patientDetails`.`patientDetails_usersId`=`qyura_quotationBooking`.`quotationBooking_userId`
LEFT JOIN `qyura_usersFamily` ON `qyura_usersFamily`.`usersfamily_id`=`qyura_quotations`.`quotation_familyId`
LEFT JOIN `qyura_hospital` ON `qyura_hospital`.`hospital_usersId`=`qyura_quotations`.`quotation_MiId`
LEFT JOIN `qyura_diagnostic` ON `qyura_diagnostic`.`diagnostic_usersId`=`qyura_quotations`.`quotation_MiId`
LEFT JOIN `qyura_diagnosticsCat` ON `qyura_diagnosticsCat`.`diagnosticsCat_catId`=`qyura_quotations`.`quotation_diagnosticsCatId`
WHERE `qyura_quotationBooking`.`quotationBooking_userId` = '{$userId}'
AND `qyura_quotationBooking`.`quotationBooking_deleted` = 0
AND `qyura_quotations`.`quotation_dateTime` <> 0"; 
        return $sql1; 
    }
    
    public function PackageAppointmentList($now, $userId) {
        
        $sql2 = 'SELECT healthPkgBooking_id as id, `healthPackage_packageTitle` as `title`,'
                    . '`healthPkgBooking_orderNo` as `orderId`,'
                    . 'DATE_FORMAT(FROM_UNIXTIME(`healthPkgBooking_finalBookingDate`),"%d %b,%Y") as date,'
                    . '"" as startTime, "" as endTime,'
                    . '(CASE WHEN(diagnostic_usersId is not null) THEN diagnostic_name WHEN(hospital_usersId is not null) THEN hospital_name END) as `address`,'
                    . '(CASE WHEN(healthPkgBooking_finalBookingDate > UNIX_TIMESTAMP()) THEN "Upcoming" ELSE "Completed" END) as upcomingStatus,'
                    ."(CASE healthPkgBooking_bkStatus WHEN '12' THEN 'Confirmed' WHEN '13' THEN 'Cancelled' WHEN '11' THEN 'Pending' WHEN '14' THEN 'Completed' WHEN '19' THEN 'Expired' ELSE '' END) as `bookingStatus`,"
                    .' "Health Package" as `type`, "2" as typeId '
                    . 'FROM `qyura_healthPkgBooking` LEFT JOIN `qyura_healthPackage` ON `qyura_healthPackage`.`healthPackage_id` = `qyura_healthPkgBooking`.`healthPkgBooking_healthPackageId`
LEFT JOIN `transactionInfo` ON `transactionInfo`.`order_no` = `qyura_healthPkgBooking`.`healthPkgBooking_orderNo`
LEFT JOIN `qyura_hospital` ON `qyura_hospital`.`hospital_usersId` = `qyura_healthPkgBooking`.`healthPkgBooking_miId`
LEFT JOIN `qyura_diagnostic` ON `qyura_diagnostic`.`diagnostic_usersId` = `qyura_healthPkgBooking`.`healthPkgBooking_miId`
LEFT JOIN `qyura_users` ON `qyura_users`.`users_id` = `qyura_healthPkgBooking`.`healthPkgBooking_userId`
LEFT JOIN `qyura_patientDetails` ON `qyura_patientDetails`.`patientDetails_usersId` = `qyura_users`.`users_id`
LEFT JOIN `qyura_usersFamily` ON `qyura_usersFamily`.`usersfamily_id` = `qyura_healthPkgBooking`.`healthPkgBooking_memberId`
WHERE `healthPkgBooking_userId` = "' . $userId . '"
AND `healthPkgBooking_deleted` = 0';
      
        return $sql2;
    }
 
    public function DoctorAppointmentList($now, $userId) {
        
        $sql3 = "SELECT doctorAppointment_id as id, CASE WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 1 ) THEN `qyura_hospital`.`hospital_name` WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 2 ) THEN `qyura_diagnostic`.`diagnostic_name` ELSE concat(`doctors_fName`,' ',`doctors_lName`) END AS title,"
                
                    . "`qyura_doctorAppointment`.`doctorAppointment_unqId` AS `orderId`,"
                    . "DATE_FORMAT(FROM_UNIXTIME(`qyura_doctorAppointment`.`doctorAppointment_date`),'%d %b, %Y') as date,"
                    . "DATE_FORMAT(`docTimeDay_open`,'%h:%i%p') as startTime,"
                    . "DATE_FORMAT(`docTimeDay_close`,'%h:%i%p') as endTime,"
                        
                    . " CASE WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 3 ) THEN (CASE WHEN (docTimeTable_stayAt = 0) THEN psChamber_name ELSE  CASE WHEN (docTimeTable_MItype = 1) THEN hospital_name WHEN (docTimeTable_MItype = 2) THEN diagnostic_name ELSE '' END END ) ELSE concat(`doctors_fName`,' ',`doctors_lName`) END AS address,"
                
                    . " CASE WHEN (concat(DATE_FORMAT(FROM_UNIXTIME(`qyura_doctorAppointment`.`doctorAppointment_date`),'%Y-%m-%d'),' ',DATE_FORMAT(docTimeDay_open, '%h:%i %p')) > DATE_FORMAT(CURRENT_TIMESTAMP, '%Y-%m-%d %h:%i %p') AND (qyura_doctorAppointment.doctorAppointment_status = 11 || qyura_doctorAppointment.doctorAppointment_status = 14  )) THEN 'Upcoming' ELSE 'Completed' END as `upcomingStatus`,"
                
                    . " CASE qyura_doctorAppointment.doctorAppointment_status WHEN '12' THEN 'Confirmed' WHEN '13' THEN 'Cancelled' WHEN '11' THEN 'Pending' WHEN '14' THEN 'Completed' WHEN '19' THEN 'Expired' ELSE '' END  AS `bookingStatus`,"
                
                    . "'Consultation' as `type`, '3' as typeId "
                    . "FROM `qyura_doctorAppointment`
                    
                    LEFT JOIN `transactionInfo` ON `transactionInfo`.`order_no` = `qyura_doctorAppointment`.`doctorAppointment_unqId`
                    LEFT JOIN `qyura_docTimeDay` ON `qyura_docTimeDay`.`docTimeDay_id` = `qyura_doctorAppointment`.`doctorAppointment_slotId`
                    
                    LEFT JOIN `qyura_docTimeTable` ON `qyura_docTimeTable`.`docTimeTable_id` = `qyura_docTimeDay`.`docTimeDay_docTimeTableId`
                    LEFT JOIN `qyura_hospital` ON `qyura_hospital`.`hospital_id`=qyura_docTimeTable.docTimeTable_MIprofileId AND docTimeTable_MItype = 1 AND hospital_deleted = 0 
                    
                    LEFT JOIN `qyura_diagnostic` ON qyura_diagnostic.diagnostic_id = qyura_docTimeTable.docTimeTable_MIprofileId AND docTimeTable_MItype = 2 AND diagnostic_deleted = 0 
                    
                    LEFT JOIN qyura_psChamber ON qyura_psChamber.psChamber_id = qyura_docTimeTable.docTimeTable_MIprofileId AND docTimeTable_stayAt = 0 AND qyura_psChamber.status = 1 
                    
                    LEFT JOIN `qyura_doctors` ON `qyura_doctors`.`doctors_Id` = qyura_docTimeTable.`docTimeTable_doctorId`
                    
                    LEFT JOIN `qyura_specialities` ON `qyura_specialities`.`specialities_id`=`qyura_doctorAppointment`.`doctorAppointment_specialitiesId`
                    
                    LEFT JOIN `qyura_usersFamily` ON `qyura_usersFamily`.`usersfamily_id`=`qyura_doctorAppointment`.`doctorAppointment_memberId`

                    LEFT JOIN `qyura_patientDetails` ON `qyura_patientDetails`.`patientDetails_usersId` = `qyura_doctorAppointment`.`doctorAppointment_pntUserId` 
                    
                    WHERE `qyura_doctorAppointment`.`doctorAppointment_pntUserId` = '{$userId}'
                    AND `qyura_doctorAppointment`.`doctorAppointment_deleted` = 0
                    AND `qyura_doctorAppointment`.`doctorAppointment_date` <> 0";
                    
                    return $sql3;
                    
    }
    
    public function QuotationDetail($now, $userId,$orderId) {
        
      $sql1 = "SELECT `qyura_quotationBooking`.`quotationBooking_orderId` AS `orderId`,"
                . "`qyura_diagnosticsCat`.`diagnosticsCat_catName` as `speciality`,"
                . "`qyura_doctors`.`doctors_fName`,"
                . "DATE_FORMAT(FROM_UNIXTIME(`qyura_quotations`.`quotation_dateTime`),'%d %b, %Y') as date,"
                . "CASE WHEN (`qyura_hospital`.`hospital_usersId` <> 0 ) THEN DATE_FORMAT(FROM_UNIXTIME(`qyura_hospitalTimeSlot`.`hospitalTimeSlot_startTime`),'%h:%i%p') ELSE DATE_FORMAT(FROM_UNIXTIME(`qyura_diagnosticCenterTimeSlot`.`diagnosticCenterTimeSlot_startTime`),'%h:%i%p') END AS `startTime`,"
                . "CASE WHEN (`qyura_hospital`.`hospital_usersId` <> 0 ) THEN DATE_FORMAT(FROM_UNIXTIME(`qyura_hospitalTimeSlot`.`hospitalTimeSlot_endTime`),'%h:%i%p') ELSE DATE_FORMAT(FROM_UNIXTIME(`qyura_diagnosticCenterTimeSlot`.`diagnosticCenterTimeSlot_endTime`),'%h:%i%p') END AS `endTime`,"
                ."CASE WHEN (qyura_quotations.quotation_familyId <> 0 ) THEN qyura_usersFamily.usersfamily_name ELSE qyura_patientDetails.patientDetails_patientName END AS `userName`,"
                . "CASE WHEN (`qyura_quotations`.`quotation_familyId` <> 0 ) THEN qyura_usersFamily.usersfamily_gender ELSE qyura_patientDetails.patientDetails_gender END AS `userGender`,"
                . "CASE WHEN (`qyura_quotations`.`quotation_familyId` <> 0 ) THEN qyura_usersFamily.usersfamily_age ELSE (FROM_UNIXTIME('{$now}', '%Y') - FROM_UNIXTIME(qyura_patientDetails.patientDetails_dob, '%Y')) END AS `userAge`,"
                ."'Paid' as `payment_status`, `transactionInfo`.`payment_method` AS `paymentMethod`,"
                ." `qyura_users`.`users_mobile` AS `usersMobile`,"
                ."CASE WHEN (`qyura_hospital`.`hospital_usersId` <> 0 ) THEN qyura_hospital.hospital_address ELSE qyura_diagnostic.diagnostic_address END AS `address`,"
                ."CASE WHEN (`qyura_hospital`.`hospital_usersId` <> 0 ) THEN qyura_hospital.hospital_name ELSE qyura_diagnostic.diagnostic_name END AS `miName`,"
                ."'' AS `remark`,"
                ." 'Cash'  AS paymentMood, "
                ." 'Paid'  AS paymentStatus, "
                ."CASE WHEN (qyura_quotationBooking.quotationBooking_bookStatus = 4) THEN (CASE WHEN (`reviews_details` <> '') THEN `reviews_details` ELSE 'Not Given' END ) ELSE '' END  AS `reviews`,"
               ."CASE WHEN (qyura_quotationBooking.quotationBooking_bookStatus = 4) THEN (CASE WHEN (`reviews_rating` <> 0) THEN `reviews_rating` ELSE '0' END ) ELSE '0' END  AS `rating` "  
                
                . "FROM `qyura_quotationBooking`
                LEFT JOIN `transactionInfo` ON `transactionInfo`.`order_no` = `qyura_quotationBooking`.`quotationBooking_orderId`
                LEFT JOIN `qyura_quotations` ON `qyura_quotations`.`quotation_id`=`qyura_quotationBooking`.`quotationBooking_quotationId`
                LEFT JOIN `qyura_users` ON `qyura_users`.`users_id`=`qyura_quotations`.`quotation_userId`
                LEFT JOIN `qyura_patientDetails` ON `qyura_patientDetails`.`patientDetails_usersId`=`qyura_quotationBooking`.`quotationBooking_userId`
                LEFT JOIN `qyura_doctors` ON `qyura_doctors`.`doctors_userId` = `qyura_quotations`.`quotation_assignDoctorId`
                LEFT JOIN `qyura_usersFamily` ON `qyura_usersFamily`.`usersfamily_id`=`qyura_quotations`.`quotation_familyId`
                LEFT JOIN `qyura_hospital` ON `qyura_hospital`.`hospital_usersId`=`qyura_quotations`.`quotation_MiId`
                LEFT JOIN `qyura_diagnostic` ON `qyura_diagnostic`.`diagnostic_usersId`=`qyura_quotations`.`quotation_MiId`
                
                LEFT JOIN `qyura_diagnosticCenterTimeSlot` ON `qyura_diagnosticCenterTimeSlot`.`diagnosticCenterTimeSlot_id`=`qyura_quotations`.`quotation_timeSlotId`
                LEFT JOIN `qyura_hospitalTimeSlot` ON `qyura_hospitalTimeSlot`.`hospitalTimeSlot_id`=`qyura_quotations`.`quotation_diagnosticsCatId`
LEFT JOIN `qyura_diagnosticsCat` ON `qyura_diagnosticsCat`.`diagnosticsCat_catId`=`qyura_quotations`.`quotation_diagnosticsCatId`
                LEFT JOIN `qyura_reviews` ON `qyura_reviews`.`reviews_aptmntId`=`qyura_quotationBooking`.`quotationBooking_orderId`
                WHERE `qyura_quotationBooking`.`quotationBooking_userId` = '{$userId}'
                AND `qyura_quotations`.`quotation_unqId` = '{$orderId}'    
                AND `qyura_quotationBooking`.`quotationBooking_deleted` = 0";
        return $sql1; 
    }
    
    public function PackageAppointmentDetail($now, $userId,$orderId) {
        
        $sql2 = "SELECT `healthPackage_packageTitle` as `doctors_fName`, "
                        . "`healthPkgBooking_orderNo` as `orderId`,"
                        . "'' as speciality, "
                        . "DATE_FORMAT(FROM_UNIXTIME(`healthPkgBooking_finalBookingDate`),'%d %b, %Y') as date,"
                        . "'' AS `startTime`,'' AS `endTime`,"
                        ."CASE WHEN (healthPkgBooking_memberId <> 0 ) THEN qyura_usersFamily.usersfamily_name ELSE qyura_patientDetails.patientDetails_patientName END AS `userName`,"
                        . "CASE WHEN (healthPkgBooking_memberId <> 0 ) THEN qyura_usersFamily.usersfamily_gender ELSE qyura_patientDetails.patientDetails_gender END AS `userGender`,"
                        . "CASE WHEN (healthPkgBooking_memberId <> 0 ) THEN qyura_usersFamily.usersfamily_age ELSE (FROM_UNIXTIME('{$now}', '%Y') - FROM_UNIXTIME(qyura_patientDetails.patientDetails_dob, '%Y')) END AS `userAge`,"
                        ."'Paid' as `payment_status`, `transactionInfo`.`payment_method` AS `paymentMethod`,"
                        ." `qyura_users`.`users_mobile` AS `usersMobile`,"
                        ."(CASE WHEN(diagnostic_usersId is not null) THEN diagnostic_address WHEN(hospital_usersId is not null) THEN `hospital_address` END) as `address`,"
                        ."(CASE WHEN(diagnostic_usersId is not null) THEN diagnostic_name WHEN(hospital_usersId is not null) THEN hospital_name END) as `miName`,"
                        ."healthPkgBooking_message AS `remark`,"
                        ."CASE WHEN (healthPkgBooking_bkStatus = 4) THEN (CASE WHEN (`reviews_details` <> '') THEN `reviews_details` ELSE 'Not Given' END ) ELSE '' END  AS `reviews`,"
                        ."CASE WHEN (healthPkgBooking_bkStatus = 4) THEN (CASE WHEN (`reviews_rating` <> 0) THEN `reviews_rating` ELSE '0' END ) ELSE '0' END  AS `rating`, "    
                ." 'Cash'  AS paymentMood, "
                ." 'Paid'  AS paymentStatus "
                        . "FROM `qyura_healthPkgBooking`
LEFT JOIN `qyura_healthPackage` ON `qyura_healthPackage`.`healthPackage_id` = `qyura_healthPkgBooking`.`healthPkgBooking_healthPackageId`
LEFT JOIN `transactionInfo` ON `transactionInfo`.`order_no` = `qyura_healthPkgBooking`.`healthPkgBooking_orderNo`
LEFT JOIN `qyura_hospital` ON `qyura_hospital`.`hospital_usersId` = `qyura_healthPkgBooking`.`healthPkgBooking_miId`
LEFT JOIN `qyura_diagnostic` ON `qyura_diagnostic`.`diagnostic_usersId` = `qyura_healthPkgBooking`.`healthPkgBooking_miId`
LEFT JOIN `qyura_users` ON `qyura_users`.`users_id` = `qyura_healthPkgBooking`.`healthPkgBooking_userId`
LEFT JOIN `qyura_patientDetails` ON `qyura_patientDetails`.`patientDetails_usersId` = `qyura_users`.`users_id`
LEFT JOIN `qyura_usersFamily` ON `qyura_usersFamily`.`usersfamily_id` = `qyura_healthPkgBooking`.`healthPkgBooking_memberId`
LEFT JOIN `qyura_reviews` ON `qyura_reviews`.`reviews_aptmntId`=`qyura_healthPkgBooking`.`healthPkgBooking_orderNo`
WHERE `healthPkgBooking_userId` = '" . $userId . "'
AND `healthPkgBooking_orderNo` = '".$orderId."'
AND `healthPkgBooking_deleted` =0";
        return $sql2;
    }
    
    public function DoctorAppointmentDetail($now, $userId, $orderId) {
        
            $sql3 = "SELECT CASE WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 1 ) THEN `qyura_hospital`.`hospital_name` WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 2 ) THEN `qyura_diagnostic`.`diagnostic_name` ELSE concat(`doctors_fName`,' ',`doctors_lName`) END AS title,"
                    . "`qyura_doctorAppointment`.`doctorAppointment_unqId` AS `orderId`,"
                    . "`qyura_specialities`.`specialities_name` AS `speciality`,"
                    . "DATE_FORMAT(FROM_UNIXTIME(`qyura_doctorAppointment`.`doctorAppointment_date`),'%d %b, %Y') as date,"
                    . "DATE_FORMAT(`doctorAvailabilitySession_start`,'%h:%i%p') as startTime,"
                    . "DATE_FORMAT(`doctorAvailabilitySession_end`,'%h:%i%p') as endTime,"
                    . " CASE WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 1 ) THEN `qyura_hospital`.`hospital_address` WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 2 ) THEN `qyura_diagnostic`.`diagnostic_address` ELSE `qyura_doctors`.`doctor_addr` END AS `address`,"
                    ." CASE WHEN (docTimeTable_stayAt = 0) THEN psChamber_name ELSE  CASE WHEN (docTimeTable_MItype = 1) THEN hospital_name WHEN (docTimeTable_MItype = 2) THEN diagnostic_name ELSE '' END END AS name," 
                    . "CASE WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 1 ) THEN `qyura_hospital`.`hospital_name` WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 2 ) THEN `qyura_diagnostic`.`diagnostic_name` ELSE CONCAT(`qyura_doctors`.`doctors_fName`,' ',`qyura_doctors`.`doctors_lName`) END AS `miName`,"
                    ."qyura_doctorAppointment.doctorAppointment_ptRmk AS `remark`,"
                    . "CASE WHEN (qyura_doctorAppointment.doctorAppointment_memberId <> 0 ) THEN qyura_usersFamily.usersfamily_name ELSE qyura_patientDetails.patientDetails_patientName END AS `userName`, "
                    . "CASE WHEN (qyura_doctorAppointment.doctorAppointment_memberId <> 0 ) THEN qyura_usersFamily.usersfamily_gender ELSE qyura_patientDetails.patientDetails_gender END AS `userGender`,"
                    . "`qyura_users`.`users_mobile` AS `usersMobile`, "
                    . "CASE WHEN (`qyura_doctorAppointment`.`doctorAppointment_memberId` <> 0 ) THEN qyura_usersFamily.usersfamily_age ELSE (FROM_UNIXTIME('{$now}', '%Y') - FROM_UNIXTIME(qyura_patientDetails.patientDetails_dob, '%Y')) END AS `userAge`,"
                    ."CASE qyura_doctorAppointment.doctorAppointment_status WHEN '1' THEN 'Confirmed' WHEN '2' THEN 'Cancelled' WHEN '3' THEN 'Pending' WHEN '4' THEN 'Completed' ELSE '' END  AS `bookingStatus`,"
                    ."CASE WHEN (doctorAppointment_status = 4) THEN (CASE WHEN (`reviews_details` <> '') THEN `reviews_details` ELSE 'Not Given' END ) ELSE '' END  AS `reviews`,"
                        ."CASE WHEN (doctorAppointment_status = 4) THEN (CASE WHEN (`reviews_rating` <> 0) THEN `reviews_rating` ELSE '0' END ) ELSE '0' END  AS `rating`, "
                ." CASE WHEN (doctorAppointment_payStatus = 17 ) 'Cash' THEN 'Credit Card' ELSE '' END AS payStatus, "
                . "CASE WHEN (doctorAppointment_payMode = 16 ) 'Paid' THEN 'Unpaid' ELSE '' END AS paymentMood, "
                . "FROM `qyura_doctorAppointment`
            
                LEFT JOIN `transactionInfo` ON `transactionInfo`.`order_no` = `qyura_doctorAppointment`.`doctorAppointment_unqId`
                LEFT JOIN `qyura_users` ON `qyura_users`.`users_id`=`qyura_doctorAppointment`.`doctorAppointment_doctorUserId`
                LEFT JOIN `qyura_hospital` ON `qyura_hospital`.`hospital_usersId`=`qyura_doctorAppointment`.`doctorAppointment_doctorParentId`
                LEFT JOIN `qyura_diagnostic` ON `qyura_diagnostic`.`diagnostic_usersId`=`qyura_doctorAppointment`.`doctorAppointment_doctorParentId` 
                LEFT JOIN `qyura_doctors` ON `qyura_doctors`.`doctors_userId` = `qyura_doctorAppointment`.`doctorAppointment_doctorUserId`
                LEFT JOIN `qyura_specialities` ON `qyura_specialities`.`specialities_id`=`qyura_doctorAppointment`.`doctorAppointment_specialitiesId`

                LEFT JOIN `qyura_usersFamily` ON `qyura_usersFamily`.`usersfamily_id`=`qyura_doctorAppointment`.`doctorAppointment_memberId`
                LEFT JOIN `qyura_patientDetails` ON `qyura_patientDetails`.`patientDetails_usersId` = `qyura_doctorAppointment`.`doctorAppointment_pntUserId`
                LEFT JOIN `qyura_reviews` ON `qyura_reviews`.`reviews_aptmntId`=`qyura_doctorAppointment`.`doctorAppointment_unqId`
                LEFT JOIN `qyura_docTimeDay` ON `qyura_docTimeDay`.`reviews_aptmntId`=`qyura_doctorAppointment`.`doctorAppointment_unqId`
                

                WHERE `qyura_doctorAppointment`.`doctorAppointment_pntUserId` = '{$userId}'
                AND `doctorAppointment_unqId` = '".$orderId."'
                AND `qyura_doctorAppointment`.`doctorAppointment_deleted` = 0
                AND `qyura_doctorAppointment`.`doctorAppointment_date` <> 0";
                
                return $sql3;
    }
    
   
}

?>
