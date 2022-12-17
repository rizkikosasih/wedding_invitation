<?php
     if( !isset($this_data) ){
          error_reporting(E_ERROR | E_PARSE);
     }
     $attr = [ 
          'id' => 'formData' 
     ];
?>

<?= form_open("$url/$action", $attr) ?>

<div class="modal-body">
     
     <input type="hidden" class="form-control" id="id" name="id" value="<?= $this_data->id ?>" required>

     <div class="form-group">
          <label>Nama Grup</label>
          <input type="text" class="form-control" id="nama_grup" name="nama_grup" value="<?= $this_data->nama_grup ?>" placeholder="Masukan Nama Grup" required>
     </div>

     <div class="form-group">
          <label>Deskripsi</label>
          <textarea name="deskripsi" id="" cols="5" rows="10" class="form-control" placeholder="Masukan Deskripsi Grup" required><?= $this_data->deskripsi ?></textarea>
     </div>
     
</div>

<div class="modal-footer">
     <div class="text-center">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="Submit" class="btn btn-success">Submit</button>
     </div>
</div>
      
<?= form_close() ?>