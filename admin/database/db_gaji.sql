-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 10 Des 2019 pada 15.29
-- Versi Server: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_gaji`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

CREATE TABLE IF NOT EXISTS `absensi` (
  `absen_id` int(11) NOT NULL,
  `karyawan_id` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `absen_tgl` date NOT NULL,
  `absen_masuk` time NOT NULL,
  `absen_pulang` time NOT NULL,
  `absen_status` enum('Terlambat','Tepat Waktu') NOT NULL,
  `absen_jam` double NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `absensi`
--

INSERT INTO `absensi` (`absen_id`, `karyawan_id`, `absen_tgl`, `absen_masuk`, `absen_pulang`, `absen_status`, `absen_jam`) VALUES
(11, 'IMF110895', '2019-12-08', '08:09:00', '16:00:00', 'Terlambat', 4.8),
(12, 'IMF110895', '2019-12-06', '08:09:00', '16:00:00', 'Terlambat', 5.2),
(13, 'JKL0010101', '2019-12-04', '08:00:00', '14:00:00', 'Terlambat', 6),
(14, 'ABC', '2019-12-06', '08:09:00', '16:00:00', 'Terlambat', 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id_adm` int(5) NOT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `no_telp` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `level` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT 'user',
  `blokir` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `foto_adm` text COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_adm`, `username`, `password`, `nama_lengkap`, `email`, `no_telp`, `level`, `blokir`, `foto_adm`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'admin@angkasa.com', '08238923848', 'admin', 'N', 'user.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bonus`
--

CREATE TABLE IF NOT EXISTS `bonus` (
  `bonus_id` int(11) NOT NULL,
  `karyawan_id` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `bonus_tgl` date NOT NULL,
  `bonus_jml` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bonus`
--

INSERT INTO `bonus` (`bonus_id`, `karyawan_id`, `bonus_tgl`, `bonus_jml`) VALUES
(3, 'IMF110895', '2019-12-08', 240000),
(4, 'IMF110895', '2019-12-08', 10000),
(5, 'ABC', '2019-12-05', 250000),
(6, 'JKL0010101', '2019-12-04', 372000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE IF NOT EXISTS `jadwal` (
  `jadwal_id` int(5) NOT NULL,
  `jadwal_nama` varchar(100) NOT NULL,
  `jadwal_in` time NOT NULL,
  `jadwal_out` time NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jadwal`
--

INSERT INTO `jadwal` (`jadwal_id`, `jadwal_nama`, `jadwal_in`, `jadwal_out`) VALUES
(14, 'Shift 2', '13:00:00', '21:00:00'),
(13, 'Shift 1', '08:00:00', '17:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE IF NOT EXISTS `karyawan` (
  `karyawan_id` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `karyawan_nama` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `karyawan_jk` enum('Laki-Laki','Perempuan') COLLATE latin1_general_ci NOT NULL,
  `karyawan_alamat` text COLLATE latin1_general_ci NOT NULL,
  `karyawan_telp` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `karyawan_tgllhr` date NOT NULL,
  `karyawan_tptlhr` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `karyawan_foto` text COLLATE latin1_general_ci NOT NULL,
  `karyawan_masuk` date NOT NULL,
  `posisi_id` int(5) NOT NULL,
  `jadwal_id` int(5) NOT NULL,
  `karyawan_status` enum('Aktif','Nonaktif') COLLATE latin1_general_ci NOT NULL,
  `karyawan_create` date NOT NULL,
  `id_adm` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`karyawan_id`, `karyawan_nama`, `karyawan_jk`, `karyawan_alamat`, `karyawan_telp`, `karyawan_tgllhr`, `karyawan_tptlhr`, `karyawan_foto`, `karyawan_masuk`, `posisi_id`, `jadwal_id`, `karyawan_status`, `karyawan_create`, `id_adm`) VALUES
('IMF110895', 'TEST', 'Laki-Laki', 'ASKDJKAJ', '0819283918', '2019-12-31', 'KSDJKA', '04122019081245g.png', '2019-12-31', 9, 13, 'Aktif', '0000-00-00', 1),
('JKL0010101', 'Karyawan Cuy', 'Perempuan', 'Jakrta', '081298391', '2019-12-31', 'Jakarta', '06122019191207g.png', '2019-12-31', 8, 14, 'Aktif', '2019-12-06', 1),
('ABC', 'TESTING', 'Laki-Laki', 'askjhdka', '0909090', '2019-12-11', 'ajksdk', 'askjhdk', '2019-12-10', 9, 14, 'Aktif', '2019-12-10', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kasbon`
--

CREATE TABLE IF NOT EXISTS `kasbon` (
  `kasbon_id` int(11) NOT NULL,
  `karyawan_id` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `kasbon_tgl` date NOT NULL,
  `kasbon_jml` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kasbon`
--

INSERT INTO `kasbon` (`kasbon_id`, `karyawan_id`, `kasbon_tgl`, `kasbon_jml`) VALUES
(2, 'IMF110895', '2019-12-06', 9090),
(3, 'IMF110895', '2019-12-08', 30000),
(4, 'JKL0010101', '2019-12-03', 175000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `lembur`
--

CREATE TABLE IF NOT EXISTS `lembur` (
  `lembur_id` int(11) NOT NULL,
  `lembur_tgl` date NOT NULL,
  `lembur_jam` int(2) NOT NULL,
  `karyawan_id` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `lembur`
--

INSERT INTO `lembur` (`lembur_id`, `lembur_tgl`, `lembur_jam`, `karyawan_id`) VALUES
(1, '2019-12-08', 2, 'IMF110895'),
(2, '2019-12-07', 3, 'IMF110895'),
(3, '2019-12-04', 6, 'JKL0010101');

-- --------------------------------------------------------

--
-- Struktur dari tabel `posisi`
--

CREATE TABLE IF NOT EXISTS `posisi` (
  `posisi_id` int(5) NOT NULL,
  `posisi_nama` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `posisi_rate` int(10) NOT NULL,
  `posisi_lembur` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `posisi`
--

INSERT INTO `posisi` (`posisi_id`, `posisi_nama`, `posisi_rate`, `posisi_lembur`) VALUES
(9, 'Junior Sales', 10000, 8000),
(8, 'IT Support', 15000, 12000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `potongan`
--

CREATE TABLE IF NOT EXISTS `potongan` (
  `potongan_id` int(11) NOT NULL,
  `potongan_desc` varchar(50) NOT NULL,
  `potongan_jml` int(11) NOT NULL,
  `id_adm` int(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `potongan`
--

INSERT INTO `potongan` (`potongan_id`, `potongan_desc`, `potongan_jml`, `id_adm`) VALUES
(4, 'BPJSTK', 35000, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`absen_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_adm`);

--
-- Indexes for table `bonus`
--
ALTER TABLE `bonus`
  ADD PRIMARY KEY (`bonus_id`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`jadwal_id`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`karyawan_id`);

--
-- Indexes for table `kasbon`
--
ALTER TABLE `kasbon`
  ADD PRIMARY KEY (`kasbon_id`);

--
-- Indexes for table `lembur`
--
ALTER TABLE `lembur`
  ADD PRIMARY KEY (`lembur_id`);

--
-- Indexes for table `posisi`
--
ALTER TABLE `posisi`
  ADD PRIMARY KEY (`posisi_id`);

--
-- Indexes for table `potongan`
--
ALTER TABLE `potongan`
  ADD PRIMARY KEY (`potongan_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `absen_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_adm` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `bonus`
--
ALTER TABLE `bonus`
  MODIFY `bonus_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `jadwal_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `kasbon`
--
ALTER TABLE `kasbon`
  MODIFY `kasbon_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `lembur`
--
ALTER TABLE `lembur`
  MODIFY `lembur_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `posisi`
--
ALTER TABLE `posisi`
  MODIFY `posisi_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `potongan`
--
ALTER TABLE `potongan`
  MODIFY `potongan_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
