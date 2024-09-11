<body style="text-align: center; font-family: 'Times New Roman';">
    <table style="border-collapse: collapse; width: 100%; text-align: center;">
        <tbody>
            <tr>
                <td>
                    <img src="../img/acehtimur.png" width="90" alt="logo">
                </td>
                <td>
                    <span style="font-size: 14pt; font-weight: bold;">
                        PEMERINTAH KABUPATEN ACEH TIMUR<br>
                    </span>
                    <span style="font-size: 12pt; font-weight: bold;">
                        KECAMATAN PEUREULAK BARAT<br>
                    </span>
                    <span style="font-size: 10pt; font-weight: bold;">
                        KEMUKIMAN KUTA DAYAH<br>
                    </span>
                    <span style="font-size: 14pt; font-weight: bold;">
                        GAMPONG BEUSA SEBERANG<br>
                    </span>
                    <span style="font-size: 9pt;">
                        Kode Pos 24453
                    </span>
                </td>
            </tr>
        </tbody>
    </table>
    <hr style="height: 2pt; border: none; color: black;">
    <div>
        <span style="font-size: 12pt; text-decoration: underline;">
            SURAT KETERANGAN TERLANTAR
        </span><br>
        <span>
            Nomor: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/
        </span>
    </div>
    <div style="margin-top: 24pt; text-align: justify;">
        <div style="text-indent: 24pt;">
            Keuchik Gampong Beusa Seberang Kecamatan Peureulak Barat Kabupaten Aceh Timur dengan ini menerangkan bahwa:
        </div>
        <table style="margin-left: 22pt;">
            <tbody>
                <tr>
                    <td style="width: 120pt;">Nama</td>
                    <td style="text-indent: 24pt;">:</td>
                    <td><?php echo htmlspecialchars($data['nama']); ?></td>
                </tr>
                <tr>
                    <td>NIK</td>
                    <td style="text-indent: 24pt;">:</td>
                    <td><?php echo htmlspecialchars($data['nik']); ?></td>
                </tr>
                <tr>
                    <td>Tempat/Tanggal Lahir</td>
                    <td style="text-indent: 24pt;">:</td>
                    <td><?php echo htmlspecialchars($data['tempat_lahir']); ?>, <?php echo htmlspecialchars($data['tanggal_lahir']); ?></td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td style="text-indent: 24pt;">:</td>
                    <td><?php echo htmlspecialchars($data['jenis_kelamin']); ?></td>
                </tr>
                <tr>
                    <td>Agama</td>
                    <td style="text-indent: 24pt;">:</td>
                    <td><?php echo htmlspecialchars($data['agama']); ?></td>
                </tr>
                <tr>
                    <td>Pekerjaan</td>
                    <td style="text-indent: 24pt;">:</td>
                    <td><?php echo htmlspecialchars($data['pekerjaan']); ?></td>
                </tr>
                <tr>
                    <td>Warganegara</td>
                    <td style="text-indent: 24pt;">:</td>
                    <td><?php echo htmlspecialchars($data['warganegara']); ?></td>
                </tr>
                <tr>
                    <td style="vertical-align: top;">Alamat</td>
                    <td style="text-indent: 24pt; vertical-align: top;">:</td>
                    <td rowspan="2"><?php echo htmlspecialchars($data['alamat']); ?></td>
                </tr>
            </tbody>
        </table>
        <div style="margin-top: 8pt; text-indent: 24pt;">
            Anak dari :
        </div>
        <table style="margin-left: 22pt;">
            <tbody>
                <tr>
                    <td style="width: 120pt;">Nama Ayah</td>
                    <td style="text-indent: 24pt;">:</td>
                    <td><?php echo htmlspecialchars($data['nama_ayah']); ?></td>
                </tr>
                <tr>
                    <td>Nama Ibu</td>
                    <td style="text-indent: 24pt;">:</td>
                    <td><?php echo htmlspecialchars($data['nama_ibu']); ?></td>
                </tr>
            </tbody>
        </table>
        <div style="margin-top: 8pt; text-indent: 24pt;">
            Benar yang tersebut diatas adalah penduduk Gampong Beusa Seberang Kecamatan Peureulak Barat Kabupaten Aceh Timur, dan ianya merupakan salah seorang anak terlantar yang telah terdata di Gampong kami.
        </div>
        <div style="margin-top: 8pt; text-indent: 24pt;">
            Demikian surat keterangan ini kami buat dengan sebenarnya untuk dipergunakan sebagaimana mestinya.
        </div>
        <table style="text-align: center; width: 100%; margin-top: 18pt;">
            <tbody>
                <tr>
                    <td style="width: 60%;"></td>
                    <td>
                        Beusa Seberang, &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
                        Keuchik Gampong Beusa Seberang<br>
                        Kec. Peureulak Barat
                    </td>
                </tr>
                <tr>
                    <td style="height: 80pt;"></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="text-decoration: underline;"><b>M. TAIB</b></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
