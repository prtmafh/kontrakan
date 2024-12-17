-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2024 at 10:13 AM
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
-- Database: `db_kontrakan`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id_booking` int(11) NOT NULL,
  `id_kamar` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `sewa_start` date NOT NULL,
  `sewa_end` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `booking_status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `perpanjangan` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id_booking`, `id_kamar`, `id_user`, `sewa_start`, `sewa_end`, `jumlah`, `booking_status`, `created_at`, `perpanjangan`) VALUES
(122, 32, 4, '2024-12-14', '2025-01-14', 300000, 'approved', '2024-12-14 13:50:01', 0),
(123, 31, 3, '2024-12-15', '2025-03-15', 1500000, 'approved', '2024-12-14 14:08:35', 0),
(124, 31, 3, '2025-03-15', '2025-05-15', 1000000, 'approved', '2024-12-14 14:12:49', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kamar`
--

CREATE TABLE `kamar` (
  `id_kamar` int(11) NOT NULL,
  `id_lokasi` int(11) NOT NULL,
  `nama_kamar` varchar(50) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `harga` int(11) NOT NULL,
  `image` varchar(254) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tersedia` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kamar`
--

INSERT INTO `kamar` (`id_kamar`, `id_lokasi`, `nama_kamar`, `deskripsi`, `harga`, `image`, `tersedia`, `created_at`) VALUES
(31, 1, 'Kamar 04', 'Kamar kontrakan nyaman dan bersih, cocok untuk pelajar, pekerja, atau pasangan suami-istri. Lokasi strategis dekat dengan fasilitas umum seperti minimarket, sekolah, dan transportasi umum. Kamar dilengkapi dengan ventilasi yang baik, pencahayaan cukup, dan tersedia fasilitas listrik serta air 24 jam. Lingkungan aman dan ramah. Harga terjangkau, tersedia sistem pembayaran bulanan.', 500000, 'img1729269818.png', 1, '2024-10-18 16:43:38'),
(32, 2, 'kamar 1', 'Kamar kontrakan nyaman dan bersih, cocok untuk pelajar, pekerja, atau pasangan suami-istri. Lokasi strategis dekat dengan fasilitas umum seperti minimarket, sekolah, dan transportasi umum. Kamar dilengkapi dengan ventilasi yang baik, pencahayaan cukup, dan tersedia fasilitas listrik serta air 24 jam. Lingkungan aman dan ramah. Harga terjangkau, tersedia sistem pembayaran bulanan.\r\n', 300000, 'img1729371717.png', 1, '2024-10-19 21:01:57'),
(33, 2, 'Kamar 10', 'Kamar kontrakan nyaman dan bersih, cocok untuk pelajar, pekerja, atau pasangan suami-istri. Lokasi strategis dekat dengan fasilitas umum seperti minimarket, sekolah, dan transportasi umum. Kamar dilengkapi dengan ventilasi yang baik, pencahayaan cukup, dan tersedia fasilitas listrik serta air 24 jam. Lingkungan aman dan ramah. Harga terjangkau, tersedia sistem pembayaran bulanan.', 300000, 'img1729519954.png', 1, '2024-10-21 14:12:34'),
(34, 1, 'Kamar 02', 'Kamar kontrakan nyaman dan bersih, cocok untuk pelajar, pekerja, atau pasangan suami-istri. Lokasi strategis dekat dengan fasilitas umum seperti minimarket, sekolah, dan transportasi umum. Kamar dilengkapi dengan ventilasi yang baik, pencahayaan cukup, dan tersedia fasilitas listrik serta air 24 jam. Lingkungan aman dan ramah. Harga terjangkau, tersedia sistem pembayaran bulanan.', 500000, 'img1729598404.png', 1, '2024-10-22 12:00:04');

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

CREATE TABLE `lokasi` (
  `id_lokasi` int(11) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `map` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lokasi`
--

INSERT INTO `lokasi` (`id_lokasi`, `lokasi`, `map`) VALUES
(1, 'Cikarang', 'Cibitung'),
(2, 'Cibitung', '');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_booking` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal_pembayaran` timestamp NOT NULL DEFAULT current_timestamp(),
  `payment_status` enum('pending','paid','rejected') DEFAULT 'pending',
  `payment_method` enum('bank_transfer','cash') NOT NULL,
  `no_rekening` varchar(100) NOT NULL,
  `nama_rekening` varchar(100) NOT NULL,
  `bukti_transfer` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_booking`, `jumlah`, `tanggal_pembayaran`, `payment_status`, `payment_method`, `no_rekening`, `nama_rekening`, `bukti_transfer`) VALUES
(102, 122, 300000, '2024-12-14 13:50:04', 'paid', 'cash', '', '', ''),
(103, 123, 1500000, '2024-12-14 14:09:10', 'paid', 'cash', '', '', ''),
(104, 124, 1000000, '2024-12-14 14:12:57', 'paid', 'cash', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `sewa_kamar`
--

CREATE TABLE `sewa_kamar` (
  `id_sewa` int(11) NOT NULL,
  `id_booking` int(11) DEFAULT NULL,
  `sewa_start` date NOT NULL,
  `sewa_end` date NOT NULL,
  `status` enum('ongoing','completed','pending') NOT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status_perpanjangan` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sewa_kamar`
--

INSERT INTO `sewa_kamar` (`id_sewa`, `id_booking`, `sewa_start`, `sewa_end`, `status`, `approved_by`, `created_at`, `status_perpanjangan`) VALUES
(103, 122, '2024-11-13', '2024-12-14', 'completed', 2, '2024-12-14 07:53:15', 1),
(104, 123, '2024-12-12', '2025-03-15', 'ongoing', 2, '2024-12-14 08:10:35', 1),
(105, 124, '2025-03-15', '2025-05-15', 'pending', 2, '2024-12-14 08:14:15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('admin','penyewa') NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `password`, `email`, `role`, `nama`, `no_hp`, `image`, `created_at`) VALUES
(2, '$2y$10$.TOMwV3dqyqCvgrumF.lFOArafdSs.rbTM20CoizKMI4OidrYFjWS', 'aji@gmail.com', 'admin', 'afillah ajie pratama', '08123456789', 'profile1733668680.jpg', '2024-10-13 12:14:55'),
(3, '$2y$10$rzdTYx.UtbfSkfaLX71Sx.F.Lxn3gpTi5WKjMaEJCzI1q67FeHWHK', 'benni@gmail.com', 'penyewa', 'beni abdul karim', '08123456789', 'profile1729678677.jpg', '2024-10-14 10:02:38'),
(4, '$2y$10$m8dWhCZk7NvshbvISZc/Mec46UkyhD4WSThtvlE1oW.F7khdXw96y', 'lana@gmail.com', 'penyewa', 'rafif maulana', '085321469541', 'default.jpg', '2024-10-16 11:01:16'),
(5, '$2y$10$GOHTPS5nRY8vIRiccdR3f.MsYr.Dj.YscmR/CWAD3qBSH9/Yjjv6e', 'ike@gmail.com', 'penyewa', 'Ike mutiara nurjanah', '08123456789', 'default.jpg', '2024-10-20 07:12:40'),
(7, '$2y$10$dopk1tP0pWp0uxlFUWqNm.AWYLqUl4oYKuzvFGsCY0Tf56IaQGKhO', 'padil@gmail.com', 'admin', 'padil al-fikri', '08123456789', 'default.jpg', '2024-12-08 09:22:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id_booking`),
  ADD KEY `id_kamar` (`id_kamar`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id_kamar`),
  ADD KEY `idx_lamar_tersedia` (`tersedia`),
  ADD KEY `fk_id_lokasi` (`id_lokasi`);

--
-- Indexes for table `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`id_lokasi`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_booking` (`id_booking`);

--
-- Indexes for table `sewa_kamar`
--
ALTER TABLE `sewa_kamar`
  ADD PRIMARY KEY (`id_sewa`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_user_email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id_booking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `kamar`
--
ALTER TABLE `kamar`
  MODIFY `id_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `id_lokasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `sewa_kamar`
--
ALTER TABLE `sewa_kamar`
  MODIFY `id_sewa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`id_kamar`) REFERENCES `kamar` (`id_kamar`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `kamar`
--
ALTER TABLE `kamar`
  ADD CONSTRAINT `fk_id_lokasi` FOREIGN KEY (`id_lokasi`) REFERENCES `lokasi` (`id_lokasi`);

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_booking`) REFERENCES `booking` (`id_booking`);

--
-- Constraints for table `sewa_kamar`
--
ALTER TABLE `sewa_kamar`
  ADD CONSTRAINT `fk_booking_id` FOREIGN KEY (`id_booking`) REFERENCES `booking` (`id_booking`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
