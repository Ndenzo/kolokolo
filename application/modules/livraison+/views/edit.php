<div class="panel-header panel-header-sm"></div>

<div class="content">
     <div class="row">
          <div class="col-md-12">
               <div class="card">
                    <div class="card-title mb-5">
                         <h5 class="title">Ajouter un produit</h5>
                         <?php include_once('desc.php'); ?>
                    </div>
                    <div class="card-body all-icons">
                         <form class="row justify-content-center" action="<?php _url('stock/produit/update'); ?>" method="post" enctype="multipart/form-data">
                              <div class="col-10 col-md-4 mt-50">
                                   <div class="form-group mb-30">
                                        <label>Produit</label>
                                        <input type="text" class="form-control" placeholder="Produit" name="produit_libelle" value="<?=@$record->produit_libelle?>">
                                   </div>
                                   <div class="form-group mb-30">
                                        <label>Illustration</label>
                                        <input type="file" class="form-control-file" placeholder="Produit" name="produit_image" value="<?=@$record->produit_image?>">
                                   </div>
                                   <div class="form-group mb-30">
                                        <label>Prix</label>
                                        <input type="number" class="form-control" placeholder="Produit" name="produit_prix" value="<?=@$record->produit_prix?>">
                                   </div>
                                   <div class="form-group mb-30">
                                        <label>Quantite</label>
                                        <input type="number" class="form-control" placeholder="Produit" name="produit_quantite" value="<?=@$record->produit_quantite?>">
                                   </div>
                                   <div class="form-group mb-30">
                                        <label>Description</label>
                                        <textarea class="form-control" placeholder="Description" name="produit_desc" rows="3" cols="80"><?=@$record->produit_desc?></textarea>
                                   </div>
                                   <div class="row mb-30">
                                        <input class="hide" type="text" name="produit_id" value="<?=@$record->produit_id?>">
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
