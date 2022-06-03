<div class="row">
     <div class="col-lg-8">
          <div class="d-lg-flex align-items-baseline">
               <h5 class="text-dark mb-0">
                    Tableau de bord
               </h5>
               <!-- <p class="ml-md-3 font-weight-light mb-0 mt-1">Dashboard</p> -->
          </div>
     </div>
     <div class="col-lg-4 text-lg-right">
          <div class="d-lg-flex justify-content-end  pageheader-icons">
               <a href="#" class="btn d-flex align-items-center"><i class="mdi mdi-heart-outline"></i></a>
               <a href="#" class="btn d-flex align-items-center"><i class="mdi mdi-calendar-blank"></i></a>
               <a href="#" class="btn d-flex align-items-center"><i class="mdi mdi-bookmark-outline"></i></a>
               <a href="#" class="btn d-flex align-items-center"><i class="mdi mdi-settings"></i></a>
          </div>
     </div>
</div>

<div class="row mt-4">
     <div class="col-12">
          <div class="card">
               <div class="card-body" style="height: 800px;">
                    <div class="row">
                         <div class="col-lg-4">
                              <div class="card-body col-12">
                                   <h4 class="card-title">Projets</h4>
                                   <div class="add-items d-flex">
                                        <input type="text" class="form-control todo-list-input"  placeholder="Recherche">
                                   </div>
                                   <div class="border-top" style="overflow-y: auto; max-height: 600px;">
                                        <?php if(is_array(@$projects)):?>
                                             <?php foreach(@$projects as $key => $project):?>
                                                  <a href="#" class="d-flex align-items-center py-3 border-bottom" onclick="javascript:change_project_content(<?= $project->project_id ?>)">
                                                       <?php if ($project->project_picture == null): ?>
                                                            <img class="img-sm" src="https://via.placeholder.com/43x43" alt="profile">
                                                       <?php else: ?>
                                                            <div class="img-sm img-project" style="background-image: url('<?= _url(@$project->project_picture); ?>')"></div>
                                                       <?php endif; ?>
                                                       <div class="ml-3">
                                                            <h6 class="mb-1"><?= $project->project_name ?></h6>
                                                            <small class="text-muted mb-0"><i class="mdi mdi-map-marker mr-1"></i><?= $project->project_address ?></small>
                                                       </div>
                                                       <i id="active_project_<?= $project->project_id ?>" class="mdi mdi-check-circle-outline font-weight-bold ml-auto px-1 py-1 text-info mdi-24px <?php if ($key != 0): ?> d-none <?php endif; ?>"></i>
                                                  </a>
                                             <?php endforeach;?>
                                             <?php $project = $projects[0]; ?>
                                        <?php endif;?>
                                   </div>
                                   <input type="hidden" id="current_project" value="<?= $project->project_id ?>">
                              </div>
                         </div>
                         <div class="col-lg-8" id="project_content">
                              <ul class="nav nav-pills nav-pills-primary mt-2" id="pills-tab" role="tablist">
                                   <li class="nav-item">
                                        <a class="nav-link active" id="pills-desc-tab" data-toggle="pill" href="#pills-desc" role="tab" aria-controls="pills-desc" aria-selected="true"><i class="mdi mdi-file-document-box"></i> Description</a>
                                   </li>
                                   <li class="nav-item">
                                        <a class="nav-link" id="pills-galerie-tab" data-toggle="pill" href="#pills-galerie" role="tab" aria-controls="pills-galerie" aria-selected="false"><i class="mdi mdi-image-multiple"></i> Galerie</a>
                                   </li>
                                   <li class="nav-item">
                                        <a class="nav-link" id="pills-position-tab" data-toggle="pill" href="#pills-position" role="tab" aria-controls="pills-position" aria-selected="false"><i class="mdi mdi-map-marker"></i> Position</a>
                                   </li>
                              </ul>
                              <div class="tab-content" id="pills-tabContent" style="max-height: 680px; overflow-y: auto;">
                                   <div class="tab-pane fade show active" id="pills-desc" role="tabpanel" aria-labelledby="pills-desc-tab">
                                        <div class="media">
                                             <?= quill_format($project->project_desc) ?>
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
                                   <div class="tab-pane fade" id="pills-position" role="tabpanel" aria-labelledby="pills-position-tab">
                                        <div class="media">
                                             <iframe class="col-12" src="https://www.google.com/maps/embed?pb=@14.7220278,-17.4481499,18z/data=!4m15!1m8!3m7!1s0x0:0xe179154646727eb!2zMTTCsDQzJzE5LjMiTiAxN8KwMjYnNDkuNCJX!3b1!7e2!8m2!3d14.7220288!4d-17.447062!3m5!1s0x0:0xe179154646727eb!7e2!8m2!3d14.7220288!4d-17.447062?hl=fr" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>




<!--
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCnT63XUjqjPgXZ0lFTU_pdpfUX7swzTTM&callback=initMap"></script>

<script type="text/javascript">
var map;

function initMap() {
map = new google.maps.Map(document.getElementById("map"), {
center: { lat: -34.397, lng: 150.644 },
zoom: 8,
});
}
</script> -->
