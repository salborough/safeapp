-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 18, 2014 at 10:22 PM
-- Server version: 5.5.28
-- PHP Version: 5.3.10-1ubuntu3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `safedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact`
--

CREATE TABLE IF NOT EXISTS `tbl_contact` (
  `user_id` int(11) NOT NULL,
  `contact` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_contact`
--

INSERT INTO `tbl_contact` (`user_id`, `contact`) VALUES
(11, 10),
(10, 11);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_group`
--

CREATE TABLE IF NOT EXISTS `tbl_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(100) NOT NULL,
  `track_group` int(11) NOT NULL,
  `tracked_by_group` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_group_member`
--

CREATE TABLE IF NOT EXISTS `tbl_group_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invite`
--

CREATE TABLE IF NOT EXISTS `tbl_invite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id_from` int(11) NOT NULL,
  `user_id_to` int(11) NOT NULL,
  `invite_status_id` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_invite`
--

INSERT INTO `tbl_invite` (`id`, `user_id_from`, `user_id_to`, `invite_status_id`, `create_time`, `update_time`) VALUES
(1, 9, 2, 1, '2013-12-31 12:59:38', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invite_status`
--

CREATE TABLE IF NOT EXISTS `tbl_invite_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invite_status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_invite_status`
--

INSERT INTO `tbl_invite_status` (`id`, `invite_status`) VALUES
(1, 'Pending'),
(2, 'Accepted'),
(3, 'Declined');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_safenotification`
--

CREATE TABLE IF NOT EXISTS `tbl_safenotification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id_from` int(11) NOT NULL,
  `user_id_to` int(11) NOT NULL,
  `safe_notification_status` int(11) NOT NULL,
  `safe_request_id` int(11) NOT NULL,
  `gps` varchar(100) NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_saferequest`
--

CREATE TABLE IF NOT EXISTS `tbl_saferequest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id_from` int(11) NOT NULL,
  `user_id_to` int(11) NOT NULL,
  `safe_request_status` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_safe_notification_status`
--

CREATE TABLE IF NOT EXISTS `tbl_safe_notification_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `safe_notification_status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_safe_notification_status`
--

INSERT INTO `tbl_safe_notification_status` (`id`, `safe_notification_status`) VALUES
(1, 'safe'),
(2, 'unsafe');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_safe_request_status`
--

CREATE TABLE IF NOT EXISTS `tbl_safe_request_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `safe_request_status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_safe_request_status`
--

INSERT INTO `tbl_safe_request_status` (`id`, `safe_request_status`) VALUES
(1, 'Pending'),
(2, 'Replied');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `screen_name` varchar(255) NOT NULL,
  `pin` varchar(8) NOT NULL,
  `role_id` int(2) NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  `last_login_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `password`, `first_name`, `last_name`, `screen_name`, `pin`, `role_id`, `create_time`, `update_time`, `last_login_time`) VALUES
(1, 'salborough51+mj@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 'mark', 'james', 'mj', '9sorlJA7', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'salborough51+db@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 'dean', 'bean', 'db', 'r1BNxnb', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'salborough51+mike@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 'Mike', 'Chase', 'mikey22', 'r1BN7nv', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'salborough51+ms@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 'mike', 'smith', 'msmity', 'x1BNxnbo', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'salborough51+jb@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 'Jeff', 'Butler', 'jeff', 'ssorlJAk', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'salborough51+mb@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 'mark', 'bond', 'mbond', 'bYkvHFXO', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'salborough51+sb@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 'Simon', 'Buerger', 'frontEnd', 'ljL8fAqh', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'salborough51+ja@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 'Jacky', 'Alborough', 'jax123', 'bYOOMN88', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'salborough51+pa@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 'Patty', 'Alborough', 'palballs1', '6oBzgIhr', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'salborough51+pmax@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 'Pete', 'Max', 'pwee', 'DvrHJZj2', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
