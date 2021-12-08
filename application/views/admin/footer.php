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







<script src="<?= base_url() ?>asset/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>



<!-- Core plugin JavaScript-->

<script src="<?= base_url() ?>asset/admin/vendor/jquery-easing/jquery.easing.min.js"></script>



<!-- Custom scripts for all pages-->

<script src="<?= base_url() ?>asset/admin/js/sb-admin-2.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</script>
<script>
    // cari data siswa berdasarkan nama
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
                    var title = '<?= $title ?>'
                    if (title == 'Input Tabungan') {
                        getTabungan(res.id_user)
                        $('#exportData').attr('href', '<?= base_url('tabungan/exportData/') ?>' + res.id_user)
                    }
                    // getTa(res.id_user, '2016-2017')
                    console.log(res)
                    var inv = $('#inv').html()
                    iuranLunas(res.id_user)
                    iuranHutang(res.id_user)
                    $('input[name="id_murid"]').val(res.id_user)
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


    $('select[name="ta"]').change(function() {
        var isi = $(this).val()
        $('input[name="ta"]').val(isi)
    })

    function iuranLunas(id) {
        $.ajax({
            url: '<?= base_url('tunggakan/lunas/') ?>'+id,
            type: 'post',
            dataType: 'json',
            success: function(res) {
                console.log(res);

                var html = ''
                $.each(res, function(i, v) {
                    html += '<tr>'
                    html += '<td>' + v.no + '</td><td>' + v.ta + '</td><td>' + (v.pembangunan) + '</td><td>' + v.kegiatan + '</td><td>' + v.seragam + '</td><td>' + v.komite + '</td><td>' + v.buku_paket + '</td><td>' + v.spp + '</td><td>' + v.sarpras + '</td><td>' + v.total + '</td>'
                    html += '</tr>'
                })
                $('#tunggakan-terbayar').html(html)
                $('#cetakTunggakan').attr('href', '<?= base_url('cetak/tunggakan/') ?>' + id)
            }
        })
    }

    function iuranHutang(id) {
        $.ajax({
            url: '<?= base_url('tunggakan/hutang/') ?>'+id,
            type: 'post',
            dataType: 'json',
            data: {
                'id': id
            },
            success: function(res) {
                console.log(res);

                var html = ''
                $.each(res, function(i, v) {
                    html += '<tr>'
                    html += '<td>' + v.no + '</td><td>' + v.ta + '</td><td>' + (v.pembangunan) + '</td><td>' + (v.kegiatan) + '</td><td>' + (v.seragam) + '</td><td>' + (v.komite) + '</td><td>' + (v.buku_paket) + '</td><td>' + (v.spp) + '</td><td>' + (v.sarpras) + '</td><td>' + (v.total) + '</td>'
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
        inputBaru()
    })

    function inputBaru() {
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
    }
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
        return num.toFixed(0).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
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