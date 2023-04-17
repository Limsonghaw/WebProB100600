-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2023 at 09:22 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flexis`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employeeID` varchar(5) NOT NULL,
  `password` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `FWAStatus` varchar(20) NOT NULL DEFAULT 'New',
  `departmentID` varchar(10) NOT NULL,
  `supervisorID` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employeeID`, `password`, `name`, `position`, `email`, `FWAStatus`, `departmentID`, `supervisorID`) VALUES
('EMP01', '123', 'alice', 'Computer system', '123@gmail.com', 'None', 'IT', 'SUP01'),
('EMP02', '234', 'alice2', 'Accountant', '234@gmail.com', 'Work-from-home', 'Accounting', ''),
('EMP03', '345', 'alice3', 'Accountant', '345@gmail.com', 'New', 'Finance', 'EMP02'),
('EMP05', '555', 'alice5', 'Accountant', '555@gmail.com', 'Work-from-home', 'IT', 'SUP01'),
('EMP07', '777', 'alice7', 'Accountant', '777@gmail.com', 'Flexi-hour', 'Accounting', 'SUP01'),
('EMP08', '888', 'Lim Song Haw', 'Accountant', '888@gmail.com', 'Flexi-hour', 'Accounting', 'EMP02'),
('HRA01', '000', 'alice12', 'Computer system', '1212@gmail.com', 'None', 'IT', 'EMP09'),
('SUP01', '123', 'alice13', 'Computer system', '1313@gmail.com', 'None', 'IT', ''),
('SUP02', '123', 'alice10', 'Computer system', '1010gmail.com', 'None', 'Finance', '');

-- --------------------------------------------------------

--
-- Table structure for table `fwarequest`
--

CREATE TABLE `fwarequest` (
  `requestID` int(11) NOT NULL,
  `prefix` char(2) NOT NULL DEFAULT 'RQ',
  `requestDate` date NOT NULL DEFAULT current_timestamp(),
  `workType` varchar(20) NOT NULL,
  `description` varchar(500) NOT NULL,
  `reason` varchar(500) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'pending',
  `comment` varchar(300) DEFAULT NULL,
  `employeeID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fwarequest`
--

INSERT INTO `fwarequest` (`requestID`, `prefix`, `requestDate`, `workType`, `description`, `reason`, `status`, `comment`, `employeeID`) VALUES
(2, 'RQ', '2023-03-18', 'Hybrid', 'd', 'd', 'pending', NULL, 'EMP05'),
(4, 'RQ', '2023-03-21', 'Flexi-hour', 'No desc', 'No reason', 'accepted', 'hahahahahahha', 'EMP07'),
(5, 'RQ', '2023-03-22', 'Flexi-hour', 'No desc', 'No reason', 'accepted', 'No', 'EMP01'),
(9, 'RQ', '2023-03-21', 'Flexi-hour', 'No desc', 'No reason', 'rejected', '', 'EMP07'),
(16, 'RQ', '2023-03-30', 'Work-from-home', 'abc', 'Have to take care of family members', 'rejected', 'Not sufficient', 'EMP01');

-- --------------------------------------------------------

--
-- Table structure for table `updatedailyschedule`
--

CREATE TABLE `updatedailyschedule` (
  `ID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `WorkLocation` varchar(20) NOT NULL,
  `WorkHours` varchar(15) NOT NULL,
  `WorkReport` varchar(500) NOT NULL,
  `requestID` int(11) NOT NULL,
  `employeeID` varchar(5) NOT NULL,
  `Comment` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `updatedailyschedule`
--

INSERT INTO `updatedailyschedule` (`ID`, `Date`, `WorkLocation`, `WorkHours`, `WorkReport`, `requestID`, `employeeID`, `Comment`) VALUES
(84, '2023-04-02', 'Office', '8am - 4pm', 'sadasdasd', 5, 'EMP01', ''),
(96, '2023-03-29', 'Home', '10am - 6pm', 'asdadasd', 5, 'EMP01', 'okokokoko'),
(97, '2023-03-30', 'Home', '8am – 4pm', '56RHHFG', 5, 'EMP01', ''),
(105, '2023-04-07', 'Office', '10am – 6pm', 'acwc', 5, 'EMP01', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employeeID`);

--
-- Indexes for table `fwarequest`
--
ALTER TABLE `fwarequest`
  ADD PRIMARY KEY (`requestID`,`prefix`),
  ADD KEY `employee_FK` (`employeeID`);

--
-- Indexes for table `updatedailyschedule`
--
ALTER TABLE `updatedailyschedule`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `request_FK` (`requestID`),
  ADD KEY `employeeID_FK` (`employeeID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fwarequest`
--
ALTER TABLE `fwarequest`
  MODIFY `requestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `updatedailyschedule`
--
ALTER TABLE `updatedailyschedule`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fwarequest`
--
ALTER TABLE `fwarequest`
  ADD CONSTRAINT `employee_FK` FOREIGN KEY (`employeeID`) REFERENCES `employee` (`employeeID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
