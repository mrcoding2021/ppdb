                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <?php $this->load->view('admin/breadcrumb'); ?>

                            <div class="card shadow mb-4">
                                <div class="card-header py-3 bg-dark ">
                                    <h3 class="m-0 text-white font-weight-bold "> <?= $title ?></h3>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12 col-lg-12 container">
                                        <div class="mb-3 row">
                                            <div class="col-lg-2 col-sm-4">
                                                <label for="1" class="col-form-label">Jenis KAS</label>
                                                <select name="kas" class="form-control form-control-sm kas">
                                                    <option value="0-10001">Kas Yayasan</option>
                                                    <option value="0-10002">Kas BOS</option>
                                                    <option value="0-10003">Kas Kecil</option>
                                                </select>
                                            </div>
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
                                            <div class="col-lg-1 col-sm-4">
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
                                        <table class="table table-striped table-sm " width="100%" id="dataPengeluaran">
                                            <thead class="bg-dark text-white text-center">
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

                <script>
                    var kas = $('.kas').val()
                    var hari = $('.hari').val()
                    var bln = $('.bulan').val()
                    var thn = $('.tahun').val()
                    getPengeluaran(kas, bln, thn, hari)

                    $('.cari').click(function(e) {
                        e.preventDefault()
                        var kas = $('.kas').val()
                        var hari = $('.hari').val()
                        var bln = $('.bulan').val()
                        var thn = $('.tahun').val()
                        getPengeluaran(kas, bln, thn, hari)
                        $('.excel').attr('href', '<?= base_url('pengeluaran/export/') ?>' + kas + '/' + bln + '/' + thn)

                    })

                    function getPengeluaran(kas, bln, thn, hari) {
                        var getPengeluaran = $('#dataPengeluaran').DataTable({
                            "processing": true,
                            "language": {
                                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                            },
                            'ajax': {
                                "type": "POST",
                                "url": '<?= base_url('pengeluaran/harian/') ?>' + kas + '/' + bln + '/' + thn + '/' + hari,
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
                </script>