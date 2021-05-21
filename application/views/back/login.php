<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <title>Content - <?= @$title ?></title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="IE=edge" />
     <link rel="shortcut icon" href="<?php _url(); ?>assets/back/images/logo.png">

     <link rel="stylesheet" href="<?php _url(); ?>assets/back/font/iconsmind-s/css/iconsminds.css" />
     <link rel="stylesheet" href="<?php _url(); ?>assets/back/font/simple-line-icons/css/simple-line-icons.css" />

     <link rel="stylesheet" href="<?php _url(); ?>assets/back/css/vendor/bootstrap.min.css" />
     <link rel="stylesheet" href="<?php _url(); ?>assets/back/css/vendor/bootstrap.rtl.only.min.css" />
     <link rel="stylesheet" href="<?php _url(); ?>assets/back/css/vendor/bootstrap-float-label.min.css" />
     <link rel="stylesheet" href="<?php _url(); ?>assets/back/css/main.css" />

     <script>
     var BASE_URL = '<?php _url();?>';
     </script>
</head>

<body class="background show-spinner no-footer">
     <div class="fixed-backgroun"></div>
     <main>
          <div class="container">
               <div class="row h-100">
                    <div class="col-12 col-md-10 mx-auto my-auto">
                         <div class="card auth-card">
                              <div class="position-relative image-side ">
                                   <p class=" text-white h2">ND Content Manager</p>
                              </div>
                              <div class="form-side">
                                   <a href="Dashboard.Default.html" aria-label="label">
                                        <span class="logo-single"></span>
                                   </a>
                                   <h6 class="mb-4">Login</h6>
                                   <form method="post" action="<?php _url("auth/login") ?>">
                                        <label class="form-group has-float-label mb-4">
                                             <input class="form-control" type="text" name="username" id="login" placeholder="Votre nom d'utilisateur ..." required/>
                                             <span>E-mail</span>
                                        </label>

                                        <label class="form-group has-float-label mb-4">
                                             <input class="form-control" type="password" name="password"  id="password" placeholder="Votre mot de passe ..." required/>
                                             <span>Password</span>
                                        </label>
                                        <?php $message = $this->session->flashdata('message'); ?>
                                        <?php if(!empty($message)):?>
                                             <div class="alert alert-danger mt-2">
                                                  <button class="close" data-close="alert"></button>
                                                  <?php echo $message;?>
                                             </div>
                                        <?php endif;?>
                                        <div class="d-flex justify-content-between align-items-center">
                                             <a href="#" aria-label="label">Forget password?</a>
                                             <button class="btn btn-primary btn-lg btn-shadow" type="submit">LOGIN</button>
                                        </div>
                                   </form>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </main>
     <script src="<?php _url(); ?>assets/back/js/vendor/jquery-3.3.1.min.js"></script>
     <script src="<?php _url(); ?>assets/back/js/vendor/bootstrap.bundle.min.js"></script>
     <script src="<?php _url(); ?>assets/back/js/dore.script.js"></script>
     <script src="<?php _url(); ?>assets/back/js/scripts.js"></script>
</body>

</html>
