-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2024 at 05:52 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `persuratan`
--

-- --------------------------------------------------------

--
-- Table structure for table `jenis_surat`
--

CREATE TABLE `jenis_surat` (
  `id` int(11) NOT NULL,
  `nama_surat` varchar(255) NOT NULL,
  `template_file` varchar(255) NOT NULL,
  `required_fields` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis_surat`
--

INSERT INTO `jenis_surat` (`id`, `nama_surat`, `template_file`, `required_fields`) VALUES
(1, 'Surat Ahli Waris', 'ahli_waris_template.php', 'nama,nik,tempat_lahir,tanggal_lahir,jenis_kelamin,pekerjaan,agama,alamat,nama_pewaris,nik_pewaris,tempat_lahir_pewaris,tanggal_lahir_pewaris,jenis_kelamin_pewaris,pekerjaan_pewaris,agama_pewaris,alamat_pewaris,benda,tanggal_surat,tempat_persetujuan'),
(2, 'Surat Anak Yatim', 'anak_yatim_template.php', 'nama,nik,tempat_lahir,tanggal_lahir,pekerjaan,alamat,nama_ayah,nama_ibu,alamat'),
(3, 'Surat Belum Menikah', 'belum_menikah_template.php', 'nama,nik,tempat_lahir,tanggal_lahir,pekerjaan,status_perkawinan,alamat'),
(4, 'Surat Berkelakuan Baik', 'berkelakuan_baik_template.php', 'nama,nik,tempat_lahir,tanggal_lahir,jenis_kelamin,agama,kewarganegaraan,pekerjaan,alamat'),
(5, 'Surat Domisili', 'domisili_template.php', 'nama,nik,tempat_lahir,tanggal_lahir,jenis_kelamin,pekerjaan,alamat'),
(6, 'Surat Hilang', 'hilang_template.php', 'nama,nik,tempat_lahir,tanggal_lahir,jenis_kelamin,pekerjaan,alamat,barang_hilang,alasan_hilang'),
(7, 'Surat Jual Beli Hewan', 'jual_beli_hewan_template.php', 'nama_pihak_pertama,tempat_lahir_pihak_pertama,tanggal_lahir_pihak_pertama,pekerjaan_pihak_pertama,alamat_pihak_pertama,nama_pihak_kedua,tempat_lahir_pihak_kedua,tanggal_lahir_pihak_kedua,pekerjaan_pihak_kedua,alamat_pihak_kedua,jumlah_hewan,nama_hewan,jenis_kelamin_hewan,warna_hewan,tanduk,umur_dalam_angka,umur_dalam_kata,tanda-tanda_lain,harga_dalam_angka,harga_dalam_kata,asal_kepala_dusun,nama_kepala_dusun'),
(8, 'Surat Kurang Mampu', 'kurang_mampu_template.php', 'nama,nik,tempat_lahir,tanggal_lahir,jenis_kelamin,pekerjaan,alamat'),
(9, 'Surat Mandah', 'mandah_template.php', 'nama,nik,tempat_lahir,tanggal_lahir,jenis_kelamin,pekerjaan,status_perkawinan,alamat,nama_ayah,desa_/_kelurahan_tujuan,kecamatan_tujuan,kabupaten_/_kota_tujuan,provinsi_tujuan,tujuan_bepergian'),
(10, 'Surat Meninggal Dunia', 'meninggal_dunia_template.php', 'nama,nik,tempat_lahir,tanggal_lahir,jenis_kelamin,pekerjaan,alamat,tanggal_meninggal,tempat_dikebumikan'),
(11, 'Surat Terlantar', 'terlantar_template.php', 'nama,nik,tempat_lahir,tanggal_lahir,jenis_kelamin,agama,pekerjaan,warganegara,alamat,nama_ayah,nama_ibu'),
(12, 'Surat Usaha', 'usaha_template.php', 'nama,nik,tempat_lahir,tanggal_lahir,jenis_kelamin,agama,pekerjaan,alamat,nama_usaha,nama_dusun');

-- --------------------------------------------------------

--
-- Table structure for table `surat_keluar`
--

CREATE TABLE `surat_keluar` (
  `id` int(11) NOT NULL,
  `nomor_surat` varchar(50) DEFAULT NULL,
  `perihal` text DEFAULT NULL,
  `penerima` varchar(100) DEFAULT NULL,
  `tanggal_surat` date DEFAULT NULL,
  `tanggal_kirim` date DEFAULT NULL,
  `lampiran` varchar(255) DEFAULT NULL,
  `ringkasan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `surat_keterangan`
--

CREATE TABLE `surat_keterangan` (
  `id` int(11) NOT NULL,
  `jenis_surat_id` int(11) DEFAULT NULL,
  `nama_surat` varchar(255) DEFAULT NULL,
  `file_lampiran` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `surat_keterangan_data`
--

CREATE TABLE `surat_keterangan_data` (
  `id` int(11) NOT NULL,
  `surat_keterangan_id` int(11) DEFAULT NULL,
  `jenis_surat_id` int(11) DEFAULT NULL,
  `field_name` varchar(255) DEFAULT NULL,
  `field_value` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `surat_masuk`
--

CREATE TABLE `surat_masuk` (
  `id` int(11) NOT NULL,
  `nomor_surat` varchar(50) DEFAULT NULL,
  `perihal` text DEFAULT NULL,
  `pengirim` varchar(100) DEFAULT NULL,
  `tanggal_surat` date DEFAULT NULL,
  `tanggal_terima` date DEFAULT NULL,
  `lampiran` varchar(255) DEFAULT NULL,
  `ringkasan` text DEFAULT NULL,
  `status` enum('masuk','keluar','keterangan') DEFAULT 'masuk'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','guest') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', '$2y$10$pTo6LzhyGSCtB6CiB/Lxi.mhWiN7WeyIgSL34HUFdsIHH5qjICSKO', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jenis_surat`
--
ALTER TABLE `jenis_surat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_keterangan`
--
ALTER TABLE `surat_keterangan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_keterangan_data`
--
ALTER TABLE `surat_keterangan_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jenis_surat_id` (`jenis_surat_id`),
  ADD KEY `surat_keterangan_data_ibfk_1` (`surat_keterangan_id`);

--
-- Indexes for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis_surat`
--
ALTER TABLE `jenis_surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `surat_keterangan`
--
ALTER TABLE `surat_keterangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `surat_keterangan_data`
--
ALTER TABLE `surat_keterangan_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=313;

--
-- AUTO_INCREMENT for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `surat_keterangan_data`
--
ALTER TABLE `surat_keterangan_data`
  ADD CONSTRAINT `surat_keterangan_data_ibfk_1` FOREIGN KEY (`surat_keterangan_id`) REFERENCES `surat_keterangan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `surat_keterangan_data_ibfk_2` FOREIGN KEY (`jenis_surat_id`) REFERENCES `jenis_surat` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
