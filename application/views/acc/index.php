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
                                                <?php $a = 16; for ($i = 0; $i < 10; $i++) { ?>
                                                    <option <?= (date('Y') == '20' . $a) ? 'selected' : '' ?> value="<?= '20' . $a ?>"><?= '20' . $a ?></option>
                                                <?php $a++;} ?>
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
                                                    <th>Kategori</th>
                                                    <th>Nama</th>
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
                <!-- End of Main Content -->
                <div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-success text-white">
                                <h5 class="modal-title" id="exampleModalLabel">Input <?= $title ?></h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" class="addPengeluaran" action="<?= base_url('acc/accept') ?>">
                                    <div class="row form-group">
                                        <div class="col-sm-6">
                                            <label>No. Invoice</label>
                                            <input type="text" readonly class="form-control id_trx" name="id_trx">
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Tanggal Trx.</label>
                                            <input type="date" value="<?= date('Y-m-d') ?>" class="form-control date" name="date">
                                            <input type="hidden" class="form-control id" name="id">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sm-6">
                                            <label>Dikeluarkan untuk</label>
                                            <select name="akun_trx" class="form-control selectpicker" data-live-search="true">
                                                <?php foreach ($akun as $a) { ?>
                                                    <option value="<?= $a->kode_akun ?>"><?= $a->nama ?></option>
                                                    <?php $this->db->where('parent', $a->kode_akun);
                                                    $ak = $this->db->get('tb_rab')->result();
                                                    foreach ($ak as $k) { ?>
                                                        <option value="<?= $k->kode_akun ?>">--> <?= $k->nama ?></option>
                                                    <?php  } ?>
                                                <?php  } ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Dari Kas</label>
                                            <select name="akun_kas" class="form-control akun_kas">
                                                <?php foreach ($kas as $key) { ?>
                                                    <option value="<?= $key->kode_akun ?>"><?= $key->nama ?></option>
                                                <?php  } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <label>Metode</label>
                                            <select name="metode" class="form-control metode">
                                                <?php foreach ($metode as $key) { ?>
                                                    <option value="<?= $key->id_sumber ?>"><?= $key->nama ?></option>
                                                <?php  } ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="1">Tahun Ajaran</label>
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
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <label>Jenis Transaksi</label>
                                            <select name="kategori" class="form-control kategori">
                                                <option>Pilih Transaksi</option>
                                                <option value="1">Pemasukan</option>
                                                <option value="0">Pengeluaran</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Nilai</label>
                                            <input type="text" class="form-control nilai" name="nilai">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label>Keterangan</label>
                                            <textarea type="text" class="form-control ket" name="ket"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="pt-1 btn btn-block btn-border-circle btn-secondary" type="button" style="position: relative; top: 4px; height:38px" data-dismiss="modal">Close</button>
                                        <a href="#" class="terima btn btn-success btn-border-circle btn-block">Terima</a>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
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
                                            <th colspan="5">GRAND TOTAL</th>
                                            <th class="totalBayar">Jumlah Bayar</th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th colspan="5" class="terbilang text-italic">Jumlah Bayar</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="modal-footer">
                                    <button class="pt-1 btn btn-block btn-border-circle btn-secondary" type="button" style="position: relative; top: 4px; height:38px" data-dismiss="modal">Close</button>
                                    <a href="#" class="terima btn btn-success btn-border-circle btn-block">Terima</a>
                                </div>
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
                                "url": '<?= base_url('acc/getAcc/') ?>' + bln + '/' + thn,
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
                                    "data": "kategori"
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
                                $('.id_trx').val(res.id_trx)
                                $('.nama').val(res.nama)
                                $('.id').val(res.id)
                                $('.id_murid').val(res.id_murid)
                                $('.date').val(res.date)
                                $('.nilai').val(res.jumlah)
                                $('.ket').text(res.ket)
                                $('.metode option[value="' + res.metode + '"]').attr('selected', true)
                                $('.metode option[value="' + res.metode + '"]').siblings().attr('selected', false)
                                $('.ta option[value="' + res.ta + '"]').attr('selected', true)
                                $('.ta option[value="' + res.ta + '"]').siblings().attr('selected', false)
                                $('.selectpicker option[value="' + res.akun_trx + '"]').attr('selected', true)
                                $('.selectpicker option[value="' + res.akun_trx + '"]').siblings().attr('selected', false)
                                $('.akun_kas option[value="' + res.akun_kas + '"]').attr('selected', true)
                                $('.akun_kas option[value="' + res.akun_kas + '"]').siblings().attr('selected', false)
                                $('.kategori option[value="' + res.kategori + '"]').attr('selected', true)
                                $('.kategori option[value="' + res.kategori + '"]').siblings().attr('selected', false)
                                $('.selectpicker').selectpicker('val', res.akun_trx);
                            }
                        })
                    })

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

                    $('.terima').click(function(e) {
                        e.preventDefault()
                        var inv = $(this).data('id')
                        console.log(inv)
                        accept(inv)
                    })

                    function accept(inv) {
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
                                    url: '<?= base_url('acc/accept/') ?>',
                                    data: {
                                        'inv': inv,
                                    },
                                    dataType: 'json',
                                    type: 'POST',
                                    success: function(response) {
                                        if (response.success) {
                                            $('.modal').modal('hide')
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Berhasil',
                                                html: `${response.success}`
                                            })
                                            var bln = $('.bulan').val()
                                            var thn = $('.tahun').val()
                                            getAcc(bln, thn)
                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Error',
                                                html: `${response.error}`
                                            })
                                        }

                                    }
                                })
                            }
                        });
                    }
                </script>