-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 04, 2025 at 02:46 PM
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
  `stok` int NOT NULL,
  `supplier_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `nama_barang`, `harga`, `stok`, `supplier_id`) VALUES
(11, 'KB001', 'Laptop Acer', 7000000, 12, 1),
(12, 'KB002', 'Mouse Logitech', 150000, 54, 2),
(13, 'KB003', 'Keyboard Mechanical', 350000, 30, 1),
(14, 'KB004', 'Monitor Samsung 24\"', 1400000, 20, 3),
(15, 'KB005', 'Printer Epson', 900000, 15, 4),
(16, 'KB006', 'Flashdisk 32GB', 120000, 100, 2),
(17, 'KB007', 'Harddisk External 1TB', 850000, 25, 5),
(18, 'KB008', 'Headphone Sony', 400000, 18, 3),
(19, 'KB009', 'Router TP-Link', 650000, 14, 2),
(20, 'KB010', 'Webcam HD', 350000, 16, 1);

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
('PLG001', 'Andi Wijaya', 'L', '081234567890', 'Jl. Merpati No. 5, Surabaya'),
('PLG002', 'Sari Dewi', 'P', '081298765432', 'Jl. Melati No. 10, Malang'),
('PLG003', 'Budi Santoso', 'L', '081212345678', 'Jl. Kenanga No. 7, Sidoarjo'),
('PLG004', 'Dewi Lestari', 'P', '081287654321', 'Jl. Anggrek No. 3, Kediri'),
('PLG005', 'Eko Prasetyo', 'L', '081223344556', 'Jl. Flamboyan No. 12, Jember'),
('PLG006', 'Fitri Handayani', 'P', '081234443322', 'Jl. Dahlia No. 8, Blitar'),
('PLG007', 'Gunawan Saputra', 'L', '081298877665', 'Jl. Cempaka No. 15, Madiun'),
('PLG008', 'Hanna Putri', 'P', '081299988877', 'Jl. Bougenville No. 9, Pasuruan'),
('PLG009', 'Iqbal Maulana', 'L', '081211122233', 'Jl. Sawo No. 1, Probolinggo'),
('PLG010', 'Julia Rahmawati', 'P', '081233344455', 'Jl. Kenari No. 6, Banyuwangi');

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
(1, '2025-10-25 10:30:00', 500000, 'TUNAI', 1),
(2, '2025-10-26 14:15:00', 750000, 'TRANSFER', 2),
(3, '2025-10-27 09:00:00', 300000, 'EDC', 3),
(4, '2025-10-27 16:45:00', 450000, 'TUNAI', 4),
(5, '2025-10-28 11:20:00', 600000, 'TRANSFER', 5),
(6, '2025-10-29 13:05:00', 250000, 'EDC', 6),
(7, '2025-10-29 15:30:00', 900000, 'TUNAI', 7),
(8, '2025-10-30 10:10:00', 700000, 'TRANSFER', 8),
(9, '2025-10-30 12:50:00', 850000, 'EDC', 9),
(10, '2025-10-30 18:00:00', 400000, 'TUNAI', 10);

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
(1, 'PT. Sukamaju', '089765445665', 'Jalan Pahlawan No 14'),
(2, 'Pt Bank Mandiri', '089765445665', 'Jalan Gunung Semeru No. 20'),
(3, 'UD Kencana Abadi', '081212345678', 'Jalan Gunung Arjuno No. 12'),
(4, 'PT Prima Karya', '081287654321', 'Jalan Gunung Raung No. 20'),
(5, 'CV Berkah Sentosa', '081223344556', 'Jalan Gunung Welirang No. 9'),
(6, 'UD Cahaya Mulia', '081234443322', 'Jalan Gunung Argopuro No. 17'),
(7, 'PT Harmoni Sejati', '081298877665', 'Jalan Gunung Kelud No. 5'),
(8, 'CV Mitra Jaya', '081299988877', 'Jalan Gunung Ijen No. 11'),
(9, 'UD Bintang Timur', '081211122233', 'Jalan Gunung Panderman No. 25'),
(10, 'PT Surya Abadi', '081233344455', 'Jalan Gunung Lawu No. 14');

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
(1, '2025-10-25', 'Penjualan produk skincare', 500000, 'PLG001'),
(2, '2025-10-26', 'Penjualan pakaian dan aksesoris', 750000, 'PLG002'),
(3, '2025-10-27', 'Penjualan makanan dan minuman', 300000, 'PLG003'),
(4, '2025-10-28', 'Penjualan alat elektronik', 600000, 'PLG004'),
(5, '2025-10-29', 'Penjualan kosmetik', 450000, 'PLG005'),
(6, '2025-10-30', 'Penjualan sepatu dan sandal', 700000, 'PLG006'),
(7, '2025-10-31', 'Penjualan buku dan alat tulis', 250000, 'PLG007'),
(8, '2025-11-01', 'Penjualan mainan anak', 400000, 'PLG008'),
(9, '2025-11-02', 'Penjualan perlengkapan rumah', 550000, 'PLG009'),
(10, '2025-11-03', 'Penjualan peralatan dapur', 620000, 'PLG010');

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
(1, 1, 250000, 2),
(2, 2, 75000, 4),
(3, 3, 500000, 1),
(4, 4, 45000, 3),
(5, 5, 150000, 2),
(6, 6, 120000, 1),
(7, 7, 200000, 2),
(8, 8, 90000, 5),
(9, 9, 300000, 1),
(10, 10, 85000, 3);

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
(1, 'andiw', 'pass12345', 'Andi Wijaya', 'Jalan Merpati No. 12, Surabaya', '081234567890', 1),
(2, 'sari_d', 'pwd67890', 'Sari Dewi', 'Jalan Melati No. 9, Malang', '081298765432', 2),
(3, 'budi_s', 'budipass', 'Budi Santoso', 'Jalan Kenari No. 14, Sidoarjo', '081212345678', 2),
(4, 'dewil', 'dewipass01', 'Dewi Lestari', 'Jalan Anggrek No. 7, Kediri', '081287654321', 1),
(5, 'eko_p', 'ekopass007', 'Eko Prasetyo', 'Jalan Flamboyan No. 5, Jember', '081223344556', 2),
(6, 'fitrih', 'fitripass', 'Fitri Handayani', 'Jalan Dahlia No. 11, Blitar', '081234443322', 1),
(7, 'gunawans', 'gunapass12', 'Gunawan Saputra', 'Jalan Cempaka No. 6, Madiun', '081298877665', 2),
(8, 'hannap', 'hannapass9', 'Hanna Putri', 'Jalan Bougenville No. 8, Pasuruan', '081299988877', 1),
(9, 'iqbalm', 'iqbalpwd', 'Iqbal Maulana', 'Jalan Sawo No. 3, Probolinggo', '081211122233', 1),
(10, 'juliar', 'juliapass', 'Julia Rahmawati', 'Jalan Kenari No. 13, Banyuwangi', '081233344455', 2);

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
  ADD PRIMARY KEY (`transaksi_id`),
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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  MODIFY `transaksi_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  ADD CONSTRAINT `transaksi_detail_ibfk_1` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`),
  ADD CONSTRAINT `transaksi_detail_ibfk_2` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
