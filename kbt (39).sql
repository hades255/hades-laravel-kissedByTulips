-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 13, 2023 at 12:57 PM
-- Server version: 8.0.30
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kbt`
--

-- --------------------------------------------------------

--
-- Table structure for table `kbt_account`
--

CREATE TABLE `kbt_account` (
  `pk_account` bigint UNSIGNED NOT NULL,
  `business_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pk_states` int DEFAULT NULL,
  `zip` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pk_country` int DEFAULT NULL,
  `business_phone` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `state_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kbt_account`
--

INSERT INTO `kbt_account` (`pk_account`, `business_name`, `address`, `address_1`, `city`, `pk_states`, `zip`, `pk_country`, `business_phone`, `fax`, `business_email`, `website`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`, `state_name`, `country_name`) VALUES
(1, 'Superadmin', 'CA', 'CA1', 'CA', 6, '11232', 1, '2122122122', '2122122122', 'admin@gmail.com', 'admin.in', 1, NULL, NULL, '2022-12-04 07:54:17', '2022-12-04 07:54:17', NULL, NULL),
(2, 'KBT Newport Beach', '1838 Newport Blvd', NULL, 'Costa Mesa', NULL, '92627', 1, '(949) 287 6622', NULL, NULL, NULL, 1, 1, 1, '2022-12-05 02:50:14', '2023-01-09 07:45:59', NULL, NULL),
(11, 'businees test', 'address tes', NULL, 'Los Angele', NULL, '90000', 1, '0000000', NULL, NULL, NULL, 1, 1, 1, '2022-12-14 20:16:33', '2023-01-09 19:33:51', NULL, NULL),
(12, 'Hilton Los Angeles/Universal City', '555 Universal Hollywood Dr', NULL, 'Universal City', NULL, '91608', NULL, '8888888888', NULL, NULL, NULL, 1, 1, 1, '2022-12-14 21:08:40', '2022-12-14 21:08:40', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kbt_account_admin_payment_gateways`
--

CREATE TABLE `kbt_account_admin_payment_gateways` (
  `pk_account_admin_payment_gateways` bigint UNSIGNED NOT NULL,
  `pk_users` int DEFAULT NULL,
  `pk_account` int DEFAULT NULL,
  `merchant_login_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `merchant_transaction_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kbt_account_admin_payment_gateways`
--

INSERT INTO `kbt_account_admin_payment_gateways` (`pk_account_admin_payment_gateways`, `pk_users`, `pk_account`, `merchant_login_id`, `merchant_transaction_key`, `other_key`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 6, 2, '4Y5pCy8Qr', '4ke43FW8z3287HV5', NULL, '1', 6, 6, '2023-02-24 02:56:34', '2023-02-24 02:56:34'),
(3, 2, 1, 'test', 'testkry', 'keyy', '1', 2, 2, '2023-02-25 13:45:29', '2023-02-25 13:45:51');

-- --------------------------------------------------------

--
-- Table structure for table `kbt_acknowledgments`
--

CREATE TABLE `kbt_acknowledgments` (
  `pk_acknowledgments` bigint NOT NULL,
  `message_code` varchar(40) DEFAULT NULL,
  `message_type` enum('success','info','danger','warning') NOT NULL DEFAULT 'info',
  `message` varchar(500) NOT NULL,
  `created_by` bigint DEFAULT NULL,
  `updated_by` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kbt_acknowledgments`
--

INSERT INTO `kbt_acknowledgments` (`pk_acknowledgments`, `message_code`, `message_type`, `message`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'CUSTOMER_CREATE_ORDER', 'success', 'Your order has been created successfully.', 1, 1, NULL, NULL),
(2, 'CREATE_VENDOR_ORDER', 'success', 'Vendor order has been created successfully', 1, 1, NULL, NULL),
(3, 'UPDATE_VENDOR_ORDER', 'success', 'Vendor order has been updated successfully', NULL, NULL, NULL, NULL),
(4, 'DELETE_VENDOR_ORDER', 'success', 'Vendor order has been deleted successfully', NULL, NULL, NULL, NULL),
(5, 'EXCEPTION_MESSAGE', 'danger', 'Sorry! something went wrong please try again later.', NULL, NULL, NULL, NULL),
(14, 'ORDER_STATUS_UPDATE', 'success', 'Order status has been updated successfully.', NULL, NULL, NULL, NULL),
(15, 'ORDER_CANCEL_BY_ADMIN', 'success', 'Order has been cancelled successfully', NULL, NULL, NULL, NULL),
(16, 'CUSTOMER_CREATE_ORDER_THANKYOU', 'success', 'Thank You!', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kbt_address_type`
--

CREATE TABLE `kbt_address_type` (
  `pk_address_type` bigint NOT NULL,
  `address_type` varchar(100) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint DEFAULT NULL,
  `updated_by` bigint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kbt_address_type`
--

INSERT INTO `kbt_address_type` (`pk_address_type`, `address_type`, `updated_at`, `created_at`, `created_by`, `updated_by`) VALUES
(1, 'primary', NULL, NULL, NULL, NULL),
(2, 'billing', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kbt_arrangement_type`
--

CREATE TABLE `kbt_arrangement_type` (
  `pk_arrangement_type` bigint UNSIGNED NOT NULL,
  `pk_account` bigint UNSIGNED NOT NULL,
  `arrangement_type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `minimum_amount` int DEFAULT NULL,
  `maximum_amount` int DEFAULT NULL,
  `description` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(15,2) DEFAULT '0.00',
  `active` tinyint NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kbt_arrangement_type`
--

INSERT INTO `kbt_arrangement_type` (`pk_arrangement_type`, `pk_account`, `arrangement_type`, `minimum_amount`, `maximum_amount`, `description`, `price`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'Classis', NULL, NULL, NULL, '0.00', 1, 2, 2, '2023-02-08 18:05:59', '2023-02-08 18:05:59'),
(2, 1, 'Deluxe', NULL, NULL, NULL, '0.00', 1, 2, 2, '2023-02-08 18:06:09', '2023-02-08 18:06:09'),
(3, 1, 'Premium', NULL, NULL, NULL, '0.00', 1, 2, 2, '2023-02-08 18:06:18', '2023-02-08 18:06:18'),
(4, 1, 'Custom', 5, 20, NULL, NULL, 1, 2, 2, '2023-02-08 18:06:27', '2023-07-31 11:02:33'),
(5, 2, 'Classic', NULL, NULL, NULL, NULL, 1, 6, 6, '2023-02-08 22:59:35', '2023-03-09 23:07:18'),
(6, 2, 'Deluxe', NULL, NULL, NULL, '0.00', 1, 6, 6, '2023-02-08 22:59:44', '2023-02-08 22:59:44'),
(7, 2, 'Premium', NULL, NULL, NULL, '0.00', 1, 6, 6, '2023-02-08 23:00:06', '2023-02-08 23:00:06'),
(8, 2, 'Custom', 100, 300, NULL, NULL, 1, 6, 6, '2023-02-08 23:00:11', '2023-08-01 05:34:42');

-- --------------------------------------------------------

--
-- Table structure for table `kbt_cities`
--

CREATE TABLE `kbt_cities` (
  `pk_cities` int UNSIGNED NOT NULL,
  `city` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pk_county` tinyint UNSIGNED DEFAULT NULL,
  `pk_states` smallint UNSIGNED DEFAULT NULL,
  `header` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `h2_tags` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `search_tags` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `keywords` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kbt_cities`
--

INSERT INTO `kbt_cities` (`pk_cities`, `city`, `pk_county`, `pk_states`, `header`, `h2_tags`, `search_tags`, `keywords`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Agoura Hills', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(2, 'Alhambra', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(3, 'Arcadia', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(4, 'Artesia', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(5, 'Avalon', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(6, 'Azusa', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(7, 'Baldwin Park', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(8, 'Bell', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(9, 'Bell Gardens', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(10, 'Bellflower', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(11, 'Beverly Hills', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(12, 'Bradbury', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(13, 'Burbank', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(14, 'Calabasas', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(15, 'Carson', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(16, 'Cerritos', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(17, 'Claremont', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(18, 'Commerce', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(19, 'Compton', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(20, 'Covina', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(21, 'Cudahy', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(22, 'Culver City', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(23, 'Diamond Bar', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(24, 'Downey', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(25, 'Duarte', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(26, 'El Monte', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(27, 'El Segundo', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(28, 'Gardena', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(29, 'Glendale', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(30, 'Glendora', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(31, 'Hawaiian Gardens', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(32, 'Hawthorne', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(33, 'Hermosa Beach', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(34, 'Hidden Hills', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(35, 'Huntington Park', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(36, 'Industry', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(37, 'Inglewood', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(38, 'Irwindale', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(39, 'La Cañada Flintridge', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(40, 'La Habra Heights', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(41, 'La Mirada', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(42, 'La Puente', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(43, 'La Verne', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(44, 'Lakewood', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(45, 'Lancaster', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(46, 'Lawndale', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(47, 'Lomita', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(48, 'Long Beach', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(49, 'Los Angeles', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(50, 'Lynwood', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(51, 'Malibu', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(52, 'Manhattan Beach', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(53, 'Maywood', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(54, 'Monrovia', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(55, 'Montebello', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(56, 'Monterey Park', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(57, 'Norwalk', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(58, 'Palmdale', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(59, 'Palos Verdes Estates', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(60, 'Paramount', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(61, 'Pasadena', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(62, 'Pico Rivera', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(63, 'Pomona', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(64, 'Rancho Palos Verdes', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(65, 'Redondo Beach', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(66, 'Rolling Hills', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(67, 'Rolling Hills Estates', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(68, 'Rosemead', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(69, 'San Dimas', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(70, 'San Fernando', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(71, 'San Gabriel', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(72, 'San Marino', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(73, 'Santa Clarita', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(74, 'Santa Fe Springs', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(75, 'Santa Monica', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(76, 'Sierra Madre', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(77, 'Signal Hill', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(78, 'South El Monte', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(79, 'South Gate', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(80, 'South Pasadena', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(81, 'Temple City', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(82, 'Torrance', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(83, 'Vernon', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(84, 'Walnut', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(85, 'West Covina', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(86, 'West Hollywood', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(87, 'Westlake Village', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(88, 'Whittier', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(89, 'Aliso Viejo', 2, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(90, 'Anaheim', 2, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(91, 'Brea', 2, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(92, 'Buena Park', 2, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(93, 'Costa Mesa', 2, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(94, 'Cypress', 2, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(95, 'Dana Point', 2, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(96, 'Fountain Valley', 2, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(97, 'Fullerton', 2, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(98, 'Garden Grove', 2, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(99, 'Huntington Beach', 2, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(100, 'Irvine', 2, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(101, 'La Habra', 2, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(102, 'La Palma', 2, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(103, 'Laguna Beach', 2, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(104, 'Laguna Hills', 2, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(105, 'Laguna Niguel', 2, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(106, 'Laguna Woods', 2, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(107, 'Lake Forest', 2, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(108, 'Los Alamitos', 2, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(109, 'Mission Viejo', 2, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(110, 'Newport Beach', 2, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(111, 'Orange', 2, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(112, 'Placentia', 2, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(113, 'Rancho Santa Margarita', 2, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(114, 'San Clemente', 2, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(115, 'San Juan Capistrano', 2, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(116, 'Santa Ana', 2, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(117, 'Seal Beach', 2, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(118, 'Stanton', 2, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(119, 'Tustin', 2, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(120, 'Villa Park', 2, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(121, 'Westminster', 2, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05'),
(122, 'Yorba Linda', 2, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-26 13:50:17', '2023-07-27 06:11:05');

-- --------------------------------------------------------

--
-- Table structure for table `kbt_color_flower`
--

CREATE TABLE `kbt_color_flower` (
  `pk_color_flower` bigint UNSIGNED NOT NULL,
  `pk_account` bigint UNSIGNED NOT NULL,
  `color_flower` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kbt_color_flower`
--

INSERT INTO `kbt_color_flower` (`pk_color_flower`, `pk_account`, `color_flower`, `description`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 2, 'Red', NULL, 1, 6, 6, '2023-01-12 22:12:38', '2023-01-12 22:12:38'),
(2, 2, 'Green', NULL, 1, NULL, NULL, NULL, NULL),
(5, 1, 'testg', 'dnuull', 0, 2, 2, '2023-01-17 07:34:44', '2023-01-17 10:11:31');

-- --------------------------------------------------------

--
-- Table structure for table `kbt_comment`
--

CREATE TABLE `kbt_comment` (
  `pk_comment` bigint UNSIGNED NOT NULL,
  `pk_account` bigint UNSIGNED NOT NULL,
  `pk_vendors` bigint DEFAULT NULL,
  `pk_customers` bigint DEFAULT NULL,
  `comments` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kbt_comment`
--

INSERT INTO `kbt_comment` (`pk_comment`, `pk_account`, `pk_vendors`, `pk_customers`, `comments`, `contact_name`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(3, 1, NULL, 2, 'newedittest', 'test', 1, 2, 2, '2022-12-13 04:15:20', '2022-12-13 14:05:06'),
(4, 1, NULL, 2, 'business    done', 'comment', 1, 2, 2, '2022-12-13 04:15:51', '2022-12-13 04:17:48'),
(6, 2, NULL, 14, 'Why is this company not releasing payment, someone to speak to them', NULL, 1, 6, 6, '2022-12-13 16:42:54', '2022-12-13 16:42:54'),
(10, 2, NULL, 10, 'testing comments', NULL, 1, 6, 6, '2022-12-25 02:56:12', '2022-12-25 02:56:12'),
(11, 2, 11, NULL, 'This vendor is not prompt in supplies', NULL, 1, 6, 6, '2023-01-09 08:21:36', '2023-01-09 08:21:36'),
(12, 2, NULL, 31, 'testing comments for cusbus', NULL, 1, 6, 6, '2023-01-09 08:30:45', '2023-01-09 08:30:45'),
(13, 1, NULL, 10, 'test', 'Ramesh Ramesh', 1, 2, 2, '2023-01-09 16:11:55', '2023-01-09 16:11:55'),
(17, 2, NULL, 7, 'Testing this after making changes', 'Tim Childress', 1, 6, 6, '2023-01-11 05:56:33', '2023-01-11 05:56:33'),
(20, 2, NULL, 36, 'what is the payment status?', 'Tim Childress', 1, 6, 6, '2023-01-17 23:08:23', '2023-01-17 23:08:23'),
(21, 1, NULL, 31, 'tet', 'Ramesh Ramesh', 1, 2, 2, '2023-01-18 15:55:02', '2023-01-18 15:55:02'),
(23, 2, 15, NULL, 'another test', 'Tim Childress', 1, 6, 6, '2023-01-22 06:02:16', '2023-01-22 06:02:16'),
(25, 1, 17, NULL, 'test', 'Ramesh Ramesh', 1, 2, 2, '2023-01-23 11:48:04', '2023-01-23 11:48:04'),
(26, 1, 17, NULL, 'test', 'Ramesh Ramesh', 1, 2, 2, '2023-01-23 11:51:29', '2023-01-23 11:51:29'),
(27, 1, 17, NULL, 'test', 'Ramesh Ramesh', 1, 2, 2, '2023-01-23 11:53:23', '2023-01-23 11:53:23'),
(28, 1, 17, NULL, 'test', 'Ramesh Ramesh', 1, 2, 2, '2023-01-23 11:54:45', '2023-01-23 11:54:45'),
(29, 1, NULL, 39, 'hyyu', 'Ramesh Ramesh', 1, 2, 2, '2023-01-23 19:04:44', '2023-01-23 19:04:44'),
(30, 1, NULL, 39, 'hyyu', 'Ramesh Ramesh', 1, 2, 2, '2023-01-23 19:09:46', '2023-01-23 19:09:46'),
(32, 1, NULL, 100, 'fadsfads', 'Ramesh Ramesh', 1, 2, 2, '2023-08-09 07:17:50', '2023-08-09 07:17:50'),
(33, 1, NULL, 1, 'tesr g', 'Ramesh Ramesh', 1, 2, 2, '2023-08-11 18:25:58', '2023-08-11 18:25:58'),
(34, 1, NULL, 1, 'tesr g', 'Ramesh Ramesh', 1, 2, 2, '2023-08-11 18:26:21', '2023-08-11 18:26:21'),
(35, 1, NULL, NULL, 'gori test', 'Ramesh Ramesh', 1, 2, 2, '2023-08-11 18:26:37', '2023-08-11 18:26:37'),
(36, 2, NULL, 5, 'test coment 08/11', 'Tim Childress', 1, 122, 122, '2023-08-11 21:20:56', '2023-08-11 21:20:56'),
(37, 2, NULL, 5, 'test coment 08/11', 'Tim Childress', 1, 122, 122, '2023-08-11 21:21:12', '2023-08-11 21:21:12'),
(38, 2, NULL, 7, 'This is a test address', 'Tim Childress', 1, 122, 122, '2023-08-11 22:21:29', '2023-08-11 22:21:29'),
(39, 1, NULL, 8, 'twst', 'Ramesh Ramesh', 1, 2, 2, '2023-08-12 06:10:00', '2023-08-12 06:10:00'),
(40, 1, NULL, 9, 'ji', 'Ramesh Ramesh', 1, 2, 2, '2023-08-12 19:13:27', '2023-08-12 19:13:27'),
(41, 1, NULL, 9, 'new', 'Ramesh Ramesh', 1, 2, 2, '2023-08-12 19:14:01', '2023-08-12 19:14:01');

-- --------------------------------------------------------

--
-- Table structure for table `kbt_country`
--

CREATE TABLE `kbt_country` (
  `pk_country` bigint UNSIGNED NOT NULL,
  `country_code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_name` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kbt_country`
--

INSERT INTO `kbt_country` (`pk_country`, `country_code`, `country_name`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'USA', 'United States', 1, NULL, NULL, '2022-12-04 07:54:17', '2022-12-04 07:54:17');

-- --------------------------------------------------------

--
-- Table structure for table `kbt_county`
--

CREATE TABLE `kbt_county` (
  `pk_county` int UNSIGNED NOT NULL,
  `pk_states` smallint UNSIGNED NOT NULL,
  `county` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kbt_county`
--

INSERT INTO `kbt_county` (`pk_county`, `pk_states`, `county`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 5, 'Los Angeles', NULL, '2023-07-26 13:29:28', '2023-07-27 06:11:18'),
(2, 5, 'Orange', NULL, '2023-07-26 13:29:28', '2023-07-27 06:11:18');

-- --------------------------------------------------------

--
-- Table structure for table `kbt_coupons`
--

CREATE TABLE `kbt_coupons` (
  `pk_coupons` bigint UNSIGNED NOT NULL,
  `pk_account` bigint NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_amount` double(8,2) NOT NULL,
  `quantity` int DEFAULT NULL,
  `used` tinyint DEFAULT NULL,
  `type` enum('percent','fixed') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `start_at` date DEFAULT NULL,
  `expire_at` date DEFAULT NULL,
  `created_by` bigint DEFAULT NULL,
  `updated_by` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kbt_coupons`
--

INSERT INTO `kbt_coupons` (`pk_coupons`, `pk_account`, `title`, `code`, `discount_amount`, `quantity`, `used`, `type`, `active`, `start_at`, `expire_at`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 2, 'Spring 2023', 'AZC54F', 20.00, 4, NULL, 'fixed', 1, '2023-02-17', '2023-02-23', 2, 6, '2023-02-12 11:38:17', '2023-02-27 19:44:12'),
(2, 2, 'New Customer', 'AZC544', 20.00, 2, NULL, 'percent', 1, '2023-02-15', '2023-02-23', 2, 6, '2023-02-27 06:39:31', '2023-02-27 19:44:27'),
(3, 2, 'Students', 'STU10', 10.00, 10, NULL, 'percent', 1, '2023-04-17', '2023-04-24', 6, 6, '2023-04-17 22:11:21', '2023-04-17 22:11:21'),
(4, 2, 'Student dollar', 'STU$10', 10.00, 10, NULL, 'fixed', 1, '2023-04-17', '2023-04-24', 6, 6, '2023-04-17 22:12:17', '2023-04-17 22:12:17');

-- --------------------------------------------------------

--
-- Table structure for table `kbt_customers`
--

CREATE TABLE `kbt_customers` (
  `pk_customers` bigint UNSIGNED NOT NULL,
  `pk_account` bigint UNSIGNED NOT NULL,
  `customer_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pk_customer_type` bigint DEFAULT NULL,
  `business_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `office_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login_enable` tinyint NOT NULL DEFAULT '0',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `active` tinyint NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kbt_customers`
--

INSERT INTO `kbt_customers` (`pk_customers`, `pk_account`, `customer_name`, `website`, `pk_customer_type`, `business_name`, `office_phone`, `email`, `login_enable`, `created_by`, `updated_by`, `created_at`, `updated_at`, `active`) VALUES
(2, 2, 'Daniel', NULL, 1, NULL, '1112223333', 'emaildaniel@email.com', 1, 122, 122, '2023-08-11 18:29:49', '2023-08-11 20:36:01', 1),
(5, 1, 'sure', NULL, 1, NULL, '8989898989', 'sure@gmail.com', 1, 2, 2, '2023-08-11 18:57:30', '2023-08-11 18:57:46', 1),
(6, 2, 'test customer 2', NULL, 1, NULL, '3105604947', 'bemarconato@hotmail.com', 0, 122, 122, '2023-08-11 19:48:17', '2023-08-11 19:48:17', 1),
(7, 2, 'Jason Bourne', NULL, 1, NULL, NULL, 'jason@bourne.com', 1, 122, 122, '2023-08-11 22:20:37', '2023-08-11 22:20:37', 1),
(8, 2, 'gup ta', NULL, 1, NULL, NULL, 'gup@gmail.com', 1, 134, 134, '2023-08-12 06:07:29', '2023-08-12 06:07:29', 1),
(9, 2, 'tyu jk', NULL, 1, NULL, '7878787885', 'tyu@gmail.com', 1, NULL, NULL, '2023-08-12 18:49:29', '2023-08-12 18:49:29', 1),
(10, 1, 'ji', NULL, 4, NULL, '8989898989', 'jilk@gmail.com', 0, 2, 2, '2023-08-12 19:46:06', '2023-08-12 19:46:06', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kbt_customer_address`
--

CREATE TABLE `kbt_customer_address` (
  `pk_customer_address` bigint UNSIGNED NOT NULL,
  `pk_customers` bigint DEFAULT NULL,
  `pk_address_type` bigint NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_1` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pk_states` bigint DEFAULT NULL,
  `pk_country` bigint NOT NULL,
  `zip` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kbt_customer_address`
--

INSERT INTO `kbt_customer_address` (`pk_customer_address`, `pk_customers`, `pk_address_type`, `address`, `address_1`, `city`, `pk_states`, `pk_country`, `zip`, `lat`, `lng`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 39, 0, '2525A Holly Hall Street', '2525A', 'Houston', 0, 1, '77054', 29.6857411, -95.38726369999999, 2, 2, '2023-02-17 12:53:01', '2023-02-17 12:53:01'),
(2, 31, 0, '252', NULL, 'test', 0, 1, '2525', NULL, NULL, 2, 2, '2023-04-11 04:58:21', '2023-04-11 04:58:21'),
(3, 41, 0, '6404 South Pacific Coast Highway', 'apt 2', 'Redondo Beach', 0, 1, '90277', NULL, NULL, 6, 6, '2023-07-19 23:58:55', '2023-07-19 23:58:55'),
(4, 42, 0, '6206 South Pacific Coast Highway, Redondo Beach, CA, USA', NULL, 'Redondo Beach', 0, 1, '90277', NULL, NULL, 6, 6, '2023-07-19 23:59:23', '2023-07-19 23:59:23'),
(5, 94, 1, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, '2023-08-07 19:17:36', '2023-08-07 19:17:36'),
(6, 94, 2, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, '2023-08-07 19:17:36', '2023-08-07 19:17:36'),
(9, 96, 1, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, '2023-08-08 01:31:55', '2023-08-08 01:31:55'),
(10, 96, 2, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, '2023-08-08 01:31:55', '2023-08-08 01:31:55'),
(11, 97, 2, '123 William Street', '263 North Rocky New Parkw', 'New York', 1, 1, '10038', NULL, NULL, NULL, NULL, '2023-08-08 05:20:32', '2023-08-08 05:20:32'),
(12, 98, 2, '123 William Street', '963 West White Milton Dri', 'New York', 1, 1, '10038', NULL, NULL, NULL, NULL, '2023-08-08 05:25:54', '2023-08-08 05:25:54'),
(13, 99, 2, '123 William Street', '393 First Freeway', 'New York', 1, 1, '10038', NULL, NULL, NULL, NULL, '2023-08-08 05:32:56', '2023-08-08 05:32:56'),
(14, 100, 1, '456 Camino de Gloria', '456', 'Walnut', 1, 1, '91789', 34.0091737, -117.8690316, 2, 2, '2023-08-09 07:10:32', '2023-08-09 07:17:05'),
(15, 100, 2, 'Cedar Park', 'Updated', 'Cedar Park', 1, 1, '78613', 30.5119418, -97.8177601, 2, 2, '2023-08-09 07:11:48', '2023-08-09 07:17:23'),
(16, 101, 1, '123 William Street', '123', 'New York', 1, 1, '10038', 40.7094756, -74.0072955, 2, 2, '2023-08-09 07:41:14', '2023-08-09 07:41:14'),
(17, 101, 1, '456 Washington Street', '456', 'New York', 1, 1, '10013', 40.7243799, -74.01072719999999, 2, 2, '2023-08-09 07:41:30', '2023-08-09 07:41:30'),
(18, 102, 1, '123 William Street', '456', 'New York', 1, 1, '10038', 40.7094756, -74.0072955, 2, 2, '2023-08-09 08:28:59', '2023-08-09 08:29:09'),
(19, 103, 1, '123 William Street', '123', 'New York', 1, 1, '10038', 40.7094756, -74.0072955, 2, 2, '2023-08-09 08:32:25', '2023-08-09 08:32:25'),
(20, 104, 1, '123 William Street', NULL, 'New York', 1, 1, '10038', NULL, NULL, NULL, NULL, '2023-08-10 14:08:07', '2023-08-10 14:08:07'),
(21, 104, 2, '123 William Street', NULL, 'New York', 1, 1, '10038', NULL, NULL, NULL, NULL, '2023-08-10 14:08:07', '2023-08-10 14:08:07'),
(22, 105, 1, '5525 Etiwanda Avenue', '96 Oak Avenue', 'Los Angeles', 5, 1, '91356', NULL, NULL, NULL, NULL, '2023-08-10 14:11:19', '2023-08-10 14:11:19'),
(23, 105, 2, '5525 Etiwanda Avenue', '130 South Oak Extension', 'Los Angeles', 5, 1, '91356', NULL, NULL, NULL, NULL, '2023-08-10 14:11:19', '2023-08-10 14:11:19'),
(24, 95, 1, '5525 Etiwanda Avenue', '5525', 'Los Angeles', 5, 1, '91356', 34.1705421, -118.531104, 2, 2, '2023-08-10 14:24:05', '2023-08-10 14:24:05'),
(25, 107, 1, '123 William Street', NULL, 'New York', 1, 1, '10038', NULL, NULL, NULL, NULL, '2023-08-11 13:37:35', '2023-08-11 13:37:35'),
(26, 107, 2, '12400 Imperial Highway', NULL, 'Norwalk', 5, 1, '90650', NULL, NULL, NULL, NULL, '2023-08-11 13:37:35', '2023-08-11 13:37:35'),
(27, 108, 1, '8586 Bird Road', '8586', 'Miami', 10, 1, '33155', 25.7329026, -80.3345137, 2, 2, '2023-08-11 13:40:59', '2023-08-11 13:40:59'),
(28, 109, 1, '1234', '11', 'New York', 1, 1, '110044', NULL, NULL, NULL, NULL, '2023-08-11 17:17:02', '2023-08-11 17:17:02'),
(29, 109, 2, '123', '122444', 'California', 1, 1, '1144444', NULL, NULL, NULL, NULL, '2023-08-11 17:17:02', '2023-08-11 17:17:02'),
(30, 1, 1, '6868 Springfield Boulevard', '6868', 'Springfield', 1, 1, '22150', 38.7771643, -77.1830016, 2, 2, '2023-08-11 18:16:17', '2023-08-11 18:16:17'),
(31, 2, 1, '6404 Utah st', '3', 'Los Angeles', 5, 1, '90000', NULL, NULL, 122, 122, '2023-08-11 18:32:40', '2023-08-11 18:32:40'),
(32, 5, 1, 'New York', NULL, 'New York', 1, 1, '10106', 40.76548630000001, -73.9808532, 2, 2, '2023-08-11 18:58:07', '2023-08-11 18:58:07'),
(33, 7, 1, '11133 Balboa Boulevard', '11133', 'Los Angeles', 5, 1, '91344', 34.2728717, -118.5036953, 122, 122, '2023-08-12 05:42:52', '2023-08-12 05:42:52'),
(34, 9, 1, '123 William Street', NULL, 'New York', 1, 1, '10038', NULL, NULL, NULL, NULL, '2023-08-12 18:49:29', '2023-08-12 18:49:29'),
(35, 9, 2, '450 Sutter Street', NULL, 'San Francisco', 5, 1, '94108', NULL, NULL, NULL, NULL, '2023-08-12 18:49:29', '2023-08-12 18:49:29'),
(36, 10, 1, '8586 Bird Road', '8586', 'Miami', 10, 1, '33155', 25.7329026, -80.3345137, 2, 2, '2023-08-12 19:46:06', '2023-08-12 19:46:06'),
(37, 10, 1, '8586', NULL, NULL, 1, 1, NULL, 0, 0, 2, 2, '2023-08-12 19:46:29', '2023-08-12 19:46:29'),
(38, 10, 1, '8586 Bird Road', '8586', 'Miami', 0, 0, '33155', NULL, NULL, 2, 2, '2023-08-12 19:46:37', '2023-08-12 19:46:37'),
(39, 10, 1, '8586 Bird Road', '8586', 'Miami', 0, 0, '33155', NULL, NULL, 2, 2, '2023-08-12 19:46:54', '2023-08-12 19:46:54');

-- --------------------------------------------------------

--
-- Table structure for table `kbt_customer_contacts`
--

CREATE TABLE `kbt_customer_contacts` (
  `pk_customer_contacts` bigint UNSIGNED NOT NULL,
  `pk_account` bigint UNSIGNED NOT NULL,
  `pk_customers` bigint UNSIGNED NOT NULL,
  `contact_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pk_department` bigint DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pk_states` bigint DEFAULT NULL,
  `zip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pk_country` bigint DEFAULT NULL,
  `office_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login_enable` tinyint NOT NULL DEFAULT '0',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kbt_customer_contacts`
--

INSERT INTO `kbt_customer_contacts` (`pk_customer_contacts`, `pk_account`, `pk_customers`, `contact_name`, `title`, `pk_department`, `address`, `address_1`, `city`, `pk_states`, `zip`, `pk_country`, `office_phone`, `email`, `login_enable`, `created_by`, `updated_by`, `active`, `created_at`, `updated_at`) VALUES
(1, 1, 8, 'stdm', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, 2, 1, '2022-12-12 06:04:03', '2022-12-12 06:04:03'),
(2, 1, 11, 'testing', NULL, 1, 'test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, 2, 1, '2022-12-12 06:28:43', '2022-12-12 07:52:21'),
(3, 1, 11, 'testing', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, 2, 1, '2022-12-12 06:54:24', '2022-12-12 06:54:24'),
(4, 1, 6, 'Newport Beach', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, 2, 1, '2022-12-12 13:45:44', '2022-12-12 13:45:44'),
(5, 2, 14, 'James Wood', 'Manager', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 6, 6, 1, '2022-12-13 16:42:25', '2022-12-13 16:42:25'),
(6, 1, 12, 'customercontact4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, 2, 1, '2022-12-13 17:42:45', '2022-12-13 17:42:45'),
(7, 1, 16, 'ddsd', 'test', NULL, NULL, NULL, NULL, 2, '25255', NULL, NULL, NULL, 0, 2, 2, 1, '2022-12-13 20:01:59', '2022-12-13 20:02:18'),
(8, 1, 34, 'nnn', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, 2, 1, '2023-01-10 14:15:24', '2023-01-10 14:15:58'),
(10, 1, 10, 'new', 'haibilk', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, 2, 1, '2023-08-12 19:46:29', '2023-08-12 19:46:29');

-- --------------------------------------------------------

--
-- Table structure for table `kbt_customer_location_types`
--

CREATE TABLE `kbt_customer_location_types` (
  `pk_customer_location_types` bigint UNSIGNED NOT NULL,
  `customer_location_types` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kbt_customer_location_types`
--

INSERT INTO `kbt_customer_location_types` (`pk_customer_location_types`, `customer_location_types`, `description`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Apartment', NULL, 1, 2, 1, '2023-02-09 19:35:18', '2023-02-14 19:06:09'),
(2, 'Assisted Living', NULL, 1, 2, 1, '2023-02-09 19:35:32', '2023-02-14 19:05:59'),
(3, 'Business', NULL, 1, 2, 1, '2023-02-09 19:35:55', '2023-02-14 19:05:43'),
(4, 'Home', NULL, 1, 2, 1, '2023-02-09 19:36:15', '2023-02-14 19:05:36'),
(5, 'Hospital', NULL, 1, 2, 1, '2023-02-09 19:36:33', '2023-02-14 19:05:23'),
(6, 'Hotel', NULL, 1, 2, 1, '2023-02-09 19:36:56', '2023-02-14 19:05:16'),
(8, 'Apartment', NULL, 1, 1, 1, '2023-02-19 12:44:32', '2023-02-19 12:44:32');

-- --------------------------------------------------------

--
-- Table structure for table `kbt_customer_type`
--

CREATE TABLE `kbt_customer_type` (
  `pk_customer_type` bigint UNSIGNED NOT NULL,
  `pk_account` bigint UNSIGNED NOT NULL,
  `customer_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_type_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kbt_customer_type`
--

INSERT INTO `kbt_customer_type` (`pk_customer_type`, `pk_account`, `customer_type`, `customer_type_code`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 2, 'Direct Customer', 'DC', 1, NULL, NULL, '2022-12-07 11:33:08', '2022-12-07 11:33:08'),
(2, 2, 'Corporate Customer', 'CC', 1, NULL, NULL, '2022-12-07 11:33:08', '2022-12-07 11:33:08'),
(3, 2, 'Event Planners', 'EP', 1, NULL, NULL, '2022-12-07 11:33:08', '2022-12-07 11:33:08'),
(4, 2, 'Event Venues', ' EV', 1, NULL, NULL, '2022-12-07 11:33:08', '2022-12-07 11:33:08');

-- --------------------------------------------------------

--
-- Table structure for table `kbt_delivery_charges`
--

CREATE TABLE `kbt_delivery_charges` (
  `pk_delivery_charges` bigint UNSIGNED NOT NULL,
  `pk_account` bigint NOT NULL,
  `miles_from` bigint DEFAULT NULL,
  `miles_to` bigint DEFAULT NULL,
  `cost` decimal(15,2) DEFAULT '0.00',
  `active` tinyint NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kbt_delivery_charges`
--

INSERT INTO `kbt_delivery_charges` (`pk_delivery_charges`, `pk_account`, `miles_from`, `miles_to`, `cost`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 2, 0, 5, '4.00', 1, 6, 6, '2023-02-27 19:37:22', '2023-02-27 19:37:22'),
(2, 2, 6, 10, '6.00', 1, 6, 6, '2023-03-03 20:18:32', '2023-03-03 20:18:32'),
(3, 2, 11, 20, '8.00', 1, 6, 6, '2023-03-03 20:18:49', '2023-03-03 20:18:49'),
(4, 2, 20, 50, '10.00', 1, 6, 6, '2023-03-03 20:19:01', '2023-03-03 20:19:01'),
(5, 2, 1, 10000, '15.00', 1, 6, 6, '2023-03-03 20:19:16', '2023-03-03 20:19:16');

-- --------------------------------------------------------

--
-- Table structure for table `kbt_delivery_or_pickup`
--

CREATE TABLE `kbt_delivery_or_pickup` (
  `pk_delivery_or_pickup` bigint NOT NULL,
  `delivery_or_pickup` varchar(50) NOT NULL,
  `created_by` bigint DEFAULT NULL,
  `updated_by` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `active` tinyint NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kbt_delivery_or_pickup`
--

INSERT INTO `kbt_delivery_or_pickup` (`pk_delivery_or_pickup`, `delivery_or_pickup`, `created_by`, `updated_by`, `created_at`, `updated_at`, `active`) VALUES
(1, 'Delivery', 2, 2, '2023-08-08 08:07:35', '2023-08-08 08:07:52', 1),
(2, 'Store Pickup', 2, 2, '2023-08-08 08:08:07', '2023-08-08 08:08:09', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kbt_department`
--

CREATE TABLE `kbt_department` (
  `pk_department` bigint UNSIGNED NOT NULL,
  `pk_account` bigint UNSIGNED NOT NULL,
  `department` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kbt_department`
--

INSERT INTO `kbt_department` (`pk_department`, `pk_account`, `department`, `description`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'testi', NULL, 1, 2, 2, '2022-12-12 03:27:13', '2022-12-12 13:37:23'),
(3, 2, 'Accounting', NULL, 1, 6, 6, '2022-12-12 20:42:13', '2022-12-12 20:42:13'),
(4, 2, 'Administration', NULL, 1, 6, 6, '2022-12-14 01:29:17', '2022-12-14 01:29:17'),
(5, 2, 'Banquet Hall', NULL, 1, 6, 6, '2022-12-14 01:29:34', '2022-12-14 01:29:34');

-- --------------------------------------------------------

--
-- Table structure for table `kbt_email_account`
--

CREATE TABLE `kbt_email_account` (
  `pk_email_account` bigint NOT NULL,
  `pk_account` bigint NOT NULL,
  `host` varchar(250) NOT NULL,
  `port` varchar(250) NOT NULL,
  `user_name` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `encryption_type` varchar(150) NOT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `created_by` bigint DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kbt_email_template`
--

CREATE TABLE `kbt_email_template` (
  `pk_email_template` bigint NOT NULL,
  `pk_account` bigint NOT NULL,
  `template_name` varchar(250) NOT NULL,
  `pk_email_account` bigint NOT NULL,
  `subject` varchar(500) NOT NULL,
  `content` text NOT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `created_by` bigint DEFAULT NULL,
  `updated_by` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kbt_email_template`
--

INSERT INTO `kbt_email_template` (`pk_email_template`, `pk_account`, `template_name`, `pk_email_account`, `subject`, `content`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 1, 'test@gmail.com', 1, 'test', 'tst', 0, NULL, 2, NULL, '2023-01-27 19:03:43');

-- --------------------------------------------------------

--
-- Table structure for table `kbt_event`
--

CREATE TABLE `kbt_event` (
  `pk_event` bigint UNSIGNED NOT NULL,
  `pk_account` bigint UNSIGNED NOT NULL,
  `event` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kbt_event`
--

INSERT INTO `kbt_event` (`pk_event`, `pk_account`, `event`, `description`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(3, 1, 'Test Event', 'descri', 1, 1, 1, '2023-02-09 23:26:31', '2023-02-10 17:21:51');

-- --------------------------------------------------------

--
-- Table structure for table `kbt_event_type`
--

CREATE TABLE `kbt_event_type` (
  `pk_event_type` bigint UNSIGNED NOT NULL,
  `pk_account` bigint UNSIGNED NOT NULL,
  `event_type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kbt_event_type`
--

INSERT INTO `kbt_event_type` (`pk_event_type`, `pk_account`, `event_type`, `description`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'teting', NULL, 0, 2, 2, '2023-01-13 14:03:38', '2023-01-13 14:04:06'),
(3, 2, 'Wedding', NULL, 1, 6, 6, '2023-01-22 05:15:29', '2023-01-22 05:15:29'),
(4, 2, 'Birthday', NULL, 1, 6, 6, '2023-01-22 05:15:41', '2023-01-22 05:15:41'),
(5, 2, 'Engagement', NULL, 1, 6, 6, '2023-01-22 05:15:50', '2023-01-22 05:15:50'),
(6, 2, 'Party', NULL, 1, 6, 6, '2023-04-17 22:09:47', '2023-04-17 22:09:47');

-- --------------------------------------------------------

--
-- Table structure for table `kbt_floral_arrangements`
--

CREATE TABLE `kbt_floral_arrangements` (
  `pk_floral_arrangements` bigint UNSIGNED NOT NULL,
  `pk_account` bigint UNSIGNED NOT NULL,
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pk_product_category` bigint UNSIGNED NOT NULL,
  `pk_product_sub_category` bigint DEFAULT NULL,
  `pk_flowers` bigint DEFAULT NULL,
  `price` bigint NOT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kbt_floral_arrangements`
--

INSERT INTO `kbt_floral_arrangements` (`pk_floral_arrangements`, `pk_account`, `title`, `description`, `pk_product_category`, `pk_product_sub_category`, `pk_flowers`, `price`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(4, 2, 'STARBURST', NULL, 4, NULL, 0, 100, 1, 6, 6, '2023-02-27 17:40:34', '2023-03-03 19:55:02'),
(5, 2, 'MAI TAI', NULL, 4, NULL, 0, 150, 1, 6, 6, '2023-02-27 17:43:11', '2023-02-27 19:51:08'),
(6, 2, 'MERLOT', NULL, 4, NULL, 0, 125, 1, 6, 6, '2023-02-27 18:12:30', '2023-02-27 19:51:19'),
(7, 2, 'SHERBET', NULL, 4, NULL, 0, 75, 1, 6, 6, '2023-02-27 18:19:26', '2023-02-27 18:20:17'),
(8, 2, 'CLEMENTINE', NULL, 4, NULL, NULL, 200, 1, 6, 6, '2023-02-27 18:45:08', '2023-02-27 18:45:08'),
(9, 2, 'FLIRT', NULL, 5, NULL, NULL, 90, 1, 6, 6, '2023-02-27 19:13:55', '2023-02-27 19:13:55'),
(10, 2, 'VAL', NULL, 5, NULL, NULL, 175, 1, 6, 6, '2023-02-27 19:16:07', '2023-02-27 19:16:07'),
(11, 2, 'GEORGIA', NULL, 5, NULL, NULL, 100, 1, 6, 6, '2023-02-27 19:17:47', '2023-02-27 19:17:47'),
(12, 2, 'LAVENDER HAZE', NULL, 5, NULL, NULL, 150, 1, 6, 6, '2023-02-27 19:19:55', '2023-02-27 19:19:55'),
(14, 2, 'ORANGE', NULL, 6, NULL, NULL, 100, 1, 6, 6, '2023-02-28 13:49:08', '2023-02-28 13:49:08'),
(15, 2, 'RED', NULL, 6, NULL, NULL, 125, 1, 6, 6, '2023-02-28 13:51:36', '2023-02-28 13:51:36'),
(16, 2, 'PURPLE', NULL, 6, NULL, NULL, 10, 1, 6, 6, '2023-02-28 13:59:05', '2023-02-28 13:59:05'),
(17, 2, 'PINK', NULL, 6, NULL, NULL, 125, 1, 6, 6, '2023-02-28 14:01:12', '2023-02-28 14:01:12'),
(18, 2, 'YELLOW', NULL, 6, NULL, NULL, 75, 1, 6, 6, '2023-02-28 14:02:49', '2023-02-28 14:02:49'),
(19, 2, 'STRAWBERRY', NULL, 8, NULL, NULL, 150, 1, 6, 6, '2023-03-02 14:48:51', '2023-03-02 14:48:51'),
(20, 2, 'HERMOSA', NULL, 8, NULL, NULL, 100, 1, 6, 6, '2023-03-02 14:51:15', '2023-03-02 14:51:15'),
(21, 2, 'STRAWBERRY', NULL, 8, NULL, NULL, 150, 1, 6, 6, '2023-03-02 19:06:55', '2023-03-02 19:06:55');

-- --------------------------------------------------------

--
-- Table structure for table `kbt_floral_arrangements_images`
--

CREATE TABLE `kbt_floral_arrangements_images` (
  `pk_floral_arrangements_images` bigint UNSIGNED NOT NULL,
  `pk_account` bigint UNSIGNED NOT NULL,
  `pk_floral_arrangements` bigint UNSIGNED NOT NULL,
  `path` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kbt_floral_arrangements_images`
--

INSERT INTO `kbt_floral_arrangements_images` (`pk_floral_arrangements_images`, `pk_account`, `pk_floral_arrangements`, `path`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '1676409854595179795.jpg', 6, 6, '2023-02-14 21:24:14', '2023-02-14 21:24:14'),
(2, 1, 1, '1676966457735090375.jpg', 2, 2, '2023-02-21 08:00:57', '2023-02-21 08:00:57'),
(3, 1, 2, '1677162272135752156.jpg', 2, 2, '2023-02-23 14:24:32', '2023-02-23 14:24:32'),
(4, 2, 3, '1677473131646380270.png', 6, 6, '2023-02-27 04:45:31', '2023-02-27 04:45:31'),
(5, 1, 1, '1677506359220177030.jpg', 2, 2, '2023-02-27 13:59:19', '2023-02-27 13:59:19'),
(6, 1, 1, '1677506378265253955.jpg', 2, 2, '2023-02-27 13:59:38', '2023-02-27 13:59:38'),
(7, 2, 4, '1677519634202975173.png', 6, 6, '2023-02-27 17:40:34', '2023-02-27 17:40:34'),
(8, 2, 5, '1677519791911067349.png', 6, 6, '2023-02-27 17:43:11', '2023-02-27 17:43:11'),
(9, 2, 6, '1677521550789410570.png', 6, 6, '2023-02-27 18:12:30', '2023-02-27 18:12:30'),
(10, 2, 7, '1677522017621495222.png', 6, 6, '2023-02-27 18:20:17', '2023-02-27 18:20:17'),
(11, 2, 8, '1677523508838960549.png', 6, 6, '2023-02-27 18:45:08', '2023-02-27 18:45:08'),
(12, 2, 9, '1677525235765036685.png', 6, 6, '2023-02-27 19:13:55', '2023-02-27 19:13:55'),
(13, 2, 10, '1677525367954181556.png', 6, 6, '2023-02-27 19:16:07', '2023-02-27 19:16:07'),
(14, 2, 11, '1677525467258507972.png', 6, 6, '2023-02-27 19:17:47', '2023-02-27 19:17:47'),
(15, 2, 12, '1677525595856875268.png', 6, 6, '2023-02-27 19:19:55', '2023-02-27 19:19:55'),
(16, 2, 13, '1677549636968475143.jpg', 6, 6, '2023-02-28 02:00:36', '2023-02-28 02:00:36'),
(17, 2, 14, '1677592148393952482.png', 6, 6, '2023-02-28 13:49:08', '2023-02-28 13:49:08'),
(18, 2, 15, '1677592296674001140.png', 6, 6, '2023-02-28 13:51:36', '2023-02-28 13:51:36'),
(19, 2, 16, '1677592745895634967.png', 6, 6, '2023-02-28 13:59:05', '2023-02-28 13:59:05'),
(20, 2, 17, '1677592872521229117.png', 6, 6, '2023-02-28 14:01:12', '2023-02-28 14:01:12'),
(21, 2, 18, '1677592969194324853.png', 6, 6, '2023-02-28 14:02:49', '2023-02-28 14:02:49'),
(22, 2, 19, '1677768531992265200.png', 6, 6, '2023-03-02 14:48:51', '2023-03-02 14:48:51'),
(23, 2, 20, '1677768675502910319.png', 6, 6, '2023-03-02 14:51:15', '2023-03-02 14:51:15'),
(24, 2, 21, '1677784015781995909.png', 6, 6, '2023-03-02 19:06:55', '2023-03-02 19:06:55');

-- --------------------------------------------------------

--
-- Table structure for table `kbt_floral_arrangement_prices`
--

CREATE TABLE `kbt_floral_arrangement_prices` (
  `pk_floral_arrangement_prices` bigint UNSIGNED NOT NULL,
  `pk_floral_arrangements` int NOT NULL,
  `pk_arrangement_type` int NOT NULL,
  `pk_account` int NOT NULL,
  `price` double(8,2) DEFAULT NULL,
  `active` int DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kbt_floral_arrangement_prices`
--

INSERT INTO `kbt_floral_arrangement_prices` (`pk_floral_arrangement_prices`, `pk_floral_arrangements`, `pk_arrangement_type`, `pk_account`, `price`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, 100.00, 1, NULL, 2, '2023-02-22 20:48:54', '2023-02-23 14:25:42'),
(2, 2, 2, 1, 0.00, 1, NULL, 2, '2023-02-22 20:48:54', '2023-02-27 13:23:23'),
(3, 2, 3, 1, 0.00, 1, NULL, 2, '2023-02-22 20:48:54', '2023-02-27 13:23:23'),
(4, 1, 1, 1, 4.00, 1, NULL, 2, '2023-02-22 20:50:03', '2023-02-22 20:53:19'),
(5, 1, 2, 1, 6.00, 1, NULL, 2, '2023-02-22 20:50:03', '2023-02-22 20:53:19'),
(6, 1, 3, 1, 7.00, 1, NULL, 2, '2023-02-22 20:50:03', '2023-02-22 20:53:19'),
(7, 1, 5, 2, 75.00, 1, NULL, 6, '2023-02-24 02:58:51', '2023-02-27 14:33:42'),
(8, 1, 6, 2, 95.00, 1, NULL, 6, '2023-02-24 02:58:51', '2023-02-27 14:33:42'),
(9, 1, 7, 2, 105.00, 1, NULL, 6, '2023-02-24 02:58:51', '2023-02-27 14:33:42'),
(10, 3, 5, 2, 100.00, 1, NULL, 6, '2023-02-27 04:45:07', '2023-02-27 04:45:31'),
(11, 3, 6, 2, 125.00, 1, NULL, 6, '2023-02-27 04:45:07', '2023-02-27 04:46:44'),
(12, 3, 7, 2, 150.00, 1, NULL, 6, '2023-02-27 04:45:07', '2023-02-27 04:46:44'),
(13, 4, 5, 2, 100.00, 1, NULL, 6, '2023-02-27 17:40:34', '2023-03-03 19:55:02'),
(14, 4, 6, 2, 125.00, 1, NULL, 6, '2023-02-27 17:40:34', '2023-03-03 19:55:02'),
(15, 4, 7, 2, 150.00, 1, NULL, 6, '2023-02-27 17:40:34', '2023-03-03 19:55:02'),
(16, 5, 5, 2, 150.00, 1, NULL, 6, '2023-02-27 17:43:11', '2023-02-27 18:12:56'),
(17, 5, 6, 2, 175.00, 1, NULL, 6, '2023-02-27 17:43:11', '2023-02-27 18:12:56'),
(18, 5, 7, 2, 200.00, 1, NULL, 6, '2023-02-27 17:43:11', '2023-02-27 18:12:56'),
(19, 6, 5, 2, 125.00, 1, NULL, 6, '2023-02-27 18:12:30', '2023-02-27 19:51:19'),
(20, 6, 6, 2, 150.00, 1, NULL, 6, '2023-02-27 18:12:30', '2023-02-27 19:51:19'),
(21, 6, 7, 2, 175.00, 1, NULL, 6, '2023-02-27 18:12:30', '2023-02-27 19:51:19'),
(22, 7, 5, 2, 75.00, 1, NULL, 6, '2023-02-27 18:19:26', '2023-02-27 18:20:17'),
(23, 7, 6, 2, 100.00, 1, NULL, 6, '2023-02-27 18:19:26', '2023-02-27 18:20:17'),
(24, 7, 7, 2, 125.00, 1, NULL, 6, '2023-02-27 18:19:26', '2023-02-27 18:20:17'),
(25, 8, 5, 2, 200.00, 1, 6, 6, '2023-02-27 18:45:08', '2023-02-27 18:45:08'),
(26, 8, 6, 2, 225.00, 1, 6, 6, '2023-02-27 18:45:08', '2023-02-27 18:45:08'),
(27, 8, 7, 2, 250.00, 1, 6, 6, '2023-02-27 18:45:08', '2023-02-27 18:45:08'),
(28, 9, 5, 2, 90.00, 1, 6, 6, '2023-02-27 19:13:55', '2023-02-27 19:13:55'),
(29, 9, 6, 2, 115.00, 1, 6, 6, '2023-02-27 19:13:55', '2023-02-27 19:13:55'),
(30, 9, 7, 2, 140.00, 1, 6, 6, '2023-02-27 19:13:55', '2023-02-27 19:13:55'),
(31, 10, 5, 2, 175.00, 1, 6, 6, '2023-02-27 19:16:07', '2023-02-27 19:16:07'),
(32, 10, 6, 2, 200.00, 1, 6, 6, '2023-02-27 19:16:07', '2023-02-27 19:16:07'),
(33, 10, 7, 2, 225.00, 1, 6, 6, '2023-02-27 19:16:07', '2023-02-27 19:16:07'),
(34, 11, 5, 2, 100.00, 1, 6, 6, '2023-02-27 19:17:47', '2023-02-27 19:17:47'),
(35, 11, 6, 2, 125.00, 1, 6, 6, '2023-02-27 19:17:47', '2023-02-27 19:17:47'),
(36, 11, 7, 2, 150.00, 1, 6, 6, '2023-02-27 19:17:47', '2023-02-27 19:17:47'),
(37, 12, 5, 2, 150.00, 1, 6, 6, '2023-02-27 19:19:55', '2023-02-27 19:19:55'),
(38, 12, 6, 2, 175.00, 1, 6, 6, '2023-02-27 19:19:55', '2023-02-27 19:19:55'),
(39, 12, 7, 2, 200.00, 1, 6, 6, '2023-02-27 19:19:55', '2023-02-27 19:19:55'),
(40, 13, 5, 2, 10.00, 1, 6, 6, '2023-02-28 02:00:36', '2023-02-28 02:00:36'),
(41, 13, 6, 2, 0.00, 1, 6, 6, '2023-02-28 02:00:36', '2023-02-28 02:00:36'),
(42, 13, 7, 2, 0.00, 1, 6, 6, '2023-02-28 02:00:36', '2023-02-28 02:00:36'),
(43, 14, 5, 2, 100.00, 1, 6, 6, '2023-02-28 13:49:08', '2023-02-28 13:49:08'),
(44, 14, 6, 2, 125.00, 1, 6, 6, '2023-02-28 13:49:08', '2023-02-28 13:49:08'),
(45, 14, 7, 2, 150.00, 1, 6, 6, '2023-02-28 13:49:08', '2023-02-28 13:49:08'),
(46, 15, 5, 2, 125.00, 1, 6, 6, '2023-02-28 13:51:36', '2023-02-28 13:51:36'),
(47, 15, 6, 2, 150.00, 1, 6, 6, '2023-02-28 13:51:36', '2023-02-28 13:51:36'),
(48, 15, 7, 2, 175.00, 1, 6, 6, '2023-02-28 13:51:36', '2023-02-28 13:51:36'),
(49, 16, 5, 2, 10.00, 1, 6, 6, '2023-02-28 13:59:05', '2023-02-28 13:59:05'),
(50, 16, 6, 2, 0.00, 1, 6, 6, '2023-02-28 13:59:05', '2023-02-28 13:59:05'),
(51, 16, 7, 2, 0.00, 1, 6, 6, '2023-02-28 13:59:05', '2023-02-28 13:59:05'),
(52, 17, 5, 2, 125.00, 1, 6, 6, '2023-02-28 14:01:12', '2023-02-28 14:01:12'),
(53, 17, 6, 2, 150.00, 1, 6, 6, '2023-02-28 14:01:12', '2023-02-28 14:01:12'),
(54, 17, 7, 2, 175.00, 1, 6, 6, '2023-02-28 14:01:12', '2023-02-28 14:01:12'),
(55, 18, 5, 2, 75.00, 1, 6, 6, '2023-02-28 14:02:49', '2023-02-28 14:02:49'),
(56, 18, 6, 2, 100.00, 1, 6, 6, '2023-02-28 14:02:49', '2023-02-28 14:02:49'),
(57, 18, 7, 2, 125.00, 1, 6, 6, '2023-02-28 14:02:49', '2023-02-28 14:02:49'),
(58, 19, 5, 2, 150.00, 1, 6, 6, '2023-03-02 14:48:51', '2023-03-02 14:48:51'),
(59, 19, 6, 2, 175.00, 1, 6, 6, '2023-03-02 14:48:51', '2023-03-02 14:48:51'),
(60, 19, 7, 2, 200.00, 1, 6, 6, '2023-03-02 14:48:51', '2023-03-02 14:48:51'),
(61, 20, 5, 2, 100.00, 1, 6, 6, '2023-03-02 14:51:15', '2023-03-02 14:51:15'),
(62, 20, 6, 2, 125.00, 1, 6, 6, '2023-03-02 14:51:15', '2023-03-02 14:51:15'),
(63, 20, 7, 2, 150.00, 1, 6, 6, '2023-03-02 14:51:15', '2023-03-02 14:51:15'),
(64, 21, 5, 2, 150.00, 1, 6, 6, '2023-03-02 19:06:55', '2023-03-02 19:06:55'),
(65, 21, 6, 2, 175.00, 1, 6, 6, '2023-03-02 19:06:55', '2023-03-02 19:06:55'),
(66, 21, 7, 2, 200.00, 1, 6, 6, '2023-03-02 19:06:55', '2023-03-02 19:06:55');

-- --------------------------------------------------------

--
-- Table structure for table `kbt_flowers`
--

CREATE TABLE `kbt_flowers` (
  `pk_flowers` bigint UNSIGNED NOT NULL,
  `pk_account` bigint UNSIGNED NOT NULL,
  `flowers` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kbt_flowers`
--

INSERT INTO `kbt_flowers` (`pk_flowers`, `pk_account`, `flowers`, `description`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'Rose', NULL, 0, NULL, 2, NULL, '2023-01-17 07:32:45'),
(2, 1, 'Lotus', 'dnuull', 1, NULL, 2, NULL, '2023-01-17 10:10:18');

-- --------------------------------------------------------

--
-- Table structure for table `kbt_flower_subscription`
--

CREATE TABLE `kbt_flower_subscription` (
  `pk_flower_subscription` bigint UNSIGNED NOT NULL,
  `pk_account` bigint UNSIGNED NOT NULL,
  `pk_frequency` bigint UNSIGNED NOT NULL,
  `price` double(8,2) DEFAULT NULL,
  `pk_uom` bigint UNSIGNED NOT NULL,
  `path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kbt_flower_subscription`
--

INSERT INTO `kbt_flower_subscription` (`pk_flower_subscription`, `pk_account`, `pk_frequency`, `price`, `pk_uom`, `path`, `description`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(3, 2, 1, 40.00, 0, '2023013115291.jpg', NULL, 1, 2, 6, '2023-01-31 15:29:24', '2023-02-06 02:22:34'),
(4, 2, 4, 50.00, 0, '202301311532flower-729512__340.jpg', NULL, 1, 2, 6, '2023-01-31 15:32:07', '2023-02-06 02:22:59'),
(5, 2, 5, 60.00, 0, '202301311532pink-324175__340.jpg', NULL, 1, 2, 6, '2023-01-31 15:32:28', '2023-02-06 02:23:07'),
(6, 2, 3, 45.00, 0, '202301311532lotus-1205631__340.jpg', NULL, 1, 2, 6, '2023-01-31 15:32:48', '2023-02-06 02:22:49');

-- --------------------------------------------------------

--
-- Table structure for table `kbt_frequency`
--

CREATE TABLE `kbt_frequency` (
  `pk_frequency` bigint UNSIGNED NOT NULL,
  `pk_account` bigint UNSIGNED NOT NULL,
  `frequency` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kbt_frequency`
--

INSERT INTO `kbt_frequency` (`pk_frequency`, `pk_account`, `frequency`, `description`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'Daily', NULL, 1, 1, 1, '2023-01-24 17:12:24', '2023-01-24 17:12:24'),
(2, 1, 'Weekly', NULL, 1, 1, 1, '2023-01-24 17:12:35', '2023-01-24 17:12:35'),
(3, 1, 'Bi-Weekly', NULL, 1, 1, 1, '2023-01-24 17:12:53', '2023-01-24 17:12:53'),
(4, 1, 'Monthly', NULL, 1, 1, 1, '2023-01-24 17:13:03', '2023-01-24 17:13:03'),
(5, 1, 'Quarterly', NULL, 1, 1, 1, '2023-01-24 17:13:15', '2023-01-24 17:13:15');

-- --------------------------------------------------------

--
-- Table structure for table `kbt_locations`
--

CREATE TABLE `kbt_locations` (
  `pk_locations` bigint UNSIGNED NOT NULL,
  `pk_location_types` bigint UNSIGNED NOT NULL DEFAULT '1',
  `pk_account` bigint UNSIGNED NOT NULL,
  `location_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `location_code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_1` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pk_states` bigint DEFAULT NULL,
  `pk_country` bigint DEFAULT NULL,
  `pk_timezone` bigint DEFAULT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `tax_rate` float NOT NULL,
  `Estimated_Delivery_Time` int DEFAULT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `country_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kbt_locations`
--

INSERT INTO `kbt_locations` (`pk_locations`, `pk_location_types`, `pk_account`, `location_name`, `location_code`, `address`, `address_1`, `city`, `zip`, `pk_states`, `pk_country`, `pk_timezone`, `active`, `tax_rate`, `Estimated_Delivery_Time`, `created_by`, `updated_by`, `created_at`, `updated_at`, `country_name`, `state_name`, `lat`, `lng`) VALUES
(15, 1, 2, 'Hawthorne', 'HTT', '3700 West El Segundo Boulevard', '3700', 'Hawthorne', 'Hawthorne', NULL, NULL, 4, 1, 9.06, 1, 6, 6, '2023-02-28 02:04:20', '2023-03-18 06:03:49', 'United States', 'CA', 33.9154407, -118.3380219),
(16, 1, 2, 'Beverly Hills', 'BH', '8500 Beverly Boulevard', '8500', 'Los Angeles', 'Los Angele', NULL, NULL, 4, 1, 3.4, 1, 6, 2, '2023-03-03 19:51:10', '2023-03-21 15:23:10', 'United States', 'CA', 34.0753309, -118.3774933),
(17, 1, 2, 'Venice', 'VN', '10 Washington Boulevard', '10', 'Los Angeles', 'Los Angele', NULL, NULL, 4, 1, 9.25, 3, 6, 2, '2023-03-03 19:51:56', '2023-03-21 15:23:46', 'United States', 'CA', 33.9789793, -118.4665996),
(18, 1, 2, 'El Segundo', 'ES', '140 Main Street', '140', 'El Segundo', 'El Segundo', NULL, NULL, 4, 1, 0, 9, 6, 2, '2023-03-03 19:52:45', '2023-03-10 05:57:05', 'United States', 'CA', 33.9177145, -118.4157129),
(19, 1, 2, 'Hollywood', 'HW', '8162 Melrose Avenue', '8162', 'Los Angeles', 'Los Angele', NULL, NULL, 4, 1, 0, 1, 6, 2, '2023-03-03 19:53:41', '2023-03-21 15:26:00', 'United States', 'CA', 34.0834638, -118.36743),
(20, 1, 2, 'Culver City', 'CC', '6000 Sepulveda Boulevard', '6000', 'Culver City', 'Culver Cit', NULL, NULL, 4, 1, 89, 1, 6, 2, '2023-03-03 19:54:43', '2023-03-20 04:18:00', 'United States', 'CA', 33.9854311, -118.3933176),
(21, 1, 2, 'Inglewood', 'IW', '3560 West Century Boulevard', '3560', 'Inglewood', 'Inglewood', NULL, NULL, 4, 1, 8, 1, 6, 2, '2023-03-03 19:55:31', '2023-03-20 04:18:15', 'United States', 'CA', 33.9427539, -118.3334094),
(22, 1, 2, 'Torrance', 'TR', '3525 West Carson Street', '3525', 'Torrance', '90503', NULL, NULL, 4, 1, 0, NULL, 6, 6, '2023-03-03 19:56:36', '2023-03-03 19:56:36', 'United States', 'CA', 33.8310336, -118.3497562),
(26, 1, 2, 'Costa Mesa', 'CM', '1838 Newport Boulevard', '1838', 'Costa Mesa', '92627', NULL, NULL, 4, 1, 9.25, 2, 2, 6, '2023-05-21 10:15:13', '2023-06-05 06:14:53', 'United States', 'CA', 33.6415267, -117.9180219);

-- --------------------------------------------------------

--
-- Table structure for table `kbt_location_times`
--

CREATE TABLE `kbt_location_times` (
  `pk_location_times` bigint UNSIGNED NOT NULL,
  `pk_locations` bigint UNSIGNED NOT NULL,
  `pk_location_types` int NOT NULL,
  `start` date DEFAULT NULL,
  `day` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `open_time` time DEFAULT NULL,
  `close_time` time DEFAULT NULL,
  `is_exception` tinyint DEFAULT '0',
  `all_day` tinyint DEFAULT '0',
  `active` tinyint NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kbt_location_times`
--

INSERT INTO `kbt_location_times` (`pk_location_times`, `pk_locations`, `pk_location_types`, `start`, `day`, `open_time`, `close_time`, `is_exception`, `all_day`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(22, 4, 0, '2023-01-30', 'Monday', '18:32:00', '22:36:00', 1, 0, 1, 2, 2, '2023-02-23 02:27:44', '2023-02-23 02:29:03'),
(24, 13, 12, '2023-02-27', 'Monday', '19:01:00', '20:01:00', 0, 0, 1, 2, 2, '2023-02-23 08:29:06', '2023-02-27 13:31:37'),
(25, 6, 13, '2023-02-20', 'Monday', '00:00:00', '23:59:59', 0, 1, 1, 2, 2, '2023-02-23 08:48:02', '2023-02-24 03:51:23'),
(26, 6, 0, '2023-01-30', 'Monday', '15:20:00', '19:22:00', 0, 0, 1, 2, 2, '2023-02-23 08:48:10', '2023-02-23 08:48:10'),
(27, 13, 0, '2023-01-30', 'Monday', '01:05:00', '20:00:00', 1, 0, 1, 2, 2, '2023-02-23 08:50:52', '2023-02-24 03:52:37'),
(28, 13, 12, '2023-02-21', 'Tuesday', '08:00:00', '20:00:00', 0, 0, 1, 6, 6, '2023-02-24 00:16:53', '2023-02-24 00:16:53'),
(29, 13, 12, '2023-02-22', 'Wednesday', '08:00:00', '20:00:00', 0, 0, 1, 6, 6, '2023-02-24 00:16:53', '2023-02-24 00:16:53'),
(30, 13, 12, '2023-02-23', 'Thursday', '08:00:00', '20:00:00', 0, 0, 1, 6, 6, '2023-02-24 00:16:53', '2023-02-24 00:16:53'),
(31, 13, 12, '2023-02-24', 'Friday', '08:00:00', '20:00:00', 0, 0, 1, 6, 6, '2023-02-24 00:16:53', '2023-02-24 00:16:53'),
(32, 13, 12, '2023-02-25', 'Saturday', '08:00:00', '20:00:00', 0, 0, 1, 6, 6, '2023-02-24 00:16:53', '2023-02-24 00:16:53'),
(33, 6, 0, '2023-01-30', 'Monday', '17:20:00', '19:22:00', 1, 0, 1, 2, 2, '2023-02-24 03:36:25', '2023-02-24 03:36:44'),
(34, 6, 0, '2023-02-06', 'Monday', '15:20:00', '19:22:00', 1, 0, 1, 2, 2, '2023-02-24 03:36:58', '2023-02-24 03:36:58'),
(35, 6, 13, '2023-02-21', 'Tuesday', '00:00:00', '23:59:59', 0, 1, 1, 2, 2, '2023-02-24 03:51:23', '2023-02-24 03:51:23'),
(36, 6, 13, '2023-02-22', 'Wednesday', '09:21:00', '10:21:00', 0, 0, 1, 2, 2, '2023-02-24 03:51:23', '2023-02-24 03:51:23'),
(37, 6, 13, '2023-02-23', 'Thursday', '09:21:00', '10:21:00', 0, 0, 1, 2, 2, '2023-02-24 03:51:23', '2023-02-24 03:51:23'),
(38, 6, 13, '2023-02-24', 'Friday', '09:21:00', '10:21:00', 0, 0, 1, 2, 2, '2023-02-24 03:51:23', '2023-02-24 03:51:23'),
(39, 6, 13, '2023-02-25', 'Saturday', '09:21:00', '10:21:00', 0, 0, 1, 2, 2, '2023-02-24 03:51:23', '2023-02-24 03:51:23'),
(40, 6, 13, '2023-02-26', 'Sunday', '09:21:00', '10:21:00', 0, 0, 1, 2, 2, '2023-02-24 03:51:23', '2023-02-24 03:51:23'),
(41, 13, 12, '2023-02-26', 'Sunday', '09:21:00', '10:21:00', 0, 0, 1, 2, 2, '2023-02-24 03:51:41', '2023-02-24 03:51:41'),
(42, 14, 11, '2023-02-20', 'Monday', '11:46:00', '12:46:00', 0, 0, 1, 2, 2, '2023-02-24 06:16:10', '2023-02-24 06:16:10'),
(43, 14, 11, '2023-02-22', 'Wednesday', '11:46:00', '12:46:00', 0, 0, 1, 2, 2, '2023-02-24 06:16:10', '2023-02-24 06:16:10'),
(44, 14, 11, '2023-02-23', 'Thursday', '11:46:00', '12:46:00', 0, 0, 1, 2, 2, '2023-02-24 06:16:10', '2023-02-24 06:16:10'),
(45, 14, 11, '2023-02-24', 'Friday', '11:46:00', '12:46:00', 0, 0, 1, 2, 2, '2023-02-24 06:16:10', '2023-02-24 06:16:10'),
(46, 14, 11, '2023-02-25', 'Saturday', '11:46:00', '12:46:00', 0, 0, 1, 2, 2, '2023-02-24 06:16:10', '2023-02-24 06:16:10'),
(47, 14, 11, '2023-02-26', 'Sunday', '11:46:00', '12:46:00', 0, 0, 1, 2, 2, '2023-02-24 06:16:10', '2023-02-24 06:16:10'),
(48, 14, 11, '2023-02-21', 'Tuesday', '11:46:00', '00:46:00', 0, 0, 1, 2, 2, '2023-02-24 07:33:19', '2023-02-24 07:33:19'),
(49, 13, 0, '2023-01-29', 'Sunday', '09:23:00', '10:21:00', 1, 0, 1, 2, 2, '2023-02-27 13:31:55', '2023-02-27 13:31:55'),
(50, 15, 1, '2023-05-22', 'Monday', '00:00:00', '23:59:00', 0, 0, 1, 6, 6, '2023-02-28 02:06:15', '2023-05-24 23:31:02'),
(51, 15, 1, '2023-05-23', 'Tuesday', '00:00:00', '23:59:00', 0, 0, 1, 6, 6, '2023-02-28 02:06:15', '2023-05-24 23:31:02'),
(52, 15, 1, '2023-05-24', 'Wednesday', '00:00:00', '23:59:00', 0, 0, 1, 6, 6, '2023-02-28 02:06:15', '2023-05-24 23:31:02'),
(53, 15, 1, '2023-05-25', 'Thursday', '00:00:00', '23:59:00', 0, 0, 1, 6, 6, '2023-02-28 02:06:15', '2023-05-24 23:31:02'),
(54, 15, 1, '2023-05-26', 'Friday', '00:00:00', '23:59:00', 0, 0, 1, 6, 6, '2023-02-28 02:06:15', '2023-05-24 23:31:02'),
(55, 15, 1, '2023-05-27', 'Saturday', '00:00:00', '23:59:00', 0, 0, 1, 6, 6, '2023-02-28 02:06:15', '2023-05-24 23:31:02'),
(56, 15, 0, '2023-01-30', 'Monday', '08:00:00', '20:01:00', 1, 0, 1, 6, 6, '2023-02-28 02:07:12', '2023-02-28 02:07:12'),
(57, 15, 1, '2023-05-28', 'Sunday', '00:00:00', '23:59:59', 0, 1, 1, 2, 6, '2023-03-21 15:22:40', '2023-05-23 16:53:35'),
(58, 16, 1, '2023-03-20', 'Monday', '00:00:00', '23:59:59', 0, 1, 1, 2, 2, '2023-03-21 15:23:10', '2023-03-21 15:23:10'),
(59, 16, 1, '2023-03-21', 'Tuesday', '00:00:00', '23:59:59', 0, 1, 1, 2, 2, '2023-03-21 15:23:10', '2023-03-21 15:23:10'),
(60, 16, 1, '2023-03-22', 'Wednesday', '00:00:00', '23:59:59', 0, 1, 1, 2, 2, '2023-03-21 15:23:10', '2023-03-21 15:23:10'),
(61, 16, 1, '2023-03-23', 'Thursday', '00:00:00', '23:59:59', 0, 1, 1, 2, 2, '2023-03-21 15:23:10', '2023-03-21 15:23:10'),
(62, 16, 1, '2023-03-24', 'Friday', '00:00:00', '23:59:59', 0, 1, 1, 2, 2, '2023-03-21 15:23:10', '2023-03-21 15:23:10'),
(63, 16, 1, '2023-03-25', 'Saturday', '00:00:00', '23:59:59', 0, 1, 1, 2, 2, '2023-03-21 15:23:10', '2023-03-21 15:23:10'),
(64, 16, 1, '2023-03-26', 'Sunday', '00:00:00', '23:59:59', 0, 1, 1, 2, 2, '2023-03-21 15:23:10', '2023-03-21 15:23:10'),
(65, 17, 1, '2023-03-20', 'Monday', '00:00:00', '23:59:59', 0, 1, 1, 2, 2, '2023-03-21 15:23:46', '2023-03-21 15:23:46'),
(66, 17, 1, '2023-03-21', 'Tuesday', '00:00:00', '23:59:59', 0, 1, 1, 2, 2, '2023-03-21 15:23:46', '2023-03-21 15:23:46'),
(67, 17, 1, '2023-03-22', 'Wednesday', '00:00:00', '23:59:59', 0, 1, 1, 2, 2, '2023-03-21 15:23:46', '2023-03-21 15:23:46'),
(68, 17, 1, '2023-03-23', 'Thursday', '00:00:00', '23:59:59', 0, 1, 1, 2, 2, '2023-03-21 15:23:46', '2023-03-21 15:23:46'),
(69, 17, 1, '2023-03-24', 'Friday', '00:00:00', '23:59:59', 0, 1, 1, 2, 2, '2023-03-21 15:23:46', '2023-03-21 15:23:46'),
(70, 17, 1, '2023-03-25', 'Saturday', '00:00:00', '23:59:59', 0, 1, 1, 2, 2, '2023-03-21 15:23:46', '2023-03-21 15:23:46'),
(71, 17, 1, '2023-03-26', 'Sunday', '00:00:00', '23:59:59', 0, 1, 1, 2, 2, '2023-03-21 15:23:46', '2023-03-21 15:23:46'),
(72, 19, 1, '2023-03-20', 'Monday', '00:00:00', '23:59:59', 0, 1, 1, 2, 2, '2023-03-21 15:26:00', '2023-03-21 15:26:00'),
(73, 19, 1, '2023-03-21', 'Tuesday', '00:00:00', '23:59:59', 0, 1, 1, 2, 2, '2023-03-21 15:26:00', '2023-03-21 15:26:00'),
(74, 19, 1, '2023-03-22', 'Wednesday', '00:00:00', '23:59:59', 0, 1, 1, 2, 2, '2023-03-21 15:26:00', '2023-03-21 15:26:00'),
(75, 19, 1, '2023-03-23', 'Thursday', '00:00:00', '23:59:59', 0, 1, 1, 2, 2, '2023-03-21 15:26:00', '2023-03-21 15:26:00'),
(76, 19, 1, '2023-03-24', 'Friday', '00:00:00', '23:59:59', 0, 1, 1, 2, 2, '2023-03-21 15:26:00', '2023-03-21 15:26:00'),
(77, 19, 1, '2023-03-25', 'Saturday', '00:00:00', '23:59:59', 0, 1, 1, 2, 2, '2023-03-21 15:26:00', '2023-03-21 15:26:00'),
(78, 19, 1, '2023-03-26', 'Sunday', '00:00:00', '23:59:59', 0, 1, 1, 2, 2, '2023-03-21 15:26:00', '2023-03-21 15:26:00'),
(79, 21, 1, '2023-03-20', 'Monday', '08:00:00', '20:00:00', 0, 0, 1, 6, 6, '2023-03-23 20:40:38', '2023-03-23 20:40:38'),
(80, 21, 1, '2023-03-21', 'Tuesday', '08:00:00', '20:00:00', 0, 0, 1, 6, 6, '2023-03-23 20:40:38', '2023-03-23 20:40:38'),
(81, 21, 1, '2023-03-22', 'Wednesday', '08:00:00', '20:00:00', 0, 0, 1, 6, 6, '2023-03-23 20:40:38', '2023-03-23 20:40:38'),
(82, 21, 1, '2023-03-23', 'Thursday', '08:00:00', '20:00:00', 0, 0, 1, 6, 6, '2023-03-23 20:40:38', '2023-03-23 20:40:38'),
(83, 21, 1, '2023-03-24', 'Friday', '08:00:00', '20:00:00', 0, 0, 1, 6, 6, '2023-03-23 20:40:38', '2023-03-23 20:40:38'),
(84, 21, 1, '2023-03-25', 'Saturday', '08:00:00', '20:00:00', 0, 0, 1, 6, 6, '2023-03-23 20:40:38', '2023-03-23 20:40:38'),
(85, 26, 1, '2023-05-15', 'Monday', '00:00:00', '23:59:59', 0, 1, 1, 2, 2, '2023-05-21 10:15:37', '2023-05-21 10:15:37');

-- --------------------------------------------------------

--
-- Table structure for table `kbt_location_types`
--

CREATE TABLE `kbt_location_types` (
  `pk_location_types` bigint UNSIGNED NOT NULL,
  `pk_account` bigint UNSIGNED NOT NULL,
  `location_types` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kbt_location_types`
--

INSERT INTO `kbt_location_types` (`pk_location_types`, `pk_account`, `location_types`, `description`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 2, 'Store', 'Store', 1, 6, 6, '2023-02-13 07:14:07', '2023-02-13 07:14:07');

-- --------------------------------------------------------

--
-- Table structure for table `kbt_orders`
--

CREATE TABLE `kbt_orders` (
  `pk_orders` bigint UNSIGNED NOT NULL,
  `pk_account` bigint NOT NULL DEFAULT '2',
  `pk_users` bigint DEFAULT NULL,
  `pk_transactions` bigint DEFAULT NULL,
  `pk_customers` bigint DEFAULT NULL,
  `total` decimal(15,4) DEFAULT '0.0000',
  `cancel_reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pk_order_status` bigint DEFAULT NULL,
  `pk_locations` bigint DEFAULT NULL,
  `pk_location_times` bigint DEFAULT NULL,
  `pk_delivery_or_pickup` bigint NOT NULL,
  `delivery_charge` double DEFAULT NULL,
  `tax_charge` double DEFAULT NULL,
  `discount_charge` double DEFAULT NULL,
  `coupon_discount_type` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estimated_del` date DEFAULT NULL,
  `created_by` bigint DEFAULT NULL,
  `updated_by` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kbt_orders`
--

INSERT INTO `kbt_orders` (`pk_orders`, `pk_account`, `pk_users`, `pk_transactions`, `pk_customers`, `total`, `cancel_reason`, `pk_order_status`, `pk_locations`, `pk_location_times`, `pk_delivery_or_pickup`, `delivery_charge`, `tax_charge`, `discount_charge`, `coupon_discount_type`, `estimated_del`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 2, 69, 13, 5, '114.0000', NULL, 3, 21, NULL, 0, 6, 8, NULL, NULL, '0000-00-00', 69, 2, '2023-03-21 15:13:41', '2023-08-10 14:16:20'),
(2, 2, 70, 14, 5, '100.0000', NULL, 1, 19, NULL, 0, 0, 0, NULL, NULL, '0000-00-00', 70, 70, '2023-03-22 08:31:26', '2023-03-22 08:31:26'),
(3, 2, 71, 15, 5, '163.0600', NULL, 1, 15, NULL, 0, 4, 9.06, NULL, NULL, '0000-00-00', 71, 71, '2023-03-22 08:35:20', '2023-03-22 08:35:20'),
(6, 2, 77, 18, 5, '115.0000', NULL, 1, 19, NULL, 0, 15, 0, NULL, NULL, '0000-00-00', 77, 77, '2023-03-22 18:55:10', '2023-03-22 18:55:10'),
(12, 2, 80, 24, 5, '200.0000', NULL, 1, 22, 74, 0, 0, 0, NULL, NULL, '0000-00-00', 80, 80, '2023-04-10 13:28:50', '2023-04-10 13:28:50'),
(33, 2, 86, 46, 5, '159.0600', NULL, 1, 22, 55, 0, 0, 9.06, NULL, NULL, '0000-00-00', 86, 86, '2023-04-26 09:06:47', '2023-04-26 09:06:47'),
(37, 2, 87, 50, 5, '124.0600', NULL, 1, 15, NULL, 0, 15, 9.06, NULL, NULL, '0000-00-00', 87, 87, '2023-04-27 09:07:51', '2023-04-27 09:07:51'),
(47, 2, 87, 60, 5, '348.1200', NULL, 1, 15, NULL, 0, 15, 9.06, NULL, NULL, '0000-00-00', 87, 87, '2023-04-28 07:39:53', '2023-04-28 07:39:53'),
(48, 2, 87, 61, 5, '124.0600', NULL, 1, 15, NULL, 0, 15, 9.06, NULL, NULL, '0000-00-00', 87, 87, '2023-04-28 07:51:11', '2023-04-28 07:51:11'),
(49, 2, 87, 62, 5, '248.1200', NULL, 1, 15, NULL, 0, 15, 9.06, NULL, NULL, '0000-00-00', 87, 87, '2023-04-28 07:59:37', '2023-04-28 07:59:37'),
(50, 2, 87, 63, 5, '99.0600', NULL, 1, 15, NULL, 0, 15, 9.06, NULL, NULL, '0000-00-00', 87, 87, '2023-04-28 08:03:01', '2023-04-28 08:03:01'),
(60, 2, 88, 74, 5, '159.0600', NULL, 1, 22, 53, 0, 0, 9.06, 10, 'percent', '0000-00-00', 88, 88, '2023-04-28 12:28:10', '2023-04-28 12:28:10'),
(61, 2, 88, 75, 5, '200.0000', NULL, 1, 22, 76, 0, 0, 0, 20, 'fixed', '0000-00-00', 88, 88, '2023-04-28 12:29:35', '2023-04-28 12:29:35'),
(62, 2, 88, 76, 5, '100.0000', NULL, 1, 22, 77, 0, 0, 0, 25, 'percent', '0000-00-00', 88, 88, '2023-04-28 16:26:29', '2023-04-28 16:26:29'),
(63, 2, 40, 77, 5, '77.0000', NULL, 1, 21, NULL, 0, 4, 8, 10, 'percent', '0000-00-00', 40, 40, '2023-04-28 22:56:33', '2023-04-28 22:56:33'),
(80, 2, 90, 94, 5, '80.0000', NULL, 1, 19, NULL, 0, 0, 0, 20, 'percent', '0000-00-00', 90, 90, '2023-05-01 10:33:45', '2023-05-01 10:33:45'),
(81, 2, 90, 95, 5, '90.0000', NULL, 1, 19, NULL, 0, 0, 0, 10, 'fixed', '0000-00-00', 90, 90, '2023-05-01 10:34:30', '2023-05-01 10:34:30'),
(82, 2, 90, 96, 5, '80.0000', NULL, 1, 19, NULL, 0, 0, 0, 20, 'fixed', '0000-00-00', 90, 90, '2023-05-01 10:37:45', '2023-05-01 10:37:45'),
(83, 2, 90, 97, 5, '100.0000', NULL, 1, 22, 74, 0, 0, 0, 10, 'percent', '0000-00-00', 90, 90, '2023-05-01 10:38:42', '2023-05-01 10:38:42'),
(84, 2, 40, 98, 5, '77.0000', NULL, 1, 21, NULL, 0, 4, 8, 10, 'percent', '0000-00-00', 40, 40, '2023-05-02 04:24:09', '2023-05-02 04:24:09'),
(85, 2, 40, 99, 5, '77.0000', NULL, 1, 21, NULL, 0, 4, 8, 10, 'percent', '0000-00-00', 40, 40, '2023-05-02 04:25:19', '2023-05-02 04:25:19'),
(86, 2, 40, 100, 5, '77.0000', NULL, 1, 21, NULL, 0, 4, 8, 10, 'fixed', '0000-00-00', 40, 40, '2023-05-02 04:26:57', '2023-05-02 04:26:57'),
(87, 2, 40, 101, 5, '83.0000', NULL, 2, 22, 79, 0, 0, 8, 10, 'percent', '0000-00-00', 40, 40, '2023-05-02 04:31:32', '2023-05-02 04:31:32'),
(88, 2, 40, 102, 5, '83.0000', NULL, 1, 22, 79, 0, 0, 8, 10, 'fixed', '0000-00-00', 40, 40, '2023-05-02 04:34:06', '2023-05-02 04:34:06'),
(89, 2, 91, 103, 5, '89.0600', NULL, 1, 15, NULL, 0, 15, 9.06, 10, 'percent', '0000-00-00', 91, 91, '2023-05-02 05:23:01', '2023-05-02 05:23:01'),
(90, 2, 91, 104, 5, '89.0600', NULL, 1, 15, NULL, 0, 15, 9.06, 10, 'fixed', '0000-00-00', 91, 91, '2023-05-02 05:38:40', '2023-05-02 05:38:40'),
(91, 2, 91, 105, 5, '154.0600', NULL, 1, 15, NULL, 0, 15, 9.06, 20, 'fixed', '0000-00-00', 91, 91, '2023-05-02 05:55:06', '2023-05-02 05:55:06'),
(92, 2, 92, 106, 5, '72.4000', NULL, 1, 16, NULL, 0, 4, 3.4, 10, 'percent', '0000-00-00', 92, 92, '2023-05-02 06:42:51', '2023-05-02 06:42:51'),
(93, 2, 94, 107, 5, '114.0600', NULL, 1, 15, NULL, 0, 15, 9.06, 10, 'percent', '0000-00-00', 94, 94, '2023-05-02 08:17:56', '2023-05-02 08:17:56'),
(94, 2, 94, 108, 5, '164.0600', NULL, 1, 15, NULL, 0, 15, 9.06, 10, 'percent', '0000-00-00', 94, 94, '2023-05-02 09:31:42', '2023-05-02 09:31:42'),
(95, 2, 94, 109, 5, '104.0600', NULL, 1, 15, NULL, 0, 15, 9.06, 20, 'fixed', '0000-00-00', 94, 94, '2023-05-02 09:32:42', '2023-05-02 09:32:42'),
(96, 2, 94, 110, 7, '234.0600', NULL, 1, 22, 53, 0, 0, 9.06, 10, 'percent', '0000-00-00', 94, 94, '2023-05-02 09:34:23', '2023-05-02 09:34:23'),
(97, 2, 94, 111, 7, '184.0600', NULL, 1, 22, 53, 0, 0, 9.06, 20, 'fixed', '0000-00-00', 94, 94, '2023-05-02 09:36:07', '2023-05-02 09:36:07'),
(98, 2, 94, 112, 7, '184.0600', NULL, 1, 22, 53, 0, 0, 9.06, 20, 'fixed', '0000-00-00', 94, 94, '2023-05-02 09:36:07', '2023-05-02 09:36:07'),
(99, 2, 95, 113, 5, '87.0000', NULL, 1, 21, NULL, 0, 4, 8, NULL, NULL, '0000-00-00', 95, 95, '2023-05-24 00:52:36', '2023-05-24 00:52:36'),
(100, 2, 95, 114, 5, '75.0000', NULL, 1, NULL, NULL, 0, NULL, NULL, 10, 'percent', NULL, 95, 95, '2023-05-24 01:13:31', '2023-05-24 01:13:31'),
(101, 2, 40, 115, 5, '77.0000', NULL, 1, 21, NULL, 0, 4, 8, 10, 'percent', '0000-00-00', 40, 40, '2023-05-24 23:38:19', '2023-05-24 23:38:19'),
(102, 2, 104, 119, 5, '363.2500', NULL, 1, 17, NULL, 0, 4, 9.25, NULL, NULL, '0000-00-00', 104, 104, '2023-06-29 22:38:02', '2023-06-29 22:38:02'),
(103, 2, 97, 120, 5, '83.0000', NULL, 1, 26, 79, 0, 0, 8, NULL, NULL, '0000-00-00', 97, 97, '2023-06-30 01:05:32', '2023-06-30 01:05:32'),
(104, 2, 105, 122, 5, '159.2500', NULL, 1, 26, 85, 0, 0, 9.25, NULL, NULL, '0000-00-00', 105, 105, '2023-07-01 04:47:07', '2023-07-01 04:47:07'),
(105, 2, 106, 123, 5, '159.2500', NULL, 1, 26, NULL, 0, 0, 9.25, NULL, NULL, '0000-00-00', 106, 106, '2023-07-01 04:50:03', '2023-07-01 04:50:03'),
(106, 2, 107, 124, 5, '150.0000', NULL, 4, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 107, 2, '2023-07-01 19:39:05', '2023-07-15 14:01:15'),
(107, 2, 108, 125, 5, '75.0000', NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 108, 108, '2023-07-03 22:54:49', '2023-07-03 22:54:49'),
(108, 2, 97, 126, 5, '225.0000', NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 97, 97, '2023-07-07 21:23:32', '2023-07-07 21:23:32'),
(109, 2, 97, 127, 5, '237.0000', NULL, 1, 21, NULL, 0, 4, 8, NULL, NULL, '0000-00-00', 97, 97, '2023-07-07 21:30:47', '2023-07-07 21:30:47'),
(110, 2, 109, 128, 5, '259.2500', NULL, 3, 26, NULL, 0, 0, 9.25, NULL, NULL, '0000-00-00', 109, 2, '2023-07-08 15:00:45', '2023-07-10 19:32:35'),
(111, 2, 110, 129, 5, '162.0000', NULL, 1, 21, NULL, 0, 4, 8, NULL, NULL, '0000-00-00', 110, 110, '2023-07-10 22:34:06', '2023-07-10 22:34:06'),
(112, 2, 6, 130, 7, '162.0000', 'hold for testing now', 4, 21, NULL, 0, 4, 8, NULL, NULL, '0000-00-00', 6, 2, '2023-07-13 19:31:06', '2023-07-18 20:20:02'),
(115, 2, 111, 135, 5, '75.0000', NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 111, 111, '2023-07-24 21:08:52', '2023-07-24 21:08:52'),
(116, 2, 112, 136, 6, '151.5000', NULL, 1, 26, NULL, 0, 4, 9.25, NULL, NULL, '0000-00-00', 112, 112, '2023-07-27 04:29:34', '2023-07-27 04:29:34'),
(117, 2, 113, 139, 5, '109.2500', NULL, 1, 26, 85, 0, 0, 9.25, NULL, NULL, '0000-00-00', 113, 113, '2023-08-04 11:03:24', '2023-08-04 11:03:24'),
(118, 2, 114, 140, 5, '550.0000', NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 114, 114, '2023-08-07 19:17:37', '2023-08-07 19:17:37'),
(119, 2, 116, 141, 5, '259.2500', NULL, 1, 26, NULL, 0, NULL, 9.25, NULL, NULL, '0000-00-00', 116, 116, '2023-08-08 01:31:58', '2023-08-08 01:31:58'),
(120, 2, 118, 143, NULL, '159.2500', NULL, 1, 26, NULL, 0, NULL, NULL, NULL, NULL, '2023-08-10', NULL, NULL, '2023-08-08 05:25:55', '2023-08-08 05:25:55'),
(121, 2, 119, 163, 99, '159.2500', NULL, 1, 26, NULL, 1, 0, 9.25, NULL, NULL, '2023-08-10', 119, 119, '2023-08-08 06:37:24', '2023-08-08 06:37:24'),
(122, 2, 119, 164, 99, '159.2500', NULL, 1, 26, NULL, 1, 0, 9.25, NULL, NULL, '2023-08-10', 119, 119, '2023-08-08 06:39:01', '2023-08-08 06:39:01'),
(123, 2, 119, 165, 99, '159.2500', NULL, 1, 26, NULL, 1, 0, 9.25, NULL, NULL, '2023-08-10', 119, 119, '2023-08-08 06:39:13', '2023-08-08 06:39:13'),
(124, 2, 119, 166, 99, '159.2500', NULL, 1, 26, NULL, 1, 0, 9.25, NULL, NULL, '2023-08-10', 119, 119, '2023-08-08 06:39:47', '2023-08-08 06:39:47'),
(125, 2, 119, 167, 99, '219.2500', NULL, 5, 26, NULL, 1, 10, 9.25, NULL, NULL, '2023-08-10', 119, 119, '2023-08-08 06:50:26', '2023-08-08 07:35:20'),
(126, 2, 120, 168, 104, '250.0000', NULL, 1, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 120, 120, '2023-08-10 14:08:09', '2023-08-10 14:08:09'),
(127, 2, 121, 169, 105, '149.2500', NULL, 1, 26, NULL, 1, 15, 9.25, NULL, NULL, '2023-08-12', 121, 121, '2023-08-10 14:11:21', '2023-08-10 14:11:21'),
(128, 2, 123, 174, 106, '109.2500', NULL, 1, 26, NULL, 1, 0, 9.25, NULL, NULL, '2023-08-13', 123, 123, '2023-08-11 13:30:28', '2023-08-11 13:30:28'),
(129, 2, 124, 175, 107, '119.2500', NULL, 1, 26, NULL, 1, 10, 9.25, NULL, NULL, '2023-08-13', 124, 124, '2023-08-11 13:37:36', '2023-08-11 13:37:36'),
(130, 2, 126, 176, 109, '250.0000', NULL, 1, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 126, 126, '2023-08-11 17:20:46', '2023-08-11 17:20:46'),
(131, 2, 134, 178, 8, '109.2500', NULL, 1, 26, NULL, 1, 0, 9.25, NULL, NULL, '2023-08-14', 134, 134, '2023-08-12 06:07:29', '2023-08-12 06:07:29'),
(132, 2, 137, 179, 9, '309.2500', NULL, 1, 26, 85, 1, 25, 9.25, NULL, NULL, '2023-08-14', 137, 137, '2023-08-12 18:49:30', '2023-08-12 18:49:30');

-- --------------------------------------------------------

--
-- Table structure for table `kbt_order_items`
--

CREATE TABLE `kbt_order_items` (
  `pk_order_items` bigint UNSIGNED NOT NULL,
  `pk_orders` bigint DEFAULT NULL,
  `pk_shipping_address` bigint NOT NULL,
  `pk_arrangement_type` bigint NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `quantity` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(15,4) DEFAULT '0.0000',
  `card_message` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint DEFAULT NULL,
  `updated_by` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kbt_order_items`
--

INSERT INTO `kbt_order_items` (`pk_order_items`, `pk_orders`, `pk_shipping_address`, `pk_arrangement_type`, `name`, `description`, `quantity`, `price`, `card_message`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 0, 'Low & Lush - Classic', '', '1', '100.0000', '', 69, 69, '2023-03-21 15:13:41', '2023-03-21 15:13:41'),
(2, 2, 0, 0, 'Low & Lush - Classic', '', '1', '100.0000', '', 70, 70, '2023-03-22 08:31:26', '2023-03-22 08:31:26'),
(3, 3, 0, 0, 'Low & Lush - Classic', '', '1', '150.0000', '', 71, 71, '2023-03-22 08:35:20', '2023-03-22 08:35:20'),
(4, 4, 0, 0, 'Low & Lush - Classic', '', '1', '75.0000', '', 40, 40, '2023-03-22 18:01:11', '2023-03-22 18:01:11'),
(5, 5, 0, 0, 'Low & Lush - Classic', '', '1', '75.0000', '', 40, 40, '2023-03-22 18:02:27', '2023-03-22 18:02:27'),
(6, 6, 0, 0, 'Low & Lush - Classic', '', '1', '100.0000', '', 77, 77, '2023-03-22 18:55:10', '2023-03-22 18:55:10'),
(7, 7, 0, 0, 'Low & Lush - Classic', '', '1', '75.0000', '', 40, 40, '2023-03-22 20:30:34', '2023-03-22 20:30:34'),
(8, 8, 0, 0, 'Low & Lush - Classic', '', '1', '75.0000', '', 40, 40, '2023-03-30 21:12:50', '2023-03-30 21:12:50'),
(9, 9, 0, 0, 'Low & Lush - Classic', '', '1', '75.0000', '', 40, 40, '2023-04-03 18:03:51', '2023-04-03 18:03:51'),
(10, 10, 0, 0, 'Low & Lush - Classic', '', '1', '100.0000', '', 40, 40, '2023-04-04 09:24:59', '2023-04-04 09:24:59'),
(11, 11, 0, 0, 'Low & Lush - Classic', '', '1', '75.0000', '', 40, 40, '2023-04-07 23:37:46', '2023-04-07 23:37:46'),
(12, 12, 0, 0, 'Low & Lush - Classic', '', '2', '100.0000', '', 80, 80, '2023-04-10 13:28:50', '2023-04-10 13:28:50'),
(13, 13, 0, 0, 'Low & Lush - Classic', '', '1', '150.0000', '', 80, 80, '2023-04-10 13:55:58', '2023-04-10 13:55:58'),
(14, 14, 0, 0, 'Low & Lush - Classic', '', '1', '150.0000', '', 80, 80, '2023-04-10 13:55:58', '2023-04-10 13:55:58'),
(15, 15, 0, 0, 'Low & Lush - Classic', '', '1', '100.0000', '', 80, 80, '2023-04-10 16:37:13', '2023-04-10 16:37:13'),
(16, 16, 0, 0, 'Low & Lush - Classic', '', '1', '75.0000', '', 40, 40, '2023-04-11 02:45:39', '2023-04-11 02:45:39'),
(17, 17, 0, 0, 'Low & Lush - Classic', '', '1', '100.0000', '', 81, 81, '2023-04-25 17:29:54', '2023-04-25 17:29:54'),
(18, 18, 0, 0, 'Low & Lush - Classic', '', '1', '100.0000', '', 81, 81, '2023-04-25 17:30:35', '2023-04-25 17:30:35'),
(19, 19, 0, 0, 'Low & Lush - Classic', '', '1', '125.0000', '', 81, 81, '2023-04-25 17:40:23', '2023-04-25 17:40:23'),
(20, 20, 0, 0, 'Low & Lush - Classic', '', '1', '100.0000', '', 81, 81, '2023-04-25 17:43:34', '2023-04-25 17:43:34'),
(21, 23, 0, 0, 'Low & Lush - Classic', '', '1', '100.0000', '', 81, 81, '2023-04-25 17:55:54', '2023-04-25 17:55:54'),
(22, 24, 0, 0, 'Low & Lush - Classic', '', '1', '100.0000', '', 81, 81, '2023-04-25 18:08:19', '2023-04-25 18:08:19'),
(23, 25, 0, 0, 'Low & Lush - Classic', '', '1', '100.0000', '', 81, 81, '2023-04-25 18:09:48', '2023-04-25 18:09:48'),
(24, 26, 0, 0, 'Low & Lush - Classic', '', '1', '150.0000', '', 81, 81, '2023-04-25 18:11:47', '2023-04-25 18:11:47'),
(25, 26, 0, 0, 'Low & Lush - Classic', '', '1', '150.0000', '', 81, 81, '2023-04-25 18:11:47', '2023-04-25 18:11:47'),
(26, 27, 0, 0, 'Low & Lush - Classic', '', '1', '150.0000', '', 82, 82, '2023-04-25 18:22:13', '2023-04-25 18:22:13'),
(27, 27, 0, 0, 'Low & Lush - Classic', '', '1', '150.0000', '', 82, 82, '2023-04-25 18:22:13', '2023-04-25 18:22:13'),
(28, 28, 0, 0, 'Low & Lush - Classic', '', '1', '90.0000', '', 83, 83, '2023-04-25 18:23:53', '2023-04-25 18:23:53'),
(29, 29, 0, 0, 'Low & Lush - Classic', '', '1', '100.0000', '', 84, 84, '2023-04-26 08:06:51', '2023-04-26 08:06:51'),
(30, 30, 0, 0, 'Low & Lush - Classic', '', '1', '100.0000', '', 84, 84, '2023-04-26 08:08:02', '2023-04-26 08:08:02'),
(31, 31, 0, 0, 'Low & Lush - Classic', '', '1', '100.0000', '', 85, 85, '2023-04-26 08:14:27', '2023-04-26 08:14:27'),
(32, 31, 0, 0, 'Low & Lush - Classic', '', '1', '100.0000', '', 85, 85, '2023-04-26 08:14:27', '2023-04-26 08:14:27'),
(33, 32, 0, 0, 'Low & Lush - Classic', '', '1', '100.0000', '', 85, 85, '2023-04-26 09:00:05', '2023-04-26 09:00:05'),
(34, 33, 0, 0, 'Low & Lush - Classic', '', '1', '150.0000', '', 86, 86, '2023-04-26 09:06:47', '2023-04-26 09:06:47'),
(35, 34, 0, 0, 'Low & Lush - Classic', '', '1', '75.0000', '', 40, 40, '2023-04-26 19:31:24', '2023-04-26 19:31:24'),
(36, 35, 0, 0, 'Low & Lush - Classic', '', '1', '75.0000', '', 40, 40, '2023-04-26 19:33:48', '2023-04-26 19:33:48'),
(37, 36, 0, 0, 'Low & Lush - Classic', '', '1', '75.0000', '', 40, 40, '2023-04-26 19:40:53', '2023-04-26 19:40:53'),
(38, 37, 0, 0, 'Low & Lush - Classic', '', '1', '100.0000', '', 87, 87, '2023-04-27 09:07:51', '2023-04-27 09:07:51'),
(39, 38, 0, 0, 'Low & Lush - Classic', '', '1', '100.0000', '', 87, 87, '2023-04-27 09:38:35', '2023-04-27 09:38:35'),
(40, 39, 0, 0, 'Low & Lush - Classic', '', '1', '100.0000', '', 87, 87, '2023-04-27 10:59:45', '2023-04-27 10:59:45'),
(41, 40, 0, 0, 'Low & Lush - Classic', '', '1', '100.0000', '', 87, 87, '2023-04-27 11:02:58', '2023-04-27 11:02:58'),
(42, 41, 0, 0, 'Low & Lush - Classic', '', '1', '100.0000', '', 87, 87, '2023-04-27 11:16:32', '2023-04-27 11:16:32'),
(43, 42, 0, 0, 'Low & Lush - Classic', '', '1', '75.0000', '', 40, 40, '2023-04-27 21:00:53', '2023-04-27 21:00:53'),
(44, 43, 0, 0, 'Low & Lush - Classic', '', '1', '75.0000', '', 40, 40, '2023-04-27 21:05:46', '2023-04-27 21:05:46'),
(45, 44, 0, 0, 'Low & Lush - Classic', '', '1', '75.0000', '', 40, 40, '2023-04-27 21:08:59', '2023-04-27 21:08:59'),
(46, 45, 0, 0, 'Low & Lush - Classic', '', '1', '75.0000', '', 40, 40, '2023-04-27 21:14:09', '2023-04-27 21:14:09'),
(47, 46, 0, 0, 'Low & Lush - Classic', '', '1', '100.0000', '', 87, 87, '2023-04-28 07:35:50', '2023-04-28 07:35:50'),
(48, 47, 0, 0, 'Low & Lush - Classic', '', '1', '150.0000', '', 87, 87, '2023-04-28 07:39:53', '2023-04-28 07:39:53'),
(49, 47, 0, 0, 'Low & Lush - Classic', '', '1', '150.0000', '', 87, 87, '2023-04-28 07:39:53', '2023-04-28 07:39:53'),
(50, 48, 0, 0, 'Low & Lush - Classic', '', '1', '100.0000', '', 87, 87, '2023-04-28 07:51:11', '2023-04-28 07:51:11'),
(51, 49, 0, 0, 'Low & Lush - Classic', '', '1', '100.0000', '', 87, 87, '2023-04-28 07:59:37', '2023-04-28 07:59:37'),
(52, 49, 0, 0, 'Low & Lush - Classic', '', '1', '100.0000', '', 87, 87, '2023-04-28 07:59:37', '2023-04-28 07:59:37'),
(53, 50, 0, 0, 'Low & Lush - Classic', '', '1', '75.0000', '', 87, 87, '2023-04-28 08:03:01', '2023-04-28 08:03:01'),
(54, 51, 0, 0, 'Low & Lush - Classic', '', '1', '150.0000', '', 88, 88, '2023-04-28 09:27:00', '2023-04-28 09:27:00'),
(55, 52, 0, 0, 'Low & Lush - Classic', '', '1', '150.0000', '', 88, 88, '2023-04-28 10:39:33', '2023-04-28 10:39:33'),
(56, 55, 0, 0, 'Low & Lush - Classic', '', '1', '100.0000', '', 88, 88, '2023-04-28 11:56:58', '2023-04-28 11:56:58'),
(57, 59, 0, 0, 'Low & Lush - Classic', '', '1', '100.0000', '', 88, 88, '2023-04-28 12:25:09', '2023-04-28 12:25:09'),
(58, 60, 0, 0, 'Low & Lush - Classic', '', '1', '150.0000', '', 88, 88, '2023-04-28 12:28:10', '2023-04-28 12:28:10'),
(59, 61, 0, 0, 'Low & Lush - Classic', '', '1', '100.0000', '', 88, 88, '2023-04-28 12:29:35', '2023-04-28 12:29:35'),
(60, 61, 0, 0, 'Low & Lush - Classic', '', '1', '100.0000', '', 88, 88, '2023-04-28 12:29:35', '2023-04-28 12:29:35'),
(61, 62, 0, 0, 'Low & Lush - Classic', '', '1', '100.0000', '', 88, 88, '2023-04-28 16:26:29', '2023-04-28 16:26:29'),
(62, 63, 0, 0, 'Low & Lush - Classic', '', '1', '75.0000', '', 40, 40, '2023-04-28 22:56:33', '2023-04-28 22:56:33'),
(63, 64, 0, 0, 'Low & Lush - Classic', '', '1', '100.0000', '', 88, 88, '2023-05-01 05:14:19', '2023-05-01 05:14:19'),
(64, 66, 0, 0, 'Low & Lush - Classic', '', '1', '75.0000', '', 89, 89, '2023-05-01 06:57:40', '2023-05-01 06:57:40'),
(65, 67, 0, 0, 'Low & Lush - Classic', '', '1', '90.0000', '', 89, 89, '2023-05-01 07:14:17', '2023-05-01 07:14:17'),
(66, 68, 0, 0, 'Low & Lush - Classic', '', '1', '150.0000', '', 89, 89, '2023-05-01 07:18:10', '2023-05-01 07:18:10'),
(67, 69, 0, 0, 'Low & Lush - Classic', '', '1', '150.0000', '', 89, 89, '2023-05-01 07:20:14', '2023-05-01 07:20:14'),
(68, 73, 0, 0, 'Low & Lush - Classic', '', '1', '125.0000', '', 89, 89, '2023-05-01 07:27:58', '2023-05-01 07:27:58'),
(69, 74, 0, 0, 'Low & Lush - Classic', '', '1', '100.0000', '', 90, 90, '2023-05-01 08:24:16', '2023-05-01 08:24:16'),
(70, 75, 0, 0, 'Low & Lush - Classic', '', '1', '200.0000', '', 90, 90, '2023-05-01 08:25:55', '2023-05-01 08:25:55'),
(71, 76, 0, 0, 'Low & Lush - Classic', '', '1', '100.0000', '', 90, 90, '2023-05-01 09:49:23', '2023-05-01 09:49:23'),
(72, 77, 0, 0, 'Low & Lush - Classic', '', '1', '125.0000', '', 90, 90, '2023-05-01 10:14:04', '2023-05-01 10:14:04'),
(73, 78, 0, 0, 'Low & Lush - Classic', '', '1', '175.0000', '', 90, 90, '2023-05-01 10:15:18', '2023-05-01 10:15:18'),
(74, 79, 0, 0, 'Low & Lush - Classic', '', '1', '150.0000', '', 90, 90, '2023-05-01 10:18:26', '2023-05-01 10:18:26'),
(75, 80, 0, 0, 'Low & Lush - Classic', '', '1', '100.0000', '', 90, 90, '2023-05-01 10:33:45', '2023-05-01 10:33:45'),
(76, 81, 0, 0, 'Low & Lush - Classic', '', '1', '100.0000', '', 90, 90, '2023-05-01 10:34:30', '2023-05-01 10:34:30'),
(77, 82, 0, 0, 'Low & Lush - Classic', '', '1', '100.0000', '', 90, 90, '2023-05-01 10:37:45', '2023-05-01 10:37:45'),
(78, 83, 0, 0, 'Low & Lush - Classic', '', '1', '100.0000', '', 90, 90, '2023-05-01 10:38:42', '2023-05-01 10:38:42'),
(79, 84, 0, 0, 'Low & Lush - Classic', '', '1', '75.0000', '', 40, 40, '2023-05-02 04:24:09', '2023-05-02 04:24:09'),
(80, 85, 0, 0, 'Low & Lush - Classic', '', '1', '75.0000', '', 40, 40, '2023-05-02 04:25:19', '2023-05-02 04:25:19'),
(81, 86, 0, 0, 'Low & Lush - Classic', '', '1', '75.0000', '', 40, 40, '2023-05-02 04:26:57', '2023-05-02 04:26:57'),
(82, 87, 0, 0, 'Low & Lush - Classic', '', '1', '75.0000', '', 40, 40, '2023-05-02 04:31:32', '2023-05-02 04:31:32'),
(83, 88, 0, 0, 'Low & Lush - Classic', '', '1', '75.0000', '', 40, 40, '2023-05-02 04:34:06', '2023-05-02 04:34:06'),
(84, 89, 0, 0, 'Low & Lush - Classic', '', '1', '75.0000', '', 91, 91, '2023-05-02 05:23:01', '2023-05-02 05:23:01'),
(85, 90, 0, 0, 'Low & Lush - Classic', '', '1', '75.0000', '', 91, 91, '2023-05-02 05:38:40', '2023-05-02 05:38:40'),
(86, 91, 0, 0, 'Low & Lush - Classic', '', '1', '150.0000', '', 91, 91, '2023-05-02 05:55:06', '2023-05-02 05:55:06'),
(87, 92, 0, 0, 'Low & Lush - Classic', '', '1', '75.0000', '', 92, 92, '2023-05-02 06:42:51', '2023-05-02 06:42:51'),
(88, 93, 0, 0, 'Low & Lush - Classic', '', '1', '100.0000', '', 94, 94, '2023-05-02 08:17:56', '2023-05-02 08:17:56'),
(89, 94, 0, 0, 'Low & Lush - Classic', '', '1', '150.0000', '', 94, 94, '2023-05-02 09:31:42', '2023-05-02 09:31:42'),
(90, 95, 0, 0, 'Low & Lush - Classic', '', '1', '100.0000', '', 94, 94, '2023-05-02 09:32:42', '2023-05-02 09:32:42'),
(91, 96, 0, 0, 'Low & Lush - Premium', '', '1', '225.0000', '', 94, 94, '2023-05-02 09:34:23', '2023-05-02 09:34:23'),
(92, 97, 0, 0, 'Low & Lush - Premium', '', '1', '175.0000', '', 94, 94, '2023-05-02 09:36:07', '2023-05-02 09:36:07'),
(93, 98, 0, 0, 'Low & Lush - Premium', '', '1', '175.0000', '', 94, 94, '2023-05-02 09:36:07', '2023-05-02 09:36:07'),
(94, 99, 0, 0, 'Low & Lush - Classic', '', '1', '75.0000', '', 95, 95, '2023-05-24 00:52:36', '2023-05-24 00:52:36'),
(95, 100, 0, 0, 'Low & Lush - Classic', '', '1', '75.0000', '', 95, 95, '2023-05-24 01:13:31', '2023-05-24 01:13:31'),
(96, 101, 0, 0, 'Low & Lush - Classic', '', '1', '75.0000', '', 40, 40, '2023-05-24 23:38:19', '2023-05-24 23:38:19'),
(97, 102, 0, 0, 'Low & Lush - Classic', '', '2', '175.0000', '', 104, 104, '2023-06-29 22:38:02', '2023-06-29 22:38:02'),
(98, 103, 0, 0, 'Low & Lush - Classic', '', '1', '75.0000', '', 97, 97, '2023-06-30 01:05:32', '2023-06-30 01:05:32'),
(99, 104, 0, 0, 'Low & Lush - Classic', '', '1', '150.0000', '', 105, 105, '2023-07-01 04:47:07', '2023-07-01 04:47:07'),
(100, 105, 0, 0, 'Low & Lush - Classic', '', '1', '150.0000', '', 106, 106, '2023-07-01 04:50:03', '2023-07-01 04:50:03'),
(101, 106, 0, 0, 'Low & Lush - Classic', '', '1', '150.0000', '', 107, 107, '2023-07-01 19:39:05', '2023-07-01 19:39:05'),
(102, 107, 0, 0, 'Low & Lush - Classic', '', '1', '75.0000', '', 108, 108, '2023-07-03 22:54:49', '2023-07-03 22:54:49'),
(103, 108, 0, 0, 'Low & Lush - Classic', '', '3', '75.0000', '', 97, 97, '2023-07-07 21:23:32', '2023-07-07 21:23:32'),
(104, 109, 0, 0, 'Low & Lush - Classic', '', '3', '75.0000', '', 97, 97, '2023-07-07 21:30:47', '2023-07-07 21:30:47'),
(105, 110, 0, 0, 'Low & Lush - Classic', '', '2', '125.0000', '', 109, 109, '2023-07-08 15:00:45', '2023-07-08 15:00:45'),
(106, 111, 0, 0, 'Low & Lush - Classic', '', '2', '75.0000', '', 110, 110, '2023-07-10 22:34:06', '2023-07-10 22:34:06'),
(107, 112, 0, 0, 'Low & Lush - Premium', '', '1', '150.0000', '', 6, 6, '2023-07-13 19:31:06', '2023-07-13 19:31:06'),
(108, 113, 0, 0, 'Low & Lush - Classic', '', '1', '75.0000', '', 97, 97, '2023-07-14 23:17:11', '2023-07-14 23:17:11'),
(109, 114, 0, 0, 'Low & Lush - Classic', '', '1', '75.0000', '', 97, 97, '2023-07-14 23:30:17', '2023-07-14 23:30:17'),
(110, 115, 0, 0, 'Low & Lush - Classic', '', '1', '75.0000', '', 111, 111, '2023-07-24 21:08:52', '2023-07-24 21:08:52'),
(111, 116, 0, 0, 'Low & Lush', '', '1', '0.0000', '', 112, 112, '2023-07-27 04:29:34', '2023-07-27 04:29:34'),
(112, 116, 0, 0, 'Low & Lush - Deluxe', '', '1', '125.0000', '', 112, 112, '2023-07-27 04:29:34', '2023-07-27 04:29:34'),
(113, 117, 0, 0, 'Classic', '', '1', '100.0000', '', 113, 113, '2023-08-04 11:03:24', '2023-08-04 11:03:24'),
(114, 118, 1, 5, 'CLEMENTINE', '', '2', '200.0000', 'test', 114, 114, '2023-08-07 19:17:37', '2023-08-07 19:17:37'),
(115, 118, 1, 5, 'STRAWBERRY', '', '1', '150.0000', 'test', 114, 114, '2023-08-07 19:17:37', '2023-08-07 19:17:37'),
(116, 119, 1, 5, 'STARBURST', '', '1', '100.0000', 'test', 116, 116, '2023-08-08 01:31:58', '2023-08-08 01:31:58'),
(117, 119, 1, 5, 'STRAWBERRY', '', '1', '150.0000', 'test', 116, 116, '2023-08-08 01:31:58', '2023-08-08 01:31:58'),
(118, 121, 1, 5, 'MAI TAI', '', '1', '150.0000', '', 119, 119, '2023-08-08 06:37:24', '2023-08-08 06:37:24'),
(119, 122, 1, 5, 'MAI TAI', '', '1', '150.0000', '', 119, 119, '2023-08-08 06:39:01', '2023-08-08 06:39:01'),
(120, 123, 1, 5, 'MAI TAI', '', '1', '150.0000', '', 119, 119, '2023-08-08 06:39:13', '2023-08-08 06:39:13'),
(121, 124, 1, 5, 'MAI TAI', '', '1', '150.0000', '', 119, 119, '2023-08-08 06:39:47', '2023-08-08 06:39:47'),
(122, 125, 1, 5, 'MERLOT', '', '1', '125.0000', '', 119, 119, '2023-08-08 06:50:26', '2023-08-08 06:50:26'),
(123, 125, 1, 5, 'SHERBET', '', '1', '75.0000', '', 119, 119, '2023-08-08 06:50:26', '2023-08-08 06:50:26'),
(124, 126, 1, 5, 'MERLOT', '', '2', '125.0000', '', 120, 120, '2023-08-10 14:08:09', '2023-08-10 14:08:09'),
(125, 127, 1, 5, 'RED', '', '1', '125.0000', '', 121, 121, '2023-08-10 14:11:21', '2023-08-10 14:11:21'),
(126, 128, 1, 5, 'STARBURST', '', '1', '100.0000', '', 123, 123, '2023-08-11 13:30:28', '2023-08-11 13:30:28'),
(127, 129, 1, 5, 'STARBURST', '', '1', '100.0000', 'tesgtj', 124, 124, '2023-08-11 13:37:36', '2023-08-11 13:37:36'),
(128, 130, 1, 5, 'STARBURST', '', '1', '100.0000', '', 126, 126, '2023-08-11 17:20:46', '2023-08-11 17:20:46'),
(129, 130, 1, 5, 'MAI TAI', '', '1', '150.0000', '', 126, 126, '2023-08-11 17:20:46', '2023-08-11 17:20:46'),
(130, 131, 1, 5, 'STARBURST', '', '1', '100.0000', 'jiya', 134, 134, '2023-08-12 06:07:29', '2023-08-12 06:07:29'),
(131, 132, 1, 5, 'MAI TAI', '', '1', '150.0000', '', 137, 137, '2023-08-12 18:49:30', '2023-08-12 18:49:30'),
(132, 132, 1, 5, 'RED', '', '1', '125.0000', 'newa', 137, 137, '2023-08-12 18:49:30', '2023-08-12 18:49:30');

-- --------------------------------------------------------

--
-- Table structure for table `kbt_order_status`
--

CREATE TABLE `kbt_order_status` (
  `pk_order_status` bigint UNSIGNED NOT NULL,
  `order_status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kbt_order_status`
--

INSERT INTO `kbt_order_status` (`pk_order_status`, `order_status`, `description`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'new', NULL, 1, NULL, 1, '2022-12-04 07:54:18', '2023-01-10 11:11:37'),
(2, 'in-transit', NULL, 1, NULL, NULL, '2022-12-04 07:54:18', '2022-12-04 07:54:18'),
(3, 'Delivered', NULL, 1, NULL, 1, '2022-12-04 07:54:18', '2023-07-05 02:07:54'),
(4, 'hold', NULL, 1, NULL, NULL, '2022-12-04 07:54:18', '2022-12-04 07:54:18'),
(5, 'Canceled', 'Canceled', 1, NULL, 1, '2022-12-04 07:54:18', '2023-01-09 07:54:01');

-- --------------------------------------------------------

--
-- Table structure for table `kbt_products`
--

CREATE TABLE `kbt_products` (
  `pk_products` bigint UNSIGNED NOT NULL,
  `pk_account` bigint UNSIGNED NOT NULL,
  `pk_locations` int NOT NULL,
  `product` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pk_product_category` bigint UNSIGNED NOT NULL,
  `pk_flowers` bigint UNSIGNED DEFAULT NULL,
  `pk_color_flower` bigint UNSIGNED DEFAULT NULL,
  `price` bigint NOT NULL,
  `location_bar_code` bigint DEFAULT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kbt_products`
--

INSERT INTO `kbt_products` (`pk_products`, `pk_account`, `pk_locations`, `product`, `description`, `pk_product_category`, `pk_flowers`, `pk_color_flower`, `price`, `location_bar_code`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(5, 1, 17, 'venice product', 'test', 6, 1, 1, 10, NULL, 1, 2, 2, '2023-06-16 11:26:19', '2023-06-27 06:18:16'),
(7, 1, 15, 'hawthorne product', NULL, 1, 2, 2, 10, NULL, 1, 6, 2, '2023-06-16 21:57:13', '2023-06-26 05:29:30'),
(8, 2, 16, 'beverly hills product', NULL, 3, 1, 1, 20, 555, 1, 6, 6, '2023-06-16 21:58:26', '2023-06-16 21:58:26'),
(9, 2, 18, 'el segundo product', NULL, 6, 1, 2, 30, 666, 1, 6, 6, '2023-06-16 21:58:58', '2023-06-16 21:58:58'),
(10, 2, 20, 'CC product', NULL, 5, 1, 1, 40, 777, 1, 6, 6, '2023-06-16 21:59:34', '2023-06-16 21:59:34'),
(11, 2, 21, 'Inglewood product', NULL, 8, 1, 5, 50, 888, 1, 6, 6, '2023-06-16 22:00:15', '2023-06-16 22:00:15'),
(12, 1, 22, 'torrance product', NULL, 1, 1, 1, 60, NULL, 1, 6, 2, '2023-06-16 22:01:13', '2023-06-22 17:27:03'),
(13, 1, 17, 'testing', NULL, 2, 1, 1, 12, 14441111, 1, 2, 2, '2023-07-30 18:07:24', '2023-07-30 18:07:24');

-- --------------------------------------------------------

--
-- Table structure for table `kbt_product_category`
--

CREATE TABLE `kbt_product_category` (
  `pk_product_category` bigint UNSIGNED NOT NULL,
  `pk_account` bigint UNSIGNED NOT NULL,
  `product_category` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kbt_product_category`
--

INSERT INTO `kbt_product_category` (`pk_product_category`, `pk_account`, `product_category`, `description`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 2, 'seasonal', NULL, 1, NULL, NULL, '2022-12-04 07:54:18', '2022-12-04 07:54:18'),
(2, 2, 'holiday', NULL, 1, NULL, NULL, '2022-12-04 07:54:18', '2022-12-04 07:54:18'),
(3, 2, 'neutral', NULL, 1, NULL, NULL, '2022-12-04 07:54:18', '2022-12-04 07:54:18'),
(4, 2, 'bright & punchy', NULL, 1, NULL, NULL, '2022-12-04 07:54:18', '2022-12-04 07:54:18'),
(5, 2, 'pastels', NULL, 1, NULL, NULL, '2022-12-04 07:54:18', '2022-12-04 07:54:18'),
(6, 2, 'monochromatic', NULL, 1, NULL, NULL, '2022-12-04 07:54:18', '2022-12-04 07:54:18'),
(7, 2, 'roses', NULL, 1, NULL, NULL, '2022-12-04 07:54:18', '2022-12-04 07:54:18'),
(8, 2, 'tropicals', NULL, 1, NULL, NULL, '2022-12-04 07:54:18', '2022-12-04 07:54:18'),
(9, 2, 'designers choice', NULL, 1, NULL, NULL, '2022-12-04 07:54:18', '2022-12-04 07:54:18'),
(10, 2, 'greeting cards', NULL, 1, NULL, NULL, '2022-12-04 07:54:18', '2022-12-04 07:54:18'),
(11, 2, 'gifts', NULL, 1, NULL, NULL, '2022-12-04 07:54:18', '2022-12-04 07:54:18'),
(12, 2, 'everything', NULL, 1, NULL, NULL, '2022-12-04 07:54:18', '2022-12-04 07:54:18');

-- --------------------------------------------------------

--
-- Table structure for table `kbt_product_images`
--

CREATE TABLE `kbt_product_images` (
  `pk_product_images` bigint UNSIGNED NOT NULL,
  `pk_account` bigint UNSIGNED NOT NULL,
  `pk_products` bigint UNSIGNED NOT NULL,
  `path` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kbt_product_images`
--

INSERT INTO `kbt_product_images` (`pk_product_images`, `pk_account`, `pk_products`, `path`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(4, 1, 5, '202306161126large-_2_.png', 2, 2, '2023-06-16 11:26:19', '2023-06-16 11:26:19'),
(7, 2, 8, '202306162158flower 2.jpg', 6, 6, '2023-06-16 21:58:26', '2023-06-16 21:58:26'),
(8, 2, 9, '202306162158flower 3.jpg', 6, 6, '2023-06-16 21:58:58', '2023-06-16 21:58:58'),
(9, 2, 10, '202306162159flower 4.jpg', 6, 6, '2023-06-16 21:59:34', '2023-06-16 21:59:34'),
(10, 2, 11, '202306162200flower 5.jpg', 6, 6, '2023-06-16 22:00:15', '2023-06-16 22:00:15'),
(11, 2, 12, '202306162201flower 6.jpg', 6, 6, '2023-06-16 22:01:13', '2023-06-16 22:01:13'),
(12, 0, 6, '202306221747images.jpg', 2, 2, '2023-06-22 17:47:09', '2023-06-22 17:47:09'),
(13, 0, 6, '202306221747Kissed by tulips temp logo.png', 2, 2, '2023-06-22 17:47:09', '2023-06-22 17:47:09'),
(14, 0, 7, '202306222125flower 1.jpg', 6, 6, '2023-06-22 21:25:47', '2023-06-22 21:25:47'),
(16, 0, 2, '202306230347ASDShowFloor.png', 6, 6, '2023-06-23 03:47:59', '2023-06-23 03:47:59'),
(19, 0, 4, '202306270612topcone image.jpg', 6, 6, '2023-06-27 06:12:13', '2023-06-27 06:12:13'),
(20, 0, 5, '202306270618php1.jpg', 2, 2, '2023-06-27 06:18:16', '2023-06-27 06:18:16'),
(21, 0, 4, '202306270618php1.jpg', 2, 2, '2023-06-27 06:18:46', '2023-06-27 06:18:46'),
(22, 0, 4, '202306270623flower 1.jpg', 6, 6, '2023-06-27 06:23:08', '2023-06-27 06:23:08'),
(23, 0, 4, '202306270623flower 2.jpg', 6, 6, '2023-06-27 06:23:08', '2023-06-27 06:23:08'),
(24, 1, 13, '202307301807large-_2_.png', 2, 2, '2023-07-30 18:07:24', '2023-07-30 18:07:24');

-- --------------------------------------------------------

--
-- Table structure for table `kbt_product_sub_category`
--

CREATE TABLE `kbt_product_sub_category` (
  `pk_product_sub_category` bigint UNSIGNED NOT NULL,
  `pk_account` bigint UNSIGNED NOT NULL,
  `pk_product_category` bigint NOT NULL,
  `product_sub_category` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kbt_product_sub_category`
--

INSERT INTO `kbt_product_sub_category` (`pk_product_sub_category`, `pk_account`, `pk_product_category`, `product_sub_category`, `description`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 2, 8, 'test sub', NULL, 1, 6, 6, '2023-01-24 20:41:11', '2023-01-24 20:41:11');

-- --------------------------------------------------------

--
-- Table structure for table `kbt_purchase_order`
--

CREATE TABLE `kbt_purchase_order` (
  `pk_purchase_order` bigint NOT NULL,
  `pk_vendors` bigint NOT NULL,
  `po_number` bigint NOT NULL,
  `delivery_date_request` date NOT NULL,
  `pk_locations` varchar(10) DEFAULT NULL,
  `shipping_address` varchar(200) NOT NULL,
  `shipping_address_1` varchar(200) DEFAULT NULL,
  `shipping_city` varchar(80) DEFAULT NULL,
  `shipping_state` varchar(80) DEFAULT NULL,
  `shipping_country` varchar(80) DEFAULT NULL,
  `shipping_zip` varchar(50) DEFAULT NULL,
  `pk_users` bigint DEFAULT NULL,
  `pk_account` bigint DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` bigint DEFAULT NULL,
  `updated_by` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kbt_purchase_order`
--

INSERT INTO `kbt_purchase_order` (`pk_purchase_order`, `pk_vendors`, `po_number`, `delivery_date_request`, `pk_locations`, `shipping_address`, `shipping_address_1`, `shipping_city`, `shipping_state`, `shipping_country`, `shipping_zip`, `pk_users`, `pk_account`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 9, 123, '2023-07-27', '17', '3467 Adina Drive', '3467', 'Los Angeles', NULL, NULL, '90068', 2, 1, 1, 2, 2, '2023-07-25 18:49:31', '2023-07-25 18:55:45');

-- --------------------------------------------------------

--
-- Table structure for table `kbt_purchase_order_items`
--

CREATE TABLE `kbt_purchase_order_items` (
  `pk_purchase_order_items` bigint NOT NULL,
  `pk_purchase_order` bigint NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `quantity` bigint NOT NULL,
  `price` decimal(10,2) DEFAULT '0.00',
  `total` bigint NOT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `created_by` bigint DEFAULT NULL,
  `updated_by` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kbt_purchase_order_items`
--

INSERT INTO `kbt_purchase_order_items` (`pk_purchase_order_items`, `pk_purchase_order`, `name`, `description`, `quantity`, `price`, `total`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(5, 1, 'el segundo product', '', 2, '30.00', 60, 1, NULL, 1, '2023-07-25 18:55:45', '2023-07-25 18:55:45'),
(6, 1, 'el segundo product', '', 2, '30.00', 60, 1, NULL, 1, '2023-07-25 18:55:45', '2023-07-25 18:55:45'),
(7, 1, 'el segundo product', '', 2, '30.00', 60, 1, NULL, 1, '2023-07-25 18:55:45', '2023-07-25 18:55:45'),
(8, 1, 'el segundo product', '', 2, '30.00', 60, 1, NULL, 1, '2023-07-25 18:55:45', '2023-07-25 18:55:45');

-- --------------------------------------------------------

--
-- Table structure for table `kbt_roles`
--

CREATE TABLE `kbt_roles` (
  `pk_roles` bigint UNSIGNED NOT NULL,
  `roles` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kbt_roles`
--

INSERT INTO `kbt_roles` (`pk_roles`, `roles`, `description`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Superadmin', NULL, 1, 1, 1, '2022-12-04 07:54:17', '2023-01-09 07:51:15'),
(2, 'Account Admin', NULL, 1, 1, 1, '2022-12-04 07:54:17', '2023-01-09 07:50:46'),
(3, 'Location Manager', NULL, 1, 1, 1, '2022-12-04 07:54:17', '2023-01-09 07:51:05'),
(4, 'Customer', NULL, 1, 1, 1, '2022-12-04 07:54:17', '2023-01-09 07:50:54'),
(5, 'Vendor', NULL, 1, 1, 1, '2022-12-08 04:06:31', '2022-12-08 04:06:31'),
(6, 'Assistant', NULL, 1, 1, 1, '2023-06-16 07:21:56', '2023-06-16 07:21:56'),
(7, 'Accountant', NULL, 1, 1, 1, '2023-06-16 07:22:04', '2023-06-16 07:22:04');

-- --------------------------------------------------------

--
-- Table structure for table `kbt_sales`
--

CREATE TABLE `kbt_sales` (
  `pk_sales` bigint UNSIGNED NOT NULL,
  `pk_orders` bigint UNSIGNED DEFAULT NULL,
  `pk_users` bigint UNSIGNED DEFAULT NULL,
  `pk_account` bigint UNSIGNED NOT NULL DEFAULT '2',
  `pk_arrangement_type` bigint UNSIGNED DEFAULT NULL,
  `pk_transactions` int UNSIGNED DEFAULT NULL,
  `customer_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pk_customers` bigint UNSIGNED DEFAULT NULL,
  `subtotal` double NOT NULL DEFAULT '0',
  `tax_total` double NOT NULL DEFAULT '0',
  `total` double NOT NULL DEFAULT '0',
  `is_paid` tinyint(1) NOT NULL DEFAULT '0',
  `discountCharge` double DEFAULT NULL,
  `coupon_discount_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pk_sales_type` bigint UNSIGNED DEFAULT NULL,
  `pk_order_status` bigint DEFAULT NULL,
  `pk_locations` bigint UNSIGNED DEFAULT NULL,
  `pk_location_times` bigint UNSIGNED DEFAULT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kbt_sales`
--

INSERT INTO `kbt_sales` (`pk_sales`, `pk_orders`, `pk_users`, `pk_account`, `pk_arrangement_type`, `pk_transactions`, `customer_name`, `pk_customers`, `subtotal`, `tax_total`, `total`, `is_paid`, `discountCharge`, `coupon_discount_type`, `pk_sales_type`, `pk_order_status`, `pk_locations`, `pk_location_times`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 1, 5, 121, 'Store/Cash Sale', NULL, 250, 9.25, 259.25, 1, NULL, NULL, 1, 1, 26, 85, 2, 2, '2023-06-05 01:27:00', '2023-08-08 04:33:01'),
(2, NULL, NULL, 1, 5, 122, 'Business Customer testing 1', 10, 125, 9.25, 134.25, 1, NULL, NULL, 1, 1, 26, 85, 2, 2, '2023-06-05 01:27:28', '2023-08-08 04:33:01'),
(3, 2, 70, 1, NULL, 14, 'gourav kumar', 64, 100, 0, 100, 1, NULL, NULL, 1, NULL, 19, NULL, 2, 2, '2023-06-05 01:32:46', '2023-06-05 01:32:46'),
(4, NULL, 29, 1, 5, 123, 'Jason Bourne', 13, 75, 9.25, 84.25, 1, NULL, NULL, 1, 1, 26, 85, 2, 2, '2023-06-05 01:33:13', '2023-08-08 04:33:01'),
(5, NULL, 29, 1, 5, NULL, 'First Customer INC', 7, 0, 0, 100, 0, NULL, NULL, 1, 1, NULL, NULL, 2, 2, '2023-06-05 16:59:44', '2023-08-08 04:33:01'),
(6, 1, 69, 1, NULL, 13, 'test user', 63, 114, 8, 108, 1, NULL, NULL, 1, NULL, 21, NULL, 6, 6, '2023-06-09 20:07:42', '2023-06-09 20:07:42'),
(7, 99, 95, 1, 5, 113, 'Direct Customer 2 l', NULL, 87, 8, 83, 1, NULL, NULL, 1, NULL, 21, NULL, 6, 6, '2023-06-09 20:32:09', '2023-06-09 20:32:09'),
(8, NULL, NULL, 1, 5, 116, 'Karry', 4, 75, 9.25, 84.25, 1, NULL, NULL, 1, 1, 26, 85, 6, 6, '2023-06-17 00:00:32', '2023-08-08 04:33:01'),
(9, NULL, NULL, 1, 5, 117, 'Store/Cash Sale', NULL, 125, 9.25, 134.25, 1, NULL, NULL, 1, 1, 26, 85, 6, 6, '2023-06-17 23:01:34', '2023-08-08 04:33:01'),
(10, NULL, 29, 1, NULL, 118, 'First Customer INC', 7, 160, 9.25, 169.25, 1, NULL, NULL, 1, 1, 26, 85, 2, 2, '2023-06-27 13:13:18', '2023-08-08 04:33:01'),
(11, 100, 95, 1, 5, 114, 'Direct Customer 2 l', NULL, 75, 0, 75, 1, 10, 'percent', 1, NULL, NULL, NULL, 6, 6, '2023-06-30 00:51:57', '2023-06-30 00:51:57'),
(12, NULL, 29, 1, 5, 121, 'test', 30, 75, 9.25, 84.25, 1, NULL, NULL, 1, 1, 26, 85, 6, 6, '2023-06-30 01:11:07', '2023-08-08 04:33:01'),
(13, 100, 95, 1, 5, 114, 'Direct Customer 2 l', NULL, 75, 0, 75, 1, 10, 'percent', 1, NULL, NULL, NULL, 2, 2, '2023-07-06 17:40:35', '2023-07-06 17:40:35'),
(14, 96, 94, 1, 7, 110, 'ni diya', 80, 234.06, 0, 225, 1, 10, 'percent', 1, NULL, 22, 53, 2, 2, '2023-07-07 19:42:41', '2023-07-07 19:42:41'),
(15, 110, 109, 1, 5, 128, 'test investigator', 88, 259.25, 9.25, 259.25, 1, NULL, NULL, 1, 3, 26, NULL, 2, 2, '2023-07-10 18:00:25', '2023-07-10 18:00:25'),
(16, 1, 69, 1, NULL, 13, 'test user', 63, 114, 8, 108, 1, NULL, NULL, 1, 3, 21, NULL, 6, 6, '2023-07-10 22:31:48', '2023-07-10 22:31:48'),
(17, 113, 97, 1, 5, 131, 'Direct Customer Kim', 83, 87, 8, 83, 1, NULL, NULL, 1, 3, 21, NULL, 6, 6, '2023-07-14 23:19:01', '2023-07-14 23:19:01'),
(18, NULL, 29, 1, NULL, 133, 'Jason Bourne', 13, 10, 9.25, 19.25, 1, NULL, NULL, 1, 1, 26, 85, 6, 6, '2023-07-18 20:20:10', '2023-08-08 04:33:01'),
(19, NULL, 29, 1, NULL, 134, 'Direct Customer Test', 41, 10, 9.25, 19.25, 1, NULL, NULL, 1, 1, 26, 85, 6, 6, '2023-07-18 20:21:14', '2023-08-08 04:33:01'),
(20, NULL, 29, 1, NULL, 137, 'First Customer INC', 7, 10, 9.25, 19.25, 1, NULL, NULL, 1, 1, 26, 85, 2, 2, '2023-07-30 18:05:08', '2023-08-08 04:33:01'),
(21, NULL, 29, 1, NULL, 138, 'test', 30, 10, 9.25, 19.25, 1, NULL, NULL, 1, 1, 26, 85, 6, 6, '2023-07-31 21:43:06', '2023-08-08 04:33:01'),
(22, 1, 69, 1, NULL, 13, 'Karry', 7, 114, 8, 108, 1, NULL, NULL, 1, 3, 21, NULL, 2, 2, '2023-08-10 14:16:20', '2023-08-10 14:16:20'),
(23, NULL, NULL, 1, NULL, 170, 'Karry', 4, 10, 9.25, 19.25, 1, NULL, NULL, 1, 3, 26, 85, 2, 2, '2023-08-10 14:20:11', '2023-08-10 14:20:11'),
(24, NULL, NULL, 1, NULL, 171, 'Karry', 4, 10, 9.25, 19.25, 1, NULL, NULL, 1, 3, 26, 85, 2, 2, '2023-08-10 14:21:02', '2023-08-10 14:21:02'),
(25, NULL, NULL, 1, NULL, 172, 'Karry', 4, 10, 9.25, 19.25, 1, NULL, NULL, 1, 3, 26, 85, 2, 2, '2023-08-10 14:37:05', '2023-08-10 14:37:05'),
(26, 1, 69, 1, NULL, 13, 'Karry', 7, 114, 8, 108, 1, NULL, NULL, 1, 3, 21, NULL, 2, 2, '2023-08-11 13:14:08', '2023-08-11 13:14:08'),
(27, NULL, NULL, 1, NULL, 173, 'Karry', 4, 60, 9.25, 69.25, 1, NULL, NULL, 1, 3, 26, 85, 2, 2, '2023-08-11 13:15:12', '2023-08-11 13:15:12'),
(28, NULL, NULL, 1, NULL, 177, 'Store/Cash Sale', NULL, 10, 9.25, 19.25, 1, NULL, NULL, 1, 3, 26, 85, 122, 122, '2023-08-11 21:16:35', '2023-08-11 21:16:35');

-- --------------------------------------------------------

--
-- Table structure for table `kbt_sales_type`
--

CREATE TABLE `kbt_sales_type` (
  `pk_sales_type` bigint UNSIGNED NOT NULL,
  `sale_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kbt_sales_type`
--

INSERT INTO `kbt_sales_type` (`pk_sales_type`, `sale_type`, `created_at`, `updated_at`) VALUES
(1, 'POS', '2023-05-28 23:57:25', NULL),
(2, 'Pickup', '2023-05-28 23:57:25', NULL),
(3, 'Delivery', '2023-05-28 23:57:25', NULL),
(4, 'Event', '2023-05-28 23:57:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kbt_sale_items`
--

CREATE TABLE `kbt_sale_items` (
  `pk_sale_items` bigint UNSIGNED NOT NULL,
  `pk_sales` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `quantity` int NOT NULL,
  `price` double NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kbt_sale_items`
--

INSERT INTO `kbt_sale_items` (`pk_sale_items`, `pk_sales`, `name`, `description`, `quantity`, `price`, `type`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'Low & Lush - Classic', '', 2, 90, '5', 2, 2, '2023-05-31 21:54:20', '2023-05-31 21:54:20'),
(2, 1, 'Low & Lush - Classic', '', 3, 100, '5', 2, 2, '2023-05-31 21:54:20', '2023-05-31 21:54:20'),
(3, 2, 'Low & Lush - Classic', '', 1, 150, '5', 2, 2, '2023-05-31 22:03:45', '2023-05-31 22:03:45'),
(4, 5, 'Low & Lush - Classic', '', 1, 100, '5', 2, 2, '2023-06-05 16:59:44', '2023-06-05 16:59:44'),
(5, 6, 'Low & Lush - Classic', '', 1, 100, '5', NULL, NULL, '2023-06-09 20:07:42', '2023-06-09 20:07:42'),
(6, 7, 'Low & Lush - Classic', '', 1, 75, '5', NULL, NULL, '2023-06-09 20:32:09', '2023-06-09 20:32:09'),
(7, 8, 'Low & Lush - Classic', '', 1, 75, '5', NULL, NULL, '2023-06-17 00:00:32', '2023-06-17 00:00:32'),
(8, 9, 'Low & Lush - Classic', '', 1, 125, '5', NULL, NULL, '2023-06-17 23:01:34', '2023-06-17 23:01:34'),
(9, 10, 'STARBURST - Low & Lush - Classic', '', 1, 100, '5', 2, 2, '2023-06-27 13:13:18', '2023-06-27 13:13:18'),
(10, 10, 'torrance product', '', 1, 60, '5', 2, 2, '2023-06-27 13:13:18', '2023-06-27 13:13:18'),
(11, 11, 'Low & Lush - Classic', '', 1, 75, '5', NULL, NULL, '2023-06-30 00:51:57', '2023-06-30 00:51:57'),
(12, 12, 'SHERBET - Low & Lush - Classic', '', 1, 75, '5', NULL, NULL, '2023-06-30 01:11:07', '2023-06-30 01:11:07'),
(13, 13, 'Low & Lush - Classic', '', 1, 75, '5', 2, 2, '2023-07-06 17:40:35', '2023-07-06 17:40:35'),
(14, 14, 'Low & Lush - Premium', '', 1, 225, '5', 2, 2, '2023-07-07 19:42:41', '2023-07-07 19:42:41'),
(15, 15, 'Low & Lush - Classic', '', 2, 125, '5', 2, 2, '2023-07-10 18:00:25', '2023-07-10 18:00:25'),
(16, 16, 'Low & Lush - Classic', '', 1, 100, '5', NULL, NULL, '2023-07-10 22:31:48', '2023-07-10 22:31:48'),
(17, 17, 'Low & Lush - Classic', '', 1, 75, '5', NULL, NULL, '2023-07-14 23:19:01', '2023-07-14 23:19:01'),
(18, 18, 'venice product', 'test', 1, 10, '5', NULL, NULL, '2023-07-18 20:20:10', '2023-07-18 20:20:10'),
(19, 19, 'hawthorne product', '', 1, 10, '5', NULL, NULL, '2023-07-18 20:21:14', '2023-07-18 20:21:14'),
(20, 20, 'venice product', 'test', 1, 10, '5', 2, 2, '2023-07-30 18:05:08', '2023-07-30 18:05:08'),
(21, 21, 'venice product', 'test', 1, 10, '5', NULL, NULL, '2023-07-31 21:43:06', '2023-07-31 21:43:06'),
(22, 22, 'Low & Lush - Classic', '', 1, 100, NULL, 2, 2, '2023-08-10 14:16:20', '2023-08-10 14:16:20'),
(23, 23, 'venice product', 'test', 1, 10, '5', 2, 2, '2023-08-10 14:20:11', '2023-08-10 14:20:11'),
(24, 24, 'hawthorne product', '', 1, 10, '5', 2, 2, '2023-08-10 14:21:02', '2023-08-10 14:21:02'),
(25, 25, 'hawthorne product', '', 1, 10, '5', 2, 2, '2023-08-10 14:37:05', '2023-08-10 14:37:05'),
(26, 26, 'Low & Lush - Classic', '', 1, 100, NULL, 2, 2, '2023-08-11 13:14:08', '2023-08-11 13:14:08'),
(27, 27, 'torrance product', '', 1, 60, '5', 2, 2, '2023-08-11 13:15:12', '2023-08-11 13:15:12'),
(28, 28, 'venice product', 'test', 1, 10, '5', NULL, NULL, '2023-08-11 21:16:35', '2023-08-11 21:16:35');

-- --------------------------------------------------------

--
-- Table structure for table `kbt_shipping_address`
--

CREATE TABLE `kbt_shipping_address` (
  `pk_shipping_address` bigint UNSIGNED NOT NULL,
  `pk_customers` bigint DEFAULT NULL,
  `pk_order_items` bigint NOT NULL,
  `shipping_full_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_phone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_address_1` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_city` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pk_states` bigint DEFAULT NULL,
  `pk_country` bigint DEFAULT NULL,
  `shipping_zip` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `same_as_billing` tinyint NOT NULL DEFAULT '1',
  `delivery_charge` double NOT NULL,
  `created_by` bigint DEFAULT NULL,
  `updated_by` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kbt_shipping_address`
--

INSERT INTO `kbt_shipping_address` (`pk_shipping_address`, `pk_customers`, `pk_order_items`, `shipping_full_name`, `shipping_email`, `shipping_phone`, `shipping_address`, `shipping_address_1`, `shipping_city`, `pk_states`, `pk_country`, `shipping_zip`, `same_as_billing`, `delivery_charge`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 9, 131, '123', 'tyu@gmail.com', '8989989899', '12340 Boggy Creek Road', '', 'Orlando', 10, 1, '32824', 0, 15, 137, 137, '2023-08-12 18:49:30', '2023-08-12 18:49:30'),
(2, 9, 132, '127', 'tyu@gmail.com', '1234567890', '12400 Imperial Highway', '', 'Norwalk', 5, 1, '90650', 0, 10, 137, 137, '2023-08-12 18:49:30', '2023-08-12 18:49:30');

-- --------------------------------------------------------

--
-- Table structure for table `kbt_size_arrangement`
--

CREATE TABLE `kbt_size_arrangement` (
  `pk_size_arrangement` bigint UNSIGNED NOT NULL,
  `pk_account` bigint UNSIGNED NOT NULL,
  `size_arrangement` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kbt_size_arrangement`
--

INSERT INTO `kbt_size_arrangement` (`pk_size_arrangement`, `pk_account`, `size_arrangement`, `description`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'odn', NULL, 1, 2, 2, '2023-01-12 07:30:54', '2023-01-12 07:30:54'),
(2, 2, '300 flowers', NULL, 1, 6, 6, '2023-01-12 22:12:59', '2023-01-12 22:12:59');

-- --------------------------------------------------------

--
-- Table structure for table `kbt_states`
--

CREATE TABLE `kbt_states` (
  `pk_states` bigint UNSIGNED NOT NULL,
  `pk_country` bigint UNSIGNED NOT NULL,
  `state_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state_code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kbt_states`
--

INSERT INTO `kbt_states` (`pk_states`, `pk_country`, `state_name`, `state_code`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'Alabama', 'AL', 0, NULL, 1, '2022-12-04 07:54:18', '2023-07-21 13:40:55'),
(2, 1, 'Alaska', 'AK', 0, NULL, 1, '2022-12-04 07:54:18', '2023-07-21 13:40:44'),
(3, 1, 'Arizona', 'AZ', 0, NULL, 1, '2022-12-04 07:54:18', '2023-07-21 13:41:08'),
(4, 1, 'Arkansas', 'AR', 0, NULL, 1, '2022-12-04 07:54:18', '2023-07-21 13:41:01'),
(5, 1, 'California', 'CA', 1, NULL, NULL, '2022-12-04 07:54:18', '2022-12-04 07:54:18'),
(6, 1, 'Colorado', 'CO', 0, NULL, 1, '2022-12-04 07:54:18', '2023-07-21 13:40:37'),
(7, 1, 'Connecticut', 'CT', 0, NULL, 1, '2022-12-04 07:54:18', '2023-07-21 13:41:26'),
(8, 1, 'Delaware', 'DE', 0, NULL, 1, '2022-12-04 07:54:18', '2023-07-21 13:41:45'),
(9, 1, 'District of Columbia', 'DC', 0, NULL, 1, '2022-12-04 07:54:18', '2023-07-21 13:41:34'),
(10, 1, 'Florida', 'FL', 0, NULL, 1, '2022-12-04 07:54:18', '2023-07-21 13:41:53');

-- --------------------------------------------------------

--
-- Table structure for table `kbt_styles`
--

CREATE TABLE `kbt_styles` (
  `pk_styles` bigint UNSIGNED NOT NULL,
  `pk_account` bigint UNSIGNED NOT NULL,
  `styles` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kbt_styles`
--

INSERT INTO `kbt_styles` (`pk_styles`, `pk_account`, `styles`, `description`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 2, 'Low & Lush', NULL, 1, 6, 6, '2023-01-12 22:11:08', '2023-01-12 22:11:08'),
(3, 2, 'Garden', NULL, 1, 6, 6, '2023-01-12 22:11:24', '2023-01-12 22:11:24'),
(4, 2, 'Stylized', NULL, 1, 6, 6, '2023-01-12 22:11:33', '2023-01-12 22:11:33');

-- --------------------------------------------------------

--
-- Table structure for table `kbt_suggested_note`
--

CREATE TABLE `kbt_suggested_note` (
  `pk_suggested_note` bigint UNSIGNED NOT NULL,
  `pk_account` bigint UNSIGNED NOT NULL,
  `pk_event` bigint UNSIGNED NOT NULL,
  `suggested_note` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kbt_text_settings`
--

CREATE TABLE `kbt_text_settings` (
  `pk_text_settings` bigint NOT NULL,
  `pk_account` bigint NOT NULL,
  `sid` varchar(250) NOT NULL,
  `token` varchar(250) NOT NULL,
  `from_no` varchar(50) NOT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `created_by` bigint DEFAULT NULL,
  `updated_by` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kbt_text_settings`
--

INSERT INTO `kbt_text_settings` (`pk_text_settings`, `pk_account`, `sid`, `token`, `from_no`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, '23', '255', '1', 1, 2, 2, '2023-01-27 05:13:34', '2023-01-27 13:16:48');

-- --------------------------------------------------------

--
-- Table structure for table `kbt_text_template`
--

CREATE TABLE `kbt_text_template` (
  `pk_text_template` bigint NOT NULL,
  `pk_account` bigint NOT NULL,
  `pk_text_settings` bigint NOT NULL,
  `template_name` varchar(250) NOT NULL,
  `content` text NOT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `created_by` bigint DEFAULT NULL,
  `updated_by` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kbt_text_template`
--

INSERT INTO `kbt_text_template` (`pk_text_template`, `pk_account`, `pk_text_settings`, `template_name`, `content`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'red', 'tst', 0, 2, 2, '2023-01-27 12:34:00', '2023-01-27 12:41:40');

-- --------------------------------------------------------

--
-- Table structure for table `kbt_timezone`
--

CREATE TABLE `kbt_timezone` (
  `pk_timezone` bigint UNSIGNED NOT NULL,
  `timezone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kbt_timezone`
--

INSERT INTO `kbt_timezone` (`pk_timezone`, `timezone`, `name`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Pacific/Midway', '(GMT -11:00) Midway Island, Samoa', 1, NULL, NULL, '2022-12-07 01:40:59', '2022-12-07 01:40:59'),
(2, 'America/Adak', '(GMT -10:00) Hawai', 1, NULL, NULL, '2022-12-07 01:40:59', '2022-12-07 01:40:59'),
(3, 'America/Anchorage', '(GMT -9:00) Alaska', 1, NULL, NULL, '2022-12-07 01:40:59', '2022-12-07 01:40:59'),
(4, 'America/Los_Angeles', '(GMT -8:00) Pacific Time (US & Canada)', 1, NULL, NULL, '2022-12-07 01:40:59', '2022-12-07 01:40:59'),
(5, 'America/Denver', '(GMT -7:00) Mountain Time (US & Canada)', 1, NULL, NULL, '2022-12-07 01:40:59', '2022-12-07 01:40:59'),
(6, 'America/Chicago', '(GMT -6:00) Central Time (US & Canada), Mexico City', 1, NULL, NULL, '2022-12-07 01:40:59', '2022-12-07 01:40:59'),
(7, 'America/New_York', '(GMT -5:00) Eastern Time (US & Canada), Bogota, Lima', 1, NULL, NULL, '2022-12-07 01:40:59', '2022-12-07 01:40:59'),
(8, 'America/Halifax', '(GMT -4:00) Atlantic Time (Canada), Caracas, La Paz', 1, NULL, NULL, '2022-12-07 01:40:59', '2022-12-07 01:40:59'),
(9, 'America/St_Johns', '(GMT -3:30) Newfoundland', 1, NULL, NULL, '2022-12-07 01:40:59', '2022-12-07 01:40:59'),
(10, 'America/Argentina/Buenos_Aires', '(GMT -3:00) Brazil, Buenos Aires, Georgetown', 1, NULL, NULL, '2022-12-07 01:40:59', '2022-12-07 01:40:59'),
(11, 'Atlantic/South_Georgia', '(GMT -2:00) Mid-Atlantic', 1, NULL, NULL, '2022-12-07 01:40:59', '2022-12-07 01:40:59'),
(12, 'Atlantic/Azores', '(GMT -1:00 hour) Azores, Cape Verde Islands', 1, NULL, NULL, '2022-12-07 01:40:59', '2022-12-07 01:40:59'),
(13, 'Europe/Dublin', '(GMT) Western Europe Time, London, Lisbon, Casablanca', 1, NULL, NULL, '2022-12-07 01:40:59', '2022-12-07 01:40:59'),
(14, 'Europe/Belgrade', '(GMT +1:00 hour) Brussels, Copenhagen, Madrid, Paris', 1, NULL, NULL, '2022-12-07 01:40:59', '2022-12-07 01:40:59'),
(15, 'Europe/Minsk', '(GMT +2:00) Kaliningrad, South Africa', 1, NULL, NULL, '2022-12-07 01:40:59', '2022-12-07 01:40:59'),
(16, 'Asia/Kuwait', '(GMT +3:00) Baghdad, Riyadh, Moscow, St. Petersburg', 1, NULL, NULL, '2022-12-07 01:40:59', '2022-12-07 01:40:59'),
(17, 'Asia/Tehran', '(GMT +3:30) Tehran', 1, NULL, NULL, '2022-12-07 01:40:59', '2022-12-07 01:40:59'),
(18, 'Asia/Muscat', '(GMT +4:00) Abu Dhabi, Muscat, Baku, Tbilisi', 1, NULL, NULL, '2022-12-07 01:40:59', '2022-12-07 01:40:59'),
(19, 'Asia/Kabul', '(GMT +4:30) Kabu', 1, NULL, NULL, '2022-12-07 01:40:59', '2022-12-07 01:40:59'),
(20, 'Asia/Karachi', '(GMT +5:00) Ekaterinburg, Islamabad, Karachi, Tashkent', 1, NULL, NULL, '2022-12-07 01:40:59', '2022-12-07 01:40:59'),
(21, 'Asia/Kolkata', '(GMT +5:30) Bombay, Calcutta, Madras, New Delhi', 1, NULL, NULL, '2022-12-07 01:40:59', '2022-12-07 01:40:59'),
(22, 'Asia/Kathmandu', '(GMT +5:45) Kathmandu', 1, NULL, NULL, '2022-12-07 01:40:59', '2022-12-07 01:40:59'),
(23, 'Asia/Dhaka', '(GMT +6:00) Almaty, Dhaka, Colombo', 1, NULL, NULL, '2022-12-07 01:40:59', '2022-12-07 01:40:59'),
(24, 'Asia/Bangkok', '(GMT +7:00) Bangkok, Hanoi, Jakarta', 1, NULL, NULL, '2022-12-07 01:40:59', '2022-12-07 01:40:59'),
(25, 'Asia/Brunei', '(GMT +8:00) Beijing, Perth, Singapore, Hong Kong', 1, NULL, NULL, '2022-12-07 01:40:59', '2022-12-07 01:40:59'),
(26, 'Asia/Seoul', '(GMT +9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk', 1, NULL, NULL, '2022-12-07 01:40:59', '2022-12-07 01:40:59'),
(27, 'Australia/Darwin', '(GMT +9:30) Adelaide, Darwin', 1, NULL, NULL, '2022-12-07 01:40:59', '2022-12-07 01:40:59'),
(28, 'Australia/Brisbane', '(GMT +10:00) Eastern Australia, Guam, Vladivostok', 1, NULL, NULL, '2022-12-07 01:40:59', '2022-12-07 01:40:59'),
(29, 'Australia/Canberra', '(GMT +11:00) Magadan, Solomon Islands, New Caledonia', 1, NULL, NULL, '2022-12-07 01:40:59', '2022-12-07 01:40:59'),
(30, 'Pacific/Fiji', '(GMT +12:00) Auckland, Wellington, Fiji, Kamchatka', 1, NULL, NULL, '2022-12-07 01:40:59', '2022-12-07 01:40:59');

-- --------------------------------------------------------

--
-- Table structure for table `kbt_transactions`
--

CREATE TABLE `kbt_transactions` (
  `pk_transactions` int UNSIGNED NOT NULL,
  `amount` double(8,2) DEFAULT NULL,
  `name_on_card` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `response_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auth_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kbt_transactions`
--

INSERT INTO `kbt_transactions` (`pk_transactions`, `amount`, `name_on_card`, `response_code`, `transaction_id`, `auth_id`, `message_code`, `currency`, `account_type`, `quantity`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 125.00, 'Roger Smith', '1', '0', '000000', '1', 'USD', 'Visa', 1, 57, 57, '2023-02-27 19:20:40', '2023-02-27 19:20:40'),
(2, 100.00, 'dfdf', '1', '0', '000000', '1', 'USD', 'MasterCard', 1, 58, 58, '2023-03-02 06:49:20', '2023-03-02 06:49:20'),
(3, 100.00, 'teest', '1', '0', '000000', '1', 'USD', 'MasterCard', 1, 59, 59, '2023-03-04 06:10:59', '2023-03-04 06:10:59'),
(4, 75.00, 'Daniel Joe', '1', '0', '000000', '1', 'USD', 'MasterCard', 1, 40, 40, '2023-03-09 21:01:32', '2023-03-09 21:01:32'),
(5, 400.00, 'ABC', '1', '0', '000000', '1', 'USD', 'Visa', 2, 61, 61, '2023-03-09 23:25:51', '2023-03-09 23:25:51'),
(6, 75.00, 'Daniel Joe', '1', '0', '000000', '1', 'USD', 'MasterCard', 1, 40, 40, '2023-03-10 23:14:33', '2023-03-10 23:14:33'),
(7, 75.00, 'Peter Mint', '1', '0', '000000', '1', 'USD', 'MasterCard', 1, 62, 62, '2023-03-11 00:32:49', '2023-03-11 00:32:49'),
(8, 75.00, 'john doe', '1', '0', '000000', '1', 'USD', 'MasterCard', 1, 63, 63, '2023-03-14 01:02:29', '2023-03-14 01:02:29'),
(9, 100.00, 'test', '1', '0', '000000', '1', 'USD', 'MasterCard', 1, 65, 65, '2023-03-17 15:52:00', '2023-03-17 15:52:00'),
(10, 75.00, 'Alex Fin', '1', '0', '000000', '1', 'USD', 'MasterCard', 1, 66, 66, '2023-03-17 19:00:43', '2023-03-17 19:00:43'),
(11, 150.00, 'John Doe', '1', '0', '000000', '1', 'USD', 'Visa', 1, 67, 67, '2023-03-20 00:34:11', '2023-03-20 00:34:11'),
(12, 100.00, 'retest', '1', '0', '000000', '1', 'USD', 'MasterCard', 1, 68, 68, '2023-03-20 13:33:51', '2023-03-20 13:33:51'),
(13, 100.00, 'test', '1', '0', '000000', '1', 'USD', 'Visa', 1, 69, 69, '2023-03-21 15:13:41', '2023-03-21 15:13:41'),
(14, 100.00, 'gourav', '1', '0', '000000', '1', 'USD', 'Visa', 1, 70, 70, '2023-03-22 08:31:26', '2023-03-22 08:31:26'),
(15, 150.00, 'gourav', '1', '0', '000000', '1', 'USD', 'Visa', 1, 71, 71, '2023-03-22 08:35:20', '2023-03-22 08:35:20'),
(16, 75.00, 'Daniel Joe', '1', '0', '000000', '1', 'USD', 'MasterCard', 1, 40, 40, '2023-03-22 18:01:11', '2023-03-22 18:01:11'),
(17, 75.00, 'Daniel Joe', '1', '0', '000000', '1', 'USD', 'MasterCard', 1, 40, 40, '2023-03-22 18:02:27', '2023-03-22 18:02:27'),
(18, 100.00, 'trst', '1', '0', '000000', '1', 'USD', 'Visa', 1, 77, 77, '2023-03-22 18:55:10', '2023-03-22 18:55:10'),
(19, 75.00, 'Daniel Joe', '1', '0', '000000', '1', 'USD', 'MasterCard', 1, 40, 40, '2023-03-22 20:30:34', '2023-03-22 20:30:34'),
(20, 75.00, 'Daniel Joe', '1', '0', '000000', '1', 'USD', 'MasterCard', 1, 40, 40, '2023-03-30 21:12:50', '2023-03-30 21:12:50'),
(21, 75.00, 'Daniel', '1', '0', '000000', '1', 'USD', 'MasterCard', 1, 40, 40, '2023-04-03 18:03:51', '2023-04-03 18:03:51'),
(22, 100.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 40, 40, '2023-04-04 09:24:59', '2023-04-04 09:24:59'),
(23, 75.00, 'Tim Childress', '1', '0', '000000', '1', 'USD', 'MasterCard', 1, 40, 40, '2023-04-07 23:37:46', '2023-04-07 23:37:46'),
(24, 200.00, 'customer', '1', '0', '000000', '1', 'USD', 'Visa', 2, 80, 80, '2023-04-10 13:28:50', '2023-04-10 13:28:50'),
(25, 150.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 80, 80, '2023-04-10 13:55:58', '2023-04-10 13:55:58'),
(26, 150.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 80, 80, '2023-04-10 13:55:58', '2023-04-10 13:55:58'),
(27, 100.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 80, 80, '2023-04-10 16:37:13', '2023-04-10 16:37:13'),
(28, 75.00, 'Daniel Joe', '1', '0', '000000', '1', 'USD', 'MasterCard', 1, 40, 40, '2023-04-11 02:45:39', '2023-04-11 02:45:39'),
(29, 100.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 81, 81, '2023-04-25 17:29:54', '2023-04-25 17:29:54'),
(30, 100.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 81, 81, '2023-04-25 17:30:35', '2023-04-25 17:30:35'),
(31, 125.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 81, 81, '2023-04-25 17:40:23', '2023-04-25 17:40:23'),
(32, 100.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 81, 81, '2023-04-25 17:43:34', '2023-04-25 17:43:34'),
(33, 150.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 81, 81, '2023-04-25 17:46:03', '2023-04-25 17:46:03'),
(34, 150.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 81, 81, '2023-04-25 17:46:55', '2023-04-25 17:46:55'),
(35, 150.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 81, 81, '2023-04-25 17:54:31', '2023-04-25 17:54:31'),
(36, 100.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 81, 81, '2023-04-25 17:55:54', '2023-04-25 17:55:54'),
(37, 100.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 81, 81, '2023-04-25 18:08:19', '2023-04-25 18:08:19'),
(38, 100.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 81, 81, '2023-04-25 18:09:48', '2023-04-25 18:09:48'),
(39, 300.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 2, 81, 81, '2023-04-25 18:11:47', '2023-04-25 18:11:47'),
(40, 300.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 2, 82, 82, '2023-04-25 18:22:13', '2023-04-25 18:22:13'),
(41, 90.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 83, 83, '2023-04-25 18:23:53', '2023-04-25 18:23:53'),
(42, 100.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 84, 84, '2023-04-26 08:06:51', '2023-04-26 08:06:51'),
(43, 100.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 84, 84, '2023-04-26 08:08:02', '2023-04-26 08:08:02'),
(44, 200.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 2, 85, 85, '2023-04-26 08:14:27', '2023-04-26 08:14:27'),
(45, 100.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 85, 85, '2023-04-26 09:00:05', '2023-04-26 09:00:05'),
(46, 150.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 86, 86, '2023-04-26 09:06:47', '2023-04-26 09:06:47'),
(47, 75.00, 'Daniel Joe', '1', '0', '000000', '1', 'USD', 'MasterCard', 1, 40, 40, '2023-04-26 19:31:24', '2023-04-26 19:31:24'),
(48, 75.00, 'Daniel Joe', '1', '0', '000000', '1', 'USD', 'MasterCard', 1, 40, 40, '2023-04-26 19:33:48', '2023-04-26 19:33:48'),
(49, 75.00, 'Daniel Joe', '1', '0', '000000', '1', 'USD', 'MasterCard', 1, 40, 40, '2023-04-26 19:40:53', '2023-04-26 19:40:53'),
(50, 100.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 87, 87, '2023-04-27 09:07:51', '2023-04-27 09:07:51'),
(51, 100.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 87, 87, '2023-04-27 09:38:35', '2023-04-27 09:38:35'),
(52, 100.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 87, 87, '2023-04-27 10:59:45', '2023-04-27 10:59:45'),
(53, 100.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 87, 87, '2023-04-27 11:02:58', '2023-04-27 11:02:58'),
(54, 100.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 87, 87, '2023-04-27 11:16:32', '2023-04-27 11:16:32'),
(55, 75.00, 'Daniel Joe', '1', '0', '000000', '1', 'USD', 'MasterCard', 1, 40, 40, '2023-04-27 21:00:53', '2023-04-27 21:00:53'),
(56, 75.00, 'Daniel Joe', '1', '0', '000000', '1', 'USD', 'MasterCard', 1, 40, 40, '2023-04-27 21:05:46', '2023-04-27 21:05:46'),
(57, 75.00, 'Daniel Joe', '1', '0', '000000', '1', 'USD', 'MasterCard', 1, 40, 40, '2023-04-27 21:08:59', '2023-04-27 21:08:59'),
(58, 75.00, 'Daniel Joe', '1', '0', '000000', '1', 'USD', 'MasterCard', 1, 40, 40, '2023-04-27 21:14:09', '2023-04-27 21:14:09'),
(59, 100.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 87, 87, '2023-04-28 07:35:50', '2023-04-28 07:35:50'),
(60, 300.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 2, 87, 87, '2023-04-28 07:39:53', '2023-04-28 07:39:53'),
(61, 100.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 87, 87, '2023-04-28 07:51:11', '2023-04-28 07:51:11'),
(62, 200.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 2, 87, 87, '2023-04-28 07:59:37', '2023-04-28 07:59:37'),
(63, 75.00, 'Golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 87, 87, '2023-04-28 08:03:01', '2023-04-28 08:03:01'),
(64, 150.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 88, 88, '2023-04-28 09:27:00', '2023-04-28 09:27:00'),
(65, 150.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 88, 88, '2023-04-28 10:39:33', '2023-04-28 10:39:33'),
(66, 100.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 88, 88, '2023-04-28 11:27:47', '2023-04-28 11:27:47'),
(67, 100.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 88, 88, '2023-04-28 11:47:14', '2023-04-28 11:47:14'),
(68, 100.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 88, 88, '2023-04-28 11:54:44', '2023-04-28 11:54:44'),
(69, 100.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 88, 88, '2023-04-28 11:56:58', '2023-04-28 11:56:58'),
(70, 100.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 88, 88, '2023-04-28 12:18:10', '2023-04-28 12:18:10'),
(71, 100.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 88, 88, '2023-04-28 12:21:07', '2023-04-28 12:21:07'),
(72, 100.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 88, 88, '2023-04-28 12:24:17', '2023-04-28 12:24:17'),
(73, 100.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 88, 88, '2023-04-28 12:25:09', '2023-04-28 12:25:09'),
(74, 150.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 88, 88, '2023-04-28 12:28:10', '2023-04-28 12:28:10'),
(75, 200.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 2, 88, 88, '2023-04-28 12:29:35', '2023-04-28 12:29:35'),
(76, 100.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 88, 88, '2023-04-28 16:26:29', '2023-04-28 16:26:29'),
(77, 75.00, 'Daniel Joe', '1', '0', '000000', '1', 'USD', 'MasterCard', 1, 40, 40, '2023-04-28 22:56:33', '2023-04-28 22:56:33'),
(78, 100.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 88, 88, '2023-05-01 05:14:19', '2023-05-01 05:14:19'),
(79, 150.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 88, 88, '2023-05-01 06:35:31', '2023-05-01 06:35:31'),
(80, 75.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 89, 89, '2023-05-01 06:57:40', '2023-05-01 06:57:40'),
(81, 90.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 89, 89, '2023-05-01 07:14:17', '2023-05-01 07:14:17'),
(82, 150.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 89, 89, '2023-05-01 07:18:10', '2023-05-01 07:18:10'),
(83, 150.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 89, 89, '2023-05-01 07:20:14', '2023-05-01 07:20:14'),
(84, 125.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 89, 89, '2023-05-01 07:22:46', '2023-05-01 07:22:46'),
(85, 125.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 89, 89, '2023-05-01 07:24:03', '2023-05-01 07:24:03'),
(86, 125.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 89, 89, '2023-05-01 07:26:29', '2023-05-01 07:26:29'),
(87, 125.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 89, 89, '2023-05-01 07:27:58', '2023-05-01 07:27:58'),
(88, 100.00, 'gourav', '1', '0', '000000', '1', 'USD', 'Visa', 1, 90, 90, '2023-05-01 08:24:16', '2023-05-01 08:24:16'),
(89, 200.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 90, 90, '2023-05-01 08:25:55', '2023-05-01 08:25:55'),
(90, 100.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 90, 90, '2023-05-01 09:49:23', '2023-05-01 09:49:23'),
(91, 125.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 90, 90, '2023-05-01 10:14:04', '2023-05-01 10:14:04'),
(92, 175.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 90, 90, '2023-05-01 10:15:18', '2023-05-01 10:15:18'),
(93, 150.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 90, 90, '2023-05-01 10:18:26', '2023-05-01 10:18:26'),
(94, 100.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 90, 90, '2023-05-01 10:33:45', '2023-05-01 10:33:45'),
(95, 100.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 90, 90, '2023-05-01 10:34:30', '2023-05-01 10:34:30'),
(96, 100.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 90, 90, '2023-05-01 10:37:45', '2023-05-01 10:37:45'),
(97, 100.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 90, 90, '2023-05-01 10:38:42', '2023-05-01 10:38:42'),
(98, 75.00, 'Daniel Joe', '1', '0', '000000', '1', 'USD', 'MasterCard', 1, 40, 40, '2023-05-02 04:24:09', '2023-05-02 04:24:09'),
(99, 75.00, 'Daniel Joe', '1', '0', '000000', '1', 'USD', 'MasterCard', 1, 40, 40, '2023-05-02 04:25:19', '2023-05-02 04:25:19'),
(100, 75.00, 'Daniel Joe', '1', '0', '000000', '1', 'USD', 'MasterCard', 1, 40, 40, '2023-05-02 04:26:57', '2023-05-02 04:26:57'),
(101, 75.00, 'Daniel Joe', '1', '0', '000000', '1', 'USD', 'MasterCard', 1, 40, 40, '2023-05-02 04:31:32', '2023-05-02 04:31:32'),
(102, 75.00, 'Daniel Joe', '1', '0', '000000', '1', 'USD', 'MasterCard', 1, 40, 40, '2023-05-02 04:34:06', '2023-05-02 04:34:06'),
(103, 75.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 91, 91, '2023-05-02 05:23:01', '2023-05-02 05:23:01'),
(104, 75.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 91, 91, '2023-05-02 05:38:40', '2023-05-02 05:38:40'),
(105, 150.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 91, 91, '2023-05-02 05:55:06', '2023-05-02 05:55:06'),
(106, 75.00, 'Daniel Joe', '1', '0', '000000', '1', 'USD', 'MasterCard', 1, 92, 92, '2023-05-02 06:42:51', '2023-05-02 06:42:51'),
(107, 100.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 94, 94, '2023-05-02 08:17:56', '2023-05-02 08:17:56'),
(108, 150.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 94, 94, '2023-05-02 09:31:42', '2023-05-02 09:31:42'),
(109, 100.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 94, 94, '2023-05-02 09:32:42', '2023-05-02 09:32:42'),
(110, 225.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 94, 94, '2023-05-02 09:34:23', '2023-05-02 09:34:23'),
(111, 175.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 94, 94, '2023-05-02 09:36:07', '2023-05-02 09:36:07'),
(112, 175.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 94, 94, '2023-05-02 09:36:07', '2023-05-02 09:36:07'),
(113, 75.00, 'customer', '1', '0', '000000', '1', 'USD', 'MasterCard', 1, 95, 95, '2023-05-24 00:52:36', '2023-05-24 00:52:36'),
(114, 75.00, 'Daniel Joe', '1', '0', '000000', '1', 'USD', 'MasterCard', 1, 95, 95, '2023-05-24 01:13:31', '2023-05-24 01:13:31'),
(115, 75.00, 'direct c', '1', '0', '000000', '1', 'USD', 'MasterCard', 1, 40, 40, '2023-05-24 23:38:19', '2023-05-24 23:38:19'),
(116, 84.25, 'kale', '1', '0', '000000', '1', 'USD', 'MasterCard', 1, 6, 6, '2023-06-17 00:00:32', '2023-06-17 00:00:32'),
(117, 134.25, 'abc', '1', '0', '000000', '1', 'USD', 'Visa', 1, 6, 6, '2023-06-17 23:01:34', '2023-06-17 23:01:34'),
(118, 169.25, 'test', '1', '0', '000000', '1', 'USD', 'Visa', 2, 2, 2, '2023-06-27 13:13:18', '2023-06-27 13:13:18'),
(119, 350.00, 'John doe', '1', '0', '000000', '1', 'USD', 'Visa', 2, 104, 104, '2023-06-29 22:38:02', '2023-06-29 22:38:02'),
(120, 75.00, 'kale', '1', '0', '000000', '1', 'USD', 'Visa', 1, 97, 97, '2023-06-30 01:05:32', '2023-06-30 01:05:32'),
(121, 84.25, 'kale', '1', '0', '000000', '1', 'USD', 'Visa', 1, 6, 6, '2023-06-30 01:11:07', '2023-06-30 01:11:07'),
(122, 150.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 105, 105, '2023-07-01 04:47:07', '2023-07-01 04:47:07'),
(123, 150.00, 'Debdulal Baidya', '1', '0', '000000', '1', 'USD', 'Visa', 1, 106, 106, '2023-07-01 04:50:03', '2023-07-01 04:50:03'),
(124, 150.00, 'Ovi baidya', '1', '0', '000000', '1', 'USD', 'Visa', 1, 107, 107, '2023-07-01 19:39:05', '2023-07-01 19:39:05'),
(125, 75.00, 'kale', '1', '0', '000000', '1', 'USD', 'MasterCard', 1, 108, 108, '2023-07-03 22:54:49', '2023-07-03 22:54:49'),
(126, 225.00, 'kale', '1', '0', '000000', '1', 'USD', 'MasterCard', 3, 97, 97, '2023-07-07 21:23:32', '2023-07-07 21:23:32'),
(127, 225.00, 'kale', '1', '0', '000000', '1', 'USD', 'MasterCard', 3, 97, 97, '2023-07-07 21:30:47', '2023-07-07 21:30:47'),
(128, 250.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 2, 109, 109, '2023-07-08 15:00:45', '2023-07-08 15:00:45'),
(129, 150.00, 'kale', '1', '0', '000000', '1', 'USD', 'MasterCard', 2, 110, 110, '2023-07-10 22:34:06', '2023-07-10 22:34:06'),
(130, 150.00, 'Paige Childress', '1', '0', '000000', '1', 'USD', 'Visa', 1, 6, 6, '2023-07-13 19:31:06', '2023-07-13 19:31:06'),
(131, 75.00, 'kale', '1', '0', '000000', '1', 'USD', 'MasterCard', 1, 97, 97, '2023-07-14 23:17:11', '2023-07-14 23:17:11'),
(132, 75.00, 'kale', '1', '0', '000000', '1', 'USD', 'MasterCard', 1, 97, 97, '2023-07-14 23:30:17', '2023-07-14 23:30:17'),
(133, 19.25, 'jason', '1', '0', '000000', '1', 'USD', 'Visa', 1, 6, 6, '2023-07-18 20:20:10', '2023-07-18 20:20:10'),
(134, 19.25, 'jason', '1', '0', '000000', '1', 'USD', 'Visa', 1, 6, 6, '2023-07-18 20:21:14', '2023-07-18 20:21:14'),
(135, 75.00, 'kale', '1', '0', '000000', '1', 'USD', 'MasterCard', 1, 111, 111, '2023-07-24 21:08:52', '2023-07-24 21:08:52'),
(136, 125.00, 'PAIGE CHILDRESS', '1', '0', '000000', '1', 'USD', 'Visa', 2, 112, 112, '2023-07-27 04:29:34', '2023-07-27 04:29:34'),
(137, 19.25, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 2, 2, '2023-07-30 18:05:08', '2023-07-30 18:05:08'),
(138, 19.25, 'kale', '1', '0', '000000', '1', 'USD', 'MasterCard', 1, 6, 6, '2023-07-31 21:43:06', '2023-07-31 21:43:06'),
(139, 100.00, 'gourav', '1', '0', '000000', '1', 'USD', 'Visa', 1, 113, 113, '2023-08-04 11:03:24', '2023-08-04 11:03:24'),
(140, 550.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 3, 114, 114, '2023-08-07 19:17:37', '2023-08-07 19:17:37'),
(141, 250.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 2, 116, 116, '2023-08-08 01:31:58', '2023-08-08 01:31:58'),
(142, 150.00, 'Keane Green', '1', '0', '000000', '1', 'USD', 'Visa', 1, 117, NULL, '2023-08-08 05:20:35', '2023-08-08 05:20:35'),
(143, 150.00, 'Nola Hendricks', '1', '0', '000000', '1', 'USD', 'Visa', 1, 118, NULL, '2023-08-08 05:25:55', '2023-08-08 05:25:55'),
(144, 150.00, 'Kato Hyde', '1', '0', '000000', '1', 'USD', 'Visa', 1, 119, 119, '2023-08-08 06:12:33', '2023-08-08 06:12:33'),
(145, 150.00, 'Kato Hyde', '1', '0', '000000', '1', 'USD', 'Visa', 1, 119, 119, '2023-08-08 06:14:15', '2023-08-08 06:14:15'),
(146, 150.00, 'Kato Hyde', '1', '0', '000000', '1', 'USD', 'Visa', 1, 119, 119, '2023-08-08 06:14:30', '2023-08-08 06:14:30'),
(147, 150.00, 'Shelby Rivers', '1', '0', '000000', '1', 'USD', 'Visa', 1, 119, 119, '2023-08-08 06:17:58', '2023-08-08 06:17:58'),
(148, 150.00, 'Shelby Rivers', '1', '0', '000000', '1', 'USD', 'Visa', 1, 119, 119, '2023-08-08 06:20:00', '2023-08-08 06:20:00'),
(149, 150.00, 'Shelby Rivers', '1', '0', '000000', '1', 'USD', 'Visa', 1, 119, 119, '2023-08-08 06:20:32', '2023-08-08 06:20:32'),
(150, 150.00, 'Shelby Rivers', '1', '0', '000000', '1', 'USD', 'Visa', 1, 119, 119, '2023-08-08 06:20:43', '2023-08-08 06:20:43'),
(151, 150.00, 'Shelby Rivers', '1', '0', '000000', '1', 'USD', 'Visa', 1, 119, 119, '2023-08-08 06:23:11', '2023-08-08 06:23:11'),
(152, 150.00, 'Shelby Rivers', '1', '0', '000000', '1', 'USD', 'Visa', 1, 119, 119, '2023-08-08 06:24:38', '2023-08-08 06:24:38'),
(153, 150.00, 'Shelby Rivers', '1', '0', '000000', '1', 'USD', 'Visa', 1, 119, 119, '2023-08-08 06:24:46', '2023-08-08 06:24:46'),
(154, 150.00, 'Shelby Rivers', '1', '0', '000000', '1', 'USD', 'Visa', 1, 119, 119, '2023-08-08 06:27:47', '2023-08-08 06:27:47'),
(155, 150.00, 'Shelby Rivers', '1', '0', '000000', '1', 'USD', 'Visa', 1, 119, 119, '2023-08-08 06:28:13', '2023-08-08 06:28:13'),
(156, 150.00, 'Shelby Rivers', '1', '0', '000000', '1', 'USD', 'Visa', 1, 119, 119, '2023-08-08 06:30:09', '2023-08-08 06:30:09'),
(157, 150.00, 'Shelby Rivers', '1', '0', '000000', '1', 'USD', 'Visa', 1, 119, 119, '2023-08-08 06:30:32', '2023-08-08 06:30:32'),
(158, 150.00, 'Shelby Rivers', '1', '0', '000000', '1', 'USD', 'Visa', 1, 119, 119, '2023-08-08 06:33:24', '2023-08-08 06:33:24'),
(159, 150.00, 'Shelby Rivers', '1', '0', '000000', '1', 'USD', 'Visa', 1, 119, 119, '2023-08-08 06:33:33', '2023-08-08 06:33:33'),
(160, 150.00, 'Shelby Rivers', '1', '0', '000000', '1', 'USD', 'Visa', 1, 119, 119, '2023-08-08 06:35:38', '2023-08-08 06:35:38'),
(161, 150.00, 'Shelby Rivers', '1', '0', '000000', '1', 'USD', 'Visa', 1, 119, 119, '2023-08-08 06:36:09', '2023-08-08 06:36:09'),
(162, 150.00, 'Shelby Rivers', '1', '0', '000000', '1', 'USD', 'Visa', 1, 119, 119, '2023-08-08 06:36:35', '2023-08-08 06:36:35'),
(163, 150.00, 'Shelby Rivers', '1', '0', '000000', '1', 'USD', 'Visa', 1, 119, 119, '2023-08-08 06:37:24', '2023-08-08 06:37:24'),
(164, 150.00, 'Shelby Rivers', '1', '0', '000000', '1', 'USD', 'Visa', 1, 119, 119, '2023-08-08 06:39:01', '2023-08-08 06:39:01'),
(165, 150.00, 'Shelby Rivers', '1', '0', '000000', '1', 'USD', 'Visa', 1, 119, 119, '2023-08-08 06:39:13', '2023-08-08 06:39:13'),
(166, 150.00, 'Shelby Rivers', '1', '0', '000000', '1', 'USD', 'Visa', 1, 119, 119, '2023-08-08 06:39:47', '2023-08-08 06:39:47'),
(167, 200.00, 'Charles Sherman', '1', '0', '000000', '1', 'USD', 'Visa', 2, 119, 119, '2023-08-08 06:50:26', '2023-08-08 06:50:26'),
(168, 250.00, 'Todd Rodriguez', '1', '0', '000000', '1', 'USD', 'Visa', 2, 120, 120, '2023-08-10 14:08:09', '2023-08-10 14:08:09'),
(169, 125.00, 'Tashya Buckley', '1', '0', '000000', '1', 'USD', 'Visa', 1, 121, 121, '2023-08-10 14:11:21', '2023-08-10 14:11:21'),
(170, 19.25, 'Xenos Lara', '1', '0', '000000', '1', 'USD', 'Visa', 1, 2, 2, '2023-08-10 14:20:11', '2023-08-10 14:20:11'),
(171, 19.25, 'Tana Montgomery', '1', '0', '000000', '1', 'USD', 'Visa', 1, 2, 2, '2023-08-10 14:21:02', '2023-08-10 14:21:02'),
(172, 19.25, 'Felix Boyd', '1', '0', '000000', '1', 'USD', 'Visa', 1, 2, 2, '2023-08-10 14:37:05', '2023-08-10 14:37:05'),
(173, 69.25, 'gourav', '1', '0', '000000', '1', 'USD', 'Visa', 1, 2, 2, '2023-08-11 13:15:12', '2023-08-11 13:15:12'),
(174, 100.00, 'test user', '1', '0', '000000', '1', 'USD', 'Visa', 1, 123, 123, '2023-08-11 13:30:28', '2023-08-11 13:30:28'),
(175, 100.00, 'test', '1', '0', '000000', '1', 'USD', 'Visa', 1, 124, 124, '2023-08-11 13:37:36', '2023-08-11 13:37:36'),
(176, 250.00, 'ashish', '1', '0', '000000', '1', 'USD', 'MasterCard', 2, 126, 126, '2023-08-11 17:20:46', '2023-08-11 17:20:46'),
(177, 19.25, 'kale', '1', '0', '000000', '1', 'USD', 'MasterCard', 1, 122, 122, '2023-08-11 21:16:35', '2023-08-11 21:16:35'),
(178, 100.00, 'golu', '1', '0', '000000', '1', 'USD', 'Visa', 1, 134, 134, '2023-08-12 06:07:29', '2023-08-12 06:07:29'),
(179, 275.00, 'goli', '1', '0', '000000', '1', 'USD', 'Visa', 2, 137, 137, '2023-08-12 18:49:30', '2023-08-12 18:49:30');

-- --------------------------------------------------------

--
-- Table structure for table `kbt_uom`
--

CREATE TABLE `kbt_uom` (
  `pk_uom` bigint UNSIGNED NOT NULL,
  `pk_frequency` bigint UNSIGNED NOT NULL,
  `uom` bigint NOT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kbt_uom`
--

INSERT INTO `kbt_uom` (`pk_uom`, `pk_frequency`, `uom`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 1, 1, '2023-02-07 19:55:19', '2023-02-07 19:55:19');

-- --------------------------------------------------------

--
-- Table structure for table `kbt_user_locations`
--

CREATE TABLE `kbt_user_locations` (
  `pk_user_locations` bigint UNSIGNED NOT NULL,
  `pk_users` int NOT NULL,
  `pk_locations` int NOT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kbt_user_locations`
--

INSERT INTO `kbt_user_locations` (`pk_user_locations`, `pk_users`, `pk_locations`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(22, 114, 20, 1, 2, 2, '2023-06-23 14:52:28', '2023-06-23 14:52:28'),
(23, 114, 21, 1, 2, 2, '2023-06-23 14:52:28', '2023-06-23 14:52:28'),
(24, 2, 16, 1, 2, 2, '2023-06-23 20:33:10', '2023-06-23 20:33:10'),
(25, 2, 22, 1, 2, 2, '2023-06-23 20:33:10', '2023-06-23 20:33:10'),
(26, 103, 15, 1, 6, 6, '2023-06-28 01:14:23', '2023-06-28 01:14:23'),
(27, 103, 17, 1, 6, 6, '2023-06-28 01:14:23', '2023-06-28 01:14:23'),
(28, 103, 18, 1, 6, 6, '2023-06-28 01:14:23', '2023-06-28 01:14:23');

-- --------------------------------------------------------

--
-- Table structure for table `kbt_vase_colors`
--

CREATE TABLE `kbt_vase_colors` (
  `pk_vase_colors` bigint UNSIGNED NOT NULL,
  `pk_vase_type` bigint UNSIGNED NOT NULL,
  `pk_account` bigint UNSIGNED NOT NULL,
  `vase_colors` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kbt_vase_colors`
--

INSERT INTO `kbt_vase_colors` (`pk_vase_colors`, `pk_vase_type`, `pk_account`, `vase_colors`, `description`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 'twt', 'dnuull', 0, 2, 2, '2023-01-17 10:46:04', '2023-01-17 10:46:13'),
(4, 3, 1, 'twt', 'df', 0, 2, 2, '2023-01-23 19:10:03', '2023-01-23 19:10:09'),
(5, 2, 2, 'blue', NULL, 1, 6, 6, '2023-01-23 20:36:55', '2023-01-23 20:36:55');

-- --------------------------------------------------------

--
-- Table structure for table `kbt_vase_type`
--

CREATE TABLE `kbt_vase_type` (
  `pk_vase_type` bigint UNSIGNED NOT NULL,
  `pk_account` bigint UNSIGNED NOT NULL,
  `vase_type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kbt_vase_type`
--

INSERT INTO `kbt_vase_type` (`pk_vase_type`, `pk_account`, `vase_type`, `description`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'testingyy', 'dnuulr', 0, 2, 2, '2023-01-12 07:22:07', '2023-01-17 10:12:01'),
(2, 2, 'Ceramic', NULL, 1, 6, 6, '2023-01-12 22:12:13', '2023-01-12 22:12:13'),
(3, 2, 'Glass', NULL, 1, 6, 6, '2023-01-12 22:12:19', '2023-01-12 22:12:19');

-- --------------------------------------------------------

--
-- Table structure for table `kbt_vendors`
--

CREATE TABLE `kbt_vendors` (
  `pk_vendors` bigint UNSIGNED NOT NULL,
  `pk_account` bigint UNSIGNED NOT NULL,
  `vendor_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pk_vendor_type` bigint DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pk_states` bigint DEFAULT NULL,
  `zip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pk_country` bigint DEFAULT NULL,
  `office_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `login_enable` tinyint NOT NULL DEFAULT '0',
  `active` tinyint NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `state_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kbt_vendors`
--

INSERT INTO `kbt_vendors` (`pk_vendors`, `pk_account`, `vendor_name`, `website`, `pk_vendor_type`, `address`, `address_1`, `city`, `pk_states`, `zip`, `pk_country`, `office_phone`, `email`, `fax`, `lat`, `lng`, `login_enable`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`, `state_name`, `country_name`) VALUES
(1, 2, 'Test Vendor', NULL, 2, 'Wilshire Court', NULL, 'Los Angeles', NULL, '90025', NULL, NULL, NULL, NULL, 34.0502797, -118.4608623, 0, 1, 6, 6, '2022-12-10 16:34:09', '2023-01-19 20:14:49', 'CA', 'United States'),
(9, 1, 'livevendor2', NULL, 1, '580 5th Avenue', '580', 'New York', NULL, '10036', NULL, NULL, NULL, NULL, 40.7569693, -73.9787321, 0, 1, 2, 2, '2022-12-10 16:51:33', '2023-01-23 14:15:41', 'NY', 'United States'),
(10, 1, '123', NULL, 1, NULL, NULL, NULL, 3, '112344', 1, NULL, NULL, NULL, 34.0489281, -111.0937311, 0, 0, 2, 2, '2022-12-10 16:52:18', '2023-01-09 16:12:40', NULL, NULL),
(11, 2, 'Newport Flower shop', NULL, 2, '3401 West Olive Avenue', '3401', 'Burbank', NULL, '91505', NULL, NULL, NULL, NULL, 34.1539652, -118.3373857, 0, 1, 6, 6, '2022-12-13 16:49:00', '2023-01-19 20:15:09', 'CA', 'United States'),
(12, 1, 'vendor', NULL, 1, NULL, NULL, NULL, NULL, '25253', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 2, 2, '2022-12-13 20:03:10', '2022-12-13 20:03:10', NULL, NULL),
(14, 2, 'Vendor Test 2', NULL, 2, '1021 S Pacific Coast Hwy', NULL, 'Redondo Beach', NULL, '90277', NULL, '1112223333', 'email@email.com', NULL, NULL, NULL, 0, 1, 28, 6, '2022-12-15 23:12:25', '2023-01-23 20:31:08', NULL, NULL),
(15, 2, 'Gala Arrangements', NULL, 2, '14500 Roscoe Boulevard', '14500', 'Los Angeles', NULL, '91402', NULL, NULL, NULL, NULL, 34.2212146, -118.4490299, 0, 1, 6, 6, '2023-01-13 02:50:18', '2023-01-23 09:03:54', 'CA', 'United States'),
(17, 2, 'TIM\'S FLOWER SHOW', NULL, 2, '3467 Adina Drive', '3467', 'Los Angeles', NULL, '90068', NULL, NULL, NULL, NULL, 34.129527, -118.3541782, 0, 1, 6, 6, '2023-01-21 20:40:23', '2023-01-21 20:40:23', 'CA', 'United States');

-- --------------------------------------------------------

--
-- Table structure for table `kbt_vendor_contacts`
--

CREATE TABLE `kbt_vendor_contacts` (
  `pk_vendor_contacts` bigint UNSIGNED NOT NULL,
  `pk_account` bigint UNSIGNED NOT NULL,
  `pk_vendors` bigint UNSIGNED NOT NULL,
  `login_enable` varchar(56) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pk_department` bigint DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pk_states` bigint DEFAULT NULL,
  `zip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pk_country` bigint DEFAULT NULL,
  `office_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `state_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kbt_vendor_contacts`
--

INSERT INTO `kbt_vendor_contacts` (`pk_vendor_contacts`, `pk_account`, `pk_vendors`, `login_enable`, `contact_name`, `title`, `pk_department`, `address`, `address_1`, `city`, `pk_states`, `zip`, `pk_country`, `office_phone`, `email`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`, `state_name`, `country_name`) VALUES
(4, 1, 1, '0', 'contact test', 'Events planner', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, 2, '2022-12-13 08:20:57', '2023-04-13 10:53:42', NULL, NULL),
(6, 2, 1, '', 'Marry Poppins', 'Decorator', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 6, 6, '2022-12-13 16:47:54', '2022-12-13 16:47:54', NULL, NULL),
(7, 2, 11, '', 'Marlyn', 'decorator', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 6, 6, '2022-12-13 16:49:52', '2022-12-13 16:49:52', NULL, NULL),
(8, 2, 11, '', 'Marlyn', 'Decorator', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 6, 6, '2022-12-13 16:50:16', '2022-12-13 16:50:16', NULL, NULL),
(9, 1, 10, '', 'vendors4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, 2, '2022-12-13 17:36:36', '2022-12-13 17:36:36', NULL, NULL),
(11, 1, 9, '', 'vendors5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, 2, '2022-12-13 17:38:17', '2022-12-13 17:38:17', NULL, NULL),
(12, 1, 12, '', 'test', 'dfddf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, 2, '2022-12-13 20:03:38', '2022-12-13 20:03:54', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kbt_vendor_type`
--

CREATE TABLE `kbt_vendor_type` (
  `pk_vendor_type` bigint UNSIGNED NOT NULL,
  `pk_account` bigint UNSIGNED NOT NULL,
  `vendor_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kbt_vendor_type`
--

INSERT INTO `kbt_vendor_type` (`pk_vendor_type`, `pk_account`, `vendor_type`, `description`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 't4s', 'tesing', 1, 2, 2, '2022-12-07 07:07:02', '2022-12-07 07:07:02'),
(2, 2, 'Flower Wholeseller', NULL, 1, 6, 6, '2022-12-10 03:58:21', '2022-12-10 03:58:21'),
(3, 2, 'Delivery', NULL, 1, 6, 6, '2022-12-10 03:58:33', '2022-12-10 03:58:33'),
(5, 11, 'vendor type test 2', 'test 2', 1, 28, 28, '2022-12-14 20:22:27', '2022-12-14 20:22:27'),
(6, 1, 'tes', NULL, 1, 2, 2, '2023-01-08 13:23:56', '2023-01-08 13:23:56'),
(7, 2, 'Pickup', NULL, 1, 6, 6, '2023-04-17 22:10:22', '2023-04-17 22:10:22');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2022_12_01_185405_create_kbt_accounts_table', 1),
(4, '2022_12_01_190136_create_kbt_roles_table', 1),
(5, '2022_12_02_050719_create_kbt_states_table', 1),
(6, '2022_12_02_052305_create_kbt_countries_table', 1),
(7, '2022_12_03_134326_create_kbt_order_status_table', 1),
(8, '2022_12_03_135204_create_kbt_product_categories_table', 1),
(9, '2023_01_10_131900_add_state_name_to_kbt_customers_table', 2),
(10, '2023_01_10_132008_add_state_name_to_kbt_customer_contacts_table', 2),
(11, '2023_01_10_132022_add_state_name_to_kbt_vendors_table', 2),
(12, '2023_01_10_132034_add_state_name_to_kbt_vendor_contacts_table', 2),
(13, '2023_01_10_133222_add_county_name_to_kbt_customers_table', 2),
(14, '2023_01_10_133233_add_county_name_to_kbt_customer_contacts_table', 2),
(15, '2023_01_10_135024_add_county_name_to_kbt_vendors_table', 2),
(16, '2023_01_10_135046_add_county_name_to_kbt_vendor_contacts_table', 2),
(17, '2023_01_10_181917_alter_kbt_customers', 2),
(18, '2023_01_10_182714_alter_kbt_customer_contacts', 2),
(19, '2023_01_10_182747_alter_kbt_vendors', 2),
(20, '2023_01_10_182810_alter_kbt_vendor_contacts', 2),
(21, '2023_01_11_134628_create_vase_types_table', 2),
(22, '2023_01_11_135105_create_size_arrangements_table', 2),
(23, '2023_01_11_135120_create_color_flowers_table', 2),
(24, '2023_01_11_135132_create_styles_table', 2),
(25, '2023_01_11_205200_add_state_name_to_kbt_account_table', 2),
(26, '2023_01_11_205449_add_country_name_to_kbt_account_table', 2),
(27, '2023_01_13_062414_add_country_name_to_kbt_locations_table', 3),
(28, '2023_01_13_062955_add_state_name_to_kbt_account_table', 3),
(29, '2023_01_13_133211_create_event_types_table', 3),
(30, '2023_01_14_130139_create_location_types_table', 4),
(31, '2023_01_14_130220_create_flowers_table', 4),
(32, '2023_01_17_101716_create_vase_colors_table', 5),
(33, '2023_01_20_142355_create_product_sub_categories_table', 6),
(34, '2023_01_19_083126_create_products_table', 7),
(35, '2023_01_19_160710_create_product_images_table', 7),
(36, '2023_01_23_104805_add_pk_vase_type_to_kbt_vase_colors_table', 8),
(37, '2023_01_24_092547_create_frequencies_table', 9),
(38, '2023_01_24_092636_create_flower_subscriptions_table', 9),
(39, '2023_01_25_175349_add_lng_lat_to_kbt_locations_table', 10),
(40, '2023_01_28_101103_create_events_table', 11),
(41, '2023_01_31_140219_add_paid_to_users_table', 12),
(42, '2023_02_07_091255_create_uoms_table', 13),
(43, '2023_02_07_115457_add_uom_kbt_uom_table', 14),
(44, '2023_02_08_135710_create_arrangements_table', 15),
(45, '2023_02_08_135741_create_suggested_notes_table', 15),
(46, '2023_02_09_072602_create_customer_location_types_table', 16),
(47, '2023_02_09_194251_add_pk_location_types_kbt_locations_table', 17),
(59, '2023_05_28_090206_create_sale_types_table', 18),
(66, '2023_05_28_090208_create_sales_table', 19),
(67, '2023_05_28_090214_create_sale_items_table', 20);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `pk_users` bigint UNSIGNED NOT NULL,
  `pk_account` bigint UNSIGNED NOT NULL,
  `pk_roles` bigint UNSIGNED NOT NULL,
  `pk_vendors` bigint DEFAULT NULL,
  `pk_vendor_contacts` bigint DEFAULT NULL,
  `pk_customers` bigint DEFAULT NULL,
  `pk_customer_contacts` bigint DEFAULT NULL,
  `pk_locations` int DEFAULT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` bigint DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`pk_users`, `pk_account`, `pk_roles`, `pk_vendors`, `pk_vendor_contacts`, `pk_customers`, `pk_customer_contacts`, `pk_locations`, `first_name`, `last_name`, `email`, `email_verified_at`, `password`, `phone`, `username`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`, `remember_token`) VALUES
(1, 1, 1, 0, 0, NULL, 0, NULL, 'Ramesh', 'Ramesh', 'ramesh@gmail.com', NULL, '$2y$10$wbXTKiREdEcPubbrHiCFT.0u6qWqTbZ.vEkmTg7/WCptgXZo88alq', 2122122124, 'ramesh', 1, NULL, 1, '2022-12-04 07:54:17', '2022-12-23 13:56:36', 'ELKPLTElyiYs37cTqIDyzwAOuQD0of9AVTipUlgOPqabSOMybfBtMvzrSJUh'),
(2, 1, 2, 0, 0, NULL, 0, 22, 'Ramesh', 'Ramesh', 'admin@gmail.com', NULL, '$2y$10$WRQ6AXWKWRjKU/MjM/u.oOok.zW2LPoUnCWB1NQenRs0Djlr5Q7Am', 3122122123, 'admin', 1, NULL, 2, '2022-12-04 07:54:17', '2022-12-15 16:35:51', 'OuELv2enNhuyobbkoExCB8GwrZet13zNygbWh9YPX5xMwjGIWPzycvOLctvn'),
(29, 11, 4, NULL, 0, 18, 0, NULL, NULL, NULL, NULL, NULL, '$2y$10$iSaQ6ARd.SovkB3yuDLjge.wygWUYhujJ/TvrCkOc6CKV86T.7jA.', NULL, 'john', 1, 28, 28, '2022-12-14 20:17:51', '2022-12-14 20:17:51', NULL),
(30, 12, 2, NULL, 0, NULL, 0, NULL, 'Jimmy', 'Stewart', 'jimmy@jimmy.com', NULL, '$2y$10$75Kpqy0tAw1vCMfx2JXD2uRwn/LumRARIEjGM5RbwTyrRxDT8WMXK', 8888888888, 'jimmys', 1, 1, 1, '2022-12-14 21:08:40', '2022-12-14 21:08:40', NULL),
(33, 11, 4, NULL, 0, 23, 0, NULL, NULL, NULL, NULL, NULL, '$2y$10$U.k0HzON.DgKf.8CWu41cuaSxIP4OmXX4IJ6Hg.UR3nRT.RwHhB.e', NULL, 'guilherme', 1, 28, 28, '2022-12-15 23:34:22', '2022-12-15 23:34:22', NULL),
(34, 11, 4, NULL, 0, 26, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Nick', 1, 28, 28, '2022-12-17 00:13:21', '2022-12-17 00:13:52', NULL),
(38, 1, 4, NULL, NULL, 33, NULL, NULL, NULL, NULL, NULL, NULL, 'admintest123', NULL, 'admintest123', 1, 2, 2, '2023-01-23 07:28:49', '2023-01-23 07:28:49', NULL),
(39, 1, 4, NULL, NULL, 40, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$176f3.Vl2enf.XNs9hx.deyWAP.iyunyAtMvWJpZ0PUHOLBElfd0y', NULL, 'abhi123', 1, 2, 2, '2023-01-23 07:29:37', '2023-01-23 07:29:37', NULL),
(40, 2, 4, NULL, NULL, 42, NULL, NULL, 'Daniel', 'Direct Customer', 'dc@email.com', NULL, '$2y$10$pGO1fDfksRcDD1w1HT7zk.vI7FQG6n8inISLbZVTbKb3JQwVf7yf.', 5556667777, 'Direct Customer', 1, 6, 40, '2023-01-23 20:33:14', '2023-02-25 09:19:28', NULL),
(41, 11, 3, NULL, NULL, NULL, NULL, NULL, 'Kim', 'Johnson', 'email@email.com', NULL, '$2y$10$SOa/uUHnZWbX2.5bfIIzFuHNtVV02qpemTDKPSU1EMTupEbZ5lVpG', 1112222, 'Kim', 1, 28, 28, '2023-01-27 19:32:47', '2023-01-27 19:32:47', NULL),
(42, 1, 4, NULL, NULL, 44, NULL, NULL, 'new', 'email', NULL, NULL, '$2y$10$lYFx2SNKlcOsSEJ0GM4bDuTXHxE8pk1tmPuba3SjrUbFcv63e7tfO', NULL, 'newmwi', 1, NULL, NULL, '2023-02-04 16:48:19', '2023-02-04 16:48:19', NULL),
(43, 1, 4, NULL, NULL, 45, NULL, NULL, 'test', 'raj', NULL, NULL, '$2y$10$CHyhhdbjRzrO6yQ6sEqfdeB86rdcI6z2YtdICGpwhU7ozqVZBuoVK', NULL, 'tsstraj', 1, NULL, NULL, '2023-02-04 16:51:47', '2023-02-04 16:51:47', NULL),
(44, 1, 4, NULL, NULL, 46, NULL, NULL, 'raai', 'name', NULL, NULL, '$2y$10$al.dYoh8l2MWYZTzy1w9l.Tj/xxf6B4VU7ChEb6ik4V9B7ylw9fya', NULL, 'rai89', 1, NULL, NULL, '2023-02-05 13:08:39', '2023-02-05 13:08:39', NULL),
(45, 1, 4, NULL, NULL, 47, NULL, NULL, 'Test', 'Raj', 'testrj@test.com', NULL, '$2y$10$L6N37afIeM1.8U.Dq35xuOeRznuHOuyq3TP8RmdHu4ysAs9Q2.Crm', NULL, 'testrj', 1, NULL, NULL, '2023-02-05 17:18:37', '2023-02-05 17:18:37', NULL),
(46, 1, 4, NULL, NULL, 48, NULL, NULL, 'test', 'Ramesh', NULL, NULL, '$2y$10$o1rHAtJ0qGj/5RWo/3eYJebRTu6wMLKsnze7xCc8T7mF6lKDjqtye', NULL, 'admin585858', 1, NULL, NULL, '2023-02-06 18:47:04', '2023-02-06 18:47:04', NULL),
(47, 1, 4, NULL, NULL, 49, NULL, NULL, 'John', 'Doe', 'emai@email.com', NULL, '$2y$10$2ivdo8GO1cKCaJqRVY.QeO5L/4iib9hvy2JzEGYnBcS74HqoVgoZq', NULL, 'jdoe', 1, NULL, NULL, '2023-02-06 23:47:31', '2023-02-06 23:47:31', NULL),
(48, 1, 1, NULL, NULL, NULL, NULL, NULL, 'nu', 'tes', 'nutd@gma.com', NULL, '$2y$10$hIBTyoyOn6JVvYaiz/WKqulLWogkQUydW41p0Y2gVfk/A3hjOVHra', 2122122124, 'nutd', 1, NULL, NULL, '2023-02-17 12:40:58', '2023-02-17 12:40:58', NULL),
(49, 1, 1, NULL, NULL, NULL, NULL, NULL, 'yuyu', 'yuyu', 'yuyuju@gmail.com', NULL, '$2y$10$alPAyAQrQRSfE1OHEq0b9uN0sg/L1vLxB8o944qTWWLKb2tctnbT.', 2122122124, 'yuyu', 1, NULL, NULL, '2023-02-17 12:46:26', '2023-02-17 12:46:26', NULL),
(50, 1, 4, NULL, NULL, NULL, NULL, NULL, 'juju', 'juju', 'jujul@gmail.com', NULL, '$2y$10$aBlf8znIL9x/jbO3aeMUt.YrjlWRaWyL58b6UdpBaKe.zKyr0Bf4u', 2122122124, 'jujul', 1, NULL, NULL, '2023-02-17 12:51:17', '2023-02-17 12:51:17', NULL),
(51, 1, 4, NULL, NULL, NULL, NULL, NULL, 'test', 'juju', '8989@gmail.com', NULL, '$2y$10$8WJbki2lXW.AfLOaJbVnyOyiUMqhq2Z6YeqxWOvYAr9sZwt5HnbMG', 2122122124, '89889k', 1, NULL, NULL, '2023-02-21 13:59:53', '2023-02-21 13:59:53', NULL),
(52, 1, 4, NULL, NULL, NULL, NULL, NULL, 'John', 'Doe', 'emailtest@email.com', NULL, '$2y$10$RugLvZKN/pbwSsDH/YKoA.bWR7Sh3J6oXJSThhSU6kV88DzbO1VQC', 1112223333, 'JohnDoe', 1, NULL, NULL, '2023-02-21 18:31:24', '2023-02-21 18:31:24', NULL),
(53, 1, 4, NULL, NULL, NULL, NULL, NULL, 'test', 'thg', 'jijiii@gmail.com', NULL, '$2y$10$cHHr5taWr8i8xyz3oeohd.LAA7.ivf0CSVCBGRKJSOWkTFA3WOFZy', 2122122124, 'jiji', 1, NULL, 53, '2023-02-23 07:48:00', '2023-02-23 07:48:49', NULL),
(54, 1, 4, NULL, NULL, NULL, NULL, NULL, 'raai', 'jiji', 'jijk@gmail.com', NULL, '$2y$10$AHnh69/xLTzLyFO.3Z3Wk.uE7vdUSgvgeX6HtYPYZCe4X3WRxhu4.', 2122122124, 'jiki', 1, NULL, 54, '2023-02-24 07:28:53', '2023-02-24 07:29:12', NULL),
(55, 1, 4, NULL, NULL, 50, NULL, NULL, 'John', 'Doe', 'emailtestt@email.com', NULL, '$2y$10$N2HdAShKt2PQHKPWBAuKp.SmfBr1K0RQ15dusfKsRwBboj7T/PwEO', NULL, 'jd', 1, NULL, NULL, '2023-02-24 19:33:10', '2023-02-24 19:33:10', NULL),
(56, 1, 4, NULL, NULL, 51, NULL, NULL, 'abhicus', 'abhicus', NULL, NULL, '$2y$10$FlQNvvGSxY1wDfaXhaNgIOvG7r6H8QTibPWRS2s9.5ZWasPlY1tay', NULL, 'abhicus', 1, NULL, NULL, '2023-02-27 05:56:15', '2023-02-27 05:56:15', NULL),
(57, 1, 4, NULL, NULL, 52, NULL, NULL, 'Roger', 'Smith', 'abc@abc.com', NULL, '$2y$10$gXKv1Xs5AXbFiBxJhgXjm.mMkvrOka3fn6Vl3cxpkD067Gq/WMEKy', NULL, 'RogerSmith', 1, NULL, NULL, '2023-02-27 19:20:39', '2023-02-27 19:20:39', NULL),
(58, 1, 4, NULL, NULL, 53, NULL, NULL, 'rav', 'Ramesh', 'tesoot@gmail.com', NULL, '$2y$10$93EBx/fwxxGnY26zkgLFf.2xKa85UTzVorq9i.Rztkf0WAHG9QqT6', NULL, 'kiki', 1, NULL, NULL, '2023-03-02 06:49:19', '2023-03-02 06:49:19', NULL),
(59, 1, 4, NULL, NULL, 54, NULL, NULL, 'abhicus', 'abhicus', 'abhicus@gmail.com', NULL, '$2y$10$boZvLjTEmTqgL5d8ltH27OmWnwX60xTizYrziqxx6NIHgxE0i3dGi', 2122122124, 'abhicus12', 1, NULL, NULL, '2023-03-04 06:10:58', '2023-03-04 06:10:58', NULL),
(61, 1, 4, NULL, NULL, 56, NULL, NULL, 'Roger', 'Smith', NULL, NULL, '$2y$10$EL1z0HL/jFgdtfXU9eKI5O7bI0sJVh5phpR1tEQFxmkiuzswjpcVy', NULL, NULL, 1, NULL, NULL, '2023-03-09 23:25:50', '2023-03-09 23:25:50', NULL),
(62, 1, 4, NULL, NULL, 57, NULL, NULL, 'Peter', 'Mint', 'emailemail@email.com', NULL, '$2y$10$RqUPQm0.itpkMF3NZNKHpO5WmZbZrVCg93GLN9IMqo58Y9ItOmfMG', 1112223333, 'Peterm', 1, NULL, NULL, '2023-03-11 00:32:48', '2023-03-11 00:32:48', NULL),
(63, 1, 4, NULL, NULL, 58, NULL, NULL, 'John', 'Doe', 'emailnew@email.com', NULL, '$2y$10$qU59M9uhrKdk2BjGETsryejwYPi3rq2iL1l95pb7xt.zxOc43PZOW', 1112223333, 'jjdd', 1, NULL, NULL, '2023-03-14 01:02:29', '2023-03-14 01:02:29', NULL),
(64, 1, 4, NULL, NULL, NULL, NULL, NULL, 'Sindhu', 'sindhu', 'sindhu@gmail.com', NULL, '$2y$10$uzEHtlAR4DVdrOeQSWxp3.nni03LXLsIVAewEoF7Jk2t/zhB57vVy', 2122122124, 'sindhu', 1, NULL, NULL, '2023-03-14 19:12:13', '2023-03-14 19:12:13', NULL),
(65, 1, 4, NULL, NULL, 59, NULL, NULL, 'guest', 'user', 'guest@gmail.com', NULL, '$2y$10$xIY0ADmyOe0dKhsycNGWCO8f.9uJcODxEbL/VijT/4k2lgJ8uxvpu', 8950889508, 'guest', 1, NULL, NULL, '2023-03-17 15:52:00', '2023-03-17 15:52:00', NULL),
(66, 1, 4, NULL, NULL, 60, NULL, NULL, 'Alex', 'Fin', 'alexf@email.com', NULL, '$2y$10$gDHv/tAQnqSMocQjRvWDueomnqaIPLe3FL7JTC7T29P1L3vEOtFai', 1112223333, 'AlexF', 1, NULL, NULL, '2023-03-17 19:00:12', '2023-03-17 19:00:12', NULL),
(67, 1, 4, NULL, NULL, NULL, NULL, NULL, 'John', 'Doe', 'John@doe.com', NULL, '$2y$10$m3m9PXqQEbMP7x214c.dJ.mQa8thQqNKDANTHY4hfAmiJDcMNlnxK', 81855555555, 'johndoe123', 1, NULL, NULL, '2023-03-20 00:18:16', '2023-03-20 00:18:16', NULL),
(68, 1, 4, NULL, NULL, 62, NULL, NULL, 'retest', 'retest', 'retest@gmail.com', NULL, '$2y$10$BODVhQuizUoc.NKMgU0m6.abQHs8RG6.8fgvjpfQppH6WtRhXuhpO', 8989898989, 'retest', 1, NULL, NULL, '2023-03-20 13:33:50', '2023-03-20 13:33:50', NULL),
(69, 1, 4, NULL, NULL, 63, NULL, NULL, 'test', 'user', 'test+2@gmail.com', NULL, '$2y$10$stvjmGpSK1vWxEQ.dpQqrOuGHo5LVPTDevEtZ6g7K/T/XwR1nvtRy', 989898989, 'test+2', 1, NULL, NULL, '2023-03-21 15:13:40', '2023-03-21 15:13:40', NULL),
(70, 1, 4, NULL, NULL, 64, NULL, NULL, 'gourav', 'kumar', 'gourav+kumar@gmail.com', NULL, '$2y$10$j3LFLXAe64mKfe/iP2SGiek8662lL6Ot9xXsS4pgZhtNEneqe4re2', 8989889899, 'gourav+kumar', 1, NULL, NULL, '2023-03-22 08:31:25', '2023-03-22 08:31:25', NULL),
(71, 1, 4, NULL, NULL, 65, NULL, NULL, 'gourav', 'kumar', 'gourav+2kumar@gmail.com', NULL, '$2y$10$V01tXuAq/xkAbAdo7g.mEuULPwcd49pKEhesvkSQuMbEBxI95whW6', 8998998989, 'gourav+2kumar', 1, NULL, NULL, '2023-03-22 08:35:19', '2023-03-22 08:35:19', NULL),
(72, 1, 4, NULL, NULL, NULL, NULL, NULL, 'test', 'user', 'testing+user@gmail.com', NULL, '$2y$10$FQNRMUgFkdv0xMZfNio0o.eJ5di9eCtN4sq5TiA8wJrLgRGZAqBIW', 34584735485, 'testing+user', 1, NULL, NULL, '2023-03-22 13:26:01', '2023-03-22 13:26:01', NULL),
(73, 1, 4, NULL, NULL, NULL, NULL, NULL, 'sindhu', '1', 'sindhu1@gmail.com', NULL, '$2y$10$sAd28U3qNkD4B8avvK4kneMq3Rr8V6Fhgry8erSFw578IMDoXN10u', 8989898989, 'sindhu1', 1, NULL, NULL, '2023-03-22 18:25:11', '2023-03-22 18:25:11', NULL),
(74, 1, 4, NULL, NULL, NULL, NULL, NULL, 'sindhu', '2', 'sindhu2@gmail.com', NULL, '$2y$10$yXkR8oiNNAtduND34SbCoeGysVN4JX8/hJyRcXFEY8StgiR2IoRty', 8989898989, 'sindhu2', 1, NULL, NULL, '2023-03-22 18:27:51', '2023-03-22 18:27:51', NULL),
(75, 1, 4, NULL, NULL, NULL, NULL, NULL, 'sindhu', '3', 'sindhu3@gmail.com', NULL, '$2y$10$pvKcIJG92vDrVLDTTXRJDOvtGO44YBcdPESwQcmHlAfz0jYcCsiD.', 8989898989, 'sindhu3', 1, NULL, NULL, '2023-03-22 18:29:27', '2023-03-22 18:29:27', NULL),
(76, 1, 4, NULL, NULL, NULL, NULL, NULL, 'sindhu', '5', 'sindhu5@gmail.com', NULL, '$2y$10$NMKspgAKDqBJbdpRrantz.g6w5M8FbBdgf67fogtG2236y.cMzD6u', 8989898989, 'sindhu5', 1, NULL, NULL, '2023-03-22 18:30:45', '2023-03-22 18:30:45', NULL),
(77, 1, 4, NULL, NULL, 66, NULL, NULL, 'test', 'user', 'sindhu6@gmail.com', NULL, '$2y$10$twoyDX/gxFkc4dZt4EZ24OTORjEx0.guPpJnQW3DhClhgk8.fZcfa', 8989898989, 'sindhu6', 1, NULL, NULL, '2023-03-22 18:55:10', '2023-03-22 18:55:10', NULL),
(78, 1, 4, NULL, NULL, NULL, NULL, NULL, 'Andre', 'Militi', 'andre@email.com', NULL, '$2y$10$mN10oFcZK8e1j1VbDflNl.1lgKdPq8hH/bubWSOIWkEL/jLNfLHW6', 1112223333, 'Andre Customer', 1, NULL, NULL, '2023-03-23 20:14:13', '2023-03-23 20:14:13', NULL),
(79, 1, 4, NULL, NULL, NULL, NULL, NULL, 'Andre', 'militiu', 'militiu@email.com', NULL, '$2y$10$9U8xdefmpYd2VWHiAAkw2.eyoRlndClWgfAsEfE2oh7rLjScEsvom', 2233366655, 'andre militiu cust', 1, NULL, NULL, '2023-03-23 20:16:57', '2023-03-23 20:16:57', NULL),
(80, 1, 4, NULL, NULL, 67, NULL, NULL, 'cust', 'omer', 'customer3683@gmail.com', NULL, '$2y$10$X48.pkl19uEBd7VVR3.eVeEZjoFGUZj6PoOHuv0qu6DBWlnLpPqzO', 9999999999, 'customer3683', 1, NULL, NULL, '2023-04-10 13:28:49', '2023-04-10 13:28:49', NULL),
(81, 1, 4, NULL, NULL, 68, NULL, NULL, 'vi', 'vi', 'vi123@gmail.com', NULL, '$2y$10$fNKbI0ztFn1ZOaNiCe8NOOOGQXLJIXt93jdfOYe3yTilCuVlS4wXW', 898989899, 'vi123', 1, NULL, NULL, '2023-04-25 17:26:39', '2023-04-25 17:26:39', NULL),
(82, 1, 4, NULL, NULL, 69, NULL, NULL, 'customer', '123', 'custom125@gmail.com', NULL, '$2y$10$b.RcYHtdOEROruJYQYRvM.X5tNCywn75kWvQWLXodl95ayrNhtVuq', 8989998998, 'custom125', 1, NULL, NULL, '2023-04-25 18:22:13', '2023-04-25 18:22:13', NULL),
(83, 1, 4, NULL, NULL, 70, NULL, NULL, 'test', 'test', 'tyt123@gmail.com', NULL, '$2y$10$xBXuI4MOJCaMDNd.x6/rzOfyeLOKId2ce1OSrrcEg6iV5P1hLIvSe', 8989898989, 'tyt123', 1, NULL, NULL, '2023-04-25 18:23:52', '2023-04-25 18:23:52', NULL),
(84, 1, 4, NULL, NULL, 71, NULL, NULL, 'Raj', 'Luxmi', 'raj@gmail.com', NULL, '$2y$10$Yst35w4l.rJ/lck59V0k8uctH3jZwoE/y9K9lTHWQq07EBiWqPTIu', 8898899989, 'Raj', 1, NULL, NULL, '2023-04-26 08:06:50', '2023-04-26 08:06:50', NULL),
(85, 1, 4, NULL, NULL, 72, NULL, NULL, 'teting', 'teting', 'teting123@gmail.com', NULL, '$2y$10$WZ7zpPa0aDxCPSBuz5FUDeET4C9wlBBaCwNty7vz8Xha595lAAKSK', 8898998999, 'teting123', 1, NULL, NULL, '2023-04-26 08:14:26', '2023-04-26 08:14:26', NULL),
(86, 1, 4, NULL, NULL, 73, NULL, NULL, 'customer', '5678', 'cua5678@gma.co', NULL, '$2y$10$D/HGoqW79HYOpvQ5U1xEpOFcKqvFk0r9hAsTWpkqJxsCw3XCpfFyi', 8989898989, 'cua5678', 1, NULL, NULL, '2023-04-26 09:06:47', '2023-04-26 09:06:47', NULL),
(87, 1, 4, NULL, NULL, 74, NULL, NULL, 'store', 'order', 'storeorder@gmail.com', NULL, '$2y$10$B5xbU3HtgchUsHVzVADy6eizcxDXhlR1CMJVO6GKhC0HxFvIjefoK', 8998998989, 'storeorder', 1, NULL, NULL, '2023-04-27 09:07:50', '2023-04-27 09:07:50', NULL),
(88, 1, 4, NULL, NULL, 75, NULL, NULL, 'aaar', 'av', 'aarav@g.c', NULL, '$2y$10$MxCIEGw3c9mL8QYgAHRbsem3mBU19O.i0Um3z6Mybh8ZS41Aecf5W', 8898998999, 'aarav', 1, NULL, NULL, '2023-04-28 09:25:42', '2023-04-28 09:25:42', NULL),
(89, 1, 4, NULL, NULL, 76, NULL, NULL, 'tesy', 'tesy', 'testy36@gmail.com', NULL, '$2y$10$1jNbX6pty74dss041Wn61OVmLJ.6ztKtlQoVqVwWgMxPk9ySgnjha', 8989898989, 'testy36', 1, NULL, NULL, '2023-05-01 06:57:40', '2023-05-01 06:57:40', NULL),
(90, 1, 4, NULL, NULL, 77, NULL, NULL, 'test', 'test', '25tet@gmail.com', NULL, '$2y$10$VqjQGEiEgtmFiQ.qdRRbl.vryZsKocJ/cIRqMvZMi5J64XzQmsYNO', 8989898989, '25tesy', 1, NULL, NULL, '2023-05-01 08:24:16', '2023-05-01 08:24:16', NULL),
(91, 1, 4, NULL, NULL, 78, NULL, NULL, 'gk', 'gk', 'gkgk@gmail.com', NULL, '$2y$10$rYAsKWb0KDp5xOHboRx5ZOVs1M06sl6JHsZ3coW6PFB9kEF3lfKNS', 989898989, 'gkgk', 1, NULL, NULL, '2023-05-02 05:23:00', '2023-05-02 05:23:00', NULL),
(92, 1, 4, NULL, NULL, NULL, NULL, NULL, 'Mark', 'Lloyd', 'email2@email.com', NULL, '$2y$10$CmIsGiKYZ8R4Tgilrxhah.NPdjtX1MPkhTT6o5YWxDDxX8kRBR2bq', 1112223333, '2 direct customer', 1, NULL, NULL, '2023-05-02 06:31:05', '2023-05-02 06:31:05', NULL),
(93, 1, 4, NULL, NULL, NULL, NULL, NULL, 'gourav', 'kum', 'gkmum@gmail.com', NULL, '$2y$10$.C6EXTClvP1EukgVcrfJSuutTp1bcckWEmrvpDAp/LaoJlHtGm4G2', 8989898989, 'gkmumcus', 1, NULL, NULL, '2023-05-02 06:51:22', '2023-05-02 06:51:22', NULL),
(94, 1, 4, NULL, NULL, 80, NULL, NULL, 'ni', 'diya', 'nini@gmail.com', NULL, '$2y$10$kt12MIaKR.UTCY78im8EIexhV2mVmx8zC5hrZIwsodzFhp70spcVe', 8999899999, 'nini', 1, NULL, NULL, '2023-05-02 08:17:56', '2023-05-02 08:17:56', NULL),
(95, 1, 4, NULL, NULL, NULL, NULL, NULL, 'Direct Customer 2', 'l', 'email5@email.com', NULL, '$2y$10$YTD9IKgMUM.zkK5WfOhaHuBv49UwgKS.udXAEVKQ3E8r7C7BLII6O', 0, 'email@email.com', 1, NULL, NULL, '2023-05-24 00:43:05', '2023-05-24 00:43:05', NULL),
(96, 1, 4, NULL, NULL, NULL, NULL, NULL, 'daniel', 'Calog', 'email8@email.com', NULL, '$2y$10$hoV7qohsyjmoZSKV4cjDp.WWRTB80KwUMNqm6XVro5dJUumpP0V96', 1112223333, 'email8@email.com', 1, NULL, NULL, '2023-05-24 23:44:16', '2023-05-24 23:44:16', NULL),
(97, 1, 4, NULL, NULL, NULL, NULL, NULL, 'Direct Customer', 'Kim', 'Silva@email.com', NULL, '$2y$10$2uCHokv0eRljRs.cgNG.FegEXrDH9mXf.mcOjUV.rroL3I/uVNhmm', 1112223333, 'Direct Customer 2', 1, NULL, NULL, '2023-06-16 23:54:56', '2023-06-16 23:54:56', NULL),
(98, 1, 4, NULL, NULL, NULL, NULL, NULL, 'testing', 'kr', 'testingui@gmail.com', NULL, '$2y$10$kd4CsxTlby79dPvf0Z5EXutGz85jiUtfL.e7cJHiDyr6yl2V7JyU2', 8989898989, 'testingui', 1, NULL, NULL, '2023-06-17 17:19:45', '2023-06-17 17:19:45', NULL),
(99, 1, 4, NULL, NULL, NULL, NULL, NULL, 'yiva', 'you', 'yiva@gmail.com', NULL, '$2y$10$mi6yvBTWFx4WA/A8DMNBP.KznfvFyB4J/vNdVlO7xNM3R8fWw0EHq', 1234567890, 'yivayou', 1, NULL, NULL, '2023-06-17 17:26:17', '2023-06-17 17:26:17', NULL),
(101, 1, 5, NULL, NULL, NULL, NULL, 0, 'vendor', 'vendor', 'vendor1@gmail.com', NULL, '$2y$10$xxYKigxfP3OeTuefxbTDGOBlW4o.wORsbzNzOkBLePK3xLg1cUIAa', 1234567890, 'vendor1', 1, 2, 2, '2023-06-23 15:46:13', '2023-06-23 15:46:13', NULL),
(102, 1, 5, NULL, NULL, NULL, NULL, NULL, 'vendor', '2', 'vendor2@gmail.com', NULL, '$2y$10$FhfS4mBxhlwoJ1WMP9c9PuEyjArRVdv4ISEs8AHgSKiM5jfLRfufe', 1234567890, 'vendor2', 1, 2, 2, '2023-06-23 20:33:10', '2023-06-23 20:33:10', NULL),
(103, 2, 5, NULL, NULL, NULL, NULL, NULL, 'Vendor', 'test', 'email11@email.com', NULL, '$2y$10$ieS28uffQ5xFJ8JuQvYhEufDcmqXUwwQEBriA2SE5kj8PkZN3U2cu', 1112223333, 'Vendor', 1, 6, 6, '2023-06-28 01:14:23', '2023-06-28 01:14:23', NULL),
(104, 1, 4, NULL, NULL, 82, NULL, NULL, 'John', 'Doe', 'abc@abc123.com', NULL, '$2y$10$uxZMB/5EGlfVwsWxi7C02uo2rQHxVEA.uYjYKZypmGrskdb.WgH92', 6666666666, 'abc@abc.com', 1, NULL, NULL, '2023-06-29 22:38:02', '2023-06-29 22:38:02', NULL),
(105, 1, 4, NULL, NULL, 84, NULL, NULL, 'guest', 'user45', 'guestuser45@gmail.com', NULL, '$2y$10$j/oDF9g7.sNieT3gEgrTK.jYv.h9KEXpJfZkBg4nXq9NtlQb86hGa', 8989898989, 'guestuser45@gmail.com', 1, NULL, NULL, '2023-07-01 04:47:07', '2023-07-01 04:47:07', NULL),
(106, 1, 4, NULL, NULL, 85, NULL, NULL, 'Debdulal', 'Baidya', NULL, NULL, '$2y$10$kqPaiePfsfZPtoHaYteUmOHePw3rRtyAHrpx37sUvuS6/qqO9v/AG', 8801303214079, NULL, 1, NULL, NULL, '2023-07-01 04:50:02', '2023-07-01 04:50:02', NULL),
(107, 1, 4, NULL, NULL, 86, NULL, NULL, 'Debdulal', 'Baidya', NULL, NULL, '$2y$10$7WtVRv3JJ9IQ9g3wwFJxIuJQ4SBIF/NTolIOfUk3SX6GJLPfs9y6m', 8801303214079, NULL, 1, NULL, NULL, '2023-07-01 19:39:05', '2023-07-01 19:39:05', NULL),
(109, 1, 4, NULL, NULL, 88, NULL, NULL, 'test', 'investigator', 'investitest@yopmail.com', NULL, '$2y$10$.9w26oj5vtojGNZ0eWPFNehVwKSYKhbD2MTtrg0Lxd5aVrdPnB3LK', 8989898989, 'investitest', 1, NULL, NULL, '2023-07-08 15:00:44', '2023-07-08 15:00:44', NULL),
(110, 1, 4, NULL, NULL, 89, NULL, NULL, 'bernardo', 'Doe', 'email10@email.com', NULL, '$2y$10$atEroaPfXGkgpWdyZCCxGO415J.5WYcArbW7e7VCi8tJlYgmg9puK', 1112223333, NULL, 1, NULL, NULL, '2023-07-10 22:33:40', '2023-07-10 22:33:40', NULL),
(111, 1, 4, NULL, NULL, 91, NULL, NULL, 'test', 'user', 'testemail@email.com.br', NULL, '$2y$10$DwtkWEx1rSvoOFfmMTEfY.w.E5IRZB.AJi.ogNGlzc2/oDl/zjS0O', 1112222, NULL, 1, NULL, NULL, '2023-07-24 21:08:52', '2023-07-24 21:08:52', NULL),
(113, 1, 4, NULL, NULL, 93, NULL, NULL, 'deliverycast', 'deliverycast', 'deliverycast@gmail.com', NULL, '$2y$10$E70BH2NHWOGMxoi7Y./FGe/Jl1xVwfIBubEJh/aXjs03LzMwophs.', 8989889899, 'deliverycast', 1, NULL, NULL, '2023-08-04 11:03:24', '2023-08-04 11:03:24', NULL),
(114, 1, 4, NULL, NULL, NULL, NULL, NULL, 'test', 'user', 'testaagya@gmail.com', NULL, '$2y$10$9IRYMqI8kzYMY6Si6.Qte.Mp5dMpkRecdL32n/InvLO.Bp7EJpCRq', 8989898989, 'testaagya', 1, NULL, NULL, '2023-08-07 19:17:36', '2023-08-07 19:17:36', NULL),
(115, 1, 4, NULL, NULL, NULL, NULL, NULL, 'John', 'doe', NULL, NULL, '$2y$10$kTgtnguKIM.aW5mBs3L2meYuZRutOvK0.fc/hRpe1IuNkimV9.Yzi', 5555555555, NULL, 1, NULL, NULL, '2023-08-07 20:47:43', '2023-08-07 20:47:43', NULL),
(116, 1, 4, NULL, NULL, NULL, NULL, NULL, 'my', 'name', 'myname@gmail.com', NULL, '$2y$10$aHJ3efV8/gDAOMKEV1cBKuACmSsklD.eba/.ehwT65Ad2Yf2Q5pfe', 8998998989, 'myname', 1, NULL, NULL, '2023-08-08 01:31:55', '2023-08-08 01:31:55', NULL),
(117, 2, 4, NULL, NULL, NULL, NULL, NULL, 'Aladdin', 'Stone', 'sojadov@mailinator.com', NULL, '$2y$10$02PmCi88hUGMDPPq1k/s7u/AuwpAGDYHEiLcnig1pO8MUuDzQv9EK', 1, 'livikajej', 1, NULL, NULL, '2023-08-08 05:20:32', '2023-08-08 05:20:32', NULL),
(118, 2, 4, NULL, NULL, NULL, NULL, NULL, 'Emi', 'Dunn', 'tylocebif@mailinator.com', NULL, '$2y$10$M9h95y1viFB/2Sh/IFYh8.z4Wj7lFsJzUwhBmbvGds4MvyWzpwItu', 1, 'ginene', 1, NULL, NULL, '2023-08-08 05:25:54', '2023-08-08 05:25:54', NULL),
(119, 2, 4, NULL, NULL, 99, NULL, NULL, 'Ian', 'Glass', 'rite@mailinator.com', NULL, '$2y$10$T5zcLoY4XHi/yH1xMWNd0uk2Dlgodi49L.LAdiTdOlsPxL3nB4Ov.', 1, 'xivar', 1, NULL, 119, '2023-08-08 05:32:56', '2023-08-08 06:08:04', NULL),
(120, 2, 4, NULL, NULL, 104, NULL, NULL, 'Fallon', 'House', 'fahoqim@mailinator.com', NULL, '$2y$10$Wa.2HJjvBl/bnF.yD.p/4uexqPtVTcaEGU1D/bG5XBgFiH0yer.hy', 1, 'mipupytal', 1, NULL, NULL, '2023-08-10 14:08:07', '2023-08-10 14:08:07', NULL),
(123, 1, 4, NULL, NULL, 106, NULL, NULL, 'golu', 'ji', 'golug@gmail.com', NULL, '$2y$10$OMjsoZG.kBQ/RKofumdB7OBF8eH4S6kmW87qZccfXKFiXN0y9soTS', NULL, 'golug', 1, NULL, 123, '2023-08-11 13:27:34', '2023-08-11 13:30:27', NULL),
(124, 2, 4, NULL, NULL, 107, NULL, NULL, 'test', 'hi', 'hitest@gmail.com', NULL, '$2y$10$KzbjbaTlMXFQNmVKFIEwdOSD9fQ1TW1WDHUlRifcgGyI6SBvSH7F6', 1234567890, 'hitest', 1, NULL, NULL, '2023-08-11 13:37:35', '2023-08-11 13:37:35', NULL),
(125, 1, 4, NULL, NULL, 108, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$yoAH1DqAWl5jfYo6XlZueu1vbxbi6q5k8GfA83ja2YHr.zbHSVI6e', NULL, 'avim', 1, 2, 2, '2023-08-11 13:40:45', '2023-08-11 13:40:45', NULL),
(126, 2, 4, NULL, NULL, 109, NULL, NULL, 'Ashish', 'Gupta', 'ashish@gmail.com', NULL, '$2y$10$qdSpLcdUAs1zsA0LgTMskOTIsC4P8eb/AxI96XTrj1l8Rhnr2p4Yy', 123456789, 'ashish', 1, NULL, NULL, '2023-08-11 17:17:02', '2023-08-11 17:17:02', NULL),
(127, 1, 4, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$UMgZw0Z3e6I7Yw.OzhCK9O2y0I3xSQyoPAtEdCWd.yjUARzwWpv8C', NULL, 'jiaho', 1, 2, 2, '2023-08-11 18:16:07', '2023-08-11 18:16:07', NULL),
(128, 1, 4, NULL, NULL, NULL, NULL, NULL, 'Register', 'Test', 'register@email.com', NULL, '$2y$10$czTrt0nCBOY7uanexueWGORzF.gpI7vkBvMnUdAvoiA25Wm3ngUkC', NULL, 'register test', 1, NULL, NULL, '2023-08-11 18:40:30', '2023-08-11 18:40:30', NULL),
(129, 1, 4, NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, '1234567890', NULL, '123user', 1, 2, 2, '2023-08-11 18:55:24', '2023-08-11 18:55:24', NULL),
(130, 1, 4, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, '12345678', NULL, 'sure', 1, 2, 2, '2023-08-11 18:57:46', '2023-08-11 18:57:46', NULL),
(131, 2, 4, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, 'Pass!234', NULL, 'Daniel Customer', 1, 122, 122, '2023-08-11 20:36:01', '2023-08-11 20:36:01', NULL),
(132, 2, 4, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$aUyuVu14.nHuiLCE7WpES.dW.hmMdw6xHmAGe9G8aIZXBvSlHQ.6i', NULL, 'jbourne', 1, 122, 122, '2023-08-11 22:20:37', '2023-08-11 22:20:37', NULL),
(133, 1, 4, NULL, NULL, NULL, NULL, NULL, 'newcus', 'hai', 'hnewcus@gmail.com', NULL, '$2y$10$vOL3hfLvk6csW5Iq/9OEVO7q9UtT52T61nXgR1f5Of2nFgOw5Ww5a', NULL, 'hnewcus', 1, NULL, NULL, '2023-08-12 06:03:11', '2023-08-12 06:03:11', NULL),
(134, 1, 4, NULL, NULL, 8, NULL, NULL, 'gup', 'ta', 'gup@gmail.com', NULL, '$2y$10$xzueQ/x3sIsa5lfp0NdN3eT.dWiMyKcLBqhACt7V6Ni31TlIAfKW6', NULL, 'gup', 1, NULL, 134, '2023-08-12 06:05:43', '2023-08-12 06:07:29', NULL),
(135, 1, 4, NULL, NULL, NULL, NULL, NULL, 'test', 'h', 'jika@yahoo.co', NULL, '$2y$10$CuCKHxqRBgsaXKWxZohmGOGcz292si0KcDT1AcWRfgCCo541bQNaq', NULL, 'jika', 1, NULL, NULL, '2023-08-12 09:46:08', '2023-08-12 09:46:08', NULL),
(136, 1, 4, NULL, NULL, NULL, NULL, NULL, 'test', 'jik', 'jik@g.com', NULL, '$2y$10$JOYAOMnMVpzRg9S1kfqzH.JokR6cqS/oRxfyAmieNYfvPPEGCFZvG', NULL, 'jik', 1, NULL, NULL, '2023-08-12 18:46:19', '2023-08-12 18:46:19', NULL),
(137, 2, 4, NULL, NULL, 9, NULL, NULL, 'tyu', 'jk', 'tyu@gmail.com', NULL, '$2y$10$3cXv4oR0aaUm0H88gj09buovXGxYzMHkSkN7sB7kju7KyNVI3CXMW', 7878787885, 'tyuju', 1, NULL, NULL, '2023-08-12 18:49:29', '2023-08-12 18:49:29', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kbt_account`
--
ALTER TABLE `kbt_account`
  ADD PRIMARY KEY (`pk_account`);

--
-- Indexes for table `kbt_account_admin_payment_gateways`
--
ALTER TABLE `kbt_account_admin_payment_gateways`
  ADD PRIMARY KEY (`pk_account_admin_payment_gateways`);

--
-- Indexes for table `kbt_acknowledgments`
--
ALTER TABLE `kbt_acknowledgments`
  ADD PRIMARY KEY (`pk_acknowledgments`),
  ADD KEY `message_code` (`message_code`);

--
-- Indexes for table `kbt_address_type`
--
ALTER TABLE `kbt_address_type`
  ADD PRIMARY KEY (`pk_address_type`);

--
-- Indexes for table `kbt_arrangement_type`
--
ALTER TABLE `kbt_arrangement_type`
  ADD PRIMARY KEY (`pk_arrangement_type`),
  ADD KEY `kbt_arrangement_type_pk_account_index` (`pk_account`);

--
-- Indexes for table `kbt_cities`
--
ALTER TABLE `kbt_cities`
  ADD PRIMARY KEY (`pk_cities`);

--
-- Indexes for table `kbt_color_flower`
--
ALTER TABLE `kbt_color_flower`
  ADD PRIMARY KEY (`pk_color_flower`),
  ADD KEY `kbt_color_flower_pk_account_index` (`pk_account`);

--
-- Indexes for table `kbt_comment`
--
ALTER TABLE `kbt_comment`
  ADD PRIMARY KEY (`pk_comment`),
  ADD KEY `kbt_comment_pk_account_index` (`pk_account`),
  ADD KEY `kbt_comment_pk_vendors_index` (`pk_vendors`),
  ADD KEY `kbt_comment_pk_customers_index` (`pk_customers`);

--
-- Indexes for table `kbt_country`
--
ALTER TABLE `kbt_country`
  ADD PRIMARY KEY (`pk_country`);

--
-- Indexes for table `kbt_county`
--
ALTER TABLE `kbt_county`
  ADD PRIMARY KEY (`pk_county`);

--
-- Indexes for table `kbt_coupons`
--
ALTER TABLE `kbt_coupons`
  ADD PRIMARY KEY (`pk_coupons`),
  ADD UNIQUE KEY `kbt_coupons_code_unique` (`code`),
  ADD KEY `pk_account` (`pk_account`);

--
-- Indexes for table `kbt_customers`
--
ALTER TABLE `kbt_customers`
  ADD PRIMARY KEY (`pk_customers`),
  ADD KEY `kbt_customers_pk_account_index` (`pk_account`),
  ADD KEY `kbt_customers_pk_customer_type_index` (`pk_customer_type`);

--
-- Indexes for table `kbt_customer_address`
--
ALTER TABLE `kbt_customer_address`
  ADD PRIMARY KEY (`pk_customer_address`),
  ADD KEY `pk_address_type` (`pk_address_type`),
  ADD KEY `pk_states` (`pk_states`),
  ADD KEY `pk_country` (`pk_country`);

--
-- Indexes for table `kbt_customer_contacts`
--
ALTER TABLE `kbt_customer_contacts`
  ADD PRIMARY KEY (`pk_customer_contacts`),
  ADD KEY `kbt_customer_contacts_pk_account_index` (`pk_account`),
  ADD KEY `kbt_customer_contacts_pk_customers_index` (`pk_customers`),
  ADD KEY `kbt_customer_contacts_pk_department_index` (`pk_department`),
  ADD KEY `kbt_customer_contacts_pk_states_index` (`pk_states`),
  ADD KEY `kbt_customer_contacts_pk_country_index` (`pk_country`);

--
-- Indexes for table `kbt_customer_location_types`
--
ALTER TABLE `kbt_customer_location_types`
  ADD PRIMARY KEY (`pk_customer_location_types`);

--
-- Indexes for table `kbt_customer_type`
--
ALTER TABLE `kbt_customer_type`
  ADD PRIMARY KEY (`pk_customer_type`),
  ADD KEY `kbt_customer_type_pk_account_index` (`pk_account`);

--
-- Indexes for table `kbt_delivery_charges`
--
ALTER TABLE `kbt_delivery_charges`
  ADD PRIMARY KEY (`pk_delivery_charges`),
  ADD KEY `pk_account` (`pk_account`);

--
-- Indexes for table `kbt_delivery_or_pickup`
--
ALTER TABLE `kbt_delivery_or_pickup`
  ADD PRIMARY KEY (`pk_delivery_or_pickup`);

--
-- Indexes for table `kbt_department`
--
ALTER TABLE `kbt_department`
  ADD PRIMARY KEY (`pk_department`),
  ADD KEY `kbt_department_pk_account_index` (`pk_account`);

--
-- Indexes for table `kbt_email_account`
--
ALTER TABLE `kbt_email_account`
  ADD PRIMARY KEY (`pk_email_account`),
  ADD KEY `pk_account` (`pk_account`);

--
-- Indexes for table `kbt_email_template`
--
ALTER TABLE `kbt_email_template`
  ADD PRIMARY KEY (`pk_email_template`),
  ADD KEY `pk_account` (`pk_account`),
  ADD KEY `pk_email_account` (`pk_email_account`);

--
-- Indexes for table `kbt_event`
--
ALTER TABLE `kbt_event`
  ADD PRIMARY KEY (`pk_event`),
  ADD KEY `kbt_event_pk_account_index` (`pk_account`);

--
-- Indexes for table `kbt_event_type`
--
ALTER TABLE `kbt_event_type`
  ADD PRIMARY KEY (`pk_event_type`),
  ADD KEY `kbt_event_type_pk_account_index` (`pk_account`);

--
-- Indexes for table `kbt_floral_arrangements`
--
ALTER TABLE `kbt_floral_arrangements`
  ADD PRIMARY KEY (`pk_floral_arrangements`),
  ADD KEY `pk_account` (`pk_account`),
  ADD KEY `floral_arrangements` (`title`),
  ADD KEY `pk_product_category` (`pk_product_category`),
  ADD KEY `pk_flowers` (`pk_flowers`);

--
-- Indexes for table `kbt_floral_arrangements_images`
--
ALTER TABLE `kbt_floral_arrangements_images`
  ADD PRIMARY KEY (`pk_floral_arrangements_images`),
  ADD KEY `kbt_floral_arrangements_images_pk_account_index` (`pk_account`),
  ADD KEY `kbt_floral_arrangements_images_pk_floral_arrangements_index` (`pk_floral_arrangements`);

--
-- Indexes for table `kbt_floral_arrangement_prices`
--
ALTER TABLE `kbt_floral_arrangement_prices`
  ADD PRIMARY KEY (`pk_floral_arrangement_prices`);

--
-- Indexes for table `kbt_flowers`
--
ALTER TABLE `kbt_flowers`
  ADD PRIMARY KEY (`pk_flowers`),
  ADD KEY `kbt_flowers_pk_account_index` (`pk_account`);

--
-- Indexes for table `kbt_flower_subscription`
--
ALTER TABLE `kbt_flower_subscription`
  ADD PRIMARY KEY (`pk_flower_subscription`),
  ADD KEY `kbt_flower_subscription_pk_account_index` (`pk_account`),
  ADD KEY `kbt_flower_subscription_pk_frequency_index` (`pk_frequency`),
  ADD KEY `kbt_flower_subscription_pk_uom_index` (`pk_uom`);

--
-- Indexes for table `kbt_frequency`
--
ALTER TABLE `kbt_frequency`
  ADD PRIMARY KEY (`pk_frequency`),
  ADD KEY `kbt_frequency_pk_account_index` (`pk_account`);

--
-- Indexes for table `kbt_locations`
--
ALTER TABLE `kbt_locations`
  ADD PRIMARY KEY (`pk_locations`),
  ADD KEY `kbt_locations_pk_account_index` (`pk_account`),
  ADD KEY `kbt_locations_pk_states_index` (`pk_states`),
  ADD KEY `kbt_locations_pk_country_index` (`pk_country`),
  ADD KEY `kbt_locations_pk_timezone_index` (`pk_timezone`),
  ADD KEY `kbt_locations_pk_location_types_index` (`pk_location_types`);

--
-- Indexes for table `kbt_location_times`
--
ALTER TABLE `kbt_location_times`
  ADD PRIMARY KEY (`pk_location_times`),
  ADD KEY `kbt_location_types_pk_account_index` (`pk_locations`);

--
-- Indexes for table `kbt_location_types`
--
ALTER TABLE `kbt_location_types`
  ADD PRIMARY KEY (`pk_location_types`),
  ADD KEY `kbt_location_types_pk_account_index` (`pk_account`);

--
-- Indexes for table `kbt_orders`
--
ALTER TABLE `kbt_orders`
  ADD PRIMARY KEY (`pk_orders`),
  ADD KEY `pk_account` (`pk_account`),
  ADD KEY `pk_locations` (`pk_locations`),
  ADD KEY `pk_arrangement_type` (`pk_customers`),
  ADD KEY `pk_users` (`pk_users`),
  ADD KEY `pk_transactions` (`pk_transactions`),
  ADD KEY `pk_customers` (`pk_customers`),
  ADD KEY `pk_order_status` (`pk_order_status`),
  ADD KEY `pk_location_times` (`pk_location_times`),
  ADD KEY `pk_delivery_or_pickup` (`pk_delivery_or_pickup`);

--
-- Indexes for table `kbt_order_items`
--
ALTER TABLE `kbt_order_items`
  ADD PRIMARY KEY (`pk_order_items`),
  ADD KEY `pk_shipping_address` (`pk_shipping_address`),
  ADD KEY `pk_arrangement_type` (`pk_arrangement_type`);

--
-- Indexes for table `kbt_order_status`
--
ALTER TABLE `kbt_order_status`
  ADD PRIMARY KEY (`pk_order_status`);

--
-- Indexes for table `kbt_products`
--
ALTER TABLE `kbt_products`
  ADD PRIMARY KEY (`pk_products`),
  ADD KEY `kbt_products_pk_account_index` (`pk_account`),
  ADD KEY `kbt_products_pk_product_category_index` (`pk_product_category`),
  ADD KEY `kbt_products_pk_flowers_index` (`pk_flowers`),
  ADD KEY `kbt_products_pk_color_flower_index` (`pk_color_flower`),
  ADD KEY `pk_locations` (`pk_locations`);

--
-- Indexes for table `kbt_product_category`
--
ALTER TABLE `kbt_product_category`
  ADD PRIMARY KEY (`pk_product_category`),
  ADD KEY `kbt_product_category_pk_account_index` (`pk_account`);

--
-- Indexes for table `kbt_product_images`
--
ALTER TABLE `kbt_product_images`
  ADD PRIMARY KEY (`pk_product_images`),
  ADD KEY `kbt_product_images_pk_account_index` (`pk_account`),
  ADD KEY `kbt_product_images_pk_products_index` (`pk_products`);

--
-- Indexes for table `kbt_product_sub_category`
--
ALTER TABLE `kbt_product_sub_category`
  ADD PRIMARY KEY (`pk_product_sub_category`),
  ADD KEY `kbt_product_sub_category_pk_account_index` (`pk_account`);

--
-- Indexes for table `kbt_purchase_order`
--
ALTER TABLE `kbt_purchase_order`
  ADD PRIMARY KEY (`pk_purchase_order`),
  ADD KEY `pk_vendors` (`pk_vendors`),
  ADD KEY `pk_account` (`pk_account`),
  ADD KEY `pk_users` (`pk_users`);

--
-- Indexes for table `kbt_purchase_order_items`
--
ALTER TABLE `kbt_purchase_order_items`
  ADD PRIMARY KEY (`pk_purchase_order_items`),
  ADD KEY `pk_purchase_order` (`pk_purchase_order`);

--
-- Indexes for table `kbt_roles`
--
ALTER TABLE `kbt_roles`
  ADD PRIMARY KEY (`pk_roles`);

--
-- Indexes for table `kbt_sales`
--
ALTER TABLE `kbt_sales`
  ADD PRIMARY KEY (`pk_sales`),
  ADD KEY `kbt_sales_pk_user_foreign` (`pk_users`),
  ADD KEY `kbt_sales_pk_customer_foreign` (`pk_customers`),
  ADD KEY `kbt_sales_pk_account_foreign` (`pk_account`),
  ADD KEY `kbt_sales_pk_arrangement_type_foreign` (`pk_arrangement_type`),
  ADD KEY `kbt_sales_pk_sale_type_foreign` (`pk_sales_type`),
  ADD KEY `kbt_sales_pk_location_foreign` (`pk_locations`),
  ADD KEY `kbt_sales_pk_location_time_foreign` (`pk_location_times`),
  ADD KEY `kbt_sales_pk_transaction_foreign` (`pk_transactions`),
  ADD KEY `kbt_sales_created_by_foreign` (`created_by`),
  ADD KEY `kbt_sales_updated_by_foreign` (`updated_by`),
  ADD KEY `pk_order_status` (`pk_order_status`);

--
-- Indexes for table `kbt_sales_type`
--
ALTER TABLE `kbt_sales_type`
  ADD PRIMARY KEY (`pk_sales_type`);

--
-- Indexes for table `kbt_sale_items`
--
ALTER TABLE `kbt_sale_items`
  ADD PRIMARY KEY (`pk_sale_items`),
  ADD KEY `kbt_sale_items_created_by_foreign` (`created_by`),
  ADD KEY `kbt_sale_items_updated_by_foreign` (`updated_by`),
  ADD KEY `kbt_sale_items_pk_sale_index` (`pk_sales`);

--
-- Indexes for table `kbt_shipping_address`
--
ALTER TABLE `kbt_shipping_address`
  ADD PRIMARY KEY (`pk_shipping_address`),
  ADD KEY `pk_customers` (`pk_customers`),
  ADD KEY `pk_states` (`pk_states`),
  ADD KEY `pk_country` (`pk_country`);

--
-- Indexes for table `kbt_size_arrangement`
--
ALTER TABLE `kbt_size_arrangement`
  ADD PRIMARY KEY (`pk_size_arrangement`),
  ADD KEY `kbt_size_arrangement_pk_account_index` (`pk_account`);

--
-- Indexes for table `kbt_states`
--
ALTER TABLE `kbt_states`
  ADD PRIMARY KEY (`pk_states`),
  ADD KEY `kbt_states_pk_country_index` (`pk_country`);

--
-- Indexes for table `kbt_styles`
--
ALTER TABLE `kbt_styles`
  ADD PRIMARY KEY (`pk_styles`),
  ADD KEY `kbt_styles_pk_account_index` (`pk_account`);

--
-- Indexes for table `kbt_suggested_note`
--
ALTER TABLE `kbt_suggested_note`
  ADD PRIMARY KEY (`pk_suggested_note`),
  ADD KEY `kbt_suggested_note_pk_account_index` (`pk_account`),
  ADD KEY `kbt_suggested_note_pk_event_index` (`pk_event`);

--
-- Indexes for table `kbt_text_settings`
--
ALTER TABLE `kbt_text_settings`
  ADD PRIMARY KEY (`pk_text_settings`),
  ADD KEY `PK_COMPANY` (`pk_account`);

--
-- Indexes for table `kbt_text_template`
--
ALTER TABLE `kbt_text_template`
  ADD PRIMARY KEY (`pk_text_template`),
  ADD KEY `pk_account` (`pk_account`),
  ADD KEY `pk_text_settings` (`pk_text_settings`);

--
-- Indexes for table `kbt_timezone`
--
ALTER TABLE `kbt_timezone`
  ADD PRIMARY KEY (`pk_timezone`);

--
-- Indexes for table `kbt_transactions`
--
ALTER TABLE `kbt_transactions`
  ADD PRIMARY KEY (`pk_transactions`);

--
-- Indexes for table `kbt_uom`
--
ALTER TABLE `kbt_uom`
  ADD PRIMARY KEY (`pk_uom`),
  ADD KEY `kbt_uom_pk_frequency_index` (`pk_frequency`);

--
-- Indexes for table `kbt_user_locations`
--
ALTER TABLE `kbt_user_locations`
  ADD PRIMARY KEY (`pk_user_locations`),
  ADD KEY `kbt_user_locations_pk_users_index` (`pk_users`),
  ADD KEY `kbt_user_locations_pk_locations_index` (`pk_locations`);

--
-- Indexes for table `kbt_vase_colors`
--
ALTER TABLE `kbt_vase_colors`
  ADD PRIMARY KEY (`pk_vase_colors`),
  ADD KEY `kbt_vase_colors_pk_account_index` (`pk_account`),
  ADD KEY `kbt_vase_colors_pk_vase_type_index` (`pk_vase_type`);

--
-- Indexes for table `kbt_vase_type`
--
ALTER TABLE `kbt_vase_type`
  ADD PRIMARY KEY (`pk_vase_type`),
  ADD KEY `kbt_vase_type_pk_account_index` (`pk_account`);

--
-- Indexes for table `kbt_vendors`
--
ALTER TABLE `kbt_vendors`
  ADD PRIMARY KEY (`pk_vendors`),
  ADD KEY `kbt_vendors_pk_account_index` (`pk_account`),
  ADD KEY `kbt_vendors_pk_vendor_type_index` (`pk_vendor_type`),
  ADD KEY `kbt_vendors_pk_states_index` (`pk_states`),
  ADD KEY `kbt_vendors_pk_country_index` (`pk_country`);

--
-- Indexes for table `kbt_vendor_contacts`
--
ALTER TABLE `kbt_vendor_contacts`
  ADD PRIMARY KEY (`pk_vendor_contacts`),
  ADD KEY `kbt_vendor_contacts_pk_account_index` (`pk_account`),
  ADD KEY `kbt_vendor_contacts_pk_vendors_index` (`pk_vendors`),
  ADD KEY `kbt_vendor_contacts_pk_department_index` (`pk_department`),
  ADD KEY `kbt_vendor_contacts_pk_states_index` (`pk_states`),
  ADD KEY `kbt_vendor_contacts_pk_country_index` (`pk_country`);

--
-- Indexes for table `kbt_vendor_type`
--
ALTER TABLE `kbt_vendor_type`
  ADD PRIMARY KEY (`pk_vendor_type`),
  ADD KEY `kbt_vendor_type_pk_account_index` (`pk_account`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`pk_users`),
  ADD KEY `users_pk_account_index` (`pk_account`),
  ADD KEY `users_pk_roles_index` (`pk_roles`),
  ADD KEY `pk_vendors` (`pk_vendors`),
  ADD KEY `pk_customers` (`pk_customers`),
  ADD KEY `pk_vendor_contacts` (`pk_vendor_contacts`),
  ADD KEY `pk_customer_contacts` (`pk_customer_contacts`),
  ADD KEY `pk_locations` (`pk_locations`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kbt_account`
--
ALTER TABLE `kbt_account`
  MODIFY `pk_account` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `kbt_account_admin_payment_gateways`
--
ALTER TABLE `kbt_account_admin_payment_gateways`
  MODIFY `pk_account_admin_payment_gateways` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kbt_acknowledgments`
--
ALTER TABLE `kbt_acknowledgments`
  MODIFY `pk_acknowledgments` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `kbt_address_type`
--
ALTER TABLE `kbt_address_type`
  MODIFY `pk_address_type` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kbt_arrangement_type`
--
ALTER TABLE `kbt_arrangement_type`
  MODIFY `pk_arrangement_type` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `kbt_cities`
--
ALTER TABLE `kbt_cities`
  MODIFY `pk_cities` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `kbt_color_flower`
--
ALTER TABLE `kbt_color_flower`
  MODIFY `pk_color_flower` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kbt_comment`
--
ALTER TABLE `kbt_comment`
  MODIFY `pk_comment` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `kbt_country`
--
ALTER TABLE `kbt_country`
  MODIFY `pk_country` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kbt_county`
--
ALTER TABLE `kbt_county`
  MODIFY `pk_county` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kbt_coupons`
--
ALTER TABLE `kbt_coupons`
  MODIFY `pk_coupons` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kbt_customers`
--
ALTER TABLE `kbt_customers`
  MODIFY `pk_customers` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kbt_customer_address`
--
ALTER TABLE `kbt_customer_address`
  MODIFY `pk_customer_address` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `kbt_customer_contacts`
--
ALTER TABLE `kbt_customer_contacts`
  MODIFY `pk_customer_contacts` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kbt_customer_location_types`
--
ALTER TABLE `kbt_customer_location_types`
  MODIFY `pk_customer_location_types` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kbt_customer_type`
--
ALTER TABLE `kbt_customer_type`
  MODIFY `pk_customer_type` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kbt_delivery_charges`
--
ALTER TABLE `kbt_delivery_charges`
  MODIFY `pk_delivery_charges` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kbt_delivery_or_pickup`
--
ALTER TABLE `kbt_delivery_or_pickup`
  MODIFY `pk_delivery_or_pickup` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kbt_department`
--
ALTER TABLE `kbt_department`
  MODIFY `pk_department` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kbt_email_account`
--
ALTER TABLE `kbt_email_account`
  MODIFY `pk_email_account` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kbt_email_template`
--
ALTER TABLE `kbt_email_template`
  MODIFY `pk_email_template` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kbt_event`
--
ALTER TABLE `kbt_event`
  MODIFY `pk_event` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kbt_event_type`
--
ALTER TABLE `kbt_event_type`
  MODIFY `pk_event_type` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kbt_floral_arrangements`
--
ALTER TABLE `kbt_floral_arrangements`
  MODIFY `pk_floral_arrangements` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `kbt_floral_arrangements_images`
--
ALTER TABLE `kbt_floral_arrangements_images`
  MODIFY `pk_floral_arrangements_images` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `kbt_floral_arrangement_prices`
--
ALTER TABLE `kbt_floral_arrangement_prices`
  MODIFY `pk_floral_arrangement_prices` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `kbt_flowers`
--
ALTER TABLE `kbt_flowers`
  MODIFY `pk_flowers` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kbt_flower_subscription`
--
ALTER TABLE `kbt_flower_subscription`
  MODIFY `pk_flower_subscription` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kbt_frequency`
--
ALTER TABLE `kbt_frequency`
  MODIFY `pk_frequency` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kbt_locations`
--
ALTER TABLE `kbt_locations`
  MODIFY `pk_locations` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `kbt_location_times`
--
ALTER TABLE `kbt_location_times`
  MODIFY `pk_location_times` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `kbt_location_types`
--
ALTER TABLE `kbt_location_types`
  MODIFY `pk_location_types` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kbt_orders`
--
ALTER TABLE `kbt_orders`
  MODIFY `pk_orders` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `kbt_order_items`
--
ALTER TABLE `kbt_order_items`
  MODIFY `pk_order_items` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `kbt_order_status`
--
ALTER TABLE `kbt_order_status`
  MODIFY `pk_order_status` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kbt_products`
--
ALTER TABLE `kbt_products`
  MODIFY `pk_products` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `kbt_product_category`
--
ALTER TABLE `kbt_product_category`
  MODIFY `pk_product_category` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `kbt_product_images`
--
ALTER TABLE `kbt_product_images`
  MODIFY `pk_product_images` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `kbt_product_sub_category`
--
ALTER TABLE `kbt_product_sub_category`
  MODIFY `pk_product_sub_category` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kbt_purchase_order`
--
ALTER TABLE `kbt_purchase_order`
  MODIFY `pk_purchase_order` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kbt_purchase_order_items`
--
ALTER TABLE `kbt_purchase_order_items`
  MODIFY `pk_purchase_order_items` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kbt_roles`
--
ALTER TABLE `kbt_roles`
  MODIFY `pk_roles` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kbt_sales`
--
ALTER TABLE `kbt_sales`
  MODIFY `pk_sales` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `kbt_sales_type`
--
ALTER TABLE `kbt_sales_type`
  MODIFY `pk_sales_type` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kbt_sale_items`
--
ALTER TABLE `kbt_sale_items`
  MODIFY `pk_sale_items` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `kbt_shipping_address`
--
ALTER TABLE `kbt_shipping_address`
  MODIFY `pk_shipping_address` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kbt_size_arrangement`
--
ALTER TABLE `kbt_size_arrangement`
  MODIFY `pk_size_arrangement` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kbt_states`
--
ALTER TABLE `kbt_states`
  MODIFY `pk_states` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kbt_styles`
--
ALTER TABLE `kbt_styles`
  MODIFY `pk_styles` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kbt_suggested_note`
--
ALTER TABLE `kbt_suggested_note`
  MODIFY `pk_suggested_note` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kbt_text_settings`
--
ALTER TABLE `kbt_text_settings`
  MODIFY `pk_text_settings` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kbt_text_template`
--
ALTER TABLE `kbt_text_template`
  MODIFY `pk_text_template` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kbt_timezone`
--
ALTER TABLE `kbt_timezone`
  MODIFY `pk_timezone` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `kbt_transactions`
--
ALTER TABLE `kbt_transactions`
  MODIFY `pk_transactions` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT for table `kbt_uom`
--
ALTER TABLE `kbt_uom`
  MODIFY `pk_uom` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kbt_user_locations`
--
ALTER TABLE `kbt_user_locations`
  MODIFY `pk_user_locations` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `kbt_vase_colors`
--
ALTER TABLE `kbt_vase_colors`
  MODIFY `pk_vase_colors` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kbt_vase_type`
--
ALTER TABLE `kbt_vase_type`
  MODIFY `pk_vase_type` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kbt_vendors`
--
ALTER TABLE `kbt_vendors`
  MODIFY `pk_vendors` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `kbt_vendor_contacts`
--
ALTER TABLE `kbt_vendor_contacts`
  MODIFY `pk_vendor_contacts` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `kbt_vendor_type`
--
ALTER TABLE `kbt_vendor_type`
  MODIFY `pk_vendor_type` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `pk_users` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kbt_sale_items`
--
ALTER TABLE `kbt_sale_items`
  ADD CONSTRAINT `kbt_sale_items_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`pk_users`) ON DELETE SET NULL,
  ADD CONSTRAINT `kbt_sale_items_pk_sale_foreign` FOREIGN KEY (`pk_sales`) REFERENCES `kbt_sales` (`pk_sales`) ON DELETE CASCADE,
  ADD CONSTRAINT `kbt_sale_items_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`pk_users`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
