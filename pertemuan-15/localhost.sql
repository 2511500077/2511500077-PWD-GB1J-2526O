-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 22 Jan 2026 pada 05.09
-- Versi server: 8.0.30
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pwd2025`
--
CREATE DATABASE IF NOT EXISTS `db_pwd2025` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `db_pwd2025`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_biodata`
--

CREATE TABLE `tbl_biodata` (
  `cid` int NOT NULL,
  `nim` varchar(20) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` varchar(50) DEFAULT NULL,
  `hobi` varchar(100) NOT NULL,
  `pasangan` varchar(100) NOT NULL,
  `pekerjaan` varchar(100) NOT NULL,
  `nama_orang_tua` varchar(100) NOT NULL,
  `nama_kakak` varchar(100) NOT NULL,
  `nama_adik` varchar(100) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `tbl_biodata`
--

INSERT INTO `tbl_biodata` (`cid`, `nim`, `nama_lengkap`, `tempat_lahir`, `tanggal_lahir`, `hobi`, `pasangan`, `pekerjaan`, `nama_orang_tua`, `nama_kakak`, `nama_adik`, `create_at`) VALUES
(4, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', '2026-01-10 20:02:05'),
(5, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', '2026-01-10 20:09:58'),
(6, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', '2026-01-10 20:11:18'),
(7, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', '2026-01-10 20:13:37'),
(8, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', '2026-01-10 20:14:14'),
(10, '2511500077', 'afdal', 'pangkal pinang', '22 juli 2007', 'bermain game', 'tidak ada', 'mahasiswa isb atmaluhur', 'nama ayah rozi sahroni dan ibu harti', 'tidak ada', 'afifah ananda', '2026-01-11 11:05:16'),
(11, 'sawddawdawdwa', 'sawdaawdadw', 'awawdsaw', 'sawdwadawd', 'sdadawawd', 'sawdawd', 'sdwad', 'sawdaw', 'sawda', 'sadwa', '2026-01-11 11:58:06'),
(12, '2511500078', 'julio putrawan', 'Pangkal Pinang', '20 juli 20007', 'bermain game', 'rani', 'mahasiswa isb atmaluhur', 'tidak tahu', 'tidak tahu', 'tidak tahu', '2026-01-11 14:31:55'),
(15, 'awdsadawd', 'awddaw', 'awd', 'awd', 'wadawdawdaw', 'wa', 'dwa', 'dawd', 'awd', 'dawd', '2026-01-11 15:09:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_biodata1`
--

CREATE TABLE `tbl_biodata1` (
  `cid` int NOT NULL,
  `nim` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `nama_lengkap` varchar(50) DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tanggal_lahir` varchar(100) DEFAULT NULL,
  `hobi` varchar(100) NOT NULL,
  `pasangan` varchar(50) NOT NULL,
  `pekerjaan` varchar(50) NOT NULL,
  `nama_orang_tua` varchar(50) NOT NULL,
  `nama_kakak` varchar(50) NOT NULL,
  `nama_adik` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_tamu`
--

CREATE TABLE `tbl_tamu` (
  `cid` int NOT NULL,
  `cnama` varchar(100) DEFAULT NULL,
  `cemail` varchar(100) DEFAULT NULL,
  `cpesan` text,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `tbl_tamu`
--

INSERT INTO `tbl_tamu` (`cid`, `cnama`, `cemail`, `cpesan`, `created_at`) VALUES
(12, 'afdal', 'afdalaja@gmail.com', 'awda daw dawd awd aw dawd aw', '2026-01-09 19:42:22'),
(13, 'ade putra', 'adeputra1@gmail.com', 'ad awda wda wda', '2026-01-09 19:43:56'),
(14, 'muazijan pratama', 'muazijanpertama@gmail.com', 'asdssssssa', '2026-01-09 19:44:53'),
(15, 'afdal', 'afdalaja@gmail.com', 'halo afdal', '2026-01-09 23:51:30'),
(16, 'afdal', 'awd@gmail.com', 'adwadaw awd a', '2026-01-10 17:14:40');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_biodata`
--
ALTER TABLE `tbl_biodata`
  ADD PRIMARY KEY (`cid`);

--
-- Indeks untuk tabel `tbl_biodata1`
--
ALTER TABLE `tbl_biodata1`
  ADD PRIMARY KEY (`cid`);

--
-- Indeks untuk tabel `tbl_tamu`
--
ALTER TABLE `tbl_tamu`
  ADD PRIMARY KEY (`cid`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_biodata`
--
ALTER TABLE `tbl_biodata`
  MODIFY `cid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `tbl_biodata1`
--
ALTER TABLE `tbl_biodata1`
  MODIFY `cid` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_tamu`
--
ALTER TABLE `tbl_tamu`
  MODIFY `cid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
