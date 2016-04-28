-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 14, 2015 at 11:27 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
