# ************************************************************
# Sequel Ace SQL dump
# Version 20037
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: localhost (MySQL 8.0.28)
# Database: online_scorecard
# Generation Time: 2023-01-09 09:51:30 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;

INSERT INTO `categories` (`id`, `name`, `description`, `created_by`, `updated_by`, `status`, `created_at`, `updated_at`)
VALUES
	(1,'Main Category','Description main category',1,NULL,1,'2022-12-10 17:11:52',NULL),
	(2,'Critical Category','A critical category for evaluation',1,1,1,'2022-12-25 09:25:09','2023-01-04 05:24:36'),
	(3,'Main Category 2',NULL,1,NULL,1,'2023-01-07 08:21:19',NULL);

/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table criterias
# ------------------------------------------------------------

DROP TABLE IF EXISTS `criterias`;

CREATE TABLE `criterias` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `subcategory_id` bigint unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `criterias` WRITE;
/*!40000 ALTER TABLE `criterias` DISABLE KEYS */;

INSERT INTO `criterias` (`id`, `subcategory_id`, `name`, `description`, `created_by`, `updated_by`, `status`, `created_at`, `updated_at`)
VALUES
	(1,1,'Criteria Main 1','Criteria for main 1',1,1,1,'2023-01-01 08:21:10','2023-01-04 07:04:25'),
	(2,2,'Critical Criteria 1',NULL,1,1,1,'2023-01-01 08:41:21','2023-01-04 05:26:05'),
	(3,2,'Critical Criteria 2',NULL,1,NULL,1,'2023-01-04 05:27:00',NULL),
	(4,1,'Criteria Main 2',NULL,1,NULL,1,'2023-01-04 07:04:42',NULL),
	(5,5,'Criteria 1 Main Category 2',NULL,1,NULL,1,'2023-01-07 08:34:56',NULL),
	(6,5,'Criteria 2 Main Category 2',NULL,1,NULL,1,'2023-01-07 08:35:45',NULL);

/*!40000 ALTER TABLE `criterias` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table department_categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `department_categories`;

CREATE TABLE `department_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `department_id` bigint unsigned NOT NULL DEFAULT '0',
  `category_id` bigint unsigned NOT NULL DEFAULT '0',
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `department_categories` WRITE;
/*!40000 ALTER TABLE `department_categories` DISABLE KEYS */;

INSERT INTO `department_categories` (`id`, `department_id`, `category_id`, `created_by`, `updated_by`, `status`, `created_at`, `updated_at`)
VALUES
	(1,1,2,1,1,1,'2022-12-18 15:38:51','2022-12-25 09:32:16'),
	(4,1,1,1,NULL,1,'2023-01-04 07:05:06',NULL),
	(5,1,3,1,NULL,1,'2023-01-07 08:36:02',NULL);

/*!40000 ALTER TABLE `department_categories` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table department_criterias
# ------------------------------------------------------------

DROP TABLE IF EXISTS `department_criterias`;

CREATE TABLE `department_criterias` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `department_subcategory_id` bigint unsigned NOT NULL DEFAULT '0',
  `criteria_id` bigint unsigned NOT NULL DEFAULT '0',
  `points` int NOT NULL DEFAULT '0',
  `guidelines` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `department_criterias` WRITE;
/*!40000 ALTER TABLE `department_criterias` DISABLE KEYS */;

INSERT INTO `department_criterias` (`id`, `department_subcategory_id`, `criteria_id`, `points`, `guidelines`, `created_by`, `updated_by`, `status`, `created_at`, `updated_at`)
VALUES
	(1,1,2,15,NULL,1,NULL,1,'2023-01-01 14:53:29',NULL),
	(2,3,1,15,NULL,1,NULL,1,'2023-01-04 07:19:27',NULL),
	(3,3,4,15,NULL,1,NULL,1,'2023-01-04 07:19:43',NULL),
	(4,4,5,10,NULL,1,NULL,1,'2023-01-07 14:57:18',NULL),
	(5,4,6,10,NULL,1,NULL,1,'2023-01-07 14:57:48',NULL);

/*!40000 ALTER TABLE `department_criterias` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table department_subcategories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `department_subcategories`;

CREATE TABLE `department_subcategories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `department_category_id` bigint unsigned NOT NULL DEFAULT '0',
  `subcategory_id` bigint unsigned NOT NULL DEFAULT '0',
  `critical` int NOT NULL DEFAULT '0',
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `department_subcategories` WRITE;
/*!40000 ALTER TABLE `department_subcategories` DISABLE KEYS */;

INSERT INTO `department_subcategories` (`id`, `department_category_id`, `subcategory_id`, `critical`, `created_by`, `updated_by`, `status`, `created_at`, `updated_at`)
VALUES
	(1,1,2,1,1,1,1,'2022-12-30 18:09:00','2023-01-04 07:14:05'),
	(3,4,1,0,1,NULL,1,'2023-01-04 07:09:28',NULL),
	(4,5,5,0,1,NULL,1,'2023-01-07 08:40:44',NULL);

/*!40000 ALTER TABLE `department_subcategories` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table departments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `departments`;

CREATE TABLE `departments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;

INSERT INTO `departments` (`id`, `name`, `description`, `created_by`, `updated_by`, `status`, `created_at`, `updated_at`)
VALUES
	(1,'Management','Management and operation department',1,1,1,'2022-12-04 02:52:59','2022-12-10 17:15:25');

/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table evaluations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `evaluations`;

CREATE TABLE `evaluations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `department_id` bigint unsigned NOT NULL DEFAULT '0',
  `user_id` bigint unsigned NOT NULL DEFAULT '0',
  `supervisor_id` bigint unsigned NOT NULL DEFAULT '0',
  `date_of_audit` date NOT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `total_score` int NOT NULL,
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table failed_jobs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table logs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `logs`;

CREATE TABLE `logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL DEFAULT '0',
  `action` enum('login','logout') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES
	(2,'2014_10_12_100000_create_password_resets_table',1),
	(3,'2019_08_19_000000_create_failed_jobs_table',1),
	(6,'2014_10_12_000000_create_users_table',2),
	(7,'2022_11_26_155703_create_roles_table',2),
	(8,'2022_11_26_171407_create_logs_table',3),
	(9,'2022_11_28_071420_create_departments_table',4),
	(10,'2022_12_04_095227_create_passrates_table',5),
	(11,'2022_12_10_160407_create_categories_table',6),
	(13,'2022_12_11_065621_create_sub_categories_table',7),
	(14,'2022_12_14_001858_create_criterias_table',8),
	(15,'2022_12_18_113302_create_department_categories_table',9),
	(16,'2022_12_18_175108_create_department_sub_categories_table',10),
	(17,'2022_12_31_084159_create_department_criterias_table',11),
	(18,'2023_01_02_110203_create_evaluations_table',12);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table passrates
# ------------------------------------------------------------

DROP TABLE IF EXISTS `passrates`;

CREATE TABLE `passrates` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `department_id` bigint unsigned NOT NULL DEFAULT '0',
  `rate` bigint unsigned NOT NULL DEFAULT '0',
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `passrates` WRITE;
/*!40000 ALTER TABLE `passrates` DISABLE KEYS */;

INSERT INTO `passrates` (`id`, `department_id`, `rate`, `created_by`, `updated_by`, `status`, `created_at`, `updated_at`)
VALUES
	(1,1,88,1,1,1,'2022-12-04 10:58:12','2022-12-10 05:05:33');

/*!40000 ALTER TABLE `passrates` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table password_resets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;

INSERT INTO `roles` (`id`, `name`, `description`, `created_by`, `updated_by`, `status`, `created_at`, `updated_at`)
VALUES
	(1,'Administrator','System administrator',1,NULL,1,'2022-12-04 02:14:10',NULL),
	(2,'User','Normal user',1,1,1,'2022-12-04 05:40:22','2022-12-04 08:39:36');

/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table subcategories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `subcategories`;

CREATE TABLE `subcategories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `subcategories` WRITE;
/*!40000 ALTER TABLE `subcategories` DISABLE KEYS */;

INSERT INTO `subcategories` (`id`, `category_id`, `name`, `description`, `created_by`, `updated_by`, `status`, `created_at`, `updated_at`)
VALUES
	(1,1,'Sub Category Main','Sub Category for Main Category',1,1,1,'2022-12-13 23:56:08','2023-01-04 07:01:34'),
	(2,2,'Critical Subcategory 1','A critical subcategory 1',1,1,1,'2022-12-28 13:01:42','2023-01-04 05:25:11'),
	(3,2,'Critical Subcategory 2','A critical subcategory 2',1,NULL,1,'2023-01-04 05:25:33',NULL),
	(4,1,'Sub Category Main 2',NULL,1,NULL,1,'2023-01-04 07:02:00',NULL),
	(5,3,'Sub Category 1 Main Category 2',NULL,1,NULL,1,'2023-01-07 08:22:03',NULL),
	(6,3,'Sub Category 2 Main Category 2',NULL,1,NULL,1,'2023-01-07 08:22:24',NULL);

/*!40000 ALTER TABLE `subcategories` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint unsigned NOT NULL DEFAULT '0',
  `department_id` bigint unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_verified` int NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '0',
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `role_id`, `department_id`, `name`, `email`, `email_verified_at`, `password`, `is_verified`, `status`, `created_by`, `updated_by`, `remember_token`, `created_at`, `updated_at`)
VALUES
	(1,1,1,'Danil Azhar','danilazhar@gmail.com',NULL,'$2y$10$3ZFphl1Bg4NOzfalPQr2s.7dzkKQGP8TW6LkpsegkxFn3T6jHpEyS',1,1,1,NULL,NULL,'2022-11-27 21:29:31',NULL),
	(2,1,1,'Xander Cage','xander@yopmail.com',NULL,'$2y$10$tNdjNGBH/S2BJuc8CgjX0.2jvgPmLLoNqF8r4Rt01Z9DKBp9YdYlq',0,0,1,1,NULL,'2022-12-04 05:39:48','2022-12-04 06:27:22');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
