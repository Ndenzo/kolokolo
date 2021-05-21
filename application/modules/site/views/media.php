<div class="breadcrumb-option">
     <div class="container">
          <div class="row">
               <div class="col-lg-12">
                    <div class="breadcrumb__links">
                         <a href="<?= _url('/'); ?>"><i class="fa fa-home"></i> Accueil</a>
                         <span>Media</span>
                    </div>
               </div>
          </div>
     </div>
</div>
<!-- Breadcrumb End -->

<!-- Video Section Begin -->
<section class="videos spad">
     <div class="container">
          <div class="row">
               <div class="col-lg-12">
                    <div class="section-title center-title" style="margin-bottom: 150px;">
                         <!-- <h2>YOutube feed</h2> -->
                         <h1 class="text-primary">Videos</h1>
                    </div>
                    <?php if (is_array(@$medias)): ?>
                         <?php $media = @reset($medias); ?>
                         <div class="videos__large__item set-bg" data-setbg="<?= _url(@$media->media_picture) ?>">
                              <a href="<?= @$media->media_link?>" class="play-btn video-popup"><i class="fa fa-play"></i></a>
                              <div class="videos__large__item__text">
                                   <h4><?= @$media->media_name ?>
                                   </h4>
                                   <ul>
                                        <!-- <li>02:35:18</li> -->
                                        <li><?= @$media->media_date ?></li>
                                   </ul>
                              </div>
                         </div>
                    <?php endif; ?>



                    <div class="row">
                         <div class="videos__slider owl-carousel">
                              <?php if (is_array(@$medias)): ?>
                                   <?php foreach (@$medias as $key => $media): ?>
                                        <?php if ($key != 0): ?>
                                             <div class="col-lg-3">
                                                  <div class="videos__item">
                                                       <div class="videos__item__pic set-bg" data-setbg="<?= _url(@$media->media_picture) ?>">
                                                            <a href="<?= @$media->media_link ?>" class="play-btn video-popup"><i class="fa fa-play"></i></a>
                                                       </div>
                                                       <div class="videos__item__text">
                                                            <h5><?= @$media->media_name ?></h5>
                                                            <ul>
                                                                 <!-- <li>02:35:18</li> -->
                                                                 <li><?= @$media->media_date ?></li>
                                                            </ul>
                                                       </div>
                                                  </div>
                                             </div>
                                        <?php endif; ?>
                                   <?php endforeach; ?>
                              <?php endif; ?>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</section>
