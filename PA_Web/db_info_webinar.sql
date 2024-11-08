-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Nov 2024 pada 19.00
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.1.25

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
-- Struktur dari tabel `komentar`
--

CREATE TABLE `komentar` (
  `id_komentar` varchar(10) NOT NULL,
  `komentar` varchar(100) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_webinar` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `komentar`
--

INSERT INTO `komentar` (`id_komentar`, `komentar`, `id_user`, `id_webinar`) VALUES
('%LXaqHd!Mj', 'Halo Hudaaaaa', 2, '0ajZJOR5!E');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
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
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama_lengkap`, `nama_panggilan`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `username`, `kata_sandi`, `role`) VALUES
(2, 'UdaCuy', 'uda', 'Samarinda', '2024-10-17', 'laki_laki', 'udaa', '$2y$10$7dZS2e03o8qRFMwQxQKpseRkMTIPJHJX9OhYpjKhlsa7Sz2.speIC', 'User'),
(4, 'giyo', 'giyoaja', 'Samarinda', '2024-11-08', 'laki_laki', 'giyo', '$2y$10$urqBZaawdwGVmxUzMpSkB.75XqaKMTHTBZsdEHbzLbnzemrRlZ4iW', 'User'),
(5, 'otan', 'tan', 'samarinda', '2024-11-12', 'laki_laki', 'tan', '$2y$10$ZHWSYe00TnjT/cCxumktm.WXanDH1hCFW.h2Y2R0IhHL/tpcKr9m6', 'User');

-- --------------------------------------------------------

--
-- Struktur dari tabel `webinar`
--

CREATE TABLE `webinar` (
  `id_webinar` varchar(10) NOT NULL,
  `nama_webinar` varchar(255) NOT NULL,
  `deskripsi` varchar(500) NOT NULL,
  `tautan` varchar(255) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `deadline` date NOT NULL,
  `foto_webinar` varchar(255) NOT NULL,
  `nomor_kontak` varchar(15) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `webinar`
--

INSERT INTO `webinar` (`id_webinar`, `nama_webinar`, `deskripsi`, `tautan`, `tanggal_mulai`, `deadline`, `foto_webinar`, `nomor_kontak`, `id_user`) VALUES
('0ajZJOR5!E', 'Bahasa Indonesia Vs Bahasa Slang', 'Bahasa Indonesia', 'http://s.id/daftar-sohibbercerita14', '2024-11-08', '2024-11-08', '08-11-24-WhatsApp Image 2024-10-25 at 20.31.35.jpeg', '628xxxxxxxx', 2),
('4y0OhDOCjJ', 'Cari Cuan Ala Gen Z', 'Temukan inspirasi dan insight dari kak @vincentliyanto sebagai Managing Partner Abadi Premium Consultant dan kak @puti.adella yang menjadi PIC Program UMKM GO Online tahun 2019-2023 di SohIB Bercerita minggu ini!', 'https://minartis.com/generasi-z-bisa-sukses/', '2024-11-10', '2024-11-09', '08-11-24-WhatsApp Image 2024-11-08 at 17.41.32.jpeg', '628xxxxxxxx', 4),
('f)bbJjtvCH', 'The Myth Of Math', 'Bingung mengajarkan matematika tanpa drama? Bingung bagaimana agar anak tidak kesal saat belajar matematika? Yuk, ikutan webinarnya! ', 'https://minartis.com/matematika-pendekatan-montessori/', '2024-11-08', '2024-11-08', '08-11-24-WhatsApp Image 2024-10-31 at 20.21.04.jpeg', '628xxxxxxx', 2),
('K9aDuN@raI', 'DEFINING SELF-IDENTITY', 'Mengetahui Self-Identity kita sendiri dapat membantu kita mengetahui banyak hal penting, seperti arah kehidupan', 'http://s.id/daftar-sohibbercerita14', '2024-11-08', '2024-11-08', '08-11-24-WhatsApp Image 2024-10-28 at 20.25.15.jpeg', '628xxxxxxx', 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id_komentar`),
  ADD KEY `id_user` (`id_user`,`id_webinar`),
  ADD KEY `id_webinar` (`id_webinar`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `webinar`
--
ALTER TABLE `webinar`
  ADD PRIMARY KEY (`id_webinar`),
  ADD KEY `relasi_user_ke_webinar` (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `user_ke_komentar` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `webinar_ke_komentar` FOREIGN KEY (`id_webinar`) REFERENCES `webinar` (`id_webinar`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `webinar`
--
ALTER TABLE `webinar`
  ADD CONSTRAINT `relasi_user_ke_webinar` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
