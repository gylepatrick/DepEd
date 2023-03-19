-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2023 at 04:00 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `deped`
--

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `district_id` int(12) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`district_id`, `name`) VALUES
(110011, 'DISTRICT I'),
(110012, 'DISTRICT II');

-- --------------------------------------------------------

--
-- Table structure for table `inv_bank`
--

CREATE TABLE `inv_bank` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `school` varchar(255) NOT NULL,
  `tree_id` int(12) NOT NULL,
  `tree` varchar(255) NOT NULL,
  `tree_type` varchar(255) NOT NULL,
  `tree_status` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `month` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inv_bank`
--

INSERT INTO `inv_bank` (`id`, `user_id`, `school`, `tree_id`, `tree`, `tree_type`, `tree_status`, `location`, `latitude`, `longitude`, `month`) VALUES
(88, 'User 1', 'Sumpong Central School', 62, 'V', 'foriegn', 'alive', 'Dalwangan', '0', '0', 'Mar-2023'),
(89, 'User 1', 'Malaybalay Central School', 63, 'G', 'foriegn', 'alive', 'Dalwangan', '234', '23', 'Mar-2023'),
(90, 'User 2', 'Sumpong Central School', 60, 'A', 'native', 'alive', 'school field', '123', '121', 'Mar-2023'),
(91, 'User 2', 'Sumpong Central School', 61, 'B', 'foriegn', 'alive', 'school field', '2321', '121', 'Mar-2023');

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE `school` (
  `school_id` int(12) NOT NULL,
  `name` varchar(255) NOT NULL,
  `district_id` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`school_id`, `name`, `district_id`) VALUES
(1, 'Sumpong Central School', 110011),
(2, 'Malaybalay Central School', 110012);

-- --------------------------------------------------------

--
-- Table structure for table `tree`
--

CREATE TABLE `tree` (
  `id` int(12) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `school_name` varchar(255) NOT NULL,
  `tree` varchar(255) NOT NULL,
  `tree_type` varchar(255) NOT NULL,
  `tree_status` varchar(255) NOT NULL,
  `longitude` int(12) NOT NULL,
  `latitude` int(12) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tree`
--

INSERT INTO `tree` (`id`, `user_id`, `school_name`, `tree`, `tree_type`, `tree_status`, `longitude`, `latitude`, `location`) VALUES
(60, 'User 2', 'Sumpong Central School', 'A', 'native', 'alive', 121, 123, 'school field'),
(61, 'User 2', 'Sumpong Central School', 'B', 'foriegn', 'alive', 121, 2321, 'school field'),
(62, 'User 1', 'Sumpong Central School', 'V', '--Select Type--', 'alive', 0, 0, 'Dalwangan'),
(63, 'User 1', 'Malaybalay Central School', 'G', 'foriegn', 'alive', 23, 234, 'Dalwangan');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `name`) VALUES
(1, 'Foreign'),
(2, 'Native');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `status`, `password`) VALUES
(8, 'Gyle Patrick Lukinhay', 'lukinhaygylepatrick@gmail.com', 'administrator', '123456'),
(10, 'User 1', 'user1@gmail.com', 'coordinator', 'user123'),
(11, 'User 2', 'user2@gmail.com', 'coordinator', 'user123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`district_id`);

--
-- Indexes for table `inv_bank`
--
ALTER TABLE `inv_bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`school_id`),
  ADD KEY `district_id` (`district_id`);

--
-- Indexes for table `tree`
--
ALTER TABLE `tree`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inv_bank`
--
ALTER TABLE `inv_bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `tree`
--
ALTER TABLE `tree`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `school`
--
ALTER TABLE `school`
  ADD CONSTRAINT `school_ibfk_1` FOREIGN KEY (`district_id`) REFERENCES `district` (`district_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
