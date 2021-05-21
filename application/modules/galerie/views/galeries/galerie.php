<div class="panel-header panel-header-sm"></div>

<div class="container">
     <div class="row">

          <div class="col-md-10 ml-auto mr-auto">
               <div class="card">
                    <div class="card-title">
                         <h5 class="title">Gérer les photos</h5>
                         <?php // include_once('desc.php'); ?>
                    </div>
                    <div class="card-body all-icons">
                         <form action="<?php _url($module_base.'upload_images/'.@$galerie_id); ?>" class="dropzone dropzone-file-area" id="my-dropzone" style="text-align: center;">
                              <h3 class="sbold">Importez vos images</h3>
                              <p> Les formats acceptées sont : <strong>png</strong>, <strong>jpg</strong>, <strong>jpeg</strong>, <strong>gif</strong>.</p>
                         </form>

                         <div class="row mt-30">
                              <a href="<?php _url($module_base); ?>" class="btn btn-danger col-3 col-md-3 ml-auto mr-auto">Retour</a>
                         </div>
                    </div>
               </div>

               <div class="row row-cards">
                    <?php if(is_array(@$photos)):?>
                         <?php foreach(@$photos as $rows):?>
                              <div class="col-sm-6 col-lg-4">
                                   <div class="card p-3">
                                        <a href="javascript:void(0)" class="mb-3">
                                             <img src="<?= _url($rows->photo_link) ?>" alt="Photo by <?= $rows->user_nicename ?>" class="rounded">
                                        </a>
                                        <div class="d-flex align-items-center px-2">
                                             <div class="avatar avatar-md mr-3" style="background-image: url(<?= _url($rows->user_photo) ?>)"></div>
                                             <div>
                                                  <div><?= $rows->user_nicename ?></div>
                                                  <small class="d-block text-muted">Le <?= gmdate('d/m/Y H:i',$rows->photo_added) ?></small>
                                             </div>
                                             <div class="ml-auto text-muted">
                                                  <a href="#static<?=@$rows->photo_id?>" data-toggle="modal"  class="icon d-none d-md-inline-block ml-3"><i class="fe fe-trash text-primary mr-1"></i></a>
                                             </div>
                                        </div>
                                   </div>
                              </div>

                              <div id="static<?=@$rows->photo_id?>" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
                                   <div class="modal-dialog">
                                        <div class="modal-content" enctype="multipart/form-data">
                                             <div class="modal-header">
                                                  <h4 class="modal-title">Supprimer photo</h4>
                                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                             </div>
                                             <div class="modal-body">
                                                  <p style="text-align: center; font-size: 14px;">
                                                       La photo sélectionnée va être supprimer de manière permanante. <br>
                                                       Voulez-vous continuer cette opération ?
                                                  </p>
                                             </div>
                                             <div class="modal-footer ml-auto mr-auto">
                                                  <button type="button" data-dismiss="modal" class="btn btn-danger col-6">Annuler</button>
                                                  <a href="<?= _url($module_base."deletePhoto/?photo_id=".@$rows->photo_id."&&galerie_id=".@$rows->galerie_id) ?>" class="btn btn-success col-6" name="validated">Valider</a>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         <?php endforeach;?>
                    <?php endif;?>
               </div>

          </div>
     </div>
</div>
