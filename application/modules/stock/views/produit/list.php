<div class="panel-header panel-header-sm"></div>

<div class="content">
     <div class="row">
          <div class="col-md-12">
               <div class="card">
                    <div class="card-title">
                         <h5 class="title">Liste des types de produits</h5>
                         <?php include_once('desc.php'); ?>
                    </div>
                    <?php show_notification();?>
                    <div class="card-body all-icons">
                         <div class="row justify-content-center">
                              <a href="<?php _url('stock/produit/showAdd'); ?>" class="col-8 btn btn-success"> Ajouter</a>
                         </div>
                         <div class="row justify-content-center mt-30">
                              <table id="example" class="table table-striped table-bordered" >
                                   <thead>
                                        <tr>
                                             <th ></th>
                                             <th>Nom</th>
                                             <th style="width: 200px;">Description</th>
                                             <th>Couleurs</th>
                                             <th>Tailles</th>
                                             <th>Prix</th>
                                             <th>Quantité</th>
                                             <th class="justify-content-center" style="width: 100px;">Opérations</th>
                                        </tr>
                                   </thead>
                                   <tbody>
                                        <?php if(is_array(@$datagrid)):?>
                                             <?php foreach(@$datagrid as $rows):?>
                                                  <tr>
                                                       <td style="background-image: url('<?php _url(@$rows->produit_image);?>');  background-size: contain; background-position: center; background-repeat: no-repeat; height: 180px; background-color: white;">
                                                            <div style="width: 380px;"></div>
                                                       </td>
                                                       <td><?=@$rows->produit_libelle?></td>
                                                       <td><?=@$rows->produit_desc?></td>
                                                       <th><?=@$rows->produit_couleurs?></th>
                                                       <th><?=@$rows->produit_tailles?></th>
                                                       <th><?=@$rows->produit_prix?></th>
                                                       <th><?=@$rows->produit_quantite?></th>
                                                       <td>
                                                            <a class="btn btn-warning btn-fab btn-icon btn-round" href="<?php _url('stock/produit/showEdit/'.$rows->produit_id); ?>">
                                                                 <i class="fa fa-edit"></i>
                                                            </a>
                                                            <a class="btn btn-danger btn-fab btn-icon btn-round" href="<?php _url('stock/produit/showRemove/'.$rows->produit_id); ?>">
                                                                 <i class="fa fa-trash"></i>
                                                            </a>
                                                       </td>
                                                  </tr>
                                             <?php endforeach;?>
                                        <?php endif;?>
                                   </tbody>
                                   <tfoot>
                                        <tr>
                                             <th></th>
                                             <th>Nom</th>
                                             <th>Description</th>
                                             <th>Couleurs</th>
                                             <th>Tailles</th>
                                             <th>Prix</th>
                                             <th>Quantité</th>
                                             <th class="justify-content-center" style="width: 100px;">Opérations</th>
                                        </tr>
                                   </tfoot>
                              </table>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
