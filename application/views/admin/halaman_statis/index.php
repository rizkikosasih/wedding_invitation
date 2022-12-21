<!-- Main content -->
<section class="content">
     <div class="container-fluid">
          <div class="row">
               <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                         
                         <div class="card-header">
                              <div class="card-title">
                                   <a 
                                        href="javascript:void(0)" 
                                        class="btn btn-sm btn-primary title openPopup" 
                                        data-url="<?= base_url("$url/modal/add") ?>" 
                                        data-id="" 
                                        data-style="modal-lg animated slideInDown"
                                        title="Tambah Data"
                                   >
                                        <i class="fas fa-plus"></i> Tambah Data
                                   </a>
                              </div>
                              <div class="card-tools">
                                   <a href="javascript:void(0)" class='btn btn-sm btn-success ml-auto mr-2 title reloadTable' title="Reload Table">
                                        <i class="fas fa-sync"></i>
                                   </a>
                              </div>
                         </div>

                         <div class="card-body">
                              <table id="server_side" class="table table-sm table-bordered table-striped" data-url="<?= base_url("$url/allData") ?>">
                              <!-- tampilan tabel header -->
                                   <thead>
                                        <tr class="text-center">
                                             <?php
                                                  $jth = count($thead);
                                                  for( $i = 0; $i< $jth; $i++ ):
                                             ?>
                                             <th><?= $thead[$i] ?></th>
                                             <?php
                                                  endfor;
                                             ?>
                                        </tr>
                                   </thead>
                                   <!-- tampilan tabel body -->
                                   <tbody>
                                   </tbody>
                              </table>
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