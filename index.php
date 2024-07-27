<?php
require 'vendor/autoload.php';

use Mpdf\Mpdf;

$days = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
$months = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

$currentDate = getdate();
$dayName = $days[$currentDate['wday']];
$day = $currentDate['mday'];
$month = $months[$currentDate['mon'] - 1];
$year = $currentDate['year'];
$formattedDate = "$day $month $year";

$no = '15';
$nama = 'BOBI TOMITUPANG';
$nik = '109579942724962002';
$gender = 'LAKI-LAKI';
$birthplace = 'MEDAN, 20-4-2001';
$nation = 'WNI/ISLAM';
$job = 'WIRAUSAHA';
$nikah = 'BELUM KAWIN';
$alamat = 'LANGSA JL. A YANI GAMPONG SEREBOK GORENG';

$mpdf = new Mpdf();

$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .br { 
            display: block; 
            margin-bottom: 0em; 
        } 
    </style>
</head>
<body style="text-align: center; font-family: \'Times New Roman\';">
    <table style="text-align: center;">
        <tbody>
            <tr>
                <td>
                    <img src="img/unsam.png" width="100" alt="unsam" style="padding-bottom: 20pt;">
                </td>
                <td>
                    <span style="font-size: 12pt; font-weight: bold;">
                        KEMENTRIAN PENDIDIKAN, KEBUDAYAAN,<br>
                        RISET DAN TEKNOLOGI<br>
                    </span>
                    <span style="font-size: 14pt; font-weight: bold;">
                        U N I V E R S I T A S&nbsp;&nbsp;S A M U D R A<br>
                        FAKULTAS TEKNIK<br>
                        PROGRAM STUDI INFORMATIKA<br>
                    </span>
                    <span style="font-size: 9pt;">
                        Jalan Prof. DR. Syarief Thayeb, Meurandeh – Langsa – Aceh <br>
                        Telp. (0641) 7445017 Fax. (0641) 7445017 <br>
                        Website : www.informatika.unsam.ac.id, Email : teknikinformatika@unsam.ac.id Kode Pos 24416
                    </span>
                </td>

            </tr>
        </tbody>
    </table>
    <hr style="height: 2pt; border: none; color: black; margin: 0 0 10pt 0;">
    <div>
        <span style="font-size: 12pt; text-decoration: underline;">
            SURAT KETERANGAN TIDAK MAMPU
        </span><br>
        <span>
            Nomor: '.$no.'/0015/TR/2024
        </span>
    </div>
    <div style="margin-top: 24pt; text-align: justify;">
        <span>
            Yang bertanda tangan dibawah ini Kepala Desa Terong Tawah, Kecamatan Labuapi, Kabupaten Lombok
            Barat menerangkan dengan sebenarnya, bahwa:
        </span>
        <table border="2" style="margin-left: 12pt;">
            <tbody>
                <tr>
                    <td>Nama</td>
                    <td style="text-indent: 24pt;">:</td>
                    <td>'.$nama.'</td>
                </tr>
                <tr>
                    <td>NIK</td>
                    <td style="text-indent: 24pt;">:</td>
                    <td>'.$nik.'</td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td style="text-indent: 24pt;">:</td>
                    <td>'.$gender.'</td>
                </tr>
                <tr>
                    <td>alamat, Tanggal Lahir</td>
                    <td style="text-indent: 24pt;">:</td>
                    <td>'.$birthplace.'</td>
                </tr>
                <tr>
                    <td>Warganegara / Agama</td>
                    <td style="text-indent: 24pt;">:</td>
                    <td>'.$nation.'</td>
                </tr>
                <tr>
                    <td>Pekerjaan</td>
                    <td style="text-indent: 24pt;">:</td>
                    <td>'.$job.'</td>
                </tr>
                <tr>
                    <td>Status Pernikahan</td>
                    <td style="text-indent: 24pt;">:</td>
                    <td>'.$nikah.'</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td style="text-indent: 24pt;">:</td>
                    <td>'.$alamat.'</td>
                </tr>
            </tbody>
        </table>
        <span style="margin-top: 16pt;">
            Nama tersebut adalah benar warga Desa Terong Tawah, Kecamatan Labuapi, Kabupaten Lombok Barat.
            Berdasarkan keterangan yang ada pada kami benar bahwa Surat Keterangan ini dibuat untuk <b>Beasiswa.</b>
        </span><br>
        <div style="margin-top: 18pt;">
            Demikian surat keterangan ini dibuat, atas perhatian dan kerjasamanya kami ucapkan terima kasih.
        </div>
        <table style="text-align: center; width: 100%; margin-top: 18pt;">
            <tbody>
                <tr>
                    <td>Mengetahui,<br>Orang yang bersangkutan</td>
                    <td style="width: 30%;"></td>
                    <td>Terong Tawah, '.$formattedDate.'<br>Kepala Desa Terong Tawah</td>
                </tr>
                <tr>
                    <td style="height: 80pt;"></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>'.$nama.'</td>
                    <td></td>
                    <td style="text-decoration: underline;"><b>MUHAMMAD WARIS ZAINAL, S.Pd.</b></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
';

$mpdf->WriteHTML($html);
$pdfPath = 'result.pdf';
$mpdf->Output($pdfPath, \Mpdf\Output\Destination::FILE);

echo "PDF has been saved to " . $pdfPath;
?>
