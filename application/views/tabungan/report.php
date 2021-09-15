                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="row">

                        <duv class="col-md-12">
                            <?php $this->load->view('admin/breadcrumb'); ?>
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 bg-dark ">
                                    <h3 class="m-0 text-white font-weight-bold ">
                                        <?= $title; ?>
                                        <a href="#" class="btn btn-success export btn-border-circle float-right"><i class="fas fa-file-excel"></i> Export Excel</a>
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <ul class="nav nav-pills nav-justified border-bottom-primary" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">RINGKASAN</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">FILTER</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content mt-3" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <table class="table table-hover table-sm">
                                                        <thead class="bg-dark text-white">
                                                            <tr>
                                                                <th>Deskripsi</th>
                                                                <th>Nilai</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <th scope="col">Saldo Keseluruhan</th>
                                                                <td scope="col"><?= rupiah($saldoAll)?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="col">Saldo Tahun Ini</th>
                                                                <td scope="col"><?= rupiah($saldoTahunIni)?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="col">Saldo Bulan ini</th>
                                                                <td scope="col"><?= rupiah($saldoBulanIni)?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="col">Saldo Hari ini</th>
                                                                <td scope="col"><?= rupiah($saldoHariIni)?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-md-7">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                            <div class="mb-3 row">
                                                <div class="col-lg-2 col-sm-4">
                                                    <label for="1" class="col-form-label">Tanggal</label>
                                                    <select class="form-control form-control-sm hari" name="hari">
                                                        <option value="0">Semua</option>
                                                        <?php for ($i = 1; $i <= 31; $i++) { ?>
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
                                                <table class="table table-bordered" id="dataTabungan" width="100%" cellspacing="0">
                                                    <thead class="bg-dark text-white">
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Tanggal</th>
                                                            <th>Nama Siswa</th>
                                                            <th>HP</th>
                                                            <th>Debit</th>
                                                            <th>Kredit</th>
                                                            <th>Saldo</th>
                                                            <!-- <th>Aksi</th> -->
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </duv>
                    </div>


                </div>
                <!-- /.container-fluid -->

                </div>


                <script>
                    var hari = $('.hari').val()
                    var bln = $('.bulan').val()
                    var thn = $('.tahun').val()
                    getTabungan(bln, thn, hari)

                    $('.cari').click(function(e) {
                        e.preventDefault()
                        var hari = $('.hari').val()
                        var bln = $('.bulan').val()
                        var thn = $('.tahun').val()
                        getTabungan(bln, thn, hari)
                    })


                    function getTabungan(bln, thn, hari) {
                        var dataTabungan = $('#dataTabungan').DataTable({
                            'ajax': {
                                "type": "POST",
                                "url": '<?= base_url('tabungan/getAll/') ?>' + bln + '/' + thn + '/' + hari,
                                "dataSrc": ""
                            },
                            'pageLength': 100,
                            'destroy': true,
                            'columns': [{
                                    "data": "no"
                                },
                                {
                                    "data": "date"
                                },
                                {
                                    "data": "nama"
                                },
                                {
                                    "data": "hp"
                                },
                                {
                                    "data": "debit"
                                },
                                {
                                    "data": "kredit"
                                },
                                {
                                    "data": "saldo"
                                },
                                // {
                                //     "data": "saldo",
                                //     "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                                //         $(nTd).html("<a data-toggle='modal' class='mr-1 detail btn btn-info btn-border-circle btn-sm' href='#detail' data-id=" + oData.id + ">Detail</a><a class='hapus mr-1 btn btn-border-circle btn-danger btn-sm' href='#' data-id=" + oData.id + ">Hapus</a>");
                                //     },
                                //     "className": 'details-control',
                                //     "orderable": false,
                                //     "data": null,
                                //     "defaultContent": ''
                                // },
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

                                $('.aksi').attr('data-id', inv)
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