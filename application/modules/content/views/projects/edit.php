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
</style>

<form id="form_project" class="validatedForm" method="post" action="<?= _url($module_base.'update') ?>" autocomplete="off" enctype="multipart/form-data">
     <div class="container-fluid">
          <div class="row">
               <div class="col-xl-7">
                    <div class="card mb-3">
                         <div class="card-body">
                              <div class="card-title mb-5">
                                   <h5 class="text-uppercase font-weight-bold"> PROJET </h5>
                              </div>
                              <?php show_notification();?>
                              <div class="row mb-4">
                                   <div class="col-md-12">
                                        <div class="theme-form mega-form">
                                             <div class="form-group mb-3">
                                                  <label>Nom du Projet <span class="needed">*</span> </label>
                                                  <input type="text" class="form-control" placeholder="Nom du projet" name="project_name" value="<?= $project->project_name ?>" required>
                                             </div>
                                             <div class="row">
                                                  <div class="form-group mb-3 col-4">
                                                       <label>Valeur <span class="needed">*</span> </label>
                                                       <input type="number" class="form-control" placeholder="Valeur du projet" name="project_value" value="<?= $project->project_value ?>" required>
                                                  </div>
                                                  <div class="form-group mb-3 col-8">
                                                       <label>Type d'immobilier <span class="needed">*</span> </label>
                                                       <?php dropDown('SELECT sim_type_id, sim_type_name FROM sim_types ORDER BY sim_type_name',array(
                                                            'name' => 'sim_type_id',
                                                            'id' => "sim_type_id_form",
                                                            'class' => 'form-control select_custom',
                                                            'attr' => 'required',
                                                            'selected' => $project->sim_type_id
                                                       ));?>
                                                  </div>
                                             </div>
                                             <div class="row">
                                                  <div class="form-group mb-3 col-6">
                                                       <label>Pays <span class="needed">*</span> </label>
                                                       <?php dropDown('SELECT sim_state_id, sim_state_name FROM sim_states ORDER BY sim_state_name',array(
                                                            'name' => 'sim_state_id',
                                                            'id' => "sim_state_id_form",
                                                            'class' => 'form-control select_custom',
                                                            'attr' => 'required',
                                                            'selected' => $project->sim_state_id
                                                       ));?>
                                                  </div>
                                                  <div class="form-group mb-3 col-6">
                                                       <label>Ville <span class="needed">*</span> </label>
                                                       <?php dropChained('SELECT sim_town_id, sim_town_name, sim_state_id FROM sim_towns',array(
                                                            'name' => 'sim_town_id',
                                                            'id' => "sim_town_id_form",
                                                            'class' => 'form-control select_custom',
                                                            'attr' => 'required',
                                                            'selected' => $project->sim_town_id
                                                       ));?>
                                                  </div>
                                             </div>
                                             <div class="form-group mb-3">
                                                  <label>Adresse <span class="needed">*</span> </label>
                                                  <input type="text" class="form-control" placeholder="Adresse du projet" name="project_address" value="<?= $project->project_address ?>" required>
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
                                                       <label>Durée d'investissement (mois) <span class="needed">*</span> </label>
                                                       <input type="number" class="form-control" placeholder="Nombre de mois" name="project_invest_term" value="<?= $project->project_invest_term ?>" min="0" step="1" required>
                                                  </div>
                                                  <div class="form-group mb-3 col-6">
                                                       <label>Début d'investissement <span class="needed">*</span> </label>
                                                       <input type="date" class="form-control" name="project_invest_debut" value="<?= $project->project_invest_debut ?>" required>
                                                  </div>
                                             </div>
                                             <div class="row">
                                                  <div class="form-group mb-3 col-6">
                                                       <label>Loyer prévisionnel (%)</label>
                                                       <input type="number" min="0" step="0.01" class="form-control" placeholder="Pourcentage" name="project_prev_rent" value="<?= $project->project_prev_rent ?>" >
                                                  </div>
                                                  <div class="form-group mb-3 col-6">
                                                       <label>Retour prévisionnel (%)</label>
                                                       <input type="number" min="0" step="0.01" class="form-control" placeholder="Pourcentage" name="project_prev_return" value="<?= $project->project_prev_return ?>" >
                                                  </div>
                                             </div>
                                             <div class="row">
                                                  <div class="form-group mb-3 col-6">
                                                       <label>Revenus Locatifs (Fcfa /m carré)</label>
                                                       <input type="number" class="form-control" placeholder="Valeur" name="project_local_income" value="<?= $project->project_local_income ?>">
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
                                   <h5 class="text-uppercase font-weight-bold"> DESCRIPTIONS </h5>
                              </div>
                              <div id="quillEditor" class="quill-container col-12" style="height:450px;"></div>
                              <textarea class="d-none" name="project_desc" id="project_desc">
                                   <?= $project->project_desc ?>
                              </textarea>
                         </div>
                    </div>

                    <div class="card mb-3">
                         <div class="card-body">
                              <div class="card-title mb-5">
                                   <h5 class="text-uppercase font-weight-bold"> LOCALISATION </h5>
                              </div>
                              <div class="col-12" id="map" style="height:400px!important;"></div>
                              <div class="row">
                                   <div class="form-group mb-3 col-4">
                                        <input type="hidden" name="project_lat" id="project_lat" value="<?= $project->project_lat ?>">
                                   </div>
                                   <div class="form-group mb-3 col-8">
                                        <input type="hidden" name="project_lon" id="project_lon" value="<?= $project->project_lon ?>">
                                   </div>
                              </div>
                         </div>
                    </div>

               </div>
               <div class="col-xl-5">
                    <div class="card mb-3">
                         <div class="card-body">
                              <div class="card-title mb-5">
                                   <h5 class="text-uppercase font-weight-bold"> ILLUSTRATION </h5>
                              </div>
                              <div class="row">
                                   <div class="col-12 text-center">
                                        <label class="label row" id="img-hover" data-toggle="tooltip" title="Change your avatar">
                                             <?php if ($project->project_picture == null): ?>
                                                  <img class="rounded ml-auto mr-auto" id="avatar"  src="<?= _url('assets/custom/img/default/default.png') ?>" alt="No image"  style="width: 300px;">
                                             <?php else: ?>
                                                  <img class="rounded ml-auto mr-auto" id="avatar"  src="<?= _url(@$project->project_picture); ?>" alt="No image" style="width: 300px;">
                                             <?php endif; ?>
                                             <input type="file" class="sr-only" id="input" name="picture" accept="image/*">
                                             <div id="picture_data"></div>
                                             <div id="img-hover-centered"><i data-feather="image"></i></div>
                                        </label>
                                   </div>
                              </div>
                              <div class="card-title mb-5 mt-5">
                                   <h5 class="text-uppercase font-weight-bold"> GALERIE </h5>
                              </div>
                              <div class="row">
                                   <div class="col-12">
                                        <div class="file-upload-wrapper">
                                             <div class="row">
                                                  <?php if (is_array($project->pictures)): ?>
                                                       <?php foreach ($project->pictures as $key => $picture): ?>
                                                            <div class="form-group col-sm-4">
                                                                 <!-- <div class="img-picker"> -->
                                                                 <div class="text-center">
                                                                      <img class="col-12" src="<?= _url($picture->project_picture_link); ?>">
                                                                      <a href="#custom-delete-picture-modal" class="btn btn-sm btn-outline-danger text-danger mt-2" data-toggle="modal" onclick="define_delete(<?= @$picture->project_picture_id ?>, 'project_picture_id')"><i class="fa fa-trash"></i></a>
                                                                 </div>
                                                                 <!-- </div> -->
                                                            </div>
                                                       <?php endforeach; ?>
                                                       <input type="hidden" name="cpt_pictures" value="<?= count($project->pictures) ?>">
                                                  <?php endif; ?>
                                                  <div class="form-group col-sm-4">
                                                       <div class="img-picker"></div>
                                                  </div>
                                                  <div id="img_picker_extension"></div>
                                                  <div class="form-group col-sm-4">
                                                       <button type="button" class="btn btn-secondary form-control" id="img_picker_add" style="height:100%;">
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
                                   <h5 class="col-7 text-uppercase font-weight-bold"> Caractéristiques </h5>
                                   <div class="col-5">
                                        <a href="#custom-charac-modal"  class="btn btn-success float-right" data-toggle="modal">Ajouter</a>
                                   </div>
                              </div>
                              <div class="row">
                                   <div class="col-12 mb-3">
                                        <div class="alert alert-warning inverse alert-dismissible fade show" role="alert">
                                             <p class="mt-2" style="font-size: 12px;">
                                                  Ajoutez quelques caractéristiques du projet sous forme de clé valeur. <br>
                                                  Exemple : "<strong>Nombre d'étages </strong> : <strong>7 étages</strong>"
                                             </p>
                                        </div>
                                        <div class="responsive-table">
                                             <table class="table table-striped table-bordered">
                                                  <thead>
                                                       <tr>
                                                            <th>Description</th>
                                                            <th>Valeur</th>
                                                            <th>Action</th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       <?php if (is_array($project->characteristics)): ?>
                                                            <?php foreach ($project->characteristics as $key => $charac): ?>
                                                                 <tr id="charac_<?= $charac->project_id ?>o<?= $charac->project_characteristic_id ?>">
                                                                      <td class="text-left">
                                                                           <?= $charac->project_characteristic_code ?>
                                                                           <input type="hidden" name="project_charac_names[]" value="<?= $charac->project_characteristic_code ?>">
                                                                      </td>
                                                                      <td class="text-center">
                                                                           <?= $charac->project_characteristic_value ?>
                                                                           <input type="hidden" name="project_charac_values[]" value="<?= $charac->project_characteristic_value ?>">
                                                                      </td>
                                                                      <td class="text-center">
                                                                           <button type="button" class="btn btn-sm btn-outline-danger text-danger" onclick="javascript:charac_destroy('<?= $charac->project_id ?>o<?= $charac->project_characteristic_id ?>')"><i class="fa fa-trash"></i></button>
                                                                      </td>
                                                                 </tr>
                                                            <?php endforeach; ?>
                                                            <tr id="characs_extension"></tr>
                                                       <?php else: ?>
                                                            <tr id="characs_extension">
                                                                 <td colspan="3" class="text-center">Ajoutez une caractéristique !</td>
                                                            </tr>
                                                       <?php endif; ?>
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
                                   <h5 class="col-7 text-uppercase font-weight-bold"> Structures voisines </h5>
                                   <div class="col-5">
                                        <a href="#custom-neighbor-modal"  class="btn btn-success float-right" data-toggle="modal">Ajouter</a>
                                   </div>
                              </div>
                              <div class="row">
                                   <div class="col-12 mb-3">
                                        <div class="alert alert-warning inverse alert-dismissible fade show" role="alert">
                                             <p class="mt-2" style="font-size: 12px;">
                                                  Ajoutez quelques structures aux environs du projet ainsi que leur distance approximative. <br>
                                                  Exemple : "<strong>Complexe Saint Michel </strong> : <strong>3 km</strong>"
                                             </p>
                                        </div>
                                        <div class="responsive-table">
                                             <table class="table table-striped table-bordered">
                                                  <thead>
                                                       <tr>
                                                            <th>Structure</th>
                                                            <th>Description</th>
                                                            <th>Action</th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       <?php if (is_array($project->neighborhoods)): ?>
                                                            <?php foreach ($project->neighborhoods as $key => $neighbor): ?>
                                                                 <tr id="neighbor_<?= $neighbor->project_id ?>o<?= $neighbor->project_neighborhood_id ?>">
                                                                      <td class="text-left">
                                                                           <?= $neighbor->project_neighborhood_structure ?>
                                                                           <input type="hidden" name="project_neighbor_structures[]" value="<?= $neighbor->project_neighborhood_structure ?>">
                                                                      </td>
                                                                      <td class="text-center">
                                                                           <?= $neighbor->project_neighborhood_distance ?>
                                                                           <input type="hidden" name="project_neighbor_distances[]" value="<?= $neighbor->project_neighborhood_distance ?>">
                                                                      </td>
                                                                      <td class="text-center">
                                                                           <button type="button" class="btn btn-sm btn-outline-danger text-danger" onclick="javascript:neighbor_destroy('<?= $neighbor->project_id ?>o<?= $neighbor->project_neighborhood_id ?>')"><i class="fa fa-trash"></i></button>
                                                                      </td>
                                                                 </tr>
                                                            <?php endforeach; ?>
                                                            <tr id="neighbors_extension"></tr>
                                                       <?php else: ?>
                                                            <tr id="neighbors_extension">
                                                                 <td colspan="3" class="text-center">Ajoutez une structure !</td>
                                                            </tr>
                                                       <?php endif; ?>
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
                                   <h5 class="text-uppercase font-weight-bold">Commodités</h5>
                              </div>
                              <div class="row">
                                   <div class="col-12 mb-3">
                                        <div class="alert alert-warning inverse alert-dismissible fade show" role="alert">
                                             <p class="mt-2" style="font-size: 12px;">
                                                  Ajoutez quelques commodités au projet. <br>
                                                  Si une commodités n'est pas disponible renseignez là <a href="<?= _url("content/convenience") ?>">ici</a>
                                             </p>
                                        </div>
                                        <?php dropDown('SELECT convenience_id, convenience_name FROM conveniences',array(
                                             'name'=>'convenience_ids[]',
                                             'id'=>"convenience_id_form",
                                             'class' => 'form-control select_custom',
                                             'attr' => 'multiple',
                                             'selected' => $project->conveniences_array
                                        )); ?>
                                   </div>
                              </div>
                         </div>
                    </div>

                    <div class="card mb-3">
                         <div class="card-body">
                              <div class="card-title row mb-3">
                                   <h5 class="col-7 text-uppercase font-weight-bold">Timeline</h5>
                                   <div class="col-5">
                                        <a href="#custom-timeline-modal"  class="btn btn-success float-right" data-toggle="modal">Ajouter</a>
                                   </div>
                              </div>
                              <div class="row">
                                   <div class="col-12 mb-3">
                                        <div class="alert alert-warning inverse alert-dismissible fade show" role="alert">
                                             <p class="mt-2" style="font-size: 12px;">
                                                  Représente le programme du projet dans une période bien définie dans les grandes ligne. <br>
                                                  Exemple : "<strong>Acquisition du terrain</strong> au <strong>08/2022</strong>"
                                             </p>
                                        </div>
                                        <div class="responsive-table">
                                             <table class="table table-striped table-bordered">
                                                  <thead>
                                                       <tr>
                                                            <th>Description</th>
                                                            <th>Période</th>
                                                            <th>Action</th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       <?php if (is_array($project->timelines)): ?>
                                                            <?php foreach ($project->timelines as $key => $timeline): ?>
                                                                 <tr id="timeline_<?= $timeline->project_id ?>o<?= $timeline->project_timeline_id ?>">
                                                                      <td class="text-left">
                                                                           <?= $timeline->project_timeline_name ?>
                                                                           <input type="hidden" name="project_timeline_names[]" value="<?= $timeline->project_timeline_name ?>">
                                                                      </td>
                                                                      <td class="text-center">
                                                                           <?= get_month_fr($timeline->project_timeline_month) ?>
                                                                           <?= $timeline->project_timeline_year ?>
                                                                           <input type="hidden" name="project_timeline_months[]" value="<?= $timeline->project_timeline_month ?>">
                                                                           <input type="hidden" name="project_timeline_years[]" value="<?= $timeline->project_timeline_year ?>">
                                                                      </td>
                                                                      <td class="text-center">
                                                                           <button type="button" class="btn btn-sm btn-outline-danger text-danger" onclick="javascript:timeline_destroy('<?= $timeline->project_id ?>o<?= $timeline->project_timeline_id ?>')"><i class="fa fa-trash"></i></button>
                                                                      </td>
                                                                 </tr>
                                                            <?php endforeach; ?>
                                                            <tr id="timeline_extension"></tr>
                                                       <?php else: ?>
                                                            <tr id="timeline_extension">
                                                                 <td colspan="3" class="text-center">Ajoutez une timeline !</td>
                                                            </tr>
                                                       <?php endif; ?>
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
                                   <h5 class="col-7 text-uppercase font-weight-bold">Décaissement</h5>
                                   <div class="col-5">
                                        <a href="#custom-schedule-modal"  class="btn btn-success float-right" data-toggle="modal">Ajouter</a>
                                   </div>
                              </div>
                              <div class="row">
                                   <div class="col-12 mb-3">
                                        <div class="alert alert-warning inverse alert-dismissible fade show" role="alert">
                                             <p class="mt-2" style="font-size: 12px;">
                                                  Représente le programme de décaissement de l'investissement sur le projet dans les grandes ligne en pourcentage. <br>
                                                  Exemple : "<strong>Démarrage des travaux</strong>  <strong>25%</strong>"
                                             </p>
                                        </div>
                                        <div class="responsive-table">
                                             <table class="table table-striped table-bordered">
                                                  <thead>
                                                       <tr>
                                                            <th>Description</th>
                                                            <th>Valeur</th>
                                                            <th>Action</th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       <?php $max = 0; ?>
                                                       <?php if (is_array($project->schedules)): ?>
                                                            <?php foreach ($project->schedules as $key => $schedule): ?>
                                                                 <?php $max += (float)$schedule->project_schedule_value ?>
                                                                 <tr id="schedule_<?= $schedule->project_id ?>o<?= $schedule->project_schedule_id ?>">
                                                                      <td class="text-left">
                                                                           <?= $schedule->project_schedule_name ?>
                                                                           <input type="hidden" name="project_schedule_names[]" value="<?= $schedule->project_schedule_name ?>">
                                                                      </td>
                                                                      <td class="text-center">
                                                                           <?= $schedule->project_schedule_value ?>
                                                                           <input type="hidden" name="project_schedule_values[]" id="project_schedule_value_<?= $schedule->project_id ?>o<?= $schedule->project_schedule_id ?>" value="<?= $schedule->project_schedule_value ?>">
                                                                      </td>
                                                                      <td class="text-center">
                                                                           <button type="button" class="btn btn-sm btn-outline-danger text-danger" onclick="javascript:schedule_destroy('<?= $schedule->project_id ?>o<?= $schedule->project_schedule_id ?>')"><i class="fa fa-trash"></i></button>
                                                                      </td>
                                                                 </tr>
                                                            <?php endforeach; ?>
                                                            <tr id="schedules_extension"></tr>
                                                       <?php else: ?>
                                                            <tr id="schedules_extension">
                                                                 <td colspan="3" class="text-center">Ajoutez une valeur !</td>
                                                            </tr>
                                                       <?php endif; ?>
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
               <input type="hidden" name="project_id" value="<?= $project->project_id ?>">
               <button type="submit" class="btn btn-warning text-white form-control" title="submit"> <h1><span class="fa fa-pencil"></span></h1> </button>
          </div>
     </div>

     <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
               <div class="modal-content">
                    <div class="modal-header">
                         <h5 class="modal-title" id="modalLabel">Recadrer</h5>
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
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                         <button type="button" class="btn btn-primary" id="crop">Recadrer</button>
                    </div>
               </div>
          </div>
     </div>
</form>

<div id="custom-timeline-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel1" aria-modal="true">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel1">Ajouter Timeline</h4>
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
                                   <button class="btn btn-info col-md-4" id="timeline_add">Ajouter</button>
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
                    <h4 class="modal-title" id="myCenterModalLabel1">Ajouter décaissement</h4>
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
                                   <input type="number" class="form-control" placeholder="Pourcentage" id="schedule_value" max="<?= $max - 100 ?>" required <?php if ($max - 100 == 0): ?>disabled<?php endif; ?>>
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
                    <h4 class="modal-title" id="myCenterModalLabel1">Ajouter Caractéristiques</h4>
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
                    <h4 class="modal-title" id="myCenterModalLabel1">Ajouter Structure</h4>
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
                                   <button class="btn btn-info col-md-4" id="neighbor_add">Ajouter</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>



<!-- Delete manager ///////////////////////////////////////////////////////////////////////////////////////////////// -->

<div id="custom-delete-picture-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Delete</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               </div>
               <div class="modal-body">
                    <form class="row justify-content-center" action="<?php _url($module_base.'delete_picture'); ?>" method="post" enctype="multipart/form-data">
                         <div class="col-12 mt-2">
                              <p style="text-align: center; font-size: 14px;">
                                   L'élément selectionner sera supprimer définitivement. <br>
                                   Souhaitez-vous continuer ?
                              </p>
                              <div class="modal-footer mt-3">
                                   <input type="hidden" type="text" name="project_id" value="<?= $project->project_id ?>">
                                   <input type="hidden" type="text" name="project_picture_id">
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                                   <button type="submit" class="btn btn-danger col-md-4">Delete</button>
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
               canvas = cropper.getCroppedCanvas();
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
