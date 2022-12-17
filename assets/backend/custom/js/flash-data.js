$(function () {
	let dataTables = $('#dataTables');

	dataTables.on('click', '.status', function () {
		if ($(this).data('status') == 'Y' || $(this).data('status') == 'N') {
			Swal.fire({
				title: $(this).data('message'),
				icon: "warning",
				showConfirmButton: true,
				showCancelButton: true,
				confirmButtonText: "Ya",
				cancelButtonText: "Tidak"
			}).then((result) => {
				if (result.isConfirmed) {
					window.location.href = $(this).data('url');
				}
			});
		}
	});

	dataTables.on('click', '.delete', function () {
		Swal.fire({
			title: $(this).data('message'),
			icon: "warning",
			showConfirmButton: true,
			showCancelButton: true,
			confirmButtonText: "Ya",
			cancelButtonText: "Tidak"
		}).then((result) => {
			if (result.isConfirmed) {
				window.location.href = $(this).data('url');
			}
		});
	});

});
