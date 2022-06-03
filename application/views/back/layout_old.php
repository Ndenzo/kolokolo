<!DOCTYPE html>
<html lang="en">
<head>
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- <meta name="description" content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
     <meta name="keywords" content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app"> -->
     <meta name="author" content="pixelstrap">
     <link rel="icon" href="<?php _url(config("logo")); ?>" type="image/x-icon">
     <link rel="shortcut icon" href="<?php _url(config("logo")); ?>" type="image/x-icon">
     <title><?= config("school_name") ?> - <?= @$title ?></title>
     <!-- Google font-->
     <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
     <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
     <link rel="stylesheet" type="text/css" href="<?php _url(); ?>assets/back/css/fontawesome.css">
     <!-- ico-font-->
     <link rel="stylesheet" type="text/css" href="<?php _url(); ?>assets/back/css/vendors/icofont.css">
     <!-- Themify icon-->
     <link rel="stylesheet" type="text/css" href="<?php _url(); ?>assets/back/css/vendors/themify.css">
     <!-- Flag icon-->
     <link rel="stylesheet" type="text/css" href="<?php _url(); ?>assets/back/css/vendors/flag-icon.css">
     <!-- Feather icon-->
     <link rel="stylesheet" type="text/css" href="<?php _url(); ?>assets/back/css/vendors/feather-icon.css">
     <!-- Plugins css start-->
     <link rel="stylesheet" type="text/css" href="<?php _url(); ?>assets/back/css/vendors/scrollbar.css">
     <link rel="stylesheet" type="text/css" href="<?php _url(); ?>assets/back/css/vendors/datatables.css">
     <link rel="stylesheet" type="text/css" href="<?php _url(); ?>assets/back/css/vendors/animate.css">
     <link rel="stylesheet" type="text/css" href="<?php _url(); ?>assets/back/css/vendors/chartist.css">
     <link rel="stylesheet" type="text/css" href="<?php _url(); ?>assets/back/css/vendors/date-picker.css">
     <!-- Plugins css Ends-->
     <!-- Bootstrap css-->
     <link rel="stylesheet" type="text/css" href="<?php _url(); ?>assets/back/css/vendors/bootstrap.css">
     <!-- App css-->
     <link rel="stylesheet" type="text/css" href="<?php _url(); ?>assets/back/css/style.css">
     <!-- <link id="color" rel="stylesheet" href="<?php _url(); ?>assets/back/css/color-2.css" media="screen"> -->
     <!-- Responsive css-->
     <link rel="stylesheet" type="text/css" href="<?php _url(); ?>assets/back/css/responsive.css">

     <!--Bootstrap-picker-->
     <link href="<?php _url(); ?>assets/custom/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css"/>
     <link href="<?php _url(); ?>assets/custom/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
     <link href="<?php _url(); ?>assets/custom/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />

     <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
     <link href="<?php _url(); ?>assets/custom/css/style.css" rel="stylesheet" type="text/css"/>

     <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/lozad/dist/lozad.min.js"></script>

     <?php echo load_css();?>


     <script>
     var BASE_URL = '<?php _url();?>';
     </script>

     <script src="<?php _url(); ?>assets/back/js/jquery-3.5.1.min.js"></script>

     <style>
     .btn{
          padding-top: 0.20rem;
          padding-bottom: 0.20rem;
     }
     .option-btn{
          margin: 2px!important;
     }
     .required{
          color: red;
          font-weight: bold;
     }
     .dropdown-toggle{
          font-weight: bold!important;
     }
     .selectpicker{
          height: 30px;
     }
     .option-btn{
          padding: 12px;
          width: 50px;
          height: 50px;
     }
     .option-sm-btn{
          padding: 4px;
          width: 30px;
          height: 30px;
     }
     .logo-style{
          width: 75px;
     }
     .dropdown-item{
          font-weight: bold;
     }
</style>
</head>
<?php if ($title == "dashboard"): ?>
     <body onload="startTime()">
     <?php else: ?><body>
     <?php endif; ?>

     <div class="loader-wrapper">
          <div class="loader-index"><span></span></div>
          <svg>
               <defs></defs>
               <filter id="goo">
                    <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
                    <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo"> </fecolormatrix>
               </filter>
          </svg>
     </div>

     <!-- tap on top starts-->
     <div class="tap-top"><i data-feather="chevrons-up"></i></div>

     <!-- tap on tap ends-->
     <!-- page-wrapper Start-->
     <div class="page-wrapper compact-wrapper" id="pageWrapper">
          <!-- Page Header Start-->
          <div class="page-header">
               <div class="header-wrapper row m-0">
                    <form class="form-inline search-full col" action="#" method="get">
                         <div class="form-group w-100">
                              <div class="Typeahead Typeahead--twitterUsers">
                                   <div class="u-posRelative">
                                        <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Search Cuba .." name="q" title="" autofocus>
                                        <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading...</span></div><i class="close-search" data-feather="x"></i>
                                   </div>
                                   <div class="Typeahead-menu"></div>
                              </div>
                         </div>
                    </form>
                    <div class="header-logo-wrapper col-auto p-0">
                         <div class="logo-wrapper"><a <?php _url("dashboard"); ?>><img class="img-fluid" src="<?php _url(config("logo")); ?>" alt=""></a></div>
                         <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i></div>
                    </div>
                    <div class="left-header col horizontal-wrapper ps-0">
                         <ul class="horizontal-menu">
                              <!-- <li class="mega-menu outside"><a class="nav-link" href="#!"><i data-feather="layers"></i><span>Mega Menu</span></a>
                              <div class="mega-menu-container nav-submenu menu-to-be-close header-mega">
                              <div class="container-fluid">
                              <div class="row">
                              <div class="col mega-box">
                              <div class="mobile-title d-none">
                              <h5>Mega menu</h5><i data-feather="x"></i>
                         </div>
                         <div class="link-section icon">
                         <div>
                         <h6>Error Page</h6>
                    </div>
                    <ul>
                    <li><a href="error-400.html">Error page 400</a></li>
                    <li><a href="error-401.html">Error page 401</a></li>
                    <li><a href="error-403.html">Error page 403</a></li>
                    <li><a href="error-404.html">Error page 404</a></li>
                    <li><a href="error-500.html">Error page 500</a></li>
                    <li><a href="error-503.html">Error page 503</a></li>
               </ul>
          </div>
     </div>
     <div class="col mega-box">
     <div class="link-section doted">
     <div>
     <h6> Authentication</h6>
</div>
<ul>
<li><a href="login.html">Login</a></li>
<li><a href="login_one.html">Login with image</a></li>
<li><a href="login-bs-validation.html">Login with validation</a></li>
<li><a href="sign-up.html">Sign Up</a></li>
<li><a href="sign-up-one.html">SignUp with image</a></li>
<li><a href="sign-up-two.html">SignUp with image</a></li>
</ul>
</div>
</div>
<div class="col mega-box">
<div class="link-section dashed-links">
<div>
<h6>Usefull Pages</h6>
</div>
<ul>
<li><a href="search.html">Search Website</a></li>
<li><a href="unlock.html">Unlock User</a></li>
<li><a href="forget-password.html">Forget Password</a></li>
<li><a href="reset-password.html">Reset Password</a></li>
<li><a href="maintenance.html">Maintenance</a></li>
<li><a href="login-sa-validation">Login validation</a></li>
</ul>
</div>
</div>
<div class="col mega-box">
<div class="link-section">
<div>
<h6>Email templates</h6>
</div>
<ul>
<li class="ps-0"><a href="basic-template.html">Basic Email</a></li>
<li class="ps-0"><a href="email-header.html">Basic With Header</a></li>
<li class="ps-0"><a href="template-email.html">Ecomerce Template</a></li>
<li class="ps-0"><a href="template-email-2.html">Email Template 2</a></li>
<li class="ps-0"><a href="ecommerce-templates.html">Ecommerce Email</a></li>
<li class="ps-0"><a href="email-order-success.html">Order Success</a></li>
</ul>
</div>
</div>
<div class="col mega-box">
<div class="link-section">
<div>
<h6>Coming Soon</h6>
</div>
<ul class="svg-icon">
<li><a href="comingsoon.html"> <i data-feather="file"> </i>Coming-soon</a></li>
<li><a href="comingsoon-bg-video.html"> <i data-feather="film"> </i>Coming-video</a></li>
<li><a href="comingsoon-bg-img.html"><i data-feather="image"> </i>Coming-Image</a></li>
</ul>
<div>
<h6>Other Soon</h6>
</div>
<ul class="svg-icon">
<li><a class="txt-primary" href="landing-page.html"> <i data-feather="cast"></i>Landing Page</a></li>
<li><a class="txt-secondary" href="sample-page.html"> <i data-feather="airplay"></i>Sample Page</a></li>
</ul>
</div>
</div>
</div>
</div>
</div>
</li> -->
<li class="level-menu outside">
     <a class="nav-link text-danger" href="#!">
          <i data-feather="calendar"></i>
          <span>
               <?php foreach($scolarites as  $key => $scolarite): ?>
                    <?php if ($_SESSION['dashboard']['settings_scolarite_id'] == $scolarite->settings_scolarite_id): ?>
                         <?= $scolarite->settings_scolarite_code ?>
                    <?php endif; ?>
               <?php endforeach; ?>
          </span>
     </a>
     <ul class="header-level-menu menu-to-be-close" style="height: auto!important;">
          <?php foreach($scolarites as  $key => $scolarite): ?>
               <?php if ($_SESSION['dashboard']['settings_scolarite_id'] != $scolarite->settings_scolarite_id): ?>
                    <li><a href="<?= _url("dashboard/showScolarite/".$scolarite->settings_scolarite_id) ?>"><i data-feather="calendar"></i><span> <?= $scolarite->settings_scolarite_code ?> </span></a></li>
               <?php endif; ?>
          <?php endforeach; ?>
     </ul>
</li>
</ul>
</div>

<div class="nav-right col-8 pull-right right-header p-0">
     <ul class="nav-menus">
          <li class="language-nav">
               <div class="translate_wrapper">
                    <div class="current_lang">
                         <div class="lang">
                              <i class="flag-icon flag-icon-<?php if (@me('user_lang') == null): ?>fr<?php else: ?><?= @me('user_lang') ?><?php endif; ?>"></i>
                                   <span class="lang-txt"><?php if (@me('user_lang') == null): ?>FR<?php else: ?><?= strtoupper(@me('user_lang')) ?><?php endif; ?></span>
                                   </div>
                              </div>
                              <div class="more_lang">
                                   <div class="lang selected" data-value="fr"><i class="flag-icon flag-icon-fr"></i><span class="lang-txt">Français</span></div>
                                   <div class="lang" data-value="gb"><i class="flag-icon flag-icon-gb"></i><span class="lang-txt">English<span> (GB)</span></span></div>
                                   <!-- <div class="lang" data-value="de"><i class="flag-icon flag-icon-de"></i><span class="lang-txt">Deutsch</span></div>
                                   <div class="lang" data-value="es"><i class="flag-icon flag-icon-es"></i><span class="lang-txt">Español</span></div> -->
                                   <!-- <div class="lang" data-value="pt"><i class="flag-icon flag-icon-pt"></i><span class="lang-txt">Português<span> (BR)</span></span></div>
                                   <div class="lang" data-value="cn"><i class="flag-icon flag-icon-cn"></i><span class="lang-txt">简体中文</span></div>
                                   <div class="lang" data-value="ae"><i class="flag-icon flag-icon-ae"></i><span class="lang-txt">لعربية <span> (ae)</span></span></div> -->
                              </div>
                         </div>
                    </li>
                    <!-- <li><span class="header-search"><i data-feather="search"></i></span></li> -->
                    <!-- <li class="onhover-dropdown">
                    <div class="notification-box"><i data-feather="bell"> </i><span class="badge rounded-pill badge-secondary">4</span></div>
                    <ul class="notification-dropdown onhover-show-div">
                    <li><i data-feather="bell"></i>
                    <h6 class="f-18 mb-0">Notitications</h6>
               </li>
               <li>
               <p><i class="fa fa-circle-o me-3 font-primary"> </i>Delivery processing <span class="pull-right">10 min.</span></p>
          </li>
          <li>
          <p><i class="fa fa-circle-o me-3 font-success"></i>Order Complete<span class="pull-right">1 hr</span></p>
     </li>
     <li>
     <p><i class="fa fa-circle-o me-3 font-info"></i>Tickets Generated<span class="pull-right">3 hr</span></p>
</li>
<li>
<p><i class="fa fa-circle-o me-3 font-danger"></i>Delivery Complete<span class="pull-right">6 hr</span></p>
</li>
<li><a class="btn btn-primary" href="#">Check all notification</a></li>
</ul>
</li> -->
<li>
     <div class="mode"><i class="fa fa-moon-o"></i></div>
</li>
<!-- <li class="cart-nav onhover-dropdown">
<div class="cart-box"><i data-feather="camera"></i><span class="badge rounded-pill badge-primary">2</span></div>
<ul class="cart-dropdown onhover-show-div">
<li>
<h6 class="mb-0 f-20">Shoping Bag</h6><i data-feather="shopping-cart"></i>
</li>
<li class="mt-0">
<div class="media"><img class="img-fluid rounded-circle me-3 img-60" src="<?php _url(); ?>assets/back/images/ecommerce/01.jpg" alt="">
<div class="media-body"><span>V-Neck Shawl Collar Woman's Solid T-Shirt</span>
<p>Yellow(#fcb102)</p>
<h6 class="text-end text-muted">$299.00</h6>
</div>
</div>
</li>
<li class="mt-0">
<div class="media"><img class="img-fluid rounded-circle me-3 img-60" src="<?php _url(); ?>assets/back/images/ecommerce/03.jpg" alt="">
<div class="media-body"><span>V-Neck Shawl Collar Woman's Solid T-Shirt</span>
<p>Yellow(#fcb102)</p>
<h6 class="text-end text-muted">$299.00</h6>
</div>
</div>
</li>
<li>
<div class="total">
<h6 class="mb-2 mt-0 text-muted">Order Total : <span class="f-right f-20">$598.00</span></h6>
</div>
</li>
<li><a class="btn btn-block w-100 mb-2 btn-primary view-cart" href="cart.html">Go to shoping bag</a><a class="btn btn-block w-100 btn-secondary view-cart" href="checkout.html">Checkout</a></li>
</ul>
</li> -->
<!-- <li class="onhover-dropdown">
<i data-feather="message-square"></i>
<ul class="chat-dropdown onhover-show-div">
<li><i data-feather="message-square"></i>
<h6 class="f-18 mb-0">Message Box</h6>
</li>
<li>
<div class="media"><img class="img-fluid rounded-circle me-3" src="<?php _url(); ?>assets/back/images/user/1.jpg" alt="">
<div class="status-circle online"></div>
<div class="media-body"><span>Erica Hughes</span>
<p>Lorem Ipsum is simply dummy...</p>
</div>
<p class="f-12 font-success">58 mins ago</p>
</div>
</li>
<li>
<div class="media"><img class="img-fluid rounded-circle me-3" src="<?php _url(); ?>assets/back/images/user/2.jpg" alt="">
<div class="status-circle online"></div>
<div class="media-body"><span>Kori Thomas</span>
<p>Lorem Ipsum is simply dummy...</p>
</div>
<p class="f-12 font-success">1 hr ago</p>
</div>
</li>
<li>
<div class="media"><img class="img-fluid rounded-circle me-3" src="<?php _url(); ?>assets/back/images/user/4.jpg" alt="">
<div class="status-circle offline"></div>
<div class="media-body"><span>Ain Chavez</span>
<p>Lorem Ipsum is simply dummy...</p>
</div>
<p class="f-12 font-danger">32 mins ago</p>
</div>
</li>
<li class="text-center"> <a class="btn btn-primary" href="#">View All</a></li>
</ul>
</li> -->
<li class="maximize"><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
<li class="profile-nav onhover-dropdown p-0 me-0">
     <div class="media profile-media">
          <?php if (@get_personne_info()->personne_photo == null): ?>
               <img class="b-r-10" src="<?= _url(); ?>assets/custom/img/default/boy.png" alt="profile" style="width:40px;">
          <?php else: ?>
               <img class="b-r-10" src="<?= _url(get_personne_info()->personne_photo); ?>" alt="profile" style="width:40px;">
          <?php endif; ?>
          <div class="media-body"><span><?= me("user_nicename") ?></span>
               <p class="mb-0 font-roboto"><?= me("role_name") ?> <i class="middle fa fa-angle-down"></i></p>
          </div>
     </div>
     <ul class="profile-dropdown onhover-show-div">
          <li><a href="<?= _url("profile/".me("role_code")); ?>"><i data-feather="user"></i><span>Profile </span></a></li>
          <!-- <li><a href="#"><i data-feather="mail"></i><span>Inbox</span></a></li>
          <li><a href="#"><i data-feather="file-text"></i><span>Taskboard</span></a></li>
          <li><a href="#"><i data-feather="settings"></i><span>Settings</span></a></li> -->
          <li><a href="<?= _url("auth/logout"); ?>"><i data-feather="power"> </i><span>Sign out</span></a></li>
     </ul>
</li>
</ul>
</div>
<script class="result-template" type="text/x-handlebars-template">
     <div class="ProfileCard u-cf">
          <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
          <div class="ProfileCard-details">
               <div class="ProfileCard-realName">{{name}}</div>
          </div>
     </div>
</script>
<script class="empty-template" type="text/x-handlebars-template"><div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div></script>
</div>
</div>
<!-- Page Header Ends                              -->
<!-- Page Body Start-->
<div class="page-body-wrapper">
     <!-- Page Sidebar Start-->
     <?= @$menu ?>
     <!-- Page Sidebar Ends-->
     <div class="page-body">
          <div class="container-fluid">
               <div class="page-title">
                    <div class="row">
                         <div class="col-6">
                              <h3><?= @$title ?></h3>
                         </div>
                         <div class="col-6">
                              <ol class="breadcrumb">
                                   <li class="breadcrumb-item"><a <?php _url("dashboard"); ?>><i data-feather="home"></i></a></li>
                                   <li class="breadcrumb-item">Dashboard</li>
                                   <li class="breadcrumb-item active"><?= @$title ?></li>
                              </ol>
                         </div>
                    </div>
               </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
               <?= @$content ?>
          </div>
          <!-- Container-fluid Ends-->
     </div>
     <!-- footer start-->
     <footer class="footer">
          <div class="container-fluid">
               <div class="row">
                    <div class="col-md-12 footer-copyright text-center">
                         <p class="mb-0">Copyright (c) <?php @gmdate('Y') ?> Megatic All Rights Reserved. </p>
                    </div>
               </div>
          </div>
     </footer>
</div>
</div>
<!-- latest jquery-->
<!-- Bootstrap js-->
<script src="<?php _url(); ?>assets/back/js/bootstrap/bootstrap.bundle.min.js"></script>
<!-- feather icon js-->
<script src="<?php _url(); ?>assets/back/js/icons/feather-icon/feather.min.js"></script>
<script src="<?php _url(); ?>assets/back/js/icons/feather-icon/feather-icon.js"></script>
<!-- scrollbar js-->
<script src="<?php _url(); ?>assets/back/js/scrollbar/simplebar.js"></script>
<script src="<?php _url(); ?>assets/back/js/scrollbar/custom.js"></script>
<!-- Sidebar jquery-->
<script src="<?php _url(); ?>assets/back/js/config.js"></script>
<!-- Plugins JS start-->
<script src="<?php _url(); ?>assets/back/js/sidebar-menu.js"></script>
<script src="<?php _url(); ?>assets/back/js/datatable/datatables/jquery.dataTables.min.js"></script>
<script src="<?php _url(); ?>assets/back/js/datatable/datatables/datatable.custom.js"></script>
<script src="<?php _url(); ?>assets/back/js/chart/chartist/chartist.js"></script>
<script src="<?php _url(); ?>assets/back/js/chart/chartist/chartist-plugin-tooltip.js"></script>
<script src="<?php _url(); ?>assets/back/js/chart/knob/knob.min.js"></script>
<script src="<?php _url(); ?>assets/back/js/chart/knob/knob-chart.js"></script>
<script src="<?php _url(); ?>assets/back/js/chart/apex-chart/apex-chart.js"></script>
<script src="<?php _url(); ?>assets/back/js/chart/apex-chart/stock-prices.js"></script>
<script src="<?php _url(); ?>assets/back/js/notify/bootstrap-notify.min.js"></script>
<?php if ($title == "dashboard"): ?>
     <script src="<?php _url(); ?>assets/back/js/dashboard/default.js"></script>
     <script src="<?php _url(); ?>assets/back/js/theme-customizer/customizer.js"></script>

     <script src="<?php _url(); ?>assets/back/js/chart/morris-chart/raphael.js"></script>
     <script src="<?php _url(); ?>assets/back/js/chart/morris-chart/morris.js"> </script>
     <script src="<?php _url(); ?>assets/back/js/chart/morris-chart/prettify.min.js"></script>
     <!-- <script src="<?php _url(); ?>assets/back/js/chart/morris-chart/morris-script.js"></script> -->
<?php endif; ?>
<script src="<?php _url(); ?>assets/back/js/notify/index.js"></script>
<script src="<?php _url(); ?>assets/back/js/datepicker/date-picker/datepicker.js"></script>
<script src="<?php _url(); ?>assets/back/js/datepicker/date-picker/datepicker.en.js"></script>
<script src="<?php _url(); ?>assets/back/js/datepicker/date-picker/datepicker.custom.js"></script>
<script src="<?php _url(); ?>assets/back/js/typeahead/handlebars.js"></script>
<script src="<?php _url(); ?>assets/back/js/typeahead/typeahead.bundle.js"></script>
<script src="<?php _url(); ?>assets/back/js/typeahead/typeahead.custom.js"></script>
<script src="<?php _url(); ?>assets/back/js/typeahead-search/handlebars.js"></script>
<script src="<?php _url(); ?>assets/back/js/typeahead-search/typeahead-custom.js"></script>
<script src="<?php _url(); ?>assets/back/js/rating/jquery.barrating.js"></script>
<script src="<?php _url(); ?>assets/back/js/rating/rating-script.js"></script>
<script src="<?php _url(); ?>assets/back/js/owlcarousel/owl.carousel.js"></script>
<script src="<?php _url(); ?>assets/back/js/ecommerce.js"></script>
<script src="<?php _url(); ?>assets/back/js/product-list-custom.js"></script>
<script src="<?php _url(); ?>assets/custom/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
<script src="<?php _url(); ?>assets/back/js/form-wizard/form-wizard-two.js"></script>
<script src="<?php _url(); ?>assets/back/js/form-wizard/form-wizard-three.js"></script>
<script src="<?php _url(); ?>assets/back/js/form-wizard/jquery.backstretch.min.js"></script>

<!-- <script src="<?php _url(); ?>assets/back/js/tooltip-init.js"></script> -->
<!-- Plugins JS Ends-->
<!-- Theme js-->
<script src="<?php _url(); ?>assets/back/js/script.js"></script>

<!-- Bootstrap-picker -->
<script src="<?php _url(); ?>assets/custom/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
<script src="<?php _url(); ?>assets/custom/dist/js/bootstrap-select.js" type="text/javascript"></script>

<!-- JQuery-ui -->
<script src="<?php _url(); ?>assets/custom/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php _url(); ?>assets/custom/js/jquery_migrate.js"></script>

<!-- login js-->
<script src="<?php _url(); ?>assets/custom/js/jquery.chained.min.js" type="text/javascript"></script>
<script src="<?php _url(); ?>assets/custom/js/jquery-inputmask/jquery.inputmask.bundle.min.js" type="text/javascript"></script>
<script src="<?php _url(); ?>assets/custom/js/script.js"></script>

<!-- Plugin used-->


<script type="text/javascript">
const observer = lozad();
observer.observe();


<?php if (@me('user_lang') != null): ?>
var tnum = "<?= @me('user_lang') ?>";
<?php else: ?>
var tnum = "fr";
<?php endif; ?>

$(document).ready(function () {
     $loading = $('.loader-wrapper')
     .ajaxStart(function () {
          $loading.show();
     })
     .ajaxStop(function () {
          $loading.hide();
     });
     translate(tnum);
     // translate_content(tnum);
     $('.more_lang .lang').click(function () {
          $(this).addClass('selected').siblings().removeClass('selected');
          $('.more_lang').removeClass('active');

          var i = $(this).find('i').attr('class');
          var lang = $(this).attr('data-value');
          var tnum = lang;

          translate(tnum);
          // translate_content(tnum);

          update_user_lang(tnum);

          $('.current_lang .lang-txt').text(lang);
          $('.current_lang i').attr('class', i);
     });
});

</script>

<script src="<?php _url(); ?>application/views/back/js/<?= get_user_info('role_code') ?>_lang_script.js"></script>

<?php echo load_js();?>

</body>
</html>
