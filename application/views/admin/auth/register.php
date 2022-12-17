     <?= form_open('auth/register', 'id="regis-form"') ?>

          <?= form_error('nama_lengkap', '<small class="text-danger error">', '</small>') ?>
          <div class="input-group mb-3">
               <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap">
               <div class="input-group-append">
                    <div class="input-group-text">
                         <span class="fas fa-address-book"></span>
                    </div>
               </div>
          </div>
    
          <?= form_error('username', '<small class="text-danger error">', '</small>') ?>
          <div class="input-group mb-3">
               <input type="text" class="form-control" name="username" id="username" placeholder="Username">
               <div class="input-group-append">
                    <div class="input-group-text">
                         <span class="fas fa-user"></span>
                    </div>
               </div>
          </div>
    
          <?= form_error('email', '<small class="text-danger error">', '</small>') ?>
          <div class="input-group mb-3">
               <input type="email" class="form-control" name="email" id="email" placeholder="Email">
               <div class="input-group-append">
                    <div class="input-group-text">
                         <span class="fas fa-at"></span>
                    </div>
               </div>
          </div>
    
          <div class="row">

               <div class="col-8">
                    <div class="icheck-primary">
                         <input type="checkbox" id="spr" name="spr">
                         <label for="spr">Lihat Password</label>
                    </div>
               </div>

               <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-regis btn-block">Register</button>
               </div>

          </div>

     <?= form_close() ?>

     <p class="mt-3 text-capitalize">
          sudah memiliki akun ?
          <a href="<?= base_url('auth') ?>" class="btn btn-sm btn-link">
               Login Disini
          </a>
     </p>