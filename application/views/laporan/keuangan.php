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
                                                    <?php for ($i = 1; $i < 13; $i++) { ?>
                                                        <option <?= (date('m') == $i) ? 'selected' : '' ?> value="<?= $i ?>"><?= bulan($i) ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-1 col-sm-4">
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
                                            <div class="col-lg-2 col-sm-4">
                                                <label for="1" class="col-form-label">.</label>
                                                <a href="<?= base_url('tabungan/excel') ?>" data-id="excel" class="excel btn btn-primary btn-block btn-sm">Export Excel</a>
                                            </div>
                                            <!-- <div class="col-lg-2 col-sm-4">
                                                    <label for="1" class="col-form-label">.</label>
                                                    <a href="<?= base_url('tabungan/excel') ?>" data-id="pdf" class="pdf btn btn-info btn-block btn-sm">Export PDF</a>
                                                </div> -->
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