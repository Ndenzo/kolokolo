<!DOCTYPE html>
<html class="no-js" lang="en">
<head>

     <!--- basic page needs
     ================================================== -->
     <meta charset="utf-8">
     <title>Reff</title>
     <meta name="description" content="">
     <meta name="author" content="">

     <!-- mobile specific metas
     ================================================== -->
     <meta name="viewport" content="width=device-width, initial-scale=1">

     <!-- CSS
     ================================================== -->
     <link rel="stylesheet" href="<?php _url(); ?>assets/coming/css/base.css">
     <link rel="stylesheet" href="<?php _url(); ?>assets/coming/css/vendor.css">
     <link rel="stylesheet" href="<?php _url(); ?>assets/coming/css/main.css">

     <!-- script
     ================================================== -->
     <script src="<?php _url(); ?>assets/coming/js/modernizr.js"></script>

     <!-- favicons
     ================================================== -->
     <link rel="shortcut icon" href="<?php _url(); ?>assets/coming/favicon.ico" type="image/x-icon">
     <link rel="icon" href="<?php _url(); ?>assets/coming/favicon.ico" type="image/x-icon">

</head>


<body id="top">

     <style media="screen">
     .alert-success, .alert-danger{
          position: absolute;
          z-index: 1900;
          padding: 25px;
          margin: 25px;
          color: white;
          font-weight: bold;
     }

     .alert-success{
          background-color: #ace256;
     }

     .alert-danger{
          background-color: #d06555;
     }

     ::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
          color: silver;
          opacity: 1; /* Firefox */
     }

     </style>

     <!-- preloader
     ================================================== -->
     <div id="preloader">
          <div id="loader" style="height: 100px; width: 100px;">
               <img src="<?php _url(); ?>/assets/coming/images/loader/loader2.gif" >
          </div>
     </div>

     <?php show_notification();?>

     <!-- header
     ================================================== -->
     <header class="s-header">

          <div class="header-logo">
               <a class="site-logo" href="<?php _url('/'); ?>" >
                    <img src="<?php _url(); ?>/assets/front/img/bg/reff2.png" alt="Homepage" style="height: 75px;">
               </a>
          </div> <!-- end header-logo -->

          <nav class="header-nav">

               <a href="<?php _url(); ?>assets/coming/#0" class="header-nav__close" title="Close"><span>Close</span></a>

               <h3>Navigation</h3>

               <div class="header-nav__content">

                    <ul class="header-nav__list">
                         <li><a class="smoothscroll"  href="<?php _url(); ?>assets/coming/#home" title="home">Accueil</a></li>
                         <li><a class="smoothscroll"  href="<?php _url(); ?>assets/coming/#about" title="about">A propos</a></li>
                         <li><a class="smoothscroll"  href="<?php _url(); ?>assets/coming/#contact" title="contact">Newsletter</a></li>
                    </ul>

                    <ul class="header-nav__social">
                         <li>
                              <a href="https://www.facebook.com/appli.reff/"><i class="fab fa-facebook-f" aria-hidden="true" target="_blank"></i></a>
                         </li>
                         <li>
                              <a href="<?php _url(); ?>assets/coming/#0"><i class="fab fa-twitter" aria-hidden="true" target="_blank"></i></a>
                         </li>
                         <li>
                              <a href="https://www.instagram.com/appli_reff/"><i class="fab fa-instagram" aria-hidden="true" target="_blank"></i></a>
                         </li>
                         <li>
                              <a href="https://www.youtube.com/channel/UCwegIBUTgugs0jWpuGihe7g?view_as=subscriber"><i class="fab fa-youtube" aria-hidden="true" target="_blank"></i></a>
                         </li>
                    </ul>

               </div> <!-- end header-nav__content -->

          </nav> <!-- end header-nav -->

          <a class="header-menu-toggle" href="<?php _url(); ?>assets/coming/#0">
               <span class="header-menu-icon"></span>
          </a>

     </header> <!-- end s-header -->



     <!-- home
     ================================================== -->
     <section id="home" class="s-home page-hero target-section" data-parallax="scroll" style="background-image: url(<?php _url(); ?>assets/coming/images/reff/background2.jpg); background-size: cover; background-repeat: no-repeat; background-position: center;">

          <div class="home-content">

               <div class="row home-content__main">

                    <h1 style="color: #c52329;">
                         REFF
                    </h1>

                    <h3>
                         Style Meets digital
                    </h3>

                    <div class="home-content__button">
                         <a href="<?php _url(); ?>assets/coming/#about" class="smoothscroll btn btn--primary btn--large">
                              A propos
                         </a>
                         <a href="<?php _url(); ?>assets/coming/#contact" class="smoothscroll btn btn--large">
                              Newsletter
                         </a>
                    </div>

               </div> <!-- end home-content__main -->

               <div class="home-content__scroll">
                    <a href="<?php _url(); ?>assets/coming/#about" class="scroll-link smoothscroll">
                         défiler
                    </a>
               </div>

          </div> <!-- end home-content -->

          <ul class="home-social">
               <li>
                    <a href="https://www.facebook.com/appli.reff/"><i class="fab fa-facebook-f" aria-hidden="true" target="_blank"></i><span>Facebook</span></a>
               </li>
               <li>
                    <a href="<?php _url(); ?>assets/coming/#0"><i class="fab fa-twitter" aria-hidden="true" target="_blank"></i><span>Twiiter</span></a>
               </li>
               <li>
                    <a href="https://www.instagram.com/appli_reff/"><i class="fab fa-instagram" aria-hidden="true" target="_blank"></i><span>Instagram</span></a>
               </li>
               <li>
                    <a href="https://www.youtube.com/channel/UCwegIBUTgugs0jWpuGihe7g?view_as=subscriber"><i class="fab fa-youtube" aria-hidden="true" target="_blank"></i><span>Youtube</span></a>
               </li>
          </ul> <!-- end home-social -->

     </section> <!-- end s-home -->


     <!-- about
     ================================================== -->
     <section id="about" class="s-about target-section">

          <!-- <div class="row section-header bit-narrow" data-aos="fade-up">
          <div class="col-full">
          <h3 class="subhead">Who We Are</h3>
          <h1 class="display-1">
          We are Sublime, a design and branding agency with partners worldwide. We design thoughtful digital experiences
          and beautiful brand aesthetics.
     </h1>
</div>
</div>

<div class="row bit-narrow" data-aos="fade-up">
<div class="col-full">
<p class="lead">
Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Donec rutrum congue leo eget malesuada. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.
</p>
</div>
</div> -->

<div class="row bit-narrow">

     <div class="about-process process block-1-2 block-tab-full">

          <div class="col-block item-process" data-aos="fade-up">
               <div class="item-process__text">
                    <h4 class="item-title">Qu'est ce que REFF ?</h4>
                    <p style="font-size: 20px;">
                         #REFF est une application web mobile qui permet aux stylistes, couturiers, designers et vendeurs de tissus, de mettre en avant leurs créations, maisons de couture, haute couture et boutiques de mode.
                    </p>
               </div>
          </div>
          <div class="col-block item-process" data-aos="fade-up">
               <div class="item-process__text">
                    <img src="<?php _url(); ?>assets/coming/images/reff/man2.jpg" alt="">
               </div>
          </div>
          <div class="col-block item-process" data-aos="fade-up">
               <div class="item-process__text">
                    <h4 class="item-title">Pourquoi REFF ?</h4>
                    <p style="font-size: 20px;">
                         #REFF permet aux créateurs de mode de vendre leurs créations en ligne à travers un catalogue numérique soigneusement dédié.
                         <br>
                         <br>
                         #REFF permet aussi aux utilisateurs d'acheter en ligne des articles de mode, de localiser le couturier le plus proche, la maison ou la boutique de mode la plus proche en fonction de leur zone géographique.
                    </p>
               </div>
          </div>
          <div class="col-block item-process" data-aos="fade-up">
               <div class="item-process__text">
                    <img src="<?php _url(); ?>assets/coming/images/reff/woman1.jpg" alt="">
               </div>
          </div>

     </div> <!-- end process -->

</div> <!-- end row -->

</section> <!-- end s-about -->


<!-- contact
================================================== -->
<section id="contact" class="s-contact target-section">

     <div class="row section-header narrow" data-aos="fade-up">
          <div class="col-full">
               <h3 class="subhead" style="color: black;">Restez informés</h3>
               <h1 class="display-1">Inscrivez-vous à notre Newsletter<br></h1>
          </div>
     </div> <!-- end section-header -->



     <div class="row" style="margin-top: 35px;" >

          <div class="col">
               <form action="<?php _url('site/coming/insert'); ?>" method="post" style="margin-top: 30px;">
                    <input class="form-control" type="text" name="prospect_email" placeholder="Votre adresse email" style="width: 400px; margin-left: auto; margin-right:auto; background-color: white; color: black;"/>
                    <input class="btn btn-success" type="submit" name="enregistrer" value="Je m'inscris">
               </form>
          </div>
          <hr>
          <div class="col" style="margin-top: 70px;">
               <p class="contact-email">
                    <a href="mailto:appli.reff@gmail.com" style="font-size: 35px;">appli.reff@gmail.com</a>
               </p>
               <p class="contact-numbers" style="font-size: 25px;">
                    +221 77 863 20 89 <br> +243 815 138 232 <br> +33 767 16 04 99
               </p>

               <ul class="contact-social" style="font-size: 20px;">
                    <li>
                         <a href="https://www.facebook.com/appli.reff/"><i class="fab fa-facebook-f" aria-hidden="true" target="_blank"></i></a>
                    </li>
                    <li>
                         <a href="<?php _url(); ?>assets/coming/#0"><i class="fab fa-twitter" aria-hidden="true" target="_blank"></i></a>
                    </li>
                    <li>
                         <a href="https://www.instagram.com/appli_reff/"><i class="fab fa-instagram" aria-hidden="true" target="_blank"></i></a>
                    </li>
                    <li>
                         <a href="https://www.youtube.com/channel/UCwegIBUTgugs0jWpuGihe7g?view_as=subscriber"><i class="fab fa-youtube" aria-hidden="true" target="_blank"></i></a>
                    </li>
               </ul>
          </div>
     </div>



</section> <!-- end s-contact -->


<!-- footer
================================================== -->
<footer>
     <div class="row">
          <div class="col-full ss-copyright">
               <span>©Copyright Reff 2018</span>
               <!-- <span>Design by <a href="https://www.facebook.com/appli.reff/">Ndenzo</a></span> -->
          </div>
     </div>

     <div class="ss-go-top">
          <a class="smoothscroll" title="Back to Top" href="<?php _url(); ?>assets/coming/#top" style="background-color: grey;">Retour</a>
     </div>
</footer>


<!-- Java Script
================================================== -->
<script src="<?php _url(); ?>/assets/front/js/core/bootstrap.min.js" type="text/javascript"></script>


<script src="<?php _url(); ?>assets/coming/js/jquery-3.2.1.min.js"></script>
<script src="<?php _url(); ?>assets/coming/js/plugins.js"></script>
<script src="<?php _url(); ?>assets/coming/js/main.js"></script>
<script type="text/javascript">
$(document).ready(function () {
     setTimeout(function () {
          $('.alert').hide();
     }, 5000);
});
</script>

</body>
