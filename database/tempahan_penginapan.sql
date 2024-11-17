-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2024 at 09:43 AM
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
-- Table structure for table `bilik`
--

CREATE TABLE `bilik` (
  `id_bilik` int(10) NOT NULL,
  `nama_bilik` varchar(50) NOT NULL,
  `kapasiti` int(4) NOT NULL,
  `jenis_bilik` varchar(15) NOT NULL,
  `harga_semalaman` float NOT NULL,
  `huraian_kemudahan` text NOT NULL,
  `huraian_pendek` text DEFAULT NULL,
  `huraian` text DEFAULT NULL,
  `max_capacity` int(3) NOT NULL,
  `id_admin` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bilik`
--

INSERT INTO `bilik` (`id_bilik`, `nama_bilik`, `kapasiti`, `jenis_bilik`, `harga_semalaman`, `huraian_kemudahan`, `huraian_pendek`, `huraian`, `max_capacity`, `id_admin`) VALUES
(1, 'Bilik biasa', 2, 'room', 70, '[Ubah huraian kemudahan bilik biasa dalam database]', 'Sesuai untuk 2 orang. Disediakan dengan penghawa dingin.', 'Bilik yang selesa dan terang ini kini tersedia untuk disewa di kawasan kejiranan yang aman. Sesuai untuk individu bujang atau pelajar, bilik ini menawarkan katil yang selesa, cahaya semula jadi yang mencukupi, almari pakaian terbina dalam, dan akses ke kemudahan bilik mandi dan dapur bersama. Sewa termasuk utiliti asas dan lokasinya berada di kawasan yang tenang dan selamat.', 3, 0),
(2, 'Bilik VIP', 2, 'suite', 150, '[Ubah huraian kemudahan bilik VIP dalam database]', 'Disediakan dengan 2 katil super single and televisyen.', 'Bilik VIP yang mewah dan luas ini terletak di kawasan kejiranan berprestij. Sesuai untuk mereka yang mencari pengalaman hidup mewah, bilik ini menawarkan katil bersaiz king, bilik mandi peribadi dengan kelengkapan berkualiti tinggi, pemandangan panorama dari balkoni peribadi, dapur kecil yang lengkap dengan peralatan moden, akses ke kemudahan eksklusif seperti kolam renang, gimnasium, dan keselamatan 24 jam, serta lokasi utama dengan akses mudah ke pengangkutan dan kemudahan lain.', 5, NULL),
(3, 'Home Stay INSKET', 8, 'homestay', 200, '[Ubah huraian kemudahan homestay dalam database]', 'Sesuai untuk keluarga besar dan mempuyai ruang letak kereta.', 'Homestay yang selesa dan mesra ini menawarkan pengalaman penginapan yang unik dan berpatutan. Terletak di kawasan yang tenang, homestay ini menyediakan bilik-bilik yang bersih dan kemas, serta kemudahan asas seperti dapur, bilik mandi, dan ruang tamu bersama. Nikmati suasana seperti berada di rumah sendiri, sambil berinteraksi dengan tuan rumah yang ramah dan membantu.', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bilik_kemudahan`
--

CREATE TABLE `bilik_kemudahan` (
  `id_bilik_kemudahan` int(11) NOT NULL,
  `id_bilik` int(11) NOT NULL,
  `id_kemudahan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bilik_kemudahan`
--

INSERT INTO `bilik_kemudahan` (`id_bilik_kemudahan`, `id_bilik`, `id_kemudahan`) VALUES
(7, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `bilik_pic`
--

CREATE TABLE `bilik_pic` (
  `id_gambar` int(10) NOT NULL,
  `jenis_gambar` varchar(50) NOT NULL,
  `url_gambar` text NOT NULL,
  `id_bilik` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bilik_pic`
--

INSERT INTO `bilik_pic` (`id_gambar`, `jenis_gambar`, `url_gambar`, `id_bilik`) VALUES
(1, 'main', 'assets\\images\\resource\\room-1_normal.jpg', 1),
(2, 'main', 'assets\\images\\resource\\room-2_VIP.jpg', 2),
(3, 'main', 'assets\\images\\resource\\room-3_homestay.jpg', 3),
(4, 'banner', 'assets/images/background/page-title-4_normal.jpg', 1),
(5, 'banner', 'assets/images/background/page-title-5_VIP.jpeg', 2),
(6, 'banner', 'assets/images/background/page-title-6_homestay.jpg', 3),
(7, 'add', 'assets\\images\\resource\\homestay_patio.jpg', 3),
(8, 'add', 'assets\\images\\resource\\homestay_swimming.jpg', 3),
(9, 'add', 'assets\\images\\resource\\room-1_livingroom.jpg', 1),
(10, 'add', 'assets\\images\\resource\\room-1_bathroom.jpg', 1);

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
-- Table structure for table `kemudahan`
--

CREATE TABLE `kemudahan` (
  `id_kemudahan` int(11) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `icon_url` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kemudahan`
--

INSERT INTO `kemudahan` (`id_kemudahan`, `nama`, `icon_url`) VALUES
(1, 'Penghawa dingin', 'assets/icons/air-conditioner.svg'),
(2, 'Tab mandi', 'assets/icons/bath.svg'),
(3, 'Kopi', 'assets/icons/coffee.svg'),
(4, 'Peti Sejuk', 'assets/icons/fridge.svg'),
(5, 'Parking', 'assets/icons/parking.svg'),
(6, 'Mesin Basuh', 'assets/icons/washing machine.svg'),
(7, 'Wifi', 'assets/icons/wifi.svg'),
(8, 'Alatan Mandi', 'assets/icons/toiletries.sv');

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

-- --------------------------------------------------------

--
-- Table structure for table `tempahan`
--

CREATE TABLE `tempahan` (
  `id_tempahan` int(11) NOT NULL,
  `nombor_tempahan` varchar(30) NOT NULL,
  `nama_penuh` varchar(65) NOT NULL,
  `numbor_fon` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `tarikh_tempahan` datetime NOT NULL,
  `tarikh_daftar_masuk` date NOT NULL,
  `tarikh_daftar_keluar` date NOT NULL,
  `harga_keseluruhan` float NOT NULL,
  `id_bilik` int(11) NOT NULL,
  `add_on_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tempahan`
--

INSERT INTO `tempahan` (`id_tempahan`, `nombor_tempahan`, `nama_penuh`, `numbor_fon`, `email`, `tarikh_tempahan`, `tarikh_daftar_masuk`, `tarikh_daftar_keluar`, `harga_keseluruhan`, `id_bilik`, `add_on_id`) VALUES
(42, 'BOOK-202411-701', 'WAN MUHAMMAD NAQIB ZAFRAN WAN ROSLAN', '0184028240', 'wannaqib01@gmail.com', '2024-11-11 14:38:50', '2024-11-11', '2024-11-12', 70, 1, NULL),
(43, 'BOOK-202411-564', 'WAN MUHAMMAD NAQIB ZAFRAN WAN ROSLAN', '0184028240', 'wannaqib01@gmail.com', '2024-11-11 15:22:58', '2024-11-11', '2024-11-12', 70, 1, NULL),
(44, 'BOOK-202411-057', 'WAN MUHAMMAD NAQIB ZAFRAN WAN ROSLAN', '0184028240', 'wannaqib01@gmail.com', '2024-11-12 15:08:19', '2024-11-12', '2024-11-13', 70, 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aktiviti`
--
ALTER TABLE `aktiviti`
  ADD PRIMARY KEY (`id_aktiviti`);

--
-- Indexes for table `bilik`
--
ALTER TABLE `bilik`
  ADD PRIMARY KEY (`id_bilik`);

--
-- Indexes for table `bilik_kemudahan`
--
ALTER TABLE `bilik_kemudahan`
  ADD PRIMARY KEY (`id_bilik_kemudahan`),
  ADD KEY `id_kemudahan` (`id_kemudahan`),
  ADD KEY `id_bilik` (`id_bilik`);

--
-- Indexes for table `bilik_pic`
--
ALTER TABLE `bilik_pic`
  ADD PRIMARY KEY (`id_gambar`),
  ADD KEY `room_id` (`id_bilik`);

--
-- Indexes for table `dewan`
--
ALTER TABLE `dewan`
  ADD PRIMARY KEY (`id_dewan`);

--
-- Indexes for table `kemudahan`
--
ALTER TABLE `kemudahan`
  ADD PRIMARY KEY (`id_kemudahan`);

--
-- Indexes for table `perkahwinan`
--
ALTER TABLE `perkahwinan`
  ADD PRIMARY KEY (`id_perkahwinan`);

--
-- Indexes for table `tempahan`
--
ALTER TABLE `tempahan`
  ADD PRIMARY KEY (`id_tempahan`),
  ADD KEY `add_on_id` (`add_on_id`),
  ADD KEY `room_id` (`id_bilik`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aktiviti`
--
ALTER TABLE `aktiviti`
  MODIFY `id_aktiviti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bilik`
--
ALTER TABLE `bilik`
  MODIFY `id_bilik` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bilik_kemudahan`
--
ALTER TABLE `bilik_kemudahan`
  MODIFY `id_bilik_kemudahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `bilik_pic`
--
ALTER TABLE `bilik_pic`
  MODIFY `id_gambar` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `dewan`
--
ALTER TABLE `dewan`
  MODIFY `id_dewan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kemudahan`
--
ALTER TABLE `kemudahan`
  MODIFY `id_kemudahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `perkahwinan`
--
ALTER TABLE `perkahwinan`
  MODIFY `id_perkahwinan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tempahan`
--
ALTER TABLE `tempahan`
  MODIFY `id_tempahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bilik_kemudahan`
--
ALTER TABLE `bilik_kemudahan`
  ADD CONSTRAINT `bilik_kemudahan_ibfk_1` FOREIGN KEY (`id_kemudahan`) REFERENCES `kemudahan` (`id_kemudahan`),
  ADD CONSTRAINT `bilik_kemudahan_ibfk_2` FOREIGN KEY (`id_bilik`) REFERENCES `bilik` (`id_bilik`);

--
-- Constraints for table `bilik_pic`
--
ALTER TABLE `bilik_pic`
  ADD CONSTRAINT `bilik_pic_ibfk_1` FOREIGN KEY (`id_bilik`) REFERENCES `bilik` (`id_bilik`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tempahan`
--
ALTER TABLE `tempahan`
  ADD CONSTRAINT `tempahan_ibfk_1` FOREIGN KEY (`id_bilik`) REFERENCES `bilik` (`id_bilik`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
