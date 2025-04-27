-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Apr 2025 pada 07.18
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_tiket`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `tanggal_berangkat` date NOT NULL,
  `dari_kota` varchar(100) NOT NULL,
  `ke_kota` varchar(100) NOT NULL,
  `jumlah_penumpang` int(11) NOT NULL,
  `tanggal_pesan` timestamp NOT NULL DEFAULT current_timestamp(),
  `harga_tiket` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`id`, `nama_lengkap`, `email`, `no_hp`, `tanggal_berangkat`, `dari_kota`, `ke_kota`, `jumlah_penumpang`, `tanggal_pesan`, `harga_tiket`) VALUES
(1, 'MUHAMMAD FAISYAL NUR PRATAMA', 'faisyalnur04@gmail.com', '081220645447', '2025-04-27', 'Kabupaten Majalengka', 'Malang', 2, '2025-04-27 03:49:15', 0),
(2, 'MUHAMMAD FAISYAL NUR PRATAMA', 'faisyalnur04@gmail.com', '081220645447', '2025-04-27', 'Jakarta', 'Bali', 2, '2025-04-27 03:57:39', 0),
(3, 'MUHAMMAD FAISYAL NUR PRATAMA', 'faisyalnur04@gmail.com', '081220645447', '2025-04-27', 'Jakarta', 'Bali', 2, '2025-04-27 04:03:55', 0),
(4, 'MUHAMMAD FAISYAL NUR PRATAMA', 'faisyalnur04@gmail.com', '081220645447', '2025-04-27', 'Jakarta', 'Bali', 2, '2025-04-27 04:08:44', 0),
(5, 'MUHAMMAD FAISYAL NUR PRATAMA', 'faisyalnur04@gmail.com', '081220645447', '2025-04-27', 'Jakarta', 'Bali', 2, '2025-04-27 04:13:14', 0),
(6, 'MUHAMMAD FAISYAL NUR PRATAMA', 'faisyalnur04@gmail.com', '081220645447', '2025-04-27', 'Jakarta', 'Bali', 2, '2025-04-27 04:13:57', 0),
(7, 'MUHAMMAD FAISYAL NUR PRATAMA', 'faisyalnur04@gmail.com', '081220645447', '2025-04-27', 'Jakarta', 'Bali', 2, '2025-04-27 04:14:30', 0),
(8, 'MUHAMMAD FAISYAL NUR PRATAMA', 'faisyalnur04@gmail.com', '081220645447', '2025-04-27', 'Jakarta', 'Bali', 2, '2025-04-27 04:17:02', 0),
(9, 'MUHAMMAD FAISYAL NUR PRATAMA', 'faisyalnur04@gmail.com', '081220645447', '2025-04-27', 'Jakarta', 'Bali', 2, '2025-04-27 04:17:20', 800000),
(10, 'MUHAMMAD FAISYAL NUR PRATAMA', 'faisyalnur04@gmail.com', '081220645447', '2025-04-27', 'Jakarta', 'Bali', 2, '2025-04-27 04:19:22', 800000),
(11, 'MUHAMMAD FAISYAL NUR PRATAMA', 'faisyalnur04@gmail.com', '081220645447', '2025-04-27', 'Jakarta', 'Bali', 3, '2025-04-27 04:30:36', 800000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rute`
--

CREATE TABLE `rute` (
  `id` int(11) NOT NULL,
  `dari_kota` varchar(100) NOT NULL,
  `ke_kota` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rute`
--

INSERT INTO `rute` (`id`, `dari_kota`, `ke_kota`, `harga`) VALUES
(1, 'Jakarta', 'Bali', 800000),
(2, 'Surabaya', 'Medan', 1200000),
(3, 'Bandung', 'Makassar', 950000),
(4, 'Kertajati', 'Bandung', 1050000),
(5, 'Yogyakarta', 'Lombok', 700000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama_lengkap`, `email`, `password`, `created_at`) VALUES
(1, 'Muhammad Faisyal', 'syalpratamaa@gmail.com', '$2y$10$Lu88bQ9mdU/st0t9DPm92eRVgD5XQjFM7wiYOXA3WK08AN9nX4.Aq', '2025-04-27 04:51:13'),
(3, 'Fernando Dako Soy', 'fernando@gmail.com', '$2y$10$/RFwSFQAmSnRpBbN5AYmd.3.uokdZF8HAvDc.T0vRyiTOum2weS3q', '2025-04-27 04:53:50'),
(5, 'Deki', 'dede@gmail.com', '$2y$10$J.K5Q2Th3/znVlROpjjnVeFsnLBBK34Wl4ncTbysg2LMMyTeM2XAG', '2025-04-27 04:54:55');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rute`
--
ALTER TABLE `rute`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `rute`
--
ALTER TABLE `rute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
