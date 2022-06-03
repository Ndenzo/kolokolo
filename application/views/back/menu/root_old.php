<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

     <div class="slimscroll-menu">

          <!-- User box -->
          <div class="user-box text-center">
               <img src="<?php _url(); ?>assets/custom/img/logo/logo.jpg" alt="user-img" title="Mat Helme" class="rounded-circle img-thumbnail avatar-lg">
               <div class="dropdown">
                    <a href="#" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block" data-toggle="dropdown">Gsacademie</a>
                    <div class="dropdown-menu user-pro-dropdown">
                         <a href="<?php _url('auth/logout'); ?>" class="dropdown-item notify-item">
                              <i class="mdi mdi-power mr-1"></i>
                              <span>Logout</span>
                         </a>

                    </div>
               </div>
          </div>

          <!--- Sidemenu -->
          <div id="sidebar-menu">

               <ul class="metismenu" id="side-menu">

                    <li class="menu-title">Navigation</li>

                    <li>
                         <a href="<?php _url("dashboard"); ?>">
                              <i class="mdi mdi-home"></i>
                              <span> Dashboard </span>
                         </a>
                    </li>

                    <li>
                         <a href="<?php _url("classe"); ?>">
                              <i class="mdi mdi-widgets"></i>
                              <span> Classes </span>
                         </a>
                    </li>

                    <li>
                         <a href="javascript: void(0);">
                              <i class="mdi mdi-account-multiple"></i>
                              <span> Acteurs </span>
                              <span class="menu-arrow"></span>
                         </a>
                         <ul class="nav-second-level" aria-expanded="false">
                              <li><a href="<?php _url("actor/eleve") ?>"> Elèves </a></li>
                              <!-- <li><a href="<?php _url("actor/employe") ?>"> Employés </a></li> -->
                              <li><a href="<?php _url("actor/tuteur") ?>"> Tuteurs </a></li>
                              <li>
                                   <a href="javascript: void(0);" aria-expanded="false">Employés
                                        <span class="menu-arrow"></span>
                                   </a>
                                   <ul class="nav-third-level nav" aria-expanded="false">
                                        <li>
                                             <a href="<?php _url("actor/employe") ?>">Tous les employés</a>
                                        </li>
                                        <li>
                                             <a href="<?php _url("actor/enseignant") ?>">Enseignants</a>
                                        </li>
                                   </ul>
                              </li>
                         </ul>
                    </li>

                    <li>
                         <a href="javascript: void(0);">
                              <i class="mdi mdi-school"></i>
                              <span> Scolarités </span>
                              <span class="menu-arrow"></span>
                         </a>
                         <ul class="nav-second-level" aria-expanded="false">
                              <?php foreach($scolarites as $scolarite): ?>
                                   <li><a href="<?php _url("scolarite/home/".$scolarite->settings_scolarite_id) ?>"> <?= $scolarite->settings_scolarite_code ?> </a></li>
                              <?php endforeach; ?>
                         </ul>
                    </li>

                    <li>
                         <a href="javascript: void(0);">
                              <i class="mdi mdi-shield-account-outline"></i>
                              <span> Sécurité </span>
                              <span class="menu-arrow"></span>
                         </a>
                         <ul class="nav-second-level" aria-expanded="false">
                              <li><a href="<?php _url("securite/roles") ?>"> Rôles </a></li>
                              <li><a href="<?php _url("securite/users") ?>"> Utilisateurs </a></li>
                         </ul>
                    </li>

                    <li>
                         <a href="<?php _url("document") ?>">
                              <i class="mdi mdi-file-document"></i>
                              <span> Documents </span>
                         </a>
                    </li>

                    <li>
                         <a href="<?php _url("settings") ?>">
                              <i class="mdi mdi-cog"></i>
                              <span> Paramètres </span>
                         </a>
                    </li>

               </ul>

          </div>
          <!-- End Sidebar -->

          <div class="clearfix"></div>

     </div>
     <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
