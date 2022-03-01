                <!-- Begin Page Content -->
                <div class="table-responsive">
                    <div class="row mb-3">
                        <div class="col-sm-2">
                            <?php
                            $ta = '2016-2017'; ?>
                            <label for="1" class="col-form-label">Tahun Ajaran</label>
                            <select type="text" class="form-control taAll" name="ta">
                                <option value="0">Pilih</option>
                                <?php $n = 16;
                                $m = 17;
                                for ($i = 0; $i < 15; $i++) { ?>
                                    <option <?= ($n == 21 && $m == 22) ? 'selected' : '' ?> value="20<?= $n . '-20' . $m ?>">20<?= $n . '-20' . $m ?></option>
                                <?php $n++;
                                    $m++;
                                } ?>
                            </select>
                        </div>
                    </div>
                    <table class="table table-bordered text-center" id="allSiswa" width="100%" cellspacing="0">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th rowspan="2">No</th>
                                <th rowspan="2">Nama</th>
                                <th colspan="3">PEMBANGNAN</th>
                                <th colspan="3">KEGIATAN</th>
                                <th colspan="3">SERAGAM</th>
                                <th colspan="3">KOMITE</th>
                                <th colspan="3">BUKU PAKET</th>
                                <th colspan="3">SPP</th>
                                <th colspan="3">SARPARAS</th>
                                <th rowspan="2">Jumlah</th>
                            </tr>
                            <tr>
                                <?php for ($i = 0; $i < 7; $i++) { ?>
                                    <td>Tagihan</td>
                                    <td>Pembayaran</td>
                                    <td>Sisa</td>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

                <script>
                    $('.taAll').change(function() {
                        var ta = $(this).val()
                        getAllSiswa(ta)
                    })


                    function getAllSiswa(ta) {
                        var allSiswa = $('#allSiswa').DataTable({
                            'ajax': {
                                "type": "POST",
                                "url": '<?= base_url('pembayaran/allPerSiswa/') ?>' + ta,
                                "dataSrc": ""
                            },
                            'destroy': true,
                            'columns': [{
                                    "data": "no"
                                },
                                {
                                    "data": "nama"
                                },
                                {
                                    "data": "tag_pembangunan"
                                },
                                {
                                    "data": "pem_pembangunan"
                                },
                                {
                                    "data": "sisa_pembangunan"
                                },
                                {
                                    "data": "tag_kegiatan"
                                },
                                {
                                    "data": "pem_kegiatan"
                                },
                                {
                                    "data": "sisa_kegiatan"
                                },
                                {
                                    "data": "tag_seragam"
                                },
                                {
                                    "data": "pem_seragam"
                                },
                                {
                                    "data": "sisa_seragam"
                                },
                                {
                                    "data": "tag_komite"
                                },
                                {
                                    "data": "pem_komite"
                                },
                                {
                                    "data": "sisa_komite"
                                },
                                {
                                    "data": "tag_buku"
                                },
                                {
                                    "data": "pem_buku"
                                },
                                {
                                    "data": "sisa_buku"
                                },
                                {
                                    "data": "tag_spp"
                                },
                                {
                                    "data": "pem_spp"
                                },
                                {
                                    "data": "sisa_spp"
                                },
                                {
                                    "data": "tag_sarpras"
                                },
                                {
                                    "data": "pem_sarpras"
                                },
                                {
                                    "data": "sisa_sarpras"
                                },
                                {
                                    "data": "jumlah"
                                }
                            ]
                        });

                        var ta = $('.taAllSPP').val()
                        spp(ta)

                    }
                </script>