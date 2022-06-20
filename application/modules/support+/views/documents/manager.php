<div class="row">
     <div class="col-xl-4">
          <a href="#custom-modal" class="btn btn-success btn-md waves-effect waves-light mb-3" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a"><i class="mdi mdi-plus-circle-outline"> </i> Ajouter document</a>
     </div><!-- end col -->
</div>
<?php show_notification();?>

<div class="row mt-1">
     <?php if(is_array(@$datagrid)):?>
          <?php foreach(@$datagrid as $rows):?>
               <div class="col-lg-3" >
                    <div class="card">
                         <div class="row">
                              <img src="<?php _url(); ?>assets/custom/png/pdf.png" class="rounded avatar-xl img-thumbnail mb-2 ml-auto mr-auto"  style="box-shadow: 10px 0px 10px;">
                              <div class="col-12 ml-auto mr-auto text-center mt-3 mb-3">
                                   <h4><?=@$rows->document_name?></h4>
                              </div>
                              <div class="item-action dropdown col-8 mr-auto ml-auto">
                                   <button class="btn btn-secondary btn-sm dropdown-toggle form-control" data-toggle="dropdown">Actions <i class="mdi mdi-chevron-down"></i></button>
                                   <div class="dropdown-menu dropdown-menu-right">
                                        <a href="<?php _url(@$rows->document_link) ?>" class="dropdown-item" target="_blank"><i class="dropdown-icon mdi mdi-file-download"></i> Télécharger </a>
                                        <a href="#custom-delete-modal" class="dropdown-item" data-toggle="modal" onclick="define_delete(<?= $rows->document_id ?>, 'document_id')"><i class="dropdown-icon mdi mdi-trash-can-outline"></i> Supprimer </a>
                                   </div>
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
     <h4 class="custom-modal-title">Ajouter document</h4>
     <div class="custom-modal-text text-left">
          <form class="row justify-content-center" action="<?php _url('document/document/insert'); ?>" method="post" enctype="multipart/form-data">
               <div class="col-10 col-md-12">

                    <div class="form-group mb-3">
                         <label>Importer</label>
                         <input type="file" class="dropify" data-default-file="<?php _url(); ?>assets/custom/png/pdf.png" name="document_link"/>
                    </div>

                    <div class="form-group mb-3">
                         <label>Nom du document</label>
                         <input type="text" class="form-control" placeholder="document" name="document_name" required>
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

<div id="custom-delete-modal" class="modal fade bs-example-modal-center show" tabindex="-1" settings_cycle="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Supprimer cycle</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url('document/document/delete'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 mt-50">
                              <p style="text-align: center; font-size: 14px;">
                                   La document sélectionnée va être supprimer de manière permanante. <br>
                                   Voulez-vous continuer cette opérations ?
                              </p>
                              <hr>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" type="text" name="document_id" value="<?=@$document_id?>">
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-danger col-md-4">Supprimer</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>
