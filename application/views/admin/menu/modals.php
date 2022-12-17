<?php
if( !isset($this_data) ){
     error_reporting(E_ERROR | E_PARSE);
}

if ( $action == "add" || $action == "edit" ){ 
     $menu_tunggal = $this_data->induk_id > 0 ? "Tidak" : "Ya";
     $display = isset($this_data) && $this_data->induk_id != 0 ? "block;" : "none;";
     $attr_select = isset($this_data) && $this_data->induk_id != 0 ? "required" : "";
     $attrNM = isset($this_data) ? "readonly" : "required";
     $attr = [ 
          'id' => 'formData' 
     ];
?>

<?= form_open("$url/$action", $attr) ?>

<div class="modal-body">

     <input type="hidden" class="form-control" id="id" name="id" value="<?= $this_data->id ?>" required>

     <div class="form-group">
          <label class="<?php if(!isset($this_data)) echo 'd-block mb-2' ?>">Menu Tunggal</label>
          
          <?php if($this_data): ?>
          
          <input type="text" class="form-control" name="menu_tunggal" id="menu_tunggal" value="<?= $menu_tunggal ?>" readonly>
          
          <?php else: ?>
          
          <div class="form-check form-check-inline">
               <input class="form-check-input induk" name="parent" type="radio" id="induk1" value="0" required>
               <label class="form-check-label" for="induk1">Ya</label>
          </div>

          <div class="form-check form-check-inline">
               <input class="form-check-input induk" name="parent" type="radio" id="induk2" value="1" required>
               <label class="form-check-label" for="induk2">Tidak</label>
          </div>

          <?php endif; ?>
     </div>

     <div class="form-group" id="parent" style="display:<?= $display ?>">
          <label>Induk Menu</label>
          <select class="form-control" name="induk_id" <?= $attr_select ?> id="tail-select">
          <option value="">Select an option</option>
          <?php
               foreach($parent_menu as $pm):
                    $select = $this_data->induk_id == $pm->id ? "selected" : "";
                    echo '<option value="'.$pm->id.'" '.$select.'>'.$pm->nama_menu.'</option>';
               endforeach;
          ?>
          </select>
     </div>

     <div class="form-group">
          <label for="">Nama Menu</label>
          <input type="text" class="form-control" id="nama_menu" name="nama_menu" value="<?= $this_data->nama_menu ?>" placeholder="Masukan Nama Menu">
     </div>


     <div class="form-group">
          <label>Icon Menu</label>
          <input type="text" class="form-control" id="icon" name="icon" value="<?= $this_data->icon ?>" placeholder="Masukkan Icon Menu" required>
     </div>

     <div class="form-group">
          <label>Url Menu</label>
          <input type="text" class="form-control" id="url" name="url" value="<?= $this_data->url ?>" placeholder="Masukkan Url Menu" required>
     </div>

     <div class="form-group">
          <label>Urutan Menu</label>
          <input type="text" class="form-control number" maxlength="3" id="urutan" name="urutan" value="<?= $this_data->urutan ?>" placeholder="Masukkan Urutan Menu" required>
     </div>

     <div class="form-group">
          <label class="d-block">Tipe</label>

          <?php
               for( $i = 0; $i < count($tipe); $i++ ):
                    $nama_tipe = $tipe[$i] == 'b' ? "Backend" : "Frontend";
                    $_ck = $tipe[$i] == $this_data->tipe ? "checked" : "";
          ?>

          <div class="form-check-inline mt-3">
               <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="tipe" value="<?= $tipe[$i] ?>" <?= $_ck ?> required>
                    <?= $nama_tipe ?>
               </label>
          </div>

          <?php
               endfor;
          ?>

          <label for="tipe" class="error" id="tipe-error" style="display:none;">Kolom ini diperlukan.</label>

     </div>

</div>

<div class="modal-footer">
     <div class="text-center">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="Submit" class="btn btn-success">Submit</button>
     </div>
</div>

<?= form_close() ?>

<?php } elseif( $action == "tag_akses" ) { ?>

<div class="modal-body">

     <div id="akses-msg"></div>

     <div class="form-group">
          <label for="">List Akses Menu (<?= $this_data->nama_menu ?>)</label>
          <div class="list-akses bg-gradient-lightblue p-2 rounded-sm">
               <?php
                    foreach($grup as $g):
                         $_ck = array_search($g->id, $list_akses) === false ? '' : 'checked';
                         echo "
                         <div class=\"custom-control custom-checkbox mb-1 ml-0 mt-1 mr-1\" style=\"display:inline-block;\">
                              <input 
                                   type=\"checkbox\" 
                                   class=\"custom-control-input custom-control-input-success aksesMenu\" 
                                   id=\"$g->id\" 
                                   data-url='".base_url("$url/tag_akses")."' 
                                   data-grup_id=\"$g->id\"
                                   data-menu_id=\"$this_data->id\" 
                                   $_ck
                              >
                              <label class=\"custom-control-label\" for=\"$g->id\">$g->nama_grup</label>
                         </div>
                         ";
                    endforeach;
               ?>
          </div>
     </div>

</div>

<div class="modal-footer">
     <div class="text-center">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
     </div>
</div>

<?php
} else {
     echo emptyModal("Konten tidak ditemukan !");
}
?>