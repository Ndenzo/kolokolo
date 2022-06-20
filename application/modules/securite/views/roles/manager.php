<div class="row">
     <div class="col-12">
          <div class="card">
               <div class="card-body">
                    <div class="card-title row mb-5">
                         <h3 class="col-7 text-uppercase font-weight-bold"><?= @$title ?> </h3>
                         <div class="col-5">
                              <a href="#custom-modal"  class="btn btn-success float-right btn-lg" data-toggle="modal"><i class="fa fa-plus"> </i> <?= $this->lang->line('btn-add') ?> </a>
                         </div>
                    </div>
                    <?php show_notification();?>
                    <div class="table-responsive">
                         <table id="order-listing" class="table">
                              <thead>
                                   <tr>
                                        <th class="text-center" style="width:30px;">#</th>
                                        <th><?= $this->lang->line('role-table-label-code') ?></th>
                                        <th><?= $this->lang->line('role-table-label-name') ?></th>
                                        <th><?= $this->lang->line('role-table-label-desc') ?></th>
                                        <th class="text-center" style="width: 120px;"><?= $this->lang->line('role-table-label-action') ?></th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <?php if(is_array(@$datagrid)):?>
                                        <?php foreach(@$datagrid as $key => $rows):?>
                                             <tr>
                                                  <td class="text-center"><?=@$key+1?></td>
                                                  <td><?=@$rows->role_code?></td>
                                                  <td><?= (@me('user_lang') == "english") ? @$rows->role_name_gb : @$rows->role_name ?></td>
                                                  <td><?= (@me('user_lang') == "english") ? @$rows->role_desc_gb : @$rows->role_desc ?></td>
                                                  <td class="footable-last-visible text-center">
                                                       <a href="#custom-update-modal" class="btn btn-small btn-outline-warning" data-toggle="modal" onclick="define_edit(<?= $rows->role_id ?>, 'securite/roles/showEdit')"><i class="fa fa-pencil"></i></a>
                                                       <a href="#custom-delete-modal" class="btn btn-small btn-outline-danger" data-toggle="modal" onclick="define_delete(<?= $rows->role_id ?>, 'role_id')"><i class="fa fa-trash"></i></a>
                                                  </td>
                                             </tr>
                                        <?php endforeach;?>
                                   <?php endif;?>
                              </tbody>
                         </table>
                    </div>
               </div>
          </div>
     </div>
</div>

<div id="custom-modal" class="modal fade bs-example-modal-center show" tabindex="-1" eleve="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel"><?= $this->lang->line('role-header-new') ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url('securite/roles/insert'); ?>" method="post">
                         <div class="col-10 col-md-12">
                              <div class="job-filter">
                                   <div class="faq-form">
                                        <label><?= $this->lang->line('role-form-label-code') ?></label>
                                        <input type="text" class="form-control" placeholder="<?= $this->lang->line('role-form-placeholder-desc') ?>" name="role_code" required><i class="search-icon" data-feather="hash"></i>
                                   </div>
                                   <div class="faq-form mt-3">
                                        <ul class="nav nav-pills nav-pills-custom mt-3" id="pills-tab-custom" role="tablist">
                                             <li class="nav-item">
                                                  <a class="nav-link active" id="pills-fr-name-tab-custom" data-toggle="pill" href="#pills-fr-name" role="tab" aria-controls="pills-fr-name" aria-selected="true">
                                                       <?= $this->lang->line('label-french-title') ?>
                                                  </a>
                                             </li>
                                             <li class="nav-item">
                                                  <a class="nav-link" id="pills-gb-name-tab-custom" data-toggle="pill" href="#pills-gb-name" role="tab" aria-controls="pills-gb-name" aria-selected="false">
                                                       <?= $this->lang->line('label-english-title') ?>
                                                  </a>
                                             </li>
                                        </ul>

                                        <div class="tab-content tab-content-custom-pill" id="pills-tabContent-custom" style="margin-top:-30px;">
                                             <div class="tab-pane fade show active" id="pills-fr-name" role="tabpanel" aria-labelledby="pills-fr-name-tab-custom">
                                                  <label><?= $this->lang->line('role-form-label-name') ?></label>
                                                  <input type="text" class="form-control" placeholder="<?= $this->lang->line('role-form-placeholder-desc') ?>" name="role_name" required><i class="search-icon" data-feather="plus"></i>
                                             </div>
                                             <div class="tab-pane fade" id="pills-gb-name" role="tabpanel" aria-labelledby="pills-gb-name-tab-custom">
                                                  <label><?= $this->lang->line('role-form-label-name') ?></label>
                                                  <input type="text" class="form-control" placeholder="<?= $this->lang->line('role-form-placeholder-desc') ?>" name="role_name_gb" required><i class="search-icon" data-feather="plus"></i>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="faq-form mt-3">
                                        <ul class="nav nav-pills nav-pills-custom mt-3" id="pills-tab-custom" role="tablist">
                                             <li class="nav-item">
                                                  <a class="nav-link active" id="pills-fr-desc-tab-custom" data-toggle="pill" href="#pills-fr-desc" role="tab" aria-controls="pills-fr-desc" aria-selected="true">
                                                       <?= $this->lang->line('label-french-title') ?>
                                                  </a>
                                             </li>
                                             <li class="nav-item">
                                                  <a class="nav-link" id="pills-gb-desc-tab-custom" data-toggle="pill" href="#pills-gb-desc" role="tab" aria-controls="pills-gb-desc" aria-selected="false">
                                                       <?= $this->lang->line('label-english-title') ?>
                                                  </a>
                                             </li>
                                        </ul>

                                        <div class="tab-content tab-content-custom-pill" id="pills-tabContent-custom" style="margin-top:-30px;">
                                             <div class="tab-pane fade show active" id="pills-fr-desc" role="tabpanel" aria-labelledby="pills-fr-desc-tab-custom">
                                                  <label><?= $this->lang->line('role-form-label-desc') ?></label>
                                                  <textarea class="form-control" placeholder="<?= $this->lang->line('role-form-placeholder-desc') ?>" name="role_desc" rows="3" cols="80" required></textarea><i class="search-icon" data-feather="align-justify"></i>
                                             </div>
                                             <div class="tab-pane fade" id="pills-gb-desc" role="tabpanel" aria-labelledby="pills-gb-desc-tab-custom">
                                                  <label><?= $this->lang->line('role-form-label-desc') ?></label>
                                                  <textarea class="form-control" placeholder="<?= $this->lang->line('role-form-placeholder-desc') ?>" name="role_desc_gb" rows="3" cols="80" required></textarea><i class="search-icon" data-feather="align-justify"></i>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="modal-footer mt-3">
                                   <button type="button" class="btn btn-light" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                                   <button type="submit" class="btn btn-success col-md-4"><?= $this->lang->line('btn-save') ?></button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<!-- Edit manager ///////////////////////////////////////////////////////////////////////////////////////////////// -->

<div id="custom-update-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel"><?= $this->lang->line('role-header-update') ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url('securite/roles/update'); ?>" method="post">
                         <div class="col-10 col-md-12 mt-50">
                              <div class="form-group mb-3">
                                   <label><?= $this->lang->line('role-form-label-code') ?></label>
                                   <input type="text" class="form-control" placeholder="<?= $this->lang->line('role-form-placeholder-code') ?>" name="role_code" id="role_code" required>
                              </div>
                              <div class="form-group mb-3">

                                   <ul class="nav nav-pills nav-pills-custom mt-3" id="pills-tab-custom" role="tablist">
                                        <li class="nav-item">
                                             <a class="nav-link active" id="pills-fr-edit-name-tab-custom" data-toggle="pill" href="#pills-fr-edit-name" role="tab" aria-controls="pills-fr-edit-name" aria-selected="true">
                                                  <?= $this->lang->line('label-french-title') ?>
                                             </a>
                                        </li>
                                        <li class="nav-item">
                                             <a class="nav-link" id="pills-gb-edit-name-tab-custom" data-toggle="pill" href="#pills-gb-edit-name" role="tab" aria-controls="pills-gb-edit-name" aria-selected="false">
                                                  <?= $this->lang->line('label-english-title') ?>
                                             </a>
                                        </li>
                                   </ul>

                                   <div class="tab-content tab-content-custom-pill" id="pills-tabContent-custom" style="margin-top:-30px;">
                                        <div class="tab-pane fade show active" id="pills-fr-edit-name" role="tabpanel" aria-labelledby="pills-fr-edit-name-tab-custom">
                                             <label><?= $this->lang->line('role-form-label-name') ?></label>
                                             <input type="text" class="form-control" placeholder="<?= $this->lang->line('role-form-placeholder-name') ?>" name="role_name" id="role_name" required>
                                        </div>
                                        <div class="tab-pane fade" id="pills-gb-edit-name" role="tabpanel" aria-labelledby="pills-gb-edit-name-tab-custom">
                                             <label><?= $this->lang->line('role-form-label-name') ?></label>
                                             <input type="text" class="form-control" placeholder="<?= $this->lang->line('role-form-placeholder-name') ?>" name="role_name_gb" id="role_name_gb" required>
                                        </div>
                                   </div>

                              </div>
                              <div class="form-group mb-3">
                                   <ul class="nav nav-pills nav-pills-custom mt-3" id="pills-tab-custom" role="tablist">
                                        <li class="nav-item">
                                             <a class="nav-link active" id="pills-fr-edit-desc-tab-custom" data-toggle="pill" href="#pills-fr-edit-desc" role="tab" aria-controls="pills-fr-edit-desc" aria-selected="true">
                                                  <?= $this->lang->line('label-french-title') ?>
                                             </a>
                                        </li>
                                        <li class="nav-item">
                                             <a class="nav-link" id="pills-gb-edit-desc-tab-custom" data-toggle="pill" href="#pills-gb-edit-desc" role="tab" aria-controls="pills-gb-edit-desc" aria-selected="false">
                                                  <?= $this->lang->line('label-english-title') ?>
                                             </a>
                                        </li>
                                   </ul>

                                   <div class="tab-content tab-content-custom-pill" id="pills-tabContent-custom" style="margin-top:-30px;">
                                        <div class="tab-pane fade show active" id="pills-fr-edit-desc" role="tabpanel" aria-labelledby="pills-fr-edit-desc-tab-custom">
                                             <label><?= $this->lang->line('role-form-label-desc') ?></label>
                                             <textarea class="form-control" placeholder="<?= $this->lang->line('role-form-placeholder-desc') ?>" name="role_desc" id="role_desc" rows="3" cols="80" required></textarea>
                                        </div>
                                        <div class="tab-pane fade" id="pills-gb-edit-desc" role="tabpanel" aria-labelledby="pills-gb-edit-desc-tab-custom">
                                             <label><?= $this->lang->line('role-form-label-desc') ?></label>
                                             <textarea class="form-control" placeholder="<?= $this->lang->line('role-form-placeholder-desc') ?>" name="role_desc_gb" id="role_desc_gb" rows="3" cols="80" required></textarea>
                                        </div>
                                   </div>

                              </div>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" class="form-control" name="role_id" id="role_id" required>
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                                   <button type="submit" class="btn btn-warning col-md-4"><?= $this->lang->line('btn-edit') ?></button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<!-- Delete manager ///////////////////////////////////////////////////////////////////////////////////////////////// -->

<div id="custom-delete-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel"><?= $this->lang->line('role-header-delete') ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url('securite/roles/delete'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-12 mt-50">
                              <p style="text-align: center; font-size: 14px;">
                                   <?= $this->lang->line('role-message-delete') ?>
                              </p>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" type="text" name="role_id" value="<?=@$role_id?>">
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                                   <button type="submit" class="btn btn-danger col-md-5"><?= $this->lang->line('btn-delete') ?></button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>
