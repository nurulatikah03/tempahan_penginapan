-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2024 at 05:00 AM
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
-- Database: `tempahan_penginapan`
--

-- --------------------------------------------------------

--
-- Table structure for table `aktiviti`
--

CREATE TABLE `aktiviti` (
  `id_aktiviti` int(11) NOT NULL,
  `nama_aktiviti` varchar(50) NOT NULL,
  `kadar_harga` decimal(10,2) NOT NULL,
  `kemudahan` varchar(500) NOT NULL,
  `penerangan` varchar(550) NOT NULL,
  `status_aktiviti` enum('Tersedia','Tidak Tersedia') NOT NULL,
  `gambar` varchar(550) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aktiviti`
--

INSERT INTO `aktiviti` (`id_aktiviti`, `nama_aktiviti`, `kadar_harga`, `kemudahan`, `penerangan`, `status_aktiviti`, `gambar`) VALUES
(3, 'Pakej Kem Pelajar', 55.00, 'Dewan seminar dan kemudahan seperti  P.A System, LCD, Whiteboard dan Marker.', 'Kem ini direka untuk menggalakkan pembelajaran secara aktif dan kolaboratif, di samping memberi ruang kepada pelajar untuk bersosial dan berkembang sebagai individu.', 'Tersedia', 'kemPelajar.jpg'),
(4, 'Pakej Teambuilding', 99.00, 'Penginapan berdua sebilik yang berhawa dingin.', 'Pakej teambuilding dirancang untuk meningkatkan kerjasama, komunikasi, dan semangat pasukan di kalangan pelajar.', 'Tersedia', 'teambuilding.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `dewan`
--

CREATE TABLE `dewan` (
  `id_dewan` int(11) NOT NULL,
  `nama_dewan` varchar(50) NOT NULL,
  `kadar_sewa` decimal(10,2) NOT NULL,
  `bilangan_muatan` int(11) NOT NULL,
  `penerangan` varchar(550) NOT NULL,
  `status_dewan` enum('Tersedia','Tidak Tersedia') NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dewan`
--

INSERT INTO `dewan` (`id_dewan`, `nama_dewan`, `kadar_sewa`, `bilangan_muatan`, `penerangan`, `status_dewan`, `gambar`) VALUES
(6, 'Dewan Jubli', 500.00, 250, 'Dewan untuk acara rasmi atau tidak rasm dan boleh diubahsuai kerusi dan meja.', 'Tersedia', 'dewanJubli1.png'),
(7, 'Dewan Kuliah Kenaf', 200.00, 40, 'Menyediakan pelbagai kemudahan penggunaan.', 'Tersedia', 'dewanKuliah.png'),
(8, 'Dewan Fiber', 350.00, 250, 'Dewan untuk acara rasmi atau tidak rasm dan boleh diubahsuai kerusi dan meja.', 'Tersedia', 'dewanJubli2.png');

-- --------------------------------------------------------

--
-- Table structure for table `penginapan`
--

CREATE TABLE `penginapan` (
  `penginapan_id` int(11) NOT NULL,
  `jenis_bilik` varchar(255) NOT NULL,
  `jumlah_bilik` int(11) NOT NULL,
  `kadar_sewa` decimal(10,2) NOT NULL,
  `bilanganPenyewa` int(11) NOT NULL,
  `penerangan` varchar(500) NOT NULL,
  `statusBilik` enum('Tersedia','Tidak Tersedia') DEFAULT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penginapan`
--

INSERT INTO `penginapan` (`penginapan_id`, `jenis_bilik`, `jumlah_bilik`, `kadar_sewa`, `bilanganPenyewa`, `penerangan`, `statusBilik`, `gambar`) VALUES
(24, 'Bilik Biasa', 52, 70.00, 2, 'Mempunyai penghawa dingin dan disediakan dengan 2 katil bujang.', 'Tersedia', 'room-1.jpg'),
(25, 'Bilik VIP', 2, 150.00, 2, 'Mempunyai penghawa dingin serta mempunyai televisyen dan disediakan dengan 2 katil bujang.', 'Tersedia', 'room-2.jpg'),
(26, 'HomeStay', 2, 399.00, 8, 'Sesuai untuk keluarga besar.', 'Tersedia', 'room-3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `perkahwinan`
--

CREATE TABLE `perkahwinan` (
  `id_perkahwinan` int(11) NOT NULL,
  `nama_dewan` varchar(255) NOT NULL,
  `kadar_harga` decimal(10,2) NOT NULL,
  `penerangan` varchar(550) NOT NULL,
  `tambahan` varchar(50) NOT NULL,
  `status_perkahwinan` enum('Tersedia','Tidak Tersedia','') NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `perkahwinan`
--

INSERT INTO `perkahwinan` (`id_perkahwinan`, `nama_dewan`, `kadar_harga`, `penerangan`, `tambahan`, `status_perkahwinan`, `gambar`) VALUES
(1, 'Dewan Fiber', 500.00, 'Dewan utama berhawa dingin yang boleh menampung 50 orang', 'Meja dan alas – RM8.00/Unit', 'Tersedia', 'DALL·E 2024-10-09 10.02.33 - A clean and modern hall with blue chairs neatly arranged in rows, and grey curtains hanging on both sides of the walls. There is a small stage at the .webp'),
(3, 'Dewan Jubli', 600.00, 'Dewan utama berhawa dingin yang boleh menampung 50 orang', 'Meja dan alas – RM8.00/Unit', 'Tersedia', 'pakejPerkahwinan.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aktiviti`
--
ALTER TABLE `aktiviti`
  ADD PRIMARY KEY (`id_aktiviti`);

--
-- Indexes for table `dewan`
--
ALTER TABLE `dewan`
  ADD PRIMARY KEY (`id_dewan`);

--
-- Indexes for table `penginapan`
--
ALTER TABLE `penginapan`
  ADD PRIMARY KEY (`penginapan_id`);

--
-- Indexes for table `perkahwinan`
--
ALTER TABLE `perkahwinan`
  ADD PRIMARY KEY (`id_perkahwinan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aktiviti`
--
ALTER TABLE `aktiviti`
  MODIFY `id_aktiviti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dewan`
--
ALTER TABLE `dewan`
  MODIFY `id_dewan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `penginapan`
--
ALTER TABLE `penginapan`
  MODIFY `penginapan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `perkahwinan`
--
ALTER TABLE `perkahwinan`
  MODIFY `id_perkahwinan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
