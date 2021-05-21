
<div class="container-fluid">
     <div class="row clearfix">
          <div class="col-xl-3 xl-40">
               <div class="default-according style-1 faq-accordion job-accordion" id="accordionoc">
                    <div class="row">
                         <div class="col-xl-12">
                              <form class="card" action="<?php _url($module_base.'insert'); ?>" method="post">
                                   <div class="card-title">
                                        <h5 class="mb-0">
                                             <button class="btn btn-link pl-0" data-toggle="collapse" data-target="#collapseicon" aria-expanded="true" aria-controls="collapseicon">New payment status</button>
                                        </h5>
                                   </div>
                                   <div class="collapse show" id="collapseicon" aria-labelledby="collapseicon" data-parent="#accordion">
                                        <div class="card-body filter-cards-view animate-chk">

                                             <div class="job-filter">
                                                  <div class="faq-form">
                                                       <input class="form-control" type="text" placeholder="Code.." name="settings_payment_code" required><i class="search-icon" data-feather="code"></i>
                                                  </div>
                                                  <div class="faq-form mt-3">
                                                       <input class="form-control" type="text" placeholder="Value.." name="settings_payment_name" required><i class="search-icon" data-feather="edit-3"></i>
                                                  </div>
                                             </div>

                                             <button class="btn btn-primary text-center" type="submit">Save</button>
                                        </div>
                                   </div>
                              </form>
                         </div>
                    </div>
               </div>
          </div>
          <div class="col-xl-9 xl-60">
               <div class="card">
                    <div class="card-title">
                         <h5>List of payments </h5>
                    </div>
                    <div class="card-body">
                         <?php show_notification();?>
                         <div class="table-responsive"  style="overflow-: hidden;">
                              <table class="table table-striped table-bordered" id="basic-3">
                                   <thead>
                                        <tr>
                                             <th class="text-center" style="width:30px;">#</th>
                                             <th class="text-center">code</th>
                                             <!-- <th class="col">Name</th> -->
                                             <th class="text-center" style="width: 120px;">Action</th>
                                        </tr>
                                   </thead>
                                   <tbody>
                                        <?php if(is_array(@$datagrid)):?>
                                             <?php foreach(@$datagrid as $key => $rows):?>
                                                  <tr>
                                                       <td class="text-center"><?=@$key+1?></td>
                                                       <td><?=@$rows->settings_payment_code?></td>
                                                       <!-- <td><?=@$rows->settings_payment_name?></td> -->
                                                       <td class="footable-last-visible text-center">
                                                            <a href="#custom-update-modal" class="btn btn-sm btn-outline-warning" data-toggle="modal" onclick="define_edit(<?= $rows->settings_payment_id ?>, 'settings/settings_payment/showEdit')"><i class="fa fa-pencil"></i></a>
                                                            <a href="#custom-delete-modal" class="btn btn-sm btn-outline-danger" data-toggle="modal" onclick="define_delete(<?= $rows->settings_payment_id ?>, 'settings_payment_id')"><i class="fa fa-trash"></i></a>
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
</div>

<!-- Edit manager ///////////////////////////////////////////////////////////////////////////////////////////////// -->

<div id="custom-update-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Edit payment</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'update'); ?>" method="post">
                         <div class="col-10 col-md-12 mt-50">
                              <div class="form-group mb-3">
                                   <label>payment code</label>
                                   <input type="text" class="form-control" placeholder="Code.." name="settings_payment_code" id="settings_payment_code" required>
                              </div>
                              <div class="form-group mb-3">
                                   <label>payment name</label>
                                   <textarea type="text" class="form-control" placeholder="Name.." name="settings_payment_name" id="settings_payment_name" rows="8" cols="80" required></textarea>
                              </div>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" class="form-control" name="settings_payment_id" id="settings_payment_id" required>
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                   <button type="submit" class="btn btn-warning col-md-4">Update</button>
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
                    <h4 class="modal-title" id="myCenterModalLabel">Delete payment</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'delete'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 mt-50">
                              <p style="text-align: center; font-size: 14px;">
                                   The selected element will be permanently deleted. <br>
                                   Do you want to continue this operation?
                              </p>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" type="text" name="settings_payment_id">
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                   <button type="submit" class="btn btn-danger col-md-4">Delete</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>
