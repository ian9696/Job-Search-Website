-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2020 at 03:22 PM
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
(2, 1);

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
(8, 'employer_6', '54c9c8710a2c6917f5130f160561d5b7f0e30979', '0213216666', 'employer_6-666@asd.c'),
(9, 'employer_7', 'a14a01a38dcadc8a73346bb0cb1ea7aa400b24aa', '0213777777', 'a12@a.a'),
(10, 'employer_8', 'a572f9ad7f43feffca19685c551005053b08ca25', '013013518', 'a88w@a.b');

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
(1, 1),
(2, 1);

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
(6, 'Taichung');

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
(4, 'Pianist');

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
(1, 8, 1, 1, 'Morning', 'Elementary School', 0, 111),
(3, 8, 4, 5, 'Night', 'High School', 1, 3);

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
(4, 'Catering');

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
(1, 'seeker_1', 'a69f7c9f22eaa6d57670839a909d6a9f92a155d7', 'Elementary School', 111, '0231111111', 'male', 11, 'a1a1@google.com'),
(2, 'seeker_2', '5c07313cd461e65dd40bf0b1573e9e3e54fbc341', 'Graduate School', 1222, '023122122', 'female', 22, 'k22@jkl.lkj'),
(3, 'seeker_3', '004402db1e82c0174d4d44791c5eae2dc5154087', 'UnderGraduate School', 333, '012333', 'female', 33, '32132j@k.k'),
(4, 'seeker_4', '80e85347c50d2d6d6011ec4da8c7795ce290a3ef', 'High School', 44, '013444', 'male', 44, '053g@k.k'),
(6, 'seeker_5', '565b12efbcd0ba488d5d999e17ca78a8c27d5546', 'Elementary School', 555, '0555', 'female', 55, '5@m.m');

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
(7, 6, 2),
(8, 6, 3),
(9, 6, 4),
(10, 3, 4),
(13, 3, 3);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `occupation`
--
ALTER TABLE `occupation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `recruit`
--
ALTER TABLE `recruit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `specialty`
--
ALTER TABLE `specialty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_specialty`
--
ALTER TABLE `user_specialty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
