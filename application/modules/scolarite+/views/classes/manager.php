<?php show_notification();?>

<div class="row">
     <?php if(is_array(@$cycles)):?>
          <?php foreach(@$cycles as $cycle):?>
               <div class="col-xl-4">
                    <div class="card taskboard-box">
                         <div class="dropdown float-right">
                              <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                   <i class="mdi mdi-dots-vertical"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right">
                                   <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                   <a href="javascript:void(0);" class="dropdown-item">Another action</a>
                                   <a href="javascript:void(0);" class="dropdown-item">Something else</a>
                                   <a href="javascript:void(0);" class="dropdown-item">Separated link</a>
                              </div>
                         </div>

                         <h4 class="card-header mt-0 mb-3 text-warning"><?= $cycle->settings_cycle_name ?></h4>

                         <div class="row">
                              <div class="col-12">
                                   <div id="accordion">
                                        <?php foreach(@$cycle->niveaux as $niveau):?>

                                             <div class="card mb-0">
                                                  <a href="#collapseOne<?= $niveau->settings_niveau_id ?>" class="text-dark mb-3 btn-primary" data-toggle="collapse" aria-expanded="true" aria-controls="collapseOne">
                                                       <div class="card-title mb-5" id="headingOne">
                                                            <table class="m-0 col-12">
                                                                 <tr>
                                                                      <td valign="middle"><h5 class="m-0"><?= $niveau->settings_niveau_name ?></h5></td>
                                                                      <td valign="middle" style="width: 50px;"><a href="#custom-modal-<?= $niveau->settings_niveau_id ?>" class="btn btn-success btn-md waves-effect waves-light m-0" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a">+</a></td>
                                                                 </tr>
                                                            </table>
                                                       </div>
                                                  </a>


                                                  <div id="collapseOne<?= $niveau->settings_niveau_id ?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                                       <div class="card-body">
                                                            <?php if($niveau->nb_eleves != 0):?>
                                                                 <a href="<?= _url($module_base."classe_spliter/".$niveau->settings_niveau_id) ?>" class="btn btn-icon waves-effect waves-light btn-lighten-info form-control">
                                                                      Elèves non affectés &nbsp;
                                                                      <span class="badge badge-warning float-right" style="margin-top: 3px;"><?= $niveau->nb_eleves ?></span>
                                                                 </a>
                                                            <?php endif;?>

                                                            <?php foreach(@$niveau->classes as $classe):?>
                                                                 <div class="col-12">
                                                                      <div class="card">
                                                                           <div class="widget-chart-1">
                                                                                <div class="widget-chart-box-1 float-left" dir="ltr">
                                                                                     <input data-plugin="knob" data-width="80" data-height="80" data-fgColor="#35b8e0" data-bgColor="#B8E6F4" value="<?= $classe->nb_eleves ?>" data-skin="tron" data-angleOffset="0" data-readOnly=true data-thickness=".30"/>
                                                                                </div>

                                                                                <div class="widget-detail-1 text-right">
                                                                                     <h2 class="font-weight-normal pt-2 mb-1"> <?= $classe->classe_name ?> </h2>
                                                                                     <ul class="social-list list-inline mt-1 mb-0">
                                                                                          <li class="list-inline-item">
                                                                                               <a href="<?= _url($module_base."showProgramme/".$classe->classe_id) ?>" class="social-list-item border-purple text-purple">
                                                                                                    <i class="fa fa-calendar-alt"></i>
                                                                                               </a>
                                                                                          </li>
                                                                                          <li class="list-inline-item">
                                                                                               <a href="<?= _url($module_base."showComposition/".$classe->classe_id) ?>" class="social-list-item border-secondary text-secondary">
                                                                                                    <i class="fa fa-users"></i>
                                                                                               </a>
                                                                                          </li>
                                                                                          <li class="list-inline-item">
                                                                                               <a href="#custom-download-modal-<?= $classe->classe_id ?>" data-toggle="modal" class="btn btn-pill btn-outline-warning option-sm-btn">
                                                                                                    <i class="fa fa-download"></i>
                                                                                               </a>
                                                                                          </li>
                                                                                     </ul>
                                                                                </div>
                                                                           </div>
                                                                      </div>
                                                                 </div>

                                                                 <div id="custom-download-modal-<?= $classe->classe_id ?>" class="modal fade bs-example-modal-lg show" tabindex="-1" facture_flag="dialog" aria-labelledby="myCenterModalLabel" aria-modal="true">
                                                                      <div class="modal-dialog modal-dialog-centered modal-lg">
                                                                           <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                     <h4 class="modal-title" id="myCenterModalLabel">Téléchargement - <?= $classe->classe_name ?></h4>
                                                                                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                     <form class="row justify-content-center" action="<?php _url('settings/facture_flag/delete'); ?>" method="post" enctype="multipart/form-data">
                                                                                          <div class="col-10 mt-50">
                                                                                               <div class="row">
                                                                                                    <div class="col-6" >
                                                                                                         <div class="card">
                                                                                                              <div class="row">
                                                                                                                   <img src="<?php _url(); ?>assets/custom/png/031-calendar.png" class="rounded avatar-xl img-thumbnail mb-2 ml-auto mr-auto"  style="box-shadow: 10px 0px 10px;">
                                                                                                                   <div class="col-12 ml-auto mr-auto text-center mt-3 mb-3">
                                                                                                                        <h4>Emploi du temps</h4>
                                                                                                                   </div>
                                                                                                                   <div class="col-8 mr-auto ml-auto">
                                                                                                                        <a href="<?php _url($module_base.("/showCalendar")) ?>" class="btn btn-warning btn-sm form-control" target="_blank"><i class="fa fa-download"></i> Télécharger </a>
                                                                                                                   </div>
                                                                                                              </div>
                                                                                                         </div>
                                                                                                    </div>
                                                                                                    <div class="col-6" >
                                                                                                         <div class="card">
                                                                                                              <div class="row">
                                                                                                                   <img src="<?php _url(); ?>assets/custom/png/044-notebook.png" class="rounded avatar-xl img-thumbnail mb-2 ml-auto mr-auto"  style="box-shadow: 10px 0px 10px;">
                                                                                                                   <div class="col-12 ml-auto mr-auto text-center mt-3 mb-3">
                                                                                                                        <h4>Liste de classe</h4>
                                                                                                                   </div>
                                                                                                                   <div class="col-8 mr-auto ml-auto">
                                                                                                                        <a href="<?php _url($module_base."showClasseList/".$classe->classe_id) ?>" class="btn btn-warning btn-sm form-control" target="_blank"><i class="fa fa-download"></i> Télécharger </a>
                                                                                                                   </div>
                                                                                                              </div>
                                                                                                         </div>
                                                                                                    </div>
                                                                                               </div>
                                                                                               <hr>
                                                                                               <div class="modal-footer mt-3">
                                                                                                    <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                                                                               </div>
                                                                                          </div>
                                                                                     </form>
                                                                                </div>
                                                                           </div><!-- /.modal-content -->
                                                                      </div><!-- /.modal-dialog -->
                                                                 </div>
                                                            <?php endforeach;?>

                                                       </div>
                                                  </div>
                                             </div>

                                             <div id="custom-modal-<?= $niveau->settings_niveau_id ?>" class="modal-demo">
                                                  <button type="button" class="close" onclick="Custombox.modal.close();">
                                                       <span>&times;</span><span class="sr-only">Close</span>
                                                  </button>
                                                  <h4 class="custom-modal-title">Ajouter classe</h4>
                                                  <div class="custom-modal-text text-left">
                                                       <form class="row justify-content-center" action="<?php _url($module_base.'insert'); ?>" method="post">
                                                            <div class="col-10 col-md-12">

                                                                 <div class="form-group mb-3">
                                                                      <label>Niveau</label>
                                                                      <?php
                                                                      dropDown('SELECT settings_niveau_id, settings_niveau_name FROM settings_niveaux', array(
                                                                           'id'=>'settings_niveau_id',
                                                                           'name'=>'settings_niveau_id',
                                                                           'class'=>'form-control selectpicker',
                                                                           'attr'=>'title ="-- Choose --"  data-size="17" data-live-search="true" required',
                                                                           'selected' => $niveau->settings_niveau_id
                                                                      )); ?>
                                                                 </div>


                                                                 <div class="form-group mb-3">
                                                                      <label>Classe</label>
                                                                      <input type="text" class="form-control" placeholder="Classe" name="classe_name" required>
                                                                 </div>

                                                                 <hr>
                                                                 <div class="modal-footer mt-3">
                                                                      <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                                                                      <button type="submit" class="btn btn-success col-md-4">Ajouter</button>
                                                                 </div>
                                                            </div>
                                                       </form>
                                                  </div>
                                             </div>

                                        <?php endforeach;?>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          <?php endforeach;?>
     <?php endif;?>
</div>
