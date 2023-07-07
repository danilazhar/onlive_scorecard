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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table online_scorecard.categories: ~4 rows (approximately)
INSERT INTO `categories` (`id`, `name`, `description`, `created_by`, `updated_by`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Time Management', 'Time management evaluation', 1, 1, 1, '2023-07-07 01:58:50', '2023-07-07 01:59:54'),
	(2, 'Attitude', 'Attitude evaluation', 1, NULL, 1, '2023-07-07 02:01:54', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table online_scorecard.criterias: ~6 rows (approximately)
INSERT INTO `criterias` (`id`, `subcategory_id`, `name`, `description`, `created_by`, `updated_by`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Swipe access card for clock in before or at 9 AM', NULL, 1, NULL, 1, '2023-07-07 02:03:47', NULL),
	(2, 1, 'Swipe access card for clock out after 6 PM', 'Leave the office when the shift is done', 1, NULL, 1, '2023-07-07 02:04:57', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table online_scorecard.departments: ~2 rows (approximately)
INSERT INTO `departments` (`id`, `name`, `description`, `created_by`, `updated_by`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Management', 'Management and operation department', 1, NULL, 1, '2023-07-03 09:22:04', NULL),
	(2, 'Finance', 'Financial department', 1, NULL, 1, '2023-07-07 01:35:13', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table online_scorecard.department_categories: ~3 rows (approximately)
INSERT INTO `department_categories` (`id`, `department_id`, `category_id`, `created_by`, `updated_by`, `status`, `created_at`, `updated_at`) VALUES
	(1, 2, 1, 2, NULL, 1, '2023-07-07 02:34:24', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table online_scorecard.department_criterias: ~5 rows (approximately)
INSERT INTO `department_criterias` (`id`, `department_subcategory_id`, `criteria_id`, `points`, `guidelines`, `created_by`, `updated_by`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 5, NULL, 2, NULL, 1, '2023-07-07 02:37:52', NULL),
	(2, 1, 2, 5, NULL, 2, NULL, 1, '2023-07-07 02:38:09', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table online_scorecard.department_subcategories: ~3 rows (approximately)
INSERT INTO `department_subcategories` (`id`, `department_category_id`, `subcategory_id`, `critical`, `created_by`, `updated_by`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 'yes', 2, NULL, 1, '2023-07-07 02:34:40', NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table online_scorecard.evaluations: ~0 rows (approximately)

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table online_scorecard.evaluation_points: ~5 rows (approximately)

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

-- Dumping data for table online_scorecard.migrations: ~14 rows (approximately)
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
	(1, 2, 90, 2, NULL, 1, '2023-07-07 02:38:23', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table online_scorecard.roles: ~3 rows (approximately)
INSERT INTO `roles` (`id`, `name`, `description`, `created_by`, `updated_by`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'System Administrator', 'System administrator', 1, NULL, 1, '2023-07-03 09:22:51', NULL),
	(2, 'Staff', 'Normal employee user', 1, NULL, 1, '2023-07-03 09:23:23', NULL),
	(3, 'Manager', 'Manager user role', 1, NULL, 1, '2023-07-06 16:27:34', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table online_scorecard.subcategories: ~1 rows (approximately)
INSERT INTO `subcategories` (`id`, `category_id`, `name`, `description`, `created_by`, `updated_by`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Punctuality', 'Punctuality coming to office', 1, NULL, 1, '2023-07-07 02:02:18', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table online_scorecard.users: ~5 rows (approximately)
INSERT INTO `users` (`id`, `role_id`, `department_id`, `name`, `email`, `email_verified_at`, `password`, `is_verified`, `status`, `created_by`, `updated_by`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 'Danil Azhar', 'danilazhar@gmail.com', NULL, '$2y$10$3ZFphl1Bg4NOzfalPQr2s.7dzkKQGP8TW6LkpsegkxFn3T6jHpEyS', 1, 1, 1, NULL, NULL, '2022-11-27 13:29:31', NULL),
	(2, 3, 1, 'Xander Cage', 'xander@yopmail.com', NULL, '$2y$10$3ZFphl1Bg4NOzfalPQr2s.7dzkKQGP8TW6LkpsegkxFn3T6jHpEyS', 1, 1, 1, 1, NULL, '2022-12-03 21:39:48', '2023-07-03 09:23:35'),
	(6, 2, 2, 'Ahmad Kamil', 'kamil@yopmail.com', NULL, '$2y$10$ptOBfn266ZJ/Od2Bkj9Lj.zDmkGRzRksgTLYIPlYAwOyEsZjyX30y', 1, 1, 1, 1, NULL, '2023-07-07 01:34:52', '2023-07-07 01:35:29'),
	(7, 2, 2, 'Farah Syakila', 'farah.syakila@yopmail.com', NULL, '$2y$10$vBNYg4HeiTG.chyuSNR08u2aW4aoL9HYdzqLv.KOFSMJSsEQh1FJO', 1, 1, 1, 1, NULL, '2023-07-07 01:36:10', '2023-07-07 01:37:08'),
	(8, 3, 2, 'Ishida Uryu', 'uryu@yopmail.com', NULL, '$2y$10$t1C0luBson.XUqMWDl5wtudEGmFl3avGdFfo0Gnp20OJzDKJjSMaO', 1, 1, 1, 1, NULL, '2023-07-07 01:36:55', '2023-07-07 01:37:02');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
