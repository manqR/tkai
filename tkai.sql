-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.2.21-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table tkai.agama
CREATE TABLE IF NOT EXISTS `agama` (
  `keterangan` varchar(50) NOT NULL,
  `idagama` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idagama`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table tkai.agama: ~6 rows (approximately)
/*!40000 ALTER TABLE `agama` DISABLE KEYS */;
INSERT INTO `agama` (`keterangan`, `idagama`) VALUES
	('Islam', 1),
	('Hindu', 2),
	('Budha', 3),
	('Kristen Protestan', 4),
	('Katolik', 5),
	('Kong Hu Cu', 6);
/*!40000 ALTER TABLE `agama` ENABLE KEYS */;

-- Dumping structure for table tkai.bulan_spp
CREATE TABLE IF NOT EXISTS `bulan_spp` (
  `bulan` varchar(50) NOT NULL,
  `urutan` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`urutan`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Dumping data for table tkai.bulan_spp: ~12 rows (approximately)
/*!40000 ALTER TABLE `bulan_spp` DISABLE KEYS */;
INSERT INTO `bulan_spp` (`bulan`, `urutan`) VALUES
	('Juli', 1),
	('Agustus', 2),
	('September', 3),
	('Oktober', 4),
	('November', 5),
	('Desember', 6),
	('Januari', 7),
	('Februari', 8),
	('Maret', 9),
	('April', 10),
	('Mei', 11),
	('Juni', 12);
/*!40000 ALTER TABLE `bulan_spp` ENABLE KEYS */;

-- Dumping structure for table tkai.cabang
CREATE TABLE IF NOT EXISTS `cabang` (
  `keterangan` varchar(50) NOT NULL,
  `idcabang` int(11) NOT NULL AUTO_INCREMENT,
  `nama_sekolah` varchar(50) NOT NULL DEFAULT '0',
  `alamat` varchar(50) NOT NULL DEFAULT '0',
  `kecamatan` varchar(50) NOT NULL DEFAULT '0',
  `kota` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idcabang`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table tkai.cabang: ~2 rows (approximately)
/*!40000 ALTER TABLE `cabang` DISABLE KEYS */;
INSERT INTO `cabang` (`keterangan`, `idcabang`, `nama_sekolah`, `alamat`, `kecamatan`, `kota`) VALUES
	('JAGAKARSA', 1, 'SEKOLAH DASAR KREATIVITAS ANAK INDONESIA', 'JL. KEDONDONG NO 18 JAGAKARSA', 'JAGAKARSA', 'KOTA '),
	('CILANDAK', 2, 'SEKOLAH DASAR KREATIVITAS ANAK INDONESIA', '0', '0', '0');
/*!40000 ALTER TABLE `cabang` ENABLE KEYS */;

-- Dumping structure for table tkai.cart
CREATE TABLE IF NOT EXISTS `cart` (
  `kode_siswa` char(20) NOT NULL,
  `idtagihan` char(20) NOT NULL,
  `remarks` varchar(50) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `nominal` double NOT NULL,
  `jumlah_bayar` double NOT NULL,
  `tahun_ajaran` varchar(20) NOT NULL,
  `flag` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `urutan` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`urutan`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- Dumping data for table tkai.cart: ~16 rows (approximately)
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` (`kode_siswa`, `idtagihan`, `remarks`, `keterangan`, `nominal`, `jumlah_bayar`, `tahun_ajaran`, `flag`, `date`, `urutan`) VALUES
	('1-2-180472', 'INV-011962113', 'Peralatan', 'tagihan', 2000000, 2000000, '2018/2019', 2, '2019-02-08 08:25:51', 3),
	('1-2-180472', 'INV-011962113', 'Material Tahunan', 'tagihan', 1750000, 1750000, '2018/2019', 2, '2019-02-08 08:26:03', 4),
	('1-2-180472', 'INV-011962113', 'Seragam', 'tagihan', 250000, 250000, '2018/2019', 2, '2019-02-08 08:26:50', 5),
	('1-2-180474', 'INV-011962113', 'Oktober', 'spp', 200000, 200000, '2018/2019', 2, '2019-02-08 08:27:12', 6),
	('1-2-180472', 'INV-011962113', 'Material Penunjang', 'tagihan', 250000, 250000, '2018/2019', 2, '2019-02-08 08:33:59', 7),
	('1-2-180472', 'INV-011962113', 'Uang Bangunan', 'tagihan', 5000000, 3000000, '2018/2019', 2, '2019-02-08 08:35:26', 8),
	('1-2-180472', 'INV-011962113', 'Uang Pangkal', 'tagihan', 1500000, 200000, '2018/2019', 2, '2019-02-08 08:36:23', 9),
	('1-2-180472', 'INV-011962113', 'Juli', 'spp', 200000, 200000, '2018/2019', 2, '2019-02-08 09:04:16', 10),
	('1-2-180474', 'INV-011962113', 'Peralatan', 'tagihan', 2000000, 2000000, '2018/2019', 2, '2019-02-08 09:04:36', 11),
	('1-2-180474', 'INV-011962113', 'Material Tahunan', 'tagihan', 1750000, 1000000, '2018/2019', 2, '2019-02-08 09:04:37', 12),
	('1-2-180478', 'INV-011962113', 'Seragam', 'tagihan', 250000, 250000, '2018/2019', 2, '2019-02-20 10:56:12', 15),
	('1-2-180478', 'INV-011962113', 'Material Tahunan', 'tagihan', 1750000, 1750000, '2018/2019', 2, '2019-02-20 11:10:34', 18),
	('1-2-180478', 'INV-011962113', 'Peralatan', 'tagihan', 2000000, 1000000, '2018/2019', 2, '2019-02-21 02:40:00', 19),
	('1-2-180478', 'INV-011962113', 'Material Penunjang', 'tagihan', 250000, 250000, '2018/2019', 2, '2019-02-21 02:41:20', 20),
	('1-2-180478', 'INV-011962113', 'Uang Bangunan', 'tagihan', 5000000, 5000000, '2018/2019', 2, '2019-02-21 02:41:21', 21),
	('1-2-180478', 'INV-011962113', 'Uang Pangkal', 'tagihan', 1500000, 1500000, '2018/2019', 2, '2019-02-21 03:39:20', 22);
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;

-- Dumping structure for table tkai.detail_menu
CREATE TABLE IF NOT EXISTS `detail_menu` (
  `id` int(11) NOT NULL,
  `detail_name` varchar(50) NOT NULL,
  `flag` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table tkai.detail_menu: ~0 rows (approximately)
/*!40000 ALTER TABLE `detail_menu` DISABLE KEYS */;
/*!40000 ALTER TABLE `detail_menu` ENABLE KEYS */;

-- Dumping structure for table tkai.detil_kelas
CREATE TABLE IF NOT EXISTS `detil_kelas` (
  `key_` char(20) NOT NULL,
  `kode_siswa` char(20) NOT NULL,
  PRIMARY KEY (`key_`,`kode_siswa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table tkai.detil_kelas: ~3 rows (approximately)
/*!40000 ALTER TABLE `detil_kelas` DISABLE KEYS */;
INSERT INTO `detil_kelas` (`key_`, `kode_siswa`) VALUES
	('1A-1-2-2018', '1-2-180474'),
	('1B-1-2-2018', '1-2-180472'),
	('1B-1-2-2018', '1-2-180478');
/*!40000 ALTER TABLE `detil_kelas` ENABLE KEYS */;

-- Dumping structure for table tkai.kategori
CREATE TABLE IF NOT EXISTS `kategori` (
  `keterangan` varchar(50) NOT NULL,
  `idkategori` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idkategori`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table tkai.kategori: ~2 rows (approximately)
/*!40000 ALTER TABLE `kategori` DISABLE KEYS */;
INSERT INTO `kategori` (`keterangan`, `idkategori`) VALUES
	('TK', 1),
	('SD', 2);
/*!40000 ALTER TABLE `kategori` ENABLE KEYS */;

-- Dumping structure for table tkai.kelas
CREATE TABLE IF NOT EXISTS `kelas` (
  `kode` char(10) NOT NULL,
  `idkategori` int(11) NOT NULL,
  `idcabang` int(11) NOT NULL,
  `tahun_ajaran` varchar(50) NOT NULL,
  `wali_kelas` varchar(50) DEFAULT NULL,
  `flag` int(11) DEFAULT NULL,
  `key_` char(20) NOT NULL,
  `urutan` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`urutan`,`key_`),
  KEY `FK__kategori` (`idkategori`),
  KEY `FK__cabang` (`idcabang`),
  CONSTRAINT `FK__cabang` FOREIGN KEY (`idcabang`) REFERENCES `cabang` (`idcabang`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK__kategori` FOREIGN KEY (`idkategori`) REFERENCES `kategori` (`idkategori`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table tkai.kelas: ~4 rows (approximately)
/*!40000 ALTER TABLE `kelas` DISABLE KEYS */;
INSERT INTO `kelas` (`kode`, `idkategori`, `idcabang`, `tahun_ajaran`, `wali_kelas`, `flag`, `key_`, `urutan`) VALUES
	('1B', 2, 1, '2018/2019', 'Sari', 1, '1B-1-2-2018', 1),
	('1A', 2, 1, '2018/2019', 'Reni', 1, '1A-1-2-2018', 2),
	('1C', 2, 2, '2018/2019', 'Adi', 1, '1C-2-2-2018', 3),
	('1D', 2, 1, '2018/2019', 'Rina', 1, '1D-1-2-2018', 4);
/*!40000 ALTER TABLE `kelas` ENABLE KEYS */;

-- Dumping structure for table tkai.kuitansi
CREATE TABLE IF NOT EXISTS `kuitansi` (
  `no_kuitansi` char(50) NOT NULL,
  `idcart` int(11) NOT NULL,
  `kode_siswa` char(50) NOT NULL,
  `idtagihan` char(50) NOT NULL,
  `remarks` varchar(50) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `nominal` double NOT NULL,
  `jumlah_bayar` double NOT NULL,
  `tahun_ajaran` varchar(50) NOT NULL,
  `flag` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `urutan` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`urutan`,`no_kuitansi`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

-- Dumping data for table tkai.kuitansi: ~16 rows (approximately)
/*!40000 ALTER TABLE `kuitansi` DISABLE KEYS */;
INSERT INTO `kuitansi` (`no_kuitansi`, `idcart`, `kode_siswa`, `idtagihan`, `remarks`, `keterangan`, `nominal`, `jumlah_bayar`, `tahun_ajaran`, `flag`, `date`, `urutan`) VALUES
	('K-190219.73643', 3, '1-2-180472', 'INV-011962113', 'Peralatan', 'tagihan', 2000000, 2000000, '2018/2019', 2, '2019-02-19 11:08:21', 41),
	('K-190219.73643', 8, '1-2-180472', 'INV-011962113', 'Uang Bangunan', 'tagihan', 5000000, 3000000, '2018/2019', 2, '2019-02-19 11:08:21', 42),
	('K-190219.73643', 4, '1-2-180472', 'INV-011962113', 'Material Tahunan', 'tagihan', 1750000, 1750000, '2018/2019', 2, '2019-02-19 11:08:21', 43),
	('K-190219.73643', 5, '1-2-180472', 'INV-011962113', 'Seragam', 'tagihan', 250000, 250000, '2018/2019', 2, '2019-02-19 11:08:21', 44),
	('K-190219.73643', 9, '1-2-180472', 'INV-011962113', 'Uang Pangkal', 'tagihan', 1500000, 200000, '2018/2019', 2, '2019-02-19 11:08:21', 45),
	('K-190219.73643', 7, '1-2-180472', 'INV-011962113', 'Material Penunjang', 'tagihan', 250000, 250000, '2018/2019', 2, '2019-02-19 11:08:21', 46),
	('K-190219.73643', 10, '1-2-180472', 'INV-011962113', 'Juli', 'spp', 200000, 200000, '2018/2019', 2, '2019-02-19 11:08:21', 47),
	('K-190219.16921', 12, '1-2-180474', 'INV-011962113', 'Material Tahunan', 'tagihan', 1750000, 1000000, '2018/2019', 2, '2019-02-19 11:09:15', 48),
	('K-190219.16921', 11, '1-2-180474', 'INV-011962113', 'Peralatan', 'tagihan', 2000000, 2000000, '2018/2019', 2, '2019-02-19 11:09:15', 49),
	('K-190219.16921', 6, '1-2-180474', 'INV-011962113', 'Oktober', 'spp', 200000, 200000, '2018/2019', 2, '2019-02-19 11:09:15', 50),
	('K-190220.25507', 15, '1-2-180478', 'INV-011962113', 'Seragam', 'tagihan', 250000, 250000, '2018/2019', 2, '2019-02-20 11:05:12', 51),
	('K-190220.18412', 18, '1-2-180478', 'INV-011962113', 'Material Tahunan', 'tagihan', 1750000, 1750000, '2018/2019', 2, '2019-02-20 11:10:41', 52),
	('K-190221.90318', 19, '1-2-180478', 'INV-011962113', 'Peralatan', 'tagihan', 2000000, 1000000, '2018/2019', 2, '2019-02-21 02:40:19', 53),
	('K-190221.64382', 21, '1-2-180478', 'INV-011962113', 'Uang Bangunan', 'tagihan', 5000000, 5000000, '2018/2019', 2, '2019-02-21 02:58:17', 54),
	('K-190221.64382', 20, '1-2-180478', 'INV-011962113', 'Material Penunjang', 'tagihan', 250000, 250000, '2018/2019', 2, '2019-02-21 02:58:17', 55),
	('K-190221.65947', 22, '1-2-180478', 'INV-011962113', 'Uang Pangkal', 'tagihan', 1500000, 1500000, '2018/2019', 2, '2019-02-21 03:39:32', 56);
/*!40000 ALTER TABLE `kuitansi` ENABLE KEYS */;

-- Dumping structure for table tkai.material
CREATE TABLE IF NOT EXISTS `material` (
  `nama` varchar(50) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `urutan` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`urutan`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table tkai.material: ~5 rows (approximately)
/*!40000 ALTER TABLE `material` DISABLE KEYS */;
INSERT INTO `material` (`nama`, `keterangan`, `urutan`) VALUES
	('Kunjungan-kunjungan belajar ke luar sekolah', 'material_penunjang', 1),
	('Media kegiatan', 'material_penunjang', 2),
	('Piknik', 'material_tahunan', 3),
	('Foto kelas ukuran 10R', 'material_tahunan', 4),
	('Pesta Akhir Tahun [siswa + 2 undangan]', 'material_tahunan', 5);
/*!40000 ALTER TABLE `material` ENABLE KEYS */;

-- Dumping structure for table tkai.menu
CREATE TABLE IF NOT EXISTS `menu` (
  `idmenu` int(11) NOT NULL AUTO_INCREMENT,
  `role` int(11) NOT NULL,
  `nama_menu` varchar(50) NOT NULL,
  `flag` int(11) NOT NULL,
  PRIMARY KEY (`idmenu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table tkai.menu: ~0 rows (approximately)
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;

-- Dumping structure for table tkai.migration
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table tkai.migration: ~2 rows (approximately)
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` (`version`, `apply_time`) VALUES
	('m000000_000000_base', 1544035834),
	('m130524_201442_init', 1544035837);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;

-- Dumping structure for table tkai.pembayaran
CREATE TABLE IF NOT EXISTS `pembayaran` (
  `idpembayaran` char(20) NOT NULL,
  `kode_siswa` char(20) NOT NULL,
  `idtagihan` char(20) NOT NULL,
  `tahun_ajaran` varchar(20) NOT NULL,
  `nominal` double NOT NULL,
  `kasir` varchar(20) NOT NULL,
  `tanggal_pembayaran` datetime NOT NULL,
  PRIMARY KEY (`idpembayaran`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table tkai.pembayaran: ~0 rows (approximately)
/*!40000 ALTER TABLE `pembayaran` DISABLE KEYS */;
/*!40000 ALTER TABLE `pembayaran` ENABLE KEYS */;

-- Dumping structure for table tkai.pembayaran_detail
CREATE TABLE IF NOT EXISTS `pembayaran_detail` (
  `idpembayaran` char(20) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `nominal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table tkai.pembayaran_detail: ~0 rows (approximately)
/*!40000 ALTER TABLE `pembayaran_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `pembayaran_detail` ENABLE KEYS */;

-- Dumping structure for table tkai.role
CREATE TABLE IF NOT EXISTS `role` (
  `idrole` int(11) NOT NULL AUTO_INCREMENT,
  `role` char(50) NOT NULL,
  PRIMARY KEY (`idrole`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table tkai.role: ~2 rows (approximately)
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` (`idrole`, `role`) VALUES
	(1, 'Super User'),
	(2, 'Admin');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;

-- Dumping structure for table tkai.siswa
CREATE TABLE IF NOT EXISTS `siswa` (
  `nis` char(20) NOT NULL,
  `kode_siswa` char(20) NOT NULL,
  `idcabang` int(11) NOT NULL,
  `idkategori` int(11) NOT NULL,
  `nisn` char(20) DEFAULT NULL,
  `no_registrasi` char(20) DEFAULT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `nama_panggilan` varchar(50) DEFAULT NULL,
  `agama` varchar(50) DEFAULT NULL,
  `jenis_kelamin` char(1) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(1000) NOT NULL,
  `tlp` varchar(50) DEFAULT NULL,
  `tlp_darurat` varchar(50) NOT NULL,
  `nama_ayah` varchar(50) DEFAULT NULL,
  `nama_ibu` varchar(50) DEFAULT NULL,
  `pekerjaan_ayah` varchar(50) DEFAULT NULL,
  `pekerjaan_ibu` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `tahun_input` year(4) NOT NULL,
  `tgl_input` datetime NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(4) NOT NULL,
  `urutan` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`urutan`,`nis`,`kode_siswa`),
  KEY `FK_siswa_cabang` (`idcabang`),
  KEY `FK_siswa_kategori` (`idkategori`),
  CONSTRAINT `FK_siswa_cabang` FOREIGN KEY (`idcabang`) REFERENCES `cabang` (`idcabang`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_siswa_kategori` FOREIGN KEY (`idkategori`) REFERENCES `kategori` (`idkategori`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;

-- Dumping data for table tkai.siswa: ~36 rows (approximately)
/*!40000 ALTER TABLE `siswa` DISABLE KEYS */;
INSERT INTO `siswa` (`nis`, `kode_siswa`, `idcabang`, `idkategori`, `nisn`, `no_registrasi`, `nama_lengkap`, `nama_panggilan`, `agama`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `tlp`, `tlp_darurat`, `nama_ayah`, `nama_ibu`, `pekerjaan_ayah`, `pekerjaan_ibu`, `email`, `tahun_input`, `tgl_input`, `status`, `urutan`) VALUES
	('141005', '2-1-141005', 2, 1, '', NULL, 'Muhammad Afdaal Raziq Rahim', 'Afdaal', 'Islam', 'L', 'Bekasi', '2013-04-29', 'Taman Permata Cikunir Blok 81 No.33, \r\nJati Bening, Jakarta', '08114107488', '081272284822', 'M. Irfan Hapiz ', 'Ramadhini Hutagalung', 'Karyawan \r\nSwasta', 'Karyawan \r\nSwasta', 'ramadhanihutagalung@gmail.com', '2018', '2018-12-06 00:51:56', 1, 1),
	('140994', '2-1-140994', 2, 1, '', NULL, 'Alya Feisya Latuconsina', 'Alya', 'Islam', 'P', 'Jakarta', '2012-12-11', 'Komp. MPR Jl. Seroja C-141 Cilandak Barat Jakarta Selatan 12430', '0217646244 / \r\n08129916799', '0217696244 / \r\n081319355900', 'Iskandar Latuconsina', 'Olfi Lelya', 'Karyawan \r\nSwasta', 'Karyawan Swasta', 'olfiemail@gmail.com', '2018', '2018-12-06 00:51:56', 1, 2),
	('141000', '2-1-141000', 2, 1, '', NULL, 'Siti Anya', 'Anya', 'Islam', 'P', 'Jakarta', '2012-09-30', 'Jl. Tanjung 19/Gg. 22 Rancho Indah, Tanjung Barat, Jagakarsa , Jak-Sel', '08111012983', '0217892641 / \r\n08164838482', 'Harya Nayaka Wijaya ', 'Muthia Fatirunisa', 'Karyawan \r\nSwasta', 'Karyawan Swasta', 'haryanayaka@gmail.com', '2018', '2018-12-06 00:51:56', 1, 3),
	('140990', '2-1-140990', 2, 1, '', NULL, 'Muhammad Audradianka Danadibrata', 'Audra', 'Islam', 'L', 'Jakarta', '2013-05-31', 'Jl, Swadaya F20 Komp DDN I \r\nPondok Labu Jak-Sel', '02175902321 / \r\n08158786760', '081294747613', 'M. Yusuf Danadibrata', 'Sasti Andayani', 'Karyawan \r\nSwasta', 'Karyawan Swasta', 'sastiandayani@yahoo.com', '2018', '2018-12-06 00:51:56', 1, 4),
	('140987', '2-1-140987', 2, 1, '', NULL, 'Saafia Mysha Farzana', 'Fia', 'Islam', 'P', 'Jakarta', '2012-11-29', 'Jl. Deplu V/101 Cilandak Barat 12430', '0217694638 / 08122021567 ', '08122021567', 'Rahmat Hidayat', 'Dahlia Rahmawati', 'Karyawan \r\nSwasta', 'Karyawan Swasta', 'rahma.dahlia@gmail.com', '2018', '2018-12-06 00:51:56', 1, 5),
	('141022', '2-1-141022', 2, 1, '', NULL, 'Fiona Annabelle Akbar', 'Fiona', 'Islam', 'P', 'Jakarta', '2013-01-12', 'Jl.Puri Mutiara 3 No.12 Rt.004/001 \r\nJakarta', '081389997644', '08176867511', 'Fitra Ali Akbar', 'Fetrisia', 'Karyawan \r\nSwasta', 'Karyawan Swasta', 'fetrisiaakbar17@gmail.com', '2018', '2018-12-06 00:51:56', 1, 6),
	('140991', '2-1-140991', 2, 1, '', NULL, 'Kaiser Javier Alexander Salim', 'Kaiser', 'Islam', 'L', 'Jakarta', '2013-08-01', 'Taman Bona Indah Blok B3/1 \r\nLebak Bulus Jakarta ', '02127650259 / \r\n08161472220', '0816835282 / \r\n081319622202', 'Aga Salim ', 'Tiwi', 'Karyawan \r\nSwasta', 'Karyawan Swasta', 'aga.s.salim@gmail.com', '2018', '2018-12-06 00:51:56', 1, 7),
	('140996', '2-1-140996', 2, 1, '', NULL, 'Karina Layla Maddina Jafar', 'Karina', 'Islam', 'P', 'Jakarta', '2013-07-23', 'Jalan Jatipadang 1 No. 5C Pasar Minggu, Jak-Sel', '0217891535 / \r\n081286332952', '0811988586', 'Farahutama Ripurio', 'Nurfitri Ayuningtyas', 'Karyawan \r\nSwasta', 'Karyawan Swasta', 'fitri.ayunigtyas@gmail.co', '2018', '2018-12-06 00:51:56', 1, 8),
	('140984', '2-1-140984', 2, 1, '', NULL, 'Keenan Athaya Akbar', 'Keenan', 'Islam', 'L', 'Jakarta', '2013-07-27', 'Jl. Benda Atas No 44, Jeruk Purut Kemang, Jak-Sel', '08128246662 / 081319420109', '0217817453 / 0811836095', 'Erick Akbar', 'Yuniar Aryani M', 'Karyawan \r\nSwasta', 'Karyawan Swasta', 'nia.mara@yahoo.com', '2018', '2018-12-06 00:51:56', 1, 9),
	('141020', '2-1-141020', 2, 1, '', NULL, 'Gde ngurah adityarama', 'Rama', 'Hindu', 'L', 'Jakarta', '2012-11-23', 'Jln Bambu Kuning No. 34 Rt.4/Rw.01 Jati padang, Ps minggu', '0217829352 / \r\n085214354033', '0816860018', 'Gde Ngurah Endi Hilm', 'Made Rya Darmayanti', 'Karyawan \r\nSwasta', 'Karyawan Swasta', 'rya87100468@yahoo.com', '2018', '2018-12-06 00:51:56', 1, 10),
	('141012', '2-1-141012', 2, 1, '', NULL, 'Raufan Danadipa Ihsan', 'Raufan', 'Islam', 'L', 'Jakarta', '2013-08-19', 'Jl. Pulo Raya VI No. 25 Keb Baru, \r\nJakarta Selatan', '0217248674 / \r\n08129459835', '08567300486', 'Rizky Hanggono', 'Roro Maheswari Yakti', 'Karyawan \r\nSwasta', 'Karyawan Swasta', 'roro_hanggono@gmail.com', '2018', '2018-12-06 00:51:56', 1, 11),
	('141008', '2-1-141008', 2, 1, '', NULL, 'Muhammad Risyad Firmansyah Lubis', 'Risyad', 'Islam', 'L', 'Jakarta', '2013-01-14', 'Jl. Pahlawan no 16 A Rempoa Gintung, \r\nCiputat Timur, Tangerang Selatan 15412', '0217430126 / \r\n0811998429', '0217430126 / \r\n085717188777', 'Gamma Tua Lubis', 'Maya Risantina', 'Karyawan \r\nSwasta', 'Karyawan Swasta', 'risantina.maya@gmail.com', '2018', '2018-12-06 00:51:56', 1, 12),
	('140999', '2-1-140999', 2, 1, '', NULL, 'Adine Sasikirana', 'Sasi', 'Islam', 'P', 'Jakarta', '2013-04-25', 'Jl. Cilandak 2 No 79, Cilandak Barat\r\n Jakarta Selatan 12430', '021 7512860 / \r\n081514107735', '081514107735', 'Indera Dewaputera', 'Ika Nawang Wulan', 'Karyawan \r\nSwasta', 'Karyawan Swasta', 'idewaputera@gmail.com', '2018', '2018-12-06 00:51:56', 1, 13),
	('141028', '2-1-141028', 2, 1, '', NULL, 'Sonya Rose Noor Alhayaputri Kine', 'Sonya', 'Islam', 'P', 'Jakarta', '2012-04-09', 'Jl. YDPP I/6 Rt 06 Rw 01, Kemang Selatan XII, Jakarta', '081311218998', '081311218998', 'Jonathan Kine', 'Endah Irmawati Kine', 'Karyawan \r\nSwasta', 'Karyawan Swasta', 'endahirmawati@yahoo.com', '2018', '2018-12-06 00:51:56', 1, 14),
	('﻿180514', '1-2-﻿180514', 1, 2, '0125953989', NULL, 'Abyan Zahari Ilova Putra', 'Abyan', 'Islam', 'L', 'Jakarta', '2012-08-16', 'Jl. Sadar 4 No 8A Kp. Setu, Ciganjur, Jagakarsa', '8159939715', '', 'Indah Novita', '', '', 'queen_indah@ymail.com', 'queen_indah@ymail.com', '0000', '2018-12-06 00:53:00', 1, 47),
	('180483', '1-2-180483', 1, 2, '0126604896', NULL, 'Altanraza Ghani Erlangga', 'Raza', 'Islam', 'L', 'Jakarta', '2012-03-10', 'Jl Sirsak Gg. Udel  1 No 4 RT 10 RW 07, Jagakarsa', '081318890507 / 081316683235', 'Galih Erlangga', 'Chaerunnisa Syahrani', 'Karyawan Swasta', 'Karyawan Swasta', 'nisa.erlangga@gmamil.com', '2018', '0000', '2018-12-06 00:53:00', 1, 48),
	('180503', '1-2-180503', 1, 2, '0124000602', NULL, 'Anira Feratiza Bianza', 'Bianza', 'Islam', 'P', 'Jakarta', '2012-08-02', 'Jl. Kebagusan Raya Komp. Kav. Taman Palem No 16, Kebagusan', '8119954240', '', 'Annisa S Widita', '', 'Notaris', 'nisamomces@gmail.com', 'nisamomces@gmail.com', '0000', '2018-12-06 00:53:00', 1, 49),
	('180484', '1-2-180484', 1, 2, '', NULL, 'Arka Dewantara Algeza', 'Arka', 'Islam', 'L', 'Jakarta', '2011-12-31', 'Jl. Ampera I No B1 komp. Arsip Nasional RI', '08164202485 / 08129177016', 'Gembong Wicaksono Utomo', 'Liza Sulaiman', 'Karyawan Swasta', 'BUMN', 'liza_sulaiman2003@yahoo.com', '2018', '0000', '2018-12-06 00:53:00', 1, 50),
	('180522', '1-2-180522', 1, 2, '0113567880', NULL, 'Daffirza Kurniawan Surya', 'Daffiz', 'Islam', 'L', 'Jakarta', '2011-07-17', 'Casa De Chantique Townhouse No B2, Jl. Bukit Cinere 81', '811904427', 'Dimas Kurniawan', 'Devy Novianty', 'Auditor', 'Akuntan', 'devy.novianty@gmail.com', 'devy.novianty@gmail.com', '0000', '2018-12-06 00:53:00', 1, 51),
	('180508', '1-2-180508', 1, 2, '0119141663', NULL, 'Deyra Azkadina Fauziyah', 'Deyra', 'Islam', 'P', 'Jakarta', '2011-12-22', 'Komp. BBd Blok D1/24, RT 005 RW 04, Ciganjur', '081319917817 / 08131814183', 'Arif Maulana Firdaus', '', 'Bank Pemerintah', '', 'mi_damayanti@yahoo.com', 'mi_damayanti@yahoo.com', '0000', '2018-12-06 00:53:00', 1, 52),
	('180481', '1-2-180481', 1, 2, '0111242597', NULL, 'Ezio Raga Hantoro', 'Ezio', 'Islam', 'L', 'Jakarta', '2011-09-28', 'Jl. Sederhana 2 No 12, Cijantung, Jak Tim', '85881970123', 'Yoga Hantoro', '', 'Wiraswasta', '', 'yogamonmon@gmail.com', '2018', '0000', '2018-12-06 00:53:00', 1, 53),
	('180487', '1-2-180487', 1, 2, '0114096682', NULL, 'Hanif Qowiyyun Amiin', 'Hanif', 'Islam', 'L', 'Jakarta', '2011-08-06', 'Jl. Damai IV/68 RT 005 RW 02, Cipete Utara, Kebayoran Baru', '8568386708', 'Fiqih Zulfikar', 'Indah Destrianasari', 'Presenter,MC', 'Pengajar', '', '2018', '0000', '2018-12-06 00:53:00', 1, 54),
	('180505', '1-2-180505', 1, 2, '0127242532', NULL, 'Jaden Kanshansyah Ricky', 'Jaden', 'Islam', 'L', 'Jakarta', '2012-02-23', 'Jl. Kcapi Raya No 74 Kompl. Green Kecapi Kav. C, Jagakrsa', '8111868282', 'Ricky', 'Olivia Natalina', 'Karyawan Swasta', '', 'olivianatalina82@gmail.com', 'olivianatalina82@gmail.com', '0000', '2018-12-06 00:53:00', 1, 55),
	('180495', '1-2-180495', 1, 2, '0122571459', NULL, 'Jingga Aikolyn Darmawan', 'Jingga', 'Islam', 'P', 'Surabaya', '2012-01-11', 'Perum. Pesona Alam Jagakarsa, Jl. Peikanan 64 E4 RT 4 RW 8, Srengseng Sawah', '081284657674 / 082245557683', 'Arif Darmawan', '', 'PNS', '', 'arifdeka82@gmail.com', 'arifdeka82@gmail.com', '0000', '2018-12-06 00:53:00', 1, 56),
	('180489', '1-2-180489', 1, 2, '0127047943', NULL, 'Kenisha Maliqa Padmoninditha', 'Kenisha', 'Islam', 'P', 'Jakarta', '2012-05-21', 'Jl. Kebagusan II Komp. BKKBN No E3, Pasar Minggu', '81585455106', 'Agung Priosusanto', 'Vindy F Dipodiningrat', 'PNS', 'Wiraswasta', 'vindy.f.dipodiningrat@gmail.com', '2018', '0000', '2018-12-06 00:53:00', 1, 57),
	('180516', '1-2-180516', 1, 2, '0118829441', NULL, 'Khalisha Putri Mario', 'Khalisha', 'Islam', 'P', 'Padang', '2011-10-15', 'Pondok Cina Residence 2 Blok C/6, Jl. Karya Bhakti, Pondok Cina, Margonda, Depok', '08118092170 / 08118092160', 'Merios Gusan Putra', '', 'IT Consultan', '', 'm1gucan@yahoo.com', 'm1gucan@yahoo.com', '0000', '2018-12-06 00:53:00', 1, 58),
	('180499', '1-2-180499', 1, 2, '0122720685', NULL, 'Nadhilah Altaira Arsandy', 'Altaira', 'Islam', 'P', 'Jakarta', '2012-05-05', 'Alam Persada Residence, Jl. Balai Rakyat Kav. 97 No 4, Jagakarsa', '82125960921', 'Sandy Triswantoro', 'Ari Kustiyawati', 'Karyawan Swasta', '', 'ari.kustiyawati@gmail.com', 'ari.kustiyawati@gmail.com', '0000', '2018-12-06 00:53:00', 1, 59),
	('180478', '1-2-180478', 1, 2, '0122475939', NULL, 'Nafiyya Harjakusumah', 'Fiyaa', 'Islam', 'P', 'Bandung', '2012-04-11', 'Jl. Gandaria No 70 RT 006 RW 002, Jagakarsa', '85695936779', '', 'Nur Isnayanti', '', 'Ibu Rumah Tangga', 'nur.isnayanti@gmail.com', '2018', '0000', '2018-12-06 00:53:00', 1, 60),
	('180482', '1-2-180482', 1, 2, '0126187059', NULL, 'Niluh Kinasih Nareswari', 'Niluh', 'Kristen', 'P', 'Jakarta', '2012-03-01', 'Jl. Musyawarah No 29D RT 7 RW 4, Jagakarsa', '08111025780 / 08562860073', 'Wegig Gurnanto', '', 'Karyawan Swasta', '', 'nantonih@gmail.com', '2018', '0000', '2018-12-06 00:53:00', 1, 61),
	('180474', '1-2-180474', 1, 2, '0123306430', NULL, 'Pendar Pandega Sabraditya', 'Pendar', 'Islam', 'L', 'Jakarta', '2012-05-24', 'Jl. Jagakarsa Raya Komp. Griya Ihsani IV Blok B  No 2', '89636275155', 'Eka Aditya', 'Ayu Trihardini', 'Dosen', '', 'ayu.trihardini@gmail.com', '2018', '0000', '2018-12-06 00:53:00', 1, 62),
	('180480', '1-2-180480', 1, 2, '0122654970', NULL, 'R. Rayyan Yusuf Fareed', 'Rayyan', 'Islam', 'L', 'Jakarta', '2012-05-26', 'Jl. Sadar Raya No 75B, Ciganjur, Jagakarsa', '081296008476 / 081310598893', 'R. Prasetya Wijaya Kusuma', 'Ni Wayan Arty', 'Karyawan Swasta', 'Dokter', 'wayan_arty@yahoo.com', '2018', '0000', '2018-12-06 00:53:00', 1, 63),
	('180472', '1-2-180472', 1, 2, '0121327545', NULL, 'Ratu Agung Janadipa Maheswara', 'Mahes', 'Hindu', 'L', 'Jakarta', '2012-01-01', 'Jl. Kecapi V, Perum Villa Padi BM5 No 10, Jagakarsa', '087885024423 / 081222248765', 'RAB Gandhi', 'Ni Nyoman S. Wulandari', 'Karyawan Swasta', '', 'rab.gandhi@gmail.com', '2018', '0000', '2018-12-06 00:53:00', 1, 64),
	('180493', '1-2-180493', 1, 2, '0123463344', NULL, 'Rayyan Delisha Setiawan', 'Delisha', 'Islam', 'P', 'Jakarta', '2012-06-22', 'Jagakarsa Residence Az/20, Jl. Kebagusan Raya No 24, Jagakarsa', '081218861287 / 08811210218', 'Agus Setiawan', 'Rosmalia', 'Karyawan Swasta', '', 'yansha79@gmail.com', 'yansha79@gmail.com', '0000', '2018-12-06 00:53:00', 1, 65),
	('180507', '1-2-180507', 1, 2, '0128116115', NULL, 'Sarkara Laislana Sadajiwa Abhipraya', 'Sarkara', 'Islam', 'P', 'Jakarta', '2012-02-05', 'Jl. Syarpa No 114 C, Ciganjur, Jagakarsa', '81381016939', 'Mirza Siddhi Abhipraya', 'Chika Haryani', 'Karyawan Swasta', '', 'mirzajaing@gmail.com', 'mirzajaing@gmail.com', '0000', '2018-12-06 00:53:00', 1, 66),
	('190220001', '2-190220001-1', 2, 2, NULL, 'RG190220001', 'Siswa Test', 'Test', '', 'L', 'Jakarta', '1991-07-24', 'Jalanc', '081201', '081201', 'asdas', 'asd', 'asdas', 'asd', 'asd@asdad.com', '2019', '2019-02-20 03:26:26', 0, 67),
	('190220002', '1-190220002-1', 1, 1, NULL, 'RG190220002', 'Siswa TK Test', 'Siswa TK ', 'Islam', 'L', 'Jakarta', '2009-06-24', 'Jalan', '0812018200392', '010293939210', 'Asd', 'Asdfg', 'Dsa', 'gfdsa', 'asd@sdad.com', '2019', '2019-02-20 03:29:40', 0, 68);
/*!40000 ALTER TABLE `siswa` ENABLE KEYS */;

-- Dumping structure for table tkai.tagihan
CREATE TABLE IF NOT EXISTS `tagihan` (
  `idtagihan` char(20) NOT NULL,
  `idcabang` int(11) NOT NULL,
  `idkategori` int(11) NOT NULL,
  `tahun_ajaran` varchar(10) NOT NULL,
  `seragam` double NOT NULL,
  `peralatan` double NOT NULL,
  `uang_pangkal` double NOT NULL,
  `uang_bangunan` double NOT NULL,
  `material_penunjang` double NOT NULL,
  `material_tahunan` double NOT NULL,
  `urutan` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`urutan`,`idtagihan`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- Dumping data for table tkai.tagihan: ~0 rows (approximately)
/*!40000 ALTER TABLE `tagihan` DISABLE KEYS */;
INSERT INTO `tagihan` (`idtagihan`, `idcabang`, `idkategori`, `tahun_ajaran`, `seragam`, `peralatan`, `uang_pangkal`, `uang_bangunan`, `material_penunjang`, `material_tahunan`, `urutan`) VALUES
	('INV-011962113', 1, 2, '2018/2019', 250000, 2000000, 1500000, 5000000, 2200000, 1750000, 17);
/*!40000 ALTER TABLE `tagihan` ENABLE KEYS */;

-- Dumping structure for table tkai.tagihan_siswa
CREATE TABLE IF NOT EXISTS `tagihan_siswa` (
  `kode_siswa` char(20) NOT NULL,
  `kode_kelas` char(10) NOT NULL,
  `idtagihan` char(20) NOT NULL,
  `idcabang` int(11) NOT NULL,
  `idkategori` int(11) NOT NULL,
  `tahun_ajaran` varchar(20) NOT NULL,
  `seragam` double NOT NULL,
  `peralatan` double NOT NULL,
  `uang_pangkal` double NOT NULL,
  `uang_bangunan` double NOT NULL,
  `material_penunjang` double NOT NULL,
  `material_tahunan` double NOT NULL,
  `tanggal_assign` datetime NOT NULL,
  `user_assign` varchar(50) NOT NULL,
  `urutan` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`urutan`,`kode_siswa`,`idtagihan`,`tahun_ajaran`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

-- Dumping data for table tkai.tagihan_siswa: ~3 rows (approximately)
/*!40000 ALTER TABLE `tagihan_siswa` DISABLE KEYS */;
INSERT INTO `tagihan_siswa` (`kode_siswa`, `kode_kelas`, `idtagihan`, `idcabang`, `idkategori`, `tahun_ajaran`, `seragam`, `peralatan`, `uang_pangkal`, `uang_bangunan`, `material_penunjang`, `material_tahunan`, `tanggal_assign`, `user_assign`, `urutan`) VALUES
	('1-2-180472', '1B', 'INV-011962113', 1, 2, '2018/2019', 250000, 2000000, 1500000, 5000000, 2200000, 1750000, '2019-01-24 10:06:21', 'Admin', 47),
	('1-2-180474', '1A', 'INV-011962113', 1, 2, '2018/2019', 250000, 2000000, 1500000, 5000000, 2200000, 1750000, '2019-01-24 13:13:16', 'Admin', 48),
	('1-2-180478', '1B', 'INV-011962113', 1, 2, '2018/2019', 250000, 2000000, 1500000, 5000000, 2200000, 1750000, '2019-01-24 14:12:35', 'Admin', 49);
/*!40000 ALTER TABLE `tagihan_siswa` ENABLE KEYS */;

-- Dumping structure for table tkai.tagihan_siswa_spp
CREATE TABLE IF NOT EXISTS `tagihan_siswa_spp` (
  `idtagihan` char(20) NOT NULL,
  `kode_siswa` char(20) NOT NULL,
  `bulan` varchar(50) NOT NULL,
  `nominal` double NOT NULL,
  `tahun_ajaran` varchar(50) NOT NULL,
  `flag` int(11) NOT NULL,
  `date_create` datetime NOT NULL,
  `date_update` datetime DEFAULT NULL,
  `user_create` varchar(50) NOT NULL,
  `user_update` varchar(50) DEFAULT NULL,
  `urutan` int(11) DEFAULT NULL,
  PRIMARY KEY (`idtagihan`,`kode_siswa`,`bulan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table tkai.tagihan_siswa_spp: ~36 rows (approximately)
/*!40000 ALTER TABLE `tagihan_siswa_spp` DISABLE KEYS */;
INSERT INTO `tagihan_siswa_spp` (`idtagihan`, `kode_siswa`, `bulan`, `nominal`, `tahun_ajaran`, `flag`, `date_create`, `date_update`, `user_create`, `user_update`, `urutan`) VALUES
	('INV-011962113', '1-2-180472', 'Agustus', 200000, '', 1, '2019-01-24 00:00:00', NULL, 'admin', NULL, 39),
	('INV-011962113', '1-2-180472', 'April', 200000, '', 1, '2019-01-24 00:00:00', NULL, 'admin', NULL, 47),
	('INV-011962113', '1-2-180472', 'Desember', 200000, '', 1, '2019-01-24 00:00:00', NULL, 'admin', NULL, 43),
	('INV-011962113', '1-2-180472', 'Februari', 200000, '', 1, '2019-01-24 00:00:00', NULL, 'admin', NULL, 45),
	('INV-011962113', '1-2-180472', 'Januari', 200000, '', 1, '2019-01-24 00:00:00', NULL, 'admin', NULL, 44),
	('INV-011962113', '1-2-180472', 'Juli', 200000, '', 1, '2019-01-24 00:00:00', NULL, 'admin', NULL, 38),
	('INV-011962113', '1-2-180472', 'Juni', 200000, '', 1, '2019-01-24 00:00:00', NULL, 'admin', NULL, 49),
	('INV-011962113', '1-2-180472', 'Maret', 200000, '', 1, '2019-01-24 00:00:00', NULL, 'admin', NULL, 46),
	('INV-011962113', '1-2-180472', 'Mei', 200000, '', 1, '2019-01-24 00:00:00', NULL, 'admin', NULL, 48),
	('INV-011962113', '1-2-180472', 'November', 200000, '', 1, '2019-01-24 00:00:00', NULL, 'admin', NULL, 42),
	('INV-011962113', '1-2-180472', 'Oktober', 200000, '', 1, '2019-01-24 00:00:00', NULL, 'admin', NULL, 41),
	('INV-011962113', '1-2-180472', 'September', 200000, '', 1, '2019-01-24 00:00:00', NULL, 'admin', NULL, 40),
	('INV-011962113', '1-2-180474', 'Agustus', 200000, '2018/2019', 1, '2019-01-24 00:00:00', NULL, 'admin', NULL, 39),
	('INV-011962113', '1-2-180474', 'April', 200000, '2018/2019', 1, '2019-01-24 00:00:00', NULL, 'admin', NULL, 47),
	('INV-011962113', '1-2-180474', 'Desember', 200000, '2018/2019', 1, '2019-01-24 00:00:00', NULL, 'admin', NULL, 43),
	('INV-011962113', '1-2-180474', 'Februari', 200000, '2018/2019', 1, '2019-01-24 00:00:00', NULL, 'admin', NULL, 45),
	('INV-011962113', '1-2-180474', 'Januari', 200000, '2018/2019', 1, '2019-01-24 00:00:00', NULL, 'admin', NULL, 44),
	('INV-011962113', '1-2-180474', 'Juli', 200000, '2018/2019', 1, '2019-01-24 00:00:00', NULL, 'admin', NULL, 38),
	('INV-011962113', '1-2-180474', 'Juni', 200000, '2018/2019', 1, '2019-01-24 00:00:00', NULL, 'admin', NULL, 49),
	('INV-011962113', '1-2-180474', 'Maret', 200000, '2018/2019', 1, '2019-01-24 00:00:00', NULL, 'admin', NULL, 46),
	('INV-011962113', '1-2-180474', 'Mei', 200000, '2018/2019', 1, '2019-01-24 00:00:00', NULL, 'admin', NULL, 48),
	('INV-011962113', '1-2-180474', 'November', 200000, '2018/2019', 1, '2019-01-24 00:00:00', NULL, 'admin', NULL, 42),
	('INV-011962113', '1-2-180474', 'Oktober', 200000, '2018/2019', 1, '2019-01-24 00:00:00', NULL, 'admin', NULL, 41),
	('INV-011962113', '1-2-180474', 'September', 200000, '2018/2019', 1, '2019-01-24 00:00:00', NULL, 'admin', NULL, 40),
	('INV-011962113', '1-2-180478', 'Agustus', 200000, '2018/2019', 1, '2019-01-24 00:00:00', NULL, 'admin', NULL, 39),
	('INV-011962113', '1-2-180478', 'April', 200000, '2018/2019', 1, '2019-01-24 00:00:00', NULL, 'admin', NULL, 47),
	('INV-011962113', '1-2-180478', 'Desember', 200000, '2018/2019', 1, '2019-01-24 00:00:00', NULL, 'admin', NULL, 43),
	('INV-011962113', '1-2-180478', 'Februari', 200000, '2018/2019', 1, '2019-01-24 00:00:00', NULL, 'admin', NULL, 45),
	('INV-011962113', '1-2-180478', 'Januari', 200000, '2018/2019', 1, '2019-01-24 00:00:00', NULL, 'admin', NULL, 44),
	('INV-011962113', '1-2-180478', 'Juli', 200000, '2018/2019', 1, '2019-01-24 00:00:00', NULL, 'admin', NULL, 38),
	('INV-011962113', '1-2-180478', 'Juni', 200000, '2018/2019', 1, '2019-01-24 00:00:00', NULL, 'admin', NULL, 49),
	('INV-011962113', '1-2-180478', 'Maret', 200000, '2018/2019', 1, '2019-01-24 00:00:00', NULL, 'admin', NULL, 46),
	('INV-011962113', '1-2-180478', 'Mei', 200000, '2018/2019', 1, '2019-01-24 00:00:00', NULL, 'admin', NULL, 48),
	('INV-011962113', '1-2-180478', 'November', 200000, '2018/2019', 1, '2019-01-24 00:00:00', NULL, 'admin', NULL, 42),
	('INV-011962113', '1-2-180478', 'Oktober', 200000, '2018/2019', 1, '2019-01-24 00:00:00', NULL, 'admin', NULL, 41),
	('INV-011962113', '1-2-180478', 'September', 200000, '2018/2019', 1, '2019-01-24 00:00:00', NULL, 'admin', NULL, 40);
/*!40000 ALTER TABLE `tagihan_siswa_spp` ENABLE KEYS */;

-- Dumping structure for table tkai.tagihan_spp
CREATE TABLE IF NOT EXISTS `tagihan_spp` (
  `idtagihan` char(20) NOT NULL,
  `bulan` varchar(50) NOT NULL,
  `nominal` double NOT NULL,
  `urutan` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`urutan`,`idtagihan`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

-- Dumping data for table tkai.tagihan_spp: ~12 rows (approximately)
/*!40000 ALTER TABLE `tagihan_spp` DISABLE KEYS */;
INSERT INTO `tagihan_spp` (`idtagihan`, `bulan`, `nominal`, `urutan`) VALUES
	('INV-011962113', 'Juli', 200000, 38),
	('INV-011962113', 'Agustus', 200000, 39),
	('INV-011962113', 'September', 200000, 40),
	('INV-011962113', 'Oktober', 200000, 41),
	('INV-011962113', 'November', 200000, 42),
	('INV-011962113', 'Desember', 200000, 43),
	('INV-011962113', 'Januari', 200000, 44),
	('INV-011962113', 'Februari', 200000, 45),
	('INV-011962113', 'Maret', 200000, 46),
	('INV-011962113', 'April', 200000, 47),
	('INV-011962113', 'Mei', 200000, 48),
	('INV-011962113', 'Juni', 200000, 49);
/*!40000 ALTER TABLE `tagihan_spp` ENABLE KEYS */;

-- Dumping structure for table tkai.tahun_ajaran
CREATE TABLE IF NOT EXISTS `tahun_ajaran` (
  `idtahun_ajaran` int(11) NOT NULL AUTO_INCREMENT,
  `tahun_ajaran` varchar(20) NOT NULL,
  `flag` int(11) NOT NULL,
  PRIMARY KEY (`idtahun_ajaran`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table tkai.tahun_ajaran: ~2 rows (approximately)
/*!40000 ALTER TABLE `tahun_ajaran` DISABLE KEYS */;
INSERT INTO `tahun_ajaran` (`idtahun_ajaran`, `tahun_ajaran`, `flag`) VALUES
	(1, '2018/2019', 1),
	(3, '2022/2023', 0);
/*!40000 ALTER TABLE `tahun_ajaran` ENABLE KEYS */;

-- Dumping structure for table tkai.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` int(11) NOT NULL DEFAULT 0,
  `cabang` int(11) NOT NULL DEFAULT 0,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table tkai.user: ~0 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `role`, `cabang`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, 0, 'admin', 'I7d86l9yJIE7KXwqoLHJvX9QKHyBq-NN', '$2y$13$JXc4Lc7m1SYcV3TE8hFsq.2O7iZSJFcJrYF4AyTk/4kZweg0V1Gz2', NULL, 'admin@tkai.com', 10, 1544059878, 1544059878);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Dumping structure for view tkai.v_kelas_siswa
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_kelas_siswa` (
	`kode` CHAR(10) NOT NULL COLLATE 'utf8_general_ci',
	`kategori` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	`cabang` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	`nama_sekolah` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	`alamat_sekolah` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	`kecamatan` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	`kota` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	`wali_kelas` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`nis` CHAR(20) NOT NULL COLLATE 'utf8_general_ci',
	`nama_lengkap` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	`nama_panggilan` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`agama` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`jenis_kelamin` CHAR(1) NOT NULL COLLATE 'utf8_general_ci',
	`tempat_lahir` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	`tanggal_lahir` DATE NOT NULL,
	`alamat` VARCHAR(1000) NOT NULL COLLATE 'utf8_general_ci',
	`tlp` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`tlp_darurat` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	`nama_ayah` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`nama_ibu` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`pekerjaan_ayah` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`pekerjaan_ibu` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`email` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`tahun_ajaran` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	`idkategori` INT(11) NOT NULL,
	`idcabang` INT(11) NOT NULL,
	`key_` CHAR(20) NOT NULL COLLATE 'utf8_general_ci',
	`kode_siswa` CHAR(20) NOT NULL COLLATE 'utf8_general_ci'
) ENGINE=MyISAM;

-- Dumping structure for view tkai.v_siswa
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_siswa` (
	`nis` CHAR(20) NOT NULL COLLATE 'utf8_general_ci',
	`no_registrasi` CHAR(20) NULL COLLATE 'utf8_general_ci',
	`kategori` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	`idkategori` INT(11) NOT NULL,
	`cabang` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	`idcabang` INT(11) NOT NULL,
	`nisn` CHAR(20) NULL COLLATE 'utf8_general_ci',
	`nama_lengkap` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	`nama_panggilan` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`agama` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`jenis_kelamin` CHAR(1) NOT NULL COLLATE 'utf8_general_ci',
	`tempat_lahir` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	`tanggal_lahir` DATE NOT NULL,
	`alamat` VARCHAR(1000) NOT NULL COLLATE 'utf8_general_ci',
	`tlp` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`tlp_darurat` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	`nama_ayah` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`nama_ibu` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`pekerjaan_ayah` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`pekerjaan_ibu` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`email` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`tahun_ajaran` YEAR NOT NULL,
	`kode_siswa` CHAR(20) NOT NULL COLLATE 'utf8_general_ci',
	`tahun_input` YEAR NOT NULL,
	`tgl_input` DATETIME NOT NULL,
	`status` TINYINT(4) NOT NULL,
	`urutan` INT(11) NOT NULL
) ENGINE=MyISAM;

-- Dumping structure for view tkai.v_tagihan
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_tagihan` (
	`idtagihan` CHAR(20) NOT NULL COLLATE 'latin1_swedish_ci',
	`idcabang` INT(11) NOT NULL,
	`idkategori` INT(11) NOT NULL,
	`tahun_ajaran` VARCHAR(10) NOT NULL COLLATE 'latin1_swedish_ci',
	`seragam` DOUBLE NOT NULL,
	`peralatan` DOUBLE NOT NULL,
	`uang_pangkal` DOUBLE NOT NULL,
	`uang_bangunan` DOUBLE NOT NULL,
	`material_penunjang` DOUBLE NOT NULL,
	`material_tahunan` DOUBLE NOT NULL,
	`urutan` INT(11) NOT NULL,
	`cabang` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	`grade` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci'
) ENGINE=MyISAM;

-- Dumping structure for view tkai.v_tagihan_siswa
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_tagihan_siswa` (
	`kode_siswa` CHAR(20) NOT NULL COLLATE 'latin1_swedish_ci',
	`kode_kelas` CHAR(10) NOT NULL COLLATE 'latin1_swedish_ci',
	`idtagihan` CHAR(20) NOT NULL COLLATE 'latin1_swedish_ci',
	`tahun_ajaran` VARCHAR(20) NOT NULL COLLATE 'latin1_swedish_ci',
	`remarks` VARCHAR(18) NOT NULL COLLATE 'utf8mb4_general_ci',
	`nominal` DOUBLE NOT NULL
) ENGINE=MyISAM;

-- Dumping structure for view tkai.v_tagihan_siswa_all
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_tagihan_siswa_all` (
	`kode_siswa` CHAR(20) NOT NULL COLLATE 'latin1_swedish_ci',
	`kode_kelas` CHAR(10) NOT NULL COLLATE 'latin1_swedish_ci',
	`idtagihan` CHAR(20) NOT NULL COLLATE 'latin1_swedish_ci',
	`tahun_ajaran` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`keterangan` VARCHAR(7) NOT NULL COLLATE 'utf8mb4_general_ci',
	`remarks` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`nominal` DOUBLE NOT NULL,
	`urutan` BIGINT(11) NULL
) ENGINE=MyISAM;

-- Dumping structure for view tkai.v_kelas_siswa
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_kelas_siswa`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `v_kelas_siswa` AS SELECT a.kode
		,b.keterangan `kategori`	
		,c.keterangan `cabang`	
		,c.nama_sekolah
		,c.alamat alamat_sekolah
		,c.kecamatan
		,c.kota
		,a.wali_kelas
		,e.nis
		,e.nama_lengkap
		,e.nama_panggilan
		,e.agama
		,e.jenis_kelamin
		,e.tempat_lahir
		,e.tanggal_lahir
		,e.alamat
		,e.tlp
		,e.tlp_darurat
		,e.nama_ayah
		,e.nama_ibu
		,e.pekerjaan_ayah
		,e.pekerjaan_ibu
		,e.email
		,a.tahun_ajaran
		,b.idkategori idkategori
		,c.idcabang idcabang
		,d.key_
		,d.kode_siswa
FROM kelas a
JOIN kategori b ON a.idkategori= b.idkategori 
JOIN cabang c ON a.idcabang = c.idcabang
JOIN detil_kelas d ON a.key_ = d.key_
JOIN siswa e ON e.kode_siswa = d.kode_siswa ;

-- Dumping structure for view tkai.v_siswa
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_siswa`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `v_siswa` AS SELECT a.nis
		,a.no_registrasi
		,b.keterangan 'kategori'
		,b.idkategori idkategori
		,c.keterangan 'cabang'
		,c.idcabang 
		,a.nisn
		,a.nama_lengkap
		,a.nama_panggilan
		,a.agama
		,a.jenis_kelamin
		,a.tempat_lahir
		,a.tanggal_lahir
		,a.alamat
		,a.tlp
		,a.tlp_darurat
		,a.nama_ayah
		,a.nama_ibu
		,a.pekerjaan_ayah
		,a.pekerjaan_ibu
		,a.email
		,a.tahun_input 'tahun_ajaran'
		,a.kode_siswa
		,a.tahun_input
		,a.tgl_input
		,a.`status`
		,a.urutan
FROM siswa a 
JOIN kategori b ON a.idkategori = b.idkategori
JOIN cabang c ON a.idcabang = c.idcabang ;

-- Dumping structure for view tkai.v_tagihan
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_tagihan`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `v_tagihan` AS SELECT a.*, b.keterangan `cabang`, c.keterangan grade
FROM tagihan a 
JOIN cabang b ON a.idcabang = b.idcabang 
JOIN kategori c ON a.idkategori = c.idkategori ;

-- Dumping structure for view tkai.v_tagihan_siswa
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_tagihan_siswa`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `v_tagihan_siswa` AS SELECT kode_siswa, kode_kelas, idtagihan, tahun_ajaran, 'Seragam' remarks, seragam nominal FROM tagihan_siswa
UNION ALL
SELECT kode_siswa, kode_kelas, idtagihan, tahun_ajaran, 'Peralatan' remarks, peralatan nominal FROM tagihan_siswa
UNION ALL
SELECT kode_siswa, kode_kelas, idtagihan, tahun_ajaran, 'Uang Pangkal' remarks, uang_pangkal nominal FROM tagihan_siswa
UNION ALL
SELECT kode_siswa, kode_kelas, idtagihan, tahun_ajaran, 'Uang Bangunan' remarks, uang_bangunan nominal FROM tagihan_siswa
UNION ALL
SELECT kode_siswa, kode_kelas, idtagihan, tahun_ajaran, 'Material Penunjang' material_penunjang, seragam nominal FROM tagihan_siswa
UNION ALL
SELECT kode_siswa, kode_kelas, idtagihan, tahun_ajaran, 'Material Tahunan' remarks, material_tahunan nominal FROM tagihan_siswa ;

-- Dumping structure for view tkai.v_tagihan_siswa_all
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_tagihan_siswa_all`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `v_tagihan_siswa_all` AS SELECT kode_siswa
		,kode_kelas
		,idtagihan
		,tahun_ajaran
		,'tagihan' keterangan
		,remarks
		,nominal
		,0 urutan
FROM v_tagihan_siswa 
UNION ALL
SELECT a.kode_siswa
		,b.kode_kelas
		,a.idtagihan
		,a.tahun_ajaran
		,'spp' keterangan
		,a.bulan remarks
		,a.nominal	
		,a.urutan	
FROM tagihan_siswa_spp a 
JOIN tagihan_siswa b ON a.idtagihan = b.idtagihan AND a.kode_siswa = b.kode_siswa
ORDER BY urutan ASC ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
