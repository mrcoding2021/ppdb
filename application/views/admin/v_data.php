                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <div class="row">

                        <duv class="col-md-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 bg-dark ">
                                    <h3 class="m-0 text-white font-weight-bold ">
                                        <?= $title;
                                        if ($user['level'] == 1) : ?> <a href="#uploadMutasi" class="btn btn-primary  btn-border-circle float-right" data-toggle="modal">Upload Data</a><?php endif ?><a href="#detail" data-toggle="modal" class="btn btn-success tambah btn-border-circle float-right">Tambah Data</a></h3>

                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered" id="dataSiswa" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>NIS</th>
                                                    <th>Nama Siswa</th>
                                                    <th>Kelas</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
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
                <div class="modal fade" id="uploadMutasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <h5 class="modal-title" id="exampleModalLabel">Import Data Mutasi</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('import/uploadMutasi') ?>" method="post" enctype="multipart/form-data">

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
                <div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-success text-white">
                                <h5 class="modal-title" id="exampleModalLabel">Detail Siswa</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('data/addSiswa') ?>" method="post" class="addSiswa" data-id="0">
                                    <div class="form-group row">
                                        <label for="1" class="col-sm-1 col-form-label">NIS</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" name="nis">
                                            <input type="hidden" class="form-control" name="id_user">
                                        </div>
                                        <label for="1" class="col-sm-2 col-form-label">Tgl.Daftar</label>
                                        <div class="col-sm-4">
                                            <input type="date" class="form-control" name="date">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="1" class="col-sm-1 col-form-label">Nama</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="nama">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="1" class="col-sm-1 col-form-label">Alamat</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="alamat">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="1" class="col-sm-1 col-form-label">Kelas</label>
                                        <div class="col-sm-5">
                                            <select name="kelas" class="kelas form-control">
                                                <?php $this->db->group_by('kode_kelas');
                                                $kelas = $this->db->get('tb_user_kelas')->result();
                                                foreach ($kelas as $key) { ?>
                                                    <option value="<?= $key->kode_kelas ?>"><?= $key->ket . ' - ' . $key->nama ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <label for="1" class="col-sm-2 col-form-label">No. HP</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="hp">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="1" class="col-sm-2 col-form-label">Orangtua/Wali</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="wali">
                                        </div>
                                        <label for="1" class="col-sm-2 col-form-label">Tgl. Lahir</label>
                                        <div class="col-sm-4">
                                            <input type="date" class="form-control" name="tgl_lahir">
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <label for="1" class="col-sm-1 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="email">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="pt-1 btn btn-block btn-border-circle btn-secondary" type="button" style="position: relative; top: 4px; height:38px" data-dismiss="modal">Cancel</button>
                                        <button type="sbmit" class="btn btn-success btn-border-circle btn-block">Input</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

                <script>
                    $(document).ready(function() {
                        ambilData()
                        $(document).on('click', '.hapus', function() {
                            var id = $(this).data('id')
                            Swal.fire({
                                title: "Yakin ingin dihapus?",
                                text: "Pastikan data Anda aman sebelum menghapus!",
                                icon: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#3085d6",
                                cancelButtonColor: "#d33",
                                confirmButtonText: "Yes, hapus saja!",
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    Swal.fire("Berhasil!", "Data telah terhapus.", "success");
                                    $.ajax({
                                        url: '<?= base_url('sispem/delete/') ?>' + id,
                                        success: function() {
                                            ambilData()
                                        }
                                    })
                                }
                            });
                        })


                        function ambilData() {
                            var pembiayaan = $('#dataSiswa').DataTable({
                                'ajax': {
                                    "type": "POST",
                                    "url": '<?= base_url('sispem/getAll/tb_user') ?>',
                                    "dataSrc": ""
                                },
                                "destroy": true,
                                'columns': [{
                                        "data": "no"
                                    },
                                    {
                                        "data": "nis"
                                    },
                                    {
                                        "data": "nama"
                                    },
                                    {
                                        "data": "kelas"
                                    },
                                    {
                                        "data": "spp",
                                        "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                                            $(nTd).html("<a data-toggle='modal' class='mr-1 detail badge badge-info badge-border-circle' href='#detail' data-id=" + oData.id_user + " >Detail</a><a class='hapus mr-1 badge badge-border-circle badge-danger ' data-id=" + oData.id_user + ">Hapus</a>");
                                        }
                                    }
                                ]
                            });
                        }

                        $(document).on('click', '.detail', function(e) {
                            var id = $(this).data('id')
                            $('input[name="id_user"]').val(id)
                            $.ajax({
                                url: '<?= base_url('sispem/detail') ?>',
                                data: {
                                    'id': id
                                },
                                type: 'POST',
                                dataType: 'JSON',
                                success: function(data) {
                                    $('.input').html('Edit Data')
                                    $('input[name=nis').val(data.nis)
                                    $('input[name="date"]').val(data.date_created)
                                    $('input[name="nama"]').val(data.nama)
                                    $('input[name="alamat"]').val(data.alamat)
                                    $('input[name="kelas"]').val(data.kelas)
                                    $('input[name="hp"]').val(data.hp)
                                    $('input[name="wali"]').val(data.pj)
                                    $('input[name="tgl_lahir"]').val(data.pwd)
                                    $('input[name="email"]').val(data.email)
                                    $('.kelas option[value="' + data.kelas + '"]').attr('selected', true)
                                    $('.kelas option[value="' + data.kelas + '"]').siblings().attr('selected', false)
                                }
                            })
                        })

                        $('.tambah').on('click', function() {
                            $('.input').html('Tambah Data')
                            $('input[name=nis').val('')
                            $('input[name="date"]').val('')
                            $('input[name="nama"]').val('')
                            $('input[name="alamat"]').val('')
                            $('input[name="kelas"]').val('')
                            $('input[name="hp"]').val('')
                            $('input[name="wali"]').val('')
                            $('input[name="spp"]').val('')
                        })

                        $('.addSiswa').on('submit', function(e) {
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
                                        success: function(data) {
                                            console.log(data)
                                            $('.loader').show()
                                            if (data.sukses) {
                                                ambilData()
                                                Swal.fire(
                                                    'Data berhasil terinput',
                                                    `${data.sukses}`,
                                                    'success'
                                                )
                                                $('#detail').modal('hide')
                                            } else {
                                                Swal.fire(
                                                    'Data berhasil terinput',
                                                    `${data.error}`,
                                                    'error'
                                                )
                                            }
                                        }
                                    })
                                }
                            })
                        });
                    })
                </script>