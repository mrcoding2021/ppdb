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
                                        <a href="<?= base_url('rabps/tambah/' . $ta) ?>" class="btn btn-success btn-border-circle float-right">Update</a>
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <ul class="nav nav-pills nav-justified" id="myTab" role="tablist">
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
                                                        <th scope="col" rowspan="2" width="40%">Uraian</th>
                                                        <th scope="col" class="text-center" colspan="3">Perhitungan</th>
                                                        <th scope="col" rowspan="2">Total</th>

                                                    </tr>
                                                    <tr>
                                                        <td>Jml. Siswa</td>
                                                        <td width="5%">QTY</td>
                                                        <td scope="row">Hrg. Satuan</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($pemasukan as $key) : ?>
                                                        <tr class="bg-gray-200">
                                                            <td><a href="#key<?= $key->kode_akun ?>" class="badge badge-success" data-toggle="collapse"><i class="fa fa-plus"></i></a></td>
                                                            <td><?= $key->kode_akun ?></td>
                                                            <td colspan="6"><?= strtoupper($key->nama) ?></td>
                                                        </tr>
                                                        <?php
                                                        $this->db->where('parent', $key->id);
                                                        $pem = $this->db->get('tb_rab')->result();
                                                        foreach ($pem as $p) :
                                                            $this->db->where('ta', $ta);
                                                            $this->db->where('kode_akun', $p->kode_akun);
                                                            $detail = $this->db->get('tb_rab_kertas')->row();
                                                            if ($detail == null) {
                                                                $detail = (object)[
                                                                    'jml_siswa'     => '',
                                                                    'qty'           => '',
                                                                    'hrg_satuan'    => '',
                                                                    'jumlah'        => '',
                                                                ];
                                                            } ?>

                                                            <tr class="collapse" id="key<?= $key->kode_akun ?>">
                                                                <td></td>
                                                                <td><?= $p->kode_akun ?></td>
                                                                <td><?= strtoupper($p->nama) ?></td>
                                                                <td class="text-center"><?= $detail->jml_siswa ?></td>
                                                                <td class="text-center"><?= $detail->qty ?></td>
                                                                <td class="text-center"><?= rupiah($detail->hrg_satuan) ?></td>
                                                                <td class="text-center"><?= rupiah($detail->jumlah) ?></td>

                                                            </tr>
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
                                                    </tr>
                                                    <tr>
                                                        <td>Jml. Siswa</td>
                                                        <td width="5%">QTY</td>
                                                        <td scope="row">Hrg. Satuan</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($pengeluaran as $key) : ?>
                                                        <tr class="bg-gray-200">
                                                            <td><a href="#key<?= $key->kode_akun ?>" class="badge badge-success" data-toggle="collapse"><i class="fa fa-plus"></i></a></td>
                                                            <td><?= $key->kode_akun ?></td>
                                                            <td colspan="6"><?= strtoupper($key->nama) ?></td>

                                                        </tr>
                                                        <?php
                                                        $this->db->where('parent', $key->id);
                                                        $pem = $this->db->get('tb_rab')->result();

                                                        foreach ($pem as $p) :
                                                            $this->db->where('ta', $ta);
                                                            $this->db->where('kode_akun', $p->kode_akun);
                                                            $rinci = $this->db->get('tb_rab_kertas')->row();
                                                            if ($rinci == null) {
                                                                $rinci = (object)[
                                                                    'jml_siswa'     => '',
                                                                    'qty'           => '',
                                                                    'hrg_satuan'    => '',
                                                                    'jumlah'        => '',
                                                                ];
                                                            }
                                                        ?>

                                                            <tr class="collapse" id="key<?= $key->kode_akun ?>">
                                                                <td></td>
                                                                <td><?= $p->kode_akun ?></td>
                                                                <td><?= strtoupper($p->nama) ?></td>
                                                                <td class="text-center"><?= $rinci->jml_siswa ?></td>
                                                                <td class="text-center"><?= $rinci->qty ?></td>
                                                                <td class="text-center"><?= rupiah($rinci->hrg_satuan) ?></td>
                                                                <td class="text-center"><?= rupiah($rinci->jumlah) ?></td>
                                                            </tr>
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