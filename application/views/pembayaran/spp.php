<div class="mb-3 row">
    <div class="col-lg-2 col-sm-4">
        <label for="1" class="col-form-label">Dari Tanggal</label>
        <input type="date" class="start form-control-sm form-control" name="start" value="<?= date('Y-m') . '-01' ?>">
    </div>
    <div class="col-lg-2 col-sm-4">
        <label for="1" class="col-form-label">Sampai Tanggal</label>
        <input type="date" class="end form-control-sm form-control" name="end" value="<?= date('Y-m-d') ?>">
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
    <table class="table table-bordered" id="sppBayar" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Tahun Ajaran</th>
                <th>Jumlah</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<script>
    $('.find').click(function(e) {
        e.preventDefault()
        var start = $('.dari').val()
        var end = $('.ke').val()
        $.ajax({
            url: '<?= base_url('acc/tandaTerima/') ?>',
            type: 'post',
            dataType: 'json',
            data: {
                'inv': start,
                'end': end
            },
            success: function(res) {
                console.log(res)
                var html = '<tr>'
                $.each(res, function(i, v) {
                    html += '<td>' + v.jns + '</td>' +
                        '<td>' + v.akun + '</td>' +
                        '<td>' + v.metode + '</td>' +
                        '<td>' + v.tagihan + '</td>' +
                        '<td>' + v.bayar + '</td>' +
                        '<td>' + v.diskon + '</td>' +
                        '<td>' + v.jml + '</td></tr>'
                })
                $('#rincianBayar').html(html)
                $('.totalBayar').html(res[0].total)
                $('.terbilang').html(res[0].terbilang)
            }
        })
    })

    $('.cari').click(function(e) {
        e.preventDefault()
        var start = $('.start').val()
        var end = $('.end').val()
        $('.excel').attr('href', '<?= base_url('pembayaran/export/') ?>' + start + '/' + end)
        getPem(start, end)
    })

    var start = $('.start').val()
    var end = $('.end').val()
    getPem(start, end)

    function getPem(start, end) {
        var dataAcc = $('#dataAcc').DataTable({
            'ajax': {
                "type": "POST",
                "url": '<?= base_url('pembayaran/getPembayaran/') ?>' + start + '/' + end,
                "dataSrc": ""
            },
            'destroy': true,
            'columns': [{
                    "data": "no"
                },
                {
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
                    "data": "jumlah"
                },
                {
                    "data": "jumlah",
                    "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                        $(nTd).html("<a data-toggle='modal' class='mr-1 more btn btn-info btn-sm' href='#more' data-id=" + oData.inv + "><i class='fa fa-search'></i></a><a target='_blank' class='mr-1 btn btn-success btn-sm' href='<?= base_url('cetak/invoice/') ?>" + oData.inv + "'><i class='fa fa-print'></i></a><a data-id=" + oData.inv + " class='delete mr-1 btn btn-danger btn-sm' href='#'><i class='fa fa-times'></i></a>");
                    },
                    "className": 'details-control',
                    "orderable": false,
                    "data": null,
                    "defaultContent": ''
                },
            ]
        });


    }

    $('.ta').change(function(e) {
        e.preventDefault()
        var id = $('.id_murid').val()
        var ta = $(this).val()
        getPersiswa(id, ta)
    })

    function getPersiswa(id, ta) {
        var persiswa = $('#persiswa').DataTable({
            'ajax': {
                "type": "POST",
                "url": '<?= base_url('pembayaran/getPerSiswa/') ?>' + id + '/' + ta,
                "dataSrc": ""
            },
            'destroy': true,
            "order": [
                [1, "asc"]
            ],
            'columns': [{
                    "data": "no"
                },
                {
                    "data": "tgl"
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
                    "data": "buku_paket"
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
                        $(nTd).html("<a data-toggle='modal' class='mr-1 more btn btn-info btn-sm' href='#more' data-id=" + oData.inv + "><i class='fa fa-search'></i></a><a target='_blank' class='mr-1 btn btn-success btn-sm' href='<?= base_url('cetak/invoice/') ?>" + oData.inv + "'><i class='fa fa-print'></i></a><a data-id=" + oData.inv + " class='delete mr-1 btn btn-danger btn-sm' href='#'><i class='fa fa-times'></i></a>");
                    },
                    "className": 'details-control',
                    "orderable": true,
                    "data": null,
                    "defaultContent": ''
                },
            ]
        });


    }

    $(document).on('click', '.more', function() {
        var inv = $(this).data('id')
        $('.terima').attr('data-id', inv)
        $.ajax({
            url: '<?= base_url('acc/getMore/') ?>',
            type: 'post',
            dataType: 'json',
            data: {
                'inv': inv
            },
            success: function(res) {
                console.log(res)
                var html = '<tr>'
                $.each(res, function(i, v) {
                    html += '<td>' + v.jns + '</td>' +
                        '<td>' + v.akun + '</td>' +
                        '<td>' + v.metode + '</td>' +
                        '<td>' + v.tagihan + '</td>' +
                        '<td>' + v.bayar + '</td>' +
                        '<td>' + v.diskon + '</td>' +
                        '<td>' + v.jml + '</td></tr>'
                })
                $('#rincianBayar').html(html)
                $('.totalBayar').html(res[0].total)
                $('.terbilang').html(res[0].terbilang)
            }
        })
    })

    $(document).on('click', '.delete', function(e) {
        var id = $(this).data('id')
        var id_trx = $('#inv').text()
        var id_murid = $('.id_murid').val()
        e.preventDefault()
        Swal.fire({
            title: "Yakin ingin dihapus?",
            text: "Data transaksi ini akan terhapus permanen",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, hapus!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url('acc/delete') ?>',
                    data: {
                        'id': id
                    },
                    dataType: 'json',
                    type: 'POST',
                    beforeSend: function() {
                        Swal.fire({
                            html: '<div class="p-5"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>',
                            showConfirmButton: false
                        })
                    },
                    success: function(res) {
                        if (res.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                html: `${res.sukses}`
                            })
                            var start = $('.start').val()
                            var end = $('.end').val()
                            getPem(start, end)

                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal !',
                                html: `${res.error}`
                            })
                        }

                    }
                })
            }
        });
    })
</script>