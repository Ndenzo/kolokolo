<div class="row">
     <div class="col-12">
          <div class="card">
               <div class="card-body">
                    <div class="card-title row mb-5">
                         <h3 class="col-7 font-weight-bold text-uppercase"><?= $title ?></h3>
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
                                        <th class="text-center" style="width:50px;"><?= $this->lang->line('settingsGender-table-label-code') ?></th>
                                        <th><?= $this->lang->line('settingsGender-table-label-name') ?></th>
                                        <th class="text-center" style="width: 120px;"><?= $this->lang->line('settingsGender-table-label-action') ?></th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <?php if(is_array(@$datagrid)):?>
                                        <?php foreach(@$datagrid as $key => $rows):?>
                                             <tr>
                                                  <td class="text-center"><?=@$key+1?></td>
                                                  <td><?=@$rows->settings_gender_code?></td>
                                                  <td><?= (@me('user_lang') == "english") ? @$rows->settings_gender_name_gb : @$rows->settings_gender_name ?></td>
                                                  <td class="footable-last-visible text-center">
                                                       <a href="#custom-update-modal" class="btn btn-small btn-outline-warning" data-toggle="modal" onclick="define_edit(<?= $rows->settings_gender_id ?>, 'settings/settings_gender/showEdit')"><i class="fa fa-pencil"></i></a>
                                                       <a href="#custom-delete-modal" class="btn btn-small btn-outline-danger" data-toggle="modal" onclick="define_delete(<?= $rows->settings_gender_id ?>, 'settings_gender_id')"><i class="fa fa-trash"></i></a>
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
                    <h4 class="modal-title" id="myCenterModalLabel"><?= $this->lang->line('settingsGender-header-new') ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'insert'); ?>" method="post">
                         <div class="col-10 col-md-12">
                              <div class="job-filter">
                                   <label><?= $this->lang->line('settingsGender-form-label-code') ?></label>
                                   <input class="form-control" type="text" placeholder="<?= $this->lang->line('settingsGender-form-placeholder-code') ?>" name="settings_gender_code" required><i class="search-icon" data-feather="code"></i>

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
                                             <label><?= $this->lang->line('settingsGender-form-label-name') ?></label>
                                             <input class="form-control" type="text" placeholder="<?= $this->lang->line('settingsGender-form-placeholder-name') ?>" name="settings_gender_name" required><i class="search-icon" data-feather="edit-3"></i>
                                        </div>
                                        <div class="tab-pane fade" id="pills-gb" role="tabpanel" aria-labelledby="pills-gb-tab-custom">
                                             <label><?= $this->lang->line('settingsGender-form-label-name') ?></label>
                                             <input class="form-control" type="text" placeholder="<?= $this->lang->line('settingsGender-form-placeholder-name') ?>" name="settings_gender_name_gb" required><i class="search-icon" data-feather="edit-3"></i>
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

<div id="custom-update-modal" class="modal fade bs-example-modal-center show" tabindex="-1" user="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel"><?= $this->lang->line('settingsGender-header-update') ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'update'); ?>" method="post">
                         <div class="col-10 col-md-12 mt-2">
                              <div class="form-group mb-3">
                                   <label><?= $this->lang->line('settingsGender-form-label-code') ?></label>
                                   <input type="text" class="form-control" placeholder="<?= $this->lang->line('settingsGender-form-placeholder-code') ?>" name="settings_gender_code" id="settings_gender_code" required>
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
                                             <label><?= $this->lang->line('settingsGender-form-label-name') ?></label>
                                             <input type="text" class="form-control" placeholder="<?= $this->lang->line('settingsGender-form-placeholder-name') ?>" name="settings_gender_name" id="settings_gender_name" required>
                                        </div>
                                        <div class="tab-pane fade" id="pills-edit-gb" role="tabpanel" aria-labelledby="pills-gb-tab-custom">
                                             <label><?= $this->lang->line('settingsGender-form-label-name') ?></label>
                                             <input type="text" class="form-control" placeholder="<?= $this->lang->line('settingsGender-form-placeholder-name') ?>" name="settings_gender_name_gb" id="settings_gender_name_gb" required>
                                        </div>
                                   </div>

                              </div>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" class="form-control" name="settings_gender_id" id="settings_gender_id" required>
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

<div id="custom-delete-modal" class="modal fade bs-example-modal-center show" tabindex="-1" user="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel"><?= $this->lang->line('settingsGender-header-delete') ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'delete'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-12 mt-2">
                              <p style="text-align: center; font-size: 14px;">
                                   <?= $this->lang->line('settingsGender-message-delete') ?>
                              </p>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" type="text" name="settings_gender_id">
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                                   <button type="submit" class="btn btn-danger col-md-4"><?= $this->lang->line('btn-delete') ?></button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>
