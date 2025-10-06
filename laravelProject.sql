-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 06, 2025 at 11:06 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravelProject`
--

-- --------------------------------------------------------

--
-- Table structure for table `artist_profiles`
--

CREATE TABLE `artist_profiles` (
  `artist_id` bigint(20) UNSIGNED NOT NULL,
  `artist_name` varchar(255) NOT NULL,
  `about_artist` text DEFAULT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `artist_profiles`
--

INSERT INTO `artist_profiles` (`artist_id`, `artist_name`, `about_artist`, `users_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'ศิลปินทดสอบ', 'ทดสอบระบบส่งคำร้อง', 1, '2025-10-06 15:03:50', '2025-10-06 15:03:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('e0ccca0915c2709969a3c7853f4bb1ae', 'i:1;', 1759784003),
('e0ccca0915c2709969a3c7853f4bb1ae:timer', 'i:1759784003;', 1759784003);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `events_id` bigint(20) UNSIGNED NOT NULL,
  `events_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `poster_path` varchar(255) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `type_hall` enum('Yes','No') NOT NULL DEFAULT 'No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_requests`
--

CREATE TABLE `event_requests` (
  `event_requests_id` bigint(20) UNSIGNED NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `proposal` text DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `event_status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `poster_path` varchar(255) DEFAULT NULL,
  `type_hall` enum('No','Yes') NOT NULL DEFAULT 'No',
  `artist_id` bigint(20) UNSIGNED NOT NULL,
  `events_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_requests`
--

INSERT INTO `event_requests` (`event_requests_id`, `event_name`, `proposal`, `start_date`, `end_date`, `event_status`, `poster_path`, `type_hall`, `artist_id`, `events_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'อะไรเอ่ย', 'กขค', '2025-10-10', '2025-10-11', 'rejected', 'http://127.0.0.1:8000/storage/posters/xBHKYsvP4Ja7QJ4M8djB4FnWAGj1sog8DOlPCowN.jpg', 'No', 1, NULL, '2025-10-06 08:04:21', '2025-10-06 11:41:48', '2025-10-06 11:41:48'),
(3, 'Zzzz', NULL, '2025-10-04', '2025-10-05', 'pending', NULL, 'No', 1, NULL, '2025-10-06 10:23:28', '2025-10-06 11:41:45', '2025-10-06 11:41:45'),
(4, 'อะไรเอ่ย', '123', '2025-10-24', '2025-10-25', 'pending', NULL, 'No', 1, NULL, '2025-10-06 10:23:49', '2025-10-06 11:41:43', '2025-10-06 11:41:43'),
(5, '\'\'', 'aaa', '2025-10-10', '2025-10-11', 'pending', NULL, 'Yes', 1, NULL, '2025-10-06 10:26:09', '2025-10-06 11:41:40', '2025-10-06 11:41:40'),
(6, 'รำวง', 'สวัสดี', '2025-10-08', '2025-10-09', 'rejected', 'http://127.0.0.1:8000/storage/posters/hhRCzcgErsUtfDv3Y7oSKUnMOJV3hT4znqx9ExDS.jpg', 'Yes', 1, NULL, '2025-10-06 11:41:32', '2025-10-06 11:52:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hall_zones`
--

CREATE TABLE `hall_zones` (
  `zones_id` bigint(20) UNSIGNED NOT NULL,
  `zones_name` varchar(255) NOT NULL,
  `zones_capacity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(16, '0001_01_01_000000_create_users_table', 1),
(17, '0001_01_01_000001_create_cache_table', 1),
(18, '0001_01_01_000002_create_jobs_table', 1),
(19, '2025_10_01_100237_add_two_factor_columns_to_users_table', 1),
(20, '2025_10_01_100246_create_personal_access_tokens_table', 1),
(21, '2025_10_01_100647_create_roles_table', 1),
(22, '2025_10_01_100648_create_user_has_roles_table', 1),
(23, '2025_10_01_100649_create_artist_profiles_table', 1),
(24, '2025_10_01_100650_create_events_table', 1),
(25, '2025_10_01_100651_create_event_requests_table', 1),
(26, '2025_10_01_100652_create_hall_zones_table', 1),
(27, '2025_10_01_100653_create_souvenirs_table', 1),
(28, '2025_10_01_100654_create_souvenir_orders_table', 1),
(29, '2025_10_01_100655_create_ticket_bookings_table', 1),
(30, '2025_10_03_090928_add_type_hall_to_event_requests_table', 1),
(31, '2025_10_06_190751_add_usertype_to_users_table', 2),
(32, '2025_10_06_191229_add_usertype_to_users_table', 3),
(33, '2025_10_06_200224_add_qty_to_ticket_bookings_table', 4),
(34, '2025_10_06_200810_add_type_hall_to_ticket_bookings_table', 5),
(35, '2025_10_06_200824_add_type_hall_to_events_table', 5),
(36, '2025_10_06_201330_add_type_hall_to_events_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `roles_id` bigint(20) UNSIGNED NOT NULL,
  `roles_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('scVEN1k53pss1SuqiHbW9fypMFVzJy6zKxUYyz5w', 2, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiT0tZM3FoczZQRFZmYlBkb2RodlRXVndHSHRPbkJDZG15MFBkclVXZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hcnRpc3QvbXlfcmVxdWVzdHMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMiRiQlBUbHhOLkFEQTlXSXlkc3JJck91ZGx6OXNtMFBLY01sSElWUC4yenFwSDk4anFOZWY3TyI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1759784663);

-- --------------------------------------------------------

--
-- Table structure for table `souvenirs`
--

CREATE TABLE `souvenirs` (
  `souvenirs_id` bigint(20) UNSIGNED NOT NULL,
  `souvenirs_name` varchar(255) NOT NULL,
  `quantity_left` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `souvenirs_status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `image_path` varchar(255) DEFAULT NULL,
  `artist_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `souvenirs`
--

INSERT INTO `souvenirs` (`souvenirs_id`, `souvenirs_name`, `quantity_left`, `description`, `souvenirs_status`, `image_path`, `artist_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'ไหปลาร้า', 1, NULL, 'pending', 'http://127.0.0.1:8000/storage/souvenirs/OPTmRWebrv8B9lYUpOPrKFZpDFg9VApcfdJQKTgw.jpg', NULL, '2025-10-06 07:39:24', '2025-10-06 09:55:53', '2025-10-06 09:55:53'),
(3, 'ไหปลาร้า', 1, 'AAA', 'rejected', 'http://127.0.0.1:8000/storage/souvenirs/0CvQ0Fxe4pbVU7WjiPlvaALAyIogm0rRkxMjFe8P.jpg', 1, '2025-10-06 08:25:14', '2025-10-06 11:39:40', '2025-10-06 11:39:40'),
(4, 'XXX', 5, 'aaa', 'rejected', 'http://127.0.0.1:8000/storage/souvenirs/eJbs7kbuhb2cR20eEf8SmxDcS5sIe0I9a9f8vgBK.jpg', 1, '2025-10-06 10:43:15', '2025-10-06 11:39:38', '2025-10-06 11:39:38');

-- --------------------------------------------------------

--
-- Table structure for table `souvenir_orders`
--

CREATE TABLE `souvenir_orders` (
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `souvenirs_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_bookings`
--

CREATE TABLE `ticket_bookings` (
  `bookings_id` bigint(20) UNSIGNED NOT NULL,
  `tracking_numbers` varchar(255) NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `zones_id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `type_hall` enum('Yes','No') NOT NULL DEFAULT 'No',
  `events_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `usertype` varchar(255) DEFAULT 'user',
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `usertype`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Artist Test', 'artist@test.com', NULL, 'password', NULL, NULL, NULL, NULL, 'user', NULL, NULL, '2025-10-06 15:03:34', '2025-10-06 15:03:34', NULL),
(2, 'Peerathat', 'peerathat.p@kkumail.com', NULL, '$2y$12$bBPTlxN.ADA9WIydsrIrOudlz9sm0PKcMlHIVP.2zqpH98jqNef7O', NULL, NULL, NULL, NULL, 'artist', NULL, NULL, '2025-10-06 12:43:26', '2025-10-06 12:43:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_has_roles`
--

CREATE TABLE `user_has_roles` (
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `roles_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artist_profiles`
--
ALTER TABLE `artist_profiles`
  ADD PRIMARY KEY (`artist_id`),
  ADD KEY `artist_profiles_users_id_foreign` (`users_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`events_id`);

--
-- Indexes for table `event_requests`
--
ALTER TABLE `event_requests`
  ADD PRIMARY KEY (`event_requests_id`),
  ADD KEY `event_requests_artist_id_foreign` (`artist_id`),
  ADD KEY `event_requests_events_id_foreign` (`events_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hall_zones`
--
ALTER TABLE `hall_zones`
  ADD PRIMARY KEY (`zones_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roles_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `souvenirs`
--
ALTER TABLE `souvenirs`
  ADD PRIMARY KEY (`souvenirs_id`),
  ADD KEY `souvenirs_artist_id_foreign` (`artist_id`);

--
-- Indexes for table `souvenir_orders`
--
ALTER TABLE `souvenir_orders`
  ADD PRIMARY KEY (`users_id`,`souvenirs_id`),
  ADD KEY `souvenir_orders_souvenirs_id_foreign` (`souvenirs_id`);

--
-- Indexes for table `ticket_bookings`
--
ALTER TABLE `ticket_bookings`
  ADD PRIMARY KEY (`bookings_id`),
  ADD KEY `ticket_bookings_users_id_foreign` (`users_id`),
  ADD KEY `ticket_bookings_zones_id_foreign` (`zones_id`),
  ADD KEY `ticket_bookings_events_id_foreign` (`events_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_has_roles`
--
ALTER TABLE `user_has_roles`
  ADD PRIMARY KEY (`users_id`,`roles_id`),
  ADD KEY `user_has_roles_roles_id_foreign` (`roles_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artist_profiles`
--
ALTER TABLE `artist_profiles`
  MODIFY `artist_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `events_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event_requests`
--
ALTER TABLE `event_requests`
  MODIFY `event_requests_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hall_zones`
--
ALTER TABLE `hall_zones`
  MODIFY `zones_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `roles_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `souvenirs`
--
ALTER TABLE `souvenirs`
  MODIFY `souvenirs_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ticket_bookings`
--
ALTER TABLE `ticket_bookings`
  MODIFY `bookings_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `artist_profiles`
--
ALTER TABLE `artist_profiles`
  ADD CONSTRAINT `artist_profiles_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `event_requests`
--
ALTER TABLE `event_requests`
  ADD CONSTRAINT `event_requests_artist_id_foreign` FOREIGN KEY (`artist_id`) REFERENCES `artist_profiles` (`artist_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_requests_events_id_foreign` FOREIGN KEY (`events_id`) REFERENCES `events` (`events_id`) ON DELETE SET NULL;

--
-- Constraints for table `souvenirs`
--
ALTER TABLE `souvenirs`
  ADD CONSTRAINT `souvenirs_artist_id_foreign` FOREIGN KEY (`artist_id`) REFERENCES `artist_profiles` (`artist_id`) ON DELETE SET NULL;

--
-- Constraints for table `souvenir_orders`
--
ALTER TABLE `souvenir_orders`
  ADD CONSTRAINT `souvenir_orders_souvenirs_id_foreign` FOREIGN KEY (`souvenirs_id`) REFERENCES `souvenirs` (`souvenirs_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `souvenir_orders_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ticket_bookings`
--
ALTER TABLE `ticket_bookings`
  ADD CONSTRAINT `ticket_bookings_events_id_foreign` FOREIGN KEY (`events_id`) REFERENCES `events` (`events_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ticket_bookings_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ticket_bookings_zones_id_foreign` FOREIGN KEY (`zones_id`) REFERENCES `hall_zones` (`zones_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_has_roles`
--
ALTER TABLE `user_has_roles`
  ADD CONSTRAINT `user_has_roles_roles_id_foreign` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`roles_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_has_roles_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
