
<div class="container-fluid">
     <div class="row clearfix">
          <div class="col-xl-3 xl-40">
               <div class="default-according style-1 faq-accordion job-accordion" id="accordionoc">
                    <div class="row">
                         <div class="col-xl-12">
                              <form class="card" action="<?php _url($module_base.'insert'); ?>" method="post">
                                   <div class="card-title">
                                        <h5 class="mb-0">
                                             <button class="btn btn-link pl-0" data-toggle="collapse" data-target="#collapseicon" aria-expanded="true" aria-controls="collapseicon">New language</button>
                                        </h5>
                                   </div>
                                   <div class="collapse show" id="collapseicon" aria-labelledby="collapseicon" data-parent="#accordion">
                                        <div class="card-body filter-cards-view animate-chk">

                                             <div class="job-filter">
                                                  <div class="faq-form">
                                                       <?php dropDown('SELECT role_id, role_name FROM users_roles WHERE role_id != 1',array(
                                                            'name'=>'role_id',
                                                            'id'=>"role_id-form",
                                                            'class' => 'form-control select2',
                                                            'attr' => 'required',
                                                       ));?>
                                                  </div>
                                                  <div class="faq-form mt-3">
                                                       <input type="text" class="form-control" placeholder="Login" name="user_login"><i class="search-icon" data-feather="log-in"></i>
                                                  </div>
                                                  <div class="faq-form mt-3">
                                                       <input type="text" class="form-control" placeholder="Full name" name="user_nicename"><i class="search-icon" data-feather="edit-3"></i>
                                                  </div>
                                                  <div class="faq-form mt-3">
                                                       <input type="email" class="form-control" placeholder="Email" name="user_email"><i class="search-icon" data-feather="mail"></i>
                                                  </div>
                                                  <div class="faq-form mt-3">
                                                       <input type="password" class="form-control" placeholder="Password" name="user_password"><i class="search-icon" data-feather="lock"></i>
                                                  </div>
                                                  <div class="faq-form mt-3">
                                                       <input type="password" class="form-control" placeholder="Confirm" name="user_cpassword"><i class="search-icon" data-feather="lock"></i>
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
                         <h5>List of users </h5>
                    </div>
                    <div class="card-body">
                         <?php show_notification();?>
                         <div class="table-responsive"  style="overflow-x: hidden;">
                              <table class="table table-striped table-bordered" id="basic-3">
                                   <thead>
                                        <tr>
                                             <th class="text-center" style="width:30px;">#</th>
                                             <th>Login</th>
                                             <th>Full Name</th>
                                             <th>Email</th>
                                             <th>Saved</th>
                                             <!-- <th>Status</th> -->
                                             <th class="text-center" style="width: 120px;">Action</th>
                                        </tr>
                                   </thead>
                                   <tbody>
                                        <?php if(is_array(@$datagrid)):?>
                                             <?php foreach(@$datagrid as $key => $rows):?>
                                                  <tr>
                                                       <td class="text-center"><?=@$key+1?></td>
                                                       <td><?=$rows->user_login?></td>
                                                       <td><?=$rows->user_nicename?></td>
                                                       <td><?=$rows->user_email?></td>
                                                       <td><?=gmdate('d/m/Y',$rows->user_registered)?></td>
                                                       <!-- <td><?=gmdate('d/m/Y',$rows->user_registered)?></td> -->
                                                       <td class="footable-last-visible text-center">
                                                            <a href="#custom-update-modal" class="btn btn-sm btn-outline-warning" data-toggle="modal" onclick="define_edit(<?= $rows->user_id ?>, 'securite/users/showEdit')"><i class="fa fa-pencil"></i></a>
                                                            <a href="#custom-delete-modal" class="btn btn-sm btn-outline-danger" data-toggle="modal" onclick="define_delete(<?= $rows->user_id ?>, 'user_id')"><i class="fa fa-trash"></i></a>
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

<div id="custom-update-modal" class="modal fade bs-example-modal-center show" tabindex="-1" user="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Edit rôle</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url('securite/users/update'); ?>" method="post">
                         <div class="col-10 col-md-12 mt-2">
                              <div class="form-group mb-30">
                                   <label>Role</label>
                                   <?php dropDown('SELECT role_id, role_name FROM users_roles',array(
                                        'name'=>'role_id',
                                        'id'=>"role_id",
                                        'class' => 'form-control selectpicker',
                                        'attr'=>'title ="-- Choisir --"  data-size="7" data-live-search="true" required selected'
                                   ));?>
                              </div>
                              <div class="form-group mb-30">
                                   <label>Login</label>
                                   <input type="text" class="form-control" placeholder="Login" name="user_login" id="user_login">
                              </div>
                              <div class="form-group mb-30">
                                   <label>Full name</label>
                                   <input type="text" class="form-control" placeholder="Full name" name="user_nicename" id="user_nicename">
                              </div>
                              <div class="form-group mb-30">
                                   <label>Email</label>
                                   <input type="email" class="form-control" placeholder="Email" name="user_email" id="user_email">
                              </div>
                              <div class="form-group mb-30">
                                   <label>Password</label>
                                   <input type="text" class="form-control" placeholder="Password" name="user_password">
                              </div>
                              <div class="form-group mb-30">
                                   <label>Confirm password</label>
                                   <input type="text" class="form-control" placeholder="Confirm" name="user_cpassword">
                              </div>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" class="form-control" name="user_id" id="user_id" required>
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

<div id="custom-delete-modal" class="modal fade bs-example-modal-center show" tabindex="-1" user="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Supprimer rôle</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url('securite/users/delete'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 mt-2">
                              <p style="text-align: center; font-size: 14px;">
                                   The selected element will be permanently deleted. <br>
                                   Do you want to continue this operation?
                              </p>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" type="text" name="user_id" value="<?=@$user_id?>">
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                   <button type="submit" class="btn btn-danger col-md-4">Supprimer</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>
