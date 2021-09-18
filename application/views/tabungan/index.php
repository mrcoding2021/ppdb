                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <?php $this->load->view('admin/breadcrumb'); ?>

                            <div class="card shadow mb-4">
                                <div class="card-header py-3 bg-dark ">
                                    <h3 class="m-0 text-white font-weight-bold ">
                                        <?= $title;
                                        if ($user['level'] == 1) : ?> <a href="#uploadMutasi" class="btn btn-primary  btn-border-circle float-right" data-toggle="modal">Upload Data</a><?php endif ?>
                                        <a href="#addTabungan" data-toggle="modal" class="mx-1 btn btn-success inputBaru btn-border-circle float-right">Input Baru</a>
                                        <a href="#" id="exportData" class="btn btn-danger btn-border-circle float-right">Export</a>
                                    </h3>
                                </div>
                                <form action="#" class="pembayaranSiswa">
                                    <div class="card-body row">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label for="1">Nama Murid</label>
                                                    <input type="text" autofocus class="form-control" name="nama" id="nama_siswa">
                                                    <input type="hidden" class="form-control id_user" name="id_murid">
                                                </div>
                                                <div class="col-sm-3">
                                                    <label for="1">NIS</label>
                                                    <input type="text" readonly class="form-control" name="nis">
                                                </div>
                                                <div class="col-sm-3">
                                                    <label for="1">NISN</label>
                                                    <input type="text" readonly class="form-control" name="nisn">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-5">
                                                    <label for="1">Kelas</label>
                                                    <input type="text" readonly class="form-control" name="kelas">
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="1">Orangtua</label>
                                                    <input type="text" readonly class="form-control" name="wali">
                                                </div>
                                                <div class="col-sm-3">
                                                    <label for="1">No. HP</label>
                                                    <input type="text" readonly class="form-control" name="hp">
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 col-lg-12 container">
                                            <table class="table table-striped table-sm" width="100%" id="dataTabungan">
                                                <thead class="bg-dark text-white text-center">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Tanggal</th>
                                                        <th>Deibt</th>
                                                        <th>Kredit</th>
                                                        <th>Saldo</th>
                                                        <th>Keterangan</th>
                                                        <th>Aksi</th>
                                                    </tr>

                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->
                <div class="modal fade" id="uploadMutasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <h5 class="modal-title text-white" id="exampleModalLabel">Import Data Mutasi</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('import/pembayaran') ?>" method="post" enctype="multipart/form-data">

                                    <div class="form-group row">
                                        <label for="5" class="col-sm-2 col-form-label">File</label>
                                        <div class="col-sm-10">
                                            <div class="input-group mb-0">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Upload</span>
                                                </div>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="inputGroupFile01" name="file">
                                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Upload</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="modal fade" id="addTabungan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-success text-white">
                                <h5 class="modal-title" id="exampleModalLabel">Input Tabungan</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" class="addTabungan" action="<?= base_url('tabungan/add') ?>">
                                    <div class="row form-group">
                                        <div class="col-sm-6">
                                            <label>No. Invoice</label>
                                            <input type="text" readonly class="form-control id_trx" name="id_trx">
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Tanggal Trx.</label>
                                            <input type="date" value="<?= date('Y-m-d') ?>" class="form-control date" name="date">
                                            <input type="hidden" class="form-control id" name="id">
                                            <input type="hidden" class="form-control id_murid" name="id_murid">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <label>Metode</label>
                                            <select name="metode" class="form-control metode">
                                                <option>Pilih Metode</option>
                                                <option value="1">CASH</option>
                                                <option value="2">TRANSFER</option>
                                                <option value="4">POTONG KEGIATAN</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="1">Tahun Ajaran</label>
                                            <select type="text" class="form-control ta" name="ta">
                                                <?php $n = 16;
                                                $m = 17;
                                                for ($i = 0; $i < 15; $i++) { ?>
                                                    <option value="20<?= $n . '-20' . $m ?>">20<?= $n . '-20' . $m ?></option>
                                                <?php $n++;
                                                    $m++;
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <label>Jenis Transaksi</label>
                                            <select name="kategori" class="form-control kategori">
                                                <option>Pilih Transaksi</option>
                                                <option value="1">Pemasukan</option>
                                                <option value="0">Pengeluaran</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Nilai</label>
                                            <input type="text" class="form-control nilai" name="nilai">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label>Keterangan</label>
                                            <textarea type="text" class="form-control ket" name="ket"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="pt-1 btn btn-block btn-border-circle btn-secondary" type="button" style="position: relative; top: 4px; height:38px" data-dismiss="modal">Close</button>
                                        <button class="btn btn-success btn-border-circle btn-block" type="submit">Simpan</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <script>
                    var id = $('.id_murid').val()
                    // getTabungan(id)
                    function getTabungan(id) {
                        var getTabungan = $('#dataTabungan').DataTable({
                            "processing": true,
                            "language": {
                                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
                            },
                            'ajax': {
                                "type": "POST",
                                "url": '<?= base_url('tabungan/getTabungan/') ?>' + id,
                                "dataSrc": ""
                            },
                            "pageLength": 100,
                            "destroy": true,
                            'columns': [{
                                    "data": "no"
                                },
                                {
                                    "data": "date"
                                },
                                {
                                    "data": "debit"
                                },
                                {
                                    "data": "kredit"
                                },
                                {
                                    "data": "saldo"
                                },
                                {
                                    "data": "ket"
                                },
                                {
                                    "data": "id",
                                    "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                                        $(nTd).html('<a data-toggle="modal" class="detailTabungan mr-1 btn btn-sm btn-info" href="#addTabungan" data-id="' + oData.id + '"><i class="fa fa-search"></i></a><a target="_blank" class="mr-1 btn btn-sm btn-success" href="<?= base_url('cetak/invoice/') ?>' + oData.id_trx + '"><i class="fa fa-print"></i></a><a class="delete mr-1 btn btn-sm btn-danger" href="#" data-id="' + oData.id + '"><i class="fa fa-times"></i></a>');
                                    }
                                }
                            ]
                        });
                    }
                    $('.inputBaru').click(function(e) {
                        var id = $('.id_murid').val()
                        $('.id_murid').val(id)
                        $.ajax({
                            url: '<?= base_url('tabungan/getKode/') ?>',
                            type: 'post',
                            dataType: 'json',
                            success: function(res) {
                                console.log(res);
                                $('.id_trx').val(res.id_trx)
                            }
                        })
                    })

                    $(document).on('click', '.detailTabungan', function(e) {
                        e.preventDefault()
                        var id = $(this).data('id')
                        console.log(id);

                        $.ajax({
                            url: '<?= base_url('tabungan/getTabungan/') ?>',
                            type: 'post',
                            dataType: 'json',
                            data: {
                                'id': id
                            },
                            success: function(res) {
                                console.log(res);
                                $('.id_trx').val(res.id_trx)
                                $('.id').val(res.id)
                                $('.id_murid').val(res.id_murid)
                                $('.date').val(res.date)
                                $('.nilai').val(res.jumlah)
                                $('.ket').text(res.ket)
                                $('.metode option[value="' + res.metode + '"]').attr('selected', true)
                                $('.metode option[value="' + res.metode + '"]').siblings().attr('selected', false)
                                $('.ta option[value="' + res.ta + '"]').attr('selected', true)
                                $('.ta option[value="' + res.ta + '"]').siblings().attr('selected', false)
                                $('.kategori option[value="' + res.kategori + '"]').attr('selected', true)
                                $('.kategori option[value="' + res.kategori + '"]').siblings().attr('selected', false)
                            }
                        })
                    })

                    $('.addTabungan').submit(function(e) {
                        var id_trx = $('#inv').text()
                        var id_murid = $('.id_murid').val()
                        e.preventDefault()
                        Swal.fire({
                            title: "Yakin ingin disimpan?",
                            text: "Pastikan data sudah benar dan sesuai",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Yes, simpan sekarang!",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: $(this).attr('action'),
                                    data: $(this).serialize(),
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
                                            $('.modal').modal('hide')
                                            getTabungan(id_murid)
                                            $('#cetak').attr('href', '<?= base_url('cetak/invoice/') ?>' + id_trx)
                                            var cetak = $('#cetak').attr('href')
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
                                    url: '<?= base_url('tabungan/delete') ?>',
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
                                            getTabungan(id_murid)

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