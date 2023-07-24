-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 24, 2023 at 11:47 AM
-- Server version: 10.2.43-MariaDB
-- PHP Version: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `theappl_adco`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(10) UNSIGNED NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `employee_id` int(10) UNSIGNED DEFAULT NULL,
  `attendance` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `punch_in` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `punch_out` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `branch_id`, `employee_id`, `attendance`, `date`, `punch_in`, `punch_out`, `time`, `created_at`, `updated_at`) VALUES
(2, 9, 13, 'Present', '2022-12-12', NULL, NULL, '09:03:10', '2022-12-12 03:33:10', '2022-12-12 03:33:10'),
(3, 3, 4, 'Present', '2022-12-12', NULL, NULL, '10:20:23', '2022-12-12 04:50:23', '2022-12-12 04:50:23'),
(4, 3, 8, 'Present', '2022-12-12', NULL, NULL, '10:48:01', '2022-12-12 05:18:01', '2022-12-12 05:18:01'),
(7, 9, 11, 'Present', '2022-12-12', NULL, NULL, '11:55:44', '2022-12-12 06:25:44', '2022-12-12 06:25:44'),
(8, 9, 13, 'Present', '2022-12-13', NULL, NULL, '09:42:23', '2022-12-13 04:12:23', '2022-12-13 04:12:23'),
(9, 3, 4, 'Present', '2022-12-13', NULL, NULL, '09:42:55', '2022-12-13 04:12:55', '2022-12-13 04:12:55'),
(10, 2, 12, 'Present', '2022-12-13', NULL, NULL, '10:02:12', '2022-12-13 04:32:12', '2022-12-13 04:32:12'),
(11, 3, 4, 'Full day', '2022-12-13', NULL, NULL, NULL, '2022-12-13 05:06:21', '2022-12-13 05:44:40'),
(113, 3, 4, 'Weekoff(First half)', '2022-12-03', NULL, NULL, NULL, '2022-12-22 12:01:40', '2022-12-22 12:01:40'),
(114, 3, 4, 'Weekoff(First half)', '2022-12-10', NULL, NULL, NULL, '2022-12-22 12:01:40', '2022-12-22 12:01:40'),
(115, 3, 4, 'Weekoff(First half)', '2022-12-17', NULL, NULL, NULL, '2022-12-22 12:01:40', '2022-12-22 12:01:40'),
(116, 3, 4, 'Weekoff(First half)', '2022-12-24', NULL, NULL, NULL, '2022-12-22 12:01:40', '2022-12-22 12:01:40'),
(117, 3, 4, 'Holiday', '2022-12-25', NULL, NULL, NULL, '2022-12-22 12:01:40', '2022-12-22 12:01:40'),
(118, 3, 4, 'Weekoff(First half)', '2022-12-31', NULL, NULL, NULL, '2022-12-22 12:01:40', '2022-12-22 12:01:40'),
(119, 2, 5, 'Weekoff(First half)', '2022-12-01', NULL, NULL, NULL, '2022-12-22 12:01:40', '2022-12-22 12:01:40'),
(120, 2, 5, 'Weekoff(First half)', '2022-12-08', NULL, NULL, NULL, '2022-12-22 12:01:40', '2022-12-22 12:01:40'),
(121, 2, 5, 'Weekoff(First half)', '2022-12-15', NULL, NULL, NULL, '2022-12-22 12:01:40', '2022-12-22 12:01:40'),
(122, 2, 5, 'Weekoff(First half)', '2022-12-22', NULL, NULL, NULL, '2022-12-22 12:01:40', '2022-12-22 12:01:40'),
(123, 2, 5, 'Holiday', '2022-12-25', NULL, NULL, NULL, '2022-12-22 12:01:40', '2022-12-22 12:01:40'),
(124, 2, 5, 'Weekoff(First half)', '2022-12-29', NULL, NULL, NULL, '2022-12-22 12:01:40', '2022-12-22 12:01:40'),
(125, 3, 8, 'Holiday', '2022-12-25', NULL, NULL, NULL, '2022-12-22 12:01:40', '2022-12-22 12:01:40'),
(126, 9, 11, 'Holiday', '2022-12-25', NULL, NULL, NULL, '2022-12-22 12:01:40', '2022-12-22 12:01:40'),
(127, 2, 12, 'Holiday', '2022-12-25', NULL, NULL, NULL, '2022-12-22 12:01:40', '2022-12-22 12:01:40'),
(128, 9, 13, 'Weekoff(First half)', '2022-12-03', NULL, NULL, NULL, '2022-12-22 12:01:40', '2022-12-22 12:01:40'),
(129, 9, 13, 'Weekoff(First half)', '2022-12-10', NULL, NULL, NULL, '2022-12-22 12:01:40', '2022-12-22 12:01:40'),
(130, 9, 13, 'Weekoff(First half)', '2022-12-17', NULL, NULL, NULL, '2022-12-22 12:01:40', '2022-12-22 12:01:40'),
(131, 9, 13, 'Weekoff(First half)', '2022-12-24', NULL, NULL, NULL, '2022-12-22 12:01:40', '2022-12-22 12:01:40'),
(132, 9, 13, 'Holiday', '2022-12-25', NULL, NULL, NULL, '2022-12-22 12:01:40', '2022-12-22 12:01:40'),
(133, 9, 13, 'Weekoff(First half)', '2022-12-31', NULL, NULL, NULL, '2022-12-22 12:01:40', '2022-12-22 12:01:40'),
(134, 2, 5, 'Missed', '2022-12-22', '17:41', NULL, NULL, '2022-12-22 12:11:56', '2022-12-22 12:11:56'),
(135, 3, 4, 'Missed', '2022-12-23', '10:36', '10:39', NULL, '2022-12-23 05:06:58', '2022-12-23 05:09:11'),
(136, 2, 12, 'Missed', '2022-12-23', '10:48', '10:58', NULL, '2022-12-23 05:18:26', '2022-12-23 05:28:48'),
(137, 2, 5, 'Absent', '2022-12-23', NULL, NULL, NULL, '2022-12-23 05:33:43', '2022-12-23 05:33:43'),
(138, 3, 8, 'Absent', '2022-12-23', NULL, NULL, NULL, '2022-12-23 05:33:43', '2022-12-23 05:33:43'),
(139, 9, 11, 'Absent', '2022-12-23', NULL, NULL, NULL, '2022-12-23 05:33:43', '2022-12-23 05:33:43'),
(140, 9, 13, 'Absent', '2022-12-23', NULL, NULL, NULL, '2022-12-23 05:33:43', '2022-12-23 05:33:43'),
(141, 2, 5, 'Full day', '2022-12-23', NULL, NULL, NULL, '2022-12-23 07:50:23', '2022-12-23 07:50:23'),
(142, 2, 5, 'Present', '2023-01-11', '15:18', '15:18', NULL, '2023-01-11 09:48:30', '2023-01-11 09:50:11');

-- --------------------------------------------------------

--
-- Table structure for table `bsrs`
--

CREATE TABLE `bsrs` (
  `id` int(10) UNSIGNED NOT NULL,
  `so_id` int(10) UNSIGNED DEFAULT NULL,
  `customer_id` int(10) UNSIGNED DEFAULT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `call_source` int(11) DEFAULT NULL,
  `call_source1` int(11) DEFAULT NULL,
  `call_source2` int(11) DEFAULT NULL,
  `call_source3` int(11) DEFAULT NULL,
  `call_source4` int(11) DEFAULT NULL,
  `call_source5` int(11) DEFAULT NULL,
  `dealer_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_call` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_call1` int(11) DEFAULT NULL,
  `service_call2` int(11) DEFAULT NULL,
  `replace_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `complain_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `segment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `segment1` int(11) DEFAULT NULL,
  `segment2` int(11) DEFAULT NULL,
  `segment3` int(11) DEFAULT NULL,
  `battery_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `battery_type1` int(11) DEFAULT NULL,
  `battery_type2` int(11) DEFAULT NULL,
  `battery_type3` int(11) DEFAULT NULL,
  `part_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warranty` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batt_si_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_sale` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mfg_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tsf_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tsf_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tsf_created_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tsf_created_by1` int(11) DEFAULT NULL,
  `tsf_created_by2` int(11) DEFAULT NULL,
  `tsf_created_by3` int(11) DEFAULT NULL,
  `tsf_created_by4` int(11) DEFAULT NULL,
  `lead_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warranty_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warranty_status1` int(11) DEFAULT NULL,
  `warranty_status2` int(11) DEFAULT NULL,
  `warranty_status3` int(11) DEFAULT NULL,
  `warranty_status4` int(11) DEFAULT NULL,
  `nature_problem` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ocv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `standby_provided` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `standby_provided1` int(11) DEFAULT NULL,
  `standby_provided2` int(11) DEFAULT NULL,
  `physical_condition` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `physical_condition1` int(11) DEFAULT NULL,
  `physical_condition2` int(11) DEFAULT NULL,
  `attended_place` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attended_place1` int(11) DEFAULT NULL,
  `attended_place2` int(11) DEFAULT NULL,
  `attended_place3` int(11) DEFAULT NULL,
  `attended_place4` int(11) DEFAULT NULL,
  `attended_place5` int(11) DEFAULT NULL,
  `attended_place6` int(11) DEFAULT NULL,
  `proof_of_warranty` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proof_of_warranty1` int(11) DEFAULT NULL,
  `proof_of_warranty2` int(11) DEFAULT NULL,
  `proof_of_warranty3` int(11) DEFAULT NULL,
  `proof_of_warranty4` int(11) DEFAULT NULL,
  `proof_of_warranty5` int(11) DEFAULT NULL,
  `proof_of_warranty6` int(11) DEFAULT NULL,
  `proof_of_warranty7` int(11) DEFAULT NULL,
  `application` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `application1` int(11) DEFAULT NULL,
  `application2` int(11) DEFAULT NULL,
  `application3` int(11) DEFAULT NULL,
  `application4` int(11) DEFAULT NULL,
  `application5` int(11) DEFAULT NULL,
  `application6` int(11) DEFAULT NULL,
  `application7` int(11) DEFAULT NULL,
  `application8` int(11) DEFAULT NULL,
  `application9` int(11) DEFAULT NULL,
  `application10` int(11) DEFAULT NULL,
  `make` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_capacity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fuel_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fuel_type1` int(11) DEFAULT NULL,
  `fuel_type2` int(11) DEFAULT NULL,
  `fuel_type3` int(11) DEFAULT NULL,
  `veh_mfg` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usage1` int(11) DEFAULT NULL,
  `usage2` int(11) DEFAULT NULL,
  `vehicle_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kms_used` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warranty1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bettery_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bsr_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no` int(11) DEFAULT NULL,
  `scf_no` int(11) DEFAULT NULL,
  `scf_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `complaint_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bsrs`
--

INSERT INTO `bsrs` (`id`, `so_id`, `customer_id`, `mobile_no`, `address`, `call_source`, `call_source1`, `call_source2`, `call_source3`, `call_source4`, `call_source5`, `dealer_name`, `location`, `service_call`, `service_call1`, `service_call2`, `replace_date`, `complain_date`, `segment`, `segment1`, `segment2`, `segment3`, `battery_type`, `battery_type1`, `battery_type2`, `battery_type3`, `part_no`, `warranty`, `batt_si_no`, `date_of_sale`, `mfg_date`, `tsf_no`, `tsf_date`, `tsf_created_by`, `tsf_created_by1`, `tsf_created_by2`, `tsf_created_by3`, `tsf_created_by4`, `lead_time`, `warranty_status`, `warranty_status1`, `warranty_status2`, `warranty_status3`, `warranty_status4`, `nature_problem`, `ocv`, `standby_provided`, `standby_provided1`, `standby_provided2`, `physical_condition`, `physical_condition1`, `physical_condition2`, `attended_place`, `attended_place1`, `attended_place2`, `attended_place3`, `attended_place4`, `attended_place5`, `attended_place6`, `proof_of_warranty`, `proof_of_warranty1`, `proof_of_warranty2`, `proof_of_warranty3`, `proof_of_warranty4`, `proof_of_warranty5`, `proof_of_warranty6`, `proof_of_warranty7`, `application`, `application1`, `application2`, `application3`, `application4`, `application5`, `application6`, `application7`, `application8`, `application9`, `application10`, `make`, `model_capacity`, `fuel_type`, `fuel_type1`, `fuel_type2`, `fuel_type3`, `veh_mfg`, `usage`, `usage1`, `usage2`, `vehicle_no`, `kms_used`, `warranty1`, `bettery_type`, `bsr_status`, `no`, `scf_no`, `scf_date`, `complaint_date`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '1234567890', 'testing', NULL, NULL, 2, NULL, 4, NULL, 'Adena Allison', 'Sint ullamco tempor', NULL, NULL, NULL, '2006-11-23', NULL, NULL, 1, 2, 3, NULL, NULL, NULL, 3, '3', '24', '38', '2022-11-30', '2018-03', '88', '2006-05-14', NULL, 1, 2, NULL, NULL, '03:42', NULL, NULL, NULL, NULL, NULL, 'Est maxime molestiae', 'Perferendis sint vit', NULL, 1, 2, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 3, 4, 5, NULL, NULL, NULL, 1, NULL, NULL, 4, NULL, NULL, 7, NULL, 9, NULL, 'Non et excepturi id', 'Ad pariatur Laboris', NULL, 1, 2, 3, 'Adipisicing ipsum a', NULL, NULL, 2, '93', 'Aut quasi dolorem es', '24', NULL, NULL, 53, 17, '2022-03-22', '1984-09-23', '2022-11-24 01:08:45', '2022-12-01 01:56:18'),
(2, 3, 1, '1234567890', 'testing', NULL, 1, 2, 3, 4, 5, 'Eleanor Owen', 'Aut cupiditate conse', NULL, NULL, NULL, '1974-04-12', NULL, NULL, NULL, 2, 3, NULL, NULL, 2, 3, '1001', '13', '34', '2022-11-30', '2011-07', '81', '1973-12-23', NULL, 1, 2, 3, 4, '23:19', NULL, 1, 2, 3, NULL, 'Voluptas consequatur', 'Delectus elit omni', NULL, NULL, 2, NULL, NULL, NULL, NULL, 1, NULL, 3, NULL, NULL, 6, NULL, NULL, 2, 3, NULL, NULL, 6, 7, NULL, 1, 2, NULL, 4, 5, 6, 7, NULL, NULL, 10, 'Voluptatibus atque i', 'Ad repudiandae tempo', NULL, 1, NULL, NULL, 'Velit quia quia corp', NULL, 1, 2, '74', 'Itaque error consequ', '24', NULL, NULL, 20, 61, '1988-04-13', '2018-12-17', '2022-11-24 01:16:33', '2022-12-02 00:14:12'),
(3, 6, 1, '1234567890', 'testing', NULL, 1, NULL, NULL, 4, NULL, 'test', 'rajkot', NULL, 1, NULL, '2022-12-02', NULL, NULL, 1, 2, NULL, NULL, NULL, NULL, 3, 'amr001', '1', '001', '2022-12-02', '2022-12', '111', '2022-12-02', NULL, 1, NULL, NULL, 4, '12:55', NULL, 1, 2, NULL, NULL, 'backup', 'ad;lasdl', NULL, 1, 2, NULL, 1, NULL, NULL, NULL, NULL, NULL, 4, 5, NULL, NULL, NULL, NULL, 3, 4, NULL, NULL, NULL, NULL, NULL, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'amron', '12v', NULL, 1, NULL, NULL, '2022', NULL, 1, NULL, '111', '1000', '1', NULL, NULL, 1, 1, '2022-12-02', '2022-12-02', '2022-12-02 01:56:09', '2022-12-02 01:57:13');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'Category2', '2022-11-23 03:37:55', '2022-11-23 03:37:55'),
(3, 'Test', '2022-11-23 05:37:27', '2022-11-23 05:37:27'),
(4, 'Amaron Invertor', '2022-11-28 23:40:24', '2022-12-28 13:10:55'),
(5, 'A.C.DELCO', '2022-11-28 23:40:24', '2022-12-28 13:19:09'),
(6, 'Amaron Invertor Battey', '2022-12-01 23:56:11', '2022-12-28 13:10:09'),
(8, 'Amaron Motor Cycle', '2022-12-02 00:47:57', '2022-12-28 13:09:40'),
(10, 'Amaron Auto', '2022-12-06 07:38:26', '2022-12-28 13:09:18'),
(13, 'BTZ-9R', '2022-12-29 06:20:33', '2022-12-29 06:20:33');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `branch_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `branch_id`, `name`, `number`, `email`, `address`, `created_at`, `updated_at`) VALUES
(1, 2, 'Test', '1234567890', 'test@gmail.com', 'testing', '2022-11-23 03:42:05', '2022-11-23 03:42:05'),
(2, 2, 'Abc', '1234567890', 'abc@gmail.com', 'test', '2022-11-23 03:42:30', '2022-11-23 03:42:30'),
(3, 3, 'Test', '1234567890', 'test@gmail.com', 'test', '2022-12-02 01:23:55', '2022-12-02 01:23:55'),
(4, 2, 'P m auto link', '99999', 'help@gmail.com', 'bhuj', '2022-12-29 06:18:27', '2022-12-29 06:18:27');

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `name`, `value`, `created_at`, `updated_at`) VALUES
(1, '1', '10', '2022-11-23 03:39:48', '2022-11-23 03:39:48'),
(2, '2', '15', '2022-11-23 03:39:59', '2022-11-23 03:39:59'),
(3, '10', '50', '2022-12-21 01:44:28', '2022-12-21 01:44:28');

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE `group` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Tyre 28%', '2022-12-06 06:48:16', '2022-12-28 13:20:50'),
(4, 'BATTERY 28%', '2022-12-06 07:38:26', '2022-12-28 13:19:46'),
(5, 'Invertor 18%', '2022-12-06 07:38:26', '2022-12-28 13:20:23'),
(7, 'Tyre 18%', '2022-12-28 13:21:20', '2022-12-28 13:21:20');

-- --------------------------------------------------------

--
-- Table structure for table `gst`
--

CREATE TABLE `gst` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gst`
--

INSERT INTO `gst` (`id`, `name`, `created_at`, `updated_at`) VALUES
(4, '8', '2022-11-26 01:16:16', '2022-11-26 05:51:48'),
(5, '18', '2022-11-26 01:56:49', '2022-11-26 05:52:00'),
(8, '28', '2022-11-26 03:35:42', '2022-11-26 05:52:11'),
(11, '10', '2022-11-28 00:34:52', '2022-11-28 00:34:52'),
(12, '5', '2022-11-28 05:31:25', '2022-11-28 05:31:25'),
(14, '15', '2022-11-29 00:09:19', '2022-11-29 00:09:19'),
(15, '11', '2022-12-02 00:47:57', '2022-12-02 00:47:57'),
(16, '1', '2022-12-02 00:56:51', '2022-12-02 00:56:51'),
(18, '2', '2022-12-06 07:38:26', '2022-12-06 07:38:26'),
(33, 'BATTERY 28%', '2022-12-08 08:08:23', '2022-12-28 13:24:00'),
(34, '12', '2022-12-29 06:26:41', '2022-12-29 06:26:41');

-- --------------------------------------------------------

--
-- Table structure for table `holiday`
--

CREATE TABLE `holiday` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `week_of` int(11) NOT NULL DEFAULT 0 COMMENT '0=holiday,1=weekoff',
  `date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `holiday`
--

INSERT INTO `holiday` (`id`, `name`, `week_of`, `date`, `created_at`, `updated_at`) VALUES
(1, 'Christmas', 0, '2022-12-25', '2022-12-07 08:10:31', '2022-12-07 08:10:31');

-- --------------------------------------------------------

--
-- Table structure for table `hsn`
--

CREATE TABLE `hsn` (
  `id` int(10) UNSIGNED NOT NULL,
  `gst_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_of_print` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fix_rate` int(11) DEFAULT NULL,
  `rcp` int(11) DEFAULT NULL,
  `fsp` int(11) DEFAULT NULL,
  `rack_no` int(11) DEFAULT NULL,
  `mrp` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hsn`
--

INSERT INTO `hsn` (`id`, `gst_id`, `name`, `name_of_print`, `fix_rate`, `rcp`, `fsp`, `rack_no`, `mrp`, `created_at`, `updated_at`) VALUES
(8, 4, '2222', NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-26 05:06:35', '2022-11-26 05:06:35'),
(9, 4, '1111', NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-26 05:10:09', '2022-11-26 05:10:09'),
(15, 4, '123456', NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-26 08:20:09', '2022-11-26 08:20:09'),
(24, 4, '2222', NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-28 00:34:52', '2022-11-28 00:34:52'),
(25, 4, '1111', NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-28 00:34:52', '2022-11-28 00:34:52'),
(26, 4, '123456', NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-28 00:34:52', '2022-11-28 00:34:52'),
(27, 11, '234', NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-28 00:34:52', '2022-11-28 00:34:52'),
(29, 11, '1212', NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-28 05:32:29', '2022-11-28 05:32:29'),
(32, 8, '1212', NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-28 05:53:08', '2022-11-28 05:53:08'),
(34, 5, '1111', NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-28 06:31:34', '2022-11-28 06:31:34'),
(35, 14, '123', NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-29 00:09:19', '2022-11-29 00:09:19'),
(37, 14, '1234', NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-29 00:25:59', '2022-11-29 00:25:59'),
(38, 12, '123', NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-29 00:43:13', '2022-11-29 00:43:13'),
(39, 5, '12345', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-02 01:07:14', '2022-12-02 01:07:14'),
(40, 16, '3333', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-02 01:18:25', '2022-12-02 01:18:25'),
(41, 8, '8435', 'testing', 1, 2, 3, 40, 3000, '2022-12-06 04:59:15', '2022-12-06 05:04:47'),
(46, 5, '3333', 'import', 2, 3, 2, 50, 2000, '2022-12-06 06:59:19', '2022-12-06 06:59:19');

-- --------------------------------------------------------

--
-- Table structure for table `lead`
--

CREATE TABLE `lead` (
  `id` int(10) UNSIGNED NOT NULL,
  `branch_id` int(10) UNSIGNED DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lead`
--

INSERT INTO `lead` (`id`, `branch_id`, `employee_id`, `name`, `email`, `number`, `image`, `created_at`, `updated_at`) VALUES
(1, 2, 5, 'test', 'test@gmail.com', '78679546', NULL, '2022-12-10 03:39:11', '2022-12-10 03:39:11'),
(2, 2, 12, 'Malcolm', 'qupexov@mailinator.com', '70564465', NULL, '2022-12-10 03:41:40', '2022-12-10 04:00:51'),
(3, 2, 12, 'Arthur Blanchard', 'nozuvumemu@mailinator.com', '514', '1670664843-1images.jpg', '2022-12-10 04:04:03', '2022-12-10 04:04:03'),
(4, 2, 5, 'Kristen Hunt', 'byxyxim@mailinator.com', '436', '1670665066-31index.jpg', '2022-12-10 04:06:32', '2022-12-10 04:07:46'),
(5, 2, 5, 'test', 'test@gmail.com', '42435354', '1670665189-1index.jpg', '2022-12-10 04:09:49', '2022-12-10 04:10:06'),
(6, 2, 5, 'abc', 'test@gmail.com', '43549963', '1670665323-12index.jpg', '2022-12-10 04:12:03', '2022-12-10 04:12:13');

-- --------------------------------------------------------

--
-- Table structure for table `leave`
--

CREATE TABLE `leave` (
  `id` int(10) UNSIGNED NOT NULL,
  `branch_id` int(10) UNSIGNED DEFAULT NULL,
  `leave_types` int(11) DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leave`
--

INSERT INTO `leave` (`id`, `branch_id`, `leave_types`, `remark`, `employee_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 'test', 4, '2', '2022-12-13 05:04:48', '2022-12-13 05:06:21'),
(3, 2, 1, 'test', 5, '2', '2022-12-23 07:50:11', '2022-12-23 07:50:23');

-- --------------------------------------------------------

--
-- Table structure for table `leave_child`
--

CREATE TABLE `leave_child` (
  `id` int(10) UNSIGNED NOT NULL,
  `leave_id` int(10) UNSIGNED DEFAULT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved_duration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leave_child`
--

INSERT INTO `leave_child` (`id`, `leave_id`, `date`, `duration`, `approved_duration`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-12-13', '1', 'Full day', '2022-12-13 05:04:48', '2022-12-13 05:06:21'),
(3, 3, '2022-12-23', '1', 'Full day', '2022-12-23 07:50:11', '2022-12-23 07:50:23');

-- --------------------------------------------------------

--
-- Table structure for table `leave_policy`
--

CREATE TABLE `leave_policy` (
  `id` int(10) UNSIGNED NOT NULL,
  `no_of_days` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leave_policy`
--

INSERT INTO `leave_policy` (`id`, `no_of_days`, `name`, `created_at`, `updated_at`) VALUES
(1, '2', 'Melvin Scott', '2022-12-09 04:36:28', '2022-12-09 04:36:28'),
(2, '7', 'test', '2022-12-09 04:38:08', '2022-12-09 05:57:57'),
(3, '3', 'Nora', '2022-12-09 05:14:06', '2022-12-09 05:58:15');

-- --------------------------------------------------------

--
-- Table structure for table `leave_policy_child`
--

CREATE TABLE `leave_policy_child` (
  `id` int(10) UNSIGNED NOT NULL,
  `policy_id` int(10) UNSIGNED DEFAULT NULL,
  `leave_type_id` int(10) UNSIGNED DEFAULT NULL,
  `day` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_extendable` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leave_policy_child`
--

INSERT INTO `leave_policy_child` (`id`, `policy_id`, `leave_type_id`, `day`, `is_extendable`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '1', '0', '2022-12-09 04:36:28', '2022-12-09 04:36:28'),
(2, 1, 2, '1', NULL, '2022-12-09 04:36:28', '2022-12-09 04:36:28'),
(3, 2, 1, '2', '1', '2022-12-09 04:38:08', '2022-12-09 05:57:57'),
(4, 2, 2, '5', '0', '2022-12-09 04:38:08', '2022-12-09 05:57:57'),
(5, 3, 1, '1', '1', '2022-12-09 05:14:06', '2022-12-09 05:58:39'),
(6, 3, 2, '2', '0', '2022-12-09 05:14:06', '2022-12-09 05:58:39');

-- --------------------------------------------------------

--
-- Table structure for table `leave_type`
--

CREATE TABLE `leave_type` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leave_type`
--

INSERT INTO `leave_type` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Hunter', '2022-12-08 07:32:15', '2022-12-08 07:32:25'),
(2, 'testing', '2022-12-08 07:35:39', '2022-12-08 07:35:51'),
(3, 'bhoomi', '2022-12-13 01:20:35', '2022-12-13 01:20:35');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2022_11_09_071936_create_categories_table', 1),
(4, '2022_11_09_071937_create_discounts_table', 1),
(5, '2022_11_09_075452_create_products_table', 1),
(6, '2022_11_10_060342_create_stocks_table', 1),
(7, '2022_11_10_114231_create_stock_child_table', 1),
(8, '2022_11_11_112231_create_customers_table', 1),
(9, '2022_11_11_130345_create_so_table', 1),
(10, '2022_11_11_130533_create_so_child_table', 1),
(11, '2022_11_21_105552_create_bsrs_table', 1),
(13, '2022_11_26_055419_create_hsn_table', 3),
(14, '2022_12_06_064901_create_holiday_table', 4),
(16, '2022_12_06_070945_create_attendance_table', 5),
(17, '2022_11_09_075451_create_gst_table', 6),
(18, '2022_11_09_075450_create_unit_table', 7),
(19, '2022_11_08_075340_create_group_table', 8),
(22, '2022_12_07_072957_create_leave_table', 9),
(23, '2022_12_07_093421_create_leave_child_table', 10),
(25, '2022_12_06_120515_create_leave_type_table', 12),
(28, '2022_12_09_052356_create_leave_policy_table', 14),
(29, '2022_12_09_052949_create_leave_policy_child_table', 14),
(30, '2022_12_07_062932_create_task_table', 15),
(33, '2022_12_07_072657_create_weekoff_table', 16),
(34, '2022_12_10_073635_create_lead_table', 17),
(37, '2022_12_12_090911_create_regularize_table', 18);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gst_id` int(10) UNSIGNED DEFAULT NULL,
  `group_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock_required` int(11) DEFAULT NULL,
  `price_list` int(11) DEFAULT NULL,
  `locationwise_stock` int(11) DEFAULT NULL,
  `serialno_stock` int(11) DEFAULT NULL,
  `tcs` int(11) DEFAULT NULL,
  `purchase_rate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sales_rate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_paid_rate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sale` int(11) UNSIGNED DEFAULT NULL,
  `purchase` int(11) UNSIGNED DEFAULT NULL,
  `gst_unit` int(11) UNSIGNED DEFAULT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warranty_year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `alias`, `model_code`, `gst_id`, `group_name`, `stock_required`, `price_list`, `locationwise_stock`, `serialno_stock`, `tcs`, `purchase_rate`, `sales_rate`, `tax_paid_rate`, `sale`, `purchase`, `gst_unit`, `quantity`, `amount`, `warranty_year`, `created_at`, `updated_at`) VALUES
(24, 2, 'Test', '12', 'testin123', 4, '1', 1, 1, 1, 1, 1, '100', '200', '300', 5, 5, 5, '1', '300', NULL, '2023-01-02 06:16:53', '2023-01-02 06:16:53');

-- --------------------------------------------------------

--
-- Table structure for table `regularize`
--

CREATE TABLE `regularize` (
  `id` int(10) UNSIGNED NOT NULL,
  `attendance_id` int(10) UNSIGNED DEFAULT NULL,
  `branch_id` int(10) UNSIGNED DEFAULT NULL,
  `employee_id` int(10) UNSIGNED DEFAULT NULL,
  `attendance` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `regularize`
--

INSERT INTO `regularize` (`id`, `attendance_id`, `branch_id`, `employee_id`, `attendance`, `date`, `time`, `type`, `reason`, `status`, `created_at`, `updated_at`) VALUES
(4, 2, 9, 13, 'Present', '2022-12-12', '09:03:10', 'Present', 'test', 'Approved', '2022-12-13 01:07:13', '2022-12-13 01:21:18'),
(5, 3, 3, 4, 'Present', '2022-12-12', '10:20:23', 'Week Off', 'abcde', 'Pending', '2022-12-13 01:26:38', '2022-12-13 05:28:58'),
(6, 11, 3, 4, 'Full day', '2022-12-13', NULL, 'Full day', 'attend test', 'Reject', '2022-12-13 05:30:06', '2022-12-13 05:45:57'),
(7, 142, 2, 5, 'Missed', '2023-01-11', NULL, 'Present', 'jhjhjh', 'Approved', '2023-01-11 09:49:45', '2023-01-11 09:50:11');

-- --------------------------------------------------------

--
-- Table structure for table `so`
--

CREATE TABLE `so` (
  `id` int(10) UNSIGNED NOT NULL,
  `branch_id` int(10) UNSIGNED DEFAULT NULL,
  `customer_id` int(10) UNSIGNED DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_mode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_sale` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `replace_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vehicle_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brs_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1=pending,2=complete',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `so`
--

INSERT INTO `so` (`id`, `branch_id`, `customer_id`, `remarks`, `order_no`, `type`, `payment_mode`, `date_of_sale`, `replace_date`, `vehicle_no`, `total`, `brs_status`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'test', 'ADCO-1', '1', '1', '2022-11-30', '2022-11-30', NULL, '1500', '1', 2, '2022-11-30 05:34:50', '2022-11-30 05:45:51'),
(2, 2, 1, 'Fuga Ut quod qui un', 'ADCO-2', '2', NULL, '2022-11-30', '2022-11-30', NULL, '0', '2', 2, '2022-11-30 05:46:56', '2022-12-01 02:05:08'),
(3, 2, 1, NULL, 'ADCO-3', '3', '1', '2022-11-30', '2022-11-30', NULL, '1000', '2', 2, '2022-11-30 06:18:12', '2022-12-02 00:27:49'),
(4, 2, 1, NULL, 'ADCO-4', '1', '1', '2022-12-02', '2022-12-02', NULL, '500', '1', 1, '2022-12-01 23:14:30', '2022-12-01 23:14:30'),
(5, 2, 1, 'direct sales', 'ADCO-5', '1', '1', '2022-12-02', '2022-12-02', '111', '3000', '1', 2, '2022-12-02 01:04:24', '2022-12-02 01:06:44'),
(6, 2, 1, 'foc', 'ADCO-6', '2', NULL, '2022-12-02', '2022-12-02', '222', '0', '2', 2, '2022-12-02 01:22:33', '2022-12-02 01:57:26'),
(7, 3, 3, 'test', 'ADCO-7', '1', '1', '2022-12-02', '2022-12-02', NULL, '1000', '1', 2, '2022-12-02 01:29:37', '2022-12-02 01:29:50'),
(9, 2, 1, 'pro rata warranty', 'ADCO-9', '3', '2', '2022-12-02', '2022-12-02', '333', '0', '1', 2, '2022-12-02 02:01:57', '2022-12-02 02:14:08'),
(10, 2, 1, 'direct sales from employee', 'ADCO-10', '1', '1', '2022-12-02', '2022-12-02', '4444', '1500', '1', 2, '2022-12-02 02:17:14', '2022-12-02 02:17:42'),
(15, 2, 1, 'ok', 'ADCO-11', '1', '1', '2023-01-02', '2023-01-02', '123', '100', '1', 1, '2023-01-02 06:18:58', '2023-01-02 06:18:58');

-- --------------------------------------------------------

--
-- Table structure for table `so_child`
--

CREATE TABLE `so_child` (
  `id` int(10) UNSIGNED NOT NULL,
  `so_id` int(10) UNSIGNED DEFAULT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `serial_id` int(10) UNSIGNED DEFAULT NULL,
  `return_serial_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `replace_serial_id` int(11) DEFAULT 0,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_sale` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bsr_status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `so_child`
--

INSERT INTO `so_child` (`id`, `so_id`, `category_id`, `product_id`, `serial_id`, `return_serial_id`, `replace_serial_id`, `price`, `discount`, `discount_amount`, `date_of_sale`, `amount`, `bsr_status`, `created_at`, `updated_at`) VALUES
(19, 15, 2, 24, 32, NULL, 0, '100', NULL, NULL, NULL, NULL, 0, '2023-01-02 06:18:58', '2023-01-02 06:18:58');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `no_of_product` int(11) DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `user_id`, `category_id`, `product_id`, `no_of_product`, `price`, `created_at`, `updated_at`) VALUES
(10, 2, 2, 24, 2, '100', '2023-01-02 06:18:42', '2023-01-02 06:18:42');

-- --------------------------------------------------------

--
-- Table structure for table `stock_child`
--

CREATE TABLE `stock_child` (
  `id` int(10) UNSIGNED NOT NULL,
  `stock_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serial_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `used` int(11) NOT NULL DEFAULT 0,
  `replaced` int(11) NOT NULL DEFAULT 0,
  `return_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_child`
--

INSERT INTO `stock_child` (`id`, `stock_id`, `user_id`, `category_id`, `product_id`, `price`, `serial_no`, `used`, `replaced`, `return_id`, `created_at`, `updated_at`) VALUES
(32, 10, 2, 2, 24, '100', 'test0', 0, 0, 0, '2023-01-02 06:18:42', '2023-01-02 06:18:42'),
(33, 10, 2, 2, 24, '100', 'test1', 0, 0, 0, '2023-01-02 06:18:42', '2023-01-02 06:18:42');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `due_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `assigned_by` int(10) UNSIGNED DEFAULT NULL,
  `assigned_to_branch` int(10) UNSIGNED DEFAULT NULL,
  `assigned_to_employee` int(10) UNSIGNED DEFAULT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `title`, `status`, `priority`, `start_date`, `due_date`, `time`, `assigned_by`, `assigned_to_branch`, `assigned_to_employee`, `attachment`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'doing', 'Medium', '2022-12-09', '2022-12-10', '14:33', 1, 9, 11, '1670576643.jpg', '<p>aaaaaaaaaa</p>', '2022-12-09 03:34:03', '2022-12-09 06:16:08'),
(3, 'branch', 'doing', 'Medium', '2022-12-09', '2022-12-10', '14:38', 2, 2, 5, '1670576909.jpg', '<p>bbbbbbbbbb</p>', '2022-12-09 03:38:29', '2022-12-09 06:21:20'),
(4, 'employee update', 'check', 'High', '2022-12-10', '2022-12-11', '02:39', 5, 3, 4, '1670582233.jpg', '<p>ccccccccccc aaaaaaaaaa</p>', '2022-12-09 03:40:02', '2022-12-09 06:35:52'),
(5, 'test', 'done', 'Low', '2022-12-09', '2022-12-09', '14:53', 11, 9, 11, NULL, NULL, '2022-12-09 03:53:39', '2022-12-09 06:16:58'),
(6, 'test', 'onhold', 'Low', '2022-12-09', NULL, NULL, 8, 3, 4, NULL, NULL, '2022-12-09 03:55:35', '2022-12-09 06:17:09'),
(7, 'only branch', 'onhold', 'High', NULL, NULL, NULL, 1, 3, NULL, NULL, NULL, '2022-12-09 03:57:48', '2022-12-09 06:36:44'),
(8, 'Qui tempor architectss', 'check', 'Low', '2022-12-10', '2022-12-10', NULL, 1, 2, 12, '1670648919.jpg', '<p><strong>fsdfgerger</strong></p>', '2022-12-09 23:38:39', '2023-01-11 09:40:26');

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`id`, `name`, `created_at`, `updated_at`) VALUES
(3, 'Sale', '2022-12-06 04:49:33', '2022-12-06 04:49:33'),
(4, 'Purchase', '2022-12-06 04:49:53', '2022-12-06 04:49:53'),
(5, 'Gst unit', '2022-12-06 04:50:20', '2022-12-06 04:50:20'),
(10, 'test', '2022-12-06 07:38:26', '2022-12-06 07:38:26'),
(11, 'abc', '2022-12-06 07:38:26', '2022-12-06 07:38:26'),
(12, 'testing', '2022-12-06 07:38:26', '2022-12-06 07:38:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `role` int(11) DEFAULT NULL COMMENT '1=admin,2=branch,3=employee',
  `branch_id` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `showpasssword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `leave_policy_id` int(11) DEFAULT NULL,
  `weekoff_id` int(11) DEFAULT NULL,
  `punch_in` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `punch_out` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `branch_id`, `email`, `name`, `number`, `password`, `showpasssword`, `status`, `leave_policy_id`, `weekoff_id`, `punch_in`, `punch_out`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'admin@adco.com', 'Admin', '0123456789', '$2y$10$VOxgLXE6eYe2lH0TdBL52uzSvc4FjVdRq0qv8HWMagHjg4734VUi.', 'admin@123', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 2, NULL, 'branch1@gmail.com', 'Branch1', '1234567890', '$2y$10$0QEarYKHhIRpe.PGSilpgO1pp/07ACKk2DOApCwS7hO5DzVjzCv.m', '123456', 1, NULL, NULL, NULL, NULL, NULL, '2022-11-23 03:37:06', '2022-11-23 03:37:06'),
(3, 2, NULL, 'branch2@gmail.com', 'Branch2', '8978609213', '$2y$10$xb9u/psdAD98MLyPok7X3OWNXk6sSwOD7U/0lP.KE5UowIOii6e7i', '123456', 1, NULL, NULL, NULL, NULL, NULL, '2022-11-23 03:40:51', '2022-11-23 03:40:51'),
(4, 3, 3, 'ali@adco.com', 'Ali', '1234567890', '$2y$10$mQjOv9mXaM4HO1BQtStlJ.CDi4e6DsGXe/ks72gh40D2Z7lda0GvC', '123456', 1, 2, 2, NULL, NULL, NULL, '2022-11-23 03:42:10', '2022-12-13 05:02:14'),
(5, 3, 2, 'bhagvat@adco.com', 'Bhagvat', '1212121212', '$2y$10$F04x3WtDomEgXAnh1qqfMu2c75W8PHv/iX8V0zluHkuDwUCBDAH2W', '123456', 1, 1, 4, NULL, NULL, NULL, '2022-11-23 03:42:36', '2022-12-22 10:34:02'),
(6, 2, NULL, 'test@gmail.com', 'Testing', '1234567890', '$2y$10$P/0ORdD/Qx7Blq68zFTRUO8VcX61uieyiEyHh8IDPjuOjOXmXOU0a', '12345678', 1, NULL, NULL, NULL, NULL, NULL, '2022-12-06 03:58:27', '2022-12-06 03:58:54'),
(7, 2, NULL, 'testing@gmail.com', 'Bhoomika', '3545634354', '$2y$10$w4Gx9LRLw8jVT/JXCrz78.EyM1HUcQbhPRDBPMy7GGW0.QGzZouJe', '123456', 1, NULL, NULL, NULL, NULL, NULL, '2022-12-06 04:17:20', '2022-12-06 04:18:02'),
(8, 3, 3, 'abc@gmail.com', 'Testing', '1234567890', '$2y$10$II8WL.QBtgEKKv4oxDxTeOKcWd9JQNPAwoFKclk1SIbfUtw4/TbSq', '123456', 1, NULL, NULL, NULL, NULL, NULL, '2022-12-06 04:29:11', '2022-12-06 04:30:29'),
(9, 2, NULL, 'delete@adco.com', 'Branch delete', '1212121212', '$2y$10$/spK9xUDUFPgQNsfYIVJ/.5xF8DipTwaNOPLeLIQ551JtQhcZWf2e', '123', 1, NULL, 3, NULL, NULL, NULL, '2022-12-08 03:42:50', '2022-12-10 04:40:08'),
(11, 3, 9, 'brdelete@adco.com', 'Br delete', '1111111111', '$2y$10$pgKbR51iX.znkgn9OHXSXuPqLx3/eUX345n6jrJiSExK3iNQLE3r6', '1234', 1, NULL, NULL, NULL, NULL, NULL, '2022-12-08 03:44:51', '2022-12-08 03:44:51'),
(12, 3, 2, 'bhoomi@gmail.com', 'Test', '2345533445', '$2y$10$PBVxqLOVYKEk3qzjjEgyZ.uzMRrkpxjrx2TlCzwoqMzVw4rl.N.i2', '123456', 1, 1, NULL, NULL, NULL, NULL, '2022-12-09 06:23:30', '2022-12-09 06:44:01'),
(13, 3, 9, 'xyz@adco.com', 'Xyz', '1313131313', '$2y$10$uCSimktk2fAudwnUPSgczugu2AM2OdPioiQW7Cm0jg7NPvI6H2VBa', '123456', 1, 2, 3, '10:00', '18:00', NULL, '2022-12-10 04:26:41', '2022-12-23 06:25:52');

-- --------------------------------------------------------

--
-- Table structure for table `weekoff`
--

CREATE TABLE `weekoff` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mon_type` int(11) NOT NULL DEFAULT 0 COMMENT '1=Full Day, 2=First Half, 3=Secound Half',
  `tue` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tue_type` int(11) NOT NULL DEFAULT 0 COMMENT '1=Full Day, 2=First Half, 3=Secound Half',
  `wed` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wed_type` int(11) NOT NULL DEFAULT 0 COMMENT '1=Full Day, 2=First Half, 3=Secound Half',
  `thu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thu_type` int(11) NOT NULL DEFAULT 0 COMMENT '1=Full Day, 2=First Half, 3=Secound Half',
  `fri` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fri_type` int(11) NOT NULL DEFAULT 0 COMMENT '1=Full Day, 2=First Half, 3=Secound Half',
  `sat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sat_type` int(11) NOT NULL DEFAULT 0 COMMENT '1=Full Day, 2=First Half, 3=Secound Half',
  `sun` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sun_type` int(11) NOT NULL DEFAULT 0 COMMENT '1=Full Day, 2=First Half, 3=Secound Half',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `weekoff`
--

INSERT INTO `weekoff` (`id`, `name`, `mon`, `mon_type`, `tue`, `tue_type`, `wed`, `wed_type`, `thu`, `thu_type`, `fri`, `fri_type`, `sat`, `sat_type`, `sun`, `sun_type`, `created_at`, `updated_at`) VALUES
(2, 'First half saturday', NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, 'Saturday', 2, NULL, 0, '2022-12-10 02:08:34', '2022-12-10 06:32:59'),
(3, 'Every sunday', NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, 'Sunday', 1, '2022-12-10 04:28:31', '2022-12-10 04:28:31'),
(4, 'First half Every thursday', NULL, 0, NULL, 0, NULL, 0, 'Thursday', 2, NULL, 0, NULL, 0, NULL, 0, '2022-12-22 10:33:28', '2022-12-22 10:33:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendance_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `bsrs`
--
ALTER TABLE `bsrs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bsrs_so_id_foreign` (`so_id`),
  ADD KEY `bsrs_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gst`
--
ALTER TABLE `gst`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holiday`
--
ALTER TABLE `holiday`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hsn`
--
ALTER TABLE `hsn`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hsn_gst_id_foreign` (`gst_id`);

--
-- Indexes for table `lead`
--
ALTER TABLE `lead`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lead_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `leave`
--
ALTER TABLE `leave`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leave_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `leave_child`
--
ALTER TABLE `leave_child`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leave_child_leave_id_foreign` (`leave_id`);

--
-- Indexes for table `leave_policy`
--
ALTER TABLE `leave_policy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_policy_child`
--
ALTER TABLE `leave_policy_child`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leave_policy_child_policy_id_foreign` (`policy_id`),
  ADD KEY `leave_policy_child_leave_type_id_foreign` (`leave_type_id`);

--
-- Indexes for table `leave_type`
--
ALTER TABLE `leave_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_gst_id_foreign` (`gst_id`),
  ADD KEY `products_sale_foreign` (`sale`),
  ADD KEY `products_purchase_foreign` (`purchase`),
  ADD KEY `products_gst_unit_foreign` (`gst_unit`);

--
-- Indexes for table `regularize`
--
ALTER TABLE `regularize`
  ADD PRIMARY KEY (`id`),
  ADD KEY `regularize_attendance_id_foreign` (`attendance_id`),
  ADD KEY `regularize_branch_id_foreign` (`branch_id`),
  ADD KEY `regularize_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `so`
--
ALTER TABLE `so`
  ADD PRIMARY KEY (`id`),
  ADD KEY `so_branch_id_foreign` (`branch_id`),
  ADD KEY `so_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `so_child`
--
ALTER TABLE `so_child`
  ADD PRIMARY KEY (`id`),
  ADD KEY `so_child_so_id_foreign` (`so_id`),
  ADD KEY `so_child_category_id_foreign` (`category_id`),
  ADD KEY `so_child_product_id_foreign` (`product_id`),
  ADD KEY `so_child_serial_id_foreign` (`serial_id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stocks_user_id_foreign` (`user_id`),
  ADD KEY `stocks_category_id_foreign` (`category_id`),
  ADD KEY `stocks_product_id_foreign` (`product_id`);

--
-- Indexes for table `stock_child`
--
ALTER TABLE `stock_child`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_child_stock_id_foreign` (`stock_id`),
  ADD KEY `stock_child_user_id_foreign` (`user_id`),
  ADD KEY `stock_child_category_id_foreign` (`category_id`),
  ADD KEY `stock_child_product_id_foreign` (`product_id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_assigned_by_foreign` (`assigned_by`),
  ADD KEY `task_assigned_to_branch_foreign` (`assigned_to_branch`),
  ADD KEY `task_assigned_to_employee_foreign` (`assigned_to_employee`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `weekoff`
--
ALTER TABLE `weekoff`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT for table `bsrs`
--
ALTER TABLE `bsrs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `group`
--
ALTER TABLE `group`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `gst`
--
ALTER TABLE `gst`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `holiday`
--
ALTER TABLE `holiday`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hsn`
--
ALTER TABLE `hsn`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `lead`
--
ALTER TABLE `lead`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `leave`
--
ALTER TABLE `leave`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `leave_child`
--
ALTER TABLE `leave_child`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `leave_policy`
--
ALTER TABLE `leave_policy`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `leave_policy_child`
--
ALTER TABLE `leave_policy_child`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `leave_type`
--
ALTER TABLE `leave_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `regularize`
--
ALTER TABLE `regularize`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `so`
--
ALTER TABLE `so`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `so_child`
--
ALTER TABLE `so_child`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `stock_child`
--
ALTER TABLE `stock_child`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `weekoff`
--
ALTER TABLE `weekoff`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bsrs`
--
ALTER TABLE `bsrs`
  ADD CONSTRAINT `bsrs_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bsrs_so_id_foreign` FOREIGN KEY (`so_id`) REFERENCES `so` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hsn`
--
ALTER TABLE `hsn`
  ADD CONSTRAINT `hsn_gst_id_foreign` FOREIGN KEY (`gst_id`) REFERENCES `gst` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lead`
--
ALTER TABLE `lead`
  ADD CONSTRAINT `lead_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `leave`
--
ALTER TABLE `leave`
  ADD CONSTRAINT `leave_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `leave_child`
--
ALTER TABLE `leave_child`
  ADD CONSTRAINT `leave_child_leave_id_foreign` FOREIGN KEY (`leave_id`) REFERENCES `leave` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `leave_policy_child`
--
ALTER TABLE `leave_policy_child`
  ADD CONSTRAINT `leave_policy_child_leave_type_id_foreign` FOREIGN KEY (`leave_type_id`) REFERENCES `leave_type` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `leave_policy_child_policy_id_foreign` FOREIGN KEY (`policy_id`) REFERENCES `leave_policy` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_gst_id_foreign` FOREIGN KEY (`gst_id`) REFERENCES `gst` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_gst_unit_foreign` FOREIGN KEY (`gst_unit`) REFERENCES `unit` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_purchase_foreign` FOREIGN KEY (`purchase`) REFERENCES `unit` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_sale_foreign` FOREIGN KEY (`sale`) REFERENCES `unit` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `regularize`
--
ALTER TABLE `regularize`
  ADD CONSTRAINT `regularize_attendance_id_foreign` FOREIGN KEY (`attendance_id`) REFERENCES `attendance` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `regularize_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `regularize_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `so`
--
ALTER TABLE `so`
  ADD CONSTRAINT `so_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `so_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `so_child`
--
ALTER TABLE `so_child`
  ADD CONSTRAINT `so_child_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `so_child_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `so_child_serial_id_foreign` FOREIGN KEY (`serial_id`) REFERENCES `stock_child` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `so_child_so_id_foreign` FOREIGN KEY (`so_id`) REFERENCES `so` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `stocks_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stocks_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stocks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stock_child`
--
ALTER TABLE `stock_child`
  ADD CONSTRAINT `stock_child_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stock_child_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stock_child_stock_id_foreign` FOREIGN KEY (`stock_id`) REFERENCES `stocks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stock_child_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_assigned_by_foreign` FOREIGN KEY (`assigned_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `task_assigned_to_branch_foreign` FOREIGN KEY (`assigned_to_branch`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `task_assigned_to_employee_foreign` FOREIGN KEY (`assigned_to_employee`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
