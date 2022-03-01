                <!-- Begin Page Content -->
                <div class="table-responsive">
                    <div class="row mb-3">
                        <div class="col-sm-2">
                            <?php
                            $ta = '2016-2017'; ?>
                            <label for="1" class="col-form-label">Tahun Ajaran</label>
                            <select type="text" class="form-control taAllSPP" name="ta">
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
                    <table class="table table-bordered text-center" id="bayarSPP" width="100%" cellspacing="0">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th rowspan="2">No</th>
                                <th rowspan="2">Nama</th>
                                <th rowspan="2">TARIF SPP</th>
                                <th colspan="12">PEMBAYARAN SPP</th>
                                <td colspan="3">Jumlah</td>
                            </tr>
                            <tr>
                                <?php $a = 7;
                                for ($i = 1; $i <= 12; $i++) { ?>
                                    <td><?= bulan($a) ?></td>
                                <?php
                                    $a++;
                                    if ($a == 13) {
                                        $a = 1;
                                    }
                                } ?>
                                <td>Terbayar</td>
                                <td>Tagihan</td>
                                <td>Sisa Tagihan</td>
                            </tr>

                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

                <script>
                    $('.taAllSPP').change(function() {
                        var ta = $(this).val()
                        spp(ta)
                    })


                    function spp(ta) {
                        var bayarSPP = $('#bayarSPP').DataTable({
                            'ajax': {
                                "type": "POST",
                                "url": '<?= base_url('pembayaran/bayarSPP/') ?>' + ta,
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
                                    "data": "tarif"
                                },
                                {
                                    "data": "1"
                                },
                                {
                                    "data": "2"
                                },
                                {
                                    "data": "3"
                                },
                                {
                                    "data": "4"
                                },
                                {
                                    "data": "5"
                                },
                                {
                                    "data": "6"
                                },
                                {
                                    "data": "7"
                                },
                                {
                                    "data": "8"
                                },
                                {
                                    "data": "9"
                                },
                                {
                                    "data": "10"
                                },
                                {
                                    "data": "11"
                                },
                                {
                                    "data": "12"
                                },
                                {
                                    "data": "terbayar"
                                },
                                {
                                    "data": "tagihan"
                                },
                                {
                                    "data": "sisa"
                                },

                            ]
                        });


                    }
                </script>