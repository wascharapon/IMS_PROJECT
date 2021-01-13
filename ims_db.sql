-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2020 at 01:56 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ims_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cus_name`
--

CREATE TABLE `cus_name` (
  `Cus_id` char(5) COLLATE utf8_unicode_ci NOT NULL,
  `Cus_name` char(30) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cus_name`
--

INSERT INTO `cus_name` (`Cus_id`, `Cus_name`) VALUES
('TEST1', 'NAME_TEST');

-- --------------------------------------------------------

--
-- Table structure for table `d_order`
--

CREATE TABLE `d_order` (
  `id_d_order` int(11) NOT NULL,
  `Order_no` int(4) NOT NULL DEFAULT 0,
  `Goods_id` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `Ord_date` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `Fin_date` datetime DEFAULT NULL,
  `Amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `COST_UNIT` decimal(10,2) NOT NULL DEFAULT 0.00,
  `TOT_PRC` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `goods_name`
--

CREATE TABLE `goods_name` (
  `Goods_id` int(10) NOT NULL,
  `Goods_name` char(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `coust_unit` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `goods_name`
--

INSERT INTO `goods_name` (`Goods_id`, `Goods_name`, `coust_unit`) VALUES
(1000000045, 'ลูกบาส', '500.00'),
(1000000046, 'มือถือ', '1000.00');

-- --------------------------------------------------------

--
-- Table structure for table `h_order`
--

CREATE TABLE `h_order` (
  `Order_no` int(4) NOT NULL,
  `Cus_id` char(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Order_Date` datetime NOT NULL DEFAULT '2000-01-01 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m_order`
--

CREATE TABLE `m_order` (
  `Cus_id` char(5) COLLATE utf8_unicode_ci NOT NULL,
  `Good_id` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `Doc_date` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `Ord_date` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `Fin_date` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `Sys_date` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `Amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `cost_tot` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cus_name`
--
ALTER TABLE `cus_name`
  ADD PRIMARY KEY (`Cus_id`);

--
-- Indexes for table `d_order`
--
ALTER TABLE `d_order`
  ADD PRIMARY KEY (`id_d_order`),
  ADD KEY `Order_no` (`Order_no`,`Goods_id`);

--
-- Indexes for table `goods_name`
--
ALTER TABLE `goods_name`
  ADD PRIMARY KEY (`Goods_id`);

--
-- Indexes for table `h_order`
--
ALTER TABLE `h_order`
  ADD PRIMARY KEY (`Order_no`),
  ADD KEY `Cus_id` (`Cus_id`);

--
-- Indexes for table `m_order`
--
ALTER TABLE `m_order`
  ADD KEY `Cus_id` (`Cus_id`,`Good_id`,`Doc_date`,`Ord_date`,`Fin_date`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `d_order`
--
ALTER TABLE `d_order`
  MODIFY `id_d_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `goods_name`
--
ALTER TABLE `goods_name`
  MODIFY `Goods_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000000047;

--
-- AUTO_INCREMENT for table `h_order`
--
ALTER TABLE `h_order`
  MODIFY `Order_no` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=229;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
