                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="row">

                        <duv class="col-md-12">
                            <?php $this->load->view('admin/breadcrumb'); ?>
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 bg-dark ">
                                    <h3 class="m-0 text-white font-weight-bold ">
                                        <?= $title; ?>
                                        <a href="#" class="btn btn-success export btn-border-circle float-right"><i class="fas fa-file-excel"></i> Export Excel</a>
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <ul class="nav nav-pills nav-justified border-bottom-primary" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">RINGKASAN</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">FILTER</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content mt-3" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <table class="table table-hover table-sm">
                                                        <thead class="bg-dark text-white">
                                                            <tr>
                                                                <th>Deskripsi</th>
                                                                <th>Nilai</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <th scope="col">Saldo Keseluruhan</th>
                                                                <td scope="col"><?= rupiah($saldoAll) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="col">Saldo Tahun Ini</th>
                                                                <td scope="col"><?= rupiah($saldoTahunIni) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="col">Saldo Bulan ini</th>
                                                                <td scope="col"><?= rupiah($saldoBulanIni) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="col">Saldo Hari ini</th>
                                                                <td scope="col"><?= rupiah($saldoHariIni) ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-md-7">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
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
                                            <div class="table-responsive">
                                            <table class="table table-striped table-sm text-center" width="100%" id="dataBni">
                                            <thead class="bg-dark text-white ">
                                                <tr>
                                                    <th rowspan="2">No</th>
                                                    <th rowspan="2">Tanggal</th>
                                                    <th rowspan="2">Th. Ajaran</th>
                                                    <th rowspan="2">Bank</th>
                                                    <th rowspan="2">Penyetor</th>
                                                    <th rowspan="2">Nama Siswa</th>
                                                    <th rowspan="2">Kelas</th>
                                                    <th colspan="8">Rincian Transfer</th>
                                                    <th rowspan="2">Total</th>
                                                </tr>
                                                <tr>
                                                    <th>SPP</th>
                                                    <th>INFAQ GEDUNG</th>
                                                    <th>KEGIATAN</th>
                                                    <th>SERAGAM</th>
                                                    <th>KOMITE</th>
                                                    <th>BUKU</th>
                                                    <th>SARPRAS</th>
                                                    <th>FORMULIR</th>
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
                        </duv>
                    </div>


                </div>
                <!-- /.container-fluid -->

                </div>


                <script>
                    var hari = $('.hari').val()
                    var bln = $('.bulan').val()
                    var thn = $('.tahun').val()
                    getBni(bln, thn, hari)
                    $('.cari').click(function(e) {
                        e.preventDefault()
                        var hari = $('.hari').val()
                        var bln = $('.bulan').val()
                        var thn = $('.tahun').val()
                        getBni(bln, thn, hari)
                        $('.excel').attr('href', '<?= base_url('bni/export/') ?>' + bln + '/' + thn)
                    })
                    function getBni(bln, thn, hari) {
                        var dataBni = $('#dataBni').DataTable({
                            'ajax': {
                                "type": "POST",
                                "url": '<?= base_url('bni/getAll/') ?>' + bln + '/' + thn + '/' + hari,
                                "dataSrc": ""
                            },
                            'pageLength': 100,
                            'destroy': true,
                            "autoWidth": true,
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
                                    "data": "kelas"
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
                                    "data": "formulir"
                                },
                                {
                                    "data": "total"
                                }
                            ]
                        });


                    }
                </script>