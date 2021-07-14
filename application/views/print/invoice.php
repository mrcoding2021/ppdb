<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Invoice</title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
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
            line-height: 45px;
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
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="3">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="<?= base_url('asset/img/logo-sdit-full.jpg') ?>" style="width:100%; max-width:300px;margin-top:-20px">
                            </td>
                            <td></td>
                            <td>
                                Kwitansi No. <?= $key->no_invoice ?><br>
                                <?= longdate_indo($key->created_at) ?><br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="3">
                    <table>
                        <tr>
                            <td>Alamat : <br>
                                The Palm Green Residence Sriamur, Kec. Tambun <br> Utara, Bekasi, Jawa Barat 17510
                                <br> Kontak Kami : 082388880459 / 085312029800
                            </td>
                            <td></td>
                            <td><strong>

                                    <?php $murid = $this->db->get_where('tb_user', array('id_user' => $key->id_murid))->row();
                                    echo $murid->nama . '<br>' . $murid->hp . '<br>' . $murid->alamat;
                                    ?><br>
                                </strong>

                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading">
                <td width="25%">
                    Pembayaran
                </td>
                <td width="40%">
                    Metode Pembayaran
                </td>
                <td>
                    Total
                </td>
            </tr>
            <?php foreach ($key as $k) { ?>
                <?php $bayar = $this->db->get_where('tb_rab', array('id' => $k->byr_utk))->row();
                $sumber = $this->db->get_where('tb_sumber', array('id_sumber' => $k->id_sumber))->row();
               
                ?>
                <tr class="item">
                    <td> <?= $bayar->alias ?></td>
                    <td><?= $sumber->nama . ' - ' . $k->ket ?></td>
                    <td><?= rupiah($k->kredit) ?></td>
                </tr>
            <?php } ?>


            <tr class="heading">

                <td>Grand Total :</td>
                
                <td colspan="2">
                    <?php $this->db->select_sum('kredit', 'total');
                    $total = $this->db->get_where('tb_pembayaran', array('no_invoice' => $key[0]->no_invoice))->row();
                    echo rupiah($total->total);
                    ?><br><i><?= str_replace('Koma', '', number_to_words($total->total)) ?> Rupiah</i>
                </td>
            </tr>
        </table>
    </div>
    <script>
        window.print()
    </script>
</body>

</html>