-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2024 at 05:17 AM
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
-- Database: `insket_service`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(11) NOT NULL,
  `full_name` varchar(65) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `booking_date` date NOT NULL,
  `total_price` float NOT NULL,
  `room_id` int(11) NOT NULL,
  `add_on_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` int(10) NOT NULL,
  `room_name` varchar(50) NOT NULL,
  `capacity` int(4) NOT NULL,
  `room_type` varchar(15) NOT NULL,
  `price_per_day` float NOT NULL,
  `short_description` text DEFAULT NULL,
  `long_description` text DEFAULT NULL,
  `size` int(10) NOT NULL,
  `admin_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `room_name`, `capacity`, `room_type`, `price_per_day`, `short_description`, `long_description`, `size`, `admin_id`) VALUES
(1, 'Bilik biasa', 2, 'room', 70, 'Sesuai untuk 2 orang. Disediakan dengan penghawa dingin.', 'Bilik yang selesa dan terang ini kini tersedia untuk disewa di kawasan kejiranan yang aman. Sesuai untuk individu bujang atau pelajar, bilik ini menawarkan katil yang selesa, cahaya semula jadi yang mencukupi, almari pakaian terbina dalam, dan akses ke kemudahan bilik mandi dan dapur bersama. Sewa termasuk utiliti asas dan lokasinya berada di kawasan yang tenang dan selamat.', 50, 0),
(2, 'Bilik VIP', 2, 'room', 150, 'Disediakan dengan 2 katil super single and televisyen.', 'Bilik VIP yang mewah dan luas ini terletak di kawasan kejiranan berprestij. Sesuai untuk mereka yang mencari pengalaman hidup mewah, bilik ini menawarkan katil bersaiz king, bilik mandi peribadi dengan kelengkapan berkualiti tinggi, pemandangan panorama dari balkoni peribadi, dapur kecil yang lengkap dengan peralatan moden, akses ke kemudahan eksklusif seperti kolam renang, gimnasium, dan keselamatan 24 jam, serta lokasi utama dengan akses mudah ke pengangkutan dan kemudahan lain.', 100, NULL),
(3, 'Home Stay INSKET', 8, 'homestay', 200, 'Sesuai untuk keluarga besar dan mempuyai ruang letak kereta.', 'Homestay yang selesa dan mesra ini menawarkan pengalaman penginapan yang unik dan berpatutan. Terletak di kawasan yang tenang, homestay ini menyediakan bilik-bilik yang bersih dan kemas, serta kemudahan asas seperti dapur, bilik mandi, dan ruang tamu bersama. Nikmati suasana seperti berada di rumah sendiri, sambil berinteraksi dengan tuan rumah yang ramah dan membantu.', 450, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `room_img`
--

CREATE TABLE `room_img` (
  `image_id` int(10) NOT NULL,
  `image_type` varchar(50) NOT NULL,
  `image_url` text NOT NULL,
  `room_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_img`
--

INSERT INTO `room_img` (`image_id`, `image_type`, `image_url`, `room_id`) VALUES
(1, 'main', 'assets\\images\\resource\\room-1_normal.jpg', 1),
(2, 'main', 'assets\\images\\resource\\room-2_VIP.jpg', 2),
(3, 'main', 'assets\\images\\resource\\room-3_homestay.jpg', 3),
(4, 'banner', 'assets/images/background/page-title-4_normal.jpg', 1),
(5, 'banner', 'assets/images/background/page-title-5_VIP.jpeg', 2),
(6, 'banner', 'assets/images/background/page-title-6_homestay.jpg', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `add_on_id` (`add_on_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `room_img`
--
ALTER TABLE `room_img`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `room_id` (`room_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `room_img`
--
ALTER TABLE `room_img`
  MODIFY `image_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `room_img`
--
ALTER TABLE `room_img`
  ADD CONSTRAINT `room_img_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
