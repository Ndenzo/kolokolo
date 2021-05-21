<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="utf-8" />
     <title><?= $title ?></title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
     <meta content="Coderthemes" name="author" />
     <meta http-equiv="X-UA-Compatible" content="IE=edge" />
     <!-- App favicon -->
     <link rel="shortcut icon" href="<?php _url(); ?>assets/back/images/favicon.ico">

     <!-- App css -->
     <link href="<?php _url(); ?>assets/back/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
     <link href="<?php _url(); ?>assets/back/css/icons.min.css" rel="stylesheet" type="text/css" />
     <link href="<?php _url(); ?>assets/back/css/app.min.css" rel="stylesheet" type="text/css" />

</head>


<body class="authentication-bg">

     <div class="account-pages mt-5 mb-5">
          <div class="container">
               <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                         <div class="text-center">
                              <p class="text-muted mt-2 mb-4">Bienvenue sur Compt'Ability !</p>
                         </div>
                         <div class="card">

                              <div class="card-body p-4">

                                   <div class="row">
                                        <img src="<?php _url(); ?>assets/back/images/logo.png" alt="" class="ml-auto mr-auto" height="100" width="100">
                                   </div>

                                   <div class="text-center">
                                        <h1 class="text-error">404</h1>
                                        <h3 class="mt-3 mb-2">Page non trouvée</h3>
                                        <p class="text-muted mb-3">
                                             Il se trouve que la page demandée n'existe pas. Cliquez sur le bouton ci-dessous pour retourner dans l'application
                                        </p>

                                        <a href="<?= _url("dashboard") ?>" class="btn btn-danger waves-effect waves-light"><i class="fas fa-home mr-1"></i> Retour à l'application</a>
                                   </div>


                              </div> <!-- end card-body -->
                         </div>
                         <!-- end card -->

                    </div> <!-- end col -->
               </div>
               <!-- end row -->
          </div>
          <!-- end container -->
     </div>
     <!-- end page -->


     <!-- Vendor js -->
     <script src="<?php _url(); ?>assets/back/js/vendor.min.js"></script>

     <!-- App js -->
     <script src="<?php _url(); ?>assets/back/js/app.min.js"></script>

</body>
</html>
