-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2025 at 04:59 PM
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
-- Database: `kasir`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `id_supplier` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `kode_barang`, `nama_barang`, `harga`, `stok`, `id_supplier`) VALUES
(1, 'BRG001', 'Beras Premium', 100000, 50, 1),
(2, 'BRG002', 'Minyak Goreng', 30000, 200, 2),
(3, 'BRG003', 'Gula Pasir', 15000, 150, 1),
(4, 'BRG004', 'Tepung Terigu', 12000, 100, 2),
(5, 'BRG005', 'Telur Ayam', 25000, 200, 3),
(6, 'BRG006', 'Daging Sapi', 120000, 20, 4),
(7, 'BRG007', 'Susu Cair', 15000, 50, 5),
(8, 'BRG008', 'Kopi Bubuk', 35000, 80, 3),
(9, 'BRG009', 'Gula Merah', 20000, 60, 2),
(10, 'BRG010', 'Tepung Maizena', 18000, 70, 5);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `alamat` text DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `alamat`, `no_telp`) VALUES
(1, 'Budi Santoso', 'Jl. Merdeka No. 10, Surabaya', '081234567890'),
(2, 'Rina Agustina', 'Jl. Kartini No. 5, Malang', '081298765432'),
(3, 'Joko Purwanto', 'Jl. Sudirman No. 88, Sidoarjo', '081345678901'),
(4, 'Dewi Kurniasih', 'Jl. Diponegoro No. 12, Gresik', '085678901234'),
(5, 'Agus Supriyadi', 'Jl. Ahmad Yani No. 45, Surabaya', '081567890123'),
(6, 'Siti Fadilah', 'Jl. Pahlawan No. 3, Mojokerto', '087812345678'),
(7, 'Ahmad Rafi', 'Jl. Imam Bonjol No. 21, Pasuruan', '089612345678');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(100) NOT NULL,
  `alamat` text DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `alamat`, `no_telp`) VALUES
(1, 'PT. Sumber Berkah', 'Jl. Raya No. 1, Jakarta', '08123456789'),
(2, 'CV. Maju Jaya', 'Jl. Industri No. 5, Surabaya', '08198765432'),
(3, 'PT. Agro Lestari', 'Jl. Tani Makmur, Bandung', '08567891234'),
(4, 'UD. Sumber Makmur', 'Jl. Pasar Besar, Malang', '087755667788'),
(5, 'CV. Sentosa Abadi', 'Jl. Veteran No. 45, Semarang', '081345678900');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `waktu_transaksi` date NOT NULL,
  `keterangan` text DEFAULT NULL,
  `total` int(11) DEFAULT 0,
  `id_pelanggan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `waktu_transaksi`, `keterangan`, `total`, `id_pelanggan`) VALUES
(1, '2024-10-22', 'Belanja Bulanan', 245000, 1),
(2, '2024-10-23', 'Kebutuhan Dapur', 90000, 2),
(3, '2024-10-23', 'Stok Warung', 130000, 3),
(4, '2024-10-23', 'Eceran', 36000, 4),
(5, '2024-10-24', 'Hajatan', 280000, 5),
(6, '2024-10-24', 'Donasi', 140000, 6),
(7, '2024-10-24', 'Pribadi', 90000, 7);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `id_transaksi_detail` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`id_transaksi_detail`, `id_transaksi`, `id_barang`, `harga`, `qty`) VALUES
(1, 1, 1, 200000, 2),
(2, 1, 3, 45000, 3),
(3, 2, 2, 90000, 3),
(4, 3, 5, 100000, 4),
(5, 3, 7, 30000, 2),
(6, 4, 4, 36000, 3),
(7, 5, 6, 240000, 2),
(8, 5, 9, 40000, 2),
(9, 6, 8, 140000, 4),
(10, 7, 10, 90000, 5);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text DEFAULT NULL,
  `hp` varchar(20) DEFAULT NULL,
  `level` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `alamat`, `hp`, `level`) VALUES
(1, 'budi', '$2y$10$evM8WGeozayIlWfnBW42p.Fknss5wFnhaid1bgnQjzsoxATq1hzb2', 'Budi', 'Sawahan, Nganjuk, Jawa Timur', '085232900000', 1),
(3, 'caca', '$2y$10$Nl3/Vo4JuJFIDf/aFuIe7uurluHKS5ua3u3o7KugikXQCBl99X5Zy', 'Caca', 'Kerajan, Kediri, Jawa Timur', '088232343', 2),
(8, 'Raihan', '$2y$10$NrXBNmqIld6/Q6LuTqp3e.b8XAcp0AacMrM4MxmsDRfGXtXasaIyO', 'Raihan Aryanova Narendra', NULL, NULL, 1),
(9, 'orang', '$2y$10$hgHrpyy1rskq.SBN18I6nOo0vVlzpKJ2AVUSFWlsj2XqZB8ZuCmr6', 'orang hitam', NULL, NULL, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD UNIQUE KEY `kode_barang` (`kode_barang`),
  ADD KEY `fk_barang_supplier` (`id_supplier`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`id_transaksi_detail`),
  ADD UNIQUE KEY `unique_barang_transaksi` (`id_transaksi`,`id_barang`),
  ADD KEY `id_barang` (`id_barang`);

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
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  MODIFY `id_transaksi_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `fk_barang_supplier` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`);

--
-- Constraints for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `transaksi_detail_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_detail_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
