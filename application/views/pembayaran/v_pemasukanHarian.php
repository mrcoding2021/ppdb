                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <?php $this->load->view('admin/breadcrumb'); ?>


                    <div class="row">
                        <duv class="col-md-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 bg-dark ">
                                    <h3 class="m-0 text-white font-weight-bold "><?= $title ?>
                                        <a href="#tambah" class="btn input-ajaran-baru btn-success btn-border-circle float-right" data-toggle="modal">Input Baru</a>
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
                                            <a href="<?= base_url('sispem/pemasukan') ?>" data-id="excel" class="excel btn btn-primary btn-block btn-sm">Export Excel</a>
                                        </div>
                                        <!-- <div class="col-lg-2 col-sm-4">
                                                    <label for="1" class="col-form-label">.</label>
                                                    <a href="<?= base_url('tabungan/excel') ?>" data-id="pdf" class="pdf btn btn-info btn-block btn-sm">Export PDF</a>
                                                </div> -->
                                    </div>
                                    <div class="table-responsive">
                                        <form action="<?= base_url('pembayaran/inputData') ?>" class="inputData" method="POST">
                                            <table class="table table-bordered" width="100%" cellspacing="0" id="table-pemasukanHarian">
                                                <thead class="text-center">
                                                    <tr valign="middle">
                                                        <th rowspan="2">No</th>
                                                        <th rowspan="2" valign="middle">Hari, Tanggal</th>
                                                        <th colspan="7">Nilai Pemasukan</th>
                                                        <th valign="middle" rowspan="2">TOTAL</th>
                                                    </tr>
                                                    <tr>
                                                        <th>SPP</th>
                                                        <th>INFAQ GEDUNG</th>
                                                        <th>KEGIATAN</th>
                                                        <th>SERAGAM</th>
                                                        <th>KOMITE</th>
                                                        <th>BUKU</th>
                                                        <th>EKSKUL</th>

                                                    </tr>



                                                </thead>





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
                <!-- End of Main Content -->

                <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-success text-white">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Item</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('setting/add') ?>" method="post" class="input-ajaran">
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <label>Tahun Ajaran</label>
                                            <input type="text" class="form-control" name="tahun_ajaran">
                                        </div>
                                        <div class="col-sm-4">
                                            <label>SPP</label>
                                            <input type="text" class="form-control" name="spp">
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Infaq Gedung</label>
                                            <input type="text" class="form-control" name="infaq_gedung">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <label>Kegiatan</label>
                                            <input type="text" class="form-control" name="kegiatan">
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Seragam</label>
                                            <input type="text" class="form-control" name="seragam">
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Komite</label>
                                            <input type="text" class="form-control" name="komite">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <label>Buku</label>
                                            <input type="text" class="form-control" name="buku">
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Ekskul</label>
                                            <input type="text" class="form-control" name="ekskul">
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button id="close" class="pt-1 btn btn-block btn-border-circle btn-secondary" type="button" style="position: relative; top: 4px; height:38px" data-dismiss="modal">Close</button>
                                        <button class="btn btn-success  btn-border-circle btn-block edit" type="submit">Input</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

                <script>
                    $(document).ready(function() {
                        dataPemasukanHarian()

                        function dataPemasukanHarian() {

                            var pembiayaan = $('#table-pemasukanHarian').DataTable({
                                'ajax': {
                                    "type": "POST",
                                    "url": '<?= base_url('sispem/get_All/0') ?>',
                                    "dataSrc": ""
                                },
                                "destroy": true,
                                'columns': [{
                                        "data": "no"
                                    },
                                    {
                                        "data": "created_at"
                                    },
                                    {
                                        "data": "spp"
                                    },
                                    {
                                        "data": "infaq_gedung"
                                    },
                                    {
                                        "data": "kegiatan"
                                    },
                                    {
                                        "data": "seragam"
                                    },
                                    {
                                        "data": "komite"
                                    },
                                    {
                                        "data": "buku"
                                    },
                                    {
                                        "data": "ekskul"
                                    },
                                    {
                                        "data": "total"
                                    },
                                    // {
                                    //     "data": "buku",
                                    //     "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                                    //         $(nTd).html("<a class='mr-1 detail btn btn-info btn-border-circle btn-sm' href='#lihat' data-id=" + oData.id_pembayaran + " >Detail</a>");
                                    //     }
                                    // }
                                ]
                            });
                        }
                        $(document).on('click', '.detail', function(e) {
                            var id = $(this).data('id')
                            $('.modal-title').text('Detail')
                            $('.edit').text('Edit')
                            $.ajax({
                                url: '<?= base_url('setting/getAll/') ?>' + id,
                                type: 'POST',
                                dataType: 'JSON',
                                success: function(data) {
                                    $('#tambah').modal('show')
                                    $('input[name="tahun_ajaran"]').val(data.tahun_ajaran)
                                    $('input[name="spp"]').val(data.spp)
                                    $('input[name="infaq_gedung"]').val(data.infaq_gedung)
                                    $('input[name="kegiatan"]').val(data.kegiatan)
                                    $('input[name="seragam"]').val(data.seragam)
                                    $('input[name="komite"]').val(data.komite)
                                    $('input[name="buku"]').val(data.buku)
                                    $('input[name="ekskul"]').val(data.ekskul)
                                }
                            })
                        })
                        $('.input-ajaran-baru').on('click', function(e) {
                            $('.modal-title').text('Tambah Ajaran Baru')
                            $('.edit').text('Simpan')
                            $('input[name="tahun_ajaran"]').val('')
                            $('input[name="spp"]').val('')
                            $('input[name="infaq_gedung"]').val('')
                            $('input[name="kegiatan"]').val('')
                            $('input[name="seragam"]').val('')
                            $('input[name="komite"]').val('')
                            $('input[name="buku"]').val('')
                            $('input[name="ekskul"]').val('')
                        })

                        // input ajaran 
                        $('.input-ajaran').on('submit', function(e) {
                            e.preventDefault()
                            Swal.fire({
                                title: "Yakin ingin disimpan?",
                                text: "Pastikan data sudah benar dan sesuai",
                                icon: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#3085d6",
                                cancelButtonColor: "#d33",
                                confirmButtonText: "Yes, simpan sekarang!",
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $.ajax({
                                        url: $(this).attr('action'),
                                        data: $(this).serialize(),
                                        dataType: 'json',
                                        type: 'POST',
                                        beforeSend: function() {
                                            $('.bg').show()
                                        },
                                        complete: function() {
                                            $('.bg').hide()
                                        },
                                        success: function(response) {
                                            if (response.sukses) {
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: 'Berasil',
                                                    html: `${response.sukses}`
                                                })
                                                $('#tambah').modal('show')
                                                dataTHAjaran()
                                            }
                                        }
                                    })
                                }
                            });
                        });
                        // end 
                    })
                </script>