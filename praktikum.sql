-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2023 at 11:03 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `praktikum`
--

-- --------------------------------------------------------

--
-- Table structure for table `bagian`
--

CREATE TABLE `bagian` (
  `id_bagian` int(11) NOT NULL,
  `nama_bagian` varchar(255) NOT NULL,
  `karyawan_id` int(11) NOT NULL,
  `lokasi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bagian`
--

INSERT INTO `bagian` (`id_bagian`, `nama_bagian`, `karyawan_id`, `lokasi_id`) VALUES
(1, 'IT', 1, 1),
(5, 'SDM', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bagian_karyawan`
--

CREATE TABLE `bagian_karyawan` (
  `id_bagian_karyawan` int(11) NOT NULL,
  `bagian_id` int(11) NOT NULL,
  `jabatan_id` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bagian_karyawan`
--

INSERT INTO `bagian_karyawan` (`id_bagian_karyawan`, `bagian_id`, `jabatan_id`, `tanggal`) VALUES
(2, 5, 3, '2023-11-01'),
(3, 1, 1, '2023-11-05'),
(4, 1, 2, '2023-11-05');

-- --------------------------------------------------------

--
-- Table structure for table `honorer`
--

CREATE TABLE `honorer` (
  `id_honorer` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(100) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `honorer`
--

INSERT INTO `honorer` (`id_honorer`, `nama`, `tanggal_lahir`, `tempat_lahir`, `jenis_kelamin`, `alamat`, `no_hp`) VALUES
(4, 'Aufa', '2000-12-09', 'Barito Kuala', 'Laki-Laki', 'Barambai ', '892349824982');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(255) NOT NULL,
  `gapok_jabatan` double NOT NULL,
  `tunjangan_jabatan` double NOT NULL,
  `uang_makan_perhari` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`, `gapok_jabatan`, `tunjangan_jabatan`, `uang_makan_perhari`) VALUES
(1, 'Programmer', 7000000, 7000000, 7000000),
(2, 'System Administrators', 100000, 1000, 100),
(3, 'Bidang SDM', 7000000, 700000, 70000);

-- --------------------------------------------------------

--
-- Table structure for table `jabatan_karyawan`
--

CREATE TABLE `jabatan_karyawan` (
  `id_jabatan_karyawan` int(11) NOT NULL,
  `karyawan_id` int(11) NOT NULL,
  `jabatan_id` int(11) NOT NULL,
  `tanggal_mulai` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jabatan_karyawan`
--

INSERT INTO `jabatan_karyawan` (`id_jabatan_karyawan`, `karyawan_id`, `jabatan_id`, `tanggal_mulai`) VALUES
(1, 2, 3, '2023-11-01'),
(2, 1, 1, '2023-11-05'),
(3, 3, 2, '2023-11-01');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `nik` int(16) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `handphone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `pengguna_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nik`, `nama_lengkap`, `handphone`, `email`, `tanggal_masuk`, `pengguna_id`) VALUES
(1, 20231103, 'Doni', '084789345768', 'wkwk@gmail.com', '2020-11-11', 2),
(2, 32231, 'Toho Nadono', '0482394', 'ff@ff.com', '2020-11-11', 2),
(3, 23423, 'Yodo Martono', '34234', 'gg@gg.com', '2019-11-12', 2);

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

CREATE TABLE `lokasi` (
  `id_lokasi` int(11) NOT NULL,
  `nama_lokasi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lokasi`
--

INSERT INTO `lokasi` (`id_lokasi`, `nama_lokasi`) VALUES
(1, 'Banjarmasin'),
(2, 'Banjarbaru'),
(3, 'Marabahan'),
(6, 'Martapura');

-- --------------------------------------------------------

--
-- Table structure for table `penggajian`
--

CREATE TABLE `penggajian` (
  `id_penggajian` int(11) NOT NULL,
  `karyawan_id` int(11) NOT NULL,
  `honorer_id` int(11) NOT NULL,
  `tahun` year(4) NOT NULL,
  `bulan` char(2) NOT NULL,
  `gapok` double NOT NULL,
  `tunjangan` double NOT NULL,
  `uang_makan` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penggajian`
--

INSERT INTO `penggajian` (`id_penggajian`, `karyawan_id`, `honorer_id`, `tahun`, `bulan`, `gapok`, `tunjangan`, `uang_makan`) VALUES
(1, 1, 0, 2019, '5', 7000000, 7000000, 7000000),
(2, 1, 0, 2020, '7', 100000, 1000, 100),
(3, 3, 0, 2021, '1', 100000, 1000, 100),
(4, 2, 0, 2020, '1', 7000000, 7000000, 7000000),
(5, 0, 4, 2020, '04', 9000000, 900000, 90000);

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `peran` enum('ADMIN','USER') DEFAULT NULL,
  `login_terakhir` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `username`, `password`, `peran`, `login_terakhir`) VALUES
(1, 'admin', '$2y$10$baqQ4zTS37tzcjXzcU9GjO5.a.IIvc1OX1.kwHleKXxjVo9dZXDK2', 'ADMIN', '2023-11-07 09:31:52'),
(2, 'user', '$2y$10$gBV9hnlsGw6jzOrnmaTKROgwyEdVIdzEOMk3hpXFY2G9QwBoo2yEa', 'USER', '2023-10-21 06:25:55');

-- --------------------------------------------------------

--
-- Table structure for table `presensi`
--

CREATE TABLE `presensi` (
  `id_presensi` int(11) NOT NULL,
  `ka` int(11) NOT NULL,
  `tanggal` int(11) NOT NULL,
  `jam_masuk` int(11) NOT NULL,
  `jam_keluar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bagian`
--
ALTER TABLE `bagian`
  ADD PRIMARY KEY (`id_bagian`);

--
-- Indexes for table `bagian_karyawan`
--
ALTER TABLE `bagian_karyawan`
  ADD PRIMARY KEY (`id_bagian_karyawan`);

--
-- Indexes for table `honorer`
--
ALTER TABLE `honorer`
  ADD PRIMARY KEY (`id_honorer`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `jabatan_karyawan`
--
ALTER TABLE `jabatan_karyawan`
  ADD PRIMARY KEY (`id_jabatan_karyawan`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`id_lokasi`);

--
-- Indexes for table `penggajian`
--
ALTER TABLE `penggajian`
  ADD PRIMARY KEY (`id_penggajian`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `presensi`
--
ALTER TABLE `presensi`
  ADD PRIMARY KEY (`id_presensi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bagian`
--
ALTER TABLE `bagian`
  MODIFY `id_bagian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bagian_karyawan`
--
ALTER TABLE `bagian_karyawan`
  MODIFY `id_bagian_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `honorer`
--
ALTER TABLE `honorer`
  MODIFY `id_honorer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jabatan_karyawan`
--
ALTER TABLE `jabatan_karyawan`
  MODIFY `id_jabatan_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `id_lokasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `penggajian`
--
ALTER TABLE `penggajian`
  MODIFY `id_penggajian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `presensi`
--
ALTER TABLE `presensi`
  MODIFY `id_presensi` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
