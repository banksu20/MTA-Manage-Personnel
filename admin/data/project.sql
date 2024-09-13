-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2022 at 01:26 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_calendar`
--

CREATE TABLE `tb_calendar` (
  `cal_id` int(11) NOT NULL COMMENT 'รหัสปฎิทิน',
  `emp_id` varchar(10) NOT NULL COMMENT 'รหัสพนักงาน',
  `start_date` date NOT NULL COMMENT 'วันที่เริ่มลา',
  `end_date` date NOT NULL COMMENT 'วันที่สิ้นสุดการลา',
  `times` varchar(10) NOT NULL COMMENT 'หยุด/ลา ครั้งที่',
  `approved_date` date NOT NULL COMMENT 'วันที่อนุมัติ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_calendar`
--

INSERT INTO `tb_calendar` (`cal_id`, `emp_id`, `start_date`, `end_date`, `times`, `approved_date`) VALUES
(8, 'EMP-0004', '2022-09-18', '2022-09-21', 'อนุมัติ', '2022-09-17'),
(9, 'EMP-0001', '0000-00-00', '0000-00-00', '1', '2022-09-20'),
(10, 'EMP-0002', '2022-09-27', '2022-09-30', '4', '2022-09-22');

-- --------------------------------------------------------

--
-- Table structure for table `tb_employee`
--

CREATE TABLE `tb_employee` (
  `user_id` int(11) NOT NULL COMMENT 'รหัสผู้ใช้',
  `emp_id` varchar(10) NOT NULL COMMENT 'รหัสพนักงาน',
  `emp_name` varchar(50) NOT NULL COMMENT 'ชื่อพนักงาน',
  `emp_gender` varchar(10) NOT NULL COMMENT 'เพศ',
  `emp_date` date NOT NULL COMMENT 'วัน เดือน ปีเกิด',
  `emp_age` varchar(5) NOT NULL COMMENT 'อายุ',
  `emp_race` varchar(10) NOT NULL COMMENT 'เชื้อชาติ',
  `emp_nation` varchar(10) NOT NULL COMMENT 'สัญชาติ',
  `emp_religion` varchar(10) NOT NULL COMMENT 'ศาสนา',
  `emp_address` varchar(50) NOT NULL COMMENT 'ที่อยู่',
  `emp_tel` varchar(11) NOT NULL COMMENT 'เบอร์โทรศัพท์',
  `emp_id_card` varchar(15) NOT NULL COMMENT 'รหัสบัตรประชาชน',
  `emp_status` varchar(15) NOT NULL COMMENT 'สถานะความสัมพันธ์',
  `pos_id` int(11) NOT NULL COMMENT 'ตำแหน่ง',
  `file` varchar(255) NOT NULL COMMENT 'รูป'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_employee`
--

INSERT INTO `tb_employee` (`user_id`, `emp_id`, `emp_name`, `emp_gender`, `emp_date`, `emp_age`, `emp_race`, `emp_nation`, `emp_religion`, `emp_address`, `emp_tel`, `emp_id_card`, `emp_status`, `pos_id`, `file`) VALUES
(14, 'EMP-0001', 'สุธนัย จันทร์ประเสริฐ', 'ชาย', '2002-05-20', '20', 'ไทย', 'ไทย', 'พุทธ', '55/33 หมู่ 10 จ.ชลบุรี อ.บางละมุง ต.หนองปรือ 20150', '0856321456', '1523652489563', 'โสด', 1, '../images/632bd96f2ca450.74045966.png'),
(16, 'EMP-0002', 'บัณฑัต ต๊ะตา', 'ชาย', '2002-05-10', '20', 'ไทย', 'ไทย', 'พุทธ', '152/43 หมู่7 ต.หนองปรือ อ.บางละมุง จ.ชลบุรี 20150', '0886334888', '1235216235486', 'โสด', 5, '../images/632c7560bca860.40736875.jpg'),
(17, 'EMP-0003', 'ซอง แชยอน', 'หญิง', '1999-04-23', '23', 'เกาหลี', 'เกาหลี', 'คริสต์', '95/43 หมู่7 ต.หนองปรือ อ.บางละมุง จ.ชลบุรี 20150', '0895632514', '6532152316231', 'โสด', 4, '../images/632c76c4873986.23944163.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_position`
--

CREATE TABLE `tb_position` (
  `pos_id` int(11) NOT NULL COMMENT 'รหัสข้อมูลตำแหน่ง',
  `pos_name` varchar(50) NOT NULL COMMENT 'ชื่อตำแหน่ง'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_position`
--

INSERT INTO `tb_position` (`pos_id`, `pos_name`) VALUES
(1, 'ผู้บริหาร'),
(2, 'บัญชี'),
(3, 'เลขานุการ'),
(4, 'แม่บ้าน'),
(5, 'ช่างทั่วไป');

-- --------------------------------------------------------

--
-- Table structure for table `tb_salary`
--

CREATE TABLE `tb_salary` (
  `sal_id` int(11) NOT NULL COMMENT 'รหัสข้อมูลเงินเดือน',
  `emp_id` varchar(11) NOT NULL COMMENT 'รหัสพนักงาน',
  `sal_base` int(11) NOT NULL COMMENT 'เงินเดือนประจำ',
  `sal_ot` int(11) NOT NULL COMMENT 'เงินล่วงเวลา',
  `sal_total` int(11) NOT NULL COMMENT 'เงินเดือนสุทธิ',
  `sal_date` date NOT NULL COMMENT 'วันที่ออกเงินเดือน',
  `times` int(11) NOT NULL COMMENT 'จำนวนครั้งที่ออกเงินเดือน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_salary`
--

INSERT INTO `tb_salary` (`sal_id`, `emp_id`, `sal_base`, `sal_ot`, `sal_total`, `sal_date`, `times`) VALUES
(2, 'EMP-0002', 15000, 100, 15100, '2022-09-21', 1),
(7, 'EMP-0003', 10000, 500, 10500, '2022-09-22', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `user_id` int(10) NOT NULL COMMENT 'ไอดีผู้ใช้',
  `user_username` varchar(30) NOT NULL COMMENT 'ชื่อผู้ใช้',
  `user_password` varchar(50) NOT NULL COMMENT 'รหัสผ่าน',
  `user_name` varchar(60) NOT NULL COMMENT 'ชื่อ',
  `user_surname` varchar(60) NOT NULL COMMENT 'นามสกุล',
  `user_email` varchar(50) NOT NULL COMMENT 'อีเมล',
  `user_level` enum('member','admin') NOT NULL DEFAULT 'member' COMMENT 'ระดับผู้ใช้'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`user_id`, `user_username`, `user_password`, `user_name`, `user_surname`, `user_email`, `user_level`) VALUES
(1, 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 'Sutanai', 'Janprasert', 'sutanaibank2545@gmail.com', 'admin'),
(2, 'bannathat', '81dc9bdb52d04dc20036dbd8313ed055', 'บาบาบา', 'กากากา', 'test2@gmail.com', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_calendar`
--
ALTER TABLE `tb_calendar`
  ADD PRIMARY KEY (`cal_id`);

--
-- Indexes for table `tb_employee`
--
ALTER TABLE `tb_employee`
  ADD PRIMARY KEY (`user_id`,`emp_id`);

--
-- Indexes for table `tb_position`
--
ALTER TABLE `tb_position`
  ADD PRIMARY KEY (`pos_id`);

--
-- Indexes for table `tb_salary`
--
ALTER TABLE `tb_salary`
  ADD PRIMARY KEY (`sal_id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_calendar`
--
ALTER TABLE `tb_calendar`
  MODIFY `cal_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสปฎิทิน', AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_employee`
--
ALTER TABLE `tb_employee`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสผู้ใช้', AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tb_salary`
--
ALTER TABLE `tb_salary`
  MODIFY `sal_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสข้อมูลเงินเดือน', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีผู้ใช้', AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
