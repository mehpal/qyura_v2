<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2016-05-16 04:51:46 --> 404 Page Not Found: ../modules/auth/controllers/Auth/assets
ERROR - 2016-05-16 04:51:46 --> 404 Page Not Found: ../modules/auth/controllers/Auth/assets
ERROR - 2016-05-16 04:56:33 --> 404 Page Not Found: ../modules/auth/controllers/Auth/assets
ERROR - 2016-05-16 05:01:39 --> 404 Page Not Found: ../modules/auth/controllers/Auth/assets
ERROR - 2016-05-16 05:02:44 --> 404 Page Not Found: ../modules/auth/controllers/Auth/assets
ERROR - 2016-05-16 05:39:48 --> 404 Page Not Found: ../modules/auth/controllers/Auth/assets
ERROR - 2016-05-16 06:39:11 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ''Cash' THEN 'Credit Card' ELSE '' END AS payStatus, CASE WHEN (doctorAppointment' at line 1 - Invalid query: SELECT CASE WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 1 ) THEN `qyura_hospital`.`hospital_name` WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 2 ) THEN `qyura_diagnostic`.`diagnostic_name` ELSE concat(`doctors_fName`,' ',`doctors_lName`) END AS title,`qyura_doctorAppointment`.`doctorAppointment_unqId` AS `orderId`,`qyura_specialities`.`specialities_name` AS `speciality`,DATE_FORMAT(FROM_UNIXTIME(`qyura_doctorAppointment`.`doctorAppointment_date`),'%d %b, %Y') as date,DATE_FORMAT(`doctorAvailabilitySession_start`,'%h:%i%p') as startTime,DATE_FORMAT(`doctorAvailabilitySession_end`,'%h:%i%p') as endTime, CASE WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 1 ) THEN `qyura_hospital`.`hospital_address` WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 2 ) THEN `qyura_diagnostic`.`diagnostic_address` ELSE `qyura_doctors`.`doctor_addr` END AS `address`, CASE WHEN (docTimeTable_stayAt = 0) THEN psChamber_name ELSE  CASE WHEN (docTimeTable_MItype = 1) THEN hospital_name WHEN (docTimeTable_MItype = 2) THEN diagnostic_name ELSE '' END END AS name,CASE WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 1 ) THEN `qyura_hospital`.`hospital_name` WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 2 ) THEN `qyura_diagnostic`.`diagnostic_name` ELSE CONCAT(`qyura_doctors`.`doctors_fName`,' ',`qyura_doctors`.`doctors_lName`) END AS `miName`,qyura_doctorAppointment.doctorAppointment_ptRmk AS `remark`,CASE WHEN (qyura_doctorAppointment.doctorAppointment_memberId <> 0 ) THEN qyura_usersFamily.usersfamily_name ELSE qyura_patientDetails.patientDetails_patientName END AS `userName`, CASE WHEN (qyura_doctorAppointment.doctorAppointment_memberId <> 0 ) THEN qyura_usersFamily.usersfamily_gender ELSE qyura_patientDetails.patientDetails_gender END AS `userGender`,`qyura_users`.`users_mobile` AS `usersMobile`, CASE WHEN (`qyura_doctorAppointment`.`doctorAppointment_memberId` <> 0 ) THEN qyura_usersFamily.usersfamily_age ELSE (FROM_UNIXTIME('1463380751', '%Y') - FROM_UNIXTIME(qyura_patientDetails.patientDetails_dob, '%Y')) END AS `userAge`,CASE qyura_doctorAppointment.doctorAppointment_status WHEN '1' THEN 'Confirmed' WHEN '2' THEN 'Cancelled' WHEN '3' THEN 'Pending' WHEN '4' THEN 'Completed' ELSE '' END  AS `bookingStatus`,CASE WHEN (doctorAppointment_status = 4) THEN (CASE WHEN (`reviews_details` <> '') THEN `reviews_details` ELSE 'Not Given' END ) ELSE '' END  AS `reviews`,CASE WHEN (doctorAppointment_status = 4) THEN (CASE WHEN (`reviews_rating` <> 0) THEN `reviews_rating` ELSE '0' END ) ELSE '0' END  AS `rating`,  CASE WHEN (doctorAppointment_payStatus = 17 ) 'Cash' THEN 'Credit Card' ELSE '' END AS payStatus, CASE WHEN (doctorAppointment_payMode = 16 ) 'Paid' THEN 'Unpaid' ELSE '' END AS paymentMood, FROM `qyura_doctorAppointment`
            
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
                

                WHERE `qyura_doctorAppointment`.`doctorAppointment_pntUserId` = '48'
                AND `doctorAppointment_unqId` = 'APDOC48930'
                AND `qyura_doctorAppointment`.`doctorAppointment_deleted` = 0
                AND `qyura_doctorAppointment`.`doctorAppointment_date` <> 0
ERROR - 2016-05-16 07:13:01 --> 404 Page Not Found: ../modules/auth/controllers/Auth/assets
ERROR - 2016-05-16 09:22:15 --> 404 Page Not Found: ../modules/auth/controllers/Auth/assets
ERROR - 2016-05-16 12:58:00 --> 404 Page Not Found: ../modules/auth/controllers/Auth/assets
ERROR - 2016-05-16 13:02:31 --> 404 Page Not Found: ../modules/auth/controllers/Auth/assets
ERROR - 2016-05-16 16:19:45 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'IS NULL
ORDER BY `distance` ASC
 LIMIT 70' at line 9 - Invalid query: SELECT `qyura_pharmacy`.`pharmacy_id` as `id`, `pharmacy_name` `name`, `pharmacy_address` `adr`, `pharmacy_img` `imUrl`, `pharmacy_usersId` as `userId`, `pharmacy_lat` as `lat`, `pharmacy_long` as `lng`, (6371 * acos( cos( radians( 22.718410 ) ) * cos( radians( pharmacy_lat ) ) * cos( radians( pharmacy_long ) - radians( 75.855896 ) ) + sin( radians( 22.718410 ) ) * sin( radians( pharmacy_lat ) ) )
                ) AS distance, CONCAT("0", "", pharmacy_phn) as  phn, `qyura_pharmacy`.`pharmacy_27Src` `isEmergency`
FROM `qyura_pharmacy`
LEFT JOIN `qyura_usersRoles` ON `qyura_usersRoles`.`usersRoles_userId`=`qyura_pharmacy`.`pharmacy_usersId`
WHERE `qyura_pharmacy`.`pharmacy_deleted` =0
AND `qyura_pharmacy`.`pharmacy_cityId` = '705'
AND `qyura_pharmacy`.`pharmacy_id` NOT IN('0')
GROUP BY `pharmacy_id`
HAVING  IS NULL
ORDER BY `distance` ASC
 LIMIT 70
