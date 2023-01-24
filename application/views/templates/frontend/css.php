     <!-- Google Web Fonts -->
     <link rel="preconnect" href="https://fonts.gstatic.com">
     <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Montserrat:wght@400;600&display=swap" rel="stylesheet"> 

     <!-- Font Awesome -->
     <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" rel="stylesheet">

     <!-- Swiper -->
     <link rel="stylesheet" href="<?= base_url('assets/plugins/swiper/swiper-bundle.min.css') ?>">

     <!-- AOS -->
     <link rel="stylesheet" href="<?= base_url('assets/plugins/aos/aos.css') ?>" rel="stylesheet">

     <!-- Libraries Stylesheet -->
     <link href="<?= base_url('assets/plugins/owl.carousel/assets/owl.carousel.min.css') ?>" rel="stylesheet">
     <link href="<?= base_url('assets/plugins/lightbox/css/lightbox.min.css') ?>" rel="stylesheet">
     <link rel="stylesheet" href="<?= base_url('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') ?>" rel="stylesheet">
     <link rel="stylesheet" href="<?= base_url('assets/plugins/toastr/toastr.min.css') ?>" rel="stylesheet">
     <link rel="stylesheet" href="<?= base_url('assets/plugins/flipdown/flipdown.min.css') ?>" rel="stylesheet">
     <link rel="stylesheet" href="<?= base_url('assets/plugins/lightboxed/lightboxed.css') ?>" rel="stylesheet">

     <!-- Customized Bootstrap Stylesheet -->
     <link href="<?= base_url('assets/frontend/css/style.css') ?>" rel="stylesheet">
     <link href="<?= base_url("assets/frontend/css/custom.css??_timestamp=$timest") ?>" rel="stylesheet">
     <style>
          .container-fluid:not(#home) {
               background-image: url(<?= base_url("assets/public/images/bg-custom.png?_timestamp=$timest") ?>);
               /* background-attachment: fixed; */
               background-repeat: no-repeat;
               background-position: center;
               background-size: cover;
          }
          #home .carousel-inner {
               border-bottom-left-radius: 50% 10%;
               border-bottom-right-radius: 50% 10%;
          }
          .bg-home {
               content: url(<?= base_url("$dir_img/event/x1920_$e->background_home?_timestamp=$timest") ?>) !important;
               object-fit: cover !important;
          }
          .bg-gallery {
               /* object-fit: cover !important; */
               background-image: url(<?= base_url("$dir_img/event/x1920_$e->background_gallery?_timestamp=$timest") ?>) !important; 
               background-attachment: fixed;
               background-position: center;
               background-repeat: no-repeat;
               background-size: cover;
          }
          .bg-cover {
               content: url(<?= base_url("$dir_img/event/x1920_$e->cover?_timestamp=$timest") ?>) !important;
               object-fit: cover !important;
          }
          @media (max-width: 767px) {
               .container-fluid:not(#home) {
                    background-image: url(<?= base_url("assets/public/images/bg-custom-mobile.png?_timestamp=$timest") ?>);
               }
               .bg-home {
                    content: url(<?= base_url("$dir_img/event/x1920_$e->background_home_mobile?_timestamp=$timest") ?>) !important;
                    object-fit: cover !important;
               }
               .bg-gallery {
                    background-image: url(<?= base_url("$dir_img/event/x1920_$e->background_gallery_mobile?_timestamp=$timest") ?>) !important;
                    /* object-fit: cover !important; */
               }
               .bg-cover {
                    content: url(<?= base_url("$dir_img/event/x1920_$e->cover_mobile?_timestamp=$timest") ?>) !important;
               }
          }
     </style>