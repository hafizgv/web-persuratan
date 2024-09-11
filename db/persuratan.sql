-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2024 at 08:50 AM
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
(2, 'Surat Anak Yatim', 'anak_yatim_template.php', 'nama,nik,tempat_lahir,tanggal_lahir,pekerjaan,alamat,nama_ayah,nama_ibu,alamat_orang_tua'),
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

--
-- Dumping data for table `surat_keterangan`
--

INSERT INTO `surat_keterangan` (`id`, `jenis_surat_id`, `nama_surat`, `file_lampiran`, `created_at`) VALUES
(53, 3, 'Surat Belum Menikah', '../uploads/Surat Belum Menikah_1726011321.pdf', '2024-09-10 23:35:21'),
(54, 1, 'Surat Ahli Waris', '../uploads/Surat Ahli Waris_1726013162.pdf', '2024-09-11 00:06:02'),
(56, 2, 'Surat Anak Yatim', '../uploads/Surat Anak Yatim_1726013281.pdf', '2024-09-11 00:08:01'),
(57, 4, 'Surat Berkelakuan Baik', '../uploads/Surat Berkelakuan Baik_1726013334.pdf', '2024-09-11 00:08:54'),
(58, 5, 'Surat Domisili', '../uploads/Surat Domisili_1726013355.pdf', '2024-09-11 00:09:15'),
(59, 6, 'Surat Hilang', '../uploads/Surat Hilang_1726013404.pdf', '2024-09-11 00:10:04'),
(61, 7, 'Surat Jual Beli Hewan', '../uploads/Surat Jual Beli Hewan_1726014386.pdf', '2024-09-11 00:26:26'),
(62, 8, 'Surat Kurang Mampu', '../uploads/Surat Kurang Mampu_1726014429.pdf', '2024-09-11 00:27:09'),
(65, 9, 'Surat Mandah', '../uploads/Surat Mandah_1726014733.pdf', '2024-09-11 00:32:13'),
(66, 10, 'Surat Meninggal Dunia', '../uploads/Surat Meninggal Dunia_1726014794.pdf', '2024-09-11 00:33:14'),
(69, 11, 'Surat Terlantar', '../uploads/Surat Terlantar_1726015016.pdf', '2024-09-11 00:36:56'),
(70, 12, 'Surat Usaha', '../uploads/Surat Usaha_1726015142.pdf', '2024-09-11 00:39:02');

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

--
-- Dumping data for table `surat_keterangan_data`
--

INSERT INTO `surat_keterangan_data` (`id`, `surat_keterangan_id`, `jenis_surat_id`, `field_name`, `field_value`, `created_at`, `updated_at`) VALUES
(348, 53, 3, 'nama', 'Bobi Sinagartulo', '2024-09-10 23:35:21', '2024-09-10 23:35:21'),
(349, 53, 3, 'nik', '1974005213600233', '2024-09-10 23:35:21', '2024-09-10 23:35:21'),
(350, 53, 3, 'tempat_lahir', 'Langsa', '2024-09-10 23:35:21', '2024-09-10 23:35:21'),
(351, 53, 3, 'tanggal_lahir', '2024-09-11', '2024-09-10 23:35:21', '2024-09-10 23:35:21'),
(352, 53, 3, 'pekerjaan', 'Jualan', '2024-09-10 23:35:21', '2024-09-10 23:35:21'),
(353, 53, 3, 'status_perkawinan', 'Belum Menikah', '2024-09-10 23:35:21', '2024-09-10 23:35:21'),
(354, 53, 3, 'alamat', 'Jln. A Yani, Gang Seni, Gampong Baro, Langsa Lama, Kota Langsa, Aceh, Kota Langsa, Aceh', '2024-09-10 23:35:21', '2024-09-10 23:35:21'),
(355, 54, 1, 'nama', 'Bobi Sinagartulo', '2024-09-11 00:06:02', '2024-09-11 00:06:02'),
(356, 54, 1, 'nik', '1974005213600233', '2024-09-11 00:06:02', '2024-09-11 00:06:02'),
(357, 54, 1, 'tempat_lahir', 'Langsa', '2024-09-11 00:06:02', '2024-09-11 00:06:02'),
(358, 54, 1, 'tanggal_lahir', '2024-09-12', '2024-09-11 00:06:02', '2024-09-11 00:06:02'),
(359, 54, 1, 'jenis_kelamin', 'Perempuan', '2024-09-11 00:06:02', '2024-09-11 00:06:02'),
(360, 54, 1, 'pekerjaan', 'Jualan', '2024-09-11 00:06:02', '2024-09-11 00:06:02'),
(361, 54, 1, 'agama', 'Islam', '2024-09-11 00:06:02', '2024-09-11 00:06:02'),
(362, 54, 1, 'alamat', 'Jln. A Yani, Gang Seni, Gampong Baro, Langsa Lama, Kota Langsa, Aceh, Kota Langsa, Aceh', '2024-09-11 00:06:02', '2024-09-11 00:06:02'),
(363, 54, 1, 'nama_pewaris', 'Bobi Lawas', '2024-09-11 00:06:02', '2024-09-11 00:06:02'),
(364, 54, 1, 'nik_pewaris', '1974000282941252', '2024-09-11 00:06:02', '2024-09-11 00:06:02'),
(365, 54, 1, 'tempat_lahir_pewaris', 'Langsa', '2024-09-11 00:06:02', '2024-09-11 00:06:02'),
(366, 54, 1, 'tanggal_lahir_pewaris', '2024-09-12', '2024-09-11 00:06:02', '2024-09-11 00:06:02'),
(367, 54, 1, 'jenis_kelamin_pewaris', 'Pria', '2024-09-11 00:06:02', '2024-09-11 00:06:02'),
(368, 54, 1, 'pekerjaan_pewaris', 'Wiraswasta', '2024-09-11 00:06:02', '2024-09-11 00:06:02'),
(369, 54, 1, 'agama_pewaris', 'Islam', '2024-09-11 00:06:02', '2024-09-11 00:06:02'),
(370, 54, 1, 'alamat_pewaris', 'Jln. A Yani, Gang Seni, Gampong Baro, Langsa Lama, Kota Langsa, Aceh Jln. A Yani, Gang Seni, Gampong Baro, Langsa Lama, Kota Langsa, Aceh Jln. A Yani, Gang Seni, Gampong Baro, Langsa Lama, Kota Langsa, Aceh', '2024-09-11 00:06:02', '2024-09-11 00:06:02'),
(371, 54, 1, 'benda', 'Emas 1kg', '2024-09-11 00:06:02', '2024-09-11 00:06:02'),
(372, 54, 1, 'tanggal_surat', '2024-09-12', '2024-09-11 00:06:02', '2024-09-11 00:06:02'),
(373, 54, 1, 'tempat_persetujuan', 'Kantor Geuchik', '2024-09-11 00:06:02', '2024-09-11 00:06:02'),
(382, 56, 2, 'nama', 'Bobi Sinagartulo', '2024-09-11 00:08:01', '2024-09-11 00:08:01'),
(383, 56, 2, 'nik', '1974005213600233', '2024-09-11 00:08:01', '2024-09-11 00:08:01'),
(384, 56, 2, 'tempat_lahir', 'Langsa', '2024-09-11 00:08:01', '2024-09-11 00:08:01'),
(385, 56, 2, 'tanggal_lahir', '2024-09-05', '2024-09-11 00:08:01', '2024-09-11 00:08:01'),
(386, 56, 2, 'pekerjaan', 'Jualan', '2024-09-11 00:08:01', '2024-09-11 00:08:01'),
(387, 56, 2, 'alamat', 'Jln. A Yani, Gang Seni, Gampong Baro, Langsa Lama, Kota Langsa, Aceh, Kota Langsa, Aceh', '2024-09-11 00:08:01', '2024-09-11 00:08:01'),
(388, 56, 2, 'nama_ayah', 'Bonti Lampedo', '2024-09-11 00:08:01', '2024-09-11 00:08:01'),
(389, 56, 2, 'nama_ibu', 'Ani Mowing', '2024-09-11 00:08:01', '2024-09-11 00:08:01'),
(390, 56, 2, 'alamat_orang_tua', 'Jln. A Yani, Gang Seni, Gampong Baro, Langsa Lama, Kota Langsa, Aceh, Kota Langsa, Aceh', '2024-09-11 00:08:01', '2024-09-11 00:08:01'),
(391, 57, 4, 'nama', 'Bobi Sinagartulo', '2024-09-11 00:08:54', '2024-09-11 00:08:54'),
(392, 57, 4, 'nik', '1974005213600233', '2024-09-11 00:08:54', '2024-09-11 00:08:54'),
(393, 57, 4, 'tempat_lahir', 'Langsa', '2024-09-11 00:08:54', '2024-09-11 00:08:54'),
(394, 57, 4, 'tanggal_lahir', '2024-09-05', '2024-09-11 00:08:54', '2024-09-11 00:08:54'),
(395, 57, 4, 'jenis_kelamin', 'Laki-laki', '2024-09-11 00:08:54', '2024-09-11 00:08:54'),
(396, 57, 4, 'agama', 'Islam', '2024-09-11 00:08:54', '2024-09-11 00:08:54'),
(397, 57, 4, 'kewarganegaraan', 'Indonesia', '2024-09-11 00:08:54', '2024-09-11 00:08:54'),
(398, 57, 4, 'pekerjaan', 'PNS', '2024-09-11 00:08:54', '2024-09-11 00:08:54'),
(399, 57, 4, 'alamat', 'Jln. A Yani, Gang Seni, Gampong Baro, Langsa Lama, Kota Langsa, Aceh, Kota Langsa, Aceh', '2024-09-11 00:08:54', '2024-09-11 00:08:54'),
(400, 58, 5, 'nama', 'Bobi Sinagartulo', '2024-09-11 00:09:15', '2024-09-11 00:09:15'),
(401, 58, 5, 'nik', '1974005213600233', '2024-09-11 00:09:15', '2024-09-11 00:09:15'),
(402, 58, 5, 'tempat_lahir', 'Langsa', '2024-09-11 00:09:15', '2024-09-11 00:09:15'),
(403, 58, 5, 'tanggal_lahir', '2024-09-06', '2024-09-11 00:09:15', '2024-09-11 00:09:15'),
(404, 58, 5, 'jenis_kelamin', 'Laki-laki', '2024-09-11 00:09:15', '2024-09-11 00:09:15'),
(405, 58, 5, 'pekerjaan', 'PNS', '2024-09-11 00:09:15', '2024-09-11 00:09:15'),
(406, 58, 5, 'alamat', 'Jln. A Yani, Gang Seni, Gampong Baro, Langsa Lama, Kota Langsa, Aceh, Kota Langsa, Aceh', '2024-09-11 00:09:15', '2024-09-11 00:09:15'),
(407, 59, 6, 'nama', 'Bobi Sinagartulo', '2024-09-11 00:10:04', '2024-09-11 00:10:04'),
(408, 59, 6, 'nik', '1974005213600233', '2024-09-11 00:10:04', '2024-09-11 00:10:04'),
(409, 59, 6, 'tempat_lahir', 'Langsa', '2024-09-11 00:10:04', '2024-09-11 00:10:04'),
(410, 59, 6, 'tanggal_lahir', '2024-09-11', '2024-09-11 00:10:04', '2024-09-11 00:10:04'),
(411, 59, 6, 'jenis_kelamin', 'Laki-laki', '2024-09-11 00:10:04', '2024-09-11 00:10:04'),
(412, 59, 6, 'pekerjaan', 'Jualan', '2024-09-11 00:10:04', '2024-09-11 00:10:04'),
(413, 59, 6, 'alamat', 'Jln. A Yani, Gang Seni, Gampong Baro, Langsa Lama, Kota Langsa, Aceh, Kota Langsa, Aceh', '2024-09-11 00:10:04', '2024-09-11 00:10:04'),
(414, 59, 6, 'barang_hilang', 'Sebuah Handphone', '2024-09-11 00:10:04', '2024-09-11 00:10:04'),
(415, 59, 6, 'alasan_hilang', 'Rumah dibobol pada tengah malam', '2024-09-11 00:10:04', '2024-09-11 00:10:04'),
(438, 61, 7, 'nama_pihak_pertama', 'Andi Lukito', '2024-09-11 00:26:26', '2024-09-11 00:26:26'),
(439, 61, 7, 'tempat_lahir_pihak_pertama', 'Jakarta', '2024-09-11 00:26:26', '2024-09-11 00:26:26'),
(440, 61, 7, 'tanggal_lahir_pihak_pertama', '2024-09-06', '2024-09-11 00:26:26', '2024-09-11 00:26:26'),
(441, 61, 7, 'pekerjaan_pihak_pertama', 'Youtuber', '2024-09-11 00:26:26', '2024-09-11 00:26:26'),
(442, 61, 7, 'alamat_pihak_pertama', 'Jln. A Yani, Gang Seni, Gampong Baro, Langsa Lama, Kota Langsa, Aceh, Kota Langsa, Aceh', '2024-09-11 00:26:26', '2024-09-11 00:26:26'),
(443, 61, 7, 'nama_pihak_kedua', 'Bobi Suherman', '2024-09-11 00:26:26', '2024-09-11 00:26:26'),
(444, 61, 7, 'tempat_lahir_pihak_kedua', 'Banda Aceh', '2024-09-11 00:26:26', '2024-09-11 00:26:26'),
(445, 61, 7, 'tanggal_lahir_pihak_kedua', '2024-10-04', '2024-09-11 00:26:26', '2024-09-11 00:26:26'),
(446, 61, 7, 'pekerjaan_pihak_kedua', 'PNS', '2024-09-11 00:26:26', '2024-09-11 00:26:26'),
(447, 61, 7, 'alamat_pihak_kedua', 'Jln. A Yani, Gang Seni, Gampong Baro, Langsa Lama, Kota Langsa, Aceh, Kota Langsa, Aceh', '2024-09-11 00:26:26', '2024-09-11 00:26:26'),
(448, 61, 7, 'jumlah_hewan', '5', '2024-09-11 00:26:26', '2024-09-11 00:26:26'),
(449, 61, 7, 'nama_hewan', 'Kambing', '2024-09-11 00:26:26', '2024-09-11 00:26:26'),
(450, 61, 7, 'jenis_kelamin_hewan', 'Laki-laki', '2024-09-11 00:26:26', '2024-09-11 00:26:26'),
(451, 61, 7, 'warna_hewan', 'Hitam', '2024-09-11 00:26:26', '2024-09-11 00:26:26'),
(452, 61, 7, 'tanduk', 'Menjulang kebawah', '2024-09-11 00:26:26', '2024-09-11 00:26:26'),
(453, 61, 7, 'umur_dalam_angka', '2', '2024-09-11 00:26:26', '2024-09-11 00:26:26'),
(454, 61, 7, 'umur_dalam_kata', 'Dua', '2024-09-11 00:26:26', '2024-09-11 00:26:26'),
(455, 61, 7, 'tanda-tanda_lain', 'Bulking badannya', '2024-09-11 00:26:26', '2024-09-11 00:26:26'),
(456, 61, 7, 'harga_dalam_angka', '20000000', '2024-09-11 00:26:26', '2024-09-11 00:26:26'),
(457, 61, 7, 'harga_dalam_kata', 'Dua puluh juta', '2024-09-11 00:26:26', '2024-09-11 00:26:26'),
(458, 61, 7, 'asal_kepala_dusun', 'Dusun Seni', '2024-09-11 00:26:26', '2024-09-11 00:26:26'),
(459, 61, 7, 'nama_kepala_dusun', 'Agus Sulaiman', '2024-09-11 00:26:26', '2024-09-11 00:26:26'),
(460, 62, 8, 'nama', 'Bobi Sinagartulo', '2024-09-11 00:27:09', '2024-09-11 00:27:09'),
(461, 62, 8, 'nik', '1974005213600233', '2024-09-11 00:27:09', '2024-09-11 00:27:09'),
(462, 62, 8, 'tempat_lahir', 'Langsa', '2024-09-11 00:27:09', '2024-09-11 00:27:09'),
(463, 62, 8, 'tanggal_lahir', '2024-09-10', '2024-09-11 00:27:09', '2024-09-11 00:27:09'),
(464, 62, 8, 'jenis_kelamin', 'Laki-laki', '2024-09-11 00:27:09', '2024-09-11 00:27:09'),
(465, 62, 8, 'pekerjaan', 'PNS', '2024-09-11 00:27:09', '2024-09-11 00:27:09'),
(466, 62, 8, 'alamat', 'Jln. A Yani, Gang Seni, Gampong Baro, Langsa Lama, Kota Langsa, Aceh, Kota Langsa, Aceh', '2024-09-11 00:27:09', '2024-09-11 00:27:09'),
(495, 65, 9, 'nama', 'Bobi Sinagartulo', '2024-09-11 00:32:13', '2024-09-11 00:32:13'),
(496, 65, 9, 'nik', '1974005213600233', '2024-09-11 00:32:13', '2024-09-11 00:32:13'),
(497, 65, 9, 'tempat_lahir', 'Langsa', '2024-09-11 00:32:13', '2024-09-11 00:32:13'),
(498, 65, 9, 'tanggal_lahir', '2024-09-04', '2024-09-11 00:32:13', '2024-09-11 00:32:13'),
(499, 65, 9, 'jenis_kelamin', 'Laki-laki', '2024-09-11 00:32:13', '2024-09-11 00:32:13'),
(500, 65, 9, 'pekerjaan', 'Jualan', '2024-09-11 00:32:13', '2024-09-11 00:32:13'),
(501, 65, 9, 'status_perkawinan', 'Belum Menikah', '2024-09-11 00:32:13', '2024-09-11 00:32:13'),
(502, 65, 9, 'alamat', 'Jln. A Yani, Gang Seni, Gampong Baro, Langsa Lama, Kota Langsa, Aceh, Kota Langsa, Aceh', '2024-09-11 00:32:13', '2024-09-11 00:32:13'),
(503, 65, 9, 'nama_ayah', 'Bonti Lampedo', '2024-09-11 00:32:13', '2024-09-11 00:32:13'),
(504, 65, 9, 'desa_/_kelurahan_tujuan', 'Meurandeh', '2024-09-11 00:32:13', '2024-09-11 00:32:13'),
(505, 65, 9, 'kecamatan_tujuan', 'Langsa Lama', '2024-09-11 00:32:13', '2024-09-11 00:32:13'),
(506, 65, 9, 'kabupaten_/_kota_tujuan', 'Kota Langsa', '2024-09-11 00:32:13', '2024-09-11 00:32:13'),
(507, 65, 9, 'provinsi_tujuan', 'Sumatera Utara', '2024-09-11 00:32:13', '2024-09-11 00:32:13'),
(508, 65, 9, 'tujuan_bepergian', 'Bosen dirumah', '2024-09-11 00:32:13', '2024-09-11 00:32:13'),
(509, 66, 10, 'nama', 'Louis Antovi', '2024-09-11 00:33:14', '2024-09-11 00:33:14'),
(510, 66, 10, 'nik', '1974005213600233', '2024-09-11 00:33:14', '2024-09-11 00:33:14'),
(511, 66, 10, 'tempat_lahir', 'Langsa', '2024-09-11 00:33:14', '2024-09-11 00:33:14'),
(512, 66, 10, 'tanggal_lahir', '2024-09-19', '2024-09-11 00:33:14', '2024-09-11 00:33:14'),
(513, 66, 10, 'jenis_kelamin', 'Laki-laki', '2024-09-11 00:33:14', '2024-09-11 00:33:14'),
(514, 66, 10, 'pekerjaan', 'Jualan', '2024-09-11 00:33:14', '2024-09-11 00:33:14'),
(515, 66, 10, 'alamat', 'Jln. A Yani, Gang Seni, Gampong Baro, Langsa Lama, Kota Langsa, Aceh, Kota Langsa, Aceh', '2024-09-11 00:33:14', '2024-09-11 00:33:14'),
(516, 66, 10, 'tanggal_meninggal', '2024-09-20', '2024-09-11 00:33:14', '2024-09-11 00:33:14'),
(517, 66, 10, 'tempat_dikebumikan', 'Desa Sidoarjo', '2024-09-11 00:33:14', '2024-09-11 00:33:14'),
(540, 69, 11, 'nama', 'Bobi Sinagartulo', '2024-09-11 00:36:56', '2024-09-11 00:36:56'),
(541, 69, 11, 'nik', '1974005213600233', '2024-09-11 00:36:56', '2024-09-11 00:36:56'),
(542, 69, 11, 'tempat_lahir', 'Langsa', '2024-09-11 00:36:56', '2024-09-11 00:36:56'),
(543, 69, 11, 'tanggal_lahir', '2024-09-07', '2024-09-11 00:36:56', '2024-09-11 00:36:56'),
(544, 69, 11, 'jenis_kelamin', 'Laki-laki', '2024-09-11 00:36:56', '2024-09-11 00:36:56'),
(545, 69, 11, 'agama', 'Islam', '2024-09-11 00:36:56', '2024-09-11 00:36:56'),
(546, 69, 11, 'pekerjaan', 'Jualan', '2024-09-11 00:36:56', '2024-09-11 00:36:56'),
(547, 69, 11, 'warganegara', 'Indonesia', '2024-09-11 00:36:56', '2024-09-11 00:36:56'),
(548, 69, 11, 'alamat', 'Jln. A Yani, Gang Seni, Gampong Baro, Langsa Lama, Kota Langsa, Aceh, Kota Langsa, Aceh', '2024-09-11 00:36:56', '2024-09-11 00:36:56'),
(549, 69, 11, 'nama_ayah', 'Bonti Lampedo', '2024-09-11 00:36:56', '2024-09-11 00:36:56'),
(550, 69, 11, 'nama_ibu', 'Ani Mowing', '2024-09-11 00:36:56', '2024-09-11 00:36:56'),
(551, 70, 12, 'nama', 'Louis Antovi', '2024-09-11 00:39:02', '2024-09-11 00:39:02'),
(552, 70, 12, 'nik', '1974005213600233', '2024-09-11 00:39:02', '2024-09-11 00:39:02'),
(553, 70, 12, 'tempat_lahir', 'Jakarta', '2024-09-11 00:39:02', '2024-09-11 00:39:02'),
(554, 70, 12, 'tanggal_lahir', '2024-09-05', '2024-09-11 00:39:02', '2024-09-11 00:39:02'),
(555, 70, 12, 'jenis_kelamin', 'Laki-laki', '2024-09-11 00:39:02', '2024-09-11 00:39:02'),
(556, 70, 12, 'agama', 'Islam', '2024-09-11 00:39:02', '2024-09-11 00:39:02'),
(557, 70, 12, 'pekerjaan', 'PNS', '2024-09-11 00:39:02', '2024-09-11 00:39:02'),
(558, 70, 12, 'alamat', 'Jln. A Yani, Gang Seni, Gampong Baro, Langsa Lama, Kota Langsa, Aceh, Kota Langsa, Aceh', '2024-09-11 00:39:02', '2024-09-11 00:39:02'),
(559, 70, 12, 'nama_usaha', 'Beradik Lima', '2024-09-11 00:39:02', '2024-09-11 00:39:02'),
(560, 70, 12, 'nama_dusun', 'Dusun Bersama', '2024-09-11 00:39:02', '2024-09-11 00:39:02');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `surat_keterangan_data`
--
ALTER TABLE `surat_keterangan_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=561;

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
