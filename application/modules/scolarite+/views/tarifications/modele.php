<div class="row">
     <div class="col-xl-4">
          <a href="#custom-modal" class="btn btn-success btn-md waves-effect waves-light mb-3" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a"><i class="mdi mdi-plus-circle-outline"> </i> Ajouter modele</a>
     </div><!-- end col -->
</div>
<?php show_notification();?>
<div class="row mt-1">
     <?php if(is_array(@$modeles)):?>
          <?php foreach(@$modeles as $modele):?>

               <div class="col-md-4">
                    <div class="card card-inverse text-white" style="background-color: #333; border-color: #333;">
                         <div class="card-body">
                              <h4 class="card-title text-white"><?= $modele->tarification_modele_name ?></h4>
                              <p class="card-text"><?= $modele->tarification_modele_desc ?></p>
                              <div class="row">
                                   <ul class="mb-0">
                                        <?php if(is_array(@$modele->niveaux)):?>
                                             <?php foreach(@$modele->niveaux as $niveau):?>
                                                  <li>
                                                       <?= $niveau->settings_niveau_name ?>
                                                  </li>
                                             <?php endforeach;?>
                                        <?php endif;?>
                                   </ul>
                              </div>
                              <div class="row">
                                   <div class="col-6 mr-auto ml-auto mt-30 mb-30">
                                        <a href="<?= _url("scolarite/tarification/showTarification/?modele=".$modele->tarification_modele_id) ?>" class="btn btn-primary form-control">Configurer</a>
                                   </div>
                                   <div class="col-3 mr-auto ml-auto  mt-30 mb-30">
                                        <div class="dropdown float-right">
                                             <a href="#" class="btn btn-secondary form-control dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                  Action <i class="mdi mdi-chevron-down"></i>
                                             </a>
                                             <div class="dropdown-menu dropdown-menu-right">
                                                  <!-- <a href="#custom-update-modal" class="dropdown-item" data-toggle="modal" onclick="define_edit(<?= $modele->tarification_modele_id ?>, 'scolarite/tarification/showEditModele')"><i class="dropdown-icon mdi mdi-square-edit-outline"></i> Modifier </a>
                                                  <div class="dropdown-divider"></div> -->
                                                  <a href="#custom-delete-modal" class="dropdown-item" data-toggle="modal" onclick="define_delete(<?= $modele->tarification_modele_id ?>, 'tarification_modele_id')"><i class="dropdown-icon mdi mdi-trash-can-outline"></i> Supprimer </a>
                                             </div>
                                        </div>
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
     <h4 class="custom-modal-title">Ajouter modèle</h4>
     <div class="custom-modal-text text-left">
          <form class="row justify-content-center" action="<?php _url($module_base.'insert_modeles'); ?>" method="post">
               <div class="col-10 col-md-12">
                    <div class="form-group mb-3">
                         <label>Niveaux</label>
                         <?php
                         dropDown("select settings_niveau_id, settings_niveau_name FROM settings_niveaux", array(
                              'id'=>'settings_niveau_id',
                              'name'=>'settings_niveau_id[]',
                              'class'=>'form-control selectpicker',
                              'attr'=>'title ="-- Choose --"  data-size="30" data-live-search="true" required selected multiple'
                         )); ?>
                    </div>
                    <div class="form-group mb-3">
                         <label>Nom du modele de tarification</label>
                         <input type="text" class="form-control" placeholder="Nom" name="tarification_modele_name" required>
                    </div>
                    <div class="form-group mb-3">
                         <label>Description</label>
                         <textarea class="form-control" placeholder="Description" name="tarification_modele_desc" rows="3" cols="80" required></textarea>
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

<div id="custom-update-modal" class="modal fade bs-example-modal-center show" tabindex="-1" tarification_modele="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Modifier modele</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'update_modeles'); ?>" method="post">
                         <div class="col-10 col-md-12">
                              <div class="form-group mb-3">
                                   <label>Niveaux</label>
                                   <?php
                                   dropDown("select settings_niveau_id, settings_niveau_name FROM settings_niveaux", array(
                                        'id'=>'settings_niveau_id',
                                        'name'=>'settings_niveau_id[]',
                                        'class'=>'form-control selectpicker',
                                        'attr'=>'title ="-- Choose --"  data-size="30" data-live-search="true" required selected multiple'
                                   )); ?>
                              </div>
                              <div class="form-group mb-3">
                                   <label>Nom du modele de tarification</label>
                                   <input type="text" class="form-control" placeholder="Nom" name="tarification_modele_name" id="tarification_modele_name" required>
                              </div>
                              <div class="form-group mb-3">
                                   <label>Description</label>
                                   <textarea class="form-control" placeholder="Description" name="tarification_modele_desc" id="tarification_modele_desc" rows="3" cols="80" required></textarea>
                              </div>
                              <hr>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" class="form-control" name="tarification_modele_id" id="tarification_modele_id" required>
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-warning col-md-4">Modifier</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>


<div id="custom-delete-modal" class="modal fade bs-example-modal-center show" tabindex="-1" tarification_modele="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Supprimer le modèle</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'delete_modeles'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 ">
                              <p style="text-align: center; font-size: 14px;">
                                   Le modèle sélectionner va être supprimer de manière permanante. <br>
                                   Voulez-vous continuer cette opérations ?
                              </p>
                              <hr>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" type="text" name="tarification_modele_id" value="<?=@$tarification_modele_id?>">
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-danger col-md-4">Supprimer</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>
