-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2024 at 09:28 AM
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id_booking`, `id_kamar`, `id_user`, `sewa_start`, `sewa_end`, `jumlah`, `booking_status`, `created_at`) VALUES
(42, 32, 3, '2024-10-21', '2024-11-21', 300000, 'approved', '2024-10-20 05:26:54'),
(43, 32, 3, '2024-10-21', '2024-11-21', 300000, 'approved', '2024-10-20 05:53:44'),
(44, 31, 3, '2024-10-23', '2024-12-23', 1000000, 'approved', '2024-10-20 06:36:55'),
(45, 31, 4, '2024-10-21', '2024-12-21', 1000000, 'rejected', '2024-10-20 06:42:27'),
(46, 32, 4, '2024-10-28', '2024-11-28', 300000, 'approved', '2024-10-20 06:42:44'),
(47, 31, 4, '2024-10-20', '2024-11-20', 500000, 'approved', '2024-10-20 06:44:10'),
(48, 32, 4, '2024-10-21', '2024-11-21', 300000, 'rejected', '2024-10-20 06:50:36');

-- --------------------------------------------------------

--
-- Table structure for table `kamar`
--

CREATE TABLE `kamar` (
  `id_kamar` int(11) NOT NULL,
  `nama_kamar` varchar(50) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `lokasi` enum('Cikarang','Cibitung') NOT NULL,
  `harga` int(11) NOT NULL,
  `image` varchar(254) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tersedia` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kamar`
--

INSERT INTO `kamar` (`id_kamar`, `nama_kamar`, `deskripsi`, `lokasi`, `harga`, `image`, `tersedia`, `created_at`) VALUES
(31, 'Kamar 01', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quis harum vero minima perspiciatis accusamus laborum. Impedit aspernatur quod reprehenderit sequi, inventore facere tempora, ex ipsa deserunt eius beatae exercitationem illum.\r\n', 'Cikarang', 500000, 'img1729269818.png', 1, '2024-10-18 16:43:38'),
(32, 'Kamar 01', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus ut iusto, itaque ducimus recusandae sapiente laboriosam eligendi sequi repellat soluta facilis odio temporibus dolore. Ratione labore officiis saepe reprehenderit aliquid.\r\n', 'Cibitung', 300000, 'img1729371717.png', 1, '2024-10-19 21:01:57');

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
  `payment_method` enum('bank_transfer','cash') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_booking`, `jumlah`, `tanggal_pembayaran`, `payment_status`, `payment_method`) VALUES
(21, 42, 300000, '2024-10-20 05:26:57', 'paid', 'cash'),
(22, 43, 300000, '2024-10-20 05:53:45', 'paid', 'bank_transfer'),
(23, 44, 1000000, '2024-10-20 06:36:56', 'paid', 'bank_transfer'),
(24, 45, 1000000, '2024-10-20 06:42:29', 'paid', 'bank_transfer'),
(25, 46, 300000, '2024-10-20 06:42:46', 'paid', 'bank_transfer'),
(26, 47, 500000, '2024-10-20 06:44:12', 'paid', 'cash'),
(27, 48, 300000, '2024-10-20 06:50:37', 'rejected', 'bank_transfer');

-- --------------------------------------------------------

--
-- Table structure for table `sewa_kamar`
--

CREATE TABLE `sewa_kamar` (
  `id_sewa` int(11) NOT NULL,
  `id_kamar` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `sewa_start` date NOT NULL,
  `sewa_end` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `status` enum('ongoing','completed','canceled') NOT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_booking` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sewa_kamar`
--

INSERT INTO `sewa_kamar` (`id_sewa`, `id_kamar`, `id_user`, `sewa_start`, `sewa_end`, `jumlah`, `status`, `approved_by`, `created_at`, `id_booking`) VALUES
(40, 31, 3, '2024-10-23', '2024-12-23', 1000000, 'ongoing', 2, '2024-10-20 01:37:08', 44),
(41, 31, 3, '2024-10-23', '2024-12-23', 1000000, 'ongoing', 2, '2024-10-20 01:37:12', 44),
(42, 31, 3, '2024-10-23', '2024-12-23', 1000000, 'ongoing', 2, '2024-10-20 01:37:16', 44),
(43, 31, 3, '2024-10-23', '2024-12-23', 1000000, 'ongoing', 2, '2024-10-20 01:40:46', 44),
(44, 32, 4, '2024-10-28', '2024-11-28', 300000, 'ongoing', 2, '2024-10-20 01:43:12', 46),
(45, 31, 4, '2024-10-20', '2024-11-20', 500000, 'ongoing', 2, '2024-10-20 01:44:53', 47);

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
(2, '$2y$10$.TOMwV3dqyqCvgrumF.lFOArafdSs.rbTM20CoizKMI4OidrYFjWS', 'aji@gmail.com', 'admin', 'afillah ajie pratama', '08123456789', 'default.jpg', '2024-10-13 12:14:55'),
(3, '$2y$10$rzdTYx.UtbfSkfaLX71Sx.F.Lxn3gpTi5WKjMaEJCzI1q67FeHWHK', 'benni@gmail.com', 'penyewa', 'beni sujowo', '08123456789', 'default.jpg', '2024-10-14 10:02:38'),
(4, '$2y$10$m8dWhCZk7NvshbvISZc/Mec46UkyhD4WSThtvlE1oW.F7khdXw96y', 'lana@gmail.com', 'penyewa', 'rafif maulana', '085321469541', 'default.jpg', '2024-10-16 11:01:16');

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
  ADD KEY `idx_lamar_tersedia` (`tersedia`);

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
  ADD PRIMARY KEY (`id_sewa`),
  ADD KEY `id_kamar` (`id_kamar`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `fk_booking_id` (`id_booking`);

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
  MODIFY `id_booking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `kamar`
--
ALTER TABLE `kamar`
  MODIFY `id_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `id_lokasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `sewa_kamar`
--
ALTER TABLE `sewa_kamar`
  MODIFY `id_sewa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_booking`) REFERENCES `booking` (`id_booking`);

--
-- Constraints for table `sewa_kamar`
--
ALTER TABLE `sewa_kamar`
  ADD CONSTRAINT `fk_booking_id` FOREIGN KEY (`id_booking`) REFERENCES `booking` (`id_booking`) ON DELETE CASCADE,
  ADD CONSTRAINT `sewa_kamar_ibfk_1` FOREIGN KEY (`id_kamar`) REFERENCES `kamar` (`id_kamar`),
  ADD CONSTRAINT `sewa_kamar_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
