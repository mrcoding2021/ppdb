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
                                        <a href="#edit" class="tambah btn btn-primary btn-border-circle float-right" data-toggle="modal">Tambah Tagihan</a>
                                        <a href="<?= base_url('setting') ?>" class="tambah btn btn-danger btn-border-circle float-right">Kembali</a>
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <form action="<?= base_url('pembayaran/inputData') ?>" class="inputData" method="POST">
                                            <table class="table-sm table table-bordered" width="100%" cellspacing="0">
                                                <thead class="text-center bg-dark text-white">
                                                    <tr valign="middle">
                                                        <th rowspan="2" valign="middle">No</th>
                                                        <th rowspan="2" width="15%">Tahun Ajaran</th>
                                                        <th rowspan="2">Kelas</th>
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
                                                    foreach ($ta as $key) :

                                                        $this->db->where('id_murid', $id);
                                                        $this->db->where('ta', $key->ta);
                                                        $tagihan = $this->db->get('tb_user_tagihan')->result();
                                                        if ($tagihan == null) {
                                                            $kode_kelas = '';
                                                        } else {
                                                            $kode_kelas = $tagihan[0]->kelas;
                                                            $this->db->where('kode_kelas', $kode_kelas);
                                                            $kelas = $this->db->get('tb_user_kelas')->row(); ?>
                                                            <tr>
                                                                <td><?= $no ?></td>
                                                                <td><?= $key->ta ?></td>
                                                                <td><?= ($kelas) ? $kelas->kode_kelas . ' - ' . $kelas->nama : '-' ?></td>
                                                                <?php
                                                                $kode = ['PEMBANGUNAN', 'KEGIATAN', 'SERAGAM', 'KOMITE', 'BUKU PAKET',  'SPP', 'SARPRAS'];
                                                                $this->db->where('ta', $key->ta);
                                                                $this->db->where('id_murid', $id);
                                                                $tagihan = $this->db->get('tb_user_tagihan')->row();
                                                                for ($i = 0; $i < 7; $i++) {
                                                                    $this->db->where('kode', $kode[$i]);
                                                                    $this->db->where('ta', $key->ta);
                                                                    $this->db->where('id_murid', $id);
                                                                    $tagih = $this->db->get('tb_user_tagihan')->row(); ?>
                                                                    <td><?= ($tagih != null) ? rupiah($tagih->bayar) : 0 ?></td>
                                                                <?php } ?>
                                                                <td class="d-flex"><a href="#edit" data-ta="<?= $key->ta ?>" data-id="<?= $id ?>" data-toggle="modal" class="edit badge badge-sm badge-primary mr-1">Edit</a><a href="#" data-ta="<?= $key->ta ?>" data-id="<?= $id ?>" data-toggle="modal" class="hapus badge badge-sm badge-danger mr-1">Hapus</a></td>
                                                            </tr>
                                                    <?php
                                                            $no++;
                                                        }
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

                <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-success text-white">
                                <h5 class="modal-title" id="exampleModalLabel">Setting Tagihan</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('setting/edit') ?>" method="post" class="input-ajaran" data-kode="1">
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <label>Tahun Ajaran</label>
                                            <select name="ta" class="ta form-control">
                                                <?php
                                                $this->db->select('ta');
                                                $this->db->group_by('ta');
                                                $ta = $this->db->get('tb_ta')->result();
                                                foreach ($ta as $k) : ?>
                                                    <option value="<?= $k->ta ?>"><?= $k->ta ?></option>
                                                <?php endforeach ?>
                                            </select>
                                            <input type="hidden" name="id_murid" class="id_murid form-control" value="<?= $id?>">
                                        </div>
                                        <div class="col-sm-8">
                                            <label>Kelas</label>
                                            <select name="kelas" class="kelas form-control">
                                                <?php
                                                $this->db->order_by('kode_kelas', 'asc');
                                                $kelasAll = $this->db->get('tb_user_kelas')->result();
                                                foreach ($kelasAll as $key) : ?>
                                                    <option value="<?= $key->kode_kelas ?>"><?= $key->kode_kelas . ' - ' . $key->nama ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-sm">
                                        <thead class="bg-dark text-white text-center">
                                            <tr>
                                                <th scope="col" rowspan="2" width="15%">Jenis Tagihan</th>
                                                <th scope="col">Nilai Tagihan</th>
                                            </tr>
                                        </thead>
                                        <tbody id="hilang">
                                            <?php $kode = ['SPP', 'PEMBANGUNAN', 'KEGIATAN', 'SERAGAM', 'KOMITE', 'BUKU PAKET', 'SARPRAS'];
                                            for ($i = 0; $i < 7; $i++) { ?>
                                                <tr>
                                                    <td scope="row" class="kode"><?= $kode[$i] ?><input type="hidden" class="form-control form-control-sm num" name="id[]"></td>
                                                    <td><input type="text" class="form-control form-control-sm bayar" name="bayar[]"></td>
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
                        $('.tambah').click(function() {
                            $('input').val('')
                            $('.input-ajaran').attr('action', '<?= base_url('setting/add') ?>')
                            $('.id_murid').val('<?= $id?>')
                        })
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

                        $('.hapus').on('click', function(e) {
                            Swal.fire({
                                title: "Yakin ingin dihapus?",
                                text: "Data akan terhapus secara permanen",
                                icon: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#3085d6",
                                cancelButtonColor: "#d33",
                                confirmButtonText: "Yes, hapus sekarang!",
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $.ajax({
                                        url: '<?= base_url('setting/hapus') ?>',
                                        data: {
                                            'id': $(this).data('id'),
                                            'ta': $(this).data('ta')
                                        },
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
                                                window.location.href = "<?= base_url('setting/detailTagihan/' . $id) ?>"
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

                        $('.edit').on('click', function(e) {
                            $.ajax({
                                url: '<?= base_url('setting/getTagihan') ?>',
                                data: {
                                    'id': $(this).data('id'),
                                    'ta': $(this).data('ta'),
                                },
                                type: 'post',
                                dataType: 'json',
                                success: function(data) {
                                    console.log(data);
                                    
                                    $('.kelas option[value="' + data[0].kelas + '"]').attr('selected', true)
                                    $('.kelas option[value="' + data[0].kelas + '"]').siblings().attr('selected', false)
                                    $('.ta option[value="' + data[0].ta + '"]').attr('selected', true)
                                    $('.ta option[value="' + data[0].ta + '"]').siblings().attr('selected', false) 
                                    $('.id_murid').val(data[0].id_murid)
                                    for (let i = 0; i < data.length; i++) {
                                        $('.num:eq(' + [i] + ')').val(data[i].id)
                                        $('.bayar:eq(' + [i] + ')').val(data[i].bayar)
                                    }
                                    $('.input-ajaran').attr('action', '<?= base_url('setting/edit') ?>')
                                }
                            })
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

                                                $('#edit').modal('hide')
                                                window.location.href = "<?= base_url('setting/detailTagihan/' . $id) ?>"
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