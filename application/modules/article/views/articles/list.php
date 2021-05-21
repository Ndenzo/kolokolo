
<div class="card">
     <div class="card-title">
          <h5 class="title">Liste des blogs</h5>
          <?php include_once('desc.php'); ?>
     </div>
     <?php show_notification();?>
     <div class="card-body all-icons">
          <div class="row justify-content-center">
               <a href="<?php _url($module_base.'showAdd'); ?>" class="col-8 btn btn-success"> Ajouter</a>
          </div>

          <div class="row row-cards row-deck mt-30">
               <?php if(is_array(@$datagrid)):?>
                    <?php foreach(@$datagrid as $rows):?>
                         <div class="col-sm-6 col-xl-3 mt-30">
                              <div class="card">
                                   <div style="height: 250px; background-image: url(<?=_url(@$rows->article_photo)?>); background-repeat: no-repeat; background-position: center; background-size: cover;">
                                   </div>
                                   <div class="card-body d-flex flex-column" style="background-color: white;">
                                        <h4><a href="#"><?=@$rows->article_libelle?></a></h4>
                                        <div class="text-muted"><?php echo substr(strval($rows->article_desc), 0, 150)."...";?></div>
                                        <div class="d-flex align-items-center pt-5 mt-auto">
                                             <div class="avatar avatar-md mr-3" style="background-image: url(<?= _url($rows->user_photo) ?>)"></div>
                                             <div>
                                                  <a href="./profile.html" class="text-default"><?= $rows->user_nicename ?></a>
                                                  <small class="d-block text-muted"><?= gmdate("d/m/Y H:i", $rows->added) ?></small>
                                             </div>
                                             <div class="ml-auto text-muted">
                                                  <div class="item-action dropdown">
                                                       <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions</button>
                                                       <div class="dropdown-menu dropdown-menu-right">
                                                            <a href="<?php _url($module_base.'showEdit/'.$rows->article_id); ?>" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Modifier </a>
                                                            <div class="dropdown-divider"></div>
                                                            <a href="<?php _url($module_base.'showRemove/'.$rows->article_id); ?>" class="dropdown-item"><i class="dropdown-icon fe fe-trash"></i> Supprimer </a>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    <?php endforeach;?>
               <?php endif;?>
          </div>
     </div>
</div>
