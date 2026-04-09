-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Apr 2026 pada 01.24
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peminjaman_alat`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alat`
--

CREATE TABLE `alat` (
  `id_alat` int(11) NOT NULL,
  `nama_alat` varchar(100) NOT NULL,
  `stok` int(11) NOT NULL COMMENT 'solder listrik'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `alat`
--

INSERT INTO `alat` (`id_alat`, `nama_alat`, `stok`) VALUES
(3, 'Laptop', 47),
(8, 'Speaker', 49),
(9, 'kamera/ DSLR', 31),
(10, 'Layar Proyektor', 44),
(12, 'Senter', 21);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_aktivitas`
--

CREATE TABLE `log_aktivitas` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `aktivitas` text DEFAULT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `log_aktivitas`
--

INSERT INTO `log_aktivitas` (`id`, `id_user`, `aktivitas`, `waktu`) VALUES
(1, 9, 'Berhasil login ke dalam sistem.', '2026-03-10 11:11:57'),
(2, 9, 'Berhasil login ke dalam sistem.', '2026-03-10 11:12:34'),
(3, 9, 'Berhasil login ke dalam sistem.', '2026-03-10 12:00:14'),
(4, 9, 'Berhasil login ke dalam sistem.', '2026-03-10 12:21:50'),
(5, 9, 'Mengubah data alat: Tripot (Stok: 28)', '2026-03-10 12:22:23'),
(6, 9, 'Berhasil login ke dalam sistem.', '2026-03-10 12:46:15'),
(7, 9, 'Berhasil login ke dalam sistem.', '2026-03-10 12:59:26'),
(8, 4, 'Berhasil login ke dalam sistem.', '2026-03-10 13:01:59'),
(9, 11, 'Berhasil login ke dalam sistem.', '2026-03-10 13:03:44'),
(10, 11, 'Berhasil login ke dalam sistem.', '2026-03-10 13:24:05'),
(11, 11, 'Berhasil login ke dalam sistem.', '2026-03-10 13:30:38'),
(12, 9, 'Berhasil login ke dalam sistem.', '2026-03-10 13:31:22'),
(13, 4, 'Berhasil login ke dalam sistem.', '2026-03-10 13:32:16'),
(14, 9, 'Berhasil login ke dalam sistem.', '2026-03-10 13:47:34'),
(15, 4, 'Berhasil login ke dalam sistem.', '2026-03-10 13:48:53'),
(16, 4, 'Berhasil login ke dalam sistem.', '2026-03-10 14:12:12'),
(17, 9, 'Berhasil login ke dalam sistem.', '2026-03-10 14:21:03'),
(26, 11, 'Berhasil login ke dalam sistem.', '2026-03-10 16:24:11'),
(27, 4, 'Berhasil login ke dalam sistem.', '2026-03-10 16:27:41'),
(28, 11, 'Berhasil login ke dalam sistem.', '2026-03-10 16:28:17'),
(29, 11, 'Berhasil login ke dalam sistem.', '2026-03-10 16:33:21'),
(30, 9, 'Berhasil login ke dalam sistem.', '2026-03-10 16:51:09'),
(31, 11, 'Berhasil login ke dalam sistem.', '2026-03-10 16:54:06'),
(32, 12, 'Berhasil login ke dalam sistem.', '2026-03-10 16:58:33'),
(33, 11, 'Berhasil login ke dalam sistem.', '2026-03-10 16:59:34'),
(34, 9, 'Berhasil login ke dalam sistem.', '2026-03-10 17:05:51'),
(35, 11, 'Berhasil login ke dalam sistem.', '2026-03-10 17:12:52'),
(36, 4, 'Berhasil login ke dalam sistem.', '2026-03-10 17:14:26'),
(37, 11, 'Berhasil login ke dalam sistem.', '2026-03-10 17:14:54'),
(38, 9, 'Berhasil login ke dalam sistem.', '2026-03-10 17:26:50'),
(39, 11, 'Berhasil login ke dalam sistem.', '2026-03-10 17:28:48'),
(40, 11, 'Berhasil login ke dalam sistem.', '2026-03-10 17:36:01'),
(41, 9, 'Berhasil login ke dalam sistem.', '2026-03-10 17:39:03'),
(42, 11, 'Berhasil login ke dalam sistem.', '2026-03-10 17:39:34'),
(43, 11, 'Berhasil login ke dalam sistem.', '2026-03-10 17:43:58'),
(44, 11, 'Berhasil login ke dalam sistem.', '2026-03-10 17:48:57'),
(45, 9, 'Berhasil login ke dalam sistem.', '2026-03-11 09:33:41'),
(46, 9, 'Mengubah data alat: Proyektor (Stok: 50)', '2026-03-11 09:36:01'),
(47, 9, 'Mengubah data alat: Laptop (Stok: 50)', '2026-03-11 09:36:17'),
(48, 9, 'Mengubah data alat: Speaker (Stok: 50)', '2026-03-11 09:36:42'),
(49, 9, 'Mengubah data alat: kamera/ DSLR (Stok: 30)', '2026-03-11 09:37:06'),
(50, 9, 'Menambah alat baru: Layar Proyektor (50 Unit)', '2026-03-11 09:37:30'),
(51, 4, 'Berhasil login ke dalam sistem.', '2026-03-11 10:09:11'),
(52, 11, 'Berhasil login ke dalam sistem.', '2026-03-11 10:09:57'),
(53, 9, 'Berhasil login ke dalam sistem.', '2026-03-28 10:52:36'),
(54, 4, 'Berhasil login ke dalam sistem.', '2026-03-28 10:53:02'),
(55, 11, 'Berhasil login ke dalam sistem.', '2026-03-28 10:54:15'),
(56, 4, 'Berhasil login ke dalam sistem.', '2026-03-29 12:07:04'),
(57, 9, 'Berhasil login ke dalam sistem.', '2026-03-31 11:31:19'),
(58, 4, 'Berhasil login ke dalam sistem.', '2026-03-31 11:32:24'),
(59, 9, 'Berhasil login ke dalam sistem.', '2026-03-31 11:53:54'),
(60, 4, 'Berhasil login ke dalam sistem.', '2026-03-31 12:18:06'),
(61, 9, 'Berhasil login ke dalam sistem.', '2026-03-31 12:25:09'),
(62, 10, 'Berhasil login ke dalam sistem.', '2026-03-31 12:34:03'),
(63, 9, 'Berhasil login ke dalam sistem.', '2026-03-31 12:34:23'),
(64, 12, 'Berhasil login ke dalam sistem.', '2026-03-31 12:41:48'),
(65, 11, 'Berhasil login ke dalam sistem.', '2026-03-31 12:43:48'),
(66, 9, 'Berhasil login ke dalam sistem.', '2026-03-31 12:50:43'),
(67, 9, 'Berhasil login ke dalam sistem.', '2026-03-31 23:46:00'),
(68, 9, 'Berhasil login ke dalam sistem.', '2026-03-31 23:47:21'),
(69, 9, 'Berhasil login ke dalam sistem.', '2026-04-01 01:29:21'),
(70, 4, 'Berhasil login ke dalam sistem.', '2026-04-01 01:29:42'),
(71, 9, 'Berhasil login ke dalam sistem.', '2026-04-01 05:52:59'),
(72, 4, 'Berhasil login ke dalam sistem.', '2026-04-01 05:54:22'),
(73, 9, 'Berhasil login ke dalam sistem.', '2026-04-01 06:07:39'),
(74, 4, 'Berhasil login ke dalam sistem.', '2026-04-01 06:08:06'),
(75, 11, 'Berhasil login ke dalam sistem.', '2026-04-01 06:08:44'),
(76, 4, 'Berhasil login ke dalam sistem.', '2026-04-01 06:23:39'),
(77, 9, 'Berhasil login ke dalam sistem.', '2026-04-01 06:25:06'),
(78, 11, 'Berhasil login ke dalam sistem.', '2026-04-02 04:13:14'),
(79, 9, 'Berhasil login ke dalam sistem.', '2026-04-02 04:31:07'),
(80, 11, 'Berhasil login ke dalam sistem.', '2026-04-02 04:35:01'),
(81, 4, 'Berhasil login ke dalam sistem.', '2026-04-02 04:35:22'),
(82, 4, 'Berhasil login ke dalam sistem.', '2026-04-02 04:53:49'),
(83, 4, 'Berhasil login ke dalam sistem.', '2026-04-02 05:06:57'),
(84, 11, 'Berhasil login ke dalam sistem.', '2026-04-02 05:07:58'),
(85, 9, 'Berhasil login ke dalam sistem.', '2026-04-02 05:10:29'),
(86, 11, 'Berhasil login ke dalam sistem.', '2026-04-02 05:17:25'),
(87, 9, 'Berhasil login ke dalam sistem.', '2026-04-02 05:25:17'),
(88, 9, 'Berhasil login ke dalam sistem.', '2026-04-02 05:50:27'),
(89, 12, 'Berhasil login ke dalam sistem.', '2026-04-02 05:58:42'),
(90, 12, 'Berhasil login ke dalam sistem.', '2026-04-02 06:12:23'),
(91, 10, 'Berhasil login ke dalam sistem.', '2026-04-02 06:22:11'),
(92, 11, 'Berhasil login ke dalam sistem.', '2026-04-02 06:23:07'),
(93, 12, 'Berhasil login ke dalam sistem.', '2026-04-02 06:23:49'),
(94, 10, 'Berhasil login ke dalam sistem.', '2026-04-02 06:24:17'),
(95, 4, 'Berhasil login ke dalam sistem.', '2026-04-02 06:26:40'),
(96, 9, 'Berhasil login ke dalam sistem.', '2026-04-02 06:27:37'),
(97, 9, 'Berhasil login ke dalam sistem.', '2026-04-02 06:41:22'),
(98, 9, 'Berhasil login ke dalam sistem.', '2026-04-02 06:41:22'),
(99, 9, 'Berhasil login ke dalam sistem.', '2026-04-02 07:17:00'),
(100, 9, 'Menambahkan user baru: Alzaena sebagai Peminjam', '2026-04-02 10:49:37'),
(101, 9, 'Menambah alat baru: contoh (4 Unit)', '2026-04-02 10:55:08'),
(102, 9, 'Menghapus alat: contoh', '2026-04-02 10:56:10'),
(103, 9, 'Membuka halaman log_aktivitas.php', '2026-04-02 16:40:07'),
(104, 9, 'Membuka halaman log_aktivitas.php', '2026-04-02 16:40:18'),
(105, 9, 'Menghapus alat: Proyektor', '2026-04-03 04:24:05'),
(106, 11, 'Menambah alat baru: lampu (20 Unit)', '2026-04-04 11:22:00'),
(107, 9, 'Memproses pengembalian alat (ID Pinjam: 24)', '2026-04-04 12:36:21'),
(108, 9, 'Menghapus data transaksi ID: 24', '2026-04-04 12:36:25'),
(109, 9, 'Login ke sistem', '2026-04-04 12:39:04'),
(110, 10, 'Login ke sistem', '2026-04-04 12:49:09'),
(111, 9, 'Login ke sistem', '2026-04-04 12:49:38'),
(112, 9, 'Login ke sistem', '2026-04-06 04:25:53'),
(113, 11, 'Login ke sistem', '2026-04-06 04:50:05'),
(114, 4, 'Login ke sistem', '2026-04-07 01:16:34'),
(115, 11, 'Login ke sistem', '2026-04-07 01:17:59'),
(116, 11, 'Menyetujui peminjaman transaksi ID: 42', '2026-04-07 01:18:08'),
(117, 9, 'Login ke sistem', '2026-04-07 01:30:42'),
(118, 9, 'Mengubah data alat: Senter (Stok: 20)', '2026-04-07 01:31:39'),
(119, 9, 'Memproses pengembalian alat (ID Pinjam: 42)', '2026-04-07 01:32:03'),
(120, 9, 'Menghapus data transaksi ID: 42', '2026-04-07 01:32:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_pinjam` int(11) NOT NULL,
  `nama` varchar(55) NOT NULL,
  `id_alat` int(20) NOT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status_kembali` enum('Belum','Sudah') DEFAULT 'Belum'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id_pinjam`, `nama`, `id_alat`, `jumlah`, `tgl_pinjam`, `tgl_kembali`, `status`, `user_id`, `status_kembali`) VALUES
(26, 'niskala', 3, 5, '2026-03-11', NULL, 'DIPINJAM', NULL, 'Belum'),
(28, 'niskala', 9, 2, '2026-03-29', NULL, 'KEMBALI', NULL, 'Belum'),
(36, 'niskala', 2, 1, '2026-04-01', NULL, 'KEMBALI', NULL, 'Belum'),
(39, 'sakala', 12, 1, '2026-04-04', NULL, 'DIPINJAM', NULL, 'Belum'),
(41, 'sakala', 9, 1, '2026-04-04', NULL, 'Pending', NULL, 'Belum');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `role`) VALUES
(4, 'niskala c', 'niskala', '1234', 'peminjam'),
(9, 'ayya', 'ayya', '2007', 'admin'),
(10, 'Sakala', 'Sakala', '123456', 'peminjam'),
(11, '', 'pratama', '8181', 'petugas');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alat`
--
ALTER TABLE `alat`
  ADD PRIMARY KEY (`id_alat`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_pinjam`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alat`
--
ALTER TABLE `alat`
  MODIFY `id_alat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
