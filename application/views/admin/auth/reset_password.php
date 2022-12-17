     <?php if( $result === 200 ){ ?>

          <?= form_open('auth/reset_password', 'id="login-form"') ?>

               <input type="hidden" name="id" value="<?= $id ?>">
               
               <?= form_error('password', '<small class="text-danger error">', '</small>') ?>
               <div class="input-group mb-3">
                    <input type="password" class="form-control pass" name="password" autofocus placeholder="Password Baru">
                    <div class="input-group-append">
                         <div class="input-group-text">
                              <span class="fas fa-key"></span>
                         </div>
                    </div>
               </div>
               
               <?= form_error('re_password', '<small class="text-danger error">', '</small>') ?>
               <div class="input-group mb-3">
                    <input type="password" class="form-control re-pass" name="re_password" placeholder="Repeat Password">
                    <div class="input-group-append">
                         <div class="input-group-text">
                              <span class="fas fa-lock"></span>
                         </div>
                    </div>
               </div>

               <div class="row">

                    <div class="col-8">
                         <div class="icheck-primary">
                              <input type="checkbox" id="reset-pwd">
                              <label for="reset-pwd">Lihat Password</label>
                         </div>
                    </div>

                    <div class="col-4">
                         <button type="submit" class="btn btn-primary btn-block btn-login">Submit</button>
                    </div>

               </div>

          <?= form_close() ?>

     <?php }else{ ?>

          <div class="row">

               <div class="col-lg-12">

                    <div class="text-center">
                         <img src="<?= base_url('assets/backend/dist/img/icon/icon-gagal.gif') ?>" class="img-responsive myIcon" alt="Token tidak ditemukan">
                    </div>

                    <h6 class="text-center">
                         <label class="d-block">Token tidak ditemukan atau sudah expired !</label>
                         <a href="<?= base_url('auth') ?>" class="btn btn-md btn-success">
                              <i class="fas fa-arrow-left"></i> Kembali
                         </a>
                    </h6>

               </div>

          </div>
     
     <?php } ?>