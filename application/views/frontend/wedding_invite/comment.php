<!-- RSVP Start -->
<div class="container-fluid py-5" id="comment" style="opacity: 0;">
     <div class="container py-5">
          <div class="section-title position-relative text-center">
               <h1 class="font-secondary display-4" data-aos="flip-left">Kirim Ucapan & Doa</h1>
               <i class="far fa-heart text-dark"></i>
          </div>
          <div class="row comment-content">
               <div class="col-12 col-sm-6 mb-3 mb-sm-0 comment-form">
                    <form action="javascript:void(0)" method="post" class="form-comment">
                         <div class="form-group">
                              <label class="fw-bold">Nama</label>
                              <input type="text" class="form-control" id="name" name="name" placeholder="Masukan Nama Anda">
                         </div>

                         <div class="form-group">
                              <label class="fw-bold">Pesan</label>
                              <textarea name="message" id="message" cols="5" rows="3" class="form-control" placeholder="Berikan Ucapan & Doa Restu"></textarea>
                         </div>

                         <div class="form-group">
                              <button type="submit" class="btn btn-primary btn-block" style="border-radius: 2rem;">Submit</button>
                         </div>
                    </form>
               </div>
               <div class="col-12 col-sm-6 list-comment">
                    <?php if (!$comment): ?>
                         <div class="text-center" style="margin-top: 5rem;">
                              <div class="fs-4">Kirimkan Ucapan Sekarang</div>
                         </div>
                    <?php endif; ?>
                    <?php 
                         foreach ($comment as $i => $c): 
                         $attrCard = !$i ? "data-last='$c->id'" : ""; 
                         $classCard = !$i ? 'last' : ''; 
                    ?>
                         <div <?= $attrCard ?> class="card my-3 font-small-3 border-0 card-comment <?= $classCard ?>">
                              <div class="card-header">
                                   <div class="d-flex flex-row align-items-center gap-2 fw-bold">
                                        <div class="avatar bg-primary"><?= initialName($c->name) ?></div><?= $c->name ?>
                                   </div>
                              </div>
                              <div class="card-body">
                                   <?= html_entity_decode($c->message) ?>
                              </div>
                         </div>
                    <?php endforeach; ?>
               </div>
          </div>
     </div>
</div>
<!-- RSVP End -->