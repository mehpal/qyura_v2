<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2016-05-14 12:29:22 --> Query error: Table 'vsure_qyura.qyura_hospitalTimeSlot' doesn't exist - Invalid query: SELECT *
FROM `qyura_hospitalTimeSlot`
WHERE `qyura_hospitalTimeSlot`.`hospitalTimeSlot_deleted` =0
AND `qyura_hospitalTimeSlot`.`hospitalTimeSlot_hospitalId` = '5'
ERROR - 2016-05-14 12:32:19 --> Unable to save the image. Please make sure the image and file directory are writable.
ERROR - 2016-05-14 13:11:56 --> Unable to save the image. Please make sure the image and file directory are writable.
ERROR - 2016-05-14 13:37:13 --> Severity: Error --> Call to undefined method Common_model::sendMail() /var/www/html/qyura_v2/application/modules/api/controllers/auth/Auth.php 151
ERROR - 2016-05-14 13:37:45 --> Severity: Error --> Call to undefined method Common_model::sendMail() /var/www/html/qyura_v2/application/modules/api/controllers/auth/Auth.php 151
ERROR - 2016-05-14 13:41:36 --> 404 Page Not Found: ../modules/api/controllers//index
ERROR - 2016-05-14 13:41:46 --> 404 Page Not Found: ../modules/api/controllers//index
ERROR - 2016-05-14 13:44:59 --> 404 Page Not Found: ../modules/api/controllers//index
ERROR - 2016-05-14 13:46:45 --> 404 Page Not Found: ../modules/api/controllers/auth//index
ERROR - 2016-05-14 14:31:19 --> 404 Page Not Found: ../modules/auth/controllers/Auth/assets
ERROR - 2016-05-14 14:34:21 --> Severity: Error --> Call to undefined method BloodCatApi::miTimeSlot() /var/www/html/qyura_v2/application/modules/api/controllers/BloodCatApi.php 152
ERROR - 2016-05-14 15:47:23 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'IS NULL' at line 12 - Invalid query: SELECT `qyura_bloodBank`.`bloodBank_id`, `qyura_bloodBank`.`bloodBank_id`, `qyura_bloodBank`.`bloodBank_name`, `qyura_bloodBank`.`bloodBank_add`, `qyura_bloodBank`.`bloodBank_lat`, `qyura_bloodBank`.`bloodBank_long`, `qyura_bloodBank`.`bloodBank_photo`, CONCAT("0", "", `bloodBank_phn`) as  bloodBank_phn, `qyura_bloodBank`.`isEmergency`, (CASE WHEN(hospital_usersId is not null) THEN hospital_usersId WHEN(diagnostic_usersId is not null) THEN diagnostic_usersId ELSE  qyura_bloodBank.users_id END) as userId, (CASE WHEN(hospital_usersId is not null) THEN hospital_lat WHEN(diagnostic_usersId is not null) THEN diagnostic_lat ELSE  bloodBank_lat END) as lat, (CASE WHEN(hospital_usersId is not null) THEN hospital_long WHEN(diagnostic_usersId is not null) THEN diagnostic_long ELSE  bloodBank_long END) as lng, (CASE WHEN(hospital_usersId is not null) THEN hospital_address WHEN(diagnostic_usersId is not null) THEN diagnostic_address ELSE  bloodBank_add END) as adr, (
                    6371 * acos( cos( radians( 22.722548 ) ) * cos( radians( (CASE WHEN(hospital_usersId is not null) THEN hospital_lat WHEN(diagnostic_usersId is not null) THEN diagnostic_lat ELSE  bloodBank_lat END) ) ) * cos( radians( (CASE WHEN(hospital_usersId is not null) THEN hospital_long WHEN(diagnostic_usersId is not null) THEN diagnostic_long ELSE  bloodBank_long END) ) - radians( 75.886837 ) ) + sin( radians( 22.722548 ) ) * sin( radians( (CASE WHEN(hospital_usersId is not null) THEN hospital_lat WHEN(diagnostic_usersId is not null) THEN diagnostic_lat ELSE  bloodBank_lat END) ) ) )
                    ) AS distance
FROM `qyura_bloodBank`
LEFT JOIN `qyura_usersRoles` ON `qyura_usersRoles`.`usersRoles_userId`=`qyura_bloodBank`.`users_id`
LEFT JOIN `qyura_hospital` ON `qyura_usersRoles`.`usersRoles_parentId`=`qyura_hospital`.`hospital_usersId` AND `qyura_hospital`.`status` = 1 AND `qyura_hospital`.`hospital_deleted` = "0"
LEFT JOIN `qyura_diagnostic` ON `qyura_usersRoles`.`usersRoles_parentId`=`qyura_diagnostic`.`diagnostic_usersId` AND `qyura_diagnostic`.`status`=1 AND `qyura_diagnostic`.`diagnostic_deleted` = 0
WHERE `qyura_bloodBank`.`bloodBank_deleted` =0
AND `qyura_bloodBank`.`bloodBank_id` NOT IN('0')
GROUP BY `bloodBank_id`
HAVING `distance` < 70
AND  IS NULL
ERROR - 2016-05-14 15:47:35 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'IS NULL' at line 12 - Invalid query: SELECT `qyura_bloodBank`.`bloodBank_id`, `qyura_bloodBank`.`bloodBank_id`, `qyura_bloodBank`.`bloodBank_name`, `qyura_bloodBank`.`bloodBank_add`, `qyura_bloodBank`.`bloodBank_lat`, `qyura_bloodBank`.`bloodBank_long`, `qyura_bloodBank`.`bloodBank_photo`, CONCAT("0", "", `bloodBank_phn`) as  bloodBank_phn, `qyura_bloodBank`.`isEmergency`, (CASE WHEN(hospital_usersId is not null) THEN hospital_usersId WHEN(diagnostic_usersId is not null) THEN diagnostic_usersId ELSE  qyura_bloodBank.users_id END) as userId, (CASE WHEN(hospital_usersId is not null) THEN hospital_lat WHEN(diagnostic_usersId is not null) THEN diagnostic_lat ELSE  bloodBank_lat END) as lat, (CASE WHEN(hospital_usersId is not null) THEN hospital_long WHEN(diagnostic_usersId is not null) THEN diagnostic_long ELSE  bloodBank_long END) as lng, (CASE WHEN(hospital_usersId is not null) THEN hospital_address WHEN(diagnostic_usersId is not null) THEN diagnostic_address ELSE  bloodBank_add END) as adr, (
                    6371 * acos( cos( radians( 22.722329 ) ) * cos( radians( (CASE WHEN(hospital_usersId is not null) THEN hospital_lat WHEN(diagnostic_usersId is not null) THEN diagnostic_lat ELSE  bloodBank_lat END) ) ) * cos( radians( (CASE WHEN(hospital_usersId is not null) THEN hospital_long WHEN(diagnostic_usersId is not null) THEN diagnostic_long ELSE  bloodBank_long END) ) - radians( 75.886262 ) ) + sin( radians( 22.722329 ) ) * sin( radians( (CASE WHEN(hospital_usersId is not null) THEN hospital_lat WHEN(diagnostic_usersId is not null) THEN diagnostic_lat ELSE  bloodBank_lat END) ) ) )
                    ) AS distance
FROM `qyura_bloodBank`
LEFT JOIN `qyura_usersRoles` ON `qyura_usersRoles`.`usersRoles_userId`=`qyura_bloodBank`.`users_id`
LEFT JOIN `qyura_hospital` ON `qyura_usersRoles`.`usersRoles_parentId`=`qyura_hospital`.`hospital_usersId` AND `qyura_hospital`.`status` = 1 AND `qyura_hospital`.`hospital_deleted` = "0"
LEFT JOIN `qyura_diagnostic` ON `qyura_usersRoles`.`usersRoles_parentId`=`qyura_diagnostic`.`diagnostic_usersId` AND `qyura_diagnostic`.`status`=1 AND `qyura_diagnostic`.`diagnostic_deleted` = 0
WHERE `qyura_bloodBank`.`bloodBank_deleted` =0
AND `qyura_bloodBank`.`bloodBank_id` NOT IN('0')
GROUP BY `bloodBank_id`
HAVING `distance` < 70
AND  IS NULL
ERROR - 2016-05-14 15:48:32 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'IS NULL' at line 12 - Invalid query: SELECT `qyura_bloodBank`.`bloodBank_id`, `qyura_bloodBank`.`bloodBank_id`, `qyura_bloodBank`.`bloodBank_name`, `qyura_bloodBank`.`bloodBank_add`, `qyura_bloodBank`.`bloodBank_lat`, `qyura_bloodBank`.`bloodBank_long`, `qyura_bloodBank`.`bloodBank_photo`, CONCAT("0", "", `bloodBank_phn`) as  bloodBank_phn, `qyura_bloodBank`.`isEmergency`, (CASE WHEN(hospital_usersId is not null) THEN hospital_usersId WHEN(diagnostic_usersId is not null) THEN diagnostic_usersId ELSE  qyura_bloodBank.users_id END) as userId, (CASE WHEN(hospital_usersId is not null) THEN hospital_lat WHEN(diagnostic_usersId is not null) THEN diagnostic_lat ELSE  bloodBank_lat END) as lat, (CASE WHEN(hospital_usersId is not null) THEN hospital_long WHEN(diagnostic_usersId is not null) THEN diagnostic_long ELSE  bloodBank_long END) as lng, (CASE WHEN(hospital_usersId is not null) THEN hospital_address WHEN(diagnostic_usersId is not null) THEN diagnostic_address ELSE  bloodBank_add END) as adr, (
                    6371 * acos( cos( radians( 22.722548 ) ) * cos( radians( (CASE WHEN(hospital_usersId is not null) THEN hospital_lat WHEN(diagnostic_usersId is not null) THEN diagnostic_lat ELSE  bloodBank_lat END) ) ) * cos( radians( (CASE WHEN(hospital_usersId is not null) THEN hospital_long WHEN(diagnostic_usersId is not null) THEN diagnostic_long ELSE  bloodBank_long END) ) - radians( 75.886837 ) ) + sin( radians( 22.722548 ) ) * sin( radians( (CASE WHEN(hospital_usersId is not null) THEN hospital_lat WHEN(diagnostic_usersId is not null) THEN diagnostic_lat ELSE  bloodBank_lat END) ) ) )
                    ) AS distance
FROM `qyura_bloodBank`
LEFT JOIN `qyura_usersRoles` ON `qyura_usersRoles`.`usersRoles_userId`=`qyura_bloodBank`.`users_id`
LEFT JOIN `qyura_hospital` ON `qyura_usersRoles`.`usersRoles_parentId`=`qyura_hospital`.`hospital_usersId` AND `qyura_hospital`.`status` = 1 AND `qyura_hospital`.`hospital_deleted` = "0"
LEFT JOIN `qyura_diagnostic` ON `qyura_usersRoles`.`usersRoles_parentId`=`qyura_diagnostic`.`diagnostic_usersId` AND `qyura_diagnostic`.`status`=1 AND `qyura_diagnostic`.`diagnostic_deleted` = 0
WHERE `qyura_bloodBank`.`bloodBank_deleted` =0
AND `qyura_bloodBank`.`bloodBank_id` NOT IN('0')
GROUP BY `bloodBank_id`
HAVING `distance` < 70
AND  IS NULL
ERROR - 2016-05-14 15:57:03 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'IS NULL
ORDER BY `distance` ASC
 LIMIT 70' at line 12 - Invalid query: SELECT `ambulance_id` `id`, `ambulance_name` `name`, CONCAT("0", "", SUBSTR(ambulance_phn, -10)) phn, (CASE WHEN(hospital_usersId is not null) THEN hospital_usersId WHEN(diagnostic_usersId is not null) THEN diagnostic_usersId ELSE  qyura_ambulance.ambulance_usersId END) as userId, (CASE WHEN(hospital_usersId is not null) THEN hospital_lat WHEN(diagnostic_usersId is not null) THEN diagnostic_lat ELSE  ambulance_lat END) as lat, (CASE WHEN(hospital_usersId is not null) THEN hospital_long WHEN(diagnostic_usersId is not null) THEN diagnostic_long ELSE  ambulance_long END) as lng, (CASE WHEN(hospital_usersId is not null) THEN hospital_address WHEN(diagnostic_usersId is not null) THEN diagnostic_address ELSE   ambulance_address END) as adr, ( 6371 * acos( cos( radians( 22.718410 ) ) * cos( radians( (CASE WHEN(hospital_usersId is not null) THEN hospital_lat WHEN(diagnostic_usersId is not null) THEN diagnostic_lat ELSE  ambulance_lat END) ) ) * cos( radians(  (CASE WHEN(hospital_usersId is not null) THEN hospital_long WHEN(diagnostic_usersId is not null) THEN diagnostic_long ELSE  ambulance_long END) ) - radians( 75.855896 ) ) + sin( radians( 22.718410 ) ) * sin( radians( (CASE WHEN(hospital_usersId is not null) THEN hospital_lat WHEN(diagnostic_usersId is not null) THEN diagnostic_lat ELSE  ambulance_lat END) ) ) )
                ) AS distance, `docOnBoard`, `ambulance_usersId` as `usersId`, `ambulance_27Src` as `isEmergency`
FROM `qyura_ambulance`
LEFT JOIN `qyura_usersRoles` ON `qyura_usersRoles`.`usersRoles_userId`=`qyura_ambulance`.`ambulance_usersId`
LEFT JOIN `qyura_hospital` ON `qyura_usersRoles`.`usersRoles_parentId`=`qyura_hospital`.`hospital_usersId` AND `qyura_hospital`.`status` = 1 AND `qyura_hospital`.`hospital_deleted` = "0"
LEFT JOIN `qyura_diagnostic` ON `qyura_usersRoles`.`usersRoles_parentId`=`qyura_diagnostic`.`diagnostic_usersId` AND `qyura_diagnostic`.`status`=1 AND `qyura_diagnostic`.`diagnostic_deleted` = 0
WHERE `ambulance_deleted` =0
AND `qyura_ambulance`.`status` = 1
AND `ambulance_cityId` = '705'
AND `ambulance_id` NOT IN('')
GROUP BY `ambulance_id`
HAVING  IS NULL
ORDER BY `distance` ASC
 LIMIT 70
ERROR - 2016-05-14 17:18:17 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'UNION SELECT healthPkgBooking_id as id, `healthPackage_packageTitle` as `title`,' at line 1 - Invalid query:  UNION SELECT healthPkgBooking_id as id, `healthPackage_packageTitle` as `title`,`healthPkgBooking_orderNo` as `orderId`,DATE_FORMAT(FROM_UNIXTIME(`healthPkgBooking_finalBookingDate`),"%d %b,%Y") as date,"" as startTime, "" as endTime,(CASE WHEN(diagnostic_usersId is not null) THEN diagnostic_name WHEN(hospital_usersId is not null) THEN hospital_name END) as `address`,(CASE WHEN(healthPkgBooking_finalBookingDate > UNIX_TIMESTAMP()) THEN "Upcoming" ELSE "Completed" END) as upcomingStatus,(CASE healthPkgBooking_bkStatus WHEN '12' THEN 'Confirmed' WHEN '13' THEN 'Cancelled' WHEN '11' THEN 'Pending' WHEN '14' THEN 'Completed' WHEN '19' THEN 'Expired' ELSE '' END) as `bookingStatus`, "Health Package" as `type`, "2" as typeId FROM `qyura_healthPkgBooking` LEFT JOIN `qyura_healthPackage` ON `qyura_healthPackage`.`healthPackage_id` = `qyura_healthPkgBooking`.`healthPkgBooking_healthPackageId`
LEFT JOIN `transactionInfo` ON `transactionInfo`.`order_no` = `qyura_healthPkgBooking`.`healthPkgBooking_orderNo`
LEFT JOIN `qyura_hospital` ON `qyura_hospital`.`hospital_usersId` = `qyura_healthPkgBooking`.`healthPkgBooking_miId`
LEFT JOIN `qyura_diagnostic` ON `qyura_diagnostic`.`diagnostic_usersId` = `qyura_healthPkgBooking`.`healthPkgBooking_miId`
LEFT JOIN `qyura_users` ON `qyura_users`.`users_id` = `qyura_healthPkgBooking`.`healthPkgBooking_userId`
LEFT JOIN `qyura_patientDetails` ON `qyura_patientDetails`.`patientDetails_usersId` = `qyura_users`.`users_id`
LEFT JOIN `qyura_usersFamily` ON `qyura_usersFamily`.`usersfamily_id` = `qyura_healthPkgBooking`.`healthPkgBooking_memberId`
WHERE `healthPkgBooking_userId` = "14"
AND `healthPkgBooking_deleted` = 0 UNION SELECT doctorAppointment_id as id, CASE WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 1 ) THEN `qyura_hospital`.`hospital_name` WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 2 ) THEN `qyura_diagnostic`.`diagnostic_name` ELSE concat(`doctors_fName`,' ',`doctors_lName`) END AS title,`qyura_doctorAppointment`.`doctorAppointment_unqId` AS `orderId`,DATE_FORMAT(FROM_UNIXTIME(`qyura_doctorAppointment`.`doctorAppointment_date`),'%d %b, %Y') as date,DATE_FORMAT(`docTimeDay_open`,'%h:%i%p') as startTime,DATE_FORMAT(`docTimeDay_close`,'%h:%i%p') as endTime, CASE WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 3 ) THEN (CASE WHEN (docTimeTable_stayAt = 0) THEN psChamber_name ELSE  CASE WHEN (docTimeTable_MItype = 1) THEN hospital_name WHEN (docTimeTable_MItype = 2) THEN diagnostic_name ELSE '' END END ) ELSE concat(`doctors_fName`,' ',`doctors_lName`) END AS address, CASE WHEN (concat(DATE_FORMAT(FROM_UNIXTIME(`qyura_doctorAppointment`.`doctorAppointment_date`),'%Y-%m-%d'),' ',DATE_FORMAT(docTimeDay_open, '%h:%i %p')) > DATE_FORMAT(CURRENT_TIMESTAMP, '%Y-%m-%d %h:%i %p') AND (qyura_doctorAppointment.doctorAppointment_status = 11 || qyura_doctorAppointment.doctorAppointment_status = 14  )) THEN 'Upcoming' ELSE 'Completed' END as `upcomingStatus`, CASE qyura_doctorAppointment.doctorAppointment_status WHEN '12' THEN 'Confirmed' WHEN '13' THEN 'Cancelled' WHEN '11' THEN 'Pending' WHEN '14' THEN 'Completed' WHEN '19' THEN 'Expired' ELSE '' END  AS `bookingStatus`,'Consultation' as `type`, '3' as typeId FROM `qyura_doctorAppointment`
                    
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
                    
                    WHERE `qyura_doctorAppointment`.`doctorAppointment_pntUserId` = '14'
                    AND `qyura_doctorAppointment`.`doctorAppointment_deleted` = 0
                    AND `qyura_doctorAppointment`.`doctorAppointment_date` <> 0
ERROR - 2016-05-14 17:19:05 --> Query error: Table 'vsure_qyura.qyura_hospitalTimeSlot' doesn't exist - Invalid query: SELECT quotation_id as id, `qyura_quotationBooking`.`quotationBooking_reportTitle` as title,`qyura_quotationBooking`.`quotationBooking_orderId` AS `orderId`,DATE_FORMAT(FROM_UNIXTIME(`qyura_quotations`.`quotation_dateTime`),'%d %b, %Y') as date,CASE WHEN (`qyura_hospital`.`hospital_usersId` <> 0 ) THEN DATE_FORMAT(FROM_UNIXTIME(`qyura_hospitalTimeSlot`.`hospitalTimeSlot_startTime`),'%h:%i%p') ELSE DATE_FORMAT(FROM_UNIXTIME(`qyura_diagnosticCenterTimeSlot`.`diagnosticCenterTimeSlot_startTime`),'%h:%i%p') END AS `startTime`,CASE WHEN (`qyura_hospital`.`hospital_usersId` <> 0 ) THEN DATE_FORMAT(FROM_UNIXTIME(`qyura_hospitalTimeSlot`.`hospitalTimeSlot_endTime`),'%h:%i%p') ELSE DATE_FORMAT(FROM_UNIXTIME(`qyura_diagnosticCenterTimeSlot`.`diagnosticCenterTimeSlot_endTime`),'%h:%i%p') END AS `endTime`,CASE WHEN (`qyura_hospital`.`hospital_usersId` <> 0 ) THEN qyura_hospital.hospital_address ELSE qyura_diagnostic.diagnostic_address END AS `address`,(CASE WHEN(quotation_dateTime > CURRENT_TIMESTAMP AND (qyura_doctorAppointment.doctorAppointment_status = 11 || qyura_doctorAppointment.doctorAppointment_status = 14  ))  THEN 'Upcoming' ELSE 'Completed' END  ) as `upcomingStatus`,CASE qyura_quotationBooking.quotationBooking_bookStatus WHEN '12' THEN 'Confirmed' WHEN '13' THEN 'Cancelled' WHEN '11' THEN 'Pending' WHEN '14' THEN 'Completed' WHEN '19' THEN 'Expired' ELSE '' END AS `bookingStatus`,'Diagnostic' as `type`, '2' as `typeId`FROM `qyura_quotationBooking` LEFT JOIN `transactionInfo` ON `transactionInfo`.`order_no` = `qyura_quotationBooking`.`quotationBooking_orderId`
                        
LEFT JOIN `qyura_quotations` ON `qyura_quotations`.`quotation_id`=`qyura_quotationBooking`.`quotationBooking_quotationId`
LEFT JOIN `qyura_users` ON `qyura_users`.`users_id`=`qyura_quotations`.`quotation_userId`
LEFT JOIN `qyura_patientDetails` ON `qyura_patientDetails`.`patientDetails_usersId`=`qyura_quotationBooking`.`quotationBooking_userId`
LEFT JOIN `qyura_usersFamily` ON `qyura_usersFamily`.`usersfamily_id`=`qyura_quotations`.`quotation_familyId`
LEFT JOIN `qyura_hospital` ON `qyura_hospital`.`hospital_usersId`=`qyura_quotations`.`quotation_MiId`
LEFT JOIN `qyura_diagnostic` ON `qyura_diagnostic`.`diagnostic_usersId`=`qyura_quotations`.`quotation_MiId`
LEFT JOIN `qyura_hospitalTimeSlot` ON `qyura_hospitalTimeSlot`.`hospitalTimeSlot_id`=`qyura_quotations`.`quotation_timeSlotId`
LEFT JOIN `qyura_diagnosticCenterTimeSlot` ON `qyura_diagnosticCenterTimeSlot`.`diagnosticCenterTimeSlot_id`=`qyura_quotations`.`quotation_timeSlotId`
LEFT JOIN `qyura_diagnosticsCat` ON `qyura_diagnosticsCat`.`diagnosticsCat_catId`=`qyura_quotations`.`quotation_diagnosticsCatId`
WHERE `qyura_quotationBooking`.`quotationBooking_userId` = '14'
AND `qyura_quotationBooking`.`quotationBooking_deleted` = 0
AND `qyura_quotations`.`quotation_dateTime` <> 0 UNION SELECT healthPkgBooking_id as id, `healthPackage_packageTitle` as `title`,`healthPkgBooking_orderNo` as `orderId`,DATE_FORMAT(FROM_UNIXTIME(`healthPkgBooking_finalBookingDate`),"%d %b,%Y") as date,"" as startTime, "" as endTime,(CASE WHEN(diagnostic_usersId is not null) THEN diagnostic_name WHEN(hospital_usersId is not null) THEN hospital_name END) as `address`,(CASE WHEN(healthPkgBooking_finalBookingDate > UNIX_TIMESTAMP()) THEN "Upcoming" ELSE "Completed" END) as upcomingStatus,(CASE healthPkgBooking_bkStatus WHEN '12' THEN 'Confirmed' WHEN '13' THEN 'Cancelled' WHEN '11' THEN 'Pending' WHEN '14' THEN 'Completed' WHEN '19' THEN 'Expired' ELSE '' END) as `bookingStatus`, "Health Package" as `type`, "2" as typeId FROM `qyura_healthPkgBooking` LEFT JOIN `qyura_healthPackage` ON `qyura_healthPackage`.`healthPackage_id` = `qyura_healthPkgBooking`.`healthPkgBooking_healthPackageId`
LEFT JOIN `transactionInfo` ON `transactionInfo`.`order_no` = `qyura_healthPkgBooking`.`healthPkgBooking_orderNo`
LEFT JOIN `qyura_hospital` ON `qyura_hospital`.`hospital_usersId` = `qyura_healthPkgBooking`.`healthPkgBooking_miId`
LEFT JOIN `qyura_diagnostic` ON `qyura_diagnostic`.`diagnostic_usersId` = `qyura_healthPkgBooking`.`healthPkgBooking_miId`
LEFT JOIN `qyura_users` ON `qyura_users`.`users_id` = `qyura_healthPkgBooking`.`healthPkgBooking_userId`
LEFT JOIN `qyura_patientDetails` ON `qyura_patientDetails`.`patientDetails_usersId` = `qyura_users`.`users_id`
LEFT JOIN `qyura_usersFamily` ON `qyura_usersFamily`.`usersfamily_id` = `qyura_healthPkgBooking`.`healthPkgBooking_memberId`
WHERE `healthPkgBooking_userId` = "14"
AND `healthPkgBooking_deleted` = 0 UNION SELECT doctorAppointment_id as id, CASE WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 1 ) THEN `qyura_hospital`.`hospital_name` WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 2 ) THEN `qyura_diagnostic`.`diagnostic_name` ELSE concat(`doctors_fName`,' ',`doctors_lName`) END AS title,`qyura_doctorAppointment`.`doctorAppointment_unqId` AS `orderId`,DATE_FORMAT(FROM_UNIXTIME(`qyura_doctorAppointment`.`doctorAppointment_date`),'%d %b, %Y') as date,DATE_FORMAT(`docTimeDay_open`,'%h:%i%p') as startTime,DATE_FORMAT(`docTimeDay_close`,'%h:%i%p') as endTime, CASE WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 3 ) THEN (CASE WHEN (docTimeTable_stayAt = 0) THEN psChamber_name ELSE  CASE WHEN (docTimeTable_MItype = 1) THEN hospital_name WHEN (docTimeTable_MItype = 2) THEN diagnostic_name ELSE '' END END ) ELSE concat(`doctors_fName`,' ',`doctors_lName`) END AS address, CASE WHEN (concat(DATE_FORMAT(FROM_UNIXTIME(`qyura_doctorAppointment`.`doctorAppointment_date`),'%Y-%m-%d'),' ',DATE_FORMAT(docTimeDay_open, '%h:%i %p')) > DATE_FORMAT(CURRENT_TIMESTAMP, '%Y-%m-%d %h:%i %p') AND (qyura_doctorAppointment.doctorAppointment_status = 11 || qyura_doctorAppointment.doctorAppointment_status = 14  )) THEN 'Upcoming' ELSE 'Completed' END as `upcomingStatus`, CASE qyura_doctorAppointment.doctorAppointment_status WHEN '12' THEN 'Confirmed' WHEN '13' THEN 'Cancelled' WHEN '11' THEN 'Pending' WHEN '14' THEN 'Completed' WHEN '19' THEN 'Expired' ELSE '' END  AS `bookingStatus`,'Consultation' as `type`, '3' as typeId FROM `qyura_doctorAppointment`
                    
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
                    
                    WHERE `qyura_doctorAppointment`.`doctorAppointment_pntUserId` = '14'
                    AND `qyura_doctorAppointment`.`doctorAppointment_deleted` = 0
                    AND `qyura_doctorAppointment`.`doctorAppointment_date` <> 0
ERROR - 2016-05-14 17:20:30 --> Severity: Error --> Call to undefined method Common_model::sendMail() /var/www/html/qyura_v2/application/modules/api/controllers/auth/Auth.php 151
ERROR - 2016-05-14 17:24:49 --> Query error: Unknown column 'qyura_doctorAppointment.doctorAppointment_status' in 'field list' - Invalid query: SELECT quotation_id as id, `qyura_quotationBooking`.`quotationBooking_reportTitle` as title,`qyura_quotationBooking`.`quotationBooking_orderId` AS `orderId`,DATE_FORMAT(FROM_UNIXTIME(`qyura_quotations`.`quotation_dateTime`),'%d %b, %Y') as date,0 AS `startTime`,0 AS `endTime`,CASE WHEN (`qyura_hospital`.`hospital_usersId` <> 0 ) THEN qyura_hospital.hospital_address ELSE qyura_diagnostic.diagnostic_address END AS `address`,(CASE WHEN(quotation_dateTime > CURRENT_TIMESTAMP AND (qyura_doctorAppointment.doctorAppointment_status = 11 || qyura_doctorAppointment.doctorAppointment_status = 14  ))  THEN 'Upcoming' ELSE 'Completed' END  ) as `upcomingStatus`,CASE qyura_quotationBooking.quotationBooking_bookStatus WHEN '12' THEN 'Confirmed' WHEN '13' THEN 'Cancelled' WHEN '11' THEN 'Pending' WHEN '14' THEN 'Completed' WHEN '19' THEN 'Expired' ELSE '' END AS `bookingStatus`,'Diagnostic' as `type`, '2' as `typeId`FROM `qyura_quotationBooking` LEFT JOIN `transactionInfo` ON `transactionInfo`.`order_no` = `qyura_quotationBooking`.`quotationBooking_orderId`
                        
LEFT JOIN `qyura_quotations` ON `qyura_quotations`.`quotation_id`=`qyura_quotationBooking`.`quotationBooking_quotationId`
LEFT JOIN `qyura_users` ON `qyura_users`.`users_id`=`qyura_quotations`.`quotation_userId`
LEFT JOIN `qyura_patientDetails` ON `qyura_patientDetails`.`patientDetails_usersId`=`qyura_quotationBooking`.`quotationBooking_userId`
LEFT JOIN `qyura_usersFamily` ON `qyura_usersFamily`.`usersfamily_id`=`qyura_quotations`.`quotation_familyId`
LEFT JOIN `qyura_hospital` ON `qyura_hospital`.`hospital_usersId`=`qyura_quotations`.`quotation_MiId`
LEFT JOIN `qyura_diagnostic` ON `qyura_diagnostic`.`diagnostic_usersId`=`qyura_quotations`.`quotation_MiId`
LEFT JOIN `qyura_diagnosticsCat` ON `qyura_diagnosticsCat`.`diagnosticsCat_catId`=`qyura_quotations`.`quotation_diagnosticsCatId`
WHERE `qyura_quotationBooking`.`quotationBooking_userId` = '14'
AND `qyura_quotationBooking`.`quotationBooking_deleted` = 0
AND `qyura_quotations`.`quotation_dateTime` <> 0 UNION SELECT healthPkgBooking_id as id, `healthPackage_packageTitle` as `title`,`healthPkgBooking_orderNo` as `orderId`,DATE_FORMAT(FROM_UNIXTIME(`healthPkgBooking_finalBookingDate`),"%d %b,%Y") as date,"" as startTime, "" as endTime,(CASE WHEN(diagnostic_usersId is not null) THEN diagnostic_name WHEN(hospital_usersId is not null) THEN hospital_name END) as `address`,(CASE WHEN(healthPkgBooking_finalBookingDate > UNIX_TIMESTAMP()) THEN "Upcoming" ELSE "Completed" END) as upcomingStatus,(CASE healthPkgBooking_bkStatus WHEN '12' THEN 'Confirmed' WHEN '13' THEN 'Cancelled' WHEN '11' THEN 'Pending' WHEN '14' THEN 'Completed' WHEN '19' THEN 'Expired' ELSE '' END) as `bookingStatus`, "Health Package" as `type`, "2" as typeId FROM `qyura_healthPkgBooking` LEFT JOIN `qyura_healthPackage` ON `qyura_healthPackage`.`healthPackage_id` = `qyura_healthPkgBooking`.`healthPkgBooking_healthPackageId`
LEFT JOIN `transactionInfo` ON `transactionInfo`.`order_no` = `qyura_healthPkgBooking`.`healthPkgBooking_orderNo`
LEFT JOIN `qyura_hospital` ON `qyura_hospital`.`hospital_usersId` = `qyura_healthPkgBooking`.`healthPkgBooking_miId`
LEFT JOIN `qyura_diagnostic` ON `qyura_diagnostic`.`diagnostic_usersId` = `qyura_healthPkgBooking`.`healthPkgBooking_miId`
LEFT JOIN `qyura_users` ON `qyura_users`.`users_id` = `qyura_healthPkgBooking`.`healthPkgBooking_userId`
LEFT JOIN `qyura_patientDetails` ON `qyura_patientDetails`.`patientDetails_usersId` = `qyura_users`.`users_id`
LEFT JOIN `qyura_usersFamily` ON `qyura_usersFamily`.`usersfamily_id` = `qyura_healthPkgBooking`.`healthPkgBooking_memberId`
WHERE `healthPkgBooking_userId` = "14"
AND `healthPkgBooking_deleted` = 0 UNION SELECT doctorAppointment_id as id, CASE WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 1 ) THEN `qyura_hospital`.`hospital_name` WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 2 ) THEN `qyura_diagnostic`.`diagnostic_name` ELSE concat(`doctors_fName`,' ',`doctors_lName`) END AS title,`qyura_doctorAppointment`.`doctorAppointment_unqId` AS `orderId`,DATE_FORMAT(FROM_UNIXTIME(`qyura_doctorAppointment`.`doctorAppointment_date`),'%d %b, %Y') as date,DATE_FORMAT(`docTimeDay_open`,'%h:%i%p') as startTime,DATE_FORMAT(`docTimeDay_close`,'%h:%i%p') as endTime, CASE WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 3 ) THEN (CASE WHEN (docTimeTable_stayAt = 0) THEN psChamber_name ELSE  CASE WHEN (docTimeTable_MItype = 1) THEN hospital_name WHEN (docTimeTable_MItype = 2) THEN diagnostic_name ELSE '' END END ) ELSE concat(`doctors_fName`,' ',`doctors_lName`) END AS address, CASE WHEN (concat(DATE_FORMAT(FROM_UNIXTIME(`qyura_doctorAppointment`.`doctorAppointment_date`),'%Y-%m-%d'),' ',DATE_FORMAT(docTimeDay_open, '%h:%i %p')) > DATE_FORMAT(CURRENT_TIMESTAMP, '%Y-%m-%d %h:%i %p') AND (qyura_doctorAppointment.doctorAppointment_status = 11 || qyura_doctorAppointment.doctorAppointment_status = 14  )) THEN 'Upcoming' ELSE 'Completed' END as `upcomingStatus`, CASE qyura_doctorAppointment.doctorAppointment_status WHEN '12' THEN 'Confirmed' WHEN '13' THEN 'Cancelled' WHEN '11' THEN 'Pending' WHEN '14' THEN 'Completed' WHEN '19' THEN 'Expired' ELSE '' END  AS `bookingStatus`,'Consultation' as `type`, '3' as typeId FROM `qyura_doctorAppointment`
                    
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
                    
                    WHERE `qyura_doctorAppointment`.`doctorAppointment_pntUserId` = '14'
                    AND `qyura_doctorAppointment`.`doctorAppointment_deleted` = 0
                    AND `qyura_doctorAppointment`.`doctorAppointment_date` <> 0
ERROR - 2016-05-14 17:24:52 --> Query error: Unknown column 'qyura_doctorAppointment.doctorAppointment_status' in 'field list' - Invalid query: SELECT quotation_id as id, `qyura_quotationBooking`.`quotationBooking_reportTitle` as title,`qyura_quotationBooking`.`quotationBooking_orderId` AS `orderId`,DATE_FORMAT(FROM_UNIXTIME(`qyura_quotations`.`quotation_dateTime`),'%d %b, %Y') as date,0 AS `startTime`,0 AS `endTime`,CASE WHEN (`qyura_hospital`.`hospital_usersId` <> 0 ) THEN qyura_hospital.hospital_address ELSE qyura_diagnostic.diagnostic_address END AS `address`,(CASE WHEN(quotation_dateTime > CURRENT_TIMESTAMP AND (qyura_doctorAppointment.doctorAppointment_status = 11 || qyura_doctorAppointment.doctorAppointment_status = 14  ))  THEN 'Upcoming' ELSE 'Completed' END  ) as `upcomingStatus`,CASE qyura_quotationBooking.quotationBooking_bookStatus WHEN '12' THEN 'Confirmed' WHEN '13' THEN 'Cancelled' WHEN '11' THEN 'Pending' WHEN '14' THEN 'Completed' WHEN '19' THEN 'Expired' ELSE '' END AS `bookingStatus`,'Diagnostic' as `type`, '2' as `typeId`FROM `qyura_quotationBooking` LEFT JOIN `transactionInfo` ON `transactionInfo`.`order_no` = `qyura_quotationBooking`.`quotationBooking_orderId`
                        
LEFT JOIN `qyura_quotations` ON `qyura_quotations`.`quotation_id`=`qyura_quotationBooking`.`quotationBooking_quotationId`
LEFT JOIN `qyura_users` ON `qyura_users`.`users_id`=`qyura_quotations`.`quotation_userId`
LEFT JOIN `qyura_patientDetails` ON `qyura_patientDetails`.`patientDetails_usersId`=`qyura_quotationBooking`.`quotationBooking_userId`
LEFT JOIN `qyura_usersFamily` ON `qyura_usersFamily`.`usersfamily_id`=`qyura_quotations`.`quotation_familyId`
LEFT JOIN `qyura_hospital` ON `qyura_hospital`.`hospital_usersId`=`qyura_quotations`.`quotation_MiId`
LEFT JOIN `qyura_diagnostic` ON `qyura_diagnostic`.`diagnostic_usersId`=`qyura_quotations`.`quotation_MiId`
LEFT JOIN `qyura_diagnosticsCat` ON `qyura_diagnosticsCat`.`diagnosticsCat_catId`=`qyura_quotations`.`quotation_diagnosticsCatId`
WHERE `qyura_quotationBooking`.`quotationBooking_userId` = '14'
AND `qyura_quotationBooking`.`quotationBooking_deleted` = 0
AND `qyura_quotations`.`quotation_dateTime` <> 0 UNION SELECT healthPkgBooking_id as id, `healthPackage_packageTitle` as `title`,`healthPkgBooking_orderNo` as `orderId`,DATE_FORMAT(FROM_UNIXTIME(`healthPkgBooking_finalBookingDate`),"%d %b,%Y") as date,"" as startTime, "" as endTime,(CASE WHEN(diagnostic_usersId is not null) THEN diagnostic_name WHEN(hospital_usersId is not null) THEN hospital_name END) as `address`,(CASE WHEN(healthPkgBooking_finalBookingDate > UNIX_TIMESTAMP()) THEN "Upcoming" ELSE "Completed" END) as upcomingStatus,(CASE healthPkgBooking_bkStatus WHEN '12' THEN 'Confirmed' WHEN '13' THEN 'Cancelled' WHEN '11' THEN 'Pending' WHEN '14' THEN 'Completed' WHEN '19' THEN 'Expired' ELSE '' END) as `bookingStatus`, "Health Package" as `type`, "2" as typeId FROM `qyura_healthPkgBooking` LEFT JOIN `qyura_healthPackage` ON `qyura_healthPackage`.`healthPackage_id` = `qyura_healthPkgBooking`.`healthPkgBooking_healthPackageId`
LEFT JOIN `transactionInfo` ON `transactionInfo`.`order_no` = `qyura_healthPkgBooking`.`healthPkgBooking_orderNo`
LEFT JOIN `qyura_hospital` ON `qyura_hospital`.`hospital_usersId` = `qyura_healthPkgBooking`.`healthPkgBooking_miId`
LEFT JOIN `qyura_diagnostic` ON `qyura_diagnostic`.`diagnostic_usersId` = `qyura_healthPkgBooking`.`healthPkgBooking_miId`
LEFT JOIN `qyura_users` ON `qyura_users`.`users_id` = `qyura_healthPkgBooking`.`healthPkgBooking_userId`
LEFT JOIN `qyura_patientDetails` ON `qyura_patientDetails`.`patientDetails_usersId` = `qyura_users`.`users_id`
LEFT JOIN `qyura_usersFamily` ON `qyura_usersFamily`.`usersfamily_id` = `qyura_healthPkgBooking`.`healthPkgBooking_memberId`
WHERE `healthPkgBooking_userId` = "14"
AND `healthPkgBooking_deleted` = 0 UNION SELECT doctorAppointment_id as id, CASE WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 1 ) THEN `qyura_hospital`.`hospital_name` WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 2 ) THEN `qyura_diagnostic`.`diagnostic_name` ELSE concat(`doctors_fName`,' ',`doctors_lName`) END AS title,`qyura_doctorAppointment`.`doctorAppointment_unqId` AS `orderId`,DATE_FORMAT(FROM_UNIXTIME(`qyura_doctorAppointment`.`doctorAppointment_date`),'%d %b, %Y') as date,DATE_FORMAT(`docTimeDay_open`,'%h:%i%p') as startTime,DATE_FORMAT(`docTimeDay_close`,'%h:%i%p') as endTime, CASE WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 3 ) THEN (CASE WHEN (docTimeTable_stayAt = 0) THEN psChamber_name ELSE  CASE WHEN (docTimeTable_MItype = 1) THEN hospital_name WHEN (docTimeTable_MItype = 2) THEN diagnostic_name ELSE '' END END ) ELSE concat(`doctors_fName`,' ',`doctors_lName`) END AS address, CASE WHEN (concat(DATE_FORMAT(FROM_UNIXTIME(`qyura_doctorAppointment`.`doctorAppointment_date`),'%Y-%m-%d'),' ',DATE_FORMAT(docTimeDay_open, '%h:%i %p')) > DATE_FORMAT(CURRENT_TIMESTAMP, '%Y-%m-%d %h:%i %p') AND (qyura_doctorAppointment.doctorAppointment_status = 11 || qyura_doctorAppointment.doctorAppointment_status = 14  )) THEN 'Upcoming' ELSE 'Completed' END as `upcomingStatus`, CASE qyura_doctorAppointment.doctorAppointment_status WHEN '12' THEN 'Confirmed' WHEN '13' THEN 'Cancelled' WHEN '11' THEN 'Pending' WHEN '14' THEN 'Completed' WHEN '19' THEN 'Expired' ELSE '' END  AS `bookingStatus`,'Consultation' as `type`, '3' as typeId FROM `qyura_doctorAppointment`
                    
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
                    
                    WHERE `qyura_doctorAppointment`.`doctorAppointment_pntUserId` = '14'
                    AND `qyura_doctorAppointment`.`doctorAppointment_deleted` = 0
                    AND `qyura_doctorAppointment`.`doctorAppointment_date` <> 0
