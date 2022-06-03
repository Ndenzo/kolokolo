<div class="row">
     <div class="col-lg-7">
          <div class="d-lg-flex align-items-baseline">
               <h5 class="text-dark mt-3">
                    Détail du projet
               </h5>
          </div>
     </div>
     <div class="col-lg-5 text-lg-right">
          <div class="btn-group" role="group" aria-label="Basic example">
               <a href="#custom-modal" class="btn btn-info btn-icon-text btn-icon-prepend" data-toggle="modal">
                    Simulateur
               </a>
          </div>
     </div>
</div>

<div class="row mt-4">
     <div class="col-12">
          <div class="card">
               <div class="card-body" style="height: auto;">
                    <div class="row">
                         <div class="col-lg-5 mb-2">
                              <div class="card-body col-12">
                                   <div class="col-12 ml-auto mr-auto">
                                        <?php if ($project->project_picture == null): ?>
                                             <img class="img-fluid sm-100-w" src="https://via.placeholder.com/43x43" alt="" style="border-radius:10px; width: 100%!important;">
                                        <?php else: ?>
                                             <img class="img-fluid sm-100-w" src="<?= _url(@$project->project_picture); ?>" alt="" style="border-radius:10px; width: 100%!important;">
                                        <?php endif; ?>
                                   </div>
                                   <h4 class="card-title text-center mt-4"><?= $project->project_name ?> - <?= $project->project_address ?></h4>

                                   <div class="border-top">
                                        <div class="d-flex justify-content-between mt-4">
                                             <p class="text-warning">actuel : <strong><?= thousand(get_project_investments($project->project_id)) ?></strong> F CFA</p>
                                             <p class="text-info">max: <strong><?= thousand($project->project_value) ?></strong>  F CFA</p>
                                        </div>
                                        <div class="progress progress-lg">
                                             <div class="progress-bar bg-warning" role="progressbar" style="width: <?= get_project_tx($project->project_id) ?>%" aria-valuenow="<?= get_project_tx($project->project_id) ?>" aria-valuemin="0" aria-valuemax="100"><?= get_project_tx($project->project_id) ?>%</div>
                                        </div>
                                   </div>

                                   <div class="border-top border-bottom mt-5 mb-5">
                                        <div class="py-4">
                                             <p class="clearfix">
                                                  <span class="float-left">
                                                       Durée de l'investissement
                                                  </span>
                                                  <span class="float-right text-muted">
                                                       <strong><?= @$project->project_invest_term ?> mois</strong>
                                                  </span>
                                             </p>
                                             <p class="clearfix">
                                                  <span class="float-left">
                                                       Durée restante
                                                  </span>
                                                  <span class="float-right text-muted">
                                                       <strong><?= @$project->project_invest_term ?> mois</strong>
                                                  </span>
                                             </p>
                                             <p class="clearfix">
                                                  <span class="float-left">
                                                       Loyer Prévisionnel
                                                  </span>
                                                  <span class="float-right text-muted">
                                                       <strong><?= @$project->project_prev_rent ?>%</strong>
                                                  </span>
                                             </p>
                                             <p class="clearfix">
                                                  <span class="float-left">
                                                       Retour Prévisionnel
                                                  </span>
                                                  <span class="float-right text-muted">
                                                       <strong><?= @$project->project_prev_return ?>%</strong>
                                                  </span>
                                             </p>
                                        </div>
                                   </div>

                                   <div class="col-12" id="map2" style="height:400px!important;"></div>

                                   <div class="form-group mb-3 col-4">
                                        <input type="hidden" name="project_lat" id="project_lat" value="<?= $project->project_lat ?>">
                                   </div>
                                   <div class="form-group mb-3 col-8">
                                        <input type="hidden" name="project_lon" id="project_lon" value="<?= $project->project_lon ?>">
                                   </div>

                              </div>
                         </div>
                         <div class="col-lg-7" id="project_content">
                              <ul class="nav nav-pills nav-pills-primary mt-2" id="pills-tab" role="tablist">
                                   <li class="nav-item">
                                        <a class="nav-link active" id="pills-desc-tab" data-toggle="pill" href="#pills-desc" role="tab" aria-controls="pills-desc" aria-selected="true"><i class="mdi mdi-file-document-box"></i> Description</a>
                                   </li>
                                   <li class="nav-item">
                                        <a class="nav-link" id="pills-galerie-tab" data-toggle="pill" href="#pills-galerie" role="tab" aria-controls="pills-galerie" aria-selected="false"><i class="mdi mdi-image-multiple"></i> Galerie</a>
                                   </li>
                                   <!-- <li class="nav-item">
                                        <a class="nav-link" id="pills-position-tab" data-toggle="pill" href="#pills-position" role="tab" aria-controls="pills-position" aria-selected="false"><i class="mdi mdi-map-marker"></i> Position</a>
                                   </li> -->
                              </ul>
                              <div class="tab-content" id="pills-tabContent" style="max-height: 1150px; overflow-y: auto;">
                                   <div class="tab-pane fade show active" id="pills-desc" role="tabpanel" aria-labelledby="pills-desc-tab">
                                        <div class="media">
                                             <div class="row" style="overflow: hidden; padding-right: 30px;">
                                                  <?= quill_format($project->project_desc) ?>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="tab-pane fade" id="pills-galerie" role="tabpanel" aria-labelledby="pills-galerie-tab">
                                        <div class="media">
                                             <div id="lightgallery" class="row lightGallery">
                                                  <?php if(is_array(@$project->pictures)):?>
                                                       <?php foreach(@$project->pictures as $key => $picture):?>
                                                            <a href="<?= _url(@$picture->project_picture_link); ?>" class="image-tile"><img src="<?= _url(@$picture->project_picture_link); ?>" alt="Galerie - <?= $project->project_name ?>" style="max-height:200px;"></a>
                                                       <?php endforeach;?>
                                                  <?php endif;?>
                                             </div>
                                        </div>
                                   </div>
                                   <!-- <div class="tab-pane fade" id="pills-position" role="tabpanel" aria-labelledby="pills-position-tab">
                                        <div class="row">
                                        </div>
                                   </div> -->
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>

<div id="custom-modal" class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel1" aria-modal="true">
     <div class="modal-dialog" style="max-width: 60%;">
          <div class="modal-content">
               <form class="forms-sample">

                    <div class="modal-header">
                         <h4 class="modal-title" id="myCenterModalLabel1">Simulateur</h4>
                         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>

                    <div class="modal-body">
                         <div class="row border-bottom pb-4">
                              <div class="form-group col-12 mb-2">
                                   <label>Apport</label>
                                   <input type="number" min="1" class="form-control" id="invest_value" placeholder="Valeur">
                              </div>
                              <div class="form-group col-6 mb-2">
                                   <label>Période de placement</label>
                                   <select class="select_custom form-control" id="per_place" required>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3" selected>3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                   </select>
                              </div>
                              <div class="form-group col-6 mb-2">
                                   <label>Effet de levier</label>
                                   <select class="select_custom form-control" id="eff_lev" required>
                                        <option value="2">2</option>
                                        <option value="1.5" selected>1.5</option>
                                        <option value="1">1</option>
                                        <option value="0.5">0.5</option>
                                   </select>
                              </div>
                              <div class="form-group col-6 mb-2">
                                   <label>Taux d'emprunt</label>
                                   <input type="text" class="form-control" id="tx_emp" value="<?= @$project->param->tx_emp ?>" disabled>
                              </div>
                              <div class="form-group col-6 mb-2">
                                   <label>Yield</label>
                                   <input type="text" class="form-control" id="yield" value="<?= @$project->param->yield ?>" disabled>
                              </div>

                              <?php if(@sim_meta('tax_loc') != null): ?>
                                   <input type="hidden" class="form-control sim" id="tax_loc" value="<?= sim_meta('tax_loc') ?>" disabled>
                              <?php else: ?>
                                   <input type="hidden" class="form-control sim" id="tax_loc">
                              <?php endif; ?>
                              <?php if(@sim_meta('abat_for') != null): ?>
                                   <input type="hidden" class="form-control sim" id="abat_for" value="<?= sim_meta('abat_for') ?>" disabled>
                              <?php else: ?>
                                   <input type="hidden" class="form-control sim" id="abat_for">
                              <?php endif; ?>
                              <?php if(@sim_meta('rent_esc') != null): ?>
                                   <input type="hidden" class="form-control sim" id="rent_esc" value="<?= sim_meta('rent_esc') ?>" disabled>
                              <?php else: ?>
                                   <input type="hidden" class="form-control sim" id="rent_esc">
                              <?php endif; ?>
                         </div>
                         <div class="card mt-4">
                              <div class="card-body bg-inverse-secondary">
                                   <div class="row">
                                        <div class="col-6">
                                             <div class="form-group col-12 mb-2">
                                                  <label>Montant de la dette</label>
                                                  <br>
                                                  <strong id="mnt_dette_view"></strong>
                                                  <input type="hidden" id="mnt_dette">
                                             </div>
                                             <hr>
                                             <div class="form-group col-12 mb-2">
                                                  <label>Montant de l'intérêt</label>
                                                  <br>
                                                  <strong id="mnt_inter_view"></strong>
                                                  <input type="hidden" id="mnt_inter">
                                             </div>
                                             <div class="form-group col-12 mb-2">
                                                  <label>Revenue Net d'exploitation (NOI)</label>
                                                  <br>
                                                  <strong id="rev_net_exp_view"></strong>
                                                  <input type="hidden" id="rev_net_exp">
                                             </div>
                                             <div class="form-group col-12 mb-2">
                                                  <label>Montant Total d'Investissement</label>
                                                  <br>
                                                  <strong id="mnt_total_invest_view"></strong>
                                                  <input type="hidden" id="mnt_total_invest">
                                             </div>
                                        </div>

                                        <div class="col-6">
                                             <div class="form-group col-12 mb-2">
                                                  <label>ROE</label>
                                                  <br>
                                                  <strong id="roe_view"></strong>
                                                  <input type="hidden" id="roe">
                                             </div>
                                             <hr>
                                             <div class="form-group col-12 mb-2">
                                                  <label>Cash on cash return</label>
                                                  <br>
                                                  <strong id="cash_on_cash_view"></strong>
                                                  <input type="hidden" id="cash_on_cash">
                                             </div>
                                             <div class="form-group col-12 mb-2">
                                                  <label>DRCI</label>
                                                  <br>
                                                  <strong id="drci_view"></strong>
                                                  <input type="hidden" id="drci">
                                             </div>
                                             <div class="form-group col-12 mb-2">
                                                  <label>Debt service coverage</label>
                                                  <br>
                                                  <strong id="ebitda_view"></strong>
                                                  <input type="hidden" id="ebitda">
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>


                    </div>

               </form>

               <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->lang->line('btn-cls') ?></button>
                    <button  id="sim_activate"  class="btn btn-success col-md-6">Simuler</button>
               </div>

          </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
</div>

<!-- <script type="text/javascript">
$('#pills-position').tab('show', function () {
     if ($("#map2").length) {

          var map = L.map('map2').setView([$("#project_lat").val(), $("#project_lon").val()], 15);
          L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibmRlbnpvIiwiYSI6ImNrd296eDJ3ZTA0bHgybnJ0NTZiemk2d3cifQ.SK-sztYzW4mULi-rs6Yz_g', {
               attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
               maxZoom: 18,
               id: 'mapbox/streets-v11',
               tileSize: 512,
               zoomOffset: -1,
               accessToken: 'pk.eyJ1IjoibmRlbnpvIiwiYSI6ImNrd296eDJ3ZTA0bHgybnJ0NTZiemk2d3cifQ.SK-sztYzW4mULi-rs6Yz_g'
          }).addTo(map);

          var marker = new L.marker([$("#project_lat").val(), $("#project_lon").val()],{
               draggable: false
          }).addTo(map);

     }
});
</script> -->
