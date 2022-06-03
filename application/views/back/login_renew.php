<!DOCTYPE html>
<html lang="en">

<head>
     <!-- Required meta tags -->
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <title>Renew - ACS Capital</title>
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
                                   <h4 class="mt-5 mb-5">Reset Your Password</h4>
                                   <form class="validatedForm" method="POST" action="<?php _url('auth/update') ?>">
                                        <div class="text-center mt-4 mb-4"><span class="reset-password-link">If don't receive an email?  <a class="btn-link text-danger" href="<?php _url("auth/renew"); ?>">Resend</a></span></div>
                                        <div class="form-group">
                                             <label class="col-form-label">Confirm your email !</label>
                                             <input class="form-control" type="email" name="user_email">
                                        </div>
                                        <div class="form-group rounded p-4 opt-box">
                                             <label class="col-form-label pt-0">Enter your code</label>
                                             <div class="form-row">
                                                  <div class="col">
                                                       <input class="form-control digits text-center opt-text" type="text" placeholder="00" maxlength="2" name="code[]" onkeyup="this.value = this.value.toUpperCase();" required>
                                                  </div>
                                                  <div class="col">
                                                       <input class="form-control digits text-center opt-text" type="text" placeholder="00" maxlength="2" name="code[]" onkeyup="this.value = this.value.toUpperCase();" required>
                                                  </div>
                                                  <div class="col">
                                                       <input class="form-control digits text-center opt-text" type="text" placeholder="00" maxlength="2" name="code[]" onkeyup="this.value = this.value.toUpperCase();"x required>
                                                  </div>
                                             </div>
                                        </div>
                                        <h6 class="f-14 mt-4 mb-3">CREATE YOUR PASSWORD</h6>
                                        <div class="form-group">
                                             <label class="col-form-label">New Password</label>
                                             <input type="password" class="form-control" placeholder="Your password .." name="password" id="password">
                                        </div>
                                        <div class="form-group">
                                             <label class="col-form-label">Retype Password</label>
                                             <input type="password" class="form-control" placeholder="Rewrite your password .." name="password_confirm">
                                        </div>
                                        <div class="form-group form-row mb-2">
                                                  <button class="btn btn-primary col-md-4 mx-auto" type="submit">Submit</button>
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
