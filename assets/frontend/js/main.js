(function ($) {
    "use strict"
    let myAudio = $('#myAudio')[0], musicState = false

    /* sweetalert & toast */
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000
    })

    // Navbar on scrolling
    $(window).on('scroll', function () {
        if ($(this).scrollTop() > 200) {
            $('.navbar').fadeIn('slow').css('display', 'flex')
            $('.to-bottom').fadeOut('slow')
        } else {
            $('.navbar').fadeOut('slow').css('display', 'none')
            $('.to-bottom').fadeIn('slow')
        }
    })

    // Smooth scrolling on the navbar links
    $(".navbar-nav a").on('click', function (event) {
        if (this.hash !== "") {
            event.preventDefault()

            $('html, body').animate({
                scrollTop: $(this.hash).offset().top - 45
            }, 1500, 'easeInOutExpo')

            if ($(this).parents('.navbar-nav').length) {
                $('.navbar-nav .active').removeClass('active')
                $(this).closest('a').addClass('active')
            }
        }
    })

    // Scroll to Bottom
    $(window).on('scroll', function () {
        if ($(this).scrollTop() > 100) {
            $('.scroll-to-bottom').fadeOut('slow')
        } else {
            $('.scroll-to-bottom').fadeIn('slow')
        }
    })

    // Portfolio isotope and filter
    // let portfolioIsotope = $('.portfolio-container').isotope({
    //     itemSelector: '.portfolio-item',
    //     layoutMode: 'fitRows'
    // })
    // $('#portfolio-flters li').on('click', function () {
    //     $("#portfolio-flters li").removeClass('active')
    //     $(this).addClass('active')
    //     portfolioIsotope.isotope({filter: $(this).data('filter')})
    // })

    // Back to top button
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
        	scrollTop: $('#about').offset().top
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
        $('html').addClass('overflow-hidden')
        if (!window.location.origin.match(/localhost/i)) {
            $('html, body').animate({
                scrollTop: 0
            }, 'fast', 'easeInOutExpo')
            setTimeout(() => {
                console.clear()
            }, 3000)
        }
    })

    //Music
    $(function () {
        $('#cover').on('hidden.bs.modal', function () {
            musicState = true
            myAudio.play()
            $('html').removeClass('overflow-hidden')
            $('.navbar, .container-fluid, .back-to-top, .btn-music').css('opacity', 1)
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
    })

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

    // flipdown
    $(function () {
        let receptionDate = $('.flipdown').data('reception')
        //initialize flipdown
        const flipDown = new FlipDown(receptionDate, 'reception-flipdown', {
            headings: ["Hari", "Jam", "Menit", "Detik"],
        }).start()
    })

    //swiper
    $(function () {
        const swiper = new Swiper('.swiper-desk', {
            direction: 'horizontal',
            loop: true,
            effect: 'coverflow',
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
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        })

        const swiperCard = new Swiper('.swiper', {
            effect: 'cards',
            loop: true,
            grabCursor: true,
            centeredSlides: true,
            centerInsufficientSlides: true,
        })
    })

})(jQuery)