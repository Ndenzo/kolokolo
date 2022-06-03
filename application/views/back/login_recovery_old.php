<!DOCTYPE html>
<html lang="en">
<head>
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta name="description" content="Xolo admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
     <meta name="keywords" content="admin template, Xolo admin template, dashboard template, flat admin template, responsive admin template, web app">
     <meta name="author" content="pixelstrap">
     <link rel="icon" href="<?php _url(); ?>assets/custom/img/logo/logo.png" type="image/x-icon">
     <link rel="shortcut icon" href="<?php _url(); ?>assets/custom/img/logo/logo.png" type="image/x-icon">
     <title><?= $title ?> | Langack</title>
     <!-- Google font-->
     <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i&amp;display=swap" rel="stylesheet">
     <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700&amp;display=swap" rel="stylesheet">
     <!-- Font Awesome-->
     <link rel="stylesheet" type="text/css" href="<?php _url(); ?>assets/back/css/fontawesome.css">
     <!-- ico-font-->
     <link rel="stylesheet" type="text/css" href="<?php _url(); ?>assets/back/css/icofont.css">
     <!-- Themify icon-->
     <link rel="stylesheet" type="text/css" href="<?php _url(); ?>assets/back/css/themify.css">
     <!-- Flag icon-->
     <link rel="stylesheet" type="text/css" href="<?php _url(); ?>assets/back/css/flag-icon.css">
     <!-- Feather icon-->
     <link rel="stylesheet" type="text/css" href="<?php _url(); ?>assets/back/css/feather-icon.css">
     <!-- Plugins css start-->
     <!-- Plugins css Ends-->
     <!-- Bootstrap css-->
     <link rel="stylesheet" type="text/css" href="<?php _url(); ?>assets/back/css/bootstrap.css">
     <!-- App css-->
     <link rel="stylesheet" type="text/css" href="<?php _url(); ?>assets/back/css/style.css">
     <link id="color" rel="stylesheet" href="<?php _url(); ?>assets/back/css/color-1.css" media="screen">
     <!-- Responsive css-->
     <link rel="stylesheet" type="text/css" href="<?php _url(); ?>assets/back/css/responsive.css">
     <script async src="https://www.googletagmanager.com/gtag/js?id=G-X5XKLQRTME"></script>
     <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'G-X5XKLQRTME');

     </script>
</head>
<body>
     <!-- Loader starts-->
     <div class="loader-wrapper">
          <div class="theme-loader"></div>
     </div>
     <!-- Loader ends-->
     <!-- page-wrapper Start-->
     <div class="page-wrapper">
          <div class="container-fluid">
               <!-- Unlock page start-->
               <div class="authentication-main mt-0">
                    <div class="row">
                         <div class="col-md-12 p-0">
                              <div class="auth-innerright auth-minibox">
                                   <form method="POST" action="<?php _url('auth/recover') ?>">

                                        <div class="authentication-box auth-minibox1">
                                             <div class="text-center"><img src="<?php _url(); ?>assets/custom/img/logo/logo.png" alt=""></div>
                                             <div class="card mt-4 p-4 mb-0">
                                                  <form class="theme-form">
                                                       <div class="form-group">

                                                            <label class="col-form-label">Enter your Login</label>
                                                            <input class="form-control" type="email" name="user_email" required>
                                                       </div>
                                                       <div class="form-group form-row mb-2">
                                                            <label for="password" class="col-md-8" style="padding-top: 7px;">
                                                                 <a href="<?php _url("auth"); ?>" >
                                                                      Already have an account?
                                                                 </a>
                                                            </label>
                                                            <div class="col-md-4">
                                                                 <button class="btn btn-primary form-control" type="submit">Confirm</button>
                                                            </div>
                                                       </div>
                                                  </form>
                                             </div>
                                        </div>

                                   </form>
                              </div>
                         </div>
                    </div>
               </div>
               <!-- Unlock page end-->
          </div>
     </div>
     <!-- page-wrapper Ends-->
     <!-- latest jquery-->
     <script src="<?php _url(); ?>assets/back/js/jquery-3.2.1.min.js"></script>
     <!-- Bootstrap js-->
     <script src="<?php _url(); ?>assets/back/js/bootstrap/popper.min.js"></script>
     <script src="<?php _url(); ?>assets/back/js/bootstrap/bootstrap.js"></script>
     <!-- feather icon js-->
     <script src="<?php _url(); ?>assets/back/js/icons/feather-icon/feather.min.js"></script>
     <script src="<?php _url(); ?>assets/back/js/icons/feather-icon/feather-icon.js"></script>
     <!-- Sidebar jquery-->
     <script src="<?php _url(); ?>assets/back/js/sidebar-menu.js"></script>
     <script src="<?php _url(); ?>assets/back/js/config.js"></script>
     <!-- Plugins JS start-->
     <!-- Plugins JS Ends-->
     <!-- Theme js-->
     <script src="<?php _url(); ?>assets/back/js/script.js"></script>
     <!-- login js-->
     <!-- Plugin used-->
</body>
</html>
