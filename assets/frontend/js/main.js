(function ($) {
    "use strict"
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
        } else {
            $('.navbar').fadeOut('slow').css('display', 'none')
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
    // var portfolioIsotope = $('.portfolio-container').isotope({
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
            $('.back-to-top').fadeIn('slow')
        } else {
            $('.back-to-top').fadeOut('slow')
        }
    })
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo')
        return false
    })


    // Gallery carousel
    $(".gallery-carousel").owlCarousel({
        autoplay: false,
        smartSpeed: 1500,
        dots: false,
        loop: true,
        nav : true,
        navText : [
            '<i class="fa fa-angle-left" aria-hidden="true"></i>',
            '<i class="fa fa-angle-right" aria-hidden="true"></i>'
        ],
        responsive: {
            0:{
                items:1
            },
            576:{
                items:2
            },
            768:{
                items:3
            },
            992:{
                items:4
            },
            1200:{
                items:5
            }
        }
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
            let myAudio = $('#myAudio')[0]
            myAudio.play()
            $('html').removeClass('overflow-hidden')
            $('.navbar, .container-fluid').css('opacity', 1)
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

})(jQuery)