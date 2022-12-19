<!-- Main content -->
<section class="content">
     <div class="container-fluid">
          <div class="row">
               <div class="col-lg-6">
                    <div class="card card-primary card-outline">
                         
                         <div class="card-header animated slideInUp" data-wow-duration="2s">
                              <h5 class="card-title">
                                   Form Ubah Password
                              </h5>
                         </div>

                         <div class="card-body">

                              <?= form_open('admin/user/ubah_password',['id' => 'myForm']); ?>

                                   <div class="form-group animated slideInDown">
                                        <label>Password Lama</label>
                                        <input type="password" name="password_lama" id="password_lama" class="form-control" placeholder="Masukkan Password Lama" value="<?= set_value('password_lama'); ?>" required>
                                        <?= form_error('password_lama', '<small class="text-danger">', '</small>'); ?>
                                   </div>

                                   <div class="form-group animated slideInDown">
                                        <label>Password Baru</label>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan Password Baru" value="<?= set_value('password'); ?>" minlength="3" required>
                                        <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                                   </div>

                                   <div class="form-group animated slideInDown">
                                        <label>Konfirmasi Password Baru</label>
                                        <input type="password" name="re_password" id="re_password" class="form-control" placeholder="Masukkan Konfirmasi Password Baru" value="<?= set_value('re_password'); ?>" minlength="3" required>
                                        <?= form_error('re_password', '<small class="text-danger">', '</small>'); ?>
                                   </div>

                                   <div class="form-group">
                                        <button type="submit" class="btn btn-block bg-maroon">Submit</button>
                                   </div>

                              <?= form_close(); ?>
                         </div>
                         <!-- /. card body -->
                         
                    </div>
               </div>
          </div>
          <!--/. row -->
     </div>
     <!--/. container-fluid -->
</section>
<!-- /.content -->