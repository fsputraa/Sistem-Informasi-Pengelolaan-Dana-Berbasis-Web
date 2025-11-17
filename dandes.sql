-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Sep 2025 pada 15.08
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dandes`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_dana_keluar`
--

CREATE TABLE `tb_dana_keluar` (
  `id_dana_keluar` int(11) NOT NULL,
  `id_kelurahan` int(11) NOT NULL,
  `no_surat` varchar(100) NOT NULL,
  `jml_biaya` double NOT NULL,
  `tgl_keluar` date NOT NULL,
  `kebutuhan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_dana_keluar`
--

INSERT INTO `tb_dana_keluar` (`id_dana_keluar`, `id_kelurahan`, `no_surat`, `jml_biaya`, `tgl_keluar`, `kebutuhan`) VALUES
(35, 9, 'PBM-001', 1111111, '2025-07-31', 'Aspal'),
(36, 9, 'PBM0012W', 5000000, '2025-08-01', 'Kas'),
(39, 9, 'PBM0012W', 5000000, '2025-08-03', 'Kas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_dana_masuk`
--

CREATE TABLE `tb_dana_masuk` (
  `id_dana_masuk` int(11) NOT NULL,
  `id_instansi` int(11) NOT NULL,
  `id_kelurahan` int(11) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `no_surat` varchar(100) DEFAULT NULL,
  `saldo_awal` double NOT NULL,
  `keperluan` varchar(100) NOT NULL,
  `sisa_saldo` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_dana_masuk`
--

INSERT INTO `tb_dana_masuk` (`id_dana_masuk`, `id_instansi`, `id_kelurahan`, `tgl_masuk`, `no_surat`, `saldo_awal`, `keperluan`, `sisa_saldo`) VALUES
(39, 3, 9, '2025-07-31', 'PBM-001', 50000000, 'Jalan', 0),
(40, 3, 9, '2025-07-31', 'SK-1111', 10000000, 'Kas', 0),
(41, 3, 9, '2025-08-01', 'PBM0012W', 10000000, 'Kas', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_instansi`
--

CREATE TABLE `tb_instansi` (
  `id_instansi` int(11) NOT NULL,
  `nama_instansi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_instansi`
--

INSERT INTO `tb_instansi` (`id_instansi`, `nama_instansi`) VALUES
(3, 'Pemerintah Kota Prabumulih');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kelurahan`
--

CREATE TABLE `tb_kelurahan` (
  `id_kelurahan` int(11) NOT NULL,
  `nama_kelurahan` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `kepala_kelurahan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_kelurahan`
--

INSERT INTO `tb_kelurahan` (`id_kelurahan`, `nama_kelurahan`, `alamat`, `kepala_kelurahan`) VALUES
(9, 'Gunung Kemala', 'Gunung Kemala', 'Kelpin Padilah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_lpj`
--

CREATE TABLE `tb_lpj` (
  `id_lpj` int(11) NOT NULL,
  `id_dana_keluar` int(11) DEFAULT NULL,
  `no_surat` varchar(100) NOT NULL,
  `file_lpj` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `level` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `nama_lengkap`, `level`) VALUES
(4, 'Seklur', 'Seklur', 'Tatak', 'admin'),
(7, 'Bendahara', 'Bendahara', 'Bendahara', 'user'),
(12, 'admin', 'admin', 'Kelpin Padilah', 'admin'),
(13, '1', '1', 'ND', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_dana_keluar`
--
ALTER TABLE `tb_dana_keluar`
  ADD PRIMARY KEY (`id_dana_keluar`);

--
-- Indeks untuk tabel `tb_dana_masuk`
--
ALTER TABLE `tb_dana_masuk`
  ADD PRIMARY KEY (`id_dana_masuk`);

--
-- Indeks untuk tabel `tb_instansi`
--
ALTER TABLE `tb_instansi`
  ADD PRIMARY KEY (`id_instansi`);

--
-- Indeks untuk tabel `tb_kelurahan`
--
ALTER TABLE `tb_kelurahan`
  ADD PRIMARY KEY (`id_kelurahan`);

--
-- Indeks untuk tabel `tb_lpj`
--
ALTER TABLE `tb_lpj`
  ADD PRIMARY KEY (`id_lpj`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_dana_keluar`
--
ALTER TABLE `tb_dana_keluar`
  MODIFY `id_dana_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `tb_dana_masuk`
--
ALTER TABLE `tb_dana_masuk`
  MODIFY `id_dana_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT untuk tabel `tb_instansi`
--
ALTER TABLE `tb_instansi`
  MODIFY `id_instansi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_kelurahan`
--
ALTER TABLE `tb_kelurahan`
  MODIFY `id_kelurahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_lpj`
--
ALTER TABLE `tb_lpj`
  MODIFY `id_lpj` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
