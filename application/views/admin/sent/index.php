<!-- Main content -->
<section class="content">
     <div class="container-fluid">
          <div class="row">
               <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                         
                         <div class="card-header">
                              <div class="card-title">
                              </div>
                              <div class="card-tools">
                                   <a href="javascript:void(0)" class='btn btn-sm btn-success ml-auto mr-2 title reloadTable' title="Reload Table">
                                        <i class="fas fa-sync"></i>
                                   </a>
                              </div>
                         </div>

                         <table id="server_side" class="table table-sm table-bordered table-striped" data-url="<?= base_url("$url/allData/") ?>">
                              <!-- tampilan tabel header -->
                              <thead>
                                   <tr class="text-center text-capitalize">
                                   <?php for( $i = 0; $i< count($thead); $i++ ): ?>
                                        <th><?= $thead[$i] ?></th>
                                   <?php endfor; ?>
                                   </tr>
                              </thead>
                              <!-- tampilan tabel body -->
                              <tbody>
                              </tbody>
                         </table>

                    </div>
               </div>
          </div>
          <!--/. row -->
     </div>
     <!--/. container-fluid -->
</section>
<!-- /.content -->