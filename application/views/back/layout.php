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
     <link rel="stylesheet" href="<?php _url(); ?>assets/back/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
     <link rel="stylesheet" href="<?php _url(); ?>assets/back/vendors/font-awesome/css/font-awesome.min.css"/>
     <link rel="stylesheet" href="<?php _url(); ?>assets/back/vendors/flag-icon-css/css/flag-icon.min.css"/>
     <link rel="stylesheet" href="<?php _url(); ?>assets/back/vendors/lightgallery/css/lightgallery.css"/>
     <link rel="stylesheet" href="<?php _url(); ?>assets/back/vendors/dropify/dropify.min.css"/>
     <!-- End plugin css for this page -->
     <!-- inject:css -->
     <link rel="stylesheet" href="<?php _url(); ?>assets/back/css/vertical-layout-light/style.css">
     <link rel="shortcut icon" href="<?php _url(); ?>assets/custom/img/logo/logo_outline.png"/>
     <!-- custom -->
     <link href="<?php _url(); ?>assets/custom/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css"/>
     <link href="<?php _url(); ?>assets/custom/select2/css/select2.css" rel="stylesheet" type="text/css"/>
     <link href="<?php _url(); ?>assets/custom/css/style.css" rel="stylesheet" type="text/css"/>
     <link href="<?php _url(); ?>assets/custom/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
     <link rel="stylesheet" href="<?php _url(); ?>assets/custom/plugins/jquery-ui/jquery-ui.css">

     <link href="<?php _url(); ?>assets/custom/plugins/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" type="text/css"/>
     <link href="<?php _url(); ?>assets/custom/plugins/owlcarousel/assets/owl.theme.default.min.css" rel="stylesheet" type="text/css"/>
     <!-- <link href="//db.onlinewebfonts.com/c/b0243700275afd52c5bb425c92e03368?family=Galano+Classic" rel="stylesheet" type="text/css"/> -->



     <!-- <link href="//db.onlinewebfonts.com/c/b0243700275afd52c5bb425c92e03368?family=Galano+Classic" rel="stylesheet" type="text/css"/> -->

     <?php echo load_css();?>

     <script>
     var BASE_URL = '<?php _url();?>';
     </script>
     <!-- endcustom -->


     <!-- base:js -->
     <script src="<?php _url(); ?>assets/back/vendors/js/vendor.bundle.base.js"></script>
     <!-- endinject -->
</head>
<body>
     <style media="screen">
     body{
          font-family: "Galano Classic Regular", sans-serif;
     }
     .swal-text {
          text-align: center;
     }
     .needed{
          font-weight: bold;
          color: red;
     }
     .select2{
          width: 100%!important;
          border: 1px solid #ced4da!important;
          border-radius: 0.25rem!important;
          color: #495057!important;
          line-height: 50px!important;
     }
     .select2-container .select2-selection--single{
          height:50px!important;
     }
     .select2-container--default .select2-selection--single .select2-selection__rendered{
          margin-top: -5px;
     }
     .select2-container--default .select2-selection--single .select2-selection__arrow{
          height:45px!important;
     }
     .btn-small{
          width:40px;
          height:40px;
          padding: 10px!important;
     }
     .vertical-center {
          margin: 0;
          position: relative;
          top: 40%;
          -ms-transform: translateY(50%);
          transform: translateY(50%);
     }
     .img-project{
          background-position: center;
          background-repeat: no-repeat;
          background-size: cover;
          border-radius: 3px;
     }
     .modal-header .close{
          font-size: 50px!important;
     }
     .modal-title{
          text-transform: uppercase!important;
     }
     input.form-control{
          border: 1px solid #aaa;
     }
     .select2-container--default .select2-selection--single{
          border-radius: 0px;
     }
     </style>
     <div class="container-scroller">
          <!-- partial:partials/_navbar.html -->
          <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
               <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                         <span class="mdi mdi-menu"></span>
                    </button>

                    <a class="navbar-brand brand-logo ml-3  " href="index.html"><img src="<?php _url(); ?>assets/custom/img/logo/logo_outline.png" alt="logo" style="width: 40px!important;"/></a>
                    <a href="<?php _url("dashboard"); ?>"><h5 class="text-primary mt-2 ml-3 text-bold text-right">Portail</h5></a>

                    <?php if (me("role_code") != "root"): ?>
                         <a href="#custom-contact-modal" id="settings-trigger" class="text-white w-600" style="width:150px; border-radius: 5px;" data-toggle="modal"><i class="mdi mdi-message-reply-text mr-2"></i> Contact</a>
                    <?php endif; ?>

               </div>
               <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                    <!-- <ul class="navbar-nav">
                         <li class="nav-item d-flex dropdown">
                              <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-toggle="dropdown">
                                   <i class="mdi mdi-bell-outline mx-0"></i>
                                   <span class="count"></span>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                                   <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                                   <a class="dropdown-item preview-item">
                                        <div class="preview-thumbnail">
                                             <div class="preview-icon bg-success">
                                                  <i class="mdi mdi-information mx-0"></i>
                                             </div>
                                        </div>
                                        <div class="preview-item-content">
                                             <h6 class="preview-subject font-weight-normal">Application Error</h6>
                                             <p class="font-weight-light small-text mb-0 text-muted">
                                                  Just now
                                             </p>
                                        </div>
                                   </a>
                                   <a class="dropdown-item preview-item">
                                        <div class="preview-thumbnail">
                                             <div class="preview-icon bg-warning">
                                                  <i class="mdi mdi-settings mx-0"></i>
                                             </div>
                                        </div>
                                        <div class="preview-item-content">
                                             <h6 class="preview-subject font-weight-normal">Settings</h6>
                                             <p class="font-weight-light small-text mb-0 text-muted">
                                                  Private message
                                             </p>
                                        </div>
                                   </a>
                                   <a class="dropdown-item preview-item">
                                        <div class="preview-thumbnail">
                                             <div class="preview-icon bg-info">
                                                  <i class="mdi mdi-account-box mx-0"></i>
                                             </div>
                                        </div>
                                        <div class="preview-item-content">
                                             <h6 class="preview-subject font-weight-normal">New user registration</h6>
                                             <p class="font-weight-light small-text mb-0 text-muted">
                                                  2 days ago
                                             </p>
                                        </div>
                                   </a>
                              </div>
                         </li>
                    </ul> -->
                    <ul class="navbar-nav navbar-nav-right">

                         <li class="nav-item d-flex dropdown mr-1">
                              <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-toggle="dropdown" style="border: none;">
                                   <div class="preview-icon">
                                        <?php if(@me('user_lang') == null || @me('user_lang') == 'french'): ?>
                                             <i class="flag-icon flag-icon-fr mx-0"></i>
                                        <?php else: ?>
                                             <?php if (@me('user_lang') == 'english'): ?>
                                                  <i class="flag-icon flag-icon-gb mx-0"></i>
                                             <?php endif; ?>
                                        <?php endif; ?>
                                   </div>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                                   <p class="mb-0 font-weight-normal float-left dropdown-header">Langues</p>
                                   <a class="dropdown-item preview-item" onclick="javascript:update_user_lang('english')">
                                        <div class="preview-thumbnail">
                                             <div class="preview-icon">
                                                  <i class="flag-icon flag-icon-gb mx-0"></i>
                                             </div>
                                        </div>
                                        <div class="preview-item-content mt-2">
                                             <h6 class="preview-subject font-weight-normal">English</h6>
                                        </div>
                                   </a>
                                   <a class="dropdown-item preview-item" onclick="javascript:update_user_lang('french')">
                                        <div class="preview-thumbnail">
                                             <div class="preview-icon">
                                                  <i class="flag-icon flag-icon-fr mx-0"></i>
                                             </div>
                                        </div>
                                        <div class="preview-item-content mt-2">
                                             <h6 class="preview-subject font-weight-normal">Français</h6>
                                        </div>
                                   </a>
                              </div>
                         </li>
                         <li class="nav-item d-flex nav-profile dropdown">
                              <a class="nav-link dropdown-toggle border px-1 py-1" href="#" data-toggle="dropdown" id="profileDropdown">
                                   <?php if (me('person_picture') != null): ?>
                                        <img src="<?= _url(me('person_picture')) ?>" alt="profile image">
                                   <?php else: ?>
                                        <img src="<?= _url(); ?>assets/custom/img/default/boy.png" alt="profile image">
                                   <?php endif; ?>
                                   <span class="nav-profile-name"><?= me("user_nicename") ?></span>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                                   <a href="<?= _url("profile/".me("role_code")); ?>" class="dropdown-item">
                                        <i class="mdi mdi-account text-primary"></i>
                                        <?= $this->lang->line('main_menu_profile') ?>
                                   </a>
                                   <a href="<?php _url('auth/logout'); ?>" class="dropdown-item">
                                        <i class="mdi mdi-power text-primary"></i>
                                        <?= $this->lang->line('main_menu_logout') ?>
                                   </a>
                              </div>
                         </li>
                    </ul>

                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                         <span class="mdi mdi-menu"></span>
                    </button>
               </div>
          </nav>
          <!-- partial -->
          <div class="container-fluid page-body-wrapper">
               <!-- partial:partials/_sidebar.html -->
               <?= $menu ?>
               <!-- partial -->
               <div class="main-panel">
                    <div class="content-wrapper">
                         <?= $content ?>
                         <!-- content-wrapper ends -->
                         <!-- partial:partials/_footer.html -->


                         <div id="custom-contact-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="customLabel" aria-modal="true">
                              <div class="modal-dialog">
                                   <div class="modal-content">
                                        <div class="modal-header">
                                             <h4 class="modal-title" id="customLabel">Contactez nous</h4>
                                             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body container">
                                             <form class="row justify-content-center" action="#" method="post" enctype="multipart/form-data">
                                                  <div class="col-10 col-md-12">

                                                       <div class="form-group mb-3">
                                                            <!-- <label>Objet</label> -->
                                                            <input type="text" class="form-control" placeholder="Entrer objet" name="rapport_name" required>
                                                       </div>

                                                       <div class="form-group mb-3">
                                                            <!-- <label>Message</label> -->
                                                            <textarea class="form-control" placeholder="Ecrire message." name="name" rows="8"></textarea>
                                                       </div>
                                                  </div>
                                             </form>
                                        </div>
                                        <div class="modal-footer ">
                                             <button type="submit" class="btn btn-success col-md-6 ml-auto mr-auto">Envoyer</button>
                                        </div>
                                   </div><!-- /.modal-content -->
                              </div><!-- /.modal-dialog -->
                         </div>


                         <footer class="footer">
                              <div class="d-sm-flex justify-content-center justify-content-sm-between">
                                   <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <?= date("Y") ?> <a href="https://capital-acs.com" target="_blank">acs-capital</a>. All rights reserved.</span>
                              </div>
                         </footer>
                         <!-- partial -->
                    </div>
                    <!-- main-panel ends -->
               </div>
               <!-- page-body-wrapper ends -->
          </div>
          <!-- container-scroller -->

          <!-- Plugin js for this page-->
          <script src="<?php _url(); ?>assets/back/vendors/chart.js/Chart.min.js"></script>
          <script src="<?php _url(); ?>assets/back/vendors/progressbar.js/progressbar.min.js"></script>
          <script src="<?php _url(); ?>assets/back/vendors/datatables.net/jquery.dataTables.js"></script>
          <script src="<?php _url(); ?>assets/back/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
          <script src="<?php _url(); ?>assets/back/vendors/lightgallery/js/lightgallery-all.min.js"></script>
          <script src="<?php _url(); ?>assets/back/vendors/dropify/dropify.min.js"></script>
          <script src="<?php _url(); ?>assets/back/vendors/sweetalert/sweetalert.min.js"></script>
          <script src="<?php _url(); ?>assets/back/vendors/jquery.avgrund/jquery.avgrund.min.js"></script>

          <!-- End plugin js for this page-->
          <!-- inject:js -->
          <script src="<?php _url(); ?>assets/back/js/off-canvas.js"></script>
          <script src="<?php _url(); ?>assets/back/js/hoverable-collapse.js"></script>
          <script src="<?php _url(); ?>assets/back/js/template.js"></script>
          <script src="<?php _url(); ?>assets/back/js/settings.js"></script>
          <script src="<?php _url(); ?>assets/back/js/todolist.js"></script>
          <!-- endinject -->
          <!-- plugin js for this page -->
          <!-- End plugin js for this page -->
          <!-- Custom js for this page-->
          <script src="<?php _url(); ?>assets/back/js/data-table.js"></script>
          <script src="<?php _url(); ?>assets/back/js/dashboard.js"></script>
          <script src="<?php _url(); ?>assets/back/js/tabs.js"></script>
          <!-- <script src="<?php _url(); ?>assets/back/js/light-gallery.js"></script> -->
          <script src="<?php _url(); ?>assets/back/js/dropify.js"></script>
          <!-- End custom js for this page-->
          <!-- custom -->
          <!-- <script src="<?php _url(); ?>assets/custom/dist/js/bootstrap-select.js" type="text/javascript"></script> -->
          <!-- <script src="<?php _url(); ?>assets/back/js/select2.js" type="text/javascript"></script> -->
          <script src="<?php _url(); ?>assets/custom/js/jquery.chained.min.js" type="text/javascript"></script>
          <script src="<?php _url(); ?>assets/custom/js/jquery_migrate.js"></script>
          <script src="<?php _url(); ?>assets/custom/select2/js/select2.full.min.js"></script>
          <script src="<?php _url(); ?>assets/custom/select2/js/select2-custom.js"></script>
          <script src="<?php _url(); ?>assets/custom/plugins/jquery-ui/jquery-ui.min.js"></script>
          <script src="<?php _url(); ?>assets/custom/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
          <script src="<?php _url(); ?>assets/custom/js/jquery-inputmask/jquery.inputmask.bundle.min.js" type="text/javascript"></script>
          <script src="<?php _url(); ?>assets/custom/plugins/owlcarousel/owl.carousel.min.js" type="text/javascript"></script>
          <script src="<?php _url(); ?>assets/custom/js/script.js"></script>
          <script src="<?php _url(); ?>assets/back/js/alerts.js"></script>
          <script src="<?php _url(); ?>assets/back/js/avgrund.js"></script>

          <?php echo load_js();?>
          <!-- endcustom -->

     </body>

     </html>
