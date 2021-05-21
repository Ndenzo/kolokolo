<div class="panel-header panel-header-sm"></div>

<div class="content">
     <div class="row">
          <div class="col-md-12">
               <div class="card">
                    <div class="card-title">
                         <h5 class="title">Liste des livraisons</h5>
                         <?php include_once('desc.php'); ?>
                    </div>
                    <?php show_notification();?>
                    <div class="card-body all-icons">
                         <!-- <div class="row justify-content-center">
                         <a href="<?php _url('stock/produit/showAdd'); ?>" class="col-8 btn btn-success"> Ajouter</a>
                    </div> -->
                    <div class="row justify-content-center mt-30">
                         <table id="example" class="table table-striped table-bordered" >
                              <thead>
                                   <tr>
                                        <th>Produit</th>
                                        <th>Date</th>
                                        <th>Client</th>
                                        <th>Quantité</th>
                                        <th>Prix</th>
                                        <th>Montant</th>
                                        <th>Etat</th>
                                        <th class="justify-content-center" style="width: 100px;">Opérations</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <?php if(is_array(@$datagrid)):?>
                                        <?php foreach(@$datagrid as $rows):?>
                                             <tr>
                                                  <td><?=@$rows->produit_libelle?></td>
                                                  <td><?=@gmdate('d/m/Y H:i:s', @$rows->created_commande)?></td>
                                                  <td><?=@$rows->user_nicename?></td>
                                                  <th><?=@$rows->commande_quantite?></th>
                                                  <th><?=@$rows->produit_prix?></th>
                                                  <th><?=@$rows->commande_quantite * @$rows->produit_prix?></th>
                                                  <th> <span class="<?=@$rows->commande_flag_class?>"><?=@$rows->commande_flag_libelle?></span> </th>
                                                  <td>
                                                       <?php if($rows->commande_flag != 2 && $rows->commande_flag != 3):?>
                                                            <?php if($rows->commande_flag == 1):?>
                                                                 <a class="btn btn-info btn-fab btn-icon btn-round" href="<?php _url('livraison/livraison/showAdd/'.$rows->commande_id); ?>">
                                                                      <i class="fa fa-truck"></i>
                                                                 </a>
                                                            <?php else:?>
                                                                 <a class="btn btn-success btn-fab btn-icon btn-round" href="<?php _url('livraison/livraison/showValid/'.$rows->commande_id); ?>">
                                                                      <i class="fa fa-check"></i>
                                                                 </a>
                                                                 <a class="btn btn-warning btn-fab btn-icon btn-round" href="<?php _url('livraison/livraison/showInvalid/'.$rows->commande_id); ?>">
                                                                      <i class="fa fa-ban"></i>
                                                                 </a>
                                                            <?php endif;?>
                                                       <?php endif;?>
                                                       <a class="btn btn-danger btn-fab btn-icon btn-round" href="<?php _url('livraison/livraison/showRemove/'.$rows->commande_id); ?>">
                                                            <i class="fa fa-trash"></i>
                                                       </a>
                                                  </td>
                                             </tr>
                                        <?php endforeach;?>
                                   <?php endif;?>
                              </tbody>
                              <tfoot>
                                   <tr>
                                        <th>Produit</th>
                                        <th>Date</th>
                                        <th>Client</th>
                                        <th>Quantité</th>
                                        <th>Prix</th>
                                        <th>Montant</th>
                                        <th>Etat</th>
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
