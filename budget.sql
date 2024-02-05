-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2023 at 08:56 AM
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
-- Database: `budget`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggaran`
--

CREATE TABLE `anggaran` (
  `id_anggaran` int(11) NOT NULL,
  `nama_anggaran` varchar(100) NOT NULL,
  `nominal` int(11) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_akhir` date NOT NULL,
  `id_mhs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `anggaran`
--

INSERT INTO `anggaran` (`id_anggaran`, `nama_anggaran`, `nominal`, `tgl_mulai`, `tgl_akhir`, `id_mhs`) VALUES
(35, 'November 2023', 4500000, '2023-11-23', '2023-12-08', 41),
(37, 'November 2023', 4500000, '2023-11-01', '2023-11-30', 39),
(40, 'Desember', 1000000, '2023-12-01', '2023-12-30', 39),
(43, 'Makan besar', 1000000, '2023-11-30', '2023-11-30', 39),
(44, 'Makan besar', 1000000, '2023-12-01', '2023-12-30', 41),
(45, 'desember', 1000000, '2023-12-01', '2023-12-31', 42),
(46, 'Makan besar', 2000000, '2023-12-01', '2023-12-31', 42),
(50, 'November', 3000000, '2023-11-01', '2023-11-30', 44),
(51, 'Desember', 3000000, '2023-12-07', '2023-12-07', 44),
(52, 'Januari 2024', 2000000, '2024-01-01', '2024-01-30', 45);

-- --------------------------------------------------------

--
-- Table structure for table `catatan_pengeluaran`
--

CREATE TABLE `catatan_pengeluaran` (
  `id_catatan` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_anggaran` int(11) NOT NULL,
  `tgl_catatan` date NOT NULL,
  `nominal_catatan` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `id_mhs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `catatan_pengeluaran`
--

INSERT INTO `catatan_pengeluaran` (`id_catatan`, `id_kategori`, `id_anggaran`, `tgl_catatan`, `nominal_catatan`, `keterangan`, `id_mhs`) VALUES
(24, 3, 35, '2023-11-24', 98000, 'mie aceh', 41),
(30, 7, 37, '2023-11-27', 100000, 'beli obat migrain', 39),
(37, 4, 35, '2023-11-27', 45000, 'Bensin pertamax 98', 41),
(39, 6, 37, '2023-11-30', 1000000, 'UKT', 39),
(40, 3, 37, '2023-11-28', 30000, 'Makan makan', 39),
(41, 3, 37, '2023-11-28', 12000, 'nasi padang', 39),
(42, 8, 37, '2023-11-28', 250000, 'bpjs TK dan KS', 39),
(43, 8, 37, '2023-11-28', 300000, 'Jasa Raharja', 39),
(48, 3, 43, '2023-11-30', 500000, 'udang tepung krispi', 39),
(49, 3, 43, '2023-11-30', 200000, 'Kelapa Muda', 39),
(54, 3, 35, '2023-12-01', 50000, 'mcd', 41),
(55, 3, 44, '2023-12-07', 3000000, 'Makan makan', 41),
(56, 3, 45, '2023-12-07', 10000, 'cimory', 42),
(57, 3, 45, '2023-12-06', 20000, 'nasi padang', 42),
(59, 3, 46, '2023-12-07', 3000000, 'nasi padang jumbo', 42),
(63, 3, 50, '2023-12-07', 20000, 'nasi padang ampera', 44),
(64, 7, 51, '2023-12-07', 200000, 'beli obat', 44),
(65, 3, 50, '2023-12-08', 30000, 'makan', 44),
(66, 4, 50, '2023-11-16', 110000, 'ganti oli motor', 44),
(67, 9, 50, '2023-11-17', 300000, 'member gym', 44),
(68, 9, 50, '2023-11-24', 385000, 'beli dumbell', 44),
(69, 3, 52, '2024-01-09', 98000, 'mie aceh', 45),
(70, 4, 52, '2024-01-10', 1000000, 'nasi padang ampera', 45),
(71, 6, 52, '2024-01-11', 1000000, 'kuliah', 45);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(3, 'Makanan'),
(4, 'Transportasi'),
(6, 'Pendidikan'),
(7, 'Kesehatan'),
(8, 'Asuransi'),
(9, 'Olahraga'),
(10, 'Hiburan'),
(11, 'Belanja'),
(12, 'Lainnya');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id_mhs` int(11) NOT NULL,
  `nama_mhs` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id_mhs`, `nama_mhs`, `username`, `password`, `no_hp`, `alamat`, `email`) VALUES
(39, 'Muhammad Mabrur Al Mutaqi', 'Mabrur Al Mutaqi', '$2y$10$5MCl2hYjUGGRsUOfxgip9Ov3khpo342UVx2tJJkIBJv.M8/IOOP9q', '081100001212', 'Batam Center', 'mabruralmutaqi@gmail.com'),
(41, 'kiki', 'kiki', '$2y$10$vX/Kk/UWqmOdt6uudrQMJeaM9rki.QwoY89l/YGY2RoAzEnMk3KQm', '082285686292', 'Nongsa', 'mabruralmutaqi@gmail.com'),
(42, 'Isyabel Salsabilla', 'abel', '$2y$10$jyS7dRw796W/tmP7ZWC6EufqZGZhJJ/GYigO8tXcjPgPhOvVIEK3O', '1231231', 'Batam center', 'abel123@gmail.com'),
(44, 'Ahmad Azka Salam', 'Azka', '$2y$10$Yhpj3wBpAefav9sr0V//xe5EkhEJCvBtZzI/I3EB15Gv4PlwUuzcW', '1231231', 'Botania', 'btm@gmail.com'),
(45, 'Shah Rizal', 'rizal26', '$2y$10$aY4LPrVEMXqzRbZlaT.hQuY1lOoQTrikLumN0EsxD9GuX02t05gnW', '082285686292', 'Taman Sari Hijau', 'shahrizal71531@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tagihan`
--

CREATE TABLE `tagihan` (
  `id_tagihan` int(11) NOT NULL,
  `nama_tagihan` varchar(100) NOT NULL,
  `nominal` int(11) NOT NULL,
  `tgl_due` date NOT NULL,
  `id_mhs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tagihan`
--

INSERT INTO `tagihan` (`id_tagihan`, `nama_tagihan`, `nominal`, `tgl_due`, `id_mhs`) VALUES
(17, 'cicilan motor', 1000000, '2023-12-12', 39),
(18, 'wifi', 300000, '2023-11-30', 41),
(20, 'wifi', 295000, '2023-12-12', 39),
(22, 'mobil', 3000000, '2023-12-29', 44),
(28, 'Cicilan motor', 900000, '2023-12-10', 45);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggaran`
--
ALTER TABLE `anggaran`
  ADD PRIMARY KEY (`id_anggaran`),
  ADD KEY `id_mhs` (`id_mhs`);

--
-- Indexes for table `catatan_pengeluaran`
--
ALTER TABLE `catatan_pengeluaran`
  ADD PRIMARY KEY (`id_catatan`),
  ADD KEY `id_anggaran` (`id_anggaran`),
  ADD KEY `id_user` (`id_mhs`),
  ADD KEY `catatan_pengeluaran_ibfk_3` (`id_kategori`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id_mhs`);

--
-- Indexes for table `tagihan`
--
ALTER TABLE `tagihan`
  ADD PRIMARY KEY (`id_tagihan`),
  ADD KEY `id_mhs` (`id_mhs`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggaran`
--
ALTER TABLE `anggaran`
  MODIFY `id_anggaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `catatan_pengeluaran`
--
ALTER TABLE `catatan_pengeluaran`
  MODIFY `id_catatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id_mhs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tagihan`
--
ALTER TABLE `tagihan`
  MODIFY `id_tagihan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anggaran`
--
ALTER TABLE `anggaran`
  ADD CONSTRAINT `anggaran_ibfk_1` FOREIGN KEY (`id_mhs`) REFERENCES `mahasiswa` (`id_mhs`);

--
-- Constraints for table `catatan_pengeluaran`
--
ALTER TABLE `catatan_pengeluaran`
  ADD CONSTRAINT `catatan_pengeluaran_ibfk_2` FOREIGN KEY (`id_anggaran`) REFERENCES `anggaran` (`id_anggaran`),
  ADD CONSTRAINT `catatan_pengeluaran_ibfk_3` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`),
  ADD CONSTRAINT `catatan_pengeluaran_ibfk_4` FOREIGN KEY (`id_mhs`) REFERENCES `mahasiswa` (`id_mhs`);

--
-- Constraints for table `tagihan`
--
ALTER TABLE `tagihan`
  ADD CONSTRAINT `tagihan_ibfk_1` FOREIGN KEY (`id_mhs`) REFERENCES `mahasiswa` (`id_mhs`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
