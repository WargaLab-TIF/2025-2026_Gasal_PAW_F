-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 31, 2025 at 01:42 PM
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
  `kode_barang` varchar(10) DEFAULT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `harga` int DEFAULT NULL,
  `stok` int DEFAULT NULL,
  `supplier_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `nama_barang`, `harga`, `stok`, `supplier_id`) VALUES
(1, 'ATK001', 'Buku Tulis 50 Lbr', 5000, 100, 1),
(2, 'ATK002', 'Pulpen Standard AE7', 2500, 200, 2),
(3, 'ATK003', 'Pensil 2B', 3000, 150, 3),
(4, 'ATK004', 'Penghapus', 1500, 300, 4),
(5, 'MKN001', 'Indomie Goreng', 3000, 500, 5),
(6, 'MKN002', 'Crispy Crackers', 10000, 120, 6),
(7, 'MKN003', 'Biskuit Roma', 8000, 80, 7),
(8, 'AM001', 'Sabun Mandi', 4000, 90, 8),
(9, 'AM002', 'Shampoo 170ml', 18000, 70, 9),
(10, 'AM003', 'Sikat Gigi', 7000, 110, 10);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` varchar(20) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `alamat` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `jenis_kelamin`, `telp`, `alamat`) VALUES
('PLG001', 'Andi Wijaya', 'L', '08561111001', 'Jl. Mawar No. 1A, Jakarta'),
('PLG002', 'Bunga Citra', 'P', '08561111002', 'Jl. Melati No. 2B, Jakarta'),
('PLG003', 'Sari Sutena', 'P', '08561111003', 'Jl. Kencana No. 3C, Bandung'),
('PLG004', 'Dewi Lestari', 'P', '08561111004', 'Jl. Anggrek No. 4D, Bandung'),
('PLG005', 'Eko Prasetyo', 'L', '08561111005', 'Jl. Flamboyan No. 5E, Surabaya'),
('PLG006', 'Fitri Handayani', 'P', '08561111006', 'Jl. Kenanga No. 6F, Surabaya'),
('PLG007', 'Gilang Ramadhan', 'L', '08561111007', 'Jl. Dahlia No. 7G, Yogyakarta'),
('PLG008', 'Hana Permata', 'P', '08561111008', 'Jl. Seruni No. 8H, Yogyakarta'),
('PLG009', 'Indra Setiawan', 'L', '08561111009', 'Jl. Teratai No. 9I, Semarang'),
('PLG010', 'Jasmine Aurelia', 'P', '08561111010', 'Jl. Tulip No. 10J, Semarang');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int NOT NULL,
  `waktu_bayar` datetime DEFAULT NULL,
  `total` int DEFAULT NULL,
  `metode` enum('TUNAI','TRANSFER','EDC') DEFAULT NULL,
  `transaksi_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `waktu_bayar`, `total`, `metode`, `transaksi_id`) VALUES
(1, '2025-10-01 10:05:00', 10000, 'TUNAI', 1),
(2, '2025-10-02 11:10:00', 2500, 'EDC', 2),
(3, '2025-10-03 12:15:00', 9000, 'TRANSFER', 3),
(4, '2025-10-04 13:20:00', 1500, 'TUNAI', 4),
(5, '2025-10-05 14:25:00', 15000, 'EDC', 5),
(6, '2025-10-06 15:30:00', 10000, 'TRANSFER', 6),
(7, '2025-10-07 16:35:00', 8000, 'TUNAI', 7),
(8, '2025-10-08 17:40:00', 16000, 'EDC', 8),
(9, '2025-10-09 18:45:00', 18000, 'TUNAI', 9),
(10, '2025-10-10 19:50:00', 7000, 'TRANSFER', 10);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `alamat` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `telp`, `alamat`) VALUES
(1, 'PT. Sinar Jaya Abadi', '08123456001', 'Jl. Sudirman No. 1, Jakarta'),
(2, 'CV. Makmur Sentosa', '08123456002', 'Jl. Thamrin No. 2, Jakarta'),
(3, 'Toko ATK Bersama', '08123456003', 'Jl. Merdeka No. 3, Bandung'),
(4, 'PT. Indo Pangan', '08123456004', 'Jl. Asia Afrika No. 4, Bandung'),
(5, 'CV. Sumber Rejeki', '08123456005', 'Jl. Gajah Mada No. 5, Surabaya'),
(6, 'PT. Cahaya Terang', '08123456006', 'Jl. Diponegoro No. 6, Surabaya'),
(7, 'Warung Grosir Pak Budi', '08123456007', 'Jl. Pahlawan No. 7, Yogyakarta'),
(8, 'PT. Cipta Boga', '08123456008', 'Jl. Malioboro No. 8, Yogyakarta'),
(9, 'CV. Mitra Usaha', '08123456009', 'Jl. Pemuda No. 9, Semarang'),
(10, 'Toko Kelontong Sejahtera', '08123456010', 'Jl. Pandanaran No. 10, Semarang');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int NOT NULL,
  `waktu_transaksi` date DEFAULT NULL,
  `keterangan` text,
  `total` int DEFAULT NULL,
  `pelanggan_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `waktu_transaksi`, `keterangan`, `total`, `pelanggan_id`) VALUES
(1, '2025-10-01', 'Beli buku', 10000, 'PLG001'),
(2, '2025-10-02', 'Beli pulpen', 2500, 'PLG002'),
(3, '2025-10-03', 'Beli pensil', 9000, 'PLG003'),
(4, '2025-10-04', 'Beli penghapus', 1500, 'PLG004'),
(5, '2025-10-05', 'Beli Indomie', 15000, 'PLG005'),
(6, '2025-10-06', 'Beli Crackers', 10000, 'PLG006'),
(7, '2025-10-07', 'Beli biskuit', 8000, 'PLG007'),
(8, '2025-10-08', 'Beli sabun', 16000, 'PLG008'),
(9, '2025-10-09', 'Beli shampoo', 18000, 'PLG009'),
(10, '2025-10-10', 'Beli sikat gigi', 7000, 'PLG010');

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
(1, 1, 5000, 2),
(2, 2, 2500, 1),
(3, 3, 3000, 3),
(4, 4, 1500, 1),
(5, 5, 3000, 5),
(6, 6, 10000, 2),
(7, 7, 8000, 1),
(8, 8, 4000, 4),
(9, 9, 18000, 1),
(10, 10, 7000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` tinyint NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(35) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` varchar(150) DEFAULT NULL,
  `hp` varchar(20) DEFAULT NULL,
  `level` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `alamat`, `hp`, `level`) VALUES
(1, 'admin', 'admin123', 'Administrator', 'Kantor Pusat', '0811000001', 1),
(2, 'kasir1', 'budi123', 'Budi Kasir', 'Meja Kasir 1', '0811000002', 2),
(3, 'kasir2', 'siti123', 'Siti Kasir', 'Meja Kasir 2', '0811000003', 2),
(4, 'gudang1', 'eko123', 'Eko Gudang', 'Area Gudang', '0811000004', 3),
(5, 'manager', 'dewi123', 'Dewi Manajer', 'Ruang Manajer', '0811000005', 1),
(6, 'audit1', 'hana123', 'Hana Auditor', 'Ruang Audit', '0811000006', 4),
(7, 'kasir3', 'gilang123', 'Gilang Kasir', 'Meja Kasir 3', '0811000007', 2),
(8, 'gudang2', 'indra123', 'Indra Gudang', 'Area Gudang 2', '0811000008', 3),
(9, 'owner', 'jasmine123', 'Jasmine Owner', 'Ruang Owner', '0811000009', 1),
(10, 'it_support', 'sari123', 'Sari IT', 'Ruang Server', '0811000010', 1);

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
