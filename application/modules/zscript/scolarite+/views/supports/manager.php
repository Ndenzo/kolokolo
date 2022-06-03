<div class="row">
     <div class="col-xl-4">
          <a href="#custom-modal" class="btn btn-success btn-md waves-effect waves-light mb-3" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a"><i class="mdi mdi-plus-circle-outline"> </i> Ajouter un module</a>
     </div>
</div>

<?php show_notification();?>

<div class="row">
     <div class="col-xl-3">
          <div class="card taskboard-box">
               <div class="dropdown float-right">
                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                         <i class="mdi mdi-dots-vertical"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                         <a href="javascript:void(0);" class="dropdown-item">Action</a>
                         <a href="javascript:void(0);" class="dropdown-item">Another action</a>
                         <a href="javascript:void(0);" class="dropdown-item">Something else</a>
                         <a href="javascript:void(0);" class="dropdown-item">Separated link</a>
                    </div>
               </div>

               <h4 class="card-header mt-0 mb-3 text-warning">Configurator</h4>

               <div class="row">
                    <div class="col-12">
                         <div id="accordion">

                              <div class="card mb-0">

                                   <a href="#collapseOne" class="text-dark mb-3 btn-primary" data-toggle="collapse" aria-expanded="true" aria-controls="collapseOne">
                                        <div class="card-title mb-5" id="headingOne">
                                             <table class="m-0 col-12">
                                                  <tr>
                                                       <td valign="middle"><h5 class="m-0">Liste des modules</h5></td>
                                                  </tr>
                                             </table>
                                        </div>
                                   </a>

                                   <div id="collapseOne" class="collapse show " aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">

                                             <ul class="list-group mb-0 user-list" style="max-height: 550px; overflow-y: auto;">
                                                  <?php foreach(@$modules as $module):?>
                                                       <li class="list-group-item">
                                                            <div class="dropdown float-right">
                                                                 <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                                                      <i class="mdi mdi-dots-vertical"></i>
                                                                 </a>
                                                                 <div class="dropdown-menu dropdown-menu-right">
                                                                      <a href="#custom-update-modal" class="dropdown-item" data-toggle="modal" onclick="define_edit(<?= $module->evaluation_module_id ?>, 'scolarite/evaluation/showEdit_module')"><i class="dropdown-icon mdi mdi-square-edit-outline"></i> Modifier </a>
                                                                      <div class="dropdown-divider"></div>
                                                                      <a href="#custom-delete-modal" class="dropdown-item" data-toggle="modal" onclick="define_delete(<?= $module->evaluation_module_id ?>, 'evaluation_module_id')"><i class="dropdown-icon mdi mdi-trash-can-outline"></i> Supprimer </a>
                                                                 </div>
                                                            </div>
                                                            <div class="user-list-item">
                                                                 <div class="user float-left mr-3">
                                                                      <i class="mdi mdi-circle text-primary"></i>
                                                                 </div>
                                                                 <div class="user-desc overflow-hidden">
                                                                      <h6 class="name mt-0 mb-1"><?= $module->evaluation_module_name ?></h6>
                                                                 </div>
                                                            </div>
                                                       </li>
                                                  <?php endforeach;?>
                                             </ul>

                                        </div>
                                   </div>

                              </div>

                         </div>
                    </div>
               </div>
          </div>
     </div>
     <?php if(is_array(@$cycles)):?>
          <?php foreach(@$cycles as $cycle):?>
               <div class="col-xl-3">
                    <div class="card taskboard-box">
                         <div class="dropdown float-right">
                              <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                   <i class="mdi mdi-dots-vertical"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right">
                                   <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                   <a href="javascript:void(0);" class="dropdown-item">Another action</a>
                                   <a href="javascript:void(0);" class="dropdown-item">Something else</a>
                                   <a href="javascript:void(0);" class="dropdown-item">Separated link</a>
                              </div>
                         </div>

                         <h4 class="card-header mt-0 mb-3 text-warning"><?= $cycle->settings_cycle_name ?></h4>

                         <div class="row">
                              <div class="col-12">
                                   <div id="accordion">
                                        <?php foreach(@$cycle->niveaux as $niveau):?>

                                             <div class="card mb-0">
                                                  <a href="#collapseOne<?= $niveau->settings_niveau_id ?>" class="text-dark mb-3 btn-primary" data-toggle="collapse" aria-expanded="true" aria-controls="collapseOne">
                                                       <div class="card-title mb-5" id="headingOne">
                                                            <table class="m-0 col-12">
                                                                 <tr>
                                                                      <td valign="middle"><h5 class="m-0"><?= $niveau->settings_niveau_name ?></h5></td>
                                                                      <td valign="middle" style="width: 50px;"><a href="#custom-modal-<?= $niveau->settings_niveau_id ?>" class="btn btn-success btn-md waves-effect waves-light m-0" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a">+</a></td>
                                                                 </tr>
                                                            </table>
                                                       </div>
                                                  </a>


                                                  <div id="collapseOne<?= $niveau->settings_niveau_id ?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                                       <div class="card-body">

                                                            <ul class="list-group mb-0 mt-0 user-list" style="max-height: 550px; overflow-y: auto;">
                                                                 <?php foreach(@$niveau->modules as $module):?>
                                                                      <li class="list-group-item">
                                                                           <div class="float-right">
                                                                                <a href="#custom-support-modal-<?= $module->support_module_niveau_id ?>" class="btn btn-icon waves-effect waves-light btn-lighten-secondary" data-toggle="modal" ><i class="dropdown-icon mdi mdi-book-multiple"></i></a>
                                                                                <a href="#custom-delete-module-modal" class="btn btn-icon waves-effect waves-light btn-lighten-danger" data-toggle="modal" onclick="define_delete(<?= $module->support_module_niveau_id ?>, 'support_module_niveau_id')"><i class="dropdown-icon mdi mdi-trash-can-outline"></i></a>
                                                                           </div>
                                                                           <div class="user-list-item">
                                                                                <div class="user-desc overflow-hidden">
                                                                                     <h5 class="name mt-2"><?= $module->evaluation_module_name ?></h5>
                                                                                </div>
                                                                           </div>
                                                                      </li>

                                                                      <div id="custom-support-modal-<?= $module->support_module_niveau_id ?>" class="modal fade bs-example-modal-center show" tabindex="-1" settings_evaluation="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
                                                                           <div class="modal-dialog modal-xl">
                                                                                <div class="modal-content">
                                                                                     <div class="modal-header">
                                                                                          <h4 class="modal-title" id="myCenterModalLabel">Gérer les supports</h4>
                                                                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                     </div>
                                                                                     <div class="modal-body">
                                                                                          <div class="row">
                                                                                               <form class="col-5 justify-content-center" action="<?php _url($module_base.'insert_support'); ?>" method="post" enctype="multipart/form-data">

                                                                                                    <div class="form-group mb-3">
                                                                                                         <label>Nom du support <span class="required">*</span></label>
                                                                                                         <input type="text" class="form-control" placeholder="Nom du support" name="support_name" required>
                                                                                                    </div>

                                                                                                    <div class="form-group mb-3">
                                                                                                         <label>Importer support <span class="required">*</span></label>
                                                                                                         <input type="file" class="dropify" data-default-file="<?php _url(); ?>assets/custom/png/pdf.png" name="file" accept=".pdf"/>
                                                                                                    </div>

                                                                                                    <hr>
                                                                                                    <div class="modal-footer mt-3">
                                                                                                         <input type="hidden" class="form-control" name="support_module_niveau_id" value="<?= $module->support_module_niveau_id ?>" required>
                                                                                                         <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                                                                                         <button type="submit" class="btn btn-success col-md-6">Enregistrer</button>
                                                                                                    </div>
                                                                                               </form>
                                                                                               <div class="col-7">
                                                                                                    <h4 class="card-header mt-0 mb-3 ml-3 text-primary">Fichiers</h4>
                                                                                                    <ul class="list-group mb-0 user-list">
                                                                                                         <?php foreach(@$module->supports as $support):?>
                                                                                                              <li class="list-group-item">
                                                                                                                   <div class="float-right">
                                                                                                                        <a href="#custom-delete-support-modal" class="btn btn-icon waves-effect waves-light btn-lighten-danger" data-toggle="modal" onclick="define_delete(<?= $support->support_id ?>, 'support_id')"><i class="dropdown-icon mdi mdi-trash-can-outline"></i></a>
                                                                                                                   </div>
                                                                                                                   <a href="<?= _url($support->support_link) ?>" target="_blank" class="user-list-item">
                                                                                                                        <div class="user avatar-sm float-left mr-2">
                                                                                                                             <img src="<?php _url(); ?>assets/custom/png/pdf.png" alt="" class="img-fluid rounded-circle">
                                                                                                                        </div>
                                                                                                                        <div class="user-desc">
                                                                                                                             <h5 class="name mt-0 mb-1"><?= $support->support_name ?></h5>
                                                                                                                             <p class="desc text-muted mb-0 font-12"><?= gmdate("d-m-Y", $support->support_added) ?></p>
                                                                                                                        </div>
                                                                                                                   </a>
                                                                                                              </li>
                                                                                                         <?php endforeach;?>
                                                                                                    </ul>
                                                                                               </div>
                                                                                          </div>

                                                                                     </div>
                                                                                </div><!-- /.modal-content -->
                                                                           </div><!-- /.modal-dialog -->
                                                                      </div>
                                                                 <?php endforeach;?>
                                                            </ul>

                                                       </div>
                                                  </div>
                                             </div>

                                             <div id="custom-modal-<?= $niveau->settings_niveau_id ?>" class="modal-demo">
                                                  <button type="button" class="close" onclick="Custombox.modal.close();">
                                                       <span>&times;</span><span class="sr-only">Close</span>
                                                  </button>
                                                  <h4 class="custom-modal-title">Ajouter module</h4>
                                                  <div class="custom-modal-text text-left">
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

                                                                 <hr>
                                                                 <div class="modal-footer mt-3">
                                                                      <input type="hidden" type="text" name="settings_niveau_id" value="<?=@$niveau->settings_niveau_id?>">
                                                                      <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                                                      <button type="submit" class="btn btn-success col-md-4">Ajouter</button>
                                                                 </div>
                                                            </div>
                                                       </form>
                                                  </div>
                                             </div>

                                        <?php endforeach;?>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          <?php endforeach;?>
     <?php endif;?>
</div>

<div id="custom-modal" class="modal-demo">
     <button type="button" class="close" onclick="Custombox.modal.close();">
          <span>&times;</span><span class="sr-only">Close</span>
     </button>
     <h4 class="custom-modal-title">Ajouter module</h4>
     <div class="custom-modal-text text-left" style="overflow-y: auto;">
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

                    <hr>
                    <div class="modal-footer mt-3">
                         <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                         <button type="submit" class="btn btn-success col-md-4">Ajouter</button>
                    </div>
               </div>
          </form>
     </div>
</div>

<div id="custom-update-modal" class="modal fade bs-example-modal-center show" tabindex="-1" settings_evaluation="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Modifier evaluation</h4>
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

                              <hr>
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
                              <hr>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" type="text" name="support_module_niveau_id" value="">
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-danger col-md-4">Supprimer</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<div id="custom-delete-support-modal" class="modal fade bs-example-modal-center show" tabindex="-1" settings_evaluation="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Supprimer support</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'delete_support'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 ">
                              <p style="text-align: center; font-size: 14px;">
                                   Le support sélectionner va être supprimer de manière permanante. <br>
                                   Voulez-vous continuer cette opérations ?
                              </p>
                              <hr>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" type="text" name="support_id" value="">
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-danger col-md-4">Supprimer</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<div id="custom-delete-modal" class="modal fade bs-example-modal-center show" tabindex="-1" settings_evaluation="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Supprimer evaluation</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'delete'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 ">
                              <p style="text-align: center; font-size: 14px;">
                                   Le module sélectionner va être supprimer de manière permanante. <br>
                                   Voulez-vous continuer cette opérations ?
                              </p>
                              <hr>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" type="text" name="evaluation_module_id" id="evaluation_module_id">
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-danger col-md-4">Supprimer</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>
