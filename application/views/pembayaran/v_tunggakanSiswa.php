                <!-- Begin Page Content -->
                <div class="container-fluid">



                    <div class="row">

                        <duv class="col-md-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 bg-dark ">
                                    <h3 class="m-0 text-white font-weight-bold ">Laporan
                                        <?= $title;
                                        if ($user['level'] == 1) : ?><?php endif ?>
                                        <a href="" target="__blank" class="cetak-invoice  btn btn-primary float-right btn-border-circle"> Cetak Invoice </a>
                                        <a href="#" class="btn btn-success input-baru btn-border-circle float-right">Cetak Baru</a>
                                    </h3>
                                </div>
                                <div class="card-body">

                                    <div class="col">

                                        <div class="form-group row">
                                            <label for="1" class="col-sm-2 col-form-label">Nama Murid</label>
                                            <div class="col-sm-10">
                                                <input type="text" autofocus class="form-control" name="nama" id="nama_siswa">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="1" class="col-sm-1 col-form-label">Kelas</label>
                                            <div class="col-sm-1">
                                                <input type="text" readonly class="form-control" name="kelas">
                                            </div>
                                            <label for="1" class="col-sm-1 col-form-label">NIS</label>
                                            <div class="col-sm-2">
                                                <input type="text" readonly class="form-control" name="nis">
                                            </div>
                                            <label for="1" class="col-sm-1 col-form-label">Orangtua</label>
                                            <div class="col-sm-3">
                                                <input type="text" readonly class="form-control" name="wali">
                                            </div>
                                            <label for="1" class="col-sm-1 col-form-label">Kategori</label>
                                            <div class="col-sm-2">
                                                <input type="text" readonly class="form-control" name="kat_murid">
                                            </div>
                                        </div>


                                    </div>


                                    <div class="table-responsive">
                                        <form action="<?= base_url('pembayaran/inputData') ?>" class="inputData" method="POST">
                                            <table class="table table-sm table-bordered" width="100%" id="tableLunas" cellspacing="0">
                                                <thead>
                                                    <tr class="text-center text-white bg-success">
                                                        <th rowspan="2">No.</th>
                                                        <th rowspan="2">Tahun Ajaran</th>
                                                        <th colspan="9">JUMLAH BIAYA PENDIDIKAN YANG SUDAH TERBAYAR</th>
                                                    </tr>
                                                    <tr class="bg-success text-white text-center">
                                                        <th>Pembangunan</th>
                                                        <th>Kegiatan</th>
                                                        <th>Seragam</th>
                                                        <th>Komite</th>
                                                        <th>Buku Paket</th>
                                                        <th>SPP</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>

                                                <tbody id="tunggakan-terbayar">

                                                </tbody>


                                            </table>

                                            <table class="table table-sm table-bordered" width="100%" id="tableHutang" cellspacing="0">
                                                <thead>
                                                    <tr class="text-center text-white bg-danger">
                                                        <th rowspan="2">No.</th>
                                                        <th rowspan="2">Tahun Ajaran</th>
                                                        <th colspan="9">JUMLAH BIAYA PENDIDIKAN YANG BELUM TERBAYAR</th>
                                                    </tr>
                                                    <tr class="bg-danger text-white text-center">
                                                        <th>Pembangunan</th>
                                                        <th>Kegiatan</th>
                                                        <th>Seragam</th>
                                                        <th>Komite</th>
                                                        <th>Buku Paket</th>
                                                        <th>SPP</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>

                                                <tbody id="tunggakan-hutang">

                                                </tbody>


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


                <script>
                    function iuranLunas(id) {
                        $.ajax({
                            url: '<?= base_url('tunggakan/lunas') ?>',
                            type: 'post',
                            dataType: 'json',
                            data: {
                                'id': id
                            },
                            success: function(res) {

                                var html = ''
                                $.each(res, function(i, v) {
                                    html += '<tr>'
                                    html += '<td>' + v.no + '</td><td>' + v.ta + '</td><td>' + v.pembangunan + '</td><td>' + v.kegiatan + '</td><td>' + v.seragam + '</td><td>' + v.komite + '</td><td>' + v.buku_paket + '</td><td>' + v.spp + '</td><td>' + v.total + '</td>'
                                    html += '</tr>'
                                })
                                $('#tunggakan-terbayar').html(html)
                            }
                        })
                    }

                    function iuranHutang(id) {
                        $.ajax({
                            url: '<?= base_url('tunggakan/hutang') ?>',
                            type: 'post',
                            dataType: 'json',
                            data: {
                                'id': id
                            },
                            success: function(res) {
                                var html = ''
                                $.each(res, function(i, v) {
                                    html += '<tr>'
                                    html += '<td>' + v.no + '</td><td>' + v.ta + '</td><td>' + v.pembangunan + '</td><td>' + v.kegiatan + '</td><td>' + v.seragam + '</td><td>' + v.komite + '</td><td>' + v.buku_paket + '</td><td>' + v.spp + '</td><td>' + v.total + '</td>'
                                    html += '</tr>'
                                })
                                $('#tunggakan-hutang').html(html)
                            }
                        })
                    }
                </script>