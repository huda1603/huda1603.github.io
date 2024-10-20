-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 20, 2024 at 09:17 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbformkursus`
--

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nomor_telepon` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `tingkat_kursus` varchar(8) COLLATE utf8mb4_general_ci NOT NULL,
  `metode_pembayaran` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `foto_pengguna` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `nama`, `tanggal_lahir`, `alamat`, `nomor_telepon`, `email`, `tingkat_kursus`, `metode_pembayaran`, `foto_pengguna`) VALUES
(2, 'Ahmad Nur Huda', '2005-07-16', 'Jalan Suryanata', '085751991314', 'anhhuda1603@gmai.com', 'menengah', 'Gopay', '20-10-2024-Screenshot 2024-10-10 155129.png'),
(4, 'huda', '2024-10-01', 'JHH', '085751991314', 'Huda1603@gmail.com', 'lanjutan', 'BNI', ''),
(5, 'Hudaa', '2024-10-07', 'jalan myamin', '085751991314', 'Huda1603@gmail.com', 'menengah', 'OVO', ''),
(6, 'hhhhgh', '2024-10-08', 'guguu', '00000', 'Huda1603@gmail.com', 'menengah', 'BNI', '20-10-2024-Man1.jpeg'),
(7, 'huda', '2024-10-21', '8', 'kdksa3232', 'Huda1603@gmail.com', 'menengah', 'BCA', '20-10-24-cross join.png');

-- --------------------------------------------------------

--
-- Table structure for table `user_terdaftar`
--

CREATE TABLE `user_terdaftar` (
  `id_user` int NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kata_sandi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `posisi` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_terdaftar`
--

INSERT INTO `user_terdaftar` (`id_user`, `username`, `kata_sandi`, `posisi`) VALUES
(1, 'Huda', '$2y$10$ti0UL.Skb8Z9GM3TLczBauk6ZO.o4jtJIWvjY0ytQpkNTZr20jaMC', 'User'),
(2, 'Prik', '$2y$10$0tcrNTnY5z7gTJ5kU5U4XeGhRGAXjVedppEo5FkSIR4GWrOhbxw0K', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indexes for table `user_terdaftar`
--
ALTER TABLE `user_terdaftar`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_terdaftar`
--
ALTER TABLE `user_terdaftar`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
