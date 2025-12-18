-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 18 Des 2025 pada 10.52
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
(1, 'Afdal', '2511500077@mahasiswa.atmaluhur.ac.id', 'Ayo yag teliti belajar pemrograman web dasarnya, jangan membiasakan typo', '2025-12-18 17:31:39'),
(2, 'julio putrawan', 'julioputrawan123@gmail.com', 'halo temanku apa kabar', '2025-12-18 17:31:39'),
(3, 'ade putra', 'adeputra123@gmail.com', 'semangat temann sehat selalu', '2025-12-18 17:31:39'),
(4, 'aad', 'awd@gmail.com', 'awdaawdawdawdaw', '2025-12-18 17:31:39'),
(5, 'aad', '234@gmai.com', 'haloo afdallll bagaimana', '2025-12-18 17:31:39'),
(6, 'awd', 'awdawd@gmail.com', 'halooo afdalll', '2025-12-18 17:31:39');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_tamu`
--
ALTER TABLE `tbl_tamu`
  ADD PRIMARY KEY (`cid`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_tamu`
--
ALTER TABLE `tbl_tamu`
  MODIFY `cid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
