<div class="row">
     <div class="col-xl-4">
          <a href="#custom-modal" class="btn btn-success btn-md waves-effect waves-light mb-3" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a"><i class="mdi mdi-plus-circle-outline"> </i> Ajouter utilisateur</a>
     </div><!-- end col -->
</div>
<?php show_notification();?>
<div class="row mt-1">
     <div class="col-12">
          <div class="card">
               <h4 class="mt-0 card-header">Liste des rôles</h4>
               <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap">
                    <thead>
                         <tr>
                              <th> Login </th>
                              <th> Nom Complet </th>
                              <th> Email </th>
                              <th> Enregistrement </th>
                              <th> Status </th>
                              <th class="justify-content-center" style="width: 100px;">Opérations</th>
                         </tr>
                    </thead>
                    <tbody>
                         <?php if(is_array(@$datagrid)):?>
                              <?php foreach(@$datagrid as $rows):?>
                                   <tr>
                                        <td><?=$rows->user_login?></td>
                                        <td><?=$rows->user_nicename?></td>
                                        <td><?=$rows->user_email?></td>
                                        <td><?=gmdate('d/m/Y',$rows->user_registered)?></td>
                                        <td><?=gmdate('d/m/Y',$rows->user_registered)?></td>
                                        <td style="text-align:center;">
                                             <div class="item-action dropdown">
                                                  <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions <i class="mdi mdi-chevron-down"></i></button>
                                                  <div class="dropdown-menu dropdown-menu-right">
                                                       <!-- <a href="<?php _url($module_base.'showProduct/?categorie_id='.$rows->categorie_id); ?>" class="dropdown-item"><i class="dropdown-icon fe fe-plus-square"></i> Détails </a> -->
                                                       <a href="#custom-update-modal" class="dropdown-item" data-toggle="modal" onclick="define_edit(<?= $rows->user_id ?>, 'securite/users/showEdit')"><i class="dropdown-icon mdi mdi-square-edit-outline"></i> Modifier </a>
                                                       <div class="dropdown-divider"></div>
                                                       <a href="#custom-delete-modal" class="dropdown-item" data-toggle="modal" onclick="define_delete(<?= $rows->user_id ?>, 'user_id')"><i class="dropdown-icon mdi mdi-trash-can-outline"></i> Supprimer </a>
                                                  </div>
                                             </div>
                                        </td>
                                   </tr>
                              <?php endforeach;?>
                         <?php endif;?>
                    </tbody>
               </table>
          </div>
     </div>
</div>

<div id="custom-modal" class="modal-demo">
     <button type="button" class="close" onclick="Custombox.modal.close();">
          <span>&times;</span><span class="sr-only">Close</span>
     </button>
     <h4 class="custom-modal-title">Ajouter rôle</h4>
     <div class="custom-modal-text text-left">
          <form class="row justify-content-center" action="<?php _url($module_base.'insert'); ?>" method="post">
               <div class="col-10 col-md-12 mt-2">
                    <div class="form-group mb-30">
                         <label>Role</label>
                         <?php dropDown('SELECT role_id, role_name FROM users_roles WHERE role_id != 1',array(
                              'name'=>'role_id',
                              'id'=>"role_id",
                              'class' => 'form-control selectpicker',
                              'attr' => 'title="Choisir rôle" data-size="7" data-live-search="true" required',
                         ));?>
                    </div>
                    <div class="form-group mb-30">
                         <label>Login</label>
                         <input type="text" class="form-control" placeholder="Login" name="user_login">
                    </div>
                    <div class="form-group mb-30">
                         <label>Prenom et nom</label>
                         <input type="text" class="form-control" placeholder="Prenom et nom" name="user_nicename">
                    </div>
                    <div class="form-group mb-30">
                         <label>Email</label>
                         <input type="email" class="form-control" placeholder="Email" name="user_email">
                    </div>
                    <div class="form-group mb-30">
                         <label>Mot de passe</label>
                         <input type="text" class="form-control" placeholder="Mot de passe" name="user_password">
                    </div>
                    <div class="form-group mb-30">
                         <label>Confirmer le mot de passe</label>
                         <input type="text" class="form-control" placeholder="Confirmation mot de passe" name="user_cpassword">
                    </div>
                    <hr>
                    <div class="modal-footer mt-3">
                         <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                         <button type="submit" class="btn btn-success col-md-4">Ajouter</button>
                    </div>
               </div>
          </form>
     </div>
</div>

<div id="custom-update-modal" class="modal fade bs-example-modal-center show" tabindex="-1" user="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Modifier rôle</h4>
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
                                        'attr'=>'title ="-- Choose --"  data-size="7" data-live-search="true" required selected'
                                   ));?>
                              </div>
                              <div class="form-group mb-30">
                                   <label>Login</label>
                                   <input type="text" class="form-control" placeholder="Login" name="user_login" id="user_login">
                              </div>
                              <div class="form-group mb-30">
                                   <label>Prenom et nom</label>
                                   <input type="text" class="form-control" placeholder="Prenom et nom" name="user_nicename" id="user_nicename">
                              </div>
                              <div class="form-group mb-30">
                                   <label>Email</label>
                                   <input type="email" class="form-control" placeholder="Email" name="user_email" id="user_email">
                              </div>
                              <div class="form-group mb-30">
                                   <label>Mot de passe</label>
                                   <input type="text" class="form-control" placeholder="Mot de passe" name="user_password">
                              </div>
                              <div class="form-group mb-30">
                                   <label>Confirmer le mot de passe</label>
                                   <input type="text" class="form-control" placeholder="Confirmation mot de passe" name="user_cpassword">
                              </div>
                              <hr>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" class="form-control" name="user_id" id="user_id" required>
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-warning col-md-4">Modifier</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>


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
                                   Le rôle sélectionner va être supprimer de manière permanante. <br>
                                   Voulez-vous continuer cette opérations ?
                              </p>
                              <hr>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" type="text" name="user_id" value="<?=@$user_id?>">
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-danger col-md-4">Supprimer</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>
