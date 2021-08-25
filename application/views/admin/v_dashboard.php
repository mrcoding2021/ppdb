                <!-- Begin Page Content -->

                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Dashboard <?= $title ?></h1>
                    <!-- Content Row -->

                    <div class="row">
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Pemasukan</div>
                                            <div class="total-pemasukan h3 mb-0 font-weight-bold text-gray-800"><?= rupiah($pemasukan->total) ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-success"></i>
                                        </div>
                                    </div>
                                    <div class="row no-gutters align-items-center mt-2">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Pemasukan Hari Ini</div>
                                            <div class="total-pemasukan h3 mb-0 font-weight-bold text-gray-800"><?= rupiah($pemasukan->total) ?></div>
                                        </div>
                                    </div>
                                    <div class="row no-gutters align-items-center mt-2">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Pemasukan Bulan Lalu</div>
                                            <div class="total-pemasukan h3 mb-0 font-weight-bold text-gray-800"><?= rupiah($pemasukan->total) ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-8 col-md-6 mb-4">
                            <div class="card shadow h-100">
                                <div class="p-1">
                                    <table class="table table-bordered" id="rincian-saldo" width="100%" cellspacing="0">
                                        <thead>
                                            <tr class="bg-success text-white">
                                                <th width="20%">Sumber Kas</th>
                                                <th>Bulan Kemarin</th>
                                                <th>Hari Ini</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th><i class="fa fa-money-bill-wave-alt"></i> Cash</th>
                                                <td><?= rupiah(300000) ?></td>
                                                <td><?= rupiah(400000) ?></td>
                                                <td><?= rupiah(700000) ?></td>
                                            </tr>
                                            <tr>
                                                <th><img src="https://freepikpsd.com/wp-content/uploads/2019/10/logo-bank-bni-syariah-png-6-Transparent-Images.png" width="30%" alt=""> BNI</th>
                                                <td><?= rupiah(10000000) ?></td>
                                                <td><?= rupiah(15000000) ?></td>
                                                <td><?= rupiah(25000000) ?></td>
                                            </tr>
                                            <tr>
                                                <th><i class="fa fa-archive"></i> Tabungan</th>
                                                <td><?= rupiah(2000000) ?></td>
                                                <td><?= rupiah(1000000) ?></td>
                                                <td><?= rupiah(3000000) ?></td>
                                            </tr>

                                        </tbody>

                                    </table>
                                </div>

                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Pengeluaran</div>
                                            <div class="total-pemasukan h3 mb-0 font-weight-bold text-gray-800"><?= rupiah($pengeluaran->total) ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-danger"></i>
                                        </div>
                                    </div>
                                    <div class="row no-gutters align-items-center mt-2">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Pengeluaran Hari Ini</div>
                                            <div class="total-pemasukan h3 mb-0 font-weight-bold text-gray-800"><?= rupiah($pengeluaran->total) ?></div>
                                        </div>
                                    </div>
                                    <div class="row no-gutters align-items-center mt-2">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Pengeluaran Bulan Lalu</div>
                                            <div class="total-pemasukan h3 mb-0 font-weight-bold text-gray-800"><?= rupiah($pengeluaran->total) ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8 col-md-6 mb-4">
                            <div class="card shadow h-100">
                                <div class="p-1">
                                    <table class="table table-bordered" id="rincian-saldo" width="100%" cellspacing="0">
                                        <thead>
                                            <tr class="bg-danger text-white">
                                                <th width="20%">Sumber Kas</th>
                                                <th>Bulan Kemarin</th>
                                                <th>Hari Ini</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th><i class="fa fa-money-bill-wave-alt"></i> Cash</th>
                                                <td><?= rupiah(300000) ?></td>
                                                <td><?= rupiah(400000) ?></td>
                                                <td><?= rupiah(700000) ?></td>
                                            </tr>
                                            <tr>
                                                <th><img src="https://freepikpsd.com/wp-content/uploads/2019/10/logo-bank-bni-syariah-png-6-Transparent-Images.png" width="30%" alt=""> BNI</th>
                                                <td><?= rupiah(10000000) ?></td>
                                                <td><?= rupiah(15000000) ?></td>
                                                <td><?= rupiah(25000000) ?></td>
                                            </tr>
                                            <tr>
                                                <th><i class="fa fa-archive"></i> Tabungan</th>
                                                <td><?= rupiah(2000000) ?></td>
                                                <td><?= rupiah(1000000) ?></td>
                                                <td><?= rupiah(3000000) ?></td>
                                            </tr>

                                        </tbody>

                                    </table>
                                </div>

                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Siswa</div>
                                            <div class="total-tunggakan h3 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                $this->db->where('is_active', 1);
                                                $siswa = $this->db->get('tb_user')->result();
                                                echo count($siswa);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col mr-2 border-left-dark">
                                            <div class="pl-2 text-xs font-weight-bold text-primary text-uppercase mb-1">Siswa Umum</div>
                                            <div class="pl-2 total-tunggakan h3 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                $this->db->where('is_active', 1);
                                                $this->db->where('kategori_murid', 1);
                                                $this->db->where('level', 4);
                                                $siswa = $this->db->get('tb_user')->result();
                                                echo count($siswa);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col mr-2 border-left-dark">
                                            <div class="pl-2 text-xs font-weight-bold text-primary text-uppercase mb-1">Anak Guru</div>
                                            <div class="pl-2 total-tunggakan h3 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                $this->db->where('is_active', 1);
                                                $this->db->where('kategori_murid', 2);
                                                $this->db->where('level', 4);
                                                $siswa = $this->db->get('tb_user')->result();
                                                echo count($siswa);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col mr-2 border-left-dark">
                                            <div class="pl-2 text-xs font-weight-bold text-primary text-uppercase mb-1">Yayasan</div>
                                            <div class="pl-2 total-tunggakan h3 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                $this->db->where('is_active', 1);
                                                $this->db->where('kategori_murid', 3);
                                                $this->db->where('level', 4);
                                                $siswa = $this->db->get('tb_user')->result();
                                                echo count($siswa);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x "></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 mb-4 ">
                            <div class="card bg-danger text-white shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold  text-uppercase mb-1">Total Tunggakan</div>
                                            <div class="total-tunggakan h3 mb-0 font-weight-bold">Rp 0,-</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x "></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row text-white">

                        <!-- Earnings (Monthly) Card Example -->
                     
                        <div class="col-xl-3 col-md-6 mb-4">
                            <a href="<?= base_url('pemasukan') ?>" style="text-decoration: none;">
                                <div class="card bg-warning shadow h-100 py-2 text-white">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col-auto">
                                                        <div class="h5 mb-0 mr-3 font-weight-bold">INPUT PEMASUKAN</div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-arrow-circle-right fa-2x "></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <a href="<?= base_url('pengeluaran') ?>" style="text-decoration: none;">
                                <div class="card bg-success shadow h-100 py-2 text-white">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col-auto">
                                                        <div class="h5 mb-0 mr-3 font-weight-bold">INPUT PENGELUARAN</div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-arrow-circle-right fa-2x "></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <a href="<?= base_url('setting') ?>" style="text-decoration: none;">
                                <div class="card bg-danger shadow h-100 py-2 text-white">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col-auto">
                                                        <div class="h5 mb-0 mr-3 font-weight-bold">INPUT TAHUN AJARAN</div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-arrow-circle-right fa-2x "></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4 hover-wrap">
                            <a href="<?= base_url('rabps/rencana') ?>" style="text-decoration: none;">
                                <div class="card bg-info shadow h-100 py-2 text-white">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col-auto">
                                                        <div class="h5 mb-0 mr-3 font-weight-bold">INPUT KERTAS KERJA RABPS</div>

                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-arrow-circle-right fa-2x "></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-6 col-lg-6">

                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-6 col-lg-6">

                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->