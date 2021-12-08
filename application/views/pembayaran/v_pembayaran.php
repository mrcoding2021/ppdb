                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <?php $this->load->view('admin/breadcrumb'); ?>

                            <div class="card shadow mb-4">
                                <div class="card-header py-3 bg-dark ">
                                    <h3 class="m-0 text-white font-weight-bold ">Input
                                        <?= $title;
                                        if ($user['level'] == 1) : ?> <a href="#uploadMutasi" class="btn btn-primary  btn-border-circle float-right" data-toggle="modal">Upload Data</a><?php endif ?><a href="#" class="btn btn-success input-baru btn-border-circle float-right">Input Baru</a></h3>
                                </div>
                                <form action="<?= base_url('pembayaran/siswa') ?>" class="pembayaranSiswa">
                                    <div class="card-body row">
                                        <div class="col-md-8">
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label for="1">Nama Murid</label>
                                                    <input type="text" autofocus class="form-control" name="nama" id="nama_siswa">
                                                    <input type="hidden" class="form-control id_user" name="id_murid">
                                                </div>
                                                <div class="col-sm-3">
                                                    <label for="1">NIS</label>
                                                    <input type="text" readonly class="form-control" name="nis">
                                                </div>
                                                <div class="col-sm-3">
                                                    <label for="1">NISN</label>
                                                    <input type="text" readonly class="form-control" name="nisn">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-5">
                                                    <label for="1">Kelas</label>
                                                    <input type="text" readonly class="form-control" name="kelas">
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="1">Orangtua</label>
                                                    <input type="text" readonly class="form-control" name="wali">
                                                </div>
                                                <div class="col-sm-3">
                                                    <label for="1">No. HP</label>
                                                    <input type="text" readonly class="form-control" name="hp">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row border-bottom-danger">
                                                <label for="1">No. Invoice :</label>
                                                <?php
                                                $this->db->where('parent', '1');
                                                $this->db->where('kategori', '1');
                                                $akun_trx = $this->db->get('tb_rab')->result();
                                                $this->db->order_by('id', 'desc');
                                                $inv = $this->db->get('tb_transaksi')->row();
                                                $d = 1 . '.' . str_replace('-', '', date('Y-m-d'));
                                                $date = str_replace('-', '', date('Y-m-d')) ?>
                                                <h4 class="mx-2" id="inv">
                                                    <?php
                                                    if ($inv == null) {
                                                        echo $d;
                                                    } else {
                                                        $e = intval($inv->id_trx) + 1;
                                                        echo $e . '.' . $date;
                                                    }; ?>
                                                </h4>

                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-6">

                                                    <label for="1">Tahun Ajaran</label>
                                                    <select type="text" class="form-control ta_s" name="ta">
                                                        <?php $n = 16;
                                                        $m = 17;
                                                        for ($i = 0; $i < 15; $i++) { ?>
                                                            <option value="20<?= $n . '-20' . $m ?>">20<?= $n . '-20' . $m ?></option>
                                                        <?php $n++;
                                                            $m++;
                                                        } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="1">Tgl. Bayar</label>
                                                    <input type="date" value="<?= date('Y-m-d') ?>" name="tgl_byr" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 col-lg-12 container">
                                            <table class="table table-striped table-sm" width="100%">
                                                <thead class="bg-dark text-white text-center">
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Jenis Tagihan</th>
                                                        <th scope="col">Kode Akun</th>
                                                        <th scope="col">Jumlah Tagihan</th>
                                                        <th scope="col">Bayar</th>
                                                        <th scope="col">Jumlah Bayar</th>
                                                        <th scope="col">Diskon</th>
                                                        <th scope="col">Total dibayar</th>
                                                        <th>Keterangan</th>
                                                    </tr>

                                                </thead>
                                                <tbody>
                                                    <?php $kode = ['PEMBANGUNAN', 'KEGIATAN', 'SERAGAM', 'KOMITE', 'BUKU PAKET','SPP', 'SARPRAS'];
                                                    $parent = ['1-10000', '1-40000', '1-50000', '1-80000', '1-60000','1-30000', '1-20000'];
                                                    $no = 1;
                                                    for ($i = 0; $i < 7; $i++) { ?>
                                                        <tr>
                                                            <th scope="row"><?= $no++ ?></th>
                                                            <td><?= $kode[$i] ?></td>
                                                            <td>
                                                                <select name="akun_trx[]" class="form-control form-control-sm">
                                                                    <option value="0">Pilih Akun</option>
                                                                    <?php $this->db->where('parent', $parent[$i]);
                                                                    $akuntrx = $this->db->get('tb_rab')->result();
                                                                    foreach ($akuntrx as $key) : ?>
                                                                        <option value="<?= $key->kode_akun ?>"> <?= $key->nama ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </td>
                                                            <td><input type="text" value="0" class="tagihan form-control form-control-sm" name="tagihan[]"><input type="hidden" value="2021-2022" name="ta"><input class="inv" type="hidden" value="0" name="inv"><input type="hidden" value="<?= $kode[$i] ?>" name="kode"><input type="hidden" value="0" name="id_murid"></td>
                                                            <td>
                                                                <select value="0" class="diskon1 form-control form-control-sm" name="metode[]">
                                                                    <option value="1">CASH</option>
                                                                    <option value="2">TRANSFER BSI</option>
                                                                    <option value="3">POTONG TABUNGAN</option>
                                                                    <option value="4">POTONG KEGIATAN</option>
                                                                </select>
                                                            </td>
                                                            <td><input type="number" value="0" class="jml_byr form-control form-control-sm" name="jml_byr[]"></td>
                                                            <td><input type="number" value="0" class="diskon form-control form-control-sm" name="diskon[]"></td>
                                                            <td><input type="number" readonly value="0" class="jumlah form-control form-control-sm" name="jml[]"></td>
                                                            <td><input type="text" value="0" class="ket form-control form-control-sm" name="ket[]"></td>
                                                        </tr>
                                                    <?php } ?>
                                                    <tr class="bg-dark text-white text-right">
                                                        <td colspan="5">Total</td>
                                                        <td class="total text-right">0</td>
                                                        <td><input type="number" readonly class="grandDiskon form-control form-control-sm"></td>
                                                        <td class="gTotal text-right">0</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr class="bg-primary text-white text-right">
                                                        <td colspan="5">Grand Total</td>
                                                        <td colspan="2" class="grandTotal text-right">0</td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="p-3">
                                            <button type="submit" class="p-1 btn btn-sm btn-success px-3"><i class="fa fa-hand-holding-usd"></i> Bayar Sekarang</button>
                                            <a target="_blank" href="<?= base_url('cetaks/invoice') ?>" id="cetak" class=" p-1 btn btn-sm px-3 btn-secondary"><i class="fa fa-print"></i> Cetak invoice</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->
                <div class="modal fade" id="uploadMutasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <h5 class="modal-title text-white" id="exampleModalLabel">Import Data Mutasi</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('import/pembayaran') ?>" method="post" enctype="multipart/form-data">

                                    <div class="form-group row">
                                        <label for="5" class="col-sm-2 col-form-label">File</label>
                                        <div class="col-sm-10">
                                            <div class="input-group mb-0">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Upload</span>
                                                </div>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="inputGroupFile01" name="file">
                                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Upload</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>


                <script>
                    function getTa(id, ta) {
                        $.ajax({
                            url: '<?= base_url('setting/getTagihan/') ?>' + id + '/' + ta,
                            dataType: 'json',
                            type: 'POST',
                            success: function(res) {
                                console.log(res)
                                if (res.length != 0) {
                                    for (let i = 0; i < res.length; i++) {
                                        $('.tagihan').eq(i).val(res[i].totalX)
                                    }
                                } else {
                                    $('.tagihan').val(0)
                                }

                            }
                        })
                    }

                    $('.ta_s').change(function(e) {
                        var ta = $(this).val()
                        var inv = $.trim($('#inv').html())
                        $('.inv').val(inv)
                        var id = $('.id_user').val()
                        getTa(id, ta)
                    })

                    $('.input-baru').click(function(e) {
                        var ta = $('.ta').val()
                        var inv = $.trim($('#inv').html())
                        $('input[name="ta"]').val(ta)
                        $('input[name="inv"]').val(inv)
                        $('.tagihan').val(0)
                    })

                    $('.jml_byr').keyup(function() {
                        var diskon = $(this).parents('td').next().find('.diskon').val()
                        var jumlah = parseInt($(this).val()) - parseInt(diskon)

                        $(this).parents('tr').find('.jumlah').val(jumlah)
                    })

                    $('.diskon').keyup(function() {
                        var bayar = $(this).parents('td').prev().find('.jml_byr').val()
                        var jumlah = parseInt(bayar) - parseInt($(this).val())

                        $(this).parents('tr').find('.jumlah').val(jumlah)
                    })

                    $('.pembayaranSiswa').submit(function(e) {
                        var id_trx = $('#inv').text().trim()
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
                                        Swal.fire({
                                            html: '<div class="p-5"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>',
                                            showConfirmButton: false
                                        })
                                    },
                                    success: function(res) {
                                        console.log(res);
                                        
                                        if (res.sukses) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Berhasil',
                                                html: `${res.sukses}`
                                            })
                                            $('#cetak').attr('href', '<?= base_url('cetak/invoice/') ?>' + id_trx)
                                            var cetak = $('#cetak').attr('href')
                                            console.log(cetak);
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