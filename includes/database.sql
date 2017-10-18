-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 17, 2013 at 01:15 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ignou`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `email`) VALUES
(1, 'admin', 'admin', 'faizanayubi@hotmail.com'),
(2, 'faizanayubi', 'faizan007', 'faizan.dtu@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `contact_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`contact_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(32) NOT NULL,
  `position` int(3) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `menu_name`, `position`, `content`) VALUES
(1, 'June 2013', 1, 'For Admission in June 2013 Session Last Date: 8th July 2013 without late fee and 31st July 2013 with late fee Please Contact office for details.'),
(2, 'August 2012', 2, 'Hall Tickets for BCA/MCA/CIT Term End Practical Examination August 2012 (Rc Vishakhapatnam)'),
(3, 'June 2012', 3, 'List of Learners and Datesheet for BCA MCA Practical Exam TEE June, 2012 (RC Chandigarh)');

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE IF NOT EXISTS `programs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(30) NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `fee` int(10) NOT NULL,
  `description` text NOT NULL,
  `num_semester` varchar(10) NOT NULL,
  `duration` varchar(10) NOT NULL,
  `eligibility` text NOT NULL,
  `max_duration` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `type`, `code`, `name`, `fee`, `description`, `num_semester`, `duration`, `eligibility`, `max_duration`) VALUES
(1, 'Masters Degree', 'MCA', 'Master of Computer Applications', 20000, 'Taking into consideration the fact that India has been the preferred destination of the west for information technology outsourcing, we have ensured that quality and experience are the two priority parameters for taking students into the MCA Course.', '6', '3', 'Graduates in Engineering, Science or Commerce with Mathematics or Statistics as one of the subject at 10+2 Level /its equivalent are eligible for the MCA Course', '4 Year'),
(2, 'Masters Degree', 'MBA', 'Master of Business Administration', 25000, 'In the first year the students are provided exposure to core management subjects. Overall, in the two academic years students are provided enough industry experience. This happens mostly through Summer Internships followed by submission of Project Report. \r\nIn the second year of study, students have to choose an elective to pursue dual specializations of their interest. ', '4', '2', 'Graduates in Engineering, Science or Commerce with Mathematics or Statistics as one of the subject at 10+2 Level /its equivalent are eligible', '3 Year');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `program` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `gender` varchar(30) NOT NULL,
  `mstatus` varchar(30) NOT NULL,
  `category` varchar(30) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `fathername` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `address` varchar(50) NOT NULL,
  `city` varchar(30) NOT NULL,
  `district` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `pincode` int(10) NOT NULL,
  `landline` int(10) NOT NULL,
  `mobile` int(10) NOT NULL,
  `qualification` varchar(30) NOT NULL,
  `bankname` varchar(30) NOT NULL,
  `branchname` varchar(30) NOT NULL,
  `cnumber` int(10) NOT NULL,
  `amount` int(10) NOT NULL,
  `fee` int(10) NOT NULL,
  `pay` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `username`, `password`, `program`, `country`, `gender`, `mstatus`, `category`, `firstname`, `lastname`, `fathername`, `email`, `address`, `city`, `district`, `state`, `pincode`, `landline`, `mobile`, `qualification`, `bankname`, `branchname`, `cnumber`, `amount`, `fee`, `pay`) VALUES
(1, 'faizanayubi', '65634093', 'MCA', 'India', 'male', 'Unmarried', 'OBC', 'faizan', 'ayubi', 'ansari', 'indianayubi@gmail.com', 'b-16, near delhi technological university', 'delhi', 'south delhi', 'Delhi', 110025, 1126985752, 2147483647, 'btech', 'sbi', 'dce', 123456, 65000, 65000, 'checque'),
(2, 'heenakausar', '9555956329', 'Master of Business Administrat', 'India', 'female', 'Unmarried', 'OBC', 'Heena', 'Kausar', 'Khurshhed Alam', 'heenakausar96@gmail.com', 'i-40, Batla house', 'new delhi', 'south delhi', 'Delhi', 110025, 1126985752, 2147483647, 'Diploma', 'PNB', 'Maharani Bagh', 786, 25000, 25000, 'checque');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
