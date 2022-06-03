
<style media="screen">
td{
     vertical-align: middle!important;
}
</style>
<div class="row">
     <div class="col-xl-4 mb-3">
          <button class="btn btn-success btn-md waves-effect waves-light dropdown-toggle" data-toggle="dropdown">Gestion des élèves<i class="mdi mdi-chevron-down"></i></button>
          <div class="dropdown-menu dropdown-menu">
               <a href="<?php _url($module_base."showCards") ?>"  class="dropdown-item" target="_blank"><i class="dropdown-icon mdi mdi-file-document-box-outline"></i> Générer cartes d'identités </a>
               <!-- <a href="#custom-groupe-modal" class="dropdown-item"  data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a"><i class="dropdown-icon mdi mdi-file-document-outline"></i> Facture groupée </a> -->
          </div>
     </div>
</div>
<?php show_notification();?>
<div class="row">
     <div class="col-12">
          <div class="card">
               <h4 class="mt-0 card-header">Liste des matieres</h4>
               <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap">
                    <thead>
                         <tr>
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
                                        <td><?=@$rows->eleve_matricule?></td>
                                        <td><?=@$rows->personne_prenoms." ".@$rows->personne_nom?></td>
                                        <td><?=mysql_to_date(@$rows->personne_naissance_date).", ".@$rows->personne_naissance_lieu?></td>
                                        <td><?=@$rows->personne_prenoms_tuteur." ".@$rows->personne_nom_tuteur?></td>
                                        <td><?=@$rows->personne_telephone_1?></td>
                                        <td><span class="badge badge-<?=@$rows->eleve_flag_class?>"><?=@$rows->eleve_flag_label?></span></td>
                                        <td style="text-align:center;">
                                             <div class="item-action dropdown">
                                                  <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions <i class="mdi mdi-chevron-down"></i></button>
                                                  <div class="dropdown-menu dropdown-menu-right">
                                                       <?php if ($rows->eleve_flag_code == "ins"): ?>
                                                            <!-- <a href="<?php _url($module_base.'showCertificat/'.$rows->eleve_id); ?>" class="dropdown-item"><i class="dropdown-icon mdi mdi-file-download"></i> Certificat </a> -->
                                                       <?php endif; ?>
                                                       <?php if ($rows->reduction == null): ?>
                                                            <a href="#custom-reduction-modal" class="dropdown-item"  data-toggle="modal" onclick="define_delete(<?= $rows->eleves_scolarite_id ?>, 'eleves_scolarite_id')"><i class="dropdown-icon mdi mdi-cash-refund"></i> Octroyer réduction </a>
                                                       <?php else: ?>
                                                            <a href="#custom-show-reduction-modal-<?=@$rows->eleve_id?>" class="dropdown-item" data-toggle="modal"><i class="dropdown-icon mdi mdi-cash-refund"></i> Supprimer réduction </a>
                                                       <?php endif; ?>
                                                       <!-- <a href="#custom-comment-modal" class="dropdown-item"  data-toggle="modal" onclick="define_edit(<?= $rows->eleve_id ?>, '<?= $module_base ?>showCustom')"><i class="dropdown-icon mdi mdi-comment-account"></i> Commentaires </a> -->
                                                       <!-- <a href="#custom-update-modal" class="dropdown-item" data-toggle="modal" onclick="define_edit(<?= $rows->eleve_id ?>, 'settings/settings_matiere/showEdit')"><i class="dropdown-icon mdi mdi-square-edit-outline"></i> Modifier </a> -->
                                                       <div class="dropdown-divider"></div>
                                                       <a href="#custom-delete-modal" class="dropdown-item" data-toggle="modal" onclick="define_delete(<?= $rows->eleves_scolarite_id ?>, 'eleves_scolarite_id')"><i class="dropdown-icon mdi mdi-trash-can-outline"></i> Supprimer </a>
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

<div id="custom-comment-modal" class="modal fade bs-example-modal-center show" tabindex="-1" settings_matiere="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Ajouter commentaire</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url('settings/settings_matiere/update'); ?>" method="post">
                         <div class="col-10 col-md-12">
                              <div class="form-group mb-3">
                                   <label>Elève</label>
                                   <input type="text" class="form-control" id="nom_complet" readonly>
                              </div>
                              <div class="form-group mb-3">
                                   <label>Description</label>
                                   <textarea class="form-control" placeholder="Description" name="eleve_scolarite_comment_desc" rows="3" cols="80" required></textarea>
                              </div>
                              <hr>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" class="form-control" name="eleves_scolarite_id" id="eleves_scolarite_id" required>
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-warning col-md-4">Modifier</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<?php if(is_array(@$datagrid)):?>
     <?php foreach(@$datagrid as $rows):?>
          <?php if ($rows->reduction != null): ?>
               <div id="custom-show-reduction-modal-<?=@$rows->eleve_id?>" class="modal fade bs-example-modal-center show" tabindex="-1" settings_matiere="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
                    <div class="modal-dialog modal-dialog-centered">
                         <div class="modal-content">
                              <div class="modal-header">
                                   <h4 class="modal-title" id="myCenterModalLabel">Réduction élève</h4>
                                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                              </div>
                              <div class="modal-body">
                                   <div class="row justify-content-center">
                                        <div class="col-10 col-md-12 text-center">

                                             <h3>Valeur</h3>
                                             <br>
                                             <h2 class="text-danger"> <?= thousand($rows->reduction->eleves_reduction_value)  ?> </h2>

                                             <div class="modal-footer mt-3">
                                                  <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                                  <a href="#custom-delete-reduction-modal" class="btn btn-danger col-md-4"  data-toggle="modal" onclick="define_delete(<?= $rows->eleves_scolarite_id ?>, 'eleves_scolarite_id')"><i class="dropdown-icon mdi mdi-cash-refund"></i> Supprimer </a>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
               </div>
          <?php endif; ?>
     <?php endforeach;?>
<?php endif;?>


<div id="custom-reduction-modal" class="modal fade bs-example-modal-center show" tabindex="-1" settings_matiere="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Réduction élève</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base."insert_reduction"); ?>" method="post">
                         <div class="col-10 col-md-12">

                              <div class="alert alert-warning fade show mb-3">
                                   <button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true">×</button>
                                   <h4>Note !</h4>
                                   <p>Attention, vous êtes sur le point d'appliquer une réduction mensuelle pour cet élève. La somme renseignée sera déduite du montant dû dans chacune de ces factures.</p>
                              </div>

                              <div class="form-group mb-3">
                                   <label>Réduction mensuelle</label>
                                   <input type="text" class="form-control" placeholder="Valeur" name="eleves_reduction_value" id="eleves_reduction_value" required>
                              </div>

                              <div class="modal-footer mt-3">
                                   <input type="hidden" class="form-control" name="eleves_scolarite_id" required>
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-success col-md-4">Enregistrer</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<div id="custom-delete-reduction-modal" class="modal fade bs-example-modal-center show" tabindex="-1" settings_matiere="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Supprimer reduction</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base."delete_reduction"); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 ">
                              <p style="text-align: center; font-size: 14px;">
                                   La réduction pour cet élève va supprimer de manière permanante. <br>
                                   Voulez-vous continuer cette opérations ?
                              </p>
                              <hr>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" type="text" name="eleves_reduction_id" value="<?=@$eleves_reduction_id?>">
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-danger col-md-4">Supprimer</button>
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
