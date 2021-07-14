                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Dashboard Sekolah</h1>
                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-6 col-md-6 mb-4 text-center">
                            <div class="card  shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-md-3 p-3">
                                            <img src="https://cdn2.iconfinder.com/data/icons/ios-7-icons/50/user_male2-512.png" width="50%" alt="">
                                        </div>
                                        <div class="col-md-6 ml-3 text-left">
                                            <?php $detail_sekolah = $this->db->get_where('tb_sekolah', array('id_sekolah' => $data_sekolah->id_sekolah))->row(); ?>

                                            Selamat Datang
                                            <h3><?= $detail_sekolah->nama_sekolah ?></h3>
                                            <div class="">PJ : <?= $detail_sekolah->pj_sekolah ?> | No. Hp <?= $detail_sekolah->hp_sekolah ?></div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="row">
                        <div class="col-lg-4 mb-3 text-center">
                            <div class="card bg-success text-white shadow">
                                <div class="card-body">
                                    Total Saldo Simpanan Pelajar
                                    <?php $saldo_sekolah = $this->db->get_where('tb_tansaksi', array('id_sekolah' => $data_sekolah->id_sekolah))->result();
                                    $saldoS = 0;
                                    foreach ($saldo_sekolah as $s) {
                                        $saldoS = $saldoS + $s->kredit - $s->debit;
                                    } ?>
                                    <div class="h2 mb-0 mr-3 font-weight-bold"><?= rupiah($saldoS) ?>-</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 mb-4 text-center">
                            <div class="card bg-primary text-white shadow">
                                <div class="card-body">
                                    Total Saldo bulan Lalu
                                    <div class="h2 mb-0 mr-3 font-weight-bold">Rp. 20.000.000,-</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 mb-4 text-center">
                            <div class="card bg-info text-white shadow">
                                <div class="card-body">
                                    Total Siswa Sipajar
                                    <div class="h2 mb-0 mr-3 font-weight-bold"><?= count($pelajar) ?></div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <duv class="col-md-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Riwayat Transaksi</h6>

                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tanggal</th>
                                                    <th>Nama Pelajar</th>
                                                    <th>No. HP</th>
                                                    <th>Saldo Sipajar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $this->db->limit(5);
                                                $muridxy = $this->db->get_where('tb_murid',array('id_sekolah', $data_sekolah->id_sekolah))->result();
                                                var_dump($muridxy);
                                                $no = 0;
                                                foreach ($pelajar as $key) : ?>

                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= $key->date_created ?>
                                                        </td>
                                                        <td>
                                                            <?= $key->nama_murid ?>
                                                        </td>
                                                       
                                                        <td>
                                                            <?= $key->hp_murid ?>
                                                        </td>


                                                        <td>
                                                            <?php $saldoMurid = $this->db->get_where('tb_tansaksi', array('id_sekolah' => $data_sekolah->id_sekolah))->result();
                                                            $saldoS = 0;
                                                            foreach ($saldo_sekolah as $s) {
                                                                $saldoS = $saldoS + $s->kredit - $s->debit;
                                                            }

                                                            echo rupiah($saldoS);
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach ?>
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