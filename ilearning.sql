-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2018 at 01:28 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ilearning`
--

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE IF NOT EXISTS `guru` (
`id_guru` int(11) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id_guru`, `nip`, `nama`, `jabatan`, `username`, `password`, `level`) VALUES
(39, '0001', 'Nama Guru', 'Guru Bahasa Indonesia', 'guru1', '$2y$10$77lTOgsuzAB34x3burEQuuY2vdupV8gnszl3vZlsIEuT4M6ysQJTi', 'guruku'),
(40, '0002', 'Nama Guru', 'Guru Bahasa Inggris', 'guru2', '$2y$10$2QtkHOVijtqnPbhfWHxCe.57kk47TgmXHzFqwJEKuZH.RgehU8oXS', 'guruku'),
(41, '0003', 'Nama Guru', 'Guru Matematika', 'guru3', '$2y$10$.04xJZf0WdnuENyr62QiO.Y0aZImoyQcCQbXeWNt22TxP2lxm8br2', 'guruku');

-- --------------------------------------------------------

--
-- Table structure for table `jawaban`
--

CREATE TABLE IF NOT EXISTS `jawaban` (
`id_jawaban` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `id_soal` int(11) NOT NULL,
  `jawaban` char(1) NOT NULL,
  `ragu` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jawaban`
--

INSERT INTO `jawaban` (`id_jawaban`, `id_siswa`, `id_mapel`, `id_soal`, `jawaban`, `ragu`) VALUES
(25, 10, 18, 781, 'B', 0),
(26, 10, 18, 778, 'A', 0),
(27, 24, 19, 805, 'C', 0),
(28, 24, 19, 806, 'C', 0),
(29, 24, 19, 807, 'C', 0),
(30, 24, 19, 808, 'A', 0),
(31, 24, 19, 809, 'A', 0);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE IF NOT EXISTS `kelas` (
`id_kelas` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama`) VALUES
(1, 'X-TE1');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE IF NOT EXISTS `log` (
`id_log` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `text` varchar(20) NOT NULL,
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id_log`, `id_siswa`, `type`, `text`, `date`) VALUES
(1, 1, 'login', 'masuk', '2018-01-05 23:35:03'),
(2, 1, 'testongoing', 'sedang ujian', '2018-01-05 23:36:01'),
(3, 1, 'login', 'masuk', '2018-01-06 06:36:30'),
(4, 1, 'logout', 'keluar', '2018-01-06 06:38:01'),
(5, 1, 'login', 'masuk', '2018-01-06 06:38:10'),
(6, 1, 'testongoing', 'sedang ujian', '2018-01-06 06:38:13');

-- --------------------------------------------------------

--
-- Table structure for table `log1`
--

CREATE TABLE IF NOT EXISTS `log1` (
`id_log` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `text` varchar(20) NOT NULL,
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE IF NOT EXISTS `mapel` (
`id_mapel` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jml_soal` int(5) NOT NULL,
  `tgl_ujian` varchar(20) NOT NULL,
  `lama_ujian` int(11) NOT NULL,
  `acak` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`id_mapel`, `nama`, `jml_soal`, `tgl_ujian`, `lama_ujian`, `acak`) VALUES
(21, 'Bahasa Indonesia', 50, '2018-01-08 08:00:00', 120, 1),
(22, 'Bahasa Inggris (Paket A)', 50, '2018-01-06 06.40:00', 120, 1),
(23, 'Matematika (Akuntansi)', 40, '2018-01-10 08:00:00', 120, 1),
(24, 'Matematika (Pariwisata)', 40, '2018-01-10 08:00:00', 120, 1),
(25, 'Matematika (Teknik)', 40, '2018-01-10 08:00:00', 120, 1),
(26, 'Bahasa Inggris (Paket B)', 120, '2018-01-09 08:00:00', 120, 0);

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE IF NOT EXISTS `nilai` (
`id_nilai` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `ujian_mulai` varchar(20) NOT NULL,
  `ujian_berlangsung` varchar(20) NOT NULL,
  `ujian_selesai` varchar(20) NOT NULL,
  `jml_benar` int(10) NOT NULL,
  `jml_salah` int(10) NOT NULL,
  `skor` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `id_mapel`, `id_siswa`, `ujian_mulai`, `ujian_berlangsung`, `ujian_selesai`, `jml_benar`, `jml_salah`, `skor`) VALUES
(2, 22, 1, '2018-01-06 06:38:13', '2018-01-06 07:23:07', '', 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `pengacak`
--

CREATE TABLE IF NOT EXISTS `pengacak` (
`id_pengacak` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `id_soal` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengacak`
--

INSERT INTO `pengacak` (`id_pengacak`, `id_siswa`, `id_mapel`, `id_soal`) VALUES
(2, 1, 22, '1018,999,940,961,947,951,954,958,956,962,1025,1026,1028,1022,1023,939,1031,1032,1033,1034,1015,1019,973,953,1029,937,976,966,963,969,1024,955,949,974,943,1030,957,989,965,941,971,992,981,967,959,945,1020,1021,1027,950,');

-- --------------------------------------------------------

--
-- Table structure for table `pengawas`
--

CREATE TABLE IF NOT EXISTS `pengawas` (
`id_pengawas` int(11) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengawas`
--

INSERT INTO `pengawas` (`id_pengawas`, `nip`, `nama`, `jabatan`, `username`, `password`, `level`) VALUES
(1, '123456789', 'Proktor Ruang', 'Wks. Kurikulum & SDM', 'admin', '$2y$10$ZJAeeWOUBMjiD8aJA1w4p.7XGaNeQemSTSZlY0uGrXvOX2bX9ZbMy', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE IF NOT EXISTS `session` (
`id` int(11) NOT NULL,
  `session_time` varchar(10) NOT NULL,
  `session_hash` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`id`, `session_time`, `session_hash`) VALUES
(1, '1447610188', '$2y$10$dt9BTs7FlTXgpactflaXPOSVWrs.wurWsKBGv18JkzolJmHZOj.B.');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
`id_setting` int(11) NOT NULL,
  `aplikasi` varchar(100) NOT NULL,
  `sekolah` varchar(50) NOT NULL,
  `kepsek` varchar(50) NOT NULL,
  `nip` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(20) NOT NULL,
  `fax` varchar(20) NOT NULL,
  `web` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `logo` text NOT NULL,
  `header` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id_setting`, `aplikasi`, `sekolah`, `kepsek`, `nip`, `alamat`, `telp`, `fax`, `web`, `email`, `logo`, `header`) VALUES
(1, 'CBT Application', 'SMK MKKSMK', 'Kepsek', '123456789', 'Jl. Teuku Umar No. 01 Cikarang Barat Bekasi', '(021) 123456789', '(021) 123456789', 'www.sekolah.sch.id', 'demo@sekolah.sch.id', 'dist/img/logoaplikasi.jpg', 'PEMERINTAH PROVINSI JAWA BARAT<br />\r\nDINAS PENDIDIKAN');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE IF NOT EXISTS `siswa` (
`id_siswa` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `nis` varchar(30) NOT NULL,
  `no_peserta` varchar(30) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `paket` varchar(1) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `id_kelas`, `nis`, `no_peserta`, `nama`, `paket`, `username`, `password`) VALUES
(1, 1, '555', '5555', 'AD', 'A', '12', '12');

-- --------------------------------------------------------

--
-- Table structure for table `soal`
--

CREATE TABLE IF NOT EXISTS `soal` (
`id_soal` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `paket` varchar(1) NOT NULL,
  `nomor` int(5) NOT NULL,
  `soal` text NOT NULL,
  `pilA` text NOT NULL,
  `pilB` text NOT NULL,
  `pilC` text NOT NULL,
  `pilD` text NOT NULL,
  `pilE` text NOT NULL,
  `jawaban` varchar(1) NOT NULL,
  `file` text NOT NULL,
  `file1` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1035 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soal`
--

INSERT INTO `soal` (`id_soal`, `id_mapel`, `paket`, `nomor`, `soal`, `pilA`, `pilB`, `pilC`, `pilD`, `pilE`, `jawaban`, `file`, `file1`) VALUES
(815, 23, 'A', 5, '<p>Lukman, Fahmi, dan Amel membeli 2 jenis barang pada\r\ntoko yang sama. Lukman membeli 2 barang A dan 2 barang B dengan membayar Rp\r\n50.000,00. Fahmi membeli 3 barang A dan 2 barang B dengan membayar Rp\r\n65.000,00. Jika Amel membawa uang senilai Rp 100.000,00 dan ia membeli 5 barang\r\nA dan 2 barang B, sisa uang Amel adalah ....\r\n\r\n\r\n\r\n<br></p>', 'Rp. 5.000,00', 'Rp. 10.000,00', 'Rp. 15.000,00', 'Rp. 80.000,00', 'Rp. 95.000,00', 'A', '', ''),
(816, 23, 'A', 1, '<p>&nbsp;&nbsp; <img src="http://localhost/cbt/files/23_1_1.jpg" alt=""></p>', 'A', 'B', 'C', 'D', 'E', 'C', 'files/23_1_1.jpg', ''),
(817, 23, 'A', 19, '<p><b><i></i></b>Dari suatu deret aritmatika, diketahui suku\r\npertama = 8 dan suku ke-8 = 57.  Jumlah\r\n35 suku yang pertama deret tersebut adalah\r\n<b><i></i></b>\r\n\r\n\r\n<br></p>', '246', '4.345', '4.445', '4.545', '8.890', 'C', '', ''),
(818, 23, 'A', 18, '<p>&nbsp;<img src="http://localhost/cbt/files/23_18_1.jpg" alt=""></p>', '25', '27', '35', '37', '39', 'C', 'files/23_18_1.jpg', ''),
(819, 23, 'A', 23, '<p><b></b>Gaji seorang karyawan setiap bulan naik Rp.\r\n25.000,00 dari bulan sebelumnya. Jika gaji karyawan tersebut pada bulan pertama\r\nRp. 1.250.000,00 maka jumlah gaji selama satu tahun adalah&nbsp;</p><p><br></p>', 'Rp. 15.000.000,00', 'Rp. 15.300.000,00', 'Rp. 16.200.000,00', 'Rp. 16.650.000,00', 'Rp. 17.250.000,00', 'D', '', ''),
(820, 23, 'A', 24, '<p><b></b>Sebuah bola pingpong dijatuhkan ke lantai dari\r\nketinggian 2 meter. Setiap kali bola memantul, ia mencapai ketinggian tiga\r\nperempat dari ketinggian yang dicapai sebelumnya. Panjang lintasan bola\r\ntersebut sampai berhenti adalah&nbsp;</p><p><br></p>', '12 m', '14 m', '15 m', '16 m', '17 m', 'B', '', ''),
(821, 23, 'A', 25, '<p><b></b>Hadi menabung sebesar Rp 5.500.000,00 di bank yang\r\nmenawarkan suku bunga tunggal 2,4% per tahun. Jika Hadi tidak pernah mengambil\r\nuangnya selama 10 tahun, maka besar saldo yang dimiliki Hadi adalah&nbsp;</p><p><br></p>', 'Rp. 7.820.000,00', 'Rp. 6.820.000,00', 'Rp. 6.532.000,00', 'Rp. 5.632.000,00', 'Rp. 5.832.000,00', 'B', '', ''),
(822, 23, 'A', 29, '<p><b></b>Banyak bilangan ganjil yang terdiri atas tiga angka\r\nberlainan yang dapat dibentuk dari dari angka 0, 1, 2, 3, dan 5 adalah â€¦â€¦..\r\nbilangan\r\n\r\n\r\n\r\nadalah</p><p><br></p>', '27', '36', '60', '75', '120', 'B', '', ''),
(823, 25, 'A', 1, '<p>&nbsp;&nbsp;<img alt="" src="http://localhost/cbt/files/25_1_1.jpg"></p>', '  ', '  ', '  ', '  ', '  ', 'C', 'files/25_1_1.jpg', ''),
(824, 25, 'A', 2, '<p>&nbsp;&nbsp;<img alt="" src="http://localhost/cbt/files/25_2_1.jpg"></p>', '  ', '  ', '  ', '  ', '  ', 'A', 'files/25_2_1.jpg', ''),
(825, 25, 'A', 3, '<p>&nbsp;&nbsp;<img alt="" src="http://localhost/cbt/files/25_3_1.jpg"></p>', '  ', '  ', '  ', '  ', '  ', 'A', 'files/25_3_1.jpg', ''),
(826, 25, 'A', 4, '<p>&nbsp; <img src="http://localhost/cbt/files/25_4_1.jpg" alt=""></p>', '  ', '  ', '  ', '  ', '  ', 'A', 'files/25_4_1.jpg', ''),
(827, 25, 'A', 5, '<p>&nbsp; <img src="http://localhost/cbt/files/25_5_1.jpg" alt=""></p>', '  ', '  ', '  ', '  ', '  ', 'C', 'files/25_5_1.jpg', ''),
(828, 25, 'A', 6, '<p>&nbsp; &nbsp;&nbsp;<img alt="" src="http://localhost/cbt/files/25_6_1.jpg"></p>', '    ', '    ', '    ', '    ', '    ', 'B', 'files/25_6_1.jpg', ''),
(829, 25, 'A', 7, '<p>&nbsp;&nbsp;<img alt="" src="http://localhost/cbt/files/25_7_1.jpg"></p>', '  ', '  ', '  ', '  ', '  ', 'E', 'files/25_7_1.jpg', ''),
(830, 25, 'A', 8, '<p>&nbsp; <img src="http://localhost/cbt/files/25_8_1.jpg" alt=""></p>', '  ', '  ', '  ', '  ', '  ', 'B', 'files/25_8_1.jpg', ''),
(831, 25, 'A', 9, '<p>&nbsp;&nbsp; <img src="http://localhost/cbt/files/25_9_1.jpg" alt=""></p>', '   ', '  ', '   ', '  ', '   ', 'E', 'files/25_9_1.jpg', ''),
(832, 25, 'A', 10, '<p>&nbsp; <img src="http://localhost/cbt/files/25_10_1.jpg" alt=""></p>', '  ', '   ', '   ', '  ', '  ', 'C', 'files/25_10_1.jpg', ''),
(833, 25, 'A', 11, '<p>&nbsp;&nbsp; <img src="http://localhost/cbt/files/25_11_1.jpg" alt=""></p>', '   ', '  ', '   ', '   ', '   ', 'C', 'files/25_11_1.jpg', ''),
(834, 23, 'A', 40, '<p>Simpangan baku dari data 4,5,6,7,8,9,10 adalah</p>', '6', '5', '4', '3', '2', 'E', '', ''),
(835, 23, 'A', 2, '<p>&nbsp;<img src="http://localhost/cbt/files/23_2_1.jpg" alt=""></p>', 'A', 'B', 'C', 'D', 'E', 'A', 'files/23_2_1.jpg', ''),
(836, 25, 'A', 12, '<p>&nbsp;&nbsp; <img src="http://localhost/cbt/files/25_12_1.jpg" alt=""></p>', '  ', '  ', '   ', '   ', '   ', 'C', 'files/25_12_1.jpg', ''),
(837, 25, 'A', 13, '<p>&nbsp;&nbsp; <img src="http://localhost/cbt/files/25_13_1.jpg" alt=""></p>', '   ', '   ', '  ', '   ', '   ', 'E', 'files/25_13_1.jpg', ''),
(838, 23, 'A', 4, '<p>&nbsp;<img src="http://localhost/cbt/files/23_4_1.jpg" alt=""></p>', 'A', 'B', 'C', 'D', 'E', 'C', 'files/23_4_1.jpg', ''),
(839, 25, 'A', 14, '<p>&nbsp;&nbsp; <img src="http://localhost/cbt/files/25_14_1.jpg" alt=""></p>', '  ', '  ', '  ', '  ', '   ', 'E', 'files/25_14_1.jpg', ''),
(840, 23, 'A', 3, '<p>&nbsp;<img src="http://localhost/cbt/files/23_3_1.jpg" alt=""></p>', 'A', 'B', 'C', 'D', 'E', 'A', 'files/23_3_1.jpg', ''),
(841, 25, 'A', 15, '<p>&nbsp; &nbsp;<img alt="" src="http://localhost/cbt/files/25_15_1.jpg"></p>', '   ', '   ', '   ', '   ', '    ', 'C', 'files/25_15_1.jpg', ''),
(842, 23, 'A', 6, '<p>&nbsp;&nbsp; <img src="http://localhost/cbt/files/23_6_1.jpg" alt=""></p>', 'A', 'B', 'C', 'D', 'E', 'C', 'files/23_6_1.jpg', ''),
(843, 25, 'A', 16, '<p>&nbsp; <img src="http://localhost/cbt/files/25_16_1.jpg" alt=""></p>', '  ', '  ', '  ', '  ', '  ', 'C', 'files/25_16_1.jpg', ''),
(844, 23, 'A', 7, '<p>&nbsp;<img src="http://localhost/cbt/files/23_7_1.jpg" alt=""></p>', 'A', 'B', 'C', 'D', 'E', 'E', 'files/23_7_1.jpg', ''),
(845, 25, 'A', 17, '<p>&nbsp;&nbsp; <img src="http://localhost/cbt/files/25_17_1.jpg" alt=""></p>', '   ', '  ', '  ', '   ', '  ', 'C', 'files/25_17_1.jpg', ''),
(846, 23, 'A', 8, '<p>&nbsp;<img src="http://localhost/cbt/files/23_8_1.jpg" alt=""></p>', 'A', 'B', 'C', 'D', 'E', 'A', 'files/23_8_1.jpg', ''),
(847, 25, 'A', 18, '<p>&nbsp; <img src="http://localhost/cbt/files/25_18_1.jpg" alt=""></p>', '  ', '  ', '  ', '  ', '  ', 'C', 'files/25_18_1.jpg', ''),
(848, 23, 'A', 9, '<p>&nbsp;<img src="http://localhost/cbt/files/23_9_1.jpg" alt=""></p>', 'A', 'B', 'C', 'D', 'E', 'B', 'files/23_9_1.jpg', ''),
(849, 25, 'A', 19, '<p>&nbsp;&nbsp; <img src="http://localhost/cbt/files/25_19_1.jpg" alt=""></p>', '   ', '   ', '   ', '   ', '   ', 'A', 'files/25_19_1.jpg', ''),
(850, 23, 'A', 10, '<p>&nbsp;<img src="http://localhost/cbt/files/23_10_1.jpg" alt=""></p>', 'A', 'B', 'C', 'D', 'E', 'D', 'files/23_10_1.jpg', ''),
(851, 23, 'A', 11, '<p>&nbsp;<img src="http://localhost/cbt/files/23_11_1.jpg" alt=""></p>', 'A', 'B', 'C', 'D', 'E', 'A', 'files/23_11_1.jpg', ''),
(852, 25, 'A', 20, '<p>&nbsp; &nbsp;&nbsp; <img src="http://localhost/cbt/files/25_20_1.jpg" alt=""></p>', '    ', '    ', '     ', '    ', '        ', 'E', 'files/25_20_1.jpg', ''),
(853, 23, 'A', 12, '<p>Sistem pertidaksamaan yang\r\nmenunjukkan daerah yang diarsir pada grafik di bawah adalah <br></p><p><br></p><p><img src="http://localhost/cbt/files/23_12_1.jpg" alt=""></p>', 'A', 'B', 'C', 'D', 'E', 'E', 'files/23_12_1.jpg', ''),
(854, 23, 'A', 13, '<img src="http://localhost/cbt/files/23_13_2.jpg" alt="">', 'A', 'B', 'C', 'D', 'E', 'A', '', 'files/23_13_2.jpg'),
(855, 25, 'A', 21, '<p>&nbsp;&nbsp; <img src="http://localhost/cbt/files/25_21_1.jpg" alt=""></p>', '    ', '   ', '   ', '   ', '     ', 'C', 'files/25_21_1.jpg', ''),
(856, 23, 'A', 14, '<p><b></b>Seorang pembuat kue setiap\r\nharinya membuat dua jenis roti untuk di jual. Setiap kue jenis A ongkos\r\npembuatannya Rp 2.000,00 dengan keuntungannya Rp 800,00, kue jenis B ongkos\r\npembuatannya Rp 3.000,00 keuntungannya Rp 900,00. Apabila yang tersedia setiap\r\nharinya Rp 1.000.000,00. Sedangkan paling banyak ia hanya mampu membuat 400 kue\r\nsetiap hari. Keuntungan terbesar pembuat kue adalah <b></b>\r\n\r\n\r\n\r\n<br></p>', 'Rp. 300.000,00', 'Rp. 320.000,00', 'Rp. 340.000,00', 'Rp. 360.000,00', 'Rp. 400.000,00', 'C', '', ''),
(857, 23, 'A', 15, '<p>Persamaan grafik fungsi kuadrat yang sesuai\r\ndengan gambar di samping adalah</p><p><img src="http://localhost/cbt/files/23_15_1.jpg" alt=""><b> </b>\r\n\r\n\r\n\r\n</p>', 'A', 'B', 'C', 'D', 'E', 'D', 'files/23_15_1.jpg', ''),
(858, 25, 'A', 22, '<p>&nbsp;&nbsp; <img src="http://localhost/cbt/files/25_22_1.jpg" alt=""></p>', '   ', '   ', '   ', '  ', '   ', 'E', 'files/25_22_1.jpg', ''),
(859, 25, 'A', 23, '<p>&nbsp; &nbsp; <img src="http://localhost/cbt/files/25_23_1.jpg" alt=""></p>', '   ', '  ', '  ', '   ', '   ', 'C', 'files/25_23_1.jpg', ''),
(860, 25, 'A', 24, '<p>&nbsp;&nbsp; <img src="http://localhost/cbt/files/25_24_1.jpg" alt=""></p>', '  ', '  ', ' ', '   ', '   ', 'B', 'files/25_24_1.jpg', ''),
(861, 25, 'A', 25, '<p>&nbsp;&nbsp; <img src="http://localhost/cbt/files/25_25_1.jpg" alt=""></p>', '  ', '  ', '  ', '   ', '   ', 'E', 'files/25_25_1.jpg', ''),
(862, 23, 'A', 16, '<p>Diketahuia barisan bilangan 4,9,16,25,...rumus umum barisan tersebut adalah ....</p><p><img src="http://localhost/cbt/files/23_16_1.jpg" alt=""></p>', 'A', 'B', 'C', 'D', 'E', 'D', 'files/23_16_1.jpg', ''),
(863, 23, 'A', 17, '<p>&nbsp;<img src="http://localhost/cbt/files/23_17_1.jpg" alt=""></p>', 'A', 'B', 'C', 'D', 'E', 'B', 'files/23_17_1.jpg', ''),
(864, 23, 'A', 20, '<p>&nbsp;<img src="http://localhost/cbt/files/23_20_1.jpg" alt=""></p>', 'A', 'B', 'C', 'D', 'E', 'A', 'files/23_20_1.jpg', ''),
(865, 23, 'A', 21, '<p>&nbsp;<img src="http://localhost/cbt/files/23_21_1.jpg" alt=""></p>', 'A', 'B', 'C', 'D', 'E', 'C', 'files/23_21_1.jpg', ''),
(866, 23, 'A', 22, '<p>&nbsp;<img src="http://localhost/cbt/files/23_22_1.jpg" alt=""></p>', 'A', 'B', 'C', 'D', 'E', 'B', 'files/23_22_1.jpg', ''),
(867, 25, 'A', 26, '<p>&nbsp;&nbsp; <img src="http://localhost/cbt/files/25_26_1.jpg" alt=""></p>', '   ', '  ', '   ', '   ', '   ', 'D', 'files/25_26_1.jpg', ''),
(868, 25, 'A', 27, '<p>&nbsp;&nbsp; <img src="http://localhost/cbt/files/25_27_1.jpg" alt=""></p>', '   ', '   ', '   ', '  ', '    ', 'A', 'files/25_27_1.jpg', ''),
(869, 25, 'A', 28, '<p>&nbsp;&nbsp; <img src="http://localhost/cbt/files/25_28_1.jpg" alt=""></p>', '  ', '  ', '  ', '  ', '   ', 'B', 'files/25_28_1.jpg', ''),
(870, 25, 'A', 29, '<p>&nbsp; <img src="http://localhost/cbt/files/25_29_1.jpg" alt=""></p>', '  ', '  ', '  ', '  ', '   ', 'C', 'files/25_29_1.jpg', ''),
(871, 25, 'A', 30, '<p>&nbsp; &nbsp;<img alt="" src="http://localhost/cbt/files/25_30_1.jpg"></p>', '  ', '  ', '  ', '  ', '   ', 'E', 'files/25_30_1.jpg', ''),
(872, 23, 'A', 26, '<p>Setiap akhir bulan Pak Sumarmo menabung uangnya\r\ndi bank BPR Rp2.500.000,00 dengan suku bunga majemuk 2% per bulan. Dengan\r\nbantuan tabel berikut, besar uang Pak Sumarmo setelah menyimpan selama 2,5\r\ntahun jika bank tidak mengenakan biaya administrasi adalah <br></p><p><br></p><p>\r\n\r\n\r\n<img src="http://localhost/cbt/files/23_26_1.jpg" alt=""></p>', 'Rp.  100.875.000,00', 'Rp.  100.950.000,00', 'Rp.  101.150.000,00', 'Rp.  101.250.000,00', 'Rp.  103.275.000,00', 'D', 'files/23_26_1.jpg', ''),
(873, 25, 'A', 31, '<p>&nbsp;&nbsp; <img src="http://localhost/cbt/files/25_31_1.jpg" alt=""></p>', '  ', '  ', '  ', '  ', '  ', 'C', 'files/25_31_1.jpg', ''),
(874, 23, 'A', 27, '<p>&nbsp;<img src="http://localhost/cbt/files/23_27_1.jpg" alt=""></p>', 'A', 'B', 'C', 'D', 'E', 'E', 'files/23_27_1.jpg', ''),
(875, 25, 'A', 32, '<p>&nbsp; <img src="http://localhost/cbt/files/25_32_1.jpg" alt=""></p>', '   ', '   ', '   ', '   ', '  ', 'B', 'files/25_32_1.jpg', ''),
(876, 25, 'A', 33, '<p>&nbsp; <img src="http://localhost/cbt/files/25_33_1.jpg" alt=""></p>', '   ', '   ', '   ', '   ', '    ', 'B', 'files/25_33_1.jpg', ''),
(877, 23, 'A', 28, '<p>&nbsp;<img src="http://localhost/cbt/files/23_28_2.jpg" alt=""></p>', 'A', 'B', 'C', 'D', 'E', 'E', '', 'files/23_28_2.jpg'),
(878, 23, 'A', 30, '<p>&nbsp; &nbsp; Dari suatukelas yang berjumlah 30\r\nsiswaakandipilihpengurus OSIS yang terdiridariKetua, Wakil Ketua,\r\nBendahara dan Sekretaris.\r\nJika Siska dari salah satu anggota kelas tersebut sudah ditunjuk sebagai bendahara,\r\nbanyak susunan pengurus OSIS yang mungkin dari kelas tersebut adalah....<br></p>', '3.654', '4.060', '21.924', '570.024', '657.720', 'C', '', ''),
(879, 25, 'A', 34, '<p>&nbsp; <img src="http://localhost/cbt/files/25_34_1.jpg" alt=""></p>', '  ', '  ', '  ', '  ', '  ', 'D', 'files/25_34_1.jpg', ''),
(880, 23, 'A', 31, '<p>Dua belas perwakilan kelas akan dipilih untuk tim bola\r\nVolly yang berjumlah 6 orang.\r\nDi antara siswa tersebut bertindak sebagai ketua tim dan telah ditetapkan sebagai pemain. Banyaknya formasi tim\r\nyang mungkin adalahâ€¦.<br><br></p>', '330', '340', '462', '792', '924', 'C', '', ''),
(881, 25, 'A', 35, '<p>&nbsp; &nbsp;&nbsp; <img src="http://localhost/cbt/files/25_35_1.jpg" alt=""></p>', '   ', '   ', '   ', '   ', '   ', 'A', 'files/25_35_1.jpg', ''),
(882, 23, 'A', 32, '<p>&nbsp; &nbsp;Dua dadu dilempar bersama-sama sebanyak 324 kali.\r\nBanyaknya harapan  muncul mata dadu yang\r\nberjumlah bilangan ganjil atau prima adalah.... kali</p>', '144', '162', '171', '216', '243', 'B', '', ''),
(883, 25, 'A', 36, '<p>&nbsp; <img src="http://localhost/cbt/files/25_36_1.jpg" alt=""></p>', '   ', '   ', '   ', '   ', '   ', 'E', 'files/25_36_1.jpg', ''),
(884, 23, 'A', 33, '<p>&nbsp;<img src="http://localhost/cbt/files/23_33_1.jpg" alt=""></p>', 'A', 'B', 'C', 'D', 'E', 'B', 'files/23_33_1.jpg', ''),
(885, 25, 'A', 37, '<p>&nbsp; <img src="http://localhost/cbt/files/25_37_1.jpg" alt=""></p>', '  ', '  ', '  ', '   ', '    ', 'D', 'files/25_37_1.jpg', ''),
(886, 25, 'A', 38, '<p>&nbsp; &nbsp; &nbsp; <img src="http://localhost/cbt/files/25_38_1.jpg" alt=""></p>', '   ', '   ', '    ', '   ', '    ', 'E', 'files/25_38_1.jpg', ''),
(887, 23, 'A', 34, '<p>&nbsp;<img src="http://localhost/cbt/files/23_34_1.jpg" alt=""></p>', 'A', 'B', 'C', 'D', 'E', 'D', 'files/23_34_1.jpg', ''),
(888, 25, 'A', 39, '<p>&nbsp;&nbsp; <img src="http://localhost/cbt/files/25_39_1.jpg" alt=""></p>', '   ', '   ', '   ', '   ', '   ', 'C', 'files/25_39_1.jpg', ''),
(889, 23, 'A', 35, '<p>&nbsp;<img src="http://localhost/cbt/files/23_35_1.jpg" alt=""></p>', 'A', 'B', 'C', 'D', 'E', 'C', 'files/23_35_1.jpg', ''),
(890, 25, 'A', 40, '<p>&nbsp; &nbsp; <img src="http://localhost/cbt/files/25_40_1.jpg" alt=""></p>', '  ', '   ', '   ', '   ', '    ', 'E', 'files/25_40_1.jpg', ''),
(891, 23, 'A', 36, '<p>Cermati tabel distribusi frekuensi berikut !Nilai Mean dari data tersebut adalah</p><p><img src="http://localhost/cbt/files/23_36_1.jpg" alt=""></p>', '62,85', '64,76', '64,86', '65,86', '65,96', 'E', 'files/23_36_1.jpg', ''),
(892, 23, 'A', 37, '<p>&nbsp; <img src="http://localhost/cbt/files/23_37_1.jpg" alt=""></p>', 'A', 'B', 'C', 'D', 'E', 'A', 'files/23_37_1.jpg', ''),
(893, 23, 'A', 38, '<p>&nbsp; <img src="http://localhost/cbt/files/23_38_1.jpg" alt=""></p>', 'A', 'B', 'C', 'D', 'E', 'D', 'files/23_38_1.jpg', ''),
(894, 23, 'A', 39, '<p>&nbsp;<img src="http://localhost/cbt/files/23_39_1.jpg" alt=""></p>', 'A', 'B', 'C', 'D', 'E', 'C', 'files/23_39_1.jpg', ''),
(895, 24, 'A', 1, '<p><img src="http://localhost/cbt/files/24_1_1.jpg" alt=""></p>', 'A', 'B', 'C', 'D', 'E', 'B', 'files/24_1_1.jpg', ''),
(896, 24, 'A', 2, '<img src="http://localhost/cbt/files/24_2_1.jpg" alt="">', 'A', 'B', 'C', 'D', 'E', 'D', 'files/24_2_1.jpg', ''),
(897, 24, 'A', 3, '<img src="http://localhost/cbt/files/24_3_1.jpg" alt="">', 'A', 'B', 'C', 'D', 'E', 'E', 'files/24_3_1.jpg', ''),
(898, 24, 'A', 4, '<img src="http://localhost/cbt/files/24_4_1.jpg" alt="">', 'A', 'B', 'C', 'D', 'E', 'D', 'files/24_4_1.jpg', ''),
(899, 24, 'A', 5, '<img src="http://localhost/cbt/files/24_5_1.jpg" alt="">', 'A', 'B', 'C', 'D', 'E', 'C', 'files/24_5_1.jpg', ''),
(900, 24, 'A', 6, '<img src="http://localhost/cbt/files/24_6_1.jpg" alt="">', 'A', 'B', 'C', 'D', 'E', 'A', 'files/24_6_1.jpg', ''),
(901, 24, 'A', 7, '<img src="http://localhost/cbt/files/24_7_1.jpg" alt="">', 'A', 'B', 'C', 'D', 'E', 'A', 'files/24_7_1.jpg', ''),
(902, 24, 'A', 8, '<img src="http://localhost/cbt/files/24_8_1.jpg" alt="">', 'A', 'B', 'C', 'D', 'E', 'E', 'files/24_8_1.jpg', ''),
(903, 24, 'A', 9, '<img src="http://localhost/cbt/files/24_9_1.jpg" alt="">', 'A', 'B', 'C', 'D', 'E', 'D', 'files/24_9_1.jpg', ''),
(904, 24, 'A', 10, '<img src="http://localhost/cbt/files/24_10_1.jpg" alt="">', 'A', 'B', 'C', 'D', 'E', 'D', 'files/24_10_1.jpg', ''),
(905, 24, 'A', 11, '<img src="http://localhost/cbt/files/24_11_1.jpg" alt="">', 'A', 'B', 'C', 'D', 'E', 'D', 'files/24_11_1.jpg', ''),
(906, 24, 'A', 12, 'Rima membeli 5 buku dan 3 pensil seharga Rp22.500,00. Pada toko yang sama, Richa membeli 6 buku dan 3 pensil seharga Rp25.500,00. JikaRizkamembelisebuahbuku dan 2 pensil, makauang yang harus dibayarkan adalah â€¦.', 'Rp2.500,00', 'Rp3.000,00', 'Rp5.500,00', ' Rp8.000,00', 'Rp8.500,00', 'D', '', ''),
(907, 24, 'A', 13, '<img src="http://localhost/cbt/files/24_13_1.jpg" alt="">', 'A', 'B', 'C', 'D', 'E', 'A', 'files/24_13_1.jpg', ''),
(908, 24, 'A', 14, '<img src="http://localhost/cbt/files/24_14_1.jpg" alt="">', 'A', 'B', 'C', 'D', 'E', 'C', 'files/24_14_1.jpg', ''),
(909, 24, 'A', 15, '<img src="http://localhost/cbt/files/24_15_1.jpg" alt="">', 'A', 'B', 'C', 'D', 'E', 'D', 'files/24_15_1.jpg', ''),
(910, 24, 'A', 16, '<img src="http://localhost/cbt/files/24_16_1.jpg" alt="">', 'A', 'B', 'C', 'D', 'E', 'D', 'files/24_16_1.jpg', ''),
(911, 24, 'A', 17, 'Sebuahperusahaanmebelakanmemproduksimejadankursidarikayu. Untukmembuatsebuahmejadiperlukan 4 lembarpapankayu, sedangkanuntukmembuatkursimemerlukan 2 lembarpapan. BiayauntukmembuatsebuahmejaRp. 120.000,00 dankursiRp. 40.000,00. Perusahaan ituhanyamemilikibahan 32 kepingpapandanbiayaproduksi yang dikeluarkantidaklebihdariRp. 720.000,00. JikakeuntungansetiapmejaadalahRp. 100.000,00 dankursiRp. 50.000,00. Pendapatanmaksimumperusahaanmebeltersebutadalah ....', 'Rp.  400.000,00', 'Rp.  500.000,00', 'Rp.  800.000,00', 'Rp 1.000.000,00', 'Rp. 1.200.000,00', 'C', '', ''),
(912, 24, 'A', 18, '<img src="http://localhost/cbt/files/24_18_1.jpg" alt="">', 'A', 'B', 'C', 'D', 'E', 'C', 'files/24_18_1.jpg', ''),
(913, 24, 'A', 19, 'Diketahui jumlah suku ke-3 dan ke-8 barisan aritmatika adalah 76, sedangkan suku ke-6 dikurangi suku ke-2 adalah 16. Suku ke-15 barisan itu adalah ....', '4', '20', '40', '56', '76', 'E', '', ''),
(914, 24, 'A', 20, '<img src="http://localhost/cbt/files/24_20_1.jpg" alt="">', 'A', 'B', 'C', 'D', 'E', 'C', 'files/24_20_1.jpg', ''),
(915, 24, 'A', 21, 'Seorang anak menabung untuk membeli sepeda idolanya. Jika pada bulan keâ€“3 menabung Rp14.000,00  dan setiap bulan dengan kenaikan Rp2.000,00 dari bulan sebelumnya. Pada akhir tahun keâ€“2 jumlah tabungan anak tersebut adalah â€¦', 'Rp 824.000,00', 'Rp 792.000,00', 'Rp 664.000,00', 'Rp 512.000,00', 'Rp 424.000,00', 'B', '', ''),
(916, 24, 'A', 22, 'Suatu deret geometri tak hingga mempunyai rasio Â½ dan jumlah semua sukunya adalah 10 .Suku pertama deret tersebut adalahâ€¦.', '25', '15', '10', '5', '5/2', 'D', '', ''),
(917, 24, 'A', 23, '<img src="http://localhost/cbt/files/24_23_1.jpg" alt="">', 'A', 'B', 'C', 'D', 'E', 'C', 'files/24_23_1.jpg', ''),
(918, 24, 'A', 24, 'Sebuah marka kejut dipasang melintang pada sebuah jalan dengan sudut 30Â° seperti ditunjukkan gambar berikut. jika panjang marka kejut adalah 8 meter lebar jalan tersebut adalahâ€¦..<br>', '2M', '3M', '4M', '5M', '6M', 'C', '', 'files/24_24_2.jpg'),
(919, 24, 'A', 25, 'Perhatikan gambar..<br><img src="http://localhost/cbt/files/24_25_1.jpg" alt=""><br>', 'A', 'B', 'C', 'D', 'E', 'E', 'files/24_25_1.jpg', ''),
(920, 24, 'A', 26, '<img src="http://localhost/cbt/files/24_26_1.jpg" alt="">', 'A', 'B', 'C', 'D', 'E', 'B', 'files/24_26_1.jpg', ''),
(921, 24, 'A', 27, '<img src="http://localhost/cbt/files/24_27_1.jpg" alt="">', 'A', 'B', 'C', 'D', 'E', 'A', 'files/24_27_1.jpg', ''),
(922, 24, 'A', 28, '<img src="http://localhost/cbt/files/24_28_1.jpg" alt="">', 'A', 'B', 'C', 'D', 'E', 'A', 'files/24_28_1.jpg', ''),
(923, 24, 'A', 29, '<img src="http://localhost/cbt/files/24_29_1.jpg" alt="">', 'A', 'B', 'C', 'D', 'E', 'E', 'files/24_29_1.jpg', ''),
(924, 24, 'A', 30, '<img src="http://localhost/cbt/files/24_30_1.jpg" alt="">', 'A', 'B', 'C', 'D', 'E', 'E', 'files/24_30_1.jpg', ''),
(925, 24, 'A', 31, 'Pengamatan yang dilakukan terhadap sebagian dari anggota suatu objek penyelidikan disebut....<br><br>', 'Observasi', 'Interview', 'Koleksi', 'Populasi', 'Sampel', 'A', '', ''),
(926, 24, 'A', 32, '<img src="http://localhost/cbt/files/24_32_1.jpg" alt="">', 'A', 'B', 'C', 'D', 'E', 'C', 'files/24_32_1.jpg', ''),
(927, 24, 'A', 33, '<img src="http://localhost/cbt/files/24_33_1.jpg" alt="">', 'A', 'B', 'C', 'D', 'E', 'B', 'files/24_33_1.jpg', ''),
(928, 24, 'A', 34, '<img src="http://localhost/cbt/files/24_34_1.jpg" alt="">', 'A', 'B', 'C', 'D', 'E', 'E', 'files/24_34_1.jpg', ''),
(929, 24, 'A', 35, '<img src="http://localhost/cbt/files/24_35_1.jpg" alt="">', 'A', 'B', 'C', 'D', 'E', 'B', 'files/24_35_1.jpg', ''),
(930, 24, 'A', 36, '<img src="http://localhost/cbt/files/24_36_1.jpg" alt="">', '3', '4', '5', '6', '7', 'D', 'files/24_36_1.jpg', ''),
(931, 24, 'A', 37, 'Nilai tertinggi ulangan harian matematika adalah 92 dan jika jangkauannya 54, maka nila iterendah adalah ....<br><br><br>', '36', '38', '40', '52', '54', 'B', '', ''),
(932, 24, 'A', 38, 'Jika banyaknya data 100, maka menurut aturan sturges dapat dibuat distribusi frekuensi dengan banyaknya kelas adalah ....<br><br>', '8', '9', '10', '11', '12', 'A', '', ''),
(933, 24, 'A', 39, 'Jangkauan antar kuartil dari sekelompok data 16, 7, 10, 14, 9, 14, 11, 12, 9, 12 adalah...<br><br>', '10', '8', '7', '6', '5', 'E', '', ''),
(934, 24, 'A', 40, '<img src="http://localhost/cbt/files/24_40_1.jpg" alt="">', 'A', 'B', 'C', 'D', 'E', 'A', 'files/24_40_1.jpg', ''),
(935, 21, 'A', 1, '<p><b>Bacalah Paragraph Berikut&nbsp;</b></p><p>Betul\r\nbahwa pendidikan formal memberikan banyak manfaat kepada para calon pemimpin\r\natau calon orang terkemuka. Akan tetapi, pelajaran yang mereka peroleh dari\r\npendidikan formal tidak selalu dapat diterapkan di masyarakat tempat mereka\r\nmenjadi pemimpin atau menjadi orang terkenal di kemudian hari. Kenyataan bahwa\r\nbaik di sekolah mapun di perguruan tinggi, orang hanya â€œmempelajariâ€ teori,\r\nsedangkan di masyarakat, orang betul-betul belajar untuk hidup melalui beraneka\r\nragam pengalaman. Pengalaman semacam inilah yang menghasilkan orang-orang terkemuka\r\ntermasuk pemimpin sosial dan politik. Orang-orang termuka dan pemimpin itu\r\nlahir dari hal-hal yang mereka pelajari di masyaraka<br></p><p></p><p><b>Ide pokok teks tersebut adalah â€¦.</b></p><br><p></p>', 'Pendidikan formal memberikan banyak manfaat kepada para calon pemimpin atau calon orang termuka', 'Pengalaman hidup seorang pemimpin adalah satu-satunya syarat kesuksesan calon pemimpin', 'Pendidikan formal diperlukan oleh para calon pemimpin meskipun bukan satu-satunya jaminan', 'Orang-orang termuka dan pemimpin iru lahir dari hal-hal yang mereka pelajari di masyarakat.', 'Pelajaran yang diperoleh dari pendidikam formal tidak selalu dapat diterapkan di masyarakat', 'A', '', ''),
(936, 21, 'A', 2, '<p></p><p><b>1. &nbsp; &nbsp;  </b><b>Cermati\r\nteks anekdot berikut dengan saksama!</b></p>\r\n\r\n\r\n \r\n  \r\n  <p>Dari perempatan tadi, kami berkoar-koar tentang apa\r\n  saja. Giliran ceritaku didengar, aku menyatakan kekagumanku soal\r\n  hormat-menghormat di kalangan bapak-bapak tentara. Mereka ketika berpapasan,\r\n  yang satu tegap menghormat, yang lain dari depan sigap membalas. Wah, keren\r\n  habis dan berwibawa.</p>\r\n  <p>Sambil bercerita, aku coba\r\n  menggambarkan contohnya seperti apa. Teman-temanku berdecak kagum dengan\r\n  ceritaku, terlebih merasakan bagaimana caraku memberi hormat. â€œKalian tahu\r\n  tidak, ketika yang pangkat muda bertemu dengan atasannya, di mana dan kapan\r\n  saja, dia cepat mengambil sikap sempurna sambil menyentakkan tangan kanan ke\r\n  atas menyentuh pelipis. â€œNih, seperti ini, ciiaaa!â€ tanganku gesit melakukan serangkaian\r\n  gerak hormat kanan. â€œNah, seperti itu! Gagah, bukan?â€</p>\r\n  <p>â€œHaaa!â€ temanku memekik\r\n  tertahan. Aku terkejut sekali. â€œHei, tadi kamu tidak lihat Fajar?â€ suaranya\r\n  berdecak. â€œLihat apa?â€ sergah temanku dari belakang. â€œTentara itu, yang tadi\r\n  naik motor cepat melintasi kita ke belakang. Tahu apa yang barusan dia\r\n  lakukan?â€ aku jadi deg-degan. â€œHeh, dia membalas penghormatanmu tadi!â€ â€œApa?â€\r\n  wajahku pucat.</p>\r\n  \r\n \r\n\r\n\r\n<p>Isi yang dibicarakan dalam kutipan teks anekdot tersebut adalah â€¦.</p>\r\n\r\n\r\n\r\n\r\n\r\n<br><p></p>', 'Kebiasaan yang sudah berlaku di kalangan tentara untuk saling memberi hormat jika mereka berpapasan di mana pun berada', 'Fajar yang bercerita kepada kawan-kawannya tentang kebiasaan tentara yang lebih rendah pangkatnya akan memberi hormat kepada atasannya jika berpapasan di jalan', 'Tingkah Fajar yang lucu saat memberika contoh cara memberikan hormat seorang tentara kepada atasannya saat berpapasan', 'Kawan-kawan Fajar yang terkesan akan kebiasaan seorang tentara yang menghormati atasannya jika bertemu di jalan dengan memberi hormat', 'Seorang tentara yang membalas hormat Fajar saat dia bercerita kepada teman-temannya tentang kebiasaan tentara yang memberi hormat kepada atasannya jika berpapasan', 'A', '', ''),
(937, 22, 'A', 8, '<p>What is the woman doing?<br><br><br></p>', 'Washing the car', 'Watering the garden', 'Doing some tasks', 'Going to the park', '   ', 'B', 'files/22_8_1.mp3', ''),
(938, 21, 'A', 3, '<p></p><p><b>Bacalah\r\nkutipan teks berita berikut dengan saksama!</b></p>\r\n\r\n\r\n \r\n  \r\n  <p>Organisasi <i>Centre for International\r\n  Forestry Research </i>(CIFOR) berpendapat bahwa kabut asap yang terjadi di\r\n  Indonesia merupakan tragedi, bukan bencana alam. Kabut asap bukan bencana\r\n  alam, melainkan karena kesalahan manusia dan tidak terjadi secara alamiah.</p>\r\n  \r\n \r\n\r\n\r\nMakna istilah <i>tragedi</i>\r\n&nbsp;dalam kutipan teks berita tersebut\r\nadalah&nbsp;&nbsp;<br><p></p>', 'peristiwa menggemparkan', 'perubahan drastic', 'keadaan genting', 'peristiwa menyedihkan', 'peristiwa mengejutkan', 'D', '', ''),
(939, 22, 'A', 9, '<p>According to the man, who is the handsome man?<br>&nbsp;<br><br></p>', ' Chicco Jerikho', ' The man', 'Both of them', 'None of them', '   ', 'B', 'files/22_9_1.mp3', ''),
(940, 22, 'A', 10, '<p>To whom is the woman talking?<br><br><br></p>', 'A new student', ' A new teacher', ' A waiter', ' A maid', '       ', 'A', 'files/22_10_1.mp3', ''),
(941, 22, 'A', 11, '<p>What does the woman imply?<br>&nbsp;<br></p>', 'She has some spare time in the afternoon', 'She doesnâ€™t have any spare time in the afternoon', 'She will go with the man in the afternoon', 'She asked the man to go with her\r\n', '     ', 'B', 'files/22_11_1.mp3', ''),
(942, 21, 'A', 4, '<p></p><p><b>Bacalah\r\nkutipan teks anekdot berikut!  </b></p>\r\n\r\n\r\n \r\n  \r\n  <p>Jono pergi ke sebuah supermarket untuk membeli perlengkapan rumah tangga\r\n  dengan menaiki sepeda motor. Pada saat tiba di halaman supermarket tersebut,\r\n  terlihat olehnya tulisan besar â€œBEBAS PARKIRâ€. â€œWah enak nih,â€ pikirnya.\r\n  Selesai membeli berbagai keperluan yang dibutuhkan dan membayarnya, dia kemudian\r\n  pulang. Di halaman parkir supermarket itu, dia langsung menaiki motornya dan\r\n  menyalakannya. Pada saat dia akan menjalankan sepeda motornya, tiba-tiba si\r\n  tukang parkir berteriak, â€œMas, uang parkirnya mana?â€. Merasa heran, Jono\r\n  tersebut balik bertanya, â€œ<i>Lho</i> Pak,\r\n  kan di sini bebas parkir, berarti tidak perlu bayar dong?â€ Si tukang parkir\r\n  balik menjawab, â€œ<i>Lho</i> memang betul\r\n  Mas di sini bebas parkir. Anda bisa parkir di sana, di sini, di depan sana,\r\n  di sebelah kanan, kiri, terserah bebas <i>kok</i>.\r\n  Cuma kalau pulang tetap harus bayar.â€<i>&nbsp;</i></p><p>Interpretasi\r\nkutipan teks anekdot tersebut adalah â€¦.</p><p></p>', 'bebas parkir berarti boleh parkir di mana saja, tetapi tetap membayar', 'bebas parkir berarti kita boleh memarkirkan kendaraan kita di mana saja', 'diperkenankan untuk memarkirkan kendaraan di mana saja di seluruh area parkir', 'walaupun boleh memarkirkan kendaraan di mana saja, tetapi tetap mengikuti peraturan', 'kesadaran pemilik kendaraan untuk memarkirkan kendaraan di tempat yang ditentukan', 'A', '', ''),
(943, 22, 'A', 12, '<p><br>&nbsp;What is being exhibited at the national art gallery?<br><br></p>', ' Mr Johnâ€™s painter', 'Mr Johnâ€™s painting collection', 'Mr Johnâ€™s lunch menu', 'Mr John feels a sharp paint', '    ', 'B', 'files/22_12_1.mp3', ''),
(944, 21, 'A', 5, '<p></p><p><b>Bacalah kutipan\r\nteks eksposisi berikut!</b></p>\r\n\r\n\r\n \r\n  \r\n  <p>Aktivitas kegiatan usaha hulu minyak dan gas bumi\r\n  dimulai dari eksplorasi untuk menemukan cadangan migas yang dinilai cukup\r\n  komersial. [â€¦.] Sebelum kegiatan eksploitasi dimulai, kontraktor kontrak\r\n  kerja sama lebih dahulu membangun fasilitas dan infrastruktur yang dibutuhkan\r\n  untuk memproduksi migas hingga menyalurkan ke <i>off-teker </i>(pembeli minyak mentah atau gas bumi mentah).</p>\r\n  \r\n \r\n\r\n\r\n<p>&nbsp; &nbsp; &nbsp;\r\nKalimat yang tepat\r\nuntuk mengisi bagian rumpang pada teks tersebut adalah ...</p><p></p>', 'Selanjutkan kontraktor melakukan eksplorasi', 'Setelah itu berlanjut ke kegiatan eksploitasi.', 'Kontraktor  bertanggung  jawab dalam kegiatan eksplorasi', 'Oleh karena itu, kontraktor tidak boleh uji coba untuk eksploitasi.', 'Eksploitasi dilakukan setelah kegiatan eksplorasi selesai dilaksanakan.', 'B', '', ''),
(945, 22, 'A', 13, '<p><br>&nbsp;What are the vistors encouraged  to to ?<br><br><br></p>', 'To come to the exhibition', ' To come after lunch time', 'To display their own paintings', 'To come for free', '      ', 'C', 'files/22_13_1.mp3', ''),
(946, 21, 'A', 6, '<p></p><p><b>Bacalah\r\nkutipan teks eksposisi berikut dengan saksama!</b></p>\r\n\r\n\r\n \r\n  \r\n  <p>Kita tidak dapat memungkiri kenyataan \r\n  bahwa teknologi berkembang dengan pesatnya. Hal ini ditandai dengan\r\n  banyaknya barang elektronik yang beredar di masyarakat. Pemunculan barang tersebut\r\n  sudah sampai di kalangan masyarakat menengah ke bawah. Ada yang dikategorikan\r\n  barang mewah dan ada pula yang dikategorikan bukan barang mewah.</p>\r\n  \r\n \r\n\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; Simpulan teks eksposisi tersebut adalah\r\nâ€¦</p><p></p>', 'Teknologi canggih perlu dimiliki oleh masyarakat luas', 'Keistimewaan alat itu sangat mencengangkan.', 'Teknlogi berkembang sangat pesat.', 'Sudah muncul lagi barang merek baru.', 'Barang produksi Indonesia memang berat bersaing.', 'C', '', ''),
(947, 22, 'A', 14, '<p>&nbsp;What process did the speaker describe?<br>&nbsp; <br><br></p>', ' How to stir the eggs', ' How to melt sugar', ' How to choose good eggs', 'How to make a simple dessert', '        ', 'D', 'files/22_14_1.mp3', ''),
(948, 21, 'A', 7, '<p></p><p><b>Bacalah\r\nteks anekdot berikut ini!</b></p>\r\n\r\n\r\n \r\n  \r\n  <p>Teks 1:</p>\r\n  <p>Di suatu kelas saat pendampingan\r\n  penjurusan oleh wali kelas.</p>\r\n  <p>â€œAnak-anak, kau harus pilih\r\n  jurusan yang sesuai dengan cita-citamu?â€ kata wali kelas dengan semangat.</p>\r\n  <p>â€œMasa depanmu masih panjang,\r\n  keberhasilanmu ditentukan oleh pilihanmu hari ini, apa kau ingin mengambil\r\n  jurusan IPA atau IPS.â€</p>\r\n  <p>â€œBu, saya bingung menentukan\r\n  pilihan. Sebenarnya saya ingin jurusan IPA tetapi saya senang IPS. IPS lebih\r\n  praktis daripada IPA. Contohnya, kalau ada kelapa jatuh di pelajaran IPA\r\n  dihitung kecepatannya. Tapi kalau pelajaran di jurusan IPS, kelapa yang jatuh\r\n  diambil dan dijual.â€</p>\r\n  <p>Seisi kelas tertawa memecahkan\r\n  keseriusan guru dan siswa saat penjurusan</p>\r\n  <p>&nbsp;</p>\r\n  <p>Teks 2:</p>\r\n  <p>Di gubuk pinggir sawah, ada\r\n  seorang anak kecil dan bapaknya sedang menunggui padi dari serangan burung.</p>\r\n  <p>Anak  &nbsp;:\r\n  Pak, kenapa burung tidak boleh makan padi kita?</p>\r\n  <p>Bapak : Kalau dimakan burung,\r\n  nanti kita tidak bisa makan.</p>\r\n  <p>Anak  &nbsp;: Kalau\r\n  tidak boleh makan padi, nanti burung makan apa, makan batu, Pak ?</p>\r\n  \r\n \r\n\r\n\r\n<p>&nbsp; &nbsp; \r\n&nbsp; Perbedaan bentuk kedua teks di atas\r\nadalahâ€¦</p><p></p>', 'Teks 1 berbentuk panjang dan teks 2 berbentuk pendek.', 'Teks 1 berbentuk drama dan teks 2 berbentuk wawancara.', 'Teks 1 berbentuk cerita dan teks 2 berbentuk drama.', 'Teks 1 berbentuk monolog dan teks 2 berbentuk cerita.', 'Teks 1 berbentuk dialog dan teks 2 berbentuk drama.', 'C', '', ''),
(949, 22, 'A', 15, '<p>What is the last step of making the pudding?<br><br></p>', 'Mixing the ingredients', ' Steaming the mixture', 'Melting some sugar', 'Pouring the milk', '          ', 'B', 'files/22_15_1.mp3', ''),
(950, 22, 'A', 16, '<p>&nbsp;Elena : Iâ€™ve read your novel . . . . will you publish another one?<br>&nbsp;Mary  : My next novel will be published in the next three months<br><br><br></p>', 'How excellent the writing is!', ' How nice her voice is!  ', 'What a beautiful hand writing!', 'How amazing the color printing', '        ', 'A', '', ''),
(951, 22, 'A', 17, '<p>&nbsp;James &nbsp; : Do you think massive rapid transportation (MRT) will attract public to use <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; public transportation?<br>Ann  :â€¦â€¦ because public would prefer using well-run public transportation than being stuck in their cars in traffic jam.<br><br><br></p>', ' I believe it will not attract public to use it ', ' Iâ€™m sure it will attract public', ' I donâ€™t think it useful', ' It will be useless', '   ', 'B', '', ''),
(952, 21, 'A', 50, '<p>Bacalah teks editorial berikut dengan saksama!<br></p><p>(1) Pendidikan yang dulu diperjuangkan mati-matian oleh para pejuang kemerdekaan agar seluruh rakyat mendapatkan hak yang sama, ternyata masih milik segolongan orang tertentu. (2) Setiap tahun ajaran baru selalu muncul keganjilan berulang-ulang yakni kebingungan orang tua mencari sekolah untuk anaknya. (3) Ternyata keganjilan itu muncul karena masalah lama belum tuntas.(4) Standardisasi sekolah masih belum jelas sehingga menimbulkan kasta-kasta dalam pendidikan. (5) Sistem kasta tersebut membuat para orang tua berlomba-lomba untuk mendapatkan sekolah berkasta tinggi.<br></p><p>Opini penulis pada teks tersebut terdapat pada kalimat bernomor .... <br></p>', '(1)', '(2)', '(3)', '(4)', '(5)', 'A', '', ''),
(953, 22, 'A', 18, '<p>&nbsp;&nbsp; Front Office:MahaDewi Garden resto. Can I help you? &nbsp; Caller  : . . . . .<br><br></p>', ' Could I book 2 suite rooms, please?', 'Could I make a reservation to Bali this weekend, please?', 'Could you give me a glass of water, please?', ' Can I reserve two tables?\r\n', '        ', 'D', '', ''),
(954, 22, 'A', 19, '<p>Mark  :  Are you ready for taking the examination?<br>Lucy  : Yes, of courseâ€¦â€¦â€¦â€¦<br><br></p>', ' I have gift from my father', ' I have slept tightly', ' I have studied hard for two weeks', ' I have changed the schedule', '     ', 'C', '', ''),
(955, 22, 'A', 20, '<p>&nbsp;Danny  : It is a good idea that the government prohibit smoking in public places<br>&nbsp;Pandu: . . . Itâ€™s awful sitting next to someone smoking<br>&nbsp;<br><br></p>', ' I disagree', ' I canâ€™t say so', 'I couldnâ€™t agree more', 'Probably no', '          ', 'C', '', ''),
(956, 22, 'A', 21, '<p>Harry  :My friend said that Bali is beautiful, is that true?<br>Ron  : Yes, â€¦â€¦..<br><br><br><br></p>', ' It is always visited by tourists', ' It is admired by Indonesians only', ' It is always stricken by disaster', ' It is always rumoured bad by visitor', '     ', 'A', '', ''),
(957, 22, 'A', 22, '<p>Andre : . . . . since she lost her phone.<br>Janeth: really? Where did she lose it?<br>Andre: at the station.<br><br></p>', ' My sister is going to go to dentist', 'My sister is going to buy a new phone', 'My sister will tell my mother', 'My sister will take some rest', '       ', 'B', '', ''),
(958, 22, 'A', 23, '<p>Bella :  I came to your house last night but you didnâ€™t come out, what were you doing?<br>Jack : oh sorryâ€¦â€¦.. I was doing the project at Edwardâ€™s house<br><br></p>', ' I helped my sister with her home work', ' I slept in my room', ' I wasnâ€™t at home ', ' I went out with my friend.', '     ', 'C', '', ''),
(959, 22, 'A', 24, '<p>Edward  : Puncak is a nice place to spare our time. Would you like to go there?<br>Bella  &nbsp; : Itâ€™s good idea, but you know if itâ€™s a long holiday there so<b> traffic</b> to getthere.<br>Edward  : Yes, you are right. So where we can go?<br>Bella  : How if we go to Pangandaran beach?Ithink itâ€™s better. We can dosunbathing andenjoy the sunset.<br>Edward  &nbsp; : Ofcourse I prefer the Pangandaran beach to Puncak. Its sounds cool!Canâ€™t wait <br>&nbsp; tobe there!<br><br>&nbsp;What are Edward and Bella discussing?<br><br></p><br>', 'They are discussing about spare the time', 'They are discussing about long holiday', 'They are discussing about Puncak', ' They are discussing about pangandaran beach ', '      ', 'A', '', ''),
(960, 21, 'A', 49, '<p>Kesadaran menjaga alam dan mengembangkan potensi wisata justru datang dari operator wisata. Di Togean, seorang pemilik resor harus membayar nelayan secara berkala agar mereka tidak memburu ikan dengan bom. Ia berupaya menyadarkan masyarakat tentang arti penting keindahan alam di halaman rumah mereka. Di Hulu Bahau, Kalimantan Utara, seorang ketua adat besar berhasil menyadarkan masyarakat untuk menjaga hutan.<br></p><p>Isi teks opini/editorial tersebut adalah...<br></p>', 'Tokoh masyarakat yang penuh perhatian terhadap lingkungan sekitarnya.', 'Nelayan yang memiliki kesadaran untuk tetap menjaga keberadaan terumbu karang.', 'Kepedulian pemandu wisata untuk senantiasa menjaga dan mengembangkan kekayaan wisata.', 'Tanggung jawab seorang pengusaha untuk memperhatikan kesejahteraan karyawannya.', 'Setiap pribadi hendaknya memiliki kesadaran untuk melestarikan dan mengembangkan potensi alam.', 'C', '', ''),
(961, 22, 'A', 25, '<p>Edward  : Puncak is a nice place to spare our time. Would you like to go there?<br>Bella  &nbsp; : Itâ€™s good idea, but you know if itâ€™s a long holiday there so<b> traffic</b> to getthere.<br>Edward  : Yes, you are right. So where we can go?<br>Bella  : How if we go to Pangandaran beach?Ithink itâ€™s better. We can dosunbathing andenjoy the sunset.<br>Edward  &nbsp; : Ofcourse I prefer the Pangandaran beach to Puncak. Its sounds cool!Canâ€™t wait <br>&nbsp; tobe there!</p><p>.  What is Edwardâ€™s preference for their holidayâ€™s plan?<br>.  <br><br></p><br><p></p>', ' He chooses to stay at home rather than go to Pangandaran.', 'He doesnâ€™t prepare to Pangandaran beach before goes to Puncak.', ' He will go to Pangandaran beach to Puncak.', 'He does not choose one of those places.\r\n', '    ', 'C', '', ''),
(962, 22, 'A', 26, '<p>Edward  : Puncak is a nice place to spare our time. Would you like to go there?<br>Bella  &nbsp; : Itâ€™s good idea, but you know if itâ€™s a long holiday there so<b> traffic</b> to getthere.<br>Edward  : Yes, you are right. So where we can go?<br>Bella  : How if we go to Pangandaran beach?Ithink itâ€™s better. We can dosunbathing andenjoy the sunset.<br>Edward  &nbsp; : Ofcourse I prefer the Pangandaran beach to Puncak. Its sounds cool!Canâ€™t wait <br>&nbsp; tobe there!</p><p>The word â€œtrafficâ€ in the second dialogue has the closet meaning with?<br><br><br><br></p>', ' Trip ', ' Road ', ' Jam', 'Compact', '   ', 'C', '', ''),
(963, 22, 'A', 27, '<p>Bayu  : Hey, sya. Will you go to swimming pool with me?<br>Tasya  : When will you go?<br>Bayu  : On Saturday.<br>Tasya  : Iâ€™m sorry I canâ€™t. I often go to swimming pool on Sunday. My mother <br>seldom allows me to go out except on Sunday. <br>Bayu  : I often swim on Saturday. Because I think, it will be crowded on Sunday. <br>Perhaps, some day we can go there together.<br>Tasya  : Yes, after my mom changes her rule.<br>Bayu  : Hahahaâ€¦ You are right. Alternatively, perhaps, we can be there if I change <br>my mind to go there on Sunday.<br>Tasya &nbsp; : I think so<br><br>&nbsp; What is the dialogue about?<br><br><br></p>', 'Canâ€™t go out except to swimming pool', 'Canâ€™t go out except on Sunday', 'Go to swimming pool', 'The swimming pool ', '   ', 'C', '', ''),
(964, 21, 'A', 48, '<p>Penulisan daftar pustaka yang tepat berdasarkan data publikasi di atas adalah ...<br></p>', 'Hosseini, Khaled. 2008. The Kite Runner. Bandung: Qanita.', 'Hosseini, Khaled. The Kite Runner (Qanita: Bandung. 2008).', 'Khaled, Hosseini. 2008. The Kite Runner. Bandung: Qanita.', 'Hosseini, Khaled. The Kite Runner. Bandung: Qanita. 2008.', 'Khaled, Hosseini. 2008. The Kite Runner. Qanita: Bandung.', 'A', 'files/21_48_1.png', ''),
(965, 22, 'A', 28, '<p>Bayu  : Hey, sya. Will you go to swimming pool with me?<br>Tasya  : When will you go?<br>Bayu  : On Saturday.<br>Tasya  : Iâ€™m sorry I canâ€™t. I often go to swimming pool on Sunday. My mother <br>seldom allows me to go out except on Sunday. <br>Bayu  : I often swim on Saturday. Because I think, it will be crowded on Sunday. <br>Perhaps, some day we can go there together.<br>Tasya  : Yes, after my mom changes her rule.<br>Bayu  : Hahahaâ€¦ You are right. Alternatively, perhaps, we can be there if I change <br>my mind to go there on Sunday.<br>Tasya &nbsp; : I think so<br><br>&nbsp; What is Tasyaâ€™s activity on Sunday?<br>&nbsp;<br><br></p>', 'She never go to swimming pool', 'Usually, she go to swimming pool', 'She doesnâ€™t go to swimming pool ', 'She often go to swimming poolwith her mom', '       ', 'D', '', ''),
(966, 22, 'A', 29, '<p>Bayu  : Hey, sya. Will you go to swimming pool with me?<br>Tasya  : When will you go?<br>Bayu  : On Saturday.<br>Tasya  : Iâ€™m sorry I canâ€™t. I often go to swimming pool on Sunday. My mother <br>seldom allows me to go out except on Sunday. <br>Bayu  : I often swim on Saturday. Because I think, it will be crowded on Sunday. <br>Perhaps, some day we can go there together.<br>Tasya  : Yes, after my mom changes her rule.<br>Bayu  : Hahahaâ€¦ You are right. Alternatively, perhaps, we can be there if I change <br>my mind to go there on Sunday.<br>Tasya &nbsp; : I think so<br><br>&nbsp;The word â€œseldomâ€ in the fourth dialogue has closet meaning with?<br><br><br><br></p>', 'Rarely', ' Occasionally', 'Frequency', 'Often ', '      ', 'A', '', ''),
(967, 22, 'A', 30, '<p>Chris: Did you come to the concert last night?<br>Steve: Not at all. I was called by my business client to finish his tax report as soon as &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  possible.<br>Chris: Thatâ€™s too bad, man! That was so cool. The show was watched by more than 1000  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; eyes and the band successfully rocking the night!<br>Steve:  oh, really? Did you take any recordings or videos? I heard the tickets were even &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  sold so quickly.<br>Chris: Sure, letâ€™s come into the studio. There are some videos taken by my brother. Iâ€™ll &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; show you.<br></p><p>What is the dialogue about?<br><br><br></p>', 'The business client and his tax report', 'The need of a videotape and recordings in a concert', 'The process of a concert', 'The concert that was held last night', '      ', 'D', '', ''),
(968, 21, 'A', 47, '<p>Kata yang penulisannya tidak sesuai dengan ejaan adalahâ€¦.<br></p>', 'kreatifitas, produk, dari pada', 'kreatifitas, dari pada, handphone', 'kreatifitas, dari pada, cenderamata', 'produk, dari pada, cenderamata', 'produk, cenderamata, handphone', 'E', 'files/21_47_1.png', ''),
(969, 22, 'A', 31, 'Chris: Did you come to the concert last night?<br>Steve: Not at all. I was called by my business client to finish his tax report as soon as &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  possible.<br>Chris: Thatâ€™s too bad, man! That was so cool. The show was watched by more than 1000  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; eyes and the band successfully rocking the night!<br>Steve:  oh, really? Did you take any recordings or videos? I heard the tickets were even &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  sold so quickly.<br>Chris: Sure, letâ€™s come into the studio. There are some videos taken by my brother. Iâ€™ll &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; show you.<br><br>What does Steve feel about the concert?<br>&nbsp;<br><br>', 'He is amazed', ' He is busy', 'He is curious', 'He hope the tickets were sold', '     ', 'C', '', ''),
(970, 21, 'A', 46, '<p>&nbsp; Perhatikan gambar...</p>', '(1)', '(2)', '(3)', '(4)', '(5)', 'E', 'files/21_46_1.png', ''),
(971, 22, 'A', 32, '<p>Chris: Did you come to the concert last night?<br>Steve: Not at all. I was called by my business client to finish his tax report as soon as &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; possible.<br>Chris: Thatâ€™s too bad, man! That was so cool. The show was watched by more than 1000&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; eyes and the band successfully rocking the night!<br>Steve:  oh, really? Did you take any recordings or videos? I heard the tickets were even &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; sold so quickly.<br>Chris: Sure, letâ€™s come into the studio. There are some videos taken by my brother. Iâ€™ll &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; show you.</p><p><br>&nbsp;â€œletâ€™s come into the studio .....â€ (last exchange)<br>The synonym of the underlined word is.....<br><br><br><br></p>', 'Room', ' Atelier', 'Space', ' Lodge', '      ', 'B', '', ''),
(972, 21, 'A', 45, '<p>Pernyataan yang sesuai dengan tabel tersebut adalah â€¦<br></p>', 'Semua klub pernah mengalami seri.', 'Nilai Man United lebih tinggi daripada Man City.', 'Man United dan Chelsea tiga kali mengalami kekalahan.', 'Man City dan West Bromwich menang 8 kali.', 'Klub yang paling banyak memasukkan bola adalah Man United.', 'E', 'files/21_45_1.png', ''),
(973, 22, 'A', 33, '<p>Car or automobile is a vehicle mostly used to carry passengers. It usually has four wheels and an engine to run those wheels. Generally, car uses gasoline to run the engine. <br>The term automobile comes from the Greek word "auto" and the French word "mobile". It means that the car moves by itself, remembering at old time horse or cow was needed to pull a wagon. So a car does not need an external power to move.<br>Cars nowadays come in various sizes and shapes. However, they are used to carry passengers and also load some goods to be delivered. Minivan and city cars are used to carry people, meanwhile a pickup truck is used to loads builderâ€™s material. The more work a car do, the higher fuel it uses. Usually, a car for loading goods needs much more fuels than a car for loading regular passengers.<br>Not only on the size and shape, but also the difference between those cars usually lies on the engine. The heavier a car works, the more fuels it needs. Also, an engine is identified by the fuel it uses. A medium car usually uses gasoline to run the engine meanwhile big truck uses diesel fuel.<br>Fortunately, nowadays some alternative fuels have been invented and developed such as propane, natural gas, compressed air, and ethanol. In addition, some revolutionary researches create electric car. Thus it only needs chargeable batteries to run the car. It seems good for the future because it reduces the pollution from exhaust and saves more fossil fuels<br></p><p>By composing the text, the writer expects that the readers ...<br><br><br></p>', 'Are interested in using cars for transportation', 'Understand more about the development of carsâ€™ type and engine', 'Can modify their original form of car into their desired minivan', ' Find the alternative fuels of the car for different uses', '    ', 'B', '', '');
INSERT INTO `soal` (`id_soal`, `id_mapel`, `paket`, `nomor`, `soal`, `pilA`, `pilB`, `pilC`, `pilD`, `pilE`, `jawaban`, `file`, `file1`) VALUES
(974, 22, 'A', 34, '<p>Car or automobile is a vehicle mostly used to carry passengers. It usually has four wheels and an engine to run those wheels. Generally, car uses gasoline to run the engine. <br>The term automobile comes from the Greek word "auto" and the French word "mobile". It means that the car moves by itself, remembering at old time horse or cow was needed to pull a wagon. So a car does not need an external power to move.<br>Cars nowadays come in various sizes and shapes. However, they are used to carry passengers and also load some goods to be delivered. Minivan and city cars are used to carry people, meanwhile a pickup truck is used to loads builderâ€™s material. The more work a car do, the higher fuel it uses. Usually, a car for loading goods needs much more fuels than a car for loading regular passengers.<br>Not only on the size and shape, but also the difference between those cars usually lies on the engine. The heavier a car works, the more fuels it needs. Also, an engine is identified by the fuel it uses. A medium car usually uses gasoline to run the engine meanwhile big truck uses diesel fuel.<br>Fortunately, nowadays some alternative fuels have been invented and developed such as propane, natural gas, compressed air, and ethanol. In addition, some revolutionary researches create electric car. Thus it only needs chargeable batteries to run the car. It seems good for the future because it reduces the pollution from exhaust and saves more fossil fuels.<br></p><p>Cars nowadays come in various size and shapes that are used to ...<br><br><br></p>', 'Use diesel fuel', 'Carry out passengers', 'Minivan and city cars', 'Carry passengers and logistics', '    ', 'D', '', ''),
(975, 21, 'A', 44, '<p>Bacalah teks negosiasi berikut!</p><p><br>(1)  Satpol PP: â€œMaaf Pak, kami dtugaskan oleh pemerintah, akan menggusur wilayah ini.â€<br>(2)  Warga  &nbsp;  : â€œLoh kok, pemerintah tidak memberitahukan informasinya terlebih dahulu,<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; â€ƒâ€ƒbahwa wilayah ini akan digusur.â€<br>(3)  Satpol PP : â€œKami sudah mengirimkan surat peringatan sebulan yang lalu.â€<br>(4)  Warga  &nbsp; &nbsp; : â€œWah, kami belum menerima surat apa pun, Pak.â€<br>(5)  Satpol PP : â€œHari ini kami harus melakukan penggusuran.â€<br>(6)  Warga  &nbsp; &nbsp; : â€œTidak bisa begitu Pak, kami tidak mau karena belum menerima surat.â€<br>(7)  Satpol PP : â€œLalu, bagaimana kami akan menggusur?â€<br>(8)  Warga  &nbsp; &nbsp; : â€œSebaiknya pastikan surat itu sampai dulu ke tangan kami, seteah itu kami<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;â€ƒâ€ƒ&nbsp; &nbsp; &nbsp; &nbsp; akan berunding mengenai penggusuran ini.â€<br>(9)  Satpol PP : â€œJadi, kami harus menunggu?â€<br>(10)  Warga  &nbsp; &nbsp; : â€œIya Pak, kami juga menunggu surat itu. Setelah ada keputusan dari kami,<br>&nbsp; â€ƒâ€ƒ&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; baru satpol boleh kemari.â€<br>(11)  Satpol PP : â€œBaiklah kalau begitu.â€<br>(12)  Warga  &nbsp; &nbsp; : â€œTerima kasih, Pak.â€<br><br></p><p>Kalimat pembuka dalam teks negosiasi tersebut ditandai dengan nomor....<br><br></p>', '(1)', '(2)', '(3)', '(4)', '(5)', 'A', '', ''),
(976, 22, 'A', 35, '<p>Car or automobile is a vehicle mostly used to carry passengers. It usually has four wheels and an engine to run those wheels. Generally, car uses gasoline to run the engine. <br>The term automobile comes from the Greek word "auto" and the French word "mobile". It means that the car moves by itself, remembering at old time horse or cow was needed to pull a wagon. So a car does not need an external power to move.<br>Cars nowadays come in various sizes and shapes. However, they are used to carry passengers and also load some goods to be delivered. Minivan and city cars are used to carry people, meanwhile a pickup truck is used to loads builderâ€™s material. The more work a car do, the higher fuel it uses. Usually, a car for loading goods needs much more fuels than a car for loading regular passengers.<br>Not only on the size and shape, but also the difference between those cars usually lies on the engine. The heavier a car works, the more fuels it needs. Also, an engine is identified by the fuel it uses. A medium car usually uses gasoline to run the engine meanwhile big truck uses diesel fuel.<br>Fortunately, nowadays some alternative fuels have been invented and developed such as propane, natural gas, compressed air, and ethanol. In addition, some revolutionary researches create electric car. Thus it only needs chargeable batteries to run the car. It seems good for the future because it reduces the pollution from exhaust and saves more fossil fuels.<br></p><p>â€œit seems good for the future.....â€ (4th sentence, last paragraph)<br>The underlined word refers to ...<br><br><br></p>', 'Car', 'Chargeable battery', 'Electric car', 'Reduce the pollution', '    ', 'B', '', ''),
(977, 21, 'A', 43, '<p>Cermati teks berita  berikut!<br><br></p><p>Gempa bumi berkekuatan 7,8 skala richter mengguncang kawasan barat Provinsi Baluchistan. Gempa ini terjadi pada tanggal 24 September 2013. Pusat gempa berada di kedalaman 23 km, sekitar 233 km tenggara Dalbandin, Baluchistan. Bencana menyebabkan sedikitnya 515 orang tewas, 765 orang terluka, dan lebih dari 100.000 orang terlantar, sehingga menghancurkan sejumlah fasilitas umum  dan infrastruktur.<br><br></p><p>Penggunaan konjungsi pada teks tersebut yang tidak tepat adalahâ€¦<br><br></p>', 'Dan', 'Sehingga', 'Di', 'Pada', 'Dari', 'B', '', ''),
(978, 21, 'A', 8, '<p></p><p><b>Cermati gagasan utama dan gagasan penjelas teks eksposisi\r\nberikut!</b></p>\r\n\r\n\r\n \r\n  \r\n  <p>Gagasan Utama &nbsp; : &nbsp;Ekonomi\r\n  Indonesia akan melampaui negara maju</p>\r\n  <p>Gagasan Penjelas : &nbsp;(1) Kekuatan impor Indonesia</p>\r\n  <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  (2)\r\n  Kekuatan  ekspor Indonesia</p>\r\n  <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  (3)\r\n  Pertumbuhan ekonomi semakin maju</p>\r\n  <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  (4) Budaya\r\n  masyarakat yang konsumtif</p>\r\n  <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  (5) Tenaga\r\n  kerja yang profesional</p>\r\n  <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  (6)  Kesejahteraan rakyat yang semakin menurun<i></i></p>\r\n  \r\n \r\n\r\n\r\n<p>Gagasan penjelas yang tidak sesuai dengan gagasan utama\r\npada teks berikut ditandai dengan nomorâ€¦.</p>\r\n\r\n\r\n \r\n  \r\n  <p><br></p><p></p>', '(1), (4), (6)', '(1), (5), (6)', '(2), (3), (5)', '(2), (4), (6)', '(3), (4), (5)', 'A', '', ''),
(979, 21, 'A', 9, '<p></p><p><b>Bacalah\r\nkalimat-kalimat dalam teks cerita pendek berikut!</b></p>\r\n\r\n\r\n \r\n  \r\n  <p>(1)&nbsp; &nbsp; &nbsp;Orang itu tidak lain adalah Palar, laki-laki ahli waris tunggal kekayaan\r\n  ibu-bapaknya.</p>\r\n  <p>(2)&nbsp; &nbsp; &nbsp;Banun tidak lupa pada orang yang pertama kali menjulukinya Banun Kikir.</p>\r\n  <p>(3)&nbsp; &nbsp; &nbsp;Untuk sekebat sayur pun istri Palar harus berbelanja ke pasar.</p>\r\n  <p>(4)&nbsp; &nbsp; &nbsp;Namun, karena tak terbiasa berkubang lumpur sawah, Palar tak sanggup menjalankan lelaku orang tani.</p>\r\n  <p>(5)&nbsp; &nbsp; &nbsp;Pekarangan rumahnya gersang.  (<i>Damhuri Muhammad. Banun)</i>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;\r\n  </p>\r\n  \r\n \r\n\r\n\r\n<p>Urutan yang\r\ntepat teks cerita pendek tersebut adalah â€¦.</p><p></p>', '(2), (1), (4), (3), (5)', '(3), (4), (1), (2), (5)', '(3), (5), (1), (4), (2)', '(4), (1), (3), (5), (2)', '(4), (2), (3), (5), (1)', 'A', '', ''),
(980, 21, 'A', 10, '<p></p><p><b>Cermati\r\nparagraf dengan saksama!</b></p>\r\n\r\n\r\n \r\n  \r\n  <p>Sampah dapat dibedakan menjadi sampah\r\n  organik dan anorganik. Di satu sisi sampah organik dapat menjadi makanan bagi\r\n  ikan dan makhluk hidup lainnya, [â€¦] pada sisi lain, sampah juga dapat\r\n  mengurangi kadar oksigen dalam lingkungan perairan. Sampah anorganik dapat\r\n  mengurangi sinar matahari yang masuk ke lingkungan perairan. [â€¦], proses\r\n  esensial dalam ekosistem, seperti foto sintesis menjadi terganggu.</p>\r\n  \r\n \r\n\r\n\r\n<p>Konjungsi yang tepat untuk mengisi bagian rumpang teks\r\nlaporan hasil observasi tersebut adalah â€¦.</p><p></p>', 'dan, akibatnya', 'dan, sehingga', 'tetapi, akibatnya', 'namun, akibatnya', 'Tetapi , sebab', 'C', '', ''),
(981, 22, 'A', 36, '<p>1. Add your dirty clothes and detergent to the drum of the machine.<br>2.  Fill the drum with water at the temperature you require. Read the machineâ€™s &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; instructions&nbsp; first, because these will tell you how much water to add.<br>3.  Perform the â€˜Washâ€™ cycle â€“ bear in mind a large load will need more time to wash than a &nbsp; &nbsp; smaller one.<br>4.  Once the â€˜Washâ€™ cycle has finished, drain the dirty water using the hose. Refill the &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; drum&nbsp;&nbsp; with fresh water. Switch on the â€˜Rinseâ€™ cycle. <br>5.  After the â€˜Rinseâ€™ cycle your clothes should be completely clean. You now need to &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; get&nbsp; the clothes as dry as possible by spinning them. A fully automatic machine will do &nbsp; &nbsp; &nbsp;&nbsp; this for you, but if you have a semi-automatic machine, you now need to transfer your&nbsp; &nbsp;&nbsp;&nbsp; clothes from the washing drum into the other drum â€“ again, the size of the load will &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; determine how long you need to spin them for.<br>6.  With all types of machine, once the spin cycle is finished, you should remove the &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; clothes as soon as possible and hang them up to dry.</p><p>Who will most likely find this information useful?<br><br><br></p>', 'The washing machine', 'The housewives', 'The machine operators', 'The laundry', '    ', 'B', '', ''),
(982, 21, 'A', 11, '<p></p><p><b>Bacalah teks\r\nnegosiasi yang disusun secara acak berikut!</b></p>\r\n\r\n\r\n \r\n  \r\n  <p>(1) Dewi&nbsp;<b>:&nbsp;</b>Selamat datang. Ada yang bisa saya\r\n  bantu?</p><p><b></b></p>\r\n  \r\n \r\n \r\n  \r\n  <p>(2) Lena&nbsp;<b>:&nbsp;</b>Saya ingin pesan kue untuk Ibu saya\r\n  yang akan berulang tahun.</p><p><b></b></p>\r\n  \r\n \r\n \r\n  \r\n  <p>(3) Dewi&nbsp;<b>:&nbsp;</b>Wah kebetulan sekali, toko kami\r\n  sedang promo kue ulang tahun &nbsp;pada minggu ini.\r\n  Ini ada beberapa model dan beserta ukurannya.</p><p><b></b></p>\r\n  \r\n \r\n \r\n  \r\n  <p>(4) Lena&nbsp;<b>:&nbsp;</b>Boleh saya mencicipi rasanya agar\r\n  tahu apakah kue ini terlalu manis atau tidak? Ibu saya kurang menyukai kue\r\n  yang rasanya terlalu manis. Apakah jika dikurangi manisnya akan tetap enak\r\n  seperti ini?</p><p><b></b></p>\r\n  \r\n \r\n \r\n  \r\n  <p><b>(5)</b> Dewi&nbsp;<b>:&nbsp;</b>Bagaimana rasanya? Jika masih terlalu manis nanti akan\r\n  dikurangi gulanya. Saya jamin walaupun gulanya dikurangi rasa kuenya akan\r\n  tetap lezat, lembut, dan rasa gurihnya akan semakin terasa.</p><p><b></b></p>\r\n  \r\n \r\n \r\n  \r\n  <p><b>(6) </b>Lena&nbsp;<b>:&nbsp;</b>Baiklah saya pesan satu yang\r\n  ukurannya sedang. Jangan terlalu manis karena nanti Ibu saya akan kecewa jika\r\n  kue ulang tahunnya terasa manis sekali.</p><p><b></b></p>\r\n  \r\n \r\n\r\n\r\n<p>&nbsp; &nbsp; &nbsp;  Isi teks negosiasi tersebut yang tepat\r\nadalah â€¦</p><p></p>', 'Hadiah ulang tahun dari anak untuk ibunya.', 'Penjual kue yang mempromosikan jualannya.', 'Seseorang yang sangat perhatian kepada ibunya', 'Seorang ibu yang sangat menjaga kesehatannya.', 'Pesanan kue ulang tahun yang tidak terlalu manis untuk ibu.', 'E', '', ''),
(983, 21, 'A', 12, '<p></p><p><b>Cermatilah kalimat\r\nberikut!</b></p>\r\n\r\n\r\n \r\n  \r\n  <p>Fahri membakar semua sampah di belakang rumahnya bila ibunya sudah\r\n  menyuruhnya.</p>\r\n  \r\n \r\n\r\n\r\n<p>&nbsp;Inti kalimat tersebut adalah â€¦</p><p></p>', 'Fahri membakar semua sampah.', 'Membakar semua sampah.', 'Ibunya menyuruh Fahri membakar sampah.', 'Membakar sampah.', 'Sampah di belakang rumah Fahri.', 'D', '', ''),
(984, 21, 'A', 13, '<p></p><p><b>Bacalah  kutipan teks cerita pendek berikut!</b></p>\r\n\r\n\r\n \r\n  \r\n  <p>Sebelum guruku meninggal, aku sedang mengikuti lomba olimpiade MIPA untuk\r\n  kedua kalinya. Alhamdulillah, aku mendapat juara satu. Ketika mengetahui\r\n  guruku telah tiada, piala ini kupersembahkan untuk sang guru tercinta. </p>\r\n  <p>Meskipun engkau kini tak ada disampingku, jasa-jasamu selalu kuingat\r\n  wahai pahlawan cendikia. Selamat jalan guruku. Kaulah inspirasiku.</p>\r\n  <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;\r\n  &nbsp; &nbsp; &nbsp; (Anisah Amini, <i>Guruku Inspirasiku</i>)</p>\r\n  \r\n \r\n\r\n\r\n<p>Amanat yang\r\nterkandung dalam penggalan cerpen tersebut adalah â€¦</p><p></p>', 'Guru adalah pahlawan cendikia.', 'Kenanglah selalu kebaikan guru.', 'Berterima kasihlah atas jasa-jasa guru.', 'Guru adalah inspirasi murid-muridnya.', 'Guru adalah pahlawan tanpa tanda jasa.', 'B', '', ''),
(985, 21, 'A', 42, '<p>Cermati petunjuk kerja berikut!</p><p>Cara  Membuat Perangkap Nyamuk :<br>(1)  Bungkus botol dengan kain hitam, kecuali bagian atas<br>(2)  Letakkan  botol di beberapa sudut rumah<br>(3)  Potong botol plastik dan simpan bagian atasnya<br>(4)  Tambahkan ragi dan tidak perlu diaduk<br>(5)  Campur gula merah dengan air panas<br>(6)  Setelah dingin, tuangkan pada potongan botol bagian bawah<br>(7)  Masukkan potongan botol bagian atas dengan posisi terbalik seperti corong<br><br></p><p>Urutan yang tepat untuk membentuk teks yang padu adalahâ€¦.<br><br></p>', '(1),(2),(3),(4),(5),(6),(7)', '(3),(2),(4),(5),(6),(7),(1)', '(2),(5),(6),(4),(7),(1),(3)', '(3),(5),(6),(4),(7),(1),(2)', '(7),(6),(5),(4),(1),(2),(3)', 'A', '', ''),
(986, 21, 'A', 14, '<p></p><p><b>Bacalah </b><b>kutipan tek\r\ncerita pendek berikut!</b></p>\r\n\r\n\r\n \r\n  \r\n  <p>Betapa besarnya tenaga yang telah kucurahkan ketika aku diserahi\r\n  pekerjaan membuat sebuah jembatan besar pada sebuah kota. Siang malam aku\r\n  bekerja memeras otak dan tenaga, hingga hampir-hampir kehilangan ingatan. </p>\r\n  <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; \r\n  (Ali Audah, <i>Kegagalan Terakhir</i>)</p>\r\n  \r\n \r\n\r\n\r\n<p>Majas yang terdapat dalam kutipan teks cerita pendek\r\ntersebut adalah â€¦.</p><p></p>', 'Paradox', 'Metafora', 'Metonimia', 'Hiperbola', 'Personifikasi', 'D', '', ''),
(987, 21, 'A', 15, '<p></p><p><b>Bacalah kutipan teks novel berikut dengan saksama!</b></p>\r\n\r\n\r\n \r\n  \r\n  <p>Sekolah kami tidak dijaga\r\n  karena tidak ada benda berharga yang layak dicuri. Satu-satunya benda yang\r\n  menandakan bangunan itu sekolah adalah sebatang tiang bendera dari bambu\r\n  kuning dan sebuah papan tulis hijau yang tergantung miring di dekat lonceng.\r\n  Lonceng kami adalah besi bulat berlubang-lubang bekas tungku. Di papan tulis\r\n  itu terpampang gambar matahari dengan garis-garis sinar berwarna putih SD/MD\r\n  Sekolah Dasar Muhammadiyah â€¦.</p>\r\n  <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; \r\n  (Andera Hirata, <i>Laskar pelangi</i>)<b></b></p>\r\n  \r\n \r\n\r\n\r\n<p>Unsur intrinsik\r\nyang paling dominan dalam kutipan novel tersebut adalah â€¦.</p><p></p>', 'Penokohan', 'latar cerita', 'alur cerita', 'tema cerita', 'amanat cerita', 'B', '', ''),
(988, 21, 'A', 41, '<p>Cermati teks obsevasi berikut dengan saksama!</p><p>Alam yang serasi dan lestari adalah alam yang mengandung berbagai komponen ekosistem secara seimbang. Keseimbangan inilah yang harus tetap dijaga. Hal ini dilakukan supaya keanekaragaman sumber daya alam tetap lestari dan terjamin. Apabila tidak dijaga, keseimbangan alam dapat terganggu atau rusak. [...]&nbsp;</p><p>Kalimat Simpulan yang tepat untuk melengkapi kutipan teks tersebut adalah â€¦<br><br></p>', 'Maka dari itu, kerusakan alam bukan tanggung jawab masyarakat. ', 'Oleh karena itu, pemanfaatan sumber daya alam sebaiknya diusahakan secara arif dan bijaksana.', 'Itulah kerusakan alam yang diakibatkan oleh manusia.', 'Dengan demikian, jika alam sudah rusak tidak bisa dimanfaatkan secara terus-menerus.', 'Namun, kerusakan alam sudah biasa terjadi di Indonesia.', 'B', '', ''),
(989, 22, 'A', 37, '<p>1. Add your dirty clothes and detergent to the drum of the machine.<br>2.  Fill the drum with water at the temperature you require. Read the machineâ€™s &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; instructions  first, because these will tell you how much water to add.<br>3.  Perform the â€˜Washâ€™ cycle â€“ bear in mind a large load will need more time to wash than a &nbsp; &nbsp; smaller one.<br>4.  Once the â€˜Washâ€™ cycle has finished, drain the dirty water using the hose. Refill the &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; drum &nbsp; with fresh water. Switch on the â€˜Rinseâ€™ cycle. <br>5.  After the â€˜Rinseâ€™ cycle your clothes should be completely clean. You now need to &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  get  the clothes as dry as possible by spinning them. A fully automatic machine will do &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;  this for you, but if you have a semi-automatic machine, you now need to transfer your  &nbsp; &nbsp; &nbsp; clothes from the washing drum into the other drum â€“ again, the size of the load will &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;&nbsp;&nbsp; determine how long you need to spin them for.<br>6.  With all types of machine, once the spin cycle is finished, you should remove the &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; clothes as soon as possible and hang them up to dry.</p><p>. What is the step after the wash cycle has finished?<br><br></p>', 'Drain the dirty water and rinse the clothes using fresh water', 'Rinse the clothes so theyâ€™re completely clean', 'Refill the drum with fresh water', 'Spin the clothes to get them dry', '    ', 'A', '', ''),
(990, 21, 'A', 16, '<p></p><p><b>Bacalah kutipan teks cerpen berikut dengan saksama!</b></p>\r\n\r\n\r\n \r\n  \r\n  <p>Nyonya Hidayat menggigit bibirnya. Oh, jadi itu kiranya yang membawa\r\n  mereka kemari! Selanjutnya ia harus lebih berhati-hati dalam bicaranya. Apa\r\n  yang dikatakannya pada suatu saat secara santai bisa saja menjadi <i>senjata makan tuan</i> di kemudian hari!\r\n  Kalau begitu orang betul-betul harus menjaga mulutnya, pikir Nyonya Hidayat\r\n  dalam hati. </p>\r\n  <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; \r\n  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;(S. Mara. GD, <i>Misteri Gugurnya Sekuntum Dahlia</i>)</p>\r\n  \r\n \r\n\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; Makna peribahasa yang terkandung\r\npada kalimat yang bercetak miring adalah â€¦. \r\n</p>\r\n\r\n\r\n \r\n  \r\n  <p>A.</p>\r\n  \r\n  \r\n  <p><br></p>\r\n  \r\n \r\n \r\n  \r\n  <p>B.</p>\r\n  \r\n  \r\n  <p><br></p>\r\n  \r\n \r\n \r\n  \r\n  <p>C.</p>\r\n  \r\n  \r\n  <p><br></p>\r\n  \r\n \r\n \r\n  \r\n  <p>D.</p>\r\n  \r\n  \r\n  <p><br></p>\r\n  \r\n \r\n \r\n  \r\n  <p>E.</p>\r\n  \r\n  \r\n  <p><br></p>\r\n  \r\n \r\n\r\n\r\n\r\n\r\n\r\n\r\n<br><p></p>', 'perbuatan yang harus dipertanggungjawabkan', 'senjata mengenai diri sendiri', 'diri sendiri yang terkena akibatnya', 'sesuatu yang direncanakan untuk orang lain pasti akan terwujud', 'sesuatu direncanakan untuk mencelakakan orang lain tetapi berbalik mengenai diri sendiri', 'E', '', ''),
(991, 21, 'A', 40, '<p>Bacalah kutipan teks  berita berikut dengan saksama!</p><p>Kepala Badan Ekonomi Kreatif, Triawan Munaf, berencana menerapkan sistem peringatan beserta sanksi tegas terhadap masyarakat yang mengunduh lagu atau film secara ilegal melalui internet.</p><p>Tanggapan logis terhadap kutipan berita tersebut adalahâ€¦<br><br></p>', 'Baiknya itu diterapkan untuk produk-produk lokal saja untuk menghargai seniman Indonesia.', 'Rasanya masyarakat akan sangat keberatan dengan hal ini.', 'Agaknya cukup berlebihan mengingat kondisi ekonomi saat ini sedang lesu.', 'Hal ini sangat perlu didukung mengingat maraknya pembajakan di Indonesia.', 'Tindakan seperti itu diharapkan memberikan efek jera bagi masyarakat.', 'D', '', ''),
(992, 22, 'A', 38, '<p>1. Add your dirty clothes and detergent to the drum of the machine.<br>2.  Fill the drum with water at the temperature you require. Read the machineâ€™s &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; instructions  first, because these will tell you how much water to add.<br>3.  Perform the â€˜Washâ€™ cycle â€“ bear in mind a large load will need more time to wash than a &nbsp; &nbsp; smaller one.<br>4.  Once the â€˜Washâ€™ cycle has finished, drain the dirty water using the hose. Refill the &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; drum &nbsp; with fresh water. Switch on the â€˜Rinseâ€™ cycle. <br>5.  After the â€˜Rinseâ€™ cycle your clothes should be completely clean. You now need to &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;  get  the clothes as dry as possible by spinning them. A fully automatic machine will do &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; this for you, but if you have a semi-automatic machine, you now need to transfer your  &nbsp; &nbsp;&nbsp;&nbsp; clothes from the washing drum into the other drum â€“ again, the size of the load will &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;&nbsp;&nbsp; determine how long you need to spin them for.<br>6.  With all types of machine, once the spin cycle is finished, you should remove the &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; clothes as soon as possible and hang them up to dry.</p><p>â€œ....... than a smaller one.â€ (number 3)<br>&nbsp; The underlined word refers to ...<br><br><br></p>', 'The washing machine', 'The clothes', 'The drum', 'The hose', '     ', 'A', '', ''),
(993, 21, 'A', 17, '<p></p><p><b>Bacalah kutipan teks cerpen berikut\r\ndengan saksama1</b></p>\r\n\r\n\r\n \r\n  \r\n  <p>â€œ Anda tidak sakit?â€ Tanyaku lagi dengan nada lemah lembut.</p>\r\n  <p>Yang kali ini menggeleng.</p>\r\n  <p>â€œMengapa sepagi ini Anda di taman?â€ Aku memberanikan diri melajutkan\r\n  pertanyaan.Dia menarik napas panjang, lalu memandangiku sejenak. Kemudian\r\n  diam lagi. Matanya yang bulat hitam menerawang jauh, hampa. Sungguh,\r\n  mengundang iba. Maka kudekati dia, sambil berkata, â€œTolong, katakan, apa\r\n  masalah Anda. Siapa tahu saya bisa menolong, walau di antara kita belum\r\n  saling mengenal. Percayalah, saya orang baik-baik. Saya dari Amerika. Ini identitas\r\n  saya.â€ Kukeluarkan paspor dari saku jaketku.</p>\r\n  <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; \r\n  (Naning Pranoto, <i>Pengakuan Gadis\r\n  Bergaun Hitam</i>)</p>\r\n  \r\n \r\n\r\n\r\n<p>Watak tokoh aku dalam penggalan cerpen di atas adalah â€¦.</p><p></p>', 'lemah lembut', 'Pemberani', 'Peduli', 'baik hati', 'bisa dipercaya', 'C', '', ''),
(994, 21, 'A', 18, '<p></p><p><b>Bacalah kutipan teks cerpen berikut dengan saksama!</b></p>\r\n\r\n\r\n \r\n  \r\n  <p>Hujan datang\r\n  lagi. Menghanyutkan jejak-jejak kenangan. Kulihat televisi, katanya â€œBanjir\r\n  mengepung Ibu kotaâ€. Kulihat koran, katanya â€œAir Bah lumpuhkan Jakartaâ€. Aku\r\n  meneguk segelas teh panas. Melakoni lagi hidup ini, sebagai penyaksi antara\r\n  yang hidup penuh sensasi-ilusi.</p>\r\n  <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; \r\n  (Eveline Ramadhini, <i>Bah\r\n  Kehidupan</i>)</p>\r\n  \r\n \r\n\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; Latar kutipan cerita pendek\r\ntersebut adalah â€¦.</p><p></p>', 'di kantor', 'di sekolah', 'di rumah', 'di kampus', 'di jalan', 'C', '', ''),
(995, 21, 'A', 19, '<p></p><p><b>Bacalah kutipan teks cerita pendek berikut!</b></p>\r\n\r\n\r\n \r\n  \r\n  <p>Langkahku terbawa ke bibir pantai. Seperti\r\n  hari-hari yang lalu, aku akan ada di sini saat hati sedang bergelayut gundah.\r\n  Laut adalah tempatku bercerita. Di atas sebatang nyiur yang tumbang aku duduk\r\n  menikmati mega.</p>\r\n  <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; \r\n  (Jenner Man, <i>Awan Hitam</i>)</p>\r\n  \r\n \r\n\r\n\r\n<p>Makna ungkapan bibir pantai dalam teks cerita pendek\r\ntersebut adalah â€¦.</p><p></p>', 'perkampungan sisi pantai', 'pantai berpasir', 'tepi laut', 'tepi pantai', 'pantai yang berbicara', 'D', '', ''),
(996, 21, 'A', 20, '<p></p><p><b>Bacalah kutipan\r\nteks cerpen berikut dengan saksama!</b></p>\r\n\r\n\r\n \r\n  \r\n  <p>â€œSaudara-saudaraku, tiga kewajiban\r\n  anak kepada orang tua yang meninggal. Satu, memandikan sesegera mungkin. Dua,\r\n  memakaikan kain kafan sebagaimana mestinya. Ketiga, melakukan sholat jenazah\r\n  untuk orang tua. Handai taulan hanya membantu menguburkan jenazah di makam.â€\r\n  Begitu penjelasan Pak Zudan. </p>\r\n  <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; (Kusmar\r\n  Tedy, <i>Guruku, Ayahku</i>)</p>\r\n  \r\n \r\n\r\n\r\n<p>Unsur ekstrinsik kutipan cerpen tersebut adalah â€¦.</p><p></p>', 'Budaya', 'Adat', 'Social', 'Agama', 'Etika', 'D', '', ''),
(997, 21, 'A', 39, '<p>Bacalah kutipan teks berita berikut dengan saksama!</p><p>Earth Hour (EH) tidak sekedar mengajak memadamkan lampu selama satu jam setiap tahun, tetapi juga pada upaya penghematan energi lainnya secara umum. Pada tanggal 30 Juli - 2 Agustus lalu komunitas EH dari beberapa kota di Indonesia berkumpul di Eco Camp, Bandung. Mereka meresapi kembali makna dekat dengan alam, memperbaharui motivasi dalam upaya pelestarian lingkungan, dan membekali diri agar lebih tangguh menghadapi tantangan.</p><p>Tanggapan positif terhadap kutipan berita tersebut adalahâ€¦<br><br></p>', 'Kegiatan ini hendaknya  tidak hanya dilakukan di perkotaan, tapi juga sampai ke desa-desa.', 'Memadamkan lampu selama satu jam secara serentak kurang ada maknanya jika dalam keseharian tidak ada pengematan energi.', 'Menghemat energi bukan dengan cara membentuk komunitas, tetapi langsung diterapkan kepada setiap individu.', 'Upaya pelestarian lingkungan janganlah diperbesar karena masyarakat sudah bosan dengan ajakan yang seperti itu.', 'Mendekatkan diri dengan alam tidak perlu dilakukan karena pada akhirnya kerusakan alam lah yang dirasakan.', 'A', '', ''),
(998, 21, 'A', 21, '<p></p><p><b>Bacalah dengan cermat penggalan teks drama berikut!</b></p>\r\n\r\n\r\n \r\n  \r\n  <p>Yeni &nbsp;  : â€œTanggal berapa kamu\r\n  pulang ke Padang? Sudah dapat tiket pesawat belum?â€</p>\r\n  <p>Neli &nbsp; &nbsp; : â€œBelum, Uni. Aku bingung\r\n  karena tiket rata-rata sudah habis terjual. Lagi pula, harga tiket pesawat\r\n  sudah naik tiga kali lipat dari harga biasa.â€</p>\r\n  <p>Yeni &nbsp;  : &nbsp;â€œBagaimana kalau naik bus malam saja?\r\n  Harganya pasti lebih murah, <i>kan</i>?â€</p>\r\n  <p>Neli &nbsp; &nbsp; : &nbsp;â€œIya, memang lebih murah dari tiket pesawat.\r\n  Tapi harganya juga naik. Sudah mahal tiket untuk mendapatkannya juga susah.â€</p>\r\n  <p>Yeni &nbsp;  : &nbsp;â€œ<i>Yah</i>â€¦\r\n  memang itulah problem tiap tahun jika kita mau mudik di hari raya.â€<b></b></p>\r\n  \r\n \r\n\r\n\r\n<p>Inti penggalan dialog\r\ntersebut adalah â€¦.</p><p></p>', 'harga tiket pesawat yang mengalami kenaikan', 'rencana mudik ke kampung halaman saat lebaran', 'sulitnya mendapatkan tiket bus maam saat lebaran', 'harga tiket bus malam yang lebih murah daripada tiket pesawat', 'masalah transportasi tiap tahun jika menghadapi hari lebaran', 'E', '', ''),
(999, 22, 'A', 39, '<p>What is expected from the readers after reading the text? <br><img src="http://localhost/cbt/files/22_39_1.jpg" alt=""><br></p>', '   Be aware of the beauty of the beach.', '  Be interested in visiting the object.', '   Know the history about Goa Lawah.', '  Know which place to stay in Bali.', '       ', 'D', 'files/22_39_1.jpg', ''),
(1000, 21, 'A', 22, '<p></p><p><b>Bacalah\r\ndengan cermat penggalan teks novel berikut!</b></p>\r\n\r\n\r\n \r\n  \r\n  <p>Dan hujan pun\r\n  turun. Gerimis, gelap, lelah, dan dingin. Masih tak tentu arah, kami hanya\r\n  melangkah saja sekenanya berpegang pada pesan orang tua untuk menemukan\r\n  masjid. Nasib baik! Belum jauh dari terminal, &nbsp;kami menemukan sebuah gedung dengan tulisan\r\n  yang membuat kami senang karena di SMA Negeri Bukan Main kami sudah sering\r\n  mendengarnya: Institut Pertanian Bogor (IPB) lebih menyenangkannya karena\r\n  dibelakangnya ada masjid. </p>\r\n  <p><i>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; \r\n  (Andrea Hirata, Sang Pemimpi,)</i><b></b></p>\r\n  \r\n \r\n\r\n\r\n<p>Nilai pendidikan yang terkandung pada kutipan Novel\r\ntersebut adalah â€¦.</p><p></p>', 'hendaknya kita senantiasa ingat dengan nasihat orang tua', 'janganlah lupa menjalankan ibadah di mana pun berada', 'segeralah mencari tempat yang dikenal jika kita tersesat', 'jangan berani merantau jika tidak ingin menanggung risiko', 'beranilah untuk bertanya agar tidak tersesat di perjalanan', 'A', '', ''),
(1001, 21, 'A', 38, '<p>Cermati kalimat pernyataan dibawah ini dengan saksama!</p><p>Gelar yang berhasil diraih Irene Sukandar seperti Master Percasi (MP) Master Nasional Wanita (MNW) dan Master Fide Wanita (MFW)&nbsp;</p><p>Perbaikan kesalahan penggunaan tanda baca dalam kalimat di atas adalahâ€¦<br><br></p>', 'Gelar yang berhasil diraih Irene Sukandar seperti: Master Percasi (MP), Master Nasional Wanita (MNW) dan Master Fide Wanita (MFW).', 'Gelar yang berhasil diraih Irene Sukandar seperti Master Percasi (MP), Master Nasional Wanita (MNW) dan Master Fide Wanita (MFW).', 'Gelar yang berhasil diraih Irene Sukandar, seperti Master Percasi (MP), Master Nasional Wanita (MNW), dan Master Fide Wanita (MFW).', 'Gelar yang berhasil diraih Irene Sukandar, seperti Master Percasi (MP), Master Nasional Wanita (MNW) dan Master Fide Wanita (MFW).', 'Gelar yang berhasil diraih Irene Sukandar, seperti: Master Percasi (MP) Master Nasional Wanita (MNW) dan Master Fide Wanita (MFW).', 'C', '', ''),
(1002, 21, 'A', 37, '<p>Bacalah  kutipan teks eksposisi berikut!</p><p>Gerhana Matahari terjadi ketika posisi bulan terletak di antara bumi dan matahari sehingga menutup sebagian atau seluruh bahaya matahari. Walaupun bulan lebih kecil, bayangannya mampu melindungi cahaya matahari sepenuhnya karena bulan yang berjarak rata-rata 384,400 kilometer dari bumi dekat dibandingkan matahari yang mempunyai jarak rata-rata 149.680 kilometer. Gerhana matahari dapat dibagi dalam empat jenis,yaitu gerhana total, gerhana sebagian, gerhana cincin, dan gerhana hibrida.</p><p>Sinonim kata total pada kutipan teks tersebut adalahâ€¦.</p><p><br></p>', 'Bulat', 'Bundar', 'Penuh', 'Lingkaran', 'Sempurna', 'C', '', ''),
(1003, 21, 'A', 23, '<p></p><p><b>Bacalah\r\nteks pantun berikut!</b></p>\r\n\r\n\r\n \r\n  \r\n  <p>Teks 1</p>\r\n  <p>Katak lompat di\r\n  pinggir kali</p>\r\n  <p>Sambil bernyanyi\r\n  merdu sekali</p>\r\n  <p>Hati riang tidak\r\n  terperi</p>\r\n  <p>Ibunda datang\r\n  membawa kari</p>\r\n  <p>Teks 2</p>\r\n  <p>Jika ada jarum yang\r\n  patah</p>\r\n  <p>Jangan disimpan di\r\n  dalam peti</p>\r\n  <p>Kalau ada kata yang\r\n  salah</p>\r\n  <p>Jangan disimpan di\r\n  dalam hati<b></b></p>\r\n  \r\n \r\n\r\n\r\n<p>Perbedaan kedua\r\npantun tersebut adalah â€¦.</p><p></p>', 'teks 1 bersajak sama\r\nteks 2 bersajak silang', 'teks 1 bersajak AAAA\r\nteks 2 bersajak ABAB', 'teks 1 dua larik pertama isi\r\nteks 2 dua larik pertama sampiran', 'teks 1 tidak mempunyai sampiran\r\nteks 2 ada sampiran', 'teks 1 rima akhir sama\r\nteks 2 rima akhir berbeda', 'B', '', ''),
(1004, 21, 'A', 24, '<p></p><p><b>Perhatikan\r\npantun berikut!</b></p>\r\n\r\n\r\n \r\n  \r\n  <p>Taman bunga taman\r\n  yang indah</p>\r\n  <p>Tempat bermain anak\r\n  balita</p>\r\n  <p>. . . .</p>\r\n  <p>Damai akhirat hidup\r\n  bahagia<b></b></p>\r\n  \r\n \r\n\r\n\r\n<p>Larik  yang tepat untuk melengkapi  pantun tersebut adalah â€¦.</p><p></p>', 'masa muda masa yang indah', 'masa muda masa ibadah', 'mari kita giat beramal', 'rajinlah kamu beribadah', 'kalau kamu hidup bersahaja', 'D', '', ''),
(1005, 21, 'A', 36, '<p>Bacalah  teks eksposisi berikut dengan saksama!</p><p>Tsunami adalah gelombang laut besar yang datang dengan cepat dan tiba-tiba menerjang kawasan pantai. Gelombang tersebut terbentuk akibat dari aktivitas gempa dan atau gunung berapi yang meletus di bawah laut. Besarnya gelombang tsunami menyebabkan banjir dan kerusakan ketika menghantam pantai. Pembentukan tsunami terjadi saat dasar laut permukaannya naik turun di sepanjang patahan selama gempa berlangsung. Patahan tersebut mengakibatkan terganggunya keseimbangan air laut.</p><p>Perbaikan kalimat yang bercetak miring di atas adalahâ€¦<br><br></p>', 'Gelombang tersebut terbentuk akibat dari aktivitas gempa sehingga gunung berapi yang meletus di bawah laut.', 'Gelombang tersebut terbentuk akibat dari aktivitas gempa  tetapi  gunung berapi yang meletus di bawah laut.', 'Gelombang tersebut terbentuk akibat dari aktivitas gempa  serta gunung berapi yang meletus di bawah laut.', 'Gelombang tersebut terbentuk akibat dari aktivitas gempa  atau gunung berapi yang meletus di bawah laut.', 'Gelombang tersebut terbentuk akibat dari aktivitas gempa  dan gunung berapi yang meletus di bawah laut.', 'D', '', ''),
(1006, 21, 'A', 25, '<p></p><p><b>Cermatilah Pantun Berikut!</b></p>\r\n\r\n\r\n \r\n  \r\n  <p>Kalau kedelai sudah\r\n  ditanam</p>\r\n  <p>Jangan lagi meminta\r\n  talas</p>\r\n  <p>Kalau budi sudah\r\n  ditanam</p>\r\n  <p>Jangan lagi meminta\r\n  balas</p>\r\n  \r\n \r\n\r\n\r\n<p>Tema pantun\r\ntersebut adalah â€¦.</p><p></p>', 'lingkungan', 'kebudayaan', 'pendidikan', 'percintaan', 'Persahabatan', 'C', '', ''),
(1007, 21, 'A', 35, '<p>Bacalah teks berita berikut!</p><p>[â€¦] keberhasilan dan kemajuan pelaksanaan pembangunan pertanian digelar. Tujuannya agar seluruh lapisan masyarakat, dari petinggi negara sampai masyarakat pedesaan mengetahui apa yang berhasil dicapai dan apa pula yang mengalami kemajuan. Akan tetapi, di balik hingar-bingar tradisi tersebut, sesungguhnya [â€¦] pertanian sedang menghadapi masalah besar. [â€¦] beras yang telah diidentikan dengan keberhasilan pembangunan pertanian kian terancam.</p><p>Istilah yang tepat untuk melengkapi teks tersebut adalahâ€¦<br><br></p>', 'refleksi, sektor, swasembada', 'swasembada, refleksi, sector', 'konversi, refleksi, swasembada', 'refleksi, konversi, swasembada', 'refleksi, swasembada, sector', 'A', '', ''),
(1008, 21, 'A', 34, '<p>Bacalah dengan cermat teks berita berikut!</p><p>Lingkungan hidup adalah segala sesuatu yang ada di sekitar manusia dan [â€¦]  timbal balik. Lingkungan hidup perlu makanan dan [â€¦] biak seperti manusia, binatang, dan tumbuhan. Benda mati antara lain tanah, air, api, batu, dan udara. Jika terpelihara dengan baik, lingkungan hidup itu dapat [â€¦] masyarakat yang sehat, aman, tenteram, lahir dan batin.</p><p>Kata bentukan yang tepat untuk melengkapi teks tersebut adalah â€¦.<br><br></p>', 'berhubungan-berkembang-menciptakan', 'tumbuhanâ€“berkembang-menciptakan', 'berhubungan-memamah-menciptakan', 'berhubungan-berkembang-memamah', 'berhubungan-menciptakan-berkembang', 'A', '', ''),
(1009, 21, 'A', 33, '<p>33.  Bacalah teks cerita sejarah berikut!</p><p>Peristiwa monumental yang menjadi puncak dari persatuan gerakan buruh dunia adalah peyelenggaraan Kongres Buruh Internasional tahun 1889. Kongres yang dihadiri ratusan delegasi dari berbagai negeri dan memutuskan delapan jam kerja per hari menjadi tuntutan utama kaum buruh seluruh dunia. Selain itu, kongres juga menyambut usulan delegasi buruh dari Amerika Serikat yang menyerukan pemogokan umum 1 Mei 1890 guna menuntut pengurangan jam kerja dengan menjadikan tanggal 1 Mei sebagai Hari Buruh se-Dunia.</p><p>Ringkasan teks tersebut adalah â€¦.<br><br></p>', 'Persatuan buruh sedunia menuntut jam kerja delapan jam per hari dan pemogokan umum pada 1 Mei.', 'Peristiwa monumental yang menjadi puncak gerakan buruh sedunia dengan keputusan delapan jam per hari.', 'Pemogokan kaum buruh yang menuntut pengurangan jam kerja per hari dan menetapkan adanya hari buruh.', 'Kongres Buruh Internasional yang memutuskan delapan jam kerja per hari dan menetapkan 1 Mei sebagai Hari Buruh se-Dunia.', 'Kongres yang dihadiri ratusan buruh untuk menyerukan pemogokan umum pada tanggal 1 Mei sebagai Hari Buruh se-Dunia.', 'D', '', ''),
(1010, 21, 'A', 32, '<p>32.  Cermatilah kalimat-kalimat dibawah ini!</p><p>1. Sebelumnya bernama Askes (Asuransi Kesehatan), yang dikelola oleh PT Askes Indonesia (Persero).<br>2.  BPJS Kesehatan (Badan Penyelenggara Jaminan Sosial Kesehatan) merupakan Badan Hukum Publik yang bertanggung jawab langsung kepada presiden dan memiliki tugas untuk menyelenggarakan jaminan kesehatan nasional.<br>3.  Setiap warga negara Indonesia dan warga asing yang sudah bekerja di Indonesia selama minimal enam bulan wajib menjadi anggota BPJS.<br>4.  Namun, sesuai UU No. 24 Tahun 2011 tentang BPJS, PT Askes Indonesia berubah menjadi BPJS Kesehatan sejak tanggal 1 Januari 2014.</p><p>Kalimat-kalimat tersebut akan menjadi paragraf yang padu bila disusun dengan urutan â€¦.<br><br></p>', '(2), (1), (4), (3)', '(2). (1), (3), (4)', '(1), (2), (3), (4)', '(3), (2), (4), (1)', '(3), (2), (1), (4)', 'A', '', ''),
(1011, 21, 'A', 31, '<p>31.  Perhatikan teks eksposisi berikut!</p><p><br>â€œDina adalah bunga desa di kampung kami, karena selain cantik [â€¦] juga rajin dan suka menolongâ€</p><p><br>Pronomina (kata ganti) yang tepat untuk mengisi bagian rumpang teks tersebut adalah â€¦.<br><br></p>', 'Aku', 'Mereka', 'Dia', 'kami ', 'Ia', 'E', '', ''),
(1012, 21, 'A', 30, '<p>Bacalah teks eksposisi berikut dengan saksama!</p><p>(1) Akibat pengaruh alat komunikasi dan perkembangan tehnologi informasi ini, pendidikan budi pekerti semakin menggelincir jauh dan terbaur riak gelombang zaman. (2) Budi pekerti yang demikian  â€œagungâ€ dan bernilai luhur, lama kelamaan semakin diuji oleh situasi bangsa yang semakin tajam perubahannya. (3) Hal itu mencemaskan kita. (4) Oleh sebab itu, perlu pembelajaran budi pekerti di sekolah. (5) Pembelajarannya sejajar dengan yang lainnya.&nbsp;</p><p><br>Kata yang penulisannya tidak sesuai dengan ejaan bahasa Indonesia dalam teks  tersebut ditandai dengan nomor â€¦. <br><br></p>', '(1)', '(2)', '(3)', '(4)', '(5)', 'A', '', ''),
(1013, 21, 'A', 29, '<p>Bacalah teks eksposisi berikut!</p><p>(1) Kenali rekan kerja Anda. (2) Hal ini sangat penting sekali untuk meningkatkan keterlibatan dan produktifitas di tempat kerja. (3) Selain itu, dengan mengenal rekan kerja Anda, maka hubungan di dalam tim semakin kuat. (4) Pengusaha, manager, dan karyawan yang saling kenal dengan rekan sekerja berarti dalam tahap membangun hubungan yang baik di kantor. (5) Dengan membangun tim yang solid dapat membuat Anda semakin sukses.</p><p> Kata tidak baku pada teks eksposisi tersebut adalahâ€¦.<br><br></p>', 'kuat, solid', 'solid, tim', 'manager, tim', 'sukses, produktifitas', 'produktifitas, manager', 'E', '', ''),
(1014, 21, 'A', 28, '<p>Bacalah kutipan teks ulasan film berikut!</p><p>(1) Film Laskar Pelangi yang diangkat dari novel karya Andrea Hirata dianggap sebagai kebangkitan film layar lebar perfilman Indonesia. (2) Alasannya, film yang disutradarai Riri Reza ini mampu menyedot jutaan penonton sebulan setelah digelar di bioskop. (3) Selain itu, film ini mampu menginspirasi kisahnya. (4) Secara filmis, Laskar Pelangi begitu memesona mata. (5) Film ini memang patut diacungi jempol.</p><p>Kalimat simpleks dalam teks tersebut ditandai dengan nomor â€¦.. <br><br></p>', '(1)', '(1)', '(3)', '(4)', '(5)', 'E', '', ''),
(1015, 22, 'A', 1, '&nbsp;&nbsp; <br>', 'A', 'B', 'C', 'D', '     ', 'C', 'files/22_1_1.mp3', 'files/22_1_2.jpg'),
(1016, 21, 'A', 27, '<p>Bacalah kutipan teks ulasan film berikut!</p><p>(1) Film Maze Runner 2: The Scorch Trials cukup menyedot konsentrasi penonton dari awal hingga akhir. (2) Adegan mencekam saat harus melarikan diri dari organisasi misterius, melintasi padang gurun, dan terjebak di kota mati, seakan membuat napas terhenti beberapa kali. (3) Maze Runner 2: The Scorch Trials ini berhasil menarik atensi dan memiliki akhir cerita di luar prediksi. (4) Kisah Maze Runner 2: The Scorch Trials tergolong cerdas dalam mencari elemen kelemahan dan ketakutan psikologi manusia. (5) Contohnya, The Gladers diburu oleh pasukan organisasi misterius yang diduga masih terkait dengan WCKD tanpa tahu lokasi aman yang dituju.</p><p>Kutipan ulasan film tersebut berisi tentang ....<br><br></p>', 'deskripsi film ', 'keunggulan film ', 'kelemahan film', 'sinopsis film ', 'simpulan film', 'B', '', ''),
(1017, 21, 'A', 26, '<p>Bacalah  penggalan teks novel berikut!</p><p>Kereta semakin laju menembus malam. Namun, dramatisasi di kepalanya tidak begitu saja lenyap. Kini ia benar-benar tidak bisa memejamkan matanya. Lamunannya berpindah dari bayangan masa lalu. Sebab goyangan dan bunyi kereta yang khas mengingatkan pada kereta Bangunkarta yang biasa ia naiki dari Jombang ke Jakarta atau sebaliknya dari Jakarta ke Jombang. Kereta itulah yang biasa ia gunakan untuk pulang-pergi, saat ia dulu masih nyantri di Jombang.<br>(Balada Cinta Majenun, Geidurrahman El Mishry)</p><p>Cara pengarang  bercerita dalam teks tersebut  adalah dengan menggunakan â€¦.<br><br></p>', 'sudut pandang orang kedua pelaku utama ', 'sudut pandang orang ketiga pelaku utama ', 'sudut pandang orang pertama pelaku utama ', 'sudut pandang orang kedua pelaku utama ', 'sudut pandang orang ketiga pelaku sampingan ', 'B', '', ''),
(1018, 22, 'A', 2, '<p>&nbsp;&nbsp; <br></p>', '  ', '   ', '   ', '   ', '           ', 'A', 'files/22_2_1.jpg', 'files/22_2_2.mp3'),
(1019, 22, 'A', 3, '<p>&nbsp;&nbsp;&nbsp; <br></p>', 'A', 'B', 'C', 'D', '       ', 'B', 'files/22_3_1.jpg', 'files/22_3_2.mp3'),
(1020, 22, 'A', 48, '<p>&nbsp; <img src="http://localhost/cbt/files/22_48_1.jpg" alt=""></p>', 'To inform some good news', 'To describe the writerâ€™s school', 'To retell the writerâ€™s experience', 'To entertain the reader with a joke ', '   ', 'C', 'files/22_48_1.jpg', ''),
(1021, 22, 'A', 49, '&nbsp;&nbsp;&nbsp; <img src="http://localhost/cbt/files/22_49_1.jpg" alt="">', 'To make her a pediatrician', 'To send her to an English course', 'To send her to a senior high school', 'To make her pass the final examination ', '      ', 'B', 'files/22_49_1.jpg', ''),
(1022, 22, 'A', 50, '&nbsp;&nbsp;&nbsp; <img src="http://localhost/cbt/files/22_50_1.jpg" alt="">', 'Glad', ' Scared', 'Anxious', 'Thoughtful', '    ', 'A', 'files/22_50_1.jpg', ''),
(1023, 22, 'A', 42, '<p></p><p>Kevin Durant is one of the most popular Basketball player and also the richest player with Total Earnings of $54.1 million. He is portrayed as the â€œScoring Prodigyâ€ by John Hollinger. He has won the NBA scoring title four times in his profession. This 26-year-old, who plays for the Oklahoma City Thunder, stands 6 feet, 9 inches tall. He likewise stands relentless tall to the extent his bank parity is concerned. He is one of the favorite faces for many brand like Nike, BBVA, Sprint, Sonic, Panini, 2K Sports and Skull candy.<br><br>Born on September 29, 1988, Kevin Wayne Durant is an American basketball player for NBAâ€™s Golden State Warriors. He is the proud winner of Most Valuable Player award from NBA, NBA Rookie of the Year Award, four NBA scoring titles and an Olympic Gold Medal. He has also got selected to 6 All-NBA teams and 7 All-Star teams. He is the world richest sportsman who is listed in this list of top 10 richest player in the world.<br><br>He was recruited heavily to a high school prospect. He played college basketball one season for the University of Texas. He has become the first ever freshman and several year-end awards to be called as Naismith College Player of the Year. He was selected by the Seattle Supersonics with second overall pick in the NBA Draft 2007.<br><br>The team moved to Oklahoma City and became Thunder after his rookie season. He helped Oklahoma City to NBA Finals 2012 and lost to Miami Heat in 5 matches. For the Thunder, he played 9 seasons before joining Warriors in the year 2016.<br></p><p>After reading the text, the readers are expected to ... .<br></p><br><br><p></p>', 'Love basketball better than other sports', ' Improve their skills in playing basketball', 'Become best acquainted with Kevin Durant', 'Have more knowledge about a famous athlete', '      ', 'D', 'files/22_42_1.jpg', ''),
(1024, 22, 'A', 43, '<p></p><p></p><p>Kevin Durant is one of the most popular Basketball player and also the richest player with Total Earnings of $54.1 million. He is portrayed as the â€œScoring Prodigyâ€ by John Hollinger. He has won the NBA scoring title four times in his profession. This 26-year-old, who plays for the Oklahoma City Thunder, stands 6 feet, 9 inches tall. He likewise stands relentless tall to the extent his bank parity is concerned. He is one of the favorite faces for many brand like Nike, BBVA, Sprint, Sonic, Panini, 2K Sports and Skull candy.<br><br>Born on September 29, 1988, Kevin Wayne Durant is an American basketball player for NBAâ€™s Golden State Warriors. He is the proud winner of Most Valuable Player award from NBA, NBA Rookie of the Year Award, four NBA scoring titles and an Olympic Gold Medal. He has also got selected to 6 All-NBA teams and 7 All-Star teams. He is the world richest sportsman who is listed in this list of top 10 richest player in the world.<br><br>He was recruited heavily to a high school prospect. He played college basketball one season for the University of Texas. He has become the first ever freshman and several year-end awards to be called as Naismith College Player of the Year. He was selected by the Seattle Supersonics with second overall pick in the NBA Draft 2007.<br><br>The team moved to Oklahoma City and became Thunder after his rookie season. He helped Oklahoma City to NBA Finals 2012 and lost to Miami Heat in 5 matches. For the Thunder, he played 9 seasons before joining Warriors in the year 2016.<br></p><p>&nbsp;Which of the following is TRUE about Kevin Durant?<br>&nbsp;<br><br></p><br><br><p></p><br><p></p>', ' He assisted Oklahoma City to NBA Finals in 2012', 'He won an Olympic gold medal in 2007.', 'He joined Warriors before playing for the Thunder.', 'He played for the University of Texas several seasons.', '   ', 'A', 'files/22_43_1.jpg', '');
INSERT INTO `soal` (`id_soal`, `id_mapel`, `paket`, `nomor`, `soal`, `pilA`, `pilB`, `pilC`, `pilD`, `pilE`, `jawaban`, `file`, `file1`) VALUES
(1025, 22, 'A', 44, '<p></p><p></p><p></p><p>Kevin Durant is one of the most popular Basketball player and also the richest player with Total Earnings of $54.1 million. He is portrayed as the â€œScoring Prodigyâ€ by John Hollinger. He has won the NBA scoring title four times in his profession. This 26-year-old, who plays for the Oklahoma City Thunder, stands 6 feet, 9 inches tall. He likewise stands relentless tall to the extent his bank parity is concerned. He is one of the favorite faces for many brand like Nike, BBVA, Sprint, Sonic, Panini, 2K Sports and Skull candy.<br><br>Born on September 29, 1988, Kevin Wayne Durant is an American basketball player for NBAâ€™s Golden State Warriors. He is the proud winner of Most Valuable Player award from NBA, NBA Rookie of the Year Award, four NBA scoring titles and an Olympic Gold Medal. He has also got selected to 6 All-NBA teams and 7 All-Star teams. He is the world richest sportsman who is listed in this list of top 10 richest player in the world.<br><br>He was recruited heavily to a high school prospect. He played college basketball one season for the University of Texas. He has become the first ever freshman and several year-end awards to be called as Naismith College Player of the Year. He was selected by the Seattle Supersonics with second overall pick in the NBA Draft 2007.<br><br>The team moved to Oklahoma City and became Thunder after his rookie season. He helped Oklahoma City to NBA Finals 2012 and lost to Miami Heat in 5 matches. For the Thunder, he played 9 seasons before joining Warriors in the year 2016.<br></p><p>&nbsp;What can be concluded from the text above?<br>&nbsp;<br><br>&nbsp;<br><br></p><br><br><p></p><br><p></p><br><p></p>', 'Kevin Durant was born on September 1988.', 'Kevin Durant stands 6 feet, 9 inches tall.', ' Kevin Durant was recruited heavily to a high school prospect.', 'Kevin Durant is a talented athelete and full of achievement.', '         ', 'D', 'files/22_44_1.jpg', ''),
(1026, 22, 'A', 40, '<p>&nbsp;</p><p><img src="http://localhost/cbt/files/22_40_1.jpg" alt=""><br></p><p>\r\n\r\nWhat is the third paragraph about?\r\n\r\n<br></p>', ' The priest overspread teaching Hindu in Bali.', ' The beauty of the caves around Goa Lawah.', ' The simple route to come to Goa Lawah.', ' The origin of Goa Lawah in brief.', '        ', 'D', 'files/22_40_1.jpg', ''),
(1027, 22, 'A', 41, '<p>.  â€œ... with Nusa Penida Island as a backdrop.â€ (1st paragraph, last sentence)<br>The underlined word is closest in meaning to ... .<br><br><img alt="" src="http://localhost/cbt/files/22_41_1.jpg"><br></p>', 'backchannel', 'background', 'wallpaper', ' backmarker', '  ', 'B', 'files/22_41_1.jpg', ''),
(1028, 22, 'A', 45, '<p>Dear Mr. Shoji,<br><br>We have reviewed your application for credit, and it is our pleasure to inform you that an account has been opened for your company.<br>Please feel free to use your account as often as you wish. A descriptive brochure is attached which outlines the terms and conditions upon which this account has been opened.<br>Should your credit requirements change, or should you have any questions regarding to your new account, call this office and ask to speak to one of our account representatives.<br>When you call, please have your account number available, in order that we might have quick access to your file.<br><br>Best regards,<br>Michele</p><p>&nbsp;What is the letter about?<br><br><br><br></p>', 'An application to open a saving account.', 'Requirement to open a bank account', 'A customer new charge credit card.', 'A company credit account approval. ', '     ', 'D', '', ''),
(1029, 22, 'A', 46, '<p></p><p>Dear Mr. Shoji,<br><br>We have reviewed your application for credit, and it is our pleasure to inform you that an account has been opened for your company.<br>Please feel free to use your account as often as you wish. A descriptive brochure is attached which outlines the terms and conditions upon which this account has been opened.<br>Should your credit requirements change, or should you have any questions regarding to your new account, call this office and ask to speak to one of our account representatives.<br>When you call, please have your account number available, in order that we might have quick access to your file.<br><br>Best regards,<br>Michele</p><p>What is needed to have quick access to your file?<br><br><br><br><br></p><br><p></p>', 'Account representative.', 'Descriptive brochure.', 'Credit requirement.', 'Account number.\r\n', '     ', 'D', '', ''),
(1030, 22, 'A', 47, '<p></p><p></p><p>Dear Mr. Shoji,<br><br>We have reviewed your application for credit, and it is our pleasure to inform you that an account has been opened for your company.<br>Please feel free to use your account as often as you wish. A descriptive brochure is attached which outlines the terms and conditions upon which this account has been opened.<br>Should your credit requirements change, or should you have any questions regarding to your new account, call this office and ask to speak to one of our account representatives.<br>When you call, please have your account number available, in order that we might have quick access to your file.<br><br>Best regards,<br>Michele</p><p>. â€œPlease feel free to use your account as often as you wish.â€ (paragraph 2), <br>What does the sentence mean? <br><br><br><br><br><br></p><br><p></p><br><p></p>', ' The account is free of charge. ', 'Mr. Shoji can use his account anytime he needs.', 'Mr. Shoji is free to account his money. ', 'Mr. Shoji wishes to use his account freely. ', '       ', 'B', '', ''),
(1031, 22, 'A', 4, '<p>Directions:<br>There are four items in this part of the test. For each item, you will hear a questionor statement spoken in English followed by three responses, also spoken in English. They will be spoken TWICE. They will not be printed on your test paper, so you must listen carefully to understand what the speakers say. You are to choose the best response to each question or statement and mark it on your answer sheet<br><br>Now listen to a simple question.<br>You will hear  &nbsp; : Did you have to wait very long?<br>You will also hear  :  A. No more than an hour<br>&nbsp; &nbsp; &nbsp;  &nbsp; B. I hate line-ups<br>&nbsp; &nbsp; &nbsp;  &nbsp; C. I have gained twenty pounds<br><br>The best response to the question, â€œDid you have to wait very long?â€ is choice (A) <br>â€œNo more than an hourâ€. Therefore,you should choose answer (A)<br><br></p>', 'A', '  B', 'C', 'D', '  ', 'C', 'files/22_4_1.mp3', ''),
(1032, 22, 'A', 5, '<p>Directions:<br>There are four items in this part of the test. For each item, you will hear a questionor statement spoken in English followed by three responses, also spoken in English. They will be spoken TWICE. They will not be printed on your test paper, so you must listen carefully to understand what the speakers say. You are to choose the best response to each question or statement and mark it on your answer sheet<br><br>Now listen to a simple question.<br>You will hear  &nbsp; : Did you have to wait very long?<br>You will also hear  :  A. No more than an hour<br>&nbsp; &nbsp; &nbsp;  &nbsp; B. I hate line-ups<br>&nbsp; &nbsp; &nbsp;  &nbsp; C. I have gained twenty pounds<br><br>The best response to the question, â€œDid you have to wait very long?â€ is choice (A) <br>â€œNo more than an hourâ€. Therefore,you should choose answer (A)<br><br></p>', 'A', 'B', 'C', 'D', '  ', 'C', 'files/22_5_1.mp3', ''),
(1033, 22, 'A', 6, '<p>Directions:<br>There are four items in this part of the test. For each item, you will hear a questionor statement spoken in English followed by three responses, also spoken in English. They will be spoken TWICE. They will not be printed on your test paper, so you must listen carefully to understand what the speakers say. You are to choose the best response to each question or statement and mark it on your answer sheet<br><br>Now listen to a simple question.<br>You will hear  &nbsp; : Did you have to wait very long?<br>You will also hear  :  A. No more than an hour<br>&nbsp; &nbsp; &nbsp;  &nbsp; B. I hate line-ups<br>&nbsp; &nbsp; &nbsp;  &nbsp; C. I have gained twenty pounds<br><br>The best response to the question, â€œDid you have to wait very long?â€ is choice (A) <br>â€œNo more than an hourâ€. Therefore,you should choose answer (A)<br><br></p>', 'A', 'B', 'C', 'D', 'E', 'B', 'files/22_6_1.mp3', ''),
(1034, 22, 'A', 7, '<p>Directions:<br>There are four items in this part of the test. For each item, you will hear a questionor statement spoken in English followed by three responses, also spoken in English. They will be spoken TWICE. They will not be printed on your test paper, so you must listen carefully to understand what the speakers say. You are to choose the best response to each question or statement and mark it on your answer sheet<br><br>Now listen to a simple question.<br>You will hear  &nbsp; : Did you have to wait very long?<br>You will also hear  :  A. No more than an hour<br>&nbsp; &nbsp; &nbsp;  &nbsp; B. I hate line-ups<br>&nbsp; &nbsp; &nbsp;  &nbsp; C. I have gained twenty pounds<br><br>The best response to the question, â€œDid you have to wait very long?â€ is choice (A) <br>â€œNo more than an hourâ€. Therefore,you should choose answer (A)<br><br></p>', 'A', 'B', 'C', 'D', ' ', 'B', 'files/22_7_1.mp3', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
 ADD PRIMARY KEY (`id_guru`);

--
-- Indexes for table `jawaban`
--
ALTER TABLE `jawaban`
 ADD PRIMARY KEY (`id_jawaban`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
 ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
 ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `log1`
--
ALTER TABLE `log1`
 ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
 ADD PRIMARY KEY (`id_mapel`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
 ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `pengacak`
--
ALTER TABLE `pengacak`
 ADD PRIMARY KEY (`id_pengacak`);

--
-- Indexes for table `pengawas`
--
ALTER TABLE `pengawas`
 ADD PRIMARY KEY (`id_pengawas`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
 ADD PRIMARY KEY (`id_setting`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
 ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `soal`
--
ALTER TABLE `soal`
 ADD PRIMARY KEY (`id_soal`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `jawaban`
--
ALTER TABLE `jawaban`
MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `log1`
--
ALTER TABLE `log1`
MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mapel`
--
ALTER TABLE `mapel`
MODIFY `id_mapel` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pengacak`
--
ALTER TABLE `pengacak`
MODIFY `id_pengacak` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pengawas`
--
ALTER TABLE `pengawas`
MODIFY `id_pengawas` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `soal`
--
ALTER TABLE `soal`
MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1035;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
