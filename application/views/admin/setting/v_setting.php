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
                                                        <th colspan="7">Nilai Tagihan</th>
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
                                    <table class="table table-striped table-sm">
                                        <thead class="bg-dark text-white text-center">
                                            <tr>
                                                <th scope="col" rowspan="2" width="15%">Jenis Tagihan</th>
                                                <th scope="col">Tagihan Tahun ini</th>
                                                <th scope="col">Tagihan Tahun Lalu</th>
                                                <th scope="col" rowspan="2">Total Tagihan</th>
                                                <th scope="col" rowspan="2" width="40%">Keterangan</th>
                                            </tr>
                                            <tr>
                                                <th scope="col">
                                                    <select type="text" class="form-control form-control-sm" name="ta">
                                                        <?php $n = 16;
                                                        $m = 17;
                                                        for ($i = 0; $i < 15; $i++) { ?>
                                                            <option value="20<?= $n . '-20' . $m ?>">20<?= $n . '-20' . $m ?></option>
                                                        <?php $n++;
                                                            $m++;
                                                        } ?>
                                                    </select>
                                                </th>
                                                <th scope="col">
                                                    <select type="text" class="form-control form-control-sm" name="ta_lalu">
                                                        <?php $n = 16;
                                                        $m = 17;
                                                        for ($i = 0; $i < 15; $i++) { ?>
                                                            <option value="20<?= $n . '-20' . $m ?>">20<?= $n . '-20' . $m ?></option>
                                                        <?php $n++;
                                                            $m++;
                                                        } ?>
                                                    </select>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $kode = ['SPP', 'INFAQ GEDUNG', 'KEGIATAN', 'SERAGAM', 'KOMITE', 'BUKU', 'SARPRAS'];
                                            for ($i = 0; $i < 7; $i++) { ?>
                                                <tr>
                                                    <td scope="row" class="kode"><?= $kode[$i] ?><input type="hidden" class="form-control form-control-sm id_siswa" name="id_siswa"></td>
                                                    <td><input type="text" class="form-control form-control-sm bayar" name="bayar[]"></td>
                                                    <td><input type="text" class="form-control form-control-sm bayar_lalu" name="bayar_lalu[]"></td>
                                                    <td><input readonly type="text" class="form-control  form-control-sm total" name="total[]"></td>
                                                    <td><input type="text" class="form-control form-control-sm" name="ket[]"></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
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
                        $('.bayar').keyup(function() {
                            var bayar = $(this).val()
                            console.log(bayar)
                            var diskon = $(this).parent('td').next().find('.bayar_lalu').val()
                            var total = $(this).parents('td').next().next().find('.total')
                            total.val(parseInt(bayar) + parseInt(diskon))
                        })

                        $('.bayar_lalu').keyup(function() {
                            var bayar = $(this).val()
                            console.log(bayar)
                            var diskon = $(this).parent('td').prev().find('.bayar').val()
                            var total = $(this).parents('td').next().find('.total')
                            total.val(parseInt(bayar) + parseInt(diskon))
                        })

                        dataTHAjaran()

                        function dataTHAjaran() {
                            var pembiayaan = $('#table-bayar').DataTable({
                                "processing": true,
                                "language": {
                                    processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
                                },
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
                                            $(nTd).html('<a class="mr-1 badge badge-info" href="#lihat" data-id="' + oData.id + '" >Detail</a><a class="mr-1 detail badge badge-success" href="#lihat" data-id="' + oData.id + '" >Setting</a>');
                                        }
                                    }
                                ]
                            });
                        }

                        $(document).on('click', '.detail', function(e) {
                            var id = $(this).data('id')
                            $('.modal-title').text('Setting Biaya Pendidikan')
                            $('.edit').text('Simpan')
                            $('.id_siswa').val(id)
                            $.ajax({
                                url: '<?= base_url('setting/getAll/') ?>' + id,
                                type: 'POST',
                                dataType: 'JSON',
                                success: function(data) {
                                    console.log(data)
                                    $('#tambah').modal('show')

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
                            console.log($('.kode').text())
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