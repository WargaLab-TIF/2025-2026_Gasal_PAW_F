-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 04, 2025 at 01:03 AM
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
  `stok` int DEFAULT '0',
  `supplier_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `nama_barang`, `harga`, `stok`, `supplier_id`) VALUES
(1, 'BR001', 'Buku Catatan B5', 7000, 85, 1),
(2, 'BR002', 'Pulpen Biru', 3500, 140, 2),
(3, 'BR003', 'Pensil HB', 3000, 130, 3),
(4, 'BR004', 'Rautan Pensil', 2500, 75, 4),
(5, 'BR005', 'Penggaris Logam 20cm', 6000, 55, 5),
(6, 'BR006', 'Spidol Permanen', 12000, 80, 6),
(7, 'BR007', 'Kertas HVS A3', 50000, 45, 7),
(8, 'BR008', 'Map Plastik A4', 15000, 65, 8),
(9, 'BR009', 'Highlighter Neon', 9500, 95, 9),
(10, 'BR010', 'Lem Cair 50ml', 5500, 105, 10);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `alamat` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `jenis_kelamin`, `telp`, `alamat`) VALUES
('P001', 'Andika Saputra', 'L', '081255500111', 'Jl. Merpati No.21'),
('P002', 'Bunga Lestari', 'P', '081255500222', 'Jl. Anggrek No.33'),
('P003', 'Chandra Wijaya', 'L', '081255500333', 'Jl. Cendana No.45'),
('P004', 'Dewi Kurnia', 'P', '081255500444', 'Jl. Kenanga No.52'),
('P005', 'Eko Prasetyo', 'L', '081255500555', 'Jl. Flamboyan No.10'),
('P006', 'Fitri Handayani', 'P', '081255500666', 'Jl. Mawar No.8'),
('P007', 'Gilang Ramadhan', 'L', '081255500777', 'Jl. Melati No.19'),
('P008', 'Herlina Putri', 'P', '081255500888', 'Jl. Dahlia No.25'),
('P009', 'Imam Nugroho', 'L', '081255500999', 'Jl. Teratai No.4'),
('P010', 'Jihan Ayu', 'P', '081255501010', 'Jl. Sakura No.17');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int NOT NULL,
  `waktu_bayar` datetime NOT NULL,
  `total` int DEFAULT NULL,
  `metode` enum('TUNAI','TRANSFER','EDC') DEFAULT NULL,
  `transaksi_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `waktu_bayar`, `total`, `metode`, `transaksi_id`) VALUES
(1, '2025-10-01 09:15:00', 23500, 'TUNAI', 1),
(2, '2025-10-02 10:20:00', 41000, 'TRANSFER', 2),
(3, '2025-10-03 11:40:00', 65000, 'EDC', 3),
(4, '2025-10-04 12:10:00', 11500, 'TUNAI', 4),
(5, '2025-10-05 13:00:00', 21500, 'TRANSFER', 5),
(6, '2025-10-06 14:25:00', 43000, 'TUNAI', 6),
(7, '2025-10-07 15:35:00', 32000, 'TRANSFER', 7),
(8, '2025-10-08 16:00:00', 58000, 'EDC', 8),
(9, '2025-10-09 16:45:00', 54000, 'TUNAI', 9),
(10, '2025-10-10 17:30:00', 12500, 'TRANSFER', 10);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `alamat` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `telp`, `alamat`) VALUES
(1, 'PT Cipta Sejahtera', '0218001001', 'Jakarta Timur'),
(2, 'CV Amanah Jaya', '0218001002', 'Surabaya'),
(3, 'PT Karya Mandiri', '0218001003', 'Yogyakarta'),
(4, 'CV Prima Sentosa', '0218001004', 'Bandung'),
(5, 'PT Cahaya Mulia', '0218001005', 'Medan'),
(6, 'CV Mandiri Abadi', '0218001006', 'Tangerang'),
(7, 'PT Berkah Makmur', '0218001007', 'Malang'),
(8, 'CV Cemerlang Sejati', '0218001008', 'Bekasi'),
(9, 'PT Maju Lancar', '0218001009', 'Bali'),
(10, 'CV Sinar Indah', '0218001010', 'Semarang'),
(17, 'Ravi Dian Fahrezi', '0218001010', 'burneh'),
(18, 'Raihan Arya Nova', '0218001010', 'burneh');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int NOT NULL,
  `waktu_transaksi` date NOT NULL,
  `keterangan` text,
  `total` int DEFAULT NULL,
  `pelanggan_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `waktu_transaksi`, `keterangan`, `total`, `pelanggan_id`) VALUES
(1, '2025-10-01', 'Pembelian buku dan pulpen', 23500, 'P001'),
(2, '2025-10-02', 'Pembelian alat tulis kantor', 41000, 'P002'),
(3, '2025-10-03', 'Pembelian kertas dan map', 65000, 'P003'),
(4, '2025-10-04', 'Pembelian penggaris dan lem', 11500, 'P004'),
(5, '2025-10-05', 'Pembelian spidol dan stabilo', 21500, 'P005'),
(6, '2025-10-06', 'Pembelian perlengkapan gambar', 43000, 'P006'),
(7, '2025-10-07', 'Pembelian binder dan buku', 32000, 'P007'),
(8, '2025-10-08', 'Pembelian alat tulis lengkap', 58000, 'P008'),
(9, '2025-10-09', 'Pembelian HVS dan penghapus', 54000, 'P009'),
(10, '2025-10-10', 'Pembelian lem dan pensil', 12500, 'P010');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `transaksi_id` int NOT NULL,
  `barang_id` int NOT NULL,
  `harga` int DEFAULT NULL,
  `qty` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`transaksi_id`, `barang_id`, `harga`, `qty`) VALUES
(1, 1, 7000, 2),
(1, 2, 3500, 1),
(2, 3, 3000, 5),
(2, 4, 2500, 2),
(3, 7, 50000, 1),
(3, 8, 15000, 1),
(4, 5, 6000, 1),
(4, 10, 5500, 1),
(5, 6, 12000, 1),
(5, 9, 9500, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` tinyint NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(35) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` varchar(150) DEFAULT NULL,
  `hp` varchar(20) DEFAULT NULL,
  `level` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `alamat`, `hp`, `level`) VALUES
(1, 'adminutama', 'admin123', 'Admin Satu', 'Jl. Mawar No.99', '0813000101', 1),
(2, 'adminbackup', 'admin123', 'Admin Backup', 'Jl. Melati No.88', '0813000102', 1),
(3, 'kasirandi', 'kasir123', 'Kasir Andika', 'Jl. Flamboyan No.77', '0813000103', 2),
(4, 'kasirbunga', 'kasir123', 'Kasir Bunga', 'Jl. Cempaka No.66', '0813000104', 2),
(5, 'kasirchandra', 'kasir123', 'Kasir Chandra', 'Jl. Dahlia No.55', '0813000105', 2),
(6, 'kasirdewi', 'kasir123', 'Kasir Dewi', 'Jl. Mawar No.44', '0813000106', 2),
(7, 'kasireko', 'kasir123', 'Kasir Eko', 'Jl. Anggrek No.33', '0813000107', 2),
(8, 'kasirfitri', 'kasir123', 'Kasir Fitri', 'Jl. Kenanga No.22', '0813000108', 2),
(9, 'kasirgilang', 'kasir123', 'Kasir Gilang', 'Jl. Cendana No.11', '0813000109', 2),
(10, 'kasirherlina', 'kasir123', 'Kasir Herlina', 'Jl. Sakura No.5', '0813000110', 2);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `transaksi_detail_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_detail_ibfk_2` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
