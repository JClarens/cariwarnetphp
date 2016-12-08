-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2016 at 11:01 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cariwarnet`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblcomment`
--

CREATE TABLE `tblcomment` (
  `com_id` int(8) NOT NULL,
  `com_warnet_id` int(8) NOT NULL,
  `com_mbr_id` int(8) NOT NULL,
  `com_desc` varchar(200) NOT NULL DEFAULT '',
  `com_rate` tinyint(1) NOT NULL DEFAULT '1',
  `com_dt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcomment`
--

INSERT INTO `tblcomment` (`com_id`, `com_warnet_id`, `com_mbr_id`, `com_desc`, `com_rate`, `com_dt`) VALUES
(1, 2, 1, 'Komentar 1', 1, '2016-01-07 13:27:00'),
(2, 1, 1, 'test', 1, '2016-01-07 00:00:00'),
(3, 1, 1, 'Komentar', 1, '2016-01-07 13:48:27'),
(4, 2, 2, 'Warnet ini bagus', 1, '2016-01-07 13:49:18');

-- --------------------------------------------------------

--
-- Table structure for table `tblfasilitas`
--

CREATE TABLE `tblfasilitas` (
  `fsl_wrnet_id` int(8) NOT NULL,
  `fsl_id` int(8) NOT NULL,
  `fsl_name` varchar(30) NOT NULL,
  `fsl_desc` varchar(200) NOT NULL,
  `fsl_avl` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblmember`
--

CREATE TABLE `tblmember` (
  `mbr_id` int(8) NOT NULL,
  `mbr_username` varchar(64) NOT NULL,
  `mbr_password` varchar(32) NOT NULL,
  `mbr_name` varchar(200) NOT NULL,
  `mbr_email` varchar(64) NOT NULL,
  `mbr_tempat_lhr` varchar(100) DEFAULT '',
  `mbr_tgl_lhr` datetime(6) NOT NULL,
  `mbr_phone` varchar(30) DEFAULT '',
  `mbr_mode` tinyint(4) DEFAULT '1',
  `mbr_img` longblob,
  `mbr_img_nm` varchar(50) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblmember`
--

INSERT INTO `tblmember` (`mbr_id`, `mbr_username`, `mbr_password`, `mbr_name`, `mbr_email`, `mbr_tempat_lhr`, `mbr_tgl_lhr`, `mbr_phone`, `mbr_mode`, `mbr_img`, `mbr_img_nm`) VALUES
(1, 'admin', 'admin', 'Administrator', 'admin@cariwarnet.com', '', '2015-12-16 00:00:00.000000', '', 1, NULL, ''),
(2, 'bukhari', 'tes', 'Bukhari Muslim', 'bukhari@cariwarnet.com', '', '1970-01-01 00:00:00.000000', '', 1, NULL, '6_1icecreamfloat.jpg'),
(8, 'user', 'user', 'Pengguna Warnet', 'user@user.com', 'Medan', '1968-01-10 00:00:00.000000', '0812312313', 1, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `tblpc`
--

CREATE TABLE `tblpc` (
  `pc_id` int(8) NOT NULL,
  `pc_warnet_id` int(8) NOT NULL,
  `pc_stat` tinyint(1) DEFAULT '1',
  `pc_mbr_id` int(8) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpc`
--

INSERT INTO `tblpc` (`pc_id`, `pc_warnet_id`, `pc_stat`, `pc_mbr_id`) VALUES
(1, 1, 1, 0),
(2, 1, 0, 0),
(3, 1, 1, 0),
(4, 1, 1, 0),
(5, 1, 1, 0),
(6, 1, 0, 0),
(7, 1, 1, 0),
(8, 1, 0, 0),
(9, 1, 0, 0),
(10, 1, 1, 0),
(11, 2, 0, 0),
(12, 2, 0, 0),
(13, 2, 1, 0),
(14, 2, 1, 0),
(15, 2, 1, 0),
(16, 2, 1, 0),
(17, 2, 1, 0),
(18, 2, 1, 0),
(19, 2, 0, 0),
(20, 2, 1, 0),
(21, 2, 0, 0),
(22, 2, 0, 0),
(23, 2, 1, 0),
(24, 2, 1, 0),
(25, 2, 1, 0),
(26, 3, 1, 0),
(27, 3, 1, 0),
(28, 3, 0, 0),
(29, 3, 1, 0),
(30, 3, 0, 0),
(31, 3, 0, 0),
(32, 3, 1, 0),
(33, 3, 1, 0),
(34, 3, 0, 0),
(35, 3, 0, 0),
(36, 3, 1, 0),
(37, 4, 1, 0),
(38, 4, 0, 0),
(39, 4, 0, 0),
(40, 4, 1, 0),
(41, 4, 1, 0),
(42, 4, 0, 0),
(43, 4, 1, 0),
(44, 4, 1, 0),
(45, 4, 0, 0),
(46, 4, 0, 0),
(47, 4, 1, 0),
(48, 4, 1, 0),
(49, 4, 1, 0),
(50, 4, 0, 0),
(51, 5, 1, 0),
(52, 5, 0, 0),
(53, 5, 1, 0),
(54, 5, 0, 0),
(55, 5, 0, 0),
(56, 5, 1, 0),
(57, 5, 0, 0),
(58, 5, 1, 0),
(59, 5, 0, 0),
(60, 5, 1, 0),
(61, 5, 1, 0),
(62, 5, 0, 0),
(63, 5, 0, 0),
(64, 5, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblrating`
--

CREATE TABLE `tblrating` (
  `mbr_id` int(8) NOT NULL,
  `wrnet_id` int(8) NOT NULL,
  `rate_val` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblwarnet`
--

CREATE TABLE `tblwarnet` (
  `wrnet_id` int(8) NOT NULL,
  `wrnet_owner` int(8) NOT NULL,
  `wrnet_name` varchar(64) NOT NULL,
  `wrnet_alamat` varchar(200) DEFAULT '',
  `wrnet_kota` varchar(50) DEFAULT '',
  `wrnet_phone` varchar(30) DEFAULT NULL,
  `wrnet_img` longblob,
  `wrnet_img_nm` varchar(50) DEFAULT '',
  `wrnet_add` datetime NOT NULL,
  `wrnet_f_printer` tinyint(1) DEFAULT '0',
  `wrnet_f_pulsa` tinyint(1) DEFAULT '0',
  `wrnet_f_game` tinyint(1) DEFAULT '0',
  `wrnet_f_ketik` tinyint(1) DEFAULT '0',
  `wrnet_f_acc` tinyint(1) DEFAULT '0',
  `wrnet_f_otr` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblwarnet`
--

INSERT INTO `tblwarnet` (`wrnet_id`, `wrnet_owner`, `wrnet_name`, `wrnet_alamat`, `wrnet_kota`, `wrnet_phone`, `wrnet_img`, `wrnet_img_nm`, `wrnet_add`, `wrnet_f_printer`, `wrnet_f_pulsa`, `wrnet_f_game`, `wrnet_f_ketik`, `wrnet_f_acc`, `wrnet_f_otr`) VALUES
(1, 1, 'Flux', 'Jln. S. Parman 104', 'Medan', '06188123551', NULL, '', '2016-01-06 00:00:00', 0, 0, 0, 0, 0, 0),
(2, 1, 'Level1CyberWorld', 'Gedung Parkir Kampus BINUS Anggrek LT.1', '', '1', NULL, '', '2016-01-04 00:00:00', 0, 0, 0, 0, 0, 0),
(3, 1, 'Cyber Net', 'Jl. Darat No. 28', '', '1', NULL, '', '2016-01-06 00:00:00', 0, 0, 0, 0, 0, 0),
(4, 2, 'Neo Net', 'Jl. G. Subroto No.512', 'Medan', '08123184894', NULL, '', '2016-01-07 00:00:00', 1, 0, 1, 1, 0, 0),
(5, 2, 'Grass Net', 'Jl. Kelambir Lima', 'Medan', '06112912381', NULL, '', '2016-01-03 00:00:00', 0, 0, 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblcomment`
--
ALTER TABLE `tblcomment`
  ADD PRIMARY KEY (`com_id`);

--
-- Indexes for table `tblmember`
--
ALTER TABLE `tblmember`
  ADD PRIMARY KEY (`mbr_id`),
  ADD UNIQUE KEY `mbr_username` (`mbr_username`);

--
-- Indexes for table `tblpc`
--
ALTER TABLE `tblpc`
  ADD PRIMARY KEY (`pc_id`);

--
-- Indexes for table `tblwarnet`
--
ALTER TABLE `tblwarnet`
  ADD PRIMARY KEY (`wrnet_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblcomment`
--
ALTER TABLE `tblcomment`
  MODIFY `com_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tblmember`
--
ALTER TABLE `tblmember`
  MODIFY `mbr_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tblpc`
--
ALTER TABLE `tblpc`
  MODIFY `pc_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `tblwarnet`
--
ALTER TABLE `tblwarnet`
  MODIFY `wrnet_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
