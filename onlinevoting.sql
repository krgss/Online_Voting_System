-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 13, 2017 at 11:17 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

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
-- Table structure for table `aadhaar`
--

CREATE TABLE `aadhaar` (
  `uid` bigint(12) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` mediumtext NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(1) NOT NULL,
  `pincode` bigint(6) NOT NULL,
  `fingerprint` text NOT NULL,
  `image` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Table structure for table `conpin`
--

CREATE TABLE `conpin` (
  `pincode` bigint(6) NOT NULL,
  `constituency` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `party`
--

CREATE TABLE `party` (
  `partyname` varchar(50) NOT NULL,
  `partysymbol` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `voter`
--

CREATE TABLE `voter` (
  `uid` bigint(12) NOT NULL,
  `vstatus` tinyint(1) NOT NULL,
  `time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aadhaar`
--
ALTER TABLE `aadhaar`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `candidate`
--
ALTER TABLE `candidate`
  ADD UNIQUE KEY `uid` (`uid`);

--
-- Indexes for table `conpin`
--
ALTER TABLE `conpin`
  ADD UNIQUE KEY `pincode` (`pincode`);

--
-- Indexes for table `party`
--
ALTER TABLE `party`
  ADD UNIQUE KEY `partyname` (`partyname`);

--
-- Indexes for table `voter`
--
ALTER TABLE `voter`
  ADD UNIQUE KEY `uid` (`uid`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `candidate`
--
ALTER TABLE `candidate`
  ADD CONSTRAINT `candidate_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `aadhaar` (`uid`);

--
-- Constraints for table `voter`
--
ALTER TABLE `voter`
  ADD CONSTRAINT `voter_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `aadhaar` (`uid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
