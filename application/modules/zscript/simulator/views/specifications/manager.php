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
     <div class="col-xl-4 col-md-5 box-col-6">
          <div class="email-wrap bookmark-wrap">
               <div class="email-left-aside">
                    <div class="card">
                         <div class="card-body">
                              <div class="card-title row mb-5">
                                   <h4 class="col-12 text-uppercase font-weight-bold"><?= $this->lang->line('spec-type-title') ?></h4>
                              </div>
                              <div class="email-app-sidebar left-bookmark">
                                   <ul class="nav main-menu" role="tablist">
                                        <li class="nav-item col-12">
                                             <button class="btn btn-success btn-block w-100 mb-4 form-control btn-sm" type="button" data-toggle="modal" data-target="#custom-type-modal">
                                                  <?= $this->lang->line('btn-add') ?>
                                             </button>
                                        </li>
                                   </ul>
                                   <ul class="list-group" style="overflow-y: auto; max-height: 510px;">
                                        <?php if(is_array(@$types)):?>
                                             <?php foreach(@$types as $type):?>
                                                  <li class="list-group-item element">
                                                       <div class="float-left">
                                                            <?= (@me('user_lang') == "english") ? @$type->sim_type_name_gb : @$type->sim_type_name ?>
                                                       </div>
                                                       <div class="float-right">
                                                            <a href="#custom-update-type-modal" class="btn btn-sm btn-outline-warning" data-toggle="modal" onclick="define_edit(<?= $type->sim_type_id ?>, 'simulator/specification/showEdit_Type')" data-dismiss="modal"><i class="fa fa-pencil"></i></a>
                                                            <a href="#custom-delete-type-modal" class="btn btn-sm btn-outline-danger" data-toggle="modal" onclick="define_delete(<?= $type->sim_type_id ?>, 'sim_type_id')" data-dismiss="modal"><i class="fa fa-trash"></i></a>
                                                       </div>
                                                  </li>
                                             <?php endforeach;?>
                                        <?php endif;?>
                                   </ul>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <div class="col-xl-8 col-md-7 box-col-12">
          <div class="card">
               <div class="card-body">
                    <div class="card-title row mb-5">
                         <h4 class="col-8 text-uppercase font-weight-bold"><?= $this->lang->line('spec-stateTown-title') ?> </h4>
                         <?php if (me('role_code') == "root"): ?>
                              <div class="col-4">
                                   <div class="dropdown float-right">
                                        <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuSizeButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <!-- <i class="fa fa-plus"></i> -->
                                             <?= $this->lang->line('btn-add') ?>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton2">
                                             <a  href="#custom-modal"  class="dropdown-item" data-toggle="modal"> <?= $this->lang->line('btn-addState') ?></a>
                                             <a  href="#custom-town-modal"  class="dropdown-item" data-toggle="modal"> <?= $this->lang->line('btn-addTown') ?></a>
                                        </div>
                                   </div>
                              </div>
                         <?php endif; ?>
                    </div>

                    <?php if (me('role_code') == 'root'): ?>
                         <div class="row mb-3">
                              <div class="col-sm-6 col-xl-4 col-lg-6">
                                   <div class="card o-hidden">
                                        <div class="bg-primary b-r-4 card-body">
                                             <div class="media static-top-widget text-white">
                                                  <div class="align-self-center text-center"><i data-feather="archive"></i></div>
                                                  <div class="media-body"><span class="m-0"><?= $this->lang->line('label-state-title') ?></span>
                                                       <h4 class="mb-0 counter"><?= @count($datagrid) ?></h4>
                                                  </div>

                                             </div>
                                        </div>
                                   </div>
                              </div>

                              <div class="col-sm-6 col-xl-4 col-lg-6">
                                   <div class="card o-hidden">
                                        <div class="bg-success b-r-4 card-body">
                                             <div class="media static-top-widget text-white">
                                                  <div class="align-self-center text-center"><i data-feather="check"></i></div>
                                                  <div class="media-body"><span class="m-0"><?= $this->lang->line('label-town-title') ?></span>
                                                       <h4 class="mb-0 counter"><?= @count($datagrid_actif) ?></h4>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>

                              <div class="col-sm-6 col-xl-4 col-lg-6">
                                   <div class="card o-hidden">
                                        <div class="bg-danger b-r-4 card-body">
                                             <div class="media static-top-widget text-white">
                                                  <div class="align-self-center text-center"><i data-feather="x"></i></div>
                                                  <div class="media-body"><span class="m-0"><?= $this->lang->line('label-lock-title') ?></span>
                                                       <h4 class="mb-0 counter"><?= 0//@get_nbTickets("canceled") ?></h4>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    <?php endif; ?>


                    <?php show_notification();?>

                    <div class="media mt-5">
                         <div class="media-body">
                              <div class="table-responsive">
                                   <table id="order-listing" class="table table-striped table-bordered">
                                        <thead>
                                             <tr>
                                                  <th class="text-center" style="width:30px;">#</th>
                                                  <th class="text-center" style="width: 120px;"><?= $this->lang->line('spec-table-label-date') ?></th>
                                                  <th><?= $this->lang->line('spec-table-label-state') ?></th>
                                                  <th><?= $this->lang->line('spec-table-label-rate') ?></th>
                                                  <th class="text-center" style="width: 70px;"><?= $this->lang->line('spec-table-label-action') ?></th>
                                             </tr>
                                        </thead>
                                        <tbody>
                                             <?php if(is_array(@$datagrid)):?>
                                                  <?php foreach(@$datagrid as $key => $rows):?>
                                                       <tr class="<?php if ($rows->sim_state_locked == 1): ?>table-warning<?php endif; ?>">
                                                            <td class="text-center"><?=@$key+1?></td>
                                                            <td class="text-center"><?= gmdate("d-m-Y H:i", @$rows->sim_state_added)?></td>
                                                            <td><?= (@me('user_lang') == "english") ? @$rows->sim_state_name_gb : @$rows->sim_state_name ?></td>
                                                            <td><?= @$rows->sim_state_rate ?> %</td>
                                                            <td class="footable-last-visible text-center">
                                                                 <div class="dropdown dropleft">
                                                                      <button class="btn p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                           <i class="mdi mdi-dots-horizontal card-menu-btn"></i>
                                                                      </button>
                                                                      <div class="dropdown-menu"  data-x-placement="left-start">
                                                                           <a href="#custom-town-modal-<?= @$rows->sim_state_id ?>" class="text-info dropdown-item" data-toggle="modal"><i class="fa fa-sitemap mr-2"></i> <?= $this->lang->line('btn-town') ?></a>
                                                                           <a href="#custom-lock-modal-<?= @$rows->sim_state_id ?>" class="text-info dropdown-item" data-toggle="modal">
                                                                                <?php if ($rows->sim_state_locked == 1): ?>
                                                                                     <i class="fa fa-unlock mr-2"></i> <?= $this->lang->line('spec-header-unlock') ?>
                                                                                <?php else: ?>
                                                                                     <i class="fa fa-lock mr-2"></i> <?= $this->lang->line('spec-header-lock') ?>
                                                                                <?php endif; ?>
                                                                           </a>
                                                                           <div class="dropdown-divider"></div>
                                                                           <a href="#custom-update-modal" class="text-warning dropdown-item" data-toggle="modal" onclick="define_edit(<?= $rows->sim_state_id ?>, 'simulator/specification/showEdit')"><i class="fa fa-pencil mr-2"></i> <?= $this->lang->line('btn-edit') ?></a>
                                                                           <a href="#custom-delete-modal" class="text-danger dropdown-item" data-toggle="modal" onclick="define_delete(<?= @$rows->sim_state_id ?>, 'sim_state_id')"><i class="fa fa-trash mr-2"></i> <?= $this->lang->line('btn-delete') ?></a>
                                                                      </div>
                                                                 </div>
                                                            </td>
                                                            <div id="custom-lock-modal-<?= @$rows->sim_state_id ?>" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
                                                                 <div class="modal-dialog modal-dialog-centered">
                                                                      <div class="modal-content">
                                                                           <div class="modal-header">
                                                                                <h4 class="modal-title" id="myCenterModalLabel">
                                                                                     <?php if ($rows->sim_state_locked == 1): ?>
                                                                                          <?= $this->lang->line('spec-header-unlock') ?> | <?=$rows->sim_state_name ?>
                                                                                     <?php else: ?>
                                                                                          <?= $this->lang->line('spec-header-lock') ?> | <?=$rows->sim_state_name ?>
                                                                                     <?php endif; ?>
                                                                                </h4>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                           </div>
                                                                           <div class="modal-body">
                                                                                <form class="row justify-content-center" action="<?php _url($module_base.'locker'); ?>" method="post" enctype="multipart/form-data">
                                                                                     <div class="col-12 mt-3">
                                                                                          <p style="text-align: center; font-size: 14px;">
                                                                                               <?= $this->lang->line('spec-message-update') ?>
                                                                                          </p>
                                                                                          <?php if ($rows->sim_state_locked == 1): ?>
                                                                                               <input type="hidden" type="text" name="sim_state_locked" value="0">
                                                                                          <?php else: ?>
                                                                                               <input type="hidden" type="text" name="sim_state_locked" value="1">
                                                                                          <?php endif; ?>
                                                                                          <div class="modal-footer mt-3">
                                                                                               <input type="hidden" type="text" name="sim_state_id" value="<?= @$rows->sim_state_id ?>">
                                                                                               <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                                                                                               <button type="submit" class="btn btn-info col-md-7">
                                                                                                    <?php if ($rows->sim_state_locked == 1): ?>
                                                                                                         <?= $this->lang->line('btn-unlock') ?>
                                                                                                    <?php else: ?>
                                                                                                         <?= $this->lang->line('btn-lock') ?>
                                                                                                    <?php endif; ?>
                                                                                               </button>
                                                                                          </div>
                                                                                     </div>
                                                                                </form>
                                                                           </div>
                                                                      </div><!-- /.modal-content -->
                                                                 </div><!-- /.modal-dialog -->
                                                            </div>

                                                            <div id="custom-town-modal-<?= @$rows->sim_state_id ?>" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
                                                                 <div class="modal-dialog modal-dialog-centered">
                                                                      <div class="modal-content">
                                                                           <div class="modal-header">
                                                                                <h4 class="modal-title" id="myCenterModalLabe">
                                                                                     <?= $this->lang->line('spec-header-towns') ?> | <?= @$rows->sim_state_name ?>
                                                                                </h4>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                           </div>
                                                                           <div class="modal-body">
                                                                                <ul class="list-group">
                                                                                     <?php if(is_array(@$rows->towns)):?>
                                                                                          <?php foreach(@$rows->towns as $key => $town):?>
                                                                                               <li class="list-group-item">
                                                                                                    <div class="float-left">
                                                                                                         <?= (@me('user_lang') == "english") ? @$town->sim_town_name_gb : @$town->sim_town_name ?>
                                                                                                    </div>
                                                                                                    <div class="float-right">
                                                                                                         <a href="#custom-update-town-modal" class="btn btn-sm btn-outline-warning" data-toggle="modal" onclick="define_edit(<?= $town->sim_town_id ?>, 'simulator/specification/showEdit_Town')" data-dismiss="modal"><i class="fa fa-pencil"></i></a>
                                                                                                         <a href="#custom-delete-town-modal" class="btn btn-sm btn-outline-danger" data-toggle="modal" onclick="define_delete(<?= $town->sim_town_id ?>, 'sim_town_id')" data-dismiss="modal"><i class="fa fa-trash"></i></a>
                                                                                                    </div>
                                                                                               </li>
                                                                                          <?php endforeach;?>
                                                                                     <?php endif;?>
                                                                                </ul>
                                                                           </div>
                                                                           <div class="modal-footer mt-5">
                                                                                <button type="button" class="btn btn-light col-6 ml-auto mr-auto" data-dismiss="modal">Fermer</button>
                                                                           </div>
                                                                      </div><!-- /.modal-content -->
                                                                 </div><!-- /.modal-dialog -->
                                                            </div>
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
     </div>
</div>

<!-- Add manager ///////////////////////////////////////////////////////////////////////////////////////////////// -->

<div id="custom-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="customLabel" aria-modal="true">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="customLabel"><?= $this->lang->line('spec-header-addState') ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body container">
                    <form class="row justify-content-center" action="<?php _url($module_base.'insert'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 col-md-12">

                              <div class="form-group mb-3">
                                   <ul class="nav nav-pills nav-pills-custom mt-3" id="pills-state-tab-custom" role="tablist">
                                        <li class="nav-item">
                                             <a class="nav-link active" id="pills-fr-state-tab-custom" data-toggle="pill" href="#pills-fr-state" role="tab" aria-controls="pills-fr-state" aria-selected="true">
                                                  <?= $this->lang->line('label-french-title') ?>
                                             </a>
                                        </li>
                                        <li class="nav-item">
                                             <a class="nav-link" id="pills-gb-state-tab-custom" data-toggle="pill" href="#pills-gb-state" role="tab" aria-controls="pills-gb-state" aria-selected="false">
                                                  <?= $this->lang->line('label-english-title') ?>
                                             </a>
                                        </li>
                                   </ul>

                                   <div class="tab-content tab-content-custom-pill" id="pills-tabContent-custom" style="margin-top:-30px;">
                                        <div class="tab-pane fade show active" id="pills-fr-state" role="tabpanel" aria-labelledby="pills-fr-state-tab-custom">
                                             <label><?= $this->lang->line('spec-form-label-nameState') ?></label>
                                             <input type="text" class="form-control" placeholder="<?= $this->lang->line('spec-form-placeholder-nameState') ?>" name="sim_state_name" required>
                                        </div>
                                        <div class="tab-pane fade" id="pills-gb-state" role="tabpanel" aria-labelledby="pills-gb-state-tab-custom">
                                             <label><?= $this->lang->line('spec-form-label-nameState') ?></label>
                                             <input type="text" class="form-control" placeholder="<?= $this->lang->line('spec-form-placeholder-nameState') ?>" name="sim_state_name_gb" required>
                                        </div>
                                   </div>
                              </div>

                              <div class="form-group mb-3">
                                   <label><?= $this->lang->line('spec-form-label-rate') ?></label>
                                   <div class="input-group">
                                        <input type="number" min="1" step="0.01" class="form-control" placeholder="<?= $this->lang->line('spec-form-placeholder-rate') ?>" name="sim_state_rate" required>
                                        <div class="input-group-append">
                                             <span class="input-group-text">%</span>
                                        </div>
                                   </div>
                              </div>

                              <div class="modal-footer mt-5">
                                   <button type="button" class="btn btn-light" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                                   <button type="submit" class="btn btn-success col-md-5"><?= $this->lang->line('btn-add') ?></button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<div id="custom-town-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="customLabel" aria-modal="true">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="customLabel"><?= $this->lang->line('spec-header-addTown') ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body container">
                    <form class="row justify-content-center" action="<?php _url($module_base.'insert_town'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 col-md-12">

                              <div class="form-group mb-3">
                                   <label><?= $this->lang->line('spec-form-label-nameState') ?></label>
                                   <?php dropDown('SELECT sim_state_id, sim_state_name FROM sim_states ORDER BY sim_state_name',array(
                                        'name' => 'sim_state_id',
                                        'id' => "sim_state_id_form",
                                        'class' => 'form-control select_custom',
                                        'attr' => 'required',
                                   ));?>
                              </div>

                              <div class="form-group mb-3">
                                   <ul class="nav nav-pills nav-pills-custom mt-3" id="pills-town-tab-custom" role="tablist">
                                        <li class="nav-item">
                                             <a class="nav-link active" id="pills-fr-town-tab-custom" data-toggle="pill" href="#pills-fr-town" role="tab" aria-controls="pills-fr-town" aria-selected="true">
                                                  <?= $this->lang->line('label-french-title') ?>
                                             </a>
                                        </li>
                                        <li class="nav-item">
                                             <a class="nav-link" id="pills-gb-town-tab-custom" data-toggle="pill" href="#pills-gb-town" role="tab" aria-controls="pills-gb-town" aria-selected="false">
                                                  <?= $this->lang->line('label-english-title') ?>
                                             </a>
                                        </li>
                                   </ul>

                                   <div class="tab-content tab-content-custom-pill" id="pills-tabContent-custom" style="margin-top:-30px;">
                                        <div class="tab-pane fade show active" id="pills-fr-town" role="tabpanel" aria-labelledby="pills-fr-town-tab-custom">
                                             <label><?= $this->lang->line('spec-form-label-nameTown') ?></label>
                                             <input type="text" class="form-control" placeholder="<?= $this->lang->line('spec-form-placeholder-nameTown') ?>" name="sim_town_name" required>
                                        </div>
                                        <div class="tab-pane fade" id="pills-gb-town" role="tabpanel" aria-labelledby="pills-gb-town-tab-custom">
                                             <label><?= $this->lang->line('spec-form-label-nameTown') ?></label>
                                             <input type="text" class="form-control" placeholder="<?= $this->lang->line('spec-form-placeholder-nameTown') ?>" name="sim_town_name_gb" required>
                                        </div>
                                   </div>
                              </div>

                              <div class="modal-footer mt-5">
                                   <button type="button" class="btn btn-light" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                                   <button type="submit" class="btn btn-success col-md-5"><?= $this->lang->line('btn-add') ?></button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<div id="custom-type-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="customLabel" aria-modal="true">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="customLabel"><?= $this->lang->line('spec-header-addType') ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body container">
                    <form class="row justify-content-center" action="<?php _url($module_base.'insert_type'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 col-md-12">

                              <div class="form-group mb-3">
                                   <ul class="nav nav-pills nav-pills-custom mt-3" id="pills-town-tab-custom" role="tablist">
                                        <li class="nav-item">
                                             <a class="nav-link active" id="pills-fr-type-tab-custom" data-toggle="pill" href="#pills-fr-type" role="tab" aria-controls="pills-fr-type" aria-selected="true">
                                                  <?= $this->lang->line('label-french-title') ?>
                                             </a>
                                        </li>
                                        <li class="nav-item">
                                             <a class="nav-link" id="pills-gb-type-tab-custom" data-toggle="pill" href="#pills-gb-type" role="tab" aria-controls="pills-gb-type" aria-selected="false">
                                                  <?= $this->lang->line('label-english-title') ?>
                                             </a>
                                        </li>
                                   </ul>

                                   <div class="tab-content tab-content-custom-pill" id="pills-tabContent-custom" style="margin-top:-30px;">
                                        <div class="tab-pane fade show active" id="pills-fr-type" role="tabpanel" aria-labelledby="pills-fr-type-tab-custom">
                                             <label><?= $this->lang->line('spec-form-label-nameType') ?></label>
                                             <input type="text" class="form-control" placeholder="<?= $this->lang->line('spec-form-placeholder-nameType') ?>" name="sim_type_name" required>
                                        </div>
                                        <div class="tab-pane fade" id="pills-gb-type" role="tabpanel" aria-labelledby="pills-gb-type-tab-custom">
                                             <label><?= $this->lang->line('spec-form-label-nameType') ?></label>
                                             <input type="text" class="form-control" placeholder="<?= $this->lang->line('spec-form-placeholder-nameType') ?>" name="sim_type_name_gb" required>
                                        </div>
                                   </div>
                              </div>

                              <div class="modal-footer mt-5">
                                   <button type="button" class="btn btn-light" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                                   <button type="submit" class="btn btn-success col-md-5"><?= $this->lang->line('btn-add') ?></button>
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
                    <h4 class="modal-title" id="myCenterModalLabel"><?= $this->lang->line('spec-header-update') ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body container">
                    <form class="row justify-content-center" action="<?php _url($module_base.'update'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 col-md-12">

                              <div class="form-group mb-3">
                                   <ul class="nav nav-pills nav-pills-custom mt-3" id="pills-state-edit-tab-custom" role="tablist">
                                        <li class="nav-item">
                                             <a class="nav-link active" id="pills-fr-state-edit-tab-custom" data-toggle="pill" href="#pills-fr-state-edit" role="tab" aria-controls="pills-fr-state-edit" aria-selected="true">
                                                  <?= $this->lang->line('label-french-title') ?>
                                             </a>
                                        </li>
                                        <li class="nav-item">
                                             <a class="nav-link" id="pills-gb-state-edit-tab-custom" data-toggle="pill" href="#pills-gb-state-edit" role="tab" aria-controls="pills-gb-state-edit" aria-selected="false">
                                                  <?= $this->lang->line('label-english-title') ?>
                                             </a>
                                        </li>
                                   </ul>

                                   <div class="tab-content tab-content-custom-pill" id="pills-tabContent-custom" style="margin-top:-30px;">
                                        <div class="tab-pane fade show active" id="pills-fr-state-edit" role="tabpanel" aria-labelledby="pills-fr-state-edit-tab-custom">
                                             <label><?= $this->lang->line('spec-form-label-nameState') ?></label>
                                             <input type="text" class="form-control" placeholder="<?= $this->lang->line('spec-form-placeholder-nameState') ?>" name="sim_state_name" id="sim_state_name" required>
                                        </div>
                                        <div class="tab-pane fade" id="pills-gb-state-edit" role="tabpanel" aria-labelledby="pills-fr-state-edit-tab-custom">
                                             <label><?= $this->lang->line('spec-form-label-nameState') ?></label>
                                             <input type="text" class="form-control" placeholder="<?= $this->lang->line('spec-form-placeholder-nameState') ?>" name="sim_state_name_gb" id="sim_state_name_gb" required>
                                        </div>
                                   </div>
                              </div>

                              <div class="form-group mb-3">
                                   <label><?= $this->lang->line('spec-form-label-rate') ?></label>
                                   <div class="input-group">
                                        <input type="number" min="1" step="0.01" class="form-control" placeholder="<?= $this->lang->line('spec-form-placeholder-rate') ?>" name="sim_state_rate" id="sim_state_rate" required>
                                        <div class="input-group-append">
                                             <span class="input-group-text">%</span>
                                        </div>
                                   </div>
                              </div>

                              <div class="modal-footer mt-5">
                                   <input type="hidden" type="text" name="sim_state_id" id="sim_state_id">
                                   <button type="button" class="btn btn-light" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                                   <button type="submit" class="btn btn-warning col-md-5"><?= $this->lang->line('btn-edit') ?></button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<div id="custom-update-town-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="customLabel" aria-modal="true">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel"><?= $this->lang->line('spec-header-update') ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body container">
                    <form class="row justify-content-center" action="<?php _url($module_base.'update_town'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 col-md-12">

                              <div class="form-group mb-3">
                                   <label><?= $this->lang->line('spec-form-label-nameState') ?></label>
                                   <?php dropDown('SELECT sim_state_id, sim_state_name FROM sim_states ORDER BY sim_state_name',array(
                                        'name' => 'sim_state_id',
                                        'id' => "sim_state_update_id",
                                        'class' => 'form-control select_custom',
                                        'attr' => 'required selected',
                                   ));?>
                              </div>

                              <div class="form-group mb-3">
                                   <ul class="nav nav-pills nav-pills-custom mt-3" id="pills-town-edit-tab-custom" role="tablist">
                                        <li class="nav-item">
                                             <a class="nav-link active" id="pills-fr-town-edit-tab-custom" data-toggle="pill" href="#pills-fr-town-edit" role="tab" aria-controls="pills-fr-town-edit" aria-selected="true">
                                                  <?= $this->lang->line('label-french-title') ?>
                                             </a>
                                        </li>
                                        <li class="nav-item">
                                             <a class="nav-link" id="pills-gb-town-edit-tab-custom" data-toggle="pill" href="#pills-gb-town-edit" role="tab" aria-controls="pills-gb-town-edit" aria-selected="false">
                                                  <?= $this->lang->line('label-english-title') ?>
                                             </a>
                                        </li>
                                   </ul>

                                   <div class="tab-content tab-content-custom-pill" id="pills-tabContent-custom" style="margin-top:-30px;">
                                        <div class="tab-pane fade show active" id="pills-fr-town-edit" role="tabpanel" aria-labelledby="pills-fr-town-edit-tab-custom">
                                             <label><?= $this->lang->line('spec-form-label-nameTown') ?></label>
                                             <input type="text" class="form-control" placeholder="<?= $this->lang->line('spec-form-placeholder-nameTown') ?>" name="sim_town_name" id="sim_town_name" required>
                                        </div>
                                        <div class="tab-pane fade" id="pills-gb-town-edit" role="tabpanel" aria-labelledby="pills-gb-town-edit-tab-custom">
                                             <label><?= $this->lang->line('spec-form-label-nameTown') ?></label>
                                             <input type="text" class="form-control" placeholder="<?= $this->lang->line('spec-form-placeholder-nameTown') ?>" name="sim_town_name_gb" id="sim_town_name_gb" required>
                                        </div>
                                   </div>
                              </div>

                              <div class="modal-footer mt-5">
                                   <input type="hidden" type="text" name="sim_town_id" id="sim_town_id">
                                   <button type="button" class="btn btn-light" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                                   <button type="submit" class="btn btn-warning col-md-5"><?= $this->lang->line('btn-edit') ?></button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<div id="custom-update-type-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="customLabel" aria-modal="true">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel"><?= $this->lang->line('spec-header-update') ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body container">
                    <form class="row justify-content-center" action="<?php _url($module_base.'update_type'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 col-md-12">

                              <div class="form-group mb-3">
                                   <ul class="nav nav-pills nav-pills-custom mt-3" id="pills-type-edit-tab-custom" role="tablist">
                                        <li class="nav-item">
                                             <a class="nav-link active" id="pills-fr-type-edit-tab-custom" data-toggle="pill" href="#pills-fr-type-edit" role="tab" aria-controls="pills-fr-type-edit" aria-selected="true">
                                                  <?= $this->lang->line('label-french-title') ?>
                                             </a>
                                        </li>
                                        <li class="nav-item">
                                             <a class="nav-link" id="pills-gb-type-edit-tab-custom" data-toggle="pill" href="#pills-gb-type-edit" role="tab" aria-controls="pills-gb-type-edit" aria-selected="false">
                                                  <?= $this->lang->line('label-english-title') ?>
                                             </a>
                                        </li>
                                   </ul>

                                   <div class="tab-content tab-content-custom-pill" id="pills-tabContent-custom" style="margin-top:-30px;">
                                        <div class="tab-pane fade show active" id="pills-fr-type-edit" role="tabpanel" aria-labelledby="pills-fr-type-edit-tab-custom">
                                             <label><?= $this->lang->line('spec-form-label-nameType') ?></label>
                                             <input type="text" class="form-control" placeholder="<?= $this->lang->line('spec-form-placeholder-nameType') ?>" name="sim_type_name" id="sim_type_name" required>
                                        </div>
                                        <div class="tab-pane fade" id="pills-gb-type-edit" role="tabpanel" aria-labelledby="pills-gb-type-edit-tab-custom">
                                             <label><?= $this->lang->line('spec-form-label-nameType') ?></label>
                                             <input type="text" class="form-control" placeholder="<?= $this->lang->line('spec-form-placeholder-nameType') ?>" name="sim_type_name_gb" id="sim_type_name_gb" required>
                                        </div>
                                   </div>
                              </div>

                              <div class="modal-footer mt-5">
                                   <input type="hidden" type="text" name="sim_type_id" id="sim_type_id">
                                   <button type="button" class="btn btn-light" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                                   <button type="submit" class="btn btn-warning col-md-5"><?= $this->lang->line('btn-edit') ?></button>
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
                    <h4 class="modal-title" id="myCenterModalLabel"><?= $this->lang->line('spec-header-delete') ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'delete'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 mt-3">
                              <p style="text-align: center; font-size: 14px;">
                                   <?= $this->lang->line('spec-message-delete') ?>
                              </p>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" type="text" name="sim_state_id">
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                                   <button type="submit" class="btn btn-danger col-md-5"><?= $this->lang->line('btn-delete') ?></button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<div id="custom-delete-town-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel"><?= $this->lang->line('spec-header-delete') ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'delete_town'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 mt-3">
                              <p style="text-align: center; font-size: 14px;">
                                   <?= $this->lang->line('spec-message-deleteTown') ?>
                              </p>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" type="text" name="sim_town_id">
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                                   <button type="submit" class="btn btn-danger col-md-5"><?= $this->lang->line('btn-delete') ?></button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<div id="custom-delete-type-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel"><?= $this->lang->line('spec-header-delete') ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'delete_type'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 mt-3">
                              <p style="text-align: center; font-size: 14px;">
                                   <?= $this->lang->line('spec-message-deleteType') ?>
                              </p>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" type="text" name="sim_type_id">
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                                   <button type="submit" class="btn btn-danger col-md-5"><?= $this->lang->line('btn-delete') ?></button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>
