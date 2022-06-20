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
                         <h4 class="col-8 text-uppercase font-weight-bold"><?= $this->lang->line('params-title') ?></h4>
                         <?php if (me('role_code') == "root"): ?>
                              <div class="col-4">
                                   <a href="#custom-modal"  class="btn btn-success float-right btn-lg" data-toggle="modal"><i class="fa fa-plus"> </i> <?= $this->lang->line('btn-add') ?> </a>
                              </div>
                         <?php endif; ?>
                    </div>

                    <?php show_notification();?>

                    <div class="media mt-5">
                         <div class="media-body">

                              <div class="row">
                                   <div class="col-3">
                                        <ul class="nav nav-pills nav-pills-vertical nav-pills-info" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                             <?php if(is_array(@$datagrid)):?>
                                                  <?php foreach(@$datagrid as $key => $rows):?>
                                                       <li class="nav-item">
                                                            <a class="nav-link <?php if ($key == 0): ?> active <?php endif; ?> " id="v-pills-param-tab-<?= $rows->sim_state_id ?>" data-toggle="pill" href="#v-pills-param-<?= $rows->sim_state_id ?>" role="tab" aria-controls="v-pills-param-<?= $rows->sim_state_id ?>" aria-selected="true">
                                                                 <?= (@me('user_lang') == "english") ? @$rows->sim_state_name_gb : @$rows->sim_state_name ?>
                                                            </a>
                                                       </li>
                                                  <?php endforeach;?>
                                             <?php endif;?>
                                        </ul>
                                   </div>
                                   <div class="col-9">
                                        <div class="tab-content tab-content-vertical" id="v-pills-tabContent">
                                             <?php if(is_array(@$datagrid)):?>
                                                  <?php foreach(@$datagrid as $key => $rows):?>
                                                       <div class="tab-pane fade show <?php if ($key == 0): ?> active <?php endif; ?>" id="v-pills-param-<?= $rows->sim_state_id ?>" role="tabpanel" aria-labelledby="v-pills-param-tab-<?= $rows->sim_state_id ?>">
                                                            <div class="media row">
                                                                 <?php foreach ($rows->towns as $key => $town): ?>
                                                                      <div class="table-responsive pt-3 mb-5 col-12">
                                                                           <table class="table table-bordered">
                                                                                <thead>
                                                                                     <tr>
                                                                                          <th class="text-center text-info" colspan="3">
                                                                                               <h4> <strong><?= (@me('user_lang') == "english") ? @$town->sim_town_name_gb : @$town->sim_town_name ?></strong> </h4>
                                                                                          </th>
                                                                                     </tr>
                                                                                     <tr class="table-info">
                                                                                          <th> <?= $this->lang->line('params-table-label-real') ?> </th>
                                                                                          <th class="text-center" style="width: 70px;"><?= $this->lang->line('params-table-label-value') ?></th>
                                                                                          <th class="text-center" style="width: 80px;"><?= $this->lang->line('params-table-label-action') ?></th>
                                                                                     </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                     <?php foreach ($town->params as $key => $param): ?>
                                                                                          <tr>
                                                                                               <td>
                                                                                                    <?= (@me('user_lang') == "english") ? @$param->sim_type_name_gb : @$param->sim_type_name ?>
                                                                                               </td>
                                                                                               <td>
                                                                                                    <?= $param->sim_param_value ?> %
                                                                                               </td>
                                                                                               <td class="text-center">
                                                                                                    <div class="dropdown dropleft">
                                                                                                         <button class="btn p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                                              <i class="mdi mdi-dots-horizontal card-menu-btn"></i>
                                                                                                         </button>
                                                                                                         <div class="dropdown-menu"  data-x-placement="left-start">
                                                                                                              <a href="#custom-update-modal" class="text-warning dropdown-item" data-toggle="modal" onclick="define_edit(<?= @$param->sim_param_id ?>, 'simulator/param/showEdit')"><i class="fa fa-pencil mr-2"></i> <?= $this->lang->line('btn-edit') ?></a>
                                                                                                              <a href="#custom-delete-modal" class="text-danger dropdown-item" data-toggle="modal" onclick="define_delete(<?= @$param->sim_param_id ?>, 'sim_param_id')"><i class="fa fa-trash mr-2"></i> <?= $this->lang->line('btn-delete') ?></a>
                                                                                                         </div>
                                                                                                    </div>
                                                                                               </td>
                                                                                          </tr>
                                                                                     <?php endforeach; ?>
                                                                                </tbody>
                                                                           </table>
                                                                      </div>
                                                                 <?php endforeach; ?>
                                                            </div>
                                                       </div>
                                                  <?php endforeach;?>
                                             <?php endif;?>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>

<!-- Add manager ///////////////////////////////////////////////////////////////////////////////////////////////// -->

<div id="custom-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="customLabel" aria-modal="true">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="customLabel"><?= $this->lang->line('params-header-new') ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body container">
                    <form class="row justify-content-center" action="<?php _url($module_base.'insert'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 col-md-12">

                              <div class="form-group mb-3">
                                   <label><?= $this->lang->line('params-form-label-real') ?></label>
                                   <?php dropDown('SELECT sim_type_id, sim_type_name FROM sim_types ORDER BY sim_type_name',array(
                                        'name' => 'sim_type_id',
                                        'id' => "sim_type_id_form",
                                        'class' => 'form-control select_custom',
                                        'attr' => 'required',
                                   ));?>
                              </div>


                              <div class="form-group mb-3">
                                   <label><?= $this->lang->line('params-form-label-state') ?></label>
                                   <?php dropDown('SELECT sim_state_id, sim_state_name FROM sim_states ORDER BY sim_state_name',array(
                                        'name' => 'sim_state_id',
                                        'id' => "sim_state_id_form",
                                        'class' => 'form-control select_custom',
                                        'attr' => 'required',
                                   ));?>
                              </div>

                              <div class="form-group mb-3">
                                   <label><?= $this->lang->line('params-form-label-town') ?></label>
                                   <?php dropChained('SELECT sim_town_id, sim_town_name, sim_state_id FROM sim_towns',array(
                                        'name' => 'sim_town_id',
                                        'id' => "sim_town_id_form",
                                        'class' => 'form-control select_custom',
                                        'attr' => 'required',
                                   ));?>
                              </div>


                              <div class="form-group mb-3">
                                   <label><?= $this->lang->line('params-form-label-value') ?></label>
                                   <input type="number" step="0.01" class="form-control" name="sim_param_value" required>
                              </div>

                              <div class="modal-footer mt-5">
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-success col-md-5">Ajouter</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>


<!-- Update manager ///////////////////////////////////////////////////////////////////////////////////////////////// -->

<div id="custom-update-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="customLabel" aria-modal="true">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="customLabel"><?= $this->lang->line('params-header-update') ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body container">
                    <form class="row justify-content-center" action="<?php _url($module_base.'update'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 col-md-12">

                              <div class="form-group mb-3">
                                   <label><?= $this->lang->line('params-form-label-real') ?></label>
                                   <?php dropDown('SELECT sim_type_id, sim_type_name FROM sim_types ORDER BY sim_type_name',array(
                                        'name' => 'sim_type_id',
                                        'id' => "sim_type_id",
                                        'class' => 'form-control select_custom',
                                        'attr' => 'required',
                                   ));?>
                              </div>


                              <div class="form-group mb-3">
                                   <label><?= $this->lang->line('params-form-label-state') ?></label>
                                   <?php dropDown('SELECT sim_state_id, sim_state_name FROM sim_states ORDER BY sim_state_name',array(
                                        'name' => 'sim_state_id',
                                        'id' => "sim_state_id",
                                        'class' => 'form-control select_custom',
                                        'attr' => 'required',
                                   ));?>
                              </div>

                              <div class="form-group mb-3">
                                   <label><?= $this->lang->line('params-form-label-town') ?></label>
                                   <?php dropChained('SELECT sim_town_id, sim_town_name, sim_state_id FROM sim_towns',array(
                                        'name' => 'sim_town_id',
                                        'id' => "sim_town_id",
                                        'class' => 'form-control select_custom',
                                        'attr' => 'required',
                                   ));?>
                              </div>


                              <div class="form-group mb-3">
                                   <label><?= $this->lang->line('params-form-label-value') ?></label>
                                   <input type="number" step="0.01" class="form-control" name="sim_param_value" id="sim_param_value" required>
                              </div>

                              <div class="modal-footer mt-5">
                                   <input type="hidden" name="sim_param_id" id="sim_param_id">
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-warning col-md-5">Modifier</button>
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
                    <h4 class="modal-title" id="myCenterModalLabel"><?= $this->lang->line('params-header-delete') ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'delete'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 mt-50">
                              <p style="text-align: center; font-size: 14px;">
                                   <?= $this->lang->line('params-message-delete') ?>
                              </p>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" type="text" name="sim_param_id">
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                                   <button type="submit" class="btn btn-danger col-md-4">Delete</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>
