-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 18, 2022 at 10:02 PM
-- Server version: 8.0.29-0ubuntu0.20.04.3
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpusqu`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id` int NOT NULL,
  `nis` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(256) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `telepon` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `kelas_id` int NOT NULL,
  `gambar` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `dibuat_pada` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `diedit_pada` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id` int NOT NULL,
  `isbn` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `judul` varchar(128) NOT NULL,
  `pengarang` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `penerbit` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tahun_terbit` char(4) NOT NULL,
  `jumlah_buku` int NOT NULL,
  `kategori_id` int NOT NULL,
  `lokasi_id` int NOT NULL,
  `total_halaman` int NOT NULL,
  `harga` int NOT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `sampul` varchar(64) NOT NULL,
  `peminat` int DEFAULT NULL,
  `dibuat_pada` varchar(64) NOT NULL,
  `diedit_pada` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `buku_hilang`
--

CREATE TABLE `buku_hilang` (
  `id` int NOT NULL,
  `buku_id` int NOT NULL,
  `jumlah_buku` int NOT NULL,
  `harga` int NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  `status` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `catatan_pengguna`
--

CREATE TABLE `catatan_pengguna` (
  `id` int NOT NULL,
  `pengguna_id` int NOT NULL,
  `isi_catatan` text NOT NULL,
  `dibuat_pada` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `denda`
--

CREATE TABLE `denda` (
  `id` int NOT NULL,
  `besaran_denda` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `denda`
--

INSERT INTO `denda` (`id`, `besaran_denda`) VALUES
(1, 500);

-- --------------------------------------------------------

--
-- Table structure for table `detail_peminjaman`
--

CREATE TABLE `detail_peminjaman` (
  `id` int NOT NULL,
  `peminjaman_id` int NOT NULL,
  `buku_id` int NOT NULL,
  `jumlah_buku` int NOT NULL,
  `tanggal_peminjaman` date NOT NULL,
  `tanggal_dikembalikan` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `informasi`
--

CREATE TABLE `informasi` (
  `id` int NOT NULL,
  `nama_perpustakaan` varchar(128) NOT NULL,
  `alamat` text NOT NULL,
  `website` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(128) NOT NULL,
  `tentang` text NOT NULL,
  `dibuat_pada` varchar(64) NOT NULL,
  `diedit_pada` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `informasi`
--

INSERT INTO `informasi` (`id`, `nama_perpustakaan`, `alamat`, `website`, `email`, `tentang`, `dibuat_pada`, `diedit_pada`) VALUES
(1, 'Perpustakaan Ngawi', 'Jl. Pancasila', 'https://perpusqu.herokuapp.com', 'ngawiperpus@gmail.com', 'Perpustakaan sekolah yang bertujuan untuk meminjamkan buku kepada siswa dan siswi sebagai usaha sekolah agar memperdalam literasi membaca buku. Perpustakaan ini juga mengelola dan merawat buku lama dan baru.', UNIX_TIMESTAMP(), UNIX_TIMESTAMP());

-- --------------------------------------------------------

--
-- Table structure for table `kas`
--

CREATE TABLE `kas` (
  `id` int NOT NULL,
  `tabel_id` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `besaran_kas` int NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  `tipe_kas` enum('pemasukan','pengeluaran') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori_buku`
--

CREATE TABLE `kategori_buku` (
  `id` int NOT NULL,
  `nama_kategori` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kelas_anggota`
--

CREATE TABLE `kelas_anggota` (
  `id` int NOT NULL,
  `nama_kelas` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lokasi_buku`
--

CREATE TABLE `lokasi_buku` (
  `id` int NOT NULL,
  `nama_lokasi` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id` int NOT NULL,
  `isi_notifikasi` text NOT NULL,
  `dibuat_pada` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `online`
--

CREATE TABLE `online` (
  `id` int NOT NULL,
  `login_id` int NOT NULL,
  `type` varchar(32) NOT NULL,
  `terakhir_dilihat` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` int NOT NULL,
  `anggota_id` int NOT NULL,
  `pengguna_id` int NOT NULL,
  `tanggal_peminjaman` date NOT NULL,
  `batas_pengembalian` date NOT NULL,
  `tanggal_dikembalikan` date DEFAULT NULL,
  `denda` int NOT NULL,
  `denda_dibayarkan` int NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int NOT NULL,
  `username` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `alamat` text NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `telepon` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `role` enum('admin','petugas') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `dibuat_pada` varchar(64) NOT NULL,
  `diedit_pada` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `username`, `password`, `nama`, `alamat`, `jenis_kelamin`, `telepon`, `role`, `dibuat_pada`, `diedit_pada`) VALUES
(1, 'admin', '$2y$10$bzSGM6YizIjYcMo6Ol9q.O7io.Esm9KMjrwGCWEgc.oakdFCM9EZi', 'Steven Johannes', 'Jl. Pancasila', 'Laki-laki', '81234567890', 'admin', UNIX_TIMESTAMP(), UNIX_TIMESTAMP());

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelas` (`kelas_id`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategori` (`kategori_id`),
  ADD KEY `lokasi` (`lokasi_id`);

--
-- Indexes for table `buku_hilang`
--
ALTER TABLE `buku_hilang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buku_id` (`buku_id`);

--
-- Indexes for table `catatan_pengguna`
--
ALTER TABLE `catatan_pengguna`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengguna_id` (`pengguna_id`);

--
-- Indexes for table `denda`
--
ALTER TABLE `denda`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `judul_buku` (`buku_id`),
  ADD KEY `transaksi_id` (`peminjaman_id`);

--
-- Indexes for table `informasi`
--
ALTER TABLE `informasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kas`
--
ALTER TABLE `kas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_buku`
--
ALTER TABLE `kategori_buku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas_anggota`
--
ALTER TABLE `kelas_anggota`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lokasi_buku`
--
ALTER TABLE `lokasi_buku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `online`
--
ALTER TABLE `online`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `anggota_id` (`anggota_id`),
  ADD KEY `pengguna_id` (`pengguna_id`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `buku_hilang`
--
ALTER TABLE `buku_hilang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `catatan_pengguna`
--
ALTER TABLE `catatan_pengguna`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `denda`
--
ALTER TABLE `denda`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `informasi`
--
ALTER TABLE `informasi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kas`
--
ALTER TABLE `kas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori_buku`
--
ALTER TABLE `kategori_buku`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelas_anggota`
--
ALTER TABLE `kelas_anggota`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lokasi_buku`
--
ALTER TABLE `lokasi_buku`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `online`
--
ALTER TABLE `online`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
