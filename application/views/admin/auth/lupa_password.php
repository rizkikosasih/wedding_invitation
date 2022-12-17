     <div class="row label-email text-center mt-2 mb-2">
          <label for="">Anda lupa kata sandi Anda? Di sini Anda dapat dengan mudah mengambil kata sandi baru.</label>
     </div>

     <?= form_open('auth/lupa_password', [ 'id' => "login-form", "class" => "myForm" ] ) ?>

          <?= form_error('email', '<small class="text-danger error">', '</small>') ?>
          <div class="form-group mb-3">
               <input type="email" class="form-control" name="email" autofocus placeholder="Email Anda">
          </div>
    
          <label for="email" class="error" id="email-error" style="display:none;">Kolom ini diperlukan.</label>

          <div class="row">
          
               <div class="col-12 mt-2">
                    <button type="submit" class="btn btn-primary btn-block btn-login">Submit</button>
               </div>

          </div>

     <?= form_close() ?>