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
                                        <a href="<?= base_url('rabps/rencana') ?>" class="btn input-ajaran-baru btn-success btn-border-circle float-right">Kembali</a>
                                        <a href="<?= base_url('rabps/tambah') ?>" class="btn input-ajaran-baru btn-primary btn-border-circle float-right">Input Baru</a>
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <?php
                                    if ($ta == null) {
                                        $ta = '2016-2017'; ?>
                                        <div class="col-sm-4">
                                            <label>Tahun Ajaran</label>
                                            <select name="" id="ta" class=" form-control">
                                                <?php foreach ($thn_ajaran as $key) : ?>
                                                    <option <?= ($key->ta == $ta) ? 'selected' : '' ?> value="<?= $key->ta ?>"><?= $key->ta ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    <?php  }
                                    ?>
                                    <ul class="nav nav-pills nav-justified mt-3" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">RABPS Peasukaan</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">RABPS Pengeluaran</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content mt-3" id="myTabContent">

                                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <div class="row">
                                                <?php for ($i = 0; $i < 12; $i++) { ?>
                                                    <div class="col-xl-3 col-md-6 mb-4">
                                                        <div class="card border-left-primary shadow h-100 py-2">
                                                            <div class="card-body">
                                                                <div class="row no-gutters align-items-center">
                                                                    <div class="col mr-2">
                                                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= bulan($i + 1) ?></div>
                                                                    </div>
                                                                    <div class="col-auto">
                                                                        <a href="<?= base_url('rabps/tambah') ?>" class="btn btn-sm btn-primary">Input</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>


                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                            <div class="row">
                                                <?php for ($i = 0; $i < 12; $i++) { ?>
                                                    <div class="col-xl-3 col-md-6 mb-4">
                                                        <div class="card border-left-primary shadow h-100 py-2">
                                                            <div class="card-body">
                                                                <div class="row no-gutters align-items-center">
                                                                    <div class="col mr-2">
                                                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= bulan($i + 1) ?></div>
                                                                    </div>
                                                                    <div class="col-auto">
                                                                        <a href="<?= base_url() ?>" class="btn btn-sm btn-primary">Input</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>


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

                <script>
                    $(document).ready(function() {

                        $('input[name="ta"]').val('<?= $ta ?>')
                        $('#ta').change(function() {
                            var ta = $(this).find('option:selected').text()
                            console.log(ta)
                            $('input[name="ta"]').val(ta)
                        })
                        $('form').submit(function(e) {
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
                                            if (response.sukses) {
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: 'Berhasil',
                                                    html: `${response.sukses}`
                                                })
                                            } else {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Gagal!',
                                                    html: `${response.error}`
                                                })
                                            }

                                        }
                                    })
                                }
                            });
                        })
                    })
                </script>