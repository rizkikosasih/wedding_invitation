<div class="row flex-wrap-reverse m-1 p-1">
	<div class="col-12 col-md-6 mt-0">
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
							placeholder="Template Pesan WA Tambahkan \n untuk baris baru..."
							rows="10"
							required
						><?= html_entity_decode(str_replace('%0A', '\n',$e->template_wa)) ?></textarea>
						<label class="text-muted">
							<div class="fw-bold">* Baris Baru Gunakan \n</div>
						</label>
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
	<div class="col-12 col-md-6 mt-0">
		<form
			action="javascript:void(0)"
			data-href="<?= base_url('admin/event/sendWA') ?>"
			method="post"
			class="form form-vertical sendWA"
		>
			<input type="hidden" name="id" value="<?= encode64($e->id) ?>">
			<div class="row">
				<div class="col-12 nomor-tujuan">
					<div class="form-group">
						<label for="name">
							Nomor Tujuan
							<div class="text-muted">Contoh: 085887183001</div>
						</label>
						<input
							class="form-control isNumber"
							id="phone"
							name="phone"
							inputmode="numeric"
							pattern="[0-9]*"
							placeholder="Masukan Nomor Tujuan, Contoh: 85887183001"
							required
						>
					</div>
				</div>
				<div class="col-12 nama-penerima">
					<div class="form-group">
						<label for="name">Nama Penerima</label>
						<input class="form-control" id="name" name="name" placeholder="Masukan Nama Penerima Undangan" required>
					</div>
				</div>
				<div class="col-12 d-flex gap-3">
					<button type="submit" class="btn btn-success btn-block">
						<i class="fa-brands fa-whatsapp"></i><span class="ml-1">Send WA</span>
					</button>
				</div>
			</div>
		</form>
	</div>
</div>