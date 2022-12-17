<?php
     #src image profile
     $path = "assets/backend/dist/img/profile/";
     $src = !$user->foto ? base_url($path . "default.png") : base_url($path . $user->foto);
     $ttl = $user->tanggal_lahir == '0000-00-00' ? "Belum diubah" : $user->tempat_lahir . ", " . mediumdate_indo($user->tanggal_lahir);
?>

<!-- Main content -->
<section class="content">
     <div class="container-fluid">
          <div class="row">
               <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                         
                         <div class="card-header">
                              <h5 class="card-title">
                                   <?= $curPage; ?>
                                   &nbsp;
                                   <a 
                                        href="javascript:void(0)" 
                                        class="text-primary title openPopup" 
                                        title="Edit Profile"
                                        data-url="<?= base_url("$url/modal/ubah_profile") ?>" 
                                        data-id="<?=  $user->id; ?>" 
                                        data-style="modal-lg animated slideInDown"
                                   >
                                        <i class="fas fa-edit fa-sm"></i> 
                                   </a>
                              </h5>
                         </div>

                         <div class="card-body">

                              <div class="card-text">
                                   <table style="border:0px;" class="pl-0">
                                        <tr>
                                             <td class="td-left">Nama Lengkap</td>
                                             <td class="jarak text-center">:</td>
                                             <td><?= $user->nama; ?></td>
                                        </tr>
                                        <tr>
                                             <td class="td-left">Jenis Kelamin</td>
                                             <td class="jarak text-center">:</td>
                                             <td class="text-capitalize"><?= $user->jenis_kelamin; ?></td>
                                        </tr>
                                        <tr>
                                             <td class="td-left">Tempat, Tanggal Lahir</td>
                                             <td class="jarak text-center">:</td>
                                             <td><?= $ttl; ?></td>
                                        </tr>
                                        <tr>
                                             <td class="td-left">Email</td>
                                             <td class="jarak text-center">:</td>
                                             <td><?= $user->email; ?></td>
                                        </tr>
                                        <tr>
                                             <td class="td-left">No. Handphone</td>
                                             <td class="jarak text-center">:</td>
                                             <td class="no_hp"><?= $user->no_hp; ?></td>
                                        </tr>
                                        <tr>
                                             <td class="td-left">Alamat</td>
                                             <td class="jarak text-center">:</td>
                                             <td><?= $user->alamat; ?></td>
                                        </tr>
                                   </table>
                              </div>

                            <p class="card-text"><small class="text-muted">Tanggal Dibuat <?= mediumdate_indo($user->date_created); ?></small></p>
                            
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