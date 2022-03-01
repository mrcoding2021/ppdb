                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="row">

                        <duv class="col-md-12">
                            <?php $this->load->view('admin/breadcrumb'); ?>
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 bg-dark ">
                                    <h3 class="m-0 text-white font-weight-bold ">
                                        <?= $title; ?>
                                        <a href="#addSetoran" data-toggle="modal" class="tambah btn btn-success btn-border-circle float-right"><i class="fas fa-plus"></i> Buat Setoran</a>
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
                                                            <th>Dari Tanggal</th>
                                                            <th>Sampai Tanggal</th>
                                                            <th>Pembayaran Cash</th>
                                                            <th>Potong Setoran</th>
                                                            <th>Pembayaran Transfer</th>
                                                            <th>Jumlah Setoran Cash BSI</th>
                                                            <th width="20%">Aksi</th>
                                                            <th width="15%">Status Disetor</th>
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
                                <ul class="nav nav-pills nav-justified border-bottom-primary" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#detil" role="tab" aria-controls="home" aria-selected="true">Rincian Transaksi</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link " id="profile-tab" data-toggle="tab" href="#report" role="tab" aria-controls="profile" aria-selected="false">Laporan</a>
                                    </li>
                                </ul>
                                <div class="tab-content mt-3" id="myTabContent">
                                    <div class="tab-pane fade show active" id="detil" role="tabpanel" aria-labelledby="home-tab">

                                        <form action="<?= base_url('bni/addSetoran/') ?>" id="datSetoran">
                                            <div class="mb-3 row">
                                                <div class="col-lg-2 col-sm-4">
                                                    <label for="1" class="col-form-label">Dari Tanggal</label>
                                                    <input type="date" class="start form-control-sm form-control" name="start" value="<?= date('Y-m') . '-01' ?>">
                                                    <input type="hidden" name="id" class="id">
                                                    <input type="hidden" name="cash" class="cash">
                                                    <input type="hidden" name="potong" class="potong">
                                                    <input type="hidden" name="transfer" class="transfer">
                                                    <input type="hidden" name="total" class="total">
                                                </div>
                                                <div class="col-lg-2 col-sm-4">
                                                    <label for="1" class="col-form-label">Sampai Tanggal</label>
                                                    <input type="date" class="end form-control-sm form-control" name="end" value="<?= date('Y-m-d') ?>">
                                                </div>
                                                <div class="col-lg-1 col-sm-4">
                                                    <label for="1" class="col-form-label">.</label>
                                                    <a href="#" class="cari btn btn-success btn-block btn-sm">Cari</a>
                                                </div>
                                                <div class="col-lg-7">
                                                    <label for="1" class="col-form-label">Keterangan</label>
                                                    <input type="text" class="ket form-control form-control-sm" name="ket">
                                                </div>

                                            </div>
                                            <table class="table table-bordered table-sm table-hover text-center" width="100%" cellspacing="0">
                                                <thead class="bg-primary text-white ">
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Tanggal</th>
                                                        <th>Nama Siswa</th>
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
                                                        <th colspan="3">Total</th>
                                                        <th class="cash">0</th>
                                                        <th class="potong">0</th>
                                                        <th class="transfer">0</th>
                                                        <th class="total">0</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade " id="report" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-sm r" width="100%">
                                                <thead class="bg-dark text-white text-cente">
                                                    <tr>
                                                        <th>Hari, tanggal</th>
                                                        <th>Transaksi Setoran</th>
                                                        <th>Pembayaran Cash</th>
                                                        <th>Pembayaran Transfer</th>
                                                        <th>Jumlah Penerimaan <br> Pembayaran Siswa</th>
                                                        <th>Potong Setoran</th>
                                                        <th>Total Setoran ke BSI</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="lap">

                                                </tbody>
                                                <tfoot class="bg-dark text-white ">
                                                    <tr>
                                                        <th colspan="2">Total</th>
                                                        <th class="tcash">0</th>
                                                        <th class="ttransfer">0</th>
                                                        <th class="ttotal">0</th>
                                                        <th class="tpotong">0</th>
                                                        <th class="tsetoran">0</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="pt-1 btn btn-block btn-border-circle btn-danger" type="button" style="position: relative; top: 4px; height:38px" data-dismiss="modal"><i class="fa fa-rimes"></i> Close</button>
                                <a href="#" class="addSetoran btn btn-success btn-border-circle btn-block"><i class="fa fa-check"></i> Buat Setoran</a>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- </div> -->

                <script>
                    $('.tambah').click(function() {
                        $('#dataSetoran').html('<tr><td colspan="7">Data Tidak Ditemukan</td></tr>')
                        $('#lap').html('<tr class="text-center"><td colspan="7">Data Tidak Ditemukan</td></tr>')
                        $('.id').val('')
                    })

                    function getSetoran(start, end, id, ket) {
                        $.ajax({
                            url: '<?= base_url('bni/getSetoran/') ?>',
                            type: 'post',
                            dataType: 'json',
                            data: {
                                'id': id,
                                'start': start,
                                'end': end,
                                'ket': ket
                            },
                            beforeSend: function() {
                                var html = '<tr><td colspan="7"><img width="100px" src="https://miro.medium.com/max/1400/1*CsJ05WEGfunYMLGfsT2sXA.gif"> Mencari Data .....</td></tr>'
                                $('#dataSetoran').html(html)
                            },
                            success: function(res) {

                                var html = ''
                                if (res.length == 0) {
                                    html += '<tr><td colspan="7">Data Tidak Ditemukan</td></tr>'
                                    $('#dataSetoran').html(html)
                                    $('.cash').html(0)
                                    $('.potong').html(0)
                                    $('.transfer').html(0)
                                    $('.total').html(0)
                                } else {
                                    var kode = res.length
                                    for (let i = 0; i < kode; i++) {
                                        html += '<tr>'
                                        html += '<td>' + res[i].no + '<input type="hidden" class="form-control form-control-sm" value="' + res[i].id_trx + '" name="inv"></td>' +
                                            '<td>' + res[i].date + '</td>' +
                                            '<td class="text-left">' + res[i].siswa + '</td>' +
                                            '<td>' + res[i].cash + '</td>' +
                                            '<td>' + res[i].potong + '</td>' +
                                            '<td>' + res[i].transfer + '</td>' +
                                            '<td>' + res[i].total + '</td>'
                                        html += '</tr>'
                                    }

                                    $('#dataSetoran').html(html)
                                    $('.cash').html(res[kode - 1].totalCash)
                                    $('.potong').html(res[kode - 1].totalPotong)
                                    $('.transfer').html(res[kode - 1].totalTransfer)
                                    $('.total').html(res[kode - 1].totalAll)
                                    $('.cash').val(res[kode - 1].totalCash)
                                    $('.potong').val(res[kode - 1].totalPotong)
                                    $('.transfer').val(res[kode - 1].totalTransfer)
                                    $('.total').val(res[kode - 1].totalAll)
                                    $('.id').val(res[kode - 1].id)
                                    $('.ket').val(res[kode - 1].ket)

                                }

                            }
                        })
                    }

                    function getResume(start, end, id, ket) {
                        $.ajax({
                            url: '<?= base_url('bni/getResume/') ?>',
                            type: 'post',
                            dataType: 'json',
                            data: {
                                'id': id,
                                'start': start,
                                'end': end,
                                'ket': ket
                            },
                            beforeSend: function() {
                                var html = '<tr class="text-center"><td colspan="7"><img width="100px" src="https://miro.medium.com/max/1400/1*CsJ05WEGfunYMLGfsT2sXA.gif"> Mencari Data .....</td></tr>'
                                $('#lap').html(html)
                            },
                            success: function(res) {
                                var html = ''
                                var kode = res.length

                                for (let i = 0; i < kode; i++) {
                                    html += '<tr>'
                                    if (i == 0) {
                                        html += '<td rowspan="7">' + res[i].hari + '</td>' +
                                            '<td>' + res[i].jns + '</td>' +
                                            '<td>' + res[i].cash + '</td>' +
                                            '<td>' + res[i].transfer + '</td>' +
                                            '<td>' + res[i].total + '</td>' +
                                            '<td>' + res[i].potong + '</td>' +
                                            '<td>' + res[i].setoran + '</td>'
                                    } else {
                                        html += '<td>' + res[i].jns + '</td>' +
                                            '<td>' + res[i].cash + '</td>' +
                                            '<td>' + res[i].transfer + '</td>' +
                                            '<td>' + res[i].total + '</td>' +
                                            '<td>' + res[i].potong + '</td>' +
                                            '<td>' + res[i].setoran + '</td>'
                                    }
                                    html += '</tr>'
                                }

                                $('#lap').html(html)
                                $('.tcash').html(res[kode - 1].tcash)
                                $('.tpotong').html(res[kode - 1].tpotong)
                                $('.ttransfer').html(res[kode - 1].ttransfer)
                                $('.ttotal').html(res[kode - 1].ttotal)
                                $('.tsetoran').html(res[kode - 1].tsetoran)
                            }
                        })
                    }

                    $('.cari').click(function(e) {
                        e.preventDefault()
                        var start = $('.start').val()
                        var end = $('.end').val()
                        getSetoran(start, end)
                        getResume(start, end)
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
                                    "data": "date_from"
                                },
                                {
                                    "data": "date_to"
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

                    $('#profile').on('click', '.detailBni', function(e) {
                        e.preventDefault()
                        var id = $(this).data('id')
                        $.ajax({
                            url: '<?= base_url('bni/getId') ?>',
                            data: {
                                'id': id
                            },
                            dataType: 'json',
                            type: 'post',
                            success: function(res) {
                                getSetoran(res.start_date, res.end_date, res.id, res.ket)
                                getResume(res.start_date, res.end_date, res.id, res.ket)
                            }
                        })
                    })

                    $('#profile').on('click', '.setorkan', function(e) {
                        var id = $(this).data('id')
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
                                            $('#cetak').attr('href', '<?= base_url('bni/invoiceSetoran/') ?>' + id)
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

                    $('#profile').on('click', '.hapusSetoran', function(e) {
                        var id = $(this).data('id')
                        Swal.fire({
                            title: "Yakin ingin dihapus?",
                            text: "Data akan terhapus secara permanen!",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Yes!",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: '<?= base_url('bni/hapus') ?>',
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
                                    url: $('#datSetoran').attr('action'),
                                    data: $('#datSetoran').serialize(),
                                    dataType: 'json',
                                    type: 'POST',
                                    beforeSend: function() {
                                        Swal.fire({
                                            html: '<div class="p-5"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>',
                                            showConfirmButton: false
                                        })
                                    },
                                    success: function(res) {
                                        console.log(res);
                                        if (res.sukses) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Berhasil',
                                                html: `${res.sukses}`
                                            })
                                            getBni()
                                            $('.modal').modal('hide')
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