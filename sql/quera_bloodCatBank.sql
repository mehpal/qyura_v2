SET foreign_key_checks = 0;
DROP TABLE IF EXISTS `qyura_healthPackage-includes`;
DROP TABLE IF EXISTS `qyura_healthPackageIncludes`;
CREATE TABLE IF NOT EXISTS `qyura_healthPackageIncludes` (
  `healthPackageIncludes_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `healthPackageIncludes_healthPackageId` int(11) unsigned NOT NULL,
  `HealthPackageIncludes_test` int(11) NOT NULL,
  `healthPackageIncludes_deleted` tinyint(1) DEFAULT '0' COMMENT '1 fro deleted  1 for not deleted',
  `creationTime` bigint(20) NOT NULL,
  `modifyTime` bigint(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`healthPackageIncludes_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `qyura_healthPackage-includes`
--
ALTER TABLE `qyura_healthPackageIncludes`
  ADD CONSTRAINT `qyura_healthPackageIncludes_ibfk_1` FOREIGN KEY (`healthPackageIncludes_healthPackageId`) REFERENCES `qyura_healthPackageIncludes` (`healthPackageIncludes_id`) ON DELETE CASCADE ON UPDATE CASCADE;



DROP TABLE IF EXISTS `qyura_quotationDetail-patient`;
DROP TABLE IF EXISTS `qyura_quotationDetailPatient`;
CREATE TABLE IF NOT EXISTS `qyura_quotationDetailPatient` (
  `quotationDetailPatient_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `quotationDetailPatient_quotationDetailId` int(11) unsigned NOT NULL,
  `quotationDetailPatient_name` varchar(50) DEFAULT NULL,
  `quotationDetailPatient_gender` tinyint(1) NOT NULL DEFAULT '1',
  `quotationDetailPatient_age` tinyint(4) NOT NULL,
  `quotationDetailPatient_phone` varchar(20) DEFAULT NULL,
  `quotationDetailPatient_emailId` varchar(25) DEFAULT NULL,
  `quotationDetailPatient_totalPrice` double(9,2) NOT NULL,
  `quotationDetailPatient_deleted` tinyint(1) DEFAULT '0' COMMENT '1 fro deleted  1 for not deleted',
  `creationTime` bigint(20) NOT NULL,
  `modifyTime` bigint(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`quotationDetailPatient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--


--
ALTER TABLE `qyura_quotationDetailPatient`
  ADD CONSTRAINT `qyura_quotationDetailPatient_ibfk_1` FOREIGN KEY (`quotationDetailPatient_quotationDetailId`) REFERENCES `qyura_quotationDetail` (`quotationDetail_id`) ON DELETE CASCADE ON UPDATE CASCADE;




DROP TABLE IF EXISTS `qyura_quotationDetail-tests`;
DROP TABLE IF EXISTS `qyura_quotationDetailTests`;
CREATE TABLE IF NOT EXISTS `qyura_quotationDetailTests` (
  `quotationDetailTests_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `quotationDetailTests_quotationDetailId` int(11) unsigned NOT NULL,
  `quotationDetailTests_diagnosticType` int(6) NOT NULL,
  `quotationDetailTests_testName` int(6) NOT NULL,
  `quotationDetailTests_date` bigint(20) NOT NULL,
  `quotationDetailTests_timing` int(10) NOT NULL,
  `quotationDetailTests_price` double(9,2) NOT NULL,
  `quotationDetailTests_instruction` text NOT NULL,
  `quotationDetailTests_deleted` tinyint(1) DEFAULT '0' COMMENT '1 fro deleted  1 for not deleted',
  `creationTime` bigint(20) NOT NULL,
  `modifyTime` bigint(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`quotationDetailTests_id`),
  KEY `quotationDetailTests_quotationDetailId` (`quotationDetailTests_quotationDetailId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--


ALTER TABLE `qyura_quotationDetailTests`
  ADD CONSTRAINT `qyura_quotationDetailTests_ibfk_1` FOREIGN KEY (`quotationDetailTests_quotationDetailId`) REFERENCES `qyura_quotationDetail` (`quotationDetail_id`) ON DELETE CASCADE ON UPDATE CASCADE;





DROP TABLE IF EXISTS `qyura_bloodBank`;
CREATE TABLE IF NOT EXISTS `qyura_bloodBank` (
  `bloodBank_id` int(11) unsigned NOT NULL COMMENT 'Blood Bank  auto pk',
  `users_id` int(11) unsigned NOT NULL DEFAULT '0',
  `countryId` tinyint(4) unsigned NOT NULL,
  `stateId` tinyint(4) unsigned NOT NULL,
  `cityId` int(11) unsigned NOT NULL,
  `bloodBank_name` varchar(80) NOT NULL COMMENT 'Blood Bank  Name',
  `bloodBank_add` tinytext NOT NULL COMMENT 'Address',
  `bloodBank_phn` varchar(90) NOT NULL COMMENT 'Phone max 5',
  `bloodBank_photo` varchar(80) NOT NULL,
  `bloodBank_cntPrsn` varchar(40) NOT NULL COMMENT 'Contact Person',
  `bloodBank_dsgn` varchar(60) NOT NULL COMMENT 'Designation',
  `bloodBank_mbrTyp` tinyint(4) NOT NULL COMMENT 'Membership Type',
  `bloodBank_email` varchar(255) NOT NULL COMMENT 'Email Id',
  `bloodBank_mblNo` varchar(20) NOT NULL COMMENT 'Registered Mobile no.',
  `bloodBank_pass` varchar(255) NOT NULL COMMENT 'Enter Password',
  `bloodBank_lat` float(10,6) NOT NULL,
  `bloodBank_long` float(10,6) NOT NULL,
  `bloodBank_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `creationTime` int(10) NOT NULL,
  `modifyTime` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`bloodBank_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `qyura_bloodBank`
--

INSERT INTO `qyura_bloodBank` (`bloodBank_id`, `users_id`, `countryId`, `stateId`, `cityId`, `bloodBank_name`, `bloodBank_add`, `bloodBank_phn`, `bloodBank_photo`, `bloodBank_cntPrsn`, `bloodBank_dsgn`, `bloodBank_mbrTyp`, `bloodBank_email`, `bloodBank_mblNo`, `bloodBank_pass`, `bloodBank_lat`, `bloodBank_long`, `bloodBank_deleted`, `creationTime`, `modifyTime`, `status`) VALUES
(1, 1, 1, 11, 705, 'Maharaja Yeshwantrao Hospital ', 'LG-9, A B Road, M Y Road, Indore - 452001, Scheme No 54', '7312438100', 'BB1.jpg', 'Yeshwant Rao', 'Owner', 2, 'yeshwant_rao@gmail.com', '9425091210', 'qyura123', 22.755871, 75.887260, 0, 1453295430, 0, 0),
(2, 2, 1, 11, 705, 'Arihant Hospital & Research Center', '283/ A, Gumasta Nagar, Indore - 452009, Scheme No 71', '7312785172', 'BB2.jpg', 'Arihant Jain', 'Owner', 1, 'arihant_jain@yahoo.com', '8109813126', 'qyura123', 22.700989, 75.829834, 0, 1453295430, 0, 0),
(3, 3, 1, 11, 705, 'Life Line Hospital', '14, A B Road, MIG Main Road, Indore - 452011, MIG Circle, Anoop Nagar ', '7312443400', 'BB3.jpg', 'Rahul Singh', 'Owner', 2, 'rahulsingh@gmail.com', '7312575611', 'qyura123', 22.733767, 75.890091, 0, 1453295430, 0, 0),
(4, 4, 1, 11, 705, 'Verma Union Hospital', '120, Dhar Road, Indore - 452002, Opposite Kastoor Cinema ', '7312380609', 'BB4.jpg', 'Arun Verma', 'Owner', 1, 'vermaarun@gmail.com', '9827025001', 'qyura123', 22.711952, 75.838127, 0, 1453295430, 0, 0),
(5, 5, 1, 11, 705, 'Noble Path Lab & Blood Bank', 'South Tukoganj, Indore - 452001, Opposite Nath Mandir ', '7312522970', 'BB5.jpg', 'Nilesh Kedia', 'Owner', 1, 'ph.nilesh@gmail.com', '8109433126', 'qyura123', 22.717981, 75.874710, 0, 1453295430, 0, 0),
(6, 6, 1, 11, 705, 'Satya Sai Blood Bank', '64, Kanadia Road, Indore - 452016, Mahavir Nagar', '7312590737', 'BB6.jpg', 'Satyendra Singh', 'Owner', 1, 'satsen@gmail.com', '9827025789', 'qyura123', 22.720676, 75.900597, 0, 1453295430, 0, 0),
(7, 7, 1, 11, 705, 'Christian Hospital ', '2, Chhawani, Indore - 452001, Murai Mohalla ', '7312700196', 'BB7.jpg', 'Joseph D''souza', 'Owner', 2, 'joseph.dsou@gmail.com', '7312455611', 'qyura123', 22.707655, 75.875320, 0, 1453295430, 0, 0),
(8, 8, 1, 11, 705, 'Engineers Blood Organization', 'L I G Colony, Indore – 452001', '7316790737', 'BB8.jpg', 'Avinash Pandey', 'Owner', 2, 'avi_pand@gmail.com', '7612578911', 'qyura123', 22.723366, 75.902946, 0, 1453295430, 0, 0),
(9, 9, 1, 11, 705, 'Modern Pathology & Blood Bank', '160 Gym Land Theatre, Mhow, Indore - 453441 ', '7324271255', 'BB9.jpg', 'Vishal Kothari', 'Owner', 2, 'vishal03ko@gmail.com', '9826064696', 'qyura123', 22.552437, 75.756531, 0, 1453295430, 0, 0),
(10, 10, 1, 11, 705, 'Curewell Blood Bank', '19/1-C, New Palasia, Indore - 452001 ', '7312434445', 'BB10.jpg', 'Veronica Chawla', 'Owner', 1, 'rochellerao@gmail.com', '7315675611', 'qyura123', 22.727219, 75.882675, 0, 1453295430, 0, 0),
(11, 11, 1, 11, 705, 'Shubham Blood Bank', '51, Jhod Colony, Khajrana, Indore - 452016, Shir Nagar Extension ', '7312563202', 'BB11.jpg', 'Kalpana Kolhapuri', 'Owner', 1, 'shubhamsingh@gmail.com', '9425063126', 'qyura123', 22.731457, 75.914391, 0, 1453295430, 0, 0),
(12, 12, 1, 11, 705, 'Singhvi Blood Bank ', 'Plot No 108-110, 1st Floor, Manas Bhawan, R N T Road, Indore - 452001, Near Canara Bank', '7312527081', 'BB12.jpg', 'Peehu Sharma', 'Owner', 1, 'piyush02singhvi@yahoo.com', '7312575611', 'qyura123', 22.716686, 75.873978, 0, 1453295430, 0, 0),
(13, 13, 1, 11, 705, 'Vishnu Prabha Blood Bank', '3/2, South Tukoganj, Indore - 452001, Behind Hotel Balwas ', '7312511450', 'BB13.jpeg', 'Rishi Dey', 'Owner', 2, 'vishnudev23@yahoo.com', '9827351240', 'qyura123', 22.720976, 75.881508, 0, 1453295430, 0, 0),
(14, 14, 1, 11, 705, 'Shubham Pathological Diagnostic Centre Blood Bank', '51 Shrinagar Extension, Khajrana Road, Indore Gpo, Indore - 452001, Near Royal Hospital ', '7312563202', 'BB14.jpg', 'Shubham Jain', 'Owner', 1, 'sushi34@gmail.com', '9827333573', 'qyura123', 22.708195, 75.882439, 0, 1453295430, 0, 0),
(15, 15, 1, 11, 705, 'Punjab National Blood Bank', 'Distt Ujjain, Ujjain Road, Indore - 453551 ', '7312560440', 'BB15.jpg', 'Prakash Sharma', 'Owner', 2, 'punjabblood@gmail.com', '7312225568', 'qyura123', 22.956486, 75.839478, 0, 1453295430, 0, 0);




DROP TABLE IF EXISTS `quera_bloodCatBank`;
CREATE TABLE IF NOT EXISTS `quera_bloodCatBank` (
  `bloodCat-Bank_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bloodBank_id` int(10) NOT NULL COMMENT 'Blood bank auto incremented id,how many blood categories are selected,same counted rows will be created,but this id remains same',
  `bloodCats_id` int(10) NOT NULL COMMENT 'selected blood category auto increment id',
  `bloodCat-Bank_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `creationTime` int(10) NOT NULL,
  `modifyTime` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`bloodCat-Bank_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='This table is create for mapping Blood bank and available Blood Category ' AUTO_INCREMENT=113 ;

--
-- Dumping data for table `quera_bloodCatBank`
--

INSERT INTO `quera_bloodCatBank` (`bloodCat-Bank_id`, `bloodBank_id`, `bloodCats_id`, `bloodCat-Bank_deleted`, `creationTime`, `modifyTime`, `status`) VALUES
(1, 1, 1, 1, 1453970562, 0, 0),
(2, 1, 2, 0, 1453970562, 0, 0),
(3, 1, 3, 0, 1453970562, 0, 0),
(4, 1, 4, 0, 1453970562, 0, 0),
(5, 1, 5, 0, 1453970562, 0, 0),
(6, 1, 6, 0, 1453970562, 0, 0),
(7, 1, 7, 0, 1453970562, 0, 0),
(8, 1, 8, 0, 1453970562, 0, 0),
(9, 2, 1, 1, 1453970562, 0, 0),
(10, 2, 2, 0, 1453970562, 0, 0),
(11, 2, 3, 0, 1453970562, 0, 0),
(12, 2, 4, 0, 1453970562, 0, 0),
(13, 2, 5, 0, 1453970562, 0, 0),
(14, 2, 6, 0, 1453970562, 0, 0),
(15, 2, 7, 0, 1453970562, 0, 0),
(16, 2, 8, 0, 1453970562, 0, 0),
(17, 3, 1, 0, 1453970562, 0, 0),
(18, 3, 2, 0, 1453970562, 0, 0),
(19, 3, 3, 0, 1453970562, 0, 0),
(20, 3, 4, 0, 1453970562, 0, 0),
(21, 3, 5, 0, 1453970562, 0, 0),
(22, 3, 6, 0, 1453970562, 0, 0),
(23, 3, 7, 0, 1453970562, 0, 0),
(24, 3, 8, 0, 1453970562, 0, 0),
(25, 4, 1, 0, 1453970563, 0, 0),
(26, 4, 2, 0, 1453970563, 0, 0),
(27, 4, 3, 0, 1453970563, 0, 0),
(28, 4, 4, 0, 1453970563, 0, 0),
(29, 4, 5, 0, 1453970563, 0, 0),
(30, 4, 6, 0, 1453970563, 0, 0),
(31, 4, 7, 0, 1453970563, 0, 0),
(32, 4, 8, 0, 1453970563, 0, 0),
(33, 5, 1, 0, 1453970563, 0, 0),
(34, 5, 2, 0, 1453970563, 0, 0),
(35, 5, 3, 0, 1453970563, 0, 0),
(36, 5, 4, 0, 1453970563, 0, 0),
(37, 5, 5, 0, 1453970563, 0, 0),
(38, 5, 6, 0, 1453970563, 0, 0),
(39, 5, 7, 0, 1453970563, 0, 0),
(40, 5, 8, 0, 1453970563, 0, 0),
(41, 6, 1, 0, 1453970563, 0, 0),
(42, 6, 2, 0, 1453970563, 0, 0),
(43, 6, 3, 0, 1453970563, 0, 0),
(44, 6, 4, 0, 1453970563, 0, 0),
(45, 6, 5, 0, 1453970563, 0, 0),
(46, 6, 6, 0, 1453970563, 0, 0),
(47, 6, 7, 0, 1453970563, 0, 0),
(48, 6, 8, 0, 1453970563, 0, 0),
(49, 7, 1, 0, 1453970563, 0, 0),
(50, 7, 2, 0, 1453970563, 0, 0),
(51, 7, 3, 0, 1453970563, 0, 0),
(52, 7, 4, 0, 1453970563, 0, 0),
(53, 7, 5, 0, 1453970563, 0, 0),
(54, 7, 6, 0, 1453970563, 0, 0),
(55, 7, 7, 0, 1453970563, 0, 0),
(56, 7, 8, 0, 1453970563, 0, 0),
(57, 8, 1, 0, 1453970563, 0, 0),
(58, 8, 2, 0, 1453970563, 0, 0),
(59, 8, 3, 0, 1453970563, 0, 0),
(60, 8, 4, 0, 1453970563, 0, 0),
(61, 8, 5, 0, 1453970563, 0, 0),
(62, 8, 6, 0, 1453970563, 0, 0),
(63, 8, 7, 0, 1453970563, 0, 0),
(64, 8, 8, 0, 1453970563, 0, 0),
(65, 9, 1, 0, 1453970564, 0, 0),
(66, 9, 2, 0, 1453970564, 0, 0),
(67, 9, 3, 0, 1453970564, 0, 0),
(68, 9, 4, 0, 1453970564, 0, 0),
(69, 9, 5, 0, 1453970564, 0, 0),
(70, 9, 6, 0, 1453970564, 0, 0),
(71, 9, 7, 0, 1453970564, 0, 0),
(72, 9, 8, 0, 1453970564, 0, 0),
(73, 10, 1, 0, 1453970564, 0, 0),
(74, 10, 2, 0, 1453970564, 0, 0),
(75, 10, 3, 0, 1453970564, 0, 0),
(76, 10, 4, 0, 1453970564, 0, 0),
(77, 10, 5, 0, 1453970564, 0, 0),
(78, 10, 6, 0, 1453970564, 0, 0),
(79, 10, 7, 0, 1453970564, 0, 0),
(80, 10, 8, 0, 1453970564, 0, 0),
(81, 11, 1, 0, 1453970564, 0, 0),
(82, 11, 2, 0, 1453970564, 0, 0),
(83, 11, 3, 0, 1453970564, 0, 0),
(84, 11, 4, 0, 1453970564, 0, 0),
(85, 11, 5, 0, 1453970564, 0, 0),
(86, 11, 6, 0, 1453970564, 0, 0),
(87, 11, 7, 0, 1453970564, 0, 0),
(88, 11, 8, 0, 1453970564, 0, 0),
(89, 12, 1, 0, 1453970564, 0, 0),
(90, 12, 2, 0, 1453970564, 0, 0),
(91, 12, 3, 0, 1453970564, 0, 0),
(92, 12, 4, 0, 1453970564, 0, 0),
(93, 12, 5, 0, 1453970564, 0, 0),
(94, 12, 6, 0, 1453970564, 0, 0),
(95, 12, 7, 0, 1453970564, 0, 0),
(96, 12, 8, 0, 1453970564, 0, 0),
(97, 13, 1, 0, 1453970564, 0, 0),
(98, 13, 2, 0, 1453970564, 0, 0),
(99, 13, 3, 0, 1453970564, 0, 0),
(100, 13, 4, 0, 1453970564, 0, 0),
(101, 13, 5, 0, 1453970564, 0, 0),
(102, 13, 6, 0, 1453970564, 0, 0),
(103, 13, 7, 0, 1453970564, 0, 0),
(104, 13, 8, 0, 1453970564, 0, 0),
(105, 14, 1, 0, 1453970564, 0, 0),
(106, 14, 2, 0, 1453970565, 0, 0),
(107, 14, 3, 0, 1453970565, 0, 0),
(108, 14, 4, 0, 1453970565, 0, 0),
(109, 14, 5, 0, 1453970565, 0, 0),
(110, 14, 6, 0, 1453970565, 0, 0),
(111, 14, 7, 0, 1453970565, 0, 0),
(112, 14, 8, 0, 1453970565, 0, 0);


