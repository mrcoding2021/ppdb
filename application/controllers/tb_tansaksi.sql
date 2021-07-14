-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2020 at 07:51 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipajar`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_tansaksi`
--

CREATE TABLE `tb_tansaksi` (
  `id_transaksi` int(11) NOT NULL,
  `date_created` date NOT NULL,
  `id_murid` int(11) NOT NULL,
  `id_sekolah` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `debit` int(30) NOT NULL,
  `kredit` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_tansaksi`
--

INSERT INTO `tb_tansaksi` (`id_transaksi`, `date_created`, `id_murid`, `id_sekolah`, `keterangan`, `debit`, `kredit`) VALUES
(1, '2020-07-10', 1000001, 1, 'nabung', 0, 100000),
(2, '2020-07-10', 1000002, 1, 'nabung lagi', 0, 50000),
(3, '2020-07-11', 1000001, 1, 'nabung', 0, 50000),
(4, '2020-07-10', 1000002, 1, 'nabung lagi', 0, 100000),
(5, '2020-07-11', 1000001, 1, 'nabung', 0, 200000),
(6, '2020-06-01', 1000001, 1, 'nabung lagi', 0, 50000),
(7, '2020-07-13', 1000007, 2, 'Nabung 13 juli 2020', 0, 20000),
(8, '2020-07-13', 1000008, 2, 'Nabung 14 juli 2021', 0, 30000),
(9, '2020-07-13', 1000009, 2, 'Nabung 14 juli 2022', 0, 40000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_tansaksi`
--
ALTER TABLE `tb_tansaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_tansaksi`
--
ALTER TABLE `tb_tansaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
