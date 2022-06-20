<div class="row">
     <div class="col-12">
          <div class="card">
               <div class="card-body">
                    <div class="card-title row mb-5">
                         <h3 class="col-7 font-weight-bold text-uppercase"><?= $title ?></h3>
                         <div class="col-5">
                              <a href="#custom-modal"  class="btn btn-success float-right btn-lg" data-toggle="modal"> <?= $this->lang->line('btn-add') ?> </a>
                         </div>
                    </div>
                    <?php show_notification();?>
                    <div class="table-responsive">
                         <table id="order-listing" class="table">
                              <thead>
                                   <tr>
                                        <th><?= $this->lang->line('country-table-label-shortName') ?></th>
                                        <th><?= $this->lang->line('country-table-label-iso2') ?></th>
                                        <th><?= $this->lang->line('country-table-label-iso3') ?></th>
                                        <th><?= $this->lang->line('country-table-label-numCode') ?></th>
                                        <th><?= $this->lang->line('country-table-label-callCode') ?></th>
                                        <th><?= $this->lang->line('country-table-label-cctld') ?></th>
                                        <th><?= $this->lang->line('country-table-label-member') ?></th>
                                        <th class="text-center" style="width: 120px;"><?= $this->lang->line('country-table-label-action') ?></th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <?php if(is_array(@$datagrid)):?>
                                        <?php foreach(@$datagrid as $key => $rows):?>
                                             <tr>
                                                  <td><?=@$rows->short_name?></td>
                                                  <td class="text-center"><?=@$rows->iso2?></td>
                                                  <td class="text-center"><?=@$rows->iso3?></td>
                                                  <td class="text-center"><?=@$rows->numcode?></td>
                                                  <td class="text-center"><?=@$rows->calling_code?></td>
                                                  <td class="text-center"><?=@$rows->cctld?></td>
                                                  <td class="text-center"><?=@$rows->un_member?></td>
                                                  <td class="footable-last-visible text-center">
                                                       <a href="#custom-update-modal" class="btn btn-small btn-outline-warning" data-toggle="modal" onclick="define_edit(<?= $rows->country_id ?>, 'settings/settings_country/showEdit')"><i class="fa fa-pencil"></i></a>
                                                       <a href="#custom-delete-modal" class="btn btn-small btn-outline-danger" data-toggle="modal" onclick="define_delete(<?= $rows->country_id ?>, 'country_id')"><i class="fa fa-trash"></i></a>
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
                    <h4 class="modal-title" id="myCenterModalLabel"><?= $this->lang->line('country-header-new') ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'insert'); ?>" method="post">
                         <div class="col-10 col-md-12">
                              <div class="job-filter">
                                   <div class="faq-form">
                                        <input class="form-control" type="text" placeholder="ISO 2" name="iso2" required><i class="search-icon" data-feather="plus"></i>
                                   </div>
                                   <div class="faq-form mt-3">
                                        <input class="form-control" type="text" placeholder="ISO 3" name="iso3" required><i class="search-icon" data-feather="hash"></i>
                                   </div>
                                   <div class="faq-form mt-3">
                                        <input class="form-control" type="text" placeholder="Short Name" name="short_name" required><i class="search-icon" data-feather="edit-3"></i>
                                   </div>
                                   <div class="faq-form mt-3">
                                        <input class="form-control" type="text" placeholder="Long Name" name="long_name" required><i class="search-icon" data-feather="text-justify"></i>
                                   </div>
                                   <div class="faq-form mt-3">
                                        <input class="form-control" type="text" placeholder="Num Code" name="numcode" required><i class="search-icon" data-feather="hash"></i>
                                   </div>
                                   <div class="faq-form mt-3">
                                        <input class="form-control" type="text" placeholder="Member" name="un_member" required><i class="search-icon" data-feather="hash"></i>
                                   </div>
                                   <div class="faq-form mt-3">
                                        <input class="form-control" type="text" placeholder="Calling code" name="calling_code" required><i class="search-icon" data-feather="hash"></i>
                                   </div>
                                   <div class="faq-form mt-3">
                                        <input class="form-control" type="text" placeholder="CCTLD" name="cctld" required><i class="search-icon" data-feather="hash"></i>
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
                    <h4 class="modal-title" id="myCenterModalLabel"><?= $this->lang->line('country-header-update') ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'update'); ?>" method="post">
                         <div class="col-12 col-md-12 mt-2">
                              <div class="job-filter">
                                   <div class="faq-form">
                                        <input class="form-control" type="text" placeholder="ISO 2" name="iso2" id="iso2" required><i class="search-icon" data-feather="plus"></i>
                                   </div>
                                   <div class="faq-form mt-3">
                                        <input class="form-control" type="text" placeholder="ISO 3" name="iso3" id="iso3" required><i class="search-icon" data-feather="hash"></i>
                                   </div>
                                   <div class="faq-form mt-3">
                                        <input class="form-control" type="text" placeholder="Short Name" name="short_name" id="short_name" required><i class="search-icon" data-feather="edit-3"></i>
                                   </div>
                                   <div class="faq-form mt-3">
                                        <input class="form-control" type="text" placeholder="Long Name" name="long_name" id="long_name" required><i class="search-icon" data-feather="text-justify"></i>
                                   </div>
                                   <div class="faq-form mt-3">
                                        <input class="form-control" type="text" placeholder="Num Code" name="numcode" id="numcode" required><i class="search-icon" data-feather="hash"></i>
                                   </div>
                                   <div class="faq-form mt-3">
                                        <input class="form-control" type="text" placeholder="Member" name="un_member" id="un_member" required><i class="search-icon" data-feather="hash"></i>
                                   </div>
                                   <div class="faq-form mt-3">
                                        <input class="form-control" type="text" placeholder="Calling code" name="calling_code" id="calling_code" required><i class="search-icon" data-feather="hash"></i>
                                   </div>
                                   <div class="faq-form mt-3">
                                        <input class="form-control" type="text" placeholder="CCTLD" name="cctld" id="cctld" required><i class="search-icon" data-feather="hash"></i>
                                   </div>
                              </div>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" class="form-control" name="country_id" id="country_id" required>
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
                    <h4 class="modal-title" id="myCenterModalLabel"><?= $this->lang->line('country-header-delete') ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'delete'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 mt-2">
                              <p style="text-align: center; font-size: 14px;">
                                   <?= $this->lang->line('country-message-delete') ?>
                              </p>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" type="text" name="country_id">
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                                   <button type="submit" class="btn btn-danger col-md-4"><?= $this->lang->line('btn-delete') ?></button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>
