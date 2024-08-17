-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2024 at 10:12 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `plp_alumnisystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(10) NOT NULL,
  `AdminName` varchar(120) DEFAULT NULL,
  `UserName` varchar(120) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `AdminName`, `UserName`, `MobileNumber`, `Email`, `Password`, `AdminRegdate`) VALUES
(1, 'Admin', 'admin', 8979555558, 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '2023-12-01 04:36:52');

-- --------------------------------------------------------

--
-- Table structure for table `tblalumni`
--

CREATE TABLE `tblalumni` (
  `ID` int(10) NOT NULL,
  `FullName` varchar(250) DEFAULT NULL,
  `CollegeID` varchar(250) DEFAULT NULL,
  `Gender` varchar(250) DEFAULT NULL,
  `Batch` varchar(250) DEFAULT NULL,
  `CourseGraduated` int(10) DEFAULT NULL,
  `CurrentlyConnected` varchar(250) DEFAULT NULL,
  `Image` varchar(250) DEFAULT NULL,
  `Emailid` varchar(255) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblalumni`
--

INSERT INTO `tblalumni` (`ID`, `FullName`, `CollegeID`, `Gender`, `Batch`, `CourseGraduated`, `CurrentlyConnected`, `Image`, `Emailid`, `Password`, `RegDate`) VALUES
(7, 'Ritchmond James Tajarros', '21-00879', 'Male', '2025', 7, 'None', '34f0d63f515213ad8a15be72c8be1cc51704634463.jpg', 'tajarrosritchmond2002@gmail.com', 'ae8687a40cd259924fb7279474607325', '2024-01-07 13:34:23');

-- --------------------------------------------------------

--
-- Table structure for table `tblcourse`
--

CREATE TABLE `tblcourse` (
  `ID` int(5) NOT NULL,
  `CourseName` varchar(250) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcourse`
--

INSERT INTO `tblcourse` (`ID`, `CourseName`, `CreationDate`) VALUES
(1, 'BS in Information Technology (BSIT)', '2024-01-03 13:51:59'),
(2, 'BS in Computer Science (BSCS)', '2024-01-03 13:52:19'),
(3, 'Bachelor in Elementary Education (BEEd)', '2024-01-03 13:52:35'),
(4, 'Bachelor in Secondary Education Major in English (BSEd- English)', '2024-01-03 13:52:45'),
(5, 'Bachelor in Secondary Education Major in Filipino (BSEd- Filipino)', '2024-01-03 13:53:05'),
(6, 'Bachelor in Secondary Education Major in Mathematics (BSEd- Math)', '2024-01-03 13:53:18'),
(7, 'Bachelor of Science in Nursing (BSN)', '2024-01-03 13:53:23'),
(8, 'Bachelor of Science in Accountancy (BSA)', '2024-01-03 13:53:40'),
(9, 'Bachelor of Science in Business Administration Major in Marketing Management (BSBA)', '2024-01-03 14:03:23'),
(10, 'Bachelor of Science in Entrepreneurship (BS Entrep)', '2024-01-03 14:03:30'),
(11, 'Bachelor of Science in Hospitality Management (BSHM)', '2024-01-03 14:03:37'),
(12, 'Bachelor of Science in Electronics Engineering (BSECE)', '2024-01-03 13:53:23'),
(13, 'Bachelor of Arts in Psychology (ABPsy)', '2024-01-11 10:54:32');

-- --------------------------------------------------------

--
-- Table structure for table `tblevents`
--

CREATE TABLE `tblevents` (
  `ID` int(5) NOT NULL,
  `EventTitle` varchar(250) DEFAULT NULL,
  `Schedule` varchar(250) DEFAULT NULL,
  `Description` mediumtext DEFAULT NULL,
  `BannerImage` varchar(250) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblevents`
--

INSERT INTO `tblevents` (`ID`, `EventTitle`, `Schedule`, `Description`, `BannerImage`, `CreationDate`) VALUES
(2, 'PLPians & Alumni Mobile Legends Tournament ', '2024-03-12T10:00', 'Join us for an electrifying showdown in the \"PLPians & Alumni Mobile Legends Tournament\"! Calling all gaming enthusiasts from PLP and alumni to team up and clash in thrilling battles. Compete, strategize, and showcase your skills in this epic gaming event. It\'s a chance to reconnect, have fun, and embrace the spirit of friendly competition. Mark your calendars and get ready to dive into the action-packed world of Mobile Legends with your fellow PLPians and alumni!\r\n', '39eee1c2ac6bd1298a17a98bdbf53e671704549706.jpg', '2024-01-06 05:36:09');

-- --------------------------------------------------------

--
-- Table structure for table `tbljobpost`
--

CREATE TABLE `tbljobpost` (
  `ID` int(10) NOT NULL,
  `AlumniID` int(10) DEFAULT NULL,
  `JobTitle` varchar(250) DEFAULT NULL,
  `CompanyName` varchar(250) DEFAULT NULL,
  `Location` varchar(250) DEFAULT NULL,
  `Vacancy` int(10) DEFAULT NULL,
  `Designation` varchar(250) DEFAULT NULL,
  `JobDescription` mediumtext DEFAULT NULL,
  `ContactPerson` varchar(250) DEFAULT NULL,
  `ContactNumber` bigint(11) DEFAULT NULL,
  `LastDate` date DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `Remark` varchar(250) DEFAULT NULL,
  `Status` varchar(100) DEFAULT NULL,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblpage`
--

CREATE TABLE `tblpage` (
  `ID` int(10) NOT NULL,
  `PageType` varchar(200) DEFAULT NULL,
  `PageTitle` mediumtext DEFAULT NULL,
  `PageDescription` mediumtext DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `UpdationDate` date DEFAULT NULL,
  `Timing` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblpage`
--

INSERT INTO `tblpage` (`ID`, `PageType`, `PageTitle`, `PageDescription`, `Email`, `MobileNumber`, `UpdationDate`, `Timing`) VALUES
(1, 'contactus', 'Contact Us', '12-B Alcalde Jose, Pasig, 1600 Metro Manila', 'PLP_Alumni@gmail.com', 9177589353, NULL, '8:30 am to 6:30 pm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblalumni`
--
ALTER TABLE `tblalumni`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblcourse`
--
ALTER TABLE `tblcourse`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblevents`
--
ALTER TABLE `tblevents`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbljobpost`
--
ALTER TABLE `tbljobpost`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblpage`
--
ALTER TABLE `tblpage`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblalumni`
--
ALTER TABLE `tblalumni`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblcourse`
--
ALTER TABLE `tblcourse`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tblevents`
--
ALTER TABLE `tblevents`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbljobpost`
--
ALTER TABLE `tbljobpost`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tblpage`
--
ALTER TABLE `tblpage`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
