<div class="row">
     <div class="col-xl-4">
          <a href="#custom-modal" class="btn btn-success btn-md waves-effect waves-light mb-3" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a"><i class="mdi mdi-plus-circle-outline"> </i> Ajouter element </a>
     </div><!-- end col -->
</div>
<?php show_notification();?>
<div class="row">
     <?php if(is_array(@$tarifications)):?>
          <?php foreach(@$tarifications as $tarification):?>
               <div class="col-lg-4">
                    <div class="card taskboard-box">

                         <div class="dropdown float-right">
                              <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                   <i class="mdi mdi-dots-vertical"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right">
                                   <a href="#custom-update-modal" class="dropdown-item" data-toggle="modal" onclick="define_edit(<?= $tarification->tarification_id ?>, 'scolarite/tarification/showEdit')"><i class="dropdown-icon mdi mdi-square-edit-outline"></i> Modifier </a>
                                   <div class="dropdown-divider"></div>
                                   <a href="#custom-delete-modal" class="dropdown-item" data-toggle="modal" onclick="define_delete(<?= $tarification->tarification_id ?>, 'tarification_id')"><i class="dropdown-icon mdi mdi-trash-can-outline"></i> Supprimer </a>
                              </div>
                         </div>

                         <h4 class="card-header mt-0 mb-3 text-warning">
                              <div class="row">
                                   <div class="text-left col-8">
                                        <?= $tarification->tarification_name ?>
                                   </div>

                                   <div class="text-right col-4">
                                        <?= thousand($tarification->value) ?> F CFA
                                   </div>
                              </div>
                         </h4>

                         <div class="row">
                              <a href="#custom-modal-add-details<?= $tarification->tarification_id ?>" data-toggle="modal" class="btn btn-lighten-success waves-effect width-md waves-success ml-auto mr-auto">
                                   Ajouter détails <i class="mdi mdi-plus-circle-outline"></i>
                              </a>
                         </div>

                         <div id="custom-modal-add-details<?= $tarification->tarification_id ?>" class="modal fade bs-example-modal-center show" tabindex="-1" settings_matiere="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
                              <div class="modal-dialog modal-dialog-centered">
                                   <div class="modal-content">
                                        <div class="modal-header">
                                             <h4 class="modal-title" id="myCenterModalLabel">Ajouter détails</h4>
                                             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                             <form class="row justify-content-center" action="<?php _url($module_base.'insert_details'); ?>" method="post">
                                                  <div class="col-10 col-md-12 mt-20">
                                                       <div class="form-group mb-3">
                                                            <label>Nom de l'élément</label>
                                                            <input type="text" class="form-control" placeholder="Nom" name="tarification_detail_name" id="tarification_detail_name" required>
                                                       </div>
                                                       <div class="form-group mb-3">
                                                            <label>Valeur</label>
                                                            <input type="number" class="form-control" placeholder="valeur" name="tarification_detail_value"  min="1" required>
                                                       </div>
                                                       <hr>
                                                       <div class="modal-footer mt-3">
                                                            <input type="hidden" name="tarification_id" value="<?= $tarification->tarification_id ?>">
                                                            <input type="hidden" name="tarification_modele_id" value="<?= $_SESSION['scolarite']['modele_id'] ?>">
                                                            <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                                            <button type="submit" class="btn btn-success col-md-4">Ajouter</button>
                                                       </div>
                                                  </div>
                                             </form>
                                        </div>
                                   </div>
                              </div>
                         </div>

                         <div class="row">
                              <div class="col-12">
                                   <table class="table table-striped table-bordered mt-30">
                                        <?php if(is_array(@$tarification->details)):?>
                                             <?php foreach(@$tarification->details as $tarification_detail):?>
                                                  <tr >
                                                       <td style="vertical-align: middle;"><?= $tarification_detail->tarification_detail_name ?></td>
                                                       <td style="vertical-align: middle;"><?= thousand($tarification_detail->tarification_detail_value) ?> F CFA</td>
                                                       <td style="text-align:center;">
                                                            <div class="item-action dropdown">
                                                                 <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions <i class="mdi mdi-chevron-down"></i></button>
                                                                 <div class="dropdown-menu dropdown-menu-right">
                                                                      <!-- <a href="<?php _url($module_base.'showNiveau/'.$rows->eleve_id); ?>" class="dropdown-item"><i class="dropdown-icon fe mdi mdi-playlist-star"></i> Inscrire </a>
                                                                      <a href="#custom-update-modal" class="dropdown-item" data-toggle="modal" onclick="define_edit(<?= $rows->eleve_id ?>, 'settings/settings_matiere/showEdit')"><i class="dropdown-icon mdi mdi-square-edit-outline"></i> Modifier </a>
                                                                      <div class="dropdown-divider"></div> -->
                                                                      <a href="#custom-delete-detail-modal" class="dropdown-item" data-toggle="modal" onclick="define_delete(<?= $tarification_detail->tarification_detail_id ?>, 'tarification_detail_id')"><i class="dropdown-icon mdi mdi-trash-can-outline"></i> Supprimer </a>
                                                                 </div>
                                                            </div>
                                                       </td>
                                                  </tr>
                                             <?php endforeach;?>
                                        <?php endif;?>
                                   </table>
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
     <h4 class="custom-modal-title">Ajouter élément</h4>
     <div class="custom-modal-text text-left">
          <form class="row justify-content-center" action="<?php _url($module_base.'insert'); ?>" method="post">
               <div class="col-10 col-md-12 mt-20">
                    <div class="form-group mb-3">
                         <label>Nom de l'élément</label>
                         <input type="text" class="form-control" placeholder="Nom" name="tarification_name" required>
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


<div id="custom-update-modal" class="modal fade bs-example-modal-center show" tabindex="-1" settings_jour="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Modifier élément</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'update'); ?>" method="post">
                         <div class="col-10 col-md-12 mt-20">
                              <div class="form-group mb-3">
                                   <label>Nom de l'élément</label>
                                   <input type="text" class="form-control" placeholder="Nom" name="tarification_name" id="tarification_name" required>
                              </div>
                              <hr>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" class="form-control" name="tarification_id" id="tarification_id" required>
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
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
                    <h4 class="modal-title" id="myCenterModalLabel">Supprimer élément</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'delete'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 mt-20">
                              <p style="text-align: center; font-size: 14px;">
                                   Le jour sélectionner va être supprimer de manière permanante. <br>
                                   Voulez-vous continuer cette opérations ?
                              </p>
                              <hr>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" type="text" name="tarification_id" value="<?=@$tarification_id?>">
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-danger col-md-4">Supprimer</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<div id="custom-delete-detail-modal" class="modal fade bs-example-modal-center show" tabindex="-1" settings_jour="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Supprimer élément</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'delete_detail'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 mt-20">
                              <p style="text-align: center; font-size: 14px;">
                                   Le jour sélectionner va être supprimer de manière permanante. <br>
                                   Voulez-vous continuer cette opérations ?
                              </p>
                              <hr>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" type="text" name="tarification_detail_id" value="<?=@$tarification_detail_id?>">
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-danger col-md-4">Supprimer</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>


<script>
$(document).ready(function() {
     var availableTags = [
          <?php if(is_array(@$tarification_details)):?>
          <?php foreach(@$tarification_details as $tarification_detail):?>
          "<?=@$tarification_detail->tarification_detail_name?>",
          <?php endforeach;?>
          <?php endif;?>
     ];

     $("#tarification_detail_name").autocomplete({
          minLength: 12,
          source: availableTags
     });
} );
</script>
