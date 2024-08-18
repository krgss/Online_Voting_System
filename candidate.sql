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
-- Table structure for table `candidate`
--

CREATE TABLE `candidate` (
  `uid` bigint(12) NOT NULL,
  `partyname` varchar(50) NOT NULL,
  `constituency` bigint(20) NOT NULL,
  `count` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `candidate`
--

INSERT INTO `candidate` (`uid`, `partyname`, `constituency`, `count`) VALUES
(101010101010, 'congress', 103, 3),
(101110111011, 'bjp', 102, 3),
(101210121012, 'congress', 104, 466),
(101310131013, 'elephant', 104, 1056),
(101410141014, 'light', 100, 2),
(101510151015, 'congress', 100, NULL),
(101610161016, 'fan', 102, NULL),
(101710171017, 'bjp', 101, NULL),
(101810181018, 'congress', 101, NULL),
(101910191019, 'leaves', 104, 213),
(102010201020, 'sp', 104, 792),
(333333333333, 'bjp', 103, 5),
(444444444444, 'aap', 103, 3),
(555555555555, 'congress', 102, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidate`
--
ALTER TABLE `candidate`
  ADD UNIQUE KEY `uid` (`uid`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `candidate`
--
ALTER TABLE `candidate`
  ADD CONSTRAINT `candidate_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `aadhaar` (`uid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
