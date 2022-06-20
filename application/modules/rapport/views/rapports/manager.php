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
     <div class="col-12">
          <div class="card">
               <div class="card-body">
                    <div class="card-title row mb-5">
                         <h4 class="col-7">Etudes </h4>
                         <?php if (me('role_code') == "root"): ?>
                              <div class="col-5">
                                   <a href="#custom-modal"  class="btn btn-success float-right" data-toggle="modal"><i class="fa fa-plus"></i> Ajouter </a>
                              </div>
                         <?php endif; ?>
                    </div>
                    <?php if (me('role_code') == 'root'): ?>
                         <div class="row mb-3">
                              <div class="col-sm-6 col-xl-3 col-lg-6">
                                   <div class="card o-hidden">
                                        <div class="bg-primary b-r-4 card-body">
                                             <div class="media static-top-widget text-white">
                                                  <div class="align-self-center text-center"><i data-feather="archive"></i></div>
                                                  <div class="media-body"><span class="m-0">Total</span>
                                                       <h4 class="mb-0 counter"><?= @count($datagrid) ?></h4>
                                                  </div>

                                             </div>
                                        </div>
                                   </div>
                              </div>

                              <div class="col-sm-6 col-xl-3 col-lg-6">
                                   <div class="card o-hidden">
                                        <div class="bg-success b-r-4 card-body">
                                             <div class="media static-top-widget text-white">
                                                  <div class="align-self-center text-center"><i data-feather="check"></i></div>
                                                  <div class="media-body"><span class="m-0">Actif</span>
                                                       <h4 class="mb-0 counter"><?= @count($datagrid_actif) ?></h4>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>

                              <div class="col-sm-6 col-xl-3 col-lg-6">
                                   <div class="card o-hidden">
                                        <div class="bg-secondary b-r-4 card-body">
                                             <div class="media static-top-widget text-white">
                                                  <div class="align-self-center text-center"><i data-feather="repeat"></i></div>
                                                  <div class="media-body"><span class="m-0">Inactif</span>
                                                       <h4 class="mb-0 counter"><?= @count($datagrid_inactif) ?></h4>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>

                              <div class="col-sm-6 col-xl-3 col-lg-6">
                                   <div class="card o-hidden">
                                        <div class="bg-danger b-r-4 card-body">
                                             <div class="media static-top-widget text-white">
                                                  <div class="align-self-center text-center"><i data-feather="x"></i></div>
                                                  <div class="media-body"><span class="m-0">Bloquer</span>
                                                       <h4 class="mb-0 counter"><?= 0//@get_nbTickets("canceled") ?></h4>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    <?php endif; ?>


                    <?php show_notification();?>

                    <div class="media mt-5">
                         <div class="media-body">
                              <div class="table-responsive">
                                   <table id="order-listing" class="table table-striped table-bordered">
                                        <thead>
                                             <tr>
                                                  <th class="text-center" style="width:30px;">#</th>
                                                  <th class="text-center" style="width: 120px;">Date</th>
                                                  <th>Rapport</th>
                                                  <th class="text-center" style="width: 70px;">Action</th>
                                             </tr>
                                        </thead>
                                        <tbody>
                                             <?php if(is_array(@$datagrid)):?>
                                                  <?php foreach(@$datagrid as $key => $rows):?>
                                                       <tr>
                                                            <td class="text-center"><?=@$key+1?></td>
                                                            <td class="text-center"><?= gmdate("d-m-Y H:i", @$rows->rapport_added)?></td>
                                                            <td><?= @$rows->rapport_name ?></td>
                                                            <td class="footable-last-visible text-center">
                                                                 <div class="dropdown dropleft">
                                                                      <button class="btn p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                           <i class="mdi mdi-dots-horizontal card-menu-btn"></i>
                                                                      </button>
                                                                      <div class="dropdown-menu"  data-x-placement="left-start">
                                                                           <a href="<?php _url(@$rows->rapport_link) ?>" class="text-info dropdown-item" target="_blank"><i class="fa fa-download mr-2"></i> Télécharger</a>
                                                                           <?php if (me('role_code') == "root"): ?>
                                                                                <a href="#custom-lock-modal-<?= @$rows->rapport_id ?>" class="text-info dropdown-item" data-toggle="modal">
                                                                                     <?php if ($rows->rapport_locked == 1): ?>
                                                                                          <i class="fa fa-unlock mr-2"></i> Débloquer
                                                                                     <?php else: ?>
                                                                                          <i class="fa fa-lock mr-2"></i> Bloquer
                                                                                     <?php endif; ?>
                                                                                </a>
                                                                                <div class="dropdown-divider"></div>
                                                                                <a href="#custom-delete-modal" class="text-danger dropdown-item" data-toggle="modal" onclick="define_delete(<?= @$rows->rapport_id ?>, 'rapport_id')"><i class="fa fa-trash mr-2"></i> Supprimer</a>
                                                                           <?php endif; ?>
                                                                      </div>
                                                                 </div>
                                                            </td>
                                                            <?php if (me('role_code') == "root"): ?>
                                                                 <div id="custom-lock-modal-<?= @$rows->rapport_id ?>" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
                                                                      <div class="modal-dialog modal-dialog-centered">
                                                                           <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                     <h4 class="modal-title" id="myCenterModalLabel">
                                                                                          <?php if ($rows->rapport_locked == 1): ?>
                                                                                               Débloquer | <?=$rows->rapport_name?>
                                                                                          <?php else: ?>
                                                                                               Bloquer | <?=$rows->rapport_name?>
                                                                                          <?php endif; ?>
                                                                                     </h4>
                                                                                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                     <form class="row justify-content-center" action="<?php _url($module_base.'locker'); ?>" method="post" enctype="multipart/form-data">
                                                                                          <div class="col-12 mt-50">
                                                                                               <p style="text-align: center; font-size: 14px;">
                                                                                                    Cette opération va changer le statut du rapport. <br>
                                                                                                    Souhaitez-vous continuer ?
                                                                                               </p>
                                                                                               <?php if ($rows->rapport_locked == 1): ?>
                                                                                                    <input type="hidden" type="text" name="rapport_locked" value="0">
                                                                                               <?php else: ?>
                                                                                                    <input type="hidden" type="text" name="rapport_locked" value="1">
                                                                                               <?php endif; ?>
                                                                                               <div class="modal-footer mt-3">
                                                                                                    <input type="hidden" type="text" name="rapport_id" value="<?= @$rows->rapport_id ?>">
                                                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                                                                                                    <button type="submit" class="btn btn-info col-md-4">
                                                                                                         <?php if ($rows->rapport_locked == 1): ?>
                                                                                                              Débloquer
                                                                                                         <?php else: ?>
                                                                                                              Bloquer
                                                                                                         <?php endif; ?>
                                                                                                    </button>
                                                                                               </div>
                                                                                          </div>
                                                                                     </form>
                                                                                </div>
                                                                           </div><!-- /.modal-content -->
                                                                      </div><!-- /.modal-dialog -->
                                                                 </div>
                                                            <?php endif; ?>
                                                       </tr>
                                                  <?php endforeach;?>
                                             <?php endif;?>
                                        </tbody>
                                   </table>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>

<!-- Add manager ///////////////////////////////////////////////////////////////////////////////////////////////// -->

<div id="custom-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="customLabel" aria-modal="true">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="customLabel">Ajouter</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body container">
                    <form class="row justify-content-center" action="<?php _url($module_base.'insert'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-10 col-md-12">

                              <div class="form-group mb-3">
                                   <label>Importer <strong class="needed">(.pdf)</strong> </label>
                                   <input type="file" class="dropify"  name="rapport_link"/>
                              </div>

                              <div class="form-group mb-3">
                                   <label>Nom du rapport</label>
                                   <input type="text" class="form-control" placeholder="rapport" name="rapport_name" required>
                              </div>

                              <div class="modal-footer mt-5">
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-success col-md-4">Ajouter</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<!-- Delete manager ///////////////////////////////////////////////////////////////////////////////////////////////// -->

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
                                   <input type="hidden" type="text" name="rapport_id">
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                                   <button type="submit" class="btn btn-danger col-md-4">Delete</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>
