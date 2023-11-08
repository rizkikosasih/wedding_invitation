<form class="form form-vertical update_event" method="post" data-href="<?= base_url('admin/event/update_event') ?>" action="javascript:void(0)">
	<input type="hidden" name="id" value="<?= encode64($e->id) ?>">
	<div class="row">
		<div class="col-12 event-name">
			<div class="form-group">
				<label for="event_name">Event Name</label>
				<input type="text" class="form-control" name="event_name" id="event_name" value="<?= $e->event_name ?>" placeholder="Event Name" required>
			</div>
		</div>
		<div class="col-6 reception-date">
			<div class="form-group">
				<label for="reception-date">Reception Date</label>
				<input
					type="text"
					class="form-control datetimepicker-input"
					data-toggle="datetimepicker"
					name="reception_date"
					id="reception_date"
					value="<?= checkDates($receptionDate) ?>"
					placeholder="Reception Date"
					required
				>
			</div>
		</div>
		<div class="col-6 wedding-date">
			<div class="form-group">
				<label for="wedding-date">Wedding Date</label>
				<input
					type="text"
					class="form-control datetimepicker-input"
					data-toggle="datetimepicker"
					name="wedding_date"
					id="wedding_date"
					value="<?= checkDates($weddingDate) ?>"
					placeholder="Wedding Date"
					required
				>
			</div>
		</div>
		<div class="col-6 reception-time">
			<div class="form-group">
				<label for="reception-time">Reception Time</label>
				<input
					type="text"
					class="form-control datetimepicker-input"
					data-toggle="datetimepicker"
					name="reception_time"
					id="reception_time"
					value="<?= checkTime($e->reception_date) ?>"
					placeholder="Reception Time"
					required
				>
			</div>
		</div>
		<div class="col-6 wedding-time">
			<div class="form-group">
				<label for="wedding-time">Wedding Time</label>
				<input
					type="text"
					class="form-control datetimepicker-input"
					data-toggle="datetimepicker"
					name="wedding_time"
					id="wedding_time"
					value="<?= checkTime($e->wedding_date) ?>"
					placeholder="Wedding Time"
					required
				>
			</div>
		</div>
		<div class="col-6 reception-location">
			<div class="form-group">
				<label for="reception-location">Reception Location</label>
				<textarea class="form-control reception" id="reception_location" name="reception_location" placeholder="Reception Location" rows="5"><?= html_entity_decode($e->reception_location) ?></textarea>
			</div>
		</div>
		<div class="col-6 wedding-location">
			<div class="form-group">
				<label for="wedding-location">Wedding Location</label>
				<textarea class="form-control wedding" id="wedding_location" name="wedding_location" placeholder="Wedding Location" rows="5"><?= html_entity_decode($e->wedding_location) ?></textarea>
			</div>
		</div>
		<div class="col-6 name-man">
			<div class="form-group">
				<label for="name">Nama (Pria)</label>
				<input
					type="text"
					class="form-control"
					id="name_man"
					name="name_man"
					placeholder="Nama Mempelai Pria"
					value="<?= $e->name_man ?>"
				>
			</div>
		</div>
		<div class="col-6 name-woman">
			<div class="form-group">
				<label for="name">Nama (Wanita)</label>
				<input
					type="text"
					class="form-control"
					id="name_woman"
					name="name_woman"
					placeholder="Nama Mempelai Wanita"
					value="<?= $e->name_woman ?>"
				>
			</div>
		</div>
		<div class="col-6 alias-man">
			<div class="form-group">
				<label for="alias">Nama (Pria)</label>
				<input
					type="text"
					class="form-control"
					id="alias_man"
					name="alias_man"
					placeholder="Nama Panggilan Mempelai Pria"
					value="<?= $e->alias_man ?>"
				>
			</div>
		</div>
		<div class="col-6 alias-woman">
			<div class="form-group">
				<label for="alias">Nama (Wanita)</label>
				<input
					type="text"
					class="form-control"
					id="alias_woman"
					name="alias_woman"
					placeholder="Nama Panggilan Mempelai Wanita"
					value="<?= $e->alias_woman ?>"
				>
			</div>
		</div>
		<div class="col-6 desc-man">
			<div class="form-group">
				<label for="name">Desc (Pria)</label>
				<textarea class="form-control desc" id="desc_man" name="desc_man" placeholder="Desc Mempelai Pria" rows="5"><?= html_entity_decode($e->desc_man) ?></textarea>
			</div>
		</div>
		<div class="col-6 desc-woman">
			<div class="form-group">
				<label for="name">Desc (Wanita)</label>
				<textarea class="form-control desc" id="desc_woman" name="desc_woman" placeholder="Desc Mempelai Wanita" rows="5"><?= html_entity_decode($e->desc_woman) ?></textarea>
			</div>
		</div>
		<div class="col-6 image-man">
			<div class="form-group">
				<label for="name">Image (Pria)</label>
				<div class="custom-file">
					<input type="file" class="custom-file-input images" name="image_man">
					<label class="custom-file-label" for="inputGroupFile" aria-describedby="inputGroupFileAddon">
						Choose image
					</label>
				</div>
				<div class="border text-center p-3">
					<a
						href="<?= $e->image_man ? base_url("$dir_img/profile/x1920_$e->image_man") : base_url("$dir_img/no-image.jpg") ?>"
						class="lightbox"
						data-title="Image (Pria)"
					>
						<img
							src="<?= $e->image_man ? base_url("$dir_img/profile/x300_$e->image_man") : base_url("$dir_img/no-image.jpg") ?>"
							class="img-fluid img-rounded preview-image"
							width="100"
							height="auto"
							alt=""
						>
					</a>
				</div>
				<label id="image_man-error" class="error" for="image_man" style="display:none;">Kolom ini diperlukan.</label>
			</div>
		</div>
		<div class="col-6 image-woman">
			<div class="form-group">
				<label for="image-woman">Image (Wanita)</label>
				<div class="custom-file">
					<input type="file" class="custom-file-input images" name="image_woman">
					<label class="custom-file-label" for="inputGroupFile" aria-describedby="inputGroupFileAddon">
						Choose image
					</label>
				</div>
				<div class="border text-center p-3">
					<a
						href="<?= $e->image_woman ? base_url("$dir_img/profile/x1920_$e->image_woman") : base_url("$dir_img/no-image.jpg") ?>"
						class="lightbox"
						data-title="Image (Wanita)"
					>
						<img
							src="<?= $e->image_woman ? base_url("$dir_img/profile/x300_$e->image_woman") : base_url("$dir_img/no-image.jpg") ?>"
							class="img-fluid img-rounded preview-image"
							width="100"
							height="auto"
							alt=""
						>
					</a>
				</div>
				<label id="image_woman-error" class="error" for="image_woman" style="display:none;">Kolom ini diperlukan.</label>
			</div>
		</div>
		<div class="col-12 wedding-map">
			<div class="form-group">
				<label for="bank">Wedding Map</label>
				<textarea name="wedding_map" class="form-control" id="wedding_map" placeholder="Map Location From Google" rows="5"><?= html_entity_decode($e->wedding_map) ?></textarea>
			</div>
		</div>
		<div class="col-6 select-bank">
			<div class="form-group">
				<label for="bank">Bank For Gift 1</label>
				<select name="bank_id" id="bank" class="form-control" required>
					<option <?= !$e->bank_id ? 'selected="selected"' : '' ?> value="">Select an option</option>
					<?php foreach ($list_bank as $i => $b): ?>
						<option <?= $e->bank_id == $b->id ? 'selected="selected"' : '' ?> value="<?= $b->id ?>"><?= $b->name ?></option>
					<?php endforeach; ?>
				</select>
				<label id="bank_id2-error" class="error" for="bank_id2" style="display: none;">Kolom ini diperlukan.</label>
			</div>
			<div class="form-group">
				<label for="an">Atas Nama 1</label>
				<input
					type="text"
					class="form-control"
					id="atas_nama"
					name="atas_nama"
					placeholder="Atas Nama Rekening 1"
					value="<?= $e->atas_nama ?>"
				>
			</div>
			<div class="form-group">
				<label for="no-rek">No Rekening 1</label>
				<input
					type="text"
					class="form-control"
					id="number_rekening"
					name="number_rekening"
					placeholder="No Rekening 1"
					value="<?= $e->number_rekening ?>"
				>
			</div>
		</div>
		<div class="col-6 select-bank2">
			<div class="form-group">
				<label for="bank">Bank For Gift 2</label>
				<select name="bank_id2" id="bank2" class="form-control" required>
					<option <?= !$e->bank_id2 ? 'selected="selected"' : '' ?> value="">Select an option</option>
					<?php foreach ($list_bank as $i => $b): ?>
						<option <?= $e->bank_id2 == $b->id ? 'selected="selected"' : '' ?> value="<?= $b->id ?>"><?= $b->name ?></option>
					<?php endforeach; ?>
				</select>
				<label id="bank_id-error" class="error" for="bank_id" style="display: none;">Kolom ini diperlukan.</label>
			</div>
			<div class="form-group">
				<label for="an2">Atas Nama 2</label>
				<input
					type="text"
					class="form-control"
					id="atas_nama2"
					name="atas_nama2"
					placeholder="Atas Nama Rekening 2"
					value="<?= $e->atas_nama2 ?>"
				>
			</div>
			<div class="form-group">
				<label for="no-rek2">No Rekening 2</label>
				<input
					type="text"
					class="form-control"
					id="number_rekening2"
					name="number_rekening2"
					placeholder="No Rekening 2"
					value="<?= $e->number_rekening2 ?>"
				>
			</div>
		</div>
		<div class="col-6 cover">
			<div class="form-group ">
				<label for="cover">Cover</label>
				<div class="custom-file">
					<input type="file" class="custom-file-input images" name="cover">
					<label class="custom-file-label" for="inputGroupFile" aria-describedby="inputGroupFileAddon">
						Choose image
					</label>
				</div>
				<div class="border text-center p-3">
					<a
						href="<?= $e->cover ? base_url("$dir_img/event/x1920_$e->cover") : base_url("$dir_img/no-image.jpg") ?>"
						class="lightbox"
						data-title="Cover Image"
					>
						<img
							src="<?= $e->cover ? base_url("$dir_img/event/x300_$e->cover") : base_url("$dir_img/no-image.jpg") ?>"
							class="img-fluid img-rounded preview-image"
							width="100"
							height="auto"
							alt=""
						>
					</a>
				</div>
				<label id="cover-error" class="error" for="cover" style="display:none;">Kolom ini diperlukan.</label>
			</div>
		</div>
		<div class="col-6 cover-mobile">
			<div class="form-group ">
				<label for="cover-mobile">Cover Mobile</label>
				<div class="custom-file">
					<input type="file" class="custom-file-input images" name="cover_mobile">
					<label class="custom-file-label" for="inputGroupFile" aria-describedby="inputGroupFileAddon">
						Choose image
					</label>
				</div>
				<div class="border text-center p-3">
					<a
						href="<?= $e->cover_mobile ? base_url("$dir_img/event/x1920_$e->cover_mobile") : base_url("$dir_img/no-image.jpg") ?>"
						class="lightbox"
						data-title="Cover Image"
					>
						<img
							src="<?= $e->cover_mobile ? base_url("$dir_img/event/x300_$e->cover_mobile") : base_url("$dir_img/no-image.jpg") ?>"
							class="img-fluid img-rounded preview-image"
							width="100"
							height="auto"
							alt=""
						>
					</a>
				</div>
				<label id="cover_mobile-error" class="error" for="cover_mobile" style="display:none;">Kolom ini diperlukan.</label>
			</div>
		</div>
		<div class="col-6 bg-home">
			<div class="form-group">
				<label for="bg-home">Background Home</label>
				<div class="custom-file">
					<input type="file" class="custom-file-input images" name="background_home">
					<label class="custom-file-label" for="inputGroupFile" aria-describedby="inputGroupFileAddon">
						Choose image
					</label>
				</div>
				<div class="border text-center p-3">
					<a
						href="<?= $e->background_home ? base_url("$dir_img/event/x1920_$e->background_home") : base_url("$dir_img/no-image.jpg") ?>"
						class="lightbox"
						data-title="Background Home"
					>
						<img
							src="<?= $e->background_home ? base_url("$dir_img/event/x300_$e->background_home") : base_url("$dir_img/no-image.jpg") ?>"
							class="img-fluid img-rounded preview-image" width="100"
							height="auto"
							alt=""
						>
					</a>
				</div>
				<label id="background_home-error" class="error" for="background_home" style="display:none;">Kolom ini diperlukan.</label>
			</div>
		</div>
		<div class="col-6 bg-home-mobile">
			<div class="form-group">
				<label for="bg-home-mobile">Background Home Mobile</label>
				<div class="custom-file">
					<input type="file" class="custom-file-input images" name="background_home_mobile">
					<label class="custom-file-label" for="inputGroupFile" aria-describedby="inputGroupFileAddon">
						Choose image
					</label>
				</div>
				<div class="border text-center p-3">
					<a
						href="<?= $e->background_home ? base_url("$dir_img/event/x1920_$e->background_home") : base_url("$dir_img/no-image.jpg") ?>"
						class="lightbox"
						data-title="Background Home Mobile"
					>
						<img
							src="<?= $e->background_home_mobile ? base_url("$dir_img/event/x300_$e->background_home_mobile") : base_url("$dir_img/no-image.jpg") ?>"
							class="img-fluid img-rounded preview-image" width="100"
							height="auto"
							alt=""
						>
					</a>
				</div>
				<label id="background_home_mobile-error" class="error" for="background_home_mobile" style="display:none;">Kolom ini diperlukan.</label>
			</div>
		</div>
		<div class="col-6 bg-gallery">
			<div class="form-group ">
				<label for="bg-gallery">Background Gallery</label>
				<div class="custom-file">
					<input type="file" class="custom-file-input images" name="background_gallery">
					<label class="custom-file-label" for="inputGroupFile" aria-describedby="inputGroupFileAddon">
						Choose image
					</label>
				</div>
				<div class="border text-center p-3">
					<a
						href="<?= $e->background_gallery ? base_url("$dir_img/event/x1920_$e->background_gallery") : base_url("$dir_img/no-image.jpg") ?>"
						class="lightbox"
						data-title="Background Gallery"
					>
						<img
							src="<?= $e->background_gallery ? base_url("$dir_img/event/x300_$e->background_gallery") : base_url("$dir_img/no-image.jpg") ?>"
							class="img-fluid img-rounded preview-image"
							width="100"
							height="auto"
							alt=""
						>
					</a>
				</div>
				<label id="background_gallery-error" class="error" for="background_gallery" style="display:none;">Kolom ini diperlukan.</label>
			</div>
		</div>
		<div class="col-6 bg-gallery-mobile">
			<div class="form-group ">
				<label for="bg-gallery-mobile">Background Gallery Mobile</label>
				<div class="custom-file">
					<input type="file" class="custom-file-input images" name="background_gallery_mobile">
					<label class="custom-file-label" for="inputGroupFile" aria-describedby="inputGroupFileAddon">
						Choose image
					</label>
				</div>
				<div class="border text-center p-3">
					<a
						href="<?= $e->background_gallery_mobile ? base_url("$dir_img/event/x1920_$e->background_gallery_mobile") : base_url("$dir_img/no-image.jpg") ?>"
						class="lightbox"
						data-title="Background Gallery"
					>
						<img
							src="<?= $e->background_gallery_mobile ? base_url("$dir_img/event/x300_$e->background_gallery_mobile") : base_url("$dir_img/no-image.jpg") ?>"
							class="img-fluid img-rounded preview-image"
							width="100"
							height="auto"
							alt=""
						>
					</a>
				</div>
				<label id="background_gallery_mobile-error" class="error" for="background_gallery_mobile" style="display:none;">Kolom ini diperlukan.</label>
			</div>
		</div>
		<div class="col-12 d-flex gap-3">
			<button type="submit" class="btn btn-primary btn-block">
				<i class="fas fa-save"></i><span class="ml-1">Save</span>
			</button>
		</div>
	</div>
</form>