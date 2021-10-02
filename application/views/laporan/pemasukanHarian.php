                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <?php $this->load->view('admin/breadcrumb'); ?>

                            <div class="card shadow mb-4">
                                <div class="card-header py-3 bg-dark ">
                                    <h3 class="m-0 text-white font-weight-bold "> <?= $title ?>
                                        <a href="#addPemasukan" data-toggle="modal" class="btn btn-success inputBaru btn-border-circle float-right">Eksport Data</a>
                                    </h3>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12 col-lg-12 container">
                                    <div class="mb-3 row">
                                                <div class="col-lg-2 col-sm-4">
                                                    <label for="1" class="col-form-label">Tanggal</label>
                                                    <select class="form-control form-control-sm hari" name="hari">
                                                        <option value="0">Semua</option>
                                                        <?php for ($i = 1; $i <= 31; $i++) { ?>
                                                            <option value="<?= $i ?>"><?= $i ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-2 col-sm-4">
                                                    <label for="1" class="col-form-label">Bulan</label>
                                                    <select class="form-control form-control-sm bulan" name="bulan">
                                                        <?php for ($i = 1; $i < 12; $i++) { ?>
                                                            <option <?= (date('m') == $i) ? 'selected' : '' ?> value="<?= $i ?>"><?= bulan($i) ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-2 col-sm-4">
                                                    <label for="1" class="col-form-label">Tahun</label>
                                                    <select class="form-control form-control-sm tahun" name="tahun">
                                                        <?php for ($i = 0; $i < 10; $i++) { ?>
                                                            <option <?= (date('Y') == '202' . $i) ? 'selected' : '' ?> value="<?= '202' . $i ?>"><?= '202' . $i ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                <div class="col-lg-1 col-sm-4">
                                                    <label for="1" class="col-form-label">.</label>
                                                    <a href="#" class="cari btn btn-success btn-block btn-sm">Cari</a>
                                                </div>
                                                <div class="col-lg-2 col-sm-4">
                                                    <label for="1" class="col-form-label">.</label>
                                                    <a href="<?= base_url('tabungan/excel') ?>" data-id="excel" class="excel btn btn-primary btn-block btn-sm">Export Excel</a>
                                                </div>
                                                <!-- <div class="col-lg-2 col-sm-4">
                                                    <label for="1" class="col-form-label">.</label>
                                                    <a href="<?= base_url('tabungan/excel') ?>" data-id="pdf" class="pdf btn btn-info btn-block btn-sm">Export PDF</a>
                                                </div> -->
                                            </div>
                                        <table class="table table-striped table-sm text-center" width="100%" id="dataPemasukan">
                                            <thead class="bg-dark text-white ">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Tanggal</th>
                                                    <th>Dikeluarkan kepada</th>
                                                    <th>Dari Kas</th>
                                                    <th>Metode</th>
                                                    <th>Nilai</th>
                                                    <th>Total</th>
                                                    <th>Keterangan</th>
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
                                "url": '<?= base_url('pemasukan/harian/') ?>',
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
                                    "data": "saldo"
                                },
                                {
                                    "data": "ket"
                                }
                            ]
                        });
                    }

                    $('.inputBaru').click(function(e) {
                        var inv = $.trim($('#inv').html())
                        $('.id_trx').val(inv)
                        $.ajax({
                            url: '<?= base_url('pemasukan/getKode/') ?>',
                            type: 'post',
                            dataType: 'json',
                            success: function(res) {
                                console.log(res);
                                $('.id_trx').val(res.id_trx)
                            }
                        })
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