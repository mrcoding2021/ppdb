                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <?php $this->load->view('admin/breadcrumb'); ?>

                            <div class="card shadow mb-4">
                                <div class="card-header py-3 bg-dark ">
                                    <h3 class="m-0 text-white font-weight-bold "> <?= $title ?>
                                        <a href="#addPemasukan" data-toggle="modal" class="btn btn-success inputBaru btn-border-circle float-right">Input Baru</a>
                                    </h3>
                                </div>
                                <?php
                                $this->db->where('parent', '1');
                                $this->db->where('kategori', '1');
                                $akun_trx = $this->db->get('tb_rab')->result();
                                $this->db->order_by('id', 'desc');
                                $inv = $this->db->get('tb_transaksi')->row();
                                $d = 1 . '.' . str_replace('-', '', date('Y-m-d'));
                                $date = str_replace('-', '', date('Y-m-d')) ?>
                                <h4 class="mx-2 d-none" id="inv">
                                    <?php
                                    if ($inv == null) {
                                        echo $d;
                                    } else {
                                        $e = intval($inv->id_trx) + 1;
                                        echo $e . '.' . $date;
                                    }; ?>
                                </h4>
                                <div class="row mt-3">
                                    <div class="col-md-12 col-lg-12 container">
                                        <table class="table table-striped table-sm text-center" width="100%" id="dataPemasukan">
                                            <thead class="bg-dark text-white ">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Tanggal</th>
                                                    <th>Diterima dari</th>
                                                    <th>Ke Kas</th>
                                                    <th>Metode</th>
                                                    <th>Jumlah</th>
                                                    <th>Keterangan</th>
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
                    </div>


                </div>
                <!-- /.container-fluid -->

                </div>


                <div class="modal fade" id="addPemasukan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-success text-white">
                                <h5 class="modal-title" id="exampleModalLabel">Input Tabungan</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" class="addTabungan" action="<?= base_url('pemasukan/add') ?>">
                                    <div class="row form-group">
                                        <div class="col-sm-6">
                                            <label>No. Invoice</label>
                                            <input type="text" readonly class="form-control id_trx" name="id_trx">
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Tanggal Trx.</label>
                                            <input type="date" value="<?= date('Y-m-d') ?>" class="form-control date" name="date">
                                            <input type="hidden" class="form-control id" name="id">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sm-6">
                                            <label>Diterima Dari</label>
                                            <input type="text" class="form-control nama" name="nama">
                                        </div>
                                        <div class="col-sm-6">
                                            <label>ke Kas</label>
                                            <select name="akun_kas" class="form-control akun_kas">
                                                <?php foreach ($kas as $key) { ?>
                                                    <option value="<?= $key->kode_akun?>"><?= $key->nama?></option>
                                                <?php  } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <label>Metode</label>
                                            <select name="metode" class="form-control metode">
                                                <option>Pilih Metode</option>
                                                <option value="1">CASH</option>
                                                <option value="2">TRANSFER</option>
                                                <option value="3">TABUNGAN</option>
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
                                                <!-- <option>Pilih Transaksi</option> -->
                                                <option value="1">Pemasukan</option>
                                                <!-- <option value="0">Pengeluaran</option> -->
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
                    getPemasukan()
                    function getPemasukan() {
                        var getPemasukan = $('#dataPemasukan').DataTable({
                            "processing": true,
                            "language": {
                                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
                            },
                            'ajax': {
                                "type": "POST",
                                "url": '<?= base_url('pemasukan/get/') ?>',
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
                                    "data": "nama"
                                },
                                {
                                    "data": "kas"
                                },
                                {
                                    "data": "metode"
                                },
                                {
                                    "data": "jumlah"
                                },
                                {
                                    "data": "ket"
                                },
                                {
                                    "data": "id",
                                    "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                                        $(nTd).html('<a data-toggle="modal" class="detailPemasukan mr-1 btn btn-sm btn-info" href="#addPemasukan" data-id="' + oData.id + '"><i class="fa fa-search"></i></a><a target="_blank" class="mr-1 btn btn-sm btn-success" href="<?= base_url('cetak/invoice/') ?>' + oData.id_trx + '"><i class="fa fa-print"></i></a>');
                                    }
                                }
                            ]
                        });
                    }

                    $('.inputBaru').click(function(e) {
                        var inv = $.trim($('#inv').html())
                        $('input').val('')
                        $('.id_trx').val(inv)

                    })

                    $(document).on('click', '.detailPemasukan', function(e) {
                        e.preventDefault()
                        var id = $(this).data('id')
                        console.log(id);

                        $.ajax({
                            url: '<?= base_url('pemasukan/get/') ?>',
                            type: 'post',
                            dataType: 'json',
                            data: {
                                'id': id
                            },
                            success: function(res) {
                                console.log(res);
                                $('.id_trx').val(res.id_trx)
                                $('.nama').val(res.nama)
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
                                $('.akun_kas option[value="' + res.akun_kas + '"]').attr('selected', true)
                                $('.akun_kas option[value="' + res.akun_kas + '"]').siblings().attr('selected', false)
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
                                            getPemasukan()
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
                </script>