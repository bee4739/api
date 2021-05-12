-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2021 at 03:57 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fpc`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_check`
--

CREATE TABLE `tb_check` (
  `Check_ID` int(5) NOT NULL COMMENT 'รหัสเช็คชื่อ',
  `Status_ID` int(5) NOT NULL COMMENT 'รหัสสถานะ',
  `Compensate_ID` int(5) NOT NULL COMMENT 'รหัสการสอนชดเชย',
  `Date` varchar(20) NOT NULL COMMENT 'วันที่',
  `Schedule_ID` int(5) NOT NULL COMMENT 'รหัสตารางสอน',
  `Std_No` int(5) NOT NULL COMMENT 'รหัสนักศึกษา'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_class`
--

CREATE TABLE `tb_class` (
  `Class_ID` int(5) NOT NULL COMMENT 'รหัสกลุ่มเรียน',
  `Subject_PK` int(5) NOT NULL COMMENT 'รหัสวิชา',
  `Group_Study` varchar(10) NOT NULL COMMENT 'รหัสกลุ่มเรียน',
  `Pass_Group` varchar(6) NOT NULL COMMENT 'รหัสผ่านเข้ากลุ่ม',
  `Year_ID` int(5) NOT NULL COMMENT 'รหัสปีการศึกษา',
  `User_ID` int(5) NOT NULL COMMENT '	รหัสผู้ใช้งาน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_class`
--

INSERT INTO `tb_class` (`Class_ID`, `Subject_PK`, `Group_Study`, `Pass_Group`, `Year_ID`, `User_ID`) VALUES
(11, 10, 'CPE.63231', '63231', 25, 2),
(13, 11, 'CPE.63231', '63231', 25, 2),
(14, 6, 'CPE.60231', '60231', 25, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_image`
--

CREATE TABLE `tb_image` (
  `Img_ID` int(2) NOT NULL COMMENT 'รหัสรูปภาพ',
  `User_ID` int(5) NOT NULL COMMENT 'รหัสผู้ใช้งาน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_login`
--

CREATE TABLE `tb_login` (
  `Login_ID` int(11) NOT NULL COMMENT 'รหัสการเข้าสู่ระบบ',
  `Session_ID` varchar(50) NOT NULL COMMENT 'รหัสสิทธิ์การใช้',
  `User_ID` int(5) NOT NULL COMMENT 'รหัสผู้ใช้งาน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_schedule`
--

CREATE TABLE `tb_schedule` (
  `Schedule_ID` int(5) NOT NULL COMMENT 'รหัสตารางสอน',
  `Day` varchar(20) NOT NULL COMMENT 'วัน',
  `Start_Time` varchar(20) NOT NULL COMMENT 'เวลาเริ่ม',
  `End_Time` varchar(20) NOT NULL COMMENT 'เวลาสิ้นสุด',
  `Class_ID` int(5) NOT NULL COMMENT 'รหัสกลุ่มเรียน',
  `Subject_Type` varchar(50) NOT NULL COMMENT 'ประเภทวิชา'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_schedule`
--

INSERT INTO `tb_schedule` (`Schedule_ID`, `Day`, `Start_Time`, `End_Time`, `Class_ID`, `Subject_Type`) VALUES
(11, '1', '09:00', '12:00', 14, 'ทฤษฎี'),
(13, '4', '09:00', '12:00', 13, 'ทฤษฎี'),
(14, '4', '01:00', '16:00', 11, 'ปฏิบัติ');

-- --------------------------------------------------------

--
-- Table structure for table `tb_schedule_composate`
--

CREATE TABLE `tb_schedule_composate` (
  `Composite_ID` int(5) NOT NULL COMMENT 'รหัสการสอนชดเชย',
  `Date_Composate` varchar(20) NOT NULL COMMENT 'วันที่สอนชดเชย',
  `Date_Normal` varchar(20) NOT NULL COMMENT 'วันที่เรียนปกติ',
  `Day` varchar(20) NOT NULL COMMENT 'วัน',
  `Start_Time` varchar(20) NOT NULL COMMENT 'เวลาเริ่มต้น',
  `End_Time` varchar(20) NOT NULL COMMENT 'เวลาสิ้นสุด',
  `Schedule_ID` int(5) NOT NULL COMMENT 'รหัสตารางสอน',
  `User_ID` int(5) NOT NULL COMMENT 'รหัสผู้ใช้งาน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_status`
--

CREATE TABLE `tb_status` (
  `Status_ID` int(2) NOT NULL COMMENT 'รหัสสถานะ',
  `Status_Name` varchar(15) NOT NULL COMMENT 'ชื่อสถานะ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_student`
--

CREATE TABLE `tb_student` (
  `Std_No` int(5) NOT NULL,
  `Std_ID` varchar(13) NOT NULL COMMENT 'รหัสนักศึกษา',
  `Std_FirstName` varchar(255) NOT NULL COMMENT 'ชื่อนักศึกษา',
  `Std_LastName` varchar(255) NOT NULL COMMENT 'นามสกุลนักศึกษา',
  `Class_ID` int(5) NOT NULL COMMENT 'ชื่อกลุ่มเรียน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_student`
--

INSERT INTO `tb_student` (`Std_No`, `Std_ID`, `Std_FirstName`, `Std_LastName`, `Class_ID`) VALUES
(3, '60172310128-4', 'Rattika', 'Noynaola', 11),
(3, '60172310128-4', 'Rattika', 'Noynaola', 13),
(3, '60172310128-4', 'Rattika', 'Noynaola', 14);

-- --------------------------------------------------------

--
-- Table structure for table `tb_subject`
--

CREATE TABLE `tb_subject` (
  `Subject_PK` int(2) NOT NULL COMMENT 'รหัสวิชา',
  `Subject_ID` varchar(14) NOT NULL COMMENT 'รหัสวิชา',
  `Subject_NameTH` varchar(255) NOT NULL COMMENT 'ชื่อวิชาภาษาไทย',
  `Subject_NameEN` varchar(255) NOT NULL COMMENT 'ชื่อวิชาภาษาอังกฤษ',
  `Subject_Theory` int(2) NOT NULL COMMENT 'วิชาทฤษฎี',
  `Subject_Practice` int(2) NOT NULL COMMENT 'วิชาปฏิบัติ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_subject`
--

INSERT INTO `tb_subject` (`Subject_PK`, `Subject_ID`, `Subject_NameTH`, `Subject_NameEN`, `Subject_Theory`, `Subject_Practice`) VALUES
(3, '04-061-102', 'ปฏิบัติการอุปกรณ์อิเล็กทรอนิกส์สำหรับวิศวกรรมคอมพิวเตอร์', 'Electronic Devices for Computer Engineering Labora', 0, 3),
(6, '04-061-310', 'โครงงานวิศวกรรมคอมพิวเตอร์ 1', 'Computer Engineering Project 1', 3, 0),
(7, '04-063-405', 'การรู้ภาพของคอมพิวเตอร์', 'Computer Vision', 3, 0),
(8, '04-061-301', 'การออกแบบระบบดิจิทัล', 'Digital System Design', 3, 0),
(9, '04-061-302', 'ปฏิบัติการออกแบบระบบดิจิทัล', 'Digital System Design Laboratory', 0, 3),
(10, '04-061-308', 'ปฏิบัติการไมโครคอนโทรลเลอร์', 'Microcontroller Laboratory', 0, 3),
(11, '04-061-307', 'ไมโครคอนโทรลเลอร์', 'Microcontroller', 3, 0),
(14, '04-063-403', 'คอมพิวเตอร์กราฟฟิก', 'Computer Graphics', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `User_ID` int(5) NOT NULL COMMENT 'รหัสผู้ใช้งาน',
  `Username` varchar(50) NOT NULL COMMENT 'ชื่อผู้ใช้งาน',
  `Std_ID` varchar(13) DEFAULT NULL COMMENT 'รหัสนักศึกษา',
  `FirstName` varchar(255) NOT NULL COMMENT 'ชื่อ',
  `LastName` varchar(255) NOT NULL COMMENT 'นามสกุล ',
  `Role` varchar(50) NOT NULL COMMENT 'สิทธิ์การใช้งาน',
  `User_Password` varchar(255) NOT NULL COMMENT 'รหัสผ่านผู้ใช้งาน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`User_ID`, `Username`, `Std_ID`, `FirstName`, `LastName`, `Role`, `User_Password`) VALUES
(1, 'admin', '', 'Admin', 'Admin', '0', '1234'),
(2, 'teacher', '', 'Teacher', 'Teacher', '1', '1234'),
(3, 'rattika.no', '60172310128-4', 'Rattika', 'Noynaola', '2', '1234'),
(6, 'surivipa.pa', '60172310130-2', 'Surivipa', 'Pansanthia', '2', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `tb_year`
--

CREATE TABLE `tb_year` (
  `Year_ID` int(5) NOT NULL COMMENT 'รหัสปีการศึกษา',
  `Year` varchar(20) NOT NULL COMMENT 'ปีการศึกษา',
  `Term` varchar(20) NOT NULL COMMENT 'ภาคการเรียน',
  `Start_SchYear` varchar(20) NOT NULL COMMENT 'วันเริ่มต้นปีการศึกษา',
  `End_SchYear` varchar(20) NOT NULL COMMENT 'วันสิ้นสุดปีการศึกษา',
  `Start_Midterm` varchar(20) NOT NULL COMMENT 'เริ่มต้นวันสอบมิดเทอม',
  `End_Midterm` varchar(20) NOT NULL COMMENT 'สิ้นสุดวันสอบมิดเทอม',
  `Start_Final` varchar(20) NOT NULL COMMENT 'เริ่มต้นวันสอบไฟนอล',
  `End_Final` varchar(20) NOT NULL COMMENT 'สิ้นสุดวันสอบไฟนอล'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_year`
--

INSERT INTO `tb_year` (`Year_ID`, `Year`, `Term`, `Start_SchYear`, `End_SchYear`, `Start_Midterm`, `End_Midterm`, `Start_Final`, `End_Final`) VALUES
(15, '2560', 'ภาคเรียนที่ 1', '2021-04-01', '2021-04-30', '2021-04-12', '2021-04-16', '2021-04-26', '2021-04-30'),
(16, '2560', 'ภาคเรียนที่ 2', '2021-04-01', '2021-04-30', '2021-04-12', '2021-04-16', '2021-04-26', '2021-04-30'),
(23, '2560', 'ภาคฤดูร้อน', '2021-04-08', '2021-04-21', '2021-04-21', '2021-04-16', '2021-04-09', '2021-04-17'),
(25, '2563', 'ภาคฤดูร้อน', '2021-04-19', '2021-06-09', '2021-05-10', '2021-05-11', '2021-06-07', '2021-06-08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_check`
--
ALTER TABLE `tb_check`
  ADD PRIMARY KEY (`Check_ID`);

--
-- Indexes for table `tb_class`
--
ALTER TABLE `tb_class`
  ADD PRIMARY KEY (`Class_ID`),
  ADD UNIQUE KEY `Subject_PK` (`Subject_PK`,`Group_Study`);

--
-- Indexes for table `tb_image`
--
ALTER TABLE `tb_image`
  ADD PRIMARY KEY (`Img_ID`,`User_ID`);

--
-- Indexes for table `tb_login`
--
ALTER TABLE `tb_login`
  ADD PRIMARY KEY (`Login_ID`);

--
-- Indexes for table `tb_schedule`
--
ALTER TABLE `tb_schedule`
  ADD PRIMARY KEY (`Schedule_ID`),
  ADD UNIQUE KEY `Class_ID` (`Class_ID`);

--
-- Indexes for table `tb_schedule_composate`
--
ALTER TABLE `tb_schedule_composate`
  ADD PRIMARY KEY (`Composite_ID`);

--
-- Indexes for table `tb_status`
--
ALTER TABLE `tb_status`
  ADD PRIMARY KEY (`Status_ID`);

--
-- Indexes for table `tb_student`
--
ALTER TABLE `tb_student`
  ADD PRIMARY KEY (`Std_No`,`Class_ID`),
  ADD UNIQUE KEY `Class_ID` (`Class_ID`);

--
-- Indexes for table `tb_subject`
--
ALTER TABLE `tb_subject`
  ADD PRIMARY KEY (`Subject_PK`),
  ADD UNIQUE KEY `Subject_ID` (`Subject_ID`,`Subject_NameTH`),
  ADD UNIQUE KEY `Subject_NameTH` (`Subject_NameTH`,`Subject_NameEN`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`User_ID`);

--
-- Indexes for table `tb_year`
--
ALTER TABLE `tb_year`
  ADD PRIMARY KEY (`Year_ID`),
  ADD UNIQUE KEY `Year` (`Year`,`Term`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_check`
--
ALTER TABLE `tb_check`
  MODIFY `Check_ID` int(5) NOT NULL AUTO_INCREMENT COMMENT 'รหัสเช็คชื่อ';

--
-- AUTO_INCREMENT for table `tb_class`
--
ALTER TABLE `tb_class`
  MODIFY `Class_ID` int(5) NOT NULL AUTO_INCREMENT COMMENT 'รหัสกลุ่มเรียน', AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_schedule`
--
ALTER TABLE `tb_schedule`
  MODIFY `Schedule_ID` int(5) NOT NULL AUTO_INCREMENT COMMENT 'รหัสตารางสอน', AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_schedule_composate`
--
ALTER TABLE `tb_schedule_composate`
  MODIFY `Composite_ID` int(5) NOT NULL AUTO_INCREMENT COMMENT 'รหัสการสอนชดเชย';

--
-- AUTO_INCREMENT for table `tb_subject`
--
ALTER TABLE `tb_subject`
  MODIFY `Subject_PK` int(2) NOT NULL AUTO_INCREMENT COMMENT 'รหัสวิชา', AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `User_ID` int(5) NOT NULL AUTO_INCREMENT COMMENT 'รหัสผู้ใช้งาน', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_year`
--
ALTER TABLE `tb_year`
  MODIFY `Year_ID` int(5) NOT NULL AUTO_INCREMENT COMMENT 'รหัสปีการศึกษา', AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
