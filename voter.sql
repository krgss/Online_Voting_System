-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2017 at 06:48 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlinevoting`
--

-- --------------------------------------------------------

--
-- Table structure for table `voter`
--

CREATE TABLE `voter` (
  `uid` bigint(12) NOT NULL,
  `vstatus` tinyint(1) NOT NULL,
  `time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `voter`
--

INSERT INTO `voter` (`uid`, `vstatus`, `time`) VALUES
(101010101010, 0, NULL),
(101110111011, 0, '2017-04-17 08:06:15'),
(101210121012, 1, '2017-04-17 08:08:47'),
(101310131013, 0, '2017-04-17 08:06:15'),
(101410141014, 0, NULL),
(101510151015, 0, NULL),
(101610161016, 0, NULL),
(101710171017, 0, NULL),
(101810181018, 0, '2017-04-17 08:06:15'),
(101910191019, 0, NULL),
(102010201020, 0, NULL),
(102110211021, 0, NULL),
(111111111111, 0, NULL),
(123412341234, 0, '2017-04-17 08:06:15'),
(222222222222, 0, NULL),
(301608109561, 1, '2017-04-18 06:55:40'),
(333333333333, 0, NULL),
(444444444444, 0, NULL),
(456789123456, 1, '2017-04-17 08:14:49'),
(488014483102, 0, NULL),
(555555555555, 0, NULL),
(666666666666, 0, NULL),
(730818508535, 0, NULL),
(747474747474, 1, '2017-04-18 07:10:35'),
(777777777777, 0, NULL),
(786786786786, 0, NULL),
(888888888888, 0, NULL),
(999999999999, 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `voter`
--
ALTER TABLE `voter`
  ADD UNIQUE KEY `uid` (`uid`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `voter`
--
ALTER TABLE `voter`
  ADD CONSTRAINT `voter_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `aadhaar` (`uid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
