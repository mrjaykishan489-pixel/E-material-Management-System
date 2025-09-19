-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2025 at 09:52 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `emms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_master`
--

CREATE TABLE `admin_master` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_master`
--

INSERT INTO `admin_master` (`admin_id`, `username`, `email_id`, `password`, `datetime`) VALUES
(2, 'admin', 'mrjaykishan489@gmail.com', '0e7517141fb53f21ee439b355b5a1d0a', '2025-02-22 13:57:21');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `de_id` int(11) NOT NULL,
  `de_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`de_id`, `de_name`) VALUES
(1, 'Mechanical Engineering'),
(2, 'Chemical Engineering'),
(3, 'Electrical Engineering'),
(4, 'Information Technology'),
(5, 'Computer Engineering'),
(6, 'Electronics & Communication'),
(7, 'Bio-Technology'),
(8, 'Civil Engineering'),
(9, 'Applied Science & Humanities');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_master`
--

CREATE TABLE `faculty_master` (
  `f_id` int(255) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `phone_no` varchar(200) NOT NULL,
  `de_id` varchar(200) NOT NULL,
  `password` varchar(255) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty_master`
--

INSERT INTO `faculty_master` (`f_id`, `f_name`, `email_id`, `phone_no`, `de_id`, `password`, `datetime`) VALUES
(5, 'Jaykishan Sonagara', '23it390.jaykishan.sonagara@vvpedulink.ac.in', '07490899494', '4', 'f925916e2754e5e03f75dd58a5733251', '2025-03-02 13:23:05'),
(6, 'Navnit', 'ahirofgaming@gmail.com', '3695699094', '4', 'a3876fafbc8b9b9d3820b6e3a610e3d2', '2025-03-06 18:03:09');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_subject`
--

CREATE TABLE `faculty_subject` (
  `fs_id` int(11) NOT NULL,
  `f_id` int(11) DEFAULT NULL,
  `sem_id` int(11) DEFAULT NULL,
  `sub_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty_subject`
--

INSERT INTO `faculty_subject` (`fs_id`, `f_id`, `sem_id`, `sub_id`) VALUES
(15, 5, 4, 5),
(16, 5, 7, 8),
(17, 5, 6, 7),
(37, 6, 7, 8);

-- --------------------------------------------------------

--
-- Table structure for table `material_master`
--

CREATE TABLE `material_master` (
  `id` int(11) NOT NULL,
  `f_id` int(11) NOT NULL,
  `sem_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `de_id` int(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_size` float NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `material_master`
--

INSERT INTO `material_master` (`id`, `f_id`, `sem_id`, `sub_id`, `de_id`, `file_name`, `file_path`, `file_size`, `datetime`) VALUES
(10, 5, 7, 8, 4, 'Report Format', 'materials/68c8fdeed2d47.pdf', 2.19, '2025-09-16 08:04:30');

-- --------------------------------------------------------

--
-- Table structure for table `otp_master`
--

CREATE TABLE `otp_master` (
  `no` int(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `otp` int(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `otp_master`
--

INSERT INTO `otp_master` (`no`, `email_id`, `otp`, `status`) VALUES
(14, 'songarachandan4@gmail.com', 0, 'ACTIVE'),
(18, 'jaykishansonagara11@gmail.com', 0, 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `sem_master`
--

CREATE TABLE `sem_master` (
  `sem_id` int(255) NOT NULL,
  `sem_no` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sem_master`
--

INSERT INTO `sem_master` (`sem_id`, `sem_no`) VALUES
(1, 'Semester 1'),
(2, 'Semester 2'),
(3, 'Semester 3'),
(4, 'Semester 4'),
(5, 'Semester 5'),
(6, 'Semester 6'),
(7, 'Semester 7'),
(8, 'Semester 8');

-- --------------------------------------------------------

--
-- Table structure for table `student_master`
--

CREATE TABLE `student_master` (
  `u_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `e_no` varchar(255) DEFAULT NULL,
  `phone_no` varchar(20) NOT NULL,
  `de_id` varchar(255) NOT NULL,
  `sem_id` int(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_master`
--

INSERT INTO `student_master` (`u_id`, `name`, `email_id`, `e_no`, `phone_no`, `de_id`, `sem_id`, `password`, `datetime`) VALUES
(89, 'MR JAYKISHAN', 'songarajaykishan00@gmail.com', '230473116043', '7490899094', '1', 6, 'f925916e2754e5e03f75dd58a5733251', '2025-02-22 13:43:19'),
(92, 'jaykishan sonagara', 'jaykishansonagara11@gmail.com', '656252065322', '7490899094', '4', 6, 'f925916e2754e5e03f75dd58a5733251', '2025-07-04 06:54:29');

-- --------------------------------------------------------

--
-- Table structure for table `subject_master`
--

CREATE TABLE `subject_master` (
  `sub_id` int(11) NOT NULL,
  `sub_name` varchar(255) NOT NULL,
  `de_id` int(11) DEFAULT NULL,
  `sem_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject_master`
--

INSERT INTO `subject_master` (`sub_id`, `sub_name`, `de_id`, `sem_id`) VALUES
(1, 'Introduction to IT', 4, 1),
(2, 'Programming in C', 4, 1),
(3, 'Data Structures', 4, 2),
(4, 'Database Management', 4, 3),
(5, 'Operating Systems', 4, 4),
(6, 'Computer Networks', 4, 5),
(7, 'Web Technologies', 4, 6),
(8, 'Software Engineering', 4, 7),
(9, 'Machine Learning', 4, 8),
(10, 'Introduction to Computers', 5, 1),
(11, 'Programming in Python', 5, 1),
(12, 'Object-Oriented Programming', 5, 2),
(13, 'Database Systems', 5, 3),
(14, 'Algorithms', 5, 4),
(15, 'Computer Architecture', 5, 5),
(16, 'Artificial Intelligence', 5, 6),
(17, 'Cyber Security', 5, 7),
(18, 'Cloud Computing', 5, 8),
(19, 'Demo Subject', 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_master`
--
ALTER TABLE `admin_master`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`de_id`);

--
-- Indexes for table `faculty_master`
--
ALTER TABLE `faculty_master`
  ADD PRIMARY KEY (`f_id`,`email_id`);

--
-- Indexes for table `faculty_subject`
--
ALTER TABLE `faculty_subject`
  ADD PRIMARY KEY (`fs_id`),
  ADD KEY `f_id` (`f_id`),
  ADD KEY `sem_id` (`sem_id`),
  ADD KEY `sub_id` (`sub_id`);

--
-- Indexes for table `material_master`
--
ALTER TABLE `material_master`
  ADD PRIMARY KEY (`id`),
  ADD KEY `f_id` (`f_id`),
  ADD KEY `sem_id` (`sem_id`),
  ADD KEY `sub_id` (`sub_id`);

--
-- Indexes for table `otp_master`
--
ALTER TABLE `otp_master`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `sem_master`
--
ALTER TABLE `sem_master`
  ADD PRIMARY KEY (`sem_id`);

--
-- Indexes for table `student_master`
--
ALTER TABLE `student_master`
  ADD PRIMARY KEY (`u_id`),
  ADD UNIQUE KEY `email_id` (`email_id`),
  ADD UNIQUE KEY `u` (`e_no`(250));

--
-- Indexes for table `subject_master`
--
ALTER TABLE `subject_master`
  ADD PRIMARY KEY (`sub_id`),
  ADD KEY `de_id` (`de_id`),
  ADD KEY `sem_id` (`sem_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_master`
--
ALTER TABLE `admin_master`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `faculty_master`
--
ALTER TABLE `faculty_master`
  MODIFY `f_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `faculty_subject`
--
ALTER TABLE `faculty_subject`
  MODIFY `fs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `material_master`
--
ALTER TABLE `material_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `otp_master`
--
ALTER TABLE `otp_master`
  MODIFY `no` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `sem_master`
--
ALTER TABLE `sem_master`
  MODIFY `sem_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `student_master`
--
ALTER TABLE `student_master`
  MODIFY `u_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `subject_master`
--
ALTER TABLE `subject_master`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `faculty_subject`
--
ALTER TABLE `faculty_subject`
  ADD CONSTRAINT `faculty_subject_ibfk_1` FOREIGN KEY (`f_id`) REFERENCES `faculty_master` (`f_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `faculty_subject_ibfk_2` FOREIGN KEY (`sem_id`) REFERENCES `sem_master` (`sem_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `faculty_subject_ibfk_3` FOREIGN KEY (`sub_id`) REFERENCES `subject_master` (`sub_id`) ON DELETE CASCADE;

--
-- Constraints for table `material_master`
--
ALTER TABLE `material_master`
  ADD CONSTRAINT `material_master_ibfk_1` FOREIGN KEY (`f_id`) REFERENCES `faculty_master` (`f_id`),
  ADD CONSTRAINT `material_master_ibfk_2` FOREIGN KEY (`sem_id`) REFERENCES `sem_master` (`sem_id`),
  ADD CONSTRAINT `material_master_ibfk_3` FOREIGN KEY (`sub_id`) REFERENCES `subject_master` (`sub_id`);

--
-- Constraints for table `subject_master`
--
ALTER TABLE `subject_master`
  ADD CONSTRAINT `subject_master_ibfk_1` FOREIGN KEY (`de_id`) REFERENCES `department` (`de_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subject_master_ibfk_2` FOREIGN KEY (`sem_id`) REFERENCES `sem_master` (`sem_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
