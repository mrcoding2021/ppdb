                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="row">

                        <duv class="col-md-12">
                            <?php $this->load->view('admin/breadcrumb'); ?>
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 bg-dark ">
                                    <h3 class="m-0 text-white font-weight-bold ">
                                        <?= $title; ?>
                                        <a href="#addSetoran" data-toggle="modal" class="btn btn-success btn-border-circle float-right"><i class="fas fa-plus"></i> Buat Setoran</a>
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <ul class="nav nav-pills nav-justified border-bottom-primary" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">RINGKASAN</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">FILTER</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content mt-3" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <table class="table table-hover table-sm">
                                                        <thead class="bg-dark text-white">
                                                            <tr>
                                                                <th>Deskripsi</th>
                                                                <th>Nilai</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <th scope="col">Total yg Sudah disetor</th>
                                                                <td scope="col"><?= rupiah($disetor) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="col">Total yg Belum disetor</th>
                                                                <td scope="col"><?= rupiah($belumDisetor) ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-md-7">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                                            <div class="table-responsive">
                                                <table class="table table-striped table-sm text-center" width="100%" id="dataBni">
                                                    <thead class="bg-dark text-white ">
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Tanggal</th>
                                                            <th>Pembayaran Cash</th>
                                                            <th>Potong Setoran</th>
                                                            <th>Pembayaran Transfer</th>
                                                            <th>Jumlah Setoran Cash BSI</th>
                                                            <th>Aksi</th>
                                                            <th>Disetor</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </duv>
                    </div>


                </div>
                <!-- /.container-fluid -->

                </div>
                <div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-success text-white">
                                <h5 class="modal-title" id="exampleModalLabel">Rekap Pembayaran</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-bordered table-sm table-hover" id="" width="100%" cellspacing="0">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Jenis Setoran</th>
                                            <th>Pembayaran Cash</th>
                                            <th>Potong Setoran</th>
                                            <th>Pembayaran Transfer</th>
                                            <th>Jumlah Setoran Cash BSI</th>
                                        </tr>
                                    </thead>
                                    <tbody id="detailBni">
                                    </tbody>
                                    <tfoot class="bg-secondary text-white">
                                        <tr>
                                            <th colspan="2">GRAND TOTAL</th>
                                            <th id="totalCash">0</th>
                                            <th id="totalPotong">0</th>
                                            <th id="totalTransfer">0</th>
                                            <th id="grandTotal">0</th>
                                        </tr>
                                        <tr>
                                            <th>Terbilang</th>
                                            <th colspan="5" id="terbilang" class="text-italic">Jumlah Bayar</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="modal-footer">
                                    <button class="pt-1 btn btn-block btn-border-circle btn-secondary" type="button" style="position: relative; top: 4px; height:38px" data-dismiss="modal">Close</button>
                                    <a href="#" class="setor btn btn-success btn-border-circle btn-block">Setorkan</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal fade" id="addSetoran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-success text-white">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Setoran</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3 row">
                                    <div class="col-lg-2 col-sm-4">
                                        <label for="1" class="col-form-label">Dari Tanggal</label>
                                        <input type="date" name="start_date" class="start form-control form-control-sm">
                                    </div>
                                    <div class="col-lg-2 col-sm-4">
                                        <label for="1" class="col-form-label">Sampai Tanggal</label>
                                        <input type="date" name="end_date" class="end form-control form-control-sm">
                                    </div>

                                    <div class="col-lg-1 col-sm-4">
                                        <label for="1" class="col-form-label">.</label>
                                        <a href="#" class="cari btn btn-success btn-block btn-sm">Cari</a>
                                    </div>
                                </div>
                                <table class="table table-bordered table-sm table-hover text-center" width="100%" cellspacing="0">
                                    <thead class="bg-primary text-white ">
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Pembayaran Cash</th>
                                            <th>Potong Setoran</th>
                                            <th>Pembayaran Transfer</th>
                                            <th>Jumlah Setoran Cash BSI</th>
                                        </tr>
                                    </thead>
                                    <tbody id="dataSetoran">
                                    </tbody>
                                    <tfoot class="bg-secondary text-white ">
                                        <tr>
                                            <th colspan="2">Total</th>
                                            <th class="cash">0</th>
                                            <th class="potong">0</th>
                                            <th class="transfer">0</th>
                                            <th class="total">0</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="modal-footer">
                                    <button class="pt-1 btn btn-block btn-border-circle btn-secondary" type="button" style="position: relative; top: 4px; height:38px" data-dismiss="modal">Close</button>
                                    <a href="#" class="addSetoran btn btn-success btn-border-circle btn-block">Buat Setoran</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <script>
                    function getSetoran(start, end) {
                        $.ajax({
                            url: '<?= base_url('bni/getSetoran/') ?>',
                            type: 'post',
                            dataType: 'json',
                            data: {
                                'start': start,
                                'end': end
                            },
                            success: function(res) {
                                var html = ''
                                $.each(res, function(i, v) {
                                    html += '<tr>'
                                    html += '<td>' + v.no + '</td>' +
                                        '<td>' + v.date + '</td>' +
                                        '<td>' + v.cash + '</td>' +
                                        '<td>' + v.potong + '</td>' +
                                        '<td>' + v.transfer + '</td>' +
                                        '<td>' + v.total + '</td>'
                                    html += '</tr>'
                                }
                                $('#dataSetoran').html(html)
                                $('.cash').html(res[0].totalCash)
                                $('.potong').html(res[0].totalPotong)
                                $('.transfer').html(res[0].totalTransfer)
                                $('.total').html(res[0].totalTotal)

                            }
                        })
                    }

                    $('.cari').click(function(e) {
                        e.preventDefault()
                        var start = $('.start').val()
                        var end = $('.end').val()
                        getSetoran(start, end)
                    })

                    getBni()

                    function getBni() {
                        var dataBni = $('#dataBni').DataTable({
                            'ajax': {
                                "type": "POST",
                                "url": '<?= base_url('bni/getAll/') ?>',
                                "dataSrc": ""
                            },
                            'pageLength': 100,
                            'destroy': true,
                            "autoWidth": true,
                            'columns': [{
                                    "data": "no"
                                },
                                {
                                    "data": "date"
                                },
                                {
                                    "data": "cash"
                                },
                                {
                                    "data": "potong"
                                },
                                {
                                    "data": "transfer"
                                },
                                {
                                    "data": "total"
                                },
                                {
                                    "data": "aksi"
                                },
                                {
                                    "data": "status"
                                },

                            ]
                        });


                    }

                    $(document).on('click', '.detailBni', function(e) {
                        e.preventDefault()
                        var ta = $(this).data('id')
                        $('.setor').attr('data-date', ta)
                        getDetailBni(ta)
                    })

                    function getDetailBni(ta) {
                        $.ajax({
                            url: '<?= base_url('bni/getDetailBni/') ?>',
                            type: 'post',
                            dataType: 'json',
                            data: {
                                'ta': ta
                            },
                            success: function(res) {
                                var html = ''
                                $.each(res, function(i, v) {
                                    html += '<tr>'
                                    if (i == 0) {
                                        html += '<td>' + v.date + '</td>' +
                                            '<td>' + v.kode + '</td>' +
                                            '<td>' + v.cash + '</td>' +
                                            '<td>' + v.potong + '</td>' +
                                            '<td>' + v.transfer + '</td>' +
                                            '<td>' + v.total + '</td>'
                                    } else {
                                        html += '<td></td>' +
                                            '<td>' + v.kode + '</td>' +
                                            '<td>' + v.cash + '</td>' +
                                            '<td>' + v.potong + '</td>' +
                                            '<td>' + v.transfer + '</td>' +
                                            '<td>' + v.total + '</td>'
                                    }
                                    html += '</tr>'
                                })
                                $('#detailBni').html(html)
                                $('#totalCash').html(res[6].totalCash)
                                $('#totalPotong').html(res[6].totalPotong)
                                $('#totalTransfer').html(res[6].totalTransfer)
                                $('#grandTotal').html(res[6].grandTotal)
                                $('#terbilang').html(res[0].terbilang)

                            }
                        })
                    }

                    $('.setor').click(function(e) {
                        var date = $(this).data('date')
                        Swal.fire({
                            title: "Yakin ingin disetorkan?",
                            text: "Pastikan data sudah benar dan sesuai",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Yes!",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: '<?= base_url('bni/setor') ?>',
                                    data: {
                                        'date': date
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
                                            $('#cetak').attr('href', '<?= base_url('bnni/invoiceSetoran/') ?>' + date)
                                            var hari = $('.hari').val()
                                            var bln = $('.bulan').val()
                                            var thn = $('.tahun').val()
                                            getBni()
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

                    $('.addSetoran').click(function(e) {
                        var date = $(this).data('date')
                        var start = $('.start').val()
                        var end = $('.end').val()
                        var cash = $('.cash').val()
                        var transfer = $('.transfer').val()
                        var potong = $('.potong').val()
                        var total = $('.total').val()
                        Swal.fire({
                            title: "Yakin ingin ditambahkan?",
                            text: "Pastikan data sudah benar dan sesuai",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Yes!",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: '<?= base_url('bni/setor') ?>',
                                    data: {
                                        'date': date
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
                                            $('#cetak').attr('href', '<?= base_url('bnni/invoiceSetoran/') ?>' + date)
                                            var hari = $('.hari').val()
                                            var bln = $('.bulan').val()
                                            var thn = $('.tahun').val()
                                            getBni()
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