          
           <!-- Begin Page Content -->
           <div class="container-fluid">
               <div class="row">
                   <duv class="col-md-12">
                       <?php $this->load->view('admin/breadcrumb'); ?>
                       <div class="card shadow mb-4">
                           <div class="card-header py-3 bg-dark ">
                               <h3 class="m-0 text-white font-weight-bold ">Input
                                   <?= $title;
                                    if ($user['level'] == 1) : ?> <a href="#uploadMutasi" class="btn btn-primary  btn-border-circle float-right" data-toggle="modal">Upload Data</a><?php endif ?><a href="#" class="btn btn-success input-baru btn-border-circle float-right">Input Baru</a></h3>
                           </div>
                           <div class="card-body">
                               <div class="col">
                                   <table class="table table-bordered">
                                       <tr>
                                           <td>
                                               <h4>
                                                   No. Invoice :
                                               </h4>

                                           </td>
                                           <td>
                                               <?php $this->db->order_by('id_pembayaran', 'desc');
                                                $inv = $this->db->get('tb_pembayaran')->row();
                                                $d = 1 . '.' . str_replace('-', '', date('Y-m-d'));
                                                $date = str_replace('-', '', date('Y-m-d')) ?>
                                               <h4 class="pl-1" id="inv">
                                                   <?php
                                                    if ($inv == null) {
                                                        echo $d;
                                                    } else {
                                                        $e = intval($inv->no_invoice) + 1;
                                                        echo $e . '.' . $date;
                                                    }; ?>
                                               </h4>

                                           </td>
                                           <td class="bg-warning text-white">
                                               <h4>Total Bayar :</h4>
                                           </td>
                                           <td class="bg-warning text-white" width="30%">
                                               <h4 id="grandTotal">0</h4>
                                           </td>
                                       </tr>
                                   </table>
                                   <div class="form-group row">
                                       <label for="1" class="col-sm-2 col-form-label">Diterima Dari</label>
                                       <div class="col-sm-7">
                                           <input type="text" autofocus class="form-control" name="nama" id="nama_siswa">
                                       </div>
                                       <div class="col-sm-3">
                                           <input type="text" class="form-control" name="hp" readonly>
                                       </div>
                                   </div>
                                   <div class="form-group row">
                                       <label for="1" class="col-sm-1 col-form-label">Metode</label>
                                       <div class="col-sm-2">
                                           <select name="metode" data-id="1" class=" form-control sumber">
                                               <?php $sumber = $this->db->get('tb_sumber')->result();
                                                foreach ($sumber as $key) : ?>
                                                   <option value="<?= $key->id_sumber ?>"><?= $key->nama ?>
                                                   </option>
                                               <?php endforeach ?>
                                           </select>
                                       </div>

                                       <label for="1" class="col-sm-2 col-form-label">Jenis Pemasukan</label>
                                       <div class="col-sm-4">
                                           <select name="masukan" class="form-control masukan">
                                               <option value="0">Pilih Nama Akun</option>
                                               <?php foreach ($akunPemasukan as $key) { ?>
                                                   <option value="<?= $key->kode_akun ?>" data-alias="<?= $key->alias ?>" data-parent="<?= $key->parent ?>" data-nama="<?= $key->nama ?>"><?= $key->kode_akun . ' - ' . $key->nama ?></option>
                                                   <?php
                                                    $this->db->where('parent', $key->id);
                                                    $this->db->where('kategori', 1);
                                                    $masuk = $this->db->get('tb_rab')->result();
                                                    foreach ($masuk as $mas) { ?>
                                                       <option value="<?= $mas->kode_akun ?>" data-alias="<?= $mas->alias ?>" data-parent="<?= $mas->parent ?>" data-nama="<?= $mas->nama ?>">---<?= $mas->kode_akun . ' - ' . $mas->nama ?></option>
                                                   <?php } ?>
                                               <?php } ?>
                                           </select>
                                           <input type="hidden" name="id_pemasukan">
                                           <input type="hidden" name="parent">
                                       </div>
                                       <label for="1" class="col-sm-1 col-form-label">Jumlah</label>
                                       <div class="col-sm-2">
                                           <input type="text" autofocus class="form-control" name="jumlah">
                                       </div>
                                   </div>
                                   <div class="form-group row">
                                       <label for="1" class="col-sm-1 col-form-label">Keterangan</label>
                                       <div class="col-sm-4">
                                           <textarea type="text" class="form-control" name="ket"></textarea>
                                       </div>

                                       <label for="1" class="col-sm-1 col-form-label">Ke Kas</label>
                                       <div class="col-sm-2">
                                           <select name="dr_kas" class="form-control">
                                               <?php
                                                $this->db->where('kategori', 3);
                                                $kas = $this->db->get('tb_rab')->result();
                                                foreach ($kas as $key) : ?>
                                                   <option value="<?= $key->id ?>"><?= $key->nama ?>
                                                   </option>
                                               <?php endforeach ?>
                                           </select>
                                       </div>
                                       <label for="1" class="col-sm-2 col-form-label">Tahun Ajaran</label>
                                       <div class="col-sm-2">
                                           <select name="ta" id="ta" class="form-control">
                                               <?php $this->db->group_by('ta');
                                                $ta = $this->db->get('tb_ta')->result();
                                                foreach ($ta as $key) : ?>
                                                   <option value="<?= $key->ta ?>"><?= $key->ta ?></option>
                                               <?php endforeach; ?>
                                           </select>
                                       </div>
                                   </div>
                                   <div class="form-group row-cols-lg-4">
                                       <a href="#" class="btn btn-info btn-sm input-pemasukan btn-border-circle" data-id=""> Tambah Item </a>
                                   </div>
                               </div>
                               <div class="table-responsive">
                                   <form action="<?= base_url('pemasukan/inputData') ?>" class="inputPemasukan" method="POST">
                                       <table class="table table-bordered table-sm" width="100%" cellspacing="0">
                                           <thead class="bg-success text-white">
                                               <tr>
                                                   <th>Kode Akun</th>
                                                   <th>Metode</th>
                                                   <th width="30%">Keterangan</th>
                                                   <th>Nilai</th>
                                                   <th>Diskon</th>
                                                   <th>Jumlah</th>
                                                   <th>Aksi</th>
                                               </tr>
                                           </thead>
                                           <input type="hidden" value="<?= $d ?>" class="form-control" name="inv">
                                           <input type="hidden" value="1" class="form-control" name="id_user">
                                           <input type="hidden" value="1" class="form-control" name="kategori_murid">
                                           <input type="hidden" value="2020-2021" class="form-control" name="t_a">
                                           <input type="hidden" value="1" class="form-control" name="dari_kas">
                                           <input type="hidden" value="-" class="form-control" name="metode">
                                           <tbody id="table-bayar">
                                           </tbody>
                                           <tr class="bg-gray-300">
                                               <td colspan="7"><button type="submit" class="btn btn-success btn-sm  btn-border-circle ml-2"> Simpan Semua Data </button><a href="" target="__blank" class="cetak-invoice  btn btn-primary btn-sm  btn-border-circle"> Cetak Invoice </a></td>
                                           </tr>
                                       </table>
                                   </form>
                               </div>
                           </div>
                       </div>
                   </duv>
               </div>


           </div>
           <!-- /.container-fluid -->

           </div>



           <script>
               $('.input-pemasukan').click(function(e) {
                   e.preventDefault()
                   ubah_id()
                   var id = $('select[name="masukan"]')
                   var parent = $('input[name="parent"]')
                   var name = $('input[name="name"]')
                   var jumlah = $('input[name="jumlah"]')
                   var sumber = $('.sumber').val()
                   $('input[name="metode"]').val(sumber)
                   $('input[name="t_a"]').val($('select[name="ta"]').val())
                   var ket = $('textarea[name="ket"]')
                   var dr_kas = $('select[name="dr_kas"]').val()
                   $('input[name="dari_kas"]').val(dr_kas)
                   var html = ''
                   html += '<tr><td><input type="text" readonly class="form-control form-control-sm" name="id[]" value="' + id.val() + '"></td><td><input type="text" class="form-control form-control-sm" name="cara[]" value="' + $('.sumber option:selected').text() + '"></td><td><input type="text" class="form-control form-control-sm" name="kets[]" value="' + $('.masukan option:selected').data('alias') + ' ' + $('.masukan option:selected').data('nama') + '"><input type="hidden" class="form-control form-control-sm" name="alias[]" value="' + $('.masukan option:selected').data('alias') + '"><input type="hidden" class="form-control form-control-sm" name="parent[]" value="' + $('.masukan option:selected').data('parent') + '"></td><td><input type="text" class="form-control form-control-sm kredit" name="nilai[]" value="' + jumlah.val() + '"></td><td><input type="text" class="form-control form-control-sm diskon" name="diskon[]" value="0"></td><td><input type="text" class="form-control form-control-sm total" readonly name="jumlah[]" value="' + jumlah.val() + '"></td><td><a href="#" class="btn btn-danger btn-sm hapus-item">x</a></td></tr>'
                   $('#table-bayar').append(html)
                   grandTotal()
                   id.val('')
                   name.val('')
                   jumlah.val('')
                   ket.val('')
                   name.focus()
               })

               $('.inputPemasukan').submit(function(e) {
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
                                   console.log(response)
                                   var inv = $('input[name="inv"]').val()
                                   if (response.sukses) {
                                       if (inv != undefined) {
                                           $('.cetak-invoice').attr('href', '<?= base_url('cetak/pemasukan/') ?>' + inv.replace(/\s+/g, ''))
                                       }
                                       Swal.fire({
                                           icon: 'success',
                                           title: 'Berasil',
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
           </script>