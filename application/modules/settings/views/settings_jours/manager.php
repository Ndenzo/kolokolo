<div class="row">
     <div class="col-xl-4">
          <a href="#custom-modal" class="btn btn-success btn-md waves-effect waves-light mb-3" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a"><i class="mdi mdi-plus-circle-outline"> </i> Ajouter jour</a>
     </div><!-- end col -->
</div>
<?php show_notification();?>
<div class="row mt-1">
     <div class="col-12">
          <div class="card-box">
               <h4 class="mt-0 header-title">Liste des jours</h4>
               <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap">
                    <thead>
                         <tr>
                              <th style="width: 200px;">code</th>
                              <th style="width: 200px;">libelle</th>
                              <th class="justify-content-center" style="width: 100px;">Opérations</th>
                         </tr>
                    </thead>
                    <tbody>
                         <?php if(is_array(@$datagrid)):?>
                              <?php foreach(@$datagrid as $rows):?>
                                   <tr>
                                        <td><?=@$rows->settings_jour_code?></td>
                                        <td><?=@$rows->settings_jour_name?></td>
                                        <td style="text-align:center;">
                                             <div class="item-action dropdown">
                                                  <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions <i class="mdi mdi-chevron-down"></i></button>
                                                  <div class="dropdown-menu dropdown-menu-right">
                                                       <!-- <a href="<?php _url($module_base.'showNiveau/'.$rows->settings_jour_id); ?>" class="dropdown-item"><i class="dropdown-icon fe mdi mdi-playlist-star"></i> Détails </a> -->
                                                       <a href="#custom-update-modal" class="dropdown-item" data-toggle="modal" onclick="define_edit(<?= $rows->settings_jour_id ?>, 'settings/settings_jour/showEdit')"><i class="dropdown-icon mdi mdi-square-edit-outline"></i> Modifier </a>
                                                       <div class="dropdown-divider"></div>
                                                       <a href="#custom-delete-modal" class="dropdown-item" data-toggle="modal" onclick="define_delete(<?= $rows->settings_jour_id ?>, 'settings_jour_id')"><i class="dropdown-icon mdi mdi-trash-can-outline"></i> Supprimer </a>
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
          <span>&times;</span><span class="sr-only">Fermer</span>
     </button>
     <h4 class="custom-modal-title">Ajouter jour</h4>
     <div class="custom-modal-text text-left">
          <form class="row justify-content-center" action="<?php _url('settings/settings_jour/insert'); ?>" method="post">
               <div class="col-10 col-md-12 mt-50">
                    <div class="form-group mb-3">
                         <label>Code jour</label>
                         <input type="text" class="form-control" placeholder="Code" name="settings_jour_code" required>
                    </div>
                    <div class="form-group mb-3">
                         <label>Nom du jour</label>
                         <input type="text" class="form-control" placeholder="Nom" name="settings_jour_name" required>
                    </div>
                    <hr>
                    <div class="modal-footer mt-3">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                         <button type="submit" class="btn btn-success col-md-4">Ajouter</button>
                    </div>
               </div>
          </form>
     </div>
</div>

<div id="custom-update-modal" class="modal fade bs-example-modal-center show" tabindex="-1" settings_jour="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Modifier jour</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url('settings/settings_jour/update'); ?>" method="post">
                         <div class="col-10 col-md-12 mt-50">
                              <div class="form-group mb-3">
                                   <label>Code jour</label>
                                   <input type="text" class="form-control" placeholder="Code" name="settings_jour_code" id="settings_jour_code" required>
                              </div>
                              <div class="form-group mb-3">
                                   <label>Nom du jour</label>
                                   <input type="text" class="form-control" placeholder="Nom" name="settings_jour_name" id="settings_jour_name" required>
                              </div>
                              <hr>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" class="form-control" name="settings_jour_id" id="settings_jour_id" required>
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-warning col-md-4">Modifier</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>


<div id="custom-delete-modal" class="modal fade bs-example-modal-center show" tabindex="-1" settings_jour="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Supprimer jour</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url('settings/settings_jour/delete'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 mt-50">
                              <p style="text-align: center; font-size: 14px;">
                                   Le jour sélectionner va être supprimer de manière permanante. <br>
                                   Voulez-vous continuer cette opérations ?
                              </p>
                              <hr>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" type="text" name="settings_jour_id" value="<?=@$settings_jour_id?>">
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-danger col-md-4">Supprimer</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>
