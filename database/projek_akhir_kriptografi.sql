-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2024 at 11:41 AM
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
(15, 'OSt1NzBCh/motpKLdayKEA==', '/pvHmFEbm7q0zEGOsAqlGQ==', 'jT8u/6WDpHMbLr7gRAqujg==', '0Ut/Z+1OpFVYqFUyOBOPlA==', 'eff7gLiweFgqapI+JGyWtA==', 'uploads/image/ppdong.jpeg'),
(16, 'iuRiOlxp0MTkiBZaglCICg==', 'NB+cRBSLsNxtHpGhJjnkRQ==', 'bx+yn5HXDvkj1wJK3XZtVw==', '0Ut/Z+1OpFVYqFUyOBOPlA==', 'SLdrW2zx2GEpW5PVR0Q6RiDwXZN0l72LjPBUjhG9+Y0=', 'uploads/image/ppdong.jpeg'),
(17, '8p12JODrBljHLY+AVOUPBw==', 'vEyKI1q+GdJ7XGZXdRzEgg==', 'O/o0rf8aOkMeBXC7RgzJ4A==', 'wEZz+j+v8+MwKUtEgnXwZg==', 'nzWrr+/oeEJ/uI7MKpD/P2x53j7RvkiqGd/WF/jf0rw=', 'uploads/image/kucing nunduk.jpg');

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
  MODIFY `id_data` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
