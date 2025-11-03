-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2025 at 05:19 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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
  `id` int(11) NOT NULL,
  `kode_barang` varchar(10) DEFAULT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `nama_barang`, `harga`, `stok`, `supplier_id`) VALUES
(1, 'B001', 'Sabun Lifebuoy', 5000, 100, 1),
(2, 'B002', 'Shampoo Clear', 12000, 80, 2),
(3, 'B003', 'Pasta Gigi Pepsodent', 10000, 90, 3),
(4, 'B004', 'Tissue Paseo', 7000, 150, 4),
(5, 'B005', 'Minyak Goreng Bimoli 1L', 18000, 70, 5),
(6, 'B006', 'Beras Ramos 5Kg', 65000, 50, 6),
(7, 'B007', 'Gula Pasir 1Kg', 15000, 100, 7),
(8, 'B008', 'Kopi Kapal Api', 12000, 80, 8),
(9, 'B009', 'Teh Sariwangi', 6000, 60, 9),
(10, 'B010', 'Kecap ABC 500ml', 11000, 70, 10);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` varchar(20) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `jenis_kelamin`, `telp`, `alamat`) VALUES
('P001', 'Andi Pratama', 'L', '081234567890', 'Surabaya'),
('P002', 'Budi Santoso', 'L', '081298765432', 'Gresik'),
('P003', 'Citra Dewi', 'P', '081345678901', 'Sidoarjo'),
('P004', 'Dewi Ayu', 'P', '081256789012', 'Mojokerto'),
('P005', 'Eko Saputra', 'L', '081367890123', 'Bangkalan'),
('P006', 'Fani Oktaviani', 'P', '081478901234', 'Lamongan'),
('P007', 'Gilang Prasetyo', 'L', '081589012345', 'Surabaya'),
('P008', 'Hana Putri', 'P', '081690123456', 'Sidoarjo'),
('P009', 'Irfan Maulana', 'L', '081701234567', 'Gresik'),
('P010', 'Joko Nugroho', 'L', '081812345678', 'Bangkalan');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `waktu_bayar` datetime DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `metode` enum('TUNAI','TRANSFER','EDC') DEFAULT NULL,
  `transaksi_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `waktu_bayar`, `total`, `metode`, `transaksi_id`) VALUES
(1, '2025-10-01 08:30:00', 95000, 'TUNAI', 1),
(2, '2025-10-02 10:00:00', 21000, 'TRANSFER', 2),
(3, '2025-10-03 09:45:00', 65000, 'TUNAI', 3),
(4, '2025-10-04 12:00:00', 32000, 'EDC', 4),
(5, '2025-10-05 14:30:00', 48000, 'TRANSFER', 5),
(6, '2025-10-06 15:00:00', 82000, 'TUNAI', 6),
(7, '2025-10-07 16:00:00', 15000, 'TUNAI', 7),
(8, '2025-10-08 17:30:00', 27000, 'TRANSFER', 8),
(9, '2025-10-09 18:45:00', 55000, 'EDC', 9),
(10, '2025-10-10 19:00:00', 125000, 'TRANSFER', 10);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `telp`, `alamat`) VALUES
(1, 'PT Sumber Makmur', '031700111', 'Surabaya'),
(2, 'PT Maju Jaya', '031700222', 'Gresik'),
(3, 'CV Indo Supply', '031700333', 'Lamongan'),
(4, 'PT Cahaya Abadi', '031700444', 'Sidoarjo'),
(5, 'PT Trunojoyo Sentosa', '031700555', 'Bangkalan'),
(6, 'CV Tunas Baru', '031700666', 'Surabaya'),
(7, 'PT Mekar Bersama', '031700777', 'Gresik'),
(8, 'CV Cipta Niaga', '031700888', 'Sidoarjo'),
(9, 'PT Berkah Lancar', '031700999', 'Mojokerto'),
(10, 'PT Prima Logistik', '031701000', 'Lamongan'),
(32, 'PT Cendol Dawet', '0858141782', 'Jogja1');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `waktu_transaksi` date DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `pelanggan_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `waktu_transaksi`, `keterangan`, `total`, `pelanggan_id`) VALUES
(1, '2025-10-01', 'Pembelian bulanan', 95000, 'P001'),
(2, '2025-10-02', 'Pembelian harian', 21000, 'P002'),
(3, '2025-10-03', 'Pembelian barang dapur', 65000, 'P003'),
(4, '2025-10-04', 'Pembelian kebutuhan mandi', 32000, 'P004'),
(5, '2025-10-05', 'Pembelian mingguan', 48000, 'P005'),
(6, '2025-10-06', 'Pembelian bulanan', 82000, 'P006'),
(7, '2025-10-07', 'Pembelian harian', 15000, 'P007'),
(8, '2025-10-08', 'Pembelian snack', 27000, 'P008'),
(9, '2025-10-09', 'Pembelian rutin', 55000, 'P009'),
(10, '2025-10-10', 'Pembelian besar', 125000, 'P010');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `transaksi_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `harga` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`transaksi_id`, `barang_id`, `harga`, `qty`) VALUES
(1, 1, 5000, 3),
(1, 2, 12000, 2),
(1, 3, 10000, 1),
(2, 4, 7000, 1),
(2, 5, 18000, 1),
(3, 6, 65000, 1),
(4, 1, 5000, 2),
(4, 3, 10000, 1),
(5, 7, 15000, 2),
(5, 9, 6000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` tinyint(2) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(35) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` varchar(150) DEFAULT NULL,
  `hp` varchar(20) DEFAULT NULL,
  `level` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `alamat`, `hp`, `level`) VALUES
(1, 'admin', '12345', 'Administrator', 'Surabaya', '081234000111', 1),
(2, 'kasir1', '12345', 'Rina Kusuma', 'Gresik', '081234000222', 2),
(3, 'kasir2', '12345', 'Bayu Nugraha', 'Sidoarjo', '081234000333', 2),
(4, 'gudang1', '12345', 'Dian Prasetya', 'Bangkalan', '081234000444', 3),
(5, 'gudang2', '12345', 'Lia Handayani', 'Mojokerto', '081234000555', 3),
(6, 'manager', '12345', 'Ahmad Fauzi', 'Surabaya', '081234000666', 1),
(7, 'operator', '12345', 'Wulan Sari', 'Gresik', '081234000777', 2),
(8, 'admin2', '12345', 'Indra Saputra', 'Lamongan', '081234000888', 1),
(9, 'kasir3', '12345', 'Nina Aulia', 'Sidoarjo', '081234000999', 2),
(10, 'developer', '12345', 'Teguh Rahman', 'Surabaya', '081234001000', 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
