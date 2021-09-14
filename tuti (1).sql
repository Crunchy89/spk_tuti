-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 14, 2021 at 11:07 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tuti`
--

-- --------------------------------------------------------

--
-- Table structure for table `akses`
--

CREATE TABLE `akses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `akses`
--

INSERT INTO `akses` (`id`, `menu_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 1, NULL, NULL),
(3, 1, 2, NULL, NULL),
(18, 9, 1, '2021-07-22 04:17:36', '2021-07-22 04:17:36'),
(19, 10, 1, '2021-07-22 19:36:58', '2021-07-22 19:36:58'),
(21, 11, 2, '2021-07-24 20:13:50', '2021-07-24 20:13:50'),
(22, 11, 1, '2021-07-25 21:11:07', '2021-07-25 21:11:07'),
(23, 12, 1, '2021-07-26 22:39:49', '2021-07-26 22:39:49'),
(24, 12, 2, '2021-07-26 22:53:39', '2021-07-26 22:53:39');

-- --------------------------------------------------------

--
-- Table structure for table `data_kelas`
--

CREATE TABLE `data_kelas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kelas_id` bigint(20) UNSIGNED NOT NULL,
  `siswa_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_kelas`
--

INSERT INTO `data_kelas` (`id`, `kelas_id`, `siswa_id`, `created_at`, `updated_at`) VALUES
(5, 4, 2, '2021-07-24 06:37:26', '2021-07-26 15:02:52'),
(6, 3, 1, '2021-07-24 06:37:26', '2021-07-24 06:37:26'),
(7, 4, 3, '2021-07-26 23:03:46', '2021-07-26 23:03:46'),
(8, 3, 4, '2021-07-26 23:03:53', '2021-07-26 23:03:53'),
(9, 4, 5, '2021-07-29 09:14:57', '2021-07-29 09:14:57'),
(10, 3, 6, '2021-07-29 09:57:56', '2021-07-29 09:57:56'),
(14, 6, 10, '2021-08-06 09:02:49', '2021-08-06 09:02:49'),
(15, 3, 11, '2021-08-06 09:04:53', '2021-08-06 09:04:53');

-- --------------------------------------------------------

--
-- Table structure for table `data_kuisioner`
--

CREATE TABLE `data_kuisioner` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_kriteria_1` bigint(20) UNSIGNED NOT NULL,
  `id_kriteria_2` bigint(20) UNSIGNED NOT NULL,
  `nilai` decimal(10,3) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_kuisioner`
--

INSERT INTO `data_kuisioner` (`id`, `id_user`, `id_kriteria_1`, `id_kriteria_2`, `nilai`, `created_at`, `updated_at`) VALUES
(68, 2, 1, 1, '1.000', '2021-07-25 05:39:08', '2021-07-25 05:39:08'),
(69, 2, 2, 2, '1.000', '2021-07-25 05:39:08', '2021-07-25 05:39:08'),
(70, 2, 3, 3, '1.000', '2021-07-25 05:39:08', '2021-07-25 05:39:08'),
(71, 2, 1, 2, '1.000', '2021-07-25 05:39:08', '2021-07-25 06:15:19'),
(72, 2, 1, 3, '9.000', '2021-07-25 05:39:08', '2021-07-25 06:15:19'),
(73, 2, 2, 1, '1.000', '2021-07-25 05:39:08', '2021-07-25 06:15:19'),
(74, 2, 2, 3, '7.000', '2021-07-25 05:39:08', '2021-07-25 06:15:19'),
(75, 2, 3, 1, '0.111', '2021-07-25 05:39:08', '2021-07-25 06:15:19'),
(76, 2, 3, 2, '0.143', '2021-07-25 05:39:08', '2021-07-25 06:15:19'),
(77, 3, 1, 1, '1.000', '2021-07-25 05:39:58', '2021-07-25 05:39:58'),
(78, 3, 2, 2, '1.000', '2021-07-25 05:39:58', '2021-07-25 05:39:58'),
(79, 3, 3, 3, '1.000', '2021-07-25 05:39:58', '2021-07-25 05:39:58'),
(80, 3, 1, 2, '1.000', '2021-07-25 05:39:58', '2021-07-25 05:39:58'),
(81, 3, 1, 3, '5.000', '2021-07-25 05:39:58', '2021-07-25 05:39:58'),
(82, 3, 2, 1, '1.000', '2021-07-25 05:39:58', '2021-07-25 05:39:58'),
(83, 3, 2, 3, '9.000', '2021-07-25 05:39:58', '2021-07-25 05:39:58'),
(84, 3, 3, 1, '0.200', '2021-07-25 05:39:58', '2021-07-25 05:39:58'),
(85, 3, 3, 2, '0.111', '2021-07-25 05:39:58', '2021-07-25 05:39:58'),
(86, 4, 1, 1, '1.000', '2021-07-25 10:37:26', '2021-07-25 10:37:26'),
(87, 4, 2, 2, '1.000', '2021-07-25 10:37:26', '2021-07-25 10:37:26'),
(88, 4, 3, 3, '1.000', '2021-07-25 10:37:26', '2021-07-25 10:37:26'),
(89, 4, 1, 2, '1.000', '2021-07-25 10:37:26', '2021-07-25 10:41:56'),
(90, 4, 1, 3, '7.000', '2021-07-25 10:37:26', '2021-07-25 10:41:56'),
(91, 4, 2, 1, '1.000', '2021-07-25 10:37:26', '2021-07-25 10:41:56'),
(92, 4, 2, 3, '5.000', '2021-07-25 10:37:26', '2021-07-25 10:41:56'),
(93, 4, 3, 1, '0.143', '2021-07-25 10:37:26', '2021-07-25 10:41:56'),
(94, 4, 3, 2, '0.200', '2021-07-25 10:37:26', '2021-07-25 10:41:56'),
(95, 5, 1, 1, '1.000', '2021-07-25 17:58:30', '2021-07-25 17:58:30'),
(96, 5, 2, 2, '1.000', '2021-07-25 17:58:30', '2021-07-25 17:58:30'),
(97, 5, 3, 3, '1.000', '2021-07-25 17:58:30', '2021-07-25 17:58:30'),
(98, 5, 1, 2, '1.000', '2021-07-25 17:58:30', '2021-07-25 17:58:30'),
(99, 5, 1, 3, '9.000', '2021-07-25 17:58:30', '2021-07-25 17:58:30'),
(100, 5, 2, 1, '1.000', '2021-07-25 17:58:30', '2021-07-25 17:58:30'),
(101, 5, 2, 3, '7.000', '2021-07-25 17:58:30', '2021-07-25 17:58:30'),
(102, 5, 3, 1, '0.111', '2021-07-25 17:58:30', '2021-07-25 17:58:30'),
(103, 5, 3, 2, '0.143', '2021-07-25 17:58:30', '2021-07-25 17:58:30'),
(104, 6, 1, 1, '1.000', '2021-07-29 09:57:43', '2021-07-29 09:57:43'),
(105, 6, 2, 2, '1.000', '2021-07-29 09:57:43', '2021-07-29 09:57:43'),
(106, 6, 3, 3, '1.000', '2021-07-29 09:57:43', '2021-07-29 09:57:43'),
(107, 6, 1, 2, '1.000', '2021-07-29 09:57:43', '2021-07-29 09:59:18'),
(108, 6, 1, 3, '9.000', '2021-07-29 09:57:43', '2021-07-29 09:59:18'),
(109, 6, 2, 1, '1.000', '2021-07-29 09:57:43', '2021-07-29 09:59:18'),
(110, 6, 2, 3, '8.000', '2021-07-29 09:57:43', '2021-07-29 09:59:18'),
(111, 6, 3, 1, '0.111', '2021-07-29 09:57:43', '2021-07-29 09:59:18'),
(112, 6, 3, 2, '0.125', '2021-07-29 09:57:43', '2021-07-29 09:59:18'),
(113, 7, 1, 1, '1.000', '2021-07-29 09:58:58', '2021-07-29 09:58:58'),
(114, 7, 2, 2, '1.000', '2021-07-29 09:58:58', '2021-07-29 09:58:58'),
(115, 7, 3, 3, '1.000', '2021-07-29 09:58:58', '2021-07-29 09:58:58'),
(116, 7, 1, 2, '1.000', '2021-07-29 09:58:58', '2021-07-29 09:58:58'),
(117, 7, 1, 3, '9.000', '2021-07-29 09:58:58', '2021-07-29 09:58:58'),
(118, 7, 2, 1, '1.000', '2021-07-29 09:58:58', '2021-07-29 09:58:58'),
(119, 7, 2, 3, '9.000', '2021-07-29 09:58:58', '2021-07-29 09:58:58'),
(120, 7, 3, 1, '0.111', '2021-07-29 09:58:58', '2021-07-29 09:58:58'),
(121, 7, 3, 2, '0.111', '2021-07-29 09:58:58', '2021-07-29 09:58:58'),
(122, 8, 1, 1, '1.000', '2021-07-29 10:00:41', '2021-07-29 10:00:41'),
(123, 8, 2, 2, '1.000', '2021-07-29 10:00:41', '2021-07-29 10:00:41'),
(124, 8, 3, 3, '1.000', '2021-07-29 10:00:41', '2021-07-29 10:00:41'),
(125, 8, 1, 2, '1.000', '2021-07-29 10:00:41', '2021-07-29 10:00:41'),
(126, 8, 1, 3, '5.000', '2021-07-29 10:00:41', '2021-07-29 10:00:41'),
(127, 8, 2, 1, '1.000', '2021-07-29 10:00:41', '2021-07-29 10:00:41'),
(128, 8, 2, 3, '7.000', '2021-07-29 10:00:41', '2021-07-29 10:00:41'),
(129, 8, 3, 1, '0.200', '2021-07-29 10:00:41', '2021-07-29 10:00:41'),
(130, 8, 3, 2, '0.143', '2021-07-29 10:00:41', '2021-07-29 10:00:41');

-- --------------------------------------------------------

--
-- Table structure for table `data_pelanggaran`
--

CREATE TABLE `data_pelanggaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `siswa_id` bigint(20) UNSIGNED NOT NULL,
  `pelanggaran_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_pelanggaran`
--

INSERT INTO `data_pelanggaran` (`id`, `siswa_id`, `pelanggaran_id`, `created_at`, `updated_at`) VALUES
(144, 6, 19, '2021-08-29 18:12:32', '2021-08-02 07:48:30'),
(145, 6, 39, '2021-08-29 18:12:32', '2021-08-02 07:48:35'),
(146, 6, 48, '2021-08-29 18:12:32', '2021-08-02 07:48:41'),
(150, 3, 3, '2021-08-29 18:14:31', '2021-08-02 07:48:48'),
(151, 3, 40, '2021-08-29 18:14:31', '2021-08-02 07:48:53'),
(152, 3, 46, '2021-08-29 18:14:31', '2021-08-02 07:48:57'),
(179, 1, 1, '2021-08-30 07:55:30', '2021-08-02 07:49:01'),
(180, 1, 45, '2021-08-30 07:55:30', '2021-08-02 07:49:12'),
(181, 2, 37, '2021-08-30 07:56:23', '2021-08-02 07:49:16'),
(182, 2, 40, '2021-08-30 07:56:23', '2021-08-02 07:49:19'),
(183, 2, 52, '2021-08-30 07:56:23', '2021-08-02 07:49:23'),
(197, 4, 20, '2021-08-30 08:01:13', '2021-08-02 07:49:26'),
(198, 4, 38, '2021-08-30 08:01:13', '2021-08-02 07:49:29'),
(199, 4, 52, '2021-08-30 08:01:13', '2021-08-02 07:49:32'),
(200, 7, 36, '2021-08-06 06:36:14', '2021-08-06 06:36:14'),
(201, 7, 42, '2021-08-06 06:36:14', '2021-08-06 06:36:14'),
(202, 9, 5, '2021-08-06 06:37:32', '2021-08-06 06:37:32'),
(203, 9, 55, '2021-08-06 06:37:32', '2021-08-06 06:37:32'),
(204, 8, 27, '2021-08-06 06:37:47', '2021-08-06 06:37:47'),
(205, 11, 27, '2021-08-06 09:07:30', '2021-08-06 09:07:30'),
(206, 11, 23, '2021-08-06 09:07:30', '2021-08-06 09:07:30'),
(207, 11, 26, '2021-08-06 09:07:30', '2021-08-06 09:07:30'),
(208, 11, 42, '2021-08-06 09:07:30', '2021-08-06 09:07:30'),
(209, 11, 43, '2021-08-06 09:07:30', '2021-08-06 09:07:30'),
(210, 11, 46, '2021-08-06 09:07:30', '2021-08-06 09:07:30'),
(211, 11, 52, '2021-08-06 09:07:30', '2021-08-06 09:07:30'),
(212, 11, 53, '2021-08-06 09:07:30', '2021-08-06 09:07:30');

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
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_guru` varchar(50) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id`, `nama_guru`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Ferdy Barliansyah, S.kom', 2, '2021-07-16 00:03:07', '2021-07-16 00:04:54'),
(2, 'Baiq Khairunnisa S.Kom', 3, '2021-07-22 07:09:59', '2021-07-22 07:09:59'),
(3, 'Khairoel Kahfi S.Kom', 4, '2021-07-25 10:36:19', '2021-07-25 10:36:19'),
(4, 'L. Riki Husada S.Kom', 5, '2021-07-25 17:19:47', '2021-07-25 17:19:47'),
(5, 'Rina Swantika S.Sos', 6, '2021-07-29 09:54:02', '2021-07-29 09:54:02'),
(6, 'Samsul Huda S.Mt', 7, '2021-07-29 09:54:29', '2021-07-29 09:54:29'),
(7, 'Safrudin S.H', 8, '2021-07-29 09:59:52', '2021-07-29 09:59:52');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_jurusan` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id`, `nama_jurusan`, `created_at`, `updated_at`) VALUES
(1, 'ELIN', '2021-07-22 06:35:29', '2021-07-29 01:55:43'),
(2, 'TBSM', '2021-07-22 06:35:35', '2021-07-29 01:55:37'),
(3, 'AV', '2021-07-29 01:56:02', '2021-07-29 01:56:02'),
(4, 'DPIB', '2021-07-29 01:56:09', '2021-07-29 01:56:09');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kelas` varchar(50) NOT NULL,
  `guru_id` bigint(20) UNSIGNED NOT NULL,
  `jurusan_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama_kelas`, `guru_id`, `jurusan_id`, `created_at`, `updated_at`) VALUES
(3, 'X ELIN', 1, 1, '2021-07-23 22:35:37', '2021-07-29 01:56:41'),
(4, 'X TBSM', 1, 2, '2021-07-26 15:02:40', '2021-07-29 01:56:30'),
(6, 'X DPIB', 2, 4, '2021-08-06 01:00:28', '2021-08-06 01:00:28');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kriteria` varchar(50) NOT NULL,
  `label` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id`, `nama_kriteria`, `label`, `created_at`, `updated_at`) VALUES
(1, 'Sikap & Prilaku', 'C1', '2021-07-24 09:39:35', '2021-07-24 09:39:35'),
(2, 'Kerajinan', 'C2', '2021-07-24 09:39:42', '2021-07-24 09:40:46'),
(3, 'Kerapian', 'C3', '2021-07-24 09:40:52', '2021-07-24 09:40:52');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aktif` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `urutan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `title`, `icon`, `link`, `aktif`, `urutan`, `created_at`, `updated_at`) VALUES
(1, 'Dashboard', 'cil-speedometer', 'admin', '1', 1, NULL, NULL),
(2, 'Pengaturan', 'cil-laptop', '#', '1', 2, NULL, NULL),
(9, 'Master Data', 'cil-list', '#', '1', 3, '2021-07-22 04:17:36', '2021-07-22 04:17:36'),
(10, 'Perhitungan AHP + SAW', 'cil-cog', '#', '1', 6, '2021-07-22 19:36:58', '2021-08-02 21:28:00'),
(11, 'Kuisioner Responden', 'cil-list', 'admin/kuisioner', '1', 5, '2021-07-24 19:31:59', '2021-08-02 21:28:00'),
(12, 'Data PD dan Pelanggaran', 'cil-user', 'admin/siswa', '1', 4, '2021-07-26 22:39:49', '2021-07-30 00:55:50');

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
(1, '2013_05_24_013208_create_roles_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2021_04_02_042135_create_menus_table', 1),
(6, '2021_04_02_042618_create_submenus_table', 1),
(7, '2021_04_02_043118_create_akses_table', 1),
(8, '2021_05_26_081610_create_sliders_table', 2),
(9, '2021_05_26_223623_create_kategori_beritas_table', 3),
(10, '2021_05_27_060023_create_beritas_table', 4),
(11, '2021_07_08_013346_create_komentars_table', 5);

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
-- Table structure for table `pelanggaran`
--

CREATE TABLE `pelanggaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kriteria_id` bigint(20) UNSIGNED NOT NULL,
  `pelanggaran` text NOT NULL,
  `bobot` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggaran`
--

INSERT INTO `pelanggaran` (`id`, `kriteria_id`, `pelanggaran`, `bobot`, `created_at`, `updated_at`) VALUES
(1, 1, 'Tidak membawa buku dan perlengkapan belajar sesuai dengan pelajaran', 2, '2021-07-26 05:47:12', '2021-07-26 05:48:41'),
(3, 1, 'Mengganggu ketenangan kegiatan belajar Mengajar', 5, '2021-07-26 05:50:43', '2021-07-26 05:50:43'),
(4, 1, 'Membuang sampah tidak pada tempatnya', 5, '2021-07-26 05:51:44', '2021-07-26 05:51:44'),
(5, 1, 'Meludah, membuang atau melempar benda dalam kelas', 5, '2021-07-26 05:52:14', '2021-07-26 05:52:14'),
(6, 1, 'Mencoret-coret dinding, buku saku, meja atau lainnya', 10, '2021-07-26 05:52:56', '2021-07-26 05:52:56'),
(7, 1, 'Membawa atau bermain bola di kelas', 10, '2021-07-26 05:53:36', '2021-07-26 05:53:36'),
(8, 1, 'Menghidupkan musik, TV, Radio di kelas tanpa izin', 10, '2021-07-26 05:54:15', '2021-07-26 05:54:15'),
(9, 1, 'Merayakan ulang tahun di sekolah', 5, '2021-07-26 05:54:32', '2021-07-26 05:54:32'),
(10, 1, 'Mengadakan kegiatan utang-piutang di sekolah', 10, '2021-07-26 05:54:52', '2021-07-26 05:54:52'),
(11, 1, 'Tidak memakai baju olahraga/praktik saat pelajaran olahraga/praktik', 4, '2021-07-26 05:55:24', '2021-07-26 05:55:24'),
(12, 1, 'Mengancam/mengintimidasi', 10, '2021-07-26 05:55:39', '2021-07-26 05:55:39'),
(13, 1, 'Membawa atau merokok di lingkungan sekolah', 25, '2021-07-26 05:56:11', '2021-07-26 05:56:11'),
(14, 1, 'Merusak sarana dan prasarana sekolah', 25, '2021-07-26 05:56:29', '2021-07-26 05:56:29'),
(15, 1, 'Menggunakan HP pada saat belajar di kelas/membawa HP', 10, '2021-07-26 05:56:52', '2021-07-26 05:56:52'),
(16, 1, 'Melakukan kegiatan pemalakan', 50, '2021-07-26 05:57:06', '2021-07-26 05:57:06'),
(17, 1, 'Mengambil hak orang lain atau mencuri', 50, '2021-07-26 05:57:28', '2021-07-26 05:57:28'),
(18, 1, 'Berkata jorok', 10, '2021-07-26 05:57:40', '2021-07-26 05:57:40'),
(19, 1, 'Bertindak tidak sopan pada guru/karyawan/tamu', 20, '2021-07-26 05:58:05', '2021-07-26 05:58:05'),
(20, 1, 'Membawa tanpa ijin senjata tajam, senjata api dan sejenisnya', 30, '2021-07-26 05:58:32', '2021-07-26 05:58:32'),
(21, 1, 'Mengajak teman luar ke sekolah tanpa ijin sekolah', 5, '2021-07-26 05:59:01', '2021-07-26 05:59:01'),
(22, 1, 'Memalsukan tanda tangan/memalsukan identitas', 30, '2021-07-26 05:59:31', '2021-07-26 05:59:31'),
(23, 1, 'Berkelahi di lingkungan sekolah', 75, '2021-07-26 05:59:49', '2021-07-26 05:59:49'),
(24, 1, 'Menggunakan seragam sekolah pada saat nongkrong/keluyuran', 10, '2021-07-26 06:00:17', '2021-07-26 06:00:17'),
(25, 1, 'Menggunakan seragam sekolah tidak sesuai dengan ketentuan', 10, '2021-07-26 06:00:37', '2021-07-26 06:00:37'),
(26, 1, 'Loncat tembok/pagar sekolah', 50, '2021-07-26 06:00:53', '2021-07-26 06:00:53'),
(27, 1, 'Berjudi di sekolah', 50, '2021-07-26 06:01:02', '2021-07-26 06:01:02'),
(28, 1, 'Merubah raport dan merubah nilai raport tanpa ijin sekolah', 75, '2021-07-26 06:01:27', '2021-07-26 06:01:27'),
(29, 1, 'Terlibat tauran antar sekolah', 50, '2021-07-26 06:01:44', '2021-07-26 06:01:44'),
(30, 1, 'Berprilaku jorok (Asusila)', 50, '2021-07-26 06:01:59', '2021-07-26 06:01:59'),
(31, 1, 'Terlibat tindakan kriminal', 75, '2021-07-26 06:02:54', '2021-07-26 06:02:54'),
(32, 1, 'Membawa/menonton film porno dalam HP, VCD/buku porno', 50, '2021-07-26 06:03:25', '2021-07-26 06:03:25'),
(33, 1, 'Membawa/minum-minuman keras/mabuk di sekolah', 60, '2021-07-26 06:03:47', '2021-07-26 06:03:47'),
(34, 1, 'Bertato/bertindik baru', 50, '2021-07-26 06:04:01', '2021-07-26 06:04:01'),
(35, 1, 'Kencing dalam ruang kelas', 50, '2021-07-26 06:04:13', '2021-07-26 06:04:13'),
(36, 1, 'Membawa/mengedarkan/memakai narkoba', 100, '2021-07-26 06:04:30', '2021-07-26 06:04:30'),
(37, 1, 'Nikah/hamil/berzina', 100, '2021-07-26 06:04:54', '2021-07-26 06:04:54'),
(38, 2, 'Tidak masuk sekolah tanpa keterangan', 4, '2021-07-26 06:05:26', '2021-07-26 06:05:26'),
(39, 2, 'Tidak melaksanakan tugas komisaris kelas', 2, '2021-07-26 06:05:49', '2021-07-26 06:05:49'),
(40, 2, 'Tidak memiliki kartu pelajar', 10, '2021-07-26 06:06:03', '2021-07-26 06:06:03'),
(41, 2, 'Tidak membawa buku saku', 10, '2021-07-26 06:06:26', '2021-07-26 06:06:26'),
(42, 2, 'Datang terlambat lebih dari 10 menit', 3, '2021-07-26 06:06:42', '2021-07-26 06:06:42'),
(43, 2, 'Tidak mengikuti pelajaran tanpa ijin/bolos', 3, '2021-07-26 06:07:04', '2021-07-26 06:07:04'),
(44, 2, 'Tidak mengerjakan tugas/pekerjaan rumah', 2, '2021-07-26 06:07:26', '2021-07-26 06:07:26'),
(45, 2, 'Tidak mengikuti/terlambat mengikuti upacara bendera/imtaq', 2, '2021-07-26 06:07:51', '2021-07-26 06:07:51'),
(46, 3, 'Baju seragam tidak dimasukkan (kecuali siswa ada saku di bawah)', 2, '2021-07-26 06:08:31', '2021-07-26 06:08:31'),
(47, 3, 'Siswa pakai jilbab tidak sesuai ketentuan', 2, '2021-07-26 06:08:49', '2021-07-26 06:08:49'),
(48, 3, 'Siswa memakai celana sebatas pinggang (dibawah pusar) bagian celana menyentuh tanah/dilipat, lebar > 24 cm/celana ketat', 5, '2021-07-26 06:10:02', '2021-07-26 06:10:43'),
(49, 3, 'Siswa menggunakan rok sebatas pinggang (dibawah pusar) bagian bawah menyentuh tanah', 5, '2021-07-26 06:10:34', '2021-07-26 06:10:34'),
(50, 3, 'Masuk lingkungan sekolah tanpa menggunakan atribut sekolah kecuali sudah ada ijin', 5, '2021-07-26 06:11:10', '2021-07-26 06:11:10'),
(51, 3, 'Tidak memakai sepatu hitam, tali tidak sesuai (hitam,putih)', 5, '2021-07-26 06:11:37', '2021-07-26 06:11:37'),
(52, 3, 'Berambut gondrong atau tidak sesuai dengan model dari sekolah (khusus pria)', 5, '2021-07-26 06:13:05', '2021-07-26 06:13:05'),
(53, 3, 'Tidak menggunakan ikat pinggang', 5, '2021-07-26 06:13:20', '2021-07-26 06:13:20'),
(54, 3, 'Rambut disemir warna warni', 5, '2021-07-26 06:13:45', '2021-07-26 06:13:45'),
(55, 3, 'Bersolek berlebihan bagi perempuan', 5, '2021-07-26 06:14:09', '2021-07-26 06:14:09');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, NULL),
(2, 'Guru', NULL, '2021-07-15 23:49:50');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_siswa` varchar(50) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `nisn` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `nama_siswa`, `jk`, `nisn`, `created_at`, `updated_at`) VALUES
(1, 'M. Dahlan', 'L', '1111', '2021-07-16 00:25:50', '2021-07-29 10:03:49'),
(2, 'Nurul Aini', 'P', '1112', '2021-07-22 17:59:57', '2021-07-29 10:02:16'),
(3, 'M. Saleh', 'L', '1113', '2021-07-26 15:03:16', '2021-07-29 10:03:22'),
(4, 'Indah Maharani', 'P', '1114', '2021-07-26 15:03:27', '2021-07-29 10:03:06'),
(5, 'L. Ahmad Safrudin', 'L', '1115', '2021-07-29 01:14:49', '2021-07-29 10:02:38'),
(6, 'Dina Apriliana', 'P', '1116', '2021-07-29 01:55:23', '2021-07-29 10:02:53'),
(7, 'Saifullah', 'L', '1117', '2021-07-29 10:04:14', '2021-07-29 10:04:14'),
(8, 'trisna', 'L', '1201', '2021-08-02 01:05:55', '2021-08-02 01:05:55'),
(9, 'sarma', 'P', '1123', '2021-08-02 01:06:13', '2021-08-02 01:06:13'),
(10, 'saful hamdi', 'L', '12345', '2021-08-06 00:58:32', '2021-08-06 00:58:32'),
(11, 'saikin', 'P', '1134', '2021-08-06 01:03:56', '2021-08-06 01:03:56');

-- --------------------------------------------------------

--
-- Table structure for table `submenu`
--

CREATE TABLE `submenu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aktif` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `urutan` int(11) NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `submenu`
--

INSERT INTO `submenu` (`id`, `title`, `link`, `aktif`, `urutan`, `menu_id`, `created_at`, `updated_at`) VALUES
(1, 'Master Role', 'admin/role', '1', 1, 2, NULL, '2021-07-15 22:41:50'),
(2, 'Master Menu', 'admin/menu', '1', 2, 2, NULL, '2021-05-25 23:41:04'),
(3, 'Master Akses', 'admin/akses', '1', 3, 2, NULL, '2021-05-25 23:41:12'),
(4, 'Master User', 'admin/user', '1', 4, 2, NULL, '2021-05-25 23:41:18'),
(21, 'Data Guru', 'admin/data', '1', 1, 9, '2021-07-22 04:18:05', '2021-07-22 04:18:05'),
(22, 'Data Peserta Didik', 'admin/data/siswa', '1', 2, 9, '2021-07-22 04:18:39', '2021-07-30 00:58:26'),
(23, 'Data Jurusan', 'admin/data/jurusan', '1', 3, 9, '2021-07-22 04:18:55', '2021-07-22 06:34:52'),
(24, 'Data Kelas', 'admin/data/kelas', '1', 4, 9, '2021-07-22 04:19:10', '2021-07-22 04:19:10'),
(25, 'Data Kriteria', 'admin/perhitungan', '1', 1, 10, '2021-07-22 19:37:16', '2021-07-22 19:37:16'),
(27, 'Perhitungan GeoMean AHP', 'admin/perhitungan/geomean', '1', 2, 10, '2021-07-25 03:10:54', '2021-07-25 03:10:54'),
(28, 'Perhitungan SAW', 'admin/perhitungan/saw', '1', 3, 10, '2021-07-27 02:20:18', '2021-07-27 02:20:18');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `aktif` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `deleted`, `aktif`, `role_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '$2y$10$UVPFcrLrqcv5L8/H8kG7AuvEmsstncdheJCMDK.wbHhXqJ2njf6aK', '0', '1', 1, NULL, NULL, '2021-07-16 00:11:55'),
(2, 'Ferdy', '$2y$10$hIkX2qgw6M6fww73tAjn9u0jBMbfjB/DTW8Tk/LQQotxsN8Se1T.W', '0', '1', 2, NULL, '2021-07-16 00:03:07', '2021-07-25 05:37:31'),
(3, 'icha', '$2y$10$u04fMtBiG70oSQkk5WINwO.HWJM/xMoRDXxINHCvYR0okOEYlcrCK', '0', '1', 2, NULL, '2021-07-22 07:09:59', '2021-08-02 00:46:43'),
(4, 'kahfi', '$2y$10$xVKeTcteSPfjUNpRi4lvB.FZnVZ9Fn/UOIsMzTTWd1t7Q.tUqks0K', '0', '1', 2, NULL, '2021-07-25 10:36:19', '2021-08-02 00:52:22'),
(5, 'riki', '$2y$10$56qzZBezGoN74lH43iX.9O8sQsViuFlAcnPg6.thlE/sRR425aKXS', '0', '1', 2, NULL, '2021-07-25 17:19:47', '2021-07-25 17:19:47'),
(6, 'rina', '$2y$10$yWiLJNWiS9nz/qlm9yc/kuXgKcfIYfaZUKTZ6m6C6Za.T4bHlg9ei', '0', '1', 2, NULL, '2021-07-29 09:54:02', '2021-07-29 09:54:02'),
(7, 'huda', '$2y$10$p/LFe54xRwdCg8PmYpLuHutgD2bgMbBbgOOubVxxpBGPGOL7veT/u', '0', '1', 2, NULL, '2021-07-29 09:54:29', '2021-07-29 09:54:29'),
(8, 'udin', '$2y$10$nnwy20DvcptxPqUrq//hb./eCkZQ/d8TS.6I7JF69DmFn.COjQqya', '0', '1', 2, NULL, '2021-07-29 09:59:52', '2021-07-29 09:59:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akses`
--
ALTER TABLE `akses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `akses_menu_id_foreign` (`menu_id`),
  ADD KEY `akses_role_id_foreign` (`role_id`);

--
-- Indexes for table `data_kelas`
--
ALTER TABLE `data_kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_kelas_foreign_siswa` (`siswa_id`),
  ADD KEY `data_kelas_foreign_kelas` (`kelas_id`);

--
-- Indexes for table `data_kuisioner`
--
ALTER TABLE `data_kuisioner`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ahp_foreign_user` (`id_user`),
  ADD KEY `ahp_foreign_kriteria_1` (`id_kriteria_1`),
  ADD KEY `ahp_foreign_kriteria_2` (`id_kriteria_2`);

--
-- Indexes for table `data_pelanggaran`
--
ALTER TABLE `data_pelanggaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_pelanggaran_foreign_siswa` (`siswa_id`),
  ADD KEY `data_pelanggaran_foreign_pelanggaran` (`pelanggaran_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guru_foreign_user` (`user_id`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelas_foreign_guru` (`guru_id`),
  ADD KEY `kelas_foreign_jurusan` (`jurusan_id`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `label` (`label`(3));

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelanggaran_foreign_kriteria` (`kriteria_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submenu`
--
ALTER TABLE `submenu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `submenu_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_username_unique` (`username`),
  ADD KEY `user_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akses`
--
ALTER TABLE `akses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `data_kelas`
--
ALTER TABLE `data_kelas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `data_kuisioner`
--
ALTER TABLE `data_kuisioner`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `data_pelanggaran`
--
ALTER TABLE `data_pelanggaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `submenu`
--
ALTER TABLE `submenu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `akses`
--
ALTER TABLE `akses`
  ADD CONSTRAINT `akses_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `akses_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_kelas`
--
ALTER TABLE `data_kelas`
  ADD CONSTRAINT `data_kelas_foreign_kelas` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `data_kelas_foreign_siswa` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_kuisioner`
--
ALTER TABLE `data_kuisioner`
  ADD CONSTRAINT `ahp_foreign_kriteria_1` FOREIGN KEY (`id_kriteria_1`) REFERENCES `kriteria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ahp_foreign_kriteria_2` FOREIGN KEY (`id_kriteria_2`) REFERENCES `kriteria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ahp_foreign_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_pelanggaran`
--
ALTER TABLE `data_pelanggaran`
  ADD CONSTRAINT `data_pelanggaran_foreign_pelanggaran` FOREIGN KEY (`pelanggaran_id`) REFERENCES `pelanggaran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `data_pelanggaran_foreign_siswa` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `guru`
--
ALTER TABLE `guru`
  ADD CONSTRAINT `guru_foreign_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_foreign_guru` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kelas_foreign_jurusan` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
  ADD CONSTRAINT `pelanggaran_foreign_kriteria` FOREIGN KEY (`kriteria_id`) REFERENCES `kriteria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `submenu`
--
ALTER TABLE `submenu`
  ADD CONSTRAINT `submenu_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
