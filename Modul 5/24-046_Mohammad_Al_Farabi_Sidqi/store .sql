-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 01, 2025 at 10:25 AM
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
  `kode_barang` varchar(20) DEFAULT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `nama_barang`, `harga`, `stok`, `supplier_id`) VALUES
(1, 'BRG001', 'Buku Tulis', 5000.00, 200, 1),
(2, 'BRG002', 'Pulpen', 3000.00, 300, 1),
(3, 'BRG003', 'Pensil', 2500.00, 250, 2),
(4, 'BRG004', 'Penghapus', 2000.00, 150, 2),
(5, 'BRG005', 'Rautan', 1500.00, 100, 3),
(6, 'BRG006', 'Spidol', 7000.00, 180, 4),
(7, 'BRG007', 'Penggaris', 4000.00, 120, 5),
(8, 'BRG008', 'Kertas HVS', 35000.00, 90, 6),
(9, 'BRG009', 'Map Plastik', 2000.00, 140, 7),
(10, 'BRG010', 'Tipe-X', 6000.00, 80, 8);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `jenis_kelamin` char(1) DEFAULT NULL,
  `telp` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `jenis_kelamin`, `telp`, `alamat`) VALUES
(1, 'Andi Pratama', 'L', '081234567890', 'Jakarta'),
(2, 'Siti Nurhaliza', 'P', '081298765432', 'Bandung'),
(3, 'Budi Santoso', 'L', '082134567890', 'Surabaya'),
(4, 'Rina Marlina', 'P', '083123456789', 'Yogyakarta'),
(5, 'Dewi Anggraini', 'P', '081277788899', 'Semarang'),
(6, 'Fajar Nugraha', 'L', '085612345678', 'Depok'),
(7, 'Wulan Fitriani', 'P', '087812345678', 'Bekasi'),
(8, 'Agus Rahman', 'L', '089912345678', 'Bogor'),
(9, 'Tini Rahayu', 'P', '081234998877', 'Malang'),
(10, 'Rudi Hartono', 'L', '082112223334', 'Cirebon');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `waktu_bayar` datetime DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `metode` enum('Tunai','Transfer','EDC') DEFAULT NULL,
  `transaksi_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `waktu_bayar`, `total`, `metode`, `transaksi_id`) VALUES
(1, '2025-10-01 10:15:00', 50000.00, 'Tunai', 1),
(2, '2025-10-02 11:45:00', 75000.00, 'Transfer', 2),
(3, '2025-10-03 12:30:00', 35000.00, 'EDC', 3),
(4, '2025-10-04 13:20:00', 15000.00, 'Tunai', 4),
(5, '2025-10-05 14:10:00', 20000.00, 'Tunai', 5),
(6, '2025-10-06 15:30:00', 10000.00, 'Transfer', 6),
(7, '2025-10-07 16:50:00', 6000.00, 'Tunai', 7),
(8, '2025-10-08 17:10:00', 2000.00, 'EDC', 8),
(9, '2025-10-09 18:40:00', 7000.00, 'Tunai', 9),
(10, '2025-10-10 19:20:00', 120000.00, 'Transfer', 10);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `telp` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `telp`, `alamat`) VALUES
(1, 'PT Maju Jaya', '021777888', 'Jakarta Barat'),
(2, 'CV Berkah Abadi', '022334455', 'Bandung'),
(3, 'UD Sumber Makmur', '031223344', 'Surabaya'),
(4, 'PT Sinar Terang', '024556677', 'Semarang'),
(5, 'CV Tunas Baru', '027445566', 'Yogyakarta'),
(6, 'PT Indo Grosir', '021998877', 'Jakarta Timur'),
(7, 'UD Makmur Sentosa', '031778899', 'Sidoarjo'),
(8, 'PT Bintang Selatan', '061445566', 'Medan'),
(9, 'CV Cahaya Baru', '025188899', 'Bogor'),
(21, 'PTi', '000', 'Jl. SANA1');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `waktu_transaksi` datetime DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `pelanggan_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `waktu_transaksi`, `keterangan`, `total`, `pelanggan_id`) VALUES
(1, '2025-10-01 10:00:00', 'Pembelian alat tulis', 50000.00, 1),
(2, '2025-10-02 11:30:00', 'Pembelian perlengkapan kantor', 75000.00, 2),
(3, '2025-10-03 12:00:00', 'Pembelian kertas HVS', 35000.00, 3),
(4, '2025-10-04 13:15:00', 'Pembelian spidol dan penggaris', 15000.00, 4),
(5, '2025-10-05 14:00:00', 'Pembelian map plastik', 20000.00, 5),
(6, '2025-10-06 15:20:00', 'Pembelian buku dan pensil', 10000.00, 6),
(7, '2025-10-07 16:45:00', 'Pembelian tipe-x', 6000.00, 7),
(8, '2025-10-08 17:00:00', 'Pembelian penghapus', 2000.00, 8),
(9, '2025-10-09 18:30:00', 'Pembelian spidol', 7000.00, 9),
(10, '2025-10-10 19:00:00', 'Pembelian lengkap', 120000.00, 10);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `transaksi_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`transaksi_id`, `barang_id`, `harga`, `qty`) VALUES
(1, 1, 5000.00, 5),
(1, 2, 3000.00, 5),
(2, 3, 2500.00, 10),
(2, 4, 2000.00, 5),
(3, 8, 35000.00, 1),
(4, 6, 7000.00, 2),
(4, 7, 4000.00, 1),
(5, 9, 2000.00, 10),
(6, 1, 5000.00, 2),
(7, 10, 6000.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `hp` varchar(20) DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `alamat`, `hp`, `level`) VALUES
(1, 'admin', 'admin123', 'Administrator', 'Kantor Pusat', '0811111111', 'Admin'),
(2, 'kasir1', 'kasir123', 'Kasir Satu', 'Jakarta', '0822222222', 'Kasir'),
(3, 'kasir2', 'kasir456', 'Kasir Dua', 'Bandung', '0833333333', 'Kasir'),
(4, 'owner', 'owner123', 'Pemilik Toko', 'Surabaya', '0844444444', 'Owner'),
(5, 'user1', 'user111', 'User Satu', 'Depok', '0855555555', 'Staff'),
(6, 'user2', 'user222', 'User Dua', 'Bogor', '0866666666', 'Staff'),
(7, 'user3', 'user333', 'User Tiga', 'Cirebon', '0877777777', 'Staff'),
(8, 'user4', 'user444', 'User Empat', 'Malang', '0888888888', 'Staff'),
(9, 'user5', 'user555', 'User Lima', 'Medan', '0899999999', 'Staff'),
(10, 'user6', 'user666', 'User Enam', 'Padang', '0800000000', 'Staff');

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
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
