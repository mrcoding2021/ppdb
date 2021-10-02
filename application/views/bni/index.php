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

                                <div class="row mt-3">
                                    <div class="col-md-12 col-lg-12 container">
                                        <table class="table table-striped table-sm text-center" width="100%" id="dataPemasukan">
                                            <thead class="bg-dark text-white ">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Tanggal</th>
                                                    <th>TH. Ajaran</th>
                                                    <th>Bank</th>
                                                    <th>Penyetor</th>
                                                    <th>Nama Siswa</th>
                                                    <th>Jumlah Transfer</th>
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
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-success text-white">
                                <h5 class="modal-title" id="exampleModalLabel">Input <?= $title ?></h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" class="addPemasukan" action="<?= base_url('bni/add') ?>">
                                    <div class="row form-group">
                                        <div class="col-sm-4">
                                            <label>No. Invoice</label>
                                            <input type="text" readonly class="form-control id_trx" name="id_trx">
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Tanggal Trx.</label>
                                            <input type="date" value="<?= date('Y-m-d') ?>" class="form-control date" name="date">
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Jam Transfer</label>
                                            <input type="time" value="<?= date('H:i:s') ?>" class="form-control time" name="time" step="any">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sm-4">
                                            <label>Nama Bank</label>
                                            <select name="bank" class="form-control bank">
                                                <option value="0">Pilih Bank</option>
                                                <option value="BSI">BSI</option>
                                                <option value="DANA">DANA</option>
                                                <option value="MANDIRI">MANDIRI</option>
                                                <option value="FLIP">FLIP</option>
                                                <option value="BTN">BTN</option>
                                                <option value="BNI">BNI</option>
                                                <option value="PERMATA">PERMATA</option>
                                                <option value="BRI">BRI</option>
                                                <option value="BCA">BCA</option>
                                                <option value="MUAMALAT">MUAMALAT</option>
                                                <option value="OVO">OVO</option>
                                                <option value="GOPAY">GOPAY</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Nama Penyetor</label>
                                            <input type="text" class="form-control penyetor" name="penyetor">
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Nama Siswa</label>
                                            <input type="text" class="form-control nama" name="nama" id="nama_siswa">
                                            <input type="hidden" class="form-control id_murid" name="id_murid">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <label for="1">Kelas</label>
                                            <input type="text" readonly class="form-control kelas" name="kelas">
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="1">Orangtua</label>
                                            <input type="text" readonly class="form-control wali" name="wali">
                                        </div>
                                        <div class="col-sm-4">
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
                                        <div class="col-sm-4">
                                            <label>SPP</label>
                                            <input type="text" class="form-control nilai" name="nilai[]">
                                            <input type="hidden" class="form-control id" name="id[]">
                                        </div>
                                        <div class="col-sm-4">
                                            <label>INFAQ GEDUNG</label>
                                            <input type="text" class="form-control nilai" name="nilai[]">
                                            <input type="hidden" class="form-control id" name="id[]">
                                        </div>
                                        <div class="col-sm-4">
                                            <label>KEGAITAN</label>
                                            <input type="text" class="form-control nilai" name="nilai[]">
                                            <input type="hidden" class="form-control id" name="id[]">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <label>SERAGAM</label>
                                            <input type="text" class="form-control nilai" name="nilai[]">
                                            <input type="hidden" class="form-control id" name="id[]">
                                        </div>
                                        <div class="col-sm-4">
                                            <label>KOMITE</label>
                                            <input type="text" class="form-control nilai" name="nilai[]">
                                            <input type="hidden" class="form-control id" name="id[]">
                                        </div>
                                        <div class="col-sm-4">
                                            <label>BUKU</label>
                                            <input type="text" class="form-control nilai" name="nilai[]">
                                            <input type="hidden" class="form-control id" name="id[]">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <label>SARPRAS</label>
                                            <input type="text" class="form-control nilai" name="nilai[]">
                                            <input type="hidden" class="form-control id" name="id[]">
                                        </div>
                                        <div class="col-sm-4">
                                            <label>FORMULIR</label>
                                            <input type="text" class="form-control nilai" name="nilai[]">
                                            <input type="hidden" class="form-control id" name="id[]">
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Jumlah Transfer</label>
                                            <input type="text" readonly class="form-control jumlah" name="jumlah">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="pt-1 btn btn-block btn-border-circle btn-secondary" type="button" style="position: relative; top: 4px; height:38px" data-dismiss="modal">Close</button>
                                        <button class="btn btn-success btn-border-circle btn-block" type="submit">Simpan</button>
                                        <?php if ($this->session->userdata('level') != 3) { ?>
                                            <a target="_blank" class="approve mr-1 btn btn-primary btn-border-circle btn-block" href="<?= base_url('cetak/invoice/') ?>' + oData.id_trx + '"><i class="fa fa-check"></i> Approve</a>
                                        <?php } ?>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <script>
                    $('.nilai').keyup(function() {
                        var nilai = $('.nilai')
                        var jumlah = 0
                        for (let i = 0; i < $('.nilai').length; i++) {
                            var el = $('.nilai').eq(i).val();
                            if (el > 0) {
                                jumlah = parseInt(jumlah) + parseInt(el)
                            }
                            // console.log(el);
                            $('.jumlah').val(jumlah)
                        }
                    })

                    getBni()

                    function getBni() {
                        var getPemasukan = $('#dataPemasukan').DataTable({
                            "processing": true,
                            "language": {
                                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
                            },
                            'ajax': {
                                "type": "POST",
                                "url": '<?= base_url('bni/get/') ?>',
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
                                    "data": "ta"
                                },
                                {
                                    "data": "bank"
                                },
                                {
                                    "data": "penyetor"
                                },
                                {
                                    "data": "nama"
                                },
                                {
                                    "data": "jumlah"
                                },
                                {
                                    "data": "id",
                                    "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                                        $(nTd).html('<a data-toggle="modal" class="detailBni mr-1 btn btn-sm btn-info" href="#addPemasukan" data-id="' + oData.id_trx + '"><i class="fa fa-search"></i></a><a target="_blank" class="mr-1 btn btn-sm btn-success" href="<?= base_url('cetak/invoice/') ?>' + oData.id_trx + '"><i class="fa fa-print"></i></a><a target="_blank" class="mr-1 btn btn-sm btn-danger" href="#' + oData.id_trx + '"><i class="fa fa-times"></i></a>');
                                    }
                                }
                            ]
                        });
                    }

                    $('.inputBaru').click(function(e) {
                        $('.approve').hide()
                        $('.addPemasukan').attr('action', '<?= base_url('bni/add') ?>')
                        $('input').val('')
                        $('.date').val('<?= date('Y-m-d') ?>')
                        $('.time').val('<?= date('H:i:s') ?>')
                        $('.nilai').val(0)
                        $('.modal-title').html('Tambah Setoran')
                        $.ajax({
                            url: '<?= base_url('bni/getKode/') ?>',
                            type: 'post',
                            dataType: 'json',
                            success: function(res) {
                                console.log(res);
                                $('.id_trx').val(res.id_trx)
                            }
                        })
                    })

                    $('.approve').click(function(e) {
                        e.preventDefault()
                        var id = $(this).data('id')
                        Swal.fire({
                            title: "Yakin ingin diapprove?",
                            text: "Transaksi ini akan masuk ke laporan kas BNI",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Yes, simpan sekarang!",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: '<?= base_url('bni/approve')?>',
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
                                            $('.modal').modal('hide')
                                            getBni()
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

                    $(document).on('click', '.detailBni', function(e) {
                        e.preventDefault()
                        $('.approve').show()
                        var id = $(this).data('id')
                        $('.approve').attr('data-id', id)
                        $('.addPemasukan').attr('action', '<?= base_url('bni/edit') ?>')
                        // console.log(id);
                        $('.modal-title').html('Edit Detail Setoran')
                        $.ajax({
                            url: '<?= base_url('bni/get/') ?>',
                            type: 'post',
                            dataType: 'json',
                            data: {
                                'id': id
                            },
                            success: function(res) {
                                console.log(res);
                                $('.nilai').val(0)
                                $('.id_trx').val(res[0].id_trx)
                                $('.nama').val(res[0].nama)
                                $('.penyetor').val(res[0].penyetor)
                                $('.id_murid').val(res[0].id_murid)
                                $('.date').val(res[0].date)
                                $('.time').val(res[0].time)
                                $('.jumlah').val(res[0].jumlah)
                                $('.kelas').val(res[0].kelas)
                                $('.wali').val(res[0].wali)
                                $('.metode option[value="' + res.metode + '"]').attr('selected', true)
                                $('.metode option[value="' + res.metode + '"]').siblings().attr('selected', false)
                                $('.ta option[value="' + res[0].ta + '"]').attr('selected', true)
                                $('.ta option[value="' + res[0].ta + '"]').siblings().attr('selected', false)
                                $('.bank option[value="' + res[0].bank + '"]').attr('selected', true)
                                $('.bank option[value="' + res[0].bank + '"]').siblings().attr('selected', false)
                                var i = 0
                                $.each(res, function(i, v) {
                                    $('.nilai').eq(i).val(v.nilai)
                                    $('.id').eq(i).val(v.id)
                                    i++
                                })
                            }
                        })
                    })

                    $('.addPemasukan').submit(function(e) {
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
                                            getBni()
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