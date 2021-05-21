
<div class="card">
     <div class="card-title">
          <h5 class="title">Liste des modules</h5>
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
                                        <td><?=@$rows->module_name?></td>
                                        <td><?=@$rows->module_desc?></td>
                                        <td class="text-center">
                                             <div class="item-action dropdown">
                                                  <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions</button>
                                                  <div class="dropdown-menu dropdown-menu-right">
                                                       <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-plus-square"></i> Détails </a>
                                                       <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Modifier </a>
                                                       <div class="dropdown-divider"></div>
                                                       <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-trash"></i> Supprimer </a>
                                                  </div>
                                             </div>
                                        </td>
                                        <!-- <td>
                                        <a class="btn btn-warning btn-fab btn-icon btn-round" href="<?php _url($module_base.'showEdit/'.$rows->module_id); ?>">
                                        <i class="fa fa-edit"></i>
                                   </a>
                                   <a class="btn btn-default btn-fab btn-icon btn-round" href="<?php _url($module_base.'showProduct/?categorie_id='.$rows->module_id); ?>">
                                   <i class="fa fa-list"></i>
                              </a>
                              <a class="btn btn-danger btn-fab btn-icon btn-round" href="<?php _url($module_base.'showRemove/'.$rows->module_id); ?>">
                              <i class="fa fa-trash"></i>
                         </a>
                    </td> -->
               </tr>
          <?php endforeach;?>
     <?php endif;?>
</tbody>
</table>
</div>
</div>
</div>
