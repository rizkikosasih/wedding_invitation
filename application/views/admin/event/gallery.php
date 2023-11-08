<div class="m-1 p-1">
	<div class="row my-3">
		<div class="col-8 d-flex gap-3 flex-wrap">
			<a
				href="javascript:void(0)"
				class="btn btn-sm btn-primary title openPopup"
				data-url="<?= base_url("$url/modal/add_gallery") ?>"
				data-id="-<?= encode64($e->id) ?>"
				data-style="animated slideInDown"
				title="Tambah Data"
			>
				<i class="fas fa-plus"></i> Tambah Data
			</a>
		</div>
		<div class="col-4 d-flex flex-wrap gap-3 justify-content-end">
			<a href="javascript:void(0)" class='btn btn-sm btn-success ml-auto mr-2 title reloadTable' title='Refresh Tables'>
				<i class="fas fa-sync"></i>
			</a>
		</div>
	</div>

	<table id="<?= $rname ?>" class="table table-sm table-bordered table-striped" data-url="<?= base_url("$url/list_gallery/" . encode64($e->id)) ?>">
		<!-- tampilan tabel header -->
		<thead>
			<tr class="text-center text-capitalize">
				<?php
					$thead = ['no', 'images', 'desc', 'active', 'action'];
					$jth = count($thead);
					foreach ($thead as  $th) {
						echo "<th class='align-middle'>$th</th>";
					}
				?>
			</tr>
		</thead>
	</table>
</div>