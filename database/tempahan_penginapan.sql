-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2024 at 05:47 AM
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
(22, 'Pakej Teambuilding', 99.00, 'Kemudahan dalam pakej teambuilding biasanya dirancang untuk memberikan pengalaman yang menyeluruh, menyeronokkan, dan bermakna kepada peserta.', 'Pakej teambuilding adalah program atau perkhidmatan yang dirancang untuk meningkatkan kerjasama, komunikasi, dan hubungan antara ahli kumpulan, organisasi, atau pasukan. Aktiviti teambuilding sering kali melibatkan pelbagai aktiviti interaktif, permainan, dan latihan yang bertujuan untuk memperkukuhkan semangat kerja berpasukan dan menggalakkan pencapaian matlamat bersama.', 'Tersedia'),
(23, 'Pakej Kem Pelajar', 55.00, 'Kemudahan dalam pakej kem pelajar biasanya merangkumi beberapa elemen yang bertujuan untuk memberikan pengalaman pembelajaran yang bermakna serta menyeronokkan. Kemudahan-kemudahan ini direka untuk memastikan para pelajar dapat menikmati pengalaman yang seimbang antara pembelajaran, rekreasi, dan pembangunan diri dalam suasana yang selamat dan kondusif.', 'Kem pelajar adalah program intensif yang bertujuan untuk mengembangkan potensi pelajar melalui aktiviti yang menyeronokkan, mencabar, dan bermakna. Kem ini biasanya diadakan di lokasi yang jauh dari persekitaran sekolah biasa, seperti kawasan semula jadi, pusat latihan, atau resort, dengan tujuan memberikan suasana baru yang merangsang pembelajaran dan perkembangan diri.', 'Tersedia');

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
(59, 23, 7);

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
(1, 'Bilik biasabiasa', 2, 'Room', 68, 'Datang Dgn tab mandi. dan wifi percuma', 'Sesuai untuk 2 orang. Disediakan dengan penghawa dingin.', 'Bilik yang selesa dan terang ini kini tersedia untuk disewa di kawasan kejiranan yang aman. Sesuai untuk individu bujang atau pelajar, bilik ini menawarkan katil yang selesa, cahaya semula jadi yang mencukupi, almari pakaian terbina dalam, dan akses ke kemudahan bilik mandi dan dapur bersama. Sewa termasuk utiliti asas dan lokasinya berada di kawasan yang tenang dan selamat.', 17, 0),
(2, 'Bilik VIP', 3, 'Suite', 150, '[Ubah huraian kemudahan bilik VIP dalam database]', 'Disediakan dengan 2 katil super single and televisyen.', 'Bilik VIP yang mewah dan luas ini terletak di kawasan kejiranan berprestij. Sesuai untuk mereka yang mencari pengalaman hidup mewah, bilik ini menawarkan katil bersaiz king, bilik mandi peribadi dengan kelengkapan berkualiti tinggi, pemandangan panorama dari balkoni peribadi, dapur kecil yang lengkap dengan peralatan moden, akses ke kemudahan eksklusif seperti kolam renang, gimnasium, dan keselamatan 24 jam, serta lokasi utama dengan akses mudah ke pengangkutan dan kemudahan lain.', 1, NULL),
(3, 'Home Stay INSKET', 8, 'Homestay', 200, '[Ubah huraian kemudahan homestay dalam database]', 'Sesuai untuk keluarga besar dan mempuyai ruang letak kereta.', 'Homestay yang selesa dan mesra ini menawarkan pengalaman penginapan yang unik dan berpatutan. Terletak di kawasan yang tenang, homestay ini menyediakan bilik-bilik yang bersih dan kemas, serta kemudahan asas seperti dapur, bilik mandi, dan ruang tamu bersama. Nikmati suasana seperti berada di rumah sendiri, sambil berinteraksi dengan tuan rumah yang ramah dan membantu.', 1, NULL),
(18, 'Red Room', 2, 'Freaky', 53, '555', '5555', '555', 3, NULL);

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
(85, 2, 5),
(86, 3, 1),
(87, 3, 5),
(88, 3, 11);

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
  `max_capacity` int(11) NOT NULL,
  `mula_tidak_tersedia` datetime DEFAULT NULL,
  `tamat_tidak_tersedia` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dewan`
--

INSERT INTO `dewan` (`id_dewan`, `nama_dewan`, `kadar_sewa`, `bilangan_muatan`, `penerangan`, `penerangan_ringkas`, `penerangan_kemudahan`, `status_dewan`, `max_capacity`, `mula_tidak_tersedia`, `tamat_tidak_tersedia`) VALUES
(25, 'Dewan Jubli', 500.00, 250, 'Dewan ini dilengkapi dengan kemudahan moden dan ruang yang luas bagi menampung bilangan tetamu yang besar. Ia sesuai untuk majlis rasmi dan tidak rasmi. Lokasinya yang strategik memudahkan akses untuk semua tetamu. Selain itu, suasana yang selesa dengan sistem penghawa dingin serta sistem bunyi yang berkualiti memastikan majlis anda berjalan dengan lancar.', 'Dewan Jubli adalah sebuah dewan serbaguna yang sesuai untuk pelbagai acara seperti majlis perkahwinan, mesyuarat, seminar, dan program komuniti.', 'Kemudahan yang Disediakan:', 'Tersedia', 1, NULL, NULL),
(27, 'Dewan Fiber', 350.00, 250, 'Dewan Fiber menawarkan ruang acara yang praktikal dan fleksibel untuk memenuhi keperluan pelbagai jenis majlis. Ia sesuai untuk acara rasmi atau tidak rasmi. Dewan ini dilengkapi dengan kemudahan terkini seperti sistem penghawa dingin penuh, pencahayaan yang baik, dan sistem audio-visual berkualiti tinggi untuk memastikan kelancaran majlis anda. Lokasinya yang strategik serta kemudahan tempat letak kereta yang luas menjadikannya pilihan utama untuk penganjur majlis.', 'Dewan Fiber adalah dewan serbaguna yang moden dan selesa, direka khas untuk majlis kecil hingga sederhana seperti mesyuarat, seminar, bengkel, majlis keraian, dan acara komuniti.', 'Kemudahan yang Disediakan:', 'Tersedia', 1, NULL, NULL),
(28, 'Dewan Kuliah Kenaf', 200.00, 40, 'Dewan Kuliah Kenaf ialah sebuah dewan serbaguna yang dilengkapi dengan kemudahan moden untuk kegunaan kuliah, seminar, mesyuarat, dan acara-acara lain. Dewan ini mempunyai kapasiti yang mencukupi bagi menampung bilangan peserta yang ramai, menjadikannya sesuai untuk pelbagai aktiviti akademik dan sosial.', 'Dewan Kuliah Kenaf ialah sebuah dewan serbaguna yang dilengkapi dengan kemudahan moden untuk kegunaan kuliah, seminar, mesyuarat, dan acara-acara lain.', 'Kemudahan yang Disediakan:', 'Tersedia', 1, NULL, NULL);

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
(90, 17, 7),
(91, 21, 7),
(92, 22, 7),
(94, 24, 1),
(102, 23, 7),
(103, 25, 1),
(104, 25, 5),
(105, 25, 7),
(106, 26, 1),
(107, 26, 5),
(108, 26, 7),
(112, 28, 1),
(113, 28, 7),
(118, 27, 1),
(119, 27, 5),
(120, 27, 7);

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
(86, 'ROOM-241204-750', 'WAN MUHAMMAD NAQIB ZAFRAN WAN ROSLAN', '0184028240', 'wannaqib01@gmail.com', 5, '2024-12-04 09:56:49', '2024-12-04', '2024-12-05', 340, 'LO', NULL, 1, NULL, NULL, NULL),
(87, 'ROOM-241204-349', 'nurul atikah', '0108376005', 'atikah9w2ser@GMAIL.COM', 1, '2024-12-04 12:14:49', '2024-12-04', '2024-12-05', 150, 'FPX', NULL, 2, NULL, NULL, NULL),
(92, 'ROOM-241204-421', 'rqgrgqwrcxbfzbddb', '0108376005', 'EMAIL@GMAIL.COM', 1, '2024-12-04 12:26:26', '2024-12-28', '2024-12-29', 150, 'LO', NULL, 2, NULL, NULL, NULL),
(96, 'ROOM-241204-788', 'nurul', '0075474352', 'nurul@GMAIL.COM', 1, '2024-12-04 12:43:37', '2024-12-31', '2025-01-01', 150, '', NULL, 2, NULL, NULL, NULL),
(98, 'ROOM-241204-113', 'nurul', '0075474352', 'nurul@GMAIL.COM', 1, '2024-12-04 12:44:35', '2024-12-31', '2025-01-01', 150, 'Tunai', NULL, 2, NULL, NULL, NULL),
(100, 'ROOM-241204-560', 'NURUL ATIKAH BINTI MOHD NASIR', '0108376005', 'atikah9w2ser@GMAIL.COM', 1, '2024-12-04 12:46:20', '2024-12-22', '2024-12-23', 150, 'Bank Transfer', NULL, 2, NULL, NULL, NULL),
(102, 'ROOM-241204-422', 'rqgrgqwrcxbfzbddb', '0108376005', 'nurul@GMAIL.COM', 1, '2024-12-04 12:47:28', '2024-12-25', '2024-12-26', 200, 'Tunai', NULL, 3, NULL, NULL, NULL),
(110, 'ROOM-241205-364', 'NADIA', '0189042908', 'ndiantsya92@gmail.com', 1, '2024-12-05 10:21:49', '2024-12-05', '2024-12-06', 200, 'FPX', NULL, 3, NULL, NULL, NULL),
(111, 'ROOM-241205-669', 'NIK', '0189042908', 'nik92@gmail.com', 1, '2024-12-05 10:22:52', '2024-12-31', '2025-01-01', 200, 'FPX', NULL, 3, NULL, NULL, NULL),
(114, 'ROOM-241206-636', 'NADIA', '0189042908', 'ndiantsya92@gmail.com', 1, '2024-12-06 13:33:23', '2024-12-18', '2024-12-19', 68, 'FPX', NULL, 1, NULL, NULL, NULL),
(115, 'ROOM-241206-552', 'nadddddddv', '0189042908', 'ndiantsya92@gmail.com', 1, '2024-12-06 13:48:29', '2025-01-10', '2025-01-11', 68, 'FPX', NULL, 1, NULL, NULL, NULL),
(116, 'ROOM-241206-501', 'errerrrrrrrrr', '0189042908', 'ndiantsya92@gmail.com', 1, '2024-12-06 13:48:52', '2024-12-18', '2024-12-19', 68, 'FPX', NULL, 1, NULL, NULL, NULL),
(117, 'ROOM-241206-896', 'errerrrrrrrrr', '0189042908', 'ndiantsya92@gmail.com', 1, '2024-12-06 13:49:11', '2024-12-18', '2024-12-19', 68, 'FPX', NULL, 1, NULL, NULL, NULL),
(118, 'ROOM-241206-309', 'nadddddddv', '0189042908', 'ndiantsya92@gmail.com', 1, '2024-12-06 17:07:51', '2024-12-19', '2024-12-20', 68, 'FPX', NULL, 1, NULL, NULL, NULL),
(141, 'AKTIVITI-241208-988', 'NIK NADIA', '0189042908', 'niknadia@gmail.com', NULL, '2024-12-08 11:55:02', '2024-12-08', '2024-12-09', 4950, 'FPX', NULL, NULL, NULL, NULL, 22),
(143, 'ROOM-241208-511', 'OSLAN', '0184028240', 'wannaqib01@gmail.com', 4, '2024-12-08 12:27:12', '2024-12-08', '2024-12-09', 272, '', NULL, 1, NULL, NULL, NULL),
(145, 'ROOM-241211-353', 'WAN', '0184028240', 'wannaqib01@gmail.com', 1, '2024-12-11 10:45:07', '2024-12-11', '2024-12-12', 150, 'FPX', NULL, 2, NULL, NULL, NULL),
(146, 'DEWAN-241217-225', 'NURUL ATIKAH BINTI MOHD NASIR', '0108376005', 'atikah9w2ser@GMAIL.COM', 0, '2024-12-17 12:11:25', '2024-12-17', '2024-12-18', 350, 'Tunai', NULL, NULL, 27, NULL, NULL),
(147, 'DEWAN-241217-562', 'MOHD AMIN', '0123456789', 'amin@gmail.com', 0, '2024-12-17 12:15:10', '2024-12-26', '2024-12-29', 1050, 'Bank Transfer', NULL, NULL, 27, NULL, NULL),
(148, 'DEWAN-241217-204', 'NURUL ATIKAH BINTI MOHD NASIR', '0108376005', 'atikah9w2ser@gmail.com', 0, '2024-12-17 12:16:47', '2024-12-17', '2024-12-18', 500, 'Tunai', NULL, NULL, 25, NULL, NULL);

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
  `id_dewan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `url_gambar`
--

INSERT INTO `url_gambar` (`id_gambar`, `jenis_gambar`, `url_gambar`, `id_bilik`, `id_perkahwinan`, `id_dewan`) VALUES
(1, 'main', 'assets/images/resource/dalambilik-scaled.jpg', 1, NULL, NULL),
(2, 'main', 'assets/images/resource/room-2_VIP.jpg', 2, NULL, NULL),
(3, 'main', 'assets/images/resource/room-3_homestay.jpg', 3, NULL, NULL),
(4, 'banner', 'assets/images/background/dalambilik-scaled.jpg', 1, NULL, NULL),
(5, 'banner', 'assets/images/background/page-title-5_VIP.jpeg', 2, NULL, NULL),
(6, 'banner', 'assets/images/background/page-title-6_homestay.jpg', 3, NULL, NULL),
(10, 'add', 'assets/images/resource/room-1_bathroom.jpg', 1, NULL, NULL),
(50, 'add', 'assets/images/resource/homestay_patio.jpg', 3, NULL, NULL),
(51, 'add', 'assets/images/resource/homestay_swimming.jpg', 3, NULL, NULL),
(52, 'add', 'assets/images/resource/dewanJubli.jpg', 2, NULL, NULL),
(67, 'add', 'assets/images/resource/living-room-1.jpg', 1, NULL, NULL),
(71, 'add', 'assets/images/resource/annie-spratt-4Hpljf9Y1ko-unsplash.jpg', 3, NULL, NULL),
(73, 'main', 'assets/images/resource/cc225250-d380-489c-8e98-b5c8422aa689.png', 16, NULL, NULL),
(74, 'banner', 'assets/images/background/cc225250-d380-489c-8e98-b5c8422aa689.png', 16, NULL, NULL),
(75, 'add', 'assets/images/resource/cc225250-d380-489c-8e98-b5c8422aa689.png', 16, NULL, NULL),
(114, 'add', 'assets/images/resource/download (4).jpg', 16, NULL, NULL),
(115, 'add', 'assets/images/resource/download (1).jpg', 16, NULL, NULL),
(116, 'add', 'assets/images/resource/download (1).jpg', 16, NULL, NULL),
(117, 'add', 'assets/images/resource/dewan_kuliah1.jpg', 16, NULL, NULL),
(143, 'main', 'assets/images/resource/6760fd4e628c1.png', NULL, NULL, 25),
(144, 'banner', 'assets/images/background/6760e33e3e372.png', NULL, NULL, 25),
(145, 'add', 'assets/images/resource/1734402186_0_dewanJubli2.png', NULL, NULL, 25),
(149, 'main', 'assets/images/resource/1734403768_lovepik-round-table-meeting-room-picture_501573902.jpg', NULL, NULL, 27),
(150, 'banner', 'assets/images/background/1734403768_pngtree-empty-classroom-board-meeting-academic-photo-image_43102854.jpg', NULL, NULL, 27),
(151, 'add', 'assets/images/resource/1734403768_0_lovepik-conference-hall-picture_500680046.jpg', NULL, NULL, 27),
(152, 'main', 'assets/images/resource/1734403893_dewan_kuliah1.jpg', NULL, NULL, 28),
(153, 'banner', 'assets/images/background/1734403893_dewan_kuliah2.jpg', NULL, NULL, 28),
(154, 'add', 'assets/images/resource/1734403893_0_dewan_kuliah1.jpg', NULL, NULL, 28);

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
  ADD KEY `id_perkahwinan` (`id_perkahwinan`),
  ADD KEY `id_dewan` (`id_dewan`);

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
  MODIFY `id_aktiviti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `aktiviti_kemudahan`
--
ALTER TABLE `aktiviti_kemudahan`
  MODIFY `id_aktiviti_kemudahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `aktiviti_pic`
--
ALTER TABLE `aktiviti_pic`
  MODIFY `id_gambar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `bilik`
--
ALTER TABLE `bilik`
  MODIFY `id_bilik` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `bilik_kemudahan`
--
ALTER TABLE `bilik_kemudahan`
  MODIFY `id_bilik_kemudahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `dewan`
--
ALTER TABLE `dewan`
  MODIFY `id_dewan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `dewan_kemudahan`
--
ALTER TABLE `dewan_kemudahan`
  MODIFY `id_dewan_kemudahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `kemudahan`
--
ALTER TABLE `kemudahan`
  MODIFY `id_kemudahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `perkahwinan`
--
ALTER TABLE `perkahwinan`
  MODIFY `id_perkahwinan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tempahan`
--
ALTER TABLE `tempahan`
  MODIFY `id_tempahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `tempahan_perkahwinan_addons`
--
ALTER TABLE `tempahan_perkahwinan_addons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `unit_bilik`
--
ALTER TABLE `unit_bilik`
  MODIFY `id_ub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `url_gambar`
--
ALTER TABLE `url_gambar`
  MODIFY `id_gambar` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

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
-- Constraints for table `unit_bilik`
--
ALTER TABLE `unit_bilik`
  ADD CONSTRAINT `unit_bilik_ibfk_1` FOREIGN KEY (`id_bilik`) REFERENCES `bilik` (`id_bilik`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
