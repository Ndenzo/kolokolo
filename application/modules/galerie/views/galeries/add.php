<div class="panel-header panel-header-sm"></div>

<div class="container">
     <div class="row">

          <div class="col-md-10 ml-auto mr-auto">
               <div class="card">
                    <div class="card-title">
                         <h5 class="title">Ajouter une galerie</h5>
                         <?php // include_once('desc.php'); ?>
                    </div>
                    <div class="card-body all-icons">
                         <form class="row justify-content-center" action="<?php _url($module_base.'insert'); ?>" method="post" enctype="multipart/form-data">
                              <div class="col-12 col-md-12 mt-50">
                                   <div class="form-group mb-30">
                                        <label>Titre de la galerie</label>
                                        <input type="text" class="form-control" placeholder="Titre" name="galerie_libelle">
                                   </div>
                                   <div class="form-group mb-30">
                                        <label>Description</label>
                                        <textarea class="form-control" placeholder="Description" name="galerie_desc"  id="galerie_desc" rows="10" cols="80"></textarea>
                                   </div>
                                   <div class="row mb-30">
                                        <a href="<?php _url($module_base); ?>" class="btn btn-danger col-3 col-md-3">Retour</a>
                                        <input type="submit" name="validated" value="Enregistrer" class="btn btn-success col-3 col-md-3 ml-auto">
                                   </div>
                              </div>
                         </form>

                         <div id="kv-avatar-errors-1" class="center-block" style="width:800px; display:none"></div>

                    </div>
               </div>
          </div>
     </div>
</div>

<script type="text/javascript">
CKEDITOR.replace('galerie_desc',{
     removePlugins : 'easyimage, cloudservices'
});
</script>
