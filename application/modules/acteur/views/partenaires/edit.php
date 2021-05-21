<div class="panel-header panel-header-sm"></div>

<!-- some CSS styling changes and overrides -->
<div class="container">
     <div class="row">

          <div class="col-md-10 ml-auto mr-auto">
               <div class="card">
                    <div class="card-title">
                         <h5 class="title">Ajouter un article</h5>
                         <?php //include_once('desc.php'); ?>
                    </div>
                    <div class="card-body all-icons">
                         <form class="row justify-content-center" action="<?php _url($module_base.'update'); ?>" method="post" enctype="multipart/form-data">
                              <div class="col-12 col-md-12 mt-50">
                                   <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                             <img src="<?= _url($record->article_photo) ?>" alt="Photo <?= $record->article_libelle ?>">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                        <div>
                                             <span class="btn default btn-file">
                                                  <span class="fileinput-new btn btn-info"> Parcourir </span>
                                                  <span class="fileinput-exists btn btn-warning"> Changer </span>
                                                  <input type="file" name="article_photo">
                                             </span>
                                             <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                        </div>
                                   </div>
                                   <div class="form-group mb-30">
                                        <label>Titre de l'article</label>
                                        <input type="text" class="form-control" placeholder="Titre" name="article_libelle" value="<?= $record->article_libelle ?>">
                                   </div>
                                   <div class="form-group mb-30">
                                        <label>Description</label>
                                        <textarea class="form-control" placeholder="Description" name="article_desc"  id="article_desc" rows="10" cols="80"><?= $record->article_desc ?></textarea>
                                   </div>
                                   <div class="row mb-30">
                                        <input type="hidden" name="article_id" value="<?= $record->article_id ?>">
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
CKEDITOR.replace('article_desc',{
     removePlugins : 'easyimage, cloudservices'
});
</script>
