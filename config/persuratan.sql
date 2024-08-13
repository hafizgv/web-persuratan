-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2024 at 06:56 AM
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
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(2, 'admin', '$2y$10$pTo6LzhyGSCtB6CiB/Lxi.mhWiN7WeyIgSL34HUFdsIHH5qjICSKO');

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
(1, 'Surat Ahli Waris', 'ahli_waris_template.php', 'nama,nik,tempat,tanggal_lahir,jenis_kelamin,pekerjaan,agama,alamat,nama_pewaris,nik_pewaris,tempat_pewaris,tanggal_lahir_pewaris,jenis_kelamin_pewaris,pekerjaan_pewaris,agama_pewaris,alamat_pewaris,benda,tanggal_surat,tempat_persetujuan'),
(2, 'Surat Anak Yatim', 'anak_yatim_template.php', 'nama,nik,tempat,tanggal_lahir,pekerjaan,alamat,nama_ayah,nama_ibu,alamat'),
(3, 'Surat Belum Menikah', 'belum_menikah_template.php', 'nama,nik,tempat,tanggal_lahir,pekerjaan,status_perkawinan,alamat');

-- --------------------------------------------------------

--
-- Table structure for table `surat`
--

CREATE TABLE `surat` (
  `id` int(11) NOT NULL,
  `nomor_surat` varchar(50) NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `pengirim` varchar(255) NOT NULL,
  `tanggal_surat` date NOT NULL,
  `tanggal_terima` date NOT NULL,
  `ringkasan_surat` text NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `status` enum('masuk','keluar') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surat`
--

INSERT INTO `surat` (`id`, `nomor_surat`, `perihal`, `pengirim`, `tanggal_surat`, `tanggal_terima`, `ringkasan_surat`, `file_path`, `status`, `created_at`) VALUES
(1, '200/FK20/IN24', 'Anak Yatim', 'Bobi', '2024-08-16', '2024-08-24', 'Menyatakan bahwa bobi anak yatim... sedih betul laaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'Surat Anak Yatim_1723467621.pdf', 'masuk', '2024-08-13 04:23:06'),
(2, '200/FK20/IN24', 'Ahli Waris', 'Andi', '2024-08-25', '2024-08-27', 'Buanyak banget dia dapat warisan cikk. Siapa yang Gamau dapat gituan juga yakan. Buanyak banget dia dapat warisan cikk. Siapa yang Gamau dapat gituan juga yakan. Buanyak banget dia dapat warisan cikk. Siapa yang Gamau dapat gituan juga yakan. ', 'Surat Ahli Waris_1723460683.pdf', 'keluar', '2024-08-13 04:40:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_surat`
--
ALTER TABLE `jenis_surat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat`
--
ALTER TABLE `surat`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jenis_surat`
--
ALTER TABLE `jenis_surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `surat`
--
ALTER TABLE `surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
