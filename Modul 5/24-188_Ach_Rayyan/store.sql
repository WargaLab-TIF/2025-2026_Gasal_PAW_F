-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Nov 2025 pada 09.34
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
  `kode_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) DEFAULT 0,
  `supplier_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `nama_barang`, `harga`, `stok`, `supplier_id`) VALUES
(1, 'BR001', 'Buku Tulis Spiral', 8500, 100, NULL),
(2, 'BR002', 'Pulpen Gel', 4000, 120, 2),
(3, 'BR003', 'Pensil Mekanik', 6500, 90, 3),
(4, 'BR004', 'Penghapus Karet', 2000, 80, 4),
(5, 'BR005', 'Penggaris Plastik 30cm', 5000, 70, 5),
(6, 'BR006', 'Spidol Warna Hitam', 9500, 75, 6),
(7, 'BR007', 'Kertas HVS A4', 48000, 60, 7),
(8, 'BR008', 'Map Kancing A4', 13000, 50, 8),
(9, 'BR009', 'Highlighter Pastel', 10000, 85, 9),
(10, 'BR010', 'Lem Stick 15gr', 4500, 95, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `jenis_kelamin`, `telp`, `alamat`) VALUES
('P001', 'Rahmat Hadi', 'L', '081222330111', 'Jl. Anggrek No.11'),
('P002', 'Nadia Puspita', 'P', '081222330222', 'Jl. Cendana No.45'),
('P003', 'Rizky Pratama', 'L', '081222330333', 'Jl. Kenanga No.9'),
('P004', 'Sinta Marlina', 'P', '081222330444', 'Jl. Sakura No.6'),
('P005', 'Doni Saputra', 'L', '081222330555', 'Jl. Dahlia No.30'),
('P006', 'Laras Putri', 'P', '081222330666', 'Jl. Flamboyan No.5'),
('P007', 'Bagus Kurniawan', 'L', '081222330777', 'Jl. Nusa Indah No.3'),
('P008', 'Mega Andriani', 'P', '081222330888', 'Jl. Teratai No.17'),
('P009', 'Rangga Nugraha', 'L', '081222330999', 'Jl. Kemuning No.10'),
('P010', 'Citra Ayuningtyas', 'P', '081222331010', 'Jl. Mawar No.2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `waktu_bayar` datetime NOT NULL,
  `total` int(11) DEFAULT NULL,
  `metode` enum('TUNAI','TRANSFER','EDC') DEFAULT NULL,
  `transaksi_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `waktu_bayar`, `total`, `metode`, `transaksi_id`) VALUES
(1, '2025-10-01 09:10:00', 16500, 'TUNAI', 1),
(2, '2025-10-02 10:25:00', 28000, 'TRANSFER', 2),
(3, '2025-10-03 11:45:00', 61000, 'EDC', 3),
(4, '2025-10-04 12:20:00', 9500, 'TUNAI', 4),
(5, '2025-10-05 13:05:00', 19500, 'TRANSFER', 5),
(6, '2025-10-06 14:15:00', 42000, 'TUNAI', 6),
(7, '2025-10-07 15:25:00', 15000, 'TRANSFER', 7),
(8, '2025-10-08 16:05:00', 49000, 'EDC', 8),
(9, '2025-10-09 16:40:00', 61000, 'TUNAI', 9),
(10, '2025-10-10 17:20:00', 6500, 'TRANSFER', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `telp`, `alamat`) VALUES
(2, 'CV Maju Bersama', '0218500102', 'Surabaya'),
(3, 'PT Indo Kreatif', '0218500103', 'Bandung'),
(4, 'CV Sukses Makmur', '0218500104', 'Depok RW 02'),
(5, 'PT Harapan Baru', '0218500105', 'Medan'),
(6, 'CV Aman Sentosa', '0218500106', 'Bekasi'),
(7, 'PT Citra Abadi', '0218500107', 'Yogyakarta'),
(8, 'CV Mega Karya', '0218500108', 'Tangerang'),
(9, 'PT Bumi Sejahtera', '0218500109', 'Bogor'),
(10, 'CV Karya Mulia', '0218500110', 'Bali');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `waktu_transaksi` date NOT NULL,
  `keterangan` text DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `pelanggan_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `waktu_transaksi`, `keterangan`, `total`, `pelanggan_id`) VALUES
(1, '2025-10-01', 'Pembelian alat tulis sekolah', 16500, 'P001'),
(2, '2025-10-02', 'Pembelian perlengkapan kantor', 28000, 'P002'),
(3, '2025-10-03', 'Pembelian map dan kertas', 61000, 'P003'),
(4, '2025-10-04', 'Pembelian penggaris dan lem', 9500, 'P004'),
(5, '2025-10-05', 'Pembelian spidol dan highlighter', 19500, 'P005'),
(6, '2025-10-06', 'Pembelian paket alat gambar', 42000, 'P006'),
(7, '2025-10-07', 'Pembelian buku dan pensil', 15000, 'P007'),
(8, '2025-10-08', 'Pembelian alat tulis lengkap', 49000, 'P008'),
(9, '2025-10-09', 'Pembelian HVS dan map', 61000, 'P009'),
(10, '2025-10-10', 'Pembelian lem dan penghapus', 6500, 'P010');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `transaksi_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `harga` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`transaksi_id`, `barang_id`, `harga`, `qty`) VALUES
(1, 1, 8500, 1),
(1, 2, 4000, 2),
(2, 3, 6500, 2),
(2, 5, 5000, 2),
(3, 7, 48000, 1),
(3, 8, 13000, 1),
(4, 5, 5000, 1),
(4, 10, 4500, 1),
(5, 6, 9500, 1),
(5, 9, 10000, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` tinyint(2) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(35) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` varchar(150) DEFAULT NULL,
  `hp` varchar(20) DEFAULT NULL,
  `level` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `alamat`, `hp`, `level`) VALUES
(1, 'adminutama', 'admin123', 'Admin Utama', 'Jl. Melati No.10', '0813555501', 1),
(2, 'adminbackup', 'admin123', 'Admin Backup', 'Jl. Cempaka No.8', '0813555502', 1),
(3, 'kasirrahmat', 'kasir123', 'Kasir Rahmat', 'Jl. Kenanga No.5', '0813555503', 2),
(4, 'kasirnadia', 'kasir123', 'Kasir Nadia', 'Jl. Dahlia No.7', '0813555504', 2),
(5, 'kasirrizky', 'kasir123', 'Kasir Rizky', 'Jl. Anggrek No.9', '0813555505', 2),
(6, 'kasirsinta', 'kasir123', 'Kasir Sinta', 'Jl. Flamboyan No.11', '0813555506', 2),
(7, 'kasirdoni', 'kasir123', 'Kasir Doni', 'Jl. Mawar No.13', '0813555507', 2),
(8, 'kasirlaras', 'kasir123', 'Kasir Laras', 'Jl. Teratai No.15', '0813555508', 2),
(9, 'kasirbagus', 'kasir123', 'Kasir Bagus', 'Jl. Melur No.17', '0813555509', 2),
(10, 'kasirmega', 'kasir123', 'Kasir Mega', 'Jl. Sakura No.19', '0813555510', 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
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
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `transaksi_detail_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_detail_ibfk_2` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
