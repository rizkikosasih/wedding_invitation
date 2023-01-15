<!-- Gallery Start -->
<div class="container-fluid m-0 p-0 carousel-gallery bg-gallery" id="gallery" style="opacity: 0;">
     <div id="header-carousel" class="carousel slide carousel-fade" data-ride="carousel">
          <div class="carousel-inner">
               <div class="carousel-item position-relative active" style="min-height: 800px;">
                    <!-- <img class="position-absolute w-100 h-100 bg-gallery"> -->
                    <div class="carousel-caption pt-0 mt-0 d-flex flex-column align-items-center justify-content-center">
                         <div class="px-3 pb-3 pt-3" style="max-width: 900px;">
                              <div class="section-title mb-0 pb-0 position-relative text-center">
                                   <h1 class="font-secondary display-4 text-white" data-aos="zoom-in">Galeri Foto Kami</h1>
                                   <i class="far fa-heart text-white"></i>
                              </div>

                              <div class="swiper-desk" id="swiper-desk">
                                   <div class="swiper-wrapper">
                                        <?php foreach ($gallery as $i => $g): ?>
                                             <div class="swiper-slide">
                                                  <img 
                                                       class="image-slides lightboxed" 
                                                       rel="group" 
                                                       src="<?= base_url("$dir_img/gallery/x300_$g->images") ?>" 
                                                       alt=""
                                                       data-link="<?= base_url("$dir_img/gallery/x1920_$g->images") ?>" 
                                                       data-caption=""
                                                  > 
                                             </div>
                                        <?php endforeach; ?>
                                   </div>
                                   <div class="swiper-pagination"></div>
                              </div>

                              <div class="swiper swiper-cards" id="swiper-cards">
                                   <div class="swiper-wrapper">
                                        <?php foreach ($gallery as $i => $g): ?>
                                             <div class="swiper-slide">
                                                  <img 
                                                       class="lightboxed" 
                                                       rel="group2" 
                                                       src="<?= base_url("$dir_img/gallery/x300_$g->images") ?>" 
                                                       alt=""
                                                       data-link="<?= base_url("$dir_img/gallery/x1920_$g->images") ?>" 
                                                       data-caption=""
                                                  >
                                             </div>
                                        <?php endforeach; ?>
                                   </div>
                                   <div class="swiper-pagination"></div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
<!-- Gallery End -->