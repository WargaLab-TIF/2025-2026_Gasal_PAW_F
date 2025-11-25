-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Nov 2024 pada 17.46
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `storee`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `kode_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `kode_barang`, `nama_barang`, `harga`, `stok`, `id_supplier`) VALUES
(1, 'K1', 'Sabun', 2000, 20, 1),
(2, 'K2', 'Piring', 10000, 10, 2),
(3, 'K3', 'Shampo', 3000, 30, 3),
(4, 'K4', 'Sepeda Polygon', 15000000, 25, 4),
(5, 'K5', 'Salon', 400000, 40, 5),
(6, 'K6', 'Gelas', 10000, 10, 1),
(7, 'K7', 'Piring', 15000, 20, 2),
(8, 'K8', 'Mangkok', 20000, 20, 3),
(9, 'K9', 'Pasta Gigi', 2000, 10, 4),
(10, 'K10', 'Karpet', 75000, 40, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(100) DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `jenis_kelamin`, `telp`, `alamat`) VALUES
(1, 'abdi', 'L', '012345678912', 'Surabaya'),
(2, 'ani', 'P', '08997766554', 'Sidoarjo'),
(3, 'anis', 'P', '089766655544', 'Gresik'),
(4, 'dahlan', 'L', '081122334455', 'Malang'),
(5, 'dahlia', 'P', '087654443221', 'Blitar'),
(6, 'bunga', 'P', '089765443222', 'Kediri'),
(7, 'cinta', 'P', '08965437892', 'Madiun'),
(8, 'elang', 'L', '045678901234', 'Ngawi'),
(9, 'figo', 'L', '034567890123', 'Nganjuk'),
(10, 'gustavo', 'L', '023456789012', 'Mojokerto'),
(11, 'cahyo', 'L', 'telp', 'kenongo'),
(12, 'dani', 'L', '1234566', 'kenongo');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `waktu_bayar` datetime NOT NULL,
  `total` int(11) NOT NULL,
  `metode` enum('TUNAI','TRANSFER','EDC') NOT NULL,
  `id_transaksi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `waktu_bayar`, `total`, `metode`, `id_transaksi`) VALUES
(1, '2024-10-22 11:29:34', 1000000, 'TUNAI', 1),
(2, '2024-10-22 11:38:09', 1000000, 'TRANSFER', 2),
(3, '2024-10-22 11:41:54', 1000000, 'TUNAI', 3),
(4, '2024-10-22 11:42:15', 1000000, 'TRANSFER', 4),
(5, '2024-10-22 11:43:03', 1000000, 'TUNAI', 5),
(6, '2024-10-22 11:43:41', 1000000, 'TUNAI', 6),
(7, '2024-10-22 11:45:57', 1000000, 'TUNAI', 7),
(8, '2024-10-22 11:46:09', 1000000, 'TRANSFER', 8),
(9, '2024-10-22 11:46:22', 1000000, 'TRANSFER', 9),
(10, '2024-10-22 11:46:35', 1000000, 'TRANSFER', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `telp` varchar(12) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama`, `telp`, `alamat`) VALUES
(1, 'paijo', '089123456789', 'Jl. Mawar'),
(2, 'andi', '089234567891', 'Jl. Anggrek'),
(3, 'budi', '089345678912', 'Jl. Melati'),
(4, 'bagus', '089456789123', 'Jl. Sepatu'),
(5, 'bagas', '089567891234', 'Jl. Kamboja'),
(6, 'ahmad', '089678912345', 'Jl. Waru'),
(7, 'ali', '089789123456', 'Jl. Pahlawan'),
(8, 'ehsan', '089891234567', 'Jl. Sudirman'),
(9, 'fizi', '089912345678', 'Jl. Hatta'),
(10, 'mail', '089012345678', 'Jl. Sukarno');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `waktu_transaksi` date NOT NULL,
  `keterangan` text NOT NULL,
  `total` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `waktu_transaksi`, `keterangan`, `total`, `id_pelanggan`) VALUES
(1, '2024-10-22', 'Pembayaran ', 22000, 1),
(2, '2024-10-22', 'Pembayaran', 10000, 2),
(3, '2024-10-22', 'Pembayaran', 27000, 3),
(4, '2024-10-22', 'Pembayaran', 15225000, 4),
(5, '2024-10-22', 'Pembayaran', 409000, 5),
(6, '2024-10-22', 'Pembayaran', 14000, 6),
(7, '2024-10-22', 'Pembayaran', 35000, 8),
(8, '2024-10-22', 'Pembayaran', 24000, 7),
(9, '2024-10-22', 'Pembayaran', 6000, 9),
(10, '2024-10-22', 'Pembayaran', 79000, 10),
(11, '2024-11-04', 'bayar', 3000, 1),
(12, '2024-11-05', 'bayar', 0, 12),
(13, '2024-11-10', 'pembayaran', 15002000, 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `id_transaksi` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`id_transaksi`, `id_barang`, `harga`, `qty`, `subtotal`) VALUES
(1, 1, 2000, 10, ''),
(1, 2, 20000, 2, ''),
(2, 2, 10000, 5, ''),
(3, 2, 10000, 1, ''),
(3, 3, 3000, 10, ''),
(3, 6, 10000, 33, '330000'),
(3, 9, 4000, 2, ''),
(4, 4, 15000000, 2, ''),
(4, 10, 225000, 3, ''),
(5, 3, 9000, 3, ''),
(5, 5, 400000, 4, ''),
(6, 6, 10000, 4, ''),
(6, 9, 4000, 2, ''),
(7, 6, 20000, 2, ''),
(7, 7, 15000, 5, ''),
(8, 8, 20000, 5, ''),
(8, 9, 4000, 2, ''),
(9, 1, 4000, 2, ''),
(9, 9, 2000, 2, ''),
(10, 1, 4000, 2, ''),
(10, 10, 75000, 10, ''),
(13, 4, 15000000, 40, '600000000'),
(13, 9, 2000, 2, '4000');

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
  `level` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `alamat`, `hp`, `level`) VALUES
(1, 'sriw', 'password123', 'sri', 'Jl. Merpati No. 1, Surabaya', '081234567890', 1),
(2, 'janedoe', 'password456', 'Jane Doe', 'Jl. Kenari No. 5, Malang', '081298765432', 2),
(3, 'admin', 'adminpass', 'Admin', 'Jl. Rajawali No. 9, Jakarta', '081112223344', 0),
(4, 'bobby', 'passbobby', 'Bobby Santoso', 'Jl. Anggrek No. 10, Bandung', '081345678912', 1),
(5, 'elly', 'ellypass', 'Elly Rahmawati', 'Jl. Melati No. 12, Bogor', '081234598765', 2),
(6, 'revan', 'revanpassword', 'Revan Junaidi', 'Jl. Dahlia No. 7, Bali', '081223344556', 1),
(7, 'linda', 'lindapass', 'Linda Putri', 'Jl. Seruni No. 3, Yogyakarta', '081987654321', 2),
(8, 'agus', 'aguspass', 'Agus Saputra', 'Jl. Cemara No. 15, Semarang', '081765432198', 1),
(9, 'rina', 'rinapass', 'Rina Kusuma', 'Jl. Mawar No. 18, Solo', '081334455667', 2),
(10, 'zaki', 'zakipass', 'Zaki Firmansyah', 'Jl. Pahlawan No. 22, Medan', '081122334455', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_transaksi` (`id_transaksi`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indeks untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`id_transaksi`,`id_barang`),
  ADD KEY `id_barang` (`id_barang`);

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
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`);

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`);

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`);

--
-- Ketidakleluasaan untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `transaksi_detail_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `transaksi_detail_ibfk_2` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
