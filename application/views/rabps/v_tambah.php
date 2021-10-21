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
                                        <a href="<?= base_url('rabps/detailRencana/' . $ta) ?>" class="btn input-ajaran-baru btn-success btn-border-circle float-right">Kembali</a>

                                    </h3>
                                </div>
                                <div class="card-body">
                                    <?php
                                    if ($ta == null) {
                                        $ta = '2016-2017'; ?>
                                        <div class="col-sm-4">
                                            <label>Tahun Ajaran</label>
                                            <select name="" id="ta" class=" form-control">
                                                <?php foreach ($thn_ajaran as $key) : ?>
                                                    <option <?= ($key->ta == $ta) ? 'selected' : '' ?> value="<?= $key->ta ?>"><?= $key->ta ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    <?php  }
                                    ?>
                                    <ul class="nav nav-pills nav-justified mt-3" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">RABPS Peasukaan</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">RABPS Pengeluaran</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content mt-3" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <table class="table table-hover table-sm table-bordered" id="tablePemasukan">
                                                <thead class="bg-dark text-white text-center">
                                                    <tr>
                                                        <th scope="col" width="5%" rowspan="2">#</th>
                                                        <th scope="col" width="7%" rowspan="2">Kode Akun</th>
                                                        <th scope="col" rowspan="2" width="30%">Uraian</th>
                                                        <th scope="col" class="text-center" colspan="3">Perhitungan</th>
                                                        <th scope="col" rowspan="2">Total</th>
                                                        <th scope="col" rowspan="2">Simpan</th>

                                                    </tr>
                                                    <tr>
                                                        <td>Jml. Siswa</td>
                                                        <td width="5%">QTY</td>
                                                        <td scope="row">Hrg. Satuan</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($pemasukan as $key) : ?>
                                                        <tr>
                                                            <?php
                                                            $this->db->where('parent', $key->kode_akun);
                                                            $pem = $this->db->get('tb_rab')->result();
                                                            if (count($pem) != null) { ?>
                                                                <td><a href="#" data-target="#data<?= $key->kode_akun ?>" class="badge badge-success" data-toggle="collapse"><i class="fa fa-plus"></i></a></td>
                                                            <?php  } else { ?>
                                                                <td></td>
                                                            <?php } ?>
                                                            <td><strong><?= $key->kode_akun ?></strong></td>
                                                            <td colspan="6"><strong><?= strtoupper($key->nama) ?></strong></td>
                                                        </tr>
                                                        <thead class="collapse" id="data<?= $key->kode_akun ?>">
                                                            <?php

                                                            foreach ($pem as $p) : ?>

                                                                <tr>
                                                                    <td></td>
                                                                    <td><?= $p->kode_akun ?></td>
                                                                    <td><?= $p->nama ?></td>
                                                                    <td>
                                                                        <input type="text" class="form-control-sm form-control jml_siswa" name="jml_siswa">
                                                                        <input type="hidden" class="form-control-sm form-control bulan" value="<?= $bulan ?>" name="bulan">
                                                                        <input type="hidden" class="form-control-sm form-control id_rab" value="0" name="id_rab">
                                                                        <input type="hidden" class="form-control-sm form-control ta" value="<?= $ta ?>" name="ta">
                                                                        <input type="hidden" class="form-control-sm form-control kategori" value="1" name="kategori">
                                                                        <input type="hidden" class="form-control-sm form-control id" value="<?= $p->kode_akun ?>" name="id">
                                                                    </td>
                                                                    <td><input type="text" class="form-control-sm form-control qty" name="qty"></td>
                                                                    <td><input type="text" class="form-control-sm form-control hrg_satuan" name="hrg_satuan"></td>
                                                                    <td><input type="text" class="form-control-sm form-control jumlah" name="jumlah"></td>
                                                                    <td>
                                                                        <a href="#" class="save badge badge-primary">Simpan</a>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach ?>
                                                        </thead>
                                                    <?php endforeach ?>

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                                            <table class="table table-hover table-sm table-bordered" id="tablePemasukan">
                                                <thead class="bg-dark text-white text-center">
                                                    <tr>
                                                        <th scope="col" width="5%" rowspan="2">#</th>
                                                        <th scope="col" width="10%" rowspan="2">Kode Akun</th>
                                                        <th scope="col" rowspan="2" width="30%">Uraian</th>
                                                        <th scope="col" class="text-center" colspan="3">Perhitungan</th>
                                                        <th scope="col" rowspan="2">Total</th>
                                                        <th scope="col" rowspan="2">Simpan</th>
                                                    </tr>
                                                    <tr>
                                                        <td>Jml. Siswa</td>
                                                        <td width="5%">QTY</td>
                                                        <td scope="row">Hrg. Satuan</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($pengeluaran as $key) : ?>
                                                        <tr>
                                                            <?php
                                                            $this->db->where('parent', $key->kode_akun);
                                                            $pem = $this->db->get('tb_rab')->result();
                                                            if (count($pem) != null) { ?>
                                                                <td><a href="#" data-target="#data<?= $key->kode_akun ?>" class="badge badge-success" data-toggle="collapse"><i class="fa fa-plus"></i></a></td>
                                                            <?php  } else { ?>
                                                                <td></td>
                                                            <?php } ?>
                                                            <td><strong><?= $key->kode_akun ?></strong></td>
                                                            <td colspan="6"><strong><?= strtoupper($key->nama) ?></strong></td>
                                                        </tr>
                                                        <thead class="collapse" id="data<?= $key->kode_akun ?>">
                                                            <?php
                                                            foreach ($pem as $p) : ?>
                                                                <tr>
                                                                    <td></td>
                                                                    <td><?= $p->kode_akun ?></td>
                                                                    <td><?= strtoupper($p->nama) ?></td>
                                                                    <td>
                                                                        <input type="text" class="form-control-sm form-control jml_siswa" value="" name="jml_siswa">
                                                                        <input type="hidden" class="form-control-sm form-control bulan" value="<?= $bulan ?>" name="bulan">
                                                                        <input type="hidden" class="form-control-sm form-control ta" value="<?= $ta ?>" name="ta">
                                                                        <input type="hidden" class="form-control-sm form-control kategori" value="2" name="kategori">
                                                                        <input type="hidden" class="form-control-sm form-control id" value="<?= $p->kode_akun ?>" name="id">
                                                                    </td>
                                                                    <td><input type="text" class="form-control-sm form-control qty" name="qty"></td>
                                                                    <td><input type="text" class="form-control-sm form-control hrg_satuan" name="hrg_satuan"></td>
                                                                    <td><input type="text" class="form-control-sm form-control jumlah" name="jumlah"></td>
                                                                    <td>
                                                                        <a href="#" class="save badge badge-primary">Simpan</a>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach ?>
                                                        </thead>
                                                    <?php endforeach ?>
                                                </tbody>
                                            </table>
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

                <script>
                    $('input[name="ta"]').val('<?= $ta ?>')
                    $('#ta').change(function() {
                        var ta = $(this).find('option:selected').text()
                        console.log(ta)
                        $('input[name="ta"]').val(ta)
                    })
                    $('.save').click(function(e) {
                        e.preventDefault()
                        var parents = $(this).parents('td').parents('tr')
                        var jml_siswa = parents.find('.jml_siswa').val()
                        var qty = parents.find('.qty').val()
                        var hrg_satuan = parents.find('.hrg_satuan').val()
                        var jumlah = parents.find('.jumlah').val()
                        var id = parents.find('.id').val()
                        var bulan = parents.find('.bulan').val()
                        var ta = parents.find('.ta').val()
                        var kategori = parents.find('.kategori').val()
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
                                    url: '<?= base_url('rabps/save/') ?>',
                                    data: {
                                        'id': id,
                                        'jml_siswa': jml_siswa,
                                        'qty': qty,
                                        'hrg_satuan': hrg_satuan,
                                        'jumlah': jumlah,
                                        'ta': ta,
                                        'bulan': bulan,
                                        'kategori': kategori,
                                    },
                                    dataType: 'json',
                                    type: 'POST',
                                    success: function(response) {
                                        if (response.sukses) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Berhasil',
                                                html: `${response.sukses}`
                                            })
                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Gagal!',
                                                html: `${response.error}`
                                            })
                                        }

                                    }
                                })
                            }
                        });
                    })
                </script>