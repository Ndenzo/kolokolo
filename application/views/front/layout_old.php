<!DOCTYPE html>
<html lang="zxx">

<head>
     <meta charset="UTF-8">
     <meta name="description" content="Le Site Officiel de Armand KOFFI">
     <meta name="keywords" content="Armand KOFFI, Musicien">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>ArmandKoffi | <?= @$title ?></title>

     <link rel="icon" href="<?php _url(); ?>assets/front/img/main/logo_icon.png">

     <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&display=swap" rel="stylesheet">

     <!-- Css Styles -->
     <link rel="stylesheet" href="<?php _url(); ?>assets/front/css/bootstrap.min.css" type="text/css">
     <link rel="stylesheet" href="<?php _url(); ?>assets/front/css/font-awesome.min.css" type="text/css">
     <link rel="stylesheet" href="<?php _url(); ?>assets/front/css/barfiller.css" type="text/css">
     <link rel="stylesheet" href="<?php _url(); ?>assets/front/css/nowfont.css" type="text/css">
     <link rel="stylesheet" href="<?php _url(); ?>assets/front/css/rockville.css" type="text/css">
     <link rel="stylesheet" href="<?php _url(); ?>assets/front/css/magnific-popup.css" type="text/css">
     <link rel="stylesheet" href="<?php _url(); ?>assets/front/css/owl.carousel.min.css" type="text/css">
     <link rel="stylesheet" href="<?php _url(); ?>assets/front/css/slicknav.min.css" type="text/css">
     <link rel="stylesheet" href="<?php _url(); ?>assets/front/css/style.css" type="text/css">
     <link rel="stylesheet" href="<?php _url(); ?>assets/custom/css/style.css">

     <script src="https://kit.fontawesome.com/5b55e70349.js" crossorigin="anonymous"></script>


     <link rel="stylesheet" type="text/css" href="https://paydunya.com/assets/psr/css/psr.paydunya.min.css">

</head>

<body style="overflow-x: hidden;">
     <style>
     @media (max-width: 767px) {
          .hidden-mobile {
               display: none;
          }
          #foot{
               margin-bottom: 0px;
          }
          #header-text-yo{
               margin-top: 500px!important;
          }
     }
     .req{
          color: red;
          font-weight: bold;
     }
     .welcome-popup .modal-content {
          background-image: url(<?= @$singles[0]->single_picture ?>);
          background-repeat: no-repeat;
          background-position: top center;
          border-radius: 30px;
          box-shadow: 2px 12px 26px 3px rgba(47, 46, 46, 0.3);
     }
     .welcome-popup .close {
          z-index: 9;
          position: absolute;
          background-color: white;
          opacity: 1;
          border-radius: 15px;
          padding: 10px 15px;
          left: -20px;
          top: -10px;
          box-shadow: -2px 6px 11px 3px rgba(red, 0.3);
     }
     .welcome-popup .modal-header{
          height: 350px;
          border: none;
     }
     .welcome-popup .contain {
          padding-top: 80px;
     }
</style>

<!-- Page Preloder -->
<div id="preloder">
     <div class="loader"></div>
</div>

<!-- Header Section Begin -->
<?= @$menu ?>
<!-- Header Section End -->
<!-- Hero Section Begin -->
<?= @$content ?>
<!-- Footer Section Begin -->
<?php if ($main == true): ?>
     <footer class="footer spad" style="margin-top: 10px;">
          <div class="row" style=" width: 100%; margin: 0px;">
               <img src="<?php _url(); ?>assets/front/img/main/couverture-image.png" alt="" style="width: 100%;">
          </div>
     <?php else: ?>
          <footer class="footer footer--normal spad">
          <?php endif; ?>


          <div class="row" id="foot" style="background-color : #2C7CC4; padding-top: 70px; padding-left: 20px;">
               <div class="container">
                    <div class="row">
                         <div class="col-lg-3 col-md-6">
                              <div class="footer__address">
                                   <ul>
                                        <li>
                                             <i class="fa fa-phone"></i>
                                             <p>Phone</p>
                                             <h6>+221 77 654 32 65</h6>
                                        </li>
                                        <li>
                                             <i class="fa fa-envelope"></i>
                                             <p>Email</p>
                                             <h6>armand_koffi_contact@gmail.com</h6>
                                        </li>
                                   </ul>
                              </div>
                         </div>
                         <div class="col-lg-4 offset-lg-1 col-md-6">
                              <div class="footer__social">
                                   <h2>Armand Koffi</h2>
                                   <div class="footer__social__links">
                                        <?php if (is_array($rx_links)): ?>
                                             <?php foreach ($rx_links as $key => $rx_link): ?>
                                                  <a href="<?= $rx_link->settings_rx_link_value ?>" target="_blank"><i class="<?= $rx_link->settings_rx_link_icon ?>"></i></a>
                                             <?php endforeach; ?>
                                        <?php endif; ?>
                                   </div>
                              </div>
                         </div>
                         <div class="col-lg-3 offset-lg-1 col-md-6">
                              <div class="footer__newslatter footer__social__links">
                                   <h4>Restez informer</h4>
                                   <a href="#custom-newsletter-modal" class="btn form-control text-primary" data-toggle="modal" style="background-color: white; border-radius: 7px; ">Souscrire à la newsletter</a>
                              </div>
                         </div>
                    </div>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    <div class="footer__copyright__text">
                         <p>Copyright &copy; <script>document.write(new Date().getFullYear());</script> All rights reserved </p>
                         <!-- | Made </i> by <a href="#" target="_blank">Ndenzo</a> -->
                    </div>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
               </div>
          </div>

     </footer>

     <div id="custom-newsletter-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
          <div class="modal-dialog modal-dialog-centered">
               <div class="modal-content">
                    <div class="modal-header">
                         <h4 class="modal-title" id="myCenterModalLabel">Souscrire à la newsletter</h4>
                         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                         <form class="row justify-content-center" action="<?php _url($module_base.'insert'); ?>" method="post">
                              <div class="col-10 ">
                                   <div class="form-group mb-3">
                                        <label>Prénoms <span class="req">*</span> </label>
                                        <input type="text" class="form-control" placeholder="Votre prenom" name="contact_first_name" required>
                                   </div>
                                   <div class="form-group mb-3">
                                        <label>Nom <span class="req">*</span></label>
                                        <input type="text" class="form-control" placeholder="Votre nom" name="contact_last_name" required>
                                   </div>
                                   <div class="form-group mb-3">
                                        <label>Email <span class="req">*</span></label>
                                        <input type="email" class="form-control" placeholder="Votre email" name="contact_email" required>
                                   </div>
                                   <div class="modal-footer mt-30">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                        <button type="submit" class="btn btn-success col-md-4">Enregistrer</button>
                                   </div>
                              </div>
                         </form>
                    </div>
               </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
     </div>
     <!-- Footer Section End -->

     <!-- Js Plugins -->
     <script src="<?php _url(); ?>assets/front/js/jquery-3.3.1.min.js"></script>
     <script src="<?php _url(); ?>assets/front/js/bootstrap.min.js"></script>
     <script src="<?php _url(); ?>assets/front/js/jquery.magnific-popup.min.js"></script>
     <script src="<?php _url(); ?>assets/front/js/jquery.nicescroll.min.js"></script>
     <script src="<?php _url(); ?>assets/front/js/jquery.barfiller.js"></script>
     <script src="<?php _url(); ?>assets/front/js/jquery.countdown.min.js"></script>
     <script src="<?php _url(); ?>assets/front/js/jquery.slicknav.js"></script>
     <script src="<?php _url(); ?>assets/front/js/owl.carousel.min.js"></script>
     <script src="<?php _url(); ?>assets/front/js/main.js"></script>

     <!-- Music Plugin -->
     <script src="<?php _url(); ?>assets/front/js/jquery.jplayer.min.js"></script>
     <script src="<?php _url(); ?>assets/front/js/jplayerInit.js"></script>
     <script>
     $(document).ready(function(){
          $("#loadModal").modal('show');
     });
     </script>
</body>

</html>
