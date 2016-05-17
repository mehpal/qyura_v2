<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2016-05-17 04:47:56 --> 404 Page Not Found: ../modules/auth/controllers/Auth/assets
ERROR - 2016-05-17 04:57:03 --> 404 Page Not Found: ../modules/api/controllers//index
ERROR - 2016-05-17 05:00:30 --> 404 Page Not Found: ../modules/auth/controllers/Auth/assets
ERROR - 2016-05-17 05:00:31 --> 404 Page Not Found: ../modules/auth/controllers/Auth/assets
ERROR - 2016-05-17 05:35:17 --> 404 Page Not Found: ../modules/api/controllers//index
ERROR - 2016-05-17 05:54:14 --> 404 Page Not Found: ../modules/auth/controllers/Auth/assets
ERROR - 2016-05-17 05:54:16 --> 404 Page Not Found: ../modules/auth/controllers/Auth/assets
ERROR - 2016-05-17 06:43:05 --> 404 Page Not Found: ../modules/api/controllers//index
ERROR - 2016-05-17 07:25:31 --> 404 Page Not Found: ../modules/auth/controllers/Auth/assets
ERROR - 2016-05-17 07:25:31 --> 404 Page Not Found: ../modules/auth/controllers/Auth/assets
ERROR - 2016-05-17 07:36:22 --> 404 Page Not Found: ../modules/doctor/controllers/Doctor/checkMail
ERROR - 2016-05-17 08:02:42 --> 404 Page Not Found: /index
ERROR - 2016-05-17 08:03:23 --> 404 Page Not Found: ../modules/doctor/controllers/Doctor/checkMail
ERROR - 2016-05-17 08:03:28 --> 404 Page Not Found: ../modules/auth/controllers/Auth/assets
ERROR - 2016-05-17 08:21:21 --> 404 Page Not Found: ../modules/auth/controllers/Auth/assets
ERROR - 2016-05-17 09:09:21 --> 404 Page Not Found: ../modules/auth/controllers/Auth/assets
ERROR - 2016-05-17 09:29:09 --> 404 Page Not Found: ../modules/api/controllers//index
ERROR - 2016-05-17 09:56:56 --> Unable to save the image. Please make sure the image and file directory are writable.
ERROR - 2016-05-17 11:58:20 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'IS NULL
ORDER BY `distance` ASC
 LIMIT 70' at line 30 - Invalid query: SELECT CONCAT("0", "", `qyura_doctors`.`doctors_phn`) phn, `qyura_doctors`.`doctors_showExp` as `showExp`, `qyura_doctors`.`doctors_id` as `id`, `qyura_doctors`.`doctors_userId` as `userId`, CONCAT(qyura_doctors.doctors_fName, " ", qyura_doctors.doctors_lName) AS name, `qyura_doctors`.`doctors_img` `imUrl`, (
                6371 * acos( cos( radians( 22.718410 ) ) * cos( radians( doctors_lat ) ) * cos( radians( doctors_long ) - radians( 75.855896 ) ) + sin( radians( 22.718410 ) ) * sin( radians( doctors_lat ) ) )
                ) AS distance, (select MIN(docTimeTable_price) FROM qyura_docTimeTable WHERE qyura_docTimeTable.docTimeTable_doctorId = qyura_doctors.doctors_id ) as consFee, Group_concat(DISTINCT qyura_specialities.specialities_name) as specialityName, Group_concat(DISTINCT qyura_degree.degree_SName SEPARATOR ", ") as degree, `qyura_doctors`.`doctors_lat` as `lat`, `qyura_doctors`.`doctors_long` as `long`, `qyura_doctors`.`doctors_27Src` as `isEmergency`, (YEAR("2016-05-17") - FROM_UNIXTIME(qyura_doctors.doctors_expYear, "%Y")) AS exp, (
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
 AS `rating`
FROM `qyura_doctors`
LEFT JOIN `qyura_usersRoles` ON `qyura_usersRoles`.`usersRoles_userId`=`qyura_doctors`.`doctors_userId`
LEFT JOIN `qyura_doctorAcademic` ON `qyura_doctorAcademic`.`doctorAcademic_doctorsId`=`qyura_doctors`.`doctors_id`
LEFT JOIN `qyura_degree` ON `qyura_doctorAcademic`.`doctorAcademic_degreeId`=`qyura_degree`.`degree_id`
LEFT JOIN `qyura_doctorSpecialities` ON `qyura_doctorSpecialities`.`doctorSpecialities_doctorsId` = `qyura_doctors`.`doctors_id`
LEFT JOIN `qyura_specialities` ON `qyura_specialities`.`specialities_id` = `qyura_doctorSpecialities`.`doctorSpecialities_specialitiesId`
LEFT JOIN `qyura_reviews` ON `qyura_reviews`.`reviews_relateId`=`qyura_doctors`.`doctors_userId`
LEFT JOIN `qyura_ratings` ON `qyura_ratings`.`rating_relateId`=`qyura_doctors`.`doctors_userId`
WHERE `doctors_deleted` =0
AND `usersRoles_roleId` = 4
AND `qyura_doctors`.`doctors_27Src` = '1'
AND `doctors_id` NOT IN('')
AND `doctors_cityId` = '705'
GROUP BY `doctors_id`
HAVING  IS NULL
ORDER BY `distance` ASC
 LIMIT 70
ERROR - 2016-05-17 11:58:24 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'IS NULL
ORDER BY `distance` ASC
 LIMIT 70' at line 30 - Invalid query: SELECT CONCAT("0", "", `qyura_doctors`.`doctors_phn`) phn, `qyura_doctors`.`doctors_showExp` as `showExp`, `qyura_doctors`.`doctors_id` as `id`, `qyura_doctors`.`doctors_userId` as `userId`, CONCAT(qyura_doctors.doctors_fName, " ", qyura_doctors.doctors_lName) AS name, `qyura_doctors`.`doctors_img` `imUrl`, (
                6371 * acos( cos( radians( 22.718410 ) ) * cos( radians( doctors_lat ) ) * cos( radians( doctors_long ) - radians( 75.855896 ) ) + sin( radians( 22.718410 ) ) * sin( radians( doctors_lat ) ) )
                ) AS distance, (select MIN(docTimeTable_price) FROM qyura_docTimeTable WHERE qyura_docTimeTable.docTimeTable_doctorId = qyura_doctors.doctors_id ) as consFee, Group_concat(DISTINCT qyura_specialities.specialities_name) as specialityName, Group_concat(DISTINCT qyura_degree.degree_SName SEPARATOR ", ") as degree, `qyura_doctors`.`doctors_lat` as `lat`, `qyura_doctors`.`doctors_long` as `long`, `qyura_doctors`.`doctors_27Src` as `isEmergency`, (YEAR("2016-05-17") - FROM_UNIXTIME(qyura_doctors.doctors_expYear, "%Y")) AS exp, (
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
 AS `rating`
FROM `qyura_doctors`
LEFT JOIN `qyura_usersRoles` ON `qyura_usersRoles`.`usersRoles_userId`=`qyura_doctors`.`doctors_userId`
LEFT JOIN `qyura_doctorAcademic` ON `qyura_doctorAcademic`.`doctorAcademic_doctorsId`=`qyura_doctors`.`doctors_id`
LEFT JOIN `qyura_degree` ON `qyura_doctorAcademic`.`doctorAcademic_degreeId`=`qyura_degree`.`degree_id`
LEFT JOIN `qyura_doctorSpecialities` ON `qyura_doctorSpecialities`.`doctorSpecialities_doctorsId` = `qyura_doctors`.`doctors_id`
LEFT JOIN `qyura_specialities` ON `qyura_specialities`.`specialities_id` = `qyura_doctorSpecialities`.`doctorSpecialities_specialitiesId`
LEFT JOIN `qyura_reviews` ON `qyura_reviews`.`reviews_relateId`=`qyura_doctors`.`doctors_userId`
LEFT JOIN `qyura_ratings` ON `qyura_ratings`.`rating_relateId`=`qyura_doctors`.`doctors_userId`
WHERE `doctors_deleted` =0
AND `usersRoles_roleId` = 4
AND `qyura_doctors`.`doctors_27Src` = '1'
AND `doctors_id` NOT IN('28', '30', '58', '59', '31', '50', '27', '48', '62', '43', '49', '51', '53', '57', '29', '46', '55')
AND `doctors_cityId` = '705'
GROUP BY `doctors_id`
HAVING  IS NULL
ORDER BY `distance` ASC
 LIMIT 70
ERROR - 2016-05-17 12:07:52 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'IS NULL
ORDER BY `distance` ASC
 LIMIT 70' at line 30 - Invalid query: SELECT CONCAT("0", "", `qyura_doctors`.`doctors_phn`) phn, `qyura_doctors`.`doctors_showExp` as `showExp`, `qyura_doctors`.`doctors_id` as `id`, `qyura_doctors`.`doctors_userId` as `userId`, CONCAT(qyura_doctors.doctors_fName, " ", qyura_doctors.doctors_lName) AS name, `qyura_doctors`.`doctors_img` `imUrl`, (
                6371 * acos( cos( radians( 22.718410 ) ) * cos( radians( doctors_lat ) ) * cos( radians( doctors_long ) - radians( 75.855896 ) ) + sin( radians( 22.718410 ) ) * sin( radians( doctors_lat ) ) )
                ) AS distance, (select MIN(docTimeTable_price) FROM qyura_docTimeTable WHERE qyura_docTimeTable.docTimeTable_doctorId = qyura_doctors.doctors_id ) as consFee, Group_concat(DISTINCT qyura_specialities.specialities_name) as specialityName, Group_concat(DISTINCT qyura_degree.degree_SName SEPARATOR ", ") as degree, `qyura_doctors`.`doctors_lat` as `lat`, `qyura_doctors`.`doctors_long` as `long`, `qyura_doctors`.`doctors_27Src` as `isEmergency`, (YEAR("2016-05-17") - FROM_UNIXTIME(qyura_doctors.doctors_expYear, "%Y")) AS exp, (
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
 AS `rating`
FROM `qyura_doctors`
LEFT JOIN `qyura_usersRoles` ON `qyura_usersRoles`.`usersRoles_userId`=`qyura_doctors`.`doctors_userId`
LEFT JOIN `qyura_doctorAcademic` ON `qyura_doctorAcademic`.`doctorAcademic_doctorsId`=`qyura_doctors`.`doctors_id`
LEFT JOIN `qyura_degree` ON `qyura_doctorAcademic`.`doctorAcademic_degreeId`=`qyura_degree`.`degree_id`
LEFT JOIN `qyura_doctorSpecialities` ON `qyura_doctorSpecialities`.`doctorSpecialities_doctorsId` = `qyura_doctors`.`doctors_id`
LEFT JOIN `qyura_specialities` ON `qyura_specialities`.`specialities_id` = `qyura_doctorSpecialities`.`doctorSpecialities_specialitiesId`
LEFT JOIN `qyura_reviews` ON `qyura_reviews`.`reviews_relateId`=`qyura_doctors`.`doctors_userId`
LEFT JOIN `qyura_ratings` ON `qyura_ratings`.`rating_relateId`=`qyura_doctors`.`doctors_userId`
WHERE `doctors_deleted` =0
AND `usersRoles_roleId` = 4
AND `qyura_doctors`.`doctors_27Src` = '1'
AND `doctors_id` NOT IN('28', '30', '58', '59', '31', '50', '27', '48', '62', '43', '49', '51', '53', '57', '29', '46', '55')
AND `doctors_cityId` = '705'
GROUP BY `doctors_id`
HAVING  IS NULL
ORDER BY `distance` ASC
 LIMIT 70
ERROR - 2016-05-17 12:07:59 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'IS NULL
ORDER BY `distance` ASC
 LIMIT 70' at line 30 - Invalid query: SELECT CONCAT("0", "", `qyura_doctors`.`doctors_phn`) phn, `qyura_doctors`.`doctors_showExp` as `showExp`, `qyura_doctors`.`doctors_id` as `id`, `qyura_doctors`.`doctors_userId` as `userId`, CONCAT(qyura_doctors.doctors_fName, " ", qyura_doctors.doctors_lName) AS name, `qyura_doctors`.`doctors_img` `imUrl`, (
                6371 * acos( cos( radians( 22.718410 ) ) * cos( radians( doctors_lat ) ) * cos( radians( doctors_long ) - radians( 75.855896 ) ) + sin( radians( 22.718410 ) ) * sin( radians( doctors_lat ) ) )
                ) AS distance, (select MIN(docTimeTable_price) FROM qyura_docTimeTable WHERE qyura_docTimeTable.docTimeTable_doctorId = qyura_doctors.doctors_id ) as consFee, Group_concat(DISTINCT qyura_specialities.specialities_name) as specialityName, Group_concat(DISTINCT qyura_degree.degree_SName SEPARATOR ", ") as degree, `qyura_doctors`.`doctors_lat` as `lat`, `qyura_doctors`.`doctors_long` as `long`, `qyura_doctors`.`doctors_27Src` as `isEmergency`, (YEAR("2016-05-17") - FROM_UNIXTIME(qyura_doctors.doctors_expYear, "%Y")) AS exp, (
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
 AS `rating`
FROM `qyura_doctors`
LEFT JOIN `qyura_usersRoles` ON `qyura_usersRoles`.`usersRoles_userId`=`qyura_doctors`.`doctors_userId`
LEFT JOIN `qyura_doctorAcademic` ON `qyura_doctorAcademic`.`doctorAcademic_doctorsId`=`qyura_doctors`.`doctors_id`
LEFT JOIN `qyura_degree` ON `qyura_doctorAcademic`.`doctorAcademic_degreeId`=`qyura_degree`.`degree_id`
LEFT JOIN `qyura_doctorSpecialities` ON `qyura_doctorSpecialities`.`doctorSpecialities_doctorsId` = `qyura_doctors`.`doctors_id`
LEFT JOIN `qyura_specialities` ON `qyura_specialities`.`specialities_id` = `qyura_doctorSpecialities`.`doctorSpecialities_specialitiesId`
LEFT JOIN `qyura_reviews` ON `qyura_reviews`.`reviews_relateId`=`qyura_doctors`.`doctors_userId`
LEFT JOIN `qyura_ratings` ON `qyura_ratings`.`rating_relateId`=`qyura_doctors`.`doctors_userId`
WHERE `doctors_deleted` =0
AND `usersRoles_roleId` = 4
AND `qyura_doctors`.`doctors_27Src` = '1'
AND `doctors_id` NOT IN('28', '30', '58', '59', '31', '50', '27', '48', '62', '43', '49', '51', '53', '57', '29', '46', '55')
AND `doctors_cityId` = '705'
GROUP BY `doctors_id`
HAVING  IS NULL
ORDER BY `distance` ASC
 LIMIT 70
ERROR - 2016-05-17 12:08:20 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'IS NULL
ORDER BY `distance` ASC
 LIMIT 70' at line 30 - Invalid query: SELECT CONCAT("0", "", `qyura_doctors`.`doctors_phn`) phn, `qyura_doctors`.`doctors_showExp` as `showExp`, `qyura_doctors`.`doctors_id` as `id`, `qyura_doctors`.`doctors_userId` as `userId`, CONCAT(qyura_doctors.doctors_fName, " ", qyura_doctors.doctors_lName) AS name, `qyura_doctors`.`doctors_img` `imUrl`, (
                6371 * acos( cos( radians( 22.718410 ) ) * cos( radians( doctors_lat ) ) * cos( radians( doctors_long ) - radians( 75.855896 ) ) + sin( radians( 22.718410 ) ) * sin( radians( doctors_lat ) ) )
                ) AS distance, (select MIN(docTimeTable_price) FROM qyura_docTimeTable WHERE qyura_docTimeTable.docTimeTable_doctorId = qyura_doctors.doctors_id ) as consFee, Group_concat(DISTINCT qyura_specialities.specialities_name) as specialityName, Group_concat(DISTINCT qyura_degree.degree_SName SEPARATOR ", ") as degree, `qyura_doctors`.`doctors_lat` as `lat`, `qyura_doctors`.`doctors_long` as `long`, `qyura_doctors`.`doctors_27Src` as `isEmergency`, (YEAR("2016-05-17") - FROM_UNIXTIME(qyura_doctors.doctors_expYear, "%Y")) AS exp, (
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
 AS `rating`
FROM `qyura_doctors`
LEFT JOIN `qyura_usersRoles` ON `qyura_usersRoles`.`usersRoles_userId`=`qyura_doctors`.`doctors_userId`
LEFT JOIN `qyura_doctorAcademic` ON `qyura_doctorAcademic`.`doctorAcademic_doctorsId`=`qyura_doctors`.`doctors_id`
LEFT JOIN `qyura_degree` ON `qyura_doctorAcademic`.`doctorAcademic_degreeId`=`qyura_degree`.`degree_id`
LEFT JOIN `qyura_doctorSpecialities` ON `qyura_doctorSpecialities`.`doctorSpecialities_doctorsId` = `qyura_doctors`.`doctors_id`
LEFT JOIN `qyura_specialities` ON `qyura_specialities`.`specialities_id` = `qyura_doctorSpecialities`.`doctorSpecialities_specialitiesId`
LEFT JOIN `qyura_reviews` ON `qyura_reviews`.`reviews_relateId`=`qyura_doctors`.`doctors_userId`
LEFT JOIN `qyura_ratings` ON `qyura_ratings`.`rating_relateId`=`qyura_doctors`.`doctors_userId`
WHERE `doctors_deleted` =0
AND `usersRoles_roleId` = 4
AND `qyura_doctors`.`doctors_27Src` = '1'
AND `doctors_id` NOT IN('28', '30', '58', '59', '31', '50', '27', '48', '62', '43', '49', '51', '53', '57', '29', '46', '55')
AND `doctors_cityId` = '705'
GROUP BY `doctors_id`
HAVING  IS NULL
ORDER BY `distance` ASC
 LIMIT 70
ERROR - 2016-05-17 12:08:30 --> Query error: Unknown column 'rat' in 'having clause' - Invalid query: SELECT CONCAT("0", "", `qyura_doctors`.`doctors_phn`) phn, `qyura_doctors`.`doctors_showExp` as `showExp`, `qyura_doctors`.`doctors_id` as `id`, `qyura_doctors`.`doctors_userId` as `userId`, CONCAT(qyura_doctors.doctors_fName, " ", qyura_doctors.doctors_lName) AS name, `qyura_doctors`.`doctors_img` `imUrl`, (
                6371 * acos( cos( radians( 22.718410 ) ) * cos( radians( doctors_lat ) ) * cos( radians( doctors_long ) - radians( 75.855896 ) ) + sin( radians( 22.718410 ) ) * sin( radians( doctors_lat ) ) )
                ) AS distance, (select MIN(docTimeTable_price) FROM qyura_docTimeTable WHERE qyura_docTimeTable.docTimeTable_doctorId = qyura_doctors.doctors_id ) as consFee, Group_concat(DISTINCT qyura_specialities.specialities_name) as specialityName, Group_concat(DISTINCT qyura_degree.degree_SName SEPARATOR ", ") as degree, `qyura_doctors`.`doctors_lat` as `lat`, `qyura_doctors`.`doctors_long` as `long`, `qyura_doctors`.`doctors_27Src` as `isEmergency`, (YEAR("2016-05-17") - FROM_UNIXTIME(qyura_doctors.doctors_expYear, "%Y")) AS exp, (
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
 AS `rating`
FROM `qyura_doctors`
LEFT JOIN `qyura_usersRoles` ON `qyura_usersRoles`.`usersRoles_userId`=`qyura_doctors`.`doctors_userId`
LEFT JOIN `qyura_doctorAcademic` ON `qyura_doctorAcademic`.`doctorAcademic_doctorsId`=`qyura_doctors`.`doctors_id`
LEFT JOIN `qyura_degree` ON `qyura_doctorAcademic`.`doctorAcademic_degreeId`=`qyura_degree`.`degree_id`
LEFT JOIN `qyura_doctorSpecialities` ON `qyura_doctorSpecialities`.`doctorSpecialities_doctorsId` = `qyura_doctors`.`doctors_id`
LEFT JOIN `qyura_specialities` ON `qyura_specialities`.`specialities_id` = `qyura_doctorSpecialities`.`doctorSpecialities_specialitiesId`
LEFT JOIN `qyura_reviews` ON `qyura_reviews`.`reviews_relateId`=`qyura_doctors`.`doctors_userId`
LEFT JOIN `qyura_ratings` ON `qyura_ratings`.`rating_relateId`=`qyura_doctors`.`doctors_userId`
WHERE `doctors_deleted` =0
AND `usersRoles_roleId` = 4
AND `usersRoles_parentId` =0
AND `qyura_specialities`.`specialities_id` = '38'
AND `doctors_id` NOT IN('')
AND `doctors_cityId` = '705'
GROUP BY `doctors_id`
HAVING `rat` >= '4'
ORDER BY `distance` ASC
 LIMIT 70
ERROR - 2016-05-17 12:08:44 --> Query error: Unknown column 'rat' in 'having clause' - Invalid query: SELECT CONCAT("0", "", `qyura_doctors`.`doctors_phn`) phn, `qyura_doctors`.`doctors_showExp` as `showExp`, `qyura_doctors`.`doctors_id` as `id`, `qyura_doctors`.`doctors_userId` as `userId`, CONCAT(qyura_doctors.doctors_fName, " ", qyura_doctors.doctors_lName) AS name, `qyura_doctors`.`doctors_img` `imUrl`, (
                6371 * acos( cos( radians( 22.718410 ) ) * cos( radians( doctors_lat ) ) * cos( radians( doctors_long ) - radians( 75.855896 ) ) + sin( radians( 22.718410 ) ) * sin( radians( doctors_lat ) ) )
                ) AS distance, (select MIN(docTimeTable_price) FROM qyura_docTimeTable WHERE qyura_docTimeTable.docTimeTable_doctorId = qyura_doctors.doctors_id ) as consFee, Group_concat(DISTINCT qyura_specialities.specialities_name) as specialityName, Group_concat(DISTINCT qyura_degree.degree_SName SEPARATOR ", ") as degree, `qyura_doctors`.`doctors_lat` as `lat`, `qyura_doctors`.`doctors_long` as `long`, `qyura_doctors`.`doctors_27Src` as `isEmergency`, (YEAR("2016-05-17") - FROM_UNIXTIME(qyura_doctors.doctors_expYear, "%Y")) AS exp, (
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
 AS `rating`
FROM `qyura_doctors`
LEFT JOIN `qyura_usersRoles` ON `qyura_usersRoles`.`usersRoles_userId`=`qyura_doctors`.`doctors_userId`
LEFT JOIN `qyura_doctorAcademic` ON `qyura_doctorAcademic`.`doctorAcademic_doctorsId`=`qyura_doctors`.`doctors_id`
LEFT JOIN `qyura_degree` ON `qyura_doctorAcademic`.`doctorAcademic_degreeId`=`qyura_degree`.`degree_id`
LEFT JOIN `qyura_doctorSpecialities` ON `qyura_doctorSpecialities`.`doctorSpecialities_doctorsId` = `qyura_doctors`.`doctors_id`
LEFT JOIN `qyura_specialities` ON `qyura_specialities`.`specialities_id` = `qyura_doctorSpecialities`.`doctorSpecialities_specialitiesId`
LEFT JOIN `qyura_reviews` ON `qyura_reviews`.`reviews_relateId`=`qyura_doctors`.`doctors_userId`
LEFT JOIN `qyura_ratings` ON `qyura_ratings`.`rating_relateId`=`qyura_doctors`.`doctors_userId`
WHERE `doctors_deleted` =0
AND `usersRoles_roleId` = 4
AND `usersRoles_parentId` =0
AND `qyura_specialities`.`specialities_id` = '38'
AND `doctors_id` NOT IN('')
AND `doctors_cityId` = '705'
GROUP BY `doctors_id`
HAVING `rat` >= '4'
ORDER BY `distance` ASC
 LIMIT 70
ERROR - 2016-05-17 12:14:47 --> 404 Page Not Found: ../modules/auth/controllers/Auth/assets
ERROR - 2016-05-17 12:14:58 --> 404 Page Not Found: /index
ERROR - 2016-05-17 12:20:20 --> Query error: Unknown column 'rat' in 'having clause' - Invalid query: SELECT CONCAT("0", "", `qyura_doctors`.`doctors_phn`) phn, `qyura_doctors`.`doctors_showExp` as `showExp`, `qyura_doctors`.`doctors_id` as `id`, `qyura_doctors`.`doctors_userId` as `userId`, CONCAT(qyura_doctors.doctors_fName, " ", qyura_doctors.doctors_lName) AS name, `qyura_doctors`.`doctors_img` `imUrl`, (
                6371 * acos( cos( radians( 22.718410 ) ) * cos( radians( doctors_lat ) ) * cos( radians( doctors_long ) - radians( 75.855896 ) ) + sin( radians( 22.718410 ) ) * sin( radians( doctors_lat ) ) )
                ) AS distance, (select MIN(docTimeTable_price) FROM qyura_docTimeTable WHERE qyura_docTimeTable.docTimeTable_doctorId = qyura_doctors.doctors_id ) as consFee, Group_concat(DISTINCT qyura_specialities.specialities_name) as specialityName, Group_concat(DISTINCT qyura_degree.degree_SName SEPARATOR ", ") as degree, `qyura_doctors`.`doctors_lat` as `lat`, `qyura_doctors`.`doctors_long` as `long`, `qyura_doctors`.`doctors_27Src` as `isEmergency`, (YEAR("2016-05-17") - FROM_UNIXTIME(qyura_doctors.doctors_expYear, "%Y")) AS exp, (
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
 AS `rating`
FROM `qyura_doctors`
LEFT JOIN `qyura_usersRoles` ON `qyura_usersRoles`.`usersRoles_userId`=`qyura_doctors`.`doctors_userId`
LEFT JOIN `qyura_doctorAcademic` ON `qyura_doctorAcademic`.`doctorAcademic_doctorsId`=`qyura_doctors`.`doctors_id`
LEFT JOIN `qyura_degree` ON `qyura_doctorAcademic`.`doctorAcademic_degreeId`=`qyura_degree`.`degree_id`
LEFT JOIN `qyura_doctorSpecialities` ON `qyura_doctorSpecialities`.`doctorSpecialities_doctorsId` = `qyura_doctors`.`doctors_id`
LEFT JOIN `qyura_specialities` ON `qyura_specialities`.`specialities_id` = `qyura_doctorSpecialities`.`doctorSpecialities_specialitiesId`
LEFT JOIN `qyura_reviews` ON `qyura_reviews`.`reviews_relateId`=`qyura_doctors`.`doctors_userId`
LEFT JOIN `qyura_ratings` ON `qyura_ratings`.`rating_relateId`=`qyura_doctors`.`doctors_userId`
WHERE `doctors_deleted` =0
AND `usersRoles_roleId` = 4
AND `usersRoles_parentId` =0
AND `qyura_specialities`.`specialities_id` = '38'
AND `doctors_id` NOT IN('')
AND `doctors_cityId` = '705'
GROUP BY `doctors_id`
HAVING `rat` >= '4'
ORDER BY `distance` ASC
 LIMIT 70
