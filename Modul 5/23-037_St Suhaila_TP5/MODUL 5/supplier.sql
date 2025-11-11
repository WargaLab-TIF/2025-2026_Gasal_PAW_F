-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2024 at 05:20 PM
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
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `telp` varchar(15) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `telp`, `alamat`) VALUES
(1, 'PT kopi susu', '0212345678', 'Jl. Industri No. 1'),
(2, 'CV Sumber Rejeki', '0213456789', 'Jl. Dagang No. 15'),
(3, 'PT Sinar dunia', '0214567890', 'Jl. Pabrik No. 20'),
(4, 'UD Sejahtera', '0215678901', 'Jl. Grosir No. 8'),
(5, 'PT Makmur sentosa', '0216789012', 'Jl. Distribusi No. 3'),
(6, 'CV Sumber Pangan', '0217654326', 'Jl. Melati No. 23'),
(7, 'UD Jaya Sentosa', '0217654327', 'Jl. Kenari No. 18'),
(8, 'Toko Sentosa Makmur', '0217654328', 'Jl. Tanjung No. 3'),
(9, 'PT Prima Nusantara', '0217654329', 'Jl. Anggrek No. 7'),
(10, 'CV Wijaya Mandiri', '0217654330', 'Jl. Cempaka No. 2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
