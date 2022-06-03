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
                    <i class="mdi mdi-book-open menu-icon"></i>
                    <span class="menu-title">Tableau de bord</span>
               </a>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="<?php _url("studie"); ?>">
                    <i class="mdi mdi-file-document menu-icon"></i>
                    <span class="menu-title"><?= $this->lang->line('main_menu_studies') ?></span>
               </a>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="<?php _url('auth/logout'); ?>">
                    <i class="mdi mdi-power menu-icon"></i>
                    <span class="menu-title">Déconnexion</span>
               </a>
          </li>
     </ul>
</nav>
