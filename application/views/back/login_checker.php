<!DOCTYPE html>
<html lang="en">

<head>
     <!-- Required meta tags -->
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <title><?= $title ?> - ACS Capital</title>
     <!-- base:css -->
     <link rel="stylesheet" href="<?php _url(); ?>assets/back/vendors/mdi/css/materialdesignicons.min.css">
     <link rel="stylesheet" href="<?php _url(); ?>assets/back/vendors/css/vendor.bundle.base.css">
     <!-- endinject -->
     <!-- plugin css for this page -->
     <!-- End plugin css for this page -->
     <!-- inject:css -->
     <link rel="stylesheet" href="<?php _url(); ?>assets/back/css/vertical-layout-light/style.css">
     <!-- endinject -->
     <link rel="shortcut icon" href="<?php _url(); ?>assets/custom/img/logo/logo.jpg"/>
</head>

<body>
     <div class="container-scroller">
          <div class="container-fluid page-body-wrapper full-page-wrapper">
               <div class="content-wrapper d-flex align-items-center auth lock-full-bg">
                    <div class="row w-100" >
                         <div class="col-lg-4 mx-auto" style="background-color: rgba(255,255,255,0.9);">
                              <div class="pt-3">
                                   <?php show_notification();?>
                              </div>
                              <div class="auth-form-transparent text-left p-5 text-center">
                                   <img class="lock-profile-img" src="<?php _url(); ?>assets/custom/img/logo/logo.jpg" alt="logo" style="border-radius:2px!important;">
                                   <form method="post" action="<?= _url($module_base."confirmation") ?>" class="pt-5">
                                        <div class="form-group">
                                             <label for="examplePassword1">Saisir le code pour valider votre inscription</label>
                                             <input type="text" class="form-control text-center" name="code" placeholder="Code" required>
                                        </div>
                                        <div class="mt-5">
                                             <button type="submit" class="btn btn-block btn-success btn-lg font-weight-medium">Confirmer</button>
                                        </div>
                                        <div class="mt-3 text-center">
                                             <input type="hidden" name="hash" value="<?= $hash ?>">
                                             <a href="<?= _url("/") ?>" class="auth-link text-primary">Utiliser un autre compte ?</a>
                                        </div>
                                   </form>
                              </div>
                         </div>
                    </div>
               </div>
               <!-- content-wrapper ends -->
          </div>
          <!-- page-body-wrapper ends -->
     </div>
     <!-- container-scroller -->
     <!-- base:js -->
     <script src="<?php _url(); ?>assets/back/vendors/js/vendor.bundle.base.js"></script>
     <!-- endinject -->
     <!-- inject:js -->
     <script src="<?php _url(); ?>assets/back/js/off-canvas.js"></script>
     <script src="<?php _url(); ?>assets/back/js/hoverable-collapse.js"></script>
     <script src="<?php _url(); ?>assets/back/js/template.js"></script>
     <script src="<?php _url(); ?>assets/back/js/settings.js"></script>
     <script src="<?php _url(); ?>assets/back/js/todolist.js"></script>
     <!-- endinject -->
</body>

</html>
