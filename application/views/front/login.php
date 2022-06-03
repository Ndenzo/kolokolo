<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="utf-8" />
     <title>GSAcademie - <?= @$title ?></title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
     <meta content="Coderthemes" name="author" />
     <meta http-equiv="X-UA-Compatible" content="IE=edge" />
     <!-- App favicon -->
     <link rel="shortcut icon" href="<?php _url(); ?>assets/custom/img/logo/logo.png">

     <!-- App css -->
     <link href="<?php _url(); ?>assets/back/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
     <link href="<?php _url(); ?>assets/back/css/icons.min.css" rel="stylesheet" type="text/css" />
     <link href="<?php _url(); ?>assets/back/css/app.min.css" rel="stylesheet" type="text/css" />

</head>


<body class="authentication-bg" style="overflow: hidden;">

     <div class="account-pages mt-5 mb-5">
          <div class="container">
               <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-4 col-xl-5">
                         <div class="text-center">
                              <p class="text-muted mt-2 mb-4">Bienvenue sur GSAcademie !</p>
                         </div>
                         <div class="card" >

                              <div class="card-body p-4">
                                   <div class="row">
                                        <img src="<?php _url(); ?>assets/custom/img/logo/logo.jpg" alt="" class="ml-auto mr-auto" height="100" width="100">
                                   </div>

                                   <div class="text-center mb-4 mt-4">
                                        <h4 class="text-uppercase mt-0">Authentification</h4>
                                   </div>

                                   <form method="POST" action="<?php _url("auth/login") ?>">

                                        <div class="form-group mb-3">
                                             <label for="login">Nom utilisateur</label>
                                             <input class="form-control" type="text" name="username" id="login" required="" placeholder="Votre nom d'utilisateur ...">
                                        </div>

                                        <div class="form-group mb-3">
                                             <label for="password">Mot de passe</label>
                                             <input class="form-control" type="password" name="password"  id="password" required="" placeholder="Votre mot de passe ...">
                                        </div>



                                   <!-- <div class="form-group mb-3">
                                   <div class="custom-control custom-checkbox">
                                   <input type="checkbox" class="custom-control-input" id="checkbox-signin" checked>
                                   <label class="custom-control-label" for="checkbox-signin">Remember me</label>
                              </div>
                         </div> -->

                         <div class="form-group mb-0 text-center">
                              <button class="btn btn-primary btn-block" type="submit"> Connexion </button>
                         </div>

                         <?php
                         $message = $this->session->flashdata('message');
                         if(!empty($message)):?>
                         <div class="alert alert-danger mt-2">
                              <button class="close" data-close="alert"></button>
                              <?php echo $message;?>
                         </div>
                    <?php endif;?>

                    </form>



               </div> <!-- end card-body -->
               <div class="row mb-3">
                    <div class="col-12 text-center">
                         <p> <a href="pages-recoverpw.html" class="ml-1"><i class="fa fa-lock mr-1"></i>Mot de passe oublié ?</a></p>
                    </div> <!-- end col -->
               </div>
          </div>
          <!-- end card -->


          <!-- end row -->

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
