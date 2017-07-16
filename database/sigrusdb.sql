-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2017 at 10:58 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sigrusdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_akun`
--

CREATE TABLE `tb_akun` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` enum('A','T','P') NOT NULL COMMENT 'A = Admin, T = TPQ , P = Pengajar',
  `id_level` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_akun`
--

INSERT INTO `tb_akun` (`id`, `username`, `password`, `level`, `id_level`) VALUES
(1, 'email@gmail.com', '202cb962ac59075b964b07152d234b70', 'A', 0),
(44, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'A', 0),
(47, 'aljannah@gmail.com', '202cb962ac59075b964b07152d234b70', 'T', 16),
(49, 'oke@gmail.com', 'baf1da0e2b9065ab5edd36ca00ed1826', 'T', 18),
(53, 'hanna@gmail.com', 'c1f64af5c8fb5e9699f69cd4632c4100', 'P', 4),
(56, 'kahfi@gmail.com', 'c1f64af5c8fb5e9699f69cd4632c4100', 'T', 19),
(57, 'toriq.354@gmail.com', 'efc5df519268bab152125cca01204874', 'P', 7),
(58, 'junrejo@gmail.com', 'c1f64af5c8fb5e9699f69cd4632c4100', 'T', 20);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori_pengurus_tpq`
--

CREATE TABLE `tb_kategori_pengurus_tpq` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kategori_pengurus_tpq`
--

INSERT INTO `tb_kategori_pengurus_tpq` (`id`, `nama`) VALUES
(1, 'Ketua'),
(2, 'Sekretaris'),
(3, 'Bendahara'),
(4, 'Pembina'),
(5, 'Koordinator Pengajar');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pc`
--

CREATE TABLE `tb_pc` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `kontak` varchar(45) DEFAULT NULL,
  `alamat` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='pc = pengurus cabang';

--
-- Dumping data for table `tb_pc`
--

INSERT INTO `tb_pc` (`id`, `nama`, `kontak`, `alamat`) VALUES
(1, 'PC Bumiaji', NULL, NULL),
(2, 'PC Junrejo', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengajar`
--

CREATE TABLE `tb_pengajar` (
  `id` int(11) NOT NULL,
  `id_tpq` int(11) DEFAULT NULL,
  `nama` varchar(105) DEFAULT NULL,
  `link` varchar(100) NOT NULL,
  `kelamin` enum('L','P') DEFAULT NULL COMMENT 'L : Laki Laki , P : Perempuan',
  `tmp_lahir` varchar(45) DEFAULT NULL,
  `tgl_lahir` varchar(20) DEFAULT NULL,
  `pdkn` varchar(45) DEFAULT NULL,
  `pdkn_ket` varchar(45) DEFAULT NULL,
  `status` enum('MT','MS','PB') DEFAULT NULL COMMENT 'MT : Mubalegh Tugasan , MS : Mubalegh Setempat , PB : Pribumi',
  `pkwn` enum('L','M') DEFAULT NULL COMMENT 'L : Lajang, M: Menikah',
  `kontak` varchar(45) DEFAULT NULL,
  `alamat` text,
  `email` varchar(45) DEFAULT NULL,
  `foto` varchar(45) DEFAULT NULL,
  `aktif` enum('A','N') NOT NULL DEFAULT 'N',
  `tgl_buat` datetime NOT NULL,
  `tgl_ubah` datetime NOT NULL,
  `dibuat_oleh` int(11) NOT NULL,
  `diubah_oleh` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabel untuk Pengajar';

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengurus_tpq`
--

CREATE TABLE `tb_pengurus_tpq` (
  `id` int(11) NOT NULL,
  `id_tpq` int(11) DEFAULT NULL,
  `id_kategori_pengurus_tpq` int(11) DEFAULT NULL,
  `nama` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pengurus_tpq`
--

INSERT INTO `tb_pengurus_tpq` (`id`, `id_tpq`, `id_kategori_pengurus_tpq`, `nama`) VALUES
(87, 20, 1, 'Muhyi'),
(88, 20, 2, 'Rifki'),
(89, 20, 3, 'Yusi'),
(90, 20, 4, 'Arief'),
(91, 20, 5, 'Tulas');

-- --------------------------------------------------------

--
-- Table structure for table `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `id` int(11) NOT NULL,
  `id_tpq` int(11) NOT NULL,
  `kategori` enum('CBR','PRJ','RMJ','MDR') NOT NULL COMMENT 'CBR : Caberawit, PRJ : Praremaja , RMJ : Remaja , MDR : Mandiri',
  `nama` varchar(100) NOT NULL,
  `link` varchar(100) NOT NULL,
  `tmp_lahir` varchar(45) DEFAULT NULL,
  `tgl_lahir` varchar(100) DEFAULT NULL,
  `kelamin` enum('L','P') NOT NULL COMMENT 'L : Laki Laki, P : Perempuan',
  `kontak` varchar(45) DEFAULT NULL,
  `alamat` text,
  `foto` text,
  `pkwn` enum('L','M') NOT NULL,
  `aktif` enum('A','N') NOT NULL,
  `tgl_buat` datetime NOT NULL,
  `tgl_ubah` datetime NOT NULL,
  `dibuat_oleh` int(11) NOT NULL,
  `diubah_oleh` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabel untuk siswa';

-- --------------------------------------------------------

--
-- Table structure for table `tb_siswa_hobi`
--

CREATE TABLE `tb_siswa_hobi` (
  `id` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `hobi` varchar(100) DEFAULT NULL,
  `tgl_buat` datetime NOT NULL,
  `tgl_ubah` datetime NOT NULL,
  `dibuat_oleh` int(11) NOT NULL,
  `diubah_oleh` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Table untuk hobi siswa';

-- --------------------------------------------------------

--
-- Table structure for table `tb_siswa_pendidikan`
--

CREATE TABLE `tb_siswa_pendidikan` (
  `id` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL DEFAULT '0',
  `level` enum('CBR','PRMJ','RMJ','MDR') NOT NULL,
  `jenjang` enum('TK','SD','SMP','SMA','SMK','MHS','U','K','F') DEFAULT NULL,
  `tingkat` varchar(100) DEFAULT NULL,
  `keterangan` varchar(200) NOT NULL,
  `aktif` enum('A','N') NOT NULL,
  `tgl_buat` date NOT NULL,
  `tgl_ubah` date NOT NULL,
  `dibuat_oleh` int(11) NOT NULL,
  `diubah_oleh` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_siswa_prestasi`
--

CREATE TABLE `tb_siswa_prestasi` (
  `id` int(11) NOT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `prestasi` varchar(100) DEFAULT NULL,
  `tgl_buat` datetime NOT NULL,
  `tgl_ubah` datetime NOT NULL,
  `dibuat_oleh` int(11) NOT NULL,
  `diubah_oleh` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_tpq`
--

CREATE TABLE `tb_tpq` (
  `id` int(11) NOT NULL,
  `id_pc` int(11) DEFAULT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `link` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `kontak` varchar(45) DEFAULT NULL,
  `alamat` text,
  `wilayah` varchar(100) NOT NULL,
  `logo` text,
  `cover` text,
  `tgl_buat` datetime NOT NULL,
  `tgl_ubah` datetime NOT NULL,
  `dibuat_oleh` int(11) NOT NULL,
  `diubah_oleh` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabel untuk data TPQ';

--
-- Dumping data for table `tb_tpq`
--

INSERT INTO `tb_tpq` (`id`, `id_pc`, `nama`, `link`, `email`, `kontak`, `alamat`, `wilayah`, `logo`, `cover`, `tgl_buat`, `tgl_ubah`, `dibuat_oleh`, `diubah_oleh`) VALUES
(20, 2, 'TPQ Al-Jamaah', 'tpqaljamaah', 'junrejo@gmail.com', '089623993782', 'Junrejo', 'Junrejo', '8hDND3.png', 'XeqeBd.png', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_akun`
--
ALTER TABLE `tb_akun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kategori_pengurus_tpq`
--
ALTER TABLE `tb_kategori_pengurus_tpq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pc`
--
ALTER TABLE `tb_pc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pengajar`
--
ALTER TABLE `tb_pengajar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pengurus_tpq`
--
ALTER TABLE `tb_pengurus_tpq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_siswa_pendidikan`
--
ALTER TABLE `tb_siswa_pendidikan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_siswa_prestasi`
--
ALTER TABLE `tb_siswa_prestasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_tpq`
--
ALTER TABLE `tb_tpq`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_akun`
--
ALTER TABLE `tb_akun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT for table `tb_kategori_pengurus_tpq`
--
ALTER TABLE `tb_kategori_pengurus_tpq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tb_pc`
--
ALTER TABLE `tb_pc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_pengajar`
--
ALTER TABLE `tb_pengajar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tb_pengurus_tpq`
--
ALTER TABLE `tb_pengurus_tpq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;
--
-- AUTO_INCREMENT for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_siswa_pendidikan`
--
ALTER TABLE `tb_siswa_pendidikan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_tpq`
--
ALTER TABLE `tb_tpq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
