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
                              <a href="<?= _url($module_base.('showAdd')) ?>"  class="btn btn-success btn-icon-text float-right"><?= $this->lang->line('btn-add') ?> <i class="fa fa-plus btn-icon-append"></i> </a>
                         </div>
                    </div>
                    <div class="row mb-3">
                         <div class="col-sm-6 col-xl-4 col-lg-6">
                              <div class="card o-hidden">
                                   <div class="bg-primary b-r-4 card-body">
                                        <div class="media static-top-widget text-white">
                                             <div class="align-self-center text-center"><i data-feather="archive"></i></div>
                                             <div class="media-body"><span class="m-0"><?= $this->lang->line('label-all-title') ?></span>
                                                  <h4 class="mb-0 counter"><?= @count($datagrid_actif) + @count($datagrid_inactif) ?></h4>
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
                                                  <h4 class="mb-0 counter"><?= @count($datagrid_actif) ?></h4>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>

                         <div class="col-sm-6 col-xl-4 col-lg-6">
                              <div class="card o-hidden">
                                   <div class="bg-secondary b-r-4 card-body">
                                        <div class="media static-top-widget text-white">
                                             <div class="align-self-center text-center"><i data-feather="repeat"></i></div>
                                             <div class="media-body"><span class="m-0"><?= $this->lang->line('label-inac-title') ?></span>
                                                  <h4 class="mb-0 counter"><?= @count($datagrid_inactif) ?></h4>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>

                    <?php show_notification();?>

                    <ul class="nav nav-pills nav-pills-info mt-5" id="pills-tab" role="tablist">
                         <li class="nav-item">
                              <a class="nav-link active" id="pills-actif-tab" data-toggle="pill" href="#pills-actif" role="tab" aria-controls="pills-actif" aria-selected="true"><?= $this->lang->line('label-act-title') ?></a>
                         </li>
                         <li class="nav-item">
                              <a class="nav-link" id="pills-inactif-tab" data-toggle="pill" href="#pills-inactif" role="tab" aria-controls="pills-inactif" aria-selected="false"><?= $this->lang->line('label-inac-title') ?></a>
                         </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                         <div class="tab-pane fade show active" id="pills-actif" role="tabpanel" aria-labelledby="pills-actif-tab">
                              <div class="media">
                                   <div class="media-body">
                                        <div class="table-responsive">
                                             <table id="order-listing" class="table table-striped table-bordered">
                                                  <thead>
                                                       <tr>
                                                            <th class="text-center" style="width:30px;">#</th>
                                                            <th><?= $this->lang->line('studie-table-label-date') ?></th>
                                                            <th><?= $this->lang->line('studie-table-label-name') ?></th>
                                                            <th><?= $this->lang->line('studie-table-label-author') ?></th>
                                                            <!-- <th><?= $this->lang->line('studie-table-label-project') ?></th> -->
                                                            <th class="text-center" style="width: 70px;"><?= $this->lang->line('studie-table-label-action') ?></th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       <?php if(is_array(@$datagrid_actif)):?>
                                                            <?php foreach(@$datagrid_actif as $key => $rows):?>
                                                                 <tr>
                                                                      <td class="text-center"><?=@$key+1?></td>
                                                                      <td style="width: 150px;"><?= gmdate("d-m-Y H:i", @$rows->studie_added)?></td>
                                                                      <td><?= (@me('user_lang') == "english") ? @$rows->studie_name_gb : @$rows->studie_name ?></td>
                                                                      <td class="text-muted text-left"><?= @$rows->user_nicename ?></td>
                                                                      <!-- <td>
                                                                           <span class="badge badge-info"><?= @$rows->project_name ?></span>
                                                                      </td> -->
                                                                      <td class="footable-last-visible text-center">
                                                                           <div class="dropdown dropleft">
                                                                                <button class="btn p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                     <i class="mdi mdi-dots-horizontal card-menu-btn"></i>
                                                                                </button>
                                                                                <div class="dropdown-menu"  data-x-placement="left-start">
                                                                                     <a href="<?= _url($module_base.'showContent/'.$rows->studie_id) ?>" class="text-info dropdown-item" target="_blank"><i class="fa fa-clipboard mr-2"></i><?= $this->lang->line('btn-detail') ?></a>
                                                                                     <div class="dropdown-divider"></div>
                                                                                     <a href="#custom-lock-modal-<?= @$rows->studie_id ?>" class="text-light dropdown-item" data-toggle="modal"><i class="fa fa-lock mr-2"></i> <?= $this->lang->line('btn-lock') ?></a>
                                                                                     <div class="dropdown-divider"></div>
                                                                                     <a href="#custom-delete-modal" class="text-danger dropdown-item" data-toggle="modal" onclick="define_delete(<?= @$rows->studie_id ?>, 'studie_id')"><i class="fa fa-trash mr-2"></i> <?= $this->lang->line('btn-delete') ?></a>
                                                                                </div>
                                                                           </div>
                                                                      </td>
                                                                      <div id="custom-lock-modal-<?= @$rows->studie_id ?>" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
                                                                           <div class="modal-dialog modal-dialog-centered">
                                                                                <div class="modal-content">
                                                                                     <div class="modal-header">
                                                                                          <h4 class="modal-title" id="myCenterModalLabel">
                                                                                               <?php if ($rows->studie_locked == 1): ?>
                                                                                                    <?= $this->lang->line('studie-header-unlock') ?>
                                                                                               <?php else: ?>
                                                                                                    <?= $this->lang->line('studie-header-lock') ?>
                                                                                               <?php endif; ?>
                                                                                          </h4>
                                                                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                     </div>

                                                                                     <form class="row justify-content-center" action="<?php _url($module_base.'locker'); ?>" method="post" enctype="multipart/form-data">

                                                                                          <div class="modal-body">
                                                                                               <div class="col-12 mt-3 mb3">
                                                                                                    <p style="text-align: center; font-size: 14px;">
                                                                                                         <?= $this->lang->line('studie-message-update') ?>
                                                                                                    </p>
                                                                                               </div>
                                                                                          </div>

                                                                                          <div class="modal-footer">
                                                                                               <?php if ($rows->studie_locked == 1): ?>
                                                                                                    <input type="hidden" type="text" name="studie_locked" value="0">
                                                                                               <?php else: ?>
                                                                                                    <input type="hidden" type="text" name="studie_locked" value="1">
                                                                                               <?php endif; ?>
                                                                                               <input type="hidden" type="text" name="studie_id" value="<?= @$rows->studie_id ?>">
                                                                                               <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                                                                                               <button type="submit" class="btn btn-info col-md-4">
                                                                                                    <?php if ($rows->studie_locked == 1): ?>
                                                                                                         <?= $this->lang->line('btn-unlock') ?>
                                                                                                    <?php else: ?>
                                                                                                         <?= $this->lang->line('btn-lock') ?>
                                                                                                    <?php endif; ?>
                                                                                               </button>
                                                                                          </div>

                                                                                     </form>

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

                         <div class="tab-pane fade" id="pills-inactif" role="tabpanel" aria-labelledby="pills-inactif-tab">
                              <div class="media">
                                   <div class="media-body">
                                        <div class="table-responsive">
                                             <table id="order-listing-2" class="table table-striped table-bordered">
                                                  <thead>
                                                       <tr>
                                                            <th class="text-center" style="width:30px;">#</th>
                                                            <th><?= $this->lang->line('studie-table-label-date') ?></th>
                                                            <th><?= $this->lang->line('studie-table-label-name') ?></th>
                                                            <th><?= $this->lang->line('studie-table-label-author') ?></th>
                                                            <!-- <th><?= $this->lang->line('studie-table-label-project') ?></th> -->
                                                            <th class="text-center" style="width: 70px;"><?= $this->lang->line('studie-table-label-action') ?></th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       <?php if(is_array(@$datagrid_inactif)):?>
                                                            <?php foreach(@$datagrid_inactif as $key => $rows):?>
                                                                 <tr class="table-warning">
                                                                      <td class="text-center"><?=@$key+1?></td>
                                                                      <td style="width: 150px;"><?= gmdate("d-m-Y H:i", @$rows->studie_added)?></td>
                                                                      <td><?= @$rows->studie_name ?></td>
                                                                      <td class="text-muted text-left"><?= @$rows->user_nicename ?></td>
                                                                      <!-- <td>
                                                                           <span class="badge badge-info"><?= @$rows->project_name ?></span>
                                                                      </td> -->
                                                                      <td class="footable-last-visible text-center"  style="width: 70px;">
                                                                           <div class="dropdown dropleft">
                                                                                <button class="btn p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                     <i class="mdi mdi-dots-horizontal card-menu-btn"></i>
                                                                                </button>
                                                                                <div class="dropdown-menu"  data-x-placement="left-start">
                                                                                     <a href="<?= _url($module_base.'showContent/'.$rows->studie_id) ?>" class="text-info dropdown-item" target="_blank"><i class="fa fa-clipboard mr-2"></i><?= $this->lang->line('btn-detail') ?></a>
                                                                                     <div class="dropdown-divider"></div>
                                                                                     <a href="#custom-lock-modal-<?= @$rows->studie_id ?>" class="text-light dropdown-item" data-toggle="modal"><i class="fa fa-check mr-2"></i> <?= $this->lang->line('btn-unlock') ?></a>
                                                                                     <div class="dropdown-divider"></div>
                                                                                     <a href="#custom-delete-modal" class="text-danger dropdown-item" data-toggle="modal" onclick="define_delete(<?= @$rows->studie_id ?>, 'studie_id')"><i class="fa fa-trash mr-2"></i> <?= $this->lang->line('btn-delete') ?></a>
                                                                                </div>
                                                                           </div>
                                                                      </td>
                                                                      <div id="custom-lock-modal-<?= @$rows->studie_id ?>" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
                                                                           <div class="modal-dialog modal-dialog-centered">
                                                                                <div class="modal-content">
                                                                                     <div class="modal-header">
                                                                                          <h4 class="modal-title" id="myCenterModalLabel">
                                                                                               <?php if ($rows->studie_locked == 1): ?>
                                                                                                    <?= $this->lang->line('studie-header-unlock') ?>
                                                                                               <?php else: ?>
                                                                                                    <?= $this->lang->line('studie-header-lock') ?>
                                                                                               <?php endif; ?>
                                                                                          </h4>
                                                                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                     </div>

                                                                                     <form class="row justify-content-center" action="<?php _url($module_base.'locker'); ?>" method="post" enctype="multipart/form-data">

                                                                                          <div class="modal-body">
                                                                                               <div class="col-12 mt-3 mb3">
                                                                                                    <p style="text-align: center; font-size: 14px;">
                                                                                                         <?= $this->lang->line('studie-message-update') ?>
                                                                                                    </p>
                                                                                               </div>
                                                                                          </div>

                                                                                          <div class="modal-footer">
                                                                                               <?php if ($rows->studie_locked == 1): ?>
                                                                                                    <input type="hidden" type="text" name="studie_locked" value="0">
                                                                                               <?php else: ?>
                                                                                                    <input type="hidden" type="text" name="studie_locked" value="1">
                                                                                               <?php endif; ?>
                                                                                               <input type="hidden" type="text" name="studie_id" value="<?= @$rows->studie_id ?>">
                                                                                               <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                                                                                               <button type="submit" class="btn btn-info col-md-4">
                                                                                                    <?php if ($rows->studie_locked == 1): ?>
                                                                                                         <?= $this->lang->line('btn-unlock') ?>
                                                                                                    <?php else: ?>
                                                                                                         <?= $this->lang->line('btn-lock') ?>
                                                                                                    <?php endif; ?>
                                                                                               </button>
                                                                                          </div>

                                                                                     </form>

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
     </div>
</div>

<!-- Delete manager ///////////////////////////////////////////////////////////////////////////////////////////////// -->

<div id="custom-delete-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel"><?= $this->lang->line('studie-header-detail') ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'delete'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-12 mt-3">
                              <?= $this->lang->line('studie-message-delete') ?>

                         </div>
                         <div class="modal-footer mt-5 col-12">
                              <input type="hidden" type="text" name="studie_id" >
                              <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                              <button type="submit" class="btn btn-danger col-md-4"><?= $this->lang->line('btn-delete') ?></button>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>
