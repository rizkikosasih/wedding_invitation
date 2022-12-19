<!-- Friends & Family Start -->
<div class="container-fluid py-5" id="gift" style="opacity: 0;">
     <div class="container pt-5 pb-3">
          <div class="section-title position-relative text-center">
               <h1 class="font-secondary display-4" data-aos="flip-right">Friend & Family</h1>
               <i class="far fa-heart text-dark"></i>
          </div>
          <div class="row justify-content-center">
               <div class="col-12 text-center mb-2">
                    Jika anda ingin memberikan kami hadiah pernikahan sebagai tanda kasih, anda dapat mengirimkan amplop digital secara transfer kepada kami dengan rekening dibawah ini :
               </div>
          </div>
          <div class="row justify-content-center">
               <div class="col-12 col-sm-8 col-md-10">
                    <div class="card rounded-xxl bg-primary text-light shadow border border-primary text-center my-3">
                         <div class="card-body">
                              <img src="<?= $e->image ? base_url("$dir_img/bank/$e->image") : base_url("$dir_img/no-image.jpg") ?>" alt="" class="img-fluid">
                              <div class="card-text fs-3 font-weight-bold my-3">
                                   <div><?= $e->number_rekening ?></div>
                                   <div>a/n <?= $e->atas_nama ?></div>
                              </div>
                              <button 
                                   type="button" 
                                   class="btn btn-light text-primary rounded-xl fs-4 btn-copy title" 
                                   data-clipboard-text="<?= $e->number_rekening ?>" 
                                   title="Salin Nomor Rekening"
                              >
                                   <i class="fas fa-copy mr-2"></i>Salin
                              </button>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
<!-- Friends & Family End -->