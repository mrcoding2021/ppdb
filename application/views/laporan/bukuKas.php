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
                                                <label for="1">Tahun Ajaran</label>
                                                <select name="ta" class="form-control">
                                                    <?php $this->db->group_by('ta');
                                                    $ta = $this->db->get('tb_ta')->result();
                                                    foreach ($ta as $key) : ?>
                                                        <option <?= (substr($key->ta, 5) == date('Y')) ? 'selected' : '' ?> value="<?= $key->ta ?>"><?= $key->ta ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-2">
                                                <label>Bulan</label>
                                                <select name="bln" class="form-control">
                                                    <?php for ($i = 1; $i < 13; $i++) : ?>
                                                        <option value="<?= $i ?>"><?= bulan($i) ?></option>
                                                    <?php endfor ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-2">
                                                <label>Tahun</label>
                                                <select name="thn" class="form-control">
                                                    <?php
                                                    $this->db->select('ta');
                                                    $this->db->group_by('ta');
                                                    $thn = $this->db->get('tb_pembayaran')->result();
                                                    foreach ($thn as $t) : ?>
                                                        <option value="<?= substr($t->ta, 5) ?>"><?= substr($t->ta, 5) ?></option>
                                                    <?php endforeach ?>
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
                                                        <th width="20%">Nama</th>
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

                <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-success text-white">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Item</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('setting/add') ?>" method="post" class="input-ajaran">
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <label>Tahun Ajaran</label>
                                            <input type="text" class="form-control" name="tahun_ajaran">
                                        </div>
                                        <div class="col-sm-4">
                                            <label>SPP</label>
                                            <input type="text" class="form-control" name="spp">
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Infaq Gedung</label>
                                            <input type="text" class="form-control" name="infaq_gedung">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <label>Kegiatan</label>
                                            <input type="text" class="form-control" name="kegiatan">
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Seragam</label>
                                            <input type="text" class="form-control" name="seragam">
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Komite</label>
                                            <input type="text" class="form-control" name="komite">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <label>Buku</label>
                                            <input type="text" class="form-control" name="buku">
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Ekskul</label>
                                            <input type="text" class="form-control" name="ekskul">
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button id="close" class="pt-1 btn btn-block btn-border-circle btn-secondary" type="button" style="position: relative; top: 4px; height:38px" data-dismiss="modal">Close</button>
                                        <button class="btn btn-success  btn-border-circle btn-block edit" type="submit">Input</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

                <script>
                    getBukuKas('2020-2021', '01', '2021')

                    function getBukuKas(ta, bln, thn) {

                        var bukuKas = $('#bukuKas').DataTable({
                            'ajax': {
                                "type": "POST",
                                "url": '<?= base_url('laporan/getBukuKas/') ?>' + ta + '/' + bln + '/' + thn,
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