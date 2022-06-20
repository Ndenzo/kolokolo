
<style media="screen">
td{
     vertical-align: middle!important;
}
</style>
<div class="row">
     <div class="col-xl-4 mb-3">
          <button class="btn btn-success btn-md waves-effect waves-light dropdown-toggle" data-toggle="dropdown"> Ajouter facture <i class="mdi mdi-chevron-down"></i></button>
          <div class="dropdown-menu dropdown-menu">
               <a href="#custom-individuel-modal" class="dropdown-item"  data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a"><i class="dropdown-icon mdi mdi-file-document-box-outline"></i> Facture individuel </a>
               <a href="#custom-groupe-modal" class="dropdown-item"  data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a"><i class="dropdown-icon mdi mdi-file-document-outline"></i> Facture groupée </a>
          </div>
     </div>
</div>
<?php show_notification();?>
<div class="row">
     <div class="col-12">
          <div class="card">
               <div class="dropdown float-right" style="margin-top: -15px;">
                    <a href="#custom-search-modal" class="btn btn-info" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a">
                         Rechercher <i class="mdi mdi-briefcase-search-outline"></i>
                    </a>
               </div>
               <h4 class="mt-0 card-header">Liste des Factures</h4>
               <hr>
               <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap">
                    <thead>
                         <tr>
                              <th>ID</th>
                              <th>Numero</th>
                              <th>Date</th>
                              <!-- <th>Classe</th> -->
                              <th>Destinataire</th>
                              <th>Montant</th>
                              <th>Encaisser</th>
                              <th>A encaisser</th>
                              <th>Statuts</th>
                              <th class="justify-content-center" style="width: 100px;">Opérations</th>
                         </tr>
                    </thead>
                    <tbody id="facture_list">
                         <?php if(is_array(@$datagrid)):?>
                              <?php foreach(@$datagrid as $rows):?>
                                   <tr >
                                        <td><?=@$rows->facture_id?></td>
                                        <td><?=@$rows->facture_num?></td>
                                        <td><?=gmdate("d-m-Y H:i", @$rows->facture_added)?></td>
                                        <!-- <td><?=@$rows->classe_name?></td> -->
                                        <td><?=@$rows->eleve_matricule?></td>
                                        <td><?=thousand(@$rows->montant - @$rows->facture_remise)?></td>
                                        <td><?=thousand(@$rows->encaissement)?></td>
                                        <td><?=thousand(@$rows->montant - @$rows->encaissement - @$rows->facture_remise)?></td>
                                        <td><span class="badge badge-<?=@$rows->facture_flag_class?>"><?=@$rows->facture_flag_label?></span></td>
                                        <td style="text-align:center;">
                                             <div class="item-action dropdown">
                                                  <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions <i class="mdi mdi-chevron-down"></i></button>
                                                  <div class="dropdown-menu dropdown-menu-right">
                                                       <a href="<?php _url($module_base."showFacture/".$rows->facture_id) ?>" class="dropdown-item" target="_blank"><i class="dropdown-icon mdi mdi-file-download"></i> Facture </a>
                                                       <a href="<?php _url($module_base."showQuittance/".$rows->facture_id) ?>" class="dropdown-item" target="_blank"><i class="dropdown-icon mdi mdi-file-download"></i> Reçu de paiement </a>

                                                       <?php if (@$rows->facture_flag_code != "reg"): ?>
                                                            <a href="#custom-encaissement-modal" class="dropdown-item" data-toggle="modal" onclick="define_custom(<?= $rows->facture_id ?>, 'facture_id', <?= @$rows->montant - @$rows->encaissement - @$rows->facture_remise ?>)"><i class="dropdown-icon mdi mdi-credit-card-plus"></i> Encaisser </a>
                                                       <?php endif; ?>
                                                       <!-- <a href="#custom-update-modal" class="dropdown-item" data-toggle="modal" onclick="define_edit(<?= $rows->facture_id ?>, $module_base.'showEdit')"><i class="dropdown-icon mdi mdi-square-edit-outline"></i> Modifier </a> -->
                                                       <div class="dropdown-divider"></div>
                                                       <a href="#custom-delete-modal" class="dropdown-item" data-toggle="modal" onclick="define_delete(<?= $rows->facture_id ?>, 'facture_id')"><i class="dropdown-icon mdi mdi-trash-can-outline"></i> Supprimer </a>
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
     <h4 class="custom-modal-title">Ajouter facture</h4>
     <div class="custom-modal-text text-left">
          <form class="row justify-content-center" action="<?php _url($module_base.'insert'); ?>" method="post">
               <div class="col-10 col-md-12">
                    <div class="form-group mb-3">
                         <label>Code facture</label>
                         <input type="text" class="form-control" placeholder="Code" name="settings_facture_code" required>
                    </div>
                    <div class="form-group mb-3">
                         <label>Cycle</label>

                    </div>
                    <div class="form-group mb-3">
                         <label>Nom du facture</label>
                         <input type="text" class="form-control" placeholder="Nom" name="settings_facture_name" required>
                    </div>
                    <div class="form-group mb-3">
                         <label>Description</label>
                         <textarea class="form-control" placeholder="Description" name="settings_facture_desc" rows="3" cols="80" required></textarea>
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

<div id="custom-encaissement-modal" class="modal fade bs-example-modal-center show" tabindex="-1" settings_facture="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Encaisser facture</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form id="form_encaissement" class="row justify-content-center" action="<?php _url($module_base.'insert_encaissement'); ?>" method="post">
                         <div class="col-10 col-md-12">
                              <div class="form-group mb-3">
                                   <label>Mode de paiement</label>
                                   <?php
                                   dropDown("select settings_mode_paiement_id, settings_mode_paiement_name FROM settings_mode_paiements", array(
                                        'id'=>'settings_mode_paiement_id',
                                        'name'=>'settings_mode_paiement_id',
                                        'class'=>'form-control selectpicker',
                                        'attr'=>'title ="-- Choose --"  data-size="7" data-live-search="true" required'
                                   )); ?>
                              </div>
                              <div id="to_justif">
                              </div>
                              <div class="form-group mb-3">
                                   <label>Montant</label>
                                   <input type="number" class="form-control" placeholder="Montant" name="encaissement_value" id="encaissement_value" min="0"  required>
                              </div>
                              <hr>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" type="text" name="facture_id" value="<?=@$facture_id?>" required>
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-success col-md-4">Encaisser</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<div id="custom-update-modal" class="modal fade bs-example-modal-center show" tabindex="-1" settings_facture="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Modifier facture</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'update'); ?>" method="post">
                         <div class="col-10 col-md-12">
                              <div class="form-group mb-3">
                                   <label>Code facture</label>
                                   <input type="text" class="form-control" placeholder="Code" name="settings_facture_code" id="settings_facture_code" required>
                              </div>
                              <div class="form-group mb-3">
                                   <label>Cycle</label>

                              </div>
                              <div class="form-group mb-3">
                                   <label>Nom du facture</label>
                                   <input type="text" class="form-control" placeholder="Nom" name="settings_facture_name" id="settings_facture_name" required>
                              </div>
                              <div class="form-group mb-3">
                                   <label>Description</label>
                                   <textarea class="form-control" placeholder="Description" name="settings_facture_desc" id="settings_facture_desc" rows="3" cols="80" required></textarea>
                              </div>
                              <hr>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" class="form-control" name="facture_id" id="facture_id" required>
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-warning col-md-4">Modifier</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div>
     </div>
</div>


<div id="custom-individuel-modal" class="modal-demo col-5">
     <button type="button" class="close" onclick="Custombox.modal.close();">
          <span>&times;</span><span class="sr-only">Close</span>
     </button>
     <h4 class="custom-modal-title">Facture individuel</h4>
     <div class="custom-modal-text text-left">
          <form id="form_individual_facture" class="row justify-content-center" action="<?php _url($module_base.'insert_individual'); ?>" target="_blank" method="post">
               <div class="col-12 col-md-12">
                    <div class="form-group mb-3">
                         <label>Matricule</label>
                         <div class="row">
                              <div class="col-8">
                                   <input type="text" class="form-control" placeholder="Le matricule de l'élève" name="eleve_matricule" id="eleve_matricule" required>
                                   <input type="hidden" name="settings_scolarite_id" value="<?= $_SESSION['dashboard']['settings_scolarite_id'] ?>" required>
                              </div>
                              <div class="col-4">
                                   <button class="btn btn-info form-control" type="button" id="matricule_checker">Rechercher</button>
                              </div>
                         </div>
                    </div>


                    <div class="form-group mb-3">
                         <label>Eléments de facturation</label>
                         <div class="row">
                              <div class="col-6">
                                   <div id="facturation_tarification_detail_id">
                                        -- Entrez le matricule de l'élève --
                                   </div>
                              </div>

                              <div class="col-6">
                                   <div style="margin-top:10%;">

                                        <div id="montant_total"></div>

                                        <div class="form-group">
                                             <label>Réduction mensuelle</label>
                                             <input type="number" class="form-control" placeholder="Montant" name="facturation_remise" id="facturation_remise" min="0" value="0" required>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>

                    <hr>
                    <div class="modal-footer mt-3">
                         <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                         <button type="submit" class="btn btn-success col-md-4"  onclick="setTimeout(function(){ window.location.reload(); }, 500)">Enregistrer</button>
                    </div>
               </div>
          </form>
     </div>
</div>

<div id="custom-groupe-modal" class="modal-demo col-4">
     <button type="button" class="close" onclick="Custombox.modal.close();">
          <span>&times;</span><span class="sr-only">Close</span>
     </button>
     <h4 class="custom-modal-title">Facture groupé</h4>
     <div class="custom-modal-text text-left">
          <form id="form_group_facture" class="row justify-content-center" action="<?php _url($module_base.'insert_grouped'); ?>" target="_blank" method="post">
               <div class="col-12 col-md-12">
                    <div class="form-group mb-3">
                         <label>Classe</label>
                         <?php dropDown('SELECT classe_id, classe_name FROM classes order by classe_id', array(
                              'id'=>'classe_id',
                              'name'=>'classe_id',
                              'class'=>'form-control selectpicker',
                              'attr'=>'title ="-- Choose --"  data-size="5" data-live-search="true" required'
                         )); ?>
                    </div>

                    <div class="form-group mb-3">
                         <label>Eléments de facturation</label>
                         <?php dropDown('SELECT tarification_details.tarification_detail_id, tarification_details.tarification_detail_name FROM tarification_details JOIN tarifications ON tarifications.tarification_id = tarification_details.tarification_id WHERE tarifications.tarification_code = "men" group by tarification_detail_name order by tarification_detail_id ', array(
                              'id'=>'tarification_detail_id',
                              'name'=>'tarification_detail_id',
                              'class'=>'form-control selectpicker',
                              'attr'=>'title ="-- Choose --"  data-size="5" data-live-search="true" required'
                         ));
                         ?>
                    </div>

                    <hr>
                    <div class="modal-footer mt-5">
                         <input type="hidden" name="settings_scolarite_id" value="<?= $_SESSION['dashboard']['settings_scolarite_id'] ?>" required>
                         <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                         <button type="submit" class="btn btn-success col-md-4"  onclick="setTimeout(function(){ window.location.reload(); }, 500)">Enregistrer</button>
                    </div>
               </div>
          </form>
     </div>
</div>

<div id="custom-search-modal" class="modal-demo col-4">
     <button type="button" class="close" onclick="Custombox.modal.close();">
          <span>&times;</span><span class="sr-only">Close</span>
     </button>
     <h4 class="custom-modal-title">Rechercher facture</h4>
     <div class="custom-modal-text text-left">
          <form id="search_form_facture" class="row justify-content-center" method="post">
               <div class="col-10 ">
                    <div class="form-group">
                         <label for="search_element">Rechercher :</label>
                         <input type="text" name="search_element" required placeholder="Element à rechercher" class="form-control" id="search_element">
                    </div>

                    <div class="form-group mt-3">
                         <label for="facturation_element text-primary">Recherche par : </label>
                         <div class="mt-1">
                              <div class="custom-control custom-radio">
                                   <input type="radio" id="customRadio1" name="search_option" class="custom-control-input" value="1" required>
                                   <label class="custom-control-label" for="customRadio1">Numéro facture</label>
                              </div>
                              <div class="custom-control custom-radio">
                                   <input type="radio" id="customRadio2" name="search_option" class="custom-control-input" value="2" required>
                                   <label class="custom-control-label" for="customRadio2">Matricule élève</label>
                              </div>
                         </div>
                    </div>

                    <hr>
                    <div class="modal-footer mt-2">
                         <button class="btn btn-info waves-effect waves-light mr-1 form-control" id="searcher" onclick="Custombox.modal.close();">
                              Rechercher
                         </button>
                    </div>
               </div>
          </form>
     </div>
</div>

<div id="custom-delete-modal" class="modal fade bs-example-modal-center show" tabindex="-1" settings_facture="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Supprimer facture</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'delete'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 ">
                              <p style="text-align: center; font-size: 14px;">
                                   Le facture sélectionner va être supprimer de manière permanante. <br>
                                   Voulez-vous continuer cette opérations ?
                              </p>
                              <hr>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" type="text" name="facture_id" value="<?=@$facture_id?>">
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-danger col-md-4">Supprimer</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>
