-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2024 at 07:14 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ams`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(255) NOT NULL,
  `employee_code` varchar(255) NOT NULL,
  `employee_name` varchar(255) NOT NULL,
  `present_days` varchar(255) NOT NULL,
  `absent_days` varchar(255) NOT NULL,
  `pay_days` varchar(255) NOT NULL,
  `normal_work_hrs` varchar(255) NOT NULL,
  `ot_hours` varchar(255) NOT NULL,
  `late_coming_days` varchar(255) NOT NULL,
  `late_coming_hours` varchar(255) NOT NULL,
  `early_going_days` varchar(255) NOT NULL,
  `early_going_hours` varchar(255) NOT NULL,
  `salary` varchar(255) DEFAULT NULL,
  `month` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `weekly_off_present` varchar(255) DEFAULT NULL,
  `holidays` varchar(233) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `employee_code`, `employee_name`, `present_days`, `absent_days`, `pay_days`, `normal_work_hrs`, `ot_hours`, `late_coming_days`, `late_coming_hours`, `early_going_days`, `early_going_hours`, `salary`, `month`, `year`, `weekly_off_present`, `holidays`) VALUES
(1, '1', 'Keshav', '23', '3', '28', '180.03', '0.56', '16', '10.33', '6', '35.34', NULL, 'October', '2024', '0', '3'),
(2, '21', 'Ankush', '24', '1', '30', '223.17', '26.2', '24', '22.09', '3', '22.59', NULL, 'October', '2024', '2', '3'),
(3, '2', 'Meenakshi', '22', '3', '28', '166.08', '0.24', '22', '9.08', '8', '42.31', NULL, 'October', '2024', '0', '3'),
(4, '3', 'Neeraj', '22', '3', '28', '206.52', '29.37', '22', '20.29', '2', '18.48', NULL, 'October', '2024', '2', '3'),
(5, '4', 'Ajay Singh', '20', '5', '26', '163.42', '0.14', '15', '7.32', '12', '27.17', NULL, 'October', '2024', '0', '3'),
(6, '5', 'Ashish Mishra', '21', '4', '27', '178.52', '4.52', '1', '0.01', '5', '28.59', NULL, 'October', '2024', '0', '3'),
(7, '6', 'Dimple', '22', '3', '28', '189.34', '0', '22', '8.13', '15', '18.44', NULL, 'October', '2024', '0', '3'),
(8, '9', 'Afroz', '20', '5', '26', '179.05', '20.42', '19', '12.21', '2', '18.5', NULL, 'October', '2024', '1', '3'),
(9, '11', 'Sanjay', '24', '1', '30', '226.57', '44.14', '10', '9.04', '2', '18.47', NULL, 'October', '2024', '2', '3'),
(10, '12', 'Sandeep', '23', '2', '29', '212.28', '37.07', '23', '8.48', '3', '19.37', NULL, 'October', '2024', '1', '3'),
(11, '14', 'Lalit', '23', '2', '29', '213.54', '43.19', '9', '8.54', '2', '24.02', NULL, 'October', '2024', '2', '3'),
(12, '17', 'Krishna', '24', '1', '30', '200.36', '0.01', '24', '7.46', '3', '26.55', NULL, 'October', '2024', '0', '3'),
(13, '19', 'Anil Verma', '17', '8', '23', '125.18', '0', '17', '61.25', '1', '18.3', NULL, 'October', '2024', '1', '3'),
(14, '20', 'Payal', '23', '2', '29', '193.58', '0', '22', '12.17', '10', '19.21', NULL, 'October', '2024', '0', '3'),
(15, '25', 'Santosh', '24', '1', '30', '226.55', '43.32', '2', '1.22', '1', '18.3', NULL, 'October', '2024', '2', '3'),
(16, '26', 'Ashish Sir', '23', '2', '29', '108.24', '1.09', '23', '53.31', '18', '84.04', NULL, 'October', '2024', '2', '3'),
(17, '101', 'Supriya', '23', '2', '29', '113.02', '3.4', '23', '26.06', '16', '93.21', NULL, 'October', '2024', '1', '3'),
(18, '33', 'Ankita', '19', '6', '25', '142.54', '0.05', '16', '5', '7', '41.45', NULL, 'October', '2024', '0', '3'),
(19, '35', 'Tanveer', '23', '2', '29', '209.5', '34.19', '23', '16.08', '2', '22.08', NULL, 'October', '2024', '2', '3'),
(20, '40', 'Shivani Sharma', '22', '3', '28', '183.51', '4.54', '18', '14.05', '3', '26.04', NULL, 'October', '2024', '0', '3'),
(21, '15', 'Raju', '23', '2', '29', '196.33', '1.02', '18', '1.59', '6', '27.06', NULL, 'October', '2024', '0', '3'),
(22, '34', 'Ilma', '23', '2', '29', '198.09', '0.54', '23', '5.09', '3', '23.32', NULL, 'October', '2024', '0', '3'),
(23, '13', 'Arshad', '22', '3', '28', '171.52', '0', '22', '17.09', '23', '27.29', NULL, 'October', '2024', '0', '3'),
(24, '43', 'visitor 2', '0', '25', '6', '0', '0', '0', '0', '1', '18.3', NULL, 'October', '2024', '0', '3'),
(25, '41', 'visitor 1', '6', '19', '12', '5.39', '0', '6', '25.52', '7', '40.58', NULL, 'October', '2024', '0', '3'),
(26, '44', 'visitor 3', '0', '25', '6', '0', '0', '0', '0', '1', '18.3', NULL, 'October', '2024', '0', '3'),
(27, '10', 'jagriti', '9', '16', '15', '78.42', '0.24', '7', '2.57', '1', '18.3', NULL, 'October', '2024', '0', '3'),
(28, '27', 'gautam', '24', '1', '30', '215.1', '35.59', '1', '0.18', '2', '27.11', NULL, 'October', '2024', '1', '3'),
(29, '28', 'bhawna', '22', '3', '28', '96.43', '0', '5', '9.07', '23', '116.37', NULL, 'October', '2024', '0', '3'),
(30, '32', 'sahil', '22', '3', '28', '178.05', '1.28', '17', '6.54', '3', '31.53', NULL, 'October', '2024', '0', '3'),
(31, '39', 'sagar', '19', '6', '25', '163.16', '0.01', '19', '5.51', '3', '21.09', NULL, 'October', '2024', '0', '3'),
(32, '37', 'sohil', '24', '1', '30', '194.59', '6.2', '24', '24.17', '2', '26.3', NULL, 'October', '2024', '1', '3'),
(33, '18', 'Devesh', '22', '3', '28', '180.29', '0.25', '21', '10.37', '3', '26.18', NULL, 'October', '2024', '0', '3'),
(34, '8', 'Shivani Goyal', '22', '3', '28', '179.27', '2.25', '3', '2.44', '19', '37.22', NULL, 'October', '2024', '0', '3'),
(35, '23', 'pankaj', '20', '5', '26', '167.4', '1.26', '13', '10.1', '4', '21.08', NULL, 'October', '2024', '0', '3'),
(36, '24', 'neetu', '23', '2', '29', '205.53', '1.4', '10', '6.01', '2', '22.08', NULL, 'October', '2024', '1', '3'),
(37, '29', 'mukesh', '20', '5', '26', '170.34', '0.01', '20', '7.21', '2', '21.06', NULL, 'October', '2024', '0', '3'),
(38, '31', 'rajesh', '23', '2', '29', '193.54', '36.4', '23', '10.34', '4', '44.18', NULL, 'October', '2024', '2', '3'),
(39, '38', 'salim', '24', '1', '30', '209.24', '24.14', '24', '12.26', '4', '26.31', NULL, 'October', '2024', '1', '3'),
(40, '42', 'wasid', '19', '6', '25', '145.03', '0.08', '18', '8.13', '6', '36.28', NULL, 'October', '2024', '0', '3'),
(41, '45', 'kamal', '5', '20', '11', '35.06', '0.42', '0', '0', '6', '29.12', NULL, 'October', '2024', '0', '3'),
(42, '48', 'Vandana', '12', '13', '18', '91.16', '1.27', '1', '2.35', '6', '33.35', NULL, 'October', '2024', '0', '3');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(255) NOT NULL,
  `employee_name` varchar(255) NOT NULL,
  `employee_code` varchar(255) NOT NULL,
  `employee_gender` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `employee_salary` varchar(100) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1',
  `employee_department` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_name`, `employee_code`, `employee_gender`, `date`, `employee_salary`, `status`, `employee_department`) VALUES
(15, 'Keshav', '1', 'male', '2024-11-11 10:37:28', '80000', '1', 'it'),
(18, 'Meenakshi', '2', 'female', '2024-11-11 10:40:11', '45000', '1', 'editor'),
(19, 'Neeraj', '3', 'male', '2024-11-11 10:40:31', '65000', '1', 'designer'),
(20, 'Ajay Singh', '4', 'male', '2024-11-11 10:41:00', '22000', '1', 'animation'),
(21, 'Ashish mishra', '5', 'male', '2024-11-11 10:41:18', '32000', '1', 'data operator'),
(22, 'Dimple', '6', 'female', '2024-11-11 10:41:38', '14000', '1', 'animation'),
(23, 'Shivani goyal', '8', 'female', '2024-11-11 10:42:10', '25000', '1', 'marketing seo'),
(24, 'Afroz', '9', 'male', '2024-11-11 10:42:35', '21000', '1', 'animation'),
(25, 'jagriti', '10', 'female', '2024-11-11 10:42:59', '12000', '1', 'Hr'),
(26, 'Sanjay', '11', 'male', '2024-11-11 10:43:23', '16000', '1', 'editor'),
(27, 'Sandeep', '12', 'male', '2024-11-11 10:43:41', '41000', '1', 'designer'),
(28, 'arshad', '13', 'male', '2024-11-11 10:44:26', '23000', '1', 'studio'),
(29, 'Lalit', '14', 'male', '2024-11-11 10:44:58', '15500', '1', 'designer'),
(30, 'Raju', '15', 'male', '2024-11-11 10:45:20', '10000', '1', 'animation'),
(31, 'krishna', '17', 'male', '2024-11-11 10:45:46', '24000', '1', 'video editor'),
(32, 'Devesh', '18', 'male', '2024-11-11 10:46:10', '20000', '1', 'it'),
(33, 'Anil verma', '19', 'male', '2024-11-11 10:46:28', '25000', '1', 'art sketch'),
(34, 'Payal', '20', 'female', '2024-11-11 10:46:48', '12000', '1', 'data operator'),
(35, 'Ankush', '21', 'male', '2024-11-11 10:47:15', '21000', '1', 'designer'),
(36, 'pankaj', '23', 'male', '2024-11-11 10:47:48', '14000', '1', 'animation'),
(38, 'santosh', '25', 'male', '2024-11-11 10:48:41', '17000', '1', 'pantry'),
(41, 'gautam', '27', 'male', '2024-11-11 10:51:05', '15000', '1', 'coloring'),
(42, 'Bhawna', '28', 'female', '2024-11-11 10:51:35', '76000', '1', 'editor'),
(43, 'mukesh', '29', 'male', '2024-11-11 10:51:57', '12000', '1', 'data operator'),
(44, 'Rajesh', '31', 'male', '2024-11-11 10:52:15', '65000', '1', 'designer'),
(45, 'Sahil', '32', 'male', '2024-11-11 10:52:34', '78000', '1', 'animation'),
(46, 'Ankita', '33', 'female', '2024-11-11 10:52:56', '20000', '1', 'editor'),
(47, 'Ilma', '34', 'female', '2024-11-11 10:53:28', '15000', '1', 'editor'),
(48, 'Tanveer', '35', 'male', '2024-11-11 10:53:44', '14000', '1', 'designer'),
(49, 'sohil', '37', 'male', '2024-11-11 10:54:18', '91000', '1', 'coloring'),
(50, 'salim', '38', 'male', '2024-11-11 10:54:37', '19000', '1', 'coloring'),
(51, 'sagar', '39', 'male', '2024-11-11 10:54:54', '16000', '1', 'marketing seo'),
(52, 'Shivani sharma', '40', 'female', '2024-11-11 10:55:16', '60000', '1', 'art sketch'),
(56, 'wasid', '42', 'male', '2024-11-11 10:56:45', '55000', '1', 'coloring');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_code` (`employee_code`,`month`,`year`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_code` (`employee_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
