     <?= form_open('admin/auth', ['id'=>'login-form']) ?>
    
          <?= form_error('username', '<small class="text-danger error">', '</small>') ?>
          <div class="input-group mb-3">
               <input type="text" class="form-control" id="username" name="username" placeholder="Username">
               <div class="input-group-append">
                    <div class="input-group-text">
                         <span class="fas fa-user"></span>
                    </div>
               </div>
          </div>

          <?= form_error('password', '<small class="text-danger error">', '</small>') ?>
          <div class="input-group mb-3">
               <input type="password" class="form-control pwd-login" id="password" name="password" placeholder="Password">
               <div class="input-group-append">
                    <div class="input-group-text">
                         <span class="fas fa-lock"></span>
                    </div>
               </div>
          </div>

          <div class="row">

               <div class="col-8">
                    <div class="icheck-primary">
                         <input type="checkbox" id="show-pwd">
                         <label for="show-pwd">
                         Lihat Password
                         </label>
                    </div>
               </div>
               
               <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block btn-login">Sign In</button>
               </div>

          </div>

     <?= form_close() ?>

     <!-- social-auth-links -->
     <!--
     <div class="social-auth-links text-center mt-2 mb-3">
          <a href="#" class="btn btn-block btn-primary">
               <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
          </a>
          <a href="#" class="btn btn-block btn-danger">
               <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
          </a>
     </div>
     -->
     
     <!--
     <div class="row text-capitalize mt-3">

          <div class="col-5">
               <a href="<?= base_url('auth/lupa_password') ?>" class="my-link">
                    lupa password?
               </a>
          </div>

          <div class="col-7 text-right">
               <a href="<?= base_url('auth/register') ?>" class="my-link title" data-placement="left" title="Daftar Disini">
                    Belum memiliki akun?
               </a>
          </div>

     </div> 
      -->
     