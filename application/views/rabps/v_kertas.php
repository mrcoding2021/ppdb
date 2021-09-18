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
                                        <a href="<?= base_url('rabps/adds') ?>" class="btn input-ajaran-baru btn-success btn-border-circle float-right">Input Baru</a>
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <table class="table table-hover table-bordered">
                                        <thead class="bg-dark text-white text-center">
                                            <tr>
                                                <th scope="col" >#</th>
                                                <th scope="col" >Tahun Ajaran</th>
                                                <th scope="col" >Rencana Pemasukan</th>
                                                <th scope="col" >Rencana Pengeluaran</th>
                                                <th scope>Aksi</th>
                                            </tr>
                                            
                                        </thead>
                                        <tbody>
                                            <?php foreach ($rab as $key) :
                                                $this->db->where('ta', $key->ta);
                                                $this->db->where('kategori', 1);
                                                $this->db->select_sum('jumlah', 'total');
                                                $pemasukan = $this->db->get('tb_rab_kertas')->row();
                                                $this->db->where('ta', $key->ta);
                                                $this->db->where('kategori', 2);
                                                $this->db->select_sum('jumlah', 'total');
                                                $pengeluaran = $this->db->get('tb_rab_kertas')->row();
                                               
                                            ?>

                                                <tr class="text-center">
                                                    <td scope="row">1</td>
                                                    <td><?= $key->ta ?></td>
                                                    <td><?= rupiah($pemasukan->total) ?></td>
                                                    <td><?= rupiah($pengeluaran->total) ?></td>

                                                    <td><a href="<?= base_url('rabps/detailRencana/' . $key->ta) ?>" class="badge badge-primary mr-2">Lihat</a>
                                                    <!-- <a href="<?= base_url('rabps/hapusRab/' . $key->ta) ?>" class="hapus badge badge-danger">Hapus</a> -->
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </duv>
                    </div>


                </div>
                <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->
                <script>
                    $('.hapus').click(function(e) {
                        e.preventDefault()
                        Swal.fire({
                            title: "Yakin ingin dihapus?",
                            text: "Data ini akan terhapus permanen !",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Yes",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: $(this).attr('href'),
                                    dataType: 'json',
                                    type: 'POST',
                                    success: function(response) {
                                        window.location.href = '<?= base_url('rabps/rencana') ?>'
                                    }
                                })
                            }
                        });
                    })
                </script>