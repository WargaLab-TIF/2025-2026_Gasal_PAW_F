-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 07 Nov 2025 pada 16.12
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

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
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga` decimal(12,2) NOT NULL,
  `stok` int(11) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `nama_barang`, `harga`, `stok`, `supplier_id`) VALUES
(1, 'BRG001', 'Laptop Lenovo', 7500000.00, 15, 1),
(2, 'BRG002', 'Mouse Logitech', 150000.00, 40, 2),
(3, 'BRG003', 'Keyboard Mechanical', 300000.00, 25, 3),
(4, 'BRG004', 'Monitor 24 Inch', 2000000.00, 10, 4),
(5, 'BRG005', 'Flashdisk 32GB', 75000.00, 100, 5),
(6, 'BRG006', 'Harddisk 1TB', 900000.00, 30, 6),
(7, 'BRG007', 'Printer Canon', 1200000.00, 8, 7),
(8, 'BRG008', 'Speaker Bluetooth', 250000.00, 20, 8),
(9, 'BRG009', 'Webcam HD', 500000.00, 12, 9),
(10, 'BRG010', 'Headset Gaming', 350000.00, 18, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `telp` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `jenis_kelamin`, `telp`, `alamat`) VALUES
(1, 'Andi', 'L', '081234567890', 'Jl. Merdeka No. 1'),
(2, 'Budi', 'L', '081234567891', 'Jl. Sudirman No. 5'),
(3, 'Citra', 'P', '081234567892', 'Jl. Ahmad Yani No. 9'),
(4, 'Dewi', 'P', '081234567893', 'Jl. Mawar No. 7'),
(5, 'Eka', 'L', '081234567894', 'Jl. Kenanga No. 3'),
(6, 'Farah', 'P', '081234567895', 'Jl. Melati No. 8'),
(7, 'Gilang', 'L', '081234567896', 'Jl. Dahlia No. 4'),
(8, 'Hana', 'P', '081234567897', 'Jl. Sakura No. 6'),
(9, 'Indra', 'L', '081234567898', 'Jl. Cemara No. 2'),
(10, 'Joko', 'L', '081234567899', 'Jl. Flamboyan No. 10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `waktu_bayar` datetime NOT NULL,
  `total` decimal(12,2) DEFAULT NULL,
  `metode` enum('Tunai','Transfer','EDC') NOT NULL,
  `transaksi_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `waktu_bayar`, `total`, `metode`, `transaksi_id`) VALUES
(1, '2025-10-01 10:10:00', 2000000.00, 'Tunai', 1),
(2, '2025-10-02 11:40:00', 450000.00, 'EDC', 2),
(3, '2025-10-03 12:30:00', 7500000.00, 'Transfer', 3),
(4, '2025-10-04 14:00:00', 1200000.00, 'Tunai', 4),
(5, '2025-10-05 14:30:00', 450000.00, 'Tunai', 5),
(6, '2025-10-06 15:40:00', 350000.00, 'EDC', 6),
(7, '2025-10-07 17:00:00', 2000000.00, 'Transfer', 7),
(8, '2025-10-08 10:00:00', 900000.00, 'Tunai', 8),
(9, '2025-10-09 10:45:00', 500000.00, 'EDC', 9),
(10, '2025-10-10 12:00:00', 75000.00, 'Tunai', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `telp` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `telp`, `alamat`) VALUES
(1, 'PT Maju Jaya', '081111111111', 'Jl. Merdeka No. 1, Jakarta'),
(2, 'CV Sukses Abadi', '081222222222', 'Jl. Sudirman No. 25, Bandung'),
(3, 'UD Sentosa', '081333333333', 'Jl. Ahmad Yani No. 10A, Surabaya'),
(4, 'PT Makmur Sejahtera', '081444444444', 'Jl. Mawar No. 7, Medan'),
(5, 'CV IndoTech', '081555555555', 'Jl. Kenanga No. 3B, Yogyakarta'),
(6, 'PT Prima Nusantara', '081666666666', 'Jl. Melati No. 8, Malang'),
(7, 'PT Mega Elektronik', '081777777777', 'Jl. Dahlia No. 4C, Semarang'),
(8, 'UD Harapan Baru', '081888888888', 'Jl. Sakura No. 6, Denpasar'),
(9, 'CV Berkah Jaya', '081999999999', 'Jl. Cemara No. 2, Makassar'),
(10, 'PT Globalindo', '081000000000', 'Jl. Flamboyan No. 10, Balikpapan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `waktu_transaksi` datetime NOT NULL,
  `keterangan` text DEFAULT NULL,
  `total` decimal(12,2) DEFAULT NULL,
  `pelanggan_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `waktu_transaksi`, `keterangan`, `total`, `pelanggan_id`) VALUES
(1, '2025-10-01 10:00:00', 'Pembelian perangkat elektronik', 2000000.00, 1),
(2, '2025-10-02 11:30:00', 'Pembelian aksesori komputer', 600000.00, 2),
(3, '2025-10-03 12:15:00', 'Pembelian laptop', 7500000.00, 3),
(4, '2025-10-04 13:45:00', 'Pembelian printer', 1200000.00, 4),
(5, '2025-10-05 14:10:00', 'Pembelian mouse dan keyboard', 450000.00, 5),
(6, '2025-10-06 15:20:00', 'Pembelian headset', 350000.00, 6),
(7, '2025-10-07 16:50:00', 'Pembelian monitor', 2000000.00, 7),
(8, '2025-10-08 09:40:00', 'Pembelian harddisk', 900000.00, 8),
(9, '2025-10-09 10:30:00', 'Pembelian webcam', 500000.00, 9),
(10, '2025-10-10 11:50:00', 'Pembelian flashdisk', 75000.00, 10),
(11, '2025-11-19 10:00:00', 'Pembelian laptop', 15000000.00, 1),
(12, '2025-11-12 13:30:00', 'Pembelian laptop dan printer', 8700000.00, 6),
(13, '2025-11-12 14:00:00', 'Pembelian monitor', 4000000.00, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `transaksi_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `harga` decimal(12,2) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`transaksi_id`, `barang_id`, `harga`, `qty`) VALUES
(1, 4, 2000000.00, 1),
(2, 2, 300000.00, 2),
(2, 3, 300000.00, 1),
(3, 1, 7500000.00, 1),
(4, 7, 1200000.00, 1),
(5, 2, 150000.00, 1),
(5, 3, 300000.00, 1),
(6, 10, 350000.00, 1),
(7, 4, 2000000.00, 1),
(8, 6, 900000.00, 1),
(9, 9, 500000.00, 1),
(10, 5, 75000.00, 1),
(11, 1, 15000000.00, 2),
(12, 1, 7500000.00, 1),
(12, 7, 1200000.00, 1),
(13, 4, 4000000.00, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `hp` varchar(20) DEFAULT NULL,
  `level` enum('admin','kasir','manager') DEFAULT 'kasir'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `alamat`, `hp`, `level`) VALUES
(1, 'admin1', 'admin123', 'Admin Utama', 'Jakarta', '0812000001', 'admin'),
(2, 'kasir1', 'kasir123', 'Kasir A', 'Bandung', '0812000002', 'kasir'),
(3, 'kasir2', 'kasir456', 'Kasir B', 'Surabaya', '0812000003', 'kasir'),
(4, 'manager1', 'manager123', 'Manager Penjualan', 'Medan', '0812000004', 'manager'),
(5, 'admin2', 'admin456', 'Admin Backup', 'Yogyakarta', '0812000005', 'admin'),
(6, 'kasir3', 'kasir789', 'Kasir C', 'Malang', '0812000006', 'kasir'),
(7, 'admin3', 'admin789', 'Admin 3', 'Semarang', '0812000007', 'admin'),
(8, 'kasir4', 'kasir147', 'Kasir D', 'Denpasar', '0812000008', 'kasir'),
(9, 'manager2', 'manager456', 'Manager 2', 'Makassar', '0812000009', 'manager'),
(10, 'kasir5', 'kasir258', 'Kasir E', 'Balikpapan', '0812000010', 'kasir');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_barang` (`kode_barang`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_id` (`transaksi_id`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelanggan_id` (`pelanggan_id`);

--
-- Indeks untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`transaksi_id`,`barang_id`),
  ADD KEY `barang_id` (`barang_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`);

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`);

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`);

--
-- Ketidakleluasaan untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `transaksi_detail_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`),
  ADD CONSTRAINT `transaksi_detail_ibfk_2` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;