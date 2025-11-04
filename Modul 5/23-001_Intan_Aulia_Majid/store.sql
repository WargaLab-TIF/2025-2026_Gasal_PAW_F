-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 04, 2025 at 02:06 PM
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
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int NOT NULL,
  `kode_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga` int NOT NULL,
  `stok` int NOT NULL,
  `supplier_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `nama_barang`, `harga`, `stok`, `supplier_id`) VALUES
(1, 'B001', 'Sabun Mandi', 5000, 100, 1),
(2, 'B002', 'Shampoo', 12000, 80, 2),
(3, 'B003', 'Pasta Gigi', 8000, 70, 3),
(4, 'B004', 'Tisu', 6000, 200, 4),
(5, 'B005', 'Minyak Goreng', 15000, 150, 5),
(6, 'B006', 'Beras 5kg', 70000, 60, 6),
(7, 'B007', 'Gula 1kg', 16000, 90, 7),
(8, 'B008', 'Kopi Sachet', 2000, 300, 8),
(9, 'B009', 'Teh Celup', 10000, 110, 9),
(10, 'B010', 'Mie Instan', 3500, 250, 10);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `telp` varchar(12) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `jenis_kelamin`, `telp`, `alamat`) VALUES
('P001', 'Intan Aulia', 'P', '081234567890', 'Jl. Melati No.1'),
('P002', 'Budi Santoso', 'L', '081345678901', 'Jl. Mawar No.2'),
('P003', 'Siti Rahma', 'P', '081256789012', 'Jl. Kenanga No.3'),
('P004', 'Agus Salim', 'L', '081367890123', 'Jl. Anggrek No.4'),
('P005', 'Dewi Lestari', 'P', '081478901234', 'Jl. Dahlia No.5'),
('P006', 'Rizki Ananda', 'L', '081589012345', 'Jl. Cempaka No.6'),
('P007', 'Tasya Amelia', 'P', '081690123456', 'Jl. Flamboyan No.7'),
('P008', 'Andi Wijaya', 'L', '081701234567', 'Jl. Teratai No.8'),
('P009', 'Nisa Putri', 'P', '081812345678', 'Jl. Sakura No.9'),
('P010', 'Doni Pratama', 'L', '081923456789', 'Jl. Melur No.10');

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
(1, '2025-10-01 08:00:00', 35000, 'TUNAI', 1),
(2, '2025-10-02 09:15:00', 45000, 'EDC', 2),
(3, '2025-10-03 10:30:00', 70000, 'TRANSFER', 3),
(4, '2025-10-04 11:00:00', 17000, 'TUNAI', 4),
(5, '2025-10-05 11:45:00', 65000, 'TRANSFER', 5),
(6, '2025-10-06 12:10:00', 20000, 'EDC', 6),
(7, '2025-10-07 13:20:00', 100000, 'TUNAI', 7),
(8, '2025-10-08 14:00:00', 12000, 'TUNAI', 8),
(9, '2025-10-09 15:30:00', 80000, 'TRANSFER', 9),
(10, '2025-10-10 16:45:00', 95000, 'EDC', 10);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `telp` varchar(12) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `telp`, `alamat`) VALUES
(1, 'CV Maju Jaya', '0211234567', 'Jl. Merdeka No.1'),
(2, 'PT Sumber Rezeki', '0212345678', 'Jl. Veteran No.2'),
(3, 'CV Sejahtera', '0213456789', 'Jl. Sudirman No.3'),
(4, 'PT Abadi Makmur', '0214567890', 'Jl. Gatot Subroto No.4'),
(5, 'CV Karya Bersama', '0215678901', 'Jl. Diponegoro No.5'),
(6, 'PT Sukses Mandiri', '0216789012', 'Jl. Pahlawan No.6'),
(7, 'CV Sentosa', '0217890123', 'Jl. Rajawali No.7'),
(8, 'PT Barokah', '0218901234', 'Jl. Melawai No.8'),
(9, 'CV Berkat Usaha', '0219012345', 'Jl. Kebon Jeruk No.9'),
(10, 'PT Mega Persada', '0210123456', 'Jl. Cendrawasih No.10');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int NOT NULL,
  `waktu_transaksi` date NOT NULL,
  `keterangan` text NOT NULL,
  `total` int NOT NULL,
  `pelanggan_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `waktu_transaksi`, `keterangan`, `total`, `pelanggan_id`) VALUES
(1, '2025-10-01', 'Pembelian harian', 35000, 'P001'),
(2, '2025-10-02', 'Pembelian mingguan', 45000, 'P002'),
(3, '2025-10-03', 'Belanja bulanan', 70000, 'P003'),
(4, '2025-10-04', 'Pembelian sabun & shampoo', 17000, 'P004'),
(5, '2025-10-05', 'Pembelian kebutuhan dapur', 65000, 'P005'),
(6, '2025-10-06', 'Belanja harian', 20000, 'P006'),
(7, '2025-10-07', 'Belanja bulanan', 100000, 'P007'),
(8, '2025-10-08', 'Pembelian kecil', 12000, 'P008'),
(9, '2025-10-09', 'Pembelian rumah tangga', 80000, 'P009'),
(10, '2025-10-10', 'Belanja campuran', 95000, 'P010');

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
(1, 1, 5000, 2),
(1, 2, 12000, 1),
(1, 4, 6000, 2),
(2, 5, 15000, 2),
(3, 6, 70000, 1),
(4, 1, 5000, 1),
(4, 2, 12000, 1),
(5, 5, 15000, 2),
(5, 7, 16000, 2),
(6, 10, 3500, 4),
(7, 6, 70000, 1),
(7, 9, 10000, 3),
(8, 3, 8000, 1),
(9, 8, 2000, 10),
(10, 5, 15000, 3);

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
  `level` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `alamat`, `hp`, `level`) VALUES
(1, 'admin', 'admin123', 'Admin Utama', 'Jl. Merdeka No.1', '0811111111', 1),
(2, 'kasir1', 'kasir123', 'Kasir A', 'Jl. Mawar No.2', '0812222222', 2),
(3, 'kasir2', 'kasir123', 'Kasir B', 'Jl. Kenanga No.3', '0813333333', 2),
(4, 'gudang', 'gudang123', 'Petugas Gudang', 'Jl. Anggrek No.4', '0814444444', 3),
(5, 'manager', 'manager123', 'Manager Toko', 'Jl. Dahlia No.5', '0815555555', 1),
(6, 'operator', 'operator123', 'Operator', 'Jl. Melati No.6', '0816666666', 2),
(7, 'kasir3', 'kasir123', 'Kasir C', 'Jl. Flamboyan No.7', '0817777777', 2),
(8, 'kasir4', 'kasir123', 'Kasir D', 'Jl. Cempaka No.8', '0818888888', 2),
(9, 'staff1', 'staff123', 'Staf Pembelian', 'Jl. Mawar No.9', '0819999999', 3),
(10, 'staff2', 'staff123', 'Staf Penjualan', 'Jl. Sakura No.10', '0820000000', 3);

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
  ADD KEY `transaksi_id` (`transaksi_id`),
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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` tinyint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `transaksi_detail_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `transaksi_detail_ibfk_2` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
