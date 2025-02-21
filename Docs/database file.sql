-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2025 at 07:16 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `field_id` int(11) DEFAULT NULL,
  `application_status` enum('Pending','Approved','Rejected') DEFAULT NULL,
  `submission_date` datetime DEFAULT current_timestamp(),
  `resumee` text DEFAULT NULL,
  `cover_letter` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `user_id`, `field_id`, `application_status`, `submission_date`, `resumee`, `cover_letter`) VALUES
(1, 14, 2, 'Pending', '2025-02-10 15:51:59', '../Uploads/CIT-2152-System-analysis-and-Design.doc.pdf', '../Uploads/CIT-3203-OBJECT-ORIENTED-PROGRAMMING-II.docx.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `fields`
--

CREATE TABLE `fields` (
  `field_id` int(11) NOT NULL,
  `field_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `location` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `fields`
--

INSERT INTO `fields` (`field_id`, `field_name`, `description`, `location`, `created_at`) VALUES
(1, 'CRDB BANK', 'we provide banking services', 'POSTA MPYA', '2025-01-26 00:28:16'),
(2, 'NSSF', 'we provide bima services', 'POSTA YA ZAMANI', '2025-01-26 00:29:55'),
(3, 'MUHIMBILI', 'The nationals hospital that provides various treatmensts and medical care', 'MUHIMBILI', '2025-01-26 01:48:18'),
(4, 'FLY LOGISTICS', 'dealing with fowarding', 'TEGETA', '2025-01-27 07:00:51'),
(5, 'segerea', 'tabata', 'mikocheni', '2025-02-02 03:44:41'),
(6, 'TCRA', 'Dealing with communications', 'MWENGE', '2025-02-20 08:14:26'),
(7, 'hbgtthj', 'gjs', 'jsj', '2025-02-20 08:23:48'),
(8, 'ghg', 'hgfsh', 'hsfh', '2025-02-20 08:52:33');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `profile_id` int(11) NOT NULL,
  `profile_about` text NOT NULL,
  `profile_introTitle` text NOT NULL,
  `profile_introText` text NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`profile_id`, `profile_about`, `profile_introTitle`, `profile_introText`, `user_id`) VALUES
(1, 'yoooooooooo welcome!', 'i&#039;m', 'we finally made it', 10),
(2, 'Get new knowledge , learn new skills worlds changing day by day', 'defaut', 'we are really exited to have you here this is your dashboard you can make any changes you want . feel free to give us feedback reports bebrilliant@gmail.com', 11),
(3, 'Get new knowledge , learn new skills worlds changing day by day', 'hi babe gal', 'we are really exited to have you here this is your dashboard you can make any changes you want . feel free to give us feedback reports bebrilliant@gmail.com', 12),
(4, 'Get new knowledge , learn new skills worlds changing day by day', 'Hello!hassani kanonge', 'we are really exited to have you here this is your dashboard you can make any changes you want . feel free to give us feedback reports bebrilliant@gmail.com', 13),
(5, 'Get new knowledge , learn new skills worlds changing day by day', 'Hello!administrator', 'we are really exited to have you here this is your dashboard you can make any changes you want . feel free to give us feedback reports bebrilliant@gmail.com', 14),
(6, 'Get new knowledge , learn new skills worlds changing day by day', 'Hello!kkkk', 'we are really exited to have you here this is your dashboard you can make any changes you want . feel free to give us feedback reports bebrilliant@gmail.com', 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_uid` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_pwd` varchar(255) NOT NULL,
  `user_role` enum('student','admin') NOT NULL DEFAULT 'student'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_uid`, `user_email`, `user_pwd`, `user_role`) VALUES
(14, 'jese', 'jese@gmail.com', '$2y$10$la2jv6QdxeOpmQJCFI1MdOJOVCkgsC8YcEOCGI0RH5VLpS6K2hCni', 'student'),
(15, 'hassani', 'hassani@gmail.com', '$2y$10$HOK6T5PE1QNWS9UEv3Uw3Oryy8E0HhhIOux6pBPlW79IANa5snKPu', 'admin'),
(16, 'ashura', 'ashura@gmail.com', '$2y$10$..sEnP6kiPoEjeVTodTAN.gH4jG1jNvfRb56g1QZoZj3srCigP7K2', 'admin'),
(17, 'james', 'james@gmail.com', '$2y$10$0T7WiolZ3c1PAH3S4urPkOVnIisLI.Wm.TA2w6rkx5GxxSEasZFnq', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `field_id` (`field_id`);

--
-- Indexes for table `fields`
--
ALTER TABLE `fields`
  ADD PRIMARY KEY (`field_id`),
  ADD UNIQUE KEY `field_name` (`field_name`),
  ADD UNIQUE KEY `description` (`description`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`profile_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_uid` (`user_uid`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fields`
--
ALTER TABLE `fields`
  MODIFY `field_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `applications_ibfk_2` FOREIGN KEY (`field_id`) REFERENCES `fields` (`field_id`);

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
