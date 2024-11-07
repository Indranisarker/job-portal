-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 08, 2024 at 08:11 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `job_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Engineering', 1, NULL, NULL),
(2, 'Accountant', 1, NULL, NULL),
(3, 'Information Technology', 1, NULL, NULL),
(4, 'Web Designer', 1, NULL, NULL),
(5, 'Application Developer', 1, NULL, NULL),
(6, 'HR', 1, NULL, NULL);

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
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `job_type_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `vacancy` int(11) NOT NULL,
  `salary` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `experience` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `benefits` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `responsibilty` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qualification` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `main_branch` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `isFeatured` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `title`, `category_id`, `job_type_id`, `user_id`, `vacancy`, `salary`, `location`, `experience`, `description`, `benefits`, `responsibilty`, `qualification`, `company_name`, `main_branch`, `website`, `status`, `isFeatured`, `created_at`, `updated_at`) VALUES
(4, 'React Developer', 5, 1, 1, 3, '1.5k', 'Baridhara,Gulshan,Dhaka', '2', 'Develop applications using React', 'Good working environment', 'Develop applications using React', 'Must have good knowledge in React', 'DataSoft', '10, Mirpur, Dhaka', 'datasoft.com', 1, 1, '2024-08-28 01:46:48', '2024-08-28 12:13:18'),
(5, 'Java Developer', 5, 4, 1, 5, '80000', 'Mirpur - 5, Dhaka.', '2', 'Develop applications using Java', 'Good working environment', 'Develop applications using Java', 'Must have good knowledge in Java', 'Akij ios limited', 'Mirpur - 5, Dhaka.', 'akij.ios.com', 1, 1, '2024-08-28 01:46:48', '2024-08-28 12:04:24'),
(6, 'Web Application Developer', 5, 2, 1, 4, '35000', '10, Mirpur, Dhaka', '3', 'Develop applications using PHP', 'Good working environment', 'Develop applications using PHP', 'Must have good knowledge in PHP', 'DataSoft', '10, Mirpur, Dhaka', 'datasoft.com', 1, 1, '2024-08-28 01:46:48', '2024-08-28 12:45:37'),
(7, 'Frontend Developer - Intern', 4, 4, 2, 5, '12000', 'Bashundhara - 27, Dhaka', '0', 'Design applications', 'Good working environment', 'Design applications ', 'Must have good knowledge in Figma', 'City Bank', 'Bashundhara - 27,Dhaka', 'citybankplc.com', 1, 1, '2024-08-28 01:46:48', '2024-09-06 12:40:13'),
(9, 'Frontend Developer', 4, 3, 2, 2, '35000', '10, Mirpur, Dhaka', '3', 'Design applications', 'Good working environment', 'Design applications ', 'Must have good knowledge in Figma', 'DataSoft', '10, Mirpur, Dhaka', 'datasoft.com', 0, 0, '2024-08-28 01:46:48', '2024-08-28 01:46:48'),
(10, 'Software Engineer', 1, 1, 2, 7, '35000', '27, Dhanmondi, Dhaka', '3', 'Develop a software following SDLC', 'Good working environment', 'Design applications ', 'Need to know using software development tools.', 'Akij ios limited', '27, Dhanmondi, Dhaka', 'akij.ios..com', 1, 1, '2024-08-28 01:46:48', '2024-09-06 11:51:39'),
(11, 'Account Manager', 2, 3, 2, 2, '35000', '27, Dhanmondi, Dhaka', '3', 'Manages office accounts', 'Good working environment', 'Manages office accounts', 'Must have good knowledge in Accounting', 'SouthEast Bank', '10, Mirpur, Dhaka', 'southeastbank.com', 1, 1, '2024-08-28 01:46:48', '2024-08-28 01:46:48'),
(13, 'HR - Intern', 6, 3, 2, 2, '10000', '10, Mirpur, Dhaka', '3', 'Trainging on managing human resouces', 'Good working environment', 'Trainging on managing human resouces', 'Must have good knowledge about human resources', 'Eastern Bank', '10, Mirpur, Dhaka', 'easternbank.com', 1, 1, '2024-08-28 01:46:48', '2024-08-28 01:46:48'),
(18, 'IT-Engineer', 3, 2, 1, 4, '35000', 'Bashundhara, Block-A, Dhaka', '3', 'Develop applications using PHP', 'Good working environment', 'Develop applications using PHP', 'Must have good knowledge in PHP', 'W3 Engineering', 'Bashundhara, Block-A, Dhaka', 'w3enigineers.com', 1, 1, '2024-08-28 01:46:48', '2024-08-28 01:46:48'),
(19, 'Web Application Developer', 5, 2, 1, 4, '35000', '10, Mirpur, Dhaka', '3', 'Develop applications using PHP', 'Good working environment', 'Develop applications using PHP', 'Must have good knowledge in PHP', 'DataSoft', '10, Mirpur, Dhaka', 'datasoft.com', 1, 0, '2024-08-28 01:46:48', '2024-08-28 12:45:37'),
(20, 'React Developer', 5, 1, 1, 3, '1.5k', 'Baridhara,Gulshan,Dhaka', '2', 'Develop applications using React', 'Good working environment', 'Develop applications using React', 'Must have good knowledge in React', 'Akij ios', '10, Mirpur, Dhaka', 'akij.ios.com', 1, 0, '2024-08-28 01:46:48', '2024-08-28 01:46:48'),
(22, 'Frontend Developer - Intern', 4, 4, 2, 5, '12000', 'Bashundhara - 27, Dhaka', '0', 'Design applications', 'Good working environment', 'Design applications ', 'Must have good knowledge in Figma', 'City Bank', 'Bashundhara - 27,Dhaka', 'citybankplc.com', 1, 1, '2024-08-28 01:46:48', '2024-09-06 12:40:13'),
(23, 'Software Engineer', 1, 1, 2, 7, '35000', '27, Dhanmondi, Dhaka', '3', 'Develop a software following SDLC', 'Good working environment', 'Design applications ', 'Need to know using software development tools.', 'Akij ios limited', '27, Dhanmondi, Dhaka', 'akij.ios..com', 1, 1, '2024-08-28 01:46:48', '2024-09-06 11:51:39'),
(24, 'Account Manager', 2, 3, 2, 2, '35000', '27, Dhanmondi, Dhaka', '3', 'Manages office accounts', 'Good working environment', 'Manages office accounts', 'Must have good knowledge in Accounting', 'SouthEast Bank', '10, Mirpur, Dhaka', 'southeastbank.com', 1, 1, '2024-08-28 01:46:48', '2024-08-28 01:46:48'),
(25, 'HR - Intern', 6, 3, 2, 2, '10000', '10, Mirpur, Dhaka', '3', 'Trainging on managing human resouces', 'Good working environment', 'Trainging on managing human resouces', 'Must have good knowledge about human resources', 'Eastern Bank', '10, Mirpur, Dhaka', 'easternbank.com', 1, 1, '2024-08-28 01:46:48', '2024-08-28 01:46:48'),
(26, 'IT-Engineer', 3, 2, 1, 4, '35000', 'Bashundhara, Block-A, Dhaka', '3', 'Develop applications using PHP', 'Good working environment', 'Develop applications using PHP', 'Must have good knowledge in PHP', 'W3 Engineering', 'Bashundhara, Block-A, Dhaka', 'w3enigineers.com', 1, 1, '2024-08-28 01:46:48', '2024-08-28 01:46:48');

-- --------------------------------------------------------

--
-- Table structure for table `job_applications`
--

CREATE TABLE `job_applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `recruiter_id` bigint(20) UNSIGNED NOT NULL,
  `applied_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `cv` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_applications`
--

INSERT INTO `job_applications` (`id`, `job_id`, `user_id`, `recruiter_id`, `applied_date`, `cv`, `created_at`, `updated_at`) VALUES
(5, 11, 4, 2, '2024-09-02 02:09:58', '', '2024-09-02 02:09:58', '2024-09-02 02:09:58'),
(7, 4, 4, 1, '2024-09-07 02:05:53', '', '2024-09-07 02:05:53', '2024-09-07 02:05:53'),
(8, 18, 4, 1, '2024-09-07 10:53:34', 'cvs/ptMbFP9L9pH9lG2wGbBxw91Som5Zy3YxuY5Sn23u.pdf', '2024-09-07 10:53:34', '2024-09-07 10:53:34'),
(9, 6, 4, 1, '2024-09-07 11:41:11', 'cvs/dSrymRjdl2UJZYNAukqA2R5PR8o5cREa7UEjqaiL.docx', '2024-09-07 11:41:11', '2024-09-07 11:41:11'),
(10, 7, 4, 2, '2024-09-07 11:44:31', 'cvs/0NgqbJHAE4zByV0X5cgc8LYzs3uGC5rEXt9vzTej.docx', '2024-09-07 11:44:31', '2024-09-07 11:44:31');

-- --------------------------------------------------------

--
-- Table structure for table `job_types`
--

CREATE TABLE `job_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_types`
--

INSERT INTO `job_types` (`id`, `job_type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Full Time', 1, NULL, NULL),
(2, 'Part Time', 1, NULL, NULL),
(3, 'Remote', 1, NULL, NULL),
(4, 'Hybrid', 1, NULL, NULL),
(5, 'Freelance', 1, NULL, NULL);

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
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_08_25_152412_create_categories_table', 2),
(7, '2024_08_25_152451_create_job_types_table', 3),
(8, '2024_08_25_152537_create_jobs_table', 3),
(9, '2024_08_25_155855_drop_table_name', 3),
(10, '2024_08_25_190423_alter_jobs_table', 4),
(11, '2024_08_28_071634_alter_jobs_table', 5),
(12, '2024_09_01_182751_create_job_applications_table', 6),
(13, '2024_09_02_143617_create_saved_jobs_table', 7),
(14, '2024_09_05_055909_alter_users_table', 8),
(15, '2024_09_07_082002_alter__job_application_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `saved_jobs`
--

CREATE TABLE `saved_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `saved_jobs`
--

INSERT INTO `saved_jobs` (`id`, `job_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 4, 1, '2024-09-02 11:22:52', '2024-09-02 11:22:52'),
(3, 7, 4, '2024-09-07 11:45:13', '2024-09-07 11:45:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('user','admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `designation`, `phone_no`, `role`, `image`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Indrani Sarker', 'indranisarker7@gmail.com', NULL, '$2y$12$GrQB4.90RKNOhjRtXsh78u0r5eIQAM4kNfy.JUklvWLUmIdurqk9.', 'Web Developer (Java)', '01641012856', 'admin', '1-1724828088.jpg', NULL, '2024-08-25 00:30:38', '2024-09-06 01:20:02'),
(2, 'Mohit Singh', 'mohit@gmail.com', NULL, '$2y$12$1g7NYbYwuzVjWhahHAvAWOyfUCqhR8klOKSd/Rmzg2i/2NYgwEbFe', 'Accountant', '0289537576', 'user', NULL, NULL, '2024-08-25 00:35:57', '2024-08-25 00:35:57'),
(4, 'Mohit Chawhun', 'chawhun@gmail.com', NULL, '$2y$12$FczmB/DJiloKh.4IZGpgC.W21LWpvCcuf62Cx29WT3wVKGqFDwUia', 'Frontend Developer', '9275928365', 'user', '4-1725651347.jpg', NULL, '2024-08-25 00:42:08', '2024-09-06 13:35:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_category_id_foreign` (`category_id`),
  ADD KEY `jobs_job_type_id_foreign` (`job_type_id`),
  ADD KEY `jobs_user_id_foreign` (`user_id`);

--
-- Indexes for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_applications_job_id_foreign` (`job_id`),
  ADD KEY `job_applications_user_id_foreign` (`user_id`),
  ADD KEY `job_applications_recruiter_id_foreign` (`recruiter_id`);

--
-- Indexes for table `job_types`
--
ALTER TABLE `job_types`
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
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `saved_jobs`
--
ALTER TABLE `saved_jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `saved_jobs_job_id_foreign` (`job_id`),
  ADD KEY `saved_jobs_user_id_foreign` (`user_id`);

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `job_applications`
--
ALTER TABLE `job_applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `job_types`
--
ALTER TABLE `job_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `saved_jobs`
--
ALTER TABLE `saved_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `jobs_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jobs_job_type_id_foreign` FOREIGN KEY (`job_type_id`) REFERENCES `job_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jobs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD CONSTRAINT `job_applications_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_applications_recruiter_id_foreign` FOREIGN KEY (`recruiter_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_applications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `saved_jobs`
--
ALTER TABLE `saved_jobs`
  ADD CONSTRAINT `saved_jobs_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `saved_jobs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
