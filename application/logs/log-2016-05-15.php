<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2016-05-15 05:43:28 --> 404 Page Not Found: ../modules/auth/controllers/Auth/assets
ERROR - 2016-05-15 05:43:28 --> 404 Page Not Found: ../modules/auth/controllers/Auth/assets
ERROR - 2016-05-15 06:44:11 --> 404 Page Not Found: ../modules/auth/controllers/Auth/assets
ERROR - 2016-05-15 07:06:44 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT `healthTips_detail`, `healthTips_image`, `healthTips_amount`, `category_name`, `city_name`, `sponsor_date`, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN (select hospital_name from qyura_hospital hos where hos.hospital_usersId=sponsor_userId)  
WHEN (Spon.sponser_userRole = 3 ) THEN (select diagnostic_name from qyura_diagnostic diag where diag.diagnostic_usersId=sponsor_userId) 
WHEN (Spon.sponser_userRole = 4 ) THEN (select concat(doctors_fName, ' ', doctors_lName) from qyura_doctors doc where doc.doctors_userId=sponsor_userId)  end as miname, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN 'Hospital'  
WHEN (Spon.sponser_userRole = 3 ) THEN 'Diagnostic Center' 
WHEN (Spon.sponser_userRole = 4 ) THEN 'Doctor'  end as mitype
FROM `qyura_healthTipSponsor` AS `Spon`
JOIN `qyura_healthTips` AS `HTip` ON `Spon`.`sponsor_tipId`=`HTip`.`healthTips_id`
JOIN `qyura_healthCategory` `Cat` ON `HTip`.`healthTips_categoryId` = `Cat`.`category_id`
JOIN `qyura_city` `Ct` ON `Ct`.`city_id` = `Spon`.`sponsor_cityId`
WHERE `Spon`.`sponsor_deleted` =0
ORDER BY `Spon`.`sponsor_date` DESC
ERROR - 2016-05-15 07:11:53 --> Unable to save the image. Please make sure the image and file directory are writable.
ERROR - 2016-05-15 07:11:53 --> The path to the image is not correct.
ERROR - 2016-05-15 07:11:53 --> Unable to save the image. Please make sure the image and file directory are writable.
ERROR - 2016-05-15 07:11:53 --> The path to the image is not correct.
ERROR - 2016-05-15 07:11:53 --> Unable to save the image. Please make sure the image and file directory are writable.
ERROR - 2016-05-15 07:11:53 --> The path to the image is not correct.
ERROR - 2016-05-15 07:11:53 --> Unable to save the image. Please make sure the image and file directory are writable.
ERROR - 2016-05-15 07:11:53 --> The path to the image is not correct.
ERROR - 2016-05-15 07:11:53 --> Unable to save the image. Please make sure the image and file directory are writable.
ERROR - 2016-05-15 07:18:24 --> Query error: Table 'vsure_qyura.qyura_hospitalTimeSlot' doesn't exist - Invalid query: SELECT *
FROM `qyura_hospitalTimeSlot`
WHERE `qyura_hospitalTimeSlot`.`hospitalTimeSlot_deleted` =0
AND `qyura_hospitalTimeSlot`.`hospitalTimeSlot_hospitalId` = '5'
ERROR - 2016-05-15 07:18:47 --> Query error: Table 'vsure_qyura.qyura_hospitalTimeSlot' doesn't exist - Invalid query: SELECT *
FROM `qyura_hospitalTimeSlot`
WHERE `qyura_hospitalTimeSlot`.`hospitalTimeSlot_deleted` =0
AND `qyura_hospitalTimeSlot`.`hospitalTimeSlot_hospitalId` = '5'
ERROR - 2016-05-15 07:26:17 --> 404 Page Not Found: ../modules/auth/controllers/Auth/assets
ERROR - 2016-05-15 08:10:37 --> 404 Page Not Found: ../modules/auth/controllers/Auth/assets
ERROR - 2016-05-15 09:37:35 --> Unable to save the image. Please make sure the image and file directory are writable.
ERROR - 2016-05-15 09:49:26 --> Invalid query: 
ERROR - 2016-05-15 09:50:07 --> Invalid query: 
ERROR - 2016-05-15 10:06:50 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ''Cash' THEN 'Credit Card' ELSE '' END AS payStatus, CASE WHEN (doctorAppointment' at line 1 - Invalid query: SELECT CASE WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 1 ) THEN `qyura_hospital`.`hospital_name` WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 2 ) THEN `qyura_diagnostic`.`diagnostic_name` ELSE concat(`doctors_fName`,' ',`doctors_lName`) END AS title,`qyura_doctorAppointment`.`doctorAppointment_unqId` AS `orderId`,`qyura_specialities`.`specialities_name` AS `speciality`,DATE_FORMAT(FROM_UNIXTIME(`qyura_doctorAppointment`.`doctorAppointment_date`),'%d %b, %Y') as date,DATE_FORMAT(`doctorAvailabilitySession_start`,'%h:%i%p') as startTime,DATE_FORMAT(`doctorAvailabilitySession_end`,'%h:%i%p') as endTime, CASE WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 1 ) THEN `qyura_hospital`.`hospital_address` WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 2 ) THEN `qyura_diagnostic`.`diagnostic_address` ELSE `qyura_doctors`.`doctor_addr` END AS `address`, CASE WHEN (docTimeTable_stayAt = 0) THEN psChamber_name ELSE  CASE WHEN (docTimeTable_MItype = 1) THEN hospital_name WHEN (docTimeTable_MItype = 2) THEN diagnostic_name ELSE '' END END AS name,CASE WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 1 ) THEN `qyura_hospital`.`hospital_name` WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 2 ) THEN `qyura_diagnostic`.`diagnostic_name` ELSE CONCAT(`qyura_doctors`.`doctors_fName`,' ',`qyura_doctors`.`doctors_lName`) END AS `miName`,qyura_doctorAppointment.doctorAppointment_ptRmk AS `remark`,CASE WHEN (qyura_doctorAppointment.doctorAppointment_memberId <> 0 ) THEN qyura_usersFamily.usersfamily_name ELSE qyura_patientDetails.patientDetails_patientName END AS `userName`, CASE WHEN (qyura_doctorAppointment.doctorAppointment_memberId <> 0 ) THEN qyura_usersFamily.usersfamily_gender ELSE qyura_patientDetails.patientDetails_gender END AS `userGender`,`qyura_users`.`users_mobile` AS `usersMobile`, CASE WHEN (`qyura_doctorAppointment`.`doctorAppointment_memberId` <> 0 ) THEN qyura_usersFamily.usersfamily_age ELSE (FROM_UNIXTIME('1463306810', '%Y') - FROM_UNIXTIME(qyura_patientDetails.patientDetails_dob, '%Y')) END AS `userAge`,CASE qyura_doctorAppointment.doctorAppointment_status WHEN '1' THEN 'Confirmed' WHEN '2' THEN 'Cancelled' WHEN '3' THEN 'Pending' WHEN '4' THEN 'Completed' ELSE '' END  AS `bookingStatus`,CASE WHEN (doctorAppointment_status = 4) THEN (CASE WHEN (`reviews_details` <> '') THEN `reviews_details` ELSE 'Not Given' END ) ELSE '' END  AS `reviews`,CASE WHEN (doctorAppointment_status = 4) THEN (CASE WHEN (`reviews_rating` <> 0) THEN `reviews_rating` ELSE '0' END ) ELSE '0' END  AS `rating`,  CASE WHEN (doctorAppointment_payStatus = 17 ) 'Cash' THEN 'Credit Card' ELSE '' END AS payStatus, CASE WHEN (doctorAppointment_payMode = 16 ) 'Paid' THEN 'Unpaid' ELSE '' END AS paymentMood, FROM `qyura_doctorAppointment`
            
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
                

                WHERE `qyura_doctorAppointment`.`doctorAppointment_pntUserId` = '100'
                AND `doctorAppointment_unqId` = 'APDOC100155'
                AND `qyura_doctorAppointment`.`doctorAppointment_deleted` = 0
                AND `qyura_doctorAppointment`.`doctorAppointment_date` <> 0
ERROR - 2016-05-15 10:20:12 --> Unable to save the image. Please make sure the image and file directory are writable.
ERROR - 2016-05-15 10:28:15 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ''Cash' THEN 'Credit Card' ELSE '' END AS payStatus, CASE WHEN (doctorAppointment' at line 1 - Invalid query: SELECT CASE WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 1 ) THEN `qyura_hospital`.`hospital_name` WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 2 ) THEN `qyura_diagnostic`.`diagnostic_name` ELSE concat(`doctors_fName`,' ',`doctors_lName`) END AS title,`qyura_doctorAppointment`.`doctorAppointment_unqId` AS `orderId`,`qyura_specialities`.`specialities_name` AS `speciality`,DATE_FORMAT(FROM_UNIXTIME(`qyura_doctorAppointment`.`doctorAppointment_date`),'%d %b, %Y') as date,DATE_FORMAT(`doctorAvailabilitySession_start`,'%h:%i%p') as startTime,DATE_FORMAT(`doctorAvailabilitySession_end`,'%h:%i%p') as endTime, CASE WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 1 ) THEN `qyura_hospital`.`hospital_address` WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 2 ) THEN `qyura_diagnostic`.`diagnostic_address` ELSE `qyura_doctors`.`doctor_addr` END AS `address`, CASE WHEN (docTimeTable_stayAt = 0) THEN psChamber_name ELSE  CASE WHEN (docTimeTable_MItype = 1) THEN hospital_name WHEN (docTimeTable_MItype = 2) THEN diagnostic_name ELSE '' END END AS name,CASE WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 1 ) THEN `qyura_hospital`.`hospital_name` WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 2 ) THEN `qyura_diagnostic`.`diagnostic_name` ELSE CONCAT(`qyura_doctors`.`doctors_fName`,' ',`qyura_doctors`.`doctors_lName`) END AS `miName`,qyura_doctorAppointment.doctorAppointment_ptRmk AS `remark`,CASE WHEN (qyura_doctorAppointment.doctorAppointment_memberId <> 0 ) THEN qyura_usersFamily.usersfamily_name ELSE qyura_patientDetails.patientDetails_patientName END AS `userName`, CASE WHEN (qyura_doctorAppointment.doctorAppointment_memberId <> 0 ) THEN qyura_usersFamily.usersfamily_gender ELSE qyura_patientDetails.patientDetails_gender END AS `userGender`,`qyura_users`.`users_mobile` AS `usersMobile`, CASE WHEN (`qyura_doctorAppointment`.`doctorAppointment_memberId` <> 0 ) THEN qyura_usersFamily.usersfamily_age ELSE (FROM_UNIXTIME('1463308095', '%Y') - FROM_UNIXTIME(qyura_patientDetails.patientDetails_dob, '%Y')) END AS `userAge`,CASE qyura_doctorAppointment.doctorAppointment_status WHEN '1' THEN 'Confirmed' WHEN '2' THEN 'Cancelled' WHEN '3' THEN 'Pending' WHEN '4' THEN 'Completed' ELSE '' END  AS `bookingStatus`,CASE WHEN (doctorAppointment_status = 4) THEN (CASE WHEN (`reviews_details` <> '') THEN `reviews_details` ELSE 'Not Given' END ) ELSE '' END  AS `reviews`,CASE WHEN (doctorAppointment_status = 4) THEN (CASE WHEN (`reviews_rating` <> 0) THEN `reviews_rating` ELSE '0' END ) ELSE '0' END  AS `rating`,  CASE WHEN (doctorAppointment_payStatus = 17 ) 'Cash' THEN 'Credit Card' ELSE '' END AS payStatus, CASE WHEN (doctorAppointment_payMode = 16 ) 'Paid' THEN 'Unpaid' ELSE '' END AS paymentMood, FROM `qyura_doctorAppointment`
            
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
                

                WHERE `qyura_doctorAppointment`.`doctorAppointment_pntUserId` = '14'
                AND `doctorAppointment_unqId` = 'doc1448'
                AND `qyura_doctorAppointment`.`doctorAppointment_deleted` = 0
                AND `qyura_doctorAppointment`.`doctorAppointment_date` <> 0
ERROR - 2016-05-15 11:03:24 --> Invalid query: 
ERROR - 2016-05-15 11:03:29 --> Invalid query: 
ERROR - 2016-05-15 11:03:40 --> Invalid query: 
ERROR - 2016-05-15 11:03:43 --> Invalid query: 
ERROR - 2016-05-15 11:19:30 --> Unable to save the image. Please make sure the image and file directory are writable.
ERROR - 2016-05-15 11:19:30 --> The path to the image is not correct.
ERROR - 2016-05-15 11:19:30 --> Unable to save the image. Please make sure the image and file directory are writable.
ERROR - 2016-05-15 11:19:30 --> The path to the image is not correct.
ERROR - 2016-05-15 11:19:30 --> Unable to save the image. Please make sure the image and file directory are writable.
ERROR - 2016-05-15 11:19:30 --> The path to the image is not correct.
ERROR - 2016-05-15 11:19:30 --> Unable to save the image. Please make sure the image and file directory are writable.
ERROR - 2016-05-15 11:19:30 --> The path to the image is not correct.
ERROR - 2016-05-15 11:19:30 --> Unable to save the image. Please make sure the image and file directory are writable.
ERROR - 2016-05-15 11:24:27 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ''Cash' THEN 'Credit Card' ELSE '' END AS payStatus, CASE WHEN (doctorAppointment' at line 1 - Invalid query: SELECT CASE WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 1 ) THEN `qyura_hospital`.`hospital_name` WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 2 ) THEN `qyura_diagnostic`.`diagnostic_name` ELSE concat(`doctors_fName`,' ',`doctors_lName`) END AS title,`qyura_doctorAppointment`.`doctorAppointment_unqId` AS `orderId`,`qyura_specialities`.`specialities_name` AS `speciality`,DATE_FORMAT(FROM_UNIXTIME(`qyura_doctorAppointment`.`doctorAppointment_date`),'%d %b, %Y') as date,DATE_FORMAT(`doctorAvailabilitySession_start`,'%h:%i%p') as startTime,DATE_FORMAT(`doctorAvailabilitySession_end`,'%h:%i%p') as endTime, CASE WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 1 ) THEN `qyura_hospital`.`hospital_address` WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 2 ) THEN `qyura_diagnostic`.`diagnostic_address` ELSE `qyura_doctors`.`doctor_addr` END AS `address`, CASE WHEN (docTimeTable_stayAt = 0) THEN psChamber_name ELSE  CASE WHEN (docTimeTable_MItype = 1) THEN hospital_name WHEN (docTimeTable_MItype = 2) THEN diagnostic_name ELSE '' END END AS name,CASE WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 1 ) THEN `qyura_hospital`.`hospital_name` WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 2 ) THEN `qyura_diagnostic`.`diagnostic_name` ELSE CONCAT(`qyura_doctors`.`doctors_fName`,' ',`qyura_doctors`.`doctors_lName`) END AS `miName`,qyura_doctorAppointment.doctorAppointment_ptRmk AS `remark`,CASE WHEN (qyura_doctorAppointment.doctorAppointment_memberId <> 0 ) THEN qyura_usersFamily.usersfamily_name ELSE qyura_patientDetails.patientDetails_patientName END AS `userName`, CASE WHEN (qyura_doctorAppointment.doctorAppointment_memberId <> 0 ) THEN qyura_usersFamily.usersfamily_gender ELSE qyura_patientDetails.patientDetails_gender END AS `userGender`,`qyura_users`.`users_mobile` AS `usersMobile`, CASE WHEN (`qyura_doctorAppointment`.`doctorAppointment_memberId` <> 0 ) THEN qyura_usersFamily.usersfamily_age ELSE (FROM_UNIXTIME('1463311467', '%Y') - FROM_UNIXTIME(qyura_patientDetails.patientDetails_dob, '%Y')) END AS `userAge`,CASE qyura_doctorAppointment.doctorAppointment_status WHEN '1' THEN 'Confirmed' WHEN '2' THEN 'Cancelled' WHEN '3' THEN 'Pending' WHEN '4' THEN 'Completed' ELSE '' END  AS `bookingStatus`,CASE WHEN (doctorAppointment_status = 4) THEN (CASE WHEN (`reviews_details` <> '') THEN `reviews_details` ELSE 'Not Given' END ) ELSE '' END  AS `reviews`,CASE WHEN (doctorAppointment_status = 4) THEN (CASE WHEN (`reviews_rating` <> 0) THEN `reviews_rating` ELSE '0' END ) ELSE '0' END  AS `rating`,  CASE WHEN (doctorAppointment_payStatus = 17 ) 'Cash' THEN 'Credit Card' ELSE '' END AS payStatus, CASE WHEN (doctorAppointment_payMode = 16 ) 'Paid' THEN 'Unpaid' ELSE '' END AS paymentMood, FROM `qyura_doctorAppointment`
            
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
                

                WHERE `qyura_doctorAppointment`.`doctorAppointment_pntUserId` = '14'
                AND `doctorAppointment_unqId` = 'APDOC1419'
                AND `qyura_doctorAppointment`.`doctorAppointment_deleted` = 0
                AND `qyura_doctorAppointment`.`doctorAppointment_date` <> 0
ERROR - 2016-05-15 11:25:03 --> 404 Page Not Found: ../modules/auth/controllers/Auth/assets
ERROR - 2016-05-15 11:28:39 --> 404 Page Not Found: ../modules/auth/controllers/Auth/assets
ERROR - 2016-05-15 11:29:11 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT `healthTips_detail`, `healthTips_image`, `healthTips_amount`, `category_name`, `city_name`, `sponsor_date`, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN (select hospital_name from qyura_hospital hos where hos.hospital_usersId=sponsor_userId)  
WHEN (Spon.sponser_userRole = 3 ) THEN (select diagnostic_name from qyura_diagnostic diag where diag.diagnostic_usersId=sponsor_userId) 
WHEN (Spon.sponser_userRole = 4 ) THEN (select concat(doctors_fName, ' ', doctors_lName) from qyura_doctors doc where doc.doctors_userId=sponsor_userId)  end as miname, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN 'Hospital'  
WHEN (Spon.sponser_userRole = 3 ) THEN 'Diagnostic Center' 
WHEN (Spon.sponser_userRole = 4 ) THEN 'Doctor'  end as mitype
FROM `qyura_healthTipSponsor` AS `Spon`
JOIN `qyura_healthTips` AS `HTip` ON `Spon`.`sponsor_tipId`=`HTip`.`healthTips_id`
JOIN `qyura_healthCategory` `Cat` ON `HTip`.`healthTips_categoryId` = `Cat`.`category_id`
JOIN `qyura_city` `Ct` ON `Ct`.`city_id` = `Spon`.`sponsor_cityId`
WHERE `Spon`.`sponsor_deleted` =0
ORDER BY `Spon`.`sponsor_date` DESC
ERROR - 2016-05-15 11:29:16 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT `healthTips_detail`, `healthTips_image`, `healthTips_amount`, `category_name`, `city_name`, `sponsor_date`, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN (select hospital_name from qyura_hospital hos where hos.hospital_usersId=sponsor_userId)  
WHEN (Spon.sponser_userRole = 3 ) THEN (select diagnostic_name from qyura_diagnostic diag where diag.diagnostic_usersId=sponsor_userId) 
WHEN (Spon.sponser_userRole = 4 ) THEN (select concat(doctors_fName, ' ', doctors_lName) from qyura_doctors doc where doc.doctors_userId=sponsor_userId)  end as miname, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN 'Hospital'  
WHEN (Spon.sponser_userRole = 3 ) THEN 'Diagnostic Center' 
WHEN (Spon.sponser_userRole = 4 ) THEN 'Doctor'  end as mitype
FROM `qyura_healthTipSponsor` AS `Spon`
JOIN `qyura_healthTips` AS `HTip` ON `Spon`.`sponsor_tipId`=`HTip`.`healthTips_id`
JOIN `qyura_healthCategory` `Cat` ON `HTip`.`healthTips_categoryId` = `Cat`.`category_id`
JOIN `qyura_city` `Ct` ON `Ct`.`city_id` = `Spon`.`sponsor_cityId`
WHERE `Spon`.`sponsor_deleted` =0
ORDER BY `Spon`.`sponsor_date` DESC
ERROR - 2016-05-15 11:37:17 --> 404 Page Not Found: /index
ERROR - 2016-05-15 11:56:31 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'IS NULL
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
ERROR - 2016-05-15 12:00:26 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT `healthTips_detail`, `healthTips_image`, `healthTips_amount`, `category_name`, `city_name`, `sponsor_date`, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN (select hospital_name from qyura_hospital hos where hos.hospital_usersId=sponsor_userId)  
WHEN (Spon.sponser_userRole = 3 ) THEN (select diagnostic_name from qyura_diagnostic diag where diag.diagnostic_usersId=sponsor_userId) 
WHEN (Spon.sponser_userRole = 4 ) THEN (select concat(doctors_fName, ' ', doctors_lName) from qyura_doctors doc where doc.doctors_userId=sponsor_userId)  end as miname, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN 'Hospital'  
WHEN (Spon.sponser_userRole = 3 ) THEN 'Diagnostic Center' 
WHEN (Spon.sponser_userRole = 4 ) THEN 'Doctor'  end as mitype
FROM `qyura_healthTipSponsor` AS `Spon`
JOIN `qyura_healthTips` AS `HTip` ON `Spon`.`sponsor_tipId`=`HTip`.`healthTips_id`
JOIN `qyura_healthCategory` `Cat` ON `HTip`.`healthTips_categoryId` = `Cat`.`category_id`
JOIN `qyura_city` `Ct` ON `Ct`.`city_id` = `Spon`.`sponsor_cityId`
WHERE `Spon`.`sponsor_deleted` =0
ORDER BY `Spon`.`sponsor_date` DESC
ERROR - 2016-05-15 12:10:23 --> 404 Page Not Found: ../modules/auth/controllers/Auth/assets
ERROR - 2016-05-15 12:10:38 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT `healthTips_detail`, `healthTips_image`, `healthTips_amount`, `category_name`, `city_name`, `sponsor_date`, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN (select hospital_name from qyura_hospital hos where hos.hospital_usersId=sponsor_userId group by hos.hospital_id)  
WHEN (Spon.sponser_userRole = 3 ) THEN (select diagnostic_name from qyura_diagnostic diag where diag.diagnostic_usersId=sponsor_userId group by diag.diagnostic_id) 
WHEN (Spon.sponser_userRole = 4 ) THEN (select concat(doctors_fName, ' ', doctors_lName) from qyura_doctors doc where doc.doctors_userId=sponsor_userId group by doc.doctors_id)  end as miname, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN 'Hospital'  
WHEN (Spon.sponser_userRole = 3 ) THEN 'Diagnostic Center' 
WHEN (Spon.sponser_userRole = 4 ) THEN 'Doctor'  end as mitype
FROM `qyura_healthTipSponsor` AS `Spon`
JOIN `qyura_healthTips` AS `HTip` ON `Spon`.`sponsor_tipId`=`HTip`.`healthTips_id`
JOIN `qyura_healthCategory` `Cat` ON `HTip`.`healthTips_categoryId` = `Cat`.`category_id`
JOIN `qyura_city` `Ct` ON `Ct`.`city_id` = `Spon`.`sponsor_cityId`
WHERE `Spon`.`sponsor_deleted` =0
ORDER BY `Spon`.`sponsor_date` DESC
ERROR - 2016-05-15 12:11:40 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT `healthTips_detail`, `healthTips_image`, `healthTips_amount`, `category_name`, `city_name`, `sponsor_date`, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN (select hospital_name from qyura_hospital hos where hos.hospital_usersId=sponsor_userId group by hos.hospital_id)  
WHEN (Spon.sponser_userRole = 3 ) THEN (select diagnostic_name from qyura_diagnostic diag where diag.diagnostic_usersId=sponsor_userId group by diag.diagnostic_id) 
WHEN (Spon.sponser_userRole = 4 ) THEN (select concat(doctors_fName, ' ', doctors_lName) from qyura_doctors doc where doc.doctors_userId=sponsor_userId group by doc.doctors_id)  end as miname, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN 'Hospital'  
WHEN (Spon.sponser_userRole = 3 ) THEN 'Diagnostic Center' 
WHEN (Spon.sponser_userRole = 4 ) THEN 'Doctor'  end as mitype
FROM `qyura_healthTipSponsor` AS `Spon`
JOIN `qyura_healthTips` AS `HTip` ON `Spon`.`sponsor_tipId`=`HTip`.`healthTips_id`
JOIN `qyura_healthCategory` `Cat` ON `HTip`.`healthTips_categoryId` = `Cat`.`category_id`
JOIN `qyura_city` `Ct` ON `Ct`.`city_id` = `Spon`.`sponsor_cityId`
WHERE `Spon`.`sponsor_deleted` =0
ORDER BY `Spon`.`sponsor_date` DESC
ERROR - 2016-05-15 12:11:47 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT `healthTips_detail`, `healthTips_image`, `healthTips_amount`, `category_name`, `city_name`, `sponsor_date`, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN (select hospital_name from qyura_hospital hos where hos.hospital_usersId=sponsor_userId group by hos.hospital_id)  
WHEN (Spon.sponser_userRole = 3 ) THEN (select diagnostic_name from qyura_diagnostic diag where diag.diagnostic_usersId=sponsor_userId group by diag.diagnostic_id) 
WHEN (Spon.sponser_userRole = 4 ) THEN (select concat(doctors_fName, ' ', doctors_lName) from qyura_doctors doc where doc.doctors_userId=sponsor_userId group by doc.doctors_id)  end as miname, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN 'Hospital'  
WHEN (Spon.sponser_userRole = 3 ) THEN 'Diagnostic Center' 
WHEN (Spon.sponser_userRole = 4 ) THEN 'Doctor'  end as mitype
FROM `qyura_healthTipSponsor` AS `Spon`
JOIN `qyura_healthTips` AS `HTip` ON `Spon`.`sponsor_tipId`=`HTip`.`healthTips_id`
JOIN `qyura_healthCategory` `Cat` ON `HTip`.`healthTips_categoryId` = `Cat`.`category_id`
JOIN `qyura_city` `Ct` ON `Ct`.`city_id` = `Spon`.`sponsor_cityId`
WHERE `Spon`.`sponsor_deleted` =0
ORDER BY `Spon`.`sponsor_date` DESC
ERROR - 2016-05-15 12:11:51 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT `healthTips_detail`, `healthTips_image`, `healthTips_amount`, `category_name`, `city_name`, `sponsor_date`, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN (select hospital_name from qyura_hospital hos where hos.hospital_usersId=sponsor_userId group by hos.hospital_id)  
WHEN (Spon.sponser_userRole = 3 ) THEN (select diagnostic_name from qyura_diagnostic diag where diag.diagnostic_usersId=sponsor_userId group by diag.diagnostic_id) 
WHEN (Spon.sponser_userRole = 4 ) THEN (select concat(doctors_fName, ' ', doctors_lName) from qyura_doctors doc where doc.doctors_userId=sponsor_userId group by doc.doctors_id)  end as miname, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN 'Hospital'  
WHEN (Spon.sponser_userRole = 3 ) THEN 'Diagnostic Center' 
WHEN (Spon.sponser_userRole = 4 ) THEN 'Doctor'  end as mitype
FROM `qyura_healthTipSponsor` AS `Spon`
JOIN `qyura_healthTips` AS `HTip` ON `Spon`.`sponsor_tipId`=`HTip`.`healthTips_id`
JOIN `qyura_healthCategory` `Cat` ON `HTip`.`healthTips_categoryId` = `Cat`.`category_id`
JOIN `qyura_city` `Ct` ON `Ct`.`city_id` = `Spon`.`sponsor_cityId`
WHERE `Spon`.`sponsor_deleted` =0
ORDER BY `Spon`.`sponsor_date` DESC
ERROR - 2016-05-15 12:11:51 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT `healthTips_detail`, `healthTips_image`, `healthTips_amount`, `category_name`, `city_name`, `sponsor_date`, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN (select hospital_name from qyura_hospital hos where hos.hospital_usersId=sponsor_userId group by hos.hospital_id)  
WHEN (Spon.sponser_userRole = 3 ) THEN (select diagnostic_name from qyura_diagnostic diag where diag.diagnostic_usersId=sponsor_userId group by diag.diagnostic_id) 
WHEN (Spon.sponser_userRole = 4 ) THEN (select concat(doctors_fName, ' ', doctors_lName) from qyura_doctors doc where doc.doctors_userId=sponsor_userId group by doc.doctors_id)  end as miname, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN 'Hospital'  
WHEN (Spon.sponser_userRole = 3 ) THEN 'Diagnostic Center' 
WHEN (Spon.sponser_userRole = 4 ) THEN 'Doctor'  end as mitype
FROM `qyura_healthTipSponsor` AS `Spon`
JOIN `qyura_healthTips` AS `HTip` ON `Spon`.`sponsor_tipId`=`HTip`.`healthTips_id`
JOIN `qyura_healthCategory` `Cat` ON `HTip`.`healthTips_categoryId` = `Cat`.`category_id`
JOIN `qyura_city` `Ct` ON `Ct`.`city_id` = `Spon`.`sponsor_cityId`
WHERE `Spon`.`sponsor_deleted` =0
ORDER BY `Spon`.`sponsor_date` DESC
ERROR - 2016-05-15 12:11:51 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT `healthTips_detail`, `healthTips_image`, `healthTips_amount`, `category_name`, `city_name`, `sponsor_date`, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN (select hospital_name from qyura_hospital hos where hos.hospital_usersId=sponsor_userId group by hos.hospital_id)  
WHEN (Spon.sponser_userRole = 3 ) THEN (select diagnostic_name from qyura_diagnostic diag where diag.diagnostic_usersId=sponsor_userId group by diag.diagnostic_id) 
WHEN (Spon.sponser_userRole = 4 ) THEN (select concat(doctors_fName, ' ', doctors_lName) from qyura_doctors doc where doc.doctors_userId=sponsor_userId group by doc.doctors_id)  end as miname, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN 'Hospital'  
WHEN (Spon.sponser_userRole = 3 ) THEN 'Diagnostic Center' 
WHEN (Spon.sponser_userRole = 4 ) THEN 'Doctor'  end as mitype
FROM `qyura_healthTipSponsor` AS `Spon`
JOIN `qyura_healthTips` AS `HTip` ON `Spon`.`sponsor_tipId`=`HTip`.`healthTips_id`
JOIN `qyura_healthCategory` `Cat` ON `HTip`.`healthTips_categoryId` = `Cat`.`category_id`
JOIN `qyura_city` `Ct` ON `Ct`.`city_id` = `Spon`.`sponsor_cityId`
WHERE `Spon`.`sponsor_deleted` =0
ORDER BY `Spon`.`sponsor_date` DESC
ERROR - 2016-05-15 12:11:52 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT `healthTips_detail`, `healthTips_image`, `healthTips_amount`, `category_name`, `city_name`, `sponsor_date`, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN (select hospital_name from qyura_hospital hos where hos.hospital_usersId=sponsor_userId group by hos.hospital_id)  
WHEN (Spon.sponser_userRole = 3 ) THEN (select diagnostic_name from qyura_diagnostic diag where diag.diagnostic_usersId=sponsor_userId group by diag.diagnostic_id) 
WHEN (Spon.sponser_userRole = 4 ) THEN (select concat(doctors_fName, ' ', doctors_lName) from qyura_doctors doc where doc.doctors_userId=sponsor_userId group by doc.doctors_id)  end as miname, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN 'Hospital'  
WHEN (Spon.sponser_userRole = 3 ) THEN 'Diagnostic Center' 
WHEN (Spon.sponser_userRole = 4 ) THEN 'Doctor'  end as mitype
FROM `qyura_healthTipSponsor` AS `Spon`
JOIN `qyura_healthTips` AS `HTip` ON `Spon`.`sponsor_tipId`=`HTip`.`healthTips_id`
JOIN `qyura_healthCategory` `Cat` ON `HTip`.`healthTips_categoryId` = `Cat`.`category_id`
JOIN `qyura_city` `Ct` ON `Ct`.`city_id` = `Spon`.`sponsor_cityId`
WHERE `Spon`.`sponsor_deleted` =0
ORDER BY `Spon`.`sponsor_date` DESC
ERROR - 2016-05-15 12:11:52 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT `healthTips_detail`, `healthTips_image`, `healthTips_amount`, `category_name`, `city_name`, `sponsor_date`, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN (select hospital_name from qyura_hospital hos where hos.hospital_usersId=sponsor_userId group by hos.hospital_id)  
WHEN (Spon.sponser_userRole = 3 ) THEN (select diagnostic_name from qyura_diagnostic diag where diag.diagnostic_usersId=sponsor_userId group by diag.diagnostic_id) 
WHEN (Spon.sponser_userRole = 4 ) THEN (select concat(doctors_fName, ' ', doctors_lName) from qyura_doctors doc where doc.doctors_userId=sponsor_userId group by doc.doctors_id)  end as miname, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN 'Hospital'  
WHEN (Spon.sponser_userRole = 3 ) THEN 'Diagnostic Center' 
WHEN (Spon.sponser_userRole = 4 ) THEN 'Doctor'  end as mitype
FROM `qyura_healthTipSponsor` AS `Spon`
JOIN `qyura_healthTips` AS `HTip` ON `Spon`.`sponsor_tipId`=`HTip`.`healthTips_id`
JOIN `qyura_healthCategory` `Cat` ON `HTip`.`healthTips_categoryId` = `Cat`.`category_id`
JOIN `qyura_city` `Ct` ON `Ct`.`city_id` = `Spon`.`sponsor_cityId`
WHERE `Spon`.`sponsor_deleted` =0
ORDER BY `Spon`.`sponsor_date` DESC
ERROR - 2016-05-15 12:11:52 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT `healthTips_detail`, `healthTips_image`, `healthTips_amount`, `category_name`, `city_name`, `sponsor_date`, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN (select hospital_name from qyura_hospital hos where hos.hospital_usersId=sponsor_userId group by hos.hospital_id)  
WHEN (Spon.sponser_userRole = 3 ) THEN (select diagnostic_name from qyura_diagnostic diag where diag.diagnostic_usersId=sponsor_userId group by diag.diagnostic_id) 
WHEN (Spon.sponser_userRole = 4 ) THEN (select concat(doctors_fName, ' ', doctors_lName) from qyura_doctors doc where doc.doctors_userId=sponsor_userId group by doc.doctors_id)  end as miname, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN 'Hospital'  
WHEN (Spon.sponser_userRole = 3 ) THEN 'Diagnostic Center' 
WHEN (Spon.sponser_userRole = 4 ) THEN 'Doctor'  end as mitype
FROM `qyura_healthTipSponsor` AS `Spon`
JOIN `qyura_healthTips` AS `HTip` ON `Spon`.`sponsor_tipId`=`HTip`.`healthTips_id`
JOIN `qyura_healthCategory` `Cat` ON `HTip`.`healthTips_categoryId` = `Cat`.`category_id`
JOIN `qyura_city` `Ct` ON `Ct`.`city_id` = `Spon`.`sponsor_cityId`
WHERE `Spon`.`sponsor_deleted` =0
ORDER BY `Spon`.`sponsor_date` DESC
ERROR - 2016-05-15 12:11:52 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT `healthTips_detail`, `healthTips_image`, `healthTips_amount`, `category_name`, `city_name`, `sponsor_date`, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN (select hospital_name from qyura_hospital hos where hos.hospital_usersId=sponsor_userId group by hos.hospital_id)  
WHEN (Spon.sponser_userRole = 3 ) THEN (select diagnostic_name from qyura_diagnostic diag where diag.diagnostic_usersId=sponsor_userId group by diag.diagnostic_id) 
WHEN (Spon.sponser_userRole = 4 ) THEN (select concat(doctors_fName, ' ', doctors_lName) from qyura_doctors doc where doc.doctors_userId=sponsor_userId group by doc.doctors_id)  end as miname, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN 'Hospital'  
WHEN (Spon.sponser_userRole = 3 ) THEN 'Diagnostic Center' 
WHEN (Spon.sponser_userRole = 4 ) THEN 'Doctor'  end as mitype
FROM `qyura_healthTipSponsor` AS `Spon`
JOIN `qyura_healthTips` AS `HTip` ON `Spon`.`sponsor_tipId`=`HTip`.`healthTips_id`
JOIN `qyura_healthCategory` `Cat` ON `HTip`.`healthTips_categoryId` = `Cat`.`category_id`
JOIN `qyura_city` `Ct` ON `Ct`.`city_id` = `Spon`.`sponsor_cityId`
WHERE `Spon`.`sponsor_deleted` =0
ORDER BY `Spon`.`sponsor_date` DESC
ERROR - 2016-05-15 12:11:52 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT `healthTips_detail`, `healthTips_image`, `healthTips_amount`, `category_name`, `city_name`, `sponsor_date`, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN (select hospital_name from qyura_hospital hos where hos.hospital_usersId=sponsor_userId group by hos.hospital_id)  
WHEN (Spon.sponser_userRole = 3 ) THEN (select diagnostic_name from qyura_diagnostic diag where diag.diagnostic_usersId=sponsor_userId group by diag.diagnostic_id) 
WHEN (Spon.sponser_userRole = 4 ) THEN (select concat(doctors_fName, ' ', doctors_lName) from qyura_doctors doc where doc.doctors_userId=sponsor_userId group by doc.doctors_id)  end as miname, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN 'Hospital'  
WHEN (Spon.sponser_userRole = 3 ) THEN 'Diagnostic Center' 
WHEN (Spon.sponser_userRole = 4 ) THEN 'Doctor'  end as mitype
FROM `qyura_healthTipSponsor` AS `Spon`
JOIN `qyura_healthTips` AS `HTip` ON `Spon`.`sponsor_tipId`=`HTip`.`healthTips_id`
JOIN `qyura_healthCategory` `Cat` ON `HTip`.`healthTips_categoryId` = `Cat`.`category_id`
JOIN `qyura_city` `Ct` ON `Ct`.`city_id` = `Spon`.`sponsor_cityId`
WHERE `Spon`.`sponsor_deleted` =0
ORDER BY `Spon`.`sponsor_date` DESC
ERROR - 2016-05-15 12:11:52 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT `healthTips_detail`, `healthTips_image`, `healthTips_amount`, `category_name`, `city_name`, `sponsor_date`, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN (select hospital_name from qyura_hospital hos where hos.hospital_usersId=sponsor_userId group by hos.hospital_id)  
WHEN (Spon.sponser_userRole = 3 ) THEN (select diagnostic_name from qyura_diagnostic diag where diag.diagnostic_usersId=sponsor_userId group by diag.diagnostic_id) 
WHEN (Spon.sponser_userRole = 4 ) THEN (select concat(doctors_fName, ' ', doctors_lName) from qyura_doctors doc where doc.doctors_userId=sponsor_userId group by doc.doctors_id)  end as miname, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN 'Hospital'  
WHEN (Spon.sponser_userRole = 3 ) THEN 'Diagnostic Center' 
WHEN (Spon.sponser_userRole = 4 ) THEN 'Doctor'  end as mitype
FROM `qyura_healthTipSponsor` AS `Spon`
JOIN `qyura_healthTips` AS `HTip` ON `Spon`.`sponsor_tipId`=`HTip`.`healthTips_id`
JOIN `qyura_healthCategory` `Cat` ON `HTip`.`healthTips_categoryId` = `Cat`.`category_id`
JOIN `qyura_city` `Ct` ON `Ct`.`city_id` = `Spon`.`sponsor_cityId`
WHERE `Spon`.`sponsor_deleted` =0
ORDER BY `Spon`.`sponsor_date` DESC
ERROR - 2016-05-15 12:11:52 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT `healthTips_detail`, `healthTips_image`, `healthTips_amount`, `category_name`, `city_name`, `sponsor_date`, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN (select hospital_name from qyura_hospital hos where hos.hospital_usersId=sponsor_userId group by hos.hospital_id)  
WHEN (Spon.sponser_userRole = 3 ) THEN (select diagnostic_name from qyura_diagnostic diag where diag.diagnostic_usersId=sponsor_userId group by diag.diagnostic_id) 
WHEN (Spon.sponser_userRole = 4 ) THEN (select concat(doctors_fName, ' ', doctors_lName) from qyura_doctors doc where doc.doctors_userId=sponsor_userId group by doc.doctors_id)  end as miname, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN 'Hospital'  
WHEN (Spon.sponser_userRole = 3 ) THEN 'Diagnostic Center' 
WHEN (Spon.sponser_userRole = 4 ) THEN 'Doctor'  end as mitype
FROM `qyura_healthTipSponsor` AS `Spon`
JOIN `qyura_healthTips` AS `HTip` ON `Spon`.`sponsor_tipId`=`HTip`.`healthTips_id`
JOIN `qyura_healthCategory` `Cat` ON `HTip`.`healthTips_categoryId` = `Cat`.`category_id`
JOIN `qyura_city` `Ct` ON `Ct`.`city_id` = `Spon`.`sponsor_cityId`
WHERE `Spon`.`sponsor_deleted` =0
ORDER BY `Spon`.`sponsor_date` DESC
ERROR - 2016-05-15 12:11:52 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT `healthTips_detail`, `healthTips_image`, `healthTips_amount`, `category_name`, `city_name`, `sponsor_date`, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN (select hospital_name from qyura_hospital hos where hos.hospital_usersId=sponsor_userId group by hos.hospital_id)  
WHEN (Spon.sponser_userRole = 3 ) THEN (select diagnostic_name from qyura_diagnostic diag where diag.diagnostic_usersId=sponsor_userId group by diag.diagnostic_id) 
WHEN (Spon.sponser_userRole = 4 ) THEN (select concat(doctors_fName, ' ', doctors_lName) from qyura_doctors doc where doc.doctors_userId=sponsor_userId group by doc.doctors_id)  end as miname, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN 'Hospital'  
WHEN (Spon.sponser_userRole = 3 ) THEN 'Diagnostic Center' 
WHEN (Spon.sponser_userRole = 4 ) THEN 'Doctor'  end as mitype
FROM `qyura_healthTipSponsor` AS `Spon`
JOIN `qyura_healthTips` AS `HTip` ON `Spon`.`sponsor_tipId`=`HTip`.`healthTips_id`
JOIN `qyura_healthCategory` `Cat` ON `HTip`.`healthTips_categoryId` = `Cat`.`category_id`
JOIN `qyura_city` `Ct` ON `Ct`.`city_id` = `Spon`.`sponsor_cityId`
WHERE `Spon`.`sponsor_deleted` =0
ORDER BY `Spon`.`sponsor_date` DESC
ERROR - 2016-05-15 12:11:52 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT `healthTips_detail`, `healthTips_image`, `healthTips_amount`, `category_name`, `city_name`, `sponsor_date`, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN (select hospital_name from qyura_hospital hos where hos.hospital_usersId=sponsor_userId group by hos.hospital_id)  
WHEN (Spon.sponser_userRole = 3 ) THEN (select diagnostic_name from qyura_diagnostic diag where diag.diagnostic_usersId=sponsor_userId group by diag.diagnostic_id) 
WHEN (Spon.sponser_userRole = 4 ) THEN (select concat(doctors_fName, ' ', doctors_lName) from qyura_doctors doc where doc.doctors_userId=sponsor_userId group by doc.doctors_id)  end as miname, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN 'Hospital'  
WHEN (Spon.sponser_userRole = 3 ) THEN 'Diagnostic Center' 
WHEN (Spon.sponser_userRole = 4 ) THEN 'Doctor'  end as mitype
FROM `qyura_healthTipSponsor` AS `Spon`
JOIN `qyura_healthTips` AS `HTip` ON `Spon`.`sponsor_tipId`=`HTip`.`healthTips_id`
JOIN `qyura_healthCategory` `Cat` ON `HTip`.`healthTips_categoryId` = `Cat`.`category_id`
JOIN `qyura_city` `Ct` ON `Ct`.`city_id` = `Spon`.`sponsor_cityId`
WHERE `Spon`.`sponsor_deleted` =0
ORDER BY `Spon`.`sponsor_date` DESC
ERROR - 2016-05-15 12:11:52 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT `healthTips_detail`, `healthTips_image`, `healthTips_amount`, `category_name`, `city_name`, `sponsor_date`, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN (select hospital_name from qyura_hospital hos where hos.hospital_usersId=sponsor_userId group by hos.hospital_id)  
WHEN (Spon.sponser_userRole = 3 ) THEN (select diagnostic_name from qyura_diagnostic diag where diag.diagnostic_usersId=sponsor_userId group by diag.diagnostic_id) 
WHEN (Spon.sponser_userRole = 4 ) THEN (select concat(doctors_fName, ' ', doctors_lName) from qyura_doctors doc where doc.doctors_userId=sponsor_userId group by doc.doctors_id)  end as miname, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN 'Hospital'  
WHEN (Spon.sponser_userRole = 3 ) THEN 'Diagnostic Center' 
WHEN (Spon.sponser_userRole = 4 ) THEN 'Doctor'  end as mitype
FROM `qyura_healthTipSponsor` AS `Spon`
JOIN `qyura_healthTips` AS `HTip` ON `Spon`.`sponsor_tipId`=`HTip`.`healthTips_id`
JOIN `qyura_healthCategory` `Cat` ON `HTip`.`healthTips_categoryId` = `Cat`.`category_id`
JOIN `qyura_city` `Ct` ON `Ct`.`city_id` = `Spon`.`sponsor_cityId`
WHERE `Spon`.`sponsor_deleted` =0
ORDER BY `Spon`.`sponsor_date` DESC
ERROR - 2016-05-15 12:11:52 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT `healthTips_detail`, `healthTips_image`, `healthTips_amount`, `category_name`, `city_name`, `sponsor_date`, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN (select hospital_name from qyura_hospital hos where hos.hospital_usersId=sponsor_userId group by hos.hospital_id)  
WHEN (Spon.sponser_userRole = 3 ) THEN (select diagnostic_name from qyura_diagnostic diag where diag.diagnostic_usersId=sponsor_userId group by diag.diagnostic_id) 
WHEN (Spon.sponser_userRole = 4 ) THEN (select concat(doctors_fName, ' ', doctors_lName) from qyura_doctors doc where doc.doctors_userId=sponsor_userId group by doc.doctors_id)  end as miname, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN 'Hospital'  
WHEN (Spon.sponser_userRole = 3 ) THEN 'Diagnostic Center' 
WHEN (Spon.sponser_userRole = 4 ) THEN 'Doctor'  end as mitype
FROM `qyura_healthTipSponsor` AS `Spon`
JOIN `qyura_healthTips` AS `HTip` ON `Spon`.`sponsor_tipId`=`HTip`.`healthTips_id`
JOIN `qyura_healthCategory` `Cat` ON `HTip`.`healthTips_categoryId` = `Cat`.`category_id`
JOIN `qyura_city` `Ct` ON `Ct`.`city_id` = `Spon`.`sponsor_cityId`
WHERE `Spon`.`sponsor_deleted` =0
ORDER BY `Spon`.`sponsor_date` DESC
ERROR - 2016-05-15 12:11:52 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT `healthTips_detail`, `healthTips_image`, `healthTips_amount`, `category_name`, `city_name`, `sponsor_date`, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN (select hospital_name from qyura_hospital hos where hos.hospital_usersId=sponsor_userId group by hos.hospital_id)  
WHEN (Spon.sponser_userRole = 3 ) THEN (select diagnostic_name from qyura_diagnostic diag where diag.diagnostic_usersId=sponsor_userId group by diag.diagnostic_id) 
WHEN (Spon.sponser_userRole = 4 ) THEN (select concat(doctors_fName, ' ', doctors_lName) from qyura_doctors doc where doc.doctors_userId=sponsor_userId group by doc.doctors_id)  end as miname, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN 'Hospital'  
WHEN (Spon.sponser_userRole = 3 ) THEN 'Diagnostic Center' 
WHEN (Spon.sponser_userRole = 4 ) THEN 'Doctor'  end as mitype
FROM `qyura_healthTipSponsor` AS `Spon`
JOIN `qyura_healthTips` AS `HTip` ON `Spon`.`sponsor_tipId`=`HTip`.`healthTips_id`
JOIN `qyura_healthCategory` `Cat` ON `HTip`.`healthTips_categoryId` = `Cat`.`category_id`
JOIN `qyura_city` `Ct` ON `Ct`.`city_id` = `Spon`.`sponsor_cityId`
WHERE `Spon`.`sponsor_deleted` =0
ORDER BY `Spon`.`sponsor_date` DESC
ERROR - 2016-05-15 12:11:52 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT `healthTips_detail`, `healthTips_image`, `healthTips_amount`, `category_name`, `city_name`, `sponsor_date`, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN (select hospital_name from qyura_hospital hos where hos.hospital_usersId=sponsor_userId group by hos.hospital_id)  
WHEN (Spon.sponser_userRole = 3 ) THEN (select diagnostic_name from qyura_diagnostic diag where diag.diagnostic_usersId=sponsor_userId group by diag.diagnostic_id) 
WHEN (Spon.sponser_userRole = 4 ) THEN (select concat(doctors_fName, ' ', doctors_lName) from qyura_doctors doc where doc.doctors_userId=sponsor_userId group by doc.doctors_id)  end as miname, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN 'Hospital'  
WHEN (Spon.sponser_userRole = 3 ) THEN 'Diagnostic Center' 
WHEN (Spon.sponser_userRole = 4 ) THEN 'Doctor'  end as mitype
FROM `qyura_healthTipSponsor` AS `Spon`
JOIN `qyura_healthTips` AS `HTip` ON `Spon`.`sponsor_tipId`=`HTip`.`healthTips_id`
JOIN `qyura_healthCategory` `Cat` ON `HTip`.`healthTips_categoryId` = `Cat`.`category_id`
JOIN `qyura_city` `Ct` ON `Ct`.`city_id` = `Spon`.`sponsor_cityId`
WHERE `Spon`.`sponsor_deleted` =0
ORDER BY `Spon`.`sponsor_date` DESC
ERROR - 2016-05-15 12:11:52 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT `healthTips_detail`, `healthTips_image`, `healthTips_amount`, `category_name`, `city_name`, `sponsor_date`, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN (select hospital_name from qyura_hospital hos where hos.hospital_usersId=sponsor_userId group by hos.hospital_id)  
WHEN (Spon.sponser_userRole = 3 ) THEN (select diagnostic_name from qyura_diagnostic diag where diag.diagnostic_usersId=sponsor_userId group by diag.diagnostic_id) 
WHEN (Spon.sponser_userRole = 4 ) THEN (select concat(doctors_fName, ' ', doctors_lName) from qyura_doctors doc where doc.doctors_userId=sponsor_userId group by doc.doctors_id)  end as miname, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN 'Hospital'  
WHEN (Spon.sponser_userRole = 3 ) THEN 'Diagnostic Center' 
WHEN (Spon.sponser_userRole = 4 ) THEN 'Doctor'  end as mitype
FROM `qyura_healthTipSponsor` AS `Spon`
JOIN `qyura_healthTips` AS `HTip` ON `Spon`.`sponsor_tipId`=`HTip`.`healthTips_id`
JOIN `qyura_healthCategory` `Cat` ON `HTip`.`healthTips_categoryId` = `Cat`.`category_id`
JOIN `qyura_city` `Ct` ON `Ct`.`city_id` = `Spon`.`sponsor_cityId`
WHERE `Spon`.`sponsor_deleted` =0
ORDER BY `Spon`.`sponsor_date` DESC
ERROR - 2016-05-15 12:11:52 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT `healthTips_detail`, `healthTips_image`, `healthTips_amount`, `category_name`, `city_name`, `sponsor_date`, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN (select hospital_name from qyura_hospital hos where hos.hospital_usersId=sponsor_userId group by hos.hospital_id)  
WHEN (Spon.sponser_userRole = 3 ) THEN (select diagnostic_name from qyura_diagnostic diag where diag.diagnostic_usersId=sponsor_userId group by diag.diagnostic_id) 
WHEN (Spon.sponser_userRole = 4 ) THEN (select concat(doctors_fName, ' ', doctors_lName) from qyura_doctors doc where doc.doctors_userId=sponsor_userId group by doc.doctors_id)  end as miname, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN 'Hospital'  
WHEN (Spon.sponser_userRole = 3 ) THEN 'Diagnostic Center' 
WHEN (Spon.sponser_userRole = 4 ) THEN 'Doctor'  end as mitype
FROM `qyura_healthTipSponsor` AS `Spon`
JOIN `qyura_healthTips` AS `HTip` ON `Spon`.`sponsor_tipId`=`HTip`.`healthTips_id`
JOIN `qyura_healthCategory` `Cat` ON `HTip`.`healthTips_categoryId` = `Cat`.`category_id`
JOIN `qyura_city` `Ct` ON `Ct`.`city_id` = `Spon`.`sponsor_cityId`
WHERE `Spon`.`sponsor_deleted` =0
ORDER BY `Spon`.`sponsor_date` DESC
ERROR - 2016-05-15 12:12:29 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT `healthTips_detail`, `healthTips_image`, `healthTips_amount`, `category_name`, `city_name`, `sponsor_date`, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN (select hospital_name from qyura_hospital hos where hos.hospital_usersId=sponsor_userId group by hos.hospital_id)  
WHEN (Spon.sponser_userRole = 3 ) THEN (select diagnostic_name from qyura_diagnostic diag where diag.diagnostic_usersId=sponsor_userId group by diag.diagnostic_id) 
WHEN (Spon.sponser_userRole = 4 ) THEN (select concat(doctors_fName, ' ', doctors_lName) from qyura_doctors doc where doc.doctors_userId=sponsor_userId group by doc.doctors_id)  end as miname, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN 'Hospital'  
WHEN (Spon.sponser_userRole = 3 ) THEN 'Diagnostic Center' 
WHEN (Spon.sponser_userRole = 4 ) THEN 'Doctor'  end as mitype
FROM `qyura_healthTipSponsor` AS `Spon`
JOIN `qyura_healthTips` AS `HTip` ON `Spon`.`sponsor_tipId`=`HTip`.`healthTips_id`
JOIN `qyura_healthCategory` `Cat` ON `HTip`.`healthTips_categoryId` = `Cat`.`category_id`
JOIN `qyura_city` `Ct` ON `Ct`.`city_id` = `Spon`.`sponsor_cityId`
WHERE `Spon`.`sponsor_deleted` =0
ORDER BY `Spon`.`sponsor_date` DESC
ERROR - 2016-05-15 12:13:01 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT `healthTips_detail`, `healthTips_image`, `healthTips_amount`, `category_name`, `city_name`, `sponsor_date`, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN (select hospital_name from qyura_hospital hos where hos.hospital_usersId=sponsor_userId group by hos.hospital_id)  
WHEN (Spon.sponser_userRole = 3 ) THEN (select diagnostic_name from qyura_diagnostic diag where diag.diagnostic_usersId=sponsor_userId group by diag.diagnostic_id) 
WHEN (Spon.sponser_userRole = 4 ) THEN (select concat(doctors_fName, ' ', doctors_lName) from qyura_doctors doc where doc.doctors_userId=sponsor_userId group by doc.doctors_id)  end as miname, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN 'Hospital'  
WHEN (Spon.sponser_userRole = 3 ) THEN 'Diagnostic Center' 
WHEN (Spon.sponser_userRole = 4 ) THEN 'Doctor'  end as mitype
FROM `qyura_healthTipSponsor` AS `Spon`
JOIN `qyura_healthTips` AS `HTip` ON `Spon`.`sponsor_tipId`=`HTip`.`healthTips_id`
JOIN `qyura_healthCategory` `Cat` ON `HTip`.`healthTips_categoryId` = `Cat`.`category_id`
JOIN `qyura_city` `Ct` ON `Ct`.`city_id` = `Spon`.`sponsor_cityId`
WHERE `Spon`.`sponsor_deleted` =0
ORDER BY `Spon`.`sponsor_date` DESC
ERROR - 2016-05-15 12:13:04 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT `healthTips_detail`, `healthTips_image`, `healthTips_amount`, `category_name`, `city_name`, `sponsor_date`, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN (select hospital_name from qyura_hospital hos where hos.hospital_usersId=sponsor_userId group by hos.hospital_id)  
WHEN (Spon.sponser_userRole = 3 ) THEN (select diagnostic_name from qyura_diagnostic diag where diag.diagnostic_usersId=sponsor_userId group by diag.diagnostic_id) 
WHEN (Spon.sponser_userRole = 4 ) THEN (select concat(doctors_fName, ' ', doctors_lName) from qyura_doctors doc where doc.doctors_userId=sponsor_userId group by doc.doctors_id)  end as miname, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN 'Hospital'  
WHEN (Spon.sponser_userRole = 3 ) THEN 'Diagnostic Center' 
WHEN (Spon.sponser_userRole = 4 ) THEN 'Doctor'  end as mitype
FROM `qyura_healthTipSponsor` AS `Spon`
JOIN `qyura_healthTips` AS `HTip` ON `Spon`.`sponsor_tipId`=`HTip`.`healthTips_id`
JOIN `qyura_healthCategory` `Cat` ON `HTip`.`healthTips_categoryId` = `Cat`.`category_id`
JOIN `qyura_city` `Ct` ON `Ct`.`city_id` = `Spon`.`sponsor_cityId`
WHERE `Spon`.`sponsor_deleted` =0
ORDER BY `Spon`.`sponsor_date` DESC
ERROR - 2016-05-15 12:27:48 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ''Cash' THEN 'Credit Card' ELSE '' END AS payStatus, CASE WHEN (doctorAppointment' at line 1 - Invalid query: SELECT CASE WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 1 ) THEN `qyura_hospital`.`hospital_name` WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 2 ) THEN `qyura_diagnostic`.`diagnostic_name` ELSE concat(`doctors_fName`,' ',`doctors_lName`) END AS title,`qyura_doctorAppointment`.`doctorAppointment_unqId` AS `orderId`,`qyura_specialities`.`specialities_name` AS `speciality`,DATE_FORMAT(FROM_UNIXTIME(`qyura_doctorAppointment`.`doctorAppointment_date`),'%d %b, %Y') as date,DATE_FORMAT(`doctorAvailabilitySession_start`,'%h:%i%p') as startTime,DATE_FORMAT(`doctorAvailabilitySession_end`,'%h:%i%p') as endTime, CASE WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 1 ) THEN `qyura_hospital`.`hospital_address` WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 2 ) THEN `qyura_diagnostic`.`diagnostic_address` ELSE `qyura_doctors`.`doctor_addr` END AS `address`, CASE WHEN (docTimeTable_stayAt = 0) THEN psChamber_name ELSE  CASE WHEN (docTimeTable_MItype = 1) THEN hospital_name WHEN (docTimeTable_MItype = 2) THEN diagnostic_name ELSE '' END END AS name,CASE WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 1 ) THEN `qyura_hospital`.`hospital_name` WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 2 ) THEN `qyura_diagnostic`.`diagnostic_name` ELSE CONCAT(`qyura_doctors`.`doctors_fName`,' ',`qyura_doctors`.`doctors_lName`) END AS `miName`,qyura_doctorAppointment.doctorAppointment_ptRmk AS `remark`,CASE WHEN (qyura_doctorAppointment.doctorAppointment_memberId <> 0 ) THEN qyura_usersFamily.usersfamily_name ELSE qyura_patientDetails.patientDetails_patientName END AS `userName`, CASE WHEN (qyura_doctorAppointment.doctorAppointment_memberId <> 0 ) THEN qyura_usersFamily.usersfamily_gender ELSE qyura_patientDetails.patientDetails_gender END AS `userGender`,`qyura_users`.`users_mobile` AS `usersMobile`, CASE WHEN (`qyura_doctorAppointment`.`doctorAppointment_memberId` <> 0 ) THEN qyura_usersFamily.usersfamily_age ELSE (FROM_UNIXTIME('1463315268', '%Y') - FROM_UNIXTIME(qyura_patientDetails.patientDetails_dob, '%Y')) END AS `userAge`,CASE qyura_doctorAppointment.doctorAppointment_status WHEN '1' THEN 'Confirmed' WHEN '2' THEN 'Cancelled' WHEN '3' THEN 'Pending' WHEN '4' THEN 'Completed' ELSE '' END  AS `bookingStatus`,CASE WHEN (doctorAppointment_status = 4) THEN (CASE WHEN (`reviews_details` <> '') THEN `reviews_details` ELSE 'Not Given' END ) ELSE '' END  AS `reviews`,CASE WHEN (doctorAppointment_status = 4) THEN (CASE WHEN (`reviews_rating` <> 0) THEN `reviews_rating` ELSE '0' END ) ELSE '0' END  AS `rating`,  CASE WHEN (doctorAppointment_payStatus = 17 ) 'Cash' THEN 'Credit Card' ELSE '' END AS payStatus, CASE WHEN (doctorAppointment_payMode = 16 ) 'Paid' THEN 'Unpaid' ELSE '' END AS paymentMood, FROM `qyura_doctorAppointment`
            
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
                AND `doctorAppointment_unqId` = 'APDOC48144'
                AND `qyura_doctorAppointment`.`doctorAppointment_deleted` = 0
                AND `qyura_doctorAppointment`.`doctorAppointment_date` <> 0
ERROR - 2016-05-15 12:27:56 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ''Cash' THEN 'Credit Card' ELSE '' END AS payStatus, CASE WHEN (doctorAppointment' at line 1 - Invalid query: SELECT CASE WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 1 ) THEN `qyura_hospital`.`hospital_name` WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 2 ) THEN `qyura_diagnostic`.`diagnostic_name` ELSE concat(`doctors_fName`,' ',`doctors_lName`) END AS title,`qyura_doctorAppointment`.`doctorAppointment_unqId` AS `orderId`,`qyura_specialities`.`specialities_name` AS `speciality`,DATE_FORMAT(FROM_UNIXTIME(`qyura_doctorAppointment`.`doctorAppointment_date`),'%d %b, %Y') as date,DATE_FORMAT(`doctorAvailabilitySession_start`,'%h:%i%p') as startTime,DATE_FORMAT(`doctorAvailabilitySession_end`,'%h:%i%p') as endTime, CASE WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 1 ) THEN `qyura_hospital`.`hospital_address` WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 2 ) THEN `qyura_diagnostic`.`diagnostic_address` ELSE `qyura_doctors`.`doctor_addr` END AS `address`, CASE WHEN (docTimeTable_stayAt = 0) THEN psChamber_name ELSE  CASE WHEN (docTimeTable_MItype = 1) THEN hospital_name WHEN (docTimeTable_MItype = 2) THEN diagnostic_name ELSE '' END END AS name,CASE WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 1 ) THEN `qyura_hospital`.`hospital_name` WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 2 ) THEN `qyura_diagnostic`.`diagnostic_name` ELSE CONCAT(`qyura_doctors`.`doctors_fName`,' ',`qyura_doctors`.`doctors_lName`) END AS `miName`,qyura_doctorAppointment.doctorAppointment_ptRmk AS `remark`,CASE WHEN (qyura_doctorAppointment.doctorAppointment_memberId <> 0 ) THEN qyura_usersFamily.usersfamily_name ELSE qyura_patientDetails.patientDetails_patientName END AS `userName`, CASE WHEN (qyura_doctorAppointment.doctorAppointment_memberId <> 0 ) THEN qyura_usersFamily.usersfamily_gender ELSE qyura_patientDetails.patientDetails_gender END AS `userGender`,`qyura_users`.`users_mobile` AS `usersMobile`, CASE WHEN (`qyura_doctorAppointment`.`doctorAppointment_memberId` <> 0 ) THEN qyura_usersFamily.usersfamily_age ELSE (FROM_UNIXTIME('1463315276', '%Y') - FROM_UNIXTIME(qyura_patientDetails.patientDetails_dob, '%Y')) END AS `userAge`,CASE qyura_doctorAppointment.doctorAppointment_status WHEN '1' THEN 'Confirmed' WHEN '2' THEN 'Cancelled' WHEN '3' THEN 'Pending' WHEN '4' THEN 'Completed' ELSE '' END  AS `bookingStatus`,CASE WHEN (doctorAppointment_status = 4) THEN (CASE WHEN (`reviews_details` <> '') THEN `reviews_details` ELSE 'Not Given' END ) ELSE '' END  AS `reviews`,CASE WHEN (doctorAppointment_status = 4) THEN (CASE WHEN (`reviews_rating` <> 0) THEN `reviews_rating` ELSE '0' END ) ELSE '0' END  AS `rating`,  CASE WHEN (doctorAppointment_payStatus = 17 ) 'Cash' THEN 'Credit Card' ELSE '' END AS payStatus, CASE WHEN (doctorAppointment_payMode = 16 ) 'Paid' THEN 'Unpaid' ELSE '' END AS paymentMood, FROM `qyura_doctorAppointment`
            
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
                AND `doctorAppointment_unqId` = 'APDOC48144'
                AND `qyura_doctorAppointment`.`doctorAppointment_deleted` = 0
                AND `qyura_doctorAppointment`.`doctorAppointment_date` <> 0
ERROR - 2016-05-15 12:54:09 --> 404 Page Not Found: ../modules/auth/controllers/Auth/assets
ERROR - 2016-05-15 12:56:03 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT `Spon`.`sponsor_id`, `healthTips_detail`, `healthTips_image`, `healthTips_amount`, `category_name`, `city_name`, FROM_UNIXTIME(sponsor_date, '%d-%m-%Y') sponsor_date, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN (select hospital_name from qyura_hospital hos where hos.hospital_usersId=sponsor_userId)  
WHEN (Spon.sponser_userRole = 3 ) THEN (select diagnostic_name from qyura_diagnostic diag where diag.diagnostic_usersId=sponsor_userId) 
WHEN (Spon.sponser_userRole = 4 ) THEN (select concat(doctors_fName, ' ', doctors_lName) from qyura_doctors doc where doc.doctors_userId=sponsor_userId)  end as miname, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN 'Hospital'  
WHEN (Spon.sponser_userRole = 3 ) THEN 'Diagnostic Center' 
WHEN (Spon.sponser_userRole = 4 ) THEN 'Doctor'  end as mitype
FROM `qyura_healthTipSponsor` AS `Spon`
JOIN `qyura_healthTips` AS `HTip` ON `Spon`.`sponsor_tipId`=`HTip`.`healthTips_id`
JOIN `qyura_healthCategory` `Cat` ON `HTip`.`healthTips_categoryId` = `Cat`.`category_id`
JOIN `qyura_city` `Ct` ON `Ct`.`city_id` = `Spon`.`sponsor_cityId`
WHERE `Spon`.`sponsor_deleted` =0
ORDER BY `Spon`.`sponsor_date` DESC, `Spon`.`sponsor_date` DESC, `miname` ASC
 LIMIT 10
ERROR - 2016-05-15 12:56:08 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT `Spon`.`sponsor_id`, `healthTips_detail`, `healthTips_image`, `healthTips_amount`, `category_name`, `city_name`, FROM_UNIXTIME(sponsor_date, '%d-%m-%Y') sponsor_date, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN (select hospital_name from qyura_hospital hos where hos.hospital_usersId=sponsor_userId)  
WHEN (Spon.sponser_userRole = 3 ) THEN (select diagnostic_name from qyura_diagnostic diag where diag.diagnostic_usersId=sponsor_userId) 
WHEN (Spon.sponser_userRole = 4 ) THEN (select concat(doctors_fName, ' ', doctors_lName) from qyura_doctors doc where doc.doctors_userId=sponsor_userId)  end as miname, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN 'Hospital'  
WHEN (Spon.sponser_userRole = 3 ) THEN 'Diagnostic Center' 
WHEN (Spon.sponser_userRole = 4 ) THEN 'Doctor'  end as mitype
FROM `qyura_healthTipSponsor` AS `Spon`
JOIN `qyura_healthTips` AS `HTip` ON `Spon`.`sponsor_tipId`=`HTip`.`healthTips_id`
JOIN `qyura_healthCategory` `Cat` ON `HTip`.`healthTips_categoryId` = `Cat`.`category_id`
JOIN `qyura_city` `Ct` ON `Ct`.`city_id` = `Spon`.`sponsor_cityId`
WHERE `Spon`.`sponsor_deleted` =0
ORDER BY `Spon`.`sponsor_date` DESC, `Spon`.`sponsor_date` DESC, `miname` ASC
 LIMIT 10
ERROR - 2016-05-15 12:56:23 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT `Spon`.`sponsor_id`, `healthTips_detail`, `healthTips_image`, `healthTips_amount`, `category_name`, `city_name`, FROM_UNIXTIME(sponsor_date, '%d-%m-%Y') sponsor_date, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN (select hospital_name from qyura_hospital hos where hos.hospital_usersId=sponsor_userId)  
WHEN (Spon.sponser_userRole = 3 ) THEN (select diagnostic_name from qyura_diagnostic diag where diag.diagnostic_usersId=sponsor_userId) 
WHEN (Spon.sponser_userRole = 4 ) THEN (select concat(doctors_fName, ' ', doctors_lName) from qyura_doctors doc where doc.doctors_userId=sponsor_userId)  end as miname, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN 'Hospital'  
WHEN (Spon.sponser_userRole = 3 ) THEN 'Diagnostic Center' 
WHEN (Spon.sponser_userRole = 4 ) THEN 'Doctor'  end as mitype
FROM `qyura_healthTipSponsor` AS `Spon`
JOIN `qyura_healthTips` AS `HTip` ON `Spon`.`sponsor_tipId`=`HTip`.`healthTips_id`
JOIN `qyura_healthCategory` `Cat` ON `HTip`.`healthTips_categoryId` = `Cat`.`category_id`
JOIN `qyura_city` `Ct` ON `Ct`.`city_id` = `Spon`.`sponsor_cityId`
WHERE `Spon`.`sponsor_deleted` =0
ORDER BY `Spon`.`sponsor_date` DESC, `Spon`.`sponsor_date` DESC, `miname` ASC
 LIMIT 10
ERROR - 2016-05-15 12:56:34 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT `Spon`.`sponsor_id`, `healthTips_detail`, `healthTips_image`, `healthTips_amount`, `category_name`, `city_name`, FROM_UNIXTIME(sponsor_date, '%d-%m-%Y') sponsor_date, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN (select hospital_name from qyura_hospital hos where hos.hospital_usersId=sponsor_userId)  
WHEN (Spon.sponser_userRole = 3 ) THEN (select diagnostic_name from qyura_diagnostic diag where diag.diagnostic_usersId=sponsor_userId) 
WHEN (Spon.sponser_userRole = 4 ) THEN (select concat(doctors_fName, ' ', doctors_lName) from qyura_doctors doc where doc.doctors_userId=sponsor_userId)  end as miname, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN 'Hospital'  
WHEN (Spon.sponser_userRole = 3 ) THEN 'Diagnostic Center' 
WHEN (Spon.sponser_userRole = 4 ) THEN 'Doctor'  end as mitype
FROM `qyura_healthTipSponsor` AS `Spon`
JOIN `qyura_healthTips` AS `HTip` ON `Spon`.`sponsor_tipId`=`HTip`.`healthTips_id`
JOIN `qyura_healthCategory` `Cat` ON `HTip`.`healthTips_categoryId` = `Cat`.`category_id`
JOIN `qyura_city` `Ct` ON `Ct`.`city_id` = `Spon`.`sponsor_cityId`
WHERE `Spon`.`sponsor_deleted` =0
ORDER BY `Spon`.`sponsor_date` DESC, `Spon`.`sponsor_date` DESC, `miname` ASC
 LIMIT 10
ERROR - 2016-05-15 13:05:56 --> Unable to save the image. Please make sure the image and file directory are writable.
ERROR - 2016-05-15 13:06:32 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT `Spon`.`sponsor_id`, `healthTips_detail`, `healthTips_image`, `healthTips_amount`, `category_name`, `city_name`, FROM_UNIXTIME(sponsor_date, '%d-%m-%Y') sponsor_date, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN (select hospital_name from qyura_hospital hos where hos.hospital_usersId=sponsor_userId)  
WHEN (Spon.sponser_userRole = 3 ) THEN (select diagnostic_name from qyura_diagnostic diag where diag.diagnostic_usersId=sponsor_userId) 
WHEN (Spon.sponser_userRole = 4 ) THEN (select concat(doctors_fName, ' ', doctors_lName) from qyura_doctors doc where doc.doctors_userId=sponsor_userId)  end as miname, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN 'Hospital'  
WHEN (Spon.sponser_userRole = 3 ) THEN 'Diagnostic Center' 
WHEN (Spon.sponser_userRole = 4 ) THEN 'Doctor'  end as mitype
FROM `qyura_healthTipSponsor` AS `Spon`
JOIN `qyura_healthTips` AS `HTip` ON `Spon`.`sponsor_tipId`=`HTip`.`healthTips_id`
JOIN `qyura_healthCategory` `Cat` ON `HTip`.`healthTips_categoryId` = `Cat`.`category_id`
JOIN `qyura_city` `Ct` ON `Ct`.`city_id` = `Spon`.`sponsor_cityId`
WHERE `Spon`.`sponsor_deleted` =0
ORDER BY `Spon`.`sponsor_date` DESC, `Spon`.`sponsor_date` DESC, `miname` ASC
 LIMIT 10
ERROR - 2016-05-15 13:11:24 --> Unable to save the image. Please make sure the image and file directory are writable.
ERROR - 2016-05-15 13:21:39 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT `Spon`.`sponsor_id`, `healthTips_detail`, `healthTips_image`, `healthTips_amount`, `category_name`, `city_name`, FROM_UNIXTIME(sponsor_date, '%d-%m-%Y') sponsor_date, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN (select hospital_name from qyura_hospital hos where hos.hospital_usersId=sponsor_userId)  
WHEN (Spon.sponser_userRole = 3 ) THEN (select diagnostic_name from qyura_diagnostic diag where diag.diagnostic_usersId=sponsor_userId) 
WHEN (Spon.sponser_userRole = 4 ) THEN (select concat(doctors_fName, ' ', doctors_lName) from qyura_doctors doc where doc.doctors_userId=sponsor_userId)  end as miname, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN 'Hospital'  
WHEN (Spon.sponser_userRole = 3 ) THEN 'Diagnostic Center' 
WHEN (Spon.sponser_userRole = 4 ) THEN 'Doctor'  end as mitype
FROM `qyura_healthTipSponsor` AS `Spon`
JOIN `qyura_healthTips` AS `HTip` ON `Spon`.`sponsor_tipId`=`HTip`.`healthTips_id`
JOIN `qyura_healthCategory` `Cat` ON `HTip`.`healthTips_categoryId` = `Cat`.`category_id`
JOIN `qyura_city` `Ct` ON `Ct`.`city_id` = `Spon`.`sponsor_cityId`
WHERE `Spon`.`sponsor_deleted` =0
ORDER BY `Spon`.`sponsor_date` DESC, `Spon`.`sponsor_date` DESC, `miname` ASC
 LIMIT 10
ERROR - 2016-05-15 13:21:44 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT `Spon`.`sponsor_id`, `healthTips_detail`, `healthTips_image`, `healthTips_amount`, `category_name`, `city_name`, FROM_UNIXTIME(sponsor_date, '%d-%m-%Y') sponsor_date, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN (select hospital_name from qyura_hospital hos where hos.hospital_usersId=sponsor_userId)  
WHEN (Spon.sponser_userRole = 3 ) THEN (select diagnostic_name from qyura_diagnostic diag where diag.diagnostic_usersId=sponsor_userId) 
WHEN (Spon.sponser_userRole = 4 ) THEN (select concat(doctors_fName, ' ', doctors_lName) from qyura_doctors doc where doc.doctors_userId=sponsor_userId)  end as miname, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN 'Hospital'  
WHEN (Spon.sponser_userRole = 3 ) THEN 'Diagnostic Center' 
WHEN (Spon.sponser_userRole = 4 ) THEN 'Doctor'  end as mitype
FROM `qyura_healthTipSponsor` AS `Spon`
JOIN `qyura_healthTips` AS `HTip` ON `Spon`.`sponsor_tipId`=`HTip`.`healthTips_id`
JOIN `qyura_healthCategory` `Cat` ON `HTip`.`healthTips_categoryId` = `Cat`.`category_id`
JOIN `qyura_city` `Ct` ON `Ct`.`city_id` = `Spon`.`sponsor_cityId`
WHERE `Spon`.`sponsor_deleted` =0
ORDER BY `Spon`.`sponsor_date` DESC, `Spon`.`sponsor_date` DESC, `miname` ASC
 LIMIT 10
ERROR - 2016-05-15 13:21:51 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT `Spon`.`sponsor_id`, `healthTips_detail`, `healthTips_image`, `healthTips_amount`, `category_name`, `city_name`, FROM_UNIXTIME(sponsor_date, '%d-%m-%Y') sponsor_date, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN (select hospital_name from qyura_hospital hos where hos.hospital_usersId=sponsor_userId group by hos.hospital_id)  
WHEN (Spon.sponser_userRole = 3 ) THEN (select diagnostic_name from qyura_diagnostic diag where diag.diagnostic_usersId=sponsor_userId group by diag.diagnostic_id) 
WHEN (Spon.sponser_userRole = 4 ) THEN (select concat(doctors_fName, ' ', doctors_lName) from qyura_doctors doc where doc.doctors_userId=sponsor_userId group by doc.doctors_id)  end as miname, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN 'Hospital'  
WHEN (Spon.sponser_userRole = 3 ) THEN 'Diagnostic Center' 
WHEN (Spon.sponser_userRole = 4 ) THEN 'Doctor'  end as mitype
FROM `qyura_healthTipSponsor` AS `Spon`
JOIN `qyura_healthTips` AS `HTip` ON `Spon`.`sponsor_tipId`=`HTip`.`healthTips_id`
JOIN `qyura_healthCategory` `Cat` ON `HTip`.`healthTips_categoryId` = `Cat`.`category_id`
JOIN `qyura_city` `Ct` ON `Ct`.`city_id` = `Spon`.`sponsor_cityId`
WHERE `Spon`.`sponsor_deleted` =0
ORDER BY `Spon`.`sponsor_date` DESC, `Spon`.`sponsor_date` DESC, `miname` ASC
 LIMIT 10
ERROR - 2016-05-15 13:25:07 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT `Spon`.`sponsor_id`, `healthTips_detail`, `healthTips_image`, `healthTips_amount`, `category_name`, `city_name`, FROM_UNIXTIME(sponsor_date, '%d-%m-%Y') sponsor_date, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN (select hospital_name from qyura_hospital hos where hos.hospital_usersId=sponsor_userId group by hos.hospital_id)  
WHEN (Spon.sponser_userRole = 3 ) THEN (select diagnostic_name from qyura_diagnostic diag where diag.diagnostic_usersId=sponsor_userId group by diag.diagnostic_id) 
WHEN (Spon.sponser_userRole = 4 ) THEN (select concat(doctors_fName, ' ', doctors_lName) from qyura_doctors doc where doc.doctors_userId=sponsor_userId group by doc.doctors_id)  end as miname, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN 'Hospital'  
WHEN (Spon.sponser_userRole = 3 ) THEN 'Diagnostic Center' 
WHEN (Spon.sponser_userRole = 4 ) THEN 'Doctor'  end as mitype
FROM `qyura_healthTipSponsor` AS `Spon`
JOIN `qyura_healthTips` AS `HTip` ON `Spon`.`sponsor_tipId`=`HTip`.`healthTips_id`
JOIN `qyura_healthCategory` `Cat` ON `HTip`.`healthTips_categoryId` = `Cat`.`category_id`
JOIN `qyura_city` `Ct` ON `Ct`.`city_id` = `Spon`.`sponsor_cityId`
WHERE `Spon`.`sponsor_deleted` =0
ORDER BY `Spon`.`sponsor_date` DESC, `Spon`.`sponsor_date` DESC, `miname` ASC
 LIMIT 10
ERROR - 2016-05-15 13:25:15 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT `Spon`.`sponsor_id`, `healthTips_detail`, `healthTips_image`, `healthTips_amount`, `category_name`, `city_name`, FROM_UNIXTIME(sponsor_date, '%d-%m-%Y') sponsor_date, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN (select hospital_name from qyura_hospital hos where hos.hospital_usersId=sponsor_userId group by hos.hospital_id)  
WHEN (Spon.sponser_userRole = 3 ) THEN (select diagnostic_name from qyura_diagnostic diag where diag.diagnostic_usersId=sponsor_userId group by diag.diagnostic_id) 
WHEN (Spon.sponser_userRole = 4 ) THEN (select concat(doctors_fName, ' ', doctors_lName) from qyura_doctors doc where doc.doctors_userId=sponsor_userId group by doc.doctors_id)  end as miname, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN 'Hospital'  
WHEN (Spon.sponser_userRole = 3 ) THEN 'Diagnostic Center' 
WHEN (Spon.sponser_userRole = 4 ) THEN 'Doctor'  end as mitype
FROM `qyura_healthTipSponsor` AS `Spon`
JOIN `qyura_healthTips` AS `HTip` ON `Spon`.`sponsor_tipId`=`HTip`.`healthTips_id`
JOIN `qyura_healthCategory` `Cat` ON `HTip`.`healthTips_categoryId` = `Cat`.`category_id`
JOIN `qyura_city` `Ct` ON `Ct`.`city_id` = `Spon`.`sponsor_cityId`
WHERE `Spon`.`sponsor_deleted` =0
ORDER BY `Spon`.`sponsor_date` DESC, `Spon`.`sponsor_date` DESC, `miname` ASC
 LIMIT 10
ERROR - 2016-05-15 13:26:07 --> Query error: Subquery returns more than 1 row - Invalid query: SELECT `Spon`.`sponsor_id`, `healthTips_detail`, `healthTips_image`, `healthTips_amount`, `category_name`, `city_name`, FROM_UNIXTIME(sponsor_date, '%d-%m-%Y') sponsor_date, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN (select hospital_name from qyura_hospital hos where hos.hospital_usersId=sponsor_userId group by hos.hospital_id)  
WHEN (Spon.sponser_userRole = 3 ) THEN (select diagnostic_name from qyura_diagnostic diag where diag.diagnostic_usersId=sponsor_userId group by diag.diagnostic_id) 
WHEN (Spon.sponser_userRole = 4 ) THEN (select concat(doctors_fName, ' ', doctors_lName) from qyura_doctors doc where doc.doctors_userId=sponsor_userId group by doc.doctors_id)  end as miname, CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN 'Hospital'  
WHEN (Spon.sponser_userRole = 3 ) THEN 'Diagnostic Center' 
WHEN (Spon.sponser_userRole = 4 ) THEN 'Doctor'  end as mitype
FROM `qyura_healthTipSponsor` AS `Spon`
JOIN `qyura_healthTips` AS `HTip` ON `Spon`.`sponsor_tipId`=`HTip`.`healthTips_id`
JOIN `qyura_healthCategory` `Cat` ON `HTip`.`healthTips_categoryId` = `Cat`.`category_id`
JOIN `qyura_city` `Ct` ON `Ct`.`city_id` = `Spon`.`sponsor_cityId`
WHERE `Spon`.`sponsor_deleted` =0
ORDER BY `Spon`.`sponsor_date` DESC, `Spon`.`sponsor_date` DESC, `miname` ASC
 LIMIT 10
ERROR - 2016-05-15 13:29:04 --> Unable to save the image. Please make sure the image and file directory are writable.
ERROR - 2016-05-15 13:35:04 --> Unable to save the image. Please make sure the image and file directory are writable.
ERROR - 2016-05-15 13:50:20 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '+ qyura_quotations.quotation_otherFee + qyura_quotations.quotation_tex
FROM `qyu' at line 1 - Invalid query: SELECT sum(qyura_quotationDetailTests.quotationDetailTests_price) as price + qyura_quotations.quotation_otherFee + qyura_quotations.quotation_tex
FROM `qyura_quotations`
RIGHT JOIN `qyura_quotationDetailTests` ON `qyura_quotationDetailTests`.`quotationDetailTests_quotationId`=`qyura_quotations`.`quotation_id`
WHERE `qyura_quotations`.`quotation_id` = '24'
AND `qyura_quotations`.`quotation_deleted` =0
AND `qyura_quotationDetailTests`.`quotationDetailTests_deleted` =0
 LIMIT 1
ERROR - 2016-05-15 13:50:25 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '+ qyura_quotations.quotation_otherFee + qyura_quotations.quotation_tex
FROM `qyu' at line 1 - Invalid query: SELECT sum(qyura_quotationDetailTests.quotationDetailTests_price) as price + qyura_quotations.quotation_otherFee + qyura_quotations.quotation_tex
FROM `qyura_quotations`
RIGHT JOIN `qyura_quotationDetailTests` ON `qyura_quotationDetailTests`.`quotationDetailTests_quotationId`=`qyura_quotations`.`quotation_id`
WHERE `qyura_quotations`.`quotation_id` = '24'
AND `qyura_quotations`.`quotation_deleted` =0
AND `qyura_quotationDetailTests`.`quotationDetailTests_deleted` =0
 LIMIT 1
ERROR - 2016-05-15 13:51:49 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '+ qyura_quotations.quotation_otherFee + qyura_quotations.quotation_tex
FROM `qyu' at line 1 - Invalid query: SELECT sum(qyura_quotationDetailTests.quotationDetailTests_price) as price + qyura_quotations.quotation_otherFee + qyura_quotations.quotation_tex
FROM `qyura_quotations`
RIGHT JOIN `qyura_quotationDetailTests` ON `qyura_quotationDetailTests`.`quotationDetailTests_quotationId`=`qyura_quotations`.`quotation_id`
WHERE `qyura_quotations`.`quotation_id` = '24'
AND `qyura_quotations`.`quotation_deleted` =0
AND `qyura_quotationDetailTests`.`quotationDetailTests_deleted` =0
 LIMIT 1
ERROR - 2016-05-15 13:54:24 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '+ qyura_quotations.quotation_otherFee + qyura_quotations.quotation_tex
FROM `qyu' at line 1 - Invalid query: SELECT sum(qyura_quotationDetailTests.quotationDetailTests_price) as price + qyura_quotations.quotation_otherFee + qyura_quotations.quotation_tex
FROM `qyura_quotations`
RIGHT JOIN `qyura_quotationDetailTests` ON `qyura_quotationDetailTests`.`quotationDetailTests_quotationId`=`qyura_quotations`.`quotation_id`
WHERE `qyura_quotations`.`quotation_id` = '24'
AND `qyura_quotations`.`quotation_deleted` =0
AND `qyura_quotationDetailTests`.`quotationDetailTests_deleted` =0
 LIMIT 1
ERROR - 2016-05-15 14:02:14 --> Unable to save the image. Please make sure the image and file directory are writable.
