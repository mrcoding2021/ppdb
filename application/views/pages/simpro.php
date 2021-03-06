 <section id="inner-headline">
     <div class="container">
         <div class="row">
             <div class="span8">
                 <div class="inner-heading">
                     <h2><?= $title ?></h2>
                 </div>
             </div>
             <div class="span4">
                 <ul class="breadcrumb">
                     <li><a href="#"><i class="icon-home"></i></a><i class="icon-angle-right"></i></li>
                     <li><a href="#"><?= $parent ?></a><i class="icon-angle-right"></i></li>
                     <li class="active"><?= $title ?></li>
                 </ul>
             </div>
         </div>
     </div>
 </section>
 <section id="content">
     <div class="container">
         <div class="row">
             <div class="span4">
                 <?php $this->load->view('template/sidebar'); ?>
             </div>
             <div class="span8">
                 <article>
                     <div class="row">
                         <div class="span8">
                             <div class="post-image">
                                 <img src="<?= base_url('asset/img/post/')  ?>simprofoto.jpg" alt="" width="100%" />
                             </div>
                             <div class="span3">
                                 <img src="<?= base_url('asset/img/post/')  ?>simpro2.jpg" alt="" width="100%" />
                             </div>
                             <div class="span4">

                                 <h4><?= $title ?></h4>
                                 <p>
                                     Simpanan Produktif (SIMPRO) Adalah simpanan Produktif Anggota yang dikelola secara syariah dengan bagi hasil yang produktif setiap bulannya. Di setor minimal sebesar Rp.5.000,000,- dengan spesial nisbah bagi hasil 52,5% perbulan dalam jangka waktu simpanan 3,6,12 bulan bersifat Roll Over saat jangka waktu berakhir.


                                 </p>
                             </div>
                             <hr>
                             <div class="span4">

                                 <h4>Akad Syariah</h4>
                                 <p><strong>Mudharobah</strong> adalah pemilik modal menyerahkan modalnya kepada pekerja/pedagang/ pebisnis untuk diputar sebagai usaha, sedangkan keuntungan usaha dibagi menurut kesepakatan bersama. Atau, definisi lain menurut terminologi koperasi syariah, Mudharobah adalah bentuk kerja sama antara koperasi selaku pemilik dana (shahibul maal) dengan anggotanya atau pihak lain yang bertindak selaku pengelola dana (mudharib) produktif dan halal.
                                 </p>
                             </div>
                             <hr>
                             <h4>Persyaratan</h4>
                             <p>
                                 <ul>
                                     <li>Menjadi anggota KOSPE</li>
                                     <li>Membayar biaya administrasi Rp 10.000,-</li>
                                     <li>Melakukan penyetoran awal sebesar Rp. 100.000,-</li>
                                     <li>Simpanan selanjutnya minimal Rp 100.000,-</li>
                                     <li>Simpanan hanya bisa diambil sesuai tujuan simpanan</li>
                                 </ul>
                             </p>
                             <hr>
                             <h4>Bagi Hasil</h4>
                             <p>Ada Bagi Hasil</p>

                             <div class="bottom-article">
                                 <ul class="meta-post">
                                     <li><i class="icon-user"></i><a href="#"> Admin</a></li>
                                 </ul>

                             </div>
                         </div>
                     </div>
                 </article>



             </div>
         </div>
     </div>
 </section>