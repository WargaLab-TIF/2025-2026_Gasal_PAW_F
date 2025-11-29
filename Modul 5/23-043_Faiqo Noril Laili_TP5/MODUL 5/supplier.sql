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
(1, 'PT Jaya Abadi', '031123456', 'Surabaya'),
(2, 'PT Sumber Makmur', '031654321', 'Gresik'),
(3, 'UD Barokah', '031987654', 'Sidoarjo'),
(4, 'pt. taruna jaya', '031665457', 'situbondo'),
(5, 'toko bandung', '031227865', 'bangkalan'),
(6, 'toko abell', '031675427', 'jakarta'),
(7, 'cv. amanah', '031257634', 'yogyakarta'),
(8, 'pt. nusantara', '031276548', 'bekasi'),
(9, 'toko obat cina', '031765423', 'solo'),
(10, 'toko serbaguna', '031876543', 'mojokerto'),
(11, 'pt surya', '031287654', 'banten'),
(12, 'cv abdi', '0312675438', 'semarang'),
(13, 'toko diloby', '031287432', 'sampang'),
(14, 'pt citra', '031276438', 'aceh'),
(15, 'pt pertamina', '031287649', 'malang'),

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
