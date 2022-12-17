<!-- Modal Logout -->
<div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-scrollable animated tada" role="document">
          <div class="modal-content">

               <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                    </button>
               </div>

               <div class="modal-body">
                    <p>Pilih 'Logout' jika anda yakin ingin keluar</p>
               </div>

               <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('admin/auth/logout');?>" class="btn btn-success">Logout</a>
               </div>

          </div>
     </div>
</div>
<!-- Modal Logout -->

<!-- myModal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
     <div class="modal-dialog" id="modal-dialog" role="document">
          <div class="modal-content">

               <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                    </button>
               </div>

               <div class="custom-body"></div>

          </div>
     </div>
</div>
<!-- myModal -->