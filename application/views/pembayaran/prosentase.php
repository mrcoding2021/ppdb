<div class="mb-3 row">
    <div class="col-sm-2">
        <?php
        $ta = '2016-2017'; ?>
        <label for="1" class="col-form-label">Tahun Ajaran</label>
        <select type="text" class="form-control" id="taProsentase" name="ta">
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
<div class="table-responsive">
    <table class="table table-bordered text-center" width="100%" cellspacing="0">
        <thead class="bg-dark text-white">
            <tr>
                <th rowspan="2">Deskripsi</th>
                <th rowspan="2">TARIF SPP</th>
                <th colspan="12">PEMBAYARAN SPP</th>
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
            </tr>

        </thead>
        <tbody id="#Prosentasi">
        </tbody>
    </table>
</div>

<script>
    $('#taProsentase').change(function() {
        var ta = $(this).val()
        prosentase(ta)
    })
    
    var ta = $('#taProsentase').val()
    prosentase(ta)

    function prosentase(ta) {
        $.ajax({
            url: '<?= base_url('pembayaran/prosentase/') ?>' + ta,
            type: 'post',
            dataType: 'json',
            success: function(res) {
                var html = ''
                var budget = ['BUDGET', 'SPP JUMLAH SISWA BUDGET', 'AKTUAL', 'SPP', 'JUMLAH SISWA REALISASI', 'PROSENTASE BELLUM TERTAGIH', 'JUMLAH SISWA BELLUM TERTAGIH', 'JUMLAH BELUM TERTAGIH']
                for (let i = 0; i < 2; i++) {
                    html += '<tr>'
                    html += '<td>' + budget[i] + '</td><td>' + budget[i] + '</td><td>' + budget[i] + '</td>'
                    html += '<td>' + budget[i] + '</td><td>' + budget[i] + '</td><td>' + budget[i] + '</td>'
                    html += '<td>' + budget[i] + '</td><td>' + budget[i] + '</td><td>' + budget[i] + '</td>'
                    html += '<td>' + budget[i] + '</td><td>' + budget[i] + '</td><td>' + budget[i] + '</td>'
                    html += '<td>' + budget[i] + '</td><td>' + budget[i] + '</td>'
                    html += '</tr>'
                }
                $('#Prosentasi').html(html)
            }
        })
    }
</script>