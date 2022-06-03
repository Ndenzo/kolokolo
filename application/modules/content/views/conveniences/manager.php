<style>
.img-container img {
     max-width: 100%;
}
.option-btn{
     max-width: 40px!important;
     margin: 5px!important;
}
</style>

<div class="row">
     <div class="col-12">
          <div class="card">
               <div class="card-body">
                    <div class="card-title row mb-5">
                         <h4 class="col-7 font-weight-bold text-uppercase"><?= $title ?> </h4>
                         <div class="col-5">
                              <a href="#custom-modal"  class="btn btn-success btn-icon-text float-right" data-toggle="modal"><?= $this->lang->line('btn-add') ?> <i class="fa fa-plus btn-icon-append"></i> </a>
                         </div>
                    </div>

                    <?php show_notification();?>

                    <div class="icons-list row">
                         <?php if (is_array($datagrid)): ?>
                              <?php foreach ($datagrid as $key => $row): ?>
                                   <div class="col-sm-6 col-md-4 col-lg-4">
                                        <div class="col-9">
                                             <img class="mr-3 ml-2" src="<?= _url($row->convenience_image) ?>" style="width: 50px; height: 50px; border:none;">
                                             <h5 class="mt-2 text-primary"> <strong><?= (@me('user_lang') == "english") ? @$row->convenience_name_gb : @$row->convenience_name ?></strong> </h5>
                                        </div>

                                        <div class="col-3">
                                             <a href="#custom-delete-modal" class="btn btn-small btn-danger mt-2" data-toggle="modal" onclick="define_delete(<?= @$row->convenience_id ?>, 'convenience_id')" data-dismiss="modal" style="float-right"><i class="fa fa-trash text-white"></i></a>
                                             <a href="#custom-update-modal" class="btn btn-small btn-warning mr-2 mt-2" data-toggle="modal" onclick="define_edit(<?= @$row->convenience_id ?>, 'content/convenience/showEdit');" data-dismiss="modal" style="float-right"><i class="fa fa-edit text-white"></i></a>
                                        </div>
                                   </div>
                              <?php endforeach; ?>
                         <?php endif; ?>
                    </div>

               </div>
          </div>
     </div>
</div>

<!-- Add manager ///////////////////////////////////////////////////////////////////////////////////////////////// -->

<div id="custom-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="customLabel" aria-modal="true">
     <div class="modal-dialog">
          <div class="modal-content">
               <form action="<?php _url($module_base.'insert'); ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                         <h4 class="modal-title" id="customLabel"><?= $this->lang->line('convenience-header-new') ?></h4>
                         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body container">
                         <div class="col-12">

                              <div class="form-group mb-3">
                                   <label><?= $this->lang->line('convenience-form-label-import') ?> <strong class="needed">(.jpg, .png, .jpeg, .gif)</strong> </label>
                                   <input type="file" class="dropify"  name="convenience_image" required/>
                              </div>

                              <div class="form-group mb-3">
                                   <ul class="nav nav-pills nav-pills-custom mt-3" id="pills-tab-custom" role="tablist">
                                        <li class="nav-item">
                                             <a class="nav-link active" id="pills-fr-tab-custom" data-toggle="pill" href="#pills-fr" role="tab" aria-controls="pills-fr" aria-selected="true">
                                                  <?= $this->lang->line('label-french-title') ?>
                                             </a>
                                        </li>
                                        <li class="nav-item">
                                             <a class="nav-link" id="pills-gb-tab-custom" data-toggle="pill" href="#pills-gb" role="tab" aria-controls="pills-gb" aria-selected="false">
                                                  <?= $this->lang->line('label-english-title') ?>
                                             </a>
                                        </li>
                                   </ul>

                                   <div class="tab-content tab-content-custom-pill" id="pills-tabContent-custom" style="margin-top:-30px;">
                                        <div class="tab-pane fade show active" id="pills-fr" role="tabpanel" aria-labelledby="pills-fr-tab-custom">
                                             <label><?= $this->lang->line('convenience-form-label-name') ?></label>
                                             <input type="text" class="form-control" placeholder="<?= $this->lang->line('convenience-form-placeholder-name') ?>" name="convenience_name" required>
                                        </div>
                                        <div class="tab-pane fade" id="pills-gb" role="tabpanel" aria-labelledby="pills-gb-tab-custom">
                                             <label><?= $this->lang->line('convenience-form-label-name') ?></label>
                                             <input type="text" class="form-control" placeholder="<?= $this->lang->line('convenience-form-placeholder-name') ?>" name="convenience_name_gb" required>
                                        </div>
                                   </div>

                              </div>

                         </div>
                    </div>
                    <div class="modal-footer mt-3">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                         <button type="submit" class="btn btn-success col-md-4"><?= $this->lang->line('btn-save') ?></button>
                    </div>
               </form>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<!-- Edit manager ///////////////////////////////////////////////////////////////////////////////////////////////// -->

<div id="custom-update-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="customLabel" aria-modal="true">
     <div class="modal-dialog">
          <div class="modal-content">
               <form action="<?php _url($module_base.'update'); ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                         <h4 class="modal-title" id="customLabel"><?= $this->lang->line('convenience-header-update') ?></h4>
                         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body container">
                         <div class="col-12">

                              <div class="col-12 mb-3">
                                   <img class="mr-auto ml-auto" id="convenience_image" src="<?= _url('assets/custom/img/default/default.png') ?>" style="width: 120px; height: 120px; border:none;">
                              </div>

                              <div class="form-group mb-3">
                                   <label><?= $this->lang->line('convenience-form-label-import') ?> <strong class="needed">(.jpg, .png, .jpeg, .gif)</strong> </label>
                                   <input type="file" class="dropify"  name="convenience_image"/>
                              </div>

                              <div class="form-group mb-3">
                                   <ul class="nav nav-pills nav-pills-custom mt-3" id="pills-edit-tab-custom" role="tablist">
                                        <li class="nav-item">
                                             <a class="nav-link active" id="pills-edit-fr-tab-custom" data-toggle="pill" href="#pills-edit-fr" role="tab" aria-controls="pills-edit-fr" aria-selected="true">
                                                  <?= $this->lang->line('label-french-title') ?>
                                             </a>
                                        </li>
                                        <li class="nav-item">
                                             <a class="nav-link" id="pills-edit-gb-tab-custom" data-toggle="pill" href="#pills-edit-gb" role="tab" aria-controls="pills-edit-gb" aria-selected="false">
                                                  <?= $this->lang->line('label-english-title') ?>
                                             </a>
                                        </li>
                                   </ul>

                                   <div class="tab-content tab-content-custom-pill" id="pills-edit-tabContent-custom" style="margin-top:-30px;">
                                        <div class="tab-pane fade show active" id="pills-edit-fr" role="tabpanel" aria-labelledby="pills-fr-tab-custom">
                                             <label><?= $this->lang->line('convenience-form-label-name') ?></label>
                                             <input type="text" class="form-control" placeholder="<?= $this->lang->line('convenience-form-placeholder-name') ?>" name="convenience_name" id="convenience_name" required>
                                        </div>
                                        <div class="tab-pane fade" id="pills-edit-gb" role="tabpanel" aria-labelledby="pills-gb-tab-custom">
                                             <label><?= $this->lang->line('convenience-form-label-name') ?></label>
                                             <input type="text" class="form-control" placeholder="<?= $this->lang->line('convenience-form-placeholder-name') ?>" name="convenience_name_gb" id="convenience_name_gb" required>
                                        </div>
                                   </div>

                              </div>

                         </div>
                    </div>
                    <div class="modal-footer mt-3">
                         <input type="hidden" name="convenience_id" id="convenience_id">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                         <button type="submit" class="btn btn-warning col-md-4"><?= $this->lang->line('btn-edit') ?></button>
                    </div>
               </form>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<!-- Delete manager ///////////////////////////////////////////////////////////////////////////////////////////////// -->

<div id="custom-delete-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel"><?= $this->lang->line('convenience-header-delete') ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'delete'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-12">
                              <p style="text-align: center; font-size: 14px;">
                                   <?= $this->lang->line('convenience-message-delete') ?>
                              </p>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" type="text" name="convenience_id">
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                                   <button type="submit" class="btn btn-danger col-md-4"><?= $this->lang->line('btn-delete') ?></button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>
