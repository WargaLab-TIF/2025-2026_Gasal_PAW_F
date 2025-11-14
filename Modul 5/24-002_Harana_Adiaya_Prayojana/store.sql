-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Okt 2025 pada 13.30
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
(1, 'BRG001', 'Pensil 2B', 2500, 200, 1),
(2, 'BRG002', 'Buku Tulis A5', 8000, 150, 2),
(3, 'BRG003', 'Pulpen Hitam', 3500, 300, 1),
(4, 'BRG004', 'Penggaris 30 cm', 5000, 100, 3),
(5, 'BRG005', 'Penghapus Karet', 2000, 250, 1),
(6, 'BRG006', 'Stabilo 5 Warna', 12000, 80, 4),
(7, 'BRG007', 'Map Kertas', 3500, 180, 2),
(8, 'BRG008', 'Klip Kertas', 1500, 400, 5),
(9, 'BRG009', 'Lakban 2 inch', 7000, 90, 6),
(10, 'BRG010', 'Tipe-X Mini', 3000, 150, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `jenis_kelamin`, `telp`, `alamat`) VALUES
(1, 'Andi Wijaya', 'L', '081234567', 'Jl. Anggrek 12, Jakarta'),
(2, 'Sari Melati', 'P', '082345678', 'Jl. Mawar 5, Bogor'),
(3, 'Bambang S', 'L', '083456789', 'Jl. Kamboja 9, Depok'),
(4, 'Dewi Kusuma', 'P', '084567890', 'Jl. Melati 21, Tangerang'),
(5, 'Rizki Ramadhan', 'L', '085678901', 'Jl. Teratai 3, Bekasi'),
(6, 'Fitri Ayu', 'P', '086789012', 'Jl. Flamboyan 7, Bandung'),
(7, 'Hendra P', 'L', '087890123', 'Jl. Cempaka 15, Malang'),
(8, 'Lusi Amanda', 'P', '088901234', 'Jl. Seroja 8, Surabaya'),
(9, 'Agus Salim', 'L', '089012345', 'Jl. Dahlia 10, Yogyakarta'),
(10, 'Maya Sinta', 'P', '081112345', 'Jl. Tulip 6, Semarang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `waktu_bayar` datetime NOT NULL,
  `total` int(11) NOT NULL,
  `metode` enum('TUNAI','TRANSFER','EDC') NOT NULL,
  `transaksi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `waktu_bayar`, `total`, `metode`, `transaksi_id`) VALUES
(1, '2025-06-01 09:15:00', 45000, 'TUNAI', 1),
(2, '2025-06-01 10:20:00', 18000, 'TRANSFER', 2),
(3, '2025-06-02 08:45:00', 95000, 'EDC', 3),
(4, '2025-06-02 14:30:00', 22000, 'TUNAI', 4),
(5, '2025-06-03 09:00:00', 120000, 'TRANSFER', 5),
(6, '2025-06-03 11:10:00', 37000, 'TUNAI', 6),
(7, '2025-06-04 13:25:00', 63000, 'EDC', 7),
(8, '2025-06-04 16:40:00', 28000, 'TUNAI', 8),
(9, '2025-06-05 10:05:00', 150000, 'TRANSFER', 9),
(10, '2025-06-05 18:50:00', 19000, 'TUNAI', 10);

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
(1, 'PT. Sejahtera Abadi', '021556677', 'Jl. Industri Raya Kav.10, Jakarta'),
(2, 'CV. Maju Jaya', '022334455', 'Jl. Ahmad Yani 45, Bandung'),
(3, 'UD. Sumber Rejeki', '023445566', 'Jl. Sudirman 123, Semarang'),
(4, 'PT. Global Media', '024554433', 'Jl. Gajah Mada 78, Yogyakarta'),
(5, 'CV. Mandiri Sentosa', '025667788', 'Jl. Pahlawan 99, Surabaya'),
(6, 'PT. Karya Cipta', '026778899', 'Jl. Merdeka 55, Malang'),
(7, 'UD. Barokah', '027889900', 'Jl. Diponegoro 67, Solo'),
(8, 'CV. Tiga Saudara', '028990011', 'Jl. Imam Bonjol 88, Bogor'),
(9, 'PT. Harapan Baru', '029111222', 'Jl. Siliwangi 34, Tasik'),
(10, 'UD. Berkah Selalu', '021333444', 'Jl. Cendana 12, Bekasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `waktu_transaksi` date DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `total` int(11) DEFAULT 0,
  `pelanggan_id` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `waktu_transaksi`, `keterangan`, `total`, `pelanggan_id`) VALUES
(1, '2025-06-01', 'Belanja bulanan', 45000, 1),
(2, '2025-06-01', 'Belanja dadakan', 18000, 2),
(3, '2025-06-02', 'Restock kantor', 95000, 3),
(4, '2025-06-02', 'Belanja pribadi', 22000, 4),
(5, '2025-06-03', 'Event sekolah', 120000, 5),
(6, '2025-06-03', 'Belanja rutin', 37000, 6),
(7, '2025-06-04', 'Kebutuhan kantor', 63000, 7),
(8, '2025-06-04', 'Belanja mingguan', 28000, 8),
(9, '2025-06-05', 'Donor alat tulis', 150000, 9),
(10, '2025-06-05', 'Belanja cepat', 19000, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `transaksi_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`transaksi_id`, `barang_id`, `harga`, `qty`) VALUES
(1, 1, 2500, 5),
(1, 2, 8000, 2),
(1, 3, 3500, 4),
(2, 4, 5000, 1),
(2, 5, 2000, 3),
(3, 6, 12000, 2),
(3, 7, 3500, 3),
(4, 8, 1500, 2),
(4, 9, 7000, 2),
(5, 10, 3000, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `_user`
--

CREATE TABLE `_user` (
  `id_user` tinyint(2) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(35) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(150) DEFAULT NULL,
  `hp` varchar(20) DEFAULT NULL,
  `level` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `_user`
--

INSERT INTO `_user` (`id_user`, `username`, `password`, `nama`, `alamat`, `hp`, `level`) VALUES
(1, 'kasir1', '202cb962ac59075b964b07152d234b70', 'Siti Nurhaliza', 'Jl. Melati 12', '081234567890', 1),
(2, 'kasir2', '202cb962ac59075b964b07152d234b70', 'Budi Santoso', 'Jl. Kencana 5', '082345678901', 1),
(3, 'admin', '202cb962ac59075b964b07152d234b70', 'Admin Gudang', 'Jl. Mawar 88', '083456789012', 0),
(4, 'manajer', '202cb962ac59075b964b07152d234b70', 'Rina Kartika', 'Jl. Anggrek 21', '084567890123', 0),
(5, 'owner', '202cb962ac59075b964b07152d234b70', 'Bapak Hadi', 'Jl. Seroja 9', '085678901234', 0),
(6, 'kasir3', '202cb962ac59075b964b07152d234b70', 'Dewi Lestari', 'Jl. Cempaka 14', '086789012345', 1),
(7, 'kasir4', '202cb962ac59075b964b07152d234b70', 'Agus Prasetyo', 'Jl. Flamboyan 7', '087890123456', 1),
(8, 'gudang', '202cb962ac59075b964b07152d234b70', 'Iwan S', 'Jl. Tulip 11', '088901234567', 1),
(9, 'spv', '202cb962ac59075b964b07152d234b70', 'Sari Melati', 'Jl. Dahlia 3', '089012345678', 0),
(10, 'cs', '202cb962ac59075b964b07152d234b70', 'Rizky Ramadhan', 'Jl. Kenanga 6', '081112345678', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_barang` (`kode_barang`),
  ADD KEY `fk_barang_supplier` (`supplier_id`);

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
  ADD KEY `fk_bayar_transaksi` (`transaksi_id`);

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
  ADD KEY `fk_detail_barang` (`barang_id`);

--
-- Indeks untuk tabel `_user`
--
ALTER TABLE `_user`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `_user`
--
ALTER TABLE `_user`
  MODIFY `id_user` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `fk_barang_supplier` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `fk_bayar_transaksi` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `pelanggan_id` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `fk_detail_barang` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detail_transaksi` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
