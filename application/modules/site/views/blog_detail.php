<style media="screen">
.blog__details__item__text {
     background: #ffffff;
     padding-top: 30px;
}

.blog__details__item__text span {
     font-size: 13px;
     text-transform: uppercase;
     color: #5c00ce;
}

.blog__details__item__text h3 {
     color: #111111;
     font-weight: 700;
     line-height: 31px;
     margin-top: 5px;
     margin-bottom: 15px;
}

.blog__details__item__text p {
     margin-bottom: 40px;
}

.blog__details__item__widget {
     border-top: 1px solid #f2f2f2;
     padding-top: 15px;
     text-align: left;
}

.blog__details__item__widget ul li {
     font-size: 13px;
     color: #888888;
     display: inline-block;
     list-style: none;
     margin-right: 20px;
     position: relative;
}

.blog__details__item__widget ul li span {
     color: #111111;
}

.blog__details__item__widget ul li:after {
     position: absolute;
     right: -14px;
     top: -2px;
     content: "|";
}

.blog__details__item__widget ul li:last-child {
     margin-right: 0;
}

.blog__details__item__widget ul li:last-child:after {
     display: none;
}


.blog__sidebar__item {
     text-align: center;
     margin-bottom: 65px;
}

.blog__sidebar__item:last-child {
     margin-bottom: 0;
}

.blog__sidebar__item form input {
     height: 50px;
     font-size: 15px;
     color: #444444;
     padding-left: 20px;
     border: 1px solid #e1e1e1;
     width: 100%;
     margin-bottom: 20px;
}

.blog__sidebar__item form input::-webkit-input-placeholder {
     color: #444444;
}

.blog__sidebar__item form input::-moz-placeholder {
     color: #444444;
}

.blog__sidebar__item form input:-ms-input-placeholder {
     color: #444444;
}

.blog__sidebar__item form input::-ms-input-placeholder {
     color: #444444;
}

.blog__sidebar__item form input::placeholder {
     color: #444444;
}

.blog__sidebar__title {
     text-align: center;
     margin-bottom: 35px;
}

.blog__sidebar__title h4 {
     color: #111111;
     font-weight: 700;
     position: relative;
     padding-bottom: 20px;
}

.blog__sidebar__title h4::before {
     position: absolute;
     left: 0;
     right: 0;
     bottom: 0;
     height: 5px;
     width: 70px;
     background: #e1e1e1;
     content: "";
     margin: 0 auto;
}

.blog__sidebar__social a {
     display: inline-block;
     font-size: 18px;
     color: #111111;
     width: 50px;
     height: 50px;
     background: #f2f2f2;
     border-radius: 50%;
     line-height: 50px;
     text-align: center;
     margin-right: 6px;
     margin-bottom: 5px;
}

.blog__sidebar__social a:last-child {
     margin-right: 6px;
}


.recent__item {
     display: block;
     overflow: hidden;
     margin-bottom: 25px;
     text-align: left;
}

.recent__item__pic {
     float: left;
     margin-right: 25px;
}

.recent__item__text {
     overflow: hidden;
}

.recent__item__text h6 {
     color: #111111;
     line-height: 21px;
     font-weight: 700;
}

.recent__item__text span {
     font-size: 13px;
     color: #888888;
}

.content h1, .content h2, .content h3, .content h4{
     font-size: 130%;
}
</style>
<section class="hero-wrap hero-wrap-2" style="background-image: url(<?php _url(); ?>assets/front/images/about-3.jpg); background-position: top;" data-stellar-background-ratio="0.5">
     <div class="overlay"></div>
     <div class="container">
          <div class="row no-gutters slider-text align-items-end justify-content-start">
               <div class="col-md-9 ftco-animate pb-5">
                    <p class="breadcrumbs">
                         <span class="mr-2"><a href="<?= _url('/') ?>">Accueil <i class="fa fa-chevron-right"></i></a></span>
                         <span class="mr-2"><a href="<?= _url('show_blog') ?>">Blog <i class="fa fa-chevron-right"></i></a></span>
                         <span><?= $title ?> <i class="fa fa-chevron-right"></i></span>
                    </p>
                    <h1 class="mb-3 bread"><?= $title ?></h1>
               </div>
          </div>
     </div>
</section>

<section class="ftco-section">
     <div class="container">
          <div class="row">
               <div class="col-lg-8 ftco-animate">
                    <p class="mb-5">
                         <img src="<?= _url($record->blog_picture) ?>" alt="" class="img-fluid">
                    </p>
                    <div class="blog__details__item__text">
                         <h3><?= $record->blog_name ?></h3>
                         <div class="blog__details__item__widget">
                              <div class="row">
                                   <div class="col-lg-6">
                                        <ul>
                                             <li>Par <span><?= $record->user_nicename ?></span></li>
                                             <li><?= gmdate("d M Y", $record->blog_added) ?></li>
                                        </ul>
                                   </div>
                                   <div class="col-lg-6">
                                        <ul>
                                             <li>230 Views</li>
                                             <!-- <li>18 Comments</li> -->
                                        </ul>
                                   </div>
                              </div>
                         </div>
                    </div>

                    <div class="content" style="text-align: justify; line-height: 23px; font-size: 100%;">
                         <?= $record->blog_content ?>
                    </div>
                    <div class="tag-widget post-tag-container mb-5 mt-5">
                         <div class="tagcloud">
                              <a href="#" class="tag-cloud-link">Life</a>
                              <a href="#" class="tag-cloud-link">Sport</a>
                              <a href="#" class="tag-cloud-link">Tech</a>
                              <a href="#" class="tag-cloud-link">Travel</a>
                         </div>
                    </div>


                    <div class="pt-5 mt-5">
                    </div>

               </div> <!-- .col-md-8 -->
               <div class="col-lg-4 sidebar ftco-animate">
                    <div class="blog__sidebar__item">
                         <div class="blog__sidebar__title">
                              <h4>S'inscrire à la newsletter</h4>
                         </div>
                         <form action="<?php _url('insert'); ?>" method="post">
                              <input type="text" placeholder="Votre prenom" name="contact_first_name" required>
                              <input type="text" placeholder="Votre nom" name="contact_last_name" required>
                              <input type="email" placeholder="Votre email" name="contact_email" required>
                              <button type="submit" class="btn btn-primary col-6">S'inscrire</button>
                         </form>
                    </div>

                    <div class="blog__sidebar__item">
                         <div class="blog__sidebar__title">
                              <h4>Social media</h4>
                         </div>
                         <div class="blog__sidebar__social">
                              <a href="#"><i class="fa fa-facebook"></i></a>
                              <a href="#"><i class="fa fa-twitter"></i></a>
                              <a href="#"><i class="fa fa-instagram"></i></a>
                              <a href="#"><i class="fa fa-dribbble"></i></a>
                         </div>
                    </div>
                    <div class="blog__sidebar__item">
                         <div class="blog__sidebar__title">
                              <h4>Recent posts</h4>
                         </div>
                         <?php if(is_array($blogs)): ?>
                              <?php foreach(@$blogs as $key => $blog):?>
                                   <a href="<?= _url("show_blog/".$blog->blog_id) ?>" class="recent__item">
                                        <div class="recent__item__pic" >
                                             <img src="<?= _url($blog->blog_picture); ?>" alt="" style="width: 120px;">
                                        </div>
                                        <div class="recent__item__text">
                                             <h6><?= $blog->blog_name ?></h6>
                                             <span><?= gmdate("d M Y", $blog->blog_added) ?></span>
                                        </div>
                                   </a>
                              <?php endforeach;?>
                         <?php endif; ?>

                    </div>

               </div>

          </div>
     </div>
</section> <!-- .section -->
