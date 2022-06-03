<nav class="sidebar sidebar-offcanvas" id="sidebar">
     <ul class="nav">
          <li class="nav-item nav-profile" style="border-bottom: 1px solid #fff;">
               <a href="<?= _url("profile/".me("role_code")); ?>" class="nav-link d-block text-center">
                    <div class="profile-image">
                         <?php if (me('person_picture') != null): ?>
                              <img class="img-sm rounded-circle" src="<?= _url(me('person_picture')) ?>" alt="profile image">
                         <?php else: ?>
                              <img class="img-sm rounded-circle" src="<?= _url(); ?>assets/custom/img/default/boy.png" alt="profile image">
                         <?php endif; ?>
                    </div>
                    <div class="text-wrapper">
                         <p class="profile-name"><?= me("user_nicename") ?></p>
                         <p class="text-center" style="font-weight: bold;"><?= me("role_name") ?></p>
                    </div>
               </a>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="<?php _url("dashboard"); ?>">
                    <i class="mdi mdi-view-dashboard menu-icon"></i>
                    <span class="menu-title"><?= $this->lang->line('main_menu_dashboard') ?></span>
               </a>
          </li>
          <li class="nav-item">
               <a class="nav-link" data-toggle="collapse" href="#actor" aria-expanded="false" aria-controls="ui-advanced">
                    <i class="mdi mdi-account-multiple menu-icon"></i>
                    <span class="menu-title"><?= $this->lang->line('main_menu_actors') ?></span>
                    <?php if (@count(get_investor_notif()) > 0): ?>
                         <span class="badge badge-warning" style="width: 25px; height: 25px; padding: 8px;"><?= @count(get_investor_notif()) ?></span>
                    <?php endif; ?>
                    <i class="menu-arrow"></i>
               </a>
               <div class="collapse" id="actor">
                    <ul class="nav flex-column sub-menu">
                         <li class="nav-item">
                              <a class="nav-link" href="<?= _url('actor/investor') ?>" style="height: 50px!important;"><?= $this->lang->line('sub_menu_investors') ?>
                                   <?php if (@count(get_investor_notif()) > 0): ?>
                                        <span class="badge badge-success" style="width: 25px; height: 25px; padding: 8px;"><?= @count(get_investor_notif()) ?></span>
                                   <?php endif; ?>
                              </a>
                         </li>
                         <li class="nav-item"> <a class="nav-link" href="<?= _url('actor/contact') ?>" style="height: 50px!important;"><?= $this->lang->line('sub_menu_contacts') ?></a></li>
                    </ul>
               </div>
          </li>
          <li class="nav-item">
               <a class="nav-link" data-toggle="collapse" href="#project" aria-expanded="false" aria-controls="ui-advanced">
                    <i class="mdi mdi-book-open menu-icon"></i>
                    <span class="menu-title"><?= $this->lang->line('main_menu_projects') ?></span>
                    <?php if (@count(get_investor_request()) > 0): ?>
                         <span class="badge badge-warning" style="width: 25px; height: 25px; padding: 8px;"><?= @count(get_investor_request()) ?></span>
                    <?php endif; ?>
                    <i class="menu-arrow"></i>
               </a>
               <div class="collapse" id="project">
                    <ul class="nav flex-column sub-menu">
                         <li class="nav-item"> <a class="nav-link" href="<?= _url('content/project') ?>" style="height: 50px!important;"><?= $this->lang->line('main_menu_projects') ?></a></li>
                         <li class="nav-item"> <a class="nav-link" href="<?= _url('content/convenience') ?>" style="height: 50px!important;"><?= $this->lang->line('sub_menu_conveniences') ?></a></li>
                         <li class="nav-item">
                              <a class="nav-link" href="<?= _url('content/request') ?>" style="height: 50px!important;"><?= $this->lang->line('sub_menu_investments') ?>
                                   <?php if (@count(get_investor_request()) > 0): ?>
                                        <span class="badge badge-success" style="width: 25px; height: 25px; padding: 8px;"><?= @count(get_investor_request()) ?></span>
                                   <?php endif; ?>
                              </a>
                         </li>
                    </ul>
               </div>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="<?php _url("studie"); ?>">
                    <i class="mdi mdi-file-document menu-icon"></i>
                    <span class="menu-title"><?= $this->lang->line('main_menu_studies') ?></span>
               </a>
          </li>
          <li class="nav-item">
               <a class="nav-link" data-toggle="collapse" href="#simulator" aria-expanded="false" aria-controls="ui-advanced">
                    <i class="mdi mdi-matrix menu-icon"></i>
                    <span class="menu-title"><?= $this->lang->line('main_menu_simulator') ?></span>
                    <i class="menu-arrow"></i>
               </a>
               <div class="collapse" id="simulator">
                    <ul class="nav flex-column sub-menu">
                         <li class="nav-item"> <a class="nav-link" href="<?= _url('simulator/specification') ?>"><?= $this->lang->line('sub_menu_specs') ?></a></li>
                         <li class="nav-item"> <a class="nav-link" href="<?= _url('simulator/param') ?>"><?= $this->lang->line('sub_menu_params') ?></a></li>
                         <div class="dropdown-divider"></div>
                         <li class="nav-item"> <a class="nav-link" href="<?= _url('simulator/demo') ?>"><?= $this->lang->line('sub_menu_demo') ?></a></li>
                    </ul>
               </div>
          </li>
          <li class="nav-item">
               <a class="nav-link" data-toggle="collapse" href="#security" aria-expanded="false" aria-controls="ui-advanced">
                    <i class="mdi mdi-security menu-icon"></i>
                    <span class="menu-title"><?= $this->lang->line('main_menu_security') ?></span>
                    <i class="menu-arrow"></i>
               </a>
               <div class="collapse" id="security">
                    <ul class="nav flex-column sub-menu">
                         <li class="nav-item"> <a class="nav-link" href="<?= _url('securite/roles') ?>"><?= $this->lang->line('sub_menu_roles') ?></a></li>
                         <li class="nav-item"> <a class="nav-link" href="<?= _url('securite/users') ?>"><?= $this->lang->line('sub_menu_users') ?></a></li>
                    </ul>
               </div>
          </li>
          <li class="nav-item">
               <a class="nav-link" data-toggle="collapse" href="#settings" aria-expanded="false" aria-controls="ui-advanced">
                    <i class="mdi mdi-settings menu-icon"></i>
                    <span class="menu-title"><?= $this->lang->line('main_menu_settings') ?></span>
                    <i class="menu-arrow"></i>
               </a>
               <div class="collapse" id="settings">
                    <ul class="nav flex-column sub-menu">
                         <!-- <li class="nav-item"> <a class="nav-link" href="<?= _url('settings/settings_config') ?>"><?= $this->lang->line('sub_menu_config') ?></a> </li> -->
                         <li class="nav-item"> <a class="nav-link" href="<?= _url('settings/settings_gender') ?>"><?= $this->lang->line('sub_menu_gender') ?></a> </li>
                         <li class="nav-item"> <a class="nav-link" href="<?= _url('settings/settings_country') ?>"><?= $this->lang->line('sub_menu_country') ?></a> </li>
                         <!-- <li class="nav-item"> <a class="nav-link" href="<?= _url('settings/settings_timezone') ?>">Timezones</a> </li> -->
                         <!-- <div class="dropdown-divider"></div> -->
                         <li class="nav-item"> <a class="nav-link" href="<?= _url('settings/settings_payment_method') ?>"><?= $this->lang->line('sub_menu_payment') ?></a> </li>
                         <!-- <li class="nav-item"> <a class="nav-link" href="<?= _url('settings/settings_gallery_type') ?>"><?= $this->lang->line('sub_menu_gallery') ?></a> </li> -->
                    </ul>
               </div>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="<?php _url('auth/logout'); ?>">
                    <i class="mdi mdi-power menu-icon"></i>
                    <span class="menu-title"><?= $this->lang->line('main_menu_logout') ?></span>
               </a>
          </li>
     </ul>
</nav>
