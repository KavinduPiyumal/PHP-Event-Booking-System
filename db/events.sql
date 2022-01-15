-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 04, 2021 at 12:30 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `events`
--

-- --------------------------------------------------------

--
-- Table structure for table `e_events`
--

DROP TABLE IF EXISTS `e_events`;
CREATE TABLE IF NOT EXISTS `e_events` (
  `e_event_id` int(11) NOT NULL AUTO_INCREMENT,
  `e_event_title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `e_event_date` date NOT NULL,
  `e_event_time` time NOT NULL,
  `e_event_details` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`e_event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `e_events`
--

INSERT INTO `e_events` (`e_event_id`, `e_event_title`, `e_event_date`, `e_event_time`, `e_event_details`) VALUES
(1, 'The Antidote: Women\'s Circle', '2021-12-17', '19:38:35', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent viverra, ante consectetur sodales consectetur, mauris felis finibus orci, non porta nisl elit sed odio. In sit amet ex volutpat, fringilla velit eget, pulvinar leo. Mauris bibendum, diam vitae dapibus ullamcorper, libero leo pellentesque massa, ut fringilla magna velit at tortor. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin in metus diam. Vestibulum vel iaculis nibh. Quisque quis scelerisque dolor. Sed sit amet augue sit amet dui dignissim suscipit.\r\n'),
(2, 'The Antidote: Women\'s Circle', '2022-01-01', '11:39:46', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent viverra, ante consectetur sodales consectetur, mauris felis finibus orci, non porta nisl elit sed odio. In sit amet ex volutpat, fringilla velit eget, pulvinar leo. Mauris bibendum, diam vitae dapibus ullamcorper, libero leo pellentesque massa, ut fringilla magna velit at tortor. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin in metus diam. Vestibulum vel iaculis nibh. Quisque quis scelerisque dolor. Sed sit amet augue sit amet dui dignissim suscipit.');

-- --------------------------------------------------------

--
-- Table structure for table `e_login`
--

DROP TABLE IF EXISTS `e_login`;
CREATE TABLE IF NOT EXISTS `e_login` (
  `e_id` int(11) NOT NULL AUTO_INCREMENT,
  `e_email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `e_password` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`e_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `e_login`
--

INSERT INTO `e_login` (`e_id`, `e_email`, `e_password`) VALUES
(1, 'abcd@gmail.com', 'a7492ccf1d75ce6bd018329fcda62fe6'),
(2, 'test', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `e_tickets`
--

DROP TABLE IF EXISTS `e_tickets`;
CREATE TABLE IF NOT EXISTS `e_tickets` (
  `e_tix_id` int(11) NOT NULL AUTO_INCREMENT,
  `e_tix_user_login_id` int(11) NOT NULL,
  `e_tix_event_id` int(11) NOT NULL,
  `e_confirmation_code` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`e_tix_id`),
  KEY `e_tix_event_id` (`e_tix_event_id`),
  KEY `e_tix_user_login_id` (`e_tix_user_login_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `e_tickets`
--

INSERT INTO `e_tickets` (`e_tix_id`, `e_tix_user_login_id`, `e_tix_event_id`, `e_confirmation_code`) VALUES
(1, 1, 1, '4ba13d0f856c8addd774ce8e93c0846f12760cf9286df6a2449d255a897a7395'),
(2, 2, 1, '4ba13d0f856c8addd774ce8e93c0846f12760cf9286df6a2449d255a897a7395');

-- --------------------------------------------------------

--
-- Table structure for table `e_user`
--

DROP TABLE IF EXISTS `e_user`;
CREATE TABLE IF NOT EXISTS `e_user` (
  `e_user_id` int(11) NOT NULL AUTO_INCREMENT,
  `e_user_fname` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `e_user_lname` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `e_user_type` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `e_user_login_id` int(11) NOT NULL,
  PRIMARY KEY (`e_user_id`),
  KEY `e_user_login_id` (`e_user_login_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `e_user`
--

INSERT INTO `e_user` (`e_user_id`, `e_user_fname`, `e_user_lname`, `e_user_type`, `e_user_login_id`) VALUES
(1, 'fname', 'lname', 'user', 1),
(2, 'test', 'test', 'guest', 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `e_tickets`
--
ALTER TABLE `e_tickets`
  ADD CONSTRAINT `e_tickets_ibfk_1` FOREIGN KEY (`e_tix_event_id`) REFERENCES `e_events` (`e_event_id`),
  ADD CONSTRAINT `e_tickets_ibfk_2` FOREIGN KEY (`e_tix_user_login_id`) REFERENCES `e_login` (`e_id`);

--
-- Constraints for table `e_user`
--
ALTER TABLE `e_user`
  ADD CONSTRAINT `e_user_ibfk_1` FOREIGN KEY (`e_user_login_id`) REFERENCES `e_login` (`e_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
