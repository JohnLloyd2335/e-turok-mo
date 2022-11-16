-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2022 at 01:36 AM
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
-- Database: `capstone`
--

-- --------------------------------------------------------

--
-- Table structure for table `archives`
--

CREATE TABLE `archives` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `immunization_id` bigint(20) NOT NULL,
  `immunization_category_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `place_of_birth` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barangay` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `municipality` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `height` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vaccine_received` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `doses` int(11) NOT NULL,
  `doses_received` int(11) NOT NULL,
  `first_dose_schedule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_dose_vaccinated_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `second_dose_schedule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `second_dose_vaccinated_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `third_dose_schedule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `third_dose_vaccinated_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_recorded` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `immunizations`
--

CREATE TABLE `immunizations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `immunization_category_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `place_of_birth` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barangay` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `municipality` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `height` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vaccine_received` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `doses` int(11) NOT NULL,
  `doses_received` int(11) NOT NULL,
  `first_dose_schedule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_dose_vaccinated_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `second_dose_schedule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `second_dose_vaccinated_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `third_dose_schedule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `third_dose_vaccinated_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_recorded` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `immunizations`
--

INSERT INTO `immunizations` (`id`, `immunization_category_id`, `first_name`, `middle_name`, `last_name`, `age`, `date_of_birth`, `place_of_birth`, `barangay`, `municipality`, `province`, `contact_no`, `mother_full_name`, `father_full_name`, `weight`, `height`, `gender`, `vaccine_received`, `doses`, `doses_received`, `first_dose_schedule`, `first_dose_vaccinated_at`, `second_dose_schedule`, `second_dose_vaccinated_at`, `third_dose_schedule`, `third_dose_vaccinated_at`, `remarks`, `date_recorded`, `created_at`, `updated_at`) VALUES
(1, 1, 'Chaney', 'Skyler Marks', 'Graham', '1 months old', '2022-09-24', 'Aplaya Pila Laguna', 'Aplaya', 'Pila', 'Laguna', '09223644367', 'Kelly Graham', 'Alexander Graham', '3', '48', 'Male', 'Pentavalent Vaccine (DPT-Hep B-HIB)', 3, 1, '2022-01-24 09:40', 'Brgy. Aplaya Health Center', '2022-02-24 09:40', 'Brgy. Aplaya Health Center', '2022-03-24 09:40', 'Brgy. Aplaya Health Center', 'Sample Remarks', '2022-01-24', '2022-10-24 10:40:22', '2022-10-24 10:40:22'),
(2, 1, 'Meredith', 'Hiroko Murray', 'Davenport', '5 months old', '2022-05-05', 'Laboriosam aut ipsa', 'Pansol', 'Pila', 'Laguna', '09890696371', 'Britanney Davenport', 'Todd Davenport', '3', '50', 'Female', 'BCG Vaccine', 3, 1, '2022-01-22 10:00', 'Brgy. Pansol Health Center', '2022-02-22 10:00', 'Brgy. Pansol Health Center', '2022-03-22 10:00', 'Brgy. Pansol Health Center', 'Sample Remarks', '2022-01-22', '2022-10-24 10:42:40', '2022-10-24 10:42:40'),
(3, 1, 'Quamar', 'Arthur Ball', 'Middleton', '0 months old', '2022-10-01', 'Rem voluptate aut do', 'Bukal', 'Pila', 'Laguna', '09141071497', 'Dai Middleton', 'Trevor Middleton', '3', '45', 'Male', 'Pentavalent Vaccine (DPT-Hep B-HIB)', 3, 1, '2022-02-02 8:30', 'Brgy. Bukal Health Center', '2022-03-02 8:30', 'Brgy. Bukal Health Center', '2022-03-02 8:30', 'Brgy. Bukal Health Center', 'Sample Remarks', '2022-02-02', '2022-10-24 10:47:31', '2022-10-24 10:47:31'),
(4, 1, 'Felix', 'Basil Robinson', 'Tran', '4 months old', '2022-06-07', 'Mojon Pila Laguna', 'Mojon', 'Pila', 'Laguna', '09656958412', 'Jaime Tran', 'Kyle Tran', '6', '51', 'Male', 'Inactivated Polio Vaccine (IPV)', 2, 2, '2022-03-18 13:00', 'Brgy. Mojon Health Center', '2022-04-18 13:00', 'Brgy. Mojon Health Center', 'Not Applicable', 'Not Applicable', 'Sample Remarks', '2022-03-18', '2022-10-24 10:52:28', '2022-11-13 16:33:57'),
(5, 1, 'Erich', 'Ryder Richardson', 'Perry', '2 months old', '1988-07-28', 'Ea dolores doloribus', 'Tubuan', 'Pila', 'Laguna', '09305505351', 'Tatiana Perry', 'Gay Perry', '3', '50', 'Female', 'Pneumococal Conjugate Vaccine (PCV)', 3, 3, '2022-03-20 07:30', 'Brgy. Tubuan Health Center', '2022-04-20T07:30', 'Brgy. Tubuan Health Center', '2022-05-20 07:30', 'Brgy. Tubuan Health Center', 'Sample Remarks', '2022-03-20', '2022-10-24 10:58:25', '2022-11-13 16:34:09'),
(6, 2, 'Veda', 'Brittany Munoz', 'Richmond', '7 years old', '2015-01-02', 'Est explicabo Pari', 'Linga', 'Pila', 'Laguna', '09817974571', 'Barclay Richmond', 'Renee Richmond', '18', '101', 'Female', 'Measles Containing Vaccine (MCV) MR/MMR', 3, 1, '2022-04-20 9:00', 'Brgy. Linga Health Center', '2022-05-20 9:00', 'Brgy. Linga Health Center', '2022-06-20 9:00', 'Brgy. Linga Health Center', 'Sample Remarks', '2022-04-20', '2022-10-24 11:09:01', '2022-10-24 11:09:01'),
(7, 2, 'Candace', 'Erasmus Emerson', 'Dodson', '9 years old', '2013-08-27', 'Et adipisci veniam', 'Mojon', 'Pila', 'Laguna', '09567682445', 'Kyla Dodson', 'Shawn Dodson', '17', '122', 'Female', 'Tetanus Diphtheria(TD)', 2, 1, '2022-04-24 9:00', 'Brgy. Mojon Health Center', '2022-05-24 9:00', 'Brgy. Mojon Health Center', 'Not Applicable', 'Not Applicable', 'Sample Remarks', '2022-04-24', '2022-10-24 11:12:03', '2022-10-24 11:12:03'),
(8, 2, 'Inez', 'Walter', 'Bradshaw', '6 years old', '2016-01-16', 'Quia numquam non mol', 'Bagong Pook', 'Pila', 'Laguna', '09098233690', 'Indie Bradshaw', 'Armando Bradshaw', '45', '10', 'Female', 'Tetanus Diphtheria(TD)', 2, 1, '2022-05-01 13:30', 'Brgy. Bagong Pook Health Center', '2022-06-01 13:30', 'Brgy. Bagong Pook Health Center', 'Not Applicable', 'Not Applicable', 'Excepturi atque cupi', '2022-05-01', '2022-10-24 11:14:39', '2022-10-24 11:14:39'),
(9, 2, 'Gay', 'Galvin Crane', 'Ford', '7 years old', '2014-11-14', 'Maxime amet molesti', 'Pansol', 'Pila', 'Laguna', '09087538669', 'Odessa Ford', 'Samson Sampson', '25', '127', 'Male', 'Measles Containing Vaccine (MCV) MR/MMR', 3, 1, '2022-06-05 11:00', 'Brgy. Pansol Health Center', '2022-07-05 11:00', 'Brgy. Pansol Health Center', '2022-08-05 11:00', 'Brgy. Pansol Health Center', 'Sample Remarks', '2022-06-05', '2022-10-24 11:16:53', '2022-10-24 11:16:53'),
(10, 2, 'Dominique', 'Dawn Delgado', 'Richards', '6 years old', '2015-12-16', 'Enim ut non deleniti', 'Concepcion', 'Pila', 'Laguna', '09137574561', 'Nasim Richards', 'Kith Richards', '19', '123', 'Male', 'Measles Containing Vaccine (MCV) MR/MMR', 3, 1, '2022-06-25 10:00', 'Brgy. Concepcion Health Center', '2022-07-25 10:00', 'Brgy. Concepcion Health Center', '2022-08-25 10:00', 'Brgy. Concepcion Health Center', 'Sample Remarks', '2022-06-25', '2022-10-24 11:21:14', '2022-10-24 11:21:14'),
(11, 3, 'Carol', 'Teegan Lindsay', 'Walton', '25 years old', '1997-07-10', 'Omnis sint vel qui', 'Bulilan Norte', 'Pila', 'Laguna', '09191503540', 'Kyla Walton', 'Dominic Walton', '50', '150', 'Female', 'Tetanus, Diphtheria, and Pertussis(TDAP)', 3, 1, '2022-07-05 11:00', 'Brgy. Bulilan Norte Health Center', '2022-08-05 11:00', 'Brgy. Bulilan Norte Health Center', '2022-09-05 11:00', 'Brgy. Bulilan Norte Health Center', 'Sample Remarks', '2022-07-05', '2022-10-24 11:33:37', '2022-10-24 11:33:37'),
(12, 3, 'Alice', 'Alec Rivas', 'Gross', '21 years old', '2001-04-23', 'Dolor amet eum et a', 'Bukal', 'Pila', 'Laguna', '09161276284', 'Vance Gross', 'Devin Gross', '55', '160', 'Female', 'Tetanus, Diphtheria, and Pertussis(TDAP)', 3, 1, '2022-08-16 10:00', 'Brgy. Bukal Health Center', '2022-09-16 10:00', 'Brgy. Bukal Health Center', '2022-10-16 10:00', 'Brgy. Bukal Health Center', 'Sample Remarks', '2022-08-16', '2022-10-24 11:36:57', '2022-10-24 11:36:57'),
(13, 3, 'Elaine', 'Porter Valenzuela', 'Cunningham', '21 years old', '2000-11-30', 'Earum libero eveniet', 'Santa Clara Norte', 'Pila', 'Laguna', '09138089470', 'Jasmine Cunningham', 'Barclay Cunningham', '50', '105', 'Female', 'Tetanus, Diphtheria, and Pertussis(TDAP)', 3, 1, '2022-08-24 12:30', 'Brgy. Santa Clara Norte Health Center', '2022-09-24 12:30', 'Brgy. Santa Clara Norte Health Center', '2022-10-24 12:30', 'Brgy. Santa Clara Norte Health Center', 'Sample Remarks', '2022-08-24', '2022-10-24 11:43:13', '2022-10-24 11:43:13'),
(14, 3, 'Amaya', 'Kylee Leblanc', 'Short', '23 years old', '1999-05-29', 'Id magni occaecat mo', 'Bulilan Sur', 'Pila', 'Laguna', '09582549872', 'Zephania Short', 'Chris Short', '74', '18', 'Female', 'Tetanus, Diphtheria, and Pertussis(TDAP)', 3, 1, '2022-08-24 10:00', 'Brgy. Bulilan Sur Health Center', '2022-09-24 10:00', 'Brgy. Bulilan Sur Health Center', '2022-10-24 10:00', 'Brgy. Bulilan Sur Health Center', 'Sample Remarks', '2022-08-24', '2022-10-24 11:47:04', '2022-10-24 11:47:04'),
(15, 4, 'Blair', 'Montana Snow', 'Ball', '21 years old', '2000-11-25', 'Tenetur perspiciatis', 'Pinagbayanan', 'Pila', 'Laguna', '09066639122', 'Naomi Blair', 'John Blair', '60', '175', 'Female', 'Meningococcal B (MenB)', 2, 1, '2022-09-12 11:00', 'Brgy. Pinagbayanan Health Center', '2022-10-12 11:00', 'Brgy. Pinagbayanan Health Center', 'Not Applicable', 'Not Applicable', 'Sample Remarks', '2022-09-12', '2022-10-24 12:20:54', '2022-10-24 12:20:54'),
(16, 4, 'Hayley', 'Elliott Ramirez', 'Diaz', '22 years old', '1999-12-22', 'Cum numquam quis sed', 'Labuin', 'Pila', 'Laguna', '09659506465', 'Daniella Diaz', 'MacKensie Diaz', '53', '162', 'Female', 'Meningococcal B (MenB)', 2, 1, '2022-09-30 01:00', 'Brgy. Labuin Health Center', '2022-10-30 01:00', 'Brgy. Labuin Health Center', 'Not Applicable', 'Not Applicable', 'Sample Remarks', '2022-09-30', '2022-10-24 12:23:51', '2022-10-24 12:23:51'),
(17, 4, 'Fuller', 'Clark Ware', 'Jacobson', '25 years old', '1996-11-29', 'Molestiae voluptas s', 'Bukal', 'Pila', 'Laguna', '09061812894', 'August Jacobson', 'Seth Jacobson', '65', '178', 'Male', 'Meningococcal ACWY (MenACWY)', 2, 1, '2022-09-27 11:00', 'Brgy. Bukal Health Center', '2022-10-27 11:00', 'Brgy. Bukal Health Center', 'Not Applicable', 'Not Applicable', 'Sample Remarks', '2022-09-27', '2022-10-24 12:27:07', '2022-10-24 12:27:07'),
(18, 5, 'Belle', 'Barbara Blackburn', 'Hammond', '66 years old', '1956-04-26', 'Saepe eos facilis ve', 'San Miguel', 'Pila', 'Laguna', '09435716616', 'Hedy Slater', 'Elmo Slater', '50', '165', 'Female', 'Pneumococcal Vaccine', 1, 1, '2022-09-17 10:00', 'Brgy. San Miguel Health Center', 'Not Applicable', 'Not Applicable', 'Not Applicable', 'Not Applicable', 'Sample Remarks', '2022-09-17', '2022-10-24 12:31:13', '2022-10-24 12:31:13'),
(19, 5, 'Kathleen', 'Brady', 'Carter', '63 years old', '1958-11-23', 'Duis quo eius except', 'Labuin', 'Pila', 'Laguna', '09454201851', 'Blythe Brady', 'Kel Brady', '55', '160', 'Female', 'Pneumococcal Vaccine', 1, 1, '2022-09-19 10:00', 'Brgy. Labuin Health Center', 'Not Applicable', 'Not Applicable', 'Not Applicable', 'Not Applicable', 'Sample Remarks', '2022-09-19', '2022-10-24 12:33:00', '2022-10-24 12:33:00'),
(20, 5, 'Colton', 'Colins', 'Webster', '65 years old', '1956-12-01', 'Ut ex nemo pariatur', 'San Miguel', 'Pila', 'Laguna', '09743012101', 'Faith Webster', 'Bass Webster', '73', '180', 'Male', 'Pneumococcal Vaccine', 1, 1, '2022-09-22 10:00', 'Brgy. San Miguel Health Center', 'Not Applicable', 'Not Applicable', 'Not Applicable', 'Not Applicable', 'Sample Remarks', '2022-09-22', '2022-10-24 12:36:53', '2022-10-24 12:36:53'),
(21, 5, 'Todd', 'Yardley Koch', 'Workman', '62 years old', '1960-09-20', 'Distinctio Velit ad', 'Aplaya', 'Pila', 'Laguna', '09186909544', 'Yolanda Workman', 'Karl Workman', '76', '79', 'Male', 'Pneumococcal Vaccine', 1, 1, '2022-09-24 10:00', 'Brgy. Aplaya Health Center', 'Not Applicable', 'Not Applicable', 'Not Applicable', 'Not Applicable', 'Sample Remarks', '2022-09-24', '2022-10-25 12:38:44', '2022-10-24 12:38:44'),
(22, 5, 'Rina', 'Baxter White', 'Dotson', '67 years old', '1955-06-13', 'Modi culpa excepteu', 'Bukal', 'Pila', 'Laguna', '09155220948', 'Hilda Baxter White', 'Hiram Baxter White', '55', '150', 'Female', 'Pneumococcal Vaccine', 1, 1, '2022-09-24 10:00', 'Brgy. Bukal Health Center', 'Not Applicable', 'Not Applicable', 'Not Applicable', 'Not Applicable', 'Sample Remarks', '2022-09-24', '2022-10-24 12:40:17', '2022-10-24 12:40:17'),
(23, 1, 'Justin', 'Martin Frederick', 'Woods', '0 months old', '2022-11-01', 'Unde inventore elit', 'Tubuan', 'Pila', 'Laguna', '09657029069', 'Cameron Bartlett', 'Bertha Franco', '91', '3', 'Male', 'Pentavalent Vaccine (DPT-Hep B-HIB)', 3, 3, '2022-11-14 08:32', 'Brgy. Tubuan Health Center', '2022-12-16T08:32', 'Brgy. Tubuan Health Center', '2023-01-17T08:32', 'Brgy. Tubuan Health Center', 'Animi et provident', '2022-11-14', '2022-11-14 00:32:31', '2022-11-13 16:33:42');

-- --------------------------------------------------------

--
-- Table structure for table `immunization_categories`
--

CREATE TABLE `immunization_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `immunization_category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `immunization_categories`
--

INSERT INTO `immunization_categories` (`id`, `immunization_category_name`, `created_at`, `updated_at`) VALUES
(1, 'Infant', '2022-09-27 08:39:14', '2022-09-27 08:39:14'),
(2, 'School Age Children', '2022-09-27 08:39:14', '2022-09-27 08:39:14'),
(3, 'Pregnant', '2022-09-27 08:39:14', '2022-09-27 08:39:14'),
(4, 'Adult', '2022-09-27 08:39:14', '2022-09-27 08:39:14'),
(5, 'Senior Citizen', '2022-09-27 08:40:23', '2022-09-27 08:40:23');

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
(1, '2013_07_30_001019_create_user_types_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2022_06_30_011728_create_vaccine_categories_table', 1),
(7, '2022_06_30_101702_create_immunization_categories_table', 1),
(19, '2022_07_31_103403_create_immunizations_table', 5),
(22, '2022_08_01_024807_create_archives_table', 6),
(25, '2014_10_12_000000_create_users_table', 8),
(26, '2022_07_30_022150_create_vaccines_table', 9),
(27, '2022_11_03_091131_create_user_activity_logs_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('nurse1@gmail.com', '$2y$10$cFcZaqsVk0wHiZ1t8ZlH8e2s7soAMn4C.8Hzx7ouD6vP9L.8C3HjC', '2022-10-12 20:19:40');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_type_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `civil_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `municipality` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barangay` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_recorded` date NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type_id`, `first_name`, `middle_name`, `last_name`, `date_of_birth`, `age`, `gender`, `civil_status`, `province`, `municipality`, `barangay`, `email`, `email_verified_at`, `password`, `status`, `profile_img`, `date_recorded`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'Alma Divina', 'Perez', 'Gracia', '1996-01-01', '26 years old', 'Female', 'Single', 'LAGUNA', 'PILA', 'Aplaya', 'jl.lacadin23@gmail.com', NULL, '$2y$10$osYmJeHDJh2ndIPvJEjgZORF3pF8h68KQoJz5Efb8.wFx4v5cqWju', 'Active', '1_admin.png', '2022-10-21', 'UB9pNt9h3zqK0F3Xpdg4AGHx1E8E9h8YFcHT8jzDk4Gd5pQV2Sqsa2nx6EKz', '2022-10-21 13:42:21', '2022-10-24 05:10:09'),
(3, 3, 'Juan', 'Dela', 'Juan', '1997-03-01', '25 years old', 'Male', 'Single', 'LAGUNA', 'VICTORIA', 'San Benito', 'juandelacruz@gmail.com', NULL, '$2y$10$7TSK/k1i0.4H6vgMBaeSpeUgKWIwQcgUvYY6EDczYFeop6BcJwWIu', 'Inactive', NULL, '2022-10-24', NULL, '2022-10-24 12:45:10', '2022-10-24 04:45:17'),
(4, 2, 'Kirestin', 'Keith Brown', 'Bowers', '1992-07-11', '30 years old', 'Female', 'Separated', 'LAGUNA', 'SANTA CRUZ (Capital)', 'Bagumbayan', 'nurse1@gmail.com', NULL, '$2y$10$NuLS5lhZEFwp08Kg7iY3sOzNNM4aZ8LZlccdOV9SoAar7PkBZGARW', 'Active', '4_nurse.png', '2022-10-24', NULL, '2022-10-24 12:46:08', '2022-10-24 04:58:27'),
(5, 3, 'Amaya', 'Colby Mcdowell', 'Mccormick', '1982-10-16', '40 years old', 'Female', 'Widowed', 'LAGUNA', 'PILA', 'Aplaya', 'bhw1@gmail.com', NULL, '$2y$10$.YxFMEHO3kvLtqorl.XAL.xY5MkTkqqvEJpk7X7.f4zNhdCWTPnbO', 'Active', '5_bhw.png', '2022-10-24', NULL, '2022-10-24 12:47:12', '2022-10-24 04:59:44');

-- --------------------------------------------------------

--
-- Table structure for table `user_activity_logs`
--

CREATE TABLE `user_activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `activity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_time` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_activity_logs`
--

INSERT INTO `user_activity_logs` (`id`, `user_id`, `activity`, `description`, `date_time`, `created_at`, `updated_at`) VALUES
(1, 1, 'Login', 'Date and Time: 2022-11-14 08:22:27', '2022-11-14 08:22:27', '2022-11-14 00:22:27', '2022-11-14 00:22:27'),
(2, 1, 'Download Report', '2022-01-01 To 2022-11-14', '2022-11-14 08:23:47', '2022-11-14 00:23:47', '2022-11-14 00:23:47'),
(3, 1, 'Add Vaccine', 'Add BCG Vaccine', '2022-11-14 00:26:00', '2022-11-13 16:26:00', '2022-11-13 16:26:00'),
(4, 1, 'Add Vaccine', 'Add Pentavalent Vaccine (DPT-Hep B-HIB)', '2022-11-14 00:26:57', '2022-11-13 16:26:57', '2022-11-13 16:26:57'),
(5, 1, 'Update Vaccine', 'Update Vaccine ID: 1', '2022-11-14 00:27:17', '2022-11-13 16:27:17', '2022-11-13 16:27:17'),
(6, 1, 'Update Vaccine', 'Update Vaccine ID: 2', '2022-11-14 00:27:17', '2022-11-13 16:27:17', '2022-11-13 16:27:17'),
(7, 1, 'Update Vaccine', 'Update Vaccine ID: 1', '2022-11-14 00:27:25', '2022-11-13 16:27:25', '2022-11-13 16:27:25'),
(8, 1, 'Update Vaccine', 'Update Vaccine ID: 2', '2022-11-14 00:27:25', '2022-11-13 16:27:25', '2022-11-13 16:27:25'),
(9, 1, 'Add Vaccine', 'Add Inactivated Polio Vaccine (IPV)', '2022-11-14 00:28:19', '2022-11-13 16:28:19', '2022-11-13 16:28:19'),
(10, 1, 'Add Vaccine', 'Add Human Papillomavirus Vaccine', '2022-11-14 00:29:15', '2022-11-13 16:29:15', '2022-11-13 16:29:15'),
(11, 1, 'Add Vaccine', 'Add Influenza Vaccine', '2022-11-14 00:30:00', '2022-11-13 16:30:00', '2022-11-13 16:30:00'),
(12, 1, 'Add Vaccine', 'Add asdasdasdsadas', '2022-11-14 00:30:13', '2022-11-13 16:30:13', '2022-11-13 16:30:13'),
(13, 1, 'Add Vaccine', 'Add Shannon Pickett', '2022-11-14 00:30:29', '2022-11-13 16:30:29', '2022-11-13 16:30:29'),
(14, 1, 'Add Vaccine', 'Add Hayley Wynn', '2022-11-14 00:30:42', '2022-11-13 16:30:42', '2022-11-13 16:30:42'),
(15, 1, 'Update Vaccine', 'Update Vaccine ID: 6', '2022-11-14 00:30:57', '2022-11-13 16:30:57', '2022-11-13 16:30:57'),
(16, 1, 'Update Vaccine', 'Update Vaccine ID: 7', '2022-11-14 00:30:57', '2022-11-13 16:30:57', '2022-11-13 16:30:57'),
(17, 1, 'Update Vaccine', 'Update Vaccine ID: 8', '2022-11-14 00:30:57', '2022-11-13 16:30:57', '2022-11-13 16:30:57'),
(18, 1, 'Update Vaccine', 'Update Vaccine ID: 6', '2022-11-14 00:31:08', '2022-11-13 16:31:08', '2022-11-13 16:31:08'),
(19, 1, 'Update Vaccine', 'Update Vaccine ID: 7', '2022-11-14 00:31:08', '2022-11-13 16:31:08', '2022-11-13 16:31:08'),
(20, 1, 'Update Vaccine', 'Update Vaccine ID: 8', '2022-11-14 00:31:08', '2022-11-13 16:31:08', '2022-11-13 16:31:08'),
(21, 1, 'Delete Vaccine', 'Delete Vaccine(asdasdasdsadas)', '2022-11-14 00:31:18', '2022-11-13 16:31:18', '2022-11-13 16:31:18'),
(22, 1, 'Delete Vaccine', 'Delete Vaccine(Shannon Pickett)', '2022-11-14 00:31:29', '2022-11-13 16:31:29', '2022-11-13 16:31:29'),
(23, 1, 'Delete Vaccine', 'Delete Vaccine(Hayley Wynn)', '2022-11-14 00:31:29', '2022-11-13 16:31:29', '2022-11-13 16:31:29'),
(24, 1, 'Add Immunization', 'Add Justin Martin Frederick Woods(Infant)', '2022-11-14 08:32:31', '2022-11-14 00:32:31', '2022-11-14 00:32:31'),
(25, 1, 'Update Immunization', 'Update Immunization ID: 23', '2022-11-14 08:32:50', '2022-11-14 00:32:50', '2022-11-14 00:32:50'),
(26, 1, 'Administered Immunization', 'Administered Immunization ID: 23', '2022-11-14 00:32:55', '2022-11-13 16:32:55', '2022-11-13 16:32:55'),
(27, 1, 'Administered Immunization', 'Administered Immunization ID: 23', '2022-11-14 00:33:42', '2022-11-13 16:33:42', '2022-11-13 16:33:42'),
(28, 1, 'Administered Immunization', 'Administered Immunization ID: 5', '2022-11-14 00:33:57', '2022-11-13 16:33:57', '2022-11-13 16:33:57'),
(29, 1, 'Administered Immunization', 'Administered Immunization ID: 4', '2022-11-14 00:33:57', '2022-11-13 16:33:57', '2022-11-13 16:33:57'),
(30, 1, 'Administered Immunization', 'Administered Immunization ID: 5', '2022-11-14 00:34:09', '2022-11-13 16:34:09', '2022-11-13 16:34:09'),
(31, 1, 'Add Immunization', 'Add asdas Ahmed Ayala Young(Infant)', '2022-11-14 08:34:27', '2022-11-14 00:34:27', '2022-11-14 00:34:27'),
(32, 1, 'Add Immunization', 'Add asdasdsa Jada Hancock Wilson(Infant)', '2022-11-14 08:34:42', '2022-11-14 00:34:42', '2022-11-14 00:34:42'),
(33, 1, 'Add Immunization', 'Add asdasdsa Kai Pugh Clayton(Infant)', '2022-11-14 08:34:58', '2022-11-14 00:34:58', '2022-11-14 00:34:58'),
(34, 1, 'Archive Immunization', 'Archive Immunization asdasdsa Kai Pugh Clayton(Infant)', '2022-11-14 00:35:11', '2022-11-13 16:35:11', '2022-11-13 16:35:11'),
(35, 1, 'Archive Immunization', 'Archive Immunization asdas Ahmed Ayala Young(Infant)', '2022-11-14 00:35:21', '2022-11-13 16:35:21', '2022-11-13 16:35:21'),
(36, 1, 'Archive Immunization', 'Archive Immunization asdasdsa Jada Hancock Wilson(Infant)', '2022-11-14 00:35:22', '2022-11-13 16:35:22', '2022-11-13 16:35:22'),
(37, 1, 'Restore Immunization', 'Restore Immunization asdasdsa Kai Pugh Clayton(Infant)', '2022-11-14 00:35:39', '2022-11-13 16:35:39', '2022-11-13 16:35:39'),
(38, 1, 'Restore Immunization', 'Restore Immunization asdas Ahmed Ayala Young(Infant)', '2022-11-14 00:35:39', '2022-11-13 16:35:39', '2022-11-13 16:35:39'),
(39, 1, 'Restore Immunization', 'Restore Immunization asdasdsa Jada Hancock Wilson(Infant)', '2022-11-14 00:35:39', '2022-11-13 16:35:39', '2022-11-13 16:35:39'),
(40, 1, 'Archive Immunization', 'Archive Immunization asdasdsa Kai Pugh Clayton(Infant)', '2022-11-14 00:35:58', '2022-11-13 16:35:58', '2022-11-13 16:35:58'),
(41, 1, 'Archive Immunization', 'Archive Immunization asdas Ahmed Ayala Young(Infant)', '2022-11-14 00:35:59', '2022-11-13 16:35:59', '2022-11-13 16:35:59'),
(42, 1, 'Archive Immunization', 'Archive Immunization asdasdsa Jada Hancock Wilson(Infant)', '2022-11-14 00:35:59', '2022-11-13 16:35:59', '2022-11-13 16:35:59'),
(43, 1, 'Delete Immunization', 'Delete Immunization asdasdsa Kai Pugh Clayton(Infant)', '2022-11-14 00:36:14', '2022-11-13 16:36:14', '2022-11-13 16:36:14'),
(44, 1, 'Delete Immunization', 'Delete Immunization asdas Ahmed Ayala Young(Infant)', '2022-11-14 00:36:14', '2022-11-13 16:36:14', '2022-11-13 16:36:14'),
(45, 1, 'Delete Immunization', 'Delete Immunization asdasdsa Jada Hancock Wilson(Infant)', '2022-11-14 00:36:15', '2022-11-13 16:36:15', '2022-11-13 16:36:15');

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `user_type`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2022-09-27 02:49:07', '2022-09-27 02:49:07'),
(2, 'Nurse/Midwife', '2022-09-27 02:49:07', '2022-09-27 02:49:07'),
(3, 'Barangay Health Worker', '2022-09-27 02:50:06', '2022-09-27 02:50:06');

-- --------------------------------------------------------

--
-- Table structure for table `vaccines`
--

CREATE TABLE `vaccines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vaccine_category_id` bigint(20) UNSIGNED NOT NULL,
  `vaccine_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `doses` bigint(20) NOT NULL,
  `second_dose_years_interval` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `second_dose_months_interval` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `second_dose_days_interval` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `third_dose_years_interval` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `third_dose_months_interval` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `third_dose_days_interval` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_created` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vaccines`
--

INSERT INTO `vaccines` (`id`, `vaccine_category_id`, `vaccine_name`, `doses`, `second_dose_years_interval`, `second_dose_months_interval`, `second_dose_days_interval`, `third_dose_years_interval`, `third_dose_months_interval`, `third_dose_days_interval`, `status`, `description`, `date_created`, `created_at`, `updated_at`) VALUES
(1, 1, 'BCG Vaccine', 1, '', '', '', '', '', '', 'Available', 'Vaccine for Infant', '2022-11-14', '2022-11-13 16:26:00', '2022-11-13 16:27:25'),
(2, 1, 'Pentavalent Vaccine (DPT-Hep B-HIB)', 3, '0', '1', '0', '0', '1', '0', 'Available', 'Vaccine for Infant', '2022-11-14', '2022-11-13 16:26:57', '2022-11-13 16:27:25'),
(3, 1, 'Inactivated Polio Vaccine (IPV)', 2, '0', '5', '15', '', '', '', 'Available', 'Vaccine for Infant', '2022-11-14', '2022-11-13 16:28:19', '2022-11-13 16:28:19'),
(4, 2, 'Human Papillomavirus Vaccine', 2, '5', '0', '0', '', '', '', 'Available', 'Vaccine for School Aged Children', '2022-11-14', '2022-11-13 16:29:15', '2022-11-13 16:29:15'),
(5, 5, 'Influenza Vaccine', 1, '', '', '', '', '', '', 'Available', 'Sample Vaccine for Senior Citizen', '2022-11-14', '2022-11-13 16:30:00', '2022-11-13 16:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `vaccine_categories`
--

CREATE TABLE `vaccine_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vaccine_category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vaccine_categories`
--

INSERT INTO `vaccine_categories` (`id`, `vaccine_category_name`, `created_at`, `updated_at`) VALUES
(1, 'Infant', '2022-09-27 08:17:41', '2022-09-27 08:17:41'),
(2, 'School Age Children', '2022-09-27 08:17:41', '2022-09-27 08:17:41'),
(3, 'Pregnant', '2022-09-27 08:17:41', '2022-09-27 08:17:41'),
(4, 'Adult', '2022-09-27 08:17:41', '2022-09-27 08:17:41'),
(5, 'Senior Citizen', '2022-09-27 08:19:32', '2022-09-27 08:19:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `archives`
--
ALTER TABLE `archives`
  ADD PRIMARY KEY (`id`),
  ADD KEY `archives_immunization_category_id_foreign` (`immunization_category_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `immunizations`
--
ALTER TABLE `immunizations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `immunizations_immunization_category_id_foreign` (`immunization_category_id`);

--
-- Indexes for table `immunization_categories`
--
ALTER TABLE `immunization_categories`
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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_user_type_id_foreign` (`user_type_id`);

--
-- Indexes for table `user_activity_logs`
--
ALTER TABLE `user_activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_activity_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vaccines`
--
ALTER TABLE `vaccines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vaccines_vaccine_category_id_foreign` (`vaccine_category_id`);

--
-- Indexes for table `vaccine_categories`
--
ALTER TABLE `vaccine_categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `archives`
--
ALTER TABLE `archives`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `immunizations`
--
ALTER TABLE `immunizations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `immunization_categories`
--
ALTER TABLE `immunization_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_activity_logs`
--
ALTER TABLE `user_activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vaccines`
--
ALTER TABLE `vaccines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `vaccine_categories`
--
ALTER TABLE `vaccine_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `archives`
--
ALTER TABLE `archives`
  ADD CONSTRAINT `archives_immunization_category_id_foreign` FOREIGN KEY (`immunization_category_id`) REFERENCES `immunization_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `immunizations`
--
ALTER TABLE `immunizations`
  ADD CONSTRAINT `immunizations_immunization_category_id_foreign` FOREIGN KEY (`immunization_category_id`) REFERENCES `immunization_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_user_type_id_foreign` FOREIGN KEY (`user_type_id`) REFERENCES `user_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_activity_logs`
--
ALTER TABLE `user_activity_logs`
  ADD CONSTRAINT `user_activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vaccines`
--
ALTER TABLE `vaccines`
  ADD CONSTRAINT `vaccines_vaccine_category_id_foreign` FOREIGN KEY (`vaccine_category_id`) REFERENCES `vaccine_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
