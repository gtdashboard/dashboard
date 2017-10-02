-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2017 at 09:32 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+03:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `structure`
--

-- --------------------------------------------------------

--
-- Table structure for table `basic_info`
--

CREATE TABLE `basic_info` (
  `id_pro` int(11) NOT NULL,
  `project_name` text NOT NULL,
  `project_no` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `id_equip` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `number_equip` int(11) NOT NULL,
  `hours` int(11) NOT NULL,
  `date_used` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id_file` int(11) NOT NULL,
  `date_file` date NOT NULL,
  `link_file` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `userid` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8_bin NOT NULL,
  `password` varchar(100) COLLATE utf8_bin NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`userid`, `emp_id`, `username`, `password`, `last_login`) VALUES
(1, 0, 'admin', 'admin123', '2017-04-16 07:22:03');

-- --------------------------------------------------------

--
-- Table structure for table `manpower_attendance`
--

CREATE TABLE `manpower_attendance` (
  `id_attendance` int(11) NOT NULL,
  `id_manpower` int(11) NOT NULL,
  `time_in` time NOT NULL,
  `remark` varchar(50) NOT NULL,
  `present` tinyint(1) NOT NULL,
  `date_present` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `manpower_list`
--

CREATE TABLE `manpower_list` (
  `id_staff` int(11) NOT NULL,
  `emp_no` int(11) NOT NULL,
  `emp_name` varchar(50) NOT NULL,
  `designation` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `site_info`
--

CREATE TABLE `site_info` (
  `id_site` int(11) NOT NULL,
  `instruction` varchar(100) NOT NULL,
  `accidents` varchar(100) NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `date_site` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `weather`
--

CREATE TABLE `weather` (
  `id_weather` int(11) NOT NULL,
  `temperature` int(11) NOT NULL,
  `rain` double NOT NULL,
  `sandstorm` double NOT NULL,
  `date_temp` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `worker`
--

CREATE TABLE `worker` (
  `id_worker` int(11) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `number` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `workers_attendance`
--

CREATE TABLE `workers_attendance` (
  `id_attendance` int(11) NOT NULL,
  `id_workers` int(11) NOT NULL,
  `present` tinyint(1) NOT NULL,
  `date_present` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `workers_list`
--

CREATE TABLE `workers_list` (
  `id_staff` int(11) NOT NULL,
  `emp_no` int(11) NOT NULL,
  `emp_name` varchar(50) NOT NULL,
  `designation` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `work_order`
--

CREATE TABLE `work_order` (
  `id_work_order` int(11) NOT NULL,
  `wo_no` int(11) NOT NULL,
  `task_name` varchar(100) NOT NULL,
  `foreman` varchar(100) NOT NULL,
  `ag` double NOT NULL,
  `ug` double NOT NULL,
  `other_works` varchar(100) NOT NULL,
  `date_done` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wo_numbers`
--

CREATE TABLE `wo_numbers` (
  `id_wo` int(11) NOT NULL,
  `work_order_no` varchar(100) NOT NULL,
  `start_date` date NOT NULL,
  `last_date_done` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `basic_info`
--
ALTER TABLE `basic_info`
  ADD PRIMARY KEY (`id_pro`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`id_equip`),
  ADD UNIQUE KEY `uc_equipment` (`type`,`number_equip`,`hours`,`date_used`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id_file`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `manpower_attendance`
--
ALTER TABLE `manpower_attendance`
  ADD PRIMARY KEY (`id_attendance`),
  ADD KEY `fk1` (`id_manpower`);

--
-- Indexes for table `manpower_list`
--
ALTER TABLE `manpower_list`
  ADD PRIMARY KEY (`id_staff`);

--
-- Indexes for table `site_info`
--
ALTER TABLE `site_info`
  ADD PRIMARY KEY (`id_site`),
  ADD UNIQUE KEY `idx_row_unique` (`instruction`,`accidents`,`remarks`,`date_site`);

--
-- Indexes for table `weather`
--
ALTER TABLE `weather`
  ADD PRIMARY KEY (`id_weather`);

--
-- Indexes for table `worker`
--
ALTER TABLE `worker`
  ADD PRIMARY KEY (`id_worker`),
  ADD UNIQUE KEY `uc_worker` (`designation`,`number`,`category`,`date`);

--
-- Indexes for table `workers_attendance`
--
ALTER TABLE `workers_attendance`
  ADD PRIMARY KEY (`id_attendance`),
  ADD KEY `FK_WORKERS` (`id_workers`);

--
-- Indexes for table `workers_list`
--
ALTER TABLE `workers_list`
  ADD PRIMARY KEY (`id_staff`);

--
-- Indexes for table `work_order`
--
ALTER TABLE `work_order`
  ADD PRIMARY KEY (`id_work_order`),
  ADD UNIQUE KEY `uc_work_order` (`task_name`,`foreman`,`ag`,`ug`,`other_works`,`date_done`);

--
-- Indexes for table `wo_numbers`
--
ALTER TABLE `wo_numbers`
  ADD PRIMARY KEY (`id_wo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `basic_info`
--
ALTER TABLE `basic_info`
  MODIFY `id_pro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `id_equip` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id_file` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `manpower_attendance`
--
ALTER TABLE `manpower_attendance`
  MODIFY `id_attendance` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `manpower_list`
--
ALTER TABLE `manpower_list`
  MODIFY `id_staff` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `site_info`
--
ALTER TABLE `site_info`
  MODIFY `id_site` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `weather`
--
ALTER TABLE `weather`
  MODIFY `id_weather` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `worker`
--
ALTER TABLE `worker`
  MODIFY `id_worker` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `workers_attendance`
--
ALTER TABLE `workers_attendance`
  MODIFY `id_attendance` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `workers_list`
--
ALTER TABLE `workers_list`
  MODIFY `id_staff` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `work_order`
--
ALTER TABLE `work_order`
  MODIFY `id_work_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `wo_numbers`
--
ALTER TABLE `wo_numbers`
  MODIFY `id_wo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `manpower_attendance`
--
ALTER TABLE `manpower_attendance`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`id_manpower`) REFERENCES `manpower_list` (`id_staff`);

--
-- Constraints for table `workers_attendance`
--
ALTER TABLE `workers_attendance`
  ADD CONSTRAINT `FK_WORKERS` FOREIGN KEY (`id_workers`) REFERENCES `workers_list` (`id_staff`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

