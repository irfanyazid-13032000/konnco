-- Adminer 4.8.1 MySQL 5.7.39 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `carts`;
CREATE TABLE `carts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` bigint(20) unsigned NOT NULL,
  `qty` int(11) NOT NULL,
  `customer_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  KEY `item_id` (`item_id`),
  CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `carts` (`id`, `item_id`, `qty`, `customer_id`, `created_at`, `updated_at`) VALUES
(8,	1,	1,	1,	'2024-12-13 07:43:41',	'2024-12-13 07:43:41');

DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customers_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `customers` (`id`, `full_name`, `email`, `password`, `address`, `created_at`, `updated_at`) VALUES
(1,	'yazid',	'yazid@gmail.com',	'$2y$10$cfSewzzFSwt5S0GouIF0TuNzXAgUcGIBV4Ic9e/udYhC1kEx1nO52',	'jombang',	'2024-12-12 00:50:32',	'2024-12-12 00:50:32'),
(2,	'irfan',	'irfan@gmail.com',	'$2y$10$BHDriIEt7dju40kEaN7XOeCPX3MkwnaI9dHMkoRBLHKRhRA70Axt6',	'surabaya',	'2024-12-12 06:56:02',	'2024-12-12 06:56:02'),
(3,	'roni',	'roni@gmail.com',	'$2y$10$QzhONxsyeP1JGJpkIPYDfuDv4Fid.5.KBGTtPUKvXiE7mcbpOViZO',	'gak punya rumah',	'2024-12-15 02:40:02',	'2024-12-15 02:40:02');

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `items`;
CREATE TABLE `items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `items` (`id`, `name`, `stock`, `price`, `status`, `image`, `description`, `created_at`, `updated_at`) VALUES
(1,	'rexus daxa',	0,	1000,	0,	'01JETZ7JHZPEBSXMA6VCBCC3S1.jpg',	'ini adalah sebuah stik yang sangat bagus',	'2024-12-11 06:41:13',	'2024-12-16 09:19:34'),
(2,	'Xinmeng M75 Pro',	5,	1500,	1,	'01JEV082K84PM5BA5ZD5KNHVBY.jpg',	'keyboard bagus yang ingin kubeli',	'2024-12-11 06:58:58',	'2024-12-11 06:58:58');

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1,	'2014_10_12_000000_create_users_table',	1),
(2,	'2014_10_12_100000_create_password_reset_tokens_table',	1),
(3,	'2019_08_19_000000_create_failed_jobs_table',	1),
(4,	'2019_12_14_000001_create_personal_access_tokens_table',	1),
(8,	'2024_12_10_124259_create_items_table',	2),
(10,	'2024_12_12_072815_create_customers_table',	3),
(11,	'2024_12_12_124310_create_carts_table',	4),
(12,	'2024_12_13_144733_create_orders_table',	5),
(14,	'2024_12_14_084109_create_order_details_table',	6);

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `receipt_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` bigint(20) unsigned NOT NULL,
  `total_order` int(11) NOT NULL,
  `paid` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  UNIQUE KEY `orders_receipt_number_unique` (`receipt_number`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `orders` (`receipt_number`, `customer_id`, `total_order`, `paid`, `created_at`, `updated_at`) VALUES
('agtrqxC85rPG86R64cUZfPkSwryuxUVu7LYirZdo',	2,	2000,	0,	'2024-12-16 06:47:18',	'2024-12-16 06:47:18'),
('ASvKdHCpFVIgpfdNKI28olZDNsm6mFRiQ81i8JbW',	2,	1000,	0,	'2024-12-16 09:10:54',	'2024-12-16 09:10:54'),
('Azvaey445jULCFqUePUlpp5GWl3vCLs9SGc0HtBb',	2,	2000,	0,	'2024-12-16 06:27:56',	'2024-12-16 06:27:56'),
('cw8gnSZ0WQ2dkpYvm5YHmGyeEaauCAJRXZsrOF27',	2,	0,	0,	'2024-12-16 09:03:59',	'2024-12-16 09:03:59'),
('ER2cG78ZJdi5Dq1i3iSfe5GGPvPrzVfsx6TlIDng',	2,	2000,	0,	'2024-12-16 06:43:01',	'2024-12-16 06:43:01'),
('EY9mgRuD01HiUU1NnAWHPkfuYwpEWXZLDqzgPvb6',	2,	0,	0,	'2024-12-16 09:05:42',	'2024-12-16 09:05:42'),
('g0QIenKByFyMQyakVEnuv4rJRltt9ZBDiqUCeikk',	2,	4000,	0,	'2024-12-16 09:06:06',	'2024-12-16 09:06:06'),
('g412YHg1dEvdxceSbMatLdNgICzTASnthAfAQtwB',	2,	0,	0,	'2024-12-16 09:04:25',	'2024-12-16 09:04:25'),
('HxvcHsWRc5nxFSKtLBTaopWPJTXQRx1kDtpLc4xm',	2,	0,	0,	'2024-12-16 09:05:10',	'2024-12-16 09:05:10'),
('i4nLhMn3GCBjuz0qoIqadpTC0ZTwAQPXXo59LOsL',	2,	3000,	0,	'2024-12-16 09:18:37',	'2024-12-16 09:18:37'),
('ip7xfZyoqzX0nZug3l8shgABQSFYOmNvAG6szURU',	2,	2000,	0,	'2024-12-16 06:39:17',	'2024-12-16 06:39:17'),
('oPDKfbYMUDQo0VZzs7aKdIWhAXjk4Q0QmPby38rl',	2,	3000,	0,	'2024-12-16 06:15:18',	'2024-12-16 06:15:18'),
('rbuWwgFhNltwTON6gPdWiVQr2MPoEuH0R7CrM35v',	2,	2000,	0,	'2024-12-16 06:41:08',	'2024-12-16 06:41:08');

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE `order_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `receipt_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int(11) NOT NULL,
  `item_id` bigint(20) unsigned NOT NULL,
  `price` int(11) NOT NULL,
  `total_price_per_item` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`),
  CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `order_details` (`id`, `receipt_number`, `qty`, `item_id`, `price`, `total_price_per_item`, `created_at`, `updated_at`) VALUES
(41,	'oPDKfbYMUDQo0VZzs7aKdIWhAXjk4Q0QmPby38rl',	3,	1,	1000,	3000,	'2024-12-16 06:15:18',	'2024-12-16 06:15:18'),
(42,	'Azvaey445jULCFqUePUlpp5GWl3vCLs9SGc0HtBb',	2,	1,	1000,	2000,	'2024-12-16 06:27:56',	'2024-12-16 06:27:56'),
(43,	'ip7xfZyoqzX0nZug3l8shgABQSFYOmNvAG6szURU',	2,	1,	1000,	2000,	'2024-12-16 06:39:17',	'2024-12-16 06:39:17'),
(44,	'rbuWwgFhNltwTON6gPdWiVQr2MPoEuH0R7CrM35v',	2,	1,	1000,	2000,	'2024-12-16 06:41:08',	'2024-12-16 06:41:08'),
(45,	'ER2cG78ZJdi5Dq1i3iSfe5GGPvPrzVfsx6TlIDng',	2,	1,	1000,	2000,	'2024-12-16 06:43:01',	'2024-12-16 06:43:01'),
(46,	'agtrqxC85rPG86R64cUZfPkSwryuxUVu7LYirZdo',	2,	1,	1000,	2000,	'2024-12-16 06:47:18',	'2024-12-16 06:47:18'),
(47,	'g0QIenKByFyMQyakVEnuv4rJRltt9ZBDiqUCeikk',	4,	1,	1000,	4000,	'2024-12-16 09:06:06',	'2024-12-16 09:06:06'),
(48,	'ASvKdHCpFVIgpfdNKI28olZDNsm6mFRiQ81i8JbW',	1,	1,	1000,	1000,	'2024-12-16 09:10:54',	'2024-12-16 09:10:54'),
(49,	'i4nLhMn3GCBjuz0qoIqadpTC0ZTwAQPXXo59LOsL',	3,	1,	1000,	3000,	'2024-12-16 09:18:37',	'2024-12-16 09:18:37');

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1,	'jihu',	'jihu@gmail.com',	NULL,	'$2y$10$ufRrYhdBoVZShyeU7M.wf.YTQE/yVOMuS01tdRcsfb4mfJtw6rx.C',	NULL,	'2024-12-10 02:13:01',	'2024-12-10 02:13:01');

-- 2024-12-16 17:37:30
