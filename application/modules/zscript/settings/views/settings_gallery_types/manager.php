<div class="row">
     <div class="col-12">
          <div class="card">
               <div class="card-body">
                    <div class="card-title row mb-5">
                         <h3 class="col-7">TYPE DE GALERIE</h3>
                         <div class="col-5">
                              <a href="#custom-modal"  class="btn btn-success float-right btn-lg" data-toggle="modal"> Ajouter </a>
                         </div>
                    </div>
                    <?php show_notification();?>
                    <div class="table-responsive">
                         <table id="order-listing" class="table">
                              <thead>
                                   <tr>
                                        <th class="text-center" style="width:30px;">#</th>
                                        <th class="text-center" style="width:200px;">Code</th>
                                        <th class="col">Valeurs</th>
                                        <th class="text-center" style="width: 200px;">Action</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <?php if(is_array(@$datagrid)):?>
                                        <?php foreach(@$datagrid as $key => $rows):?>
                                             <tr>
                                                  <td class="text-center"><?=@$key+1?></td>
                                                  <td class="text-center"><?=@$rows->settings_gallery_type_code?></td>
                                                  <td><?=@$rows->settings_gallery_type_name?></td>
                                                  <td class="footable-last-visible text-center" style="width: 150px;">
                                                       <a href="#custom-update-modal" class="btn btn-small btn-outline-warning" data-toggle="modal" onclick="define_edit(<?= $rows->settings_gallery_type_id ?>, 'settings/settings_gallery_type/showEdit')"><i class="fa fa-pencil"></i></a>
                                                       <a href="#custom-delete-modal" class="btn btn-small btn-outline-danger" data-toggle="modal" onclick="define_delete(<?= $rows->settings_gallery_type_id ?>, 'settings_gallery_type_id')"><i class="fa fa-trash"></i></a>
                                                  </td>
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

<div id="custom-modal" class="modal fade bs-example-modal-center show" tabindex="-1" eleve="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Ajouter Paramètre</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'insert'); ?>" method="post">
                         <div class="col-10 col-md-12">
                              <div class="job-filter">
                                   <div class="faq-form">
                                        <input class="form-control" type="text" placeholder="Code.." name="settings_gallery_type_code" required><i class="search-icon" data-feather="code"></i>
                                   </div>
                                   <div class="faq-form mt-3">
                                        <input class="form-control" type="text" placeholder="Value.." name="settings_gallery_type_name" required><i class="search-icon" data-feather="edit-3"></i>
                                   </div>
                              </div>
                              <div class="modal-footer mt-3">
                                   <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                   <button type="submit" class="btn btn-success col-md-4">Ajouter</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<!-- Edit manager ///////////////////////////////////////////////////////////////////////////////////////////////// -->

<div id="custom-update-modal" class="modal fade bs-example-modal-center show" tabindex="-1" user="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Modifier</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'update'); ?>" method="post">
                         <div class="col-10 col-md-12 mt-50">
                              <div class="form-group mb-3">
                                   <label>payment code</label>
                                   <input type="text" class="form-control" placeholder="Code.." name="settings_gallery_type_code" id="settings_gallery_type_code" required>
                              </div>
                              <div class="form-group mb-3">
                                   <label>payment name</label>
                                   <textarea type="text" class="form-control" placeholder="Name.." name="settings_gallery_type_name" id="settings_gallery_type_name" rows="8" cols="80" required></textarea>
                              </div>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" class="form-control" name="settings_gallery_type_id" id="settings_gallery_type_id" required>
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                                   <button type="submit" class="btn btn-warning col-md-4">Update</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<!-- Delete manager ///////////////////////////////////////////////////////////////////////////////////////////////// -->

<div id="custom-delete-modal" class="modal fade bs-example-modal-center show" tabindex="-1" user="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
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
                                   The selected element will be permanently deleted. <br>
                                   Do you want to continue this operation?
                              </p>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" type="text" name="settings_gallery_type_id">
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                                   <button type="submit" class="btn btn-danger col-md-4">Delete</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>
