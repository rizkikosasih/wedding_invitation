<!-- Event Start -->
<div class="container-fluid py-5" id="event" style="opacity: 0;">
     <div class="container py-5">
          <div class="section-title position-relative text-center">
               <h1 class="font-secondary display-4" data-aos="fade-up">Detail Acara</h1>
               <i class="far fa-heart text-dark"></i>
          </div>
          <?php
               $time = explode(':', getDates('time_full', $e->reception_date));
               $date = explode('-', getDates('date', $e->reception_date));
               $timestampRec = strtotime(date('Y-m-d H:i:s', mktime($time[0], $time[1], $time[2], $date[1], $date[2], $date[0])));
          ?>
          <div class="row justify-content-center">
               <div class="flipdown my-3" id="reception-flipdown" data-reception="<?= $timestampRec ?>"></div>
          </div>
          <div class="row justify-content-center mt-3">
               <div class="col-md-6 text-center">
                    <h5 class="font-weight-normal text-muted mb-3 pb-3">
                         Kegiatan ini Insya Allah akan dilaksanakan pada :
                    </h5>
               </div>
          </div>
          <div class="row justify-content-center">
               <div class="col-md-5 border border-primary bg-light-primary rounded">
                    <div class="text-center">
                         <h1 class="text-center my-3">Akad Nikah</h1>
                         <div class="header my-3">
                              <div class="section-title position-relative text-center mb-3">
                                   <i class="far fa-heart text-dark"></i>
                              </div>
                              <h1 class="font-secondary display-5"><?= nameDate($e->reception_date) ?></h1>
                              <h1 class="font-secondary display-5"><?= date_indo(getDates('date', $e->reception_date)) ?></h1>
                              <div class="section-title position-relative text-center">
                                   <i class="far fa-heart text-dark"></i>
                              </div>
                         </div>
                         <div class="mb-2 fw-bold"><?= html_entity_decode($e->wedding_location) ?></div>
                         <div class="mb-3 fw-bold"><?= getDates('time', $e->wedding_date) ?> WIB - Selesai</div>
                    </div>
               </div>
               <div class="mx-3 my-5"></div>
               <div class="col-md-5 border border-primary bg-light-primary rounded">
                    <div class="text-center">
                         <h1 class="my-3">Resepsi</h1>
                         <div class="header my-3">
                              <div class="section-title position-relative text-center mb-3">
                                   <i class="far fa-heart text-dark"></i>
                              </div>
                              <h1 class="font-secondary display-5"><?= nameDate($e->reception_date) ?></h1>
                              <h1 class="font-secondary display-5"><?= date_indo(getDates('date', $e->reception_date)) ?></h1>
                              <div class="section-title position-relative text-center">
                                   <i class="far fa-heart text-dark"></i>
                              </div>
                         </div>
                         <div class="mb-2 fw-bold"><?= html_entity_decode($e->reception_location) ?></div>
                         <div class="mb-3 fw-bold"><?= getDates('time', $e->reception_date) ?> WIB - Selesai</div>
                         <a href="<?= $e->wedding_map ?>" class="btn btn-primary" target="_blank"><i class="fas fa-paper-plane mr-2"></i>Open Map</a>
                    </div>
               </div>
          </div>
     </div>
</div>
<!-- Event End -->