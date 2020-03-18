-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 16, 2020 at 06:43 AM
-- Server version: 8.0.17
-- PHP Version: 7.1.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `todoo`
--

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `divisi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id`, `user_id`, `divisi`, `created_at`, `updated_at`) VALUES
(2, '7', 'Programmer', '2019-12-26 03:19:24', '2019-12-26 03:19:24'),
(3, '8', 'Designer', '2019-12-26 03:19:29', '2019-12-26 03:19:29'),
(4, '9', 'Multi-Fungsi', '2019-12-26 03:19:38', '2019-12-26 03:19:38'),
(5, '5', 'Leader Developer', '2019-12-26 04:14:18', '2019-12-26 04:14:18'),
(6, '6', 'Leader Designer', '2019-12-26 04:14:30', '2019-12-26 04:14:30');

--
-- Triggers `divisi`
--
DELIMITER $$
CREATE TRIGGER `before_divisi_delete` BEFORE DELETE ON `divisi` FOR EACH ROW BEGIN
    DELETE from tasks WHERE tasks.divisi_id=old.id;
END
$$
DELIMITER ;

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
(3, '2019_12_20_021622_create_tasks_table', 1),
(4, '2019_12_20_021649_create_divisi_table', 1);

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
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `divisi_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `detail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `deathline` date DEFAULT NULL,
  `est` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_at` datetime DEFAULT NULL,
  `end_at` datetime DEFAULT NULL,
  `label` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `user_id`, `divisi_id`, `title`, `keterangan`, `created_at`, `updated_at`, `detail`, `deathline`, `est`, `start_at`, `end_at`, `label`) VALUES
(1, '9', '5', 'Makan', '3', '2019-12-26 01:06:42', '2020-01-15 23:41:38', '<p><img alt=\"\" src=\"/ckfinder/userfiles/files/WhatsApp%20Image%202019-11-27%20at%2009_44_19.jpeg\" style=\"height:400px; width:300px\" /></p>', '2019-12-04', '+ 4 day, + 4 hour, + 0 minute', NULL, '2020-01-16 06:41:38', 1),
(2, '9', '5', 'Ngapain', '3', '2019-12-26 02:51:20', '2020-01-15 23:41:43', 'ok', '2019-12-27', '+ 10 day, + 4 hour, + 0 minute', NULL, '2020-01-16 06:41:43', 1),
(7, '9', '4', 'Tidur', '3', '2020-01-06 18:40:38', '2020-01-15 23:41:51', 'Saja', '2020-01-09', '+ 14 day, + 14 hour, + 0 minute', NULL, '2020-01-16 06:41:51', 1),
(10, '9', '5', 'dddddaasd', '3', '2020-01-08 22:50:00', '2020-01-15 23:41:59', '<figure class=\"easyimage easyimage-full\"><img alt=\"\" src=\"blob:http://localhost:8000/fb5a772a-9f02-42d7-9295-b370ac9ccc65\" width=\"676\" />\r\n<figcaption></figcaption>\r\n</figure>\r\n\r\n<figure class=\"easyimage easyimage-full\"><img alt=\"\" src=\"blob:http://localhost:8000/d979945c-f741-49a2-9c43-3b200f59a6de\" width=\"674\" />\r\n<figcaption></figcaption>\r\n</figure>\r\n\r\n<figure class=\"easyimage easyimage-full\"><img alt=\"\" src=\"blob:http://localhost:8000/1e904601-de93-4d02-83dd-a30783b725c0\" width=\"780\" />\r\n<figcaption></figcaption>\r\n</figure>\r\n\r\n<p>dd</p>', '2020-01-01', '+ 24 day, + 14 hour, + 0 minute', NULL, '2020-01-16 06:41:59', 1),
(11, '9', '5', 'ddd', '0', '2020-01-08 23:02:29', '2020-01-15 23:42:17', '<figure class=\"easyimage easyimage-full\"><img alt=\"\" src=\"blob:http://localhost:8000/72263af4-38af-4d40-85ac-584d848a2e2f\" width=\"591\" />\r\n<figcaption></figcaption>\r\n</figure>\r\n\r\n<figure class=\"easyimage easyimage-full\"><img alt=\"\" src=\"blob:http://localhost:8000/76e6a4ab-efd7-4187-821c-f7a65f29d076\" width=\"720\" />\r\n<figcaption></figcaption>\r\n</figure>\r\n\r\n<figure class=\"easyimage easyimage-full\"><img alt=\"\" src=\"blob:http://localhost:8000/1cf5c454-f7e8-4a7a-89c1-9aa263634c8a\" width=\"780\" />\r\n<figcaption></figcaption>\r\n</figure>\r\n\r\n<figure class=\"easyimage easyimage-full\"><img alt=\"\" src=\"blob:http://localhost:8000/d9378f56-625c-4bc3-8133-c187a81d531c\" width=\"520\" />\r\n<figcaption></figcaption>\r\n</figure>\r\n\r\n<figure class=\"easyimage easyimage-full\"><img alt=\"\" src=\"blob:http://localhost:8000/c888c701-d360-4f72-9c54-9e627ec5cd4e\" width=\"780\" />\r\n<figcaption></figcaption>\r\n</figure>\r\n\r\n<p>&nbsp;</p>', '2020-01-09', '+ 34 day, + 20 hour, + 0 minute', NULL, NULL, 1),
(12, '9', '5', 'aaa', '3', '2020-01-09 19:23:55', '2020-01-15 23:42:10', '<p>ddd</p>', '2020-01-13', '+ 114 day, + 14 hour, + 0 minute', '2020-01-16 06:26:25', '2020-01-16 06:42:10', 1),
(13, '9', '5', 'kkkk', '3', '2020-01-10 11:27:05', '2020-01-15 23:42:22', '<p>cvvv</p>', '2020-01-14', '+ 4 day, + 5 hour, + 6 minute', '2020-01-16 06:30:05', '2020-01-16 06:42:22', 1),
(14, '5', '5', 'hmmm', '3', '2020-01-13 20:48:46', '2020-01-15 23:42:27', '<figure class=\"easyimage easyimage-full\"><img alt=\"\" src=\"blob:http://localhost:8000/64e1753e-2da6-49c4-8fa5-4e60a3104ab1\" width=\"780\" />\r\n<figcaption></figcaption>\r\n</figure>\r\n\r\n<p>&nbsp;</p>', '2020-01-14', '+ 6 day, + 5 hour, + 6 minute', '2020-01-16 06:38:45', '2020-01-16 06:42:27', 1),
(15, '5', '5', 'adadddd', '2', '2020-01-13 20:56:42', '2020-01-15 20:48:02', NULL, '2020-01-14', '+ 4 day, + 4 hour, + 5 minute', '2020-01-16 03:48:02', '2020-01-20 07:53:02', 1),
(17, '5', '5', 'heey', '0', '2020-01-15 18:38:14', '2020-01-15 23:39:02', '<p><img alt=\"\" src=\"/ckfinder/userfiles/files/WhatsApp%20Image%202019-11-27%20at%2009_44_18(1).jpeg\" style=\"height:200px; width:150px\" /></p>', '2020-01-16', '+ 5 day, + 6 hour, + 7 minute', NULL, NULL, 1),
(18, '5', '5', 'daaa', '3', '2020-01-15 18:39:56', '2020-01-15 23:42:34', '<p>test editor content<img alt=\"\" src=\"/ckfinder/userfiles/files/WhatsApp%20Image%202019-12-12%20at%2021_07_33.jpeg\" style=\"height:455px; width:256px\" /></p>', '2020-01-16', '+ 2 day, + 3 hour, + 4 minute', '2020-01-16 06:38:00', '2020-01-16 06:42:34', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `role`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Alji', 'aljics4@gmail.com', NULL, 0, '$2y$10$MERfxmLqotat.Y4ERTahO./xZV63vwZyqBbumadHn5AVevWi1Q1Zq', NULL, '2019-12-19 19:58:10', '2019-12-19 19:58:10'),
(5, 'Alji1', 'aljics1@gmail.com', NULL, 1, '$2y$10$JmdUqxQir6/e0K07VNuUoecD6YlkWuN3F3Gczq1h.3CZoVYXC5tBe', NULL, '2019-12-25 17:00:00', '2019-12-25 21:12:13'),
(6, 'Alji2', 'aljics2@gmail.com', NULL, 1, '$2y$10$g3ykRHtJmHtSThRQKnBRZelyCyPpBasaJ04KEBq5tDJIp6JLOLyeC', NULL, '2019-12-25 17:00:00', '2019-12-25 17:00:00'),
(7, 'Alji3', 'aljics3@gmail.com', NULL, 2, '$2y$10$cy9P4ZIt7RdyS6hZk3MXjOHhw2O7oYG4hCvqBjesBzWRKotHUeWWa', NULL, '2019-12-26 01:13:05', '2019-12-26 01:13:05'),
(8, 'Alji4', 'aljics44@gmail.com', NULL, 2, '$2y$10$UdYRqQNa4nbidToBvNV2J.HKGlVN0CttDzh18lx9iwF27N/bcOIqm', NULL, '2019-12-26 01:16:08', '2019-12-26 01:16:08'),
(9, 'Alji5', 'aljics5@gmail.com', NULL, 2, '$2y$10$2YvLv84HR5GTtORi2J4ID.40N4xEtPhOMBaKVm.hMrMq4ZqyIZl3W', NULL, '2019-12-26 01:16:42', '2019-12-26 01:16:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

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
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
