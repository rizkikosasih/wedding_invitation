function numberOnly(evt) {
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57))
		return false;

	return true;
}

function formatRupiah(angka, prefix) {
	var number_string = angka.replace(/[^,\d]/g, '').toString(),
		split = number_string.split(','),
		sisa = split[0].length % 3,
		rupiah = split[0].substr(0, sisa),
		ribuan = split[0].substr(sisa).match(/\d{3}/gi);

	// tambahkan titik jika yang di input sudah menjadi angka satuan ribuan
	if (ribuan) {
		separator = sisa ? '.' : '';
		rupiah += separator + ribuan.join('.');
	}

	rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
	return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}

/* current date YYYY/MM/DD */
const currentDate = new Date();
cDay = currentDate.getDate();
cMonth = currentDate.getMonth() + 1;
cYear = currentDate.getFullYear();
nows = cYear + "/" + cMonth + "/" + cDay;
/* current date YYYY/MM/DD */

function selisih_hari(tgl) {
	oneDay = 24 * 60 * 60 * 1000;
	firstDate = new Date(nows);
	secondDate = new Date(tgl);
	diffDays = Math.round(Math.round((secondDate.getTime() - firstDate.getTime()) / (oneDay)));
	return diffDays;
}

/* sweetalert & toast */
const Toast = Swal.mixin({
	toast: true,
	position: 'top-end',
	showConfirmButton: false,
	timer: 3000
});
/* sweetalert & toast */

const dataTables = $('#dataTables');

const serverSide = $('#serverSide');

const urlServerSide = serverSide.data('url');

const formDataId = $('#formData');

function reloadTables() {
	serverSide.DataTable().ajax.reload();
}

$(function () {

	/* data tables */
	dataTables.DataTable({
		"paging": true,
		"lengthChange": false,
		"searching": true,
		"ordering": true,
		"info": true,
		"autoWidth": false,
		"responsive": true,
		"buttons": ["colvis"]
	}).buttons().container().appendTo('#dataTables_wrapper .col-md-6:eq(0)');

	/* Server Side */
	serverSide.DataTable({
		"processing": true,
		"serverSide": true,
		"order": [],
		"ajax": {
			"url": urlServerSide,
			"type": "POST"
		},
		"columnDefs": [{
			"target": [-1],
			"orderable": false
		}]
	});

	dataTables.on('click', '.aksesMenu', function () {

		const menuId = $(this).data('id');

		const level = $(this).data('level');

		const url = $(this).data('href');

		$.ajax({
			url: url,
			type: 'post',
			data: {
				menu_id: menuId,
				level: level
			},
			success: function (result) {
				if (result == 200) {
					Toast.fire({
						icon: 'success',
						title: 'Akses berhasil ditambahkan !'
					});
				} else if (result == 100) {
					Toast.fire({
						icon: 'success',
						title: 'Akses berhasil dihapus !'
					})
				}
			}
		})

	});

	dataTables.on('click', '.aksesSubMenu', function () {

		const id = $(this).data('id');

		const level = $(this).data('level');

		const url = $(this).data('href');

		$.ajax({
			url: url,
			type: 'post',
			data: {
				id: id,
				level: level
			},
			success: function (result) {
				if (result == 200) {
					Toast.fire({
						icon: 'success',
						title: 'Akses berhasil ditambahkan !'
					});
				} else if (result == 100) {
					Toast.fire({
						icon: 'success',
						title: 'Akses berhasil dihapus !'
					})
				}
			}
		})

	});

	/* tooltip */
	$('.title').tooltip({});
	/* tooltip */

	/* tail select */
	tail.select("#menu_id1", {
		search: true,
		multiple: false,
		width: '100%'
	});

	tail.select("#menu_id2", {
		search: true,
		multiple: false,
		width: '100%'
	});

	tail.select("#sub_menu_id1", {
		search: true,
		multiple: false,
		width: '100%'
	});

	tail.select("#sub_menu_id2", {
		search: true,
		multiple: false,
		width: '100%'
	});

	tail.select("#level", {
		search: true,
		multiple: false,
		width: '100%'
	});
	/* tail select */

	/* jquery mask */
	$("#no_hp").mask('0000-0000-0000', {
		reverse: true
	});

	$(".no_hp").mask('0000-0000-0000', {
		reverse: true
	});

	$("#no_telp").mask('0000-0000-0000', {
		reverse: true
	});

	$(".no_telp").mask('0000-0000-0000', {
		reverse: true
	});

	$("#harga_beli").mask('000.000.000', {
		reverse: true
	});

	$("#harga_jual").mask('000.000.000', {
		reverse: true
	});

	$(".harga_beli").mask('000.000.000', {
		reverse: true
	});

	$(".harga_jual").mask('000.000.000', {
		reverse: true
	});
	/* jquery mask */

	/* datepicker */
	$('#tanggal_lahir').datetimepicker({
		format: 'YYYY-MM-DD',
	});

	$('.tanggal_lahir').datetimepicker({
		format: 'YYYY-MM-DD'
	});

	$('.tanggal').datetimepicker({
		format: 'YYYY-MM-DD'
	});

	$('#awal').datetimepicker({
		format: 'YYYY-MM-DD'
	});

	$('#akhir').datetimepicker({
		format: 'YYYY-MM-DD'
	});
	/* datepicker */

	/* Cek Tanggal Acara */
	const tgl = $('.tanggal');

	if (tgl.val() == '') {
		if ($('button').hasClass('btn-update')) {
			$('.btn-update').attr('disabled', 'disabled');
		}
	}

	tgl.focusout(function () {
		if ($('button').hasClass('btn-update')) {
			let newTgl = $(this).val();
			if (newTgl == '') {
				$('.btn-update').attr('disabled', 'disabled');
				$('label#tgl_acara_err').html('Tanggal Acara Tidak Boleh Kosong');
				$('label#tgl_acara_err').css('display', 'block');
			} else {
				let nTgl = newTgl.replace('-', '/');
				selisih = selisih_hari(nTgl);
				if (selisih >= 21) {
					$('.btn-update').removeAttr('disabled', 'disabled');
					$('label#tgl_acara_err').css('display', 'none');
				} else {
					$('.btn-update').attr('disabled', 'disabled');
					$('label#tgl_acara_err').html('Tanggal Acara Minimal 21 Hari Dari Sekarang!');
					$('label#tgl_acara_err').css('display', 'block');
				}
			}
		}
	});
	/* Cek Tanggal Acara */

	/* validasi */
	$('form.myForm').validate({});

	$('form#myForm').validate({});
	/* validasi */

	/* types */
	$('#types').change(function () {
		if ($(this).val() == 'Y') {
			$('#img-hal').css('display', 'block');
			$('#txt-hal').css('display', 'none');
		} else {
			$('#img-hal').css('display', 'none');
			$('#txt-hal').css('display', 'block');
		}
	});

	$('.types').change(function () {
		if ($(this).val() == 'Y') {
			$('.img-hal').css('display', 'block');
			$('.txt-hal').css('display', 'none');
		} else {
			$('.img-hal').css('display', 'none');
			$('.txt-hal').css('display', 'block');
		}
	});

	$('#c-0').click(function () {
		$('#img-hal').css('display', 'block');
		$('#txt-hal').css('display', 'none');
	});

	$('#c-1').click(function () {
		$('#img-hal').css('display', 'none');
		$('#txt-hal').css('display', 'block');
	});

	$('.c-0').click(function () {
		$('.img-hal').css('display', 'block');
		$('.txt-hal').css('display', 'none');
	});

	$('.c-1').click(function () {
		$('.img-hal').css('display', 'none');
		$('.txt-hal').css('display', 'block');
	});

	$('.jenis_paket').click(function () {
		let jenis = $(this).val();
		if (jenis == 1) {
			$('#menu').css('display', 'block');
		} else {
			$('#menu').css('display', 'none');
		}
	});

	$('.jenis-paket').click(function () {
		let jenis = $(this).val();
		if (jenis == 1) {
			$('.menu').css('display', 'block');
		} else {
			$('.menu').css('display', 'none');
		}
	});
	/* types */

	/* server side form validation */
	$('form#formData').validate({
		submitHandler: function (form) {
			$.ajax({

				url: form.action,
				type: form.method,
				data: $(form).serialize(),
				success: function (result) {
					if (result.status == 'sukses') {
						$(form)[0].reset();
						$('.modal').modal('hide');
						reloadTables();
						Swal.fire({
							icon: 'success',
							title: result.status,
							text: result.message,
							// width: '50%',
							showConfirmButton: false,
							timer: 3000
						});
					} else {
						$(form)[0].reset();
						$('.modal').modal('hide');
						reloadTables();
						Swal.fire({
							icon: 'error',
							title: result.status,
							text: result.message,
							// width: '50%',
							showConfirmButton: false,
							timer: 3000
						});
					}
				}

			});
		}
	});

	$('form.formData').validate({
		submitHandler: function (form) {
			$.ajax({

				url: form.action,
				type: form.method,
				data: $(form).serialize(),
				success: function (result) {
					if (result.status == 'sukses') {
						// $(form)[0].reset();
						$('.modal').modal('hide');
						reloadTables();
						Swal.fire({
							icon: 'success',
							title: result.status,
							text: result.message,
							// width: '50%',
							showConfirmButton: false,
							timer: 3000
						});
					} else {
						// $(form)[0].reset();
						$('.modal').modal('hide');
						reloadTables();
						Swal.fire({
							icon: 'error',
							title: result.status,
							text: result.message,
							// width: '50%',
							showConfirmButton: false,
							timer: 3000
						});
					}
				}

			});
		}
	});
	/* server side form validation */

});

/* Isotope */
$(function () {
	// event click filter
	$('.group-paket .filter-button-group').on('click', 'button', function () {
		$(this).addClass("active").siblings().removeClass("active");
		let filterValue = $(this).attr("data-filter");
		$grids.isotope({
			filter: filterValue,
		});
	});
	//tampilkan list paket yang diclick
	let $grids = $(".ls-paket").isotope({
		itemSelector: ".list-paket",
	});
});
/* Isotope */

/* custom file input */
$(function () {
	// input plugin
	bsCustomFileInput.init();

	// get file and preview image
	$("#foto").on("change", function () {
		var input = $(this)[0];
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$("#preview").attr("src", e.target.result).fadeIn("slow");
			};
			reader.readAsDataURL(input.files[0]);
		}
	});

	$("#foto-produk").on("change", function () {
		var input = $(this)[0];
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$("#preview-pro").attr("src", e.target.result).fadeIn("slow");
			};
			reader.readAsDataURL(input.files[0]);
		}
	});

	$(".foto-produk").on("change", function () {
		var input = $(this)[0];
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$(".preview-pro").attr("src", e.target.result).fadeIn("slow");
			};
			reader.readAsDataURL(input.files[0]);
		}
	});
});
/* custom file input */

/* Tinymce */
$(function () {
	tinymce.init({
		selector: "textarea#custom",
	});
	tinymce.init({
		selector: "textarea.custom",
	});
});
/* Tinymce */

/* Flash Data */
$(function () {

	let flashData = $('#flash-data').data('flash');

	if (flashData) {

		let pecah = flashData.split('/');

		let status = pecah[0];

		// let aksi = pecah[1];

		if (pecah[2] == '' || pecah[2] == null) {
			pesan = pecah[1];
		} else {
			if (status == 'sukses') {
				pesan = pecah[1] + " Berhasil " + pecah[2];
			} else {
				pesan = pecah[1] + " Gagal " + pecah[2];
			}
		}

		if (status == 'sukses') {
			icon = 'success';
		} else {
			icon = 'error';
		}

		Swal.fire({
			text: pesan,
			icon: icon,
			// width: '35%',
			showConfirmButton: false,
			timer: 3000
		});

	}

	let flashAuth = $('#flash-auth').data('flash');

	if (flashAuth) {

		let pecah = flashAuth.split('/');

		let status = pecah[0];

		if (status == 'sukses') {
			icon = 'success';
		} else {
			icon = 'error';
		}

		if (pecah[2] == '' || pecah[2] == null) {
			pesan = pecah[1];
		} else {
			if (status == 'sukses') {
				pesan = pecah[1] + " Berhasil " + pecah[2];
			} else {
				pesan = pecah[1] + " Gagal " + pecah[2];
			}
		}

		Toast.fire({
			title: pesan,
			icon: icon,
			width: '50%'
		});

	}

});
/* Flash Data */

$(function () {

	dataTables.on('click', '.status', function () {
		if ($(this).data('status') != '') {
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
	})

	$(document).on('click', '.status', function () {
		if ($(this).data('status') != '') {
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

	dataTables.on('click', '.status2', function () {
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

	$(document).on('click', '.status2', function () {
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

	$(document).on('click', '.delete', function () {
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

	/* Button plus & minus */
	$('.btn-minus').click(function () {
		let jml_old = Number($('.input-number').val());
		jml_new = Number(jml_old - 1);
		if (jml_new < 100) {
			$('.input-number').val(100);
		} else {
			$('.input-number').val(jml_new);
		}
	});

	$('.btn-plus').click(function () {
		let jml_old = Number($('.input-number').val());
		jml_new = Number(jml_old + 1);
		if (jml_new > 1000) {
			$('.input-number').val(1000);
		} else {
			$('.input-number').val(jml_new);
		}
	});
	/* Button plus & minus */

});

/* Password Hint */
$(function () {

	/* show password */
	$('#show-pwd').click(function () {

		let pwd = $('.pwd-login').attr('type');

		if (pwd === 'password') {

			$('.pwd-login').attr('type', 'text');

		} else {

			$('.pwd-login').attr('type', 'password');

		}
	});

	$('#reset-pwd').click(function () {

		let pw1 = $('.pass').attr('type');
		pw2 = $('.re-pass').attr('type');

		if (pw1 === 'password' && pw2 === 'password') {
			$('.pass').attr('type', 'text');
			$('.re-pass').attr('type', 'text');
		} else {
			$('.pass').attr('type', 'password');
			$('.re-pass').attr('type', 'password');
		}

	});

	$('#spr').click(function () {

		let pwd = $('#password').attr('type');

		if (pwd === 'password') {

			$('#password').attr('type', 'text');

			$('#re_password').attr('type', 'text');

		} else {

			$('#password').attr('type', 'password');

			$('#re_password').attr('type', 'password');

		}
	});

});
/* Password Hint */

$(document).ready(function () {

	/* carousel */
	const carouseL = $(".owl-carousel");

	if ($('div').hasClass('owl-carousel')) {

		$('.customNextBtn').click(function () {
			carouseL.trigger('next.owl.carousel');
		})

		$('.customPrevBtn').click(function () {
			carouseL.trigger('prev.owl.carousel', [300]);
		})

		carouseL.owlCarousel({
			autoWidth: true,
			autoplay: true,
			animateIn: 'shakeX',
			animateOut: 'shakeY',
			dots: true,
			loop: true,
			margin: 24,
		});
	}
	/* carousel */

	/* LightBox */
	$(document).on('click', '[data-toggle="lightbox"]', function (event) {

		event.preventDefault();

		$(this).ekkoLightbox({

			alwaysShowClose: true

		});

	});

	$(document).on('click', '.lightbox', function (event) {

		event.preventDefault();

		$(this).ekkoLightbox({

			alwaysShowClose: true

		});

	});

	$(document).on('click', '.gallerybox', function (event) {

		event.preventDefault();

		$(this).ekkoLightbox({

			alwaysShowClose: true

		});

	});
	/* LightBox */

});
