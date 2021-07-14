<html>

<head>
    <title>Cetak PDF</title>
</head>

<body>
    <div style="text-align: center;">
        <h3>FORM PENGAJUAN PERMOHONAN PEMBIAYAAN</h3>
        <H5 style="margin-top: -10px;">USPPS KOPERASI SYARIAH PESANTREN ENTREPRENEUR</H5>
    </div>

    <div style="font-size:12px;">
        <div style="background-color: #616161;">
            <h5 style="text-align: center;color: white;">Data Pribadi Pemohon</h5>
        </div>
        <table style="width: 100%; padding:12px">
            <tr>
                <td>
                    <table>
                        <tr>
                            <td class="q">Jenis Pembiayaan</td>
                            <td class="n">:</td>
                            <td class="a"><?= $key->jns_biaya ?></td>
                        </tr>
                        <tr>
                            <td class="q">Pengajuan</td>
                            <td class="n">:</td>
                            <td class="a"><?= $key->pengajuan ?></td>
                        </tr>
                        <tr>
                            <td class="q">Nama Pemohon</td>
                            <td class="n">:</td>
                            <td class="a"><?= $key->nama ?></td>
                        </tr>
                        <tr>
                            <td class="q">Tempat, tgl lahir</td>
                            <td class="n">:</td>
                            <td class="a"><?= $key->ttl ?></td>
                        </tr>
                        <tr>
                            <td class="q">Pendidikan Terakhir</td>
                            <td class="n">:</td>
                            <td class="a"><?= $key->pendidikan ?></td>
                        </tr>
                        <tr>
                            <td class="q">No. KTP</td>
                            <td class="n">:</td>
                            <td class="a"><?= $key->ktp ?></td>
                        </tr>
                        <tr>
                            <td class="q">No. NPWP</td>
                            <td class="n">:</td>
                            <td class="a"><?= $key->npwp ?></td>
                        </tr>
                        <tr>
                            <td class="q">Jenis Kelamin</td>
                            <td class="n">:</td>
                            <td class="a"><?= $key->sex ?></td>
                        </tr>
                        <tr>
                            <td class="q">Alamat KTP</td>
                            <td class="n">:</td>
                            <td class="a">
                                <p style="max-width:100px"><?= $key->alamat_ktp ?>
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table>
                        <tr>
                            <td class="q">No. Tlp Rumah</td>
                            <td class="n">:</td>
                            <td class="a"><?= $key->tlp_rumah ?></td>
                        </tr>
                        <tr>
                            <td class="q">No. HP</td>
                            <td class="n">:</td>
                            <td class="a"><?= $key->hp ?></td>
                        </tr>
                        <tr>
                            <td class="q">Alamat Domisili</td>
                            <td class="n">:</td>
                            <td class="a">
                                <p style="max-width:100px"><?= $key->domisili ?>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td class="q">Lama Tinggal</td>
                            <td class="n">:</td>
                            <td class="a"><?= $key->lama_tinggal ?></td>
                        </tr>
                        <tr>
                            <td class="q">Status Rumah</td>
                            <td class="n">:</td>
                            <td class="a"><?= $key->status_rmh ?></td>
                        </tr>
                        <tr>
                            <td class="q">Status Perkawinan</td>
                            <td class="n">:</td>
                            <td class="a"><?= $key->status_kawin ?></td>
                        </tr>
                        <tr>
                            <td class="q">Agama</td>
                            <td class="n">:</td>
                            <td class="a"><?= $key->agama ?></td>
                        </tr>
                        <tr>
                            <td class="q">Nama Ibu Kandung</td>
                            <td class="n">:</td>
                            <td class="a"><?= $key->ibu ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

    </div>
    <div style="font-size:12px;">
        <div style="background-color: #616161;">
            <h5 style="text-align: center;color: white;">Data Pekerjaan Pemohon</h5>
        </div>
        <table style="width: 100%; padding:12px">
            <tr>
                <td>
                    <table>
                        <tr>
                            <td class="q">Nama Perusahaan</td>
                            <td class="n">:</td>
                            <td class="a"><?= $key->pt ?></td>
                        </tr>
                        <tr>
                            <td class="q">Lama Bekerja</td>
                            <td class="n">:</td>
                            <td class="a"><?= $key->pengajuan ?></td>
                        </tr>
                        <tr>
                            <td class="q">Bagian / Divisi</td>
                            <td class="n">:</td>
                            <td class="a"><?= $key->nama ?></td>
                        </tr>
                        <tr>
                            <td class="q">Nama Atasan Langsung</td>
                            <td class="n">:</td>
                            <td class="a"><?= $key->ttl ?></td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table>
                        <tr>
                            <td class="q">Alamat Perusahaan</td>
                            <td class="n">:</td>
                            <td class="a"><?= $key->pendidikan ?></td>
                        </tr>
                        <tr>
                            <td class="q">Tlp. Perusahaan</td>
                            <td class="n">:</td>
                            <td class="a"><?= $key->ktp ?></td>
                        </tr>
                        <tr>
                            <td class="q">Ext.</td>
                            <td class="n">:</td>
                            <td class="a"><?= $key->npwp ?></td>
                        </tr>
                        <tr>
                            <td class="q">Pangkat HNI</td>
                            <td class="n">:</td>
                            <td class="a"><?= $key->sex ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
    <div style="font-size:12px;">
        <div style="background-color: #616161;">
            <h5 style="text-align: center;color: white;">Data Suami/Istri</h5>
        </div>
        <table style="width: 100%; padding:12px">
            <tr>
                <td>
                    <table>
                        <tr>
                            <td class="q">Nama Istri / Suami</td>
                            <td class="n">:</td>
                            <td class="a"><?= $key->pt ?></td>
                        </tr>
                        <tr>
                            <td class="q">Pekerjaan</td>
                            <td class="n">:</td>
                            <td class="a"><?= $key->lama_bekerja ?></td>
                        </tr>
                        <tr>
                            <td class="q">Nama Perusahaan</td>
                            <td class="n">:</td>
                            <td class="a"><?= $key->divisi ?></td>
                        </tr>
                        <tr>
                            <td class="q">Bagian / Divisi</td>
                            <td class="n">:</td>
                            <td class="a"><?= $key->atasan ?></td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table>
                        <tr>
                            <td class="q">Lama Bekerja</td>
                            <td class="n">:</td>
                            <td class="a"><?= $key->alaamat_pt ?></td>
                        </tr>
                        <tr>
                            <td class="q">Tlp. Perusahaan</td>
                            <td class="n">:</td>
                            <td class="a"><?= $key->tlp_pt ?></td>
                        </tr>
                        <tr>
                            <td class="q">Tlp. Perusahaan</td>
                            <td class="n">:</td>
                            <td class="a"><?= $key->ext_pt ?></td>
                        </tr>
                        <tr>
                            <td class="q">Ext</td>
                            <td class="n">:</td>
                            <td class="a"><?= $key->hni ?></td>
                        </tr>
                        <tr>
                            <td class="q">Tlp. Istri/Suami</td>
                            <td class="n">:</td>
                            <td class="a"><?= $key->ext_pt ?></td>
                        </tr>

                    </table>
                </td>
            </tr>
        </table>

    </div>
    <div style="font-size:12px;">
        <div style="background-color: #616161;">
            <h5 style="text-align: center;color: white;">Data Penghasilan (Perbulan)</h5>
        </div>
        <table style="width: 100%; padding:12px">
            <tr>
                <td>
                    <table>
                        <tr>
                            <td class="q">Penghasilan</td>
                            <td class="n">:</td>
                            <td class="a"><?= rupiah($key->penghasilan) ?></td>
                        </tr>
                        <tr>
                            <td class="q">Penghasilan Tambahan</td>
                            <td class="n">:</td>
                            <td class="a"><?= rupiah($key->pengahasilan_add) ?></td>
                        </tr>
                        <tr>
                            <td class="q">Keterangan Usaha</td>
                            <td class="n">:</td>
                            <td class="a"><?= $key->ket_usaha ?></td>
                        </tr>
                        <tr>
                            <td class="q">Penghasilan Istri</td>
                            <td class="n">:</td>
                            <td class="a"><?= rupiah($key->penghasilan_istri) ?></td>
                        </tr>
                        <tr>
                            <td class="q">Total Penghasilan</td>
                            <td class="n">:</td>
                            <td class="a"><?= rupiah($key->total_penghasilan) ?></td>
                        </tr>

                    </table>
                </td>
                <td>
                    <table>
                        <tr>
                            <td class="q">Jumlah Tanggungan</td>
                            <td class="n">:</td>
                            <td class="a"><?= $key->family ?></td>
                        </tr>
                        <tr>
                            <td class="q">Pengeluaran Rutin /bulan</td>
                            <td class="n">:</td>
                            <td class="a"><?= rupiah($key->out_rutin) ?></td>
                        </tr>
                        <tr>
                            <td class="q">Kewajiban Tempat Lain</td>
                            <td class="n">:</td>
                            <td class="a"><?= rupiah($key->hutang) ?></td>
                        </tr>
                        <tr>
                            <td class="q">Sisa Pendapatan</td>
                            <td class="n">:</td>
                            <td class="a"><?= rupiah($key->sisa) ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

    </div>
    <div style="font-size:12px;">
        <div style="background-color: #616161;">
            <h5 style="text-align: center;color: white;">Detail Pembiayaan</h5>
        </div>
        <table style="width: 100%; padding:12px">
            <tr>
                <td>
                    <table>
                        <tr>
                            <td class="q">Jumlah Dimohon</td>
                            <td class="n">:</td>
                            <td class="a"><?= rupiah($key->jumlah_dimohon) ?></td>
                        </tr>
                        <tr>
                            <td class="q">Lama Pembiayaan</td>
                            <td class="n">:</td>
                            <td class="a"><?= $key->tenor ?></td>
                        </tr>
                        <tr>
                            <td class="q">Kesanggupan membayar</td>
                            <td class="n">:</td>
                            <td class="a"><?= $key->bayar_perbulan ?></td>
                        </tr>

                    </table>
                </td>
                <td>
                    <table>
                        <tr>
                            <td class="q">Tujuan pembiayaan</td>
                            <td class="n">:</td>
                            <td class="a"><?= $key->ttl ?></td>
                        </tr>
                        <tr>
                            <td class="q">DP </td>
                            <td class="n">:</td>
                            <td class="a"><?= rupiah($key->dp) ?></td>
                        </tr>
                        <tr>
                            <td class="q">Jaminan</td>
                            <td class="n">:</td>
                            <td class="a"><?= $key->agunan ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

    </div>



</body>

</html>