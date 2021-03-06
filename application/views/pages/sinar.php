 <section id="inner-headline">
     <div class="container">
         <div class="row">
             <div class="span6">
                 <div class="inner-heading">
                     <h2><?= $title ?></h2>
                 </div>
             </div>
             <div class="span6">
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
                 <aside class="left-sidebar">

                     <div class="widget">
                         <h5 class="widgetheading">Menu Lain</h5>
                         <ul class="cat">
                             <?php $this->load->view('template/menu'); ?>
                         </ul>
                     </div>
                     <div class="widget">
                         <h5 class="widgetheading">Post Teerbaru</h5>
                         <ul class="recent">
                             <?php
                                $this->load->view('template/blog');
                                ?>
                         </ul>
                     </div>

                 </aside>
             </div>
             <div class="span8">
                 <article>
                     <div class="row">
                         <div class="span8">
                             <div class="post-image">
                                 <img src="<?= base_url('asset/img/post/')  ?>sinarfoto.jpg" alt="" width="100%" />
                             </div>
                             <div class="span3">
                                 <img src="<?= base_url('asset/img/post/')  ?>sinar.jpg" alt="" width="100%" />
                             </div>
                             <div class="span4">

                                 <h4><?= $title ?></h4>
                                 <p>
                                     Simpanan Resepsi & Pernikahan (SINAR) adalah simpanan anggota yang disimpan untuk perencanaan Resepsi dan Pernikahan. Mendapatkan Nisbah Bagi Hasil 20% setiap bulan untuk anggota penyimpan.

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