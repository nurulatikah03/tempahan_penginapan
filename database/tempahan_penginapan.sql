-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2024 at 02:57 AM
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
-- Table structure for table `add_on_perkahwinan`
--

CREATE TABLE `add_on_perkahwinan` (
  `add_on_id` int(11) NOT NULL,
  `add_on_nama` varchar(255) NOT NULL,
  `harga` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `add_on_perkahwinan`
--

INSERT INTO `add_on_perkahwinan` (`add_on_id`, `add_on_nama`, `harga`) VALUES
(1, 'Ruang porch', 50),
(2, 'Meja dan alas', 8),
(3, 'Kerusi', 1),
(5, 'Meja Banquet', 8);

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
(3, 'Pakej Kem Pelajar', 50.00, 'Dewan seminar dan kemudahan seperti  P.A System, LCD, Whiteboard dan Marker.', 'Kem ini direka untuk menggalakkan pembelajaran secara aktif dan kolaboratif, di samping memberi ruang kepada pelajar untuk bersosial dan berkembang sebagai individu.', 'Tersedia', 'kemPelajar.jpg'),
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
(1, 'Bilik biasa', 2, 'Room', 68, 'Datang Dgn tab mandi. dan wifi percuma', 'Sesuai untuk 2 orang. Disediakan dengan penghawa dingin.', 'Bilik yang selesa dan terang ini kini tersedia untuk disewa di kawasan kejiranan yang aman. Sesuai untuk individu bujang atau pelajar, bilik ini menawarkan katil yang selesa, cahaya semula jadi yang mencukupi, almari pakaian terbina dalam, dan akses ke kemudahan bilik mandi dan dapur bersama. Sewa termasuk utiliti asas dan lokasinya berada di kawasan yang tenang dan selamat.', 17, 0),
(2, 'Bilik VIP', 3, 'Suite', 150, '[Ubah huraian kemudahan bilik VIP dalam database]', 'Disediakan dengan 2 katil super single and televisyen.', 'Bilik VIP yang mewah dan luas ini terletak di kawasan kejiranan berprestij. Sesuai untuk mereka yang mencari pengalaman hidup mewah, bilik ini menawarkan katil bersaiz king, bilik mandi peribadi dengan kelengkapan berkualiti tinggi, pemandangan panorama dari balkoni peribadi, dapur kecil yang lengkap dengan peralatan moden, akses ke kemudahan eksklusif seperti kolam renang, gimnasium, dan keselamatan 24 jam, serta lokasi utama dengan akses mudah ke pengangkutan dan kemudahan lain.', 1, NULL),
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
(29, 2, 4),
(54, 1, 1),
(55, 1, 2),
(56, 1, 7);

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
(1, 'main', 'assets/images/resource/room-1_normal.jpg', 1),
(2, 'main', 'assets/images/resource/room-2_VIP.jpg', 2),
(3, 'main', 'assets/images/resource/room-3_homestay.jpg', 3),
(4, 'banner', 'assets/images/background/page-title-4_normal.jpg', 1),
(5, 'banner', 'assets/images/background/page-title-5_VIP.jpeg', 2),
(6, 'banner', 'assets/images/background/page-title-6_homestay.jpg', 3),
(9, 'add', 'assets/images/resource/room-1_livingroom.jpg', 1),
(10, 'add', 'assets/images/resource/room-1_bathroom.jpg', 1),
(49, 'add', 'assets/images/resource/room-3_homestay.jpg', 3),
(50, 'add', 'assets/images/resource/homestay_patio.jpg', 3),
(51, 'add', 'assets/images/resource/homestay_swimming.jpg', 3),
(52, 'add', 'assets/images/resource/dewanJubli.jpg', 2),
(54, 'add', 'assets/images/resource/teambuilding.jpg', 1);

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
  `penerangan_ringkas` varchar(250) NOT NULL,
  `penerangan_kemudahan` varchar(250) NOT NULL,
  `status_dewan` enum('Tersedia','Tidak Tersedia') NOT NULL,
  `max_capacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dewan`
--

INSERT INTO `dewan` (`id_dewan`, `nama_dewan`, `kadar_sewa`, `bilangan_muatan`, `penerangan`, `penerangan_ringkas`, `penerangan_kemudahan`, `status_dewan`, `max_capacity`) VALUES
(1, 'Dewan Jubli', 500.00, 250, 'Dewan Jubli merupakan sebuah dewan serbaguna yang sesuai untuk pelbagai acara seperti seminar, mesyuarat, pameran, dan lain-lain, dengan suasana yang kondusif dan reka bentuk yang elegan untuk menjayakan acara anda.', 'Dewan Jubli ialah dewan serbaguna yang sesuai untuk pelbagai acara rasmi dan santai dengan suasana yang kondusif.', 'Dewan Jubli menyediakan pelbagai kemudahan untuk memastikan keselesaan dan kelancaran setiap acara yang diadakan.', 'Tersedia', 1),
(2, 'Dewan Fiber', 350.00, 250, 'Dewan Fiber dilengkapi dengan sistem audio-visual berkualiti tinggi, penyaman udara penuh, ruang pentas luas, kapasiti tempat duduk yang besar, dan tempat letak kereta yang mencukupi untuk keselesaan pengguna.', 'Dewan Fiber menawarkan ruang serbaguna dengan suasana yang selesa dan sesuai untuk pelbagai jenis acara.', 'Dewan Fiber menyediakan pelbagai kemudahan untuk memastikan keselesaan dan kelancaran setiap acara yang diadakan.', 'Tersedia', 1),
(3, 'Dewan Kuliah Kenaf', 200.00, 40, 'Dewan Kuliah Kenaf dilengkapi dengan sistem audio-visual berkualiti tinggi, penyaman udara penuh, ruang pentas luas, kapasiti tempat duduk yang besar, dan tempat letak kereta yang mencukupi untuk keselesaan pengguna.', 'Dewan Kuliah Kenaf menawarkan ruang serbaguna dengan suasana yang selesa dan sesuai untuk pelbagai jenis acara.', 'Dewan Kuliah Kenaf menyediakan pelbagai kemudahan untuk memastikan keselesaan dan kelancaran setiap acara yang diadakan.', 'Tersedia', 1);

-- --------------------------------------------------------

--
-- Table structure for table `dewan_kemudahan`
--

CREATE TABLE `dewan_kemudahan` (
  `id_dewan_kemudahan` int(11) NOT NULL,
  `id_dewan` int(11) NOT NULL,
  `id_kemudahan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dewan_kemudahan`
--

INSERT INTO `dewan_kemudahan` (`id_dewan_kemudahan`, `id_dewan`, `id_kemudahan`) VALUES
(10, 1, 1),
(11, 1, 2),
(12, 1, 4),
(13, 1, 7),
(14, 2, 1),
(15, 2, 5),
(16, 2, 7),
(17, 3, 1),
(18, 3, 5),
(19, 3, 7),
(20, 4, 1),
(21, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `dewan_pic`
--

CREATE TABLE `dewan_pic` (
  `id_gambar` int(11) NOT NULL,
  `jenis_gambar` varchar(50) NOT NULL,
  `url_gambar` text NOT NULL,
  `id_dewan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dewan_pic`
--

INSERT INTO `dewan_pic` (`id_gambar`, `jenis_gambar`, `url_gambar`, `id_dewan`) VALUES
(28, 'Utama', 'assets/images/resource/1733271546_dewan.webp', 1),
(29, 'Banner', 'assets/images/background/1733271546_dewanJubli1.png', 1),
(30, 'Tambahan', 'assets/images/resource/1733271546_dewanJubli2.png', 1),
(31, 'Utama', 'assets/images/resource/1733271705_dewan-1.png', 2),
(32, 'Banner', 'assets/images/background/1733271705_images (1).jpeg', 2),
(33, 'Tambahan', 'assets/images/resource/1733271705_lovepik-conference-hall-picture_500680046.jpg', 2),
(34, 'Utama', 'assets/images/resource/1733271799_dewanKuliah.png', 3),
(35, 'Banner', 'assets/images/background/1733271799_Dewan_Kuliah_1.jpg', 3),
(36, 'Tambahan', 'assets/images/resource/1733271799_Dewan_Kuliah_5_6_7_8_9_.jpg', 3),
(37, 'Utama', 'assets/images/resource/1733272759_Dewan_Kuliah_5_6_7_8_9_.jpg', 4),
(38, 'Banner', 'assets/images/background/1733272759_Dewan_Kuliah_1.jpg', 4),
(39, 'Tambahan', 'assets/images/resource/1733272759_images (1).jpeg', 4);

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
(8, 'Alatan Mandi', 'assets/icons/toiletries.svg'),
(11, 'Televisyen', 'assets/icons/tv.svg');

-- --------------------------------------------------------

--
-- Table structure for table `perkahwinan`
--

CREATE TABLE `perkahwinan` (
  `id_perkahwinan` int(11) NOT NULL,
  `nama_pekej_kahwin` varchar(255) NOT NULL,
  `harga_pekej` decimal(10,2) NOT NULL,
  `huraian` text NOT NULL,
  `huraian_pendek` text NOT NULL,
  `id_dewan` int(11) NOT NULL,
  `gambar_pekej` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `perkahwinan`
--

INSERT INTO `perkahwinan` (`id_perkahwinan`, `nama_pekej_kahwin`, `harga_pekej`, `huraian`, `huraian_pendek`, `id_dewan`, `gambar_pekej`) VALUES
(5, 'Raikan Cinta - Dewan Fiber', 500.00, 'Dewan utama berhawa dingin yang boleh menampung 50 orang\n8 unit meja dan alas meja\n80 unit kerusi\nBoleh add on \nruang porch yang boleh memuatkan 50 orang jemputan – RM50.00\nMeja dan alas – RM8.00/Unit\nKerusi – RM1/Unit\nMeja Banquet – RM5/Unit', 'Dewan utama berhawa dingin yang boleh menampung 50 orang\r\n8 unit meja dan alas meja\r\n80 unit kerusi', 1, 'adminDashboard/controller/uploads/dewanJubli2.png'),
(6, 'Raikan Cinta - Dewan Jubli', 600.00, 'Meja dan alas – RM8.00/Unit\r\nKerusi – RM1/Unit\r\nMeja Banquet – RM5/Unit', 'Dewan utama berhawa dingin yang boleh menampung 50 orang\r\n8 unit meja dan alas meja\r\n80 unit kerusi\r\n\r\nMeja dan alas – RM8.00/Unit\r\nKerusi – RM1/Unit\r\nMeja Banquet – RM5/Unit', 3, 'adminDashboard/controller/uploads/dewanFiber.jpg');

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
  `bilangan_pax` int(10) NOT NULL,
  `tarikh_tempahan` datetime NOT NULL,
  `tarikh_daftar_masuk` date NOT NULL,
  `tarikh_daftar_keluar` date NOT NULL,
  `harga_keseluruhan` float NOT NULL,
  `cara_bayar` enum('FPX','Tunai','LO','E-Perolehan','Bank Transfer') NOT NULL,
  `reference_id` varchar(255) DEFAULT NULL,
  `id_bilik` int(11) DEFAULT NULL,
  `id_dewan` int(11) DEFAULT NULL,
  `id_perkahwinan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tempahan`
--

INSERT INTO `tempahan` (`id_tempahan`, `nombor_tempahan`, `nama_penuh`, `numbor_fon`, `email`, `bilangan_pax`, `tarikh_tempahan`, `tarikh_daftar_masuk`, `tarikh_daftar_keluar`, `harga_keseluruhan`, `cara_bayar`, `reference_id`, `id_bilik`, `id_dewan`, `id_perkahwinan`) VALUES
(84, 'DEWAN-241204-238', 'try', '0108376005', 'atikah9w2ser@GMAIL.COM', 0, '2024-12-04 08:33:35', '2024-12-04', '2024-12-05', 500, 'FPX', NULL, NULL, 1, NULL),
(85, 'DEWAN-241204-021', 'ffdsfF', '0108376005', 'nurul@GMAIL.COM', 0, '2024-12-04 08:40:49', '2024-12-06', '2024-12-07', 500, 'FPX', NULL, NULL, 1, NULL),
(86, 'ROOM-241204-750', 'WAN MUHAMMAD NAQIB ZAFRAN WAN ROSLAN', '0184028240', 'wannaqib01@gmail.com', 5, '2024-12-04 09:56:49', '2024-12-04', '2024-12-05', 340, 'LO', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tempahan_perkahwinan_addons`
--

CREATE TABLE `tempahan_perkahwinan_addons` (
  `id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `add_on_id` int(11) NOT NULL,
  `id_tempahan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_on_perkahwinan`
--
ALTER TABLE `add_on_perkahwinan`
  ADD PRIMARY KEY (`add_on_id`);

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
-- Indexes for table `dewan_kemudahan`
--
ALTER TABLE `dewan_kemudahan`
  ADD PRIMARY KEY (`id_dewan_kemudahan`);

--
-- Indexes for table `dewan_pic`
--
ALTER TABLE `dewan_pic`
  ADD PRIMARY KEY (`id_gambar`);

--
-- Indexes for table `kemudahan`
--
ALTER TABLE `kemudahan`
  ADD PRIMARY KEY (`id_kemudahan`);

--
-- Indexes for table `perkahwinan`
--
ALTER TABLE `perkahwinan`
  ADD PRIMARY KEY (`id_perkahwinan`),
  ADD KEY `id_dewan` (`id_dewan`);

--
-- Indexes for table `tempahan`
--
ALTER TABLE `tempahan`
  ADD PRIMARY KEY (`id_tempahan`),
  ADD KEY `room_id` (`id_bilik`),
  ADD KEY `id_perkahwinan` (`id_perkahwinan`) USING BTREE,
  ADD KEY `id_dewan` (`id_dewan`);

--
-- Indexes for table `tempahan_perkahwinan_addons`
--
ALTER TABLE `tempahan_perkahwinan_addons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `add_on_id` (`add_on_id`),
  ADD KEY `id_tempahan` (`id_tempahan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_on_perkahwinan`
--
ALTER TABLE `add_on_perkahwinan`
  MODIFY `add_on_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `aktiviti`
--
ALTER TABLE `aktiviti`
  MODIFY `id_aktiviti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bilik`
--
ALTER TABLE `bilik`
  MODIFY `id_bilik` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `bilik_kemudahan`
--
ALTER TABLE `bilik_kemudahan`
  MODIFY `id_bilik_kemudahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `bilik_pic`
--
ALTER TABLE `bilik_pic`
  MODIFY `id_gambar` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `dewan`
--
ALTER TABLE `dewan`
  MODIFY `id_dewan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dewan_kemudahan`
--
ALTER TABLE `dewan_kemudahan`
  MODIFY `id_dewan_kemudahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `dewan_pic`
--
ALTER TABLE `dewan_pic`
  MODIFY `id_gambar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `kemudahan`
--
ALTER TABLE `kemudahan`
  MODIFY `id_kemudahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `perkahwinan`
--
ALTER TABLE `perkahwinan`
  MODIFY `id_perkahwinan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tempahan`
--
ALTER TABLE `tempahan`
  MODIFY `id_tempahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `tempahan_perkahwinan_addons`
--
ALTER TABLE `tempahan_perkahwinan_addons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

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
-- Constraints for table `perkahwinan`
--
ALTER TABLE `perkahwinan`
  ADD CONSTRAINT `perkahwinan_ibfk_1` FOREIGN KEY (`id_dewan`) REFERENCES `dewan` (`id_dewan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tempahan`
--
ALTER TABLE `tempahan`
  ADD CONSTRAINT `tempahan_ibfk_1` FOREIGN KEY (`id_bilik`) REFERENCES `bilik` (`id_bilik`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tempahan_ibfk_2` FOREIGN KEY (`id_perkahwinan`) REFERENCES `perkahwinan` (`id_perkahwinan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tempahan_perkahwinan_addons`
--
ALTER TABLE `tempahan_perkahwinan_addons`
  ADD CONSTRAINT `tempahan_perkahwinan_addons_ibfk_1` FOREIGN KEY (`add_on_id`) REFERENCES `add_on_perkahwinan` (`add_on_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tempahan_perkahwinan_addons_ibfk_2` FOREIGN KEY (`id_tempahan`) REFERENCES `tempahan` (`id_tempahan`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
