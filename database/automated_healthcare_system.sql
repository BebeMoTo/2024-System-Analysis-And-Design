-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2024 at 06:34 AM
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
(36, 'Camille', 'Aguila', '2024-01-10 02:29:50', 12, 23, 12, 'Bioflu');

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
(22, 'Biogesic', 'Cough, Cold, Body Pain', 'images/medPics/659aed3f29b48.jpg', '2024-01-08 02:28:15.182733', 140),
(23, 'Bioflu', 'Cough, Cold, Body Pain', 'images/medPics/659aed6bcfa18.png', '2024-01-08 02:28:59.872161', 363),
(24, 'Neozep', 'Cold', 'images/medPics/659b8e18a1044.jpg', '2024-01-08 13:54:32.662191', 295);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `requestID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `medID` int(11) NOT NULL,
  `medAmount` int(11) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`requestID`, `userID`, `medID`, `medAmount`, `createdAt`) VALUES
(1, 7, 23, 1, '2024-01-10 13:18:59');

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
(7, 'Jay-R', 'Buitre', 21, 'Male', '1339 Agoncillo st. Paco Manila', '09994702071', 'Cute', '2024-01-08 02:20:23.764656'),
(8, 'David Jr.', 'Miana', 21, 'Male', '150-6, Songhyeonri, Sanbuk-myeon', '09792956199', 'Sheesh', '2024-01-08 02:22:59.416123'),
(9, 'Kevin', 'Aranez', 22, 'Male', 'K. Firingera 1, 31000', '09558473375', 'Motor', '2024-01-08 02:24:03.290833'),
(10, 'Paul Patrick', 'Romero', 22, 'Male', '244 Brown Bear Drive', '09229918574', 'Emo', '2024-01-08 02:24:57.882064'),
(12, 'Camille', 'Aguila', 22, 'Female', '4586 Paco, Manila', '09668574463', 'Relapse', '2024-01-08 13:39:10.679703');

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
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`requestID`);

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
  MODIFY `historyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `meds`
--
ALTER TABLE `meds`
  MODIFY `medID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `requestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `idNum` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
