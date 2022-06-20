<div class="row">
     <div class="col-sm-12">
          <div class="card">
               <div class="col-xl-6">
                    <h5 class="mb-3">Répartition des élèves</h5>
                    <ul class="nav nav-tabs nav-justified">
                         <?php if(is_array(@$classes)):?>
                              <?php foreach(@$classes as $classe):?>
                                   <li class="nav-item">
                                        <a href="#home<?= $classe->classe_id ?>" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                             <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                             <span class="d-none d-sm-block"><?= $classe->classe_name ?></span>
                                        </a>
                                   </li>
                              <?php endforeach;?>
                         <?php endif;?>
                    </ul>

                    <div class="tab-content">
                         <?php if(is_array(@$classes)):?>
                              <?php foreach(@$classes as $classe):?>
                                   <?php foreach(@$classe->eleves as $eleve):?>
                                        <div role="tabpanel" class="tab-pane fade show active" id="home2">
                                             <div class="card">
                                                  <div class="card-body">
                                                       <div class="media">
                                                            <img src="<?= _url($eleve->photo) ?>" alt="" class="circle-60">
                                                            <div class="media-body ml-3 mt-2">
                                                                 <h6 class="mb-1"><?= $eleve->prenoms." ".$eleve->nom ?></h6>
                                                                 <p class="mb-0 text-muted">
                                                                      Tel : <?= $eleve->telephone_1?>
                                                                 </p>
                                                            </div>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   <?php endforeach;?>
                              <?php endforeach;?>
                         <?php endif;?>

                    </div>
               </div><!-- end col -->
          </div>
     </div>
</div>

<!-- <div class="card col-12">
<div class="card-title mb-5">Simple Dragule</div>
<div class="card-body">
<p class="card-subtitle">Drag and drop between Team A and Team B</p>
<div class="row">
<div class="col-md-6">
<div class="card">
<div class="card-body">
<h6 class="card-title mb-3">Team A</h6>
<div id="profile-list-left">
<div class="card">
<div class="card-body">
<div class="media">
<img src="assets/imgs/Avatars/avatar1.jpg" alt="" class="circle-60">
<div class="media-body ml-3 mt-2">
<h6 class="mb-1">Rebecca young</h6>
<p class="mb-0 text-muted">
Software engineer
</p>
</div>
</div>
</div>
</div>
<div class="card">
<div class="card-body">
<div class="media">
<img src="assets/imgs/Avatars/avatar2.jpg" alt="" class="circle-60">
<div class="media-body ml-3 mt-2">
<h6 class="mb-1">Jacob march</h6>
<p class="mb-0 text-muted">
Designer
</p>
</div>
</div>
</div>
</div>
<div class="card">
<div class="card-body">
<div class="media">
<img src="assets/imgs/Avatars/avatar3.jpg" alt="" class="circle-60">
<div class="media-body ml-3 mt-2">
<h6 class="mb-1">Catherine</h6>
<p class="mb-0 text-muted">
Tester
</p>
</div>
</div>
</div>
</div>
<div class="card">
<div class="card-body">
<div class="media">
<img src="assets/imgs/Avatars/avatar4.jpg" alt="" class="circle-60">
<div class="media-body ml-3 mt-2">
<h6 class="mb-1">Thomas Cook</h6>
<p class="mb-0 text-muted">
Developer
</p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<div class="col-md-6">
<div class="card">
<div class="card-body">
<h6 class="card-title mb-3">Team B</h6>
<div id="profile-list-right">
<div class="card">
<div class="card-body">
<div class="media">
<img src="assets/imgs/Avatars/avatar5.jpg" alt="" class="circle-60">
<div class="media-body ml-3 mt-2">
<h6 class="mb-1">Keto Philip</h6>
<p class="mb-0 text-muted">
Business Analyst
</p>
</div>
</div>
</div>
</div>
<div class="card">
<div class="card-body">
<div class="media">
<img src="assets/imgs/Avatars/avatar6.jpg" alt="" class="circle-60">
<div class="media-body ml-3 mt-2">
<h6 class="mb-1">Jacob Stephen</h6>
<p class="mb-0 text-muted">
Tester
</p>
</div>
</div>
</div>
</div>
<div class="card">
<div class="card-body">
<div class="media">
<img src="assets/imgs/Avatars/avatar7.jpg" alt="" class="circle-60">
<div class="media-body ml-3 mt-2">
<h6 class="mb-1">March Creg</h6>
<p class="mb-0 text-muted">
Developer
</p>
</div>
</div>
</div>
</div>
<div class="card">
<div class="card-body">
<div class="media">
<img src="assets/imgs/Avatars/avatar8.jpg" alt="" class="circle-60">
<div class="media-body ml-3 mt-2">
<h6 class="mb-1">Peter Beckham</h6>
<p class="mb-0 text-muted">
Designer
</p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div> -->
