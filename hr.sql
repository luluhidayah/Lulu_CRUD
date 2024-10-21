-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2024 at 05:51 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hr`
--

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `Id` int(11) NOT NULL,
  `Nama` varchar(255) NOT NULL,
  `Tgl_Lahir` date NOT NULL,
  `Gaji` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`Id`, `Nama`, `Tgl_Lahir`, `Gaji`) VALUES
(1, 'Lulu', '2024-10-16', '4000000'),
(2, 'Lili', '2003-11-26', '8000000'),
(3, 'Luna', '2004-11-30', '5000000');

-- --------------------------------------------------------

--
-- Table structure for table `tlog`
--

CREATE TABLE `tlog` (
  `Id` int(11) NOT NULL,
  `Tanggal` date NOT NULL,
  `Jam` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tlog`
--

INSERT INTO `tlog` (`Id`, `Tanggal`, `Jam`, `Keterangan`) VALUES
(1, '2024-10-09', '2024-10-21 02:56:22', 'Hadir'),
(2, '2024-10-10', '2024-10-21 02:57:05', 'Hadir'),
(3, '2024-10-11', '2024-10-21 02:57:05', 'Tidak Hadir');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tlog`
--
ALTER TABLE `tlog`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tlog`
--
ALTER TABLE `tlog`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
