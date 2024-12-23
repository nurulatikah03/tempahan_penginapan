-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2024 at 07:19 PM
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
(5, 'Meja Banquet', 5);

-- --------------------------------------------------------

--
-- Table structure for table `aktiviti`
--

CREATE TABLE `aktiviti` (
  `id_aktiviti` int(11) NOT NULL,
  `nama_aktiviti` varchar(50) DEFAULT NULL,
  `kadar_harga` decimal(10,2) DEFAULT NULL,
  `penerangan_kemudahan` varchar(500) DEFAULT NULL,
  `penerangan` varchar(550) DEFAULT NULL,
  `status_aktiviti` enum('Tersedia','Tidak Tersedia') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aktiviti`
--

INSERT INTO `aktiviti` (`id_aktiviti`, `nama_aktiviti`, `kadar_harga`, `penerangan_kemudahan`, `penerangan`, `status_aktiviti`) VALUES
(26, 'Pakej Kem Pelajar', 55.00, 'Kemudahan dalam pakej kem pelajar biasanya merangkumi beberapa elemen yang bertujuan untuk memberikan pengalaman pembelajaran yang bermakna serta menyeronokkan. Kemudahan-kemudahan ini direka untuk memastikan para pelajar dapat menikmati pengalaman yang seimbang antara pembelajaran, rekreasi, dan pembangunan diri dalam suasana yang selamat dan kondusif.', 'Kem pelajar adalah program intensif yang bertujuan untuk mengembangkan potensi pelajar melalui aktiviti yang menyeronokkan, mencabar, dan bermakna. Kem ini biasanya diadakan di lokasi yang jauh dari persekitaran sekolah biasa, seperti kawasan semula jadi, pusat latihan, atau resort, dengan tujuan memberikan suasana baru yang merangsang pembelajaran dan perkembangan diri.', 'Tersedia'),
(27, 'Pakej Teambuilding', 99.00, 'Kemudahan dalam pakej teambuilding biasanya dirancang untuk memberikan pengalaman yang menyeluruh, menyeronokkan, dan bermakna kepada peserta.', 'Pakej teambuilding adalah program atau perkhidmatan yang dirancang untuk meningkatkan kerjasama, komunikasi, dan hubungan antara ahli kumpulan, organisasi, atau pasukan. Aktiviti teambuilding sering kali melibatkan pelbagai aktiviti interaktif, permainan, dan latihan yang bertujuan untuk memperkukuhkan semangat kerja berpasukan dan menggalakkan pencapaian matlamat bersama.', 'Tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `aktiviti_kemudahan`
--

CREATE TABLE `aktiviti_kemudahan` (
  `id_aktiviti_kemudahan` int(11) NOT NULL,
  `id_aktiviti` int(11) DEFAULT NULL,
  `id_kemudahan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aktiviti_kemudahan`
--

INSERT INTO `aktiviti_kemudahan` (`id_aktiviti_kemudahan`, `id_aktiviti`, `id_kemudahan`) VALUES
(45, 22, 1),
(46, 22, 4),
(47, 22, 7),
(55, 23, 1),
(56, 23, 2),
(57, 23, 4),
(58, 23, 5),
(59, 23, 7),
(65, 27, 1),
(66, 27, 3),
(67, 27, 5),
(68, 27, 7),
(75, 26, 1),
(76, 26, 5),
(77, 26, 7);

-- --------------------------------------------------------

--
-- Table structure for table `aktiviti_pic`
--

CREATE TABLE `aktiviti_pic` (
  `id_gambar` int(11) NOT NULL,
  `jenis_gambar` varchar(50) DEFAULT NULL,
  `url_gambar` text DEFAULT NULL,
  `id_aktiviti` int(11) DEFAULT NULL
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
  `nama_bilik` varchar(50) DEFAULT NULL,
  `kapasiti` int(4) DEFAULT NULL,
  `jenis_bilik` varchar(15) DEFAULT NULL,
  `harga_semalaman` float DEFAULT NULL,
  `huraian_kemudahan` text DEFAULT NULL,
  `huraian_pendek` text DEFAULT NULL,
  `huraian` text DEFAULT NULL,
  `max_capacity` int(3) DEFAULT NULL,
  `id_admin` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bilik`
--

INSERT INTO `bilik` (`id_bilik`, `nama_bilik`, `kapasiti`, `jenis_bilik`, `harga_semalaman`, `huraian_kemudahan`, `huraian_pendek`, `huraian`, `max_capacity`, `id_admin`) VALUES
(1, 'Bilik biasabiasa', 2, 'Room', 68, 'Datang Dgn tab mandi. dan wifi percuma', 'Sesuai untuk 2 orang. Disediakan dengan penghawa dingin.', 'Bilik yang selesa dan terang ini kini tersedia untuk disewa di kawasan kejiranan yang aman. Sesuai untuk individu bujang atau pelajar, bilik ini menawarkan katil yang selesa, cahaya semula jadi yang mencukupi, almari pakaian terbina dalam, dan akses ke kemudahan bilik mandi dan dapur bersama. Sewa termasuk utiliti asas dan lokasinya berada di kawasan yang tenang dan selamat.', 5, 0),
(2, 'Bilik VIP', 3, 'Suite', 150, '[Ubah huraian kemudahan bilik VIP dalam database]', 'Disediakan dengan 2 katil super single and televisyen.', 'Bilik VIP yang mewah dan luas ini terletak di kawasan kejiranan berprestij. Sesuai untuk mereka yang mencari pengalaman hidup mewah, bilik ini menawarkan katil bersaiz king, bilik mandi peribadi dengan kelengkapan berkualiti tinggi, pemandangan panorama dari balkoni peribadi, dapur kecil yang lengkap dengan peralatan moden, akses ke kemudahan eksklusif seperti kolam renang, gimnasium, dan keselamatan 24 jam, serta lokasi utama dengan akses mudah ke pengangkutan dan kemudahan lain.', 2, NULL),
(3, 'Home Stay INSKET', 8, 'Homestay', 200, '[Ubah huraian kemudahan homestay dalam database]', 'Sesuai untuk keluarga besar dan mempuyai ruang letak kereta.', 'Homestay yang selesa dan mesra ini menawarkan pengalaman penginapan yang unik dan berpatutan. Terletak di kawasan yang tenang, homestay ini menyediakan bilik-bilik yang bersih dan kemas, serta kemudahan asas seperti dapur, bilik mandi, dan ruang tamu bersama. Nikmati suasana seperti berada di rumah sendiri, sambil berinteraksi dengan tuan rumah yang ramah dan membantu.', 2, NULL),
(31, 'Red Room', 1, '1', 1, '1', '1', '1', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bilik_kemudahan`
--

CREATE TABLE `bilik_kemudahan` (
  `id_bilik_kemudahan` int(11) NOT NULL,
  `id_bilik` int(11) DEFAULT NULL,
  `id_kemudahan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bilik_kemudahan`
--

INSERT INTO `bilik_kemudahan` (`id_bilik_kemudahan`, `id_bilik`, `id_kemudahan`) VALUES
(106, 1, 1),
(107, 1, 3),
(108, 1, 4),
(109, 1, 6),
(110, 1, 7),
(111, 1, 11),
(114, 2, 4),
(115, 2, 5),
(116, 3, 1),
(117, 3, 5),
(118, 3, 11),
(119, 31, 7);

-- --------------------------------------------------------

--
-- Table structure for table `dewan`
--

CREATE TABLE `dewan` (
  `id_dewan` int(11) NOT NULL,
  `nama_dewan` varchar(50) DEFAULT NULL,
  `kadar_sewa` decimal(10,2) DEFAULT NULL,
  `bilangan_muatan` int(11) DEFAULT NULL,
  `penerangan` varchar(550) DEFAULT NULL,
  `penerangan_ringkas` varchar(250) DEFAULT NULL,
  `penerangan_kemudahan` varchar(250) DEFAULT NULL,
  `status_dewan` enum('Tersedia','Tidak Tersedia') DEFAULT NULL,
  `max_capacity` int(11) DEFAULT NULL,
  `mula_tidak_tersedia` datetime DEFAULT NULL,
  `tamat_tidak_tersedia` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dewan`
--

INSERT INTO `dewan` (`id_dewan`, `nama_dewan`, `kadar_sewa`, `bilangan_muatan`, `penerangan`, `penerangan_ringkas`, `penerangan_kemudahan`, `status_dewan`, `max_capacity`, `mula_tidak_tersedia`, `tamat_tidak_tersedia`) VALUES
(16, 'Dewan Jubli', 500.00, 250, 'Dewan Jubli adalah sebuah dewan yang luas dan moden, direka khas untuk memenuhi keperluan pelbagai jenis acara besar dan kecil. Dengan ruang yang selesa dan suasana yang elegan, dewan ini mampu menampung jumlah tetamu yang besar, menjadikannya pilihan utama untuk pelbagai majlis, seperti perkahwinan, seminar, atau penganjuran acara rasmi. ', 'Dewan Jubli adalah dewan moden dan luas, ideal untuk pelbagai acara besar dan kecil.', 'Dewan Jubli memberikan kemudahan yang sesuai untuk digunakan.', 'Tersedia', 1, NULL, NULL),
(17, 'Dewan Fiber', 350.00, 250, 'Dewan Fiber adalah sebuah dewan yang luas dan moden, direka khas untuk memenuhi keperluan pelbagai jenis acara besar dan kecil. Dengan ruang yang selesa dan suasana yang elegan, dewan ini mampu menampung jumlah tetamu yang besar, menjadikannya pilihan utama untuk pelbagai majlis, seperti perkahwinan, seminar, atau penganjuran acara rasmi. ', 'Dewan Fiber adalah dewan moden dan luas, ideal untuk pelbagai acara besar dan kecil.', 'Dewan Fiber memberikan kemudahan yang sesuai untuk digunakan.', 'Tersedia', 1, NULL, NULL),
(18, 'Dewan Kuliah Kenaf', 200.00, 40, 'Dewan Kuliah Kenaf adalah sebuah dewan yang luas dan moden, direka khas untuk memenuhi keperluan pelbagai jenis acara besar dan kecil. Dengan ruang yang selesa dan suasana yang elegan, dewan ini mampu menampung jumlah tetamu yang besar, menjadikannya pilihan utama untuk pelbagai majlis, seperti perkahwinan, seminar, atau penganjuran acara rasmi. ', 'Dewan Kuliah Kenaf adalah dewan moden dan luas, ideal untuk pelbagai acara besar dan kecil.', 'Dewan Kuliah Kenaf memberikan kemudahan yang sesuai untuk digunakan.', 'Tersedia', 1, NULL, NULL),
(21, 'Dewan emas', 33.00, 33, 'enerangan', 'enerangan', 'enerangan', 'Tersedia', 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dewan_kemudahan`
--

CREATE TABLE `dewan_kemudahan` (
  `id_dewan_kemudahan` int(11) NOT NULL,
  `id_dewan` int(11) DEFAULT NULL,
  `id_kemudahan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dewan_kemudahan`
--

INSERT INTO `dewan_kemudahan` (`id_dewan_kemudahan`, `id_dewan`, `id_kemudahan`) VALUES
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
(90, 17, 7),
(93, 21, 4),
(97, 16, 1),
(98, 16, 5),
(99, 16, 7);

-- --------------------------------------------------------

--
-- Table structure for table `dewan_pic`
--

CREATE TABLE `dewan_pic` (
  `id_gambar` int(11) NOT NULL,
  `jenis_gambar` varchar(50) DEFAULT NULL,
  `url_gambar` text DEFAULT NULL,
  `id_dewan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dewan_pic`
--

INSERT INTO `dewan_pic` (`id_gambar`, `jenis_gambar`, `url_gambar`, `id_dewan`) VALUES
(79, 'Utama', 'assets/images/resource/1733330168_dewan.webp', 16),
(80, 'Banner', 'assets/images/background/1733330168_dewanJubli1.png', 16),
(81, 'Tambahan', 'assets/images/resource/1733330168_0_dewanJubli2.png', 16),
(82, 'Utama', 'assets/images/resource/67593f205c6f5.png', 17),
(83, 'Banner', 'assets/images/background/67593f55abe02.jpeg', 17),
(84, 'Tambahan', 'assets/images/resource/67593f696e596.png', 17),
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
(95, 'Tambahan', 'assets/images/resource/1733616923_1_kemPelajar1.jpg', 20),
(96, 'Utama', 'assets/images/resource/1733906625_wed.png', 21),
(97, 'Banner', 'assets/images/background/1733906625_pic1.png', 21),
(98, 'Tambahan', 'assets/images/resource/1733906625_0_pic2.png', 21);

-- --------------------------------------------------------

--
-- Table structure for table `kemudahan`
--

CREATE TABLE `kemudahan` (
  `id_kemudahan` int(11) NOT NULL,
  `nama` varchar(25) DEFAULT NULL,
  `icon_url` varchar(100) DEFAULT NULL
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
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `pid` int(11) NOT NULL,
  `rsp_appln_id` varchar(3) NOT NULL,
  `rsp_org_id` varchar(10) NOT NULL,
  `rsp_orderid` varchar(20) DEFAULT NULL,
  `rsp_amount` decimal(8,2) NOT NULL,
  `rsp_trxstatus` varchar(15) NOT NULL,
  `rsp_stcode` varchar(3) NOT NULL,
  `rsp_bankid` varchar(15) NOT NULL,
  `rsp_bankname` varchar(50) DEFAULT NULL,
  `rsp_fpxid` varchar(30) NOT NULL,
  `rsp_fpxorderno` varchar(30) NOT NULL,
  `date_created` datetime DEFAULT current_timestamp(),
  `type` int(11) NOT NULL DEFAULT 0 COMMENT '0 = fpx, 1 = cek, 2 = cash, 3 = EFT, 4= Kad',
  `doc` text DEFAULT NULL,
  `tarikh_cek` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `perkahwinan`
--

CREATE TABLE `perkahwinan` (
  `id_perkahwinan` int(11) NOT NULL,
  `nama_pekej_kahwin` varchar(255) DEFAULT NULL,
  `harga_pekej` decimal(10,2) DEFAULT NULL,
  `huraian` text DEFAULT NULL,
  `huraian_pendek` text DEFAULT NULL,
  `id_dewan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `perkahwinan`
--

INSERT INTO `perkahwinan` (`id_perkahwinan`, `nama_pekej_kahwin`, `harga_pekej`, `huraian`, `huraian_pendek`, `id_dewan`) VALUES
(11, 'Raikan Cinta - Dewan Fiber', 60000.00, 'Penerangan PanjangPenerangan PanjangPenerangan PanjangPenerangan Panjang', 'Penerangan Pendek', 17),
(22, 'Raikan Cinta - Dewan Emas', 2000.00, 'Penerangan Panjangg', 'Penerangan Pendek', 21);

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
(145, 'ROOM-241212-189', 'WAN MUHAMMAD NAQIB ZAFRAN WAN ROSLAN', '0184028240', 'wannaqib01@gmail.com', 1, '2024-12-12 15:04:29', '2024-12-12', '2024-12-13', 150, 'FPX', NULL, 2, NULL, NULL, NULL),
(146, 'ROOM-241215-919', 'WAN MUHAMMAD NAQIB ZAFRAN WAN ROSLAN', '0184028240', 'wannaqib01@gmail.com', 1, '2024-12-15 10:46:50', '2024-12-15', '2024-12-16', 150, 'FPX', NULL, 2, NULL, NULL, NULL),
(149, 'ROOM-241215-737', 'WAN MUHAMMAD NAQIB ZAFRAN WAN ROSLAN', '0184028240', 'wannaqib01@gmail.com', 1, '2024-12-15 17:22:19', '2024-12-15', '2024-12-16', 68, 'FPX', NULL, 1, NULL, NULL, NULL),
(155, 'WED-2024-12-19-5722', 'WAN MUHAMMAD NAQIB ZAFRAN WAN ROSLAN', '0184028240', 'wannaqib01@gmail.com', 50, '2024-12-19 09:51:57', '2024-12-19', '2024-12-20', 60008, 'FPX', NULL, NULL, 17, 11, NULL),
(156, 'ROOM-241219-961', 'WAN MUHAMMAD NAQIB ZAFRAN WAN ROSLAN', '0184028240', 'wannaqib01@gmail.com', 1, '2024-12-19 15:04:14', '2024-12-19', '2024-12-20', 150, 'FPX', NULL, 2, NULL, NULL, NULL),
(157, 'ROOM-241222-694', 'WAN MUHAMMAD NAQIB ZAFRAN WAN ROSLAN', '0184028240', 'wannaqib01@gmail.com', 2, '2024-12-22 09:26:26', '1970-01-01', '1970-01-01', 0, 'FPX', NULL, 2, NULL, NULL, NULL),
(158, 'ROOM-241222-208', 'WAN MUHAMMAD NAQIB ZAFRAN WAN ROSLAN', '0184028240', 'wannaqib01@gmail.com', 1, '2024-12-22 09:43:28', '2024-12-22', '2024-12-23', 150, 'FPX', NULL, 2, NULL, NULL, NULL),
(159, 'ROOM-241222-106', 'AN ROSLAN', '0184028240', 'wannaqib01@gmail.com', 2, '2024-12-22 15:50:48', '2024-12-24', '2024-12-25', 300, 'FPX', NULL, 2, NULL, NULL, NULL),
(163, 'ROOM-241223-833', 'WAN MUHAMMAD NAQIB ZAFRAN WAN ROSLAN', '0184028240', 'wannaqib01@gmail.com', 1, '2024-12-23 11:55:38', '2024-12-24', '2024-12-25', 200, 'FPX', NULL, 3, NULL, NULL, NULL),
(165, 'ROOM-241223-205', 'WAN MUHAMMAD NAQIB ZAFRAN WAN ROSLAN', '0184028240', 'wannaqib01@gmail.com', 1, '2024-12-23 16:33:23', '2024-12-23', '2024-12-24', 1, 'FPX', NULL, 31, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tempahan_perkahwinan_addons`
--

CREATE TABLE `tempahan_perkahwinan_addons` (
  `id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `add_on_id` int(11) DEFAULT NULL,
  `id_tempahan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tempahan_perkahwinan_addons`
--

INSERT INTO `tempahan_perkahwinan_addons` (`id`, `quantity`, `add_on_id`, `id_tempahan`) VALUES
(48, 1, 2, 155);

-- --------------------------------------------------------

--
-- Table structure for table `unit_bilik`
--

CREATE TABLE `unit_bilik` (
  `id_ub` int(11) NOT NULL,
  `nombor_bilik` varchar(20) DEFAULT NULL,
  `aras` int(11) DEFAULT NULL,
  `status_bilik` enum('aktif','tak aktif','penyelenggaraan','') DEFAULT 'aktif',
  `tarikh_aktif_semula` date DEFAULT NULL,
  `id_bilik` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unit_bilik`
--

INSERT INTO `unit_bilik` (`id_ub`, `nombor_bilik`, `aras`, `status_bilik`, `tarikh_aktif_semula`, `id_bilik`) VALUES
(19, 'BB001', 2, 'aktif', NULL, 1),
(20, 'BB002', 3, 'aktif', '0000-00-00', 1),
(21, 'BB003', 2, 'aktif', '0000-00-00', 1),
(22, 'BB004', 2, 'aktif', '0000-00-00', 1),
(23, 'BB005', 3, 'aktif', '0000-00-00', 1),
(25, 'Home001', 1, 'aktif', '0000-00-00', 3),
(33, 'Homestay 2', 1, 'aktif', '0000-00-00', 3),
(37, '1', 1, 'aktif', '0000-00-00', 2),
(38, 'test', 3, 'aktif', '0000-00-00', 2),
(40, '1', 1, 'aktif', NULL, 31);

-- --------------------------------------------------------

--
-- Table structure for table `url_gambar`
--

CREATE TABLE `url_gambar` (
  `id_gambar` int(10) NOT NULL,
  `jenis_gambar` enum('main','banner','add','') DEFAULT NULL,
  `url_gambar` text DEFAULT NULL,
  `id_bilik` int(10) DEFAULT NULL,
  `id_perkahwinan` int(10) DEFAULT NULL,
  `id_dewan` int(11) DEFAULT NULL,
  `id_aktiviti` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `url_gambar`
--

INSERT INTO `url_gambar` (`id_gambar`, `jenis_gambar`, `url_gambar`, `id_bilik`, `id_perkahwinan`, `id_dewan`, `id_aktiviti`) VALUES
(1, 'main', 'assets/images/resource/dalambilik-scaled.jpg', 1, NULL, NULL, NULL),
(3, 'main', 'assets/images/resource/room-3_homestay.jpg', 3, NULL, NULL, NULL),
(4, 'banner', 'assets/images/background/dalambilik-scaled.jpg', 1, NULL, NULL, NULL),
(6, 'banner', 'assets/images/background/page-title-6_homestay.jpg', 3, NULL, NULL, NULL),
(10, 'add', 'assets/images/resource/room-1_bathroom.jpg', 1, NULL, NULL, NULL),
(50, 'add', 'assets/images/resource/homestay_patio.jpg', 3, NULL, NULL, NULL),
(51, 'add', 'assets/images/resource/homestay_swimming.jpg', 3, NULL, NULL, NULL),
(67, 'add', 'assets/images/resource/living-room-1.jpg', 1, NULL, NULL, NULL),
(113, 'main', 'assets/images/resource/pic1.png', 2, NULL, NULL, NULL),
(114, 'banner', 'assets/images/background/pic3.png', 2, NULL, NULL, NULL),
(146, 'banner', 'assets/images/background/ck-yeo-5J6VUR6r9Wc-unsplash.jpg', NULL, 22, NULL, NULL),
(147, 'main', 'assets/images/resource/Picture2.png', NULL, 22, NULL, NULL),
(148, 'main', 'assets/images/resource/GLOQjWFWgAAK0Zz.jpeg', NULL, 11, NULL, NULL),
(149, 'banner', 'assets/images/background/Picture7.png', NULL, 11, NULL, NULL),
(150, 'main', 'assets/images/resource/6760fd4e628c1.png', NULL, NULL, 16, NULL),
(151, 'banner', 'assets/images/background/6760e33e3e372.png', NULL, NULL, 16, NULL),
(152, 'add', 'assets/images/resource/1734402186_0_dewanJubli2.png', NULL, NULL, 16, NULL),
(153, 'main', 'assets/images/resource/1734403768_lovepik-round-table-meeting-room-picture_501573902.jpg', NULL, NULL, 17, NULL),
(154, 'banner', 'assets/images/background/1734403768_pngtree-empty-classroom-board-meeting-academic-photo-image_43102854.jpg', NULL, NULL, 17, NULL),
(155, 'add', 'assets/images/resource/1734403768_0_lovepik-conference-hall-picture_500680046.jpg', NULL, NULL, 17, NULL),
(156, 'main', 'assets/images/resource/1734403893_dewan_kuliah1.jpg', NULL, NULL, 18, NULL),
(157, 'banner', 'assets/images/background/1734403893_dewan_kuliah2.jpg', NULL, NULL, 18, NULL),
(158, 'add', 'assets/images/resource/1734403893_0_dewan_kuliah1.jpg', NULL, NULL, 18, NULL),
(179, 'add', 'assets/images/resource/99.jpg', 2, NULL, NULL, NULL),
(187, 'add', 'assets/images/resource/FJIV3174.JPG', NULL, 22, NULL, NULL),
(188, 'add', 'assets/images/resource/FVQU1460.JPG', NULL, 22, NULL, NULL),
(189, 'main', 'assets/images/resource/pngtree-simple-ketupat-kartun-cartoon-vector-illustration-png-image_4526275.png', 31, NULL, NULL, NULL),
(190, 'banner', 'assets/images/background/png-clipart-ketupat.png', 31, NULL, NULL, NULL),
(191, 'add', 'assets/images/resource/poster raya 2.jpg', 31, NULL, NULL, NULL),
(192, 'main', 'assets/images/resource/6769a99943ea1.jpg', NULL, NULL, NULL, 26),
(193, 'banner', 'assets/images/background/1734977863_kemPelajar2.jpg', NULL, NULL, NULL, 26),
(194, 'add', 'assets/images/resource/1734977863_0_kemPelajar3.jpg', NULL, NULL, NULL, 26),
(195, 'main', 'assets/images/resource/1734977908_teamBuilding1.jpg', NULL, NULL, NULL, 27),
(196, 'banner', 'assets/images/background/1734977908_teamBuilding2.jpg', NULL, NULL, NULL, 27),
(197, 'add', 'assets/images/resource/1734977908_0_teamBuilding3.jpg', NULL, NULL, NULL, 27);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uid` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_add` datetime NOT NULL,
  `role` enum('admin','kewangan','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `username`, `password_hash`, `email`, `created_at`, `updated_add`, `role`) VALUES
(1, 'admin', '$2y$10$qvPruaabaCaJIhMhl7i/ie1BnJZIKkP5Li8fYZ/xOV08dcFnBD4o6', 'adminLKTN@gmail.com', '2024-12-18 01:41:27', '2024-12-18 01:41:27', 'admin'),
(2, 'kewangan', '$2a$12$EUp4df/wpMI02C9.ed9zA.Zwu.rQ1uWk8K86Nz002/TE1CtPAqYka', 'lktn@gmail.com', '2024-12-18 04:36:53', '2024-12-18 04:36:53', 'kewangan');

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
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `rsp_orderid` (`rsp_orderid`);

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
-- Indexes for table `unit_bilik`
--
ALTER TABLE `unit_bilik`
  ADD PRIMARY KEY (`id_ub`),
  ADD KEY `id_bilik` (`id_bilik`);

--
-- Indexes for table `url_gambar`
--
ALTER TABLE `url_gambar`
  ADD PRIMARY KEY (`id_gambar`),
  ADD KEY `room_id` (`id_bilik`),
  ADD KEY `id_perkahwinan` (`id_perkahwinan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_on_perkahwinan`
--
ALTER TABLE `add_on_perkahwinan`
  MODIFY `add_on_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `aktiviti`
--
ALTER TABLE `aktiviti`
  MODIFY `id_aktiviti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `aktiviti_kemudahan`
--
ALTER TABLE `aktiviti_kemudahan`
  MODIFY `id_aktiviti_kemudahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `aktiviti_pic`
--
ALTER TABLE `aktiviti_pic`
  MODIFY `id_gambar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `bilik`
--
ALTER TABLE `bilik`
  MODIFY `id_bilik` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `bilik_kemudahan`
--
ALTER TABLE `bilik_kemudahan`
  MODIFY `id_bilik_kemudahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `dewan`
--
ALTER TABLE `dewan`
  MODIFY `id_dewan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `dewan_kemudahan`
--
ALTER TABLE `dewan_kemudahan`
  MODIFY `id_dewan_kemudahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `dewan_pic`
--
ALTER TABLE `dewan_pic`
  MODIFY `id_gambar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `kemudahan`
--
ALTER TABLE `kemudahan`
  MODIFY `id_kemudahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5484;

--
-- AUTO_INCREMENT for table `perkahwinan`
--
ALTER TABLE `perkahwinan`
  MODIFY `id_perkahwinan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tempahan`
--
ALTER TABLE `tempahan`
  MODIFY `id_tempahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT for table `tempahan_perkahwinan_addons`
--
ALTER TABLE `tempahan_perkahwinan_addons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `unit_bilik`
--
ALTER TABLE `unit_bilik`
  MODIFY `id_ub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `url_gambar`
--
ALTER TABLE `url_gambar`
  MODIFY `id_gambar` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- Constraints for table `perkahwinan`
--
ALTER TABLE `perkahwinan`
  ADD CONSTRAINT `perkahwinan_ibfk_1` FOREIGN KEY (`id_dewan`) REFERENCES `dewan` (`id_dewan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tempahan`
--
ALTER TABLE `tempahan`
  ADD CONSTRAINT `Delete Restriction ` FOREIGN KEY (`id_bilik`) REFERENCES `bilik` (`id_bilik`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Delete Restriction Kahwin` FOREIGN KEY (`id_perkahwinan`) REFERENCES `perkahwinan` (`id_perkahwinan`) ON UPDATE CASCADE;

--
-- Constraints for table `tempahan_perkahwinan_addons`
--
ALTER TABLE `tempahan_perkahwinan_addons`
  ADD CONSTRAINT `tempahan_perkahwinan_addons_ibfk_1` FOREIGN KEY (`id_tempahan`) REFERENCES `tempahan` (`id_tempahan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tempahan_perkahwinan_addons_ibfk_2` FOREIGN KEY (`add_on_id`) REFERENCES `add_on_perkahwinan` (`add_on_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `unit_bilik`
--
ALTER TABLE `unit_bilik`
  ADD CONSTRAINT `unit_bilik_ibfk_1` FOREIGN KEY (`id_bilik`) REFERENCES `bilik` (`id_bilik`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `url_gambar`
--
ALTER TABLE `url_gambar`
  ADD CONSTRAINT `url_gambar_ibfk_1` FOREIGN KEY (`id_bilik`) REFERENCES `bilik` (`id_bilik`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `url_gambar_ibfk_2` FOREIGN KEY (`id_perkahwinan`) REFERENCES `perkahwinan` (`id_perkahwinan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
