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
               <form action="" method="post" role="form" class="contactForm">
                 <div id="sendmessage">Your message has been sent. Thank you!</div>
                 <div id="errormessage"></div>

                 <div class="row">
                   <div class="span4 form-group">
                     <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
                     <div class="validation"></div>
                   </div>
                   <div class="span4 form-group">
                     <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email">
                     <div class="validation"></div>
                   </div>
                   <div class="span4 form-group">
                     <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject">
                     <div class="validation"></div>
                   </div>
                   <div class="span12 margintop10 form-group">
                     <textarea class="form-control" name="message" rows="12" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                     <div class="validation"></div>
                     <p class="text-center">
                       <button class="btn btn-large btn-theme margintop10" type="submit">Submit message</button>
                     </p>
                   </div>
                 </div>
               </form>
             </div>
           </div>
         </article>



       </div>
     </div>
   </div>
 </section>