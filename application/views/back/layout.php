<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <title>Dore</title>
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

     <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i&amp;display=swap" rel="stylesheet">
     <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700&amp;display=swap" rel="stylesheet">

     <link rel="stylesheet" href="<?php _url(); ?>assets/back/font/iconsmind-s/css/iconsminds.css" />
     <link rel="stylesheet" href="<?php _url(); ?>assets/back/font/simple-line-icons/css/simple-line-icons.css" />
     <link rel="stylesheet" type="text/css" href="<?php _url(); ?>assets/custom/font/fontawesome.css">


     <link rel="stylesheet" href="<?php _url(); ?>assets/back/css/vendor/bootstrap.min.css" />
     <link rel="stylesheet" href="<?php _url(); ?>assets/back/css/vendor/bootstrap.rtl.only.min.css" />
     <link rel="stylesheet" href="<?php _url(); ?>assets/back/css/vendor/component-custom-switch.min.css" />
     <link rel="stylesheet" href="<?php _url(); ?>assets/back/css/vendor/fullcalendar.min.css" />
     <link rel="stylesheet" href="<?php _url(); ?>assets/back/css/vendor/dataTables.bootstrap4.min.css" />
     <link rel="stylesheet" href="<?php _url(); ?>assets/back/css/vendor/datatables.responsive.bootstrap4.min.css" />
     <link rel="stylesheet" href="<?php _url(); ?>assets/back/css/vendor/select2.min.css" />
     <link rel="stylesheet" href="<?php _url(); ?>assets/back/css/vendor/select2-bootstrap.min.css" />
     <link rel="stylesheet" href="<?php _url(); ?>assets/back/css/vendor/perfect-scrollbar.css" />
     <link rel="stylesheet" href="<?php _url(); ?>assets/back/css/vendor/glide.core.min.css" />
     <link rel="stylesheet" href="<?php _url(); ?>assets/back/css/vendor/bootstrap-stars.css" />
     <link rel="stylesheet" href="<?php _url(); ?>assets/back/css/vendor/nouislider.min.css" />
     <link rel="stylesheet" href="<?php _url(); ?>assets/back/css/vendor/bootstrap-datepicker3.min.css" />
     <link rel="stylesheet" href="<?php _url(); ?>assets/back/css/vendor/quill.snow.css" />
     <link rel="stylesheet" href="<?php _url(); ?>assets/back/css/vendor/quill.bubble.css" />
     <link rel="stylesheet" href="<?php _url(); ?>assets/back/css/vendor/component-custom-switch.min.css" />

     <link rel="stylesheet" href="<?php _url(); ?>assets/back/css/main.css" />

     <link rel="stylesheet" type="text/css" href="<?php _url(); ?>assets/custom/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
     <link rel="stylesheet" href="<?php _url(); ?>assets/custom/plugins/jquery-ui/jquery-ui.css">

     <?php echo load_css();?>

     <script>
     var BASE_URL = '<?php _url();?>';
     </script>
</head>

<body id="app-container" class="menu-default show-spinner">
     <style media="screen">
     .card-img{
          height: 250px;
     }
     .btn{
          padding-left: 0.75rem;
          padding-right: 0.75rem;
     }
     .data-table *{
          text-align: center;
     }
     </style>
     <nav class="navbar fixed-top">
          <div class="d-flex align-items-center navbar-left">
               <a href="#" class="menu-button d-none d-md-block">
                    <svg class="main" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9 17">
                         <rect x="0.48" y="0.5" width="7" height="1" />
                         <rect x="0.48" y="7.5" width="7" height="1" />
                         <rect x="0.48" y="15.5" width="7" height="1" />
                    </svg>
                    <svg class="sub" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17">
                         <rect x="1.56" y="0.5" width="16" height="1" />
                         <rect x="1.56" y="7.5" width="16" height="1" />
                         <rect x="1.56" y="15.5" width="16" height="1" />
                    </svg>
               </a>

               <a href="#" class="menu-button-mobile d-xs-block d-sm-block d-md-none">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 17">
                         <rect x="0.5" y="0.5" width="25" height="1" />
                         <rect x="0.5" y="7.5" width="25" height="1" />
                         <rect x="0.5" y="15.5" width="25" height="1" />
                    </svg>
               </a>

               <div class="search" data-search-path="Pages.Search.html?q=">
                    <input placeholder="Search...">
                    <span class="search-icon">
                         <i class="simple-icon-magnifier"></i>
                    </span>
               </div>
          </div>


          <a class="navbar-logo" href="Dashboard.Default.html">
               <span class="logo d-none d-xs-block"></span>
               <span class="logo-mobile d-block d-xs-none"></span>
          </a>

          <div class="navbar-right">
               <div class="header-icons d-inline-block align-middle">
                    <div class="d-none d-md-inline-block align-text-bottom mr-3">
                         <div class="custom-switch custom-switch-primary-inverse custom-switch-small pl-1" data-toggle="tooltip" data-placement="left" title="Dark Mode">
                              <input class="custom-switch-input" id="switchDark" type="checkbox" checked>
                              <label class="custom-switch-btn" for="switchDark"></label>
                         </div>
                    </div>

                    <button class="header-icon btn btn-empty d-none d-sm-inline-block" type="button" id="fullScreenButton">
                         <i class="simple-icon-size-fullscreen"></i>
                         <i class="simple-icon-size-actual"></i>
                    </button>

               </div>

               <div class="user d-inline-block">
                    <button class="btn btn-empty p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         <span class="name"><?= @me('user_nicename') ?></span>
                         <span>
                              <img class="Profile Picture"  src="<?= _url(@me('person_picture')) ?>" alt="No image" >
                         </span>
                    </button>

                    <div class="dropdown-menu dropdown-menu-right mt-3">
                         <a class="dropdown-item" href="<?php _url('profile/root'); ?>">Account</a>
                         <a class="dropdown-item" href="<?php _url('auth/logout'); ?>">Sign out</a>
                    </div>
               </div>
          </div>
     </nav>

     <?= @$menu ?>

     <main>
          <div class="container-fluid">
               <?= @$content ?>
          </div>
     </main>

     <footer class="page-footer">
          <div class="footer-content">
               <div class="container-fluid">
                    <div class="row">
                         <div class="col-12 col-sm-6">
                              <p class="mb-0 text-muted">Ndenzo &copy;<?= gmdate('Y') ?></p>
                         </div>
                    </div>
               </div>
          </div>
     </footer>


     <script src="<?php _url(); ?>assets/back/js/vendor/jquery-3.3.1.min.js"></script>
     <script src="<?php _url(); ?>assets/back/js/vendor/bootstrap.bundle.min.js"></script>
     <script src="<?php _url(); ?>assets/back/js/vendor/Chart.bundle.min.js"></script>
     <script src="<?php _url(); ?>assets/back/js/vendor/chartjs-plugin-datalabels.js"></script>
     <script src="<?php _url(); ?>assets/back/js/vendor/moment.min.js"></script>
     <script src="<?php _url(); ?>assets/back/js/vendor/fullcalendar.min.js"></script>
     <script src="<?php _url(); ?>assets/back/js/vendor/perfect-scrollbar.min.js"></script>
     <script src="<?php _url(); ?>assets/back/js/vendor/datatables.min.js"></script>
     <script src="<?php _url(); ?>assets/back/js/vendor/glide.min.js"></script>
     <script src="<?php _url(); ?>assets/back/js/vendor/progressbar.min.js"></script>
     <script src="<?php _url(); ?>assets/back/js/vendor/jquery.barrating.min.js"></script>
     <script src="<?php _url(); ?>assets/back/js/vendor/select2.full.js"></script>
     <script src="<?php _url(); ?>assets/back/js/vendor/nouislider.min.js"></script>
     <script src="<?php _url(); ?>assets/back/js/vendor/bootstrap-datepicker.js"></script>
     <script src="<?php _url(); ?>assets/back/js/vendor/Sortable.js"></script>

     <!-- <script src="<?php _url(); ?>assets/back/js/vendor/quill.min.js"></script> -->
     <script src="<?php _url(); ?>assets/back/js/vendor/ckeditor5-build-classic/ckeditor.js"></script>

     <script src="<?php _url(); ?>assets/back/js/vendor/mousetrap.min.js"></script>
     <script src="<?php _url(); ?>assets/back/js/dore.script.js"></script>
     <script src="<?php _url(); ?>assets/back/js/scripts.js"></script>

     <script src="<?php _url(); ?>assets/custom/plugins/jquery-ui/jquery-ui.min.js"></script>
     <script src="<?php _url(); ?>assets/custom/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
     <script src="<?php _url(); ?>assets/custom/js/jquery-inputmask/jquery.inputmask.bundle.min.js" type="text/javascript"></script>
     <script src="<?php _url(); ?>assets/custom/js/script.js"></script>

     <?php echo load_js();?>
</body>

</html>
