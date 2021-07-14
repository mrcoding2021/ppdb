 <section id="inner-headline">
     <div class="container">
         <div class="row">
             <div class="span4">
                 <div class="inner-heading">
                     <h2>
                         Berita dan Artikel
                     </h2>
                 </div>
             </div>
             <div class="span8">
                 <ul class="breadcrumb">
                     <li><a href="<?= base_url() ?>"><i class="icon-home"></i></a><i class="icon-angle-right"></i></li>
                     <li><a href="#">Blog</a><i class="icon-angle-right"></i></li>
                     <li class="active">Berita dan Artikel</li>
                 </ul>
             </div>
         </div>
     </div>
 </section>
 <section id="content">
     <div class="container">
         <div class="row">
             <div class="span8">
                 <article>
                     <div class="row">
                         <div class="span8">
                             <div class="post-image">

                                 <img src="<?= base_url('asset/img/post/').$detail['img'] ?>" alt="" width="100%" />
                             </div>
                             <p>
                                 <?=$detail['isi']?>
                             </p>
                             <div class="bottom-article">
                                 <ul class="meta-post">
                                     <li><i class="icon-user"></i><a href="#"> Admin</a></li>
                                 </ul>

                             </div>
                         </div>
                     </div>
                 </article>
             </div>
             <div class="span4">
                 <?php $this->load->view('template/sidebar'); ?>
             </div>
         </div>
     </div>
 </section>

 </div>
 <a href="#" class="scrollup"><i class="icon-chevron-up icon-square icon-32 active"></i></a>