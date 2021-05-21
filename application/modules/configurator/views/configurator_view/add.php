<div class="panel-header panel-header-sm"></div>

<div class="content">
     <div class="row">
          <div class="col-md-12">
               <div class="card">
                    <div class="card-title">
                         <h5 class="title">Ajouter un module</h5>
                         <?php include_once('desc.php'); ?>
                    </div>
                    <div class="card-body all-icons">
                         <form class="row justify-content-center" action="<?php _url($module_base.'insert'); ?>" method="post" enctype="multipart/form-data">
                              <div class="col-10 col-md-4 mt-50">
                                   <div class="form-group mb-30">
                                        <label>Module</label>
                                        <input type="text" class="form-control" placeholder="Module" name="module_name">
                                   </div>
                                   <div class="form-group mb-30">
                                        <label>Description</label>
                                        <textarea class="form-control" placeholder="Description" name="module_desc" rows="3" cols="80"></textarea>
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
