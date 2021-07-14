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
                                    <div class="row">
                                        <div class="col-md-3">
                                            <form action="<?= base_url('profil/ubahFoto') ?>">
                                                <input type="hidden" readOnly class="form-control" id="1" name="id" value="<?= $user['id_user'] ?>">
                                                <div class="form-group row">
                                                    <img src="https://www.pngkit.com/png/detail/281-2812821_user-account-management-logo-user-icon-png.png" alt="" width="100%">

                                                    <div class="input-group mb-0">

                                                        <div class="form-group">
                                                            <input type="file" class="form-control-file" id="exampleFormControlFile1">
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-success mt-3 mx-auto">Ubah Foto</button>

                                                </div>
                                            </form>
                                        </div>

                                        <div class="col-md-9">
                                            <form action="<?= base_url('profil/edit') ?>" method="post" class="edit-profil" enctype="multipart/form-data">
                                                <div class="form-group row">
                                                    <label for="1" class="col-sm-3 col-form-label">NIS</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" readOnly class="form-control" id="1" name="nis" value="<?= $user['nis'] ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="1" class="col-sm-3 col-form-label">Nama Lengkap</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" readOnly class="form-control" id="1" name="nama" value="<?= $user['nama'] ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="1" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" readOnly class="form-control" id="1" name="pwd" value="<?= longdate_indo($user['pwd']) ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="1" class="col-sm-3 col-form-label">No. Telp/HP</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" readOnly class="form-control" id="1" name="hp" value="<?= $user['hp'] ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="1" class="col-sm-3 col-form-label">Orangtua/Wali</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" readOnly class="form-control" id="1" name="pj" value="<?= $user['pj'] ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="1" class="col-sm-3 col-form-label">Alamat</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" readOnly class="form-control" id="1" name="alamat" value="<?= $user['alamat'] ?>">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="1" class="col-sm-3 col-form-label">Level</label>
                                                    <div class="col-sm-9">
                                                        <select readOnly class="form-control" name="level">
                                                            <?php if ($user['level'] == 1) : ?>
                                                                <option selected value="1">Admin</option>
                                                                <option value="2">Editor</option>
                                                                <option value="3">Umum</option>
                                                            <?php elseif ($user['level'] == 2) : ?>
                                                                <option value="1">Admin</option>
                                                                <option selected value="2">Editor</option>
                                                                <option value="3">Umum</option>
                                                            <?php else : ?>
                                                                <option value="1">Admin</option>
                                                                <option value="2">Editor</option>
                                                                <option selected value="3">Umum</option>
                                                            <?php endif ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <a href="#" class="btn btn-primary edit-form-profil">Edit</a>
                                                    <button type="submt" class="ml-2 btn btn-success">Simpan</button>
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

                <script>
                    $(document).ready(function(e) {
                        $('.edit-form-profil').click(function(e) {
                            e.preventDefault()
                            $('.form-control').prop('readOnly', false)
                        })

                        $('.edit-profil').submit(function(e) {
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
                                            console.log(response)
                                            if (response.sukses) {
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: 'Berasil',
                                                    html: `${response.sukses}`
                                                })
                                            }

                                        }
                                    })
                                }
                            });

                        })
                    })
                </script>