<!doctype html>
<html class="no-js" lang="">

<head>
     <meta charset="utf-8">
     <meta http-equiv="x-ua-compatible" content="ie=edge">
     <title>Login Register | Notika - Notika Admin Template</title>
     <meta name="description" content="">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <!-- favicon
     ============================================ -->
     <link rel="shortcut icon" type="image/x-icon" href="<?php _url(); ?>assets/back/img/favicon.ico">
     <!-- Google Fonts
     ============================================ -->
     <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
     <!-- Bootstrap CSS
     ============================================ -->
     <link rel="stylesheet" href="<?php _url(); ?>assets/back/css/bootstrap.min.css">
     <!-- font awesome CSS
     ============================================ -->
     <link rel="stylesheet" href="<?php _url(); ?>assets/back/css/font-awesome.min.css">
     <!-- owl.carousel CSS
     ============================================ -->
     <link rel="stylesheet" href="<?php _url(); ?>assets/back/css/owl.carousel.css">
     <link rel="stylesheet" href="<?php _url(); ?>assets/back/css/owl.theme.css">
     <link rel="stylesheet" href="<?php _url(); ?>assets/back/css/owl.transitions.css">
     <!-- animate CSS
     ============================================ -->
     <link rel="stylesheet" href="<?php _url(); ?>assets/back/css/animate.css">
     <!-- normalize CSS
     ============================================ -->
     <link rel="stylesheet" href="<?php _url(); ?>assets/back/css/normalize.css">
     <!-- mCustomScrollbar CSS
     ============================================ -->
     <link rel="stylesheet" href="<?php _url(); ?>assets/back/css/scrollbar/jquery.mCustomScrollbar.min.css">
     <!-- wave CSS
     ============================================ -->
     <link rel="stylesheet" href="<?php _url(); ?>assets/back/css/wave/waves.min.css">
     <!-- Notika icon CSS
     ============================================ -->
     <link rel="stylesheet" href="<?php _url(); ?>assets/back/css/notika-custom-icon.css">
     <!-- main CSS
     ============================================ -->
     <link rel="stylesheet" href="<?php _url(); ?>assets/back/css/main.css">
     <!-- style CSS
     ============================================ -->
     <link rel="stylesheet" href="<?php _url(); ?>assets/back/style.css">
     <!-- responsive CSS
     ============================================ -->
     <link rel="stylesheet" href="<?php _url(); ?>assets/back/css/responsive.css">
     <!-- modernizr JS
     ============================================ -->
     <script src="<?php _url(); ?>assets/back/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
     <!--[if lt IE 8]>
     <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
     <![endif]-->
     <!-- Login Register area Start-->
     <div class="login-content">
          <!-- Login -->
          <form class="nk-block toggled" id="l-login" method="post" action="<?php _url("auth/login") ?>">
               <div class="nk-form">
                    <div class="input-group">
                         <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-support"></i></span>
                         <div class="nk-int-st">
                              <input type="text" class="form-control" name="username" placeholder="Nom d'utilisateur">
                         </div>
                    </div>
                    <div class="input-group mg-t-15">
                         <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-edit"></i></span>
                         <div class="nk-int-st">
                              <input type="password" class="form-control" name="password" placeholder="Mot de passe">
                         </div>
                    </div>
                    <button type="submit" class="btn btn-login btn-success btn-float" name="" value="">
                         <i class="notika-icon notika-right-arrow right-arrow-ant"></i>
                    </button>
                    <!-- <a href="#l-register" data-ma-action="nk-login-switch" data-ma-block="#l-register" class="btn btn-login btn-success btn-float"></a> -->
               </div>

               <div class="nk-navigation nk-lg-ic">
                    <a href="#" data-ma-action="nk-login-switch" data-ma-block="#l-register"><i class="notika-icon notika-plus-symbol"></i> <span>Créer compte</span></a>
                    <a href="#" data-ma-action="nk-login-switch" data-ma-block="#l-forget-password"><i>?</i> <span>Mot de passe oublié</span></a>
               </div>
          </form>


          <!-- Register -->
          <div class="nk-block" id="l-register">
               <div class="nk-form">
                    <div class="input-group">
                         <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-support"></i></span>
                         <div class="nk-int-st">
                              <input type="text" class="form-control" placeholder="Nom d'utilisateur">
                         </div>
                    </div>

                    <div class="input-group mg-t-15">
                         <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-mail"></i></span>
                         <div class="nk-int-st">
                              <input type="text" class="form-control" placeholder="Adresse email">
                         </div>
                    </div>

                    <div class="input-group mg-t-15">
                         <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-edit"></i></span>
                         <div class="nk-int-st">
                              <input type="password" class="form-control" placeholder="Mot de passe">
                         </div>
                    </div>

                    <a href="#l-login" data-ma-action="nk-login-switch" data-ma-block="#l-login" class="btn btn-login btn-success btn-float"><i class="notika-icon notika-right-arrow"></i></a>
               </div>

               <div class="nk-navigation rg-ic-stl">
                    <a href="#" data-ma-action="nk-login-switch" data-ma-block="#l-login"><i class="notika-icon notika-right-arrow"></i> <span>Connexion</span></a>
                    <a href="" data-ma-action="nk-login-switch" data-ma-block="#l-forget-password"><i>?</i> <span>Mot de passe oublié</span></a>
               </div>
          </div>

          <!-- Forgot Password -->
          <div class="nk-block" id="l-forget-password">
               <div class="nk-form">
                    <p class="text-left">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eu risus. Curabitur commodo lorem fringilla enim feugiat commodo sed ac lacus.</p>

                    <div class="input-group">
                         <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-mail"></i></span>
                         <div class="nk-int-st">
                              <input type="text" class="form-control" placeholder="Email Address">
                         </div>
                    </div>

                    <a href="#l-login" data-ma-action="nk-login-switch" data-ma-block="#l-login" class="btn btn-login btn-success btn-float"><i class="notika-icon notika-right-arrow"></i></a>
               </div>

               <div class="nk-navigation nk-lg-ic rg-ic-stl">
                    <a href="" data-ma-action="nk-login-switch" data-ma-block="#l-login"><i class="notika-icon notika-right-arrow"></i> <span>Connexion</span></a>
                    <a href="" data-ma-action="nk-login-switch" data-ma-block="#l-register"><i class="notika-icon notika-plus-symbol"></i> <span>Créer compte</span></a>
               </div>
          </div>
     </div>
     <!-- Login Register area End-->
     <!-- jquery
     ============================================ -->
     <script src="<?php _url(); ?>assets/back/js/vendor/jquery-1.12.4.min.js"></script>
     <!-- bootstrap JS
     ============================================ -->
     <script src="<?php _url(); ?>assets/back/js/bootstrap.min.js"></script>
     <!-- wow JS
     ============================================ -->
     <script src="<?php _url(); ?>assets/back/js/wow.min.js"></script>
     <!-- price-slider JS
     ============================================ -->
     <script src="<?php _url(); ?>assets/back/js/jquery-price-slider.js"></script>
     <!-- owl.carousel JS
     ============================================ -->
     <script src="<?php _url(); ?>assets/back/js/owl.carousel.min.js"></script>
     <!-- scrollUp JS
     ============================================ -->
     <script src="<?php _url(); ?>assets/back/js/jquery.scrollUp.min.js"></script>
     <!-- meanmenu JS
     ============================================ -->
     <script src="<?php _url(); ?>assets/back/js/meanmenu/jquery.meanmenu.js"></script>
     <!-- counterup JS
     ============================================ -->
     <script src="<?php _url(); ?>assets/back/js/counterup/jquery.counterup.min.js"></script>
     <script src="<?php _url(); ?>assets/back/js/counterup/waypoints.min.js"></script>
     <script src="<?php _url(); ?>assets/back/js/counterup/counterup-active.js"></script>
     <!-- mCustomScrollbar JS
     ============================================ -->
     <script src="<?php _url(); ?>assets/back/js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
     <!-- sparkline JS
     ============================================ -->
     <script src="<?php _url(); ?>assets/back/js/sparkline/jquery.sparkline.min.js"></script>
     <script src="<?php _url(); ?>assets/back/js/sparkline/sparkline-active.js"></script>
     <!-- flot JS
     ============================================ -->
     <script src="<?php _url(); ?>assets/back/js/flot/jquery.flot.js"></script>
     <script src="<?php _url(); ?>assets/back/js/flot/jquery.flot.resize.js"></script>
     <script src="<?php _url(); ?>assets/back/js/flot/flot-active.js"></script>
     <!-- knob JS
     ============================================ -->
     <script src="<?php _url(); ?>assets/back/js/knob/jquery.knob.js"></script>
     <script src="<?php _url(); ?>assets/back/js/knob/jquery.appear.js"></script>
     <script src="<?php _url(); ?>assets/back/js/knob/knob-active.js"></script>
     <!--  Chat JS
     ============================================ -->
     <script src="<?php _url(); ?>assets/back/js/chat/jquery.chat.js"></script>
     <!--  wave JS
     ============================================ -->
     <script src="<?php _url(); ?>assets/back/js/wave/waves.min.js"></script>
     <script src="<?php _url(); ?>assets/back/js/wave/wave-active.js"></script>
     <!-- icheck JS
     ============================================ -->
     <script src="<?php _url(); ?>assets/back/js/icheck/icheck.min.js"></script>
     <script src="<?php _url(); ?>assets/back/js/icheck/icheck-active.js"></script>
     <!--  todo JS
     ============================================ -->
     <script src="<?php _url(); ?>assets/back/js/todo/jquery.todo.js"></script>
     <!-- Login JS
     ============================================ -->
     <script src="<?php _url(); ?>assets/back/js/login/login-action.js"></script>
     <!-- plugins JS
     ============================================ -->
     <script src="<?php _url(); ?>assets/back/js/plugins.js"></script>
     <!-- main JS
     ============================================ -->
     <script src="<?php _url(); ?>assets/back/js/main.js"></script>
</body>

</html>
