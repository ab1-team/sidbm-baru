-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 13, 2026 at 09:16 AM
-- Server version: 8.0.34
-- PHP Version: 8.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbm_laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_buku`
--

CREATE TABLE `admin_buku` (
  `id` int NOT NULL,
  `nama_jb` varchar(50) DEFAULT '0',
  `icon` varchar(50) DEFAULT '0',
  `posisi` varchar(1) DEFAULT '0',
  `file` varchar(50) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admin_invoice`
--

CREATE TABLE `admin_invoice` (
  `idv` int NOT NULL,
  `lokasi` int DEFAULT '0',
  `nomor` varchar(255) NOT NULL,
  `jenis_pembayaran` int DEFAULT '0',
  `tgl_invoice` date DEFAULT NULL,
  `tgl_lunas` date DEFAULT NULL,
  `status` varchar(6) DEFAULT '0',
  `jumlah` int DEFAULT '0',
  `id_user` int DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admin_jenis_pembayaran`
--

CREATE TABLE `admin_jenis_pembayaran` (
  `id` int NOT NULL,
  `nama_jp` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admin_rekening`
--

CREATE TABLE `admin_rekening` (
  `kd_jb` varchar(3) DEFAULT '0',
  `kd_rekening` varchar(10) NOT NULL DEFAULT '',
  `nama_rekening` varchar(50) DEFAULT '0',
  `pasangan` varchar(10) DEFAULT '0',
  `tb2014` int DEFAULT '0',
  `tb2015` int DEFAULT '0',
  `tb2016` int DEFAULT '0',
  `posisi` varchar(1) DEFAULT '0',
  `tb2017` varchar(255) DEFAULT '0',
  `jenis_mutasi` varchar(10) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admin_transaksi`
--

CREATE TABLE `admin_transaksi` (
  `idt` int NOT NULL,
  `tgl_transaksi` date DEFAULT NULL,
  `rekening_debit` varchar(10) DEFAULT '0',
  `rekening_kredit` varchar(10) DEFAULT '0',
  `idv` int DEFAULT '0',
  `keterangan_transaksi` text,
  `jumlah` varchar(15) DEFAULT '0',
  `urutan` int DEFAULT '0',
  `id_user` int DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int NOT NULL,
  `nama_lengkap` varchar(225) NOT NULL,
  `gmail` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `akses` varchar(50) NOT NULL,
  `lokasi` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `kabupaten` varchar(50) NOT NULL,
  `provinsi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `akun_level_1`
--

CREATE TABLE `akun_level_1` (
  `id` int NOT NULL,
  `lev1` int DEFAULT '0',
  `lev2` int DEFAULT '0',
  `lev3` int DEFAULT '0',
  `lev4` int DEFAULT '0',
  `kode_akun` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `nama_akun` varchar(100) COLLATE utf8mb4_general_ci DEFAULT '0',
  `jenis_mutasi` varchar(6) COLLATE utf8mb4_general_ci DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `akun_level_2`
--

CREATE TABLE `akun_level_2` (
  `id` int NOT NULL,
  `parent_id` int NOT NULL,
  `lev1` int DEFAULT '0',
  `lev2` int DEFAULT '0',
  `lev3` int DEFAULT '0',
  `lev4` int DEFAULT '0',
  `kode_akun` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `nama_akun` varchar(100) COLLATE utf8mb4_general_ci DEFAULT '0',
  `jenis_mutasi` varchar(6) COLLATE utf8mb4_general_ci DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `akun_level_3`
--

CREATE TABLE `akun_level_3` (
  `id` int NOT NULL,
  `parent_id` int NOT NULL,
  `lev1` int DEFAULT '0',
  `lev2` int DEFAULT '0',
  `lev3` int DEFAULT '0',
  `lev4` int DEFAULT '0',
  `kode_akun` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `nama_akun` varchar(100) COLLATE utf8mb4_general_ci DEFAULT '0',
  `posisi` int DEFAULT '0',
  `jenis_mutasi` varchar(6) COLLATE utf8mb4_general_ci DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `anggota_1`
--

CREATE TABLE `anggota_1` (
  `id` int NOT NULL,
  `nik` char(16) DEFAULT '0',
  `namadepan` varchar(100) DEFAULT '0',
  `jk` char(1) DEFAULT '0',
  `tempat_lahir` varchar(30) DEFAULT '0',
  `tgl_lahir` date DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `desa` varchar(17) DEFAULT '0',
  `lokasi` int DEFAULT '0',
  `hp` char(15) DEFAULT '0',
  `kk` char(20) DEFAULT '0',
  `nik_penjamin` char(16) DEFAULT '0',
  `penjamin` varchar(100) DEFAULT '0',
  `hubungan` int DEFAULT '0',
  `usaha` varchar(50) DEFAULT NULL,
  `foto` text,
  `terdaftar` date DEFAULT NULL,
  `status` varchar(1) DEFAULT '0',
  `petugas` char(12) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `api_endpoint`
--

CREATE TABLE `api_endpoint` (
  `id` int NOT NULL,
  `whatsapp_api` varchar(225) NOT NULL,
  `update_api` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_update`
--

CREATE TABLE `app_update` (
  `id` int NOT NULL,
  `latest_version` varchar(225) NOT NULL,
  `version_code` int NOT NULL,
  `apk_name` varchar(225) NOT NULL,
  `apk_url` varchar(225) NOT NULL,
  `changelog` text NOT NULL,
  `force_update` tinyint(1) NOT NULL,
  `min_supported_version` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `arus_kas`
--

CREATE TABLE `arus_kas` (
  `id` int NOT NULL,
  `nama_akun` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `urutan` varchar(2) DEFAULT '0',
  `sub` varchar(2) DEFAULT '0',
  `super_sub` varchar(2) DEFAULT '0',
  `rekening` text,
  `status` varchar(2) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `calk`
--

CREATE TABLE `calk` (
  `id` int NOT NULL,
  `lokasi` int NOT NULL,
  `tanggal` date NOT NULL,
  `catatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_pemanfaat`
--

CREATE TABLE `data_pemanfaat` (
  `id` int NOT NULL,
  `lokasi` int NOT NULL,
  `nik` varchar(50) NOT NULL,
  `id_pinkel` int DEFAULT NULL,
  `idpa` int NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `desa`
--

CREATE TABLE `desa` (
  `id` int NOT NULL,
  `kd_kec` varchar(16) DEFAULT '0',
  `nama_kec` text,
  `kd_desa` varchar(16) NOT NULL DEFAULT '0',
  `nama_desa` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `alamat_desa` varchar(100) DEFAULT '0',
  `telp_desa` varchar(15) DEFAULT '0',
  `sebutan` int DEFAULT '0',
  `kode_desa` varchar(16) DEFAULT '0',
  `kades` varchar(50) DEFAULT '0',
  `pangkat` varchar(50) DEFAULT '0',
  `nip` varchar(50) DEFAULT '0',
  `no_kades` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `sekdes` varchar(50) DEFAULT '0',
  `no_sekdes` varchar(15) DEFAULT '0',
  `ked` varchar(50) DEFAULT '0',
  `no_ked` varchar(15) DEFAULT '0',
  `deskripsi_desa` text,
  `online` varchar(1) DEFAULT '0',
  `lo` datetime DEFAULT NULL,
  `kunjungan` varchar(10) DEFAULT '0',
  `nilai` varchar(1) DEFAULT '0',
  `jadwal_angsuran_desa` varchar(2) DEFAULT '0',
  `uname` varchar(20) DEFAULT '0',
  `pass` varchar(20) DEFAULT '0',
  `laba_th_lalu` varchar(50) DEFAULT '0',
  `laba_saat_ini` varchar(50) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dokumen_pinjaman`
--

CREATE TABLE `dokumen_pinjaman` (
  `id` int NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `excel` tinyint DEFAULT '0',
  `jenis_dokumen` varchar(255) DEFAULT NULL,
  `custom_ttd` tinyint DEFAULT '0',
  `urutan` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ebudgeting_1`
--

CREATE TABLE `ebudgeting_1` (
  `id` int NOT NULL,
  `kode_akun` varchar(50) NOT NULL,
  `tahun` int NOT NULL,
  `bulan` int NOT NULL,
  `jumlah` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fungsi_kelompok`
--

CREATE TABLE `fungsi_kelompok` (
  `id` int NOT NULL,
  `nama_fgs` varchar(20) DEFAULT '0',
  `deskripsi_fgs` varchar(50) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `inventaris_1`
--

CREATE TABLE `inventaris_1` (
  `id` int NOT NULL,
  `lokasi` varchar(30) DEFAULT '0',
  `nama_barang` varchar(100) DEFAULT '0',
  `tgl_beli` date DEFAULT NULL,
  `unit` int DEFAULT '0',
  `harsat` varchar(30) DEFAULT '0',
  `umur_ekonomis` int DEFAULT '0',
  `jenis` int DEFAULT '0',
  `kategori` varchar(2) DEFAULT '0',
  `status` varchar(25) DEFAULT 'Baik',
  `tgl_validasi` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id` int NOT NULL,
  `nama_jabatan` varchar(50) DEFAULT '0',
  `tupoksi` varchar(50) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_jasa`
--

CREATE TABLE `jenis_jasa` (
  `id` int NOT NULL,
  `nama_jj` text,
  `deskripsi_jj` text,
  `warna_jj` varchar(20) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_kegiatan`
--

CREATE TABLE `jenis_kegiatan` (
  `id` int NOT NULL,
  `nama_jk` varchar(20) DEFAULT '0',
  `deskripsi_jk` varchar(50) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_laporan`
--

CREATE TABLE `jenis_laporan` (
  `id` int NOT NULL,
  `urut` int DEFAULT '0',
  `nama_laporan` varchar(50) DEFAULT '0',
  `file` varchar(20) DEFAULT '0',
  `status` int DEFAULT '0',
  `kab` int DEFAULT NULL,
  `prov` int DEFAULT NULL,
  `mobile` int DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_laporan_pinjaman`
--

CREATE TABLE `jenis_laporan_pinjaman` (
  `id` int NOT NULL,
  `nama_laporan` varchar(255) DEFAULT '0',
  `file` varchar(100) DEFAULT '0',
  `status` int DEFAULT '0',
  `urut` int DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_produk_pinjaman`
--

CREATE TABLE `jenis_produk_pinjaman` (
  `id` int NOT NULL,
  `nama_jpp` varchar(20) DEFAULT '0',
  `deskripsi_jpp` varchar(50) DEFAULT '0',
  `warna_jpp` varchar(20) DEFAULT '0',
  `lokasi` text,
  `kd_kab` int DEFAULT '0',
  `kecuali` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_transaksi`
--

CREATE TABLE `jenis_transaksi` (
  `id` int NOT NULL,
  `nama_jt` varchar(50) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_usaha`
--

CREATE TABLE `jenis_usaha` (
  `id` int NOT NULL,
  `nama_ju` varchar(20) DEFAULT '0',
  `deskripsi_ju` varchar(50) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `kabupaten`
--

CREATE TABLE `kabupaten` (
  `id` int NOT NULL,
  `kd_prov` varchar(50) DEFAULT NULL,
  `kd_kab` varchar(50) DEFAULT NULL,
  `nama_kab` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `tgl_pakai` date DEFAULT NULL,
  `nama_lembaga` varchar(50) DEFAULT '0',
  `alamat_kab` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `telpon_kab` varchar(20) DEFAULT '0',
  `email_kab` varchar(50) DEFAULT '0',
  `web_kab` varchar(100) DEFAULT '0',
  `web_kab_alternatif` varchar(100) DEFAULT '0',
  `online` varchar(1) DEFAULT '0',
  `lo` varchar(50) DEFAULT NULL,
  `ip` varchar(30) DEFAULT '0',
  `tanda_tangan` text,
  `nilai` int DEFAULT '0',
  `uname` varchar(20) DEFAULT '0',
  `pass` varchar(50) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `kecamatan`
--

CREATE TABLE `kecamatan` (
  `id` int NOT NULL,
  `kd_kab` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `kd_kec` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `nama_lembaga_sort` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `nama_lembaga_long` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `nama_bkad_sort` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `nama_bkad_long` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `nama_bp_sort` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `nama_bp_long` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `nama_tv_sort` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `nama_tv_long` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `nama_kec` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `nomor_bh` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `alamat_kec` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `telpon_kec` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `email_kec` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `web_kec` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `web_alternatif` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `visi_misi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `jam_masuk` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `jam_pulang` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `def_jasa` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `def_jangka` int DEFAULT '0',
  `pembulatan` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `tgl_registrasi` date DEFAULT NULL,
  `tgl_pakai` date DEFAULT NULL,
  `tgl_trial` date DEFAULT NULL,
  `tgl_open` varchar(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `tgl_close` varchar(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `tgl_toleransi` varchar(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `batas_angsuran` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `redaksi_spk` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `asu_kelembagaan` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `asu_dansos` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `asu_bonus_upk` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `asu_lainnya` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `asu_ditahan` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `ttd_pelapor` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `ttd_bp` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `ttd_mengetahui_lap` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `ttd_pdua` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `ttd_saksi` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `ttd_pengurus_kelompok` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '1' COMMENT '1. Ketua Kelompok, 2. Kepala desa',
  `logo` varchar(225) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `whatsapp` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `biaya_tahunan` int DEFAULT '0',
  `sebutan_level_1` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `sebutan_level_2` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `sebutan_level_3` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `disiapkan` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `token` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `saksi_mou` varchar(225) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `nama_asuransi_p` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `besar_premi` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `usia_mak` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `pengaturan_asuransi` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `sebutan_kec` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `tanggung_renteng` text,
  `min_pajak` int DEFAULT '0',
  `min_bunga` int DEFAULT '0',
  `berita_acara` text,
  `npwp` varchar(50) DEFAULT NULL,
  `tgl_npwp` date DEFAULT NULL,
  `iptw` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `calk` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `kelompok_1`
--

CREATE TABLE `kelompok_1` (
  `id` int NOT NULL,
  `lokasi` int DEFAULT NULL COMMENT 'No Urut kd_kelompok Per Desa',
  `desa` varchar(17) DEFAULT '0',
  `kd_kelompok` varchar(40) DEFAULT '0',
  `nama_kelompok` varchar(50) DEFAULT '0',
  `alamat_kelompok` text,
  `telpon` varchar(15) DEFAULT '0',
  `tgl_berdiri` date DEFAULT NULL,
  `jenis_produk_pinjaman` int DEFAULT '0',
  `jenis_usaha` int DEFAULT '0',
  `jenis_kegiatan` int DEFAULT '0',
  `tingkat_kelompok` int DEFAULT '0',
  `fungsi_kelompok` int DEFAULT '0',
  `ketua` varchar(100) DEFAULT '0',
  `sekretaris` varchar(100) DEFAULT '0',
  `bendahara` varchar(100) DEFAULT '0',
  `uname` varchar(30) DEFAULT '0',
  `pass` varchar(100) DEFAULT '0',
  `online` varchar(1) DEFAULT '0',
  `nilai` varchar(1) DEFAULT '0',
  `kunjungan` varchar(10) DEFAULT '0',
  `lo` datetime DEFAULT NULL,
  `id_user` varchar(5) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `keluarga`
--

CREATE TABLE `keluarga` (
  `id` int NOT NULL,
  `kekeluargaan` varchar(20) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id` int NOT NULL,
  `nama_level` varchar(20) DEFAULT '0',
  `deskripsi_level` varchar(50) DEFAULT '0',
  `tupoksi_level` text,
  `urutan` int DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int NOT NULL,
  `parent_id` int NOT NULL DEFAULT '0',
  `sort` int NOT NULL,
  `title` varchar(225) NOT NULL,
  `akses` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `ikon` varchar(225) NOT NULL,
  `type` enum('text','material','') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `link` varchar(225) NOT NULL,
  `aktif` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu_tombol`
--

CREATE TABLE `menu_tombol` (
  `id` int NOT NULL,
  `id_menu` int NOT NULL,
  `text` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `akses` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `parent_id` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mobile`
--

CREATE TABLE `mobile` (
  `id` bigint NOT NULL,
  `lokasi` bigint DEFAULT NULL,
  `unique_id` varchar(50) NOT NULL,
  `aktivasi` varchar(255) DEFAULT NULL,
  `expired_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pendidikan`
--

CREATE TABLE `pendidikan` (
  `id` int NOT NULL,
  `tingkat` varchar(20) DEFAULT '0',
  `deskripsi_p` varchar(50) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `penghapusan`
--

CREATE TABLE `penghapusan` (
  `id` bigint NOT NULL,
  `lokasi` int NOT NULL,
  `id_pinj` int NOT NULL,
  `id_pinj_i` int NOT NULL,
  `nia` int NOT NULL,
  `saldo_pinjaman` varchar(255) NOT NULL,
  `tanggal` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personalia`
--

CREATE TABLE `personalia` (
  `id` bigint NOT NULL,
  `lokasi` bigint DEFAULT NULL,
  `sebutan` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pinjaman_anggota_1`
--

CREATE TABLE `pinjaman_anggota_1` (
  `id` int NOT NULL,
  `jenis_pinjaman` varchar(1) DEFAULT '0',
  `id_kel` varchar(30) DEFAULT '0',
  `id_pinkel` varchar(30) DEFAULT '0',
  `jenis_pp` int DEFAULT '0',
  `nia` varchar(30) DEFAULT '0',
  `tgl_proposal` date DEFAULT NULL,
  `tgl_verifikasi` date DEFAULT NULL,
  `tgl_dana` date DEFAULT NULL,
  `tgl_tunggu` date DEFAULT NULL,
  `tgl_cair` date DEFAULT NULL,
  `tgl_lunas` date DEFAULT NULL,
  `proposal` varchar(10) DEFAULT '0',
  `verifikasi` varchar(10) DEFAULT '0',
  `alokasi` varchar(10) DEFAULT '0',
  `kom_pokok` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `kom_jasa` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `spk_no` varchar(100) DEFAULT '0',
  `sumber` int DEFAULT '0',
  `pros_jasa` varchar(10) DEFAULT '0',
  `jenis_jasa` int DEFAULT '0',
  `jangka` varchar(10) DEFAULT '0',
  `sistem_angsuran` varchar(10) DEFAULT '0',
  `sa_jasa` int DEFAULT '0',
  `status` varchar(1) DEFAULT '0',
  `catatan_verifikasi` text,
  `lu` datetime DEFAULT NULL,
  `user_id` int DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pinjaman_kelompok_1`
--

CREATE TABLE `pinjaman_kelompok_1` (
  `id` int NOT NULL,
  `pinjaman_ke` int DEFAULT '1',
  `id_kel` varchar(30) DEFAULT '0',
  `jenis_pp` int DEFAULT '0',
  `tgl_proposal` date DEFAULT NULL,
  `tgl_verifikasi` date DEFAULT NULL,
  `tgl_dana` date DEFAULT NULL,
  `tgl_tunggu` date DEFAULT NULL,
  `tgl_cair` date DEFAULT NULL,
  `tgl_lunas` date DEFAULT NULL,
  `proposal` varchar(10) DEFAULT '0',
  `verifikasi` varchar(10) DEFAULT '0',
  `alokasi` varchar(10) DEFAULT '0',
  `spk_no` text,
  `sumber` int DEFAULT '0',
  `pros_jasa` varchar(10) DEFAULT '0',
  `jenis_jasa` int DEFAULT '0',
  `jangka` varchar(10) DEFAULT '0',
  `sistem_angsuran` varchar(10) DEFAULT '0',
  `sa_jasa` int DEFAULT '0',
  `status` varchar(1) DEFAULT '0',
  `catatan_verifikasi` text,
  `catatan_bimbingan` text,
  `struktur_kelompok` text,
  `waktu_verifikasi` time DEFAULT NULL,
  `wt_cair` varchar(150) DEFAULT '0',
  `lu` datetime DEFAULT NULL,
  `user_id` int DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `real_angsuran_1`
--

CREATE TABLE `real_angsuran_1` (
  `id` int NOT NULL,
  `loan_id` varchar(50) DEFAULT '0',
  `tgl_transaksi` date DEFAULT NULL,
  `realisasi_pokok` int DEFAULT '0',
  `realisasi_jasa` int DEFAULT '0',
  `sum_pokok` int DEFAULT '0',
  `sum_jasa` int DEFAULT '0',
  `saldo_pokok` int DEFAULT '0',
  `saldo_jasa` int DEFAULT '0',
  `tunggakan_pokok` int DEFAULT '0',
  `tunggakan_jasa` int DEFAULT '0',
  `lu` datetime DEFAULT NULL,
  `id_user` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rekening_1`
--

CREATE TABLE `rekening_1` (
  `parent_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lev1` int DEFAULT '0',
  `lev2` int DEFAULT '0',
  `lev3` int DEFAULT '0',
  `lev4` int DEFAULT '0',
  `kode_akun` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_akun` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '0',
  `jenis_mutasi` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '0',
  `tgl_nonaktif` date DEFAULT NULL,
  `saldo_awal` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '0',
  `tb2022` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '0',
  `tbk2022` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '0',
  `tb2021` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '0',
  `tbk2021` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '0',
  `tb2020` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `tbk2020` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `tb2019` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `tbk2019` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `tb2018` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `tbk2018` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `tb2017` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `tbk2017` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `tb2016` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `tbk2016` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `tb2015` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '''0''',
  `tbk2015` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '''0'''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rencana_angsuran_1`
--

CREATE TABLE `rencana_angsuran_1` (
  `id` int NOT NULL,
  `loan_id` varchar(50) DEFAULT '0',
  `angsuran_ke` varchar(3) DEFAULT '0',
  `jatuh_tempo` date DEFAULT NULL,
  `wajib_pokok` varchar(255) DEFAULT '0',
  `wajib_jasa` varchar(255) DEFAULT '0',
  `target_pokok` varchar(255) DEFAULT '0',
  `target_jasa` varchar(255) DEFAULT '0',
  `lu` datetime DEFAULT NULL,
  `id_user` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `saldo_1`
--

CREATE TABLE `saldo_1` (
  `id` varchar(50) NOT NULL,
  `kode_akun` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT ' kode akun, kode desa, kode kecamatan ',
  `tahun` bigint NOT NULL,
  `bulan` bigint NOT NULL,
  `debit` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '0' COMMENT 'saldo debit trx, saldo desa th lalu',
  `kredit` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '0' COMMENT 'saldo kredit trx, saldo desa sd. th ini'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sebutan_desa`
--

CREATE TABLE `sebutan_desa` (
  `id` int NOT NULL,
  `sebutan_desa` varchar(20) DEFAULT '0',
  `sebutan_kades` varchar(50) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `sistem_angsuran`
--

CREATE TABLE `sistem_angsuran` (
  `id` int NOT NULL,
  `nama_sistem` varchar(20) DEFAULT '0',
  `deskripsi_sistem` varchar(50) DEFAULT '0',
  `sistem` int DEFAULT '0',
  `urutan` int DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `status_pinjaman`
--

CREATE TABLE `status_pinjaman` (
  `id` int NOT NULL,
  `kd_status` varchar(1) DEFAULT '0',
  `nama_status` varchar(50) DEFAULT '0',
  `deskripsi` varchar(100) DEFAULT '0',
  `warna_status` varchar(50) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `struktur_kelompok`
--

CREATE TABLE `struktur_kelompok` (
  `id` int NOT NULL,
  `lokasi` int NOT NULL,
  `kd_kelompok` varchar(50) NOT NULL,
  `ketua` varchar(50) NOT NULL,
  `sekretaris` varchar(50) NOT NULL,
  `bendahara` varchar(50) NOT NULL,
  `awal_jabatan` date NOT NULL,
  `akhir_jabatan` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `sub_laporan`
--

CREATE TABLE `sub_laporan` (
  `id` int NOT NULL,
  `nama_laporan` varchar(50) DEFAULT '0',
  `file` varchar(5) DEFAULT '0',
  `file_kab` varchar(5) DEFAULT '0',
  `urut` int DEFAULT '0',
  `id_lap` int DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tanda_tangan`
--

CREATE TABLE `tanda_tangan` (
  `id` int NOT NULL,
  `idu` int DEFAULT '0',
  `penandatangan` text,
  `level` int DEFAULT '0',
  `deskripsi` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tanda_tangan_dokumen`
--

CREATE TABLE `tanda_tangan_dokumen` (
  `id` bigint NOT NULL,
  `lokasi` bigint DEFAULT NULL,
  `dokumen_pinjaman_id` bigint DEFAULT NULL,
  `tanda_tangan` longtext,
  `jenis_laporan` enum('dokumen_pinjaman','pelaporan') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tanda_tangan_laporan`
--

CREATE TABLE `tanda_tangan_laporan` (
  `id` int NOT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanda_tangan_pelaporan` text COLLATE utf8mb4_general_ci,
  `tanda_tangan_spk` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tingkat_kelompok`
--

CREATE TABLE `tingkat_kelompok` (
  `id` int NOT NULL,
  `nama_tk` varchar(20) DEFAULT '0',
  `deskripsi_tk` varchar(50) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_1`
--

CREATE TABLE `transaksi_1` (
  `idt` int NOT NULL,
  `tgl_transaksi` date DEFAULT NULL,
  `rekening_debit` varchar(10) DEFAULT '0',
  `rekening_kredit` varchar(10) DEFAULT '0',
  `idtp` int DEFAULT '0',
  `id_pinj` int DEFAULT '0',
  `id_pinj_i` int DEFAULT '0',
  `keterangan_transaksi` text,
  `relasi` text,
  `jumlah` varchar(50) DEFAULT '0',
  `urutan` int DEFAULT '0',
  `id_user` int DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Triggers `transaksi_1`
--
DELIMITER $$
CREATE TRIGGER `create_saldo_1` AFTER INSERT ON `transaksi_1` FOR EACH ROW BEGIN
            DECLARE newTahun INT;
            DECLARE newBulan VARCHAR(2);
            DECLARE saldoDebitRekDebit DOUBLE;
            DECLARE saldoKreditRekDebit DOUBLE;
            DECLARE saldoDebitRekKredit DOUBLE;
            DECLARE saldoKreditRekKredit DOUBLE;

            SET newTahun = YEAR(NEW.tgl_transaksi);
            SET newBulan = LPAD(MONTH(NEW.tgl_transaksi), 2, '0');

            SET saldoDebitRekDebit = COALESCE((SELECT SUM(jumlah) FROM transaksi_1 WHERE rekening_debit = NEW.rekening_debit AND YEAR(tgl_transaksi) = newTahun AND MONTH(tgl_transaksi) <= newBulan AND deleted_at IS NULL), 0);
            SET saldoKreditRekDebit = COALESCE((SELECT SUM(jumlah) FROM transaksi_1 WHERE rekening_kredit = NEW.rekening_debit AND YEAR(tgl_transaksi) = newTahun AND MONTH(tgl_transaksi) <= newBulan AND deleted_at IS NULL), 0);
            SET saldoDebitRekKredit = COALESCE((SELECT SUM(jumlah) FROM transaksi_1 WHERE rekening_debit = NEW.rekening_kredit AND YEAR(tgl_transaksi) = newTahun AND MONTH(tgl_transaksi) <= newBulan AND deleted_at IS NULL), 0);
            SET saldoKreditRekKredit = COALESCE((SELECT SUM(jumlah) FROM transaksi_1 WHERE rekening_kredit = NEW.rekening_kredit AND YEAR(tgl_transaksi) = newTahun AND MONTH(tgl_transaksi) <= newBulan AND deleted_at IS NULL), 0);

            INSERT INTO saldo_1 (`id`, `kode_akun`, `tahun`, `bulan`, `debit`, `kredit`)
            VALUES (
                CONCAT(REPLACE(NEW.rekening_debit, '.', ''), newTahun, newBulan), 
                NEW.rekening_debit, 
                newTahun, 
                newBulan, 
                saldoDebitRekDebit, 
                saldoKreditRekDebit
            )
            ON DUPLICATE KEY UPDATE debit = saldoDebitRekDebit, kredit = saldoKreditRekDebit;

            INSERT INTO saldo_1 (`id`, `kode_akun`, `tahun`, `bulan`, `debit`, `kredit`)
            VALUES (
                CONCAT(REPLACE(NEW.rekening_kredit, '.', ''), newTahun, newBulan), 
                NEW.rekening_kredit, 
                newTahun, 
                newBulan, 
                saldoDebitRekKredit, 
                saldoKreditRekKredit
            )
            ON DUPLICATE KEY UPDATE debit = saldoDebitRekKredit, kredit = saldoKreditRekKredit;
        END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `delete_saldo_1` AFTER DELETE ON `transaksi_1` FOR EACH ROW BEGIN
            DECLARE oldTahun INT;
            DECLARE oldBulan VARCHAR(2);
            DECLARE saldoDebitRekDebit DOUBLE;
            DECLARE saldoKreditRekDebit DOUBLE;
            DECLARE saldoDebitRekKredit DOUBLE;
            DECLARE saldoKreditRekKredit DOUBLE;

            SET oldTahun = YEAR(OLD.tgl_transaksi);
            SET oldBulan = LPAD(MONTH(OLD.tgl_transaksi), 2, '0');

            SET saldoDebitRekDebit = COALESCE((SELECT SUM(jumlah) FROM transaksi_1 WHERE rekening_debit = OLD.rekening_debit AND YEAR(tgl_transaksi) = oldTahun AND MONTH(tgl_transaksi) <= oldBulan AND deleted_at IS NULL), 0);
            SET saldoKreditRekDebit = COALESCE((SELECT SUM(jumlah) FROM transaksi_1 WHERE rekening_kredit = OLD.rekening_debit AND YEAR(tgl_transaksi) = oldTahun AND MONTH(tgl_transaksi) <= oldBulan AND deleted_at IS NULL), 0);
            SET saldoDebitRekKredit = COALESCE((SELECT SUM(jumlah) FROM transaksi_1 WHERE rekening_debit = OLD.rekening_kredit AND YEAR(tgl_transaksi) = oldTahun AND MONTH(tgl_transaksi) <= oldBulan AND deleted_at IS NULL), 0);
            SET saldoKreditRekKredit = COALESCE((SELECT SUM(jumlah) FROM transaksi_1 WHERE rekening_kredit = OLD.rekening_kredit AND YEAR(tgl_transaksi) = oldTahun AND MONTH(tgl_transaksi) <= oldBulan AND deleted_at IS NULL), 0);

            INSERT INTO saldo_1 (`id`, `kode_akun`, `tahun`, `bulan`, `debit`, `kredit`)
            VALUES (
                CONCAT(REPLACE(OLD.rekening_debit, '.', ''), oldTahun, oldBulan), 
                OLD.rekening_debit, 
                oldTahun, 
                oldBulan, 
                saldoDebitRekDebit, 
                saldoKreditRekDebit
            )
            ON DUPLICATE KEY UPDATE debit = saldoDebitRekDebit, kredit = saldoKreditRekDebit;

            INSERT INTO saldo_1 (`id`, `kode_akun`, `tahun`, `bulan`, `debit`, `kredit`)
            VALUES (
                CONCAT(REPLACE(OLD.rekening_kredit, '.', ''), oldTahun, oldBulan), 
                OLD.rekening_kredit, 
                oldTahun, 
                oldBulan, 
                saldoDebitRekKredit, 
                saldoKreditRekKredit
            )
            ON DUPLICATE KEY UPDATE debit = saldoDebitRekKredit, kredit = saldoKreditRekKredit;
        END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_saldo_1` AFTER UPDATE ON `transaksi_1` FOR EACH ROW BEGIN
            DECLARE newTahun INT;
            DECLARE newBulan VARCHAR(2);
            DECLARE oldTahun INT;
            DECLARE oldBulan VARCHAR(2);
            DECLARE needsUpdate BOOLEAN;

            DECLARE newSaldoDebitRekDebit DOUBLE;
            DECLARE newSaldoKreditRekDebit DOUBLE;
            DECLARE newSaldoDebitRekKredit DOUBLE;
            DECLARE newSaldoKreditRekKredit DOUBLE;

            DECLARE oldSaldoDebitRekDebit DOUBLE;
            DECLARE oldSaldoKreditRekDebit DOUBLE;
            DECLARE oldSaldoDebitRekKredit DOUBLE;
            DECLARE oldSaldoKreditRekKredit DOUBLE;

            SET newTahun = YEAR(NEW.tgl_transaksi);
            SET newBulan = LPAD(MONTH(NEW.tgl_transaksi), 2, '0');
            SET oldTahun = YEAR(OLD.tgl_transaksi);
            SET oldBulan = LPAD(MONTH(OLD.tgl_transaksi), 2, '0');

            SET needsUpdate = (
                OLD.jumlah != NEW.jumlah OR 
                oldTahun != newTahun OR 
                oldBulan != newBulan OR
                OLD.rekening_debit != NEW.rekening_debit OR
                OLD.rekening_kredit != NEW.rekening_kredit OR 
                (OLD.deleted_at IS NULL AND NEW.deleted_at IS NOT NULL) OR
                (OLD.deleted_at IS NOT NULL AND NEW.deleted_at IS NULL)
            );

            IF needsUpdate THEN
                
                SET newSaldoDebitRekDebit = COALESCE((SELECT SUM(jumlah) FROM transaksi_1 WHERE rekening_debit = NEW.rekening_debit AND YEAR(tgl_transaksi) = newTahun AND MONTH(tgl_transaksi) <= newBulan AND deleted_at IS NULL), 0);
                SET newSaldoKreditRekDebit = COALESCE((SELECT SUM(jumlah) FROM transaksi_1 WHERE rekening_kredit = NEW.rekening_debit AND YEAR(tgl_transaksi) = newTahun AND MONTH(tgl_transaksi) <= newBulan AND deleted_at IS NULL), 0);
                SET newSaldoDebitRekKredit = COALESCE((SELECT SUM(jumlah) FROM transaksi_1 WHERE rekening_debit = NEW.rekening_kredit AND YEAR(tgl_transaksi) = newTahun AND MONTH(tgl_transaksi) <= newBulan AND deleted_at IS NULL), 0);
                SET newSaldoKreditRekKredit = COALESCE((SELECT SUM(jumlah) FROM transaksi_1 WHERE rekening_kredit = NEW.rekening_kredit AND YEAR(tgl_transaksi) = newTahun AND MONTH(tgl_transaksi) <= newBulan AND deleted_at IS NULL), 0);

                INSERT INTO saldo_1 (`id`, `kode_akun`, `tahun`, `bulan`, `debit`, `kredit`)
                VALUES (
                    CONCAT(REPLACE(NEW.rekening_debit, '.', ''), newTahun, newBulan), 
                    NEW.rekening_debit, 
                    newTahun, 
                    newBulan, 
                    newSaldoDebitRekDebit, 
                    newSaldoKreditRekDebit
                )
                ON DUPLICATE KEY UPDATE debit = newSaldoDebitRekDebit, kredit = newSaldoKreditRekDebit;

                INSERT INTO saldo_1 (`id`, `kode_akun`, `tahun`, `bulan`, `debit`, `kredit`)
                VALUES (
                    CONCAT(REPLACE(NEW.rekening_kredit, '.', ''), newTahun, newBulan), 
                    NEW.rekening_kredit, 
                    newTahun, 
                    newBulan, 
                    newSaldoDebitRekKredit, 
                    newSaldoKreditRekKredit
                )
                ON DUPLICATE KEY UPDATE debit = newSaldoDebitRekKredit, kredit = newSaldoKreditRekKredit;

                IF (oldTahun != newTahun OR oldBulan != newBulan OR OLD.rekening_debit != NEW.rekening_debit OR OLD.rekening_kredit != NEW.rekening_kredit) THEN
                    
                    SET oldSaldoDebitRekDebit = COALESCE((SELECT SUM(jumlah) FROM transaksi_1 WHERE rekening_debit = OLD.rekening_debit AND YEAR(tgl_transaksi) = oldTahun AND MONTH(tgl_transaksi) <= oldBulan AND deleted_at IS NULL), 0);
                    SET oldSaldoKreditRekDebit = COALESCE((SELECT SUM(jumlah) FROM transaksi_1 WHERE rekening_kredit = OLD.rekening_debit AND YEAR(tgl_transaksi) = oldTahun AND MONTH(tgl_transaksi) <= oldBulan AND deleted_at IS NULL), 0);
                    SET oldSaldoDebitRekKredit = COALESCE((SELECT SUM(jumlah) FROM transaksi_1 WHERE rekening_debit = OLD.rekening_kredit AND YEAR(tgl_transaksi) = oldTahun AND MONTH(tgl_transaksi) <= oldBulan AND deleted_at IS NULL), 0);
                    SET oldSaldoKreditRekKredit = COALESCE((SELECT SUM(jumlah) FROM transaksi_1 WHERE rekening_kredit = OLD.rekening_kredit AND YEAR(tgl_transaksi) = oldTahun AND MONTH(tgl_transaksi) <= oldBulan AND deleted_at IS NULL), 0);
                
                    INSERT INTO saldo_1 (`id`, `kode_akun`, `tahun`, `bulan`, `debit`, `kredit`)
                    VALUES (
                        CONCAT(REPLACE(OLD.rekening_debit, '.', ''), oldTahun, oldBulan), 
                        OLD.rekening_debit, 
                        oldTahun, 
                        oldBulan, 
                        oldSaldoDebitRekDebit, 
                        oldSaldoKreditRekDebit
                    )
                    ON DUPLICATE KEY UPDATE debit = oldSaldoDebitRekDebit, kredit = oldSaldoKreditRekDebit;

                    INSERT INTO saldo_1 (`id`, `kode_akun`, `tahun`, `bulan`, `debit`, `kredit`)
                    VALUES (
                        CONCAT(REPLACE(OLD.rekening_kredit, '.', ''), oldTahun, oldBulan), 
                        OLD.rekening_kredit, 
                        oldTahun, 
                        oldBulan, 
                        oldSaldoDebitRekKredit, 
                        oldSaldoKreditRekKredit
                    )
                    ON DUPLICATE KEY UPDATE debit = oldSaldoDebitRekKredit, kredit = oldSaldoKreditRekKredit;
                END IF;
            END IF;
        END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_tanggal` BEFORE UPDATE ON `transaksi_1` FOR EACH ROW BEGIN

    DECLARE newTanggalTransaksi DATE;
    DECLARE oldTanggalTransaksi DATE;

    SET newTanggalTransaksi = NEW.tgl_transaksi;
    SET oldTanggalTransaksi = OLD.tgl_transaksi;

    IF newTanggalTransaksi != oldTanggalTransaksi THEN
        SET NEW.updated_at = CONCAT(newTanggalTransaksi, ' ', CURRENT_TIME());
    END IF;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_tanggal_1` BEFORE UPDATE ON `transaksi_1` FOR EACH ROW BEGIN
            IF NEW.tgl_transaksi != OLD.tgl_transaksi THEN
                SET NEW.updated_at = CONCAT(NEW.tgl_transaksi, ' ', CURRENT_TIME());
            END IF;
        END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `unit_usaha`
--

CREATE TABLE `unit_usaha` (
  `id` int NOT NULL,
  `nama_unit` varchar(20) DEFAULT '0',
  `deskripsi_unit` varchar(50) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `usaha`
--

CREATE TABLE `usaha` (
  `id` int NOT NULL,
  `jenis_kegiatan` int DEFAULT '0',
  `nama_usaha` varchar(100) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `namadepan` varchar(100) DEFAULT '0',
  `namabelakang` varchar(100) DEFAULT '0',
  `ins` varchar(2) DEFAULT '0',
  `jk` char(1) DEFAULT '0',
  `tempat_lahir` varchar(30) DEFAULT '0',
  `tgl_lahir` date DEFAULT NULL,
  `alamat` text,
  `hp` varchar(20) DEFAULT '0',
  `nik` char(16) DEFAULT '0',
  `pendidikan` int DEFAULT '0',
  `jabatan` int DEFAULT '0',
  `level` int DEFAULT '0',
  `unit` int DEFAULT '0',
  `lokasi` varchar(11) DEFAULT '0',
  `sejak` date DEFAULT NULL,
  `hingga` date DEFAULT NULL,
  `foto` varchar(250) DEFAULT '0',
  `status` varchar(1) DEFAULT '0',
  `online` varchar(1) DEFAULT '0',
  `lo` datetime DEFAULT NULL,
  `ip` varchar(30) DEFAULT '0',
  `kunjungan` int DEFAULT '0',
  `nilai` int DEFAULT '0',
  `mutiara` text,
  `uname` varchar(20) DEFAULT '0',
  `pass` varchar(50) DEFAULT '0',
  `akses_menu` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `akses_tombol` text CHARACTER SET latin1 COLLATE latin1_swedish_ci
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` bigint NOT NULL,
  `user_id` bigint DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `token` text,
  `abilities` varchar(255) DEFAULT NULL,
  `tokenable_id` bigint NOT NULL,
  `tokenable_type` varchar(225) NOT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `whatsapp`
--

CREATE TABLE `whatsapp` (
  `id` int NOT NULL,
  `lokasi` int NOT NULL,
  `nama` varchar(50) NOT NULL,
  `token` varchar(50) NOT NULL,
  `deletedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wilayah`
--

CREATE TABLE `wilayah` (
  `kode` varchar(13) NOT NULL,
  `nama` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_buku`
--
ALTER TABLE `admin_buku`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nama_jb` (`nama_jb`,`icon`,`posisi`,`file`);

--
-- Indexes for table `admin_invoice`
--
ALTER TABLE `admin_invoice`
  ADD PRIMARY KEY (`idv`),
  ADD KEY `lokasi` (`lokasi`,`jenis_pembayaran`,`tgl_invoice`,`tgl_lunas`,`status`,`jumlah`,`id_user`);

--
-- Indexes for table `admin_jenis_pembayaran`
--
ALTER TABLE `admin_jenis_pembayaran`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `admin_jenis_pembayaran` ADD FULLTEXT KEY `nama_jp` (`nama_jp`);

--
-- Indexes for table `admin_rekening`
--
ALTER TABLE `admin_rekening`
  ADD PRIMARY KEY (`kd_rekening`),
  ADD KEY `kd_jb` (`kd_jb`,`nama_rekening`,`pasangan`,`tb2014`,`tb2015`,`tb2016`,`posisi`,`tb2017`,`jenis_mutasi`);

--
-- Indexes for table `admin_transaksi`
--
ALTER TABLE `admin_transaksi`
  ADD PRIMARY KEY (`idt`),
  ADD KEY `tgl_transaksi` (`tgl_transaksi`,`rekening_debit`,`rekening_kredit`,`idv`,`jumlah`,`urutan`,`id_user`);
ALTER TABLE `admin_transaksi` ADD FULLTEXT KEY `keterangan_transaksi` (`keterangan_transaksi`);

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `akun_level_1`
--
ALTER TABLE `akun_level_1`
  ADD PRIMARY KEY (`kode_akun`,`id`) USING BTREE;

--
-- Indexes for table `akun_level_2`
--
ALTER TABLE `akun_level_2`
  ADD PRIMARY KEY (`kode_akun`,`id`) USING BTREE;

--
-- Indexes for table `akun_level_3`
--
ALTER TABLE `akun_level_3`
  ADD PRIMARY KEY (`kode_akun`,`id`) USING BTREE;

--
-- Indexes for table `anggota_1`
--
ALTER TABLE `anggota_1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `api_endpoint`
--
ALTER TABLE `api_endpoint`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_update`
--
ALTER TABLE `app_update`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `arus_kas`
--
ALTER TABLE `arus_kas`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `calk`
--
ALTER TABLE `calk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_pemanfaat`
--
ALTER TABLE `data_pemanfaat`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `desa`
--
ALTER TABLE `desa`
  ADD PRIMARY KEY (`id`,`kd_desa`);

--
-- Indexes for table `dokumen_pinjaman`
--
ALTER TABLE `dokumen_pinjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ebudgeting_1`
--
ALTER TABLE `ebudgeting_1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fungsi_kelompok`
--
ALTER TABLE `fungsi_kelompok`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `nama_fgs` (`nama_fgs`,`deskripsi_fgs`) USING BTREE;

--
-- Indexes for table `inventaris_1`
--
ALTER TABLE `inventaris_1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `jenis_jasa`
--
ALTER TABLE `jenis_jasa`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `jenis_kegiatan`
--
ALTER TABLE `jenis_kegiatan`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `jenis_laporan`
--
ALTER TABLE `jenis_laporan`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `jenis_laporan_pinjaman`
--
ALTER TABLE `jenis_laporan_pinjaman`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `nama_laporan` (`nama_laporan`,`file`,`status`,`urut`) USING BTREE;

--
-- Indexes for table `jenis_produk_pinjaman`
--
ALTER TABLE `jenis_produk_pinjaman`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `nama_jpp` (`nama_jpp`) USING BTREE,
  ADD KEY `deskripsi_jpp` (`deskripsi_jpp`) USING BTREE,
  ADD KEY `warna_jpp` (`warna_jpp`) USING BTREE,
  ADD KEY `kd_kab` (`kd_kab`) USING BTREE;
ALTER TABLE `jenis_produk_pinjaman` ADD FULLTEXT KEY `lokasi` (`lokasi`);
ALTER TABLE `jenis_produk_pinjaman` ADD FULLTEXT KEY `kecuali` (`kecuali`);

--
-- Indexes for table `jenis_transaksi`
--
ALTER TABLE `jenis_transaksi`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `jenis_usaha`
--
ALTER TABLE `jenis_usaha`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `kabupaten`
--
ALTER TABLE `kabupaten`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `kelompok_1`
--
ALTER TABLE `kelompok_1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keluarga`
--
ALTER TABLE `keluarga`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_tombol`
--
ALTER TABLE `menu_tombol`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mobile`
--
ALTER TABLE `mobile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pendidikan`
--
ALTER TABLE `pendidikan`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `penghapusan`
--
ALTER TABLE `penghapusan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personalia`
--
ALTER TABLE `personalia`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pinjaman_anggota_1`
--
ALTER TABLE `pinjaman_anggota_1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pinjaman_kelompok_1`
--
ALTER TABLE `pinjaman_kelompok_1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `real_angsuran_1`
--
ALTER TABLE `real_angsuran_1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rekening_1`
--
ALTER TABLE `rekening_1`
  ADD PRIMARY KEY (`kode_akun`);

--
-- Indexes for table `rencana_angsuran_1`
--
ALTER TABLE `rencana_angsuran_1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `saldo_1`
--
ALTER TABLE `saldo_1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sebutan_desa`
--
ALTER TABLE `sebutan_desa`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `sistem_angsuran`
--
ALTER TABLE `sistem_angsuran`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `nama_sistem` (`nama_sistem`,`deskripsi_sistem`,`sistem`) USING BTREE;

--
-- Indexes for table `status_pinjaman`
--
ALTER TABLE `status_pinjaman`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `struktur_kelompok`
--
ALTER TABLE `struktur_kelompok`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `sub_laporan`
--
ALTER TABLE `sub_laporan`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tanda_tangan`
--
ALTER TABLE `tanda_tangan`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tanda_tangan_dokumen`
--
ALTER TABLE `tanda_tangan_dokumen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tanda_tangan_laporan`
--
ALTER TABLE `tanda_tangan_laporan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tingkat_kelompok`
--
ALTER TABLE `tingkat_kelompok`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `transaksi_1`
--
ALTER TABLE `transaksi_1`
  ADD PRIMARY KEY (`idt`);

--
-- Indexes for table `unit_usaha`
--
ALTER TABLE `unit_usaha`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `usaha`
--
ALTER TABLE `usaha`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `whatsapp`
--
ALTER TABLE `whatsapp`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_buku`
--
ALTER TABLE `admin_buku`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_invoice`
--
ALTER TABLE `admin_invoice`
  MODIFY `idv` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_jenis_pembayaran`
--
ALTER TABLE `admin_jenis_pembayaran`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_transaksi`
--
ALTER TABLE `admin_transaksi`
  MODIFY `idt` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `anggota_1`
--
ALTER TABLE `anggota_1`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `api_endpoint`
--
ALTER TABLE `api_endpoint`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_update`
--
ALTER TABLE `app_update`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `arus_kas`
--
ALTER TABLE `arus_kas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `calk`
--
ALTER TABLE `calk`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_pemanfaat`
--
ALTER TABLE `data_pemanfaat`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `desa`
--
ALTER TABLE `desa`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dokumen_pinjaman`
--
ALTER TABLE `dokumen_pinjaman`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ebudgeting_1`
--
ALTER TABLE `ebudgeting_1`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fungsi_kelompok`
--
ALTER TABLE `fungsi_kelompok`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventaris_1`
--
ALTER TABLE `inventaris_1`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_jasa`
--
ALTER TABLE `jenis_jasa`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_kegiatan`
--
ALTER TABLE `jenis_kegiatan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_laporan`
--
ALTER TABLE `jenis_laporan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_laporan_pinjaman`
--
ALTER TABLE `jenis_laporan_pinjaman`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_produk_pinjaman`
--
ALTER TABLE `jenis_produk_pinjaman`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_transaksi`
--
ALTER TABLE `jenis_transaksi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_usaha`
--
ALTER TABLE `jenis_usaha`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kabupaten`
--
ALTER TABLE `kabupaten`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kecamatan`
--
ALTER TABLE `kecamatan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelompok_1`
--
ALTER TABLE `kelompok_1`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `keluarga`
--
ALTER TABLE `keluarga`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu_tombol`
--
ALTER TABLE `menu_tombol`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mobile`
--
ALTER TABLE `mobile`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pendidikan`
--
ALTER TABLE `pendidikan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penghapusan`
--
ALTER TABLE `penghapusan`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personalia`
--
ALTER TABLE `personalia`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pinjaman_anggota_1`
--
ALTER TABLE `pinjaman_anggota_1`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pinjaman_kelompok_1`
--
ALTER TABLE `pinjaman_kelompok_1`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rencana_angsuran_1`
--
ALTER TABLE `rencana_angsuran_1`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sebutan_desa`
--
ALTER TABLE `sebutan_desa`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sistem_angsuran`
--
ALTER TABLE `sistem_angsuran`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `status_pinjaman`
--
ALTER TABLE `status_pinjaman`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `struktur_kelompok`
--
ALTER TABLE `struktur_kelompok`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_laporan`
--
ALTER TABLE `sub_laporan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tanda_tangan`
--
ALTER TABLE `tanda_tangan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tanda_tangan_dokumen`
--
ALTER TABLE `tanda_tangan_dokumen`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tanda_tangan_laporan`
--
ALTER TABLE `tanda_tangan_laporan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tingkat_kelompok`
--
ALTER TABLE `tingkat_kelompok`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi_1`
--
ALTER TABLE `transaksi_1`
  MODIFY `idt` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `unit_usaha`
--
ALTER TABLE `unit_usaha`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usaha`
--
ALTER TABLE `usaha`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `whatsapp`
--
ALTER TABLE `whatsapp`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
