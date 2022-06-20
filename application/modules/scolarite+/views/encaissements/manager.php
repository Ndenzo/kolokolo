
<style media="screen">
td{
     vertical-align: middle!important;
}
</style>
<!-- <div class="row">
<div class="col-xl-4">
<a href="#custom-modal" class="btn btn-success btn-md waves-effect waves-light mb-3" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a"><i class="mdi mdi-plus-circle-outline"> </i> Ajouter encaissement</a>
</div>
</div> -->
<?php show_notification();?>
<div class="row mt-5">
     <div class="col-12">
          <div class="card">
               <h4 class="mt-0 card-header">Liste des encaissements</h4>
               <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap">
                    <thead>
                         <tr>
                              <th>ID</th>
                              <th>Date</th>
                              <th>Facture</th>
                              <th>Montant</th>
                              <th>Mode de paiement</th>
                              <th>Justificatif</th>
                              <!-- <th class="justify-content-center" style="width: 100px;">Opérations</th> -->
                         </tr>
                    </thead>
                    <tbody>
                         <?php if(is_array(@$datagrid)):?>
                              <?php foreach(@$datagrid as $rows):?>
                                   <tr >
                                        <td><?=@$rows->encaissement_id?></td>
                                        <td><?=gmdate("d-m-Y H:i", @$rows->encaissement_added)?></td>
                                        <td><?=@$rows->facture_num?></td>
                                        <td><?=thousand(@$rows->encaissement_value)?></td>
                                        <td><?=@$rows->settings_mode_paiement_name?></td>
                                        <td><?=@$rows->encaissement_detail?></td>
                                        <!-- <td style="text-align:center;">
                                             <div class="item-action dropdown">
                                                  <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions <i class="mdi mdi-chevron-down"></i></button>
                                                  <div class="dropdown-menu dropdown-menu-right">
                                                       <a href="#custom-encaissement-modal" class="dropdown-item" data-toggle="modal"><i class="dropdown-icon mdi mdi-credit-card-plus"></i> Encaisser </a>
                                                       <a href="#custom-update-modal" class="dropdown-item" data-toggle="modal" onclick="define_edit(<?= $rows->encaissement_id ?>, $module_base.'showEdit')"><i class="dropdown-icon mdi mdi-square-edit-outline"></i> Modifier </a>
                                                       <div class="dropdown-divider"></div>
                                                       <a href="#custom-delete-modal" class="dropdown-item" data-toggle="modal" onclick="define_delete(<?= $rows->encaissement_id ?>, 'encaissement_id')"><i class="dropdown-icon mdi mdi-trash-can-outline"></i> Supprimer </a>
                                                  </div>
                                             </div>
                                        </td> -->
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
     <h4 class="custom-modal-title">Ajouter encaissement</h4>
     <div class="custom-modal-text text-left">
          <form class="row justify-content-center" action="<?php _url($module_base.'insert'); ?>" method="post">
               <div class="col-10 col-md-12">
                    <div class="form-group mb-3">
                         <label>Code encaissement</label>
                         <input type="text" class="form-control" placeholder="Code" name="settings_encaissement_code" required>
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
                         <label>Nom du encaissement</label>
                         <input type="text" class="form-control" placeholder="Nom" name="settings_encaissement_name" required>
                    </div>
                    <div class="form-group mb-3">
                         <label>Description</label>
                         <textarea class="form-control" placeholder="Description" name="settings_encaissement_desc" rows="3" cols="80" required></textarea>
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

<div id="custom-encaissement-modal" class="modal fade bs-example-modal-center show" tabindex="-1" settings_encaissement="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Encaisser encaissement</h4>
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
                                   <input type="number" class="form-control" placeholder="Montant" name="encaissement_value" id="encaissement_value" required>
                              </div>
                              <hr>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" type="text" name="encaissement_id" value="<?=@$encaissement_id?>" required>
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-warning col-md-4">Modifier</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<div id="custom-update-modal" class="modal fade bs-example-modal-center show" tabindex="-1" settings_encaissement="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Modifier encaissement</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'update'); ?>" method="post">
                         <div class="col-10 col-md-12">
                              <div class="form-group mb-3">
                                   <label>Code encaissement</label>
                                   <input type="text" class="form-control" placeholder="Code" name="settings_encaissement_code" id="settings_encaissement_code" required>
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
                                   <label>Nom du encaissement</label>
                                   <input type="text" class="form-control" placeholder="Nom" name="settings_encaissement_name" id="settings_encaissement_name" required>
                              </div>
                              <div class="form-group mb-3">
                                   <label>Description</label>
                                   <textarea class="form-control" placeholder="Description" name="settings_encaissement_desc" id="settings_encaissement_desc" rows="3" cols="80" required></textarea>
                              </div>
                              <hr>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" class="form-control" name="encaissement_id" id="encaissement_id" required>
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-warning col-md-4">Modifier</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<div id="custom-delete-modal" class="modal fade bs-example-modal-center show" tabindex="-1" settings_encaissement="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Supprimer encaissement</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'delete'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 ">
                              <p style="text-align: center; font-size: 14px;">
                                   Le encaissement sélectionner va être supprimer de manière permanante. <br>
                                   Voulez-vous continuer cette opérations ?
                              </p>
                              <hr>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" type="text" name="encaissement_id" value="<?=@$encaissement_id?>">
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-danger col-md-4">Supprimer</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>
