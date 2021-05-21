
<div class="card">
     <div class="card-title">
          <h5 class="title">Liste des galeries</h5>
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

                         <div class="col-lg-4 mt-30">
                              <div class="card">
                                   <div class="card-body d-flex flex-column">
                                        <h4><a href="#"><?=@$rows->galerie_libelle?></a></h4>
                                        <div class="text-muted"><?php echo substr(strval($rows->galerie_desc), 0, 150)."...";?></div>
                                        <div class="d-flex align-items-center pt-5 mt-auto">
                                             <div class="avatar avatar-md mr-3" style="background-image: url(<?= _url($rows->user_photo) ?>)"></div>
                                             <div>
                                                  <a href="./profile.html" class="text-default"><?= $rows->user_nicename ?></a>
                                                  <small class="d-block text-muted"><?= gmdate("d/m/Y H:i", $rows->galerie_added) ?></small>
                                             </div>
                                             <div class="ml-auto text-muted">
                                                  <a href="<?= _url($module_base.'showGalerie/'.@$rows->galerie_id) ?>" class="icon d-none d-md-inline-block ml-3"><i class="fa fa-picture-o text-info" style="font-size: 40px;"></i></a>
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
