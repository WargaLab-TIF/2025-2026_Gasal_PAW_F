-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 10, 2025 at 01:16 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penjualan`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga` int NOT NULL,
  `stok` int NOT NULL,
  `supplier_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `nama_barang`, `harga`, `stok`, `supplier_id`) VALUES
(1, 'Buku Tulis', 5000, 100, 1),
(2, 'Pulpen', 3000, 200, 1),
(3, 'Penghapus', 2000, 150, 2),
(4, 'Pensil', 2500, 120, 2),
(5, 'Tinta', 4500, 170, 3),
(6, 'Penggaris', 6000, 125, 4);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` varchar(20) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `alamat` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `jenis_kelamin`, `telp`, `alamat`) VALUES
('1cff1b64113091e554ce', 'Cakra', 'L', '0833333333', 'Jl. Mawar No.3'),
('4cdfc37e6d6a2b63b177', 'Dellon', 'L', '0844444444', 'Jl. Mangga No.4'),
('4f31bfdc7c3855eb9918', 'Andi', 'L', '0811111111', 'Jl. Kenanga No.1'),
('5666e91d5e9c9292f5a4', 'Budi', 'L', '0822222222', 'Jl. Melati No.2'),
('e7ce39c93d94086fbb7d', 'Ethan', 'L', '08666666666', 'Jl. Ungger No.6');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int NOT NULL,
  `waktu_bayar` datetime NOT NULL,
  `total` int NOT NULL,
  `metode` enum('TUNAI','TRANSFER','EDC') NOT NULL,
  `transaksi_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `waktu_bayar`, `total`, `metode`, `transaksi_id`) VALUES
(1, '2025-11-05 05:39:46', 15000, 'TUNAI', 1),
(2, '2025-11-05 05:39:46', 22000, 'TUNAI', 2),
(3, '2025-11-05 06:20:26', 10000, 'TUNAI', 3),
(4, '2025-11-05 06:20:26', 27000, 'TUNAI', 4),
(5, '2025-11-05 06:22:48', 18000, 'TUNAI', 5),
(6, '2025-11-05 06:22:48', 12000, 'EDC', 6),
(7, '2025-11-05 06:23:56', 25000, 'EDC', 7),
(8, '2025-11-05 06:23:56', 30000, 'EDC', 8),
(9, '2025-11-05 06:25:15', 50000, 'TRANSFER', 9),
(10, '2025-11-05 06:25:15', 65000, 'TRANSFER', 10);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `telp` varchar(12) NOT NULL,
  `alamat` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `telp`, `alamat`) VALUES
(1, 'PT Sumber Makmur', '0112345678', 'Jakarta'),
(2, 'UD Maju Jaya', '0212345678', 'Surabaya'),
(3, 'PT Sumber Cinta', '0312345678', 'Malang'),
(4, 'PT Sumber Agung', '0412345678', 'Bandung'),
(5, 'PT Telkom Indonesia', '0512345678', 'Semarang');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int NOT NULL,
  `waktu_transaksi` date NOT NULL,
  `keterangan` text NOT NULL,
  `total` int NOT NULL DEFAULT '0',
  `pelanggan_id` varchar(20) NOT NULL,
  `user_id` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `waktu_transaksi`, `keterangan`, `total`, `pelanggan_id`, `user_id`) VALUES
(1, '2025-11-01', 'Pembelian alat tulis 1', 23500, '4f31bfdc7c3855eb9918', 1),
(2, '2025-11-02', 'Pembelian alat tulis 2', 7500, '4f31bfdc7c3855eb9918', 1),
(3, '2025-11-03', 'Pembelian alat tulis 3', 10000, '4f31bfdc7c3855eb9918', 1),
(4, '2025-11-04', 'Pembelian alat tulis 4', 27000, '4f31bfdc7c3855eb9918', 1),
(5, '2025-11-01', 'Pembelian alat tulis 1', 18000, '4f31bfdc7c3855eb9918', 1),
(6, '2025-11-02', 'Pembelian alat tulis 2', 12000, '4f31bfdc7c3855eb9918', 1),
(7, '2025-11-03', 'Pembelian alat tulis 3', 25000, '4f31bfdc7c3855eb9918', 1),
(8, '2025-11-04', 'Pembelian alat tulis 4', 30000, '4f31bfdc7c3855eb9918', 1),
(9, '2025-11-05', 'Pembelian alat tulis 5', 50000, '4cdfc37e6d6a2b63b177', 3),
(10, '2025-11-06', 'Pembelian alat tulis 6', 65000, '4f31bfdc7c3855eb9918', 4);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `transaksi_id` int NOT NULL,
  `barang_id` int NOT NULL,
  `harga` int NOT NULL,
  `qty` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`transaksi_id`, `barang_id`, `harga`, `qty`) VALUES
(1, 1, 5000, 3),
(1, 2, 3000, 2),
(1, 4, 2500, 1),
(2, 1, 5000, 1),
(2, 4, 2500, 1),
(3, 3, 2000, 5),
(4, 2, 3000, 5),
(5, 2, 3000, 5),
(6, 3, 2000, 5),
(7, 2, 3000, 4),
(8, 4, 2500, 2),
(9, 5, 4500, 4),
(10, 5, 4500, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` tinyint NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(35) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `hp` varchar(20) NOT NULL,
  `level` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `alamat`, `hp`, `level`) VALUES
(1, 'admin', '1234', 'Admin Utama', 'Jl. Merdeka No.1', '081234567890', 1),
(2, 'kasir1', '1234', 'Kasir Satu', 'Jl. Sudirman No.2', '082234567890', 2),
(3, 'gudang1', '1234', 'Gudang Satu', 'Jl. Damai No.3', '083234567890', 3),
(4, 'manager', '1234', 'Manager Utama', 'Jl. Wonocolo No.4', '084234567890', 4),
(5, 'Owner', '1234', 'Owner Utama', 'Jl. Kasih No.5', '085234567890', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transaksi_id` (`transaksi_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelanggan_id` (`pelanggan_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`transaksi_id`,`barang_id`),
  ADD KEY `barang_id` (`barang_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` tinyint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`);

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `transaksi_detail_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`),
  ADD CONSTRAINT `transaksi_detail_ibfk_2` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
