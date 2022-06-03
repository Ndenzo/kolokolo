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
                         <h4 class="col-7 font-weight-bold text-uppercase"><?= $this->lang->line('investor-title') ?> </h4>
                    </div>
                    <div class="row mb-3">

                         <div class="col-sm-6 col-xl-3 col-lg-6">
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

                         <div class="col-sm-6 col-xl-3 col-lg-6">
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

                         <div class="col-sm-6 col-xl-3 col-lg-6">
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

                         <div class="col-sm-6 col-xl-3 col-lg-6">
                              <div class="card o-hidden">
                                   <div class="bg-danger b-r-4 card-body">
                                        <div class="media static-top-widget text-white">
                                             <div class="align-self-center text-center"><i data-feather="x"></i></div>
                                             <div class="media-body"><span class="m-0"><?= $this->lang->line('label-lock-title') ?></span>
                                                  <h4 class="mb-0 counter"><?=  @count(@$datagrid_locked)  ?></h4>
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
                              <a class="nav-link" id="pills-inactif-tab" data-toggle="pill" href="#pills-inactif" role="tab" aria-controls="pills-inactif" aria-selected="false"><?= $this->lang->line('label-inac-title') ?>
                                   <?php if (@count(get_investor_notif()) > 0): ?>
                                        <span class="text-warning" style="font-size: 15px;">*</span>
                                   <?php endif; ?>
                              </a>
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
                                                            <th><?= $this->lang->line('investor-table-label-date') ?></th>
                                                            <th><?= $this->lang->line('investor-table-label-fullname') ?></th>
                                                            <th><?= $this->lang->line('investor-table-label-email') ?></th>
                                                            <th><?= $this->lang->line('investor-table-label-statut') ?></th>
                                                            <th class="text-center" style="width: 70px;"><?= $this->lang->line('investor-table-label-action') ?></th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       <?php if(is_array(@$datagrid_actif)):?>
                                                            <?php foreach(@$datagrid_actif as $key => $rows):?>
                                                                 <tr>
                                                                      <td class="text-center"><?=@$key+1?></td>
                                                                      <td><?= gmdate("d-m-Y H:i", @$rows->investor_added)?></td>
                                                                      <td><?= @$rows->user_nicename ?></td>
                                                                      <td><?= @$rows->user_email ?></td>
                                                                      <td>
                                                                           <span class="badge badge-success"><?= @$rows->role_name ?></span>
                                                                      </td>
                                                                      <td class="footable-last-visible text-center">
                                                                           <div class="dropdown dropleft">
                                                                                <button class="btn p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                     <i class="mdi mdi-dots-horizontal card-menu-btn"></i>
                                                                                </button>
                                                                                <div class="dropdown-menu"  data-x-placement="left-start">
                                                                                     <a href="#custom-lock-modal-<?= @$rows->investor_id ?>" class="text-info dropdown-item" data-toggle="modal"><i class="fa fa-lock mr-2"></i> <?= $this->lang->line('btn-lock') ?></a>
                                                                                     <a href="#custom-profile-modal-<?= @$rows->investor_id ?>" class="text-info dropdown-item" data-toggle="modal"><i class="fa fa-user-circle mr-2"></i><?= $this->lang->line('btn-profil') ?></a>
                                                                                     <div class="dropdown-divider"></div>
                                                                                     <a href="#custom-update-modal-<?= @$rows->investor_id ?>" class="text-warning dropdown-item" data-toggle="modal" onclick="define_edit(<?= @$rows->investor_id ?>, 'actor/investor/showEdit')"><i class="fa fa-pencil mr-2"></i> <?= $this->lang->line('btn-edit') ?></a>
                                                                                     <a href="#custom-delete-modal" class="text-danger dropdown-item" data-toggle="modal" onclick="define_delete(<?= @$rows->investor_id ?>, 'investor_id')"><i class="fa fa-trash mr-2"></i> <?= $this->lang->line('btn-delete') ?></a>
                                                                                </div>
                                                                           </div>
                                                                      </td>
                                                                      <div id="custom-lock-modal-<?= @$rows->investor_id ?>" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
                                                                           <div class="modal-dialog modal-dialog-centered">
                                                                                <div class="modal-content">
                                                                                     <div class="modal-header">
                                                                                          <h4 class="modal-title" id="myCenterModalLabel">
                                                                                               <?php if ($rows->locked == 1): ?>
                                                                                                    <?= $this->lang->line('investor-header-unlock') ?> | <?=$rows->user_nicename?>
                                                                                               <?php else: ?>
                                                                                                    <?= $this->lang->line('investor-header-lock') ?> | <?=$rows->user_nicename?>
                                                                                               <?php endif; ?>
                                                                                          </h4>
                                                                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                     </div>
                                                                                     <div class="modal-body">
                                                                                          <form class="row justify-content-center" action="<?php _url($module_base.'locker'); ?>" method="post" enctype="multipart/form-data">
                                                                                               <div class="col-12 mt-3">
                                                                                                    <p style="text-align: center; font-size: 14px;">
                                                                                                         <?= $this->lang->line('investor-message-update') ?>
                                                                                                    </p>
                                                                                                    <div class="modal-footer mt-3">
                                                                                                         <?php if ($rows->locked == 1): ?>
                                                                                                              <input type="hidden" type="text" name="locked" value="0">
                                                                                                         <?php else: ?>
                                                                                                              <input type="hidden" type="text" name="locked" value="1">
                                                                                                         <?php endif; ?>
                                                                                                         <input type="hidden" type="text" name="user_id" value="<?= @$rows->user_id ?>">
                                                                                                         <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                                                                                                         <button type="submit" class="btn btn-info col-md-4">
                                                                                                              <?php if ($rows->locked == 1): ?>
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
                                                                      <div id="custom-update-modal-<?= @$rows->investor_id ?>" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
                                                                           <div class="modal-dialog modal-dialog-centered">
                                                                                <div class="modal-content">
                                                                                     <div class="modal-header">
                                                                                          <h4 class="modal-title" id="myCenterModalLabel">
                                                                                               <?= $this->lang->line('investor-header-profileChange') ?>
                                                                                          </h4>
                                                                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                     </div>
                                                                                     <div class="modal-body">
                                                                                          <form class="row justify-content-center" method="post" action="<?php _url($module_base.'update_profile'); ?>">

                                                                                               <div class="col-12">
                                                                                                    <div class="alert alert-warning inverse alert-dismissible fade show" role="alert">
                                                                                                         <p class="mt-2" style="font-size: 12px;">
                                                                                                              <?= $this->lang->line('investor-message-profileChange') ?> <strong><?= @$rows->user_nicename ?></strong> !
                                                                                                         </p>
                                                                                                    </div>
                                                                                                    <div class="faq-form">
                                                                                                         <label><?= $this->lang->line('investor-form-label-selectProfile') ?></label>
                                                                                                         <?php dropDown('SELECT role_id, role_name FROM users_roles WHERE role_id != '.@$rows->role_id.' AND  role_code != "root"',array(
                                                                                                              'name' => 'role_id',
                                                                                                              'id' => "role_id",
                                                                                                              'class' => 'form-control select_custom',
                                                                                                              'attr' => ' title="-- Choisir --" required',
                                                                                                         ));?>
                                                                                                    </div>
                                                                                                    <div class="modal-footer mt-5">
                                                                                                         <input type="hidden" type="text" name="user_id" value="<?= @$rows->user_id ?>">
                                                                                                         <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                                                                                                         <button type="submit" class="btn btn-warning col-md-4">
                                                                                                              <?= $this->lang->line('btn-edit') ?>
                                                                                                         </button>
                                                                                                    </div>
                                                                                               </div>
                                                                                          </form>
                                                                                     </div>
                                                                                </div><!-- /.modal-content -->
                                                                           </div><!-- /.modal-dialog -->
                                                                      </div>
                                                                      <div id="custom-profile-modal-<?= @$rows->investor_id ?>" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
                                                                           <div class="modal-dialog" style="max-width: 40%!important;">
                                                                                <div class="modal-content">
                                                                                     <div class="modal-header">
                                                                                          <h4 class="modal-title" id="myCenterModalLabel">
                                                                                               <?= $this->lang->line('investor-header-detail') ?>
                                                                                          </h4>
                                                                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                     </div>
                                                                                     <div class="modal-body">
                                                                                          <div class="row">
                                                                                               <div class="col-12">
                                                                                                    <div class="border-bottom text-center pb-4">
                                                                                                         <?php if (@$rows->person_picture == null): ?>
                                                                                                              <img src="https://via.placeholder.com/92x92" alt="profile" class="img-lg rounded-circle mb-3" style="height: 120px; width: 120px;"/>

                                                                                                         <?php else: ?>
                                                                                                              <img src="<?= _url(@$rows->person_picture) ?>" alt="profile" class="img-lg rounded-circle mb-3" style="height: 120px; width: 120px;"/>
                                                                                                         <?php endif; ?>
                                                                                                         <div class="mb-3">
                                                                                                              <h3><?= @$rows->user_nicename ?></h3>
                                                                                                              <div class="d-flex align-items-center justify-content-center">
                                                                                                                   <h5 class="mb-0 mr-2 text-muted"><?= @$rows->user_email ?></h5>
                                                                                                              </div>
                                                                                                         </div>
                                                                                                    </div>
                                                                                                    <!-- <div class="border-bottom py-4">
                                                                                                         <p>Invested Project</p>
                                                                                                         <div>
                                                                                                              <label class="badge badge-outline-dark">Chalk</label>
                                                                                                              <label class="badge badge-outline-dark">Hand lettering</label>
                                                                                                              <label class="badge badge-outline-dark">Information Design</label>
                                                                                                              <label class="badge badge-outline-dark">Graphic Design</label>
                                                                                                              <label class="badge badge-outline-dark">Web Design</label>
                                                                                                         </div>
                                                                                                    </div> -->
                                                                                                    <!-- <div class="border-bottom py-4">
                                                                                                         <div class="d-flex mb-3">
                                                                                                              <div class="progress progress-md flex-grow">
                                                                                                                   <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="55" style="width: 55%" aria-valuemin="0" aria-valuemax="100"></div>
                                                                                                              </div>
                                                                                                         </div>
                                                                                                         <div class="d-flex">
                                                                                                              <div class="progress progress-md flex-grow">
                                                                                                                   <div class="progress-bar bg-success" role="progressbar" aria-valuenow="75" style="width: 75%" aria-valuemin="0" aria-valuemax="100"></div>
                                                                                                              </div>
                                                                                                         </div>
                                                                                                    </div> -->
                                                                                                    <div class="py-4">
                                                                                                         <p class="clearfix">
                                                                                                              <span class="float-left">
                                                                                                                   Téléphone
                                                                                                              </span>
                                                                                                              <span class="float-right text-muted">
                                                                                                                   +<?= id_getter('calling_code','settings_countries','iso2', @$rows->person_country_phone_1)  ?> <?= @$rows->person_phone_1 ?>
                                                                                                              </span>
                                                                                                         </p>
                                                                                                         <p class="clearfix">
                                                                                                              <span class="float-left">
                                                                                                                   Date et Lieu de Naissance
                                                                                                              </span>
                                                                                                              <span class="float-right text-muted">
                                                                                                                   <?= @$rows->person_birth_date ?>, <?= @$rows->person_birth_place ?>
                                                                                                              </span>
                                                                                                         </p>
                                                                                                         <p class="clearfix">
                                                                                                              <span class="float-left">
                                                                                                                   Profession
                                                                                                              </span>
                                                                                                              <span class="float-right text-muted">
                                                                                                                   <?= @$rows->investor_profession ?>
                                                                                                              </span>
                                                                                                         </p>
                                                                                                         <p class="clearfix">
                                                                                                              <span class="float-left">
                                                                                                                   Secteur
                                                                                                              </span>
                                                                                                              <span class="float-right text-muted">
                                                                                                                   <?= @$rows->investor_sector ?>
                                                                                                              </span>
                                                                                                         </p>
                                                                                                         <p class="clearfix">
                                                                                                              <span class="float-left">
                                                                                                                   Profil
                                                                                                              </span>
                                                                                                              <span class="float-right text-muted">
                                                                                                                   <span class="badge badge-success"><?= @$rows->role_name ?></span>
                                                                                                              </span>
                                                                                                         </p>
                                                                                                    </div>
                                                                                               </div>

                                                                                          </div>
                                                                                     </div>
                                                                                     <div class="modal-footer mt-5">
                                                                                          <button type="button" class="btn btn-secondary col-6 ml-auto mr-auto" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
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

                         <div class="tab-pane fade" id="pills-inactif" role="tabpanel" aria-labelledby="pills-inactif-tab">
                              <div class="media">
                                   <div class="media-body">
                                        <div class="table-responsive">
                                             <table id="order-listing-2" class="table table-striped table-bordered">
                                                  <thead>
                                                       <tr>
                                                            <th class="text-center" style="width:30px;">#</th>
                                                            <th><?= $this->lang->line('investor-table-label-date') ?></th>
                                                            <th><?= $this->lang->line('investor-table-label-fullname') ?></th>
                                                            <th><?= $this->lang->line('investor-table-label-email') ?></th>
                                                            <th><?= $this->lang->line('investor-table-label-statut') ?></th>
                                                            <th class="text-center" style="width: 70px;"><?= $this->lang->line('investor-table-label-action') ?></th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       <?php if(is_array(@$datagrid_inactif)):?>
                                                            <?php foreach(@$datagrid_inactif as $key => $rows):?>
                                                                 <tr>
                                                                      <td class="text-center"><?=@$key+1?></td>
                                                                      <td><?= gmdate("d-m-Y H:i", $rows->investor_added)?></td>
                                                                      <td><?=$rows->user_nicename?></td>
                                                                      <td><?=$rows->user_email?></td>
                                                                      <td>
                                                                           <?php if ($rows->locked == 1): ?>
                                                                                <span class="badge badge-warning"><?= $this->lang->line('investor-badge-lock') ?></span>
                                                                           <?php else: ?>
                                                                                <?php if ($rows->investor_locked == 1): ?>
                                                                                     <span class="badge badge-secondary"><?= $this->lang->line('investor-badge-invalid') ?></span>
                                                                                <?php else: ?>
                                                                                     <?php if ($rows->investor_locked == 2): ?>
                                                                                          <span class="badge badge-info"><?= $this->lang->line('investor-badge-pending') ?></span>
                                                                                     <?php endif; ?>
                                                                                <?php endif; ?>
                                                                           <?php endif; ?>
                                                                      </td>
                                                                      <td class="footable-last-visible text-center"  style="width: 70px;">
                                                                           <div class="dropdown dropleft">
                                                                                <button class="btn p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                     <i class="mdi mdi-dots-horizontal card-menu-btn"></i>
                                                                                </button>
                                                                                <div class="dropdown-menu"  data-x-placement="left-start">
                                                                                     <?php if ($rows->locked == 1): ?>
                                                                                          <a href="#custom-lock-modal-<?= @$rows->investor_id ?>" class="text-info dropdown-item" data-toggle="modal"><i class="fa fa-unlock mr-2"></i> <?= $this->lang->line('btn-unlock') ?></a>
                                                                                          <a href="#custom-profile-modal-<?= @$rows->investor_id ?>" class="text-info dropdown-item" data-toggle="modal"><i class="fa fa-user-circle mr-2"></i><?= $this->lang->line('btn-profil') ?></a>
                                                                                          <div class="dropdown-divider"></div>
                                                                                     <?php else: ?>
                                                                                          <?php if ($rows->investor_locked == 2): ?>
                                                                                               <a href="#custom-activate-modal-<?= @$rows->investor_id ?>" class="text-info dropdown-item" data-toggle="modal"><i class="fa fa-check mr-2"></i> <?= $this->lang->line('btn-autorise') ?></a>
                                                                                               <div class="dropdown-divider"></div>
                                                                                          <?php else: ?>
                                                                                               <?php if ($rows->investor_locked != 1): ?>
                                                                                                    <a href="#custom-activate-modal-<?= @$rows->investor_id ?>" class="text-info dropdown-item" data-toggle="modal"><i class="fa fa-unlock mr-2"></i> <?= $this->lang->line('btn-unlock') ?></a>
                                                                                                    <div class="dropdown-divider"></div>
                                                                                               <?php endif; ?>
                                                                                          <?php endif; ?>
                                                                                     <?php endif; ?>
                                                                                     <?php if ($rows->investor_locked != 1): ?>
                                                                                          <a href="#custom-update-modal" class="text-warning dropdown-item" data-toggle="modal" onclick="define_edit(<?= @$rows->investor_id ?>, 'actor/investor/showEdit')"><i class="fa fa-pencil mr-2"></i> <?= $this->lang->line('btn-edit') ?></a>
                                                                                     <?php endif; ?>
                                                                                     <a href="#custom-delete-modal" class="text-danger dropdown-item" data-toggle="modal" onclick="define_delete(<?= @$rows->investor_id ?>, 'investor_id')"><i class="fa fa-trash mr-2"></i> <?= $this->lang->line('btn-delete') ?></a>
                                                                                </div>
                                                                           </div>
                                                                      </td>
                                                                      <div id="custom-lock-modal-<?= @$rows->investor_id ?>" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
                                                                           <div class="modal-dialog modal-dialog-centered">
                                                                                <div class="modal-content">
                                                                                     <div class="modal-header">
                                                                                          <h4 class="modal-title" id="myCenterModalLabel">
                                                                                               <?php if ($rows->locked == 1): ?>
                                                                                                    <?= $this->lang->line('investor-header-unlock') ?> | <?=$rows->user_nicename?>
                                                                                               <?php else: ?>
                                                                                                    <?= $this->lang->line('investor-header-lock') ?> | <?=$rows->user_nicename?>
                                                                                               <?php endif; ?>
                                                                                          </h4>
                                                                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                     </div>
                                                                                     <div class="modal-body">
                                                                                          <form class="row justify-content-center" action="<?php _url($module_base.'locker'); ?>" method="post" enctype="multipart/form-data">
                                                                                               <div class="col-12 mt-3">
                                                                                                    <p style="text-align: center; font-size: 14px;">
                                                                                                         <?= $this->lang->line('investor-message-update') ?>
                                                                                                    </p>
                                                                                                    <div class="modal-footer mt-3">
                                                                                                         <?php if ($rows->locked == 1): ?>
                                                                                                              <input type="hidden" type="text" name="locked" value="0">
                                                                                                         <?php else: ?>
                                                                                                              <input type="hidden" type="text" name="locked" value="1">
                                                                                                         <?php endif; ?>
                                                                                                         <input type="hidden" type="text" name="user_id" value="<?= @$rows->user_id ?>">
                                                                                                         <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                                                                                                         <button type="submit" class="btn btn-info col-md-4">
                                                                                                              <?php if ($rows->locked == 1): ?>
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
                                                                      <div id="custom-activate-modal-<?= @$rows->investor_id ?>" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
                                                                           <div class="modal-dialog modal-dialog-centered">
                                                                                <div class="modal-content">
                                                                                     <div class="modal-header">
                                                                                          <h4 class="modal-title" id="myCenterModalLabel"><?= $this->lang->line('investor-header-autorise') ?> | <?=$rows->user_nicename?></h4>
                                                                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                     </div>
                                                                                     <div class="modal-body">
                                                                                          <form class="row justify-content-center" action="<?php _url($module_base.'investor_locker'); ?>" method="post" enctype="multipart/form-data">
                                                                                               <div class="col-12 mt-3">
                                                                                                    <p style="text-align: center; font-size: 14px;">
                                                                                                         <?= $this->lang->line('investor-message-update') ?>
                                                                                                    </p>
                                                                                                    <div class="modal-footer mt-3">
                                                                                                         <input type="hidden" type="text" name="investor_locked" value="0">
                                                                                                         <input type="hidden" type="text" name="investor_id" value="<?= @$rows->investor_id ?>">
                                                                                                         <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                                                                                                         <button type="submit" class="btn btn-success col-md-4">Autoriser</button>
                                                                                                    </div>
                                                                                               </div>
                                                                                          </form>
                                                                                     </div>
                                                                                </div><!-- /.modal-content -->
                                                                           </div><!-- /.modal-dialog -->
                                                                      </div>
                                                                      <div id="custom-profile-modal-<?= @$rows->investor_id ?>" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
                                                                           <div class="modal-dialog" style="max-width: 40%!important;">
                                                                                <div class="modal-content">
                                                                                     <div class="modal-header">
                                                                                          <h4 class="modal-title" id="myCenterModalLabel">
                                                                                               <?= $this->lang->line('investor-header-detail') ?>
                                                                                          </h4>
                                                                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                     </div>
                                                                                     <div class="modal-body">
                                                                                          <div class="row">
                                                                                               <div class="col-12">
                                                                                                    <div class="border-bottom text-center pb-4">
                                                                                                         <?php if (@$rows->person_picture == null): ?>
                                                                                                              <img src="https://via.placeholder.com/92x92" alt="profile" class="img-lg rounded-circle mb-3" style="height: 120px; width: 120px;"/>

                                                                                                         <?php else: ?>
                                                                                                              <img src="<?= _url(@$rows->person_picture) ?>" alt="profile" class="img-lg rounded-circle mb-3" style="height: 120px; width: 120px;"/>
                                                                                                         <?php endif; ?>
                                                                                                         <div class="mb-3">
                                                                                                              <h3><?= @$rows->user_nicename ?></h3>
                                                                                                              <div class="d-flex align-items-center justify-content-center">
                                                                                                                   <h5 class="mb-0 mr-2 text-muted"><?= @$rows->user_email ?></h5>
                                                                                                              </div>
                                                                                                         </div>
                                                                                                    </div>
                                                                                                    <!-- <div class="border-bottom py-4">
                                                                                                         <p>Invested Project</p>
                                                                                                         <div>
                                                                                                              <label class="badge badge-outline-dark">Chalk</label>
                                                                                                              <label class="badge badge-outline-dark">Hand lettering</label>
                                                                                                              <label class="badge badge-outline-dark">Information Design</label>
                                                                                                              <label class="badge badge-outline-dark">Graphic Design</label>
                                                                                                              <label class="badge badge-outline-dark">Web Design</label>
                                                                                                         </div>
                                                                                                    </div> -->
                                                                                                    <!-- <div class="border-bottom py-4">
                                                                                                         <div class="d-flex mb-3">
                                                                                                              <div class="progress progress-md flex-grow">
                                                                                                                   <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="55" style="width: 55%" aria-valuemin="0" aria-valuemax="100"></div>
                                                                                                              </div>
                                                                                                         </div>
                                                                                                         <div class="d-flex">
                                                                                                              <div class="progress progress-md flex-grow">
                                                                                                                   <div class="progress-bar bg-success" role="progressbar" aria-valuenow="75" style="width: 75%" aria-valuemin="0" aria-valuemax="100"></div>
                                                                                                              </div>
                                                                                                         </div>
                                                                                                    </div> -->
                                                                                                    <div class="py-4">
                                                                                                         <p class="clearfix">
                                                                                                              <span class="float-left">
                                                                                                                   Téléphone
                                                                                                              </span>
                                                                                                              <span class="float-right text-muted">
                                                                                                                   +<?= id_getter('calling_code','settings_countries','iso2', @$rows->person_country_phone_1)  ?> <?= @$rows->person_phone_1 ?>
                                                                                                              </span>
                                                                                                         </p>
                                                                                                         <p class="clearfix">
                                                                                                              <span class="float-left">
                                                                                                                   Date et Lieu de Naissance
                                                                                                              </span>
                                                                                                              <span class="float-right text-muted">
                                                                                                                   <?= @$rows->person_birth_date ?>, <?= @$rows->person_birth_place ?>
                                                                                                              </span>
                                                                                                         </p>
                                                                                                         <p class="clearfix">
                                                                                                              <span class="float-left">
                                                                                                                   Profession
                                                                                                              </span>
                                                                                                              <span class="float-right text-muted">
                                                                                                                   <?= @$rows->investor_profession ?>
                                                                                                              </span>
                                                                                                         </p>
                                                                                                         <p class="clearfix">
                                                                                                              <span class="float-left">
                                                                                                                   Secteur
                                                                                                              </span>
                                                                                                              <span class="float-right text-muted">
                                                                                                                   <?= @$rows->investor_sector ?>
                                                                                                              </span>
                                                                                                         </p>
                                                                                                         <p class="clearfix">
                                                                                                              <span class="float-left">
                                                                                                                   Profil
                                                                                                              </span>
                                                                                                              <span class="float-right text-muted">
                                                                                                                   <span class="badge badge-warning"><?= $this->lang->line('investor-badge-lock') ?></span>
                                                                                                              </span>
                                                                                                         </p>
                                                                                                    </div>
                                                                                               </div>

                                                                                          </div>
                                                                                     </div>
                                                                                     <div class="modal-footer mt-5">
                                                                                          <button type="button" class="btn btn-secondary col-6 ml-auto mr-auto" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
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
     </div>
</div>

<!-- Delete manager ///////////////////////////////////////////////////////////////////////////////////////////////// -->

<div id="custom-delete-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel"><?= $this->lang->line('investor-header-delete') ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'delete'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 mt-3">
                              <p style="text-align: center; font-size: 14px;">
                                   <?= $this->lang->line('investor-message-delete') ?>
                              </p>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" type="text" name="investor_id">
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                                   <button type="submit" class="btn btn-danger col-md-4"><?= $this->lang->line('btn-delete') ?></button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>
