<div class="contact-area mt-50">
     <div class="inbox-area">
          <div class="container">
               <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                         <div class="inbox-left-sd">
                              <div class="compose-ml">
                                   <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModaltwo">Ajoutez un sujet</button>
                              </div>
                              <div class="inbox-status" style="height: 220px; overflow-y:auto;">
                                   <ul class="inbox-st-nav inbox-ft mb-20">
                                        <?php if(is_array(@$subjects)):?>
                                             <?php foreach($subjects as $subject):?>
                                                  <li>
                                                       <a href="<?php _url('site/chat/showBox/subject/'.$subject->subject_id); ?>" style="font-size: 15px; ">
                                                            <?= $subject->subject_libelle ?>

                                                            <span class="pull-right">
                                                                 <div class="dialog-pro dialog">
                                                                      <button class="btn btn-default btn-icon-notika" data-toggle="modal" data-target="#delete_modal_<?= @$subject->subject_id ?>" style=" width: 40px; border-radius: 50px; border: 0px; margin-top: -5px;">
                                                                           <i class="notika-icon notika-trash" style="color: #F44336;"></i>
                                                                      </button>
                                                                 </div>
                                                            </span>
                                                       </a>

                                                       <div class="modal fade" id="delete_modal_<?= @$subject->subject_id ?>" role="dialog">
                                                            <div class="modal-dialog modal-sm nk-red">
                                                                 <form class="modal-content" action="<?php _url('site/chat/insert_subjet') ?>" method="post">
                                                                      <div class="modal-header">
                                                                           <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                      </div>
                                                                      <div class="modal-body">
                                                                           <h2 class="mb-50 text-header text-primary" style="font-size: 30px;">Ajouter sujet</h2>
                                                                           <div class="form-group ic-cmp-int float-lb floating-lb ">
                                                                                <div class="form-ic-cmp">
                                                                                     <i class="notika-icon notika-support"></i>
                                                                                </div>
                                                                                <div class="nk-int-st">
                                                                                     <input type="text" class="form-control" name="subject_libelle">
                                                                                     <label class="nk-label">Sujet de discussion</label>
                                                                                </div>
                                                                           </div>
                                                                      </div>
                                                                      <div class="modal-footer mt-50">
                                                                           <button type="submit" class="btn btn-success btn-modal">Valider</button>
                                                                           <button type="button" class="btn btn-danger btn-modal" data-dismiss="modal">Annuler</button>
                                                                      </div>
                                                                 </form>
                                                            </div>
                                                       </div>

                                                  </li>
                                             <?php endforeach;?>
                                        <?php endif;?>
                                   </ul>
                              </div>
                              <div class="compose-ml mt-20" style="border-top: 1px solid silver; ">
                                   <p class="text-primary text-header mt-20">Membres connectés</p>
                              </div>
                              <div class="inbox-status" style="height: 350px;  overflow-y:auto;">
                                   <ul class="inbox-st-nav inbox-nav-mg">
                                        <li><a href="#"><i class="notika-icon notika-success"></i> Forum</a></li>
                                        <li><a href="#"><i class="notika-icon notika-chat"></i> Chat</a></li>
                                        <li><a href="#"><i class="notika-icon notika-star"></i> Work</a></li>
                                        <li><a href="#"><i class="notika-icon notika-settings"></i> Settings</a></li>
                                        <li><a href="#"><i class="notika-icon notika-support"></i> Support</a></li>
                                        <li><a href="#"><i class="notika-icon notika-chat"></i> Chat</a></li>
                                        <li><a href="#"><i class="notika-icon notika-star"></i> Work</a></li>
                                        <li><a href="#"><i class="notika-icon notika-settings"></i> Settings</a></li>
                                        <li><a href="#"><i class="notika-icon notika-support"></i> Support</a></li>
                                        <li><a href="#"><i class="notika-icon notika-success"></i> Forum</a></li>
                                        <li><a href="#"><i class="notika-icon notika-chat"></i> Chat</a></li>
                                        <li><a href="#"><i class="notika-icon notika-star"></i> Work</a></li>
                                        <li><a href="#"><i class="notika-icon notika-settings"></i> Settings</a></li>
                                        <li><a href="#"><i class="notika-icon notika-support"></i> Support</a></li>
                                        <li><a href="#"><i class="notika-icon notika-success"></i> Forum</a></li>
                                        <li><a href="#"><i class="notika-icon notika-chat"></i> Chat</a></li>
                                        <li><a href="#"><i class="notika-icon notika-star"></i> Work</a></li>
                                        <li><a href="#"><i class="notika-icon notika-settings"></i> Settings</a></li>
                                        <li><a href="#"><i class="notika-icon notika-support"></i> Support</a></li>
                                        <li><a href="#"><i class="notika-icon notika-chat"></i> Chat</a></li>
                                        <li><a href="#"><i class="notika-icon notika-star"></i> Work</a></li>
                                        <li><a href="#"><i class="notika-icon notika-settings"></i> Settings</a></li>
                                        <li><a href="#"><i class="notika-icon notika-support"></i> Support</a></li>
                                        <li><a href="#"><i class="notika-icon notika-success"></i> Forum</a></li>
                                        <li><a href="#"><i class="notika-icon notika-chat"></i> Chat</a></li>
                                        <li><a href="#"><i class="notika-icon notika-star"></i> Work</a></li>
                                        <li><a href="#"><i class="notika-icon notika-settings"></i> Settings</a></li>
                                        <li><a href="#"><i class="notika-icon notika-support"></i> Support</a></li>
                                        <li><a href="#"><i class="notika-icon notika-success"></i> Forum</a></li>
                                        <li><a href="#"><i class="notika-icon notika-chat"></i> Chat</a></li>
                                        <li><a href="#"><i class="notika-icon notika-star"></i> Work</a></li>
                                        <li><a href="#"><i class="notika-icon notika-settings"></i> Settings</a></li>
                                        <li><a href="#"><i class="notika-icon notika-support"></i> Support</a></li>
                                   </ul>
                              </div>
                         </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                         <?= $sub_content ?>
                    </div>
               </div>
          </div>
     </div>
</div>

<div class="modal fade" id="myModaltwo" role="dialog">
     <div class="modal-dialog modal-sm">
          <form class="modal-content" id="modal-form" action="<?php _url('site/chat/insert_subjet') ?>" method="post">
               <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
               </div>
               <div class="modal-body">
                    <h2 class="mb-50 text-header text-primary" style="font-size: 30px;">Ajouter sujet</h2>
                    <div class="form-group ic-cmp-int float-lb floating-lb ">
                         <div class="form-ic-cmp">
                              <i class="notika-icon notika-support"></i>
                         </div>
                         <div class="nk-int-st">
                              <input type="text" class="form-control" name="subject_libelle">
                              <label class="nk-label">Sujet de discussion</label>
                         </div>
                    </div>
               </div>
               <div class="modal-footer mt-50">
                    <button type="submit" class="btn btn-success btn-modal">Valider</button>
                    <button type="button" class="btn btn-danger btn-modal" data-dismiss="modal">Annuler</button>
               </div>
          </form>
     </div>
</div>
