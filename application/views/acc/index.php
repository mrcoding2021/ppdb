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
                                                    <th>Jumlah</th>
                                                    <th>Status</th>
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
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title " id="exampleModalLabel">Detail Pengajuan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive">
                                    <form action="<?= base_url('pembayaran/inputData') ?>" class="inputData" method="POST">
                                        <table class="table table-bordered table-sm" width="100%" cellspacing="0">
                                            <thead class="bg-primary text-white">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tanggal Trx.</th>
                                                    <th>TH. Ajaran</th>
                                                    <th>Pembayaran</th>
                                                    <th width="15%">Keterangan</th>
                                                    <th>Nilai</th>
                                                    <th>Diskon</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>

                                            <tbody id="table-bayar">

                                            </tbody>

                                        </table>
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button data-dismiss="modal" class="pt-1 btn btn-block btn-border-circle btn-secondary" type="button" style="position: relative; top: 4px; height:38px">Close</button>
                                <button class="btn btn-success aksi terima btn-border-circle btn-block">Terima</button>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    $('.cari').click(function(e) {
                        e.preventDefault()
                        var bln = $('.bulan').val()
                        var thn = $('.tahun').val()
                        getAcc(bln, thn)
                    })

                    var bln = $('.bulan').val()
                    var thn = $('.tahun').val()
                    getAcc(bln, thn)

                    function getAcc(bln, thn) {
                        var dataAcc = $('#dataAcc').DataTable({
                            'ajax': {
                                "type": "POST",
                                "url": '<?= base_url('acc/getBy/') ?>' + bln + '/' + thn,
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
                                    "data": "status"
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
                        console.log(inv)
                        $.ajax({
                            url: '<?= base_url('acc/getInv/1') ?>',
                            type: 'post',
                            dataType: 'json',
                            data: {
                                'inv': inv
                            },
                            success: function(res) {
                                $('.aksi').attr('data-id', res[0].inv)
                                var bayar = ''

                                $.each(res, function(i, v) {
                                    bayar += `<tr><td>` + v.no + `</td><td>` + v.tgl + `</td><td>` + v.ta + `</td><td>` + v.akun +
                                        ` - ` + v.akun_trx + `</td><td>` + v.ket + `</td><td>` + v.nilai + `</td><td>` + v.diskon + `</td><td>` + v.total + `</td></tr>`
                                })

                                $('#table-bayar').html(bayar)
                                $('select[name="ta"] option[value="' + res[0].ta + '"]').attr('selected', true)
                            }
                        })
                    })

                    $('.terima').click(function(e) {
                        e.preventDefault()
                        var inv = $(this).data('id')
                        var link = 1
                        accept(inv, link)
                    })

                    function accept(inv, link) {

                        Swal.fire({
                            title: "Yakin ?",
                            text: "Pastikan data sudah benar dan sesuai",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Yes !",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: '<?= base_url('acc/accept/') ?>' + inv + '/' + link,
                                    data: {
                                        'inv': inv
                                    },
                                    dataType: 'json',
                                    type: 'POST',
                                    success: function(response) {
                                        if (response.sukses) {
                                            $('.modal').modal('hide')
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Berasil',
                                                html: `${response.sukses}`
                                            })
                                            getAcc()
                                        }

                                    }
                                })
                            }
                        });
                    }
                </script>