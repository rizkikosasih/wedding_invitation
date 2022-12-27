<!-- About Start -->
<div class="container-fluid py-5" id="about" style="opacity: 0;">
     <div class="container py-5">
          <div class="section-title position-relative text-center">
               <h1 class="font-secondary display-4" data-aos="flip-down">Pengantin Pria & Wanita</h1>
               <i class="far fa-heart text-dark"></i>
          </div>
          <div class="row mb-3 mx-0 justify-content-center">
               <div class="col-sm-8 text-center">
                    <?= html_entity_decode(statis('f', 'kata-pengantar')) ?>
               </div>
          </div>
          <div class="row m-0 mb-4 mb-md-0 pb-2 pb-md-0 flex-wrap-reverse">
               <div class="col-md-6 p-0 text-center text-md-right">
                    <div class="h-100 d-flex flex-column justify-content-center bg-secondary p-5">
                         <h3 class="mb-3">Pengantin Pria</h3>
                         <div><?= html_entity_decode($e->desc_man) ?></div>
                         <h3 class="font-secondary font-weight-normal text-capitalize text-muted mb-3">
                              <i class="fa fa-male text-primary pr-3"></i><?= $e->name_man ?>
                         </h3>
                    </div>
               </div>
               <div class="col-md-6 p-0" style="min-height: 400px;">
                    <img class="position-absolute w-100 h-100" src="<?= base_url("$dir_img/profile/$e->image_man") ?>" style="object-fit: cover;">
               </div>
          </div>
          <div class="row m-0">
               <div class="col-md-6 p-0" style="min-height: 400px;">
                    <img class="position-absolute w-100 h-100" src="<?= base_url("$dir_img/profile/$e->image_woman") ?>" style="object-fit: cover;">
               </div>
               <div class="col-md-6 p-0 text-center text-md-left">
                    <div class="h-100 d-flex flex-column justify-content-center bg-secondary p-5">
                         <h3 class="mb-3">Pengantin Wanita</h3>
                         <div><?= html_entity_decode($e->desc_woman) ?></div>
                         <h3 class="font-secondary font-weight-normal text-capitalize text-muted mb-3">
                              <i class="fa fa-female text-primary pr-3"></i><?= $e->name_woman ?>
                         </h3>
                    </div>
               </div>
          </div>
     </div>
</div>
<!-- About End -->