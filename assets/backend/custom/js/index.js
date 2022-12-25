function isNumber(evt) {
	var charCode = (evt.which) ? evt.which : evt.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57)) return false
	return true
}

function formatRupiah(angka, prefix) {
	var number_string = angka.replace(/[^,\d]/g, '').toString(),
		split = number_string.split(','),
		sisa = split[0].length % 3,
		rupiah = split[0].substr(0, sisa),
		ribuan = split[0].substr(sisa).match(/\d{3}/gi)

	// tambahkan titik jika yang di input sudah menjadi angka satuan ribuan
	if (ribuan) {
		separator = sisa ? '.' : ''
		rupiah += separator + ribuan.join('.')
	}

	rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah
	return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '')
}

function reloadTables(v, element) {
	let fullReload = !v ? false : true,
	el = !element ? 'server_side' : ''
	$('table#' + el).DataTable().ajax.reload(null, fullReload)
}
/* current date YYYY/MM/DD */
const currentDate = new Date()
cDay = currentDate.getDate()
cMonth = currentDate.getMonth() + 1
cYear = currentDate.getFullYear()
nows = cYear + "/" + cMonth + "/" + cDay
/* current date YYYY/MM/DD */

function selisih_hari(tgl) {
	oneDay = 24 * 60 * 60 * 1000
	firstDate = new Date(nows)
	secondDate = new Date(tgl)
	diffDays = Math.round(Math.round((secondDate.getTime() - firstDate.getTime()) / (oneDay)))
	return diffDays
}

let siteUrl = (url='') => {
	let index = window.location.origin.match(/localhost/i) ? 1 : 0,
		delimiter = index ? '/' : '',
		origin = window.location.origin + delimiter,
		pathname = window.location.pathname.split('/')[index],
		lastUrl = !url ? '' : '/' + url
	return origin + pathname + lastUrl
}

(function (window, document, $) {
	"use strict"

	/* sweetalert & toast */
	const Toast = Swal.mixin({
		toast: true,
		position: 'top-end',
		showConfirmButton: false,
		timer: 4000
	})
	/* sweetalert & toast */

	const dataTables = $('#dataTables'),
	$modal = $('#myModal'),
	sendWhatsapp = '.send-wa'

	/* TinyMCE */
	$(function () {
		tinymce.EditorManager.editors = []
		tinymce.init({
			selector: "textarea.custom",
			height: 300,
			setup: function (editor) {
				editor.on('change', function () {
					editor.save()
				})
			},
		})
		tinymce.init({
			selector: "textarea#custom",
			height: 300,
			setup: function (editor) {
				editor.on('change', function () {
					editor.save()
				})
			},
		})
		tinymce.init({
			selector: 'textarea.desc',
			height: 150,
			setup: function (editor) {
				editor.on('change', function () {
					editor.save()
				})
			}
		})
	})

	/* datepicker */
	$(function () {
		$('#reception_date').datetimepicker({
			format: 'YYYY-MM-DD',
			locale: 'id',
		})

		$('#wedding_date').datetimepicker({
			format: 'YYYY-MM-DD',
			locale: 'id',
		})

		$('#reception_time').datetimepicker({
			format: 'hh:mm A',
		})

		$('#wedding_time').datetimepicker({
			format: 'hh:mm A',
		})
	})

	/* Global */
	$(function () {
		/* validasi */
		$('form.myForm').validate({})
		$('form#myForm').validate({})

		/* server side datatables */
		$(document).on('click', '.list-event .nav-link', function () {
			let $this = $(this),
			id = $this.attr('aria-controls'),
			card = $this.parents('.card'),
			sTable = card.find('table#' + id)
			if (sTable.length) {
				if (!card.find('#' + id + '_wrapper').length) {
					sTable.DataTable({
						"autoWidth": false,
						"pageLength": 10,
						"responsive": true,
						"processing": true,
						"serverSide": true,
						"order": [],
						"language": {
							"processing": (`
						<div class="spinner-loader">
							<img src="${siteUrl('assets/public/images/loader.gif')}" width="25px" height="25px">
							<div class="mt-1 font-small-1">Loading...</div>
						</div>
					`)
						},
						"ajax": {
							"url": sTable.data('url'),
							"type": "post"
						},
						"columnDefs": [{
							"target": [-1],
							"orderable": false
						}]
					})
				} else {
					reloadTables(null, id)
				}
			}
		})

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
		}).buttons().container().appendTo('#dataTables_wrapper .col-md-6:eq(0)')

		/* Status & Delete */
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
						window.location.href = $(this).data('url')
					}
				})
			}
		})

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
					window.location.href = $(this).data('url')
				}
			})
		})

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
					window.location.href = $(this).data('url')
				}
			})
		})

		/* open modal */
		$(document).on('click', '.openPopup', function () {
			let id, url, title
			id = $(this).data('id') || ''
			url = !id ? $(this).data('url') : $(this).data('url') + '/' + id
			title = $(this).data('original-title') != null ? $(this).data('original-title') : $(this).attr('title')
			$modal.find('.modal-title').html(title)
			$modal.find('#modal-dialog').removeClass().addClass('modal-dialog ' + $(this).data('style'))

			//load modal with ajax
			$.ajax({
				cache: false,
				method: 'post',
				url: url,
				success: function (result) {
					$modal.find('.custom-body').html(result)
				},
			}) //ajax
			.done(function () {
				$modal.modal({
					show: true
				})

				//on hide modal
				$modal.on('hide.bs.modal', function () {
					$(this).find('.custom-body').html('')
				})

				//check number
				$('.isNumber').on('keypress keyup', isNumber)

				// To initialize tooltip with body container
				$(document).tooltip({
					selector: '.title',
					container: 'body'
				})

				/* server side form validation */
				$('form#formData').validate({
					submitHandler: function (form) {
						$.ajax({
							url: form.action,
							method: form.method,
							data: new FormData(form),
							contentType: false,
							processData: false,
							success: function (res) {
								var icon = res.response == 200 ? 'success' : 'error'
								Swal.mixin({
									toast: true,
									position: 'top-end',
									showConfirmButton: false,
									timer: 3000
								}).fire({
									icon: icon,
									title: res.message,
								})
							}
						}) //ajax
						.done(function () {
							$('.modal').modal('hide')
							let $id, $parent = $('.card')
							if ($parent.find('.tab-content').length) {
								$id = $parent.find('.tab-pane.active').find('table.table').attr('id')
							} else {
								$id = $parent.find('table.table').attr('id')
							}
							reloadTables(null, $id)
						})
					}
				})

				$('form.formData').validate({
					submitHandler: function (form) {
						$.ajax({
							url: form.action,
							method: form.method,
							data: new FormData(form),
							contentType: false,
							processData: false,
							success: function (res) {
								$('.modal').modal('hide')
								reloadTables()
								var icon = res.response == 200 ? 'success' : 'error'
								Swal.mixin({
									toast: true,
									position: 'top-end',
									showConfirmButton: false,
									timer: 3000
								}).fire({
									icon: icon,
									title: res.message,
								})
							}
						})
					}
				})

				/* Tinymce */
				$(function () {
					tinymce.EditorManager.editors = []
					tinymce.init({
						selector: "textarea.custom",
						height: 300,
						setup: function (editor) {
							editor.on('change', function () {
								editor.save()
							})
						},
					})
					tinymce.init({
						selector: "textarea#custom",
						height: 300,
						setup: function (editor) {
							editor.on('change', function () {
								editor.save()
							})
						},
					})
				})

				$(function () {
					/* validasi */
					$('form.myForm').validate({})
					$('form#myForm').validate({})

					/* jquery mask */
					$("#telp").mask('0000-0000-0000', {
						reverse: true
					})

					$(".telp").mask('0000-0000-0000', {
						reverse: true
					})

					$("#harga1").mask('000.000.000', {
						reverse: true
					})

					$("#harga2").mask('000.000.000', {
						reverse: true
					})

					$(".harga1").mask('000.000.000', {
						reverse: true
					})

					$(".harga2").mask('000.000.000', {
						reverse: true
					})

					/* tail select */
					tail.select('#tail-select', {
						search: true,
						placeholder: 'Select an option',
						width: '100%',
						multiple: false,
					})

					tail.select('#multi-select', {
						search: true,
						placeholder: 'Select an option',
						width: '100%',
						multiple: true,
						multiContainer: true,
						multiShowCount: false,
						openAbove: null,
						stayOpen: false,
						// startOpen: true,
					})

					tail.select('#tail-select2', {
						search: true,
						placeholder: 'Select an option',
						width: '100%',
						multiple: false,
					})

					tail.select("#level", {
						search: true,
						placeholder: 'Select an option',
						width: '100%',
						multiple: false,
					})

					/* datepicker */
					$('#tanggal').datetimepicker({
						format: 'YYYY-MM-DD'
					})

					$('.tanggal').datetimepicker({
						format: 'YYYY-MM-DD'
					})

					$('#awal').datetimepicker({
						format: 'YYYY-MM-DD'
					})

					$('#akhir').datetimepicker({
						format: 'YYYY-MM-DD'
					})

					/* Halaman Statis */
					$('.image-check').click(function () {
						if ($(this).val() == 1) {
							$('#img-hal').removeClass('d-none')
								.addClass('d-block')
							$('#txt-hal').removeClass('d-block')
								.addClass('d-none')
						} else {
							$('#img-hal').removeClass('d-block')
								.addClass('d-none')
							$('#txt-hal').removeClass('d-none')
								.addClass('d-block')
						}
					})

					/* Menu Tunggal Atau Sub Menu */
					$('.induk').click(function () {
						if ($(this).val() == 1) {
							$('#parent').css('display', 'block')
							$('#parent #tail-select').attr('required', 'required')
						} else {
							$('#parent').css('display', 'none')
							$('#parent #tail-select').removeAttr('required')
						}
					})

					/* akses menu & sub menu */
					$('.aksesMenu').on('click', function () {
						$.ajax({
							method: 'post',
							data: {
								menu_id: $(this).data('menu_id'),
								grup_id: $(this).data('grup_id')
							},
							url: $(this).data('url'),
							success: function (result) {
								if (result.response === 200) {
									$('#akses-msg').html(`
											<div class="alert alert-success" role="alert">
												<span class="font-weight-bold">${result.message}</span>
												<a href="javascript:" class="float-right" data-dismiss="alert" aria-label="Close">
													<i class="fas fa-times text-white" aria-hidden="true"></i>
												</a>
											</div>
										`)
								} else {
									$('#akses-msg').html(`
											<div class="alert alert-danger" role="alert">
												<span class="font-weight-bold">Database error !</span>
												<a href="javascript:" class="float-right" data-dismiss="alert" aria-label="Close">
													<i class="fas fa-times text-white" aria-hidden="true"></i>
												</a>
											</div>
										`)
								}
							}
						})
					})

				})

				$(function () {
					// input plugin
					bsCustomFileInput.init()

					$(".images").on("change", function () {
						var input = $(this)[0],
							previewImage = $(this).parent().next().find('.preview-image')
						if (input.files && input.files[0]) {
							var reader = new FileReader()
							reader.onload = function (e) {
								previewImage.attr("src", e.target.result).fadeIn("slow")
							}
							reader.readAsDataURL(input.files[0])
						}
					})
				})
			}) //done function
		})

		// To initialize tooltip with body container
		$(document).tooltip({
			selector: '.title',
			container: 'body'
		})

		//reload datatables
		$(document).on('click', '.reloadTable', function () {
			let $id, $parent = $(this).parents('.card')
			if ($parent.find('.tab-content').length) {
				$id = $parent.find('.tab-pane.active').find('table.table').attr('id')
			} else {
				$id = $parent.find('table.table').attr('id')
			}
			reloadTables(null, $id)
		})

		/* LightBox */
		$(document).on('click', '[data-toggle="lightbox"]', function (event) {
			event.preventDefault()
			$(this).ekkoLightbox({
				alwaysShowClose: true
			})
		})

		$(document).on('click', '.lightbox', function (event) {
			event.preventDefault()
			$(this).ekkoLightbox({
				alwaysShowClose: true
			})
		})

		$(document).on('click', '.gallerybox', function (event) {
			event.preventDefault()
			$(this).ekkoLightbox({
				alwaysShowClose: true
			})
		})

		/* WOW */
		const wow = new WOW({
			boxClass: 'wow', // default
			animateClass: 'animated', // default
			offset: 0, // default
			mobile: true, // default
			live: true // default
		})
		wow.init()

	})

	/* custom file input */
	$(function () {
		// input plugin
		bsCustomFileInput.init()

		// get file and preview image
		$("#foto").on("change", function () {
			var input = $(this)[0]
			if (input.files && input.files[0]) {
				var reader = new FileReader()
				reader.onload = function (e) {
					$("#preview").attr("src", e.target.result).fadeIn("slow")
				}
				reader.readAsDataURL(input.files[0])
			}
		})

		$("#foto-produk").on("change", function () {
			var input = $(this)[0]
			if (input.files && input.files[0]) {
				var reader = new FileReader()
				reader.onload = function (e) {
					$("#preview-pro").attr("src", e.target.result).fadeIn("slow")
				}
				reader.readAsDataURL(input.files[0])
			}
		})

		$(".foto-produk").on("change", function () {
			var input = $(this)[0]
			if (input.files && input.files[0]) {
				var reader = new FileReader()
				reader.onload = function (e) {
					$(".preview-pro").attr("src", e.target.result).fadeIn("slow")
				}
				reader.readAsDataURL(input.files[0])
			}
		})

		$(".images").on("change", function () {
			var input = $(this)[0],
			previewImage = $(this).parent().next().find('.preview-image')
			if (input.files && input.files[0]) {
				var reader = new FileReader()
				reader.onload = function (e) {
					previewImage.attr("src", e.target.result).fadeIn("slow")
				}
				reader.readAsDataURL(input.files[0])
			}
		})
	})
	/* custom file input */

	/* Flash Data */
	$(function () {
		const flashData = $('#flash-data').data('flash')
		if (flashData) {
			let pecah = flashData.split('/')
			let status = pecah[0]
			let jml = pecah.length
			if (jml < 3) {
				var pesan = pecah[1]
			} else {
				if (status == 'sukses') {
					var pesan = pecah[1] + " Berhasil " + pecah[2]
				} else {
					var pesan = pecah[1] + " Gagal " + pecah[2]
				}
			}
			if (status == 'sukses') {
				var icon = 'success'
			} else {
				var icon = 'error'
			}
			Toast.fire({
				icon: icon,
				title: pesan,
			})
		}
	})
	/* Flash Data */

	/* Password Hint */
	$(function () {
		/* show password */
		$('#show-pwd').click(function () {
			let pwd = $('.pwd-login')
			if (pwd.attr('type') === 'password') {
				pwd.attr('type', 'text')
			} else {
				pwd.attr('type', 'password')
			}
		})

		$('#reset-pwd').click(function () {
			let pw1 = $('.pass')
			pw2 = $('.re-pass')
			if (pw1.attr('type') === 'password' && pw2.attr('type') === 'password') {
				pw1.attr('type', 'text')
				pw2.attr('type', 'text')
			} else {
				pw1.attr('type', 'password')
				pw2.attr('type', 'password')
			}
		})

		$('#spr').click(function () {
			let pwd = $('#password'),
			repwd = $('#re_password')
			if (pwd.attr('type') === 'password') {
				pwd.attr('type', 'text')
				repwd.attr('type', 'text')
			} else {
				pwd.attr('type', 'password')
				repwd.attr('type', 'password')
			}
		})
	})
	/* Password Hint */

	/* switch theme */
	$('#switch-theme').click(function () {
		let tema = $(this).attr('data-tema')
		$.ajax({
			url: $(this).data('href'),
			type: 'post',
			data: {
				tema: tema,
			},
			success: function (res) {
				$('body').removeClass(tema)
					.addClass(res.new_theme)

				$('aside#main-sidebar').removeClass('sidebar-dark-navy sidebar-light-navy')
					.addClass(res.sidebar)

				$('#switch-theme').attr('data-tema', res.new_theme)

				if (res.new_theme == 'dark-mode') {
					$('#switch-theme').attr('checked', 'checked');
				} else {
					$('#switch-theme').removeAttr('checked');
				}
			}
		}) //end ajax
	})
	/* switch theme */

	//on load document
	$(function () {
		$(window).on('load', function () {
			if( $('input#username').length ) {
				$('input#username').focus()
			}
		})
	})

	/* validate update event */
	$(function () {
		let selectBank = tail.select('.bank', {
			classNames: 'select-bank',
			search: true,
			placeholder: 'Select an option',
			width: '100%',
			multiple: false,
		})

		$('form.update_event').validate({
			submitHandler: function (form) {
				let $this = $(form), bankVal = selectBank.options.selected[0].value
				if (!bankVal) {
					$('#bank_id-error').show().html('Kolom ini diperlukan').prev().focus()
				} else {
					$.ajax({
						url: $this.data('href'),
						method: form.method,
						data: new FormData(form),
						contentType: false,
						processData: false,
						success: function (res) {
							let icon = res.response == 200 ? 'success' : 'error'
							Swal.mixin({
								toast: true,
								position: 'top-end',
								showConfirmButton: false,
								timer: 3000
							}).fire({
								icon: icon,
								title: res.message,
							})
							setTimeout( () => {
								location.reload()
							}, 1000)
						}
					})
				}
			}
		})
	})

	/* validate update template wa */
	$(function () {
		$('form.update_template_wa').validate({
			submitHandler: function (form) {
				let $this = $(form)
				$.ajax({
					url: $this.data('href'),
					method: form.method,
					data: new FormData(form),
					contentType: false,
					processData: false,
					success: function (res) {
						let icon = res.response == 200 ? 'success' : 'error'
						Swal.mixin({
							toast: true,
							position: 'top-end',
							showConfirmButton: false,
							timer: 3000
						}).fire({
							icon: icon,
							title: res.message,
						})
					}
				})
			}
		})
	})

	/* validate send wa */
	$(function () {
		$('form.send_wa').validate({
			submitHandler: function (form) {
				let $this = $(form)
				$.ajax({
					url: $this.data('href'),
					method: form.method,
					data: new FormData(form),
					contentType: false,
					processData: false,
					success: function (res) {
						if (res.response === 200) {
							$this[0].reset()
							window.open(res.url, '_blank')
						} else {
							$this.find('#phone').focus()
							Swal.mixin({
								toast: true,
								position: 'top-end',
								showConfirmButton: false,
								timer: 3000
							}).fire({
								icon: 'error',
								title: res.message,
							})
						}
					}
				})
			}
		})
	})

	/* Send Whatsapp */
	$(function () {
		$(document).on('click', sendWhatsapp, function () {
			let $this = $(this)
			$.ajax({
				cache: false,
				method: 'post',
				url: $this.data('url'),
				data: {
					phone: $this.data('phone'),
					name: $this.data('name'),
					id: $this.data('id')
				},
				success: function (res) {
					if (res.response === 200) {
						reloadTables()
						window.open(res.url, '_blank')
					} else {
						Swal.mixin({
							toast: true,
							position: 'top-end',
							showConfirmButton: false,
							timer: 3000
						}).fire({
							icon: 'error',
							title: res.message,
						})
					}
				}
			})
		})
	})

})(window, document, jQuery)
