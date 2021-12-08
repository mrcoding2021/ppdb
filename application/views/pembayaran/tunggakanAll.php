                <!-- Begin Page Content -->
                <div class="container-fluid">



                    <div class="row">

                        <duv class="col-md-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 bg-dark ">
                                    <h3 class="m-0 text-white font-weight-bold ">Laporan
                                        <?= $title;
                                        if ($user['level'] == 1) : ?><?php endif ?>
                                        <a href="#" target="__blank" id="cetakTunggak" class="cetak-invoice  btn btn-primary float-right btn-border-circle"> Cetak Laporan </a>
                                    </h3>
                                </div>
                                <div class="card-body">

                                    <div class="table-responsive">
                                        <form action="<?= base_url('pembayaran/inputData') ?>" class="inputData" method="POST">
                                            <table class="table table-sm table-bordered" width="100%" id="tableLunas" cellspacing="0">
                                                <thead>
                                                    <tr class="text-center text-white bg-success">
                                                        <th rowspan="2">No.</th>
                                                        <th rowspan="2">Tahun Ajaran</th>
                                                        <th colspan="8">JUMLAH BIAYA PENDIDIKAN YANG SUDAH TERBAYAR</th>
                                                    </tr>
                                                    <tr class="bg-success text-white text-center">
                                                        <th>Pembangunan</th>
                                                        <th>Kegiatan</th>
                                                        <th>Seragam</th>
                                                        <th>Komite</th>
                                                        <th>Buku Paket</th>
                                                        <th>SPP</th>
                                                        <th>SARPRAS</th>
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
                                                        <th colspan="8">JUMLAH BIAYA PENDIDIKAN YANG BELUM TERBAYAR</th>
                                                    </tr>
                                                    <tr class="bg-danger text-white text-center">
                                                        <th>Pembangunan</th>
                                                        <th>Kegiatan</th>
                                                        <th>Seragam</th>
                                                        <th>Komite</th>
                                                        <th>Buku Paket</th>
                                                        <th>SPP</th>
                                                        <th>SARPRAS</th>
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
                    hutang()
                    lunas()
                    function lunas() {
                        $.ajax({
                            url: '<?= base_url('tunggakan/lunas') ?>',
                            type: 'post',
                            dataType: 'json',
                            success: function(res) {
                                console.log(res);

                                var html = ''
                                $.each(res, function(i, v) {
                                    html += '<tr>'
                                    html += '<td>' + v.no + '</td><td>' + v.ta + '</td><td>' + (v.pembangunan) + '</td><td>' + v.kegiatan + '</td><td>' + v.seragam + '</td><td>' + v.komite + '</td><td>' + v.buku_paket + '</td><td>' + v.spp + '</td><td>' + v.sarpras + '</td><td>' + v.total + '</td>'
                                    html += '</tr>'
                                })
                                $('#tunggakan-terbayar').html(html)
                                $('#cetakTunggak').attr('href', '<?= base_url('cetak/tunggakanAll/') ?>')
                            }
                        })
                    }

                    function hutang() {
                        $.ajax({
                            url: '<?= base_url('tunggakan/hutang') ?>',
                            type: 'post',
                            dataType: 'json',
                            success: function(res) {
                                console.log(res);

                                var html = ''
                                $.each(res, function(i, v) {
                                    html += '<tr>'
                                    html += '<td>' + v.no + '</td><td>' + v.ta + '</td><td>' + (v.pembangunan) + '</td><td>' + (v.kegiatan) + '</td><td>' + (v.seragam) + '</td><td>' + (v.komite) + '</td><td>' + (v.buku_paket) + '</td><td>' + (v.spp) + '</td><td>' + (v.sarpras) + '</td><td>' + (v.total) + '</td>'
                                    html += '</tr>'
                                })
                                $('#tunggakan-hutang').html(html)
                            }
                        })
                    }
                </script>