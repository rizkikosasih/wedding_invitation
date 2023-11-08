const siteUrl = (url) => {
	var index = window.location.origin.match(/localhost/i) ? 1 : 0,
		delimiter = index ? '/' : '',
		origin = window.location.origin + delimiter,
		pathname = window.location.pathname.split('/')[index],
		lastUrl = !url ? '' : '/' + url
	return origin + pathname + lastUrl
}

const initialName = (name) => {
	var $initials = name.match(/\b\w/g) || []
	return $initials = (($initials.shift() || '') + ($initials.pop() || '')).toUpperCase()
}

const randColor = () => {
	var stateNum = Math.floor(Math.random() * 6) + 1,
		states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'],
		$state = states[stateNum],
		$colorClass = (`bg-light-${$state}`)
	return $colorClass
}

const randChar = (length = 10) => {
	var result = '', characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',
	charactersLength = characters.length
	for (var i = 0; i < length; i++) {
		result += characters.charAt(Math.floor(Math.random() * charactersLength))
	}
	return result
}

(function ($) {
	"use strict"
	var myAudio = $('#myAudio')[0], musicState = false
	const formComment = $('.form-comment'),
	listComment = $('.list-comment')

	/* sweetalert & toast */
	const Toast = Swal.mixin({
		toast: true,
		position: 'top-end',
		showConfirmButton: false,
		timer: 4000
	})

	//Navbar on scrolling
	$(window).on('scroll', function () {
		if ($(this).scrollTop() > 200) {
			$('.navbar').fadeIn('slow').css('display', 'flex')
			$('.to-bottom').fadeOut('slow')
		} else {
			$('.navbar').fadeOut('slow').css('display', 'none')
			$('.to-bottom').fadeIn('slow')
		}
	})

	//Smooth scrolling on the navbar links
	$(".navbar-nav a").on('click', function (event) {
		if (this.hash !== "") {
			event.preventDefault()
			var scrollTop = '', width = $(window).width()
			if (width <= 576) {
				if ($(this).attr('href').match(/home/i)) {
					scrollTop = 0
				} else {
					scrollTop = $(this.hash).offset().top + 70
				}
			} else {
				if ($(this).attr('href').match(/home/i)) {
					scrollTop = 0
				} else {
					scrollTop = $(this.hash).offset().top -45
				}
			}

			$('html, body').animate({
				scrollTop: scrollTop
			}, 1500, 'easeInOutExpo')

			if ($(this).parents('.navbar-nav').length) {
				$('.navbar-nav .active').removeClass('active')
				$(this).closest('a').addClass('active')
			}
		}
	})

	//Scroll to Bottom
	$(window).on('scroll', function () {
		if ($(this).scrollTop() > 100) {
			$('.scroll-to-bottom').fadeOut('slow')
		} else {
			$('.scroll-to-bottom').fadeIn('slow')
		}
	})

	//Back to top button
	$(window).on('scroll', function () {
		if ($(this).scrollTop() > 200) {
			$('.back-to-top, .btn-music').fadeIn('slow')
		} else {
			$('.back-to-top, .btn-music').fadeOut('slow')
		}
	})

	$('.back-to-top').on('click', function () {
		$('html, body').animate({
			scrollTop: 0
		}, 1500, 'easeInOutExpo')
		return false
	})

	$(document).on('click', '.to-bottom', function () {
		$('html, body').animate({
			scrollTop: $('#about').offset().top + 75
		}, 1500, 'easeInOutExpo')
		return false
	})

	//lightbox option
	lightbox.option({
		showImageNumberLabel: false,
	})

	//AOS initialize
	AOS.init({
		duration: 1000,
		once: false,
		easing: 'ease-in-out-sine',
	})

	// To initialize tooltip with body container
	$(document).tooltip({
		selector: '.title',
		container: 'body'
	})

	//Clipboard
	$(function () {
		const clipboard = new ClipboardJS('.btn-copy')
		clipboard.on('success', function (e) {
			Toast.fire({
				icon: 'success',
				title: 'Nomor Rekening Berhasil Disalin !',
				height: 'auto'
			})
		})
	})

	//on load window
	$(window).on('load', function () {
		$('#cover').modal({backdrop: false, keyboard: false, show: true})
		$('html, body').toggleClass('overflow-hidden')
		if (!window.location.origin.match(/localhost/i)) {
			$('html, body').animate({
				scrollTop: 0
			}, 'fast', 'easeInOutExpo')
			setTimeout(() => {
				console.clear()
			}, 3000)
		}
	})

	//Music & Live Comment
	$(function () {
		//Music
		$(document).on('hidden.bs.modal', '#cover', function () {
			musicState = true
			myAudio.play()
			$('.to-bottom').removeClass('d-none')
			$('html, body').toggleClass('overflow-hidden bg-dark bg-custom')
			$('.navbar, .container-fluid, .back-to-top, .btn-music').css('opacity', 1)

			setTimeout(() => {
				setInterval(() => {
					var lastId = $('.comment-box.last').data('last') || 0
					$.ajax({
						cache: false,
						method: 'get',
						data: {lastId: lastId},
						url: siteUrl('wedding_invite/list_comment'),
						success: function (res) {
							if (res.data.length) {
								if ($('.empty-comment').length) listComment.html('')
								$('.comment-box.last').removeAttr('data-last').removeClass('last')
								$.each(res.data, (i, lc) => {
									listComment.prepend(lc)
								})
							}
						}, //success
					})
				}, 5000)
			}, 1000)
		})

		$(document).on('click', '.btn-music', function () {
			$(this).children().toggleClass('fa-play fa-pause')
			if (musicState) {
				musicState = false
				myAudio.pause()
			} else {
				musicState = true
				myAudio.play()
			}
			return false
		})

		// Form Comment
		if (formComment.length) {
			$(document).on('submit', formComment, function () {
				var name = $('#name').val(), message = $('#message').val()
				if (name && message) {
					$.ajax({
						cache: false,
						method: formComment.attr('method'),
						data: formComment.serialize(),
						url: siteUrl('wedding_invite/add_comment'),
						success: function (result) {
							var icon = !result.code || result.response == 200 ? 'success' : 'error'
							Toast.fire({
								icon: icon,
								title: result.message,
								height: 'auto'
							})
							listComment.html('')
							$.each(result.data, (i, lc) => {
								listComment.append(lc)
							})
						}, //success
						complete: function () {
							formComment[0].reset()
							listComment.slideDown('slow')
						}
					})
				} else {
					Toast.fire({
						icon: 'error',
						title: 'Nama & Pesan tidak boleh kosong',
						height: 'auto'
					})
					console.log('Name dan Message Tidak Boleh Kosong')
				}
				return false
			})
		}
	})

	//for develope only
	// $('.navbar, .container-fluid, .back-to-top, .btn-music').css('opacity', 1)

	//Type It
	$(function () {
		/*** TypeIt ***/
		const typeIt = new TypeIt('.type-it', {
			speed: 100,
			startDelay: 900,
			strings: $('.type-it').data('text'),
			breakLines: false,
			waitUntilVisible: true,
			loop: true
		}).go()
	})

	//flipdown
	$(function () {
		var receptionDate = $('.flipdown').data('reception')
		//initialize flipdown
		const flipDown = new FlipDown(receptionDate, 'reception-flipdown', {
			headings: ["Hari", "Jam", "Menit", "Detik"],
		}).start()
	})

	//swiper
	$(function () {
		var optionDesk = {
			effect: "coverflow",
			loop: true,
			grabCursor: true,
			centeredSlides: true,
			slidesPerView: "auto",
			coverflowEffect: {
				rotate: 50,
				stretch: 0,
				depth: 100,
				modifier: 1,
				slideShadows: true,
			},
			pagination: {
				el: ".swiper-pagination",
			},
		},
		optionCard = {
			loop: true,
			effect: 'cards',
			resizeReInit: true,
			grabCursor: true,
			centeredSlides: true,
			centerInsufficientSlides: true,
			pagination: {
				el: '.swiper-pagination'
			},
		}
		var swiper = new Swiper('#swiper-desk', optionDesk)
		var swiperCard = new Swiper('#swiper-cards', optionCard)
	})
})(jQuery)