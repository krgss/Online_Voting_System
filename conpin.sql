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
-- Table structure for table `conpin`
--

CREATE TABLE `conpin` (
  `pincode` bigint(6) NOT NULL,
  `constituency` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `conpin`
--

INSERT INTO `conpin` (`pincode`, `constituency`) VALUES
(500001, 100),
(500002, 100),
(500003, 100),
(500004, 100),
(500005, 101),
(500006, 101),
(500007, 101),
(500008, 101),
(500009, 102),
(500010, 102),
(500011, 102),
(500012, 102),
(500013, 103),
(500014, 103),
(500015, 103),
(500016, 103),
(500017, 104),
(500018, 104),
(500019, 104),
(500020, 104),
(500021, 105),
(500022, 105),
(500023, 105);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `conpin`
--
ALTER TABLE `conpin`
  ADD UNIQUE KEY `pincode` (`pincode`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
