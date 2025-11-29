-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Nov 2025 pada 01.39
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
-- Database: `penjualan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id`, `nama_barang`, `harga`, `stok`, `supplier_id`) VALUES
(1, 'Buku Tulis', 5000, 100, 1),
(2, 'Pulpen', 3000, 200, 1),
(3, 'Penghapus', 2000, 150, 2),
(4, 'Pensil', 2500, 120, 2),
(5, 'Penggaris', 4000, 80, 3),
(7, 'TIP-X', 4500, 50, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` varchar(20) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `jenis_kelamin`, `telp`, `alamat`) VALUES
('8d99aba79e39977cdash', 'Rusdi', 'P', '08167676767', 'Jl.Nguwawor No 6'),
('8d99aba79e39977cdffa', 'Citra', 'P', '0833333333', 'Jl. Mawar No.3'),
('a985a35d6adf4e8e18cf', 'Andi', 'L', '0811111111', 'Jl. Kenanga No.1'),
('b2a1559fec5acae8cb47', 'Eko', 'L', '0855555555', 'Jl. Cempaka No.5'),
('b49349c4120df043e1ce', 'Budi', 'L', '0822222222', 'Jl. Melati No.2'),
('e76efc52a4568fb114dd', 'Dewi', 'P', '0844444444', 'Jl. Anggrek No.4');

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

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `telp` varchar(12) NOT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `telp`, `alamat`) VALUES
(1, 'PT Sumber Makmur', '0219876543', 'Jakarta'),
(2, 'UD Maju Jaya', '0317654321', 'Surabaya'),
(3, 'CV Sejahtera', '0221234567', 'Bandung'),
(4, 'PT Indah Sentosa', '0249876543', 'Semarang'),
(5, 'UD Berkah Abadi', '0251123456', 'Yogyakarta');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `waktu_transaksi` date NOT NULL,
  `keterangan` text NOT NULL,
  `total` int(11) NOT NULL,
  `pelanggan_id` varchar(20) NOT NULL,
  `user_id` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `waktu_transaksi`, `keterangan`, `total`, `pelanggan_id`, `user_id`) VALUES
(1, '2025-11-01', 'Pembelian alat tulis 1', 15000, 'a985a35d6adf4e8e18cf', 1),
(2, '2025-11-02', 'Pembelian alat tulis 2', 22000, 'a985a35d6adf4e8e18cf', 1),
(3, '2025-11-03', 'Pembelian alat tulis 3', 10000, 'b49349c4120df043e1ce', 1),
(4, '2025-11-04', 'Pembelian alat tulis 4', 27000, 'b49349c4120df043e1ce', 1),
(5, '2025-11-05', 'Pembelian alat tulis 5', 20000, '8d99aba79e39977cdffa', 1),
(6, '2025-11-05', 'Pembelian alat tulis 6', 15000, '8d99aba79e39977cdffa', 1),
(7, '2025-11-01', 'Pembelian alat tulis 1', 18000, 'e76efc52a4568fb114dd', 1),
(8, '2025-11-02', 'Pembelian alat tulis 2', 12000, 'e76efc52a4568fb114dd', 1),
(9, '2025-11-03', 'Pembelian alat tulis 3', 25000, 'b2a1559fec5acae8cb47', 1),
(10, '2025-11-04', 'Pembelian alat tulis 4', 30000, 'b2a1559fec5acae8cb47', 1),
(12, '2025-11-09', 'test', 64000, '8d99aba79e39977cdffa', 2),
(13, '2025-11-10', 'Mas Rusdi Lagi Belanja Loh yah', 40500, '8d99aba79e39977cdash', 2),
(14, '2025-11-10', 'Mas Rusdi Belanja Lagi Loh yah', 22000, '8d99aba79e39977cdash', 2);

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
(1, 3, 2000, 3),
(2, 3, 2000, 2),
(3, 3, 2000, 4),
(4, 2, 3000, 3),
(5, 4, 2500, 3),
(6, 1, 5000, 1),
(7, 1, 5000, 2),
(8, 1, 5000, 2),
(9, 1, 5000, 4),
(10, 2, 3000, 3),
(12, 1, 20000, 4),
(12, 5, 16000, 4),
(13, 2, 6000, 2),
(13, 7, 13500, 3),
(14, 1, 10000, 2),
(14, 3, 2000, 1),
(14, 4, 2500, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` tinyint(2) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(35) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `hp` varchar(20) NOT NULL,
  `level` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `alamat`, `hp`, `level`) VALUES
(1, 'admin', '1234', 'Admin Utama', 'Jl. Merdeka No.1', '081234567890', 1),
(2, 'kasir1', '1234', 'Kasir Satu', 'Jl. Sudirman No.2', '089876543210', 2),
(3, 'kasir2', '1234', 'Kasir Dua', 'Jl. Ahmad Yani No.3', '08111222333', 2),
(4, 'kasir3', '1234', 'Kasir Tiga', 'Jl. Gatot Subroto No.4', '08222333444', 2),
(5, 'gudang1', '1234', 'Admin Gudang', 'Jl. Sudirman No.5', '08333444555', 1);

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
  ADD UNIQUE KEY `transaksi_id` (`transaksi_id`);

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
  ADD KEY `pelanggan_id` (`pelanggan_id`),
  ADD KEY `user_id` (`user_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`);

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
