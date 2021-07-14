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
                                        <a href="<?= base_url('rabps/rencana') ?>" class="btn input-ajaran-baru btn-success btn-border-circle float-right">Kembali</a>
                                        <a href="<?= base_url('rabps/tambah') ?>" class="btn input-ajaran-baru btn-primary btn-border-circle float-right">Input Baru</a>
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
                                                        <th scope="col" width="5%" rowspan="2">Kode Akun</th>
                                                        <th scope="col" rowspan="2" width="30%">Uraian</th>
                                                        <th scope="col" rowspan="2">Tgl. Input</th>
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
                                                            <td><a href="#key<?= $key->kode_akun ?>" class="badge badge-success" data-toggle="collapse"><i class="fa fa-plus"></i></a></td>
                                                            <td><?= $key->kode_akun ?></td>
                                                            <td colspan="6"><?= strtoupper($key->nama) ?></td>
                                                        </tr>
                                                        <?php
                                                        $this->db->where('parent', $key->id);
                                                        $pem = $this->db->get('tb_rab')->result();
                                                        foreach ($pem as $p) :
                                                        ?>
                                                            <form action="<?= base_url('rabps/add') ?>" method="post">
                                                                <tr class="collapse" id="key<?= $key->kode_akun ?>">
                                                                    <td></td>
                                                                    <td><?= $p->kode_akun ?></td>
                                                                    <td><?= strtoupper($p->nama) ?></td>
                                                                    <td><input style="width: 120px;" type="text" name="tgl_input" value=""></td>
                                                                    <td><input style="max-width:150px" type="hidden" name="kode_akun" value="<?= $p->kode_akun ?>"><input type="hidden" name="kategori" value="1"><input type="hidden" name="parent" value="<?= $key->kode_akun ?>"><input type="text" name="jml_siswa" style="width: 140px;" value=""><input type="hidden" name="ta" value=""></td>
                                                                    <td><input style="width: 70px;" type="text" name="qty" value=""></td>
                                                                    <td><input type="text" name="hrg_satuan" style="width: 140px;" value=""></td>
                                                                    <td><input type="text" name="jumlah" style="width: 140px;" value=""></td>
                                                                    <td><button type="submit" class="badge badge-success">Simpan</button></td>
                                                                </tr>
                                                            </form>
                                                        <?php endforeach ?>
                                                    <?php endforeach ?>

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                                            <table class="table table-hover table-sm table-bordered" id="tablePemasukan">
                                                <thead class="bg-dark text-white text-center">
                                                    <tr>
                                                        <th scope="col" width="5%" rowspan="2">#</th>
                                                        <th scope="col" width="5%" rowspan="2">Kode Akun</th>
                                                        <th scope="col" rowspan="2" width="40%">Uraian</th>
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
                                                            <td><a href="#key<?= $key->kode_akun ?>" class="badge badge-success" data-toggle="collapse"><i class="fa fa-plus"></i></a></td>
                                                            <td><?= $key->kode_akun ?></td>
                                                            <td colspan="6"><?= strtoupper($key->nama) ?></td>

                                                        </tr>
                                                        <?php
                                                        $this->db->where('parent', $key->id);
                                                        $pem = $this->db->get('tb_rab')->result();
                                                        foreach ($pem as $p) :
                                                        ?>
                                                            <form action="<?= base_url('rabps/add') ?>" method="post">
                                                                <tr class="collapse" id="key<?= $key->kode_akun ?>">
                                                                    <td></td>
                                                                    <td><?= $p->kode_akun ?></td>
                                                                    <td><?= strtoupper($p->nama) ?></td>
                                                                    <td><input type="hidden" name="kode_akun" value="<?= $p->kode_akun ?>"><input type="hidden" name="kategori" value="2"><input type="hidden" name="parent" value="<?= $key->kode_akun ?>"><input type="hidden" name="ta" value=""><input type="text" style="width: 140px;" name="jml_siswa" value=""></td>
                                                                    <td><input type="text" style="width: 70px;" name="qty" value=""></td>
                                                                    <td><input style="width: 140px;" type="text" name="hrg_satuan" value=""></td>
                                                                    <td><input type="text" name="jumlah" style="width: 140px;" value=""></td>
                                                                    <td><button type="submit" class="badge badge-success">Simpan</button></td>
                                                                </tr>
                                                            </form>
                                                        <?php endforeach ?>
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
                    $(document).ready(function() {

                        $('input[name="ta"]').val('<?= $ta ?>')
                        $('#ta').change(function() {
                            var ta = $(this).find('option:selected').text()
                            console.log(ta)
                            $('input[name="ta"]').val(ta)
                        })
                        $('form').submit(function(e) {
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
                    })
                </script>