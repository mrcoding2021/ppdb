<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Cetak Tanda Terima Setoran BSI</title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 10px;
            /* border: 1px solid #eee; */
            /* box-shadow: 0 0 10px rgba(0, 0, 0, .15); */
            font-size: 14px;
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
            size: portrait;
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
            </tr>
            <tr>
                <td colspan="6">Hari, Tanggal : <?= ($key[0]['hari']) ?>
                </td>

            </tr>
            <tr class="heading">
                <td>No</td>
                <td>Pembayaran</td>
                <td>Tunai / Rp</td>
                <td>Tabungan</td>
                <td>Transfer</td>
                <td>Jumlah Setoran</td>
            </tr>
            <?php $i = 1;
            foreach ($key as $k) { ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $k['jns'] ?></td>
                    <td><?= $k['total'] ?></td>
                    <td><?= $k['tabungan'] ?></td>
                    <td><?= $k['transfer'] ?></td>
                    <td><?= $k['cash'] ?></td>
                </tr>
            <?php $i++;
            } ?>


            <tr class="heading">
                <td colspan="2">Grand Total :</td>
                <td><?= $key[count($key) - 1]['ttotal'] ?></td>
                <td><?= $key[count($key) - 1]['tabungan'] ?></td>
                <td><?= $key[count($key) - 1]['ttransfer'] ?></td>
                <td><?= $key[count($key) - 1]['tcash'] ?></td>
            </tr>
        </table>
        <table style="text-align: center; margin-top: 20px">
            <tr>
                <td colspan="2">Mengetahui,</td>
                <td colspan="2">Diterima oleh,</td>
            </tr>
            <tr><td style="height: 50px;"></td></tr>
            <tr>
                <td colspan="2">Bendahara Yayasan</td>
                <td colspan="2">Kepala TU</td>
            </tr>
        </table>
    </div>
  
</body>

</html>