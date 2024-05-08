-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Apr 2024 pada 05.30
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_delivery`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `idadmin` int(11) NOT NULL,
  `namaadmin` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`idadmin`, `namaadmin`, `username`, `password`) VALUES
(2, 'Admin', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kurir`
--

CREATE TABLE `kurir` (
  `idkurir` int(11) NOT NULL,
  `namakurir` text NOT NULL,
  `nohp` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `lat_kurir` text NOT NULL,
  `lang_kurir` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kurir`
--

INSERT INTO `kurir` (`idkurir`, `namakurir`, `nohp`, `username`, `password`, `lat_kurir`, `lang_kurir`) VALUES
(1, 'Anton', '09865321', 'anton', 'anton', '', ''),
(2, 'Joni2', '12312', 'joni', 'joni', '-2.961641', '104.727731');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `idpelanggan` int(11) NOT NULL,
  `namapelanggan` text NOT NULL,
  `nohp` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`idpelanggan`, `namapelanggan`, `nohp`, `username`, `password`) VALUES
(1, 'Sugeng Setiawan', '321321321', 'sugeng', 'sugeng'),
(2, 'budi', '1', 'budi', 'budi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengiriman`
--

CREATE TABLE `pengiriman` (
  `idpengiriman` int(11) NOT NULL,
  `idkurir` int(11) NOT NULL,
  `idpelanggan` int(11) NOT NULL,
  `kodepengiriman` text NOT NULL,
  `namapengirim` text NOT NULL,
  `alamatpengirim` text NOT NULL,
  `nohppengirim` text NOT NULL,
  `namapenerima` text NOT NULL,
  `alamatpenerima` text NOT NULL,
  `nohppenerima` text NOT NULL,
  `jenisbarang` text NOT NULL,
  `berat` text NOT NULL,
  `jenislayanan` text NOT NULL,
  `biaya` text NOT NULL,
  `lat` text NOT NULL,
  `lang` text NOT NULL,
  `status` text NOT NULL,
  `tanggal` date NOT NULL,
  `lat_pengirim` text NOT NULL,
  `lang_pengirim` text NOT NULL,
  `lat_penerima` text NOT NULL,
  `lang_penerima` text NOT NULL,
  `keterangan` text NOT NULL,
  `waktupickup` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengiriman`
--

INSERT INTO `pengiriman` (`idpengiriman`, `idkurir`, `idpelanggan`, `kodepengiriman`, `namapengirim`, `alamatpengirim`, `nohppengirim`, `namapenerima`, `alamatpenerima`, `nohppenerima`, `jenisbarang`, `berat`, `jenislayanan`, `biaya`, `lat`, `lang`, `status`, `tanggal`, `lat_pengirim`, `lang_pengirim`, `lat_penerima`, `lang_penerima`, `keterangan`, `waktupickup`) VALUES
(2, 1, 1, 'DLV55718', 'Sugeng', 'Jl Sudirman', '08321321', 'Antonio', 'Jl Sudirman Anwar', '08321321', 'Buku', '1', 'Reguler', '20000', '-2.959978', '104.730276', 'Di Setujui', '2024-04-22', '', '', '-2.913340', '104.690226', '', NULL),
(3, 2, 1, 'DLV61473', 'Sugeng', 'asddsa', '098321', 'Andani', 'Palembang Jln 123', '0768423', 'Kue', '1', 'Reguler', '30000', '-2.961641', '104.727731', 'Sedang Dalam Perjalanan', '2024-04-22', '', '', '-2.955898', '104.783521', 'tes', NULL),
(4, 2, 1, 'DLV31685', 'Andi', 'asdasdasd', '21312312', 'Anton', 'dasdasdas', '321312321', 'Buku', '1', 'Reguler', '', '-2.965504', '104.7396352', 'Selesai', '2024-04-23', '-3.003336', '104.730955', '-2.989145', '104.731367', 'Lokasi kurir diperbarui pada 2024-04-23 12:24:33', NULL),
(5, 2, 1, 'DLV22077', 'Sugeng asd', 'Jl jakarta', '07321321', 'Jonjon', 'Jl bandung', '07798567', 'Makanan', '1', 'Reguler', '30000', '-1.5983818', '103.6044397', 'Selesai', '2024-04-24', '-2.972329', '104.771463', '-3.010216', '104.760025', 'Pesanan Telah Sampai Pada Penerima.', NULL),
(6, 2, 1, 'DLV29017', 'Sugeng dsad', 'jl 1234', '08321321', 'Poles', 'Jl 3456', '3213123', 'Makanan', '1', 'Reguler', '30000', '-1.5983818', '103.6044397', 'Selesai', '2024-04-24', '-2.996698', '104.728379', '-3.002932', '104.796448', 'Pesanan Telah Sampai Pada Penerima.', NULL),
(7, 0, 1, 'DLV17035', 'Sugeng', 'asdsadsa', '0938721321', 'Anton', 'asdasdsa', '90867867', 'Makanan', '1', 'Hemat', '', '', '', 'Menunggu Konfirmasi Admin', '2024-04-24', '-2.985524', '104.747692', '-2.996238', '104.763785', '', NULL),
(8, 0, 1, 'DLV49991', 'Sugeng', 'asdsadasdsa', '3213032183213', 'Poela', 'sadasdas', '0876787', 'Makanan', '1', 'Reguler', '', '', '', 'Menunggu Konfirmasi Admin', '2024-04-24', '-3.028061', '104.789198', '-2.978777', '104.798841', '', '2024-04-25 19:49:00'),
(10, 0, 1, 'DLV97272', 'Sugeng', 'ASdASD', '08321321', 'Antonio', 'dasadas', '088786', 'Makanan', '1', 'Reguler', '15000', '', '', 'Menunggu Konfirmasi Admin', '2024-04-24', '-3.003947', '104.727594', '-2.980371', '104.778169', '', '2024-04-25 20:18:00'),
(11, 0, 1, 'DLV15125', 'Sugeng', 'sadasdsa', '321321321', 'Anotini', 'dasdasfawe', '321632131', 'Makanan', '1', 'Reguler', '15000', '', '', 'Menunggu Konfirmasi Admin', '2024-04-24', '-2.996800', '104.723511', '-2.997150', '104.776122', '', '2024-04-25 20:19:00');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idadmin`);

--
-- Indeks untuk tabel `kurir`
--
ALTER TABLE `kurir`
  ADD PRIMARY KEY (`idkurir`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`idpelanggan`);

--
-- Indeks untuk tabel `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD PRIMARY KEY (`idpengiriman`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `idadmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kurir`
--
ALTER TABLE `kurir`
  MODIFY `idkurir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `idpelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pengiriman`
--
ALTER TABLE `pengiriman`
  MODIFY `idpengiriman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
