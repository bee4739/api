-- --------------------------------------------------------
-- Host:                         db-cluster.rmuti.ac.th
-- Server version:               5.7.22-ndb-7.6.6 - MySQL Cluster Community Server (GPL)
-- Server OS:                    Linux
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for fpc
CREATE DATABASE IF NOT EXISTS `fpc` /*!40100 DEFAULT CHARACTER SET tis620 */;
USE `fpc`;

-- Dumping structure for table fpc.tb_checked
CREATE TABLE IF NOT EXISTS `tb_checked` (
  `Std_No` int(5) NOT NULL,
  `Schedule_ID` int(5) DEFAULT NULL,
  `Class_ID` int(5) NOT NULL,
  `Composite_ID` int(5) DEFAULT NULL,
  `Status` varchar(20) DEFAULT NULL,
  `Time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Date` date GENERATED ALWAYS AS (cast(`Time` as date)) VIRTUAL,
  PRIMARY KEY (`Std_No`,`Time`),
  UNIQUE KEY `Student_ID` (`Std_No`,`Schedule_ID`,`Composite_ID`,`Date`),
  KEY `Class_ID` (`Class_ID`),
  KEY `Schedule_ID` (`Schedule_ID`),
  CONSTRAINT `tb_checked_ibfk_1` FOREIGN KEY (`Class_ID`) REFERENCES `tb_class` (`Class_ID`) ON UPDATE CASCADE,
  CONSTRAINT `tb_checked_ibfk_2` FOREIGN KEY (`Schedule_ID`) REFERENCES `tb_schedule` (`Schedule_ID`) ON UPDATE CASCADE,
  CONSTRAINT `tb_checked_ibfk_3` FOREIGN KEY (`Std_No`) REFERENCES `tb_student` (`Std_No`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table fpc.tb_checked: ~2 rows (approximately)
/*!40000 ALTER TABLE `tb_checked` DISABLE KEYS */;
REPLACE INTO `tb_checked` (`Std_No`, `Schedule_ID`, `Class_ID`, `Composite_ID`, `Status`, `Time`) VALUES
	(3, 22, 3, 0, 'สาย', '2021-10-05 19:41:15'),
	(3, 20, 2, 0, 'ปกติ', '2021-10-05 19:55:10');
/*!40000 ALTER TABLE `tb_checked` ENABLE KEYS */;

-- Dumping structure for table fpc.tb_class
CREATE TABLE IF NOT EXISTS `tb_class` (
  `Class_ID` int(5) NOT NULL AUTO_INCREMENT COMMENT 'รหัสกลุ่มเรียน',
  `Subject_PK` int(5) NOT NULL COMMENT 'รหัสวิชา',
  `Group_Study` varchar(10) NOT NULL COMMENT 'รหัสกลุ่มเรียน',
  `Pass_Group` varchar(6) NOT NULL COMMENT 'รหัสผ่านเข้ากลุ่ม',
  `Year_ID` int(5) NOT NULL COMMENT 'รหัสปีการศึกษา',
  `User_ID` int(5) NOT NULL COMMENT '	รหัสผู้ใช้งาน',
  PRIMARY KEY (`Class_ID`),
  UNIQUE KEY `Subject_PK` (`Subject_PK`,`Group_Study`),
  KEY `User_ID` (`User_ID`),
  KEY `Year_ID` (`Year_ID`),
  CONSTRAINT `tb_class_ibfk_1` FOREIGN KEY (`Subject_PK`) REFERENCES `tb_subject` (`Subject_PK`) ON UPDATE CASCADE,
  CONSTRAINT `tb_class_ibfk_2` FOREIGN KEY (`User_ID`) REFERENCES `tb_user` (`User_ID`) ON UPDATE CASCADE,
  CONSTRAINT `tb_class_ibfk_3` FOREIGN KEY (`Year_ID`) REFERENCES `tb_year` (`Year_ID`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table fpc.tb_class: ~6 rows (approximately)
/*!40000 ALTER TABLE `tb_class` DISABLE KEYS */;
REPLACE INTO `tb_class` (`Class_ID`, `Subject_PK`, `Group_Study`, `Pass_Group`, `Year_ID`, `User_ID`) VALUES
	(1, 1, 'CPE.62231', '62231', 1, 2),
	(2, 14, 'CPE.62231', '62231', 1, 2),
	(3, 10, 'CPE.62231', '62231', 1, 2),
	(4, 3, 'CPE.63231', '63231', 1, 2),
	(5, 4, 'CPE.63231', '63231', 1, 2),
	(6, 44, 'CPE.63231', '63231', 1, 2);
/*!40000 ALTER TABLE `tb_class` ENABLE KEYS */;

-- Dumping structure for table fpc.tb_image
CREATE TABLE IF NOT EXISTS `tb_image` (
  `Img_ID` int(2) NOT NULL COMMENT 'รหัสรูปภาพ',
  `User_ID` int(5) NOT NULL COMMENT 'รหัสผู้ใช้งาน',
  PRIMARY KEY (`Img_ID`,`User_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table fpc.tb_image: ~0 rows (approximately)
/*!40000 ALTER TABLE `tb_image` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_image` ENABLE KEYS */;

-- Dumping structure for table fpc.tb_login
CREATE TABLE IF NOT EXISTS `tb_login` (
  `Login_ID` int(11) NOT NULL COMMENT 'รหัสการเข้าสู่ระบบ',
  `Session_ID` varchar(50) NOT NULL COMMENT 'รหัสสิทธิ์การใช้',
  `User_ID` int(5) NOT NULL COMMENT 'รหัสผู้ใช้งาน',
  PRIMARY KEY (`Login_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table fpc.tb_login: ~0 rows (approximately)
/*!40000 ALTER TABLE `tb_login` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_login` ENABLE KEYS */;

-- Dumping structure for table fpc.tb_schedule
CREATE TABLE IF NOT EXISTS `tb_schedule` (
  `Schedule_ID` int(5) NOT NULL AUTO_INCREMENT COMMENT 'รหัสตารางสอน',
  `Day` varchar(20) NOT NULL COMMENT 'วัน',
  `Start_Time` varchar(20) NOT NULL COMMENT 'เวลาเริ่ม',
  `End_Time` varchar(20) NOT NULL COMMENT 'เวลาสิ้นสุด',
  `Class_ID` int(5) NOT NULL COMMENT 'รหัสกลุ่มเรียน',
  `Subject_Type` varchar(50) NOT NULL COMMENT 'ประเภทวิชา',
  PRIMARY KEY (`Schedule_ID`),
  UNIQUE KEY `Day` (`Day`,`Start_Time`,`Class_ID`),
  KEY `tb_schedule_ibfk_1` (`Class_ID`),
  CONSTRAINT `tb_schedule_ibfk_1` FOREIGN KEY (`Class_ID`) REFERENCES `tb_class` (`Class_ID`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- Dumping data for table fpc.tb_schedule: ~5 rows (approximately)
/*!40000 ALTER TABLE `tb_schedule` DISABLE KEYS */;
REPLACE INTO `tb_schedule` (`Schedule_ID`, `Day`, `Start_Time`, `End_Time`, `Class_ID`, `Subject_Type`) VALUES
	(18, '6', '00:05', '03:00', 1, 'ปฏิบัติ'),
	(20, '2', '16:00', '23:00', 2, 'ทฤษฎี'),
	(21, '0', '20:00', '23:00', 6, 'ทฤษฎี'),
	(22, '2', '19:00', '23:59', 3, 'ปฏิบัติ'),
	(23, '0', '05:30', '07:30', 1, 'ทฤษฎี');
/*!40000 ALTER TABLE `tb_schedule` ENABLE KEYS */;

-- Dumping structure for table fpc.tb_schedule_composate
CREATE TABLE IF NOT EXISTS `tb_schedule_composate` (
  `Composite_ID` int(5) NOT NULL AUTO_INCREMENT COMMENT 'รหัสการสอนชดเชย',
  `Date_Composate` varchar(20) NOT NULL COMMENT 'วันที่สอนชดเชย',
  `Date_Normal` varchar(20) NOT NULL COMMENT 'วันที่เรียนปกติ',
  `Day_Composate` varchar(20) NOT NULL COMMENT 'วัน',
  `Start_Time_Composate` varchar(20) NOT NULL COMMENT 'เวลาเริ่มต้น',
  `End_Time_Composate` varchar(20) NOT NULL COMMENT 'เวลาสิ้นสุด',
  `Schedule_ID` int(5) NOT NULL COMMENT 'รหัสตารางสอน',
  PRIMARY KEY (`Composite_ID`),
  KEY `Schedule_ID` (`Schedule_ID`),
  CONSTRAINT `tb_schedule_composate_ibfk_1` FOREIGN KEY (`Schedule_ID`) REFERENCES `tb_schedule` (`Schedule_ID`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table fpc.tb_schedule_composate: ~0 rows (approximately)
/*!40000 ALTER TABLE `tb_schedule_composate` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_schedule_composate` ENABLE KEYS */;

-- Dumping structure for table fpc.tb_status
CREATE TABLE IF NOT EXISTS `tb_status` (
  `Status_ID` int(2) NOT NULL COMMENT 'รหัสสถานะ',
  `Status_Name` varchar(15) NOT NULL COMMENT 'ชื่อสถานะ',
  PRIMARY KEY (`Status_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table fpc.tb_status: ~3 rows (approximately)
/*!40000 ALTER TABLE `tb_status` DISABLE KEYS */;
REPLACE INTO `tb_status` (`Status_ID`, `Status_Name`) VALUES
	(1, 'ขาด'),
	(2, 'ลา'),
	(3, 'สาย');
/*!40000 ALTER TABLE `tb_status` ENABLE KEYS */;

-- Dumping structure for table fpc.tb_student
CREATE TABLE IF NOT EXISTS `tb_student` (
  `Std_No` int(5) NOT NULL,
  `Std_ID` varchar(13) NOT NULL COMMENT 'รหัสนักศึกษา',
  `Std_Title` varchar(20) NOT NULL,
  `Std_FirstName` varchar(255) NOT NULL COMMENT 'ชื่อนักศึกษา',
  `Std_LastName` varchar(255) NOT NULL COMMENT 'นามสกุลนักศึกษา',
  `Class_ID` int(5) NOT NULL COMMENT 'ชื่อกลุ่มเรียน',
  PRIMARY KEY (`Std_No`,`Class_ID`),
  KEY `Class_ID` (`Class_ID`),
  CONSTRAINT `tb_student_ibfk_1` FOREIGN KEY (`Class_ID`) REFERENCES `tb_class` (`Class_ID`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table fpc.tb_student: ~35 rows (approximately)
/*!40000 ALTER TABLE `tb_student` DISABLE KEYS */;
REPLACE INTO `tb_student` (`Std_No`, `Std_ID`, `Std_Title`, `Std_FirstName`, `Std_LastName`, `Class_ID`) VALUES
	(3, '60172310128-4', 'นางสาว', 'รัตติกา', 'น้อยเนาลา', 1),
	(3, '60172310128-4', 'นางสาว', 'รัตติกา', 'น้อยเนาลา', 2),
	(3, '60172310128-4', 'นางสาว', 'รัตติกา', 'น้อยเนาลา', 3),
	(3, '60172310128-4', 'นางสาว', 'รัตติกา', 'น้อยเนาลา', 6),
	(6, '60172310130-2', 'นางสาว', 'สุริวิภา', 'ปั่นสันเทียะ', 1),
	(6, '60172310130-2', 'นางสาว', 'สุริวิภา', 'ปั่นสันเทียะ', 2),
	(7, '60172310129-4', 'นางสาว', 'สุมิลตา', 'สิทธิ์สันเทียะ', 1),
	(9, '60172310131-2', 'นาย', 'จอมพล', 'กระจ่างโพธิ์', 1),
	(10, '60172310185-1', 'นาย', 'จารุกิตต์', 'บุญจันทร์', 1),
	(11, '60172310006-9', 'นาย', 'ณัฐสิทธิ์', 'ผัดตุ่น', 1),
	(12, '60172310311-4', 'นาย', 'เนติพงศ์', 'สุนันทิพย์', 1),
	(13, '59172310204-9', 'นาย', 'กิตติภณ', 'รักษาคุณ', 1),
	(14, '61172310227-1', 'นาย', 'ธนากร​', 'จีน​วงศ์', 1),
	(18, '60152310034-7', 'นางสาว', 'จิราพร', 'พุดขุนทด', 1),
	(19, '58172110027-3', 'นาย', 'อนันทวัฒน์', 'หึกขุนทด', 1),
	(20, '61172310025-3', 'นางสาว', 'กนกอร​', 'หอย​ตะคุ​', 1),
	(21, '59172310184-3', 'นาย', 'อนุชิต', 'สายศร', 1),
	(22, '59172310009-1', 'นาย', 'วรพล', 'อุไรพรรณ', 1),
	(23, '60172310322-2', 'นางสาว', 'วีร์นันทิยา', 'ทรัพย์มาก', 1),
	(24, '61172310101-6', 'นาย', 'ธีรวุฒิ', 'ขันพันธ์', 1),
	(25, '60172310133-2', 'นาย', 'วันชัย', 'รัตนรักษ์', 1),
	(26, '60172310215-5', 'นาย', 'เมธา', 'ประทุมภา', 1),
	(27, '61172310280-8', 'นางสาว', 'เบญจพร', 'กิตติวิเชียรชัย', 1),
	(28, '61172310331-8', 'นาย', 'สถาพร', 'มณีบุญ', 1),
	(29, '62172310127-0', 'นาย', 'กันต์ธร', 'วงษ์โสมะ', 1),
	(30, '59172310003-1', 'นาย', 'ธีรโชฒ', 'ศรีริ', 1),
	(31, '60172310022-5', 'นาย', 'ศรายุทธ', 'ไกรษร', 1),
	(32, '60172310309-6', 'นาย', 'คมอิทธิเบศ', 'แมบจันทึก', 1),
	(33, '62172310386-5', 'นางสาว', 'ญาณิศา', 'แต่งตั้ง', 1),
	(34, '62182110010-5', 'นาย', 'วัชระ', 'ซ้ายกระโทก', 1),
	(35, '60172310325-2', 'นาย', 'วันชัย', 'สีหะวงษ์', 1),
	(36, '60172310305-6', 'นาย', 'นนทวัฒน์', 'ป้อมสนาม', 1),
	(37, '59172310032-5', 'นาย', 'กฤษดา', 'คลายทุกข์', 1),
	(38, '60172310194-9', 'นาย', 'พิชญากร', 'ศรีเนาวรัตน์', 1),
	(39, '611723104249', 'นาย', 'อารันต์', 'ความสวัสดิ์', 1),
	(40, '60152310180-5', 'นางสาว', 'นฤมล', 'ศรีบุรี', 1);
/*!40000 ALTER TABLE `tb_student` ENABLE KEYS */;

-- Dumping structure for table fpc.tb_subject
CREATE TABLE IF NOT EXISTS `tb_subject` (
  `Subject_PK` int(2) NOT NULL AUTO_INCREMENT COMMENT 'รหัสวิชา',
  `Subject_ID` varchar(14) NOT NULL COMMENT 'รหัสวิชา',
  `Subject_NameTH` varchar(255) NOT NULL COMMENT 'ชื่อวิชาภาษาไทย',
  `Subject_NameEN` varchar(255) NOT NULL COMMENT 'ชื่อวิชาภาษาอังกฤษ',
  `Subject_Theory` int(2) NOT NULL COMMENT 'วิชาทฤษฎี',
  `Subject_Practice` int(2) NOT NULL COMMENT 'วิชาปฏิบัติ',
  PRIMARY KEY (`Subject_PK`),
  UNIQUE KEY `Subject_ID` (`Subject_ID`,`Subject_NameTH`),
  UNIQUE KEY `Subject_NameTH` (`Subject_NameTH`,`Subject_NameEN`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

-- Dumping data for table fpc.tb_subject: ~41 rows (approximately)
/*!40000 ALTER TABLE `tb_subject` DISABLE KEYS */;
REPLACE INTO `tb_subject` (`Subject_PK`, `Subject_ID`, `Subject_NameTH`, `Subject_NameEN`, `Subject_Theory`, `Subject_Practice`) VALUES
	(1, '04-061-404', 'โครงงานวิศวกรรมคอมพิวเตอร์ 2', 'Computer Engineering Project 2', 3, 0),
	(2, '04-060-101', 'การโปรแกรมคอมพิวเตอร์', 'Computer Programming', 3, 0),
	(3, '04-061-101', 'อุปกรณ์อิเล็กทรอนิกส์สำหรับวิศวกรรมคอมพิวเตอร์', 'Electronic Devices for Computer Engineering', 2, 0),
	(4, '04-061-102', 'ปฏิบัติการอุปกรณ์อิเล็กทรอนิกส์สำหรับวิศวกรรมคอมพิวเตอร์', 'Electronic Devices for Computer Engineering Laboratory', 0, 3),
	(5, '04-061-204', 'ปฏิบัติการวงจรดิจิทัลและลอจิก', 'Digital and Logic Circuits Laboratory', 0, 3),
	(6, '04-061-203', 'วงจรดิจิทัลและลอจิก', 'Digital and Logic Circuits', 2, 0),
	(7, '04-061-201', 'สถิติสำหรับวิศวกรรมคอมพิวเตอร์', 'Statistics for Computer Engineering', 3, 0),
	(9, '04-061-208', 'ปฏิบัติการวงจรอิเล็กทรอนิกส์สำหรับวิศวกรรมคอมพิวเตอร์', 'Electronic Circuits for Computer Engineering Laboratory', 0, 3),
	(10, '04-061-212', 'ปฏิบัติการโครงสร้างข้อมูลและอัลกอริทึม', 'Data Structures and Algorithms Laboratory', 0, 3),
	(11, '04-061-214', 'ปฏิบัติการโปรแกรมเชิงวัตถุ', 'Object-Oriented Programming Laboratory', 0, 3),
	(12, '04-061-207', 'วงจรอิเล็กทรอนิกส์สำหรับวิศวกรรมคอมพิวเตอร์', 'Electronic Circuits for Computer Engineering', 2, 0),
	(13, '04-061-209', 'สถาปัตยกรรมคอมพิวเตอร์และระบบ 1', 'Computer Architecture and Organization 1', 2, 0),
	(14, '04-061-211', 'โครงสร้างข้อมูลและอัลกอริทึม', 'Data Structures and Algorithms', 3, 0),
	(15, '04-061-213', 'การโปรแกรมเชิงวัตถุ', 'Object-Oriented Programming', 2, 0),
	(16, '04-061-202', 'คณิตศาสตร์ดิสครีตสำหรับวิศวกรรม', 'Discrete Mathematics for Engineering', 3, 0),
	(18, '04-061-206', 'ปฏิบัติการวัดและเครื่องมือวัดสัญญาณดิจิทัล', 'Measurement and Digital Signal Instrument Laboratory', 0, 3),
	(19, '04-061-304', 'ปฏิบัติการระบบฐานข้อมูล', 'Database System Laboratory', 2, 0),
	(20, '04-061-205', 'การวัดและเครื่องมือวัดสัญญาณดิจิทัล', 'Measurement and Digital Signal Instrument', 2, 0),
	(21, '04-061-210', 'สถาปัตยกรรมคอมพิวเตอร์และระบบ 2', 'Computer Architecture and Organization 2', 2, 0),
	(22, '04-061-303', 'ระบบฐานข้อมูล', 'Database System', 2, 0),
	(23, '04-061-215', 'การสื่อสารข้อมูล', 'Data Communication', 3, 0),
	(24, '04-063-407', 'เหมืองข้อมูล', 'Data Mining', 3, 0),
	(25, '04-061-309', 'ระบบปฏิบัติการ', 'Operating System', 3, 0),
	(26, '04-062-403', 'การออกแบบวงจรใหญ่มาก', 'VLSI Designs', 3, 0),
	(27, '04-063-406', 'ปัญญาประดิษฐ์', 'Artificial Intelligence', 3, 0),
	(28, '04-061-302', 'ปฏิบัติการออกแบบระบบดิจิทัล', 'Digital System Design Laboratory', 0, 3),
	(29, '04-061-306', 'ปฏิบัติการเครือข่ายคอมพิวเตอร์', 'Computer Network Laboratory', 0, 3),
	(30, '04-061-308', 'ปฏิบัติการไมโครคอนโทรลเลอร์', 'Microcontroller Laboratory', 0, 3),
	(31, '04-061-310', 'โครงงานวิศวกรรมคอมพิวเตอร์ 1', 'Computer Engineering Project 1', 2, 0),
	(32, '04-061-301', 'การออกแบบระบบดิจิทัล', 'Digital System Design', 2, 0),
	(33, '04-061-305', 'เครือข่ายคอมพิวเตอร์', 'Computer Network', 2, 0),
	(34, '04-061-307', 'ไมโครคอนโทรลเลอร์', 'Microcontroller', 2, 0),
	(35, '04-061-401', 'วิศวกรรมซอฟต์แวร์', 'Software Engineering', 3, 0),
	(36, '04-063-405', 'การรู้ภาพของคอมพิวเตอร์', 'Computer Vision', 3, 0),
	(37, '04-063-402', 'ปฏิบัติการพัฒนาโปรแกรมบนเว็บ', 'Web Programming Laboratory', 0, 3),
	(38, '04-064-402', 'ปฏิบัติการรักษาความปลอดภัยคอมพิวเตอร์', 'Computer Security Laboratory', 0, 3),
	(39, '04-031-308', 'การเตรียมความพร้อมก่อนสหกิจศึกษาสำหรับวิศวกรรม', 'Pre-Cooperative Education for Engineering', 2, 0),
	(40, '04-063-401', 'การพัฒนาโปรแกรมบนเว็บ', 'Web Programming', 2, 0),
	(41, '04-064-401', 'การรักษาความปลอดภัยคอมพิวเตอร์', 'Computer Security', 2, 0),
	(42, '04-063-403', 'คอมพิวเตอร์กราฟฟิก', 'Computer Graphics', 3, 0),
	(44, '04-020-202', 'วงจรไฟฟ้า 1', 'Electric Circuits 1', 3, 0);
/*!40000 ALTER TABLE `tb_subject` ENABLE KEYS */;

-- Dumping structure for table fpc.tb_user
CREATE TABLE IF NOT EXISTS `tb_user` (
  `User_ID` int(5) NOT NULL AUTO_INCREMENT COMMENT 'รหัสผู้ใช้งาน',
  `Username` varchar(50) NOT NULL COMMENT 'ชื่อผู้ใช้งาน',
  `Std_ID` varchar(13) DEFAULT NULL COMMENT 'รหัสนักศึกษา',
  `Title` varchar(20) DEFAULT NULL COMMENT 'คำนำหน้าชื่อภาษาไทย',
  `FirstName` varchar(255) NOT NULL COMMENT 'ชื่อภาษาไทย',
  `LastName` varchar(255) NOT NULL COMMENT 'นามสกุลภาษาไทย',
  `Title_Eng` varchar(20) DEFAULT NULL COMMENT 'คำนำหน้าชื่อภาษาอังกฤษ',
  `FirstName_Eng` varchar(255) NOT NULL COMMENT 'ชื่อภาษาอังกฤษ',
  `LastName_Eng` varchar(255) NOT NULL COMMENT 'นามสกุลภาษาอังกฤษ',
  `Role` varchar(50) NOT NULL COMMENT 'สิทธิ์การใช้งาน',
  `User_Password` varchar(255) NOT NULL COMMENT 'รหัสผ่านผู้ใช้งาน',
  PRIMARY KEY (`User_ID`),
  UNIQUE KEY `Username` (`Username`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

-- Dumping data for table fpc.tb_user: ~34 rows (approximately)
/*!40000 ALTER TABLE `tb_user` DISABLE KEYS */;
REPLACE INTO `tb_user` (`User_ID`, `Username`, `Std_ID`, `Title`, `FirstName`, `LastName`, `Title_Eng`, `FirstName_Eng`, `LastName_Eng`, `Role`, `User_Password`) VALUES
	(1, 'admin', '', '', 'ผู้ดูแลระบบ', 'ผู้ดูแลระบบ', '', 'Admin', 'Admin', '0', '1234'),
	(2, 'teacher', '', '', 'อาจารย์', 'อาจารย์', '', 'Teacher', 'Teacher', '1', '1234'),
	(3, 'rattika.no', '60172310128-4', 'นางสาว', 'รัตติกา', 'น้อยเนาลา', 'Miss.', 'Rattika', 'Noynaola', '2', '1234'),
	(6, 'surivipa.pa', '60172310130-2', 'นางสาว', 'สุริวิภา', 'ปั่นสันเทียะ', 'Miss.', 'Surivipa', 'Pansanthia', '2', '1234'),
	(7, 'suminta.si', '60172310129-4', 'นางสาว', 'สุมิลตา', 'สิทธิ์สันเทียะ', 'Miss.', 'Suminta', 'Sitsanthia', '2', '1234'),
	(9, 'jompon.kr', '60172310131-2', 'นาย', 'จอมพล', 'กระจ่างโพธิ์', 'Mr.', 'Jompon', 'Krajangpo', '2', '1234'),
	(10, 'jarukit.bu', '60172310185-1', 'นาย', 'จารุกิตต์', 'บุญจันทร์', 'Mr.', 'Jarukit', 'Bunchan', '2', '1234'),
	(11, 'nuttacit.ph', '60172310006-9', 'นาย', 'ณัฐสิทธิ์', 'ผัดตุ่น', 'Mr.', 'Nuttacit', 'Phattun', '2', '1234'),
	(12, 'naetiphong.su', '60172310311-4', 'นาย', 'เนติพงศ์', 'สุนันทิพย์', 'Mr.', 'Neatiphong', 'Sunantip', '2', '1234'),
	(13, 'kittiphon.ra', '59172310204-9', 'นาย', 'กิตติภณ', 'รักษาคุณ', 'Mr.', 'Kittiphon', 'Raksakhun', '2', '1234'),
	(14, 'thanakorn​.je', '61172310227-1', 'นาย', 'ธนากร​', 'จีน​วงศ์', 'Mr.', 'Thanakorn​', 'Jeenwong', '2', '1234'),
	(18, 'jiraporn.pu', '60152310034-7', 'นางสาว', 'จิราพร', 'พุดขุนทด', 'Miss.', 'Jiraporn', 'Pudkhunthod', '2', '1234'),
	(19, 'anantawad.hu', '58172110027-3', 'นาย', 'อนันทวัฒน์', 'หึกขุนทด', '', 'Anantawad', 'Huekkhuntod', '2', '1234'),
	(20, 'kanokorn.ho', '61172310025-3', 'นางสาว', 'กนกอร​', 'หอย​ตะคุ​', 'Miss.', 'Kanokorn', 'Hoitakhu​', '2', '1234'),
	(21, 'anuchit.sa', '59172310184-3', 'นาย', 'อนุชิต', 'สายศร', 'Mr.', 'Anuchit', 'Saisorn', '2', '1234'),
	(22, 'vorapol.ur', '59172310009-1', 'นาย', 'วรพล', 'อุไรพรรณ', 'Mr.', 'Vorapol', 'Uraipan', '2', '1234'),
	(23, 'veenantiya.su', '60172310322-2', 'นางสาว', 'วีร์นันทิยา ', 'ทรัพย์มาก', 'Miss.', 'Veenantiya', 'Submak', '2', '1234'),
	(24, 'thirawut.kh', '61172310101-6', 'นาย', 'ธีรวุฒิ', 'ขันพันธ์', 'Mr.', 'Thirawut', 'Khanpan', '2', '1234'),
	(25, 'wanchai.ra', '60172310133-2', 'นาย', 'วันชัย', 'รัตนรักษ์', 'Mr.', 'Wanchai', 'Rattanarak', '2', '1234'),
	(26, 'meta.pr', '60172310215-5', 'นาย', 'เมธา', 'ประทุมภา', 'Mr.', 'Meta', 'Pratumpa', '2', '1234'),
	(27, 'benjaporn.ki', '61172310280-8', 'นางสาว', 'เบญจพร', 'กิตติวิเชียรชัย', 'Miss.', 'Benjaporn', 'Kittivichainchai', '2', '1234'),
	(28, 'sathaphorn.ma', '61172310331-8', 'นาย', 'สถาพร', 'มณีบุญ', 'Mr.', 'Sathaphorn', 'Maneeboon', '2', '1234'),
	(29, 'kanthorn.wo', '62172310127-0', 'นาย', 'กันต์ธร', 'วงษ์โสมะ', 'Mr.', 'Kanthorn', 'Wongsoma', '2', '1234'),
	(30, 'thirachot.sr', '59172310003-1', 'นาย', 'ธีรโชฒ', 'ศรีริ', 'Mr.', 'Thirachot', 'Sriri', '2', '1234'),
	(31, 'sarayuth.kr', '60172310022-5', 'นาย', 'ศรายุทธ', 'ไกรษร', 'Mr.', 'Sarayuth', 'Krisorn', '2', '1234'),
	(32, 'komittibate.ma', '60172310309-6', 'นาย', 'คมอิทธิเบศ', 'แมบจันทึก', 'Mr.', 'Komittibate', 'Mabjuntuk', '2', '1234'),
	(33, 'yanisa.ta', '62172310386-5', 'นางสาว', 'ญาณิศา', 'แต่งตั้ง', 'Miss.', 'Yanisa', 'Taengtang', '2', '1234'),
	(34, 'watchara.sa', '62182110010-5', 'นาย', 'วัชระ', 'ซ้ายกระโทก', 'Mr.', 'Watchara', 'Saikrathok', '2', '1234'),
	(35, 'wanchai.se', '60172310325-2', 'นาย', 'วันชัย', 'สีหะวงษ์', 'Mr.', 'Wanchai', 'Seehawong', '2', '1234'),
	(36, 'nontawat.po', '60172310305-6', 'นาย', 'นนทวัฒน์', 'ป้อมสนาม', 'Miss.', 'Nontawat', 'Pomsanam', '2', '1234'),
	(37, 'kridsada.kh', '59172310032-5', 'นาย', 'กฤษดา', 'คลายทุกข์', 'Mr.', 'Kridsada', 'Khlaithuk', '2', '1234'),
	(38, 'phitchayakorn.sr', '60172310194-9', 'นาย', 'พิชญากร', 'ศรีเนาวรัตน์', 'Mr.', 'Phitchayakorn', 'Srinaowarat', '2', '1234'),
	(39, 'arran.kh', '611723104249', 'นาย', 'อารันต์', 'ความสวัสดิ์', 'Mr.', 'Arran', 'Khwamsawat', '2', '1234'),
	(40, 'naruemon.sr', '60152310180-5', 'นางสาว', 'นฤมล', 'ศรีบุรี', 'Miss.', 'Naruemon', 'Sriburi', '2', '1234');
/*!40000 ALTER TABLE `tb_user` ENABLE KEYS */;

-- Dumping structure for table fpc.tb_year
CREATE TABLE IF NOT EXISTS `tb_year` (
  `Year_ID` int(5) NOT NULL AUTO_INCREMENT COMMENT 'รหัสปีการศึกษา',
  `Year` varchar(20) NOT NULL COMMENT 'ปีการศึกษา',
  `Term` varchar(20) NOT NULL COMMENT 'ภาคการเรียน',
  `Start_SchYear` varchar(20) NOT NULL COMMENT 'วันเริ่มต้นปีการศึกษา',
  `End_SchYear` varchar(20) NOT NULL COMMENT 'วันสิ้นสุดปีการศึกษา',
  `Start_Midterm` varchar(20) NOT NULL COMMENT 'เริ่มต้นวันสอบมิดเทอม',
  `End_Midterm` varchar(20) NOT NULL COMMENT 'สิ้นสุดวันสอบมิดเทอม',
  `Start_Final` varchar(20) NOT NULL COMMENT 'เริ่มต้นวันสอบไฟนอล',
  `End_Final` varchar(20) NOT NULL COMMENT 'สิ้นสุดวันสอบไฟนอล',
  PRIMARY KEY (`Year_ID`),
  UNIQUE KEY `Year` (`Year`,`Term`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table fpc.tb_year: ~0 rows (approximately)
/*!40000 ALTER TABLE `tb_year` DISABLE KEYS */;
REPLACE INTO `tb_year` (`Year_ID`, `Year`, `Term`, `Start_SchYear`, `End_SchYear`, `Start_Midterm`, `End_Midterm`, `Start_Final`, `End_Final`) VALUES
	(1, '2564', 'ภาคเรียนที่ 1', '2021-06-21', '2021-10-19', '2021-08-14', '2021-08-20', '2021-10-09', '2021-10-18');
/*!40000 ALTER TABLE `tb_year` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
