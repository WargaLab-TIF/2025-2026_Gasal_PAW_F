-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 02, 2025 at 03:43 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int NOT NULL,
  `kode_barang` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama_barang` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `stok` int DEFAULT NULL,
  `supplier_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `nama_barang`, `harga`, `stok`, `supplier_id`) VALUES
(1, 'A001', 'Pensil', 1000.00, 100, 1),
(2, 'A002', 'Pulpen', 2000.00, 120, 1),
(3, 'A003', 'Buku Tulis', 3000.00, 80, 2),
(4, 'A004', 'Penghapus', 4000.00, 200, 3),
(5, 'A005', 'Spidol', 50000.00, 50, 4),
(6, 'A006', 'Rautan', 6000.00, 90, 5),
(7, 'A007', 'Kertas A4', 45000.00, 60, 6),
(8, 'A008', 'Map Plastik', 7000.00, 70, 7),
(9, 'A009', 'Stabilo', 9000.00, 100, 8),
(10, 'A010', 'Buku Gambar', 10000.00, 40, 9);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jenis_kelamin` enum('L','P') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telp` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `jenis_kelamin`, `telp`, `alamat`) VALUES
(1, 'Farrel', 'L', '081234567890', 'Mojokerto'),
(2, 'Arif', 'L', '081234567891', 'Bima'),
(3, 'Dodit', 'P', '081234567892', 'Surabaya'),
(4, 'Bagus', 'P', '081234567893', 'Pamekasan'),
(5, 'Dani', 'L', '081234567894', 'Nganjuk'),
(6, 'Ashif', 'P', '081234567895', 'Jombang'),
(7, 'Nizam', 'L', '081234567896', 'Gresik'),
(8, 'Wahyu', 'P', '081234567897', 'Surabaya'),
(9, 'Indra', 'L', '081234567898', 'Sidoarjo'),
(10, 'Joko', 'L', '081234567899', 'Jogja');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int NOT NULL,
  `waktu_bayar` datetime DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `metode` enum('Tunai','Transfer','EDC') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `transaksi_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `waktu_bayar`, `total`, `metode`, `transaksi_id`) VALUES
(1, '2025-10-29 21:39:17', 30000.00, 'Tunai', 1),
(2, '2025-10-29 21:39:17', 85000.00, 'Transfer', 2),
(3, '2025-10-29 21:39:17', 15000.00, 'EDC', 3),
(4, '2025-10-29 21:39:17', 12000.00, 'Tunai', 4),
(5, '2025-10-29 21:39:17', 16000.00, 'Transfer', 5),
(6, '2025-10-29 21:39:17', 7000.00, 'Tunai', 6),
(7, '2025-10-29 21:39:17', 45000.00, 'Transfer', 7),
(8, '2025-10-29 21:39:17', 18000.00, 'EDC', 8),
(9, '2025-10-29 21:39:17', 7000.00, 'Tunai', 9),
(10, '2025-10-29 21:39:17', 60000.00, 'Transfer', 10);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telp` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `telp`, `alamat`) VALUES
(1, 'farrel', '1234321', 'surabaya1'),
(2, 'PT.horegabad', '1234321', 'surabaya'),
(3, 'PT Sentosa Abad', '0213333333', 'Surabaya'),
(4, 'CV Amanah', '0214444444', 'Medan'),
(5, 'PT Laris Manis', '0215555555', 'Bekasi'),
(6, 'PT Indah Perkasa', '0216666666', 'Depok'),
(7, 'CV Jaya Raya', '0217777777', 'Tangerang'),
(8, 'PT Prima Sentosa', '0218888888', 'Bogor'),
(9, 'PT Cahaya Baru', '0219999999', 'Semarang'),
(10, 'ptptptpt', '04950493', 'mojokerto'),
(12, 'pt', '12321', 'medan 2');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int NOT NULL,
  `waktu_transaksi` datetime DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_general_ci,
  `total` decimal(10,2) DEFAULT NULL,
  `pelanggan_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `waktu_transaksi`, `keterangan`, `total`, `pelanggan_id`) VALUES
(1, '2025-10-29 21:38:18', 'Pembelian alat tulis', 30000.00, 1),
(2, '2025-10-29 21:38:18', 'Pembelian kertas dan buku', 85000.00, 2),
(3, '2025-10-29 21:38:18', 'Pembelian spidol dan penghapus', 15000.00, 3),
(4, '2025-10-29 21:38:18', 'Pembelian buku gambar', 12000.00, 4),
(5, '2025-10-29 21:38:18', 'Pembelian pensil dan pulpen', 16000.00, 5),
(6, '2025-10-29 21:38:18', 'Pembelian map plastik', 7000.00, 6),
(7, '2025-10-29 21:38:18', 'Pembelian kertas A4', 45000.00, 7),
(8, '2025-10-29 21:38:18', 'Pembelian stabilo', 18000.00, 8),
(9, '2025-10-29 21:38:18', 'Pembelian rautan dan pensil', 7000.00, 9),
(10, '2025-10-29 21:38:18', 'Pembelian alat tulis campuran', 60000.00, 10);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `transaksi_id` int NOT NULL,
  `barang_id` int NOT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `qty` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`transaksi_id`, `barang_id`, `harga`, `qty`) VALUES
(1, 1, 3000.00, 5),
(1, 2, 5000.00, 3),
(2, 3, 8000.00, 5),
(2, 7, 45000.00, 1),
(3, 4, 2000.00, 2),
(3, 5, 10000.00, 1),
(4, 10, 12000.00, 1),
(5, 1, 3000.00, 2),
(5, 2, 5000.00, 2),
(6, 8, 7000.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_general_ci,
  `hp` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `level` enum('admin','kasir','owner') COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `alamat`, `hp`, `level`) VALUES
(NULL, 'admin1', '12345', 'Admin Utama', 'Mojokerto', '0811111111', 'admin'),
(NULL, 'kasir1', '12345', 'Kasir A', 'Bima', '0811111112', 'kasir'),
(NULL, 'kasir2', '12345', 'Kasir B', 'Surabaya', '0811111113', 'kasir'),
(NULL, 'owner1', '12345', 'Owner', 'Gresik', '0811111114', 'owner'),
(NULL, 'admin2', '12345', 'Admin Cadangan', 'Pamekasan', '0811111115', 'admin'),
(NULL, 'kasir3', '12345', 'Kasir C', 'Jombang', '0811111116', 'kasir'),
(NULL, 'kasir4', '12345', 'Kasir D', 'Lamongan', '0811111117', 'kasir'),
(NULL, 'kasir5', '12345', 'Kasir E', 'Surabaya', '0811111118', 'kasir'),
(NULL, 'owner2', '12345', 'Owner 2', 'Jogja', '0811111119', 'owner'),
(NULL, 'admin3', '12345', 'Admin Baru', 'Surabaya', '0811111120', 'admin');

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
  ADD KEY `transaksi_id` (`transaksi_id`);

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
  ADD KEY `pelanggan_id` (`pelanggan_id`);

--
-- Indexes for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`transaksi_id`,`barang_id`),
  ADD KEY `barang_id` (`barang_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`);

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
