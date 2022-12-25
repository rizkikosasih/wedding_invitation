<div class="m-1 p-1">
     <div class="row my-3">
          <div class="col-8 d-flex gap-3 flex-wrap">
          </div>
          <div class="col-4 d-flex flex-wrap gap-3 justify-content-end">
               <a href="javascript:void(0)" class='btn btn-sm btn-success ml-auto mr-2 title reloadTable' title='Refresh Tables'>
                    <i class="fas fa-sync"></i>
               </a>
          </div>
     </div>

     <table id="<?= $rname ?>" class="table table-sm table-bordered table-striped" data-url="<?= base_url("$url/wishes/" . encode64($e->id)) ?>">
          <!-- tampilan tabel header -->
          <thead>
               <tr class="text-center text-capitalize">
               <?php
                    $thead = ['no', 'name', 'message', 'date added', 'action'];
                    $jth = count($thead);
                    for( $i = 0; $i< $jth; $i++ ):
               ?>
               <th><?= $thead[$i] ?></th>
               <?php
                    endfor;
               ?>
               </tr>
          </thead>
          <tbody>
          </tbody>
     </table>
</div>