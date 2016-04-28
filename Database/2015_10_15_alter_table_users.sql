ALTER TABLE  `users` ADD  `salutation` VARCHAR( 10 ) NULL DEFAULT NULL AFTER  `password` ,
ADD  `father_name` VARCHAR( 255 ) NULL DEFAULT NULL AFTER  `salutation` ,
ADD  `mother_name` VARCHAR( 255 ) NULL DEFAULT NULL AFTER  `father_name` ,
ADD  `salary` decimal(7,0) DEFAULT NULL AFTER  `mother_name` ,
ADD  `position` ENUM(  'Trainee',  'Web Developer',  'Senior Web Developer',  'Project Manager',  'HR Manager',  'NULL', 'Receptionist',  'Accountant',  'Mobile Developer',  'UI Developer',  'Senior UI Developer',  'HR Executive',  'Business Development Executive',  'SEO Executive', 'Software Engineer' ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL AFTER  `salary` ,
ADD  `qualification` TEXT NULL DEFAULT NULL AFTER  `position`,
ADD  `comment` TEXT NULL DEFAULT NULL AFTER  `qualification`,
ADD  `start_date` date DEFAULT NULL AFTER  `comment`,
ADD  `current_status` enum('Working','Resigned','NULL') DEFAULT NULL AFTER  `start_date`,
ADD  `end_date` date DEFAULT NULL AFTER  `current_status`,
ADD  `dob` date DEFAULT NULL AFTER  `end_date`,
ADD  `address` varchar(255) DEFAULT NULL AFTER  `dob`,
ADD  `phone_no` varchar(20) DEFAULT NULL AFTER  `address`,
ADD  `alternate_no` varchar(20) DEFAULT NULL AFTER  `phone_no`,
ADD  `pan_no` varchar(20) DEFAULT NULL AFTER  `alternate_no`,
ADD  `bank_account_no` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL AFTER  `pan_no`,
ADD  `profile_picture` varchar(255) DEFAULT NULL AFTER  `bank_account_no`
