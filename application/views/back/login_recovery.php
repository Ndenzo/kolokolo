<!DOCTYPE html>
<html lang="en">

<head>
     <!-- Required meta tags -->
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <title>Recovery - ACS Capital</title>
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
                         <div class="col-lg-5 mx-auto" style="background-color: rgba(255,255,255,0.9);">
                              <div class="pt-3">
                                   <?php show_notification();?>
                              </div>
                              <div class="auth-form-transparent text-left p-5 text-center">
                                   <img class="lock-profile-img" src="<?php _url(); ?>assets/custom/img/logo/logo.jpg" alt="logo" style="border-radius:2px!important;">
                                   <form method="POST" action="<?php _url('auth/recover') ?>">

                                        <div class="authentication-box auth-minibox1">
                                             <div class="text-center"><img src="<?php _url(); ?>assets/custom/img/logo/logo.png" alt=""></div>
                                             <div class="mt-4 p-4 mb-0">
                                                  <div class="form-group">

                                                       <label class="col-form-label">Enter your Login</label>
                                                       <input class="form-control" type="email" name="user_email" placeholder="Your email or login" required>
                                                  </div>
                                                  <div class="form-group form-row mb-2">
                                                       <label for="password" class="col-md-8 text-left" style="padding-top: 7px;">
                                                            <a href="<?php _url("auth"); ?>" >
                                                                 Already have an account?
                                                            </a>
                                                       </label>
                                                       <!-- <div class="col-md-4"> -->
                                                            <button class="btn btn-success col-md-4" type="submit">Confirm</button>
                                                       <!-- </div> -->
                                                  </div>
                                             </div>
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
