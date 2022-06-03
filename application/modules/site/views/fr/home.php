<!-- header area start  -->
<!-- <video class="video-custom" src="<?= _url('assets/front') ?>/img/bg/fire.mp4" autoplay loop muted style="z-index: 0;"></video>

<header class="header-area header-bg-2 style-two" id="home" style="background-position: center top; padding-bottom:300px; background-image: url(<?= _url('assets/front') ?>/img/bg/background.png); background-color:transparent;"> -->
<div id="particles-js"></div>
<header class="header-area header-bg-2 style-two" id="home" style="background-position: center top; padding-bottom:300px;">
     <div class="container">
          <div class="row">

               <div class="col-lg-5">
                    <div class="header-left-image wow zoomIn" style=" margin-top: 100px;">
                         <img src="<?php _url(); ?>assets/front/img/mobile-image-4.png" class="d-none d-sm-block" alt="header left image" style="max-width: 650px!important; margin-top: -100px;">
                    </div>

               </div>
               <div class="col-lg-7" style="z-index: 21;">
                    <div class="header-inner" style=" margin-top : -150px ;">
                         <h1 class="title wow fadeInDown text-right">CONDUIRE VOTRE PROPRE IMPACT</h1>
                         <h3 class="wow fadeInDown text-right text-white">ET ALLEZ AU-DELÀ DE VOS ATTENTES !</h3>
                         <div class="btn-wrapper wow fadeInUp">
                              <a href="#" class="btn float-right boxed-btn btn-rounded" style="width: auto;">
                                   COMMENCEZ MAINTENANT
                              </a>
                              <!-- <a href="#" class="boxed-btn btn-rounded blank">En savoir plus</a> -->
                         </div>
                    </div>
               </div>

          </div>
     </div>
</header>
<!-- header area end  -->

<!-- about us area start -->

<section class="about-us-area style-two" style="margin-top: -200px;">
     <div class="container">
          <div class="row justify-content-center">
               <div class="col-lg-10">
                    <div class="section-title"><!-- section title -->
                         <h3 class="title text-primary">Nos produits</h3>
                         <p>
                              Nos produits vous permettent d’atteindre vos cibles dans les meilleures conditions avec un grand impact et sécurité de bout en bout.
                              Nous vous permettons d’atteindre vos bénéficiaires dans les endroits les plus reculés. Vous êtes assuré d’aller au-delà de vos espérances.
                         </p>
                    </div><!-- //. section title -->
               </div>
          </div>
          <div class="col-12 row ml-auto mr-auto">
               <div class="col-lg-4 col-12 mt-3">
                    <div class="single-price-plan-01 wow zoomIn desc-object" style="height: 350px;"><!-- single price plan one -->
                         <div class="price-header">
                              <img class="col-4 ml-auto mr-auto" src="<?php _url(); ?>assets/front/img/bg/IconeProduitsPlan de travail 1-8.png" alt="header right image">
                              <h4 class="mt-1">SMS</h4>
                         </div>
                         <div class="price-body p-2">
                              <p class="text-left">
                                   <?= substr($products['sms'], 0, 140)."..." ?>
                                   <br/>
                                   <a href="#product-sms" class="text-primary mt-3" data-toggle="modal" style="font-weight: bold">Lire la suite</a>
                              </p>
                         </div>
                    </div><!-- //. single price plan one -->
               </div>
               <div class="col-lg-4 col-12 mt-3">
                    <div class="single-price-plan-01 wow zoomIn desc-object" style="height: 350px;"><!-- single price plan one -->
                         <div class="price-header">
                              <img class="col-4 ml-auto mr-auto" src="<?php _url(); ?>assets/front/img/bg/IconeProduitsPlan de travail 5-8.png" alt="header right image">
                              <h4 class="mt-1">IVR</h4>
                         </div>
                         <div class="price-body p-2">
                              <p class="text-left">
                                   <?= substr($products['ivr'], 0, 140)."..." ?>
                                   <br/>
                                   <a href="#product-ivr" class="text-primary mt-3" data-toggle="modal" style="font-weight: bold">Lire la suite</a>
                              </p>
                         </div>
                    </div><!-- //. single price plan one -->
               </div>
               <div class="col-lg-4 col-12 mt-3">
                    <div class="single-price-plan-01 wow zoomIn desc-object" style="height: 350px;"><!-- single price plan one -->
                         <div class="price-header">
                              <img class="col-4 ml-auto mr-auto" src="<?php _url(); ?>assets/front/img/bg/IconeProduitsPlan de travail 6-8.png" alt="header right image">
                              <h4 class="mt-1">AIRTIME TRANSFER</h4>
                         </div>
                         <div class="price-body p-2">
                              <p class="text-left">
                                   <?= substr($products['airtime'], 0, 140)."..." ?>
                                   <br/>
                                   <a href="#product-airtime" class="text-primary mt-3" data-toggle="modal" style="font-weight: bold">Lire la suite</a>
                              </p>
                         </div>
                    </div><!-- //. single price plan one -->
               </div>
          </div>
          <div class="col-12 col-lg-8 row ml-auto mr-auto">
               <div class="col-lg-6 col-12 mt-4">
                    <div class="single-price-plan-01 wow zoomIn desc-object" style="height: 350px;"><!-- single price plan one -->
                         <div class="price-header">
                              <img class="col-4 ml-auto mr-auto" src="<?php _url(); ?>assets/front/img/bg/IconeProduitsPlan de travail 6-8.png" alt="header right image">
                              <h4 class="mt-1">CASH TRANSFER</h4>
                         </div>
                         <div class="price-body p-2">
                              <p class="text-left">
                                   <?= substr($products['cash'], 0, 140)."..." ?>
                                   <br/>
                                   <a href="#product-cash" class="text-primary mt-3" data-toggle="modal" style="font-weight: bold">Lire la suite</a>
                              </p>
                         </div>
                    </div><!-- //. single price plan one -->
               </div>
               <div class="col-lg-6 col-12 mt-4">
                    <div class="single-price-plan-01 wow zoomIn desc-object" style="height: 350px;"><!-- single price plan one -->
                         <div class="price-header">
                              <img class="col-4 ml-auto mr-auto" src="<?php _url(); ?>assets/front/img/bg/IconeProduitsPlan de travail 7-8.png" alt="header right image">
                              <h4 class="mt-1">DATA COLLECTION </h4>
                         </div>
                         <div class="price-body p-2">
                              <p class="text-left">
                                   <?= substr($products['data'], 0, 140)."..." ?>
                                   <br/>
                                   <a href="#product-data" class="text-primary mt-3" data-toggle="modal" style="font-weight: bold">Lire la suite</a>
                              </p>
                         </div>
                    </div><!-- //. single price plan one -->
               </div>
          </div>
     </div>
</section>

<!-- why choose area start -->
<section class="why-choose-area why-choose-us-bg d-none d-sm-block" style="height: 1200px;">
     <div class="container-fluid">
          <div class="row">
               <div class="col-lg-6">
                    <div class="section-title white" style="margin-bottom:0px;"><!-- section title -->
                         <h3 class="title extra" style="margin-top: 120px;">NOS RECORDS</h3>
                    </div><!-- //. section title -->

                    <div class="row">
                         <div class="container">
                              <div class="row">
                                   <div class="col-lg-6 col-md-12 why-object margin-top-60 wow zoomIn">
                                        <div class="inditxt">
                                             +<span class="count-num">12,000</span>
                                        </div>
                                   </div>
                                   <div class="col-lg-6 col-md-12 why-object margin-top-60 wow zoomIn">
                                        <div class="inditxt">
                                             +<span class="count-num">19,000</span>
                                        </div>
                                   </div>
                                   <div class="col-lg-6 col-md-12 wow zoomIn">
                                        <div class="indi text-white">Contacts formé dans l’éducation financière</div>
                                   </div>
                                   <div class="col-lg-6 col-md-12 wow zoomIn">
                                        <div class="indi text-white">Bénéficiaires de cash transfer</div>
                                   </div>
                                   <div class="col-lg-6 col-md-12 why-object margin-top-60 wow zoomIn">
                                        <div class="inditxt">
                                             +<span class="count-num">100</span>
                                        </div>
                                   </div>
                                   <div class="col-lg-6 col-md-12 why-object margin-top-60 wow zoomIn">
                                        <div class="inditxt">
                                             +<span class="count-num">20</span>
                                        </div>
                                   </div>
                                   <div class="col-lg-6 col-md-12 wow zoomIn">
                                        <div class="indi text-white">Sondages IVR</div>
                                   </div>
                                   <div class="col-lg-6 col-md-12 wow zoomIn">
                                        <div class="indi text-white">Lignes de redevabilité</div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</section>
<!-- why choose area end -->

<!-- screenshort area start -->
<section class="screenshort-area" style="margin-top: 50px;">
     <div class="row">
          <div class="col-10 ml-auto mr-auto" style="border: 1px solid grey; -webkit-box-shadow: 0 0 5px rgba(0, 0, 0, 0.2); box-shadow: 0 0 5px rgba(0, 0, 0, 0.2); border-radius: 10px;">
               <div class="row justify-content-center">
                    <div class="col-lg-10">
                         <div class="bg-primary" style="margin-top: -15px; margin-bottom: 30px; ">
                              <h3 class="text-white text-center">NOS PARTENAIRES</h3>
                         </div>
                    </div>
               </div>
               <div class="row">
                    <div class="col-lg-12">
                         <div class="screenshort-carousel"><!-- screenshort carousel -->
                              <div class="single-screenshort-item"><!-- single screenshort item -->
                                   <img src="<?php _url(); ?>assets/front/img/bg/o1.png" alt="" style="max-width: 150px!important; vertical-align:middle!important;">
                              </div><!-- //.single screenshort item -->
                              <div class="single-screenshort-item"><!-- single screenshort item -->
                                   <img src="<?php _url(); ?>assets/front/img/bg/o2.png" alt="" style="max-width: 150px!important;">
                              </div><!-- //.single screenshort item -->
                              <div class="single-screenshort-item"><!-- single screenshort item -->
                                   <img src="<?php _url(); ?>assets/front/img/bg/o3.png" alt="" style="max-width: 150px!important;">
                              </div><!-- //.single screenshort item -->
                              <div class="single-screenshort-item"><!-- single screenshort item -->
                                   <img src="<?php _url(); ?>assets/front/img/bg/o4.png" alt="" style="max-width: 150px!important;">
                              </div><!-- //.single screenshort item -->
                              <div class="single-screenshort-item"><!-- single screenshort item -->
                                   <img src="<?php _url(); ?>assets/front/img/bg/o5.jpg" alt="" style="max-width: 150px!important; vertical-align:middle!important;">
                              </div><!-- //.single screenshort item -->
                              <div class="single-screenshort-item"><!-- single screenshort item -->
                                   <img src="<?php _url(); ?>assets/front/img/bg/o6.jpg" alt="" style="max-width: 150px!important;">
                              </div><!-- //.single screenshort item -->
                         </div><!-- //. screenshort carousel -->
                    </div>
               </div>
          </div>
     </div>
</section>
<!-- screenshort area end -->

<div id="product-sms" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">SMS</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <div class="price-body p-2">
                         <p>
                              <?= $products['sms'] ?>
                         </p>
                    </div>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<div id="product-ivr" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">IVR</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <div class="price-body p-2">
                         <p>
                              <?= $products['ivr'] ?>
                         </p>
                    </div>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<div id="product-airtime" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Airtime Transfer</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <div class="price-body p-2">
                         <p>
                              <?= $products['airtime'] ?>
                         </p>
                    </div>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<div id="product-cash" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Cash Transfer</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <div class="price-body p-2">
                         <p>
                              <?= $products['cash'] ?>
                              <br/>
                         </p>
                    </div>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<div id="product-data" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Data App Collection</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <div class="price-body p-2">
                         <p>
                              <?= $products['data'] ?>
                              <br/>
                         </p>
                    </div>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>
