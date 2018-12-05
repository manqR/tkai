-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.6-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             9.1.0.4867
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for malaka
CREATE DATABASE IF NOT EXISTS `malaka` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `malaka`;


-- Dumping structure for table malaka.beasiswa
CREATE TABLE IF NOT EXISTS `beasiswa` (
  `idsiswa` char(10) NOT NULL,
  `jenis_beasiswa` varchar(50) DEFAULT NULL,
  `penyelenggara` varchar(50) DEFAULT NULL,
  `tahun_mulai` year(4) DEFAULT NULL,
  `tahun_selesai` year(4) DEFAULT NULL,
  PRIMARY KEY (`idsiswa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table malaka.beasiswa: ~0 rows (approximately)
/*!40000 ALTER TABLE `beasiswa` DISABLE KEYS */;
/*!40000 ALTER TABLE `beasiswa` ENABLE KEYS */;


-- Dumping structure for table malaka.biaya_tidak_tetap
CREATE TABLE IF NOT EXISTS `biaya_tidak_tetap` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keterangan` varchar(50) DEFAULT NULL,
  `nominal` double DEFAULT NULL,
  `user_created` varchar(50) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Dumping data for table malaka.biaya_tidak_tetap: ~5 rows (approximately)
/*!40000 ALTER TABLE `biaya_tidak_tetap` DISABLE KEYS */;
INSERT INTO `biaya_tidak_tetap` (`id`, `keterangan`, `nominal`, `user_created`, `date_created`) VALUES
	(1, 'Wisuda', 15000000, 'admin', '2018-10-16 03:21:50'),
	(2, '﻿wisuda', 150000, 'admin', '2018-11-17 07:28:48'),
	(3, '﻿wisuda', 150000, 'admin', '2018-11-17 07:32:10'),
	(4, '﻿wisuda', 150000, 'admin', '2018-11-17 07:32:37'),
	(5, '﻿tagihan1', 15000, 'admin', '2018-11-17 11:41:30'),
	(6, 'tagihan 2', 40000, 'admin', '2018-11-17 11:41:30'),
	(7, 'Outing', 500000, 'admin', '2018-11-24 10:34:10');
/*!40000 ALTER TABLE `biaya_tidak_tetap` ENABLE KEYS */;


-- Dumping structure for table malaka.cart
CREATE TABLE IF NOT EXISTS `cart` (
  `idcart` int(11) NOT NULL AUTO_INCREMENT,
  `idsiswa` char(10) NOT NULL,
  `key_` varchar(50) NOT NULL,
  `idkelas` char(50) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `nominal` double NOT NULL,
  `flag` int(11) NOT NULL,
  `user_create` varchar(50) NOT NULL,
  `date_create` datetime NOT NULL,
  PRIMARY KEY (`idcart`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

-- Dumping data for table malaka.cart: ~25 rows (approximately)
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` (`idcart`, `idsiswa`, `key_`, `idkelas`, `keterangan`, `nominal`, `flag`, `user_create`, `date_create`) VALUES
	(26, '176001', 'BIL86936', 'X', 'BIL86936', 15000000, 2, 'admin', '2018-11-10 00:00:00'),
	(27, '176001', 'praktik', '6', 'praktik', 200000, 2, 'admin', '2018-11-10 00:00:00'),
	(28, '176001', 'praktik', '6', 'praktik', 200000, 2, 'admin', '2018-11-10 00:00:00'),
	(29, '176001', 'BIL40678', 'X', 'BIL40678', 15000000, 2, 'admin', '2018-11-10 00:00:00'),
	(30, '176002', 'praktik', '10', 'praktik', 200000, 2, 'admin', '2018-11-10 00:00:00'),
	(31, '176003', 'praktik', '10', 'praktik', 200000, 2, 'admin', '2018-11-10 00:00:00'),
	(32, '176001', 'lab_inggris', '10', 'lab_inggris', 150000, 2, 'admin', '2018-11-10 00:00:00'),
	(33, '176001', 'lab_inggris', '6', 'lab_inggris', 150000, 2, 'admin', '2018-11-10 00:00:00'),
	(34, '176001', 'BIL43704', 'X', 'BIL43704', 15000000, 2, 'admin', '2018-11-10 00:00:00'),
	(35, '176001', 'BIL29022', 'X', 'BIL29022', 15000000, 2, 'admin', '2018-11-10 00:00:00'),
	(36, '176001', 'BIL34426', 'X', 'BIL34426', 15000000, 2, 'admin', '2018-11-11 00:00:00'),
	(37, '176001', 'perpustakaan', '10', 'perpustakaan', 150000, 2, 'admin', '2018-11-11 00:00:00'),
	(38, '176001', 'semester_b', '6', 'semester_b', 300000, 1, 'admin', '2018-11-17 00:00:00'),
	(39, '176001', 'osis', '6', 'osis', 200000, 1, 'admin', '2018-11-17 00:00:00'),
	(40, '176007', 'lks', '11', 'lks', 300000, 2, 'admin', '2018-11-24 00:00:00'),
	(41, '176007', 'pengembangan', '11', 'pengembangan', 15000, 2, 'admin', '2018-11-24 00:00:00'),
	(42, '176007', 'perpustakaan', '11', 'perpustakaan', 150000, 2, 'admin', '2018-11-24 00:00:00'),
	(43, '176007', 'praktik', '11', 'praktik', 250000, 2, 'admin', '2018-11-24 00:00:00'),
	(44, '176007', 'asuransi', '11', 'asuransi', 100000, 2, 'admin', '2018-11-24 00:00:00'),
	(45, '176007', 'mpls', '11', 'mpls', 200000, 2, 'admin', '2018-11-24 00:00:00'),
	(46, '176002', 'asuransi', '10', 'asuransi', 200000, 2, 'admin', '2018-11-24 00:00:00'),
	(47, '176002', 'perpustakaan', '11', 'perpustakaan', 150000, 2, 'admin', '2018-11-24 00:00:00'),
	(48, '176002', 'lks', '10', 'lks', 250000, 1, 'admin', '2018-11-24 00:00:00'),
	(49, '176002', 'pengembangan', '10', 'pengembangan', 200000, 1, 'admin', '2018-11-24 00:00:00'),
	(50, '176002', 'semester_a', '10', 'semester_a', 300000, 1, 'admin', '2018-11-24 00:00:00');
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;


-- Dumping structure for table malaka.detail_group
CREATE TABLE IF NOT EXISTS `detail_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idsiswa` char(50) NOT NULL,
  `idgroup` int(11) NOT NULL,
  `tgl_add` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;

-- Dumping data for table malaka.detail_group: ~8 rows (approximately)
/*!40000 ALTER TABLE `detail_group` DISABLE KEYS */;
INSERT INTO `detail_group` (`id`, `idsiswa`, `idgroup`, `tgl_add`) VALUES
	(59, '176001', 26, '2018-09-15 00:00:00'),
	(60, '176002', 27, '2018-09-15 00:00:00'),
	(61, '176003', 27, '2018-09-15 00:00:00'),
	(62, '176001', 27, '2018-11-02 00:00:00'),
	(65, '176006', 28, '2018-11-24 00:00:00'),
	(66, '176007', 28, '2018-11-24 00:00:00'),
	(67, '176008', 28, '2018-11-24 00:00:00');
/*!40000 ALTER TABLE `detail_group` ENABLE KEYS */;


-- Dumping structure for table malaka.import
CREATE TABLE IF NOT EXISTS `import` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori` varchar(50) DEFAULT NULL,
  `file` varchar(50) NOT NULL,
  `user` varchar(50) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table malaka.import: ~2 rows (approximately)
/*!40000 ALTER TABLE `import` DISABLE KEYS */;
INSERT INTO `import` (`id`, `kategori`, `file`, `user`, `date`) VALUES
	(1, 'master', 'import/1542434568.csv', NULL, NULL),
	(2, 'master', 'import/1542436128.csv', NULL, NULL);
/*!40000 ALTER TABLE `import` ENABLE KEYS */;


-- Dumping structure for table malaka.jurusan
CREATE TABLE IF NOT EXISTS `jurusan` (
  `idjurusan` char(10) NOT NULL,
  `nama_jurusan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idjurusan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table malaka.jurusan: ~3 rows (approximately)
/*!40000 ALTER TABLE `jurusan` DISABLE KEYS */;
INSERT INTO `jurusan` (`idjurusan`, `nama_jurusan`) VALUES
	('MM', 'Multimedia'),
	('TKJ', 'Teknik Komputer Jaringan '),
	('TPM', 'Teknik Pemesinan'),
	('TPO', 'Teknik Mesin Otomotif ');
/*!40000 ALTER TABLE `jurusan` ENABLE KEYS */;


-- Dumping structure for table malaka.kelas
CREATE TABLE IF NOT EXISTS `kelas` (
  `idkelas` int(11) NOT NULL AUTO_INCREMENT,
  `kode` char(10) NOT NULL,
  `idajaran` int(11) NOT NULL,
  `idjurusan` char(10) NOT NULL,
  `nama_kelas` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`kode`,`idajaran`,`idjurusan`),
  KEY `idkelas` (`idkelas`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table malaka.kelas: ~4 rows (approximately)
/*!40000 ALTER TABLE `kelas` DISABLE KEYS */;
INSERT INTO `kelas` (`idkelas`, `kode`, `idajaran`, `idjurusan`, `nama_kelas`, `status`) VALUES
	(6, 'X', 13, 'TPM', 'Kelas 10', 1),
	(11, 'X', 16, 'MM', 'Kelas 10', 1),
	(7, 'XI', 13, 'TPO', 'Kelas 11', 1),
	(10, 'XII', 15, 'TKJ', 'Kelas 12', 1);
/*!40000 ALTER TABLE `kelas` ENABLE KEYS */;


-- Dumping structure for table malaka.kelas_group
CREATE TABLE IF NOT EXISTS `kelas_group` (
  `idgroup` int(11) NOT NULL AUTO_INCREMENT,
  `idkelas` int(11) NOT NULL,
  `wali_kelas` varchar(50) NOT NULL,
  `status` enum('A','I') NOT NULL,
  PRIMARY KEY (`idgroup`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

-- Dumping data for table malaka.kelas_group: ~2 rows (approximately)
/*!40000 ALTER TABLE `kelas_group` DISABLE KEYS */;
INSERT INTO `kelas_group` (`idgroup`, `idkelas`, `wali_kelas`, `status`) VALUES
	(26, 6, 'Faishal', 'A'),
	(27, 10, 'Bagus', 'A'),
	(28, 11, 'Wahid', 'A');
/*!40000 ALTER TABLE `kelas_group` ENABLE KEYS */;


-- Dumping structure for table malaka.migration
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table malaka.migration: ~2 rows (approximately)
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` (`version`, `apply_time`) VALUES
	('m000000_000000_base', 1531710340),
	('m130524_201442_init', 1531710344);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;


-- Dumping structure for table malaka.months
CREATE TABLE IF NOT EXISTS `months` (
  `idbulan` int(11) NOT NULL,
  `namabulan` varchar(50) DEFAULT NULL,
  `urutan` int(11) DEFAULT NULL,
  PRIMARY KEY (`idbulan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table malaka.months: ~12 rows (approximately)
/*!40000 ALTER TABLE `months` DISABLE KEYS */;
INSERT INTO `months` (`idbulan`, `namabulan`, `urutan`) VALUES
	(1, 'Januari', 7),
	(2, 'Februari', 8),
	(3, 'Maret', 9),
	(4, 'April', 10),
	(5, 'Mei', 11),
	(6, 'Juni', 12),
	(7, 'Juli', 1),
	(8, 'Agustus', 2),
	(9, 'September', 3),
	(10, 'Oktober', 4),
	(11, 'November', 5),
	(12, 'Desember', 6);
/*!40000 ALTER TABLE `months` ENABLE KEYS */;


-- Dumping structure for table malaka.pencatatan_keuangan
CREATE TABLE IF NOT EXISTS `pencatatan_keuangan` (
  `idcatat` int(11) NOT NULL AUTO_INCREMENT,
  `no_pencatatan` char(10) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `nominal` double NOT NULL,
  `flag` int(11) NOT NULL,
  `user_create` varchar(50) NOT NULL,
  `date_create` datetime NOT NULL,
  PRIMARY KEY (`idcatat`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table malaka.pencatatan_keuangan: ~4 rows (approximately)
/*!40000 ALTER TABLE `pencatatan_keuangan` DISABLE KEYS */;
INSERT INTO `pencatatan_keuangan` (`idcatat`, `no_pencatatan`, `kategori`, `keterangan`, `nominal`, `flag`, `user_create`, `date_create`) VALUES
	(1, 'IN31573', 'pemasukan', 'abcd', 100000, 1, 'admin', '2018-10-17 05:57:21'),
	(2, 'OUT45484', 'pengeluaran', 'abcd', 100000, 1, 'admin', '2018-10-17 05:58:29'),
	(3, 'OUT19551', 'pengeluaran', 'Beli A', 3000000, 1, 'admin', '2018-11-24 10:39:43'),
	(4, 'IN51653', 'pemasukan', 'MASUk A', 200000, 1, 'admin', '2018-11-24 10:40:06');
/*!40000 ALTER TABLE `pencatatan_keuangan` ENABLE KEYS */;


-- Dumping structure for table malaka.prestasi
CREATE TABLE IF NOT EXISTS `prestasi` (
  `idsiswa` char(10) NOT NULL,
  `jenis_prestasi` varchar(50) DEFAULT NULL,
  `tingkat` varchar(50) DEFAULT NULL,
  `nama_prestasi` varchar(50) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  `penyelenggara` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idsiswa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table malaka.prestasi: ~0 rows (approximately)
/*!40000 ALTER TABLE `prestasi` DISABLE KEYS */;
/*!40000 ALTER TABLE `prestasi` ENABLE KEYS */;


-- Dumping structure for table malaka.siswa
CREATE TABLE IF NOT EXISTS `siswa` (
  `idsiswa` char(10) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `jenis_kelamin` char(10) DEFAULT NULL,
  `nisn` char(20) DEFAULT NULL,
  `no_seri_ijazah_smp` char(20) DEFAULT NULL,
  `no_seri_skhun_smp` char(20) DEFAULT NULL,
  `no_ujian_nasional` char(20) DEFAULT NULL,
  `nik` char(20) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `agama` varchar(50) DEFAULT NULL,
  `alamat` text,
  `kelurahan` varchar(50) DEFAULT NULL,
  `kecamatan` varchar(50) DEFAULT NULL,
  `kota` varchar(50) DEFAULT NULL,
  `provinsi` varchar(50) DEFAULT NULL,
  `transportasi` varchar(50) DEFAULT NULL,
  `tlp_rumah` char(10) DEFAULT NULL,
  `hp` char(14) DEFAULT NULL,
  `email` char(50) DEFAULT NULL,
  `status_kps` tinyint(4) DEFAULT NULL,
  `no_kps` char(20) DEFAULT NULL,
  `tinggi_badan` int(11) DEFAULT NULL,
  `berat_badan` float DEFAULT NULL,
  `jarak_tempat_tinggal` int(11) DEFAULT NULL,
  `waktu_tempuh` int(11) DEFAULT NULL,
  `jml_saudara` int(11) DEFAULT NULL,
  `user_create` varchar(50) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `user_update` varchar(50) DEFAULT NULL,
  `date_update` datetime DEFAULT NULL,
  `urutan` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`urutan`,`idsiswa`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Dumping data for table malaka.siswa: ~13 rows (approximately)
/*!40000 ALTER TABLE `siswa` DISABLE KEYS */;
INSERT INTO `siswa` (`idsiswa`, `nama_lengkap`, `jenis_kelamin`, `nisn`, `no_seri_ijazah_smp`, `no_seri_skhun_smp`, `no_ujian_nasional`, `nik`, `tempat_lahir`, `tanggal_lahir`, `agama`, `alamat`, `kelurahan`, `kecamatan`, `kota`, `provinsi`, `transportasi`, `tlp_rumah`, `hp`, `email`, `status_kps`, `no_kps`, `tinggi_badan`, `berat_badan`, `jarak_tempat_tinggal`, `waktu_tempuh`, `jml_saudara`, `user_create`, `date_create`, `user_update`, `date_update`, `urutan`) VALUES
	('176001', 'Abie Nugraha', 'L', '21770861', 'DN-01 DI/06 0081374', 'DN-01 D 0102083', '', '367109280320006', '', '0000-00-00', 'Islam', 'Kp. Sumur Rt.08/10 Klender Duren Sawit Jaktim', 'Klender', 'Duren Sawit', 'Jakarta Timur', 'DKI Jakarta', 'Umum', '', '87885293983', 'email1@yahoo.com', 0, '', 0, 0, 0, 0, 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 1),
	('176002', 'Achmad Bagas Maulana', 'L', '25348468', 'DN-01 DI/06 0093467', 'DN-01 D 0119171', '', '3175012706020001', '', '0000-00-00', 'Islam', 'Jl. Pisangan Baru Timur VII No.9 Rt.11/10 Mataman Jaktim', 'Pisangan Baru', 'Matraman', 'Jakarta Timur', 'DKI Jakarta', 'Umum', '', '89652581811', 'email2@yahoo.com', 0, '', 0, 0, 0, 0, 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 2),
	('176003', 'Adihtya Setia Budi', 'L', '23299571', 'DN-01 DI/06 0079734', 'DN-01 D 0100648', '', '', '', '0000-00-00', 'Islam', 'Kp. Sumur Rt.07/07 No. 152 Klender Jaktim', 'Klender', 'Duren Sawit', 'Jakarta Timur', 'DKI Jakarta', 'Motor', '', '86777767673', 'email3@yahoo.com', 0, '', 0, 0, 0, 0, 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 3),
	('176004', 'Andriyanto', 'L', '9766816', 'DN-01 DI/06 0089595', 'DN-01 D 0110945', '', '3175061104001002', '', '0000-00-00', 'Islam', 'Jl. Pulo Lio Rt.09/11 Pulo Gadung Cakung Jaktim', 'Pulo Gadung', 'Cakung', 'Jakarta Timur', 'DKI Jakarta', 'Umum', '', '83870858765', 'email4@yahoo.com', 0, '', 0, 0, 0, 0, 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 4),
	('176005', 'Angel', 'P', '33938706', 'DN-01 DI/13 0006445', 'DN-01 D 0110331', '', '3603140204020004', '', '0000-00-00', 'Kristen', 'Jl. Raya Komarudin Rt.05/06 No.88 B Ujung Krawang Cakung Jaktim', 'Ujung Krawang', 'Cakung', 'Jakarta Timur', 'DKI Jakarta', 'Motor', '', '81512864715', 'email5@yahoo.com', 0, '', 0, 0, 0, 0, 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 5),
	('176006', 'Auzan Abi Nubli', 'L', '26211299', 'DN-01 DI/06 0083781', 'DN-01 D 0103740', '', '3175011601020011', '', '0000-00-00', 'Islam', 'Moncokerto III/16 Rt.07/13 Utan Kayu Selatan Jaktim', 'Utan Kayu Selatan', 'Matraman', 'Jakarta Timur', 'DKI Jakarta', 'Motor', '', '8176819914', 'email6@yahoo.com', 0, '', 0, 0, 0, 0, 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 6),
	('176007', 'Bunga Anggraini Lestari', 'P', '14935196', 'DN-01 DI/06 0082800', 'DN-01 D 0102758', '', '3175076703010012', '', '0000-00-00', 'Islam', 'Jl. Madrasah Rt.01/10 Cilungup Duren Sawit Jaktim', 'Cilungup', 'Duren Sawit', 'Jakarta Timur', 'DKI Jakarta', 'Umum', '', '87875114226', 'email7@yahoo.com', 0, '', 0, 0, 0, 0, 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 7),
	('176008', 'Charissa Kamila Azzahra', 'P', '13657490', 'DN-01 DI/06 0083418', 'DN-01 DI/06 0083418', '', '', '', '0000-00-00', 'Islam', 'Kp. Buaran Baru Jl. Cobra I E/17 Rt.07/15 Duren Sawit Jaktim ', 'Duren Sawit', 'Duren Sawit', 'Jakarta Timur', 'DKI Jakarta', 'Umum', '', '82122672741', 'email8@yahoo.com', 0, '', 0, 0, 0, 0, 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 8),
	('176009', 'Dea Ardelia', 'P', '16257334', 'DN-01 DI/06 0082836', 'DN-01 D 0102723', '', '317507561101006', '', '0000-00-00', 'Islam', 'Rusun Prumnas Klender Blk.47/III/II Malaka Jaya Jaktim', 'Malaka jaya', 'Duren Sawit', 'Jakarta Timur', 'DKI Jakarta', 'Motor', '', '87876262910', 'email9@yahoo.com', 0, '', 0, 0, 0, 0, 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 9),
	('176010', 'Dea Putri Amanda', 'P', '21617255', 'DN-01 DI/06 0083701', 'DN-01 D 0103657', '', '317507460602004', '', '0000-00-00', 'Islam', 'Bintara 17 Rt.10/03 Bintara Jaya Bekasi Barat', 'Bintara', 'Bekasi Barat', 'Bekasi', 'Jawa Barat', 'Umum', '', '87877488012', 'email10@yahoo.com', 0, '', 0, 0, 0, 0, 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 10),
	('176011', 'Difa Saif Abdillah', 'L', '11390863', 'DN-01 DI/06 0084822', 'DN-01 D 0105958', '', '3175080804010002', '', '0000-00-00', 'Islam', 'Pangkalan Jati V Rt.07/05 No.78 Cipinang Melayu Jaktim', 'Cipinang Melayu', 'Makasar', 'Jakarta Timur', 'DKI Jakarta', 'Motor', '', '87837981256', 'email11@yahoo.com', 0, '', 0, 0, 0, 0, 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 11),
	('176012', 'Dzaki Febriano', 'L', '20556468', 'DN-01 DI/13 0008913', 'DN-01 DI/13 0008913', '', '317507210202014', '', '0000-00-00', 'Islam', 'Jl. Nusa Indah V/4/26 Rt.04/04 Malaka Jaya Jaktim', 'Malaka jaya', 'Duren Sawit', 'Jakarta Timur', 'DKI Jakarta', 'Umum', '', '', 'email12@yahoo.com', 0, '', 0, 0, 0, 0, 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 12),
	('176013', 'Fadel Fillah Akbar', 'L', '10087563', 'DN-01 DI/06 0091682', 'DN-01 D 0113137', '', '31750302120100011', '', '0000-00-00', 'Islam', 'Cipinang Lontar Rt.10/06 Cipinang Muara Jatinegara Jaktim', 'Cipinang Muara', 'Jatinegara', 'Jakarta Timur', 'DKI Jakarta', 'Umum', '218573155', '', 'email13@yahoo.com', 0, '', 0, 0, 0, 0, 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 13);
/*!40000 ALTER TABLE `siswa` ENABLE KEYS */;


-- Dumping structure for table malaka.spp
CREATE TABLE IF NOT EXISTS `spp` (
  `idspp` int(11) NOT NULL AUTO_INCREMENT,
  `idtagihan` char(50) NOT NULL,
  `besaran` double NOT NULL,
  `bulan` varchar(50) NOT NULL,
  `user_create` varchar(50) NOT NULL,
  `user_update` varchar(50) DEFAULT NULL,
  `date_create` datetime NOT NULL,
  `date_update` datetime DEFAULT NULL,
  PRIMARY KEY (`idspp`)
) ENGINE=InnoDB AUTO_INCREMENT=460 DEFAULT CHARSET=latin1;

-- Dumping data for table malaka.spp: ~36 rows (approximately)
/*!40000 ALTER TABLE `spp` DISABLE KEYS */;
INSERT INTO `spp` (`idspp`, `idtagihan`, `besaran`, `bulan`, `user_create`, `user_update`, `date_create`, `date_update`) VALUES
	(400, 'BIL0001', 300000, 'Juli', 'admin', NULL, '2018-09-15 10:54:06', NULL),
	(401, 'BIL0001', 300000, 'Agustus', 'admin', NULL, '2018-09-15 10:54:06', NULL),
	(402, 'BIL0001', 300000, 'September', 'admin', NULL, '2018-09-15 10:54:06', NULL),
	(403, 'BIL0001', 300000, 'Oktober', 'admin', NULL, '2018-09-15 10:54:06', NULL),
	(404, 'BIL0001', 300000, 'November', 'admin', NULL, '2018-09-15 10:54:06', NULL),
	(405, 'BIL0001', 300000, 'Desember', 'admin', NULL, '2018-09-15 10:54:06', NULL),
	(406, 'BIL0001', 300000, 'Januari', 'admin', NULL, '2018-09-15 10:54:06', NULL),
	(407, 'BIL0001', 300000, 'Februari', 'admin', NULL, '2018-09-15 10:54:06', NULL),
	(408, 'BIL0001', 300000, 'Maret', 'admin', NULL, '2018-09-15 10:54:06', NULL),
	(409, 'BIL0001', 300000, 'April', 'admin', NULL, '2018-09-15 10:54:06', NULL),
	(410, 'BIL0001', 300000, 'Mei', 'admin', NULL, '2018-09-15 10:54:06', NULL),
	(411, 'BIL0001', 300000, 'Juni', 'admin', NULL, '2018-09-15 10:54:06', NULL),
	(436, 'BIL0002', 300000, 'Juli', 'admin', NULL, '2018-11-07 10:18:23', NULL),
	(437, 'BIL0002', 300000, 'Agustus', 'admin', NULL, '2018-11-07 10:18:23', NULL),
	(438, 'BIL0002', 300000, 'September', 'admin', NULL, '2018-11-07 10:18:23', NULL),
	(439, 'BIL0002', 300000, 'Oktober', 'admin', NULL, '2018-11-07 10:18:23', NULL),
	(440, 'BIL0002', 300000, 'November', 'admin', NULL, '2018-11-07 10:18:23', NULL),
	(441, 'BIL0002', 300000, 'Desember', 'admin', NULL, '2018-11-07 10:18:23', NULL),
	(442, 'BIL0002', 300000, 'Januari', 'admin', NULL, '2018-11-07 10:18:23', NULL),
	(443, 'BIL0002', 300000, 'Februari', 'admin', NULL, '2018-11-07 10:18:23', NULL),
	(444, 'BIL0002', 300000, 'Maret', 'admin', NULL, '2018-11-07 10:18:23', NULL),
	(445, 'BIL0002', 300000, 'April', 'admin', NULL, '2018-11-07 10:18:23', NULL),
	(446, 'BIL0002', 300000, 'Mei', 'admin', NULL, '2018-11-07 10:18:23', NULL),
	(447, 'BIL0002', 300000, 'Juni', 'admin', NULL, '2018-11-07 10:18:24', NULL),
	(448, 'BIL2223', 350000, 'Juli', 'admin', NULL, '2018-11-24 10:26:17', NULL),
	(449, 'BIL2223', 350000, 'Agustus', 'admin', NULL, '2018-11-24 10:26:17', NULL),
	(450, 'BIL2223', 350000, 'September', 'admin', NULL, '2018-11-24 10:26:17', NULL),
	(451, 'BIL2223', 350000, 'Oktober', 'admin', NULL, '2018-11-24 10:26:17', NULL),
	(452, 'BIL2223', 350000, 'November', 'admin', NULL, '2018-11-24 10:26:17', NULL),
	(453, 'BIL2223', 350000, 'Desember', 'admin', NULL, '2018-11-24 10:26:17', NULL),
	(454, 'BIL2223', 350000, 'Januari', 'admin', NULL, '2018-11-24 10:26:18', NULL),
	(455, 'BIL2223', 350000, 'Februari', 'admin', NULL, '2018-11-24 10:26:18', NULL),
	(456, 'BIL2223', 350000, 'Maret', 'admin', NULL, '2018-11-24 10:26:18', NULL),
	(457, 'BIL2223', 350000, 'April', 'admin', NULL, '2018-11-24 10:26:18', NULL),
	(458, 'BIL2223', 350000, 'Mei', 'admin', NULL, '2018-11-24 10:26:18', NULL),
	(459, 'BIL2223', 350000, 'Juni', 'admin', NULL, '2018-11-24 10:26:18', NULL);
/*!40000 ALTER TABLE `spp` ENABLE KEYS */;


-- Dumping structure for table malaka.spp_siswa
CREATE TABLE IF NOT EXISTS `spp_siswa` (
  `idtagihan_siswa` int(11) NOT NULL AUTO_INCREMENT,
  `idsiswa` char(10) NOT NULL,
  `idgroup` int(11) NOT NULL,
  `bulan` varchar(50) NOT NULL,
  `besaran` float NOT NULL,
  `user_create` varchar(50) NOT NULL,
  `date_create` datetime NOT NULL,
  PRIMARY KEY (`idtagihan_siswa`,`idsiswa`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

-- Dumping data for table malaka.spp_siswa: ~2 rows (approximately)
/*!40000 ALTER TABLE `spp_siswa` DISABLE KEYS */;
INSERT INTO `spp_siswa` (`idtagihan_siswa`, `idsiswa`, `idgroup`, `bulan`, `besaran`, `user_create`, `date_create`) VALUES
	(32, '176001', 26, 'Juli', 300000, 'admin', '2018-09-15 11:15:59'),
	(35, '176001', 26, 'Agustus', 300000, 'admin', '2018-10-17 05:32:26'),
	(36, '176007', 28, 'Juli', 350000, 'admin', '2018-11-24 10:32:15');
/*!40000 ALTER TABLE `spp_siswa` ENABLE KEYS */;


-- Dumping structure for table malaka.tagihan
CREATE TABLE IF NOT EXISTS `tagihan` (
  `idtagihan` char(10) NOT NULL,
  `idkelas` char(10) NOT NULL,
  `idajaran` int(11) NOT NULL,
  `idjurusan` char(10) NOT NULL,
  `administrasi` double DEFAULT NULL,
  `pengembangan` double DEFAULT NULL,
  `praktik` double DEFAULT NULL,
  `semester_a` double DEFAULT NULL,
  `semester_b` double DEFAULT NULL,
  `lab_inggris` double DEFAULT NULL,
  `lks` double DEFAULT NULL,
  `perpustakaan` double DEFAULT NULL,
  `osis` double DEFAULT NULL,
  `mpls` double DEFAULT NULL,
  `asuransi` double DEFAULT NULL,
  `user_create` varchar(50) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `user_update` varchar(50) DEFAULT NULL,
  `date_update` datetime DEFAULT NULL,
  PRIMARY KEY (`idtagihan`,`idkelas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table malaka.tagihan: ~2 rows (approximately)
/*!40000 ALTER TABLE `tagihan` DISABLE KEYS */;
INSERT INTO `tagihan` (`idtagihan`, `idkelas`, `idajaran`, `idjurusan`, `administrasi`, `pengembangan`, `praktik`, `semester_a`, `semester_b`, `lab_inggris`, `lks`, `perpustakaan`, `osis`, `mpls`, `asuransi`, `user_create`, `date_create`, `user_update`, `date_update`) VALUES
	('BIL0001', '6', 13, 'TPM', 50000, 200000, 200000, 300000, 300000, 150000, 250000, 150000, 200000, 150000, 200000, 'admin', '2018-09-15 11:05:38', NULL, NULL),
	('BIL0002', '10', 15, 'TKJ', 500000, 200000, 200000, 300000, 300000, 150000, 250000, 150000, 150000, 150000, 200000, 'admin', '2018-11-07 10:18:24', NULL, NULL),
	('BIL2223', '11', 16, 'MM', 150000, 15000, 250000, 300000, 300000, 200000, 300000, 150000, 150000, 200000, 100000, 'admin', '2018-11-24 10:26:18', NULL, NULL);
/*!40000 ALTER TABLE `tagihan` ENABLE KEYS */;


-- Dumping structure for table malaka.tagihan_biaya_tidaktetap
CREATE TABLE IF NOT EXISTS `tagihan_biaya_tidaktetap` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idbiaya` int(11) NOT NULL DEFAULT '0',
  `no_tagihan` char(10) NOT NULL,
  `idsiswa` char(10) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `nominal` double NOT NULL,
  `flag` int(11) NOT NULL,
  `tgl_assign` datetime NOT NULL,
  `tgl_payment` datetime DEFAULT NULL,
  `user` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- Dumping data for table malaka.tagihan_biaya_tidaktetap: ~9 rows (approximately)
/*!40000 ALTER TABLE `tagihan_biaya_tidaktetap` DISABLE KEYS */;
INSERT INTO `tagihan_biaya_tidaktetap` (`id`, `idbiaya`, `no_tagihan`, `idsiswa`, `keterangan`, `nominal`, `flag`, `tgl_assign`, `tgl_payment`, `user`) VALUES
	(9, 1, 'BIL86936', '176001', 'Wisuda', 15000000, 1, '2018-10-16 04:47:19', '2018-11-11 04:48:02', 'admin'),
	(10, 1, 'BIL43704', '176001', 'Wisuda', 15000000, 1, '2018-10-16 04:48:17', '2018-11-11 04:48:02', 'admin'),
	(11, 1, 'BIL40678', '176001', 'Wisuda', 15000000, 1, '2018-10-17 05:32:59', '2018-11-11 04:48:02', 'admin'),
	(13, 1, 'BIL29022', '176001', 'Wisuda', 15000000, 1, '2018-11-10 16:38:09', '2018-11-11 04:48:03', 'admin'),
	(14, 1, 'BIL34426', '176001', 'Wisuda', 15000000, 1, '2018-11-11 04:46:37', '2018-11-11 04:48:03', 'admin'),
	(15, 0, 'BIL02020', '176001', 'XXX', 153342, 1, '1970-01-01 01:00:00', '2018-11-11 01:00:00', 'user'),
	(16, 0, 'BIL02020', '176001', 'XXX', 153342, 1, '1970-01-01 01:00:00', '1970-01-01 01:00:00', 'user'),
	(17, 0, 'BIL02020', '176001', 'XXX', 153342, 1, '1970-01-01 01:00:00', '1970-01-01 01:00:00', 'user'),
	(18, 0, 'BIL02021', '176001', 'XXX', 153342, 1, '1970-01-01 01:00:00', '1970-01-01 01:00:00', 'user'),
	(19, 7, 'BIL86787', '176007', 'Outing', 500000, 1, '2018-11-24 10:34:37', '2018-11-24 10:34:49', 'admin');
/*!40000 ALTER TABLE `tagihan_biaya_tidaktetap` ENABLE KEYS */;


-- Dumping structure for table malaka.tagihan_siswa
CREATE TABLE IF NOT EXISTS `tagihan_siswa` (
  `idtagihan_siswa` int(11) NOT NULL AUTO_INCREMENT,
  `idsiswa` char(10) NOT NULL,
  `idgroup` int(11) NOT NULL,
  `nama_tagihan` varchar(50) NOT NULL,
  `besaran` float NOT NULL,
  `keterangan` text,
  `user_create` varchar(50) NOT NULL,
  `date_create` datetime NOT NULL,
  PRIMARY KEY (`idtagihan_siswa`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=latin1;

-- Dumping data for table malaka.tagihan_siswa: ~62 rows (approximately)
/*!40000 ALTER TABLE `tagihan_siswa` DISABLE KEYS */;
INSERT INTO `tagihan_siswa` (`idtagihan_siswa`, `idsiswa`, `idgroup`, `nama_tagihan`, `besaran`, `keterangan`, `user_create`, `date_create`) VALUES
	(25, '176001', 26, 'administrasi', 50000, 'Administrasi', 'admin', '2018-10-16 12:26:33'),
	(26, '176001', 26, 'pengembangan', 200000, 'Pengembangan', 'admin', '2018-10-17 02:21:25'),
	(27, '176001', 26, 'praktik', 200000, 'praktik', 'admin', '2018-11-10 14:03:59'),
	(28, '176001', 26, 'praktik', 200000, 'praktik', 'admin', '2018-11-10 15:05:22'),
	(29, '176001', 26, 'praktik', 200000, 'praktik', 'admin', '2018-11-10 15:09:41'),
	(30, '176001', 26, 'praktik', 200000, 'praktik', 'admin', '2018-11-10 15:09:41'),
	(31, '176001', 26, 'praktik', 200000, 'praktik', 'admin', '2018-11-10 15:10:54'),
	(32, '176001', 26, 'praktik', 200000, 'praktik', 'admin', '2018-11-10 15:10:54'),
	(33, '176001', 26, 'praktik', 200000, 'praktik', 'admin', '2018-11-10 15:11:14'),
	(34, '176001', 26, 'praktik', 200000, 'praktik', 'admin', '2018-11-10 15:11:14'),
	(35, '176001', 26, 'praktik', 200000, 'praktik', 'admin', '2018-11-10 15:11:40'),
	(36, '176001', 26, 'praktik', 200000, 'praktik', 'admin', '2018-11-10 15:11:40'),
	(37, '176001', 26, 'praktik', 200000, 'praktik', 'admin', '2018-11-10 15:12:01'),
	(38, '176001', 26, 'praktik', 200000, 'praktik', 'admin', '2018-11-10 15:12:01'),
	(39, '176001', 26, 'praktik', 200000, 'praktik', 'admin', '2018-11-10 15:16:01'),
	(40, '176001', 26, 'praktik', 200000, 'praktik', 'admin', '2018-11-10 15:16:01'),
	(41, '176001', 26, 'praktik', 200000, 'praktik', 'admin', '2018-11-10 16:06:09'),
	(42, '176001', 26, 'praktik', 200000, 'praktik', 'admin', '2018-11-10 16:06:09'),
	(43, '176002', 27, 'praktik', 200000, 'praktik', 'admin', '2018-11-10 16:06:36'),
	(44, '176002', 27, 'praktik', 200000, 'praktik', 'admin', '2018-11-10 16:07:53'),
	(45, '176003', 27, 'praktik', 200000, 'praktik', 'admin', '2018-11-10 16:11:19'),
	(46, '176001', 26, 'praktik', 200000, 'praktik', 'admin', '2018-11-10 16:24:07'),
	(47, '176001', 26, 'praktik', 200000, 'praktik', 'admin', '2018-11-10 16:24:07'),
	(48, '176001', 27, 'lab_inggris', 150000, 'lab_inggris', 'admin', '2018-11-10 16:24:07'),
	(49, '176001', 26, 'praktik', 200000, 'praktik', 'admin', '2018-11-10 16:28:36'),
	(50, '176001', 26, 'praktik', 200000, 'praktik', 'admin', '2018-11-10 16:28:36'),
	(51, '176001', 26, 'lab_inggris', 150000, 'lab_inggris', 'admin', '2018-11-10 16:28:36'),
	(52, '176001', 27, 'lab_inggris', 150000, 'lab_inggris', 'admin', '2018-11-10 16:28:36'),
	(53, '176001', 26, 'praktik', 200000, 'praktik', 'admin', '2018-11-10 16:35:42'),
	(54, '176001', 26, 'praktik', 200000, 'praktik', 'admin', '2018-11-10 16:35:42'),
	(55, '176001', 26, 'lab_inggris', 150000, 'lab_inggris', 'admin', '2018-11-10 16:35:42'),
	(56, '176001', 27, 'lab_inggris', 150000, 'lab_inggris', 'admin', '2018-11-10 16:35:42'),
	(57, '176001', 26, 'praktik', 200000, 'praktik', 'admin', '2018-11-10 16:38:39'),
	(58, '176001', 26, 'praktik', 200000, 'praktik', 'admin', '2018-11-10 16:38:39'),
	(59, '176001', 26, 'lab_inggris', 150000, 'lab_inggris', 'admin', '2018-11-10 16:38:39'),
	(60, '176001', 27, 'lab_inggris', 150000, 'lab_inggris', 'admin', '2018-11-10 16:38:39'),
	(61, '176001', 26, 'praktik', 200000, 'praktik', 'admin', '2018-11-11 04:48:02'),
	(62, '176001', 26, 'praktik', 200000, 'praktik', 'admin', '2018-11-11 04:48:02'),
	(63, '176001', 26, 'lab_inggris', 150000, 'lab_inggris', 'admin', '2018-11-11 04:48:02'),
	(64, '176001', 27, 'lab_inggris', 150000, 'lab_inggris', 'admin', '2018-11-11 04:48:02'),
	(65, '176001', 27, 'perpustakaan', 150000, 'perpustakaan', 'admin', '2018-11-11 04:48:02'),
	(66, '176007', 28, 'semester_a', 300000, 'Semester Ganjil', 'admin', '2018-11-24 10:32:39'),
	(67, '176007', 28, 'administrasi', 150000, 'Administrasi', 'admin', '2018-11-24 10:33:05'),
	(68, '176007', 28, 'lks', 300000, 'lks', 'admin', '2018-11-24 10:37:24'),
	(69, '176007', 28, 'pengembangan', 15000, 'pengembangan', 'admin', '2018-11-24 10:37:24'),
	(70, '176007', 28, 'perpustakaan', 150000, 'perpustakaan', 'admin', '2018-11-24 10:37:24'),
	(71, '176007', 28, 'lks', 300000, 'lks', 'admin', '2018-11-24 10:38:06'),
	(72, '176007', 28, 'pengembangan', 15000, 'pengembangan', 'admin', '2018-11-24 10:38:06'),
	(73, '176007', 28, 'perpustakaan', 150000, 'perpustakaan', 'admin', '2018-11-24 10:38:06'),
	(74, '176007', 28, 'praktik', 250000, 'praktik', 'admin', '2018-11-24 10:38:06'),
	(75, '176007', 28, 'asuransi', 100000, 'asuransi', 'admin', '2018-11-24 10:38:06'),
	(76, '176007', 28, 'lks', 300000, 'lks', 'admin', '2018-11-24 10:38:28'),
	(77, '176007', 28, 'pengembangan', 15000, 'pengembangan', 'admin', '2018-11-24 10:38:28'),
	(78, '176007', 28, 'perpustakaan', 150000, 'perpustakaan', 'admin', '2018-11-24 10:38:28'),
	(79, '176007', 28, 'praktik', 250000, 'praktik', 'admin', '2018-11-24 10:38:28'),
	(80, '176007', 28, 'asuransi', 100000, 'asuransi', 'admin', '2018-11-24 10:38:28'),
	(81, '176007', 28, 'mpls', 200000, 'mpls', 'admin', '2018-11-24 10:38:29'),
	(82, '176001', 27, 'administrasi', 10000, 'Administrasi', 'admin', '2018-11-24 11:08:28'),
	(83, '176008', 28, 'administrasi', 100000, 'Administrasi', 'admin', '2018-11-24 11:09:18'),
	(84, '176008', 28, 'semester_a', 150000, 'Semester Ganjil', 'admin', '2018-11-24 11:09:31'),
	(85, '176002', 27, 'praktik', 200000, 'praktik', 'admin', '2018-11-24 11:11:24'),
	(86, '176002', 27, 'asuransi', 200000, 'asuransi', 'admin', '2018-11-24 11:11:24'),
	(87, '176002', 27, 'praktik', 200000, 'praktik', 'admin', '2018-11-24 11:12:59'),
	(88, '176002', 27, 'asuransi', 200000, 'asuransi', 'admin', '2018-11-24 11:12:59'),
	(89, '176002', 28, 'perpustakaan', 150000, 'perpustakaan', 'admin', '2018-11-24 11:12:59');
/*!40000 ALTER TABLE `tagihan_siswa` ENABLE KEYS */;


-- Dumping structure for table malaka.tahun_ajaran
CREATE TABLE IF NOT EXISTS `tahun_ajaran` (
  `idajaran` int(11) NOT NULL AUTO_INCREMENT,
  `tahun_ajaran` varchar(10) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`idajaran`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- Dumping data for table malaka.tahun_ajaran: ~3 rows (approximately)
/*!40000 ALTER TABLE `tahun_ajaran` DISABLE KEYS */;
INSERT INTO `tahun_ajaran` (`idajaran`, `tahun_ajaran`, `status`) VALUES
	(13, '2018/2019', 1),
	(14, '2019/2020', 1),
	(15, '2020/2021', 1),
	(16, '2022/2023', 1);
/*!40000 ALTER TABLE `tahun_ajaran` ENABLE KEYS */;


-- Dumping structure for table malaka.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` int(11) NOT NULL DEFAULT '0',
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table malaka.user: ~0 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `role`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
	(1, 0, 'admin', 'pof3Gqn_ogAiMa84TFqEe9c4s8k9vQFx', '$2y$13$vzgWqK3/H3yUOlTHFEVjg.mFMgGvQz8SdMhRq//ZKUIvxqoKwC2ei', NULL, 'admin@malaka.com', 10, 1531711643, 1531711643);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;


-- Dumping structure for view malaka.v_pelunasan_spp
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_pelunasan_spp` (
	`idsiswa` CHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`idajaran` INT(11) NOT NULL,
	`nama_kelas` VARCHAR(50) NULL COLLATE 'latin1_swedish_ci',
	`idjurusan` CHAR(10) NOT NULL COLLATE 'latin1_swedish_ci',
	`kode` CHAR(10) NOT NULL COLLATE 'latin1_swedish_ci',
	`idspp` INT(11) NOT NULL,
	`idtagihan` CHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`besaran` DOUBLE NOT NULL,
	`bulan` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`user_create` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`user_update` VARCHAR(50) NULL COLLATE 'latin1_swedish_ci',
	`date_create` DATETIME NOT NULL,
	`date_update` DATETIME NULL
) ENGINE=MyISAM;


-- Dumping structure for view malaka.v_pelunasan_tagihan
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_pelunasan_tagihan` (
	`key_` CHAR(10) NOT NULL COLLATE 'latin1_swedish_ci',
	`idsiswa` CHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`keterangan` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`ajaran` VARCHAR(11) NOT NULL COLLATE 'utf8mb4_general_ci',
	`nama_kelas` VARCHAR(50) NULL COLLATE 'latin1_swedish_ci',
	`idjurusan` VARCHAR(10) NOT NULL COLLATE 'latin1_swedish_ci',
	`nominal` DOUBLE NULL,
	`tgl_payment` DATETIME NULL
) ENGINE=MyISAM;


-- Dumping structure for view malaka.v_tagihan_master
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_tagihan_master` (
	`idtagihan` CHAR(10) NOT NULL COLLATE 'latin1_swedish_ci',
	`Keterangan` VARCHAR(12) NOT NULL COLLATE 'utf8mb4_general_ci',
	`Nominal` DOUBLE NULL
) ENGINE=MyISAM;


-- Dumping structure for view malaka.v_tagihan_siswa
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_tagihan_siswa` (
	`idsiswa` CHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`nominal` DOUBLE NULL,
	`keterangan` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`idkelas` INT(11) NULL,
	`key_` VARCHAR(12) NOT NULL COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;


-- Dumping structure for view malaka.v_tagihan_spp
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_tagihan_spp` (
	`idsiswa` CHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`idajaran` INT(11) NOT NULL,
	`nama_kelas` VARCHAR(50) NULL COLLATE 'latin1_swedish_ci',
	`idjurusan` CHAR(10) NOT NULL COLLATE 'latin1_swedish_ci',
	`idspp` INT(11) NOT NULL,
	`idtagihan` CHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`besaran` DOUBLE NOT NULL,
	`bulan` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`user_create` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`user_update` VARCHAR(50) NULL COLLATE 'latin1_swedish_ci',
	`date_create` DATETIME NOT NULL,
	`date_update` DATETIME NULL
) ENGINE=MyISAM;


-- Dumping structure for view malaka.v_tunggakan_siswa
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_tunggakan_siswa` (
	`key_` CHAR(10) NOT NULL COLLATE 'latin1_swedish_ci',
	`idsiswa` CHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`keterangan` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`ajaran` VARCHAR(11) NOT NULL COLLATE 'utf8mb4_general_ci',
	`nama_kelas` VARCHAR(50) NULL COLLATE 'latin1_swedish_ci',
	`idjurusan` VARCHAR(10) NOT NULL COLLATE 'latin1_swedish_ci',
	`nominal` DOUBLE NULL
) ENGINE=MyISAM;


-- Dumping structure for table malaka.wali_siswa
CREATE TABLE IF NOT EXISTS `wali_siswa` (
  `idsiswa` char(10) NOT NULL,
  `hubungan` varchar(50) NOT NULL,
  `pekerjaan` varchar(50) NOT NULL,
  `pendidikan` varchar(50) NOT NULL,
  `penghasilan` float NOT NULL,
  `deskripsi` text,
  PRIMARY KEY (`idsiswa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table malaka.wali_siswa: ~0 rows (approximately)
/*!40000 ALTER TABLE `wali_siswa` DISABLE KEYS */;
/*!40000 ALTER TABLE `wali_siswa` ENABLE KEYS */;


-- Dumping structure for view malaka.v_pelunasan_spp
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_pelunasan_spp`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `v_pelunasan_spp` AS SELECT  d.idsiswa,a.idajaran, f.nama_kelas, f.idjurusan ,f.kode,b.* 
FROM tagihan a 
JOIN spp b ON a.idtagihan = b.idtagihan
JOIN kelas_group c ON a.idkelas = c.idkelas
JOIN detail_group d ON c.idgroup = d.idgroup 
LEFT JOIN spp_siswa e ON d.idgroup = c.idgroup 
					  AND e.idsiswa = d.idsiswa 
					  AND e.bulan = b.bulan 
					  AND b.besaran = e.besaran 
					  AND e.idgroup = c.idgroup
JOIN kelas f ON f.idkelas = c.idkelas					  
WHERE e.besaran IS NOT NULL ;


-- Dumping structure for view malaka.v_pelunasan_tagihan
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_pelunasan_tagihan`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `v_pelunasan_tagihan` AS SELECT no_tagihan key_
		 ,idsiswa
		 ,keterangan
		 ,'-' ajaran
		 ,'-' nama_kelas
		 ,'-' idjurusan
		 ,nominal 
		 ,tgl_payment
FROM tagihan_biaya_tidaktetap WHERE flag = 1
UNION ALL
SELECT a.idtagihan key_
		,e.idsiswa
		,a.Keterangan
		,c.idajaran
		,c.nama_kelas
		,c.idjurusan
		,a.Nominal 
		,f.date_create
FROM v_tagihan_master a 
JOIN tagihan b ON a.idtagihan = b.idtagihan
JOIN kelas c ON b.idkelas = c.idkelas 
				 AND b.idajaran = c.idajaran 
				 AND b.idjurusan = c.idjurusan
JOIN kelas_group d ON c.idkelas = d.idkelas
JOIN detail_group e ON e.idgroup = d.idgroup 
LEFT JOIN tagihan_siswa f ON f.idsiswa = e.idsiswa AND f.idgroup = e.idgroup AND f.nama_tagihan = a.Keterangan COLLATE utf8mb4_general_ci
WHERE f.besaran IS NOT NULL ;


-- Dumping structure for view malaka.v_tagihan_master
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_tagihan_master`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `v_tagihan_master` AS SELECT idtagihan
		,'administrasi' Keterangan
		,administrasi  Nominal
FROM tagihan
UNION ALL
SELECT idtagihan
		,'pengembangan' Keterangan
		,pengembangan  Nominal
FROM tagihan
UNION ALL
SELECT idtagihan
		,'praktik' Keterangan
		,praktik  Nominal
FROM tagihan
UNION ALL
SELECT idtagihan
		,'semester_a' Keterangan
		,semester_a  Nominal
FROM tagihan
UNION ALL
SELECT idtagihan
		,'semester_b' Keterangan
		,semester_b  Nominal
FROM tagihan
UNION ALL
SELECT  
		idtagihan
		,'lab_inggris' Keterangan
		,lab_inggris  Nominal
FROM tagihan
UNION ALL
SELECT idtagihan
		,'lks' Keterangan
		,lks  Nominal
FROM tagihan
UNION ALL
SELECT idtagihan
		,'perpustakaan' Keterangan
		,perpustakaan  Nominal
FROM tagihan
UNION ALL
SELECT idtagihan
		,'osis' Keterangan
		,osis  Nominal
FROM tagihan
UNION ALL
SELECT idtagihan
		,'mpls' Keterangan
		,mpls  Nominal
FROM tagihan
UNION ALL
SELECT idtagihan
		,'asuransi' Keterangan
		,asuransi  Nominal
FROM tagihan ;


-- Dumping structure for view malaka.v_tagihan_siswa
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_tagihan_siswa`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `v_tagihan_siswa` AS SELECT a.idsiswa
		,d.administrasi nominal
		,'Administrasi' keterangan
		,c.idkelas idkelas
		,'administrasi' key_
FROM detail_group a 
JOIN kelas_group b ON a.idgroup = b.idgroup
JOIN kelas c ON b.idkelas = c.idkelas
JOIN tagihan d ON c.idajaran = d.idajaran 
				  AND c.idjurusan = d.idjurusan 
				  AND c.idkelas = d.idkelas
UNION ALL
SELECT a.idsiswa
		,d.pengembangan nominal
		,'Pengembangan' keterangan
		,c.idkelas idkelas
		,'pengembangan' key_
FROM detail_group a 
JOIN kelas_group b ON a.idgroup = b.idgroup
JOIN kelas c ON b.idkelas = c.idkelas
JOIN tagihan d ON c.idajaran = d.idajaran 
				  AND c.idjurusan = d.idjurusan 
				  AND c.idkelas = d.idkelas
UNION ALL
SELECT a.idsiswa
		,d.praktik nominal
		,'Praktik' keterangan
		,c.idkelas idkelas
		,'praktik' key_
FROM detail_group a 
JOIN kelas_group b ON a.idgroup = b.idgroup
JOIN kelas c ON b.idkelas = c.idkelas
JOIN tagihan d ON c.idajaran = d.idajaran 
				  AND c.idjurusan = d.idjurusan 
				  AND c.idkelas = d.idkelas
UNION ALL
SELECT a.idsiswa
		,d.semester_a nominal
		,'Semester Ganjil' keterangan
		,c.idkelas idkelas
		,'semester_a' key_
FROM detail_group a 
JOIN kelas_group b ON a.idgroup = b.idgroup
JOIN kelas c ON b.idkelas = c.idkelas
JOIN tagihan d ON c.idajaran = d.idajaran 
				  AND c.idjurusan = d.idjurusan 
				  AND c.idkelas = d.idkelas
UNION ALL
SELECT a.idsiswa
		,d.semester_b nominal
		,'Semester Genap' keterangan
		,c.idkelas idkelas
		,'semester_b' key_
FROM detail_group a 
JOIN kelas_group b ON a.idgroup = b.idgroup
JOIN kelas c ON b.idkelas = c.idkelas
JOIN tagihan d ON c.idajaran = d.idajaran 
				  AND c.idjurusan = d.idjurusan 
				  AND c.idkelas = d.idkelas
UNION ALL
SELECT a.idsiswa
		,d.lab_inggris nominal
		,'Lab B.Inggris' keterangan
		,c.idkelas idkelas
		,'lab_inggris' key_
FROM detail_group a 
JOIN kelas_group b ON a.idgroup = b.idgroup
JOIN kelas c ON b.idkelas = c.idkelas
JOIN tagihan d ON c.idajaran = d.idajaran 
				  AND c.idjurusan = d.idjurusan 
				  AND c.idkelas = d.idkelas
UNION ALL				  				  
SELECT a.idsiswa
		,d.lks nominal
		,'Lks' keterangan
		,c.idkelas idkelas
		,'lks' key_
FROM detail_group a 
JOIN kelas_group b ON a.idgroup = b.idgroup
JOIN kelas c ON b.idkelas = c.idkelas
JOIN tagihan d ON c.idajaran = d.idajaran 
				  AND c.idjurusan = d.idjurusan 
				  AND c.idkelas = d.idkelas
UNION ALL				  				  
SELECT a.idsiswa
		,d.perpustakaan nominal
		,'Perpustakaan' keterangan
		,c.idkelas idkelas
		,'perpustakaan' key_
FROM detail_group a 
JOIN kelas_group b ON a.idgroup = b.idgroup
JOIN kelas c ON b.idkelas = c.idkelas
JOIN tagihan d ON c.idajaran = d.idajaran 
				  AND c.idjurusan = d.idjurusan 
				  AND c.idkelas = d.idkelas
UNION ALL				  				  
SELECT a.idsiswa
		,d.osis nominal
		,'Osis' keterangan
		,c.idkelas idkelas
		,'osis' key_
FROM detail_group a 
JOIN kelas_group b ON a.idgroup = b.idgroup
JOIN kelas c ON b.idkelas = c.idkelas
JOIN tagihan d ON c.idajaran = d.idajaran 
				  AND c.idjurusan = d.idjurusan 
				  AND c.idkelas = d.idkelas			
UNION ALL				  				 	
SELECT a.idsiswa
		,d.mpls nominal
		,'Mpls' keterangan
		,c.idkelas idkelas
		,'mpls' key_
FROM detail_group a 
JOIN kelas_group b ON a.idgroup = b.idgroup
JOIN kelas c ON b.idkelas = c.idkelas
JOIN tagihan d ON c.idajaran = d.idajaran 
				  AND c.idjurusan = d.idjurusan 
				  AND c.idkelas = d.idkelas					    
UNION ALL				  
SELECT a.idsiswa
		,d.asuransi nominal
		,'Asuransi' keterangan
		,c.idkelas idkelas
		,'asuransi' key_
FROM detail_group a 
JOIN kelas_group b ON a.idgroup = b.idgroup
JOIN kelas c ON b.idkelas = c.idkelas
JOIN tagihan d ON c.idajaran = d.idajaran 
				  AND c.idjurusan = d.idjurusan 
				  AND c.idkelas = d.idkelas				
				  
UNION ALL
SELECT idsiswa
		,nominal
		,Keterangan
		,NULL ajaran
		,no_tagihan key_
FROM tagihan_biaya_tidaktetap ;


-- Dumping structure for view malaka.v_tagihan_spp
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_tagihan_spp`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `v_tagihan_spp` AS SELECT  d.idsiswa,a.idajaran, f.nama_kelas, f.idjurusan ,b.* 
FROM tagihan a 
JOIN spp b ON a.idtagihan = b.idtagihan
JOIN kelas_group c ON a.idkelas = c.idkelas
JOIN detail_group d ON c.idgroup = d.idgroup 
LEFT JOIN spp_siswa e ON d.idgroup = c.idgroup 
					  AND e.idsiswa = d.idsiswa 
					  AND e.bulan = b.bulan 
					  AND b.besaran = e.besaran 
					  AND e.idgroup = c.idgroup
JOIN kelas f ON f.idkelas = c.idkelas					  
WHERE e.besaran IS NULL ;


-- Dumping structure for view malaka.v_tunggakan_siswa
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_tunggakan_siswa`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `v_tunggakan_siswa` AS SELECT no_tagihan key_
		 ,idsiswa
		 ,keterangan
		 ,'-' ajaran
		 ,'-' nama_kelas
		 ,'-' idjurusan
		 ,nominal 
FROM tagihan_biaya_tidaktetap WHERE flag = 0
UNION ALL
SELECT a.idtagihan key_
		,e.idsiswa
		,a.Keterangan
		,c.idajaran
		,c.nama_kelas
		,c.idjurusan
		,a.Nominal 
FROM v_tagihan_master a 
JOIN tagihan b ON a.idtagihan = b.idtagihan
JOIN kelas c ON b.idkelas = c.idkelas 
				 AND b.idajaran = c.idajaran 
				 AND b.idjurusan = c.idjurusan
JOIN kelas_group d ON c.idkelas = d.idkelas
JOIN detail_group e ON e.idgroup = d.idgroup 
LEFT JOIN tagihan_siswa f ON f.idsiswa = e.idsiswa AND f.idgroup = e.idgroup AND f.nama_tagihan = a.Keterangan COLLATE utf8mb4_general_ci
WHERE f.besaran IS NULL ;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
