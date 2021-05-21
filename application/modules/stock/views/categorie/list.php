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
                              <a href="<?php _url($module_base.'showAdd'); ?>" class="col-8 btn btn-success"> Ajouter</a>
                         </div>
                         <div class="row justify-content-center mt-30">
                              <table id="example" class="table table-striped table-bordered" >
                                   <thead>
                                        <tr>
                                             <th>Libellé</th>
                                             <th>Description</th>
                                             <th class="justify-content-center" style="width: 100px;">Opérations</th>
                                        </tr>
                                   </thead>
                                   <tbody>
                                        <?php if(is_array(@$datagrid)):?>
                                             <?php foreach(@$datagrid as $rows):?>
                                                  <tr>
                                                       <td><?=@$rows->categorie_libelle?></td>
                                                       <td><?=@$rows->categorie_desc?></td>
                                                       <td>
                                                            <a class="btn btn-warning btn-fab btn-icon btn-round" href="<?php _url($module_base.'showEdit/'.$rows->categorie_id); ?>">
                                                                 <i class="fa fa-edit"></i>
                                                            </a>
                                                            <a class="btn btn-default btn-fab btn-icon btn-round" href="<?php _url($module_base.'showProduct/?categorie_id='.$rows->categorie_id); ?>">
                                                                 <i class="fa fa-list"></i>
                                                            </a>
                                                            <a class="btn btn-danger btn-fab btn-icon btn-round" href="<?php _url($module_base.'showRemove/'.$rows->categorie_id); ?>">
                                                                 <i class="fa fa-trash"></i>
                                                            </a>
                                                       </td>
                                                  </tr>
                                             <?php endforeach;?>
                                        <?php endif;?>
                                   </tbody>
                                   <tfoot>
                                        <tr>
                                             <th>Libelle</th>
                                             <th>Description</th>
                                             <th>Opérations</th>
                                        </tr>
                                   </tfoot>
                              </table>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
