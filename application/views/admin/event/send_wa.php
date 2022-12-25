<div class="row m-1 p-1">
     <div class="col-6">
          <form 
               class="form form-vertical update_template_wa" 
               method="post" 
               data-href="<?= base_url('admin/event/update_template_wa') ?>" 
               action="javascript:void(0)"
          >
               <input type="hidden" name="id" value="<?= encode64($e->id) ?>">
               <div class="row">
                    <div class="col-12 template-wa">
                         <div class="form-group">
                              <label for="name">Template Pesan WA</label>
                              <textarea 
                                   class="form-control" 
                                   id="template_wa" 
                                   name="template_wa" 
                                   placeholder="Template Pesan WA Tambahkan \r\n untuk baris baru..." 
                                   rows="10"
                              ><?= html_entity_decode($e->template_wa) ?></textarea>
                         </div>
                    </div>
                    <div class="col-12 d-flex gap-3">
                         <button type="submit" class="btn btn-primary btn-block">
                              <i class="fas fa-save"></i><span class="ml-1">Save</span>
                         </button>
                    </div>
               </div>
          </form>
     </div>
     <div class="col-6">
          <form 
               action="javascript:void(0)" 
               data-href="<?= base_url('admin/event/send_wa') ?>" 
               method="post"
               class="form form-vertical send_wa"
          >
               <input type="hidden" name="id" value="<?= encode64($e->id) ?>">
               <div class="row">
                    <div class="col-12 nomor-tujuan">
                         <div class="form-group">
                              <label for="name">Nomor Tujuan</label>
                              <input class="form-control" id="nomor_tujuan" name="nomor_tujuan" placeholder="Masukan Nomor Tujuan, Contoh: 85887183001" required>
                         </div>
                    </div>
                    <div class="col-12 nama-penerima">
                         <div class="form-group">
                              <label for="name">Nama Penerima</label>
                              <input class="form-control" id="nama_penerima" name="nama_penerima" placeholder="Masukan Nama Penerima Undangan" required>
                         </div>
                    </div>
                    <div class="col-12 d-flex gap-3">
                         <button type="submit" class="btn btn-primary btn-block">
                              <i class="far fa-whatsapp"></i><span class="ml-1">Send WA</span>
                         </button>
                    </div>
               </div>
          </form>
     </div>
</div>

<!-- <a href="<?= "https://api.whatsapp.com/send?phone=$number&text=$message" ?>" target="_blank" title="click to open whatsapp chat">
     <button class="btn btn-success">
          <i class="fa fa-whatsapp"></i> Chat Now
     </button>
</a> -->