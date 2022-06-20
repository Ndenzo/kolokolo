<form id="form_studie" class="validatedForm" method="post" action="<?= _url($module_base.'insert') ?>" autocomplete="off" enctype="multipart/form-data">
     <div class="container-fluid">
          <div class="row">
               <div class="col-xl-7">

                    <div class="card mb-3">
                         <div class="card-body">
                              <div class="card-title mb-5">
                                   <h5 class="text-uppercase font-weight-bold"> <?= $this->lang->line('studie-header-define') ?> </h5>
                              </div>
                              <?php show_notification();?>
                              <div class="row mb-4">
                                   <div class="col-12">
                                        <div class="theme-form mega-form">
                                             <div class="form-group mb-3">
                                                  <ul class="nav nav-pills nav-pills-custom mt-3" id="pills-tab-custom" role="tablist">
                                                       <li class="nav-item">
                                                            <a class="nav-link active" id="pills-fr-tab-custom" data-toggle="pill" href="#pills-fr" role="tab" aria-controls="pills-fr" aria-selected="true">
                                                                 <?= $this->lang->line('label-french-title') ?>
                                                            </a>
                                                       </li>
                                                       <li class="nav-item">
                                                            <a class="nav-link" id="pills-gb-tab-custom" data-toggle="pill" href="#pills-gb" role="tab" aria-controls="pills-gb" aria-selected="false">
                                                                 <?= $this->lang->line('label-english-title') ?>
                                                            </a>
                                                       </li>
                                                  </ul>

                                                  <div class="tab-content tab-content-custom-pill" id="pills-tabContent-custom" style="margin-top:-30px;">
                                                       <div class="tab-pane fade show active" id="pills-fr" role="tabpanel" aria-labelledby="pills-fr-tab-custom">
                                                            <label><?= $this->lang->line('studie-form-label-name') ?></label>
                                                            <input type="text" class="form-control" placeholder="<?= $this->lang->line('studie-form-placeholder-name') ?>" name="studie_name" required>
                                                       </div>
                                                       <div class="tab-pane fade" id="pills-gb" role="tabpanel" aria-labelledby="pills-gb-tab-custom">
                                                            <label><?= $this->lang->line('studie-form-label-name') ?></label>
                                                            <input type="text" class="form-control" placeholder="<?= $this->lang->line('studie-form-placeholder-name') ?>" name="studie_name_gb" required>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>

                    <div class="card mb-5">
                         <div class="card-body">
                              <div class="card-title mb-5">
                                   <h5 class="text-uppercase font-weight-bold"> <?= $this->lang->line('studie-header-content') ?> </h5>
                              </div>
                              <?php show_notification();?>
                              <div class="row mb-5">
                                   <div class="col-12">
                                        <center id="content_tmp">
                                             <button class="btn btn-outline-info btn-icon-text mr-2" id="text_adder">
                                                  <i class="mdi mdi-note-text btn-icon-prepend mdi-36px"></i>
                                                  <span class="d-inline-block text-left">
                                                       <small class="font-weight-light d-block mb-1"> <?= $this->lang->line('studie-message-addContent') ?> </small>
                                                       <strong>Text</strong>
                                                  </span>
                                             </button>
                                             <button class="btn btn-outline-warning btn-icon-text ml-2" id="image_adder">
                                                  <i class="mdi mdi-image btn-icon-prepend mdi-36px"></i>
                                                  <span class="d-inline-block text-left">
                                                       <small class="font-weight-light d-block mb-1"> <?= $this->lang->line('studie-message-addContent') ?> </small>
                                                       <strong>Image</strong>
                                                  </span>
                                             </button>
                                        </center>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <div class="col-xl-5">
                    <div class="card mb-5">
                         <div class="card-body">
                              <div class="card-title mb-5">
                                   <h5 class="text-uppercase font-weight-bold"> <?= $this->lang->line('studie-header-doc') ?> </h5>
                              </div>
                              <div class="row">
                                   <div class="col-12 text-center">
                                        <div class="form-group mb-3">
                                             <label><?= $this->lang->line('studie-form-label-import') ?> <strong class="needed">(.pdf)</strong> </label>
                                             <input type="file" class="dropify"  name="studie_link"/>
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

</form>
