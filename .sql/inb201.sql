-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 01, 2014 at 02:49 AM
-- Server version: 5.5.33
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `inb201`
--

-- --------------------------------------------------------

--
-- Table structure for table `emergency`
--

CREATE TABLE `emergency` (
  `patient_id` int(11) NOT NULL AUTO_INCREMENT,
  `priority` int(1) NOT NULL,
  `entry_time` datetime NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`patient_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `medical`
--

CREATE TABLE `medical` (
  `patient_id` int(11) NOT NULL,
  `allergies` varchar(50) DEFAULT NULL,
  `medications` varchar(50) DEFAULT NULL,
  `existing_conditions` varchar(50) DEFAULT NULL,
  `blood_type` char(3) DEFAULT NULL,
  `weight` varchar(10) DEFAULT NULL,
  `height` varchar(10) DEFAULT NULL,
  `diet` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`patient_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medical`
--

INSERT INTO `medical` (`patient_id`, `allergies`, `medications`, `existing_conditions`, `blood_type`, `weight`, `height`, `diet`) VALUES
(1, 'morhpine, penicillin', 'methotrexate 20mg/week once a week.', 'rheumatoid arthritis', 'B+', '40kg', '150cm', 'No gluten'),
(2, NULL, NULL, NULL, 'A+', '30kg', '101cm', 'No lactose'),
(3, NULL, NULL, NULL, 'B+', '31kg', '86cm', NULL),
(4, NULL, NULL, NULL, 'O+', '27kg', '55cm', NULL),
(5, NULL, NULL, NULL, 'A−', '31kg', '68cm', NULL),
(6, NULL, NULL, NULL, 'AB+', '32kg', '96cm', NULL),
(7, NULL, NULL, NULL, 'A+', '33kg', '114cm', NULL),
(8, NULL, NULL, NULL, 'B−', '22kg', '63cm', NULL),
(9, NULL, NULL, NULL, 'AB−', '50kg', '144cm', NULL),
(10, NULL, NULL, NULL, 'O+', '27kg', '55cm', NULL),
(11, NULL, NULL, NULL, 'A−', '31kg', '68cm', NULL),
(12, NULL, NULL, NULL, 'AB+', '32kg', '96cm', NULL),
(13, NULL, NULL, NULL, 'A+', '33kg', '114cm', NULL),
(14, NULL, NULL, NULL, 'B−', '22kg', '63cm', NULL),
(15, NULL, NULL, NULL, 'AB−', '50kg', '144cm', NULL),
(16, NULL, NULL, NULL, 'O−', '45kg', '124cm', NULL);
-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` longtext CHARACTER SET latin1,
  `date` date DEFAULT NULL,
  `patient_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `description`, `date`, `patient_id`, `staff_id`) VALUES
(1, '6 yo M c/o abdominal pain. Suspected appendicitis. Surgery has been booked', '2014-05-30', 1, 0),
(2, '3 yo M. Pertussis (whooping cough). 10mg Amoxicillin 3 times a day starting 13/05/14', '2014-05-30', 2, 0),
(3, 'Patient suffering from respiratory syncytial virus. ', '2014-05-30', 3, 0),
(4, 'Patient experiencing severe abdominal pain. Recommend immediate lobotomy.', '2014-05-30', 4, 0),
(5, 'Patient is complaining of chest pain. Recommend immediate amputation of all limbs.', '2014-05-30', 5, 0),
(6, '3 yo M. Pertussis (whooping cough). 10mg Amoxicillin 3 times a day starting 13/05/14.', '2014-05-30', 6, 0),
(7, 'Patient suffering from respiratory syncytial virus.', '2014-05-30', 7, 0),
(8, '6 yo M c/o abdominal pain. Suspected appendicitis. Surgery has been booked', '2014-05-30', 8, 0),
(9, '6 yo M c/o abdominal pain. Suspected appendicitis. Surgery has been booked', '2014-05-30', 9, 0),
(10, 'Surgery was a success. Appendicitis was confirmed. Apendix was removed.', '2014-05-30', 1, 0),
(11, 'Patient has recovered from surgery.', '2014-05-30', 1, 0),
(12, '3 yo M. Pertussis (whooping cough). 10mg Amoxicillin 3 times a day starting 13/05/14', '2014-05-30', 10, 0);

-- --------------------------------------------------------


-- Table structure for table 'images'

CREATE TABLE IF NOT EXISTS `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_location` varchar(250) NOT NULL,
  `note_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

INSERT INTO `image` (`id`, `name_location`, `note_id`) VALUES
(28, 'img/Koala.jpg', 1),
(29, 'img/Jellyfish.jpg', 2),
(30, 'img/Tulips.jpg', 3),
(31, 'img/Lighthouse.jpg', 9);

-- Table structure for table 'doctornurse'

CREATE TABLE IF NOT EXISTS `doctornurse` (
  `staff_id` int(11) NOT NULL,
  `nurse_id` int(11) NOT NULL,
  UNIQUE KEY `staff_id` (`staff_id`,`nurse_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `date_of_birth` date NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `home_phone` bigint(20) NOT NULL,
  `mobile_phone` bigint(20) NOT NULL,
  `address` varchar(50) NOT NULL,
  `medicare` bigint(20) NOT NULL,
  `medicare_ref` int(1) NOT NULL,
  `medicare_exp` date NOT NULL,
  `priv_health_org` varchar(50) DEFAULT NULL,
  `priv_health_num` bigint(12) DEFAULT NULL,
  `nok_first_name` varchar(50) NOT NULL,
  `nok_last_name` varchar(50) NOT NULL,
  `nok_home_phone` bigint(20) NOT NULL,
  `nok_mobile_phone` bigint(20) NOT NULL,
  `nok_address` varchar(50) NOT NULL,
  `nok_relationship` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `medicare` (`medicare`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `email`, `home_phone`, `mobile_phone`, `address`, `medicare`, `medicare_ref`, `medicare_exp`, `priv_health_org`, `priv_health_num`, `nok_first_name`, `nok_last_name`, `nok_home_phone`, `nok_mobile_phone`, `nok_address`, `nok_relationship`) VALUES
(1, 'Jamie', NULL, 'Colesman', 'Male', '2004-12-12', 'j-dizzle@gma.com', 0738652000, 0474208000, '43 Queen Street Brisbane CBD', 456876524, 2, '2015-01-01', NULL, NULL, 'Jane', 'Colesman', 0738652000, 0474208000, '333 Adelaide Street', 'Parent'),
(2, 'Robert', 'James', 'Jefferson', 'Male', '2008-12-12', 'bobby@gma.com', 0738652000, 0474208000, '333 Adelaide Street', 874565468, 2, '2016-01-01', 'Medicare Private', 8765421567, 'John', 'Jefferson', 0738652000, 0474208000, '333 Adelaide Street', 'Parent'),
(3, 'John', 'D.', 'Carmack', 'Male', '2010-12-12', 'carmack@gma.com', 0738652000, 0474208000, '333 Adelaide Street', 654789354, 3, '2015-01-01', NULL, NULL, 'John', 'Carmack', 0738652000, 0474208000, '333 Adelaide Street', 'Parent'),
(4, 'Alfonso', 'John', 'Romero', 'Male', '2009-12-12', 'daikatana@gma.com', 0738652000, 0474208000, '333 Adelaide Street', 654887521, 2, '2017-01-01', NULL, NULL, 'Alfonso', 'Romero', 0738652000, 0474208000, '333 Adelaide Street', 'Parent'),
(5, 'John', NULL, 'Smith', 'Male', '2008-12-12', 'smithy@gma.com', 0738652000, 0474208000, '333 Adelaide Street', 1385756892, 2, '2016-01-01', NULL, NULL, 'John', 'Smith', 0738652000, 0474208000, '333 Adelaide Street', 'Parent'),
(6, 'Jane', 'Susan', 'Smith', 'Female', '2007-12-12', 'jinny@gma.com', 0738652000, 0474208000, '333 Adelaide Street', 548226875, 3, '2015-01-01', 'Medicare Private', 2365527442, 'Mitchell', 'Smith', 0738652000, 0474208000, '333 Adelaide Street', 'Parent'),
(7, 'Sally', NULL, 'Perkins', 'Female', '2007-12-12', 'sperkins@gma.com', 0738652000, 0474208000, '333 Adelaide Street', 456521057, 3, '2017-01-01', NULL, NULL, 'Jack', 'Perkins', 0738652000, 0474208000, '333 Adelaide Street', 'Parent'),
(8, 'Lisa', 'Erin', 'Jones', 'Female', '2007-12-12', 'lj2007@gma.com', 0738652000, 0474208000, '333 Adelaide Street', 574273578, 4, '2016-01-01', NULL, NULL, 'James', 'Jones', 0738652000, 0474208000, '333 Adelaide Street', 'Parent'),
(9, 'Natasha', NULL, 'Newell', 'Female', '2007-12-12', 'nn123@gma.com', 0738652000, 0474208000, '333 Adelaide Street', 578121358, 4, '2015-01-01', NULL, NULL, 'John', 'Newell', 0738652000, 0474208000, '333 Adelaide Street', 'Parent'),
(10, 'Elizabeth', 'Courtney', 'Sutherland', 'Female', '2007-12-12', 'lsand@gma.com', 0738652000, 0474208000, '333 Adelaide Street', 878542307, 2, '2017-01-01', NULL, NULL, 'Arthur', 'Sutherland', 0, 0474208000, '333 Adelaide Street', 'Parent'),
(11, 'John', NULL, 'Smith', 'Male', '2008-12-12', 'jsmith@gma.com', 0738652000, 0474208000, '333 Adelaide Street', 1385756822, 2, '2016-01-01', NULL, NULL, 'Erica', 'Smith', 0738652000, 0474208000, '333 Adelaide Street', 'Parent'),
(12, 'Julie', NULL, 'Smith', 'Female', '2007-12-12', 'jsmith11@gma.com', 0738652000, 0474208000, '333 Adelaide Street', 548246875, 3, '2015-01-01', NULL, NULL, 'Tim', 'Smith', 0738652000, 0474208000, '333 Adelaide Street', 'Parent'),
(13, 'Danielle', 'Julie', 'Cameron', 'Female', '2007-12-12', 'd.cameron@gma.com', 0738652000, 0474208000, '333 Adelaide Street', 476521057, 3, '2017-01-01', NULL, NULL, 'Julie', 'Cameron', 0738652000, 0474208000, '333 Adelaide Street', 'Parent'),
(14, 'Daniel', 'Lawrence', 'Cooper', 'Male', '2007-12-12', 'd-law@gma.com', 0738652000, 0474208000, '333 Adelaide Street', 574253578, 4, '2015-01-01', NULL, NULL, 'Colin', 'Cooper', 0738652000, 0474208000, '333 Adelaide Street', 'Parent'),
(15, 'Gordon', 'Gary', 'Freeman', 'Male', '2007-12-12', 'nn123@gma.com', 0738652000, 0474208000, '333 Adelaide Street', 578521358, 4, '2016-01-01', NULL, NULL, 'Al', 'Freeman', 0738652000, 0474208000, '333 Adelaide Street', 'Parent'),
(16, 'Adrian', 'John', 'Shephard', 'Male', '2007-12-12', 'lsand@gma.com', 0738652000, 0474208000, '333 Adelaide Street', 878542357, 2, '2015-01-01', NULL, NULL, 'James', 'Shephard', 0738652000, 0474208000, '333 Adelaide Street', 'Parent');
-- --------------------------------------------------------

--
-- Table structure for table `permissionlist`
--

CREATE TABLE `permissionlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `permissionlist`
--

INSERT INTO `permissionlist` (`id`, `name`, `description`) VALUES
(15, 'ASSIGN_STAFF', ''),
(14, 'VIEW_STAFF', ''),
(13, 'DELETE_STAFF', ''),
(12, 'UPDATE_STAFF', 'Update staff member'),
(11, 'CREATE_STAFF', 'Create staff members'),
(16, 'CREATE_PATIENT', ''),
(17, 'VIEW_PATIENT_PERSONAL', ''),
(18, 'UPDATE_PATIENT_MEDICAL', ''),
(19, 'DELETE_PATIENT', ''),
(20, 'ASSIGN_PATIENT_TO_STAFF', ''),
(21, 'ASSIGN_PATIENT_TO_RESOURCE', ''),
(22, 'UPDATE_PATIENT_PERSONAL', ''),
(23, 'VIEW_PATIENT_MEDICAL', ''),
(24, 'CREATE_RESOURCE', ''),
(25, 'DELETE_RESOURCE', ''),
(26, 'CREATE_RESOURCE_TYPE', ''),
(27, 'DELETE_RESOURCE_TYPE', ''),
(28, 'UPDATE_RESOURCE', ''),
(29, 'UPDATE_RESOURCE_TYPE', ''),
(30, 'MANAGE_STAFF_TO_ROLE', ''),
(31, 'MANAGE_PERMISSIONS_TO_STAFF', ''),
(32, 'MANAGE_PERMISSIONS_TO_ROLE', ''),
(33, 'UPDATE_PATIENT_FINANCIAL', ''),
(34, 'VIEW_PATIENT_FINANCIAL', '');

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_resource_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `resource_type_id` int(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`id`, `parent_resource_id`, `name`, `resource_type_id`, `description`) VALUES
(1, 0, 'General Ward', 1, 'General ward. Located on general level.'),
(2, 0, 'Emergency Ward', 1, 'Emergency ward, located on general level.'),
(3, 0, 'Neurology Ward', 1, 'Neurology ward, located on general level.'),
(4, 0, 'Cardiology Ward', 1, 'Cardiology ward, located on general level.'),
(5, 0, 'Oncology Ward', 1, 'Oncology ward, located on general level.'),
(6, 0, 'ICU Ward', 1, 'ICU ward, located on general level.'),
(7, 0, 'Radiology', 4, 'Radiology Services.'),
(8, 0, 'Pathology', 8, 'Pathology Services.'),
(9, 0, 'Operating Theatres', 6, 'A collection of operating theatres.'),
(10, 0, 'Treatments/Services', 13, 'A collection of medical services for treating patients.'),

(11, 7, 'X-Ray Machine', 9, 'X-Ray located in the North Wing'),
(12, 7, 'Ultrasound', 10, 'Ultrasound services located near North Wing.'),
(13, 7, 'MRI Machine', 12, 'MRI services located near North Wing.'),
(14, 7, 'CT Machine', 11, 'CT services located near North Wing.'),

(15, 9, 'Emergency Operating Theatre 01', 6, 'Emergency Operating Theatre 01.'),
(16, 9, 'Emergency Operating Theatre 02', 6, 'Emergency Operating Theatre 02.'),
(17, 9, 'General Operating Theatre 01', 6, 'Operating theatre.'),
(18, 9, 'General Operating Theatre 02', 6, 'Operating theatre.'),
(19, 9, 'General Operating Theatre 03', 6, 'Operating theatre.'),
(20, 9, 'General Operating Theatre 04', 6, 'Operating theatre.'),
(21, 9, 'Specialist Operating Theatre 01', 6, 'Operating theatre.'),
(22, 9, 'Specialist Operating Theatre 02', 6, 'Operating theatre.'),
(23, 9, 'Specialist Operating Theatre 03', 6, 'Operating theatre.'),
(24, 9, 'Specialist Operating Theatre 04', 6, 'Operating theatre.'),

(25, 10, 'Orthopedic Casting', 13, 'Casting of broken bones.'),
(26, 10, 'Kidney Dialysis', 13, 'Dialysis for renal failure.'),

(27, 1, 'Room 1', 7, 'General Ward Room 1.'),
(28, 1, 'Room 2', 7, 'General Ward Room 2.'),
(29, 1, 'Room 3', 7, 'General Ward Room 3.'),
(30, 1, 'Room 4', 7, 'General Ward Room 4.'),
(31, 1, 'Room 5', 7, 'General Ward Room 5.'),
(32, 1, 'Room 6', 7, 'General Ward Room 6.'),

(33, 2, 'Room 1', 7, 'Emergency Ward Room 1.'),
(34, 2, 'Room 2', 7, 'Emergency Ward Room 2.'),
(35, 2, 'Room 3', 7, 'Emergency Ward Room 3.'),
(36, 2, 'Room 4', 7, 'Emergency Ward Room 4.'),
(37, 2, 'Room 5', 7, 'Emergency Ward Room 5.'),
(38, 2, 'Room 6', 7, 'Emergency Ward Room 6.'),

(39, 3, 'Room 1', 7, 'Neurology Ward Room 1.'),
(40, 3, 'Room 2', 7, 'Neurology Ward Room 2.'),
(41, 3, 'Room 3', 7, 'Neurology Ward Room 3.'),
(42, 3, 'Room 4', 7, 'Neurology Ward Room 4.'),
(43, 3, 'Room 5', 7, 'Neurology Ward Room 5.'),
(44, 3, 'Room 6', 7, 'Neurology Ward Room 6.'),

(45, 27, 'Bed 1', 2, 'Bed 1 in room 1 of general ward.'),
(46, 27, 'Bed 2', 2, 'Bed 2 in room 1 of general ward.'),
(47, 27, 'Bed 3', 2, 'Bed 3 in room 1 of general ward.'),
(48, 28, 'Bed 1', 2, 'Bed 1 in room 2 of general ward.'),
(49, 28, 'Bed 2', 2, 'Bed 2 in room 2 of general ward.'),
(50, 28, 'Bed 3', 2, 'Bed 3 in room 2 of general ward.');



-- --------------------------------------------------------

--
-- Table structure for table `resource_queue`
--

CREATE TABLE `resource_queue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `resource_id` int(11) NOT NULL,
  `entry_time` datetime NOT NULL,
  `exit_time` datetime NOT NULL,
  `staff_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Table structure for table `resource_types`
--

CREATE TABLE `resource_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `resource_types`
--

INSERT INTO `resource_types` (`id`, `name`) VALUES
(1, 'WARD'),
(2, 'BED'),
(3, 'RECEPTION'),
(4, 'RADIOLOGY'),
(5, 'EMERGENCY'),
(6, 'OPERATING THEATRE'),
(7, 'ROOM'),
(8, 'PATHOLOGY'),
(9, 'X-RAY MACHINE'),
(10, 'ULTRASOUND'),
(11, 'CT MACHINE'),
(12, 'MRI MACHINE'),
(13, 'TREATMENT');

-- --------------------------------------------------------

--
-- Table structure for table `rolelist`
--

CREATE TABLE `rolelist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `role_name` (`role_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `rolelist`
--

INSERT INTO `rolelist` (`id`, `role_name`) VALUES
(1, 'Doctor'),
(2, 'Senior Doctor'),
(3, 'Nurse'),
(4, 'Receptionist'),
(5, 'Human Resources'),
(6, 'System Administrator'),
(7, 'Radiologist'),
(8, 'Pathologist');

-- --------------------------------------------------------

--
-- Table structure for table `rolepermissions`
--

CREATE TABLE `rolepermissions` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`role_id`,`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rolepermissions`
--

INSERT INTO `rolepermissions` (`role_id`, `permission_id`) VALUES
(1, 14),
(1, 18),
(1, 21),
(1, 23),
(2, 14),
(2, 15),
(2, 17),
(2, 18),
(2, 20),
(2, 21),
(2, 23),
(3, 14),
(3, 18),
(3, 23),
(4, 14),
(4, 16),
(4, 17),
(4, 21),
(4, 22),
(4, 33),
(4, 34),
(5, 11),
(5, 12),
(5, 13),
(5, 14),
(6, 11),
(6, 12),
(6, 13),
(6, 14),
(6, 15),
(6, 16),
(6, 17),
(6, 18),
(6, 19),
(6, 20),
(6, 21),
(6, 22),
(6, 23),
(6, 24),
(6, 25),
(6, 26),
(6, 27),
(6, 28),
(6, 29),
(6, 30),
(6, 31),
(6, 32),
(6, 33),
(6, 34),
(7, 14),
(7, 18),
(7, 23),
(8, 14),
(8, 18),
(8, 23);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `lastname` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `username` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `email` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `password` char(128) CHARACTER SET latin1 DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `password_reset` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `firstname`, `lastname`, `username`, `email`, `password`, `role_id`, `password_reset`) VALUES
(6, 'Root', 'Root', 'rroot1', 'root@root.com', '2b64f2e3f9fee1942af9ff60d40aa5a719db33b8ba8dd4864bb4f11e25ca2bee00907de32a59429602336cac832c8f2eeff5177cc14c864dd116c8bf6ca5d9a9', 1, 0),
(15, 'Xavi', 'Alonzo', 'xavi', '', 'c678084d3bc43458110fc16c055f436c3da24268e3162209fde98090d6177fe97d47d0910c0e43cdebddc3fb9859b08451df29ebd8b0d9fa05c255d62728b69c', 3, 0),
(16, 'Ronaldinho', 'Cass', 'ronaldinho', '', '99adc231b045331e514a516b4b7680f588e3823213abe901738bc3ad67b2f6fcb3c64efb93d18002588d3ccc1a49efbae1ce20cb43df36b38651f11fa75678e8', 3, 0),
(17, 'Tebez', 'Abem', 'tebez', '', '2b64f2e3f9fee1942af9ff60d40aa5a719db33b8ba8dd4864bb4f11e25ca2bee00907de32a59429602336cac832c8f2eeff5177cc14c864dd116c8bf6ca5d9a9', 3, 0);

/*INSERT INTO `staff` (`id`, `firstname`, `lastname`, `username`, `email`, `password`, `role_id`, `password_reset`) VALUES
<<<<<<< HEAD
(6, 'Root', 'Root', 'rroot1', 'root@root.com', '2b64f2e3f9fee1942af9ff60d40aa5a719db33b8ba8dd4864bb4f11e25ca2bee00907de32a59429602336cac832c8f2eeff5177cc14c864dd116c8bf6ca5d9a9', 1, 0),
(15, 'Xavi', 'Alonzo', 'xavi', '', 'c678084d3bc43458110fc16c055f436c3da24268e3162209fde98090d6177fe97d47d0910c0e43cdebddc3fb9859b08451df29ebd8b0d9fa05c255d62728b69c', 3, 0),
(16, 'Ronaldinho', 'Cass', 'ronaldinho', '', '99adc231b045331e514a516b4b7680f588e3823213abe901738bc3ad67b2f6fcb3c64efb93d18002588d3ccc1a49efbae1ce20cb43df36b38651f11fa75678e8', 3, 0),
(17, 'Tebez', 'Abem', 'tebez', '', '2b64f2e3f9fee1942af9ff60d40aa5a719db33b8ba8dd4864bb4f11e25ca2bee00907de32a59429602336cac832c8f2eeff5177cc14c864dd116c8bf6ca5d9a9', 3, 0);
=======
(6, 'Root', 'Root', 'rroot1', 'root@root.com', '2b64f2e3f9fee1942af9ff60d40aa5a719db33b8ba8dd4864bb4f11e25ca2bee00907de32a59429602336cac832c8f2eeff5177cc14c864dd116c8bf6ca5d9a9', 1, 0),
(15, 'Xavi', 'Alonzo', 'xavi', '', 'c678084d3bc43458110fc16c055f436c3da24268e3162209fde98090d6177fe97d47d0910c0e43cdebddc3fb9859b08451df29ebd8b0d9fa05c255d62728b69c', 3, 0),
(16, 'Ronaldinho', 'Cass', 'ronaldinho', '', '99adc231b045331e514a516b4b7680f588e3823213abe901738bc3ad67b2f6fcb3c64efb93d18002588d3ccc1a49efbae1ce20cb43df36b38651f11fa75678e8', 3, 0),
(17, 'Tebez', 'Abem', 'tebez', '', '2b64f2e3f9fee1942af9ff60d40aa5a719db33b8ba8dd4864bb4f11e25ca2bee00907de32a59429602336cac832c8f2eeff5177cc14c864dd116c8bf6ca5d9a9', 3, 0);
>>>>>>> doctor adding nurses to himself - working*/

-- --------------------------------------------------------

--
-- Table structure for table `staffpatient`
--

CREATE TABLE `staffpatient` (
  `staff_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staffpatient`
--

INSERT INTO `staffpatient` (`staff_id`, `patient_id`) VALUES
(6, 1),
(6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `staffpermissions`
--

CREATE TABLE `staffpermissions` (
  `staff_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`staff_id`,`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staffpermissions`
--

INSERT INTO `staffpermissions` (`staff_id`, `permission_id`) VALUES
(3, 1),
(6, 1),
(7, 1);
