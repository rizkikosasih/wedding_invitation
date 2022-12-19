<!-- Carousel Start -->
<div class="container-fluid p-0 mb-5 pb-5" id="home" style="opacity: 0;">
     <div id="header-carousel" class="carousel slide carousel-fade" data-ride="carousel">
          <div class="carousel-inner">
               <div class="carousel-item position-relative active" style="height: 100vh; min-height: 400px;">
                    <img class="position-absolute w-100 h-100" src="<?= base_url("$dir_img/event/$e->background_home") ?>" style="object-fit: cover;">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                         <div class="p-3" style="max-width: 900px;">
                              <h1 class="display-1 font-secondary text-white text-capitalize mt-n3 mb-md-4">
                                   <?= $e->alias_woman ?> & <?= $e->alias_man ?>
                              </h1>
                              <div class="d-inline-block border-top border-bottom border-light py-3 px-4">
                                   <h3 class="text-uppercase font-weight-normal text-white m-0 type-it" style="letter-spacing: 2px;" data-text="Kami Akan Menikah">
                                   </h3>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
<!-- Carousel End -->