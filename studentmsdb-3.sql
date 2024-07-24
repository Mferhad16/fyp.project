-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 24, 2024 at 12:22 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studentmsdb`
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
(1, 'Admin', 'admin', 1234567890, 'admin@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '2019-10-11 04:36:52'),
(2, 'admin2', 'admin2', 1232323, 'admin2@gmail.com', '123456789', '2024-07-23 07:25:57');

-- --------------------------------------------------------

--
-- Table structure for table `tblcourse`
--

CREATE TABLE `tblcourse` (
  `ID` int(11) NOT NULL,
  `coursename` varchar(11) NOT NULL,
  `coursecode` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcourse`
--

INSERT INTO `tblcourse` (`ID`, `coursename`, `coursecode`) VALUES
(1, 'ISE', 'CS266'),
(2, 'CS', 'CS230');

-- --------------------------------------------------------

--
-- Table structure for table `tblevent`
--

CREATE TABLE `tblevent` (
  `ID` int(5) NOT NULL,
  `eventname` varchar(50) DEFAULT NULL,
  `eventdate` date NOT NULL,
  `eoname` varchar(20) NOT NULL,
  `eaname` varchar(20) NOT NULL,
  `eventloc` varchar(50) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblevent`
--

INSERT INTO `tblevent` (`ID`, `eventname`, `eventdate`, `eoname`, `eaname`, `eventloc`, `CreationDate`) VALUES
(13, 'FYP', '2024-08-30', 'Rose Aqila', 'Dr shahida', 'Dewan Kuliah 2', '2024-07-23 08:34:01'),
(14, 'Food Festival', '2024-09-21', 'Ferhad', 'Dr Yuzi', 'Dewan Al-ghazali', '2024-07-23 15:56:14'),
(15, 'Potluck', '2024-07-31', 'Ferhad', 'Dr. Yuzi', 'Dewan Kuliah 2', '2024-07-23 19:35:23'),
(16, 'Graduation', '2024-10-04', 'Ferhad', 'Ahmad', 'DATC', '2024-07-24 06:00:33');

-- --------------------------------------------------------

--
-- Table structure for table `tbleventorganizer`
--

CREATE TABLE `tbleventorganizer` (
  `ID` int(10) NOT NULL,
  `eoname` varchar(200) DEFAULT NULL,
  `eoemail` varchar(200) DEFAULT NULL,
  `eocourse` varchar(100) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `studentid` varchar(200) DEFAULT NULL,
  `phonenumber` bigint(10) DEFAULT NULL,
  `username` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `DateofAdmission` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbleventorganizer`
--

INSERT INTO `tbleventorganizer` (`ID`, `eoname`, `eoemail`, `eocourse`, `gender`, `studentid`, `phonenumber`, `username`, `password`, `image`, `DateofAdmission`) VALUES
(7, 'rose', 'rose@gmail.com', '1', 'Female', '121232322', 123123, 'rose', 'e11170b8cbd2d74102651cb967fa28e5', 'bd7327203c617d959a158f3ce668e9471721734502.png', '2024-07-23 11:35:02'),
(8, 'Qila Rose', 'Qila11@gmail.com', '2', 'Female', '123123213', 23123231, 'qila', 'e11170b8cbd2d74102651cb967fa28e5', '194b457f7735ee5531c9300d744818581721736515jpeg', '2024-07-23 12:08:35'),
(9, 'muhammad raizal', 'raizal@gmail.com', '1', 'Male', '2012992312', 123912321, 'raizal', '25f9e794323b453885f5181f1b624d0b', '25ca42009979ad648bae721c2cf4ae7c1721737782.jpg', '2024-07-23 12:29:42'),
(10, 'muhammad ferhad bin nazri', 'ferhad@gmail.com', '2', 'Male', '2022912555', 175854603, 'ferhad', '25f9e794323b453885f5181f1b624d0b', '25ca42009979ad648bae721c2cf4ae7c1721738145.jpg', '2024-07-23 12:35:45'),
(12, 'nazri', 'nazri@gmail.com', 'CSCS230', 'Male', '1234567890', 1234567890, 'nazri', '1234567890', '25ca42009979ad648bae721c2cf4ae7c1721742051.jpg', '2024-07-23 13:40:51'),
(13, 'ferhad', 'ferhad@gmail.com', 'CS230', 'Male', '123456789', 123456789, 'yat', '25f9e794323b453885f5181f1b624d0b', '1b8f0e7455af97b71aecbdbda8f1d2d41721744436.png', '2024-07-23 14:20:36'),
(14, 'ainin', 'ainin@gmail.com', 'CS230', 'Female', '123123', 213213, 'ainin', '25f9e794323b453885f5181f1b624d0b', 'f19c9085129709ee14d013be869df69b1721764084.png', '2024-07-23 19:48:04'),
(15, 'Jamal', 'jamal@gmail.com', 'CS266', 'Male', '213213', 123123, 'jamal', '25f9e794323b453885f5181f1b624d0b', 'f19c9085129709ee14d013be869df69b1721764556.png', '2024-07-23 19:55:56'),
(16, 'kamal', 'kamal@gmail.com', 'CS266', 'Male', '2312324', 3214324, 'kamal', '25f9e794323b453885f5181f1b624d0b', 'c7c9e0bd395c6a61641806a55915e6c51721764655.png', '2024-07-23 19:57:35'),
(17, 'Aiman', 'aiman@gmail.com', 'CS230', 'Male', '56768', 675765, 'aiman', '25f9e794323b453885f5181f1b624d0b', 'ba1ac092a3a67a2c46904ccf506eb48d1721800922jpeg', '2024-07-24 06:02:02'),
(18, 'haikal', 'haikal@gmail.com', 'CS230', 'Male', '2022911333', 192878784, 'haikal', '25f9e794323b453885f5181f1b624d0b', 'ba1ac092a3a67a2c46904ccf506eb48d1721801473jpeg', '2024-07-24 06:11:13'),
(19, 'Aslam', 'aslam@gmail.com', '2', 'Male', '32432434', 3434545, 'aslam', '25f9e794323b453885f5181f1b624d0b', 'c7c9e0bd395c6a61641806a55915e6c51721803963.png', '2024-07-24 06:52:43'),
(20, 'afiq', 'afiq@gmail.com', '', 'Male', '454657567', 4556767876, 'afiq', '25f9e794323b453885f5181f1b624d0b', 'fb5c81ed3a220004b71069645f1128671721808159.png', '2024-07-24 08:02:39'),
(21, 'syafiq', 'safiq@gmail.com', '1', 'Male', '5676867', 7879789789, 'syafiq', '25f9e794323b453885f5181f1b624d0b', '09dd8c2662b96ce14928333f055c55801721808527.png', '2024-07-24 08:08:47'),
(22, 'safiq ahmad', 'saf@gmail.com', '2', 'Male', '34500353', 999999999, 'safiq', '25f9e794323b453885f5181f1b624d0b', '8266e4bfeda1bd42d8f9794eb4ea0a131721808572.png', '2024-07-24 08:09:32');

-- --------------------------------------------------------

--
-- Table structure for table `tblnotice`
--

CREATE TABLE `tblnotice` (
  `ID` int(5) NOT NULL,
  `NoticeTitle` mediumtext DEFAULT NULL,
  `ClassId` int(10) DEFAULT NULL,
  `NoticeMsg` mediumtext DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblnotice`
--

INSERT INTO `tblnotice` (`ID`, `NoticeTitle`, `ClassId`, `NoticeMsg`, `CreationDate`) VALUES
(2, 'Marks of Unit Test.', 3, 'Meet your class teacher for seeing copies of unit test', '2022-01-19 06:35:58'),
(3, 'Marks of Unit Test.', 2, 'Meet your class teacher for seeing copies of unit test', '2022-01-19 06:35:58'),
(4, 'Test', 3, 'This is for testing.', '2022-02-02 18:17:03'),
(5, 'Test Notice', 8, 'This is for Testing.', '2022-02-02 19:03:43');

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
  `UpdationDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblpage`
--

INSERT INTO `tblpage` (`ID`, `PageType`, `PageTitle`, `PageDescription`, `Email`, `MobileNumber`, `UpdationDate`) VALUES
(1, 'aboutus', 'About Us', '<div style=\"text-align: start;\"><font color=\"#7b8898\" face=\"Mercury SSm A, Mercury SSm B, Georgia, Times, Times New Roman, Microsoft YaHei New, Microsoft Yahei, ????, ??, SimSun, STXihei, ????, serif\"><span style=\"font-size: 26px;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</span></font><br></div>', NULL, NULL, NULL),
(2, 'contactus', 'Contact Us', '890,Sector 62, Gyan Sarovar, GAIL Noida(Delhi/NCR)', 'infodata@gmail.com', 7896541236, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblparticipant`
--

CREATE TABLE `tblparticipant` (
  `ID` int(11) NOT NULL,
  `studentIC` varchar(50) NOT NULL,
  `studentName` varchar(100) NOT NULL,
  `studentPhoneNumber` varchar(20) NOT NULL,
  `eventID` int(11) NOT NULL,
  `attendanceStatus` varchar(10) DEFAULT 'absent'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblparticipant`
--

INSERT INTO `tblparticipant` (`ID`, `studentIC`, `studentName`, `studentPhoneNumber`, `eventID`, `attendanceStatus`) VALUES
(1, '23123', 'sdasd', '23123', 13, 'absent'),
(2, '23123', 'sadasd', '13213', 13, 'absent'),
(3, '234234', 'sfsdf', '213', 13, 'absent'),
(4, '123213', 'dsadasd', '123213', 13, 'absent'),
(5, '2213', 'asdsad', '123213', 14, 'absent'),
(6, '23123', 'asdasd', '123213', 13, 'absent'),
(7, '23123', 'sad', '21321', 13, 'absent'),
(8, '213213', 'sad', '13123', 13, 'absent'),
(9, '34234', 'sad', '12312312', 13, 'absent'),
(10, '23123', 'sad', '123123', 14, 'absent'),
(11, '213213', 'sadas', '23324', 13, 'absent'),
(12, '23424', 'sdasdsfd', '323213', 14, 'absent'),
(13, '213213', 'dsfdsf', '121323', 14, 'absent'),
(14, '2324', 'sdfsdf', '23213', 15, 'absent');

-- --------------------------------------------------------

--
-- Table structure for table `tblpublicnotice`
--

CREATE TABLE `tblpublicnotice` (
  `ID` int(5) NOT NULL,
  `NoticeTitle` varchar(200) DEFAULT NULL,
  `NoticeMessage` mediumtext DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblcourse`
--
ALTER TABLE `tblcourse`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblevent`
--
ALTER TABLE `tblevent`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbleventorganizer`
--
ALTER TABLE `tbleventorganizer`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblnotice`
--
ALTER TABLE `tblnotice`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblpage`
--
ALTER TABLE `tblpage`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblparticipant`
--
ALTER TABLE `tblparticipant`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_eventID` (`eventID`);

--
-- Indexes for table `tblpublicnotice`
--
ALTER TABLE `tblpublicnotice`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblevent`
--
ALTER TABLE `tblevent`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbleventorganizer`
--
ALTER TABLE `tbleventorganizer`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tblnotice`
--
ALTER TABLE `tblnotice`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblpage`
--
ALTER TABLE `tblpage`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblparticipant`
--
ALTER TABLE `tblparticipant`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tblpublicnotice`
--
ALTER TABLE `tblpublicnotice`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblparticipant`
--
ALTER TABLE `tblparticipant`
  ADD CONSTRAINT `fk_eventID` FOREIGN KEY (`eventID`) REFERENCES `tblevent` (`ID`),
  ADD CONSTRAINT `tblparticipant_ibfk_1` FOREIGN KEY (`eventID`) REFERENCES `tblevent` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
