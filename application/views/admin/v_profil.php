                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Admin Panel</li>
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
                                    <form action="<?= base_url('profil/edit') ?>" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group row">
                                                    <!-- <img src="<?= base_url('asset/img/user/') ?>" alt=""> -->
                                                    <img src="https://www.pngkit.com/png/detail/281-2812821_user-account-management-logo-user-icon-png.png" alt="" width="100%">

                                                    <div class="input-group mb-0">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Upload</span>
                                                        </div>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="inputGroupFile01" name="img">
                                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group row">
                                                    <label for="1" class="col-sm-3 col-form-label">NIS</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" readonly class="form-control" id="1" name="nama" value="<?= $user['nis'] ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="1" class="col-sm-3 col-form-label">Nama Lengkap</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" readonly class="form-control" id="1" name="nama" value="<?= $user['nama'] ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="1" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" readonly class="form-control" id="1" name="nama" value="<?= longdate_indo($user['pwd']) ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="1" class="col-sm-3 col-form-label">No. Telp/HP</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" readonly class="form-control" id="1" name="nama" value="<?= $user['hp'] ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="1" class="col-sm-3 col-form-label">Orangtua/Wali</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" readonly class="form-control" id="1" name="nama" value="<?= $user['pj'] ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="1" class="col-sm-3 col-form-label">Alamat</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" readonly class="form-control" id="1" name="nama" value="<?= $user['alamat'] ?>">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="1" class="col-sm-3 col-form-label">Level</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" readonly class="form-control" id="1" name="nama" value="<?= ($user['level'] == 1) ? 'Admin' : 'Editor' ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <button type="submit" class="btn btn-suvvess">Simpan</button>
                                                </div>



                                            </div>

                                        </div>

                                    </form>
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
                                            <input type="hidden" class="form-control" name="id_ajaran">
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Kategori Murid</label>
                                            <select id="k_murid" class="form-control" name="k_murid">
                                                <option value="1">Umum</option>
                                                <option value="2">Anak Guru</option>
                                                <option value="3">Yayasan Free</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label>SPP</label>
                                            <input type="text" class="form-control" name="spp">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <label>Infaq Gedung</label>
                                            <input type="text" class="form-control" name="infaq_gedung">
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Kegiatan</label>
                                            <input type="text" class="form-control" name="kegiatan">
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Seragam</label>
                                            <input type="text" class="form-control" name="seragam">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <label>Komite</label>
                                            <input type="text" class="form-control" name="komite">
                                        </div>
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