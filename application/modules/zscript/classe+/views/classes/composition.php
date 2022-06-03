<div class="row">
     <div class="col-md-4">
          <div class="col-12">
               <div class="card">
                    <h4 class="mt-0 card-header">Liste des professeurs</h4>

                    <?php if(is_array(@$enseignants)):?>
                         <?php foreach(@$enseignants as $enseignant):?>
                              <div class="col-12 mt-2">
                                   <div class="bg-picture card">
                                        <div class="profile-info-name">
                                             <img src="<?php _url($enseignant->photo); ?>"
                                             class="rounded-circle avatar-xl img-thumbnail float-left mr-3" alt="profile-image">

                                             <div class="profile-info-detail overflow-hidden">
                                                  <h4 class="m-0"><?= $enseignant->prenoms." ".$enseignant->nom ?></h4>
                                                  <!-- <p class="text-muted"><i>Web Designer</i></p> -->
                                                  <p class="font-13 mt-3">
                                                       <strong>Téléphone : </strong><?= $enseignant->telephone_1 ?> <br>
                                                       <strong>Adresse : </strong><?= $enseignant->adresse ?>
                                                  </p>
                                                  <small class="text-warning"><b><?= get_age($enseignant->naissance_date) ?> ans</b></small>


                                                  <!-- <ul class="social-list list-inline mt-3 mb-0">
                                                       <li class="list-inline-item">
                                                            <a href="javascript: void(0);" class="social-list-item border-purple text-purple">
                                                                 <i class="mdi mdi-facebook"></i>
                                                            </a>
                                                       </li>
                                                       <li class="list-inline-item">
                                                            <a href="javascript: void(0);" class="social-list-item border-danger text-danger">
                                                                 <i class="mdi mdi-google"></i>
                                                            </a>
                                                       </li>
                                                       <li class="list-inline-item">
                                                            <a href="javascript: void(0);" class="social-list-item border-info text-info">
                                                                 <i class="mdi mdi-twitter"></i>
                                                            </a>
                                                       </li>
                                                       <li class="list-inline-item">
                                                            <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary">
                                                                 <i class="mdi mdi-github-circle"></i>
                                                            </a>
                                                       </li>
                                                  </ul> -->

                                             </div>

                                             <div class="clearfix"></div>
                                        </div>
                                   </div>
                              </div>
                         <?php endforeach;?>
                    <?php endif;?>

               </div>
          </div>
     </div>

     <div class="col-md-8">
          <div class="col-12">
               <div class="card">
                    <h4 class="mt-0 card-header">Liste des élèves</h4>
                    <div class="row">

                         <?php if(is_array(@$eleves)):?>
                              <?php foreach(@$eleves as $eleve):?>
                                   <div class="col-md-6 mt-2">
                                        <div class="card widget-user">
                                             <div>
                                                  <div class="avatar-lg float-left mr-3">
                                                       <div class="rounded-circle avatar-xl" style="margin-top: -15px; box-shadow: 10px 10px 10px; background-image: url('<?= _url($eleve->photo) ?>'); background-size: cover; background-repeat: no-repeat; background-position: center;"></div>
                                                  </div>
                                                  <div class="wid-u-info" style="margin-left: 125px;">
                                                       <h5 class="mt-0"><?= $eleve->prenoms." ".$eleve->nom ?></h5>
                                                       <p class="text-muted mb-1 font-13 text-truncate"><?= $eleve->telephone_1 ?></p>
                                                       <small class="text-warning"><b><?= get_age($eleve->naissance_date) ?> ans</b></small>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              <?php endforeach;?>
                         <?php endif;?>

                    </div>
               </div>
          </div>
     </div>
</div>
