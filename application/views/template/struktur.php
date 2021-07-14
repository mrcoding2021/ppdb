 <section id="inner-headline">
     <div class="container">
         <div class="row">
             <div class="span5">
                 <div class="inner-heading">
                     <h2><?= $title ?></h2>
                 </div>
             </div>
             <div class="span7">
                 <ul class="breadcrumb">
                     <li><a href="<?= base_url() ?>"><i class="icon-home"></i></a><i class="icon-angle-right"></i></li>
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
                                 <img src="<?= base_url('asset/img/post/') ?>struktur.jpg" alt="" width="100%" />
                             </div>
                             <h4>DEWAN PENGAWAS SYARIAH</h4>
                             <div class="span3">
                                 <img src="<?= base_url('asset/img/kospe/') ?>buchori.jpg" alt="" width="100%">
                             </div>
                             <div class="span3">
                                 <img src="<?= base_url('asset/img/kospe/') ?>aman-toha.jpg" alt="" width="100%">
                             </div>
                             <br>
                             <hr>
                             <br>
                             <h4>DEWAN PENGAWAS</h4>
                             <div class="span3">
                                 <img src="<?= base_url('asset/img/kospe/') ?>ari.jpg" alt="" width="100%">
                             </div>
                             <div class="span3">
                                 <img src="<?= base_url('asset/img/kospe/') ?>dewi.jpg" alt="" width="100%">
                             </div>
                             <br>
                             <hr><br>
                             <h4>DEWAN PENGURUS</h4>
                             <div class="span3">
                                 <img src="<?= base_url('asset/img/kospe/') ?>bagus.jpg" alt="" width="100%">
                             </div>
                             <div class="span3">
                                 <img src="<?= base_url('asset/img/kospe/') ?>awang.jpg" alt="" width="100%">
                             </div>
                             <div class="span3">
                                 <img src="<?= base_url('asset/img/kospe/') ?>agus.jpg" alt="" width="100%">
                             </div>
                             <div class="span3">
                                 <img src="<?= base_url('asset/img/kospe/') ?>dedy.jpg" alt="" width="100%">
                             </div>
                             <div class="span3">
                                 <img src="<?= base_url('asset/img/kospe/') ?>herdy.jpg" alt="" width="100%">
                             </div>
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