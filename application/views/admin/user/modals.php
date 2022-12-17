<?php
if( !isset($this_data) ){
     error_reporting(E_ERROR | E_PARSE);
}

if( $action == "detail_user" ){
     $user = $this_data;
     if($user->tanggal_lahir == '0000-00-00')
     {
          $ttl = "Belum di ubah";
     }
     else
     {
          if( empty($user->tempat_lahir) ){
               $ttl = mediumdate_indo($user->tanggal_lahir);
          }else{
               $ttl = $user->tempat_lahir . ", " . mediumdate_indo($user->tanggal_lahir);
          }
     }

     if ( $user->last_login != '0000-00-00 00:00:00' ) {
          $date_login = date_only($user->last_login);
          $time_login = time_only($user->last_login);
          $last_login = mediumdate_indo($date_login) . "<div>" . $time_login . " WIB</div>";
     } else {
          $last_login = "";
     }

     $grup = grupDet($user->grup_id);
     $nama_grup = $grup->nama_grup;
?>

<div class="modal-body">
     
     <table style="border:0; width:100%; height:auto;">

          <tr>
               <td class="jarak-horizon td-left">
                    Username
               </td>
               <td class="jarak text-center">
                    :
               </td>
               <td>
                    <?= $user->username ?>
               </td>
          </tr>

          <tr>
               <td class="jarak-horizon td-left">
                    Nama Lengkap
               </td>
               <td class="jarak text-center">
                    :
               </td>
               <td>
                    <?= $user->nama ?>
               </td>
          </tr>

          <tr>
               <td class="jarak-horizon td-left">
                    Email
               </td>
               <td class="jarak text-center">
                    :
               </td>
               <td>
                    <?= $user->email ?>
               </td>
          </tr>

          <tr>
               <td class="jarak-horizon td-left">
                    No Handphone
               </td>
               <td class="jarak text-center">
                    :
               </td>
               <td class="telp">
                    <?= $user->no_hp ?>
               </td>
          </tr>

          <tr>
               <td class="jarak-horizon td-left">
                    Alamat
               </td>
               <td class="jarak text-center">
                    :
               </td>
               <td>
                    <?= $user->alamat ?>
               </td>
          </tr>

          <tr>
               <td class="jarak-horizon td-left">
                    Jenis Kelamin
               </td>
               <td class="jarak text-center">
                    :
               </td>
               <td class="text-capitalize">
                    <?= $user->jenis_kelamin ?>
               </td>
          </tr>

          <tr>
               <td class="jarak-horizon td-left">
                    Tempat dan Tanggal Lahir
               </td>
               <td class="jarak text-center">
                    :
               </td>
               <td>
                    <?= $ttl ?>
               </td>
          </tr>

          <tr>
               <td class="jarak-horizon td-left">
                    Grup
               </td>
               <td class="jarak text-center">
                    :
               </td>
               <td>
                    <?= $nama_grup ?>
               </td>
          </tr>

          <?php
               if( !empty($last_login) ):
          ?>
          <tr>
               <td class="jarak-horizon td-left">
                    Terakhir Login
               </td>
               <td class="jarak text-center">
                    :
               </td>
               <td>
                    <?= $last_login ?>
               </td>
          </tr>
          <?php
               endif;
          ?>

     </table>
        
</div>

<div class="modal-footer">
     <div class="text-center">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
     </div>
</div>

<?php
} elseif( $action == "ubah_profile" ) {

     $user = $this_data;

     #src image profile
     $src = empty($user->foto) ? base_url("assets/backend/dist/img/profile/default.png") : base_url("assets/backend/dist/img/profile/$user->foto");

     #default tanggal lahir
     $tanggalLahir = $user->tanggal_lahir == '0000-00-00' ? date('Y-m-d') : $user->tanggal_lahir;
     $ck_1 = $user->jenis_kelamin == 'pria' ? "checked" : "";
     $ck_2 = $user->jenis_kelamin == 'pria' ? "" : "checked";
?>

<?= form_open_multipart("$url/$action", ['id' => 'myForm']); ?>

<div class="modal-body">

     <input type="hidden" name="id" id="id" class="form-control" value="<?= $user->id ?>" readonly>

     <div class="form-group">
          <label>Nama Lengkap</label>
          <input type="text" name="nama" class="form-control" id="nama" value="<?= $user->nama ?>" required>
     </div>

     <div class="form-group">
          <label>Email</label>
          <input type="email" name="email" class="form-control" id="email" value="<?= $user->email ?>" required>
     </div>

     <div class="form-group">
          <label class="d-block">Jenis Kelamin</label>

          <div class="form-check-inline">
               <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="jenis_kelamin" value="pria" <?= $ck_1 ?> required>Pria
               </label>
          </div>

          <div class="form-check-inline">
               <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="jenis_kelamin" value="wanita" <?= $ck_2 ?> required>Wanita
               </label>
          </div>
          
          <label for="jenis_kelamin" class="error" id="jenis_kelamin-error" style="display:none;">Kolom ini diperlukan.</label>
     </div>

     <div class="form-group">
          <label>Tempat Lahir</label>
          <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" value="<?= $user->tempat_lahir ?>" required>
     </div>

     <div class="form-group">
          <label>Tanggal Lahir <br><small>(Tahun-Bulan-Tanggal, Contoh: 2000-12-31)</small></label>
          <input type="text" name="tanggal_lahir" id="tanggal" value="<?= $tanggalLahir ?>" class="form-control datetimepicker-input tanggal_lahir" data-toggle="datetimepicker" data-target="#tanggal_lahir" required>
     </div>

     <div class="form-group">
          <label class="">Alamat</label>
          <textarea type="text" name="alamat" id="alamat" class="form-control custom" rows="5" required><?= $user->alamat ?></textarea>
     </div>

     <div class="form-group">
          <label class="">No HP <br><small>(0812-3456-7890)</small></label>
          <input type="text" name="no_hp" class="form-control" id="no_hp" value="<?= $user->no_hp ?>" required>
     </div>

     <div class="form-group">
          <label>Foto Profile<br><small>*kosongkan jika tidak ingin di ubah</small></label>
          <div class="custom-file">
               <input type="file" class="custom-file-input" name="foto" id="foto">
               <label class="custom-file-label" for="inputGroupFile" aria-describedby="inputGroupFileAddon">Choose image</label>
          </div>
          <div class="border text-center p-3">
               <img src="<?= $src; ?>" class="img-fluid img-rounded img-profile-md" id="preview">
          </div>
     </div>
     
</div>

<div class="modal-footer">
     <div class="text-center">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="Submit" class="btn btn-success">Submit</button>
     </div>
</div>
      
<?= form_close(); ?>

<?php
} elseif ( $action == "add" || $action == "edit" ) {
     $attrU = isset($this_data) ? "readonly" : "required";
     $attr = [ 
          'id' => 'formData' 
     ];
?>

<?= form_open( "$url/$action", $attr); ?>

<div class="modal-body">
     <!-- row -->
     <div class="row">
     
          <!--kiri-->
          <div class="col-sm-6">
          
               <table class="user-form">
               
                    <tr>
                         <td>
                              <div class="form-group">
                                   <label>Username</label>
                                   <input type="text" name="username" id="username" class="form-control" <?= $attrU ?>  value="<?= $this_data->username ?>">
                              </div>
                         </td>
                    </tr>
          
                    <tr>
                         <td>
                              <div class="form-group">
                                   <label>Nama Lengkap</label>
                                   <input type="text" name="nama" class="form-control" id="nama" value="<?= $this_data->nama ?>" required>
                              </div>
                         </td>
                    </tr>
          
                    <tr>
                         <td>
                              <div class="form-group">
                                   <label>Email</label>
                                   <input type="email" name="email" class="form-control email" id="email" value="<?= $this_data->email ?>" required>
                              </div>
                         </td>
                    </tr>
          
                    <tr>
                         <td>
                              <div class="form-group">
                                   <label class="d-block mb-4">Jenis Kelamin</label>
                                   <?php
                                        if( isset($this_data) ){
                                             $ck1 = $this_data->jenis_kelamin == 'pria' ? "checked" : "";
                                             $ck2 = $this_data->jenis_kelamin == 'pria' ? "" : "checked";
                                        }else{
                                             $ck1 = "";
                                             $ck2 = "";
                                        }
                                   ?>
                                   <div class="form-check-inline">
                                        <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="jenis_kelamin" value="pria" <?= $ck1 ?> required>Pria
                                        </label>
                                   </div>
                    
                                   <div class="form-check-inline">
                                        <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="jenis_kelamin" value="wanita" <?= $ck2 ?> required>Wanita
                                        </label>
                                   </div>
                    
                                   <label for="jenis_kelamin" class="error" id="jenis_kelamin-error" style="display:none;">Kolom ini diperlukan.</label>
                    
                              </div>
                         </td>
                    </tr>
                    
                    <tr>
                         <td>
                              <div class="form-group">
                                   <label>Tempat Lahir</label>
                                   <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" value="<?= $this_data->tempat_lahir ?>" required>
                              </div>
                         </td>
                    </tr>
     
               </table>
     
          </div>
          <!--./kiri-->
     
          <!--kanan-->
          <div class="col-sm-6">
     
               <table class="user-form">
               
                    <tr>
                         <td>
                              <div class="form-group">
                                   <label>Tanggal Lahir <small>( Tahun-Bulan-Tanggal, Contoh: 2000-12-31 )</small></label>
                                   <input 
                                        type="text" 
                                        name="tanggal_lahir" 
                                        id="tanggal" 
                                        value="<?= $this_data->tanggal_lahir ?>" 
                                        class="form-control datetimepicker-input tanggal_lahir" data-toggle="datetimepicker" 
                                        data-target="#tanggal_lahir" 
                                        required
                                   >
                              </div>
                         </td>
                    </tr>
     
                    <tr>
                         <td>
                              <div class="form-group">
                                   <label>Grup</label>
                                   <select class="form-control" name="grup_id" id="tail-select" required>
                                   <option value="">Select an option</option>
                                   <?php
                                        foreach($grup as $g):
                                             $selected = $g->id == $this_data->grup_id ? "selected='selected'" : "";
                                             echo "<option $selected value='$g->id'>$g->nama_grup</option>";
                                        endforeach;
                                   ?>
                                   </select>
                    
                                   <label for="grup_id" class="error" id="grup_id-error" style="display:none;">Kolom ini diperlukan.</label>
                              </div>
                         </td>
                    </tr>
     
                    <tr>
                         <td>
                              <div class="form-group">
                                   <label class="">Alamat</label>
                                   <textarea type="text" name="alamat" class="form-control" rows="5" cols="5" required><?= $this_data->alamat ?></textarea>
                              </div>
                         </td>
                    </tr>

                    <tr>
                         <td>
                              <div class="form-group">
                                   <label class="">No HP <small>( 0812-3456-7890 )</small></label>
                                   <input type="text" name="no_hp" class="form-control telp" id="no_hp" value="<?= $this_data->no_hp ?>" required>
                              </div>
                         </td>
                    </tr>
     
               </table>
     
          </div>
          <!--./kanan-->
     
     </div>
     <!-- row -->
</div>


<div class="modal-footer">
     <div class="text-center">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="Submit" class="btn btn-success">Submit</button>
     </div>
</div>

<?= form_close(); ?>

<?php
} else {
     echo emptyModal("Konten Tidak Ditemukan !");
}
?>