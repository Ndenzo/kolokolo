<div class="panel-header panel-header-sm"></div>

<div class="content">
     <div class="row">
          <div class="col-md-12">
               <div class="card">
                    <div class="card-title">
                         <h5 class="title">Ajouter un produit</h5>
                         <?php include_once('desc.php'); ?>
                    </div>
                    <div class="card-body all-icons">
                         <form class="row justify-content-center" action="<?php _url('stock/produit/insert'); ?>" method="post" enctype="multipart/form-data">
                              <div class="col-10 col-md-3 mt-50">
                                   <div id="targetOuter">
                                        <div id="targetLayer"></div>
                                        <img src="<?php _url('assets/custom/img/photo.png') ?>"  class="icon-choose-image" />
                                        <div class="icon-choose-image" >
                                             <input name="produit_image" id="userImage" type="file" class="inputFile" onChange="showPreview(this);" />
                                        </div>
                                   </div>
                              </div>
                              <div class="col-10 col-md-4 mt-50">
                                   <div class="form-group mb-30">
                                        <label>Produit</label>
                                        <input type="text" class="form-control" placeholder="Produit" name="produit_libelle">
                                   </div>
                                   <div class="form-group mb-30">
                                        <label>Prix</label>
                                        <input type="number" class="form-control" placeholder="Produit" name="produit_prix">
                                   </div>
                                   <div class="form-group mb-30">
                                        <label>Quantite</label>
                                        <input type="number" class="form-control" placeholder="Produit" name="produit_quantite">
                                   </div>
                                   <div class="form-group mb-30">
                                        <label>Description</label>
                                        <textarea class="form-control" placeholder="Description" name="produit_desc" rows="3" cols="80"></textarea>
                                   </div>
                              </div>


                              <div class="col-10 col-md-8 mt-50">
                                   <div class="row mb-30">
                                        <a href="<?php _url($module_base); ?>" class="btn btn-danger col-5 col-md-2">Retour</a>
                                        <input type="submit" name="validated" value="Enregistrer" class="btn btn-success col-5 col-md-2 ml-auto">
                                   </div>
                              </div>

                         </div>
                    </form>
               </div>
          </div>
     </div>
</div>
</div>
