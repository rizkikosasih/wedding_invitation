<!-- Gallery Start -->
<div class="container-fluid py-5 mx-0 px-0" id="gallery" style="opacity: 0;">
     <img class="position-absolute w-100 h-100 bg-gallery">
     <div class="section-title position-relative text-center pt-3">
          <h1 class="font-secondary display-4 text-white" data-aos="zoom-in">Galeri Foto Kami</h1>
          <i class="far fa-heart text-white"></i>
     </div>

     <div class="swiper-desk">
          <div class="d-flex justify-content-center gap-5 mb-5">
               <div class="swiper-button-prev"></div>
               <div class="swiper-button-next"></div>
          </div>
          <div class="swiper-wrapper">
               <?php foreach ($gallery as $i => $g): ?>
                    <div class="swiper-slide">
                         <a 
                              href="<?= base_url($dir_img . '/gallery/' . $g->images) ?>" 
                              data-lightbox="gallery" 
                              data-title="<?= $g->description ?>"
                         >
                              <img class="image-slide" src="<?= base_url($dir_img . '/gallery/' . $g->images) ?>" alt="">
                         </a>
                    </div>
               <?php endforeach; ?>
          </div>
     </div>

     <div class="swiper">
          <div class="swiper-wrapper">
               <?php foreach ($gallery as $i => $g): ?>
                    <div class="swiper-slide">
                         <a 
                              href="<?= base_url($dir_img . '/gallery/' . $g->images) ?>" 
                              data-lightbox="gallery" 
                              data-title="<?= $g->description ?>"
                         >
                              <img class="" src="<?= base_url($dir_img . '/gallery/' . $g->images) ?>" alt="">
                         </a>
                    </div>
               <?php endforeach; ?>
          </div>
     </div>
</div>
<!-- Gallery End -->