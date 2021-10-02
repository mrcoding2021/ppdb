                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <?php $this->load->view('admin/breadcrumb'); ?>


                    <div class="row">
                        <duv class="col-md-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 bg-dark ">
                                    <h3 class="m-0 text-white font-weight-bold "><?= $title ?>
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                                <label for="1">Jenis Kas</label>
                                                <select name="kas" class="kas form-control">
                                                    <?php $query = 'SELECT * FROM tb_rab WHERE kategori = 0';
                                                    $ta = $this->db->query($query)->result();
                                                    foreach ($ta as $key) : ?>
                                                        <option value="<?= $key->kode_akun ?>"><?= $key->nama ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-2">
                                                <label for="1">Tahun Ajaran</label>
                                                <select name="ta" class="ta form-control">
                                                    <?php $query = 'SELECT ta FROM tb_user_tagihan GROUP BY ta';
                                                    $ta = $this->db->query($query)->result();
                                                    foreach ($ta as $key) : ?>
                                                        <option <?= (substr($key->ta, 5) == date('Y')) ? 'selected' : '' ?> value="<?= $key->ta ?>"><?= $key->ta ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-2">
                                                <label>Bulan</label>
                                                <select name="bln" class="bln form-control">
                                                    <?php for ($i = 1; $i < 13; $i++) : ?>
                                                        <option <?= ($i == date('m')) ? 'selected' : ''  ?> value="<?= $i ?>"><?= bulan($i) ?></option>
                                                    <?php endfor ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-2">
                                                <label>Tahun</label>
                                                <select name="thn" class="thn form-control">
                                                    <?php
                                                    $n = 2016;
                                                    for ($i = 1; $i < 10; $i++) : ?>
                                                        <option <?= ($n == date('Y')) ? 'selected' : ''  ?> value="<?= $n ?>"><?= $n ?></option>
                                                    <?php $n++;
                                                    endfor ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-1">
                                                <a href="#" style="margin-top : 32px" class="btn-block btn btn-success" id="cariBukuKas"><i class="fa fa-search"></i> Cari</a>
                                            </div>
                                        </div>
                                        <form action="<?= base_url('pembayaran/inputData') ?>" class="inputData" method="POST">
                                            <table class="table table-bordered" width="100%" cellspacing="0" id="bukuKas">
                                                <thead class="text-center">
                                                    <tr valign="middle">
                                                        <th>Hari, Tanggal</th>
                                                        <th width="20%">Jenis Akun</th>
                                                        <th>Keterangan</th>
                                                        <th>Debit</th>
                                                        <th>Kredit</th>
                                                        <th>Saldo</th>
                                                    </tr>
                                                </thead>
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



                <script>
                    var kas = $('.kas').val()
                    var ta = $('.ta').val()
                    var bln = $('.bln').val()
                    var thn = $('.thn').val()
                    getBukuKas(kas, ta, bln, thn)

                    function getBukuKas(kas, ta, bln, thn) {

                        var bukuKas = $('#bukuKas').DataTable({
                            'ajax': {
                                "type": "POST",
                                "url": '<?= base_url('laporan/getBukuKas/') ?>' + kas + '/' + ta + '/' + bln + '/' + thn,
                                "dataSrc": "",
                            },
                            "destroy": true,
                            'columns': [{
                                    "data": "created_at"
                                },
                                {
                                    "data": "nama"
                                },
                                {
                                    "data": "keterangan"
                                },
                                {
                                    "data": "debit"
                                },
                                {
                                    "data": "kredit"
                                },
                                {
                                    "data": "saldo"
                                }
                            ]
                        });
                    }

                    $('#cariBukuKas').click(function(e) {
                        e.preventDefault()
                        var ta = $('select[name="ta"]').val()
                        var bln = $('select[name="bln"]').val()
                        var thn = $('select[name="thn"]').val()
                        console.log(ta + bln + thn)
                        getBukuKas(ta, bln, thn)
                    })
                </script>