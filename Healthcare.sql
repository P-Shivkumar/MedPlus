

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


CREATE DATABASE IF NOT EXISTS Healthcare;
use Healthcare;

--
-- Database: `Healthcare`
--

-- --------------------------------------------------------

--
-- Table structure for table `Appointment`
--

CREATE TABLE `Appointment` (
  `D_ID` int(11) NOT NULL,
  `AptDate` date NOT NULL,
  `SlotCount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Appointment`
--

INSERT INTO `Appointment` (`D_ID`, `AptDate`, `SlotCount`) VALUES
(999001, '2018-04-14', 1),
(999001, '2018-04-14', 2),
(999001, '2018-04-15', 1),
(999001, '2018-04-16', 1),
(999001, '2018-04-16', 2),
(999001, '2018-04-16', 3),
(999002, '2018-04-14', 1),
(999002, '2018-04-14', 9),
(999002, '2018-04-16', 1);

-- --------------------------------------------------------

--
-- Table structure for table `consulted`
--

CREATE TABLE `consulted` (
  `P_ID` int(11) NOT NULL,
  `D_ID` int(11) NOT NULL,
  `ConsultDate` date NOT NULL,
  `AptTime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `consulted`
--

INSERT INTO `consulted` (`P_ID`, `D_ID`, `ConsultDate`, `AptTime`) VALUES
(1004, 999002, '2018-04-14', '09:00:00'),
(10020, 999002, '2018-04-14', '10:30:00'),
(1007, 999001, '2018-04-15', '09:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `Consults`
--

CREATE TABLE `Consults` (
  `P_ID` int(11) NOT NULL,
  `D_ID` int(11) NOT NULL,
  `ConsultDate` date NOT NULL,
  `AptTime` time NOT NULL,
  `islogin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Consults`
--

INSERT INTO `Consults` (`P_ID`, `D_ID`, `ConsultDate`, `AptTime`, `islogin`) VALUES
(1005, 999001, '2018-04-14', '09:00:00', 1),
(1006, 999001, '2018-04-14', '09:10:00', 1),
(1008, 999001, '2018-04-16', '09:00:00', 1),
(1009, 999001, '2018-04-16', '09:10:00', 1),
(1012, 999002, '2018-04-16', '09:00:00', 1),
(10022, 999001, '2018-04-16', '09:45:35', 0);

-- --------------------------------------------------------

--
-- Table structure for table `Doctor`
--

CREATE TABLE `Doctor` (
  `D_ID` int(11) NOT NULL,
  `D_name` varchar(64) NOT NULL,
  `Age` int(11) NOT NULL,
  `Address` varchar(64) NOT NULL,
  `Speciality` varchar(32) NOT NULL,
  `Email` varchar(64) NOT NULL,
  `Cabin` int(11) NOT NULL,
  `Slot` int(11) NOT NULL,
  `Fees` int(11) NOT NULL,
  `StartTime` time NOT NULL,
  `EndTime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Doctor`
--

INSERT INTO `Doctor` (`D_ID`, `D_name`, `Age`, `Address`, `Speciality`, `Email`, `Cabin`, `Slot`, `Fees`, `StartTime`, `EndTime`) VALUES
(999001, 'Ade Smith', 36, '2A Sai society', 'Ear Specialist', 'smith@gmail.com', 1, 10, 200, '09:00:00', '12:00:00'),
(999002, 'Bola Taio', 28, '21 malwan road', 'Heart Specialist', 'bola@gmail.com', 2, 10, 200, '09:00:00', '12:00:00'),
(999003, 'Robbin kin', 34, '2 krishna apartment, Bashi', 'MBBS', 'kin@gmail.com', 3, 10, 200, '09:00:00', '12:00:00'),
(999004, 'Robert Lawa', 44, '11 foreign street, Unilag', 'BHMS', 'lawa@gmail.com', 4, 10, 200, '13:00:00', '17:00:00'),
(999005, 'Husen Bolt', 45, 'satara road, Goan', 'BAMS', 'bolt@gmail.com', 5, 10, 200, '13:00:00', '17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `DoctorProfile`
--

CREATE TABLE `DoctorProfile` (
  `D_ID` int(11) NOT NULL,
  `imagename` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `DoctorProfile`
--

INSERT INTO `DoctorProfile` (`D_ID`, `imagename`) VALUES
(999001, 'contours_test.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `EmergencyApt`
--

CREATE TABLE `EmergencyApt` (
  `P_ID` int(11) NOT NULL,
  `D_ID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `EmergencyApt`
--

INSERT INTO `EmergencyApt` (`P_ID`, `D_ID`, `Date`, `Time`) VALUES
(10020, 999004, '2018-04-14', '10:21:47');

-- --------------------------------------------------------

--
-- Table structure for table `logininfo`
--

CREATE TABLE `logininfo` (
  `Email` varchar(64) NOT NULL,
  `Password` varchar(32) NOT NULL,
  `flag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logininfo`
--

INSERT INTO `logininfo` (`Email`, `Password`, `flag`) VALUES
('badal@gmail.com', 'badal123', 0),
('ben@gmail.com', 'ben123', 1),
('bola@gmail.com', 'bola123', 1),
('bolt@gmail.com', 'bolt123', 1),
('ganeshlandge936@gmail.com', 'ganesh123', 0),
('kin@gmail.com', 'kin123', 1),
('lawa@gmail.com', 'lawa123', 1),
('receptionist@gmail.com', 'book123', 2),
('shivkumarr.patil1997@gmail.com', 'shiv123', 0),
('smith@gmail.com', 'smith123', 1);

-- --------------------------------------------------------

--
-- Table structure for table `PatientLogin`
--

CREATE TABLE `PatientLogin` (
  `L_ID` int(11) NOT NULL,
  `P_name` varchar(64) NOT NULL,
  `Age` int(11) NOT NULL,
  `Address` varchar(64) NOT NULL,
  `Email` varchar(64) NOT NULL,
  `VisitCount` int(11) NOT NULL,
  `islogin` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `PatientLogin`
--

INSERT INTO `PatientLogin` (`L_ID`, `P_name`, `Age`, `Address`, `Email`, `VisitCount`, `islogin`) VALUES
(11, 'ganesh', 20, 'sant janabai nagar', 'ganeshlandge936@gmail.com', 0, 1),
(21, 'Shivkumar r Patil', 21, 'F201 coep hostel pune', 'shivkumarr.patil1997@gmail.com', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `PatientLoginPID`
--

CREATE TABLE `PatientLoginPID` (
  `L_ID` int(11) NOT NULL,
  `P_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `PatientLoginPID`
--

INSERT INTO `PatientLoginPID` (`L_ID`, `P_ID`) VALUES
(11, 1000),
(11, 1001),
(11, 1002),
(21, 1003),
(21, 1004),
(21, 1005),
(21, 1006),
(21, 1007),
(21, 1008),
(21, 1009),
(21, 1010),
(21, 1011),
(21, 1012);

-- --------------------------------------------------------

--
-- Table structure for table `PatientNotLogin`
--

CREATE TABLE `PatientNotLogin` (
  `P_ID` int(11) NOT NULL,
  `P_name` varchar(64) NOT NULL,
  `Age` int(11) NOT NULL,
  `Address` varchar(64) NOT NULL,
  `Email` varchar(64) NOT NULL,
  `VisitCount` int(11) NOT NULL,
  `islogin` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `PatientNotLogin`
--

INSERT INTO `PatientNotLogin` (`P_ID`, `P_name`, `Age`, `Address`, `Email`, `VisitCount`, `islogin`) VALUES
(10020, 'shivkumar patil', 23, 'patil colony, pune', 'patilsr15.it@coep.ac.in', 0, 2),
(10021, 'shivkumar Patil', 23, 'sadashivpeth, pune', 'landgegs@coep.ac.in', 0, 0),
(10022, 'balu mahore', 20, 'navi peth, pune', 'balu@gmail.com', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `PatientNotLoginPhone`
--

CREATE TABLE `PatientNotLoginPhone` (
  `P_ID` int(11) NOT NULL,
  `Phone` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `PatientProfile`
--

CREATE TABLE `PatientProfile` (
  `L_ID` int(11) NOT NULL,
  `Phone` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Prescription`
--

CREATE TABLE `Prescription` (
  `P_ID` int(11) NOT NULL,
  `Disease` varchar(64) NOT NULL,
  `Medicine` varchar(64) NOT NULL,
  `DosePerDay` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `PrescriptionDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Prescription`
--

INSERT INTO `Prescription` (`P_ID`, `Disease`, `Medicine`, `DosePerDay`, `Quantity`, `PrescriptionDate`) VALUES
(1007, 'cold', 'coldi', 2, 10, '2018-04-15'),
(1007, 'fever', 'crosin', 2, 10, '2018-04-15'),
(10020, 'fever', 'crosin', 3, 6, '2018-04-14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Appointment`
--
ALTER TABLE `Appointment`
  ADD PRIMARY KEY (`D_ID`,`AptDate`,`SlotCount`);

--
-- Indexes for table `Consults`
--
ALTER TABLE `Consults`
  ADD PRIMARY KEY (`P_ID`,`D_ID`,`ConsultDate`,`AptTime`),
  ADD KEY `D_ID` (`D_ID`);

--
-- Indexes for table `Doctor`
--
ALTER TABLE `Doctor`
  ADD PRIMARY KEY (`D_ID`);

--
-- Indexes for table `DoctorProfile`
--
ALTER TABLE `DoctorProfile`
  ADD PRIMARY KEY (`D_ID`);

--
-- Indexes for table `logininfo`
--
ALTER TABLE `logininfo`
  ADD PRIMARY KEY (`Email`);

--
-- Indexes for table `PatientLogin`
--
ALTER TABLE `PatientLogin`
  ADD PRIMARY KEY (`L_ID`);

--
-- Indexes for table `PatientLoginPID`
--
ALTER TABLE `PatientLoginPID`
  ADD PRIMARY KEY (`P_ID`,`L_ID`),
  ADD KEY `L_ID` (`L_ID`);

--
-- Indexes for table `PatientNotLogin`
--
ALTER TABLE `PatientNotLogin`
  ADD PRIMARY KEY (`P_ID`);

--
-- Indexes for table `PatientNotLoginPhone`
--
ALTER TABLE `PatientNotLoginPhone`
  ADD PRIMARY KEY (`Phone`,`P_ID`),
  ADD KEY `P_ID` (`P_ID`);

--
-- Indexes for table `PatientProfile`
--
ALTER TABLE `PatientProfile`
  ADD PRIMARY KEY (`Phone`,`L_ID`),
  ADD KEY `L_ID` (`L_ID`);

--
-- Indexes for table `Prescription`
--
ALTER TABLE `Prescription`
  ADD PRIMARY KEY (`P_ID`,`Medicine`,`PrescriptionDate`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Doctor`
--
ALTER TABLE `Doctor`
  MODIFY `D_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=999006;
--
-- AUTO_INCREMENT for table `PatientLogin`
--
ALTER TABLE `PatientLogin`
  MODIFY `L_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `PatientNotLogin`
--
ALTER TABLE `PatientNotLogin`
  MODIFY `P_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10023;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Appointment`
--
ALTER TABLE `Appointment`
  ADD CONSTRAINT `Appointment_ibfk_1` FOREIGN KEY (`D_ID`) REFERENCES `Doctor` (`D_ID`) ON DELETE CASCADE;

--
-- Constraints for table `Consults`
--
ALTER TABLE `Consults`
  ADD CONSTRAINT `Consults_ibfk_1` FOREIGN KEY (`D_ID`) REFERENCES `Doctor` (`D_ID`) ON DELETE CASCADE;

--
-- Constraints for table `DoctorProfile`
--
ALTER TABLE `DoctorProfile`
  ADD CONSTRAINT `DoctorProfile_ibfk_1` FOREIGN KEY (`D_ID`) REFERENCES `Doctor` (`D_ID`) ON DELETE CASCADE;

--
-- Constraints for table `PatientLoginPID`
--
ALTER TABLE `PatientLoginPID`
  ADD CONSTRAINT `PatientLoginPID_ibfk_1` FOREIGN KEY (`L_ID`) REFERENCES `PatientLogin` (`L_ID`) ON DELETE CASCADE;

--
-- Constraints for table `PatientNotLoginPhone`
--
ALTER TABLE `PatientNotLoginPhone`
  ADD CONSTRAINT `PatientNotLoginPhone_ibfk_1` FOREIGN KEY (`P_ID`) REFERENCES `PatientNotLogin` (`P_ID`) ON DELETE CASCADE;

--
-- Constraints for table `PatientProfile`
--
ALTER TABLE `PatientProfile`
  ADD CONSTRAINT `PatientProfile_ibfk_1` FOREIGN KEY (`L_ID`) REFERENCES `PatientLogin` (`L_ID`) ON DELETE CASCADE;

