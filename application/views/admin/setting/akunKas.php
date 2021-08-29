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
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 bg-dark ">
                                    <h3 class="m-0 text-white font-weight-bold "><?= $title ?>
                                        <a href="#detail" data-toggle="modal" class="btn btn-success btn-border-circle add float-right">Tambah Baru</a>
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">

                                            <table class="table table-hover table-bordered" width="100%" id="akunKas">
                                                <thead class="bg-success text-white text-center">
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Kode Akun</th>
                                                        <th>Nama Akun Kas</th>
                                                        <th>Saldo Akhir</th>
                                                        <th>Aksi</th>
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
                <div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-success text-white">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Akun</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" class="addAkun" action="<?= base_url('akun/addAkunKas') ?>">
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label>Kode Akun</label>
                                            <input type="text" class="form-control" name="kode_akun">
                                            <input type="hidden" class="form-control" name="id">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label>Nama Akun</label>
                                            <input type="text" class="form-control" name="nama">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label>Keterangan</label>
                                            <textarea type="text" class="form-control" name="ket"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label>Saldo Awal</label>
                                            <input type="text" class="form-control" name="saldo">
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

                <script>
                    getAkunKas()

                    function getAkunKas() {
                        var akunKas = $('#akunKas').DataTable({
                            "processing": true,
                            "language": {
                                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
                            },
                            'ajax': {
                                "type": "POST",
                                "url": '<?= base_url('akun/getAkunKas/') ?>',
                                "dataSrc": ""
                            },
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
                                    "data": "saldo"
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
                        $('form').attr('action', '<?= base_url('akun/addAkunKas/') ?>')
                    })
                    $('.pengeluaran').hide()

                    $(document).on('click', '.detail', function(e) {
                        e.preventDefault()
                        var id = $(this).data('id')
                        $.ajax({
                            url: '<?= base_url('akun/get/') ?>' + id,
                            dataType: 'json',
                            type: 'POST',
                            success: function(res) {
                                console.log(res)
                                $('.submit').html('Edit')
                                $('form').attr('class', 'editAkun')
                                $('form').attr('action', '<?= base_url('akun/edit/') ?>' + res.id)
                                $('input[name="kode_akun"]').val(res.kode_akun)
                                $('input[name="nama"]').val(res.nama)
                                $('input[name="id"]').val(res.id)
                                $('input[name="saldo"]').val(res.jumlah)
                            }
                        })
                    })

                    $(document).on('click', '.delete', function(e) {
                        e.preventDefault()
                        var id = $(this).data('id')
                        $.ajax({
                            url: '<?= base_url('akun/delete/') ?>' + id,
                            dataType: 'json',
                            type: 'POST',
                            success: function(res) {
                                Swal.fire({
                                    title: "Yakin ingin dihapus?",
                                    text: "Pastikan data sudah benar dan sesuai",
                                    icon: "warning",
                                    showCancelButton: true,
                                    confirmButtonColor: "#3085d6",
                                    cancelButtonColor: "#d33",
                                    confirmButtonText: "Yes, hapus saja !",
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        getAkunKas()
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Berasil',
                                            html: `${response.error}`
                                        })
                                    }
                                });
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
                            confirmButtonText: "Yes, simpan !",
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
                                        console.log(response)
                                        if (response.sukses) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Berasil',
                                                html: 'data berhasil di simpan'
                                            }).then((result) => {
                                                getAkunKas()
                                                $('.modal').modal('hide')
                                            });
                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Gagal',
                                                html: `${response.error}`
                                            })
                                        }

                                    }
                                })
                            }
                        });
                    })

                    $('.editAkun').submit(function(e) {
                        e.preventDefault()
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
                                    url: $(this).attr('action'),
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
                                                getAkunKas()
                                                $('.modal').modal('hide')
                                            });
                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Gagal',
                                                html: `${response.error}`
                                            })
                                        }

                                    }
                                })
                            }
                        });
                    })
                </script>