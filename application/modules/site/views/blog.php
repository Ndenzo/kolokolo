<section class="hero-wrap hero-wrap-2" style="background-image: url(<?php _url(); ?>assets/front/images/about-3.jpg); background-position: top;" data-stellar-background-ratio="0.5">
     <div class="overlay"></div>
     <div class="container">
          <div class="row no-gutters slider-text align-items-end justify-content-start">
               <div class="col-md-9 ftco-animate pb-5">
                    <p class="breadcrumbs"><span class="mr-2"><a href="<?= _url('/') ?>">Accueil <i class="fa fa-chevron-right"></i></a></span> <span>Notre Blog <i class="fa fa-chevron-right"></i></span></p>
                    <h1 class="mb-3 bread">Blog</h1>
               </div>
          </div>
     </div>
</section>

<section class="ftco-section bg-light">
     <div class="container">
          <div class="row d-flex">
               <?php if(is_array($blogs)): ?>
                    <?php foreach(@$blogs as $key => $blog):?>

                         <div class="col-lg-4 ftco-animate">
                              <div class="blog-entry">
                                   <a href="<?= _url("show_blog/".$blog->blog_id) ?>" class="block-20" style="background-image: url('<?= _url($blog->blog_picture); ?>');"></a>
                                   <div class="text d-block">
                                        <div class="meta">
                                             <p style="">
                                                  <a href="#"><span class="fa fa-calendar mr-2"></span><?= gmdate("d M Y", $blog->blog_added) ?></a>
                                                  <a href="#"><span class="fa fa-user mr-2 ml-3"></span><?= $blog->user_nicename ?></a>
                                                  <!-- <a href="#" class="meta-chat"> <span class="fa fa-comment mr-2"></span>3</a> -->
                                             </p>
                                        </div>
                                        <h3 class="heading"><a href="#"><?= $blog->blog_name ?></a></h3>
                                        <p><a href="<?= _url("show_blog/".$blog->blog_id) ?>" class="btn btn-secondary py-2 px-3">Voir plus</a></p>
                                   </div>
                              </div>
                         </div>

                    <?php endforeach;?>
               <?php endif; ?>
          </div>
     </div>
</section>
