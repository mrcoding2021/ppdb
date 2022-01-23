<div class="col">
                                                <div class="form-group row">
                                                    <div class="col-sm-8">
                                                        <label for="1" class=" col-form-label">Nama Murid</label>
                                                        <input type="text" autofocus class="form-control" name="nama" id="nama_siswa">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <?php
                                                        $ta = '2016-2017'; ?>
                                                        <label for="1" class="col-form-label">Tahun Ajaran</label>
                                                        <select type="text" class="form-control ta" name="ta">
                                                            <option value="0">Pilih</option>
                                                            <?php $n = 16;
                                                            $m = 17;
                                                            for ($i = 0; $i < 15; $i++) { ?>
                                                                <option value="20<?= $n . '-20' . $m ?>">20<?= $n . '-20' . $m ?></option>
                                                            <?php $n++;
                                                                $m++;
                                                            } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label for="1" class="col-form-label">NIS</label>
                                                        <input type="text" readonly class="form-control nis" name="nis">
                                                        <input type="hidden" readonly class="form-control id_murid" name="id_murid">
                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered text-center" id="persiswa" width="100%" cellspacing="0">
                                                        <thead class="bg-dark text-white">
                                                            <tr>
                                                                <th rowspan="2">No</th>
                                                                <th rowspan="2">Tanggal</th>
                                                                <th colspan="7">Jumlah Pembayaran</th>
                                                                <th rowspan="2">Jumlah</th>
                                                                <th rowspan="2" width="12%">Aksi</th>
                                                            </tr>
                                                            <tr>
                                                                <th>PEMBANGNAN</th>
                                                                <th>KEGIATAN</th>
                                                                <th>SERAGAM</th>
                                                                <th>KOMITE</th>
                                                                <th>BUKU PAKET</th>
                                                                <th>SPP</th>
                                                                <th>SARPARAS</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
              
                <script>

                    $('.ta').change(function(e) {
                        e.preventDefault()
                        var id = $('.id_murid').val()
                        var ta = $(this).val()
                        getPersiswa(id, ta)
                    })

                    function getPersiswa(id, ta) {
                        var persiswa = $('#persiswa').DataTable({
                            'ajax': {
                                "type": "POST",
                                "url": '<?= base_url('pembayaran/getPerSiswa/') ?>' + id + '/' + ta,
                                "dataSrc": ""
                            },
                            'destroy': true,
                            "order": [
                                [1, "asc"]
                            ],
                            'columns': [{
                                    "data": "no"
                                },
                                {
                                    "data": "tgl"
                                },
                                {
                                    "data": "pembangunan"
                                },
                                {
                                    "data": "kegiatan"
                                },
                                {
                                    "data": "seragam"
                                },
                                {
                                    "data": "komite"
                                },
                                {
                                    "data": "buku_paket"
                                },
                                {
                                    "data": "spp"
                                },
                                {
                                    "data": "sarpras"
                                },
                                {
                                    "data": "jumlah"
                                },
                                {
                                    "data": "jumlah",
                                    "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                                        $(nTd).html("<a data-toggle='modal' class='mr-1 more btn btn-info btn-sm' href='#more' data-id=" + oData.inv + "><i class='fa fa-search'></i></a><a target='_blank' class='mr-1 btn btn-success btn-sm' href='<?= base_url('cetak/invoice/') ?>" + oData.inv + "'><i class='fa fa-print'></i></a><a data-id=" + oData.inv + " class='delete mr-1 btn btn-danger btn-sm' href='#'><i class='fa fa-times'></i></a>");
                                    },
                                    "className": 'details-control',
                                    "orderable": true,
                                    "data": null,
                                    "defaultContent": ''
                                },
                            ]
                        });


                    }

                    
                </script>