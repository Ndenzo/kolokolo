
<div class="col-md-12 project-list">
     <div class="card">
          <div class="row">
               <div class="col-md-6"></div>
               <div class="col-md-6">
                    <a href="#custom-modal"  class="btn btn-success f-right btn-lg" data-toggle="modal"><i class="fa fa-plus"> </i> New Element </a>
               </div>
          </div>
     </div>
</div>

<?php show_notification();?>

<div class="row">
     <?php if(is_array(@$tarifications)):?>
          <?php foreach(@$tarifications as $tarification):?>
               <div class="col-lg-4">
                    <div class="card card-absolute ribbon-wrapper-right card">
                         <div class="card-header bg-primary">
                              <h5 class="text-white"><?= $tarification->tarification_name ?></h5>
                         </div>
                         <div class="card-body">
                              <div class="ribbon ribbon-clip-right ribbon-right ribbon-warning"> <?= thousand($tarification->value) ?> F CFA</div>
                              <div class="row">
                                   <div class="f-left" style="margin-top: -20px;">
                                        <a href="#custom-modal-add-details<?= $tarification->tarification_id ?>" class="btn btn-pill btn-outline-success option-sm-btn" data-toggle="modal" ><i class="fa fa-plus"></i></a>
                                        <a href="#custom-update-modal" class="btn btn-pill btn-outline-warning option-sm-btn" data-toggle="modal" onclick="define_edit(<?= $tarification->tarification_id ?>, 'pricing/showEdit')"><i  class="fa fa-edit"></i></a>
                                        <a href="#custom-delete-modal" class="btn btn-pill btn-outline-danger option-sm-btn" data-toggle="modal" onclick="define_delete(<?= $tarification->tarification_id ?>, 'tarification_id')"><i class="fa fa-trash"></i></a>
                                   </div>
                              </div>

                              <div class="row">
                                   <div class="col-12">
                                        <table class="table table-striped table-bordered mt-30">
                                             <?php if(is_array(@$tarification->details)):?>
                                                  <?php foreach(@$tarification->details as $tarification_detail):?>
                                                       <tr >
                                                            <td class="txt-left" style="vertical-align: middle;"><?= $tarification_detail->tarification_detail_name ?></td>
                                                            <td style="vertical-align: middle;"><?= thousand($tarification_detail->tarification_detail_value) ?> F CFA</td>
                                                            <td style="text-align:center;">
                                                                 <a href="#custom-delete-detail-modal" class="btn btn-outline-danger option-sm-btn" data-toggle="modal" onclick="define_delete(<?= $tarification_detail->tarification_detail_id ?>, 'tarification_detail_id')"><i class="fa fa-trash"></i></a>
                                                            </td>
                                                       </tr>
                                                  <?php endforeach;?>
                                             <?php endif;?>
                                        </table>
                                   </div>
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
                    <h4 class="modal-title" id="myCenterModalLabel">Add Element</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'insert'); ?>" method="post">
                         <div class="col-10 col-md-12 mt-20">
                              <div class="form-group mb-3">
                                   <label>Nom de l'élément</label>
                                   <input type="text" class="form-control" placeholder="Nom" name="tarification_name" required>
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



<div id="custom-update-modal" class="modal fade bs-example-modal-center show" tabindex="-1" settings_jour="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Modifier élément</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'update'); ?>" method="post">
                         <div class="col-10 col-md-12">
                              <div class="form-group mb-3">
                                   <label>Nom de l'élément</label>
                                   <input type="text" class="form-control" placeholder="Nom" name="tarification_name" id="tarification_name" required>
                              </div>

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
          minLength: 3,
          source: availableTags
     });
} );
</script>
