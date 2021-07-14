-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2020 at 07:45 AM
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
-- Table structure for table `tb_murid`
--

CREATE TABLE `tb_murid` (
  `id_murid` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_sekolah` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nama_murid` varchar(100) NOT NULL,
  `hp_murid` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_murid`
--

INSERT INTO `tb_murid` (`id_murid`, `id_user`, `id_sekolah`, `date_created`, `nama_murid`, `hp_murid`) VALUES
(1000001, 5, 1, '2020-07-13 01:48:38', 'Abdul Rohman', '087883245700'),
(1000002, 7, 1, '2020-07-13 01:48:38', 'Dedy Hidayat', '089612341234'),
(1000007, 6, 2, '2020-07-13 01:48:38', 'Ahmad Dhani', '0856666666'),
(1000008, 7, 2, '2020-07-13 01:48:38', 'sanusih', '0877666666'),
(1000009, 8, 2, '2020-07-13 01:48:38', 'wilda hasan', '087788888888');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_murid`
--
ALTER TABLE `tb_murid`
  ADD PRIMARY KEY (`id_murid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_murid`
--
ALTER TABLE `tb_murid`
  MODIFY `id_murid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000010;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
