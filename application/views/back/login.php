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
     <link rel="shortcut icon" href="<?php _url(); ?>assets/custom/img/logo/logo_outline.png"/>
</head>

<body class="sidebar-icon-only">
     <style media="screen">
     .swal-text {
          text-align: center;
     }
     </style>
     <div class="container-scroller">
          <div class="container-fluid page-body-wrapper full-page-wrapper">
               <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg" style="background-color: #fff!important;">
                    <div class="row flex-grow">
                         <div class="col-lg-6 d-flex align-items-center justify-content-center">
                              <div class="auth-form-transparent text-left p-3">
                                   <a href="https://capital-acs.com" class="brand-logo" style="margin-top:00px;">
                                        <center>
                                             <img src="<?php _url(); ?>assets/custom/img/logo/logo_outline.png" alt="logo" style="margin-left:auto!important; margin-right:auto!important;">
                                        </center>
                                   </a>
                                   <!-- <h4>Bienvenue !</h4> -->
                                   <form class="pt-3 my-login-validation mt-5" action="<?php _url('auth/login') ?>" method="POST">
                                        <div class="form-group">
                                             <label for="exampleInputEmail">Nom d'utilisateur ou Email</label>
                                             <div class="input-group">
                                                  <div class="input-group-prepend bg-transparent">
                                                       <span class="input-group-text bg-transparent border-right-0">
                                                            <i class="mdi mdi-account-outline text-primary"></i>
                                                       </span>
                                                  </div>
                                                  <input type="text" class="form-control form-control-lg border-left-0" name="username" placeholder="Utilisateur" required>
                                             </div>
                                        </div>
                                        <div class="form-group">
                                             <label for="exampleInputPassword">Mot de passe</label>
                                             <div class="input-group">
                                                  <div class="input-group-prepend bg-transparent">
                                                       <span class="input-group-text bg-transparent border-right-0">
                                                            <i class="mdi mdi-lock-outline text-primary"></i>
                                                       </span>
                                                  </div>
                                                  <input type="password" class="form-control form-control-lg border-left-0" name="password" placeholder="************" required>
                                             </div>
                                        </div>
                                        <div class="my-2 d-flex justify-content-between align-items-center">
                                             <a href="<?= _url('auth/recovery') ?>" class="auth-link text-black">Mot de passe oublié ?</a>
                                        </div>
                                        <div class="my-3">
                                             <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Connexion</button>
                                        </div>

                                        <div class="d-flex align-items-center mb-3 mt-3">
                                             <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                                             <span class="fw-bold text-gray-400 fs-7 mx-2">OU</span>
                                             <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                                        </div>

                                        <div class="mb-2 d-flex">
                                             <?= $google_auth ?>
                                             <!-- <button type="button" class="btn btn-google auth-form-btn flex-grow">
                                             <i class="mdi mdi-google"></i> Google
                                        </button> -->
                                   </div>

                                   <?php $message = $this->session->flashdata('message');?>
                                   <?php $type = $this->session->flashdata('type');?>
                                   <?php if(!empty($message)): ?>
                                        <div id="custom_alert_<?= $type ?>">
                                             <input type="hidden" id="custom_alert_message" value="<?= $message;?>">
                                             <input type="hidden" id="custom_alert_btn" value="<?= $this->lang->line('btn-cls') ?>">
                                        </div>

                                        <!-- <div class="alert alert-danger mt-2">
                                        <button class="close" data-close="alert"></button>
                                        <?php echo $message;?>
                                   </div> -->
                              <?php endif;?>
                              <div class="text-center mt-4 font-weight-light">
                                   Vous n'avez pas de compte ? <a href="<?= _url($module_base."register"); ?>" class="text-primary"><u>S'inscrire</u></a>
                              </div>
                         </form>
                    </div>
               </div>
               <div class="col-lg-6 login-half-bg d-flex flex-row">
                    <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy; <?= gmdate('Y') ?>  All rights reserved.</p>
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
<script src="<?php _url(); ?>assets/back/vendors/sweetalert/sweetalert.min.js"></script>
<!-- endinject -->
<!-- inject:js -->
<script src="<?php _url(); ?>assets/back/js/off-canvas.js"></script>
<script src="<?php _url(); ?>assets/back/js/hoverable-collapse.js"></script>
<script src="<?php _url(); ?>assets/back/js/template.js"></script>
<script src="<?php _url(); ?>assets/back/js/settings.js"></script>
<script src="<?php _url(); ?>assets/back/js/todolist.js"></script>
<script src="<?php _url(); ?>assets/back/js/alerts.js"></script>
<!-- endinject -->
</body>

</html>
