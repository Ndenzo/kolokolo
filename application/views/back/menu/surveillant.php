<div class="sidebar-wrapper">
     <div>
          <div class="logo-wrapper" style="padding-bottom: 15px;">
               <a href="<?= _url('dashboard') ?>">
                    <img class="img-fluid for-light logo-style" src="<?php _url(config("logo")); ?>" alt="" style="margin-top: -10px;">
                    <img class="img-fluid for-dark logo-style" src="<?php _url(config("logo_dark")); ?>" alt="" style="margin-top: -10px;">
               </a>
               <div class="back-btn"><i class="fa fa-angle-left"></i></div>
               <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
          </div>
          <div class="logo-icon-wrapper"><a href="<?= _url('dashboard') ?>"><img class="img-fluid logo-style" src="<?php _url(config("logo")); ?>" alt="" style="margin-top: 30px;"></a></div>
          <nav class="sidebar-main mt-20">
               <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
               <div id="sidebar-menu">
                    <ul class="sidebar-links" id="simple-bar">
                         <li class="back-btn"><a href="index.html"><img class="img-fluid" src="<?php _url(); ?>assets/back/images/logo/logo-icon.png" alt=""></a>
                              <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                         </li>
                         <li class="sidebar-main-title mt-30">
                              <div>
                                   <h6 class="lan-menu-header-1">General</h6>
                                   <p class="lan-menu-header-desc-1">Dashboard, Peoples manager</p>
                              </div>
                         </li>
                         <li class="sidebar-list">
                              <a class="sidebar-link sidebar-title link-nav" href="<?= _url("dashboard"); ?>"><i data-feather="home"></i><span class="lan-menu-1">Dashboard</span></a>
                         </li>
                         <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#"><i data-feather="users"></i><span class="lan-menu-2">Actors</span></a>
                              <ul class="sidebar-submenu">
                                   <li><a href="<?php _url("actor/eleve") ?>" class="lan-text-stu"> Students </a></li>
                              </ul>
                         </li>
                         <li class="sidebar-main-title">
                              <div>
                                   <h6 class="lan-menu-header-2">Schooling</h6>
                                   <p class="lan-menu-header-desc-2">Schooling, classes manager</p>
                              </div>
                         </li>
                         <li class="sidebar-list">
                              <a class="sidebar-link sidebar-title link-nav" href="<?= _url("classe"); ?>"><i data-feather="grid"></i><span class="lan-menu-3">Classes</span></a>
                         </li>
                         <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#"><i data-feather="book"></i><span class="lan-menu-4">Schooling</span></a>
                              <ul class="sidebar-submenu">
                                   <li><a href="<?= _url("absence") ?>" class="lan-text-abs">Absence and Delay </a></li>
                                   <li><a href="<?= _url("evaluation") ?>" class="lan-text-eva">Evaluation</a></li>
                                   <li><a href="<?= _url("rating") ?>" class="lan-text-rat">Rating</a></li>
                              </ul>
                         </li>

                         <li class="sidebar-main-title">
                              <div>
                                   <h6 class="lan-menu-header-4">Account</h6>
                                   <p class="lan-menu-header-desc-4">Profile and log out</p>
                              </div>
                         </li>
                         <li class="sidebar-list">
                              <a class="sidebar-link sidebar-title link-nav" href="<?= _url("profile/".me("role_code")); ?>"><i data-feather="user"></i><span class="lan-menu-7">Profile</span></a>
                         </li>
                         <li class="sidebar-list">
                              <a class="sidebar-link sidebar-title link-nav" href="<?= _url("auth/logout"); ?>"><i data-feather="power"></i><span class="lan-menu-8">Sign Out</span></a>
                         </li>
                    </ul>
               </div>
               <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
          </nav>
     </div>
</div>
