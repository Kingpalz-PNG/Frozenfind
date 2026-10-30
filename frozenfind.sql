-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2026 at 12:36 AM
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
-- Database: `frozenfind`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `nomer_produk` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `nomor_unik_produk` int(255) NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `foto_produk` varchar(4096) NOT NULL,
  `status_ketersediaan` varchar(30) NOT NULL,
  `harga` decimal(65,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`nomer_produk`, `nama_produk`, `nomor_unik_produk`, `jenis`, `foto_produk`, `status_ketersediaan`, `harga`) VALUES
(3, 'Sosis Bernardi', 2818112, 'sosis', 'Img2.jpeg', 'segar', 20),
(14, 'Ikan', 79008, 'seafood', '320569273cce4bb186e08bfe44c3bfb0.jpeg', 'segar', 12),
(16, 'Nugget Bellfood Bulat', 71086, 'nugget', 'img1.jpeg', 'menipis', 34),
(19, 'Kulit Pangsit', 3540603, 'bahan_masak', 'img6.jpeg', 'segar', 34);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `role`, `nama`) VALUES
('atmin', '$2y$10$7SDvPEtv2OXccAGnn9g0qusxfqvpEkeUh2JFACS1DOMLhd2iqiCgu', 'admin', 'atmin'),
('ulala', '$2y$10$NmnRUkeCHPzzXdWByHQkCOe3sixIx2ROt0URfS/1o/LONscjjUha.', 'user', 'Cihuy'),
('uwakwe', 'admin1234', 'user', 'uwakwe');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`nomer_produk`),
  ADD UNIQUE KEY `nomor_unik_produk` (`nomor_unik_produk`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `nomer_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
