-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 04, 2021 at 01:55 AM
-- Server version: 10.3.31-MariaDB-log-cll-lve
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wwwbgpscsylheted_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `city_corporation`
--

CREATE TABLE `city_corporation` (
  `id` int(11) NOT NULL,
  `division_id` int(8) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_bn` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lat` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lon` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` longtext COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `city_corporation`
--

INSERT INTO `city_corporation` (`id`, `division_id`, `district_id`, `name`, `name_bn`, `category`, `lat`, `lon`, `url`) VALUES
(1, 6, 47, 'Dhaka North CC', 'ঢাকা উত্তর সিসি', 'CC', '', '', ''),
(2, 6, 47, 'Dhaka South CC', 'ঢাকা দক্ষিণ সিসি', 'CC', '', '', ''),
(3, 1, 8, 'Chattogram CC', 'চট্টগ্রাম সিসি', 'CC', '', '', ''),
(4, 5, 36, 'Sylhet CC', 'সিলেট সি.সি', 'CC', '', '', ''),
(5, 4, 33, 'Barishal CC', 'বরিশাল সি.সি', 'CC', '', '', ''),
(6, 3, 27, 'Khulna CC', 'খুলনা সি.সি', 'CC', '', '', ''),
(7, 2, 15, 'Rajshahi CC', 'রাজশাহী সিসি', 'CC', '', '', ''),
(8, 6, 41, 'Gazipur CC', 'গাজীপুর সি.সি', 'CC', '', '', ''),
(9, 6, 43, 'Narayanganj CC', 'নারায়ণগঞ্জ সি.সি', 'CC', '', '', ''),
(10, 7, 59, 'Rangpur CC', 'রংপুর সিসি', 'CC', '', '', ''),
(11, 1, 1, 'Cumilla CC', 'কুমিল্লা সিসি', 'CC', '', '', ''),
(12, 8, 62, 'Mymensingh CC', 'ময়মনসিংহ সি.সি', 'CC', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `city_corporation`
--
ALTER TABLE `city_corporation`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `city_corporation`
--
ALTER TABLE `city_corporation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
