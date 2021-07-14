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

                                    </h3>
                                </div>
                                <div class="card-body">
                                    <ul class="nav nav-pills nav-justified" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">BY FILTER</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">TAHUN AJARAN</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#all" role="tab" aria-controls="profile" aria-selected="false">ALL</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content mt-3" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <div class="form-group row">
                                                <div class="col-sm-4">
                                                    <label>Bulan</label>
                                                    <select name="bulan" class="thun-ajaran form-control">
                                                        <?php
                                                        $bulan = [7, 8, 9, 10, 11, 12, 1, 2, 3, 4, 5, 6];
                                                        for ($i = 0; $i < count($bulan); $i++) : ?>
                                                            <option <?= ($bulan[$i] == date('m')) ? 'selected' : '' ?> value="<?= $bulan[$i] ?>"><?= bulan($bulan[$i]) ?></option>
                                                        <?php endfor ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label>Tahun</label>
                                                    <select name="thn-ajaran" class="thun-ajaran form-control">
                                                        <?php
                                                        $tahun = [2016, 2017, 2018, 2019, 2020, 2021, 2022, 2023, 2024, 2025, 2026, 2027];
                                                        for ($i = 0; $i < count($tahun); $i++) : ?>
                                                            <option <?= ($tahun[$i] == date('Y')) ? 'selected' : '' ?> value="<?= $tahun[$i] ?>"><?= $tahun[$i] ?></option>
                                                        <?php endfor ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="table-responsive">
                                                    <form action="<?= base_url('pembayaran/inputData') ?>" class="inputData" method="POST">
                                                        <table class="table table-sm table-bordered" width="100%" id="tableLunas" cellspacing="0">
                                                            <thead>
                                                                <tr class="text-center text-white bg-success">
                                                                    <th rowspan="2">No.</th>
                                                                    <th colspan="9">JUMLAH BIAYA PENDIDIKAN YANG SUDAH TERBAYAR</th>
                                                                </tr>
                                                                <tr class="bg-success text-white text-center">
                                                                    <th>Pembangunan</th>
                                                                    <th>Kegiatan</th>
                                                                    <th>Seragam</th>
                                                                    <th>Komite</th>
                                                                    <th>Buku Paket</th>
                                                                    <th>SPP</th>
                                                                    <th>Total</th>
                                                                </tr>
                                                            </thead>

                                                            <tbody id="tunggakan-terbayar">

                                                            </tbody>


                                                        </table>

                                                        <table class="table table-sm table-bordered" width="100%" id="tableHutang" cellspacing="0">
                                                            <thead>
                                                                <tr class="text-center text-white bg-danger">
                                                                    <th rowspan="2">No.</th>
                                                                    <th colspan="9">JUMLAH BIAYA PENDIDIKAN YANG BELUM TERBAYAR</th>
                                                                </tr>
                                                                <tr class="bg-danger text-white text-center">
                                                                    <th>Pembangunan</th>
                                                                    <th>Kegiatan</th>
                                                                    <th>Seragam</th>
                                                                    <th>Komite</th>
                                                                    <th>Buku Paket</th>
                                                                    <th>SPP</th>
                                                                    <th>Total</th>
                                                                </tr>
                                                            </thead>

                                                            <tbody id="tunggakan-hutang">

                                                            </tbody>


                                                        </table>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                            <div class="form-group row">
                                                <div class="col-sm-4">
                                                    <label>Tahun Ajaran</label>
                                                    <select name="thn-ajaran" class="thun-ajaran form-control">
                                                        <?php $this->db->group_by('ta');

                                                        $ta = $this->db->get('tb_ta')->result();

                                                        foreach ($ta as $key) : ?>
                                                            <option <?= (substr($key->ta, 5) == date('Y')) ? 'selected' : '' ?> value="<?= $key->id_ajaran ?>"><?= $key->ta ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="table-responsive">
                                                <form action="<?= base_url('pembayaran/inputData') ?>" class="inputData" method="POST">
                                                    <table class="table table-sm table-bordered" width="100%" id="tableLunas" cellspacing="0">
                                                        <thead>
                                                            <tr class="text-center text-white bg-success">
                                                                <th rowspan="2">No.</th>

                                                                <th colspan="9">JUMLAH BIAYA PENDIDIKAN YANG SUDAH TERBAYAR</th>
                                                            </tr>
                                                            <tr class="bg-success text-white text-center">
                                                                <th>Pembangunan</th>
                                                                <th>Kegiatan</th>
                                                                <th>Seragam</th>
                                                                <th>Komite</th>
                                                                <th>Buku Paket</th>
                                                                <th>SPP</th>
                                                                <th>Total</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody id="tunggakan-terbayar">

                                                        </tbody>


                                                    </table>

                                                    <table class="table table-sm table-bordered" width="100%" id="tableHutang" cellspacing="0">
                                                        <thead>
                                                            <tr class="text-center text-white bg-danger">
                                                                <th rowspan="2">No.</th>

                                                                <th colspan="9">JUMLAH BIAYA PENDIDIKAN YANG BELUM TERBAYAR</th>
                                                            </tr>
                                                            <tr class="bg-danger text-white text-center">
                                                                <th>Pembangunan</th>
                                                                <th>Kegiatan</th>
                                                                <th>Seragam</th>
                                                                <th>Komite</th>
                                                                <th>Buku Paket</th>
                                                                <th>SPP</th>
                                                                <th>Total</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody id="tunggakan-hutang">

                                                        </tbody>


                                                    </table>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="all" role="tabpanel" aria-labelledby="profile-tab">

                                            <div class="table-responsive">
                                                <form action="<?= base_url('pembayaran/inputData') ?>" class="inputData" method="POST">
                                                    <table class="table table-sm table-bordered" width="100%" id="tableLunas" cellspacing="0">
                                                        <thead>
                                                            <tr class="text-center text-white bg-success">
                                                                <th rowspan="2">No.</th>
                                                                <th rowspan="2">Tahun Ajaran</th>
                                                                <th colspan="9">JUMLAH BIAYA PENDIDIKAN YANG SUDAH TERBAYAR</th>
                                                            </tr>
                                                            <tr class="bg-success text-white text-center">
                                                                <th>Pembangunan</th>
                                                                <th>Kegiatan</th>
                                                                <th>Seragam</th>
                                                                <th>Komite</th>
                                                                <th>Buku Paket</th>
                                                                <th>SPP</th>
                                                                <th>Total</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody id="tunggakan-terbayar">

                                                        </tbody>


                                                    </table>

                                                    <table class="table table-sm table-bordered" width="100%" id="tableHutang" cellspacing="0">
                                                        <thead>
                                                            <tr class="text-center text-white bg-danger">
                                                                <th rowspan="2">No.</th>
                                                                <th rowspan="2">Tahun Ajaran</th>
                                                                <th colspan="9">JUMLAH BIAYA PENDIDIKAN YANG BELUM TERBAYAR</th>
                                                            </tr>
                                                            <tr class="bg-danger text-white text-center">
                                                                <th>Pembangunan</th>
                                                                <th>Kegiatan</th>
                                                                <th>Seragam</th>
                                                                <th>Komite</th>
                                                                <th>Buku Paket</th>
                                                                <th>SPP</th>
                                                                <th>Total</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody id="tunggakan-hutang">

                                                        </tbody>


                                                    </table>
                                                </form>
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