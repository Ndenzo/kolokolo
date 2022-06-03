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
                              <a href="<?= _url($module_base."showAdd") ?>"  class="btn btn-success btn-icon-text float-right"><?= $this->lang->line('btn-add') ?> <i class="fa fa-plus btn-icon-append"></i></a>
                         </div>
                    </div>
                    <div class="row mb-3">
                         <div class="col-sm-6 col-xl-4 col-lg-6">
                              <div class="card o-hidden">
                                   <div class="bg-primary b-r-4 card-body">
                                        <div class="media static-top-widget text-white">
                                             <div class="align-self-center text-center"><i data-feather="archive"></i></div>
                                             <div class="media-body"><span class="m-0"><?= $this->lang->line('label-all-title') ?></span>
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
                                             <div class="media-body"><span class="m-0"><?= $this->lang->line('label-act-title') ?></span>
                                                  <h4 class="mb-0 counter"><?= @count($datagrid) - @count($datagrid_locked) ?></h4>
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
                                                  <h4 class="mb-0 counter"><?= @count($datagrid_locked) ?></h4>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>

                    <?php show_notification();?>

                    <div class="media mt-5">
                         <div class="media-body">
                              <div class="table-responsive">
                                   <table id="order-listing" class="table table-striped table-bordered">
                                        <thead>
                                             <tr>
                                                  <th class="text-center" style="width:30px;">#</th>
                                                  <th class="text-center" style="width: 120px;"><?= $this->lang->line('project-table-label-date') ?></th>
                                                  <th><?= $this->lang->line('project-table-label-project') ?></th>
                                                  <th><?= $this->lang->line('project-table-label-address') ?></th>
                                                  <th class="text-center" style="width: 120px;"><?= $this->lang->line('project-table-label-value') ?></th>
                                                  <th class="text-center" style="width: 70px;"><?= $this->lang->line('project-table-label-action') ?></th>
                                             </tr>
                                        </thead>
                                        <tbody>
                                             <?php if(is_array(@$datagrid)):?>
                                                  <?php foreach(@$datagrid as $key => $rows):?>
                                                       <tr <?php if (@$rows->project_locked == 1): ?>class="table-warning"<?php endif; ?>>
                                                            <td class="text-center"><?=@$key+1?></td>
                                                            <td class="text-center"><?= gmdate("d-m-Y H:i", @$rows->project_added)?></td>
                                                            <td><?= @$rows->project_name ?></td>
                                                            <td><?= @$rows->project_address ?></td>
                                                            <td class="text-center">
                                                                 <span class="badge badge-info"><?= @thousand($rows->project_value) ?>F CFA</span>
                                                            </td>
                                                            <td class="footable-last-visible text-center">
                                                                 <div class="dropdown dropleft">
                                                                      <button class="btn p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                           <i class="mdi mdi-dots-horizontal card-menu-btn"></i>
                                                                      </button>
                                                                      <div class="dropdown-menu"  data-x-placement="left-start">
                                                                           <a href="<?= _url($module_base.'showDetail/'.@$rows->project_id) ?>" class="text-info dropdown-item"><i class="fa fa-clipboard mr-2"></i> <?= $this->lang->line('btn-detail') ?></a>
                                                                           <div class="dropdown-divider"></div>
                                                                           <?php if ($rows->project_locked == 1): ?>
                                                                                <a href="#custom-lock-modal-<?= @$rows->project_id ?>" class="dropdown-item" data-toggle="modal"><i class="fa fa-unlock mr-2"></i> <?= $this->lang->line('btn-unlock') ?></a>
                                                                           <?php else: ?>
                                                                                <a href="#custom-lock-modal-<?= @$rows->project_id ?>" class="dropdown-item" data-toggle="modal"><i class="fa fa-lock mr-2"></i> <?= $this->lang->line('btn-lock') ?></a>
                                                                           <?php endif; ?>
                                                                           <div class="dropdown-divider"></div>
                                                                           <a href="<?= _url($module_base.'showEdit/'.@$rows->project_id) ?>" class="text-warning dropdown-item"><i class="fa fa-pencil mr-2"></i> <?= $this->lang->line('btn-edit') ?></a>
                                                                           <a href="#custom-delete-modal" class="text-danger dropdown-item" data-toggle="modal" onclick="define_delete(<?= @$rows->project_id ?>, 'project_id')"><i class="fa fa-trash mr-2"></i> <?= $this->lang->line('btn-delete') ?></a>
                                                                      </div>
                                                                 </div>
                                                            </td>
                                                            <div id="custom-lock-modal-<?= @$rows->project_id ?>" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
                                                                 <div class="modal-dialog modal-dialog-centered">
                                                                      <div class="modal-content">
                                                                           <div class="modal-header">
                                                                                <h4 class="modal-title" id="myCenterModalLabel">
                                                                                     <?php if ($rows->project_locked == 1): ?>
                                                                                          <?= $this->lang->line('project-header-unlock') ?> | <?=$rows->project_name?>
                                                                                     <?php else: ?>
                                                                                          <?= $this->lang->line('project-header-lock') ?> | <?=$rows->project_name?>
                                                                                     <?php endif; ?>
                                                                                </h4>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                           </div>
                                                                           <div class="modal-body">
                                                                                <form class="row justify-content-center" action="<?php _url($module_base.'locker'); ?>" method="post" enctype="multipart/form-data">
                                                                                     <div class="col-12">
                                                                                          <p style="text-align: center; font-size: 14px;">
                                                                                               <?= $this->lang->line('project-message-update') ?>
                                                                                          </p>

                                                                                     </div>
                                                                                     <div class="modal-footer mt-3">
                                                                                          <?php if ($rows->project_locked == 1): ?>
                                                                                               <input type="hidden" type="text" name="project_locked" value="0">
                                                                                          <?php else: ?>
                                                                                               <input type="hidden" type="text" name="project_locked" value="1">
                                                                                          <?php endif; ?>
                                                                                          <input type="hidden" type="text" name="project_id" value="<?= @$rows->project_id ?>">
                                                                                          <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                                                                                          <button type="submit" class="btn btn-info col-md-6">
                                                                                               <?php if ($rows->project_locked == 1): ?>
                                                                                                    <?= $this->lang->line('btn-unlock') ?>
                                                                                               <?php else: ?>
                                                                                                    <?= $this->lang->line('btn-lock') ?>
                                                                                               <?php endif; ?>
                                                                                          </button>
                                                                                     </div>
                                                                                </form>
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


<!-- Delete manager ///////////////////////////////////////////////////////////////////////////////////////////////// -->

<div id="custom-delete-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel"><?= $this->lang->line('project-header-delete') ?> </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'delete'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-12 mt-2">
                              <p style="text-align: center; font-size: 14px;">
                                   <?= $this->lang->line('project-message-delete') ?>
                              </p>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" type="text" name="project_id">
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                                   <button type="submit" class="btn btn-danger col-md-4"><?= $this->lang->line('btn-delete') ?></button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>
