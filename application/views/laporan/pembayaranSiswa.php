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
                                            <a href="<?= base_url('pembayaran/export/') ?>" data-id="excel" class="excel btn btn-primary btn-block btn-sm">Export Excel</a>
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
                                                    <th>Jumlah</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </duv>
                    </div>


                </div>
                <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->
                <div class="modal fade" id="detail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="table-responsive">
                                    <form action="<?= base_url('pembayaran/inputData') ?>" class="inputData" method="POST">
                                        <table class="table table-bordered table-sm" width="100%" cellspacing="0">
                                            <thead class="bg-primary text-white">
                                                <tr>
                                                    <th>No</th>
                                                    <th>TH. Ajaran</th>
                                                    <th>Pembayaran</th>
                                                    <th>Jml. TAgihan</th>
                                                    <th>Metode</th>
                                                    <th>Jumlah Bayar</th>
                                                    <th>Diskon</th>
                                                    <th>Total Bayar</th>
                                                </tr>
                                            </thead>

                                            <tbody id="table-bayar">

                                            </tbody>

                                        </table>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    $('.cari').click(function(e) {
                        e.preventDefault()
                        var start = $('.start').val()
                        var end = $('.end').val()
                        $('.excel').attr('href', '<?= base_url('pembayaran/export/') ?>' + start + '/' + end)
                        getPembayaranSiswa(start, end)
                    })

                    var start = $('.start').val()
                    var end = $('.end').val()
                    getPembayaranSiswa(start, end)

                    function getPembayaranSiswa(start, end) {
                        var dataAcc = $('#dataAcc').DataTable({
                            'ajax': {
                                "type": "POST",
                                "url": '<?= base_url('pembayaran/getPembayaran/') ?>' + start + '/' + end,
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
                                    "data": "jumlah"
                                },
                                {
                                    "data": "jumlah",
                                    "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                                        $(nTd).html("<a data-toggle='modal' class='mr-1 detail btn btn-info btn-border-circle btn-sm' href='#detail' data-id=" + oData.inv + ">Detail</a><a class='hapus mr-1 btn btn-border-circle btn-danger btn-sm' href='#'" + oData.inv + "' data-id=" + oData.inv + ">Hapus</a>");
                                    },
                                    "className": 'details-control',
                                    "orderable": false,
                                    "data": null,
                                    "defaultContent": ''
                                },
                            ]
                        });


                    }

                    $(document).on('click', '.detail', function() {
                        var inv = $(this).data('id')
                        $('.terima').attr('data-id', inv)
                        $.ajax({
                            url: '<?= base_url('acc/getInv/') ?>',
                            type: 'post',
                            dataType: 'json',
                            data: {
                                'inv': inv
                            },
                            success: function(res) {
                                console.log(res)

                                $('.aksi').attr('data-id', res[0].inv)
                                var bayar = ''

                                $.each(res, function(i, v) {
                                    bayar += `<tr><td>` + v.no + `</td>'+                                    
                                    '<td>` + v.ta + `</td>'+
                                    '<td>` + v.akun + `</td>'+
                                    '<td>` + v.tagihan + `</td>'+
                                    '<td>` + v.metode + `</td>'+
                                    '<td>` + v.nilai + `</td>'+
                                    '<td>` + v.diskon + `</td>'+
                                    '<td>` + v.total + `</td></tr>`
                                })

                                $('#table-bayar').html(bayar)
                            }
                        })
                    })

                    $('.terima').click(function(e) {
                        e.preventDefault()
                        var inv = $(this).data('id')
                        var link = 1
                        accept(inv, link)
                    })
                </script>