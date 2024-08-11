-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2024 at 09:33 AM
-- Server version: 8.0.33
-- PHP Version: 8.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ines_project_monitoring`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Faculty of Economics, Social Sciences and Management', 'Faculty of Economics, Social Sciences and Management', '2024-08-10 09:25:45', '2024-08-10 09:25:45'),
(2, 'Faculty of Education', 'Faculty of Education', '2024-08-10 09:25:45', '2024-08-10 09:25:45'),
(3, 'Faculty of Law and Public Administration', 'Faculty of Law and Public Administration', '2024-08-10 09:25:45', '2024-08-10 09:25:45'),
(4, 'Faculty of Engineering and Technology', 'Faculty of Engineering and Technology', '2024-08-10 09:25:45', '2024-08-10 09:25:45'),
(5, 'Faculty of Sciences and Information Technology', 'Faculty of Sciences and Information Technology', '2024-08-10 09:25:45', '2024-08-10 09:25:45'),
(6, 'Faculty of Health Sciences', 'Faculty of Health Sciences', '2024-08-10 09:25:45', '2024-08-10 09:25:45');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_08_09_055941_create_departments_table', 1),
(6, '2024_08_09_062246_create_students_table', 1),
(7, '2024_08_10_000516_create_projects_table', 1),
(8, '2024_08_10_112044_create_sponsers_table', 1),
(9, '2024_08_10_112202_create_orders_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `sponser_id` bigint UNSIGNED NOT NULL,
  `project_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `sponser_id`, `project_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2024-08-11 03:37:49', '2024-08-11 03:37:49');

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
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint UNSIGNED NOT NULL,
  `department_id` bigint UNSIGNED NOT NULL,
  `student_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `proposal_file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prototype_file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visible` enum('draft','publish') COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` bigint DEFAULT NULL,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isSponsered` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `department_id`, `student_id`, `title`, `description`, `proposal_file`, `prototype_file`, `visible`, `price`, `status`, `comment`, `isSponsered`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 'Fugiat esse nisi a c', '<h2>What is Lorem Ipsum?</h2><p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>', 'project/fK09j8OC77eRNzT7euVAJhsC0v1GLItkTYQ7lT8d.pdf', 'project/o0ctRluZNfuu3A7yhqgMvfKmQyXDRp1OAMyp1mMo.pdf', 'publish', 100, 'approved', 'Just approve', 0, '2024-08-10 09:44:49', '2024-08-10 13:55:24'),
(2, 4, 2, 'The standard Lorem Ipsum passage, used since the 1500s', '<p>\"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?\"</p>', 'project/IrnwS8tdQCTCbslMQhEfT0sMZGkXFnfX4Jg1wKF2.pdf', 'project/5mMzsYkEFlaQ8d6lcdhthIZFcEGQZhkIP47DYoda.pdf', 'publish', 200, 'approved', 'just approve', 1, '2024-08-10 12:32:03', '2024-08-11 03:37:49');

-- --------------------------------------------------------

--
-- Table structure for table `sponsers`
--

CREATE TABLE `sponsers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sponsers`
--

INSERT INTO `sponsers` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'BYAMUNGU Lewis', 'byamungulewis@gmail.com', '$2y$10$sJ3OXNCKGON6Qu9gNQdI2.nDqBqug/pGDVaHstuBDuxLBhhpua3IO', '2024-08-11 01:25:50', '2024-08-11 01:25:50'),
(2, 'Gail Schultz', 'laxiwiwi@mailinator.com', '$2y$10$NyAAKw5fyVLeboQ0nlf3bOOMVdrZlumBkVVvDVkrZKM/IZjy95JLK', '2024-08-11 01:45:30', '2024-08-11 01:45:30');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reg_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` bigint UNSIGNED NOT NULL,
  `option` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','block') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `academic_year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_status` enum('student','alumni') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'student',
  `completion_date` date DEFAULT NULL,
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `call_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `biography` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `email`, `reg_number`, `phone`, `department_id`, `option`, `password`, `status`, `academic_year`, `student_status`, `completion_date`, `profile_image`, `whatsapp_number`, `call_number`, `biography`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Avram Huffman', 'wakexuf@mailinator.com', '24/00001', '+1 (471) 601-7758', 5, 'Computer Science', '$2y$10$B0.Ck5qB.zgDnj7nT/wv5OveJ8Sj47KtKmBmCivGImKP0Zcel0P8i', 'active', '2023 - 2024', 'alumni', '2024-08-01', NULL, '07886665555', '07886656565', 'Just bio', NULL, '2024-08-10 09:39:06', '2024-08-10 12:26:37'),
(2, 'Stacey Odom', 'boviximy@mailinator.com', '24/00002', '+1 (421) 566-6125', 4, 'Ducimus accusamus t', '$2y$10$kywGs/avmrZR5ZUzvMhk/eqKnpZXZLWuu0PbBkdVyyxCMQGSJZA4W', 'active', '1973 - 2022', 'alumni', '2024-08-08', 'profile/FlwBIhgkcGAGzLDVVbNrP1sOra6YxfhZlLsnY5S4.png', '0787776633', '0787776633', 'Just bio information', NULL, '2024-08-10 09:39:17', '2024-08-11 07:37:31'),
(3, 'Oprah Holmes', 'nycuh@mailinator.com', '24/00003', '+1 (398) 632-3372', 5, 'Placeat quo cumque', NULL, 'active', '1973 - 1002', 'student', NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-10 12:30:25', '2024-08-10 12:30:25'),
(4, 'Hope Boone', 'jenocugo@mailinator.com', '24/00004', '+1 (523) 263-3177', 1, 'Et eveniet ea et ni', '$2y$10$S3k1FZH/VGD88CIKX02W4.rTvo1wuVNEQnr19VdBOH4i.ix7w675y', 'active', '1973 - 1974', 'student', NULL, 'profile/4PfsiBsLKnISLMRUr1JOyUCoQZHoh4OMtJmwTEnS.jpg', '07866637777', '+1 (523) 263-3177', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation u', NULL, '2024-08-11 07:58:26', '2024-08-11 08:21:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','block') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `role` enum('admin','academic','hod') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `status`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'BYAMUNGU Lewis', 'byamungulewis@gmail.com', '0785436135', '2024-08-10 09:25:45', '$2y$10$BR1WnkpIVki9BNViQLlbEePEqTKdwz24nmMnWTQN/.x6YCqNV2iWy', 'active', 'admin', 'Lo2lsGPBNWhRSJEd7b792Qu6LRcgGdzoJSODpwBKnXsgum0oCSyoTdcr0fsI', '2024-08-10 09:25:45', '2024-08-10 09:25:45'),
(2, 'vacuwyxyh', 'mucace@mailinator.com', '+1 (102) 611-5236', NULL, '$2y$10$AC8tsmsuWbn07N5KgUmoHuWBWOHNbE5T4ab910NZEkSHz13QPnadC', 'active', 'academic', NULL, '2024-08-10 09:32:33', '2024-08-10 09:32:33'),
(3, 'symyd na', 'wadan@mailinator.com', '+1 (145) 798-1243', NULL, '$2y$10$S7/ILEY0L.dkCCMZwhkjMeFgU0j4La.CpPDAC.eteO3MmUAsrxr4W', 'active', 'hod', NULL, '2024-08-10 09:35:57', '2024-08-10 09:35:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_sponser_id_foreign` (`sponser_id`),
  ADD KEY `orders_project_id_foreign` (`project_id`);

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
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projects_department_id_foreign` (`department_id`),
  ADD KEY `projects_student_id_foreign` (`student_id`);

--
-- Indexes for table `sponsers`
--
ALTER TABLE `sponsers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sponsers_email_unique` (`email`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_email_unique` (`email`),
  ADD UNIQUE KEY `students_reg_number_unique` (`reg_number`),
  ADD UNIQUE KEY `students_phone_unique` (`phone`),
  ADD KEY `students_department_id_foreign` (`department_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sponsers`
--
ALTER TABLE `sponsers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_sponser_id_foreign` FOREIGN KEY (`sponser_id`) REFERENCES `sponsers` (`id`) ON DELETE RESTRICT;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `projects_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
