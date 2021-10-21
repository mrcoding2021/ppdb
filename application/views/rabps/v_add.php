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
                                        <a href="<?= base_url('rabps/rencana/') ?>" class="btn input-ajaran-baru btn-success btn-border-circle float-right">Kembali</a>

                                    </h3>
                                </div>
                                <div class="card-body">
                                    <?php
                                    if ($ta == null) {
                                        $ta = '2016-2017'; ?>
                                        <div class="col-sm-4">
                                            <label>Tahun Ajaran</label>
                                            <select name="ta" class="ta form-control">
                                                <?php $query = 'SELECT ta FROM tb_user_tagihan GROUP BY ta';
                                                $tas = $this->db->query($query)->result();
                                                foreach ($tas as $key) : ?>
                                                    <option <?= (substr($key->ta, 5) == date('Y')) ? 'selected' : '' ?> value="<?= $key->ta ?>"><?= $key->ta ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    <?php  }
                                    ?>

                                    <div class="row mt-3">
                                        <?php
                                        $no = 7;
                                        for ($i = 0; $i < 12; $i++) {
                                            if ($i == 6) {
                                                $no = 1;
                                            }
                                        ?>
                                            <div class="col-xl-3 col-md-6 mb-4">
                                                <div class="card border-left-primary shadow h-100 py-2">
                                                    <div class="card-body">
                                                        <div class="row no-gutters align-items-center">
                                                            <div class="col mr-2">
                                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= bulan($no) ?></div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <a href="<?= base_url('rabps/' . $cara . '/' . $ta . '/' . $no) ?>" class="link btn btn-sm btn-primary" data-id="<?= $no ?>">Input</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php $no++;
                                        } ?>
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
                    $('.ta').change(function(e) {
                        e.preventDefault()
                        var ta = $(this).val()
                        console.log(ta);

                        for (let i = 0; i < 12; i++) {
                            var id = $('.link').eq(i).data('id')
                            console.log(id);
                            $('.link').eq(i).attr('href', '<?= base_url('rabps/tambah/') ?>' + ta + '/' + id)
                        }

                    })
                </script>