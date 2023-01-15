-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.19-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.2.0.6576
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for online_scorecard
CREATE DATABASE IF NOT EXISTS `online_scorecard` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `online_scorecard`;

-- Dumping structure for table online_scorecard.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table online_scorecard.categories: ~2 rows (approximately)
INSERT INTO `categories` (`id`, `name`, `description`, `created_by`, `updated_by`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Main Category', 'Description main category', 1, NULL, 1, '2022-12-10 09:11:52', NULL),
	(2, 'Critical Category', 'A critical category for evaluation', 1, 1, 1, '2022-12-25 01:25:09', '2023-01-03 21:24:36'),
	(3, 'Main Category 2', NULL, 1, NULL, 1, '2023-01-07 00:21:19', NULL);

-- Dumping structure for table online_scorecard.criterias
CREATE TABLE IF NOT EXISTS `criterias` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `subcategory_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table online_scorecard.criterias: ~6 rows (approximately)
INSERT INTO `criterias` (`id`, `subcategory_id`, `name`, `description`, `created_by`, `updated_by`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Criteria Main 1', 'Criteria for main 1', 1, 1, 1, '2023-01-01 00:21:10', '2023-01-03 23:04:25'),
	(2, 2, 'Critical Criteria 1', NULL, 1, 1, 1, '2023-01-01 00:41:21', '2023-01-03 21:26:05'),
	(3, 2, 'Critical Criteria 2', NULL, 1, NULL, 1, '2023-01-03 21:27:00', NULL),
	(4, 1, 'Criteria Main 2', NULL, 1, NULL, 1, '2023-01-03 23:04:42', NULL),
	(5, 5, 'Criteria 1 Main Category 2', NULL, 1, NULL, 1, '2023-01-07 00:34:56', NULL),
	(6, 5, 'Criteria 2 Main Category 2', NULL, 1, NULL, 1, '2023-01-07 00:35:45', NULL);

-- Dumping structure for table online_scorecard.departments
CREATE TABLE IF NOT EXISTS `departments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table online_scorecard.departments: ~0 rows (approximately)
INSERT INTO `departments` (`id`, `name`, `description`, `created_by`, `updated_by`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Management', 'Management and operation department', 1, 1, 1, '2022-12-03 18:52:59', '2022-12-10 09:15:25');

-- Dumping structure for table online_scorecard.department_categories
CREATE TABLE IF NOT EXISTS `department_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `department_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `category_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table online_scorecard.department_categories: ~3 rows (approximately)
INSERT INTO `department_categories` (`id`, `department_id`, `category_id`, `created_by`, `updated_by`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, 2, 1, 1, 1, '2022-12-18 07:38:51', '2022-12-25 01:32:16'),
	(4, 1, 1, 1, NULL, 1, '2023-01-03 23:05:06', NULL),
	(5, 1, 3, 1, NULL, 1, '2023-01-07 00:36:02', NULL);

-- Dumping structure for table online_scorecard.department_criterias
CREATE TABLE IF NOT EXISTS `department_criterias` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `department_subcategory_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `criteria_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `points` int(11) NOT NULL DEFAULT 0,
  `guidelines` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table online_scorecard.department_criterias: ~5 rows (approximately)
INSERT INTO `department_criterias` (`id`, `department_subcategory_id`, `criteria_id`, `points`, `guidelines`, `created_by`, `updated_by`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, 2, 15, NULL, 1, NULL, 1, '2023-01-01 06:53:29', NULL),
	(2, 3, 1, 15, NULL, 1, NULL, 1, '2023-01-03 23:19:27', NULL),
	(3, 3, 4, 15, NULL, 1, NULL, 1, '2023-01-03 23:19:43', NULL),
	(4, 4, 5, 10, NULL, 1, NULL, 1, '2023-01-07 06:57:18', NULL),
	(5, 4, 6, 10, NULL, 1, NULL, 1, '2023-01-07 06:57:48', NULL);

-- Dumping structure for table online_scorecard.department_subcategories
CREATE TABLE IF NOT EXISTS `department_subcategories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `department_category_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `subcategory_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `critical` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table online_scorecard.department_subcategories: ~3 rows (approximately)
INSERT INTO `department_subcategories` (`id`, `department_category_id`, `subcategory_id`, `critical`, `created_by`, `updated_by`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, 2, 'yes', 1, 1, 1, '2022-12-30 10:09:00', '2023-01-03 23:14:05'),
	(3, 4, 1, 'no', 1, NULL, 1, '2023-01-03 23:09:28', NULL),
	(4, 5, 5, 'no', 1, NULL, 1, '2023-01-07 00:40:44', NULL);

-- Dumping structure for table online_scorecard.evaluations
CREATE TABLE IF NOT EXISTS `evaluations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `department_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `supervisor_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `date_of_audit` date NOT NULL,
  `total_score` int(11) NOT NULL,
  `result` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `remarks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table online_scorecard.evaluations: ~1 rows (approximately)
INSERT INTO `evaluations` (`id`, `department_id`, `user_id`, `supervisor_id`, `date_of_audit`, `total_score`, `result`, `remarks`, `created_by`, `updated_by`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, 2, 1, '2023-01-14', 75, '1', NULL, 1, NULL, 0, '2023-01-14 07:45:05', NULL);

-- Dumping structure for table online_scorecard.evaluation_points
CREATE TABLE IF NOT EXISTS `evaluation_points` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `evaluation_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `department_criteria_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `points` int(11) NOT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `critical` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes',
  `perform` enum('yes','no','na') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes',
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table online_scorecard.evaluation_points: ~4 rows (approximately)
INSERT INTO `evaluation_points` (`id`, `evaluation_id`, `department_criteria_id`, `points`, `comments`, `critical`, `perform`, `created_by`, `updated_by`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, 2, 0, NULL, 'no', 'no', 1, NULL, 1, '2023-01-14 07:45:05', '2023-01-14 07:45:05'),
	(2, 1, 3, 15, NULL, 'no', 'yes', 1, NULL, 1, '2023-01-14 07:45:05', '2023-01-14 07:45:05'),
	(3, 1, 4, 10, NULL, 'no', 'yes', 1, NULL, 1, '2023-01-14 07:45:05', '2023-01-14 07:45:05'),
	(4, 1, 5, 10, NULL, 'no', 'yes', 1, NULL, 1, '2023-01-14 07:45:05', '2023-01-14 07:45:05');

-- Dumping structure for table online_scorecard.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table online_scorecard.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table online_scorecard.logs
CREATE TABLE IF NOT EXISTS `logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `action` enum('login','logout') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table online_scorecard.logs: ~0 rows (approximately)

-- Dumping structure for table online_scorecard.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table online_scorecard.migrations: ~15 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(6, '2014_10_12_000000_create_users_table', 2),
	(7, '2022_11_26_155703_create_roles_table', 2),
	(8, '2022_11_26_171407_create_logs_table', 3),
	(9, '2022_11_28_071420_create_departments_table', 4),
	(10, '2022_12_04_095227_create_passrates_table', 5),
	(11, '2022_12_10_160407_create_categories_table', 6),
	(13, '2022_12_11_065621_create_sub_categories_table', 7),
	(14, '2022_12_14_001858_create_criterias_table', 8),
	(15, '2022_12_18_113302_create_department_categories_table', 9),
	(16, '2022_12_18_175108_create_department_sub_categories_table', 10),
	(17, '2022_12_31_084159_create_department_criterias_table', 11),
	(18, '2023_01_02_110203_create_evaluations_table', 12),
	(19, '2023_01_12_061303_create_evaluation_points_table', 13);

-- Dumping structure for table online_scorecard.passrates
CREATE TABLE IF NOT EXISTS `passrates` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `department_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `rate` bigint(20) unsigned NOT NULL DEFAULT 0,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table online_scorecard.passrates: ~0 rows (approximately)
INSERT INTO `passrates` (`id`, `department_id`, `rate`, `created_by`, `updated_by`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, 88, 1, 1, 1, '2022-12-04 02:58:12', '2022-12-09 21:05:33');

-- Dumping structure for table online_scorecard.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table online_scorecard.password_resets: ~0 rows (approximately)

-- Dumping structure for table online_scorecard.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table online_scorecard.roles: ~2 rows (approximately)
INSERT INTO `roles` (`id`, `name`, `description`, `created_by`, `updated_by`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Administrator', 'System administrator', 1, NULL, 1, '2022-12-03 18:14:10', NULL),
	(2, 'User', 'Normal user', 1, 1, 1, '2022-12-03 21:40:22', '2022-12-04 00:39:36');

-- Dumping structure for table online_scorecard.subcategories
CREATE TABLE IF NOT EXISTS `subcategories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table online_scorecard.subcategories: ~6 rows (approximately)
INSERT INTO `subcategories` (`id`, `category_id`, `name`, `description`, `created_by`, `updated_by`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Sub Category Main', 'Sub Category for Main Category', 1, 1, 1, '2022-12-13 15:56:08', '2023-01-03 23:01:34'),
	(2, 2, 'Critical Subcategory 1', 'A critical subcategory 1', 1, 1, 1, '2022-12-28 05:01:42', '2023-01-03 21:25:11'),
	(3, 2, 'Critical Subcategory 2', 'A critical subcategory 2', 1, NULL, 1, '2023-01-03 21:25:33', NULL),
	(4, 1, 'Sub Category Main 2', NULL, 1, NULL, 1, '2023-01-03 23:02:00', NULL),
	(5, 3, 'Sub Category 1 Main Category 2', NULL, 1, NULL, 1, '2023-01-07 00:22:03', NULL),
	(6, 3, 'Sub Category 2 Main Category 2', NULL, 1, NULL, 1, '2023-01-07 00:22:24', NULL);

-- Dumping structure for table online_scorecard.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `department_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_verified` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table online_scorecard.users: ~2 rows (approximately)
INSERT INTO `users` (`id`, `role_id`, `department_id`, `name`, `email`, `email_verified_at`, `password`, `is_verified`, `status`, `created_by`, `updated_by`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 'Danil Azhar', 'danilazhar@gmail.com', NULL, '$2y$10$3ZFphl1Bg4NOzfalPQr2s.7dzkKQGP8TW6LkpsegkxFn3T6jHpEyS', 1, 1, 1, NULL, NULL, '2022-11-27 13:29:31', NULL),
	(2, 1, 1, 'Xander Cage', 'xander@yopmail.com', NULL, '$2y$10$tNdjNGBH/S2BJuc8CgjX0.2jvgPmLLoNqF8r4Rt01Z9DKBp9YdYlq', 1, 1, 1, 1, NULL, '2022-12-03 21:39:48', '2022-12-03 22:27:22');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
