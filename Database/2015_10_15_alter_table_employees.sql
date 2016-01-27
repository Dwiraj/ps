ALTER TABLE  `employees` ADD  `salutation` VARCHAR( 10 ) NULL DEFAULT NULL AFTER  `employee_id` ,
ADD  `father_name` VARCHAR( 255 ) NULL DEFAULT NULL AFTER  `salutation` ,
ADD  `mother_name` VARCHAR( 255 ) NULL DEFAULT NULL AFTER  `father_name` ,
ADD  `qualification` TEXT NULL DEFAULT NULL AFTER  `mother_name` ,
ADD  `comment` TEXT NULL DEFAULT NULL AFTER  `qualification`,

ALTER TABLE  `employees` CHANGE  `bank_account_no`  `bank_account_no` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,

ALTER TABLE  `employees` CHANGE  `position`  `position` ENUM(  'Trainee',  'Web Developer',  'Senior Web Developer',  'Project Manager',  'HR Manager',  'NULL', 'Receptionist',  'Accountant',  'Mobile Developer',  'UI Developer',  'Senior UI Developer',  'HR Executive',  'Business Development Executive',  'SEO Executive', 'Software Engineer' ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,

