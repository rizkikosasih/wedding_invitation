<?php error_reporting(E_ERROR | E_PARSE); ?>

<?= form_open("$url/$action", ['id' => 'formData']) ?>
<?php if (preg_match('/story/i', $action)): ?>
<div class="modal-body">
	<input type="hidden" class="form-control" id="id" name="id" value="<?= $this_story->id ? encode64($this_story->id) : '' ?>" required>
	<input type="hidden" class="form-control" id="event_id" name="event_id" value="<?= encode64($event_id) ?>" required>

	<div class="form-group">
		<label>Title</label>
		<input type="text" class="form-control" id="title" name="title" value="<?= $this_story->title ?>" placeholder="Masukan Nama Grup" required>
	</div>

	<div class="form-group">
		<label>Body</label>
		<textarea name="body" id="" cols="5" rows="10" class="form-control" placeholder="Masukan Isi Story" required><?= html_entity_decode($this_story->body) ?></textarea>
	</div>

	<div class="form-group">
		<label>Sort</label>
		<input type="text" class="form-control isNumber" id="sort" name="sort" value="<?= $this_story->sort ?>" pattern="[0-9]*" maxlength="6" inputmode="numeric" placeholder="Masukan Urutan Tampil Love Story" required>
	</div>

	<div class="form-group">
		<div class="mb-2">Position</div>
		<?php
			$position = ['Left', 'Right'];
			for( $i = 0; $i < count($position); $i++ ):
				$name = $position[$i];
				$checked = $this_story->position == $i ? "checked='checked'" : "";
		?>
		<div class="form-check-inline">
			<label class="form-check-label">
				<input type="radio" class="form-check-input" <?= $checked ?> name="position" value="<?= $i ?>" required><?= $name ?>
			</label>
		</div>
		<?php
			endfor;
		?>
		<label for="position" class="error" id="position-error" style="display:none;">Kolom ini diperlukan.</label>
	</div>
</div>
<?php elseif (preg_match('/gallery/i', $action)): ?>
<div class="modal-body">
	<input type="hidden" class="form-control" id="id" name="id" value="<?= $this_gallery->id ? encode64($this_gallery->id) : '' ?>" required>
	<input type="hidden" class="form-control" id="event_id" name="event_id" value="<?= encode64($event_id) ?>" required>

	<div class="form-group">
		<label for="images">Images</label>
		<div class="custom-file">
			<input type="file" class="custom-file-input images" <?= $this_gallery->id ? '' : 'required' ?> name="images">
			<label class="custom-file-label" for="inputGroupFile" aria-describedby="inputGroupFileAddon">
				Choose image
			</label>
		</div>
		<div class="border text-center p-3">
			<a
				href="<?= $this_gallery->images ? base_url("$dir_img/event/x1920_$this_gallery->images") : base_url("$dir_img/no-image.jpg") ?>"
				class="lightbox"
				data-title="Images"
			>
				<img
					src="<?= $this_gallery->images ? base_url("$dir_img/gallery/x300_$this_gallery->images") : base_url("$dir_img/no-image.jpg") ?>"
					class="img-fluid img-rounded preview-image"
					width="100"
					height="auto"
					alt=""
				>
			</a>
		</div>
		<label id="images-error" class="error" for="images" style="display:none;">Kolom ini diperlukan.</label>
	</div>

	<div class="form-group">
		<label>Description</label>
		<textarea name="description" id="" cols="5" rows="10" class="form-control" placeholder="Masukan Deskripsi Images" required><?= html_entity_decode($this_gallery->description) ?></textarea>
	</div>
</div>
<?php endif; ?>

<div class="modal-footer">
	<div class="text-center">
		<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		<button type="Submit" class="btn btn-success">Submit</button>
	</div>
</div>

<?= form_close() ?>