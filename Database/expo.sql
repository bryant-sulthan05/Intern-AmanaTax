-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2023 at 01:53 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `expo`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `plaintext_pass` varchar(50) NOT NULL,
  `tlp` varchar(25) NOT NULL,
  `address` text NOT NULL,
  `gender` varchar(20) NOT NULL,
  `photo` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `firstname`, `lastname`, `email`, `password`, `plaintext_pass`, `tlp`, `address`, `gender`, `photo`) VALUES
(15, 'guest', 'admin', 'admin@gmail.com', 'c93ccd78b2076528346216b3b2f701e6', 'admin1234', '08712387123', 'Bumi', 'Laki-laki', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `article_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `pict` longtext NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `body` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`article_id`, `category_id`, `pict`, `title`, `slug`, `description`, `body`, `created_at`, `updated_at`) VALUES
(1, 1, '1.png', 'Mengenal apa itu Pengenalan Laporan Keuangan', 'mengenal-apa-itu-pengenalan-laporan-keuangan', '<p>Akuntansi pajak adalah proses penetapan besarnya pajak terutang yang dihitung berdasarkan laporan keuangan yang disusun perusahaan.</p>', '<p><span style=\"color: rgb(17, 17, 17); font-family: Roboto, sans-serif; font-size: 18px;\">Pengertian</span><span style=\"color: rgb(17, 17, 17); font-family: Roboto, sans-serif; font-size: 18px;\"> </span><span style=\"color: rgb(17, 17, 17); font-family: Roboto, sans-serif; font-size: 18px;\">laporan</span><span style=\"color: rgb(17, 17, 17); font-family: Roboto, sans-serif; font-size: 18px;\"> </span><span style=\"color: rgb(17, 17, 17); font-family: Roboto, sans-serif; font-size: 18px;\">keuangan</span><span style=\"color: rgb(17, 17, 17); font-family: Roboto, sans-serif; font-size: 18px;\"> adalah hasil akhir dari proses pencatatan transaksi keuangan suatu perusahaan yang menunjukkan kondisi keuangan perusahaan tersebut pada satu periode akuntansi dan merupakan gambaran umum mengenai kinerja suatu perusahaan. </span><span style=\"background-color: var(--bs-card-bg); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); font-family: Roboto, sans-serif; color: rgb(17, 17, 17); font-size: 18px;\">Pengertian</span><span style=\"background-color: var(--bs-card-bg); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); font-family: Roboto, sans-serif; color: rgb(17, 17, 17); font-size: 18px;\"> </span><span style=\"background-color: var(--bs-card-bg); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); font-family: Roboto, sans-serif; color: rgb(17, 17, 17); font-size: 18px;\">laporan</span><span style=\"background-color: var(--bs-card-bg); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); font-family: Roboto, sans-serif; color: rgb(17, 17, 17); font-size: 18px;\"> </span><span style=\"background-color: var(--bs-card-bg); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); font-family: Roboto, sans-serif; color: rgb(17, 17, 17); font-size: 18px;\">keuangan</span><span style=\"background-color: var(--bs-card-bg); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); font-family: Roboto, sans-serif; color: rgb(17, 17, 17); font-size: 18px;\"> adalah hasil akhir dari proses pencatatan transaksi keuangan suatu perusahaan yang menunjukkan kondisi keuangan perusahaan tersebut pada satu periode akuntansi dan merupakan gambaran umum mengenai kinerja suatu perusahaan. </span><span style=\"background-color: var(--bs-card-bg); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); font-family: Roboto, sans-serif; color: rgb(17, 17, 17); font-size: 18px;\">Pengertian</span><span style=\"background-color: var(--bs-card-bg); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); font-family: Roboto, sans-serif; color: rgb(17, 17, 17); font-size: 18px;\"> </span><span style=\"background-color: var(--bs-card-bg); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); font-family: Roboto, sans-serif; color: rgb(17, 17, 17); font-size: 18px;\">laporan</span><span style=\"background-color: var(--bs-card-bg); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); font-family: Roboto, sans-serif; color: rgb(17, 17, 17); font-size: 18px;\"> </span><span style=\"background-color: var(--bs-card-bg); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); font-family: Roboto, sans-serif; color: rgb(17, 17, 17); font-size: 18px;\">keuangan</span><span style=\"background-color: var(--bs-card-bg); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); font-family: Roboto, sans-serif; color: rgb(17, 17, 17); font-size: 18px;\"> adalah hasil akhir dari proses pencatatan transaksi keuangan suatu perusahaan yang menunjukkan kondisi keuangan perusahaan tersebut pada satu periode akuntansi dan merupakan gambaran umum mengenai kinerja suatu perusahaan.</span></p>', '2023-01-02 18:11:52', '2023-01-02 12:11:52');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category`, `slug`) VALUES
(1, 'Pengenalan Laporan Keuangan', 'pengenalan-laporan-keuangan'),
(2, 'PBB, BPHTB & Bea Materai', 'pbb,-bphtb-&-bea-materai'),
(3, 'Akuntansi Pajak', 'akuntansi-pajak'),
(4, 'PPH Potong/Pungut', 'pph-potong/pungut'),
(5, 'PPH Orang Pribadi', 'pph-orang-pribadi'),
(6, 'Pajak Pertambahan Nilai', 'pajak-pertambahan-nilai'),
(8, 'PPH Badan', 'pph-badan'),
(9, 'Pemeriksaan Pajak', 'pemeriksaan-pajak'),
(10, 'E-ESPT', 'e-espt'),
(11, 'Paket Brevet AB', 'paket-brevet-ab'),
(16, 'Pengenalan Perpajakan', 'pengenalan-perpajakan');

-- --------------------------------------------------------

--
-- Table structure for table `lesson`
--

CREATE TABLE `lesson` (
  `lesson_id` int(11) NOT NULL,
  `lesson` varchar(100) NOT NULL,
  `price` bigint(20) NOT NULL,
  `discount` float NOT NULL DEFAULT 0,
  `pict` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lesson`
--

INSERT INTO `lesson` (`lesson_id`, `lesson`, `price`, `discount`, `pict`, `created_at`, `updated_at`) VALUES
(1, 'Laporan Keuangan', 1500000, 10, '2.png', '2023-01-02 18:02:05', '2023-01-02 18:02:05'),
(2, 'PBB BPHTB & Bea Materai', 2500000, 25, '3.png', '2022-12-27 03:56:40', '2022-12-27 03:56:40'),
(3, 'Akuntansi Pajak', 1950000, 0, '4.png', '2022-12-27 04:13:56', '2022-12-27 04:13:56'),
(4, 'PPH Potong/Pungut', 1100000, 0, '5.png', '2022-12-25 08:41:11', '2022-12-25 08:41:11'),
(5, 'PPH Orang Pribadi', 2100000, 21, '6.png', '2022-12-26 15:09:30', '2022-12-26 15:09:30'),
(6, 'Pajak Pertambahan Nilai', 2500000, 28, '7.png', '2022-12-27 04:14:40', '2022-12-27 04:14:40'),
(7, 'PPH Badan', 1250000, 0, '8.png', '2022-12-27 04:13:08', '2022-12-27 04:13:08'),
(8, 'Pemeriksaan Pajak', 2100000, 30.5, '9.png', '2022-12-26 22:12:27', '2022-12-26 22:12:27'),
(9, 'E-ESPT', 1320000, 15, '10.png', '2022-12-26 22:15:54', '2022-12-26 22:15:54'),
(10, 'Paket Brevet AB', 4500000, 30, 'code.png', '2023-08-27 11:38:57', '2023-08-27 11:38:57');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `acc_number` varchar(50) NOT NULL,
  `fee` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `payment_method`, `acc_number`, `fee`) VALUES
(1, 'BCA', '821731982', 2500),
(2, 'BRI', '828729067', 2000),
(3, 'Cimbniaga', '273690212', 4000),
(4, 'Gopay', 'AB082930457281', 3500),
(5, 'Dana', 'BD082930457281', 5500);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `transaction_proof` varchar(255) DEFAULT NULL,
  `subtotal` bigint(20) NOT NULL,
  `total` bigint(20) NOT NULL,
  `qty` bigint(20) NOT NULL,
  `rek` varchar(50) NOT NULL,
  `status` varchar(200) NOT NULL DEFAULT 'pending',
  `expired_at` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `plaintext_pass` varchar(50) NOT NULL,
  `tlp` bigint(20) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `status` varchar(50) NOT NULL,
  `photo` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `firstname`, `lastname`, `email`, `password`, `plaintext_pass`, `tlp`, `gender`, `status`, `photo`) VALUES
(10, 'guest', 'user', 'user@user.com', 'da376af94a350d64e690b5d22626d240', 'userguest1234', 8192837198, 'Laki-laki', 'pelajar/mahasiswa', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `video_id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`video_id`, `lesson_id`, `title`, `video`, `thumbnail`, `created_at`, `updated_at`) VALUES
(17, 1, 'Pengenalan Laporan Keuangan', 'Apakah Manusia Bisa Menguasai Galaksi_ _ Skala Kardashev.mp4', '1-1693136757.png', '2023-08-27 11:45:57', '2023-08-27 06:45:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `tlp` (`tlp`);

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`article_id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `lesson`
--
ALTER TABLE `lesson`
  ADD PRIMARY KEY (`lesson_id`),
  ADD UNIQUE KEY `lesson` (`lesson`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD UNIQUE KEY `payment_method` (`payment_method`),
  ADD UNIQUE KEY `acc_number` (`acc_number`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `lesson_id` (`lesson_id`),
  ADD KEY `payment_id` (`payment_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `tlp` (`tlp`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`video_id`),
  ADD KEY `lesson_id` (`lesson_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `lesson`
--
ALTER TABLE `lesson`
  MODIFY `lesson_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `video_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `video_ibfk_1` FOREIGN KEY (`lesson_id`) REFERENCES `lesson` (`lesson_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
