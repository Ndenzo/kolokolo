
<style media="screen">
td{
     vertical-align: middle!important;
}
</style>
<div class="row">
     <div class="col-xl-4">
          <a href="#custom-modal" class="btn btn-success btn-md waves-effect waves-light mb-3" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a"><i class="mdi mdi-plus-circle-outline"> </i> Ajouter bon de décaissement</a>
     </div>
</div>
<?php show_notification();?>
<div class="row mt-2">
     <div class="col-12">
          <div class="card">
               <h4 class="mt-0 card-header">Liste des decaissements</h4>
               <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap">
                    <thead>
                         <tr>
                              <th>Decaissement</th>
                              <th>Date</th>
                              <th>Montant</th>
                              <th>Statuts</th>
                              <th class="justify-content-center" style="width: 100px;">Opérations</th>
                         </tr>
                    </thead>
                    <tbody>
                         <?php if(is_array(@$datagrid)):?>
                              <?php foreach(@$datagrid as $rows):?>
                                   <tr >
                                        <td><?=@$rows->decaissement_bon_num?></td>
                                        <td><?=gmdate("d-m-Y H:i", @$rows->decaissement_bon_added)?></td>
                                        <td><?=thousand(@$rows->montant_decaisser)."F CFA"?></td>
                                        <td><span class="badge badge-<?=@$rows->decaissement_bon_flag_class?>"><?=@$rows->decaissement_bon_flag_label?></span></td>
                                        <td style="text-align:center;">
                                             <div class="item-action dropdown">
                                                  <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions <i class="mdi mdi-chevron-down"></i></button>
                                                  <div class="dropdown-menu dropdown-menu-right">
                                                       <a href="#custom-detail-modal-<?= $rows->decaissement_bon_id ?>" class="dropdown-item" data-toggle="modal"><i class="dropdown-icon mdi mdi-credit-card-plus"></i> Détails </a>
                                                       <a href="<?php _url($module_base."showDecaissement/".$rows->decaissement_bon_id) ?>" class="dropdown-item" target="_blank"><i class="dropdown-icon mdi mdi-file-download"></i> Bon de décaissement </a>
                                                       <!-- <div class="dropdown-divider"></div> -->
                                                       <!-- <a href="#custom-delete-modal" class="dropdown-item" data-toggle="modal" onclick="define_delete(<?= $rows->decaissement_id ?>, 'decaissement_id')"><i class="dropdown-icon mdi mdi-trash-can-outline"></i> Supprimer </a> -->
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

<div id="custom-modal" class="modal-demo col-7">
     <button type="button" class="close" onclick="Custombox.modal.close();">
          <span>&times;</span><span class="sr-only">Close</span>
     </button>
     <h4 class="custom-modal-title">Ajouter decaissement</h4>
     <div class="custom-modal-text text-left" style="overflow-y: auto;">
          <form class="row justify-content-center" action="<?php _url($module_base.'insert'); ?>" method="post">
               <div class="col-10 col-md-12">
                    <div class="form-group mb-3 row">
                         <div class="col-7">
                              <label>Numéro</label>
                              <input type="text" class="form-control" placeholder="Numéro" name="decaissement_bon_num" value="<?= decaissement_code_generator() ?>" required readonly>
                         </div>
                         <div class="col-4">
                              <label>Nombre d'éléments</label>
                              <input type="number" class="form-control" placeholder="Nombre" name="nb_decaissement" id="nb_decaissement" min="0" required>
                         </div>
                    </div>

                    <hr>

                    <div class="form-group mb-3" id="decaissements">
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
<?php if(is_array(@$datagrid)):?>
     <?php foreach(@$datagrid as $rows):?>
          <div id="custom-detail-modal-<?= $rows->decaissement_bon_id ?>" class="modal fade bs-example-modal-center show" tabindex="-1" settings_decaissement="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
               <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                         <div class="modal-header">
                              <h4 class="modal-title" id="myCenterModalLabel">Détail du décaissement</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                         </div>
                         <div class="modal-body">
                              <table id="tarification_inscription" class="tablesaw table mb-0 tablesaw-columntoggle" data-tablesaw-mode="columntoggle" id="tablesaw-4030">
                                   <thead>
                                        <tr>
                                             <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority="persist" style="text-align:left;">Libelle</th>
                                             <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority="1" class="tablesaw-priority-1">Montant</th>
                                        </tr>
                                   </thead>
                                   <tbody>
                                        <?php if(is_array(@$rows->decaissements)):?>
                                             <?php foreach(@$rows->decaissements as $decaissement):?>
                                                  <tr>
                                                       <td style="text-align:left;"><?= @$decaissement->decaissement_libelle ?></td>
                                                       <td class="tablesaw-priority-1"><?= thousand(@$decaissement->decaissement_value) ?></td>
                                                  </tr>
                                             <?php endforeach;?>
                                        <?php endif;?>
                                   </tbody>
                              </table>
                              <div class="modal-footer mt-3">
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     <?php endforeach;?>
<?php endif;?>

<div id="custom-decaissement-modal" class="modal fade bs-example-modal-center show" tabindex="-1" settings_decaissement="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Encaisser decaissement</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'update'); ?>" method="post">
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
                                   <input type="number" class="form-control" placeholder="Montant" name="decaissement_value" id="decaissement_value" required>
                              </div>
                              <hr>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" type="text" name="decaissement_id" value="<?=@$decaissement_id?>" required>
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-warning col-md-4">Modifier</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<div id="custom-delete-modal" class="modal fade bs-example-modal-center show" tabindex="-1" settings_decaissement="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Supprimer decaissement</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'delete'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 ">
                              <p style="text-align: center; font-size: 14px;">
                                   Le decaissement sélectionner va être supprimer de manière permanante. <br>
                                   Voulez-vous continuer cette opérations ?
                              </p>
                              <hr>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" type="text" name="decaissement_id" value="<?=@$decaissement_id?>">
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-danger col-md-4">Supprimer</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>
