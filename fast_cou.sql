-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2020 at 08:09 PM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fast_cou`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE `admin_table` (
  `aid` int(11) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `admin_pass` varchar(100) NOT NULL,
  `photo` varchar(50) DEFAULT NULL,
  `image_text` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`aid`, `admin_name`, `admin_pass`, `photo`, `image_text`) VALUES
(1, 'Sumon', 'a01610228fe998f515a72dd730294d87', '10641034_765774853488260_4430310261071271602_n.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_info`
--

CREATE TABLE `delivery_info` (
  `del_id` int(11) NOT NULL,
  `del_area` varchar(100) DEFAULT NULL,
  `col_amount` int(11) DEFAULT NULL,
  `recv_name` varchar(50) DEFAULT NULL,
  `recv_number` varchar(50) DEFAULT NULL,
  `recv_address` varchar(100) DEFAULT NULL,
  `bok_date` date NOT NULL,
  `m_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_info`
--

INSERT INTO `delivery_info` (`del_id`, `del_area`, `col_amount`, `recv_name`, `recv_number`, `recv_address`, `bok_date`, `m_id`) VALUES
(33, 'Outside Dhaka', 120, 'abc', '12345678', 'fsaf faafs', '2020-03-31', 1),
(42, 'Outside Dhaka', 160, 'nafiz', '123456789', 'Rupnagar R/A Dhak-1216', '2020-03-31', 1),
(43, 'Dhaka Metro', 120, 'Abc mahmud', '12345678', 'Mirpur-11/C, Av-5, Road-23, Dhaka-1216', '2020-03-31', 2),
(44, 'Dhaka Metro', 60, 'bbc', '1233', 'oldkd dsnblj', '2020-04-01', 2),
(45, 'Dhaka Metro', 120, 'mihan', '01673303919', 'Mirpur-11, Block-C, Av-5, Lane-23, Dhaka-1216', '2020-04-01', 3),
(46, 'Dhaka Metro', 110, 'acd', '13143', 'yhgiug jkgbkjvk', '2020-04-01', 1),
(47, 'Dhaka Metro', 110, 'heyq', '1214', 'fafEFEFE', '2020-04-03', 2),
(54, 'Dhaka Metro', 120, 'abcd', '12345678', 'fsafasf', '2020-04-03', 1),
(55, 'Dhaka Metro', 120, 'adada', '12345678', 'efaw', '2020-04-03', 1),
(56, 'Dhaka Metro', 120, 'adada', '12345678', 'dafa', '2020-04-03', 1),
(57, 'Dhaka Metro', 120, 'adada', '12345678', 'dafa', '2020-04-03', 1),
(58, 'Dhaka Metro', 0, 'acccc', '12345678', 'dadfaafd', '2020-04-03', 1),
(59, 'Outside Dhaka', 0, 'abcd', '1214', 'sknakds', '2020-04-03', 1),
(60, 'Dhaka Metro', 0, 'mihan', '12345678', 'dafad sffda', '2020-04-03', 1),
(61, 'Outside Dhaka', 0, 'aaaaaaaaa', '1214', 'wfafwfqwe', '2020-04-03', 1),
(62, 'Outside Dhaka', 120, 'aabb', '1234', 'dauohaoihdad', '2020-04-03', 2),
(64, 'Outside Dhaka', 0, 'vox', '1214', 'shdlhdlISD VFS', '2020-04-04', 3),
(65, 'Outside Dhaka', 150, 'nafu', '1234', 'lasjasid', '2020-04-04', 1),
(67, 'Dhaka Metro', 170, 'Hridoy', '123456789', 'Savar Dhaka', '2020-04-04', 1),
(68, 'Dhaka Metro', 200, 'Sima', '12345678', 'khasdgasdha', '2020-04-04', 1),
(69, 'Dhaka Metro', 0, 'Arafat', '1214', 'ashdajldla', '2020-04-04', 1),
(70, 'Dhaka Metro', 160, 'abcd', '12345678', 'afsfarw', '2020-04-04', 8),
(71, 'Dhaka Metro', 0, 'mihan', '12345678', 'lsjlkjfas', '2020-04-04', 8),
(72, 'Outside Dhaka', 160, 'ami', '12345678', 'lhdflkhsaldf', '2020-04-05', 8),
(73, 'Outside Dhaka', 0, 'hello', '12345678', 'dnknADF', '2020-04-05', 8),
(74, 'Outside Dhaka', 160, 'hello2', '231346', 'asfgsg', '2020-04-05', 8),
(75, 'Dhaka Metro', 0, 'ami2', '12345678', 'wfaf', '2020-04-05', 8),
(76, 'Dhaka Metro', 160, 'ami3', '122321', 'fvcfsaaaa', '2020-04-05', 8),
(77, 'Dhaka Metro', 0, 'saiam', '1234', 'afsj iadpjsf', '2020-04-05', 1),
(78, 'Outside Dhaka', 200, 'Sima', '12345678', 'abc abc abc abc abc', '2020-04-16', 1),
(79, 'Dhaka Metro', 300, 'Shamsul Islam', '123456789', 'Plot # 77-78, Road # 9, Rupnagar R/A Mirpur-2 Dhaka, 1216', '0000-00-00', 1),
(80, 'Dhaka Metro', 170, 'Jambu', '12345678', 'afafaf gsfgsg tadgfga dgsgag taggaer ethtahgatg thathateh ergaregaer', '0000-00-00', 2),
(81, 'Outside Dhaka', 100, 'hridoy', '1214', 'dgakjd akjgdakjhald', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(6) UNSIGNED NOT NULL,
  `emp_name` varchar(30) NOT NULL,
  `emp_email` varchar(50) DEFAULT NULL,
  `emp_mob` varchar(50) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `emp_pass` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `emp_name`, `emp_email`, `emp_mob`, `reg_date`, `emp_pass`) VALUES
(1, 'monju', 'abc@gmail.com', '123456789', '2020-04-24 17:26:21', '81dc9bdb52d04dc20036dbd8313ed055'),
(2, 'Rahman', 'acd@gmail.com', '12345678', '2020-04-24 17:03:39', '81dc9bdb52d04dc20036dbd8313ed055'),
(3, 'Sojol', 'aaaa@gmail.com', '123456789', '2020-04-24 17:03:43', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Table structure for table `marchant`
--

CREATE TABLE `marchant` (
  `m_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `pass` varchar(50) DEFAULT NULL,
  `balance` varchar(50) DEFAULT NULL,
  `due_balance` varchar(50) DEFAULT NULL,
  `pickup_add` varchar(100) DEFAULT NULL,
  `photo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marchant`
--

INSERT INTO `marchant` (`m_id`, `name`, `email`, `mobile`, `pass`, `balance`, `due_balance`, `pickup_add`, `photo`) VALUES
(1, 'Mihan', 'mihan@gmail.com', '01673303919', '81dc9bdb52d04dc20036dbd8313ed055', '640', '380', 'Mirpur-11', '11206046_888841657848245_1960959772315920376_n.jpg'),
(2, 'Sima', 'abc@gmail.com', '123456789', '81dc9bdb52d04dc20036dbd8313ed055', '240', '0', 'Rupnagar R/A', 'Sima.jpg'),
(3, 'faisal', 'db@gmail.com', '123456789', '81dc9bdb52d04dc20036dbd8313ed055', '60', '100', 'Dhaka Mirpur-2', 'foysal.jpg'),
(5, 'Nafiz', 'acd@gmail.com', '123456789', '81dc9bdb52d04dc20036dbd8313ed055', NULL, NULL, 'Rupnaga R/A', NULL),
(8, 'yesmine', 'ffdfd@gmail.com', '676789980', '698d51a19d8a121ce581499d7b701668', '160', '160', 'BUBT Rupnagar', NULL),
(10, 'Arafat', 'gutibaz@gmail.com', '123456789', '81dc9bdb52d04dc20036dbd8313ed055', NULL, NULL, 'Mirpur-2, 60ft Road', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` int(11) NOT NULL,
  `m_id` int(11) DEFAULT NULL,
  `del_man` varchar(50) DEFAULT NULL,
  `del_sts` varchar(50) DEFAULT NULL,
  `charge` varchar(50) DEFAULT NULL,
  `due_charge` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderID`, `m_id`, `del_man`, `del_sts`, `charge`, `due_charge`) VALUES
(1, 2, 'mojnu', NULL, NULL, NULL),
(2, 2, 'farhad', NULL, NULL, NULL),
(3, 1, 'rafi', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `parcel`
--

CREATE TABLE `parcel` (
  `p_id` int(11) NOT NULL,
  `m_id` int(11) DEFAULT NULL,
  `del_id` int(11) DEFAULT NULL,
  `del_man` varchar(50) NOT NULL DEFAULT 'Waiting',
  `par_status` varchar(50) DEFAULT NULL,
  `chrg` varchar(50) NOT NULL DEFAULT '0',
  `due_chrg` varchar(50) NOT NULL DEFAULT '0',
  `user_bal` varchar(50) NOT NULL DEFAULT '0',
  `payment` varchar(50) NOT NULL DEFAULT '0',
  `stamp_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parcel`
--

INSERT INTO `parcel` (`p_id`, `m_id`, `del_id`, `del_man`, `par_status`, `chrg`, `due_chrg`, `user_bal`, `payment`, `stamp_created`, `modified_at`) VALUES
(99, 1, 33, 'monju', 'Delivered', '100', '0', '20', '1', '2020-03-31 18:00:00', '2020-04-22 07:18:37'),
(125, 1, 42, 'Rahman', 'Delivered', '100', '0', '60', '1', '2020-04-05 15:55:16', '2020-04-22 07:18:37'),
(126, 2, 43, 'Rahman', 'in transit', '60', '0', '60', '1', '2020-04-05 15:55:16', '2020-04-26 17:16:43'),
(127, 2, 44, 'Rahman', 'picked up', '60', '0', '0', '0', '2020-04-05 15:55:16', '2020-04-26 17:24:43'),
(128, 3, 45, 'monju', 'Not pickup yet', '60', '0', '60', '0', '2020-04-05 15:55:16', '2020-04-26 17:28:28'),
(129, 1, 46, 'Waiting', 'Not pickup yet', '60', '0', '50', '0', '2020-04-05 15:55:16', '2020-04-22 07:19:59'),
(130, 2, 47, 'Waiting', 'Not pickup yet', '60', '0', '50', '0', '2020-04-05 15:55:16', '2020-04-22 07:19:59'),
(137, 1, 54, 'Waiting', 'Not pickup yet', '60', '0', '60', '1', '2020-04-05 15:55:16', '2020-04-22 07:19:59'),
(138, 1, 55, 'Waiting', 'Not pickup yet', '60', '0', '60', '1', '2020-04-05 15:55:16', '2020-04-22 07:19:59'),
(139, 1, 56, 'Waiting', 'Not pickup yet', '60', '0', '60', '1', '2020-04-05 15:55:16', '2020-04-22 07:19:59'),
(140, 1, 57, 'Waiting', 'Not pickup yet', '60', '0', '60', '0', '2020-04-05 15:55:16', '2020-04-22 07:19:59'),
(141, 1, 58, 'Waiting', 'Not pickup yet', '0', '60', '0', '0', '2020-04-05 15:55:16', '2020-04-22 07:22:42'),
(142, 1, 59, 'Waiting', 'Not pickup yet', '0', '100', '0', '0', '2020-04-05 15:55:16', '2020-04-22 07:22:42'),
(143, 1, 60, 'Waiting', 'Not pickup yet', '0', '60', '0', '0', '2020-04-05 15:55:16', '2020-04-22 07:22:42'),
(144, 1, 61, 'Waiting', 'Not pickup yet', '0', '100', '0', '0', '2020-04-05 15:55:16', '2020-04-22 07:22:42'),
(145, 2, 62, 'Waiting', 'Not pickup yet', '100', '0', '20', '0', '2020-04-05 15:55:16', '2020-04-22 07:19:59'),
(147, 3, 64, 'Waiting', 'Not pickup yet', '0', '100', '0', '0', '2020-04-05 15:55:16', '2020-04-22 07:22:42'),
(148, 1, 65, 'Waiting', 'Not pickup yet', '100', '0', '50', '0', '2020-04-05 15:55:16', '2020-04-22 07:19:59'),
(149, 1, 67, 'Waiting', 'Not pickup yet', '60', '0', '110', '1', '2020-04-05 15:55:16', '2020-04-22 07:19:59'),
(150, 1, 68, 'Waiting', 'Not pickup yet', '60', '0', '140', '0', '2020-04-05 15:55:16', '2020-04-22 07:19:59'),
(151, 1, 69, 'Waiting', 'Not pickup yet', '0', '60', '0', '1', '2020-04-05 15:55:16', '2020-04-22 07:22:42'),
(152, 8, 70, 'monju', 'picked up', '60', '0', '100', '0', '2020-04-05 15:55:16', '2020-04-22 07:18:37'),
(153, 8, 71, 'Waiting', 'in transit', '0', '60', '0', '0', '2020-04-05 15:55:16', '2020-04-22 07:22:42'),
(154, 8, 72, 'monju', 'picked up', '100', '0', '60', '0', '2020-04-05 15:55:16', '2020-04-26 07:01:18'),
(155, 8, 73, 'monju', 'picked up', '0', '100', '0', '0', '2020-04-05 15:55:16', '2020-04-24 20:02:12'),
(156, 8, 74, 'Rahman', 'Not pickup yet', '100', '0', '60', '1', '2020-04-05 15:55:16', '2020-04-22 07:18:37'),
(157, 8, 75, 'Rahman', 'Not pickup yet', '0', '60', '', '0', '2020-04-05 15:55:16', '2020-04-22 07:22:42'),
(158, 8, 76, 'monju', 'picked up', '60', '0', '100', '1', '2020-04-05 15:55:16', '2020-04-24 20:03:23'),
(159, 1, 77, 'monju', 'Delivered', '0', '60', '0', '0', '2020-04-05 16:14:29', '2020-04-22 07:22:42'),
(160, 1, 78, 'monju', 'picked up', '100', '0', '100', '0', '2020-04-15 18:07:29', '2020-04-22 07:18:37'),
(161, 1, 79, 'Waiting', 'Not pickup yet', '60', '0', '240', '0', '2020-04-20 20:30:48', '2020-04-22 07:19:59'),
(162, 2, 80, 'monju', 'Not pickup yet', '60', '0', '110', '0', '2020-04-25 16:21:53', '2020-04-26 16:58:22'),
(163, 1, 81, 'monju', 'in transit', '100', '0', '0', '0', '2020-04-26 06:49:32', '2020-04-26 06:54:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `delivery_info`
--
ALTER TABLE `delivery_info`
  ADD PRIMARY KEY (`del_id`),
  ADD KEY `m_id` (`m_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marchant`
--
ALTER TABLE `marchant`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `m_id` (`m_id`);

--
-- Indexes for table `parcel`
--
ALTER TABLE `parcel`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `m_id` (`m_id`),
  ADD KEY `del_id` (`del_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1236;

--
-- AUTO_INCREMENT for table `delivery_info`
--
ALTER TABLE `delivery_info`
  MODIFY `del_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `marchant`
--
ALTER TABLE `marchant`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `parcel`
--
ALTER TABLE `parcel`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `delivery_info`
--
ALTER TABLE `delivery_info`
  ADD CONSTRAINT `delivery_info_ibfk_1` FOREIGN KEY (`m_id`) REFERENCES `marchant` (`m_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`m_id`) REFERENCES `marchant` (`m_id`);

--
-- Constraints for table `parcel`
--
ALTER TABLE `parcel`
  ADD CONSTRAINT `parcel_ibfk_1` FOREIGN KEY (`m_id`) REFERENCES `marchant` (`m_id`),
  ADD CONSTRAINT `parcel_ibfk_2` FOREIGN KEY (`del_id`) REFERENCES `delivery_info` (`del_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
