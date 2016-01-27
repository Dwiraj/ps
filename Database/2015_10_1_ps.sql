-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 14, 2015 at 11:29 AM
-- Server version: 5.5.44
-- PHP Version: 5.4.45-1+deb.sury.org~precise+1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ps`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) unsigned NOT NULL,
  `salary` decimal(7,0) DEFAULT NULL,
  `position` enum('Trainee','Web Developer','Senior Web Developer','Project Manager','HR Manager','NULL') DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `current_status` enum('Working','Resigned','NULL') DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone_no` varchar(20) DEFAULT NULL,
  `alternate_no` varchar(20) DEFAULT NULL,
  `pan_no` varchar(20) DEFAULT NULL,
  `bank_account_no` varchar(25) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `employee_id` (`employee_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_id`, `salary`, `position`, `start_date`, `current_status`, `end_date`, `dob`, `address`, `phone_no`, `alternate_no`, `pan_no`, `bank_account_no`, `profile_picture`) VALUES
(1, 27, 15000, 'Web Developer', '2015-10-01', 'Working', '0000-00-00', '0000-00-00', '', '', '', '', '', 'logo.ico'),
(2, 26, 15000, 'Web Developer', '2015-10-28', 'Working', '0000-00-00', '0000-00-00', '', '', '', '', '', 'logo.ico'),
(3, 23, 12000, 'Web Developer', '2015-10-24', 'Working', '0000-00-00', '0000-00-00', '', '', '', '', '', 'logo.ico'),
(6, 1, 10000, 'Trainee', NULL, 'Working', NULL, '2015-10-01', 'Rajkot', '1266789176', '6373618465', 'SD5465SDF54', '576638263815633189', '1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `salary_registers`
--

CREATE TABLE IF NOT EXISTS `salary_registers` (
  `salary_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) unsigned NOT NULL,
  `base_salary` decimal(7,0) NOT NULL DEFAULT '0',
  `bonus` decimal(7,0) NOT NULL DEFAULT '0',
  `pt` decimal(7,0) NOT NULL DEFAULT '0',
  `esi` decimal(7,0) NOT NULL DEFAULT '0',
  `tds` decimal(7,0) NOT NULL DEFAULT '0',
  `total` decimal(7,0) NOT NULL DEFAULT '0',
  `working_days` tinyint(4) NOT NULL,
  `month` tinyint(2) DEFAULT NULL,
  `year` int(4) unsigned DEFAULT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_date` date NOT NULL,
  `last_updated_by` varchar(255) DEFAULT NULL,
  `last_updated` date DEFAULT NULL,
  PRIMARY KEY (`salary_id`),
  KEY `employee_id` (`employee_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `salary_registers`
--

INSERT INTO `salary_registers` (`salary_id`, `employee_id`, `base_salary`, `bonus`, `pt`, `esi`, `tds`, `total`, `working_days`, `month`, `year`, `created_by`, `created_date`, `last_updated_by`, `last_updated`) VALUES
(1, 23, 12000, 0, 200, 210, 0, 11590, 26, 1, 2015, '1', '2015-10-13', NULL, NULL),
(2, 26, 15000, 0, 200, 0, 0, 14800, 26, 1, 2015, '1', '2015-10-13', NULL, NULL),
(3, 27, 15000, 0, 200, 0, 0, 14800, 26, 1, 2015, '1', '2015-10-13', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_level` tinyint(4) NOT NULL DEFAULT '1',
  `last_login` datetime DEFAULT NULL,
  `user_status` varchar(255) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `user_level`, `last_login`, `user_status`) VALUES
(1, 'Dwiraj', 'Chauhan', 'dwiraj@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 2, '2015-10-14 09:38:05', 'Active'),
(23, 'abc', 'efg', 'abc@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, '2015-10-13 17:54:23', 'Active'),
(26, 'Gautam', 'Hamborn', 'a@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, NULL, 'Active'),
(27, 'ram', 'nathan', 'ram@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, NULL, 'Active');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
