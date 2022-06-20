
<style media="screen">
     td{
          vertical-align: middle!important;
     }
</style>
<!-- <div class="row">
     <div class="col-xl-4">
          <a href="#custom-modal" class="btn btn-success btn-md waves-effect waves-light mb-3" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a"><i class="mdi mdi-plus-circle-outline"> </i> Ajouter matiere</a>
     </div>
</div> -->
<?php show_notification();?>
<div class="row mt-5">
     <div class="col-12">
          <div class="card">
               <h4 class="mt-0 card-header">Liste des matieres</h4>
               <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap">
                    <thead>
                         <tr>
                              <th></th>
                              <th>Matricule</th>
                              <th>Prénoms et nom</th>
                              <th>Naissance</th>
                              <th>Tuteur</th>
                              <th>Téléphone</th>
                              <th>Statuts</th>
                              <th class="justify-content-center" style="width: 100px;">Opérations</th>
                         </tr>
                    </thead>
                    <tbody>
                         <?php if(is_array(@$datagrid)):?>
                              <?php foreach(@$datagrid as $rows):?>
                                   <tr >
                                        <!-- <td><img src="<?= _url(@$rows->personne_photo)?>" class="rounded-circle" height="50" width="50" alt="<?= @$rows->personne_prenoms ?>"></td> -->
                                        <?php if($rows->personne_photo != null):?>
                                             <td><div class="rounded avatar-xl ml-auto mr-auto" style="height: 50px; width: 50px; box-shadow: 10px 10px 10px; background-image: url('<?= _url($rows->personne_photo) ?>'); background-size: cover; background-repeat: no-repeat; background-position: center;"></div></td>
                                        <?php else:?>
                                             <td><img  class="rounded avatar-xl img-thumbnail" alt="profile-image"></td>
                                        <?php endif;?>
                                        <td><?=@$rows->eleve_matricule?></td>
                                        <td><?=@$rows->personne_prenoms." ".@$rows->personne_nom?></td>
                                        <td><?=mysql_to_date(@$rows->personne_naissance_date).", ".@$rows->personne_naissance_lieu?></td>
                                        <td><?=@$rows->personne_prenoms." ".@$rows->personne_nom?></td>
                                        <td><?=@$rows->personne_telephone_1?></td>
                                        <td><span class="badge badge-<?=@$rows->eleve_flag_class?>"><?=@$rows->eleve_flag_label?></span></td>
                                        <td style="text-align:center;">
                                             <div class="item-action dropdown">
                                                  <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions <i class="mdi mdi-chevron-down"></i></button>
                                                  <div class="dropdown-menu dropdown-menu-right">
                                                       <a href="<?php _url($module_base.'showNiveau/'.$rows->eleve_id); ?>" class="dropdown-item"><i class="dropdown-icon fe mdi mdi-playlist-star"></i> Inscrire </a>
                                                       <a href="#custom-update-modal" class="dropdown-item" data-toggle="modal" onclick="define_edit(<?= $rows->eleve_id ?>, 'settings/settings_matiere/showEdit')"><i class="dropdown-icon mdi mdi-square-edit-outline"></i> Modifier </a>
                                                       <div class="dropdown-divider"></div>
                                                       <a href="#custom-delete-modal" class="dropdown-item" data-toggle="modal" onclick="define_delete(<?= $rows->eleve_id ?>, 'settings_matiere_id')"><i class="dropdown-icon mdi mdi-trash-can-outline"></i> Supprimer </a>
                                                  </div>
                                             </div>
                                        </td>
                                   </tr>
                              <?php endforeach;?>
                         <?php endif;?>
                    </tbody>
               </table>
          </div>
     </div>
</div>

<div id="custom-modal" class="modal-demo">
     <button type="button" class="close" onclick="Custombox.modal.close();">
          <span>&times;</span><span class="sr-only">Close</span>
     </button>
     <h4 class="custom-modal-title">Ajouter matiere</h4>
     <div class="custom-modal-text text-left">
          <form class="row justify-content-center" action="<?php _url('settings/settings_matiere/insert'); ?>" method="post">
               <div class="col-10 col-md-12">
                    <div class="form-group mb-3">
                         <label>Code matiere</label>
                         <input type="text" class="form-control" placeholder="Code" name="settings_matiere_code" required>
                    </div>
                    <div class="form-group mb-3">
                         <label>Cycle</label>
                         <?php
                         dropDown("select settings_cycle_id, settings_cycle_name FROM settings_cycles", array(
                             'id'=>'settings_cycle_id',
                             'name'=>'settings_cycle_id',
                             'class'=>'form-control selectpicker',
                             'attr'=>'title ="-- Choose --"  data-size="7" data-live-search="true" required'
                         )); ?>
                    </div>
                    <div class="form-group mb-3">
                         <label>Nom du matiere</label>
                         <input type="text" class="form-control" placeholder="Nom" name="settings_matiere_name" required>
                    </div>
                    <div class="form-group mb-3">
                         <label>Description</label>
                         <textarea class="form-control" placeholder="Description" name="settings_matiere_desc" rows="3" cols="80" required></textarea>
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

<div id="custom-update-modal" class="modal fade bs-example-modal-center show" tabindex="-1" settings_matiere="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Modifier matiere</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url('settings/settings_matiere/update'); ?>" method="post">
                         <div class="col-10 col-md-12">
                              <div class="form-group mb-3">
                                   <label>Code matiere</label>
                                   <input type="text" class="form-control" placeholder="Code" name="settings_matiere_code" id="settings_matiere_code" required>
                              </div>
                              <div class="form-group mb-3">
                                   <label>Cycle</label>
                                   <?php
                                   dropDown("select settings_cycle_id, settings_cycle_name FROM settings_cycles", array(
                                       'id'=>'settings_cycle_id',
                                       'name'=>'settings_cycle_id',
                                       'class'=>'form-control selectpicker',
                                       'attr'=>'title ="-- Choose --"  data-size="7" data-live-search="true" required selected'
                                   )); ?>
                              </div>
                              <div class="form-group mb-3">
                                   <label>Nom du matiere</label>
                                   <input type="text" class="form-control" placeholder="Nom" name="settings_matiere_name" id="settings_matiere_name" required>
                              </div>
                              <div class="form-group mb-3">
                                   <label>Description</label>
                                   <textarea class="form-control" placeholder="Description" name="settings_matiere_desc" id="settings_matiere_desc" rows="3" cols="80" required></textarea>
                              </div>
                              <hr>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" class="form-control" name="settings_matiere_id" id="settings_matiere_id" required>
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-warning col-md-4">Modifier</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>


<div id="custom-delete-modal" class="modal fade bs-example-modal-center show" tabindex="-1" settings_matiere="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Supprimer matiere</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url('settings/settings_matiere/delete'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 ">
                              <p style="text-align: center; font-size: 14px;">
                                   Le matiere sélectionner va être supprimer de manière permanante. <br>
                                   Voulez-vous continuer cette opérations ?
                              </p>
                              <hr>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" type="text" name="settings_matiere_id" value="<?=@$settings_matiere_id?>">
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-danger col-md-4">Supprimer</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>
