-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 07, 2021 at 12:00 PM
-- Server version: 5.7.34-0ubuntu0.18.04.1
-- PHP Version: 7.3.21-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spyonautos`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `main_images_history`
--

CREATE TABLE `main_images_history` (
  `id` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `scrape_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `main_images_history`
--

INSERT INTO `main_images_history` (`id`, `productId`, `url`, `image`, `scrape_date`, `created_at`, `updated_at`) VALUES
(1, 1, 'https://m.atcdn.co.uk/a/media/w340h255pf7f7f5/aab542b2a66e4c1d9ebce3e3cd45735b.jpg', NULL, '2021-04-26 04:02:22', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(2, 2, 'https://m.atcdn.co.uk/a/media/w340h255pf7f7f5/4efca0f780e8489a9498208661faf21a.jpg', NULL, '2021-04-26 04:02:24', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(3, 3, 'https://m.atcdn.co.uk/a/media/w340h255pf7f7f5/1c2eba8b5e2d46d29efd8d92eb3531d7.jpg', NULL, '2021-04-26 04:02:24', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(4, 4, 'https://m.atcdn.co.uk/a/media/w340h255pf7f7f5/4e33a61c47e24d45a40d08159ea5b99d.jpg', NULL, '2021-04-26 04:02:34', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(5, 5, 'https://m.atcdn.co.uk/a/media/w340h255pf7f7f5/47f4c0c4f23242bca6fd609e03622df4.jpg', NULL, '2021-04-26 04:02:42', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(6, 6, 'https://m.atcdn.co.uk/a/media/w340h255pf7f7f5/71d06108cf5a4c81b4ddb62de84383f1.jpg', NULL, '2021-04-26 04:02:56', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(7, 7, 'https://m.atcdn.co.uk/a/media/w340h255pf7f7f5/be7083d62b1244738bd34f6b721634fd.jpg', NULL, '2021-04-26 04:02:57', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(8, 8, 'https://m.atcdn.co.uk/a/media/w340h255pf7f7f5/217c2054b53945aaa74772450b7c1aee.jpg', NULL, '2021-04-26 04:03:05', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(9, 9, 'https://m.atcdn.co.uk/a/media/w340h255pf7f7f5/1f13630ea22a44a0b831daa73537c6f6.jpg', NULL, '2021-04-26 04:03:06', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(10, 10, 'https://m.atcdn.co.uk/a/media/w340h255pf7f7f5/babec1e6efc44c55995f3abe10600699.jpg', NULL, '2021-04-26 04:03:06', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(11, 13, 'https://usedcars.renault.co.uk/picserver1/userdata/46/501603/YhfWulbqJr/kfz1369581_kfz_1369581_1.jpg', NULL, '2021-04-02 04:03:10', '2021-05-28 04:20:37', '2021-05-28 04:20:37'),
(12, 14, 'https://usedcars.renault.co.uk/picserver1/userdata/46/501584/YhfVCmbqJr/kfz1323477_kfz_1323477_1.jpg', NULL, '2021-04-02 04:03:11', '2021-05-28 04:20:37', '2021-05-28 04:20:37'),
(13, 15, 'https://usedcars.renault.co.uk/picserver1/userdata/46/501596/YhfVDobqJr/kfz1309511_kfz_1309511_1.jpg', NULL, '2021-04-02 04:03:11', '2021-05-28 04:20:37', '2021-05-28 04:20:37');

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
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('15a06aff70767384ed5afbdbc3ff18300fa4b73c74c024bde26e3d06354b868e1354dd8f9e779c34', 1, 1, 'MyApp', '[]', 0, '2021-05-30 23:04:15', '2021-05-30 23:04:15', '2022-05-31 04:34:15'),
('736dd7b4a78a56f2cafbb09c6502926c52d797134c03475838bb136fc44a1a005b7ef0ae56eac343', 3, 1, 'MyApp', '[]', 0, '2021-06-02 23:55:27', '2021-06-02 23:55:27', '2022-06-03 05:25:27'),
('88b39aea68d8022792ed05bef082b8134cc32b031c3deaf4668ee290b781e9e75d5ae2a43a0fe6c0', 2, 1, 'MyApp', '[]', 0, '2021-05-26 05:55:56', '2021-05-26 05:55:56', '2022-05-26 11:25:56'),
('89308468d180e4dea75c82af63f3453f2dd98de31dbb39f3cd83b835c364431f61d592e4fc341266', 3, 1, 'MyApp', '[]', 0, '2021-05-26 07:06:31', '2021-05-26 07:06:31', '2022-05-26 12:36:31'),
('ab6ad6d8c1935e5461e5b816463b16586854379030215bdc596612781df9b60b444b1d334948e576', 2, 1, 'MyApp', '[]', 0, '2021-05-30 23:25:42', '2021-05-30 23:25:42', '2022-05-31 04:55:42'),
('bc502d6335b0818ba9684b00bc25fe3e998ab6266354e575debb8c04fd5d1d8cc7af4a5d2a635ad7', 4, 1, 'MyApp', '[]', 0, '2021-05-26 22:54:29', '2021-05-26 22:54:29', '2022-05-27 04:24:29'),
('c49cfa127408839e6232fd9b2e706bda48e1796e862b2e331d8bad49916892abd6ed3ad6673c9e10', 5, 1, 'MyApp', '[]', 0, '2021-05-28 05:06:18', '2021-05-28 05:06:18', '2022-05-28 10:36:18'),
('c7f609135849db13d17a71deaa532e31b324538e08c1e875cb59625742dc76c87ef3ef335569d90d', 1, 1, 'MyApp', '[]', 0, '2021-05-25 01:58:13', '2021-05-25 01:58:13', '2022-05-25 07:28:13'),
('de791be26776d53b3e7303c2c116cc578f95512f3d6a52505859938bafbc1d8910469d8877ecd3af', 5, 1, 'MyApp', '[]', 0, '2021-06-07 00:12:10', '2021-06-07 00:12:10', '2022-06-07 05:42:10'),
('f92ff70978ac07f78210ab07d8948063a3dec7c6c6b156b89371596badbb4870cbb5e2b39ed21e74', 4, 1, 'MyApp', '[]', 0, '2021-06-06 22:25:54', '2021-06-06 22:25:54', '2022-06-07 03:55:54');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', '0wHlKN8DUkZPc3jD6hznqBht8aHpErahVATGBXUL', NULL, 'http://localhost', 1, 0, 0, '2021-05-25 01:41:51', '2021-05-25 01:41:51'),
(2, NULL, 'Laravel Password Grant Client', 'srtO9ZkChW0reRjNHy9eg2pLplqNBl1i8htMupa9', 'users', 'http://localhost', 0, 1, 0, '2021-05-25 01:41:51', '2021-05-25 01:41:51');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2021-05-25 01:41:51', '2021-05-25 01:41:51');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `price_history`
--

CREATE TABLE `price_history` (
  `id` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `price` float NOT NULL,
  `scrape_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `price_history`
--

INSERT INTO `price_history` (`id`, `productId`, `price`, `scrape_date`, `created_at`, `updated_at`) VALUES
(1, 1, 129995, '2021-04-26 04:02:22', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(2, 2, 129950, '2021-04-26 04:02:24', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(3, 3, 156995, '2021-04-26 04:02:24', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(4, 4, 215000, '2021-04-26 04:02:34', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(5, 5, 189000, '2021-04-26 04:02:42', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(6, 6, 46995, '2021-04-26 04:02:56', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(7, 7, 47950, '2021-04-26 04:02:57', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(8, 8, 18899, '2021-04-26 04:03:05', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(9, 9, 18818, '2021-04-26 04:03:06', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(10, 10, 47290, '2021-04-26 04:03:06', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(11, 11, 24990, '2021-04-02 04:03:10', '2021-05-28 04:20:37', '2021-05-28 04:20:37'),
(12, 15, 23333, '2021-04-02 04:03:10', '2021-05-28 04:20:37', '2021-05-28 04:20:37'),
(13, 14, 23995, '2021-04-02 04:03:10', '2021-05-28 04:20:37', '2021-05-28 04:20:37'),
(14, 13, 23990, '2021-04-02 04:03:11', '2021-05-28 04:20:37', '2021-05-28 04:20:37'),
(15, 12, 22799, '2021-04-02 04:03:11', '2021-05-28 04:20:37', '2021-05-28 04:20:37');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `portal` int(11) NOT NULL DEFAULT '0' COMMENT '1="Autotrader", 2="Renault"',
  `reg_date` date DEFAULT NULL,
  `price` float NOT NULL,
  `thumb_image_count` int(11) NOT NULL DEFAULT '0',
  `image_count` int(11) NOT NULL DEFAULT '0',
  `main_image` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `seller` varchar(255) DEFAULT NULL,
  `review_score` varchar(255) DEFAULT NULL,
  `review_count` int(11) NOT NULL DEFAULT '0',
  `url` varchar(500) NOT NULL,
  `scrape_date` datetime DEFAULT NULL,
  `has_video` varchar(255) DEFAULT NULL,
  `listing_id` varchar(255) NOT NULL,
  `listing_date` date DEFAULT NULL,
  `car_id` int(11) DEFAULT '0',
  `reg_year` varchar(11) DEFAULT NULL,
  `body_type` varchar(255) DEFAULT NULL,
  `mileage` varchar(50) DEFAULT NULL,
  `engine` varchar(50) DEFAULT NULL,
  `hp` varchar(50) DEFAULT NULL,
  `transmission` varchar(50) DEFAULT NULL,
  `fuel` varchar(50) DEFAULT NULL,
  `vrm` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `portal`, `reg_date`, `price`, `thumb_image_count`, `image_count`, `main_image`, `location`, `seller`, `review_score`, `review_count`, `url`, `scrape_date`, `has_video`, `listing_id`, `listing_date`, `car_id`, `reg_year`, `body_type`, `mileage`, `engine`, `hp`, `transmission`, `fuel`, `vrm`, `created_at`, `updated_at`) VALUES
(1, 'Lamborghini Huracan', NULL, 1, NULL, 129995, 3, 4, 'https://m.atcdn.co.uk/a/media/w340h255pf7f7f5/aab542b2a66e4c1d9ebce3e3cd45735b.jpg', 'rochford', 'Betterthanpartex Ltd', '4.9', 159, 'https://www.autotrader.co.uk/car-details/202012036722400?price-to=187500&sort=datedesc&radius=1500&onesearchad=New&onesearchad=Nearly%20New&onesearchad=Used&advertising-location=at_cars&price-from=125000&postcode=rg12lu&include-delivery-option=on&year-to=2021&page=72', '2021-04-26 04:02:22', 'false', '202012036722400', '2020-12-03', 6722400, '2015', 'Coupe', '22000', '5.2L', '610', 'Automatic', 'Petrol', 'SH14NEG', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(2, 'Mercedes-Benz C Class', NULL, 1, NULL, 129950, 3, 4, 'https://m.atcdn.co.uk/a/media/w340h255pf7f7f5/4efca0f780e8489a9498208661faf21a.jpg', 'watford', 'Exclusive Autos Ltd', '4.8', 131, 'https://www.autotrader.co.uk/car-details/202101017559665?advertising-location=at_cars&sort=datedesc&price-from=125000&radius=1500&onesearchad=New&onesearchad=Nearly%20New&onesearchad=Used&include-delivery-option=on&price-to=187500&year-to=2021&postcode=rg12lu&page=68', '2021-04-26 04:02:24', 'false', '202101017559665', '2021-01-01', 7559665, '2012', 'Coupe', '17000', '6.3L', '517', 'Automatic', 'Petrol', 'BL12ACK', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(3, 'Porsche 911', NULL, 1, NULL, 156995, 3, 4, 'https://m.atcdn.co.uk/a/media/w340h255pf7f7f5/1c2eba8b5e2d46d29efd8d92eb3531d7.jpg', 'manchester', 'Bespoke20', '5', 13, 'https://www.autotrader.co.uk/car-details/202012297486558?advertising-location=at_cars&sort=datedesc&price-from=125000&radius=1500&onesearchad=New&onesearchad=Nearly%20New&onesearchad=Used&include-delivery-option=on&price-to=187500&year-to=2021&postcode=rg12lu&page=68', '2021-04-26 04:02:24', 'false', '202012297486558', '2020-12-29', 7486558, '2015', 'Coupe', '16000', '4.0L', '507', 'Automatic', 'Petrol', '1FEU', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(4, 'Rolls-Royce Dawn', NULL, 1, NULL, 215000, 3, 4, 'https://m.atcdn.co.uk/a/media/w340h255pf7f7f5/4e33a61c47e24d45a40d08159ea5b99d.jpg', 'sunningdale', 'Rolls-Royce Motor Cars Sunningdale', '5', 7, 'https://www.autotrader.co.uk/car-details/202012056803731?year-to=2021&include-delivery-option=on&sort=datedesc&radius=1500&advertising-location=at_cars&onesearchad=New&onesearchad=Nearly%20New&onesearchad=Used&price-to=250000&price-from=187500&postcode=rg12lu&page=30', '2021-04-26 04:02:34', 'false', '202012056803731', '2020-12-05', 6803731, '2018', 'Convertible', '6026', '6.6L', '571', 'Automatic', 'Petrol', 'RJ18LHZ', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(5, 'Ferrari 488', NULL, 1, NULL, 189000, 3, 4, 'https://m.atcdn.co.uk/a/media/w340h255pf7f7f5/47f4c0c4f23242bca6fd609e03622df4.jpg', 'solihull', 'Graypaul Birmingham', '5', 12, 'https://www.autotrader.co.uk/car-details/202102128974194?price-from=187500&year-to=2021&include-delivery-option=on&price-to=250000&sort=datedesc&radius=1500&onesearchad=New&onesearchad=Nearly%20New&onesearchad=Used&advertising-location=at_cars&postcode=rg12lu&page=23', '2021-04-26 04:02:42', 'false', '202102128974194', '2021-02-12', 8974194, '2017', 'Convertible', '3142', '3.9L', '669', 'Automatic', 'Petrol', 'KE67EDP', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(6, 'Audi RS5', NULL, 1, NULL, 46995, 3, 4, 'https://m.atcdn.co.uk/a/media/w340h255pf7f7f5/71d06108cf5a4c81b4ddb62de84383f1.jpg', 'nottingham', 'Eddie Cars', '4.3', 121, 'https://www.autotrader.co.uk/car-details/202104241758148?price-from=46875&sort=datedesc&advertising-location=at_cars&onesearchad=New&onesearchad=Nearly%20New&onesearchad=Used&radius=1500&include-delivery-option=on&year-to=2021&price-to=47852&postcode=rg12lu&page=1', '2021-04-26 04:02:56', 'false', '202104241758148', '2021-04-24', 1758148, '2018', 'Coupe', '14000', '2.9L', '450', 'Automatic', 'Petrol', 'GV18DKA', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(7, 'Volvo XC60 II', NULL, 1, NULL, 47950, 3, 4, 'https://m.atcdn.co.uk/a/media/w340h255pf7f7f5/be7083d62b1244738bd34f6b721634fd.jpg', 'eastbourne', 'Caffyns Volvo Eastbourne', '4.8', 150, 'https://www.autotrader.co.uk/car-details/202104241754263?onesearchad=New&onesearchad=Nearly%20New&onesearchad=Used&sort=datedesc&radius=1500&advertising-location=at_cars&year-to=2021&price-to=48828&price-from=47852&include-delivery-option=on&postcode=rg12lu&page=1', '2021-04-26 04:02:57', 'false', '202104241754263', '2021-04-24', 1754263, '2020', NULL, '6043', NULL, NULL, NULL, NULL, 'KT69PNJ', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(8, 'Volkswagen Tiguan Allspace', NULL, 1, NULL, 18899, 3, 4, 'https://m.atcdn.co.uk/a/media/w340h255pf7f7f5/217c2054b53945aaa74772450b7c1aee.jpg', 'blackburn', 'Volkswagen Blackburn', '4.5', 1784, 'https://www.autotrader.co.uk/car-details/202104241768938?onesearchad=New&onesearchad=Nearly%20New&onesearchad=Used&sort=datedesc&radius=1500&advertising-location=at_cars&year-to=2021&price-to=18922&price-from=18800&include-delivery-option=on&postcode=rg12lu&page=1', '2021-04-26 04:03:05', 'false', '202104241768938', '2021-04-24', 1768938, '2018', NULL, '59065', NULL, NULL, NULL, NULL, 'RK18PWX', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(9, 'KIA Sportage', NULL, 1, NULL, 18818, 3, 4, 'https://m.atcdn.co.uk/a/media/w340h255pf7f7f5/1f13630ea22a44a0b831daa73537c6f6.jpg', 'stone', 'Acorn Approved Used Stone', '5', 25, 'https://www.autotrader.co.uk/car-details/202104241757384?onesearchad=New&onesearchad=Nearly%20New&onesearchad=Used&sort=datedesc&radius=1500&advertising-location=at_cars&year-to=2021&price-to=18922&price-from=18800&include-delivery-option=on&postcode=rg12lu&page=1', '2021-04-26 04:03:06', 'false', '202104241757384', '2021-04-24', 1757384, '2020', NULL, '2309', NULL, NULL, NULL, NULL, 'OY70YUU', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(10, 'Mercedes-Benz Gle Class', NULL, 1, NULL, 47290, 3, 4, 'https://m.atcdn.co.uk/a/media/w340h255pf7f7f5/babec1e6efc44c55995f3abe10600699.jpg', 'windlesham', 'Nicholas Betancourt Ltd', '5', 32, 'https://www.autotrader.co.uk/car-details/202102229351059?year-to=2021&include-delivery-option=on&sort=datedesc&radius=1500&advertising-location=at_cars&onesearchad=New&onesearchad=Nearly%20New&onesearchad=Used&price-to=47852&price-from=46875&postcode=rg12lu&page=35', '2021-04-26 04:03:06', 'false', '202102229351059', '2021-02-22', 9351059, '2015', 'Coupe', '35000', '5.5L', '585', 'Automatic', 'Petrol', 'BX65WFU', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(11, 'Renault Zoe E (135ps) GT Line (R135)(ZE50) Rapid Charge', 'Finished in Highland Grey with a Half Leather interior', 2, '2021-03-01', 24990, 0, 0, NULL, NULL, 'D S G Morecambe', NULL, 0, 'https://usedcars.renault.co.uk/en/used-cars/renault/zoe-e-135ps-gt-line-r135ze50-rapid-charge/details-hkcjvzj', '2021-04-02 04:03:10', NULL, 'hkcjvzj', NULL, 0, NULL, NULL, '50', NULL, NULL, 'Automatic', 'Electric', 'PN21UCD', '2021-05-28 04:20:37', '2021-05-28 04:20:37'),
(12, 'Renault Trafic 2.0dCi (EU6dT) SL28 Energy 170 Sport PV', 'Finished in Panorama Blue with a Java Upholstery interior', 2, '2021-03-01', 23333, 0, 0, NULL, NULL, 'Motorvogue Kings Lynn Renault', NULL, 0, 'https://usedcars.renault.co.uk/en/used-cars/renault/trafic-20dci-eu6dt-sl28-energy-170-sport-pv/details-u3cjvxk', '2021-04-02 04:03:10', NULL, 'u3cjvxk', NULL, 0, NULL, NULL, '6', NULL, NULL, 'Automatic', 'Diesel', 'AE21WGV', '2021-05-28 04:20:37', '2021-05-28 04:20:37'),
(13, 'Renault Trafic 2.0Dci (Eu6dt) LL30 Energy 120 Sport PV', 'Finished in Mercury Metallic with a Black Cloth interior', 2, '2021-03-01', 23995, 9, 9, 'https://usedcars.renault.co.uk/picserver1/userdata/46/501603/YhfWulbqJr/kfz1369581_kfz_1369581_1.jpg', NULL, 'Platinum', NULL, 0, 'https://usedcars.renault.co.uk/en/used-cars/renault/trafic-20dci-eu6dt-ll30-energy-120-sport-pv/details-s4cjlbp', '2021-04-02 04:03:10', NULL, 's4cjlbp', NULL, 0, NULL, NULL, '3000', NULL, NULL, 'Manual', 'Diesel', 'WU21ODE', '2021-05-28 04:20:37', '2021-05-28 04:20:37'),
(14, 'Renault Zoe E (110ps) Iconic (R110)(ZE50)', 'Finished in Blue with a Matching interior', 2, '2021-01-01', 23990, 9, 9, 'https://usedcars.renault.co.uk/picserver1/userdata/46/501584/YhfVCmbqJr/kfz1323477_kfz_1323477_1.jpg', NULL, 'Hendy Brighton', NULL, 0, 'https://usedcars.renault.co.uk/en/used-cars/renault/zoe-e-110ps-iconic-r110ze50/details-qxcg7ax', '2021-04-02 04:03:11', NULL, 'qxcg7ax', NULL, 0, NULL, NULL, '1071', NULL, NULL, 'Automatic', 'Electric', 'GV70PTY', '2021-05-28 04:20:37', '2021-05-28 04:20:37'),
(15, 'Renault Zoe E (135ps) GT Line (R135)(ZE50)', 'Finished in Blue with a Part Leather interior', 2, '2020-12-01', 22799, 9, 9, 'https://usedcars.renault.co.uk/picserver1/userdata/46/501596/YhfVDobqJr/kfz1309511_kfz_1309511_1.jpg', NULL, 'Lookers', NULL, 0, 'https://usedcars.renault.co.uk/en/used-cars/renault/zoe-e-135ps-gt-line-r135ze50/details-r1cgrnh', '2021-04-02 04:03:11', NULL, 'r1cgrnh', NULL, 0, NULL, NULL, '1358', NULL, NULL, NULL, 'Electric', 'PY70AGU', '2021-05-28 04:20:37', '2021-05-28 04:20:37');

-- --------------------------------------------------------

--
-- Table structure for table `product_flags`
--

CREATE TABLE `product_flags` (
  `id` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `flag` varchar(255) NOT NULL,
  `scrape_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_flags`
--

INSERT INTO `product_flags` (`id`, `productId`, `flag`, `scrape_date`, `created_at`, `updated_at`) VALUES
(1, 1, 'Finance available', '2021-04-26 04:02:22', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(2, 2, 'No admin fees', '2021-04-26 04:02:24', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(3, 2, 'Finance available', '2021-04-26 04:02:24', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(4, 3, 'No admin fees', '2021-04-26 04:02:24', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(5, 3, 'Finance available', '2021-04-26 04:02:24', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(6, 4, 'Approved used', '2021-04-26 04:02:34', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(7, 4, 'No admin fees', '2021-04-26 04:02:34', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(8, 5, 'Approved used', '2021-04-26 04:02:42', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(9, 5, 'No admin fees', '2021-04-26 04:02:42', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(10, 6, 'Great price', '2021-04-26 04:02:56', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(11, 6, 'No admin fees', '2021-04-26 04:02:56', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(12, 6, 'Finance available', '2021-04-26 04:02:56', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(13, 7, 'Higher price', '2021-04-26 04:02:57', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(14, 7, 'Approved used', '2021-04-26 04:02:57', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(15, 8, 'Good price', '2021-04-26 04:03:05', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(16, 8, 'Approved used', '2021-04-26 04:03:05', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(17, 9, 'Good price', '2021-04-26 04:03:06', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(18, 10, 'Great price', '2021-04-26 04:03:06', '2021-05-28 04:20:37', '2021-05-28 04:20:37'),
(19, 10, 'No admin fees', '2021-04-26 04:03:06', '2021-05-28 04:20:37', '2021-05-28 04:20:37');

-- --------------------------------------------------------

--
-- Table structure for table `product_main_images`
--

CREATE TABLE `product_main_images` (
  `id` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `scrape_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_main_images`
--

INSERT INTO `product_main_images` (`id`, `productId`, `url`, `image`, `scrape_date`, `created_at`, `updated_at`) VALUES
(1, 1, 'https://m.atcdn.co.uk/a/media/w340h255pf7f7f5/aab542b2a66e4c1d9ebce3e3cd45735b.jpg', NULL, '2021-04-26 04:02:22', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(2, 2, 'https://m.atcdn.co.uk/a/media/w340h255pf7f7f5/4efca0f780e8489a9498208661faf21a.jpg', NULL, '2021-04-26 04:02:24', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(3, 3, 'https://m.atcdn.co.uk/a/media/w340h255pf7f7f5/1c2eba8b5e2d46d29efd8d92eb3531d7.jpg', NULL, '2021-04-26 04:02:24', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(4, 4, 'https://m.atcdn.co.uk/a/media/w340h255pf7f7f5/4e33a61c47e24d45a40d08159ea5b99d.jpg', NULL, '2021-04-26 04:02:34', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(5, 5, 'https://m.atcdn.co.uk/a/media/w340h255pf7f7f5/47f4c0c4f23242bca6fd609e03622df4.jpg', NULL, '2021-04-26 04:02:42', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(6, 6, 'https://m.atcdn.co.uk/a/media/w340h255pf7f7f5/71d06108cf5a4c81b4ddb62de84383f1.jpg', NULL, '2021-04-26 04:02:56', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(7, 7, 'https://m.atcdn.co.uk/a/media/w340h255pf7f7f5/be7083d62b1244738bd34f6b721634fd.jpg', NULL, '2021-04-26 04:02:57', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(8, 8, 'https://m.atcdn.co.uk/a/media/w340h255pf7f7f5/217c2054b53945aaa74772450b7c1aee.jpg', NULL, '2021-04-26 04:03:05', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(9, 9, 'https://m.atcdn.co.uk/a/media/w340h255pf7f7f5/1f13630ea22a44a0b831daa73537c6f6.jpg', NULL, '2021-04-26 04:03:06', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(10, 10, 'https://m.atcdn.co.uk/a/media/w340h255pf7f7f5/babec1e6efc44c55995f3abe10600699.jpg', NULL, '2021-04-26 04:03:06', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(11, 13, 'https://usedcars.renault.co.uk/picserver1/userdata/46/501603/YhfWulbqJr/kfz1369581_kfz_1369581_1.jpg', NULL, '2021-04-02 04:03:10', '2021-05-28 04:20:37', '2021-05-28 04:20:37'),
(12, 14, 'https://usedcars.renault.co.uk/picserver1/userdata/46/501584/YhfVCmbqJr/kfz1323477_kfz_1323477_1.jpg', NULL, '2021-04-02 04:03:11', '2021-05-28 04:20:37', '2021-05-28 04:20:37'),
(13, 15, 'https://usedcars.renault.co.uk/picserver1/userdata/46/501596/YhfVDobqJr/kfz1309511_kfz_1309511_1.jpg', NULL, '2021-04-02 04:03:11', '2021-05-28 04:20:37', '2021-05-28 04:20:37');

-- --------------------------------------------------------

--
-- Table structure for table `product_thumb_images`
--

CREATE TABLE `product_thumb_images` (
  `id` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `scrape_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_thumb_images`
--

INSERT INTO `product_thumb_images` (`id`, `productId`, `url`, `image`, `scrape_date`, `created_at`, `updated_at`) VALUES
(1, 1, 'https://m.atcdn.co.uk/a/media/w108h81pdfdfdf/aea77095c49a4f5b83702386090f1307.jpg', NULL, '2021-04-26 04:02:22', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(2, 1, 'https://m.atcdn.co.uk/a/media/w108h81pdfdfdf/f905c094653a430f8b158af4bef0bfe5.jpg', NULL, '2021-04-26 04:02:22', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(3, 1, 'https://m.atcdn.co.uk/a/media/w108h81pdfdfdf/602a1754d04248428402757f7ac3922b.jpg', NULL, '2021-04-26 04:02:22', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(4, 2, 'https://m.atcdn.co.uk/a/media/w108h81pdfdfdf/d06e567cf7dd40e2b16ced8697fd2972.jpg', NULL, '2021-04-26 04:02:24', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(5, 2, 'https://m.atcdn.co.uk/a/media/w108h81pdfdfdf/585c9c2036ea458fa20189854d4bd896.jpg', NULL, '2021-04-26 04:02:24', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(6, 2, 'https://m.atcdn.co.uk/a/media/w108h81pdfdfdf/70345076d5804badb8e901615410078e.jpg', NULL, '2021-04-26 04:02:24', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(7, 3, 'https://m.atcdn.co.uk/a/media/w108h81pdfdfdf/cfacdaffe15b466b88d950f0bfb246c0.jpg', NULL, '2021-04-26 04:02:24', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(8, 3, 'https://m.atcdn.co.uk/a/media/w108h81pdfdfdf/0da2c64e66b44a45b59af5ca5d1d1f06.jpg', NULL, '2021-04-26 04:02:24', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(9, 3, 'https://m.atcdn.co.uk/a/media/w108h81pdfdfdf/78e8640fd039413b9fed7d696f5e90f2.jpg', NULL, '2021-04-26 04:02:24', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(10, 4, 'https://m.atcdn.co.uk/a/media/w108h81pdfdfdf/9955b3197195437c9e2fde60b39c3f3a.jpg', NULL, '2021-04-26 04:02:34', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(11, 4, 'https://m.atcdn.co.uk/a/media/w108h81pdfdfdf/20ce4f38a9ab493781bb10388f904881.jpg', NULL, '2021-04-26 04:02:34', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(12, 4, 'https://m.atcdn.co.uk/a/media/w108h81pdfdfdf/ed1e3e4be1ce486c9d6cb2cbf501f007.jpg', NULL, '2021-04-26 04:02:34', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(13, 5, 'https://m.atcdn.co.uk/a/media/w108h81pdfdfdf/ded03d2968544e5caee81829ea06bc99.jpg', NULL, '2021-04-26 04:02:42', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(14, 5, 'https://m.atcdn.co.uk/a/media/w108h81pdfdfdf/ef8faa9b655d4f7283f4f5b24795899c.jpg', NULL, '2021-04-26 04:02:42', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(15, 5, 'https://m.atcdn.co.uk/a/media/w108h81pdfdfdf/b98bdbdd0ebb44c7836e5c4abad0d073.jpg', NULL, '2021-04-26 04:02:42', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(16, 6, 'https://m.atcdn.co.uk/a/media/w108h81pdfdfdf/bc246a3c0d4e4be4ba968127bfc4326a.jpg', NULL, '2021-04-26 04:02:56', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(17, 6, 'https://m.atcdn.co.uk/a/media/w108h81pdfdfdf/771b1047efbb42ff9e869ea2edd06337.jpg', NULL, '2021-04-26 04:02:56', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(18, 6, 'https://m.atcdn.co.uk/a/media/w108h81pdfdfdf/a04e66a4aaaa4a9e8cc40567857c0e19.jpg', NULL, '2021-04-26 04:02:56', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(19, 7, 'https://m.atcdn.co.uk/a/media/w108h81pdfdfdf/378bba0a22e34feab59f1ccfdb2c75af.jpg', NULL, '2021-04-26 04:02:57', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(20, 7, 'https://m.atcdn.co.uk/a/media/w108h81pdfdfdf/4aa3034c78094577a3170fed3b340331.jpg', NULL, '2021-04-26 04:02:57', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(21, 7, 'https://m.atcdn.co.uk/a/media/w108h81pdfdfdf/b219a23e30ad4759ba56f3739ec79a93.jpg', NULL, '2021-04-26 04:02:57', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(22, 8, 'https://m.atcdn.co.uk/a/media/w108h81pdfdfdf/a787bb8019314ba8884d8de4817dc9fb.jpg', NULL, '2021-04-26 04:03:05', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(23, 8, 'https://m.atcdn.co.uk/a/media/w108h81pdfdfdf/1bc8a6027a62470fb99aa7fd031fbe98.jpg', NULL, '2021-04-26 04:03:05', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(24, 8, 'https://m.atcdn.co.uk/a/media/w108h81pdfdfdf/6c05aa21040f47d38097896189f74d14.jpg', NULL, '2021-04-26 04:03:05', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(25, 9, 'https://m.atcdn.co.uk/a/media/w108h81pdfdfdf/b899ae5911be4c29acaceda7d06b406f.jpg', NULL, '2021-04-26 04:03:06', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(26, 9, 'https://m.atcdn.co.uk/a/media/w108h81pdfdfdf/aa253dceaa1743038892cd382a0b4ce8.jpg', NULL, '2021-04-26 04:03:06', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(27, 9, 'https://m.atcdn.co.uk/a/media/w108h81pdfdfdf/aac430db3cc344c6a570fcaa35909e24.jpg', NULL, '2021-04-26 04:03:06', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(28, 10, 'https://m.atcdn.co.uk/a/media/w108h81pdfdfdf/e96fa1a6b4044683bc031c8a8e7fa230.jpg', NULL, '2021-04-26 04:03:06', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(29, 10, 'https://m.atcdn.co.uk/a/media/w108h81pdfdfdf/691e5ef94c724d79b0c21f80bfb0e159.jpg', NULL, '2021-04-26 04:03:06', '2021-05-28 04:20:37', '2021-05-28 04:20:37'),
(30, 10, 'https://m.atcdn.co.uk/a/media/w108h81pdfdfdf/1217b08409e44153a1aad24722faa794.jpg', NULL, '2021-04-26 04:03:06', '2021-05-28 04:20:37', '2021-05-28 04:20:37'),
(31, 13, 'https://usedcars.renault.co.uk/picserver1/userdata/46/501603/YhfWulbqJr/kfz1369581_kfz_1369581_1.jpg', NULL, '2021-04-02 04:03:10', '2021-05-28 04:20:37', '2021-05-28 04:20:37'),
(32, 13, 'https://usedcars.renault.co.uk/picserver1/userdata/46/501603/YhfWulbqJr/kfz1369581_kfz_1369581_2.jpg', NULL, '2021-04-02 04:03:10', '2021-05-28 04:20:37', '2021-05-28 04:20:37'),
(33, 13, 'https://usedcars.renault.co.uk/picserver1/userdata/46/501603/YhfWulbqJr/kfz1369581_kfz_1369581_3.jpg', NULL, '2021-04-02 04:03:10', '2021-05-28 04:20:37', '2021-05-28 04:20:37'),
(34, 13, 'https://usedcars.renault.co.uk/picserver1/userdata/46/501603/YhfWulbqJr/kfz1369581_kfz_1369581_4.jpg', NULL, '2021-04-02 04:03:10', '2021-05-28 04:20:37', '2021-05-28 04:20:37'),
(35, 13, 'https://usedcars.renault.co.uk/picserver1/userdata/46/501603/YhfWulbqJr/kfz1369581_kfz_1369581_5.jpg', NULL, '2021-04-02 04:03:10', '2021-05-28 04:20:37', '2021-05-28 04:20:37'),
(36, 13, 'https://usedcars.renault.co.uk/picserver1/userdata/46/501603/YhfWulbqJr/kfz1369581_kfz_1369581_6.jpg', NULL, '2021-04-02 04:03:10', '2021-05-28 04:20:37', '2021-05-28 04:20:37'),
(37, 13, 'https://usedcars.renault.co.uk/picserver1/userdata/46/501603/YhfWulbqJr/kfz1369581_kfz_1369581_7.jpg', NULL, '2021-04-02 04:03:10', '2021-05-28 04:20:37', '2021-05-28 04:20:37'),
(38, 13, 'https://usedcars.renault.co.uk/picserver1/userdata/46/501603/YhfWulbqJr/kfz1369581_kfz_1369581_8.jpg', NULL, '2021-04-02 04:03:10', '2021-05-28 04:20:37', '2021-05-28 04:20:37'),
(39, 13, 'https://usedcars.renault.co.uk/picserver1/userdata/46/501603/YhfWulbqJr/kfz1369581_kfz_1369581_9.jpg', NULL, '2021-04-02 04:03:10', '2021-05-28 04:20:37', '2021-05-28 04:20:37'),
(40, 14, 'https://usedcars.renault.co.uk/picserver1/userdata/46/501584/YhfVCmbqJr/kfz1323477_kfz_1323477_1.jpg', NULL, '2021-04-02 04:03:11', '2021-05-28 04:20:37', '2021-05-28 04:20:37'),
(41, 14, 'https://usedcars.renault.co.uk/picserver1/userdata/46/501584/YhfVCmbqJr/kfz1323477_kfz_1323477_2.jpg', NULL, '2021-04-02 04:03:11', '2021-05-28 04:20:37', '2021-05-28 04:20:37'),
(42, 14, 'https://usedcars.renault.co.uk/picserver1/userdata/46/501584/YhfVCmbqJr/kfz1323477_kfz_1323477_3.jpg', NULL, '2021-04-02 04:03:11', '2021-05-28 04:20:37', '2021-05-28 04:20:37'),
(43, 14, 'https://usedcars.renault.co.uk/picserver1/userdata/46/501584/YhfVCmbqJr/kfz1323477_kfz_1323477_4.jpg', NULL, '2021-04-02 04:03:11', '2021-05-28 04:20:37', '2021-05-28 04:20:37'),
(44, 14, 'https://usedcars.renault.co.uk/picserver1/userdata/46/501584/YhfVCmbqJr/kfz1323477_kfz_1323477_5.jpg', NULL, '2021-04-02 04:03:11', '2021-05-28 04:20:37', '2021-05-28 04:20:37'),
(45, 14, 'https://usedcars.renault.co.uk/picserver1/userdata/46/501584/YhfVCmbqJr/kfz1323477_kfz_1323477_6.jpg', NULL, '2021-04-02 04:03:11', '2021-05-28 04:20:37', '2021-05-28 04:20:37'),
(46, 14, 'https://usedcars.renault.co.uk/picserver1/userdata/46/501584/YhfVCmbqJr/kfz1323477_kfz_1323477_7.jpg', NULL, '2021-04-02 04:03:11', '2021-05-28 04:20:37', '2021-05-28 04:20:37'),
(47, 14, 'https://usedcars.renault.co.uk/picserver1/userdata/46/501584/YhfVCmbqJr/kfz1323477_kfz_1323477_8.jpg', NULL, '2021-04-02 04:03:11', '2021-05-28 04:20:37', '2021-05-28 04:20:37'),
(48, 14, 'https://usedcars.renault.co.uk/picserver1/userdata/46/501584/YhfVCmbqJr/kfz1323477_kfz_1323477_9.jpg', NULL, '2021-04-02 04:03:11', '2021-05-28 04:20:37', '2021-05-28 04:20:37'),
(49, 15, 'https://usedcars.renault.co.uk/picserver1/userdata/46/501596/YhfVDobqJr/kfz1309511_kfz_1309511_1.jpg', NULL, '2021-04-02 04:03:11', '2021-05-28 04:20:37', '2021-05-28 04:20:37'),
(50, 15, 'https://usedcars.renault.co.uk/picserver1/userdata/46/501596/YhfVDobqJr/kfz1309511_kfz_1309511_2.jpg', NULL, '2021-04-02 04:03:11', '2021-05-28 04:20:37', '2021-05-28 04:20:37'),
(51, 15, 'https://usedcars.renault.co.uk/picserver1/userdata/46/501596/YhfVDobqJr/kfz1309511_kfz_1309511_3.jpg', NULL, '2021-04-02 04:03:11', '2021-05-28 04:20:37', '2021-05-28 04:20:37'),
(52, 15, 'https://usedcars.renault.co.uk/picserver1/userdata/46/501596/YhfVDobqJr/kfz1309511_kfz_1309511_4.jpg', NULL, '2021-04-02 04:03:11', '2021-05-28 04:20:37', '2021-05-28 04:20:37'),
(53, 15, 'https://usedcars.renault.co.uk/picserver1/userdata/46/501596/YhfVDobqJr/kfz1309511_kfz_1309511_5.jpg', NULL, '2021-04-02 04:03:11', '2021-05-28 04:20:37', '2021-05-28 04:20:37'),
(54, 15, 'https://usedcars.renault.co.uk/picserver1/userdata/46/501596/YhfVDobqJr/kfz1309511_kfz_1309511_6.jpg', NULL, '2021-04-02 04:03:11', '2021-05-28 04:20:37', '2021-05-28 04:20:37'),
(55, 15, 'https://usedcars.renault.co.uk/picserver1/userdata/46/501596/YhfVDobqJr/kfz1309511_kfz_1309511_7.jpg', NULL, '2021-04-02 04:03:11', '2021-05-28 04:20:37', '2021-05-28 04:20:37'),
(56, 15, 'https://usedcars.renault.co.uk/picserver1/userdata/46/501596/YhfVDobqJr/kfz1309511_kfz_1309511_8.jpg', NULL, '2021-04-02 04:03:11', '2021-05-28 04:20:37', '2021-05-28 04:20:37'),
(57, 15, 'https://usedcars.renault.co.uk/picserver1/userdata/46/501596/YhfVDobqJr/kfz1309511_kfz_1309511_9.jpg', NULL, '2021-04-02 04:03:11', '2021-05-28 04:20:37', '2021-05-28 04:20:37');

-- --------------------------------------------------------

--
-- Table structure for table `thumb_image_count_history`
--

CREATE TABLE `thumb_image_count_history` (
  `id` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `count` int(11) NOT NULL DEFAULT '0',
  `scrape_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `thumb_image_count_history`
--

INSERT INTO `thumb_image_count_history` (`id`, `productId`, `count`, `scrape_date`, `created_at`, `updated_at`) VALUES
(1, 1, 3, '2021-04-26 04:02:22', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(2, 2, 3, '2021-04-26 04:02:24', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(3, 3, 3, '2021-04-26 04:02:24', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(4, 4, 3, '2021-04-26 04:02:34', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(5, 5, 3, '2021-04-26 04:02:42', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(6, 6, 3, '2021-04-26 04:02:56', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(7, 7, 3, '2021-04-26 04:02:57', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(8, 8, 3, '2021-04-26 04:03:05', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(9, 9, 3, '2021-04-26 04:03:06', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(10, 10, 3, '2021-04-26 04:03:06', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(11, 13, 9, '2021-04-02 04:03:10', '2021-05-28 04:20:37', '2021-05-28 04:20:37'),
(12, 14, 9, '2021-04-02 04:03:11', '2021-05-28 04:20:37', '2021-05-28 04:20:37'),
(13, 15, 9, '2021-04-02 04:03:11', '2021-05-28 04:20:37', '2021-05-28 04:20:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `post_code`, `country`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'vasant', 'solanki', 'vasant.cmarix@gmail.com', '25866', 'india', NULL, '2021-05-30 23:04:15', '2021-05-30 23:04:15'),
(2, 'vasant', 'solanki', 'vasant13.cmarix@gmail.com', '25866', 'india', NULL, '2021-05-30 23:25:42', '2021-05-30 23:25:42'),
(3, 'vasant', 'solanki', 'vasant00.cmarix@gmail.com', '25866', 'india', NULL, '2021-06-02 23:55:27', '2021-06-02 23:55:27'),
(4, 'vasant', 'solanki', 'vasant5896.cmarix@gmail.com', '25866', 'india', NULL, '2021-06-06 22:25:54', '2021-06-06 22:25:54'),
(5, 'vasant', 'solanki', 'vasant859.cmarix@gmail.com', '25866', 'india', NULL, '2021-06-07 00:12:10', '2021-06-07 00:12:10');

-- --------------------------------------------------------

--
-- Table structure for table `video_history`
--

CREATE TABLE `video_history` (
  `id` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `has_video` varchar(255) DEFAULT NULL,
  `scrape_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `video_history`
--

INSERT INTO `video_history` (`id`, `productId`, `has_video`, `scrape_date`, `created_at`, `updated_at`) VALUES
(1, 1, 'false', '2021-04-26 04:02:22', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(2, 2, 'false', '2021-04-26 04:02:24', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(3, 3, 'false', '2021-04-26 04:02:24', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(4, 4, 'false', '2021-04-26 04:02:34', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(5, 5, 'false', '2021-04-26 04:02:42', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(6, 6, 'false', '2021-04-26 04:02:56', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(7, 7, 'false', '2021-04-26 04:02:57', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(8, 8, 'false', '2021-04-26 04:03:05', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(9, 9, 'false', '2021-04-26 04:03:06', '2021-05-28 04:20:36', '2021-05-28 04:20:36'),
(10, 10, 'false', '2021-04-26 04:03:06', '2021-05-28 04:20:36', '2021-05-28 04:20:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `main_images_history`
--
ALTER TABLE `main_images_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `price_history`
--
ALTER TABLE `price_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_flags`
--
ALTER TABLE `product_flags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_main_images`
--
ALTER TABLE `product_main_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_thumb_images`
--
ALTER TABLE `product_thumb_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thumb_image_count_history`
--
ALTER TABLE `thumb_image_count_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `video_history`
--
ALTER TABLE `video_history`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `main_images_history`
--
ALTER TABLE `main_images_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `price_history`
--
ALTER TABLE `price_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `product_flags`
--
ALTER TABLE `product_flags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `product_main_images`
--
ALTER TABLE `product_main_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `product_thumb_images`
--
ALTER TABLE `product_thumb_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `thumb_image_count_history`
--
ALTER TABLE `thumb_image_count_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `video_history`
--
ALTER TABLE `video_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
