<section class="countdown countdown--page spad set-bg" data-setbg="<?php _url(); ?>assets/front/img/main/concert.jpg" style="background-position:center!important;">
     <div class="container">
          <div class="row">
               <div class="col-lg-12">
                    <div class="countdown__text">
                         <h1>Aucun Evenement prévu</h1>
                         <!-- <h4>Music festival start in</h4> -->
                    </div>
                    <!-- <div class="countdown__text">
                         <h1>Tomorrowland 2020</h1>
                         <h4>Music festival start in</h4>
                    </div> -->
                    <!-- <div class="countdown__timer" id="countdown-time">
                         <div class="countdown__item">
                              <span>20</span>
                              <p>days</p>
                         </div>
                         <div class="countdown__item">
                              <span>45</span>
                              <p>hours</p>
                         </div>
                         <div class="countdown__item">
                              <span>18</span>
                              <p>minutes</p>
                         </div>
                         <div class="countdown__item">
                              <span>09</span>
                              <p>seconds</p>
                         </div>
                    </div> -->
               </div>
          </div>
     </div>
</section>
<!-- Countdown Section End -->

<!-- Tours Section Begin -->
<section class="tours spad">
     <div class="container">
          <div class="row">

               <?php if (is_array(@$evenements)): ?>
                    <?php $evenement = @reset($evenements); ?>
                    <div class="col-lg-6 order-lg-1">
                         <div class="tours__item__text">
                              <h2><?= @$evenement->evenement_name ?></h2>
                              <div class="tours__text__widget">
                                   <ul>
                                        <li>
                                             <i class="fa fa-clock-o"></i>
                                             <span><?= substr(@$evenement->evenement_time , 0, -3) ?></span>
                                             <span><?= @$evenement->evenement_date ?></span>
                                        </li>
                                        <li>
                                             <i class="fa fa-map-marker"></i>
                                             <?= @$evenement->evenement_location ?>
                                        </li>
                                   </ul>
                                   <!-- <div class="price">$ 35.00</div> -->
                              </div>
                              <div class="tours__text__desc">
                                   <p><?= @$evenement->evenement_desc ?></p>
                              </div>
                              <!-- <a href="#" class="primary-btn border-btn">Buy tickets</a> -->
                         </div>
                    </div>
                    <div class="col-lg-6 order-lg-2">
                         <div class="tours__item__pic">
                              <img src="<?= _url(@$evenement->evenement_picture) ?>" alt="">
                         </div>
                    </div>
               <?php endif; ?>

          </div>
     </div>
</section>

<section class="blog spad">
     <div class="container">
          <div class="row">
               <?php if (is_array(@$evenements)): ?>
                    <?php foreach (@$evenements as $key => $evenement): ?>
                         <div class="col-lg-4 col-md-6 col-sm-6">
                              <div class="blog__item">
                                   <div class="blog__item__pic">
                                        <img src="<?= _url(@$evenement->evenement_picture) ?>" alt="">
                                   </div>
                                   <div class="blog__item__text">
                                        <a href="<?= @$evenement->evenement_link ?>" class="btn btn-primary" target="_blank">Consulter</a>
                                        <h5><?= @$evenement->evenement_name ?></h5>
                                        <ul>
                                             <li>Le <span><?= @$evenement->evenement_date ?></span></li>
                                             <li><?= substr(@$evenement->evenement_time , 0, -3) ?></li>
                                        </ul>
                                   </div>
                              </div>
                         </div>
                    <?php endforeach; ?>
               <?php endif; ?>
          </div>
     </div>
</section>
