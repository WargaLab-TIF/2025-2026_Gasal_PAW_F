-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2025 at 08:48 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
(1, 'BRG-001', 'Indomie Goreng', 3500, 200, 4),
(2, 'BRG-002', 'Sabun Lifebuoy Total 10', 4000, 150, 6),
(3, 'BRG-003', 'Kopi Kapal Api Special 165g', 12000, 100, 8),
(4, 'BRG-004', 'Kecap Bango 550ml', 22000, 80, 4),
(5, 'BRG-005', 'Semen Tiga Roda 40kg', 55000, 50, 5),
(6, 'BRG-006', 'Pepsodent White 190g', 14000, 120, 6),
(7, 'BRG-007', 'Beras Rojolele 5kg', 65000, 70, 7),
(8, 'BRG-008', 'Biskuit Roma Kelapa', 8000, 250, 8),
(9, 'BRG-009', 'Oli Top One 1L', 45000, 60, 9);

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
('PEL-001', 'Budi Santoso', 'L', '085670001', 'Jl. Mawar 1, Bandung'),
('PEL-002', 'Siti Aminah', 'P', '085670002', 'Jl. Melati 2, Bandung'),
('PEL-003', 'Eko Prasetyo', 'L', '085670003', 'Jl. Kamboja 3, Bandung'),
('PEL-004', 'Dewi Lestari', 'P', '085670004', 'Jl. Anggrek 4, Bandung'),
('PEL-005', 'Agus Wijaya', 'L', '085670005', 'Jl. Tulip 5, Bandung'),
('PEL-006', 'Rina Marlina', 'P', '085670006', 'Jl. Dahlia 6, Bandung'),
('PEL-007', 'Hendra Gunawan', 'L', '085670007', 'Jl. Cempaka 7, Bandung'),
('PEL-008', 'Fitri Handayani', 'P', '085670008', 'Jl. Kenanga 8, Bandung'),
('PEL-009', 'Doni Saputra', 'L', '085670009', 'Jl. Flamboyan 9, Bandung'),
('PEL-010', 'Wulan Sari', 'P', '085670010', 'Jl. Bougenville 10, Bandung');

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
(1, '2025-10-30 12:21:11', 7000, 'TUNAI', 1),
(2, '2025-10-30 12:21:11', 4000, 'EDC', 2),
(3, '2025-10-30 12:21:11', 12000, 'TRANSFER', 3),
(4, '2025-10-30 12:21:11', 22000, 'TUNAI', 4),
(5, '2025-10-30 12:21:11', 55000, 'EDC', 5),
(6, '2025-10-30 12:21:11', 14000, 'TRANSFER', 6),
(7, '2025-10-30 12:21:11', 65000, 'TUNAI', 7),
(8, '2025-10-30 12:21:11', 16000, 'EDC', 8),
(9, '2025-10-30 12:21:11', 45000, 'TRANSFER', 9),
(10, '2025-10-30 12:21:11', 60000, 'TUNAI', 10);

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
(1, 'PT. Sinar Abadi', '081230001', 'Jl. Sudirman 12, Jakarta'),
(2, 'CV. Jaya Makmur', '081330002', 'Jl. Pahlawan 22, Surabaya'),
(3, 'UD. Bintang Terang', '081530003', 'Jl. Asia Afrika 34, Bandung'),
(4, 'PT. Indofood Sukses', '081730004', 'Kawasan Industri, Bekasi'),
(5, 'CV. Mega Perkasa', '081830005', 'Jl. Gatot Subroto 5, Medan'),
(6, 'PT. Unilever Indonesia', '081930006', 'Kawasan Industri, Tangerang'),
(7, 'UD. Subur Jaya', '085230007', 'Jl. Pemuda 10, Semarang'),
(8, 'PT. Mayora Indah', '085630008', 'Jl. Raya Sidoarjo 8, Sidoarjo'),
(9, 'CV. Prima Sentosa', '0857300090', 'Jl. Malioboro 1, Yogyakarta');

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
(1, '2025-10-30', 'Beli Indomie 2', 7000, 'PEL-001'),
(2, '2025-10-30', 'Beli Sabun 1', 4000, 'PEL-002'),
(3, '2025-10-30', 'Beli Kopi 1', 12000, 'PEL-003'),
(4, '2025-10-30', 'Beli Kecap 1', 22000, 'PEL-004'),
(5, '2025-10-30', 'Beli Semen 1', 55000, 'PEL-005'),
(6, '2025-10-30', 'Beli Pepsodent 1', 14000, 'PEL-006'),
(7, '2025-10-30', 'Beli Beras 1', 65000, 'PEL-007'),
(8, '2025-10-30', 'Beli Biskuit 2', 16000, 'PEL-008'),
(9, '2025-10-30', 'Beli Oli 1', 45000, 'PEL-009'),
(10, '2025-10-30', 'Beli Rokok 2', 60000, 'PEL-010');

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
(1, 1, 3500, 2),
(2, 2, 4000, 1),
(3, 3, 12000, 1),
(4, 4, 22000, 1),
(5, 5, 55000, 1),
(6, 6, 14000, 1),
(7, 7, 65000, 1),
(8, 8, 8000, 2),
(9, 9, 45000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` tinyint(2) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(35) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `hp` varchar(20) DEFAULT NULL,
  `level` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `hp`, `level`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500', 'Administrator', '087880001', 1),
(2, 'budi.kasir', '32250170a0dca92d53ec9624f336ca24', 'Budi (Kasir)', '087880002', 2),
(3, 'siti.kasir', '32250170a0dca92d53ec9624f336ca24', 'Siti (Kasir)', '087880003', 2),
(4, 'eko.gudang', '303ad311f70e9fb8954877cb370fbb63', 'Eko (Gudang)', '087880004', 2),
(5, 'dewi.finance', 'e14595f44bd87921dc9b297fe58f7a4f', 'Dewi (Keuangan)', '087880005', 2),
(6, 'agus.gudang', '00d73e4cd59b26565b7d8d3a58e98dd7', 'Agus (Gudang)', '087880006', 2),
(7, 'rina.kasir', '32250170a0dca92d53ec9624f336ca24', 'Rina (Kasir)', '087880007', 2),
(8, 'hendra.super', '727dfbdc1a4ee249f3f08c247a5669d5', 'Hendra (Supervisor)', '087880008', 1),
(9, 'doni.ops', 'b19b5b326fb202232b1c1776e79cf301', 'Doni (Operasional)', '087880009', 2),
(10, 'wulan.hrd', '393c7e33e91519e87e1894cbc9dcd8eb', 'Wulan (HRD)', '087880010', 2);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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
