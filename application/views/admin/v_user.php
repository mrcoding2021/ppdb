<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->

    <div class="row">
        <div id="alert" class="col-lg-12 d-none">
            <div class="alert alert-success"><i class="fa fa-check-circle"></i> Data User berhasiil dikoreksi</div>
        </div>
        <div class="col-lg-12">

            <!-- DataTales Example -->
            <?= $this->session->flashdata('alert');
            ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">User Management <a href="#addUser" class="btn btn-primary text-right" data-toggle="modal">Tambah User</a></h6>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Level</th>
                                    <th>Status</th>
                                    <th>Reset Password</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($userfull as $key) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?php echo $key['nama'] ?></td>
                                        <td>
                                            <?php echo $key['email'] ?>
                                        </td>
                                        <td>
                                            <?php $this->db->where('id_user', $key['level']);

                                            $userAkses = $this->db->get('tb_user_menu')->row();
                                            echo $userAkses->menu ?>

                                        </td>
                                        <td>
                                            <?php if ($key['is_active'] == 1) : ?>
                                                <a href="<?= base_url('user/aktif/') . $key['id_user'] ?>" class="badge badge-success">Aktif</a> ;
                                            <?php else : ?>
                                                <a href="<?= base_url('user/aktif/') . $key['id_user'] ?>" class="badge badge-danger">Tidak Aktif</a>
                                            <?php endif ?>
                                        </td>
                                        <td>
                                            <a href="#addUser" data-toggle="modal" class="badge badge-primary">Reset Password</a>
                                        </td>
                                        <td>
                                            <a href="#editUser<?= $key['id_user'] ?>" class="badge badge-success" data-toggle="modal">Edit</a>
                                            <a href="<?= base_url('user/delete/') . $key['id_user'] ?>" class="badge badge-danger">Delete</a>
                                        </td>
                                    </tr>

                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>

<div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Menu Baru</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">???</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('user/addUser') ?>" method="post">
                    <div class="form-group row">
                        <label for="1" class="col-sm-2 col-form-label">Nama User</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="1" name="nama">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="2" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="2" name="email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="3" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="3" name="pwd">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="4" class="col-sm-2 col-form-label">Hak Akses</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="4" name="level">
                                <option readonly>Pilih</option>
                                <option value="1">Admin</option>
                                <option value="2">Editor</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Input</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<?php foreach ($userfull as $key) : ?>
    <div class="modal fade" id="editUser<?= $key['id_user'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Menu</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('user/editUser') ?>" method="post">
                        <div class="form-group row" class="editUser">
                            <label for="1" class="col-sm-2 col-form-label">Nama User</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="<?= $key['nama'] ?>" name="nama">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="2" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="<?= $key['email'] ?> name=" email">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="4" class="col-sm-2 col-form-label">Hak Akses</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="4" name="level">
                                    <?php $userAkses = $this->db->get('tb_user_menu')->result();
                                    foreach ($userAkses as $ua) : ?>
                                        <option <?= ($ua->id_user == $key['level']) ? 'selected' : '' ?> value="<?= $ua->id_user ?>"><?= $ua->menu ?></option>
                                    <?php endforeach ?>
                                </select>
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
<?php endforeach; ?>

<script>
    $('.editUser').submit(function(e) {
        e.preventDefault()
        $.ajax({
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'json',
            type: 'post',
            success: function(res) {
                if (res.sukses) {
                    var alert = $('#alert').attr('class', 'col-lg-12')
                }
                setInterval(() => {
                    alert.attr('class', 'col-lg-12 d-none')
                }, 3000 );
            }
        })
    })
</script>