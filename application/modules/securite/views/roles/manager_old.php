<div class="body_scroll">
     <div class="block-header">
          <div class="row">
               <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2><?= $title ?> Page</h2>
                    <ul class="breadcrumb">
                         <li class="breadcrumb-item"><a href="<?= _url('dashboard') ?>"><i class="zmdi zmdi-home"></i> Dashboard</a></li>
                         <li class="breadcrumb-item active">Security</li>
                         <li class="breadcrumb-item active"><?= $title ?></li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
               </div>
               <div class="col-lg-5 col-md-6 col-sm-12 text-right">
                    <a href="#custom-modal" class="btn bg-success btn-icon" title="Add new ..." data-toggle="modal"><i class="zmdi zmdi-plus"></i></a>
                    <a href="#search" class="btn bg-pink btn-icon main_search" title="Search..."><i class="zmdi zmdi-search"></i></a>
                    <button class="btn btn-primary btn-icon right_icon_toggle_btn" type="button" title="Hide sidebar..."><i class="zmdi zmdi-arrow-right"></i></button>
               </div>
          </div>
     </div>
     <?php show_notification();?>
     <div class="container-fluid">
          <div class="row clearfix">
               <div class="col-lg-12">
                    <div class="table-responsive">
                         <table class="table table-hover mb-0 c_list c_table theme-color">
                              <thead>
                                   <tr>
                                        <th>#</th>
                                        <th>code</th>
                                        <th data-breakpoints="xs">label</th>
                                        <th data-breakpoints="xs sm md">Description</th>
                                        <th data-breakpoints="xs" class="text-center">Action</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <tr>
                                        <?php if(is_array(@$datagrid)):?>
                                             <?php foreach(@$datagrid as $rows):?>
                                                  <tr style="">
                                                       <td>
                                                            <div class="checkbox">
                                                                 <input id="delete_<?=@$rows->role_id?>" type="checkbox">
                                                                 <label for="delete_<?=@$rows->role_id?>">&nbsp;</label>
                                                            </div>
                                                       </td>
                                                       <td><?=@$rows->role_code?></td>
                                                       <td><?=@$rows->role_name?></td>
                                                       <td><?=@$rows->role_desc?></td>
                                                       <td class="footable-last-visible text-center" style="display: table-cell;">
                                                            <a href="#custom-update-modal" class="btn btn-warning btn-sm" data-toggle="modal" onclick="define_edit(<?= $rows->role_id ?>, 'securite/roles/showEdit')"><i class="zmdi zmdi-edit"></i></a>
                                                            <a href="#custom-delete-modal" class="btn btn-danger btn-sm" data-toggle="modal" onclick="define_delete(<?= $rows->role_id ?>, 'role_id')"><i class="zmdi zmdi-delete"></i></a>
                                                       </td>
                                                  </tr>
                                             <?php endforeach;?>
                                        <?php endif;?>
                                   </tr>
                              </tbody>
                         </table>
                    </div>

               </div>
          </div>
     </div>
</div>



<div id="custom-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="customLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="customLabel">Add role</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url('securite/roles/insert'); ?>" method="post">
                         <div class="col-10 col-md-12 mt-50">
                              <div class="form-group mb-3">
                                   <label>Code</label>
                                   <input type="text" class="form-control" placeholder="Code" name="role_code" required>
                              </div>
                              <div class="form-group mb-3">
                                   <label>Label</label>
                                   <input type="text" class="form-control" placeholder="Nom" name="role_name" required>
                              </div>
                              <div class="form-group mb-3">
                                   <label>Description</label>
                                   <textarea class="form-control" placeholder="Description" name="role_desc" rows="3" cols="80" required></textarea>
                              </div>
                              <hr>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" class="form-control" name="role_id" required>
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                   <button type="submit" class="btn btn-success col-md-4">Save</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<div id="custom-update-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Edit rôle</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url('securite/roles/update'); ?>" method="post">
                         <div class="col-10 col-md-12 mt-50">
                              <div class="form-group mb-3">
                                   <label>Code</label>
                                   <input type="text" class="form-control" placeholder="Code" name="role_code" id="role_code" required>
                              </div>
                              <div class="form-group mb-3">
                                   <label>Label</label>
                                   <input type="text" class="form-control" placeholder="Nom" name="role_name" id="role_name" required>
                              </div>
                              <div class="form-group mb-3">
                                   <label>Description</label>
                                   <textarea class="form-control" placeholder="Description" name="role_desc" id="role_desc" rows="3" cols="80" required></textarea>
                              </div>
                              <hr>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" class="form-control" name="role_id" id="role_id" required>
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                   <button type="submit" class="btn btn-warning col-md-4">Update</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>


<div id="custom-delete-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Delete rôle</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url('securite/roles/delete'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 mt-50">
                              <p style="text-align: center; font-size: 14px;">
                                   The selected element will be permanently deleted. <br>
                                   Do you want to continue this operation?
                              </p>
                              <hr>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" type="text" name="role_id" value="<?=@$role_id?>">
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                   <button type="submit" class="btn btn-danger col-md-4">Delete</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>
