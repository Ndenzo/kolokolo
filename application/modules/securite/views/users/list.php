<div class="row mt-3">
     <div class="col-12">
          <div class="card-box">
               <h4 class="mt-0 header-title">Liste des utilisateurs</h4>
               <!-- <p class="text-muted font-14 mb-3">
                    DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>.
               </p> -->
               <?php show_notification();?>
               <div class="row justify-content-center mt-3 mb-3">
                    <a href="<?php _url('securite/users/showAdd'); ?>" class="col-4 btn btn-success"> Ajouter</a>
               </div>
               <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap">
                    <thead>
                         <tr>
                              <th> Login </th>
                              <th> Nom Complet </th>
                              <th> Email </th>
                              <th> Enregistrement </th>
                              <th> Status </th>
                              <th class="justify-content-center" style="width: 100px;">Opérations</th>
                         </tr>
                    </thead>
                    <tbody>
                         <?php if(is_array(@$datagrid)):?>
                              <?php foreach(@$datagrid as $rows):?>
                                   <tr>
                                        <td><?=$rows->user_login?></td>
                                        <td><?=$rows->user_nicename?></td>
                                        <td><?=$rows->user_email?></td>
                                        <td><?=gmdate('d/m/Y',$rows->user_registered)?></td>
                                        <td><?=gmdate('d/m/Y',$rows->user_registered)?></td>
                                        <td style="text-align:center;">
                                             <div class="item-action dropdown">
                                                  <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions <i class="mdi mdi-chevron-down"></i></button>
                                                  <div class="dropdown-menu dropdown-menu-right">
                                                       <a href="<?php _url($module_base.'showLog/'.$rows->user_id); ?>" class="dropdown-item"><i class="dropdown-icon fe fe-plus-square"></i> Logs </a>
                                                       <a href="<?php _url($module_base.'showEdit/'.$rows->user_id); ?>" class="dropdown-item"><i class="dropdown-icon mdi mdi-square-edit-outline"></i> Modifier </a>
                                                       <div class="dropdown-divider"></div>
                                                       <a href="<?php _url($module_base.'showRemove/'.$rows->user_id); ?>" class="dropdown-item"><i class="dropdown-icon mdi mdi-trash-can-outline"></i> Supprimer </a>
                                                  </div>
                                             </div>
                                        </td>
                                   </tr>
                              <?php endforeach;?>
                         <?php endif;?>
                    </tbody>
               </table>
          </div>
     </div>
</div>
