                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <?php $this->load->view('admin/breadcrumb'); ?>
                            <?= $this->session->flashdata('alert');
                            ?>
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 bg-dark ">
                                    <h3 class="m-0 text-white font-weight-bold ">Cari
                                        <?= $title ?></h3>
                                </div>
                                <div class="card-body">

                                    <div class="col">
                                        <div class="form-group row">
                                            <label for="1" class="col-sm-2 col-form-label">No. Invoice</label>
                                            <div class="col-sm-3">
                                                <input type="text" autofocus class="form-control" id="no_invoice" name="no_invoice">
                                            </div>
                                            <div class="col-sm-2">
                                                <a href="#" class="cari_invoice btn btn-success"><i class="fa fa-search"></i> Cari</a>
                                            </div>
                                            <label for="1" class="col-sm-2 col-form-label">Tahun Ajaran</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" readonly name="ta">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="1" class="col-sm-2 col-form-label">Nama Murid</label>
                                            <div class="col-sm-6">
                                                <input readonly type="text" autofocus class="form-control" name="nama">
                                            </div>
                                            <label for="1" class="col-sm-1 col-form-label">No. HP</label>
                                            <div class="col-sm-3">
                                                <input readonly type="text" autofocus class="form-control" name="hp">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="1" class="col-sm-2 col-form-label">Kelas</label>
                                            <div class="col-sm-2">
                                                <input type="text" readonly class="form-control" name="kelas">
                                            </div>
                                            <label for="1" class="col-sm-1 col-form-label">NIS</label>
                                            <div class="col-sm-3">
                                                <input type="text" readonly class="form-control" name="nis">
                                            </div>
                                            <label for="1" class="col-sm-1 col-form-label">Wali</label>
                                            <div class="col-sm-3">
                                                <input type="text" readonly class="form-control" name="pj">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <form action="<?= base_url('pembayaran/inputData') ?>" class="inputData" method="POST">
                                            <table class="table table-bordered" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th width="40%">Pembayaran</th>
                                                        <th>Metode</th>
                                                        <th width="15%">Keterangan</th>
                                                        <th>Nilai</th>
                                                        <th>Diskon</th>
                                                        <th>Jumlah</th>
                                                    </tr>
                                                </thead>

                                                <tbody id="tableBayar">

                                                </tbody>

                                                <tr class="showr">
                                                    <td colspan="4" class="text-right bg-success text-white">Total Bayar</td>
                                                    <td class="bg-success result text-white">Rp. 1.000.000</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="7"><a href="#" class="btn btn-info btn-sm input-item-baru btn-border-circle "> Tambah Item </a><button type="submit" class="btn btn-success btn-sm  btn-border-circle ml-2"> Simpan Semua Data </button><a href="" target="__blank" class="cetak-invoice  btn btn-primary float-right btn-sm  btn-border-circle"> Cetak Invoice </a></td>
                                                </tr>
                                            </table>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- /.container-fluid -->

                </div>

                <script>
                    $('.cari_invoice').click(function(e) {
                        $.ajax({
                            url: '<?= base_url('invoice/cari') ?>',
                            data: {
                                'id': $('#no_invoice').val()
                            },
                            dataType: 'json',
                            type: 'post',
                            beforeSend: function() {
                                $('.bg').show()
                            },
                            complete: function() {
                                $('.bg').hide()
                            },
                            success: function(res) {
                                console.log(res)
                                $('input[name="nama"]').val(res[0].nama)
                                $('input[name="kelas"]').val(res[0].kelas)
                                $('input[name="nis"]').val(res[0].nis)
                                $('input[name="pj"]').val(res[0].pj)
                                $('input[name="ta"]').val(res[0].ta)
                                $('input[name="hp"]').val(res[0].hp)

                                var html = '<tr>'
                                $.each(res, function(i, v) {
                                    html += '<td>' + v.bayar + '</td>' +
                                        '<td>' + v.sumber + '</td>' +
                                        '<td>' + v.ket + '</td>' +
                                        '<td>' + v.kredit + '</td>' +
                                        '<td>' + v.diskon + '</td>' +
                                        '<td>' + v.jumlah + '</td>' +
                                        '</td></tr>'
                                })
                                html += '<tr class="bg-dark text-white"><td colspan="5" style="font-style:italic">Terbilang : ' + res[0].terbilang + '</td><td>' + res[0].grandtotal + '</td></tr>'
                                $('#tableBayar').html(html)
                            }
                        })
                    })
                </script>