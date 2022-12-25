<!-- Modal -->
<div class="modal fade" id="cover" tabindex="-1" aria-labelledby="coverLabel" aria-hidden="true">
     <div class="modal-dialog modal-fullscreen">
          <div class="modal-content">
               <div id="header-carousel" class="carousel slide carousel-fade" data-ride="carousel">
                    <div class="carousel-inner">
                         <div class="carousel-item position-relative active" style="height: 100vh;">
                              <img class="position-absolute w-100 h-100 bg-cover">
                              <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                   <div class="p-3" style="max-width: 900px;">
                                        <div class="modal-body">
                                             <div class="col-12 content-cover">
                                                  <div class="section-title position-relative text-center mb-1">
                                                       <h1 class="font-secondary fw-bold display-4">
                                                            <?= $e->alias_woman ?><span class="mx-3">&</span><?= $e->alias_man ?>
                                                       </h1>
                                                       <i class="far fa-heart text-white"></i>
                                                  </div>
                                                  <div class="display-5">Kepada Yth. Bapak/Ibu/Saudara/i</div>
                                                  <div class="my-3 fs-1 fw-bold text-capitalize">
                                                       <?= $invitedName ?>
                                                  </div>
                                                  <div class="mb-3">*mohon maaf apabila ada kesalahan nama atau gelar</div>
                                                  <button type="button" class="btn btn-primary rounded rounded-xl" data-dismiss="modal">
                                                       <i class="fas fa-envelope-open mr-2"></i>Buka Undangan
                                                  </button>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>