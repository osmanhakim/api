-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 12, 2020 at 07:28 PM
-- Server version: 5.7.17-log
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `fullname`, `username`, `password`) VALUES
(1, 'osman hadgo', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `adminsessions`
--

CREATE TABLE `adminsessions` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `accesstoken` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `accesstokenexpirey` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `adminsessions`
--

INSERT INTO `adminsessions` (`id`, `userid`, `accesstoken`, `accesstokenexpirey`) VALUES
(2, 1, 'ZDJkMGY0M2Q3NGQ2OWY0NDM1YTczNWU5ZjkyOGU5NDU1NWEzYmYxMzY3ZThlYzY1MzEzNTM4MzYzNzMwMzYzOTMzMzU=', '2020-04-19 17:55:35'),
(3, 1, 'YWQyMmRhMjBhNmNmM2ZiNTM3MDVhN2RiZTlmODJjZDJjMGFmODMzMzIzZTU4ZGQ2MzEzNTM4MzYzNzMwMzYzOTM4MzY=', '2020-04-11 17:56:26'),
(4, 1, 'OGQ2ZTBkMzFjYTk5OTAyZTY2MTM0YWM0MDU0ZmQ1N2JiMDFiM2FkODUwZDgxZjY5MzEzNTM4MzYzNzMxMzAzODM0MzE=', '2020-04-19 19:00:41');

-- --------------------------------------------------------

--
-- Table structure for table `buyer`
--

CREATE TABLE `buyer` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `buyer`
--

INSERT INTO `buyer` (`id`, `fullname`, `username`, `password`) VALUES
(1, 'test user', 'testuser1', '555555555555555555555555555555555555555'),
(2, 'osman hadgo', 'jack16', '25d55ad283aa400af464c76d713c07ad'),
(3, 'adel abdulhakim', 'jackhadgo', '25d55ad283aa400af464c76d713c07ad');

-- --------------------------------------------------------

--
-- Table structure for table `buyersessions`
--

CREATE TABLE `buyersessions` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `accesstoken` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `accesstokenexpirey` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`id`, `fullname`, `username`, `password`) VALUES
(1, 'ahmed abdulhakim', 'ahmedseller', '25d55ad283aa400af464c76d713c07ad'),
(2, 'abdulhakim osman', 'abdulhakimseller', 'b74f737a3383bb860c1a9f589b066241');

-- --------------------------------------------------------

--
-- Table structure for table `sellersessions`
--

CREATE TABLE `sellersessions` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `accesstoken` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `accesstokenexpirey` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `adminsessions`
--
ALTER TABLE `adminsessions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `accesstoken` (`accesstoken`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `buyer`
--
ALTER TABLE `buyer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `buyersessions`
--
ALTER TABLE `buyersessions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `accesstoken` (`accesstoken`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `sellersessions`
--
ALTER TABLE `sellersessions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `accesstoken` (`accesstoken`),
  ADD KEY `userid` (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `adminsessions`
--
ALTER TABLE `adminsessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `buyer`
--
ALTER TABLE `buyer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `buyersessions`
--
ALTER TABLE `buyersessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sellersessions`
--
ALTER TABLE `sellersessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `adminsessions`
--
ALTER TABLE `adminsessions`
  ADD CONSTRAINT `userid` FOREIGN KEY (`userid`) REFERENCES `admin` (`id`);

--
-- Constraints for table `buyersessions`
--
ALTER TABLE `buyersessions`
  ADD CONSTRAINT `buyersessions_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `buyer` (`id`);

--
-- Constraints for table `sellersessions`
--
ALTER TABLE `sellersessions`
  ADD CONSTRAINT `sellersessions_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `seller` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
