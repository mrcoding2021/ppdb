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
                                        <a href="#tagihan" class="btn btn-primary btn-border-circle float-right" data-toggle="modal">Upload Tagihan</a>
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
                                                        <th>PEMBAGNUNAN</th>
                                                        <th>KEGIATANN</th>
                                                        <th>SERAGAM</th>
                                                        <th>KOMITE</th>
                                                        <th>BUKU PAKET</th>
                                                        <th>SPP</th>
                                                        <th>SARPRAS</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1;
                                                    foreach ($siswa as $key) : ?>
                                                        <tr>
                                                            <td><?= $no ?></td>
                                                            <td><?= $key->nis ?></td>
                                                            <td><?= $key->nama ?></td>

                                                            <?php
                                                            $kode = ['PEMBANGUNAN', 'KEGIATAN', 'SERAGAM', 'KOMITE', 'BUKU PAKET', 'SPP',  'SARPRAS'];
                                                            for ($i = 0; $i < 7; $i++) {
                                                                $this->db->where('kode', $kode[$i]);
                                                                $this->db->where('id_murid', $key->id_user);
                                                                $this->db->select_sum('bayar', 'total');
                                                                $tagihan = $this->db->get('tb_user_tagihan')->row(); ?>
                                                                <td><?= rupiah($tagihan->total) ?></td>
                                                            <?php } ?>

                                                            <td><a href="<?= base_url('setting/detailTagihan/' . $key->id_user) ?>" class="btn btn-sm btn-primary">Detail</a></td>
                                                        </tr>
                                                    <?php $no++;
                                                    endforeach ?>
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
                                    <span aria-hidden="true">??</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('setting/add') ?>" method="post" class="input-ajaran" data-kode="1">
                                    <div class="form-group row">
                                        <div class="col-sm-2 add_ta">
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
                                        <div class="col-md-1" id="ubah">
                                            <label for="1">.</label>
                                            <a href="#" class="ubahData btn btn-danger">Ubah</a>
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
                                            <?php $kode = ['PEMBANGUNAN', 'KEGIATAN', 'SERAGAM', 'KOMITE', 'BUKU PAKET', 'SPP',  'SARPRAS'];
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
                                        <button class="btnSimpan btn btn-success  btn-border-circle btn-block" type="submit">Simpan</button>
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
                                    <span aria-hidden="true">??</span>
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
                <div class="modal fade" id="tagihan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Upload Tagihan</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">??</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('import/tagihan') ?>" method="post" enctype="multipart/form-data">
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
                    $(document).ready(function() {
                        $('#table-bayar').DataTable()
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
                                            $(nTd).html('<a data-ket="' + oData.ket + '" data-nama="' + oData.nama + '" data-keterangan="' + oData.keterangan + '" data-kode_kelas="' + oData.kode_kelas + '" class="editKelas mr-1 badge badge-info" href="#lihat" data-id="' + oData.id + '" >Edit</a><a class="hapus_kelas mr-1 badge badge-danger" href="#lihat" data-kode="0" data-id="' + oData.id + '" >Hapus</a>');
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
                        $(document).on('click', '.editKelas', function(e) {
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
                            $('.input').val('')
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



                        $('.ta_s').change(function() {
                            var id_u = $('.id_user').val()
                            var ta = $(this).val()
                            $.ajax({
                                url: '<?= base_url('setting/getAll/') ?>' + id_u + '/' + ta,
                                type: 'POST',
                                dataType: 'JSON',
                                success: function(data) {
                                    console.log(data)
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
                        $('.ubahData').click(function(e) {
                            e.preventDefault()
                            $('#tambah input').attr('readonly', false)
                            $('.btnSimpan').show()
                        })

                        $(document).on('click', '.edit', function(e) {
                            var id = $(this).data('id')
                            var kode = $(this).data('kode')
                            var siswa = $(this).data('siswa')
                            var num = $(this).data('num')
                            $('#tambah input').val('')
                            $('#tambah input').attr('value', '0')
                            $('.btnSimpan').show()
                            $('.modal-title').text('Setting Biaya Pendidikan')

                            $('#tambah').modal('show')
                            $('#tambah input').attr('readonly', false)
                            $('.nama_siswa').val(siswa)
                            $('#ubah').hide()
                            $('.id_siswa').val(id)
                            $('#th_ta').show()
                            $('.add_ta').hide()
                            $('.nama_siswa').val(siswa)
                            $('.input-ajaran').attr('action', '<?= base_url('setting/add') ?>')
                            $('.input-ajaran').attr('data-kode', 0)
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

                                                $('#tambah').modal('hide')
                                                dataTHAjaran('mantap')
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

                        });
                        // end 


                    })
                </script>