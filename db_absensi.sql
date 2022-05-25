-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2020 at 05:08 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_absensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_absensi`
--

CREATE TABLE `tb_absensi` (
  `id_absensi` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `check_in` time NOT NULL,
  `check_out` time NOT NULL,
  `late` time NOT NULL,
  `work_time` time NOT NULL,
  `date` date NOT NULL,
  `is_late` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_absensi`
--

INSERT INTO `tb_absensi` (`id_absensi`, `id_users`, `check_in`, `check_out`, `late`, `work_time`, `date`, `is_late`, `status`) VALUES
(89, 49, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '2020-12-02', 0, 'Izin'),
(90, 50, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '2020-12-02', 0, 'Tidak'),
(91, 51, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '2020-12-02', 0, 'Tidak'),
(95, 49, '16:13:13', '17:47:00', '08:13:13', '01:33:47', '2020-12-03', 1, 'Hadir'),
(96, 50, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '2020-12-03', 0, 'Tidak'),
(97, 51, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '2020-12-03', 0, 'Tidak');

-- --------------------------------------------------------

--
-- Table structure for table `tb_cuti`
--

CREATE TABLE `tb_cuti` (
  `id_cuti` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `dari_tanggal` date NOT NULL,
  `sampai_tanggal` date NOT NULL,
  `jumlah_hari` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `id_users` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_cuti`
--

INSERT INTO `tb_cuti` (`id_cuti`, `keterangan`, `dari_tanggal`, `sampai_tanggal`, `jumlah_hari`, `status`, `id_users`) VALUES
(16, 'ingin menikah', '2020-12-15', '2020-12-18', 4, 0, 49),
(17, 'acara keluarga', '2020-12-22', '2020-12-24', 3, 0, 49),
(18, 'acara keluarga', '2020-12-28', '2020-12-31', 4, 0, 49);

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_users`
--

CREATE TABLE `tb_detail_users` (
  `users_id` int(11) NOT NULL,
  `jenis_kelamin` varchar(25) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `check_in` time NOT NULL,
  `check_out` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_detail_users`
--

INSERT INTO `tb_detail_users` (`users_id`, `jenis_kelamin`, `alamat`, `foto`, `tgl_lahir`, `id_jabatan`, `check_in`, `check_out`) VALUES
(49, 'Laki-laki', 'Jl. Kesadaran raya no 12A', 'PhotoGrid_Plus_1602582458834.jpg', '1999-02-28', 9, '08:00:00', '15:00:00'),
(50, '', '', '', '0000-00-00', 9, '08:00:00', '15:00:00'),
(51, '', '', '', '0000-00-00', 7, '08:00:00', '15:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jabatan`
--

CREATE TABLE `tb_jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(20) NOT NULL,
  `gaji` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jabatan`
--

INSERT INTO `tb_jabatan` (`id_jabatan`, `nama_jabatan`, `gaji`) VALUES
(1, 'Direktur', 10000000),
(2, 'Komisaris', 9500000),
(3, 'Supervisor', 8000000),
(4, 'Admin', 6000000),
(6, 'Accounting', 6500000),
(7, 'Gudang', 5000000),
(8, 'General Officer', 5500000),
(9, 'Produksi', 5000000),
(11, 'Purchasing', 4500000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_qrcode`
--

CREATE TABLE `tb_qrcode` (
  `id_qrcode` int(11) NOT NULL,
  `qr_code` varchar(50) NOT NULL,
  `id_pegawai` varchar(20) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_qrcode`
--

INSERT INTO `tb_qrcode` (`id_qrcode`, `qr_code`, `id_pegawai`, `date`) VALUES
(2, 'PG-7116172_2020-11-03.png', 'PG-7116172', '2020-11-03'),
(3, 'PG-7116172_2020-11-09.png', 'PG-7116172', '2020-11-09'),
(4, 'PG-711617_2020-11-09.png', 'PG-711617', '2020-11-09'),
(5, 'PG-7116172_2020-11-10.png', 'PG-7116172', '2020-11-10'),
(6, 'PG-7116172_2020-11-11.png', 'PG-7116172', '2020-11-11'),
(7, 'PG-466897_2020-11-11.png', 'PG-466897', '2020-11-11'),
(8, 'PG-6264660_2020-11-11.png', 'PG-6264660', '2020-11-11'),
(9, 'PG-7116172_2020-11-12.png', 'PG-7116172', '2020-11-12'),
(10, 'PG-7116172_2020-11-23.png', 'PG-7116172', '2020-11-23'),
(11, 'PG-7116172_2020-11-28.png', 'PG-7116172', '2020-11-28'),
(12, 'PG-7116172_2020-11-29.png', 'PG-7116172', '2020-11-29'),
(13, 'PG-7116172_2020-11-30.png', 'PG-7116172', '2020-11-30'),
(14, 'PG-7116172_2020-12-02.png', 'PG-7116172', '2020-12-02'),
(15, 'PG-7116172_2020-12-03.png', 'PG-7116172', '2020-12-03');

-- --------------------------------------------------------

--
-- Table structure for table `tb_shift`
--

CREATE TABLE `tb_shift` (
  `id_shift` int(11) NOT NULL,
  `keterangan` varchar(30) NOT NULL,
  `check_in` time NOT NULL,
  `check_out` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_shift`
--

INSERT INTO `tb_shift` (`id_shift`, `keterangan`, `check_in`, `check_out`) VALUES
(1, 'Shift 1', '08:00:00', '15:00:00'),
(3, 'Shift 2', '15:00:00', '23:00:00'),
(4, 'Shift 3', '00:00:00', '06:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_surat_tidak_hadir`
--

CREATE TABLE `tb_surat_tidak_hadir` (
  `id_surat` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `alasan` text NOT NULL,
  `bukti` varchar(50) NOT NULL,
  `id_users` int(11) NOT NULL,
  `status_surat` int(11) NOT NULL,
  `id_absensi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_surat_tidak_hadir`
--

INSERT INTO `tb_surat_tidak_hadir` (`id_surat`, `tanggal`, `alasan`, `bukti`, `id_users`, `status_surat`, `id_absensi`) VALUES
(14, '2020-12-02', 'sakit dan harus pergi kerumah sakit', 'IMG_20201201_112022.jpg', 49, 1, 89);

-- --------------------------------------------------------

--
-- Table structure for table `tb_uangmakan`
--

CREATE TABLE `tb_uangmakan` (
  `id_uangmakan` int(11) NOT NULL,
  `nominal` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `id_users` int(11) NOT NULL,
  `id_absensi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_uangmakan`
--

INSERT INTO `tb_uangmakan` (`id_uangmakan`, `nominal`, `tanggal`, `id_users`, `id_absensi`) VALUES
(44, 0, '2020-12-02', 49, 89),
(45, 0, '2020-12-02', 50, 90),
(46, 0, '2020-12-02', 51, 91),
(50, 2500, '2020-12-03', 49, 95),
(51, 0, '2020-12-03', 50, 96),
(52, 0, '2020-12-03', 51, 97);

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `id_users` int(11) NOT NULL,
  `no_pegawai` varchar(20) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nama_lengkap` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `password` varchar(100) NOT NULL,
  `device_id` varchar(25) NOT NULL,
  `role` int(11) NOT NULL,
  `is_verified` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`id_users`, `no_pegawai`, `nik`, `nama_lengkap`, `email`, `no_telp`, `password`, `device_id`, `role`, `is_verified`) VALUES
(6, 'admin', '0', 'admin', 'admin@gmail.com', '089669615426', '$2y$10$Jxbjk.foKOGCTpchQ9FXtegRg1nIGm7o4244Ozni/8.U9FWYy24eW', 'asdas', 1, 1),
(49, 'PG-7116172', '3175032802000009', 'Genta Prima Syahnur', 'gentaprima600@gmail.com', '089669615427', '$2y$10$73G8Iwd4yJhmCpBn1aFOHOTALqH0vFT.tb4dMv7cw.4SQn1HEQhIW', 'd0319e458dd7f1c2', 0, 1),
(50, 'PG-466897', '3175030837748394', 'Farhan Ali Fauzan', 'farhanalifauzan00@gmail.com', '8964345482', '$2y$10$hR6zGx0ew4RxaFxhGGIBcuJryvIah0aogii4KgAE4dujcbK1M4VsW', '03c8d47a9f87667d', 0, 1),
(51, 'PG-6264660', '3175949383757384', 'Rofi Ikhsan', 'rofii.saputra@gmail.com', '08533161618156', '$2y$10$4iJ3K7PECQrDMH93KoBG7.veQBtRHIkhHWEDfC7K7r11rMPWb6A0u', '76bb463ab3027b64', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_absensi`
--
ALTER TABLE `tb_absensi`
  ADD PRIMARY KEY (`id_absensi`),
  ADD KEY `id_users` (`id_users`);

--
-- Indexes for table `tb_cuti`
--
ALTER TABLE `tb_cuti`
  ADD PRIMARY KEY (`id_cuti`),
  ADD KEY `id_users` (`id_users`);

--
-- Indexes for table `tb_detail_users`
--
ALTER TABLE `tb_detail_users`
  ADD PRIMARY KEY (`users_id`),
  ADD KEY `id_shift` (`check_in`),
  ADD KEY `tb_detail_users_ibfk_3` (`id_jabatan`);

--
-- Indexes for table `tb_jabatan`
--
ALTER TABLE `tb_jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `tb_qrcode`
--
ALTER TABLE `tb_qrcode`
  ADD PRIMARY KEY (`id_qrcode`);

--
-- Indexes for table `tb_shift`
--
ALTER TABLE `tb_shift`
  ADD PRIMARY KEY (`id_shift`);

--
-- Indexes for table `tb_surat_tidak_hadir`
--
ALTER TABLE `tb_surat_tidak_hadir`
  ADD PRIMARY KEY (`id_surat`),
  ADD KEY `id_absensi` (`id_absensi`),
  ADD KEY `id_users` (`id_users`);

--
-- Indexes for table `tb_uangmakan`
--
ALTER TABLE `tb_uangmakan`
  ADD PRIMARY KEY (`id_uangmakan`),
  ADD KEY `id_users` (`id_users`),
  ADD KEY `id_absensi` (`id_absensi`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_absensi`
--
ALTER TABLE `tb_absensi`
  MODIFY `id_absensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `tb_cuti`
--
ALTER TABLE `tb_cuti`
  MODIFY `id_cuti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tb_jabatan`
--
ALTER TABLE `tb_jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_qrcode`
--
ALTER TABLE `tb_qrcode`
  MODIFY `id_qrcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_shift`
--
ALTER TABLE `tb_shift`
  MODIFY `id_shift` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_surat_tidak_hadir`
--
ALTER TABLE `tb_surat_tidak_hadir`
  MODIFY `id_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_uangmakan`
--
ALTER TABLE `tb_uangmakan`
  MODIFY `id_uangmakan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_absensi`
--
ALTER TABLE `tb_absensi`
  ADD CONSTRAINT `tb_absensi_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `tb_users` (`id_users`);

--
-- Constraints for table `tb_cuti`
--
ALTER TABLE `tb_cuti`
  ADD CONSTRAINT `tb_cuti_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `tb_users` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_detail_users`
--
ALTER TABLE `tb_detail_users`
  ADD CONSTRAINT `tb_detail_users_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `tb_users` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_detail_users_ibfk_3` FOREIGN KEY (`id_jabatan`) REFERENCES `tb_jabatan` (`id_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_surat_tidak_hadir`
--
ALTER TABLE `tb_surat_tidak_hadir`
  ADD CONSTRAINT `tb_surat_tidak_hadir_ibfk_1` FOREIGN KEY (`id_absensi`) REFERENCES `tb_absensi` (`id_absensi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_surat_tidak_hadir_ibfk_2` FOREIGN KEY (`id_users`) REFERENCES `tb_users` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_uangmakan`
--
ALTER TABLE `tb_uangmakan`
  ADD CONSTRAINT `tb_uangmakan_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `tb_users` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_uangmakan_ibfk_2` FOREIGN KEY (`id_absensi`) REFERENCES `tb_absensi` (`id_absensi`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
