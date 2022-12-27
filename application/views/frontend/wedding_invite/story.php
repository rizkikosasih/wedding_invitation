<!-- Story Start -->
<div class="container-fluid py-5" id="story" style="opacity: 0;">
     <div class="container pt-5 pb-3">
          <div class="section-title position-relative text-center">
               <h1 class="font-secondary display-4" data-aos="flip-up">Kisah Cinta Kami</h1>
               <i class="far fa-heart text-dark"></i>
          </div>
          <div class="container timeline position-relative p-0">
               <?php foreach ($love_story as $i => $ls): ?>
                    <div class="row align-items-md-center gap-md-3 <?= !$ls->position ? 'flex-row-reverse' : '' ?>">
                         <div class="col-md-6 text-center">
                              <i class="<?= !$ls->position ? 'far fa-heart' : 'fas fa-hand-holding-heart' ?> text-primary font-large-5"></i>
                              <!-- <img class="img-fluid mr-md-3" src="<?= base_url($dir_img . '/story-1.jpg') ?>" alt=""> -->
                         </div>
                         <div 
                              class="col-md-6 text-center <?= !$ls->position ? 'text-md-right' : 'text-md-left' ?>" 
                              data-aos="<?= !$ls->position ? 'fade-down-right' : 'fade-down-left' ?>"
                         >
                              <div class="h-100 d-flex flex-column justify-content-center bg-secondary p-4 <?= $ls->position ? 'ml-md-3' : 'mr-md-3' ?>">
                                   <h4 class="mb-2"><?= $ls->title ?></h4>
                                   <div class="m-0">
                                        <?= html_entity_decode($ls->body) ?>
                                   </div>
                              </div>
                         </div>
                    </div>
               <?php endforeach; ?>
          </div>
     </div>
</div>
<!-- Story End -->