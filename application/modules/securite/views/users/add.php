<div class="panel-header panel-header-sm"></div>

<div class="content">
     <div class="row">
          <div class="col-md-12">
               <div class="card">
                    <div class="card-title">
                         <h5 class="title">Ajouter un role</h5>
                         <?php include_once('desc.php'); ?>
                    </div>
                    <div class="card-body all-icons">
                         <form class="row justify-content-center" action="<?php _url($module_base.'insert'); ?>" method="post" enctype="multipart/form-data">
                              <div class="col-10 col-md-4 mt-50">
                                   <div class="form-group mb-30">
                                        <label>Role</label>
                                        <?php dropDown('SELECT role_id, role_name FROM users_roles WHERE role_id != 1',array(
                                             'name'=>'role_id',
                                             'id'=>"role_id",
                                             'class' => 'form-control selectpicker',
                                             'attr' => 'title="Choisir rôle" data-size="7" data-live-search="true" required',
                                             'selected'=>''
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
                                   <div class="row mb-30">
                                        <a href="<?php _url($module_base); ?>" class="btn btn-danger col-5 col-md-4">Retour</a>
                                        <input type="submit" name="validated" value="Enregistrer" class="btn btn-success col-5 col-md-4 ml-auto">
                                   </div>
                              </div>
                         </form>
                    </div>
               </div>
          </div>
     </div>
</div>
