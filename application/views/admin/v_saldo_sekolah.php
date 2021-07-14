                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Saldo Sekolah</h1>
                    <!-- Content Row -->
                    <?= $this->session->flashdata('alert');
                    ?>

                    <div class="row">
                        <duv class="col-md-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Saldo Masing-masing Sekolah <a href="#tambahSekolah" class="btn btn-primary ml-3" data-toggle="modal">Tambah Sekolah</a> <a href="#tambahPelajar" class="btn btn-success ml-1" data-toggle="modal">Upload Data Pelajar</a> </h6>

                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tanggal Daftar</th>
                                                    <th>Nama Sekolah</th>
                                                    <th>Alamat</th>
                                                    <th>No. HP</th>
                                                    <th>Saldo Sipajar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $this->db->limit(5);
                                                $school = $this->mapp->get_all('tb_sekolah');
                                                $no = 0;
                                                foreach ($school as $key) : ?>

                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= $key->date_created ?>
                                                        </td>
                                                        <td>
                                                            <span class="badge badge-success">ID :  <?= $key->id_sekolah ?></span> <?= $key->nama_sekolah ?>
                                                        </td>
                                                        <td>
                                                            <?= $key->alamat_sekolah ?>
                                                        </td>
                                                        <td>
                                                            <?= $key->hp_sekolah ?>
                                                        </td>


                                                        <td>
                                                            <?php $saldo_sekolah = $this->db->get_where('tb_tansaksi', array('id_sekolah' => $key->id_sekolah))->result();
                                                            $saldoS = 0;
                                                            foreach ($saldo_sekolah as $s) {
                                                                $saldoS = $saldoS + $s->kredit - $s->debit;
                                                            }

                                                            echo rupiah($saldoS);
                                                            ?>
                                                        </td>
                                                    <?php endforeach ?>
                                                    </tr>

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
                <div class="modal fade" id="tambahSekolah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Sekolah Baru</h5>

                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('sipajar/addSekolah') ?>" method="post">
                                    <div class="form-group row">
                                        <label for="1" class="col-sm-3 col-form-label text-right">Nama Sekolah</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="1" name="nama">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="1" class="col-sm-3 col-form-label text-right">Alamat Sekolah</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="1" name="alamat">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="1" class="col-sm-3 col-form-label text-right">No. HP Sekolah</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="1" name="hp">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="1" class="col-sm-3 col-form-label text-right">Email Sekolah</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="1" name="email">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="1" class="col-sm-3 col-form-label text-right">Penanggungjawab</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="1" name="pj">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Edit</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal fade" id="tambahPelajar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Import Data Pelajar</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('import/upload') ?>" method="post" enctype="multipart/form-data">

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