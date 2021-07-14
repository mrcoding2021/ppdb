<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->

    <div class="row">
        <div class="col-lg">
            <!-- DataTales Example -->
            <?= $this->session->flashdata('alert');
            ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Galeri Travel <a href="#addGaleri" class="btn btn-primary text-right" data-toggle="modal">Tambah Galeri Baru</a></h6>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Negara</th>
                                    <th>Cover</th>
                                    <th>Foto Terkait    </th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($galeri as $key) : ?>
                                    
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td>
                                            <a href="#editGaleri<?= $key['id_paket'] ?>" class="badge badge-primary tombolEdit" data-toggle="modal">Edit
                                            </a>
                                            <a href="<?= base_url('post/delete/') . $key['id_paket'] ?>" class="badge badge-danger" onclick="return confirm('Yakin ingin menghapus data ini ?')">Delete
                                            </a><br>
                                            <?= $key['negara'] ?>
                                        </td>
                                        <td><img src="<?= base_url() ?>asset/assets/images/packages/<?= $key['img'] ?>" alt="" width="100px">
                                        </td>
                                        <td> 
                                            <?php 
                                            $id = $key['id_paket'];
                                            $query = "SELECT * FROM `tb_galeri` WHERE `id_negara`= $id";
                                            $foto = $this->db->query($query)->result_array();
                                            foreach($foto as $f):?>
                                            <img src="<?= base_url() ?>asset/assets/images/gallary/<?= $f['img'] ?>" alt="" width="100px" height="70px">
                                            <?php endforeach?>
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
<!-- End of Main Content -->
<div class="modal fade" id="addGaleri" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Post Baru</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('post/addPost') ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="1" class="col-sm-2 col-form-label">Judul Post</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="1" name="nama">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="2" class="col-sm-2 col-form-label">Tanggal</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="2" name="date">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="3" class="col-sm-2 col-form-label">Negara</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="3" name="negara">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="4" class="col-sm-2 col-form-label">Isi</label>
                        <div class="col-sm-10">
                            <textarea type="text" class="form-control" id="4" name="isi" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="5" class="col-sm-2 col-form-label">Gambar</label>
                        <div class="col-sm-10">
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
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<?php foreach ($galeri as $key) : ?>
    <div class="modal fade" id="editGaleri<?php echo $key['id_paket'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Post</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('galeri/editGaleri/') . $key['id_paket'] ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="1" class="col-sm-2 col-form-label">Negara</label>
                            <div class="col-sm-10">
                                <input type="hidden" class="form-control" id="1" name="id_menu" value="<?php echo $key['id_paket'] ?>">
                                <input type="text" class="form-control" id="1" name="nama" value="<?php echo $key['negara'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="4" class="col-sm-2 col-form-label">Isi</label>
                            <div class="col-sm-10">
                                <textarea type="text" class="form-control" id="4" name="isi" rows="3"><?php echo $key['isi'] ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="5" class="col-sm-2 col-form-label">Gambar</label>
                            <div class="col-sm-3">
                                <img src="<?= base_url() ?>asset/assets/images/packages/<?= $key['img'] ?>" alt="" width="100%">
                            </div>
                            <div class="col-sm-7">
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
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
<?php endforeach ?>