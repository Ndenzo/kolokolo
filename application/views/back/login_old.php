<!DOCTYPE html>
<html lang="en">
<head>
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- <meta name="description" content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
     <meta name="keywords" content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app"> -->
     <meta name="author" content="Ndenzo">
     <link rel="icon" href="<?php _url(config("logo")); ?>" type="image/x-icon">
     <link rel="shortcut icon" href="<?php _url(config("logo")); ?>" type="image/x-icon">
     <title><?= config("school_name") ?></title>
     <!-- Google font-->
     <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
     <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
     <link rel="stylesheet" type="text/css" href="<?php _url(); ?>assets/back/css/font-awesome.css">
     <!-- ico-font-->
     <link rel="stylesheet" type="text/css" href="<?php _url(); ?>assets/back/css/vendors/icofont.css">
     <!-- Themify icon-->
     <link rel="stylesheet" type="text/css" href="<?php _url(); ?>assets/back/css/vendors/themify.css">
     <!-- Flag icon-->
     <link rel="stylesheet" type="text/css" href="<?php _url(); ?>assets/back/css/vendors/flag-icon.css">
     <!-- Feather icon-->
     <link rel="stylesheet" type="text/css" href="<?php _url(); ?>assets/back/css/vendors/feather-icon.css">
     <!-- Plugins css start-->
     <!-- Plugins css Ends-->
     <!-- Bootstrap css-->
     <link rel="stylesheet" type="text/css" href="<?php _url(); ?>assets/back/css/vendors/bootstrap.css">
     <!-- App css-->
     <link rel="stylesheet" type="text/css" href="<?php _url(); ?>assets/back/css/style.css">
     <link id="color" rel="stylesheet" href="<?php _url(); ?>assets/back/css/color-1.css" media="screen">
     <!-- Responsive css-->
     <link rel="stylesheet" type="text/css" href="<?php _url(); ?>assets/back/css/responsive.css">
</head>
<body>
     <!-- login page start-->
     <div class="container-fluid">
          <div class="row">
               <div class="col-xl-7"><img class="bg-img-cover bg-center" src="<?php _url(); ?>assets/back/images/login/2.jpg" alt="looginpage"></div>
               <div class="col-xl-5 p-0">
                    <div class="login-card">
                         <div>

                              <div class="login-main">
                                   <form class="theme-form my-login-validation" novalidate="" action="<?php _url('auth/login') ?>" method="POST">
                                        <h4>Connexion au compte</h4>
                                        <p>Entrez votre identifiant et votre mot de passe</p>
                                        <div class="form-group">
                                             <label class="col-form-label">Adresse email ou Nom d'utilisateur</label>
                                             <input type="text" id="username" class="form-control" placeholder="Identifiant" name="username" required autofocus>
                                        </div>
                                        <div class="form-group">
                                             <label class="col-form-label">Mot de passe</label>
                                             <div class="form-input position-relative">
                                                  <input class="form-control" type="password" name="password" required="" placeholder="*********">
                                                  <div class="show-hide"></div>
                                             </div>
                                        </div>
                                        <div class="form-group mb-0 m-t-30 m-b-50">
                                             <button class="btn btn-primary btn-block w-100" type="submit">Connexion</button>
                                        </div>
                                        <!-- <h6 class="text-muted mt-4 or">Ou créez un compte</h6>
                                        <p class="mt-4 mb-0 text-center">Don't have account?<a class="ms-2" href="#">Create Account</a></p> -->
                                   </form>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
          <!-- latest jquery-->
          <script src="<?php _url(); ?>assets/back/js/jquery-3.5.1.min.js"></script>
          <!-- Bootstrap js-->
          <script src="<?php _url(); ?>assets/back/js/bootstrap/bootstrap.bundle.min.js"></script>
          <!-- feather icon js-->
          <script src="<?php _url(); ?>assets/back/js/icons/feather-icon/feather.min.js"></script>
          <script src="<?php _url(); ?>assets/back/js/icons/feather-icon/feather-icon.js"></script>
          <!-- scrollbar js-->
          <!-- Sidebar jquery-->
          <script src="<?php _url(); ?>assets/back/js/config.js"></script>
          <!-- Plugins JS start-->
          <!-- Plugins JS Ends-->
          <!-- Theme js-->
          <script src="<?php _url(); ?>assets/back/js/script.js"></script>
          <!-- login js-->
          <!-- Plugin used-->
     </div>
</body>
</html>
