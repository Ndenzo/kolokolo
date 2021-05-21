
<div class="container-fluid">
     <div class="row clearfix">
          <div class="col-xl-3 xl-40">
               <div class="default-according style-1 faq-accordion job-accordion" id="accordionoc">
                    <div class="row">
                         <div class="col-xl-12">
                              <form class="card" action="<?php _url($module_base.'insert'); ?>" method="post">
                                   <div class="card-body filter-cards-view animate-chk">
                                        <div class="card-title">
                                             <h3 class="mb-0">
                                                  New tag
                                             </h3>
                                        </div>
                                        <div class="job-filter">
                                             <div class="faq-form">
                                                  <input class="form-control" type="text" placeholder="Code.." name="tag_code" required><i class="search-icon" data-feather="code"></i>
                                             </div>
                                             <div class="faq-form mt-3">
                                                  <input class="form-control" type="text" placeholder="Name.." name="tag_name" required><i class="search-icon" data-feather="edit-3"></i>
                                             </div>
                                        </div>

                                        <button class="btn btn-primary text-center col-12 mt-3" type="submit">Save</button>
                                   </div>
                              </form>
                         </div>
                    </div>
               </div>
          </div>
          <div class="col-xl-9 xl-60">
               <div class="card">
                    <div class="card-body">
                         <div class="card-title">
                              <h5>List of tags </h5>
                         </div>
                         <?php show_notification();?>
                         <div class="table-responsive"  style="overflow-x: hidden;">
                              <table class="table table-striped table-bordered" id="basic-3">
                                   <thead>
                                        <tr>
                                             <th class="text-center" style="width:30px;">#</th>
                                             <th class="text-center" style="width:50px;">code</th>
                                             <th>Name</th>
                                             <th class="text-center" style="width: 120px;">Action</th>
                                        </tr>
                                   </thead>
                                   <tbody>
                                        <?php if(is_array(@$datagrid)):?>
                                             <?php foreach(@$datagrid as $key => $rows):?>
                                                  <tr>
                                                       <td class="text-center"><?=@$key+1?></td>
                                                       <td><?=@$rows->tag_code?></td>
                                                       <td><?=@$rows->tag_name?></td>
                                                       <td class="footable-last-visible text-center">
                                                            <a href="#custom-update-modal" class="btn btn-sm btn-outline-warning" data-toggle="modal" onclick="define_edit(<?= $rows->tag_id ?>, 'settings/tag/showEdit')"><i class="fa fa-pencil"></i></a>
                                                            <a href="#custom-delete-modal" class="btn btn-sm btn-outline-danger" data-toggle="modal" onclick="define_delete(<?= $rows->tag_id ?>, 'tag_id')"><i class="fa fa-trash"></i></a>
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
                    <h4 class="modal-title" id="myCenterModalLabel">Edit tag</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'update'); ?>" method="post">
                         <div class="col-10 col-md-12 mt-50">
                              <div class="form-group mb-3">
                                   <label>tag code</label>
                                   <input type="text" class="form-control" placeholder="Code.." name="tag_code" id="tag_code" required>
                              </div>
                              <div class="form-group mb-3">
                                   <label>tag name</label>
                                   <input type="text" class="form-control" placeholder="Name.." name="tag_name" id="tag_name" required>
                              </div>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" class="form-control" name="tag_id" id="tag_id" required>
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
                    <h4 class="modal-title" id="myCenterModalLabel">Delete tag</h4>
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
                                   <input type="hidden" type="text" name="tag_id">
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                   <button type="submit" class="btn btn-danger col-md-4">Delete</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>
