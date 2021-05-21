<div class="panel-header panel-header-sm"></div>

<div class="content">
     <div class="row">
          <div class="col-md-12">
               <div class="card">
                    <div class="card-title">
                         <h5 class="title">Modifier un rôle</h5>
                         <?php include_once('desc.php'); ?>
                    </div>
                    <div class="card-body all-icons">
                         <form class="row justify-content-center" action="<?php _url('securite/roles/update'); ?>" method="post" enctype="multipart/form-data">
                              <div class="col-10 col-md-4 mt-50">
                                   <div class="form-group mb-30">
                                        <label>Code rôle</label>
                                        <input type="text" class="form-control" placeholder="Code" name="role_code" value="<?=@$record->role_code?>">
                                   </div>
                                   <div class="form-group mb-30">
                                        <label>Nom du rôle</label>
                                        <input type="text" class="form-control" placeholder="Nom" name="role_name" value="<?=@$record->role_name?>">
                                   </div>
                                   <div class="form-group mb-30">
                                        <label>Description</label>
                                        <textarea class="form-control" placeholder="Description" name="role_desc" rows="3" cols="80"><?=@$record->role_desc?></textarea>
                                   </div>
                                   <div class="row mb-30">
                                        <input class="hide" type="text" name="role_id" value="<?=@$record->role_id?>">
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
