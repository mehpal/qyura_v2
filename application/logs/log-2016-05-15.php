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
