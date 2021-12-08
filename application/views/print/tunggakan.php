<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Tunggakan Pembayaran Persiswa</title>

    <style>
        .invoice-box {
            max-width: 1000px;
            margin: auto;
            padding: 10px;
            /* border: 1px solid #eee; */
            /* box-shadow: 0 0 10px rgba(0, 0, 0, .15); */
            font-size: 12px;
            line-height: 16px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: 16px;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(3) {
            text-align: right;
        }

        /* .invoice-box table tr.top table td {
            padding-bottom: 10px;
        } */

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 20px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
            border: 1px solid black;
            text-align: center;
        }

        .invoice-box table tr.fill td {
            border-bottom: 1px solid #ddd;
            font-weight: bold;
            border: 1px solid black;
            text-align: center;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
            font-size: 12px;
        }

        .invoice-box table tr.item td.angka {
            text-align: right;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(3) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .rtl table {
            text-align: right;
        }

        .rtl table tr td:nth-child(2) {
            text-align: left;
        }

        @page {
            size: auto;
            /* auto is the initial value */
            margin: 0;
            /* this affects the margin in the printer settings */
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table>

            <tr>
                <td colspan="3" class="title">
                    <img src="<?= base_url('asset/img/logo-sdit-full.jpg') ?>" style="width:100%; max-width:300px;margin-top:-20px">
                </td>

                <td colspan="9" style="text-align: right; font-size: 16px; line-height: 25px">
                    LAPORAN PEMBAYARAN DAN TUNGGAKAN PERSISWA <br>
                    Per Tanggal : <?= longdate_indo(date('Y-m-d')) ?><br>
                    <div style="content:''; border-bottom: 2px solid black;"></div>
                </td>
            </tr>

            <tr>
                <td colspan="3">Alamat : <br>
                    The Palm Green Residence Sriamur, Kec. Tambun Utara, Bekasi, Jawa Barat 17510
                    <br> Kontak Kami : 082388880459 / 085312029800
                </td>
                <td colspan="9" style="text-align: right;">
                    <strong>
                        <?= $key->nama . ' | HP : ' . $key->hp ?><br>
                        NIS : <?= $key->nis . ' | NISN : ' . $key->nisn ?><br>
                        <?= $key->alamat ?>

                    </strong>

                </td>

            </tr>

            <tr class="heading">
                <td rowspan="2">No.</td>
                <td rowspan="2">Tahun Ajaran</td>
                <td colspan="8">JUMLAH BIAYA PENDIDIKAN YANG SUDAH TERBAYAR</td>
            </tr>
            <tr class="heading">
                <td>Pembangunan</td>
                <td>Kegiatan</td>
                <td>Seragam</td>
                <td>Komite</td>
                <td>Buku Paket</td>
                <td>SPP</td>
                <td>SARPRAS</td>
                <td>Total</td>
            </tr>

            <?php
            $pembangunan = 0;
            $kegiatan = 0;
            $seragam = 0;
            $komite = 0;
            $buku_paket = 0;
            $spp = 0;
            $sarpras = 0;
            $total = 0;
            foreach ($lunas as $k) { ?>
                <tr class="fill">
                    <td><?= $k['no'] ?></td>
                    <td><?= $k['ta'] ?></td>
                    <td width="10%"><?= $k['pembangunan'] ?></td>
                    <td width="10%"><?= $k['kegiatan'] ?></td>
                    <td width="10%"><?= $k['seragam'] ?></td>
                    <td width="10%"><?= $k['komite'] ?></td>
                    <td width="10%"><?= $k['buku_paket'] ?></td>
                    <td width="10%"><?= $k['spp'] ?></td>
                    <td width="10%"><?= $k['sarpras'] ?></td>
                    <td width="10%"><?= $k['total'] ?></td>
                </tr>
            <?php
                if ($k['pembangunan'] != 0) {
                    $pembangunan = $pembangunan + str_replace('.', '', $k['pembangunan']);
                    $kegiatan = $kegiatan + str_replace('.', '', $k['kegiatan']);
                    $seragam = $seragam + str_replace('.', '', $k['seragam']);
                    $komite = $komite + str_replace('.', '', $k['komite']);
                    $buku_paket = $buku_paket + str_replace('.', '', $k['buku_paket']);
                    $spp = $spp + str_replace('.', '', $k['spp']);
                    $sarpras = $sarpras + str_replace('.', '', $k['sarpras']);
                    $total = $total + str_replace('.', '', $k['total']);
                } else {
                    $pembangunan = $pembangunan + str_replace('.', '', $k['pembangunan']);
                    $kegiatan = $kegiatan + str_replace('.', '', $k['kegiatan']);
                    $seragam = $seragam + str_replace('.', '', $k['seragam']);
                    $komite = $komite + str_replace('.', '', $k['komite']);
                    $buku_paket = $buku_paket + str_replace('.', '', $k['buku_paket']);
                    $spp = $spp + str_replace('.', '', $k['spp']);
                    $sarpras = $sarpras + str_replace('.', '', $k['sarpras']);
                    $total = $total + (int)str_replace('.', '', $k['total']);
                }
            } ?>
            <tr class="heading">
                <td colspan="2">Grand Total :</td>
                <td><?= rupiah($pembangunan) ?></td>
                <td><?= rupiah($kegiatan) ?></td>
                <td><?= rupiah($seragam) ?></td>
                <td><?= rupiah($komite) ?></td>
                <td><?= rupiah($buku_paket) ?></td>
                <td><?= rupiah($spp) ?></td>
                <td><?= rupiah($sarpras) ?></td>
                <td><?= rupiah($total) ?></td>
            </tr>
            <tr>
                <td colspan="10"></td>
            </tr>
            <tr>
                <td colspan="10"></td>
            </tr>
            <tr class="heading">
                <td rowspan="2">No.</td>
                <td rowspan="2">Tahun Ajaran</td>
                <td colspan="8">JUMLAH BIAYA PENDIDIKAN YANG BELUM TERBAYAR</td>
            </tr>
            <tr class="heading">
                <td>Pembangunan</td>
                <td>Kegiatan</td>
                <td>Seragam</td>
                <td>Komite</td>
                <td>Buku Paket</td>
                <td>SPP</td>
                <td>SARPRAS</td>
                <td>Total</td>
            </tr>

            <?php
            $pembangunan = 0;
            $kegiatan = 0;
            $seragam = 0;
            $komite = 0;
            $buku_paket = 0;
            $spp = 0;
            $sarpras = 0;
            $total = 0;
            foreach ($hutang as $k) { ?>
                <tr class="fill">
                    <td><?= $k['no'] ?></td>
                    <td><?= $k['ta'] ?></td>
                    <td width="10%"><?= ($k['pembangunan'] < 0) ? '+' . str_replace('-', '', $k['pembangunan']) : $k['pembangunan'] ?></td>
                    <td width="10%"><?= ($k['kegiatan'] < 0) ? '+' . str_replace('-', '', $k['kegiatan']) : $k['kegiatan'] ?></td>
                    <td width="10%"><?= ($k['seragam'] < 0) ? '+' . str_replace('-', '', $k['seragam']) : $k['seragam'] ?></td>
                    <td width="10%"><?= ($k['komite'] < 0) ? '+' . str_replace('-', '', $k['komite']) : $k['komite'] ?></td>
                    <td width="10%"><?= ($k['buku_paket'] < 0) ? '+' . str_replace('-', '', $k['buku_paket']) : $k['buku_paket'] ?></td>
                    <td width="10%"><?= ($k['spp'] < 0) ? '+' . str_replace('-', '', $k['spp']) : $k['spp'] ?></td>
                    <td width="10%"><?= ($k['sarpras'] < 0) ? '+' . str_replace('-', '', $k['sarpras']) : $k['sarpras'] ?></td>
                    <td width="10%"><?= ($k['total'] < 0) ? '+' . str_replace('-', '', $k['total']) : $k['total'] ?></td>
                </tr>
            <?php
                if ($k['pembangunan'] != 0) {
                    $pembangunan = $pembangunan + str_replace('.', '', $k['pembangunan']);
                    $kegiatan = $kegiatan + str_replace('.', '', $k['kegiatan']);
                    $seragam = $seragam + str_replace('.', '', $k['seragam']);
                    $komite = $komite + str_replace('.', '', $k['komite']);
                    $buku_paket = $buku_paket + str_replace('.', '', $k['buku_paket']);
                    $spp = $spp + str_replace('.', '', $k['spp']);
                    $sarpras = $sarpras + str_replace('.', '', $k['sarpras']);
                    $total = $total + str_replace('.', '', $k['total']);
                } else {
                    $total = $total + str_replace('.', '', $k['total']);
                    $pembangunan = $pembangunan + str_replace('.', '', $k['pembangunan']);
                    $kegiatan = $kegiatan + str_replace('.', '', $k['kegiatan']);
                    $seragam = $seragam + str_replace('.', '', $k['seragam']);
                    $komite = $komite + str_replace('.', '', $k['komite']);
                    $buku_paket = $buku_paket + str_replace('.', '', $k['buku_paket']);
                    $spp = $spp + str_replace('.', '', $k['spp']);
                    $sarpras = $sarpras + str_replace('.', '', $k['sarpras']);
                }
            } ?>
            <tr class="heading">
                <td colspan="2">Grand Total :</td>
                <td><?= ($pembangunan >= 0) ? rupiah($pembangunan) : '+' . rupiah(str_replace('-', '', $pembangunan)) ?></td>
                <td><?= ($kegiatan >= 0) ? rupiah($kegiatan) : '+' . rupiah(str_replace('-', '', $kegiatan)) ?></td>
                <td><?= ($seragam >= 0) ? rupiah($seragam) : '+' . rupiah(str_replace('-', '', $seragam)) ?></td>
                <td><?= ($komite >= 0) ? rupiah($komite) : '+' . rupiah(str_replace('-', '', $komite)) ?></td>
                <td><?= ($buku_paket >= 0) ? rupiah($buku_paket) : '+' . rupiah(str_replace('-', '', $buku_paket)) ?></td>
                <td><?= ($spp >= 0) ? rupiah($spp) : '+' . rupiah(str_replace('-', '', $spp)) ?></td>
                <td><?= ($sarpras >= 0) ? rupiah($sarpras) : '+' . rupiah(str_replace('-', '', $sarpras)) ?></td>
                <td><?= ($total >= 0) ? rupiah($total) : '+' . rupiah(str_replace('-', '', $total)) ?></td>
            </tr>
        </table>
    </div>
    <script>
        // window.print()
    </script>
</body>

</html>