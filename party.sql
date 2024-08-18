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
-- Table structure for table `party`
--

CREATE TABLE `party` (
  `partyname` varchar(50) NOT NULL,
  `partysymbol` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `party`
--

INSERT INTO `party` (`partyname`, `partysymbol`) VALUES
('AAP', 'aap.jpeg'),
('balance', 'balance.jpeg'),
('BJP', 'bjp.jpeg'),
('congress', 'congress.jpeg'),
('CPM', 'cpm.jpeg'),
('elephant', 'elephant.jpeg'),
('Fan', 'fan.jpeg'),
('independent', 'image_6.jpg'),
('Leaves', 'leaves.jpeg'),
('lion', 'lion.jpg'),
('Lock', 'lock.jpeg'),
('Lok Satta', 'loksatta.jpeg'),
('SP', 'sp.jpeg'),
('TRS', 'TRS.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `party`
--
ALTER TABLE `party`
  ADD UNIQUE KEY `partyname` (`partyname`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
