-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2023 at 02:32 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penjualan_sepedamotor`
--

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran_tenor`
--

CREATE TABLE `pembayaran_tenor` (
  `id` int(11) NOT NULL,
  `id_transaksi` int(11) DEFAULT NULL,
  `tenor` int(11) DEFAULT NULL,
  `uang_tenor` bigint(50) DEFAULT NULL,
  `pembayaran_ke` int(11) DEFAULT NULL,
  `pembayaran` enum('Tunai','Transfer') DEFAULT NULL,
  `tanggal_bayar` date DEFAULT NULL,
  `status_bayar` enum('Sudah','Belum') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran_tenor`
--

INSERT INTO `pembayaran_tenor` (`id`, `id_transaksi`, `tenor`, `uang_tenor`, `pembayaran_ke`, `pembayaran`, `tanggal_bayar`, `status_bayar`) VALUES
(1, 1, 6, 1700000, 1, '', NULL, 'Belum'),
(2, 1, 6, 1700000, 2, '', NULL, 'Belum'),
(3, 1, 6, 1700000, 3, '', NULL, 'Belum'),
(4, 1, 6, 1700000, 4, '', NULL, 'Belum'),
(5, 1, 6, 1700000, 5, '', NULL, 'Belum'),
(6, 1, 6, 1700000, 6, '', NULL, 'Belum'),
(7, 2, 6, 1700000, 1, '', NULL, 'Belum'),
(8, 2, 6, 1700000, 2, '', NULL, 'Belum'),
(9, 2, 6, 1700000, 3, '', NULL, 'Belum'),
(10, 2, 6, 1700000, 4, '', NULL, 'Belum'),
(11, 2, 6, 1700000, 5, '', NULL, 'Belum'),
(12, 2, 6, 1700000, 6, '', NULL, 'Belum');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pembayaran_tenor`
--
ALTER TABLE `pembayaran_tenor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pembayaran_tenor`
--
ALTER TABLE `pembayaran_tenor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
