<script>

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
					$('.modal').modal('hide')
					reloadTables(1)
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
	/* server side form validation */

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
	/* Tinymce */

	$(function () {

		/* validasi */
		$('form.myForm').validate({})

		$('form#myForm').validate({})
		/* validasi */

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
		/* jquery mask */

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
		/* tail select */

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
		/* datepicker */

		/* Halaman Statis */
		$('.image-check').click(function() {
			if ( $(this).val() == 1 ) {
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
		/* Halaman Statis */

		/* Menu Tunggal Atau Sub Menu */
		$('.induk').click(function () {
               if ( $(this).val() == 1 ) {
                    $('#parent').css('display','block') 
                    $('#parent #tail-select').attr('required','required') 
               } else {
                    $('#parent').css('display','none')
                    $('#parent #tail-select').removeAttr('required') 
               }
          })
		/* Menu Tunggal Atau Sub Menu */

		/* akses menu & sub menu */
		$('.aksesMenu').on('click', function() {
			$.ajax({
				method: 'post',
				data: { 
					menu_id: $(this).data('menu_id'), 
					grup_id: $(this).data('grup_id')
				},
				url: $(this).data('url'),
				success: function(result){
					if ( result.response === 200 ) {
						$('#akses-msg').html(
							`<div class="alert alert-success" role="alert">
								<span class="font-weight-bold">${result.message}</span>
								<a href="javascript:" class="float-right" data-dismiss="alert" aria-label="Close">
									<i class="fas fa-times text-white" aria-hidden="true"></i>
								</a>
							</div>`
						) 
					} else { 
						$('#akses-msg').html(
							`<div class="alert alert-danger" role="alert">
								<span class="font-weight-bold">Database error !</span>
								<a href="javascript:" class="float-right" data-dismiss="alert" aria-label="Close">
									<i class="fas fa-times text-white" aria-hidden="true"></i>
								</a>
							</div>`
						)
					}
				}
			})
		})
		/* akses menu & sub menu */

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
	})
	/* custom file input */

</script>