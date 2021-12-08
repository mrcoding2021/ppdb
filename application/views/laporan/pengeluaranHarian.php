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
                                                <label for="1" class="col-form-label">Dari Tanggal</label>
                                                <input type="date" class="start form-control-sm form-control" name="start" value="<?= date('Y-m') . '-01' ?>">
                                            </div>
                                            <div class="col-lg-2 col-sm-4">
                                                <label for="1" class="col-form-label">Sampai Tanggal</label>
                                                <input type="date" class="end form-control-sm form-control" name="end" value="<?= date('Y-m-d') ?>">
                                            </div>

                                            <div class="col-lg-1 col-sm-4">
                                                <label for="1" class="col-form-label">.</label>
                                                <a href="#" class="cari btn btn-success btn-block btn-sm">Cari</a>
                                            </div>
                                            <div class="col-lg-2 col-sm-4">
                                                <label for="1" class="col-form-label">.</label>
                                                <a href="<?= base_url('sispem/pemasukan') ?>" data-id="excel" class="excel btn btn-primary btn-block btn-sm">Export Excel</a>
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
                    var start = $('.start').val()
                    var end = $('.end').val()
                    getPengeluaran(start, end)

                    $('.cari').click(function(e) {
                        e.preventDefault()
                        var start = $('.start').val()
                        var end = $('.end').val()
                        getPengeluaran(start, end)
                        $('.excel').attr('href', '<?= base_url('pengeluaran/export/') ?>' + start + '/' + end)

                    })

                    function getPengeluaran(start, end) {
                        var getPengeluaran = $('#dataPengeluaran').DataTable({
                            "processing": true,
                            "language": {
                                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                            },
                            'ajax': {
                                "type": "POST",
                                "url": '<?= base_url('pengeluaran/harian/') ?>' + start + '/' + end,
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