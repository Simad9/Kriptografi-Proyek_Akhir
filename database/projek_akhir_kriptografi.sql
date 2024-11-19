-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2024 at 03:52 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projek_akhir_kriptografi`
--

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `id_data` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `gender` varchar(25) NOT NULL,
  `tgl_lhr` varchar(25) NOT NULL,
  `noHp` varchar(25) NOT NULL,
  `alamat` text NOT NULL,
  `urlFoto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`id_data`, `nama`, `gender`, `tgl_lhr`, `noHp`, `alamat`, `urlFoto`) VALUES
(19, '8CbvSOJCf+GGaOcYkrPN7Q==', '/kgyp+YgR9sZKj7LQriM+A==', 'HzMb5qtQwqmgUyuzjZ6A/w==', 'J3n8/33aU2FFESHcXQTkKw==', 'gT4t1OW7p1qKWm/n+E/tHKRVa4JGCyQif0XE7B6JycsQPeLHJJRn9tJsdSfbdo7aCEkUCtjQozL8y8rmr0X8+NBSwH2LU4K/XqsIiApeYqw=', 'uploads/image/WhatsApp Image 2021-08-08 at 16.04.23.jpeg'),
(20, '0Os9MhMT4OOnpEdptFbcSw==', 'enhOdipUa2vSQy4mjQiZLw==', 'tWgO2GhhWv/iHN3S0cNWtw==', '0Ut/Z+1OpFVYqFUyOBOPlA==', 'DFAhZmgOxNe+jLJCp7u3UwdlMyYoOlGYAmfiWbZeOKSthIj1EoYa3Pq8rXJ+gU/y', 'uploads/image/ppdong.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'pegawai'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `role`) VALUES
(4, '123', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'pegawai'),
(5, 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`id_data`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
  MODIFY `id_data` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
