                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <div class="row">

                        <duv class="col-md-12">
                            <?php $this->load->view('admin/breadcrumb'); ?>
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 bg-dark ">
                                    <h3 class="m-0 text-white font-weight-bold ">
                                        <?= $title; ?>
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3 row">
                                        <div class="col-sm-2">
                                            <?php
                                            $ta = '2016-2017'; ?>
                                            <label for="1" class="col-form-label">Tahun Ajaran</label>
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
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-sm" id="global" width="100%" cellspacing="0">
                                            <thead class="bg-dark text-white text-center">
                                                <tr>
                                                    <th rowspan="2">No</th>
                                                    <th rowspan="2">Nama Siswa</th>
                                                    <?php $kode = ['PEMBANGUNAN', 'KEGIATAN', 'SERAGAM', 'KOMITE', 'BUKU PAKET', 'SPP',  'SARPRAS'];
                                                    for ($i = 0; $i < 7; $i++) { ?>
                                                        <th colspan="3"><?= $kode[$i] ?></th>
                                                    <?php } ?>
                                                </tr>
                                                <tr>
                                                    <?php for ($i = 0; $i < 7; $i++) { ?>
                                                        <th>Tagihan</th>
                                                        <th>Pembayaran</th>
                                                        <th>Sisa</th>
                                                    <?php } ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </duv>
                    </div>


                </div>
                <!-- /.container-fluid -->

                </div>
               

                <script>
                    $('.ta').change(function(e) {
                        e.preventDefault()
                        var ta = $(this).val()
                        $('.excel').attr('href', '<?= base_url('laporan/exportGlobal/') ?>' + ta)
                        getGlobal(ta)
                    })

                    var ta = $('.ta').val()
                    getGlobal(ta)

                    function getGlobal(ta) {
                        var global = $('#global').DataTable({
                            'ajax': {
                                "type": "POST",
                                "url": '<?= base_url('laporan/getGlobal/') ?>' + ta,
                                "dataSrc": ""
                            },
                            'destroy': true,
                            'columns': [{
                                    "data": "no"
                                },
                                {
                                    "data": "nama"
                                },
                                {
                                    "data": "tagihan_p"
                                },
                                {
                                    "data": "bayar_p"
                                },
                                {
                                    "data": "sisa_p"
                                },
                                {
                                    "data": "tagihan_k"
                                },
                                {
                                    "data": "bayar_k"
                                },
                                {
                                    "data": "sisa_k"
                                },
                                {
                                    "data": "tagihan_s"
                                },
                                {
                                    "data": "bayar_s"
                                },
                                {
                                    "data": "sisa_s"
                                },
                                {
                                    "data": "tagihan_kom"
                                },
                                {
                                    "data": "bayar_kom"
                                },
                                {
                                    "data": "sisa_kom"
                                },
                                {
                                    "data": "tagihan_b"
                                },
                                {
                                    "data": "bayar_b"
                                },
                                {
                                    "data": "sisa_b"
                                },
                                {
                                    "data": "tagihan_spp"
                                },
                                {
                                    "data": "bayar_spp"
                                },
                                {
                                    "data": "sisa_spp"
                                },
                                {
                                    "data": "tagihan_sar"
                                },
                                {
                                    "data": "bayar_sar"
                                },
                                {
                                    "data": "sisa_sar"
                                },
                            ]
                        });
                    }
                </script>