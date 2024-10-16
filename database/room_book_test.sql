-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2024 at 04:51 AM
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
-- Database: `room_book_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` int(10) NOT NULL,
  `room_name` varchar(255) NOT NULL,
  `capacity` int(10) NOT NULL,
  `room_type` varchar(255) NOT NULL,
  `price_per_day` float NOT NULL,
  `available_status` tinyint(1) NOT NULL,
  `discription` text NOT NULL,
  `size` int(11) NOT NULL,
  `img_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `room_name`, `capacity`, `room_type`, `price_per_day`, `available_status`, `discription`, `size`, `img_id`) VALUES
(1, 'Bilik Biasa', 2, 'room', 70, 1, 'Bilik yang selesa dan terang ini kini tersedia untuk disewa di kawasan kejiranan yang aman. Sesuai untuk individu bujang atau pelajar, bilik ini menawarkan katil yang selesa, cahaya semula jadi yang mencukupi, almari pakaian terbina dalam, dan akses ke kemudahan bilik mandi dan dapur bersama. Sewa termasuk utiliti asas dan lokasinya berada di kawasan yang tenang dan selamat.', 50, 1),
(2, 'Bilik VIP', 2, 'room', 70, 1, 'Bilik VIP yang mewah dan luas ini terletak di kawasan kejiranan berprestij. Sesuai untuk mereka yang mencari pengalaman hidup mewah, bilik ini menawarkan katil bersaiz king, bilik mandi peribadi dengan kelengkapan berkualiti tinggi, pemandangan panorama dari balkoni peribadi, dapur kecil yang lengkap dengan peralatan moden, akses ke kemudahan eksklusif seperti kolam renang, gimnasium, dan keselamatan 24 jam, serta lokasi utama dengan akses mudah ke pengangkutan dan kemudahan lain.\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n', 100, 0),
(3, 'INSKET Homestay', 8, 'house', 200, 1, 'Homestay yang selesa dan mesra ini menawarkan pengalaman penginapan yang unik dan berpatutan. Terletak di kawasan yang tenang, homestay ini menyediakan bilik-bilik yang bersih dan kemas, serta kemudahan asas seperti dapur, bilik mandi, dan ruang tamu bersama. Nikmati suasana seperti berada di rumah sendiri, sambil berinteraksi dengan tuan rumah yang ramah dan membantu.', 450, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`),
  ADD UNIQUE KEY `img_id` (`img_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
