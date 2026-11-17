-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 02, 2026 at 09:37 AM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gems_jewellery_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_activity_logs`
--

DROP TABLE IF EXISTS `admin_activity_logs`;
CREATE TABLE IF NOT EXISTS `admin_activity_logs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `actor_user_id` bigint UNSIGNED DEFAULT NULL,
  `actor_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `actor_role` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` bigint UNSIGNED DEFAULT NULL,
  `summary` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_activity_logs_module_action_index` (`module`,`action`),
  KEY `admin_activity_logs_actor_user_id_created_at_index` (`actor_user_id`,`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_activity_logs`
--

INSERT INTO `admin_activity_logs` (`id`, `actor_user_id`, `actor_name`, `actor_role`, `action`, `module`, `subject_type`, `subject_id`, `summary`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES
(1, 3, 'Admin User', 'admin', 'Permissions Updated', 'Roles & Permissions', NULL, NULL, 'Updated permissions for Content Manager role', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0', '2026-04-18 09:10:03', '2026-04-18 09:10:03'),
(2, 3, 'Admin User', 'admin', 'Permissions Updated', 'Roles & Permissions', NULL, NULL, 'Updated permissions for Content Manager role', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0', '2026-04-18 09:13:07', '2026-04-18 09:13:07'),
(3, 3, 'Admin User', 'admin', 'Permissions Updated', 'Roles & Permissions', NULL, NULL, 'Updated permissions for Content Manager role', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0', '2026-04-18 09:13:09', '2026-04-18 09:13:09'),
(4, 3, 'Admin User', 'admin', 'Permissions Updated', 'Roles & Permissions', NULL, NULL, 'Updated permissions for Content Manager role', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0', '2026-04-18 09:13:32', '2026-04-18 09:13:32'),
(5, 3, 'Admin User', 'admin', 'Permissions Updated', 'Roles & Permissions', NULL, NULL, 'Updated permissions for Content Manager role', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0', '2026-04-18 09:16:24', '2026-04-18 09:16:24'),
(6, 3, 'Admin User', 'admin', 'Role Updated', 'Roles & Permissions', 'User', 11, 'Updated role for Lower Admin to Lower Admin', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0', '2026-04-18 09:16:36', '2026-04-18 09:16:36'),
(7, 3, 'Admin User', 'admin', 'Updated', 'Lower Admins', 'User', 11, 'Updated Lower Admin: Lower Admin', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0', '2026-04-18 09:17:03', '2026-04-18 09:17:03'),
(8, 3, 'Admin User', 'admin', 'Updated', 'Content Managers', 'User', 12, 'Updated Content Manager: Content Manager', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0', '2026-04-18 09:17:08', '2026-04-18 09:17:08'),
(9, 3, 'Admin User', 'admin', 'Permissions Updated', 'Roles & Permissions', NULL, NULL, 'Updated permissions for Content Manager role', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0', '2026-04-18 09:17:56', '2026-04-18 09:17:56'),
(10, 3, 'Admin User', 'admin', 'Blocked', 'Users', 'User', 5, 'Blocked user: A B', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0', '2026-04-19 01:29:41', '2026-04-19 01:29:41'),
(11, 3, 'Admin User', 'admin', 'Unblocked', 'Users', 'User', 5, 'Unblocked user: A B', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0', '2026-04-19 01:29:41', '2026-04-19 01:29:41'),
(12, 3, 'Admin User', 'admin', 'Blocked', 'Users', 'User', 5, 'Blocked user: A B', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0', '2026-04-19 01:29:42', '2026-04-19 01:29:42'),
(13, 3, 'Admin User', 'admin', 'Unblocked', 'Users', 'User', 5, 'Unblocked user: A B', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0', '2026-04-19 01:29:43', '2026-04-19 01:29:43'),
(14, 3, 'Admin User', 'admin', 'Blocked', 'Users', 'User', 5, 'Blocked user: A B', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0', '2026-04-19 01:29:45', '2026-04-19 01:29:45'),
(15, 3, 'Admin User', 'admin', 'Unblocked', 'Users', 'User', 5, 'Unblocked user: A B', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0', '2026-04-19 01:30:16', '2026-04-19 01:30:16'),
(16, 3, 'Admin User', 'admin', 'Deleted', 'Products', 'Product', 5, 'Deleted product: Loose Diamond', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0', '2026-04-19 03:15:19', '2026-04-19 03:15:19'),
(17, 3, 'Admin User', 'admin', 'Created', 'Products', 'Product', 18, 'Created product: Emerals Cushion', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0', '2026-04-19 03:45:03', '2026-04-19 03:45:03'),
(18, 3, 'Admin User', 'admin', 'Created', 'Jewellery Types', 'Category', 10, 'Created jewellery type: Anklet', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0', '2026-04-19 04:12:32', '2026-04-19 04:12:32'),
(19, 3, 'Admin User', 'admin', 'Updated', 'Product Reviews', 'Review', 3, 'Approved review for product: Diamond Earrings', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0', '2026-04-19 04:17:38', '2026-04-19 04:17:38'),
(20, 3, 'Admin User', 'admin', 'Deleted', 'Product Reviews', 'Review', 3, 'Deleted review for product: Diamond Earrings', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0', '2026-04-19 04:19:59', '2026-04-19 04:19:59'),
(21, 3, 'Admin User', 'admin', 'Updated', 'Inventory', 'Stock', 18, 'Updated stock for Emerals Cushion from 120 to 2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0', '2026-04-19 04:37:41', '2026-04-19 04:37:41'),
(22, 3, 'Admin User', 'admin', 'Added', 'Inventory', 'Stock', 18, 'Added stock for Emerals Cushion from 2 to 18', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0', '2026-04-19 04:37:59', '2026-04-19 04:37:59'),
(23, 3, 'Admin User', 'admin', 'Updated', 'Inventory', 'Stock', 1, 'Updated stock for Gold Ring from 14 to 0', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0', '2026-04-19 04:38:09', '2026-04-19 04:38:09'),
(24, 3, 'Admin User', 'admin', 'Added', 'Inventory', 'Stock', 1, 'Added stock for Gold Ring from 0 to 20', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0', '2026-04-19 04:38:17', '2026-04-19 04:38:17'),
(25, 3, 'Admin User', 'admin', 'Updated', 'Orders', 'Order', 5, 'Updated order PG-20260419104437-3811 status from Pending to Processing', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0', '2026-04-19 09:15:44', '2026-04-19 09:15:44'),
(26, 3, 'Admin User', 'admin', 'Updated', 'Orders', 'Order', 5, 'Updated order PG-20260419104437-3811 status from Processing to Ready For Pickup', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0', '2026-04-19 09:18:05', '2026-04-19 09:18:05'),
(27, 3, 'Admin User', 'admin', 'Updated', 'Returns', 'Return Request', 1, 'Updated return RET-20260419150856-261 decision from Pending Review to Approved and refund from In Progress to In Progress', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0', '2026-04-19 10:03:26', '2026-04-19 10:03:26'),
(28, 3, 'Admin User', 'admin', 'Updated', 'Returns', 'Return Request', 1, 'Updated return RET-20260419150856-261 decision from Approved to Approved and refund from In Progress to Refunded', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0', '2026-04-19 10:03:57', '2026-04-19 10:03:57'),
(29, 3, 'Admin User', 'admin', 'Created', 'Notifications', 'Notification', NULL, 'Created notification: Christmas discounts up to 20% off', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0', '2026-04-20 02:18:12', '2026-04-20 02:18:12'),
(30, 3, 'Admin User', 'admin', 'Updated', 'Orders', 'Order', 5, 'Updated order PG-20260419104437-3811 status from Ready For Pickup to Pickup Completed', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0', '2026-04-21 01:22:22', '2026-04-21 01:22:22'),
(31, 3, 'Admin User', 'admin', 'Added', 'Inventory', 'Stock', 8, 'Added stock for Aquamarine Gemstone from 1 to 21', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0', '2026-04-21 02:20:52', '2026-04-21 02:20:52'),
(32, 3, 'Admin User', 'admin', 'Created', 'Products', 'Product', 19, 'Created product: Wedding Jewellery 3 Piece Set', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0', '2026-04-21 06:06:45', '2026-04-21 06:06:45'),
(33, 3, 'Admin User', 'admin', 'Created', 'Products', 'Product', 24, 'Created product: Gold Cufflinks', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0', '2026-04-21 06:14:32', '2026-04-21 06:14:32'),
(34, 3, 'Admin User', 'admin', 'Created', 'Products', 'Product', 25, 'Created product: Ruby Ring', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0', '2026-04-21 06:16:47', '2026-04-21 06:16:47'),
(35, 3, 'Admin User', 'admin', 'Created', 'Products', 'Product', 26, 'Created product: Rainbow Ring', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0', '2026-04-21 06:30:13', '2026-04-21 06:30:13'),
(36, 3, 'Admin User', 'admin', 'Updated', 'Jewellery Types', 'Category', 10, 'Updated jewellery type: Ankletttt', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0', '2026-04-21 08:11:30', '2026-04-21 08:11:30'),
(37, 3, 'Admin User', 'admin', 'Updated', 'Jewellery Types', 'Category', 10, 'Updated jewellery type: Anklet', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0', '2026-04-21 08:11:49', '2026-04-21 08:11:49'),
(38, 3, 'Admin guy', 'admin', 'Created', 'Products', 'Product', 29, 'Created product: Black Diamond Ring', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-04-28 06:13:56', '2026-04-28 06:13:56'),
(40, 3, 'Admin guy', 'admin', 'Updated', 'Products', 'Product', 26, 'Updated product: Rainbow Ring', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-04-29 01:05:04', '2026-04-29 01:05:04'),
(41, 3, 'Admin guy', 'admin', 'Created', 'Products', 'Product', 32, 'Created product: Garnet', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-04-29 01:06:07', '2026-04-29 01:06:07'),
(42, 3, 'Admin guy', 'admin', 'Created', 'Products', 'Product', 33, 'Created product: Onyx Ring', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-04-29 01:07:07', '2026-04-29 01:07:07'),
(43, 3, 'Admin guy', 'admin', 'Updated', 'Products', 'Product', 33, 'Merged duplicate product into existing stock: Onyx Ring', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-04-29 01:07:15', '2026-04-29 01:07:15'),
(44, 3, 'Admin guy', 'admin', 'Created', 'Products', 'Product', 34, 'Created product: Onyx Ring', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-04-29 01:11:01', '2026-04-29 01:11:01'),
(45, 3, 'Admin guy', 'admin', 'Updated', 'Products', 'Product', 34, 'Merged duplicate product into existing stock: Onyx Ring', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-04-29 01:11:09', '2026-04-29 01:11:09'),
(46, 3, 'Admin guy', 'admin', 'Created', 'Products', 'Product', 35, 'Created product: Gold Ring', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-04-29 01:28:02', '2026-04-29 01:28:02'),
(47, 3, 'Admin guy', 'admin', 'Blocked', 'Users', 'User', 7, 'Blocked user: John Smith', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-04-29 02:20:05', '2026-04-29 02:20:05'),
(48, 3, 'Admin guy', 'admin', 'Unblocked', 'Users', 'User', 7, 'Unblocked user: John Smith', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-04-29 02:23:00', '2026-04-29 02:23:00'),
(49, 3, 'Admin guy', 'admin', 'Created', 'Products', 'Product', 36, 'Created product: Luxury Emarald Set', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-04-30 02:26:04', '2026-04-30 02:26:04'),
(50, 3, 'Admin guy', 'admin', 'Created', 'Products', 'Product', 37, 'Created product: Rainbow Ring', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-04-30 02:29:41', '2026-04-30 02:29:41'),
(51, 3, 'Admin guy', 'admin', 'Updated', 'Products', 'Product', 37, 'Merged duplicate product into existing stock: Rainbow Ring', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-04-30 02:29:47', '2026-04-30 02:29:47'),
(52, 3, 'Admin guy', 'admin', 'Updated', 'Products', 'Product', 37, 'Merged duplicate product into existing stock: Rainbow Ring', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-04-30 02:29:49', '2026-04-30 02:29:49'),
(53, 3, 'Admin guy', 'admin', 'Updated', 'Products', 'Product', 37, 'Merged duplicate product into existing stock: Rainbow Ring', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-04-30 02:29:52', '2026-04-30 02:29:52'),
(54, 3, 'Admin guy', 'admin', 'Updated', 'Orders', 'Order', 9, 'Updated order PG-20260430080433-3030 status from Pending to Processing', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-04-30 02:36:09', '2026-04-30 02:36:09'),
(55, 3, 'Admin guy', 'admin', 'Created', 'Customers', 'User', 15, 'Created Customer: Sam Brown', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 00:14:13', '2026-05-01 00:14:13'),
(56, 3, 'Admin guy', 'admin', 'Created', 'Customers', 'User', 16, 'Created Customer: Sunil Fernando', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 00:18:32', '2026-05-01 00:18:32'),
(57, 3, 'Admin guy', 'admin', 'Created', 'Customers', 'User', 17, 'Created Customer: Chamara Silva', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 00:35:53', '2026-05-01 00:35:53'),
(58, 3, 'Admin guy', 'admin', 'Created', 'Customers', 'User', 18, 'Created Customer: Asanka Ekanayake', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 00:40:48', '2026-05-01 00:40:48'),
(59, 3, 'Admin guy', 'admin', 'Updated', 'Customers', 'User', 17, 'Updated Customer: Chamara Silva', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 00:42:07', '2026-05-01 00:42:07'),
(60, 3, 'Admin guy', 'admin', 'Updated', 'Customers', 'User', 18, 'Updated Customer: Asanka Ekanayake', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 00:47:31', '2026-05-01 00:47:31'),
(61, 3, 'Admin guy', 'admin', 'Deleted', 'Customers', 'User', 17, 'Deleted Customer: Chamara Silva', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 00:51:53', '2026-05-01 00:51:53'),
(62, 3, 'Admin guy', 'admin', 'Created', 'Consultants', 'User', 19, 'Created Consultant: Roshan Senanayake', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 01:00:44', '2026-05-01 01:00:44'),
(63, 3, 'Admin guy', 'admin', 'Updated', 'Consultants', 'User', 19, 'Updated Consultant: Roshan Senanayake', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 01:04:27', '2026-05-01 01:04:27'),
(64, 3, 'Admin guy', 'admin', 'Deleted', 'Consultants', 'User', 4, 'Deleted Consultant: Consultant User', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 01:07:56', '2026-05-01 01:07:56'),
(65, 3, 'Admin guy', 'admin', 'Created', 'Admin Users', 'User', 20, 'Created Content Manager: Tharushi Gunawardena', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 01:30:07', '2026-05-01 01:30:07'),
(66, 3, 'Admin guy', 'admin', 'Updated', 'Lower Admins', 'User', 20, 'Updated Lower Admin: Tharushi Gunawardena', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 02:07:22', '2026-05-01 02:07:22'),
(67, 3, 'Admin guy', 'admin', 'Updated', 'Lower Admins', 'User', 20, 'Updated Lower Admin: Tharushi Gunawardena', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 02:09:31', '2026-05-01 02:09:31'),
(68, 3, 'Admin guy', 'admin', 'Deleted', 'Lower Admins', 'User', 11, 'Deleted Lower Admin: Lower Admin', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 02:11:40', '2026-05-01 02:11:40'),
(69, 3, 'Admin guy', 'admin', 'Permissions Updated', 'Roles & Permissions', NULL, NULL, 'Updated permissions for Content Manager role', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 02:53:49', '2026-05-01 02:53:49'),
(70, 3, 'Admin guy', 'admin', 'Created', 'Admin Users', 'User', 21, 'Created Admin: Sanduni Jayasinghe', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 03:11:03', '2026-05-01 03:11:03'),
(71, 3, 'Admin guy', 'admin', 'Updated', 'Admins', 'User', 21, 'Updated Admin: Sanduni Jayasinghe', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 03:13:11', '2026-05-01 03:13:11'),
(72, 3, 'Admin guy', 'admin', 'Updated', 'Content Managers', 'User', 21, 'Updated Content Manager: Sanduni Jayasinghe', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 03:20:22', '2026-05-01 03:20:22'),
(73, 3, 'Admin guy', 'admin', 'Updated', 'Content Managers', 'User', 21, 'Updated Content Manager: Sanduni Jayasinghe', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 03:20:36', '2026-05-01 03:20:36'),
(74, 3, 'Admin guy', 'admin', 'Permissions Updated', 'Roles & Permissions', NULL, NULL, 'Updated permissions for Lower Admin role', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 03:22:21', '2026-05-01 03:22:21'),
(75, 3, 'Admin guy', 'admin', 'Permissions Updated', 'Roles & Permissions', NULL, NULL, 'Updated permissions for Lower Admin role', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 03:22:31', '2026-05-01 03:22:31'),
(76, 3, 'Admin guy', 'admin', 'Permissions Updated', 'Roles & Permissions', NULL, NULL, 'Updated permissions for Lower Admin role', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 03:25:49', '2026-05-01 03:25:49'),
(77, 3, 'Admin guy', 'admin', 'Permissions Updated', 'Roles & Permissions', NULL, NULL, 'Updated permissions for Lower Admin role', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 03:26:05', '2026-05-01 03:26:05'),
(78, 3, 'Admin guy', 'admin', 'Permissions Updated', 'Roles & Permissions', NULL, NULL, 'Updated permissions for Content Manager role', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 03:26:11', '2026-05-01 03:26:11'),
(79, 3, 'Admin guy', 'admin', 'Permissions Updated', 'Roles & Permissions', NULL, NULL, 'Updated permissions for Content Manager role', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 03:27:22', '2026-05-01 03:27:22'),
(80, 3, 'Admin guy', 'admin', 'Blocked', 'Users', 'User', 21, 'Blocked user: Sanduni Jayasinghe', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 03:35:41', '2026-05-01 03:35:41'),
(81, 3, 'Admin guy', 'admin', 'Unblocked', 'Users', 'User', 21, 'Unblocked user: Sanduni Jayasinghe', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 03:36:45', '2026-05-01 03:36:45'),
(82, 3, 'Admin guy', 'admin', 'Blocked', 'Users', 'User', 18, 'Blocked user: Asanka Ekanayake', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 03:37:13', '2026-05-01 03:37:13'),
(83, 3, 'Admin guy', 'admin', 'Unblocked', 'Users', 'User', 18, 'Unblocked user: Asanka Ekanayake', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 03:37:17', '2026-05-01 03:37:17'),
(84, 3, 'Admin guy', 'admin', 'Blocked', 'Users', 'User', 18, 'Blocked user: Asanka Ekanayake', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 03:37:18', '2026-05-01 03:37:18'),
(85, 3, 'Admin guy', 'admin', 'Unblocked', 'Users', 'User', 18, 'Unblocked user: Asanka Ekanayake', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 03:37:19', '2026-05-01 03:37:19'),
(86, 3, 'Admin guy', 'admin', 'Blocked', 'Users', 'User', 18, 'Blocked user: Asanka Ekanayake', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 03:38:21', '2026-05-01 03:38:21'),
(87, 3, 'Admin guy', 'admin', 'Blocked', 'Users', 'User', 19, 'Blocked user: Roshan Senanayake', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 03:40:18', '2026-05-01 03:40:18'),
(88, 3, 'Admin guy', 'admin', 'Unblocked', 'Users', 'User', 19, 'Unblocked user: Roshan Senanayake', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 03:40:28', '2026-05-01 03:40:28'),
(89, 3, 'Admin guy', 'admin', 'Blocked', 'Users', 'User', 19, 'Blocked user: Roshan Senanayake', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 03:40:29', '2026-05-01 03:40:29'),
(90, 3, 'Admin guy', 'admin', 'Blocked', 'Users', 'User', 21, 'Blocked user: Sanduni Jayasinghe', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 04:03:44', '2026-05-01 04:03:44'),
(91, 3, 'Admin guy', 'admin', 'Created', 'Products', 'Product', 38, 'Created product: Luxury Yellow Diamond', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 04:21:19', '2026-05-01 04:21:19'),
(92, 3, 'Admin guy', 'admin', 'Created', 'Products', 'Product', 39, 'Created product: Rippled Gold Ring', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 04:55:08', '2026-05-01 04:55:08'),
(93, 3, 'Admin guy', 'admin', 'Updated', 'Products', 'Product', 39, 'Merged duplicate product into existing stock: Rippled Gold Ring', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 04:55:12', '2026-05-01 04:55:12'),
(94, 3, 'Admin guy', 'admin', 'Created', 'Products', 'Product', 40, 'Created product: Gent\'s Casual Collection', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 05:03:06', '2026-05-01 05:03:06'),
(95, 3, 'Admin guy', 'admin', 'Updated', 'Products', 'Product', 40, 'Updated product: Gent\'s Casual Collection', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 05:04:14', '2026-05-01 05:04:14'),
(96, 3, 'Admin guy', 'admin', 'Deleted', 'Products', 'Product', 24, 'Deleted product: Gold Cufflinks', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 05:19:25', '2026-05-01 05:19:25'),
(97, 3, 'Admin guy', 'admin', 'Created', 'Jewellery Types', 'Category', 12, 'Created jewellery type: Brooch', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 05:21:59', '2026-05-01 05:21:59'),
(98, 3, 'Admin guy', 'admin', 'Updated', 'Jewellery Types', 'Category', 12, 'Updated jewellery type: Anklet', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 05:24:41', '2026-05-01 05:24:41'),
(99, 3, 'Admin guy', 'admin', 'Updated', 'Jewellery Types', 'Category', 12, 'Updated jewellery type: Brooch', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 05:25:08', '2026-05-01 05:25:08'),
(100, 3, 'Admin guy', 'admin', 'Updated', 'Jewellery Types', 'Category', 12, 'Updated jewellery type: Anklet', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 05:25:54', '2026-05-01 05:25:54'),
(101, 3, 'Admin guy', 'admin', 'Deleted', 'Jewellery Types', 'Category', 12, 'Deleted jewellery type: Anklet', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 05:27:17', '2026-05-01 05:27:17'),
(102, 3, 'Admin guy', 'admin', 'Created', 'Jewellery Types', 'Category', 13, 'Created jewellery type: Anklet', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 05:27:36', '2026-05-01 05:27:36'),
(103, 3, 'Admin guy', 'admin', 'Deleted', 'Jewellery Types', 'Category', 13, 'Deleted jewellery type: Anklet', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 05:27:40', '2026-05-01 05:27:40'),
(104, 3, 'Admin guy', 'admin', 'Deleted', 'Product Reviews', 'Review', 5, 'Deleted review for product: Diamond Earrings', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 05:31:18', '2026-05-01 05:31:18'),
(105, 3, 'Admin guy', 'admin', 'Added', 'Inventory', 'Stock', 9, 'Added stock for Diamond Gemstone from 0 to 10', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 05:47:32', '2026-05-01 05:47:32'),
(106, 3, 'Admin guy', 'admin', 'Updated', 'Orders', 'Order', 12, 'Updated order PG-20260430111428-1840 status from Pending to Processing', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 06:01:41', '2026-05-01 06:01:41'),
(107, 3, 'Admin guy', 'admin', 'Created', 'Notifications', 'Notification', NULL, 'Created notification: New Year Sale!', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 08:15:06', '2026-05-01 08:15:06'),
(108, 3, 'Admin guy', 'admin', 'Created', 'Notifications', 'Notification', NULL, 'Created notification: New Year Wishes from Pinwantha Gems & Jewellery Familiy!', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 08:18:22', '2026-05-01 08:18:22'),
(109, 3, 'Admin guy', 'admin', 'Unblocked', 'Users', 'User', 18, 'Unblocked user: Asanka Ekanayake', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-01 19:13:14', '2026-05-01 19:13:14'),
(110, 3, 'Admin guy', 'admin', 'Created', 'Products', 'Product', 41, 'Created product: Heart Necklace', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-02 03:46:40', '2026-05-02 03:46:40'),
(111, 3, 'Admin guy', 'admin', 'Updated', 'Products', 'Product', 41, 'Merged duplicate product into existing stock: Heart Necklace', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', '2026-05-02 03:46:45', '2026-05-02 03:46:45');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

DROP TABLE IF EXISTS `appointments`;
CREATE TABLE IF NOT EXISTS `appointments` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `consultant_id` bigint UNSIGNED DEFAULT NULL,
  `appointment_number` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `appointment_mode` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `appointment_topic` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preferred_date` date NOT NULL,
  `preferred_time` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Pending','Confirmed','Rejected','Completed','Cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `consultant_note` text COLLATE utf8mb4_unicode_ci,
  `approved_at` timestamp NULL DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `rejected_at` timestamp NULL DEFAULT NULL,
  `cancelled_at` timestamp NULL DEFAULT NULL,
  `reschedule_requested_at` timestamp NULL DEFAULT NULL,
  `reschedule_responded_at` timestamp NULL DEFAULT NULL,
  `reschedule_proposed_date` date DEFAULT NULL,
  `reschedule_proposed_time` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reschedule_note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `appointments_appointment_number_unique` (`appointment_number`),
  KEY `appointments_user_id_foreign` (`user_id`),
  KEY `appointments_consultant_id_foreign` (`consultant_id`),
  KEY `appointments_status_index` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `user_id`, `consultant_id`, `appointment_number`, `appointment_mode`, `appointment_topic`, `preferred_date`, `preferred_time`, `contact_number`, `customer_note`, `status`, `consultant_note`, `approved_at`, `completed_at`, `rejected_at`, `cancelled_at`, `reschedule_requested_at`, `reschedule_responded_at`, `reschedule_proposed_date`, `reschedule_proposed_time`, `reschedule_note`, `created_at`, `updated_at`) VALUES
(1, 10, NULL, 'APT-20260420080453-RXMI', 'In-store', 'Jewellery Styling', '2026-04-21', '08:00', '0776456555', 'I need help with styling jewellery for a engagement party', 'Confirmed', NULL, '2026-05-01 19:40:55', NULL, NULL, NULL, '2026-05-01 20:22:19', NULL, '2026-04-21', '08:30', NULL, '2026-04-20 02:34:53', '2026-05-01 20:22:19'),
(2, 7, NULL, 'APT-20260420102917-K9I7', 'In-store', 'Jewellery Styling', '2026-04-21', '08:30', '0775454544', 'I need to style jewellery for a wedding', 'Cancelled', NULL, '2026-04-20 05:21:12', NULL, NULL, '2026-04-20 05:21:53', NULL, '2026-04-20 05:21:53', NULL, NULL, NULL, '2026-04-20 04:59:17', '2026-04-20 05:21:53'),
(3, 18, NULL, 'APT-20260502004434-RQLV', 'In-store', 'Zodiac Recommendation', '2026-05-08', '14:00', '0765856422', 'I want to know more about gems and their zodiac connection', 'Pending', NULL, NULL, NULL, NULL, NULL, '2026-05-01 19:40:12', NULL, '2026-05-08', '13:30', NULL, '2026-05-01 19:14:34', '2026-05-01 19:40:12');

-- --------------------------------------------------------

--
-- Table structure for table `astrology`
--

DROP TABLE IF EXISTS `astrology`;
CREATE TABLE IF NOT EXISTS `astrology` (
  `astrology_id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `zodiac_id` int NOT NULL,
  PRIMARY KEY (`astrology_id`),
  KEY `idx_astrology_zodiac_id` (`zodiac_id`),
  KEY `fk_astrology_product` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `astrology`
--

INSERT INTO `astrology` (`astrology_id`, `product_id`, `zodiac_id`) VALUES
(1, 9, 1),
(2, 9, 2),
(3, 10, 2),
(4, 12, 4),
(5, 13, 5),
(6, 14, 6),
(7, 15, 7),
(8, 16, 8),
(9, 17, 9),
(10, 6, 10),
(11, 6, 11),
(12, 7, 11),
(13, 7, 12),
(14, 8, 12),
(15, 11, 3),
(16, 11, 4),
(17, 1, 1),
(18, 2, 7),
(19, 3, 10),
(20, 4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `birthstone_months`
--

DROP TABLE IF EXISTS `birthstone_months`;
CREATE TABLE IF NOT EXISTS `birthstone_months` (
  `month_id` int NOT NULL AUTO_INCREMENT,
  `month_name` varchar(20) NOT NULL,
  PRIMARY KEY (`month_id`),
  UNIQUE KEY `month_name` (`month_name`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `birthstone_months`
--

INSERT INTO `birthstone_months` (`month_id`, `month_name`) VALUES
(4, 'April'),
(8, 'August'),
(12, 'December'),
(2, 'February'),
(1, 'January'),
(7, 'July'),
(6, 'June'),
(3, 'March'),
(5, 'May'),
(11, 'November'),
(10, 'October'),
(9, 'September');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-metalpriceapi.normalized-rates', 'a:6:{s:14:\"quote_currency\";s:3:\"LKR\";s:14:\"quote_per_base\";d:319.6304618089;s:10:\"fetched_at\";i:1777679999;s:4:\"gold\";a:3:{s:6:\"symbol\";s:3:\"XAU\";s:20:\"price_per_troy_ounce\";d:4622.774654066216;s:14:\"price_per_gram\";d:47505.2871747657;}s:6:\"silver\";a:3:{s:6:\"symbol\";s:3:\"XAG\";s:20:\"price_per_troy_ounce\";d:74.35059771560763;s:14:\"price_per_gram\";d:764.05335764931;}s:8:\"platinum\";a:3:{s:6:\"symbol\";s:3:\"XPT\";s:20:\"price_per_troy_ounce\";d:1989.5726497426986;s:14:\"price_per_gram\";d:20445.56076250664;}}', 1777715103),
('laravel-cache-metalpriceapi.normalized-rates.backup', 'a:6:{s:14:\"quote_currency\";s:3:\"LKR\";s:14:\"quote_per_base\";d:319.6304618089;s:10:\"fetched_at\";i:1777679999;s:4:\"gold\";a:3:{s:6:\"symbol\";s:3:\"XAU\";s:20:\"price_per_troy_ounce\";d:4622.774654066216;s:14:\"price_per_gram\";d:47505.2871747657;}s:6:\"silver\";a:3:{s:6:\"symbol\";s:3:\"XAG\";s:20:\"price_per_troy_ounce\";d:74.35059771560763;s:14:\"price_per_gram\";d:764.05335764931;}s:8:\"platinum\";a:3:{s:6:\"symbol\";s:3:\"XPT\";s:20:\"price_per_troy_ounce\";d:1989.5726497426986;s:14:\"price_per_gram\";d:20445.56076250664;}}', 1778318103);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
CREATE TABLE IF NOT EXISTS `carts` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `carts_user_id_unique` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 10, '2026-04-17 03:02:02', '2026-04-17 03:02:02'),
(2, 7, '2026-04-17 07:49:01', '2026-04-17 07:49:01'),
(3, 18, '2026-05-01 19:48:43', '2026-05-01 19:48:43');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

DROP TABLE IF EXISTS `cart_items`;
CREATE TABLE IF NOT EXISTS `cart_items` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `cart_id` bigint UNSIGNED NOT NULL,
  `product_id` int UNSIGNED NOT NULL,
  `quantity` int UNSIGNED NOT NULL DEFAULT '1',
  `size_value` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price_at_add_time` decimal(12,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cart_items_cart_id_product_id_unique` (`cart_id`,`product_id`),
  KEY `cart_items_product_id_index` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `cart_id`, `product_id`, `quantity`, `size_value`, `price_at_add_time`, `created_at`, `updated_at`) VALUES
(9, 1, 10, 1, NULL, 20000.00, '2026-04-30 03:00:17', '2026-04-30 03:00:17'),
(38, 2, 2, 2, NULL, 6867.65, '2026-05-01 02:29:34', '2026-05-01 02:29:34'),
(39, 2, 11, 1, NULL, 8500.00, '2026-05-01 02:29:34', '2026-05-01 02:29:34'),
(41, 2, 13, 1, NULL, 7500.00, '2026-05-01 02:30:21', '2026-05-01 02:30:21'),
(42, 2, 35, 1, '8', 172883.52, '2026-05-01 04:58:47', '2026-05-01 04:58:47'),
(43, 2, 26, 1, '7', 3214.08, '2026-05-01 05:17:52', '2026-05-01 05:17:52');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`) VALUES
(1, 'Jewellery'),
(2, 'Gems'),
(3, 'Collections');

-- --------------------------------------------------------

--
-- Table structure for table `collections`
--

DROP TABLE IF EXISTS `collections`;
CREATE TABLE IF NOT EXISTS `collections` (
  `collection_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` int UNSIGNED NOT NULL,
  `occasion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gemstone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`collection_id`),
  UNIQUE KEY `collections_product_id_unique` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `collections`
--

INSERT INTO `collections` (`collection_id`, `product_id`, `occasion`, `gender`, `gemstone`, `metal`, `created_at`, `updated_at`) VALUES
(1, 19, 'Wedding', 'Female', 'Diamond', 'Gold', '2026-04-21 06:06:45', '2026-04-21 06:06:45'),
(2, 29, 'Party', 'Female', 'Diamond', 'Gold', '2026-04-28 06:13:56', '2026-04-28 06:13:56'),
(3, 36, 'Wedding', 'Women', 'Emerald', 'Gold', '2026-04-30 02:26:04', '2026-04-30 02:26:04'),
(4, 40, 'Casual', 'Men', 'None', 'Platinum', '2026-05-01 05:03:06', '2026-05-01 05:04:14');

-- --------------------------------------------------------

--
-- Table structure for table `consultation_messages`
--

DROP TABLE IF EXISTS `consultation_messages`;
CREATE TABLE IF NOT EXISTS `consultation_messages` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `consultation_request_id` bigint UNSIGNED NOT NULL,
  `sender_user_id` bigint UNSIGNED NOT NULL,
  `sender_role` enum('customer','consultant','admin') COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `consultation_messages_consultation_request_id_foreign` (`consultation_request_id`),
  KEY `consultation_messages_sender_user_id_foreign` (`sender_user_id`),
  KEY `consultation_messages_sender_role_index` (`sender_role`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `consultation_messages`
--

INSERT INTO `consultation_messages` (`id`, `consultation_request_id`, `sender_user_id`, `sender_role`, `message`, `image_path`, `read_at`, `created_at`, `updated_at`) VALUES
(1, 1, 7, 'customer', 'Hello', NULL, NULL, '2026-04-20 03:07:04', '2026-04-20 03:07:04'),
(2, 2, 7, 'customer', 'I need advice on gems', NULL, NULL, '2026-04-20 03:14:53', '2026-04-20 03:14:53'),
(3, 2, 6, 'consultant', 'Hello sir, what specific field do you need advice on?', NULL, NULL, '2026-04-20 03:16:12', '2026-04-20 03:16:12'),
(4, 2, 7, 'customer', 'Hi, I’m looking for a gemstone but not sure what to choose', NULL, NULL, '2026-04-20 03:25:11', '2026-04-20 03:25:11'),
(5, 2, 6, 'consultant', 'Sure, I can help with that. Are you looking for something based on style, budget, or maybe astrological benefits?', NULL, NULL, '2026-04-20 03:25:28', '2026-04-20 03:25:28'),
(6, 2, 7, 'customer', 'Mostly for everyday wear, but I’ve also heard gemstones can have benefits. I’m a bit curious about that too.', NULL, NULL, '2026-04-20 03:25:44', '2026-04-20 03:25:44'),
(7, 2, 6, 'consultant', 'Do you know your birth month or zodiac sign?', NULL, NULL, '2026-04-20 03:25:56', '2026-04-20 03:25:56'),
(8, 2, 7, 'customer', 'I’m a Leo', NULL, NULL, '2026-04-20 03:26:06', '2026-04-20 03:26:06'),
(9, 2, 6, 'consultant', 'Great. For Leos, ruby is a popular choice. It’s known to boost confidence and energy, and it also looks elegant for daily wear', NULL, NULL, '2026-04-20 03:26:27', '2026-04-20 03:26:27'),
(10, 2, 7, 'customer', 'I would like to explore ruby options.', NULL, NULL, '2026-04-20 03:27:01', '2026-04-20 03:27:01'),
(11, 2, 6, 'consultant', 'We have a range of options available in store for you!', NULL, NULL, '2026-04-20 03:34:43', '2026-04-20 03:34:43'),
(12, 2, 6, 'consultant', '1', 'images/Consultations/fdd28912-b822-4495-ad18-41802dce5a50.jpg', NULL, '2026-04-20 03:35:03', '2026-04-20 03:35:03'),
(13, 2, 6, 'consultant', '2', 'images/Consultations/d42c0753-e14e-4e11-a5e4-e87426916eb3.jpg', NULL, '2026-04-20 03:35:29', '2026-04-20 03:35:29'),
(14, 2, 7, 'customer', 'Awesome! I will explore my options in the shop', NULL, NULL, '2026-04-20 03:39:21', '2026-04-20 03:39:21'),
(15, 2, 6, 'consultant', 'Is there anything else I can help with?', NULL, NULL, '2026-04-20 03:39:36', '2026-04-20 03:39:36'),
(16, 2, 7, 'customer', 'No, That is all, Thank you very much', NULL, NULL, '2026-04-20 03:39:50', '2026-04-20 03:39:50'),
(17, 2, 6, 'consultant', 'You are very welcome! Have a great day', NULL, NULL, '2026-04-20 03:40:14', '2026-04-20 03:40:14'),
(18, 2, 6, 'consultant', 'Thank you for choosing Pinwantha Gems & Jewellery', NULL, NULL, '2026-04-20 03:40:36', '2026-04-20 03:40:36'),
(19, 2, 7, 'customer', 'a', NULL, NULL, '2026-04-20 04:03:23', '2026-04-20 04:03:23'),
(20, 3, 7, 'customer', 'I want a good custom ring for daily wear', NULL, NULL, '2026-05-01 06:33:26', '2026-05-01 06:33:26'),
(21, 4, 18, 'customer', 'I want gem advice on pink or purple gemstones', NULL, NULL, '2026-05-01 19:15:10', '2026-05-01 19:15:10'),
(22, 4, 19, 'consultant', 'Hello, is there any specific type of gem you are looking for??', NULL, NULL, '2026-05-01 20:23:34', '2026-05-01 20:23:34'),
(23, 4, 18, 'customer', 'Not really, just the colors', NULL, NULL, '2026-05-01 20:24:10', '2026-05-01 20:24:10'),
(24, 4, 19, 'consultant', 'I suggest amethyst or pink diamonds. You can find a suitable collection in the gem section of our website', NULL, NULL, '2026-05-01 20:25:38', '2026-05-01 20:25:38'),
(25, 4, 18, 'customer', 'Ok thank you', NULL, NULL, '2026-05-01 20:25:57', '2026-05-01 20:25:57'),
(26, 4, 19, 'consultant', 'Anything else I can help with?', NULL, NULL, '2026-05-01 20:26:05', '2026-05-01 20:26:05'),
(27, 4, 18, 'customer', 'No, thats all ty', NULL, NULL, '2026-05-01 20:26:17', '2026-05-01 20:26:17'),
(28, 4, 19, 'consultant', 'You are welcome! Thank you for choosing Pinwantha Gems & Jewellery', NULL, NULL, '2026-05-01 20:26:41', '2026-05-01 20:26:41');

-- --------------------------------------------------------

--
-- Table structure for table `consultation_requests`
--

DROP TABLE IF EXISTS `consultation_requests`;
CREATE TABLE IF NOT EXISTS `consultation_requests` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `consultant_id` bigint UNSIGNED DEFAULT NULL,
  `request_number` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `request_kind` enum('Consultation','Appointment') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Consultation',
  `request_type` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preferred_date` date DEFAULT NULL,
  `preferred_time` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `appointment_mode` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_number` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Pending','Approved','Rejected','Completed','Cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `consultant_note` text COLLATE utf8mb4_unicode_ci,
  `chat_thread_id` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `rejected_at` timestamp NULL DEFAULT NULL,
  `cancelled_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `consultation_requests_request_number_unique` (`request_number`),
  KEY `consultation_requests_user_id_foreign` (`user_id`),
  KEY `consultation_requests_consultant_id_foreign` (`consultant_id`),
  KEY `consultation_requests_request_kind_index` (`request_kind`),
  KEY `consultation_requests_status_index` (`status`),
  KEY `consultation_requests_chat_thread_id_index` (`chat_thread_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `consultation_requests`
--

INSERT INTO `consultation_requests` (`id`, `user_id`, `consultant_id`, `request_number`, `request_kind`, `request_type`, `preferred_date`, `preferred_time`, `appointment_mode`, `contact_number`, `customer_note`, `status`, `consultant_note`, `chat_thread_id`, `approved_at`, `completed_at`, `rejected_at`, `cancelled_at`, `created_at`, `updated_at`) VALUES
(2, 7, 6, 'CON-20260420084453-LPSX', 'Consultation', 'Gem Advice', NULL, NULL, NULL, NULL, 'I need advice on gems', 'Completed', 'Gem Advice needed', 'consultation-con-20260420084453-lpsx', '2026-04-20 03:15:33', '2026-04-20 04:05:48', NULL, NULL, '2026-04-20 03:14:53', '2026-04-20 04:05:48'),
(3, 7, 19, 'CON-20260501120326-RSW7', 'Consultation', 'Custom Design', NULL, NULL, NULL, NULL, 'I want a good custom ring for daily wear', 'Approved', NULL, 'consultation-con-20260501120326-rsw7', '2026-05-01 07:55:10', NULL, NULL, NULL, '2026-05-01 06:33:26', '2026-05-01 07:55:10'),
(4, 18, 19, 'CON-20260502004510-5DWY', 'Consultation', 'Gem Advice', NULL, NULL, NULL, NULL, 'I want gem advice on pink or purple gemstones', 'Completed', NULL, 'consultation-con-20260502004510-5dwy', '2026-05-01 19:17:31', '2026-05-01 20:27:09', NULL, NULL, '2026-05-01 19:15:10', '2026-05-01 20:27:09');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

DROP TABLE IF EXISTS `contact_messages`;
CREATE TABLE IF NOT EXISTS `contact_messages` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Unread','Read','Replied') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Unread',
  `source` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer-contact-form',
  `reply_message` longtext COLLATE utf8mb4_unicode_ci,
  `replied_at` timestamp NULL DEFAULT NULL,
  `replied_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contact_messages_customer_id_foreign` (`customer_id`),
  KEY `contact_messages_replied_by_foreign` (`replied_by`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `customer_id`, `name`, `email`, `date`, `subject`, `message`, `status`, `source`, `reply_message`, `replied_at`, `replied_by`, `created_at`, `updated_at`) VALUES
(1, 6, 'Test User', 'testuser@example.com', '2026-04-05', 'Test Subject', 'This is a test message.', 'Unread', 'test', NULL, NULL, NULL, '2026-04-05 04:39:10', NULL),
(2, 6, 'A A', 'a@a.com', '2026-04-05', 'AAAAA', 'AAAAAAAAAAAAAAAAAA AA A', 'Unread', 'customer-contact-form', NULL, NULL, NULL, '2026-04-05 04:43:45', '2026-04-05 04:43:45'),
(3, 6, 'A A', 'a@a.com', '2026-04-17', 'Hello', 'I need help with consultations', 'Replied', 'customer-contact-form', 'Hello, you can submit a consultation request in the Consultation section of your profile, directly accessible through the home page top right menu.', '2026-05-01 08:38:03', 3, '2026-04-05 05:19:27', '2026-05-01 08:38:03'),
(4, 7, 'John Smith', 'john123@gmail.com', '2026-04-07', 'ABCD', 'AAAAAAAAAAAAAAAAAAAAAA', 'Unread', 'customer-contact-form', NULL, NULL, NULL, '2026-04-05 23:15:44', '2026-04-05 23:15:44');

-- --------------------------------------------------------

--
-- Table structure for table `content_posts`
--

DROP TABLE IF EXISTS `content_posts`;
CREATE TABLE IF NOT EXISTS `content_posts` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `admin_id` bigint UNSIGNED NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `featured_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Admin',
  `published_at` date DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `content_posts_admin_id_foreign` (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `content_posts`
--

INSERT INTO `content_posts` (`id`, `admin_id`, `type`, `title`, `slug`, `excerpt`, `content`, `featured_image`, `category`, `author_name`, `published_at`, `is_published`, `created_at`, `updated_at`) VALUES
(3, 3, 'news', 'New Custom Design Consultation Hours', 'new-custom-design-consultation-hours', 'We have expanded our custom design consultation schedule for better support.', 'Our custom design consultation hours have been expanded to support more customers during peak demand.\r\n\r\nYou can now book weekday consultation slots for gemstone selection, engraving details, and bespoke jewellery planning.', 'images/Blog//web_blog3.jpg', 'Event Update', 'Content Team', '2026-04-18', 1, '2026-04-18 06:53:19', '2026-04-18 06:53:19'),
(5, 3, 'blog', 'Top Jewellery Trends of 2026', 'top-jewellery-trends-of-2026', 'Fashion evolves, and jewelry is no exception. From bold statement pieces to sustainable designs, explore the latest jewelry trends of 2026 and the styles you might want to retire.', 'Jewelry trends shift every year, influenced by fashion runways, social media, and changing lifestyles. In 2026, the focus is on individuality, sustainability, and bold self-expression. If you\'re looking to refresh your collection or stay ahead of the curve, here’s what’s trending—and what’s slowly fading out.\r\n\r\nWhat’s In\r\n\r\n1. Chunky Gold Jewelry\r\nBold, oversized gold pieces are dominating the scene. Thick chains, large hoops, and statement cuffs are being worn even with casual outfits, adding a touch of confidence and luxury.\r\n\r\n2. Layering and Stacking\r\nLayered necklaces and stacked rings continue to grow in popularity. Mixing different lengths, textures, and even metals creates a personalized and dynamic look.\r\n\r\n3. Sustainable and Ethical Pieces\r\nConsumers are becoming more conscious about where their jewelry comes from. Lab-grown diamonds, recycled metals, and ethically sourced gemstones are now a major trend.\r\n\r\n4. Colored Gemstones\r\nBright, vibrant stones like emeralds, sapphires, and tourmalines are replacing traditional all-diamond designs. These pieces add personality and a pop of color.\r\n\r\n5. Personalized Jewelry\r\nInitial pendants, name necklaces, and custom engravings are more popular than ever. People want jewelry that feels uniquely theirs.\r\n\r\nWhat’s Fading\r\n\r\n1. Ultra-Minimalist Pieces\r\nWhile minimalism isn’t gone, extremely subtle and barely-there jewelry is becoming less popular compared to bolder styles.\r\n\r\n2. Matching Sets\r\nPerfectly matched jewelry sets are being replaced by mix-and-match styles that feel more natural and expressive.\r\n\r\n3. Fast-Fashion Jewelry\r\nLow-quality, mass-produced jewelry is losing appeal as consumers prioritize durability and sustainability.\r\n\r\nHow to Stay Stylish Without Overspending\r\n\r\nYou don’t need to completely replace your collection to stay trendy. Start by adding one or two statement pieces and combine them with your existing jewelry. Trends are best used as inspiration—not strict rules.\r\n\r\nJewelry in 2026 is all about self-expression and conscious choices. Whether you prefer bold statement pieces or meaningful designs, the best trend to follow is the one that reflects your personality.', 'images/Blog/d0b9cbd3-ae8e-4d9c-a6c5-33b59960347f.webp', 'Jewellery Education', 'Admin', '2026-05-01', 1, '2026-05-01 08:57:50', '2026-05-01 09:03:14');

-- --------------------------------------------------------

--
-- Table structure for table `custom_jewellery_quotations`
--

DROP TABLE IF EXISTS `custom_jewellery_quotations`;
CREATE TABLE IF NOT EXISTS `custom_jewellery_quotations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `custom_jewellery_request_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `quotation_number` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quotation_amount` decimal(12,2) NOT NULL,
  `quotation_note` text COLLATE utf8mb4_unicode_ci,
  `quotation_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Sent','Accepted','Rejected','Paid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Sent',
  `sent_at` timestamp NULL DEFAULT NULL,
  `responded_at` timestamp NULL DEFAULT NULL,
  `paid_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `custom_jewellery_quotations_quotation_number_unique` (`quotation_number`),
  KEY `cjq_request_status_idx` (`custom_jewellery_request_id`,`status`),
  KEY `cjq_user_status_idx` (`user_id`,`status`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `custom_jewellery_quotations`
--

INSERT INTO `custom_jewellery_quotations` (`id`, `custom_jewellery_request_id`, `user_id`, `quotation_number`, `quotation_amount`, `quotation_note`, `quotation_image`, `status`, `sent_at`, `responded_at`, `paid_at`, `created_at`, `updated_at`) VALUES
(1, 1, 7, 'CJR-20260418061454-8TIB-Q-153557', 41000.00, NULL, NULL, 'Paid', '2026-04-19 10:05:57', '2026-04-19 10:08:15', '2026-04-19 11:10:59', '2026-04-19 10:05:57', '2026-04-19 11:10:59'),
(2, 2, 7, 'CJR-20260419171608-WCQU-Q-171658', 42000.00, NULL, NULL, 'Rejected', '2026-04-19 11:46:58', '2026-04-19 12:04:23', NULL, '2026-04-19 11:46:58', '2026-04-19 12:04:23'),
(3, 3, 7, 'CJR-20260430153229-O6HV-Q-130539', 80000.00, 'Production may take up to three weeks', 'quotation-CJR-20260430153229-O6HV-20260501130539-IiBTDm.jpg', 'Sent', '2026-05-01 07:35:39', NULL, NULL, '2026-05-01 07:35:39', '2026-05-01 07:35:39');

-- --------------------------------------------------------

--
-- Table structure for table `custom_jewellery_requests`
--

DROP TABLE IF EXISTS `custom_jewellery_requests`;
CREATE TABLE IF NOT EXISTS `custom_jewellery_requests` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `request_number` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jewellery_type_id` int UNSIGNED NOT NULL,
  `gem_product_id` int UNSIGNED NOT NULL,
  `metal` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `measurement_label` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size_value` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `engraving` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_details` json DEFAULT NULL,
  `reference_images` json DEFAULT NULL,
  `status` enum('Pending','Approved','Quoted','Rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `quotation_amount` decimal(12,2) DEFAULT NULL,
  `quotation_note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `custom_jewellery_requests_request_number_unique` (`request_number`),
  KEY `custom_jewellery_requests_user_id_foreign` (`user_id`),
  KEY `custom_jewellery_requests_jewellery_type_id_index` (`jewellery_type_id`),
  KEY `custom_jewellery_requests_gem_product_id_index` (`gem_product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `custom_jewellery_requests`
--

INSERT INTO `custom_jewellery_requests` (`id`, `user_id`, `request_number`, `jewellery_type_id`, `gem_product_id`, `metal`, `measurement_label`, `size_value`, `engraving`, `notes`, `type_details`, `reference_images`, `status`, `quotation_amount`, `quotation_note`, `created_at`, `updated_at`) VALUES
(1, 7, 'CJR-20260418061454-8TIB', 1, 11, 'Platinum', 'Ring Size', '6', 'Forever, J', 'Please include the engraving', '{\"gem_cut\": \"Cushion\", \"band_type\": \"Classic\", \"setting_style\": \"Channel\"}', '[\"images/Custom_Requests/693fc26d-24d5-4e22-a933-561b57f5c7df.png\"]', 'Quoted', 41000.00, NULL, '2026-04-18 00:44:54', '2026-04-19 11:10:59'),
(2, 7, 'CJR-20260419171608-WCQU', 2, 14, 'Yellow Gold', 'Chain Length', '14 inches', 'Love', 'Please make sure that the gemstone is prominent', '{\"chain_type\": \"Rope\", \"chain_style\": \"Adjustable\", \"pendant_type\": \"Drop\"}', '[\"images/Custom_Requests/8649b727-e0cc-4408-87d4-f4243f1cf7fa.png\"]', 'Quoted', 42000.00, NULL, '2026-04-19 11:46:08', '2026-04-19 11:46:58'),
(3, 7, 'CJR-20260430153229-O6HV', 1, 7, 'White Gold', 'Ring Size', '7', 'Forever, J', 'Please include the engraving in the inside of the band', '{\"gem_cut\": \"Oval\", \"band_type\": \"Classic\", \"setting_style\": \"Channel\"}', '[\"images/Custom_Requests/dae39a25-3a5a-4e73-aa74-d494dc6f74ab.jpg\"]', 'Quoted', 80000.00, 'Production may take up to three weeks', '2026-04-30 10:02:29', '2026-05-01 07:35:39');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faq_entries`
--

DROP TABLE IF EXISTS `faq_entries`;
CREATE TABLE IF NOT EXISTS `faq_entries` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `admin_id` bigint UNSIGNED DEFAULT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'General',
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `faq_entries_admin_id_foreign` (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faq_entries`
--

INSERT INTO `faq_entries` (`id`, `admin_id`, `question`, `answer`, `group_name`, `is_published`, `created_at`, `updated_at`) VALUES
(1, 3, 'How can I view detailed information about a product?', 'Each product has its own page where you can see images, pricing, specifications (metal, weight, gemstone details) and customer reviews. Simply click on any product from the catalogue to view full details.', 'General', 1, '2026-04-20 10:18:50', '2026-04-20 10:18:50');

-- --------------------------------------------------------

--
-- Table structure for table `gems`
--

DROP TABLE IF EXISTS `gems`;
CREATE TABLE IF NOT EXISTS `gems` (
  `product_id` int NOT NULL,
  `category_id` int DEFAULT NULL,
  `gem_type_id` int DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `shape` varchar(255) DEFAULT NULL,
  `carat_weight` decimal(5,3) DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  KEY `category_id` (`category_id`),
  KEY `gem_type_id` (`gem_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `gems`
--

INSERT INTO `gems` (`product_id`, `category_id`, `gem_type_id`, `color`, `shape`, `carat_weight`) VALUES
(6, 2, 1, 'Red', 'Round', 1.200),
(7, 2, 2, 'Purple', 'Oval', 1.500),
(8, 2, 3, 'Blue', 'Emerald ', 1.300),
(9, 2, 4, 'Clear', 'Round', 1.000),
(10, 2, 5, 'Green', 'Oval', 1.400),
(11, 2, 6, 'White', 'Round', 1.100),
(12, 2, 7, 'Red', 'Cushion', 1.250),
(13, 2, 8, 'Light Green', 'Round', 1.350),
(14, 2, 9, 'Deep Blue', 'Oval', 1.600),
(15, 2, 10, 'Multicolor', 'Oval', 1.200),
(16, 2, 11, 'Yellow', 'Round', 1.300),
(17, 2, 12, 'Blue-Green', 'Oval', 1.150),
(18, 2, 5, 'Green', 'Rose', 1.300),
(32, 2, 1, 'Red', 'Heart', 1.250),
(38, 2, 4, 'Yellow', 'Emerald', 1.250);

-- --------------------------------------------------------

--
-- Table structure for table `gemtype`
--

DROP TABLE IF EXISTS `gemtype`;
CREATE TABLE IF NOT EXISTS `gemtype` (
  `gem_type_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`gem_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `gemtype`
--

INSERT INTO `gemtype` (`gem_type_id`, `name`) VALUES
(1, 'Garnet'),
(2, 'Amethyst'),
(3, 'Aquamarine'),
(4, 'Diamond'),
(5, 'Emerald'),
(6, 'Moonstone'),
(7, 'Ruby'),
(8, 'Peridot'),
(9, 'Sapphire'),
(10, 'Opal'),
(11, 'Topaz'),
(12, 'Turquoise');

-- --------------------------------------------------------

--
-- Table structure for table `jewellery`
--

DROP TABLE IF EXISTS `jewellery`;
CREATE TABLE IF NOT EXISTS `jewellery` (
  `product_id` int NOT NULL,
  `category_id` int DEFAULT NULL,
  `type_id` int DEFAULT NULL,
  `occasion` varchar(255) DEFAULT NULL,
  `gender` enum('Male','Female','Unisex') DEFAULT NULL,
  `metal` varchar(255) DEFAULT NULL,
  `metal_purity` varchar(20) DEFAULT NULL,
  `gemstone` varchar(255) DEFAULT NULL,
  `metal_weight` decimal(5,3) DEFAULT NULL,
  `making_charge` decimal(12,2) NOT NULL DEFAULT '0.00',
  `wastage_percent` decimal(5,2) NOT NULL DEFAULT '0.00',
  `market_factor` decimal(5,3) NOT NULL DEFAULT '0.800',
  `pricing_mode` varchar(20) NOT NULL DEFAULT 'dynamic',
  PRIMARY KEY (`product_id`),
  KEY `category_id` (`category_id`),
  KEY `type_id` (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jewellery`
--

INSERT INTO `jewellery` (`product_id`, `category_id`, `type_id`, `occasion`, `gender`, `metal`, `metal_purity`, `gemstone`, `metal_weight`, `making_charge`, `wastage_percent`, `market_factor`, `pricing_mode`) VALUES
(1, 1, 1, 'Engagement', 'Unisex', 'Gold', '22K', 'Diamond', 5.500, 2500.00, 5.00, 0.800, 'dynamic'),
(2, 1, 2, 'Casual', 'Female', 'Silver', '925', 'Ruby', 10.000, 1200.00, 3.50, 0.800, 'dynamic'),
(3, 1, 3, 'Formal', 'Male', 'Platinum', '950', 'None', 7.500, 3500.00, 4.00, 0.800, 'dynamic'),
(4, 1, 4, 'Party', 'Unisex', 'Gold', '900', 'Ruby', 0.500, 3500.00, 4.00, 0.800, 'dynamic'),
(25, 1, 1, 'Party', 'Female', 'Black Gold', '950', 'Ruby', 2.000, 2000.00, 3.00, 0.800, 'dynamic'),
(26, 1, 1, 'Any', 'Unisex', 'Silver', '22k', 'Ruby, Sapphire', 4.000, 1000.00, 2.00, 0.800, 'dynamic'),
(33, 1, 1, 'Any', 'Unisex', 'Gold', '900', 'Black Diamond', 3.000, 1000.00, 0.00, 0.800, 'dynamic'),
(34, 1, 1, 'Any', 'Unisex', 'Black Gold', '900', 'Black Diamond', 3.000, 10000.00, 1.00, 0.800, 'dynamic'),
(35, 1, 1, 'Wedding', 'Male', 'Gold', '22k', 'None', 5.000, 1000.00, 0.00, 0.800, 'dynamic'),
(37, 1, 1, 'Daily Wear', 'Unisex', 'Platinum', '900', 'Ruby, Sapphire, Aquamarine, Citrine,  Amethyst, Emerald', 3.000, 1000.00, 1.00, 0.800, 'dynamic'),
(39, 1, 1, 'Wedding', 'Unisex', 'Gold', '900', 'None', 4.000, 0.00, 0.00, 0.800, 'dynamic'),
(41, 1, 1, 'Party', 'Unisex', 'Silver', '22k', 'Garnet', 4.000, 1000.00, 0.00, 0.800, 'dynamic');

-- --------------------------------------------------------

--
-- Table structure for table `jewellerytype`
--

DROP TABLE IF EXISTS `jewellerytype`;
CREATE TABLE IF NOT EXISTS `jewellerytype` (
  `type_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jewellerytype`
--

INSERT INTO `jewellerytype` (`type_id`, `name`) VALUES
(1, 'Ring'),
(2, 'Necklace'),
(3, 'Bracelet'),
(4, 'Earring'),
(5, 'Chain'),
(6, 'Bangle'),
(7, 'Pendant'),
(8, 'Other Jewellery');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_03_27_130000_add_consultant_role_to_users_table', 2),
(5, '2026_04_01_000000_add_profile_image_path_to_users_table', 3),
(6, '2026_04_01_010000_add_profile_details_to_users_table', 4),
(7, '2026_04_05_create_contact_messages_table', 5),
(8, '2026_04_13_000000_create_product_reviews_table', 6),
(9, '2026_04_14_000000_add_dynamic_pricing_columns_to_jewellery_table', 7),
(10, '2026_04_14_010000_add_market_factor_to_jewellery_table', 8),
(11, '2026_04_17_000000_create_carts_tables', 9),
(12, '2026_04_17_010000_create_orders_tables', 10),
(13, '2026_04_17_020000_create_payhere_payments_table', 10),
(14, '2026_04_17_030000_create_custom_jewellery_requests_table', 11),
(15, '2026_04_17_040000_create_wishlist_items_table', 12),
(16, '2026_04_17_050000_add_order_item_id_to_product_reviews_table', 13),
(18, '2026_04_17_060000_create_site_notifications_table', 14),
(19, '2026_04_18_000000_create_content_posts_table', 15),
(20, '2026_04_18_010000_add_admin_id_to_content_posts_table', 16),
(21, '2026_04_18_020000_alter_published_at_to_date_in_content_posts_table', 16),
(22, '2026_04_18_030000_create_consultation_requests_table', 16),
(23, '2026_04_18_040000_create_consultation_messages_table', 17),
(24, '2026_04_18_050000_create_appointments_table', 17),
(25, '2026_04_18_060000_alter_consultation_requests_for_chat_only', 17),
(26, '2026_04_18_070000_add_stock_to_products_table', 18),
(27, '2026_04_18_080000_add_permissions_to_users_table', 18),
(28, '2026_04_18_090000_update_users_role_enum_for_admin_permissions', 18),
(29, '2026_04_18_100000_add_account_status_to_users_table', 19),
(30, '2026_04_18_110000_create_admin_activity_logs_table', 20),
(31, '2026_04_19_000000_create_collections_table', 21),
(32, '2026_04_19_000100_add_pickup_payment_fields_to_orders_table', 22),
(33, '2026_04_19_010000_create_order_returns_table', 23),
(34, '2026_04_19_020000_create_custom_jewellery_quotations_table', 24),
(35, '2026_04_19_020100_add_action_fields_to_site_notifications_table', 24),
(36, '2026_04_19_021000_add_quotation_image_to_custom_jewellery_quotations_table', 25),
(37, '2026_04_19_023000_sync_custom_jewellery_request_statuses', 26),
(38, '2026_04_19_031000_remove_paid_from_custom_jewellery_request_statuses', 27),
(39, '2026_04_20_000000_add_image_path_to_site_notifications_table', 28),
(40, '2026_04_20_120000_add_image_path_to_consultation_messages_table', 29),
(41, '2026_04_20_140000_add_reschedule_fields_to_appointments_table', 30),
(42, '2026_04_20_150000_update_appointments_status_enum', 31),
(43, '2026_04_20_151000_normalize_appointments_status_values', 32),
(44, '2026_04_20_160000_create_faq_entries_table', 32),
(45, '2026_04_20_170000_add_is_published_to_content_posts_table', 33),
(46, '2026_04_20_181000_drop_sort_order_from_faq_entries_table', 34),
(47, '2026_04_20_182000_drop_sort_order_from_content_posts_table', 35),
(48, '2026_04_20_183000_add_reply_fields_to_contact_messages_table', 36),
(49, '2026_04_21_000000_create_product_views_table', 37),
(50, '2026_04_21_000000_add_gender_to_users_table', 38),
(51, '2026_04_21_000000_drop_delivery_date_from_orders_table', 38),
(52, '2026_04_28_000000_create_product_360_previews_table', 38),
(53, '2026_04_30_000000_add_town_to_orders_table', 39),
(54, '2026_04_30_010000_add_receipt_image_to_orders_table', 40),
(55, '2026_04_30_020000_create_newsletter_subscribers_table', 41),
(56, '2026_05_01_020000_add_size_fields_to_products_and_cart_items', 41);

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_subscribers`
--

DROP TABLE IF EXISTS `newsletter_subscribers`;
CREATE TABLE IF NOT EXISTS `newsletter_subscribers` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subscribed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `newsletter_subscribers`
--

INSERT INTO `newsletter_subscribers` (`id`, `email`, `subscribed_at`, `created_at`, `updated_at`) VALUES
(1, 'atnkolambage@gmail.com', '2026-04-30 23:43:01', '2026-04-30 23:43:01', '2026-04-30 23:43:01'),
(2, 'rt@email.com', '2026-05-01 13:56:20', '2026-05-01 13:56:20', '2026-05-01 13:56:20');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `order_number` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_method` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `town` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `receipt_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtotal` decimal(12,2) NOT NULL DEFAULT '0.00',
  `shipping_cost` decimal(12,2) NOT NULL DEFAULT '0.00',
  `pickup_only` tinyint(1) NOT NULL DEFAULT '0',
  `deposit_amount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `balance_due` decimal(12,2) NOT NULL DEFAULT '0.00',
  `total` decimal(12,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_order_number_unique` (`order_number`),
  KEY `orders_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_number`, `shipping_method`, `payment_method`, `status`, `first_name`, `last_name`, `email`, `phone`, `address`, `city`, `town`, `province`, `postal_code`, `notes`, `receipt_image`, `subtotal`, `shipping_cost`, `pickup_only`, `deposit_amount`, `balance_due`, `total`, `created_at`, `updated_at`) VALUES
(1, 10, 'PG-20260417094710-0117', 'express', 'card', 'Pending', 'Ryan', 'Taq', 'rt@email.com', '0772222222', '9, c, matauh', 'aaaa', NULL, 'aaaaa', '12100', NULL, NULL, 5000.00, 350.00, 0, 0.00, 0.00, 8500.00, '2026-04-17 04:17:10', '2026-04-17 04:17:10'),
(2, 10, 'PG-20260417095626-5854', 'standard', 'bank', 'Completed', 'Ryan', 'Taa', 'rt@email.com', NULL, '9, ccc, ccc', 'AAAA', NULL, 'AAA', '12100', NULL, NULL, 10000.00, 200.00, 0, 0.00, 0.00, 10000.00, '2026-04-17 04:26:26', '2026-04-17 04:26:26'),
(3, 7, 'PG-20260417160525-9346', 'standard', 'card', 'Refunded', 'John', 'Smith', 'john123@gmail.com', '0776545555', '1/2, Happy Recidencies, Nugegoda, Colomco', 'Colombo', NULL, 'Western', '00500', '[2026-04-19 15:33] Return note: Proceeded to refund', NULL, 7500.00, 200.00, 0, 0.00, 0.00, 7500.00, '2026-04-17 10:35:25', '2026-04-19 10:03:57'),
(4, 7, 'PG-20260419094620-7374', 'express', 'card', 'Completed', 'John', 'Smith', 'john123@gmail.com', '0776545223', 'No 6, Central Rd, Matugama', 'Matugama', NULL, 'Western', '12100', NULL, NULL, 18000.00, 350.00, 0, 0.00, 0.00, 21500.00, '2026-04-19 04:16:20', '2026-04-19 04:16:20'),
(5, 7, 'PG-20260419104437-3811', 'pickup', 'card', 'Pickup Completed', 'John', 'Smith', 'john123@gmail.com', '0774545455', '1/2, Sunset Dr, Nugegoda', 'Colombo', NULL, 'Western Province', '12100', '[2026-04-19 14:48] Admin note: Your order is ready for pickup now', NULL, 129887.35, 200.00, 1, 25977.47, 103909.88, 129887.35, '2026-04-19 05:14:37', '2026-04-21 01:22:22'),
(6, 7, 'PG-20260419153815-0429', 'standard', 'card', 'Pending', 'John', 'Smith', 'john123@gmail.com', NULL, '', NULL, NULL, NULL, NULL, 'Custom quotation payment for CJR-20260418061454-8TIB.', NULL, 41000.00, 200.00, 0, 0.00, 0.00, 41000.00, '2026-04-19 10:08:15', '2026-04-19 10:08:15'),
(7, 7, 'PG-20260419164059-9959', 'pickup', 'card', 'Pending', 'John', 'Smith', 'john123@gmail.com', '0774545455', '06 central road', 'Colombo', NULL, 'Western Province', '00100', NULL, NULL, 210380.17, 200.00, 1, 42076.03, 168304.14, 210380.17, '2026-04-19 11:10:59', '2026-04-19 11:10:59'),
(8, 7, 'PG-20260421151812-3842', 'pickup', 'cod', 'Pending', 'John', 'Smith', 'john123@gmail.com', '0776456455', '1/2, Sunset Dr, Nugegoda', 'Colombo', NULL, 'Western Province', '12100', NULL, NULL, 7000.00, 0.00, 0, 7000.00, 0.00, 7000.00, '2026-04-21 09:48:12', '2026-04-21 09:48:12'),
(9, 10, 'PG-20260430080433-3030', 'pickup', 'card', 'Processing', 'Ryan', 'Kolambage', 'rt@email.com', '0776456510', '06 central road', 'Matugama', NULL, 'Western Province', '12100', NULL, NULL, 44678.71, 0.00, 1, 8935.74, 35742.97, 44678.71, '2026-04-30 02:34:33', '2026-04-30 02:36:09'),
(10, 7, 'PG-20260430110422-3864', 'standard', 'bank', 'Completed', 'John', 'Smith', 'john123@gmail.com', '0776457588', '06 central road', 'Colombo', 'Matugama', 'Western Province', '12100', NULL, 'images/Receipt/receipt_20260430110422_69f33736d0701.png', 21215.90, 200.00, 0, 21415.90, 0.00, 21415.90, '2026-04-30 05:34:22', '2026-04-30 05:34:22'),
(11, 7, 'PG-20260430111220-7179', 'pickup', 'card', 'Completed', 'John', 'Smith', 'john123@gmail.com', '0776457588', '06 central road', 'Colombo', 'Nugegodaa', 'Western Province', '12222', NULL, NULL, 260000.00, 0.00, 1, 52000.00, 208000.00, 260000.00, '2026-04-30 05:42:20', '2026-04-30 05:42:20'),
(12, 7, 'PG-20260430111428-1840', 'pickup', 'bank', 'Completed', 'John', 'Smith', 'john123@gmail.com', '0734567890', '06 central road', 'Colombo', 'Nugegoda', 'Western Province', '12100', '[2026-05-01 11:31] Admin note: Your order is now being processed', 'images/Receipt/receipt_20260430111428_69f33994cec56.png', 260000.00, 0.00, 1, 52000.00, 208000.00, 260000.00, '2026-04-30 05:44:28', '2026-05-01 06:01:41');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` int UNSIGNED NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int UNSIGNED NOT NULL DEFAULT '1',
  `unit_price` decimal(12,2) NOT NULL,
  `line_total` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  KEY `order_items_product_id_index` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `product_image`, `quantity`, `unit_price`, `line_total`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'Silver Necklace', 'silver_necklace.jpg', 1, 5000.00, 5000.00, '2026-04-17 04:17:10', '2026-04-17 04:17:10'),
(2, 2, 2, 'Silver Necklace', 'silver_necklace.jpg', 2, 5000.00, 10000.00, '2026-04-17 04:26:26', '2026-04-17 04:26:26'),
(3, 3, 1, 'Gold Ring', 'gold_ring.jpg', 1, 7500.00, 7500.00, '2026-04-17 10:35:25', '2026-04-17 10:35:25'),
(4, 4, 4, 'Diamond Earrings', 'diamond_earrings.jpg', 1, 18000.00, 18000.00, '2026-04-19 04:16:20', '2026-04-19 04:16:20'),
(5, 5, 3, 'Platinum Bracelet', 'platinum_bracelet.jpg', 1, 129887.35, 129887.35, '2026-04-19 05:14:37', '2026-04-19 05:14:37'),
(6, 6, 0, 'Custom Jewellery - CJR-20260418061454-8TIB', 'moonstone.jpg', 1, 41000.00, 41000.00, '2026-04-19 10:08:15', '2026-04-19 10:08:15'),
(7, 7, 1, 'Gold Ring', 'gold_ring.jpg', 1, 210380.17, 210380.17, '2026-04-19 11:10:59', '2026-04-19 11:10:59'),
(8, 8, 7, 'Amethyst Gemstone', 'amethyst.jpg', 1, 7000.00, 7000.00, '2026-04-21 09:48:12', '2026-04-21 09:48:12'),
(9, 9, 37, 'Rainbow Ring', '04af4788-e523-46bc-b058-499309b875d7.png', 1, 44678.71, 44678.71, '2026-04-30 02:34:33', '2026-04-30 02:34:33'),
(10, 10, 4, 'Diamond Earrings', 'diamond_earrings.jpg', 1, 21215.90, 21215.90, '2026-04-30 05:34:22', '2026-04-30 05:34:22'),
(11, 11, 36, 'Luxury Emarald Set', '00ce2fa9-b11e-4036-81bc-56976c77fb44.jpg', 2, 130000.00, 260000.00, '2026-04-30 05:42:20', '2026-04-30 05:42:20'),
(12, 12, 36, 'Luxury Emarald Set', '00ce2fa9-b11e-4036-81bc-56976c77fb44.jpg', 2, 130000.00, 260000.00, '2026-04-30 05:44:28', '2026-04-30 05:44:28');

-- --------------------------------------------------------

--
-- Table structure for table `order_returns`
--

DROP TABLE IF EXISTS `order_returns`;
CREATE TABLE IF NOT EXISTS `order_returns` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `request_number` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `decision` enum('Pending Review','Approved','Rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending Review',
  `refund_status` enum('In Progress','Refunded') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'In Progress',
  `refund_amount` decimal(12,2) DEFAULT NULL,
  `admin_note` text COLLATE utf8mb4_unicode_ci,
  `reviewed_by_user_id` bigint UNSIGNED DEFAULT NULL,
  `reviewed_at` timestamp NULL DEFAULT NULL,
  `refunded_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_returns_request_number_unique` (`request_number`),
  KEY `order_returns_order_id_foreign` (`order_id`),
  KEY `order_returns_user_id_foreign` (`user_id`),
  KEY `order_returns_reviewed_by_user_id_foreign` (`reviewed_by_user_id`),
  KEY `order_returns_decision_refund_status_created_at_index` (`decision`,`refund_status`,`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_returns`
--

INSERT INTO `order_returns` (`id`, `order_id`, `user_id`, `request_number`, `reason`, `decision`, `refund_status`, `refund_amount`, `admin_note`, `reviewed_by_user_id`, `reviewed_at`, `refunded_at`, `created_at`, `updated_at`) VALUES
(1, 3, 7, 'RET-20260419150856-261', 'Too small', 'Approved', 'Refunded', 7500.00, 'Proceeded to refund', 3, '2026-04-19 10:03:57', '2026-04-19 10:03:57', '2026-04-19 09:38:56', '2026-04-19 10:03:57');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payhere_payments`
--

DROP TABLE IF EXISTS `payhere_payments`;
CREATE TABLE IF NOT EXISTS `payhere_payments` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `order_token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `currency` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'LKR',
  `amount` decimal(12,2) NOT NULL,
  `shipping_cost` decimal(12,2) NOT NULL DEFAULT '0.00',
  `shipping_method` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `checkout_payload` json NOT NULL,
  `cart_payload` json NOT NULL,
  `order_id` bigint UNSIGNED DEFAULT NULL,
  `payhere_payment_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gateway_payload` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `payhere_payments_order_token_unique` (`order_token`),
  KEY `payhere_payments_order_id_foreign` (`order_id`),
  KEY `payhere_payments_user_id_status_index` (`user_id`,`status`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payhere_payments`
--

INSERT INTO `payhere_payments` (`id`, `user_id`, `order_token`, `status`, `currency`, `amount`, `shipping_cost`, `shipping_method`, `payment_method`, `checkout_payload`, `cart_payload`, `order_id`, `payhere_payment_id`, `status_code`, `gateway_payload`, `created_at`, `updated_at`) VALUES
(1, 10, 'PH-20260417085820-N8VYB4RTPRHSEAQV', 'pending', 'LKR', 5000.00, 0.00, 'free', 'card', '{\"city\": \"Matugama\", \"email\": \"rt@email.com\", \"notes\": null, \"phone\": \"0776456510\", \"total\": 5000, \"address\": \"no 6, central rd matugama\", \"province\": \"Western\", \"subtotal\": 5000, \"last_name\": \"Ta\", \"first_name\": \"Ryan\", \"postal_code\": \"12100\", \"delivery_date\": \"2026-04-23\", \"shipping_cost\": 0, \"payment_method\": \"card\", \"shipping_method\": \"free\"}', '[{\"id\": \"2\", \"name\": \"Silver Necklace\", \"image\": \"http://127.0.0.1:8000/images/silver_necklace.jpg\", \"price\": \"5000.00\", \"quantity\": 1, \"targetUrl\": \"http://127.0.0.1:8000/products/2\", \"product_id\": 2, \"description\": \"Elegant silver necklace.\"}]', NULL, NULL, NULL, NULL, '2026-04-17 03:28:20', '2026-04-17 03:28:20'),
(2, 10, 'PH-20260417091031-AU5QFGFMVJSKTFJK', 'pending', 'LKR', 8500.00, 3500.00, 'express', 'card', '{\"city\": \"Colombo\", \"email\": \"rt@email.com\", \"notes\": null, \"phone\": \"0776545555\", \"total\": 8500, \"address\": \"6, cental road, colo0mbo\", \"province\": \"Western\", \"subtotal\": 5000, \"last_name\": \"Ta\", \"first_name\": \"Ryan\", \"postal_code\": \"12100\", \"delivery_date\": \"2026-04-23\", \"shipping_cost\": 3500, \"payment_method\": \"card\", \"shipping_method\": \"express\"}', '[{\"id\": \"2\", \"name\": \"Silver Necklace\", \"image\": \"http://127.0.0.1:8000/images/silver_necklace.jpg\", \"price\": \"5000.00\", \"quantity\": 1, \"targetUrl\": \"http://127.0.0.1:8000/products/2\", \"product_id\": 2, \"description\": \"Elegant silver necklace.\"}]', NULL, NULL, NULL, NULL, '2026-04-17 03:40:31', '2026-04-17 03:40:31'),
(3, 10, 'PH-20260417094229-YCCIB05XRQZ5GT6B', 'pending', 'LKR', 5000.00, 0.00, 'free', 'card', '{\"city\": \"aaaa\", \"email\": \"rt@email.com\", \"notes\": null, \"phone\": \"0772222222\", \"total\": 5000, \"address\": \"9, c, matauh\", \"province\": \"aaaaa\", \"subtotal\": 5000, \"last_name\": \"Taq\", \"first_name\": \"Ryan\", \"postal_code\": \"12100\", \"delivery_date\": \"2026-04-30\", \"shipping_cost\": 0, \"payment_method\": \"card\", \"shipping_method\": \"free\"}', '[{\"id\": \"2\", \"name\": \"Silver Necklace\", \"image\": \"http://127.0.0.1:8000/images/silver_necklace.jpg\", \"price\": \"5000.00\", \"quantity\": 1, \"targetUrl\": \"http://127.0.0.1:8000/products/2\", \"product_id\": 2, \"description\": \"Elegant silver necklace.\"}]', NULL, NULL, NULL, NULL, '2026-04-17 04:12:29', '2026-04-17 04:12:29');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `category_id` int DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `stock` int UNSIGNED NOT NULL DEFAULT '0',
  `size_label` varchar(100) DEFAULT NULL,
  `size_options` text,
  PRIMARY KEY (`product_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `category_id`, `name`, `description`, `image`, `price`, `stock`, `size_label`, `size_options`) VALUES
(1, 1, 'Gold Ring', 'A beautiful gold ring with diamond.', 'gold_ring.jpg', 7500.00, 20, 'Ring Size', '6,7,8,9,10,11'),
(2, 1, 'Silver Necklace', 'Elegant silver necklace.', 'silver_necklace.jpg', 5000.00, 199, NULL, NULL),
(3, 1, 'Platinum Bracelet', 'Stylish platinum bracelet.', 'platinum_bracelet.jpg', 12000.00, 78, NULL, NULL),
(4, 1, 'Diamond Earrings', 'Sparkling diamond earrings suitable for any occasion.', 'diamond_earrings.jpg', 18000.00, 14, NULL, NULL),
(6, 2, 'Garnet Gemstone', 'January birthstone', 'garnet.jpg', 8000.00, 100, NULL, NULL),
(7, 2, 'Amethyst Gemstone', 'February birthstone', 'amethyst.jpg', 7000.00, 100, NULL, NULL),
(8, 2, 'Aquamarine Gemstone', 'March birthstone', 'aquamarine.jpg', 9000.00, 21, NULL, NULL),
(9, 2, 'Diamond Gemstone', 'April birthstone', 'diamond.jpg', 25000.00, 10, NULL, NULL),
(10, 2, 'Emerald Gemstone', 'May birthstone', 'emerald.jpg', 20000.00, 100, NULL, NULL),
(11, 2, 'Moonstone Gemstone', 'June birthstone', 'moonstone.jpg', 8500.00, 100, NULL, NULL),
(12, 2, 'Ruby Gemstone', 'July birthstone', 'ruby.jpg', 22000.00, 100, NULL, NULL),
(13, 2, 'Peridot Gemstone', 'August birthstone', 'peridot.jpg', 7500.00, 100, NULL, NULL),
(14, 2, 'Sapphire Gemstone', 'September birthstone', 'sapphire.jpg', 23000.00, 100, NULL, NULL),
(15, 2, 'Opal Gemstone', 'October birthstone', 'opal.jpg', 9500.00, 100, NULL, NULL),
(16, 2, 'Topaz Gemstone', 'November birthstone', 'topaz.png', 8800.00, 100, NULL, NULL),
(17, 2, 'Turquoise Gemstone', 'December birthstone', 'turquoise.jpg', 8200.00, 100, NULL, NULL),
(18, 2, 'Emerald ', 'A rose cut emerald', 'rosem.jpg', 50000.00, 18, NULL, NULL),
(19, 3, 'Wedding Jewellery 3 Piece Set', 'Elegant necklace, earrings and bracelet set for your wedding day', '87c42943-1098-42f2-a88e-f00a1cd8aa00.jpg', 105000.00, 5, NULL, NULL),
(20, 1, 'Gold Cufflinks', 'Men\'s cuff links with a swirl pattern.', '5a7c520a-8bd9-43db-8034-522abb6c9913.jpg', 5000.00, 20, NULL, NULL),
(21, 1, 'Gold Cufflinks', 'Men\'s cuff links with a swirl pattern.', 'c0dcad3f-7443-4573-82f2-54bf64209399.jpg', 5000.00, 20, NULL, NULL),
(22, 1, 'Gold Cufflinks', 'Men\'s cuff links with a swirl pattern.', '478e1d39-2913-49c7-a72f-62f3da155ed2.jpg', 5000.00, 20, NULL, NULL),
(23, 1, 'Gold Cufflinks', 'Men\'s cuff links with a swirl pattern.', 'c3e3d815-e8bf-4f12-b3bb-3015c2804fa8.jpg', 5000.00, 20, NULL, NULL),
(25, 1, 'Ruby Ring', 'Elegant ring with a ruby gemstone', '1df026e6-1315-4869-879e-6cd3d50b57e9.png', 22000.00, 20, 'Ring Size', '5,6,7,8,9,10,11'),
(26, 1, 'Red and Blue Ring', 'Ring with rainbow coloured gemstones WWW', 'rainbow.jpg', 30000.00, 20, 'Ring Size', '5,6,7,8,9,10,11'),
(32, 2, 'Garnet', 'Oval red garnet', '8e8e95d4-e225-49fa-9784-6a03af427d9d.jpg', 50000.00, 20, NULL, NULL),
(33, 1, 'Onyx Ring', 'Black diamond ring fit for any occasion', '0df04795-619e-4cc8-84cc-8cb32d53ab35.png', 50000.00, 40, 'Ring Size', '6,7,8,9,10,11'),
(35, 1, 'Gold Wedding Ring', 'Gent\'s wedding ring made from solid gold.', 'e2da0097-f5e9-4790-8f2e-f6ce0a0de331.jpg', 120000.00, 20, 'Ring Size', '8, 9, 10, 11'),
(36, 3, 'Luxury Emarald Set', 'Luxury emerald jewellery set with a stunning emerald necklace and matching earrings.', '00ce2fa9-b11e-4036-81bc-56976c77fb44.jpg', 130000.00, 0, NULL, NULL),
(37, 1, 'Rainbow Ring', 'Beautiful ring with rainbow coloured gemstones', '04af4788-e523-46bc-b058-499309b875d7.png', 130000.00, 40, 'Ring Size', '6, 7, 8, 9'),
(38, 2, 'Luxury Yellow Diamond', 'An elegant luxury yellow diamond. Often called \"canary diamonds,\" these are valued for their brilliance and rarity.', '7e5039a7-27c6-416c-b94e-4f9284c0ccec.png', 105000.00, 47, NULL, NULL),
(39, 1, 'Rippled Gold Ring', 'A stylish and modern gold wedding ring with rippled edges.', '8cb3ddf4-0efd-4c87-bece-33718274374b.png', 105000.00, 94, 'Ring Size', '5,6,7'),
(40, 3, 'Gent\'s Casual Collection', 'A stylish collection of modern men\'s jewellery', '62680dc6-d368-415f-b924-1f86ff67665d.jpg', 50000.00, 8, NULL, NULL),
(41, 1, 'Heart Necklace', 'Heart shaped locket necklace with red garnet gems', 'fcd1d79b-360e-4e9e-8fdf-bd3dd24d5be6.png', 50000.00, 10, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_360_previews`
--

DROP TABLE IF EXISTS `product_360_previews`;
CREATE TABLE IF NOT EXISTS `product_360_previews` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` int UNSIGNED NOT NULL,
  `folder_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `frame_count` tinyint UNSIGNED NOT NULL DEFAULT '8',
  `frame_files` json NOT NULL,
  `uploaded_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_360_previews_product_id_unique` (`product_id`),
  KEY `product_360_previews_uploaded_by_foreign` (`uploaded_by`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_360_previews`
--

INSERT INTO `product_360_previews` (`id`, `product_id`, `folder_path`, `frame_count`, `frame_files`, `uploaded_by`, `created_at`, `updated_at`) VALUES
(1, 25, 'images/Preview/Ring_Red', 8, '[\"0001.png\", \"0002.png\", \"0003.png\", \"0004.png\", \"0005.png\", \"0006.png\", \"0007.png\", \"0008.png\"]', 2, '2026-04-28 10:04:01', '2026-04-28 10:04:01'),
(3, 33, 'images/Preview/product-33', 8, '[\"01.webp\", \"02.webp\", \"03.webp\", \"04.webp\", \"05.webp\", \"06.webp\", \"07.webp\", \"08.webp\"]', 3, '2026-04-29 01:07:15', '2026-04-29 01:07:15'),
(5, 34, 'images/Preview/product-34', 8, '[\"01.webp\", \"02.webp\", \"03.webp\", \"04.webp\", \"05.webp\", \"06.webp\", \"07.webp\", \"08.webp\"]', 3, '2026-04-29 01:11:09', '2026-04-29 01:11:09'),
(6, 35, 'images/Preview/gold-ring-35', 8, '[\"01.webp\", \"02.webp\", \"03.webp\", \"04.webp\", \"05.webp\", \"06.webp\", \"07.webp\", \"08.webp\"]', 3, '2026-04-29 01:28:02', '2026-04-29 01:28:02'),
(10, 37, 'images/Preview/rainbow-ring-37', 8, '[\"01.webp\", \"02.webp\", \"03.webp\", \"04.webp\", \"05.webp\", \"06.webp\", \"07.webp\", \"08.webp\"]', 3, '2026-04-30 02:29:52', '2026-04-30 02:29:52'),
(12, 39, 'images/Preview/rippled-gold-ring-39', 8, '[\"01.webp\", \"02.webp\", \"03.webp\", \"04.webp\", \"05.webp\", \"06.webp\", \"07.webp\", \"08.webp\"]', 3, '2026-05-01 04:55:12', '2026-05-01 04:55:12'),
(14, 41, 'images/Preview/heart-necklace-41', 8, '[\"01.webp\", \"02.webp\", \"03.webp\", \"04.webp\", \"05.webp\", \"06.webp\", \"07.webp\", \"08.webp\"]', 3, '2026-05-02 03:46:45', '2026-05-02 03:46:45');

-- --------------------------------------------------------

--
-- Table structure for table `product_birthstones`
--

DROP TABLE IF EXISTS `product_birthstones`;
CREATE TABLE IF NOT EXISTS `product_birthstones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `month_id` int NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_birthstones`
--

INSERT INTO `product_birthstones` (`id`, `product_id`, `month_id`, `description`) VALUES
(1, 6, 1, 'Garnet symbolizes protection and strength.'),
(2, 7, 2, 'Amethyst represents calmness and clarity.'),
(3, 8, 3, 'Aquamarine symbolizes peace and courage.'),
(4, 9, 4, 'Diamond represents purity and strength.'),
(5, 10, 5, 'Emerald symbolizes love and rebirth.'),
(6, 11, 6, 'Moonstone represents intuition and balance.'),
(7, 12, 7, 'Ruby symbolizes passion and vitality.'),
(8, 13, 8, 'Peridot represents healing and positivity.'),
(9, 14, 9, 'Sapphire symbolizes wisdom and royalty.'),
(10, 15, 10, 'Opal represents creativity and hope.'),
(11, 16, 11, 'Topaz symbolizes strength and protection.'),
(12, 17, 12, 'Turquoise represents luck and balance.');

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

DROP TABLE IF EXISTS `product_reviews`;
CREATE TABLE IF NOT EXISTS `product_reviews` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `order_item_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` tinyint UNSIGNED NOT NULL,
  `review` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'approved',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_reviews_order_item_id_unique` (`order_item_id`),
  KEY `product_reviews_product_id_index` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_reviews`
--

INSERT INTO `product_reviews` (`id`, `product_id`, `user_id`, `order_item_id`, `name`, `email`, `rating`, `review`, `status`, `created_at`, `updated_at`) VALUES
(4, 3, 7, 5, 'John', 'john123@gmail.com', 5, 'The bracelet its beautiful and very unique. It is nice and chunky and well-made. I love it. I want another one in gold! Thank you again.', 'approved', '2026-04-30 23:36:14', '2026-04-30 23:36:14'),
(6, 36, 7, 12, 'John', 'john123@gmail.com', 4, 'Great set with high quality emeralds. Will buy again.', 'approved', '2026-05-01 14:04:05', '2026-05-01 14:04:05'),
(7, 4, 7, 10, 'John', 'john123@gmail.com', 5, 'The earrings are very elegant and classy. Very high quality and worth it for the price.', 'approved', '2026-05-01 14:04:51', '2026-05-01 14:04:51');

-- --------------------------------------------------------

--
-- Table structure for table `product_views`
--

DROP TABLE IF EXISTS `product_views`;
CREATE TABLE IF NOT EXISTS `product_views` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` int UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `session_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `viewed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_views_user_id_foreign` (`user_id`),
  KEY `product_views_product_id_index` (`product_id`),
  KEY `product_views_session_id_index` (`session_id`),
  KEY `product_views_viewed_at_index` (`viewed_at`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_views`
--

INSERT INTO `product_views` (`id`, `product_id`, `user_id`, `session_id`, `viewed_at`, `created_at`, `updated_at`) VALUES
(1, 9, 7, 'X1HAH9NXCe1otSeo8OCf5PuDf07ugWIbn3cvz6zE', '2026-04-21 02:16:29', '2026-04-21 02:16:29', '2026-04-21 02:16:29'),
(2, 3, 7, 'X1HAH9NXCe1otSeo8OCf5PuDf07ugWIbn3cvz6zE', '2026-04-21 02:30:06', '2026-04-21 02:30:06', '2026-04-21 02:30:06'),
(3, 3, 7, '2b56XvUG0D7PLFPyxHh0TtBwcO4d3x5YvNOtklZx', '2026-04-21 03:30:57', '2026-04-21 03:30:57', '2026-04-21 03:30:57'),
(4, 1, NULL, 'kxGHKuCjQNSDJRvtEjjEt0PVlRUxT4DwzgmjFP5Z', '2026-04-21 04:33:21', '2026-04-21 04:33:21', '2026-04-21 04:33:21'),
(5, 7, 7, '2b56XvUG0D7PLFPyxHh0TtBwcO4d3x5YvNOtklZx', '2026-04-21 04:36:49', '2026-04-21 04:36:49', '2026-04-21 04:36:49'),
(6, 7, NULL, 'kxGHKuCjQNSDJRvtEjjEt0PVlRUxT4DwzgmjFP5Z', '2026-04-21 04:46:09', '2026-04-21 04:46:09', '2026-04-21 04:46:09'),
(7, 2, NULL, 'kxGHKuCjQNSDJRvtEjjEt0PVlRUxT4DwzgmjFP5Z', '2026-04-21 04:56:04', '2026-04-21 04:56:04', '2026-04-21 04:56:04'),
(8, 25, 3, 'O5Ba9oEsyyWd0JZ0TvfAtKLdMWB01ESORbW5yknE', '2026-04-21 06:18:54', '2026-04-21 06:18:54', '2026-04-21 06:18:54'),
(9, 24, 3, 'O5Ba9oEsyyWd0JZ0TvfAtKLdMWB01ESORbW5yknE', '2026-04-21 06:26:14', '2026-04-21 06:26:14', '2026-04-21 06:26:14'),
(10, 1, 3, 'O5Ba9oEsyyWd0JZ0TvfAtKLdMWB01ESORbW5yknE', '2026-04-21 06:33:22', '2026-04-21 06:33:22', '2026-04-21 06:33:22'),
(11, 19, 3, 'O5Ba9oEsyyWd0JZ0TvfAtKLdMWB01ESORbW5yknE', '2026-04-21 06:34:38', '2026-04-21 06:34:38', '2026-04-21 06:34:38'),
(12, 4, 3, 'O5Ba9oEsyyWd0JZ0TvfAtKLdMWB01ESORbW5yknE', '2026-04-21 06:39:31', '2026-04-21 06:39:31', '2026-04-21 06:39:31'),
(13, 3, 3, 'O5Ba9oEsyyWd0JZ0TvfAtKLdMWB01ESORbW5yknE', '2026-04-21 06:45:06', '2026-04-21 06:45:06', '2026-04-21 06:45:06'),
(14, 26, 3, 'O5Ba9oEsyyWd0JZ0TvfAtKLdMWB01ESORbW5yknE', '2026-04-21 07:54:08', '2026-04-21 07:54:08', '2026-04-21 07:54:08'),
(15, 10, 7, 'aH9mn1hAudt4fbiu0k1EvJgLoCK7WdGRFA22t2en', '2026-04-21 09:34:21', '2026-04-21 09:34:21', '2026-04-21 09:34:21'),
(16, 24, 7, 'aH9mn1hAudt4fbiu0k1EvJgLoCK7WdGRFA22t2en', '2026-04-21 09:35:26', '2026-04-21 09:35:26', '2026-04-21 09:35:26'),
(17, 7, 7, 'aH9mn1hAudt4fbiu0k1EvJgLoCK7WdGRFA22t2en', '2026-04-21 09:46:50', '2026-04-21 09:46:50', '2026-04-21 09:46:50'),
(18, 9, 7, 'aH9mn1hAudt4fbiu0k1EvJgLoCK7WdGRFA22t2en', '2026-04-21 10:24:00', '2026-04-21 10:24:00', '2026-04-21 10:24:00'),
(19, 3, 7, 'PnsoeMrBvxe4SFzJz9LX7Bo0E30yBUdFrUJ0NPgg', '2026-04-28 04:18:22', '2026-04-28 04:18:22', '2026-04-28 04:18:22'),
(20, 25, 7, 'PnsoeMrBvxe4SFzJz9LX7Bo0E30yBUdFrUJ0NPgg', '2026-04-28 04:18:27', '2026-04-28 04:18:27', '2026-04-28 04:18:27'),
(21, 1, 7, 'PnsoeMrBvxe4SFzJz9LX7Bo0E30yBUdFrUJ0NPgg', '2026-04-28 04:29:43', '2026-04-28 04:29:43', '2026-04-28 04:29:43'),
(22, 25, 7, 'ki6Gxr5silI9NQcG0L9o8E1I7Z9CR4MNPoQdhY6w', '2026-04-28 05:19:18', '2026-04-28 05:19:18', '2026-04-28 05:19:18'),
(23, 3, 3, 'cQrYAXArHc3MXSZEUSmwaT5GNaWN6WBo9VOjDJV6', '2026-04-28 23:27:00', '2026-04-28 23:27:00', '2026-04-28 23:27:00'),
(24, 25, 3, 'cQrYAXArHc3MXSZEUSmwaT5GNaWN6WBo9VOjDJV6', '2026-04-28 23:40:17', '2026-04-28 23:40:17', '2026-04-28 23:40:17'),
(25, 25, NULL, 'lyPL92V4EwU1zvvQYhHXhWL0D8bbY1fqtq5bWgUX', '2026-04-28 23:40:47', '2026-04-28 23:40:47', '2026-04-28 23:40:47'),
(26, 33, 7, 'KjR5mXcXWqdYbZ3vKyUMbydxa0I8ZSApRBzqJNE0', '2026-04-29 01:13:15', '2026-04-29 01:13:15', '2026-04-29 01:13:15'),
(27, 35, 7, 'KjR5mXcXWqdYbZ3vKyUMbydxa0I8ZSApRBzqJNE0', '2026-04-29 01:29:13', '2026-04-29 01:29:13', '2026-04-29 01:29:13'),
(28, 26, 7, 'KjR5mXcXWqdYbZ3vKyUMbydxa0I8ZSApRBzqJNE0', '2026-04-29 01:31:43', '2026-04-29 01:31:43', '2026-04-29 01:31:43'),
(29, 3, 7, 'KjR5mXcXWqdYbZ3vKyUMbydxa0I8ZSApRBzqJNE0', '2026-04-29 01:39:33', '2026-04-29 01:39:33', '2026-04-29 01:39:33'),
(30, 3, NULL, '6KLYlrX5mlMJ53ANpzzUMaL472Yj7WD2Ex1WSbOS', '2026-04-29 06:36:29', '2026-04-29 06:36:29', '2026-04-29 06:36:29'),
(31, 1, NULL, 'tTFlGTAURLXYvCITPklH88974dRBFpYTIWfPFdwT', '2026-04-29 10:42:53', '2026-04-29 10:42:53', '2026-04-29 10:42:53'),
(32, 4, NULL, 'tTFlGTAURLXYvCITPklH88974dRBFpYTIWfPFdwT', '2026-04-29 10:42:59', '2026-04-29 10:42:59', '2026-04-29 10:42:59'),
(33, 2, NULL, 'tTFlGTAURLXYvCITPklH88974dRBFpYTIWfPFdwT', '2026-04-29 10:43:05', '2026-04-29 10:43:05', '2026-04-29 10:43:05'),
(34, 3, NULL, 'tTFlGTAURLXYvCITPklH88974dRBFpYTIWfPFdwT', '2026-04-29 10:43:16', '2026-04-29 10:43:16', '2026-04-29 10:43:16'),
(35, 10, NULL, 'tTFlGTAURLXYvCITPklH88974dRBFpYTIWfPFdwT', '2026-04-29 10:44:12', '2026-04-29 10:44:12', '2026-04-29 10:44:12'),
(36, 17, NULL, '2NTZF05eHxFgp9k2uA2uTEHXZuJ3oP0pvT3Dw6Zo', '2026-04-30 01:48:46', '2026-04-30 01:48:46', '2026-04-30 01:48:46'),
(37, 35, NULL, '2NTZF05eHxFgp9k2uA2uTEHXZuJ3oP0pvT3Dw6Zo', '2026-04-30 02:08:44', '2026-04-30 02:08:44', '2026-04-30 02:08:44'),
(38, 33, NULL, '2NTZF05eHxFgp9k2uA2uTEHXZuJ3oP0pvT3Dw6Zo', '2026-04-30 02:08:50', '2026-04-30 02:08:50', '2026-04-30 02:08:50'),
(39, 25, NULL, '2NTZF05eHxFgp9k2uA2uTEHXZuJ3oP0pvT3Dw6Zo', '2026-04-30 02:09:02', '2026-04-30 02:09:02', '2026-04-30 02:09:02'),
(40, 36, NULL, '2NTZF05eHxFgp9k2uA2uTEHXZuJ3oP0pvT3Dw6Zo', '2026-04-30 02:26:22', '2026-04-30 02:26:22', '2026-04-30 02:26:22'),
(41, 1, NULL, '2NTZF05eHxFgp9k2uA2uTEHXZuJ3oP0pvT3Dw6Zo', '2026-04-30 02:26:49', '2026-04-30 02:26:49', '2026-04-30 02:26:49'),
(42, 37, NULL, '2NTZF05eHxFgp9k2uA2uTEHXZuJ3oP0pvT3Dw6Zo', '2026-04-30 02:29:59', '2026-04-30 02:29:59', '2026-04-30 02:29:59'),
(43, 19, 10, '7gOO3ZdvuxYdt6sZew4md1tgDdet4ChgmTf9rEWJ', '2026-04-30 02:43:38', '2026-04-30 02:43:38', '2026-04-30 02:43:38'),
(44, 7, 10, '7gOO3ZdvuxYdt6sZew4md1tgDdet4ChgmTf9rEWJ', '2026-04-30 02:43:44', '2026-04-30 02:43:44', '2026-04-30 02:43:44'),
(45, 10, 10, '7gOO3ZdvuxYdt6sZew4md1tgDdet4ChgmTf9rEWJ', '2026-04-30 03:00:15', '2026-04-30 03:00:15', '2026-04-30 03:00:15'),
(46, 18, 10, '7gOO3ZdvuxYdt6sZew4md1tgDdet4ChgmTf9rEWJ', '2026-04-30 03:00:27', '2026-04-30 03:00:27', '2026-04-30 03:00:27'),
(47, 11, 10, '7gOO3ZdvuxYdt6sZew4md1tgDdet4ChgmTf9rEWJ', '2026-04-30 03:17:24', '2026-04-30 03:17:24', '2026-04-30 03:17:24'),
(48, 3, 10, '7gOO3ZdvuxYdt6sZew4md1tgDdet4ChgmTf9rEWJ', '2026-04-30 03:18:24', '2026-04-30 03:18:24', '2026-04-30 03:18:24'),
(49, 4, 7, 'ivJsYNmvbQ6yWOvKne0o0GIl3kVAOqmARFyfS2lM', '2026-04-30 05:06:05', '2026-04-30 05:06:05', '2026-04-30 05:06:05'),
(50, 36, 7, 'ivJsYNmvbQ6yWOvKne0o0GIl3kVAOqmARFyfS2lM', '2026-04-30 05:37:34', '2026-04-30 05:37:34', '2026-04-30 05:37:34'),
(51, 37, 7, 'akpJJGITsVqnuf4VX1lM6AuoUIc3EDgrGb4laa3Y', '2026-04-30 09:49:58', '2026-04-30 09:49:58', '2026-04-30 09:49:58'),
(52, 11, 7, 'akpJJGITsVqnuf4VX1lM6AuoUIc3EDgrGb4laa3Y', '2026-04-30 10:06:17', '2026-04-30 10:06:17', '2026-04-30 10:06:17'),
(53, 2, 7, 'akpJJGITsVqnuf4VX1lM6AuoUIc3EDgrGb4laa3Y', '2026-04-30 10:06:26', '2026-04-30 10:06:26', '2026-04-30 10:06:26'),
(54, 3, 7, '76DcjIOvnjSXJAmDM7QPzKqp8DsPYLaPUcVONy6a', '2026-04-30 23:35:25', '2026-04-30 23:35:25', '2026-04-30 23:35:25'),
(55, 9, 7, 'KQTgNvwMR5cKj37favA5kWvSXXql92xchVcb9AkH', '2026-05-01 02:25:50', '2026-05-01 02:25:50', '2026-05-01 02:25:50'),
(56, 13, 7, 'KQTgNvwMR5cKj37favA5kWvSXXql92xchVcb9AkH', '2026-05-01 02:26:03', '2026-05-01 02:26:03', '2026-05-01 02:26:03'),
(57, 1, NULL, 'Ol5pXbs2Uf4UjsrxbhUN0bvrKPkeqNqNbjQiFBds', '2026-05-01 04:58:13', '2026-05-01 04:58:13', '2026-05-01 04:58:13'),
(58, 35, 7, '9Olt9M4TrIQo7F8t4uioQyvXSHBfMO6IGyFAVnae', '2026-05-01 04:58:30', '2026-05-01 04:58:30', '2026-05-01 04:58:30'),
(59, 39, 7, '9Olt9M4TrIQo7F8t4uioQyvXSHBfMO6IGyFAVnae', '2026-05-01 04:59:14', '2026-05-01 04:59:14', '2026-05-01 04:59:14'),
(60, 26, 7, '9Olt9M4TrIQo7F8t4uioQyvXSHBfMO6IGyFAVnae', '2026-05-01 05:17:38', '2026-05-01 05:17:38', '2026-05-01 05:17:38'),
(61, 37, 7, '9Olt9M4TrIQo7F8t4uioQyvXSHBfMO6IGyFAVnae', '2026-05-01 05:17:57', '2026-05-01 05:17:57', '2026-05-01 05:17:57'),
(62, 3, 7, '9Olt9M4TrIQo7F8t4uioQyvXSHBfMO6IGyFAVnae', '2026-05-01 05:29:52', '2026-05-01 05:29:52', '2026-05-01 05:29:52'),
(63, 4, 7, '9Olt9M4TrIQo7F8t4uioQyvXSHBfMO6IGyFAVnae', '2026-05-01 05:30:21', '2026-05-01 05:30:21', '2026-05-01 05:30:21'),
(64, 36, 7, 'Ws4TF5ba7YR9ARyYLp2w7dAsMIjzgOBJhR1ydaiy', '2026-05-01 14:03:37', '2026-05-01 14:03:37', '2026-05-01 14:03:37'),
(65, 4, 7, 'Ws4TF5ba7YR9ARyYLp2w7dAsMIjzgOBJhR1ydaiy', '2026-05-01 14:04:17', '2026-05-01 14:04:17', '2026-05-01 14:04:17'),
(66, 2, 18, 'Jvw1VaKzoso7MiiMiDuoYGXJdQHRckqPi6JS3eqb', '2026-05-01 19:37:42', '2026-05-01 19:37:42', '2026-05-01 19:37:42'),
(67, 38, 18, 'Jvw1VaKzoso7MiiMiDuoYGXJdQHRckqPi6JS3eqb', '2026-05-01 19:53:39', '2026-05-01 19:53:39', '2026-05-01 19:53:39'),
(68, 9, 18, 'Jvw1VaKzoso7MiiMiDuoYGXJdQHRckqPi6JS3eqb', '2026-05-01 19:55:04', '2026-05-01 19:55:04', '2026-05-01 19:55:04'),
(69, 1, NULL, 'ZEYzEZ6kHki32pzouJaZtPxbK5DHeaXicdykilUX', '2026-05-01 23:48:09', '2026-05-01 23:48:09', '2026-05-01 23:48:09'),
(70, 4, NULL, 'cCeNqVqILnH0HNcRUl86NnBfocCAqHB4V5JiuIGU', '2026-05-02 00:30:47', '2026-05-02 00:30:47', '2026-05-02 00:30:47'),
(71, 33, 18, '6s25cMavqHzqJFxN3qU9F5xVUEsWs015nEyxcl7m', '2026-05-02 01:45:09', '2026-05-02 01:45:09', '2026-05-02 01:45:09'),
(72, 35, 18, '6s25cMavqHzqJFxN3qU9F5xVUEsWs015nEyxcl7m', '2026-05-02 01:45:18', '2026-05-02 01:45:18', '2026-05-02 01:45:18'),
(73, 6, 18, '6s25cMavqHzqJFxN3qU9F5xVUEsWs015nEyxcl7m', '2026-05-02 02:27:03', '2026-05-02 02:27:03', '2026-05-02 02:27:03'),
(74, 32, 18, '6s25cMavqHzqJFxN3qU9F5xVUEsWs015nEyxcl7m', '2026-05-02 02:27:06', '2026-05-02 02:27:06', '2026-05-02 02:27:06'),
(75, 41, 18, '6s25cMavqHzqJFxN3qU9F5xVUEsWs015nEyxcl7m', '2026-05-02 03:46:55', '2026-05-02 03:46:55', '2026-05-02 03:46:55');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('6s25cMavqHzqJFxN3qU9F5xVUEsWs015nEyxcl7m', 18, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', 'YTo5OntzOjY6Il90b2tlbiI7czo0MDoieGFiNHZrWkZLQURWZ0hUR2NKbFQ1d2xLeEttWTYzMmlGTUVzc0dNRiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cy80MSI7czo1OiJyb3V0ZSI7czoxMzoicHJvZHVjdHMuc2hvdyI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE4O3M6MTc6InByb2R1Y3Rfdmlld2VkXzMzIjtiOjE7czoxNzoicHJvZHVjdF92aWV3ZWRfMzUiO2I6MTtzOjE2OiJwcm9kdWN0X3ZpZXdlZF82IjtiOjE7czoxNzoicHJvZHVjdF92aWV3ZWRfMzIiO2I6MTtzOjE3OiJwcm9kdWN0X3ZpZXdlZF80MSI7YjoxO30=', 1777713415),
('pYDxWepBQKB1y5qarkIORrKNwMnXwGMQeA7mUZBL', 19, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiVVk3SmtFSWRyUFY5TVdURlkxVEwwOWphY0cweU9wazlNaTFTSk5uMSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jb25zdWx0YXRpb25zL3RocmVhZHMiO3M6NToicm91dGUiO3M6MjE6ImNvbnN1bHRhdGlvbnMudGhyZWFkcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6NDI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jb25zdWx0YW50L2Rhc2hib2FyZCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE5O30=', 1777714632),
('spGwqYBAUfTg97G0YbKzLMj7fLYqpSa5DQEGH6tm', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiUFJZTGVPVGVqT2hqTmRqbFNkWnVDTlF6c1BNTFJ2a1RPSHJ1SFE5TyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjM3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4vZGFzaGJvYXJkIjtzOjU6InJvdXRlIjtzOjE1OiJhZG1pbi5kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=', 1777713405);

-- --------------------------------------------------------

--
-- Table structure for table `site_notifications`
--

DROP TABLE IF EXISTS `site_notifications`;
CREATE TABLE IF NOT EXISTS `site_notifications` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `recipient_user_id` bigint UNSIGNED DEFAULT NULL,
  `recipient_role` enum('all','admin','consultant','customer') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer',
  `category` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'General',
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Unread','Read') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Unread',
  `action_label` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `site_notifications_recipient_user_id_foreign` (`recipient_user_id`),
  KEY `site_notifications_recipient_role_recipient_user_id_status_index` (`recipient_role`,`recipient_user_id`,`status`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_notifications`
--

INSERT INTO `site_notifications` (`id`, `recipient_user_id`, `recipient_role`, `category`, `image_path`, `title`, `message`, `status`, `action_label`, `action_url`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 7, 'customer', 'Orders', NULL, 'Order PG-20260419104437-3811', 'Your order PG-20260419104437-3811 status has been updated to Ready For Pickup. Admin note: Your order is ready for pickup now', 'Read', NULL, NULL, '2026-04-19 09:18:05', '2026-04-19 09:18:05', '2026-04-19 09:18:20'),
(2, NULL, 'admin', 'Orders', NULL, 'Refund Request RET-20260419150856-261', 'New refund request submitted for order PG-20260417160525-9346. Reason: Too small', 'Unread', NULL, NULL, '2026-04-19 09:38:56', '2026-04-19 09:38:56', '2026-04-19 09:38:56'),
(3, 7, 'customer', 'Orders', NULL, 'Return RET-20260419150856-261 Pending Review', 'Your refund request for order PG-20260417160525-9346 has been submitted and is now pending review.', 'Read', NULL, NULL, '2026-04-19 09:38:56', '2026-04-19 09:38:56', '2026-04-19 12:03:50'),
(4, 7, 'customer', 'Orders', NULL, 'Return RET-20260419150856-261 Approved', 'Your refund request for order PG-20260417160525-9346 has been approved and is now in progress. Admin note: Proceeded to refund', 'Read', NULL, NULL, '2026-04-19 10:03:26', '2026-04-19 10:03:26', '2026-04-19 12:03:50'),
(5, 7, 'customer', 'Orders', NULL, 'Return RET-20260419150856-261 Approved', 'Your refund request for order PG-20260417160525-9346 has been marked as refunded.', 'Read', NULL, NULL, '2026-04-19 10:03:57', '2026-04-19 10:03:57', '2026-04-19 12:03:50'),
(6, 7, 'customer', 'Custom Jewellery', NULL, 'Custom Request CJR-20260418061454-8TIB Approved', 'Your custom jewellery request has been approved.', 'Read', NULL, NULL, '2026-04-19 10:04:41', '2026-04-19 10:04:41', '2026-04-19 12:03:50'),
(7, 7, 'customer', 'Custom Jewellery', NULL, 'Custom Request CJR-20260418061454-8TIB Approved', 'Your custom jewellery request has been approved.', 'Read', NULL, NULL, '2026-04-19 10:04:41', '2026-04-19 10:04:41', '2026-04-19 12:03:50'),
(8, 7, 'customer', 'Custom Jewellery', NULL, 'Quotation for CJR-20260418061454-8TIB', 'A quotation of Rs 41,000 is ready for your custom jewellery request.', 'Read', 'Pay', 'http://127.0.0.1:8000/custom-quotations/1/pay', '2026-04-19 10:05:57', '2026-04-19 10:05:57', '2026-04-19 12:03:50'),
(9, 7, 'customer', 'Custom Jewellery', NULL, 'Quotation CJR-20260418061454-8TIB-Q-153557 Paid', 'Your quotation payment has been received. The custom jewellery request is now moving into production.', 'Read', NULL, NULL, '2026-04-19 10:08:15', '2026-04-19 10:08:15', '2026-04-19 12:03:50'),
(10, 7, 'customer', 'Custom Jewellery', NULL, 'Quotation CJR-20260418061454-8TIB-Q-153557 Paid', 'Your quotation payment has been received. The custom jewellery request is now marked as paid.', 'Read', NULL, NULL, '2026-04-19 11:10:59', '2026-04-19 11:10:59', '2026-04-19 12:03:50'),
(11, 7, 'customer', 'Custom Jewellery', NULL, 'Custom Request CJR-20260418061454-8TIB Paid', 'Your custom jewellery request status has been updated to Paid.', 'Read', NULL, NULL, '2026-04-19 11:43:12', '2026-04-19 11:43:12', '2026-04-19 12:03:50'),
(12, 7, 'customer', 'Custom Jewellery', NULL, 'Custom Request CJR-20260419171608-WCQU Approved', 'Your custom jewellery request has been approved.', 'Read', NULL, NULL, '2026-04-19 11:46:33', '2026-04-19 11:46:33', '2026-04-19 12:03:50'),
(13, 7, 'customer', 'Custom Jewellery', NULL, 'Custom Request CJR-20260419171608-WCQU Approved', 'Your custom jewellery request has been approved.', 'Read', NULL, NULL, '2026-04-19 11:46:34', '2026-04-19 11:46:34', '2026-04-19 12:03:50'),
(14, 7, 'customer', 'Custom Jewellery', NULL, 'Quotation for CJR-20260419171608-WCQU', 'A quotation of Rs 42,000 is ready for your custom jewellery request.', 'Read', 'Pay', 'http://127.0.0.1:8000/custom-quotations/2/pay', '2026-04-19 11:46:58', '2026-04-19 11:46:58', '2026-04-19 12:03:50'),
(15, NULL, 'admin', 'Custom Jewellery', NULL, 'Quotation Rejected CJR-20260419171608-WCQU', 'The customer rejected quotation CJR-20260419171608-WCQU-Q-171658 for request CJR-20260419171608-WCQU.', 'Unread', NULL, NULL, '2026-04-19 12:04:23', '2026-04-19 12:04:23', '2026-04-19 12:04:23'),
(16, 7, 'customer', 'Custom Jewellery', NULL, 'Quotation CJR-20260419171608-WCQU-Q-171658 Rejected', 'You rejected the quotation for your custom jewellery request.', 'Read', NULL, NULL, '2026-04-19 12:04:23', '2026-04-19 12:04:23', '2026-04-21 10:02:26'),
(17, 5, 'customer', 'Promotions', 'images/Notifications/a3e2efc8-2246-4d91-b68e-bb43733c14df.jpg', 'Christmas discounts up to 20% off', 'Get your exclusive Christmas discounts today! Discounts up to 20%. Valid till January 1st', 'Unread', NULL, NULL, '2026-04-20 02:18:12', '2026-04-20 02:18:12', '2026-04-20 02:18:12'),
(18, 8, 'customer', 'Promotions', 'images/Notifications/a3e2efc8-2246-4d91-b68e-bb43733c14df.jpg', 'Christmas discounts up to 20% off', 'Get your exclusive Christmas discounts today! Discounts up to 20%. Valid till January 1st', 'Unread', NULL, NULL, '2026-04-20 02:18:12', '2026-04-20 02:18:12', '2026-04-20 02:18:12'),
(19, 9, 'customer', 'Promotions', 'images/Notifications/a3e2efc8-2246-4d91-b68e-bb43733c14df.jpg', 'Christmas discounts up to 20% off', 'Get your exclusive Christmas discounts today! Discounts up to 20%. Valid till January 1st', 'Unread', NULL, NULL, '2026-04-20 02:18:12', '2026-04-20 02:18:12', '2026-04-20 02:18:12'),
(20, 7, 'customer', 'Promotions', 'images/Notifications/a3e2efc8-2246-4d91-b68e-bb43733c14df.jpg', 'Christmas discounts up to 20% off', 'Get your exclusive Christmas discounts today! Discounts up to 20%. Valid till January 1st', 'Read', NULL, NULL, '2026-04-20 02:18:12', '2026-04-20 02:18:12', '2026-04-21 10:02:26'),
(21, 2, 'customer', 'Promotions', 'images/Notifications/a3e2efc8-2246-4d91-b68e-bb43733c14df.jpg', 'Christmas discounts up to 20% off', 'Get your exclusive Christmas discounts today! Discounts up to 20%. Valid till January 1st', 'Unread', NULL, NULL, '2026-04-20 02:18:12', '2026-04-20 02:18:12', '2026-04-20 02:18:12'),
(22, 10, 'customer', 'Promotions', 'images/Notifications/a3e2efc8-2246-4d91-b68e-bb43733c14df.jpg', 'Christmas discounts up to 20% off', 'Get your exclusive Christmas discounts today! Discounts up to 20%. Valid till January 1st', 'Read', NULL, NULL, '2026-04-20 02:18:12', '2026-04-20 02:18:12', '2026-04-20 02:18:38'),
(23, 7, 'customer', 'Orders', NULL, 'Order PG-20260419104437-3811 Pickup Completed', 'Your order PG-20260419104437-3811 status has been updated to Pickup Completed.', 'Read', NULL, NULL, '2026-04-21 01:22:22', '2026-04-21 01:22:22', '2026-04-21 10:02:26'),
(24, 10, 'customer', 'Orders', NULL, 'Order PG-20260430080433-3030 Processing', 'Your order PG-20260430080433-3030 status has been updated to Processing.', 'Unread', NULL, NULL, '2026-04-30 02:36:09', '2026-04-30 02:36:09', '2026-04-30 02:36:09'),
(25, 7, 'customer', 'Orders', NULL, 'Order PG-20260430111428-1840 Processing', 'Your order PG-20260430111428-1840 status has been updated to Processing. Admin note: Your order is now being processed', 'Read', NULL, NULL, '2026-05-01 06:01:41', '2026-05-01 06:01:41', '2026-05-01 08:20:07'),
(26, 7, 'customer', 'Custom Jewellery', NULL, 'Custom Request CJR-20260430153229-O6HV Quoted', 'Your custom jewellery request status has been updated to Quoted.', 'Read', NULL, NULL, '2026-05-01 06:24:03', '2026-05-01 06:24:03', '2026-05-01 08:20:07'),
(27, 7, 'customer', 'Custom Jewellery', NULL, 'Custom Request CJR-20260430153229-O6HV Pending', 'Your custom jewellery request status has been updated to Pending.', 'Read', NULL, NULL, '2026-05-01 06:24:17', '2026-05-01 06:24:17', '2026-05-01 08:20:07'),
(28, 7, 'customer', 'Custom Jewellery', NULL, 'Custom Request CJR-20260430153229-O6HV Approved', 'Your custom jewellery request has been approved.', 'Read', NULL, NULL, '2026-05-01 06:26:19', '2026-05-01 06:26:19', '2026-05-01 08:20:07'),
(29, 7, 'customer', 'Custom Jewellery', NULL, 'Custom Request CJR-20260430153229-O6HV Approved', 'Your custom jewellery request has been approved.', 'Read', NULL, NULL, '2026-05-01 06:26:20', '2026-05-01 06:26:20', '2026-05-01 08:20:07'),
(30, 7, 'customer', 'Custom Jewellery', NULL, 'Custom Request CJR-20260430153229-O6HV Pending', 'Your custom jewellery request status has been updated to Pending.', 'Read', NULL, NULL, '2026-05-01 06:28:09', '2026-05-01 06:28:09', '2026-05-01 08:20:07'),
(31, 7, 'customer', 'Custom Jewellery', NULL, 'Custom Request CJR-20260430153229-O6HV Approved', 'Your custom jewellery request status has been updated to Approved. Admin note: Request Approved. You will receive quotation shortly.', 'Read', NULL, NULL, '2026-05-01 07:20:36', '2026-05-01 07:20:36', '2026-05-01 08:20:07'),
(32, 7, 'customer', 'Custom Jewellery', NULL, 'Custom Request CJR-20260430153229-O6HV Quoted', 'Your custom jewellery request status has been updated to Quoted.', 'Read', NULL, NULL, '2026-05-01 07:23:01', '2026-05-01 07:23:01', '2026-05-01 08:20:07'),
(33, 7, 'customer', 'Custom Jewellery', NULL, 'Custom Request CJR-20260430153229-O6HV Approved', 'Your custom jewellery request status has been updated to Approved.', 'Read', NULL, NULL, '2026-05-01 07:23:10', '2026-05-01 07:23:10', '2026-05-01 08:20:07'),
(34, 7, 'customer', 'Custom Jewellery', NULL, 'Quotation for CJR-20260430153229-O6HV', 'A quotation of Rs 80,000 is ready for your custom jewellery request. Note: Production may take up to three weeks', 'Read', 'Review Quotation', 'http://127.0.0.1:8000/custom-jewellery', '2026-05-01 07:35:39', '2026-05-01 07:35:39', '2026-05-01 08:20:07'),
(35, 5, 'customer', 'Promotions', 'images/Notifications/5328b8ff-45cc-4d68-9f97-86f93069a085.jpg', 'New Year Sale!', 'සුභ අලුත් අවුරුද්දක් වේවා! 🎊 Wishing you a prosperous Sinhala & Tamil New Year! Celebrate with our exclusive Avurudu Discounts up to 50% OFF. Upgrade your home and life this season. Offer valid until April 30th. Shop now! 🛒', 'Unread', NULL, NULL, '2026-05-01 08:15:06', '2026-05-01 08:15:06', '2026-05-01 08:15:06'),
(36, 8, 'customer', 'Promotions', 'images/Notifications/5328b8ff-45cc-4d68-9f97-86f93069a085.jpg', 'New Year Sale!', 'සුභ අලුත් අවුරුද්දක් වේවා! 🎊 Wishing you a prosperous Sinhala & Tamil New Year! Celebrate with our exclusive Avurudu Discounts up to 50% OFF. Upgrade your home and life this season. Offer valid until April 30th. Shop now! 🛒', 'Unread', NULL, NULL, '2026-05-01 08:15:06', '2026-05-01 08:15:06', '2026-05-01 08:15:06'),
(37, 18, 'customer', 'Promotions', 'images/Notifications/5328b8ff-45cc-4d68-9f97-86f93069a085.jpg', 'New Year Sale!', 'සුභ අලුත් අවුරුද්දක් වේවා! 🎊 Wishing you a prosperous Sinhala & Tamil New Year! Celebrate with our exclusive Avurudu Discounts up to 50% OFF. Upgrade your home and life this season. Offer valid until April 30th. Shop now! 🛒', 'Unread', NULL, NULL, '2026-05-01 08:15:06', '2026-05-01 08:15:06', '2026-05-01 08:15:06'),
(38, 9, 'customer', 'Promotions', 'images/Notifications/5328b8ff-45cc-4d68-9f97-86f93069a085.jpg', 'New Year Sale!', 'සුභ අලුත් අවුරුද්දක් වේවා! 🎊 Wishing you a prosperous Sinhala & Tamil New Year! Celebrate with our exclusive Avurudu Discounts up to 50% OFF. Upgrade your home and life this season. Offer valid until April 30th. Shop now! 🛒', 'Unread', NULL, NULL, '2026-05-01 08:15:06', '2026-05-01 08:15:06', '2026-05-01 08:15:06'),
(39, 7, 'customer', 'Promotions', 'images/Notifications/5328b8ff-45cc-4d68-9f97-86f93069a085.jpg', 'New Year Sale!', 'සුභ අලුත් අවුරුද්දක් වේවා! 🎊 Wishing you a prosperous Sinhala & Tamil New Year! Celebrate with our exclusive Avurudu Discounts up to 50% OFF. Upgrade your home and life this season. Offer valid until April 30th. Shop now! 🛒', 'Read', NULL, NULL, '2026-05-01 08:15:06', '2026-05-01 08:15:06', '2026-05-01 08:20:07'),
(40, 2, 'customer', 'Promotions', 'images/Notifications/5328b8ff-45cc-4d68-9f97-86f93069a085.jpg', 'New Year Sale!', 'සුභ අලුත් අවුරුද්දක් වේවා! 🎊 Wishing you a prosperous Sinhala & Tamil New Year! Celebrate with our exclusive Avurudu Discounts up to 50% OFF. Upgrade your home and life this season. Offer valid until April 30th. Shop now! 🛒', 'Unread', NULL, NULL, '2026-05-01 08:15:06', '2026-05-01 08:15:06', '2026-05-01 08:15:06'),
(41, 10, 'customer', 'Promotions', 'images/Notifications/5328b8ff-45cc-4d68-9f97-86f93069a085.jpg', 'New Year Sale!', 'සුභ අලුත් අවුරුද්දක් වේවා! 🎊 Wishing you a prosperous Sinhala & Tamil New Year! Celebrate with our exclusive Avurudu Discounts up to 50% OFF. Upgrade your home and life this season. Offer valid until April 30th. Shop now! 🛒', 'Unread', NULL, NULL, '2026-05-01 08:15:06', '2026-05-01 08:15:06', '2026-05-01 08:15:06'),
(42, 15, 'customer', 'Promotions', 'images/Notifications/5328b8ff-45cc-4d68-9f97-86f93069a085.jpg', 'New Year Sale!', 'සුභ අලුත් අවුරුද්දක් වේවා! 🎊 Wishing you a prosperous Sinhala & Tamil New Year! Celebrate with our exclusive Avurudu Discounts up to 50% OFF. Upgrade your home and life this season. Offer valid until April 30th. Shop now! 🛒', 'Unread', NULL, NULL, '2026-05-01 08:15:06', '2026-05-01 08:15:06', '2026-05-01 08:15:06'),
(43, 16, 'customer', 'Promotions', 'images/Notifications/5328b8ff-45cc-4d68-9f97-86f93069a085.jpg', 'New Year Sale!', 'සුභ අලුත් අවුරුද්දක් වේවා! 🎊 Wishing you a prosperous Sinhala & Tamil New Year! Celebrate with our exclusive Avurudu Discounts up to 50% OFF. Upgrade your home and life this season. Offer valid until April 30th. Shop now! 🛒', 'Unread', NULL, NULL, '2026-05-01 08:15:06', '2026-05-01 08:15:06', '2026-05-01 08:15:06'),
(44, 6, 'consultant', 'General', 'images/Notifications/dd8cd8bf-f4f8-48d4-9382-5cb565413e97.jpg', 'New Year Wishes from Pinwantha Gems & Jewellery Familiy!', 'සුභ අලුත් අවුරුද්දක් වේවා! 🎊 Wishing you a prosperous Sinhala & Tamil New Year! Thank you for being a part of the Pinwantha Gems & Jewellery Familiy 🎁', 'Unread', NULL, NULL, '2026-05-01 08:18:22', '2026-05-01 08:18:22', '2026-05-01 08:18:22'),
(45, 19, 'consultant', 'General', 'images/Notifications/dd8cd8bf-f4f8-48d4-9382-5cb565413e97.jpg', 'New Year Wishes from Pinwantha Gems & Jewellery Familiy!', 'සුභ අලුත් අවුරුද්දක් වේවා! 🎊 Wishing you a prosperous Sinhala & Tamil New Year! Thank you for being a part of the Pinwantha Gems & Jewellery Familiy 🎁', 'Read', NULL, NULL, '2026-05-01 08:18:22', '2026-05-01 08:18:22', '2026-05-01 08:19:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `gender` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `role` enum('super_admin','admin','lower_admin','content_manager','consultant','customer') COLLATE utf8mb4_unicode_ci DEFAULT 'customer',
  `account_status` enum('Active','Inactive','Blocked') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `permissions` json DEFAULT NULL,
  `profile_image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `zodiac_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `idx_users_zodiac_id` (`zodiac_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `phone_number`, `birth_date`, `gender`, `address`, `role`, `account_status`, `permissions`, `profile_image_path`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `zodiac_id`) VALUES
(2, 'ranudi', 'vihara', 'ranudivihara36@gmail.com', '0771673115', '2004-05-12', NULL, 'Acres 16, karapincha, hidellana, ratnapura', 'customer', 'Active', NULL, 'uploads/profile-images/customers/4fcff69a-c440-4b5f-a950-61612ed03736.jpeg', NULL, '$2y$12$g0uW87hJrONZ.OYpGM4O8.GeaLg5tzVosxYWGqUOIAbLhDPRutnuS', NULL, '2026-03-07 23:38:21', '2026-03-31 22:37:03', NULL),
(3, 'Admin', 'guy', 'admin@pinwntha.com', '0771673115', NULL, NULL, 'Acres 16, karapincha, hidellana, ratnapura', 'admin', 'Active', NULL, 'uploads/profile-images/admins/66d957c8-2356-4608-bd5c-b745973a33a6.png', NULL, '$2y$12$Yk7R8bQPAaDuJV2ClO2iI.ihyrRHlqgM9QGk8155mBd9upO2mJ4QO', NULL, '2026-03-27 02:03:46', '2026-04-21 08:55:30', NULL),
(5, 'A', 'B', 'ab@gmail.com', NULL, NULL, NULL, NULL, 'customer', 'Active', NULL, NULL, NULL, '$2y$12$8K7h9M4H6v9KsjPXPyXBE.i7wD7oStvjupGdluCaKiHhawNgtN1wu', NULL, '2026-04-04 03:35:11', '2026-04-19 01:30:16', NULL),
(6, 'Amaya', 'Jayaratne', 'consultant@a.com', NULL, NULL, NULL, NULL, 'consultant', 'Active', NULL, NULL, NULL, '$2y$12$a5jAoX1XSaiF71qMniOvQuktKVKPI.Z87LSoTwQ9/EwiS8fAWaPzK', NULL, '2026-04-05 03:47:13', '2026-04-05 03:47:13', NULL),
(7, 'John', 'Smith', 'john123@gmail.com', NULL, '2002-09-20', NULL, NULL, 'customer', 'Active', NULL, NULL, NULL, '$2y$12$iUwTL5e.WTsNRNFcIvJjCeuM3y6tO3TngDt89D2m2mgAiC7C66j5y', NULL, '2026-04-05 06:04:40', '2026-04-29 02:23:00', 7),
(8, 'A', 'K', 'ak@gmail.com', NULL, NULL, NULL, NULL, 'customer', 'Active', NULL, NULL, NULL, '$2y$12$CPovSEjNckawa6DjmSyl3eZ.ll4zRePZWnkk0HbtHeCAV.BMcfDPq', NULL, '2026-04-05 06:47:50', '2026-04-05 06:47:50', NULL),
(9, 'B', 'C', 'bc@a.com', NULL, '2002-02-07', NULL, NULL, 'customer', 'Active', NULL, NULL, NULL, '$2y$12$gN5Wh34DmJXzgwtRob28F.YtAocuPdgQRtmHWssthL8r1YU4rq36u', NULL, '2026-04-05 06:51:10', '2026-04-05 06:51:10', NULL),
(10, 'Ryan', 'Kolambage', 'rt@email.com', '0776456510', '2002-09-20', NULL, NULL, 'customer', 'Active', NULL, 'uploads/profile-images/customers/ff7e587f-2fb6-44d4-907d-ed98b7e756ba.png', NULL, '$2y$12$iUwTL5e.WTsNRNFcIvJjCeuM3y6tO3TngDt89D2m2mgAiC7C66j5y', NULL, '2026-04-16 23:47:56', '2026-04-17 04:27:44', 1),
(12, 'Content', 'Manager', 'contentmanager@example.com', NULL, NULL, NULL, NULL, 'content_manager', 'Active', '[\"manage_contact_messages\", \"manage_content\", \"manage_reports\", \"manage_notifications\"]', NULL, NULL, '$2y$12$iUwTL5e.WTsNRNFcIvJjCeuM3y6tO3TngDt89D2m2mgAiC7C66j5y', NULL, '2026-04-18 13:37:00', '2026-05-01 03:27:22', NULL),
(15, 'Sam', 'Brown', 'sambrown@example.com', '0778989851', '2002-05-08', NULL, NULL, 'customer', 'Active', NULL, NULL, '2026-05-01 00:14:13', '$2y$12$s63Z/XhPGVcMaqz5haPM5OMdaXw6zpskgL7U0qfXb9UHjnTLvKPbS', NULL, '2026-05-01 00:14:13', '2026-05-01 00:14:13', 2),
(16, 'Sunil', 'Fernando', 'sunil@example.com', '0775656555', '1990-04-02', NULL, NULL, 'customer', 'Active', NULL, NULL, '2026-05-01 00:18:32', '$2y$12$9GNZCPzprsYhzX6DPOfvX.VfUKXSXTPNPGxqVHOtI2ZqXwi8zYFD6', NULL, '2026-05-01 00:18:32', '2026-05-01 00:18:32', 1),
(18, 'Asanka', 'Ekanayake', 'asanka@example.com', '0765856422', '1985-05-20', NULL, NULL, 'customer', 'Active', NULL, NULL, '2026-05-01 00:40:48', '$2y$12$PNP8q./kpES.fDO31faaUuKrtPAmix1dSdzDEMsNqp9UexzMHmYPS', NULL, '2026-05-01 00:40:48', '2026-05-01 19:13:14', 2),
(19, 'Roshan', 'Senanayake', 'rsenanayake@example.com', '0718254125', '1986-01-07', NULL, NULL, 'consultant', 'Active', NULL, NULL, '2026-05-01 01:00:44', '$2y$12$htTmb5ou8f1gOu4DAUwvXOlMYfhmPRf1C6xK/GTQ2tU2nKeL/D1qC', NULL, '2026-05-01 01:00:44', '2026-05-01 03:40:29', 10),
(20, 'Tharushi', 'Gunawardena', 'gunawardena@example.com', '0775654120', NULL, NULL, NULL, 'lower_admin', 'Active', '[\"manage_orders\", \"manage_products\", \"manage_inventory\", \"manage_custom_jewellery\", \"manage_consultations\", \"manage_contact_messages\"]', NULL, '2026-05-01 01:30:07', '$2y$12$44XfVKsG27T/cGvzPv9XU.ODHzQ64F5PjgnagfKFD96VMxahevOXy', NULL, '2026-05-01 01:30:07', '2026-05-01 03:26:05', NULL),
(21, 'Sanduni', 'Jayasinghe', 'Jayasinghe@example.com', '0778985555', '1996-05-01', NULL, NULL, 'content_manager', 'Blocked', '[\"manage_contact_messages\", \"manage_content\", \"manage_reports\", \"manage_notifications\"]', NULL, '2026-05-01 03:11:03', '$2y$12$QHwEpOh4GUybV/I1P05UmOLgJqC2/s6Mgb.7NjMSo85Mc7k2fUCc6', NULL, '2026-05-01 03:11:03', '2026-05-01 04:03:44', 2);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist_items`
--

DROP TABLE IF EXISTS `wishlist_items`;
CREATE TABLE IF NOT EXISTS `wishlist_items` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `product_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `wishlist_items_user_id_product_id_unique` (`user_id`,`product_id`),
  KEY `wishlist_items_product_id_foreign` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlist_items`
--

INSERT INTO `wishlist_items` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 7, 3, '2026-04-17 10:13:15', '2026-04-17 10:13:15'),
(2, 7, 9, '2026-04-21 02:16:37', '2026-04-21 02:16:37'),
(3, 7, 7, '2026-04-21 04:36:51', '2026-04-21 04:36:51'),
(4, 7, 25, '2026-04-29 00:22:26', '2026-04-29 00:22:26'),
(5, 7, 4, '2026-04-30 05:07:49', '2026-04-30 05:07:49'),
(6, 7, 36, '2026-04-30 05:44:43', '2026-04-30 05:44:43'),
(7, 7, 37, '2026-04-30 09:58:04', '2026-04-30 09:58:04'),
(9, 7, 13, '2026-05-01 02:30:16', '2026-05-01 02:30:16'),
(10, 18, 2, '2026-05-01 19:44:57', '2026-05-01 19:44:57');

-- --------------------------------------------------------

--
-- Table structure for table `zodiac_signs`
--

DROP TABLE IF EXISTS `zodiac_signs`;
CREATE TABLE IF NOT EXISTS `zodiac_signs` (
  `zodiac_id` int NOT NULL AUTO_INCREMENT,
  `sign_name` varchar(50) NOT NULL,
  `start_month` int NOT NULL,
  `start_day` int NOT NULL,
  `end_month` int NOT NULL,
  `end_day` int NOT NULL,
  `element` varchar(20) DEFAULT NULL,
  `description` text,
  `compatible_sign` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `element_description` text,
  PRIMARY KEY (`zodiac_id`),
  UNIQUE KEY `sign_name` (`sign_name`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `zodiac_signs`
--

INSERT INTO `zodiac_signs` (`zodiac_id`, `sign_name`, `start_month`, `start_day`, `end_month`, `end_day`, `element`, `description`, `compatible_sign`, `image`, `element_description`) VALUES
(1, 'Aries', 3, 21, 4, 19, 'Fire', 'Aries loves to be number one, so it’s no surprise that these audacious rams are the first sign of the zodiac. Bold and ambitious, Aries dives headfirst into even the most challenging situations (which is appropriate, since the body part associated with Aries is the head). Like their fellow fire signs, Leo and Sagittarius, Aries is a passionate, motivated, and confident leader who builds community with their cheerful disposition and relentless determination. Uncomplicated and direct in their approach, they often get frustrated by exhaustive details and unnecessary nuances. They like things quick and dirty, a temperament also reflected in their sexual proclivities.', 'Leo, Sagittarius, Gemini, Aquarius', 'aries.png', 'Aries is a fire sign. Fire signs tend to be passionate, dynamic, and temperamental. They get angry quickly, but they also forgive easily. They are adventurers with immense energy. They are physically very strong and are a source of inspiration for others. Fire signs are intelligent, self-aware, creative and idealistic people, always ready for action. '),
(2, 'Taurus', 4, 20, 5, 20, 'Earth', 'Taurus is an earth sign represented by the bull. Like their celestial animal counterpart, Taureans enjoy relaxing in serene, bucolic environments, surrounded by soft sounds, soothing aromas, and succulent flavors. Taurus is ruled by Venus, the enchanting planet that governs love, beauty, and money. Taurus’s Venusian influence make this earth sign the most sensual of the zodiac: These cosmic oxen are enchanted by any physical manifestation of comfort and luxury. Pleasure is a necessity for epicurean Taureans and they feel most content when pampered. (Taurus governs the neck, so neck caresses are especially irresistible to these bulls.)', 'Virgo, Capricorn, Cancer, Pisces', 'taurus.png', 'Taurus is an earth sign. Earth signs are “grounded” and the ones that bring us down to earth. They are mostly conservative and realistic, but they can also be very emotional. They are connected to our material reality and can be turned to material goods. They are practical, loyal and stable and they stick by their people through hard times.'),
(3, 'Gemini', 5, 21, 6, 20, 'Air', 'Have you ever been so busy that you wished you could clone yourself just to get everything done? That’s the Gemini experience in a nutshell. Appropriately symbolized by the celestial twins, this air sign was interested in so many pursuits that it had to double itself. Because of Geminis\' intrinsic duality, they\'re often falsely misrepresented as two-faced. In reality, however, Gemini rarely has a hidden agenda. Playful and intellectually curious, Gemini is constantly juggling a variety of passions, hobbies, careers, and friend groups. They are the social butterflies of the zodiac: These quick-witted twins can talk to anyone about anything. Find them buzzing between happy hours, dinner parties, and dance floors.\n', 'Libra, Aquarius, Aries, Leo', 'gemini.png', 'Gemini is an air sign. Air signs are rational, social, and love communication and relationships with other people. They are thinkers, friendly, intellectual, communicative and analytical. They love philosophical discussions, social gatherings and good books. They enjoy giving advice, but they can also be very superficial.'),
(4, 'Cancer', 6, 21, 7, 22, 'Water', 'Cancer is a cardinal water sign. Represented by the crab, this oceanic crustacean seamlessly weaves between the sea and shore, representing Cancer’s ability to exist in both emotional and material realms. Cancers are highly intuitive and their psychic abilities manifest in tangible spaces: This is why Cancers can effortlessly pick up the energies in a room. These crabs are highly sensitive to their environments, as well as extremely self-protective. Much like their celestial animal counterpart, Cancers are shielded by hard, external shells. At first, these crabs may be perceived as cold or distant. With time, though, Cancers reveal their gentle nature, genuine compassion, and mystical capabilities.', 'Scorpio, Pisces, Taurus, Virgo', 'cancer.png', 'Cancer is a water sign. Water signs are exceptionally emotional and ultra-sensitive. They are highly intuitive and they can be as mysterious as the ocean itself. Water signs love profound conversations and intimacy. They rarely do anything openly and are always there to support their loved ones. '),
(5, 'Leo', 7, 23, 8, 22, 'Fire', 'Roll out the red carpet, because Leo has arrived. Leo (July 23 - August 22) is represented by the lion, and these spirited fire signs are the kings and queens of the celestial jungle. They’re delighted to embrace their royal status: Vivacious, theatrical, and passionate, Leos love to bask in the spotlight and celebrate themselves. These lions are natural leaders and they enjoy cultivating friendships and romances that are artistically and creatively inspired. Playful Leos have no problem leaning into drama-fueled romances that are perfectly suited for the tabloids. (In fact, they may even prefer them.) After all, every Leo perceives him or herself as a celebrity. These astrological divas never get tired of lavish dinners, exclusive parties, or decadent designer wear.', 'Aries, Sagittarius, Gemini, Libra', 'leo.png', 'Leo is a fire sign. Fire signs tend to be passionate, dynamic, and temperamental. They get angry quickly, but they also forgive easily. They are adventurers with immense energy. They are physically very strong and are a source of inspiration for others. Fire signs are intelligent, self-aware, creative and idealistic people, always ready for action. '),
(6, 'Virgo', 8, 23, 9, 22, 'Earth', 'Virgo is an earth sign historically represented by the goddess of wheat and agriculture, an association that speaks to Virgo’s deep-rooted presence in the material world. Virgos are logical, practical, and systematic in their approach to life. This earth sign is a perfectionist at heart and isn’t afraid to improve skills through diligent and consistent practice. Virgo rules the digestive system, which makes these earth signs especially attuned to the ingredients that make up a whole—in food and in everything else. They\'re hyper-aware of every detail.', 'Taurus, Capricorn, Cancer, Scorpio', 'virgo.png', 'Virgo is an earth sign. Earth signs are “grounded” and the ones that bring us down to earth. They are mostly conservative and realistic, but they can also be very emotional. They are connected to our material reality and can be turned to material goods. They are practical, loyal and stable and they stick by their people through hard times.'),
(7, 'Libra', 9, 23, 10, 22, 'Air', 'Libra is an air sign represented by the scales (interestingly, the only inanimate object of the zodiac), an association that reflects Libra\'s fixation on balance and harmony. Libra is obsessed with symmetry and strives to create equilibrium in all areas of life. These air signs are the aesthetes of the zodiac: Ruled by Venus, the planet that governs love, beauty, and money, Libras adore high art, intellectualism, and connoisseurship. Suave Libras need to surround themselves with stunning objects and create environments that reflect their exquisite tastes. Accordingly, these air signs make excellent designers, decorators, art critics, and stylists.\n', 'Gemini, Aquarius, Leo, Sagittarius', 'libra.png', 'Libra is an air sign. Air signs are rational, social, and love communication and relationships with other people. They are thinkers, friendly, intellectual, communicative and analytical. They love philosophical discussions, social gatherings and good books. They enjoy giving advice, but they can also be very superficial.'),
(8, 'Scorpio', 10, 23, 11, 21, 'Water', 'Scorpio is one of the most misunderstood signs of the zodiac. Because of its incredible passion and power, Scorpio is often mistaken for a fire sign. In fact, Scorpio is a water sign that derives its strength from the psychic, emotional realm. Like its fellow water signs, Cancer and Pisces, Scorpio is extremely clairvoyant and intuitive.\nWhat makes this water sign unique is its distinctive venomous sting. Like their celestial animal representation, the scorpion, Scorpios lie in wait and strike when least expected. Life is a game of chess for these calculating water signs, who are constantly plotting several steps ahead in order to orchestrate an eventual checkmate. This doesn\'t mean their intentions are necessarily nefarious. Scorpios simply know what they want and aren\'t afraid to work hard and play the long game to get it.', 'Cancer, Pisces, Virgo, Capricorn', 'scorpio.png', 'Scorpio is a water sign. Water signs are exceptionally emotional and ultra-sensitive. They are highly intuitive and they can be as mysterious as the ocean itself. Water signs love profound conversations and intimacy. They rarely do anything openly and are always there to support their loved ones.'),
(9, 'Sagittarius', 11, 22, 12, 21, 'Fire', 'The final fire sign of the zodiac, Sagittarius traits are unlike any other sign of the zodiac; they\'re totally unique to this brazen spirit.  What makes Sagittarius so unique is its dynamic blend of passion, curiosity, intensity, and adaptability. Represented by the archer (a half-man, half-horse centaur), Sagittarius isn\'t afraid to use its bow and arrow to explore expansive terrain, seeking answers in places and spaces others wouldn’t dare venture. Whether they\'re white water rafting down a river in some undisclosed location or taking a pilgrimage to a sacred site to uncover secrets about an ancient civilization, Sagittarius’ quest for knowledge knows no bounds.', 'Aries, Leo, Libra, Aquarius', 'sagittarius.png', 'Fire signs tend to be passionate, dynamic, and temperamental. They get angry quickly, but they also forgive easily. They are adventurers with immense energy. They are physically very strong and are a source of inspiration for others. Fire signs are intelligent, self-aware, creative and idealistic people, always ready for action. '),
(10, 'Capricorn', 12, 22, 1, 19, 'Earth', 'The last earth sign of the zodiac, Capricorns and their unique spirits are powerful, to say the least. Perhaps it\'s their fearless ambition? Their limitless resilience? Their ability to keep pushing forward, even in the face of challenging adversity and painful strife? Not everyone gets to see Capricorn ordering rounds of tequila, dancing on the table, and staying out until the crack of dawn—but that rebellious, untamed spirit is a Capricorn asset. Indeed, inside every earnest Capricorn is a mischievous troublemaker (in tarot, Capricorn is symbolized by the \"devil\" card). Though this earth sign may seem a bit conservative and restrained at first, Capricorn\'s closest friends and lovers know that these sea goats love to party.', 'Taurus, Virgo, Scorpio, Pisces', 'capricorn.png', 'Capricorn is an earth sign. Earth signs are “grounded” and the ones that bring us down to earth. They are mostly conservative and realistic, but they can also be very emotional. They are connected to our material reality and can be turned to material goods. They are practical, loyal and stable and they stick by their people through hard times.'),
(11, 'Aquarius', 1, 20, 2, 18, 'Air', 'One of the most ubiquitous, albeit innocuous, errors is that Aquarius (January 20 - February 18) is a water sign. As the eleventh and penultimate sign of the zodiac, Aquarius is actually the final air sign, which means it deals with air-related concepts  from a macro-perspective. Of all the zodiac signs, Aquarius is undoubtedly the most innovative, progressive, rebellious, and humanitarian. But while Aquarius can often be found planning a revolution or proudly flaunting their funky fashion sensibility, they also have an often overlooked sensitive side that requires appreciation, support, and love.', 'Gemini, Libra, Aries, Sagittarius', 'aquarius.png', 'Aquarius is an air sign. Air signs are rational, social, and love communication and relationships with other people. They are thinkers, friendly, intellectual, communicative and analytical. They love philosophical discussions, social gatherings and good books. They enjoy giving advice, but they can also be very superficial.'),
(12, 'Pisces', 2, 19, 3, 20, 'Water', 'Water sign Pisces is the last constellation of the zodiac. It\'s symbolized by two fish swimming in opposite directions, representing the constant division of Pisces\' attention between fantasy and reality. As the final sign, Pisces has absorbed every lesson—the joys and the pains, the hopes and the fears—learned by all of the other signs. This makes these fish the most psychic, empathetic, and compassionate creatures of the astrological wheel. With such immense sensitivity, Pisces can easily become swallowed by emotions and must remember to stay grounded in the material realm (appropriately, Pisces rules the feet).', 'Cancer, Scorpio, Taurus, Capricorn', 'pisces.png', 'Pisces is a water sign. Water signs are exceptionally emotional and ultra-sensitive. They are highly intuitive and they can be as mysterious as the ocean itself. Water signs love profound conversations and intimacy. They rarely do anything openly and are always there to support their loved ones.');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `astrology`
--
ALTER TABLE `astrology`
  ADD CONSTRAINT `fk_astrology_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_astrology_zodiac` FOREIGN KEY (`zodiac_id`) REFERENCES `zodiac_signs` (`zodiac_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_zodiac` FOREIGN KEY (`zodiac_id`) REFERENCES `zodiac_signs` (`zodiac_id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
