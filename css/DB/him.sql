-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2023 at 09:51 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `him`
--

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `ID` int(100) NOT NULL,
  `PID` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `phone` int(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `birthdate` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` int(100) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`ID`, `PID`, `firstname`, `lastname`, `phone`, `gender`, `birthdate`, `email`, `password`, `address`) VALUES
(4, '30112251600691', 'hussien', 'elassy', 1152356082, 'male', '2001-12-25', 'hussienelassy040@gmail.com', 123, 'trdyfugihjok'),
(5, '12345678910111', 'sara', 'mohamed', 1152356082, 'female', '1998-03-02', 'sara@gmail.com', 222, 'anywhere'),
(7, '32145678', 'ali', 'sayed', 13224565, 'male', '2023-05-15', 'alisayed1@gmail.com', 1234, 'EWARSDTFGHJ'),
(8, '21345', 'ahmed', 'mohamed', 3214546, 'male', '2023-05-15', 'ahmed1@gmail.com', 123456, 'SDRFGHJKJ');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `ID` int(100) NOT NULL,
  `PID` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `phone` int(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `birthdate` date NOT NULL,
  `emaill` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `passwords` int(100) NOT NULL,
  `conpassword` int(100) NOT NULL,
  `qualifications` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`ID`, `PID`, `firstname`, `lastname`, `phone`, `gender`, `birthdate`, `emaill`, `department`, `passwords`, `conpassword`, `qualifications`, `address`) VALUES
(5, '3011225600691', 'hussien', 'elassy', 1152356082, 'male', '2023-05-16', 'hussienelassy040@gmail.com', 'staff', 555, 555, 'WERTYUIOP', 'RTFGYHUJIKOLP[;\'\r\n'),
(6, '23456734256767', 'ali', 'sayed', 132435647, 'male', '2023-05-02', 'alisayed@gmail.com', 'IT', 4444, 4444, 'ewrtyj', 'aersrdtyfguh');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
