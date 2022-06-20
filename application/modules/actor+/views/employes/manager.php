<div class="col-md-12 project-list">
     <div class="card">
          <div class="row">
               <div class="col-md-6">
                    <ul class="nav nav-tabs border-tab" id="top-tab" role="tablist"></ul>
               </div>
               <div class="col-md-6 dropdown-basic">
                    <div class="form-group mb-0 me-0"></div>
                    <div class="dropdown f-right">
                         <button class="dropbtn btn btn-success" type="button">
                              Gestion des employés <span><i class="icofont icofont-settings-alt" style="margin-left: 20px;"></i></span>
                         </button>
                         <div class="dropdown-content" style="margin-top: -10px;">
                              <a href="<?= _url($module_base."showAdd") ?>" class="dropdown-item"><i class="fa fa-plus"></i> Ajouter Employé </a>
                              <a href="<?= _url($module_base.'showEmployeList') ?>" class="dropdown-item"><i class="fa fa-download"> </i> Liste des employés </a>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>

<div class="row">
     <div class="col-xl-3 box-col-6">
          <div class="email-wrap bookmark-wrap">
               <div class="email-left-aside">
                    <div class="card">
                         <div class="card-body">
                              <div class="email-app-sidebar left-bookmark">
                                   <div class="media">
                                        <div class="media-size-email">
                                             <img class="me-3" src="<?php _url(); ?>assets/custom/png/011-exam.png" alt="" style="width: 50px; border:none!important;">
                                        </div>
                                        <div class="media-body">
                                             <h6 class="f-w-600">Fonction</h6>
                                             <p>Liste de toutes les fonctions des employés</p>
                                        </div>
                                   </div>
                                   <ul class="nav main-menu mb-30" role="tablist">
                                        <li class="nav-item">
                                             <button class="btn btn-success btn-block w-100 mt-20 mb-20" type="button" data-toggle="modal" data-bs-target="#custom-function-modal">
                                                  Ajouter Fonction
                                             </button>
                                        </li>
                                        <li>
                                             <form class="app-search">
                                                  <div class="app-search-box">
                                                       <div class="input-group">
                                                            <input type="text" class="form-control" id="search" placeholder="Rechercher ...">
                                                       </div>
                                                  </div>
                                             </form>
                                        </li>
                                   </ul>

                                   <ul class="nav main-menu contact-option" role="tablist" style="overflow-y: auto; max-height: 510px;">
                                        <?php if(is_array(@$settings_fonctions)):?>
                                             <?php foreach(@$settings_fonctions as $settings_fonction):?>
                                                  <li class="element b-t-light">


                                                       <a id="pills-fonction-<?= $settings_fonction->settings_fonction_id ?>-tab" data-toggle="pill" href="#pills-fonction-<?= $settings_fonction->settings_fonction_id ?>" role="tab" aria-controls="pills-fonction-<?= $settings_fonction->settings_fonction_id ?>" aria-selected="false">
                                                            <span class="title"> <?= substr($settings_fonction->settings_fonction_name , 0, 30)?> </span>
                                                            <span class="f-right">
                                                                 <div class="span badge pill-badge-primary mt-2 mb-2"><?= count(@$settings_fonction->employes) ?></div>
                                                            </span>
                                                       </a>
                                                  </li>

                                             <?php endforeach;?>
                                        <?php endif;?>
                                   </ul>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <div class="col-xl-9 col-md-12 box-col-12">
          <div class="email-right-aside bookmark-tabcontent contacts-tabs">
               <div class="card email-body radius-left">
                    <div class="ps-0">
                         <div class="tab-content">
                              <?php if(is_array(@$settings_fonctions)):?>
                                   <?php foreach(@$settings_fonctions as $k => $settings_fonction):?>
                                        <div class="tab-pane fade <?php if ($k == 0): ?> show active <?php endif; ?>" id="pills-fonction-<?= $settings_fonction->settings_fonction_id ?>" role="tabpanel" aria-labelledby="pills-fonction-<?= $settings_fonction->settings_fonction_id ?>-tab">
                                             <div class="card mb-0">
                                                  <div class="card-header d-flex">
                                                       <h5><?= $settings_fonction->settings_fonction_name ?></h5>
                                                       <span class="f-14 pull-right mt-0">
                                                            <a href="#custom-update-function-modal" class="btn btn-warning option-sm-btn me-1 mt-1 mb-1" style="padding-top: 5px; padding-left: 7px;" data-toggle="modal" onclick="define_edit(<?= $settings_fonction->settings_fonction_id ?>, 'actor/employe/showEdit_fonction')"><i class="fa fa-edit"></i></a>
                                                       </span>
                                                  </div>
                                                  <div class="card-body p-0">
                                                       <div class="row list-persons" id="addcon">
                                                            <div class="col-xl-4 xl-50 col-md-5">
                                                                 <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                                      <?php if(is_array(@$settings_fonction->employes)):?>
                                                                           <?php foreach ($settings_fonction->employes as $key => $rows): ?>
                                                                                <a class="contact-tab-0 nav-link <?php if ($key == 0): ?> active <?php endif; ?>" id="v-pills-employe-<?= $rows->employe_id ?>-tab" data-toggle="pill" href="#v-pills-employe-<?= $rows->employe_id ?><?= $settings_fonction->settings_fonction_id ?>" role="tab" aria-controls="v-pills-employe-<?= $rows->employe_id ?><?= $settings_fonction->settings_fonction_id ?>" aria-selected="true">
                                                                                     <div class="media">
                                                                                          <?php if($rows->personne_photo != null):?>
                                                                                               <img class="img-50 img-fluid m-r-20 rounded-circle update_img_0" src="<?= _url($rows->personne_photo) ?>" alt="">
                                                                                          <?php else:?>
                                                                                               <img class="img-50 img-fluid m-r-20 rounded-circle update_img_0" src="<?php _url(); ?>assets/custom/img/default/boy.png" alt="">
                                                                                          <?php endif;?>
                                                                                          <div class="media-body">
                                                                                               <h6> <span class="first_name_0"><?= $rows->personne_prenoms ?> </span><span class="last_name_0"><?= $rows->personne_nom ?></span></h6>
                                                                                               <p class="email_add_0"><?= $rows->employe_desc ?></p>
                                                                                          </div>
                                                                                     </div>
                                                                                </a>
                                                                           <?php endforeach; ?>
                                                                      <?php endif;?>
                                                                 </div>
                                                            </div>
                                                            <div class="col-xl-8 xl-50 col-md-7">
                                                                 <div class="tab-content" id="v-pills-tabContent">
                                                                      <?php if(is_array(@$settings_fonction->employes)):?>
                                                                           <?php foreach ($settings_fonction->employes as $key => $rows): ?>
                                                                                <div class="tab-pane contact-tab-0 tab-content-child fade <?php if ($key == 0): ?>show active <?php endif; ?>" id="v-pills-employe-<?= $rows->employe_id ?><?= $settings_fonction->settings_fonction_id ?>" role="tabpanel" aria-labelledby="v-pills-employe-<?= $rows->employe_id ?><?= $settings_fonction->settings_fonction_id ?>-tab">
                                                                                     <div class="profile-mail">
                                                                                          <div class="media">
                                                                                               <?php if($rows->personne_photo != null):?>
                                                                                                    <img class="img-100 img-fluid m-r-20 rounded-circle update_img_0" src="<?= _url($rows->personne_photo) ?>" alt="">
                                                                                               <?php else:?>
                                                                                                    <img class="img-100 img-fluid m-r-20 rounded-circle update_img_0" src="<?php _url(); ?>assets/custom/img/default/boy.png" alt="">
                                                                                               <?php endif;?>
                                                                                               <div class="media-body mt-0">
                                                                                                    <h5><span class="first_name_0"><?= $rows->personne_prenoms ?> </span><span class="last_name_0"><?= $rows->personne_nom ?></span></h5>
                                                                                                    <p class="email_add_0 badge badge-<?= @$rows->employe_flag_class ?>"><?= @$rows->employe_flag_label ?></p>
                                                                                                    <ul>
                                                                                                         <li>
                                                                                                              <a href="<?= _url($module_base."showEdit/".@$rows->personne_id) ?>" class="btn btn-warning option-sm-btn" target="_blank"><i class="fa fa-pencil"></i></a>
                                                                                                         </li>
                                                                                                         <li>
                                                                                                              <a href="#custom-lock-modal" class="btn btn-danger option-sm-btn" data-toggle="modal" onclick="define_delete(<?= $rows->employe_id ?>, 'employe_id')"><i class="fa fa-trash"></i></a>
                                                                                                         </li>
                                                                                                         <li>
                                                                                                              <?php if ($rows->employe_locked == 0): ?>
                                                                                                                   <a href="#custom-locked-modal" class="btn btn-info option-sm-btn" data-toggle="modal" onclick="define_delete(<?= $rows->employe_id ?>, 'employe_id')" title="Lock this teacher !"><i class="fa fa-lock"></i></a>
                                                                                                              <?php else: ?>
                                                                                                                   <a href="#custom-unlocked-modal" class="btn btn-info option-sm-btn" data-toggle="modal" onclick="define_delete(<?= $rows->employe_id ?>, 'employe_id')" title="Unlock this teacher !"><i class="fa fa-unlock"></i></a>
                                                                                                              <?php endif; ?>
                                                                                                         </li>
                                                                                                         <li>
                                                                                                              <a href="#custom-commission-modal-<?= @$rows->teacher_id?>" class="btn btn-dark option-sm-btn" data-toggle="modal" onclick="define_delete(<?= $rows->employe_id ?>, 'employe_id')"><i class="fa fa-percent"></i></a>
                                                                                                         </li>
                                                                                                    </ul>
                                                                                               </div>
                                                                                          </div>
                                                                                          <div class="email-general">
                                                                                               <h6 class="mb-3">General</h6>
                                                                                               <ul>
                                                                                                    <li>Civilité <span class="font-primary"><?= @$rows->settings_genre_name ?></span></li>
                                                                                                    <li>Naissance <span class="font-primary"> <?= mysql_to_date(@$rows->personne_naissance_date) ?></span></li>
                                                                                                    <li>Adresse<span class="font-primary city_0"> <?=@$rows->personne_adresse?> </span></li>
                                                                                                    <li>Telephone <span class="font-primary mobile_num_0"><?= @$rows->personne_telephone_1 ?></span></li>
                                                                                                    <li>Email<span class="font-primary city_0"><?= @$rows->employe_email ?></span></li>

                                                                                                    <!-- <li>Email Address <span class="font-primary email_add_0">barnes@gmail.com </span></li>
                                                                                                    <li>Website<span class="font-primary url_add_0">www.test.com</span></li>
                                                                                                    <li>Interest<span class="font-primary interest_0">photography</span></li> -->
                                                                                               </ul>
                                                                                          </div>
                                                                                     </div>
                                                                                </div>
                                                                           <?php endforeach; ?>
                                                                      <?php endif;?>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   <?php endforeach;?>
                              <?php endif;?>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>

<div id="custom-function-modal" class="modal fade bs-example-modal-center show" tabindex="-1" eleve="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Ajouter Fonction</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'insert_fonction'); ?>" method="post">
                         <div class="col-10 col-md-12 mt-10">
                              <div class="form-group mb-3">
                                   <label>Code fonction</label>
                                   <input type="text" class="form-control" placeholder="Code" name="settings_fonction_code" required>
                              </div>
                              <div class="form-group mb-3">
                                   <label>Nom du fonction</label>
                                   <input type="text" class="form-control" placeholder="Nom" name="settings_fonction_name" required>
                              </div>
                              <div class="form-group mb-3">
                                   <label>Description</label>
                                   <textarea class="form-control" placeholder="Description" name="settings_fonction_desc" rows="3" cols="80" required></textarea>
                              </div>
                         </div>
                         <div class="modal-footer mt-3">
                              <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                              <button type="submit" class="btn btn-success col-md-4">Ajouter</button>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<div id="custom-update-function-modal" class="modal fade bs-example-modal-center show" tabindex="-1" eleve="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Modifier Function</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'update_fonction'); ?>" method="post">
                         <div class="col-10 col-md-12 mt-10">
                              <div class="form-group mb-3">
                                   <label>Code fonction</label>
                                   <input type="text" class="form-control" placeholder="Code" name="settings_fonction_code" id="settings_fonction_code" required>
                              </div>
                              <div class="form-group mb-3">
                                   <label>Nom du fonction</label>
                                   <input type="text" class="form-control" placeholder="Nom" name="settings_fonction_name" id="settings_fonction_name" required>
                              </div>
                              <div class="form-group mb-3">
                                   <label>Description</label>
                                   <textarea class="form-control" placeholder="Description" name="settings_fonction_desc" id="settings_fonction_desc" rows="3" cols="80" required></textarea>
                              </div>
                         </div>
                         <div class="modal-footer mt-3">
                              <input type="hidden" class="form-control" name="settings_fonction_id" id="settings_fonction_id" required>
                              <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                              <button type="submit" class="btn btn-warning col-md-4">Modifier</button>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<div id="custom-delete-modal" class="modal fade bs-example-modal-center show" tabindex="-1" eleve="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Supprimer employé</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'delete'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 mt-10">
                              <p style="text-align: center; font-size: 14px;">
                                   L'employé sélectionné va être supprimer de manière permanante. <br>
                                   Voulez-vous continuer cette opérations ?
                              </p>

                              <div class="modal-footer mt-3">
                                   <input type="hidden" type="text" name="personne_id">
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-danger col-md-4">Supprimer</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>


<div id="custom-lock-modal" class="modal fade bs-example-modal-center show" tabindex="-1" eleve="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Supprimer employé</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'lock'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 mt-10">
                              <p style="text-align: center; font-size: 14px;">
                                   L'employé sélectionner va être supprimer de manière permanante. <br>
                                   Voulez-vous continuer cette opérations ?
                              </p>

                              <div class="modal-footer mt-3">
                                   <input type="hidden" type="text" name="employe_id">
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-danger col-md-4">Supprimer</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>
