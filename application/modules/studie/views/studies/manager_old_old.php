<style>
.img-container img {
     max-width: 100%;
}
.option-btn{
     max-width: 40px!important;
     margin: 5px!important;
}
</style>

<div class="row">
     <!-- <div class="container"> -->
          <div class="col-12">
               <div class="card">
                    <div class="card-body">
                         <div class="card-title row mb-5">
                              <h4 class="col-7 font-weight-bold text-uppercase"><?= $title ?> </h4>
                              <div class="col-5">
                                   <a href="<?= _url($module_base.('showAdd')) ?>"  class="btn btn-success btn-icon-text float-right"><?= $this->lang->line('btn-add') ?> <i class="fa fa-plus btn-icon-append"></i> </a>
                              </div>
                         </div>
                         <div class="row">
                              <?php if (is_array($datagrid)): ?>
                                   <?php foreach ($datagrid as $key => $row): ?>
                                        <div class="col-6 mt-30">
                                             <div class="card">
                                                  <div class="card-body">
                                                       <h4 class="card-title"><?= $row->studie_name ?></h4>

                                                       <div class="row">
                                                            <div class="col-12 text-justify" style="font-size: 12px;">
                                                                 <?php $cpt = 0; ?>
                                                                 <?php foreach ($row->contents as $key => $content): ?>
                                                                      <?php if ($content->studie_content_type == 1 && $cpt == 0): ?>
                                                                           <?= substr(strip_tags(quill_format($content->studie_content_desc)), 0, 250); ?> ...
                                                                           <?php $cpt++; ?>
                                                                      <?php endif; ?>
                                                                 <?php endforeach; ?>
                                                            </div>
                                                       </div>

                                                       <div class="d-flex justify-content-between mt-20">
                                                            <p class="text-muted mt-3">
                                                                 <strong>Date :</strong> <?= gmdate("d-m-Y", $row->studie_added) ?>
                                                            </p>
                                                            <div class="float-right">
                                                                 <div class="btn-group" role="group" aria-label="Basic example">
                                                                      <a href="<?= _url($module_base.'showContent/'.$row->studie_id) ?>" class="btn btn-inverse-info btn-icon-text btn-icon-prepend font-weight-bold">
                                                                           Consulter
                                                                      </a>
                                                                      <!-- <a href="#custom-delete-modal" class="btn btn-warning font-weight-bold text-white">
                                                                           <i class="fa fa-edit"></i>
                                                                      </a> -->
                                                                      <?php if (me('role_code') == 'root'): ?>
                                                                           <a href="#custom-delete-modal" class="btn btn-danger font-weight-bold text-white"  data-toggle="modal" onclick="define_delete(<?= @$row->studie_id ?>, 'studie_id')">
                                                                                <i class="fa fa-trash"></i>
                                                                           </a>
                                                                      <?php endif; ?>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   <?php endforeach; ?>
                              <?php endif; ?>
                         </div>
                    </div>
               </div>
          </div>
     <!-- </div> -->
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
                                   L'étude selectionner sera supprimer. <br>
                                   Souhaitez-vous continuer ?
                              </p>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" type="text" name="studie_id">
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-danger col-md-4">Supprimer</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>
