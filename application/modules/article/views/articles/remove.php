<div class="panel-header panel-header-sm"></div>

<div class="content">
     <div class="row">
          <div class="col-md-12">
               <div class="card">
                    <div class="card-title">
                         <h5 class="title">Supprimer un type de produits</h5>
                         <?php //include_once('desc.php'); ?>
                    </div>
                    <div class="card-body all-icons">
                         <form class="row justify-content-center" action="<?php _url($module_base.'delete'); ?>" method="post" enctype="multipart/form-data">
                              <div class="col-10 col-md-4 mt-50">
                                   <p style="text-align: center; font-size: 14px;">
                                        Le produit sélectionner va être supprimer de manière permanante. <br>
                                        Voulez-vous continuer cette opérations ?
                                   </p>
                                   <div class="row mb-30 mt-50">
                                        <input class="hide" type="text" name="article_id" value="<?=@$article_id?>">
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
