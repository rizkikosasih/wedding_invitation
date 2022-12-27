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

     <!-- Customized Bootstrap Stylesheet -->
     <link href="<?= base_url('assets/frontend/css/style.css') ?>" rel="stylesheet">
     <link href="<?= base_url('assets/frontend/css/custom.css') ?>" rel="stylesheet">
     <style>
          .bg-home {
               content: url(<?= base_url("$dir_img/event/$e->background_home") ?>) !important;
               object-fit: cover !important;
          }
          .bg-gallery {
               content: url(<?= base_url("$dir_img/event/$e->background_gallery") ?>) !important;
               background: unset;
               object-fit: cover !important;
          }
          .bg-cover {
               content: url(<?= base_url("$dir_img/event/$e->cover") ?>) !important;
               object-fit: cover !important;
          }
          @media (max-width: 767px) {
               .bg-home {
                    content: url(<?= base_url("$dir_img/event/$e->background_home_mobile") ?>) !important;
                    object-fit: cover !important;
               }
               .bg-gallery {
                    content: url(<?= base_url("$dir_img/event/$e->background_gallery_mobile") ?>) !important;
                    object-fit: cover !important;
               }
               .bg-cover {
                    content: url(<?= base_url("$dir_img/event/$e->cover_mobile") ?>) !important;
                    object-fit: cover !important;
                    /* transform: scale(1.5); */
               }
          }
     </style>