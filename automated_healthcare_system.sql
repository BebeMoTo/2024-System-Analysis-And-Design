-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2024 at 07:42 AM
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
  `amount` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`historyID`, `firstName`, `lastName`, `createdAt`, `idNum`, `medID`, `amount`) VALUES
(2, 'Middle', 'Liza', '2024-01-06 20:09:41', 2, NULL, 0),
(3, 'Middle', 'The Night', '2024-01-07 00:27:10', 2, 3, 0),
(4, 'Imong', 'Mama', '2024-01-07 00:27:48', 2, 3, 12);

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
(2, 'Robitussin', 'wsefwergerg', 'images/medPics/robitussin.avif', '0000-00-00 00:00:00.000000', 200),
(3, 'Biuoflu', 'It is used for the relief of clogged nose, runny nose, postnasal drip, itchy and watery eyes, sneezing, headache, body aches and fever associated with the common cold, allergic rhinitis, sinusitis, flu and other minor respiratory tract infections. It also helps decongest sinus openings and passages.', 'images/medPics/bioflu.png', '0000-00-00 00:00:00.000000', 200),
(4, 'Neozep', 'Neozep® Non-Drowsy is for the relief of colds, without the drowse. This medicine is used for the relief of clogged nose, post nasal drip, headache, body aches, and fever associated with the common cold, sinusitis, flu and other minor respiratory tract infections. It also helps decongest sinus opening and passages.', 'images/medPics/neozep.jpg', '0000-00-00 00:00:00.000000', 120);

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
(3, 'Jay-R', 'Buitre', 32, 'dfvbd', '1339 Agoncillo st. Paco Manila', '+639994702071', 'dawed', '2024-01-07 12:46:26.741444');

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
  MODIFY `historyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `meds`
--
ALTER TABLE `meds`
  MODIFY `medID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `idNum` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
