<!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<!------ Include the above in your HEAD tag ---------->

<style media="screen">
.list-group-item{
     background-color: transparent;
}
</style>

<div class="row">
     <div class="col-lg-12 my-3">
          <div class="pull-right">
               <div class="btn-group">
                    <button class="btn btn-info" id="list">
                         Liste
                    </button>
                    <button class="btn btn-danger" id="grid">
                         Grille
                    </button>
               </div>
          </div>
     </div>
</div>

<div id="products" class="row view-group">
     <?php if (is_array($datagrid)): ?>
          <?php foreach ($datagrid as $key => $row): ?>
               <div class="item col-xs-4 col-lg-4">
                    <div class="thumbnail card">
                         <div class="img-event">
                              <img class="group list-group-image img-fluid" src="http://placehold.it/400x250/000/fff" alt="" />
                         </div>
                         <div class="caption card-body">
                              <h4 class="group card-title inner list-group-item-heading">
                                   <?= $row->studie_name ?>
                              </h4>
                              <p class="group inner list-group-item-text">
                                   <?php $cpt = 0; ?>
                                   <?php foreach ($row->contents as $key => $content): ?>
                                        <?php if ($content->studie_content_type == 1 && $cpt == 0): ?>
                                             <?= quill_format($content->studie_content_desc) ?>
                                             <?php $cpt++; ?>
                                        <?php endif; ?>
                                   <?php endforeach; ?>
                              </p>
                              <div class="row">
                                   <div class="col-xs-12 col-md-6">
                                        <p class="text-muted mt-30" style="font-size: 12px;">
                                             <strong>Date : </strong><?= gmdate("d-m-Y", $row->studie_added) ?>
                                        </p>
                                   </div>
                                   <div class="col-xs-12 col-md-6 mt-3">
                                        <a class="btn btn-success" href="http://www.jquery2dotnet.com">Add to cart</a>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          <?php endforeach; ?>
     <?php endif; ?>
</div>

<div id="custom-delete-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Supprimer</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'delete'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 mt-50">
                              <p style="text-align: center; font-size: 14px;">
                                   Le rapport selectionner sera supprimer. <br>
                                   Souhaitez-vous continuer ?
                              </p>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" type="text" name="studie_id">
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-danger col-md-4">Delete</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>
