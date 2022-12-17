<?php
if( !isset($this_data) ){
     error_reporting(E_ERROR | E_PARSE);
}

if( $action == "add" || $action == "edit" ) {
     $attr = [ 
          'id' => 'formData' 
     ];
?>

<?= form_open("$url/$action", $attr) ?>

<div class="modal-body">

     <input type="hidden" name="id" value="<?= $this_data->id ?>">
     
     <div class="form-group">
          <label>Nama Depan</label>
          <input type="text" class="form-control required" id="nama_depan" name="nama_depan" value="<?= $this_data->nama_depan ?>" placeholder="Masukan Nama Depan" required>
     </div>

     <div class="form-group">
          <label class="">Nama Belakang</label>
          <input type="text" class="form-control required" id="nama_belakang" name="nama_belakang"value="<?= $this_data->nama_belakang ?>" placeholder="Masukan Nama Belakang" required>
     </div>

     <div class="form-group">
          <label>Alamat</label>
          <textarea class="form-control required custom" id="alamat" name="alamat" placeholder="Masukan Alamat" required><?= $this_data->alamat ?></textarea>
     </div>

     <div class="form-group">
          <label>No Handphone</label>
          <input type="text" id='telp' class="form-control required" onkeypress="return isNumber(event)" name="no_hp" value="<?= $this_data->no_hp ?>" placeholder="Masukan No Handphone" required>
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
} else {
     echo emptyModal("Konten Tidak Ditemukan !");
}
?>