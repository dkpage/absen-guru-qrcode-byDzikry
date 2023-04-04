-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Apr 2023 pada 19.15
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absen-guru-blank`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `aplikasi`
--

CREATE TABLE `aplikasi` (
  `id` int(11) NOT NULL,
  `nama_aplikasi` varchar(255) NOT NULL,
  `versi` varchar(10) NOT NULL,
  `developer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `aplikasi`
--

INSERT INTO `aplikasi` (`id`, `nama_aplikasi`, `versi`, `developer`) VALUES
(1, 'Aplikasi Kehadiran Guru', '2.0', 'Dzikry Maulana');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `id` int(11) NOT NULL,
  `tipe_jabatan` varchar(50) NOT NULL,
  `gaji` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`id`, `tipe_jabatan`, `gaji`) VALUES
(2, 'Kepala Sekolah', 800000),
(3, 'Staff Tata Usaha', 250000),
(4, 'Guru Mapel', 8000),
(7, 'Wks. Kurikulum', 250000),
(8, 'Wks. Kesiswaan', 250000),
(11, 'Bendahara', 250000),
(13, 'Wali Kelas', 300000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `hari` varchar(50) NOT NULL,
  `jam_ke` int(3) NOT NULL,
  `mulai` time NOT NULL,
  `selesai` time NOT NULL,
  `kelas` int(11) NOT NULL,
  `id_guru` varchar(11) NOT NULL,
  `id_mapel` varchar(50) NOT NULL,
  `durasi` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `namakelas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `namakelas`) VALUES
(1, 'Kelas VII'),
(2, 'Kelas VIII'),
(3, 'Kelas IX');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mapel`
--

CREATE TABLE `mapel` (
  `id` int(11) NOT NULL,
  `inisial` varchar(50) NOT NULL,
  `mapel` varchar(50) NOT NULL,
  `id_guru` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mapel`
--

INSERT INTO `mapel` (`id`, `inisial`, `mapel`, `id_guru`) VALUES
(30, 'INF', 'Informatika', ''),
(641, 'PAIBP', 'Pendidikan Agama Islam dan Budi Pekerti', ''),
(643, 'IPA', 'Ilmu Pengetahuan Alam', ''),
(644, 'SKI', 'Sejarah Kebudayaan Islam', ''),
(645, 'PPKn', 'Pendidikan Pancasila dan Kewarganegaraan', ''),
(647, 'Bahasa Inggris', 'Bahasa Inggris', ''),
(648, 'Bahasa Indonesia', 'Bahasa Indonesia', ''),
(649, 'Basa Sunda', 'Basa Sunda', ''),
(650, 'Bahasa Arab', 'Bahasa Arab', ''),
(651, 'Akhlaqul Banin', 'Akhlaqul Banin', ''),
(652, 'PJOK', 'Pendidikan Jasmani Olahraga dan Kesehatan', ''),
(653, 'Safinatunnaja', 'Safinatunnaja', ''),
(654, 'Tijan Durori', 'Tijan Durori', ''),
(655, 'IPS-A', 'Ilmu Pengetahuan Sosial A', ''),
(657, 'Matematika', 'Matematika', ''),
(658, 'BTQ & Tahfidz', 'BTQ & Tahfidz', ''),
(659, 'SBK', 'Seni Budaya', ''),
(660, 'Hadist', 'Hadist Arbain', ''),
(661, 'Talim', 'Talim Mutaallim', ''),
(662, 'IPS-B', 'Ilmu Pengetahuan Sosial B', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekap`
--

CREATE TABLE `rekap` (
  `id_rekap` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `thn` int(4) NOT NULL,
  `bln` int(2) NOT NULL,
  `tgl` int(2) NOT NULL,
  `hari` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `mapel` varchar(255) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `jam_ke` int(11) NOT NULL,
  `waktu` varchar(255) NOT NULL,
  `durasi` int(11) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `status_hadir` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id_r` int(11) NOT NULL,
  `type_role` varchar(50) NOT NULL,
  `dashboard` varchar(10) NOT NULL,
  `admin` varchar(10) NOT NULL,
  `ptk` varchar(10) NOT NULL,
  `jadwal` varchar(10) NOT NULL,
  `gaji` varchar(10) NOT NULL,
  `rekap` varchar(10) NOT NULL,
  `idcard` varchar(10) NOT NULL,
  `lokasi` varchar(10) NOT NULL,
  `profil` varchar(10) NOT NULL,
  `pengaturan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id_r`, `type_role`, `dashboard`, `admin`, `ptk`, `jadwal`, `gaji`, `rekap`, `idcard`, `lokasi`, `profil`, `pengaturan`) VALUES
(1, 'Administrator', 'Ya', 'Ya', 'Ya', 'Ya', 'Ya', 'Ya', 'Ya', 'Ya', 'Ya', 'Ya'),
(2, 'Operator', 'Ya', 'Tidak', 'Ya', 'Ya', 'Ya', 'Ya', 'Ya', 'Ya', 'Ya', 'Ya'),
(3, 'Supervisor', 'Ya', 'Tidak', 'Ya', 'Tidak', 'Ya', 'Ya', 'Tidak', 'Tidak', 'Ya', 'Tidak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sekolah`
--

CREATE TABLE `sekolah` (
  `id` int(11) NOT NULL,
  `jenjang` varchar(10) NOT NULL,
  `nama_sekolah` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `desa_kel` varchar(255) NOT NULL,
  `kec` varchar(255) NOT NULL,
  `kab_kota` varchar(255) NOT NULL,
  `prov` varchar(255) NOT NULL,
  `web_sekolah` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tlp` varchar(15) NOT NULL,
  `logo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `sekolah`
--

INSERT INTO `sekolah` (`id`, `jenjang`, `nama_sekolah`, `alamat`, `desa_kel`, `kec`, `kab_kota`, `prov`, `web_sekolah`, `email`, `tlp`, `logo`) VALUES
(1, 'SMP', 'SMP Plus Albidayah', 'Kp. Bendungan RT 04 RW 01', 'Mulyasari', 'Mande', 'Cianjur', 'Jawa Barat', 'https://smpplusalbidayah.sch.id', 'smp.albidayahplus@gmail.com', '085860320847', 'logo-alb.svg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `role` varchar(50) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `guru` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `uname` varchar(50) NOT NULL,
  `pwd` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `mapel` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `qrcode` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `role`, `jabatan`, `guru`, `email`, `uname`, `pwd`, `nama`, `nip`, `mapel`, `foto`, `qrcode`) VALUES
(203, 'Administrator', 'Staff Tata Usaha', '', 'adm@adm.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin Dzikry', '-', '', '1680628312-Admin Dzikry.png', '1866499161');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `aplikasi`
--
ALTER TABLE `aplikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rekap`
--
ALTER TABLE `rekap`
  ADD PRIMARY KEY (`id_rekap`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_r`);

--
-- Indeks untuk tabel `sekolah`
--
ALTER TABLE `sekolah`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `aplikasi`
--
ALTER TABLE `aplikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=663;

--
-- AUTO_INCREMENT untuk tabel `rekap`
--
ALTER TABLE `rekap`
  MODIFY `id_rekap` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `id_r` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `sekolah`
--
ALTER TABLE `sekolah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
