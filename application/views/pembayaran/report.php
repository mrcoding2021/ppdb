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
                                    <div class="mb-3 row">\
                                        <div class="col-lg-2 col-sm-4">
                                            <label for="1" class="col-form-label">Hari</label>
                                            <select class="form-control form-control-sm hari" name="hari">
                                                <option value="0">Semua</option>
                                                <?php for ($i = 1; $i < 31; $i++) { ?>
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

                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataAcc" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tanggal</th>
                                                    <th>No. Invoice</th>
                                                    <th>Nama</th>
                                                    <th>Kelas</th>
                                                    <th>Tahun Ajaran</th>
                                                    <th>Jumlah</th>
                                                    <th>Aksi</th>
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

                <div class="modal fade" id="more" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-success text-white">
                                <h5 class="modal-title" id="exampleModalLabel">Rekap Pembayaran</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-bordered table-sm table-hover" id="" width="100%" cellspacing="0">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th>Pembayaran</th>
                                            <th>Akun</th>
                                            <th>Metode</th>
                                            <th>Tagihan</th>
                                            <th>Bayar</th>
                                            <th>Diskon</th>
                                            <th>Jumlah Bayar</th>
                                        </tr>
                                    </thead>
                                    <tbody id="rincianBayar">
                                    </tbody>
                                    <tfoot class="bg-secondary text-white">
                                        <tr>
                                            <th colspan="6">GRAND TOTAL</th>
                                            <th class="totalBayar">Jumlah Bayar</th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th colspan="6" class="terbilang text-italic">Jumlah Bayar</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>

                <script>
                    $('.cari').click(function(e) {
                        e.preventDefault()
                        var hari = $('.hari').val()
                        var bln = $('.bulan').val()
                        var thn = $('.tahun').val()
                        getPem(bln, thn)
                    })

                    var hari = $('.hari').val()
                    var bln = $('.bulan').val()
                    var thn = $('.tahun').val()
                    getPem(bln, thn, hari)

                    function getPem(bln, thn, hari) {
                        var dataAcc = $('#dataAcc').DataTable({
                            'ajax': {
                                "type": "POST",
                                "url": '<?= base_url('pembayaran/getPembayaran/') ?>' + bln + '/' + thn + '/' + hari,
                                "dataSrc": ""
                            },
                            'destroy': true,
                            'columns': [{
                                    "data": "no"
                                },
                                {
                                    "data": "tgl"
                                },
                                {
                                    "data": "inv"
                                },
                                {
                                    "data": "siswa"
                                },
                                {
                                    "data": "kelas"
                                },
                                {
                                    "data": "ta"
                                },
                                {
                                    "data": "jumlah"
                                },
                                {
                                    "data": "jumlah",
                                    "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                                        $(nTd).html("<a data-toggle='modal' class='mr-1 more btn btn-info btn-sm' href='#more' data-id=" + oData.inv + "><i class='fa fa-search'></i></a><a target='_blank' class='mr-1 btn btn-success btn-sm' href='<?= base_url('cetak/invoice/') ?>" + oData.inv + "'><i class='fa fa-print'></i></a>");
                                    },
                                    "className": 'details-control',
                                    "orderable": false,
                                    "data": null,
                                    "defaultContent": ''
                                },
                            ]
                        });


                    }

                    $(document).on('click', '.more', function() {
                        var inv = $(this).data('id')
                        $('.terima').attr('data-id', inv)
                        $.ajax({
                            url: '<?= base_url('acc/getMore/') ?>',
                            type: 'post',
                            dataType: 'json',
                            data: {
                                'inv': inv
                            },
                            success: function(res) {
                                console.log(res)
                                var html = '<tr>'
                                $.each(res, function(i, v) {
                                    html += '<td>' + v.jns + '</td>' +
                                        '<td>' + v.akun + '</td>' +
                                        '<td>' + v.metode + '</td>' +
                                        '<td>' + v.tagihan + '</td>' +
                                        '<td>' + v.bayar + '</td>' +
                                        '<td>' + v.diskon + '</td>' +
                                        '<td>' + v.jml + '</td></tr>'
                                })
                                $('#rincianBayar').html(html)
                                $('.totalBayar').html(res[0].total)
                                $('.terbilang').html(res[0].terbilang)
                            }
                        })
                    })

                  
                </script>