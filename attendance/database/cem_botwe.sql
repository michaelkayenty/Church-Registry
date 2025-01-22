-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2024 at 06:22 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cem botwe`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `telephone`, `email`) VALUES
(5, 'admin1', '5f4dcc3b5aa765d61d8327deb882cf99', '555-0101', 'admin1@example.com'),
(6, 'admin2', 'password123', '555-0102', 'admin2@example.com'),
(7, 'admin3', 'password123', '555-0103', 'admin3@example.com'),
(8, 'admin4', 'password123', '555-0104', 'admin4@example.com'),
(9, 'admin5', 'password123', '555-0105', 'admin5@example.com'),
(10, 'admin6', 'password123', '555-0106', 'admin6@example.com'),
(11, 'admin7', 'password123', '555-0107', 'admin7@example.com'),
(12, 'admin8', 'password123', '555-0108', 'admin8@example.com'),
(13, 'admin9', 'password123', '555-0109', 'admin9@example.com'),
(14, 'admin10', 'password123', '555-0110', 'admin10@example.com');

-- --------------------------------------------------------

--
-- Table structure for table `attendace`
--

CREATE TABLE `attendace` (
  `id` int(11) NOT NULL,
  `is_present` tinyint(1) DEFAULT NULL,
  `zone_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendace`
--

INSERT INTO `attendace` (`id`, `is_present`, `zone_id`, `member_id`, `title`, `reason`, `created_at`) VALUES
(10, 1, 5, 1124, 'Sunday Service', '', '2024-08-11 18:09:24'),
(11, 1, 5, 1134, 'Sunday Service', '', '2024-08-11 18:09:24'),
(12, 1, 5, 1144, 'Sunday Service', '', '2024-08-11 18:09:24'),
(13, 1, 5, 1154, 'Sunday Service', '', '2024-08-11 18:09:24'),
(14, 1, 5, 1164, 'Sunday Service', '', '2024-08-11 18:09:24'),
(15, 0, 5, 1174, 'Sunday Service', 'sick', '2024-08-11 18:09:24'),
(16, 0, 5, 1184, 'Sunday Service', 'travelled', '2024-08-11 18:09:24'),
(17, 1, 6, 1125, 'Midweek Service', '', '2024-08-11 18:10:36'),
(18, 1, 6, 1135, 'Midweek Service', '', '2024-08-11 18:10:36'),
(19, 1, 6, 1145, 'Midweek Service', '', '2024-08-11 18:10:36'),
(20, 0, 6, 1155, 'Midweek Service', 'Unable to reach', '2024-08-11 18:10:36'),
(21, 0, 6, 1165, 'Midweek Service', 'Unable to reach', '2024-08-11 18:10:36'),
(22, 1, 6, 1175, 'Midweek Service', '', '2024-08-11 18:10:36'),
(23, 1, 6, 1185, 'Midweek Service', '', '2024-08-11 18:10:36'),
(24, 1, 7, 1126, 'Midweek Service', '', '2024-08-11 20:00:07'),
(25, 1, 7, 1136, 'Midweek Service', '', '2024-08-11 20:00:08'),
(26, 0, 7, 1146, 'Midweek Service', 'injured', '2024-08-11 20:00:08'),
(27, 0, 7, 1156, 'Midweek Service', 'injured', '2024-08-11 20:00:08'),
(28, 1, 7, 1166, 'Midweek Service', '', '2024-08-11 20:00:08'),
(29, 1, 7, 1176, 'Midweek Service', '', '2024-08-11 20:00:08'),
(30, 1, 7, 1186, 'Midweek Service', '', '2024-08-11 20:00:08'),
(31, 1, 11, 1130, 'Sunday Service', '', '2024-08-12 09:49:22'),
(32, 1, 11, 1140, 'Sunday Service', '', '2024-08-12 09:49:22'),
(33, 1, 11, 1150, 'Sunday Service', '', '2024-08-12 09:49:22'),
(34, 1, 11, 1160, 'Sunday Service', '', '2024-08-12 09:49:22'),
(35, 1, 11, 1170, 'Sunday Service', '', '2024-08-12 09:49:22'),
(36, 0, 11, 1180, 'Sunday Service', 'sick', '2024-08-12 09:49:23'),
(37, 0, 11, 1190, 'Sunday Service', 'sick', '2024-08-12 09:49:23'),
(38, 0, 11, 1193, 'Sunday Service', 'not feel well', '2024-08-12 09:49:23'),
(39, 0, 12, 1131, 'Sunday Service', '', '2024-08-12 10:12:10'),
(40, 0, 12, 1141, 'Sunday Service', '', '2024-08-12 10:12:10'),
(41, 0, 12, 1151, 'Sunday Service', '', '2024-08-12 10:12:10'),
(42, 0, 12, 1161, 'Sunday Service', '', '2024-08-12 10:12:10'),
(43, 0, 12, 1171, 'Sunday Service', '', '2024-08-12 10:12:11'),
(44, 0, 12, 1181, 'Sunday Service', 'testing reason', '2024-08-12 10:12:11'),
(45, 0, 12, 1191, 'Sunday Service', 'Financial Issue', '2024-08-12 10:12:11');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `zone_id` int(11) NOT NULL,
  `residence` varchar(255) NOT NULL,
  `DoB` date NOT NULL,
  `marital_status` varchar(255) NOT NULL,
  `ocupation` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `name`, `gender`, `zone_id`, `residence`, `DoB`, `marital_status`, `ocupation`, `telephone`) VALUES
(1124, 'John Doe', 'Male', 5, '123 Elm St', '1980-01-01', 'Single', 'Engineer', '555-0001'),
(1125, 'Jane Smith', 'Female', 6, '456 Oak St', '1990-02-14', 'Married', 'Doctor', '555-0002'),
(1126, 'Robert Johnson', 'Male', 7, '789 Pine St', '1985-03-23', 'Single', 'Teacher', '555-0003'),
(1127, 'Emily Davis', 'Female', 8, '101 Maple St', '1978-04-12', 'Married', 'Nurse', '555-0004'),
(1128, 'Michael Brown', 'Male', 9, '202 Birch St', '1992-05-05', 'Single', 'Artist', '555-0005'),
(1129, 'Sarah Wilson', 'Female', 10, '303 Cedar St', '1983-06-15', 'Married', 'Scientist', '555-0006'),
(1130, 'David Lee', 'Male', 11, '404 Elm St', '1987-07-20', 'Single', 'Chef', '555-0007'),
(1131, 'Laura Martinez', 'Female', 12, '505 Oak St', '1991-08-30', 'Married', 'Pharmacist', '555-0008'),
(1132, 'James Anderson', 'Male', 13, '606 Pine St', '1984-09-25', 'Single', 'Engineer', '555-0009'),
(1133, 'Olivia Taylor', 'Female', 14, '707 Maple St', '1995-10-14', 'Married', 'Dentist', '555-0010'),
(1134, 'William Thompson', 'Male', 5, '808 Birch St', '1982-11-02', 'Single', 'Developer', '555-0011'),
(1135, 'Sophia White', 'Female', 6, '909 Cedar St', '1993-12-21', 'Married', 'Veterinarian', '555-0012'),
(1136, 'Daniel Harris', 'Male', 7, '1011 Elm St', '1986-01-30', 'Single', 'Architect', '555-0013'),
(1137, 'Ava Clark', 'Female', 8, '1213 Oak St', '1994-02-28', 'Married', 'Journalist', '555-0014'),
(1138, 'Ethan Lewis', 'Male', 9, '1415 Pine St', '1981-03-19', 'Single', 'Musician', '555-0015'),
(1139, 'Mia Walker', 'Female', 10, '1617 Maple St', '1989-04-12', 'Married', 'Graphic Designer', '555-0016'),
(1140, 'Alexander Allen', 'Male', 11, '1819 Birch St', '1980-05-23', 'Single', 'Electrician', '555-0017'),
(1141, 'Isabella King', 'Female', 12, '2021 Cedar St', '1992-06-17', 'Married', 'Interior Designer', '555-0018'),
(1142, 'Benjamin Scott', 'Male', 13, '2223 Elm St', '1987-07-24', 'Single', 'Photographer', '555-0019'),
(1143, 'Charlotte Baker', 'Female', 14, '2425 Oak St', '1990-08-16', 'Married', 'Counselor', '555-0020'),
(1144, 'James Wright', 'Male', 5, '2627 Pine St', '1983-09-04', 'Single', 'Plumber', '555-0021'),
(1145, 'Amelia Lopez', 'Female', 6, '2829 Maple St', '1994-10-30', 'Married', 'Marketing Manager', '555-0022'),
(1146, 'Matthew Young', 'Male', 7, '3031 Birch St', '1985-11-15', 'Single', 'Carpenter', '555-0023'),
(1147, 'Harper Hill', 'Female', 8, '3233 Cedar St', '1988-12-09', 'Married', 'Software Developer', '555-0024'),
(1148, 'Liam Adams', 'Male', 9, '3435 Elm St', '1991-01-22', 'Single', 'Business Analyst', '555-0025'),
(1149, 'Evelyn Nelson', 'Female', 10, '3637 Oak St', '1982-02-12', 'Married', 'Public Relations', '555-0026'),
(1150, 'Noah Carter', 'Male', 11, '3839 Pine St', '1984-03-23', 'Single', 'Pilot', '555-0027'),
(1151, 'Lily Mitchell', 'Female', 12, '4041 Maple St', '1990-04-15', 'Married', 'Event Planner', '555-0028'),
(1152, 'Lucas Perez', 'Male', 13, '4243 Birch St', '1986-05-06', 'Single', 'Financial Advisor', '555-0029'),
(1153, 'Ella Roberts', 'Female', 14, '4445 Cedar St', '1992-06-30', 'Married', 'Therapist', '555-0030'),
(1154, 'Mason Turner', 'Male', 5, '4647 Elm St', '1981-07-21', 'Single', 'Marketing Specialist', '555-0031'),
(1155, 'Grace Campbell', 'Female', 6, '4849 Oak St', '1989-08-15', 'Married', 'Legal Assistant', '555-0032'),
(1156, 'Aiden Parker', 'Male', 7, '5051 Pine St', '1995-09-10', 'Single', 'Web Developer', '555-0033'),
(1157, 'Zoe Collins', 'Female', 8, '5253 Maple St', '1987-10-25', 'Married', 'Photographer', '555-0034'),
(1158, 'Jack Morris', 'Male', 9, '5455 Birch St', '1991-11-11', 'Single', 'Civil Engineer', '555-0035'),
(1159, 'Chloe Murphy', 'Female', 10, '5657 Cedar St', '1994-12-02', 'Married', 'Nurse Practitioner', '555-0036'),
(1160, 'Logan Rivera', 'Male', 11, '5859 Elm St', '1983-01-08', 'Single', 'Mechanic', '555-0037'),
(1161, 'Megan Bell', 'Female', 12, '6061 Oak St', '1988-02-20', 'Married', 'Teacher', '555-0038'),
(1162, 'Elijah Cox', 'Male', 13, '6263 Pine St', '1990-03-12', 'Single', 'Architect', '555-0039'),
(1163, 'Natalie Howard', 'Female', 14, '6465 Maple St', '1982-04-18', 'Married', 'Social Worker', '555-0040'),
(1164, 'Henry Ward', 'Male', 5, '6667 Birch St', '1987-05-25', 'Single', 'Chef', '555-0041'),
(1165, 'Hannah Rivera', 'Female', 6, '6869 Cedar St', '1993-06-10', 'Married', 'Graphic Designer', '555-0042'),
(1166, 'Owen Ramirez', 'Male', 7, '7071 Elm St', '1981-07-30', 'Single', 'Veterinarian', '555-0043'),
(1167, 'Mia Evans', 'Female', 8, '7273 Oak St', '1985-08-14', 'Married', 'Interior Designer', '555-0044'),
(1168, 'Sebastian Hughes', 'Male', 9, '7475 Pine St', '1994-09-22', 'Single', 'Public Relations', '555-0045'),
(1169, 'Aria Peterson', 'Female', 10, '7677 Maple St', '1982-10-16', 'Married', 'Data Analyst', '555-0046'),
(1170, 'James Allen', 'Male', 11, '7879 Birch St', '1986-11-20', 'Single', 'Photographer', '555-0047'),
(1171, 'Avery Murphy', 'Female', 12, '8081 Cedar St', '1991-12-05', 'Married', 'Social Media Manager', '555-0048'),
(1172, 'Wyatt Martinez', 'Male', 13, '8283 Elm St', '1983-01-16', 'Single', 'Software Engineer', '555-0049'),
(1173, 'Charlotte Young', 'Female', 14, '8485 Oak St', '1987-02-28', 'Married', 'HR Specialist', '555-0050'),
(1174, 'Jack Williams', 'Male', 5, '8687 Pine St', '1990-03-18', 'Single', 'Electrician', '555-0051'),
(1175, 'Ella Brown', 'Female', 6, '8889 Maple St', '1985-04-22', 'Married', 'Teacher', '555-0052'),
(1176, 'Benjamin Moore', 'Male', 7, '9091 Birch St', '1988-05-14', 'Single', 'Architect', '555-0053'),
(1177, 'Sofia Jones', 'Female', 8, '9293 Cedar St', '1993-06-10', 'Married', 'Event Planner', '555-0054'),
(1178, 'Lucas Wilson', 'Male', 9, '9495 Elm St', '1982-07-19', 'Single', 'Accountant', '555-0055'),
(1179, 'Lily Davis', 'Female', 10, '9697 Oak St', '1994-08-26', 'Married', 'Software Developer', '555-0056'),
(1180, 'Mason Taylor', 'Male', 11, '9899 Pine St', '1989-09-13', 'Single', 'Business Analyst', '555-0057'),
(1181, 'Emily Anderson', 'Female', 12, '10101 Maple St', '1990-10-21', 'Married', 'Designer', '555-0058'),
(1182, 'Daniel Wilson', 'Male', 13, '10303 Birch St', '1985-11-15', 'Single', 'Chef', '555-0059'),
(1183, 'Olivia Johnson', 'Female', 14, '10505 Cedar St', '1982-12-03', 'Married', 'Veterinarian', '555-0060'),
(1184, 'Matthew Lewis', 'Male', 5, '10707 Elm St', '1984-01-09', 'Single', 'Mechanic', '555-0061'),
(1185, 'Sophia Harris', 'Female', 6, '10909 Oak St', '1991-02-18', 'Married', 'Marketing Manager', '555-0062'),
(1186, 'Aiden Lee', 'Male', 7, '11111 Pine St', '1987-03-25', 'Single', 'Graphic Designer', '555-0063'),
(1187, 'Isabella King', 'Female', 8, '11313 Maple St', '1990-04-30', 'Married', 'Pharmacist', '555-0064'),
(1188, 'Jackson Scott', 'Male', 9, '11515 Birch St', '1984-05-20', 'Single', 'Public Relations', '555-0065'),
(1189, 'Mia Walker', 'Female', 10, '11717 Cedar St', '1995-06-11', 'Married', 'Accountant', '555-0066'),
(1190, 'Ethan Adams', 'Male', 11, '11919 Elm St', '1982-07-14', 'Single', 'Photographer', '555-0067'),
(1191, 'Ava Turner', 'Female', 12, '12121 Oak St', '1986-08-29', 'Married', 'HR Specialist', '555-0068'),
(1192, 'Benjamin Wright', 'Male', 13, '12323 Pine St', '1994-09-22', 'Single', 'Data Scientist', '555-0069'),
(1193, 'Zoe Carter', 'Female', 11, '12525 Maple St', '1985-10-17', 'Married', 'Social Media Manager', '555-0070');

-- --------------------------------------------------------

--
-- Table structure for table `zone`
--

CREATE TABLE `zone` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `admi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `zone`
--

INSERT INTO `zone` (`id`, `name`, `location`, `admi_id`) VALUES
(5, 'Zone 1', 'Location A', 5),
(6, 'Zone 2', 'Location B', 6),
(7, 'Zone 3', 'Location C', 7),
(8, 'Zone 4', 'Location D', 8),
(9, 'Zone 5', 'Location E', 9),
(10, 'Zone 6', 'Location F', 10),
(11, 'Zone 7', 'Location G', 11),
(12, 'Zone 8', 'Location H', 12),
(13, 'Zone 9', 'Location I', 13),
(14, 'Zone 10', 'Location J', 14);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendace`
--
ALTER TABLE `attendace`
  ADD PRIMARY KEY (`id`),
  ADD KEY `zone_id` (`zone_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `zone_id` (`zone_id`);

--
-- Indexes for table `zone`
--
ALTER TABLE `zone`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admi_id` (`admi_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `attendace`
--
ALTER TABLE `attendace`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1194;

--
-- AUTO_INCREMENT for table `zone`
--
ALTER TABLE `zone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendace`
--
ALTER TABLE `attendace`
  ADD CONSTRAINT `attendace_ibfk_1` FOREIGN KEY (`zone_id`) REFERENCES `zone` (`id`),
  ADD CONSTRAINT `attendace_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`);

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `members_ibfk_1` FOREIGN KEY (`zone_id`) REFERENCES `zone` (`id`);

--
-- Constraints for table `zone`
--
ALTER TABLE `zone`
  ADD CONSTRAINT `zone_ibfk_1` FOREIGN KEY (`admi_id`) REFERENCES `admin` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
