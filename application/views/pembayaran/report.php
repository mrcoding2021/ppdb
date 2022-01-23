                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="row">
                        <duv class="col-md-12">
                            <?php $this->load->view('admin/breadcrumb'); ?>
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 bg-dark ">
                                    <h3 class="m-0 text-white font-weight-bold ">
                                        <?= $title; ?> <a href="#tanda" class="btn btn-success btn-border-circle float-right" data-toggle="modal"><i class="fa fa-print"></i> Cetak Tanda Terima</a>
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <ul class="nav nav-pills mb-3 nav-justified border-bottom-primary" id="pills-tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Pembayaran Siswa</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="pills-all-tab" data-toggle="pill" href="#all" role="tab" aria-controls="pills-all" aria-selected="true">Semua Siswa</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="pills-persiswa-tab" data-toggle="pill" href="#persiswax" role="tab" aria-controls="pills-persiswa" aria-selected="true">Per-Siswa</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="pills-spp-tab" data-toggle="pill" href="#spp" role="tab" aria-controls="pills-spp" aria-selected="true">Pembayaran SPP</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="pills-sppx-tab" data-toggle="pill" href="#sppx" role="tab" aria-controls="pills-sppx" aria-selected="true">Pembayaran Selain SPP</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade" id="all" role="tabpanel" aria-labelledby="pills-all-tab">
                                            <?php $this->load->view('pembayaran/allSiswa'); ?>
                                        </div>
                                        <div class="tab-pane fade" id="spp" role="tabpanel" aria-labelledby="pills-spp-tab">
                                            <?php $this->load->view('pembayaran/spp'); ?>
                                        </div>
                                        <div class="tab-pane fade" id="sppx" role="tabpanel" aria-labelledby="pills-sppz-tab">
                                            <?php $this->load->view('pembayaran/sppx'); ?>
                                        </div>
                                        <div class="tab-pane fade" id="persiswax" role="tabpanel" aria-labelledby="pills-home-tab">
                                            <?php $this->load->view('pembayaran/perSiswa'); ?>
                                        </div>
                                        <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                            <?php $this->load->view('pembayaran/bayar'); ?>
                                        </div>
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

                <div class="modal fade" id="tanda" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-success text-white">
                                <h5 class="modal-title" id="exampleModalLabel">Cetak Tanda Terima</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body row">
                                <div class="col-lg-4 col-sm-4 mb-3">
                                    <label for="1" class="col-form-label">Dari Tanggal</label>
                                    <input type="date" class="start form-control" name="dari" value="<?= date('Y-m') . '-01' ?>">
                                </div>
                                <div class="col-lg-4 col-sm-4 mb-3">
                                    <label for="1" class="col-form-label">Sampai Tanggal</label>
                                    <input type="date" class="end form-control" name="ke" value="<?= date('Y-m-d') ?>">
                                </div>
                                <div class="col-lg-4 col-sm-4">
                                    <label for="1" class="col-form-label d-block">.</label>
                                    <a href="#" class="find btn btn-success px-5"><i class="fa fa-search"></i> Cari</a>
                                </div>
                                <table class="table table-bordered table-sm table-hover" width="100%" cellspacing="0">
                                    <thead class="bg-primary text-white text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Jns.Pembayaran</th>
                                            <th>Tunai/Rp</th>
                                            <th>Tabungan</th>
                                            <th>Jumlah Setoran</th>
                                            <th>Diskon</th>
                                            <th>Jumlah Bayar</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tandaTerima" class="text-right">
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
                    $('.find').click(function(e) {
                        e.preventDefault()
                        var start = $('.dari').val()
                        var end = $('.ke').val()
                        $.ajax({
                            url: '<?= base_url('acc/tandaTerima/') ?>',
                            type: 'post',
                            dataType: 'json',
                            data: {
                                'inv': start,
                                'end': end
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

                    $(document).on('click', '.delete', function(e) {
                        var id = $(this).data('id')
                        var id_trx = $('#inv').text()
                        var id_murid = $('.id_murid').val()
                        e.preventDefault()
                        Swal.fire({
                            title: "Yakin ingin dihapus?",
                            text: "Data transaksi ini akan terhapus permanen",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Yes, hapus!",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: '<?= base_url('acc/delete') ?>',
                                    data: {
                                        'id': id
                                    },
                                    dataType: 'json',
                                    type: 'POST',
                                    beforeSend: function() {
                                        Swal.fire({
                                            html: '<div class="p-5"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>',
                                            showConfirmButton: false
                                        })
                                    },
                                    success: function(res) {
                                        if (res.sukses) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Berhasil',
                                                html: `${res.sukses}`
                                            })
                                            var start = $('.start').val()
                                            var end = $('.end').val()
                                            getPem(start, end)

                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Gagal !',
                                                html: `${res.error}`
                                            })
                                        }

                                    }
                                })
                            }
                        });
                    })
                </script>