                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><?= $parent ?></li>
                            <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
                        </ol>
                    </nav>

                    <div class="row">
                        <duv class="col-md-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 bg-dark ">
                                    <h3 class="m-0 text-white font-weight-bold "><?= $title ?>
                                        <a href="#tambah" class="btn input-ajaran-baru btn-success btn-border-circle float-right" data-toggle="modal">Input Baru</a>
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="card mb-4">
                                        <!-- Card Header - Accordion -->
                                        <a href="#pemasukan" class="d-block card-header bg-success py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="pemasukan">
                                            <h6 class="m-0 font-weight-bold text-white">Pemasukan</h6>
                                        </a>
                                        <!-- Card Content - Collapse -->
                                        <div class="collapse show" id="pemasukan">
                                            <div class="card-body">
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <label>Tahun Ajaran</label>
                                                        <select name="thn-ajaran" class="thun-ajaran form-control">
                                                            <?php foreach ($thn_ajaran as $key) : ?>
                                                                <option <?= (substr($key->ta, 5) == date('Y')) ? 'selected' : '' ?> value="<?= $key->id_ajaran ?>"><?= $key->ta ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label>RABPS Pemasukan KAS</label>
                                                        <input type="text" name="total_pemasukan" class="form-control" readonly value="">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label>Aktual Pemasukan KAS</label>
                                                        <input type="text" name="aktual_pemasukan" class="form-control" readonly value="">
                                                    </div>
                                                </div>
                                                <table class="table table-hover table-bordered" id="tablePemasukan">
                                                    <thead class="bg-dark text-white text-center">
                                                        <tr>
                                                            <th scope="col" rowspan="2">#</th>
                                                            <th scope="col" rowspan="2">Uraian</th>
                                                            <th scope="col" class="text-center" colspan="3">Perhitungan</th>
                                                            <th scope="col" colspan="2">Total</th>
                                                            <th scope="col" rowspan="2">Detail</th>
                                                        </tr>
                                                        <tr>
                                                            <td>Jml. Siswa</td>
                                                            <td>QTY</td>
                                                            <td scope="row">Hrg. Satuan</td>
                                                            <td>Rencana</td>
                                                            <td>Aktual</td>

                                                        </tr>
                                                    </thead>
                                                    <tbody>


                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mb-4">
                                        <!-- Card Header - Accordion -->
                                        <a href="#pengelauran" class="d-block card-header bg-danger py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="pengelauran">
                                            <h6 class="m-0 font-weight-bold text-white">Pengeluaran</h6>
                                        </a>
                                        <!-- Card Content - Collapse -->
                                        <div class="collapse" id="pengelauran">
                                            <div class="card-body">
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <label>Tahun Ajaran</label>
                                                        <select name="thn-ajaran" class="thn-ajaran form-control">
                                                            <?php foreach ($thn_ajaran as $key) : ?>
                                                                <option <?= (substr($key->ta, 5) == date('Y')) ? 'selected' : '' ?> value="<?= $key->id_ajaran ?>"><?= $key->ta ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label>RABPS Pengeluaran KAS</label>
                                                        <input type="text" name="total_pengeluaran" class="form-control" readonly value="">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label>Aktual RABPS Pengeluaran</label>
                                                        <input type="text" name="aktual_pengeluaran" class="form-control" readonly value="">
                                                    </div>
                                                </div>
                                                <table class="table table-hover table-bordered" id="tablePengeluaran" width="100%">
                                                    <thead class="bg-dark text-white text-center">
                                                        <tr>
                                                            <th scope="col" rowspan="2">#</th>
                                                            <th scope="col" rowspan="2">Uraian</th>
                                                            <th scope="col" class="text-center" colspan="3">Perhitungan</th>
                                                            <th scope="col" colspan="2">Total</th>
                                                            <th scope="col" rowspan="2">Detail</th>
                                                        </tr>
                                                        <tr>
                                                            <td>Jml. Siswa</td>
                                                            <td>QTY</td>
                                                            <td scope="row">Hrg. Satuan</td>
                                                            <td>Rencana</td>
                                                            <td>Aktual</td>

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
                <!-- End of Main Content -->


                <style>
                    td.details-control {
                        background: url('https://freeiconshop.com/wp-content/uploads/edd/plus-flat.png') no-repeat center center;
                        cursor: pointer;
                        background-size: 30px 30px;
                    }

                    tr.shown td.details-control {
                        background: url('https://freeiconshop.com/wp-content/uploads/edd/minus-flat.png') no-repeat center center;
                        background-size: 30px 30px;
                    }
                </style>
                <script>
                    $(document).ready(function() {
                        pemasukan(13)

                        function format(d) {

                            if (d == undefined) {
                                var html = 'Tidak Ada Data'
                            } else {
                                var html = '<table class="table table-sm"><thead ><th>#</th><th>Uraian </th><th>Jml. Siswa </th><th>QTY </th><th>Hrg. Satuan </th><th> Rencana </th><th>Aktual</th></thead>'
                                $.each(d.detail, function(i, v) {
                                    html += '<tr>' +
                                        '<td>' + v.n + '</td>' +
                                        '<td>' + v.nama + '</td>' +
                                        '<td>' + v.jml_siswa + '</td>' +
                                        '<td>' + v.qty + '</td>' +
                                        '<td>' + v.hrg_satuan + '</td>' +
                                        '<td>' + v.jumlah + '</td>' +
                                        '<td>' + v.aktual + '</td>' +
                                        '</tr>'
                                })
                                html += '</table>'
                            }
                            return html

                        }

                        function pemasukan(ta) {
                            $.ajax({
                                url: '<?= base_url('rabps/total/1/') ?>' + ta,
                                dataType: 'json',
                                type: 'post',
                                success: function(res) {
                                    console.log(res)
                                    $('input[name="total_pemasukan"]').val(res.total)
                                    $('input[name="aktual_pemasukan"]').val(res.masuk)
                                }
                            })
                            var pemasukan = $('#tablePemasukan').DataTable({
                                'ajax': {
                                    "type": "POST",
                                    "url": '<?= base_url('rabps/pemasukan/') ?>' + ta,
                                    "dataSrc": ""
                                },
                                "destroy": true,
                                'columns': [{
                                        "data": "no"
                                    },
                                    {
                                        "data": "nama"
                                    },
                                    {
                                        "data": "jml_siswa"
                                    },
                                    {
                                        "data": "qty"
                                    },
                                    {
                                        "data": "hrg_satuan"
                                    },
                                    {
                                        "data": "jumlah"
                                    },
                                    {
                                        "data": "aktual"
                                    },
                                    {
                                        "className": 'details-control',
                                        "orderable": false,
                                        "data": null,
                                        "defaultContent": ''
                                    },
                                ]
                            });

                            $(document).on('click', '.details-control', function(e) {

                                var tr = $(this).closest('tr');
                                var row = pemasukan.row(tr);

                                if (row.child.isShown()) {
                                    // This row is already open - close it
                                    row.child.hide();
                                    tr.removeClass('shown');
                                } else {
                                    // Open this row
                                    row.child(format(row.data())).show();
                                    tr.addClass('shown');
                                }
                            });
                        }
                        $('.thun-ajaran').change(function() {
                            $(".thun-ajaran option:selected").each(function() {
                                var ta = $(this).val()
                                pemasukan(ta)
                            });
                        })

                        pengeluaran(15)

                        function forma(d) {

                            if (d == undefined) {
                                var html = 'Tidak Ada Data'
                            } else {
                                var html = '<table class="table table-sm"><thead ><th>#</th><th>Uraian </th><th>Jml. Siswa </th><th>QTY </th><th>Hrg. Satuan </th><th> Rencana </th><th>Aktual</th></thead>'
                                $.each(d.detail, function(i, v) {
                                    html += '<tr>' +
                                        '<td>' + v.n + '</td>' +
                                        '<td>' + v.nama + '</td>' +
                                        '<td>' + v.jml_siswa + '</td>' +
                                        '<td>' + v.qty + '</td>' +
                                        '<td>' + v.hrg_satuan + '</td>' +
                                        '<td>' + v.jumlah + '</td>' +
                                        '<td>' + v.aktual + '</td>' +
                                        '</tr>'
                                })
                                html += '</table>'
                            }
                            return html

                        }

                        function pengeluaran(ta) {
                            $.ajax({
                                url: '<?= base_url('rabps/total/2/') ?>' + ta,
                                data: {
                                    'id': ta
                                },
                                dataType: 'json',
                                type: 'post',
                                success: function(res) {
                                    $('input[name="total_pengeluaran"]').val(res.total)
                                    $('input[name="aktual_pengeluaran"]').val(res.masuk)
                                }
                            })
                            var pengeluaran = $('#tablePengeluaran').DataTable({
                                'ajax': {
                                    "type": "POST",
                                    "url": '<?= base_url('rabps/pengeluaran/') ?>' + ta,
                                    "dataSrc": ""
                                },
                                "destroy": true,
                                'columns': [{
                                        "data": "no"
                                    },
                                    {
                                        "data": "nama"
                                    },
                                    {
                                        "data": "jml_siswa"
                                    },
                                    {
                                        "data": "qty"
                                    },
                                    {
                                        "data": "hrg_satuan"
                                    },
                                    {
                                        "data": "jumlah"
                                    },
                                    {
                                        "data": "aktual"
                                    },
                                    {
                                        "className": 'details-control',
                                        "orderable": false,
                                        "data": null,
                                        "defaultContent": ''
                                    },
                                ]
                            });

                            $(document).on('click', '.details-control', function(e) {

                                var tr = $(this).closest('tr');
                                var row = pengeluaran.row(tr);

                                if (row.child.isShown()) {
                                    // This row is already open - close it
                                    row.child.hide();
                                    tr.removeClass('shown');
                                } else {
                                    // Open this row
                                    row.child(forma(row.data())).show();
                                    tr.addClass('shown');
                                }
                            });
                        }
                        $('.thn-ajaran').change(function() {
                            $(".thn-ajaran option:selected").each(function() {
                                var ta = $(this).val()

                                pengeluaran(ta)
                            });
                        })
                    })
                </script>