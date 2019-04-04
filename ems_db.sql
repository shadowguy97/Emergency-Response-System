-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2019 at 01:22 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ems_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` varchar(20) NOT NULL,
  `admin_fname` varchar(20) NOT NULL,
  `admin_lname` varchar(20) NOT NULL,
  `admin_phone` varchar(11) NOT NULL,
  `admin_email` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `activated` varchar(30) NOT NULL,
  `eType` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_fname`, `admin_lname`, `admin_phone`, `admin_email`, `password`, `activated`, `eType`) VALUES
('100001', 'Pelumi', 'Olajide', '08012345678', 'test@test.com', 'ae2b1fca515949e5d54fb22b8ed95575', 'e36e51af6ac15801e2387af0e38546', 'Fire'),
('100002', 'Pelumi', 'Olajide', '08012345678', 'test@test.com', 'ae2b1fca515949e5d54fb22b8ed95575', '286517bd63e44ce00f216262855113', 'Security'),
('100003', 'Pelumi', 'Olajide', '08012345678', 'test@test.com', 'ae2b1fca515949e5d54fb22b8ed95575', 'f70e2f9034188c14b633c084a15814', 'Health'),
('100004', 'Pelumi', 'Olajide', '08170135301', 'test@testing.com', 'ae2b1fca515949e5d54fb22b8ed95575', 'd2136199b22c66d09b6c7fc91f88b2', 'General');

-- --------------------------------------------------------

--
-- Table structure for table `call_reciept`
--

CREATE TABLE `call_reciept` (
  `call_reciept_id` varchar(20) NOT NULL,
  `call_reciept_phone` varchar(11) NOT NULL,
  `call_reciept_date` varchar(20) NOT NULL,
  `sp_id` varchar(20) NOT NULL,
  `dcall_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `distress_call`
--

CREATE TABLE `distress_call` (
  `dcall_id` varchar(20) NOT NULL,
  `dcall_lat` varchar(50) NOT NULL,
  `dcall_long` varchar(50) NOT NULL,
  `dcall_type` varchar(10) NOT NULL,
  `dcall_phone` varchar(11) NOT NULL,
  `dcall_time` varchar(24) NOT NULL,
  `dcall_status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `distress_call`
--

INSERT INTO `distress_call` (`dcall_id`, `dcall_lat`, `dcall_long`, `dcall_type`, `dcall_phone`, `dcall_time`, `dcall_status`) VALUES
('1', '7.445158299999999', '3.8931364999999998', 'Health', '08170135301', '2019-02-28T12:44:06', 'Attended'),
('2', '7.445158299999999', '3.8931364999999998', 'Health', '08170135301', '2019-02-28T12:45:44', 'Attended'),
('3', '7.445158299999999', '3.8931364999999998', 'Health', '08170135301', '2019-02-28T12:48:17', 'Unattended'),
('4', '7.445158299999999', '3.8931364999999998', 'Fire', '08170135301', '2019-02-28T12:49:45', 'Unattended'),
('5', '7.445158299999999', '3.8931364999999998', 'Security', '08170135301', '2019-02-28 || 15:06:', 'Unattended'),
('6', '7.445158299999999', '3.8931364999999998', 'Health', '8170135301', '2019-03-02 || 15:35:26', 'Unattended'),
('7', '7.445158299999999', '3.8931364999999998', 'Health', '08170135301', '2019-03-04 || 2:47:18', 'Unattended'),
('8', '7.445158299999999', '3.8931364999999998', 'Fire', '08170135301', '2019-03-04 || 2:51:23', 'Unattended'),
('9', '7.445158299999999', '3.8931364999999998', 'Health', '08170135301', '2019-03-04 || 3:00:53', 'Unattended');

-- --------------------------------------------------------

--
-- Table structure for table `distress_response`
--

CREATE TABLE `distress_response` (
  `dr_id` varchar(20) NOT NULL,
  `dr_date` varchar(20) NOT NULL,
  `dr_remarks` varchar(50) NOT NULL,
  `sp_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `rpt_id` varchar(20) NOT NULL,
  `rpt_desc` varchar(15) NOT NULL,
  `rpt_date` varchar(20) NOT NULL,
  `rpt_details` varchar(50) NOT NULL,
  `sp_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `service_provider`
--

CREATE TABLE `service_provider` (
  `sp_id` varchar(20) NOT NULL,
  `sp_phone` varchar(11) NOT NULL,
  `sp_class` varchar(10) NOT NULL,
  `admin_id` varchar(20) NOT NULL,
  `sp_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service_provider`
--

INSERT INTO `service_provider` (`sp_id`, `sp_phone`, `sp_class`, `admin_id`, `sp_name`) VALUES
('100001', '08012345678', 'Security', '100001', 'Abefele');
INSERT INTO `service_provider` (`sp_id`, `sp_phone`, `sp_class`, `admin_id`, `sp_name`) VALUES
('100002', '08012345678', 'Health', '100001', 'Jaja');
INSERT INTO `service_provider` (`sp_id`, `sp_phone`, `sp_class`, `admin_id`, `sp_name`) VALUES
('100003', '08012345678', 'Fire', '100001', 'Fire');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` varchar(20) NOT NULL,
  `user_fname` varchar(20) NOT NULL,
  `user_lname` varchar(20) NOT NULL,
  `user_address` varchar(50) NOT NULL,
  `user_phone` varchar(11) NOT NULL,
  `user_dob` date NOT NULL,
  `user_blood_type` varchar(3) NOT NULL,
  `user_genotype` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_distress_call`
--

CREATE TABLE `user_distress_call` (
  `user_distress_id` varchar(20) NOT NULL,
  `user_distress_phone` varchar(11) NOT NULL,
  `user_distress_date` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `dcall_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `call_reciept`
--
ALTER TABLE `call_reciept`
  ADD PRIMARY KEY (`call_reciept_id`),
  ADD KEY `sp_id` (`sp_id`),
  ADD KEY `dcall_id` (`dcall_id`);

--
-- Indexes for table `distress_call`
--
ALTER TABLE `distress_call`
  ADD PRIMARY KEY (`dcall_id`);

--
-- Indexes for table `distress_response`
--
ALTER TABLE `distress_response`
  ADD PRIMARY KEY (`dr_id`),
  ADD KEY `sp_id` (`sp_id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`rpt_id`),
  ADD KEY `sp_id` (`sp_id`);

--
-- Indexes for table `service_provider`
--
ALTER TABLE `service_provider`
  ADD PRIMARY KEY (`sp_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_distress_call`
--
ALTER TABLE `user_distress_call`
  ADD PRIMARY KEY (`user_distress_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `dcall_id` (`dcall_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `call_reciept`
--
ALTER TABLE `call_reciept`
  ADD CONSTRAINT `call_reciept_ibfk_1` FOREIGN KEY (`sp_id`) REFERENCES `service_provider` (`sp_id`),
  ADD CONSTRAINT `call_reciept_ibfk_2` FOREIGN KEY (`dcall_id`) REFERENCES `distress_call` (`dcall_id`);

--
-- Constraints for table `distress_response`
--
ALTER TABLE `distress_response`
  ADD CONSTRAINT `distress_response_ibfk_1` FOREIGN KEY (`sp_id`) REFERENCES `service_provider` (`sp_id`);

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`sp_id`) REFERENCES `service_provider` (`sp_id`);

--
-- Constraints for table `service_provider`
--
ALTER TABLE `service_provider`
  ADD CONSTRAINT `service_provider_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`);

--
-- Constraints for table `user_distress_call`
--
ALTER TABLE `user_distress_call`
  ADD CONSTRAINT `user_distress_call_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `user_distress_call_ibfk_2` FOREIGN KEY (`dcall_id`) REFERENCES `distress_call` (`dcall_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
