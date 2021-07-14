                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <?php $this->load->view('admin/breadcrumb'); ?>


                    <div class="row">
                        <duv class="col-md-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 bg-dark ">
                                    <h3 class="m-0 text-white font-weight-bold "><?= $title ?>
                                        <a href="#tambah" class="btn input-ajaran-baru btn-success btn-border-circle float-right" data-toggle="modal">Tambah User</a>
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="table-responsive">
                                                <table class="table table-sm table-stripped  table-bordered" width="100%" cellspacing="0">
                                                    <thead class="bg-success text-white">
                                                        <tr>
                                                            <th>Kode Akses</th>
                                                            <th>Nama Akses</th>
                                                            <th>User</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="hakAkses">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="table-responsive">
                                                <table id="tableUser" class="table table-sm table-stripped table-bordered" width="100%" cellspacing="0">
                                                    <thead class="bg-primary text-white">
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama User</th>
                                                            <th>HP</th>
                                                            <th>Status</th>
                                                            <!-- <th>Aksi</th> -->
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
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
                    $.ajax({
                        url: '<?= base_url('akses/get') ?>',
                        type: 'post',
                        dataType: 'json',
                        success: function(res) {
                            console.log(res)
                            var html = ''
                            $.each(res, function(i, v) {
                                html += '<tr>'
                                html += '<td>' + v.id_akses + '</td><td>' + v.akses + '</td><td><a data-id="' + v.id_akses + '" class="userId badge badge-success" href="#">' + v.user + '</a></td><td>' + v.status + '</td>'
                                html += '</tr>'
                            })
                            $('#hakAkses').html(html)
                        }
                    })

                    $(document).on('click', '.userId', function(e) {
                        e.preventDefault()
                        var id = $(this).data('id')
                        getUser(id)
                    })

                    function getUser(id) {
                        var getUser = $('#tableUser').DataTable({
                            'ajax': {
                                "type": "POST",
                                "url": '<?= base_url('akses/user/') ?>' + id,
                                "dataSrc": ""
                            },
                            "destroy": true,
                            'columns': [{
                                    "data": "no"
                                },
                                {
                                    "data": "nama"
                                },
                                {
                                    "data": "hp"
                                },
                                {
                                    "data": "status",
                                    "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                                        $(nTd).html("<a class='mr-1 ubahStatus badge badge-info badge-border-circle btn-sm' href='#lihat' data-id=" + oData.id_user + " >" + oData.status + "</a>");
                                    }
                                }
                            ]
                        });
                    }

                    $(document).on('click', '.ubahStatus', function(e) {
                        e.preventDefault()
                        var id = $(this).data('id')
                        $.ajax({
                            url: '<?= base_url('akses/ubahStatus/') ?>'+id,
                            type: 'post',
                            dataType: 'json',
                            success: function(res) {
                                console.log(res)
                                getUser(id)
                            }
                        })
                    })
                </script>