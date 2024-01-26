-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Jan 2024 pada 12.58
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
-- Database: `wui`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `username_adm` varchar(15) NOT NULL,
  `password_adm` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`username_adm`, `password_adm`) VALUES
('admin', '79124251ea61de773683db73bbb83cf4'),
('admin1', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `kode_jadwal` varchar(7) NOT NULL,
  `waktu` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `jadwal`
--

INSERT INTO `jadwal` (`kode_jadwal`, `waktu`) VALUES
('kdjw001', '09:00 WIB'),
('kdjw002', '11:00 WIB'),
('kdjw003', '13:00 WIB'),
('kdjw004', '15:00 WIB');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mekanik`
--

CREATE TABLE `mekanik` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `keahlian1` varchar(255) DEFAULT NULL,
  `keahlian2` varchar(255) DEFAULT NULL,
  `gambar` varchar(25) DEFAULT NULL,
  `nomor_telp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mekanik`
--

INSERT INTO `mekanik` (`id`, `nama`, `keahlian1`, `keahlian2`, `gambar`, `nomor_telp`) VALUES
(3, 'ilham sukandar', 'Cub', 'Matic', 'team-3.jpg', '082121872513'),
(4, 'ruslanala', 'Sport', 'Matic', 'testimonial-1.jpg', '082121872512');

-- --------------------------------------------------------

--
-- Struktur dari tabel `motor`
--

CREATE TABLE `motor` (
  `no_polisi` varchar(10) NOT NULL,
  `jenis_motor` enum('Cub','Matic','Sport') NOT NULL,
  `merk_motor` enum('Honda','Yamaha','Suzuki','Kawasaki','Lainnya') NOT NULL,
  `nama_motor` varchar(30) NOT NULL,
  `username` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `motor`
--

INSERT INTO `motor` (`no_polisi`, `jenis_motor`, `merk_motor`, `nama_motor`, `username`) VALUES
('bpajshjas', 'Sport', 'Yamaha', 'susuk', 'wuae'),
('pbdiyhal', 'Sport', 'Kawasaki', 'susuk', 'arpian'),
('pbdriksan', 'Sport', 'Kawasaki', 'susuk', 'wuae');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `kode_transaksi` varchar(15) NOT NULL,
  `jenis_motor` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `kode_jadwal` varchar(7) NOT NULL,
  `username` varchar(15) NOT NULL,
  `no_polisi` varchar(10) NOT NULL,
  `status` enum('Belum','Proses','Selesai','Batal') NOT NULL,
  `mekanik` varchar(255) NOT NULL,
  `gambar` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`kode_transaksi`, `jenis_motor`, `tanggal`, `kode_jadwal`, `username`, `no_polisi`, `status`, `mekanik`, `gambar`) VALUES
('659a9244c99cb', 'Sport', '2024-01-10', 'kdjw001', 'arpian', 'pbdiyhal', 'Batal', 'ilham sukandar', 'uang.png'),
('659aa90d0e760', 'Sport', '2024-01-11', 'kdjw001', 'arpian', 'pbdiyhal', 'Belum', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `username` varchar(15) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jk` enum('Pria','Wanita') NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `block` enum('Blocked','Tidak') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`username`, `password`, `nama`, `tgl_lahir`, `jk`, `no_telp`, `alamat`, `block`) VALUES
('wuae', '111', 'wae picah', '2023-10-10', 'Wanita', '08989', 'jalan jalan', 'Tidak');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username_adm`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`kode_jadwal`);

--
-- Indeks untuk tabel `mekanik`
--
ALTER TABLE `mekanik`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `motor`
--
ALTER TABLE `motor`
  ADD PRIMARY KEY (`no_polisi`),
  ADD KEY `username` (`username`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`kode_transaksi`),
  ADD KEY `kode_jadwal` (`kode_jadwal`),
  ADD KEY `username` (`username`),
  ADD KEY `no_polisi` (`no_polisi`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `mekanik`
--
ALTER TABLE `mekanik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `motor`
--
ALTER TABLE `motor`
  ADD CONSTRAINT `motor_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `motor_ibfk_2` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `motor_ibfk_3` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `motor_ibfk_4` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`kode_jadwal`) REFERENCES `jadwal` (`kode_jadwal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`no_polisi`) REFERENCES `motor` (`no_polisi`),
  ADD CONSTRAINT `transaksi_ibfk_4` FOREIGN KEY (`no_polisi`) REFERENCES `motor` (`no_polisi`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_5` FOREIGN KEY (`no_polisi`) REFERENCES `motor` (`no_polisi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_6` FOREIGN KEY (`kode_jadwal`) REFERENCES `jadwal` (`kode_jadwal`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
