-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2020 at 12:46 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `maria_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_ID` int(11) NOT NULL,
  `department_name` varchar(150) DEFAULT NULL,
  `department_short_name` varchar(100) NOT NULL,
  `department_HOD_name` varchar(150) NOT NULL,
  `description` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_ID`, `department_name`, `department_short_name`, `department_HOD_name`, `description`) VALUES
(6, 'Human Resource', 'HR', 'John Ndiva', 'ni mfano tu'),
(7, 'Information Technology', 'IT', 'Aloyce Mbena', ''),
(8, 'Finance', 'FN', 'Neema Nickson', ''),
(9, 'Finance', 'FN', 'Neema Nickson', ''),
(10, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `dependant`
--

CREATE TABLE `dependant` (
  `dependant_ID` int(3) NOT NULL,
  `dependant_age` int(2) NOT NULL,
  `dependant_role` varchar(45) NOT NULL,
  `employee_ID` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_ID` varchar(100) NOT NULL,
  `employee_fname` varchar(150) NOT NULL,
  `employee_lname` varchar(150) NOT NULL,
  `date_of_birth` date NOT NULL,
  `phone_number` int(10) NOT NULL,
  `email` varchar(200) NOT NULL,
  `address` varchar(255) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `city` varchar(200) NOT NULL,
  `country` varchar(150) NOT NULL,
  `marital_status` varchar(150) NOT NULL,
  `file` varchar(300) NOT NULL,
  `department_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_ID`, `employee_fname`, `employee_lname`, `date_of_birth`, `phone_number`, `email`, `address`, `gender`, `city`, `country`, `marital_status`, `file`, `department_ID`) VALUES
('123', 'Antony', 'Kichupi', '2020-07-11', 2587455, 'thomas1@gmail.com', 'Morogoro', 'Female', 'Moro', 'Tanzania', 'Married', 'me.jpg', 6),
('1234', 'juma', 'kaparatu', '2020-07-11', 88566, 'thomas2@gmail.com', 'Morogoro', 'Male', 'Moro', 'Tanzania', 'Single', 'heart.png', 6),
('1235', 'andrea', 'mandela', '2020-07-16', 784650242, 'thomas4@gmail.com', 'Morogoro', 'Male', 'Moro', 'Tanzania', 'Married', 'circut.jpg', 6),
('1237', 'andrea', 'mandela', '2020-07-17', 784654778, 'thomas5@gmail.com', 'Morogoro', 'Male', 'Moro', 'Tanzania', 'Single', '', 7),
('3', 'Salum', 'Kambaya', '0000-00-00', 657460201, 'kambaya@gmail.com', 'Mwanza', 'Male', 'Mwanza', 'Tanzania', '', 'me.jpg', 7),
('EM001', 'Anna', 'Mchiro', '1999-02-02', 1334588, 'mchiro@gmail.com', 'Morogoro', 'Female', 'Moro', 'Tanzania', 'Single', '', 6),
('EM2', 'salum', 'omary', '1994-03-26', 7855115, 'omary@gmail.com', 'mwanza', 'Male', 'ilemera', 'Tanzania', 'Single', 'circut.jpg', 7);

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `leave_ID` int(11) NOT NULL,
  `leave_from` date NOT NULL,
  `leave_to` date NOT NULL,
  `from_place` varchar(200) NOT NULL,
  `to_place` varchar(200) NOT NULL,
  `leave_description` varchar(500) NOT NULL,
  `leave_status` varchar(100) NOT NULL DEFAULT 'Pending',
  `date_of_application` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `remark` mediumtext NOT NULL,
  `remark_date` timestamp NULL DEFAULT NULL,
  `isRead` int(11) NOT NULL,
  `type_ID` int(11) NOT NULL,
  `employee_ID` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`leave_ID`, `leave_from`, `leave_to`, `from_place`, `to_place`, `leave_description`, `leave_status`, `date_of_application`, `remark`, `remark_date`, `isRead`, `type_ID`, `employee_ID`) VALUES
(16, '2020-07-07', '2020-07-10', 'dar', 'mwanza', 'test', 'Not Approved', '2020-07-11 02:33:47', 'Unazingua Kijana', '2020-07-11 02:33:47', 1, 3, '3'),
(17, '2020-07-09', '2020-07-11', 'dar', 'mwanza', 'test', 'Approved', '2020-07-11 02:35:59', 'Iko fresh sana nakubali', '2020-07-11 02:35:59', 1, 4, '3'),
(18, '2020-07-10', '2020-07-30', 'dar', 'mwanza', '', 'Approved', '2020-07-11 22:22:03', 'Your Application is Valid', '2020-07-11 22:22:03', 1, 1, '3'),
(19, '2020-07-10', '2020-07-17', 'dar', 'mwanza', '', 'Pending', '2020-07-10 20:56:06', '', '0000-00-00 00:00:00', 0, 3, '3'),
(20, '2020-07-12', '2020-07-14', 'dar', 'mwanza', '', 'Approved', '2020-07-10 23:33:08', '', '0000-00-00 00:00:00', 0, 2, '3'),
(21, '2020-07-11', '2020-07-12', 'kigom', 'mtwara', '', 'Pending', '2020-07-10 22:19:43', '', '0000-00-00 00:00:00', 0, 4, '3'),
(22, '2020-07-11', '2020-07-30', 'kigom', 'mwanza', 'Naomba likizo ya kikazi', 'Pending', '2020-07-10 22:34:39', '', '0000-00-00 00:00:00', 0, 3, '3');

-- --------------------------------------------------------

--
-- Table structure for table `leave_history`
--

CREATE TABLE `leave_history` (
  `leave_history` int(4) NOT NULL,
  `last_leave_date` date NOT NULL,
  `leave_remained_days` varchar(100) NOT NULL,
  `employee_ID` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leave_history`
--

INSERT INTO `leave_history` (`leave_history`, `last_leave_date`, `leave_remained_days`, `employee_ID`) VALUES
(1, '2020-07-09', '28', '3'),
(2, '2020-07-11', '26', '3'),
(3, '2020-07-30', '8', '3'),
(4, '2020-07-17', '21', '3'),
(5, '2020-07-14', '26', '3'),
(6, '2020-07-30', '9', '3');

-- --------------------------------------------------------

--
-- Table structure for table `leave_type`
--

CREATE TABLE `leave_type` (
  `type_ID` int(11) NOT NULL,
  `type_name` varchar(200) DEFAULT NULL,
  `type_category` mediumtext,
  `description` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leave_type`
--

INSERT INTO `leave_type` (`type_ID`, `type_name`, `type_category`, `description`) VALUES
(1, 'Annual', 'Important Leave', ''),
(2, 'Sick Leave', 'Important', ''),
(3, 'Martenity / Perrnity Leave', 'Important', ''),
(4, 'Medical Leave', 'Important', '');

-- --------------------------------------------------------

--
-- Table structure for table `transport`
--

CREATE TABLE `transport` (
  `transport_ID` int(5) NOT NULL,
  `transport_cost` varchar(100) NOT NULL,
  `transport_type` varchar(100) NOT NULL,
  `date_of_application` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transport`
--

INSERT INTO `transport` (`transport_ID`, `transport_cost`, `transport_type`, `date_of_application`) VALUES
(13, '135000', 'Public', '2020-07-11 02:33:47'),
(14, '90000', 'Public', '2020-07-11 02:35:59'),
(15, '540000', 'Public', '2020-07-11 22:22:03'),
(16, '200000', 'Public', '2020-07-10 20:56:06'),
(17, '900000', 'Public', '2020-07-10 23:33:08'),
(19, '600000', 'Public', '2020-07-10 22:34:39');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_ID` int(5) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(100) NOT NULL,
  `work_place` varchar(150) NOT NULL,
  `position` varchar(45) NOT NULL,
  `role` varchar(45) NOT NULL,
  `status` varchar(100) DEFAULT 'Active',
  `employee_ID` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_ID`, `username`, `password`, `work_place`, `position`, `role`, `status`, `employee_ID`) VALUES
(2, 'kambaya', '$2y$10$Ba2j7uVUSDzDJfLJmnYRrekQ7UqFYW7bEGW.3vQW4BnhPcmUaAVxm', '', '', 'admin', 'Active', '3'),
(20, 'omary@gmail.com', '$2y$10$R8NINHDqoUWDeECGjGwtzOMpGWyOR5Kbg.WdX0BIJMVCKn0LSwuYW', 'Mwanza Ilemera', 'IT specialist', 'User', 'Active', 'EM2'),
(21, 'mchiro@gmail.com', '$2y$10$bsMLD89llIm/qnZrXrkY1uKfrYYVk5aBsvVudsbwqsn.WNmnTv7jK', 'Morogoro', 'service', 'User', 'Active', 'EM001'),
(22, 'thomas1@gmail.com', '$2y$10$scJHTjBq2llJ9mfTNLcqJu8m2pBQvZpUljsGX5UbTPT7XiUZRN.LO', 'Morogoro', 'service', 'User', 'Active', '123'),
(23, 'thomas2@gmail.com', '$2y$10$mADPmYLfb2ulQoPIv35N0.TrDURRz7OsO/SLJRadoLm/uElf8rQMS', 'Morogoro', 'service', 'User', 'Active', '1234'),
(24, 'thomas4@gmail.com', '$2y$10$5Ms2KnepEGbmfULdXaxZkugGnv9RYlzNmTtVJDAjv0ZnBn16oagHu', 'Morogoro', 'service', 'User', 'Active', '1235'),
(25, 'thomas5@gmail.com', '$2y$10$NVzm8oUpbrhThzA5TcDog.RVdRyhw40pG9UYxqLE6j8fn7F2qHOV2', 'Morogoro', 'service', 'User', 'Active', '1237');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_ID`);

--
-- Indexes for table `dependant`
--
ALTER TABLE `dependant`
  ADD KEY `employee_ID` (`employee_ID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_ID`),
  ADD KEY `department_ID` (`department_ID`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`leave_ID`),
  ADD KEY `type_ID` (`type_ID`),
  ADD KEY `date_of_application` (`date_of_application`),
  ADD KEY `employee_ID` (`employee_ID`);

--
-- Indexes for table `leave_history`
--
ALTER TABLE `leave_history`
  ADD PRIMARY KEY (`leave_history`),
  ADD KEY `employee_ID` (`employee_ID`);

--
-- Indexes for table `leave_type`
--
ALTER TABLE `leave_type`
  ADD PRIMARY KEY (`type_ID`);

--
-- Indexes for table `transport`
--
ALTER TABLE `transport`
  ADD PRIMARY KEY (`transport_ID`),
  ADD KEY `applied_Date` (`date_of_application`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_ID`),
  ADD KEY `employee_ID` (`employee_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `leave_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `leave_history`
--
ALTER TABLE `leave_history`
  MODIFY `leave_history` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `leave_type`
--
ALTER TABLE `leave_type`
  MODIFY `type_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transport`
--
ALTER TABLE `transport`
  MODIFY `transport_ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dependant`
--
ALTER TABLE `dependant`
  ADD CONSTRAINT `dependant_ibfk_1` FOREIGN KEY (`employee_ID`) REFERENCES `employee` (`employee_ID`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`department_ID`) REFERENCES `department` (`department_ID`);

--
-- Constraints for table `leaves`
--
ALTER TABLE `leaves`
  ADD CONSTRAINT `leaves_ibfk_1` FOREIGN KEY (`type_ID`) REFERENCES `leave_type` (`type_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `leaves_ibfk_2` FOREIGN KEY (`employee_ID`) REFERENCES `employee` (`employee_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `leave_history`
--
ALTER TABLE `leave_history`
  ADD CONSTRAINT `leave_history_ibfk_1` FOREIGN KEY (`employee_ID`) REFERENCES `employee` (`employee_ID`);

--
-- Constraints for table `transport`
--
ALTER TABLE `transport`
  ADD CONSTRAINT `transport_ibfk_1` FOREIGN KEY (`date_of_application`) REFERENCES `leaves` (`date_of_application`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`employee_ID`) REFERENCES `employee` (`employee_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
