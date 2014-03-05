-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 26, 2014 at 01:22 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `portalen`
--

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `period_id` int(11) NOT NULL,
  `event_type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `period_id` (`period_id`),
  KEY `event_type_id` (`event_type_id`),
  KEY `name_3` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `name`, `start_time`, `end_time`, `period_id`, `event_type_id`) VALUES
(1, 'Pizzaonsdag', '2014-02-19 18:00:00', '2014-02-19 22:00:00', 1, 1),
(2, 'Vårkravallen', '2014-03-08 22:00:00', '2014-03-09 03:00:00', 2, 2),
(4, 'Sittning', '2014-02-14 17:00:00', '2014-02-14 23:00:00', 1, 3),
(5, 'Personalfest', '2014-03-09 18:30:00', '2014-03-10 03:00:00', 2, 4),
(7, 'MT <3 GDK', '2014-02-22 18:00:00', '2014-02-22 22:00:00', 1, 3),
(10, 'Fotbollstisdag', '2014-02-25 20:00:00', '2014-02-25 22:00:00', 1, 1),
(11, 'Onsdagspub', '2014-02-26 18:00:00', '2014-02-26 22:00:00', 1, 1),
(26, 'Rockfesten', '2014-03-01 22:00:00', '2014-03-02 03:00:00', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `event_template`
--

CREATE TABLE IF NOT EXISTS `event_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `event_type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `event_type_id` (`event_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `event_template`
--

INSERT INTO `event_template` (`id`, `name`, `start_time`, `end_time`, `event_type_id`) VALUES
(5, 'Onsdagspub', '18:00:00', '22:00:00', 1),
(6, 'Vanlig nattklubb', '22:00:00', '03:00:00', 2),
(7, 'Vanlig pub', '18:00:00', '01:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `event_template_group`
--

CREATE TABLE IF NOT EXISTS `event_template_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `points` int(11) NOT NULL,
  `event_template_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `event_template_id` (`event_template_id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `event_type`
--

CREATE TABLE IF NOT EXISTS `event_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `event_type`
--

INSERT INTO `event_type` (`id`, `name`) VALUES
(2, 'Nattklubb'),
(4, 'Personalaktivitet'),
(1, 'Pub'),
(3, 'Sittning');

-- --------------------------------------------------------

--
-- Table structure for table `group_member`
--

CREATE TABLE IF NOT EXISTS `group_member` (
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`group_id`,`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group_member`
--

INSERT INTO `group_member` (`group_id`, `user_id`) VALUES
(2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `period`
--

CREATE TABLE IF NOT EXISTS `period` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `period`
--

INSERT INTO `period` (`id`, `name`, `start_date`, `end_date`) VALUES
(1, 'Februari 2014', '2014-02-01', '2014-02-28'),
(2, 'Mars 2014', '2014-03-01', '2014-03-31');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `ssn` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `zip` varchar(5) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `avatar` varchar(200) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bank_account` varchar(50) DEFAULT NULL,
  `special_food` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`user_name`,`mail`,`ssn`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_name`, `mail`, `ssn`, `password`, `name`, `last_name`, `phone_number`, `description`, `address`, `zip`, `city`, `avatar`, `date_created`, `bank_account`, `special_food`) VALUES
(1, 'Valross', 'valross@mail.com', '1111111234', '9b8c524273eaeab794fdd09a36f26e81', 'Hampus', 'Axelsson', '123456789', NULL, NULL, NULL, NULL, 'portalen_bild.jpg', '0000-00-00 00:00:00', NULL, NULL),
(2, 'test', 'ankan@mail.com', '9901011245', 'cb15ee3da60f51d1f8cb94652b1539f3', 'Herpa', 'Derp', '123654879', NULL, NULL, NULL, NULL, 'rikge099.gif', '0000-00-00 00:00:00', NULL, NULL),
(3, 'test2', '1111@mail.com', '1111111111', 'cb15ee3da60f51d1f8cb94652b1539f3', 'Testarn', 'Testsson', '', NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, NULL),
(5, 'Trappan', '2222@mail.com', '2222222222', 'cb15ee3da60f51d1f8cb94652b1539f3', 'Harry', 'Gluten', '', NULL, NULL, NULL, NULL, NULL, '2014-02-19 14:00:19', NULL, NULL),
(6, 'Bajs', 'hej@mail.com', 'ssssssssss', '711284ca87ba99f7c8198840f5dc607c', 'Bajs', 'o kiss', '', NULL, NULL, NULL, NULL, NULL, '2014-02-19 15:24:25', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_work`
--

CREATE TABLE IF NOT EXISTS `user_work` (
  `work_slot_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `checked` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`work_slot_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_work`
--

INSERT INTO `user_work` (`work_slot_id`, `user_id`, `checked`) VALUES
(4, 1, 1),
(5, 1, 1),
(6, 2, 1),
(7, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `work_group`
--

CREATE TABLE IF NOT EXISTS `work_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `name_2` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `work_group`
--

INSERT INTO `work_group` (`id`, `name`) VALUES
(13, 'Alla'),
(4, 'Bar'),
(7, 'Dagsansvarig'),
(5, 'DJ'),
(8, 'Event'),
(12, 'Hovmästare'),
(3, 'Kock'),
(10, 'Ljud & Ljus'),
(9, 'Marknadsföring'),
(11, 'Servering'),
(6, 'Värd'),
(2, 'Webb');

-- --------------------------------------------------------

--
-- Table structure for table `work_slot`
--

CREATE TABLE IF NOT EXISTS `work_slot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `points` int(11) NOT NULL DEFAULT '0',
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`),
  KEY `event_id` (`event_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `work_slot`
--

INSERT INTO `work_slot` (`id`, `group_id`, `event_id`, `points`, `start_time`, `end_time`) VALUES
(4, 2, 1, 3, '2014-02-19 17:00:00', '2014-02-19 23:00:00'),
(5, 2, 4, 4, '2014-02-14 16:00:00', '2014-02-15 00:00:00'),
(6, 2, 1, 3, '2014-02-19 17:00:00', '2014-02-19 23:00:00'),
(7, 2, 2, 6, '2014-03-08 19:00:00', '2014-03-09 05:00:00'),
(8, 2, 2, 6, '2014-03-08 19:00:00', '2014-03-09 05:00:00'),
(9, 6, 5, 0, '2014-03-09 18:00:00', '2014-03-10 03:00:00'),
(10, 10, 5, 0, '2014-03-09 18:00:00', '2014-02-10 03:00:00'),
(11, 6, 10, 2, '2014-02-25 19:00:00', '2014-02-25 23:00:00'),
(35, 4, 26, 6, '2014-03-01 19:00:00', '2014-03-02 05:00:00'),
(36, 4, 26, 6, '2014-03-01 19:00:00', '2014-03-02 05:00:00'),
(37, 4, 26, 6, '2014-03-01 19:00:00', '2014-03-02 05:00:00'),
(38, 4, 26, 6, '2014-03-01 19:00:00', '2014-03-02 05:00:00'),
(39, 4, 26, 6, '2014-03-01 19:00:00', '2014-03-02 05:00:00'),
(40, 7, 26, 6, '2014-03-01 16:00:00', '2014-03-02 05:00:00'),
(41, 5, 26, 0, '2014-03-01 19:00:00', '2014-03-02 05:00:00'),
(42, 5, 26, 0, '2014-03-01 19:00:00', '2014-03-02 05:00:00'),
(43, 6, 26, 6, '2014-03-01 19:00:00', '2014-03-02 05:00:00'),
(44, 6, 26, 6, '2014-03-01 19:00:00', '2014-03-02 05:00:00'),
(45, 6, 26, 6, '2014-03-01 19:00:00', '2014-03-02 05:00:00'),
(46, 6, 26, 6, '2014-03-01 19:00:00', '2014-03-02 05:00:00'),
(47, 10, 26, 0, '2014-03-01 19:00:00', '2014-03-02 05:00:00'),
(48, 10, 26, 0, '2014-03-01 19:00:00', '2014-03-02 05:00:00');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`period_id`) REFERENCES `period` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `event_ibfk_2` FOREIGN KEY (`event_type_id`) REFERENCES `event_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `event_template`
--
ALTER TABLE `event_template`
  ADD CONSTRAINT `event_template_ibfk_1` FOREIGN KEY (`event_type_id`) REFERENCES `event_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `event_template_group`
--
ALTER TABLE `event_template_group`
  ADD CONSTRAINT `event_template_group_ibfk_1` FOREIGN KEY (`event_template_id`) REFERENCES `event_template` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `event_template_group_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `work_group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `group_member`
--
ALTER TABLE `group_member`
  ADD CONSTRAINT `group_member_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `work_group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `group_member_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_work`
--
ALTER TABLE `user_work`
  ADD CONSTRAINT `user_work_ibfk_1` FOREIGN KEY (`work_slot_id`) REFERENCES `work_slot` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_work_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `work_slot`
--
ALTER TABLE `work_slot`
  ADD CONSTRAINT `work_slot_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `work_group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `work_slot_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
