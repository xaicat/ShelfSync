-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2026 at 05:01 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shelfsync`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `author` varchar(255) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `weight` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `name`, `author`, `image`, `category_id`, `quantity`, `price`, `weight`, `description`, `created_at`, `updated_at`) VALUES
(3, 'Harry Potter and the Sorcerer\'s Stone', 'J. K. Rowling', 'https://covers.openlibrary.org/b/isbn/0545582881-L.jpg?default=false', 2, 22, 333.00, NULL, NULL, '2026-04-04 12:31:39', '2026-04-06 01:11:26'),
(4, 'Harry Potter and the Philosopher\'s Stone', 'J. K. Rowling', 'https://covers.openlibrary.org/b/isbn/9780747532743-L.jpg?default=false', 2, 50, 500.00, NULL, 'Harry Potter and the Sorcerer\'s Stone (titled Harry Potter and the Philosopher\'s Stone in the UK) is the first novel in J.K. Rowling\'s iconic series. It introduces readers to the magical world of wizards and witches hidden alongside the non-magical \"Muggle\" world.', '2026-04-06 00:53:17', '2026-04-06 01:13:41'),
(5, 'Harry Potter and the Chamber of Secrets', 'J. K. Rowling', 'https://covers.openlibrary.org/b/isbn/9780439064873-L.jpg?default=false', 2, 43, 500.00, NULL, NULL, '2026-04-06 01:03:08', '2026-04-06 01:03:08'),
(6, 'Harry Potter and the prisoner of Azkaban', 'J. K. Rowling', 'https://covers.openlibrary.org/b/isbn/9780439136365-L.jpg?default=false', 3, 35, 459.00, NULL, NULL, '2026-04-06 01:03:38', '2026-04-06 01:03:38'),
(7, 'Harry Potter and the Goblet of Fire', 'J. K. Rowling', 'https://covers.openlibrary.org/b/isbn/9780439139601-L.jpg?default=false', 4, 50, 349.00, NULL, NULL, '2026-04-06 01:03:57', '2026-04-06 01:03:57'),
(9, 'Harry Potter and the Order of the Phoenix', 'J. K. Rowling', 'https://covers.openlibrary.org/b/isbn/9780439358071-L.jpg?default=false', 5, 37, 300.00, NULL, NULL, '2026-04-06 01:05:31', '2026-04-06 01:05:31'),
(10, 'Harry Potter and the Half-Blood Prince', 'J. K. Rowling', 'https://covers.openlibrary.org/b/isbn/9780439785969-L.jpg?default=false', 4, 55, 450.00, NULL, NULL, '2026-04-06 01:05:48', '2026-04-06 01:05:48'),
(11, 'Harry Potter and the Deathly Hallows', 'J. K. Rowling', 'https://covers.openlibrary.org/b/isbn/9780545139700-L.jpg?default=false', 6, 44, 469.00, NULL, NULL, '2026-04-06 01:06:10', '2026-04-06 01:06:10');

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
('shelfsync-cache-424f74a6a7ed4d4ed4761507ebcd209a6ef0937b', 'i:3;', 1775467261),
('shelfsync-cache-424f74a6a7ed4d4ed4761507ebcd209a6ef0937b:timer', 'i:1775467261;', 1775467261),
('shelfsync-cache-ac3478d69a3c81fa62e60f5c3696165a4e5e6ac4', 'i:2;', 1775470430),
('shelfsync-cache-ac3478d69a3c81fa62e60f5c3696165a4e5e6ac4:timer', 'i:1775470430;', 1775470430),
('shelfsync-cache-mahdi@gmail.com|127.0.0.1', 'i:1;', 1775454829),
('shelfsync-cache-mahdi@gmail.com|127.0.0.1:timer', 'i:1775454829;', 1775454829),
('shelfsync-cache-test@gmail.com|127.0.0.1', 'i:1;', 1775407343),
('shelfsync-cache-test@gmail.com|127.0.0.1:timer', 'i:1775407343;', 1775407343),
('shelfsync-cache-xc@xc.xc|127.0.0.1', 'i:1;', 1775407320),
('shelfsync-cache-xc@xc.xc|127.0.0.1:timer', 'i:1775407320;', 1775407320);

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
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'series:Harry_Potter', '2026-04-04 12:23:53', '2026-04-04 12:23:53'),
(3, 'Fantasy fiction', '2026-04-06 01:03:38', '2026-04-06 01:03:38'),
(4, 'orphans', '2026-04-06 01:03:57', '2026-04-06 01:03:57'),
(5, 'Children\'s Books/Ages 9-12 Fiction', '2026-04-06 01:05:31', '2026-04-06 01:05:31'),
(6, 'the Elder Wand', '2026-04-06 01:06:10', '2026-04-06 01:06:10');

-- --------------------------------------------------------

--
-- Table structure for table `chat_histories`
--

CREATE TABLE `chat_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chat_histories`
--

INSERT INTO `chat_histories` (`id`, `user_id`, `book_id`, `role`, `message`, `created_at`, `updated_at`) VALUES
(1, 5, 5, 'user', 'what is the next part of this books?', '2026-04-06 02:55:31', '2026-04-06 02:55:31'),
(2, 5, 5, 'model', 'The next book in the Harry Potter series after \"Harry Potter and the Chamber of Secrets\" is \"Harry Potter and the Prisoner of Azkaban\"! It continues Harry\'s adventures and mysteries during his third year at Hogwarts. ✨', '2026-04-06 02:55:31', '2026-04-06 02:55:31'),
(3, 5, 5, 'user', 'how many chapters are in this books?', '2026-04-06 02:55:53', '2026-04-06 02:55:53'),
(4, 5, 5, 'model', '\"Harry Potter and the Chamber of Secrets\" has a total of eighteen chapters! Each one brings Harry closer to uncovering the mystery of the Chamber. 📖', '2026-04-06 02:55:53', '2026-04-06 02:55:53'),
(5, 5, 5, 'user', 'list the chapter names', '2026-04-06 02:56:06', '2026-04-06 02:56:06'),
(6, 5, 5, 'model', 'Certainly! Here are the chapter names from \"Harry Potter and the Chamber of Secrets\":\n\n1.  The Worst Birthday\n2.  Dobby\'s Warning\n3.  The Burrow\n4.  At Flourish and Blotts\n5.  The Whomping Willow\n6.  Gilderoy Lockhart\n7.  Mudbloods and Murmurs\n8.  The Deathday Party\n9.  The Writing on the Wall\n10. The Rogue Bludger\n11. The Duelling Club\n12. The Polyjuice Potion\n13. The Very Secret Diary\n14. Cornelius Fudge\n15. Aragog\n16. The Chamber of Secrets\n17. The Heir of Slytherin\n18. Dobby\'s Reward\n\nSuch an exciting journey through those chapters! 🤩', '2026-04-06 02:56:06', '2026-04-06 02:56:06');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `fine_appeals`
--

CREATE TABLE `fine_appeals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rental_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `reason` text NOT NULL,
  `status` enum('pending','resolved','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
-- Table structure for table `library_cards`
--

CREATE TABLE `library_cards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `status` enum('pending','approved','expired','revoked') NOT NULL DEFAULT 'pending',
  `issued_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `library_cards`
--

INSERT INTO `library_cards` (`id`, `user_id`, `student_id`, `department`, `status`, `issued_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 4, '232-25-040', 'Software Engineering', 'approved', '2026-04-04 13:11:40', '2026-10-04 13:11:40', '2026-04-04 13:07:46', '2026-04-04 13:11:40'),
(2, 5, '232-25-040', 'Software Engineering', 'approved', '2026-04-05 23:57:55', '2026-10-05 23:57:55', '2026-04-05 23:57:48', '2026-04-05 23:57:55');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_02_16_081939_create_items_table', 1),
(5, '2026_02_16_094431_create_categories_table', 1),
(6, '2026_02_16_094441_create_books_table', 1),
(7, '2026_02_16_094630_add_address_to_users_table', 1),
(8, '2026_02_16_111021_create_rentals_table', 2),
(9, '2026_04_04_000001_add_author_to_books_table', 3),
(10, '2026_04_04_000002_add_approval_status_to_rentals_table', 3),
(11, '2026_04_04_000003_create_wishlists_table', 3),
(12, '2026_04_04_000004_create_contacts_table', 3),
(13, '2026_04_04_100001_create_reading_progress_table', 4),
(14, '2026_04_04_182725_modify_books_table_for_remote_images', 5),
(15, '2026_04_04_185901_create_library_cards_table', 6),
(16, '2026_04_04_192315_add_fines_to_rentals_table', 7),
(17, '2026_04_04_192324_create_fine_appeals_table', 7),
(18, '2026_04_06_082903_create_chat_histories_table', 8);

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
-- Table structure for table `reading_progress`
--

CREATE TABLE `reading_progress` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `progress` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `status` enum('reading','completed') NOT NULL DEFAULT 'reading',
  `notes` text DEFAULT NULL,
  `started_at` timestamp NULL DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rentals`
--

CREATE TABLE `rentals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `return_date` date NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'online',
  `approval_status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fine_amount` int(11) NOT NULL DEFAULT 0,
  `due_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rentals`
--

INSERT INTO `rentals` (`id`, `user_id`, `book_id`, `student_id`, `return_date`, `quantity`, `status`, `approval_status`, `created_at`, `updated_at`, `fine_amount`, `due_date`) VALUES
(4, 4, 3, '232-35-040', '2026-04-09', 1, 'Offline', 'approved', '2026-04-04 13:18:04', '2026-04-06 01:11:41', 50, NULL),
(5, 4, 3, '232-35-040', '2026-04-14', 1, 'Online', 'returned', '2026-04-04 13:42:24', '2026-04-06 01:11:26', 50, NULL);

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
('wGv2EIHq7F8JFp6cB7WHAi4rD5NVR1ztKMlTFYBG', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWWtzZ1dqeHRsVm9peWs1QzhGSW9KeUYxdVEyQjc3YWZybDhpT3FNYiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9maWxlIjtzOjU6InJvdXRlIjtzOjEyOiJwcm9maWxlLmVkaXQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo1O30=', 1775470467),
('yygfrAILzw7bDPTrgK9js0R6vNd5BsVafC09Gs3p', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWnlodWdmZ0RvaW9TMTJySEVIUEVmMnZ5bEt3SmFHM015Mk5RVTZ4ZSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDk6Imh0dHA6Ly9sb2NhbGhvc3Qvc2Nob29sX3Byb2plY3QvcHVibGljL3VzZXIvYm9va3MiO3M6NToicm91dGUiO3M6MTA6InVzZXIuYm9va3MiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1775470367);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `address`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@example.com', NULL, 'admin', NULL, '21232f297a57a5a743894a0e4a801fc3', NULL, '2026-02-16 04:02:21', '2026-02-16 05:46:33'),
(2, 'user', 'user@user.com', NULL, 'user', NULL, '$2y$12$vkPJ24Tz347FlpfzlsEQSuymWcjnYanB8nBk3t0VExPmaYmPdEMAK', NULL, '2026-02-16 05:41:04', '2026-02-16 05:41:04'),
(3, 'xc', 'xc@xc.xc', 'xc', 'admin', NULL, '$2y$12$Oew.xyGmNtdCgoCJ1kbfD.rEUV7qFUxtVq2Op/ss56LqY01LpPsyq', NULL, '2026-03-06 19:59:04', '2026-03-06 19:59:04'),
(4, 'Mahadi', 'mahadi@gmail.com', NULL, 'admin', NULL, '21232f297a57a5a743894a0e4a801fc3', NULL, '2026-04-04 04:49:25', '2026-04-04 13:14:14'),
(5, 'Admin Mahadi', 'admin@mahadi.com', NULL, 'admin', NULL, '$2y$12$YWfRoukghecY0cXMody3POAQuJ2xiOS2LujAv7rI28w.ehNgsO4mq', NULL, '2026-04-05 23:56:16', '2026-04-05 23:56:16');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `books_category_id_foreign` (`category_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_histories`
--
ALTER TABLE `chat_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_histories_book_id_foreign` (`book_id`),
  ADD KEY `chat_histories_user_id_book_id_index` (`user_id`,`book_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contacts_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fine_appeals`
--
ALTER TABLE `fine_appeals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fine_appeals_rental_id_foreign` (`rental_id`),
  ADD KEY `fine_appeals_user_id_foreign` (`user_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_user_id_foreign` (`user_id`);

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
-- Indexes for table `library_cards`
--
ALTER TABLE `library_cards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `library_cards_user_id_foreign` (`user_id`);

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
-- Indexes for table `reading_progress`
--
ALTER TABLE `reading_progress`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reading_progress_user_id_book_id_unique` (`user_id`,`book_id`),
  ADD KEY `reading_progress_book_id_foreign` (`book_id`);

--
-- Indexes for table `rentals`
--
ALTER TABLE `rentals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rentals_user_id_foreign` (`user_id`),
  ADD KEY `rentals_book_id_foreign` (`book_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wishlists_user_id_book_id_unique` (`user_id`,`book_id`),
  ADD KEY `wishlists_book_id_foreign` (`book_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `chat_histories`
--
ALTER TABLE `chat_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fine_appeals`
--
ALTER TABLE `fine_appeals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `library_cards`
--
ALTER TABLE `library_cards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `reading_progress`
--
ALTER TABLE `reading_progress`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rentals`
--
ALTER TABLE `rentals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chat_histories`
--
ALTER TABLE `chat_histories`
  ADD CONSTRAINT `chat_histories_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chat_histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `fine_appeals`
--
ALTER TABLE `fine_appeals`
  ADD CONSTRAINT `fine_appeals_rental_id_foreign` FOREIGN KEY (`rental_id`) REFERENCES `rentals` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fine_appeals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `library_cards`
--
ALTER TABLE `library_cards`
  ADD CONSTRAINT `library_cards_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reading_progress`
--
ALTER TABLE `reading_progress`
  ADD CONSTRAINT `reading_progress_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reading_progress_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rentals`
--
ALTER TABLE `rentals`
  ADD CONSTRAINT `rentals_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rentals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
