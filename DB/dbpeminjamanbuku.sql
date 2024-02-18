-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Nov 2023 pada 04.00
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbpeminjamanbuku`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `lockscreen`
--

CREATE TABLE `lockscreen` (
  `id` int(11) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `lockscreen`
--

INSERT INTO `lockscreen` (`id`, `password`) VALUES
(1, 'sekolah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(80) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `nomor_hp` varchar(15) NOT NULL,
  `hak_akses` varchar(50) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `username`, `password`, `nama_lengkap`, `alamat`, `nomor_hp`, `hak_akses`, `foto`) VALUES
(4, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'AANDANU', 'Empat Negeri', '+6282361676990', 'admin', 'admin/admin-avatar.png'),
(6, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'USER', 'Empat Negeri', '+6283877654098', 'user', 'admin/u6.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_anggota`
--

CREATE TABLE `tb_anggota` (
  `id_anggota` int(11) NOT NULL,
  `nama_anggota` varchar(50) NOT NULL,
  `nis` varchar(60) NOT NULL,
  `alamat` text NOT NULL,
  `nomor_hp` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tgl_bergabung` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_anggota`
--

INSERT INTO `tb_anggota` (`id_anggota`, `nama_anggota`, `nis`, `alamat`, `nomor_hp`, `email`, `tgl_bergabung`) VALUES
(1, 'Reza', '123345', 'Empat Negeri', '6283378509540', 'reza4@gmail.com', '2023-10-04'),
(2, 'Dodi', '124456', 'Empat Negeri', '6282274568095', 'dodi20@gmail.com', '2023-10-04'),
(3, 'Candra', '123346', 'Lima Puluh', '6282245607980', 'candra@gmail.com', '2023-10-08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_buku`
--

CREATE TABLE `tb_buku` (
  `id_buku` int(11) NOT NULL,
  `judul_buku` varchar(50) NOT NULL,
  `pengarang` varchar(50) NOT NULL,
  `penerbit` varchar(50) NOT NULL,
  `tahun_terbit` varchar(50) NOT NULL,
  `isbn` varchar(50) NOT NULL,
  `jumlah_buku` int(11) NOT NULL,
  `jumlah_salinan` int(11) NOT NULL,
  `kategori_buku` int(11) NOT NULL,
  `deskripsi_buku` text NOT NULL,
  `gambar_sampul` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_buku`
--

INSERT INTO `tb_buku` (`id_buku`, `judul_buku`, `pengarang`, `penerbit`, `tahun_terbit`, `isbn`, `jumlah_buku`, `jumlah_salinan`, `kategori_buku`, `deskripsi_buku`, `gambar_sampul`) VALUES
(1, 'Laskar Pelangi', 'Andrea Hirata', 'Bentang Pustaka', '2005', '-', 43, 50, 10, 'Novel yang mengisahkan tentang perjuangan sekelompok anak muda di Pulau Belitong dalam mencari pendidikan yang layak. Cerita ini penuh dengan warna-warni persahabatan, semangat juang, dan perjuangan melawan keterbatasan.', 'laskar.jpeg'),
(2, 'Bumi Manusia', 'Pramoedya Ananta Toer', 'Hasta Mitra', '1980', '-', 40, 45, 2, 'Novel sejarah epik yang mengisahkan perjalanan Minke, seorang pemuda Jawa yang mencoba melawan penjajahan kolonial Belanda dan mengejar cita-cita kebebasan dan kesetaraan.', 'bumi.jpeg'),
(3, 'Hujan Bulan Juni', 'Sapardi Djoko Damono', 'Gramedia Pustaka Utama', '1994', '-', 24, 50, 11, ' Kumpulan puisi yang indah dan mendalam, mengungkapkan perasaan, pemikiran, dan refleksi pengarang tentang kehidupan, cinta, dan alam, serta memberikan wawasan mendalam tentang perasaan manusia.', 'hujan.jpeg'),
(4, 'Indonesia: Sejarah Singkat', 'Merle C. Ricklefs', 'The Modern Library', '2008', '-', 40, 50, 2, 'Buku ini memberikan gambaran singkat tentang sejarah Indonesia, dari masa pra-sejarah hingga zaman modern. Cocok untuk siswa yang ingin memahami perkembangan dan dinamika sejarah Indonesia.', 'singkat.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `deskripsi_kategori` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kategori`, `nama_kategori`, `deskripsi_kategori`) VALUES
(1, 'Sastra', '-'),
(2, 'Sejarah', '-'),
(3, 'Sains', '-'),
(4, 'Matematika', '-'),
(5, 'Bahasa', '-'),
(6, 'Pendidikan', '-'),
(7, 'Seni dan Musik', '-'),
(8, 'Teknologi', '-'),
(9, 'Agama', '-'),
(10, 'Fiksi', '-'),
(11, 'Puisi', '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_peminjaman`
--

CREATE TABLE `tb_peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `agt_id` int(11) NOT NULL,
  `buku_id` int(11) NOT NULL,
  `tgl_peminjaman` date NOT NULL,
  `nama_pinjam` varchar(50) NOT NULL,
  `tgl_pengembalian_r` date NOT NULL,
  `tgl_pengembalian_a` date NOT NULL,
  `status_peminjaman` int(11) NOT NULL,
  `jumlah_pinjam` int(11) NOT NULL,
  `catatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_peminjaman`
--

INSERT INTO `tb_peminjaman` (`id_peminjaman`, `agt_id`, `buku_id`, `tgl_peminjaman`, `nama_pinjam`, `tgl_pengembalian_r`, `tgl_pengembalian_a`, `status_peminjaman`, `jumlah_pinjam`, `catatan`) VALUES
(4, 1, 1, '2023-10-06', 'XI (Sebelas)', '2023-10-07', '2023-10-09', 2, 22, 'Segera Kembalikan'),
(5, 2, 3, '2023-10-06', 'XII ( Dua Belas )', '2023-10-07', '2023-10-09', 2, 21, 'Segera Kembalikan'),
(6, 2, 4, '2023-10-06', 'X ( Sepuluh )', '2023-10-07', '2023-10-09', 2, 30, 'Segera kembalikan'),
(7, 1, 2, '2023-10-04', 'X-1', '2023-10-05', '2023-10-06', 2, 20, 'Kalau sudah di gunakan segera dikembalikan'),
(8, 2, 2, '2023-10-04', 'XII-2', '2023-10-05', '2023-10-06', 2, 30, '-'),
(9, 3, 3, '2023-10-09', 'XII-1', '2023-10-10', '2023-10-11', 2, 30, '-'),
(10, 3, 3, '2023-10-10', 'XII-2', '2023-10-10', '2023-10-11', 2, 20, '-'),
(11, 3, 1, '2023-11-17', 'XII', '2023-11-18', '2023-11-19', 2, 31, 'Segera Kembalikan setelah sudah digunakan'),
(12, 2, 3, '2023-11-17', 'XI', '2023-11-18', '2023-11-18', 2, 22, 'Segera Kembalikan'),
(13, 1, 1, '2023-11-20', 'X', '2023-11-20', '2023-11-21', 1, 30, 'Segera Kembalikan setelah digunakan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_riwayat_peminjaman`
--

CREATE TABLE `tb_riwayat_peminjaman` (
  `id_riwayat` int(11) NOT NULL,
  `id_pinjam` int(11) NOT NULL,
  `id_agt` int(11) NOT NULL,
  `id_bku` int(11) NOT NULL,
  `tgl_peminjaman` date NOT NULL,
  `tgl_pengembalian` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_riwayat_peminjaman`
--

INSERT INTO `tb_riwayat_peminjaman` (`id_riwayat`, `id_pinjam`, `id_agt`, `id_bku`, `tgl_peminjaman`, `tgl_pengembalian`) VALUES
(4, 4, 1, 1, '2023-10-06', '2023-10-09'),
(5, 5, 2, 3, '2023-10-06', '2023-10-09'),
(6, 6, 2, 4, '2023-10-06', '2023-10-09'),
(7, 7, 1, 2, '2023-10-04', '2023-10-06'),
(8, 8, 2, 2, '2023-10-04', '2023-10-06'),
(9, 9, 3, 3, '2023-10-09', '2023-10-11'),
(10, 10, 3, 3, '2023-10-10', '2023-10-11'),
(11, 11, 3, 1, '2023-11-17', '2023-11-19'),
(12, 12, 2, 3, '2023-11-17', '2023-11-18'),
(13, 13, 1, 1, '2023-11-20', '2023-11-21');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `lockscreen`
--
ALTER TABLE `lockscreen`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `tb_anggota`
--
ALTER TABLE `tb_anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indeks untuk tabel `tb_buku`
--
ALTER TABLE `tb_buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indeks untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `tb_peminjaman`
--
ALTER TABLE `tb_peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`);

--
-- Indeks untuk tabel `tb_riwayat_peminjaman`
--
ALTER TABLE `tb_riwayat_peminjaman`
  ADD PRIMARY KEY (`id_riwayat`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `lockscreen`
--
ALTER TABLE `lockscreen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_anggota`
--
ALTER TABLE `tb_anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_buku`
--
ALTER TABLE `tb_buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tb_peminjaman`
--
ALTER TABLE `tb_peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tb_riwayat_peminjaman`
--
ALTER TABLE `tb_riwayat_peminjaman`
  MODIFY `id_riwayat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
