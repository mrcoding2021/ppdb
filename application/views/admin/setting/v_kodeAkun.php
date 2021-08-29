                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Pengaturan</li>
                            <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
                        </ol>
                    </nav>

                    <div class="row">
                        <duv class="col-md-12">
                            <?= $this->session->flashdata('alert'); ?>
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 bg-dark ">
                                    <h3 class="m-0 text-white font-weight-bold "><?= $title ?>
                                        <a href="#add" data-toggle="modal" class="btn btn-success btn-border-circle add float-right">Tambah Baru</a>
                                        <a href="#upload" data-toggle="modal" class="btn btn-primary btn-border-circle float-right">Upoad Akun</a>
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h3>Akun Pemasukan</h3>
                                            <table class="table table-sm table-hover table-bordered" id="akunPemasukan">
                                                <thead class="bg-success text-white text-center">
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Kode</th>
                                                        <th>Nama Akun</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <h3>Akun Pengeluaran</h3>
                                            <table class="table table-sm table-hover table-bordered" id="akunPengeluaran">
                                                <thead class="bg-danger text-white text-center">
                                                    <tr>
                                                        <th>No</th>
                                                        <th width="15%">Kode</th>
                                                        <th>Nama Akun</th>
                                                        <th width="15%">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </duv>
                    </div>


                </div>
                <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->
                <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-success text-white">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Akun</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('akun/add') ?>" method="post" class="addAkun">
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label>Kode</label>
                                            <input type="text" class="form-control" name="kode_akun">
                                            <input type="hidden" class="form-control" name="id">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" name="nama">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label>Kategori</label>
                                            <select name="kategori" class="form-control">
                                                <option>Pilik kategori</option>
                                                <option value="0">KAS</option>
                                                <option value="1">Pemasukan</option>
                                                <option value="2">Pengeluaran</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row pemasukan">
                                        <div class="col-sm-12">
                                            <label>Grup</label>
                                            <select name="parent" class="form-control">
                                                <option value="0">Pilik Grup</option>
                                                <option value="1">Pemasukan</option>
                                                <option value="2">Pengeluaran</option>
                                                <option value="0">KAS</option>
                                                <?php foreach ($akunPemasukan as $key) { ?>
                                                    <option value="<?= $key->kode_akun ?>"><?= $key->nama ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row pengeluaran">
                                        <div class="col-sm-12">
                                            <label>Grup</label>
                                            <select name="ortu" class="form-control">
                                                <option value="1">Pemasukan</option>
                                                <option value="2">Pengeluaran</option>
                                                <option value="0">KAS</option>
                                                <?php foreach ($akunPengeluaran as $key) { ?>
                                                    <option value="<?= $key->kode_akun ?>"><?= $key->nama ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button class="pt-1 btn btn-block btn-border-circle btn-secondary" type="button" style="position: relative; top: 4px; height:38px" data-dismiss="modal">Close</button>
                                        <button class="btn btn-success btn-border-circle btn-block" type="submit">Input</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal fade" id="upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Upload akun</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('akun/upload') ?>" method="post" enctype="multipart/form-data">
                                    <div class="form-group row">
                                        <label for="2" class="col-sm-2 col-form-label">File</label>
                                        <div class="col-sm-10">
                                            <div class="input-group mb-0">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Upload</span>
                                                </div>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="file" id="customFile">
                                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Input</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    getAkunKas(1, 'akunPemasukan')
                    getAkunKas(2, 'akunPengeluaran')

                    function getAkunKas(kode, jenis) {
                        var akunKas = $('#' + jenis).DataTable({
                            "processing": true,
                            "language": {
                                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
                            },
                            'ajax': {
                                "type": "POST",
                                "url": '<?= base_url('akun/getAkunKas/') ?>' + kode,
                                "dataSrc": ""
                            },
                            "pageLength" : 50,
                            "destroy": true,
                            'columns': [{
                                    "data": "no"
                                },
                                {
                                    "data": "kode_akun"
                                },
                                {
                                    "data": "nama"
                                },
                                {
                                    "data": "id",
                                    "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                                        $(nTd).html('<div class="d-flex"><a class="mr-1 btn btn-sm btn-info" href="" data-id="' + oData.id + '" data-id="' + oData.id_user + '" data-num="' + oData.id + '" ><i class="fa fa-search"></i></a></div>');
                                    }
                                }
                            ]
                        });
                    }
                    $('.add').click(function(e) {
                        $('.form-control').val('')
                        $('.addAkun').attr('action', '<?= base_url('akun/add/') ?>')
                    })
                    $('.pengeluaran').hide()
                    $('select[name="kategori"]').on('change', function(e) {
                        if ($(this).val() == 1) {
                            $('.pemasukan').show()
                            $('.pengeluaran').hide()
                        } else if ($(this).val() == 2) {
                            $('.pemasukan').hide()
                            $('.pengeluaran').show()
                        }
                    })
                    $('.edit').click(function(e) {
                        $('input[name="kode"]').focus()
                        var id = $(this).data('id')
                        console.log(id)
                        $.ajax({
                            url: '<?= base_url('akun/get/') ?>' + id,
                            dataType: 'json',
                            type: 'POST',
                            success: function(res) {
                                $('input[name="kode_akun"]').val(res.kode_akun)
                                $('input[name="id"]').val(res.id)
                                $('.addAkun').attr('action', '<?= base_url('akun/edit/') ?>' + res.id)
                                $('input[name="nama"]').val(res.nama)
                                if (res.kategori == 1) {
                                    $('.pemasukan').show()
                                    $('.pengeluaran').hide()
                                    $('select[name="parent"] option[value="' + res.parent + '"]').attr('selected', true)
                                    $('select[name="ortu"] option[value="' + res.parent + '"]').siblings().attr('selected', false)
                                    $('select[name="kategori"] option[value="' + res.kategori + '"]').attr('selected', true)
                                    $('select[name="kategori"] option[value="' + res.kategori + '"]').siblings().attr('selected', false)
                                } else if (res.kategori == 2) {
                                    $('.pemasukan').hide()
                                    $('.pengeluaran').show()
                                    $('select[name="ortu"] option[value="' + res.parent + '"]').attr('selected', true)
                                    $('select[name="ortu"] option[value="' + res.parent + '"]').siblings().attr('selected', false)
                                    $('select[name="kategori"] option[value="' + res.kategori + '"]').attr('selected', true)
                                    $('select[name="kategori"] option[value="' + res.kategori + '"]').siblings().attr('selected', false)
                                }
                            }
                        })
                    })
                    $('.addAkun').submit(function(e) {
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
                                        $('.bg').show()
                                    },
                                    complete: function() {
                                        $('.bg').hide()
                                    },
                                    success: function(response) {
                                        if (response.sukses) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Berasil',
                                                html: 'data berhasl di simpan'
                                            }).then((result) => {
                                                $('.modal').modal('hide')

                                            });
                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Gagal',
                                                html: 'data gagal di simpan'
                                            })
                                        }

                                    }
                                })
                            }
                        });
                    })
                    $('.delete').click(function(e) {
                        e.preventDefault()
                        var id = $(this).data('id')
                        Swal.fire({
                            title: "Yakin ingin dihapus?",
                            text: "Pastikan sudah membackupdata iii",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Yes, hapus saja!",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: $(this).attr('href'),
                                    dataType: 'json',
                                    type: 'POST',
                                    beforeSend: function() {
                                        $('.bg').show()
                                    },
                                    complete: function() {
                                        $('.bg').hide()
                                    },
                                    success: function(response) {
                                        if (response.sukses) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Berasil',
                                                html: 'data berhasl dihapus'
                                            }).then((result) => {
                                                window.location.href = '<?= base_url('akun') ?>'
                                            });

                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Gagal',
                                                html: 'data gagal dihapus'
                                            })
                                        }

                                    }
                                })
                            }
                        });
                    })
                </script>