<style media="screen">
     td{
          vertical-align: middle!important;
     }
</style>
<div class="row">
     <div class="col-xl-4">
          <a href="#custom-modal" class="btn btn-success btn-md waves-effect waves-light mb-3" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a"><i class="mdi mdi-plus-circle-outline"> </i> Ajouter mode de paiement</a>
     </div><!-- end col -->
</div>
<?php show_notification();?>
<div class="row mt-1">
     <div class="col-12">
          <div class="card-box">
               <h4 class="mt-0 header-title">Liste des mode de paiementss</h4>
               <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap">
                    <thead>
                         <tr>
                              <th></th>
                              <th style="width: 200px;">code</th>
                              <th>libelle</th>
                              <th style="width: 200px;">justificatif</th>
                              <th class="justify-content-center" style="width: 100px;">Opérations</th>
                         </tr>
                    </thead>
                    <tbody>
                         <?php if(is_array(@$datagrid)):?>
                              <?php foreach(@$datagrid as $rows):?>
                                   <tr>
                                        <?php if($rows->settings_mode_paiement_photo != null):?>
                                             <td><div class="rounded avatar-xl ml-auto mr-auto" style="height: 50px; width: 50px; box-shadow: 10px 10px 10px; background-image: url('<?= _url($rows->settings_mode_paiement_photo) ?>'); background-size: cover; background-repeat: no-repeat; background-position: center;"></div></td>
                                        <?php else:?>
                                             <td><img  class="rounded avatar-xl img-thumbnail" alt="profile-image"></td>
                                        <?php endif;?>
                                        <td><?=@$rows->settings_mode_paiement_code?></td>
                                        <td><?=@$rows->settings_mode_paiement_name?></td>
                                        <td>
                                             <?php if (@$rows->settings_mode_paiement_verif == 0): ?>
                                                  <span class="badge badge-warning">Non</span>
                                             <?php else: ?>
                                                  <span class="badge badge-success">Oui</span>
                                             <?php endif; ?>
                                        </td>
                                        <td style="text-align:center;">
                                             <div class="item-action dropdown">
                                                  <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions <i class="mdi mdi-chevron-down"></i></button>
                                                  <div class="dropdown-menu dropdown-menu-right">
                                                       <!-- <a href="#custom-update-modal" class="dropdown-item" data-toggle="modal" onclick="define_edit(<?= $rows->settings_mode_paiement_id ?>, 'settings/settings_mode_paiement/showEdit')"><i class="dropdown-icon mdi mdi-square-edit-outline"></i> Modifier </a> -->
                                                       <!-- <div class="dropdown-divider"></div> -->
                                                       <a href="#custom-delete-modal" class="dropdown-item" data-toggle="modal" onclick="define_delete(<?= $rows->settings_mode_paiement_id ?>, 'settings_mode_paiement_id')"><i class="dropdown-icon mdi mdi-trash-can-outline"></i> Supprimer </a>
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
     <h4 class="custom-modal-title">Ajouter mode de paiement</h4>
     <div class="custom-modal-text text-left">
          <form class="row justify-content-center" action="<?php _url('settings/settings_mode_paiement/insert'); ?>" method="post" enctype="multipart/form-data">
               <div class="col-10 col-md-12 mt-20">
                    <div class="col-4">
                         <div class="fileinput fileinput-new" data-provides="fileinput">
                              <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                   <img src="<?= _url(); ?>assets/back/png/photo.png" alt="">
                              </div>
                              <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                              <div>
                                   <span class="btn default btn-file">
                                        <span class="fileinput-new btn btn-info"> Parcourir </span>
                                        <span class="fileinput-exists btn btn-warning"> Changer </span>
                                        <input type="file" name="settings_mode_paiement_photo" required>
                                   </span>
                                   <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                              </div>
                         </div>
                    </div>
                    <div class="form-group mb-3">
                         <label>Code mode de paiement</label>
                         <input type="text" class="form-control" placeholder="Code" name="settings_mode_paiement_code" required>
                    </div>
                    <div class="form-group mb-3">
                         <label>Nom du mode de paiement</label>
                         <input type="text" class="form-control" placeholder="Nom" name="settings_mode_paiement_name" required>
                    </div>
                    <div class="form-group mb-3">
                         <label>Besoin de justificatif ? &nbsp;  <input type="checkbox" name="settings_mode_paiement_verif" data-plugin="switchery" value="true" data-color="#00b19d"/></label>
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

<div id="custom-update-modal" class="modal fade bs-example-modal-center show" tabindex="-1" settings_mode_paiement="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Modifier mode_paiement</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url('settings/settings_mode_paiement/update'); ?>" method="post">
                         <div class="col-10 col-md-12 mt-50">
                              <div class="col-4">
                                   <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                             <img src="<?= _url(); ?>assets/back/png/photo.png" alt="" id="settings_mode_paiement_photo">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                        <div>
                                             <span class="btn default btn-file">
                                                  <span class="fileinput-new btn btn-info"> Parcourir </span>
                                                  <span class="fileinput-exists btn btn-warning"> Changer </span>
                                                  <input type="file" name="settings_mode_paiement_photo" required>
                                             </span>
                                             <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                        </div>
                                   </div>
                              </div>
                              <div class="form-group mb-3">
                                   <label>Code mode de paiement</label>
                                   <input type="text" class="form-control" placeholder="Code" name="settings_mode_paiement_code" id="settings_mode_paiement_code" required>
                              </div>
                              <div class="form-group mb-3">
                                   <label>Nom du mode de paiement</label>
                                   <input type="text" class="form-control" placeholder="Nom" name="settings_mode_paiement_name" id="settings_mode_paiement_name" required>
                              </div>
                              <div class="form-group mb-3">
                                   <label>Besoin de justificatif ? &nbsp;  <input type="checkbox" class="js-switch" name="settings_mode_paiement_verif" id="settings_mode_paiement_verif" data-plugin="switchery" value="true" data-color="#00b19d"/></label>
                              </div>
                              <hr>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" class="form-control" name="settings_mode_paiement_id" id="settings_mode_paiement_id" required>
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-warning col-md-4">Modifier</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>


<div id="custom-delete-modal" class="modal fade bs-example-modal-center show" tabindex="-1" settings_mode_paiement="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Supprimer mode de paiement</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url('settings/settings_mode_paiement/delete'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 mt-50">
                              <p style="text-align: center; font-size: 14px;">
                                   Le mode de paiement sélectionner va être supprimer de manière permanante. <br>
                                   Voulez-vous continuer cette opérations ?
                              </p>
                              <hr>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" type="text" name="settings_mode_paiement_id" value="<?=@$settings_mode_paiement_id?>">
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-danger col-md-4">Supprimer</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>
