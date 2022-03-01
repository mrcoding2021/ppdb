<div class="mb-3 row">
    <div class="col-lg-2 col-sm-4">
        <label for="1" class="col-form-label">Dari Tanggal</label>
        <input type="date" class="startBayar form-control-sm form-control" name="start" value="<?= date('Y-m') . '-01' ?>">
    </div>
    <div class="col-lg-2 col-sm-4">
        <label for="1" class="col-form-label">Sampai Tanggal</label>
        <input type="date" class="endBayar form-control-sm form-control" name="end" value="<?= date('Y-m-d') ?>">
    </div>

    <div class="col-lg-1 col-sm-4">
        <label for="1" class="col-form-label">.</label>
        <a href="#" class="cari btn btn-success btn-block btn-sm">Cari</a>
    </div>
    <div class="col-lg-2 col-sm-4">
        <label for="1" class="col-form-label">.</label>
        <a href="<?= base_url('sispem/pemasukan') ?>" data-id="excel" class="excel btn btn-primary btn-block btn-sm">Export Excel</a>
    </div>

</div>
<div class="table-responsive">
    <table class="table table-bordered" id="dataAcc" width="100%" cellspacing="0">
        <thead>
            <tr>
                <!-- <th>No</th> -->
                <th rowspan="2">Tanggal</th>
                <th rowspan="2">Nama</th>
                <th rowspan="2">Kelas</th>
                <th rowspan="2">Tahun Ajaran</th>
                <th colspan="7">Jenis Pembayaran</th>
                <th rowspan="2">Jumlah</th>
                <th rowspan="2">Aksi</th>
            </tr>
            <tr>
                <td>PEMBANGUNAN</td>
                <td>KEGIATAN</td>
                <td>SERAGAM</td>
                <td>KOMITE</td>
                <td>BUKU PAKET</td>
                <td>SPP</td>
                <td>SARPRAS</td>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<script>
    $('.cari').click(function(e) {
        e.preventDefault()
        var start = $('.startBayar').val()
        var end = $('.endBayar').val()
        $('.excel').attr('href', '<?= base_url('pembayaran/export/') ?>' + start + '/' + end)
        getPem(start, end)
    })

    var start = $('.startBayar').val()
    var end = $('.endBayar').val()
    getPem(start, end)

    function getPem(start, end) {
        var dataAcc = $('#dataAcc').DataTable({
            'ajax': {
                "type": "POST",
                "url": '<?= base_url('pembayaran/getPembayaran/') ?>' + start + '/' + end,
                "dataSrc": ""
            },
            'destroy': true,
            "order": [
                [0, "asc"]
            ],
            'columns': [{
                    "data": "tgl"
                },
                {
                    "data": "siswa"
                },
                {
                    "data": "kelas"
                },
                {
                    "data": "ta"
                },
                {
                    "data": "pembangunan"
                },
                {
                    "data": "kegiatan"
                },
                {
                    "data": "seragam"
                },
                {
                    "data": "komite"
                },
                {
                    "data": "buku"
                },
                {
                    "data": "spp"
                },
                {
                    "data": "sarpras"
                },
                {
                    "data": "jumlah"
                },
                {
                    "data": "jumlah",
                    "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                        $(nTd).html("<a target='_blank' class='mr-1 btn btn-success btn-sm' href='<?= base_url('cetak/invoice/') ?>" + oData.inv + "'><i class='fa fa-print'></i></a><a data-id=" + oData.inv + " class='delete mr-1 btn btn-danger btn-sm' href='#'><i class='fa fa-times'></i></a>");
                    },
                    "className": 'details-control',
                    "orderable": false,
                    "data": null,
                    "defaultContent": ''
                },
            ]
        });

        var ta = $('.taAll').val()
        getAllSiswa(ta)
    }
</script>