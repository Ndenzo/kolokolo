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
                                             <h6 class="f-w-600">Modules</h6>
                                             <p>List of all modules for classes</p>
                                        </div>
                                   </div>
                                   <ul class="nav main-menu mb-30" role="tablist">
                                        <li class="nav-item">
                                             <button class="btn btn-success btn-block w-100 mt-20 mb-20" type="button" data-toggle="modal" data-bs-target="#custom-modal">
                                                  Add Module
                                             </button>
                                        </li>
                                        <li>
                                             <form class="app-search">
                                                  <div class="app-search-box">
                                                       <div class="input-group">
                                                            <input type="text" class="form-control" id="search" placeholder="Search ...">
                                                       </div>
                                                  </div>
                                             </form>
                                        </li>
                                   </ul>
                                   <ul class="nav main-menu" role="tablist" style="overflow-y: auto; max-height: 510px;">
                                        <?php if(is_array(@$modules)):?>
                                             <?php foreach(@$modules as $module):?>
                                                  <li class="element b-t-light">
                                                       <!-- <span class="f-right">
                                                            <a href="#custom-delete-modal" class="btn btn-pill btn-outline-danger option-sm-btn mt-1 mb-1" style="padding: 8px;" data-toggle="modal" onclick="define_delete(<?= $module->evaluation_module_id ?>, 'evaluation_module_id')"><i class="fa fa-trash"></i></a>
                                                       </span> -->
                                                       <span class="f-right">
                                                            <a href="#custom-update-modal" class="btn btn-pill btn-outline-warning option-sm-btn me-1 mt-1 mb-1" style="padding: 8px;" data-toggle="modal" onclick="define_edit(<?= $module->evaluation_module_id ?>, 'rating/showEdit_module')"><i class="fa fa-edit"></i></a>
                                                       </span>

                                                       <a href="#" data-toggle="modal"><span class="title" style="font-size: 11px;"> <?= substr($module->evaluation_module_name , 0, 30)?> </span></a>
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
          <div class="email-right-aside bookmark-tabcontent">
               <div class="card email-body radius-left">
                    <div class="ps-0">
                         <div class="tab-content">
                              <div class="card mb-0">
                                   <div class="card-header d-flex">
                                        <h6 class="mb-0">Rating Manager</h6>
                                   </div>
                                   <div class="card-body pb-0">

                                        <?php show_notification();?>

                                        <div class="row list-persons" id="addcon">
                                             <div class="col-xxl-4 col-xl-4" >
                                                  <div class="col-12 nav nav-pills b-r-light p-r-25 p-b-25" aria-orientation="vertical" style="overflow-y: auto;">
                                                       <?php foreach(@$cycles as $k => $cycle):?>
                                                            <a class="nav-link col-12 element <?php if ($k == 0): ?> active <?php endif; ?>" id="v-pills-<?= $cycle->settings_cycle_id ?>-tab" data-toggle="pill" href="#v-pills-<?= $cycle->settings_cycle_id ?>" role="tab" aria-controls="v-pills-<?= $cycle->settings_cycle_id ?>" aria-selected="true" style="margin-bottom:0px!important;">
                                                                 <div class="media">
                                                                      <img class="img-40 img-fluid m-r-10 update_img_0" src="<?php _url(); ?>assets/custom/png/023-graduation cap.png">
                                                                      <div class="media-body">
                                                                           <h6 style="margin-top: 10px!important;"> <span><?= $cycle->settings_cycle_name ?></span></h6>
                                                                      </div>
                                                                 </div>
                                                            </a>
                                                       <?php endforeach;?>
                                                  </div>
                                             </div>

                                             <div class="col-xxl-8 col-xl-8" style="height: 600px;">
                                                  <div class="tab-content" id="v-pills-tabContent">
                                                       <?php foreach(@$cycles as $k => $cycle):?>
                                                            <div class="tab-pane contact-tab-4 tab-content-child fade <?php if ($k == 0): ?> show active <?php endif; ?>" id="v-pills-<?= $cycle->settings_cycle_id ?>" role="tabpanel" aria-labelledby="v-pills-<?= $cycle->settings_cycle_id  ?>-tab">
                                                                 <div class="row">
                                                                      <div class="col-xxl-4 col-xl-4">
                                                                           <div class="nav flex-column nav-pills" id="v-pillo-tab" role="tablist" aria-orientation="vertical">
                                                                                <?php foreach(@$cycle->niveaux  as $kk => $niveau):?>
                                                                                     <a class="nav-link <?php if ($kk == 0): ?> active <?php endif; ?>" id="v-pillo-<?= $niveau->settings_niveau_id ?>-tab" data-toggle="pill" href="#v-pillo-<?= $niveau->settings_niveau_id ?>" role="tab" aria-controls="v-pillo-<?= $niveau->settings_niveau_id ?>" aria-selected="true"><?= $niveau->settings_niveau_name ?></a>
                                                                                <?php endforeach;?>
                                                                           </div>
                                                                      </div>
                                                                      <div class="col-xxl-8 col-xl-8">
                                                                           <div class="tab-content" id="v-pillo-tabContent" >
                                                                                <?php foreach(@$cycle->niveaux  as $kk => $niveau):?>
                                                                                     <div class="tab-pane fade <?php if ($kk == 0): ?> show active <?php endif; ?>" id="v-pillo-<?= $niveau->settings_niveau_id ?>" role="tabpanel" aria-labelledby="v-pillo-<?= $niveau->settings_niveau_id ?>-tab">
                                                                                          <div class="row">
                                                                                               <div class="f-left">
                                                                                                    <a href="#custom-modal-<?= $niveau->settings_niveau_id ?>" class="btn btn-pill btn-outline-success btn-lg option-btn" data-toggle="modal"><i data-feather="plus"></i></a>
                                                                                               </div>
                                                                                          </div>
                                                                                          <div class="row mt-30 col-12" style="height: 450px; overflow-y: auto; overflow-x: hidden;">
                                                                                               <?php foreach(@$niveau->modules as $module):?>
                                                                                                    <div class="col-12">
                                                                                                         <div class="ribbon-wrapper card">
                                                                                                              <div class="card-body">
                                                                                                                   <div class="ribbon ribbon-clip ribbon-primary"><?= $module->evaluation_module_name ?></div>
                                                                                                                   <div class="ribbon ribbon-clip-bottom-right ribbon-right ribbon-danger">
                                                                                                                        <a href="#custom-delete-module-modal" class="btn btn-pill option-sm-btn text-white" data-toggle="modal" onclick="define_delete(<?= $module->evaluation_module_niveau_id ?>, 'evaluation_module_niveau_id')"><i class="fa fa-trash"></i></a>
                                                                                                                   </div>

                                                                                                                   <div class="row">
                                                                                                                        <ul class="crm-activity mb-20" style="height:auto!important;">
                                                                                                                             <?php if(is_array(@$module->activites)):?>
                                                                                                                                  <?php foreach(@$module->activites as $activite):?>
                                                                                                                                       <li class="media b-b-light p-t-10 p-b-10">
                                                                                                                                            <span class="me-2">
                                                                                                                                                 <a href="#custom-config-modal-<?= $activite->evaluation_activite_module_id ?>" class="btn btn-pill btn-outline-warning option-sm-btn" data-toggle="modal"><i class="fa fa-edit"></i></a>
                                                                                                                                            </span>

                                                                                                                                            <div class="align-self-center media-body">
                                                                                                                                                 <?php if($activite->settings_activite_code != "non"): ?>
                                                                                                                                                      <h6 class="text-primary"> <?= $activite->settings_activite_name ?> </h6>
                                                                                                                                                 <?php else: ?>
                                                                                                                                                      <h6 class="text-primary"> Module  </h6>
                                                                                                                                                 <?php endif; ?>

                                                                                                                                                 <?php if($activite->config != null): ?>
                                                                                                                                                      <ul class="dates">
                                                                                                                                                           <li>Bar : <strong><?= $activite->config->evaluation_note_config_max ?></strong></li>
                                                                                                                                                           <li> Coef : <strong><?= $activite->config->evaluation_note_config_coef ?></strong></li>
                                                                                                                                                      </ul>
                                                                                                                                                 <?php endif; ?>
                                                                                                                                            </div>
                                                                                                                                       </li>

                                                                                                                                       <div id="custom-config-modal-<?= $activite->evaluation_activite_module_id ?>" class="modal fade bs-example-modal-center show" tabindex="-1" settings_evaluation="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
                                                                                                                                            <div class="modal-dialog modal-dialog-centered">
                                                                                                                                                 <div class="modal-content">
                                                                                                                                                      <div class="modal-header">
                                                                                                                                                           <h4 class="modal-title" id="myCenterModalLabel">Congigurer notation <?= $module->evaluation_module_name ?></h4>
                                                                                                                                                           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                                                                                      </div>
                                                                                                                                                      <div class="modal-body">
                                                                                                                                                           <form class="row justify-content-center" action="<?php _url($module_base.'insert_config'); ?>" method="post">
                                                                                                                                                                <div class="col-10 col-md-12">

                                                                                                                                                                     <div class="form-group mb-3">
                                                                                                                                                                          <label>Max <span class="required">*</span></label>
                                                                                                                                                                          <input type="text" class="form-control" placeholder="Barème de la note" name="evaluation_note_config_max" value="<?=@$activite->config->evaluation_note_config_max?>" required>
                                                                                                                                                                     </div>

                                                                                                                                                                     <div class="form-group mb-3">
                                                                                                                                                                          <label>Coef <span class="required">*</span></label>
                                                                                                                                                                          <input type="text" class="form-control" placeholder="Coefficient de la note" name="evaluation_note_config_coef" value="<?=@$activite->config->evaluation_note_config_coef?>" required>
                                                                                                                                                                     </div>

                                                                                                                                                                     <div class="form-group mb-3">
                                                                                                                                                                          <label>Doit-elle apparaitre dans les controles ? &nbsp;</label>
                                                                                                                                                                          <input type="checkbox" data-plugin="switchery" data-color="#00b19d" name="evaluation_note_config_cont" value="1" <?php if(@$activite->config->evaluation_note_config_cont == 1) echo "checked"; else echo "uncheck"; ?>/>
                                                                                                                                                                     </div>

                                                                                                                                                                </div>
                                                                                                                                                                <div class="modal-footer mt-3">
                                                                                                                                                                     <input type="hidden" type="text" name="evaluation_activite_module_id" value="<?=@$activite->evaluation_activite_module_id?>">
                                                                                                                                                                     <input type="hidden" type="text" name="evaluation_note_config_id" value="<?=@$activite->config->evaluation_note_config_id?>">
                                                                                                                                                                     <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                                                                                                                                                     <button type="submit" class="btn btn-success col-md-4">Ajouter</button>
                                                                                                                                                                </div>
                                                                                                                                                           </form>
                                                                                                                                                      </div>
                                                                                                                                                 </div>
                                                                                                                                            </div>
                                                                                                                                       </div>
                                                                                                                                  <?php endforeach;?>
                                                                                                                             <?php endif;?>
                                                                                                                        </ul>
                                                                                                                   </div>
                                                                                                              </div>
                                                                                                         </div>
                                                                                                    </div>
                                                                                               <?php endforeach; ?>
                                                                                          </div>
                                                                                     </div>

                                                                                     <div id="custom-modal-<?= $niveau->settings_niveau_id ?>" class="modal fade bs-example-modal-center show" tabindex="-1" eleve="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
                                                                                          <div class="modal-dialog">
                                                                                               <div class="modal-content">
                                                                                                    <div class="modal-header">
                                                                                                         <h4 class="modal-title" id="myCenterModalLabel">Add Activity</h4>
                                                                                                         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                                    </div>
                                                                                                    <div class="modal-body">
                                                                                                         <form class="row justify-content-center" action="<?php _url($module_base.'insert_module_niveau'); ?>" method="post">
                                                                                                              <div class="col-10 col-md-12">

                                                                                                                   <div class="form-group mb-3">
                                                                                                                        <label>Module</label>
                                                                                                                        <?php
                                                                                                                        dropDown('SELECT evaluation_module_id, evaluation_module_name FROM evaluation_modules ORDER BY evaluation_module_name', array(
                                                                                                                             'id'=>'evaluation_module_id',
                                                                                                                             'name'=>'evaluation_module_id',
                                                                                                                             'class'=>'form-control selectpicker',
                                                                                                                             'attr'=>'title ="-- Choose --"  data-size="7" data-live-search="true" required'
                                                                                                                        )); ?>
                                                                                                                   </div>


                                                                                                                   <div class="form-group mb-3">
                                                                                                                        <label>Activités</label>
                                                                                                                        <?php
                                                                                                                        dropDown('SELECT settings_activite_id, settings_activite_name FROM settings_activites', array(
                                                                                                                             'id'=>'settings_activite_id',
                                                                                                                             'name'=>'settings_activite_id[]',
                                                                                                                             'class'=>'form-control selectpicker',
                                                                                                                             'attr'=>'title ="-- Choose --"  data-size="7" data-live-search="true" required multiple'
                                                                                                                        )); ?>
                                                                                                                   </div>


                                                                                                              </div>
                                                                                                              <div class="modal-footer mt-3">
                                                                                                                   <input type="hidden" type="text" name="settings_niveau_id" value="<?=@$niveau->settings_niveau_id?>">
                                                                                                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                                                                                                   <button type="submit" class="btn btn-success col-md-4">Ajouter</button>
                                                                                                              </div>
                                                                                                         </form>
                                                                                                    </div>
                                                                                               </div>
                                                                                          </div>
                                                                                     </div>

                                                                                <?php endforeach;?>
                                                                           </div>
                                                                      </div>
                                                                 </div>
                                                            </div>
                                                       <?php endforeach;?>
                                                  </div>
                                             </div>

                                        </div>

                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>

<div id="custom-modal" class="modal fade bs-example-modal-center show" tabindex="-1" eleve="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Add Activity</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'insert_module'); ?>" method="post">
                         <div class="col-10 col-md-12">

                              <div class="form-group mb-3">
                                   <label>Code du module <span class="required">*</span></label>
                                   <input type="text" class="form-control" placeholder="Code du module" name="evaluation_module_code" required>
                              </div>

                              <div class="form-group mb-3">
                                   <label>Nom du module <span class="required">*</span></label>
                                   <input type="text" class="form-control" placeholder="Nom du module" name="evaluation_module_name" required>
                              </div>

                              <div class="modal-footer mt-3">
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-success col-md-4">Ajouter</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div>
     </div>
</div>

<div id="custom-update-modal" class="modal fade bs-example-modal-center show" tabindex="-1" settings_evaluation="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Modifier Module</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'update_module'); ?>" method="post">
                         <div class="col-10 col-md-12">

                              <div class="form-group mb-3">
                                   <label>Code du module <span class="required">*</span></label>
                                   <input type="text" class="form-control" placeholder="Code du module" name="evaluation_module_code" id="evaluation_module_code" required>
                              </div>

                              <div class="form-group mb-3">
                                   <label>Nom du module <span class="required">*</span></label>
                                   <input type="text" class="form-control" placeholder="Nom du module" name="evaluation_module_name" id="evaluation_module_name" required>
                              </div>

                              <div class="modal-footer mt-3">
                                   <input type="hidden" class="form-control" name="evaluation_module_id" id="evaluation_module_id" required>
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-warning col-md-4">Modifier</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<div id="custom-delete-module-modal" class="modal fade bs-example-modal-center show" tabindex="-1" settings_evaluation="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Supprimer module de niveau</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'delete_module_niveau'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 ">
                              <p style="text-align: center; font-size: 14px;">
                                   Le module sélectionner va être supprimer de manière permanante. <br>
                                   Voulez-vous continuer cette opérations ?
                              </p>
                         </div>
                         <div class="modal-footer mt-3">
                              <input type="hidden" type="text" name="evaluation_module_niveau_id" value="">
                              <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                              <button type="submit" class="btn btn-danger col-md-4">Supprimer</button>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>
