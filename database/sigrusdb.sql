-- phpMyAdmin SQL Dump
-- version 4.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 30, 2017 at 08:47 PM
-- Server version: 5.6.22
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sigrusdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_akun`
--

CREATE TABLE IF NOT EXISTS `tb_akun` (
`id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` enum('A','T','P') NOT NULL COMMENT 'A = Admin, T = TPQ , P = Pengajar',
  `id_level` int(10) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

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
(57, 'toriq.354@gmail.com', 'efc5df519268bab152125cca01204874', 'P', 7);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori_pengurus_tpq`
--

CREATE TABLE IF NOT EXISTS `tb_kategori_pengurus_tpq` (
`id` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

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

CREATE TABLE IF NOT EXISTS `tb_pc` (
`id` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `kontak` varchar(45) DEFAULT NULL,
  `alamat` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COMMENT='pc = pengurus cabang';

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

CREATE TABLE IF NOT EXISTS `tb_pengajar` (
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COMMENT='Tabel untuk Pengajar';

--
-- Dumping data for table `tb_pengajar`
--

INSERT INTO `tb_pengajar` (`id`, `id_tpq`, `nama`, `link`, `kelamin`, `tmp_lahir`, `tgl_lahir`, `pdkn`, `pdkn_ket`, `status`, `pkwn`, `kontak`, `alamat`, `email`, `foto`, `aktif`, `tgl_buat`, `tgl_ubah`, `dibuat_oleh`, `diubah_oleh`) VALUES
(4, 18, 'Hanna Anggraini', 'hannaanggr', 'P', 'okeoce', '12-04-2002', 'SMA', 'SMK PGRI 3 Malang', 'PB', 'L', '089623993782', 'oke123', 'hanna@gmail.com', 'W6Fap.jpg', 'A', '2017-04-25 00:00:00', '0000-00-00 00:00:00', 0, 0),
(7, 1, 'Toriq Pria Dhigfora', 'toriqpriad', 'L', 'Malang', '11-04-1995', 'SRJ', 'S1 - UMM - Teknik Informatika', 'MT', 'L', '089623993782', 'Junrejo', 'toriq.354@gmail.com', 'bca97111266dc6b186e30ffffcf6a418.jpg', 'A', '2017-04-25 00:00:00', '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengurus_tpq`
--

CREATE TABLE IF NOT EXISTS `tb_pengurus_tpq` (
`id` int(11) NOT NULL,
  `id_tpq` int(11) DEFAULT NULL,
  `id_kategori_pengurus_tpq` int(11) DEFAULT NULL,
  `nama` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pengurus_tpq`
--

INSERT INTO `tb_pengurus_tpq` (`id`, `id_tpq`, `id_kategori_pengurus_tpq`, `nama`) VALUES
(67, 16, 1, 'D'),
(68, 16, 2, 'E'),
(69, 16, 3, 'F'),
(70, 16, 4, 'G'),
(71, 16, 5, 'H'),
(77, 18, 1, 'a'),
(78, 18, 2, 'b'),
(79, 18, 3, 'c'),
(80, 18, 4, 'd'),
(81, 18, 5, 'e'),
(82, 1, 1, 'Muhyi'),
(83, 19, 2, ''),
(84, 19, 3, ''),
(85, 19, 4, ''),
(86, 19, 5, '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_siswa`
--

CREATE TABLE IF NOT EXISTS `tb_siswa` (
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COMMENT='Tabel untuk siswa';

--
-- Dumping data for table `tb_siswa`
--

INSERT INTO `tb_siswa` (`id`, `id_tpq`, `kategori`, `nama`, `link`, `tmp_lahir`, `tgl_lahir`, `kelamin`, `kontak`, `alamat`, `foto`, `pkwn`, `aktif`, `tgl_buat`, `tgl_ubah`, `dibuat_oleh`, `diubah_oleh`) VALUES
(1, 1, 'CBR', 'alen', 'alen', 'asdsa', '27-04-2017', 'L', '123', '3sdsdsadas', 'ekZmhz.PNG', 'L', 'A', '2017-04-27 00:00:00', '2017-04-28 00:00:00', 0, 0),
(2, 1, 'MDR', 'ole', 'ole', 'adas', '27-04-2017', 'L', '32343', 'asdadas', 'sUjIPN.jpg', 'L', 'A', '2017-04-27 00:00:00', '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_siswa_hobi`
--

CREATE TABLE IF NOT EXISTS `tb_siswa_hobi` (
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

CREATE TABLE IF NOT EXISTS `tb_siswa_pendidikan` (
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

CREATE TABLE IF NOT EXISTS `tb_siswa_prestasi` (
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

CREATE TABLE IF NOT EXISTS `tb_tpq` (
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 COMMENT='Tabel untuk data TPQ';

--
-- Dumping data for table `tb_tpq`
--

INSERT INTO `tb_tpq` (`id`, `id_pc`, `nama`, `link`, `email`, `kontak`, `alamat`, `wilayah`, `logo`, `cover`, `tgl_buat`, `tgl_ubah`, `dibuat_oleh`, `diubah_oleh`) VALUES
(1, 2, 'Al-Hijr', 'alhijr', 'email@gmail.com', '089623993782', 'Junrejo', 'Junrejo', '80Ggw.jpg', '4013e7a94a8994bf1ec4546f0fc51211.PNG', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(16, 2, 'al-jannah', 'aljannah', 'aljannah@gmail.com', '089623993782', 'Gondang', 'Sisir 1', 'a14f920f5d4109a621c9358c94329b9e.PNG', '6e4cf3dbb6b6bf7cdd0a1ac49b2bf613.PNG', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(18, 1, 'H.Nuruddin', 'hnuruddin', 'oke@gmail.com', '0897232312', 'oke123', 'Areng Areng', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(19, 2, 'Al-Kahfi', 'alkahfi', 'kahfi@gmail.com', '1234', 'asda', 'Ngantang', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0);

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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `tb_kategori_pengurus_tpq`
--
ALTER TABLE `tb_kategori_pengurus_tpq`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tb_pc`
--
ALTER TABLE `tb_pc`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_pengajar`
--
ALTER TABLE `tb_pengajar`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tb_pengurus_tpq`
--
ALTER TABLE `tb_pengurus_tpq`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=87;
--
-- AUTO_INCREMENT for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_siswa_pendidikan`
--
ALTER TABLE `tb_siswa_pendidikan`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_tpq`
--
ALTER TABLE `tb_tpq`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
