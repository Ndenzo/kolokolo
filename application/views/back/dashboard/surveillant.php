<div class="container-fluid">
     <div class="row">
          <div class="col-xl-4">

               <div class="card total-users">
                    <div class="card-header card-no-border">
                         <h5 class="lan-text-sch">Scolarité</h5>
                    </div>
                    <div class="card-body pt-0">
                         <div class="apex-chart-container goal-status text-center row">
                              <div class="rate-card col-xl-12">
                                   <div class="goal-chart">
                                        <div id="riskfactorchart"></div>
                                   </div>
                                   <div class="goal-end-point">
                                        <ul>
                                             <li class="mt-0 pt-0">
                                                  <h6 class="font-primary">Taux</h6>
                                                  <!-- <h6 class="f-w-400"></h6> -->
                                             </li>
                                             <li>
                                                  <h6 class="mb-2 f-w-400 lan-text-stu-re-">Elèves Réinscrient</h6>
                                                  <h5 class="mb-0"><?= @thousand(get_eleves_sum_old($_SESSION['dashboard']['settings_scolarite_id'], $_SESSION['dashboard']['settings_scolarite_id']-1)) ?></h5>
                                             </li>
                                        </ul>
                                   </div>
                              </div>
                              <ul class="col-xl-12">
                                   <li class="b-t-light">
                                        <div class="goal-detail">
                                             <h6> <span class="font-primary">Prescolaire : </span><?= @thousand(get_eleves_by_cycle_sum('presco', $_SESSION['dashboard']['settings_scolarite_id'])->eleve_total) ?></h6>
                                             <div class="progress sm-progress-bar progress-animate">
                                                  <!-- <div class="progress-gradient-primary" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div> -->
                                             </div>
                                        </div>
                                        <div class="goal-detail">
                                             <h6><span class="font-primary">Elémentaire : </span><?= @thousand(get_eleves_by_cycle_sum('eleme', $_SESSION['dashboard']['settings_scolarite_id'])->eleve_total) ?></h6>
                                             <div class="progress sm-progress-bar progress-animate">
                                                  <!-- <div class="progress-gradient-primary" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div> -->
                                             </div>
                                        </div>
                                        <div class="goal-detail mb-0">
                                             <h6><span class="font-primary">Moyen général : </span><?= @thousand(get_eleves_by_cycle_sum('moyen', $_SESSION['dashboard']['settings_scolarite_id'])->eleve_total) ?></h6>
                                             <div class="progress sm-progress-bar progress-animate">
                                                  <!-- <div class="progress-gradient-primary" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div> -->
                                             </div>
                                        </div>
                                   </li>
                              </ul>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
<script type="text/javascript">
var taux_renouvellement = <?=  @thousand(get_eleves_sum_old($_SESSION['dashboard']['settings_scolarite_id'], $_SESSION['dashboard']['settings_scolarite_id']-1)/get_eleves_sum($_SESSION['dashboard']['settings_scolarite_id'])->eleve_total*100 ) ?>;
</script>
