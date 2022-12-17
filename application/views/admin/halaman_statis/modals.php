<?php
if( !isset($this_data) ){
     error_reporting(E_ERROR | E_PARSE);
}

if( $action == "add" || $action == "edit" ) {
     
     $img = $this_data->isImage == 1 ? base_url($dir_img . $this_data->jenis . "/" . $this_data->isi) : base_url("assets/backend/dist/img/no-image.jpg");
     $text = $this_data->isImage == 0 ? $this_data->isi : "";
     $classImg = $this_data->isImage == 1 ? "d-block" : "d-none";
     $classTxt = $this_data->isImage == 0 ? "d-block" : "d-none";
     $attrS = isset($this_data) ? "readonly" : "required";
     $attr = [ 
          'id' => 'formData' 
     ];
?>

<?= form_open_multipart("$url/$action", $attr) ?>

<div class="modal-body">

     <input type="hidden" name="id" value="<?= $this_data->id ?>">
     
     <div class="form-group">
          <label class="d-block">Jenis</label>
          <?php
               $jj = count($jenis);
               for( $i = 0; $i < $jj; $i++ ):
                    $namaJenis = $jenis[$i] == "b" ? "Back" : "Front";
                    $_ck = $this_data->jenis == $jenis[$i] ? "checked" : "";
          ?>
          <div class="form-check-inline">
               <label class="form-check-label">
                    <input type="radio" id="" class="form-check-input" name="jenis" value="<?= $jenis[$i] ?>" <?= $_ck ?> required><?= $namaJenis ?>
               </label>
          </div>
          <?php
               endfor;
          ?>
          <label for="jenis" class="error" id="jenis-error" style="display:none;">Kolom ini diperlukan.</label>
     </div>

     <div class="form-group">
          <label>Section Halaman</label>
          <input type="text" class="form-control" id="section" name="section" value="<?= $this_data->section ?>" <?= $attrS ?> placeholder="Masukkan Section Halaman">
     </div>

     <div class="form-group">
          <label>Judul Halaman</label>
          <input type="text" class="form-control" id="judul" name="judul" value="<?= $this_data->judul ?>" placeholder="Masukkan Judul Halaman" required>
     </div>

     <div class="form-group">
          <label class="d-block">Tipe Halaman</label>
          <?php
               $jj = count($tipe);
               for( $i = 0; $i < $jj; $i++ ):
                    $nama_tipe = ( $tipe[$i] == 1 ) ? "Images" : "Text";
                    $checked = $this_data->isImage == $tipe[$i] ? "checked='checked'" : "";
          ?>
          <div class="form-check-inline">
               <label class="form-check-label">
                    <input type="radio" id="c-<?= $i ?>" class="form-check-input image-check" <?= $checked ?> name="isImage" value="<?= $tipe[$i] ?>" required><?= $nama_tipe ?>
               </label>
          </div>
          <?php
               endfor;
          ?>
          <label for="image" class="error" id="image-error" style="display:none;">Kolom ini diperlukan.</label>
     </div>

     <div class="form-group <?= $classImg ?>" id="img-hal">
          <label for="foto_profile">Image Halaman</label>
          <div class="custom-file">
               <input type="file" class="custom-file-input" name="foto" id="foto-produk">
               <label class="custom-file-label" for="inputGroupFile" aria-describedby="inputGroupFileAddon">Choose image</label>
          </div>
          <div class="border text-center p-3">
               <img src="<?= $img ?>" class="img-rounded" width="240" height="auto" id="preview-pro">
          </div>
     </div>

     <div class="form-group <?= $classTxt ?>" id="txt-hal">
          <label for="">Isi Halaman</label>
          <textarea class="form-control isi-hal custom" name="isi" required><?= $text ?></textarea>
     </div>

</div>

<div class="modal-footer">
     <div class="text-center">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="Submit" class="btn btn-success">Submit</button>
     </div>
</div>

<?= form_close() ?>

<?php
} else {
     echo emptyModal("Konten Tidak Ditemukan !");
}
?>