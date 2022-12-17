/* sweetalert & toast */
const Toast = Swal.mixin({
	toast: true,
	position: 'top-end',
	showConfirmButton: false,
	timer: 3500
});

$(function () {

	let flashData = $('#flash-data').data('flash');

	let pecah = flashData.split('/');

	let status = pecah[0];

	let pesan = pecah[1];

	// let pesan = pecah[2];

	if (flashData) {

		if (status == 'sukses') {

			Toast.fire({
				title: pesan,
				icon: 'success',
				width: '50%'
			});

		} else if (status == 'gagal') {
			Toast.fire({
				title: pesan,
				icon: 'error',
				width: '50%'
			});
		}

	}

});

$(function () {

	/* tooltip */
	$('.title').tooltip({});
	/* tooltip */

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
