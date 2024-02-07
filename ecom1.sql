-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2022 at 09:54 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecom1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `first_name`, `last_name`, `username`, `password`, `status`, `last_login`) VALUES
(1, 'admin', 'nkcomservice', 'kaifaro', '123456', '1', '2021-10-03 17:01:14');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `d_id` int(10) NOT NULL,
  `o_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `d_qty` int(11) NOT NULL,
  `d_subtotal` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`d_id`, `o_id`, `p_id`, `d_qty`, `d_subtotal`) VALUES
(1, 1, 1, 1, 100000);

-- --------------------------------------------------------

--
-- Table structure for table `order_head`
--

CREATE TABLE `order_head` (
  `o_id` int(10) NOT NULL,
  `m_id` int(11) NOT NULL,
  `o_dttm` datetime NOT NULL,
  `o_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `o_addr` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `o_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `o_phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `o_total` float NOT NULL,
  `o_status` int(11) NOT NULL COMMENT '1= รอชำระเงิน\r\n2= ชำระเงินแล้ว\r\n3= ตรวจสอบเลข EMS\r\n4= ยกเลิก',
  `bid` int(2) NOT NULL DEFAULT 0 COMMENT 'ไอดีแบงค์',
  `o_slip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `o_slip_date` datetime NOT NULL,
  `o_slip_total` float(10,2) NOT NULL DEFAULT 0.00,
  `o_ems` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `o_ems_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_head`
--

INSERT INTO `order_head` (`o_id`, `m_id`, `o_dttm`, `o_name`, `o_addr`, `o_email`, `o_phone`, `o_total`, `o_status`, `bid`, `o_slip`, `o_slip_date`, `o_slip_total`, `o_ems`, `o_ems_date`) VALUES
(1, 2, '2022-02-20 18:43:32', 'นายMEMBER Tee', '123 4 55 66', 'member@gmail.com', '0123456789', 100000, 3, 0, '', '2022-02-20 18:57:00', 100000.00, '4541', '2022-02-20 18:59:06');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bank`
--

CREATE TABLE `tbl_bank` (
  `bid` int(11) NOT NULL,
  `b_img` varchar(50) NOT NULL,
  `bname` varchar(255) NOT NULL COMMENT 'ชื่อธนาคาร',
  `bnumber` varchar(255) NOT NULL COMMENT 'เลขบัญชี',
  `bowner` varchar(255) NOT NULL COMMENT 'ชื่อเจ้าของบัญชี'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comment`
--

CREATE TABLE `tbl_comment` (
  `c_id` int(11) NOT NULL,
  `ref_p_id` int(11) NOT NULL,
  `c_detail` text NOT NULL,
  `c_status` int(1) NOT NULL DEFAULT 0,
  `c_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='เก็บข้อมูลแสดงความคิดเห็นต่อสินค้า';

-- --------------------------------------------------------

--
-- Table structure for table `tbl_counter`
--

CREATE TABLE `tbl_counter` (
  `c_id` int(11) NOT NULL,
  `c_ipadr` varchar(50) NOT NULL,
  `c_datesave` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_counter`
--

INSERT INTO `tbl_counter` (`c_id`, `c_ipadr`, `c_datesave`) VALUES
(0, '127.0.0.1', '2022-02-24 06:48:58'),
(1, '127.0.0.1', '2022-02-20 09:29:23'),
(2, '127.0.0.1', '2022-02-20 09:33:43'),
(3, '127.0.0.1', '2022-02-20 09:33:45'),
(4, '127.0.0.1', '2022-02-20 11:19:38'),
(5, '127.0.0.1', '2022-02-20 11:19:41'),
(6, '127.0.0.1', '2022-02-20 11:22:17'),
(7, '127.0.0.1', '2022-02-20 11:36:12'),
(8, '127.0.0.1', '2022-02-20 11:36:15'),
(9, '127.0.0.1', '2022-02-20 11:36:23'),
(10, '127.0.0.1', '2022-02-20 11:37:43'),
(11, '127.0.0.1', '2022-02-20 11:38:07'),
(12, '127.0.0.1', '2022-02-20 11:38:33'),
(13, '127.0.0.1', '2022-02-20 11:38:48'),
(14, '127.0.0.1', '2022-02-20 11:39:02'),
(15, '127.0.0.1', '2022-02-20 11:39:19'),
(16, '127.0.0.1', '2022-02-20 11:39:27'),
(17, '127.0.0.1', '2022-02-20 11:39:28'),
(18, '127.0.0.1', '2022-02-20 11:40:14'),
(19, '127.0.0.1', '2022-02-20 11:40:19'),
(20, '127.0.0.1', '2022-02-20 11:40:38'),
(21, '127.0.0.1', '2022-02-20 11:40:39'),
(22, '127.0.0.1', '2022-02-20 11:40:48'),
(23, '127.0.0.1', '2022-02-20 11:40:53'),
(24, '127.0.0.1', '2022-02-20 11:40:59'),
(25, '127.0.0.1', '2022-02-20 11:41:58'),
(26, '127.0.0.1', '2022-02-20 11:42:00'),
(27, '127.0.0.1', '2022-02-20 11:42:56'),
(28, '127.0.0.1', '2022-02-20 11:42:58'),
(29, '127.0.0.1', '2022-02-20 11:43:00'),
(30, '127.0.0.1', '2022-02-20 11:43:47'),
(31, '127.0.0.1', '2022-02-20 11:45:37'),
(32, '127.0.0.1', '2022-02-20 11:58:10'),
(33, '127.0.0.1', '2022-02-20 11:58:19'),
(34, '127.0.0.1', '2022-02-20 12:08:51'),
(35, '127.0.0.1', '2022-02-20 12:08:53'),
(36, '127.0.0.1', '2022-02-20 12:10:33'),
(37, '127.0.0.1', '2022-02-20 12:13:04'),
(38, '127.0.0.1', '2022-02-20 12:36:46'),
(39, '127.0.0.1', '2022-02-21 12:57:29'),
(40, '::1', '2022-02-21 12:59:11'),
(41, '::1', '2022-02-21 13:13:19'),
(42, '127.0.0.1', '2022-02-22 02:19:49'),
(43, '127.0.0.1', '2022-02-22 03:19:53'),
(44, '127.0.0.1', '2022-02-22 03:39:05'),
(45, '127.0.0.1', '2022-02-22 03:39:07'),
(46, '127.0.0.1', '2022-02-22 03:43:09'),
(47, '127.0.0.1', '2022-02-22 03:44:21'),
(48, '127.0.0.1', '2022-02-22 03:44:33'),
(49, '127.0.0.1', '2022-02-22 03:44:36'),
(50, '127.0.0.1', '2022-02-23 05:56:17'),
(51, '127.0.0.1', '2022-02-23 09:05:49'),
(52, '127.0.0.1', '2022-02-23 09:06:13'),
(53, '127.0.0.1', '2022-02-23 09:06:54'),
(54, '127.0.0.1', '2022-02-23 09:06:56'),
(55, '127.0.0.1', '2022-02-23 09:08:26'),
(56, '127.0.0.1', '2022-02-23 09:08:48'),
(57, '127.0.0.1', '2022-02-23 09:10:40'),
(58, '127.0.0.1', '2022-02-23 09:10:54'),
(59, '127.0.0.1', '2022-02-23 09:11:21'),
(60, '127.0.0.1', '2022-02-24 07:31:29'),
(61, '127.0.0.1', '2022-02-24 07:31:32'),
(62, '127.0.0.1', '2022-02-24 07:31:47'),
(63, '127.0.0.1', '2022-02-24 07:31:52'),
(64, '127.0.0.1', '2022-02-24 07:32:18'),
(65, '127.0.0.1', '2022-02-24 08:19:43'),
(66, '127.0.0.1', '2022-02-24 08:19:59'),
(67, '127.0.0.1', '2022-02-24 08:20:02'),
(68, '127.0.0.1', '2022-02-24 08:21:41'),
(69, '127.0.0.1', '2022-02-24 08:21:43'),
(70, '127.0.0.1', '2022-02-24 08:26:57'),
(71, '127.0.0.1', '2022-02-24 08:26:59'),
(72, '127.0.0.1', '2022-02-24 08:38:08'),
(73, '127.0.0.1', '2022-02-24 08:38:11'),
(74, '127.0.0.1', '2022-02-24 09:26:40'),
(75, '127.0.0.1', '2022-02-25 07:58:15'),
(76, '127.0.0.1', '2022-02-25 08:27:03'),
(77, '127.0.0.1', '2022-02-25 08:27:06'),
(78, '127.0.0.1', '2022-02-25 08:29:09'),
(79, '127.0.0.1', '2022-02-25 08:29:11'),
(80, '127.0.0.1', '2022-02-25 08:29:12'),
(81, '127.0.0.1', '2022-02-25 08:29:15'),
(82, '127.0.0.1', '2022-02-25 08:29:54'),
(83, '127.0.0.1', '2022-02-25 08:29:55'),
(84, '127.0.0.1', '2022-02-25 08:29:55'),
(85, '127.0.0.1', '2022-02-25 08:29:55'),
(86, '127.0.0.1', '2022-02-25 08:33:37'),
(87, '127.0.0.1', '2022-02-25 08:36:43'),
(88, '127.0.0.1', '2022-02-25 08:37:26'),
(89, '127.0.0.1', '2022-02-25 08:37:29'),
(90, '127.0.0.1', '2022-02-25 08:37:31'),
(91, '127.0.0.1', '2022-02-25 08:37:33'),
(92, '127.0.0.1', '2022-02-25 08:37:34'),
(93, '127.0.0.1', '2022-02-25 08:37:34'),
(94, '127.0.0.1', '2022-02-25 08:37:34'),
(95, '127.0.0.1', '2022-02-25 08:37:35'),
(96, '127.0.0.1', '2022-02-25 08:37:35'),
(97, '127.0.0.1', '2022-02-25 08:37:44'),
(98, '127.0.0.1', '2022-02-25 08:40:09'),
(99, '127.0.0.1', '2022-02-25 08:40:12'),
(100, '127.0.0.1', '2022-02-25 08:40:13'),
(101, '127.0.0.1', '2022-02-25 08:40:13'),
(102, '127.0.0.1', '2022-02-25 08:40:13'),
(103, '127.0.0.1', '2022-02-25 08:40:13'),
(104, '127.0.0.1', '2022-02-25 08:40:13'),
(105, '127.0.0.1', '2022-02-25 08:40:14'),
(106, '127.0.0.1', '2022-02-25 08:40:14'),
(107, '127.0.0.1', '2022-02-25 08:40:14'),
(108, '127.0.0.1', '2022-02-25 08:40:53'),
(109, '127.0.0.1', '2022-02-25 08:40:54'),
(110, '127.0.0.1', '2022-02-25 08:40:54'),
(111, '127.0.0.1', '2022-02-25 08:40:54'),
(112, '127.0.0.1', '2022-02-25 08:40:55'),
(113, '127.0.0.1', '2022-02-25 08:40:55'),
(114, '127.0.0.1', '2022-02-25 08:40:55'),
(115, '127.0.0.1', '2022-02-25 08:40:55'),
(116, '127.0.0.1', '2022-02-25 08:40:55'),
(117, '127.0.0.1', '2022-02-25 08:40:56'),
(118, '127.0.0.1', '2022-02-25 08:41:30'),
(119, '127.0.0.1', '2022-02-25 08:41:30'),
(120, '127.0.0.1', '2022-02-25 08:41:31'),
(121, '127.0.0.1', '2022-02-25 08:41:31'),
(122, '127.0.0.1', '2022-02-25 08:41:31'),
(123, '127.0.0.1', '2022-02-25 08:41:32'),
(124, '127.0.0.1', '2022-02-25 08:41:32'),
(125, '127.0.0.1', '2022-02-25 08:41:32'),
(126, '127.0.0.1', '2022-02-25 08:41:32'),
(127, '127.0.0.1', '2022-02-25 08:41:36'),
(128, '127.0.0.1', '2022-02-25 08:41:37'),
(129, '127.0.0.1', '2022-02-25 08:41:37'),
(130, '127.0.0.1', '2022-02-25 08:41:37'),
(131, '127.0.0.1', '2022-02-25 08:41:37'),
(132, '127.0.0.1', '2022-02-25 08:41:37'),
(133, '127.0.0.1', '2022-02-25 08:41:38'),
(134, '127.0.0.1', '2022-02-25 08:41:38'),
(135, '127.0.0.1', '2022-02-25 08:41:38'),
(136, '127.0.0.1', '2022-02-25 08:41:38'),
(137, '127.0.0.1', '2022-02-25 08:41:39'),
(138, '127.0.0.1', '2022-02-25 08:41:39'),
(139, '127.0.0.1', '2022-02-25 08:41:39'),
(140, '127.0.0.1', '2022-02-25 08:41:43'),
(141, '127.0.0.1', '2022-02-25 08:41:43'),
(142, '127.0.0.1', '2022-02-25 08:41:44'),
(143, '127.0.0.1', '2022-02-25 08:41:44'),
(144, '127.0.0.1', '2022-02-25 08:41:44'),
(145, '127.0.0.1', '2022-02-25 08:41:45'),
(146, '127.0.0.1', '2022-02-25 08:43:05'),
(147, '127.0.0.1', '2022-02-25 08:43:06'),
(148, '127.0.0.1', '2022-02-25 08:43:06'),
(149, '127.0.0.1', '2022-02-25 08:43:06'),
(150, '127.0.0.1', '2022-02-25 08:43:07'),
(151, '127.0.0.1', '2022-02-25 08:43:07'),
(152, '127.0.0.1', '2022-02-25 08:43:18'),
(153, '127.0.0.1', '2022-02-25 08:43:22'),
(154, '127.0.0.1', '2022-02-25 08:43:55'),
(155, '127.0.0.1', '2022-02-25 08:43:56'),
(156, '127.0.0.1', '2022-02-25 08:43:56'),
(157, '127.0.0.1', '2022-02-25 08:43:57'),
(158, '127.0.0.1', '2022-02-25 08:43:57'),
(159, '127.0.0.1', '2022-02-25 08:43:57'),
(160, '127.0.0.1', '2022-02-25 08:45:28'),
(161, '127.0.0.1', '2022-02-25 08:45:30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login_log`
--

CREATE TABLE `tbl_login_log` (
  `log_id` int(11) NOT NULL,
  `ref_m_id` int(11) NOT NULL,
  `log_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='เก็บประวัติก่รเข้าสู่ระบบ';

--
-- Dumping data for table `tbl_login_log`
--

INSERT INTO `tbl_login_log` (`log_id`, `ref_m_id`, `log_date`) VALUES
(1, 2, '2022-02-20 11:42:56'),
(2, 2, '2022-02-22 03:44:33');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_member`
--

CREATE TABLE `tbl_member` (
  `m_id` int(11) NOT NULL,
  `m_username` varchar(255) DEFAULT NULL,
  `m_password` varchar(255) NOT NULL,
  `m_fname` varchar(255) NOT NULL,
  `m_name` varchar(255) NOT NULL,
  `m_lname` varchar(255) NOT NULL,
  `m_email` varchar(255) NOT NULL,
  `m_phone` varchar(20) NOT NULL,
  `m_address` text NOT NULL,
  `m_img` varchar(255) NOT NULL DEFAULT 'll.png',
  `m_level` varchar(50) NOT NULL DEFAULT 'MEMBER',
  `m_datesave` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_member`
--

INSERT INTO `tbl_member` (`m_id`, `m_username`, `m_password`, `m_fname`, `m_name`, `m_lname`, `m_email`, `m_phone`, `m_address`, `m_img`, `m_level`, `m_datesave`) VALUES
(1, 'ADMIN', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'นาย', 'ADMIN', 'nita', 'adminx@gmail.com', '0990096669', '107 หมู่3 ต.หาดคำ อ.เมือง จ.หนองคาย 43000', '116333337020220224_152041.jpg', 'ADMIN', '2022-02-24 08:20:41');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prd`
--

CREATE TABLE `tbl_prd` (
  `p_id` int(11) NOT NULL,
  `ref_m_id` int(11) DEFAULT 0 COMMENT 'รหัสของคนเพิ่มข้อมูล',
  `ref_t_id` int(11) DEFAULT 0 COMMENT 'รหัสประเภทของสินค้า',
  `p_name` varchar(255) NOT NULL COMMENT 'ชื่อสินค้า',
  `p_intro` varchar(255) NOT NULL COMMENT 'รายละเอียดสั้นๆ',
  `p_detail` text NOT NULL,
  `p_price` varchar(255) NOT NULL,
  `p_img` varchar(255) NOT NULL,
  `p_img1` varchar(255) NOT NULL,
  `p_img2` varchar(255) NOT NULL,
  `p_img3` varchar(255) NOT NULL,
  `p_view` int(11) NOT NULL DEFAULT 0,
  `p_qty` int(3) NOT NULL,
  `p_m_name` varchar(255) DEFAULT NULL,
  `p_m_edit_date` datetime NOT NULL,
  `p_hns` varchar(50) NOT NULL,
  `p_datesave` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_prd`
--

INSERT INTO `tbl_prd` (`p_id`, `ref_m_id`, `ref_t_id`, `p_name`, `p_intro`, `p_detail`, `p_price`, `p_img`, `p_img1`, `p_img2`, `p_img3`, `p_view`, `p_qty`, `p_m_name`, `p_m_edit_date`, `p_hns`, `p_datesave`) VALUES
(2, 1, 4, 'no game no life เล่ม 1 (light novel)', 'no game no life เล่ม 1 (light novel)  ฉบับวนิยาย จาก อาจาร์ย ยู คามิยะ ', 'no game no life ฉบับ วนิยาย\r\nประเภทสินค้า	หนังสือไลท์โนเวล (Light novel) \r\nขนาด A6\r\nผู้เขียน (แต่ง)	ยู คามิยะ\r\nผู้วาดภาพประกอบ ยู คามิยะ\r\nผู้แปล	สันตบุตร ปิยะรัตน์', '160', '7276758520220224_143049.jpg', '159765606920220224_143049.jpg', '167369160220220224_143905.jpg', '32519286020220224_143049.jpg', 1, 50, 'ADMIN', '2022-02-24 14:36:34', '', '2022-02-24 07:39:05'),
(3, 1, 4, 'no game no life เล่ม 2 (light novel)', 'no game no life เล่ม 2 (light novel)  ฉบับวนิยาย จาก อาจาร์ย ยู คามิยะ ', 'no game no life เล่ม 2 ฉบับวนิยาย\r\nประเภทสินค้า	หนังสือไลท์โนเวล (Light novel) \r\nขนาด A6\r\nผู้เขียน (แต่ง)	ยู คามิยะ\r\nผู้วาดภาพประกอบ ยู คามิยะ\r\nผู้แปล สันตบุตร ปิยะรัตน์', '160', '135155642120220224_144214.jpg', '17649930620220224_144214.jpg', '67547172720220224_144214.jpg', '26841114020220224_144214.jpg', 0, 100, NULL, '0000-00-00 00:00:00', '', '2022-02-24 07:42:14'),
(4, 1, 4, 'no game no life เล่ม 3 (light novel)', 'no game no life เล่ม 3 (light novel)  ฉบับวนิยาย จาก อาจาร์ย ยู คามิยะ ', 'no game no life เล่ม 3  ฉบับวนิยาย\r\nประเภทสินค้า	หนังสือไลท์โนเวล (Light novel) \r\nขนาด A6\r\nผู้เขียน (แต่ง)	ยู คามิยะ\r\nผู้วาดภาพประกอบ ยู คามิยะ\r\nผู้แปล สันตบุตร ปิยะรัตน์', '180', '137435484820220224_144412.jpg', '61529977120220224_144412.jpg', '6489850920220224_144412.jpg', '24370697920220224_144412.jpg', 0, 150, NULL, '0000-00-00 00:00:00', '', '2022-02-24 07:44:12'),
(5, 1, 4, 'no game no life เล่ม 4 (light novel)', 'no game no life เล่ม 4 (light novel)  ฉบับวนิยาย จาก อาจาร์ย ยู คามิยะ ', 'no game no life เล่ม 4 ฉบับวนิยาย\r\nประเภทสินค้า	หนังสือไลท์โนเวล (Light novel)\r\nขนาด A6\r\nผู้เขียน (แต่ง)	ยู คามิยะ\r\nผู้วาดภาพประกอบ ยู คามิยะ\r\nผู้แปล สันตบุตร ปิยะรัตน์', '170', '130607609620220224_144821.jpg', '64111641520220224_144821.jpg', '6220359720220224_144821.jpg', '1391081620220224_144821.jpg', 0, 100, NULL, '0000-00-00 00:00:00', '', '2022-02-24 07:48:21'),
(6, 1, 4, 'no game no life เล่ม 5 (light novel)', 'no game no life เล่ม 5 (light novel)  ฉบับวนิยาย จาก อาจาร์ย ยู คามิยะ ', 'no game no life เล่ม 5  ฉบับวนิยาย\r\nประเภทสินค้า	หนังสือไลท์โนเวล (Light novel) \r\nขนาด A6\r\nผู้เขียน (แต่ง)	ยู คามิยะ\r\nผู้วาดภาพประกอบ ยู คามิยะ\r\nผู้แปล สันตบุตร ปิยะรัตน์', '200', '79584762120220224_145006.jpg', '73338594120220224_145006.jpg', '152547059720220224_145006.jpg', '48255231120220224_145006.jpg', 0, 70, NULL, '0000-00-00 00:00:00', '', '2022-02-24 07:50:06'),
(7, 1, 4, 'no game no life เล่ม 6 (light novel)', 'no game no life เล่ม 6 (light novel)  ฉบับวนิยาย จาก อาจาร์ย ยู คามิยะ ', 'no game no life เล่ม 6  ฉบับวนิยาย\r\nประเภทสินค้า	หนังสือไลท์โนเวล (Light novel)\r\nขนาด A6\r\nผู้เขียน (แต่ง)	ยู คามิยะ\r\nผู้วาดภาพประกอบ ยู คามิยะ\r\nผู้แปล สันตบุตร ปิยะรัตน์', '220', '151718871120220224_145236.jpg', '63820955420220224_145236.jpg', '187053241720220224_145236.jpg', '106799476620220224_145236.jpg', 0, 60, NULL, '0000-00-00 00:00:00', '', '2022-02-24 07:52:36'),
(8, 1, 4, 'no game no life เล่ม 7 (light novel)', 'no game no life เล่ม 7  (light novel)  ฉบับวนิยาย จาก อาจาร์ย ยู คามิยะ ', 'no game no life เล่ม 7 ฉบับวนิยาย\r\nประเภทสินค้า	หนังสือไลท์โนเวล (Light novel)\r\nขนาด A6\r\nผู้เขียน (แต่ง)	ยู คามิยะ\r\nผู้วาดภาพประกอบ ยู คามิยะ\r\nผู้แปล สันตบุตร ปิยะรัตน์', '230', '91827479720220224_145535.jpg', '180310620320220224_145535.jpg', '212168945820220224_145535.jpg', '207198914320220224_145535.jpg', 0, 40, NULL, '0000-00-00 00:00:00', '', '2022-02-24 07:55:35'),
(9, 1, 4, 'no game no life เล่ม 8 (light novel)', 'no game no life เล่ม 8 (light novel)  ฉบับวนิยาย จาก อาจาร์ย ยู คามิยะ ', 'no game no life เล่ม 8 ฉบับวนิยาย\r\nประเภทสินค้า	หนังสือไลท์โนเวล (Light novel)\r\n ขนาด A6\r\nผู้เขียน (แต่ง)	ยู คามิยะ\r\nผู้วาดภาพประกอบ ยู คามิยะ\r\nผู้แปล สันตบุตร ปิยะรัตน์', '230', '8850147020220224_145810.jpg', '179967365520220224_145810.jpg', '178765646320220224_145810.jpg', '21858946920220224_145810.jpg', 0, 80, NULL, '0000-00-00 00:00:00', '', '2022-02-24 07:58:10'),
(10, 1, 4, 'no game no life เล่ม 9 (light novel)', 'no game no life เล่ม 9 (light novel)  ฉบับวนิยาย จาก อาจาร์ย ยู คามิยะ ', 'no game no life เล่ม 9 ฉบับวนิยาย\r\nประเภทสินค้า	หนังสือไลท์โนเวล (Light novel)\r\nขนาด A6\r\nผู้เขียน (แต่ง)	ยู คามิยะ\r\nผู้วาดภาพประกอบ ยู คามิยะ\r\nผู้แปล สันตบุตร ปิยะรัตน์', '230', '163814266420220224_150138.jpg', '18696489920220224_150138.jpg', '170917645020220224_150138.jpg', '171764062620220224_150138.jpg', 0, 90, NULL, '0000-00-00 00:00:00', '', '2022-02-24 08:01:38'),
(11, 1, 4, 'no game no life เล่ม 10 (light novel)', 'no game no life เล่ม 10 (light novel)  ฉบับวนิยาย จาก อาจาร์ย ยู คามิยะ ', 'no game no life เล่ม 10  ฉบับวนิยาย\r\nประเภทสินค้า	หนังสือไลท์โนเวล (Light novel) \r\nขนาด A6\r\nผู้เขียน (แต่ง)	ยู คามิยะ\r\nผู้วาดภาพประกอบ ยู คามิยะ\r\nผู้แปล สันตบุตร ปิยะรัตน์', '260', '160168590820220224_150414.jpg', '24352137520220224_150414.jpg', '166613135020220224_150414.jpg', '207716932820220224_150414.jpg', 0, 45, NULL, '0000-00-00 00:00:00', '', '2022-02-24 08:04:14'),
(12, 1, 6, 'ไปตายด้วยกันไหม', 'เรื่องราวเกี่ยวกับ กลุ่มเด็กชาย-หญิง 12 คน ที่รวมตัวกันมาที่โรงพยาบาลเพื่อฆ่าตัวตายด้วยกัน ผ่านทางเว็บไซต์ คนอยากฆ่าตัวตาย โดยแต่ละคนจะได้รับหมายเลขประจำตัว แต่เมื่อเข้าไปในห้องที่ทั้งสิบสองคนตั้งใจจะรมควันฆ่าตัวตายไปพร้อมกัน กลับพบเด็กชายคนหนึ่งนอนหมดสติ', 'นิยายสืบสวน หนุ่มสาวสิบสองคนมารวมตัวกันเพื่อฆ่าตัวตายหมู่ แต่สิ่งที่ขัดขวางกลับเป็น ศพที่สิบสาม\r\nขนาด 14.5 x 21.1 x 1.8 CM\r\nผู้เขียน: โท อุบุคาตะ (Ubukata Toh)\r\nสำนักพิมพ์: แพรวสำนักพิมพ์', '295', '152180160220220224_151034.jpg', '213310307220220224_151034.jpg', '29402669120220224_151034.jpg', '9791259220220224_151034.jpg', 0, 95, NULL, '0000-00-00 00:00:00', '', '2022-02-24 08:10:34'),
(13, 1, 6, 'เทวากับซาตาน Angels and Demons', 'พบกับรหัสและสัญลักษณ์สุดอัจฉริยะที่ผู้อ่านจะต้องทึ่ง และทำให้แดน บราวน์ ก้าวเข้าสู่ทำเนียบนักเขียนขายดีระดับโลก', 'เทวากับซาตาน\r\nแปลจากหนังสือ: Angels & Demons\r\nผู้เขียน: Dan Brown\r\nผู้แปล: อรดี สุวรรณโกมล, อนุรักษ์ นครินทร์\r\nออกแบบปก: นุชชา ประพิณ\r\nสำนักพิมพ์: แพรวสำนักพิมพ์\r\nจำนวนหน้า: 604 หน้า ปกอ่อน', '425', '18528513820220224_151708.jpg', '103202249320220224_151708.jpg', '193099915320220224_151708.jpg', '209544942320220224_151708.jpg', 0, 30, NULL, '0000-00-00 00:00:00', '', '2022-02-24 08:17:08');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prd_type`
--

CREATE TABLE `tbl_prd_type` (
  `t_id` int(11) NOT NULL,
  `t_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_prd_type`
--

INSERT INTO `tbl_prd_type` (`t_id`, `t_name`) VALUES
(2, 'มังงะ'),
(3, 'วนิยาย'),
(4, 'แฟนตาชี'),
(5, 'ไซไฟ'),
(6, 'สืบสวน'),
(7, 'สยองขวัญ'),
(8, 'โรแมนติก'),
(9, 'อบอุ่น'),
(10, 'สำหรับเด็ก'),
(11, 'สำหรับผู้ใหญ่'),
(12, 'ยาโอย'),
(13, 'ยูริ'),
(14, 'เทพนิยาย'),
(15, 'โชเน็น'),
(16, 'ต่อสู้'),
(17, 'ดราม่า'),
(18, 'จิตวิทยา'),
(19, 'มันฮวา');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prd_update_log`
--

CREATE TABLE `tbl_prd_update_log` (
  `lid` int(11) NOT NULL,
  `ref_p_id` int(11) NOT NULL,
  `ref_m_id` int(11) NOT NULL,
  `l_date_save` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='เก็บประวัติผู้แก้ไขสินค้า';

--
-- Dumping data for table `tbl_prd_update_log`
--

INSERT INTO `tbl_prd_update_log` (`lid`, `ref_p_id`, `ref_m_id`, `l_date_save`) VALUES
(1, 1, 18, '2022-01-21 13:20:31'),
(2, 1, 18, '2022-01-21 13:21:26'),
(3, 1, 13, '2022-01-21 13:37:24'),
(4, 2, 18, '2022-01-21 14:07:23'),
(5, 1, 18, '2022-01-21 15:41:40'),
(6, 3, 18, '2022-01-21 15:42:00'),
(7, 2, 1, '2022-01-27 15:20:05'),
(8, 5, 1, '2022-01-28 04:05:39'),
(9, 5, 1, '2022-01-28 04:09:41'),
(10, 5, 1, '2022-01-28 04:10:14'),
(11, 2, 1, '2022-01-28 04:12:56'),
(12, 1, 1, '2022-01-28 04:13:27'),
(13, 4, 1, '2022-01-28 08:52:39'),
(14, 3, 1, '2022-01-28 09:08:01'),
(15, 6, 1, '2022-01-28 10:21:33'),
(16, 6, 1, '2022-01-28 10:27:55'),
(17, 6, 1, '2022-01-28 11:08:33'),
(18, 4, 1, '2022-01-28 14:29:21'),
(19, 4, 1, '2022-01-28 14:30:00'),
(20, 3, 1, '2022-01-28 14:30:35'),
(21, 3, 1, '2022-01-28 14:35:51'),
(22, 4, 1, '2022-01-28 14:36:23'),
(23, 4, 1, '2022-01-28 15:25:42'),
(24, 2, 1, '2022-01-28 15:53:43'),
(25, 2, 1, '2022-01-28 16:29:05'),
(26, 7, 1, '2022-02-03 12:29:21'),
(27, 7, 1, '2022-02-03 12:32:32'),
(28, 1, 1, '2022-02-03 15:22:27'),
(29, 6, 1, '2022-02-03 16:08:47'),
(30, 2, 1, '2022-02-03 16:09:08'),
(31, 2, 1, '2022-02-04 04:48:57'),
(32, 2, 1, '2022-02-04 04:53:48'),
(33, 2, 1, '2022-02-04 04:54:30'),
(34, 24, 1, '2022-02-04 17:13:10'),
(35, 24, 1, '2022-02-04 17:13:47'),
(36, 17, 1, '2022-02-07 13:43:40'),
(37, 4, 1, '2022-02-16 13:31:21'),
(38, 2, 1, '2022-02-24 07:39:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `order_head`
--
ALTER TABLE `order_head`
  ADD PRIMARY KEY (`o_id`);

--
-- Indexes for table `tbl_bank`
--
ALTER TABLE `tbl_bank`
  ADD PRIMARY KEY (`bid`);

--
-- Indexes for table `tbl_comment`
--
ALTER TABLE `tbl_comment`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `tbl_counter`
--
ALTER TABLE `tbl_counter`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `tbl_login_log`
--
ALTER TABLE `tbl_login_log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `tbl_member`
--
ALTER TABLE `tbl_member`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `tbl_prd`
--
ALTER TABLE `tbl_prd`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `tbl_prd_type`
--
ALTER TABLE `tbl_prd_type`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `tbl_prd_update_log`
--
ALTER TABLE `tbl_prd_update_log`
  ADD PRIMARY KEY (`lid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `d_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_head`
--
ALTER TABLE `order_head`
  MODIFY `o_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_bank`
--
ALTER TABLE `tbl_bank`
  MODIFY `bid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_comment`
--
ALTER TABLE `tbl_comment`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_counter`
--
ALTER TABLE `tbl_counter`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT for table `tbl_login_log`
--
ALTER TABLE `tbl_login_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_member`
--
ALTER TABLE `tbl_member`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_prd`
--
ALTER TABLE `tbl_prd`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_prd_type`
--
ALTER TABLE `tbl_prd_type`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_prd_update_log`
--
ALTER TABLE `tbl_prd_update_log`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
