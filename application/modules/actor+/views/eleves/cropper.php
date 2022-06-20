<div class="row">
     <div class="col-12">
          <div class="email-right-aside bookmark-tabcontent contacts-tabs">
               <div class="card email-body radius-left">
                    <div class="ps-0">
                         <div class="tab-content">
                              <div class="tab-pane fade active show" id="pills-personal" role="tabpanel" aria-labelledby="pills-personal-tab">
                                   <div class="card mb-0">
                                        <div class="card-header d-flex">
                                             <h5>Gestion des photos</h5>
                                             <div class="f-14 pull-right mt-0">
                                                  <div class="col-12">
                                                       <form class="app-search" autocomplete="off">
                                                            <div class="app-search-box">
                                                                 <div class="input-group">
                                                                      <input type="text" class="form-control" id="search" placeholder="Rechercher ...">
                                                                      <span class="input-group-text">
                                                                           <i class="fa fa-search"></i>
                                                                      </span>
                                                                 </div>
                                                            </div>
                                                       </form>
                                                  </div>
                                             </div>
                                        </div>
                                        <div class="card-body p-0">
                                             <div class="row list-persons" id="addcon">
                                                  <div class="col-xl-3 xl-50 col-md-5" >
                                                       <div class="col-12 nav nav-pills" aria-orientation="vertical" style="max-height: 600px; overflow-y: auto;">
                                                            <?php if(is_array(@$datagrid)):?>
                                                                 <?php foreach(@$datagrid as $rows):?>
                                                                      <a class="contact-tab-0 nav-link col-12 element <?php if ($rows->eleve_id == $eleve->eleve_id): ?> active <?php endif; ?>" href="<?= _url($module_base."cropper/".$rows->eleve_id) ?>" style="margin-bottom:0px!important;">
                                                                           <div class="media">
                                                                                <?php if($rows->personne_photo != null):?>
                                                                                     <img class="img-50 img-fluid m-r-20 rounded-circle update_img_0 shadow shadow-showcase" src="<?= _url($rows->personne_photo) ?>">
                                                                                <?php else:?>
                                                                                     <img class="img-50 img-fluid m-r-20 rounded-circle update_img_0 shadow shadow-showcase" src="<?php _url(); ?>assets/custom/img/default/boy.png">
                                                                                <?php endif;?>
                                                                                <div class="media-body">
                                                                                     <h6> <span class="first_name_0"><?= $rows->personne_prenoms ?> </span><span class="last_name_0"><?= $rows->personne_nom ?></span></h6>
                                                                                     <p class="email_add_0"><?= $rows->eleve_matricule ?></p>
                                                                                </div>
                                                                           </div>
                                                                      </a>
                                                                 <?php endforeach;?>
                                                            <?php endif;?>
                                                       </div>
                                                  </div>
                                                  <div class="col-xl-9 xl-50 col-md-7">
                                                       <div class="row">
                                                            <div class="col-md-9">
                                                                 <!-- <h3>Demo:</h3> -->
                                                                 <div class="img-container">
                                                                      <?php if($eleve->personne_photo != null):?>
                                                                           <img id="image" src="<?= _url($eleve->personne_photo) ?>" alt="Picture">
                                                                      <?php else:?>
                                                                           <img id="image" src="<?php _url() ?>assets/custom/img/default/boy.png" alt="Picture">
                                                                      <?php endif;?>
                                                                 </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                 <div class="docs-preview clearfix">
                                                                      <div class="img-preview preview-lg"></div>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       <div class="row">
                                                            <div class="col-md-9 docs-buttons">

                                                                 <div class="btn-group">
                                                                      <label class="btn btn-primary btn-upload" for="inputImage" title="Upload image file">
                                                                           <input type="file" class="sr-only" id="inputImage" name="file" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
                                                                           <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="Import image with Blob URLs">
                                                                                <span class="fa fa-upload"></span>
                                                                           </span>
                                                                      </label>
                                                                 </div>

                                                                 <div class="btn-group btn-group-crop">
                                                                      <a href="#getCroppedCanvasModal" type="button" class="btn btn-success" data-toggle="modal" data-method="getCroppedCanvas" data-option="{ &quot;maxWidth&quot;: 4096, &quot;maxHeight&quot;: 4096 }">
                                                                           <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="Enregister">
                                                                                Enregister
                                                                           </span>
                                                                      </a>
                                                                 </div>

                                                                 <!-- Show the cropped image in modal -->
                                                                 <div class="modal fade docs-cropped" id="getCroppedCanvasModal" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" role="dialog" tabindex="-1">
                                                                      <div class="modal-dialog">
                                                                           <div class="modal-content">
                                                                                <form action="<?php _url($module_base.'insert_image'); ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                                                                                     <div class="modal-header">
                                                                                          <h5 class="modal-title" id="getCroppedCanvasTitle">Cropped</h5>
                                                                                          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                                                                                               <span aria-hidden="true"></span>
                                                                                          </button>
                                                                                     </div>
                                                                                     <div class="modal-body"></div>
                                                                                     <div class="modal-footer">
                                                                                          <input type="hidden" name="eleve_id" value="<?= $eleve->eleve_id ?>">
                                                                                          <input type="hidden" name="personne_id" value="<?= $eleve->personne_id ?>">
                                                                                          <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                                                                          <button type="submit" class="btn btn-primary col-md-4">Sauvegarder</button>
                                                                                          <a class="btn btn-primary to_hide" id="download" href="javascript:void(0);" download="cropped.jpg">Download</a>
                                                                                     </div>
                                                                                </form>
                                                                           </div>
                                                                      </div>
                                                                 </div><!-- /.modal -->

                                                            </div><!-- /.docs-buttons -->

                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
