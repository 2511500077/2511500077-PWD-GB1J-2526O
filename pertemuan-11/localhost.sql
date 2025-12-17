-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 16, 2025 at 04:29 PM
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
-- Database: `db_pwd2025`
--
CREATE DATABASE IF NOT EXISTS `db_pwd2025` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `db_pwd2025`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tamu`
--

CREATE TABLE `tbl_tamu` (
  `cid` int NOT NULL,
  `cnama` varchar(100) DEFAULT NULL,
  `cemail` varchar(100) DEFAULT NULL,
  `cpesan` text,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_tamu`
--

INSERT INTO `tbl_tamu` (`cid`, `cnama`, `cemail`, `cpesan`, `created_at`) VALUES
(1, 'Julio Putrawan', '2511500076@mahasiswa.atmaluhur.ac.id', 'Saya sangat senang belajar pemrograman web dasar', '2025-12-16 23:23:05'),
(2, 'Ade Putra', 'adeputrapkp@gmail.com', 'saya sangat hebat pada pelajaran kalkulus', '2025-12-16 23:23:05'),
(3, 'Maharani Indah Saputri', 'ranirani@gmail.com', 'saya kadang kurang teliti saat belajar pemrograman web dasar', '2025-12-16 23:23:05'),
(4, 'Julio Putrawan', '2511500076@mahasiswa.atmaluhur.ac.id', 'ernjekjriejfiejfi', '2025-12-16 23:23:05'),
(5, 'jul', 'awiuw8ue@gmail.com', 'aewa', '2025-12-16 23:23:05'),
(6, 'dfdfdsfsxdwki', 'sjdnsjdhjwdhwjdhws@gdyw.com', 'sdsds', '2025-12-16 23:23:05'),
(7, 'jul', 'hahhah@gmail.com', 'add', '2025-12-16 23:23:05'),
(8, 'Julio Putrawan', '2511500076@mahasiswa.atmaluhur.ac.id', 'dwmdkwjkwdw', '2025-12-16 23:23:05'),
(9, 'ju', '2511500076@mahasiswa.atmaluhur.ac.id', 'ase', '2025-12-16 23:23:05'),
(10, 'asasasad', 'jaisuqeuhyu@gmail.com', 'derfwetegtegtreg', '2025-12-16 23:23:05'),
(11, 'awsffefefefeesd', 'ashhdgg@gmail.com', 'adijwiuedfd', '2025-12-16 23:23:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_tamu`
--
ALTER TABLE `tbl_tamu`
  ADD PRIMARY KEY (`cid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_tamu`
--
ALTER TABLE `tbl_tamu`
  MODIFY `cid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;