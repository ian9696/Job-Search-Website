-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2020 at 11:05 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cwliu123_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `user_id` int(11) NOT NULL,
  `recruit_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`user_id`, `recruit_id`) VALUES
(7, 7),
(7, 11),
(8, 13),
(8, 11),
(9, 9),
(9, 10),
(10, 5),
(10, 14),
(11, 14),
(11, 13),
(11, 8),
(12, 12),
(12, 6),
(12, 8);

-- --------------------------------------------------------

--
-- Table structure for table `employer`
--

CREATE TABLE `employer` (
  `id` int(11) NOT NULL,
  `account` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  `phone` varchar(32) NOT NULL,
  `mail` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employer`
--

INSERT INTO `employer` (`id`, `account`, `password`, `phone`, `mail`) VALUES
(11, 'employer_1', '2ff5a08f5cb822e10281d513e9a15cd306c3a9b6', '0909202244', 'tseng7@mar.co.jp'),
(12, 'employer_2', '35d1f48a4bb93c8628dff2c6ff7edd83c90bb15f', '228807708', 'service@airspaceonline.com'),
(13, 'employer_3', '2f0f5fb52bffa458c0d6ad542761e34f9abfb3cf', '33169408', 'rssh@webmail.rssh.com.tw'),
(14, 'employer_4', '3a5ac36d6fbe36e9ff923e4260ec13a6cb85388a', '02958837', 'fastsupport@narlabs.org.tw'),
(15, 'employer_5', 'fe56517d2aaace4b869647a3cc8c0b4571ab7180', '0948288747', 'info@sennheiser.com');

-- --------------------------------------------------------

--
-- Table structure for table `favorite`
--

CREATE TABLE `favorite` (
  `user_id` int(11) NOT NULL,
  `recruit_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `favorite`
--

INSERT INTO `favorite` (`user_id`, `recruit_id`) VALUES
(7, 7),
(7, 15),
(7, 11),
(7, 12),
(8, 11),
(8, 13),
(9, 9),
(9, 10),
(9, 14),
(9, 6),
(10, 5),
(10, 14),
(10, 12),
(10, 8),
(11, 6),
(11, 8),
(11, 11),
(11, 13),
(11, 14),
(12, 6),
(12, 8),
(12, 11),
(12, 12),
(12, 13),
(12, 14);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `location` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `location`) VALUES
(1, 'Taipei'),
(4, 'Tainan'),
(5, 'Hsinchu'),
(6, 'Taichung'),
(8, 'Scotland, United Kingdom'),
(9, 'New York, United States'),
(10, 'Mumbai, Maharashtra, India'),
(11, 'Bengaluru, Karnataka, India');

-- --------------------------------------------------------

--
-- Table structure for table `occupation`
--

CREATE TABLE `occupation` (
  `id` int(11) NOT NULL,
  `occupation` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `occupation`
--

INSERT INTO `occupation` (`id`, `occupation`) VALUES
(1, 'Doctor'),
(2, 'Reporter'),
(3, 'Teacher'),
(4, 'Pianist'),
(5, 'Business Analyst'),
(6, 'Machine Learning Analyst'),
(7, 'Data Analyst'),
(8, 'Digital Marketing Specialist'),
(9, 'Business Development Manager'),
(10, 'Marketing Specialist'),
(12, 'Banquets Admin Assistant');

-- --------------------------------------------------------

--
-- Table structure for table `recruit`
--

CREATE TABLE `recruit` (
  `id` int(11) NOT NULL,
  `employer_id` int(11) NOT NULL,
  `occupation_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `working_time` varchar(32) NOT NULL,
  `education` varchar(32) NOT NULL,
  `experience` int(11) NOT NULL,
  `salary` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recruit`
--

INSERT INTO `recruit` (`id`, `employer_id`, `occupation_id`, `location_id`, `working_time`, `education`, `experience`, `salary`) VALUES
(4, 11, 1, 1, 'Morning', 'Elementary School', 0, 40000),
(5, 11, 2, 4, 'Afternoon', 'High School', 1, 45000),
(6, 11, 3, 5, 'Night', 'UnderGraduate School', 2, 46000),
(7, 11, 4, 6, 'Afternoon', 'Graduate School', 3, 52000),
(8, 12, 5, 8, 'Afternoon', 'UnderGraduate School', 1, 35500),
(9, 12, 6, 9, 'Night', 'Graduate School', 1, 37000),
(10, 13, 7, 10, 'Morning', 'Graduate School', 2, 54500),
(11, 13, 8, 11, 'Afternoon', 'High School', 0, 45000),
(12, 14, 5, 10, 'Afternoon', 'UnderGraduate School', 1, 35800),
(13, 14, 8, 10, 'Night', 'UnderGraduate School', 3, 39900),
(14, 15, 3, 6, 'Morning', 'Elementary School', 2, 45000),
(15, 15, 4, 5, 'Night', 'High School', 3, 65000);

-- --------------------------------------------------------

--
-- Table structure for table `specialty`
--

CREATE TABLE `specialty` (
  `id` int(11) NOT NULL,
  `specialty` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `specialty`
--

INSERT INTO `specialty` (`id`, `specialty`) VALUES
(1, 'Beauty'),
(2, 'Accounting'),
(3, 'Design'),
(4, 'Catering'),
(5, 'Banking'),
(6, 'SQL'),
(7, 'R'),
(8, 'Python '),
(9, 'Marketing'),
(10, 'Advertising'),
(11, 'Sales'),
(12, 'Training');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `account` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  `education` varchar(32) NOT NULL,
  `expected_salary` int(11) NOT NULL,
  `phone` varchar(32) NOT NULL,
  `gender` varchar(32) NOT NULL,
  `age` int(11) NOT NULL,
  `email` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `account`, `password`, `education`, `expected_salary`, `phone`, `gender`, `age`, `email`) VALUES
(7, 'Mary', '94f85995c7492eec546c321821aa4beca9a3e2b1', 'UnderGraduate School', 35000, '0928316515', 'female', 23, 'Mary350@gmail.com'),
(8, 'York', 'c12d8fabe69074b9b1226488182f8b7fa6c98430', 'High School', 31000, '0938948132', 'male', 19, 'AdcYork4@yahoo.com'),
(9, 'Stanley', 'a305f56d078b2fa686d82aefeafa895e2cc87558', 'Graduate School', 42000, '0288792135', 'male', 26, 'Poiaeley@kimo.com'),
(10, 'Morgan', '8e4408b475d63385a73aed2fe911dd9818e82fb5', 'Elementary School', 24000, '0932662332', 'male', 18, 'MorganAoi@gmail.com'),
(11, 'Gina', 'c3de4113912d29cffcf03250c113235163e31c2e', 'Graduate School', 55000, '0987789875', 'female', 35, 'Gina35a@yahoo.com.tw'),
(12, 'Vocaturo', '6e4f36e3bfdadfa71998d9235257e360c0199ca9', 'UnderGraduate School', 36500, '0326663262', 'male', 21, 'VocaturoDayo@msn.com');

-- --------------------------------------------------------

--
-- Table structure for table `user_specialty`
--

CREATE TABLE `user_specialty` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `specialty_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_specialty`
--

INSERT INTO `user_specialty` (`id`, `user_id`, `specialty_id`) VALUES
(14, 7, 1),
(15, 7, 4),
(16, 8, 4),
(17, 8, 11),
(18, 9, 6),
(19, 9, 7),
(20, 9, 8),
(21, 10, 11),
(22, 11, 2),
(23, 11, 5),
(24, 11, 9),
(25, 11, 10),
(26, 11, 12),
(27, 12, 9),
(28, 12, 10),
(29, 12, 11),
(30, 12, 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD KEY `application_fk_user_id` (`user_id`),
  ADD KEY `application_fk_recruit_id` (`recruit_id`);

--
-- Indexes for table `employer`
--
ALTER TABLE `employer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorite`
--
ALTER TABLE `favorite`
  ADD KEY `favorite_fk_user_id` (`user_id`),
  ADD KEY `favorite_fk_recruit_id` (`recruit_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `occupation`
--
ALTER TABLE `occupation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recruit`
--
ALTER TABLE `recruit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_employer_id` (`employer_id`),
  ADD KEY `fk_occupation_id` (`occupation_id`),
  ADD KEY `fk_location_id` (`location_id`);

--
-- Indexes for table `specialty`
--
ALTER TABLE `specialty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_specialty`
--
ALTER TABLE `user_specialty`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`),
  ADD KEY `fk_specialty_id` (`specialty_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employer`
--
ALTER TABLE `employer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `occupation`
--
ALTER TABLE `occupation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `recruit`
--
ALTER TABLE `recruit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `specialty`
--
ALTER TABLE `specialty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_specialty`
--
ALTER TABLE `user_specialty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `application`
--
ALTER TABLE `application`
  ADD CONSTRAINT `application_fk_recruit_id` FOREIGN KEY (`recruit_id`) REFERENCES `recruit` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `application_fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `favorite`
--
ALTER TABLE `favorite`
  ADD CONSTRAINT `favorite_fk_recruit_id` FOREIGN KEY (`recruit_id`) REFERENCES `recruit` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favorite_fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `recruit`
--
ALTER TABLE `recruit`
  ADD CONSTRAINT `fk_employer_id` FOREIGN KEY (`employer_id`) REFERENCES `employer` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_location_id` FOREIGN KEY (`location_id`) REFERENCES `location` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_occupation_id` FOREIGN KEY (`occupation_id`) REFERENCES `occupation` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_specialty`
--
ALTER TABLE `user_specialty`
  ADD CONSTRAINT `fk_specialty_id` FOREIGN KEY (`specialty_id`) REFERENCES `specialty` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
