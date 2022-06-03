<div class="row">
     <div class="col-xl-4">
          <div class="card">

               <h4 class="card-header mb-3">Elèves</h4>
               <hr>

               <div class="row mb-3">
                    <div class="col-12">
                         <form class="app-search">
                              <div class="app-search-box">
                                   <div class="input-group">
                                        <input type="text" class="form-control" id="search" placeholder="Rechercher ...">
                                        <span class="input-group-text">
                                             <i class="fe-search"></i>
                                        </span>
                                   </div>
                              </div>
                         </form>
                    </div>
               </div>

               <hr>

               <div class="inbox-widget" style="max-height: 600px; overflow-y: auto;">

                    <?php if(is_array(@$datagrid)):?>
                         <?php foreach(@$datagrid as $rows):?>
                              <div class="inbox-item element mt-0 <?php if ($rows->eleve_id == $eleve->eleve_id): ?>
                                   border border-info p-2
                              <?php endif; ?>">
                              <a href="<?= _url($module_base."cropper/".$rows->eleve_id) ?>">
                                   <div class="avatar-lg float-left mr-3">
                                        <!-- <?php if($rows->personne_photo != null):?>
                                             <div class="rounded avatar-md mb-4 ml-auto mr-auto" style="height: 80px; width: 80px; margin-top: -4px; background-image: url('<?= _url($rows->personne_photo) ?>'); background-size: cover; background-repeat: no-repeat; background-position: center;"></div>
                                        <?php else:?>
                                             <div class="rounded avatar-md mb-4 ml-auto mr-auto" style="height: 80px; width: 80px; margin-top: -4px; background-image: url('<?php _url(); ?>assets/custom/img/default/boy.png'); background-size: cover; background-repeat: no-repeat; background-position: center;"></div>
                                        <?php endif;?> -->
                                        <?php if($rows->personne_photo != null):?>
                                             <img class="rounded avatar-md mb-4 ml-auto mr-auto lozad" style="box-shadow: 10px 10px 10px;" data-src="<?= _url($rows->personne_photo) ?>"/>
                                        <?php else:?>
                                             <img class="rounded avatar-md mb-4 ml-auto mr-auto lozad" style="box-shadow: 10px 10px 10px;" data-src="<?php _url(); ?>assets/custom/img/default/boy.png"/>
                                        <?php endif;?>
                                   </div>
                                   <div class="wid-u-info" style="margin-left: 80px;">
                                        <h5 class="mt-0"><?= $rows->personne_prenoms." ".$rows->personne_nom ?></h5>
                                        <p class="text-muted mb-1 font-13 text-truncate"><?= $rows->eleve_matricule ?></p>
                                        <small class="text-warning"><?= $rows->scolarite->settings_niveau_name ?></small>
                                   </div>
                              </a>
                         </div>
                    <?php endforeach;?>
               <?php endif;?>

          </div>
     </div>
</div>


<!-- Content -->
<div class="col-8">
     <div class="card">

          <h4 class="card-header mb-3">Editeur</h4>
          <hr>
          <div class="row">
               <div class="col-md-9">
                    <!-- <h3>Demo:</h3> -->
                    <div class="img-container">
                         <?php if($eleve->photo != null):?>
                              <img id="image" src="<?= _url($eleve->photo) ?>" alt="Picture">
                         <?php else:?>
                              <img id="image" src="<?php _url() ?>assets/custom/plugins/cropper/images/picture.jpg" alt="Picture">
                         <?php endif;?>
                    </div>
               </div>
               <div class="col-md-3">
                    <!-- <h3>Preview:</h3> -->
                    <div class="docs-preview clearfix">
                         <div class="img-preview preview-lg"></div>
                         <!-- <div class="img-preview preview-md"></div>
                         <div class="img-preview preview-sm"></div>
                         <div class="img-preview preview-xs"></div> -->
                    </div>

                    <!-- <h3>Data:</h3> -->
                    <div class="docs-data to_hide">
                         <div class="input-group input-group-sm">
                              <span class="input-group-prepend">
                                   <label class="input-group-text" for="dataX">X</label>
                              </span>
                              <input type="text" class="form-control" id="dataX" placeholder="x">
                              <span class="input-group-append">
                                   <span class="input-group-text">px</span>
                              </span>
                         </div>
                         <div class="input-group input-group-sm">
                              <span class="input-group-prepend">
                                   <label class="input-group-text" for="dataY">Y</label>
                              </span>
                              <input type="text" class="form-control" id="dataY" placeholder="y">
                              <span class="input-group-append">
                                   <span class="input-group-text">px</span>
                              </span>
                         </div>
                         <div class="input-group input-group-sm">
                              <span class="input-group-prepend">
                                   <label class="input-group-text" for="dataWidth">Width</label>
                              </span>
                              <input type="text" class="form-control" id="dataWidth" placeholder="width">
                              <span class="input-group-append">
                                   <span class="input-group-text">px</span>
                              </span>
                         </div>
                         <div class="input-group input-group-sm">
                              <span class="input-group-prepend">
                                   <label class="input-group-text" for="dataHeight">Height</label>
                              </span>
                              <input type="text" class="form-control" id="dataHeight" placeholder="height">
                              <span class="input-group-append">
                                   <span class="input-group-text">px</span>
                              </span>
                         </div>
                         <div class="input-group input-group-sm">
                              <span class="input-group-prepend">
                                   <label class="input-group-text" for="dataRotate">Rotate</label>
                              </span>
                              <input type="text" class="form-control" id="dataRotate" placeholder="rotate">
                              <span class="input-group-append">
                                   <span class="input-group-text">deg</span>
                              </span>
                         </div>
                         <div class="input-group input-group-sm">
                              <span class="input-group-prepend">
                                   <label class="input-group-text" for="dataScaleX">ScaleX</label>
                              </span>
                              <input type="text" class="form-control" id="dataScaleX" placeholder="scaleX">
                         </div>
                         <div class="input-group input-group-sm">
                              <span class="input-group-prepend">
                                   <label class="input-group-text" for="dataScaleY">ScaleY</label>
                              </span>
                              <input type="text" class="form-control" id="dataScaleY" placeholder="scaleY">
                         </div>
                    </div>
               </div>
          </div>
          <div class="row">
               <div class="col-md-9 docs-buttons">
                    <!-- <h3>Toolbar:</h3> -->

                    <div class="btn-group">
                         <label class="btn btn-primary btn-upload" for="inputImage" title="Upload image file">
                              <input type="file" class="sr-only" id="inputImage" name="file" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
                              <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="Import image with Blob URLs">
                                   <span class="fa fa-upload"></span>
                              </span>
                         </label>
                    </div>

                    <div class="btn-group btn-group-crop">
                         <button type="button" class="btn btn-success" data-method="getCroppedCanvas" data-option="{ &quot;maxWidth&quot;: 4096, &quot;maxHeight&quot;: 4096 }">
                              <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="Enregister">
                                   Enregister
                              </span>
                         </button>
                    </div>

                    <!-- Show the cropped image in modal -->
                    <div class="modal fade docs-cropped" id="getCroppedCanvasModal" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" role="dialog" tabindex="-1">
                         <div class="modal-dialog">
                              <div class="modal-content">
                                   <form action="<?php _url($module_base.'insert_image'); ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                                        <div class="modal-header">
                                             <h5 class="modal-title" id="getCroppedCanvasTitle">Cropped</h5>
                                             <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
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

               <div class="col-md-3 docs-toggles to_hide">
                    <!-- <h3>Toggles:</h3> -->
                    <div class="btn-group d-flex flex-nowrap" data-toggle="buttons">
                         <label class="btn btn-primary active">
                              <input type="radio" class="sr-only" id="aspectRatio0" name="aspectRatio" value="1.7777777777777777">
                              <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="aspectRatio: 16 / 9">
                                   16:9
                              </span>
                         </label>
                         <label class="btn btn-primary">
                              <input type="radio" class="sr-only" id="aspectRatio1" name="aspectRatio" value="1.3333333333333333">
                              <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="aspectRatio: 4 / 3">
                                   4:3
                              </span>
                         </label>
                         <label class="btn btn-primary">
                              <input type="radio" class="sr-only" id="aspectRatio2" name="aspectRatio" value="1">
                              <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="aspectRatio: 1 / 1">
                                   1:1
                              </span>
                         </label>
                         <label class="btn btn-primary">
                              <input type="radio" class="sr-only" id="aspectRatio3" name="aspectRatio" value="0.6666666666666666">
                              <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="aspectRatio: 2 / 3">
                                   2:3
                              </span>
                         </label>
                         <label class="btn btn-primary">
                              <input type="radio" class="sr-only" id="aspectRatio4" name="aspectRatio" value="NaN">
                              <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="aspectRatio: NaN">
                                   Free
                              </span>
                         </label>
                    </div>

                    <div class="btn-group d-flex flex-nowrap" data-toggle="buttons">
                         <label class="btn btn-primary active">
                              <input type="radio" class="sr-only" id="viewMode0" name="viewMode" value="0" checked>
                              <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="View Mode 0">
                                   VM0
                              </span>
                         </label>
                         <label class="btn btn-primary">
                              <input type="radio" class="sr-only" id="viewMode1" name="viewMode" value="1">
                              <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="View Mode 1">
                                   VM1
                              </span>
                         </label>
                         <label class="btn btn-primary">
                              <input type="radio" class="sr-only" id="viewMode2" name="viewMode" value="2">
                              <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="View Mode 2">
                                   VM2
                              </span>
                         </label>
                         <label class="btn btn-primary">
                              <input type="radio" class="sr-only" id="viewMode3" name="viewMode" value="3">
                              <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="View Mode 3">
                                   VM3
                              </span>
                         </label>
                    </div>

                    <div class="dropdown dropup docs-options">
                         <button type="button" class="btn btn-primary btn-block dropdown-toggle" id="toggleOptions" data-toggle="dropdown" aria-expanded="true">
                              Toggle Options
                              <span class="caret"></span>
                         </button>
                         <ul class="dropdown-menu" aria-labelledby="toggleOptions" role="menu">
                              <li class="dropdown-item">
                                   <div class="form-check">
                                        <input class="form-check-input" id="responsive" type="checkbox" name="responsive" checked>
                                        <label class="form-check-label" for="responsive">responsive</label>
                                   </div>
                              </li>
                              <li class="dropdown-item">
                                   <div class="form-check">
                                        <input class="form-check-input" id="restore" type="checkbox" name="restore" checked>
                                        <label class="form-check-label" for="restore">restore</label>
                                   </div>
                              </li>
                              <li class="dropdown-item">
                                   <div class="form-check">
                                        <input class="form-check-input" id="checkCrossOrigin" type="checkbox" name="checkCrossOrigin" checked>
                                        <label class="form-check-label" for="checkCrossOrigin">checkCrossOrigin</label>
                                   </div>
                              </li>
                              <li class="dropdown-item">
                                   <div class="form-check">
                                        <input class="form-check-input" id="checkOrientation" type="checkbox" name="checkOrientation" checked>
                                        <label class="form-check-label" for="checkOrientation">checkOrientation</label>
                                   </div>
                              </li>
                              <li class="dropdown-item">
                                   <div class="form-check">
                                        <input class="form-check-input" id="modal" type="checkbox" name="modal" checked>
                                        <label class="form-check-label" for="modal">modal</label>
                                   </div>
                              </li>
                              <li class="dropdown-item">
                                   <div class="form-check">
                                        <input class="form-check-input" id="guides" type="checkbox" name="guides" checked>
                                        <label class="form-check-label" for="guides">guides</label>
                                   </div>
                              </li>
                              <li class="dropdown-item">
                                   <div class="form-check">
                                        <input class="form-check-input" id="center" type="checkbox" name="center" checked>
                                        <label class="form-check-label" for="center">center</label>
                                   </div>
                              </li>
                              <li class="dropdown-item">
                                   <div class="form-check">
                                        <input class="form-check-input" id="highlight" type="checkbox" name="highlight" checked>
                                        <label class="form-check-label" for="highlight">highlight</label>
                                   </div>
                              </li>
                              <li class="dropdown-item">
                                   <div class="form-check">
                                        <input class="form-check-input" id="background" type="checkbox" name="background" checked>
                                        <label class="form-check-label" for="background">background</label>
                                   </div>
                              </li>
                              <li class="dropdown-item">
                                   <div class="form-check">
                                        <input class="form-check-input" id="autoCrop" type="checkbox" name="autoCrop" checked>
                                        <label class="form-check-label" for="autoCrop">autoCrop</label>
                                   </div>
                              </li>
                              <li class="dropdown-item">
                                   <div class="form-check">
                                        <input class="form-check-input" id="movable" type="checkbox" name="movable" checked>
                                        <label class="form-check-label" for="movable">movable</label>
                                   </div>
                              </li>
                              <li class="dropdown-item">
                                   <div class="form-check">
                                        <input class="form-check-input" id="rotatable" type="checkbox" name="rotatable" checked>
                                        <label class="form-check-label" for="rotatable">rotatable</label>
                                   </div>
                              </li>
                              <li class="dropdown-item">
                                   <div class="form-check">
                                        <input class="form-check-input" id="scalable" type="checkbox" name="scalable" checked>
                                        <label class="form-check-label" for="scalable">scalable</label>
                                   </div>
                              </li>
                              <li class="dropdown-item">
                                   <div class="form-check">
                                        <input class="form-check-input" id="zoomable" type="checkbox" name="zoomable" checked>
                                        <label class="form-check-label" for="zoomable">zoomable</label>
                                   </div>
                              </li>
                              <li class="dropdown-item">
                                   <div class="form-check">
                                        <input class="form-check-input" id="zoomOnTouch" type="checkbox" name="zoomOnTouch" checked>
                                        <label class="form-check-label" for="zoomOnTouch">zoomOnTouch</label>
                                   </div>
                              </li>
                              <li class="dropdown-item">
                                   <div class="form-check">
                                        <input class="form-check-input" id="zoomOnWheel" type="checkbox" name="zoomOnWheel" checked>
                                        <label class="form-check-label" for="zoomOnWheel">zoomOnWheel</label>
                                   </div>
                              </li>
                              <li class="dropdown-item">
                                   <div class="form-check">
                                        <input class="form-check-input" id="cropBoxMovable" type="checkbox" name="cropBoxMovable" checked>
                                        <label class="form-check-label" for="cropBoxMovable">cropBoxMovable</label>
                                   </div>
                              </li>
                              <li class="dropdown-item">
                                   <div class="form-check">
                                        <input class="form-check-input" id="cropBoxResizable" type="checkbox" name="cropBoxResizable" checked>
                                        <label class="form-check-label" for="cropBoxResizable">cropBoxResizable</label>
                                   </div>
                              </li>
                              <li class="dropdown-item">
                                   <div class="form-check">
                                        <input class="form-check-input" id="toggleDragModeOnDblclick" type="checkbox" name="toggleDragModeOnDblclick" checked>
                                        <label class="form-check-label" for="toggleDragModeOnDblclick">toggleDragModeOnDblclick</label>
                                   </div>
                              </li>
                         </ul>
                    </div><!-- /.dropdown -->

                    <!-- <a class="btn btn-success btn-block" data-toggle="tooltip" data-animation="false" href="https://fengyuanchen.github.io/cropperjs" title="JavaScript image cropper">Cropper.js</a> -->

               </div><!-- /.docs-toggles -->
          </div>
     </div>
</div>
</div>
