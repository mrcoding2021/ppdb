<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Invoice</title>

    <style>
        .invoice-box {
            max-width: 700px;
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

                <td colspan="4" style="text-align: right; font-size: 16px; line-height: 25px">
                    Kwitansi No. <?= $key[0]->id_trx ?> <br>
                    <?= longdate_indo(substr($key[0]->date_created, 0, 10)) ?><br>
                    <div style="content:''; border-bottom: 2px solid black;"></div>
                </td>
            </tr>

            <tr>
                <td colspan="4">Alamat : <br>
                    The Palm Green Residence Sriamur, Kec. Tambun <br> Utara, Bekasi, Jawa Barat 17510
                    <br> Kontak Kami : 082388880459 / 085312029800
                </td>
                <td colspan="3" style="text-align: right;"><strong>
                        <?php $murid = $this->db->get_where('tb_user', array('id_user' => $key[0]->id_murid))->row();
                        if ($murid != null) {
                            echo $murid->nama . ' - ' . $murid->hp . '<br>' . $murid->alamat;
                        } else {
                            echo 'TRANSAKSI KAS';
                        }
                        ?><br>
                    </strong>

                </td>

            </tr>

            <tr class="heading">
                <td>Pembayaran</td>
                <td>Tagihan</td>
                <td>Metode</td>
                <td>Jml. Bayar</td>
                <td>Diskon</td>
                <td>Total Bayar</td>
                <td>Sisa Tagihan</td>
            </tr>
            <?php $i = 0;
            foreach ($key as $k) { ?>
                <?php
                $this->db->where('id_sumber', $k->metode);
                $metode = $this->db->get('tb_metode')->row();
                // var_dump($total);die;
                ?>
                <tr class="item">
                    <td width="20%"> <?= $k->kode ?></td>
                    <td class="angka"><?= rupiah($total[$i]) ?></td>
                    <td><?= $metode->nama ?></td>
                    <td class="angka" width="15%"><?= rupiah($k->kredit) ?></td>
                    <td class="angka" width="15%"><?= rupiah($k->diskon) ?></td>
                    <td class="angka" width="15%"><?= rupiah($k->jumlah) ?></td>
                    <td class="angka" width="15%"><?= rupiah($total[$i] - $k->jumlah) ?></td>
                </tr>
            <?php $i++;
            } ?>


            <tr class="heading">

                <td colspan="2">Grand Total :</td>

                <td colspan="5">
                    <?php $this->db->select_sum('jumlah', 'total');
                    $total = $this->db->get_where('tb_transaksi', array('id_trx' => $key[0]->id_trx))->row();
                    echo rupiah($total->total);
                    ?><br><i><?= str_replace('Koma', '', number_to_words($total->total)) ?> Rupiah</i>
                </td>
            </tr>
        </table>
    </div>
    <script>
        // window.print()
    </script>
</body>

</html>