<div class="menu">
     <div class="main-menu">
          <div class="scroll">
               <ul class="list-unstyled">
                    <li>
                         <a href="<?= _url('dashboard') ?>">
                              <i class="iconsminds-shop-4"></i>
                              <span>Dashboards</span>
                         </a>
                    </li>
                    <li>
                         <a href="<?= _url('profile/root') ?>">
                              <i class="iconsminds-profile"></i>
                              <span>Profile</span>
                         </a>
                    </li>
                    <li>
                         <a href="<?= _url('meet') ?>">
                              <i class="iconsminds-affiliate"></i>
                              <span>Rendez-vous</span>
                         </a>
                    </li>
                    <li>
                         <a href="<?= _url('contact') ?>">
                              <i class="simple-icon-notebook"></i>
                              <span>Contact</span>
                         </a>
                    </li>
                    <li>
                         <a href="#layouts">
                              <i class="iconsminds-digital-drawing"></i> Contenues
                         </a>
                    </li>
                    <li>
                         <a href="#securite">
                              <i class="iconsminds-security-settings"></i> Securité
                         </a>
                    </li>
                    <li>
                         <a href="#parametre">
                              <i class="simple-icon-settings"></i> Paramètres
                         </a>
                    </li>
                    <li>
                         <a href="<?= _url('auth/logout') ?>">
                              <i class="iconsminds-power"></i> Deconnexion
                         </a>
                    </li>
               </ul>
          </div>
     </div>

     <div class="sub-menu">
          <div class="scroll">

               <ul class="list-unstyled" data-link="layouts">
                    <li class="active">
                         <a href="<?= _url('illustration') ?>">
                              <i class="iconsminds-office-lamp"></i> <span class="d-inline-block">Illustrations</span>
                         </a>
                    </li>
                    <li>
                         <a href="<?= _url('blog') ?>">
                              <i class="iconsminds-office-lamp"></i> <span class="d-inline-block">Blogs</span>
                         </a>
                    </li>
                    <li>
                         <a href="<?= _url('realisation') ?>">
                              <i class="iconsminds-office-lamp"></i> <span class="d-inline-block">Realisations</span>
                         </a>
                    </li>
                    <li>
                         <a href="<?= _url('tag') ?>">
                              <i class="iconsminds-office-lamp"></i> <span class="d-inline-block">Tags</span>
                         </a>
                    </li>
               </ul>

               <ul class="list-unstyled" data-link="securite">
                    <li>
                         <a href="#" data-toggle="collapse" data-target="#collapseForms" aria-expanded="true" aria-controls="collapseForms" class="rotate-arrow-icon opacity-50">
                              <i class="simple-icon-arrow-down"></i> <span class="d-inline-block">Securite</span>
                         </a>
                         <div id="collapseForms" class="collapse show">
                              <ul class="list-unstyled inner-level-menu">
                                   <li>
                                        <a href="<?= _url('securite/roles') ?>">
                                             <i class="simple-icon-event"></i> <span class="d-inline-block">Roles</span>
                                        </a>
                                   </li>
                                   <li>
                                        <a href="<?= _url('securite/users') ?>">
                                             <i class="simple-icon-doc"></i> <span class="d-inline-block">Users</span>
                                        </a>
                                   </li>
                              </ul>
                         </div>
                    </li>
               </ul>

               <ul class="list-unstyled" data-link="parametre">
                    <li>
                         <a href="#" data-toggle="collapse" data-target="#collapseForms" aria-expanded="true" aria-controls="collapseForms" class="rotate-arrow-icon opacity-50">
                              <i class="simple-icon-arrow-down"></i> <span class="d-inline-block">General</span>
                         </a>
                         <div id="collapseForms" class="collapse show">
                              <ul class="list-unstyled inner-level-menu">
                                   <li>
                                        <a href="<?= _url('settings/settings_config') ?>">
                                             <i class="simple-icon-event"></i> <span class="d-inline-block">Configuration</span>
                                        </a>
                                   </li>
                                   <li>
                                        <a href="<?= _url('settings/settings_gender') ?>">
                                             <i class="simple-icon-doc"></i> <span class="d-inline-block">Genre</span>
                                        </a>
                                   </li>
                                   <li>
                                        <a href="<?= _url('settings/settings_country') ?>">
                                             <i class="simple-icon-check"></i> <span class="d-inline-block">Pays</span>
                                        </a>
                                   </li>
                                   <li>
                                        <a href="<?= _url('settings/settings_timezone') ?>">
                                             <i class="simple-icon-check"></i> <span class="d-inline-block">Timezones</span>
                                        </a>
                                   </li>
                                   <li>
                                        <a href="<?= _url('settings/settings_rx_link') ?>">
                                             <i class="simple-icon-check"></i> <span class="d-inline-block">Réseaux sociaux</span>
                                        </a>
                                   </li>
                                   <li>
                                        <a href="<?= _url('settings/settings_meet') ?>">
                                             <i class="simple-icon-check"></i> <span class="d-inline-block">Status Rendez-vous</span>
                                        </a>
                                   </li>
                              </ul>
                         </div>
                    </li>
               </ul>

          </div>
     </div>
</div>
