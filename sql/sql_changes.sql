ALTER TABLE `vsure_qyura`.`qyura_hospital` ADD COLUMN `hospital_aboutUs` TINYTEXT NOT NULL AFTER `hospital_type`; 

CREATE TABLE `qyura_services` (
  `services_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `services_name` VARCHAR(60) DEFAULT NULL COMMENT 'services name',
  `services_deleted` TINYINT(1) DEFAULT '0' COMMENT 'if is deleted flag is 1 otherwise 0',
  `creationTime` INT(11) NOT NULL,
  `modifyTime` INT(11) NOT NULL,
  `status` TINYINT(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`services_id`)
) ENGINE=INNODB  DEFAULT CHARSET=latin1


CREATE TABLE `qyura_hospitalServices` (
  `hospitalServices_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `hospitalServices_hosUserId` INT(11) UNSIGNED NOT NULL COMMENT 'Hospital Pk Id',
  `hospitalServices_servicesId` INT(11) UNSIGNED NOT NULL COMMENT 'Services_id Pk id',
  `hospitalServices_deleted` TINYINT(1) DEFAULT NULL,
  `creationTime` INT(10) DEFAULT NULL,
  `modifyTime` INT(10) DEFAULT NULL,
  `status` TINYINT(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`hospitalServices_id`)
) ENGINE=INNODB DEFAULT CHARSET=latin1

DROP TABLE `vsure_qyura`.`qyura_reviews-post`; 

CREATE TABLE `qyura_reviewsPost` (
  `reviewsPost_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `reviewsPost_reviewsId` INT(11) UNSIGNED NOT NULL,
  `reviewsPost_usersId` INT(11) UNSIGNED NOT NULL COMMENT 'Who posts comment for this review',
  `reviewsPost_details` VARCHAR(555) NOT NULL,
  `reviewsPost_deleted` TINYINT(1) DEFAULT '0' COMMENT '1 fro deleted  1 for not deleted',
  `creationTime` BIGINT(20) NOT NULL,
  `modifyTime` BIGINT(20) NOT NULL,
  `status` TINYINT(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`reviewsPost_id`),
  KEY `reviewsPost_reviewsId` (`reviewsPost_reviewsId`),
  CONSTRAINT `qyura_reviewsPost_ibfk_1` FOREIGN KEY (`reviewsPost_reviewsId`) REFERENCES `qyura_reviews` (`reviews_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=INNODB DEFAULT CHARSET=latin1

CREATE TABLE `qyura_hospitalDiagnosticsCat` (
  `hospitalDiagnosticsCat_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `hospitalDiagnosticsCat_hosUserId` INT(11) UNSIGNED NOT NULL COMMENT 'Hospital Pk Id',
  `hospitalDiagnosticsCat_diagnosticsCatId` INT(11) UNSIGNED NOT NULL COMMENT 'Services_id Pk id',
  `hospitalDiagnosticsCat_deleted` TINYINT(1) DEFAULT NULL,
  `creationTime` INT(10) DEFAULT NULL,
  `modifyTime` INT(10) DEFAULT NULL,
  `status` TINYINT(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`hospitalDiagnosticsCat_id`)
) ENGINE=INNODB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1

CREATE TABLE `qyura_diagnosticServices` (
	`diagnosticServices_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`diagnosticServices_dignosticUserId` INT(11) UNSIGNED NOT NULL COMMENT 'diagnostic Pk Id',
	`diagnosticServices_servicesId` INT(11) UNSIGNED NOT NULL COMMENT 'Services_id Pk id',
	`diagnosticServices_deleted` TINYINT(1) NULL DEFAULT NULL,
	`creationTime` INT(10) NULL DEFAULT NULL,
	`modifyTime` INT(10) NULL DEFAULT NULL,
	`status` TINYINT(1) NOT NULL DEFAULT '1',
	PRIMARY KEY (`diagnosticServices_id`)
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB


CREATE TABLE `qyura_diagnosticSpecialities` (
	`diagnosticSpecialities_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`diagnosticSpecialities_specialitiesId` INT(11) UNSIGNED NOT NULL COMMENT 'Specialities Pk ID',
	`diagnosticSpecialities_diagnosticUsersId` INT(11) UNSIGNED NOT NULL COMMENT 'diagnostic Pk Id',
	`diagnosticSpecialities_deleted` TINYINT(1) NULL DEFAULT NULL,
	`creationTime` INT(10) NULL DEFAULT NULL,
	`modifyTime` INT(10) NULL DEFAULT NULL,
	PRIMARY KEY (`diagnosticSpecialities_id`)
	
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB

ALTER TABLE `qyura_healthPackageIncludes`
	ADD COLUMN `healthPackage_diagnosticCategoryId` INT(11) UNSIGNED NOT NULL AFTER `healthPackageIncludes_healthPackageId`;

ALTER TABLE `qyura_healthPackage`
	CHANGE COLUMN `healthPackage_Miname` `healthPackage_Miname` INT(11) UNSIGNED NOT NULL AFTER `healthPackage_cityId`;
ALTER TABLE `qyura_healthPackage`
	CHANGE COLUMN `healthPackage_Miname` `healthPackage_MIuserId` INT(11) UNSIGNED NOT NULL AFTER `healthPackage_cityId`;


ALTER TABLE `qyura_usersRoles`
	ADD COLUMN `usersRoles_parentId` INT(11) UNSIGNED NOT NULL AFTER `usersRoles_roleId`;

