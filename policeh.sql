-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 22, 2023 at 08:23 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `policeh`
--

-- --------------------------------------------------------

--
-- Table structure for table `buildings`
--

CREATE TABLE `buildings` (
  `house_type` varchar(20) NOT NULL,
  `project_name` varchar(30) NOT NULL,
  `no_of_rooms` int(11) NOT NULL,
  `no_of_houses` int(11) NOT NULL,
  `building_id` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buildings`
--

INSERT INTO `buildings` (`house_type`, `project_name`, `no_of_rooms`, `no_of_houses`, `building_id`) VALUES
('apartment', 'Ndovu', 5, 2, '64e2ef30a0897');

-- --------------------------------------------------------

--
-- Table structure for table `houses`
--

CREATE TABLE `houses` (
  `house_no` int(11) NOT NULL,
  `building_id` varchar(30) NOT NULL,
  `status` varchar(11) NOT NULL DEFAULT 'vacant'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `houses`
--

INSERT INTO `houses` (`house_no`, `building_id`, `status`) VALUES
(1, '64e2ef30a0897', 'vacant'),
(2, '64e2ef30a0897', 'occupied');

-- --------------------------------------------------------

--
-- Table structure for table `occupations`
--

CREATE TABLE `occupations` (
  `building_id` varchar(40) NOT NULL,
  `house_no` int(11) NOT NULL,
  `officer_id` varchar(30) NOT NULL,
  `from` varchar(30) NOT NULL,
  `leave_date` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `occupations`
--

INSERT INTO `occupations` (`building_id`, `house_no`, `officer_id`, `from`, `leave_date`) VALUES
('64e2ef30a0897', 1, '87688', '2023-08-21', '2023-08-21'),
('64e2ef30a0897', 2, '87688', '2023-08-21', '');

-- --------------------------------------------------------

--
-- Table structure for table `officers`
--

CREATE TABLE `officers` (
  `id` int(11) NOT NULL,
  `officer_name` varchar(70) NOT NULL,
  `Dob` varchar(20) NOT NULL,
  `officer_no` varchar(20) NOT NULL,
  `gender` varchar(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `familysize` int(11) NOT NULL,
  `officer_type` varchar(10) NOT NULL,
  `building_id` varchar(30) NOT NULL,
  `house_no` int(11) NOT NULL,
  `date` varchar(30) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `officers`
--

INSERT INTO `officers` (`id`, `officer_name`, `Dob`, `officer_no`, `gender`, `email`, `phone`, `familysize`, `officer_type`, `building_id`, `house_no`, `date`) VALUES
(1, 'Joel Njau', '', '87688', 'male', 'joel@gmail.com', '0746220791', 4, 'normal', '64e2ef30a0897', 2, '2023-08-21 08:01:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `officers`
--
ALTER TABLE `officers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `officers`
--
ALTER TABLE `officers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
