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
            SURAT KETERANGAN JUAL BELI HEWAN
        </span><br>
        <span>
            Nomor: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/
        </span>
    </div>
    <div style="margin-top: 24pt; text-align: justify;">
        <div style="text-indent: 24pt;">
            Keuchik Gampong Beusa Seberang Kecamatan Peureulak Barat Kabupaten Aceh Timur dengan ini menerangkan bahwa:
        </div>
        <div>
            <b>Pihak Pertama (I):</b>
        </div>
        <table>
            <tbody>
                <tr>
                    <td rowspan="5"></td>
                    <td style="width: 120pt;">Nama</td>
                    <td style="text-indent: 24pt;">:</td>
                    <td><?php echo htmlspecialchars($data['nama']); ?></td>
                </tr>
                <tr>
                    <td>Tempat/Tanggal Lahir</td>
                    <td style="text-indent: 24pt;">:</td>
                    <td><?php echo htmlspecialchars($data['tempat_lahir']); ?>, <?php echo htmlspecialchars($data['tanggal_lahir']); ?></td>
                </tr>
                <tr>
                    <td>Pekerjaan</td>
                    <td style="text-indent: 24pt;">:</td>
                    <td><?php echo htmlspecialchars($data['pekerjaan']); ?></td>
                </tr>
                <tr>
                    <td style="vertical-align: top;">Alamat</td>
                    <td style="text-indent: 24pt; vertical-align: top;">:</td>
                    <td rowspan="2"><?php echo htmlspecialchars($data['alamat']); ?></td>
                </tr>
            </tbody>
        </table>
        <div>
            <b>Pihak Kedua (II):</b>
        </div>
        <table>
            <tbody>
                <tr>
                    <td rowspan="5"></td>
                    <td style="width: 120pt;">Nama</td>
                    <td style="text-indent: 24pt;">:</td>
                    <td><?php echo htmlspecialchars($data['nama']); ?></td>
                </tr>
                <tr>
                    <td>Tempat/Tanggal Lahir</td>
                    <td style="text-indent: 24pt;">:</td>
                    <td><?php echo htmlspecialchars($data['tempat_lahir']); ?>, <?php echo htmlspecialchars($data['tanggal_lahir']); ?></td>
                </tr>
                <tr>
                    <td>Pekerjaan</td>
                    <td style="text-indent: 24pt;">:</td>
                    <td><?php echo htmlspecialchars($data['pekerjaan']); ?></td>
                </tr>
                <tr>
                    <td style="vertical-align: top;">Alamat</td>
                    <td style="text-indent: 24pt; vertical-align: top;">:</td>
                    <td rowspan="2"><?php echo htmlspecialchars($data['alamat']); ?></td>
                </tr>
            </tbody>
        </table>
        <div style="margin-top: 8pt; text-indent: 24pt;">
            Yang tersebut namanya diatas (Pihak Pertama) benar telah menjual <?php echo htmlspecialchars($data['jumlah_hewan']); ?> ekor <?php echo htmlspecialchars($data['nama_hewan']); ?>,
             jenis kelamin <?php echo htmlspecialchars($data['kelamin_hewan']); ?>, warna bulu <?php echo htmlspecialchars($data['warna_bulu']); ?>, tanduk : <?php echo htmlspecialchars($data['tanduk']); ?>,
             umur <?php echo htmlspecialchars($data['umur_hewan_huruf']); ?> (<?php echo htmlspecialchars($data['umur_hewan_kata']); ?>) tahun, tanda-tanda lain <?php echo htmlspecialchars($data['tanda-tanda_lain']); ?>,
             pihak kedua. Dengan harga penjualan Rp.<?php echo htmlspecialchars($data['harga_angka']); ?> (<?php echo htmlspecialchars($data['harga_kata']); ?>).
        </div>
        <div style="margin-top: 8pt; text-indent: 24pt;">
            Demikian surat keterangan ini kami buat dengan sebenarnya untuk dipergunakan sebagaimana mestinya.
        </div>
        <table style="text-align: center; width: 100%; margin-top: 18pt;">
            <tbody>
                <tr>
                    <td colspan="2" style="width: 60%;"></td>
                    <td>
                        Beusa Seberang, &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td rowspan="3" style="width: 30%;"></td>
                    <td></td>
                </tr>
                <tr>
                    <td style="height: 80pt;"></td>
                    <td></td>
                </tr>
                <tr>
                    <td>(<?php echo htmlspecialchars($data['nama2']); ?>)</td>
                    <td>(<?php echo htmlspecialchars($data['nama1']); ?>)</td>
                </tr>
                <tr>
                    <td>
                        Saksi :<br>
                        Kepala Dusun <?php echo htmlspecialchars($data['asal_kadus']); ?>
                    </td>
                    <td rowspan="3" style="width: 30%;"></td>
                    <td>
                        Keuchik Gampong Beusa Seberang<br>
                        Kec. Peureulak Barat
                    </td>
                </tr>
                <tr>
                    <td style="height: 80pt;"></td>
                    <td></td>
                </tr>
                <tr>
                    <td style="text-decoration: underline;"><?php echo htmlspecialchars($data['nama_kadus']); ?></td>
                    <td style="text-decoration: underline;"><b>M. TAIB</b></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
