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
                                    <h3 class="m-0 text-white font-weight-bold ">Tagihan Biaya Penddikan
                                        <a href="#tambah" class="btn input-ajaran-baru btn-success btn-border-circle float-right" data-toggle="modal">Input Baru</a>
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <form action="<?= base_url('pembayaran/inputData') ?>" class="inputData" method="POST">
                                            <table class="table table-bordered" width="100%" cellspacing="0" id="table-bayar">
                                                <thead class="text-center">
                                                    <tr valign="middle">
                                                        <th rowspan="2" valign="middle">No</th>
                                                        <th rowspan="2" width="25%">NIS / NISN</th>
                                                        <th rowspan="2" width="25%">Nama</th>
                                                        <th colspan="7">Nilai Pembayaran</th>
                                                        <th valign="middle" rowspan="2">Aksi</th>
                                                    </tr>
                                                    <tr>
                                                        <th>SPP</th>
                                                        <th>INFAQ GEDUNG</th>
                                                        <th>KEGIATAN</th>
                                                        <th>SERAGAM</th>
                                                        <th>KOMITE</th>
                                                        <th>BUKU</th>
                                                        <th>SARPRAS</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </duv>
                    </div>


                </div>
                <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-success text-white">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Item</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('setting/add') ?>" method="post" class="input-ajaran">
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <label>Tahun Ajaran</label>
                                            <input type="text" class="form-control" name="ta">
                                            <input type="hidden" class="form-control" name="id">
                                        </div>
                                        <div class="col-sm-2">
                                            <label>Kode Kelas</label>
                                            <input type="text" class="form-control" name="kode_kelas">
                                        </div>
                                        <div class="col-sm-2">
                                            <label>Kelas</label>
                                            <input type="text" class="form-control" name="ket">
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Nama Kelas</label>
                                            <input type="text" class="form-control" name="nama">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <label>SPP</label>
                                            <input type="text" class="form-control" name="spp">
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Infaq Gedung</label>
                                            <input type="text" class="form-control" name="gedung">
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Kegiatan</label>
                                            <input type="text" class="form-control" name="kegiatan">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <label>Seragam</label>
                                            <input type="text" class="form-control" name="seragam">
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Komite</label>
                                            <input type="text" class="form-control" name="komite">
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Buku</label>
                                            <input type="text" class="form-control" name="buku">
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Sarpras</label>
                                            <input type="text" class="form-control" name="sarpras">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button id="close" class="pt-1 btn btn-block btn-border-circle btn-secondary" type="button" style="position: relative; top: 4px; height:38px" data-dismiss="modal">Close</button>
                                        <button class="btn btn-success  btn-border-circle btn-block" type="submit">Input</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

                <script>
                    $(document).ready(function() {
                        dataTHAjaran()

                        function dataTHAjaran() {
                            var pembiayaan = $('#table-bayar').DataTable({
                                'ajax': {
                                    "type": "POST",
                                    "url": '<?= base_url('setting/getAll/0') ?>',
                                    "dataSrc": ""
                                },
                                "destroy": true,
                                'columns': [{
                                        "data": "no"
                                    },
                                    {
                                        "data": "nis"
                                    },
                                    {
                                        "data": "nama"
                                    },
                                    {
                                        "data": "spp"
                                    },
                                    {
                                        "data": "gedung"
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
                                        "data": "sarpras"
                                    },
                                    {
                                        "data": "buku",
                                        "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                                            $(nTd).html("<a class='mr-1 detail badge badge-info badge-border-circle' href='#lihat' data-id=" + oData.id + " >Setting</a>");
                                        }
                                    }
                                ]
                            });
                        }
                        $(document).on('click', '.detail', function(e) {
                            var id = $(this).data('id')
                            $('.modal-title').text('Setting Biaya Pendidikan')
                            $('.edit').text('Simpan')
                            $.ajax({
                                url: '<?= base_url('setting/getAll/') ?>' + id,
                                type: 'POST',
                                dataType: 'JSON',
                                success: function(data) {
                                    $('#tambah').modal('show')
                                    $('input[name="ta"]').val(data.ta)
                                    $('input[name="nama"]').val(data.nama)
                                    $('input[name="kode_kelas"]').val(data.kode_kelas)
                                    $('input[name="spp"]').val(data.spp)
                                    $('input[name="gedung"]').val(data.gedung)
                                    $('input[name="kegiatan"]').val(data.kegiatan)
                                    $('input[name="seragam"]').val(data.seragam)
                                    $('input[name="komite"]').val(data.komite)
                                    $('input[name="buku"]').val(data.buku)
                                    $('input[name="sarpras"]').val(data.sarpras)
                                    $('input[name="id"]').val(data.id)
                                    $('input[name="ket"]').val(data.ket)
                                }
                            })
                        })
                        $('.input-ajaran-baru').on('click', function(e) {
                            $('.modal-title').text('Tambah Ajaran Baru')
                            $('.form-control').val('')
                        })

                        // input ajaran 
                        $('.input-ajaran').on('submit', function(e) {
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
                                        success: function(data) {
                                            if (data.sukses) {
                                                Swal.fire(
                                                    'Berhasil',
                                                    `${data.sukses}`,
                                                    'success'
                                                )
                                                dataTHAjaran()
                                                $('.modal').modal('hide')
                                            } else {
                                                Swal.fire(
                                                    'Error',
                                                    `${data.error}`,
                                                    'error'
                                                )
                                            }
                                        }
                                    })
                                }
                            });

                        });
                        // end 


                    })
                </script>