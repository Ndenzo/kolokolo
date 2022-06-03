<div class="col-md-12 project-list">
     <div class="card">
          <div class="row">
               <div class="col-md-6"></div>
               <div class="col-md-6">
                    <a href="#custom-modal"  class="btn btn-success f-right" data-toggle="modal"><i class="fa fa-plus"> </i> New Pricing </a>
               </div>
          </div>
     </div>
</div>

<?php show_notification();?>

<div class="row mt-1">
     <?php if(is_array(@$modeles)):?>
          <?php foreach(@$modeles as $modele):?>

               <div class="col-xl-6 col-xxl-4">
                    <div class="card">
                         <div class="job-search">
                              <div class="card-body">
                                   <div class="media">
                                        <img class="img-40 img-fluid m-r-20" src="<?= _url() ?>assets/custom/png/028-abacus.png" alt="">
                                        <div class="media-body" style="padding-top: 10px;">
                                             <h6 class="f-w-600"><a href="#"><?= $modele->tarification_modele_name ?></a></h6>
                                        </div>
                                   </div>
                                   <p><?= $modele->tarification_modele_desc ?></p>
                                   <div class="row">
                                        <ul class="mb-0">
                                             <?php if(is_array(@$modele->niveaux)):?>
                                                  <?php foreach(@$modele->niveaux as $niveau):?>
                                                       <li>
                                                            <span>
                                                                 <i class="fa fa-check-square-o"> </i>
                                                            </span>
                                                            <?= $niveau->settings_niveau_name ?>
                                                       </li>
                                                  <?php endforeach;?>
                                             <?php endif;?>
                                        </ul>
                                   </div>
                                   <div class="row">
                                        <div class="col-6 mr-auto ml-auto mt-30 mb-30">
                                             <a href="<?= _url("pricing/showPricing/?modele=".$modele->tarification_modele_id) ?>" class="btn btn-primary form-control">Configurer</a>
                                        </div>
                                        <div class="col-3 mr-auto ml-auto mt-30 mb-30 m-l-20">
                                             <span class="f-right">
                                                  <div class="text-end text-center" style=";">
                                                       <div class="dropdown">
                                                            <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Action</button>
                                                            <div class="dropdown-menu dropdown-menu-end" style="font-weight: bold!important;">
                                                                 <a href="#custom-delete-modal" class="dropdown-item text-danger" data-toggle="modal" onclick="define_delete(<?= $modele->tarification_modele_id ?>, 'tarification_modele_id')"><i class="fa fa-trash"></i> Supprimer </a>
                                                            </div>
                                                       </div>
                                                  </div>
                                             </span>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

          <?php endforeach;?>
     <?php endif;?>
</div>

<div id="custom-modal" class="modal fade bs-example-modal-center show" tabindex="-1" eleve="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Add Modele</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
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

                              <div class="modal-footer mt-3">
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-success col-md-4">Ajouter</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
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
