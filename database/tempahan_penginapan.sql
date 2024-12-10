-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2024 at 03:38 AM
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
  `penerangan_kemudahan` varchar(500) NOT NULL,
  `penerangan` varchar(550) NOT NULL,
  `status_aktiviti` enum('Tersedia','Tidak Tersedia') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aktiviti`
--

INSERT INTO `aktiviti` (`id_aktiviti`, `nama_aktiviti`, `kadar_harga`, `penerangan_kemudahan`, `penerangan`, `status_aktiviti`) VALUES
(22, 'Pakej Teambuilding', 99.00, 'Kemudahan dalam pakej teambuilding biasanya dirancang untuk memberikan pengalaman yang menyeluruh, menyeronokkan, dan bermakna kepada peserta.', 'Pakej teambuilding adalah program atau perkhidmatan yang dirancang untuk meningkatkan kerjasama, komunikasi, dan hubungan antara ahli kumpulan, organisasi, atau pasukan. Aktiviti teambuilding sering kali melibatkan pelbagai aktiviti interaktif, permainan, dan latihan yang bertujuan untuk memperkukuhkan semangat kerja berpasukan dan menggalakkan pencapaian matlamat bersama.', 'Tersedia'),
(23, 'Pakej Kem Pelajar', 55.00, 'Kemudahan dalam pakej kem pelajar biasanya merangkumi beberapa elemen yang bertujuan untuk memberikan pengalaman pembelajaran yang bermakna serta menyeronokkan. Kemudahan-kemudahan ini direka untuk memastikan para pelajar dapat menikmati pengalaman yang seimbang antara pembelajaran, rekreasi, dan pembangunan diri dalam suasana yang selamat dan kondusif.', 'Kem pelajar adalah program intensif yang bertujuan untuk mengembangkan potensi pelajar melalui aktiviti yang menyeronokkan, mencabar, dan bermakna. Kem ini biasanya diadakan di lokasi yang jauh dari persekitaran sekolah biasa, seperti kawasan semula jadi, pusat latihan, atau resort, dengan tujuan memberikan suasana baru yang merangsang pembelajaran dan perkembangan diri.', 'Tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `aktiviti_kemudahan`
--

CREATE TABLE `aktiviti_kemudahan` (
  `id_aktiviti_kemudahan` int(11) NOT NULL,
  `id_aktiviti` int(11) NOT NULL,
  `id_kemudahan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aktiviti_kemudahan`
--

INSERT INTO `aktiviti_kemudahan` (`id_aktiviti_kemudahan`, `id_aktiviti`, `id_kemudahan`) VALUES
(42, 23, 1),
(43, 23, 4),
(44, 23, 7),
(45, 22, 1),
(46, 22, 4),
(47, 22, 7);

-- --------------------------------------------------------

--
-- Table structure for table `aktiviti_pic`
--

CREATE TABLE `aktiviti_pic` (
  `id_gambar` int(11) NOT NULL,
  `jenis_gambar` varchar(50) NOT NULL,
  `url_gambar` text NOT NULL,
  `id_aktiviti` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aktiviti_pic`
--

INSERT INTO `aktiviti_pic` (`id_gambar`, `jenis_gambar`, `url_gambar`, `id_aktiviti`) VALUES
(67, 'Utama', 'assets/images/resource/1733629649_teamBuilding1.jpg', 22),
(68, 'Banner', 'assets/images/background/1733629649_teamBuilding2.jpg', 22),
(69, 'Tambahan', 'assets/images/resource/1733629649_0_teamBuilding3.jpg', 22),
(70, 'Utama', 'assets/images/resource/1733629957_kemPelajar1.jpg', 23),
(71, 'Banner', 'assets/images/background/1733629957_kemPelajar2.jpg', 23),
(72, 'Tambahan', 'assets/images/resource/1733629957_0_kemPelajar3.jpg', 23);

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
(1, 'Bilik biasabiasa', 2, 'Room', 68, 'Datang Dgn tab mandi. dan wifi percuma', 'Sesuai untuk 2 orang. Disediakan dengan penghawa dingin.', 'Bilik yang selesa dan terang ini kini tersedia untuk disewa di kawasan kejiranan yang aman. Sesuai untuk individu bujang atau pelajar, bilik ini menawarkan katil yang selesa, cahaya semula jadi yang mencukupi, almari pakaian terbina dalam, dan akses ke kemudahan bilik mandi dan dapur bersama. Sewa termasuk utiliti asas dan lokasinya berada di kawasan yang tenang dan selamat.', 17, 0),
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
(74, 1, 1),
(75, 1, 2),
(76, 1, 3),
(77, 1, 4),
(78, 1, 5),
(79, 1, 6),
(80, 1, 7),
(81, 1, 8),
(82, 1, 11),
(83, 2, 2),
(84, 2, 4),
(85, 2, 5);

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
(1, 'main', 'assets/images/resource/dalambilik-scaled.jpg', 1),
(2, 'main', 'assets/images/resource/room-2_VIP.jpg', 2),
(3, 'main', 'assets/images/resource/room-3_homestay.jpg', 3),
(4, 'banner', 'assets/images/background/page-title-4_normal.jpg', 1),
(5, 'banner', 'assets/images/background/page-title-5_VIP.jpeg', 2),
(6, 'banner', 'assets/images/background/page-title-6_homestay.jpg', 3),
(10, 'add', 'assets/images/resource/room-1_bathroom.jpg', 1),
(49, 'add', 'assets/images/resource/room-3_homestay.jpg', 3),
(50, 'add', 'assets/images/resource/homestay_patio.jpg', 3),
(51, 'add', 'assets/images/resource/homestay_swimming.jpg', 3),
(52, 'add', 'assets/images/resource/dewanJubli.jpg', 2),
(67, 'add', 'assets/images/resource/living-room-1.jpg', 1);

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
(16, 'Dewan Jubli', 500.00, 250, 'Dewan Jubli adalah sebuah dewan yang luas dan moden, direka khas untuk memenuhi keperluan pelbagai jenis acara besar dan kecil. Dengan ruang yang selesa dan suasana yang elegan, dewan ini mampu menampung jumlah tetamu yang besar, menjadikannya pilihan utama untuk pelbagai majlis, seperti perkahwinan, seminar, atau penganjuran acara rasmi. ', 'Dewan Jubli adalah dewan moden dan luas, ideal untuk pelbagai acara besar dan kecil.', 'Dewan Jubli memberikan kemudahan yang sesuai untuk digunakan.', 'Tersedia', 1),
(17, 'Dewan Fiber', 350.00, 250, 'Dewan Fiber adalah sebuah dewan yang luas dan moden, direka khas untuk memenuhi keperluan pelbagai jenis acara besar dan kecil. Dengan ruang yang selesa dan suasana yang elegan, dewan ini mampu menampung jumlah tetamu yang besar, menjadikannya pilihan utama untuk pelbagai majlis, seperti perkahwinan, seminar, atau penganjuran acara rasmi. ', 'Dewan Fiber adalah dewan moden dan luas, ideal untuk pelbagai acara besar dan kecil.', 'Dewan Fiber memberikan kemudahan yang sesuai untuk digunakan.', 'Tersedia', 1),
(18, 'Dewan Kuliah Kenaf', 200.00, 40, 'Dewan Kuliah Kenaf adalah sebuah dewan yang luas dan moden, direka khas untuk memenuhi keperluan pelbagai jenis acara besar dan kecil. Dengan ruang yang selesa dan suasana yang elegan, dewan ini mampu menampung jumlah tetamu yang besar, menjadikannya pilihan utama untuk pelbagai majlis, seperti perkahwinan, seminar, atau penganjuran acara rasmi. ', 'Dewan Kuliah Kenaf adalah dewan moden dan luas, ideal untuk pelbagai acara besar dan kecil.', 'Dewan Kuliah Kenaf memberikan kemudahan yang sesuai untuk digunakan.', 'Tersedia', 1);

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
(62, 16, 1),
(63, 16, 5),
(64, 16, 7),
(68, 18, 1),
(69, 18, 5),
(70, 18, 7),
(77, 19, 1),
(78, 19, 5),
(79, 19, 8),
(82, 20, 1),
(83, 20, 4),
(88, 17, 1),
(89, 17, 5),
(90, 17, 7);

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
(79, 'Utama', 'assets/images/resource/1733330168_dewan.webp', 16),
(80, 'Banner', 'assets/images/background/1733330168_dewanJubli1.png', 16),
(81, 'Tambahan', 'assets/images/resource/1733330168_0_dewanJubli2.png', 16),
(82, 'Utama', 'assets/images/resource/1733330259_dewan-1.png', 17),
(83, 'Banner', 'assets/images/background/1733330259_images (1).jpeg', 17),
(84, 'Tambahan', 'assets/images/resource/1733330259_0_lovepik-conference-hall-picture_500680046.jpg', 17),
(85, 'Utama', 'assets/images/resource/1733330320_dewanKuliah.png', 18),
(86, 'Banner', 'assets/images/background/1733330320_Dewan_Kuliah_5_6_7_8_9_.jpg', 18),
(87, 'Tambahan', 'assets/images/resource/1733330320_0_Dewan_Kuliah_1.jpg', 18),
(88, 'Utama', 'assets/images/resource/1733616806_teamBuilding2.jpg', 19),
(89, 'Banner', 'assets/images/background/1733616806_teamBuilding3.jpg', 19),
(90, 'Tambahan', 'assets/images/resource/1733616806_0_kemPelajar3.jpg', 19),
(91, 'Tambahan', 'assets/images/resource/1733616806_1_teamBuilding1.jpg', 19),
(92, 'Utama', 'assets/images/resource/1733616923_kemPelajar3.jpg', 20),
(93, 'Banner', 'assets/images/background/1733616923_teamBuilding2.jpg', 20),
(94, 'Tambahan', 'assets/images/resource/1733616923_0_kemPelajar2.jpg', 20),
(95, 'Tambahan', 'assets/images/resource/1733616923_1_kemPelajar1.jpg', 20);

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
(11, 'Raikan Cinta - Dewan Fiber', 60000.00, 'Penerangan PanjangPenerangan Panjang', 'Penerangan Pendek', 17, 'assets/images/resource/pakejPerkahwinan.jpg'),
(12, 'Raikan Cinta - Dewan Jubli', 2000.00, 'Penerangan PanjangPenerangan PanjangPenerangan Panjang', 'Penerangan PendekPenerangan Pendek', 16, 'assets/images/resource/Bil kolej.png');

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
  `bilangan_pax` int(10) DEFAULT NULL,
  `tarikh_tempahan` datetime NOT NULL,
  `tarikh_daftar_masuk` date NOT NULL,
  `tarikh_daftar_keluar` date NOT NULL,
  `harga_keseluruhan` float NOT NULL,
  `cara_bayar` enum('FPX','Tunai','LO','E-Perolehan','Bank Transfer') NOT NULL,
  `reference_id` varchar(255) DEFAULT NULL,
  `id_bilik` int(11) DEFAULT NULL,
  `id_dewan` int(11) DEFAULT NULL,
  `id_perkahwinan` int(11) DEFAULT NULL,
  `id_aktiviti` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tempahan`
--

INSERT INTO `tempahan` (`id_tempahan`, `nombor_tempahan`, `nama_penuh`, `numbor_fon`, `email`, `bilangan_pax`, `tarikh_tempahan`, `tarikh_daftar_masuk`, `tarikh_daftar_keluar`, `harga_keseluruhan`, `cara_bayar`, `reference_id`, `id_bilik`, `id_dewan`, `id_perkahwinan`, `id_aktiviti`) VALUES
(84, 'DEWAN-241204-238', 'try', '0108376005', 'atikah9w2ser@GMAIL.COM', 0, '2024-12-04 08:33:35', '2024-12-04', '2024-12-05', 500, 'FPX', NULL, NULL, 1, NULL, NULL),
(85, 'DEWAN-241204-021', 'ffdsfF', '0108376005', 'nurul@GMAIL.COM', 0, '2024-12-04 08:40:49', '2024-12-06', '2024-12-07', 500, 'FPX', NULL, NULL, 1, NULL, NULL),
(86, 'ROOM-241204-750', 'WAN MUHAMMAD NAQIB ZAFRAN WAN ROSLAN', '0184028240', 'wannaqib01@gmail.com', 5, '2024-12-04 09:56:49', '2024-12-04', '2024-12-05', 340, 'LO', NULL, 1, NULL, NULL, NULL),
(87, 'ROOM-241204-349', 'nurul atikah', '0108376005', 'atikah9w2ser@GMAIL.COM', 1, '2024-12-04 12:14:49', '2024-12-04', '2024-12-05', 150, 'FPX', NULL, 2, NULL, NULL, NULL),
(88, 'DEWAN-241204-959', 'rqgrgqwrcxbfzbddb', '0123456789', 'sayang@GMAIL.COM', NULL, '2024-12-04 12:16:04', '2024-12-04', '2024-12-05', 350, 'FPX', NULL, NULL, 2, NULL, NULL),
(89, 'DEWAN-241204-565', 'nurul atikah', '0075474352', 'EMAIL@GMAIL.COM', NULL, '2024-12-04 12:16:58', '2024-12-28', '2024-12-29', 200, 'FPX', NULL, NULL, 3, NULL, NULL),
(90, 'DEWAN-241204-869', 'nurul atikah', '0213322213', 'grqqgq@GMAIL.COM', NULL, '2024-12-04 12:18:50', '2024-12-26', '2024-12-27', 350, 'FPX', NULL, NULL, 2, NULL, NULL),
(91, 'DEWAN-241204-346', 'nurul atikah', '0213322213', 'grqqgq@GMAIL.COM', NULL, '2024-12-04 12:23:55', '2024-12-28', '2024-12-29', 350, 'FPX', NULL, NULL, 2, NULL, NULL),
(92, 'ROOM-241204-421', 'rqgrgqwrcxbfzbddb', '0108376005', 'EMAIL@GMAIL.COM', 1, '2024-12-04 12:26:26', '2024-12-28', '2024-12-29', 150, 'LO', NULL, 2, NULL, NULL, NULL),
(93, 'DEWAN-241204-445', 'rqgrgqwrcxbfzbddb', '0108376005', 'EMAIL@GMAIL.COM', NULL, '2024-12-04 12:32:08', '2024-12-28', '2024-12-29', 150, 'FPX', NULL, NULL, 2, NULL, NULL),
(94, 'DEWAN-241204-857', 'rqgrgqwrcxbfzbddb', '0108376005', 'EMAIL@GMAIL.COM', NULL, '2024-12-04 12:36:50', '2024-12-28', '2024-12-29', 150, 'FPX', NULL, NULL, 2, NULL, NULL),
(95, 'DEWAN-241204-851', 'agreagweaew', '0075474352', 'nurul@GMAIL.COM', NULL, '2024-12-04 12:37:59', '2024-12-04', '2024-12-05', 200, 'FPX', NULL, NULL, 3, NULL, NULL),
(96, 'ROOM-241204-788', 'nurul', '0075474352', 'nurul@GMAIL.COM', 1, '2024-12-04 12:43:37', '2024-12-31', '2025-01-01', 150, '', NULL, 2, NULL, NULL, NULL),
(97, 'DEWAN-241204-433', 'nurul', '0075474352', 'nurul@GMAIL.COM', NULL, '2024-12-04 12:44:01', '2024-12-31', '2025-01-01', 150, 'FPX', NULL, NULL, 3, NULL, NULL),
(98, 'ROOM-241204-113', 'nurul', '0075474352', 'nurul@GMAIL.COM', 1, '2024-12-04 12:44:35', '2024-12-31', '2025-01-01', 150, 'Tunai', NULL, 2, NULL, NULL, NULL),
(99, 'DEWAN-241204-870', 'NURUL ATIKAH BINTI MOHD NASIR', '0108376005', 'nurul03atikah@gmail.com', 0, '2024-12-04 12:45:40', '2024-12-15', '2024-12-16', 350, 'Tunai', NULL, NULL, 2, NULL, NULL),
(100, 'ROOM-241204-560', 'NURUL ATIKAH BINTI MOHD NASIR', '0108376005', 'atikah9w2ser@GMAIL.COM', 1, '2024-12-04 12:46:20', '2024-12-22', '2024-12-23', 150, 'Bank Transfer', NULL, 2, NULL, NULL, NULL),
(101, 'DEWAN-241204-998', 'NURUL ATIKAH BINTI MOHD NASIR', '0108376005', 'atikah9w2ser@GMAIL.COM', 0, '2024-12-04 12:46:51', '2024-12-19', '2024-12-20', 350, 'Bank Transfer', NULL, NULL, 2, NULL, NULL),
(102, 'ROOM-241204-422', 'rqgrgqwrcxbfzbddb', '0108376005', 'nurul@GMAIL.COM', 1, '2024-12-04 12:47:28', '2024-12-25', '2024-12-26', 200, 'Tunai', NULL, 3, NULL, NULL, NULL),
(103, 'DEWAN-241204-792', 'rqgrgqwrcxbfzbddb', '0075474352', 'nurul@GMAIL.COM', 0, '2024-12-04 12:53:11', '2024-12-12', '2024-12-13', 500, 'LO', NULL, NULL, 1, NULL, NULL),
(104, 'DEWAN-241204-243', 'NURUL ATIKAH BINTI MOHD NASIR', '0108376005', 'atikah9w2ser@GMAIL.COM', 0, '2024-12-04 12:56:47', '2025-01-01', '2025-01-10', 4500, 'Tunai', NULL, NULL, 1, NULL, NULL),
(105, 'DEWAN-241204-095', 'NIK NADIA NATASYA', '0175474352', 'nadia@gmail.com', 0, '2024-12-04 16:46:52', '2025-02-07', '2025-02-11', 800, 'Tunai', NULL, NULL, 3, NULL, NULL),
(106, 'DEWAN-241205-075', 'atikah nasir', '0108376005', 'atikah9w2ser@GMAIL.COM', 0, '2024-12-05 00:39:44', '2024-12-05', '2024-12-06', 350, 'Tunai', NULL, NULL, 17, NULL, NULL),
(107, 'DEWAN-241205-087', 'NURUL ATIKAH BINTI MOHD NASIR', '0108376005', 'atikah9w2ser@GMAIL.COM', 0, '2024-12-05 08:18:29', '2024-12-19', '2024-12-20', 350, 'Tunai', NULL, NULL, 17, NULL, NULL),
(108, 'DEWAN-241205-166', 'nadddddd', '0189042908', 'ndiantsya92@gmail.com', 0, '2024-12-05 08:52:44', '2024-12-05', '2024-12-06', 500, 'FPX', NULL, NULL, 16, NULL, NULL),
(109, 'DEWAN-241205-434', 'nadddddd', '0189042908', 'ndiantsya92@gmail.com', 0, '2024-12-05 08:53:22', '2024-12-05', '2024-12-06', 500, 'FPX', NULL, NULL, 16, NULL, NULL),
(110, 'ROOM-241205-364', 'NADIA', '0189042908', 'ndiantsya92@gmail.com', 1, '2024-12-05 10:21:49', '2024-12-05', '2024-12-06', 200, 'FPX', NULL, 3, NULL, NULL, NULL),
(111, 'ROOM-241205-669', 'NIK', '0189042908', 'nik92@gmail.com', 1, '2024-12-05 10:22:52', '2024-12-31', '2025-01-01', 200, 'FPX', NULL, 3, NULL, NULL, NULL),
(112, 'DEWAN-241205-079', 'nadddddd', '0189042908', 'ndiantsya92@gmail.com', 0, '2024-12-05 10:32:50', '2025-02-28', '2025-03-01', 500, 'Tunai', NULL, NULL, 16, NULL, NULL),
(114, 'ROOM-241206-636', 'NADIA', '0189042908', 'ndiantsya92@gmail.com', 1, '2024-12-06 13:33:23', '2024-12-18', '2024-12-19', 68, 'FPX', NULL, 1, NULL, NULL, NULL),
(115, 'ROOM-241206-552', 'nadddddddv', '0189042908', 'ndiantsya92@gmail.com', 1, '2024-12-06 13:48:29', '2025-01-10', '2025-01-11', 68, 'FPX', NULL, 1, NULL, NULL, NULL),
(116, 'ROOM-241206-501', 'errerrrrrrrrr', '0189042908', 'ndiantsya92@gmail.com', 1, '2024-12-06 13:48:52', '2024-12-18', '2024-12-19', 68, 'FPX', NULL, 1, NULL, NULL, NULL),
(117, 'ROOM-241206-896', 'errerrrrrrrrr', '0189042908', 'ndiantsya92@gmail.com', 1, '2024-12-06 13:49:11', '2024-12-18', '2024-12-19', 68, 'FPX', NULL, 1, NULL, NULL, NULL),
(118, 'ROOM-241206-309', 'nadddddddv', '0189042908', 'ndiantsya92@gmail.com', 1, '2024-12-06 17:07:51', '2024-12-19', '2024-12-20', 68, 'FPX', NULL, 1, NULL, NULL, NULL),
(119, 'DEWAN-241206-168', 'nadddddd', '0189042908', 'ndiantsya92@gmail.com', 0, '2024-12-06 17:48:21', '2024-12-13', '2024-12-14', 0, '', NULL, NULL, 16, NULL, NULL),
(120, 'DEWAN-241206-620', 'NADIA', '0189042908', 'ndiantsya92@gmail.com', 0, '2024-12-06 17:50:35', '2025-01-08', '2025-01-10', 0, '', NULL, NULL, 16, NULL, NULL),
(125, 'DEWAN-241206-742', 'nadddddddv', '0189042908', 'ndiantsya92@gmail.com', 0, '2024-12-06 22:17:36', '2025-01-23', '2025-01-24', 0, '', NULL, NULL, 16, NULL, NULL),
(126, 'DEWAN-241206-153', 'nadddddd', '0189042908', 'ndiantsya92@gmail.com', 0, '2024-12-06 22:27:03', '2025-01-25', '2025-01-26', 0, '', NULL, NULL, 16, NULL, NULL),
(127, 'DEWAN-241207-432', 'NIK NADIA', '0129879212', 'niknadia@gmail.com', 0, '2024-12-07 14:42:45', '2025-03-19', '2025-03-20', 500, 'FPX', NULL, NULL, 16, NULL, NULL),
(129, 'DEWAN-241207-915', 'NIKKKK', '0189042908', 'niktasya92@gmail.com', 0, '2024-12-07 15:49:48', '2025-01-09', '2025-01-10', 350, 'FPX', NULL, NULL, 17, NULL, NULL),
(133, 'DEWAN-241208-140', 'NADIA', '0189042908', 'ndiantsya92@gmail.com', 0, '2024-12-08 08:16:04', '2025-01-09', '2025-01-10', 4, 'FPX', NULL, NULL, 20, NULL, NULL),
(134, 'DEWAN-241208-633', 'NADIA', '0189042908', 'ndiantsya92@gmail.com', 0, '2024-12-08 08:16:10', '2025-01-09', '2025-01-10', 4, 'Tunai', NULL, NULL, 20, NULL, NULL),
(141, 'AKTIVITI-241208-988', 'NIK NADIA', '0189042908', 'niknadia@gmail.com', NULL, '2024-12-08 11:55:02', '2024-12-08', '2024-12-09', 4950, 'FPX', NULL, NULL, NULL, NULL, 22),
(142, 'WED-2024-12-08-8780', 'WAN MUHAMMAD NAQIB ZAFRAN WAN ROSLAN', '0184028240', 'wannaqib01@gmail.com', 100, '2024-12-08 12:25:28', '2024-12-08', '0000-00-00', 60155, 'Tunai', NULL, NULL, 17, 11, NULL),
(143, 'ROOM-241208-511', 'OSLAN', '0184028240', 'wannaqib01@gmail.com', 4, '2024-12-08 12:27:12', '2024-12-08', '2024-12-09', 272, '', NULL, 1, NULL, NULL, NULL);

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
-- Dumping data for table `tempahan_perkahwinan_addons`
--

INSERT INTO `tempahan_perkahwinan_addons` (`id`, `quantity`, `add_on_id`, `id_tempahan`) VALUES
(31, 1, 1, 142),
(32, 10, 2, 142),
(33, 1, 3, 142),
(34, 3, 5, 142);

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
-- Indexes for table `aktiviti_kemudahan`
--
ALTER TABLE `aktiviti_kemudahan`
  ADD PRIMARY KEY (`id_aktiviti_kemudahan`);

--
-- Indexes for table `aktiviti_pic`
--
ALTER TABLE `aktiviti_pic`
  ADD PRIMARY KEY (`id_gambar`);

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
  ADD KEY `id_dewan` (`id_dewan`),
  ADD KEY `id_aktiviti` (`id_aktiviti`);

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
  MODIFY `add_on_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `aktiviti`
--
ALTER TABLE `aktiviti`
  MODIFY `id_aktiviti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `aktiviti_kemudahan`
--
ALTER TABLE `aktiviti_kemudahan`
  MODIFY `id_aktiviti_kemudahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `aktiviti_pic`
--
ALTER TABLE `aktiviti_pic`
  MODIFY `id_gambar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `bilik`
--
ALTER TABLE `bilik`
  MODIFY `id_bilik` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `bilik_kemudahan`
--
ALTER TABLE `bilik_kemudahan`
  MODIFY `id_bilik_kemudahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `bilik_pic`
--
ALTER TABLE `bilik_pic`
  MODIFY `id_gambar` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `dewan`
--
ALTER TABLE `dewan`
  MODIFY `id_dewan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `dewan_kemudahan`
--
ALTER TABLE `dewan_kemudahan`
  MODIFY `id_dewan_kemudahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `dewan_pic`
--
ALTER TABLE `dewan_pic`
  MODIFY `id_gambar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `kemudahan`
--
ALTER TABLE `kemudahan`
  MODIFY `id_kemudahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `perkahwinan`
--
ALTER TABLE `perkahwinan`
  MODIFY `id_perkahwinan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tempahan`
--
ALTER TABLE `tempahan`
  MODIFY `id_tempahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `tempahan_perkahwinan_addons`
--
ALTER TABLE `tempahan_perkahwinan_addons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

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
