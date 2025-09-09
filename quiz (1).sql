-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 09, 2025 at 12:10 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `qid` int(10) DEFAULT NULL,
  `ans` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `qid` int(10) NOT NULL,
  `qns` varchar(100) DEFAULT NULL,
  `OptA` varchar(50) DEFAULT NULL,
  `OptB` varchar(50) DEFAULT NULL,
  `OptC` varchar(50) DEFAULT NULL,
  `OptD` varchar(50) DEFAULT NULL,
  `ans` varchar(10) DEFAULT NULL,
  `technology` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`qid`, `qns`, `OptA`, `OptB`, `OptC`, `OptD`, `ans`, `technology`) VALUES
(1, 'who is the founder of c ?', 'Steve Bobs', 'Bejarne Stroustrap', 'Dennis Ritchie', 'Charles Babbge', 'OptC', 'C'),
(2, 'what is size of int in 32 bit compiler ?', '2 byte', '4 byte', '8 byte', '16 byte', 'OptA', 'C'),
(3, 'what is range of int in 32 bit compiler ?', '0-255', '0-65536', '-32768 - 32767', '0-45536', 'OptC', 'C'),
(4, 'Which of the following is not a valid C variable name?', 'int number;', 'float rate;', 'int variable_count;', 'int $main;', 'OptD', 'C'),
(5, 'Who is the father of PHP?', 'Drek Kolkevi', 'Rasmus Lerdorf', 'Willam Makepiece', 'List Barely', 'OptB', 'PHP');

-- --------------------------------------------------------

--
-- Table structure for table `regis`
--

CREATE TABLE `regis` (
  `name` varchar(15) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `regis`
--

INSERT INTO `regis` (`name`, `email`, `password`) VALUES
('Ritesh singh', 'riteshsinghran@gmail.com', '12345'),
('Deepali', 'deepali@mightcode.com', '$2y$10$QdDBlmOXEd.kC910b9vRoOgntWargdTS7oUleXBTkuNm1DPhtMZAu'),
('Ritesh singh', 'ritesh@mightcode.com', '$2y$10$iiY1XSlT5sNcrbO3TPau5.SiCZ/uxCDXDcfKZQKSJB2BGnwKvb.yS');

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
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `email`, `score`, `total`, `created_at`, `name`) VALUES
(1, 'riteshsinghran@gmail.com', 3, 3, '2025-09-04 13:36:11', 'Ritesh'),
(2, 'riteshsinghran@gmail.com', 3, 3, '2025-09-05 05:36:55', 'Ritesh'),
(3, 'riteshsinghran@gmail.com', 3, 3, '2025-09-05 06:02:35', 'Ritesh'),
(4, 'riteshsinghran@gmail.com', 3, 3, '2025-09-05 06:32:22', NULL),
(5, 'riteshsinghran@gmail.com', 2, 3, '2025-09-05 06:36:22', NULL),
(6, 'deepali@mightcode.com', 1, 3, '2025-09-08 12:11:15', NULL),
(7, 'deepali@mightcode.com', 2, 3, '2025-09-08 13:11:15', NULL),
(8, 'deepali@mightcode.com', 4, 4, '2025-09-08 13:14:20', NULL),
(9, 'deepali@mightcode.com', 2, 4, '2025-09-09 04:35:41', NULL),
(10, 'ritesh@mightcode.com', 3, 4, '2025-09-09 05:31:13', NULL),
(11, 'ritesh@mightcode.com', 0, 1, '2025-09-09 05:58:16', NULL),
(12, 'ritesh@mightcode.com', 0, 0, '2025-09-09 05:59:31', NULL),
(13, 'ritesh@mightcode.com', 3, 4, '2025-09-09 06:02:37', NULL),
(14, 'ritesh@mightcode.com', 2, 4, '2025-09-09 06:23:48', NULL),
(15, 'ritesh@mightcode.com', 2, 4, '2025-09-09 06:25:32', NULL),
(16, 'ritesh@mightcode.com', 1, 1, '2025-09-09 09:42:47', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD KEY `qid` (`qid`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `regis`
--
ALTER TABLE `regis`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `qid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
