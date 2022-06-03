<style media="screen">
#img-hover {
     position: relative;
     text-align: center;
     color: white;
}

#img-hover-centered {
     position: absolute;
     top: 50%;
     left: 50%;
     transform: translate(-50%, -50%);
}
.select2-container--default .select2-selection--multiple .select2-selection__rendered li{
     font-size: 14px;
}
</style>

<form id="form_project" class="validatedForm" method="post" action="<?= _url($module_base.'insert') ?>" autocomplete="off" enctype="multipart/form-data">
     <div class="container-fluid">
          <div class="row">
               <div class="col-xl-7">

                    <div class="card mb-3">
                         <div class="card-body">
                              <div class="card-title mb-5">
                                   <h5 class="text-uppercase font-weight-bold"> <?= @$this->lang->line('project-header-project') ?> </h5>
                              </div>
                              <?php show_notification();?>
                              <div class="row mb-4">
                                   <div class="col-12">
                                        <div class="theme-form mega-form">
                                             <div class="form-group mb-3">
                                                  <label><?= @$this->lang->line('project-form-label-name') ?> <span class="needed">*</span> </label>
                                                  <input type="text" class="form-control" placeholder="<?= @$this->lang->line('project-form-placeholder-name') ?>" name="project_name" required>
                                             </div>
                                             <div class="row">
                                                  <div class="form-group mb-3 col-4">
                                                       <label><?= @$this->lang->line('project-form-label-value') ?> <span class="needed">*</span> </label>
                                                       <input type="number" class="form-control" placeholder="<?= @$this->lang->line('project-form-placeholder-value') ?>" name="project_value" required>
                                                  </div>
                                                  <div class="form-group mb-3 col-8">
                                                       <label><?= @$this->lang->line('project-form-label-type') ?> <span class="needed">*</span> </label>
                                                       <?php dropDown('SELECT sim_type_id, sim_type_name FROM sim_types ORDER BY sim_type_name',array(
                                                            'name' => 'sim_type_id',
                                                            'id' => "sim_type_id_form",
                                                            'class' => 'form-control select_custom',
                                                            'attr' => 'required'
                                                       ));?>
                                                  </div>
                                             </div>
                                             <div class="row">
                                                  <div class="form-group mb-3 col-6">
                                                       <label><?= @$this->lang->line('project-form-label-state') ?> <span class="needed">*</span> </label>
                                                       <?php dropDown('SELECT sim_state_id, sim_state_name FROM sim_states ORDER BY sim_state_name',array(
                                                            'name' => 'sim_state_id',
                                                            'id' => "sim_state_id_form",
                                                            'class' => 'form-control select_custom',
                                                            'attr' => 'required'
                                                       ));?>
                                                  </div>
                                                  <div class="form-group mb-3 col-6">
                                                       <label><?= @$this->lang->line('project-form-label-town') ?> <span class="needed">*</span> </label>
                                                       <?php dropChained('SELECT sim_town_id, sim_town_name, sim_state_id FROM sim_towns',array(
                                                            'name' => 'sim_town_id',
                                                            'id' => "sim_town_id_form",
                                                            'class' => 'form-control select_custom',
                                                            'attr' => 'required'
                                                       ));?>
                                                  </div>
                                             </div>
                                             <div class="form-group mb-3">
                                                  <label><?= @$this->lang->line('project-form-label-address') ?> <span class="needed">*</span> </label>
                                                  <input type="text" class="form-control" placeholder="<?= @$this->lang->line('project-form-placeholder-address') ?>" name="project_address" required>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <hr>
                              <div class="row mt-4">
                                   <div class="col-12">
                                        <div class="theme-form mega-form">
                                             <div class="row">
                                                  <div class="form-group mb-3 col-6">
                                                       <label><?= @$this->lang->line('project-form-label-lenght') ?> <span class="needed">*</span> </label>
                                                       <input type="number" class="form-control" placeholder="<?= @$this->lang->line('project-form-placeholder-lenght') ?>" name="project_invest_term" min="0" step="1" required>
                                                  </div>
                                                  <div class="form-group mb-3 col-6">
                                                       <label><?= @$this->lang->line('project-form-label-investDebut') ?> <span class="needed">*</span> </label>
                                                       <input type="date" class="form-control mask-date" placeholder="" name="project_invest_debut" required>
                                                  </div>
                                             </div>
                                             <div class="row">
                                                  <div class="form-group mb-3 col-6">
                                                       <label><?= @$this->lang->line('project-form-label-investRent') ?></label>
                                                       <input type="number" min="0" step="0.01" class="form-control" placeholder="<?= @$this->lang->line('project-form-placeholder-investRent') ?>" name="project_prev_rent">
                                                  </div>
                                                  <div class="form-group mb-3 col-6">
                                                       <label><?= @$this->lang->line('project-form-label-investReturn') ?></label>
                                                       <input type="number" min="0" step="0.01" class="form-control" placeholder="<?= @$this->lang->line('project-form-placeholder-investReturn') ?>" name="project_prev_return">
                                                  </div>
                                             </div>
                                             <div class="row">
                                                  <div class="form-group mb-3 col-6">
                                                       <label><?= @$this->lang->line('project-form-label-rentIncome') ?></label>
                                                       <input type="number" class="form-control" placeholder="<?= @$this->lang->line('project-form-placeholder-rentIncome') ?>" name="project_local_income">
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>

                    <div class="card mb-3">
                         <div class="card-body">
                              <div class="card-title mb-5">
                                   <h5 class="text-uppercase font-weight-bold"> <?= @$this->lang->line('project-header-desc') ?> </h5>
                              </div>
                              <ul class="nav nav-pills nav-pills-custom mt-3" id="pills-tab-custom" role="tablist">
                                   <li class="nav-item">
                                        <a class="nav-link active" id="pills-fr-desc-tab-custom" data-toggle="pill" href="#pills-fr-desc" role="tab" aria-controls="pills-fr-desc" aria-selected="true">
                                             <?= $this->lang->line('label-french-title') ?>
                                        </a>
                                   </li>
                                   <li class="nav-item">
                                        <a class="nav-link" id="pills-gb-desc-tab-custom" data-toggle="pill" href="#pills-gb-desc" role="tab" aria-controls="pills-gb-desc" aria-selected="false">
                                             <?= $this->lang->line('label-english-title') ?>
                                        </a>
                                   </li>
                              </ul>

                              <div class="tab-content tab-content-custom-pill" id="pills-tabContent-custom" style="margin-top:-30px;">
                                   <div class="tab-pane fade show active" id="pills-fr-desc" role="tabpanel" aria-labelledby="pills-fr-desc-tab-custom">
                                        <div id="quillEditor" class="quill-container col-12" style="height:450px;"></div>
                                        <textarea class="d-none" name="project_desc" id="project_desc"></textarea>
                                   </div>
                                   <div class="tab-pane fade" id="pills-gb-desc" role="tabpanel" aria-labelledby="pills-gb-desc-tab-custom">
                                        <div id="quillEditor_gb" class="quill-container col-12" style="height:450px;"></div>
                                        <textarea class="d-none" name="project_desc_gb" id="project_desc_gb"></textarea>
                                   </div>
                              </div>

                         </div>
                    </div>

                    <div class="card mb-3">
                         <div class="card-body">
                              <div class="card-title mb-5">
                                   <h5 class="text-uppercase font-weight-bold"> <?= @$this->lang->line('project-header-location') ?> </h5>
                              </div>
                              <div class="col-12" id="map" style="height:300px!important;"></div>
                              <div class="row">
                                   <div class="form-group mb-3 col-4">
                                        <input type="hidden" name="project_lat" id="project_lat" value="14.7185059">
                                   </div>
                                   <div class="form-group mb-3 col-8">
                                        <input type="hidden" name="project_lon" id="project_lon" value="-17.4440257">
                                   </div>
                              </div>
                         </div>
                    </div>

               </div>
               <div class="col-xl-5">

                    <div class="card mb-3">
                         <div class="card-body">
                              <div class="card-title mb-5">
                                   <h5 class="text-uppercase font-weight-bold"> <?= @$this->lang->line('project-header-picture') ?> </h5>
                              </div>
                              <div class="row">
                                   <div class="col-12 text-center">
                                        <label class="label row" id="img-hover" data-toggle="tooltip" title="Change your avatar">
                                             <img class="rounded ml-auto mr-auto" id="avatar"  src="<?= _url('assets/custom/img/default/default.png') ?>" alt="No image"  style="height: 250px;">

                                             <input type="file" class="sr-only" id="input" name="picture" accept="image/*">
                                             <div id="picture_data"></div>
                                             <div id="img-hover-centered"><i data-feather="image"></i></div>
                                        </label>
                                   </div>
                              </div>
                              <div class="card-title mb-5 mt-5">
                                   <h5 class="text-uppercase font-weight-bold"> <?= @$this->lang->line('project-header-gallery') ?> </h5>
                              </div>
                              <div class="row">
                                   <div class="col-12">
                                        <div class="file-upload-wrapper">
                                             <div class="row">
                                                  <div class="form-group col-sm-4">
                                                       <div class="img-picker"></div>
                                                  </div>
                                                  <div id="img_picker_extension"></div>
                                                  <div class="form-group col-sm-4">
                                                       <button type="button" class="btn btn-secondary form-control" id="img_picker_add" style="height:100%; ">
                                                            <i class="fa fa-plus"></i>
                                                       </button>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>

                    <div class="card mb-3">
                         <div class="card-body">
                              <div class="card-title row mb-3">
                                   <h5 class="col-7 text-uppercase font-weight-bold"> <?= @$this->lang->line('project-header-charac') ?> </h5>
                                   <div class="col-5">
                                        <a href="#custom-charac-modal"  class="btn btn-success float-right" data-toggle="modal"><?= @$this->lang->line('btn-add') ?></a>
                                   </div>
                              </div>
                              <div class="row">
                                   <div class="col-12 mb-3">
                                        <div class="alert alert-warning inverse alert-dismissible fade show" role="alert">
                                             <p class="mt-2" style="font-size: 12px;">
                                                  <?= @$this->lang->line('project-message-charac') ?>
                                             </p>
                                        </div>
                                        <div class="responsive-table">
                                             <table class="table table-striped table-bordered">
                                                  <thead>
                                                       <tr>
                                                            <th><?= @$this->lang->line('project-table-label-desc') ?></th>
                                                            <th><?= @$this->lang->line('project-table-label-value') ?></th>
                                                            <th><?= @$this->lang->line('project-table-label-action') ?></th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       <tr id="characs_extension">
                                                            <td colspan="3" class="text-center"><?= @$this->lang->line('project-message-addValue') ?></td>
                                                       </tr>
                                                  </tbody>
                                             </table>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>

                    <div class="card mb-3">
                         <div class="card-body">
                              <div class="card-title row mb-3">
                                   <h5 class="col-7 text-uppercase font-weight-bold"> <?= @$this->lang->line('project-header-struc') ?> </h5>
                                   <div class="col-5">
                                        <a href="#custom-neighbor-modal"  class="btn btn-success float-right" data-toggle="modal"><?= @$this->lang->line('btn-add') ?></a>
                                   </div>
                              </div>
                              <div class="row">
                                   <div class="col-12 mb-3">
                                        <div class="alert alert-warning inverse alert-dismissible fade show" role="alert">
                                             <p class="mt-2" style="font-size: 12px;">
                                                  <?= @$this->lang->line('project-message-struc') ?>
                                             </p>
                                        </div>
                                        <div class="responsive-table">
                                             <table class="table table-striped table-bordered">
                                                  <thead>
                                                       <tr>
                                                            <th><?= @$this->lang->line('project-table-label-struc') ?></th>
                                                            <th><?= @$this->lang->line('project-table-label-desc') ?></th>
                                                            <th><?= @$this->lang->line('project-table-label-action') ?></th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       <tr id="neighbors_extension">
                                                            <td colspan="3" class="text-center"><?= @$this->lang->line('project-message-addValue') ?></td>
                                                       </tr>
                                                  </tbody>
                                             </table>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>

                    <div class="card mb-3">
                         <div class="card-body">
                              <div class="card-title row mb-3">
                                   <h5 class="text-uppercase font-weight-bold"><?= @$this->lang->line('project-header-convenience') ?></h5>
                              </div>
                              <div class="row">
                                   <div class="col-12 mb-3">
                                        <div class="alert alert-warning inverse alert-dismissible fade show" role="alert">
                                             <p class="mt-2" style="font-size: 12px;">
                                                  <?= @$this->lang->line('project-message-convenience') ?>
                                             </p>
                                        </div>
                                        <?php dropDown('SELECT convenience_id, convenience_name FROM conveniences',array(
                                             'name'=>'convenience_ids[]',
                                             'id'=>"convenience_id_form",
                                             'class' => 'form-control select_custom',
                                             'attr' => 'multiple',
                                        )); ?>
                                   </div>
                              </div>
                         </div>
                    </div>

                    <div class="card mb-3">
                         <div class="card-body">
                              <div class="card-title row mb-3">
                                   <h5 class="col-7 text-uppercase font-weight-bold"><?= @$this->lang->line('project-header-timeline') ?></h5>
                                   <div class="col-5">
                                        <a href="#custom-timeline-modal"  class="btn btn-success float-right" data-toggle="modal"><?= @$this->lang->line('btn-add') ?></a>
                                   </div>
                              </div>
                              <div class="row">
                                   <div class="col-12 mb-3">
                                        <div class="alert alert-warning inverse alert-dismissible fade show" role="alert">
                                             <p class="mt-2" style="font-size: 12px;">
                                                  <?= @$this->lang->line('project-message-timeline') ?>
                                             </p>
                                        </div>
                                        <div class="responsive-table">
                                             <table class="table table-striped table-bordered">
                                                  <thead>
                                                       <tr>
                                                            <th><?= @$this->lang->line('project-table-label-desc') ?></th>
                                                            <th><?= @$this->lang->line('project-table-label-period') ?></th>
                                                            <th><?= @$this->lang->line('project-table-label-action') ?></th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       <tr id="timeline_extension">
                                                            <td colspan="3" class="text-center"><?= @$this->lang->line('project-message-addValue') ?></td>
                                                       </tr>
                                                  </tbody>
                                             </table>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>

                    <div class="card mb-3">
                         <div class="card-body">
                              <div class="card-title row mb-3">
                                   <h5 class="col-7 text-uppercase font-weight-bold"><?= @$this->lang->line('project-header-disbursal') ?></h5>
                                   <div class="col-5">
                                        <a href="#custom-schedule-modal"  class="btn btn-success float-right" data-toggle="modal"><?= @$this->lang->line('btn-add') ?></a>
                                   </div>
                              </div>
                              <div class="row">
                                   <div class="col-12 mb-3">
                                        <div class="alert alert-warning inverse alert-dismissible fade show" role="alert">
                                             <p class="mt-2" style="font-size: 12px;">
                                                  <?= @$this->lang->line('project-message-disbursal') ?>
                                             </p>
                                        </div>
                                        <div class="responsive-table">
                                             <table class="table table-striped table-bordered">
                                                  <thead>
                                                       <tr>
                                                            <th><?= @$this->lang->line('project-table-label-desc') ?></th>
                                                            <th><?= @$this->lang->line('project-table-label-value') ?></th>
                                                            <th><?= @$this->lang->line('project-table-label-action') ?></th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       <tr id="schedules_extension">
                                                            <td colspan="3" class="text-center"><?= @$this->lang->line('project-message-addValue') ?></td>
                                                       </tr>
                                                  </tbody>
                                             </table>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>

               </div>
          </div>
          <div class="fixed-bottom mb-5 col-1 ml-auto">
               <button type="submit" class="btn btn-success text-white form-control" title="submit"> <h1><span class="fa fa-check"></span></h1> </button>
          </div>
     </div>

     <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
               <div class="modal-content">
                    <div class="modal-header">
                         <h5 class="modal-title" id="modalLabel"><?= @$this->lang->line('project-header-crop') ?></h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                         </button>
                    </div>
                    <div class="modal-body">
                         <div class="img-container">
                              <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
                         </div>
                    </div>
                    <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= @$this->lang->line('btn-cls') ?></button>
                         <button type="button" class="btn btn-primary" id="crop"><?= @$this->lang->line('btn-crop') ?></button>
                    </div>
               </div>
          </div>
     </div>
</form>

<div id="custom-timeline-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel1" aria-modal="true">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel1"><?= @$this->lang->line('project-header-newTimeline') ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form id="timeline_form">
                         <div class="col-12 col-md-12">
                              <div class="form-group mb-3">
                                   <label>Nom de la timeline</label>
                                   <input type="text" class="form-control" placeholder="Nom" id="timeline_name" required>
                              </div>

                              <div class="row">
                                   <div class="form-group mb-3 col-6">
                                        <label>Mois</label>
                                        <select class="select_custom" id="timeline_month" required>
                                             <option value=""></option>
                                             <option value="1">Janvier</option>
                                             <option value="2">Février</option>
                                             <option value="3">Mars</option>
                                             <option value="4">Avril</option>
                                             <option value="5">Mai</option>
                                             <option value="6">Juin</option>
                                             <option value="7">Juillet</option>
                                             <option value="8">Août</option>
                                             <option value="9">Septembre</option>
                                             <option value="10">Octobre</option>
                                             <option value="11">Novembre</option>
                                             <option value="12">Décembre</option>
                                        </select>
                                   </div>

                                   <div class="form-group mb-3 col-6">
                                        <label>Année</label>
                                        <input type="number" class="form-control" placeholder="YYYY" id="timeline_year" required>
                                   </div>
                              </div>

                              <div class="modal-footer mt-5">
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                                   <button class="btn btn-info col-md-4" id="timeline_add"><?= @$this->lang->line('btn-save') ?></button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<div id="custom-schedule-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel1" aria-modal="true">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel1"><?= @$this->lang->line('project-header-newDisbursal') ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form id="schedule_form">
                         <div class="col-12 col-md-12">
                              <div class="form-group mb-3">
                                   <label>Nom du décaissement</label>
                                   <input type="text" class="form-control" placeholder="Nom" id="schedule_name" required>
                              </div>

                              <div class="form-group mb-3">
                                   <label>Pourcentage</label>
                                   <input type="number" class="form-control" placeholder="Pourcentage" id="schedule_value" max="100" required>
                              </div>

                              <div class="modal-footer mt-5">
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                                   <button class="btn btn-info col-md-4" id="schedule_add">Ajouter</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<div id="custom-charac-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel1" aria-modal="true">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel1"><?= @$this->lang->line('project-header-newCharac') ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form id="charac_form">
                         <div class="col-12 col-md-12">
                              <div class="form-group mb-3">
                                   <label>Nom de la caractéristique</label>
                                   <input type="text" class="form-control" placeholder="Nom" id="charac_name" required>

                              </div>

                              <div class="form-group mb-3">
                                   <label>Valeur</label>
                                   <input type="text" class="form-control" placeholder="Pourcentage" id="charac_value" required>
                              </div>

                              <div class="modal-footer mt-5">
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                                   <button class="btn btn-info col-md-4" id="charac_add">Ajouter</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<div id="custom-neighbor-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel1" aria-modal="true">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel1"><?= @$this->lang->line('project-header-newStruc') ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form id="neighbor_form">
                         <div class="col-12 col-md-12">
                              <div class="form-group mb-3">
                                   <label>Nom de la structure</label>
                                   <input type="text" class="form-control" placeholder="Nom" id="neighbor_structure" required>
                              </div>

                              <div class="form-group mb-3">
                                   <label>Distance</label>
                                   <input type="text" class="form-control" placeholder="valeur" id="neighbor_distance" required>
                              </div>

                              <div class="modal-footer mt-5">
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                                   <button class="btn btn-info col-md-4" id="neighbor_add"><?= @$this->lang->line('btn-save') ?></button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>


<script>

document.getElementById("img-hover-centered").style.visibility = "hidden";

document.getElementById("img-hover").addEventListener("mouseover", function( event ) {
     document.getElementById("img-hover-centered").style.visibility = "visible";
}, false);

document.getElementById("img-hover").addEventListener("mouseout", function( event ) {
     document.getElementById("img-hover-centered").style.visibility = "hidden";
}, false);


window.addEventListener('DOMContentLoaded', function () {
     var avatar = document.getElementById('avatar');
     var image = document.getElementById('image');
     var input = document.getElementById('input');
     var $modal = $('#modal');
     var cropper;

     $('[data-toggle="tooltip"]').tooltip();

     input.addEventListener('change', function (e) {
          var files = e.target.files;
          var done = function (url) {
               input.value = '';
               image.src = url;
               $modal.modal('show');
          };
          var reader;
          var file;
          var url;

          if (files && files.length > 0) {
               file = files[0];

               if (URL) {
                    done(URL.createObjectURL(file));
               } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function (e) {
                         done(reader.result);
                    };
                    reader.readAsDataURL(file);
               }
          }
     });

     $modal.on('shown.bs.modal', function () {
          cropper = new Cropper(image, {
               aspectRatio: 0,
               viewMode: 2,
          });
     }).on('hidden.bs.modal', function () {
          cropper.destroy();
          cropper = null;
     });

     document.getElementById('crop').addEventListener('click', function () {
          var initialAvatarURL;
          var canvas;

          $modal.modal('hide');

          if (cropper) {
               canvas = cropper.getCroppedCanvas({
                    width: 350,
                    height: 350,
               });
               initialAvatarURL = avatar.src;
               avatar.src = canvas.toDataURL();

               $('#picture_data').html(
                    "<input type='hidden' name='photo' value='"+canvas.toDataURL()+"' >"
               );

               canvas.toBlob(function (blob) {
                    var formData = new FormData();

                    formData.append('avatar', blob, 'avatar.jpg');

               });
          }
     });
});

</script>
