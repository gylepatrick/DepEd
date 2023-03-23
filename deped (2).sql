-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2023 at 02:26 PM
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
(102, 'User 2', 'Dalwangan National High School - DISTRICT II', 68, 'Mahogany', 'native', 'alive', 'Dalwangan Pineapple Field', '1321', '121', 'Mar-2023'),
(103, 'User 2', 'Dalwangan National High School - DISTRICT II', 69, 'Mahogany', 'native', 'alive', 'Dalwangan Pineapple Field', '1321', '12', 'Mar-2023'),
(104, 'User 1', 'Dalwangan National High School - DISTRICT I', 70, 'Mahogany', 'native', 'alive', 'Dalwangan', '1321', '1', 'Mar-2023'),
(105, 'User 1', 'Dalwangan National High School - DISTRICT I', 71, 'Mahogany', 'native', 'alive', 'Dalwangan', '123', '211', 'Mar-2023');

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE `school` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `district_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`id`, `name`, `district_id`) VALUES
(7, 'Dalwangan National High School', 'DISTRICT I'),
(8, 'Dalwangan Elementary School', 'DISTRICT IV'),
(11, 'School 2', 'DISTRICT I'),
(12, 'School 3', 'DISTRICT I'),
(13, 'School 4', 'DISTRICT I');

-- --------------------------------------------------------

--
-- Table structure for table `tree`
--

CREATE TABLE `tree` (
  `id` int(12) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `school_name` varchar(255) NOT NULL,
  `district_name` varchar(2555) NOT NULL,
  `tree` varchar(255) NOT NULL,
  `tree_type` varchar(255) NOT NULL,
  `tree_status` varchar(255) NOT NULL,
  `longitude` int(12) NOT NULL,
  `latitude` int(12) NOT NULL,
  `location` varchar(255) NOT NULL,
  `brgy` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tree`
--

INSERT INTO `tree` (`id`, `user_id`, `school_name`, `district_name`, `tree`, `tree_type`, `tree_status`, `longitude`, `latitude`, `location`, `brgy`) VALUES
(76, 'User 1', 'Dalwangan National High School', 'DISTRICT I', 'Mahogany', 'native', 'alive', 121, 1321, 'inside', 'Dalwangan'),
(77, 'User 1', 'Dalwangan National High School', 'DISTRICT I', 'Palakata', 'foriegn', 'dead', 1, 2, 'inside', 'Dalwangan'),
(78, 'User 1', 'Dalwangan National High School', 'DISTRICT I', 'Manggo', 'fruit', 'alive', 121, 212, 'inside', 'Dalwangan'),
(79, 'User 2', 'Sumpong Central School', 'DISTRICT II', 'Mahogany', 'native', 'alive', 121, 1321, 'outside', 'Sumpong'),
(80, 'User 2', 'Sumpong Central School', 'DISTRICT II', 'Mahogany', 'native', 'alive', 2, 13412, 'outside', 'Sumpong');

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
  `password` varchar(100) NOT NULL,
  `school` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `status`, `password`, `school`, `district`) VALUES
(8, 'Gyle Patrick Lukinhay', 'lukinhaygylepatrick@gmail.com', 'administrator', '123456', '', ''),
(18, 'User 2', 'user2@gmail.com', 'coordinator', '12345678', 'Sumpong Central School', 'DISTRICT II'),
(19, 'User 1', 'user1@gmail.com', 'coordinator', 'user1@gmail.com', 'Dalwangan National High School', 'DISTRICT I');

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
  ADD PRIMARY KEY (`id`),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `school`
--
ALTER TABLE `school`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tree`
--
ALTER TABLE `tree`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
