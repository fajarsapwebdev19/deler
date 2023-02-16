-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2023 at 02:57 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

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

--
-- Dumping data for table `bukti_transfer_cash`
--

INSERT INTO `bukti_transfer_cash` (`id`, `id_transaksi`, `jumlah_bayar`, `keterangan`, `status_verifikasi`, `time_payment`, `bukti`) VALUES
(1, 2, 12500000, 'Pembayaran Motor Cash', 'Terima', '2023-02-10 18:31:46', '938879277__Yamaha-Aerox-155-VVA-2018-tipe-Standart-Kuning2018.png');

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
(1, 2, 2300000, 'Bayar Uang Muka', 'Terima', '2023-02-10 18:31:19', '1943983755___kwitansi_jualbeli_motor.png');

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
(1, 1, 'Honda Beat Street 110 eSP', '2016', 'Baik', 10500000, 8, '366042720---beatstreet2016.png'),
(2, 1, 'Honda Beat Street 110 eSP', '2017', 'Baik', 11500000, 10, '693015694---beatstreet2017.jpg'),
(3, 1, 'Honda Beat Street 110 eSP', '2018', 'Baik', 12500000, 8, '688445136---baetstreet2018.jpg'),
(4, 1, 'Honda Beat Street 110 eSP', '2019', 'Baik', 13500000, 10, '496498627---beatstreet2019.jpg'),
(5, 1, 'Honda All New Vario 150 eSP', '2017', 'Baik', 18000000, 10, '1336381861---pilihan-warna-honda-vario-150-2017.jpg'),
(6, 1, 'Honda All New Vario 150 eSP', '2018', 'Baik', 19000000, 10, '1252760967---honda2018.png'),
(7, 1, 'Honda PCX 150 CBU', '2014', 'Baik', 24700000, 10, '1056060597---1882424112.jpeg'),
(8, 1, 'Honda PCX 150 CBU', '2015', 'Baik', 27600000, 10, '673814765---2015pcx.jpg'),
(9, 1, 'Honda PCX 150 CBU', '2016', 'Baik', 28600000, 10, '1653155766---pcx2016.jpg'),
(10, 1, 'Honda PCX 150 CBU', '2017', 'Baik', 29500000, 10, '1815638331---pcx2017.png'),
(11, 1, 'Honda PCX 150 ABS', '2018', 'Baik', 27500000, 10, '2064015991---pcx2018.jpg'),
(12, 3, 'Kawasaki Ninja 250 FI', '2014', 'Baik', 34000000, 10, '1777006248---2014kwski250fi.png'),
(13, 3, 'Kawasaki Ninja 250 FI', '2015', 'Baik', 35000000, 10, '1300880785---Harga-Ninja-250FI-2015-SE-Beet-Performance-Edition-terbaru.jpg'),
(14, 3, 'Kawasaki Ninja 250 FI', '2016', 'Baik', 39000000, 10, '472093442---fu2016kawasaki.jpg'),
(15, 3, 'Kawasaki Ninja 250 FI', '2017', 'Baik', 40000000, 10, '1171600702---2017-Kawasaki-Ninja-250-blue-003.jpg'),
(16, 3, 'Kawasaki Ninja 250 FI', '2018', 'Baik', 42500000, 10, '1385033772---Warna-Baru-Kawasaki-Ninja-250-Fi-2018-KRT-Replica-3.jpg'),
(17, 3, 'Kawasaki Ninja 250 ABS', '2014', 'Baik', 39800000, 10, '802591192---2014kwskin250abs.jpg'),
(18, 3, 'Kawasaki Ninja 250 ABS', '2015', 'Baik', 40200000, 10, '247561543---2014kwskin250abs.jpg'),
(19, 3, 'Kawasaki Ninja 250 ABS', '2016', 'Baik', 41600000, 10, '684879862---2014kwskin250abs.jpg'),
(20, 3, 'Kawasaki Ninja 250 ABS', '2017', 'Baik', 51700000, 10, '882099845---2014kwskin250abs.jpg'),
(21, 3, 'Kawasaki Ninja 250 ABS SE/LED', '2017', 'Baik', 47000000, 10, '1268595542---2017-Kawasaki-Ninja-250-ABS-SE-01.jpg'),
(22, 4, 'Suzuki Satria FU 150', '2014', 'Baik', 10500000, 10, '1107626180---Satria-FU-2014-300x207.jpg'),
(23, 4, 'Suzuki Satria FU 150', '2015', 'Baik', 11400000, 10, '1788780712---SatriaF150Fighter-2015.jpg'),
(24, 4, 'Suzuki Satria FU 150', '2017', 'Baik', 13000000, 10, '1279985788---All New Satria F150 - 2017 - Brilliant White.jpg'),
(25, 4, 'Suzuki Satria FU 150', '2018', 'Baik', 14000000, 10, '2007759719---Satria-2018-Warna-Kuning-BMSPEED7.jpg'),
(26, 4, 'Suzuki GSX R 150', '2017', 'Baik', 16500000, 10, '548637785---pilihan-warna-suzuki-gsx-r150-2017-1.jpg'),
(27, 4, 'Suzuki GSX 150 R', '2018', 'Baik', 18000000, 10, '69026883---2018szkigsx150.jpg'),
(28, 4, 'Suzuki GSX 150 R', '2019', 'Baik', 19000000, 10, '1094579941---2019.png'),
(29, 2, 'Yamaha Fino', '2014', 'Baik', 7400000, 10, '797427311---fino2014.jpg'),
(30, 2, 'Yamaha Fino', '2015', 'Baik', 8500000, 10, '1103692934---yamaha-fino-sport-neo-white2015.jpg'),
(31, 2, 'Yamaha Fino', '2016', 'Baik', 9500000, 10, '1542192976---yamaha-fino-125-2016-putih.jpeg'),
(32, 2, 'Yamaha Fino', '2017', 'Baik', 10000000, 10, '1812844520---yamaha-Fino-125-2017-red-velvet.png'),
(33, 2, 'Yamaha Fino', '2018', 'Baik', 11000000, 10, '1624407659---Pilihan-Warna-Fino-Sporty-Warna-Jump-White2018.jpg'),
(34, 2, 'Yamaha Aerox 155', '2017', 'Baik', 18500000, 10, '2146568931---AEROX-155VVA-Matte-Blue-1024x9062017.jpg'),
(35, 2, 'Yamaha Aerox 155', '2018', 'Baik', 19000000, 9, '63354352---Yamaha-Aerox-155-VVA-2018-tipe-Standart-Kuning2018.png');

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

-- --------------------------------------------------------

--
-- Table structure for table `personal_data`
--

CREATE TABLE `personal_data` (
  `id` int(11) NOT NULL,
  `nama` varchar(90) NOT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') NOT NULL,
  `nik` char(16) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` char(13) NOT NULL,
  `create_date` date DEFAULT NULL,
  `modified_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personal_data`
--

INSERT INTO `personal_data` (`id`, `nama`, `jenis_kelamin`, `nik`, `alamat`, `no_telp`, `create_date`, `modified_date`) VALUES
(1, 'Fajar Saputra', 'Laki-Laki', '3671101912010003', 'Kedaung Wetan RT 02 RW 04', '081254199564', '2023-01-28', '0000-00-00'),
(2, 'user', 'Laki-Laki', '3671234565654543', 'Rawa Rotan RT 02 RW 03', '0889983789823', '2023-02-07', NULL);

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

--
-- Dumping data for table `transaksi_cash`
--

INSERT INTO `transaksi_cash` (`id`, `id_user`, `id_motor`, `tanggal_pembelian`, `pembayaran`, `status`) VALUES
(1, 2, 2, '2023-02-09 18:33:28', 'Tunai', 'Paid'),
(2, 2, 3, '2023-02-10 18:31:46', 'Transfer', 'Paid'),
(3, 2, 35, '2023-02-11 08:21:14', 'Tunai', 'Unpaid');

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
(1, 2, 3, 2300000, 6, 1700000, '2023-02-09 22:32:32', 'Tunai', 'Terima', 'Belum'),
(2, 2, 1, 2300000, 6, 1700000, '2023-02-10 18:31:19', 'Transfer', 'Terima', 'Belum');

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
  `status_akun` enum('Aktif','Tidak Aktif') DEFAULT NULL,
  `token` varchar(55) DEFAULT NULL,
  `on_status` enum('Online','Offline') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `personal_id`, `role_id`, `username`, `password`, `status_akun`, `token`, `on_status`) VALUES
(1, 1, 1, 'fajarsapwebdev19', 'Neglasari@@1207', 'Aktif', '1625486074118143725316022023', 'Online'),
(2, 2, 2, 'user', 'user', 'Aktif', '45288968118915141311022023', 'Online');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaksi_kredit`
--
ALTER TABLE `transaksi_kredit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
