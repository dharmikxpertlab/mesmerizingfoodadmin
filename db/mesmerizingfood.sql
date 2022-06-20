-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 26, 2021 at 01:29 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mesmerizingfood`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointmentId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `chefId` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `callType` enum('video','audio') NOT NULL,
  `amount` double NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointmentId`, `userId`, `chefId`, `date`, `time`, `callType`, `amount`, `status`, `created`, `updated`) VALUES
(1, 1, 1, '2021-11-26', '12:00:00', 'video', 500, 0, '2021-11-26 11:31:47', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `chef`
--

CREATE TABLE `chef` (
  `chefId` int(11) NOT NULL,
  `fullName` varchar(70) NOT NULL,
  `email` varchar(60) NOT NULL,
  `countryCode` int(3) NOT NULL,
  `mobileNumber` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `country` varchar(50) NOT NULL,
  `state` varchar(100) DEFAULT NULL,
  `gender` enum('Male','Female','Other','') NOT NULL,
  `profilePic` varchar(255) DEFAULT NULL,
  `info` varchar(120) DEFAULT NULL,
  `languageKnown` text DEFAULT NULL,
  `experienceType` enum('Homecooking','Professional Chef','iiHM Student','user level') DEFAULT 'user level',
  `experience` text DEFAULT NULL,
  `experienceYear` int(3) DEFAULT NULL,
  `hotelName` varchar(100) DEFAULT NULL,
  `courseName` varchar(200) DEFAULT NULL,
  `courseType` enum('diploma','degree') DEFAULT NULL,
  `experienceDoc` text DEFAULT NULL,
  `rating` float NOT NULL DEFAULT 0,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chef`
--

INSERT INTO `chef` (`chefId`, `fullName`, `email`, `countryCode`, `mobileNumber`, `password`, `dateOfBirth`, `country`, `state`, `gender`, `profilePic`, `info`, `languageKnown`, `experienceType`, `experience`, `experienceYear`, `hotelName`, `courseName`, `courseType`, `experienceDoc`, `rating`, `created`, `updated`) VALUES
(1, 'dharmik', 'abc@gmail.com', 91, '9054815492', '202cb962ac59075b964b07152d234b70', '2000-05-15', 'india', 'gujarat', 'Male', '16378995867523.jpeg', '', '[\"hindi\",\"english\"]', 'iiHM Student', 'abcd', 5, 'abcd', 'abcd', 'diploma', '163790793290627.jpeg', 0, '2021-11-25 13:03:34', '2021-11-26 09:16:19'),
(2, 'abc', 'xyz@gmail.com', 91, '9426449988', '202cb962ac59075b964b07152d234b70', '2000-04-13', 'abc', NULL, 'Male', NULL, NULL, '[\"hindi\",\"english\",\"gujarati\"]', 'user level', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-11-26 05:22:32', '2021-11-26 08:55:49'),
(3, 'abcd', 'abcd@gmail.com', 95, '9426449988', '202cb962ac59075b964b07152d234b70', '2000-04-13', 'abc', NULL, 'Male', NULL, NULL, '[\"hindi\",\"english\",\"gujarati\"]', 'user level', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-11-26 05:22:49', '2021-11-26 08:55:51'),
(4, 'abcde', 'abcde@gmail.com', 95, '9426449988', '202cb962ac59075b964b07152d234b70', '2000-04-13', 'abc', NULL, 'Male', NULL, NULL, '[\"hindi\",\"english\",\"gujarati\"]', 'iiHM Student', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-11-26 05:22:49', '2021-11-26 08:55:54'),
(5, 'professional chef', 'professional@gmail.com', 95, '9426449988', '202cb962ac59075b964b07152d234b70', '2000-04-13', 'abc', NULL, 'Male', NULL, NULL, '[\"hindi\",\"english\",\"gujarati\"]', 'Professional Chef', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-11-26 05:22:49', '2021-11-26 08:55:57'),
(6, 'home cook', 'home@gmail.com', 95, '9426449988', '202cb962ac59075b964b07152d234b70', '2000-04-13', 'abc', NULL, 'Male', NULL, NULL, '[\"hindi\",\"english\",\"gujarati\"]', 'Homecooking', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-11-26 05:22:49', '2021-11-26 08:56:01');

-- --------------------------------------------------------

--
-- Table structure for table `cuisines`
--

CREATE TABLE `cuisines` (
  `cuisineId` int(11) NOT NULL,
  `cuisineName` varchar(60) NOT NULL,
  `cuisineImage` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cuisines`
--

INSERT INTO `cuisines` (`cuisineId`, `cuisineName`, `cuisineImage`) VALUES
(1, 'indian', 'https://image.shutterstock.com/image-photo/healthy-food-clean-eating-selection-600w-722718097.jpg'),
(2, 'japanese', 'https://i.ndtvimg.com/i/2016-04/japanese-food-625_625x406_81461928658.jpg'),
(3, 'spanish', 'https://upload.wikimedia.org/wikipedia/commons/6/66/Paella_de_marisco_01_%28cropped%29_4.3.jpg'),
(4, 'japanese', 'https://www.wapititravel.com/blog/wp-content/uploads/2020/01/miso-soup__healthy_japan_food.jpg.webp'),
(5, 'italian', 'https://c.ndtvimg.com/2020-04/dih4ifhg_pasta_625x300_22_April_20.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `liked`
--

CREATE TABLE `liked` (
  `likeId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `type` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `liked`
--

INSERT INTO `liked` (`likeId`, `userId`, `id`, `type`) VALUES
(3, 1, 1, 'chef');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `imageId` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `images` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`imageId`, `type`, `images`) VALUES
(1, 'slider', '[\"https://upload.wikimedia.org/wikipedia/commons/b/b6/Image_created_with_a_mobile_phone.png\",\"https://upload.wikimedia.org/wikipedia/commons/b/b6/Image_created_with_a_mobile_phone.png\",\"https://upload.wikimedia.org/wikipedia/commons/b/b6/Image_created_with_a_mobile_phone.png\"]'),
(2, 'add', '\"https://upload.wikimedia.org/wikipedia/commons/b/b6/Image_created_with_a_mobile_phone.png\"');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `fullName` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `countryCode` int(3) NOT NULL,
  `mobileNumber` varchar(20) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `password` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `languages` text DEFAULT NULL,
  `profilePic` varchar(100) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `fullName`, `email`, `countryCode`, `mobileNumber`, `dateOfBirth`, `password`, `country`, `city`, `gender`, `languages`, `profilePic`, `created`, `updated`) VALUES
(1, 'abc', 'abc', 91, '9426449988', '2000-04-13', '202cb962ac59075b964b07152d234b70', 'abc', 'abc', NULL, NULL, '163790132425242.jpeg', '2021-11-25 11:44:18', '2021-11-26 04:35:24'),
(2, 'abc', 'abc@gmail.com', 91, '9426449988', '2000-04-13', '202cb962ac59075b964b07152d234b70', 'abc', 'abc', NULL, NULL, NULL, '2021-11-25 11:45:28', '0000-00-00 00:00:00'),
(3, 'abc', 'abcd@gmail.com', 91, '9426449988', '2000-04-13', '202cb962ac59075b964b07152d234b70', 'abc', 'abc', NULL, NULL, NULL, '2021-11-25 11:46:45', '0000-00-00 00:00:00'),
(4, 'abc', 'abcde@gmail.com', 91, '9426449988', '2000-04-13', '202cb962ac59075b964b07152d234b70', 'abc', 'abc', NULL, NULL, NULL, '2021-11-25 11:47:05', '0000-00-00 00:00:00'),
(5, 'abc', 'xyz@gmail.com', 91, '9426449988', '2000-04-13', '202cb962ac59075b964b07152d234b70', 'abc', 'abc', NULL, NULL, NULL, '2021-11-26 05:22:05', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointmentId`);

--
-- Indexes for table `chef`
--
ALTER TABLE `chef`
  ADD PRIMARY KEY (`chefId`);

--
-- Indexes for table `cuisines`
--
ALTER TABLE `cuisines`
  ADD PRIMARY KEY (`cuisineId`);

--
-- Indexes for table `liked`
--
ALTER TABLE `liked`
  ADD PRIMARY KEY (`likeId`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`imageId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointmentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chef`
--
ALTER TABLE `chef`
  MODIFY `chefId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cuisines`
--
ALTER TABLE `cuisines`
  MODIFY `cuisineId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `liked`
--
ALTER TABLE `liked`
  MODIFY `likeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `imageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
