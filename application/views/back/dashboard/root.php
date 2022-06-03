

<div class="row">
     <div class="col-lg-8">
          <div class="d-lg-flex align-items-baseline">
               <h5 class="text-dark mb-0">
                    <?= $this->lang->line('label-welcome-dash') ?>
               </h5>
               <!-- <p class="ml-md-3 font-weight-light mb-0 mt-1">Last login was 23 hours ago. View details</p> -->
          </div>
     </div>
     <div class="col-lg-4 text-lg-right">
          <div class="d-lg-flex d-none justify-content-end  pageheader-icons">
               <a href="#" class="btn d-flex align-items-center"><i class="mdi mdi-heart-outline"></i></a>
               <a href="#" class="btn d-flex align-items-center"><i class="mdi mdi-calendar-blank"></i></a>
               <a href="#" class="btn d-flex align-items-center"><i class="mdi mdi-bookmark-outline"></i></a>
               <a href="#" class="btn d-flex align-items-center"><i class="mdi mdi-settings"></i></a>
          </div>
     </div>
</div>

<div class="row mt-4">
     <div class="col-12 col-sm-6 col-md-6 col-xl-3 grid-margin stretch-card">
          <div class="card bg-info hoverable card-xl-stretch mb-xl-8">
               <div class="card-body">
                    <i class="mdi mdi-account-multiple text-white" style="font-size: 50px;"></i>
                    <h3 class="text-white fw-bolder fs-2 mb-2 mt-3 font-weight-bold"><?= get_investor_nb('potentiel') ?></h3>
                    <div class="fw-bold text-white text-uppercase"><?= $this->lang->line('label-potential-dash') ?></div>
               </div>
          </div>
     </div>
     <div class="col-12 col-sm-6 col-md-6 col-xl-3 grid-margin stretch-card">
          <div class="card bg-success hoverable card-xl-stretch mb-xl-8">
               <div class="card-body">
                    <i class="mdi mdi-briefcase-check text-white" style="font-size: 50px;"></i>
                    <h3 class="text-white fw-bolder fs-2 mb-2 mt-3 font-weight-bold"><?= get_investor_nb('investisseur') ?></h3>
                    <div class="fw-bold text-white text-uppercase"><?= $this->lang->line('label-investor-dash') ?></div>
               </div>
          </div>
     </div>
     <div class="col-12 col-sm-6 col-md-6 col-xl-3 grid-margin stretch-card">
          <div class="card bg-warning hoverable card-xl-stretch mb-xl-8">
               <div class="card-body">
                    <i class="mdi mdi-link-variant text-white" style="font-size: 50px;"></i>
                    <h3 class="text-white fw-bolder fs-2 mb-2 mt-3 font-weight-bold"><?= get_investor_nb('partenaire') ?></h3>
                    <div class="fw-bold text-white text-uppercase"><?= $this->lang->line('label-partner-dash') ?></div>
               </div>
          </div>
     </div>
     <div class="col-12 col-sm-6 col-md-6 col-xl-3 grid-margin stretch-card">
          <div class="card bg-dark hoverable card-xl-stretch mb-xl-8">
               <div class="card-body">
                    <i class="mdi mdi-counter text-white" style="font-size: 50px;"></i>
                    <h3 class="text-white fw-bolder fs-2 mb-2 mt-3 font-weight-bold"><?= get_investor_nb() ?></h3>
                    <div class="fw-bold text-white text-uppercase"><?= $this->lang->line('label-investors-dash') ?></div>
               </div>
          </div>
     </div>
</div>

<div class="row">
     <div class="col-xl-6 w-100 grid-margin stretch-card">
          <div class="card">
               <div class="card-body">
                    <h4 class="card-title text-uppercase font-weight-bold mb-5"><?= $this->lang->line('label-invest-chart-dash') ?></h4>
                    <div id="morris-line-investements"></div>
               </div>
          </div>
     </div>

     <div class="col-xl-6 grid-margin stretch-card">
          <div class="card">
               <div class="card-body">
                    <h4 class="card-title text-uppercase font-weight-bold mb-5"><?= $this->lang->line('label-invest-list-dash') ?></h4>
                    <div class="table-responsive">
                         <table class="table">
                              <thead>
                                   <tr>
                                        <th class="pt-1 pl-0 font-weight-bold">
                                             <?= $this->lang->line('header-dashboard-investor') ?>
                                        </th>
                                        <th class="pt-1 font-weight-bold">
                                             <?= $this->lang->line('header-dashboard-date') ?>
                                        </th>
                                        <th class="pt-1 font-weight-bold">
                                             <?= $this->lang->line('header-dashboard-investment') ?>
                                        </th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <?php if (is_array(get_last_investments())): ?>
                                        <?php foreach (get_last_investments() as $key => $investment): ?>
                                             <tr>
                                                  <td class="py-1 pl-0">
                                                       <div class="d-flex align-items-center">
                                                            <div class="ml-0">
                                                                 <p class="mb-0"  style="font-size: 12px;"><?= $investment->user_nicename ?></p>
                                                                 <p class="mb-0 text-muted text-small" style="font-size: 12px;"><?= $investment->role_name ?></p>
                                                            </div>
                                                       </div>
                                                  </td>
                                                  <td>
                                                       <div class="d-flex align-items-center">
                                                            <div class="ml-0">
                                                                 <p class="mb-0"  style="font-size: 12px;"><?= gmdate('d-m-Y', $investment->project_invest_modified) ?></p>
                                                                 <p class="mb-0 text-muted" style="font-size: 12px;"><?= gmdate('H:i', $investment->project_invest_modified) ?></p>
                                                            </div>
                                                       </div>
                                                  </td>
                                                  <td>
                                                       <div class="d-flex align-items-center">
                                                            <div class="ml-0">
                                                                 <p class="mb-0"  style="font-size: 12px;"><?= thousand($investment->project_invest_value) ?> F</p>
                                                                 <p class="mb-0 text-warning text-small" style="font-size: 12px;"><?= $investment->project_name ?></p>
                                                            </div>
                                                       </div>

                                                  </td>
                                             </tr>
                                        <?php endforeach; ?>
                                   <?php endif; ?>
                              </tbody>
                         </table>
                    </div>
               </div>
          </div>
     </div>
</div>

<div class="row">
     <div class="col-md-4 grid-margin">
          <div class="card d-flex align-items-center">
               <div class="card-body">
                    <div class="d-flex flex-row align-items-center">
                         <i class="mdi mdi-file-document text-info icon-lg"></i>
                         <div class="ml-3">
                              <h4 class="text-info font-weight-bold"><?= @get_studies_nb() ?></h4>
                              <p class="mt-2 text-muted card-text font-weight-bold"><?= $this->lang->line('label-studies-dash') ?></p>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <div class="col-md-4 grid-margin">
          <div class="card d-flex align-items-center">
               <div class="card-body">
                    <div class="d-flex flex-row align-items-center">
                         <i class="mdi mdi-call-merge text-warning icon-lg"></i>
                         <div class="ml-3">
                              <h4 class="text-warning font-weight-bold"><?= @get_states_nb() ?></h4>
                              <p class="mt-2 text-muted card-text font-weight-bold"><?= $this->lang->line('label-states-dash') ?></p>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <div class="col-md-4 grid-margin">
          <div class="card d-flex align-items-center">
               <div class="card-body">
                    <div class="d-flex flex-row align-items-center">
                         <i class="mdi mdi-call-split text-twitter icon-lg"></i>
                         <div class="ml-3">
                              <h4 class="text-twitter font-weight-bold"><?= @get_towns_nb() ?></h4>
                              <p class="mt-2 text-muted card-text font-weight-bold"><?= $this->lang->line('label-town-dash') ?></p>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>

<div class="row">
     <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
               <div class="card-body">
                    <h4 class="card-title text-uppercase font-weight-bold mb-5"><?= $this->lang->line('label-project-active-dash') ?></h4>
                    <div class="table-responsive">
                         <table class="table table-striped">
                              <thead>
                                   <tr>
                                        <th class="font-weight-bold">
                                             <?= $this->lang->line('header-dashboard-project') ?>
                                        </th>
                                        <th class="font-weight-bold">
                                             <?= $this->lang->line('header-dashboard-progress') ?>
                                        </th>
                                        <th class="font-weight-bold">
                                             <?= $this->lang->line('header-dashboard-investment') ?>
                                        </th>
                                        <th class="font-weight-bold">
                                             <?= $this->lang->line('header-dashboard-total') ?>
                                        </th>
                                        <th class="font-weight-bold">
                                             <?= $this->lang->line('header-dashboard-deadline') ?>
                                        </th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <?php if (count(@get_active_projects()) > 0): ?>
                                        <?php foreach (get_active_projects() as $key => $project): ?>
                                             <tr>
                                                  <td class="py-1">
                                                       <?= $project->project_name ?> - <?= $project->project_address  ?>
                                                  </td>
                                                  <td>
                                                       <div class="progress">
                                                            <div class="progress-bar bg-warning" role="progressbar" style="width: <?= $project->tx ?>%" aria-valuenow="<?= $project->tx ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                       </div>
                                                  </td>
                                                  <td>
                                                       <?= thousand($project->total_invest) ?> F
                                                  </td>
                                                  <td>
                                                       <?= thousand($project->project_value) ?> F
                                                  </td>
                                                  <td>

                                                       <?= gmdate('d-m-Y', strtotime('+'. $project->project_invest_term .' months', strtotime($project->project_invest_debut))) ?>
                                                  </td>
                                             </tr>
                                        <?php endforeach; ?>
                                   <?php endif; ?>
                              </tbody>
                         </table>
                    </div>
               </div>
          </div>
     </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
     if ($('#morris-line-investements').length) {
          month_graph();
     }
});

function month_graph(){
     $.get(BASE_URL + "api/script/get_month_data").done(function (json) {
          var obj = JSON.parse(json) || {};
          var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
          console.log(obj.data);
          Morris.Line({
               element: "morris-line-investements",
               data: obj.data,
               xkey: "y",
               ykeys: ["a"],
               labels: ["Encaissement"],
               fillOpacity: ["0.1"],
               pointFillColors: ["#ffffff"],
               pointStrokeColors: ["#999999"],
               behaveLikeLine: !0,
               gridLineColor: "#2717c9",
               hideHover: "auto",
               lineWidth: "3px",
               pointSize: 0,
               postUnits: " F",
               resize: !0,
               lineColors: ["#2717c9"],
               xLabelFormat: function(x) {
                    var cpt = x.getMonth();
                    var month = months[cpt];
                    return month;
               },
               dateFormat: function(x) {
                    var cpt = new Date(x).getMonth();
                    var month = months[cpt];
                    return month;
               },
          });
     }).fail(function (jqxhr, textStatus, error) {
          return [];
     });
}
</script>
