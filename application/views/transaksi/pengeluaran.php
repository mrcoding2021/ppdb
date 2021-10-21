                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <?php $this->load->view('admin/breadcrumb'); ?>

                            <div class="card shadow mb-4">
                                <div class="card-header py-3 bg-dark ">
                                    <h3 class="m-0 text-white font-weight-bold "> <?= $title ?>
                                        <a href="#addPengeluaran" data-toggle="modal" class="btn btn-success inputBaru btn-border-circle float-right">Input Baru</a>
                                    </h3>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12 col-lg-12 container">
                                        <table class="table table-striped table-sm" width="100%" id="dataPengeluaran">
                                            <thead class="bg-dark text-white text-center">
                                                <tr>
                                                    <th>#</th>
                                                    <th width="15%">Tanggal</th>
                                                    <th>Akun Pengeluaran</th>
                                                    <th>Dari Kas</th>
                                                    <th>Metode</th>
                                                    <th>Jumlah</th>
                                                    <th>Aksi</th>
                                                </tr>

                                            </thead>
                                            <tbody class="text-left">

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


                <div class="modal fade" id="addPengeluaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-success modal-md text-white">
                                <h5 class="modal-title" id="exampleModalLabel">Input <?= $title ?></h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <ul class="nav nav-pills nav-justified mb-3 border-bottom-primary" id="pills-tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active tabPengeluaran" data-kode="2" id="nav-home-tab" data-toggle="pill" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">OPERASIONAL</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link tabPengeluaran" id="nav-profile-tab" data-kode="3" data-toggle="pill" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">BOS</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link tabPengeluaran" id="nav-contact-tab" data-kode="4" data-toggle="pill" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">PETTY CASH</a>
                                    </li>
                                </ul>
                                <div class="tab-content mt-2" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <form method="post" class="addPengeluaran" action="<?= base_url('pengeluaran/add') ?>">
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
                                                <div class="col-sm-12">
                                                    <label>Dikeluarkan untuk</label>
                                                    <select name="akun_trx" class="form-control selectpicker" data-live-search="true">
                                                        <?php foreach ($akun as $a) { ?>
                                                            <option value="<?= $a->kode_akun ?>"><?= $a->nama ?></option>
                                                            <?php $this->db->where('parent', $a->kode_akun);
                                                            $ak = $this->db->get('tb_rab')->result();
                                                            foreach ($ak as $k) { ?>
                                                                <option value="<?= $k->kode_akun ?>">--> <?= $k->nama ?></option>
                                                            <?php  } ?>
                                                        <?php  } ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6 d-none">
                                                    <label>Dari Kas</label>
                                                    <select name="akun_kas" class="form-control akun_kas">
                                                        <option selected value="0-10001">Kas Yayasan</option>
                                                        <option value="0-10002">Kas BOS</option>
                                                        <option value="0-10003">Kas Kecil</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label>Metode</label>
                                                    <select name="metode" class="form-control metode">
                                                        <option>Pilih Metode</option>
                                                        <?php foreach ($metode as $key) { ?>
                                                            <option value="<?= $key->id_sumber ?>"><?= $key->nama ?></option>
                                                        <?php  } ?>
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
                                            <div id="kode" class="form-group row d-none">
                                                <div class="col-sm-12">
                                                    <label>Dari Setoran</label>
                                                    <select name="kode" class="form-control kode">
                                                        <option>Pilih</option>
                                                        <?php
                                                        $kode = ['SPP', 'INFAQ GEDUNG', 'KEGIATAN', 'SERAGAM', 'KOMITE', 'BUKU', 'SARPRAS'];
                                                        for ($i = 0; $i < 7; $i++) { ?>
                                                            <option value="<?= $kode[$i] ?>"><?= $kode[$i] ?></option>
                                                        <?php  } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12">
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
                                            <div class="d-flex">
                                                <button class="btn btn-block btn-border-circle btn-secondary mr-1" type="button" style="position: relative; top: 8px; height:38px" data-dismiss="modal">Close</button>
                                                <button class="btn btn-success btn-border-circle btn-block" type="submit">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                        <form method="post" class="addPengeluaran" action="<?= base_url('pengeluaran/add') ?>">
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
                                                <div class="col-sm-12">
                                                    <label>Dikeluarkan untuk</label>
                                                    <select name="akun_trx" class="form-control selectpicker" data-live-search="true">
                                                        <?php foreach ($akun as $a) { ?>
                                                            <option value="<?= $a->kode_akun ?>"><?= $a->nama ?></option>
                                                            <?php $this->db->where('parent', $a->kode_akun);
                                                            $ak = $this->db->get('tb_rab')->result();
                                                            foreach ($ak as $k) { ?>
                                                                <option value="<?= $k->kode_akun ?>">--> <?= $k->nama ?></option>
                                                            <?php  } ?>
                                                        <?php  } ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6 d-none">
                                                    <label>Dari Kas</label>
                                                    <select name="akun_kas" class="form-control akun_kas">
                                                        <option value="0-10001">Kas Yayasan</option>
                                                        <option selected value="0-10002">Kas BOS</option>
                                                        <option value="0-10003">Kas Kecil</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label>Metode</label>
                                                    <select name="metode" class="form-control metode">
                                                        <option value="1">CASH</option>
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

                                                <div class="col-sm-12">
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
                                            <div class="d-flex">
                                                <button class="btn btn-block btn-border-circle btn-secondary mr-1" type="button" style="position: relative; top: 8px; height:38px" data-dismiss="modal">Close</button>
                                                <button class="btn btn-success btn-border-circle btn-block" type="submit">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="nav-contact" d role="tabpanel" aria-labelledby="nav-contact-tab">
                                        <form method="post" class="addPengeluaran" action="<?= base_url('pengeluaran/add') ?>">
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
                                                <div class="col-sm-12">
                                                    <label>Dikeluarkan untuk</label>
                                                    <select name="akun_trx" class="form-control selectpicker" data-live-search="true">
                                                        <?php foreach ($akun as $a) { ?>
                                                            <option value="<?= $a->kode_akun ?>"><?= $a->nama ?></option>
                                                            <?php $this->db->where('parent', $a->kode_akun);
                                                            $ak = $this->db->get('tb_rab')->result();
                                                            foreach ($ak as $k) { ?>
                                                                <option value="<?= $k->kode_akun ?>">--> <?= $k->nama ?></option>
                                                            <?php  } ?>
                                                        <?php  } ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6 d-none">
                                                    <label>Dari Kas</label>
                                                    <select name="akun_kas" class="form-control akun_kas">
                                                        <option value="0-10001">Kas Yayasan</option>
                                                        <option value="0-10002">Kas BOS</option>
                                                        <option selected value="0-10003">Kas Kecil</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label>Metode</label>
                                                    <select name="metode" class="form-control metode">
                                                        <option>Pilih Metode</option>
                                                        <?php foreach ($metode as $key) { ?>
                                                            <option value="<?= $key->id_sumber ?>"><?= $key->nama ?></option>
                                                        <?php  } ?>
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
                                                <div class="col-sm-12">
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
                                            <div class="d-flex">
                                                <button class="btn btn-block btn-border-circle btn-secondary mr-1" type="button" style="position: relative; top: 8px; height:38px" data-dismiss="modal">Close</button>
                                                <button class="btn btn-success btn-border-circle btn-block" type="submit">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <script>
                    getPengeluaran()

                    function getPengeluaran() {
                        var getPengeluaran = $('#dataPengeluaran').DataTable({
                            "processing": true,
                            "language": {
                                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                            },
                            'ajax': {
                                "type": "POST",
                                "url": '<?= base_url('pengeluaran/get/') ?>',
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
                                    "data": "id",
                                    "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                                        $(nTd).html('<a data-toggle="modal" class="detailPemasukan mr-1 btn btn-sm btn-info" href="#addPengeluaran" data-id="' + oData.id + '"><i class="fa fa-search"></i></a><a target="_blank" class="mr-1 btn btn-sm btn-success" href="<?= base_url('cetak/invoice/') ?>' + oData.id_trx + '"><i class="fa fa-print"></i></a>');
                                    }
                                }
                            ]
                        });
                    }

                    function baru(kode) {
                        $.ajax({
                            url: '<?= base_url('pengeluaran/getKode/') ?>',
                            data: {
                                'kode': kode
                            },
                            type: 'post',
                            dataType: 'json',
                            success: function(res) {

                                $('.id_trx').val(res.id_trx)
                            }
                        })
                    }

                    $('.tabPengeluaran').click(function() {
                        var kode = $(this).data('kode')
                        baru(kode)
                    })

                    $('.inputBaru').click(function(e) {
                        var inv = $.trim($('#inv').html())
                        $('.id_trx').val(inv)
                        var kode = 2
                        $('.nav-pills').show()
                        $('.modal-title').html('Input Pengeluaran Kas')
                        baru(kode)
                    })

                    $(document).on('click', '.detailPemasukan', function(e) {
                        e.preventDefault()
                        var id = $(this).data('id')
                        $('.nav-pills').hide()
                        $('.modal-title').html('Edit Pengeluaran Kas')
                        console.log(id);

                        $.ajax({
                            url: '<?= base_url('pengeluaran/get/') ?>',
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
                                $('.selectpicker option[value="' + res.akun_trx + '"]').attr('selected', true)
                                $('.selectpicker option[value="' + res.akun_trx + '"]').siblings().attr('selected', false)
                                $('.akun_kas option[value="' + res.akun_kas + '"]').attr('selected', true)
                                $('.akun_kas option[value="' + res.akun_kas + '"]').siblings().attr('selected', false)
                                $('.selectpicker').selectpicker('val', res.akun_trx);
                            }
                        })
                    })

                    $('.addPengeluaran').submit(function(e) {
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
                                            getPengeluaran()
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

                    $('.metode').change(function(e){
                        var metode = $('.metode option:selected').val()
                        if (metode == 5) {
                            $('#kode').removeClass('d-none')
                        } else {
                            $('#kode').addClass('d-none')
                        }
                    })
                </script>