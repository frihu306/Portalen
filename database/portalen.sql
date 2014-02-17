-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 17, 2014 at 08:21 PM
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
-- Table structure for table `score`
--

CREATE TABLE IF NOT EXISTS `score` (
  `user_id` int(11) NOT NULL,
  `worked` int(11) NOT NULL,
  `booked` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `score`
--

INSERT INTO `score` (`user_id`, `worked`, `booked`) VALUES
(1, 5, 0),
(2, 4, 3);

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
  `adress` varchar(100) DEFAULT NULL,
  `zip` varchar(5) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `avatar` varchar(200) DEFAULT NULL,
  `date_created` date NOT NULL DEFAULT '0000-00-00',
  `bank_account` varchar(50) DEFAULT NULL,
  `special_food` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`user_name`,`mail`,`ssn`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_name`, `mail`, `ssn`, `password`, `name`, `last_name`, `phone_number`, `description`, `adress`, `zip`, `city`, `avatar`, `date_created`, `bank_account`, `special_food`) VALUES
(1, 'Valross', 'valross@mail.com', '1111111234', '9b8c524273eaeab794fdd09a36f26e81', 'Hampus', 'Axelsson', '123456789', NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL),
(2, 'test', 'ankan@mail.com', '9901011245', 'cb15ee3da60f51d1f8cb94652b1539f3', 'Herpa', 'Derp', '123654879', NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `score`
--
ALTER TABLE `score`
  ADD CONSTRAINT `score_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
