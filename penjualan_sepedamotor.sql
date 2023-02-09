-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2023 at 11:57 AM
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
-- Table structure for table `bukti_transfer_cash`
--

CREATE TABLE `bukti_transfer_cash` (
  `id` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `jumlah_bayar` bigint(50) NOT NULL,
  `keterangan` varchar(300) NOT NULL,
  `status_verifikasi` enum('Antrian','Terima','Tolak') NOT NULL,
  `time_payment` datetime NOT NULL,
  `bukti` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bukti_transfer_kredit`
--

CREATE TABLE `bukti_transfer_kredit` (
  `id` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `jumlah_bayar` bigint(50) NOT NULL,
  `keterangan` varchar(300) NOT NULL,
  `status_verifikasi` enum('Antrian','Terima','Tolak') NOT NULL,
  `time_payment` datetime NOT NULL,
  `bukti` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bukti_transfer_kredit`
--

INSERT INTO `bukti_transfer_kredit` (`id`, `id_transaksi`, `jumlah_bayar`, `keterangan`, `status_verifikasi`, `time_payment`, `bukti`) VALUES
(1, 1, 2300000, 'Bayar Uang Muka', 'Antrian', '2023-02-09 17:09:51', '1478235525___WhatsApp Image 2023-01-19 at 16.10.50.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `merk`
--

CREATE TABLE `merk` (
  `id` int(11) NOT NULL,
  `merk_name` char(200) NOT NULL,
  `logo` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `merk`
--

INSERT INTO `merk` (`id`, `merk_name`, `logo`) VALUES
(1, 'Honda', '747px-Honda_Logo.png'),
(2, 'Yamaha', 'Yamaha-Logo-500x220.png'),
(3, 'Kawasaki', 'Kawasaki-logo.png'),
(4, 'Suzuki', 'Suzuki-logo-625x768.png');

-- --------------------------------------------------------

--
-- Table structure for table `motor`
--

CREATE TABLE `motor` (
  `id` int(11) NOT NULL,
  `id_merk` int(11) DEFAULT NULL,
  `nama_motor` char(100) NOT NULL,
  `tahun` char(4) NOT NULL,
  `kondisi` char(80) NOT NULL,
  `harga` bigint(100) NOT NULL,
  `stok` bigint(11) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `motor`
--

INSERT INTO `motor` (`id`, `id_merk`, `nama_motor`, `tahun`, `kondisi`, `harga`, `stok`, `foto`) VALUES
(1, 1, 'Honda Beat Street 110 eSP', '2016', 'Baik', 10500000, 9, '1085755292___747px-Honda_Logo.png'),
(2, 1, 'Honda Beat Street 110 eSP', '2017', 'Baik', 11500000, 10, '694578228___747px-Honda_Logo.png'),
(3, 1, 'Honda Beat Street 110 eSP', '2018', 'Baik', 12500000, 10, '1700682239___747px-Honda_Logo.png'),
(4, 1, 'Honda Beat Street 110 eSP', '2019', 'Baik', 13500000, 10, '1416750645___747px-Honda_Logo.png'),
(5, 1, 'Honda All New Vario 150 eSP', '2017', 'Baik', 18000000, 10, '302201508___747px-Honda_Logo.png'),
(6, 1, 'Honda All New Vario 150 eSP', '2018', 'Baik', 19000000, 10, '293574106___747px-Honda_Logo.png'),
(7, 1, 'Honda PCX 150 CBU', '2014', 'Baik', 24700000, 10, '701593037___747px-Honda_Logo.png'),
(8, 1, 'Honda PCX 150 CBU', '2015', 'Baik', 27600000, 10, '1045468586___747px-Honda_Logo.png'),
(9, 1, 'Honda PCX 150 CBU', '2016', 'Baik', 28600000, 10, '195179870___747px-Honda_Logo.png'),
(10, 1, 'Honda PCX 150 CBU', '2017', 'Baik', 29500000, 10, '1542755893___747px-Honda_Logo.png'),
(11, 1, 'Honda PCX 150 ABS', '2018', 'Baik', 27500000, 10, '1536286238___747px-Honda_Logo.png'),
(12, 3, 'Kawasaki Ninja 250 FI', '2014', 'Baik', 34000000, 10, '331443461___Kawasaki-logo.png'),
(13, 3, 'Kawasaki Ninja 250 FI', '2015', 'Baik', 35000000, 10, '1027511986___Kawasaki-logo.png'),
(14, 3, 'Kawasaki Ninja 250 FI', '2016', 'Baik', 39000000, 10, '1193251248___Kawasaki-logo.png'),
(15, 3, 'Kawasaki Ninja 250 FI', '2017', 'Baik', 40000000, 10, '1295311786___Kawasaki-logo.png'),
(16, 3, 'Kawasaki Ninja 250 FI', '2018', 'Baik', 42500000, 10, '192676198___Kawasaki-logo.png'),
(17, 3, 'Kawasaki Ninja 250 ABS', '2014', 'Baik', 39800000, 10, '240040114___Kawasaki-logo.png'),
(18, 3, 'Kawasaki Ninja 250 ABS', '2015', 'Baik', 40200000, 10, '812385594___Kawasaki-logo.png'),
(19, 3, 'Kawasaki Ninja 250 ABS', '2016', 'Baik', 41600000, 10, '1169914618___Kawasaki-logo.png'),
(20, 3, 'Kawasaki Ninja 250 ABS', '2017', 'Baik', 51700000, 10, '1109945289___Kawasaki-logo.png'),
(21, 3, 'Kawasaki Ninja 250 ABS SE/LED', '2017', 'Baik', 47000000, 10, '1304061478___Kawasaki-logo.png'),
(22, 4, 'Suzuki Satria FU 150', '2014', 'Baik', 10500000, 10, '1263266390___Suzuki-logo-625x768.png'),
(23, 4, 'Suzuki Satria FU 150', '2015', 'Baik', 11400000, 10, '851524813___Suzuki-logo-625x768.png'),
(24, 4, 'Suzuki Satria FU 150', '2017', 'Baik', 13000000, 10, '580181951___Suzuki-logo-625x768.png'),
(25, 4, 'Suzuki Satria FU 150', '2018', 'Baik', 14000000, 10, '20539274___Suzuki-logo-625x768.png'),
(26, 4, 'Suzuki GSX R 150', '2017', 'Baik', 16500000, 10, '382040649___Suzuki-logo-625x768.png'),
(27, 4, 'Suzuki GSX 150 R', '2018', 'Baik', 18000000, 10, '624636875___Suzuki-logo-625x768.png'),
(28, 4, 'Suzuki GSX 150 R', '2019', 'Baik', 19000000, 10, '1596415205___Suzuki-logo-625x768.png'),
(29, 2, 'Yamaha Fino', '2014', 'Baik', 7400000, 10, '436441371___Yamaha-Logo-500x220.png'),
(30, 2, 'Yamaha Fino', '2015', 'Baik', 8500000, 10, '1227269715___Yamaha-Logo-500x220.png'),
(31, 2, 'Yamaha Fino', '2016', 'Baik', 9500000, 10, '1698439710___Yamaha-Logo-500x220.png'),
(32, 2, 'Yamaha Fino', '2017', 'Baik', 10000000, 10, '1546260454___Yamaha-Logo-500x220.png'),
(33, 2, 'Yamaha Fino', '2018', 'Baik', 11000000, 10, '232554911___Yamaha-Logo-500x220.png'),
(34, 2, 'Yamaha Aerox 155', '2017', 'Baik', 18500000, 10, '1804495782___Yamaha-Logo-500x220.png'),
(35, 2, 'Yamaha Aerox 155', '2018', 'Baik', 19000000, 10, '1815151418___Yamaha-Logo-500x220.png');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran_tenor`
--

CREATE TABLE `pembayaran_tenor` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `tenor` int(11) NOT NULL,
  `jatuh_tempo` int(11) NOT NULL,
  `uang_tenor` bigint(50) NOT NULL,
  `pembayaran_ke` int(11) NOT NULL,
  `sisa` int(11) NOT NULL,
  `tanggal_bayar` date NOT NULL,
  `status_bayar` enum('Sudah','Belum') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_data`
--

CREATE TABLE `personal_data` (
  `id` int(11) NOT NULL,
  `nama` varchar(90) NOT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') NOT NULL,
  `nik` bigint(16) NOT NULL,
  `email` varchar(300) NOT NULL,
  `no_telp` char(13) NOT NULL,
  `create_date` date DEFAULT NULL,
  `modified_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personal_data`
--

INSERT INTO `personal_data` (`id`, `nama`, `jenis_kelamin`, `nik`, `email`, `no_telp`, `create_date`, `modified_date`) VALUES
(1, 'Fajar Saputra', 'Laki-Laki', 3671762376372673, 'fajarsaputratkj3@gmail.com', '3287652387572', '2023-01-28', '0000-00-00'),
(2, 'user', 'Laki-Laki', 367263872567452674, 'user@mail.com', '0889983789823', '2023-02-07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role_name` varchar(200) NOT NULL,
  `create_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role_name`, `create_date`, `modified_date`) VALUES
(1, 'Admin', '2023-01-29 09:46:29', NULL),
(2, 'Customer', '2023-01-29 09:46:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_cash`
--

CREATE TABLE `transaksi_cash` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_motor` int(11) NOT NULL,
  `tanggal_pembelian` datetime NOT NULL,
  `pembayaran` enum('Transfer','Tunai') NOT NULL,
  `status` enum('Paid','Unpaid') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_kredit`
--

CREATE TABLE `transaksi_kredit` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_motor` int(11) NOT NULL,
  `uang_muka` bigint(50) NOT NULL,
  `tenor` int(11) NOT NULL,
  `uang_tenor` bigint(50) DEFAULT NULL,
  `tanggal_beli` datetime NOT NULL,
  `pembayaran` enum('Tunai','Transfer') NOT NULL,
  `status` enum('Antrian','Terima','Tolak') DEFAULT NULL,
  `status_lunas` enum('Lunas','Belum') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_kredit`
--

INSERT INTO `transaksi_kredit` (`id`, `id_user`, `id_motor`, `uang_muka`, `tenor`, `uang_tenor`, `tanggal_beli`, `pembayaran`, `status`, `status_lunas`) VALUES
(1, 2, 1, 2300000, 11, 0, '2023-02-09 17:09:51', 'Transfer', NULL, 'Belum');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `personal_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `username` varchar(300) DEFAULT NULL,
  `password` varchar(300) DEFAULT NULL,
  `verifikasi_email` enum('Sudah','Belum') DEFAULT NULL,
  `status_akun` enum('Aktif','Tidak Aktif') DEFAULT NULL,
  `kode_aktivasi` bigint(11) DEFAULT NULL,
  `token` varchar(55) DEFAULT NULL,
  `on_status` enum('Online','Offline') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `personal_id`, `role_id`, `username`, `password`, `verifikasi_email`, `status_akun`, `kode_aktivasi`, `token`, `on_status`) VALUES
(1, 1, 1, 'fajarsapwebdev19', 'Neglasarioke', 'Sudah', 'Aktif', NULL, '1537015260130502892308022023', 'Online'),
(2, 2, 2, 'user', 'user', 'Sudah', 'Aktif', NULL, '63175347178831184009022023', 'Online');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bukti_transfer_cash`
--
ALTER TABLE `bukti_transfer_cash`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bukti_transfer_kredit`
--
ALTER TABLE `bukti_transfer_kredit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `merk`
--
ALTER TABLE `merk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `motor`
--
ALTER TABLE `motor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran_tenor`
--
ALTER TABLE `pembayaran_tenor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_data`
--
ALTER TABLE `personal_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi_cash`
--
ALTER TABLE `transaksi_cash`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_customer` (`id_user`),
  ADD KEY `fk_motor` (`id_motor`);

--
-- Indexes for table `transaksi_kredit`
--
ALTER TABLE `transaksi_kredit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `personal_fk` (`personal_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bukti_transfer_cash`
--
ALTER TABLE `bukti_transfer_cash`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bukti_transfer_kredit`
--
ALTER TABLE `bukti_transfer_kredit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `merk`
--
ALTER TABLE `merk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `motor`
--
ALTER TABLE `motor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `pembayaran_tenor`
--
ALTER TABLE `pembayaran_tenor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_data`
--
ALTER TABLE `personal_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaksi_cash`
--
ALTER TABLE `transaksi_cash`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi_kredit`
--
ALTER TABLE `transaksi_kredit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaksi_cash`
--
ALTER TABLE `transaksi_cash`
  ADD CONSTRAINT `fk_customer` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_motor` FOREIGN KEY (`id_motor`) REFERENCES `motor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `personal_fk` FOREIGN KEY (`personal_id`) REFERENCES `personal_data` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
