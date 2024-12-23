-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2024 at 04:03 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simba`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` varchar(20) NOT NULL,
  `nama_barang` varchar(60) DEFAULT NULL,
  `stok` varchar(4) DEFAULT NULL,
  `id_satuan` int(20) DEFAULT NULL,
  `id_jenis` int(20) DEFAULT NULL,
  `hargabeli` varchar(200) DEFAULT NULL,
  `hargajual` varchar(200) DEFAULT NULL,
  `foto` varchar(225) DEFAULT NULL,
  `warna` varchar(150) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `stok`, `id_satuan`, `id_jenis`, `hargabeli`, `hargajual`, `foto`, `warna`, `created_at`) VALUES
('BRG-0001', 'Gelang', '0', 1, 1, '2000', '3000', 'box.png', 'Merah', '2023-12-18 02:37:25'),
('BRG-0002', 'Kain', '0', 2, 3, '25000', '28000', 'box.png', 'Putih', '2023-12-18 15:07:30'),
('BRG-0003', 'Penjepit Rambut', '20', 2, 1, '2900', '3500', 'box.png', 'Hijau', '2024-06-06 05:50:24'),
('BRG-0004', 'Indra', '1', 2, 1, '3000000', '4000000', 'QOMAR.jpg', 'Hitam', '2024-12-15 14:04:36'),
('BRG-0005', 'Jeans', '100', 2, 3, '6000', '10000', 'box.png', 'Merah', '2024-12-23 01:29:44');

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id_barang_keluar` varchar(30) NOT NULL,
  `id_barang` varchar(30) DEFAULT NULL,
  `id_user` varchar(30) DEFAULT NULL,
  `jumlah_keluar` varchar(5) DEFAULT NULL,
  `tgl_keluar` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`id_barang_keluar`, `id_barang`, `id_user`, `jumlah_keluar`, `tgl_keluar`) VALUES
('BRG-K-0001', 'BRG-0002', 'USR-001', '2', '2023-12-18'),
('BRG-K-0002', 'BRG-0001', 'USR-001', '5', '2023-11-30'),
('BRG-K-0003', 'BRG-0001', 'USR-001', '3', '2024-06-12'),
('BRG-K-0004', 'BRG-0002', 'USR-001', '3', '2024-06-12'),
('BRG-K-0005', 'BRG-0001', 'USR-001', '2', '2024-08-26'),
('BRG-K-0006', 'BRG-0003', 'USR-001', '4', '2024-12-17');

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id_barang_masuk` varchar(40) NOT NULL,
  `id_supplier` varchar(30) DEFAULT NULL,
  `id_barang` varchar(30) DEFAULT NULL,
  `id_user` varchar(30) DEFAULT NULL,
  `jumlah_masuk` int(10) DEFAULT NULL,
  `tgl_masuk` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`id_barang_masuk`, `id_supplier`, `id_barang`, `id_user`, `jumlah_masuk`, `tgl_masuk`) VALUES
('BRG-M-0001', 'SPLY-0001', 'BRG-0001', 'USR-001', 2, '2023-10-30'),
('BRG-M-0002', 'SPLY-0001', 'BRG-0002', 'USR-001', 10, '2023-12-18'),
('BRG-M-0003', 'SPLY-0001', 'BRG-0001', 'USR-001', 3, '2024-05-11'),
('BRG-M-0004', 'SPLY-0001', 'BRG-0001', 'USR-001', 1, '2024-06-12'),
('BRG-M-0005', 'SPLY-0002', 'BRG-0001', 'USR-001', 3, '2024-06-12'),
('BRG-M-0006', 'SPLY-0001', 'BRG-0001', 'USR-001', 3, '2024-08-25'),
('BRG-M-0007', 'SPLY-0003', 'BRG-0004', 'USR-003', 51, '2024-12-23');

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE `jenis` (
  `id_jenis` int(20) NOT NULL,
  `nama_jenis` varchar(20) DEFAULT NULL,
  `ket` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis`
--

INSERT INTO `jenis` (`id_jenis`, `nama_jenis`, `ket`) VALUES
(1, 'Aksesoris', ''),
(2, 'Benang', ''),
(3, 'Kain', ''),
(4, 'Kancing', ''),
(5, 'Ziper', '');

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `id_satuan` int(20) NOT NULL,
  `nama_satuan` varchar(60) DEFAULT NULL,
  `ket` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`id_satuan`, `nama_satuan`, `ket`) VALUES
(1, 'PCS', ''),
(2, 'Buah', '');

-- --------------------------------------------------------

--
-- Table structure for table `setting_app`
--

CREATE TABLE `setting_app` (
  `id` int(11) NOT NULL,
  `pemilik` varchar(100) DEFAULT NULL,
  `nama` varchar(225) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `kontak` varchar(50) DEFAULT NULL,
  `logo` varchar(225) DEFAULT NULL,
  `is_active` varchar(1) DEFAULT NULL,
  `header_background_color` varchar(100) DEFAULT NULL,
  `sidebar_background_color` varchar(100) DEFAULT NULL,
  `zona_waktu` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `setting_app`
--

INSERT INTO `setting_app` (`id`, `pemilik`, `nama`, `alamat`, `kontak`, `logo`, `is_active`, `header_background_color`, `sidebar_background_color`, `zona_waktu`) VALUES
(1, 'BAD', 'SIMBA', 'Depok', '1213910931', 'cc38e731e20aec8ec1e145accd7a23bd.png', '1', '#3a8edf', '#308edf', 'Depok_z41c');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` varchar(10) NOT NULL,
  `nama_supplier` varchar(60) DEFAULT NULL,
  `notelp` varchar(15) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `notelp`, `alamat`, `foto`) VALUES
('SPLY-0001', 'CV Intan Permata', '081924141414', 'Bogor', 'images.jpg'),
('SPLY-0002', 'CV Berkah', '085155311141', 'Jakarta', 'user1.png'),
('SPLY-0003', 'Butik Permata', '081999999999', 'Lampung', 'user22.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` varchar(50) NOT NULL,
  `nik` char(16) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `notelp` varchar(15) NOT NULL,
  `level` enum('user','admin','superadmin') NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nik`, `nama`, `username`, `email`, `notelp`, `level`, `password`, `foto`, `status`) VALUES
('USR-001', '3201022010130011', 'Administrator', 'admin', 'admin@gmail.com', '', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Potrait_BilhaqAviDewantara_OJK.jpg', 'Aktif'),
('USR-002', '3201022010130011', 'User', 'user', 'user@gmail.com', '+6286128818112', 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'user.png', 'Aktif'),
('USR-003', '3201022010130011', 'Super Admin', 'superadmin', 'pemilikxmanajer@gmail.com', '+6289291889228', 'superadmin', '17c4520f6cfd1ab53d8745e84681eb49', 'apple-touch-icon.png', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `token` varchar(200) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id_barang_keluar`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id_barang_masuk`);

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `setting_app`
--
ALTER TABLE `setting_app`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id_jenis` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id_satuan` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
