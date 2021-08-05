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
                                        <a href="#tambahKelas" class="btn addKelas btn-success btn-border-circle float-right" data-toggle="modal">Tambah Kelas</a>
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
                                <form action="<?= base_url('setting/add') ?>" method="post" class="input-ajaran" data-kode="1">
                                    <div class="form-group row">
                                        <div class="col-sm-3 add_ta">
                                            <label for="1">Th. Ajaran</label>
                                            <select type="text" class="ta_s form-control" name="ta">
                                                <?php $n = 16;
                                                $m = 17;
                                                for ($i = 0; $i < 15; $i++) { ?>
                                                    <option value="20<?= $n . '-20' . $m ?>">20<?= $n . '-20' . $m ?></option>
                                                <?php $n++;
                                                    $m++;
                                                } ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="1">Nama Siswa</label>
                                            <input type="text" readonly name="nama_siswa" class="form-control nama_siswa">
                                            <input type="hidden" name="id_user" class="form-control id_user">
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="1">Kelas</label>
                                            <select name="kelas" id="kelas" class="kelas form-control">
                                            </select>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-sm">
                                        <thead class="bg-dark text-white text-center">
                                            <tr>
                                                <th scope="col" rowspan="2" width="15%">Jenis Tagihan</th>
                                                <th scope="col">Tagihan Tahun ini</th>
                                                <th scope="col">Tagihan Tahun Lalu</th>
                                                <th scope="col" rowspan="2">Total Tagihan</th>
                                                <th scope="col" rowspan="2" width="40%">Keterangan</th>
                                            </tr>
                                            <tr id="th_ta">
                                                <th scope="col">
                                                    <select type="text" class="ta form-control form-control-sm" name="ta">
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
                                                    <select type="text" class="ta_lalu form-control form-control-sm" name="ta_lalu">
                                                        <?php $n = 15;
                                                        $m = 16;
                                                        for ($i = 0; $i < 15; $i++) { ?>
                                                            <option value="20<?= $n . '-20' . $m ?>">20<?= $n . '-20' . $m ?></option>
                                                        <?php $n++;
                                                            $m++;
                                                        } ?>
                                                    </select>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="hilang">
                                            <?php $kode = ['SPP', 'INFAQ GEDUNG', 'KEGIATAN', 'SERAGAM', 'KOMITE', 'BUKU', 'SARPRAS'];
                                            for ($i = 0; $i < 7; $i++) { ?>
                                                <tr>
                                                    <td scope="row" class="kode"><?= $kode[$i] ?><input type="hidden" class="form-control form-control-sm id_siswa" name="id_siswa[]"><input type="hidden" class="form-control form-control-sm num" name="id[]"></td>
                                                    <td><input type="text" class="form-control  form-control-sm bayar" name="bayar[]"></td>
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
                <div class="modal fade" id="tambahKelas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-success text-white">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Kelas</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('data/addKelas') ?>" method="post" class="input-ajaran" data-kode="0">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <table class="table table-bordered" id="dataKelas" width="100%" cellspacing="0">
                                                <thead class="text-center bg-dark text-white">
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Kode Kelas</th>
                                                        <th>Nama Keals</th>
                                                        <th>Keterangan</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <label>Kode</label>
                                                    <input type="text" class="form-control kode_kelas" name="kode_kelas">
                                                    <input type="hidden" class="form-control id_kelas" name="id">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <label>Nama Kelas</label>
                                                    <input type="text" class="form-control nama_kelas" name="nama">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <label>Kelas</label>
                                                    <select name="kelas" class="kelaz form-control">
                                                        <option>PiliH Kelas </option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <label>Keterangan</label>
                                                    <textarea type="text" class="ket_kelas form-control" name="keterangan"></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="pt-1 btn btn-block btn-border-circle btn-secondary" type="button" style="position: relative; top: 4px; height:38px" data-dismiss="modal">Close</button>
                                                <button class="simpan btn btn-success btn-border-circle btn-block" type="submit">Simpan</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <script>
                    $(document).ready(function() {
                        getKelas()

                        function getKelas() {
                            var url = '<?= base_url('data/dataKelas') ?>'
                            var dataKelas = $('#dataKelas').DataTable({
                                "processing": true,
                                "language": {
                                    processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
                                },
                                'ajax': {
                                    "type": "POST",
                                    "url": url,
                                    "dataSrc": ""
                                },
                                "destroy": true,
                                'columns': [{
                                        "data": "id"
                                    },
                                    {
                                        "data": "kode_kelas"
                                    },
                                    {
                                        "data": "nama"
                                    },
                                    {
                                        "data": "keterangan"
                                    },
                                    {
                                        "data": "id",
                                        "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                                            $(nTd).html('<a data-ket="' + oData.ket + '" data-nama="' + oData.nama + '" data-keterangan="' + oData.keterangan + '" data-kode_kelas="' + oData.kode_kelas + '" class="edit mr-1 badge badge-info" href="#lihat" data-id="' + oData.id + '" >Edit</a><a class="hapus_kelas mr-1 badge badge-danger" href="#lihat" data-kode="0" data-id="' + oData.id + '" >Hapus</a>');
                                        }
                                    }
                                ]
                            });
                            $.ajax({
                                url: url,
                                dataType: 'json',
                                type: 'POST',
                                success: function(data) {
                                    html = ''
                                    $.each(data, function(i, v) {
                                        html += '<option value="' + v.kode_kelas + '">' + v.ket + ' - ' + v.nama + '</option>'
                                    })
                                    $('#kelas').html(html)
                                }
                            })
                        }
                        $(document).on('click', '.edit', function(e) {
                            e.preventDefault()
                            var id_kelas = $(this).data('id')
                            var kode_kelas = $(this).data('kode_kelas')
                            var nama_kelas = $(this).data('nama')
                            var kelas = $(this).data('ket')
                            var ket = $(this).data('keterangan')
                            $('.kode_kelas').val(kode_kelas)
                            $('.id_kelas').val(id_kelas)
                            $('.nama_kelas').val(nama_kelas)
                            $('.kelaz option[value="' + kelas + '"]').attr('selected', true)
                            $('.kelaz option[value="' + kelas + '"]').siblings().attr('selected', false)
                            $('.ket_kelas').val(ket)
                        })
                        $(document).on('click', '.hapus_kelas', function(e) {
                            e.preventDefault()
                            var id_kelas = $(this).data('id')
                            Swal.fire({
                                title: "Yakin ingin dihapus?",
                                text: "Pastikan data sudah benar dan sesuai",
                                icon: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#3085d6",
                                cancelButtonColor: "#d33",
                                confirmButtonText: "Yes, simpan sekarang!",
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $.ajax({
                                        url: '<?= base_url('data/hapusKelas/') ?>' + id_kelas,
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
                                                getKelas()
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
                        })
                        $('.addKelas').click(function(e) {
                            e.preventDefault()
                            getKelas()
                            $('.form-control').val('')
                        })

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
                                            $(nTd).html('<a class="detail mr-1 badge badge-info" href="#lihat" data-kode="1" data-siswa="' + oData.nama + '" data-id="' + oData.id_user + '" data-num="' + oData.id + '" >Detail</a><a class="edit mr-1 badge badge-success"  data-siswa="' + oData.nama + '"  href="#lihat" data-kode="0" data-id="' + oData.id_user + '" >Setting</a>');
                                        }
                                    }
                                ]
                            });
                        }

                        $('.ta_s').change(function() {
                            var id_u = $('.id_user').val()
                            var ta = $(this).val()
                            console.log(id_u)
                            $.ajax({
                                url: '<?= base_url('setting/getAll/') ?>' + id_u + '/' + ta,
                                type: 'POST',
                                dataType: 'JSON',
                                success: function(data) {
                                    if (data.error) {
                                        $('#hilang').find('input').val('')
                                    } else {
                                        $('.kelas option[value="' + data[0].kelas + '"]').attr('selected', true)
                                        $('.kelas option[value="' + data[0].kelas + '"]').siblings().attr('selected', false)
                                        for (let i = 0; i < data.length; i++) {
                                            $('.num:eq(' + [i] + ')').val(data[i].id)
                                            $('.id_siswa:eq(' + [i] + ')').val(data[i].id_user)
                                            $('.bayar:eq(' + [i] + ')').val(data[i].bayar)
                                            $('.bayar_lalu:eq(' + [i] + ')').val(data[i].bayar_lalu)
                                            $('.ket:eq(' + [i] + ')').val(data[i].ket)
                                            $('.total:eq(' + [i] + ')').val(data[i].total)
                                        }
                                    }
                                }
                            })
                        })

                        $(document).on('click', '.detail', function(e) {
                            var id = $(this).data('id')
                            var kode = $(this).data('kode')
                            var siswa = $(this).data('siswa')
                            var num = $(this).data('num')
                            console.log(siswa)
                            $('.modal-title').text('Setting Biaya Pendidikan')
                            $('.edit').text('Simpan')
                            $('#tambah').modal('show')
                            $('.nama_siswa').val(siswa)
                            $('#th_ta').hide()
                            $('.add_ta').show()
                            $('.id_user').val(num)
                            $('.id_siswa').val(id)
                            $('.input-ajaran').atrr('action', '<?= base_url('setting/edit') ?>')
                        })

                        $(document).on('click', '.edit', function(e) {
                            var id = $(this).data('id')
                            var kode = $(this).data('kode')
                            var siswa = $(this).data('siswa')
                            var num = $(this).data('num')
                            console.log(siswa)
                            $('.modal-title').text('Setting Biaya Pendidikan')
                            $('.edit').text('Simpan')
                            $('#tambah').modal('show')
                            $('.nama_siswa').val(siswa)

                            $('input').val('')
                            $('.id_siswa').val(id)
                            $('#th_ta').show()
                            $('.add_ta').hide()
                            $('.nama_siswa').val(siswa)
                            $('.input-ajaran').atrr('action', '<?= base_url('setting/add') ?>')

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

                                                if ($(this).data('kode') == 1) {
                                                    $('.modal').modal('hide')
                                                    dataTHAjaran()
                                                } else {
                                                    getKelas()
                                                }
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