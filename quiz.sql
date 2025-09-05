-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 09, 2021 at 06:19 PM
-- Server version: 5.1.53
-- PHP Version: 5.3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `quiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE IF NOT EXISTS `answer` (
  `qid` int(10) DEFAULT NULL,
  `ans` varchar(20) DEFAULT NULL,
  KEY `qid` (`qid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answer`
--


-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `qid` int(10) NOT NULL,
  `qns` varchar(100) DEFAULT NULL,
  `OptA` varchar(50) DEFAULT NULL,
  `OptB` varchar(50) DEFAULT NULL,
  `OptC` varchar(50) DEFAULT NULL,
  `OptD` varchar(50) DEFAULT NULL,
  `ans` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`qid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`qid`, `qns`, `OptA`, `OptB`, `OptC`, `OptD`, `ans`) VALUES
(1, 'who is the founder of c ?', 'Steve Bobs', 'Bejarne Stroustrap', 'Dennis Ritchie', 'Charles Babbge', 'OptC'),
(2, 'what is size of int in 32 bit compiler ?', '2 byte', '4 byte', '8 byte', '16 byte', 'OptA'),
(3, 'what is range of int in 32 bit compiler ?', '0-255', '0-65536', '-32768 - 32767', '0-45536', 'OptC');

-- --------------------------------------------------------

--
-- Table structure for table `regis`
--

CREATE TABLE IF NOT EXISTS `regis` (
  `name` varchar(15) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(15) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `regis`
--

INSERT INTO `regis` (`name`, `email`, `password`) VALUES
('Ritesh singh', 'riteshsinghran@gmail.com', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `score` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
COMMIT;