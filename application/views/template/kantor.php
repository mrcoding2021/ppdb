 <section id="inner-headline">
     <div class="container">
         <div class="row">
             <div class="span4">
                 <div class="inner-heading">
                     <h2><?= $title ?></h2>
                 </div>
             </div>
             <div class="span8">
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

                                 <img src="<?= base_url('asset/img/post/')  ?>1.jpg" alt="" width="100%" />
                             </div>
                             <h4>Kantor Pusat Bekasi</h4>
                             <p>Graha Pesantren Entrepreneur
                                 Ruko. Ruby, Blok TD.21
                                 Summareecon Bekasi</p>
                             <p>Email : info@kospeindonnesia.net</p>
                             <p>CRM KEUANGAN : 0822 1177 7107</p>
                             <p>CRM MARKETING : 0813 8379 1600</p>

                             <hr>

                             <h4>GOOGLE MAP</h4>
                             <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.262740407409!2d107.00003421471678!3d-6.229050795490942!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698c1ef583405f%3A0x9f021ab8ccd0d0cf!2sBusiness%20Center%20HNI%20Bekasi!5e0!3m2!1sid!2sid!4v1581066826217!5m2!1sid!2sid" width="100%" height="300" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                             <hr>

                             <div class="span6">

                                 <h4>Kantor Pelayanan</h4>
                             </div>
                             <div class="span3">
                                 <h5>Bekasi</h5>
                             </div>
                             <div class="span3">
                                 <h5>Jakarta</h5>
                             </div>
                             <div class="span3">
                                 <h5>Bandung</h5>
                             </div>
                             <div class="span3">
                                 <h5>Kalimanatan</h5>
                             </div>
                             <div class="span3">
                                 <h5>Nganjuk</h5>
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