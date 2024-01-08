-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2024 at 03:27 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `automated_healthcare_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `username`, `password`) VALUES
(1, 'admin', 'admin'),
(2, 'maria', 'maria');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `historyID` int(11) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `idNum` int(11) DEFAULT NULL,
  `medID` int(11) DEFAULT NULL,
  `amount` int(3) NOT NULL,
  `medName` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`historyID`, `firstName`, `lastName`, `createdAt`, `idNum`, `medID`, `amount`, `medName`) VALUES
(5, 'Jay-R', 'Buitre', '2024-01-07 21:40:45', 1, 14, 100, ''),
(6, 'Jay-R', 'Buitre', '2024-01-07 21:59:56', 1, 14, 10, ''),
(7, 'Jay-R', 'Buitre', '2024-01-07 22:23:46', 1, 14, 162, 'Neozep'),
(8, 'Jay-R', 'Buitre', '2024-01-07 22:24:04', 1, 14, 161, 'Neozep'),
(9, 'Maria', 'Clara', '2024-01-07 22:25:10', 4, 14, 1, 'Neozep');

-- --------------------------------------------------------

--
-- Table structure for table `meds`
--

CREATE TABLE `meds` (
  `medID` int(5) NOT NULL,
  `medName` varchar(50) NOT NULL,
  `medDescription` text NOT NULL,
  `medImage` varchar(250) NOT NULL,
  `medDate` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `medAmount` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `meds`
--

INSERT INTO `meds` (`medID`, `medName`, `medDescription`, `medImage`, `medDate`, `medAmount`) VALUES
(14, 'Neozep', 'Shipon Shipon', 'images/medPics/659a95b1ab822.jpg', '2024-01-07 20:14:41.708009', 160),
(15, 'Biogesic', 'Ubo Ubo', 'images/medPics/biogesic.jpg', '0000-00-00 00:00:00.000000', 121),
(16, 'Bioflu', 'biot', 'images/medPics/bioflu.png', '0000-00-00 00:00:00.000000', 50);

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `idNum` int(9) NOT NULL,
  `firstName` varchar(200) NOT NULL,
  `lastName` varchar(200) NOT NULL,
  `age` int(3) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `address` varchar(200) NOT NULL,
  `emergency` varchar(200) NOT NULL,
  `diagnosis` varchar(250) NOT NULL,
  `date` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`idNum`, `firstName`, `lastName`, `age`, `sex`, `address`, `emergency`, `diagnosis`, `date`) VALUES
(1, 'Jay-R', 'Buitre', 32, 'dfv', '1339 Agoncillo st. Paco Manila', '+639994702071', 'sefse', '2024-01-06 17:06:48.806019'),
(2, 'Jay-R', 'Buitre', 30, 'noodles', '1339 Agoncillo st. Paco Manila', '+639994702071', 'sefsewef', '2024-01-06 17:08:00.864764'),
(3, 'Jay-R', 'Buitre', 32, 'dfvbd', '1339 Agoncillo st. Paco Manila', '+639994702071', 'dawed', '2024-01-07 12:46:26.741444'),
(4, 'Maria', 'Clara', 27, 'Female', 'Manila', '0999483953', 'Diabetes', '2024-01-07 22:01:23.745242');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`historyID`),
  ADD KEY `idNum` (`idNum`),
  ADD KEY `medID` (`medID`);

--
-- Indexes for table `meds`
--
ALTER TABLE `meds`
  ADD PRIMARY KEY (`medID`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`idNum`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `historyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `meds`
--
ALTER TABLE `meds`
  MODIFY `medID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `idNum` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_ibfk_1` FOREIGN KEY (`idNum`) REFERENCES `userinfo` (`idNum`) ON DELETE SET NULL,
  ADD CONSTRAINT `history_ibfk_2` FOREIGN KEY (`medID`) REFERENCES `meds` (`medID`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
