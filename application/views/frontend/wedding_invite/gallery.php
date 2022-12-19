<!-- Gallery Start -->
<div class="container-fluid bg-gallery" id="gallery" style="padding: 120px 0; margin: 90px 0;opacity: 0;">
     <div class="section-title position-relative text-center" style="margin-bottom: 120px;">
          <h1 class="font-secondary display-4 text-white" data-aos="zoom-in">Galeri Foto Kami</h1>
          <i class="far fa-heart text-white"></i>
     </div>
     <div class="owl-carousel gallery-carousel">
          <?php foreach ($gallery as $i => $g): ?>
               <div class="gallery-item">
                    <img class="img-fluid w-100" src="<?= base_url($dir_img . '/gallery/' . $g->images) ?>" alt="">
                    <a 
                         href="<?= base_url($dir_img . '/gallery/' . $g->images) ?>" 
                         data-lightbox="gallery" 
                         data-title="<?= $g->description ?>"
                    >
                         <i class="fa fa-2x fa-plus text-white"></i>
                    </a>
               </div>
          <?php endforeach; ?>
     </div>
</div>
<!-- Gallery End -->