<!-- <div class="row mb-3">
     <div class="col-lg-7">
          <div class="d-lg-flex align-items-baseline">
               <h5 class="text-dark mt-3">
                    <?= $this->lang->line('studie-content-title') ?>
               </h5>
          </div>
     </div>
     <div class="col-lg-5 text-lg-right">
          <div class="btn-group" role="group" aria-label="Basic example">
               <a href="#custom-download-modal" class="btn btn-info btn-icon-text mr-2" data-toggle="modal" onclick="define_delete(<?= @$studie->studie_id ?>, 'studie_id')">
                    <?= $this->lang->line('btn-down') ?>
                    <i class="mdi mdi-download btn-icon-append"></i>
               </a>
          </div>
     </div>
</div> -->

<div class="row">
     <div class="container">
          <div class="col-12 grid-margin stretch-card">
               <div class="card">
                    <div class="card-body">
                         <div class="card-title row mb-5">
                              <h4 class="col-9 font-weight-bold"><?= $studie->studie_name ?> </h4>
                              <div class="col-3">
                                   <a href="#custom-download-modal" class="btn btn-info float-right btn-icon-text mr-2" data-toggle="modal" onclick="define_delete(<?= @$studie->studie_id ?>, 'studie_id')">
                                        <?= $this->lang->line('btn-down') ?>
                                        <i class="mdi mdi-download btn-icon-append"></i>
                                   </a>
                              </div>
                         </div>
                         <!-- <h4 class="card-title mt-3 mb-3"><?= $studie->studie_name ?></h4> -->
                         <div class="col-12 mt-5">
                              <?php foreach ($studie->contents as $key => $content): ?>
                                   <?php if ($content->studie_content_type == 1): ?>
                                        <div class="row mt-30">
                                             <?php $to_format = (@me('user_lang') == "english") ? @$content->studie_content_desc_gb : @$content->studie_content_desc ?>
                                             <?= quill_format($to_format); ?>
                                        </div>
                                   <?php else: ?>
                                        <?php $url = (@me('user_lang') == "english") ? @$content->studie_content_desc_gb : @$content->studie_content_desc ?>
                                        <img class="col-12 mt-30" src="<?= _url($url) ?>" alt="capture">
                                   <?php endif; ?>
                              <?php endforeach; ?>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>


<div id="custom-download-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Télécharger</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'download'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-12 mt-3">
                              <div class="alert alert-warning inverse alert-dismissible fade show" role="alert">
                                   <p class="mt-2" style="font-size: 12px;">
                                        Vous souhaitez obtenir l'étude complète ? <br>
                                        Vous recevrez un mail contenant le document.
                                   </p>
                              </div>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" type="text" name="studie_id">
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-info col-md-6">Télécharger</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>
