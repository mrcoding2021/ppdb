<!-- Footer -->


<footer class="sticky-footer bg-white">

    <div class="container my-auto">

        <div class="copyright text-center my-auto">

            <span>Sistem Pembayaran @ SDIT Insan Mulia Bekasi <?= date('Y') ?></span>

        </div>

    </div>

</footer>

<!-- End of Footer -->



</div>

<!-- End of Content Wrapper -->



</div>

<!-- End of Page Wrapper -->



<!-- Scroll to Top Button-->

<a class="scroll-to-top rounded" href="#page-top">

    <i class="fas fa-angle-up"></i>

</a>



<!-- Logout Modal-->

<div class="modal fade" id="addSlider" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">Tambah Slider Baru</h5>

                <button class="close" type="button" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">×</span>

                </button>

            </div>



            <div class="modal-body">

                <form action="<?= base_url('sider/addSlider') ?>" method="post">

                    <div class="form-group row">

                        <label for="1" class="col-sm-2 col-form-label">Nama Slider</label>

                        <div class="col-sm-10">

                            <input type="text" class="form-control" id="1" name="nama">

                        </div>

                    </div>

                    <div class="form-group row">

                        <label for="2" class="col-sm-2 col-form-label">Image</label>

                        <div class="col-sm-10">

                            <div class="input-group mb-0">

                                <div class="input-group-prepend">

                                    <span class="input-group-text">Upload</span>

                                </div>

                                <div class="custom-file">

                                    <input type="file" class="custom-file-input" id="upload">

                                    <label class="custom-file-label" for="upload" name="gambar">Choose file</label>

                                </div>

                            </div>>

                        </div>

                    </div>

                    <div class="form-group row">

                        <label for="3" class="col-sm-2 col-form-label">Icon</label>

                        <div class="col-sm-10">

                            <input type="text" class="form-control" id="3" name="icon">

                        </div>

                    </div>

                    <div class="form-group row">

                        <label for="4" class="col-sm-2 col-form-label">Link</label>

                        <div class="col-sm-10">

                            <input type="text" class="form-control" id="4" name="link">

                        </div>

                    </div>

                    <div class="modal-footer">



                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                        <button type="submit" class="btn btn-primary">Input</button>

                    </div>

                </form>

            </div>



        </div>

    </div>

</div>



<!-- Bootstrap core JavaScript-->



<script src="<?= base_url() ?>asset/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>



<!-- Core plugin JavaScript-->

<script src="<?= base_url() ?>asset/admin/vendor/jquery-easing/jquery.easing.min.js"></script>



<!-- Custom scripts for all pages-->

<script src="<?= base_url() ?>asset/admin/js/sb-admin-2.min.js"></script>


<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script script src="<?= base_url() ?>asset/admin/js/my.js">
</script>
<script>
    function number_format(number, decimals, dec_point, thousands_sep) {
        // *     example: number_format(1234.56, 2, ',', ' ');
        // *     return: '1 234,56'
        number = (number + '').replace(',', '').replace(' ', '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }

    // cari data siswa berdasarkan nama
    $(function() {
        var n = $('#nama_siswa').val()
        $('#nama_siswa').autocomplete({
            source: function(request, respons) {
                $.ajax({
                    url: '<?= base_url('pembayaran/cariX') ?>',
                    data: {
                        'nama': request.term
                    },
                    dataType: 'json',
                    success: function(data) {
                        var hasil = $.map(data, function(obj) {
                            return obj.nama
                        })
                        respons(hasil)
                    }
                })
            },
            select: function(event, ui) {
                $.ajax({
                    url: '<?= base_url('data/getId') ?>',
                    data: {
                        'nama': ui.item.value,
                    },
                    dataType: 'json',
                    type: 'post',
                    success: function(res) {
                        console.log(res)
                        var inv = $('#inv').html()
                        iuranLunas(res.id_user)
                        iuranHutang(res.id_user)
                        $('input[name="no_invoice"]').val(inv)
                        $('input[name="kelas"]').val(res.kelas)
                        $('input[name="hp"]').val(res.hp)
                        $('input[name="nis"]').val(res.nis)
                        $('input[name="nisn"]').val(res.nisn)
                        $('input[name="wali"]').val(res.wali)
                        if (inv != undefined) {
                            $('.cetak-invoice').attr('href', '<?= base_url('cetak/invoice/') ?>' + inv.replace(/\s+/g, ''))
                        }
                    }
                })
            },
            minLength: 1,
            classes: {
                'ui-autocomplete': 'highlight'
            }

        })
    })

    $('select[name="ta"]').change(function() {
        var isi = $(this).val()
        $('input[name="ta"]').val(isi)
    })

    function iuranLunas(id) {
        $.ajax({
            url: '<?= base_url('tunggakan/lunas') ?>',
            type: 'post',
            dataType: 'json',
            data: {
                'id': id
            },
            success: function(res) {

                var html = ''
                $.each(res, function(i, v) {
                    html += '<tr>'
                    html += '<td>' + v.no + '</td><td>' + v.ta + '</td><td>' + v.pembangunan + '</td><td>' + v.kegiatan + '</td><td>' + v.seragam + '</td><td>' + v.komite + '</td><td>' + v.buku_paket + '</td><td>' + v.spp + '</td><td>' + v.total + '</td>'
                    html += '</tr>'
                })
                $('#tunggakan-terbayar').html(html)
            }
        })
    }

    function iuranHutang(id) {
        $.ajax({
            url: '<?= base_url('tunggakan/hutang') ?>',
            type: 'post',
            dataType: 'json',
            data: {
                'id': id
            },
            success: function(res) {
                var html = ''
                $.each(res, function(i, v) {
                    html += '<tr>'
                    html += '<td>' + v.no + '</td><td>' + v.ta + '</td><td>' + v.pembangunan + '</td><td>' + v.kegiatan + '</td><td>' + v.seragam + '</td><td>' + v.komite + '</td><td>' + v.buku_paket + '</td><td>' + v.spp + '</td><td>' + v.total + '</td>'
                    html += '</tr>'
                })
                $('#tunggakan-hutang').html(html)
            }
        })
    }

    function ubah_id() {
        var inv = $('#inv').html()
        // var inv = invoice.replace('INV-', '')
        var i = inv.split('.')
        var t = Number(i[0]) + 1
        var h = t + '.' + i[1]
        $('#inv').attr('data-id', t)
        $('#inv').html(h)
        $('input[name="inv"]').val(h)
    }

    $('.input-baru').on('click', function(e) {
        e.preventDefault()
        $('input[name="nama"]').val('')
        $('input[name="name"]').val('')
        $('input[name="nama"]').focus()
        $('input[name="name"]').focus()
        $('input[name="kelas"]').val('')
        $('input[name="nis"]').val('')
        $('input[name="wali"]').val('')
        $('input[name="kat_murid"]').val('')
        $('textarea[name="ket"]').val('')
        $('input[name="jumlah"]').val('')
        $('#inputan').html('')
        $('#table-pemasukan').html('')
        $('#table-pengaluaran').html('')
        $('.baru').remove()
        ubah_id()
    })
    $('.showr').hide()
    $('.input-bayar').on('click', function(e) {
        e.preventDefault()
        var id = $('input[name="id_user"]').val()
        var kategori = $('.kategori').val()
        var sumber = $('.sumber').val()
        var jumlah = $('.jumlah').val()
        var ket = $('textarea[name="ket"]').val()
        var inv = $('#inv').html()
        // var inv = invoice.replace('INV-', '')
        var i = inv.split('.')
        var t = Number(i[0])
        var data = {
            'invoice': t,
            'id_murid': id,
            'kategori': kategori,
            'sumber': sumber,
            'jumlah': jumlah,
            'ket': ket
        }


    })


    $('#close').on('click', function() {
        $('#inputan').html('')
    })

    $('.input-item-baru').click(function(e) {
        e.preventDefault()
        $('#table-bayar').append(`
            <tr class="baru">
                                                    <td >
                                                        <select name="kategori[]" data-id="1" class="kategori form-control form-control-sm">
                                                           <?php
                                                            $this->db->where('kategori', 1);
                                                            $this->db->where('parent', 0);
                                                            $kategori = $this->db->get('tb_rab')->result();
                                                            foreach ($kategori as $key) : ?>
                                                                    <option data-id="<?= $key->id ?>" value="<?= $key->id ?>"><?= $key->nama ?>
                                                                    </option>
                                                                    <?php
                                                                    $this->db->where('kategori', 1);
                                                                    $this->db->where('parent', $key->id);
                                                                    $kategori = $this->db->get('tb_rab')->result();
                                                                    foreach ($kategori as $a) : ?>
                                                                        <option data-id="<?= $a->id ?>" value="<?= $a->id ?>">--- <?= $a->nama ?>
                                                                        </option>
                                                                    <?php endforeach ?>
                                                                <?php endforeach ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="sumber[]" data-id="1" class="sumber form-control form-control-sm">
                                                            <?php $sumber = $this->db->get('tb_sumber')->result();
                                                            foreach ($sumber as $key) : ?>
                                                                <option value="<?= $key->id_sumber ?>"><?= $key->nama ?>
                                                                </option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </td>
                                                     <td>
                                                        <input type="text" placeholder="0" class="form-control ket form-control-sm" name="ket[]">
                                                       
                                                    </td>
                                                     <td> <input type="text"  placeholder="" class="form-control kredit form-control-sm" name="kredit[]">
                                                     </td>
                                                     <td> <input type="text"  placeholder="" class="form-control diskon form-control-sm" name="diskon[]">
                                                     </td>
                                                     <td>
                                                        <input type="text" placeholder="0" required class="form-control total form-control-sm" readonly name="total[]">
                                                       
                                                    </td>
                                                    <td>
                                                        <a href="#" class="btn btn-danger btn-sm hapus-item">x</a>
                                                    </td>
                                                </tr>
            `)
    })

    $(document).on('click', '.hapus-item', function(e) {
        e.preventDefault()
        $(this).parents('tr').remove()
        grandTotal()
    })

    $(document).on('keyup', '.diskon', function() {
        var kredit = $(this).parents('tr').find('.kredit').val()
        $(this).parents('tr').find('.total').val(kredit - $(this).val())
        grandTotal()
    })

    $(document).on('keyup', '.kredit', function() {
        var diskon = $(this).parents('tr').find('.diskon').val()
        $(this).parents('tr').find('.total').val($(this).val() - diskon)
        grandTotal()
    })

    grandTotal()

    function numberFormat(num) {
        return 'Rp ' + num.toFixed(0).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }

    function grandTotal() {
        var sum = 0

        $('#table-bayar tr').each(function() {
            var total = $(this).find('.total').val()
            sum = parseInt(sum) + parseInt(total)
        })
        sum = numberFormat(sum)
        $('#grandTotal').text(sum)
    }

    $('.inputData').submit(function(e) {
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
                                title: 'Berasil',
                                html: `${response.sukses}`
                            })
                        }

                    }
                })
            }
        });
    })
</script>
</body>



</html>