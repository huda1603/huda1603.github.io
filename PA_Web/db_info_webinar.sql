-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Nov 06, 2024 at 02:05 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_info_webinar`
--

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `id_komentar` varchar(10) NOT NULL,
  `komentar` varchar(100) NOT NULL,
  `id_webinar` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `nama_panggilan` varchar(15) NOT NULL,
  `tempat_lahir` varchar(15) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `kata_sandi` varchar(255) NOT NULL,
  `role` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_lengkap`, `nama_panggilan`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `username`, `kata_sandi`, `role`) VALUES
(2, 'UdaCuy', 'uda', 'Samarinda', '2024-10-17', 'laki_laki', 'udaa', '$2y$10$7dZS2e03o8qRFMwQxQKpseRkMTIPJHJX9OhYpjKhlsa7Sz2.speIC', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `webinar`
--

CREATE TABLE `webinar` (
  `id_webinar` varchar(10) NOT NULL,
  `nama_webinar` varchar(255) NOT NULL,
  `deskripsi` varchar(500) NOT NULL,
  `tautan` varchar(255) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `deadline` date NOT NULL,
  `foto_webinar` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `webinar`
--

INSERT INTO `webinar` (`id_webinar`, `nama_webinar`, `deskripsi`, `tautan`, `tanggal_mulai`, `deadline`, `foto_webinar`, `id_user`) VALUES
('5bEgU9p6SL', 'Bahasa Indonesia Vs Bahasa Slang', 'Bahasa Indonesia', 'http://s.id/daftar-sohibbercerita14', '2024-10-26', '2024-10-26', '26-10-24-WhatsApp Image 2024-10-25 at 20.31.35.jpeg', 2),
('S@J2DqL(VM', 'Mengubah Kecemasan Menjadi Kekuatan', 'Strategi Psikologis Untuk Sukses Dalam Dunia Pendidikan Dan Pekerjaan', 'https://bit.ly/EEC_KesehatanMental_25Okt2024', '2024-10-31', '2024-10-28', '26-10-24-WhatsApp Image 2024-10-24 at 20.35.05.jpeg', 2),
('Y7swGrYOj(', 'Kuasa Bahasa Spanyol Lewat Hiburan', 'Cocok Untuk Yang Ingin Bekerja Di Spanyol', 'https://minartis.com/webinar-bahasa-spanyol/', '2024-10-26', '2024-10-25', '25-10-24-WhatsApp Image 2024-10-24 at 16.59.53.jpeg', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id_komentar`),
  ADD KEY `webinar_ke_komentar` (`id_webinar`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `webinar`
--
ALTER TABLE `webinar`
  ADD PRIMARY KEY (`id_webinar`),
  ADD KEY `relasi_user_ke_webinar` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `webinar_ke_komentar` FOREIGN KEY (`id_webinar`) REFERENCES `webinar` (`id_webinar`) ON DELETE CASCADE;

--
-- Constraints for table `webinar`
--
ALTER TABLE `webinar`
  ADD CONSTRAINT `relasi_user_ke_webinar` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
